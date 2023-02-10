<? 
  include "../../includes/common.php";
  include "../../includes/database.php";
	include "../../includes/formula44.php";
  include "../../includes/session.php";

	
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
		
	$DB=New database($userid, $passwd, $DBName);
  $FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
	
	function GetFormula($DBX,$kdrumus) {
	  $sql="select rumus from $DBUser.tabel_224_rumus ".
		     "where kdrumus='$kdrumus'";
   	$DBX->parse($sql);
    $DBX->execute();
    $arr=$DBX->nextrow();
		$rumus=$arr["RUMUS"];
		return $rumus;
	}
	
	function CompComm($DBX,$prefix,$noper,$premistd) {
	  $sql="begin $DBUser.compcomm('$prefix','$noper',$premistd); end;";
		$DBX->parse($sql);
		$DBX->execute();
		return;
	}
  
	$kdproduk=$FM->produk;
	$noagen=$FM->agen; 
	$sql="select namaproduk from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
  $prd=$DB->nextrow();
	$namaproduk=$prd["NAMAPRODUK"];
		
	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit,b.kdrumusbenefit, b.kdrumuspremi, c.namabenefit ".
       "from $DBUser.tabel_223_temp a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+)";
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();
			
if($propmtc14lanjut=="Lanjut") {
  foreach ($result as $foo => $arr) {
		  $kdproduk  = $arr["KDPRODUK"];
		  $kdbenefit = $arr["KDBENEFIT"];
			$premi = ${"prm".$kdbenefit};
			if (strlen($premi)==0) $premi="null";
			$benefit = ${"bnf".$kdbenefit};
			if (strlen($benefit)==0) $benefit="null";
			$sql="update $DBUser.tabel_223_temp ".
			     "set premi=$premi, nilaibenefit=$benefit".
  	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			echo $sql."<br>";
			$DB->parse($sql);
      $DB->execute();
	}    //foreach
		exit;
}

//if
/*********************************************************************************************************************/
?>
<html>
<head>
<title>Benefit Proposal Lanjutan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
function Lanjutkan(){
 document.porm.linkbnft.click();
}
</script>
</head>
<div align="center">
<p><b><font color="#800000">Tunggu,</font> <br>
<font color="#0000FF">Sedang Proses ...</font></b></p>

<body onload="javascript:Lanjutkan();" style="color: #ffffff;">

<form  method="POST" action="<? PHP_SELF; ?>" name="propmtc14" >
<font face="Verdana" size="2">
<table width=700 class=arial8>
<tr>
  <td>No. SP</td>
	<td>: 
<? 
if (strlen($noproposal) == 0){
	echo $prefixpertanggungan."-".$nopertanggungan; 
} else {
	echo $prefixpertanggungan."-".$noproposal; 
}
?> 
	</td>
	<td>Agen</td>
	<td>: <? echo $namaagen."  [".$noagen."]" ?> </td>
</tr>
<tr>
  <td>Kode Produk</td>
	<td>: <? echo $kdproduk . "&nbsp;".$namaproduk; ?> </td>
  <td>Lama Pemb. Premi</td>
	<td>: <? echo $FM->pt; ?> tahun</td>
</tr>
</table>

<table border=0 width="100%" class=arial8>
	<tr>
	<td >No.</td>
	<td >Kode Benefit</td>
	<td >Nama Benefit</td>
	<td >Periode Bayar</td>
	<td >Periode Benefit</td>
	<td >Jumlah Benefit</td>
	<td >Premi</td>
	<td >Jenis</td>
	</tr>
