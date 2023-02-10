<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/kantor.php";
include "../../includes/klien.php";
	
$DB=new database($userid, $passwd, $DBName);
$DBA=new database($userid, $passwd, $DBName);
$KTR=new Kantor($userid,$passwd,$kdkantor);
function DateSelector($inName, $useDate=0) 
{ 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  
      		// Tanggal
      		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Info Pelunasan Unit Link</title>
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

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
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
</head>
<?
	if ($mode=='print'){
		echo "<body onload=\"window.print();window.close()\">";
//		echo "<body>";
	}
	else{
		echo "<body>";
?>

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
  <table>
	<tr>
  <td>Pemb.</td>
	<td>
	  <? 
		switch($metodebayar)
		{
		  case 'MDR': $sa = "selected"; break;
		  case 'BNI': $sb = "selected"; break;
		  case 'CBN': $sn = "selected"; break;
		  case 'BRI': $sr = "selected"; break;
			case 'CTB': $sc = "selected"; break;
			case 'POS': $sd = "selected"; break;
			case 'THO': $st = "selected"; break;
			default : $sx = "selected"; break;
		}
		?>
	  <select name="metodebayar">
      <option value="CBN" <?=$sn;?>>Credit Card BNI</option>
		<option value="CTB" <?=$sc;?>>Credit Card Citibank</option>
	</select></td>

  <!--td>Pemb.</td>
	<td>
	  <? 
		switch($metodebayar)
		{
		  case 'MDR': $sa = "selected"; break;
		  case 'BNI': $sb = "selected"; break;
		  case 'CBN': $sn = "selected"; break;
		  case 'BRI': $sr = "selected"; break;
			case 'CTB': $sc = "selected"; break;
			case 'POS': $sd = "selected"; break;
			case 'THO': $st = "selected"; break;
			default : $sx = "selected"; break;
		}
		?>
	  <select name="metodebayar">
	  <option value="MDR" <?=$sa;?>>Auto Debet Mandiri</option>
	  <option value="BNI" <?=$sb;?>>Auto Debet BNI</option>
      <option value="BRI" <?=$sr;?>>Auto Debet BRI</option>
      <option value="CBN" <?=$sn;?>>Credit Card BNI</option>
		<option value="CTB" <?=$sc;?>>Credit Card Citibank</option>
		<option value="POS" <?=$sd;?>>PT. POS INDONESIA</option>
		<option value="THO" <?=$st;?>>Transfer Tunai Rek. HO</option>
	</select></td-->
	
	<!--td>Kantor</td>
	<td><select name="kdkantor">
  			<?
  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
  			     		 "order by kdkantor";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
      					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
  					}
  			?>
				<option value="ALL"<?=(($_POST['kdkantor']=='ALL') ? ' selected' : '');?>>--ALL--</option>
 </select>
 </td-->
 </tr>
 <tr>
 <td>Dari</td><td><?=DateSelector("d"); ?></td><td>Sampai</td><td><?=DateSelector("s"); ?></td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<?
}
?>

<?
	$tglawal .= $dthn;
	$tglawal .= ((strlen($dbln)==1) ? '0'.$dbln : $dbln);
	$tglawal .= ((strlen($dtgl)==1) ? '0'.$dtgl : $dtgl);
	
	$tglakhir .= $sthn;
	$tglakhir .= ((strlen($sbln)==1) ? '0'.$sbln : $sbln);
	$tglakhir .= ((strlen($stgl)==1) ? '0'.$stgl : $stgl);

//	$tglawal	=	$_POST['dthn'] . 
//					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) .
//					( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] );
//	$tglakhir	=	$_POST['sthn'] . 
//					( (strlen($_POST['sbln'])==1) ? '0'.$_POST['sbln'] : $_POST['sbln'] ) .
//					( (strlen($_POST['stgl'])==1) ? '0'.$_POST['stgl'] : $_POST['stgl'] );
	//echo '<hr />'. $tglawal . ' - '.$tglakhir.'<hr />';
	if($metodebayar=="MDR"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
	} elseif($metodebayar=="BNI"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BNI";
		 $titletrans		= "AUTO DEBET BNI";
    } elseif($metodebayar=="BRI"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BRI";
		 $titletrans		= "AUTO DEBET BRI";
    } elseif($metodebayar=="CBN"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "CBN";
		 $titletrans		= "CREDIT CARD BNI";
	} elseif($metodebayar=="CTB"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "CITIBANK";
		 $titletrans		= "CITIBANK 1BILL";
	} elseif($metodebayar=="POS"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "VIA PT. POS INDONESIA"; 
	} elseif($metodebayar=="BMRI"){
	   $filterperiode = "to_char(a.entry_time,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "H2H MANDIRI";
	} elseif($metodebayar=="BBRI"){
	   $filterperiode = "to_char(a.entry_time,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "H2H BRI";	
	} elseif($metodebayar=="BIMA"){
	   $filterperiode = "to_char(a.entry_time,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "H2H Bimasakti";
	}
	else {
	   $filterperiode = "to_char(a.tglseatled,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
	   $filterpenagih = "TRANSFER";
		 $titletrans		= "TRANSFER REK. HO";
	}

  if($kdkantor=="ALL"){
		  $filterkantor = "";
	}	else	{
		  $filterkantor = "c.kdrayonpenagih='$kdkantor' and ";
	}
