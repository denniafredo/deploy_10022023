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
<title>Virtual Account</title>
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
DAFTAR VIRTUAL ACCOUNT
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

	//echo $sqx;

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
echo "      <td class=\"verdana9blk\"><select name=statuspolis>";
if($statuspolis=="1"){
echo "<option value=''>--Status Pertanggungan--</option>";
echo "<option value='1' selected>Proposal</option>";
echo "<option value='2'>Polis</option>";
}elseif($statuspolis=="2"){
echo "<option value=''>--Status Pertanggungan--</option>";
echo "<option value='1'>Proposal</option>";
echo "<option value='2' selected>Polis</option>";
}else{
echo "<option value=''>--Status Pertanggungan--</option>";
echo "<option value='1'>Proposal</option>";
echo "<option value='2'>Polis</option>";
}
echo "</select></td> ";

echo "      <td class=\"verdana9blk\"><select name=kdstatuspolis>";

echo "<option value='1'>Aktif</option>";
echo "<option value='4'>BPO</option>";

echo "</select></td> ";

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
      echo "PERIODE AKSEPTASI ".$tglDari." s/d ".$tglSampai."<br><br>";
	  
	  //$sql= " SELECT (select kdproduk from $DBUser.tabel_200_pertanggungan where prefixpertanggungan=A.prefixpertanggungan and nopertanggungan=A.nopertanggungan) produk, A.*, TO_CHAR(TGLREKAM,'DD/MM/YYYY') TGLREKAM FROM $DBUser.TABEL_100_KLIEN_ACCOUNT A where trunc(tglrekam) between to_date('".$tglDari."','DD/MM/YYYY') and to_date('".$tglSampai."','DD/MM/YYYY') AND JENIS='VA' AND STATUS='0'";	
	  
	  if($kdstatuspolis=='1'){
	  
	  $sql="select a.kdproduk produk,b.*,TO_CHAR (b.TGLREKAM, 'DD/MM/YYYY') TGLREKAM from  $DBUser.TABEL_200_pertanggungan A,
$DBUser.TABEL_100_KLIEN_ACCOUNT b  where a.nopertanggungan=b.nopertanggungan and a.prefixpertanggungan=b.prefixpertanggungan
and  TRUNC (b.tglrekam) BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
                              AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
         AND b.JENIS = 'VA'
         AND b.STATUS = '0'  
		 AND b.KDBANK='BNI'		 
         and a.kdpertanggungan ='".$statuspolis."'
		 and a.kdstatusfile ='".$kdstatuspolis."'
		 ";
		 }else{
		$sql="select A.TGLBPO,a.kdproduk produk,b.*,TO_CHAR (b.TGLREKAM, 'DD/MM/YYYY') TGLREKAM from  $DBUser.TABEL_200_pertanggungan A,
$DBUser.TABEL_100_KLIEN_ACCOUNT b,$DBUser.polis_history_status c  where a.nopertanggungan=b.nopertanggungan and a.prefixpertanggungan=b.prefixpertanggungan
and  TRUNC (c.TGLMUTASI) BETWEEN TO_DATE ('".$tglDari."', 'DD/MM/YYYY')
                              AND  TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')
         AND b.JENIS = 'VA'
         AND b.STATUS = '0'  
		 AND b.KDBANK='BNI'	
		 and a.nopertanggungan = c.nopertanggungan
         AND a.prefixpertanggungan = c.prefixpertanggungan	
         and a.kdpertanggungan ='".$statuspolis."'
		 and a.kdstatusfile ='".$kdstatuspolis."'
		 ";		
		 }
    }	
	  
	  //echo $sql;
	  //die;
echo "<a href=# onclick=NewWindow('download_virtual_acc.php?tglDari=".$tglDari."&tglSampai=".$tglSampai."&statuspolis=".$statuspolis."&kdstatuspolis=".$kdstatuspolis."','',700,400,1)>Download XLS</a>";				
?>
<br /><br />

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">BO</td>
		<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Bank</td>
    <td bgcolor="#89acd8" align="center">Account</td>
    <td bgcolor="#89acd8" align="center">Tanggal</td>
    <td bgcolor="#89acd8" align="center">Tanggal Bpo</td>
    <td bgcolor="#89acd8" align="center">Keterangan</td>
    <td bgcolor="#89acd8" align="center">Produk</td>
  </tr>
  <? 
  
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
		$ket = explode('-', $arr['KETERANGAN']);
		$keterangan = $ket[0].'-IFGLIFE-'.$ket[1];
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["KDBANK"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NOACCOUNT"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["TGLREKAM"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["TGLBPO"];?></td>		
        <td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$keterangan;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["PRODUK"];?></td>

	<? 
	$i++;

	}
	
	?>
      </tr>
</table>