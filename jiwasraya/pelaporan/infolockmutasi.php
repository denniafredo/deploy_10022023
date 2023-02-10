<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";


$DB = new Database($userid, $passwd, $DBName);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Informasi Polis Dalam Proses Mutasi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table width="900" border="0" cellpadding="1" cellspacing="1" class="tblhead">
  <tr>
    <td class="tblhead" align="center"><b>PENGECEKAN POLIS DALAM STATUS MUTASI  <? echo strtoupper($jns);?> RAYON PENAGIHAN <? echo $kantor; ?></td>
	</tr>
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor Polis</td>
			  <td align="left">Nama Mutasi</td>
			  <td align="center">User <br>Rekam</td>
			  <td align="center">Tanggal<br>Rekam</td>
			  <td align="center">Status <br>Terakhir</td>
				<td align="center">Proses<br>Berikut</td>
			 </tr>
<?
$sql =  "select a.prefixpertanggungan,a.nopertanggungan,c.namamutasi ".
 				"from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b, ".
				"$DBUser.tabel_601_kode_mutasi c ".
				"where  a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' ".
				"and a.lockmutasi=c.kdmutasi and a.lockmutasi is not null ".
			 	"order by a.prefixpertanggungan,a.nopertanggungan ";
 
$DB->parse($sql);
$DB->execute();
//echo $sql;
$i=1;
while ($arr=$DB->nextrow()) {
$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
include "../../includes/belang.php"; 
  print( "	<td class=verdana8blu align=\"center\">$i</td>\n" );
  print( "	<td class=verdana8blu align=\"center\"><a href=\"#\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
  print( "	<td class=arial8 align=\"left\">".$arr["NAMAMUTASI"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"left\">".$arr["USERREKAM"]."</td>\n" );
  print( "	<td class=verdana8blu align=\"center\">".$arr["TGLREKAM"]."</td>\n" );
	print( "	<td class=verdana8blu align=\"left\">".substr($arr["NAMASTATUS"],0,27)."</td>\n" );
  $status=$arr["STATUS"];
	$prefix=$arr["PREFIXPERTANGGUNGAN"];
	$noper =$arr["NOPERTANGGUNGAN"];
	$kdklaim=$arr["KDKLAIM"];
	switch ($jenis) {
	case 'gadai':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 $cetaksip = '';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuangadai2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip = '';
		 break;
		case '2':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=G01GADAI&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
  	 break;
		case '3':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pelunasangadai.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip = '';
		 break;
	  case '4':
		 $lanjut = 'S E L E S A I';
		 $cetaksip = '';
		 break;		 
	 }
	 break;
	case 'tebus':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 $cetaksip = '';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuantebus2.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip = '';
		 break;
		case '2':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/pembayarankeluar.php?kdbayar=T01TEBUS&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
  	 break;
		case '3':
		 $lanjut = 'TEBUS SELESAI';
  	 $cetaksip = '';
		 break;
	 }
	 break;
	case 'pulih':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 $cetaksip = '';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/kasirentry006.php?prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip = '';
		 break;
		case '2':
		 $lanjut = 'TUNGGU SPP';
  	 $cetaksip = '';
		 //$cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
  	 break;
		case '3':
		 $lanjut = 'SPP TERBIT';
  	 $cetaksip = '';
		 break;
		default:
		 $lanjut = 'P E N D I N G';
  	 $cetaksip = '';
		 break;
	 }
	 break;
	 
	 case 'klaim':
	 switch ($status) {
	  case '0':
		 $lanjut = 'TUNGGU DESISI';
		 $cetaksip = '';
		 break;
	  case '1':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../polis/pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=".$arr["TGLMOHON"]."')\">KLIK DISINI</a>";
  	 $cetaksip = '';
		 break;
		case '2':
		 $lanjut = "<a href=\"#\" onclick=\"window.location.replace('../akunting/bayar.php?kdklaim=".$arr["KDKLAIM"]."&prefix=$prefix&noper=$noper')\">KLIK DISINI</a>";
  	 $cetaksip =  "<a href=# onclick=NewWindow('../polis/cetaksip.php?kdsip=$jenis&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>CETAK SIP</a>";
  	 break;
		case '3':
		 $lanjut = 'KLAIM SELESAI';
  	 $cetaksip = '';
		 break;
		} 
 }	 	 
	print( "	<td class=verdana8blu align=\"left\">".$lanjut."</td>\n" );
  print( "	<td class=verdana8blu align=\"left\">".$cetaksip."</td>\n" );
	print( " </tr>" );
 $i++;
}			 
?>		  
			</table>
    </td>
   </tr>
</table>
<hr size="1">
<table width="900">
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