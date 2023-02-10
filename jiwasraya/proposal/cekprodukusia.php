<html style="background-color: #a4eef7;">
<head>
<title>Cek Produk Usia</title>
<script language="JavaScript" type="text/javascript">

function OK(){window.self.close();}
function notOK(){
  var tb=confirm("Usia tertanggung tidak sesuai kriteria.\n Setuju untuk masuk Medical ?");
  if (tb==true){
    window.opener.document.ntryprop.kdstatusmedical[0].checked=true;
  } else {
    if (confirm("Pilih Tertanggung Lain ?")) {
     window.opener.document.ntryprop.notertanggung.value='';
     window.opener.document.ntryprop.notertanggung.focus();
		} 
  }
  window.self.close();
}
</script>
</head>
<?
	if($usiapert > 60 && $cbr!="X") {
		print( "<body onload=\"javascript:notOK();\">" );
	}	else {
	  print( "<body onload=\"javascript:OK();\">" );
	}			 				 
?>
<p><b><font color="#800000">Tunggu,</font> <br>
<font color="#0000FF">Sedang Proses ...</font></b></p>
</body>
</html>
