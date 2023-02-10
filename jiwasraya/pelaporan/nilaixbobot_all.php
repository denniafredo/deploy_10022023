<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
  $DB = new Database($userid, $passwd, $DBName);
	$DBUL=New database($userid, $passwd, $DBName);
	
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
	echo "<a class=verdana10blu><b>LAPORAN EVALUASI KINERJA</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function unitLink($kdktr,$dthn,$tglAwalCari,$tglDariCari,$tglSampaiCari)
{
	GLOBAL $angtop,$jmlpremitop1,$jmlpremitop2;
	GLOBAL $angred,$jmlpremired1,$jmlpremired2;
	
  $myServer   = "danareksa";
  $myUser 		= "sa";
  $myPass 		= "siar";
  $myDB				= "siar";
  $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
  $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
  
	if ($kdktr==''){
		 $wherektr="";	
	}
	else{
		 $wherektr="left(a.referenceno, 2)='".$kdktr."' and ";
	}

	$budget=0;
		
// Periode Tgl Awal s/d Tgl Sampai
  $msquery = "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "0 as jenistransaksi, a.jmldipesan as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, ".
             "a.nilainab, a.jmlunit/a.nilainab as jmlunit, 0 as redemption ".
             "from vpemesananhistory a, tableNasabah b ".
						 "where ".$wherektr." ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglAwalCari."' and ".						  				 
					   "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglAwalCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "union ".
             "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "1 as jenistransaksi, 0 as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, nilainab, ".
             "-1 * a.jmlunit, a.jmljualrpapproved as redemption ".
             "from vpenjualanhistory a, TableNasabah b ".
						 "where ".$wherektr." ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglAwalCari."' and ".						  				 
					   "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglAwalCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "order by right(a.referenceno, 6)";
//	echo $msquery;
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
	
// Periode Tgl Dari s/d Tgl Sampai
  $msquery = "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "0 as jenistransaksi, a.jmldipesan as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, ".
             "a.nilainab, a.jmlunit/a.nilainab as jmlunit, 0 as redemption ".
             "from vpemesananhistory a, tableNasabah b ".
						 "where ".$wherektr." ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglDariCari."' and ".						  				 
					   "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglDariCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "union ".
             "select upper(a.referenceno) as refNo, upper(b.referenceID) as refID, right(a.referenceno, 6),convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),103) as tgl, ".
             "1 as jenistransaksi, 0 as nilaiinvestasi, convert(varchar,a.datenab,103) as datenab, nilainab, ".
             "-1 * a.jmlunit, a.jmljualrpapproved as redemption ".
             "from vpenjualanhistory a, TableNasabah b ".
						 "where ".$wherektr." ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglDariCari."' and ".						  				 
					   "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)>='".$tglDariCari."' and ".
						 "left(a.referenceno,11)=left(b.referenceID,11) and ".
//						 "convert(varchar,(convert(datetime, datenab, 112)),112)<='".$tglSampaiCari."' ".						  				 
						 "convert(varchar,(convert(datetime, right(a.referenceno, 6), 112)),112)<='".$tglSampaiCari."' ".						  
             "order by right(a.referenceno, 6)";
  $msresults= mssql_query($msquery);

	$sub2=0;
	$top2=0;
	$red2=0;
  while ($row = mssql_fetch_array($msresults)){
		// Subcription atau TopUp
    if($row["jenistransaksi"]==0){
			 if ($row["refNo"]==$row["refID"]){
		   		$sub2=$sub2+$row["nilaiinvestasi"];
			 }
			 else{																																
		      $top2=$top2+$row["nilaiinvestasi"];
			 }																																
    }
		// Redemption
    elseif($row["jenistransaksi"]==1){
		   $red2=$red2+$row["redemption"];  		
    }		
  }

/*
    echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "dddddd").">";
    print( " <td class='verdana10blk' align=center>".$i."</td>\n" );
    print( " <td class='verdana10blk' align=center>".$row["tgl"]."</td>\n" );
    print( " <td class='verdana10blk' align=center>".$jt."</td>\n" );
    print( " <td class='verdana10blk' align=right>".number_format($row["nilaiinvestasi"],2,",",".")."</td>\n" );
    print( " <td class='verdana10blk' align=right>".$row["datenab"]."</td>\n" );
    print( "	<td class='verdana10blk' align=right>".number_format($row["nilainab"],4,",",".")."</td>\n" );
    print( " <td class='verdana10blk' align=right>".number_format($row["jmlunit"],4,",",".")."</td>\n" );
    print( "	<td class='verdana10blk' align=right>".number_format($row["redemption"],2,",",".")."</td>\n" );
    print( " </tr>	" );
    $i++;
    $jmltotal+=$jmlunit;  
*/

	$rtnValue="";
// Subscription
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.3.1. Subscription</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($sub1,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($sub2,2,",",".")."</a></td>";
  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($sub1*100/$budget,2,",",".")."<br></td></tr>";		
  }

// Top-Up
	$angtop=$budget;
	$jmlpremitop1=$top1;
	$jmlpremitop1=$top2;

	$rtnValue=$rtnValue."<tr>";
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.3.2. Top-Up</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=TOP','popuppage','1000','300','yes')\">".number_format($top1,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=TOP','popuppage','1000','300','yes')\">".number_format($top2,2,",",".")."</a></td>";
  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($top1*100/$budget,2,",",".")."<br></td></tr>";		
  }	
	
