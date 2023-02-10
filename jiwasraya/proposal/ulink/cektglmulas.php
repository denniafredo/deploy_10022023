<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<title>Cek Awal Mulas</title>
<?	
/* 04/10/2007		update pembatasan tanggal mulai asuransi,
	 							hanya diperbolehkan +- 1 bulan dari tanggal entry
								request by mulyono
								updated by jro			 
*/
//$blnmulas = substr($tglsp,3,2);
$bulannow = date('m');
$tahunnow = date('Y');
$blnmulas = substr($mulas,3,2);
$tglmulas = substr($mulas,0,2);
$selisihbulan = $bulannow-$blnmulas;
//echo $selisihbulan;
//die;
$thnmulas = substr($mulas,-4);

//echo $selisihbulan;

//01 / 12 /2007 
//01 / 1 /2008 *  1 - 11 = -10
//echo $thnmulas ." = ".$tahunnow;

/* 02/01/2008		update pembatasan tanggal mulai asuransi,
								updated by Ari			 
								==> && ($thnmulas+1)>$tahunnow
*/
if($thnmulas!=$tahunnow && ($thnmulas+1)>$tahunnow)// && $selisihbulan > -11) )// || ($thnmulas!=$tahunnow && $selisihbulan > -11))
{
  $selisihbulan = 100;
} 

/* 02/01/2008		update pembatasan tanggal mulai asuransi,
								updated by Ari			 
								==> && $selisihbulan != -11
*/
   //die;
if($selisihbulan > 1 || ($selisihbulan < -1 && $selisihbulan != -11))
{
  echo $selisihbulan;
	
  echo "Not Allow...";
  //die;
	?>
  <script language="JavaScript" type="text/javascript">
  <!--
	window.opener.document.ntryprop.mulas.value='';
	window.opener.document.ntryprop.mulas.focus();
	//window.opener.document.ntryprop.usia_th.value='';
  alert('Tanggal Mulai Asuransi yang Anda masukkan tidak sesuai ketentuan!');
  //-->
  </script>
	<?
	$defaulttglsp = "01/".$bulannow."/".date('Y'); 
}
else
{
	$defaulttglsp = $tglmulas."/".$blnmulas."/".$thnmulas;
}
//echo $defaulttglsp;
//die;

//$tomorrow = date('d/m/Y',mktime()+86400);
//$defaulttglsp = $tomorrow;
//echo $defaulttglsp;

/*
$thnmulas = substr($mulas,-4);
$defaulttglsp = "01/".$blnmulas."/".date('Y'); 
//$defaulttglsp = "01/".$blnmulas."/".$thnmulas; 
*/

                     //die;
if(substr($kdproduk,0,5)!="JSSPO") 
{
  if($kdproduk=="AEP" || $kdproduk=="AEP1" || $kdproduk=="AEP2" || $kdproduk=="AEP3" || $kdproduk=="AI0" || $kdproduk=="AIP" || $kdproduk=="ASI" || $kdproduk=="ASP"  || $kdproduk=="PAA"  || $kdproduk=="PAB" || substr($kdproduk,0,3)=="JL2" || substr($kdproduk,0,3)=="JL4")
	{
	 echo "<body onload=\"javascript:window.close();\">";
	}
	elseif(substr($kdproduk,0,4)=="JSSP") //Oleh Dedi 8/7/2011
	{
   echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value='$mulas';window.close();\">";
  } // Akhir Oleh Dedi 8/7/2011
  else
	{
   echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value='$defaulttglsp';window.close();\">";
  }
}
else
{
	echo $kdproduk." - ".$tglsp;
  $nextmonth = substr($tglsp,3,2);
	$nextmonth = str_pad($nextmonth,2,"0",STR_PAD_LEFT);
	$tglspjsspo = "01/".$nextmonth."/".date('Y'); 
	echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value='$tglspjsspo';window.close();\">";
	/*  
  if(substr($tglsp,0,2) > 20)
	{
	  $nextmonth = substr($tglsp,3,2)+1;
		$nextmonth = str_pad($nextmonth,2,"0",STR_PAD_LEFT);
		
		$tglspjsspo = "01/".$nextmonth."/".date('Y'); 
	  echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value='$tglspjsspo';window.close();\">";
	}
	else
	{
	  echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value='$defaulttglsp';window.close();\">";
	}
	*/
}
?>

</body>
</html>