<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
 
  $DB = new Database($userid, $passwd, $DBName);
  $DB1 = new Database($userid, $passwd, $DBName);
  $DB2 = new Database($userid, $passwd, $DBName);
  $DB3 = new Database($userid, $passwd, $DBName);
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
	echo "<a class=verdana10blu><b>REKAPITULASI JS SAVING PLAN</b></a>";
	echo "<hr size=1>";
	?>
	<table border="1" style="border-collapse: collapse" id="table1" cellpadding="4">
	<tr>
		<td rowspan="2" bgcolor="#3366CC"><font color="#FFFFFF">Kode</font></td>
		<td rowspan="2" bgcolor="#3366CC"><font color="#FFFFFF">Nama Kantor</font></td>
        <td rowspan="2" bgcolor="#3366CC"><font color="#FFFFFF">Produk</font></td>
		<td align="center" colspan="2" bgcolor="#3366CC"><font color="#FFFFFF">Proposal</font></td>
		<td align="center" colspan="2" bgcolor="#3366CC"><font color="#FFFFFF">Pelunasan</font></td>
        <td align="center" colspan="2" bgcolor="#3366CC"><font color="#FFFFFF">Akseptasi</font></td>
	</tr>
    <tr>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah Premi</font></td>
        <td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah Premi</font></td>
        <td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah Premi</font></td>
	</tr>
	<? 
	$sql = "SELECT   KDKANTOR, NAMAKANTOR, b.kdproduk
			FROM   $DBUser.TABEL_001_KANTOR a, $DBUser.TABEL_202_PRODUK b
		   WHERE   KDJENISKANTOR = '2'
				   AND b.KDPRODUK IN ('JSSPAN3', 'JSSPAN6', 'JSSPAN12', 'JSSPAN24')
		ORDER BY   KDKANTOR, DECODE(kdproduk,'JSSPAN3',1, 'JSSPAN6',2, 'JSSPAN12',3, 'JSSPAN24',4)";
  //echo $sql;
	$DB->parse($sql);
    $DB->execute();			
	$i=1;		 
  while ($arr=$DB->nextrow()) {
	echo ($i%2)? "<tr bgcolor=#dceff5>" : "<tr>";
	
	//untuk proposal	
	$sqlp = "select * from $DBUser.sp_proposal where kdkantor='".$arr["KDKANTOR"]."' and produk='".$arr["KDPRODUK"]."'";
	//echo $sqlp;
	$DB2->parse($sqlp);
    $DB2->execute();
	$arr2=$DB2->nextrow();
	
	//untuk bayar	
	$sqlb = "select * from $DBUser.sp_bayar where kdrayonpenagih='".$arr["KDKANTOR"]."' and kdproduk='".$arr["KDPRODUK"]."'";
	$DB3->parse($sqlb);
    $DB3->execute();
	$arr3=$DB3->nextrow();
	
	//untuk akseptasi	
	$sql = "select * from $DBUser.sp_aksep where kdrayonpenagih='".$arr["KDKANTOR"]."' and kdproduk='".$arr["KDPRODUK"]."'";
	$DB1->parse($sql);
    $DB1->execute();
	$arr1=$DB1->nextrow();	

	if ($i==5) {$i=1;}
	if ($i==1) {$kdktr=$arr["KDKANTOR"]; $nmktr=$arr["NAMAKANTOR"];} else {$kdktr=''; $nmktr='';}
	;
	?>
		<td><?=$kdktr;?></td>
		<td><?=$nmktr;?></td>
        <td><?=$arr["KDPRODUK"];?></td>
		<!--<td align="right"><?="<a href=\"#\" onclick=\"NewWindow('portopolioperproduk.php?kdkantor=".$arr["KDRAYONPENAGIH"]."&kdproduk=$kdproduk&vbln=$vbln&vthn=$vthn','popuppage','1000','300','yes')\">";?><?=$arr2["POLIS"];?></a></td>-->
        <td align="right"><?="<a href=\"#\" onclick=\"NewWindow('portopolioperproduk.php?kdkantor=".$arr["KDKANTOR"]."&kdproduk=".$arr["KDPRODUK"]."&vbln=$vbln&vthn=$vthn','popuppage','1000','300','yes')\">";?><?=$arr2["POLIS"];?></a></td>
	    <td align="right"><?=number_format($arr2["PREMI"],2,",",".");?></td>
		<td align="right"><?=$arr3["POLIS"];?></td>
		<td align="right"><?=number_format($arr3["PREMI"],2,",",".");?></td>
		<td align="right"><?=$arr1["JML"];?></td>
		<td align="right"><?=number_format($arr1["JMLPREMI"],2,",",".");?></td>
	</tr>
	<?
	$n++; 
	$i++;
	$jml +=$arr["JML"];
	$jmlpremi +=$arr["JMLPREMI1"];
	$jmljua +=$arr["JUA"];
	$jmlkomisibp3 +=$arr["KOMISIBP3"];
	$jmlkomisi1 +=$arr["KOMISI1"];
	}
	?>
	<tr bgcolor="#a9d8e7">
		<td colspan=3>JUMLAH</td>
		<td align="right"><?=number_format($jml,0,",",".");?></td>
		<td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
		<td align="right"><?=number_format($jmljua,2,",",".");?></td>
		<td align="right"><?=number_format($jmlkomisibp3,2,",",".");?></td>
		<td align="right"><?=number_format($jmlkomisi1,2,",",".");?></td>
        <td align="right"><?=number_format($jmlkomisi1,2,",",".");?></td>
	</tr>
</table>
	<?
	//echo $sqlb;
//}
?>	
<br />
<hr size="1">

<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
  include "../../includes/endtimer.php"; 
 ?>