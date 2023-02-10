<?
  include "../../includes/session.php";
  include "../../includes/database.php";
	include "../../includes/kantor.php";
	include "../../includes/fungsi.php";
	$DB = new database($userid, $passwd, $DBName);
	
	$month 		= !isset($month) ? date('m') : $month;
	$year 		= !isset($year) ? date('Y') : $year;
	$kdkantor = !isset($kdkantor) ? $kantor : $kdkantor;
	$kdvaluta = !isset($kdvaluta) ? 1 : $kdvaluta;
	
	function numberFormat($nilai)
	{
	  $output = number_format($nilai,2,",",".");
		return $output;
	}
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;

  //MONTH
  echo "<select name=month>\n";
  $i=1;
  $CurrMonth=date("m");
  while ($i <= 12)
  {
  		 				switch($i)
  						{
  							  case 1: $namabulan = "JANUARI"; break;
  								case 2: $namabulan = "PEBRUARI"; break;
									case 3: $namabulan = "MARET"; break;
									case 4: $namabulan = "APRIL"; break;
									case 5: $namabulan = "MEI"; break;
									case 6: $namabulan = "JUNI"; break;
									case 7: $namabulan = "JULI"; break;
									case 8: $namabulan = "AGUSTUS"; break;
  								case 9: $namabulan = "SEPTEMBER"; break;
  								case 10: $namabulan = "OKTOBER"; break;
									case 11: $namabulan = "NOVEMBER"; break;
									case 12: $namabulan = "DESEMBER"; break;
  								default : $namabulan = $i;
  						}
  		 
        If(IsSet($month)) {
           If($month == $i || ($i == substr($month,1,1) && (substr($month,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulan\n";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan\n";
              }Else {
                 echo "<option value=$i>$namabulan\n";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan\n";
                }Else {
                   echo "<option value=$i selected>$namabulan\n";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan\n";
  							}Else {
                   echo "<option value=$i>$namabulan\n";
                }
              }
              $i++;
        }
  }
  echo "<option value=all ".($month=="all" ? "selected" : "").">--ALL--</option>";
	echo "</select>\n";
  
  //YEAR
    echo "<select name=year>\n";
    $CurrYear=date("Y");
    If($YearIntervalType == "Past") {
        $i=$CurrYear-$year_interval+1;
        while ($i <= $CurrYear)
             {
              If($i == $year) {
                 echo "<option selected> $i\n";
              }ElseIf ($i == $CurrYear && !IsSet($year)) {
                 echo "<option selected> $i\n";
              }Else {
                 echo "<option> $i\n";
              }
              $i++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Future") {
        $i=$CurrYear+$year_interval;
        while ($CurrYear < $i)
             {
              if ($year == $CurrYear) echo "<option selected> $CurrYear\n";
                else echo "<option> $CurrYear\n";
              $CurrYear++;
             }
         echo "</select>\n";
    }
    If($YearIntervalType == "Both") {
        $i=$CurrYear-$year_interval+1;
        while ($i < $CurrYear+$year_interval)
             {
              if ($i == $CurrYear) echo "<option selected> $i\n";
                else echo "<option> $i\n";
              $i++;
             }
         echo "</select>\n";
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Laporan Pinjaman Polis PP</title>
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

-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<? 
if($action=="cetak"){
?>	
<body onLoad="window.print();window.close()">
<? 
}
else
{
?>
<body>
<table cellpadding="1" cellspacing="2">
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
 <tr>
    <td align="left">Bulan</td>
		<td><?  ShowFromDate(10,"Past"); ?></td>
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
  			</select></td>
		<td>Valuta</td>
		<td><select name="kdvaluta">
  			<?
//			echo "<option selected value=ALL>(*) ALL</option>";			
  			$sqa="select kdvaluta,namavaluta from $DBUser.tabel_304_valuta union select '2' kdvaluta,'DOLLAR GADAI RUPIAH' namavaluta from dual";
  					$DB->parse($sqa);
  					$DB->execute();	
					//echo "<option selected value=ALL>(*) ALL</option>";
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDVALUTA"]==$kdvaluta){ echo " selected"; } else {echo "";}
      					echo " value=".$arr["KDVALUTA"].">(".$arr["KDVALUTA"].") ".$arr["NAMAVALUTA"]."</option>";
  					}
  			//$vsel = $kdvaluta==2 ? "selected" : "";
				?>
				<!--<option value="2" <?=$vsel;?>>(2) DOLLAR GADAI RUPIAH</option>-->
  			</select>
            <? //echo $sqa;?>
            </td>
            
		<td>Jenis</td>
		<td>
		<select name="kdjenisgadai">
  			  <option value="0">Gadai Baru</option>
					<option value="1" <?=$kdjenisgadai==1 ? "selected":"";?>>Gadai Lama</option>
					<option value="2" <?=$kdjenisgadai==2 ? "selected":"";?>>(*) All</option>
  			</select></td>
	</tr>
	<tr>		
		<td>Status</td>
		<td><select name="kdstatus">
  			<?
	  			$sqa="select kdstatus,namastatus from $DBUser.tabel_999_kode_status where jenisstatus='GADAI' order by kdstatus";
				$DB->parse($sqa);
				$DB->execute();	
				echo "<option selected value=ALL>(*) ALL</option>";
				while ($arx=$DB->nextrow()) {
				  echo "<option ";
					if ($arx["KDSTATUS"]==$kdstatus){ echo " selected"; }
					echo " value=".$arx["KDSTATUS"].">(".$arx["KDSTATUS"].") ".$arx["NAMASTATUS"]."</option>";
				}
			?>
  			</select>
		</td>		
	</tr>
	<tr>
		<td></td>
		<td align="left"><input name="cari" value="GO" type="submit"></td>
	</tr>
	<? //$kdjenisgadai=0; ?>
	
</table>
<hr size="1">
<? } ?>
<table border="0" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#C0C0C0">
	<tr>
		<td colspan="2">PT. ASURANSI JIWA IFG<br>
		<? 
		$KTR = new Kantor($userid,$passwd,$kdkantor);
		echo $KTR->namakantor;
		?><br>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
		<p align="center"><b>LAPORAN PINJAMAN POLIS PERTANGGUNGAN PERORANGAN <?=$kdjenisgadai=="1" ? "(GADAI LAMA)" : "";?></b></td>
	</tr>
	<? 
	switch($kdvaluta)
	{
	  case '1' : $kdakun = 160001; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; $kdnewakun = 117110000; break;
		case '0' : $kdakun = 160002; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; $kdnewakun = 117120000; break;
		case '3' : $kdakun = 161000; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; $kdnewakun = 117130000; break;
		case '2' : $kdakun = 161001; $kdval=$kdvaluta;$kdvaluta=3; $kdvaluta2=1; $kdnewakun = 117140000; break;
//		case 'ALL' : $kdakun = "160000','160001','160002"; $kdvaluta="0','1','2','3"; $kdvaluta2="0','1','2','3"; break;
		default : $kdakun = 160001; $kdval=$kdvaluta;$kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; break;
	}

//	if ($kdvaluta=='0'||$kdvaluta=='1'||$kdvaluta=='2'||$kdvaluta=='3') {
	$sql = "select akun,nama from $DBUser.tabel_802_kodeakun where akun in ('$kdakun')";
	$DB->parse($sql);
	$DB->execute();
	$aku = $DB->nextrow();
	$namaakun = $aku["NAMA"];
	?>
	<tr>
		<td width="200">KODE REKENING</td>
		<td width="90%"><?=$kdakun;?>/<?=$kdnewakun;?></td>
	</tr>

	<tr>
		<td>NAMA REKENING</td>
		<td><?=$namaakun;?></td>
	</tr>
<?
//	} 
//	else {
//		echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
//	}
?>

	<tr>
		<td>PER</td>
		<td>
		 <? 
		 $per = "30/".$month."/".$year;
		 echo toTglIndo($per);
		 ?>
		</td>
	</tr>
</table>
<br />

<table border="1" cellpadding="2" style="border-collapse: collapse" width="100%" bordercolor="#09b0ce">
	<tr>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">NO URUT</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">NO POLIS LAMA</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">NO POLIS JL-INDO</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">NAMA PEMEGANG POLIS</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">MULAI GADAI</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">KODE VALUTA</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">KODE STATUS</td>
		<td colspan="2" bgcolor="#7dc2d9" align="center">SALDO AWAL BULAN</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">TAGIHAN BUNGA BERJALAN</td>
		<td colspan="2" bgcolor="#7dc2d9" align="center">REALISASI PEMBAYARAN BULAN BERJALAN</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">KAPITALISASI<br />BUNGA</td>
		<td colspan="2" bgcolor="#7dc2d9" align="center">SALDO AKHIR BULAN</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">ACTION</td>
	</tr>
	<tr>
		<td bgcolor="#7dc2d9" align="center">POKOK</td>
		<td bgcolor="#7dc2d9" align="center">BUNGA</td>
		<td bgcolor="#7dc2d9" align="center">POKOK</td>
		<td bgcolor="#7dc2d9" align="center">BUNGA</td>
		<td bgcolor="#7dc2d9" align="center">POKOK</td>
		<td bgcolor="#7dc2d9" align="center">BUNGA</td>
		
	</tr>
	<?
	if($month=="01")
	{
	  $prevmonth = 12;
		$prevyear = $year-1;
	}
	else
	{
	  $prevmonth = $month - 1 ;
		$prevmonth = strlen($prevmonth)==1 ? "0".$prevmonth : $prevmonth;
		$prevyear  = $year;
	}
	//$kdjenisgadai = isset($kdjenisgadai) ? $kdjenisgadai : 0;
	$kdjenisgadainya="";
	if ($kdjenisgadai=="2") { $kdjenisgadainya=" ";} else {$kdjenisgadainya=" and nvl(d.gadailama,0) in ('$kdjenisgadai') ";}
	
	$kdvalutanya="";
	if ($kdvaluta=="0"||$kdvaluta=="1"||$kdvaluta=="2"||$kdvaluta=="3") { $kdvalutanya="and b.kdvaluta in ('$kdvaluta') and d.kdvaluta in ('$kdvaluta2')"; } //else {$kdvalutanya="and b.kdvaluta in ('1','2','3','0') and d.kdvaluta in ('1','2','3','0')";}

	$kdstatusnya="";
	if ($kdstatus!="ALL") { $kdstatusnya="and d.status='$kdstatus'"; }
	
	$sql = "SELECT   
              a.prefixpertanggungan,a.nopertanggungan,
              TO_CHAR (a.tglgadai, 'DD/MM/YYYY') tglgadai, 
              TO_CHAR (a.tglbooked, 'DD/MM/YYYY') tglbooked, 
              TO_CHAR (a.tglseatled, 'DD/MM/YYYY') tglseatled,
			  a.saldopinjaman, 
			  a.bunga, a.totalangsuran,
              a.periodebayar, a.nilaipembayaran, a.nobs,
              a.kapitalisasi,b.nopol,
              a.angsuranpokok, a.angsuranbunga,
							(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopemegangpolis) as namapemegangpolis,
                   (SELECT sum(bungagadai)
                      FROM $DBUser.tabel_700_gadai
                     WHERE prefixpertanggungan = a.prefixpertanggungan
                       AND nopertanggungan = a.nopertanggungan
                       AND tglgadai = a.tglbooked) bungagadaiawal,".

//-- Tambahan dari Ari 22/12/2010 - Sum Angsuran Pokok dan Bunga untuk tiap periode Booked					   
					"(select sum(angsuranpokok) from $DBUser.tabel_701_pelunasan_gadai where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' and tglgadai=a.tglgadai ) sumangsuranpokok,
					(select sum(angsuranbunga) from $DBUser.tabel_701_pelunasan_gadai where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' and tglgadai=a.tglgadai ) sumangsuranbunga,".
//-- Tambahan dari Ari 22/12/2010 - Sum Angsuran Pokok dan Bunga untuk tiap periode Booked					   

				"b.kdvaluta, d.status
              FROM $DBUser.tabel_701_pelunasan_gadai a,
                  $DBUser.tabel_200_pertanggungan b,
                  $DBUser.tabel_500_penagih c,
                  $DBUser.tabel_700_gadai d 
             WHERE  
               a.periodebayar = (select min(periodebayar) from $DBUser.tabel_701_pelunasan_gadai 
                                  where prefixpertanggungan=a.prefixpertanggungan 
                                  and nopertanggungan=a.nopertanggungan
                                  and TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' and tglgadai=a.tglgadai )
               and a.prefixpertanggungan=b.prefixpertanggungan 
                       and a.nopertanggungan=b.nopertanggungan 
                       and b.nopenagih=c.nopenagih
               and d.prefixpertanggungan=a.prefixpertanggungan
                       and d.nopertanggungan=a.nopertanggungan
                       and d.tglgadai=a.tglgadai
							 and c.kdrayonpenagih='$kdkantor'
      				 $kdvalutanya
					 $kdstatusnya
      				 $kdjenisgadainya
         		order by a.prefixpertanggungan,a.nopertanggungan";	
	//echo $sql;
	//echo $kdvaluta; 
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {
	      if($tglgadai==$arr["TGLBOOKED"]) // pembarayan pertamakali/saat pengajuan
				{
					$angsuranbunga = $arr["BUNGAGADAIAWAL"];
					//$totalangsuran = $arr["SALDOPINJAMAN"];
					$totalangsuran = $arr["SALDOPINJAMAN"] + $arr["KAPITALISASI"] - $arr["ANGSURANPOKOK"];
					$tglbayar			 = $arr["TGLSEATLED"];
					$nobs					 = $arr["NOSIP"];
				} else {
				  $bunga = $arr["BUNGA"];
					//$totalangsuran = $arr["TOTALANGSURAN"];
//--					$totalangsuran = $arr["SALDOPINJAMAN"] + $arr["KAPITALISASI"] - $arr["ANGSURANPOKOK"];
					$totalangsuran = $arr["SALDOPINJAMAN"] + $arr["KAPITALISASI"] - $arr["SUMANGSURANPOKOK"];
					if($totalangsuran=="")
					{
//--					  $totalangsuran = $arr["SALDOPINJAMAN"] + $arr["KAPITALISASI"] - $arr["ANGSURANPOKOK"];
					  $totalangsuran = $arr["SALDOPINJAMAN"] + $arr["KAPITALISASI"] - $arr["SUMANGSURANPOKOK"];
					}
					$tglbayar			 = $arr["TGLBAYAR"];
					$nobs					 = $arr["KDBATCH"];
					$angsuranbunga = $arr["ANGSURANBUNGA"];
				}
		if($i%2){ echo "<tr>"; } else { echo "<tr bgcolor=#c4e1f2>"; } 
	  ?>
		<td valign="top"><?=$i;?></td>
		<td valign="top"><?=$arr["NOPOL"];?></td>
		<td valign="top"><?="<a href=\"javascript:NewWindow('../akunting/kartugadai1.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLGADAI"]."','polisinfo',800,500,'yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a>";?></td>
		<td valign="top"><?=$arr["NAMAPEMEGANGPOLIS"];?></td>
		<td valign="top"><?=$arr["TGLGADAI"];?></td>
		<td valign="top"><?=$arr["KDVALUTA"];?></td>
		<td valign="top"><?=$arr["STATUS"];?></td>
		
		<td valign="top" align="right"><?=idNumberFormat($arr["SALDOPINJAMAN"]);?></td>
		<td valign="top" align="right"><?=idNumberFormat($bunga+$angsuranbunga);?></td>
		
		<td valign="top" align="right"><?=idNumberFormat($arr["BUNGA"]);?></td>
<!--
		<td valign="top" align="right"><?=//idNumberFormat($arr["ANGSURANPOKOK"]);?></td>
		<td valign="top" align="right"><?=//idNumberFormat($arr["ANGSURANBUNGA"]);?></td>
-->
		<td valign="top" align="right"><?=idNumberFormat($arr["SUMANGSURANPOKOK"]);?></td>
		<td valign="top" align="right"><?=idNumberFormat($arr["SUMANGSURANBUNGA"]);?></td>
		<td valign="top" align="right"><?=idNumberFormat($arr["KAPITALISASI"]);?></td>
		<td valign="top" align="right"><?=idNumberFormat($totalangsuran);?></td>

<!-- Modifikasi oleh Ari 06/01/2011
		<td valign="top" align="right"><?=//$arr["TGLSEATLED"]=="" ? idNumberFormat($arr["BUNGA"]) : idNumberFormat($bunga);?>
-->
		<td valign="top" align="right"><?=$arr["TGLSEATLED"]=="" ? idNumberFormat($arr["BUNGA"]-$arr["SUMANGSURANBUNGA"]) : idNumberFormat($bunga-$arr["SUMANGSURANBUNGA"]);?>

        <?
        if ($arr["TGLSEATLED"]=="") {$bg=$arr["BUNGA"];} else{$bg=$bunga;};
		?>
        </td>
		<td valign="top" align="center"><?="<a href=\"javascript:NewWindow('../polis/cetakberitahugadai.php?prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLGADAI"]."','polisinfo',800,500,'yes');\">cetak</a>";?></td>
	</tr>
	<?
	$i++;
	//$jmlbunga += $row["BUNGABLNBERJALAN"];
	$jmlbunga += $arr["BUNGA"];
	//$jmlangsuran += $angsuran;

//--	$jmlangsuran += $arr["ANGSURANPOKOK"];
	$jmlangsuran += $arr["SUMANGSURANPOKOK"];
	
	//$jmlbungabayar += $bungabayar;
//--	$jmlbungabayar += $arr["ANGSURANBUNGA"];
	$jmlbungabayar += $arr["SUMANGSURANBUNGA"];

	$jmlkapitalisasi += $kapitalisasi;
	//$jmlsaldopinjaman += $row["SALDOBULANLALU"];
	$jmlsaldopinjaman +=$arr["SALDOPINJAMAN"];
	$jmltotalangsuran += $totalangsuran;
	
	//$jmlbungablnlalu += $row["BUNGABULANLALU"];
	$jmlbungablnlalu +=($bunga+$angsuranbunga);
	$jmlbungaakhir += $bungaakhir;
	$jmlbg += $bg;
	}
	?>
	<tr bgcolor="#afd6ed">
		<td><?=//$i-1;?></td>
		<td>TOTAL</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"><?=numberFormat($jmlsaldopinjaman);?></td>
		<td align="right"><?=numberFormat($jmlbungablnlalu);?></td>
		<td align="right"><?=numberFormat($jmlbunga);?></td>
		<td align="right"><?=numberFormat($jmlangsuran);?></td>
		<td align="right"><?=numberFormat($jmlbungabayar);?></td>
		<td align="right"><?=numberFormat($jmlkapitalisasi);?></td>
		<td align="right"><?=numberFormat($jmltotalangsuran);?></td>

<!-- Modifikasi oleh Ari 06/01/2011
		<td align="right"><?=//numberFormat($jmlbg-$jmlbungabayar);?></td>
-->

		<td align="right"><?=numberFormat($jmlbg-$jmlbungabayar);?></td>
		<td align="right"></td>
	</tr>
</table>
<br />
<? 
if($action=="cetak"){
?>	
						<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
              <tr>
							  <td><?=$KTR->kotamadya;?>, <?=toTglIndo(date("d/m/Y")); ;?></td>
								<td align="center"></td>
							</tr>
							<tr>
							  <td width="34%">Dibuat oleh,<p>&nbsp;</p>
                <p>( <?=$KTR->kasieadlog;?> )<br>
                Kasi Adm &amp Logistik</td>

								<td align="center" width="33%">Mengetahui,<p>&nbsp;</p>
                <p>( <?=$KTR->branchmanager;?> ) <br><?=$KTR->jabatanmanager;?>&nbsp;</td>
              </tr>
            </table>
<br />
<? 
}
else
{
?>
<hr size="1">
<a href="#" onClick="window.location.replace('index.php')">Menu Pelaporan</a> | 
<?="<a href=# onclick=NewWindow('gadai_pp_list.php?action=cetak&year=".$year."&month=".$month."&kdkantor=".$kdkantor."&kdvaluta=".$kdval."&kdjenisgadai=".$kdjenisgadai."&kdstatus=".$kdstatus."','',900,400,1)><img src=../img/cetak.gif border=0 align=absmiddle> Cetak</a>";?>
<? 
}
?>
</form>
</body>
</html>
