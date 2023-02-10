<?php
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/session.php";
	$DB=New Database($userid, $passwd, $DBName);
		
	$sql = "SELECT a.kdcarabayar, namacarabayar
			FROM $DBUser.tabel_233_produk_cara_bayar a
			INNER JOIN $DBUser.tabel_305_cara_bayar b ON a.kdcarabayar = b.kdcarabayar
			WHERE kdproduk = '$kdproduk'";
	$DB->parse($sql);
	$DB->execute();
	
	echo "<option value=''>-- Silahkan Pilih --</option>";
	while ($r = $DB->nextrow()) {
		echo "<option value='$r[KDCARABAYAR]'>$r[NAMACARABAYAR]</option>";
	}
?>