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
		//echo "<body>";
	}
	else{
		echo "<body>";
?>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" method="post">
  <table>
	<tr>
  <td>Produk</td>
	<td>
	  <? 
	  
	  $setProduk = $_POST['produk'];
	  
		switch($produk)
		{
		  case 'JL2': $ja = "selected"; break;
		  case 'JL3': $jb = "selected"; break;
		  case 'JL4': $jb = "selected"; break;
			default : $ja = "selected"; break;
		}
		?>
	  <select name="produk">
	  <option value="JL2" <?php if($_POST['produk'] == 'JL2') { echo 'selected'; } ?> >JL2</option>
	  <option value="JL3" <?php if($_POST['produk'] == 'JL3') { echo 'selected'; } ?> >JL3</option>
	  <option value="JL4" <?php if($_POST['produk'] == 'JL4') { echo 'selected'; } ?> >JL4</option>
	  <option value="JL23" <?php if($_POST['produk'] == 'JL23') { echo 'selected'; } ?> >JL2 & JL3</option>
      <option value="ALL" <?php if($_POST['produk'] == 'ALL') { echo 'selected'; } ?> >ALL</option>
	</select></td>

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
			case 'BMRI': $sh = "selected"; break;
			case 'BBRI': $si = "selected"; break;
			case 'BIMA': $sx = "selected"; break;
			case 'BBNI': $sy = "selected"; break;
			case 'PPOS': $sj = "selected"; break;
			case 'FINN': $sv = "selected"; break;
			case 'PAMP': $pm = "selected"; break;
			case 'VBN': $sk = "selected"; break;
			default : $sx = "selected"; break;
		}
		
		switch($jenispremi)
		{
		  case 'pertamax': $first = "selected"; break;
		  case 'keduax': $second = "selected"; break;
		  case 'kabeh': $kabeh = "selected"; break;
			default : $first = "selected"; break;
		}
		?>
	  <select name="metodebayar">
	
        <option value="BMRI" <?=$sh;?>>H2H MANDIRI</option>
        <option value="BBRI" <?=$si;?>>H2H BRI</option>
		<option value="BIMA" <?=$sx;?>>H2H Bimasakti</option>
		<option value="BBNI" <?=$sy;?>>H2H BNI</option>
		<option value="PPOS" <?=$sj;?>>H2H Pos Indonesia</option>
		<option value="FINN" <?=$sv;?>>H2H Finnet Indonesia</option>
		<option value="PAMP" <?=$pm;?>>H2H Pampasy</option>
    
	</select></td>
	
	<td>Kantor</td>
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
 
 <select name="jenispremi">
	  <option value="pertamax" <?=$first;?>>Premi Pertama</option>
	  <option value="keduax" <?=$second;?>>Premi Lanjutan</option>
	  <option value="kabeh" <?=$kabeh;?>>ALL</option>
 </select>
 </td>
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
	
	if($jenispremi=="pertamax"){
		$filterjenispremi=" d.kdkuitansi = 'BP3' AND ";
	} else if($jenispremi=="keduax") {
		$filterjenispremi=" d.kdkuitansi <> 'BP3' AND ";
	} else {
		$filterjenispremi=" ";
	}
	
	
	if($metodebayar=="MDR"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
	} elseif($metodebayar=="BMRI"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "H2H BANK MANDIRI";
    } elseif($metodebayar=="BBRI"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BRI";
		 $titletrans		= "H2H BANK BRI";
	} elseif($metodebayar=="BIMA"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BIMSAKTI";
		 $titletrans		= "H2H Bimasakti";

    } elseif($metodebayar=="BBNI"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BNI";
		 $titletrans		= "H2H BANK BNI";

    } elseif($metodebayar=="PPOS"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "PPOS";
		 $titletrans		= "H2H POS INDONESIA";
   
	 } elseif($metodebayar=="FINN"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "FINN";
		 $titletrans		= "H2H FINNET INDONESIA";

    }
	elseif($metodebayar=="PAMP"){
	   $filterperiode = "to_char(a.proccess_date,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "PAMP";
		 $titletrans		= "H2H PAMPASY";

    }
	elseif($metodebayar=="BNI"){
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
	} elseif($metodebayar=="VBN"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "POS";
		 $titletrans		= "VIA VA BNI";
	} else {
	   $filterperiode = "to_char(a.tglseatled,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
	   $filterpenagih = "TRANSFER";
		 $titletrans		= "TRANSFER REK. HO";
	}

  if($kdkantor=="ALL"){
		  $filterkantor = "";
	}	else	{
		  $filterkantor = "c.kdrayonpenagih='$kdkantor' and ";
	}
  
   if($produk=="ALL"){
		  $filterproduk = "and substr(b.kdproduk,1,3) in ('JL2','JL3','JL4') ";
	}	else if ($produk=="JL23") {
		  $filterproduk = "and substr(b.kdproduk,1,3) in ('JL2','JL3') ";
	} else	{
		  $filterproduk = "and substr(b.kdproduk,1,3)='".$produk."' ";
	}	
	
