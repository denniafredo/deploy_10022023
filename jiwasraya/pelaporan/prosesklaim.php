<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
	$bln = (!$bl) ? $bln : '';
$DB = new Database($userid, $passwd, $DBName);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Informasi Pengajuan Klaim</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table width="1000">
  <tr>
    <td align="center" class="arial10blk"><b>PENGECEKAN STATUS PENGAJUAN KLAIM</td>
	</tr>
  </table>
<table width="50%" cellpadding="0" cellspacing="0">
 <!-- <tr>
    <td align="left" class="arial10" width="45%">Bulan Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="bl" onfocus="highlight(event)" class="c">
		  <?
			$bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
			for ($i=1; $i<=12; $i++) {
			   if ($i==$bl || $bulan[$i]==$bln) {
				  print( "<option value=$i selected>".$bulan[$i]."</option>" );
				 } else {
				  print( "<option value=$i>".$bulan[$i]."</option>" );
				 }	
			}
			?>
		 </select>
		<select name="th" onfocus="highlight(event)" class="c">
		  <?
			$awalth = 1995;
			for ($i=$awalth; $i<=$awalth+10; $i++) {
			  if ($i==$th) {
				  print( "<option value=$i selected>$i</option>" );
				} else {
				  print( "<option value=$i>$i</option>" );
				}	
			}
			
			?>
		 </select>
		</td>
	</tr> -->
	<?
	  //var_dump($bulan);
			$jnsval = array(1=>'gadai','tebus','pulih');
			$jnslab = array(1=>'Pinjaman Polis (Gadai)','Penebusan Polis','Pemulihan Pertanggungan');
	?>
  <tr>
    <td align="left" class="arial10" width="45%">Jenis Pengajuan</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="jns" onfocus="highlight(event)" class="c">
		 <?
		  for ($i=1; $i<=count($jnsval); $i++) {
		   if ($jnsval[$i] == $jns) { 
			 $jenis = $jnsval[$i];
			 	print( " <option selected value=".$jnsval[$i].">".$jnslab[$i]."</option>\n" );
			 } else {
			 	print( " <option value=".$jnsval[$i].">".$jnslab[$i]."</option>\n" );
			 }	
			}
		 ?>
		 </select>
		</td>
	</tr>
	<tr>
		<td colspan="3" width="100%" align="left"><input name="cari" value="Periksa Status Pengajuan" type="submit">
		</td>
	</tr>
	
</table>
<hr size="1">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="1000" align="center">
  <tr>
    <td class="tblhead" align="center"><b>DAFTAR PENGAJUAN <? echo strtoupper($jns);?> RAYON PENAGIHAN <? echo $kantor; ?></td>
	</tr>
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor Polis</td>
			  <td align="center">Produk</td>
			  <td align="center">Tanggal<br>Pengajuan</td>
			  <td align="center">Tanggal<br>Perhitungan</td>
			  <td align="center">Tanggal<br>Otorisasi</td>
			  <td align="center">User <br>Rekam</td>
			  <td align="center">Tanggal<br>Rekam</td>
			  <td align="center">Status <br>Terakhir</td>
				<td align="center">Proses<br>Berikut</td>
				
			 </tr>
<?


$bl = (strlen($bl)==1) ? "0".$bl : $bl;
$tglhitung = (strtoupper($jns)=='GADAI') ? "tglgadai" : "tglhitung";
$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status, ".
		 	 "to_char(a.tglmohon,'DD/MM/YYYY') tglmohon,".
			 "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam ".
		   "from $DBUser.tabel_901_pengajuan_klaim a,$DBUser.tabel_999_kode_status b, ".
			 "$DBUser.tabel_200_pertanggungan c,$DBUser.tabel_500_penagih d ".
			 "where ".//to_char(a.tglmohon,'MMYYYY')='".$bl.$th."' ".
			 //"and a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
			 
			 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' ".
			 "and a.status=b.kdstatus and b.jenisstatus='".strtoupper($jns)."' ".
			 "order by a.prefixpertanggungan,a.nopertanggungan desc";
//echo $sql;
$DB->parse($sql);
$DB->execute();

$i=1;
while ($arr=$DB->nextrow()) {
$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
include "../../includes/belang.php";
$tglotorisasi = (!$arr["TGLOTORISASI"]=='') ? $arr["TGLOTORISASI"] : "<font color=red>-</font>";
  print( "	<td class=verdana8blu align=\"center\" width=3%>$i</td>\n" );
  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\"><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
  print( "	<td class=verdana8blu align=\"left\">".$PER->produk."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLMOHON"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLHITUNG"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$tglotorisasi."</td>\n" );
  print( "	<td class=verdana8blu align=\"left\">".$arr["USERREKAM"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLREKAM"]."</td>\n" );
	print( "	<td class=verdana8blu align=\"left\"><font face=verdana size=1 color=blue>".$arr["STATUS"]." </font>".$arr["NAMASTATUS"]."</td>\n" );
  $status=$arr["STATUS"];
	$prefix=$arr["PREFIXPERTANGGUNGAN"];
	$noper =$arr["NOPERTANGGUNGAN"];
	switch ($jenis) {
	case 'gadai':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2.php?prefix=$prefix&noper=$noper')\">Klik</a>";
  	 break;
		case '2':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=G01GADAI&prefix=$prefix&noper=$noper')\">Klik</a>";
  	 break;
		case '3':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pelunasangadai.php?prefix=$prefix&noper=$noper')\">Klik</a>";
  	 break;
	 }
	 break;
	case 'tebus':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2.php?prefix=$prefix&noper=$noper')\">Klik</a>";
  	 break;
		case '2':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=T01TEBUS&prefix=$prefix&noper=$noper')\">Klik</a>";
  	 break;
		case '3':
		 $lanjut = 'TEBUS SELESAI';
  	 break;
	 }
	 break;
	case 'pulih':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">Klik</a>";
  	 break;
		case '2':
		 $lanjut = 'TUNGGU SPP';
  	 break;
		case '3':
		 $lanjut = 'SPP TERBIT';
  	 break;
		default:
		 $lanjut = 'PENDING';
  	 break;
		 
	 }
	 break;
 }	 	 
		 	
	print( "	<td class=verdana8blu align=\"center\">".$lanjut."</td>\n" );
  print( " </tr>" );
 $i++;
}			 
?>		  
			</table>
    </td>
   </tr>
</table>

<table width="1000">
  <tr>
    <td width="50%" align="left"><a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a></td>
		<td width="50%" align="right"><a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a></td>
	</tr>
</table>

</td>
</tr>
		
</div>
</body>
</html>