<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
	
$DB=new database($userid, $passwd, $DBName);
	
function DateSelector($inName, $useDate=0) 
{ 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  
      		// Tanggal
/*     		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
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
 */ 
  
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
  <td>Produk</td>
	<td>
	  <? 
		switch($produk)
		{
		  case 'LINK': $pa = "selected"; break;
		  case 'NOLINK': $pc = "selected"; break;
		  case 'ALL': $po = "selected"; break;
		  default : $px = "selected"; break;
		}
		?>
	  <select name="metodebayar">
	  	<option value="LINK" <?=$pa;?>>New JS Link</option>
		<option value="NOLINK" <?=$pc;?>>Non JS Link</option>
		<option value="ALL" <?=$po;?>>All</option>
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
					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] );
	$tglakhir	=	$_POST['sthn'] . 
					( (strlen($_POST['sbln'])==1) ? '0'.$_POST['sbln'] : $_POST['sbln'] );
	//echo '<hr />'. $tglawal . ' - '.$tglakhir.'<hr />';
	if($produk=="LINK"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterproduk = "JL2";
		 $titletrans		= "AUTO DEBET MANDIRI";
	} elseif($produk=="NOLINK"){
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterproduk = "JL2";
		 $titletrans		= "CITIBANK 1BILL";
	} else{
	   $filterperiode = "to_char(a.tglrekam,'YYYYMMDD') between '$tglawal' and  '$tglakhir' and ";
		 $filterproduk = "";
		 $titletrans		= "CITIBANK 1BILL";
	} 

  if($kdkantor=="ALL"){
		  $filterkantor = "";
	}	else	{
		  $filterkantor = "kdrayonpenagih='$kdkantor' and ";
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
	if($produk=="LINK"){
		 $sql = "select prefixpertanggungan,nopertanggungan,kdproduk from tabel_200_pertanggungan a,tabel_500_penagih b ".
		 		"where substr(kdproduk,1,3) = 'JL2' AND kdpertanggungan = '2' AND kdstatusfile = '1' AND kdcarabayar = 'M' ".
				"AND a.nopenagih=b.nopenagih ". $filterkantor;
					
		} elseif($produk=="NOLINK") {
			$sql = "select prefixpertanggungan,nopertanggungan,kdproduk from tabel_200_pertanggungan a,tabel_500_penagih b ".
		 		"where substr(kdproduk,1,3) <> 'JL2' AND kdpertanggungan = '2' AND kdstatusfile = '1' AND kdcarabayar = 'M' ".
				"AND a.nopenagih=b.nopenagih ". $filterkantor;
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
			  $matere=$arr["MATERE"];
			  $discount = 0;
				$discountnb = 0;
				$discountob = 0;
			}
			else
			{
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
	$jmlmatre +=$matere;
	$jmldiscount +=$discount;
	$jmltotaldebet += $arr["PREMITAGIHAN"];
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
<a href="rekap_jl2.php"><font color="#ffffff">Rekap Js.Link</font></a>
<hr size="1" />
<a href="index.php">Menu Pelaporan</a>

</body>
</html>
