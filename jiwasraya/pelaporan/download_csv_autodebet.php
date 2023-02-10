<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
  $DB=new database($userid, $passwd, $DBName);
  $DB1=new database($userid, $passwd, $DBName);
	

header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");

ini_set('display_errors',1);
$private=1;
error_reporting(E_ALL ^ E_NOTICE);

$sql = "select yy.*,yy.premitot,DECODE(KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,z.nilaimeterai) nilaimeterai,
         yy.premitot + DECODE(KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_MATERAI WHERE KDPRODUK=YY.KDPRODUK),0,z.nilaimeterai) premitotal
                                      from $DBUser.tabel_999_batas_materai z, (SELECT norekening,
                     norekeningdebet,
                     prefixpertanggungan,
                     nopertanggungan,
                     tglbooked,
					 sum(XX.premitot) premitot,
					 TO_CHAR(tglbooked,'ddmmyy') booked,
					 TO_CHAR(add_months(tglbooked,1),'ddmmyy') bookednext,
					 (SELECT   (namaklien1)
                           FROM   $DBUser.tabel_100_klien
                          WHERE   noklien = XX.nopembayarpremi) NAMA,
					 MAX(kdproduk) KDPRODUK,
					 MAX(CARABAYAR) CARABAYAR,
					 (select TO_CHAR(MULAS,'DD/MM/YYYY') from $DBUser.tabel_200_PERTANGGUNGAN where 
            		 prefixpertanggungan = XX.prefixpertanggungan
                     AND nopertanggungan = XX.nopertanggungan) MULAS,
					 max(PHONETETAP01) PHONETETAP01,
                     max(PHONETETAP02) PHONETETAP02,
                     max(PHONETAGIH01) PHONETAGIH01,
                     max(PHONETAGIH02) PHONETAGIH02,
					 (select premitagihan from $DBUser.tabel_300_historis_rider where 
            		 prefixpertanggungan = XX.prefixpertanggungan
                     AND nopertanggungan = XX.nopertanggungan
                     and to_char(tglbooked,'ddmmyyyy')=to_char(XX.tglbooked,'ddmmyyyy') ) rider,
					 (select noaccount from $DBUser.tabel_100_klien_account WHERE prefixpertanggungan =
                                                                    xx.
                                                                     prefixpertanggungan
                                                                 AND nopertanggungan =
                                                                        xx.
                                                                         nopertanggungan
                                                                         AND kdbank='BCN') MAP FROM (
  			SELECT   PHONETETAP01,
                             PHONETETAP02,
                             PHONETAGIH01,
                             PHONETAGIH02,
							 (select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=b.kdcarabayar) carabayar, b.kdproduk,NULL norekening,
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
                               $DBUser.tabel_500_penagih f,
							   $DBUser.tabel_100_klien g
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".
                                //       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))
                               " AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
							   AND c.kdkuitansi <> 'BP3'
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (b.kdstatusfile = '1')
							   AND b.nopemegangpolis=g.noklien
							   and b.lockmutasi is null ". //request inkaso proses klaim tidak ditagih
                      " UNION
                      SELECT   PHONETETAP01,
                             PHONETETAP02,
                             PHONETAGIH01,
                             PHONETAGIH02,
							 (select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=b.kdcarabayar) carabayar, b.kdproduk,NULL norekening,
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
                                  premitot
                        FROM   $DBUser.tabel_300_historis_rider c,
                               $DBUser.tabel_200_pertanggungan b,
                               $DBUser.tabel_500_penagih f,
							   $DBUser.tabel_100_klien g
                       WHERE   (c.prefixpertanggungan = b.prefixpertanggungan)
                               AND (c.nopertanggungan = b.nopertanggungan)
                               AND (b.nopenagih = f.nopenagih)
                               AND (c.tglbooked <= TO_DATE (to_char(sysdate,'DD')||'/".$month."/".$year."', 'DD/MM/YYYY'))".
                                //       last_day(TO_DATE ('".$month."/".$year."', 'MM/YYYY')))
                               " AND (f.kdrayonpenagih IN
                                          (    SELECT   kdkantor
                                                 FROM   $DBUser.tabel_001_kantor
                                           START WITH   kdkantor = '$kantornya'
                                           CONNECT BY   PRIOR kdkantor =
                                                           kdkantorinduk))
                               AND (b.autodebet = '1')
                               AND (c.tglseatled IS NULL)
                               AND (b.kdstatusfile = '1')
							   and b.lockmutasi is null ". //request inkaso proses klaim tidak ditagih
							   " AND b.nopemegangpolis=g.noklien) XX 
							   GROUP BY   norekening,
								 norekeningdebet,
								 prefixpertanggungan,
								 nopertanggungan,
								 tglbooked,
								 nopembayarpremi ) yy
                     where yy.tglbooked=(select min(tglbooked) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=yy.prefixpertanggungan
					 and nopertanggungan=yy.nopertanggungan and tglseatled is null ) and yy.premitot  BETWEEN z.batasbawahpremi AND  z.batasataspremi  AND NOT EXISTS (
					SELECT   'X'
					  FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
					 WHERE       PREFIXPERTANGGUNGAN = YY.PREFIXPERTANGGUNGAN
							 AND NOPERTANGGUNGAN = YY.NOPERTANGGUNGAN
							 AND TO_DATE (TO_CHAR (SYSDATE, 'DD') || '/".$month."/".$year."', 'DD/MM/YYYY')
							 BETWEEN TGLMULAI AND TGLSELESAI)";
  $kantorcetak=$kantor1;

  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();	

while ($arr=$DB->nextrow()) {
    $result=$arr["MAP"].",".$arr["NAMA"].",".$arr["BOOKED"].",".$arr["BOOKEDNEXT"].",".number_format($arr["PREMITOTAL"],2,".","").",BOOKED ".$arr["BOOKED"]."\n";
    echo $result;
}

   	?>

