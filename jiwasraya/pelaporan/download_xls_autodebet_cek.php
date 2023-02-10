<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
  $DB1=new database($userid, $passwd, $DBName);
/*
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=autodebet.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
*/
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

	$sql = "select yy.*,yy.premitot,DECODE(KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,z.nilaimeterai) nilaimeterai,
         yy.premitot + DECODE(KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,z.nilaimeterai) premitotal
                                      from $DBUser.tabel_999_batas_materai z, (SELECT norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,
					 sum(XX.premitot) premitot,
					 TO_CHAR(tglbooked,'dd/mm/yyyy') booked,
					 (SELECT   (namaklien1)
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = XX.nopembayarpremi) NAMA,
					 MAX(kdproduk) KDPRODUK,
					 MAX(CARABAYAR) CARABAYAR,
					 (select TO_CHAR(MULAS,'DD/MM/YYYY') from $DBUser.tabel_200_PERTANGGUNGAN where 
            		 prefixpertanggungan = XX.prefixpertanggungan
                     AND nopertanggungan = XX.nopertanggungan) MULAS,
					 max(NOHP) NOHP,
					 max(PHONETETAP01) PHONETETAP01,
                     max(PHONETETAP02) PHONETETAP02,
                     max(PHONETAGIH01) PHONETAGIH01,
                     max(PHONETAGIH02) PHONETAGIH02,
					 (select TO_CHAR(max(tglbooked),'dd/mm/yyyy') from $DBUser.tabel_300_historis_premi where 
            		 prefixpertanggungan = XX.prefixpertanggungan
                     AND nopertanggungan = XX.nopertanggungan and NVL(status,' ') not in ('X') and tglseatled is not null) tgllastpayment,
					 (select premitagihan from $DBUser.tabel_300_historis_rider where 
            		 prefixpertanggungan = XX.prefixpertanggungan
                     AND nopertanggungan = XX.nopertanggungan
                     and to_char(tglbooked,'ddmmyyyy')=to_char(XX.tglbooked,'ddmmyyyy') ) rider FROM (
  			SELECT   NVL(g.NO_PONSEL,g.PHONETETAP02) NOHP, PHONETETAP01,
                             PHONETETAP02,
                             PHONETAGIH01,
                             PHONETAGIH02,
							 (select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=b.kdcarabayar) carabayar, b.kdproduk,d.norekening,
                               b.norekeningdebet,
                               c.prefixpertanggungan,
                               c.nopertanggungan,
                               TRUNC (c.tglbooked) tglbooked,
                               b.nopembayarpremi,
                               ROUND (
                                  (
								  decode((SELECT COUNT(*) FROM $DBUser.TABEL_300_HISTORIS_PREMI WHERE prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan AND tglseatled is null DISINI
                                                                   and tglbooked<TO_DATE ('', 'MM/YYYY')),0,
								  DECODE (
                                      trunc(c.tglbooked,'month'),
                                      TO_DATE ('', 'MM/YYYY'),
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
                                                   'JL2', b.premistd + nvl((select premi from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and kdbenefit='BNFTOPUP'),0),
                                                   'JL3', b.premistd + nvl((select premi from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and kdbenefit='BNFTOPUP'),0),
                                                   c.premitagihan)
                                           / b.indexawal,
                                           2
                                        ),
                                        DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                'JL2', b.premistd + nvl((select premi from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and kdbenefit='BNFTOPUP'),0),
                                                'JL3', b.premistd + nvl((select premi from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and kdbenefit='BNFTOPUP'),0),
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
                                  premitot
                        FROM   $DBUser.tabel_300_historis_premi c,
                               $DBUser.tabel_200_pertanggungan b,
                               $DBUser.tabel_399_bank d,
                               $DBUser.tabel_500_penagih f,
							   $DBUser.tabel_100_klien g
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (d.kdbank = b.kdbank)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/$month/$year', 'DD/MM/YYYY'))".                                
                               " AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (d.kdbank = '$kdbank')
							   AND c.kdkuitansi <> DISINI JUGA 'BP3'
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (b.kdstatusfile = '1')
							   AND b.nopemegangpolis=g.noklien
                      UNION
                      SELECT   NVL(g.NO_PONSEL,g.PHONETETAP02) NOHP, PHONETETAP01,
                             PHONETETAP02,
                             PHONETAGIH01,
                             PHONETAGIH02,
							 (select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=b.kdcarabayar) carabayar, b.kdproduk,d.norekening,
                               b.norekeningdebet,
                               c.prefixpertanggungan,
                               c.nopertanggungan,
                               TRUNC (c.tglbooked) tglbooked,
                               b.nopembayarpremi,
                               ROUND (
                                  (
								  decode((SELECT COUNT(*) FROM $DBUser.TABEL_300_HISTORIS_rider WHERE prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan AND tglseatled is null
                                                                   and tglbooked<TO_DATE ('$month/$year', 'MM/YYYY')),0,
								  DECODE (
                                      trunc(c.tglbooked,'month'),
                                      TO_DATE ('$month/$year', 'MM/YYYY'),
                                      DECODE (KDPRODUK,
                                              (SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK), 1,
                                              0.99),
                                      1
                                   ),1)
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
                               $DBUser.tabel_500_penagih f,
							   $DBUser.tabel_100_klien g
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (d.kdbank = b.kdbank)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/$month/$year', 'DD/MM/YYYY'))".                                
                               " AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (d.kdbank = '$kdbank')
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (b.kdstatusfile = '1')
							   AND b.nopemegangpolis=g.noklien and NVL(premitagihan,0)>0) XX 
							   GROUP BY   norekening,
								 norekeningdebet,
								 prefixpertanggungan,
								 nopertanggungan,
								 tglbooked,
								 nopembayarpremi ) yy
                     where yy.premitot  BETWEEN z.batasbawahpremi AND  z.batasataspremi 
					 AND NOT EXISTS (
SELECT   'X'
  FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
 WHERE       PREFIXPERTANGGUNGAN = YY.PREFIXPERTANGGUNGAN
         AND NOPERTANGGUNGAN = YY.NOPERTANGGUNGAN
         AND TO_DATE (TO_CHAR (SYSDATE, 'DD') || '/12/2016', 'DD/MM/YYYY')
         BETWEEN TGLMULAI AND TGLSELESAI)";
					 //echo "<br />".$sql."<br />";
  	//die;
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	//die;
	$DB->parse($sql);
    $DB->execute();				
	$i = 1;
   	?>
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
    <tr>
    <td bgcolor="#89acd8" align="center">NO.</td>
	<td bgcolor="#89acd8" align="center">NO. POLIS</td>
    <td bgcolor="#89acd8" align="center">MULAS</td>
	<td bgcolor="#89acd8" align="center">PEMBAYARAN TERAKHIR</td>
    <td bgcolor="#89acd8" align="center">PEMEGANG POLIS</td>
    <td bgcolor="#89acd8" align="center">PREMI DITAGIH</td>
    <td bgcolor="#89acd8" align="center">PREMI RIDER</td>
	<td bgcolor="#89acd8" align="center">BULAN BOOKED</td>
    <td bgcolor="#89acd8" align="center">PRODUK</td>
    <td bgcolor="#89acd8" align="center">CB</td>
    <td bgcolor="#89acd8" align="center">BANK</td>
	<td bgcolor="#89acd8" align="center">REKENING</td>
    <td bgcolor="#89acd8" align="center">PHONE01</td>
    <td bgcolor="#89acd8" align="center">PHONE02</td>
    <td bgcolor="#89acd8" align="center">PHONE03</td>
    <td bgcolor="#89acd8" align="center">PHONE04</td>
	<td bgcolor="#89acd8" align="center">HANDPHONE</td>
  	</tr>
	<?
	
	while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
	<?=$i;?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"].'-'.$arr["NOPERTANGGUNGAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["MULAS"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TGLLASTPAYMENT"];?></td>		
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMA"];?></td>
		<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["PREMITOTAL"],2,",",".");?></td>
        <td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["RIDER"],2,",",".");?></td>		
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BOOKED"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDPRODUK"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["CARABAYAR"];?></td>                   
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$namabank;?></td>
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["NOREKENINGDEBET"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["PHONETETAP01"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["PHONETETAP02"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["PHONETAGIH01"];?></td>
        <td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["PHONETAGIH02"];?></td>	
		<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">&nbsp;<?=$arr["NOHP"];?></td>
  </tr>
  <?
	$i++;	}
	?>
	
 </table> 	

</form>

</body>
</html>