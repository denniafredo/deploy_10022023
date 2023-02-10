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
	<style type="text/css">
<!-- 
td {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<?
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=verdana10blu><b>LAPORAN TRANSAKSI UNIT LINK FIXED</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function unitLink($no,$kdktr,$tglAwalCari,$tglSampaiCari,$DBX)
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
  $myDB				= "siar";
  $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
  $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
  
// Periode Tgl Awal s/d Tgl Sampai
  $msquery = "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "0 as jenistransaksi, a.jmldipesan as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, ".
             "a.nilainab, a.jmlunit/a.nilainab as jmlunit, 0 as redemption ".
             "from vpemesananhistory a, tableNasabah b ".
						 "where left(a.referenceno, 2)='".substr($kdktr,0,2)."' and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglAwalCari."' ".						  
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglAwalCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "union ".
             "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "1 as jenistransaksi, 0 as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, nilainab, ".
             "-1 * a.jmlunit, a.jmljualrpapproved as redemption ".
             "from vpenjualanhistory a, TableNasabah b ".
						 "where left(a.referenceno, 2)='".substr($kdktr,0,2)."' and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglAwalCari."' ".						  
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglAwalCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "order by right(a.referenceno, 6),jenistransaksi desc";
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
	}
	
	$rtnValue="";

// Subscription
	$jmlpremisub=$jmlpremisub+$sub1;

// Top-Up
	$jmlpremitop=$jmlpremitop+$top1;
	
// Redemption
	$jmlpremired=$jmlpremired+$red1;

	$rtnValue=$rtnValue."<tr bgcolor=#".($no % 2 ? "ffffff" : "dddddd").">";
	$rtnValue=$rtnValue."<td>".$no."</td>";
	$rtnValue=$rtnValue."<td>".$kdktr."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&whereproduk=JL&wherepertanggungan=ALL&fieldtgl=tglrekam','popuppage','1000','300','yes')\">".number_format($polis,0,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($sub1,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=TOP','popuppage','1000','300','yes')\">".number_format($top1,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\">".number_format($red1,2,",",".")."</a></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><b>".number_format($sub1+$top1-$red1,2,",",".")."</b></td>";
	$rtnValue=$rtnValue."</tr>";

  return $rtnValue;	
}

function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

// Tanggal
        print("<select name=" . $inName .  "tgl>\n"); 
//				print ("<option value=0>---</option>");
        for($currentDay = 1; $currentDay<= 31;$currentDay++) 
        { 
            print("<option value=\"$currentDay\""); 
            if(date( "j", $useDate)==$currentDay) 
            { 
                print(" selected"); 
            } 					
            print(">$currentDay\n"); 						
        } 
        print("</select>"); 

// Bulan				
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
            if(date( "n", $useDate)==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

// Tahun				
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
//        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
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
/*
echo "    </tr>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Kantor Produksi</td>";
echo "      <td class=\"verdana9blk\" colspan=5>";
echo "          <select name=ktr>";
echo "								<option value=\"all\" selected>-- SEMUA KANTOR --</option>";
              	$sqa = "select k.kdkantor,k.namakantor ".
              	       "from $DBUser.tabel_001_kantor k ".
              				 "order by k.kdkantor";
          		  $DB->parse($sqa);
          			$DB->execute();					 
          		  while ($art=$DB->nextrow()) {
echo "								<option value='".$art["KDKANTOR"]."'>".$art["KDKANTOR"]." - ".$art["NAMAKANTOR"]."</option>";
          			}
echo "          </select>";
echo "      </td>";
*/
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
			
      echo "LAPORAN TRANSAKSI UNIT LINK<br>";
      echo "PERIODE ENTRY ".$tglDari." s/d ".$tglSampai."<br><br>";					

?>

 <table border="1" width="100%" style="border-collapse: collapse" id="table1" cellpadding="5">
 <tr>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">No</font></td>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Kantor</font></td>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Proposal<br>Yang Dientry</font></td>
  <td bgcolor="#3366CC" colspan="3" align="center"><font color="#FFFFFF">Jenis Transaksi Yang Dikonfirmasi</font></td>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Saldo Transaksi</font></td>
 </tr>
 <tr>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Subscription</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Top-Up</font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">Redemption</font></td>
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
				echo unitLink($no,$arx['KODE']." - ".$arx['NAMA'],$tglDariCari,$tglSampaiCari,$DBX);
				$no++;
	}					
			
	echo "<tr bgcolor='#3366CC'>";
	echo "<td colspan='2' align ='center'><font color='#FFFFFF'><b>T O T A L</b></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&whereproduk=JL&wherepertanggungan=ALL&fieldtgl=tglrekam','popuppage','1000','300','yes')\"><b>".number_format($jmlpolis,0,",",".")."</b></a></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\"><b>".number_format($jmlpremisub,2,",",".")."</b></a></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=TOP','popuppage','1000','300','yes')\"><b>".number_format($jmlpremitop,2,",",".")."</b></a></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\"><b>".number_format($jmlpremired,2,",",".")."</b></a></font></td>";
	echo "<td align=\"right\"><font color='#FFFFFF'><b>".number_format($jmlpremisub+$jmlpremitop-$jmlpremired,2,",",".")."</b></font></td>";
	echo "</tr>";

?>

</table>
<br />
<hr size="1">
<?
}
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
  include "../../includes/endtimer.php"; 
?>