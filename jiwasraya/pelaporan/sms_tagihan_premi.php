<? 
set_time_limit(10000001);
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/month_selector.php";
include "../../includes/fungsi.php";
include "../../includes/koneksi.php";

$DB=new database($userid, $passwd, $DBName);
$DB1=new database($userid, $passwd, $DBName);
if ($approve) {
      	
      	$box=$checkanuitas; //as a normal var
      	$box_count=count($box); // count how many values in array		
      	if (($box_count)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{				
    				foreach ($box as $dear) {														
					$ket = explode('!',$dear);					
															
					$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) ".
							  "VALUES('".$ket[0]."','".$ket[1]."','".$ket[4]."','".$ket[5]."','".$ket[6]."','".$ket[7]."')";
					//echo $mysqlins."<br>";
					if(mysql_query($mysqlins)){
						$sqlselect="update $DBUser.tabel_200_sms set status='1' where phone='".$ket[0]."' and message='".$ket[1]."' and to_char(tglbooked,'DD/MM/YYYY')='".$ket[3]."' and kdsms='".$ket[2]."'";
						//echo $sqlselect."<br>";	
						$DB1->parse($sqlselect);
						$DB1->execute();
					}					
					//$tglcari=$tglupdate;
					
					//echo "<tr><td>".$ket[0]."</td><td>".$ket[1]."</td><td>".$ket[2]."</td><td>".$ket[3]."</td><td>".$tglupdate."</td><td>".$ket[7]."</td><td>".$ket[8]."</td><td>".$ket[9]."</td></tr>";
								
					
					}					
					} 
						?>
					</table>
					<?
					echo $box_count." sms berhasil terkirim...<br>";
					print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
					print( "<!--\n" );										  
					print( "window.close();" );
					print( "//-->\n" );
					print( "</script>\n" );
}else{
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

<h4>SMS JATUH TEMPO PREMI BPO</h4>

<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Jatuh Tempo Bulan <?=ShowFromDate(5,"Past");?> 
        <select name="kdperiode">
        <option value="1" <? if ($kdperiode==1) { echo "selected";} else {}?>>Periode I</option>
        <option value="2" <? if ($kdperiode==2) { echo "selected";} else {}?>>Periode II</option>
        <option value="3" <? if ($kdperiode==3) { echo "selected";} else {}?>>Periode III</option>
        </select>
		Cara Bayar 
		<select name="carabayar">
        <option value="X" <? if ($carabayar=='X') { echo "selected";} else {}?>>Non Autodebet</option>
        <option value="M" <? if ($carabayar=='M') { echo "selected";} else {}?>>Autodebet</option>        
		<option value="B" <? if ($carabayar=='B') { echo "selected";} else {}?>>Pemberitahuan BPO</option>
        </select>
        
		<input type="submit" name="submit" value="GO" class="but"></td>
	</tr>
</table>
</form>
<div class="clear5"> </div>
<? 
}
?>
<b>DAFTAR JATUH TEMPO PREMI BULAN <?=strtoupper(namaBulan($month));?> <?=$year;?><?
if($kdperiode=='1'){
	echo " PERIODE I";
	$wper=" and TO_CHAR (a.tglrekam, 'DD')='01' ";
	//$wper=" and TO_CHAR (a.tglrekam, 'DD') between '01' and '10' ";
}elseif($kdperiode=='2'){
	echo " PERIODE II";
	$wper=" and TO_CHAR (a.tglrekam, 'DD')='11' ";
	//$wper=" and TO_CHAR (a.tglrekam, 'DD') between '11' and '20' ";
}elseif($kdperiode=='3'){
	$wper=" and TO_CHAR (a.tglrekam, 'DD')='21' ";
	//$wper=" and TO_CHAR (a.tglrekam, 'DD') between '21' and '31' ";
	echo " PERIODE III";
} 
?></b>
<div class="clear3"> </div>
<form name="prosessms" method="post" action="#"><table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td width="2%"><b>No</b></td>
		<td width="4%"><b>NO. HP</b></td>		
		<td width="65%" align="left"><b>Pesan</b></td>
		<td width="23%" align="left"><b>Jenis Cara Bayar</b></td>         
         <td width="4%" align="center"><b>Tgl. Jatuh Tempo</b></td>
		<td width="2%" align="center"><b>Check<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></b></td>
	</tr>
	<?
	if($carabayar=="M")
		$cabay = " and a.kdsms in ('M','N','R','C','T','P') ";
	elseif($carabayar=="X")
		$cabay = " and a.kdsms in ('X') ";
	elseif($carabayar=="B")
		$cabay = " and a.kdsms in ('B') ";
	else
		$cabay = " and a.kdsms='' ";	
	$sql="SELECT   a.phone,a.message,a.kdsms,b.jenissms,to_char(a.tglbooked,'dd/mm/yyyy') tglbooked,a.status,kdkantor,divisi,nomorpolis from $DBUser.tabel_200_sms a,$DBUser.tabel_200_kode_sms b 
             WHERE   a.kdsms=b.kdsms
					 AND TO_CHAR (a.tglrekam, 'YYYYMM') = '".$bulancari."'
					 ".$wper."                     
					 ".$cabay."
                     order by phone";
	
	//echo $sql;
	//die;
	$DB->parse($sql);
  	$DB->execute();
	$i=1;
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td><?=$row["PHONE"];?></td>
		<td><?=$row["MESSAGE"];?></td>
		<td><?=$row["JENISSMS"];?></td>
		<td align="center"><?=$row["TGLBOOKED"];?></td>        
		<td align="center">
  		<? 
		if($row["STATUS"]==0){
  		?>
			<input type="checkbox" name="checkanuitas[]" value="<?=$row["PHONE"]."!".$row["MESSAGE"]."!".$row["KDSMS"]."!".$row["TGLBOOKED"]."!".$row["JENISSMS"]."!".$row["KDKANTOR"]."!".$row["DIVISI"]."!".$row["NOMORPOLIS"]; ?>">
			<?
  		}
  		elseif($row["STATUS"]==1){
  		?>
			N/A
			<?
  		}
  		else
  		{
			?>
			<input type="checkbox" name="checkanuitas[]" value="<?=$row["PHONE"]."/".$row["MESSAGE"]."/".$row["KDSMS"]; ?>">
			<?
			
  		}
  		?>
		</td>
	</tr>
	<? 
	$i++;
	}
	?>
<tr><td colspan="4">
<?php
echo "<a href=# onclick=NewWindow('sms_tagihan_premi_dl.php?act=printY&bulancari=".$bulancari."&carabayar=".$carabayar."&kdperiode=".$kdperiode."','',700,400,1)>Download Rekap</a>";
?>
</td><td colspan="4" align="right">
<input name="approve" type="submit" value="Kirim sms" /></td></tr></table>
</form>
<hr size="1" color="#c0c0c0">
<? } 
include "footer.php"; ?>
</body>
</html>