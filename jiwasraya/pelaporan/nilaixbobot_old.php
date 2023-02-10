<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";
	include "../../includes/cDatabase.php";

  $DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
  $DB = new Database($userid, $passwd, $DBName);
  $DBZ = new Database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
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
function NewunitLink($DBX,$wherektr1,$kdktr,$dthn,$tglAwalCari,$tglDariCari,$tglSampaiCari)
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

	GLOBAL $berkala1;
	GLOBAL $sekaligus1;
	GLOBAL $topupskg1;
	GLOBAL $topupbk1;
	GLOBAL $berkala2;
	GLOBAL $sekaligus2;
	GLOBAL $topupskg2;
	GLOBAL $topupbk2;

	$berkala1=0;
	$sekaligus1=0;
	$topupskg1=0;
	$topupbk1=0;
	$berkala2=0;
	$sekaligus2=0;
	$topupskg2=0;
	$topupbk2=0;

	$berkala1x=0;
	$sekaligus1x=0;
	$topupskg1x=0;
	$topupbkx=0;
	
	$berkala1x2=0;
	$sekaligus1x2=0;
	$topupskg1x2=0;
	$topupbkx2=0;

	if ($kdktr==''){
		 $wherektr="";	
	}
	elseif (substr($kdktr,1,1)=='Z'){
		 $wherektr="substr(a.prefixpertanggungan, 0,1)='".substr($kdktr,0,1)."' and ";
	}
	else{
		 $wherektr="substr(a.prefixpertanggungan, 0,2)='".$kdktr."' and ";
	}

	$budget=0;
	
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
		"$DBUser.tabel_214_acceptance_dokumen b where a.nopertanggungan=b.nopertanggungan ".
//		"and a.kdproduk like '$pil' and b.kdacceptance='1' ".
		"and a.kdproduk like 'JL2%' and b.kdacceptance='1' ".
		"and a.tglcetak is not null and ".$wherektr." a.kdstatusfile in ('1','4') ".
//		"and a.mulas between to_date('".$tglAwalCari."','YYYYMMDD') and to_date('".$tglSampaiCari."','YYYYMMDD')";
		"and to_char(a.mulas,'YYYYMMDD')>='".$tglAwalCari."' and to_char(a.mulas,'YYYYMMDD')<='".$tglSampaiCari."'";
	 	
$sqxw="select a.nopertanggungan as KAMPRET,a.juamainproduk, a.premi1,a.kdcarabayar as CARA,a.kdproduk,substr(a.kdproduk,-1) as kdprodgroup,a.mulas,a.tglcetak, ".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='DEATHMA') as PREM,".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUP') as TUBKL,  ".
		"(select premi from $DBUser.tabel_223_transaksi_produk where nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') as TUSKG ".
		"from $DBUser.tabel_200_pertanggungan a, ".
		"$DBUser.tabel_214_acceptance_dokumen b where a.nopertanggungan=b.nopertanggungan ".
//		"and a.kdproduk like '$pil' and b.kdacceptance='1' ".
		"and a.kdproduk like 'JL2%' and b.kdacceptance='1' ".
		"and a.tglcetak is not null and ".$wherektr." a.kdstatusfile in ('1','4') ".
//		"and a.mulas between to_date('".$tglDariCari."','YYYYMMDD') and to_date('".$tglSampaiCari."','YYYYMMDD')";	
		"and to_char(a.mulas,'YYYYMMDD')>='".$tglDariCari."' and to_char(a.mulas,'YYYYMMDD')<='".$tglSampaiCari."'";
//	echo $sqx;

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
			$pw++;
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
	
// Premi Berkala
	$rtnValue="";
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.4.1. Premi Berkala ***)</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala1,2,",",".")."</a></td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($berkala1,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($berkala2,2,",",".")."</td>";

  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td></tr><tr>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($berkala1*100/$budget,2,",",".")."<br></td></tr><tr>";		
  }
  
// Premi Sekaligus
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.4.2. Premi Sekaligus ****)</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala1,2,",",".")."</a></td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($sekaligus1,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($sekaligus2,2,",",".")."</td>";

  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td></tr><tr>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($sekaligus1*100/$budget,2,",",".")."<br></td></tr><tr>";		
  }

// Topup Berkala
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.4.3. Topup Berkala ***)</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala1,2,",",".")."</a></td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($topupbk1,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($topupbk2,2,",",".")."</td>";

  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td></tr><tr>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($topupbk1*100/$budget,2,",",".")."<br></td></tr><tr>";		
  }

// Topup Sekaligus
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.4.4. Topup Sekaligus ****)</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala1,2,",",".")."</a></td>";
//  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($berkala2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($topupskg1,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($topupskg2,2,",",".")."</td>";

  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td></tr><tr>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($topupskg1*100/$budget,2,",",".")."<br></td></tr><tr>";		
  }

  return $rtnValue;	
}

