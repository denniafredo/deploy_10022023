<?  
  	include "../../includes/session.php"; 
  	include "../../includes/starttimer.php"; 
  	include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

	$DB = new Database($userid, $passwd, $DBName);
	$DBX = new Database($userid, $passwd, $DBName);
	$DBN = new Database($userid, $passwd, $DBName);
	$DBcari = new Database($userid, $passwd, $DBName);

	$sqln="SELECT TO_CHAR(TANGGAL,'DD/MM/YYYY') TANGGAL, NOMOR FROM $DBUser.TABEL_999_SURAT_MATERAI WHERE TANGGAL=(SELECT MAX(TANGGAL) FROM $DBUser.TABEL_999_SURAT_MATERAI)";
	$DBN->parse($sqln);
	$DBN->execute();		
	$nomor=$DBN->nextrow();
				//echo $sqlcari;
	$tglmtr=$nomor["TANGGAL"];
	$nomtr=$nomor["NOMOR"];
	
if ($kdbank=='%'){ 
	$kodebank1="";
}
else {
	$kodebank1=" AND b.kdbank = '".$kdbank."' ";
}
if($kdcarabayar=="all")
$carabayar=" ";
else
$carabayar=" AND b.kdcarabayar = '$kdcarabayar' ";

if($kdkantor=="all")
$kodekantor=" ";
else
$kodekantor=" AND f.kdkantor = '$kdkantor' ";

