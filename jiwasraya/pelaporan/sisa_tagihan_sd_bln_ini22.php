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

/*header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=autodebet.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
*/
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
$kantor = $_GET['kd_wilayah'];
$tglbooked = $_GET['bln'];
$tglbookedx = $_GET['blnx'];
$carabayar = $_GET['kd_carabayar'];
$pilih = $_GET['pilih'];

if ($batasbawah==''){	
	$batasbawah=1;
}

?>
</form>
<?
//if ($submit){
//$conn=ocilogon("JSADM","JSADMABC","GLABC"); 
//echo $day;
if($kantor=='KN'){
	$sqlk=" AND KDRAYONPENAGIH IN (select '$kantor' kdkantor
		  from dual) ";
}elseif($kantor=='KP'){
	$sqlkx =" AND KDRAYONPENAGIH IN (select kdkantor
		  from $DBUser.tabel_001_kantor
		  start with kdkantor = '$kantor'
		  connect by prior kdkantor = kdkantorINDUK
		  union all 
		  select 'KN' kdkantor
		  from dual) ";
}else{
	$sqlk=" AND KDRAYONPENAGIH IN (select kdkantor
		  from $DBUser.tabel_001_kantor
		  start with kdkantor = '$kantor'
		  connect by prior kdkantor = kdkantorINDUK) ";
} 


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
						  
$sql1="select *
		from 
		(SELECT rownum rn,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,
			(SELECT TO_CHAR(MULAS, 'DD/MM/YYYY') MULAS FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) MULAS,
			(SELECT TO_CHAR(EXPIRASI, 'DD/MM/YYYY') EXPIRASI FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) EXPIRASI,
			(SELECT y.NAMAMUTASI FROM $DBUser.TABEL_200_PERTANGGUNGAN x, $DBUser.TABEL_601_KODE_MUTASI y WHERE x.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND x.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN AND x.LOCKMUTASI = y.KDMUTASI) LOCKMUTASI,
				(select NAMAVALUTA from $DBUser.tabel_304_valuta where kdvaluta = a.kdvaluta)NAMAVALUTA,PREMITAGIHAN,KDKUITANSI,
				JMLKWT,JMLNILAIRP,KWT,LUNAS,(select NAMACARABAYAR from $DBUser.TABEL_305_CARA_BAYAR where KDCARABAYAR = a.KDCARABAYAR) NAMACARABAYAR,
				PENAGIH,KDSTATUSFILE,JMLNILAIRP-LUNAS tunggakan,kdrekeningpremi,kdrekeninglawan,KDPRODUK,NAMAPRODUK
			  FROM $DBUser.tag_vs_pel_new_$tglcarix a
			  WHERE TGLBOOKED <= LAST_DAY (TO_DATE ('$tglbookedx', 'MM/YYYY'))
			   ".$sqlk." 
			  AND trunc(TGLGENERATE) = (TO_DATE ('$tglbooked', 'DD/MM/YYYY'))
			  and kdstatusfile = '1'			  
			  AND TGLSEATLED is null
			  and KDCARABAYAR IN (SELECT KDCARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE NAMACARABAYAR = '$carabayar')
			  and KDKUITANSI = '$kdkuitansi'
			  order by kdrayonpenagih,tglbooked,noagen,kdvaluta,penagih)";			  
			  
