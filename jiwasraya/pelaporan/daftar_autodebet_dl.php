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
          print("<SELECT name=" . $inName .  "tgl>\n"); 

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

          print("</SELECT>"); */
		  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</SELECT>"); 

  
     // Bulan	
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<SELECT name=" . $inName .  "bln>\n"); 
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
          print("</SELECT>"); 
  
  		// Tahun				
  		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<SELECT name=" . $inName .  "thn>\n"); 
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
  				print("</SELECT>"); 
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
SELECT			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
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
		$selbank4="";
	}
	else if ($kdbank=='VBN'){
		$selbank1="";
		$selbank2="";
		$selbank3="";
		$selbank4="selected";
	}
	else if ($kdbank=='BNI'){
		$selbank1="";
		$selbank2="selected";
		$selbank3="";
		$selbank4="";
	}
	else if ($kdbank=='BRI'){
		$selbank1="";
		$selbank2="";
		$selbank3="selected";
		$selbank4="";
	}	
?>
  Nama Bank
	<SELECT name="kdbank">
	  <option value="MDR" <?=$selbank1;?>>MANDIRI</option>
		<option value="BNI" <?=$selbank2;?>>BNI</option>
        <option value="BRI" <?=$selbank3;?>>BRI</option>
        <option value="VBN" <?=$selbank4;?>>BNI VA</option>
        <option value="CTB" <? if ($kdbank=="CTB") {echo "selected";} else { echo "";}?>>CITIBANK 1BILL</option>
        <option value="CBN" <? if ($kdbank=="CBN") {echo "selected";} else { echo "";}?>>BNI CREDIT CARD</option>
        <option value="BTN" <? if ($kdbank=="BTN") {echo "selected";} else { echo "";}?>>BTN</option>
		<option value="BPK" <? if ($kdbank=="BPK") {echo "selected";} else { echo "";}?>>BPD KALBAR</option>
		<!--<option value="BCN" <? if ($kdbank=="BCN") {echo "selected";} else { echo "";}?>>CIMB NIAGA VA</option>-->
	</SELECT>
  </td>
  <td>Pilih Kantor : <SELECT name="kantornya" size="1" onChange="GantiCari(document.getpremi)">
  <option value="KP">SELURUH KANTOR</option>
    <? 
  $conn=ocilogon($DBUser, $DBPass, $DBName);  
  $sqlktr1="SELECT kdkantor,namakantor FROM $DBUser.tabel_001_kantor WHERE kdkantorinduk like '%A' order by kdkantor ASC";
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
  </SELECT>
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
  echo "<SELECT name=month>\n";
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
    echo "</SELECT>\n";
  
  //YEAR
    echo "<SELECT name=year>\n";
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
         echo "</SELECT>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</SELECT>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</SELECT>\n";
    }
  }
  ?>
<?
	if ($kdbank=='MDR') {
		$namabank='AUTO DEBET BANK MANDIRI';
		$namalike='MANDIRI';
	}
	else if ($kdbank=='VBN') {
		$namabank='BNI VA';
		$namalike='BNI';
	}
	else if ($kdbank=='BNI') {
		$namabank='AUTO DEBET BANK NEGARA INDONESIA (BNI)';
		$namalike='BNI';
	}
	else if ($kdbank=='BTN') {
		$namabank='AUTO DEBET BANK TABUNGAN NEGARA (BTN)';
		$namalike='BTN';
	}
	else if ($kdbank=='BRI') {
		$namabank='AUTO DEBET BANK RAKYAT INDONESIA (BRI)';
		$namalike='BNI';
	}
	else if ($kdbank=='BPK') {
		$namabank='AUTO DEBET BPD KALBAR';
		$namalike='BPK';
	}
	else if ($kdbank=='BCN') {
		$namabank='CIMB NIAGA VA';
		$namalike='BCN';
	}

