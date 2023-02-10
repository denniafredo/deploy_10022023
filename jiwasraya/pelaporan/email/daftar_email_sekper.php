<? 

	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date_year.php";
	//include "../../includes/dropdown_date.php";
 
	$userid = "jsadm";
	$passwd = "jsadmoke";
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

if($_GET['action']=='hapus_billing'){
$sql="delete from email_blast_event where id_blast = ".$_GET['idblast'];
$DB->parse($sql);
$DB->execute();
$sql="delete from PENERIMA_EMAIL_TES where id_blast = ".$_GET['idblast'];
$DB->parse($sql);
$DB->execute();
}		
		
$sql="select a.*,TO_CHAR(add_months(tgl_event,-1),'DD/MM/YYYY') tglperiode,
		   (select count(*) from $DBUser.penerima_email_tes where id_blast = a.id_blast) total_billing,
		   (select count(*) from $DBUser.penerima_email_tes where id_blast = a.id_blast and email is not null) total_email,
		   (select count(*) from $DBUser.penerima_email_tes 
			where id_blast = a.id_blast AND UPPER (email) 
			NOT IN (SELECT   UPPER (karakter) FROM   $DBUser.exception_sendemail) ) email_valid,
			(SELECT   COUNT ( * )
              FROM   $DBUser.penerima_email_tes
             WHERE   id_blast = a.id_blast AND file_pdf IS NOT NULL)GENERATED_EMAIL,
		   (select count(*) from $DBUser.penerima_email_tes 
			where id_blast = a.id_blast AND UPPER (email) 
			IN (SELECT   UPPER (karakter) FROM   $DBUser.exception_sendemail) ) email_jml_invalid,        
		   (select count(*) from $DBUser.penerima_email_tes 
			where id_blast = a.id_blast and status = '1'
			AND UPPER (email) 
			NOT IN (SELECT   UPPER (karakter) FROM   $DBUser.exception_sendemail) ) jml_kirim_valid_berhasil,
		   (select count(*) from $DBUser.penerima_email_tes 
			where id_blast = a.id_blast and status = 'X'
			AND UPPER (email) 
			NOT IN (SELECT   UPPER (karakter) FROM   $DBUser.exception_sendemail)) jml_kirim_valid_gagal,                      
		  (select count(*) from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast 
		   and status is null and upper(email) not in (select upper(karakter) from $DBUser.exception_sendemail) ) jml_valid_blm_dikirim,
		  (select count(*) from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast 
		   and status ='X' and upper(email) not in (select upper(karakter) from $DBUser.exception_sendemail) ) jml_valid_gagal_dikirim, 
		  (select count(*) 
		   from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast         
		   and NO_HP is not null) jml_sms, 
		  (select count(*) 
		   from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast 
		   and TGL_KIRIM_SMS is null 
		   and NO_HP is not null) jml_blm_dikirim_sms,
		  (select count(*) 
		   from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast 
		   and TGL_KIRIM_SMS is not null 
		   and NO_HP is not null) jml_dikirim_sms,
		  (select count(*) 
		   from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast 
		   and url <> 'invalid') jml_url_valid,
		  (select count(*) 
		   from $DBUser.penerima_email_tes 
		   where id_blast = a.id_blast 
		   and url = 'invalid') jml_url_invalid	
		from $DBUser.email_blast_event a
		where to_char(tgl_event,'yyyy') = (case when nvl('".$_POST['year']."',0) = 0 or '".$_POST['year']."' = '' then to_char(sysdate,'yyyy') else '".$_POST['year']."' end)
		and gruping = (case when nvl('".$_POST['gruping']."','') = '' or '".$_POST['gruping']."' = '' then 'GRUP' else '".$_POST['gruping']."' end)
		and jenis_blast in ('EMAIL_HISTORIS_JL4','EMAIL_HISTORIS_JL3')
		order by id_blast desc";	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	
?>
	<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
		<tr>
			<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoMonthDay(4,"Past");?>	
				<select name='gruping'>
					<option value="<?=$_POST["gruping"];?>"><?=$_POST["gruping"];?></option>
					<option value="GRUP">GRUP</option>
					<option value="INDIVIDU">INDIVIDU</option>
				</select>
				<input type="submit" name="submit" value="GO" class="but">
				<? //echo $sqa;?>
				</td>
		</tr>
		<tr>
			<td bgcolor="#CEE7FF">				
				<a href="entry_event_historis_transaksi.php" class="verdana8blu">Create Event Blast Historis Transaksi</a><br>
				<a href="entry_event_satuan_historis_transaksi.php" class="verdana8blu">Create Event Blast Historis Transaksi Satuan</a>
			</td>
		</tr>
	</table>

