<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/kantor.php";
include "../../includes/klien.php";
	
$DB=new database($userid, $passwd, $DBName);
$DBH2H=new database($userid, $passwd, $DBName);
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
<title></title>
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
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
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
			case 'BMRI': $sm = "selected"; break;
			case 'BBRI': $sy = "selected"; break;
			case 'BIMA': $sbima = "selected"; break;
			case 'BBNI': $sbni = "selected"; break;
			case 'PPOS': $sppos = "selected"; break;
			case 'FINN': $sfinn = "selected"; break;
			case 'VBN': $sf = "selected"; break;
			case 'BTN': $sg = "selected"; break;
			case 'BPK': $sh = "selected"; break;
			case 'BCN': $si = "selected"; break;
			default : $sx = "selected"; break;
		}
		
		switch($jenispremi)
		{
		  case 'pertamax': $first = "selected"; break;
		  case 'keduax': $second = "selected"; break;
			default : $first = "selected"; break;
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
      <option value="BMRI" <?=$sm;?>>H2H Mandiri</option>
      <option value="BBRI" <?=$sy;?>>H2H BRI</option>
	  <option value="BIMA" <?=$sbima;?>>H2H Bimasakti</option>
	  <option value="BBNI" <?=$sbni;?>>H2H BNI</option>
	  <option value="PPOS" <?=$sppos;?>>H2H Pos Indonesia</option>
	  <option value="FINN" <?=$sfinn;?>>H2H Finnet Indonesia</option>
      <option value="VBN" <?=$sf;?>>VA BNI</option>
      <option value="BTN" <?=$sg;?>>Auto Debet BTN</option>
      <option value="BPK" <?=$sh;?>>Auto Debet BPD KALBAR</option>
      <option value="BCN" <?=$si;?>>VA CIMB NIAGA</option>
	</select>
     
     <select name="jenispremi">
	  <option value="pertamax" <?=$first;?>>Premi Pertama</option>
	  <option value="keduax" <?=$second;?>>Premi Lanjutan</option>
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
			case 'BMRI': $sm = "selected"; break;
			case 'BBRI': $sy = "selected"; break;
			case 'BIMA': $sbima = "selected"; break;
			case 'BBNI': $sbni = "selected"; break;
			case 'PPOS': $sppos = "selected"; break;
			case 'FINN': $sfinn = "selected"; break;
			case 'VBN': $sf = "selected"; break;
			case 'BTN': $sg = "selected"; break;
			case 'BPK': $sh = "selected"; break;
			case 'BCN': $si = "selected"; break;
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

	$z_selisih = 0;
	$z_selisihTotal = 0;

//	$tglawal	=	$_POST['dthn'] . 
//					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) .
//					( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] );
//	$tglakhir	=	$_POST['sthn'] . 
//					( (strlen($_POST['sbln'])==1) ? '0'.$_POST['sbln'] : $_POST['sbln'] ) .
//					( (strlen($_POST['stgl'])==1) ? '0'.$_POST['stgl'] : $_POST['stgl'] );
	//echo '<hr />'. $tglawal . ' - '.$tglakhir.'<hr />';
	if($jenispremi=="pertamax"){
		$filterjenispremi=" AND d.kdkuitansi='BP3' ";
	} else {
		$filterjenispremi=" AND d.kdkuitansi<>'BP3' ";
	}
	
	if($metodebayar=="MDR"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
	} elseif($metodebayar=="BNI"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BNI";
		 $titletrans		= "AUTO DEBET BNI";
	} elseif($metodebayar=="BTN"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BTN";
		 $titletrans		= "AUTO DEBET BTN";
    } elseif($metodebayar=="BPK"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BPK";
		 $titletrans		= "AUTO DEBET BPK";
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
	   $filterperiode = "to_char(a.PROCCESS_DATE,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "H2H MANDIRI";
	} elseif($metodebayar=="BBRI"){
	   $filterperiode = "to_char(a.PROCCESS_DATE,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "H2H BRI";	
	} elseif($metodebayar=="BIMA"){
	   $filterperiode = "to_char(a.PROCCESS_DATE,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "H2H Bimasakti";
	} elseif($metodebayar=="BBNI"){
	   $filterperiode = "to_char(a.PROCCESS_DATE,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BBNI";
		 $titletrans		= "H2H Bank BNI";
	}
	elseif($metodebayar=="PPOS"){
	   $filterperiode = "to_char(a.PROCCESS_DATE,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "PPOS";
		 $titletrans		= "H2H Pos Indonesia";
	}
	elseif($metodebayar=="FINN"){
	   $filterperiode = "to_char(a.PROCCESS_DATE,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "FINN";
		 $titletrans		= "H2H Finnet Indonesia";
	}
	elseif($metodebayar=="VBN"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "VA BNI";
	}
	elseif($metodebayar=="BCN"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "VA CIMB NIAGA";
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
<b>DAFTAR TRANSAKSI (<?=$produk;?>) <?=$titletrans;?><br /> </b>
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
    <td bgcolor="#89acd8" align="center" rowspan="2">Bi. Polis</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Rider</td>
	<td bgcolor="#89acd8" align="center" rowspan="2">Discount</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Materai</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Total Debet</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Selisih</td>
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
	//echo $metodebayar;
	  if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA" || $metodebayar=="BBNI" || $metodebayar=="PPOS" || $metodebayar=="FINN"){
	  $sql = "SELECT z_entry_time, z_tglbuk,  KODEKANTOR KDRAYONPENAGIH,
				 PREFIXPERTANGGUNGAN,
				 NOPERTANGGUNGAN,
				 KDVALUTA,
				 TGLBUK,
				 KDKUITANSI,
				 DECODE (KDVALUTA,
						 '0', ROUND (premitagihan / indexawal, 2),
						 ceil(PREMITAGIHAN))
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
				 PROCCESS_DATE TGLREKAM,
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
										  AND buktisetor = replace(zz.buktistr,'MANDIRI','')),
								NULL,
								'0',
								(SELECT   premitagihan
								   FROM   $DBUser.tabel_300_historis_rider
								  WHERE   prefixpertanggungan =
											 zz.prefixpertanggungan
										  AND nopertanggungan = zz.nopertanggungan
										  AND TO_CHAR (tglbooked, 'ddmmyyyy') =
												TO_CHAR (zz.tglbuk, 'ddmmyyyy')
										  AND buktisetor = replace(zz.buktistr,'MANDIRI',''))
							 ) BETWEEN batasbawahpremi
								   AND  batasataspremi)
					matere,
				 (SELECT   premitagihan
					FROM   $DBUser.tabel_300_historis_rider
				   WHERE   prefixpertanggungan = zz.prefixpertanggungan
						   AND nopertanggungan = zz.nopertanggungan
						   AND TO_CHAR (tglbooked, 'ddmmyyyy') =
								 TO_CHAR (zz.tglbuk, 'ddmmyyyy')
						   AND buktisetor = replace(zz.buktistr,'MANDIRI',''))
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
							 a.PROCCESS_DATE,
							 TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
							 a.PROCCESS_DATE tglupdated,
							 TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
							 TO_CHAR (d.tglbayar, 'YYYYMM') AS BLNBAYARNYA,
							 b.nopenagih,
							 b.noagen,
							 b.norekeningdebet,
							 CEIL (MONTHS_BETWEEN (a.PROCCESS_DATE, b.mulas) / 12)
								AS thnkomisi,
							 (SELECT   komisiagencb
								FROM   $DBUser.tabel_404_temp
							   WHERE   prefixpertanggungan = b.prefixpertanggungan
									   AND nopertanggungan = b.nopertanggungan
									   AND thnkomisi =
											 CEIL(MONTHS_BETWEEN (a.PROCCESS_DATE,
																  b.mulas)
												  / 12)
									   AND kdkomisiagen = '01')
								komisiagen,
							 (SELECT   kurs
								FROM   $DBUser.tabel_999_kurs_transaksi
							   WHERE   tglkursberlaku =
										  (SELECT   MAX (tglkursberlaku)
											 FROM   $DBUser.tabel_999_kurs_transaksi
											WHERE   tglkursberlaku <= a.PROCCESS_DATE
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
								TO_CHAR (a.PROCCESS_DATE, 'MM/YYYY'),
								DECODE (b.KDPRODUK,
										(SELECT KDPRODUK FROM $DBUser.TABEL_202_PRODUK_DISKON WHERE KDPRODUK=b.KDPRODUK), 0,
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
								disco,  TO_CHAR(a.PROCCESS_DATE,'DDMMYYYY') z_entry_time, TO_CHAR(d.tglbooked,'MMYYYY') z_tglbuk
					  FROM   $DBUser.tabel_300_historis_premi d,
							 $DBUser.tabel_200_pertanggungan b,
							 $DBUser.tabel_315_pelunasan_H2H a,
							 $DBUser.tabel_500_penagih c,
							 $DBUser.tabel_202_produk e
					 WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
							 AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
							 AND b.prefixpertanggungan = d.prefixpertanggungan
							 AND b.nopertanggungan = d.nopertanggungan							
							 AND to_char(a.tgl_booked,'mmyyyy')=to_char(d.tglbooked,'mmyyyy')
							 AND b.nopenagih = c.nopenagih
							 AND SUBSTR (b.kdproduk, 1, 2) <> 'JL'
							 AND a.void = '0'
							 AND TO_CHAR (a.PROCCESS_DATE, 'YYYYMMDD') between '$tglawal' and  '$tglakhir'
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
												AND TO_CHAR (a.PROCCESS_DATE, 'YYYYMMDD') between '$tglawal' and  '$tglakhir'
												AND b.kdproduk = e.kdproduk
												AND a.company_code = '$metodebayar')
							 AND b.kdproduk = e.kdproduk
							 AND a.company_code = '$metodebayar' ".
							 $filterjenispremi.
				  "ORDER BY   d.kdkuitansi, d.prefixpertanggungan, d.nopertanggungan)
				 zz";

				// echo $sql."--<br>";
				//	die;
	  
	  }
	  
					
		
	//echo $sql."<br /><br />";
		//die
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


		/*enhanced : 15 jan 2014 - iie*/
	
		$z_TglUpd = $arr["Z_ENTRY_TIME"];
		$z_TglBuk = $arr["Z_TGLBUK"];
		$z_NoPol = $arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"];
		
		
		$z_sql1="select $DBUser.h2h_gen_selisih('$z_TglUpd', '$z_TglBuk', '$z_NoPol') AS sel from dual"; 
		//$DBH2H->parse($z_sql1);
		//$DBH2H->execute();
		//$z_res=$DBH2H->nextrow();
		
		/*didisable karena udah ditarik ke semua BO/RO*/
		/*
		$z_selisih = $z_res["SEL"];
		$z_selisihTotal += $z_res["SEL"];
		*/

		$z_selisih = 0;
		$z_selisihTotal += 0;

		if($jenispremi=="pertamax"){
		$bipolis=$arr["JMLPREMI"]-$arr["PREMITAGIHAN"];} else {
		$bipolis=0;}
		//echo $z_TglUpd."--<br>";

	   /*end of enhanced */






  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=($prevcabas<>$arr["KDCABAS"] ? "<b>".$arr["KDCABAS"]."</b>" : "");?></td>
		<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKLIEN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BLNTAGIHAN"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDREKENINGLAWAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$kdkui;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITAGIHAN"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($bipolis,2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		<?
			/* Cek Discount */			
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"] || $metodebayar=="CBN" || $metodebayar=="CTB" || $metodebayar=="THO" )
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
					//$discount = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
					$discount =$arr["DISCO"];
					
					if ($discount==0){
					$discount =$arr["DISCO"];
					}else {
					$discount = (($arr["PREMITAGIHAN"]+$arr["RIDER"])* 0.01);
					}
					$matere=$arr["MATERE"];
					if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA" || $metodebayar=="PPOS" || $metodebayar=="FINN" || $metodebayar=="VBN" || $metodebayar=="BTN" || $metodebayar=="POS"){
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
			if($metodebayar=="POS"){
				echo "0,00";
			}else{
				echo number_format($arr["MATERE"],2,",",".");	
			}
	?></td>

    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["JMLPREMI"]+$z_selisih),2,",",".");?></td>
    <?
    #----------------------------[ UPDATE SELEISIH ]----------------------------
	if(($arr["PONSEL"])== ''){
			 	$selisih = "<font color=red><a href=\"#\" onclick=\"NewWindow('./updateselisih.php?np=".$arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"]."&bln=".$arr["BLNTAGIHAN"]."','',800,500,1)\">".number_format(($arr["SELISIH"]),2,",",".")."</a></font>";  
				//echo 'kampret';
			 } else {
			    $selisih = number_format(($arr["SELISIH"]),2,",",".");
				//echo 'kampret ok';
			 }
	#----------------------------[ END UPDATE SELEISIH ]----------------------------
    ?>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$selisih;?></td>
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
	if($metodebayar=="POS"){
				$jmlmatre =0;
			}else{
				$jmlmatre +=$matere;
			}
	
	$jmldiscount +=$discount;
	$jmltotalrider += $arr["RIDER"];
	$jmltotaldebet += $arr["JMLPREMI"];
