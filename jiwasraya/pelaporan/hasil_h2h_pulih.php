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
<title>Info Pelunasan Pemulihan Unit Link</title>
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
			case 'BIMA': $sj = "selected"; break;
			case 'BBNI': $sj = "selected"; break;
			case 'PPOS': $sj = "selected"; break;
			case 'FINN': $sj = "selected"; break;
			case 'PAMP': $sz = "selected"; break;
			case 'VBN': $sk = "selected"; break;
			default : $sx = "selected"; break;
		}
		
		?>
	  <select name="metodebayar">
	
        <option value="BMRI" <?=$sh;?>>H2H MANDIRI</option>
        <option value="BBRI" <?=$si;?>>H2H BRI</option>
		<option value="BIMA" <?=$sj;?>>H2H Bimasakti</option>
		<option value="BBNI" <?=$sj;?>>H2H BNI</option>
		<option value="PPOS" <?=$sj;?>>H2H Pos Indonesia</option>
		<option value="FINN" <?=$sj;?>>H2H Finnet Indonesia</option>
		<option value="PAMP" <?=$sz;?>>H2H Pampasy</option>
    
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

 </td>
 </tr>
 <tr>
 <td>Dari</td><td><?=DateSelector("d"); ?></td><td>Sampai</td><td><?=DateSelector("s"); ?></td>
 <td colspan="2"><input type="hidden" value="do" name="do"><input type="submit" name="submit" value="Cari"</input></td>
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

    }
	elseif($metodebayar=="FINN"){
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
		  $filterkantor = "d.kdrayonpenagih='$kdkantor' and ";
	}
  
   if($produk=="ALL"){
		  $filterproduk = "and substr(b.kdproduk,1,3) in ('JL2','JL3','JL4') ";
	}	else if ($produk=="JL23") {
		  $filterproduk = "and substr(b.kdproduk,1,3) in ('JL2','JL3') ";
	} else	{
		  $filterproduk = "and substr(b.kdproduk,1,3)='".$produk."' ";
	}	
	
