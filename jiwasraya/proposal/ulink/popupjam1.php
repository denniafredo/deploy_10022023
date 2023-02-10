<?
ob_start();
?><script language="JavaScript">
		
		function uaOK(){
			 var uaminnya=document.propmtc14.uaminnya.value;
			 var uamaxnya=document.propmtc14.uamaxnya.value;
			 var uanya=document.propmtc14.jua.value;
			 if(uanya<uaminnya){
				 alert("Nilainya UA harus lebih besar dari UA Minimal " + uanya + " < " + uaminnya);
				 document.propmtc14.jua.focus();
				 return uaminnya;
			 }else if (uanya>=uaminnya && uanya <=uamaxnya){
				 //document.propmtc14.propmtc14lanjut.disable=false;				 //return uanya; 
			 }else{
				 alert("Nilainya UA harus lebih Kecil dari UA Maximal " + uanya + " < " + uaminnya);
				 document.propmtc14.jua.focus();
				 return uamaxnya;
			 }
		 }
	</script>
	<?
  include "./includes/session.php";
  include "./includes/database.php";
	$DB=New database($userid, $passwd, $DBName);

/*$sql="SELECT   KDINSURABLE
  FROM   $DBUser.tabel_219_temp a, $DBUser.tabel_200_temp b
 WHERE       a.nopertanggungan = b.nopertanggungan
         AND a.notertanggung = B.NOTERTANGGUNG
         AND nopemegangpolis = noklien
         AND b.nopertanggungan = '$nopertanggungan'";*/
		 $sql="SELECT   a.kdhubungan KDINSURABLE
  FROM   $DBUser.tabel_113_insurable a, $DBUser.tabel_200_temp b
 WHERE       prefixpertanggungan='$kantor' and a.noklieninsurable = B.nopemegangpolis
         AND 
         a.notertanggung = b.notertanggung
         AND b.nopertanggungan = '$nopertanggungan'";
			 //echo $sql;
  		 $DB->parse($sql);
		 $DB->execute();
		 $arr=$DB->nextrow();
		 
		 $insurable=$arr["KDINSURABLE"];
		 //$arr["KDINSURABLE"]
		 //echo $insurable;
		 
		 if ($insurable=='A' || $insurable=='U') {
		 $payorspouse=" union select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 " and a.kdbenefit in ('PBCI','PBD','PBTPD')";}
		 elseif ($insurable=='I' || $insurable=='S') {
		 $payorspouse=" union select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 "  and a.kdbenefit in ('SPBCI','SPBD', 'SPTPD')";
		 }
		 
		 //echo $payorspouse;
/*$premi1="select premi1,usia_th from $DBUser.tabel_200_temp where prefixpertanggungan='$kantor' and nopertanggungan='$nopertanggungan'";
//echo $premi1;
$DB->parse($premi1);
$DB->execute();
$arrpremi1=$DB->nextrow();
$premi1=$arrpremi1["PREMI1"];
$usia_th=$arrpremi1["USIA_TH"];
switch($kdcarabayar){
		case 'M':
			$varcb=12;
			break;
		case 'Q':
			$varcb=4;
			break;
		case 'H':
			$varcb=2;
			break;
		case 'A':
			$varcb=1;
			break;
	}
	$anp=$premi1*$varcb;
	
	$sql="select * from $DBUser.TABEL_UL_FAKTOR_UA where kdproduk='".$kdproduk."' and usia=".$usia_th;
	$DB->parse($sql);
	$DB->execute();
	$arfua=$DB->nextrow();
	
	$uamin= $arfua['FAKTORMIN'] * $anp;
	$uamax= $arfua['FAKTORMAX'] * $anp;
	
echo "<form name=propmtc14 method=POST action=#><input type=hidden name=uaminnya value=$uamin><input type=hidden name=uamaxnya value=$uamax>UA Minimal = ".number_format($uamin,2,",",".")." <br><input type=text name=jua onBlur=\"javascript:uaOK()\"><br> UA Maximal = ".number_format($uamax,2,",",".")."</form>";*/
// New Cash Plan HANYA untuk Cara bayar TAHUNAN (18/08/2009)
//cash plan untuk semua (01/07/2010)
//if ($kdcarabayar=='4'||$kdcarabayar=='A'){
	$cashplan="AND ((substr(a.kdbenefit,1,2) <> 'CP' or (substr(a.kdbenefit,1,3) in ('CPM','CPB','CP1') and not(substr(a.kdbenefit,-3) in('RWI','ICU','BDH')))) and a.kdbenefit<>'RISKER')";
//} else {
//	$cashplan="AND (substr(a.kdbenefit,1,2) <> 'CP') ";
//}

switch ($medical) {
case 'N':{
    /*
        Modification:
            Aug, 14th, 2007     Udi     Adding ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'")
        Purpose :
            Check kdvaluta passed from opener window, if ather than Rupiah, then don't display Cash Plan
        Status  :
            Online, but need verification from Kadek
     */
	 // Tambahan oleh Ari 21/07/2008 Sesuai Nota Divisi URC
//      if(substr($kantor,0,1)=='H'||$kantor=='JB') {
	 // Tambahan oleh Ari 01/08/2008 Sesuai Nota Divisi URC
	 
      if($kantor=='kp') {
      $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 "and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
      			 "UNION ".
      			 "select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 "and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T') AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
      			 "and b.faktorbenefit <> 'X' ".$payorspouse; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
	    }
			else
			{
			 $sql="select a.kdproduk,a.kdbenefit, b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 "and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
//      			 "AND substr(a.kdbenefit,1,2) <> 'CP' ".
      			 $cashplan.
						 "UNION ".
      			 "select a.kdproduk,a.kdbenefit,DECODE(a.kdbenefit,'WPCI',b.namabenefit,'WPTPD',b.namabenefit,b.namabenefit) namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 "and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C','R','A')".
      			 "and b.faktorbenefit <> 'X'  AND a.kdbenefit not in ('SPBCI','SPBD', 'SPTPD','PBD','PBTPD','PBCI') AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
//						 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 $cashplan.$payorspouse; //echo $sql;
			}
	}
	break;
case 'M' : {
    /*
        Modification:
            Aug, 14th, 2007     Udi     Adding ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'")
        Purpose :
            Check kdvaluta passed from opener window, if ather than Rupiah, then don't display Cash Plan
        Status  :
            Online, but need verification from Kadek
     */
	 // Tambahan oleh Ari 21/07/2008 Sesuai Nota Divisi URC
//      if(substr($kantor,0,1)=='H'||$kantor=='JB') {
	 // Tambahan oleh Ari 01/08/2008 Sesuai Nota Divisi URC
      if($kantor=='kp') {
       $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 "and b.kdbenefit <> 'RATEUP' and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
    			 "UNION ".
    			 " select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 " and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C') AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
    			 " and b.faktorbenefit <>'X'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      }
      else
      {
      $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 "and b.kdbenefit <> 'RATEUP' and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP' ".
      			 $cashplan.
    			 "UNION ".
    			 " select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 " and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C','R','A') ".
    			 " and b.faktorbenefit <>'X'  AND a.kdbenefit not in ('SPBCI','SPBD', 'SPTPD','PBD','PBTPD','PBCI') AND b.kdbenefit NOT IN ('CPB1000','CPB2000','CPB3000','CPB4000','CPB5000','CPM100','CPM200','CPM300','CPM400','CPM500') ".
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 $cashplan.$payorspouse;
    	}
	}
	break;
}			 
//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$result=$DB->result();
?>
<html>
<title>Jaminan Tambahan</title>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<body>
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1337</font></td></tr>
<tr><td class=arial10bold align=center>Pilih Jaminan Tambahan</td></tr>
</table>	
<form name="popupjam" method="POST" action=<? PHP_SELF; ?>>
<table width="100%">
<tr class="hijao">
<td align=center>Kode Benefit</td>
<td align=center>Nama Benefit</td>
</tr>
<?
	reset($result);
	$i=0;
	foreach($result as $foo => $arr){
	  include "./includes/belang.php";
		$htm = "<td class=arial10ungu><a href=\"#\" onclick=\"javascript:\n".
				 	 "window.opener.document.propbnft.kdproduk.value='%s';\n".
					 "window.opener.document.propbnft.kdbenefit.value='%s';\n".
					 "window.opener.document.propbnft.namabenefit.value='%s';\n".
					 "window.opener.document.propbnft.propmtc12insert.disabled=false;\n".
					 "window.close();\" >%s</a></td>\n".
					 "<td class=arial10ungu>%s</td>\n";
		printf ($htm,$arr["KDPRODUK"],$arr["KDBENEFIT"],$arr["NAMABENEFIT"],$arr["KDBENEFIT"],$arr["NAMABENEFIT"]);
	
	print( "</tr>" );
	$i++;
	}		 
?>

</table>	
</body>
</form>
</html>