function unitLink($kdktr,$dthn,$tglAwalCari,$tglDariCari,$tglSampaiCari)
{
	GLOBAL $angsub,$jmlpremisub1,$jmlpremisub2;
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
	else if (substr($kdktr,1,1)=='Z'){
		 $wherektr="left(a.referenceno, 1)='".substr($kdktr,0,1)."' and ";
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
	$angsub=$budget;
	$jmlpremisub1=$sub1;
	$jmlpremisub2=$sub2;
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.3.1. Subscription *)</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($sub2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($sub1,2,",",".")."</a></td>";
  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($sub1*100/$budget,2,",",".")."<br></td></tr>";		
  }

// Top-Up
	$angtop=$budget;
	$jmlpremitop1=$top1;
	$jmlpremitop2=$top2;

	$rtnValue=$rtnValue."<tr>";
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.3.2. Top-Up **)</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=TOP','popuppage','1000','300','yes')\">".number_format($top2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=TOP','popuppage','1000','300','yes')\">".number_format($top1,2,",",".")."</a></td>";
  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($top1*100/$budget,2,",",".")."<br></td></tr>";		
  }	
	
// Redemption
/* ------------------------------------------------------------
	$angred=$budget;
	$jmlpremired1=$red1;
	$jmlpremired2=$red2;

	$rtnValue=$rtnValue."<tr>";
	$rtnValue=$rtnValue."<td></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.3.3. Redemption</p></td>";
  $rtnValue=$rtnValue."<td align=\"right\">".number_format($budget,2,",",".")."</td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\">".number_format($red2,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\">".number_format($red1,2,",",".")."</a></td>";
  if ($budget==0){
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br></td>";
  }
  else{
  		$rtnValue=$rtnValue."<td align=\"right\">".number_format($red1*100/$budget,2,",",".")."<br></td>";		
  }
----------------------------------------------------- */   
  return $rtnValue;	
}

