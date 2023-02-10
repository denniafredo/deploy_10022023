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

<script language="JavaScript" type="text/javascript">
	
	function popitup(url) {
		newwindow=window.open(url,'name','height=850,width=1200, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,');
		if (window.focus) {newwindow.focus()}
		return false;
	}
</script>	

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
						  


if($wilayah=="ALL")
	$selectkantor="";
else
	$selectkantor=" AND KDRAYONPENAGIH IN ('$wilayah') ";	
$sql1="select decode(substr(kdrekeningpremi,1,1),'1',kdrekeningpremi,kdrekeninglawan)kdrekeningpremi,decode(substr(kdrekeninglawan,1,1),'3',kdrekeninglawan,kdrekeningpremi)kdrekeninglawan,sum(premitagihan) jmlpremi,sum(jmlnilairp)jmlpremirp from 
 $DBUser.tagihan_vs_pelunasan_capt where kdstatusfile='1' and TO_CHAR (TGLREKAM, 'MM/YYYY') = '".$tglcari."'  $selectkantor and tglseatled is null
                     and kdcarabayar not in ('X') and kdkuitansi<>'BP'
 group by kdrekeningpremi,kdrekeninglawan  order by kdrekeningpremi";
		//echo 'dsdsd';
			 //echo $sql1."<br/><br/>";
			 //die;
?>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->
<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
		<tr>
			<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(5,"Future");?>				
				<select name='wilayah'>
				<?php
				$sql="select kdkantor
	  from $DBUser.tabel_001_kantor
	  start with kdkantor = '$kantor'
	  connect by prior kdkantor = kdkantorINDUK ";
	  
	$DB->parse($sql);
    $DB->execute();
				while ($row=$DB->nextrow()) {				
				?>					
					<option><?=$row["KDKANTOR"];?></option>		        					
				<? 
				$i++;

				}
				?>					
				<option value="ALL">ALL</option>	</select>
				<input type="submit" name="submit" value="GO" class="but">
				<? //echo $sqa;?>
				</td>
		</tr>
	</table>
	</form>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center"><b>No</b></td>
		<td align="center"><b>KODE AKUN</b></td>		
		<td align="center"><b>PREMI TAGIHAN</b></td>
        <td align="center"><b>JMLNILAIRP</b></td>
    </tr>   
	<?
	
	$DB->parse($sql1);
    $DB->execute();
	$i=1;
	
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	?>			
    	<td align="center"><?=$i;?></td>
		<td align="center"><b><a href="#" onclick="popitup('daftar_saldo_tunggakan_premi_perakun.php?kdrekeninglawan=<?=$row["KDREKENINGPREMI"];?>&kd_wilayah=<?=$wilayah;?>&bln=<?=$tglcari;?>')"><?=$row["KDREKENINGPREMI"];?></a></b></td>		
		<td align="right"><?=number_format($row["JMLPREMI"],2,",",".");?></td>                
        <td align="right"><?=number_format($row["JMLPREMIRP"],2,",",".");?></td>      
    </tr>     			
       
	<? 
	$i++;
	$totalpremirp=$totalpremirp+$row["JMLPREMIRP"];
	$totalpremilunasrp=$totalpremilunasrp+$row["LUNAS"];
	
	}	
	?>
	<tr bgcolor="#b1c8ed">
    	<td colspan="3"><b>TOTAL PREMI (RP)</b></td>
		<td align="right"> <b><?=number_format($totalpremirp,2,",",".");?></b></td>
		
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