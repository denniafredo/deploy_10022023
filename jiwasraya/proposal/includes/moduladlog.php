<?  
//echo $modul;
  if($modul=='2AL'||$modul=='ALL'||$modul=='ITC') {
	} else {
	  echo "Hanya User Administrasi dan Logistik / Kasir Yang Berhak Mengakses Halaman Ini!<br>";
		echo "<a href=\"#\" onclick=\"parent.location.replace('../index.php')\"><b>Login User Lain</b></a><br>";
	  echo "<a href=\"#\" onclick=\"parent.location.replace('../x_jos.php')\"><b>Halaman Utama</b></a><br>";
	  exit;
	}
?>
