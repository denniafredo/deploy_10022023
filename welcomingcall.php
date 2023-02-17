<?php
    include "../../includes/session.php";
    include "../../includes/database.php";
	include "../../includes/klien.php";
 	include "../../includes/pertanggungan.php";
	
    $DB = New Database($userid,$passwd,$DBName);
	$user_master = in_array($modul, array('DMS','ALL','POS','ITC'));
	$user_klaim = in_array($modul, array('KLM', 'ALL','ITC'));
	$user_view = in_array($modul, array('CUS','ITC'));
	$listapibank = in_array($kdbank, array('002'));
	
	$sql = "SELECT code, description, utl_raw.cast_to_varchar2(request) request, accountname, accountnumber
			FROM $DBUser.tabel_100_klien_rekening_api
			WHERE prefixpertanggungan = '$prefix'
				AND nopertanggungan = '$noper'
				AND kdbank = '$kdbank'
				AND utl_raw.cast_to_varchar2(request) LIKE '%$norekening%'
				AND TRUNC(tglbatch) = TRUNC(sysdate)
			ORDER BY tglbatch DESC";
	$DB->parse($sql);
	$DB->execute();
	$arr = $DB->nextrow();
	$req = json_decode(@$arr['REQUEST'], true);
	
	if ($submitapi) {
		// Jika nomor rekening kosong dan masuk dalam list bank api
		if (empty($norekening) && $listapibank) {
			echo "<font face='Verdana' size='2' color='red'><u><b>Pengecekan Gagal, Nomor Rekening tidak boleh kosong!</b></u></font><br /><br />";
		} else if (!empty($norekening) && $listapibank) {
			// Jika no rekening sama
			if (@$req['accountNo'] == $norekening) {
				echo "<font face='Verdana' size='2' color='red'>APIDB : ".@$arr['DESCRIPTION']."</font><br /><br />";
				
				$atasnama = $arr['ACCOUNTNAME'];
			} else {
				$curl = curl_init();
				$request = '{"accountNo":"'.$norekening.'"}';

				curl_setopt_array($curl, array(
					CURLOPT_URL => $HTTP_HOST_PG_BRI,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_CONNECTTIMEOUT => 0,
					CURLOPT_TIMEOUT => 3000,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $request,
					CURLOPT_HTTPHEADER => array(
						'Content-Type: text/plain'
					),
				));

				$response = curl_exec($curl);
				$data = json_decode($response, true);

				curl_close($curl);
				
				$insert = "INSERT INTO $DBUser.tabel_100_klien_rekening_api (batch, prefixpertanggungan, nopertanggungan,
						kdbank, tglrequest, request, response, code, description, remark, accountname, accountnumber, 
						currency, status, tglbatch)
					VALUES ('$batch', '$prefix', '$noper', '002', sysdate,
						utl_raw.cast_to_raw('$request'), utl_raw.cast_to_raw('$response'), '$data[responseCode]', 
						'$data[responseDescription]', '".@$data['data']['remark2']."', '".@$data['data']['accountName']."', 
						'".@$data['data']['accountNumber']."', '".@$data['data']['acctCur']."', 
						'".@$data['data']['status']."', TO_DATE('$batch', 'yyyymmddhh24miss'))";
				$DB->parse($insert);
				$DB->execute();
				
				$atasnama = @$data['data']['accountName'];
				
				echo "<font face='Verdana' size='2' color='red'>API : $data[responseDescription]</font><br /><br />";
			}
		}
	}
	
    if ($submitmaster) {
        if(empty($norekening)){
			echo "<font face='Verdana' size='2' color='red'><u><b>Gagal, Nomor Rekening tidak boleh kosong!</b></u></font><br /><br />";
        } else if (@$req['accountNo'] != $norekening && $listapibank) {
			echo "<font face='Verdana' size='2' color='red'><u><b>Gagal, Silahkan lakukan Cek via API terlebih dahulu!</b></u></font><br /><br />";
		} else {
			// Jika response dari API rek valid bisa insert
			if (@$arr['CODE'] != '000' && $listapibank) {
				echo "<font face='Verdana' size='2' color='red'><u><b>Gagal, Rekening tidak dapat di update karena $arr[DESCRIPTION]!</b></u></font><br /><br />";
			} else {
				if ($action == 'insert') {
					$sql = "INSERT INTO $DBUser.tabel_100_klien_rekening (prefixpertanggungan, nopertanggungan, kdbank, 
								cabangbank, norekening, atasnama, tglrekam, userrekam, status)
							VALUES ('$prefix', '$noper', '$kdbank', '$cabangbank', 
								'$norekening', '$atasnama', sysdate, '$userid', 0)";
				} else {
					$sql = "UPDATE $DBUser.tabel_100_klien_rekening SET KDBANK = '$kdbank',
								CABANGBANK = '$cabangbank', NOREKENING = '$norekening', ATASNAMA = '$atasnama', 
								TGLUPDATED = SYSDATE, USERUPDATED = '$userid'
							WHERE PREFIXPERTANGGUNGAN = '$prefix' AND NOPERTANGGUNGAN = '$noper'";
				}
				$DB->parse($sql);
				$DB->execute();
				if ($DB->errormessage) {
					echo "<font face='Verdana' size='2' color='red'>Gagal, error : $DB->errorstring</font><br /><br />";
				} else {
					echo "<font face='Verdana' size='2' color='green'><u><b>Sukses, rekening master berhasil diupdate!</b></u></font><br /><br />";
				}
			}
        }
    }
	
	if ($submitklaim) {
		if (empty($norekening)) {
			echo "<h3><font face='Verdana' color='red'><u>Nomor Rekening tidak boleh kosong!</u></font></h3>";
		} else if (@$req['accountNo'] != $norekening) {
			echo "<font face='Verdana' size='2' color='red'><u><b>Gagal, Silahkan lakukan Cek via API terlebih dahulu!</b></u></font><br /><br />";
		} else {
			$sql = "UPDATE $DBUser.tabel_901_pengajuan_klaim SET 
						namabank = (SELECT alias FROM $DBUser.tabel_399_bank WHERE kdbank = '$kdbank'),
						cabangbank = '$cabangbank',
						norekeningbank = '$norekening',
						penerimasip = '$atasnama'
					WHERE prefixpertanggungan = '$prefix'
						AND nopertanggungan = '$noper'
						AND kdklaim = '$kdklaim'
						AND TO_CHAR(tglpengajuan, 'dd/mm/yyyy') = '$tglpengajuan'";
			$DB->parse($sql);
			$DB->execute();
			
			if ($DB->errormessage) {
				echo "<font face='Verdana' size='2' color='red'>Gagal, error : $DB->errorstring</font><br /><br />";
			} else {
				echo "<font face='Verdana' size='2' color='green'><u><b>Sukses, rekening klaim 901 berhasil diupdate!</b></u></font><br /><br />";
			}
			
			$sql = "UPDATE $DBUser.tabel_900_klaim_pusat SET
						namabank = (SELECT alias FROM $DBUser.tabel_399_bank WHERE kdbank = '$kdbank'),
						cabangbank = '$cabangbank',
						norekeningbank = '$norekening',
						penerimasip = '$atasnama'
					WHERE prefixpertanggungan = '$prefix'
						AND nopertanggungan = '$noper'
						AND kdklaim = '$kdklaim'
						AND TO_CHAR(tglpengajuan, 'dd/mm/yyyy') = '$tglpengajuan'";
			$DB->parse($sql);
			$DB->execute();
			
			if ($DB->errormessage) {
				echo "<font face='Verdana' size='2' color='red'>Gagal, error : $DB->errorstring</font><br /><br />";
			} else {
				echo "<font face='Verdana' size='2' color='green'><u><b>Sukses, rekening klaim 900 berhasil diupdate!</b></u></font><br /><br />";
			}
		}
	}
