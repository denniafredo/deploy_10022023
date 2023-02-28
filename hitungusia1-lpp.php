<?
  	include "./includes/database.php";
  	include "./includes/session.php";
	include "./includes/klien-lpp.php";
	
	$DB = New database($userid, $passwd, $DBName);
	$KL = New Klien ($userid,$passwd,$c);
	
	$sql = "select kdproduk from $DBUser.tabel_202_produk ".
			   "where namaproduk like 'ANUITAS%' ".
				 "or namaproduk like 'ARTHA DANA%' ".
				 "or namaproduk like 'SIHARTA%' ".
				 "or kdproduk='PIN'";
				 
	$DB->parse($sql);
	$DB->execute();
	$prod = array();
	while ($arr=$DB->nextrow()) {
	  array_push($prod,$arr["KDPRODUK"]);
	}
	$usia=$KL->Umur($a);
	if (in_array($prd,$prod)) {	
	  	$usiabl=$KL->UmurBl($a);
  	} else {
	  	$usiabl=0;
	}
	/*	
		$sql = "select min(usia) minim, max(usia) maksi ".
				   "from $DBUser.tabel_205_tarip_premi ".
				   "where kdproduk='$prd' group by kdproduk";
		$DB->parse($sql);
		$DB->execute();
		$arr=$DB->nextrow();
		$minim=(int)$arr["MINIM"];			 
		$maksi=(int)$arr["MAKSI"];
	*/	
	/** UAT 20022023 */
	if($prd == 'JL4BPRO'){
		$usiabl=$KL->getUmurBulan($a);
		if($usiabl >= 6){
			$usia+=1;
			$usiabl = 0;
		}
	}
	/** END OF ERA */


	$sql = "select lama_min,decode(kdproduk,'PIN',1,'AIP',1,'AEP',1,'ASP',1,'ASI',".
			 	 "1,'AI0',1,'PAA',1,'PAB',1,variabel-".$usia.") variabel ".
			   "from $DBUser.tabel_202_produk ".
			   "where kdproduk='$prd'";
	//echo $sql;
	//die;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	if ($cb=='E') {
	 $var=5;
	} elseif ($cb=='J') {
	 $var=10;
	} else {
	 $var=((int)$arr["VARIABEL"]<=0) ? $arr["LAMA_MIN"] : (int)$arr["VARIABEL"] ;			 
	}
	 
?>
<html>
<title>Perhitungan Usia</title>
<!--
<p align="center"><b><font color="#800000">Tunggu,</font><br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
-->
<?	
	if ($usia < 0 or $usia > 200){
		echo "<font face=Verdana size=1>Tanggal Lahir ".$KL->tgllahir." dan tanggal mulai asuransi ".$a.". Usia = ";
		echo $usia." tahun</font>";
		echo "<br>";
		echo "<p align=\"center\"><font face=Verdana size=2><strong>Kesalahan !!!</strong></p></font>";
		echo "Periksa Tanggal Lahir Klien atau Masukkan Tahun yang benar";
		printf("<br><a href=\"#\" onclick=\"javascript:window.close()\">Back</a>");
	} else {
	  // pengecualian usia produk AIP
	  if($prd=="AIP")
		{
		  if(($usia > 60) || ($usia==60 && $usiabl > 0))
			{   
		   	  echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value=''\">";
		      echo "<font color=red>Khusus Produk ANUITAS IDEAL PRIMA (AIP) usia tidak boleh melebihi 60 tahun!<br> ";
      		echo "Usia Tertanggungan berdasarkan mulai asuransi yang Anda masukkan adalah $usia tahun $usiabl bulan.<br><br>";
					echo "Masukkan tanggal mulai asuransi yang sesuai atau ganti dengan tertanggung/produk lain.</font><br><br>";
					printf("<a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.mulas.value='';".
								 "window.opener.document.ntryprop.mulas.focus();".
								 "window.opener.document.ntryprop.usia_th.value='';".
								 "window.opener.document.ntryprop.usia_bl.value='';".
								 "window.close()\">TUTUP</a>");
			} 
			else
			{
			    printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".		
	       	"window.opener.document.ntryprop.usia_bl.value='%s';".	
					"window.opener.document.ntryprop.lamapembpremi_th.value='%s';".
					"window.opener.document.ntryprop.lamapembpremi_th.focus();".					 																																											
				 	//"window.close();".
					"\" >",$usia,$usiabl,$var);
					
					echo "test1";
			}
		}
		else
		{
		
		//if ($usia<=$maksi && $usia>=$minim) {
		
  		if((substr($prd,0,2)=="AD") || $prd=="HTT")
  		{
			
  		printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".		
  	       	 "window.opener.document.ntryprop.usia_bl.value='%s';".	
  					 "window.opener.document.ntryprop.lamapembpremi_th.value='%s';".
						 "window.opener.document.ntryprop.lamapembpremi_th_default.value='%s';".	
  					 "window.opener.document.ntryprop.lamapembpremi_th.focus();".		
  				 	 "window.close();".
  					 "\" >",$usia,$usiabl,$var,$var); //$usia
  		} 
  		else
  		{
				 
  		printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".		
  	       	 "window.opener.document.ntryprop.usia_bl.value='%s';".	
  					 "window.opener.document.ntryprop.lamapembpremi_th.value='%s';".	
  					 "window.opener.document.ntryprop.lamapembpremi_th.focus();".		
  				 	 "window.close();".
  					 "\" >",$usia,$usiabl,$var);
  		}
		}
		/*
	 	} else {
     print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  	 print( "<!--\n" );
  	 print( "alert('Usia Tertanggung=$usia tahun, $usiabl bulan berada diluar batas $minim - $maksi\\nPremi / JUA Tidak Akan Dapat Dihitung')\n" );
  	 print( "//-->\n" );
  	 print( "</script>" );
	  }	 			 
		*/
	}
?>
</body>
</html>