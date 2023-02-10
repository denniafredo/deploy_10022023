<?
  include "../includes/database.php";
  include "../includes/session.php";
	$DB=new database($userid, $passwd, $DBName);
	$prefix=strtoupper($prefix);
	$bln = (!$bl) ? $bln : '';
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
<html>
<title>Pemeliharaan Polis</title>
<head>

<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script LANGUAGE="JavaScript">
function Polis(theForm){
var p=theForm.prefix.value;
var n=theForm.noper.value;
 if (!n =='') { 
  NewWindow('polis.php?prefix='+p+'&noper='+n+'','kartupremi',700,600,1)
 }	
}
</script>
<? include "../includes/hide.php";  ?>
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
<h4>Pemeriksaan Proses Klaim</h4>

<table cellpadding="1" cellspacing="2">
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
 <tr>
    <td align="left">Bulan Pengajuan</td>
		<td>:</td>
		<td>
		 <?  ShowFromDate(10,"Past"); ?>
		</td>
	</tr> 

  <tr>
    <td>Jenis Klaim</td>
		<td>:</td>
		<td>
		 <select name="jns" onFocus="highlight(event)" class="c">
		 <?
		  $sql = "select kdklaim,namaklaim,kelompok from $DBUser.tabel_902_kode_klaim ".
					 	 //"where kdklaim <> 'CASHPLAN' and kelompok is not null AND KDBENEFIT='R' order by kelompok";
						 "where kelompok is not null AND KDBENEFIT='R' order by kelompok";
						 
		  $DB->parse($sql);
    	$DB->execute();
    	while ($ro=$DB->nextrow()) {
			   echo "<option ";
  				if ($ro["KDKLAIM"]==$jns){ echo " selected"; }
  				echo " value=\"".$ro["KDKLAIM"]."\">".str_replace("KLAIM","",$ro["NAMAKLAIM"])."</option>";
			}
			$jnsselect = $jns=="ALL" ? "selected" : "";
		 ?>
		  <!--<option value="ALL" <?=$jnsselect?>>--ALL--</option>-->
		 </select>
		</td>
        
	</tr>
	<tr>
		<td colspan="3" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
	</form>
</table>
<?

  if(isset($month))
	{
	  $bulancari = $year.$month;
		if($month=="all")
		{
		   //$filterbulan = "and to_char(a.tglpengajuan,'YYYY')='".$year."' ";
			 $filterbulan = "and to_char(a.tglrekam,'YYYY')='".$year."' ";
		}
		else
		{
		   //$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
			 $filterbulan = "and to_char(a.tglrekam,'YYYYMM')='".$year.$month."' ";
		}
	}
	else
	{
	  $month=date("m");
		$year=date("Y");
	  $bulancari = $year.$month;
		//$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
		$filterbulan = "and to_char(a.tglrekam,'YYYYMM')='".$year.$month."' ";
	}
	
  if($jns=="ALL" || !isset($jns))
	{
	  //$filterklaim = " ";
	  $filterklaim = "and a.kdklaim='".$jns."' ";
	}
	else
	{
	  $filterklaim = "and a.kdklaim='".$jns."' ";
	}
?>
	

<hr size="1">

			<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#7dc2d9">
					<td height="20">No</td>
					<td>No.Polis</td>
					<td>Nama Klaim</td>
					<td>Pengajuan</td>
					<td>Tanggal</td>
					<td>Status</td>
                    <td>Valuta</td>
					<td>Proses</td>
				</tr>				