?>
<b>TRANSAKSI HOST-TO-HOST PEMULIHAN</b><br/>
<b>DAFTAR TRANSAKSI JS LINK  <?=$titletrans;?><br /> </b>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center" >No.</td>
    <td bgcolor="#89acd8" align="center" >Tgl. Bayar</td>
	<td bgcolor="#89acd8" align="center" >No. Polis</td>
    <td bgcolor="#89acd8" align="center" >Nama Pemb. Polis</td>
    <td bgcolor="#89acd8" align="right" >Tunggakan Premi</td>
    <td bgcolor="#89acd8" align="right" >Bunga Tunggakan</td>
    <td bgcolor="#89acd8" align="right" >Total Bayar</td>
    <td bgcolor="#89acd8" align="center" >Produk</td>    
  </tr>
	
	<? 
  
  
	if($_POST['do'] == 'do')
	{
		 $sql = "SELECT TO_CHAR (a.PAID_DATETIME, 'DDMMYYYY') TGLBAYAR, 
                            TO_CHAR (a.TGLMOHON, 'DDMMYYYY') TGL_MOHON, 
                            a.COMPANY_CODE, 
                            a.PREFIXPERTANGGUNGAN || a.NOPERTANGGUNGAN NO_POLIS, 
                            NVL (a.TUNGGAKANPREMI, 0) JMLDEBET, 
                            NVL (a.BUNGATUNGGAKAN, 0) BUNGA_TUNGGAKAN, 
                            a.JURNAL_SEQUENCE, 
                            a.PAYMENT_AMOUNT, 
                            b.KDVALUTA,
                            DECODE(b.KDVALUTA, '1', CEIL(a.TUNGGAKANPREMI)+ a.BIAYAMATERAI,  
                            '3', CEIL(a.TUNGGAKANPREMI * ( 
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI,                             
                            '0', CEIL(a.TUNGGAKANPREMI * ( 
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI) XTUNGGAKAN,                             
                            DECODE(b.KDVALUTA, '1', CEIL(a.BUNGATUNGGAKAN)+ a.BIAYAMATERAI,  
                            '3', CEIL(a.BUNGATUNGGAKAN * ( 
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI, 
                            '0', CEIL(a.BUNGATUNGGAKAN * (  
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI) XBUNGATUNGGAKAN,
                             c.NAMAKLIEN1 CLIENTNAME, B.KDPRODUK                                 
                             FROM $DBUser.TABEL_H2H_PULIH a 
                             INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b 
                             ON  a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
                             AND  a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
                             INNER JOIN $DBUser.tabel_100_klien c                             
                             ON b.NOPEMEGANGPOLIS = c.noklien 
                             INNER JOIN $DBUser.tabel_500_penagih d
                             ON d.NOPENAGIH = b.NOPENAGIH                               
                            WHERE substr(B.KDPRODUK, 0,2)  = 'JL' AND ".$filterkantor."  A.COMPANY_CODE = '$metodebayar' 
							AND TO_CHAR (a.PAID_DATETIME, 'YYYYMMDD') BETWEEN '$tglawal' AND '$tglakhir' ORDER BY a.PAID_DATETIME ASC ";
					
		

	
	}
	
	if($mode == 'print')
	{
		 $sql = "SELECT TO_CHAR (a.PAID_DATETIME, 'DDMMYYYY') TGLBAYAR, 
                            TO_CHAR (a.TGLMOHON, 'DDMMYYYY') TGL_MOHON, 
                            a.COMPANY_CODE, 
                            a.PREFIXPERTANGGUNGAN || a.NOPERTANGGUNGAN NO_POLIS, 
                            NVL (a.TUNGGAKANPREMI, 0) JMLDEBET, 
                            NVL (a.BUNGATUNGGAKAN, 0) BUNGA_TUNGGAKAN, 
                            a.JURNAL_SEQUENCE, 
                            a.PAYMENT_AMOUNT, 
                            b.KDVALUTA,
                            DECODE(b.KDVALUTA, '1', CEIL(a.TUNGGAKANPREMI)+ a.BIAYAMATERAI,  
                            '3', CEIL(a.TUNGGAKANPREMI * ( 
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI,                             
                            '0', CEIL(a.TUNGGAKANPREMI * ( 
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI) XTUNGGAKAN,                             
                            DECODE(b.KDVALUTA, '1', CEIL(a.BUNGATUNGGAKAN)+ a.BIAYAMATERAI,  
                            '3', CEIL(a.BUNGATUNGGAKAN * ( 
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI, 
                            '0', CEIL(a.BUNGATUNGGAKAN * (  
                            SELECT z1.KURS 
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI  z1 
                            WHERE z1.TGLKURSBERLAKU = (SELECT MAX(y1.TGLKURSBERLAKU)  
                            FROM $DBUser.TABEL_999_KURS_TRANSAKSI y1  
                            WHERE y1.KDVALUTA = b.KDVALUTA 
                            AND y1.TGLKURSBERLAKU <= a.PAID_DATETIME) 
                            AND z1.KDVALUTA = b.KDVALUTA 
                            ))+ a.BIAYAMATERAI) XBUNGATUNGGAKAN,
                             c.NAMAKLIEN1 CLIENTNAME, B.KDPRODUK                                 
                             FROM $DBUser.TABEL_H2H_PULIH a 
                             INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b 
                             ON  a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
                             AND  a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
                             INNER JOIN $DBUser.tabel_100_klien c                             
                             ON b.NOPEMEGANGPOLIS = c.noklien 
                             INNER JOIN $DBUser.tabel_500_penagih d
                             ON d.NOPENAGIH = b.NOPENAGIH                               
                            WHERE substr(B.KDPRODUK, 0,2)  = 'JL' AND ".$filterkantor."  A.COMPANY_CODE = '$metodebayar' 
							AND TO_CHAR (a.PAID_DATETIME, 'YYYYMMDD') BETWEEN '$tglawal' AND '$tglakhir' ORDER BY a.PAID_DATETIME ASC ";
					
		

	
	}
	//echo $sql."--<br>";
		
		
		
	  $DB->parse($sql);
	  $DB->execute();
	
  	$i=1;
	$xxTotalTunggakan = 0;
	$xxTotalBunga = 0;
	$xxTotalBayar = 0;
  	
  	while ($arr=$DB->nextrow()) {
		
		$tglbayar			=$arr["TGLBAYAR"];
		$nomorPolis			=$arr["NO_POLIS"];
		$NamapemPol			=$arr["CLIENTNAME"];
		$xTunggakan			=$arr["XTUNGGAKAN"];
		$xBungaTunggakan	=$arr["XBUNGATUNGGAKAN"];
		$xTotalBayar		=$arr["XBUNGATUNGGAKAN"]+$arr["XTUNGGAKAN"];
		$produk				=$arr["KDPRODUK"];
		
		$xxTotalTunggakan += $xTunggakan;
		$xxTotalBunga += $xBungaTunggakan;
		$xxTotalBayar += $xTotalBayar;
		
		
	
		echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	
  	  
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
	
	<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$tglbayar;?></td>
	    
	<td nowrap style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$nomorPolis;?></td>
	
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" ><?=$NamapemPol;?></td>
	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"  align="right"><?=number_format(($xTunggakan),2,",",".");?></td>
	 
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"  align="right"><?=number_format(($xBungaTunggakan),2,",",".");?></td>
	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"  align="right"><?=number_format(($xTotalBayar),2,",",".");?></td>
	
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"  align="right"><?=$produk;?></td>
	
    
	</tr>
	<? 
	$i++;
	
	
	}
	

	?>
	<tr bgcolor="#f5d79c">	 
	 <td colspan="3"><b>JUMLAH</b></td>
	 <td></td>	 
	 <td align="right"><?=number_format($xxTotalTunggakan,2,",",".");?></td>
     <td align="right"><?=number_format($xxTotalBunga ,2,",",".");?></td>
     <td align="right"><?=number_format($xxTotalBayar,2,",",".");?></td>	
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
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_h2h_pulih.php?setproduk=".$setProduk."&jenis=".$jenispremi."&kdbank=UL".$metodebayar."&tgl=".$tglawal."&tgl2=".$tglakhir."&kom=".$kom."&nilai1=".$xxTotalTunggakan."&nilai2=".$xxTotalBunga."&nilai3=".$xxTotalBayar."&nilai4=".$nilai4."&nilai5=".$nilai5."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_h2h_pulih.php?jenispremi=".$jenispremi."&kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&produk=".$produk."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");

}

?>
<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>

</body>
</html>