?>
<b>TRANSAKSI HOST-TO-HOST</b><br/>
<b>DAFTAR TRANSAKSI JS LINK (<?=($produk=='JL23'?'JL2 & JL3':$produk);?>) <?=$titletrans;?><br /> </b>
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
  </tr>
	<tr>
    <td bgcolor="#89acd8" align="center">TH.1</td>
    <td bgcolor="#89acd8" align="center">TH.2</td>
    <td bgcolor="#89acd8" align="center">TH.3</td>
  </tr>
	<? 
	if ($metodebayar=="CTB"){
  $materenye="(select 0 from $DBUser.tabel_999_batas_materai where (to_number(a.jumlahtagihan))-6000 between batasbawahpremi and batasataspremi ) as matere, ";
  }else{
  $materenye="decode(e.kdproduk,'JL4X',0,'JL4B',0,(select nilaimeterai from $DBUser.tabel_999_batas_materai where (to_number(a.jumlahtagihan)/100)-6000 between batasbawahpremi and batasataspremi )) as matere, ";
  }
  
  if($_POST['jenispremi'] == 'pertamax')
  {
	
		 $sql = "SELECT   c.kdrayonpenagih,
					   b.prefixpertanggungan,
					   b.nopertanggungan,
					   b.kdvaluta,
					   d.tglbooked AS tglbuk,
					   d.kdkuitansi,
					   b.premistd AS premitagihan,
					   b.premi1  + 
         NVL((
            SELECT NVL(ee.PREMI,0)
            FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK  ee
            WHERE b.PREFIXPERTANGGUNGAN = ee.PREFIXPERTANGGUNGAN 
            AND  b.NOPERTANGGUNGAN = ee.NOPERTANGGUNGAN
            AND ee.KDBENEFIT = 'BNFTOPUPSG'
         
         ),0)  AS preminya,
					   d.kdrekeninglawan,
					   TO_NUMBER (a.bill_amount) AS jmlpremi,
					   null nourut,
					   a.no_polis,
					   TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
					   null nokontrol,
					   null norekdebet,
					   null norekkredit,
					   a.void statuspembayaran,
					   null beritakredit,
					   a.void statuspembayaran,
					   a.proccess_date,
					   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
					   a.proccess_date,
					   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
					   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
					   b.nopenagih,
					   b.noagen,
					   b.norekeningdebet,
					   (SELECT   namaklien1
						  FROM   $DBUser.tabel_100_klien
						 WHERE   noklien = b.nopembayarpremi)
						  AS namaklien,
					   CEIL (MONTHS_BETWEEN (a.proccess_date, b.mulas) / 12) AS thnkomisi,
					   (SELECT   komisiagencb
						  FROM   $DBUser.tabel_404_temp
						 WHERE   prefixpertanggungan = b.prefixpertanggungan
								 AND nopertanggungan = b.nopertanggungan
								 AND thnkomisi =
									   CEIL (MONTHS_BETWEEN (a.proccess_date, b.mulas) / 12)
								 AND kdkomisiagen = '01')
						  komisiagen,
					   (SELECT   namaklien1
						  FROM   $DBUser.tabel_100_klien
						 WHERE   noklien = b.noagen)
						  AS namaagen,
					   e.kdcabas,
					   0 matere,
					   (SELECT   premitagihan
						  FROM   $DBUser.tabel_300_historis_rider
						 WHERE   prefixpertanggungan = b.prefixpertanggungan
								 AND nopertanggungan = b.nopertanggungan
								 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
									   TO_CHAR (a.tgl_booked, 'ddmmyyyy'))
						  rider,       (select SUM(NVL(bb.biaya,0)) from $DBUser.TABEL_999_BIAYA_POLIS bb
        where bb.kdproduk= B.KDPRODUK and bb.tglbiayaberlaku =
        (select max(xx.tglbiayaberlaku) from $DBUser.TABEL_999_BIAYA_POLIS xx
        where bb.kdproduk=xx.kdproduk)) biaya
		
				FROM   $DBUser.tabel_300_historis_premi d,
					   $DBUser.tabel_200_pertanggungan b,
					   $DBUser.tabel_315_pelunasan_h2h a,
					   $DBUser.tabel_500_penagih c,
					   $DBUser.tabel_202_produk e
			   WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
					   AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
					   AND b.prefixpertanggungan = d.prefixpertanggungan
					   AND b.nopertanggungan = d.nopertanggungan
					   AND a.tgl_booked = d.tglbooked
					   AND b.nopenagih = c.nopenagih
					   AND a.void = '0'
					   AND b.kdvaluta = '1'
					   and ".$filterperiode.
					   $filterkantor.$filterjenispremi.
					   " b.kdproduk = e.kdproduk ".
					  $filterproduk.
					  " AND a.company_code = '".$metodebayar."' 
			ORDER BY   b.prefixpertanggungan, b.nopertanggungan, d.kdkuitansi ";
					
		
	}
	else
	{
		 $sql = "SELECT   c.kdrayonpenagih,
					   b.prefixpertanggungan,
					   b.nopertanggungan,
					   b.kdvaluta,
					   d.tglbooked AS tglbuk,
					   d.kdkuitansi,
					   b.premistd AS premitagihan,
					   b.premi1  + 
         NVL((
            SELECT NVL(ee.PREMI,0)
            FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK  ee
            WHERE b.PREFIXPERTANGGUNGAN = ee.PREFIXPERTANGGUNGAN 
            AND  b.NOPERTANGGUNGAN = ee.NOPERTANGGUNGAN
            AND ee.KDBENEFIT = 'BNFTOPUPSG'
         
         ),0)  AS xpreminya,
					   d.kdrekeninglawan,
					   TO_NUMBER (a.bill_amount) AS preminya,
					   null nourut,
					   a.no_polis,
					   TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
					   null nokontrol,
					   null norekdebet,
					   null norekkredit,
					   a.void statuspembayaran,
					   null beritakredit,
					   a.void statuspembayaran,
					   a.proccess_date,
					   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
					   a.proccess_date,
					   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
					   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
					   b.nopenagih,
					   b.noagen,
					   b.norekeningdebet,
					   (SELECT   namaklien1
						  FROM   $DBUser.tabel_100_klien
						 WHERE   noklien = b.nopembayarpremi)
						  AS namaklien,
					   CEIL (MONTHS_BETWEEN (a.proccess_date, b.mulas) / 12) AS thnkomisi,
					   (SELECT   komisiagencb
						  FROM   $DBUser.tabel_404_temp
						 WHERE   prefixpertanggungan = b.prefixpertanggungan
								 AND nopertanggungan = b.nopertanggungan
								 AND thnkomisi =
									   CEIL (MONTHS_BETWEEN (a.proccess_date, b.mulas) / 12)
								 AND kdkomisiagen = '01')
						  komisiagen,
					   (SELECT   namaklien1
						  FROM   $DBUser.tabel_100_klien
						 WHERE   noklien = b.noagen)
						  AS namaagen,
					   e.kdcabas,
					   0 matere,
					   (SELECT   premitagihan
						  FROM   $DBUser.tabel_300_historis_rider
						 WHERE   prefixpertanggungan = b.prefixpertanggungan
								 AND nopertanggungan = b.nopertanggungan
								 AND TO_CHAR (tglbooked, 'ddmmyyyy') =
									   TO_CHAR (a.tgl_booked, 'ddmmyyyy'))
						  riderx, 0 rider,  0 biaya
		
				FROM   $DBUser.tabel_300_historis_premi d,
					   $DBUser.tabel_200_pertanggungan b,
					   $DBUser.tabel_315_pelunasan_h2h a,
					   $DBUser.tabel_500_penagih c,
					   $DBUser.tabel_202_produk e
			   WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
					   AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
					   AND b.prefixpertanggungan = d.prefixpertanggungan
					   AND b.nopertanggungan = d.nopertanggungan
					   AND a.tgl_booked = d.tglbooked
					   AND b.nopenagih = c.nopenagih
					   AND a.void = '0'
					   AND b.kdvaluta = '1'
					   and ".$filterperiode.
					   $filterkantor.$filterjenispremi.
					   " b.kdproduk = e.kdproduk ".
					  $filterproduk.
					  " AND a.company_code = '".$metodebayar."' 
			ORDER BY   b.prefixpertanggungan, b.nopertanggungan, d.kdkuitansi ";
			
		
	}
	

