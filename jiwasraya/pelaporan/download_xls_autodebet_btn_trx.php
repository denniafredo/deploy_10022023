<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
  $DB1=new database($userid, $passwd, $DBName);
	
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=autodebet_trx.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Daftar Remunerasi</title>
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
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; }
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>

<body topmargin="10">
<? //include "./menu.php"; ?></br></br>




<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">



<? 


function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;

  //MONTH
  echo "<select name=month>\n";
  $i=1;
  $CurrMonth=date("m");
  while ($i <= 12)
       {
  		 				switch($i)
  						{
  							  case 1: $namabulan = "JANUARI"; break;
  								case 2: $namabulan = "PEBRUARI"; break;
									case 3: $namabulan = "MARET"; break;
									case 4: $namabulan = "APRIL"; break;
									case 5: $namabulan = "MEI"; break;
									case 6: $namabulan = "JUNI"; break;
									case 7: $namabulan = "JULI"; break;
									case 8: $namabulan = "AGUSTUS"; break;
  								case 9: $namabulan = "SEPTEMBER"; break;
  								case 10: $namabulan = "OKTOBER"; break;
									case 11: $namabulan = "NOVEMBER"; break;
									case 12: $namabulan = "DESEMBER"; break;
  								default : $namabulan = $i;
  						}
  		 
        If(IsSet($month)) {
           If($month == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulan\n";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan\n";
              }Else {
                 echo "<option value=$i>$namabulan\n";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan\n";
                }Else {
                   echo "<option value=$i selected>$namabulan\n";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan\n";
  							}Else {
                   echo "<option value=$i>$namabulan\n";
                }
              }
              $i++;
        }
  }
    echo "</select>\n";
  
  //YEAR
    echo "<select name=year>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option selected> $i\n";
              }Else {
                 echo "<option> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</select>\n";
    }
  }
  ?>
<?
	if ($kdbank=='MDR') {
		$namabank='AUTO DEBET BANK MANDIRI';
		$namalike='MANDIRI';
	}
	else if ($kdbank=='BNI') {
		$namabank='AUTO DEBET BANK NEGARA INDONESIA (BNI)';
		$namalike='BNI';
	}
	else if ($kdbank=='BRI') {
		$namabank='AUTO DEBET BANK RAKYAT INDONESIA (BRI)';
		$namalike='BNI';
	}

?>
<b>HASIL <?=$namabank;?> <br />BULAN <?=$month."/".$year;?></b>
  <? 

	$sql = "SELECT 
			A.PREFIXPERTANGGUNGAN||'-'||A.NOPERTANGGUNGAN SPAJ_NO,
			NULL CIF,
			A.PREFIXPERTANGGUNGAN||'-'||A.NOPERTANGGUNGAN POL_NO,
			NOREKENINGDEBET ACC_NO,
			NULL TRX_ID,
			NULL TRX_DATE,
			'SUBS' TRX_TP,
			PREMI1 BASIC_PREMIUM,
			NULL TOP_UP_PREMIUM,
			NULL FUND_TRX_AMT,
			NULL RIDER_PREMIUM,
			PREMI1 TOTAL_PREMIUM_PAID,
			NULL FEE_BASE_AMT,
			(SELECT ROUND(KOMISIAGENCB) FROM $DBUser.TABEL_404_TEMP WHERE PREFIXPERTANGGUNGAN=A.PREFIXPERTANGGUNGAN
			AND NOPERTANGGUNGAN=A.NOPERTANGGUNGAN AND KDKOMISIAGEN='36' AND THNKOMISI=
			(FLOOR(MONTHS_BETWEEN(TRUNC(TGLBOOKED,'MONTH'),TRUNC(MULAS,'MONTH'))/12)+1)) FEE_BASE_AMT_IDR,
			to_char(TGLBOOKED,'dd/mm/yyyy') REMARK,
			'APP' TRX_ST,
			A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN NOPERTANGGUNGAN
                        FROM   $DBUser.tabel_300_historis_premi c,
                               $DBUser.tabel_200_pertanggungan a,
                               $DBUser.tabel_399_bank d,
                               $DBUser.tabel_500_penagih f,
							   $DBUser.tabel_100_klien g
                       WHERE   (c.prefixpertanggungan = a.prefixpertanggungan)
                               AND (c.nopertanggungan = a.nopertanggungan)
                               AND (a.nopenagih = f.nopenagih)
                               AND (d.kdbank = a.kdbank)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".
                                //       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))
                               " AND (f.kdrayonpenagih IN
                                          (    
										  SELECT   'KN' kdkantor FROM DUAL UNION
										  SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (d.kdbank = '$kdbank')
							   AND c.kdkuitansi <> 'BP3'
                               AND (a.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (a.kdstatusfile = '1')
							   AND a.nopemegangpolis=g.noklien";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
	//die;
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
   	?>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor='#89acd8' align='center'>SPAJ_NO</td>
	<td bgcolor='#89acd8' align='center'>CIF</td>
	<td bgcolor='#89acd8' align='center'>POL_NO</td>
	<td bgcolor='#89acd8' align='center'>ACC_NO</td>
	<td bgcolor='#89acd8' align='center'>TRX_ID</td>
	<td bgcolor='#89acd8' align='center'>TRX_DATE</td>
	<td bgcolor='#89acd8' align='center'>TRX_TP</td>
	<td bgcolor='#89acd8' align='center'>BASIC_PREMIUM</td>
	<td bgcolor='#89acd8' align='center'>TOP_UP_PREMIUM</td>
	<td bgcolor='#89acd8' align='center'>FUND_TRX_AMT</td>
	<td bgcolor='#89acd8' align='center'>RIDER_PREMIUM</td>
	<td bgcolor='#89acd8' align='center'>TOTAL_PREMIUM_PAID</td>
	<td bgcolor='#89acd8' align='center'>FEE_BASE_AMT</td>
	<td bgcolor='#89acd8' align='center'>FEE_BASE_AMT_IDR</td>
	<td bgcolor='#89acd8' align='center'>REMARK</td>
	<td bgcolor='#89acd8' align='center'>TRX_ST</td>
	<td bgcolor='#89acd8' align='center'>NOPERTANGGUNGAN</td>
  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
	//echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	echo "<tr>";
	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SPAJ_NO"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CIF"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["POL_NO"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["ACC_NO"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TRX_ID"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TRX_DATE"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TRX_TP"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BASIC_PREMIUM"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TOP_UP_PREMIUM"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["FUND_TRX_AMT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["RIDER_PREMIUM"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TOTAL_PREMIUM_PAID"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["FEE_BASE_AMT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["FEE_BASE_AMT_IDR"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["REMARK"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TRX_ST"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOPERTANGGUNGAN"];?></td>
	</tr>
  <?
	$i++;	}
	?>
	
 </table> 	

</form>

</body>
</html>