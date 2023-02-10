<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DB = new Database($userid, $passwd, $DBName);
	//$DBUL=New database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
	//$DBX=new database($userid, $passwd, $DBName);
	
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Premi JS LINK</title>
</head>
<style type="text/css">
<!-- 
body, td, select, input {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
LAPORAN PENERIMAAN PREMI JS LINK
<?
function toTglIna($tglid)
{
      $tgl = substr($tglid,-2);
			$bul = substr($tglid,5,2);
			$thn = substr($tglid,0,4);
			switch ($bul)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
			$formattanggal = $tgl." ".strtoupper($bln)." ".$thn;
			return $formattanggal;
}
#---dateadd
#$newdate = dateadd("d",3,"2006-12-12");	#  add 3 days to date
#$newdate = dateadd("s",3,"2006-12-12");	#  add 3 seconds to date
#$newdate = dateadd("m",3,"2006-12-12");	#  add 3 minutes to date
#$newdate = dateadd("h",3,"2006-12-12");	#  add 3 hours to date
#$newdate = dateadd("ww",3,"2006-12-12");	#  add 3 weeks days to date
#$newdate = dateadd("m",3,"2006-12-12");	#  add 3 months to date
#$newdate = dateadd("yyyy",3,"2006-12-12");	#  add 3 years to date
#$newdate = dateadd("d",-3,"2006-12-12");	#  subtract 3 days from date

function dateAdd($interval,$number,$dateTime) {
		
	$dateTime = (strtotime($dateTime) != -1) ? strtotime($dateTime) : $dateTime;	   
	$dateTimeArr=getdate($dateTime);
				
	$yr=$dateTimeArr[year];
	$mon=$dateTimeArr[mon];
	$day=$dateTimeArr[mday];
	$hr=$dateTimeArr[hours];
	$min=$dateTimeArr[minutes];
	$sec=$dateTimeArr[seconds];

	switch($interval) {
		case "s"://seconds
			$sec += $number; 
			break;

		case "n"://minutes
			$min += $number; 
			break;

		case "h"://hours
			$hr += $number; 
			break;

		case "d"://days
			$day += $number; 
			break;

		case "ww"://Week
			$day += ($number * 7); 
			break;

		case "m": //similar result "m" dateDiff Microsoft
			$mon += $number; 
			break;

		case "yyyy": //similar result "yyyy" dateDiff Microsoft
			$yr += $number; 
			break;

		default:
			$day += $number; 
         }	   
				
		$dateTime = mktime($hr,$min,$sec,$mon,$day,$yr);
		$dateTimeArr=getdate($dateTime);
		
		$nosecmin = 0;
		$min=$dateTimeArr[minutes];
		$sec=$dateTimeArr[seconds];

		if ($hr==0){$nosecmin += 1;}
		if ($min==0){$nosecmin += 1;}
		if ($sec==0){$nosecmin += 1;}
		
		if ($nosecmin>2){ 	return(date("Y-m-d",$dateTime));} else { 	return(date("Y-m-d G:i:s",$dateTime));}
}

#---end dateadd 
echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function unitLink($no,$kdktr,$tglAwalCari,$tglSampaiCari,$DBX,$pil,$kdktrbo)
{
	GLOBAL $jmlpolis;
	GLOBAL $jmlpremisub;
	GLOBAL $jmlpremitop;
	GLOBAL $jmlpremired;
	GLOBAL $jmlpolisx;
	GLOBAL $jmlpolisx2;
	GLOBAL $berkala1x;
	GLOBAL $sekaligus1x;
	GLOBAL $topupskg1x;
	GLOBAL $topupbkx;
	GLOBAL $berkala1x2;
	GLOBAL $sekaligus1x2;
	GLOBAL $topupskg1x2;
	GLOBAL $topupbkx2;
	
// Transaksi Entry Proposal
  /*$sqx = "select prefixpertanggungan as POLIS from $DBUser.tabel_200_pertanggungan where kdproduk like 'JL%' and (kdpertanggungan='1' or kdpertanggungan='2') and ".
				 "prefixpertanggungan='".substr($kdktr,0,2)."' and ".
			   "to_char(tglrekam,'YYYYMMDD')>='".$tglAwalCari."' and ".
			   "to_char(tglrekam,'YYYYMMDD')<='".$tglSampaiCari."'";		*/	 

	$sqx="select a.nopertanggungan as KAMPRET,a.juamainproduk, a.premi1,a.kdcarabayar as CARA,a.kdproduk,substr(a.kdproduk,-1) as kdprodgroup,a.mulas,a.tglcetak, ".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='DEATHMA') as PREM,".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUP') as TUBKL,  ".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') as TUSKG ".
		"from $DBUser.tabel_200_pertanggungan a, ".
		"$DBUser.tabel_214_acceptance_dokumen b, ".
		"$DBUser.tabel_400_agen c, ".
        "$DBUser.tabel_410_area_office d ".
		"where a.nopertanggungan=b.nopertanggungan ".
		"and a.kdproduk like '$pil' and b.kdacceptance='1' ".
		"and a.tglcetak is not null and a.prefixpertanggungan='".substr($kdktrbo,0,2)."' and a.kdstatusfile in ('1','4') ".
		"and a.mulas between to_date('".$tglAwalCari."','YYYYMMDD')and to_date('".$tglSampaiCari."','YYYYMMDD') ".
		"AND a.noagen = c.noagen ".
	    "AND c.kdkantor=d.kdkantor ".
	    "AND c.kdareaoffice=d.kdareaoffice ".
	    "AND c.kdareaoffice='".substr($kdktr,0,2)."' order by a.prefixpertanggungan";
	
$sqxw="select a.nopertanggungan as KAMPRET,a.juamainproduk, a.premi1,a.kdcarabayar as CARA,a.kdproduk,substr(a.kdproduk,-1) as kdprodgroup,a.mulas,a.tglcetak, ".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='DEATHMA') as PREM,".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUP') as TUBKL,  ".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') as TUSKG ".
		"from $DBUser.tabel_200_pertanggungan a, ".
		"$DBUser.tabel_214_acceptance_dokumen b, ".
		"$DBUser.tabel_400_agen c, ".
        "$DBUser.tabel_410_area_office d ".
		"where a.nopertanggungan=b.nopertanggungan ".
		"and a.kdproduk like '$pil' and b.kdacceptance='1' ".
		"and a.tglcetak is not null and a.prefixpertanggungan='".substr($kdktrbo,0,2)."' and a.kdstatusfile in ('1','4') ".
		"and a.mulas between to_date('".$tglSampaiCari."','YYYYMMDD')-7 and to_date('".$tglSampaiCari."','YYYYMMDD') ".
		"AND a.noagen = c.noagen ".
	    "AND c.kdkantor=d.kdkantor ".
	    "AND c.kdareaoffice=d.kdareaoffice ".
	    "AND c.kdareaoffice='".substr($kdktr,0,2)."' order by a.prefixpertanggungan";
	//echo $sqx;
  $DBX->parse($sqx);
  $DBX->execute();					 
  //$arx=$DBX->nextrow();
  		$p=0;
		while ($arx=$DBX->nextrow()) {
			if($arx["CARA"]!="X"){
			$berkala2=$berkala2+$arx['PREM'];
			}
			else{
			$sekaligus2=$sekaligus2+$arx['PREM'];
			}
			$topupskg2=$topupskg2+$arx['TUSKG'];
			$topupbk2=$topupbk2+$arx['TUBKL'];
			$p++;;
		}
  //-------week
  $DBX->parse($sqxw);
  $DBX->execute();					 
  //$arx=$DBX->nextrow();
  		$pw=0;
		while ($arxw=$DBX->nextrow()) {
			if($arxw["CARA"]!="X"){
			$berkala1=$berkala1+$arxw['PREM'];
			}
			else{
			$sekaligus1=$sekaligus1+$arxw['PREM'];
			}
			$topupskg1=$topupskg1+$arxw['TUSKG'];
			$topupbk1=$topupbk1+$arxw['TUBKL'];
			$pw++;;
		}  
		$jmlpolisx=$jmlpolisx+$pw;
		$jmlpolisx2=$jmlpolisx2+$p;
		$berkala1x=$berkala1x+$berkala1;
		$sekaligus1x=$sekaligus1x+$sekaligus1;
		$topupskg1x=$topupskg1x+$topupskg1;
		$topupbkx=$topupbkx+$topupbk1;
		
		$berkala1x2=$berkala1x2+$berkala2;
		$sekaligus1x2=$sekaligus1x2+$sekaligus2;
		$topupskg1x2=$topupskg1x2+$topupskg2;
		$topupbkx2=$topupbkx2+$topupbk2;
