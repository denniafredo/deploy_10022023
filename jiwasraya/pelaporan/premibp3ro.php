<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB=new database($userid, $passwd, $DBName);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;
  
  //DAY
	/*
  echo "<select name=day>\n";
  $i=1;
  $CurrDay=date("d");
  If(!IsSet($day)) $day=$CurrDay;
  while ($i <= 31)
        {
         If(IsSet($day)) {
           If($day == $i || ($i == substr($day,1,1) && (substr($day,0,1) == 0))) {
                    echo"<option selected> $day\n";
                    $i++;
           }Else{
                  If($i<10) {			  
                     echo "<option> 0$i\n";
                  }Else {
                     echo "<option> $i\n";
                  }
                  $i++;
           }
         }Else {
                If($i == $CurrDay)
                  If($i<10) {
                     echo "<option selected> 0$i\n";
                  }Else {
                     echo"<option selected> $i\n";
                  }
                Else {
                  If($i<10) {
                     echo "<option> 0$i\n";
                  }Else {
                     echo "<option> $i\n";
                  }
                }
                $i++;
         }
        }
  echo "</select>\n";
  */
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

<html>
<head>
<title>Premi BP3 RO</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<a class="verdana10blk"><b>AKSEPTASI POLIS PER REGIONAL OFFICE</b></a>
<div align="right">
<form name="getpremi" action="<?=$PHP_SELF;?>" action="post">
  <a class="verdana10blk">Pilih Bulan yang lain</a> 
  <?  ShowFromDate(10,"Past"); ?>
	<input type="submit" name="submit" value="Cari"<
