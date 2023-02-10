<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/month_selector.php";
include "../../includes/fungsi.php";
include "../../includes/koneksi.php";

$DB=new database($userid, $passwd, $DBName);
$DB1=new database($userid, $passwd, $DBName);

	if(isset($month))
	{
	  $bulancari = $year.$month;
	}
	else
	{
	  $month	= date("m");
		$year		= date("Y");
	  $bulancari = $year.$month;
	}
?>
<script language="JavaScript"> 
function Cekbok(doc){ 
 if (doc == true)
 {
 checkedAll('prosessms', true);
 }
 else
 {
 checkedAll('prosessms', false);
 }
} 
</script>
 <script>
      function checkedAll (id, checked) {
	var el = document.getElementById(id);

	for (var i = 0; i < el.elements.length; i++) {
	  el.elements[i].checked = checked;
	}
      }
</script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="refresh" content="1500;url=http://192.168.2.7/jiwasraya/polis/klaim_anuitas_kolektif.php" />
<title>Download Daftar SMS Jatuh Tempo Premi dan BPO</title>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

<? 
if($act=="print"){
?>
<body onLoad="window.print();window.close()">
<?
} else {
?>
<body topmargin="10">

<h4>DAFTAR MUTASI PERTANGGUNGAN</h4>

<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Mutasi Bulan <?=ShowFromDate(5,"Past");?> 
       
        
		<input type="submit" name="submit" value="GO" class="but"></td>
	</tr>
</table>
</form>
<div class="clear5"> </div>
<? 
}
?>
<b>DAFTAR MUTASI BULAN <?=strtoupper(namaBulan($month));?> <?=$year;?><?
?></b>
<div class="clear3"> </div>
<form name="prosessms" method="post" action="#"><table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td width="2%"><b>No</b></td>
		<td width="4%"><b>Nomor Polis</b></td>		
		<td width="10%" align="left"><b>Pemegang Polis</b></td>
		<td width="5%" align="left"><b>Mutasi</b></td>         
         <td width="4%" align="center"><b>Nomor HP Lama</b></td>
		 <td width="4%" align="center"><b>Nomor HP Baru</b></td>		
		 <td width="4%" align="center"><b>Email Lama</b></td>
		 <td width="4%" align="center"><b>Email Baru</b></td>
		 <td width="4%" align="center"><b>Tanggal Mutasi</b></td>
		 <td width="4%" align="center"><b>User Mutasi</b></td>
	</tr>
	<?	
	$sql="SELECT   to_char(a.tglmutasi,'dd/mm/yyyy')tglmutasi,a.prefixpertanggungan,a.nopertanggungan,c.namaklien1,namamutasi,NO_PONSELOLD,NO_PONSELNEW,EMAILOLD,EMAILNEW,a.USERREKAM from $DBUser.TABEL_603_MUTASI_PERTANGGUNGAN a,
	      $DBUser.tabel_200_pertanggungan b,$DBUser.tabel_100_klien c,$DBUser.tabel_601_kode_mutasi d 
             WHERE   a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan and b.nopemegangpolis=c.noklien and a.kdmutasi=d.kdmutasi
					 AND TO_CHAR (a.tglmutasi, 'YYYYMM') = '".$bulancari."'				 
                     order by a.tglmutasi,a.nopertanggungan";
	
	//echo $sql;
	//die;
	$DB->parse($sql);
  	$DB->execute();
	$i=1;
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td><?=$row["PREFIXPERTANGGUNGAN"].$row["NOPERTANGGUNGAN"];?></td>
		<td><?=$row["NAMAKLIEN1"];?></td>
		<td><?=$row["NAMAMUTASI"];?></td>
		<td><?=$row["NO_PONSELOLD"];?></td>       
		<td><?=$row["NO_PONSELNEW"];?></td>
		<td><?=$row["EMAILOLD"];?></td>
		<td><?=$row["EMAILNEW"];?></td>
		<td><?=$row["TGLMUTASI"];?></td>
		<td><?=$row["USERREKAM"];?></td>
	</tr>
	<? 
	$i++;
	}
	?>
<!--tr><td colspan="4">
<?php
//echo "<a href=# onclick=NewWindow('sms_tagihan_premi_dl.php?act=printY&bulancari=".$bulancari."&carabayar=".$carabayar."&kdperiode=".$kdperiode."','',700,400,1)>Download Rekap</a>";
?>
</td><td colspan="4" align="right">
<input name="approve" type="submit" value="Kirim sms" /></td></tr--></table>
</form>
<hr size="1" color="#c0c0c0">
<?  
include "footer.php"; ?>
</body>
</html>