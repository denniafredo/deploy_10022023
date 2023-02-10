<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
			
  function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 

					/*echo "<option value=05>05</option>";
					echo "<option value=15>15</option>";
					echo "<option value=25>25</option>";*/
          //for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          //{ 
		  /*		$currentDay=05;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 
			  $currentDay=15;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 	
			  $currentDay=25;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 							
          //} 

          print("</select>"); */
		  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
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
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
  }
?>
<script language="JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('getpremi', true);
 }
 else
 {
 checkedAll('getpremi', false);
 }
} 
</script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
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
<div id="filterbox">



<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">

  <table>
	<tr>
  <td>
  <?
	if ($kdbank=='MDR'){
		$selbank1="selected";
		$selbank2="";
		$selbank3="";
	}
	else if ($kdbank=='BNI'){
		$selbank1="";
		$selbank2="selected";
		$selbank3="";
	}
	else if ($kdbank=='BRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="selected";
	}	
?>
  Nama Bank
	<select name="kdbank">
	  <option value="MDR" <?=$selbank1;?>>MANDIRI</option>
		<option value="BNI" <?=$selbank2;?>>BNI</option>
        <option value="BRI" <?=$selbank3;?>>BRI</option>
        <option value="CTB" <? if ($kdbank=="CTB") {echo "selected";} else { echo "";}?>>CITIBANK 1BILL</option>
        <option value="CBN" <? if ($kdbank=="CBN") {echo "selected";} else { echo "";}?>>BNI CREDIT CARD</option>
	</select>
  </td>
  <td>Pilih Kantor : <select name="kantornya" size="1" onChange="GantiCari(document.getpremi)">
  <option value="KP">SELURUH KANTOR</option>
    <? 
  $conn=ocilogon($DBUser, $DBPass, $DBName);  
  $sqlktr1="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantorinduk like '%A' order by kdkantor ASC";
  $sqlktr=ociparse($conn,$sqlktr1);
  ociexecute($sqlktr);
  while(ocifetch($sqlktr)){
  //$DB->parse($sqlktr);
  //$DB->execute();				
   //	while ($arrktr=$DB->nextrow()) {
   if(ociresult($sqlktr,"KDKANTOR")==$kantornya)
   {
	echo "<option value=".ociresult($sqlktr,"KDKANTOR")." selected>".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
	else
	{
	echo "<option value=".ociresult($sqlktr,"KDKANTOR").">".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
   }
  ?>
  </select>
    <?
  //echo $sqlktr;	
?></td>
  <td>
  
  Bulan Booked
  <?  ShowFromDate(10,"Past"); ?>  </td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"></input></td>
 
 </tr>
</table>
<!--</form>-->

</div>
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

  $sql = "SELECT norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,sum(XX.premitotal) premitotal,TO_CHAR(tglbooked,'mm/yyyy') booked,(SELECT   (namaklien1)
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = XX.nopembayarpremi) NAMA FROM (
  			SELECT   d.norekening,
                               b.norekeningdebet,
                               c.prefixpertanggungan,
                               c.nopertanggungan,
                               TRUNC (c.tglbooked) tglbooked,
                               b.nopembayarpremi,
                               ROUND (
                                  (DECODE (
                                      c.tglbooked,
                                      TO_DATE ('".$month."/".$year."', 'MM/YYYY'),
                                      DECODE (SUBSTR (KDPRODUK, 1, 3),
                                              'JL2', 1,
                                              'JL3', 1,
                                              0.99),
                                      1
                                   )
                                   * DECODE (
                                        b.kdvaluta,
                                        '0',
                                        ROUND (
                                           DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                   'JL2', b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' and status not in ('X')))),0),
                                                   'JL3', b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' and status not in ('X')))),0),
                                                   c.premitagihan)
                                           / b.indexawal,
                                           2
                                        ),
                                        DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                'JL2', b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                'JL3', b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                c.premitagihan)
                                     )
                                   * (SELECT   kurs
                                        FROM   $DBUser.tabel_999_kurs_transaksi x
                                       WHERE   x.kdvaluta = b.kdvaluta
                                               AND x.tglkursberlaku =
                                                     (SELECT   MAX(tglkursberlaku)
                                                        FROM   $DBUser.tabel_999_kurs_transaksi y
                                                       WHERE   x.kdvaluta =
                                                                  y.kdvaluta
                                                               AND y.tglkursberlaku <=
                                                                     SYSDATE)))
                                  + (SELECT   z.nilaimeterai
                                       FROM   $DBUser.tabel_999_batas_materai z
                                      WHERE   DECODE (
                                                 c.tglbooked,
                                                 TO_DATE ('".$month."/".$year."',
                                                          'MM/YYYY'),
                                                 DECODE (
                                                    SUBSTR (KDPRODUK, 1, 3),
                                                    'JL2',
                                                    1,
                                                    'JL3',
                                                    1,
                                                    0.99
                                                 ),
                                                 1
                                              )
                                              * DECODE (
                                                   b.kdvaluta,
                                                   '0',
                                                   ROUND (
                                                      DECODE (
                                                         SUBSTR (KDPRODUK,
                                                                 1,
                                                                 3),
                                                         'JL2',
                                                         b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                         'JL3',
                                                         b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                         c.premitagihan
                                                      )
                                                      / b.indexawal,
                                                      2
                                                   ),
                                                   DECODE (
                                                      SUBSTR (KDPRODUK, 1, 3),
                                                      'JL2',
                                                      b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                      'JL3',
                                                      b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                      c.premitagihan
                                                   )
                                                )
                                              * (SELECT   kurs
                                                   FROM   $DBUser.tabel_999_kurs_transaksi x
                                                  WHERE   x.kdvaluta =
                                                             b.kdvaluta
                                                          AND x.tglkursberlaku =
                                                                (SELECT   MAX(tglkursberlaku)
                                                                   FROM   $DBUser.tabel_999_kurs_transaksi y
                                                                  WHERE   x.kdvaluta =
                                                                             y.kdvaluta
                                                                          AND y.tglkursberlaku <=
                                                                                SYSDATE)) BETWEEN z.batasbawahpremi
                                                                                              AND  z.batasataspremi),
                                  2
                               )
                                  premitotal
                        FROM   $DBUser.tabel_300_historis_premi c,
                               $DBUser.tabel_200_pertanggungan b,
                               $DBUser.tabel_399_bank d,
                               $DBUser.tabel_500_penagih f
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (d.kdbank = b.kdbank)
                               AND (c.tglbooked <=
                                       TO_DATE ('".$month."/".$year."', 'MM/YYYY'))
                               AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (d.kdbank = '$kdbank')
                               AND (b.autodebet = '1') ".
                               " AND (c.tglseatled IS NULL) ".
                               " AND (b.kdstatusfile = '1')) XX GROUP BY   norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,
                     nopembayarpremi";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
   	?>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NO. POLIS</td>
    <td bgcolor="#89acd8" align="center">PEMEGANG POLIS</td>
    <td bgcolor="#89acd8" align="center">PREMI</td>
	<td bgcolor="#89acd8" align="center">BULAN BOOKED</td>
    <td bgcolor="#89acd8" align="center">BANK</td>
	    <td bgcolor="#89acd8" align="center">REKENING</td>
  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"].'-'.$arr["NOPERTANGGUNGAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMA"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["PREMITOTAL"],2,",",".");?></td>	
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BOOKED"];?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$namabank;?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOREKENINGDEBET"];?></td>		
  </tr>
  <?
	$i++;	}
	?>
	
 </table> 	

</form>
<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a> | <a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet_bni.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel (BNI/BRI)</a> |<a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet_d3d1.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text</a>|<a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet_bni_d3d1.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text (BNI/BRI)</a>

</body>
</html>