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
<title>Autodebet</title>
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
DAFTAR AUTODEBET
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
/*        print("<select name=" . $inName .  "tgl>\n"); 
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
        print("</select>"); */

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
echo "      <td class=\"verdana9blk\">Jatuh Tempo</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("d");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> Kantor </td> ";
echo "      <td class=\"verdana9blk\"> ";
//               DateSelector("s");
			echo "<select name='kdkantor'>";

  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
  			     		 "order by kdkantor";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
      					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
  					}
  			
				
 			echo "</select>";
echo "      </td>";

echo "      <td class=\"verdana9blk\"> Bank </td> ";
echo "      <td class=\"verdana9blk\"> ";
//               DateSelector("s");
			echo "<select name='kdbank'>";

  			$sqa="select * from $DBUser.TABEL_399_BANK";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDBANK"]==$kdbank){ echo " selected"; }
      					echo " value=".$arr["KDBANK"].">".$arr["KDBANK"]." - ".$arr["NAMABANK"]."</option>";
  					}
  			
				
 			echo "</select>";
echo "      </td>";

echo "      <td class=\"verdana9blk\"> </td> ";


echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------

if($cari){
			//$tglDari=substr('00'.$dtgl,-2)."/".substr('00'.$dbln,-2)."/".$dthn;
			$tglDari=substr('00'.$dbln,-2)."/".$dthn;
			$tglSampai=substr('00'.$stgl,-2)."/".substr('00'.$sbln,-2)."/".$sthn;

			$tglAwalCari=$sthn."0101";			 		 
			$tglDariCari=$dthn.substr('00'.$dbln,-2).substr('00'.$dtgl,-2);
			$tglSampaiCari=$sthn.substr('00'.$sbln,-2).substr('00'.$stgl,-2);
      //echo "PERIODE AKSEPTASI ".$tglDari." s/d ".$tglSampai."<br><br>";
	  $sql="SELECT   to_char(c.tglbooked,'dd/mm/yyyy') tglbooked,
			 '99102' Control,
			 'IFGLIFE ' pers,
			 b.norekeningdebet,
			 d.norekening,
			 ROUND (
				(DECODE (c.tglbooked,
						 TO_DATE ('".$tglDari."', 'MM/YYYY'),
						 DECODE (SUBSTR (KDPRODUK, 1, 3),
								 'JL2',
								 1,
								 'JL3',
								 1,
								 0.99,
								 1),
						 1)
				 * DECODE (b.kdvaluta,
						   '0', ROUND (c.premitagihan / b.indexawal, 2),
						   c.premitagihan)
				 * (SELECT   kurs
					  FROM   $DBUser.tabel_999_kurs_transaksi x
					 WHERE   x.kdvaluta = b.kdvaluta
							 AND x.tglkursberlaku =
								   (SELECT   MAX (tglkursberlaku)
									  FROM   $DBUser.tabel_999_kurs_transaksi y
									 WHERE   x.kdvaluta = y.kdvaluta
											 AND y.tglkursberlaku <= SYSDATE))
				 + (SELECT   nilaimeterai
					  FROM   $DBUser.tabel_999_batas_materai
					 WHERE   DECODE (c.tglbooked,
									 TO_DATE ('".$tglDari."', 'MM/YYYY'),
									 DECODE (SUBSTR (KDPRODUK, 1, 3),
											 'JL2',
											 1,
											 'JL3',
											 1,
											 0.99,
											 1),
									 1)
							 * DECODE (b.kdvaluta,
									   '0',
									   ROUND (c.premitagihan / b.indexawal, 2),
									   c.premitagihan)
							 * (SELECT   kurs
								  FROM   $DBUser.tabel_999_kurs_transaksi x
								 WHERE   x.kdvaluta = b.kdvaluta
										 AND x.tglkursberlaku =
											   (SELECT   MAX (tglkursberlaku)
												  FROM   $DBUser.tabel_999_kurs_transaksi y
												 WHERE   x.kdvaluta = y.kdvaluta
														 AND y.tglkursberlaku <=
															   SYSDATE)) BETWEEN batasbawahpremi
																			 AND  batasataspremi)),
				2
			 )
				tagihan,
			 (b.prefixpertanggungan || '-' || b.nopertanggungan) nopolbaru1,
			 (SELECT   namaklien1
				FROM   $DBUser.tabel_100_klien
			   WHERE   noklien = b.nopembayarpremi)
				klien1,
			 ROWNUM,
			 (b.prefixpertanggungan || '-' || b.nopertanggungan) nopolbaru2,
			 (SELECT   namaklien1
				FROM   $DBUser.tabel_100_klien
			   WHERE   noklien = b.nopembayarpremi)
				klien2,
			 DECODE (b.kdcarabayar,
					 '1', 'BULANAN',
					 '2', 'KWARTALAN',
					 '3', 'SEMESTERAN',
					 '4', 'TAHUNAN',
					 'X', 'SEKALIGUS',
					 'E', 'SEKALIGUS CICILAN 5',
					 'J', 'SEKALIGUS CICILAN 10',
					 'B', 'BERKALA 1,2,3,4',
					 'A', 'TAHUNAN',
					 'H', 'SEMESTERAN',
					 'Q', 'KUARTALAN',
					 'M', 'BULANAN',
					 '')
				carabayar,
			 b.kdproduk,
			 (SELECT   phonetetap01
				FROM   $DBUser.tabel_100_klien
			   WHERE   noklien = b.nopembayarpremi)
				phonetetap01,
			 (SELECT   phonetetap02
				FROM   $DBUser.tabel_100_klien
			   WHERE   noklien = b.nopembayarpremi)
				phonetetap02,
			 (SELECT   phonetagih01
				FROM   $DBUser.tabel_100_klien
			   WHERE   noklien = b.nopembayarpremi)
				phonetagih01,
			 (SELECT   phonetagih02
				FROM   $DBUser.tabel_100_klien
			   WHERE   noklien = b.nopembayarpremi)
				phonetagih02,
			 b.nopol
	  FROM   $DBUser.tabel_300_historis_premi c,
			 $DBUser.tabel_200_pertanggungan b,
			 $DBUser.tabel_399_bank d,
			 $DBUser.tabel_500_penagih f
	 WHERE       (c.prefixpertanggungan = b.prefixpertanggungan)
	 		 AND b.kdpertanggungan='2'
			 AND (c.nopertanggungan = b.nopertanggungan)
			 AND (b.nopenagih = f.nopenagih)
			 AND (d.kdbank = b.kdbank)
			 AND (c.tglbooked <= TO_DATE ('".$tglDari."', 'MM/YYYY'))
			 AND (f.kdrayonpenagih IN
						(    SELECT   kdkantor
							   FROM   $DBUser.tabel_001_kantor
						 START WITH   kdkantor = '".$kdkantor."'
						 CONNECT BY   PRIOR kdkantor = kdkantorinduk))
			 AND (d.kdbank = '".$kdbank."')
			 AND (b.autodebet = '1')
			 AND (c.tglseatled IS NULL)
			 AND (b.kdstatusfile = '1')";
	  //$sql= " SELECT (select kdproduk from $DBUser.tabel_200_pertanggungan where prefixpertanggungan=A.prefixpertanggungan and nopertanggungan=A.nopertanggungan) produk, A.*, TO_CHAR(TGLREKAM,'DD/MM/YYYY') TGLREKAM FROM $DBUser.TABEL_100_KLIEN_ACCOUNT A where tglrekam between to_date('".$tglDari."','DD/MM/YYYY') and to_date('".$kdkantor.$kdbank."','DD/MM/YYYY') AND JENIS='VA' AND STATUS='0'";	
	  }	
	  
	 //echo $sql;
