<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

	?>
	<style type="text/css">
<!-- 
td {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>


	<?
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=verdana10blu><b>BALANCING TABEL TRANSAKSI DAN TABEL SALDO DANAREKSA</b></a>";
	echo "<hr size=1>";
?>
 <br>
 <table border="1" style="border-collapse: collapse" id="table1" cellpadding="5">
 <tr>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">No</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">Nomor Polis</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">Nama Pemegang Polis</font></td>
  <td bgcolor="#3300ff" align="center" colspan="5"><font color="#FFFFFF">Tabel Transaksi</font></td>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Tabel Saldo</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="3"><font color="#FFFFFF">Selisih</font></td>
 </tr>
 <tr>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Subscription/Top-Up</font></td>
  <td bgcolor="#3300ff" align="center" colspan="2"><font color="#FFFFFF">Redemption</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="2"><font color="#FFFFFF">Saldo Unit</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="2"><font color="#FFFFFF">Transaksi Terakhir</font></td>
  <td bgcolor="#3300ff" align="center" rowspan="2"><font color="#FFFFFF">Saldo Unit</font></td>
 </tr>
 <tr>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Tgl Transaksi Terakhir</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Jumlah Unit</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Tgl Transaksi Terakhir</font></td>
  <td bgcolor="#3300ff" align="center"><font color="#FFFFFF">Jumlah Unit</font></td>
 </tr> 
<?
$myServer   = "danareksa";
$myUser 		= "sa";
$myPass 		= "siar";
$myDB				= "siar";
$s = mssql_connect($myServer, $myUser, $myPass) or die("Couldn't connect to SQL Server on $myServer");
$d = mssql_select_db($myDB, $s) or die("Couldn't open database $myDB");
/*
$sqa = "SELECT *, convert(varchar,TGL_TRANSAKSI_PLUS_TERAKHIR,103) as TGL_TRANSAKSI_PLUS_TERAKHIR, 
convert(varchar,TGL_TRANSAKSI_MINUS_TERAKHIR,103) as TGL_TRANSAKSI_MINUS_TERAKHIR, 
convert(varchar,TRANSAKSI_TERAKHIR,103) as TRANSAKSI_TERAKHIR FROM vSelisihSaldo 
where nopol like 'AF001524257%'
ORDER BY SELISIH DESC";
*/
$sqa = "SELECT *, convert(varchar,TGL_TRANSAKSI_PLUS_TERAKHIR,103) as TGL_TRANSAKSI_PLUS_TERAKHIR, convert(varchar,TGL_TRANSAKSI_MINUS_TERAKHIR,103) as TGL_TRANSAKSI_MINUS_TERAKHIR, convert(varchar,TRANSAKSI_TERAKHIR,103) as TRANSAKSI_TERAKHIR FROM vSelisihSaldo ORDER BY SELISIH DESC";
//echo $sqa;
$msresults= mssql_query($sqa);

$i=1;
while ($row = mssql_fetch_array($msresults)){
			 
		if ($i%2){
			 $bg="#ccffff";
			 $bgf="#0000cc";		
		}
		else{
			 $bg="#ffff99";		
			 $bgf="#000000";		
		}
?>
     <tr bgcolor="#ffffcc">
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=$i;?></font></td>
      <td bgcolor=<?=$bg;?> align="left"><font color=<?=$bgf;?>><a href="#" onclick="NewWindow('../polis/mutasi_jslink.php?noper=<?=substr($row['NOPOL'],2,9);?>&prefix=<?=substr($row['NOPOL'],0,2);?>','popuppage','760','350','yes')"><?=$row["NOPOL"];?></a></font></td>
      <td bgcolor=<?=$bg;?> align="left"><font color=<?=$bgf;?>><?=$row["UnitHolderName"];?></font></td>
      <td bgcolor=<?=$bg;?> align="center"><font color=<?=$bgf;?>><?=$row["TGL_TRANSAKSI_PLUS_TERAKHIR"];?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($row["JML_UNIT_PLUS"],4,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="center"><font color=<?=$bgf;?>><?=$row["TGL_TRANSAKSI_MINUS_TERAKHIR"];?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($row["JML_UNIT_MINUS"],4,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($row["SISA_UNIT_TRANSAKSI"],4,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="center"><font color=<?=$bgf;?>><?=$row["TRANSAKSI_TERAKHIR"];?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($row["SaldoUnit"],4,",",".");?></font></td>
      <td bgcolor=<?=$bg;?> align="right"><font color=<?=$bgf;?>><?=number_format($row["SELISIH"],4,",",".");?></font></td>
     </tr>  
		 
<?
	$i=$i+1;
}
?>
	
</table>
<br />
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
  include "../../includes/endtimer.php"; 
?>