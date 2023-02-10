<?
	include "../../includes/database.php"; 
	//include "../../includes/klien.php";
	include "../../includes/pertanggungan.php"; 
	include "../../includes/session.php"; 
	$DB=New database($userid, $passwd, $DBName);	
	$PER=New Pertanggungan($userid,$passwd,$kantor,$noproposal);
	$kelompok = substr($PER->produk, 0, 2) == 'JL' ? 'U' : 'T';
	$ul = $kelompok == 'T' ? 0 : 1;
	//$noklien=$PER->notertanggung;
	$today = date("d F Y"); 
	
	$sql = "select a.notertanggung, b.namaklien1, b.jeniskelamin, decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk, a.nopolbaru 
			from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b 
			where b.noklien=a.notertanggung and a.prefixpertanggungan='$kantor' and a.nopertanggungan='$noproposal'";
	$DB->parse($sql);
	$DB->execute();
	$ttg=$DB->nextrow();
	$noklien=$ttg["NOTERTANGGUNG"];
	$namaklien=$ttg["NAMAKLIEN1"];
	$jnskelamin=$ttg["JENISKELAMIN"];
	
	// Proses insert ke tabel_118_cek_skk
	$sql = "SELECT a.kditem, b.namaitem, a.kdstatus, a.keterangan
			FROM $DBUser.tabel_119_ket_kesehatan a
			INNER JOIN $DBUser.tabel_999_item_kesehatan b ON a.kditem = b.kditem
			WHERE a.noklien = '$noklien'
			ORDER BY kditem";
	$DB->parse($sql);
	$DB->execute();
	while ($r = $DB->nextrow()) {
		//var_dump($r); echo"<br>";
		if ($kelompok == 'T') {
			$alkohol = $r['KDITEM'] == '1A' ? $r['KDSTATUS'] : $alkohol;
			$rokok = $r['KDITEM'] == '1B' ? $r['KDSTATUS'] : $rokok;
			$lukaberat = $r['KDITEM'] == '3A' ? $r['KDSTATUS'] : $lukaberat;
			$sehat = $r['KDITEM'] == '3B' ? (empty($r['KDSTATUS']) ? 'Y' : '') : $sehat;
			$kerjabaik = $r['KDITEM'] == '3C' ? (empty($r['KDSTATUS']) ? 'Y' : '') : $kerjabaik;
			$haid = $r['KDITEM'] == '4A' ? $r['KDSTATUS'] : $haid;
			$hamil = $r['KDITEM'] == '4B' ? $r['KDSTATUS'] : $hamil;
			$lahir = $r['KDITEM'] == '4C' ? $r['KDSTATUS'] : $lahir;
			$gugur = $r['KDITEM'] == '4D' ? $r['KDSTATUS'] : $gugur;
			$narkoba = '';
		} else {
			$alkohol = $r['KDITEM'] == '#5A' ? $r['KDSTATUS'] : $alkohol;
			$rokok = $r['KDITEM'] == '#6A' ? $r['KDSTATUS'] : $rokok;
			$lukaberat = $r['KDITEM'] == '#8A' ? $r['KDSTATUS'] : $lukaberat;
			$sehat = $r['KDITEM'] == '#8B' ? $r['KDSTATUS'] : $sehat;
			$kerjabaik = $r['KDITEM'] == '#8C' ? $r['KDSTATUS'] : $kerjabaik;
			$haid = '';
			$hamil = '';
			$lahir = '';
			$gugur = '';
			$narkoba = $r['KDITEM'] == '#4A' ? $r['KDSTATUS'] : $narkoba;
		}
	}
	
	$sql = "INSERT INTO $DBUser.tabel_118_cek_skk (noklien, cekgejala, cekrawatinappulih, cekdiagnosa, ceknarkoba, 
				cekrawatinap, ceklukaberat, cekpapsmear, cekhaid, cekhamil, cekmelahirkan, cekkeguguran, 
				cekcaesar, cekkomplikasihamil, status, keterangan, ceksehat, cekkerjabaik, ketcekkeguguran, 
				cekmerokok, cekobatlain, cekalkohol, cekhobby)
			VALUES ('$noklien', null, null, null, '$narkoba', null, '$lukaberat', null, '$haid', '$haid', '$lahir', '$gugur',
				null, null, null, null, '$sehat', '$kerjabaik', null, '$rokok', null, '$alkohol', null)";
	$DB->parse($sql);
	$DB->execute();
	//var_dump($DB);