// Redemption
	$angred=$budget;
	$jmlpremired1=$red1;
	$jmlpremired2=$red2;

	$rtnValue=$rtnValue."<tr>";
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.3.3. Redemption</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\">".number_format($red1,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\">".number_format($red2,2,",",".")."</a></td>";
  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($red1*100/$budget,2,",",".")."<br></td>";		
  }
  
  return $rtnValue;	
}

function nilaiRekening($nourut,$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari)
{
	GLOBAL $angpreminbpp,$jmlpreminbpp1,$jmlpreminbpp2;
	GLOBAL $angpreminbpk,$jmlpreminbpk1,$jmlpreminbpk2;
	GLOBAL $angpremiob,$jmlpremiob1,$jmlpremiob2;
	GLOBAL $angpreminbobpp,$jmlpreminbobpp1,$jmlpreminbobpp2;
	GLOBAL $angpreminbobpk,$jmlpreminbobpk1,$jmlpreminbobpk2;
	GLOBAL $angbiaya,$jmlbiaya1,$jmlbiaya2;	 

 		$ptrrekening=2;
		$akun="";
		while ($ptrrekening<=strlen($kdrekening)){
		   $akun=$akun.substr($kdrekening,$ptrrekening,6);
			 $ptrrekening=$ptrrekening+9;
		}
		
    // Target Tahun Dari
    $sq1 = "select sum(budget1) AS BUDGET ".
           "from $DBUser.TABEL_802_BUDGET ".
    			 "where ".$wherektr1."tahun='".$dthn."' and ".
    			 "akun in ".$kdrekening;
//		echo $sq1;
    $DBA->parse($sq1);
    $DBA->execute();
    $budget=0;
    while ($arx=$DBA->nextrow()) {
					$budget=$arx["BUDGET"];
    }					

    // Periode Tgl Awal s/d Tgl Sampai
    $sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
           "from $DBUser.tabel_802_trvouc ".
    			 "where ".$wherektr1."substr(notrans,0,1) in ('B','K') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
    			 "akun in ".$kdrekening;
    $DBA->parse($sq2);
    $DBA->execute();
    $debet1=0;
    $kredit1=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet1=$arx["DEBET"];
    			$kredit1=$arx["KREDIT"];			
    }					
    

    // Periode Tgl Dari s/d Tgl Sampai
    $sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
           "from $DBUser.tabel_802_trvouc ".
    			 "where ".$wherektr1."substr(notrans,0,1) in ('B','K') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
    			 "akun in ".$kdrekening;
    $DBA->parse($sq3);
    $DBA->execute();
    $debet2=0;
    $kredit2=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet2=$arx["DEBET"];
    			$kredit2=$arx["KREDIT"];			
    }					

		$rtnValue="<td align=\"right\">".number_format($budget,2,",",".")."</td>";
		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit1-$debet1),2,",",".")."</a></td>";
		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit2-$debet2),2,",",".")."</a></td>";
		if ($budget==0){
				$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
		}
		else{
				$rtnValue=$rtnValue."<td align=\"right\">".number_format(abs($kredit1-$debet1)*100/$budget,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
		}
		
		if ($nourut=='C.1.'||$nourut=='C.2.'){
			 $angpreminbpp=$angpreminbpp+$budget;
			 $jmlpreminbpp1=$jmlpreminbpp1+$kredit1-$debet1;
			 $jmlpreminbpp2=$jmlpreminbpp2+$kredit2-$debet2;
		} 
		elseif ($nourut=='D.1.'||$nourut=='D.2.'){
			 $angpreminbpk=$angpreminbpk+$budget;
			 $jmlpreminbpk1=$jmlpreminbpk1+$kredit1-$debet1;
			 $jmlpreminbpk2=$jmlpreminbpk2+$kredit2-$debet2;
		} 
		elseif ($nourut=='E.1.'){
			 $angpreminbobpp=$angpreminbobpp+$budget;
			 $jmlpreminbobpp1=$jmlpreminbobpp1+$kredit1-$debet1;
			 $jmlpreminbobpp2=$jmlpreminbobpp2+$kredit2-$debet2;
			 
			 $angpremiob=$angpremiob+$budget;
			 $jmlpremiob1=$jmlpremiob1+$kredit1-$debet1;
			 $jmlpremiob2=$jmlpremiob2+$kredit2-$debet2;
		} 
		elseif ($nourut=='E.2.'){
			 $angpreminbobpk=$angpreminbobpk+$budget;
			 $jmlpreminbobpk1=$jmlpreminbobpk1+$kredit1-$debet1;
			 $jmlpreminbobpk2=$jmlpreminbobpk2+$kredit2-$debet2;
			 
			 $angpremiob=$angpremiob+$budget;
			 $jmlpremiob1=$jmlpremiob1+$kredit1-$debet1;
			 $jmlpremiob2=$jmlpremiob2+$kredit2-$debet2;
		} 
		elseif ($nourut=='A.'||$nourut=='B.'||$nourut=='C.'||$nourut=='D.'||$nourut=='E.'){
			 $angbiaya=$angbiaya+$budget;
			 $jmlbiaya1=$jmlbiaya1+abs($kredit1-$debet1);
			 $jmlbiaya2=$jmlbiaya2+abs($kredit2-$debet2);
		} 
		
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
        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
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
echo "      <td class=\"verdana9blk\">Periode Laporan</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> s/d </td> ";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("s");
echo "      </td>";
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
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";

#--------------------------------------------------- end navigasi --------------
if($cari){

			 if ($ktr!='all'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".$ktr."' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();					 
    		  while ($arr=$DB->nextrow()) {
								$namakantor=$arr["NAMAKANTOR"];
    			}					
			 		$wherektr="prefixpertanggungan='".$ktr."' and ";
			 		$wherektr1="kdkantor='".$ktr."' and ";
					$kdktr=$ktr;
  		 }
			 else{
			 		$wherektr="";
			 		$wherektr1="";
					$kdktr="";
					
					$namakantor="SELURUH KANTOR PT ASURANSI JIWA IFG";
			 }

			$tglDari=substr('00'.$dtgl,-2)."/".substr('00'.$dbln,-2)."/".$dthn;
			$tglSampai=substr('00'.$stgl,-2)."/".substr('00'.$sbln,-2)."/".$sthn;

			$tglAwalCari=$sthn."0101";			 		 
			$tglDariCari=$dthn.substr('00'.$dbln,-2).substr('00'.$dtgl,-2);
			$tglSampaiCari=$sthn.substr('00'.$sbln,-2).substr('00'.$stgl,-2);
			
      echo "LAPORAN PENERIMAAN PREMI DAN BIAYA<br>";
      echo $namakantor."<br>";					
      echo "PERIODE ".$tglDari." s/d ".$tglSampai."<br><br>";					

?>

 <table border="1" style="border-collapse: collapse" id="table1" cellpadding="5">
 <tr>
  <td bgcolor="#3366CC" align="center" rowspan="2"><font color="#FFFFFF">No</font></td>
  <td bgcolor="#3366CC" align="center" rowspan="2"><font color="#FFFFFF">Uraian</font></td>
  <td bgcolor="#3366CC" align="center" rowspan="2"><font color="#FFFFFF">Anggaran/Target<br><?=$dthn?></font></td>
  <td bgcolor="#3366CC" align="center" colspan="2"><font color="#FFFFFF">Periode Laporan</font></td>
  <td bgcolor="#3366CC" align="center" rowspan="2"><font color="#FFFFFF">Rasio<br>(%)</font></td>
 </tr>
 <tr>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/01/<?=$dthn?> s/d <?=$tglSampai?></font></td>
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF"><?=$tglDari?> s/d <?=$tglSampai?></font></td> 
 </tr>
 
 <tr bgcolor="#ffffcc">
 	<td><b>I</b></td>
  <td colspan="5"><b>PRODUKSI</b></td>
 </tr>

 <tr bgcolor="#a9d8e7">
 	<td></td>
  <td colspan="5"><b>A. Polis/Peserta</b></td>
 </tr>

<?
// Target Kantor ???
$sqx = "select * ".
       "from $DBUser.tabel_401_target_kantor ".
			 "where kdkantor='".$ktr."' and tahun='".$dthn."'";
//echo $sqx;
$DB->parse($sqx);
$DB->execute();					 
while ($arx=$DB->nextrow()) {
			$target=$arx["TARGET_NB"];
}					
$target=0;

// Periode Awal Tahun s/d Tgl Sampai
$sqa = "select prefixpertanggungan, kdvaluta, count(prefixpertanggungan) AS POLIS, sum(juamainproduk) AS JUA ".
       "from $DBUser.tabel_200_pertanggungan ".
			 "where ".$wherektr."kdpertanggungan='2' and ".
			 "to_char(mulas,'YYYYMMDD')>='".$tglAwalCari."' and to_char(mulas,'YYYYMMDD')<='".$tglSampaiCari."' ".
		 	 "group by prefixpertanggungan, kdvaluta";
//echo $sqa;
$DB->parse($sqa);
$DB->execute();

$polis1=0;		
$juavrdi1=0;
$juavrti1=0;
$juava1=0;

while($arr=$DB->nextrow()){
	$polis1=$polis1+$arr["POLIS"];
	if ($arr["KDVALUTA"]=='0'){
		 $juavrdi1=$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='1'){
		 $juavrti1=$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='3'){
		 $juava1=$arr["JUA"];
	}
}

// Periode Tgl Dari s/d Tgl Sampai
$sqa = "select prefixpertanggungan, kdvaluta, count(prefixpertanggungan) AS POLIS, sum(juamainproduk) AS JUA ".
       "from $DBUser.tabel_200_pertanggungan ".
			 "where ".$wherektr."kdpertanggungan='2' and ".
			 "to_char(mulas,'YYYYMMDD')>='".$tglDariCari."' and to_char(mulas,'YYYYMMDD')<='".$tglSampaiCari."' ".
		 	 "group by prefixpertanggungan, kdvaluta";
//echo $sqa;
$DB->parse($sqa);
$DB->execute();

$polis2=0;		
$juavrdi2=0;
$juavrti2=0;
$juava2=0;
while($arr=$DB->nextrow()){
	$polis2=$polis2+$arr["POLIS"];
	if ($arr["KDVALUTA"]=='0'){
		 $juavrdi2=$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='1'){
		 $juavrti2=$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='3'){
		 $juava2=$arr["JUA"];
	}
}

?>
 <tr>
 	<td></td>		
  <td><p>&nbsp;&nbsp;&nbsp;A.1. Pertanggungan Perorangan</p></td>
  <td align="right"><?=number_format($target,0,",",".");?></td>
  <td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($polis1,0,",",".");?></a></td>
  <td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($polis2,0,",",".");?></a></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($polis1*100/$target,2,",",".");?></td>
<?
	}
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;A.2. Pertanggungan Kumpulan</p></td>
  <td align="right"><?=number_format(0,0,",",".");?></td>
  <td align="right"><?=number_format(0,0,",",".");?></td>
  <td align="right"><?=number_format(0,0,",",".");?></td>
  <td align="right"><?=number_format(0,2,",",".");?></td>
 </tr>

	<tr bgcolor="#a9d8e7">
		<td></td>
		<td><b>Jumlah Polis/Peserta (A.1+A.2)</b></td>
		<td align="right"><?=number_format($target,0,",",".");?></td>
		<td align="right"><?=number_format($polis1,0,",",".");?></td>
		<td align="right"><?=number_format($polis2,0,",",".");?></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($polis1*100/$target,2,",",".");?></td>
<?
	}
