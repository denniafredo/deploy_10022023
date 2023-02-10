<? 
include "../../includes/session.php"; 
include "../../includes/database.php"; 
include "../../includes/month_selector.php";
include "../../includes/fungsi.php";
include "../../includes/koneksi.php";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=download_sms_tagihan_premi.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");

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
					
										
					$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$ket[0]."','".$ket[1]."')";
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="refresh" content="1500;url=http://192.168.2.7/jiwasraya/polis/klaim_anuitas_kolektif.php" />
<title>SMS Jatuh Tempo Premi dan BPO</title>
<!--<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">-->
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

<b>DOWNLOAD SMS JATUH TEMPO PREMI BULAN <?=strtoupper(namaBulan($month));?> <?=$year;?><?
if($kdperiode=='1'){
	echo " PERIODE I";
	$wper=" and TO_CHAR (a.tglrekam, 'DD')='01' ";
}elseif($kdperiode=='2'){
	echo " PERIODE II";
	$wper=" and TO_CHAR (a.tglrekam, 'DD')='11' ";
}elseif($kdperiode=='3'){
	$wper=" and TO_CHAR (a.tglrekam, 'DD')='21' ";
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
	</tr>
	<?
	if($carabayar=="M")
		$cabay = " and a.kdsms in ('M','N','R','C') ";
	elseif($carabayar=="X")
		$cabay = " and a.kdsms in ('X') ";
	elseif($carabayar=="B")
		$cabay = " and a.kdsms in ('B') ";	
	$sql="SELECT   a.phone,a.message,a.kdsms,b.jenissms,to_char(a.tglbooked,'dd/mm/yyyy') tglbooked,a.status from $DBUser.tabel_200_sms a,$DBUser.tabel_200_kode_sms b 
             WHERE   a.kdsms=b.kdsms
					 AND TO_CHAR (a.tglrekam, 'YYYYMM') = '".$bulancari."'
					 ".$wper."
                     AND a.STATUS ='0'
					 ".$cabay."
                     ";
	
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
	</tr>
	<? 
	$i++;
	}
	?>
</table>
</form>
<hr size="1" color="#c0c0c0">
<? } 
//include "footer.php"; ?>
</body>
</html>