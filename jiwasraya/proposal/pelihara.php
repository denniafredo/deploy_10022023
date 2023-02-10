<?php
 	include "../../includes/database.php";
	include "../../includes/common.php";
	$DB=New database($DBUser, $DBPass, $DBName);
	
	$sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, a.nopolbaru,
				b.namaklien1 namapemegangpolis, c.namaklien1 namatertanggung, b.noid, b.namaibukand, b.alamattetap01, b.alamattagih01,
				INITCAP(TRIM(TO_CHAR(b.tgllahir, 'DAY','nls_date_language = INDONESIAN')) || TO_CHAR(b.tgllahir, ', DD ') || TRIM(TO_CHAR(b.tgllahir, 'MONTH','nls_date_language = INDONESIAN')) || TO_CHAR(b.tgllahir, ' YYYY')) tgllahir,
				b.phonetagih01, b.phonetagih02,
				NVL(b.NO_PONSEL, NVL(b.PHONETAGIH01, NVL(b.PHONETAGIH02,NVL(b.PHONETETAP01, b.PHONETETAP02)))) PHONE,
				NVL(b.emailtagih,b.emailtetap) email_pp,
				d.namaproduk, a.premi1, a.juamainproduk, e.namacarabayar,
				INITCAP(TRIM(TO_CHAR(a.mulas, 'DAY','nls_date_language = INDONESIAN')) || TO_CHAR(a.mulas, ', DD ') || TRIM(TO_CHAR(a.mulas, 'MONTH','nls_date_language = INDONESIAN')) || TO_CHAR(a.mulas, ' YYYY')) mulas,
				INITCAP(TRIM(TO_CHAR(ADD_MONTHS(a.mulas, lamaasuransi_th*12), 'DAY','nls_date_language = INDONESIAN')) || TO_CHAR(ADD_MONTHS(a.mulas, lamaasuransi_th*12), ', DD ') || TRIM(TO_CHAR(ADD_MONTHS(a.mulas, lamaasuransi_th*12), 'MONTH','nls_date_language = INDONESIAN')) || TO_CHAR(ADD_MONTHS(a.mulas, lamaasuransi_th*12), ' YYYY')) akhas 
			FROM $DBUser.tabel_200_pertanggungan a
			LEFT OUTER JOIN $DBUser.tabel_100_klien b ON a.nopemegangpolis = b.noklien
			LEFT OUTER JOIN $DBUser.tabel_100_klien c ON a.notertanggung = c.noklien
			LEFT OUTER JOIN $DBUser.tabel_202_produk d ON a.kdproduk = d.kdproduk
			LEFT OUTER JOIN $DBUser.tabel_305_cara_bayar e ON e.kdcarabayar = a.kdcarabayar
			WHERE a.nopolbaru = '$nopolbaru'
				OR a.nopol = '$nopol'";
	$DB->parse($sql);
	$DB->execute();
	$r = $DB->nextrow();
?>

