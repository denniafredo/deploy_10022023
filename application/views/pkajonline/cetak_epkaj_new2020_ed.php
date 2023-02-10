<?
	// Cetak PKAJ untuk agen PP
 include "../includes/database.php";
 include "../includes/session.php";
 include "../includes/klien.php";
 include "../includes/pertanggungan.php";
 include "../includes/kantor.php";
 $DB=New Database($userid,$passwd,"JSDB");	
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 
 // $sql = "select emailtetap,NOPKAJAGEN,KDKANTOR,NOAGENBM,NAMABM,a.NOAGEN NOAGEN,JABATANBM,NIPBM,ALAMATKTR,TELPONKTR,FAXKTR, ".
 // 		"noagen, nomoridagen,alamatagen, notelponagen,saksi1,saksi2,jabatansaksi1,jabatansaksi2,NAMAKLIEN1,".
	// 	"TO_CHAR(TGLPKAJAGEN,'DD') TGL,TO_CHAR(TGLPKAJAGEN,'MM') BLN, TO_CHAR(TGLPKAJAGEN,'YYYY') THN, tempatlahir, TO_CHAR(tgllahir,'DD/MM/YYYY') tgllahir,DECODE(jeniskelamin,'L','LAKI-LAKI','PEREMPUAN') jeniskelamin,".
 // 		"nopkajagen,TO_CHAR(TGLPKAJAGEN,'DD/MM/YYYY') TGLPKAJAGEN from jsadm.tabel_400_pkaj_agen a, jsadm.tabel_100_klien b ".
	// 	"where noagen='$noagen' and TO_CHAR(TGLPKAJAGEN,'DD/MM/YYYY')='$tglpkaj' and a.noagen=b.noklien order by TGLPKAJAGEN desc";


$DBQ = new Database('jsadm','jsadmoke','JSDB');
$sql = "SELECT c.NOPKAJAGEN,
               c.KDKANTOR,
               c.NOAGENBM,
               c.NAMABM,
               c.NOAGEN,
               b.NAMAKLIEN1,
               c.JABATANBM,
               c.NIPBM,
               c.ALAMATKTR,
               c.TELPONKTR,
               c.FAXKTR,
               c.NOMORIDAGEN,
               c.ALAMATAGEN,
               c.NOTELPONAGEN,
               TO_CHAR (c.TGLPKAJAGEN, 'DD') TGL,
               TO_CHAR (c.TGLPKAJAGEN, 'MM') BLN,
               TO_CHAR (c.TGLPKAJAGEN, 'YYYY') THN,
               b.tempatlahir,
               TO_CHAR (b.tgllahir, 'DD/MM/YYYY') tgllahir,
               DECODE (b.jeniskelamin, 'L', 'LAKI-LAKI', 'PEREMPUAN') jeniskelamin,
               NOPKAJAGEN,
               TO_CHAR (c.TGLPKAJAGEN, 'DD/MM/YYYY') TGLPKAJAGEN,
               c.AGEN_QRCODE,
               c.KANCAB_QRCODE
        FROM   jsadm.tabel_100_klien b, tabel_400_epkaj_agen@jaim c
       WHERE       NOAGEN = '$noagen'
               AND TO_CHAR (c.TGLPKAJAGEN, 'DD/MM/YYYY') = '$tglpkaj' 
               AND c.NOAGEN = b.NOKLIEN
    ORDER BY   TGLPKAJAGEN DESC";
	//echo $sql;

 $DBQ->parse($sql);
 $DBQ->execute();
 $row=$DBQ->nextrow();
//  var_dump($row);
 
 
$nama_hari = array(1=>"Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");   

$x= mktime(0, 0, 0, $row["BLN"], $row["TGL"],  $row["THN"]);
//ECHO mktime(0, 0, 0, date("m"), date("d"),  date("Y"));
//echo "Sekarang hari ".$nama_hari[date("n",$x)];
$namahari=date("l", $x);
if ($namahari == "Sunday") $namahari = "Minggu";
else if ($namahari == "Monday") $namahari = "Senin";
else if ($namahari == "Tuesday") $namahari = "Selasa";
else if ($namahari == "Wednesday") $namahari = "Rabu";
else if ($namahari == "Thursday") $namahari = "Kamis";
else if ($namahari == "Friday") $namahari = "Jumat";
else if ($namahari == "Saturday") $namahari = "Sabtu";

$nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");   

$DBX=new Database($userid,$passwd,"JSDB");
$sqlt="select jsadm.terbilang (".$row["THN"].") bilangan from dual";
	$DBX->parse($sqlt);
	$DBX->execute();
	$arrt=$DBX->nextrow();
	$tahun=ucwords(strtolower(str_replace('RUPIAH','',$arrt["BILANGAN"])));

$sqltgl="select jsadm.terbilang (".$row["TGL"].") bilangan from dual";
	$DBX->parse($sqltgl);
	$DBX->execute();
	$arrtgl=$DBX->nextrow();
	$tanggal=ucwords(strtolower(str_replace('RUPIAH','',$arrtgl["BILANGAN"])));
 ?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>PERJANJIAN KEAGENAN ASURANSI JIWA</title>
<style>
<!--
body {
	font-family:"Times New Roman","serif";
	font-size:12pt;
}
table.MsoTableGrid
	{border:1.0pt solid windowtext;
	font-size:12pt;
	font-family:"Times New Roman","serif"}
 p.MsoNormal
	{mso-style-parent:"";
	margin-bottom:.0001pt;
	font-size:12pt;
	font-family:"Times New Roman","serif";
	margin-left:0in; margin-right:0in; margin-top:0in}
 table.MsoNormalTable
	{mso-style-parent:"";
	font-size:12pt;
	font-family:"Times New Roman","serif"}
p.MsoBodyTextIndent2
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:14.15pt;
	line-height:200%;
	font-size:12pt;
	font-family:"Times New Roman","serif";
	}
h1
	{margin-bottom:.0001pt;
	text-align:justify;
	page-break-after:avoid;
	font-size:14pt;
	font-family:"Tahoma","sans-serif";
	margin-left:0in; margin-right:0in; margin-top:0in}
h2
	{margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:0in;
	page-break-after:avoid;
	font-size:14pt;
	font-family:"Tahoma","sans-serif";
	font-style:italic}
.style1 {font-family: Arial, sans-serif}
-->
</style>
</head>

<body>
<table class="MsoTableGrid" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: medium none; border:1px solid #000;padding:2px 5px;font-weight:bold;">
	<tr>
		<td>EPKAJ - ver. 2020/01-3.0</td>
	</tr>