//	$jmltotaldebet += $arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount;
	$jmlpremi += $arr["PREMITAGIHAN"];
	$jmltotalselisih += $arr["SELISIH"];
	$prevcabas = $arr["KDCABAS"];
	$jmlbipolis += $bipolis;

	}
	

	


	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH</b></td>
	 <td></td>
	 <td></td>
	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
     <td align="right"><?=number_format($jmlbipolis,2,",",".");?></td>
     <td align="right"><?=number_format($jmltotalrider,2,",",".");?></td>
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?=number_format($jmltotaldebet+$z_selisihTotal,2,",",".");?></td>
	 <td align="right"><?=number_format($jmltotalselisih,2,",",".");?></td>
     <td></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
     <td></td>
	</tr>
    <?
    
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
					if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA" || $metodebayar=="PPOS" || $metodebayar=="FINN" || $metodebayar=="BBNI"){
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
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=0?></td>
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
	$jmltotals += $jmltotalselisih;
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH</b></td>
	 <td></td>
	 <td></td>
	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
     <td align="right"><?=number_format($jmlbipolis,2,",",".");?></td>
     <td align="right"><?=number_format($jmltotalrider,2,",",".");?></td>
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?=number_format($jmltotaldebet+$z_selisihTotal,2,",",".");?></td>
     <td align="right"><?=number_format($jmltotals,2,",",".");?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
     <td></td>
	</tr>
</table>
<?	
$kom=$jmltotaldebet+$z_selisihTotal+$jmltotals;
$kom1=$jmltotaldebet;
$nilai1=$jmlpremi+$jmltotalrider;
$nilai2=$jmldiscount;
if($metodebayar=="POS"){
	$nilai3="";
}else{
	$nilai3=$jmlmatre;
}
$nilai4=$z_selisihTotal;
$nilai5=$jmlbipolis;
$nilai6=$jmltotals;
//echo $jmltotals;
if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
if(substr($metodebayar,0,2)!="UL"){
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet_nl.php?jenis=".$jenispremi."&kdbank=".$metodebayar."&tgl=".$tglbayar."&kom=".$kom."&kom1=".$kom1."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."&nilai4=".$nilai4."&nilai5=".$nilai5."&nilai6=".$nilai6."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");	
}else{
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet_nl.php?jenis=".$jenispremi."&kdbank=UL".$metodebayar."&tgl=".$tglbayar."&kom=".$kom."&kom1=".$kom1."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."&nilai4=".$nilai4."&nilai5=".$nilai5."&nilai6=".$nilai6."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");	
}
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_tradisional.php?jenispremi=".$jenispremi."&kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}

?>
<!--<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>-->

</body>
</html>
