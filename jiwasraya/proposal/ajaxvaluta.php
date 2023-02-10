<?php
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DB=New Database($userid, $passwd, $DBName);
		
	$sql = "SELECT a.kdvaluta, b.namavaluta
			FROM $DBUser.tabel_234_produk_valuta a
			INNER JOIN $DBUser.tabel_304_valuta b ON a.kdvaluta = b.kdvaluta
			WHERE kdproduk = '$kdproduk'";
	$DB->parse($sql);
	$DB->execute();
	
	echo "<option value=''>-- Silahkan Pilih --</option>";
	while ($r = $DB->nextrow()) {
		echo "<option value='$r[KDVALUTA]'>$r[NAMAVALUTA]</option>";
	}
?>