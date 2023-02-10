<?php
function kirim_sms($no_hp,$url,$nopolis,$kdkantor,$bulan){		
	//$no_hp = $_GET["no_hp"];
	//$url = $_GET["url"];
	//$nopolis = $_GET["nopolis"];	
	//$no_hp = "085697716953";
	//$no_hp = "082316546150";
	//$no_hp = "081393319931";
	//$no_hp = "081289302709";
	//$msg="Nasabah Yth,Tks atas kepercayaan Anda menjadi nasabah PT Asuransi Jiwa IFG,Bersama ini kami sampaikan Premium Statement polis $nopolis, klik $url. Info 1500151";      			 	
	$msg="Nasabah Yth,Tks atas kepercayaan Anda menjadi nasabah PT Asuransi Jiwa IFG, Kami sampaikan Premium Statement polis $nopolis/$bulan, klik $url. Info 1500151";      			 	
	//$no_hp = "081316384704";
	echo $msg.'</BR></BR>';	 
	$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) 
			   VALUES('".$no_hp."','".$msg."','Premium Statement','".$kdkantor."','Operasional','".$nopolis."')";		 
	//echo $mysqlins."<br />";
	//echo $mysqlins;
	$ok = mysql_query($mysqlins);
	//var_dump($ok);
	return $ok;
}		
?>		