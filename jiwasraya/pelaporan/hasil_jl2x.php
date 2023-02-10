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
<body>

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
 <td>Dari <?=DateSelector("d"); ?> Sampai <?=DateSelector("s"); ?></td>
 <td colspan="2"><input type="submit" name="submit" value="Cari"</input></td>
 </tr>
</table>
</form>
</div>
<?
	$tglawal	=	$_POST['dthn'] . 
					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) .
					( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] );
	$tglakhir	=	$_POST['sthn'] . 
					( (strlen($_POST['sbln'])==1) ? '0'.$_POST['sbln'] : $_POST['sbln'] ) .
					( (strlen($_POST['stgl'])==1) ? '0'.$_POST['stgl'] : $_POST['stgl'] );
	//echo '<hr />'. $tglawal . ' - '.$tglakhir.'<hr />';
	if($metodebayar=="MDR"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "MANDIRI";
		 $titletrans		= "AUTO DEBET MANDIRI";
	} elseif($metodebayar=="CTB"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterpenagih = "CITIBANK";
		 $titletrans		= "CITIBANK 1BILL";
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
?>
<b>DAFTAR TRANSAKSI JS LINK <?=$titletrans;?><br /> </b>
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
		<td bgcolor="#89acd8" align="center" rowspan="2">Discount</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Materai</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Total Debet</td>
		<td bgcolor="#89acd8" align="center" colspan="3">Komisi Penutupan</td>
    <td bgcolor="#89acd8" align="center" rowspan="2">Nama Penutup</td>
  </tr>
	<tr>
    <td bgcolor="#89acd8" align="center">TH.1</td>
    <td bgcolor="#89acd8" align="center">TH.2</td>
    <td bgcolor="#89acd8" align="center">TH.3</td>
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
						$filterkantor.
						"b.kdproduk=e.kdproduk ".
						"and substr(b.kdproduk,1,3)='JL2' ".
						"and a.kdbank='".$metodebayar."' ".
					"order by d.kdkuitansi";
					
		} else {
		
			$sql = "select ".
                "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,b.kdvaluta,".
                "a.tglbooked as tglbuk,a.nilaipembayaran as premitagihan,a.kdrekeninglawan,".
								"to_number(a.premi) as jmlpremi,".
                "a.nopertanggungan as nopolis,to_char(a.tglbooked,'MM/YYYY') as blntagihan,".
    						"a.tglrekam,to_char(a.tglbayar,'DD/MM/YYYY') as tglbayar,a.tglupdated,".
    						"to_char(a.tglbayar,'MM/YYYY') as blnbayar,".
    						"b.nopenagih,b.noagen,b.norekeningdebet, ".
    						"ceil(months_between(a.tglbooked,b.mulas)/12) as thnkomisi, ".
    						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopembayarpremi) as namaklien, ".
    						"(select komisiagencb from $DBUser.tabel_404_temp ". 
                   "where prefixpertanggungan=b.prefixpertanggungan ". 
                	 "and nopertanggungan=b.nopertanggungan ".
                	 "and thnkomisi= ceil(months_between(a.tglbooked,b.mulas)/12) ".
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
		//echo $sql."<br /><br />";
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
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right">
		<?
			if($arr["BLNBAYAR"]!=$arr["BLNTAGIHAN"] || $metodebayar=="CTB" || $metodebayar=="THO" )
			{
			  $discount = 0;
				$discountnb = 0;
				$discountob = 0;
			}
			else
			{
			  $discount = ($arr["PREMITAGIHAN"]* 0.01);
				
				if($kdkui=="NB" || $kdkui=="BP")
  		  {
				 	 $discountnb = ($arr["PREMITAGIHAN"]* 0.01);
				} elseif($kdkui=="OB") {
				   $discountob = ($arr["PREMITAGIHAN"]* 0.01);
				}
			}
			echo number_format($discount,2,",",".");
		?>
		</td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["MATERE"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format(($arr["PREMITAGIHAN"]),2,",",".");?></td>
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
	$jmlmatre+=$matre;
	$jmldiscount +=$discount;
	$jmltotaldebet += $arr["JMLPREMI"];
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
	 <td align="right"><?=number_format($jmldiscount,2,",",".");?></td>
	 <td align="right"><?=number_format($jmlmatre,2,",",".");?></td>
	 <td align="right"><?=number_format($jmltotaldebet,2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith1".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith2".$cabas},2,",",".");?></td>
	 <td align="right"><?=number_format(${"totkomisith3".$cabas},2,",",".");?></td>
	 <td></td>
	</tr>
	
</table>
<br />
<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>
<hr size="1" />
<a href="index.php">Menu Pelaporan</a>

</body>
</html>
