<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  
	$DB=New database($userid, $passwd, $DBName);	
  $today=date("d F Y"); 

$sql="select ". 
          "a.notertanggung,substr(a.kdproduk,1,3) as kdproduk, ".
					"b.namaklien1,".
					"decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk, a.nopolbaru ".
		 "from ".
		      "$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_100_klien b ".
     "where ".
		      "b.noklien=a.notertanggung and ". 
		      "a.prefixpertanggungan='$kantor' and a.nopertanggungan='$noproposal'";
$DB->parse($sql);
$DB->execute();
$ttg=$DB->nextrow();
$noklien=$ttg["NOTERTANGGUNG"];
$namaklien=$ttg["NAMAKLIEN1"];
$kproduk=$ttg["KDPRODUK"];
?>
<html>
<head>
<title>Data Kesehatan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<div align="center">
<form name="penyakit" method="post" action=<? echo $PHP_SELF; ?>>
<input type="hidden" name="noklien" value=<? echo $noklien; ?>>
<table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td width="16%" colspan="2" class="arial10">Nomor Proposal</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><!--?echo $kantor." - ".$noproposal;?--><?=$ttg['NOPOLBARU']?></td><br>
				  <td width="53%" colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><?echo $today;?></td>
        	<td width="53%" colspan="3" class="verdana8" align="center">Beri Tanda V Pada Kolom Yang Sesuai.</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tertanggung</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb" align="left">
					<?	
					 echo $namaklien;
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $PER->notertanggung." - ".$KLIEN->nama; 
					?></td>
          <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>
        <tr>
          <td width="16%" colspan="2" class="arial10">Jenis Kelamin</td>
					<td width="1%"class="arial10" align="center">:</td>
          <td width="30%"class="verdana10blkb" align="left">
					<?	
					 echo $ttg["NAMAJK"];
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $KLIEN->namajk; 
					?></td>
         <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>				
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">R I W A Y A T&nbsp;&nbsp;&nbsp;&nbsp;K E S E H A T A N&nbsp;&nbsp;&nbsp;&nbsp;T E R T A N G G U N G</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Riwayat Kesehatan Tertanggung Telah Diisi.</td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr class="hijao">
					<td width="4%" align="right">No.</td>
					<td width="5%" align="center">Kode</td>
					<td width="18%" align="left">Nama Penyakit</td>
					<td width="1%" align="center"></td>
					<td width="5%" align="center">Ket.</td>
					<td width="29%" align="left" >Nama Dokter</td>
					<td width="32%" align="left">Alamat Dokter</td>
					<td width="6" align="center">Hapus</td>
				</tr>
      <?
      $sql="select a.kodepenyakit, a.namapenyakit, b.kdstatussakit, b.namadokter, b.alamatdokter, ".
           "decode(b.kdstatussakit,'Y','Ya','N','Tidak') statussakit,b.namapenyakitlain ".
      		 "from $DBUser.tabel_999_jenis_penyakit a, $DBUser.tabel_118_klien_penyakit b ".
      		 "where a.kodepenyakit=b.kodepenyakit(+) and b.noklien(+)='$noklien' ".
      		 "order by a.kodepenyakit";
			 //echo $sql;
      $DB->parse ($sql);
      $DB->execute();
      $i=1;
      while ($arr=$DB->nextrow()) {
      	if ($arr["KDSTATUSSAKIT"]=='Y') {
      		include "../../includes/belang.php";
      		echo "<td width=\"4%\" class=\"arial10\" align=\"right\">".$i.".</td>";
      		echo "<td width=\"5%\" class=\"ver8ungu\" align=\"center\">".$arr["KODEPENYAKIT"]."</td>";
      		echo "<td width=\"18%\" class=\"ver8ungu\" align=\"left\">".$arr["NAMAPENYAKIT"]." <br />".($arr["KODEPENYAKIT"]==99 ? "<i>(".$arr["NAMAPENYAKITLAIN"].")</i>" : "")."</td>";
      		echo "<td width=\"1%\" class=\"ver8ungu\" align=\"center\">:</td>";
      		echo "<td width=\"5%\" class=\"arial8ab\" align=\"center\">".$arr["STATUSSAKIT"]."</td>";
      		echo "<td width=\"29%\" class=\"ver8ungu\" align=\"left\">".$arr["NAMADOKTER"]."</td>";
      		echo "<td width=\"32%\" class=\"ver8ungu\" align=\"left\">".$arr["ALAMATDOKTER"]."</td>";
      		echo "<td width=\"6%\" align=\"center\" class=\"arial8\"><b><a href=# onclick=\"window.open('hapuspenyakit.php?p=$noproposal&noklien=$noklien&kodepenyakit=".$arr["KODEPENYAKIT"]."','hapus','width=650,height=400,top=100,left=100')\">Hapus</a></td>";
      		echo "</tr>";
      	$i++;
      	}
      }
      echo "<tr><td colspan=\"8\" class=\"arial10blue\" align=\"right\"></td></tr>";
      $i=$i-1;
      if ($i==0) {
      	echo "<tr><td colspan=\"8\" class=\"arial10blue\" align=\"center\">Tidak Ada Penyakit, Tertanggung Sehat Jasmani!</td></tr>";
      }	else {
      	echo "<tr><td colspan=\"8\" class=\"arial10blue\" align=\"center\">Tertanggung Pernah Menderita $i Jenis Penyakit!!!</td></tr>";
      }
      ?>
			</table><br>
    </td>
  </tr>
</table><br>
<table width="700" border="0">
	<tr>
	  <td align="left" class="arial10"><a href="#" onClick="window.history.go(-1)">Back</a></td>
		<? 
		if($kproduk=="JL2" || $kproduk=="JL3")
		{
		echo "<td align=\"right\" class=\"arial10\"><a href=\"skk3_unitlink.php?noproposal=$noproposal&noklien=$noklien&tglmutasi=$tglmutasi&jnscari=".$jnscari."\">Next</a></td>";
		} else {
		echo "<td align=\"right\" class=\"arial10\"><a href=\"skk4a.php?noproposal=$noproposal&noklien=$noklien&tglmutasi=$tglmutasi&jnscari=".$jnscari."\">Next</a></td>";
		}
		?>
	</tr>
</table>
</form>
</body>
</html>
