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
<body onload="window.print();window.close()">
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
  			$sqa="select kdvaluta,namavaluta from $DBUser.tabel_304_valuta";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDVALUTA"]==$kdvaluta){ echo " selected"; }
      					echo " value=".$arr["KDVALUTA"].">".$arr["NAMAVALUTA"]."</option>";
  					}
  			$vsel = $kdvaluta==2 ? "selected" : "";
				?>
				<option value="2" <?=$vsel;?>>DOLLAR GADAI RUPIAH</option>
  			</select></td>
		<td>Jenis</td>
		<td>
		<select name="kdjenisgadai">
  			  <option value="0">Gadai Baru</option>
					<option value="1" <?=$kdjenisgadai==1 ? "selected":"";?>>Gadai Lama</option>
  			</select></td>
		<td align="left"><input name="cari" value="GO" type="submit"></td>
	</tr>
	</form>
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
	  case '1' : $kdakun = 160001; $kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta;  break;
		case '0' : $kdakun = 160002; $kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; break;
		case '3' : $kdakun = 161000; $kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; break;
		case '2' : $kdakun = 161001; $kdvaluta=3; $kdvaluta2=1; break;
		default : $kdakun = 160001; $kdvaluta=$kdvaluta; $kdvaluta2=$kdvaluta; break;
	}
	$sql = "select akun,nama from $DBUser.tabel_802_kodeakun where akun='$kdakun'";
	$DB->parse($sql);
	$DB->execute();
	$aku = $DB->nextrow();
	$namaakun = $aku["NAMA"];
	?>
	<tr>
		<td width="200">KODE REKENING</td>
		<td width="90%"><?=$kdakun;?></td>
	</tr>
	<tr>
		<td>NAMA REKENING</td>
		<td><?=$namaakun;?></td>
	</tr>
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
		<td colspan="2" bgcolor="#7dc2d9" align="center">SALDO AWAL BULAN</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">TAGIHAN BUNGA BERJALAN</td>
		<td colspan="2" bgcolor="#7dc2d9" align="center">REALISASI PEMBAYARAN BULAN BERJALAN</td>
		<td rowspan="2" bgcolor="#7dc2d9" align="center">KAPITALISASI<br />BUNGA</td>
		<td colspan="2" bgcolor="#7dc2d9" align="center">SALDO AKHIR BULAN</td>
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
	$kdjenisgadai = isset($kdjenisgadai) ? $kdjenisgadai : 0;
	
	
	/*
	if($kdjenisgadai==0)
	{
	  $filterjenis = "(select saldopinjaman from $DBUser.tabel_701_pelunasan_gadai 
                     where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                     and tglgadai=d.tglgadai and tglbooked in 
                        (select max(tglbooked) from $DBUser.tabel_701_pelunasan_gadai where 
                         prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and 
                          tglgadai=d.tglgadai and  to_char(tglbooked,'YYYYMM')='$prevyear$prevmonth' )) as saldobulanlalu,
              (select bunga from $DBUser.tabel_701_pelunasan_gadai 
                     where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                     and tglgadai=d.tglgadai and tglbooked in 
                        (select max(tglbooked) from $DBUser.tabel_701_pelunasan_gadai where 
                         prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and 
                          tglgadai=d.tglgadai and  to_char(tglbooked,'YYYYMM')='$prevyear$prevmonth' )) as bungabulanlalu ";
	}
	else
	{
	  $filterjenis = "(select sum(saldopinjaman) from $DBUser.tabel_701_pelunasan_gadai 
                     where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                     and tglgadai=d.tglgadai and  to_char(tglbooked,'YYYYMM') <='$prevyear$prevmonth') as saldobulanlalu,
              (select sum(bunga) from $DBUser.tabel_701_pelunasan_gadai 
                     where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                     and tglgadai=d.tglgadai and to_char(tglbooked,'YYYYMM') <= '$prevyear$prevmonth' ) as bungabulanlalu ";
	}
	
	$sql = "select 
              a.prefixpertanggungan,a.nopertanggungan,a.nopol,
              (select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) as namapemegangpolis,
              to_char(b.tglgadai,'DD/MM/YYYY') as tglgadai,b.nilaigadai,b.sisagadai,b.kdvaluta,b.status,b.gadailama,
              to_char(d.tglbooked,'DD/MM/YYYY') as tglbooked,d.saldopinjaman,d.angsuranpokok,d.bunga,d.kapitalisasi,
							d.totalangsuran,
							$filterjenis
          from
              $DBUser.tabel_200_pertanggungan a,
              $DBUser.tabel_700_gadai b,
              $DBUser.tabel_500_penagih c,
              $DBUser.tabel_701_pelunasan_gadai d
          where 
              a.prefixpertanggungan=b.prefixpertanggungan
              and a.nopertanggungan=b.nopertanggungan
              and a.prefixpertanggungan=d.prefixpertanggungan(+)
              and a.nopertanggungan=d.nopertanggungan(+)
              and a.nopenagih=c.nopenagih 
							and b.tglgadai=d.tglgadai(+) 
              and c.kdrayonpenagih='$kdkantor' 
							and b.status='3'
							and a.kdvaluta='$kdvaluta'
							and nvl(b.gadailama,0)='$kdjenisgadai' 
							and to_char(d.tglbooked,'YYYYMM')='$year$month'";
	*/
	
	if($kdjenisgadai==0)
	{
	    $filterjenis = "(SELECT decode(totalangsuran,'',saldopinjaman,totalangsuran)
            FROM $DBUser.tabel_701_pelunasan_gadai
           WHERE prefixpertanggungan =
                                      a.prefixpertanggungan
             AND nopertanggungan = a.nopertanggungan
             AND tglgadai = a.tglgadai
             AND periodebayar IN (
                    SELECT (MAX (periodebayar)-1)
                      FROM $DBUser.tabel_701_pelunasan_gadai
                     WHERE prefixpertanggungan = a.prefixpertanggungan
                       AND nopertanggungan = a.nopertanggungan
                       AND tglgadai = a.tglgadai
                       AND TO_CHAR (tglbooked, 'YYYYMM') = '$year$month'))
                                                            AS saldobulanlalu,
         (SELECT bunga
            FROM $DBUser.tabel_701_pelunasan_gadai
           WHERE prefixpertanggungan =
                                      a.prefixpertanggungan
             AND nopertanggungan = a.nopertanggungan
             AND tglgadai = a.tglgadai
             AND periodebayar IN (
                    SELECT (MAX (periodebayar)-1)
                      FROM $DBUser.tabel_701_pelunasan_gadai
                     WHERE prefixpertanggungan = a.prefixpertanggungan
                       AND nopertanggungan = a.nopertanggungan
                       AND tglgadai = a.tglgadai
                       AND TO_CHAR (tglbooked, 'YYYYMM') = '$year$month'))
                                                            AS bungabulanlalu ";
		/*																											
	  $filterjenis = "(select max(saldopinjaman) from $DBUser.tabel_701_pelunasan_gadai 
                             where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                             and tglgadai=a.tglgadai and tglbooked in 
                                (select max(tglbooked) from $DBUser.tabel_701_pelunasan_gadai where 
                                 prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and 
                                  tglgadai=a.tglgadai and  to_char(tglbooked,'YYYYMM')='$prevyear$prevmonth' )) as saldobulanlalu,
                    (select max(bunga) from $DBUser.tabel_701_pelunasan_gadai 
                             where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                             and tglgadai=a.tglgadai and tglbooked in 
                                (select max(tglbooked) from $DBUser.tabel_701_pelunasan_gadai where 
                                 prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and 
                                  tglgadai=a.tglgadai and  to_char(tglbooked,'YYYYMM')='$prevyear$prevmonth' )) as bungabulanlalu  ";
	  */
	}
	else
	{
	
	  $filterjenis = "(select max(saldopinjaman) from $DBUser.tabel_701_pelunasan_gadai 
                             where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                             and tglgadai=a.tglgadai and to_char(tglbooked,'YYYYMM')<='$prevyear$prevmonth' ) as saldobulanlalu,
                      (select max(bunga) from $DBUser.tabel_701_pelunasan_gadai 
                             where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
                             and tglgadai=a.tglgadai and to_char(tglbooked,'YYYYMM')<='$prevyear$prevmonth' ) as bungabulanlalu";
	}
		
	$sql = "select 
            a.prefixpertanggungan,a.nopertanggungan,b.nopol,b.nopemegangpolis,
											(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.nopemegangpolis) as namapemegangpolis,
                      to_char(a.tglgadai,'DD/MM/YYYY') as tglgadai,a.nilaigadai,a.sisagadai,a.kdvaluta,a.status,a.gadailama,
                      to_char(d.tglbooked,'DD/MM/YYYY') as tglbooked,
											
											(select min(totalangsuran) from  $DBUser.tabel_701_pelunasan_gadai where 
                       TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' 
                       and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                       and tglgadai=a.tglgadai) totalangsuran, 
                       
                       (select bunga FROM $DBUser.tabel_701_pelunasan_gadai where 
                       TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' and tglseatled is null
                       and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                       and tglgadai=a.tglgadai) bungablnberjalan, 
                       
											 (select sum(angsuranbunga) FROM $DBUser.tabel_701_pelunasan_gadai where 
                       TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' and tglseatled is not null
                       and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                       and tglgadai=a.tglgadai) bungabayarblnberjalan, 
                       d.angsuranpokok, d.kapitalisasi, 
											 
											 (select angsuranpokok from $DBUser.tabel_701_pelunasan_gadai 
                      where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                      and  tglgadai=a.tglgadai
                      and periodebayar in 
                                          (select max(periodebayar) from $DBUser.tabel_701_pelunasan_gadai where 
                                           prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                                             and  tglgadai=a.tglgadai)
																						 and TO_CHAR (tglbooked, 'YYYYMM') = '$year$month' 
																						 ) as angsuranpokok2,
																						 
											 (select saldopinjaman from $DBUser.tabel_701_pelunasan_gadai 
                      where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                      and  tglgadai=a.tglgadai
                      and periodebayar in 
                                          (select max(periodebayar) from $DBUser.tabel_701_pelunasan_gadai where 
                                           prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                                             and  tglgadai=a.tglgadai)) as saldobulanlalu2,
																	 			 
                     (select totalangsuran from $DBUser.tabel_701_pelunasan_gadai 
                        where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                        and  tglgadai=a.tglgadai
                        and periodebayar in 
                                            (select max(periodebayar) from $DBUser.tabel_701_pelunasan_gadai where 
                                             prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                                               and  tglgadai=a.tglgadai)) as totalangsuran2,
                                               
                     (select bunga from $DBUser.tabel_701_pelunasan_gadai 
                        where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                        and  tglgadai=a.tglgadai
                        and periodebayar in 
                                            (select max(periodebayar) from $DBUser.tabel_701_pelunasan_gadai where 
                                             prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan
                                               and  tglgadai=a.tglgadai)) as bungablnberjalan2,
											$filterjenis
			 								 
          from 
            $DBUser.tabel_700_gadai a,
            $DBUser.tabel_200_pertanggungan b,
            $DBUser.tabel_500_penagih c,
						(SELECT x.prefixpertanggungan, x.nopertanggungan, x.tglbooked,
                sum(x.kapitalisasi) as kapitalisasi,
                sum(x.angsuranpokok) as angsuranpokok 
              FROM $DBUser.tabel_701_pelunasan_gadai x
             WHERE TO_CHAR (x.tglbooked, 'YYYYMM') = '$year$month' group by
             x.prefixpertanggungan, x.nopertanggungan, x.tglbooked
             ) d

         where 
             a.prefixpertanggungan=b.prefixpertanggungan 
             and a.nopertanggungan=b.nopertanggungan 
             and a.prefixpertanggungan=d.prefixpertanggungan(+) 
             and a.nopertanggungan=d.nopertanggungan(+) 
             and b.nopenagih=c.nopenagih
             and c.kdrayonpenagih='$kdkantor'
    				 and b.kdvaluta='$kdvaluta'
    				 and a.kdvaluta='$kdvaluta2'
    				 and nvl(a.gadailama,0)='$kdjenisgadai'
         order by a.prefixpertanggungan,a.nopertanggungan";						
	//echo $sql; 
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($row=$DB->nextrow()) {
	  $angsuran   = $row["ANGSURANPOKOK"]=="" ? 0 : $row["ANGSURANPOKOK"];
		$bungabayar = $row["ANGSURANPOKOK"]=="" ? 0 : $row["BUNGABAYARBLNBERJALAN"];
		$kapitalisasi = $row["KAPITALISASI"]=="" ? 0 : $row["KAPITALISASI"];
		$bungaakhir = $row["ANGSURANPOKOK"]=="" ? $row["BUNGABLNBERJALAN"] : 0;
		if($row["TOTALANGSURAN"]=="")
		{
		  $totalangsuran = $row["SALDOBULANLALU"]; 
			$bungaakhir		 = $row["BUNGABULANLALU"];
		} else {
		  $totalangsuran = $row["TOTALANGSURAN"]; 
		}

		$saldobulanlalu = $row["SALDOBULANLALU"];
		$bungabulanlalu = $row["BUNGABULANLALU"];
		$bungaakhir 		= $row["BUNGABLNBERJALAN"] - $bungabayar;
		
		if($row["TGLBOOKED"]=="")
		{
		  $saldobulanlalu = $row["SALDOBULANLALU2"];
			$bungabulanlalu = $row["BUNGABLNBERJALAN2"];
			$bungaakhir 		= $row["BUNGABLNBERJALAN2"];
			$totalangsuran  = $row["TOTALANGSURAN2"]=="" ? $row["SALDOBULANLALU2"] : $row["TOTALANGSURAN2"];
			$angsuran				= $row["ANGSURANPOKOK2"];
		}
	  $totalangsuran  = $totalangsuran + $kapitalisasi;
		if($i%2){ echo "<tr>"; } else { echo "<tr bgcolor=#c4e1f2>"; } 
	  ?>
		<td valign="top"><?=$i;?></td>
		<td valign="top"><?=$row["NOPOL"];?></td>
		<td valign="top"><?="<a href=\"javascript:NewWindow('../akunting/kartugadai1.php?prefix=".$row["PREFIXPERTANGGUNGAN"]."&noper=".$row["NOPERTANGGUNGAN"]."&tglgadai=".$row["TGLGADAI"]."','polisinfo',800,500,'yes');\">".$row["PREFIXPERTANGGUNGAN"]."-".$row["NOPERTANGGUNGAN"]."</a>";?></td>
		<td valign="top"><?=$row["NAMAPEMEGANGPOLIS"];?></td>
		<td valign="top"><?=$row["TGLGADAI"];?></td>
		
		<td valign="top" align="right"><?=numberFormat($saldobulanlalu);?></td>
		<td valign="top" align="right"><?=numberFormat($bungabulanlalu);?></td>
		
		<td valign="top" align="right"><?=numberFormat($row["BUNGABLNBERJALAN"]);?></td>
		<td valign="top" align="right"><?=numberFormat($angsuran);?></td>
		<td valign="top" align="right"><?=numberFormat($bungabayar);?></td>
		<td valign="top" align="right"><?=numberFormat($kapitalisasi);?></td>
		<td valign="top" align="right"><?=numberFormat($totalangsuran);?></td>
		<td valign="top" align="right"><?=numberFormat($bungaakhir);?></td>
	</tr>
	<?
	$i++;
	$jmlbunga += $row["BUNGABLNBERJALAN"];
	$jmlangsuran += $angsuran;
	$jmlbungabayar += $bungabayar;
	$jmlkapitalisasi += $kapitalisasi;
	$jmlsaldopinjaman += $row["SALDOBULANLALU"];
	$jmltotalangsuran += $totalangsuran;
	
	$jmlbungablnlalu += $row["BUNGABULANLALU"];
	$jmlbungaakhir += $bungaakhir;
	}
	?>
	<tr bgcolor="#afd6ed">
		<td><?=$i-1;?></td>
		<td>TOTAL</td>
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
		<td align="right"><?=numberFormat($jmlbungaakhir);?></td>
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
<a href="#" onclick="window.location.replace('index.php')">Menu Pelaporan</a> | 
<?="<a href=# onclick=NewWindow('gadai_pp_list.php?action=cetak&year=".$year."&month=".$month."&kdkantor=".$kdkantor."&kdvaluta=".$kdvaluta."&kdjenisgadai=".$kdjenisgadai."','',900,400,1)><img src=../img/cetak.gif border=0 align=absmiddle> Cetak</a>";?>
<? 
}
?>
</body>
</html>
