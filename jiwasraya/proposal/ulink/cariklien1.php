<?php
	include "./includes/session.php";
	include "./includes/database.php";

	$DB=New database($userid, $passwd, $DBName);
	
	$sql = "SELECT a.namaklien1, a.tinggibadan, a.beratbadan, TO_CHAR(a.tgllahir, 'dd/mm/yyyy') tgllahir
			FROM $DBUser.tabel_spaj_online_klien a
			INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
				AND b.statusklien IN (1, 3)
				AND b.relasi = '04'
			WHERE b.nospaj = '$nosp'";
	$DB->parse($sql);
	$DB->execute();
	$r = $DB->nextrow();
	$namaklien1 = strtoupper(strtolower(empty($namaklien1) && !$submit ? trim($r['NAMAKLIEN1']) : $namaklien1));
	$tgllahir = empty($tgllahir) && !$submit ? trim($r['TGLLAHIR']) : $tgllahir;
?>
<html>
	<head>
		<title>Daftar Klien</title>
		<link href="./includes/jws.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/javascript" src="./includes/validasi.js"></script>
		<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
		<script language="JavaScript" type="text/javascript">
			function Cari(theForm) {
				var a=theForm.noklien.value
				if (!a=='') {
					window.location.replace('cariklien1.php?no='+a+'')
				}
			}

			function CariNama(theForm) {
				var n=theForm.namaklien.value
				if (!n=='') {
					window.location.replace('cariklien1.php?nama='+n+'')
				}
			}
		</script>
	</head>
	
	<body topmargin=0>
		<div align=center>
			<table width="100%">
			<tr>
				<td align="right"><font face="Verdana" size="1" color="#0033CC">F1331</font></td>
			</tr>
			<tr>
				<td align="center"><font face="Verdana" size="2" color="#0033CC"><b>DAFTAR KLIEN</b></font></td>
			</tr>
			</table>

			<table width="100%">
			<form name="klien" method="post" action="<?echo $PHP_SELF;?>">
			<tr class="tblisi">
				<td class="verdana8" colspan="7">
					<input type="hidden" name="nosp" value="<?=$nosp?>" />
					Nama Klien : <input type="text" name="namaklien1" size="20" class="c" onFocus="highlight(event)" value="<?=$namaklien1?>">
					Tgl Lahir : <input type="text" name="tgllahir" size="8" class="c" onFocus="highlight(event)" value="<?=$tgllahir?>">
					<input type="submit" name="submit" value="Cari" />
					<input type="button" name="reset" value="Reset" onclick="window.location.href='?nosp=<?=$nosp?>'" />
				</td>
				<!--td class="verdana8" colspan="7" style="padding:3px 0;">Daftar klien jlindo yang mirip dengan klien e-spaj : <b><?=strtoupper(strtolower($r['NAMAKLIEN1']))?></b> dengan tanggal lahir <b><?=$r['TGLLAHIR']?></b></td-->
			</tr>
			<tr>
				<td colspan="7" class="ver8ungu" align=right>
					<!--<a href="#" onclick="window.location.replace('cariklien1.php?hi=1')">Cari Klien Yang Dientry Hari Ini</a>
					<a href="#">Cari Klien Yang Dientry Hari Ini</a>-->
				</td>
			</tr>
			<tr>
				<td colspan="7" class="ver8ungu" align=right><hr size="1"></td>
			</tr>
			<tr class="hijao" >
				<td>No</td>
				<td align="center">Nomor Klien</td>
				<td align="center">Nama Klien</td>
				<td align="center">Tinggi(cm)</td>
				<td align="center">Berat(kg)</td>
				<td align="center">Tgl Lahir</td>
				<td align="center">Edit TB/BB</td>
			</tr>
			<?php
			$sql = "SELECT noklien, namaklien1, gelar, tinggibadan, beratbadan, TO_CHAR(tgllahir, 'dd/mm/yyyy') tgllahir
					FROM $DBUser.tabel_100_klien a
					WHERE TO_CHAR(tgllahir, 'dd/mm/yyyy') LIKE '%$tgllahir%'
						AND UPPER(namaklien1) LIKE UPPER('%$namaklien1%')
					ORDER BY namaklien1, a.tgllahir";
			$DB->parse($sql);
			$DB->execute();
			$i = 0;
			while ($arr = $DB->nextrow()) { $i++;
				include "./includes/belang.php"; ?>
				<td align='center' class='verdana8'><?=$i?></td>
				<?php if (empty($arr['TINGGIBADAN']) || empty($arr['BERATBADAN']) || empty($arr['TGLLAHIR'])) { ?>
					<td align='center' class='arial10ungu'><?=$arr['NOKLIEN']?></td>
				<?php } else { ?>
					<td align='center' class='verdana8'><a href="#" onclick="javascript:window.opener.document.ntryprop.notertanggung.value='<?=$arr['NOKLIEN']?>';window.close();"><?=$arr['NOKLIEN']?></a></td>
				<?php } ?>
				<td class='verdana8'><?=$arr['NAMAKLIEN1']?></td>
				<td class='verdana8' align='center'><?=$arr["TINGGIBADAN"]?></td>
				<td class='verdana8' align='center'><?=$arr["BERATBADAN"]?></td>
				<td class='verdana8' align='center'><?=$arr["TGLLAHIR"]?></td>
				<td class='verdana8' align='center'>
					<?php if (empty($arr['TINGGIBADAN']) || empty($arr['BERATBADAN']) || empty($arr['TGLLAHIR'])) { ?>
						<a href="./klien/editclntmain.php?noklien=<?=$arr["NOKLIEN"]."&namaklien=".$arr["NAMAKLIEN1"]?>">Edit</a>
					<?php } ?>
				</td>
			<?php } ?>
			<tr>
				<td colspan="7" class="ver8ungu" align=right><hr size="1"></td>
			</tr>
			<tr class="tblisi">
				<td class="verdana8" colspan="7" style="padding:3px 0;">Tidak menemukan klien yang dicari! <br>Apakah Anda ingin menambahkan <b><?=strtoupper(strtolower($r['NAMAKLIEN1']))?></b> sebagai klien baru?</td>
			</tr>
			<tr class="hijao" >
				<td>No</td>
				<td align="center" colspan='2'>Nama Klien</td>
				<td align="center">Tinggi(cm)</td>
				<td align="center">Berat(kg)</td>
				<td align="center">Tgl Lahir</td>
				<td align="center">Tambah</td>
			</tr>
			<tr>
				<td align='center' class='verdana8'>1</td>
				<td align='left' class='verdana8' colspan='2'><?=strtoupper(strtolower($r['NAMAKLIEN1']))?></td>
				<td align="center" class='verdana8'><?=$r['TINGGIBADAN']?></td>
				<td align="center" class='verdana8'><?=$r['BERATBADAN']?></td>
				<td align="center" class='verdana8'><?=$r['TGLLAHIR']?></td>
				<td align="center" class='verdana8'>
					<a href="javascript:void(0);" onclick="javascript:window.opener.getdataklien('<?=$nosp?>');window.close();">Tambah</a>
				</td>
			</tr>
			</table>
			</form>
		</div>
	</body>
</html>	
