<?
  include "../../includes/database.php";
  include "../../includes/session.php";
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
<? include "../../includes/hide.php";  ?>
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
<h4>Daftar Tahapan Otomatis</h4>
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
		  $sql = "select kdmutasi,namamutasi from $DBUser.tabel_601_kode_mutasi ";
		  $DB->parse($sql);
    	$DB->execute();
    	while ($ro=$DB->nextrow()) {
			   echo "<option ";
  				if ($ro["KDMUTASI"]==$jns){ echo " selected"; }
  				echo " value=\"".$ro["KDMUTASI"]."\">".$ro["NAMAMUTASI"]."</option>";
			}
			$jnsselect = $jns=="ALL" ? "selected" : "";
		 ?>
		  <option value="" <?=$jnsselect?>>--ALL--</option>
		 </select>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
	</form>
</table>


<hr size="1">

			<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#7dc2d9">
					<td height="20">No</td>
					<td>No.Polis</td>
					<td>Nama Pemegang Polis</td>
					<td>Tgl. Mutasi</td> 
					<td>Jenis Mutasi</td>
					<td>No. HP. Lama</td>
					<td>No. HP. Baru</td>
					<td>Email Lama</td>
					<td>Email Baru</td>					
					<td>User Updated</td>
				</tr>				
<?
  if(isset($month))
	{
	  $bulancari = $year.$month;
		if($month=="all")
		{
		   //$filterbulan = "and to_char(a.tglpengajuan,'YYYY')='".$year."' ";
			 $filterbulan = "and to_char(a.tglmutasi,'YYYY')='".$year."' ";
		}
		else
		{
		   //$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
			 $filterbulan = "and to_char(a.tglmutasi,'YYYYMM')='".$year.$month."' ";
		}
	}
	else
	{
	  $month=date("m");
		$year=date("Y");
	  $bulancari = $year.$month;
		//$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
		$filterbulan = "and to_char(a.tglmutasi,'YYYYMM')='".$year.$month."' ";
	}

   if($jns=="")	{
		$filtermutasi="";
   }else{
	    $filtermutasi="and e.kdmutasi = '$jns' ";
   }
	
 $sql = "select ".
  					"a.prefixpertanggungan,a.nopertanggungan,to_char(a.tglmutasi,'dd/mm/yyyy') tglmutasi,e.namamutasi,a.userrekam, ".
 						"a.no_ponselold,a.no_ponselnew,a.emailold,a.emailnew,c.namaklien1,decode(b.kdvaluta,'1','Rp.','0','RpI.','$') valuta ".
 				"from ".
						"$DBUser.tabel_603_mutasi_pertanggungan a,".
						"$DBUser.tabel_200_pertanggungan b,".
						"$DBUser.tabel_100_klien c, ".						
						"$DBUser.tabel_500_penagih d, ".						
						"$DBUser.tabel_601_kode_mutasi e ".
				"where ".
				    "a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".					
						"AND d.nopenagih = b.nopenagih ".
						//"AND d.kdrayonpenagih = '$kantor' ".
						"AND a.kdmutasi = e.kdmutasi ".
						"AND c.noklien = b.nopemegangpolis ".						
						$filterbulan.
						$filtermutasi.
						" order by a.tglmutasi";
  //echo $sql;
  //die;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {

	
	 
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
	$polisbaru_smart=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];
   echo "<td><a href=\"#\" onclick=\"NewWindow('http://192.168.2.6/smart/list.php?no_polis1=".base64_encode(base64_encode($polisbaru_smart))."','popupkomisi','700','400','yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
	 echo "<td>".$arr["NAMAKLIEN1"]."</td>";
	 echo "<td>".$arr["TGLMUTASI"]."</td>";
	 echo "<td>".$arr["NAMAMUTASI"]."</td>";
	 echo "<td>".$arr["NO_PONSELOLD"]."</td>";
	 echo "<td>".$arr["NO_PONSELNEW"]."</td>";
	 echo "<td>".$arr["EMAILOLD"]."</td>";
	 echo "<td>".$arr["EMAILNEW"]."</td>";	 
	 echo "<td>".$arr["USERREKAM"]."</td>";	 
   echo "</tr>";
   $i++; 
	}		
?>				
</table>			

<hr size="1">

<a href="../polisserv.php">Download</a>

<hr size="1">

<a href="../polisserv.php">Menu Pemeliharaan Polis</a>

</body>
</html>
