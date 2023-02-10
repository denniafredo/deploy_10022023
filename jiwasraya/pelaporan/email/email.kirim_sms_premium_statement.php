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
<!--h2>DETAIL EMAIL BLAST</h2-->



<!--form name="frm" action="<?=$PHP_SELF;?>" method="post"-->
<?php

if($_GET['action']=='kirim_sms'){
	kirim_sms($_GET['no_hp'],$_GET['url'],$_GET['nopolis']);
}

$sql="select a.*,to_char(TGLBOOKED,'YYYYMM') tglcari,to_char(TGLSEATLED,'YYYYMM') TGLSEATLED,
       (select to_char(tgl_event,'mm-yyyy') from EMAIL_BLAST_EVENT where id_blast = a.id_blast) tgl_event
	  FROM   $DBUser.penerima_email_tes a
      WHERE   id_blast = '".$_GET['idblast']."'
	  and TGL_KIRIM_SMS is null
	  and url <> 'invalid'
	  /*and nopertanggungan in ('002167460','00217017 6')*/";	  
	$DB->parse($sql);
    $DB->execute();
	//echo $sql;die;	
?>
	

<!--/form-->
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

	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {				
		$nohp = $row['NO_HP'];
		//$nohp = '085697716953';
		$kdkantor = $row['RAYONPENAGIHAN'];
		$url = $row['URL'];
		$tgl_event = $row['TGL_EVENT'];
		$nopolis = $row['PREFIXPERTANGGUNGAN'].$row['NOPERTANGGUNGAN'];
		//echo 'ini url '.$url;
		$status = kirim_sms($nohp,$url,$nopolis,$kdkantor,$tgl_event);
		//$i++;
		if ($status=='1'){
			//echo 'ini berhasil';
			$query = "update $DBUser.PENERIMA_EMAIL_TES set TGL_KIRIM_SMS = sysdate  WHERE   id_blast = '".$_GET['idblast']."' and ID_AUDIENCE = '".$row['ID_AUDIENCE']."' ";
			//$query = "update $DBUser.PENERIMA_EMAIL set status = '1',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' ";
			echo $query;
			//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
			$DB1->parse($query);
			$DB1->execute();
			$row1=$DB1->nextrow();
		}
	}
	header("Location: daftar_email.php");
?>

<br />


</form>
<?

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