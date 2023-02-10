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
	$DB2=new database($userid, $passwd, $DBName);

?>
<html>

<head>
<title>Tagihan Pelunasan</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<b><font size="3">DAFTAR SALDO TUNGGAKAN PREMI</font></b>
<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<?
$jenis = $_GET['jenis'];
$batasbawah = $_GET['batasbawah'];
$batasatas = $_GET['batasatas'];
$kdkuitansi = $_GET['kd_kuitansi'];
$kdwilayah = $_GET['kd_wilayah'];
$tglbooked = $_GET['bln'];
$carabayar = $_GET['kd_carabayar'];
if(isset($_POST["tambah"])){
	$sqladd="insert into $DBUser.tagihan_vs_pelunasan_capt (PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,KDVALUTA,PREMITAGIHAN,
	KDKUITANSI,JMLKWT,JMLNILAIRP,KWT,KDCARABAYAR,PENAGIH,KDSTATUSFILE,KDREKENINGPREMI,KDREKENINGLAWAN,TGLREKAM)
	 (select PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,TGLBOOKED,KDVALUTA,PREMITAGIHAN,KDKUITANSI,JMLKWT,JMLNILAIRP,KWT,
	KDCARABAYAR,PENAGIH,KDSTATUSFILE,KDREKENINGPREMI,KDREKENINGLAWAN,last_day(to_date('".$_POST["bln"]."','mm/yyyy'))
	from $DBUser.tagihan_vs_pelunasan where prefixpertanggungan='".$_POST["prefixpert"]."' and nopertanggungan='".$_POST["noperta"]."' and to_char(tglbooked,'dd/mm/yyyy') ='".$_POST["tglbookd"]."')";
	//echo $sqladd;
	$DB->parse($sqladd);
	$DB->execute();
	$kdrekeninglawan=$_POST["kdrekeninglawan"];
	$kd_wilayah=$_POST["kd_wilayah"];
	$bln=$_POST["bln"];
	
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
}
else
{
//  $tglcari = $year.$month;
  $tglcari = $month.'/'.$year;
}
						  

if(isset($_POST["update"])){
$sqlupdate="update $DBUser.tagihan_vs_pelunasan_capt set premitagihan='".$_POST["premitag"]."',jmlnilairp='".$_POST["premitagrp"]."' where prefixpertanggungan='".$_POST["prefix"]."' and nopertanggungan='".$_POST["noper"]."' and 
			to_char(tglbooked,'dd/mm/yyyy')='".$_POST["tglbkd"]."' and to_char(tglrekam,'mm/yyyy')='".$_POST["bln"]."'";
//echo $sqlupdate;
			$DB->parse($sqlupdate);
$DB->execute();
$kdrekeninglawan=$_POST["kdrekeninglawan"];
$kd_wilayah=$_POST["kd_wilayah"];
$bln=$_POST["bln"];
}

if($kdrekeninglawan=="")						  
	$rekening="";
else
	$rekening=" AND kdrekeninglawan='$kdrekeninglawan' ";

if($kantor=="KP" && $action=="delete"){
			$sqldel= "delete $DBUser.tagihan_vs_pelunasan_capt where prefixpertanggungan='".$_GET["pref"]."' and nopertanggungan='".$_GET["nopert"]."' and to_char(tglbooked,'dd/mm/yyyy')='".$_GET["tglboked"]."' and to_char(tglrekam,'mm/yyyy')='".$_GET["bln"]."'";  
		//echo $sqldel;
		$DB->parse($sqldel);
		$DB->execute();
		}		


		
if($kd_wilayah=="ALL")
	$selectkantor="";
//elseif($kdkantor=="KP")
	//$selectkantor=" KDRAYONPENAGIH IN ('$kdkantor') AND ";	
else
	$selectkantor=" KDRAYONPENAGIH IN ('$kd_wilayah') AND ";	
