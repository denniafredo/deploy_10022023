<?
	include "../../includes/database.php";
  include "../../includes/session.php";
	
	$DB=New database($userid, $passwd, $DBName);
    require("chainselectors.php"); 
 
    //prepare names 
    $selectorNames = array( 
        CS_FORM=>"ntryprop",  
        CS_FIRST_SELECTOR=>"kdproduk",  
        CS_SECOND_SELECTOR=>"kdcarabayar"); 

	  $Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk ".
	          "from tabel_233_produk_cara_bayar b, tabel_305_cara_bayar a, tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk";
	
	  $DB->parse($Query);
	  $DB->execute();
	  //echo "$Query";
  	while ($row=$DB->nextrow()) { 
		//echo "$row[KDCARABAYAR] : $row[NAMAPRODUK] : $row[KDPRODUK]<br>";
        $nama = $row[KDPRODUK]."  --  ".$row[NAMAPRODUK];
				$selectorData[] = array( 		
						CS_SOURCE_ID=>$row[KDPRODUK],   
            CS_SOURCE_LABEL=>$nama,  
            CS_TARGET_ID=>$row[KDCARABAYAR],  
            CS_TARGET_LABEL=>$row[NAMACARABAYAR]);					
    } 
		
    //instantiate class 
    $ProdukCaraBayar = new chainedSelectors($selectorNames,$selectorData); 
?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/loose.dtd"> 
<html> 
<head> 
<title>Dynamic Selector</title> 
<script type="text/javascript" language="JavaScript"> 
<?php
    $ProdukCaraBayar->printUpdateFunction(); 
?> 
</script> 
</head> 

<body> 
<form name="ntryprop" action="testChainedSelectors.php"> 
<?php 
    $ProdukCaraBayar->printSelectors(); 
?> 
<input type="submit"> 
</form> 
<script type="text/javascript" language="JavaScript"> 
<?php 
    $ProdukCaraBayar->initialize(); 
?> 
</script> 
</body> 
</html>  