function nilaiRekening($nourut,$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari)
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
	if ($nourut=='C.3.'||$nourut=='C.4.'||$nourut=='C.5.'||$nourut=='C.6.'||$nourut=='C.7.'){
		$sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('M') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	else {
		$sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	//echo $sq2;
    $DBA->parse($sq2);
    $DBA->execute();
    $debet1=0;
    $kredit1=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet1=$arx["DEBET"];
    			$kredit1=$arx["KREDIT"];			
    }					
    

    // Periode Tgl Dari s/d Tgl Sampai
	if ($nourut=='C.3.'||$nourut=='C.4.'||$nourut=='C.5.'||$nourut=='C.6.'||$nourut=='C.7.'){
		$sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('M') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	else {
		$sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','L') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
    $DBA->parse($sq3);
    $DBA->execute();
    $debet2=0;
    $kredit2=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet2=$arx["DEBET"];
    			$kredit2=$arx["KREDIT"];			
    }					

		$rtnValue="<td align=\"right\">".number_format($budget,2,",",".")."</td>";
		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit2-$debet2),2,",",".")."</a></td>";
		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs($kredit1-$debet1),2,",",".")."</a></td>";
		if ($budget==0){
				$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
		}
		else{
				$rtnValue=$rtnValue."<td align=\"right\">".number_format(abs($kredit1-$debet1)*100/$budget,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
		}

//		echo "$kdktr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun;
				
		if ($nourut=='C.1.'||$nourut=='C.2.'||$nourut=='C.3.'||$nourut=='C.4.'){
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
											 "where k.kdkantor like '%A' or k.kdkantor='KP' ". 
              				 "order by k.kdkantor";
          		  $DBZ->parse($sqa);
          			$DBZ->execute();					 
          		  while ($arz=$DBZ->nextrow()) {
                  	$sqa = "select k.kdkantor,k.namakantor ".
                  	       "from $DBUser.tabel_001_kantor k ".
													 "where k.kdkantor like '".substr($arz["KDKANTOR"],0,1)."%' ".
                  				 "order by k.kdkantor";
              		  $DB->parse($sqa);
              			$DB->execute();					 
              		  while ($art=$DB->nextrow()) {
echo "								 <option value='".$art["KDKANTOR"]."'>".$art["KDKANTOR"]." - ".$art["NAMAKANTOR"]."</option>";
              			}										
										if (!($arz["KDKANTOR"]=='KP'||$arz["KDKANTOR"]=='RA')){
echo "								 <option value='".substr($arz["KDKANTOR"],0,1)."Z'>-- ".substr($arz["KDKANTOR"],0,1)."Z - SE-".$arz["NAMAKANTOR"]." --</option>";										
          					}
								}

echo "          </select>";
echo "      </td></tr>";
echo "      <tr><td class=\"verdana9blk\">Status Pembukuan</td>";
echo "      <td class=\"verdana9blk\" colspan=5>";
echo "          <select name=stposted>";
echo "				<option value='all'>SELURUH STATUS (ALL)</option>";
echo "				<option value='Y'>POSTED (Y)</option>";
echo "				<option value='N'>UNPOSTED (N)</option>";
echo "          </select>";
echo "       *) Khusus Data dari GL-LiNk</td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";

#--------------------------------------------------- end navigasi --------------
if($cari){
			 if ($ktr=='all'){
			 		$wherektr="";
			 		$wherektr1="";
					$kdktr="";
					
					$namakantor="SELURUH KANTOR PT ASURANSI JIWA IFG";
			 }
			 elseif (substr($ktr,1,1)!='Z'){
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
			 elseif (substr($ktr,1,1)=='Z'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".substr($ktr,0,1)."A' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();					 
    		  while ($arr=$DB->nextrow()) {
								$namakantor="SE-".$arr["NAMAKANTOR"];
    			}					
			 		$wherektr="prefixpertanggungan like '".substr($ktr,0,1)."%' and ";
			 		$wherektr1="kdkantor like '".substr($ktr,0,1)."%' and ";
					$kdktr=$ktr;
			 }

			if ($stposted=='all') {
				$whereposted="";
			}
			else if ($stposted=='Y') {
				$whereposted="posted='Y' and ";
			}
			else if ($stposted=='N') {
				$whereposted="posted='N' and ";
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
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF"><?=$tglDari?> s/d <?=$tglSampai?></font></td> 
  <td bgcolor="#3366CC" align="center"><font color="#FFFFFF">01/01/<?=$dthn?> s/d <?=$tglSampai?></font></td>
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
			 "where ".$wherektr1."tahun='".$dthn."'";
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
		 $juavrdi1=$juavrdi1+$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='1'){
		 $juavrti1=$juavrti1+$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='3'){
		 $juava1=$juava1+$arr["JUA"];
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
		 $juavrdi2=$juavrdi2+$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='1'){
		 $juavrti2=$juavrti2+$arr["JUA"];
	}
	elseif ($arr["KDVALUTA"]=='3'){
		 $juava2=$juava2+$arr["JUA"];
	}
}

?>
 <tr>
 	<td></td>		
  <td><p>&nbsp;&nbsp;&nbsp;A.1. Pertanggungan Perorangan</p></td>
  <td align="right"><?=number_format($target,0,",",".");?></td>
  <td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($polis2,0,",",".");?></a></td>
  <td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($polis1,0,",",".");?></a></td>
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
		<td align="right"><?=number_format($polis2,0,",",".");?></td>
		<td align="right"><?=number_format($polis1,0,",",".");?></td>
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
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=0&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrdi2,2,",",".");?></a></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=0&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrdi1,2,",",".");?></a></td>
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
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=1&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrti2,2,",",".");?></a></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=1&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juavrti1,2,",",".");?></a></td>
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
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=3&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juava2,2,",",".");?></a></td>
		<td align="right"><?echo "<a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo.php?wherektr=".$kdktr."&wherevaluta=3&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."','popuppage','1000','300','yes')\">";?><?=number_format($juava1,2,",",".");?></a></td>
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
		<td align="right"><?=number_format($juavrdi2,2,",",".");?></td>
		<td align="right"><?=number_format($juavrdi1,2,",",".");?></td>
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
		<td align="right"><?=number_format($juavrti2,2,",",".");?></td>
		<td align="right"><?=number_format($juavrti1,2,",",".");?></td>
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
		<td align="right"><?=number_format($juava2,2,",",".");?></td>
		<td align="right"><?=number_format($juava1,2,",",".");?></td>
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
		if ($dthn<='2008'){
			$kdrekening="('305112','305122','305135','305313','305314','308002','315602','305212','305222','305312','305322','305412','305422','305512','305522','305612','305622','305712','305722','305812','305822','308101','308102','308103','308201','308202','308203','308301','308302','308303','308401','308402','308403','308501','308502','308503','308601','308602','308603','308701','308702','308703','308801','308802','308803','315102','315202','315302','315402','315502','315602','315702','315802','703112','703122','703212','703222','703312','703322','703412','703422','703512','703522','703612','703622','703712','703722','703812','703822','707102','707202','707302','707402','707502','707602','707702','707802','930004','308001','308305','305502','315502','305814')";
		}else{
			$kdrekening=//"('311210300','311220100','311210400','311220200','311210500','311210600','311210700','311220300','311210800','311220400','311210900','311220500','311211000','311220600','311211100','311211200','311220700','311211300','311220800','311110100','311130100','311120800','311110200','311130200','311120700','311110300','311130300','311120600','311110400','311110500','311110600','311130400','311120300','311110700','311130500','311120500','311110800','311130600','311120400','311110900','311130700','311120200','311111000','311130800','311120100','314101000','314102000','314103000','314104000','314105000','314106000','314107000','314108000','313101000','313201000','313102000','313202000','313103000','313203000','313104000','313204000','313105000','313205000','313106000','313206000','313107000','313207000','313108000','313208000','311230100','311230200','311230300','311230400','311230500','311230600','311230700','311230800','314301000','314302000','314303000','314304000','314305000','314306000','314307000','314308000','313301000','313302000','313303000','313304000','313305000','313306000','313307000','313308000')";
/*			"('123110100','123110200',".
			"'123110300','123110400',".
			"'123110500','123110600',".
			"'123110700','123110800',".
			"'123110900','123111000',".
			"'123111100','123111200',".
			"'123111300',".
			"'123111400',".
			"'123111500',".
			"'123111600',".
			"'123111700',".
			"'123111800',".
			"'123111900',".
			"'123112000',".
			"'123112100',".
			"'123112200',".
			"'123112300',".
			"'123112400',".
			"'123112500',".
			"'123112600',".
			"'123112700',".
			"'123112800',".
			"'123112900',".
			"'123120000',".
			"'123120100',".
			"'123120200',".
			"'123120300',".
			"'123120400',".
			"'123120500',".
			"'123120600',".
			"'123120700',".
			"'123120800',".
			"'123120900',".
			"'123121000',".
			"'123121100',".
			"'123121200',".
			"'123121300',".
			"'123121400',".
			"'123121500',".
			"'123121600',".
			"'123121700',".
			"'123121800',".
			"'123121900',".
			"'123122000',".
			"'123122100',".
			"'123122200',".
			"'123122300',".
			"'123122400',".
			"'123122500',".
			"'123122600',".
			"'123122700',".
			"'123122800',".
			"'123122900',".
			"'123123000')";*/
			"('123112100',".
			"'123112200',".
			"'123112300',".
			"'123112400',".
			"'123112500',".
			"'123112600',".
			"'123112700',".
			"'123112800',".
			"'123112900',".
			"'123122300',".
			"'123122400',".
			"'123122500',".
			"'123122600',".
			"'123122700',".
			"'123122800',".
			"'123122900',".
			"'123123000',".
			"'311230000',".
			"'311230900',".
			"'710600000'".
			"'123110100',".
			"'123110200',".
			"'123110300',".
			"'123110400',".
			"'123110500',".
			"'123110600',".
			"'123110700',".
			"'123110800',".
			"'123110900',".
			"'123111000',".
			"'123111100',".
			"'123111200',".
			"'123111300',".
			"'123111400',".
			"'123111500',".
			"'123111600',".
			"'123111700',".
			"'123111800',".
			"'123111900',".
			"'123112000',".
			"'123120000',".
			"'123120100',".
			"'123120200',".
			"'123120300',".
			"'123120400',".
			"'123120500',".
			"'123120600',".
			"'123120700',".
			"'123120800',".
			"'123121100',".
			"'123121200',".
			"'123121300',".
			"'123121400',".
			"'123121500',".
			"'123121600',".
			"'123121700',".
			"'123121800',".
			"'123121900',".
			"'123122000',".
			"'123122100',".
			"'123122200',".
			"'123410100',".
			"'123410200',".
			"'123410300',".
			"'123410400',".
			"'123410500',".
			"'123410600',".
			"'311211400',".
			"'311211500')";
		}
			echo nilaiRekening('C.1.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.2. Premi Sekaligus</p></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('307112','307113','307122','307212','307213','307222','307312','307313','307322','307412','307413','307422','307512','307513','307522','307523','307612','307613','307622','307712','307713','307722','307812','307813','307822','317102','317103','317202','317203','317302','317303','317402','317403','317502','317503','317602','317603','317702','317703','317802','317803','307642','307632','930004')";
		}else{
			$kdrekening=//"('311210100','311210200','311310100','311330100','311310200','311330200','311310300','311310400','311310500','311310600','311310700','311310800','311310900','311311000','311311100','311311200','311311300','311311400','311311500','311311600','311320100','311311700','311311800','311312100','311312200','311312300','311312400','311312500','311330300','311330500','311330600','311330700','311330800','311330900','311331000','311331100','311331200','311331300','311331400','311331500','311331600','311331700','311331800','311331900')";
		"('123130100',".
		"'123130200',".
		"'123130300',".
		"'123130400',".
		"'123130500',".
		"'123130600',".
		"'123130700',".
		"'123130800',".
		"'123130900',".
		"'123131000',".
		"'123131100',".
		"'123131200',".
		"'123131300',".
		"'123131400',".
		"'123131500',".
		"'123131600',".
		"'123131700',".
		"'123131800',".
		"'123131900',".
		"'123132000',".
		"'123132100',".
		"'123132200',".
		"'123132300',".
		"'123132400',".
		"'123132500',".
		"'123132600',".
		"'123132700',".
		"'123132800',".
		"'123132900',".
		"'123133000',".
		"'123133100',".
		"'123133200',".
		"'123133300',".
		"'123133400',".
		"'123133500',".
		"'123133600',".
		"'123133700',".
		"'123133800',".
		"'123133900',".
		"'123134000',".
		"'123134100',".
		"'123134200',".
		"'123134300',".
		"'123134400',".
		"'123134500',".
		"'123134600',".
		"'123134700',".
		"'123134800',".
		"'123134900')";
		}
			echo nilaiRekening('C.2.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.3. Premi Unit Link (JS-LiNk) - Premi/Subcription *)</p></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('700037')";
		}else{
			$kdrekening="('331100000')";
		}
			echo nilaiRekening('C.3.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>
 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.4. Premi Unit Link (JS-LiNk) - TopUp **)</p></td>