<?	
	$no = 1; $jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
  foreach ($result as $foo => $arr) {

		$kdproduk = $arr["KDPRODUK"];
		$kdbenefit = $arr["KDBENEFIT"];
		$namabenefit = $arr["NAMABENEFIT"];
		$kdjenisbenefit = $arr["KDJENISBENEFIT"];
 	  $kdrumus = $arr["KDRUMUSPREMI"];
		$rumuspremi = GetFormula($DB,$kdrumus);
 	  $kdrumus = $arr["KDRUMUSBENEFIT"];
		$rumusbenefit = GetFormula($DB,$kdrumus);
		if ($kdjenisbenefit=="R") {  //Additional benefit
			$FM->add1 = $arr["PERIODEBAYAR"];
			$FM->add2 = $arr["PERIODEBENEFIT"];
		}
				
		$hasilpremi = $arr["PREMI"];
		$hasilbenefit = $arr["NILAIBENEFIT"];
		
/*********************************************************************/ 
		if(is_null($hasilpremi)||is_null($hasilbenefit)||is_null($hasilexpirasi)) {
		  if ((strlen($rumuspremi)==0) && (strlen($rumusbenefit)==0)) {
		    $hasilpremi = 0;
		    $hasilbenefit = 0;
				$hasilexpirasi = NULL;
		  } else {	
				$FM->parse($rumuspremi);
		    $hasilpremi=$FM->execute($DB);
				$FM->parse($rumusbenefit);
        $hasilbenefit=$FM->execute($DB);	
				$FM->parse($rumusexpirasi);
        $hasilexpirasi=$FM->execute($DB);
				$FM->parse($rumusakhirpmb);
        $hasilakhirpmb=$FM->execute($DB);
        //khusus perlakuan produk JSP
  			  if ($kdproduk=="JSP"){
  				  if($kdbenefit=="WAIVER2"){
						  $hasilpremi=0;
						}
  				} 
				}
		}	//if
	
	  echo "<tr class=arial8>";
		echo "<td>$no</td>";
		echo "<td>".$kdbenefit."</td>";
		echo "<td>".$namabenefit."</td>";
		echo "<td align=center>".$arr["PERIODEBAYAR"]."</td>";
		echo "<td align=center>".$arr["PERIODEBENEFIT"]."</td>";
		echo "<td align=right>".number_format($hasilbenefit,2)."";
		echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hasilbenefit."></td>";
		echo "<td align=\"right\">".number_format($hasilpremi,2)."";
		echo "   <input type=\"hidden\" name=prm".$kdbenefit." value=".$hasilpremi." ></td>";
		echo "<td align=center>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "</tr>";
		
		//penanganan JL2
		if($kdkelompokbenefit=="C" || $kdjenisbenefit=="R") {
		    if(substr($kdproduk,0,3)=="JL2") {
						$FM->premi1 = $FM->premi1;
        }
				elseif($kdkelompokbenefit=="C")
				{
						$FM->premi1 = $FM->premi1 - $hasilpremi;
				}
				$hasilpremi = 0;
    }
		
		$jmlpremi = $jmlpremi + $hasilpremi; 
		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		$no ++;
	} 
	//foreach

/****************************************************************************************************/								
//echo $hpremiw."|".$hpremiu."|".$hpremiv."|".$hpremir."|".$hpremix."<br>";
	
			   $premi01 = &$FM->premi1;
				 $premi01 /= $FM->faktorbayar;
		 		 $premistandar= &$premi01;
				 
				 //$jua1 = 1000 * $premistandar / ($hpremiu + $hpremiv + $hpremir  + $hpremix + $hpremiw);
				 //Watch the FUCKing W				 
				 //$jua1 = 1000 * $premistandar / ($hpremiu + $hpremiv + $hpremir  + $hpremix );
				 
				 $jua1 = 1000 * $premistandar / $jmlpremi;

				 $sql = "update $DBUser.tabel_200_temp set juamainproduk='$jua1' ".
				 				"where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan'";
    		 //echo $sql;
				 //echo $FM->faktorbayar."|".$premi01."|".$premistandar."|".round($jua1);
				 
				 $DB->parse($sql);
	  		 $DB->execute();
	  		 $DB->commit();
/*****************************************************************************************************/								

	echo "<tr>";
	echo "<td colspan=\"5\" align=right><b>Jumlah</b></td>";
	echo "<td align=right></td>";
	echo "<td align=right><font face=\"Arial\" size=\"2\"><b>".number_format($jmlpremi,2)."</b></font></td>";
	echo "<td>&nbsp;</td>";
	echo "</tr>";
	echo "</table>";
	
	 ECHO "jumlah premi  : ". $jmlpremi;
?>
<table width="100%">
<tr>
	<td align="right">
	  <input type="hidden" name="mode" value="insert">
	  <input type="hidden" name="prefixpertanggungan" value="<? echo $prefixpertanggungan; ?>">
		<input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
		<input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
	  <input type="hidden" name="jmlpremi" value="<? echo $jmlpremi; ?>">
		<input type="hidden" name="vara" value="<? echo $vara; ?>">
	  <input type="hidden" name="jmlbenefit" value="<? echo $jmlbenefit; ?>">
	</td>
</tr> 
</table>
</form>
<?
echo "Premi Standard : ".$premistandar."<br>";
echo "JUA Kamp    : ".$jua1."<br>";
echo "Vara 					 : ".$vara."<br>";
echo "Kdper 				 : ".$kdper."<br>";


//echo "<form action=\"benefit1.php?vara=$vara&premijua=$premijua&jua1=$jua1&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper&waivermengkeb1=$waivermengkeb1&waivermengkeb2=$waivermengkeb2\" name=\"porm\" method=\"post\">";
echo "<form action=\"benefit1.php?vara=$vara&premijua=$premijua&jua1=$jua1&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper\" name=\"porm\" method=\"post\">";
echo "<input type=\"submit\" name=\"linkbnft\" value=\"...\" >";				
echo "</form>";
?>
</div>
</body>
</html>
