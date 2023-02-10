<? 
	include 'koneksi_mysql_sms.php';
	include 'kirim_sms.php';
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
<title>DETAIL EMAIL BLAST</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">

<script language="javascript" type="text/javascript">
	<!--
	function popitup(url) {
		newwindow=window.open(url,'name','height=850,width=1200, menubar=no, scrollbars=no, resizable=yes, copyhistory=no,');
		if (window.focus) {newwindow.focus()}
		return false;
	}
</script>	
</head>

<body topmargin="20">
<!--b><font size="3">TAGIHAN VS PELUNASAN</font></b-->
<h2>DETAIL EMAIL BLAST</h2>



<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?php

if($_GET['action']=='kirim_sms'){
	$status = kirim_sms($_GET['no_hp'],$_GET['url'],$_GET['nopolis'],$_GET['kdkantor'],$_GET['bulan']);	
	
	if ($status=='1'){
		//echo 'ini berhasil';
		$query = "update $DBUser.PENERIMA_EMAIL_TES set TGL_KIRIM_SMS = sysdate  WHERE   id_blast = '".$_GET['idblast']."' and ID_AUDIENCE = '".$_GET['idaudience']."' ";
		//$query = "update $DBUser.PENERIMA_EMAIL set status = '1',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' ";
		echo $query;
		//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
		$DB1->parse($query);
		$DB1->execute();
		$row1=$DB1->nextrow();
	}
}

if($_GET['gruping']=='INDIVIDU'){
	$jenisblast = $_GET['jenis_blast'];
	$idblast = $_GET['idblast'];
	$sql="select a.*,to_char(TGLBOOKED,'YYYYMM') tglcari,to_char(TGLSEATLED,'YYYYMM') TGLSEATLED,				 
				(select to_char(tgl_event,'mm-yyyy') from EMAIL_BLAST_EVENT where id_blast = a.id_blast) tgl_event
		  FROM   $DBUser.penerima_email_tes a
		  WHERE   id_blast = '".$idblast."'";
}
else if($_GET['jenis_blast']){
	$jenisblast = $_POST['jenis_blast'];
	$idblast = $_POST['idblast'];	
	
	if($idblast == ''){
		$jenisblast = $_GET['jenis_blast'];
		$idblast = $_GET['idblast'];
	}
}else{
	$jenisblast = $_POST['jenis_blast'];
	$idblast = $_POST['idblast'];
	
	if($idblast == ''){
		$jenisblast = $_GET['jenis_blast'];
		$idblast = $_GET['idblast'];
	}
	$sql="select a.*,to_char(TGLBOOKED,'YYYYMM') tglcari,to_char(TGLSEATLED,'YYYYMM') TGLSEATLED,				 
				(select to_char(tgl_event,'mm-yyyy') from EMAIL_BLAST_EVENT where id_blast = a.id_blast) tgl_event
		  FROM   $DBUser.penerima_email_tes a
		  WHERE   id_blast = '".$idblast."'
		  AND PREFIXPERTANGGUNGAN = '".$_POST['prefix']."'
		  AND NOPERTANGGUNGAN = '".$_POST['noper']."'";
}
	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;	
?>
	<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">		
		<tr>
			<td bgcolor="#CEE7FF">
				<a href="daftar_email_sekper.php" class="verdana8blu">Kembali Daftar Email</a>
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

<form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>">
<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
  <tr>
	<td>No Polis</td>
	<td>: 
		<input type="text" value="<?=$_POST['prefix'];?>" name="prefix" size="2">&nbsp;&nbsp;
		<input type="text" value="<?=$_POST['noper'];?>" name="noper" size="9">&nbsp;&nbsp;
		<input type="submit" value="cari" size="9">&nbsp;&nbsp;
		<input type="hidden" value="<?=$idblast;?>" name="idblast" size="9">
		<input type="hidden" value="<?=$jenisblast;?>" name="jenis_blast" size="9">
	</td>
  </tr>		
