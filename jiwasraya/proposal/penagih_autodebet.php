<?  
  include "../../includes/session.php";
  include "../../includes/database.php";
  $DB=New database($userid, $passwd, $DBName);

	//penagih auto debet
	//echo "kdbank : ".$kdbank;
	switch($kdbank)
	{
	  case 'MDR': $filter = "and nopenagih like '0000052%'"; break; //penagih mandiri
		case 'CTB': $filter = "and nopenagih like '0000053%'"; break; //penagih citibank
		case 'BNI': $filter = "and nopenagih like '0010570%'"; break; //penagih BNI
		default : $filter = "";
	}
	
	$sql = "select nopenagih from $DBUser.tabel_500_penagih ".
			 	 "where kdrayonpenagih='$kantor' and penagihautodebet='1' ".
				 $filter."";
				 
	$DB->parse($sql);
	$DB->execute();
	$arp=$DB->nextrow();
	 $teks.="window.opener.document.ntryprop.nopenagih.value='".$arp["NOPENAGIH"]."';";
	 $teks.="window.close();";
	print ("<body onload=\"".$teks."\"></body>");
	
?>