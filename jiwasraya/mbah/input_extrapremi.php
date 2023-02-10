<?
	include "../includes/database.php";
	include "../includes/session.php";
	include "../includes/klien.php";
	include "../includes/pertanggungan.php";
	include "../includes/common.php";

	$DB=new database($userid, $passwd, $DBName);
	$DB2=new database($userid, $passwd, $DBName);
	$DB3=new database($userid, $passwd, $DBName);

	if ($_POST['update_cor']){
		$sql=" SELECT * 
				FROM $DBUser.tabel_223_extra_premi 
				WHERE nopertanggungan='$noper_input' and prefixpertanggungan='$prefix_input' and kdbenefit = '$kdbenefit_input' ";
		$DB->parse($sql);
		$DB->execute();
		$arr=$DB->nextrow();

		if ($arr != null) {
			$cekdata ='1';
		}else{
			$cekdata ='0';
		}

		if ($cekdata =='1') {
			$sql_update="UPDATE $DBUser.tabel_223_extra_premi 
						SET NILAI = $basis_coicor,
								NILAI_BASISJUA = $basis_jua, 
								NILAI_BASISHOBI = $basis_hobi,
								tglupdate = sysdate,
								userupdate = '$userid' 
						WHERE PREFIXPERTANGGUNGAN = '$prefix_input' 
							AND NOPERTANGGUNGAN = '$noper_input' 
							AND KDBENEFIT = '$kdbenefit_input' ";
			// echo $sql_update;
			// die();	
			$DB2->parse($sql_update);
			if($DB2->execute()){
				echo "Update Extra Premi Benefit ".$kdbenefit_input." Berhasil";echo "</br>";
				$nopolbaru = $nopolbaru_input;
			}
		}else{
			$sql_insert = "INSERT INTO $DBUser.tabel_223_extra_premi(
								PREFIXPERTANGGUNGAN,
								NOPERTANGGUNGAN,
								KDBENEFIT,
								NILAI,
								NILAI_BASISJUA,
								NILAI_BASISHOBI,
								TGLUPDATE,
								USERUPDATE
							)
							VALUES (
								'$prefix_input',
								'$noper_input',
								'$kdbenefit_input',
								$basis_coicor,
								$basis_jua,
								$basis_hobi, 
								sysdate,
								'$userid'
							)";
			// echo $sql_insert;
			// die();
			$DB2->parse($sql_insert);
			if($DB2->execute()){
				echo "Insert Extra Premi Benefit ".$kdbenefit_input." Berhasil";echo "</br>";
				$nopolbaru = $nopolbaru_input;
				echo "NOPOL BARU : ".$nopolbaru_input;
			}
		}	
	}		
			// if ($DB->errormessage) {
			// 	echo "<font face='Verdana' size='2' color='red'>Gagal, error : $DB->errorstring</font><br /><br />";
			// } else {
			// 	echo "<font face='Verdana' size='2' color='green'><u><b>Sukses, Input Extra Premi berhasil disimpan!</b></u></font><br /><br />";

			// 	$prefixpertanggungan = "";
			// 	$nopertanggungan = "";
			// }
		
	


?>

<html>
	<head>
		<script language="JavaScript" type="text/javascript" src="../includes/validasi.js"></script>
		<script language="JavaScript" type="text/javascript" src="../includes/highlight.js"></script>
		<script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
		<script language="JavaScript" type="text/javascript" src="../libs/ckeditor/ckeditor.js"></script>		
		<link href="../jws.css" rel="stylesheet" type="text/css">

		<script>
			function myFunction() {
				if(confirm('Pastikan nilai ekstra premi (%) yang dimasukan sudah sesuai!')){
		        window.location.reload();
		    }
		    return false;
			}
		</script>

	</head>

	<body>
		<h4 class="verdana10blk">INPUT EXTRA PREMI - PRODUK LINK</h4>
		<hr size=1>		
		<form id="porm" name="porm" method="post" action="<?echo $PHP_SELF;?>">

		<input type="hidden" name="mbah" value="<?echo $mbah;?>">
		<table border="0" width="100%" cellspacing="3" cellpadding="1" class="tblisi">
			<tr>
				<td class="verdana10blk" width="10%">
					Nomor Polis Baru
				</td>
				<td>: 
					<input type="text" name="nopolbaru" class="c" size="15" maxlength="15" value="<?echo $nopolbaru;?>">
				</td>
			</tr>

