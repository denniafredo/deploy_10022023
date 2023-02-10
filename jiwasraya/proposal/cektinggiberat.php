<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
  include "../../includes/constant.php";
	$DB=New database($userid, $passwd, $DBName);

	$sql="select jeniskelamin, tinggibadan, beratbadan from $DBUser.tabel_100_klien ".
	     "where noklien='$noklien'";
	//echo $sql;		   
	$DB->parse($sql);
	$DB->execute();
	$arx=$DB->nextrow();
	$tinggi=$arx["TINGGIBADAN"];
	$berat=$arx["BERATBADAN"];
	$jk=$arx["JENISKELAMIN"];
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
			 window.opener.location.replace('ntryprop.php');
			 window.close();
		}
		
  }
  window.self.close();
}
</script>
</head>
<?
	switch ($jk){
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
	}			 				 
?>
<p><b><font color="#800000">Tunggu,</font> <br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
</body>
</html>