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
<title>Tagihan Pelunasan</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<b><font size="3">TAGIHAN VS PELUNASAN</font></b>
<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?
$jenis = $_GET['jenis'];
$batasbawah = $_GET['batasbawah'];
$batasatas = $_GET['batasatas'];
$kdkuitansi = $_GET['kd_kuitansi'];
$kdwilayah = $_GET['kd_wilayah'];
$tglbooked = $_GET['bln'];
$carabayar = $_GET['kd_carabayar'];
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
}
else
{
//  $tglcari = $year.$month;
  $tglcari = $month.'/'.$year;
}
						  
$sql="select *
		from 
		(SELECT rownum rn,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,
				(select NAMAVALUTA from $DBUser.tabel_304_valuta where kdvaluta = a.kdvaluta)NAMAVALUTA,PREMITAGIHAN,KDKUITANSI,
				JMLKWT,JMLNILAIRP,KWT,LUNAS,(select NAMACARABAYAR from $DBUser.TABEL_305_CARA_BAYAR where KDCARABAYAR = a.KDCARABAYAR) NAMACARABAYAR,
				PENAGIH,KDSTATUSFILE
			  FROM $DBUser.tagihan_vs_pelunasan a
			  WHERE KDRAYONPENAGIH IN (
			  SELECT KDKANTOR
			  FROM $DBUser.TABEL_001_KANTOR
			  WHERE KDKANTORINDUK = '$kdwilayah')
			  AND TO_CHAR (TGLBOOKED, 'MM/YYYY') = '$tglbooked'
			  and KDCARABAYAR IN (SELECT KDCARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE NAMACARABAYAR = '$carabayar')
			  and KDKUITANSI = '$kdkuitansi'
			  order by kdrayonpenagih,tglbooked,noagen,kdvaluta,penagih)
		where rn between nvl('$batasbawah','1') and nvl('$batasatas','50')     
		order by rn";
		//echo 'dsdsd';
			 echo $sql."<br/><br/>";
			 //die;
?>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>No</b></td>
		<td align="center"><b>PREFIXPERTANGGUNGAN</b></td>		
        <td align="center"><b>NOPERTANGGUNGAN</b></td>        
        <td align="center"><b>NAMA</b></td>
        <td align="center"><b>NOAGEN</b></td>
        <td align="center"><b>KDRAYONPENAGIH</b></td>
        <td align="center"><b>TGLBOOKED</b></td>
        <td align="center"><b>NAMA VALUTA</b></td>        
        <td align="center"><b>KODE KUITANSI</b></td>
		<td align="center"><b>CARA BAYAR</b></td>
        <td align="center"><b>PENAGIH</b></td>		
		<td align="center"><b>PREMI TAGIHAN</b></td>
        <td align="center"><b>JMLNILAIRP</b></td>
        <td align="center"><b>LUNAS</b></td>
        
    </tr>   
	<?
	
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?></td>		        
        <td align="center"><?=$row["NOPERTANGGUNGAN"];?></td>        	
        <td><?=$row["NAMA"];?></td>        	
        <td><?=$row["NOAGEN"];?></td>        	
        <td><?=$row["KDRAYONPENAGIH"];?></td>        	
        <td align="center"><?=$row["TGLBOOKED"];?></td>
		<td><?=$row["NAMAVALUTA"];?></td>        			
		<td><?=$row["KDKUITANSI"];?></td>        			
		<td><?=$row["NAMACARABAYAR"];?></td>        			
		<td><?=$row["PENAGIH"];?></td>        			
        <td align="right"><?=number_format($row["PREMITAGIHAN"],2,",",".");?>                
        <td align="right"><?=number_format($row["JMLNILAIRP"],2,",",".");?>        
		<td align="right"><?=number_format($row["LUNAS"],2,",",".");?>                
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
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>