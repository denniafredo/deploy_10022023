<?
$DB=new database($userid, $passwd, $DBName);	

if (!session_is_registered(batch) || $batch=="") {
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Batch Belum diinisialisasi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align="center">
<table width="800">
  <tr>
  	<td colspan="2" width="100%" class="verdana9barak" align="center">Batch Belum DiInisialisasi, Silakan Diinisialisasi Terlebih dahulu Jika Saudara adalah Pegawai Entry Aplikasi</td>
	</tr>
  <tr>
  	<td colspan="2" width="100%" align="center"><hr size="1"></td>
	</tr>	
	<tr>
    <td width="50%" class="arial10" align="left"><a href="mnuacc.php">Back</a></td>
		<td width="50%" class="arial10" align="right"><a href="mnuacc.php">Menu Akunting</a></td>
	</tr>
</table>
</body>
</html>
<?	
	exit;
	}
	
?>