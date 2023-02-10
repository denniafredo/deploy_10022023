<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB = new database($userid, $passwd, $DBName);
  $prefixagen = $kantor;
	/*
	$sql= "select a.noagen,a.prefixagen,a.kdpangkat,a.kdkelasagen,a.kdjenjangagen,a.kdstatusagen, ".
	        "a.kdunitproduksi,a.noskagen,to_char(a.tglskagen,'DD/MM/YYYY') tglskagen,".
					"a.norekening,a.namabank,a.tglrekam,a.userrekam, a.tglupdated,a.userupdated,a.kdkantor,".
					"b.namaklien1,b.alamattetap01,b.phonetetap01,b.gelar,c.namajenjangagen from $DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b,".
					"$DBUser.tabel_407_kode_jenjang_agen c where ".
					"a.noagen=b.noklien and a.noagen='$noagen' and a.kdjenjangagen=c.kdjenjangagen";
			 $DB->parse($sql);
	     $DB->execute();
	     $arc=$DB->nextrow();	 
			 $noagen = $arc["NOAGEN"];
			 $namaagen = $arc["NAMAKLIEN1"];
		   $gelar = $arc["GELAR"];
			 if ($gelar == ""){
			 header("Location: http://202.159.65.94/jiwasraya/klien/cetakkartuagen.php?noagen=$noagen&isigelar=tidak");
			 } else {
*/
?>	

<link href="../jws.css" rel="stylesheet" type="text/css">
<div align="center">
<center>
<br><br>
<form name="entry" action="sendmailmedical.php" method="POST">
<table border="0" width="300" cellspacing="1">
  <tr>
		<td class="verdana9blk" align="center">Nomor :&nbsp; <? echo $prefixpertanggungan." - ".$nopertanggungan; ?><br><br></td>
	</tr>
	<tr>
		<td class="verdana9blk" align="center">Telah menyatakan :</td>
	</tr>
	<tr>	
		<td class="verdana9blk" align="center">
			<input type="radio" value="Menerima" checked name="ubahpremi">Menerima&nbsp;&nbsp;&nbsp;
			<input type="radio" value="Tidak Menerima" name="ubahpremi"> Tidak Menerima</td>
	</tr>
	<tr>
		<td class="verdana9blk" align="center">ketentuan perubahan premi.</td>
	</tr>
	<tr>
		<td class="verdana9blk" align="center"><br>
			<input type="hidden" name="nopertanggungan" value=<? echo $nopertanggungan; ?>>
			<input type="hidden" name="kdstatusmedical" value=<? echo $kdstatusmedical; ?>>
			<input type="submit" value="LANJUT" name="kirim"></td>
	</tr>
</table>
</form>
<?
//echo "<font face=\"Verdana\" size=\"2\"><a href=\"#\" onclick=\"NewWindow('cetakkartuagen.php?noagen=$noagen','cetak','690','280','yes');return true;\">CETAK KARTU</a>";
?>
</center>
</div>
<?// }
?>
