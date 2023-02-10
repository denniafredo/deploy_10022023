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
	$kantornya = $kantornya == 'KP' && $kdbank=='BTN' ? "'KP', 'KN'" : "'$kantornya'";
	 
	 $sql="SELECT   LPAD (ROWNUM, 3, '0') || satu||LTRIM(REPLACE (
                                 TO_CHAR (ROUND (premitot+decode(kdproduk,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,  /* REQ ARIEF YUSUF TGL 02/05/2014*/
								 										  nilaimeterai), 0),
                                          '099999999999999'),
                                 '.',
                                 ''
                              ))||dua
 								semua
  					FROM   $DBUser.tabel_999_batas_materai z,(  SELECT      (SELECT   RPAD (SUBSTR ( (namaklien1), 1, 17), 17, ' ')
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = nopembayarpremi)
                     || LPAD (norekeningdebet, 19, '0')
                     || LPAD (norekening, 19, '0') satu,
                      ROUND (SUM (premitotal), 0) premitot,        
                      'IFGLIFE'
                     || (prefixpertanggungan || '-' || nopertanggungan)
                     || '/'
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
                        ,
                     RPAD ( (prefixpertanggungan || nopertanggungan), 12, ' ')
                        tiga, kdproduk
              FROM   (SELECT   d.norekening,
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
                                                                   b.nopertanggungan AND tglseatled is null
                                                                   and tglbooked<TO_DATE ('".$month."/".$year."', 'MM/YYYY')),0,
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
                                                'JL2', b.premistd + NVL (
                                                   (SELECT   premi
                                                      FROM   $DBUser.tabel_223_transaksi_produk
                                                     WHERE   prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan
                                                             AND kdbenefit =
                                                                   'BNFTOPUP'),
                                                   0
                                                ),
                                                'JL3', b.premistd + NVL (
                                                   (SELECT   premi
                                                      FROM   $DBUser.tabel_223_transaksi_produk
                                                     WHERE   prefixpertanggungan =
                                                                b.prefixpertanggungan
                                                             AND nopertanggungan =
                                                                   b.nopertanggungan
                                                             AND kdbenefit =
                                                                   'BNFTOPUP'),
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
                                  + 0,
                                  2
                               )
                                  premitotal, kdproduk
                        FROM   $DBUser.tabel_300_historis_premi c,
                               $DBUser.tabel_200_pertanggungan b,
                               $DBUser.tabel_399_bank d,
                               $DBUser.tabel_500_penagih f
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (d.kdbank = b.kdbank)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".
                                //       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))
                               " AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor IN ($kantornya)
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (d.kdbank = '$kdbank')
							   AND c.kdkuitansi <> 'BP3'
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (b.kdstatusfile = '1') ".							  
							   //and b.lockmutasi is null ". //request inkaso proses klaim tidak ditagih
							   " and nvl(b.lockmutasi,0) not in ('06','10','11','18') 
							   AND NOT EXISTS (
					SELECT   'X'
					  FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
					 WHERE       PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
							 AND NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
							 AND TO_DATE (TO_CHAR (SYSDATE, 'DD') || '/".$month."/".$year."', 'DD/MM/YYYY')
							 BETWEEN TGLMULAI AND TGLSELESAI)". //request inkaso proses klaim tidak ditagih
                      " UNION
                      SELECT   d.norekening,
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
                                                                   and tglbooked<TO_DATE ('".$month."/".$year."', 'MM/YYYY')),0,
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
                                  premitotal, kdproduk
                        FROM   $DBUser.tabel_300_historis_rider c,
                               $DBUser.tabel_200_pertanggungan b,
                               $DBUser.tabel_399_bank d,
                               $DBUser.tabel_500_penagih f
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (d.kdbank = b.kdbank)
							   AND (b.kdproduk not in ('JL4B','JL4X','JL4BL'))
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".
                                //       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))
                               " AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor IN ($kantornya)
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (d.kdbank = '$kdbank')
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
							   and b.lockmutasi is null ". //request inkaso proses klaim tidak ditagih
                               " AND (b.kdstatusfile = '1')
							   AND NOT EXISTS (
					SELECT   'X'
					  FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
					 WHERE       PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
							 AND NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
							 AND TO_DATE (TO_CHAR (SYSDATE, 'DD') || '/".$month."/".$year."', 'DD/MM/YYYY')
							 BETWEEN TGLMULAI AND TGLSELESAI))
          GROUP BY   norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,
                     nopembayarpremi, kdproduk) yy
                     where yy.premitot  BETWEEN z.batasbawahpremi AND  z.batasataspremi";
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