$sql= "SELECT  b.prefixpertanggungan || b.nopertanggungan AS nopol,
           b.nopol AS nopollama,
           DECODE (b.kdvaluta, '3', 'US$', '0', 'Rp', 'Rp') notasivaluta,
           e.namaklien1,c.kdrayonpenagih,
		   b.kdproduk,
           e.alamattagih01,
           e.alamattagih02,
		   (select TO_CHAR (max(tglseatled), 'mm/yyyy') 
           from $DBUser.tabel_300_historis_premi 
           where prefixpertanggungan=b.prefixpertanggungan 
           and nopertanggungan=b.nopertanggungan and tglseatled<=TO_DATE ('".$tglSampai."', 'DD/MM/YYYY')) tglbokees,
           e.kodepostagih, g.NAMABANK,
		   (SELECT   MAX (k.NAMAKOTAMADYA)
                        FROM   $DBUser.TABEL_109_KOTAMADYA k
                       WHERE   k.KDKOTAMADYA = e.KDKOTAMADYATAGIH)
                        AS kodya
			FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
				   $DBUser.TABEL_200_PERTANGGUNGAN b,
				   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
				   $DBUser.TABEL_500_PENAGIH c,
				   $DBUser.TABEL_100_KLIEN e,
				   $DBUser.TABEL_001_KANTOR f, $DBUser.TABEL_399_BANK g
		   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
				   AND b.nopertanggungan = d.nopertanggungan
				   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
				   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
				   AND to_char(a.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
				   AND d.tglseatled BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
				   AND b.nopenagih = c.nopenagih
				   AND e.noklien = b.nopemegangpolis
				   AND c.kdrayonpenagih = f.kdkantor ".$kodekantor." AND b.autodebet = '1' ".$kodebank1." 
				   AND b.kdbank = g.kdbank ".$carabayar." 
		GROUP BY   b.prefixpertanggungan,
				   b.nopertanggungan,
				   b.nopol,
				   b.kdproduk,
				   b.kdvaluta,
				   e.namaklien1,
				   e.alamattagih01,
				   e.alamattagih02,
				   e.kodepostagih, g.namabank,c.kdrayonpenagih, e.KDKOTAMADYATAGIH ";
				   
				  // echo $sql;
				  //die;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style> 
@page { size 8.5in 11in; margin: 2cm } 
div.page { page-break-after: always } 
</style>
<style type="text/css">
<!-- 
body, td, select, input {
 font-family: Verdana;
 font-size: 11px;
} 
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Premium Statement</title>
</head>



<body>


<?
$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
	
	
  	echo "<div class='page'><br /><br /><br />";
	echo " <table border='0' cellpadding='2' cellspacing='1' style='border-collapse: collapse' bordercolor='#CCCCCC' width='100%'>";
	//echo "<tr>";
  	?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <td>Bapak/Ibu</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <td><?=$arr["NAMAKLIEN1"];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <td><?=$arr["ALAMATTAGIH01"];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <td><?=$arr["ALAMATTAGIH02"];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <!--<td><?=$arr["NAMAKOTAMADYA"];?> - <?=$arr["NAMAPROPINSI"];?></td>-->
            <td><?=$arr["KODYA"];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <td><?=$arr["KODEPOSTAGIH"];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>          
		  <tr>            
            <td align="left"><table width="100" border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse">
              
                <td><?php
				echo "<img src='barcode.php?encode=CODE128&bdata=".$arr["NOPOL"]."-".$arr["KDRAYONPENAGIH"]."-".str_replace("/","",$arr["TGLBOKEES"])."&height=40&scale=1&bgcolor=%23FFFFFF&color=%23000000&file=&type=png&Genrate=Submit'>";
				?></td>
                </tr>
				
				
            </table></td>
			<td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>            
            <td>AUTODEBET <?=$arr["NAMABANK"];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>          
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            
            <td colspan="3"><div align="center">LEMBAR PREMIUM STATEMENT</div></td>
            
          </tr>
          
          <tr>
            <td colspan="3">
            <table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%">
              <tr>
                <td align="center" width="28%">TGL. JT.TEMPO TAGIHAN PREMI</td>
                <td align="center" width="18%">TANGGAL TRANSAKSI</td>
                <td align="center" width="33%">KETERANGAN</td>
                <td align="center" width="21%">JUMLAH</td>
              </tr>
              
              <? //==========================
			    $ttltagih=0;
			    $ttldebet=0;
			    $ttlmtr=0;
			    $ttldiskon=0;

				$sqlcari="select count(*) as JUMLAH from $DBUser.tabel_300_historis_rider where prefixpertanggungan||nopertanggungan='".$arr["NOPOL"]."' ".
				"and tglbayar BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')";
				//echo $sqlcari;
				$DBX->parse($sqlcari);
    			$DBX->execute();		
				$cari=$DBX->nextrow();
				//echo $sqlcari;
				//echo $cari["JUMLAH"];
				//die;

				if ($cari["JUMLAH"] == 0) 
				{
					if($kdkantor== 'all'){
						$sqlx= "SELECT  to_char(sysdate,'DD/MM/YYYY') cetak,b.prefixpertanggungan||b.nopertanggungan as nopol, b.nopol as nopollama,
						 to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,
						 to_char(d.tglseatled,'DD/MM/YYYY') tglseat,
						  decode(d.tglseatled,null,d.premitagihan,'0') as tunggakan,     
						 to_char(a.tglrekam,'DD/MM/YYYY') tglpendebetan,
						 decode(b.kdvaluta,'1',d.premitagihan,'0',
									ROUND(ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam)),2),2),
									d.premitagihan * (SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam))) premitagihannya,                                                              
						  TO_NUMBER(a.jumlahtagihan)/100 AS jmltagihanpremi,
						  decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(SUBSTR(b.KDPRODUK,1,3),'JL2',0,'JL3',0,'JL4',0,'JSS',0,1)*
						   decode(b.kdvaluta,'1',d.premitagihan,'0',
									ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam)),2),
									d.premitagihan * (SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') discount,
						  d.status,
						  (SELECT kurs  FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam)) kursrekam,
						  b.kdvaluta, d.premitagihan as premiasli,d.premitagihan,b.indexawal,
						  decode(b.kdvaluta,'3','US$','0','Rp','Rp') notasivaluta,
						 (SELECT decode(substr(b.kdproduk,1,4),'JL4B',0,nilaimeterai)nilaimeterai FROM $DBUser.TABEL_999_batas_materai 
								  /*WHERE TO_NUMBER(a.jumlahtagihan)/100 BETWEEN batasbawahpremi AND batasataspremi ) AS materai,*/
								  WHERE (d.premitagihan + NVL(g.premitagihan,0)) BETWEEN batasbawahpremi AND batasataspremi ) AS materai,
						 (SELECT nilaimeterai FROM $DBUser.TABEL_999_batas_materai 							
							  WHERE (d.premitagihan ) BETWEEN batasbawahpremi AND batasataspremi ) AS materaijl4b,		  
						 e.namaklien1, e.alamattagih01, e.alamattagih02,e.kodepostagih, 
						 (SELECT k.NAMAKOTAMADYA FROM $DBUser.TABEL_109_KOTAMADYA k WHERE k.KDKOTAMADYA = e.KDKOTAMADYATAGIH) as kodya,
						  f.NAMAKANTOR, f.ALAMAT01, f.ALAMAT02,f.PHONE01,f.PHONE02,f.PHONE03,f.PHONE04,f.WEBSITE,
						  (SELECT NAMABANK FROM $DBUser.TABEL_399_BANK WHERE KDBANK = B.KDBANK) NAMA_BANK,
							 (SELECT NAMABANK FROM $DBUser.TABEL_399_NICK_BANK WHERE KDBANK = B.KDBANK) NICK_NAMA_BANK
							FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
								   $DBUser.TABEL_200_PERTANGGUNGAN b,
								   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
								   $DBUser.TABEL_500_PENAGIH c,
								   $DBUser.TABEL_100_KLIEN e,
								   $DBUser.TABEL_001_KANTOR f
						   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
								   AND b.nopertanggungan = d.nopertanggungan
								   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
								   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
								   AND to_char(a.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
								   /*AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')*/
								   AND d.tglseatled BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
								   AND b.nopenagih = c.nopenagih
								   AND e.noklien = b.nopembayarpremi
								   AND c.kdrayonpenagih = f.kdkantor
								   AND f.kdkantor = (SELECT KDRAYONPENAGIH FROM $DBUser.TABEL_500_PENAGIH WHERE NOPENAGIH =  c.nopenagih)
								   AND b.autodebet = '1' ".$kodebank1." 
								   AND a.nopolis='".$arr["NOPOL"]."'
						ORDER BY nopol,d.tglbooked";
					}
					else
					{
						$sqlx= "SELECT  to_char(sysdate,'DD/MM/YYYY') cetak,b.prefixpertanggungan||b.nopertanggungan as nopol, b.nopol as nopollama,
						 to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,
						 to_char(d.tglseatled,'DD/MM/YYYY') tglseat,
						  decode(d.tglseatled,null,d.premitagihan,'0') as tunggakan,     
						 to_char(a.tglrekam,'DD/MM/YYYY') tglpendebetan,
						 decode(b.kdvaluta,'1',d.premitagihan,'0',
									ROUND(ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam)),2),2),
									d.premitagihan * (SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam))) premitagihannya,                                                              
						  TO_NUMBER(a.jumlahtagihan)/100 AS jmltagihanpremi,
						  decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(b.KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK),0,1)*
						   decode(b.kdvaluta,'1',d.premitagihan,'0',
									ROUND(d.premitagihan/b.indexawal,2) * ROUND((SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam)),2),
									d.premitagihan * (SELECT kurs 
														   FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') discount,
						  d.status,
						  (SELECT kurs  FROM $DBUser.TABEL_999_kurs_transaksi x 
														WHERE x.kdvaluta = b.kdvaluta
													   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																					FROM $DBUser.TABEL_999_kurs_transaksi y
																			   WHERE x.kdvaluta = y.kdvaluta 
																				 AND y.tglkursberlaku <= a.tglrekam)) kursrekam,
						  b.kdvaluta, d.premitagihan as premiasli,d.premitagihan,b.indexawal,
						  decode(b.kdvaluta,'3','US$','0','Rp','Rp') notasivaluta,
						 (SELECT decode(substr(b.kdproduk,1,4),'JL4B',0,nilaimeterai)nilaimeterai FROM $DBUser.TABEL_999_batas_materai 
								  /*WHERE TO_NUMBER(a.jumlahtagihan)/100 BETWEEN batasbawahpremi AND batasataspremi ) AS materai,*/
								  WHERE (d.premitagihan) BETWEEN batasbawahpremi AND batasataspremi ) AS materai,
						 (SELECT nilaimeterai FROM $DBUser.TABEL_999_batas_materai 							
							  WHERE (d.premitagihan ) BETWEEN batasbawahpremi AND batasataspremi ) AS materaijl4b, 		  
						 e.namaklien1, e.alamattagih01, e.alamattagih02,e.kodepostagih, 
						 (SELECT k.NAMAKOTAMADYA FROM $DBUser.TABEL_109_KOTAMADYA k WHERE k.KDKOTAMADYA = e.KDKOTAMADYATAGIH) as kodya,
						  f.NAMAKANTOR, f.ALAMAT01, f.ALAMAT02,f.PHONE01,f.PHONE02,f.PHONE03,f.PHONE04,f.WEBSITE,
						  (SELECT NAMABANK FROM $DBUser.TABEL_399_BANK WHERE KDBANK = B.KDBANK) NAMA_BANK,
							 (SELECT NAMABANK FROM $DBUser.TABEL_399_NICK_BANK WHERE KDBANK = B.KDBANK) NICK_NAMA_BANK
							FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
								   $DBUser.TABEL_200_PERTANGGUNGAN b,
								   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
								   $DBUser.TABEL_500_PENAGIH c,
								   $DBUser.TABEL_100_KLIEN e,
								   $DBUser.TABEL_001_KANTOR f
						   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
								   AND b.nopertanggungan = d.nopertanggungan
								   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
								   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
								   AND to_char(a.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
								   /*AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')*/
								   AND d.tglseatled BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
								   AND b.nopenagih = c.nopenagih
								   AND e.noklien = b.nopembayarpremi
								   AND c.kdrayonpenagih = f.kdkantor
								   AND f.kdkantor = '$kdkantor'								   
								   AND b.autodebet = '1' ".$kodebank1." 
								   AND a.nopolis='".$arr["NOPOL"]."'
						ORDER BY nopol,d.tglbooked";
					}

				}
				else
				{
					if($kdkantor== 'all'){
					$sqlx= "SELECT  to_char(sysdate,'DD/MM/YYYY') cetak,b.prefixpertanggungan||b.nopertanggungan as nopol, b.nopol as nopollama,
					 to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,
					 to_char(d.tglseatled,'DD/MM/YYYY') tglseat,
					  decode(d.tglseatled,null,(d.premitagihan + NVL(g.premitagihan,0)),'0') as tunggakan,     
					 to_char(a.tglrekam,'DD/MM/YYYY') tglpendebetan,
					 decode(b.kdvaluta,'1',(d.premitagihan + NVL(g.premitagihan,0)),'0',
								ROUND(ROUND((d.premitagihan + NVL(g.premitagihan,0))/b.indexawal,2) * ROUND((SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam)),2),2),
								(d.premitagihan + NVL(g.premitagihan,0)) * (SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam))) premitagihannya,                                                              
					  TO_NUMBER(a.jumlahtagihan)/100 AS jmltagihanpremi,
					  decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(b.KDPRODUK,(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK),0,1)*
					   decode(b.kdvaluta,'1',(d.premitagihan + NVL(g.premitagihan,0)),'0',
								ROUND((d.premitagihan + NVL(g.premitagihan,0))/b.indexawal,2) * ROUND((SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam)),2),
								(d.premitagihan + NVL(g.premitagihan,0)) * (SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') discount,
					  d.status,
					  (SELECT kurs  FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam)) kursrekam,
					  b.kdvaluta, (d.premitagihan + NVL(g.premitagihan,0)) as premiasli,(d.premitagihan + NVL(g.premitagihan,0)) as premitagihan,b.indexawal,
					  decode(b.kdvaluta,'3','US$','0','Rp','Rp') notasivaluta,
					 (SELECT decode(substr(b.kdproduk,1,4),'JL4B',0,nilaimeterai)nilaimeterai FROM $DBUser.TABEL_999_batas_materai 
							  /*WHERE TO_NUMBER(a.jumlahtagihan)/100 BETWEEN batasbawahpremi AND batasataspremi ) AS materai,*/
							  WHERE (d.premitagihan + NVL(g.premitagihan,0)) BETWEEN batasbawahpremi AND batasataspremi ) AS materai,
					 (SELECT nilaimeterai FROM $DBUser.TABEL_999_batas_materai 							
							  WHERE (d.premitagihan + NVL(g.premitagihan,0)) BETWEEN batasbawahpremi AND batasataspremi ) AS materaijl4b, 		  
					 e.namaklien1, e.alamattagih01, e.alamattagih02,e.kodepostagih, 
					 (SELECT k.NAMAKOTAMADYA FROM $DBUser.TABEL_109_KOTAMADYA k WHERE k.KDKOTAMADYA = e.KDKOTAMADYATAGIH) as kodya,
					  f.NAMAKANTOR, f.ALAMAT01, f.ALAMAT02,f.PHONE01,f.PHONE02,f.PHONE03,f.PHONE04,f.WEBSITE,
					  (SELECT NAMABANK FROM $DBUser.TABEL_399_BANK WHERE KDBANK = B.KDBANK) NAMA_BANK,
						 (SELECT NAMABANK FROM $DBUser.TABEL_399_NICK_BANK WHERE KDBANK = B.KDBANK) NICK_NAMA_BANK
						FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
							   $DBUser.TABEL_300_HISTORIS_RIDER g,
							   $DBUser.TABEL_200_PERTANGGUNGAN b,
							   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
							   $DBUser.TABEL_500_PENAGIH c,
							   $DBUser.TABEL_100_KLIEN e,
							   $DBUser.TABEL_001_KANTOR f
					   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
							   AND b.nopertanggungan = d.nopertanggungan
							   AND g.prefixpertanggungan = d.prefixpertanggungan
							   AND g.nopertanggungan = d.nopertanggungan
							   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
							   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
							   AND to_char(a.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
							   AND to_char(g.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
							   /*AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')*/
							   AND d.tglseatled BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
							   AND b.nopenagih = c.nopenagih
							   AND e.noklien = b.nopembayarpremi
							   AND c.kdrayonpenagih = f.kdkantor
							   AND f.kdkantor = (SELECT KDRAYONPENAGIH FROM $DBUser.TABEL_500_PENAGIH WHERE NOPENAGIH =  c.nopenagih)
							   AND b.autodebet = '1' ".$kodebank1." 
							   AND a.nopolis='".$arr["NOPOL"]."'
					ORDER BY nopol,d.tglbooked"; } else {
					$sqlx= "SELECT  to_char(sysdate,'DD/MM/YYYY') cetak,b.prefixpertanggungan||b.nopertanggungan as nopol, b.nopol as nopollama,
					 to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,
					 to_char(d.tglseatled,'DD/MM/YYYY') tglseat,
					  decode(d.tglseatled,null,(d.premitagihan + NVL(g.premitagihan,0)),'0') as tunggakan,     
					 to_char(a.tglrekam,'DD/MM/YYYY') tglpendebetan,
					 decode(b.kdvaluta,'1',(d.premitagihan + NVL(g.premitagihan,0)),'0',
								ROUND(ROUND((d.premitagihan + NVL(g.premitagihan,0))/b.indexawal,2) * ROUND((SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam)),2),2),
								(d.premitagihan + NVL(g.premitagihan,0)) * (SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam))) premitagihannya,                                                              
					  TO_NUMBER(a.jumlahtagihan)/100 AS jmltagihanpremi,
					  decode(to_char(a.tglbooked,'MM/YYYY'),to_char(a.tglrekam,'MM/YYYY'),DECODE(SUBSTR(b.KDPRODUK,1,3),'JL2',0,'JL3',0,'JL4',0,'JSS',0,1)*
					   decode(b.kdvaluta,'1',(d.premitagihan + NVL(g.premitagihan,0)),'0',
								ROUND((d.premitagihan + NVL(g.premitagihan,0))/b.indexawal,2) * ROUND((SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam)),2),
								(d.premitagihan + NVL(g.premitagihan,0)) * (SELECT kurs 
													   FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam))) /100,'0') discount,
					  d.status,
					  (SELECT kurs  FROM $DBUser.TABEL_999_kurs_transaksi x 
													WHERE x.kdvaluta = b.kdvaluta
												   AND x.tglkursberlaku = (SELECT max(y.tglkursberlaku) 
																				FROM $DBUser.TABEL_999_kurs_transaksi y
																		   WHERE x.kdvaluta = y.kdvaluta 
																			 AND y.tglkursberlaku <= a.tglrekam)) kursrekam,
					  b.kdvaluta, (d.premitagihan + NVL(g.premitagihan,0)) as premiasli,(d.premitagihan + NVL(g.premitagihan,0)) as premitagihan,b.indexawal,
					  decode(b.kdvaluta,'3','US$','0','Rp','Rp') notasivaluta,
					 (SELECT decode(substr(b.kdproduk,1,4),'JL4B',0,nilaimeterai)nilaimeterai FROM $DBUser.TABEL_999_batas_materai 
							/*  WHERE TO_NUMBER(a.jumlahtagihan)/100 BETWEEN batasbawahpremi AND batasataspremi ) AS materai,*/
							  WHERE (d.premitagihan + NVL(g.premitagihan,0)) BETWEEN batasbawahpremi AND batasataspremi ) AS materai,
					 (SELECT nilaimeterai FROM $DBUser.TABEL_999_batas_materai 							
							  WHERE (d.premitagihan + NVL(g.premitagihan,0)) BETWEEN batasbawahpremi AND batasataspremi ) AS materaijl4b, 		  
					 e.namaklien1, e.alamattagih01, e.alamattagih02,e.kodepostagih, 
					 (SELECT k.NAMAKOTAMADYA FROM $DBUser.TABEL_109_KOTAMADYA k WHERE k.KDKOTAMADYA = e.KDKOTAMADYATAGIH) as kodya,
					  f.NAMAKANTOR, f.ALAMAT01, f.ALAMAT02,f.PHONE01,f.PHONE02,f.PHONE03,f.PHONE04,f.WEBSITE,
					  (SELECT NAMABANK FROM $DBUser.TABEL_399_BANK WHERE KDBANK = B.KDBANK) NAMA_BANK,
						 (SELECT NAMABANK FROM $DBUser.TABEL_399_NICK_BANK WHERE KDBANK = B.KDBANK) NICK_NAMA_BANK
						FROM   $DBUser.TABEL_300_HISTORIS_PREMI d,
							   $DBUser.TABEL_300_HISTORIS_RIDER g,
							   $DBUser.TABEL_200_PERTANGGUNGAN b,
							   $DBUser.TABEL_315_PELUNASAN_AUTO_DEBET a,
							   $DBUser.TABEL_500_PENAGIH c,
							   $DBUser.TABEL_100_KLIEN e,
							   $DBUser.TABEL_001_KANTOR f
					   WHERE       b.prefixpertanggungan = d.prefixpertanggungan
							   AND b.nopertanggungan = d.nopertanggungan
							   AND g.prefixpertanggungan = d.prefixpertanggungan
							   AND g.nopertanggungan = d.nopertanggungan
							   AND b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
							   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
							   AND to_char(a.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
							   AND to_char(g.tglbooked,'mmyyyy') = to_char(d.tglbooked,'mmyyyy')
							   /*AND d.tglbooked BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')*/
							   AND d.tglseatled BETWEEN to_date('".$tglDari."','DD/MM/YYYY') AND to_date('".$tglSampai."','DD/MM/YYYY')
							   AND b.nopenagih = c.nopenagih
							   AND e.noklien = b.nopembayarpremi
							   AND c.kdrayonpenagih = f.kdkantor
							   AND f.kdkantor = '$kdkantor'
							   AND b.autodebet = '1' ".$kodebank1." 
							   AND a.nopolis='".$arr["NOPOL"]."'
					ORDER BY nopol,d.tglbooked";}
				}
				//echo $sqlx.'<BR><BR>';
              //die;
			  //===============
			 	$DBX->parse($sqlx);
    			$DBX->execute();		
			  while ($arx=$DBX->nextrow()) {
			  ?>
              <tr>
                <td align="center"><?=$arx["TGLBOOKED"];?></td>
                <td>&nbsp;</td>
                <td>Tagihan Premi</td>
                <td align="right"><?=number_format($arx["PREMITAGIHANNYA"],2,',','.');?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="center"><?=$arx["TGLPENDEBETAN"];?></td>
                <td>Lunas Premi Autodebet <?=$arx["NICK_NAMA_BANK"];?></td>
                <!--<td align="right"><?=number_format($arx["PREMITAGIHANNYA"]-$arx["DISCOUNT"],2,',','.');?></td>-->
                <td align="right"><?=number_format($arx["JMLTAGIHANPREMI"]-$arx["MATERAI"],2,',','.');?></td>
                <!--td align="right"><?=number_format($arx["JMLTAGIHANPREMI"],2,',','.');?></td-->
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="center"><?=$arx["TGLPENDEBETAN"];?></td>
                <td>Bea Meterai Lunas</td>
                <td align="right"><?
				if(substr($arr["KDPRODUK"],0,4)=="JL4B")
					echo number_format(0,2,',','.');
				else
					echo number_format($arx["MATERAI"],2,',','.');
				?></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="center"><?=$arx["TGLPENDEBETAN"];?></td>
                <td>Discount Premi</td>
                <td align="right"><?=number_format($arx["DISCOUNT"],2,',','.');?></td>
                <?  
				//$diskon=$arx["PREMITAGIHANNYA"]-($arx["JMLTAGIHANPREMI"]-$arx["MATERAI"]);
				$diskon=$arx["DISCOUNT"];
				?>
                <!--td align="right"><?=number_format($diskon,2,',','.');?></td-->
              </tr>
              <?
			  $ttltagih=$ttltagih+$arx["PREMITAGIHANNYA"];
			  //$ttldebet=$ttldebet +( $arx["PREMITAGIHANNYA"]-$arx["DISCOUNT"]);
			  $ttldebet=$ttldebet + ($arx["JMLTAGIHANPREMI"]-$arx["MATERAI"]);
			  if(substr($arr["KDPRODUK"],0,4)=="JL4B"){
				$ttlmtrjl4b=$ttlmtr +( $arx["MATERAIJL4B"]);
				$ttlmtr=$ttlmtr +( $arx["MATERAI"]);
			  }
			  else					
				$ttlmtr=$ttlmtr +( $arx["MATERAI"]);
			  //$ttldiskon=$ttldiskon +( $arx["DISCOUNT"]);
			  $ttldiskon=$ttldiskon+$diskon;
			  $tglcetak=$arx["CETAK"];
			  //echo $ttldiskon;
              }
			  ?>
              
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="3"><div align="center">RINGKASAN AUTODEBET</div></td>
          </tr>
         
          <tr>
            <td colspan="3">
            <table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%">
              <tr>
                <td align="center" width="12%" rowspan="2">JUMLAH</td>
                <td align="center" width="16%">TAGIHAN PREMI</td>
                <td align="center" width="16%">LUNAS PREMI AUTODEBET</td>
                <td align="center" width="17%">BEA METERAI LUNAS</td>
                <td align="center" width="17%">DISCOUNT PREMI 1%</td>
                <td align="center" width="22%">PREMI TERTUNGGAK</td>
              </tr>
              <tr>
                <td align="center"><?=number_format($ttltagih,2,',','.');?></td>
                <td align="center"><?=number_format($ttldebet,2,',','.');?></td>
                <td align="center"><?=number_format($ttlmtr,2,',','.');?></td>
                <td align="center"><?=number_format($ttldiskon,2,',','.');?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" rowspan="2">Discount premi sebesar 1% tidak berlaku untuk produk JS Link, Siharta, Arthadana dan premi yang tertunggak</td>
                <td align="center">TOTAL LUNAS AUTODEBET</td>
              </tr>
              <tr>
                <td align="center"><?=number_format($ttldebet+$ttlmtr,2,',','.');?></td>
              </tr>
              <tr>
                <td colspan="6">Premium Statement ini adalah bukti pembayaran yang sah dan tidak memerlukan tanda tangan karena diproses secara otomatis</td>     
              </tr>
              
            </table></td>
          </tr>
           <tr><td colspan="3">&nbsp;</td></tr>
          <tr>
            
            <td align="left"><table width="200" border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse">
              <tr>
                <td><div align="center">BEA METERAI LUNAS</div></td>
                </tr>
              <tr>
                <td><div align="center">
				  <?php
				   if(substr($arr["KDPRODUK"],0,4)=="JL4B")
					   echo number_format($ttlmtrjl4b,2,',','.');
				   else
					   echo number_format($ttlmtr,2,',','.');
				   ?>
                </div></td>
                </tr>
            </table></td>
            <td>&nbsp;</td>
            <td align="right">
            <table width="200" border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse">
              <tr>
                <td><div align="center">TANGGAL CETAK</div></td>
                </tr>
              <tr>
                <td><div align="center"><?=$tglcetak;?></div></td>
                </tr>
            </table>
            </td>
            <td>&nbsp;</td>
          </tr>
		  <tr><td>
		  <p style="font-size:0.08in;">IJIN PEMBUBUHAN TANDA BEA METERAI LUNAS</br> DENGAN SISTEM KOMPUTERISASI</br>
		  NOMOR : <?=$nomtr;?></br>TANGGAL : <?=$tglmtr;?></br>Dari : DIREKTUR JENDERAL PAJAK</p>
		  </td>
		  <td> </td><td> </td>
		  </tr>
          <tr>
            <td colspan="3"><div align="justify"><ul><li>Untuk keperluan pengiriman premium statement, jika ada perubahan alamat diharapkan dapat menginformasikan kepada Call Center PT Asuransi Jiwa IFG</li>
              <li>Keterangan lebih lanjut tentang pelunasan premi hubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151, atau kirimkan surat ke :
            Customer Service, Jl. Ir. H. Juanda No. 34 Jakarta, E-mail : asuransi@ifg-life.co.id</li>
            </ul></td>
            </div>
          </tr>

    <?
	//echo "</tr>";
	echo "</table>"; 
	echo "</div>";
	$i++;
	}?>

</body>
</html>
