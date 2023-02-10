  <?
 //ob_start();
  include "includes/database.php";
  include "includes/session.php"; 
	
  $DB=New database($userid, $passwd, $DBName);

	$namaklien=(!$namaklien1) ? stripslashes($namaklien) : $namaklien1; 
?>
<title>Data Klien Normal</title>
<html>
<link href="includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>

<? include "includes/hide.php";  ?>
<body topmargin="0">
<table width="100%" class="arial10">
	<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F4210</td></tr>
	<tr><td><b>Pemeliharaan Data Klien</b></td></tr>
</table>

<hr size=1>
<table width="100%" cellpadding="1" cellspacing="1" class="tblhead">
<tr>
<td  class="tblisi">
<table width="100%" cellpadding="1" cellspacing="3" class="verdana9">
<tr>
  <td width="100">Nama Klien</td>
	<td>: <? echo $noklien."  -  <b>".$namaklien; ?></td>
  <td align="right"><font color="red"><b><? $a = ($noklien) ? 'EDIT': 'ENTRY BARU'; echo $a; ?></td>
</tr>
<tr>
  <td>Jenis Klien</td>
	<td>: I Individual</td>
  <td align="right">Status : Aktif</td>
</tr>
 <?
 if (!strlen($noklien)==0) {	
	if($kantor=="KP"){
  $sql = "select prefixpertanggungan,nopertanggungan ".
			 	 "from $DBUser.tabel_200_pertanggungan ".
			 	 "where notertanggung='$noklien' and kdpertanggungan='2' and kdstatusfile in ('1','4')  and kdproduk like 'JL4%'".
			   "order by prefixpertanggungan,nopertanggungan";
	}else{
	$sql = "select prefixpertanggungan,nopertanggungan ".
			 	 "from $DBUser.tabel_200_pertanggungan ".
			 	 "where notertanggung='$noklien' and kdpertanggungan='2' and kdstatusfile in ('1','4')".
			   "order by prefixpertanggungan,nopertanggungan";
  }
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$coun=0;
	while ($ari=$DB->nextrow()) {
				$npert=$ari["NOPERTANGGUNGAN"];
 				$coun++;
	} 
	
	//$npert = ($userid == 'WIRDA_AC') ? null : $npert;
	
  if (!$coun==0) {
    print( "<tr class=arial10 bgcolor=#ccccff>\n" );
    print( "  <td colspan=2><font face=Verdana size=2 color=#ff3366>PERINGATAN : Klien Ini Memiliki ".$coun." Polis. Tidak diperkenankan untuk mengedit.</td>\n" );
  	print( "  <td ><a href=\"#\" onclick=\"NewWindow('../pelaporan/jmlpolisklien?noklien=$noklien&namaklien1=$namaklien','',600,300,1)\">Lihat</a></td>\n" );
  	print( "</tr>" );
  }
 }		
 ?>
</table>
</td>
</tr>
</table>

<br>
<?
 // cek jika tertanggung/klien memiliki polis
 if ($npert){ 
 ?>
	 1. <a class="arial10" href="editclnthub.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Hubungan Dengan Klien Lain<br></a>
	 2. <a class="arial10" href="skk1_newjslink.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Surat Keterangan Kesehatan<br></a>
   3. <a class="arial10" href="skk_newjslink.php?<? echo "noklien=$noklien"; ?>">Cetak SKK<br></a>
	 <?
	 //echo "<h2>Klien ini tidak dapat diedit !</h2>";
 } else if (!strlen($noklien)==0) {	//edit
 ?>
 1. <a class="arial10" href="editclntmain_link.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Data Klien<br></a>
 2. <a class="arial10" href="editclntalmt.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Alamat<br></a>
 3. <a class="arial10" href="editclnthub_link.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Hubungan Dengan Klien Lain<br></a>
 4. <a class="arial10" href="skk1_newjslink.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Surat Keterangan Kesehatan<br></a>
<?
$sql = "select count(*) jumlahpolis ".
			 	 "from $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN ".
			 	 "where (prefixpertanggungan,nopertanggungan) in (select prefixpertanggungan,nopertanggungan ".
			 	 "from $DBUser.tabel_200_pertanggungan ".
			 	 "where notertanggung='$noklien' and kdpertanggungan='2' and kdstatusfile in ('1','4')  and kdproduk like 'JL4%')";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
if($arr["JUMLAHPOLIS"]!=0){
?> 
5. <a class="arial10" href="skk_newjslink.php?<? echo "noklien=$noklien"; ?>">Cetak SKK<br></a>
 <?
}else{
?> 
5. <a class="arial10" href="skk1_newjslink.php?<? echo "noklien=$noklien&namaklien=$namaklien&act=ulang"; ?>">Entry Ulang SKK<br></a>
6. <a class="arial10" href="skk_newjslink.php?<? echo "noklien=$noklien"; ?>">Cetak SKK<br></a>
 <?
 }
}else{?>
 1. <a class="arial10" href="editclntmain_link.php?<? echo "nk=$nk&tgllahir=$tgllahir&jeniskelamin=$jeniskelamin&kdid=$kdid&noid=$noid&noklien=$noklien&namaklien=$namaklien"; ?>">Entry Data Klien<br></a>
 2. <a class="arial10" href="skk1_newjslink.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Surat Keterangan Kesehatan<br></a>
 3. <a class="arial10" href="skk_newjslink.php?<? echo "noklien=$noklien"; ?>">Cetak SKK<br></a> 
<!-- 2. <a class="arial10" href="editclntalmt.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Entry Alamat<br></a>
 3. <a class="arial10" href="editclnthub.php?<? echo "noklien=$noklien&namaklien=$namaklien"; ?>">Entry Hubungan dengan Klien lain<br></a>-->

<? } ?>
<br>
<br>
<hr size=1>
<table width=100%>
<tr class=arial10>
 <td><a href="entryklien_ul.php">Menu Utama</a></td>
 <td><a href="entrykeymtc_link.php">Menu Pemeliharaan Klien</a>
 <td><!--<a href="entrykey1.php">Entry Klien Berikutnya</a>--></td>
</tr>
</table>
</body>
</html>