//	echo $sql."--<br>";
		
		
		
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
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
   <?=number_format(($arr["PREMINYA"]),2,",",".");?></td>
   
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["BIAYA"]),2,",",".");?></td>
	
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
	0</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["MATERE"],2,",",".");?></td>

    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
	<?=number_format($arr["PREMINYA"]+$arr["BIAYA"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$selisih;?></td>
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
  </tr>
	<? 
	$i++;
	$jmlmatre +=$matere;
	$jmldiscount +=$discount;
//	$jmltotaldebet += $arr["PREMITAGIHAN"];
//	$jmltotaldebet += $arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount;
  $jmltotaldebet += $arr["JMLPREMI"]; // dirubah untuk sementara oleh dedi 28/12/2012
	//$jmlpremi += $arr["PREMITAGIHAN"]-$arr["RIDER"];
	$jmltotalselisih += $arr["SELISIH"];
	$jmlbipolis += $bipolis;
	

	$jmlpremir += $arr["RIDER"];
	
	$prevcabas = $arr["KDCABAS"];
	
	$totPreminya += $arr["PREMINYA"];
	$totBiaya += $arr["BIAYA"];
	$totNotDeb += ($arr["PREMINYA"]+$arr["BIAYA"]);
	
	}

	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH</b></td>
	 <td></td>
	 <td></td>
	 <td align="right"><?=number_format($totPreminya,2,",",".");?></td>
     <td align="right"><?=number_format($totBiaya ,2,",",".");?></td>
     <td align="right"><?=number_format($jmlpremir,2,",",".");?></td>
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?=number_format($totNotDeb,2,",",".");?></td>
   <td align="right">0</td>
	 <td></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
</table>
<?	
$kom=$totPreminya;
//$nilai1=$jmlpremi;
$nilai1=$totBiaya;
$nilai2=0;
$nilai3=0;
$nilai4=0;
$nilai5=0;

if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_h2h.php?setproduk=".$setProduk."&jenis=".$jenispremi."&kdbank=UL".$metodebayar."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."&nilai4=".$nilai4."&nilai5=".$nilai5."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
//echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_jl2.php?kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>"); kdproduk blm ada
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_h2h.php?jenispremi=".$jenispremi."&kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&produk=".$produk."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}

?>
<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>

</body>
</html>
