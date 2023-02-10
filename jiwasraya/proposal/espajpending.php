<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	$DB = New database($userid, $passwd, $DBName);
	
	if ($submit) {
		$sql = "UPDATE $DBUser.tabel_spaj_online SET suspend = 1, keterangan = '$keterangan', tanggalupdate = sysdate, userupdate = user 
				WHERE nospaj = '$nospaj'";
		$DB->parse($sql);
		$DB->execute();
		
		echo "<script>window.opener.location.reload();window.close();</script>";
	} else if ($unflag) {
		$sql = "UPDATE $DBUser.tabel_spaj_online SET suspend = null, keterangan = null, tanggalupdate = sysdate, userupdate = user 
				WHERE nospaj = '$nospaj'";
		$DB->parse($sql);
		$DB->execute();
		
		echo "<script>window.opener.location.reload();window.close();</script>";
	}
	
	$sql = "SELECT keterangan FROM $DBUser.tabel_spaj_online WHERE nospaj = '$nospaj'";
	$DB->parse($sql);
	$DB->execute();
	$r = $DB->nextrow();
?>

<html>
<head>
    <title>Pending ESPAJ No <?=$nospaj?></title>
</head>
<body>
	<form name="xxx" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
		<input type="hidden" name="nospaj" value="<?=$nospaj?>" />
		<table border="0" width="100%" cellspacing="0" cellpadding="6" style='border:1px solid #006699; font-family: verdana; font-size: 12px'>
			<tr>
				<td align="center" bgcolor="#627EB5" colspan="2">
					<font color="#fff"><b>ALASAN ESPAJ NO <?=$nospaj?> DI PENDING</b></font>
				</td>
			</tr>
			
			<tr>
				<td bgcolor="#DAE2EF" colspan="2">
					<textarea name="keterangan" style="width:100%;height:200px;" maxlength="250" placeholder="Maksimal 250 karakter"><?=$r['KETERANGAN']?></textarea>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#E4E4E4" colspan="2">
					<input type="submit" value="SIMPAN PENDING" name="submit" style="font-size: 8pt; font-family: Verdana">
					<input type="submit" value="PENDING TERSELESAIKAN" name="unflag" style="font-size: 8pt; font-family: Verdana">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>