<?  
  include "./includes/database.php";
  include "./includes/session.php";
  include "./includes/constant.php";
	$DB=New database($userid, $passwd, $DBName);

	// query lama, diperbaiki fendy 05/07/2018 request dari mbak maria
	/*$sql="select jeniskelamin, tinggibadan, beratbadan from $DBUser.tabel_100_klien ".
	     "where noklien='$noklien'";*/
	$sql = "SELECT jeniskelamin, tinggibadan, beratbadan, beratbadan / POWER (tinggibadan / 100, 2) bmi,
				KDSTATUSMEDICAL,KATEGORI, 
				nvl((select jmlrokok from $DBUser.TABEL_118_PERIKSA_PENYAKIT where noklien=a.noklien),0) ROKOK
			FROM $DBUser.tabel_100_klien A, 
				$DBUser.TABEL_226_BMI B
			WHERE noklien ='$noklien'
				AND beratbadan / POWER (tinggibadan / 100, 2) BETWEEN BATASBAWAH AND BATASATAS";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arx=$DB->nextrow();
	$tinggi=$arx["TINGGIBADAN"];
	$berat=$arx["BERATBADAN"];
	$jk=$arx["JENISKELAMIN"];
	$stsmd=$arx["KDSTATUSMEDICAL"];
	$rokok=$arx["ROKOK"];
	//echo $tinggi.$berat;
?>
<html style="background-color: #a4eef7;">
<head>
<title>Cek Tinggi/Berat</title>
<script language="JavaScript" type="text/javascript">
function OK(){
 window.opener.document.ntryprop.mulas.focus();
 window.self.close();
}

function notOK(){
  var tb=confirm("Untuk Non-Medical, tinggi/berat tertanggung tidak sesuai kriteria.\n Setuju untuk masuk Medical ?");
  if (tb==true){
    window.opener.document.ntryprop.kdstatusmedical[0].checked=true;
  } else {
    
    if (confirm("Pilih Tertanggung Lain ?")) {
       window.opener.document.ntryprop.notertanggung.value='';
       window.opener.document.ntryprop.notertanggung.focus();
		} else {
		   alert("Proposal tidak dapat dilanjutkan");
			 window.opener.location.replace('ntryprop_ulink.php');
			 window.close();
		}
		
  }
  window.self.close();
}

function notOKRokok(){
	var tb=confirm("Calon Tertanggung merokok lebih dari 8 batang per hari.\n Setuju untuk masuk Medical ?");
	if (tb==true){
		window.opener.document.ntryprop.kdstatusmedical[0].checked=true;
	} else {

		if (confirm("Pilih Tertanggung Lain ?")) {
			window.opener.document.ntryprop.notertanggung.value='';
			window.opener.document.ntryprop.notertanggung.focus();
		} else {
			alert("Proposal tidak dapat dilanjutkan");
			window.opener.location.replace('ntryprop.php');
			window.close();
		}

	}
	window.self.close();
}
</script>
</head>
<?
	// karena ikut query lama, diperbaiki fendy 05/07/2018 request dari mbak maria dengan query yang baru
	/*switch ($jk){
		case 'L': 
		 	$a=$tinggi-TINGGI_L;
		  break;
		case 'P': 
		 	$a=$tinggi-TINGGI_P;
		  break;			  
	}
	
	if ($a==0){$a=1;}			
	$res=round($berat*100/$a,2);
	if ($res < 90 || $res >110){
		print( "<body onload=\"javascript:notOK();\">" );
	}	else {
	  print( "<body onload=\"javascript:OK();\">" );
	}		*/

	if($stsmd=="M") {
		print( "<body onload=\"javascript:notOK('".$arx["KATEGORI"]."');\">" );
	}	else {
		if($rokok>=8) {
			print( "<body onload=\"javascript:notOKRokok();\">" );
		}	else {
			print( "<body onload=\"javascript:OK();\">" );
		}
	}
?>
<p><b><font color="#800000">Tunggu,</font> <br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
<br><?php /*echo "JK : $jk<br> tinggi : $tinggi<br> TINGGI_L :".TINGGI_L."<br> TINGGI_L : ".TINGGI_P;
echo "<br>berat : $berat * 100 / a";
*/?>
</body>
</html>