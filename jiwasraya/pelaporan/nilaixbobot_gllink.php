<? 
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	
?>

<html>
<head>
<title>Detail Rincian Per Rekening</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<div align="center">
<table border="0" class="tblborder" cellspacing="1" width="100%" cellpadding="1" align="center">
			<tr class="tblhead">
				 <td align="center" colspan="6">DETAIL RINCIAN PER REKENING</td>
			</tr>

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center" rowspan="2">No</td>
						<td align="center" rowspan="2">Kode Akun</td>
						<td align="center" rowspan="2">Nama Akun</td>
						<td align="center" colspan="3">Jumlah</td>
					 </tr>
					 <tr class="hijao">
					  <td align="center" width="10%">Kredit</td>
						<td align="center" width="10%">Debet</td>
					  <td align="center" width="10%">Total</td>
					 </tr>					 
<?
	if ($_GET["wherektr"]==''){
		 $wherektr="";
	}
	else{
		if (strlen($_GET["wherektr"])==1){
		 $wherektr="kdkantor like '".$wherektr."%' and ";	
		}
		else if (substr($_GET["wherektr"],1,1)=='Z'){
		 $wherektr="kdkantor like '".substr($wherektr,0,1)."%' and ";	
		}
		else{
		 $wherektr="kdkantor='".$wherektr."' and ";	
		}
	}

	$kdrekening="('";
	$ptrakun=0;
	while ($ptrakun<=strlen($_GET["akun"])){
	   $kdrekening=$kdrekening.substr($_GET["akun"],$ptrakun,6)."','";
		 $ptrakun=$ptrakun+6;
	}
	$kdrekening=substr($kdrekening,0,strlen($kdrekening)-5).")";

	$i=1;
  $DBS = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
  $DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
  $sqa = "select AKUN AS KDAKUN, nama as NAMAAKUN ".
         "from $DBUser.tabel_802_kodeakun ".
  			 "where AKUN in ".$kdrekening." order by AKUN";
//	echo $sqa."<br>";
  $DBS->parse($sqa);
  $DBS->execute();
	while ($ary=$DBS->nextrow()){
		$kdakun=$ary["KDAKUN"];
		$namaakun=$ary["NAMAAKUN"];
    $sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
           "from $DBUser.tabel_802_trvouc ".
    			 "where ".$wherektr."substr(notrans,0,1) in ('B','K') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
    			 "akun='".$kdakun."'";
//		echo $sq2;		
    $DBA->parse($sq2);
    $DBA->execute();
		if ($arx=$DBA->nextrow()){
			 $debet=$arx["DEBET"];
			 $kredit=$arx["KREDIT"];
			 $total=$kredit-$debet;
		}
		else{
			 $debet=0;
			 $kredit=0;
			 $total=0;
		}

    $totaldebet=$totaldebet+$debet;
    $totalkredit=$totalkredit+$kredit;
    $totaltotal=$totaltotal+$total;
		
  	include "../../includes/belang.php";
    echo "<td class=arial8 align=\"right\">$i</td>\n";
    echo "<td class=arial8 align=\"center\">".$kdakun."</td>\n";
    echo "<td class=arial8 align=\"left\">".$namaakun."</td>\n";
    echo "<td class=arial8 align=\"right\">".number_format($kredit,2)."</td>\n";
    echo "<td class=arial8 align=\"right\">".number_format($debet,2)."</td>\n";
    echo "<td class=arial8 align=\"right\">".number_format($total,2)."</td>\n";
		echo "</tr>";
  	$i++;
  }
?>
				
    		 	 </table>
    		</td>	 
    </tr>
	</table>	 
<!--
<table width="100%">
	<tr>
    <td width="50%" class="arial10" align="left"><a href="#" onclick="window.print()">Print</a></td>
		<td width="50%" class="arial10" align="right"><a href="#" onclick="window.close()">Close</a></td>
	</tr>
</table>
-->

<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="hijao">
		 <td align="center" colspan="5">RESUME REKENING</td>
	</tr>
  <tr class="hijao">
		<td align="center" class="arial10">Kredit</td>
		<td align="center" class="arial10">Debet</td>
		<td align="center" class="arial10">Total</td>
	</tr>
<?$i=2;?>	
<?include "../../includes/belang.php";?>	
		<td align="right" class="arial10"><?=number_format($totalkredit,2);?></td>
		<td align="right" class="arial10"><?=number_format($totaldebet,2);?></td>
		<td align="right" class="arial10"><?=number_format($totaltotal,2);?></td>
	</tr>
</table>

</div>
<br>
<? 
	 echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; 
?>
</body>
</html>