?>
	</tr>
 
 <tr bgcolor="#ccffcc">
 	<td></td>
  <td colspan="5"><b>B. Jumlah Uang Asuransi</b></td>
 </tr>

 <tr>
 	<td></td>
  <td colspan="5"><p>&nbsp;&nbsp;&nbsp;<b>B.1. Pertanggungan Perorangan</b></p></td>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.1.1. Valuta Rupiah Dengan Indeks (VRDI)</p></td>
		<td align="right"><?=number_format($target,2,",",".");?></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=0&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrdi1,2,",",".");?></a></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=0&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrdi2,2,",",".");?></a></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($juavrdi1*100/$target,2,",",".");?></td>
<?
	}
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.1.2. Valuta Rupiah Tanpa Indeks (VRTI)</p></td>
		<td align="right"><?=number_format($target,2,",",".");?></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=1&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrti1,2,",",".");?></a></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=1&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrti2,2,",",".");?></a></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($juavtdi1*100/$target,2,",",".");?></td>
<?
	}
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B.1.3. Valuta Asing/Dollar AS (VA)</p></td>
		<td align="right"><?=number_format($target,2,",",".");?></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=3&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juava1,2,",",".");?></a></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=3&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juava2,2,",",".");?></a></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($juava1*100/$target,2,",",".");?></td>