<?
		if ($dthn<='2008'){
      		$kdrekening="('700038')";
      	}else{
			$kdrekening="('334100000')";
		}
			echo nilaiRekening('C.4.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>
 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.5. Premi dan TopUp New Unit-Link Berkala (New JS-LiNk) - TopUp ***)</p></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('700114','700116','700118')";
		}else{
			$kdrekening="('331200000','331300000','331400000')";
		}
			echo nilaiRekening('C.5.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>
 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;C.6. Premi dan TopUp New Unit-Link Sekaligus (New JS-LiNk) - TopUp ****)</p></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('700113','700115','700117')";
		}else{
			$kdrekening="('332100000','332200000','332300000')";
		}
			echo nilaiRekening('C.6.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
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
 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;<b>C.4. Premi New Unit Link (New JS-Link)</b></p></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
 </tr>
 <tr>
<?
			echo NewunitLink($DBX,$wherektr1,$kdktr,$dthn,$tglAwalCari,$tglDariCari,$tglSampaiCari);
			//==============saving plan
$sqsp="SELECT  SUM (a.premi1) premi ".
    	"FROM $DBUser.tabel_200_pertanggungan a, ".
        "$DBUser.tabel_500_penagih ryn, ".
        "$DBUser.tabel_214_acceptance_dokumen aks ".
   		"WHERE a.mulas between to_date('".$tglDariCari."','YYYYMMDD') and to_date('".$tglSampaiCari."','YYYYMMDD') ".
		$wherektr.
		"AND ryn.nopenagih = a.nopenagih ".
		"AND a.kdstatusfile IN ('1', '4') ".
		"AND a.kdproduk IN ('JSSP', 'JSSK') ".
		"AND a.nopertanggungan = aks.nopertanggungan ".
		"AND a.prefixpertanggungan = aks.prefixpertanggungan";
	$DBX->parse($sqsp);
    $DBX->execute();
	$arsp=$DBX->nextrow();
	$premisp=$arsp["PREMI"];
	//echo $sqsp;
	//echo $arsp["PREMI"];
//======================================
?>
 </tr>
 <tr>
 	<td></td>
	
	<??>
  <td><p>&nbsp;&nbsp;&nbsp;<b>C.5. Saving Plan</b></p></td>
	<td align="right"><?=number_format(0,2,",",".");?></td>
	<td align="right"><?=number_format($arsp["PREMI"],2,",",".");?></td>
	<td align="right"><?=number_format($arsp["PREMI"],2,",",".");?></td>
	<td align="right"><?=number_format(0,2,",",".");?></td>
 </tr>

 <tr>
 	
	<tr bgcolor="#a9d8e7">
		<td></td>
		<td><b>Jumlah Penerimaan Premi NB PP (C.1+C.2+C.3.1+C.3.2+C.4.1+C.4.2+C.4.3+C.4.4+C.5)</b></td>
		<td align="right"><?=number_format($angpreminbpp+$angtop,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpremisub2+$jmlpremitop2+$berkala1+$sekaligus1+$topupskg1+$topupbk1+$arsp["PREMI"],2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpremisub1+$jmlpremitop1+$berkala2+$sekaligus2+$topupskg2+$topupbk2+$arsp["PREMI"],2,",",".");?></td>
<?
	if ($angpreminbpp+$angsub+$angtop==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format(($jmlpreminbpp1+$jmlpremitop1+$berkala2+$sekaligus2+$topupskg2+$topupbk2)*100/($angpreminbpp+$angtop),2,",",".");?></td>
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
		if ($dthn<='2008'){
      $kdrekening="('334115','334116','334215','334216','334315','334316','334415','334416','334515','334516','334615','334616','334715','334716','334815','334816','334105','334106','334205','334206','334305','334306','334405','334406','334505','334506','334605','334606','334705','334706','334805','334806','330123','330223','330323','330423','330523','330623','330723','330823','331103','331203','331303','331403','331503','331603','331703','331803','336114','336115','336214','336215','336314','336315','336414','336415','336514','336515','336614','336615','336714','336715','336814','336815','336104','336105','336204','336205','336304','336305','336404','336405','336504','336505','336604','336605','336704','336704','336804','336805','333113','333213','333313','333413','333513','333613','333713','333813','333103','333203','333303','333403','333503','333603','333703','333803','930006')";
		}else{
  		$kdrekening=//"('321230900','321231200','321210200','321210300','321231300','321231400','321210500','321210600','321231500','321231600','321210700','321210800','321230500','321230600','321210900','321211000','321231000','321231100','321211200','321211300','321230700','321230800','321211400','321211500','321230100','321230400','321211600','321211700','321230200','321230300','321211800','321211900','323110200','323130200','323110300','323130300','323130400','323130500','323130600','323130700','323110400','323110500','323110700','323110800','323120100','323130800','323130900','323131000','323131100','323110900','323111000','323111100','323111200','323120700','323131200','323131300','323131400','323131500','323111300','323111400','323111500','323111600','323120800','323131600','323131700','323131800','323131900','323111700','323111800','323111900','323112000','323120300','323132000','323132100','323132200','323132300','323112100','323112200','323112300','323112400','323120600','323132400','323132500','323132600','323132700','323112500','323112600','323112700','323112800','323120200','323132800','323132900','323133000','323133100','323112900','323113000','323113100','323113200','323120400','323133200','323133300','323133400','323133500','323113300','323113400','323113500','323113600','323120500','323130100','323210900','323211000','323211100','323211200','323211300','323211400')";
		"('123220100',".
		"'123220200',".
		"'123220300',".
		"'123220400',".
		"'123220500',".
		"'123220600',".
		"'123220700',".
		"'123220800',".
		"'123220900',".
		"'123221000',".
		"'123221100',".
		"'123221200',".
		"'123221300',".
		"'123221400',".
		"'123221500',".
		"'123221600',".
		"'123221700',".
		"'123221800',".
		"'123221900',".
		"'123222000',".
		"'123222100',".
		"'123222200',".
		"'123222300',".
		"'123222400',".
		"'123222500',".
		"'123222600',".
		"'123222700',".
		"'123222800',".
		"'123222900',".
		"'123223000',".
		"'123223100',".
		"'123223200',".
		"'123223300',".
		"'123223400',".
		"'123223500',".
		"'123223600',".
		"'123223700',".
		"'123223800',".
		"'123223900',".
		"'123224000',".
		"'123224100',".
		"'123224200',".
		"'123224300',".
		"'123224400',".
		"'123224500',".
		"'123224600',".
		"'123224700',".
		"'123224800',".
		"'123224900',".
		"'123225000',".
		"'123225100',".
		"'123225200',".
		"'123225300',".
		"'123225400',".
		"'123225500',".
		"'123225600',".
		"'123225700',".
		"'123225800',".
		"'123225900',".
		"'123226000',".
		"'123226100',".
		"'123226200',".
		"'123226300',".
		"'123226400',".
		"'123226500',".
		"'123230100',".
		"'123230200',".
		"'123230300',".
		"'123230400',".
		"'123230500',".
		"'123230600',".
		"'123230700',".
		"'123230800',".
		"'123230900',".
		"'123231000',".
		"'123231100',".
		"'123231200',".
		"'123231300',".
		"'123231400',".
		"'123231500',".
		"'123231600',".
		"'123231700',".
		"'123231800',".
		"'123231900',".
		"'123232000',".
		"'123232100',".
		"'123232200',".
		"'123232300',".
		"'123232400',".
		"'123232500',".
		"'123232600',".
		"'123232700',".
		"'123232800',".
		"'123232900',".
		"'123233000',".
		"'123233100',".
		"'123233200',".
		"'123233300',".
		"'123233400',".
		"'123233500',".
		"'123233600',".
		"'123233700',".
		"'123233800',".
		"'123233900',".
		"'123234000',".
		"'123234100',".
		"'123234200',".
		"'123234300',".
		"'123234400',".
		"'123234500',".
		"'123234600',".
		"'123234700',".
		"'123234800',".
		"'123234900',".
		"'123235000',".
		"'123235100',".
		"'123235200',".
		"'123235300',".
		"'123235400',".
		"'123235500',".
		"'123235600',".
		"'123235700',".
		"'123235800',".
		"'123235900',".
		"'123236000',".
		"'123236100',".
		"'123236200',".
		"'123236300',".
		"'123236400',".
		"'123236500',".
		"'123236600',".
		"'123236700',".
		"'123236800',".
		"'123236900',".
		"'123237000',".
		"'123237100',".
		"'123237200',".
		"'123237300',".
		"'123237400',".
		"'123237500',".
		"'123320100',".
		"'123320200',".
		"'123320300',".
		"'123320400',".
		"'123320500',".
		"'123320600',".
		"'123320700',".
		"'123320800',".
		"'123320900',".
		"'123321000',".
		"'123321100',".
		"'123321200',".
		"'123321300',".
		"'123321400',".
		"'123321500',".
		"'123321600',".
		"'123321700',".
		"'123321800',".
		"'123321900',".
		"'123322000',".
		"'123322100',".
		"'123330100',".
		"'123330200',".
		"'123330300',".
		"'123330400',".
		"'123330500',".
		"'123330600',".
		"'123330700',".
		"'123330800',".
		"'123330900',".
		"'123331000',".
		"'123331100',".
		"'123331200',".
		"'123331300',".
		"'123331400',".
		"'123331500',".
		"'123331600',".
		"'123331700',".
		"'123331800',".
		"'123331900',".
		"'123332000',".
		"'123332100',".
		"'123332200',".
		"'123332300',".
		"'123332400',".
		"'123332500',".
		"'123332600',".
		"'123332700',".
		"'123332800',".
		"'123332900',".
		"'123333000',".
		"'123333100',".
		"'123333200',".
		"'123333300',".
		"'123333400',".
		"'123333500',".
		"'123333600',".
		"'123333700',".
		"'123333800',".
		"'123333900',".
		"'123334000',".
		"'123334100',".
		"'123334200',".
		"'123334300',".
		"'123334400',".
		"'123334500',".
		"'123334600')";
		}
			echo nilaiRekening('D.1.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;D.2. Premi Tambahan/Kenaikan</p></td>
<?
		if ($dthn<='2008'){
      $kdrekening="('330112','330122','330212','330222','330312','330322','330412','330422','330512','330522','330612','330622','330712','330722','330812','330822','331002','331102','331202','331302','331402','331502','331602','331702','331802','338000','338002','338100','338102','338200','338202','338300','338302','338400','338402','338500','338502','338600','338602','338700','338702','338800','338802','339002','339102','339202','339302','339402','339502','339602','339702','339802','717102','717112','717122','717202','717212','717222','717302','717312','717322','717402','717412','717422','717502','717512','717522','717602','717612','717622','717702','717712','717722','717802','717812','717822','332012','332212','722212','333012','333112','333212','333412','333512','725112','725212','725512','305135','337012','337013','337222','334002','334003','334012','334013','334030','334031','334032','334033','334102','334103','334112','334113','334114','334202','334203','334212','334213','334302','334303','334312','334313','334402','334403','334412','334413','334502','334503','334512','334513','334602','334603','334612','334613','334702','334703','334712','334713','334802','334803','334812','334813','337112','335000','335100','336012','336013','336112','336113','336212','336213','336412','336413','336512','336513','330013','930006')";
		}else{
			$kdrekening="('321110100','321110200','321120100','321110300','321110400','321120400','321110500','321110600','321120500','321110700','321110800','321120800','321110900','321111000','321120700','321111100','321111200','321120600','321111300','321111400','321120300','321111500','321111600','321120200','321111700','321111800','321111900','323110100','321112000','321130100','321130200','321130300','321130400','321130500','321130600','321130700','321130800','321130900','321131000','321131100','321131200','321131300','321131400','321131500','321131600','325130100','325110100','325120000','325130200','325110200','325120100','325130300','325110300','325120700','325130400','325110400','325120200','325130500','325110500','325120400','325130600','325110600','325120600','325130700','325110700','325120300','325130800','321131700','325110800','325120500','321112100','321112200','321112300','325110900','321210100','321210400','321211100','325210000','325220000','325230000','321112400','321112500','321112600','321112700','321112800','321112900','321113000','321113100','321113200','321113300','321113400','321113500','321113600','321113700','321113800','321113900')";
		}
			echo nilaiRekening('D.2.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>
 
	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Penerimaan Premi NB PK (D.1+D.2)</b></td>
		<td align="right"><?=number_format($angpreminbpk,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk1,2,",",".");?></td>
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

	<tr bgcolor="#ccffcc">
		<td></td>
		<td><b>Jumlah Penerimaan Premi NB PP PK (C+D)</b></td>
		<td align="right"><?=number_format($angpreminbpp+$angtop-$angred+$angpreminbpk,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpremitop2-$jmlpremired2+$jmlpreminbpk2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpremitop1-$jmlpremired1+$jmlpreminbpk1,2,",",".");?></td>
<?
	if ($angpreminbpp+$angtop-$angred+$angpreminbpk==0){
?>
		 <td align="right"><?=number_format(0,2,",",".");?></td>
<?
	}
	else{
?>
		 <td align="right"><?=number_format(($jmlpreminbpp1+$jmlpremitop1-$jmlpremired1+$jmlpreminbpk1)*100/($angpreminbpp+$angtop-$angred+$angpreminbpk),2,",",".");?></td>
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
		if ($dthn<='2008'){
       $kdrekening="('305111','305121','305211','305221','305311','305321','305411','305421','305511','305521','305611','305621','305711','305721','305811','305821','315101','315201','315301','315401','315501','315601','315701','315801','702100','702200','702300','702400','702500','702600','702700','702800','703111','703121','703211','703221','703311','703321','703411','703421','703511','703521','703611','703621','703711','703721','703811','703821','706100','706200','706300','706400','706500','706600','706700','706800','707101','707201','707301','707401','707501','707601','707701','707801','930003')";
		}else{
			 $kdrekening=//"('312102000','312201000','312103000','312206000','312104000','312208000','312105000','312106000','312107000','312207000','312108000','312204000','312109000','312205000','312110000','312202000','312111000','312203000','314109000','314201000','314110000','314202000','314111000','314203000','314112000','314204000','314113000','314205000','314114000','314206000','314115000','314207000','314116000','314208000','312301000','312302000','312303000','312304000','312305000','312306000','312307000','312308000','314309000','314310000','314311000','314312000','314313000','314314000','314315000','314316000','312101000')";
		"('123140100',".
		"'123140200',".
		"'123140300',".
		"'123140400',".
		"'123140500',".
		"'123140600',".
		"'123140700',".
		"'123140800',".
		"'123140900',".
		"'123141000',".
		"'123141100',".
		"'123141200',".
		"'123141300',".
		"'123141400',".
		"'123141500',".
		"'123141600',".
		"'123141700',".
		"'123141800',".
		"'123141900',".
		"'123142000',".
		"'123142100',".
		"'123142200',".
		"'123142300',".
		"'123142400',".
		"'123142500',".
		"'123142600',".
		"'123142700')";
		}
			echo nilaiRekening('E.1.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><p>&nbsp;&nbsp;&nbsp;E.2. Pertanggungan Kumpulan</p></td>
<?
		if ($dthn<='2008'){
       $kdrekening="('930005','330031','330111','330121','330211','330221','330311','330321','330411','330421','330511','330521','330611','330621','330711','330721','330811','330821','331001','331101','331201','331301','331401','331501','331601','331701','331801','338001','338101','338201','338301','338401','338501','338601','338701','338801','339001','339101','339201','339301','339401','339501','339601','339701','339801','716100','716200','716300','716400','716500','716600','716700','716800','717101','717111','717121','717201','717211','717221','717301','717311','717321','717401','717411','717421','717501','717511','717521','717601','717611','717621','717701','717711','717721','717801','717811','717821','332011','332013','332211','332213','722211','722213','333011','333111','333211','333411','333511','725111','725211','725511','337011','732000')";
		}else{
			 //$kdrekening="('324110100','324120100','324110200','324120800','324110300','324120700','324110400','324120600','324110500','324120500','324110600','324120400','324110700','324120300','324110800','324120200','324110900','324130100','324130200','324130300','324130400','324130500','324130600','324130700','324130800','326130100','326130200','326130300','326130400','326130500','326130600','326130700','326130800','326130900','326110100','326120700','326131000','326110200','326120100','326131100','326110300','326120600','326131200','326110400','326120400','326131300','326110500','326120200','326131400','326110600','326120500','326131500','326110700','326110800','326131600','326110900','326120300','324111000','324111100','324111200','326111000','326131700','324210100','324210200','324210300','324210400','323230100','323210100','323230200','323210200','323230800','323210300','323230700','323210400','323230600','323210500','323230300','323210600','323230500','323210700','323230400','323210800','326210100','326210200','326210300','326210400','326210500','326210600','323110600','324111300','324111400','324111500','324111600','324111700','324111800','324111900','324112000','324112100','324112200','324112300','324112400','324112500','324112600','324112700','324112800')";
			 $kdrekening="('123240100','123240200','123240300',".
				"'123240400',".
				"'123240500',".
				"'123240600',".
				"'123240700',".
				"'123240800',".
				"'123240900',".
				"'123241000',".
				"'123241100',".
				"'123241200',".
				"'123241300',".
				"'123241400',".
				"'123241500',".
				"'123241600',".
				"'123241700',".
				"'123241800',".
				"'123241900',".
				"'123242000',".
				"'123242100',".
				"'123242200',".
				"'123242300',".
				"'123242400',".
				"'123242500',".
				"'123242600',".
				"'123242700',".
				"'123242800',".
				"'123242900',".
				"'123243000',".
				"'123243100',".
				"'123243200',".
				"'123243300',".
				"'123243400',".
				"'123243500',".
				"'123243600',".
				"'123243700',".
				"'123243800',".
				"'123243900',".
				"'123244000',".
				"'123244100',".
				"'123244200',".
				"'123244300',".
				"'123244400',".
				"'123244500',".
				"'123244600',".
				"'123244700',".
				"'123244800',".
				"'123244900',".
				"'123245000',".
				"'123245100',".
				"'123245200',".
				"'123245300',".
				"'123245400',".
				"'123245500',".
				"'123245600',".
				"'123245700',".
				"'123245800',".
				"'123245900',".
				"'123340100',".
				"'123340200',".
				"'123340300',".
				"'123340400',".
				"'123340500')";
		}
			echo nilaiRekening('E.2.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

	<tr bgcolor="#a9d8e7">
		<td></td>
		<td><b>Jumlah Penerimaan Premi OB (E.1+E.2)</b></td>
		<td align="right"><?=number_format($angpremiob,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpremiob2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpremiob1,2,",",".");?></td>
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
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpreminbobpp2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpreminbobpp1,2,",",".");?></td>
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
		<td align="right"><?=number_format($jmlpreminbpk2+$jmlpreminbobpk2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpk1+$jmlpreminbobpk1,2,",",".");?></td>
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
		<td align="right"><?=number_format($jmlpreminbpp2+$jmlpreminbpk2+$jmlpremiob2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlpreminbpp1+$jmlpreminbpk1+$jmlpremiob1,2,",",".");?></td>
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
  <td>A. Biaya Pemasaran</td>
<?
		if ($dthn<='2008'){
      $kdrekening="('509000','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','525001','525002','526000','527000','528000','529000','528001','508000','508001','519000','540000','541000','543000','544000','545000','549000','500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002')";
//      $kdrekening="('500000','500001','500002','500003','500004','500005','500006','500007','500008','500010','500011','500020','500021','500100','500101','500102','500103','500111','500121','500131','500200','500201','500202','500203','500211','500212','500300','501000','501001','501002','501003','501004','501005','502000','502001','503000','503001','503002','504000','505000','507000','508000','508001','509000','509001','509003','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','526000','527000','528000','529000','540000','541000','542000','544000','545000','549000','543000','502002','525001','500015','500009','507002','525002')";
    }else{
		  $kdrekening="('511110000','511120000','511140000','511150000','512205000','512206000','512010000','512020000','512107000','512108000','512101000','512102000','512104000','512105000','512112000','512113000','511130000','512103000','512106000','512116000','512120000','512122000','512201000','512202000','512203000','512204000','512207000','512208000','513010000','513020000','513030000','530400000','530500000','530600000','541000000','530700000','513080000','513100000','513090000','561000000','562000000','520100000','520400000','520500000','531000000','520600000','520700000','520800000','520900000','521000000','521100000','521200000','521300000','521400000','521500000','542000000','543000000','544000000','521600000','545000000','530200000','546000000','530300000','564000000','551000000','530800000','521700000','565000000')";
		}
			echo nilaiRekening('A.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

<!--
 <tr>
 	<td></td>
  <td>B. Biaya Inkaso</td>
<?
      $kdrekening="('550000','550001','550002','550003','550004','551000','551001','552000','553000','553001','553002','553003','554000','554001','555000','555001','556000','557000','557001','558000','558001','558002','559000','550400','550005','550304','550401','550402')";
			echo nilaiRekening('B.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>C. Biaya Overhead</td>
<?
      $kdrekening="('560000','561000','562000','563000','566000','567000','568000','569000','570000','565000','571000','572000','573000','574000','575000','576000','577000','578000','579000','580000','581000','582000','583000','584000','585000','589000','600000','601000','602000','603000','604000','605000','606000','607000','608000','609000','610000','611000','612000','612001','613000','620000','621000','622000','629000','630000','631000','632000','633000','640000','641000','642000','643000','644000','645000','647000','648000','649000','650000','650001','660000','670000','670001','671000','672000','673000','673001','674000','674001','675000','676000','677000','679000','679001','941000','942000','943000','944000','945000','946000','947000','948000')";
			echo nilaiRekening('C.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>D. Biaya Penebusan PP</td>
<?
      $kdrekening="('755201','755202','755301','755302','755501','755502','755601','765200','765300','765500','755201','755000','755102','755103','755401','755402','755602','757201','757202','757301','757302','757401','757402','757501','757502','757601','757602','765400','765600','767200','767300','767400','767500','767600','930026','930025')";
			echo nilaiRekening('D.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td>E. Biaya Penebusan PK</td>
<?
      $kdrekening="('774200','774400','774600','779200','783500','774201','774300','788703','788803','774001','774500','783100','783200','788103','788203','788208','788603','788703','788803','930026','930025')";
			echo nilaiRekening('E.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>
 
	<tr bgcolor="#ffffcc">
		<td colspan="2"><b>Jumlah Biaya (A+B+C+D+E)</b></td>
		<td align="right"><?=number_format($angbiaya,2,",",".");?></td>
		<td align="right"><?=number_format($jmlbiaya2,2,",",".");?></td>
		<td align="right"><?=number_format($jmlbiaya1,2,",",".");?></td>
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

-->
	
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