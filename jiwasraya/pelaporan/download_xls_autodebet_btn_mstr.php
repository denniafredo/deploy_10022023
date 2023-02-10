<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
  $DB1=new database($userid, $passwd, $DBName);
	
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=autodebet_master.xls" );
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
				 PREFIXPERTANGGUNGAN||'-'||NOPERTANGGUNGAN SPAJ_NO,
				 PREFIXPERTANGGUNGAN||'-'||NOPERTANGGUNGAN POL_NO,
				 NULL CIF,
				 (SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN=A.NOPEMEGANGPOLIS) POL_NM,
				 NOREKENINGDEBET ACC_NO,
				 NULL SLS_CD,
				 NULL BAS_CD,
				 NULL BRC_CD,
				 DECODE(SUBSTR(KDPRODUK,1,3),'JSS','JSA-01','JSP','JSA-02',NULL) PRD_CD,
				 NULL PRG_CD,
				 'IDR' CCY,
				 NULL STA,
				 DECODE(KDCARABAYAR,'1',12,'M',12,'2',4,'Q',4,'3',2,'H',2,'4',1,'A',1,'X',0, NULL) BLL_FRQ,
				 TO_CHAR(TGLREKAM,'DD/MM/YYYY') ENT_DT,
				 (SELECT TO_CHAR(TGLUNDERWRITING,'DD/MM/YYYY') FROM $DBUser.TABEL_214_UNDERWRITING 
				 WHERE PREFIXPERTANGGUNGAN=A.PREFIXPERTANGGUNGAN AND 
				 NOPERTANGGUNGAN=A.NOPERTANGGUNGAN) APV_DT,
				 TO_CHAR(MULAS,'DD/MM/YYYY') REC_DT,
				 TO_CHAR(TGLCETAK,'DD/MM/YYYY') INF_DT,
				  (SELECT TO_CHAR(NVL(TGLBAYAR,TGLSEATLED),'DD/MM/YYYY') FROM $DBUser.TABEL_300_HISTORIS_PREMI 
				 WHERE PREFIXPERTANGGUNGAN=A.PREFIXPERTANGGUNGAN AND 
				 NOPERTANGGUNGAN=A.NOPERTANGGUNGAN AND KDKUITANSI='BP3' AND TGLSEATLED IS NOT NULL)  PTD_DT,
				 NULL SUR_DT,
				 TO_CHAR(EXPIRASI,'DD/MM/YYYY')  COV_DT,
				 NULL NEXT_PMT_DT,
				 NULL LAST_PMT_DT,
				 NULL GRAC_DT,
				 NULL RCV_DT,
				 NULL RCV_NM,
				 JUAMAINPRODUK SUM_INS,
				 PREMI1 PRE_AMT,
				 'D' SRC_DEB,
				 NULL REMARKS
		  FROM   $DBUser.TABEL_200_PERTANGGUNGAN A
		 WHERE   SUBSTR (KDPRODUK, -3) = 'BTN'
		 and KDSTATUSFILE IN ('1','4')";
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
	<td bgcolor='#89acd8' align='center'>POL_NO</td>
	<td bgcolor='#89acd8' align='center'>CIF</td>
	<td bgcolor='#89acd8' align='center'>POL_NM</td>
	<td bgcolor='#89acd8' align='center'>ACC_NO</td>
	<td bgcolor='#89acd8' align='center'>SLS_CD</td>
	<td bgcolor='#89acd8' align='center'>BAS_CD</td>
	<td bgcolor='#89acd8' align='center'>BRC_CD</td>
	<td bgcolor='#89acd8' align='center'>PRD_CD</td>
	<td bgcolor='#89acd8' align='center'>PRG_CD</td>
	<td bgcolor='#89acd8' align='center'>CCY</td>
	<td bgcolor='#89acd8' align='center'>STA</td>
	<td bgcolor='#89acd8' align='center'>BLL_FRQ</td>
	<td bgcolor='#89acd8' align='center'>ENT_DT</td>
	<td bgcolor='#89acd8' align='center'>APV_DT</td>
	<td bgcolor='#89acd8' align='center'>REC_DT</td>
	<td bgcolor='#89acd8' align='center'>INF_DT</td>
	<td bgcolor='#89acd8' align='center'>PTD_DT</td>
	<td bgcolor='#89acd8' align='center'>SUR_DT</td>
	<td bgcolor='#89acd8' align='center'>COV_DT</td>
	<td bgcolor='#89acd8' align='center'>NEXT_PMT_DT</td>
	<td bgcolor='#89acd8' align='center'>LAST_PMT_DT</td>
	<td bgcolor='#89acd8' align='center'>GRAC_DT</td>
	<td bgcolor='#89acd8' align='center'>RCV_DT</td>
	<td bgcolor='#89acd8' align='center'>RCV_NM</td>
	<td bgcolor='#89acd8' align='center'>SUM_INS</td>
	<td bgcolor='#89acd8' align='center'>PRE_AMT</td>
	<td bgcolor='#89acd8' align='center'>SRC_DEB</td>
	<td bgcolor='#89acd8' align='center'>REMARKS</td>

  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
	//echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	echo "<tr>";
	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SPAJ_NO"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["POL_NO"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CIF"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["POL_NM"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["ACC_NO"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SLS_CD"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BAS_CD"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BRC_CD"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PRD_CD"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PRG_CD"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CCY"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["STA"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLL_FRQ"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["ENT_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["APV_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["REC_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["INF_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["PTD_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["SUR_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["COV_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["NEXT_PMT_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["LAST_PMT_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["GRAC_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["RCV_DT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["RCV_NM"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SUM_INS"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PRE_AMT"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SRC_DEB"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["REMARKS"];?></td>


	</tr>
  <?
	$i++;	}
	?>
	
 </table> 	

</form>

</body>
</html>