//exit;
?>
<html>
<head>
<title>Data Kesehatan Lanjutan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<div align="center">
<form name="formisianskk" method="post" action=<? echo $PHP_SELF; ?>>
<input type="hidden" name="noklien" value=<? echo $noklien; ?>>
<table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td width="16%" colspan="2" class="arial10">Nomor Proposal</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><!--?echo $kantor." - ".$noproposal;?--><?=$ttg['NOPOLBARU']?></td><br>
				  <td width="53%" colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><?echo $today;?></td>
        	<td width="53%" colspan="3" class="verdana8" align="center">Beri Tanda V Pada Kolom Yang Sesuai.</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tertanggung</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb" align="left">
					<?	
					 echo $namaklien;
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $PER->notertanggung." - ".$KLIEN->nama; 
					?></td>
          <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>
        <tr>
          <td width="16%" colspan="2" class="arial10">Jenis Kelamin</td>
					<td width="1%"class="arial10" align="center">:</td>
          <td width="30%"class="verdana10blkb" align="left">
					<?	
					 echo $ttg["NAMAJK"];
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $KLIEN->namajk; 
					?></td>
         <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>				
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">F O R M U L I R&nbsp;&nbsp;&nbsp;&nbsp;I S I A N</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Anda Telah Selesai Mengisi Surat Keterangan Kesehatan, <b>Terima Kasih!</b></td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td width="5%" class="c" align="center">Kode</td>
					<td width="45%" class="c" align="center">Pertanyaan</td>
					<td width="50%" class="c" align="center">Jawaban</td>
				</tr>
<?
	$sql = "SELECT a.kditem, a.keterangan, a.kdstatus, b.namaitem
			FROM $DBUser.tabel_119_ket_kesehatan a
			INNER JOIN $DBUser.tabel_999_item_kesehatan b ON a.kditem = b.kditem
			WHERE a.noklien = '$noklien'
			ORDER BY kditem";
	$DB->parse ($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {
		include "../../includes/belang.php";
		if ((strlen($arr["KDITEM"])==1 && $kelompok == 'T') || (strlen($arr['KDITEM'])==2 && $kelompok == 'U')) {
			$kelas="arial10bold";
			$col=2;
			$align="left";
			$ket='';
		} else if  ((strlen($arr["KDITEM"])==2 && $kelompok == 'T') || (strlen($arr['KDITEM'])=='3' && $kelompok == 'U')) {
			$kelas="arial10";
			$col='';
			$align="center";
			$ket=": ".($arr['KDSTATUS']=='Y'?'Ya':'Tidak');
		} else if ((strlen($arr["KDITEM"])==3 && $kelompok == 'T') || (strlen($arr['KDITEM']) && $kelompok == 'U')) {
			$kelas="arial10";
			$col='';
			$align="right";
			$ket=": ".$arr["KETERANGAN"];
		}
		echo "<td width=\"5%\" class=\"$kelas\" align=\"$align\">".substr($arr["KDITEM"],-1)."&nbsp;&nbsp;</td>";
		echo "<td width=\"45%\" class=\"$kelas\" colspan=\"$col\">".$arr["NAMAITEM"]."</td>";
		echo "<td width=\"50%\" class=\"$kelas\">$ket</td>";
		echo "</tr>";
		$i++;
	}
?>
			</table><p>&nbsp;</p>
    </td>
  </tr>
</table>
<table width="700" border="0">
	<tr>
  	<td align="left" class="arial10"><a href="#" onClick="window.history.go(-1)">Back</a></td>
	  <td align="right">
	  		<input type="button" onClick="<?="window.open('skk_print.php?no_proposal=$noproposal&ul=$ul', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,fullscreen=yes');"?>;" value="Cetak" >
			<input type="button" name="button" value="Selesai" onClick="window.location.replace('../mnuptgbaru.php')">
		</td>
  </tr>
  <tr>
	</tr>
</table>
</form>
</body>
</html>
