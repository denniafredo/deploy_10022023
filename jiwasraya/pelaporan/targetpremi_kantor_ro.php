<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  
	$DB=new database($userid, $passwd, $DBName);
	$prefix=strtoupper($prefix);
	$bln = (!$bl) ? $bln : '';
	function ShowMonth() {
  GLOBAL $month;
    	 //MONTH
       echo "<select name=month>";
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
<?	
$year = isset($year) ? $year : date("Y"); 
if(!isset($month))
{
$month = date('m');
$month2 = date('m');
}
?>

<h4>Target vs Realisasi Premi Regional Office</h4>

<table cellpadding="1" cellspacing="2">
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
 <tr>
    <td align="left">Bulan </td>
		<td>
		<?  ShowMonth(); ?> s.d <? ShowFromDate(10,"Past"); ?> 
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
					<td align="center"><a href="<?="$PHP_SELF?f=x.kdkantor&o=$o&year=$year&month=$month&month2=$month2";?>"><b>Kd.Kantor</b></a></td>
					<td align="center">Nama Kantor</td>
					<td align="center"><a href="<?="$PHP_SELF?f=premitarget&o=$o&year=$year&month=$month&month2=$month2";?>"><b>Target Premi</b></a></td>
					<td align="center"><a href="<?="$PHP_SELF?f=premirealisasi&o=$o&year=$year&month=$month&month2=$month2";?>"><b>Realisasi Premi</b></a></td>
					<td align="center"><a href="<?="$PHP_SELF?f=persen&o=$o&year=$year&month=$month&month2=$month2";?>"><b>Persen</b></a></td>
				</tr>				
         <?
         $sql = "select 
                    x.kdkantor,
                    (select namakantor from $DBUser.tabel_001_kantor where kdkantor=x.kdkantor||'A') namakantor,
                    y.premitarget,x.premirealisasi,round(((x.premirealisasi/y.premitarget)*100),2) as persen
                from 
                (select 
                    substr(b.kdrayonpenagih,1,1) as kdkantor,
                    SUM (round(decode(a.kdvaluta,'3',a.premi1 * a.indexawal,a.premi1))) AS premirealisasi
                from 
                    $DBUser.tabel_200_pertanggungan a,
                    $DBUser.tabel_500_penagih b
                where 
                    a.nopenagih=b.nopenagih
                    and a.kdstatusfile='1' 
                    and a.kdpertanggungan='2'
										and to_char(a.mulas,'YYYYMM') between '$year$month' and '$year$month2' 
                    group by substr(b.kdrayonpenagih,1,1) 
                    order by substr(b.kdrayonpenagih,1,1)) x,
                ( 
                select substr(kdkantor,1,1) as kdkantor,sum(target_nb) as premitarget 
                    from $DBUser.tabel_401_target_kantor
                    where tahun='$year' 
                    group by substr(kdkantor,1,1)
                    order by substr(kdkantor,1,1)
                ) y
                where 
                x.kdkantor=y.kdkantor(+)
                order by $f $ad";
					//echo $sql;
        	$DB->parse($sql);
        	$DB->execute();
        	$i=1;
        	while ($arr=$DB->nextrow()) {
        
        	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
        	 echo "<td>$i</td>";
           echo "<td>".$arr["KDKANTOR"]."A</td>";
        	 echo "<td>".$arr["NAMAKANTOR"]."</td>";
        	 echo "<td align=right>".number_format($arr["PREMITARGET"],2,",",".")."</td>";
        	 echo "<td align=right>".number_format($arr["PREMIREALISASI"],2,",",".")."</td>";
        	 echo "<td align=right>".number_format($arr["PERSEN"],2,",",".")."</td>";
           echo "</tr>";
           $i++; 
        	}		
        ?>				
        </table>			

<hr size="1">

<a href="index.php">Menu Pelaporan</a>

</body>
</html>
