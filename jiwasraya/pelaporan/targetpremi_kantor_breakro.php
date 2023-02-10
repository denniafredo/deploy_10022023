<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  
	$DB=new database($userid, $passwd, $DBName);
	$prefix=strtoupper($prefix);
	$bln = (!$bl) ? $bln : '';
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;
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
<?	$year = isset($year) ? $year : date("Y"); ?>

<h4>Target vs Realisasi Premi Kantor Tahun <?=$year;?></h4>

<table cellpadding="1" cellspacing="2">
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
 <tr>
    <td align="left">Bulan Pengajuan</td>
		<td>:</td>
		<td>
		 <?  ShowFromDate(10,"Past"); ?> <input name="cari" value="GO" type="submit">
		</td>
	</tr> 
	</form>
</table>

	

<hr size="1">
			<? 
			$f  = (!$f) ? 'x.kdkantor' : $f;
			$ad = ($o==1) ? 'asc' : 'desc';
			$o = (int)!((boolean)$o);
			 ?>
			<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#ffdeb3">
					<td height="20">No</td>
					<td align="center"><b>Kd.Kantor</b></a></td>
					<td align="center"><b>Nama Kantor</b></td>
					<td align="center"><b>Target Premi</b></td>
					<td align="center"><b>Realisasi Premi</b></td>
					<td align="center"><b>Persen</b></td>
				</tr>				
         <?
         $sql = "select 
                    x.kdkantor,
                    (select namakantor from $DBUser.tabel_001_kantor where kdkantor=x.kdkantor) namakantor,
                    y.premitarget,x.premirealisasi,round(((x.premirealisasi/y.premitarget)*100),2) as persen
                from 
                (select 
                    b.kdrayonpenagih as kdkantor,
                    SUM (round(decode(a.kdvaluta,'3',a.premi1 * a.indexawal,a.premi1))) AS premirealisasi
                from 
                    $DBUser.tabel_200_pertanggungan a,
                    $DBUser.tabel_500_penagih b
                where 
                    a.nopenagih=b.nopenagih
                    and a.kdstatusfile='1' 
                    and a.kdpertanggungan='2'
                    and to_char(a.mulas,'YYYY')='$year'
                    group by b.kdrayonpenagih 
                    order by kdrayonpenagih) x,
                (select 
                    kdkantor,target_nb as premitarget,target_ob 
                    from $DBUser.tabel_401_target_kantor
                    where tahun='$year' order by kdkantor
                ) y
                where 
                x.kdkantor=y.kdkantor(+)
                order by x.kdkantor";
          
					//echo $sql;
        	$DB->parse($sql);
        	$DB->execute();
        	$i=1;
        	while ($arr=$DB->nextrow()) {
           $ro = substr($arr["KDKANTOR"],0,1);
					 ${"totpremitarget".$ro} =  $arr["PREMITARGET"];
					 ${"totpremirealisasi".$ro} =  $arr["PREMIREALISASI"];
						
        	 if($prefro == $ro){} else {
					 echo "<tr bgcolor=#d5e7fd>";
					 echo "<td>$i</td>";
           echo "<td>".$ro."</td>";
        	 echo "<td>".$arr["NAMAKANTORs"]."</td>";
        	 echo "<td align=right>".number_format(${"totpremitarget".$ro},2,",",".")."</td>";
        	 echo "<td align=right>".number_format(${"totpremirealisasi".$ro},2,",",".")."</td>";
        	 echo "<td align=right>".number_format($arr["PERSENx"],2,",",".")."</td>";
					 echo "</tr>";
					 }
					 
					 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
        	 echo "<td>$i</td>";
           echo "<td>".$arr["KDKANTOR"]."</td>";
        	 echo "<td>".$arr["NAMAKANTOR"]."</td>";
        	 echo "<td align=right>".number_format($arr["PREMITARGET"],2,",",".")."</td>";
        	 echo "<td align=right>".number_format($arr["PREMIREALISASI"],2,",",".")."</td>";
        	 echo "<td align=right>".number_format($arr["PERSEN"],2,",",".")."</td>";
           echo "</tr>";
					
					 
					 
					  $prefro = $ro; 
           $i++;
					 
        	}		
        ?>				
        </table>			

<hr size="1">

<a href="../polisserv.php">Menu Pemeliharaan Polis</a>

</body>
</html>