</form>
</div>
<div align="center">
<?
  $sql = "select to_char(sysdate,'DDMMYYYY') hariini,to_char(sysdate,'DD/MM/YYYY') tglsekarang from dual";
			 	 $DB->parse($sql);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $hariini     = $ars["HARIINI"];
				 //$hariini			= "06012005";
				 $carihariini	=	"'DDMMYYYY')='".$hariini."' ";
				 $bulanini		= substr($hariini,2,2); 
				 $vthn				= substr($hariini,-4); 
				 $tglsearch		= substr($hariini,2,6); 
				 $summary			=	"'MMYYYY')='".$tglsearch."' ";
	
	if(isset($submit))
  {
    //echo "Bulan ".$month." th ".$year;
		$bulanini = $month;
		$summary	=	"'MMYYYY')='".$month.$year."' ";
		$sampe		= "";
  }		
	else
	{
	  $sampe 		= "(SAMPAI HARI INI TGL. ".$ars["TGLSEKARANG"].")";
	}	 
  
	switch ($bulanini) {
     case "01":  $vbulan = "JANUARI"; break;
     case "02":  $vbulan = "PEBRUARI"; break;
     case "03":  $vbulan = "MARET"; break;
     case "04":  $vbulan = "APRIL"; break;
     case "05":  $vbulan = "MEI"; break;
     case "06":  $vbulan = "JUNI"; break;
     case "07":  $vbulan = "JULI"; break;
     case "08":  $vbulan = "AGUSTUS"; break;
     case "09":  $vbulan = "SEPTEMBER"; break;					
     case "10":  $vbulan = "OKTOBER"; break;
     case "11":  $vbulan = "NOPEMBER"; break;
     case "12":  $vbulan = "DESEMBER"; break;										
  }

  $ktrro = substr($kantor,0,1);
 
	$sql = "select ".
            "c.prefixpertanggungan,d.namakantor,";
						if(!isset($submit)){
  $sql .=   "a1.premirupiah1,a1.jmlpolis1,".
            "b1.premirupiah_js1,b1.jmlpolis_js1, ";
						}
	$sql .=	  "a.premirupiah,a.jmlpolis,".
            "b.premirupiah_js,b.jmlpolis_js ".
             
          "from ".
          	"$DBUser.tabel_200_pertanggungan c,".
          	"$DBUser.tabel_001_kantor d, ";
						if(!isset($submit)){
  $sql .=  	"(select  ".
          		"p.prefixpertanggungan,sum(h.nilairp) as premirupiah1,".
          		"count(p.nopertanggungan) as jmlpolis1 ".
          	"from ".
          		"$DBUser.tabel_300_historis_premi h, ".
          		"$DBUser.tabel_200_pertanggungan p ".
          	"where ".
          		"p.kdproduk not in ('JL0','JL1') and ".
          		"p.prefixpertanggungan like '$ktrro%' and ".
          		"h.prefixpertanggungan=p.prefixpertanggungan and ".
          		"h.nopertanggungan=p.nopertanggungan and ".
          		"h.kdkuitansi='BP3' and ".
          		"to_char(p.tglkonversi,".$carihariini." ". 
          	"group by p.prefixpertanggungan) a1,".
          	
						"(select ".
          		"p.prefixpertanggungan,sum(h.nilairp) as premirupiah_js1,".
          		"count(p.nopertanggungan) as jmlpolis_js1 ".
          	"from ".
          		"$DBUser.tabel_300_historis_premi h, ".
          		"$DBUser.tabel_200_pertanggungan p ".
          	"where ".
          		"p.kdproduk in ('JL0','JL1') and ".
          		"p.prefixpertanggungan like '$ktrro%' and ".
          		"h.prefixpertanggungan=p.prefixpertanggungan and ".
          		"h.nopertanggungan=p.nopertanggungan and ".
          		"h.kdkuitansi='BP3' and ".
          		"to_char(p.tglkonversi,".$carihariini." ". 
          	"group by p.prefixpertanggungan) b1, ";
						}
	$sql .=		"(select  ".
          		"p.prefixpertanggungan,sum(h.nilairp) as premirupiah,".
          		"count(p.nopertanggungan) as jmlpolis ".
          	"from ".
          		"$DBUser.tabel_300_historis_premi h, ".
          		"$DBUser.tabel_200_pertanggungan p ".
          	"where ".
          		"p.kdproduk not in ('JL0','JL1') and ".
          		"p.prefixpertanggungan like '$ktrro%' and ".
          		"h.prefixpertanggungan=p.prefixpertanggungan and ".
          		"h.nopertanggungan=p.nopertanggungan and ".
          		"h.kdkuitansi='BP3' and ".
          		"to_char(p.tglkonversi,".$summary." ". 
          	"group by p.prefixpertanggungan) a,".
						
          	"(select ".
          		"p.prefixpertanggungan,sum(h.nilairp) as premirupiah_js,".
          		"count(p.nopertanggungan) as jmlpolis_js ".
          	"from ".
          		"$DBUser.tabel_300_historis_premi h, ".
          		"$DBUser.tabel_200_pertanggungan p ".
          	"where ".
          		"p.kdproduk in ('JL0','JL1') and ".
          		"p.prefixpertanggungan like '$ktrro%' and ".
          		"h.prefixpertanggungan=p.prefixpertanggungan and ".
          		"h.nopertanggungan=p.nopertanggungan and ".
          		"h.kdkuitansi='BP3' and ".
          		"to_char(p.tglkonversi,".$summary." ". 
          	"group by p.prefixpertanggungan) b ".
          "where ".
          	"c.prefixpertanggungan=a.prefixpertanggungan(+) and ".
          	"c.prefixpertanggungan=b.prefixpertanggungan(+) and ";
						if(!isset($submit)){
  $sql .=		"c.prefixpertanggungan=a1.prefixpertanggungan(+) and ".
          	"c.prefixpertanggungan=b1.prefixpertanggungan(+) and ";
          	}
	$sql .=		"c.prefixpertanggungan like '$ktrro%' and ".
          	"d.kdkantor = c.prefixpertanggungan and ".
          	"d.kdjeniskantor='2' ".
          "group by ".
            "c.prefixpertanggungan,d.namakantor,";
            if(!isset($submit)){
  $sql .=	  "a1.premirupiah1,a1.jmlpolis1,".
						"b1.premirupiah_js1,b1.jmlpolis_js1,";
						}
	$sql .=		"a.premirupiah,a.jmlpolis,".
						"b.premirupiah_js,b.jmlpolis_js";
  
				 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";

	echo "<a class=verdana10blk><b>Akseptasi ".$vbulan." ".$vthn."</b></a>";

	?>
	<table cellpadding="1" cellspacing="1" width="100%">
	<tr bgcolor="#78bdd8">
    <td rowspan="3" align="center" class="verdana7blk">NO.</td>
    <td colspan="2" align="center" class="verdana7blk" rowspan="2">KANTOR</td>
    <? if(!isset($submit)){ ?>
		<td colspan="6" align="center" class="verdana7blk">KONVERSI HARI INI TGL. <?=$ars["TGLSEKARANG"];?></td>
		<? } ?>
		<td colspan="6" align="center" class="verdana7blk">KONVERSI BLN <?=$vbulan;?> <?=$sampe; ?></td>
	</tr>
  <tr bgcolor="#78bdd8">
    <? if(!isset($submit)){ ?>
		<td colspan="2" align="center" class="verdana7blk">NON JS_LINK</td>
		<td colspan="2" align="center" class="verdana7blk">JS-LINK</td>
    <td colspan="2" align="center" class="verdana7blk">TOTAL(RP)</td>
		<? } ?>
		<td colspan="2" align="center" class="verdana7blk">NON JS_LINK</td>
		<td colspan="2" align="center" class="verdana7blk">JS-LINK</td>
    <td colspan="2" align="center" class="verdana7blk">TOTAL(RP)</td>
	</tr>
  <tr bgcolor="#78bdd8">
	  
    <td align="center" class="verdana7blk">KD</td>
    <td align="center" class="verdana7blk">NAMA</td>
    <? if(!isset($submit)){ ?>
		<td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
		<td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
		<? } ?>
		<td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
		<td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
		
  </tr>
	<?
	$i=1;

	$polisnow    = 0;
	$preminow    = 0;
	$polisjsnow  = 0;
	$premijsnow  = 0;
	$jmlpolisnow = 0;
	$jmlpreminow = 0;
	
	$polis 			 = 0;
	$premi 			 = 0;
	$polisjs 		 = 0;
	$premijs 		 = 0;
	$jmlpolis 	 = 0;
	$jmlpremi		 = 0;
	while ($ark=$DB->nextrow()) {
		 $polisnow	  = $ark["JMLPOLIS1"];
		 $preminow	  = $ark["PREMIRUPIAH1"];
		 $polisjsnow  = $ark["JMLPOLIS_JS1"];
		 $premijsnow  = $ark["PREMIRUPIAH_JS1"];
		 $jmlpolisnow = $polisnow+$polisjsnow;
		 $jmlpreminow	= $preminow+$premijsnow;
		 
		 $polis	      = $ark["JMLPOLIS"];
		 $premi	 			= $ark["PREMIRUPIAH"];
		 $polisjs			= $ark["JMLPOLIS_JS"];
		 $premijs			= $ark["PREMIRUPIAH_JS"];
		 $jmlpolis	 	= $polis+$polisjs;
		 $jmlpremi		= $premi+$premijs;
		 
	   include "../../includes/belang.php";	
		 echo "<td class=verdana7blk align=center>".$i."</td>"; 
	   echo "<td class=verdana7blk align=center>".$ark["PREFIXPERTANGGUNGAN"]."</td>"; 
		 echo "<td class=verdana7blk nowrap>".$ark["NAMAKANTOR"]."</td>"; 
		 //---------------- hari ini ------------------
		 if(!isset($submit)){
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLIS1"]=='' ? 0 : $ark["JMLPOLIS1"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRUPIAH1"],2)."</td>";
		 
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLIS_JS1"]=='' ? 0 : $ark["JMLPOLIS_JS1"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRUPIAH_JS1"],2)."</td>";
		 
		 echo "<td class=verdana7blk align=right>".$jmlpolisnow."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($jmlpreminow,2)."</td>";
		 }
		 //------------------ sampe hari ini --------------
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLIS"]=='' ? 0 : $ark["JMLPOLIS"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRUPIAH"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLIS_JS"]=='' ? 0 : $ark["JMLPOLIS_JS"])."</td>";
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRUPIAH_JS"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".$jmlpolis."</td>";
		 echo "<td class=verdana7blk align=right>".number_format($jmlpremi,2)."</td>";
		 echo "</tr>";
		 
		 $i++;
		 $totpolisnow+=$polisnow;
		 $totpreminow+=$preminow;
		 $totpolisjsnow+=$polisjsnow;
		 $totpremijsnow+=$premijsnow;
		 $totjmlpolisnow+=$jmlpolisnow;
		 $totjmlpreminow+=$jmlpreminow;
		 
		 $totpolis+=$polis;
		 $totpremi+=$premi;
		 $totpolisjs+=$polisjs;
		 $totpremijs+=$premijs;
		 $totjmlpolis+=$jmlpolis;
		 $totjmlpremi+=$jmlpremi;
		 
	}
	   echo "<tr bgcolor=#cee0ff>";
	   echo "<td class=verdana7blk align=center colspan=3>TOTAL</td>"; 
		 if(!isset($submit)){
		 echo "<td class=verdana7blk align=right>".$totpolisnow."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totpreminow,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totpolisjsnow."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totpremijsnow,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totjmlpolisnow."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totjmlpreminow,2)."</td>";
		 }
		 echo "<td class=verdana7blk align=right>".$totpolis."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totpremi,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totpolisjs."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totpremijs,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totjmlpolis."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totjmlpremi,2)."</td>";
		 echo "</tr>";
	echo "</table>";
?>
<br><br>
</div>
<hr size="1">
<a href="index.php" class="verdana10blk">Back</a>
</body>
</html>
