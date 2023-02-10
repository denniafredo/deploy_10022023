<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	
	$DB = New database($userid, $passwd, $DBName);
	
	if($kdproduk=="JSSP" || $kdproduk=="JSSPA" || $kdproduk=="JSSK" || $kdproduk=="JSSP6" || $kdproduk=="JSSPA6")
			{
			//CEK JUA MAKS
			if($juapremi=="jua"){
				$batas=$nilai;} else {$batas=$nilai*0.25;}
				
				$sql = "SELECT * FROM $DBUser.TABEL_226_BATAS_RESIKO WHERE KDPRODUK=
DECODE((SELECT COUNT(*) FROM $DBUser.TABEL_226_BATAS_RESIKO  WHERE KDPRODUK='$kdproduk'),0,'*','$kdproduk')";
				$DB->parse($sql);
				$DB->execute();
				//echo $sql;
				$rowuamax = $DB->nextrow();
				$uamaxallow = $rowuamax["RESIKOAWAL"];
				//echo 'batas'.$batas.' max'.$uamaxallow;
				//die;
				
				if($batas>= $uamaxallow)
				{
				//echo $sql.$nilai.'--'.$prmmaxallow;
				//echo "<body onload=\"javascript:window.opener.document.ntryprop.buton.disabled=true;\">";
				echo "<br />UA produk JS PLAN melebihi batas yang diperbolehkan. Proposal Harus Medical !<br />";
				
				echo "<script language=\"JavaScript\" type=\"text/javascript\">";
				  print( "\n" );
					echo "window.opener.document.ntryprop.kdstatusmedical[0].checked=true;";
				  print( "//-->\n" );
				  echo "</script>";
				printf("<br><a href=\"#\" onclick=\"javascript:window.close()\">Close</a>");
				die;
				}
				}
				
	if($juapremi=="jua"){
    	$sql = "select juaminimal from $DBUser.tabel_202_produk ".
    			   "where kdproduk='$kdproduk'";
    				 
    	$DB->parse($sql);
    	$DB->execute();
      $arr=$DB->nextrow();
    	$minjuapremi=$arr["JUAMINIMAL"];
  		echo "JUA MINIMAL : ".$minjuapremi." nilai masukan : ".$nilai;
		
		
	} else {
	
	    $sql = "select premiminimal from $DBUser.tabel_233_produk_cara_bayar ".
    			   "where kdproduk='$kdproduk' and kdcarabayar='$kdcarabayar'";
    				 
    	$DB->parse($sql);
    	$DB->execute();
      	$arr=$DB->nextrow();
		$minpremi=$arr["PREMIMINIMAL"];
		
		if($kdproduk=="AI0" && ($kantor=="EI" || $kantor=="EH" || $kantor=="LB") ) {$minpremi=0;} else {$minpremi=$minpremi;} //request bo email 04032015
    	
  		
	    
			$minjuapremi = $minpremi!="" ? $arr["PREMIMINIMAL"] : 200000;
			
			//======khusus siharta sukabumi JSSHTT=====
			if($kantor=="BC" && $kdproduk=="JSSHTT"){
				$minjuapremi=1100000;
			} else {$minjuapremi=$minjuapremi;}
			//======khusus siharta sukabumi JSSHTT=====
			
	  	//$minjuapremi=100000;
			//if($kdproduk=="JSSPO4" || $kdproduk=="JSSPO5" || $kdproduk=="JSSPO6")
			if($kdproduk=="JSSPAN3" || $kdproduk=="JSSPAN6" || $kdproduk=="JSSPAN12"  || $kdproduk=="JSSPAN24")
			{
			
			  //echo $nospaj;
				
			  //$sql = "select count(nopertanggungan) as jlmpolis, sum(premi1) as jmlpremi
              //  from $DBUser.tabel_200_pertanggungan where kdproduk in('JSSPO4','JSSPO5','JSSPO6')
              //  and kdstatusfile='1'";
				$sql = "SELECT QUOTA, (SELECT SUM (premi1) AS jmlpremi
				  FROM   $DBUser.tabel_200_pertanggungan ptg, $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN aks where 
				  ptg.prefixpertanggungan=aks.prefixpertanggungan and ptg.nopertanggungan=aks.nopertanggungan and 
				  KDPRODUK=a.kdproduk 
				  AND kdstatusfile = '1' and kdacceptance='1'
				  group by kdproduk) JMLPREMI FROM $DBUser.tabel_233_produk_cara_bayar a
				  WHERE KDPRODUK='$kdproduk'";
				//echo $sql;
				//die;
				$DB->parse($sql);
				$DB->execute();
				$row = $DB->nextrow();
      	
				$currentpremi   = $row["JMLPREMI"];				
				$maxallow 		= $row["QUOTA"]-$row["JMLPREMI"];
				$premitemp 		= $currentpremi+$nilai;
				
				//echo "<br />premiakanmasuk = ".$nilai;
				echo "<br />QUOTA = ".number_format($row["QUOTA"],2);
				echo "<br />SISA QUOTA = ".number_format($maxallow,2);
				//echo "<br />currentpremi = ".number_format($currentpremi,2);
				echo "<br />PREMI = ".number_format($premitemp,2)."<br />";
				
				
				
				//tutup sementara karean ada proposal ketinggalan di BO
				
//				if($premitemp > $maxallow)
				if($premitemp > $row["QUOTA"])
				{
				echo "<body onload=\"javascript:window.opener.document.ntryprop.buton.disabled=true;\">";
				echo "<br /><h3>Proposal tidak boleh dilanjutkan</h3>Premi produk JS PLAN melebihi batas yang diperbolehkan. Silakan hubungi kantor pusat";
				printf("<br><a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.nilai.value='';window.close()\">Close</a>");
				die;
				}
				/*
				else
				{
					echo "PREMI MINIMAL : ".$minpremi." nilai masukan : ".$nilai;
				}
				*/
				
			}
			else if($kdproduk=="JSSP" || $kdproduk=="JSSPA" || $kdproduk=="JSSK" || $kdproduk=="JSHOG")
			{
			
				$sql = "SELECT PREMIMAX FROM $DBUser.tabel_233_produk_cara_bayar
				  WHERE KDPRODUK='$kdproduk'";
				$DB->parse($sql);
				$DB->execute();
				//echo $sql;
				$rowpmax = $DB->nextrow();
				$prmmaxallow = $rowpmax["PREMIMAX"];
				if($nilai > $prmmaxallow)
				{
				//echo $sql.$nilai.'--'.$prmmaxallow;
				echo "<body onload=\"javascript:window.opener.document.ntryprop.buton.disabled=true;\">";
				echo "<br /><h3>Proposal tidak boleh dilanjutkan</h3>Premi produk JS PLAN melebihi batas yang diperbolehkan. Silakan hubungi kantor pusat";
				printf("<br><a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.nilai.value='';window.close()\">Close</a>");
				die;
				}
				
				
			}
	}
	
