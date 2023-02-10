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

	header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=email_sms.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
?>
<html>

<head>
<title>Tagihan Pelunasan</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<b><font size="3">TAGIHAN VS PELUNASAN</font></b>
<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?
$jenis = $_GET['jenis'];
$id_blast = $_GET['id_blast'];

$sql1 = '';
if($jenis=='VALID'){
	$sql1=" and email is not null and upper(email) not in (select upper(karakter) from $DBUser.exception_sendemail)  ";
}elseif($jenis=='INVALID'){
	$sql1 =" and email is not null and upper(email) in (select upper(karakter) from $DBUser.exception_sendemail)  ";
}elseif($jenis=='TERKIRIM'){
	$sql1 =" and email is not null and status = '1' ";
}elseif($jenis=='BLM_TERKIRIM'){
	$sql1 =" and email is not null and status is null   ";
}elseif($jenis=='GAGAL'){
	$sql1 =" and email is not null and status = 'X' ";
}elseif($jenis=='GENERATED'){
	$sql1 =" AND file_pdf IS NOT NULL ";
}elseif($jenis=='TOTAL'){
	$sql1=" and email is not null ";
}


?>
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
  $tglcarix = date('mY');
}
else
{
//  $tglcari = $year.$month;
  $tglcari = $month.'/'.$year;
  $tglcarix = $month.$year;
}
	
						  
$sql=" select PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN,TGLBOOKED,TGLSEATLED,EMAIL,STATUS,TGL_KIRIM       
from $DBUser.penerima_email_tes 
where id_blast = '$id_blast' 
 ".$sql1;
		//echo 'dsdsd';
			 //echo $sql."<br/><br/>";
			 //die;

			 
?>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>No</b></td>
		<td align="center"><b>PREFIXPERTANGGUNGAN</b></td>		
        <td align="center"><b>NOPERTANGGUNGAN</b></td>                
        <td align="center"><b>KDRAYONPENAGIH</b></td>
        <td align="center"><b>TGLBOOKED</b></td>
        <td align="center"><b>TGLSEATLED</b></td>
        <td align="center"><b>EMAIL</b></td>        
        <td align="center"><b>STATUS</b></td>
		<td align="center"><b>TGLKIRIM</b></td>        
    </tr>   
	<?
	
	$DB->parse($sql);
    $DB->execute();
	$i=$batasbawah;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?></td>		        
        <td align="center"><?=$row["NOPERTANGGUNGAN"];?></td>        	             
        <td align="center"><?=$row["RAYONPENAGIHAN"];?></td>        	
        <td align="center"><?=$row["TGLBOOKED"];?></td>
        <td align="center"><?=$row["TGLSEATLED"];?></td>
		<td><?=$row["EMAIL"];?></td>        			
		<td align="center"><?=$row["STATUS"];?></td>
		<td><?=$row["TGL_KIRIM"];?></td>        					
	</tr>
	<? 
	$i++;
	}
echo "</table>";	
		
	?>

</form>
<?
//}
?>
<a href="../../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>