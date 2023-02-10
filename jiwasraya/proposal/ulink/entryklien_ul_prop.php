<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  $DB = new database($userid, $passwd, $DBName);
  $namaklien=stripslashes($namaklien);


$sbrDana=array(0=> "1/Gaji","2/Hasil Usaha","3/Orang Tua","4/Hasil Investasi","5/Penghasilan Suami Istri","6/Lainnya");

	$sql= "select namaklien1,jeniskelamin,tempatlahir,to_char(tgllahir,'DD/MM/YYYY') tgllahir,".
				"kdid,noid,pendapatan,".
	      "gelar,kdagama,meritalstatus,kdpekerjaan,kdhobby,tinggibadan,beratbadan ".
				"from $DBUser.tabel_100_klien ".
				"where noklien='$noklien'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();
	$tgllahir = (!$tgllahir) ? $arc["TGLLAHIR"] : $tgllahir;
	$kdid = (!$kdid) ? $arc["KDID"] : $kdid;
	$noid = (!$noid) ? $arc["NOID"] : $noid;
	$jk = (!$jeniskelamin) ? $arc["JENISKELAMIN"] : $jeniskelamin;
	$namaklien1 = (!$namaklien) ? $arc["NAMAKLIEN1"] : $namaklien;
	$gelar = (!$gelar) ? $arc["GELAR"] : $gelar;
	//echo "KAMPRET".$jk;
	
?>
<html>
<head>
<title>Edit Klien</title>
<link href="../../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript">
<!--
function OnSumbit(porm) {
if ( (isNama(porm)) && (isTempatLahir(porm)) && (isTglLahir(porm)) && (isPendapatan(porm)) && (isPekerjaan(porm)))
if (confirm("Apakah isian sudah benar ?")) {
	return true;
} else {
	return false;      
} else
	return false;
}
function isNama(porm) {
  var str = porm.namaklien1.value;
	if (str == "") {
		alert("Nama Lengkap belum terisi !!")
		porm.namaklien1.focus();
		return false;
	}
	return true;
}

function isTempatLahir(porm) {
  var str = porm.tempatlahir.value;
	if (str == "") {
		alert("Silakan isi Tempat Lahir !!")
		porm.tempatlahir.focus();
		return false;
	}
	return true;
}

function isPendapatan(porm) {
  var str = porm.pendapatan.value;
	if (str == "") {
		alert("Silakan isi Pendapatan !!")
		porm.pendapatan.focus();
		return false;
	}
	return true;
}

function isPekerjaan(porm) {
  var str = porm.kdpekerjaan.value;
	if (str == "") {
		alert("Silakan isi Pekerjaan !!")
		porm.kdpekerjaan.focus();
		return false;
	}
	return true;
}


function isTglLahir(porm) {
	var tgllahir = porm.tgllahir.value;
	var th = parseInt(tgllahir.substring(6));
	var Skg = new Date();
	var thskg = Skg.getYear();
	var tglOK = true;
	if ( (tgllahir == "") && (tglOK) ) {
		alert("Silakan isi Tanggal Lahir !!")
		porm.tgllahir.focus();
		tglOK = false;
 	} else if (( th < 1900 ) && (tglOK)) {
  	alert ('Masukkan Tahun Kelahiran Yang Benar.\nUmurnya Terlalu Tua')
	  porm.tgllahir.focus();
	  tglOK = false;
	} else if (( th > thskg ) && (tglOK)) {
  	alert ('Masukkan Tahun Kelahiran Yang Benar.\nTidak Mungkin Lahir Tahun Mendatang'+th+thskg+tglOK)
	  porm.tgllahir.focus();
	  tglOK = false;
	} else if (( th <= thskg ) && (tglOK)){
 	  tglOK= true;
	} 	
  return tglOK;
}
//-->
</script>
</head>

<body>
<a class="verdana10blk"><b>KLIEN BARU</b></a>
	<?php 
	echo "<li><a class=verdana10blk href=http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link_prop.php>Entry Klien.</a></li>";
	//echo "<li><a class=verdana10blk href=http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link.php>Tertanggung (Jika Tertanggung Sebagai Pemegang Polis).</a></li>";
	//echo "<li><a class=verdana10blk href=http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link.php?mode=pempol>Pemegang Polis (Untuk SPAJ).</a></li>";
	//echo "<li><a class=verdana10blk href=http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link.php>Tertanggung.</a></li>";
	
	?>
    <br /><br />
<a class="verdana10blk"><b>PEMELIHARAAN KLIEN</b></a>
<?php 
	echo "<li><a class=verdana10blk href=http://$HTTP_HOST/$KAMP/proposal/ulink/entrykeymtc_link_prop.php?mode=tertpempol>Pelihara Klien.</a></li>";	
	?>
<hr size="1">
<a href="../../submenu.php?mnuinduk=150"><font face="Verdana" size="2">Back</font></a>
</body>
</html>
