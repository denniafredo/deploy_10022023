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
    $sq1 = "select sum(budget4) AS BUDGET ".
           "from $DBUser.TABEL_802_BUDGET ".
    			 "where ".$wherektr1."tahun='".$dthn."' and ".
    			 "akun in ".$kdrekening;
		//echo $sq1;
    $DBA->parse($sq1);
    $DBA->execute();
    $budget=0;
    while ($arx=$DBA->nextrow()) {
					$budget=$arx["BUDGET"];
    }					

    // Periode Tgl Awal s/d Tgl Sampai
	if ($nourut=='C.3.'/*||$nourut=='C.4.'*/||$nourut=='C.5.'/*||$nourut=='C.6.'*/||$nourut=='C.7.'){
		$sq2 = "select sum(debet) AS DEBET, sum(kredit)AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('M') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	elseif ($nourut=='C.6.'||$nourut=='C.5.2.'){
		$sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','L','M') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	elseif ($nourut=='A.'){
		$sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','M') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	else {
		$sq2 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','M') and kdtrans>='".$tglAwalCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	//echo $sq2;
    $DBA->parse($sq2);
    $DBA->execute();
    $debet1=0;
    $kredit1=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet1=abs($arx["DEBET"]);
    			$kredit1=abs($arx["KREDIT"]);
				$jml1=abs($arx["JML"]);			
    }					
    

    // Periode Tgl Dari s/d Tgl Sampai
	if ($nourut=='C.3.'/*||$nourut=='C.4.'*/||$nourut=='C.5.'/*||$nourut=='C.6.'*/||$nourut=='C.7.'){
		$sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML  ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('M') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	elseif ($nourut=='C.6.'||$nourut=='C.5.2.'){
		$sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','L','M') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	elseif ($nourut=='A.'){
		$sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','M') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
	else {
		$sq3 = "select sum(debet) AS DEBET, sum(kredit) AS KREDIT, abs(sum(debet)-sum(kredit)) JML ".
			   "from $DBUser.tabel_802_trvouc ".
					 "where ".$wherektr1."substr(notrans,0,1) in ('B','K','M') and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." akun in ".$kdrekening;
	}
    $DBA->parse($sq3);
    $DBA->execute();
    $debet2=0;
    $kredit2=0;					 
    while ($arx=$DBA->nextrow()) {
    			$debet2=abs($arx["DEBET"]);
    			$kredit2=abs($arx["KREDIT"]);
				$jml2=abs($arx["JML"]);			
    }					

		$rtnValue="<td align=\"right\">".number_format($budget,2,",",".")."</td>";
		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('pop_ti.php?wherektr=$kdktr&thn=$dthn&tglDariCari=$tglDariCari&tglSampaiCari=$tglSampaiCari&nourut=$nourut&ktr=$kdktr&posted=$stposted','popuppage','1000','300','yes')\">".number_format(abs(/*$kredit2-$debet2*/$jml2),2,",",".")."</a></td>";
		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('pop_ti.php?wherektr=$kdktr&thn=$dthn&tglDariCari=$tglAwalCari&tglSampaiCari=$tglSampaiCari&nourut=$nourut&ktr=$kdktr&posted=$stposted','popuppage','1000','300','yes')\">".number_format(abs(/*$kredit2-$debet2*/$jml1),2,",",".")."</a></td>";
//		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs(/*$kredit2-$debet2*/$jml2),2,",",".")."</a></td>";
//		$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_gllink.php?wherektr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun."','popuppage','1000','300','yes')\">".number_format(abs(/*$kredit1-$debet1*/$jml1),2,",",".")."</a></td>";
		if ($budget==0){
				$rtnValue=$rtnValue."<td align=\"right\">".number_format(0,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";
		}
		else{
				$rtnValue=$rtnValue."<td align=\"right\">".number_format(abs($kredit1-$debet1)*100/$budget,2,",",".")."<br><input type='hidden' name='rekening' value='".$kdrekening."'></td>";		
		}

//		echo "$kdktr=".$kdktr."&dthn=".$dthn."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&akun=".$akun;
		
		if ($nourut=='C.1.' || $nourut=='C.2.1.'|| $nourut=='C.2.2'|| $nourut=='C.4.1'|| $nourut=='C.4.2'||$nourut=='C.4.3'||$nourut=='C.4.4'||$nourut=='C.5.1.'||$nourut=='C.5.2.'||$nourut=='C.6'){
			 $angpreminbpp=$angpreminbpp+$budget;
			 $jmlpreminbpp1=$jmlpreminbpp1+$jml1;
			 $jmlpreminbpp2=$jmlpreminbpp2+$jml2;
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
        for($currentYear = $startYear - 3; $currentYear <= $startYear+0;$currentYear++) 
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
echo "								 <option value='".substr($arz["KDKANTOR"],0,1)."Z'>-- ".substr($arz["KDKANTOR"],0,1)."Z - SE-".$arz["NAMAKANTOR"]." --</option>";										
				}
echo "          </select>";
echo "      </td></tr>";
echo "      <tr><td class=\"verdana9blk\">Status Pembukuan</td>";
echo "      <td class=\"verdana9blk\" colspan=5>";
echo "          <select name=stposted>";
//echo "				<option value='all'>SELURUH STATUS (ALL)</option>";
echo "				<option value='Y'>POSTED (Y) -- Setelah Tutup Buku</option>";
echo "				<option value='all'>UNPOSTED (N) -- Sebelum Tutup Buku</option>"; //unposted status all krn bln sblmnya sudah diposted
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
		
		//echo $tglAwalCari.'</br>';	
		//echo $tglDariCari.'</br>';
		//echo $tglSampaiCari.'</br>';
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
  <td colspan="5"><b>BELANJA MODAL DAN BIAYA-BIAYA (DIVISI TEKNOLOGI INFORMASI)</b></td>
 </tr>
	
 <tr bgcolor="#a9d8e7">
 	<td></td>
  <td colspan="5"><b>A. Belanja Modal</b></td>
 </tr>

 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;A.1. Mesin Komputer (038/131311000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('038000')";
		}else{
			$kdrekening="('131311000')";
		}
			echo nilaiRekening('A.1.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;A.2. Intagible Asset (???/142150000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('???')";
		}else{
			$kdrekening="('142150000')";
		}
			echo nilaiRekening('A.2.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr>

 <tr bgcolor="#a9d8e7">
 	<td></td>
  <td colspan="5"><b>B. Biaya-Biaya</b></td>
 </tr>

 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;B.1. Continuous Form (???/602104000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('???')";
		}else{
			$kdrekening="('622104000')";
		}
			echo nilaiRekening('B.1.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr> 
 
  <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;B.2. Biaya Pemeliharaan Komputer (620/622501000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('620000')";
		}else{
			$kdrekening="('622501000')";
		}
			echo nilaiRekening('B.2.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr> 

 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;B.3. Sewa Komputer (???/602502000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('???')";
		}else{
			$kdrekening="('622502000')";
		}
			echo nilaiRekening('B.3.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr> 
 
 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;B.4. Biaya Perlengkapan Komputer (???/622503000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('???')";
		}else{
			$kdrekening="('622503000')";
		}
			echo nilaiRekening('B.4.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr> 

 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;B.5. Lain-lain Biaya Mekanisasi (???/602504000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('???')";
		}else{
			$kdrekening="('622504000')";
		}
			echo nilaiRekening('B.5.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
?>
 </tr> 

 <tr>
 	<td></td>
  <td><b><p>&nbsp;&nbsp;&nbsp;B.6. Mekanisasi Software (629/622505000)</p></b></td>
<?
		if ($dthn<='2008'){
			$kdrekening="('629000')";
		}else{
			$kdrekening="('622505000')";
		}
			echo nilaiRekening('B.6.',$DBA,$wherektr1,$kdktr,$whereposted,$dthn,$kdrekening,$tglAwalCari,$tglDariCari,$tglSampaiCari);
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