<?
	}
?>
 </tr>
  
 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;<b>B.2. Pertanggungan Kumpulan</b></p></td>
  <td align="right"><?=number_format(0,2,",",".");?></td>
  <td align="right"><?=number_format(0,2,",",".");?></td>
  <td align="right"><?=number_format(0,2,",",".");?></td>
  <td align="right"><?=number_format(0,2,",",".");?></td>
 </tr>

	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Uang Asuransi VRDI (B.1.1)</b></td>
		<td align="right"><?=number_format($target,2,",",".");?></td>
		<td align="right"><?=number_format($juavrdi1,2,",",".");?></td>
		<td align="right"><?=number_format($juavrdi2,2,",",".");?></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($juavrdi1*100/$target,2,",",".");?></td>
<?
	}
?>
	</tr>

	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Uang Asuransi VRTI (B.1.2+B.2)</b></td>
		<td align="right"><?=number_format($target,2,",",".");?></td>
		<td align="right"><?=number_format($juavrti1,2,",",".");?></td>
		<td align="right"><?=number_format($juavrti2,2,",",".");?></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($juavrti1*100/$target,2,",",".");?></td>
<?
	}
?>
	</tr>

	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Uang Asuransi VA (B.1.3)</b></td>
		<td align="right"><?=number_format($target,2,",",".");?></td>
		<td align="right"><?=number_format($juava1,2,",",".");?></td>
		<td align="right"><?=number_format($juava2,2,",",".");?></td>
