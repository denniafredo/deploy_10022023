<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";	
  include "../../includes/duit.php";
  include "../../includes/koneksi.php";

  $DB = new database($userid, $passwd, $DBName);
  $DC = new database($userid, $passwd, $DBName);
  $DSMS = new database($userid, $passwd, $DBName);
  //echo $jnsusr.$modul;


/*--------------------------------------------------
Author : Iie Sumitra
Date   : 19 Jul 2013
Desc   : tambahan untuk cek jumlah dokumen ke SAE 
*/
define("HOSIE","MTkyLjE2OC4yLjY=");
define("USRIE", "cm9vdA==");
define("PWDIE","YWRtMW5kYXRhYmFzZXNtNFJU"); 
define("DBNIE","aml3YXNyYXlhX2RvY21hbmFnZXJkYg==");


		$mysqlins=" insert into smsjiwasraya (PHONE, MESSAGE) VALUES('08124408088','Yth. Bpk/Ibu SONYA SUNCE GOLANDA, 
    harap lakukan pembayaran premi via Host To Host Mandiri&BRI 59001942656 sebesar 250075000 paling lambat 16/09/2014 
    Utk info hub 021-500151')";			 
		//echo $msg;	 
		
		if(mysql_query($mysqlins)){
    //===================SMS AGEN================
		$msgagn="Harap infokan CPP a/n SONYA SUNCE GOLANDA utk membayar premi via host to host Mandiri&BRI no 59001942656 Rp 250075000 paling lambat 16/09/2014";
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('8659797','".$msgagn."')";
		 //echo $mysqlins;
		if(mysql_query($mysqlins)){
    echo "sukses";
    }
    }
		
		

?>