</form>
<?
//if ($submit){
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

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>NO</b></td>		
    	<td align="center"><b>ID</b></td>		
    	<td align="center"><b>JENIS BLAST</b></td>		
    	<td align="center"><b>NAMA EVENT</b></td>		
		<td align="center"><b>ACTION</b></td>	
    	<td align="center"><b>TGL EVENT</b></td>		    	
    	<td align="center"><b>USER RECORD</b></td>		
    	<td align="center"><b>TGL RECORD</b></td>		
    	<td align="center"><b>TGL EKSEKUSI</b></td>		    	
    	<td align="center"><b>JML BILLING</b></td>		
    	<td align="center"><b>EMAIL</b></td>		
    	<td align="center"><b>SMS</b></td>		
    	<td align="center"><b>URL</b></td>		    	
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
        <td>
		<?php
		
		if($row["JML_VALID_BLM_DIKIRIM"]>0){
		?>	
		<a href="email.kirim_pdf_historis_transaksi.php?idblast=<?=$row["ID_BLAST"];?>">Kirim Email</a><br><br>						 				
		<?php }else{ ?>	
		<a href="daftar_email_sekper.php?idblast=<?=$row["ID_BLAST"];?>&action=hapus_billing">Hapus</a><br><br>						 						
		<?php } ?>	
		<br>
		<a href="detail_daftar_email_sekper.php?idblast=<?=$row["ID_BLAST"];?>&jenis_blast=<?=$row["JENIS_BLAST"];?>&gruping=<?=$_POST["gruping"];?>">Detail</a><br><br>
		
		</td>        	
        <td><?=$row["TGL_EVENT"];?></td>        	
        <td><?=$row["USER_RECORD"];?></td>        	
        <td><?=$row["TGL_RECORD"];?></td>        	
        <td><?=$row["TGL_EKSEKUSI"];?></td>        	                       
        <td align="right"><?=number_format($row["TOTAL_BILLING"],2,",",".");?></td>        
        <td>
			<a href="#" onclick="popitup('detail_email.php?jenis=TOTAL&id_blast=<?=$row["ID_BLAST"];?>')">
			Total</a> : 
			<?=number_format($row["TOTAL_EMAIL"],2,",",".");?><br><br>						
			
			<a href="#" onclick="popitup('detail_email.php?jenis=VALID&id_blast=<?=$row["ID_BLAST"];?>')">
			Valid</a> : 
			<?=number_format($row["EMAIL_VALID"],2,",",".");?><br><br>
			
			<a href="#" onclick="popitup('detail_email.php?jenis=GENERATED&id_blast=<?=$row["ID_BLAST"];?>')">
			Generated</a> : 
			<?=number_format($row["GENERATED_EMAIL"],2,",",".");?><br><br>						
			
			<a href="#" onclick="popitup('detail_email.php?jenis=INVALID&id_blast=<?=$row["ID_BLAST"];?>')">
			Invalid</a> : 
			<?=number_format($row["EMAIL_JML_INVALID"],2,",",".");?><br><br>
			
			<a href="#" onclick="popitup('detail_email.php?jenis=TERKIRIM&id_blast=<?=$row["ID_BLAST"];?>')">
			Terkirim</a> : 
			<?=number_format($row["JML_KIRIM_VALID_BERHASIL"],2,",",".");?><br><br>
			
			<a href="#" onclick="popitup('detail_email.php?jenis=BLM_TERKIRIM&id_blast=<?=$row["ID_BLAST"];?>')">
			Blm Terkirim</a> : 
			<?=number_format($row["JML_VALID_BLM_DIKIRIM"],2,",",".");?><br><br>			
			
			<a href="#" onclick="popitup('detail_email.php?jenis=GAGAL&id_blast=<?=$row["ID_BLAST"];?>')">
			Gagal Terkirim</a> : 
			<?=number_format($row["JML_VALID_GAGAL_DIKIRIM"],2,",",".");?>			
		</td>        		       
        <td>
			<a href="#" onclick="popitup('detail_sms.php?jenis=TOTAL&id_blast=<?=$row["ID_BLAST"];?>')">
			Total</a> : 
			<?=number_format($row["JML_SMS"],2,",",".");?><br><br>			
			<a href="#" onclick="popitup('detail_sms.php?jenis=TERKIRIM&id_blast=<?=$row["ID_BLAST"];?>')">
			Terkirim</a> : 
			<?=number_format($row["JML_DIKIRIM_SMS"],2,",",".");?><br><br>
			<a href="#" onclick="popitup('detail_sms.php?jenis=BLM_TERKIRIM&id_blast=<?=$row["ID_BLAST"];?>')">
			Belum Terkirim</a> : 
			<?=number_format($row["JML_BLM_DIKIRIM_SMS"],2,",",".");?>
		</td>        		       
        <td>			
			<a href="#" onclick="popitup('detail_sms.php?jenis=VALID&id_blast=<?=$row["ID_BLAST"];?>')">
			Valid</a> : 
			<?=number_format($row["JML_URL_VALID"],2,",",".");?><br><br>
			<a href="#" onclick="popitup('detail_sms.php?jenis=INVALID&id_blast=<?=$row["ID_BLAST"];?>')">
			Invalid</a> : 
			<?=number_format($row["JML_URL_INVALID"],2,",",".");?>			
		</td>
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>
<br />


</form>
<?
//}
?>
<script language="JavaScript" type="text/javascript">
	<!--
	function popitup(url) {
		newwindow=window.open(url,'name','height=850,width=1200, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,');
		if (window.focus) {newwindow.focus()}
		return false;
	}
</script>	

</body>
</html>