$sql="select *
		from 
		(SELECT rownum rn,PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,NAMA,NOAGEN,NAMA_AGEN,KDRAYONPENAGIH,to_char(TGLBOOKED,'dd/mm/yyyy') tglbooked,
				(select NAMAVALUTA from $DBUser.tabel_304_valuta where kdvaluta = a.kdvaluta)NAMAVALUTA,PREMITAGIHAN,KDKUITANSI,
				JMLKWT,JMLNILAIRP,KWT,LUNAS,(select NAMACARABAYAR from $DBUser.TABEL_305_CARA_BAYAR where KDCARABAYAR = a.KDCARABAYAR) NAMACARABAYAR,
				PENAGIH,KDSTATUSFILE,kdrekeninglawan,to_char(TGLREKAM,'mm/yyyy') tglREKAM
			  FROM $DBUser.tagihan_vs_pelunasan_capt a
			  WHERE  kdstatusfile='1' and ".$selectkantor." 
			  TO_CHAR (tglrekam, 'MM/YYYY') = '$bln'
			  ".$rekening."	 and tglseatled is null
                     and kdcarabayar not in ('X')
			  order by kdrayonpenagih,tglbooked,noagen,kdvaluta,penagih)";
		//echo 'dsdsd';
			 //echo $sql."<br/><br/>";
			 //die;
