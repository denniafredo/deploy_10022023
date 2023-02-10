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
		switch($produk)
		{
		  case 'JL2': $ja = "selected"; break;
		  case 'JL3': $jb = "selected"; break;
		  case 'JL4': $jb = "selected"; break;
			default : $ja = "selected"; break;
		}
		?>
	  <select name="produk">
	  <option value="JL2" <?=$ja;?>>JL2</option>
	  <option value="JL3" <?=$jb;?>>JL3</option>
	  <option value="JL4" <?=$jb;?>>JL4</option>
      <option value="ALL" <?=$jb;?>>ALL</option>
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
			case 'BIMA': $sj = "selected"; break;
			case 'VBN': $sk = "selected"; break;
			case 'MD5': $sl = "selected"; break;
			case 'MD9': $sm = "selected"; break;
			case 'MD6': $sn = "selected"; break;
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
      <option value="VBN" <?=$sk;?>>VA BNI</option>
	  <option value="MD5" <?=$sl;?>>Mandiri 521</option>
	  <option value="MD9" <?=$sm;?>>Mandiri 943</option>
	  <option value="MD6" <?=$sn;?>>Mandiri 644</option>
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
		$filterjenispremi=" d.kdkuitansi='BP3' AND ";
		$filterrider=" d.tglbooked is null and ";
	} else {
		$filterjenispremi=" d.kdkuitansi<>'BP3' AND ";
		$filterrider="";
	}
	
	
	if($metodebayar=="MDR"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
    } elseif($metodebayar=="MD5"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "MANDIRI 521";
    } elseif($metodebayar=="MD9"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "MANDIRI 943";
	} elseif($metodebayar=="MD6"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "MANDIRI 644";
	} elseif($metodebayar=="BMRI"){
	   $filterperiode = "to_char(a.entry_time,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "H2H MANDIRI";
    } elseif($metodebayar=="BBRI"){
	   $filterperiode = "to_char(a.entry_time,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BRI";
		 $titletrans		= "H2H BRI";
	} elseif($metodebayar=="BIMA"){
	   $filterperiode = "to_char(a.entry_time,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "BIMSAKTI";
		 $titletrans		= "H2H Bimasakti";

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
	}	else if (!empty($kdkantor))	{
		  $filterkantor = "c.kdrayonpenagih='$kdkantor' and ";
	}	else {
		$filterkantor = "";
	}
   //echo 'produk '.$produk;
   //die;
   if($produk=="ALL"){
		  $filterproduk = "and substr(b.kdproduk,1,3) in ('JL2','JL3','JL4') ";
    }	
	elseif (!empty($produk))	{
		  $filterproduk = "and substr(b.kdproduk,1,3)='".$produk."' ";}
	elseif (strlen($produk)>0)	{
		  $filterproduk = "and substr(b.kdproduk,1,3)='".$produk."' ";}
	else {$filterproduk = "";
	}
	
	//echo 'filterproduk '.$filterproduk;
	//echo 'len'.strlen($produk);
    //die;
	
	if ($_GET['kdproduk']=="TRD"){
		$filterproduk=" and substr(b.kdproduk,1,3) not in ('JL2','JL3','JL4') ";
	}elseif($produk=="ALL"){
		 $filterproduk = "and substr(b.kdproduk,1,3) in ('JL2','JL3','JL4') ";
    }
	elseif (strlen($produk)>0)	{
		  $filterproduk = "and substr(b.kdproduk,1,3)='".$produk."' ";}	
	else {
		$filterproduk = "";
	}
	//echo 'pro'.$filterproduk;
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
	if ($metodebayar=="CTB" || $metodebayar=="MD9" || $metodebayar=="MD6" || $metodebayar=="MD5" || $metodebayar=="POS" ){
  $materenye="(select 0 from $DBUser.tabel_999_batas_materai where (to_number(a.jumlahtagihan))-6000 between batasbawahpremi and batasataspremi ) as matere, ";
  }else{
  $materenye="decode(substr(e.kdproduk,0,4),'JL4X',0,'JL4B',0,(select nilaimeterai from $DBUser.tabel_999_batas_materai where (to_number(a.jumlahtagihan)/100)-6000 between batasbawahpremi and batasataspremi )) as matere, ";
  }
  
  //echo $materenye."<br>";
	if($metodebayar=="MD9" || $metodebayar=="MD6" || $metodebayar=="MD5" || $metodebayar=="MDR" || $metodebayar=="BNI"  || $metodebayar=="BRI" || $metodebayar=="CBN" || $metodebayar=="CTB" || $metodebayar=="POS"){
		 $sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,b.premistd as premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan) as jmlpremi,b.premi1 AS preminya,a.nourut,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
						"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
						"to_char(d.tglbayar,'YYYYMM') as blnbayarnya,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
            	 "and nopertanggungan=b.nopertanggungan ".
            	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
            	 "and kdkomisiagen='01') komisiagen, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".$materenye.
			 "(select max(premitagihan) from $DBUser.tabel_300_historis_rider where 
            		 prefixpertanggungan = b.prefixpertanggungan
                     AND nopertanggungan = b.nopertanggungan
                     and to_char(tglbooked,'mmyyyy')=to_char(a.tglbooked,'mmyyyy') ) rider ".
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".
            "to_char(a.tglbooked,'mmyyyy')=to_char(d.tglbooked,'mmyyyy') and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta in ('1','3') and ".
						$filterperiode.
						$filterkantor.
						"b.kdproduk=e.kdproduk ".
						$filterproduk.
						"and a.kdbank='".$metodebayar."' ".
						" UNION ".
						"select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,'NB' kdkuitansi,b.premistd as premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan) as jmlpremi,b.premi1 AS preminya,a.nourut,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
						"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
						"to_char(d.tglbayar,'YYYYMM') as blnbayarnya,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
            	 "and nopertanggungan=b.nopertanggungan ".
            	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
            	 "and kdkomisiagen='01') komisiagen, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".$materenye.
			 "(select max(premitagihan) from $DBUser.tabel_300_historis_rider where 
            		 prefixpertanggungan = b.prefixpertanggungan
                     AND nopertanggungan = b.nopertanggungan
                     and to_char(tglbooked,'mmyyyy')=to_char(a.tglbooked,'mmyyyy') ) rider ".
          "from ".
            "$DBUser.tabel_300_historis_rider d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_rider a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".            
			"to_char(a.tglbooked,'mmyyyy')=to_char(d.tglbooked,'mmyyyy') and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						$filterperiode.
						$filterkantor.
						"b.kdproduk=e.kdproduk ".
						$filterproduk.
						"and a.kdbank='".$metodebayar."' ".
					"order by  prefixpertanggungan, nopertanggungan, kdkuitansi";
					
		} 
		else if($metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA"){
		 $sql = "SELECT   c.kdrayonpenagih,
					   b.prefixpertanggungan,
					   b.nopertanggungan,
					   b.kdvaluta,
					   d.tglbooked AS tglbuk,
					   d.kdkuitansi,
					   b.premistd AS premitagihan,
					   b.premi1 AS preminya,
					   d.kdrekeninglawan,
					   TO_NUMBER (a.bill_amount*100) AS jmlpremi,
					   null nourut,
					   a.no_polis,
					   TO_CHAR (a.tgl_booked, 'MM/YYYY') AS blntagihan,
					   null nokontrol,
					   null norekdebet,
					   null norekkredit,
					   a.void statuspembayaran,
					   null beritakredit,
					   a.void statuspembayaran,
					   a.entry_time,
					   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
					   a.entry_time,
					   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
					   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
					   b.nopenagih,
					   b.noagen,
					   b.norekeningdebet,
					   (SELECT   namaklien1
						  FROM   $DBUser.tabel_100_klien
						 WHERE   noklien = b.nopembayarpremi)
						  AS namaklien,
					   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12) AS thnkomisi,
					   (SELECT   komisiagencb
						  FROM   $DBUser.tabel_404_temp
						 WHERE   prefixpertanggungan = b.prefixpertanggungan
								 AND nopertanggungan = b.nopertanggungan
								 AND thnkomisi =
									   CEIL (MONTHS_BETWEEN (a.entry_time, b.mulas) / 12)
								 AND kdkomisiagen = '01')
						  komisiagen,
					   (SELECT   namaklien1
						  FROM   $DBUser.tabel_100_klien
						 WHERE   noklien = b.noagen)
						  AS namaagen,
					   e.kdcabas,
					   0 matere,
					   (SELECT   max(premitagihan)
						  FROM   $DBUser.tabel_300_historis_rider
						 WHERE   prefixpertanggungan = b.prefixpertanggungan
								 AND nopertanggungan = b.nopertanggungan
								 AND TO_CHAR (tglbooked, 'mmyyyy') =
									   TO_CHAR (a.tgl_booked, 'mmyyyy'))
						  rider
				FROM   $DBUser.tabel_300_historis_premi d,
					   $DBUser.tabel_200_pertanggungan b,
					   $DBUser.tabel_315_pelunasan_h2h a,
					   $DBUser.tabel_500_penagih c,
					   $DBUser.tabel_202_produk e
			   WHERE       b.prefixpertanggungan = SUBSTR (a.no_polis, 1, 2)
					   AND b.nopertanggungan = SUBSTR (a.no_polis, 3, 9)
					   AND b.prefixpertanggungan = d.prefixpertanggungan
					   AND b.nopertanggungan = d.nopertanggungan
					   AND to_char(a.tgl_booked,'mmyyyy')=to_char(d.tglbooked,'mmyyyy')
					   AND b.nopenagih = c.nopenagih
					   AND a.void = '0'
					   AND b.kdvaluta = '1'
					   and ".$filterperiode.
					   $filterkantor.$filterjenispremi.
					   " b.kdproduk = e.kdproduk ".
					  $filterproduk.
					  " AND a.company_code = '".$metodebayar."' 
			ORDER BY   b.prefixpertanggungan, b.nopertanggungan, d.kdkuitansi";
			//echo $sql; die;
		}
		else if($metodebayar=="VBN"){
		 $sql = "SELECT   c.kdrayonpenagih,
			   b.prefixpertanggungan,
			   b.nopertanggungan,
			   b.kdvaluta,
			   d.tglbooked AS tglbuk,
			   d.kdkuitansi,
			   b.premistd+(NVL((SELECT   premi
				  FROM   $DBUser.tabel_223_transaksi_produk
				 WHERE   prefixpertanggungan = b.prefixpertanggungan
				 AND nopertanggungan=b.nopertanggungan
				 AND kdbenefit='BNFTOPUP'),0))+DECODE(d.kdkuitansi,'BP3',(NVL((SELECT   premi
				  FROM   $DBUser.tabel_223_transaksi_produk
				 WHERE   prefixpertanggungan = b.prefixpertanggungan
				 AND nopertanggungan=b.nopertanggungan
				 AND kdbenefit='BNFTOPUPSG'),0)),0) AS premitagihan,
			   d.kdrekeninglawan,
			   TO_NUMBER (a.JUMLAHTAGIHAN) AS jmlpremi,
			   b.PREMI1++ DECODE (
                d.kdkuitansi,
                'BP3',
                (NVL (
                    (SELECT   premi
                       FROM   $DBUser.tabel_223_transaksi_produk
                      WHERE       prefixpertanggungan = b.prefixpertanggungan
                              AND nopertanggungan = b.nopertanggungan
                              AND kdbenefit = 'BNFTOPUPSG'),
                    0
                 )),
                0
             ) PREMINYA,
			   NULL nourut,
			   a.nopolis,
			   TO_CHAR (a.tglbooked, 'MM/YYYY') AS blntagihan,
			   NULL nokontrol,
			   NULL norekdebet,
			   NULL norekkredit,
			   statuspembayaran,
			   NULL beritakredit,
			   statuspembayaran,
			   a.tglrekam,
			   TO_CHAR (d.tglbayar, 'DD/MM/YYYY') AS tglbayar,
			   a.tglrekam,
			   TO_CHAR (d.tglbayar, 'MM/YYYY') AS blnbayar,
			   TO_CHAR (d.tglbayar, 'YYYYMM') AS blnbayarnya,
			   b.nopenagih,
			   b.noagen,
			   b.norekeningdebet,
			   (SELECT   namaklien1
				  FROM   $DBUser.tabel_100_klien
				 WHERE   noklien = b.nopembayarpremi)
				  AS namaklien,
			   CEIL (MONTHS_BETWEEN (a.tglrekam, b.mulas) / 12) AS thnkomisi,
			   (SELECT   komisiagencb
				  FROM   $DBUser.tabel_404_temp
				 WHERE   prefixpertanggungan = b.prefixpertanggungan
						 AND nopertanggungan = b.nopertanggungan
						 AND thnkomisi =
							   CEIL (MONTHS_BETWEEN (a.tglrekam, b.mulas) / 12)
						 AND kdkomisiagen = '01')
				  komisiagen,
			   (SELECT   namaklien1
				  FROM   $DBUser.tabel_100_klien
				 WHERE   noklien = b.noagen)
				  AS namaagen,
			   e.kdcabas,
			   0 matere,
			   (SELECT   max(premitagihan)
				  FROM   $DBUser.tabel_300_historis_rider
				 WHERE   prefixpertanggungan = b.prefixpertanggungan
						 AND nopertanggungan = b.nopertanggungan
						 AND TO_CHAR (tglbooked, 'mmyyyy') =
							   TO_CHAR (a.tglbooked, 'mmyyyy'))
				  rider, selisih
		FROM   $DBUser.tabel_300_historis_premi d,
			   $DBUser.tabel_200_pertanggungan b,
			   $DBUser.tabel_315_pelunasan_va a,
			   $DBUser.tabel_500_penagih c,
			   $DBUser.tabel_202_produk e ".
			   "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".
            "to_char(a.tglbooked,'mmyyyy')=to_char(d.tglbooked,'mmyyyy') and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						$filterperiode.
						$filterkantor.$filterjenispremi.
						"b.kdproduk=e.kdproduk ".
						$filterproduk.
						"and a.kdbank='".$metodebayar."' ".
						" UNION ".
						"select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,'NB' kdkuitansi,b.premistd as premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan) as jmlpremi,b.premi1 AS preminya,a.nourut,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
						"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
						"to_char(d.tglbayar,'YYYYMM') as blnbayarnya,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
            	 "and nopertanggungan=b.nopertanggungan ".
            	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
            	 "and kdkomisiagen='01') komisiagen, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, 0 matere, ". //$materenye.
			 "(select max(premitagihan) from $DBUser.tabel_300_historis_rider where 
            		 prefixpertanggungan = b.prefixpertanggungan
                     AND nopertanggungan = b.nopertanggungan
                     and to_char(tglbooked,'mmyyyy')=to_char(a.tglbooked,'mmyyyy') ) rider, selisih ".
          "from ".
            "$DBUser.tabel_300_historis_rider d,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_315_pelunasan_auto_rider a,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and ".
            //"a.tglbooked=d.tglbooked and ".
			"to_char(a.tglbooked,'mmyyyy')=to_char(d.tglbooked,'mmyyyy') and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						$filterrider.
						$filterperiode.
						$filterkantor.
						"b.kdproduk=e.kdproduk ".
						$filterproduk.						
						"and a.kdbank='".$metodebayar."' ".
					"order by  prefixpertanggungan, nopertanggungan, kdkuitansi";
					
		}
		else {
		
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
		}	
		//echo "<br /> ".$filterproduk."<br />";
		//echo $sql;
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
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
    <!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["PREMITAGIHAN"])-$arr["RIDER"],2,",",".");?></td>-->
    <?
    // untuk pengenaan materai terhadap pelunasan autodebet
    if(($arr["JMLPREMI"]/100)-$arr["RIDER"]-$arr["MATERE"]!=0){
    if($metodebayar=="CTB" ){    // payment statement tidak menggunakan materai
    echo number_format(($arr["JMLPREMI"])-$arr["RIDER"]-$arr["MATERE"],2,",",".");
    }
	else if($metodebayar=="VBN" ){    // payment statement tidak menggunakan materai
    //echo number_format(($arr["PREMITAGIHAN"])-$arr["RIDER"]-$arr["MATERE"],2,",",".");
    echo number_format(($arr["PREMITAGIHAN"]),2,",",".");
	}
	else{
    echo number_format(($arr["JMLPREMI"]/100)-$arr["RIDER"]-$arr["MATERE"],2,",",".");
    }
    }else{
    echo "0";
    }
	
	if($jenispremi=="pertamax"){
		$bipolis=(($arr["JMLPREMI"]/100)-$arr["PREMINYA"]);} else {
		$bipolis=0;}
    ?>
    </td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($bipolis,2,",",".");?></td>
	
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["RIDER"],2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		<?
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"] || $metodebayar=="BMRI" || $metodebayar=="BBRI" || $metodebayar=="BIMA" || $metodebayar=="CBN" || $metodebayar=="CTB" || $metodebayar=="POS" || $metodebayar=="THO" )
			{
			  	$matere=$arr["MATERE"];
			  	$discount = 0;
				$discountnb = 0;
				$discountob = 0;
			}
			else
			{
			  	if ($arr["BLNBAYARNYA"]>='201111') {
					$matere=$arr["MATERE"];
					$discount = 0;
					$discountnb = 0;
					$discountob = 0;
				}
				else {
					$discount = ($arr["PREMITAGIHAN"]* 0.01);
					$matere=$arr["MATERE"];
					
					if($kdkui=="NB" || $kdkui=="BP")
					{
						$materenb=$arr["MATERE"];
						 $discountnb = ($arr["PREMITAGIHAN"]* 0.01);
					} elseif($kdkui=="OB") {
						$matereob=$arr["MATERE"];
					   $discountob = ($arr["PREMITAGIHAN"]* 0.01);
					}
				}
			}
			echo number_format($discount,2,",",".");
		?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["MATERE"],2,",",".");?></td>
