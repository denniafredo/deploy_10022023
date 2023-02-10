<? 

	  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
//	$kon=ocilogon("CKADM","CKADM","CKADM");
$DB=new database($userid, $passwd, $DBName);
//if((date("d")=="1" || date("d")=="2" || date("d")=="3") || ($userid=="DEDI" || $userid=="YUNITA_H" || $userid=="TITIN_EH" || $userid=="TATI_BC")){
	?>
<html>
<head>
<title>Untitled</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<!--<meta http-equiv="refresh" content="1000;url=http://192.168.2.23/jiwasraya/pelaporan/lipp_ob1.php" />-->  
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

-->
</style>
</head>
<body>
<table width="1000">
  <tr class="arial10blkb">
    <td width="100%" align="center">&nbsp;</td>
	</tr>
</table>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Bulan Entry</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	<a href='summary_report_billing.php?action=refresh'> [Refresh]</a>
	</td>
  </tr>
	</form>
	</table>
	<?		
	//$uraian=array("SALDO AWAL","NOTA TAGIHAN PREMI BERKALA LANJUTAN","PEMBTAN TAGIHAN","RETOUR TAGIHAN","JUMLAH TAGIHAN","PELUNASAN","SALDO AKHIR");	
	
		      if($vbln==""){
							   $DB=new database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode=" a.tglbooked=to_date('$thisperiode', 'MMYYYY')";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode=" tglbooked=to_date('$thisperiode', 'YYYY')";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode=" tglbooked=to_date('$thisperiode', 'MMYYYY')";
          }
					switch ($bln)	{
		          case "01": $blnn = "Januari"; break;
	            case "02": $blnn = "Pebruari"; break;
	            case "03": $blnn = "Maret"; break;
		          case "04": $blnn = "April"; break;
		          case "05": $blnn = "Mei"; break;
		          case "06": $blnn = "Juni"; break;
		          case "07": $blnn = "Juli"; break;
		          case "08": $blnn = "Agustus"; break;
		          case "09": $blnn = "September"; break;
		          case "10": $blnn = "Oktober"; break;
		          case "11": $blnn = "Nopember"; break;
		          case "12": $blnn = "Desember"; break;
           }					 
$DB=new database($userid, $passwd, $DBName);	

 $periodenya=$bln.$vthn;
if(substr($periodenya,2,4)=='2013'){
$tglrekam=" ";
}else{
	$tglrekam=" AND TO_CHAR(a.tglrekam,'ddmmyyyy')='01".$periodenya."' AND BILLSTATUS='1'";
}

$per=$vthn.$bln;
if ($per <= 201603) {$tabel="$DBUser.tabel_300_historis_premi";} else {$tabel="$DBUser.TABEL_300_NOTA_DEBET_TEMP";}

if ($per <= 201701) {$tabelrdr="$DBUser.tabel_300_historis_rider";} else {$tabelrdr="$DBUser.TABEL_300_NOTA_DEBET_TEMP_RDR";}
/*
if($_GET['action']=='refresh'){
	$sql = "begin $DBUser.refresh_summary_report_billing ( '".$userid."' );end;";
	$DB->parse($sql);
	$DB->execute();
	//echo $sql;
}*/

  echo "<hr size=1>";
	echo "<div align=left>";
  				 //echo "<font color=\"003399\" face=verdana size=2><b>RINCIAN NOTA DEBET  $kantor PERIODE ".strtoupper($blnn)." $vthn</b></font><br><br>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>SUMMARY REPORT BILLING</b></font><br><br>";
					 echo "<table border=1 style='border-collapse:collapse' bordercolor=#333333>";
					 echo "<tr class=\"hijao\">";					 
					 echo "<td align=center><b>No</b></td>";					 
					 echo "<td align=center><b>Keterangan</b></td>";					 
					 echo "<td align=center><b>Jumlah</b></td>";					 					 					
					 echo "<td align=center><b>Action</b></td>";					 					 					
  				 echo "</tr>";
				 $sql="select (select count(*) from $DBUser.summary_report_porto_aktif where periode = a.periode) porto_aktif,
						   count(*) porto_jatuh_tempo,
						   sum(terbilling) berhasil_billing_pokok,
						   sum(
						   case when terbilling = 0 then    
							1
						   else
							0 
						   end 
						   ) gagal_Billing_pokok,to_char(periode,'mm/yyyy') periode
					   from $DBUser.summary_report_status_billing a
					   where to_char(periode,'mm/yyyy') = trim(to_char('$vbln','00'))||'/'||'$vthn' 
					   group by a.periode";		 
		 //$tglrekam." AND BILLSTATUS='1'".	
		 //"AND TO_CHAR(a.tglrekam,'ddmmyyyy')='01".$periodenya."' $tglrekam";
		 //"AND BILLSTATUS='1'";	
		 //echo $sql;
		 //die;
		 $DB->parse($sql);
		 $DB->execute();	
		 $i=1;	 
			while($arr=$DB->nextrow()){
			echo "<tr>";
				echo "<td align=right>".$i++.". </td>";
				echo "<td>Portofolio Aktif</td>";
				echo "<td align=right>".number_format($arr["PORTO_AKTIF"],0,",",".")."</td>";			
				echo "<td><a href=# onclick=NewWindow('summary_report_billing_aktif.php?periode=".$arr["PERIODE"]."&act=AKTIF','',700,400,1)>Download</a></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=right>".$i++.". </td>";
				echo "<td>Portofolio Jatuh Tempo</td>";
				echo "<td align=right>".number_format($arr["PORTO_JATUH_TEMPO"],0,",",".")."</td>";			
				echo "<td><a href=# onclick=NewWindow('summary_report_billing_download.php?periode=".$arr["PERIODE"]."&act=TEMPO','',700,400,1)>Download</a></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=right>".$i++.". </td>";
				echo "<td>Sukses Billing</td>";
				echo "<td align=right>".number_format($arr["BERHASIL_BILLING_POKOK"],0,",",".")."</td>";			
				echo "<td><a href=# onclick=NewWindow('summary_report_billing_download.php?periode=".$arr["PERIODE"]."&act=SUKSES','',700,400,1)>Download</a></td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td align=right>".$i++.". </td>";
				echo "<td>Gagal Billing</td>";
				echo "<td align=right>".number_format($arr["GAGAL_BILLING_POKOK"],0,",",".")."</td>";			
				echo "<td><a href='summary_report_billing_detail.php?periode=".$arr["PERIODE"]."'>View</a></td>";
			echo "</tr>";			
			}			
           echo "</table>";					
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"../submenu.php?mnuinduk=600\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>  |   ";

echo "<a href=# onclick=NewWindow('dl_rinciannotadebet.php?act=printY&periodenya=".$periodenya."&ktr=".$kantor."','',700,400,1)><font face=\"Verdana\" size=\"2\">Download Excel</font></a> ";
//}else{
//	echo "Menu Ini Hanya Dapat Diakses pada Tanggal 1,2,3 setiap bulannya";
//}
?>

