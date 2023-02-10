<? 
   include "../../includes/database.php";
   include "../../includes/session.php";
   include "../../includes/common.php";

if ($cari){
	switch ($mutasi)
	{
		case "blank":
      header("location:http://$HTTP_HOST/$KAMP/pelaporan/blank.php");
			break;
		case "popkantor":
      header("location:http://$HTTP_HOST/$KAMP/pelaporan/blank.php");
			break;
		case "popagen":
      header("location:http://$HTTP_HOST/$KAMP/mutasi/chalmpempol.php?nopert=$nopertanggungan&prefix=$prefix");
			break;			
		case "poppenagih":
      header("location:http://$HTTP_HOST/$KAMP/mutasi/updateahliwaris.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$kantor&tjenis=I");
			break;
	}
}
?>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script LANGUAGE="JavaScript">
var win= null;
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}

function GantiJenisPemb() {
var mutan = document.peliharapolis.mutasi.value
NewWindow(mutan,'',800,400,'yes')
}

function submitForms() {
if ( (isNama()) && (isKlien()) )
//if ( isKlien())
if (confirm)
{ 
return true;
}
else
{
return false;      
}
else
return false;
}


function isNama() {
var str = document.peliharapolis.mutasi.value;
if (str == "") {
alert("Silakan pilih jenis mutasi !!")
document.peliharapolis.mutasi.focus();
return false;
}
return true;
}

function isKlien() {
var str = document.peliharapolis.nopertanggungan.value;
if (str == "") {
alert("Silakan isi nomor polis !!")
document.peliharapolis.nopertanggungan.focus();
return false;
}
if (str == "000000000") {
alert("Tidak Ada Nomor Polis \"000000000\" !!")
document.peliharapolis.nopertanggungan.focus();
return false;
}
return true;
}

</script>
<link href="../jwsclass.css" rel="stylesheet" type="text/css">
<hr size="1">
<div align="center">
<table border="0" width="400" cellpadding="0">
<form name="peliharapolis" action="<? $PHP_SELF; ?>" method="post" onSubmit="return submitForms()">
  <tr>
    <td width="100%" bgcolor="#FFFFFF">
				Melihat Proposal Masuk Per 
        <select size="1" name="mutasi" onchange="document.peliharapolis.caripls.disabled=true" class="select1">
		    <option value="blank"></option>
        <option value="popkantor">KANTOR</option>
        <option value="popagen">AGEN</option>
        <option value="poppenagih">PENAGIH</option>
        </select>
		</td>
  </tr>
  <tr>
     <td width="100%" align="center">Nomor Polis : 
			  <input type="text" name="prefix" size="2">
				<input type="text" name="nopertanggungan" size="10" maxlength="9" onblur="javascript:validasi(this.form.nopertanggungan)" value="<? echo $nopertanggungan; ?>">
			  <a href="#" onclick="GantiJenisPemb()">
 		    <img src="../img/jswindow.gif" border="0" name="caripls" alt="cari nomor polis"></a>
		 </td>
   </tr>
   <tr>
        <td width="100%" align="center"><input type="submit" value="SUBMIT" name="cari" class="button1">
   </td>
   </tr>
	</form>
</table>
</div>
<hr size="1">
<a href="../polisserv.php"><font face="Verdana" size="2">Menu Pemeliharaan Polis</font></a>