<?
	if ($target==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($juava1*100/$target,2,",",".");?></td>
<?
	}
?>
	</tr>
	
 <tr bgcolor="#a9d8e7">
 	<td></td>
  <td colspan="5"><b>C. Penerimaan Premi NB PP</b></td>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.1. Premi Berkala</p></td>
<?
      $kdrekening="('305112','305122','305135','305313','305314','308002','315602','305212','305222','305312','305322','305412','305422','305512','305522','305612','305622','305712','305722','305812','305822','308101','308102','308103','308201','308202','308203','308301','308302','308303','308401','308402','308403','308501','308502','308503','308601','308602','308603','308701','308702','308703','308801','308802','308803','315102','315202','315302','315402','315502','315602','315702','315802','703112','703122','703212','703222','703312','703322','703412','703422','703512','703522','703612','703622','703712','703722','703812','703822','707102','707202','707302','707402','707502','707602','707702','707802','930004','308001','308305','305502','315502','305814')";
			echo nilaiRekening('C.1.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.2. Premi Sekaligus</p></td>
<?
      $kdrekening="('307112','307113','307122','307212','307213','307222','307312','307313','307322','307412','307413','307422','307512','307513','307522','307523','307612','307613','307622','307712','307713','307722','307812','307813','307822','317102','317103','317202','317203','317302','317303','317402','317403','317502','317503','317602','317603','317702','317703','317802','317803','307642','307632','930004')";
			echo nilaiRekening('C.2.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;<b>C.3. Premi Unit Link (JS-Link)</b></p></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
 <tr>
<?
			echo unitLink($kdktr,$dthn,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

	<tr bgcolor="#a9d8e7">
		<td></td>
		<td><b>Jumlah Penerimaan Premi NB PP (C.1+C.2+C.3.2-C.3.3)</b></td>
		<td align="right"><?=number_format($angpreminbpp+$angtop-$angred,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpremitop1-$jmlpremired1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpremitop2-$jmlpremired2,2,",",".");?></td>
<?
	if ($angpreminbpp+$angtop-$angred==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format(($jmlpreminbpp1+$jmlpremitop1-$jmlpremired1)*100/($angpreminbpp+$angtop-$angred),2,",",".");?></td>
<?
	}
?>
	</tr>

 <tr bgcolor="#ccffcc">
 	<td></td>
  <td colspan="5"><b>D. Penerimaan Premi NB PK</b></td>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;D.1. Premi Tutupan Baru</p></td>
<?
      $kdrekening="('334115','334116','334215','334216','334315','334316','334415','334416','334515','334516','334615','334616','334715','334716','334815','334816','334105','334106','334205','334206','334305','334306','334405','334406','334505','334506','334605','334606','334705','334706','334805','334806','330123','330223','330323','330423','330523','330623','330723','330823','331103','331203','331303','331403','331503','331603','331703','331803','336114','336115','336214','336215','336314','336315','336414','336415','336514','336515','336614','336615','336714','336715','336814','336815','336104','336105','336204','336205','336304','336305','336404','336405','336504','336505','336604','336605','336704','336704','336804','336805','333113','333213','333313','333413','333513','333613','333713','333813','333103','333203','333303','333403','333503','333603','333703','333803','930006')";
			echo nilaiRekening('D.1.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;D.2. Premi Tambahan/Kenaikan</p></td>
<?
      $kdrekening="('330112','330122','330212','330222','330312','330322','330412','330422','330512','330522','330612','330622','330712','330722','330812','330822','331002','331102','331202','331302','331402','331502','331602','331702','331802','338000','338002','338100','338102','338200','338202','338300','338302','338400','338402','338500','338502','338600','338602','338700','338702','338800','338802','339002','339102','339202','339302','339402','339502','339602','339702','339802','717102','717112','717122','717202','717212','717222','717302','717312','717322','717402','717412','717422','717502','717512','717522','717602','717612','717622','717702','717712','717722','717802','717812','717822','332012','332212','722212','333012','333112','333212','333412','333512','725112','725212','725512','305135','337012','337013','337222','334002','334003','334012','334013','334030','334031','334032','334033','334102','334103','334112','334113','334114','334202','334203','334212','334213','334302','334303','334312','334313','334402','334403','334412','334413','334502','334503','334512','334513','334602','334603','334612','334613','334702','334703','334712','334713','334802','334803','334812','334813','337112','335000','335100','336012','336013','336112','336113','336212','336213','336412','336413','336512','336513','330013','930006')";
			echo nilaiRekening('D.2.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Penerimaan Premi NB PK (D.1+D.2)</b></td>
		<td align="right"><?=number_format($angpreminbpk,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk2,2,",",".");?></td>
<?
	if ($angpreminbpk==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($jmlpreminbpk1*100/$angpreminbpk,2,",",".");?></td>
<?
	}
?>
	</tr>

 <tr bgcolor="#a9d8e7">
 	<td></td>
  <td colspan="5"><b>E. Penerimaan Premi OB</b></td>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;E.1. Pertanggungan Perorangan</p></td>
<?
      $kdrekening="('305111','305121','305211','305221','305311','305321','305411','305421','305511','305521','305611','305621','305711','305721','305811','305821','315101','315201','315301','315401','315501','315601','315701','315801','702100','702200','702300','702400','702500','702600','702700','702800','703111','703121','703211','703221','703311','703321','703411','703421','703511','703521','703611','703621','703711','703721','703811','703821','706100','706200','706300','706400','706500','706600','706700','706800','707101','707201','707301','707401','707501','707601','707701','707801','930003')";
			echo nilaiRekening('E.1.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;E.2. Pertanggungan Kumpulan</p></td>
<?
      $kdrekening="('930005','330031','330111','330121','330211','330221','330311','330321','330411','330421','330511','330521','330611','330621','330711','330721','330811','330821','331001','331101','331201','331301','331401','331501','331601','331701','331801','338001','338101','338201','338301','338401','338501','338601','338701','338801','339001','339101','339201','339301','339401','339501','339601','339701','339801','716100','716200','716300','716400','716500','716600','716700','716800','717101','717111','717121','717201','717211','717221','717301','717311','717321','717401','717411','717421','717501','717511','717521','717601','717611','717621','717701','717711','717721','717801','717811','717821','332011','332013','332211','332213','722211','722213','333011','333111','333211','333411','333511','725111','725211','725511','337011','732000')";
			echo nilaiRekening('E.2.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

	<tr bgcolor="#a9d8e7">
		<td></td>
		<td><b>Jumlah Penerimaan Premi OB (E.1+E.2)</b></td>
		<td align="right"><?=number_format($angpremiob,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpremiob1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpremiob2,2,",",".");?></td>
<?
	if ($angpremiob==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($jmlpremiob1*100/$angpremiob,2,",",".");?></td>
<?
	}
?>
	</tr>

 <tr bgcolor="#ccffcc">
 	<td></td>
  <td colspan="5"><b>F. Penerimaan Premi NB + OB</b></td>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;F.1. Pertanggungan Perorangan (C+E.1)</p></td>
		<td align="right"><?=number_format($angpreminbpp+$angpreminbobpp,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpreminbobpp1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpreminbobpp2,2,",",".");?></td>
<?
	if ($angpreminbpp+$angpreminbobpp==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format(($jmlpreminbpp1+$jmlpreminbobpp1)*100/($angpreminbpp+$angpreminbobpp),2,",",".");?></td>
<?
	}
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;F.2. Pertanggungan Kumpulan (D+E.2)</p></td>
		<td align="right"><?=number_format($angpreminbpk+$angpreminbobpk,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk1+$jmlpreminbobpk1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk2+$jmlpreminbobpk2,2,",",".");?></td>
<?
	if ($angpreminbpk+$angpreminbobpk==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format(($jmlpreminbpk1+$jmlpreminbobpk1)*100/($angpreminbpk+$angpreminbobpk),2,",",".");?></td>
<?
	}
?>
 </tr>

	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Penerimaan Premi NB + OB (F.1+F.2)</b></td>
		<td align="right"><?=number_format($angpreminbpp+$angpreminbpk+$angpremiob,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpreminbpk1+$jmlpremiob1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpreminbpk2+$jmlpremiob2,2,",",".");?></td>
<?
	if ($angpreminbpp+$angpreminbpk+$angpremiob==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format(($jmlpreminbpp1+$jmlpreminbpk1+$jmlpremiob1)*100/($angpreminbpp+$angpreminbpk+$angpremiob),2,",",".");?></td>
<?
	}
?>
	</tr>

 <tr bgcolor="#ffffcc">
 	<td><b>II</b></td>
  <td colspan="5"><b>BIAYA-BIAYA</b></td>
 </tr>

 <tr>
 	<td></td>
  <td>A. Biaya Produksi</td>
<?
      $kdrekening="('509000','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','525001','525002','526000','527000','528000','529000','528001','508000','508001','519000','540000','541000','543000','544000','545000','549000','500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002')";
//      $kdrekening="('500000','500001','500002','500003','500004','500005','500006','500007','500008','500010','500011','500020','500021','500100','500101','500102','500103','500111','500121','500131','500200','500201','500202','500203','500211','500212','500300','501000','501001','501002','501003','501004','501005','502000','502001','503000','503001','503002','504000','505000','507000','508000','508001','509000','509001','509003','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','526000','527000','528000','529000','540000','541000','542000','544000','545000','549000','543000'  OR '502002','525001','500015','500009','507002','525002')";
			echo nilaiRekening('A.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>B. Biaya Inkaso</td>
<?
      $kdrekening="('550000','550001','550002','550003','550004','551000','551001','552000','553000','553001','553002','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','559000','550400','550005','550304','550401','550402')";
			echo nilaiRekening('B.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>C. Biaya Overhead</td>
<?
      $kdrekening="('560000','561000','562000','563000','566000','567000','568000','569000','570000','565000','571000','572000','573000','574000','575000','576000','577000','578000','579000','580000','581000','582000','583000','584000','585000','589000','600000','601000','602000','603000','604000','605000','606000','607000','608000','609000','610000','611000','612000','612001','613000','620000','621000','622000','629000','630000','631000','632000','633000','640000','641000','642000','643000','644000','645000','647000','648000','649000','650000','650001','660000','670000','670001','671000','672000','673000','673001','674000','674001','675000','676000','677000','679000','679001','941000','942000','943000','944000','945000','946000','947000','948000')";
			echo nilaiRekening('C.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>D. Biaya Penebusan PP</td>
<?
      $kdrekening="('755201','755202','755301','755302','755501','755502','755601','765200','765300','765500','755201','755000','755102','755103','755401','755402','755602','757201','757202','757301','757302','757401','757402','757501','757502','757601','757602','765400','765600','767200','767300','767400','767500','767600','930026','930025')";
			echo nilaiRekening('D.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>E. Biaya Penebusan PK</td>
<?
      $kdrekening="('774200','774400','774600','779200','783500','774201','774300','788703','788803','774001','774500','783100','783200','788103','788203','788208','788603','788703','788803','930026','930025')";
			echo nilaiRekening('E.',$DBA,$wherektr1,$kdktr,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>
 
	<tr bgcolor="#ffffcc">
		<td colspan="2"><b>Jumlah Biaya (A+B+C+D+E)</b></td>
		<td align="right"><?=number_format($angbiaya,2,",",".");?></td>
		<td align="right"><?=number_format($jmlbiaya1,2,",",".");?></td>
		<td align="right"><?=number_format($jmlbiaya2,2,",",".");?></td>
<?
	if ($angbiaya==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format($jmlbiaya1*100/$angbiaya,2,",",".");?></td>
<?
	}
?>
	</tr>

	
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