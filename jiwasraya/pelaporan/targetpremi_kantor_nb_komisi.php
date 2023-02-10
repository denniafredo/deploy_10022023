<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  include "../../includes/fungsi.php";
	
	$DB=new database($userid, $passwd, $DBName);
	$prefix=strtoupper($prefix);
	$bln = (!$bl) ? $bln : '';
	
	function ShowMonth() {
  GLOBAL $month;
    	 //MONTH
       echo "<select name=month>";
       $i=1;
       $CurrMonth=1;
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
							echo "<option value=$n selected>$namabulan";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan";
              }Else {
                 echo "<option value=$i>$namabulan";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan";
                }Else {
                   echo "<option value=$i selected>$namabulan";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan";
  							}Else {
                   echo "<option value=$i>$namabulan";
                }
              }
              $i++;
        }
    }
    echo "</select>";
  }
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $month2,$year;
    	 //MONTH
       echo "<select name=month2>";
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
  		 
        If(IsSet($month2)) {
           If($month2 == $i || ($i == substr($month2,1,1) && (substr($month2,0,1) == 0))) {
              $n = (strlen($i)==1) ? "0$i" : "$i";
							echo "<option value=$n selected>$namabulan";
              $i++;
           }Else{
  						If($i<10) {
                 echo "<option value=0$i>$namabulan";
              }Else {
                 echo "<option value=$i>$namabulan";
              }
              $i++;
           }
        }Else {
              If($i == $CurrMonth) {
                If($i<10) {
                   echo "<option value=0$i selected>$namabulan";
                }Else {
                   echo "<option value=$i selected>$namabulan";
                }
              }Else {
                If($i<10){
                   echo "<option value=0$i>$namabulan";
  							}Else {
                   echo "<option value=$i>$namabulan";
                }
              }
              $i++;
        }
    }
    echo "</select>";
  
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
<html>
<title>Pemeliharaan Polis</title>
<head>

<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>


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
</head>
<body>
<?	
$year = isset($year) ? $year : date("Y");
if(!isset($month))
{
$month  = "01";
$month2 = date('m');
}

if($nbob=="OB"){
  $sel = "selected";
  $titleobno = "OB";
} 
else
{
  $sel = "";
  $titleobno = "NB";
}
?>

<h4>Target <?=$year;?> vs Realisasi Premi <?=$titleobno;?> Branch Office<br />
Periode <?=namaBulan($month)." s.d ".namaBulan($month2)." ".$year;?>
</h4>

<table cellpadding="1" cellspacing="2">
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
 <tr>
    <td align="left">
		Premi 
		<select name="nbob">
		 <option value="NB">NB</option>
		 <option value="OB" <?=$sel;?>>OB</option>
		</select>
		</td>
		<td>
		Bulan <?  ShowMonth(); ?> s.d <? ShowFromDate(10,"Past"); ?> 
		<input name="cari" value="GO" type="submit">
		</td>
	</tr> 
	</form>
</table>

