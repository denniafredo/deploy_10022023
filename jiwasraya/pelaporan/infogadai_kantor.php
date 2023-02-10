<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
$DB = new Database($userid, $passwd, $DBName);
?>
<html>
<head>
<title>Informasi Polis Gadai</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
</head>
<body>
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<a class=verdana10blk><b>DAFTAR POLIS GADAI KANTOR <? echo $kantor; ?></b></a>
<hr size="1">
<div align="center">
		  <table  border="0" cellspacing="1" cellpadding="1">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor Polis</td>
			  <td align="center">Tertanggung</td>
				<td align="center">Produk</td>
			  <td align="center">Tgl. Pengajuan</td>
			  <td align="center">Tgl. Perhitungan</td>
			  <td align="center">Tgl. Otorisasi</td>
			  <td align="center">User Rekam</td>
			  <td align="center">Tgl. Rekam</td>
			  <td align="center">Status Terakhir</td>
				<!--<td align="center">Proses Berikut</td>-->
			 </tr>
<? 
$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.userrekam,b.namastatus,a.status, ".
		 	 "to_char(a.tglmohon,'DD/MM/YYYY') tglmohon,to_char(a.tglgadai,'DD/MM/YYYY') tglhitung,".
			 "to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,c.kdproduk,".
			 "to_char(a.tglrekam,'DD/MM/YYYY') tglrekam,e.namaklien1  ".
		   "from $DBUser.tabel_700_gadai a,$DBUser.tabel_999_kode_status b, ".
			 "$DBUser.tabel_200_pertanggungan c,$DBUser.tabel_500_penagih d, ".
			 "$DBUser.tabel_100_klien e ".
			 "where ".
			 "a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".	 
			 "and c.nopenagih=d.nopenagih and d.kdrayonpenagih='$kantor' and a.status='3' ".
			 "and a.status=b.kdstatus and b.jenisstatus='GADAI' and c.notertanggung=e.noklien ".
			 "order by a.prefixpertanggungan,a.nopertanggungan desc";

$DB->parse($sql);
$DB->execute();
//echo $sql;
$i=1;
while ($arr=$DB->nextrow()) {
$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
include "../../includes/belang.php";
$tglotorisasi = (!$arr["TGLOTORISASI"]=='') ? $arr["TGLOTORISASI"] : "<font color=red>-</font>";
  print( "	<td class=verdana8blu align=\"center\">$i</td>\n" );
  print( "	<td class=verdana8blu align=\"left\"><a href=\"#\"><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
  print( "	<td class=verdana8blu>".$arr["NAMAKLIEN1"]."</td>\n" );
	print( "	<td class=verdana8blu align=\"left\">".$arr["KDPRODUK"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLMOHON"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLHITUNG"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$tglotorisasi."</td>\n" );
  print( "	<td class=verdana8blu align=\"left\">".$arr["USERREKAM"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLREKAM"]."</td>\n" );
	print( "	<td class=verdana8blu align=\"left\">".$arr["NAMASTATUS"]."</td>\n" );
  //print( "	<td class=verdana8blu align=\"left\"><font face=verdana size=1 color=blue>".$arr["STATUS"]." </font>".$arr["NAMASTATUS"]."</td>\n" );
	$status=$arr["STATUS"];
	$prefix=$arr["PREFIXPERTANGGUNGAN"];
	$noper =$arr["NOPERTANGGUNGAN"];

	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 break;
	  case '1':
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2.php?prefix=$prefix&noper=$noper')\">KE PENGAJUAN II</a>";
  	 $lanjut = "KE PENGAJUAN II";
		 break;
		case '2':
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=G01GADAI&prefix=$prefix&noper=$noper')\">KE PEMBAYARAN</a>";
  	 $lanjut = "KE PEMBAYARAN";
		 break;
		case '3':
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pelunasangadai.php?prefix=$prefix&noper=$noper')\">KE PELUNASAN GADAI</a>";
  	 $lanjut = "KE PELUNASAN GADAI";
		 break;
	 }
	//print( "	<td class=verdana8blu align=\"left\">".$lanjut."</td>\n" );
  print( " </tr>" );
 $i++;
}			 
?>		  
			</table>
		
</div>
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a>
</body>
</html>