<?
 if ($kantor=='KP') { $wkantor="";} else{$wkantor=" and e.kdrayonpenagih='$kantor'";};
 $sql = "select ".
  					"a.prefixpertanggungan,a.nopertanggungan,a.nomorsip,".
 						"a.nilaibenefit,a.kdklaim,b.namaklaim,a.kdkantorproses,".
						"to_char(a.tglpengajuan,'DD/MM/YYYY') tgl_pengajuan, ".
     				"a.status,a.userfo,to_char(a.tglfo,'DD/MM/YYYY') tglfo,a.userptg,".
						"to_char(a.tglptg,'DD/MM/YYYY') tglptg,".
    				"a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, ".
    				"a.useradlog,to_char(a.tgladlog,'DD/MM/YYYY') tgladlog,c.namastatus, ".
					"(SELECT KDMATAUANG FROM $DBUser.TABEL_304_VALUTA WHERE kdvaluta=d.kdvaluta) valuta ".
 				"from ".
						"$DBUser.tabel_901_pengajuan_klaim a,".
						"$DBUser.tabel_902_kode_klaim b,".
						"$DBUser.tabel_999_kode_status c, ".
						"$DBUser.tabel_200_pertanggungan d, ".
						"$DBUser.tabel_500_penagih e ".
				"where ".
				    "a.prefixpertanggungan=d.prefixpertanggungan and a.nopertanggungan=d.nopertanggungan ".
						"and d.nopenagih=e.nopenagih ".
						 $wkantor.
						"and a.kdklaim=b.kdklaim ".
						"and nvl(a.status,'0')=c.kdstatus ".
						"and nvl(a.klaimgroup,'0')=0 ".
						"and c.jenisstatus='KLAIM' ".
						$filterbulan.
						$filterklaim.
						//"AND ((a.kdkantorproses is null AND e.kdrayonpenagih = '$kantor') OR a.kdkantorproses='$kantor') ".
				"order by a.tglpengajuan";
  //echo $sql;
  //die;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {

	 switch ($arr["STATUS"]) {
	  case '0':
		  if ($kantor=='KP') { //bawa ke FE
		   //$nextpage="pengajuanklaimFE.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"];
		   $nextpage="hitungklaim_rider.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&tglkejadian=$tglkejadian".
				                               "&sebabmeninggal=$sebabkejadian&namadokter=$namadokter&alamatdokter=$alamatrs&cekbnf=$cekbnf&pemohon=$pemohon";
			 $lanjut = "<a href=# onclick=\"window.location.replace('".$nextpage."')\">Lanjut</a>";		 
		  } else {
			 $lanjut = "TUNGGU DESISI";
		  }	 
		  
		 $user=$arr["USERFO"];
		 $tgluser=$arr["TGLFO"];
		break; 
		
		case '1':
		 $nextpage="pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
		 $user=$arr["USERPTG"];
		 $tgluser=$arr["TGLPTG"];
		 if($arr["KDKLAIM"]=='SDB' || $arr["KDKLAIM"]=='STPD' || $arr["KDKLAIM"]=='PDB' || $arr["KDKLAIM"]=='PTPD' || $arr["KDKLAIM"]=='WAIVER' || $arr["KDKLAIM"]=='WPCI' || $arr["KDKLAIM"]=='WPTPD') {
		 	$izin="cetakizin_klaims.php";}
		 else {
		 	$izin="cetakizin_klaim.php";}
			
		 //$lanjut = "HITUNG NILAI KLAIM DI KASIR";
		 $lanjut = "<a href=# onclick=NewWindow('./".$izin."?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>";	
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('pengajuanklaimFF.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&otorisasibayar=1')\">TERBITKAN NOTA DESISI</a>";
 
		break;
		
		case '2':
		 $nextpage="../akunting/bayar.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
		 $user=$arr["USERADLOG"];
		 $tgluser=$arr["TGLADLOG"];
		 //$lanjut = "Dilanjutkan Kasir [<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>]";	 
		 $lanjut = "<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>";	 
		break;		

		case '3':
		 $lanjut = "SELESAI";		 
		 $user=$arr["USERUPDATED"];
		 $tgluser=$arr["TGLUPDATED"];
		break;		
		/*
		case '4':
		 $nextpage="pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
		 $user=$arr["USERPTG"];
		 $tgluser=$arr["TGLPTG"];
		 //$lanjut = "HITUNG NILAI KLAIM DI KASIR";
		 $lanjut = "<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>";	
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('pengajuanklaimFF.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&otorisasibayar=1')\">TERBITKAN NOTA DESISI</a>";
 		 break;
		 */
	 }
	 
	 if($kantor!=$arr["KDKANTORPROSES"] && $arr["KDKANTORPROSES"]!="")
	 {
	   $ketkantor = "<b>(Diajukan di kantor ".$arr["KDKANTORPROSES"].")</b>";
	 }
	 else
	 {
	   $ketkantor = "";
	 }
	 
	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	 echo "<td>$i</td>";
   echo "<td><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
	 echo "<td>".str_replace("KLAIM","",$arr["NAMAKLAIM"])."</td>";
	 echo "<td>".$arr["TGL_PENGAJUAN"]."</td>";
	 echo "<td>".$tgluser."</td>";
	 echo "<td>".$arr["NAMASTATUS"]."(".$arr["STATUS"].") ".$ketkantor."</td>";
	 echo "<td>".$arr["VALUTA"]."</td>";
	 echo "<td>$lanjut</td>";
   echo "</tr>";
   $i++; 
	}		
?>				
</table>			
Note : Untuk polis yang berasal dari kantor lain, penerbitan SIP dilakukan di kantor asal polis bersangkutan.
<hr size="1">

<font face="verdana" size="2"><a href="../../../submenu.php?mnuinduk=150">Back</a></font>

</body>
</html>