<!--
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["PREMITAGIHAN"]),2,",",".");?></td>
-->
    <!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["PREMITAGIHAN"]+$arr["MATERE"]-$discount),2,",",".");?></td>-->
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
    <?
    if($metodebayar=="CTB" ){  // payment statement tidak menggunakan materai
    echo number_format($arr["JMLPREMI"],2,",",".");
    }else{
    //echo number_format(($arr["JMLPREMI"]/100) + $bipolis ,2,",",".");
	echo number_format(($arr["JMLPREMI"]/100) ,2,",","."); // attar 18/12/2014
    }
	
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
    </td>
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
	
 if($metodebayar=="CTB" ){  // payment statement tidak menggunakan materai
 $jmlpremi += ($arr["JMLPREMI"])-$arr["RIDER"]-$arr["MATERE"]-$discount-$arr["SELISIH"];
 }else{
 $jmlpremi += ($arr["JMLPREMI"]/100)-$arr["RIDER"]-$arr["MATERE"]-$discount-$bipolis-$arr["SELISIH"];
 }

	$jmlpremir += $arr["RIDER"];
	
	$prevcabas = $arr["KDCABAS"];
	}

	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="4"><b>JUMLAH</b></td>
	 <td></td>
	 <td></td>
	 <td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
     <td align="right"><?=number_format($jmlbipolis ,2,",",".");?></td>
     <td align="right"><?=number_format($jmlpremir,2,",",".");?></td>
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?
   if($metodebayar=="CTB" ){  // payment statement tidak menggunakan materai
   echo number_format($jmltotaldebet,2,",",".");
   }else{
   //echo number_format(($jmltotaldebet/100) + $jmlbipolis,2,",",".");
   echo number_format(($jmltotaldebet/100),2,",","."); //attar 18/12/2014
   $jmltotaldebet=$jmltotaldebet/100;
   }
   ?></td>
   <td align="right"><?=number_format($jmltotalselisih,2,",",".");?></td>
	 <td></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