$sql2="select *
		from 
		(SELECT rownum rn,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,
			(SELECT TO_CHAR(MULAS, 'DD/MM/YYYY') MULAS FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) MULAS,
			(SELECT TO_CHAR(EXPIRASI, 'DD/MM/YYYY') EXPIRASI FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) EXPIRASI,
			(SELECT y.NAMAMUTASI FROM $DBUser.TABEL_200_PERTANGGUNGAN x, $DBUser.TABEL_601_KODE_MUTASI y WHERE x.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND x.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN AND x.LOCKMUTASI = y.KDMUTASI) LOCKMUTASI,
				(select NAMAVALUTA from $DBUser.tabel_304_valuta where kdvaluta = a.kdvaluta)NAMAVALUTA,PREMITAGIHAN,KDKUITANSI,
				JMLKWT,JMLNILAIRP,KWT,LUNAS,(select NAMACARABAYAR from $DBUser.TABEL_305_CARA_BAYAR where KDCARABAYAR = a.KDCARABAYAR) NAMACARABAYAR,
				PENAGIH,KDSTATUSFILE,JMLNILAIRP-LUNAS tunggakan,kdrekeningpremi,kdrekeninglawan,KDPRODUK,NAMAPRODUK
			  FROM $DBUser.tagihan_vs_pelunasan a
			  WHERE TGLBOOKED <= LAST_DAY (TO_DATE ('$tglbookedx', 'MM/YYYY'))
			    ".$sqlk." 
			  and kdstatusfile = '1'			  
			  AND TGLSEATLED is null
			  and KDCARABAYAR IN (SELECT KDCARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE NAMACARABAYAR = '$carabayar')
			  and KDKUITANSI = '$kdkuitansi'
			  order by kdrayonpenagih,tglbooked,noagen,kdvaluta,penagih)";			
			 //echo $sql."<br/><br/>";
			 //die;
$sql3="select *
		from 
		(SELECT rownum rn,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,
			(SELECT TO_CHAR(MULAS, 'DD/MM/YYYY') MULAS FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) MULAS,
			(SELECT TO_CHAR(EXPIRASI, 'DD/MM/YYYY') EXPIRASI FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) EXPIRASI,
			(SELECT y.NAMAMUTASI FROM $DBUser.TABEL_200_PERTANGGUNGAN x, $DBUser.TABEL_601_KODE_MUTASI y WHERE x.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND x.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN AND x.LOCKMUTASI = y.KDMUTASI) LOCKMUTASI,
				(select NAMAVALUTA from $DBUser.tabel_304_valuta where kdvaluta = a.kdvaluta)NAMAVALUTA,PREMITAGIHAN,KDKUITANSI,
				JMLKWT,JMLNILAIRP,KWT,LUNAS,(select NAMACARABAYAR from $DBUser.TABEL_305_CARA_BAYAR where KDCARABAYAR = a.KDCARABAYAR) NAMACARABAYAR,
				PENAGIH,KDSTATUSFILE,JMLNILAIRP-LUNAS tunggakan,kdrekeningpremi,kdrekeninglawan,KDPRODUK,NAMAPRODUK
			  FROM $DBUser.tagihan_vs_pelunasan a
			  WHERE TGLBOOKED <= LAST_DAY (TO_DATE ('$tglbookedx', 'MM/YYYY'))
			    ".$sqlk." 
			  and kdstatusfile = '1'			  
			  AND TGLSEATLED is null			  
			  and KDKUITANSI = '$kdkuitansi'
			  order by kdrayonpenagih,tglbooked,noagen,kdvaluta,penagih)";	

$sql4="select *
		from 
		(SELECT rownum rn,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,
			(SELECT TO_CHAR(MULAS, 'DD/MM/YYYY') MULAS FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) MULAS,
			(SELECT TO_CHAR(EXPIRASI, 'DD/MM/YYYY') EXPIRASI FROM $DBUser.TABEL_200_PERTANGGUNGAN WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) EXPIRASI,
			(SELECT y.NAMAMUTASI FROM $DBUser.TABEL_200_PERTANGGUNGAN x, $DBUser.TABEL_601_KODE_MUTASI y WHERE x.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND x.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN AND x.LOCKMUTASI = y.KDMUTASI) LOCKMUTASI,
				(select NAMAVALUTA from $DBUser.tabel_304_valuta where kdvaluta = a.kdvaluta)NAMAVALUTA,PREMITAGIHAN,KDKUITANSI,
				JMLKWT,JMLNILAIRP,KWT,LUNAS,(select NAMACARABAYAR from $DBUser.TABEL_305_CARA_BAYAR where KDCARABAYAR = a.KDCARABAYAR) NAMACARABAYAR,
				PENAGIH,KDSTATUSFILE,JMLNILAIRP-LUNAS tunggakan,kdrekeningpremi,kdrekeninglawan,KDPRODUK,NAMAPRODUK
			  FROM $DBUser.tag_vs_pel_new_$tglcarix a
			  WHERE TGLBOOKED <= LAST_DAY (TO_DATE ('$tglbookedx', 'MM/YYYY'))
			   ".$sqlk." 
			  AND trunc(TGLGENERATE) = (TO_DATE ('$tglbooked', 'DD/MM/YYYY'))
			  and kdstatusfile = '1'			  
			  AND TGLSEATLED is null			  
			  and KDKUITANSI = '$kdkuitansi'
			  order by kdrayonpenagih,tglbooked,noagen,kdvaluta,penagih)";					  
			 
