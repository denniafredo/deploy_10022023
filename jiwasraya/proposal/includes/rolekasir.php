<?
//echo "Test modul : ".$modul."<br />"; 
if ($modul=='2KE'|| $modul=='2KU'|| $modul=='0KE'|| $modul=='SPI' || $modul=='2AL' || $modul=='ALL' || $modul=='ITC') {
} else {
?>
<table width="100%">
  <tr>
    <td width="100%" colspan="2"><font face="Verdana" size="2" color="red"><b>Hanya Untuk Pengguna Kasir Uang, Anda Tidak Diperkenankan Mengakses Halaman Ini</td>
	</tr>
	 <tr>
    <td width="50%"><font face="Verdana" size="2"><a href="#" onclick="javascript:history.go(-1)">Back</a></td>
		<td width="50%" align="right"><a href="../mnuutama.php"><font face="Verdana" size="2">Menu Utama</a></td>
	</tr>
</table>
<? exit; }
?>