echo "<a href=# onclick=NewWindow('download_autodebet_xls.php?tglDari=".$tglDari."&kdkantor=".$kdkantor."&kdbank=".$kdbank."','',700,400,1)>Download XLS</a>";				
?>
<br /><br />

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">Jt. Tempo</td>
		<td bgcolor="#89acd8" align="center">Control</td>
    <td bgcolor="#89acd8" align="center">Perus.</td>
    <td bgcolor="#89acd8" align="center">Rek. Debet</td>
    <td bgcolor="#89acd8" align="center">No.Rekening</td>
    <td bgcolor="#89acd8" align="center">Tagihan</td>
    <td bgcolor="#89acd8" align="center">Nopol</td>
    <td bgcolor="#89acd8" align="center">Klien 1</td>
    <td bgcolor="#89acd8" align="center">Klien 2</td>
    <td bgcolor="#89acd8" align="center">Produk</td>
    <td bgcolor="#89acd8" align="center">Phone 1</td>
    <td bgcolor="#89acd8" align="center">Phone 2</td>
    <td bgcolor="#89acd8" align="center">Phone Tagih 1</td>
    <td bgcolor="#89acd8" align="center">Phone Tagih 2</td>
    <td bgcolor="#89acd8" align="center">Nopol Lama</td>


  </tr>
  <? 
  
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["TGLBOOKED"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["CONTROL"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["PERS"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA"><?=$arr["NOREKENINGDEBET"];?></td>
        <td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["NOREKENING"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["TAGIHAN"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["NOPOLBARU1"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["KLIEN1"];?></td>
         <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["KLIEN2"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["KDPRODUK"];?></td>
         <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["PHONETETAP01"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["PHONETETAP02"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["PHONETAGIH01"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["PHONETAGIH02"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 0px solid #D8E1FA; border-bottom: 0px solid #D8E1FA" align="center"><?=$arr["NOPOL"];?></td>
        
        

	<? 
	$i++;

	}
	
	?>
      </tr>
</table>