// Periode Tgl Awal s/d Tgl Sampai
  
	
	//---------------------start seminggu sebelum
	
	//jumlah polis
	  
	$sub1=0;
	$top1=0;
	$red1=0;
  //while ($row = mssql_fetch_array($msresults)){
		// Subcription atau TopUp
    /*if($row["jenistransaksi"]==0){
			 if ($row["refNo"]==$row["refID"]){
		   		$sub1=$sub1+$row["nilaiinvestasi"];
			 }
			 else{																																
		      $top1=$top1+$row["nilaiinvestasi"];
			 }																																
    }
		// Redemption
    elseif($row["jenistransaksi"]==1){
		   $red1=$red1+$row["redemption"];  		
    }*/
	
		//$topupskg2=$topupskg2+$row["TU"];
	//}
	
	$rtnValue="";
	

	$rtnValue= "<tr bgcolor=#".($no % 2 ? "ffffff" : "dddddd").">".
            		"<td>".$no."</td>".
            		"<td nowrap>".$kdktr."</td>".
            		"<td align=\"right\">".$pw."</td>".
            		"<td align=\"right\">".number_format($berkala1,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($sekaligus1,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($topupskg1,2,",",".")."</td>".
					"<td align=\"right\">".number_format($topupbk1,2,",",".")."</td>".
            		"<td align=\"right\">".$p."</td>".
					"<td align=\"right\">".number_format($berkala2,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($sekaligus2,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($topupskg2,2,",",".")."</td>".
					"<td align=\"right\">".number_format($topupbk2,2,",",".")."</td>".
            		"<td>$jml</td>".
          	 "</tr>";


  return $rtnValue;	
}

function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Tanggal
		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
        print("<select name=" . $inName .  "tgl>\n"); 
//				print ("<option value=0>---</option>");
        for($currentDay = 1; $currentDay<= 31;$currentDay++) 
        { 
            print("<option value=\"$currentDay\""); 
            //if(date( "j", $useDate)==$currentDay) 
			if($selected==$currentDay) 
            { 
                print(" selected"); 
            } 					
            print(">$currentDay\n"); 						
        } 
        print("</select>"); 

// Bulan	
		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
        print("<select name=" . $inName .  "bln>\n"); 
//				print ("<option value=0>------</option>");
        for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
        { 
            switch($currentMonth)
            {
              case '1' : $namabulan ="JANUARI"; break ;
              case '2' : $namabulan ="FEBRUARI"; break ;
              case '3' : $namabulan ="MARET"; break ;
              case '4' : $namabulan ="APRIL"; break ;
              case '5' : $namabulan ="MEI"; break ;
              case '6' : $namabulan ="JUNI"; break ;
              case '7' : $namabulan ="JULI"; break ;
              case '8' : $namabulan ="AGUSTUS"; break ;
              case '9' : $namabulan ="SEPTEMBER"; break ;
              case '10' : $namabulan ="OKTOBER"; break ;
              case '11' : $namabulan ="NOVEMBER"; break ;
              case '12' : $namabulan ="DESEMBER"; break ;
            }
						
            print("<option value=\"$currentMonth\""); 
            //if(date( "n", $useDate)==$currentMonth) 
			if($selected==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

// Tahun				
		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
//        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            //if(date( "Y", $useDate)==$currentYear) 
			if($selected==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
				//print ("<option value=ALL>*</option>");
        print("</select>"); 
} 

echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
//echo "      <td class=\"verdana9blk\">Periode Entry Proposal/Transaksi</td>";
echo "      <td class=\"verdana9blk\">Periode Mulai Asuransi</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> s/d </td> ";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("s");
echo "      </td>";

echo "      <td class=\"verdana9blk\"> </td> ";
echo "      <td class=\"verdana9blk\">";
echo			"<select name=\"filter_produk\">";
echo "				 <option value=all>PILIH PRODUK</option>";
		$sql = "select distinct namaproduk from $DBUser.tabel_202_produk where substr(kdproduk,1,3)='JL2' AND STATUS IS NULL";
		//	echo $sqa;
		$DB->parse($sql);
		$DB->execute();	
		$i=0;				 
		while($row_produk=$DB->nextrow()) {
			IF(substr($row_produk['NAMAPRODUK'],8,1)=="B") {
			$kdprod="JL2%B";
			}
			elseif(substr($row_produk['NAMAPRODUK'],8,1)=="E") {
			$kdprod="JL2%E";
			}
			else  {
			$kdprod="JL2%F";
			}		
																	
			echo	'<option value="'.$kdprod.'"'.(($kdprod==$_POST['filter_produk']) ? ' selected':'').'>'.
						$row_produk['NAMAPRODUK'] .
					'</option>';
		}
echo			"</select>";
echo "      </td>";

		echo "      <td class=\"verdana9blk\"> ";
echo "         <select size=1 name=kdkantor>";
echo "				 <option value=all>PILIH KANTOR</option>";
               $sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor";
							 $DB->parse($sql);
							 $DB->execute();	
							 while($ro=$DB->nextrow()){
							       echo "<option ";
    								 if ($ro["KDKANTOR"]==$kdkantor){ echo " selected"; }
    								 echo " value=".$ro["KDKANTOR"].">".$ro["KDKANTOR"]." - ".$ro["NAMAKANTOR"]."</option>";
							 }
							 
echo "         </select>";							 	
echo "      </td>";

echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------
$nmsql = "select distinct namaproduk from $DBUser.tabel_202_produk where kdproduk like '$filter_produk' AND STATUS IS NULL";
			//echo $nmsql;
		$DB->parse($nmsql);
		$DB->execute();
		$nm_produk=$DB->nextrow();
if($cari){
			$tglDari=substr('00'.$dtgl,-2)."/".substr('00'.$dbln,-2)."/".$dthn;
			$tglSampai=substr('00'.$stgl,-2)."/".substr('00'.$sbln,-2)."/".$sthn;

			$tglAwalCari=$sthn."0101";			 		 
			$tglDariCari=$dthn.substr('00'.$dbln,-2).substr('00'.$dtgl,-2);
			$tglSampaiCari=$sthn.substr('00'.$sbln,-2).substr('00'.$stgl,-2);
      echo "PERIODE ENTRY ".$tglDari." s/d ".$tglSampai."<br><br>";					
?>

<table border="1" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#C0C0C0">
	<tr>
		<td rowspan="3" align="center" bgcolor="#DBDBDB">NO.</td>
		<td rowspan="3" align="center" bgcolor="#DBDBDB">KANTOR</td>
		<td colspan="10" align="center" bgcolor="#DBDBDB"><?=$nm_produk['NAMAPRODUK'];?></td>
		<td rowspan="3" align="center" bgcolor="#DBDBDB">JUMLAH</td>
	</tr><?php
	$arr_namabulan = array('', "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
	$str_tglawal	= (isset($_POST['dtgl']) && $_POST['dtgl']!='') ? 
							intval($_POST['dtgl']).' '.$arr_namabulan[intval($_POST['dbln'])].' '.$_POST['dthn'] : '';
	$str_tglakhir	= (isset($_POST['stgl']) && $_POST['stgl']!='') ? 
							intval($_POST['stgl']).' '.$arr_namabulan[intval($_POST['sbln'])].' '.$_POST['sthn'] : '';
	?>
	<tr>
		<td colspan="5" align="center" bgcolor="#DBDBDB"><?php echo toTglIna(dateadd("d",-7,$sthn.'-'.substr('00'.$sbln,-2).'-'.substr('00'.$stgl,-2))).' S/D '.$str_tglakhir; //AWAL?></td>
		<td colspan="5" align="center" bgcolor="#DBDBDB"><?php echo $str_tglawal.' S/D '.$str_tglakhir; //AKHIR?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#DBDBDB">POLIS</td>
		<td align="center" bgcolor="#DBDBDB">BERKALA</td>
		<td align="center" bgcolor="#DBDBDB">SEKALIGUS</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP SKG.</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP BKL.</td>
		<td align="center" bgcolor="#DBDBDB">POLIS</td>
		<td align="center" bgcolor="#DBDBDB">BERKALA</td>
		<td align="center" bgcolor="#DBDBDB">SEKALIGUS</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP SKG.</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP BKL.</td>
	</tr>
	<?
 // $sqa = "select kdkantor as KODE, namakantor as NAMA ".
 //       "from $DBUser.tabel_001_kantor ".
 // 		 	 "order by kdkantor";

	$sqa = "select kdareaoffice as KODE, namaareaoffice as NAMA ".
    	    "from $DBUser.tabel_410_area_office where kdkantor='$kdkantor' ".
 		 	 "order by kdareaoffice";
//	echo $sqa;
  $DB->parse($sqa);
  $DB->execute();					 
	$no=1;
  while ($arx=$DB->nextrow()) {
				echo unitLink($no,$arx['KODE']." - ".$arx['NAMA'],$tglDariCari,$tglSampaiCari,$DBX, $filter_produk, $kdkantor);
				$no++;
	}				
	?>
	<tr>
		<td></td>
		<td></td>
		<td align="right"><?=$jmlpolisx;?></td>
		<td align="right"><?=number_format($berkala1x,2,",",".");?></td>
		<td align="right"><?=number_format($sekaligus1x,2,",",".");?></td>
		<td align="right"><?=number_format($topupskg1x,2,",",".");?></td>
		<td align="right"><?=number_format($topupbkx,2,",",".");?></td>
		<td align="right"><?=$jmlpolisx2;?></td>
		<td align="right"><?=number_format($berkala1x2,2,",",".");?></td>
		<td align="right"><?=number_format($sekaligus1x2,2,",",".");?></td>
		<td align="right"><?=number_format($topupskg1x2,2,",",".");?></td>
		<td align="right"><?=number_format($topupbkx2,2,",",".");?></td>
		<td></td>
	</tr>
</table>

<br />
<hr size="1">
<?
}
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
</body>
</html>