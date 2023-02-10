<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
  $DB = new Database($userid, $passwd, $DBName);
	
	function ShowFromDate($year_interval,$YearIntervalType) {
  GLOBAL $day,$month,$year;
  //YEAR
    echo "<select name=year class=pilih9>\n";
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
				 $selall = $_POST['year']=="ALL" ? "selected" : "";
				 echo "<option value=ALL $selall>-ALL-</option>";
         echo "</select>\n";
    }
    
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
<style type="text/css">
<!-- 
body { 
 font-size: 12px;
 font-family: verdana;
 } 
td { 
 font-size: 10px;
 font-family: verdana;
 } 
-->
</style>
</head>
<body>


<table width="100%" cellpadding="0" cellspacing="0">
<form name="jssopget" method="post" action="<?=$PHP_SELF;?>" >
<tr bgcolor="#b0cbe6">
<td height="25">&nbsp;&nbsp;&nbsp;
<b>PERKEMBANGAN PRODUKSI JS PLAN OPTIMA 
<? 
$thjudul = isset($_POST['year'])? "TAHUN ".$_POST['year']."" : "TAHUN ".date('Y')."";
echo $_POST['year']=="ALL" ? "" : "".$thjudul."";
?>
</b>
</td>
<td align="right">
Pilih Tahun <? 
ShowFromDate(5,"Past");
 ?>
 <input type="submit" name="cari" value="GO">
</td>
</tr>
</form>
</table>
<br />
<?
if(isset($_POST['cari']))
{
  if($_POST['year']=="ALL")
	{
	  $filtertahun = " ";
	}
	else
	{
    $filtertahun = "and to_char(mulas,'YYYY')='".$_POST['year']."' ";
	}
}
else
{
  $filtertahun = "and to_char(mulas,'YYYY')='".date('Y')."' ";
}
    $sql = "select ".
      	 	 		 "a.kdproduk,a.namaproduk,".
							 "b.masa4,nvl(b.jmlpolis4,0) as jmlpolis4,b.jmlpremi4,b.jua4,".
							 "c.masa5,nvl(c.jmlpolis5,0) as jmlpolis5,c.jmlpremi5,c.jua5 ".
					 "from ".
					     "$DBUser.tabel_202_produk a,".
							 "(select kdproduk,count(nopertanggungan) as jmlpolis4,".
                "sum(juamainproduk) as jua4, sum(premi1) as jmlpremi4,lamaasuransi_th as masa4 ".
                "from $DBUser.tabel_200_pertanggungan where kdproduk like 'JSSPO%' and  ".
                "kdstatusfile='1' and  ".
                "kdpertanggungan='2' and lamaasuransi_th='4' ".
								$filtertahun.
								//"and to_char(mulas,'YYYY')='2006' ".
                "group by kdproduk,lamaasuransi_th) b, ".
                
                "(select kdproduk,count(nopertanggungan) as jmlpolis5, ".
                "sum(juamainproduk) as jua5, sum(premi1) as jmlpremi5,lamaasuransi_th as masa5 ".
                "from $DBUser.tabel_200_pertanggungan where kdproduk like 'JSSPO%' and  ".
                "kdstatusfile='1' and  ".
                "kdpertanggungan='2' and lamaasuransi_th='5' ".
								$filtertahun.
								//"and to_char(mulas,'YYYY')='2006' ".
                "group by kdproduk,lamaasuransi_th) c  ".
        	 "where ".
					  		"a.kdproduk=b.kdproduk(+)  ".
                "and a.kdproduk=c.kdproduk(+)  ".
                "and a.kdproduk like 'JSSPO%' order by a.kdproduk";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
?>
<table border="1" style="border-collapse: collapse" width="100%" id="table1" bordercolor="#82ABD5" cellspacing="0" cellpadding="6">
	<tr>
		<td colspan="10" align="center" bgcolor="#A8DBEA"><b>STATUS POLIS AKTIF</b></td>
	</tr>
	<tr>
		<!--<td rowspan="2" bgcolor="#A8DBEA"><b>Kode Produk</b></td>-->
		<td rowspan="2" bgcolor="#A8DBEA"><b>Nama Produk</b></td>
		<td colspan="3" align="center" bgcolor="#A8DBEA"><b>Masa 4 Tahun</b></td>
		<td colspan="3" align="center" bgcolor="#A8DBEA"><b>Masa 5 Tahun</b></td>
		<td colspan="3" align="center" bgcolor="#A8DBEA"><b>Jumlah</b></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#A8DBEA"><b>Polis</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>JUA</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>Premi</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>Polis</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>JUA</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>Premi</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>Polis</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>JUA</b></td>
		<td align="center" bgcolor="#A8DBEA"><b>Premi</b></td>
	</tr>
	<? 
	while($row=$DB->nextrow()){
	?>
	<tr>
		<!--<td><?=$row["KDPRODUK"];?></td>-->
		<td><?=$row["NAMAPRODUK"];?></td>
		<td align="right"><?=$row["JMLPOLIS4"];?></td>
		<td align="right"><?=number_format($row["JUA4"],2,",",".");?></td>
		<td align="right"><?=number_format($row["JMLPREMI4"],2,",",".");?></td>
		<td align="right"><?=$row["JMLPOLIS5"];?></td>
		<td align="right"><?=number_format($row["JUA5"],2,",",".");?></td>
		<td align="right"><?=number_format($row["JMLPREMI5"],2,",",".");?></td>
		<td align="right"><?=$row["JMLPOLIS4"]+$row["JMLPOLIS5"];?></td>
		<td align="right"><?=number_format($row["JUA4"]+$row["JUA5"],2,",",".");?></td>
		<td align="right"><?=number_format($row["JMLPREMI4"]+$row["JMLPREMI5"],2,",",".");?></td>
	</tr>
	<? 
	$jmlpolis4 += $row["JMLPOLIS4"];
	$jmljua4 	 += $row["JUA4"];
	$jmlpremi4 += $row["JMLPREMI4"];
	
	$jmlpolis5 += $row["JMLPOLIS5"];
	$jmljua5 	 += $row["JUA5"];
	$jmlpremi5 += $row["JMLPREMI5"];
	
	$totpolis += $row["JMLPOLIS4"]+$row["JMLPOLIS5"];
	$totjua		+= $row["JUA4"]+$row["JUA5"];
	$totpremi	+= $row["JMLPREMI4"]+$row["JMLPREMI5"];
	}
	?>
	<tr>
		<td bgcolor="#D0ECF4" align="center"><b>Jumlah</b></td>
		<td align="right" bgcolor="#D0ECF4"><?=$jmlpolis4;?></td>
		<td align="right" bgcolor="#D0ECF4"><?=number_format($jmljua4,2,",",".");?></td>
		<td align="right" bgcolor="#D0ECF4"><?=number_format($jmlpremi4,2,",",".");?></td>
		<td align="right" bgcolor="#D0ECF4"><?=$jmlpolis5;?></td>
		<td align="right" bgcolor="#D0ECF4"><?=number_format($jmljua5,2,",",".");?></td>
		<td align="right" bgcolor="#D0ECF4"><?=number_format($jmlpremi5,2,",",".");?></td>
		<td align="right" bgcolor="#D0ECF4"><?=$totpolis;?></td>
		<td align="right" bgcolor="#D0ECF4"><?=number_format($totjua,2,",",".");?></td>
		<td align="right" bgcolor="#D0ECF4"><?=number_format($totpremi,2,",",".");?></td>
	</tr>
</table>
<br /><br>
<hr size="1" color="#c0c0c0">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;

</body>
</html>