?>
<html>
<title>Cek Limit Jua/Premi</title>
<?	
if($kdvaluta==3)
{
  echo "<body onload=\"javascript:window.close()\">";
}
elseif(substr($kdproduk,0,4)=="JSHF")
{
	echo "<body onload=\"javascript:window.opener.document.ntryprop.buton.disabled=false;
	           window.opener.document.ntryprop.nilai.value='5000000';
						 window.opener.document.ntryprop.premijua.value='jua';
						 window.opener.document.ntryprop.buton.disabled=true;
						 window.opener.document.ntryprop.buton.value = 'Hitung Premi';
						 window.opener.document.ntryprop.submit.disabled=true;
						 window.opener.document.ntryprop.buton.title = 'Hitung Premi';
						 window.opener.document.ntryprop.cekpolis.disabled=false;
						 window.opener.document.ntryprop.cekpolis.focus();
						 window.close();
						 \">";
}
else
{
	if ($minjuapremi=="" || $nilai >= $minjuapremi)
	{
//			if(substr($kdproduk,0,5)=="JSSPO" && $juapremi=="premi")
			if ($kdproduk=='JSSPOA' || $kdproduk=='JSSPO7A' || $kdproduk=='JSSPO8' || $kdproduk=='JSSPO9')
			{
				echo "<body onload=\"javascript:window.close()\">";
			}
			else if((substr($kdproduk,0,4)=="JSSP"||substr($kdproduk,0,4)=="JSSK") && $juapremi=="premi")
			{			 
			  $batas = 100000;
				//$filterpremi = $nilai%$batas;
//				$filterpremi = $nilai/500000;
				if (substr($kdproduk,0,4)=="JSSP"){
					if (substr($kdproduk,0,5)=="JSSPA"){
					$kelipatan=1000000;
					}else{
					$kelipatan=1000000;}
				}
				else if (substr($kdproduk,0,4)=="JSSK"){
					$kelipatan=1000000;}
				
				
				$filterpremi = $nilai/$kelipatan;
				$hasilpembagian = round($filterpremi,0);
				
				$filterpremi = $nilai-($hasilpembagian*$kelipatan);
				
				//echo $filterpremi."<br />";
				
			  if($filterpremi==0)
				{
				  echo "<body onload=\"javascript:window.close()\">";
					echo "Kondisi OK";
				}
				else
				{
				  echo "<body onload=\"javascript:window.opener.document.ntryprop.buton.disabled=true;\">";
				  echo "Produk $kdproduk harus kelipatan Rp. ".number_format($kelipatan,2);
				}
			 
			}
			else
			{ 
			
			echo "<body onload=\"javascript:window.close()\">";
			echo "Kondisi OK";
		  }
			
  } 
	else 
	{
	   if($juapremi=="jua"){
		 		$varjuapremi="Jua";
		 } else {
		 	  $varjuapremi="Premi";
		 }
			
			
			echo "<body onload=\"javascript:window.opener.document.ntryprop.buton.disabled=true;window.opener.document.ntryprop.nilai.value=''\">";
		    echo "Anda pilih produk $kdproduk. $varjuapremi yang Anda masukkan kurang dari Rp. ".number_format($minjuapremi,2)."!<br> ";
      		echo "Masukkan nilai $varjuapremi sesuai dengan ketentuan yang berlaku. ";
      		
					printf("<br><a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.nilai.value='';window.close()\">Close</a>");
	} 
}
?>
</body>
</html>