?>

<html>
    <head>
        <link type="text/css" href="../../includes/jws.css" rel="stylesheet" />
        <link type="text/css" href="../../jquery/demos.css" rel="stylesheet" />
        <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
        <title>Update Status Welcoming Call</title>
    </head>
    <body>
		<?php
		
			$newNopolis = base64_decode(base64_decode($_REQUEST['no_polis']));
			$newnopertanggungan = base64_decode(base64_decode($_REQUEST['nopertanggungan']));
			$prefix = base64_decode(base64_decode($_REQUEST['prefix']));
			
			$PER=New Pertanggungan($userid,$passwd,$prefix,$newnopertanggungan);
			$KLN=New Klien($userid,$passwd,$PER->notertanggung);
			
			
		    $sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, b.kdbank, d.alias, b.namabank, b.cabangbank, b.norekening, 
						b.atasnama, c.namabank namabankklaim, c.cabangbank cabangbankklaim, c.norekeningbank norekeningklaim, 
						c.penerimasip atasnamaklaim, e.statusbayarho, c.kdklaim, TO_CHAR(c.tglpengajuan, 'dd/mm/yyyy') tglpengajuan,
						b.userrekam, TO_CHAR(sysdate, 'yyyymmddhh24mmss') AS batch
					FROM $DBUser.tabel_200_pertanggungan a
					LEFT OUTER JOIN $DBUser.tabel_100_klien_rekening b ON a.prefixpertanggungan = b.prefixpertanggungan
						AND a.nopertanggungan = b.nopertanggungan
					LEFT OUTER JOIN $DBUser.tabel_901_pengajuan_klaim c ON a.prefixpertanggungan = c.prefixpertanggungan
						AND a.nopertanggungan = c.nopertanggungan
						AND c.kdklaim = '$kdklaim'
						AND TO_CHAR(c.tglpengajuan, 'dd/mm/yyyy') = '$tglpengajuan'
					LEFT OUTER JOIN $DBUser.tabel_399_bank d ON b.kdbank = d.kdbank
					LEFT OUTER JOIN $DBUser.tabel_900_klaim_pusat e ON a.prefixpertanggungan = e.prefixpertanggungan
						AND a.nopertanggungan = e.nopertanggungan
						AND c.kdklaim = e.kdklaim
						AND c.tglpengajuan = e.tglpengajuan
					WHERE (a.prefixpertanggungan = '$prefix' AND a.nopertanggungan = '$newnopertanggungan')
						OR a.nopol = '$newNopolis'
						OR a.nopolbaru = '$newNopolis'";
			$DB->parse($sql);
			$DB->execute();
			$arr=$DB->nextrow();
			
			$qry="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,".
			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode (a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin, ".
			 "a.tinggibadan,a.beratbadan, decode (a.meritalstatus,'D','DUDA','J','JANDA','K','KAWIN','L','LAJANG') meritalstatus,".
			 "a.alamattagih01,a.alamattagih02,a.phonetagih01,a.phonetagih02,a.phonetetap01,a.phonetetap02,".
			 "a.alamattetap01,a.alamattetap02,d.namakotamadya,e.namapropinsi,NVL(a.NO_PONSEL,a.PHONETETAP02) nohp, a.EMAILTAGIH ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) ".
			 "and a.kdpropinsitagih=e.kdpropinsi(+) and a.kdkotamadyatagih=d.kdkotamadya(+) and a.noklien='$PER->nopemegangpolis' ";
		
			$DB->parse($qry);
			$DB->execute();
			$arv=$DB->nextrow();

			
			$kdbank = $kdbank ? $kdbank : $arr['KDBANK'];
			$cabangbank = $cabangbank ? $cabangbank : $arr['CABANGBANK'];
			$norekening = $norekening ? $norekening : $arr['CABANGBANK'];
			$atasnama = $atasnama ? $atasnama : $arr['ATASNAMA'];
			$nopolis = $nopolis ? $nopolis : "$arr[PREFIXPERTANGGUNGAN]$arr[NOPERTANGGUNGAN]";
			
			
		?>
	
        <font face="Verdana" size="2"><b>Informasi Untuk Welcoming Call</b>
			<ul style="margin-top:0px;margin-bottom:0px;">
				<li>No Polis : <strong><?= $newNopolis ?></strong></li>
				<li>No Tertanggung : <strong><?= $newnopertanggungan ?></strong></li>
				<li>Phone Tagih : <strong><? echo $arv["PHONETAGIH01"]; ?><? echo $arv["PHONETAGIH02"]=='' ? "" : ", ".$arv["PHONETAGIH02"] ; ?>  </strong></li>
				<li>Phone Tetap  : <strong><? echo $arv["PHONETETAP02"]=='' ? "" : " ".$arv["PHONETETAP02"] ; ?> </strong></li>
				<li>No. Handphone Korespondensi  : <strong><? echo $arv["NOHP"]; ?></strong></li>
			
			</ul>
		</font>
        <hr size=1>
		
		<br />

			<form id="formWelcomingCall" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="nopolis" value="<?=$nopolis;?>" />
				<input type="hidden" name="newNopolis" value="<?=$newNopolis;?>" />
	            <input type="hidden" name="prefix" value="<?=$arr['PREFIXPERTANGGUNGAN'];?>" />
	            <input type="hidden" name="noper" value="<?=$arr['NOPERTANGGUNGAN'];?>" />
				
				<input type="hidden" name="nosp" value="<?= $PER->nosp; ?>" />
				<input type="hidden" name="noagen" value="<?= $PER->noagen; ?>" />
				
				<input type="hidden" id="access-token" />
				
	            <table border="1" width="600" cellspacing="0" cellpadding="6" style='border:1px solid #006699; font-family: verdana; font-size: 12px' >
	                <tr>
	                    <td align="center" bgcolor="#627EB5" colspan="2">
	                        <font color="#fff"><b>UPDATE PROSES WELCOMING CALL</b></font>
	                    </td>
	                </tr>
	                <tr>
	                    <td width='150'>Status Welcoming Call</td>
	                    <td>: 
							<select name="status" onchange="changeStatus(this.value);">
									<option value='0' selected>1. Gagal Welcoming Call</option>
									<option value='2' >2. Berhasil Welcoming Call Dengan Catatan</option>
									<option value='1' >3. Berhasil Melakukan Welcoming Call</option>
							</select>
						</td>
	                </tr>

	                <tr>
	                    <td>Pelaksana</td>
	                    <td>: <input type="text" size="40" name="pelaksana" value="<?= $_SESSION['namusr'] ?>" required="" readonly=""></td>
	                </tr>

	                <tr>
	                    <td>Calon Nasabah</td>
	                    <td>: 
							
							<input type="hidden" size="40"  name="noid" value="<?= $KLN->noid; ?>" >
							<input type="text" size="40"  name="namatertanggung" value="<?= $PER->namatertanggung; ?>" required="" readonly="">
						</td>
	                </tr>
					

	                <tr>
	                    <td>Keterangan</td>
	                    <td>: 
							<textarea size="200" style="widht: 200px" row="4" name="keterangan" required></textarea>
						</td>
	                </tr>
					
					<tr >
	                    <td>Files Attach Welcoming Call (pdf files)</td>
	                    <td>: 
							<input type="file" size="40"  name="item[1][upload]" accept=".pdf"><br>
							<input type="hidden" name="item[1][status]" value="6" />
						</td>
	                </tr>
					
					<tr id="filesWC" hidden>
	                    <td>Files Welcoming Call (gsm or mp4 files)</td>
	                    <td>: 
							<input type="file" size="40"  name="item[0][upload]" accept="video/*, audio/*, .gsm">
							<input type="hidden" name="item[0][status]" value="5" />
						</td>
	                </tr>
					<tr>
						<td colspan="2">
							
							<button type="submit" class="btn green" style="width:100%;">Simpan</button>
						</td>
					</tr>
	            </table>
	        </form>
        
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		
		

		<script type="text/javascript">
			window.addEventListener('load', async (event) => {
				const result = await fetch('<?= $HTTP_HOST_AIM ?>/api/jsspaj/master/token', {
					method: 'GET',
					mode: 'cors',
					headers:{
						"token-access": `csoogckw044s8sww0wkk0cgskk4ww0wogooscssk`,
					}
				}).then((response) => response.json())
				.then((data) => {
					if(!data.error){
						document.querySelector('#access-token').setAttribute('name', data.token);
						document.querySelector('#access-token').value = data.token;
					}
				});
			});
		</script>
		
		<script>
			function changeStatus(val) {
				if(val == 1 || val == 2){
					document.querySelector('#filesWC').removeAttribute('hidden')
				}else{
					document.querySelector('#filesWC').setAttribute('hidden', true)
				}
			}
		</script>
		
		<script type="text/javascript">
			
			$(function(){
				
				$('#formWelcomingCall').on('submit', async function(e){
					e.preventDefault();
					
					var form = $('#formWelcomingCall')[0]; 
					
					
					let response = await fetch('<?= $HTTP_HOST_AIM ?>/api/jsspaj/master/welcoming-call', {
						method: 'POST',
						//mode: 'cors',
						headers:{
							"token-access": `csoogckw044s8sww0wkk0cgskk4ww0wogooscssk`,
						},
						body: new FormData(form)
					})
					.then((response) => response.json())
					.then((data) => {
						//data = data[0];
						console.log(data)
						if(data.status){
							if(data.result == 0){
								alert('Success ReUpdate Status Welcoming Call')
								setTimeout(function(){
									window.location.reload();
								}, 500);
								
							}else{
								alert('Success Final Update Status Welcoming Call')
								setTimeout(function(){
									window.location.reload();
									window.close();
								}, 1000);
							}
						}else{
							alert('Gagal ReUpdate Status Welcoming Call')
							setTimeout(function(){
								window.location.reload();
							}, 500);
						}
						
						setTimeout(function(){
							$("#overlay").fadeOut(300);
						}, 200);
					});
					
					
				});
			});
			
		</script>
    </body>
</html>
