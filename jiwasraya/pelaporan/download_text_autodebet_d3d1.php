<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  $DB=new database($userid, $passwd, $DBName);
  $DB1=new database($userid, $passwd, $DBName);
/*
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=remunerasi agen.doc" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");*/
			
  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Daftar Autodebet</title>
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
<body>
Daftar Autodebet<br>
<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=FileText.txt'>[unduh klik disini]</a><br />
<table>
<?
$sql="SELECT      satu
         || LPAD (ROWNUM, 5, '0')
         || dua
         || LPAD (ROWNUM, 5, '0')
         || tiga semua
  FROM   (  SELECT      '99102'
                     || 'IFGLIFE '
                     || LPAD (norekeningdebet, 19, '0')
                     || LPAD (norekening, 19, '0')
                     || LTRIM(REPLACE (
                                 TO_CHAR (SUM (premitotal),
                                          '099999999999999.00'),
                                 '.',
                                 ''
                              ))
                        satu,
                     RPAD ( (prefixpertanggungan || nopertanggungan), 12, ' ')
                     || TO_CHAR (tglbooked, 'MMYYYY')
                     || (SELECT   RPAD (SUBSTR ( (namaklien1), 1, 17), 17, ' ')
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = nopembayarpremi)
                        dua,
                     RPAD ( (prefixpertanggungan || nopertanggungan), 12, ' ')
                     || TO_CHAR (tglbooked, 'MMYYYY')
                     || (SELECT   RPAD (SUBSTR ( (namaklien1), 1, 17), 17, ' ')
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = nopembayarpremi)
                        tiga
              FROM   (SELECT   d.norekening,
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
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                   'JL3', b.premistd + nvl((select sum(premi) from $DBUser.tabel_223_transaksi_produk where
												   prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan
												   and (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),0),
                                                   c.premitagihan)
                                           / b.indexawal,
                                           2
                                        ),
                                        DECODE (SUBSTR (KDPRODUK, 1, 3),
                                                'JL2', b.premistd + NVL (
                                                   (SELECT   sum(premi)
                                                      FROM   $DBUser.tabel_223_transaksi_produk
                                                     WHERE   prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan
                                                             AND (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),
                                                   0
                                                ),
                                                'JL3', b.premistd + NVL (
                                                   (SELECT   sum(premi)
                                                      FROM   $DBUser.tabel_223_transaksi_produk
                                                     WHERE   prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan
                                                             AND (kdbenefit='BNFTOPUP' or (kdjenisbenefit='R' or status not in ('X')))),
                                                   0
                                                ),
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
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (b.kdstatusfile = '1')
                      )
          GROUP BY   norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,
                     nopembayarpremi)";
	 //echo $sql;
	 $DB->parse($sql);
	 $DB->execute();
	 
	 $myFile = "../file/files/FileText.txt";
	 $fh = fopen($myFile, 'w') or die("can't open file");
	
	 while($arr=$DB->nextrow()){
	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	 $stringData = $arr["SEMUA"]."\r\n";
	 fwrite($fh, $stringData);
	 ?>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["SEMUA"];?></td>
  </tr>
  <?
	 }
	 fclose($fh);
?>
</table><br>
<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=FileText.txt'>[unduh klik disini]</a>
</body>
</html>