</table>
</form>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>NO</b></td>		
    	<td align="center"><b>ID</b></td>		
    	<td align="center"><b>EMAIL</b></td>		
    	<td align="center"><b>STATUS</b></td>		
    	<td align="center"><b>TGL_KIRIM</b></td>		
    	<td align="center"><b>PREFIXPERTANGGUNGAN</b></td>		
    	<td align="center"><b>NOPERTANGGUNGAN</b></td>		
    	<td align="center"><b>RAYONPENAGIHAN</b></td>		
    	<td align="center"><b>TGLBOOKED</b></td>		    	
    	<td align="center"><b>TGLEXPIRASI</b></td>		
    	<td align="center"><b>NO HP</b></td>		
    	<td align="center"><b>URL</b></td>		
    	<td align="center"><b>JENIS</b></td>		    	
    	<td align="center"><b>ACTION</b></td>		    	
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
		<td align="center"><?=$row["ID_AUDIENCE"];?></td>		        
        <td><?=$row["EMAIL"];?></td>        	
        <td align="center"><?=$row["STATUS"];?></td>        	                
        <td align="center"><?=$row["TGL_KIRIM"];?></td>        	
        <td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?></td>        	
        <td align="center"><?=$row["NOPERTANGGUNGAN"];?></td>        	
        <td align="center"><?=$row["RAYONPENAGIHAN"];?></td>        	
        <td align="center"><?=$row["TGLBOOKED"];?></td>        	
        <td align="center"><?=$row["TGLEXPIRASI"];?></td>        	
        <td align="center"><?=$row["NO_HP"];?></td>        	
        <td align="center"><a href="https://<?=$row["URL"];?>"><?=$row["URL"];?></a></td>        	
        <td align="center"><?=$row["JENIS"];?></td>        	
		<td align="center">
		<?php
		if($jenisblast=='EMAIL_PREMIUM_STATEMENT'){
			if($row["STATUS"]=='1'){?>			
				<a href="email.kirim_pdf_premium_statement_detail.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>">Kirim Email Ulang<br><br></a>
			<?php } else { ?>	
				<a href="email.kirim_pdf_premium_statement_detail.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>">Kirim Email<br><br></a>				
			<?php } 
		}elseif($jenisblast=='EMAIL_HISTORIS_JL4'){
			if($row["STATUS"]=='1'){?>			
				<a href="email.kirim_pdf_historis_transaksi_detail.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>">Kirim Email Ulang<br><br></a>
			<?php } else { ?>	
				<a href="email.kirim_pdf_historis_transaksi_detail.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>">Kirim Email<br><br></a>				
			<?php } 
		}else{
			if($row["STATUS"]=='1'){?>			
				<a href="email.gen_kirim_cetak_pdf_jatuh_tempo_premi_detail.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>">Kirim Email Ulang<br><br></a>
			<?php } else { ?>	
				<a href="email.gen_kirim_cetak_pdf_jatuh_tempo_premi_detail.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>">Kirim Email<br><br></a>				
			<?php } 		
		}
		
		if($jenisblast=='EMAIL_PREMIUM_STATEMENT'){
			if($row["STATUS"]=='1'){?>			
				<a href="detail_daftar_email.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>&action=kirim_sms&no_hp=<?=$row["NO_HP"];?>&bulan=<?=$row["TGL_EVENT"];?>&url=<?=$row["URL"];?>&kdkantor=<?=$row["RAYONPENAGIHAN"];?>&nopolis=<?=$row["PREFIXPERTANGGUNGAN"].$row["NOPERTANGGUNGAN"];?>">Kirim Sms Ulang<br><br></a>
			<?php } else { ?>	
				<a href="detail_daftar_email.php?idblast=<?=$row["ID_BLAST"];?>&idaudience=<?=$row["ID_AUDIENCE"];?>&jenis_blast=<?=$jenisblast;?>&action=kirim_sms&no_hp=<?=$row["NO_HP"];?>&bulan=<?=$row["TGL_EVENT"];?>&url=<?=$row["URL"];?>&kdkantor=<?=$row["RAYONPENAGIHAN"];?>&nopolis=<?=$row["PREFIXPERTANGGUNGAN"].$row["NOPERTANGGUNGAN"];?>">Kirim Sms<br><br></a>
			<?php } 
		}
		if($jenisblast=='EMAIL_PREMIUM_STATEMENT'){
		?>			
			<a href='#' onClick="popitup('<?='pdf/'.$row["TGLSEATLED"].'_PST_'.$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].'.pdf'; ?>')">View File</>
		<?php				
		}elseif($jenisblast=='EMAIL_HISTORIS_JL4'){
		?>			
			<a href='#' onClick="popitup('<?='pdf/'.$row["TGLCARI"].'_HISTORIS_TRANSAKSI_'.$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].'.pdf'; ?>')">View File</>
		<?php				
		}else{
		?>			
			<a href='#' onClick="popitup('<?='pdf/'.$row["TGLCARI"].'_JATUH_TEMPO_PREMI_'.$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].'.pdf'; ?>')">View File</>			
		<?php 
		}	
		?>
			
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