</table>
<br><br><br>
<table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" width="615" style="border-collapse: collapse; border: medium none">
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center"><b>
		<span lang="FI" style="font-family: Arial,sans-serif">PERJANJIAN 
		KEAGENAN ASURANSI JIWA</span></b></td>
	</tr>
	<tr style="height: 23.25pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 23.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center">
		<span lang="FI" style="font-family: Arial,sans-serif">NOMOR :
                  <?=$row["NOPKAJAGEN"];?>
                  /EPKAJ- 
                  <? if($row["THN"] >= 2020){
                  	echo ("KP - ".
                  	$row["BLN"]." ".
                  	substr($row["THN"],-2));
                  }else{
                  	echo ($row["KDKANTOR"]." - ".
                  	$row["BLN"]." ".
                  	$row["THN"]);
                  }
                  ?>
                  	
                  </span></p>
		<p class="MsoNormal" align="center" style="text-align: center"><b>
		<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">Pada 
                  hari ini
                  <?=$namahari;?>
                  tanggal
  <?=$tanggal;?>
                  bulan
  <?=$nama_bulan[date("n", $x)];?>
                  tahun
  <?=$tahun;?>
                  ,kami yang bertanda tangan 
                  di bawah ini :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">I.</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nama</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"> <?=$row["NAMABM"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nomor Kepegawaian/ 
		Agen</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><? if (strlen($row["NIPBM"])<2){ echo $row["NOAGENBM"];} else{echo $row["NIPBM"];}?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Jabatan&nbsp; </span>		</td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["JABATANBM"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Alamat Kantor</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["ALAMATKTR"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nomor 
		Telepon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["TELPONKTR"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nomor Faximile&nbsp;&nbsp;		</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["FAXKTR"];?></span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">yang dalam perbuatan hukum 
		ini bertindak dalam jabatannya tersebut untuk dan atas nama PT Asuransi Jiwasraya (Persero) dan karenanya sah mewakili Direksi yang berkedudukan kantor pusat di Jl. Ir. H. Juanda No. 34, Jakarta Pusat (10120), 
		yang selanjutnya disebut:</span></td>
	</tr>
	<tr style="height: 5.25pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 5.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: center; margin-right: -5.4pt;">
			<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span><span style="font-family: Arial,sans-serif;">----------------------------------------------<b>PERUSAHAAN</b>---------------------------------------------</span></td>
		</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">II.</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nama (sesuai 
		KTP)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NAMAKLIEN1"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">No. Agen</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NOAGEN"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Tempat/Tgl Lahir</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		  <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span style="font-family: Arial,sans-serif"><?=$row["TEMPATLAHIR"];?>
                        ,
                        <?=$row["TGLLAHIR"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Jenis Kelamin</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">
		<?=$row["JENISKELAMIN"];?> </span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Alamat (sesuai 
		KTP)</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["ALAMATAGEN"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nomor KTP/SIM</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NOMORIDAGEN"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Nomor Telepon 
		Rumah/Hp</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NOTELPONAGEN"];?></span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">Alamat Email&nbsp;&nbsp;&nbsp;&nbsp;		</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["EMAILTETAP"];?></span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="FI" style="font-family: Arial,sans-serif">yang dalam hal ini 
		bertindak</span><span style="font-family: Arial,sans-serif"> untuk dan 
		atas nama diri sendiri, yang selanjutnya disebut :</span></td>
	</tr>
	<tr style="height: 9.75pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 9.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">&nbsp;<span lang="FI">-----------------------------------------------------<b>AGEN</b>----------------------------------------------------</span></span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">sebagaimana dimaksud dalam 
		Undang-Undang Nomor 40 tahun 2014 tentang Perasuransian, 
		aturan-aturan pelaksanaannya serta perubahan-perubahannya yang dilakukan 
		dari waktu ke waktu dan berada pada saluran distribusi <i>Branch Office 
		System (BOS)</i> PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">PERUSAHAAN dan AGEN secara 
		bersama-sama selanjutnya disebut PARA PIHAK.</span></p>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span style="font-family: Arial,sans-serif">PARA PIHAK telah bersepakat 
		untuk mengadakan Perjanjian Keagenan Asuransi Jiwa yang selanjutnya 
		disebut "PKAJ", di mana PERUSAHAAN menetapkan dan menunjuk AGEN
		sebagaimana AGEN menerima dan menyetujui penetapan dan penunjukan 
		tersebut untuk memberikan jasa dalam memasarkan produk asuransi milik 
		PERUSAHAAN untuk dan atas nama PERUSAHAAN, berdasarkan syarat-syarat dan 
		ketentuan-ketentuan sebagaimana diatur dalam pasal-pasal di bawah ini :</span></td>
	</tr>
	<tr style="height: 40pt;border:0px solid #000;">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 13.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
		<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr style="height: 7.5pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 7.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center"><b>
		<span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 1</span></b></td>
	</tr>
	<tr style="height: 12.15pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 12.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">ARTI DARI 
		BEBERAPA ISTILAH</span></b></td>
	</tr>
	<tr style="height: 9.75pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 9.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="margin-right: -5.4pt"><b>
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Di dalam PKAJ ini 
		yang dimaksud dengan : </span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">1.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PKAJ</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah Perjanjian Keagenan Asuransi Jiwa beserta lampiran dan perubahan-perubahannya yang menguraikan hak dan kewajiban PARA PIHAK yang harus dipatuhi dan dilaksanakan agar mencapai bisnis perasuransian yang saling menguntungkan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">2.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Surat Penetapan Agen (SPA)</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah surat yang diterbitkan oleh PERUSAHAAN yang memuat tentang penunjukan sebagai AGEN yang berisikan nomor AGEN, nama AGEN, Jabatan, Agency, nama atasan AGEN , target AGEN dan/atau hal-hal lain yang berkaitan dengan administrasi Keagenan, yang dapat dicabut dan diubah oleh PERUSAHAAN apabila diperlukan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">3.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Agen </span>		</td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah mitra PERUSAHAAN yang bertindak atas nama PERUSAHAAN, yang kegiatannya memberikan jasa dalam memasarkan produk asuransi PERUSAHAAN dan memiliki izin dari pihak yang berwenang mengeluarkannya serta terikat dalam perjanjian dengan PERUSAHAAN yang tertuang dalam PKAJ.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">4.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pedoman Sistem Keagenan Bisnis Ritel</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah ketentuan yang mengatur hak dan kewajiban PERUSAHAAN dan AGEN sebagai mitra kerja yang ditetapkan oleh PERUSAHAAN, termasuk ketentuan pelaksanaannya berikut perubahan-perubahannya yang ditetapkan dari waktu ke waktu.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">5.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Jabatan</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah kedudukan atau posisi AGEN berdasarkan Struktur Keagenan yang berlaku sebagaimana ditetapkan dalam Surat Penetapan Agen (SPA) oleh PERUSAHAAN dari waktu ke waktu selama berlakunya PKAJ ini.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">6.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Promosi </span>		</td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah kenaikan 
		Jabatan AGEN lebih tinggi dibandingkan&nbsp; Jabatan sebelumnya;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">7.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Degradasi </span>		</td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah penurunan 
		Jabatan AGEN lebih rendah dibandingkan&nbsp; Jabatan sebelumnya;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">8.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Validasi </span>		</td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">atau Jenjang Tetap adalah proses evaluasi untuk AGEN tetap berada pada level atau jenjang keagenannya saat ini, dimana acuannya adalah pencapaian kinerja AGEN sesuai standar yang telah ditentukan PERUSAHAAN.</span></p>
		<p class="MsoNormal" style="text-align: justify; line-height: 7.0pt; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">9.</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Produk </span>		</td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah 
		produk-produk PERUSAHAAN yang meliputi jasa Asuransi Jiwa dan/atau 
		pertanggungan risiko atau Produk yang berafiliasi/beraliansi dengan 
		perusahaan lain.</span></p>
		<p class="MsoNormal" style="text-align: justify; line-height: 7.0pt; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">10</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Fungsi Pemasaran		</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah fungsi 
		untuk memasarkan, menjual, memberikan penjelasan kepada calon Pemegang 
		Polis dan melakukan hal-hal yang dianggap perlu dalam memasarkan produk,&nbsp; 
		yang harus dilakukan oleh AGEN berdasarkan PKAJ;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">11</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Kewenangan Pemasar / Agen</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Bertindak atas nama Perusahaan, yang kegiatanya memberikan jasa dalam memasarkan produk asuransi Perusahaan dan memiliki izin dari pihak yang berwenang mengeluarkannya serta terikat dalam perjanjian kerja dengan Perusahaan yang tertuang dalam PKAJ.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">12</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif"><i>Field Underwriting</i></span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah melakukan 
		verifikasi terhadap kebenaran, kelengkapan dan akurasi data-data/informasi 
		tentang Calon Pemegang Polis/Calon Tertanggung sebagaimana tertera atau terlampir pada 
		Surat Permintaan Asuransi Jiwa dan dan Surat Keterangan Kesehatan, serta memberikan
		informasi penting lainnya kepada PERUSAHAAN tetang Calon Pemegang Polis/Calon Tertanggung
		yang dapat mempengaruhi keputusan penerimaan/penolakan penutupan asuransi.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">13</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Kode Etik Keagenan</span></p>
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify"><b>
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah ketentuan 
		yang ditetapkan dari waktu ke waktu oleh Asosiasi Asuransi Jiwa 
		Indonesia (AAJI) yang mengatur tata-cara, perilaku, larangan dan sanksi kepada
		Agen Asuransi Jiwa Indonesia termasuk kepada AGEN berdasarkan PKAJ ini.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">14</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif"><i>Pooling</i></span></p>
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify"><b>
					<span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Adalah larangan terhadap AGEN untuk mengalihkan penjualan
			produk yang telah dilakukan kepada AGEN lainnya.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">15</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif"><i>Twisting</i></span></p>
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify"><b>
					<span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah larangan terhadap AGEN untuk membujuk dan/ atau mempengaruhi Pemegang Polis untuk merubah spesifikasi polis yang ada atau mengganti polis yang ada dengan polis yang baru pada Perusahaan Asuransi Jiwa lainnya, dan/ atau membeli polis baru dengan menggunakan dana yang berasal dari polis yang masih aktif pada suatu Perusahaan Asuransi Jiwa lainnya dalam waktu 6 (enam) bulan sebelum dan sesudah tanggal polis baru di Perusahaan Asuransi Jiwa lain diterbitkan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">16</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif"><i>Churning</i></span></p>
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify"><b>
					<span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah tindakan membujuk dan mempengaruhi Pemegang Polis untuk mengubah spesifikasi polis yang ada atau mengganti polis yang ada dengan polis yang baru pada PERUSAHAAN, dan/ atau membeli polis baru dengan menggunakan dana yang berasal dari polis yang masih aktif dari PERUSAHAAN tanpa penjelasan terlebih dahulu kepada Pemegang Polis mengenai kerugian yang dapat diderita oleh pemegang polis akibat perubahan/ penggantian tersebut.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">17</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif"><i>Rebating</i></span></p>
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify"><b>
					<span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah potongan premi yang diberikan AGEN kepada Calon Pemegang Polis/ Calon Tertanggung yang diperhitungkan dari komisi Agen yang akan didapatnya jika berhasil menjual produk kepada Calon Pemegang Polis/ Calon tertanggung tersebut.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">18</span></td>
		<td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">Pecah Polis</span></p>
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify"><b>
		<span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
		<td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">adalah pemecahan penutupan asuransi atas nama satu orang Pemegang Polis/ Tertanggung menjadi beberapa polis, dengan kondisi yang sama dan dibagi-bagikan kepada Agen Penutup yang berbeda.</span></td>
	</tr>
	<tr style="height: 17.25pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp; 2</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">HUBUNGAN HUKUM</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Hubungan hukum 
		antara PERUSAHAAN dengan AGEN menurut PKAJ ini&nbsp; adalah hubungan antara 
		mitra kerja dan karenanya bukan merupakan hubungan hukum antara 
		pengusaha dan pekerja sekaligus tidak ada satupun dari syarat dan 
		ketentuan yang berlaku dalam PKAJ ini dapat diartikan atau ditafsirkan 
		sebagai suatu hubungan ketenagakerjaan sebagaimana dimaksud dan diatur 
		dalam perundangan tentang&nbsp; Ketenagakerjaan yang berlaku.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 3</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">HAK DAN 
		KEWAJIBAN PERUSAHAAN</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Selama 
		berlangsungnya PKAJ ini, PERUSAHAAN berhak untuk :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menetapkan secara periodik Pedoman Sistem Keagenan Bisnis Ritel di PERUSAHAAN dan/ atau mengubahnya dari waktu ke waktu jika diperlukan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menunjuk dan menetapkan AGEN untuk memasarkan Produk di wilayah operasional PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menetapkan Jabatan AGEN berdasarkan penilaian PERUSAHAAN, dengan Surat Penetapan Agen (SPA).</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menerima hasil penjualan Produk PERUSAHAAN dari AGEN melalui sarana pembayaran yang ditetapkan oleh PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menetapkan hak dan kewajiban AGEN berdasarkan Pedoman Sistem Keagenan Bisnis Ritel serta ketentuan lain yang berlaku di PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengakhiri PKAJ secara sepihak sesuai Pasal 10 ayat (1) PKAJ ini atau berdasarkan kebijakan yang dipandang perlu oleh PERUSAHAAN menurut PKAJ ini.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">g.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan pengawasan terhadap pelaksanaan kewajiban-kewajiban AGEN.</span><br><br><br></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN 
		berkewajiban untuk :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Membayarkan hak AGEN berdasarkan Pedoman Sistem Keagenan Bisnis Ritel serta ketentuan lain yang berlaku di PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memberikan informasi atau data atas penjualan yang telah dihasilkan oleh AGEN berupa data evaluasi prestasi.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan pemotongan dari penghasilan yang diterima oleh AGEN atas beban pajak yang ditetapkan undang-undang dan/atau sesuai ketentuan perpajakan yang berlaku.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menyelenggarakan pendidikan dan pelatihan untuk AGEN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menyediakan pusat informasi yang memuat penjelasan-penjelasan tentang fungsi pemasaran yang diperlukan AGEN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menyediakan sarana sumber daya kerja yang dapat mendukung AGEN dalam melaksanakan fungsi pemasaran.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 4</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">HAK DAN 
		KEWAJIBAN AGEN</span></b></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Selama 
		berlangsungnya PKAJ ini, AGEN berhak :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menerima hak-hak AGEN sesuai dengan Pedoman Sistem Keagenan Bisnis Ritel serta ketentuan lain yang berlaku di PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mendapatkan informasi dari PERUSAHAAN baik secara lisan maupun tertulis yang terkait dengan hak dan kewajiban AGEN.</span></p>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Selama 
		berlangsungnya PKAJ ini, AGEN berkewajiban:</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memiliki 
		sertifikasi dan lisensi Keagenan sebagaimana ditetapkan dalam peraturan 
		dan perundang-undangan yang berlaku.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mematuhi dan melaksanakan ketentuan-ketentuan yang ditetapkan di dalam PKAJ dan/ atau Pedoman Sistem Keagenan Bisnis Ritel dan ketentuan lain yang berlaku di PERUSAHAAN serta ketentuan perundang-undangan yang berlaku.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan manajemen aktivitas penjualan.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify">
				<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
				<span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menjelaskan seluruh hak dan kewajiban calon pemegang polis,
		termasuk dan tidak terbatas pada manfaat asuransi, proses pengajuan klaim dan lain sebagainya
		terkait produk jenis asuransi yang ditawarkan terhadap calon pemegang polis sehingga tidak
		ada suatu yang ditutup-tutupi dan/atau disembunyikan kepada calon pemegang polis berdasarkan prinsip
		itikad baik <i>(Utmost Good Faith)</i> yang berlaku didunia Asuransi;&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mencatat data aktivitas penjualan pada sistem aplikasi yang disediakan PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melaporkan hasil-hasil pekerjaannya kepada pihak yang ditunjuk oleh PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">g.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menjaga nama baik PERUSAHAAN dengan tidak melakukan perbuatan-perbuatan yang dilarang sebagaimana tercantum, namun tidak terbatas pada Pasal 6 ayat (1) PKAJ ini.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">h.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan promosi dan penjualan atau penutupan polis asuransi jiwa yang merupakan Produk untuk kepentingan dan atas nama PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">i.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan prospekting yaitu mencari, mengumpulkan, mencatat nama beserta data-data Calon Pemegang Polis/Calon Tertanggung.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">j.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memberikan layanan purna jual kepada Pemegang Polis.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">k.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan kunjungan penjualan kepada Calon Pemegang Polis/ Calon Tertanggung serta melaporkan hasil kunjungannya tersebut dengan menggunakan media yang ditentukan oleh PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">l.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mencapai target yang ditetapkan oleh PERUSAHAAN sebagaimana tercantum dalam Surat Penetapan Agen (SPA).&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">m.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan field underwriting  terhadap Calon Pemegang Polis/ Calon Tertanggung.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">n.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Membantu Calon Pemegang Polis/ Calon Tertanggung dalam proses pengajuan permintaan keikutsertaan program asuransi jiwa yang dipilihnya.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">o.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memastikan Calon Pemegang Polis/ Calon Tertanggung memberikan dokumen pendukung asli yang disertakan dalam Surat Permintaan Asuransi Jiwa (SPAJ) dan Surat Keterangan Kesehatan (SKK) Calon Pemegang Polis/ Calon Tertanggung atau bilamana dalam bentuk fotokopi maka fotokopi tersebut memuat data-data yang sama dengan dokumen aslinya, dan tanda-tangan yang tertera dalam Surat Permintaan Asuransi Jiwa dan Surat Keterangan Kesehatan Calon Pemegang Polis/ Calon Tertanggung dan dokumen-dokumen tersebut merupakan tanda-tangan asli dari masing-masing pihak yang berwenang.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">p.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menyerahkan Surat Permintaan Asuransi Jiwa (SPAJ) dan Surat Keterangan Kesehatan (SKK) yang telah diisi dan ditandatangani oleh Calon Pemegang Polis/ Calon Tertanggung kepada PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">q.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tunduk dan patuh terhadap seluruh strategi, Pedoman Sistem Keagenan Bisnis Ritel, ketentuan dan prosedur yang telah ditetapkan oleh PERUSAHAAN, Kode Etik Keagenan dan peraturan Asosiasi Asuransi Jiwa Indonesia (AAJI), serta perundang-undangan yang berlaku.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">r.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Berpartisipasi dalam setiap pelatihan, sosialisasi produk dan program-program kepatuhan (baik diadakan oleh PERUSAHAAN maupun pihak lain) yang ditetapkan oleh PERUSAHAAN. &nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">s.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mempertahankan dan menjaga persistensi polis sesuai dengan target yang telah ditetapkan oleh PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">t.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Dalam memberikan jasa harus didasari dengan itikad baik, jujur, berintegritas dengan memperhatikan kepentingan semua pihak.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">u.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memberikan informasi yang jelas dan benar tentang Produk, Syarat-syarat Umum Polis Pertanggungan Perorangan, premi dan ketentuan lainnya yang terkait dengan Produk tersebut kepada Calon Pemegang Polis / Calon Tertanggung.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">v.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memelihara hubungan baik antar sesama AGEN, karyawan dan antara Pemegang Polis/ Tertanggung dengan PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">w.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengumpulkan dan memberikan seluruh informasi mengenai Pemegang Polis/ Tertanggung kepada PERUSAHAAN, serta mempersiapkan dokumen dan laporan yang dibutuhkan tidak terbatas pada dokumen-dokumen sehubungan dengan pengajuan atau perubahan Polis dari Pemegang Polis/ Tertanggung.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">x.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tunduk dan patuh terhadap seluruh peraturan perundang-undangan yang berlaku dan wajib memastikan bahwa jasa dilakukan dalam cara-cara yang baik dan/atau tidak melanggar peraturan dan perundang-undangan yang berlaku di Indonesia ataupun menurut ketentuan PERUSAHAAN atau tidak merusak reputasi PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">y.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengembalikan setiap komisi yang telah diperolehnya terkait dengan pengembalian premi dari PERUSAHAAN kepada Pemegang Polis dengan alasan apapun.&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">z</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Wajib untuk mengganti segala kerugian yang diderita oleh PERUSAHAAN dan/ atau Pemegang Polis/ Tertanggung sebagai akibat dari:&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">z.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Kelalaian/ kesalahan AGEN dalam memenuhi kewajiban dan tanggung jawab AGEN sebagaimana disebut dalam ayat ini; atau</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">z.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pelanggaran yang dilakukan oleh AGEN baik disengaja ataupun tidak sebagai pelanggaran sebagaimana  yang disebutkan dalam Pasal 6 PKAJ ini</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">aa</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Segera menyerahkan kepada PERUSAHAAN seluruh harta kekayaan PERUSAHAAN yang berada dalam penguasaan AGEN dalam keadaan rapi, baik dan lengkap termasuk dokumen yang berkaitan dengan kegiatan usaha Perusahaan apabila Perjanjian ini berakhir tanpa perlu adanya permintaan terlebih dahulu oleh PERUSAHAAN.&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 5</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">TARGET AGEN</span></b></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Dalam melaksanakan 
		kewajibannya menurut ketentuan Pasal <span style="color: blue">4</span> 
		ayat (2) PKAJ ini, AGEN diberikan target berupa;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pencapaian Premi;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pencapaian Polis;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pencapaian Persistensi Polis; 
		dan</span></p>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Target lain yang 
		ditetapkan oleh PERUSAHAAN,</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">dalam kurun waktu 
		satu tahun terhitung mulai Januari s.d Desember dalam setiap tahun 
		berjalan atau dalam kurun waktu tertentu yang ditetapkan oleh PERUSAHAAN.</span></p>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Target AGEN 
		sebagaimana dimaksud dalam ayat (1) pasal ini ditetapkan PERUSAHAAN 
		dalam masing-masing Surat Penetapan Agen (SPA) dan dicantumkan dalam 
		Sistem Keagenan yang berlaku.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 6</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PROMOSI, 
		VALIDASI&nbsp; DAN DEGRADASI</span></b></td>
	</tr>
	<tr style="height: 12.75pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 12.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr style="height: 17.2pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Untuk keperluan Promosi, Validasi dan Degradasi, PERUSAHAN akan mengadakan evaluasi penilaian secara keseluruhan terhadap AGEN sebagaimana diatur dalam Pedoman Sistem Keagenan Bisnis Ritel yang berlaku.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 7</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PELANGGARAN</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Selama PKAJ ini 
		berlangsung, AGEN dilarang melakukan hal-hal sebagai <br/> berikut :</span></p>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pelanggaran Ringan</span></td>
	</tr>
	<!-- perubahan pelanggaran -->
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melaporkan hasil-hasil pekerjaannya kepada pihak yang ditunjuk oleh Perusahaan</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak memberikan pelayanan purna jual kepada Pemegang Polis.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.3</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melakukan manajemen aktivitas penjualan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.4</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melaksanakan tugas dan tanggung jawab sesuai dengan level jabatannya sebagai Agen.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.5</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melaporkan perubahan data diri agen.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pelanggaran Sedang</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melakukan perpanjangan lisensi keagenan yang sudah tidak aktif.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak menjelaskan seluruh hak dan kewajiban Calon Pemegang Polis.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.3</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melakukan pencatatan data aktivitas penjualan pada sistem aplikasi yang disediakan Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.4</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak memenuhi syarat performa, kinerja, dan/atau target produksi yang ditetapkan Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.5</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak melakukan field underwriting  terhadap Calon Pemegang Polis/Calon Tertanggung.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.6</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak ikut berpartisipasi dalam setiap pelatihan, sosialisasi produk dan program-program kepatuhan, baik yang diadakan oleh Perusahaan maupun pihak lain yang ditetapkan oleh Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.7</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak mempertahankan dan menjaga persistensi polis sesuai dengan target yang telah ditetapkan oleh Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.8</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak mengembalikan setiap komisi yang telah diperolehnya terkait dengan pengembalian premi dari Perusahaan kepada Pemegang Polis.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pelanggaran Berat</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak memberikan penjelasan tentang produk, tata cara pembayaran premi, polis, syarat-syarat umum Polis, penyelesaian klaim serta ketentuan lainnya kepada Calon Pemegang Polis/Calon Tertanggung.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memberikan penjelasan atau keterangan tentang program-program Asuransi Jiwa, Syarat-syarat Umum Polis Pertanggungan Perorangan, Premi dan Penyelesaian Klaim, serta ketentuan-ketentuan lain yang menyimpang atau bertentangan dengan ketentuan yang berlaku.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.3</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak menjaga nama baik Perusahaan dengan melakukan perbuatan-perbuatan yang tidak sesuai dengan perjanjian keagenan dan peraturan yang berlaku.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.4</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengadakan perjanjian dan/atau hubungan kerja Keagenan Asuransi baik langsung maupun tidak langsung dengan perusahaan Asuransi lain.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.5</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan pelanggaran terhadap Kode Etik Keagenan Asuransi Jiwa dan ketentuan perundang-undangan yang berlaku.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.6</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan hal-hal yang berada di luar kewenangannya sebagai Agen.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.7</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Merekomendasikan Pemegang Polis untuk membatalkan polis yang bertentangan dengan ketentuan dan atas dasar kepentingan pribadi.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.8</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Merekomendasikan dan/atau mempunyai nama fiktif yang diberikan kepada Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.9</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Membebankan premi tambahan, biaya tambahan atau memberikan potongan premi dalam bentuk apapun juga kepada Pemegang Polis.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.10</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Menerima setoran Premi secara tunai dari Calon Pemegang Polis dan/atau Pemegang Polis.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.11</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memanipulasi data, memalsukan polis/surat/dokumen dan/atau memberikan keterangan/dokumen palsu kepada Perusahaan atau kepada pihak lain baik tertulis maupun lisan, yang dapat mengakibatkan kerugian Perusahaan atau pihak lain yang terkait dengan Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.12</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memberikan informasi yang bersifat rahasia yang berkaitan dengan strategi, kebijakan, program dan produk kepada perusahaan asuransi dan/ atau pihak-pihak lain.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.13</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan pemisahan/pemecahan polis menjadi beberapa polis yang bertentangan dengan ketentuan Perusahaan yang berlaku.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.14</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengajak atau menganjurkan sesuatu yang diketahui atau patut diduga akan menimbulkan kerugian Perusahaan dan/atau Pemegang Polis.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.15</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan kegiatan bersama-sama dengan teman sejawat dan/atau orang lain di dalam maupun di luar lingkungan Perusahaan dengan tujuan untuk keuntungan pribadi, golongan atau pihak lain yang secara langsung atau tidak langsung merugikan Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.16</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengadakan perjanjian dalam bentuk apapun dan/atau memberikan janji-janji kepada pihak ketiga yang mengikat Perusahaan tanpa mendapat persetujuan terlebih dahulu dari Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.17</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Melakukan segala perbuatan yang merugikan Perusahaan baik secara materiil maupun immateriil termasuk namun tidak terbatas pada perbuatan-perbuatan penyalahgunaan uang Perusahaan dan/atau pencemaran nama baik Perusahaan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Atas pelanggaran 
		terhadap ketentuan dimaksud pada ayat (1) pasal ini,&nbsp; AGEN menyatakan
		bertanggungjawab sepenuhnya dan karenanya AGEN membebaskan PERUSAHAAN 
		dari segala tuntutan hukum baik pidana maupun perdata atau dalam bentuk
		apapun dari pihak lain,&nbsp; yang timbul sebagai akibat dari pelanggaran dimaksud
		serta bersedia untuk mengganti seluruh kerugian yang diderita PERUSAHAAN
		atas perbuatan pelanggaran dan/atau larangan yang dilakukan dan bersedia dituntut
		oleh PERUSAHAAN sesuai ketentuan hukum yang berlaku.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp; 8</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">SANKSI</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Apabila AGEN 
		terbukti melakukan salah satu pelanggaran dimaksud 
		dalam&nbsp; Pasal 7 ayat (1) PKAJ ini, maka sesuai dengan bobot 
		pelanggarannya PERUSAHAAN berhak menjatuhkan sanksi, berupa:</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Sanksi Pelanggaran Ringan terdiri dari :	</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Teguran lisan,</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Peringatan Tertulis I,</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.3</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Peringatan Tertulis II,</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.4</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Peringatan Tertulis III,</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Apabila peringatan tertulis III tidak dipatuhi, maka kepada yang bersangkutan dapat dijatuhi Sanksi Pelanggaran Sedang. </span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Sanksi Pelanggaran Sedang terdiri dari :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Penurunan level keagenan/ Degradasi.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">c.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pembekuan PKAJ, sekurang-kurangnya 1 sampai 6 bulan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Apabila setelah menjalani Sanksi Pelanggaran Sedang ternyata masih melakukan Pelanggaran yang sifatnya sama, maka yang bersangkutan dapat dijatuhi Sanksi Pelanggaran Berat.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Sanksi Pelanggaran Berat terdiri dari :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">e.1</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pembekuan PKAJ, sekurang-kurangnya 6 sampai 12 bulan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">e.2</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pemutusan PKAJ.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Sanksi sebagaimana ayat (1) Pasal ini, dapat dikenakan secara bersamaan dan/ atau tidak harus berurutan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(3)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Apabila pelanggaran yang dilakukan oleh AGEN mengandung unsur-unsur tindak pidana, 
		maka selain sanksi dimaksud dalam Pasal ini, PERUSAHAAN dapat melaporkan AGEN kepada pihak yang berwajib untuk penyelesaian melalui jalur hukum dan agen bersedia untuk mempertanggungjawabkan segala perbuatan yang sudah dilakukan terhadap PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(4)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN dapat menunda dan/ atau tidak membayarkan komisi jika AGEN menerima sanksi pelanggaran sedang dan/ atau pelanggaran berat 
		sebagaimana yang disebutkan pada Pasal 8 ayat (1) PKAJ ini</span></td>
	</tr>
	<tr style="height: 0px;border:0px solid #000;">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">Pasal 9</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PEMBEKUAN 
		SEMENTARA PKAJ</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN dapat melakukan Pembekuan Sementara PKAJ terhadap 
		hubungan kemitraan apabila AGEN terindikasi dan/ atau sedang menjalani 
		pemeriksaan internal maupun eksternal akibat perbuatan AGEN yang termasuk dalam pelanggaran sedang dan/ atau pelanggaran berat pada Pasal 7 ayat (1) dan/ atau ketentuan Hukum yang berlaku.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal AGEN dikenai Pembekuan Sementara PKAJ, maka PERUSAHAAN 
		akan mengeluarkan surat pembekuan berdasarkan ketentuan yang ditetapkan PERUSAHAAN dan segala hak-hak keagenan akan ditangguhkan.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(3)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal AGEN dinyatakan terbukti tidak bersalah, maka PERUSAHAAN akan mencabut Pembekuan Sementara PKAJ dan PERUSAHAAN akan membayarkan hak-hak AGEN yang telah ditangguhkan, sebaliknya apabila terbukti bersalah maka PERUSAHAAN berhak menjatuhkan sanksi sebagaimana disebutkan dalam Pasal 8 PKAJ</span></td>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 10</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">BERAKHIRNYA PERJANJIAN KEAGENAN</span></b></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Berakhirnya PKAJ ini :</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
		<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Secara seketika berakhir dalam hal AGEN :</span></td>
	</tr>
	<!-- penambahan -->
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(i)</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Meninggal dunia;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(ii)</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Mengundurkan diri;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(iii)</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Memperoleh putusan bersalah dari pengadilan yang telah berkekuatan hukum tetap;</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(iv)</span></td>
		<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Termasuk ke dalam daftar hitam (blacklist) PERUSAHAAN maupun AAJI karena perbuatan yang merugikan PERUSAHAAN ataupun nasabah;</span></td>
	</tr>
	<tr>
	  <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
	  <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	  <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
	  <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN dapat secara sepihak mengakhiri PKAJ, apabila AGEN melakukan salah satu pelanggaran berat yang sebagaimana tercantum pada PASAL 7 ayat (1) dan/ atau berdasarkan kebijakan dan hal-hal lainnya yang dianggap perlu dan berguna oleh PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">AGEN dapat mengakhiri PKAJ ini dengan pemberitahuan tertulis kepada PERUSAHAAN, setelah menyelesaikan segala kewajibannya dan menerima Surat Pemutusan PKAJ dari PERUSAHAAN.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(3)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Pemutusan PKAJ ini tidak membebaskan AGEN dari segala tanggung jawabnya terhadap PERUSAHAAN, termasuk segala permasalahan hukum yang mungkin timbul sebagai akibat pelanggaran terhadap PKAJ ini, oleh karenanya AGEN tetap terikat dengan segala kewajiban-kewajibannya tersebut sampai semua terpenuhi/ terselesaikan, termasuk pengembalian dokumen, data, imbal jasa, dan aset lainnya milik PERUSAHAAN baik terhadap barang bergerak dan tidak bergerak.</span></td>
	</tr>
	<tr>
		<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(4)</span></td>
		<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Apabila PERUSAHAAN bermaksud untuk mengakhiri PKAJ ini di luar sebab-sebab yang tercantum pada pasal ini, maka PERUSAHAAN akan memberitahukan secara tertulis kepada AGEN tentang maksud pemutusan tersebut dan serta merta PKAJ menjadi berakhir.</span></td>
	</tr>
	<tr style="height: 3.5pt">
		<td valign="top" style="width: 15px; height: 3.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify">
		<span lang="IN" style="font-family: Arial,sans-serif">(5)</span></td>
		<td colspan="10" valign="top" style="width: 572px; height: 3.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PARA PIHAK sepakat untuk mengesampingkan ketentuan Pasal 1266 KUHPerdata berkenaan dengan pengakhiran/ berakhirnya PKAJ ini, sehingga pengakhiran Perjanjian ini tidak memerlukan keputusan dari Pengadilan.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
		PASAL 11</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
		PENYELESAIAN PERSELISIHAN</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Apabila terjadi 
		perselisihan dalam pelaksanaan PKAJ ini, PARA PIHAK sepakat&nbsp; 
		menyelesaikan secara musyawarah untuk mencapai mufakat, namun dalam hal&nbsp; 
		tidak tercapai permufakatan dalam musyawarah tersebut, maka PARA PIHAK 
		sepakat menyerahkan perselisihan tersebut melalui pengadilan dan untuk 
		itu PARA PIHAK sepakat memilih tempat kediaman/domisili hukum yang umum 
		dan tetap di kantor Kepaniteraan Pengadilan Negeri Jakarta Pusat.</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
		PASAL 12</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
		LAMPIRAN</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Lampiran-lampiran 
		PKAJ tersebut dibawah ini merupakan bagian yang tidak terpisahkan dalam 
		PKAJ ini :</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="567" style="border-collapse: collapse; margin-left: 5.4pt">
			<tr style="height: 14.75pt">
				<td valign="top" style="width: 24px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<a name="_Hlk197755084">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				a.</span></a></td>
				<td valign="top" style="width: 126px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				Lampiran 1</span></td>
				<td valign="top" style="width: 5px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				:</span></td>
				<td valign="top" style="width: 358px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				Pakta Integritas AGEN</span></td>
			</tr>
			<tr>
				<td valign="top" style="width: 24px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				b.</span></td>
				<td valign="top" style="width: 126px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				Lampiran 2</span></td>
				<td valign="top" style="width: 5px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				:</span></td>
				<td valign="top" style="width: 358px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
				<p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif; color: black">
				Kode Etik Keagenan</span></td>
			</tr>
		</table>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 13</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">JANGKA WAKTU</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PKAJ ini mulai berlaku sejak tanggal ditandatangani oleh PARA PIHAK untuk jangka waktu yang tidak ditentukan.</span></td>
	</tr>
	<tr>
		<td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
			<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
				<span lang="IN" style="font-family: Arial,sans-serif">PKAJ ini dapat berakhir berdasarkan ketentuan-ketentuan sebagaimana ditetapkan dalam Pasal 10 PKAJ ini atau dapat berakhir berdasarkan kebijakan PERUSAHAAN.</span></td>
	</tr>
	<!-- PENAMBAHAN -->
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 14</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<b><span lang="IN" style="font-family: Arial,sans-serif">KETENTUAN PENUTUP</span></b></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
		<td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PKAJ ini menggantikan dan/ atau mengakhiri semua perikatan lainnya antara AGEN dan PERUSAHAAN yang ada sebelum ditandatanganinya PKAJ ini.</span></td>
	</tr>
	<tr>
		<td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
		<td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal terdapat perubahan terhadap PKAJ ini, maka PERUSAHAAN akan menginformasikan kepada AGEN perubahan tersebut yang diatur secara tersendiri dalam bentuk instrumen tertulis lainnya, yang merupakan satu kesatuan atau bagian yang tidak dapat dipisahkan dengan PKAJ ini.</span></td>
	</tr>
	<tr style="height:20px; border:0px solid #000;">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr>
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;<br></span></p>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;<br></span></td>
	</tr>
	<tr style="height: 23.0pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN</span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td> 
		<td width="205" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">AGEN</span></td>
	</tr>
	<tr style="height: 17.75pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">
		<img width="150" src='<?php echo 'https://jaim.jiwasraya.co.id/asset/images_qrcode/'.$row["KANCAB_QRCODE"];'' ?>' >
		<br>
		<?=$row["NAMABM"];?></span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">
		<img width="150" src='<?php echo 'https://jaim.jiwasraya.co.id/asset/images_qrcode/'.$row["AGEN_QRCODE"];'' ?>' >
		<br>
		<?=$row["NAMAKLIEN1"];?></span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif"><?=$row["JABATANBM"];?></span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Agen</span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Catatan :</span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in; text-align: justify;">
			Dokumen Elektronik ini dinyatakan sah walaupun tanpa tanda tangan basah dari Para Pihak. Validasi terhadap data dalam Dokumen Elektronik ini dapat dilakukan melalui URL pada QR Qode yang tercetak.
			Sesuai nama yang tercantum di bawahnya sebagai Para Pihak yang menyetujui atas PKAJ ini.
		</td>
	</tr>
	<!--tr style="height: 17.55pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoBodyTextIndent2" style="text-align: justify; text-indent: -.25in; line-height: normal; margin-left: .25in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">1.<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;
		</span>Untuk Kantor Cabang bermeterai (PKAJ dengan tanda tangan AGEN di atas meterai)</span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoBodyTextIndent2" style="text-align: justify; text-indent: -.25in; line-height: normal; margin-left: .25in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">2.<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;
		</span>Untuk AGEN yang bersangkutan bermaterai (PKAJ dengan tanda tangan Kepala Cabang di atas meterai)</span></td>
	</tr-->
	<tr height="0">
		<td width="29" style="border: medium none">&nbsp;</td>
		<td width="29" style="border: medium none">&nbsp;</td>
		<td width="4" style="border: medium none">&nbsp;</td>
		<td width="52" style="border: medium none">&nbsp;</td>
		<td width="80" style="border: medium none">&nbsp;</td>
		<td width="18" style="border: medium none">&nbsp;</td>
		<td width="22" style="border: medium none">&nbsp;</td>
		<td width="2" style="border: medium none"></td>
		<td width="18" style="border: medium none">&nbsp;</td>
		<td width="182" style="border: medium none">&nbsp;</td>
		<td width="205" style="border: medium none">&nbsp;</td>
	</tr>
</table>

<p class="MsoNormal"><span lang="IN">&nbsp;</span></p>
<p class="MsoNormal"><span lang="IN">&nbsp;</span></p>
<p class="MsoNormal" style="text-align: justify">
<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>

<!-- penggabungan Pakta Integritas -->
<div style='page-break-after:always'></div>

<br><br><br><br>

<table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" width="615" style="border-collapse: collapse; border: medium none">
    <tr>
        <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center"><b>
                    <span lang="FI" style="font-family: Arial,sans-serif">PAKTA INTEGRITAS</span></b></td>
    </tr>
    <tr>
        <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Saya yang tersebut di bawah ini selaku Agen PT. Asuransi Jiwasraya (Persero), menyatakan berkomitmen untuk:</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">1</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Melaksanakan tugas dan kewajiban secara jujur, profesional serta memegang teguh prinsip-prinsip Good Corporate Governance (GCG) yang meliputi Transparency, Accountability, Responsibility, Independency dan Fairness demi kemajuan Perusahaan.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">2</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Tidak akan melakukan Korupsi, Kolusi dan Nepotisme (KKN) serta tidak akan memberi dan/ atau menerima sesuatu dalam bentuk apapun berupa suap baik secara langsung maupun tidak langsung.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">3</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Tidak akan menyalahgunakan kewenangan jabatan, baik secara langsung maupun tidak langsung untuk kepentingan pribadi, kelompok maupun golongan tertentu.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">4</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Menjaga nama baik, martabat  dan kehormatan Perusahaan serta menghindarkan diri dari perbuatan tercela.</span></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">5</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Mematuhi dan tunduk pada ketentuan sebagaimana diatur dalam Perjanjian Keagenan, termasuk dalam melaksanakan seluruh hak dan kewajibanya.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">6</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Tidak  melakukan aktivitas penjualan  dengan cara melakukan Churning,Twisting dan Rabating yang akan mengakibatkan kerugian terhadap Perusahaan dan Nasabah.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">7</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Dalam melakukan Aktivitas penjualan tidak menerima titipan premi/produksi atau menitipkan premi/Produksi dari/kepada siapapun yang mempunyai kepentingan sehingga mengakibatkan kerugian bagi Perusahaan maupun orang lain dan apabila dikemudian hari diketahui adanya aktivitas titipan premi/produksi atau menitipkan premi/Produksi tersebut maka  bersedia ditindak berupa pemberhentian tidak hormat dari Perusahaan.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">8</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Tidak  menerima pembayaran premi dari Nasabah baik itu premi pertama maupun premi lanjutan dan apabila dikemudian hari diketahui menerima pembayaran premi dari Nasabah ,bersedia ditindak berupa pemberhentian tidak hormat dari Perusahaan.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">9</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Selalu melaksanakan tugas dengan penuh tanggung jawab, semangat kerja yang tinggi, berbagi ilmu <i>(sharing knowlegde)</i> serta siap membantu rekan ataupun unit kerja lain demi kemajuan Perusahaan.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">10</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Menjaga kerahasiaan semua data,  informasi dan  dokumen  Perusahaan yang bersifat confidential kepada pihak-pihak yang tidak berkepentingan.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">11</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak  akan  memberi/  membuat  janji  kepada  siapa  pun  juga  yang  terkait  dengan  jabatan  dan kedudukan di Perusahaan dimana pemberian serta janji tersebut bertentangan dengan ketentuan Perusahaan.
</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">12</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Tidak akan menerima/ meminta/ memaksa seseorang untuk memberikan hadiah, upeti atau gratifikasi apapun yang patut diduga terkait dengan jabatan yang diemban dan dapat mempengaruhi kewajiban serta integritas dalam pelaksanaan tugas.
</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">13</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Tidak memberikan janji atau komitmen baik yang bersifat material seperti berupa cash back, kick back, fee, pengembalian komisi dan sebagainya maupun imaterial seperti kedudukan, jabatan, posisi dan lain sebagainya terutama kepada nasabah atau calon nasabah yang tidak sesuai dengan ketentuan/ norma yang berlaku di Perusahaan.</span></td>
    </tr>
    <tr>
        <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"><span class="style1">14</span></td>
        <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                <span lang="IN" style="font-family: Arial,sans-serif">Mematuhi segala ketentuan yang berlaku di Perusahaan.</span></td>
    </tr>
    <tr>
        <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Demikian pernyataan ini saya tandatangani dengan penuh kesadaran, tanggung jawab serta tidak ada paksaan dari pihak manapun. Apabila saya melanggar Pakta Integritas ini, saya bersedia dikenakan sanksi sesuai dengan peraturan yang berlaku.
        <br/><br/>
        Semoga Tuhan Yang Maha Esa senantiasa memberikan perlindungan kepada kita semua untuk melaksanakan pakta integritas ini.
</span></td>
    </tr>
    <tr>
        <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
            <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">
</span><br/><br/><br/></td>
    </tr>

<tr style="height: 23.0pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif"></span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif"><?=$row["TGL"]." ".$nama_bulan[date("n", $x)]." ".$row["THN"];?></span></td>
	</tr>
	<tr style="height: 17.75pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">
		<br></span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">
		<img width="150" src='<?php echo 'https://jaim.jiwasraya.co.id/asset/images_qrcode/'.$row["AGEN_QRCODE"];'' ?>' >
		<br>
		<?=$row["NAMAKLIEN1"];?></span></td>
	</tr>
	<tr style="height: 17.55pt">
		<td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif"></span></td>
		<td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
		<td width="205" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
		<span lang="IN" style="font-family: Arial,sans-serif">Agen</span></td>
	</tr>
</table>
<p class="MsoNormal"><span lang="IN">&nbsp;</span></p>
<p class="MsoNormal"><span lang="IN">&nbsp;</span></p>
<p class="MsoNormal" style="text-align: justify">
    <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>

</body>

</html>
