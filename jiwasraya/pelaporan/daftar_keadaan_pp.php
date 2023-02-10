<?
	include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	//include "../../includes/klien.php";
	//include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";

	$DB=new database($userid, $passwd, $DBName);
	$DC=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	$tahun = "2005";
	$kdvaluta = "1";
	//$kantor = "PE";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
<style type="text/css">
<!-- 
body { 
 font-size: 12px;
 font-family: verdana;
 } 
td { 
 font-size: 10px;
 font-family: Arial Narrow;
 } 
-->
</style>
</head>
<body>
<p>PERKEMBANGAN PORTOFOLIO PERTANGGUNGAN PERORANGAN<br>
Tahun <?=$tahun;?> valuta <?=$kdvaluta;?> Kantor <?=$kantor;?></p>
<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
  <table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#C0C0C0" width="100%" id="AutoNumber1">
  <tr>
    <td rowspan="2" bgcolor="#DFDFDF" colspan="2">KETERANGAN</td>
    <td colspan="3" bgcolor="#D5EFFF">KEMATIAN BERJANGKA</td>
    <td colspan="3" bgcolor="#FFE7CE">DWIGUNA</td>
    <td colspan="3" bgcolor="#CCFDD9">DWIGUNA KOMBINASI</td>
    <td colspan="3" bgcolor="#EEDDFF">SEUMUR HIDUP</td>
    <td colspan="3" bgcolor="#D7E3FF">ANUITAS UMUM</td>
    <td colspan="3" bgcolor="#E6F4CA">ANUITAS DANA PENSIUN</td>
    <td colspan="3" bgcolor="#D2FFFF">KECELAKAAN DIRI</td>
    <td colspan="3" bgcolor="#DFDFFF">PRODUK NON TRADISIONAL</td>
    <td colspan="3" bgcolor="#C6FFC6">TOTAL</td>
  </tr>
  <tr>
    <td bgcolor="#D5EFFF">JML POLIS</td>
    <td bgcolor="#D5EFFF">JUA</td>
    <td bgcolor="#D5EFFF">BESAR FAEDAH</td>
    <td bgcolor="#FFE7CE">JML POLIS</td>
    <td bgcolor="#FFE7CE">JUA</td>
    <td bgcolor="#FFE7CE">BESAR FAEDAH</td>
    <td bgcolor="#CCFDD9">JML POLIS</td>
    <td bgcolor="#CCFDD9">JUA</td>
    <td bgcolor="#CCFDD9">BESAR FAEDAH</td>
    <td bgcolor="#EEDDFF">JML POLIS</td>
    <td bgcolor="#EEDDFF">JUA</td>
    <td bgcolor="#EEDDFF">BESAR FAEDAH</td>
    <td bgcolor="#D7E3FF">JML POLIS</td>
    <td bgcolor="#D7E3FF">JUA</td>
    <td bgcolor="#D7E3FF">BESAR FAEDAH</td>
    <td bgcolor="#E6F4CA">JML POLIS</td>
    <td bgcolor="#E6F4CA">JUA</td>
    <td bgcolor="#E6F4CA">BESAR FAEDAH</td>
    <td bgcolor="#D2FFFF">JML POLIS</td>
    <td bgcolor="#D2FFFF">JUA</td>
    <td bgcolor="#D2FFFF">BESAR FAEDAH</td>
    <td bgcolor="#DFDFFF">JML POLIS</td>
    <td bgcolor="#DFDFFF">JUA</td>
    <td bgcolor="#DFDFFF">BESAR FAEDAH</td>
    <td bgcolor="#C6FFC6">JML POLIS</td>
    <td bgcolor="#C6FFC6">JUA</td>
    <td bgcolor="#C6FFC6">BESAR FAEDAH</td>
  </tr>
	<? 
  $sql = "SELECT ".
             "d1.jmlpolis AS jml_kem,d1.premirp AS premi_kem,d1.juarp AS jua_kem,".
             "d2.jmlpolis AS jml_end,d2.premirp AS premi_end,d2.juarp AS jua_end,".
             "d3.jmlpolis AS jml_keo1,d3.premirp AS premi_keo1,d3.juarp AS jua_keo1,".
             "d4.jmlpolis AS jml_sho,d4.premirp AS premi_sho,d4.juarp AS jua_sho,".
             "d5.jmlpolis AS jml_ano,d5.premirp AS premi_ano,d5.juarp AS jua_ano,".
             "d6.jmlpolis AS jml_keo2,d6.premirp AS premi_keo2,d6.juarp AS jua_keo2,".
             "d7.jmlpolis AS jml_llo,d7.premirp AS premi_llo,d7.juarp AS jua_llo,".
             "d8.jmlpolis AS jml_kdo,d8.premirp AS premi_kdo,d8.juarp AS jua_kdo ".
          "FROM ".
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp, ".
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ".
             "AND b.kdcabas='KEM' AND c.kdvaluta='".$kdvaluta."' AND ".
             "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ".
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d1, ".
             
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='END' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d2, ".
             
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='KEO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ".
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d3,".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='SHO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d4, ".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='ANO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d5,".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='KEO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d6,".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='LLO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk NOT IN ('PAA','PAB') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d7,".
             
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='LLO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk IN ('PAA','PAB') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.tglupdated,'YYYY') <= '".$tahun."'".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d8";
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	?>
  <tr>
    <td>Pertanggungan yang masih berjalan pada awal tahun</td>
    <td>1</td>
    <td align="right" bgcolor="#D5EFFF"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=$arr["JUA_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFE7CE"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=$arr["JUA_END"];?></td>
    <td align="right" bgcolor="#FFE7CE">&nbsp;</td>
    <td align="right" bgcolor="#CCFDD9"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=$arr["JUA_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9">&nbsp;</td>
    <td align="right" bgcolor="#EEDDFF"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=$arr["JUA_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF">&nbsp;</td>
    <td align="right" bgcolor="#D7E3FF"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=$arr["JUA_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF">&nbsp;</td>
    <td align="right" bgcolor="#E6F4CA"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=$arr["JUA_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA">&nbsp;</td>
    <td align="right" bgcolor="#D2FFFF"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=$arr["JUA_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF">&nbsp;</td>
    <td align="right" bgcolor="#DFDFFF"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=$arr["JUA_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
	<? 
  $sql = "SELECT ".
             "d1.jmlpolis AS jml_kem,d1.premirp AS premi_kem,d1.juarp AS jua_kem,".
             "d2.jmlpolis AS jml_end,d2.premirp AS premi_end,d2.juarp AS jua_end,".
             "d3.jmlpolis AS jml_keo1,d3.premirp AS premi_keo1,d3.juarp AS jua_keo1,".
             "d4.jmlpolis AS jml_sho,d4.premirp AS premi_sho,d4.juarp AS jua_sho,".
             "d5.jmlpolis AS jml_ano,d5.premirp AS premi_ano,d5.juarp AS jua_ano,".
             "d6.jmlpolis AS jml_keo2,d6.premirp AS premi_keo2,d6.juarp AS jua_keo2,".
             "d7.jmlpolis AS jml_llo,d7.premirp AS premi_llo,d7.juarp AS jua_llo,".
             "d8.jmlpolis AS jml_kdo,d8.premirp AS premi_kdo,d8.juarp AS jua_kdo ".
          "FROM ".
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp, ".
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ".
             "AND b.kdcabas='KEM' AND c.kdvaluta='".$kdvaluta."' AND ".
             "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ".
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d1, ".
             
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='END' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d2, ".
             
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='KEO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ".
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d3,".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='SHO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d4, ".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='ANO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1') d5,".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='KEO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d6,".
          
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='LLO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk NOT IN ('PAA','PAB') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d7,".
             
             "(SELECT COUNT(1) AS jmlpolis, SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,". 
             "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
             "FROM ".
             "$DBUser.tabel_200_pertanggungan c,".
             "$DBUser.tabel_202_produk b,".
             "$DBUser.tabel_500_penagih d ".
             "WHERE ".
             "c.kdproduk=b.kdproduk ". 
             "AND b.kdcabas='LLO' AND c.kdvaluta='".$kdvaluta."' ". 
             "AND b.kdproduk IN ('PAA','PAB') ".
             "AND c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' ". 
             "AND TO_CHAR(c.mulas,'YYYY')='".$tahun."' ".
             "AND kdpertanggungan='2' ".
             "AND kdstatusfile='1' ".
             ") d8";
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	?>
  <tr>
    <td>Pertanggungan Baru</td>
    <td>2</td>
    <td align="right" bgcolor="#D5EFFF"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=$arr["JUA_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFE7CE"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=$arr["JUA_END"];?></td>
    <td align="right" bgcolor="#FFE7CE">&nbsp;</td>
    <td align="right" bgcolor="#CCFDD9"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=$arr["JUA_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9">&nbsp;</td>
    <td align="right" bgcolor="#EEDDFF"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=$arr["JUA_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF">&nbsp;</td>
    <td align="right" bgcolor="#D7E3FF"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=$arr["JUA_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF">&nbsp;</td>
    <td align="right" bgcolor="#E6F4CA"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=$arr["JUA_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA">&nbsp;</td>
    <td align="right" bgcolor="#D2FFFF"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=$arr["JUA_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF">&nbsp;</td>
    <td align="right" bgcolor="#DFDFFF"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=$arr["JUA_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
	<? 
	
	$sql = "SELECT ". 
        	   "d1.jmlpolis AS jml_kem,d1.premirp AS premi_kem,d1.juarp AS jua_kem,".
        	   "d2.jmlpolis AS jml_end,d2.premirp AS premi_end,d2.juarp AS jua_end,".
        	   "d3.jmlpolis AS jml_keo1,d3.premirp AS premi_keo1,d3.juarp AS jua_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.premirp AS premi_sho,d4.juarp AS jua_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.premirp AS premi_ano,d5.juarp AS jua_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.premirp AS premi_keo2,d6.juarp AS jua_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.premirp AS premi_llo,d7.juarp AS jua_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.premirp AS premi_kdo,d8.juarp AS jua_kdo ".
         "FROM ".
           "(".
            "SELECT ". 
             	 "COUNT(1) AS jmlpolis, ".
            	 "SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp, ".
            	 "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ". 
            "FROM ".
            	 "$DBUser.tabel_200_pertanggungan c,". 
            	 "$DBUser.tabel_700_pulih a,".
            	 "$DBUser.tabel_202_produk b,".
            	 "$DBUser.tabel_500_penagih d ".
            "WHERE ".
               "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 "c.kdproduk=b.kdproduk AND ".
            	 "b.kdcabas='KEM' AND ".
							 "c.kdvaluta='".$kdvaluta."' AND ".
            	 "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ". 
            	 "TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 "ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d1, ".
               
            "(SELECT ".
               "COUNT(1) AS jmlpolis, ".
            	 "SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp, ".
            	 "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ". 
            "FROM ".
            	 "$DBUser.tabel_200_pertanggungan c, ". 
            	 "$DBUser.tabel_700_pulih a,".
            	 "$DBUser.tabel_202_produk b,".
            	 "$DBUser.tabel_500_penagih d ".
            "WHERE ".
               "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 "c.kdproduk=b.kdproduk AND ".
            	 "b.kdcabas='END' AND ".
            	 "c.kdvaluta='".$kdvaluta."' AND ".
            	 "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ". 
            	 "TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 "ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d2,".
               
            "(SELECT ". 
               "COUNT(1) AS jmlpolis, ".
            	 "SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,".
            	 "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ". 
            "FROM ".
            	 "$DBUser.tabel_200_pertanggungan c,". 
            	 "$DBUser.tabel_700_pulih a,".
            	 "$DBUser.tabel_202_produk b,".
            	 "$DBUser.tabel_500_penagih d ".
            "WHERE ".
               "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 "c.kdproduk=b.kdproduk AND ".
            	 "b.kdcabas='KEO' AND ".
            	 "c.kdvaluta='".$kdvaluta."' AND ".
            	 "c.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') AND ".
            	 "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
            	 "TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 "ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d3,".
               
            "(SELECT ". 
               "COUNT(1) AS jmlpolis, ".
            	 "SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,".
            	 "SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ". 
            "FROM ".
            	 "$DBUser.tabel_200_pertanggungan c,". 
            	 "$DBUser.tabel_700_pulih a,".
            	 "$DBUser.tabel_202_produk b,".
            	 "$DBUser.tabel_500_penagih d ".
            "WHERE ".
               "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 "c.kdproduk=b.kdproduk AND ".
            	 "b.kdcabas='SHO' AND ".
            	 "c.kdvaluta='".$kdvaluta."' AND ".
            	 "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ". 
            	 "TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 "ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d4, ".
               
            "(SELECT ".
                "COUNT(1) AS jmlpolis,".
              	"SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,".
              	"SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
            "FROM ".
            	 "$DBUser.tabel_200_pertanggungan c,". 
            	 "$DBUser.tabel_700_pulih a,".
            	 "$DBUser.tabel_202_produk b,".
            	 "$DBUser.tabel_500_penagih d ".
            "WHERE ".
               "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 "c.kdproduk=b.kdproduk AND ".
            	 "b.kdcabas='ANO' AND ".
            	 "c.kdvaluta='".$kdvaluta."' AND ".
            	 "c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
            	 "TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 "ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d5,".
               
            "(SELECT ". 
                "COUNT(1) AS jmlpolis,".
            	 	"SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,".
            	 	"SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ". 
            "FROM ".
            	  "$DBUser.tabel_200_pertanggungan c,". 
            	  "$DBUser.tabel_700_pulih a,".
            	  "$DBUser.tabel_202_produk b,".
            	  "$DBUser.tabel_500_penagih d ".
            "WHERE ".
                "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	  "c.kdproduk=b.kdproduk AND ".
            	 	"b.kdcabas='KEO' AND ".
            	 	"c.kdvaluta='".$kdvaluta."' AND ".
            	  "c.kdproduk IN ('AEP','AIP','AI0','ASI','ASP')  AND ".
            	 	"c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
            	 	"TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 	"ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d6,".
               
            "(SELECT ". 
                "COUNT(1) AS jmlpolis,".
            	 	"SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,".
            	 	"SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
            "FROM ".
            	  "$DBUser.tabel_200_pertanggungan c,". 
            	 	"$DBUser.tabel_700_pulih a,".
            	 	"$DBUser.tabel_202_produk b,".
            	 	"$DBUser.tabel_500_penagih d ".
            "WHERE ".
                "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 	"c.kdproduk=b.kdproduk AND ".
            	 	"b.kdcabas='LLO' AND ".
								"c.kdvaluta='".$kdvaluta."' AND ".
            	  "c.kdproduk not in ('PAA','PAB') and ".
            	 	"c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
            	 	"TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 	"ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d7,".
            
						"(SELECT ". 
                "COUNT(1) AS jmlpolis,".
            	 	"SUM(DECODE(c.kdvaluta,3,c.premi1*c.indexawal,c.premi1)) AS premirp,".
            	 	"SUM(DECODE(c.kdvaluta,3,c.juamainproduk*c.indexawal,c.juamainproduk)) AS juarp ".
            "FROM ".
            	  "$DBUser.tabel_200_pertanggungan c,". 
            	 	"$DBUser.tabel_700_pulih a,".
            	 	"$DBUser.tabel_202_produk b,".
            	 	"$DBUser.tabel_500_penagih d ".
            "WHERE ".
                "a.prefixpertanggungan=c.prefixpertanggungan AND a.nopertanggungan=c.nopertanggungan AND ".
            	 	"c.kdproduk=b.kdproduk AND ".
            	 	"b.kdcabas='LLO' AND ". 
								"c.kdvaluta='".$kdvaluta."' AND ".
            	  "c.kdproduk in ('PAA','PAB') and ".
            	 	"c.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ". 
            	 	"TO_CHAR(a.tglotorisasi,'YYYY')='".$tahun."' AND a.status<>'0' ".
            	 	"ORDER BY a.prefixpertanggungan,a.nopertanggungan ".
            ") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();		
	?>
        
  <tr>
    <td>Pemulihan kembali</td>
    <td>3</td>
    <td align="right" bgcolor="#D5EFFF"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=$arr["JUA_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF">&nbsp;</td>
    <td align="right" bgcolor="#FFE7CE"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=$arr["JUA_END"];?></td>
    <td align="right" bgcolor="#FFE7CE">&nbsp;</td>
    <td align="right" bgcolor="#CCFDD9"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=$arr["JUA_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9">&nbsp;</td>
    <td align="right" bgcolor="#EEDDFF"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=$arr["JUA_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF">&nbsp;</td>
    <td align="right" bgcolor="#D7E3FF"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=$arr["JUA_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF">&nbsp;</td>
    <td align="right" bgcolor="#E6F4CA"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=$arr["JUA_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA">&nbsp;</td>
    <td align="right" bgcolor="#D2FFFF"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=$arr["JUA_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF">&nbsp;</td>
    <td align="right" bgcolor="#DFDFFF"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=$arr["JUA_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
  <tr>
    <td>Perubahan</td>
    <td>4</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
  <tr>
    <td>JUMLAH I (1+2+3+4)</td>
    <td>5</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
  <tr>
	  <td></td>
		<td></td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
	
	<? 
	// start meninggal 
	
	$sql = "SELECT ".
        	   "d1.jmlpolis AS jml_kem,d1.faedah AS faedah_kem,d1.faedah_hitung AS faedahhitung_kem,d1.juapolis AS juapolis_kem,d1.juahitung AS juahitung_kem,".
        	   "d2.jmlpolis AS jml_end,d2.faedah AS faedah_end,d2.faedah_hitung AS faedahhitung_end,d2.juapolis AS juapolis_end,d2.juahitung AS juahitung_end,".  
        	   "d3.jmlpolis AS jml_keo1,d3.faedah AS faedah_keo1,d3.faedah_hitung AS faedahhitung_keo1,d3.juapolis AS juapolis_keo1,d3.juahitung AS juahitung_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.faedah AS faedah_sho,d4.faedah_hitung AS faedahhitung_sho,d4.juapolis AS juapolis_sho,d4.juahitung AS juahitung_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.faedah AS faedah_ano,d5.faedah_hitung AS faedahhitung_ano,d5.juapolis AS juapolis_ano,d5.juahitung AS juahitung_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.faedah AS faedah_keo2,d6.faedah_hitung AS faedahhitung_keo2,d6.juapolis AS juapolis_keo2,d6.juahitung AS juahitung_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.faedah AS faedah_llo,d7.faedah_hitung AS faedahhitung_llo,d7.juapolis AS juapolis_llo,d7.juahitung AS juahitung_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.faedah AS faedah_kdo,d8.faedah_hitung AS faedahhitung_kdo,d8.juapolis AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
        "FROM ".
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis, ".
          		"SUM(a.nilaipembayaran) AS faedah, ".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis, ".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a, ".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
							"b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEM' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='M01' ".
           ") d1,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='END' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='M01' ".
           ") d2,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='M01' ".
            ") d3,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='SHO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='M01' ".
            ") d4,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='ANO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='M01' ".
            ") d5,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' ".
          	  "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".  
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='M01' ".
           	") d6,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk NOT IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='M01' ".
           	") d7,".
           
					 "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='M01' ".
           	") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	
	<tr>
    <td rowspan="2" width="387">Meninggal</td>
    <td rowspan="2" width="18">6</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
 <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
	
	<? 
	// start expirasi (habis kontrak) 
	
	$sql = "SELECT ".
        	   "d1.jmlpolis AS jml_kem,d1.faedah AS faedah_kem,d1.faedah_hitung AS faedahhitung_kem,d1.juapolis AS juapolis_kem,d1.juahitung AS juahitung_kem,".
        	   "d2.jmlpolis AS jml_end,d2.faedah AS faedah_end,d2.faedah_hitung AS faedahhitung_end,d2.juapolis AS juapolis_end,d2.juahitung AS juahitung_end,".  
        	   "d3.jmlpolis AS jml_keo1,d3.faedah AS faedah_keo1,d3.faedah_hitung AS faedahhitung_keo1,d3.juapolis AS juapolis_keo1,d3.juahitung AS juahitung_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.faedah AS faedah_sho,d4.faedah_hitung AS faedahhitung_sho,d4.juapolis AS juapolis_sho,d4.juahitung AS juahitung_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.faedah AS faedah_ano,d5.faedah_hitung AS faedahhitung_ano,d5.juapolis AS juapolis_ano,d5.juahitung AS juahitung_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.faedah AS faedah_keo2,d6.faedah_hitung AS faedahhitung_keo2,d6.juapolis AS juapolis_keo2,d6.juahitung AS juahitung_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.faedah AS faedah_llo,d7.faedah_hitung AS faedahhitung_llo,d7.juapolis AS juapolis_llo,d7.juahitung AS juahitung_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.faedah AS faedah_kdo,d8.faedah_hitung AS faedahhitung_kdo,d8.juapolis AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
        "FROM ".
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis, ".
          		"SUM(a.nilaipembayaran) AS faedah, ".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis, ".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a, ".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
							"b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEM' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='E01' ".
           ") d1,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='END' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='E01' ".
           ") d2,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='E01' ".
            ") d3,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='SHO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='E01' ".
            ") d4,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='ANO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='E01' ".
            ") d5,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' ".
          	  "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".  
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='E01' ".
           	") d6,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk NOT IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='E01' ".
           	") d7,".
           
					 "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='E01' ".
           	") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	
	<tr>
    <td rowspan="2" width="387">Habis Kontrak</td>
    <td rowspan="2" width="18">7</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
 <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
	
  <? 
	// bpo
	$sql = "SELECT ".
   		 	 		 "d1.jmlpolis AS jml_kem,d1.nilaitebus AS faedah_kem,d1.nilaitebushitung AS faedahhitung_kem,d1.jua AS juapolis_kem,d1.juahitung AS juahitung_kem,".
   	   			 "d2.jmlpolis AS jml_end,d2.nilaitebus AS faedah_end,d2.nilaitebushitung AS faedahhitung_end,d2.jua AS juapolis_end,d2.juahitung AS juahitung_end,".
   	   			 "d3.jmlpolis AS jml_keo1,d3.nilaitebus AS faedah_keo1,d3.nilaitebushitung AS faedahhitung_keo1,d3.jua AS juapolis_keo1,d3.juahitung AS juahitung_keo1, ".
						 "d4.jmlpolis AS jml_sho,d4.nilaitebus AS faedah_sho,d4.nilaitebushitung AS faedahhitung_sho,d4.jua AS juapolis_sho,d4.juahitung AS juahitung_sho, ".
						 "d5.jmlpolis AS jml_ano,d5.nilaitebus AS faedah_ano,d5.nilaitebushitung AS faedahhitung_ano,d5.jua AS juapolis_ano,d5.juahitung AS juahitung_ano, ".
						 "d6.jmlpolis AS jml_keo2,d6.nilaitebus AS faedah_keo2,d6.nilaitebushitung AS faedahhitung_keo2,d6.jua AS juapolis_keo2,d6.juahitung AS juahitung_keo2, ".
						 "d7.jmlpolis AS jml_llo,d7.nilaitebus AS faedah_llo,d7.nilaitebushitung AS faedahhitung_llo,d7.jua AS juapolis_llo,d7.juahitung AS juahitung_llo, ".
						 "d8.jmlpolis AS jml_kdo,d8.nilaitebus AS faedah_kdo,d8.nilaitebushitung AS faedahhitung_kdo,d8.jua AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
         "FROM ".
            "(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='KEM' AND ".
            	 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d1,".
							 
						"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='END' AND ".
            	 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d2, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='KEO' AND ".
							 "c.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') AND ".
							 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d3, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='SHO' AND ".
            	 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d4, ".
					
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='ANO' AND ".
            	 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d5, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='KEO' AND ".
							 "c.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') AND ".
							 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d6, ".
					
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='LLO' AND ".
							 "b.kdproduk NOT IN ('PAA','PAB') and ".
            	 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d7, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='LLO' AND ".
							 "b.kdproduk IN ('PAA','PAB') and ".
            	 "c.kdstatusfile='4' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d8 ";
	//echo $sql."";						 
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	<tr>
    <td rowspan="2" width="387">Pemutusan Kontrak dengan tebus</td>
    <td rowspan="2" width="18">8</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
 <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
	
  <? 
	// batal 
	$sql = "SELECT ".
   		 	 		 "d1.jmlpolis AS jml_kem,d1.nilaitebus AS faedah_kem,d1.nilaitebushitung AS faedahhitung_kem,d1.jua AS juapolis_kem,d1.juahitung AS juahitung_kem,".
   	   			 "d2.jmlpolis AS jml_end,d2.nilaitebus AS faedah_end,d2.nilaitebushitung AS faedahhitung_end,d2.jua AS juapolis_end,d2.juahitung AS juahitung_end,".
   	   			 "d3.jmlpolis AS jml_keo1,d3.nilaitebus AS faedah_keo1,d3.nilaitebushitung AS faedahhitung_keo1,d3.jua AS juapolis_keo1,d3.juahitung AS juahitung_keo1, ".
						 "d4.jmlpolis AS jml_sho,d4.nilaitebus AS faedah_sho,d4.nilaitebushitung AS faedahhitung_sho,d4.jua AS juapolis_sho,d4.juahitung AS juahitung_sho, ".
						 "d5.jmlpolis AS jml_ano,d5.nilaitebus AS faedah_ano,d5.nilaitebushitung AS faedahhitung_ano,d5.jua AS juapolis_ano,d5.juahitung AS juahitung_ano, ".
						 "d6.jmlpolis AS jml_keo2,d6.nilaitebus AS faedah_keo2,d6.nilaitebushitung AS faedahhitung_keo2,d6.jua AS juapolis_keo2,d6.juahitung AS juahitung_keo2, ".
						 "d7.jmlpolis AS jml_llo,d7.nilaitebus AS faedah_llo,d7.nilaitebushitung AS faedahhitung_llo,d7.jua AS juapolis_llo,d7.juahitung AS juahitung_llo, ".
						 "d8.jmlpolis AS jml_kdo,d8.nilaitebus AS faedah_kdo,d8.nilaitebushitung AS faedahhitung_kdo,d8.jua AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
         "FROM ".
            "(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='KEM' AND ".
            	 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d1,".
							 
						"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='END' AND ".
            	 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d2, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='KEO' AND ".
							 "c.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') AND ".
							 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d3, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='SHO' AND ".
            	 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d4, ".
					
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='ANO' AND ".
            	 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d5, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='KEO' AND ".
							 "c.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') AND ".
							 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d6, ".
					
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='LLO' AND ".
							 "b.kdproduk NOT IN ('PAA','PAB') and ".
            	 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d7, ".
							 
					"(SELECT ".
               "COUNT(1) AS jmlpolis,".
            	 "SUM(c.juamainproduk) AS jua,".
            	 "SUM(c.juamainproduk/c.indexawal) AS juahitung,".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))) nilaitebus, ".
            	 "SUM($DBUser.polis.tebusbpo(c.prefixpertanggungan,c.nopertanggungan,TO_CHAR(c.tglupdated,'MMYYYY'))/c.indexawal) nilaitebushitung ".
            "FROM ".
            	 "$DBUser.TABEL_200_PERTANGGUNGAN c,". 
            	 "$DBUser.TABEL_202_PRODUK b,".
            	 "$DBUser.TABEL_500_PENAGIH d ".
            "WHERE ".
               "c.kdproduk=b.kdproduk AND ". 
            	 "b.kdcabas='LLO' AND ".
							 "b.kdproduk IN ('PAA','PAB') and ".
            	 "c.kdstatusfile='X' AND ". 
            	 "TO_CHAR(c.tglupdated,'YYYY')='".$tahun."' AND ". 
            	 "c.nopenagih=d.nopenagih ".
            	 "AND d.kdrayonpenagih='".$kantor."' ".
            	 "AND kdvaluta='".$kdvaluta."' ) d8 ";
	//echo $sql."";						 
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	<tr>
    <td rowspan="2" width="387">Pemutusan kontrak tanpa nilai tebus</td>
    <td rowspan="2" width="18">9</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
 <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
	
  
  <tr>
    <td>JUMLAH II (6+7+8+9)</td>
    <td>10</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
	
  <tr>
    <td>Pertanggungan pada akhir tahun (5-10)</td>
    <td>11</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
  <tr>
	  <td></td>
		<td></td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
	
	<!-- klaim tahapan -->
	<? 
	$sql = "SELECT ".
        	   "d1.jmlpolis AS jml_kem,d1.faedah AS faedah_kem,d1.faedah_hitung AS faedahhitung_kem,d1.juapolis AS juapolis_kem,d1.juahitung AS juahitung_kem,".
        	   "d2.jmlpolis AS jml_end,d2.faedah AS faedah_end,d2.faedah_hitung AS faedahhitung_end,d2.juapolis AS juapolis_end,d2.juahitung AS juahitung_end,".  
        	   "d3.jmlpolis AS jml_keo1,d3.faedah AS faedah_keo1,d3.faedah_hitung AS faedahhitung_keo1,d3.juapolis AS juapolis_keo1,d3.juahitung AS juahitung_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.faedah AS faedah_sho,d4.faedah_hitung AS faedahhitung_sho,d4.juapolis AS juapolis_sho,d4.juahitung AS juahitung_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.faedah AS faedah_ano,d5.faedah_hitung AS faedahhitung_ano,d5.juapolis AS juapolis_ano,d5.juahitung AS juahitung_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.faedah AS faedah_keo2,d6.faedah_hitung AS faedahhitung_keo2,d6.juapolis AS juapolis_keo2,d6.juahitung AS juahitung_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.faedah AS faedah_llo,d7.faedah_hitung AS faedahhitung_llo,d7.juapolis AS juapolis_llo,d7.juahitung AS juahitung_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.faedah AS faedah_kdo,d8.faedah_hitung AS faedahhitung_kdo,d8.juapolis AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
        "FROM ".
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis, ".
          		"SUM(a.nilaipembayaran) AS faedah, ".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis, ".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a, ".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
							"b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEM' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='T02' ".
           ") d1,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='END' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='T02' ".
           ") d2,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='T02' ".
            ") d3,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='SHO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='T02' ".
            ") d4,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='ANO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='T02' ".
            ") d5,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' ".
          	  "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".  
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='T02' ".
           	") d6,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk NOT IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='T02' ".
           	") d7,".
           
					 "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='T02' ".
           	") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	
	<tr>
    <td rowspan="2" width="387">Tahapan</td>
    <td rowspan="2" width="18">12</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
 <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
	
	<!-- klaim beasiswa/berkala -->
	<? 
	$sql = "SELECT ".
        	   "d1.jmlpolis AS jml_kem,d1.faedah AS faedah_kem,d1.faedah_hitung AS faedahhitung_kem,d1.juapolis AS juapolis_kem,d1.juahitung AS juahitung_kem,".
        	   "d2.jmlpolis AS jml_end,d2.faedah AS faedah_end,d2.faedah_hitung AS faedahhitung_end,d2.juapolis AS juapolis_end,d2.juahitung AS juahitung_end,".  
        	   "d3.jmlpolis AS jml_keo1,d3.faedah AS faedah_keo1,d3.faedah_hitung AS faedahhitung_keo1,d3.juapolis AS juapolis_keo1,d3.juahitung AS juahitung_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.faedah AS faedah_sho,d4.faedah_hitung AS faedahhitung_sho,d4.juapolis AS juapolis_sho,d4.juahitung AS juahitung_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.faedah AS faedah_ano,d5.faedah_hitung AS faedahhitung_ano,d5.juapolis AS juapolis_ano,d5.juahitung AS juahitung_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.faedah AS faedah_keo2,d6.faedah_hitung AS faedahhitung_keo2,d6.juapolis AS juapolis_keo2,d6.juahitung AS juahitung_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.faedah AS faedah_llo,d7.faedah_hitung AS faedahhitung_llo,d7.juapolis AS juapolis_llo,d7.juahitung AS juahitung_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.faedah AS faedah_kdo,d8.faedah_hitung AS faedahhitung_kdo,d8.juapolis AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
        "FROM ".
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis, ".
          		"SUM(a.nilaipembayaran) AS faedah, ".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis, ".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a, ".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
							"b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEM' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='B01' ".
           ") d1,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='END' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='B01' ".
           ") d2,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='B01' ".
            ") d3,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='SHO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='B01' ".
            ") d4,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='ANO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='B01' ".
            ") d5,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' ".
          	  "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".  
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='B01' ".
           	") d6,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk NOT IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='B01' ".
           	") d7,".
           
					 "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='B01' ".
           	") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	
	<tr>
    <td rowspan="2" width="387">Berkala</td>
    <td rowspan="2" width="18">13</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
	
  <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
	
  <!-- klaim Rawat Inap -->
	<? 
	$sql = "SELECT ".
        	   "d1.jmlpolis AS jml_kem,d1.faedah AS faedah_kem,d1.faedah_hitung AS faedahhitung_kem,d1.juapolis AS juapolis_kem,d1.juahitung AS juahitung_kem,".
        	   "d2.jmlpolis AS jml_end,d2.faedah AS faedah_end,d2.faedah_hitung AS faedahhitung_end,d2.juapolis AS juapolis_end,d2.juahitung AS juahitung_end,".  
        	   "d3.jmlpolis AS jml_keo1,d3.faedah AS faedah_keo1,d3.faedah_hitung AS faedahhitung_keo1,d3.juapolis AS juapolis_keo1,d3.juahitung AS juahitung_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.faedah AS faedah_sho,d4.faedah_hitung AS faedahhitung_sho,d4.juapolis AS juapolis_sho,d4.juahitung AS juahitung_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.faedah AS faedah_ano,d5.faedah_hitung AS faedahhitung_ano,d5.juapolis AS juapolis_ano,d5.juahitung AS juahitung_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.faedah AS faedah_keo2,d6.faedah_hitung AS faedahhitung_keo2,d6.juapolis AS juapolis_keo2,d6.juahitung AS juahitung_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.faedah AS faedah_llo,d7.faedah_hitung AS faedahhitung_llo,d7.juapolis AS juapolis_llo,d7.juahitung AS juahitung_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.faedah AS faedah_kdo,d8.faedah_hitung AS faedahhitung_kdo,d8.juapolis AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
        "FROM ".
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis, ".
          		"SUM(a.nilaipembayaran) AS faedah, ".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis, ".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a, ".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
							"b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEM' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='R01' ".
           ") d1,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='END' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='R01' ".
           ") d2,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='R01' ".
            ") d3,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='SHO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='R01' ".
            ") d4,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='ANO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='R01' ".
            ") d5,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' ".
          	  "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".  
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='R01' ".
           	") d6,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk NOT IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='R01' ".
           	") d7,".
           
					 "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='R01' ".
           	") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	
	<tr>
    <td rowspan="2" width="387">Rawat Inap</td>
    <td rowspan="2" width="18">14</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
	
  <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>
  
  <!-- klaim Cacat tetap -->
	<? 
	$sql = "SELECT ".
        	   "d1.jmlpolis AS jml_kem,d1.faedah AS faedah_kem,d1.faedah_hitung AS faedahhitung_kem,d1.juapolis AS juapolis_kem,d1.juahitung AS juahitung_kem,".
        	   "d2.jmlpolis AS jml_end,d2.faedah AS faedah_end,d2.faedah_hitung AS faedahhitung_end,d2.juapolis AS juapolis_end,d2.juahitung AS juahitung_end,".  
        	   "d3.jmlpolis AS jml_keo1,d3.faedah AS faedah_keo1,d3.faedah_hitung AS faedahhitung_keo1,d3.juapolis AS juapolis_keo1,d3.juahitung AS juahitung_keo1,".
        	   "d4.jmlpolis AS jml_sho,d4.faedah AS faedah_sho,d4.faedah_hitung AS faedahhitung_sho,d4.juapolis AS juapolis_sho,d4.juahitung AS juahitung_sho,".
        	   "d5.jmlpolis AS jml_ano,d5.faedah AS faedah_ano,d5.faedah_hitung AS faedahhitung_ano,d5.juapolis AS juapolis_ano,d5.juahitung AS juahitung_ano,".
        	   "d6.jmlpolis AS jml_keo2,d6.faedah AS faedah_keo2,d6.faedah_hitung AS faedahhitung_keo2,d6.juapolis AS juapolis_keo2,d6.juahitung AS juahitung_keo2,".
        	   "d7.jmlpolis AS jml_llo,d7.faedah AS faedah_llo,d7.faedah_hitung AS faedahhitung_llo,d7.juapolis AS juapolis_llo,d7.juahitung AS juahitung_llo,".
        	   "d8.jmlpolis AS jml_kdo,d8.faedah AS faedah_kdo,d8.faedah_hitung AS faedahhitung_kdo,d8.juapolis AS juapolis_kdo,d8.juahitung AS juahitung_kdo ".
        "FROM ".
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis, ".
          		"SUM(a.nilaipembayaran) AS faedah, ".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis, ".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a, ".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
							"b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEM' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='C01' ".
           ") d1,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        	 "FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	 "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='END' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='C01' ".
           ") d2,".
           
           "(SELECT ". 
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk NOT IN ('AEP','AIP','AI0','ASI','ASP') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='C01' ".
            ") d3,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='SHO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='C01' ".
            ") d4,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='ANO' ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='C01' ".
            ") d5,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        	  "WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='KEO' ".
          	  "AND b.kdproduk IN ('AEP','AIP','AI0','ASI','ASP') ".  
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ".
          	  "AND a.kdpembayaran='C01' ".
           	") d6,".
           
           "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk NOT IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='C01' ".
           	") d7,".
           
					 "(SELECT ".
          		"COUNT(1) AS jmlpolis,".
          		"SUM(a.nilaipembayaran) AS faedah,".
							"SUM(a.nilaipembayaran/b.indexawal) AS faedah_hitung,".
          		"SUM((a.kursstandar*b.juamainproduk)) AS juapolis,".
          		"SUM((a.kurstransaksi*b.juamainproduk)) AS juahitung ".
        		"FROM ".
        	    "$DBUser.TABEL_800_PEMBAYARAN_KELUAR a,".
        			"$DBUser.TABEL_200_PERTANGGUNGAN b,".
        	  	"$DBUser.TABEL_202_PRODUK c,".
        	  	"$DBUser.TABEL_500_PENAGIH d ".
        		"WHERE ".
          	  "a.prefixpertanggungan=b.prefixpertanggungan AND a.nopertanggungan=b.nopertanggungan AND ". 
          	  "b.nopenagih=d.nopenagih AND d.kdrayonpenagih='".$kantor."' AND ".
          	  "b.kdvaluta='".$kdvaluta."' AND ".
          	  "b.kdproduk=c.kdproduk AND c.kdcabas='LLO' ".
          	  "AND b.kdproduk IN ('PAA','PAB') ".
          	  "AND TO_CHAR(a.tglseatled,'YYYY')='".$tahun."' ". 
          	  "AND a.kdpembayaran='C01' ".
           	") d8";
						//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();	
	
	$jmlmeninggal 		= $arr["JML_KEM"] + $arr["JML_END"] + $arr["JML_KEO1"] + $arr["JML_SHO"] + $arr["JML_ANO"] + $arr["JML_KEO2"] + $arr["JML_LLO"] + $arr["JML_KDO"];
	$jmljua_hitung 		= $arr["JUAHITUNG_KEM"] + $arr["JUAHITUNG_END"] + $arr["JUAHITUNG_KEO1"] + $arr["JUAHITUNG_SHO"] + $arr["JUAHITUNG_ANO"] + $arr["JUAHITUNG_KEO2"] + $arr["JUAHITUNG_LLO"] + $arr["JUAHITUNG_KDO"];
	$jmlfaedah_hitung = $arr["FAEDAHHITUNG_KEM"] + $arr["FAEDAHHITUNG_END"] + $arr["FAEDAHHITUNG_KEO1"] + $arr["FAEDAHHITUNG_SHO"] + $arr["FAEDAHHITUNG_ANO"] + $arr["FAEDAHHITUNG_KEO2"] + $arr["FAEDAHHITUNG_LLO"] + $arr["FAEDAHHITUNG_KDO"];
	$jmljuapolis			= $arr["JUAPOLIS_KEM"] + $arr["JUAPOLIS_END"] + $arr["JUAPOLIS_KEO1"] + $arr["JUAPOLIS_SHO"] + $arr["JUAPOLIS_ANO"] + $arr["JUAPOLIS_KEO2"] + $arr["JUAPOLIS_LLO"] + $arr["JUAPOLIS_KDO"];
	$jmlfaedah				= $arr["FAEDAH_KEM"] + $arr["FAEDAH_END"] + $arr["FAEDAH_KEO1"] + $arr["FAEDAH_SHO"] + $arr["FAEDAH_ANO"] + $arr["FAEDAH_KEO2"] + $arr["FAEDAH_LLO"] + $arr["FAEDAH_KDO"];
	?>
	
	<tr>
    <td rowspan="2" width="387">Cacat Tetap</td>
    <td rowspan="2" width="18">15</td>
		
    <td align="right" bgcolor="#D5EFFF" rowspan="2"><?=$arr["JML_KEM"];?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["JUAHITUNG_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#D5EFFF"><?=number_format($arr["FAEDAHHITUNG_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFE7CE" rowspan="2"><?=$arr["JML_END"];?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["JUAHITUNG_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFE7CE"><?=number_format($arr["FAEDAHHITUNG_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#CCFDD9" rowspan="2"><?=$arr["JML_KEO1"];?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["JUAHITUNG_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#CCFDD9"><?=number_format($arr["FAEDAHHITUNG_KEO1"],2,",",",");?></td>
    
		<td align="right" bgcolor="#EEDDFF" rowspan="2"><?=$arr["JML_SHO"];?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["JUAHITUNG_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#EEDDFF"><?=number_format($arr["FAEDAHHITUNG_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D7E3FF" rowspan="2"><?=$arr["JML_ANO"];?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["JUAHITUNG_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#D7E3FF"><?=number_format($arr["FAEDAHHITUNG_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E6F4CA" rowspan="2"><?=$arr["JML_KEO2"];?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["JUAHITUNG_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#E6F4CA"><?=number_format($arr["FAEDAHHITUNG_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2FFFF" rowspan="2"><?=$arr["JML_LLO"];?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["JUAHITUNG_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2FFFF"><?=number_format($arr["FAEDAHHITUNG_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#DFDFFF" rowspan="2"><?=$arr["JML_KDO"];?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["JUAHITUNG_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#DFDFFF"><?=number_format($arr["FAEDAHHITUNG_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2"><?=$jmlmeninggal;?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmljua_hitung,2,",",",");?></td>
    <td align="right" bgcolor="#C6FFC6"><?=number_format($jmlfaedah_hitung,2,",",",");?></td>
  </tr>
	
  <tr>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["JUAPOLIS_KEM"],2,",",",");?></td>
    <td align="right" bgcolor="#BBFFFF"><?=number_format($arr["FAEDAH_KEM"],2,",",",");?></td>
		
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["JUAPOLIS_END"],2,",",",");?></td>
    <td align="right" bgcolor="#FFDFBF"><?=number_format($arr["FAEDAH_END"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["JUAPOLIS_KEO1"],2,",",",");?></td>
    <td align="right" bgcolor="#B6FCC9"><?=number_format($arr["FAEDAH_KEO1"],2,",",",");?></td>
		
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["JUAPOLIS_SHO"],2,",",",");?></td>
    <td align="right" bgcolor="#E4CAFF"><?=number_format($arr["FAEDAH_SHO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["JUAPOLIS_ANO"],2,",",",");?></td>
    <td align="right" bgcolor="#BFD2FF"><?=number_format($arr["FAEDAH_ANO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["JUAPOLIS_KEO2"],2,",",",");?></td>
    <td align="right" bgcolor="#D5ECA4"><?=number_format($arr["FAEDAH_KEO2"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["JUAPOLIS_LLO"],2,",",",");?></td>
    <td align="right" bgcolor="#B3FFFF"><?=number_format($arr["FAEDAH_LLO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["JUAPOLIS_KDO"],2,",",",");?></td>
    <td align="right" bgcolor="#D2D2FF"><?=number_format($arr["FAEDAH_KDO"],2,",",",");?></td>
		
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmljuapolis,2,",",",");?></td>
    <td align="right" bgcolor="#B7FFB7"><?=number_format($jmlfaedah,2,",",",");?></td>
  </tr>

</table>

</body>
</html>