<!-- 			<tr>
				<td class="verdana10blk" width="10%">
					Nomor Polis Lama
				</td>
				<td>: 
					<input type="text" name="prefixpertanggungan" class="c" size="3" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
					<input type="text" name="nopertanggungan" class="c" size="11" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>">
				</td>
			</tr> -->
			<tr>
				<td>&nbsp;</td>
				<td align="left">
					&nbsp;
					<? echo "<input $disabel type=\"submit\" value=\"Submit\" name=\"submit\">";?>	
				</td>
			</tr>
		</table>
		<hr size="1"> 

		<? 

			if(isset($submit) || ($nopolbaru!="")){

				$sql = "SELECT A.PREFIXPERTANGGUNGAN,
							A.NOPERTANGGUNGAN,
							A.NOPOLBARU,
							NVL(A.NOPOLBARU, A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN) NOMOR_POLIS,
							A.KDPRODUK,
							(SELECT NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK WHERE KDPRODUK = A.KDPRODUK) NAMA_PRODUK,
							A.KDSTATUSFILE,
							(SELECT NAMASTATUSFILE FROM $DBUser.TABEL_299_STATUS_FILE WHERE KDSTATUSFILE = A.KDSTATUSFILE) STATUS_POLIS,
							TO_CHAR(A.MULAS, 'DD/MM/YYYY') MULAS,
							A.JUAMAINPRODUK,
							A.KDCARABAYAR,
							(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR = A.KDCARABAYAR) CARABAYAR,
							A.PREMI1,
							A.PREMI2,
							A.PREMISTD,
							A.NOPEMEGANGPOLIS,
							B.NAMAKLIEN1 AS NAMA_PP,
							A.NOTERTANGGUNG,
							C.NAMAKLIEN1 AS NAMA_TU,
							(SELECT NOTASI FROM $DBUser.TABEL_304_VALUTA WHERE KDVALUTA = A.KDVALUTA) NOTASI,
							A.USIA_TH, 
							A.USIA_BL,
							A.LAMAASURANSI_TH,
							FLOOR((MONTHS_BETWEEN(SYSDATE,C.TGLLAHIR))/12) USIA_TH_NOW,
							MOD((FLOOR(MONTHS_BETWEEN(SYSDATE,C.TGLLAHIR))),12) USIA_BL_NOW,
							C.JENISKELAMIN AS JENISKELAMIN_TU,
							FLOOR((MONTHS_BETWEEN(SYSDATE,B.TGLLAHIR))/12) USIA_TH_NOW_PP,
							MOD((FLOOR(MONTHS_BETWEEN(SYSDATE,B.TGLLAHIR))),12) USIA_BL_NOW_PP
                        FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        LEFT JOIN $DBUser.TABEL_100_KLIEN B ON B.NOKLIEN = A.NOPEMEGANGPOLIS
                        LEFT JOIN $DBUser.TABEL_100_KLIEN C ON C.NOKLIEN = A.NOTERTANGGUNG
						WHERE A.KDPRODUK LIKE 'JL4%'
							AND (A.NOPOLBARU = '$nopolbaru' OR A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN = '$nopolbaru')
							--AND A.KDPERTANGGUNGAN = '2'
							AND A.KDSTATUSFILE IN ('1', '4', 'A')";
				// echo $sql;
				$DB->parse($sql);
				$DB->execute();
				$arr=$DB->nextrow();

				if($arr["NOMOR_POLIS"]==$nopolbaru){ ?>
					<table width="100%" border="0" class="verdana8blu" cellspacing="2" cellpadding="2">
						<tr>
							<td width="20%">Nomor Polis Baru</td>
							<td width="1%">:</td>
							<td>
								<input type="text" name="nopolbarux" value=<?=$arr["NOMOR_POLIS"]; ?> readonly />
							</td>
						</tr>
						<tr>
							<td width="20%">Nomor Polis Lama</td>
							<td width="1%">:</td>
							<td>
								<input type="text" name="nomorpolis" value=<?=$arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"]; ?> readonly />
							</td>
						</tr>
						<tr>
							<td>Nama Pemegang Polis</td>
							<td>:</td>
							<td><?=$arr['NOPEMEGANGPOLIS']?> - <?=$arr['NAMA_PP']?></td>
						</tr>
						<tr>
							<td>Nama Tertanggung</td>
							<td>:</td>
							<td><?=$arr['NOTERTANGGUNG']?> - <?=$arr['NAMA_TU']?></td>
						</tr>
						<tr>
							<td>Kode Produk</td>
							<td>:</td>
							<td><?=$arr['KDPRODUK']?> - <?=$arr['NAMA_PRODUK']?></td>
						</tr>
						<tr>
							<td>Status Polis</td>
							<td>:</td>
							<td><?=$arr['STATUS_POLIS']?></td>
						</tr>
						<tr>
							<td>Mulas</td>
							<td>:</td>
							<td><?=$arr['MULAS']?></td>
						</tr>
						<tr>
							<td>JUA</td>
							<td>:</td>
							<td><?=$arr['NOTASI']?>. <?=number_format($arr['JUAMAINPRODUK'],2,",",".");?></td>
						</tr>
						<tr>
							<td>Cara Bayar</td>
							<td>:</td>
							<td><?=$arr['CARABAYAR']?></td>
						</tr>
						<tr>
							<td>Premi 1 / Premi 2</td>
							<td>:</td>
							<td><?=$arr['NOTASI']?>. <?=number_format($arr['PREMI1'],2,",",".");?>  /  <?=$arr['NOTASI']?>. <?=number_format($arr['PREMI2'],2,",",".");?></td>
						</tr>
						<tr>
							<td>Premi Standard</td>
							<td>:</td>
							<td><?=$arr['NOTASI']?>. <?=number_format($arr['PREMISTD'],2,",",".");?></td>
						</tr>
						<tr>
							<td>Usia Masuk</td>
							<td>:</td>
							<td><?=$arr['USIA_TH']?> Tahun <?=$arr['USIA_BL']?> Bulan</td>
						</tr>
						<tr>
							<td>Usia Saat Ini</td>
							<td>:</td>
							<td><?=$arr['USIA_TH_NOW']?> Tahun <?=$arr['USIA_BL_NOW']?> Bulan</td>
						</tr>
					</table>

					<hr size="1">

					<table border="0" cellspacing="1" cellpadding="4" width="80%" bordercolor="#B3CFFF" style="font-size: 10px; font-family: verdana;">
						<tr bgcolor="#b1c8ed" align="center">
							<td rowspan="2" width="5%">NO</td>
							<td rowspan="2" width="10%">KDBENEFIT</td>
							<td rowspan="2" width="40%">NAMA BENEFIT</td>
							<td colspan="3">PERSENTASE KENAIKAN (%)</td>
							<td rowspan="2" width="20%">NILAI / PREMI</td>
							<td rowspan="2" width="15%">ACTION</td>
						</tr>
						<tr bgcolor="#b1c8ed" align="center">
							<td>BASIS COI/COR (%)</td>
							<td>BASIS JUA (%)</td>
							<td>BASIS HOBI (%)</td>
						</tr>
						<?php
							$sql_b = "SELECT A.PREFIXPERTANGGUNGAN, 
											A.NOPERTANGGUNGAN,
											A.KDBENEFIT,
											A.PREMI,
											--A.NILAIBENEFIT,
											(SELECT JUAMAINPRODUK FROM $DBUser.TABEL_200_PERTANGGUNGAN 
												WHERE PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
													AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)NILAIBENEFIT,
											A.KDJENISBENEFIT,
											B.NAMABENEFIT,
											NVL(C.NILAI, 0) NILAI_BASISCOICOR,
											NVL(C.NILAI_BASISJUA, 0) NILAI_BASISJUA,
											NVL(C.NILAI_BASISHOBI, 0) NILAI_BASISHOBI
										FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK A
										LEFT JOIN $DBUser.tabel_207_kode_benefit B ON B.KDBENEFIT = A.KDBENEFIT
										LEFT JOIN $DBUser.TABEL_223_EXTRA_PREMI C ON A.PREFIXPERTANGGUNGAN = C.PREFIXPERTANGGUNGAN AND A.NOPERTANGGUNGAN = C.NOPERTANGGUNGAN AND A.KDBENEFIT = C.KDBENEFIT
										WHERE A.PREFIXPERTANGGUNGAN = '".$arr["PREFIXPERTANGGUNGAN"]."'
											AND A.NOPERTANGGUNGAN = '".$arr["NOPERTANGGUNGAN"]."'
											AND A.KDBENEFIT = 'COI'
									UNION 
										SELECT A.PREFIXPERTANGGUNGAN, 
											A.NOPERTANGGUNGAN,
											A.KDBENEFIT,
											A.PREMI,
											A.NILAIBENEFIT,
											A.KDJENISBENEFIT,
											B.NAMABENEFIT,
											NVL(C.NILAI, 0) NILAI_BASISCOICOR,
											NVL(C.NILAI_BASISJUA, 0) NILAI_BASISJUA,
											NVL(C.NILAI_BASISHOBI, 0) NILAI_BASISHOBI
										FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK A
										LEFT JOIN $DBUser.tabel_207_kode_benefit B ON B.KDBENEFIT = A.KDBENEFIT 
										LEFT JOIN $DBUser.TABEL_223_EXTRA_PREMI C ON A.PREFIXPERTANGGUNGAN = C.PREFIXPERTANGGUNGAN AND A.NOPERTANGGUNGAN = C.NOPERTANGGUNGAN AND A.KDBENEFIT = C.KDBENEFIT
										WHERE A.PREFIXPERTANGGUNGAN = '".$arr["PREFIXPERTANGGUNGAN"]."'
											AND A.NOPERTANGGUNGAN = '".$arr["NOPERTANGGUNGAN"]."'
											AND A.KDJENISBENEFIT = 'R' 
											AND A.PREMI IS NOT NULL";
							// echo $sql_b;
							$DB2->parse($sql_b);
							$DB2->execute();
							$i=1;
							while ($arr_b=$DB2->nextrow()) {

								if($arr_b["KDBENEFIT"] == 'WPCI51'){
									$kdtarif = 'WPCI';
									$pembagi = 100;
									$filterjnsklm = "";
									$filterusia = $arr["USIA_TH_NOW"];

								}else if($arr_b["KDBENEFIT"] == 'WPTPD'){
									$kdtarif = 'WAIVER';
									$pembagi = 100;
									$filterjnsklm = "";
									$filterusia = $arr["USIA_TH_NOW"];

								}else if(in_array($arr_b["KDBENEFIT"], array('CP19100RWI', 'CP19200RWI', 'CP19300RWI', 'CP19400RWI', 'CP19500RWI', 'CP19600RWI', 'CP19700RWI', 'CP19800RWI', 'CP19900RWI', 'CP191000RWI', 'CP191JTRWI'))){
									$kdtarif = str_replace('RWI', '', $arr_b["KDBENEFIT"]);
									$kdtarif = str_replace('JT', '000', $kdtarif);

									if($arr['JENISKELAMIN_TU'] == 'L'){
										$filterjnsklm = "AND BK = '1' ";
									}else{
										$filterjnsklm = "AND BK = '0' ";
									}

									$filterusia = $arr["USIA_TH_NOW"];

								}else if(in_array($arr_b["KDBENEFIT"], array('PBD', 'PBCI', 'PTPD', 'SPBD', 'SPBCI', 'SPTPD', 'PBTPD'))){
									if($arr_b["KDBENEFIT"] == 'PBTPD'){
										$kdtarif = 'PTPD';
									}else{
										$kdtarif = $arr_b["KDBENEFIT"];
									}

									$pembagi = 1000;
									$filterjnsklm = "";
									$filterusia = $arr["USIA_TH_NOW_PP"];
								}else{
									$kdtarif = $arr_b["KDBENEFIT"];
									$pembagi = 1000;
									$filterjnsklm = "";
									$filterusia = $arr["USIA_TH_NOW"];
								}


								$sqltarif=" SELECT * 
											FROM $DBUser.tabel_205_tarip_premi 
											WHERE kdproduk = 'JL4BLN' 
												AND kdtarif = '".$kdtarif."' 
												AND kdbasis = 'TU-05/00' 
												AND usia = ".$filterusia."
												".$filterjnsklm."
											";
								// echo $sqltarif;
								$DB3->parse($sqltarif);
								$DB3->execute();
								$tarif=$DB3->nextrow();

								if(in_array($arr_b["KDBENEFIT"], array('CP19100RWI', 'CP19200RWI', 'CP19300RWI', 'CP19400RWI', 'CP19500RWI', 'CP19600RWI', 'CP19700RWI', 'CP19800RWI', 'CP19900RWI', 'CP191000RWI', 'CP191JTRWI'))){
									$biaya_dasar = $tarif["TARIF"] / 12;
								}else{
									$biaya_dasar = $tarif["TARIF"] * $arr_b["NILAIBENEFIT"] / $pembagi / 12;
								}

						?>
								<form name="porm3" method="post" action="<?echo $PHP_SELF;?>">
								<tr>
									<td align="center">
										<?=$i;?>
										<input type="hidden" name="nopolbaru_input" value="<?=$arr["NOMOR_POLIS"];?>">
										<input type="hidden" name="prefix_input" value="<?=$arr_b["PREFIXPERTANGGUNGAN"];?>" >
										<input type="hidden" name="noper_input" value="<?=$arr_b["NOPERTANGGUNGAN"];?>">
										<input type="hidden" name="kdbenefit_input" value="<?=$arr_b["KDBENEFIT"];?>" >	
									</td>
									<td align="center"><?=$arr_b["KDBENEFIT"];?></td>
									<td align="center"><?=$arr_b["NAMABENEFIT"];?></td>
									<td><input type="number" name="basis_coicor" step="any" value="<?=$arr_b['NILAI_BASISCOICOR'];?>"></td>
									<td><input type="number" name="basis_jua" step="any" value="<?=$arr_b['NILAI_BASISJUA'];?>"></td>
									<td><input type="number" name="basis_hobi" step="any" value="<?=$arr_b['NILAI_BASISHOBI'];?>"></td>
									<td>
										<?php
											$kenaikan_basiscoicor = (($biaya_dasar * 1000 * 12 / $arr_b["NILAIBENEFIT"]) / 1000) * ($arr_b["NILAIBENEFIT"] * ($arr_b["NILAI_BASISCOICOR"] / 100)) / 12;
											$kenaikan_basisjua = $arr_b["NILAIBENEFIT"] * $arr_b["NILAI_BASISJUA"] / 100 / 12;
											$kenaikan_basishobi = $arr_b["NILAIBENEFIT"] * $arr_b["NILAI_BASISHOBI"] / 100 / 12;
											$total_nilai = $biaya_dasar + $kenaikan_basiscoicor + $kenaikan_basisjua + $kenaikan_basishobi;
											// echo "BIAYA DASAR : ".$biaya_dasar."</br>";
											// echo "KENAIKAN COICOR : ".$kenaikan_basiscoicor."</br>";
											// echo "KENAIKAN JUA : ".$kenaikan_basisjua."</br>";
											// echo "KENAIKAN HOBI : ".$kenaikan_basishobi."</br>";

											echo number_format($total_nilai,2,",",".");
										?>
									</td>
									<td align="center"><input type="submit" value=" Update " name="update_cor" onclick="myFunction()"></td>
								</tr>
								</form>

						<?php
								$i++;
							}
						?>

					</table>

				</form>
				
				<? } else {
					echo "<span style=color:red>Nomor Polis ini Tidak ditemukan</span>";
				}
			} else{
				
			}
		?>
	</body>
</html>