<html>
<head>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>
	<font face="Verdana" size="2"><b>Informasi Polis</b></font>
	<hr size=1>
	
	<form name="porm" method="get" action="pelihara.php">
		<table border="0" width="100%" cellspacing="3" cellpadding="1" class="tblisi">
			<tr>
				<td class="verdana10blk" width="300">Nomor Polis Baru</td>
				<td width="10">:</td>
				<td><input type="text" name="nopolbaru" class="c" size="20" maxlength="15" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();" value="<?=$nopolbaru?>"></td>
			</tr>
			<tr>
				<td class="verdana10blk">Atau Nomor Polis Lama</td>
				<td>:</td>
				<td>
					<input type="text" name="nopol" class="c" size="11" maxlength="11" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();" value="<?=$nopol?>">
					<i style="font-size:13px">Contoh : (XX999999999)</i>
				</td>
			</tr>
			<tr>
				<td colspan="2"></td>
				<td>
					<input type="submit" value="Submit" name="cari" />
					<input type="button" value="Refresh" onclick="window.location.href='pelihara.php'" name="refresh" />
				</td>
			</tr>
		</table>
	</form>
	
	<hr size=1>
	
	<?php if ($nopolbaru || $nopol) { ?>
	<div align="center">
		<table border="0" cellspacing="1" cellpadding="1" width="80%" class="tblisi">
			<tr class="tblhead">
				<th class="arial12whtb" colspan="2">
					<b>POLIS NOMOR <?="$r[NOPOLBARU] / $r[PREFIXPERTANGGUNGAN]$r[NOPERTANGGUNGAN]"?></b>
				</th>
			</tr>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td width="50%" class="tblhead arial12whtb">Data Umum Polis</td>
				<td class="tblhead arial12whtb">Data Pertanggungan</td>
			</tr>
			<tr>
				<td>
					<table border="0" cellspacing="1" cellpadding="1" width="100%">
						<tr>
							<td width="200" class="verdana8blk"><b>Nama Pemegang Polis</b></td>
							<td class="verdana8blk"><b><?=$r['NAMAPEMEGANGPOLIS']?></b></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk"><b>Nama Tertanggung</b></td>
							<td class="verdana8blk"><b><?=$r['NAMATERTANGGUNG']?></b></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">No KTP</td>
							<td class="verdana8blk"><?=$r['NOID']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Tgl Lahir Pemegang Polis</td>
							<td class="verdana8blk"><?=$r['TGLLAHIR']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Nama Ibu Kandung</td>
							<td class="verdana8blk"><?=$r['NAMAIBUKAND']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Alamat Tetap</td>
							<td class="verdana8blk"><?=$r['ALAMATTETAP01']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Alamat Korespondensi</td>
							<td class="verdana8blk"><?=$r['ALAMATTAGIH01']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">No HP Korespondensi</td>
							<td class="verdana8blk"><?=$r['PHONE']?></td>
							<!-- <td class="verdana8blk"><?=$r['PHONETAGIH01'].($r['PHONETAGIH02'] ? ", $r[PHONETAGIH02]" : "")?></td> -->
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Email</td>
							<td class="verdana8blk"><?=$r['EMAIL_PP']?></td>
						</tr>
					</table>
				</td>
				<td valign="top">
					<table border="0" cellspacing="1" cellpadding="1" width="100%">
						<tr>
							<td width="200" class="verdana8blk">Nama Produk</td>
							<td class="verdana8blk"><?=$r['NAMAPRODUK']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Mulai Asuransi</td>
							<td class="verdana8blk"><?=$r['MULAS']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Akhir Asuransi</td>
							<td class="verdana8blk"><?=$r['AKHAS']?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Premi</td>
							<td class="verdana8blk"><?=number_format($r['PREMI1'], 0, ",", ".")?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Dana Awal</td>
							<td class="verdana8blk"><?=number_format(0, 0, ",", ".")?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Uang Asuransi</td>
							<td class="verdana8blk"><?=number_format($r['JUAMAINPRODUK'], 0, ",", ".")?></td>
						</tr>
						<tr>
							<td width="200" class="verdana8blk">Cara Bayar</td>
							<td class="verdana8blk"><?=$r['NAMACARABAYAR']?></td>
						</tr>
						<?php 
						$sql = "SELECT CASE jenis WHEN 'VA' THEN 'Virtual Account' WHEN 'HH' THEN 'Host to Host' END namajenis,
									cabangbank, noaccount
								FROM $DBUser.tabel_100_klien_account
								WHERE prefixpertanggungan = '$r[PREFIXPERTANGGUNGAN]'
									AND nopertanggungan = '$r[NOPERTANGGUNGAN]'
									AND jenis IN ('VA', 'HH')";
						$DB->parse($sql);
						$DB->execute();
						foreach ($DB->result() as $i => $v) {
						?>
						<tr>
							<td width="200" class="verdana8blk"><?="$v[NAMAJENIS] $v[CABANGBANK]"?></td>
							<td class="verdana8blk"><?=$v['NOACCOUNT']?></td>
						</tr>
						<?php } ?>
					</table>
				</td>
			</tr>
			<tr>
				<td class="tblhead arial12whtb">Manfaat Asuransi</td>
				<td class="tblhead arial12whtb">Pembayaran Manfaat</td>
			</tr>
			<tr>
				<td>
					<table border="1" cellspacing="1" cellpadding="1" width="100%">
						<tr>
							<td class="verdana8blk" align="center">Benefit</td>
							<td class="verdana8blk" align="center">Nilai</td>
							<td class="verdana8blk" align="center">Tanggal</td>
						<?php 
						$sql = "SELECT namabenefit, ROUND(a.nilaibenefit) nilaibenefit,
									INITCAP(TRIM(TO_CHAR(a.expirasi, 'DAY','nls_date_language = INDONESIAN')) || TO_CHAR(a.expirasi, ', DD ') || TRIM(TO_CHAR(a.expirasi, 'MONTH','nls_date_language = INDONESIAN')) || TO_CHAR(a.expirasi, ' YYYY')) tglexpirasi
								FROM $DBUser.tabel_223_transaksi_produk a
								INNER JOIN $DBUser.tabel_207_kode_benefit b ON a.kdbenefit = b.kdbenefit
								WHERE a.prefixpertanggungan = '$r[PREFIXPERTANGGUNGAN]'
									AND a.nopertanggungan = '$r[NOPERTANGGUNGAN]'
									AND a.nilaibenefit > 0
								ORDER BY expirasi";
						$DB->parse($sql);
						$DB->execute();
						foreach ($DB->result() as $i => $v) { ?>
							<tr>
								<td class="verdana8blk"><?=$v['NAMABENEFIT']?></td>
								<td class="verdana8blk"><?=number_format($v['NILAIBENEFIT'], 0, ',', '.')?></td>
								<td class="verdana8blk"><?=$v['TGLEXPIRASI']?></td>
							</tr>
						<?php } ?>
					</table>
				</td>
				<td>
					<table border="0" cellspacing="1" cellpadding="1" width="100%">
						<?php 
						$sql = "SELECT NVL(namabank, kdbank) namabank, cabangbank, norekening, atasnama
								FROM $DBUser.tabel_100_klien_rekening
								WHERE prefixpertanggungan = '$r[PREFIXPERTANGGUNGAN]'
									AND nopertanggungan = '$r[NOPERTANGGUNGAN]'";
						$DB->parse($sql);
						$DB->execute();
						foreach ($DB->result() as $i => $v) { ?>
							<tr>
								<td width="200" class="verdana8blk">Bank</td>
								<td class="verdana8blk"><?=$r['NAMABANK']?></td>
							</tr>
							<tr>
								<td width="200" class="verdana8blk">No Rekening</td>
								<td class="verdana8blk"><?=$r['NOREKENING']?></td>
							</tr>
							<tr>
								<td width="200" class="verdana8blk">Pemilik Rekening</td>
								<td class="verdana8blk"><?=$r['ATASNAMA']?></td>
							</tr>
						<?php } ?>
					</table>
				</td>
			</tr>
			<tr>
				<td class="tblhead arial12whtb" colspan="2">Penerima Manfaat</td>
			</tr>
			<tr>
				<td>
					<table border="0" cellspacing="1" cellpadding="1" width="100%">
						<?php 
						$sql = "SELECT b.namaklien1, c.namahubungan
								FROM $DBUser.tabel_219_pemegang_polis_baw a
								INNER JOIN $DBUser.tabel_100_klien b ON a.noklien = b.noklien
								INNER JOIN $DBUser.tabel_218_kode_hubungan c ON a.kdinsurable = c.kdhubungan
								WHERE prefixpertanggungan = '$r[PREFIXPERTANGGUNGAN]'
									AND nopertanggungan = '$r[NOPERTANGGUNGAN]'
								ORDER BY a.nourut";
						$DB->parse($sql);
						$DB->execute();
						foreach ($DB->result() as $i => $v) { ?>
							<tr>
								<td colspan="2" class="verdana8blk"><?=$i+1?>. <?=$v['NAMAKLIEN1']?> <?="($v[NAMAHUBUNGAN])"?></td>
							</tr>
						<?php } ?>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr /></td>
			</tr>
			<tr>
				<td coslpan="2">
					<input type="button" value="HISTORIS PREMI" onclick="NewWindow('<?="../akunting/kartupremi1.php?prefix=$r[PREFIXPERTANGGUNGAN]&noper=$r[NOPERTANGGUNGAN]"?>','popuptebus','1000','800','yes');return false;" style="font-size: 8pt" />
					<input type="button" value="TRANSAKSI UNIT" onclick="NewWindow('<?="../polis/mutasi_jslink3.php?prefix=$r[PREFIXPERTANGGUNGAN]&noper=$r[NOPERTANGGUNGAN]"?>','popuptebus','1000','800','yes');return false;" style="font-size: 8pt" />
					<input type="button" value="DOKUMEN" onclick="NewWindow('<?="http://sae-aws.ifg-life.id/smart_ifglife/list.php?no_polis1=".base64_encode(base64_encode("$r[PREFIXPERTANGGUNGAN]-$r[NOPERTANGGUNGAN]"))?>','popuptebus','1000','800','yes');return false;" style="font-size: 8pt" />
				</td>
			</tr>
		</table>
	</div>
	
</body>
	<?php } ?>
</html>