?>
<b>DAFTAR TRANSAKSI JS LINK (<?=$produk;?>) <?=$titletrans;?><br /> </b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center" rowspan="2">NO</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Cabas</td>
		<td bgcolor="#89acd8" align="center" rowspan="2">No. Polis</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Nama Pemb. Polis</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Bulan Tagihan</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">No.Rekening</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">OB/NB</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Jml.Premi /Top-Up</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Rider</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">Discount</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Materai</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Total Debet</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Tgl Bayar</td>
		<td bgcolor="#89acd8" align="center" colspan="3">Komisi Penutupan</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Nama Penutup</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Rayon Penagih</td>
  </tr>
	<tr>
    <td bgcolor="#89acd8" align="center">TH.1</td>
    <td bgcolor="#89acd8" align="center">TH.2</td>
    <td bgcolor="#89acd8" align="center">TH.3</td>
  </tr>
	<? 
	/*if($metodebayar=="MDR" || $metodebayar=="BNI"  || $metodebayar=="BRI" || $metodebayar=="CBN" || $metodebayar=="CTB" || $metodebayar=="POS"){*/
	  if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA"){
	  $sql = "SELECT   KODEKANTOR KDRAYONPENAGIH,
				 PREFIXPERTANGGUNGAN,
				 NOPERTANGGUNGAN,
				 KDVALUTA,
				 TGLBUK,
				 KDKUITANSI,
				 DECODE (KDVALUTA,
						 '0', ROUND (premitagihan / indexawal, 2),
						 PREMITAGIHAN)
				 * KURS
					PREMITAGIHAN,
				 KDREKENINGLAWAN,
				 JMLPREMI,
				 NOURUT,
				 NO_POLIS NOPOLIS,
				 BLNTAGIHAN,
				 NOKONTROL,
				 NOREKDEBET,
				 NOREKKREDIT,
				 STATUSPEMBAYARAN,
				 BERITAKREDIT,
				 entry_time TGLREKAM,
				 TGLBAYAR,
				 TGLUPDATED,
				 BLNBAYAR,
				 BLNBAYARNYA,
				 NOPENAGIH,
				 NOAGEN,
				 NOREKENINGDEBET,
				 NAMAKLIEN,
				 THNKOMISI,
				 KOMISIAGEN,
				 NAMAAGEN,
				 KDCABAS,
				 (SELECT   0
					FROM   $DBUser.tabel_999_batas_materai
				   WHERE   (SELECT   CASE
										WHEN ( (SUBSTR (20130401, 1, 4) * 12
												+ SUBSTR (20130401, 5, 2))
											  - (TO_CHAR (g.mulas, 'YYYY') * 12
												 + TO_CHAR (g.mulas, 'MM'))) <= 60
										THEN
										   (DECODE (KDVALUTA,
													'0',
													ROUND (g.premi1 / indexawal, 2),
													g.premi1)
											* KURS)
										ELSE
										   (DECODE (KDVALUTA,
													'0',
													ROUND (g.premi2 / indexawal, 2),
													g.premi2)
											* KURS)
									 END
										AS premi
							  FROM   $DBUser.tabel_200_pertanggungan g
							 WHERE   prefixpertanggungan = zz.prefixpertanggungan
									 AND nopertanggungan = zz.nopertanggungan)
						   - DECODE (disco, NULL, '0', disco)
						   + DECODE (
								(SELECT   premitagihan
								   FROM   $DBUser.tabel_300_historis_rider
								  WHERE   prefixpertanggungan =
											 zz.prefixpertanggungan
										  AND nopertanggungan = zz.nopertanggungan
										  AND TO_CHAR (tglbooked, 'ddmmyyyy') =
												TO_CHAR (zz.tglbuk, 'ddmmyyyy')
										  AND buktisetor = zz.buktistr),
								NULL,
								'0',
								(SELECT   premitagihan
								   FROM   $DBUser.tabel_300_historis_rider
								  WHERE   prefixpertanggungan =
											 zz.prefixpertanggungan
										  AND nopertanggungan = zz.nopertanggungan
										  AND TO_CHAR (tglbooked, 'ddmmyyyy') =
												TO_CHAR (zz.tglbuk, 'ddmmyyyy')
										  AND buktisetor = zz.buktistr)
							 ) BETWEEN batasbawahpremi
								   AND  batasataspremi)
					matere,
				 (SELECT   premitagihan
					FROM   $DBUser.tabel_300_historis_rider
				   WHERE   prefixpertanggungan = zz.prefixpertanggungan
						   AND nopertanggungan = zz.nopertanggungan
						   AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								 TO_CHAR (zz.tglbuk, 'ddmmyyyy')
						   AND buktisetor = zz.buktistr)
					rider
		  FROM   (  SELECT   c.kdrayonpenagih AS kodekantor,
							 (SELECT   namakantor
								FROM   $DBUser.tabel_001_kantor
							   WHERE   kdkantor = c.kdrayonpenagih)
								AS namakantor,
							 b.prefixpertanggungan,
							 b.nopertanggungan,
							 b.kdvaluta,
							 b.indexawal,
							 d.tglbooked AS tglbuk,
							 d.buktisetor AS buktistr,
							 d.kdkuitansi,
							 d.premitagihan,
							 d.kdrekeninglawan,
							 '148090000' AS kodeakun,
							 (SELECT   nama
								FROM   $DBUser.tabel_802_kodeakun
							   WHERE   akun = '148090000')
								AS namaakunperantara,
							 TO_NUMBER (a.bill_amount) / 1 AS jmlpremi,
							 a.no_polis,
							 TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
							 null nokontrol,
							 null norekdebet,
							 null norekkredit,
							 void statuspembayaran,
							 null nourut,
							 (SELECT   namaklien1
								FROM   $DBUser.tabel_100_klien
							   WHERE   noklien = b.nopembayarpremi)
								AS namaklien,
							 (SELECT   phonetetap01
								FROM   $DBUser.tabel_100_klien
							   WHERE   noklien = b.nopembayarpremi)
								AS telp1,
							 (SELECT   phonetetap02
								FROM   $DBUser.tabel_100_klien
							   WHERE   noklien = b.nopembayarpremi)
								AS telp2,
							 null beritakredit,
							 a.entry_time,
							 TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
							 a.entry_time tglupdated,
							 TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
							 TO_CHAR (d.tglbayar, 'YYYYMM') AS BLNBAYARNYA,
							 b.nopenagih,
							 b.noagen,
							 b.norekeningdebet,
							 CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12)
								AS thnkomisi,
							 (SELECT   komisiagencb
								FROM   $DBUser.tabel_404_temp
							   WHERE   prefixpertanggungan = b.prefixpertanggungan
									   AND nopertanggungan = b.nopertanggungan
									   AND thnkomisi =
											 CEIL(MONTHS_BETWEEN (a.entry_time,
																  b.mulas)
												  / 12)
									   AND kdkomisiagen = '01')
								komisiagen,
							 (SELECT   kurs
								FROM   $DBUser.tabel_999_kurs_transaksi
							   WHERE   tglkursberlaku =
										  (SELECT   MAX (tglkursberlaku)
											 FROM   $DBUser.tabel_999_kurs_transaksi
											WHERE   tglkursberlaku <= a.entry_time
													AND kdvaluta = b.kdvaluta)
									   AND kdvaluta = b.kdvaluta)
								kurs,
							 (SELECT   namaklien1
								FROM   $DBUser.tabel_100_klien
							   WHERE   noklien = b.noagen)
								AS namaagen,
							 e.kdcabas,
							 (SELECT   nilaimeterai
								FROM   $DBUser.tabel_999_batas_materai
							   WHERE   TO_NUMBER (a.bill_amount) / 100 BETWEEN batasbawahpremi
																			 AND  batasataspremi)
								AS materex,
							 DECODE (
								TO_CHAR (a.tgl_booked, 'MM/YYYY'),
								TO_CHAR (a.entry_time, 'MM/YYYY'),
								DECODE (SUBSTR (b.KDPRODUK, 1, 3),
										'JL2', 0,
										'JL3', 0,
										1)
								* DECODE (
									 b.kdvaluta,
									 '1',
									 d.premitagihan,
									 '0',
									 ROUND (d.premitagihan / b.indexawal, 2)
									 * ROUND (
										  (SELECT   kurs
											 FROM   $DBUser.tabel_999_kurs_transaksi x
											WHERE   x.kdvaluta = b.kdvaluta
													AND x.tglkursberlaku =
														  (SELECT   MAX (
																	   y.tglkursberlaku
																	)
															 FROM   $DBUser.tabel_999_kurs_transaksi y
															WHERE   x.kdvaluta =
																	   y.kdvaluta
																	AND y.tglkursberlaku <=
																		  d.tglbayar)),
										  2
									   ),
									 d.premitagihan
									 * (SELECT   kurs
										  FROM   $DBUser.tabel_999_kurs_transaksi x
										 WHERE   x.kdvaluta = b.kdvaluta
												 AND x.tglkursberlaku =
													   (SELECT   MAX (y.tglkursberlaku)
														  FROM   $DBUser.tabel_999_kurs_transaksi y
														 WHERE   x.kdvaluta =
																	y.kdvaluta
																 AND y.tglkursberlaku <=
																	   d.tglbayar))
								  )
								/ 100,
								'0'
							 )
								disco
					  FROM   $DBUser.tabel_300_historis_premi d,
							 $DBUser.tabel_200_pertanggungan b,
							 $DBUser.tabel_315_pelunasan_H2H a,
							 $DBUser.tabel_500_penagih c,
							 $DBUser.tabel_202_produk e
					 WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
							 AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
							 AND b.prefixpertanggungan = d.prefixpertanggungan
							 AND b.nopertanggungan = d.nopertanggungan
							 AND a.tgl_booked = d.tglbooked
							 AND b.nopenagih = c.nopenagih
							 AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
							 AND a.void = '0'
							 AND TO_CHAR (a.entry_time, 'YYYYMMDD') between '$tglawal' and  '$tglakhir'
							 AND c.kdrayonpenagih IN
									  (SELECT   DISTINCT c.kdrayonpenagih AS kdkantor
										 FROM   $DBUser.tabel_300_historis_premi d,
												$DBUser.tabel_200_pertanggungan b,
												$DBUser.tabel_315_pelunasan_H2H a,
												$DBUser.tabel_500_penagih c,
												$DBUser.tabel_202_produk e
										WHERE   b.prefixpertanggungan =
												   SUBSTR (a.no_polis, 1, 2)
												AND b.nopertanggungan =
													  SUBSTR (a.no_polis, 3, 9)
												AND b.prefixpertanggungan =
													  d.prefixpertanggungan
												AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
												AND b.nopertanggungan =
													  d.nopertanggungan
												AND a.tgl_booked = d.tglbooked
												AND b.nopenagih = c.nopenagih
												AND a.void = '0'
												AND TO_CHAR (a.entry_time, 'YYYYMMDD') between '$tglawal' and  '$tglakhir'
												AND b.kdproduk = e.kdproduk
												AND a.company_code = '$metodebayar')
							 AND b.kdproduk = e.kdproduk
							 AND a.company_code = '$metodebayar'
				  ORDER BY   d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan)
				 zz";
	  
	  }
	  else {
	  $sql = "select KODEKANTOR KDRAYONPENAGIH,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,KDVALUTA,
      TGLBUK,KDKUITANSI,DECODE(KDVALUTA,'0',
                             ROUND (premitagihan / indexawal, 2),PREMITAGIHAN)*KURS PREMITAGIHAN,KDREKENINGLAWAN,JMLPREMI,NOURUT,
      NOPOLIS,BLNTAGIHAN,NOKONTROL,NOREKDEBET,NOREKKREDIT,STATUSPEMBAYARAN,
      BERITAKREDIT,TGLREKAM,TGLBAYAR,TGLUPDATED,BLNBAYAR,
      BLNBAYARNYA,NOPENAGIH,NOAGEN,NOREKENINGDEBET,NAMAKLIEN,THNKOMISI,KOMISIAGEN,
      NAMAAGEN,KDCABAS,
      (select nilaimeterai
      from $DBUser.tabel_999_batas_materai
      where ".
	  /* Opsi 1*/	  
	"(select
           CASE
            WHEN ((SUBSTR(".$tglawal.",1,4)*12+SUBSTR(".$tglawal.",5,2))-(to_char(g.mulas,'YYYY')*12+to_char(g.mulas,'MM'))) <= 60 THEN 
			(DECODE (KDVALUTA,
                 '0', ROUND (g.premi1 / indexawal, 2),
                 g.premi1)
         * KURS)
            ELSE (DECODE (KDVALUTA,
                 '0', ROUND (g.premi2 / indexawal, 2),
                 g.premi2)
         * KURS)
         END
            AS premi 
            from $DBUser.tabel_200_pertanggungan g
            where prefixpertanggungan = zz.prefixpertanggungan
                   AND nopertanggungan = zz.nopertanggungan)".
/* Opsi 2
"	  DECODE(
		(select premitagihan from $DBUser.tabel_300_historis_premi where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy'))
		,NULL,'0', (select premitagihan from $DBUser.tabel_300_historis_premi where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy'))
		)".				  				
*/

/* Opsi 3
JMLPREMI
*/
"		-   
				   DECODE(disco,NULL,'0',disco) 
		+
	  DECODE(
	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr )				  				 		,NULL,'0',	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr )				  				 	)	
		   ".
      //"jmlpremi-disco ".
      "between batasbawahpremi
      and batasataspremi ) matere,
	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr ) rider
      from (
      select c.kdrayonpenagih as kodekantor,(
      select namakantor
      from $DBUser.tabel_001_kantor
      where kdkantor=c.kdrayonpenagih) as namakantor,b.prefixpertanggungan,b.
      nopertanggungan,b.kdvaluta,b.indexawal,d.tglbooked as tglbuk,d.buktisetor as buktistr,d.
      kdkuitansi,d.premitagihan,d.kdrekeninglawan,'148090000' as kodeakun,(
      select nama
      from $DBUser.tabel_802_kodeakun
      where akun='148090000') as namaakunperantara,to_number(a.jumlahtagihan)/
      100 as jmlpremi,a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,a
      .nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.
      statuspembayaran,a.nourut,(
      select namaklien1
      from $DBUser.tabel_100_klien
      where noklien=b.nopembayarpremi) as namaklien, (
      select phonetetap01
      from $DBUser.tabel_100_klien
      where noklien=b.nopembayarpremi) as telp1, (
      select phonetetap02
      from $DBUser.tabel_100_klien
      where noklien=b.nopembayarpremi) as telp2, a.beritakredit, a.tglrekam,
      to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,to_char(d.
      tglbayar,'MM/YYYY') as blnbayar,
      to_char(d.tglbayar,'YYYYMM') as BLNBAYARNYA,b.nopenagih,b.noagen,b.norekeningdebet,
      ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, (
      select komisiagencb
      from $DBUser.tabel_404_temp
      where prefixpertanggungan=b.prefixpertanggungan
      and nopertanggungan=b.nopertanggungan
      and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12)
      and kdkomisiagen='01') komisiagen, (
      select kurs
      from $DBUser.tabel_999_kurs_transaksi
      where tglkursberlaku=(
      select max(tglkursberlaku)
      from $DBUser.tabel_999_kurs_transaksi
      where tglkursberlaku<=a.tglrekam
      and kdvaluta=b.kdvaluta)
      and kdvaluta=b.kdvaluta ) kurs, (
      select namaklien1
      from $DBUser.tabel_100_klien
      where noklien=b.noagen) as namaagen, e.kdcabas, (
      select nilaimeterai
      from $DBUser.tabel_999_batas_materai
      where to_number(a.jumlahtagihan)/100 between batasbawahpremi
      and batasataspremi ) as materex, decode(to_char(a.tglbooked,'MM/YYYY'),
      to_char(a.tglrekam,'MM/YYYY'),DECODE(SUBSTR(b.KDPRODUK,1,3),'JL2',0,
      'JL3',0,1)* decode(b.kdvaluta,'1',d.premitagihan,'0', ROUND(d.
      premitagihan/b.indexawal,2) * ROUND((
      SELECT kurs
      FROM $DBUser.tabel_999_kurs_transaksi x
      WHERE x.kdvaluta = b.kdvaluta
      AND x.tglkursberlaku = (
      SELECT max(y.tglkursberlaku)
      FROM $DBUser.tabel_999_kurs_transaksi y
      WHERE x.kdvaluta = y.kdvaluta
      AND y.tglkursberlaku <= d.tglbayar)),2), d.premitagihan * (
      SELECT kurs
      FROM $DBUser.tabel_999_kurs_transaksi x
      WHERE x.kdvaluta = b.kdvaluta
      AND x.tglkursberlaku = (
      SELECT max(y.tglkursberlaku)
      FROM $DBUser.tabel_999_kurs_transaksi y
      WHERE x.kdvaluta = y.kdvaluta
      AND y.tglkursberlaku <= d.tglbayar))) /100,'0') disco
      from $DBUser.tabel_300_historis_premi d,$DBUser.tabel_200_pertanggungan b,
      $DBUser.tabel_315_pelunasan_auto_debet a,$DBUser.tabel_500_penagih c, $DBUser.
      tabel_202_produk e
      where b.prefixpertanggungan=substr(a.nopolis,1,2)
      and b.nopertanggungan=substr(a.nopolis,3,9)
      and b.prefixpertanggungan=d.prefixpertanggungan
      and b.nopertanggungan=d.nopertanggungan
      AND TO_CHAR(a.tglbooked,'MMYYYY') = TO_CHAR(d.tglbooked,'MMYYYY')
      and b.nopenagih=c.nopenagih
      and substr(b.kdproduk,1,2)<>'JL'
      and a.statuspembayaran='2'
      and ".
		   $filterperiode."
       c.kdrayonpenagih in (SELECT   DISTINCT c.kdrayonpenagih AS kdkantor
    FROM   $DBUser.tabel_300_historis_premi d,
           $DBUser.tabel_200_pertanggungan b,
           $DBUser.tabel_315_pelunasan_auto_debet a,
           $DBUser.tabel_500_penagih c,
           $DBUser.tabel_202_produk e
   WHERE       b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
           AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
           AND b.prefixpertanggungan = d.prefixpertanggungan
           AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
           AND b.nopertanggungan = d.nopertanggungan
           AND TO_CHAR(a.tglbooked,'MMYYYY') = TO_CHAR(d.tglbooked,'MMYYYY')
           AND b.nopenagih = c.nopenagih
           AND a.statuspembayaran = '2' 
		   and ".
		   $filterperiode."           
            b.kdproduk = e.kdproduk
           AND a.kdbank = '$metodebayar')
      and b.kdproduk=e.kdproduk
      and a.kdbank='$metodebayar'
      order by d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan) zz";
	  
	 
	 
	 
	  //====premi rider saja
	  $sqlr = "select KODEKANTOR KDRAYONPENAGIH,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,KDVALUTA,
      TGLBUK,KDKUITANSI,DECODE(KDVALUTA,'0',
                             ROUND (premitagihan / indexawal, 2),PREMITAGIHAN)*KURS PREMITAGIHAN,KDREKENINGLAWAN,JMLPREMI,NOURUT,
      NOPOLIS,BLNTAGIHAN,NOKONTROL,NOREKDEBET,NOREKKREDIT,STATUSPEMBAYARAN,
      BERITAKREDIT,TGLREKAM,TGLBAYAR,TGLUPDATED,BLNBAYAR,
      BLNBAYARNYA,NOPENAGIH,NOAGEN,NOREKENINGDEBET,NAMAKLIEN,THNKOMISI,KOMISIAGEN,
      NAMAAGEN,KDCABAS,
      (select nilaimeterai
      from $DBUser.tabel_999_batas_materai
      where ".
	  /* Opsi 1*/	  
	/*"(select ".
          " CASE
            WHEN ((SUBSTR(".$tglawal.",1,4)*12+SUBSTR(".$tglawal.",5,2))-(to_char(g.mulas,'YYYY')*12+to_char(g.mulas,'MM'))) <= 60 THEN 
			(DECODE (KDVALUTA,
                 '0', ROUND (g.premi1 / indexawal, 2),
                 g.premi1)
         * KURS)
            ELSE (DECODE (KDVALUTA,
                 '0', ROUND (g.premi2 / indexawal, 2),
                 g.premi2)
         * KURS)
         END
            AS premi 
            from $DBUser.tabel_200_pertanggungan g
            where prefixpertanggungan = zz.prefixpertanggungan
                   AND nopertanggungan = zz.nopertanggungan)".
"		-   
				   DECODE(disco,NULL,'0',disco) 
		+ ".*/
	  " DECODE(
	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr )				  				 		,NULL,'0',	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr )				  				 	)	
		   ".
      //"jmlpremi-disco ".
      "between batasbawahpremi
      and batasataspremi ) matere,
	  (select premitagihan from $DBUser.tabel_300_historis_rider where 
            prefixpertanggungan = zz.prefixpertanggungan
                               AND nopertanggungan = zz.nopertanggungan
                               and to_char(tglbooked,'ddmmyyyy')=to_char(zz.tglbuk,'ddmmyyyy') and buktisetor=zz.buktistr ) rider
      from (
      select c.kdrayonpenagih as kodekantor,(
      select namakantor
      from $DBUser.tabel_001_kantor
      where kdkantor=c.kdrayonpenagih) as namakantor,b.prefixpertanggungan,b.
      nopertanggungan,b.kdvaluta,b.indexawal,d.tglbooked as tglbuk,d.buktisetor as buktistr,null 
      kdkuitansi,d.premitagihan,d.kdrekeninglawan,'148090000' as kodeakun,(
      select nama
      from $DBUser.tabel_802_kodeakun
      where akun='148090000') as namaakunperantara,to_number(a.jumlahtagihan)/
      100 as jmlpremi,a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,a
      .nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.
      statuspembayaran,a.nourut,(
      select namaklien1
      from $DBUser.tabel_100_klien
      where noklien=b.nopembayarpremi) as namaklien, (
      select phonetetap01
      from $DBUser.tabel_100_klien
      where noklien=b.nopembayarpremi) as telp1, (
      select phonetetap02
      from $DBUser.tabel_100_klien
      where noklien=b.nopembayarpremi) as telp2, a.beritakredit, a.tglrekam,
      to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,to_char(d.
      tglbayar,'MM/YYYY') as blnbayar,
      to_char(d.tglbayar,'YYYYMM') as BLNBAYARNYA,b.nopenagih,b.noagen,b.norekeningdebet,
      ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, (
      select komisiagencb
      from $DBUser.tabel_404_temp
      where prefixpertanggungan=b.prefixpertanggungan
      and nopertanggungan=b.nopertanggungan
      and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12)
      and kdkomisiagen='01') komisiagen, (
      select kurs
      from $DBUser.tabel_999_kurs_transaksi
      where tglkursberlaku=(
      select max(tglkursberlaku)
      from $DBUser.tabel_999_kurs_transaksi
      where tglkursberlaku<=a.tglrekam
      and kdvaluta=b.kdvaluta)
      and kdvaluta=b.kdvaluta ) kurs, (
      select namaklien1
      from $DBUser.tabel_100_klien
      where noklien=b.noagen) as namaagen, e.kdcabas, (
      select nilaimeterai
      from $DBUser.tabel_999_batas_materai
      where to_number(a.jumlahtagihan)/100 between batasbawahpremi
      and batasataspremi ) as materex, decode(to_char(a.tglbooked,'MM/YYYY'),
      to_char(a.tglrekam,'MM/YYYY'),DECODE(SUBSTR(b.KDPRODUK,1,3),'JL2',0,
      'JL3',0,1)* decode(b.kdvaluta,'1',d.premitagihan,'0', ROUND(d.
      premitagihan/b.indexawal,2) * ROUND((
      SELECT kurs
      FROM $DBUser.tabel_999_kurs_transaksi x
      WHERE x.kdvaluta = b.kdvaluta
      AND x.tglkursberlaku = (
      SELECT max(y.tglkursberlaku)
      FROM $DBUser.tabel_999_kurs_transaksi y
      WHERE x.kdvaluta = y.kdvaluta
      AND y.tglkursberlaku <= d.tglbayar)),2), d.premitagihan * (
      SELECT kurs
      FROM $DBUser.tabel_999_kurs_transaksi x
      WHERE x.kdvaluta = b.kdvaluta
      AND x.tglkursberlaku = (
      SELECT max(y.tglkursberlaku)
      FROM $DBUser.tabel_999_kurs_transaksi y
      WHERE x.kdvaluta = y.kdvaluta
      AND y.tglkursberlaku <= d.tglbayar))) /100,'0') disco
      from $DBUser.tabel_300_historis_rider d,$DBUser.tabel_200_pertanggungan b,
      $DBUser.tabel_315_pelunasan_auto_rider a,$DBUser.tabel_500_penagih c, $DBUser.
      tabel_202_produk e
      where b.prefixpertanggungan=substr(a.nopolis,1,2)
      and b.nopertanggungan=substr(a.nopolis,3,9)
      and b.prefixpertanggungan=d.prefixpertanggungan
      and b.nopertanggungan=d.nopertanggungan
      AND TO_CHAR(a.tglbooked,'MMYYYY') = TO_CHAR(d.tglbooked,'MMYYYY')
      and b.nopenagih=c.nopenagih
      and substr(b.kdproduk,1,2)<>'JL'
      and a.statuspembayaran='2'
      and ".
		   $filterperiode."
       c.kdrayonpenagih in (SELECT   DISTINCT c.kdrayonpenagih AS kdkantor
    FROM   $DBUser.tabel_300_historis_rider d,
           $DBUser.tabel_200_pertanggungan b,
           $DBUser.tabel_315_pelunasan_auto_rider a,
           $DBUser.tabel_500_penagih c,
           $DBUser.tabel_202_produk e
   WHERE       b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
           AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
           AND b.prefixpertanggungan = d.prefixpertanggungan
           AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
           AND b.nopertanggungan = d.nopertanggungan
           AND TO_CHAR(a.tglbooked,'MMYYYY') = TO_CHAR(d.tglbooked,'MMYYYY')
           AND b.nopenagih = c.nopenagih
           AND a.statuspembayaran = '2' 
		   and ".
		   $filterperiode."           
            b.kdproduk = e.kdproduk
           AND a.kdbank = '$metodebayar')
      and b.kdproduk=e.kdproduk
      and a.kdbank='$metodebayar'
      order by d.prefixpertanggungan, d.nopertanggungan) zz";
	  
	  }
					
		/*} else {
		
			$sql = "select ".
                "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
                "a.tglbooked as tglbuk,a.nilaipembayaran as premitagihan,a.kdrekeninglawan,".
								"to_number(a.premi) as jmlpremi,".
                "a.nopertanggungan as nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
    						"a.tglrekam,to_char(a.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
    						"to_char(a.tglbayar,'MM/YYYY') as blnbayar,".
							"to_char(a.tglbayar,'YYYYMM') as blnbayarnya,".
    						"b.nopenagih,b.noagen,b.norekeningdebet, ".
    						"ceil(months_between(a.tglbooked,b.mulas)/12) as thnkomisi, ".
    						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
    						"(select komisiagencb from $DBUser.tabel_404_temp ". 
                   "where prefixpertanggungan=b.prefixpertanggungan ". 
                	 "and nopertanggungan=b.nopertanggungan ".
                	 "and thnkomisi= ceil(months_between(a.tglbooked,TRUNC(b.mulas,'MONTH'))/12)+1 ".
                	 "and kdkomisiagen='01') komisiagen, ".
    						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
    						"e.kdcabas, ".
    						"(select 0 from $DBUser.tabel_999_batas_materai ".
      					 "where to_number(a.nilaipembayaran) between ".
                 "batasbawahpremi and batasataspremi ".
                 ") as matere ".
          "from ".
              "$DBUser.tabel_800_pembayaran a,".
              "$DBUser.tabel_200_pertanggungan b,".
              "$DBUser.tabel_500_penagih c, ".
  						"$DBUser.tabel_202_produk e ".
          "where ".
  						"b.prefixpertanggungan=a.prefixpertanggungan and ".
     					"b.nopertanggungan=a.nopertanggungan and ".
  						"b.nopenagih=c.nopenagih and ".
  						"b.kdvaluta='1' and ".
  						$filterperiode.
							$filterkantor.
              "b.kdproduk=e.kdproduk ".
  						"and substr(b.kdproduk,1,3)='JL2' ".
  						"and a.kdpembayaran='003' ".
							"and a.kb='B' ". //khusus bayar melalui bank
					"order by b.prefixpertanggungan,b.nopertanggungan";
		}*/	
		//echo $sql."<br /><br />";
		
		//echo $sqlr;
    //die;
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
  	$discountnb = 0;
  	$discountob = 0;
  	$preminb = 0;
  	$premiob = 0;
  	$matrenb = 0;
  	$matreob = 0;
  	$totaldebetnb = 0;
  	$totaldebetob = 0;
  	$jnb = 0;
  	$job = 0;
		$jmlkomisith1 = 0;
		$jmlkomisith2 = 0;
		$jmlkomisith3 = 0;
  	while ($arr=$DB->nextrow()) {
	$tglbayar=$arr["TGLBAYAR"];
	
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	  $kdkui = substr($arr["KDKUITANSI"],0,2);
  		if($kdkui=="NB" || $kdkui=="BP")
  		{
  		  $preminb = $arr["PREMITAGIHAN"];
  			$premiob = 0;
  			$discountnb = 0;
  			$discountob = 0;
  			$matrenb		= $arr["MATERE"];
  			$matreob		= 0;
  			$totaldebetnb = $arr["PREMITAGIHAN"];
  			$totaldebetob = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob = $arr["PREMITAGIHAN"];
  			$preminb = 0;
  			$discountob = 0;
  			$discountnb = 0;
  			$matreob		= $arr["MATERE"];
  			$matrenb		= 0;
  			$totaldebetob = $arr["PREMITAGIHAN"];
  			$totaldebetnb = 0;
  			$job++;
  			${"kdrekob".$cabas} = $arr["KDREKENINGLAWAN"];
  		}
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		<?
			/* Cek Discount */			
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"] /*|| $metodebayar=="CBN" || $metodebayar=="CTB" */|| $metodebayar=="POS" || $metodebayar=="THO" )
			{
			  	$matere=$arr["MATERE"];
			  	$discount = 0;
				$discountnb = 0;
				$discountob = 0;
			}
			else
			{
			  	/*if ($arr["BLNBAYARNYA"]>='201111') {
					$matere=$arr["MATERE"];
					//$discount = 0;
					//$discountnb = 0;
					//$discountob = 0;
				}*/
				
				//else {
					$discount = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
					$matere=$arr["MATERE"];
					if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA"){
						$materenb=0;
						$discountnb=0;
						$matereob=0;
						$discountob=0;
						$discount=0;
						$matere=0;
						
					} else {
						if($kdkui=="NB" || $kdkui=="BP")
						{
							$materenb=$arr["MATERE"];
							 $discountnb = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
						} elseif($kdkui=="OB") {
							$matereob=$arr["MATERE"];
						   $discountob = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
						}
					}
				//}
			}
			echo number_format($discount,2,",",".");			

		?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
	<?
			echo number_format($arr["MATERE"],2,",",".");
	?></td>

    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["JMLPREMI"]),2,",",".");?></td>

    <!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount),2,",",".");?></td>-->
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLBAYAR"];?></td>
    <? 
		 switch($arr["THNKOMISI"])
		 {
			 case '1' : $tk1 = number_format($arr["KOMISIAGEN"],2,",","."); $tk2 = "-"; $tk3 = "-"; 
			 					$jmlkomisith1 = $arr["KOMISIAGEN"]; $jmlkomisith2 = 0; $jmlkomisith3 = 0;
								${"totkomisith1".$cabas} += $jmlkomisith1;
								break;
								
			 case '2' : $tk1 = "-"; $tk2 = number_format($arr["KOMISIAGEN"],2,",","."); $tk3 = "-"; 
			   				$jmlkomisith1 = 0; $jmlkomisith2 = $arr["KOMISIAGEN"]; $jmlkomisith3 = 0;
								${"totkomisith2".$cabas} += $jmlkomisith2;
								break;
			 case '3' : $tk1 = "-"; $tk2 = "-"; $tk3 = number_format($arr["KOMISIAGEN"],2,",","."); 
			 					$jmlkomisith1 = 0; $jmlkomisith2 = 0; $jmlkomisith3 = $arr["KOMISIAGEN"];
								${"totkomisith3".$cabas} += $jmlkomisith3;
								break;
			 default : $tk1 = "-"; $tk2 = "-"; $tk3 = "-";
		 }
		?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk1;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk2;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$tk3;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAAGEN"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
  </tr>
	<? 
	$i++;
	$jmlmatre +=$matere;
	$jmldiscount +=$discount;
	$jmltotalrider += $arr["RIDER"];
	$jmltotaldebet += $arr["JMLPREMI"];