</table>
<?	
$kom=$jmltotaldebet;
$nilai1=($jmlpremi+$jmlpremir);
//$nilai1=$jmlpremi+$jmlpremir-$jmltotalselisih;  --> comment by salman 21/06/2016
$nilai2=$jmldiscount;
$nilai3=$jmlmatre;
//$nilai1=$jmltotaldebet+$jmldiscount-$nilai3-$jmltotalselisih; // --> add by salman 21/06/2016( biar jumlah total sama dengan rincian)
$nilai4=$jmltotalselisih;
$nilai5=$jmlbipolis;

if ($mode!='print'){

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet.php?jenis=".$jenispremi."&kdbank=UL".$metodebayar."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."&nilai4=".$nilai4."&nilai5=".$nilai5."','','width=800,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak SLIP</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;|&nbsp;&nbsp;</font>");
//echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_jl2.php?kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>"); kdproduk blm ada
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('hasil_jl2.php?jenispremi=".$jenispremi."&kdkantor=".$kdkantor."&metodebayar=".$metodebayar."&dtgl=".$dtgl."&dbln=".$dbln."&dthn=".$dthn."&stgl=".$stgl."&sbln=".$sbln."&sthn=".$sthn."&produk=".$produk."&mode=print','','width=1000,height=600,top=100,left=100,scrollbars=yes');\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak Lampiran</a></font>");
}

?>
<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>

<a href="hasil_h2h.php">H2H</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="hasil_h2h_pulih.php">H2H Pemulihan</a>

</body>
</html>
