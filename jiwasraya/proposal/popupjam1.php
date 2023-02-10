<?
  include "../../includes/session.php";
  include "../../includes/database.php";
	$DB=New database($userid, $passwd, $DBName);

// New Cash Plan HANYA untuk Cara bayar TAHUNAN (18/08/2009)
//cash plan untuk semua (01/07/2010)
//if ($kdcarabayar=='4'||$kdcarabayar=='A'){
	$cashplan="AND (substr(a.kdbenefit,1,2) <> 'CP' or (substr(a.kdbenefit,1,3) in ('CPM','CPB') and not(substr(a.kdbenefit,-3) in('RWI','ICU','BDH'))))";
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
	 
      if($kantor=='XJF') {
      $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
      			 " and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
      			 "UNION ".
      			 "select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
      			 "and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T')".
      			 "and b.faktorbenefit <> 'X'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
	    }      
      elseif($kdproduk=="JSR1" || $kdproduk=="JSR2" || $kdproduk=="JSR3" || $kdproduk=="JSR4")
      {
      $sql=" select a.kdproduk,a.kdbenefit,b.namabenefit,b.kdjenisbenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 //" and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C') ".
				 " and a.kdbenefit not in ('JSHCPS100I','JSHCPS100R','JSHCPS200I','JSHCPS200R','JSHCPS300I','JSHCPS300R','JSHCPS400I','JSHCPS400R','JSHCPS500I','JSHCPS500R') ".
    			 " and b.faktorbenefit <>'X'";
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 //$cashplan;
      }
	  elseif($kdproduk=="DMP")
      {
      $sql="select a.kdproduk,a.kdbenefit,b.namabenefit,b.kdjenisbenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
    			 "and b.kdbenefit <> 'RATEUP' and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP' ".
      			 //$cashplan.
    			 "UNION ".
    			 " select a.kdproduk,a.kdbenefit,b.namabenefit,b.kdjenisbenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 " and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C') ".
				 " and a.kdbenefit not in ('CI','TERM','CACAD') ".
    			 " and b.faktorbenefit <>'X'";
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 //$cashplan;
      }
			else
			{
			 $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
      			 " and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
//      			 "AND substr(a.kdbenefit,1,2) <> 'CP' ".
      			 $cashplan.
						 "UNION ".
      			 "select a.kdproduk,a.kdbenefit,decode (substr(b.namabenefit,1,2),'JS',b.namabenefit||'',b.namabenefit) namabenefit ".
      	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
      			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
      			 "and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','R','C')".
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
      			 "and b.faktorbenefit <> 'X' ".
//						 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 $cashplan;
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
      if($kantor=='XJF') {
       $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 "and b.kdbenefit <> 'RATEUP' and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
    			 "UNION ".
    			 " select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 " and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C') ".
				 " and a.kdbenefit not in ('CI','TERM','CACAD') ".
    			 " and b.faktorbenefit <>'X'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      }      
      elseif($kdproduk=="DMP" && $kantor=="KP")
      {
      $sql="select a.kdproduk,a.kdbenefit,b.namabenefit,b.kdjenisbenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 "and b.kdbenefit <> 'RATEUP' and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP' ".
      			 //$cashplan.
    			 "UNION ".
    			 " select a.kdproduk,a.kdbenefit,b.namabenefit,b.kdjenisbenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
				 " and a.kdbenefit not in ('CI','TERM','CACAD') ".
    			 " and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C') ".
    			 " and b.faktorbenefit <>'X'";
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 //$cashplan;
      }
	  elseif($kdproduk=="JSR1" || $kdproduk=="JSR2" || $kdproduk=="JSR3" || $kdproduk=="JSR4")
      {
      $sql=" select a.kdproduk,a.kdbenefit,b.namabenefit,b.kdjenisbenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 //" and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C') ".
				 " and a.kdbenefit not in ('JSHCPS100I','JSHCPS100R','JSHCPS200I','JSHCPS200R','JSHCPS300I','JSHCPS300R','JSHCPS400I','JSHCPS400R','JSHCPS500I','JSHCPS500R') ".
    			 " and b.faktorbenefit <>'X'";
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 //$cashplan;
      }
	  else
      {
      $sql="select a.kdproduk,a.kdbenefit,b.namabenefit ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 "and b.kdbenefit <> 'RATEUP' and a.kdbenefit ". ($kdvaluta != '1' ? "NOT LIKE 'CP%'" : "LIKE '$kdbenefit'") ." and b.kdkelompokbenefit IS NULL ".
				 ($kdcarabayar == 'X' ? " AND a.kdbenefit NOT LIKE 'WAIVER' " : " ").
				 "and a.kdbenefit not in ('CI','TERM','CACAD') ".
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP' ".
      			 $cashplan.
    			 "UNION ".
    			 " select a.kdproduk,a.kdbenefit,decode (substr(b.namabenefit,1,2),'JS',b.namabenefit||'',b.namabenefit)  ".
    	     "from $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
    			 "where a.kdbenefit=b.kdbenefit and a.kdproduk='$kdproduk' and a.kdjenisbenefit='R' ".
    			 " and b.kdbenefit <> 'RATEUP' and b.kdkelompokbenefit IN ('B','E','D','T','C','R') ".
				 " and a.kdbenefit not in ('CI','TERM','CACAD') ".
    			 " and b.faktorbenefit <>'X' ".
//    			 "AND substr(a.kdbenefit,1,2) <> 'CP'"; //faktor benefit X= benefit ikutan saja, untuk keperluan JSAP
      			 $cashplan;
				 //echo 'here';
    	}
	}
	break;
}	
//echo $kantor;		 
//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$result=$DB->result();
?>
<html>
<title>Jaminan Tambahan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
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
	  include "../../includes/belang.php";
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
