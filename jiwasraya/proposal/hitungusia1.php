<?
	include "../../includes/database.php";
	include "../../includes/session.php";
	include "../../includes/klien.php";
	
	$DB = New database($userid, $passwd, $DBName);
	$KL = New Klien ($userid,$passwd,$c);
	
	$sql = "select kdproduk from $DBUser.tabel_202_produk 
			where namaproduk like 'ANUITAS%' 
				or namaproduk like '%ANNUITY%'
				or namaproduk like 'ARTHA DANA%' 
				or namaproduk like 'SIHARTA%' 
				or kdproduk='PIN'
				or kdproduk='JSAA'
				or kdproduk='JSHAA'
				or kdproduk='AJSAN'";
				
	$DB->parse($sql);
	$DB->execute();
	$prod = array();
	
	while ($arr=$DB->nextrow()) {
		array_push($prod,$arr["KDPRODUK"]);
	}
	
	$sql = "SELECT TRUNC(MONTHS_BETWEEN(TO_DATE('$a', 'dd/mm/yyyy'), TGLLAHIR)/12) USIA_TH,
				TRUNC(MOD(MONTHS_BETWEEN(TO_DATE('$a', 'dd/mm/yyyy'), TGLLAHIR), 12)) USIA_BLN
			FROM $DBUser.TABEL_100_KLIEN
			WHERE NOKLIEN = '$c'";
	$DB->parse($sql);
	$DB->execute();
	$kln = $DB->nextrow();
	//$usia=$KL->Umur($a);
	$usia = $kln['USIA_TH'];
	if (in_array($prd, $prod)) {
		//$usiabl=$KL->UmurBl($a);
		$usiabl = $kln['USIA_BLN'];
	} 
	else {
		$usiabl=0;
	}

	/*	
	$sql = "select min(usia) minim, max(usia) maksi ".
			   "from $DBUser.tabel_205_tarip_premi ".
			   "where kdproduk='$prd' group by kdproduk";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$minim=(int)$arr["MINIM"];			 
	$maksi=(int)$arr["MAKSI"];
	*/
	
	$sql = "select lama_min,decode(kdproduk,'PIN',1,'AIP',1,'AEP',1,'ASP',1,'ASI',1,
				'ASIB',1,'ASPB',1,'AI0',1,'PAA',1,'PAB',1,'ASPBNI',1,'ASIBNI',1,
				'AI0BNI',1,'AJSAN',1,variabel-".$usia.") variabel, namaproduk
			from $DBUser.tabel_202_produk 
			where kdproduk='$prd'";
	//echo $sql;
	//die;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	if ($cb=='E') {
		$var=5;
	} 
	else if ($cb=='J') {
		$var=10;
	} 
	else {
		$var=((int)$arr["VARIABEL"]<=0) ? $arr["LAMA_MIN"] : (int)$arr["VARIABEL"] ;			 
	}
?>
<html>
<title>Perhitungan Usia</title>
<!--
<p align="center"><b><font color="#800000">Tunggu,</font><br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
-->
	<?	
	if ($usia < 0 or $usia > 200){
		echo "<font face=Verdana size=1>Tanggal Lahir ".$KL->tgllahir." dan tanggal mulai asuransi ".$a.". Usia = ";
		echo $usia." tahun</font>";
		echo "<br>";
		echo "<p align=\"center\"><font face=Verdana size=2><strong>Kesalahan !!!</strong></p></font>";
		echo "Periksa Tanggal Lahir Klien atau Masukkan Tahun yang benar";
		printf("<br><a href=\"#\" onclick=\"javascript:window.close()\">Back</a>");
	} else {
		// pengecualian usia produk AIP
		if($prd=="AIP") {
			
			if(($usia > 60) || ($usia==60 && $usiabl > 0)) {
				echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value=''\">";
				echo "<font color=red>Khusus Produk ANUITAS IDEAL PRIMA (AIP) usia tidak boleh melebihi 60 tahun!<br> ";
				echo "Usia Tertanggungan berdasarkan mulai asuransi yang Anda masukkan adalah $usia tahun $usiabl bulan.<br><br>";
				echo "Masukkan tanggal mulai asuransi yang sesuai atau ganti dengan tertanggung/produk lain.</font><br><br>";
				printf("<a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.mulas.value='';".
						"window.opener.document.ntryprop.mulas.focus();".
						"window.opener.document.ntryprop.usia_th.value='';".
						"window.opener.document.ntryprop.usia_bl.value='';".
						"window.close()\">TUTUP</a>");
			} 
			else {
				printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".
						"window.opener.document.ntryprop.usia_bl.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.focus();".
						//"window.close();".
						"\" >",$usia,$usiabl,$var);
						//echo "test1";
			}
		}
		else if ($prd == "AJSDMP" || $prd == "AJSPP") {
			if($usia < 20) {
				echo "<body onload=\"javascript:window.opener.document.ntryprop.mulas.value=''\">";
				echo "<font color=red>Khusus Produk $arr[NAMAPRODUK] ($prd) usia tidak boleh kurang dari 20 tahun!<br> ";
				echo "Usia Tertanggungan berdasarkan mulai asuransi yang Anda masukkan adalah $usia tahun $usiabl bulan.<br><br>";
				echo "Masukkan tanggal mulai asuransi yang sesuai atau ganti dengan tertanggung/produk lain.</font><br><br>";
				printf("<a href=\"#\" onclick=\"javascript:window.opener.document.ntryprop.mulas.value='';".
						"window.opener.document.ntryprop.mulas.focus();".
						"window.opener.document.ntryprop.usia_th.value='';".
						"window.opener.document.ntryprop.usia_bl.value='';".
						"window.close()\">TUTUP</a>");
				exit;
			} else {
				printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".
						"window.opener.document.ntryprop.usia_bl.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.focus();".
						"window.close();".
						"\" >",$usia,$usiabl,$var);
			}
		}
		else {
			//if ($usia<=$maksi && $usia>=$minim) {
			if((substr($prd,0,2)=="AD") || $prd=="HTT") {
				printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".
						"window.opener.document.ntryprop.usia_bl.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th_default.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.focus();".
						"window.close();".
						"\" >",$usia,$usiabl,$var,$var); //$usia
			}
			if(substr($prd,0,4)=="JSR1" || substr($prd,0,4)=="JSR2" || substr($prd,0,4)=="JSR3") //Oleh Dedi 8/7/2011
			{
				echo 'kampret';
				//die;
   				printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".
						"window.opener.document.ntryprop.usia_bl.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.value='5';".
						"window.opener.document.ntryprop.lamapembpremi_th_default.value='5';".
						"window.opener.document.ntryprop.lamapembpremi_th.focus();".
						"window.close();".
						"\" >",$usia,$usiabl,$var,$var);
   			}
			else {
				printf("<body onload=\"javascript:window.opener.document.ntryprop.usia_th.value='%s';".
						"window.opener.document.ntryprop.usia_bl.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.value='%s';".
						"window.opener.document.ntryprop.lamapembpremi_th.focus();".
						"window.close();".
						"\" >",$usia,$usiabl,$var);
				//var_dump($_GET);
			}
		}
		
		/*
	 	} else {
			print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
			print( "<!--\n" );
			print( "alert('Usia Tertanggung=$usia tahun, $usiabl bulan berada diluar batas $minim - $maksi\\nPremi / JUA Tidak Akan Dapat Dihitung')\n" );
			print( "//-->\n" );
			print( "</script>" );
		}
		*/
	}
?>
</body>
</html>