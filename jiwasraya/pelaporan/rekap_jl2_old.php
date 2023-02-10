<? 
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/kantor.php";
	//include "../../includes/klien.php";
	
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
//				print ("<option value=0>---</option>");
        for($currentDay = 1; $currentDay<= 31;$currentDay++) 
        { 
            print("<option value=\"$currentDay\""); 
            //if(date( "j", $useDate)==$currentDay) 
			if($selected==$currentDay) 
            { 
                print(" selected"); 
            } 					
            print(">$currentDay\n"); 						
        } 
        print("</select>"); 

// Bulan	
		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
        print("<select name=" . $inName .  "bln>\n"); 
//				print ("<option value=0>------</option>");
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
            //if(date( "n", $useDate)==$currentMonth) 
			if($selected==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

// Tahun				
		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
//        for($currentYear = $startYear - 2; $currentYear <= $startYear+0;$currentYear++) 
        for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            //if(date( "Y", $useDate)==$currentYear) 
			if($selected==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
				//print ("<option value=ALL>*</option>");
        print("</select>"); 
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
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
<body>

<div id="filterbox">
<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
  <table>
	<tr>
  <td>Jenis Pembayaran</td>
	<td>
	  <? 
		switch($metodebayar)
		{
		  case 'MDR': $sa = "selected"; break;
			case 'CTB': $sc = "selected"; break;
			case 'THO': $st = "selected"; break;
			default : $sx = "selected"; break;
		}
		?>
	  <select name="metodebayar">
	  <option value="MDR" <?=$sa;?>>Auto Debet Mandiri</option>
		<option value="CTB" <?=$sc;?>>Credit Card Citibank</option>
		<option value="THO" <?=$st;?>>Transfer Tunai Rek. HO</option>
	</select></td>

 <td>Dari <?=DateSelector("d"); ?> Sampai <?=DateSelector("s"); ?></td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
 
</table>
</form>
</div>
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
	} elseif($metodebayar=="CTB"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 //$filterperiode = "to_char(a.tglrekam,'YYYYMM') = '$bulancari' and ";
		 $filterpenagih = "CITIBANK";
		 $titletrans		= "CITIBANK 1BILL";
	} else {
	   $filterperiode = "to_char(a.tglseatled,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
	   //$filterperiode = "to_char(d.tglbooked,'YYYYMM') = '$bulancari' and ";
		 $filterpenagih = "TRANSFER";
		 $titletrans		= "TRANSFER REK. HO";
	}
?>

<div align="center">
<b>REKAPITULASI PREMI JS LINK  <?=$titletrans;?><br />TANGGAL <?=$tglawal." S/D ".$tglakhir;?> 
<br />SECARA NASIONAL</b><br><br>
</div>

<? 
if($metodebayar=="MDR" || $metodebayar=="CTB"){

$sql = "select ".
            "distinct c.kdrayonpenagih as kdkantor ". 
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_315_pelunasan_auto_debet a,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
   					"b.nopertanggungan=substr(a.nopolis,3,9) and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and a.statuspembayaran='2' and b.kdvaluta='1' and ".
						$filterperiode.
						"b.kdproduk=e.kdproduk ".
						"and substr(b.kdproduk,1,3)='JL2' ".
						"and a.kdbank='".$metodebayar."'";
}
else 
{

		$sql = "select ".
            "distinct c.kdrayonpenagih as kdkantor ". 
          "from ".
            "$DBUser.tabel_300_historis_premi d,".
            "$DBUser.tabel_800_pembayaran a,".
            "$DBUser.tabel_200_pertanggungan b,".
            "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_202_produk e ".
          "where ".
						"b.prefixpertanggungan=a.prefixpertanggungan and ".
   					"b.nopertanggungan=a.nopertanggungan and ".
						"b.prefixpertanggungan=d.prefixpertanggungan and ".
            "b.nopertanggungan=d.nopertanggungan and a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih ".
						"and d.tglseatled is not null ".
						"and ".$filterperiode.
						"b.kdproduk=e.kdproduk ".
						"and a.kb='B' ".
						"and substr(b.kdproduk,1,3)='JL2'";
}
///echo $sql;
		$DB->parse($sql);
	  $DB->execute();
  	$arr = $DB->result();	
?>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>No</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Nomor BPS</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>No.Rekening</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Kode Kantor - Nama Kantor</b></td>
    <td align="center" rowspan="2" bgcolor="#89acd8" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <b>Total</b></td>
  </tr>
	<tr>
	<? 
	/*
		 	 		select k.kdkantor as kodekantor,k.namakantor,q.kdakun,q.namaakunperantara,q.jmlpremi,q.materai 
              from $DBUser.tabel_001_kantor k,
              (
              SELECT c.kdrayonpenagih,'282021' AS kdakun,
                       (SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '282021') namaakunperantara,
                       SUM (TO_NUMBER (d.premitagihan)) AS jmlpremi, SUM (g.nilaimeterai) AS materai
                  FROM $DBUser.tabel_300_historis_premi d,
                       $DBUser.tabel_315_pelunasan_auto_debet a,
                       $DBUser.tabel_200_pertanggungan b,
                       $DBUser.tabel_500_penagih c,
                       $DBUser.tabel_202_produk e,
                       $DBUser.tabel_999_batas_materai g
                 WHERE b.prefixpertanggungan = SUBSTR (a.nopolis, 1, 2)
                   AND b.nopertanggungan = SUBSTR (a.nopolis, 3, 9)
                   AND b.prefixpertanggungan = d.prefixpertanggungan
                   AND b.nopertanggungan = d.nopertanggungan
                   AND SUBSTR (b.kdproduk, 1, 3) = 'JL2'
                   AND a.tglbooked = d.tglbooked
                   AND b.nopenagih = c.nopenagih
                   AND a.statuspembayaran = '2'
                   AND TO_CHAR (a.tglrekam, 'YYYYMMDD') BETWEEN '20081201' AND '20081219'
                   AND b.kdproduk = e.kdproduk
                   AND a.kdbank = 'MDR'
                   AND TO_NUMBER (d.premitagihan) BETWEEN g.batasbawahpremi AND g.batasataspremi
              GROUP BY c.kdrayonpenagih) q 
              where 
              k.kdkantor=q.kdrayonpenagih(+)
							and k.kdjeniskantor='2'
              order by k.kdkantor

  $sqx = "select k.kdkantor as kodekantor,k.namakantor,q.kdakun,q.namaakunperantara,q.jmlpremi ".
          "from $DBUser.tabel_001_kantor k, ".
          "(SELECT c.kdrayonpenagih ,'282021' AS kdakun, ".
                   "(SELECT nama FROM $DBUser.tabel_802_kodeakun WHERE akun = '282021') namaakunperantara, ".
                   "SUM (TO_NUMBER (a.premi)) AS jmlpremi ".
              "FROM $DBUser.tabel_800_pembayaran a, ".
                   "$DBUser.tabel_200_pertanggungan b, ".
                   "$DBUser.tabel_500_penagih c, ".
                   "$DBUser.tabel_202_produk e, ".
                   "$DBUser.tabel_001_kantor f ".
             "WHERE b.prefixpertanggungan = a.prefixpertanggungan ".
               "AND b.nopertanggungan = a.nopertanggungan ".
               "AND SUBSTR (b.kdproduk, 1, 3) = 'JL2' ".
               "AND a.kdpembayaran IN ('001', '003') ".
               "AND b.nopenagih = c.nopenagih ".
							 $filterperiode.
               //AND TO_CHAR (a.tglseatled, 'YYYYMMDD') BETWEEN '20081201' AND '20081219'
               "AND c.kdrayonpenagih = f.kdkantor ".
               "AND b.kdproduk = e.kdproduk ".
               "and a.kb='B'   ".
          "GROUP BY c.kdrayonpenagih, f.namakantor) q ".
          "where  ".
          "k.kdkantor=q.kdrayonpenagih(+) ".
					"and k.kdjeniskantor='2' ".
          "order by k.kdkantor";
	*/
	//$DB->parse($sqx);
	//$DB->execute();
  //$arr = $DB->result();	
		
	$i=1;
  $total=0;
	foreach ($arr as $foo => $row ) {
		$kdrayonpenagih = $row["KDKANTOR"];
	  if($metodebayar=="MDR" || $metodebayar=="CTB"){
  	$sql = "select ".
              "c.kdrayonpenagih as kodekantor,".
              "f.namakantor as namakantor,".
//              "'282021' as kdakun,".
//							"(select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "'148440000' as kdakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148440000') namaakunperantara,".
							"sum(to_number(d.premitagihan)) as jmlpremi, ".
							"sum(g.nilaimeterai) as materai ".
           "from ".
					 		"$DBUser.tabel_300_historis_premi d,".
							"$DBUser.tabel_315_pelunasan_auto_debet a,".
							"$DBUser.tabel_200_pertanggungan b,".
							"$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e, $DBUser.tabel_001_kantor f, $DBUser.tabel_999_batas_materai g ".
					  "where b.prefixpertanggungan=substr(a.nopolis,1,2) and ".
              "b.nopertanggungan=substr(a.nopolis,3,9) and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
							"substr(b.kdproduk,1,3)='JL2' and ".
              "a.tglbooked=d.tglbooked and ".
              "b.nopenagih=c.nopenagih and ".
              "a.statuspembayaran='2' and ".
              $filterperiode.
							"c.kdrayonpenagih=f.kdkantor and ".
              "c.kdrayonpenagih='$kdrayonpenagih' and ".
							"b.kdproduk=e.kdproduk and a.kdbank='".$metodebayar."' ".
           		"AND to_number(d.premitagihan) between g.batasbawahpremi and g.batasataspremi ".
					 "group by c.kdrayonpenagih,f.namakantor";
    }
		else
		{
		$sql = "select ".
              "c.kdrayonpenagih as kodekantor,".
              "f.namakantor as namakantor,".
//              "'282021' as kdakun,".
//							"(select nama from $DBUser.tabel_802_kodeakun where akun='282021') namaakunperantara,".
              "'148440000' as kdakun,".
							"(select nama from $DBUser.tabel_802_kodeakun where akun='148440000') namaakunperantara,".
							"sum(to_number(a.premi)) as jmlpremi ".
           "from ".
					 		"$DBUser.tabel_300_historis_premi d,".
							"$DBUser.tabel_800_pembayaran a,".
							"$DBUser.tabel_200_pertanggungan b,".
							"$DBUser.tabel_500_penagih c, ".
					    "$DBUser.tabel_202_produk e, ".
							"$DBUser.tabel_001_kantor f ".
					  "where b.prefixpertanggungan=a.prefixpertanggungan and ".
              "b.nopertanggungan=a.nopertanggungan and ".
              "b.prefixpertanggungan=d.prefixpertanggungan and ".
              "b.nopertanggungan=d.nopertanggungan and ".
							"substr(b.kdproduk,1,3)='JL2' and ".
              "a.tglbooked=d.tglbooked and ".
							"a.kdpembayaran in ('001','003') and ".
              "b.nopenagih=c.nopenagih and ".
              $filterperiode.
							"c.kdrayonpenagih=f.kdkantor and ".
              "c.kdrayonpenagih='$kdrayonpenagih' ".
							"and a.kb='B' ".
							"and b.kdproduk=e.kdproduk ".
           "group by c.kdrayonpenagih,f.namakantor";
    }
	
	//echo $sql."<br /><br />";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();	
	?>	
	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDAKUN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"> <?=$arr["KODEKANTOR"];?> - <?=$arr["NAMAKANTOR"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["JMLPREMI"],2,",",".");?></td>
	</tr>
	<? 
	if($metodebayar=="MDR" || $metodebayar=="CTB"){
		 $sql = "select ".
            "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
            "d.tglbooked as tglbuk,d.kdkuitansi,d.premitagihan,d.kdrekeninglawan,".
						"to_number(a.jumlahtagihan) as jmlpremi,a.nourut,".
            "a.nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
						"a.nokontrol,to_number(a.norekdebet) as norekdebet,a.norekkredit,a.statuspembayaran,".
						"a.beritakredit,a.statuspembayaran, ".
						"a.tglrekam,to_char(d.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
						"to_char(d.tglbayar,'MM/YYYY') as blnbayar,".
						"b.nopenagih,b.noagen,b.norekeningdebet, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
						"ceil(months_between(a.tglupdated,b.mulas)/12) as thnkomisi, ".
						"(select komisiagencb from $DBUser.tabel_404_temp ". 
               "where prefixpertanggungan=b.prefixpertanggungan ". 
            	 "and nopertanggungan=b.nopertanggungan ".
            	 "and thnkomisi= ceil(months_between(a.tglupdated,b.mulas)/12) ".
            	 "and kdkomisiagen='01') komisiagen, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.noagen) as namaagen, ".
						"e.kdcabas, ".
						"(select nilaimeterai from $DBUser.tabel_999_batas_materai ".
  					 "where to_number(d.premitagihan) between ".
             "batasbawahpremi and batasataspremi ".
             ") as matere ".
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
            "a.tglbooked=d.tglbooked and ".
            "b.nopenagih=c.nopenagih and ".
						"a.statuspembayaran='2' and ".
						"b.kdvaluta='1' and ".
						$filterperiode.
						"b.kdproduk=e.kdproduk ".
						"and substr(b.kdproduk,1,3)='JL2' ".
						"and a.kdbank='".$metodebayar."' ".
					"order by d.kdkuitansi";
		}	
//		echo $sql."<br /><br />";
	  $DBA->parse($sql);
	  $DBA->execute();
	  
	$totaldiskon =0;	
  	while ($arx=$DBA->nextrow()) {
		$tglbayar=$arx["TGLBAYAR"];

	  $kdkui = substr($arx["KDKUITANSI"],0,2);
  		if($kdkui=="NB" || $kdkui=="BP")
  		{
  		  $preminb = $arX["PREMITAGIHAN"];
  			$premiob = 0;
  			$discountnb = 0;
  			$discountob = 0;
  			$matrenb		= $arx["MATERE"];
  			$matreob		= 0;
  			$totaldebetnb = $arx["PREMITAGIHAN"];
  			$totaldebetob = 0;
  			$jnb++;
  			${"kdreknb".$cabas} = $arx["KDREKENINGLAWAN"];
  		}
  		elseif($kdkui=="OB")
  		{
  		  $premiob = $arx["PREMITAGIHAN"];
  			$preminb = 0;
  			$discountob = 0;
  			$discountnb = 0;
  			$matreob		= $arx["MATERE"];
  			$matrenb		= 0;
  			$totaldebetob = $arx["PREMITAGIHAN"];
  			$totaldebetnb = 0;
  			$job++;
  			${"kdrekob".$cabas} = $arx["KDREKENINGLAWAN"];
  		}

		if($arx["BLNBAYAR"]!=$arx["BLNTAGIHAN"] || $metodebayar=="CTB" || $metodebayar=="THO" )
		{
		  $matere=$arx["MATERE"];
		  $discount = 0;
			$discountnb = 0;
			$discountob = 0;
		}
		else
		{
		  $discount = ($arx["PREMITAGIHAN"]* 0.01);
		  $matere=$arx["MATERE"];
			
			if($kdkui=="NB" || $kdkui=="BP")
	  {
				$materenb=$arx["MATERE"];
				 $discountnb = ($arx["PREMITAGIHAN"]* 0.01);
			} elseif($kdkui=="OB") {
				$matereob=$arx["MATERE"];
			   $discountob = ($arx["PREMITAGIHAN"]* 0.01);
			}
		}		
		$diskon = $discount;
		$totaldiskon += $diskon;
	}

//	$diskon = $arr["JMLPREMI"]* 0.01;
//	$totaldiskon += $diskon;

  $total=$total+$arr["JMLPREMI"];
	$materai += $arr["MATERAI"];
	$i++;
	} 
	$total = $total - $totaldiskon + $materai;
	?>
	
  <? 
  	$nilai1=$total + $totaldiskon - $materai;
	$nilai2='';
	$nilai3='';
  
  if($metodebayar=="MDR"){ ?>
	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><!--553000-->611130000</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">DISCOUNT PREMI</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">(<?=number_format($totaldiskon,2,",",".");?>)</td>
	</tr>
	<tr>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=$i+1;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"></td>		
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><!--604000-->622102000</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">MATERAI</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($materai,2,",",".");?></td>
	</tr>
	<? 
		$nilai2=$totaldiskon;
		$nilai3=$materai;
	} 
	?>
	<tr bgcolor="#f5d79c">
	 <td></td>
	 <td colspan="3" align="center"><b>T O T A L</b></td>
	 <td align="right"><?=number_format($total,2,",",".");?></td>
	</tr>
	
</table>	

<?	
$kom=$total;

echo("<font face=Verdana size=1><a href=\"index.php\">Menu Pelaporan</a></font>");
echo("<font face=Verdana size=1>&nbsp;&nbsp;&nbsp;</font>");
echo("<font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../akunting/cetakslip_autodebet.php?kdbank=UL".$metodebayar."&tgl=".$tglbayar."&kom=".$kom."&nilai1=".$nilai1."&nilai2=".$nilai2."&nilai3=".$nilai3."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">Cetak SLIP</a></font>");
?>

</body>
</html>