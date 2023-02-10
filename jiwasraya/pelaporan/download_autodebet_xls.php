<?  
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=virtual_account.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");	
  
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


 //echo "PERIODE AKSEPTASI ".$tglDari." s/d ".$tglSampai."<br><br>";
	 // echo $sql;				
?>

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