if ($pilih=='NOW'){
	$sql = $sql2;
}elseif ($pilih=='ALL'){
	$sql = $sql3;

}elseif ($pilih=='BEFALL'){
	$sql = $sql4;
}else{
	$sql = $sql1;
}	

//echo $sql ;	die;	 
?>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>No</b></td>
		<td align="center"><b>PREFIXPERTANGGUNGAN</b></td>		
        <td align="center"><b>NOPERTANGGUNGAN</b></td>        
        <td align="center"><b>NAMA</b></td>
        <td align="center"><b>MULAS</b></td>
        <td align="center"><b>EXPIRASI</b></td>
        <td align="center"><b>LOCK MUTASI</b></td>
        <td align="center"><b>NOAGEN</b></td>
        <td align="center"><b>NAMA AGEN</b></td>
        <td align="center"><b>KDRAYONPENAGIH</b></td>
        <td align="center"><b>TGLBOOKED</b></td>
        <td align="center"><b>NAMA VALUTA</b></td>        
        <td align="center"><b>KODE KUITANSI</b></td>
		<td align="center"><b>CARA BAYAR</b></td>
        <td align="center"><b>PENAGIH</b></td>		
		<td align="center"><b>PREMI TAGIHAN</b></td>
        <td align="center"><b>JMLNILAIRP</b></td>
        <td align="center"><b>LUNAS</b></td>
        <td align="center"><b>TUNGGAKAN</b></td>        
        <td align="center"><b>KDREKENINGPREMI</b></td>
        <td align="center"><b>KDREKENINGLAWAN</b></td>
		<td align="center"><b>KDPRODUK</b></td>
        <td align="center"><b>NAMAPRODUK</b></td>
    </tr>   
	<?
	//echo $sql;
	$DB->parse($sql);
    $DB->execute();
	$i=$batasbawah;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?></td>		        
        <td align="center"><?=$row["NOPERTANGGUNGAN"];?></td>        	
        <td><?=$row["NAMA"];?></td>
        <td align="center"><?=$row["MULAS"];?></td>
		<td align="center"><?=$row["EXPIRASI"];?></td>
		<td align="center"><?=$row["LOCKMUTASI"];?></td>
        <td><?=$row["NOAGEN"];?></td>
        <td><?=$row["NAMA_AGEN"];?></td>         	
        <td><?=$row["KDRAYONPENAGIH"];?></td>        	
        <td align="center"><?=$row["TGLBOOKED"];?></td>
		<td><?=$row["NAMAVALUTA"];?></td>        			
		<td><?=$row["KDKUITANSI"];?></td>        			
		<td><?=$row["NAMACARABAYAR"];?></td>        			
		<td><?=$row["PENAGIH"];?></td>        			
        <td align="right"><?=number_format($row["PREMITAGIHAN"],2,",",".");?></td>                
        <td align="right"><?=number_format($row["JMLNILAIRP"],2,",",".");?></td>        
		<td align="right"><?=number_format($row["LUNAS"],2,",",".");?></td>                
		<td align="right"><?=number_format($row["TUNGGAKAN"],2,",",".");?></td>         
		<td><?=$row["KDREKENINGPREMI"];?></td>        			
		<td><?=$row["KDREKENINGLAWAN"];?></td>
		<td><?=$row["KDPRODUK"];?></td> 
		<td><?=$row["NAMAPRODUK"];?></td>
	</tr>
	<? 
	$i++;
	}
echo "</table><table>";		
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