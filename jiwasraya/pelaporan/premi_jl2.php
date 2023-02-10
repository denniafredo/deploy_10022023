<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DB = new Database($userid, $passwd, $DBName);
	$DBUL=New database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
	
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
function unitLink($no,$kdktr,$tglAwalCari,$tglSampaiCari,$DBX,$pil)
{
	GLOBAL $jmlpolis;
	GLOBAL $jmlpremisub;
	GLOBAL $jmlpremitop;
	GLOBAL $jmlpremired;

// Transaksi Entry Proposal
  $sqx = "select count(prefixpertanggungan) as POLIS from $DBUser.tabel_200_pertanggungan where kdproduk like 'JL%' and (kdpertanggungan='1' or kdpertanggungan='2') and ".
				 "prefixpertanggungan='".substr($kdktr,0,2)."' and ".
			   "to_char(tglrekam,'YYYYMMDD')>='".$tglAwalCari."' and ".
			   "to_char(tglrekam,'YYYYMMDD')<='".$tglSampaiCari."'";				 
//	echo $sqx;

  $DBX->parse($sqx);
  $DBX->execute();					 
  $arx=$DBX->nextrow();
	$polis=$arx["POLIS"];
	$jmlpolis=$jmlpolis+$polis;
	
  $myServer   = "danareksa";
  $myUser 		= "sa";
  $myPass 		= "siar";
  $myDB				= "UNITLINK";
  $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
  $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
  
// Periode Tgl Awal s/d Tgl Sampai
  /*$msquery = "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "0 as jenistransaksi, a.jmldipesan as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, ".
             "a.nilainab, a.jmlunit/a.nilainab as jmlunit, 0 as redemption ".
             "from vpemesananhistory a, tableNasabah b ".
						 "where left(a.referenceno, 2)='".substr($kdktr,0,2)."' and ".
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglAwalCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "union ".
             "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "1 as jenistransaksi, 0 as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, nilainab, ".
             "-1 * a.jmlunit, a.jmljualrpapproved as redemption ".
             "from vpenjualanhistory a, TableNasabah b ".
						 "where left(a.referenceno, 2)='".substr($kdktr,0,2)."' and ".
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglAwalCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "order by right(a.referenceno, 6),jenistransaksi desc";*/
	
	
	//---------------------start seminggu sebelum
	
	//jumlah polis
					 $msqueryweekpls = "select count(distinct(nomor_polis)) as jmlpls ".
              "from ul_transaksi ".
              "where kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "trx_date>=dateadd(day,-7,left('".$tglSampaiCari."',4)+'-'+substring('".$tglSampaiCari."',5,2)+'-'+ right('".$tglSampaiCari."',2)) and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."'";
							
	//echo $msqueryweekpls;
	$msresultsweekpls= mssql_query($msqueryweekpls);
	$rowweekpls = mssql_fetch_array($msresultsweekpls);
	$jmlpolis1=$rowweekpls["jmlpls"];
	//----
	$msqueryweek = "select trx_type,nomor_polis,trx_date,sum(rp_nett) ,sum(rp_gross)*95/100 as TU, ".
					 	 "(select kd_cara_bayar from ul_nasabah where nomor_polis=ul_transaksi.nomor_polis) as CB,".
							"(sum(rp_nett)-(sum(rp_gross)*95/100)) as SUB,(sum(rp_gross)*95/100)+".
							"(sum(rp_nett)-(sum(rp_gross)*95/100)) ".
              "from ul_transaksi ".
              "where kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "trx_date>=dateadd(day,-7,left('".$tglSampaiCari."',4)+'-'+substring('".$tglSampaiCari."',5,2)+'-'+ right('".$tglSampaiCari."',2)) and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."' ".
							"group by trx_type,nomor_polis,trx_date";
	//echo $msqueryweek;
	$msresultsweek= mssql_query($msqueryweek);						
	  while ($rowweek = mssql_fetch_array($msresultsweek)){
		// Subcription atau TopUp
		if($rowweek["CB"]!="X"){
		$berkala1=$berkala1+$rowweek["SUB"];
		}
		else{
		$sekaligus1=$sekaligus1+$rowweek["SUB"];
		}
		
		$topupskg1=$topupskg1+$rowweek["TU"];
	}
	//---------------------end seminggu sebelum
	
	
	
	//jumlah polis
					 $msquerypls = "select count(distinct(nomor_polis)) as jmlpls ".
              "from ul_transaksi ".
              "where kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."'";
														
	//echo $msqueryweekpls;
	$msresultspls= mssql_query($msquerypls);
	$rowpls = mssql_fetch_array($msresultspls);
	$jmlpolis2=$rowpls["jmlpls"];
	
	$msquery = "select trx_type,nomor_polis,trx_date,sum(rp_nett) ,sum(rp_gross)*95/100 as TU, ".
					 	 "(select kd_cara_bayar from ul_nasabah where nomor_polis=ul_transaksi.nomor_polis) as CB,".
							"(sum(rp_nett)-(sum(rp_gross)*95/100)) as SUB,(sum(rp_gross)*95/100)+".
							"(sum(rp_nett)-(sum(rp_gross)*95/100)) ".
              "from ul_transaksi ".
              "where kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."' ".
							"group by trx_type,nomor_polis,trx_date";
	//echo $msquery;
  $msresults= mssql_query($msquery);
    
	$sub1=0;
	$top1=0;
	$red1=0;
  while ($row = mssql_fetch_array($msresults)){
		// Subcription atau TopUp
    if($row["jenistransaksi"]==0){
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
    }
		if($row["CB"]!="X"){
		$berkala2=$berkala2+$row["SUB"];
		}
		else{
		$sekaligus2=$sekaligus2+$row["SUB"];
		}
		
		$topupskg2=$topupskg2+$row["TU"];
	}
	
	$rtnValue="";
	

	$rtnValue= "<tr bgcolor=#".($no % 2 ? "ffffff" : "dddddd").">".
            		"<td>".$no."</td>".
            		"<td nowrap>".$kdktr."</td>".
            		"<td align=\"right\">".$jmlpolis1."</td>".
            		"<td align=\"right\">".number_format($berkala1,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($sekaligus1,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($topupskg1,2,",",".")."</td>".
            		"<td>$topupbkl</td>".
            		"<td align=\"right\">".$jmlpolis2."</td>".
								"<td align=\"right\">".number_format($berkala2/(3/10),2,",",".")."</td>".
            		"<td align=\"right\">".number_format($sekaligus2/(9/10),2,",",".")."</td>".
								"<td align=\"right\">".number_format($berkala2,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($sekaligus2,2,",",".")."</td>".
            		"<td align=\"right\">".number_format($topupskg2,2,",",".")."</td>".
            		"<td>$topupbk2</td>".
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
echo "      <td class=\"verdana9blk\">Periode Entry Proposal/Transaksi</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> s/d </td> ";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("s");
echo "      </td>";

echo "      <td class=\"verdana9blk\"> Produk </td> ";
echo "      <td class=\"verdana9blk\">";
echo			"<select name=\"filter_produk\">";
		$sql = "select distinct namaproduk from $DBUser.tabel_202_produk where substr(kdproduk,1,3)='JL2' AND STATUS IS NULL";
		//	echo $sqa;
		$DB->parse($sql);
		$DB->execute();	
		$i=0;				 
		while($row_produk=$DB->nextrow()) {
			IF(substr($row_produk['NAMAPRODUK'],8,1)=="B") {
			$kdprod="JSBL";
			}
			elseif(substr($row_produk['NAMAPRODUK'],8,1)=="E") {
			$kdprod="JSEQ";
			}
			else  {
			$kdprod="JSFX";
			}		
																	
			echo	'<option value="'.$kdprod.'"'.(($row_produk['NAMAPRODUK']==$_POST['filter_produk']) ? ' selected':'').'>'.
						$row_produk['NAMAPRODUK'] .
					'</option>';
		}
echo			"</select>";
echo "      </td>";


echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------
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
		<td colspan="12" align="center" bgcolor="#DBDBDB">JS-LINK FIXED INCOME<?echo $filter_produk;?></td>
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
		<td colspan="7" align="center" bgcolor="#DBDBDB"><?php echo $str_tglawal.' S/D '.$str_tglakhir; //AKHIR?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#DBDBDB">POLIS</td>
		<td align="center" bgcolor="#DBDBDB">BERKALA</td>
		<td align="center" bgcolor="#DBDBDB">SEKALIGUS</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP SKG.</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP BKL.</td>
		<td align="center" bgcolor="#DBDBDB">POLIS</td>
		<td align="center" bgcolor="#DBDBDB">BERKALA  (BRUTO)</td>
		<td align="center" bgcolor="#DBDBDB">SEKALIGUS(BRUTO)</td>
		<td align="center" bgcolor="#DBDBDB">BERKALA</td>
		<td align="center" bgcolor="#DBDBDB">SEKALIGUS</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP SKG.</td>
		<td align="center" bgcolor="#DBDBDB">TOPUP BKL.</td>
	</tr>
	<?
  $sqa = "select kdkantor as KODE, namakantor as NAMA ".
         "from $DBUser.tabel_001_kantor ".
  		 	 "order by kdkantor";
//	echo $sqa;
  $DB->parse($sqa);
  $DB->execute();					 
	$no=1;
  while ($arx=$DB->nextrow()) {
				echo unitLink($no,$arx['KODE']." - ".$arx['NAMA'],$tglDariCari,$tglSampaiCari,$DBX, $filter_produk);
				$no++;
	}				
	?>
	<tr>
		<td>$no</td>
		<td>$kdkantor</td>
		<td>$jmlpolis1</td>
		<td>$berkala1</td>
		<td>$sekaligus1</td>
		<td>$topupskg1</td>
		<td>$topupbkl</td>
		<td>$jmlpolis2</td>
		<td>$berkala2</td>
		<td>$sekaligus2</td>
		<td>$topupskg2</td>
		<td>$topupbk2</td>
		<td>$jml</td>
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