?>
<b>HASIL <?=$namabank;?> <br />BULAN <?=$month."/".$year;?></b>
  <? 
	$kantornyabu = $kantornya;
	$kantornya = $kantornya == 'KP' && $kdbank=='BTN' ? "'KP', 'KN'" : "'$kantornya'";
	
  /*$sql = "SELECT 	 kdbank,
					 norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,sum(XX.premitotal) premitotal,TO_CHAR(tglbooked,'mm/yyyy') booked,(SELECT   (namaklien1)
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = XX.nopembayarpremi) NAMA,
					(SELECT premitagihan FROM $DBUser.tabel_300_historis_rider WHERE 
            		 prefixpertanggungan = XX.prefixpertanggungan
                     AND nopertanggungan = XX.nopertanggungan
                     AND to_char(tglbooked,'ddmmyyyy')=to_char(XX.tglbooked,'ddmmyyyy') ) rider FROM (
  			SELECT   		   d.kdbank,	
							   d.norekening,
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
                                                   'JL2', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                   'JL3', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                   c.premitagihan)
                                           / b.indexawal,
                                           2
                                        ),
                                        DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                'JL2', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                'JL3', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
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
                                                         b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                         'JL3',
                                                         b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                         c.premitagihan
                                                      )
                                                      / b.indexawal,
                                                      2
                                                   ),
                                                   DECODE (
                                                      SUBSTR (KDPRODUK, 1, 3),
                                                      'JL2',
                                                      b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                      'JL3',
                                                      b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
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
                               " AND (b.kdstatusfile = '1')
                      UNION
                      SELECT   d.kdbank,
							   d.norekening,
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
                                        ROUND (c.premitagihan / b.indexawal, 2),
                                        c.premitagihan
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
                                                      c.premitagihan
                                                      / b.indexawal,
                                                      2
                                                   ),
                                                   c.premitagihan
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
                        FROM   $DBUser.tabel_300_historis_rider c,
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
                               " AND (b.kdstatusfile = '1')) XX GROUP BY  
								kdbank, 
								norekening,
								norekeningdebet,
								prefixpertanggungan,
								nopertanggungan,
								tglbooked,
								nopembayarpremi";*/
					 
					 $sql = " SELECT yy.*/*,yy.premitot*/,
                      (SELECT P.KETERANGAN 
                        FROM $DBUser.TABEL_500_PENAGIH_GANTI  P
                        WHERE P.PREFIXPERTANGGUNGAN = YY.PREFIXPERTANGGUNGAN
                            AND P.NOPERTANGGUNGAN = YY.NOPERTANGGUNGAN
                            AND P.KDBANK = 'MDR'
                            AND P.NOREKENINGDEBET = YY.NOREKENINGDEBET
                            AND P.STATUS = '1'
                            AND P.TGLUPDATED = (SELECT MAX(TGLUPDATED) 
                                                  FROM $DBUser.TABEL_500_PENAGIH_GANTI 
                                                  WHERE PREFIXPERTANGGUNGAN = YY.PREFIXPERTANGGUNGAN
                                                    AND NOPERTANGGUNGAN = YY.NOPERTANGGUNGAN
                                                    AND KDBANK = 'MDR'
                                                    AND NOREKENINGDEBET = YY.NOREKENINGDEBET
                                                    AND STATUS = '1'
                                                )
                        ) PEMILIK_REKENING,
                      DECODE(KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,z.nilaimeterai) nilaimeterai,
					            yy.premitot + DECODE(KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,z.nilaimeterai) premitotal,
                      (SELECT NOPOLBARU FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = yy.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = yy.NOPERTANGGUNGAN)NOPOLBARU,
                      (SELECT B.EMAILTAGIH 
                        FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        INNER JOIN $DBUser.TABEL_100_KLIEN B ON A.NOPEMEGANGPOLIS = B.NOKLIEN
                        WHERE A.PREFIXPERTANGGUNGAN = yy.PREFIXPERTANGGUNGAN 
                          AND A.NOPERTANGGUNGAN = yy.NOPERTANGGUNGAN) EMAILTAGIH
                    FROM $DBUser.tabel_999_batas_materai z, 
                      (SELECT MAX(MULAS) MULAS,
                          XX.KDPRODUK,
                          norekening,
                          norekeningdebet,
                          adaklaim,
                          prefixpertanggungan,
                          nopertanggungan,
                          (SELECT TO_CHAR(max(tglbooked),'dd/mm/yyyy') 
                            FROM $DBUser.tabel_300_historis_premi 
                            WHERE prefixpertanggungan = XX.prefixpertanggungan
                              AND nopertanggungan = XX.nopertanggungan 
                              AND tglseatled is not null
                          ) tgllastpayment,					 
                          tglbooked,
                          sum(XX.premitotal) premitot,
                          TO_CHAR(tglbooked,'dd/mm/yyyy') booked,
                          (SELECT   (namaklien1)
                             FROM   $DBUser.tabel_100_klien
                             WHERE   noklien = XX.nopembayarpremi
                          ) NAMA,
                          (SELECT premitagihan 
                            FROM $DBUser.tabel_300_historis_rider 
                            WHERE prefixpertanggungan = XX.prefixpertanggungan
                              AND nopertanggungan = XX.nopertanggungan
                              AND to_char(tglbooked,'ddmmyyyy')=to_char(XX.tglbooked,'ddmmyyyy') 
                          ) rider,
                          (SELECT KETERANGAN 
                            FROM $DBUser.TABEL_100_KLIEN_ACCOUNT 
                            WHERE prefixpertanggungan = XX.prefixpertanggungan
                              AND nopertanggungan = XX.nopertanggungan
                              AND JENIS='CC' AND ROWNUM = 1
                          ) CARDHOLDER,
                          (SELECT KDBANK 
                            FROM $DBUser.TABEL_100_KLIEN_ACCOUNT 
                            WHERE prefixpertanggungan = XX.prefixpertanggungan
                              AND nopertanggungan = XX.nopertanggungan
                              AND JENIS='CC' 
                              AND ROWNUM = 1
                          ) BANKPENERBIT,
                          (SELECT noaccount 
                            FROM $DBUser.TABEL_100_KLIEN_ACCOUNT 
                            WHERE prefixpertanggungan = XX.prefixpertanggungan
                              AND nopertanggungan = XX.nopertanggungan
                              AND JENIS='CC' AND ROWNUM = 1
                          ) NOCC,
                          /*
                          (SELECT TO_CHAR(TGLEXPIRASI,'DD/MM/YYYY') 
                            FROM $DBUser.TABEL_100_KLIEN_ACCOUNT 
                            WHERE prefixpertanggungan = XX.prefixpertanggungan 
                              AND nopertanggungan = XX.nopertanggungan 
                              AND JENIS='CC' AND ROWNUM = 1
                          ) EXP
                          */
                          (SELECT TO_CHAR (max(TGLEXPIRASI), 'DD/MM/YYYY')
                            FROM $DBUser.TABEL_100_KLIEN_ACCOUNT
                            WHERE prefixpertanggungan = XX.prefixpertanggungan
                              AND nopertanggungan = XX.nopertanggungan
                              AND JENIS = 'CC'
                          ) EXP
                      FROM (
                          SELECT TO_CHAR(B.MULAS,'DD/MM/YYYY') MULAS, 
                              KDPRODUK, 
                              d.norekening,
                              b.norekeningdebet,
                              (SELECT count(*) 
                                FROM $DBUser.tabel_901_pengajuan_klaim 
                                WHERE prefixpertanggungan=b.prefixpertanggungan 
                                  AND nopertanggungan=b.nopertanggungan 
                                  AND status in ('1','2')
                              ) adaklaim,
                              c.prefixpertanggungan,
                              c.nopertanggungan,
                              TRUNC (c.tglbooked) tglbooked,
                              b.nopembayarpremi,
                              ROUND (
                                (decode((SELECT COUNT(*) FROM $DBUser.TABEL_300_HISTORIS_PREMI WHERE prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan = b.nopertanggungan AND tglseatled is null 
															 AND tglbooked < TO_DATE ('".$month."/".$year."', 'MM/YYYY')),0,
								  DECODE (
                                      trunc(c.tglbooked,'month'),
                                      TO_DATE ('".$month."/".$year."', 'MM/YYYY'),
                                      DECODE (KDPRODUK,
                                              (SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK), 1,
                                              0.99),
                                      1
                                   ),1)
                                   * DECODE (
                                        b.kdvaluta,
                                        '0',
                                        ROUND (
                                           DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                   'JL2', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                   'JL3', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                   c.premitagihan)
                                           / b.indexawal,
                                           2
                                        ),
                                        DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                'JL2', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
                                                'JL3', b.premistd + nvl((SELECT premi FROM $DBUser.tabel_223_transaksi_produk WHERE
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   AND kdbenefit='BNFTOPUP'),0),
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
                                  + 0,
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
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".
                                /*       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))*/
                               
                               /*" AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor IN ($kantornya)
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                                */
                               "AND (d.kdbank = '$kdbank')
							   AND c.kdkuitansi <> 'BP3'
                               AND (b.autodebet = '1') ".
                               " AND (c.tglseatled IS NULL) ".
                               " AND (b.kdstatusfile = '1')
                      UNION
                      SELECT   TO_CHAR(B.MULAS,'DD/MM/YYYY') MULAS, KDPRODUK, d.norekening,
                               b.norekeningdebet,
							   (SELECT count(*) FROM $DBUser.tabel_901_pengajuan_klaim WHERE prefixpertanggungan=b.prefixpertanggungan AND nopertanggungan=b.nopertanggungan AND status in ('1','2')) adaklaim,
                               c.prefixpertanggungan,
                               c.nopertanggungan,
                               TRUNC (c.tglbooked) tglbooked,
                               b.nopembayarpremi,
                               ROUND (
                                  (
								  decode((SELECT COUNT(*) FROM $DBUser.TABEL_300_HISTORIS_RIDER WHERE prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan AND tglseatled is null
                                                                   AND tglbooked < TO_DATE ('".$month."/".$year."', 'MM/YYYY')),0,
								  DECODE (
                                      trunc(c.tglbooked,'month'),
                                      TO_DATE ('".$month."/".$year."', 'MM/YYYY'),
                                      DECODE (KDPRODUK,
                                              (SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK), 1,
                                              0.99),
                                      1
                                   ),1)
                                   * DECODE (
                                        b.kdvaluta,
                                        '0',
                                        ROUND (c.premitagihan / b.indexawal, 2),
                                        c.premitagihan
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
                                  + 0,
                                  2
                               )
                                  premitot
                        FROM   $DBUser.tabel_300_historis_rider c,
                               $DBUser.tabel_200_pertanggungan b,
                               $DBUser.tabel_399_bank d,
                               $DBUser.tabel_500_penagih f
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (d.kdbank = b.kdbank)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".							   
                                //       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))
                               
                               /*" AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor IN ($kantornya)
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
								*/

                               " AND (d.kdbank = '$kdbank')
                               AND (b.autodebet = '1') ".
                               " AND (c.tglseatled IS NULL) ".
                               " AND (b.kdstatusfile = '1')  AND NVL(premitagihan,0)>0) XX GROUP BY   KDPRODUK, norekening,
                     norekeningdebet,
					 adaklaim,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,
                     nopembayarpremi) yy
                     WHERE yy.premitot  BETWEEN z.batasbawahpremi AND  z.batasataspremi 
					 AND NOT EXISTS (
					SELECT   'X'
					  FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
					 WHERE       PREFIXPERTANGGUNGAN = YY.PREFIXPERTANGGUNGAN
							 AND NOPERTANGGUNGAN = YY.NOPERTANGGUNGAN
							 AND TO_DATE (TO_CHAR (SYSDATE, 'DD') || '/".$month."/".$year."', 'DD/MM/YYYY')							 
							 BETWEEN TGLMULAI AND TGLSELESAI)";
	$kantorcetak=$kantor1;

	if ($kdbank=='BPK') {
		$sql = "SELECT * FROM ( ".$sql." ) WHERE kdproduk NOT like 'JL%'";
	}
	
  	// echo "<br />".$sql."<br />";
	//die;
  	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
   	?>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
      <td bgcolor="#89acd8" align="center">NO.</td>
      <td bgcolor="#89acd8" align="center">NO. KARTU</td>
      <td bgcolor="#89acd8" align="center">BANK PENERBIT</td>
      <td bgcolor="#89acd8" align="center">PEMEGANG KARTU</td>
      <td bgcolor="#89acd8" align="center">EXP. CARD</td>
      <td bgcolor="#89acd8" align="center">NO. POLIS (LAMA)</td>
      <td bgcolor="#89acd8" align="center">NO. POLIS (BARU)</td>
      <td bgcolor="#89acd8" align="center">MULAS</td>
      <td bgcolor="#89acd8" align="center">PEMBAYARAN TERAKHIR</td>
      <td bgcolor="#89acd8" align="center">PEMEGANG POLIS</td>
      <td bgcolor="#89acd8" align="center">NAMA PEMILIK REKENING</td>
      <td bgcolor="#89acd8" align="center">EMAIL</td>
      <td bgcolor="#89acd8" align="center">PREMI DITAGIH</td>
      <td bgcolor="#89acd8" align="center">RIDER</td>
      <td bgcolor="#89acd8" align="center">BULAN BOOKED</td>
      <td bgcolor="#89acd8" align="center">BANK</td>
      <td bgcolor="#89acd8" align="center">REKENING</td>
      <td bgcolor="#89acd8" align="center">EXPIRED</td>
      <td bgcolor="#89acd8" align="center">CARD HOLDER</td>
  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
		if($arr["ADAKLAIM"]==0){
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
      <?=$i;?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["NOREKENINGDEBET"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["BANKPENERBIT"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CARDHOLDER"];?> </td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["EXP"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"].'-'.$arr["NOPERTANGGUNGAN"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOPOLBARU"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["MULAS"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLLASTPAYMENT"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMA"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PEMILIK_REKENING"];?></td>
      <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["EMAILTAGIH"];?></td>
      <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["PREMITOTAL"],2,",",".");?></td>
      <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["RIDER"],2,",",".");?></td>		
      <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BOOKED"];?></td>
      <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$namabank;?></td>
      <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOREKENINGDEBET"];?></td>
      <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["EXP"].$arr["KDPRODUK"];?></td>
      <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?
		#----------------------------[ START CARD HOLDER ]----------------------------
	if(($arr["CARDHOLDER"])== ''){
			 	echo "<font color=red><a href=\"#\" onclick=\"NewWindow('./updatecc.php?ccn=".$arr["NOREKENINGDEBET"]."&pfx=".$arr["PREFIXPERTANGGUNGAN"]."&np=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">UPDATE CARDHOLDER</a></font>";  
				//echo 'kampret';
			 } else {
			 echo "<font color=red><a href=\"#\" onclick=\"NewWindow('./updatecc.php?ccn=".$arr["NOREKENINGDEBET"]."&pfx=".$arr["PREFIXPERTANGGUNGAN"]."&np=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["CARDHOLDER"]."</a></font>"; 
			 
				//echo 'kampret ok';
			 }
	#----------------------------[ END CARD HOLDER ]----------------------------
		?></td>		
  </tr>
  <?
	$i++;	
		}else{
			
		}
	}
	?>
	
 </table> 	

</form>
<?php $kantornya = $kantornyabu; ?>
<a href="#" class="verdana8blu" onClick="NewWindow('download_csv_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Download ke Csv</a>|
<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Download ke Excel</a>|
<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet_cek.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Download ke Excel cek</a>|
<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_cc.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Download ke Excel Credit Card</a>|
<!--| <a href="#" class="verdana8blu" onClick="NewWindow('download_xls_autodebet_bni.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Download ke Excel (BNI/BRI)</a>--> 
<a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text (MDR)</a>|
<a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet_bni.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text (BNI/BRI)</a>|
<a href="#" class="verdana8blu" onClick="NewWindow('download_text_autodebet_btn.php?month=<?=$month;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',700,250,1);">Download ke Text (BTN)</a>
</body>
</html>