?>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>No</b></td>
		<td align="center"><b>NOMOR POLIS</b></td>		               
        <td align="center"><b>NAMA</b></td>
        <!--td align="center"><b>NOAGEN</b></td>
        <td align="center"><b>KDRAYONPENAGIH</b></td-->
        <td align="center"><b>TGLBOOKED</b></td>
		<td align="center"><b>AKUN</b></td>
        <td align="center"><b>NAMA VALUTA</b></td>        
        <!--td align="center"><b>KODE KUITANSI</b></td>
		<td align="center"><b>CARA BAYAR</b></td>
        <td align="center"><b>PENAGIH</b></td-->		
		<td align="center"><b>PREMI TAGIHAN</b></td>
        <td align="center"><b>JMLNILAIRP</b></td>
        <td align="center"><b>LUNAS</b></td>
		<?php
		// Untuk sementara dinonaktifkan karena ada audit PWC 
		/*if($kantor=="KP"){
			echo "<td align=center><b>ACTION</b></td>";
		}*/
		?>
        
    </tr>   
	<?
	
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	
		if($kantor=="KP" && $action=="update" && $pref==$row["PREFIXPERTANGGUNGAN"] && $nopert==$row["NOPERTANGGUNGAN"] && $tglboked==$row["TGLBOOKED"] && $bln=$row["TGLREKAM"]){
			?>
			<form action="daftar_saldo_tunggakan_premi_perakun.php" method="post">
			<td><?=$i;?></td>
		<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?></td>		                
        <td><?=$row["NAMA"];?></td>        	        
        <td align="center"><?=$row["TGLBOOKED"];?></td>
		<td><?=$row["KDREKENINGLAWAN"];?></td>
		<td><?=$row["NAMAVALUTA"];?></td>        					     			
        <td align="right"><input type="text" name="premitag" value="<?=$row["PREMITAGIHAN"];?>" /></td>                
        <td align="right"><input type="text" name="premitagrp" value="<?=$row["JMLNILAIRP"];?>" /></td>      
		<td align="right"><?=number_format($row["LUNAS"],2,",",".");?></td>  
			<?php
			echo "<td align=center><input type=hidden name=tglbkd value=".$row["TGLBOOKED"]."><input type=hidden name=prefix value=".$row["PREFIXPERTANGGUNGAN"]."><input type=hidden name=noper value=".$row["NOPERTANGGUNGAN"]."><input type=hidden name=kdrekeninglawan value=$kdrekeninglawan><input type=hidden name=kd_wilayah value=$kd_wilayah><input type=hidden name=bln value=$bln><input type=submit name=update value=Update></form>";
		}elseif($kantor=="KP"){			
			?>		
		<td><?=$i;?></td>
		<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?></td>		                
        <td><?=$row["NAMA"];?></td>        	        
        <td align="center"><?=$row["TGLBOOKED"];?></td>
		<td><?=$row["KDREKENINGLAWAN"];?></td>
		<td><?=$row["NAMAVALUTA"];?></td>        					     			
        <td align="right"><?=number_format($row["PREMITAGIHAN"],2,",",".");?></td>                
        <td align="right"><?=number_format($row["JMLNILAIRP"],2,",",".");?></td>      
		<td align="right"><?=number_format($row["LUNAS"],2,",",".");?></td>  		
			<?php
			//Untuk sementara dinonaktifkan karena ada audit PWC 
			//echo "<td align=center><a href=daftar_saldo_tunggakan_premi_perakun.php?pref=".$row["PREFIXPERTANGGUNGAN"]."&nopert=".$row["NOPERTANGGUNGAN"]."&tglboked=".$row["TGLBOOKED"]."&kdrekeninglawan=$kdrekeninglawan&kd_wilayah=$kd_wilayah&bln=$bln&action=update> Update </a>| <a href=daftar_saldo_tunggakan_premi_perakun.php?pref=".$row["PREFIXPERTANGGUNGAN"]."&nopert=".$row["NOPERTANGGUNGAN"]."&tglboked=".$row["TGLBOOKED"]."&kdrekeninglawan=$kdrekeninglawan&kd_wilayah=$kd_wilayah&bln=$bln&action=delete> Delete </a></td>";
		}else{
			?>
		<td><?=$i;?></td>
		<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?></td>		                
        <td><?=$row["NAMA"];?></td>        	        
        <td align="center"><?=$row["TGLBOOKED"];?></td>
		<td><?=$row["KDREKENINGLAWAN"];?></td>
		<td><?=$row["NAMAVALUTA"];?></td>        					     			
        <td align="right"><?=number_format($row["PREMITAGIHAN"],2,",",".");?></td>                
        <td align="right"><?=number_format($row["JMLNILAIRP"],2,",",".");?></td>      
		<td align="right"><?=number_format($row["LUNAS"],2,",",".");?></td>  
		<?php
		}
		?>		
	</tr>
	<? 
	$i++;
	$totalpremirp=$totalpremirp+$row["JMLNILAIRP"];
	$totalpremilunasrp=$totalpremilunasrp+$row["LUNAS"];
	
	}	
	?>
	<tr>
	    	<form action="" method="post">
			<td>&nbsp;</td>
			<td colspan="2"><input type="text" name="prefixpert" size="2" maxlength="2" />-<input type="text" name="noperta" size="9" maxlength="9" /></td>
			<td align="center"><input type="text" size="10" name="tglbookd" maxlength="10" value="dd/mm/yyyy" /></td>
			<td colspan="5" align="center">&nbsp;</td>
			<td><input type="submit" name="tambah" value="Add" />
			<input type="hidden" name="kdrekeninglawan" value=<?=$kdrekeninglawan;?>><input type="hidden" name="kd_wilayah" value=<?=$kd_wilayah;?>><input type="hidden" name="bln" value=<?=$bln;?>></form></td>
	</tr>
	<tr bgcolor="#b1c8ed">
    	<td colspan="7"><b>TOTAL</b></td>
		<td align="right"><b><?=number_format($totalpremirp,2,",",".");?></td> </b></td>		               
        <td align="right"><b><?=number_format($totalpremilunasrp,2,",",".");?></td> </b></td>
    </tr> 
	<tr bgcolor="#b1c8ed">
    	<td colspan="8"><b>SISA TAGIHAN</b></td>
		<td align="right"><b><?=number_format($totalpremirp-$totalpremilunasrp,2,",",".");?></td> </b></td>		               
        
    </tr>
</table>
<br />


</form>
<?
//}
?>
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>