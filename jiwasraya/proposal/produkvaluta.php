<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
?>
<html>
<head>
<script language="JavaScript" type="text/javascript">
<!--
function Lanjutkan(){
 document.porm.klik.click();
}
//-->
</script>
</head>
<body onload="javascript:Lanjutkan();"><form name="porm">
<?
	$sql = "select kdjeniscb from $DBUser.tabel_305_cara_bayar ".
		   	 "where kdcarabayar='$cb'";
			 
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$kdjeniscb = $arr["KDJENISCB"];
	//echo $kdjeniscb;

 $sql = "select kdvaluta,namavaluta from $DBUser.tabel_304_valuta b ".
 			  "where kdvaluta in (select kdvaluta from $DBUser.tabel_233_produk_cb_val ".
					"where 	kdproduk='$kp' and cara=decode('$cb','M','M','Q','Q','H','H','A','A','$kdjeniscb')) ";
	echo $sql;

	$DB->parse($sql);
	$DB->execute();
	$i=0;
	$a= "<input type=button value=OK name=klik onclick=\"javascript:";
	$teks='';
	while ($arr=$DB->nextrow()){
   $teks.="window.opener.document.ntryprop.kdvaluta.options[".$i."].text = '".$arr ["NAMAVALUTA"]."'; " ;
	 $teks.="window.opener.document.ntryprop.kdvaluta.options[".$i."].value = '".$arr ["KDVALUTA"]."'; " ;
	 $i++;
	}
	$b="window.opener.document.ntryprop.kdvaluta.options.length=".$i.";";
	
	if ($cb=='X') {
	 $sql = "select nopenagih from $DBUser.tabel_500_penagih ".
			 	 "where prefixpenagih='$kantor' and penagihskg='1'";
	 //echo $sql;
	 $DB->parse($sql);
	 $DB->execute();
	 $arp=$DB->nextrow();
	 //echo $arp["NOPENAGIH"];
	 $teks.="window.opener.document.ntryprop.nopenagih.value='".$arp["NOPENAGIH"]."';";
	}	else {
	 $teks.="window.opener.document.ntryprop.nopenagih.value='';";
	}			 
	$teks.="window.close();";
	$teks.="\">";
	echo $a.$b.$teks;
	echo("</body></html>");
?>