<?
ob_start();
  include "../../includes/session.php";
  include "../../includes/database.php";
  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
	$DB3 = New database($userid, $passwd, $DBName);
	$DB4 = New database($userid, $passwd, $DBName);

$sqlcek="update $DBUser.tabel_118_cek_skk set cekpapsmear='".$_POST['papsmear']."',cekhaid='".$_POST['haid']."',cekhamil='".$_POST['hamil']."',cekmelahirkan='".$_POST['melahirkan']."',cekcaesar='".$_POST['caesar']."',cekkomplikasihamil='".$_POST['komplikasihamil']."' where noklien='".$_POST['noklien']."'";
$DB3->parse($sqlcek);
$DB3->execute();
$sqlcek2="update $DBUser.tabel_118_cek_skk set cekpapsmear='".$_POST['papsmear2']."',cekhaid='".$_POST['haid2']."',cekhamil='".$_POST['hamil2']."',cekmelahirkan='".$_POST['melahirkan2']."',cekcaesar='".$_POST['caesar2']."',cekkomplikasihamil='".$_POST['komplikasihamil2']."' where noklien='".$_POST['notert2']."'";
$DB4->parse($sqlcek2);
$DB4->execute();


 $sqlklien="insert into $DBUser.tabel_118_klien_wanita (noklien,periksapapsmear,hasilpapsmear,bulanhamil,jmllahir,berapakeguguran,hamilkeberapa,caesar,doktercaesar,kondisikomplihamil,dokterkomplihamil,rawatkomplihamil) values 
 ('".$_POST['noklien']."','".$_POST['periksaPapSmear']."','".$_POST['hasilPapSmear']."','".$_POST['bulanHamil']."','".$_POST['jmlLahir']."','".$_POST['berapaKeguguran']."','".$_POST['hamilKeberapa']."','".$_POST['caesar']."','".$_POST['dokterCaesar']."','".$_POST['kondisiKompliHamil']."','".$_POST['dokterKompliHamil']."','".$_POST['rawatKompliHamil']."')";
 $DB->parse($sqlklien);
  $DB->execute();
 $sqltert2="insert into $DBUser.tabel_118_klien_wanita (noklien,periksapapsmear,hasilpapsmear,bulanhamil,jmllahir,berapakeguguran,hamilkeberapa,caesar,doktercaesar,kondisikomplihamil,dokterkomplihamil,rawatkomplihamil) values 
 ('".$_POST['notert2']."','".$_POST['periksaPapSmear2']."','".$_POST['hasilPapSmear2']."','".$_POST['bulanHamil2']."','".$_POST['jmlLahir2']."','".$_POST['berapaKeguguran2'].",'".$_POST['hamilKeberapa2']."','".$_POST['caesar2']."','".$_POST['dokterCaesar2']."','".$_POST['kondisiKompliHamil2']."','".$_POST['dokterKompliHamil2']."','".$_POST['rawatKompliHamil2']."')";
 $DB->parse($sqltert2);
  $DB->execute();
 echo $sqlklien;
echo  $sqltert2;
header('location:skk_newjslink.php?noklien='.$_POST['noklien'].'&notert2='.$_POST['notert2']);
 
?>