<hr size="1">
			<? 
			$f  = (!$f) ? 'x.kdkantor' : $f;
			$ad = ($o==1) ? 'desc' : 'asc';
			$o = (int)!((boolean)$o);
			 ?>
			<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#ffdeb3">
					<td height="20">No</td>
					<td align="center"><a href="<?="$PHP_SELF?f=x.kdkantor&o=$o&year=$year&month=$month&month2=$month2&nbob=$nbob";?>"><b>Kd.Kantor</b></a></td>
					<td align="center"><b>Nama Kantor</b></td>
					<td align="center"><a href="<?="$PHP_SELF?f=premitarget&o=$o&year=$year&month=$month&month2=$month2&nbob=$nbob";?>"><b>Target Premi</b></a></td>
					<td align="center"><a href="<?="$PHP_SELF?f=premirealisasi&o=$o&year=$year&month=$month&month2=$month2&nbob=$nbob";?>"><b>Realisasi Premi</b></a></td>
					<td align="center"><a href="<?="$PHP_SELF?f=persen&o=$o&year=$year&month=$month&month2=$month2&nbob=$nbob";?>"><b>Persen</b></a></td>
					<td align="center"><b>Komisi Penagihan</b></td>
					<td align="center"><b>Komisi Penutupan</b></td>
				</tr>				
         <?
				 if($nbob=="OB")
				 {
//				  $qrynbob = "and substr(y.kdkuitansi,1,2)='OB'";
				  $qrynbob = "and y.kdkuitansi LIKE 'OB%'";
					$fieldtarget = "target_ob";
				 }
				 else
				 {
//				  $qrynbob = "and substr(y.kdkuitansi,1,2) in ('BP','NB')";
				  $qrynbob = "and (y.kdkuitansi LIKE 'BP%' OR y.kdkuitansi LIKE 'NB%')";
					$fieldtarget = "target_nb";
				 }

				$month2 = intval($month2,10) + 1;
				if ($month2 == 13) {
					$month2  = '01';
					$year2 = $year + 1;
				} else {
					$month2  = substr('00'.$month2,-2);
					$year2 = $year;
				}
				
				//echo $month2;

				 $sql = "SELECT   x.kdkantor, (SELECT namakantor
                        FROM $DBUser.tabel_001_kantor
                       WHERE kdkantor = x.kdkantor) namakantor,
                   x.premirealisasi,
                       (SELECT   $fieldtarget 
                            FROM $DBUser.tabel_401_target_kantor
                           WHERE tahun = $year
                        		AND kdkantor = x.kdkantor) AS premitarget,
														x.komisitagih 
                  FROM (SELECT 
                       z.kdrayonpenagih as kdkantor,
                       sum(y.nilairp) as premirealisasi,
											 sum(round(NVL(v.premi*decode(substr(w.kdproduk,1,2),'AD',0.01,'HT',0.01,0.02)*DECODE(w.kdvaluta,'0',v.kurs/w.indexawal,v.kurs),0),2)) komisitagih 
                            FROM 
                                $DBUser.tabel_300_historis_premi y,
																$DBUser.tabel_800_pembayaran v,
                                $DBUser.tabel_200_pertanggungan w,
                                $DBUser.tabel_500_penagih z
                           WHERE w.prefixpertanggungan = y.prefixpertanggungan
                             AND w.nopertanggungan = y.nopertanggungan
                             AND y.prefixpertanggungan = v.prefixpertanggungan(+)
                             AND y.nopertanggungan = v.nopertanggungan(+)
                             AND y.tglseatled=v.tglseatled(+)
														 AND w.nopenagih=z.nopenagih 
                             AND y.tglseatled IS NOT NULL
                             AND w.kdpertanggungan = '2'
                             AND y.tglbooked between TO_DATE('$year$month','YYYYMM') and TO_DATE('$year2$month2','YYYYMM')
                             $qrynbob
                  group by z.kdrayonpenagih) x
                order by $f $ad";
				
				//echo $sql;
								
        	$DB->parse($sql);
        	$DB->execute();
        	$i=1;
        	while ($arr=$DB->nextrow()) {
        	 $persen =  $arr["PREMITARGET"] ? ($arr["PREMIREALISASI"] / $arr["PREMITARGET"]) * 100 : 0;
			 		 $komtagih = $arr["KOMISITAGIH"];
        	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
        	 echo "<td>$i</td>";
           echo "<td>".$arr["KDKANTOR"]."</td>";
        	 echo "<td>".$arr["NAMAKANTOR"]."</td>";
        	 echo "<td align=right>".number_format($arr["PREMITARGET"],2,",",".")."</td>";
        	 echo "<td align=right><a href=\"#\" onclick=\"window.open('realisasipremi_kantor.php?kdkantor=".$arr["KDKANTOR"]."&year=$year&month=$month&month2=$month2&nbob=$nbob','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".number_format($arr["PREMIREALISASI"],2,",",".")."</a></td>";
        	 echo "<td align=right>".number_format($persen,2,",",".")."</td>";
					 echo "<td align=right>".number_format($komtagih,2,",",".")."</td>";
					 echo "<td align=right>".number_format($komagen,2,",",".")."</td>";
           echo "</tr>";
           $i++; 
					 $jmltarget += $arr["PREMITARGET"];
					 $jmlrealisasi += $arr["PREMIREALISASI"];
					 $jmlkomtagih += $komtagih;
					 $jmlkomagen += $komagen;
        	}		
        ?>				
				<tr>
				  <td align="right" colspan="3"><b>Jumlah</b></td>
					<td align="right"><?=number_format($jmltarget,2,",",".");?></td>
					<td align="right"><?=number_format($jmlrealisasi,2,",",".");?></td>
					<td align="right"></td>
					<td align="right"><?=number_format($jmlkomtagih,2,",",".");?></td>
					<td align="right"><?=number_format($jmlkomagen,2,",",".");?></td>
				</tr>
        </table>			

<hr size="1">

<a href="index.php">Menu Pelaporan</a>

</body>
</html>