//	$jmltotaldebet += $arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount;
	$jmlpremi += $arr["PREMITAGIHAN"];
	
	$prevcabas = $arr["KDCABAS"];
	}

	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH</b></td>
	 <td></td>
	 <td></td>
	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
     <td align="right"><?=number_format($jmltotalrider,2,",",".");?></td>
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?=number_format($jmltotaldebet,2,",",".");?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
     <td></td>
	</tr>
    <?
    //echo $sqlr;
	$DBA->parse($sqlr);
	$DBA->execute();
	
  	//$i=1;
  	$discountnb = 0;
  	$discountob = 0;
  	$preminb = 0;
  	$premiob = 0;
  	$matrenb = 0;
  	$matreob = 0;
  	$totaldebetnb = 0;
  	$totaldebetob = 0;
  	$jnb = 0;
  	$job = 0;
		$jmlkomisith1 = 0;
		$jmlkomisith2 = 0;
		$jmlkomisith3 = 0;
  	while ($arr=$DBA->nextrow()) {
	$tglbayar=$arr["TGLBAYAR"];
	
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
    <td><?=$i;?></td>
	 <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["0"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
	 <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		<?
			/* Cek Discount */			
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"] || $metodebayar=="CBN" || $metodebayar=="CTB" || $metodebayar=="POS" || $metodebayar=="THO" )
			{
			  	$matere=$arr["MATERE"];
			  	$discount = 0;
				$discountnb = 0;
				$discountob = 0;
			}
			else
			{
			  	/*if ($arr["BLNBAYARNYA"]>='201111') {
					$matere=$arr["MATERE"];
					//$discount = 0;
					//$discountnb = 0;
					//$discountob = 0;
				}*/
				
				//else {
					$discount = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
					$matere=$arr["MATERE"];
					if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA"){
						$materenb=0;
						$discountnb=0;
						$matereob=0;
						$discountob=0;
						$discount=0;
						$matere=0;
						
					} else {
						if($kdkui=="NB" || $kdkui=="BP")
						{
							$materenb=$arr["MATERE"];
							 $discountnb = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
						} elseif($kdkui=="OB") {
							$matereob=$arr["MATERE"];
						   $discountob = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
						}
					}
				//}
			}
			echo number_format($discount,2,",",".");			

		?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
	<?
			echo number_format($arr["MATERE"],2,",",".");
	?></td>

    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["JMLPREMI"]),2,",",".");?></td>

    <!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount),2,",",".");?></td>-->
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLBAYAR"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=0;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=0;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=0;?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAAGEN"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
	</tr>
    <?
	$i++;
   $jmlmatre +=$matere;
	$jmldiscount +=$discount;
	$jmltotalrider += $arr["RIDER"];
	$jmltotaldebet += $arr["JMLPREMI"];
//	$jmltotaldebet += $arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount;
	//$jmlpremi += $arr["PREMITAGIHAN"];
	
	$prevcabas = $arr["KDCABAS"];
	}

	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH</b></td>
	 <td></td>
	 <td></td>
	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
     <td align="right"><?=number_format($jmltotalrider,2,",",".");?></td>
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?=number_format($jmltotaldebet,2,",",".");?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
     <td></td>
	</tr>
</table>
<?	
$kom=$jmltotaldebet;
$nilai1=$jmlpremi+$jmltotalrider;
$nilai2=$jmldiscount;
$nilai3=$jmlmatre;

if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet.php?kdbank=".$metodebayar."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_tradisional_1bill.php?kdproduk=TRD&kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}

?>
<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>

</body>
</html>
