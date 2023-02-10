<?
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date.php";
	//include "../../includes/dropdown_date.php";
 

	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
?>
<html>

<head>
<title>MANAGEMENT EMAIL BLAST</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<!--b><font size="3">TAGIHAN VS PELUNASAN</font></b-->
<h2>MANAGEMENT EMAIL BLAST</h2>



<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?php

$sql="select a.*,(select count(*) from $DBUser.penerima_email where id_blast = a.id_blast and status = '1') jml_berhasil,
			  (select count(*) from $DBUser.penerima_email where id_blast = a.id_blast and status = 'X') jml_gagal,
			  (select count(*) from $DBUser.penerima_email where id_blast = a.id_blast and status is null and upper(email) not in (select upper(karakter) from $DBUser.exception_sendemail) ) jml_blm_dikirim,
			  (select count(*) from $DBUser.penerima_email where id_blast = a.id_blast) jml_email,
			  (select count(*) from $DBUser.penerima_email 
			   where id_blast = a.id_blast AND UPPER (email) 
			   NOT IN (SELECT   UPPER (karakter) FROM   $DBUser.exception_sendemail) ) jml_invalid
		from $DBUser.email_blast_event a
		order by id_blast desc";
	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	
?>
	<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
		<tr>
			<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(5,"Future");?>				
				<select name='wilayah'>
				<?php
				while ($row=$DB->nextrow()) {				
				?>					
					<option><?=$row["KDKANTOR"];?></option>		        					
				<? 
				$i++;

				}
				?>					
				</select>
				<input type="submit" name="submit" value="GO" class="but">
				<? //echo $sqa;?>
				</td>
		</tr>
	</table>

</form>
<?
if ($submit){
//$conn=ocilogon("JSADM","JSADMABC","GLABC"); 
//echo $day;
if(!isset($month))
{
//  $tglcari = date('Ymd');
//  $tglcari = date('Ym');
  $tglcari = date('m/Y');
}
else
{
//  $tglcari = $year.$month;
  $tglcari = $month.'/'.$year;
}



?>

<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>NO</b></td>		
    	<td align="center"><b>ID</b></td>		
    	<td align="center"><b>JENIS BLAST</b></td>		
    	<td align="center"><b>NAMA EVENT</b></td>		
    	<td align="center"><b>TGL EVENT</b></td>		
    	<td align="center"><b>USER RECORD</b></td>		
    	<td align="center"><b>TGL RECORD</b></td>		
    	<td align="center"><b>TGL EKSEKUSI</b></td>		
    	<td align="center"><b>STATUS EKSEKUSI</b></td>		
    	<td align="center"><b>JML BERHASIL</b></td>		
    	<td align="center"><b>JML BLM DIKIRIM</b></td>		
    	<td align="center"><b>JML GAGAL</b></td>		
    	<td align="center"><b>JML EMAIL INVALID</b></td>		
    	<td align="center"><b>JML EMAIL</b></td>		
    </tr>    
	<?
	//echo $sql;
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["ID_BLAST"];?></td>		        
        <td><?=$row["JENIS_BLAST"];?></td>        	
        <td><?=$row["NAMA_EVENT"];?></td>        	
        <td><?=$row["TGL_EVENT"];?></td>        	
        <td><?=$row["USER_RECORD"];?></td>        	
        <td><?=$row["TGL_RECORD"];?></td>        	
        <td><?=$row["TGL_EKSEKUSI"];?></td>        	        
        <td><?=$row["STATUS_EKSEKUSI"];?></td>        	        
        <td align="right"><?=number_format($row["JML_BERHASIL"],2,",",".");?></td>        
        <td align="right"><?=number_format($row["JML_BLM_DIKIRIM"],2,",",".");?></td>        		       
        <td align="right"><?=number_format($row["JML_GAGAL"],2,",",".");?></td>        		       
        <td align="right"><?=number_format($row["JML_INVALID"],2,",",".");?></td>        		       
        <td align="right"><?=number_format($row["JML_EMAIL"],2,",",".");?></td>        		       
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>
<br />


</form>
<?
}
?>
<script language="JavaScript" type="text/javascript">
	<!--
	function popitup(url) {
		newwindow=window.open(url,'name','height=850,width=1200, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,');
		if (window.focus) {newwindow.focus()}
		return false;
	}
</script>	
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>