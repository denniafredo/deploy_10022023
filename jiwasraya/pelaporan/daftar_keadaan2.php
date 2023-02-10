<?
	include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	//include "../../includes/klien.php";
	//include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";

	$DB=new database($userid, $passwd, $DBName);
	$KTR=new Kantor($userid,$passwd,$kantor);
	
	$tahun = "2005";
	$kantor = "CH";
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
Tahun <?=$tahun;?> Kantor <?=$kantor;?></p>
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
  <tr>
    <td>Pertanggungan yang masih berjalan pada awal tahun</td>
    <td>1</td>
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
    <td>Pertanggungan Baru</td>
    <td>2</td>
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
	$kdvaluta = "0";
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
	$DB->parse($sql);
	$DB->execute();
  $arr=$DB->nextrow();		
	
	
	?>
        
  <tr>
    <td>Pemulihan kembali</td>
    <td>3</td>
    <td bgcolor="#D5EFFF"><?=$arr["JML_KEM"];?></td>
    <td bgcolor="#D5EFFF"><?=$arr["JUA_KEM"];?></td>
    <td bgcolor="#D5EFFF">&nbsp;</td>
    <td bgcolor="#FFE7CE"><?=$arr["JML_END"];?></td>
    <td bgcolor="#FFE7CE"><?=$arr["JUA_END"];?></td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9"><?=$arr["JML_KEO1"];?></td>
    <td bgcolor="#CCFDD9"><?=$arr["JUA_KEO1"];?></td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF"><?=$arr["JML_SHO"];?></td>
    <td bgcolor="#EEDDFF"><?=$arr["JUA_SHO"];?></td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF"><?=$arr["JML_ANO"];?></td>
    <td bgcolor="#D7E3FF"><?=$arr["JUA_ANO"];?></td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA"><?=$arr["JML_KEO2"];?></td>
    <td bgcolor="#E6F4CA"><?=$arr["JUA_KEO2"];?></td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF"><?=$arr["JML_LLO"];?></td>
    <td bgcolor="#D2FFFF"><?=$arr["JUA_LLO"];?></td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF"><?=$arr["JML_KDO"];?></td>
    <td bgcolor="#DFDFFF"><?=$arr["JUA_KDO"];?></td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
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
	?>
	<!--        
  <tr>
    <td>Meninggal</td>
    <td>6</td>
    <td bgcolor="#D5EFFF"><?=$arr["JML_KEM"];?></td>
    <td bgcolor="#D5EFFF"><?=$arr["JUAHITUNG_KEM"]."<BR/>".$arr["JUAPOLIS_KEM"];?></td>
    <td bgcolor="#D5EFFF"><?=$arr["FAEDAH_KEM"];?></td>
		
    <td bgcolor="#FFE7CE"><?=$arr["JML_END"];?></td>
    <td bgcolor="#FFE7CE"><?=$arr["JUAHITUNG_END"]."<BR/>".$arr["JUAPOLIS_END"];?></td>
    <td bgcolor="#FFE7CE"><?=$arr["FAEDAH_END"];?></td>
		
    <td bgcolor="#CCFDD9"><?=$arr["JML_KEO1"];?></td>
    <td bgcolor="#CCFDD9"><?=$arr["JUAHITUNG_KEO1"]."<BR/>".$arr["JUAPOLIS_KEO1"];?></td>
    <td bgcolor="#CCFDD9"><?=$arr["FAEDAH_KEO1"];?></td>

    <td bgcolor="#EEDDFF"><?=$arr["JML_SHO"];?></td>
    <td bgcolor="#EEDDFF"><?=$arr["JUA_SHO"];?></td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    
		<td bgcolor="#D7E3FF"><?=$arr["JML_ANO"];?></td>
    <td bgcolor="#D7E3FF"><?=$arr["JUA_ANO"];?></td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA"><?=$arr["JML_KEO2"];?></td>
    <td bgcolor="#E6F4CA"><?=$arr["JUA_KEO2"];?></td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF"><?=$arr["JML_LLO"];?></td>
    <td bgcolor="#D2FFFF"><?=$arr["JUA_LLO"];?></td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF"><?=$arr["JML_KDO"];?></td>
    <td bgcolor="#DFDFFF"><?=$arr["JUA_KDO"];?></td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
	-->
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
		
    <td align="right" bgcolor="#C6FFC6" rowspan="2">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
    <td align="right" bgcolor="#C6FFC6">&nbsp;</td>
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
		
    <td align="right" bgcolor="#B7FFB7">&nbsp;</td>
    <td align="right" bgcolor="#B7FFB7">&nbsp;</td>
  </tr>
	
  <tr>
    <td>Habis Kontrak</td>
    <td>7</td>
    
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
    <td rowspan="2" width="387">&nbsp;</td>
    <td rowspan="2" width="18">5</td>
		
    <td bgcolor="#D5EFFF" rowspan="2">A</td>
    <td bgcolor="#D5EFFF">B</td>
    <td bgcolor="#D5EFFF">C</td>
		
    <td bgcolor="#FFE7CE" rowspan="2">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#FFE7CE">&nbsp;</td>
    <td bgcolor="#CCFDD9" rowspan="2">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#CCFDD9">&nbsp;</td>
    <td bgcolor="#EEDDFF" rowspan="2">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#EEDDFF">&nbsp;</td>
    <td bgcolor="#D7E3FF" rowspan="2">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#D7E3FF">&nbsp;</td>
    <td bgcolor="#E6F4CA" rowspan="2">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#E6F4CA">&nbsp;</td>
    <td bgcolor="#D2FFFF" rowspan="2">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#D2FFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF" rowspan="2">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#DFDFFF">&nbsp;</td>
    <td bgcolor="#C6FFC6" rowspan="2">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
 <tr>
    <td bgcolor="#BBFFFF">D</td>
    <td bgcolor="#BBFFFF">E</td>
		
    <td bgcolor="#FFDFBF">&nbsp;</td>
    <td bgcolor="#FFDFBF">&nbsp;</td>
    <td bgcolor="#B6FCC9">&nbsp;</td>
    <td bgcolor="#B6FCC9">&nbsp;</td>
    <td bgcolor="#E4CAFF">&nbsp;</td>
    <td bgcolor="#E4CAFF">&nbsp;</td>
    <td bgcolor="#BFD2FF">&nbsp;</td>
    <td bgcolor="#BFD2FF">&nbsp;</td>
    <td bgcolor="#D5ECA4">&nbsp;</td>
    <td bgcolor="#D5ECA4">&nbsp;</td>
    <td bgcolor="#B3FFFF">&nbsp;</td>
    <td bgcolor="#B3FFFF">&nbsp;</td>
    <td bgcolor="#D2D2FF">&nbsp;</td>
    <td bgcolor="#D2D2FF">&nbsp;</td>
    <td bgcolor="#B7FFB7">&nbsp;</td>
    <td bgcolor="#B7FFB7">&nbsp;</td>
  </tr>
	
  <tr>
    <td>Pemutusan Kontrak dengan tebus</td>
    <td>8</td>
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
    <td>Pemutusan kontrak tanpa nilai tebus</td>
    <td>9</td>
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
  <tr>
    <td>Tahapan</td>
    <td>12</td>
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
    <td>Berkala</td>
    <td>13</td>
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
    <td>Rawat Inap</td>
    <td>14</td>
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
    <td>Cacat Tetap</td>
    <td>15</td>
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
</table>

</body>
</html>
