<?php
	set_time_limit(10000001);
	include "../../includes/common.php";
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/tgl.php";
	include "../../includes/constant.php";

	$userid="jsadm";
	$passwd="jsadmoke";
	$DB  = new database($userid, $passwd, $DBName);
	$DBx  = new database($userid, $passwd, $DBName);
	$prefix=strtoupper($prefix);
	

	if ($billing) {
		$sql = "begin $DBUser.GEN_EMAIL_BLAST ( '".$_POST['jnsblast']."', '".$_POST['periode']."' );end;";
		$DB->parse($sql);
		$DB->execute();
		echo $sql;
		
		$sql = "select max(ID_BLAST) ID_BLAST from email_blast_event where  JENIS_BLAST = '".$_POST['jnsblast']."'";
		$DB->parse($sql);
		$DB->execute();
		
		$row=$DB->nextrow();
		$idblast = $row['ID_BLAST'];
		
		if($_POST['jnsblast']=='EMAIL_JATUH_PREMI_BERKALA' || $_POST['jnsblast']=='EMAIL_JATUH_PREMI_BERKALA_SUSULAN'){
			$queryxx = "SELECT c.*,to_char(TGLBOOKED,'MM/YYYY') periode,to_char(TGLBOOKED,'YYYYMM') tglcari,
							(select NAMAKLIEN1
								from tabel_200_pertanggungan a, TABEL_100_KLIEN b 
								where a.prefixpertanggungan = C.prefixpertanggungan 
								and a.nopertanggungan = C.nopertanggungan 
								and a.NOTERTANGGUNG = b.NOKLIEN) NAMAKLIEN,
							(select PIC_URL from email_blast_event where ID_BLAST = '".$idblast."') PIC_URL	
						FROM $DBUser.PENERIMA_EMAIL_TES c
						WHERE ID_BLAST = '".$idblast."'
							and jenis in ('M','N','X','R','T','L','P') 
						order by PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN";
		}else{
			$queryxx = "SELECT c.*,to_char(TGLBOOKED,'MM/YYYY') periode,to_char(TGLBOOKED,'YYYYMM') tglcari,
							(select NAMAKLIEN1
								from tabel_200_pertanggungan a, TABEL_100_KLIEN b 
								where a.prefixpertanggungan = C.prefixpertanggungan 
								and a.nopertanggungan = C.nopertanggungan 
								and a.NOTERTANGGUNG = b.NOKLIEN) NAMAKLIEN,
							to_char(tglseatled,'YYYYMM') tglseatled,
							(select (NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETETAP01,nvl(PHONETAGIH01,PHONETAGIH02)))))
								from tabel_200_pertanggungan a, TABEL_100_KLIEN b 
								where a.prefixpertanggungan = C.prefixpertanggungan 
								and a.nopertanggungan = C.nopertanggungan 
								and a.nopemegangpolis = b.NOKLIEN) telp,
							(select PIC_URL from email_blast_event where ID_BLAST = '".$idblast."') PIC_URL	
						FROM $DBUser.PENERIMA_EMAIL_TES c
						WHERE ID_BLAST = '".$idblast."'
							and jenis in ('J')
						order by PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN";
		}	
		echo $queryxx;//die;
		if($_POST['jnsblast']=='EMAIL_JATUH_PREMI_BERKALA' || $_POST['jnsblast']=='EMAIL_JATUH_PREMI_BERKALA_SUSULAN'){
			include 'function_gen_pdf_ftp_jatuh_tempo.php';
		}else{
			include 'function_gen_pdf_ftp_premium_statement.php';
		}
		
		$DBx->parse($queryxx);
		$DBx->execute();
		while ($rowxx=$DBx->nextrow()) {
			$idaudience = $rowxx['ID_AUDIENCE'];
			$telp = $rowxx['TELP'];
			$image_promo = $rowxx['PIC_URL'];
			$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
			$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
			if($_POST['jnsblast']=='EMAIL_JATUH_PREMI_BERKALA' || $_POST['jnsblast']=='EMAIL_JATUH_PREMI_BERKALA_SUSULAN'){
				$tglcari = $rowxx['TGLCARI'];
			}else{
				$tglcari = $rowxx['TGLSEATLED'];
			}				
			$kdkantor = $rowxx['RAYONPENAGIHAN'];
			gen_pdf($prefixpertanggungan,$nopertanggungan,$tglcari,$kdkantor,$image_promo); //die;
			if($_POST['jnsblast']=='EMAIL_PREMIUM_STATEMENT'){
				$nama_file = $tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
				
				$queryxx = "update $DBUser.PENERIMA_EMAIL_TES
							set no_hp = '".$telp."',/*url = '".$url_pendek."',*/
								FILE_PDF = '".$nama_file."'
							WHERE ID_BLAST = '".$idblast."'
							and ID_AUDIENCE = '".$idaudience."'";
				$DB->parse($queryxx);
				$DB->execute();
				//echo $queryxx;die;
				
				echo $telp;
				echo '<br><br>';
				echo $url_pendek;
				echo '<br><br>';
			}else{
				$nama_file = $tglcari.'_PST_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
				
				$queryxx = "update $DBUser.PENERIMA_EMAIL_TES
							set FILE_PDF = '".$nama_file."'
							WHERE ID_BLAST = '".$idblast."'
							and ID_AUDIENCE = '".$idaudience."'";
				$DB->parse($queryxx);
				$DB->execute();
			}
		}
		
		echo $queryxx;die;
		header("Location: daftar_email.php");
	}else{
		$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
		$DB->parse($sql);
		$DB->execute();
		$w=$DB->nextrow();
		$tanggal = $w["NOW"];
	?>

		<html>
			<head>
				<title>Pengajuan Klaim Tanggal </title>

				<style type="text/css">
					<!--

					body {
						background-color: #FFFFFF;
						font-family: Verdana, Arial, Serif;
						font-size: 10px;
						color: #000000;
						margin-left: 0px;
						margin-top: 10px;
						margin-right: 0px;
						margin-bottom: 0px;
					}

					table {
						font-family: verdana;
						font-size: 12px;
					}

					.button {
						font-size: 11px;
						color: #FFFFFF;
						background-color: #99cccc;
						border: solid 0px;
					}

					.select {
						font-family: Verdana, Arial, Serif;
						font-size: 11px;
						color: #336699;
						background-color: #FFFFFF;
					}

					-->
				</style>

				<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
				<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
				<script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
				<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
				<script language="JavaScript" type="text/javascript">
					<!--

					function KartuPremi(theForm){
						var polis=theForm.pertanggungan.value;
						if (!polis =='') { 
							var prefix=polis.substring(0,2);
							var noper=polis.substring(3);
							NewWindow('../akunting/kartupremi1.php?prefix='+prefix+'&noper='+noper+'','kartupremi',700,600,1)
							return true;
						}
					}
					function KartuGadai(theForm){
						var polis=theForm.pertanggungan.value;
						if (!polis =='') {
							var prefix=polis.substring(0,2);
							var noper=polis.substring(3);
							NewWindow('../akunting/kartugadai1.php?prefix='+prefix+'&noper='+noper+'','kartugadai',700,600,1)
							return true;
						}	
					}
					function Polis(theForm){
						var polis=theForm.pertanggungan.value;
						if (!polis =='') {
							var prefix=polis.substring(0,2);
							var noper=polis.substring(3);
							NewWindow('polis.php?prefix='+prefix+'&noper='+noper+'','polis',700,600,1)
							return true;
						}	
					}

					function GantiKlaim(theForm) {
						var prefix=theForm.prefix.value;
						var noper=theForm.noper.value;
						var kdklaim=theForm.jnsklaim.value;
						prefix=prefix.toUpperCase();
						window.location.replace('pengajuanklaim_akdp.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
					}

					function OpenWin(prefix,noper) {
						var kdklaim=document.propmtc.jnsklaim.value;
						NewWindow('loadpengajuan_akdp.php?prefix='+prefix+'&noper='+noper+'&kode='+kdklaim+'','',700,400,1)
					}

					function CariPolis () {
						prefix = document.propmtc.prefix.value;
						noper = document.propmtc.noper.value;

						loadOK = true;
						if ( prefix == '' && loadOK) {
						  	alert('Masukkan Prefix Pertanggungan atau \nKlik Pilih Polis');
							document.propmtc.prefix.focus();
							loadOK = false;
						}
						if ( ( noper == '' || noper=='000000000') && loadOK ) {
						  	alert('Masukkan Nomor Pertanggungan');
							document.propmtc.prefix.focus();
							loadOK = false;
						}
						if (loadOK) {  
							OpenWin(prefix,noper);
						}
						return loadOK
					}
					
					function OnSumbit(theForm) {
						var pert=theForm.pertanggungan.value;
						if (pert =='') {
						  	alert ('Nomor Polis Kosong, Masukkan Nomor Polis Yang Benar Atau Cari Dari Popup');
						 	theForm.prefix.focus();
							return false;
						}else{
						  	return true
						}
					}

					function PilihAo(theForm) {
					 	var polis=theForm.pertanggungan.value;
						NewWindow('loadinsurable.php?nopertanggungan='+polis+'','popupcari',500,200,1);
					}
				//-->
				</script>
				<?
					$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
					$klp=$arr["KELOMPOK"];
	
					if ($klp=='D') {
						print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
						print( "<!--\n" );
						print( "function KonverDate(theForm) {\n" );
						print( " tglmati=theForm.tglmeninggal.value;\n" );
						print( " if (!tglmati=='') {\n" );
						print( "  convert_date(theForm.tglmeninggal);\n" );
						print( "	return true;\n" );
						print( " } else {\n" );
						print( "  alert('Tanggal Meninggal Wajib Diisi');\n" );
						print( "	theForm.tglmeninggal.focus();\n" );
						print( "	return false;\n" );
						print( " }		\n" );
						print( "}\n" );
						print( "//-->\n" );
						print( "</script>\n" );
					}
				?>

			</head>
			<body>
				<div align="center">
					<form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>"  onsubmit="return OnSumbit(document.propmtc)">
						<table bgcolor="#e5e5e5" border="1" width="780" align="center" cellpadding="2" style="border-collapse: collapse" bordercolor="#a4a4a4" id="AutoNumber1" cellspacing="0">
							<tr>
								<td width="100%" height="25" bgcolor="#fac67e" align="center"><b>Create Event Blast (Susulan)</b></td>
							</tr>
							<tr>
								<td width="100%">
									<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
										<tr>
											<td>Jenis Blast</td>
											<td>:
												<select name="jnsblast" class="select">
												<?
													echo "<option value='EMAIL_JATUH_PREMI_BERKALA_SUSULAN'>EMAIL_JATUH_PREMI_BERKALA SUSULAN</option>";
													//echo "<option value='EMAIL_PREMIUM_STATEMENT'>EMAIL_PREMIUM_STATEMENT</option>";
												?>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="4"><hr color="#c0c0c0" size="1"></td>
										</tr>
										<tr>
											<td>Periode</td>
											<td colspan="3">: 
												<input type="text" name="periode" size="16"> (MM/YYYY)
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="100%" height="25" bgcolor="#fac67e" align="center">
									<input type="submit" name="billing" value="billing" />
								</td>
							</tr>
						</table>
					</form>
					<br><br>
					<table width="800">
						<tr>
							<td width="50%" class="arial10" align="left"><a href="../polisserv.php">Policy Servicing</a></td>
							<td width="50%" class="arial10" align="right"></td>
						</tr>
					</table>
				</div>
			</body>
		</html>
<?php
	}
?>