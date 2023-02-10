<script language="JavaScript" type="text/javascript">
function OK(){
 window.opener.document.ntryprop.mulas.focus();
 window.self.close();
}

function notOK(v_ket){
  var tb=confirm("Untuk Non-Medical, tinggi/berat tertanggung sesuai kriteria BMI adalah "+v_ket+".\n Setuju untuk masuk Medical ?");
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
ss
<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
  include "../../includes/constant.php";
	$DB=New database($userid, $passwd, $DBName);

	$sql="SELECT   jeniskelamin,
         tinggibadan,
         beratbadan,
         beratbadan / POWER (tinggibadan / 100, 2) bmi,
         KDSTATUSMEDICAL,KATEGORI,
		 nvl((select jmlrokok from $DBUser.TABEL_118_PERIKSA_PENYAKIT where noklien=a.noklien),0) ROKOK
  FROM   $DBUser.tabel_100_klien A, $DBUser.TABEL_226_BMI B
 WHERE   noklien ='$noklien'
         AND beratbadan / POWER (tinggibadan / 100, 2) BETWEEN BATASBAWAH
                                                           AND  BATASATAS";
	//echo $sql;
			   
	$DB->parse($sql);
	$DB->execute();
	$arx=$DB->nextrow();
	$tinggi=$arx["TINGGIBADAN"];
	$berat=$arx["BERATBADAN"];
	$jk=$arx["JENISKELAMIN"];
	$stsmd=$arx["KDSTATUSMEDICAL"];
	$rokok=$arx["ROKOK"];
	//echo $stsmd;
?>
<html style="background-color: #a4eef7;">
<head>
<title>Cek Tinggi/Berat</title>
<?

if($stsmd=="M") {
		print( "<body onload=\"javascript:notOK('".$arx["KATEGORI"]."');\">" );
	}	else {
		  if($rokok>=8) {
			print( "<body onload=\"javascript:notOKRokok();\">" );
		}	else {
		  print( "<body onload=\"javascript:OK();\">" );
		}
	}	

	
/*	
if($stsmd=="M")
				{
				//echo $sql.$nilai.'--'.$prmmaxallow;
				echo "<body onload=\"javascript:document.ntryprop.buton.disabled=false;javascript:window.opener.document.ntryprop.kdstatusmedical[0].checked;\">";
				echo "<br /><h3>Body Mass Index</h3>termasuk dalam kategori ".$arx["KATEGORI"].", sehingga Proposal dalam status MEDICAL";
				printf("<br><a href=\"#\" onclick=\"javascript:document.ntryprop.kdstatusmedical[0].checked==true;window.close()\">Close</a>");
				die;
				}*/
?>
<p><b><font color="#800000">Tunggu,</font> <br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
</body>
</html>