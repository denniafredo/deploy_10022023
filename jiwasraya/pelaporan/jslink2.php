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
	echo "<a class=verdana10blu><b>LAPORAN TRANSAKSI UNIT LINK</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function unitLink($no,$kdktr,$tglAwalCari,$tglSampaiCari,$DBX,$pil)
{

	GLOBAL $jml_i;
  GLOBAL $jml_rp_nett;
	GLOBAL $jml_rp_gross;
	GLOBAL $saldo_trans;
	GLOBAL $jml_sub;
	GLOBAL $jml_top;
	 
	// Transaksi Entry Proposal
  $sqx = "select count(prefixpertanggungan) as POLIS from $DBUser.tabel_200_pertanggungan where kdproduk like '".$produk."%' and (kdpertanggungan='1' or kdpertanggungan='2') and kdstatusfile='1' and ".
				 "prefixpertanggungan='".substr($kdktr,0,2)."' and ".
			   "to_char(tglrekam,'YYYYMMDD')>='".$tglAwalCari."' and ".
			   "to_char(tglrekam,'YYYYMMDD')<='".$tglSampaiCari."'";				 
	// echo $sqx;
  $DBX->parse($sqx);
  $DBX->execute();					 
  $arx=$DBX->nextrow();
	$polis=$arx["POLIS"];
	$jmlpolis=$jmlpolis+$polis;
	
  $myServer   = "danareksa";
  $myUser 		= "sa";
  $myPass 		= "siar";
  $myDB				= "unitlink";
  $s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
  $d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
  
	//from echo 
	/*$msquery = "select ".
					 	 			"trx_type,id_nasabah,nomor_polis,trx_date,rp_nett,tgl_nab,".
									"nab_jual,nab_beli,unit,rp_gross ".
              "from ul_transaksi ".
              "where status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."'";*/
	$msquery = "select trx_type,nomor_polis,trx_date,sum(rp_nett)  ,sum(rp_gross)*95/100 as TU, ".
							"(sum(rp_nett)-(sum(rp_gross)*95/100)) as SUB,(sum(rp_gross)*95/100)+".
							"(sum(rp_nett)-(sum(rp_gross)*95/100)) ".
              "from ul_transaksi ".
              "where kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."' ".
							"group by trx_type,nomor_polis,trx_date";						
  //echo $msquery;
  $msresults= mssql_query($msquery);
  		//=============
	//premi asuransi aja
	$msquerypremi = "SELECT SUM(PREMI) as TOTALPREMI FROM UL_NASABAH_PELUNASAN WHERE NOMOR_POLIS IN(select ".
					 	 			"nomor_polis ".
									"from ul_transaksi ".
              "where  kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."')";
	//echo $msquerpremi;
	$msresultspremi= mssql_query($msquerypremi);
	$rowpremi = mssql_fetch_array($msresultspremi);
	//premi topup
	$rowpremiTU = mssql_fetch_array($msresultspremi);
		$msquerypremiTU = "SELECT SUM(PREMITOPUP) as TOTALPREMI FROM UL_NASABAH_PELUNASAN WHERE NOMOR_POLIS IN(select ".
					 	 			"nomor_polis ".
									"from ul_transaksi ".
              "where kode_fund='$pil' and status='GOOD FUND' and left(nomor_polis,2)='".substr($kdktr,0,2)."' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."')";
	//echo $msquerpremi;
	$msresultspremiTU= mssql_query($msquerypremiTU);
	$rowpremiTU = mssql_fetch_array($msresultspremiTU);
	
	//=============
	
  $i=0;
  while ($row = mssql_fetch_array($msresults)){
		/*if($row["trx_type"]=="S" || $row["trx_type"]=="T")
		{
		//$rp_nett += $row["rp_nett"]+$row["rp_gross"];
		$rp_nett += $row["rp_nett"];
		}*/
		$sub		 += $row["SUB"];
		$top		 += $row["TU"];
		
		if($row["trx_type"]=="R")
		{
		$rp_gross += $row["rp_gross"];
		}
		$i++;
	}
	 $jml_i 		   += $i;
   $jml_rp_nett	 += $rp_nett;
	 $jml_rp_gross += $rp_gross;
	 $jml_sub	 += $sub;
	 $jml_top += $top;
	 //$saldo_trans  += $rp_nett-$rp_gross;
	 $saldo_trans  += $sub+$top-$rp_gross;
	 
  $rtnValue="";
	$rtnValue=$rtnValue."<tr bgcolor=#".($no % 2 ? "ffffff" : "dddddd").">";
	$rtnValue=$rtnValue."<td>".$no."</td>";
	$rtnValue=$rtnValue."<td>".$kdktr."</td>";
/*  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo2.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&whereproduk=JL&wherepertanggungan=ALL&fieldtgl=tglrekam','popuppage','1000','300','yes')\">".$i."</a></td>";*/
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($rowpremi["TOTALPREMI"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\">".number_format($rowpremiTU["TOTALPREMI"],2,",",".")."</td>";
	$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".$i."</a></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($sub,2,",",".")."</a></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\">".number_format($top,2,",",".")."</a></td>";
  $rtnValue=$rtnValue."<td align=\"right\"><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=".substr($kdktr,0,2)."&tglDariCari=".$tglAwalCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\">".number_format($rp_gross,2,",",".")."</a></td>";
	$rtnValue=$rtnValue."<td align=\"right\"><b>".number_format($sub+$top-$rp_gross,2,",",".")."</b></td>";
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
//echo "      <td class=\"verdana9blk\">Periode Entry Proposal/Transaksi</td>";
echo "      <td class=\"verdana9blk\">Periode Mulai</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> s/d </td> ";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("s");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
?>
		<td class="verdana9blk"><label>Produk</td><td>
		<select name="produk">
		  <option value="JL2">JL2</option>
		  <option value="JL3">JL3</option>
		</select>
		<select name="pilih">
		  <option>JSFX</option>
		  <option>JSEQ</option>
		  <option>JSBL</option>
		</select>
<?
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
			
      echo "LAPORAN TRANSAKSI UNIT LINK (".$produk.")<br>";
      echo "PERIODE ENTRY ".$tglDari." s/d ".$tglSampai."<br><br>";					
	  echo $pilih;
?>

 <table border="1" width="100%" style="border-collapse: collapse" id="table1" cellpadding="5">
 <tr>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">No</font></td>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Kantor</font></td>
	<td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Premi</font></td>
	<td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Top Up</font></td>
  <td bgcolor="#3366CC" rowspan="2" align="center"><font color="#FFFFFF">Jml. Transaksi</font></td>
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
		echo unitLink($no,$arx['KODE']." - ".$arx['NAMA'],$tglDariCari,$tglSampaiCari,$DBX,$pilih);
		$no++;
	}					
	//untuk total premi
	$msquerypremitotal = "SELECT SUM(PREMI) as TOTALPREMI FROM UL_NASABAH_PELUNASAN WHERE NOMOR_POLIS IN(select ".
					 	 			"nomor_polis ".
									"from ul_transaksi ".
              "where kode_fund='$pilih' and status='GOOD FUND' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."')";
	//echo $msquerpremi;
	$msresultspremitotal= mssql_query($msquerypremitotal);
	$rowpremitotal = mssql_fetch_array($msresultspremitotal);
	$jml_premi=$rowpremitotal["TOTALPREMI"];
	//untuk total premi top up
	$msquerypremitotalTU = "SELECT SUM(PREMITOPUP) as TOTALPREMI FROM UL_NASABAH_PELUNASAN WHERE NOMOR_POLIS IN(select ".
					 	 			"nomor_polis ".
									"from ul_transaksi ".
              "where kode_fund='$pilih' and status='GOOD FUND' and ".
              "convert(varchar,trx_date, 112)>='".$tglAwalCari."' and ".
              "convert(varchar,trx_date, 112)<='".$tglSampaiCari."')";
	$msresultspremitotalTU= mssql_query($msquerypremitotalTU);
	$rowpremitotalTU = mssql_fetch_array($msresultspremitotalTU);
	$jml_premiTU=$rowpremitotalTU["TOTALPREMI"];	
			
	echo "<tr bgcolor='#3366CC'>";
	echo "<td colspan='2' align ='center'><font color='#FFFFFF'><b>T O T A L</b></font></td>";
	echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo2.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&whereproduk=JL&wherepertanggungan=ALL&fieldtgl=tglrekam','popuppage','1000','300','yes')\"><b>".number_format($jml_premi,2,",",".")."</b></a></font></td>";
	echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo2.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&whereproduk=JL&wherepertanggungan=ALL&fieldtgl=tglrekam','popuppage','1000','300','yes')\"><b>".number_format($jml_premiTU,2,",",".")."</b></a></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jlindo2.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&whereproduk=JL&wherepertanggungan=ALL&fieldtgl=tglrekam','popuppage','1000','300','yes')\"><b>".$jml_i."</b></a></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\"><b>".number_format($jml_sub,2,",",".")."</b></a></font></td>";
	echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=SUB','popuppage','1000','300','yes')\"><b>".number_format($jml_top,2,",",".")."</b></a></font></td>";
  echo "<td align=\"right\"><font color='#FFFFFF'><a href=\"#\" onclick=\"NewWindow('nilaixbobot_jslink2.php?wherektr=&tglDariCari=".$tglDariCari."&tglSampaiCari=".$tglSampaiCari."&op=RED','popuppage','1000','300','yes')\"><b>".number_format($jml_rp_gross,2,",",".")."</b></a></font></td>";
	echo "<td align=\"right\"><font color='#FFFFFF'><b>".number_format($saldo_trans,2,",",".")."</b></font></td>";
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