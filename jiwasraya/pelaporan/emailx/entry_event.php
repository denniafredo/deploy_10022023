<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";
	include "../../includes/tgl.php";
	include "../../includes/constant.php";
	
	// nopolis = QB 001065838
	
	$DB  = new database($userid, $passwd, $DBName);
	$PWK = New Kantor($userid,$passwd,$kantor);
	$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$prefix=strtoupper($prefix);
	$KP  = New KantorPusat($userid,$passwd);
	//echo $tglpengajuan;
	
	
if ($billing) {
	$sql = "begin $DBUser.GEN_EMAIL_BLAST ( '".$_POST['jnsblast']."', '".$_POST['periode']."' );end;";
	$DB->parse($sql);
	$DB->execute();
	echo $sql;
} else {

	$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
  	$DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$tanggal = $w["NOW"];
?>

<html>
<head>
<title>Pengajuan Klaim Tanggal </title>

<style type="text/css">
<!--

body {
	background-color: #FFFFFF;
	font-family: Verdana, Arial, Serif;
	font-size: 10px;
	color: #000000;
	margin-left: 0px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
}

table {
	font-family: verdana;
	font-size: 12px;
}

.button {
	font-size: 11px;
	color: #FFFFFF;
	background-color: #99cccc;
	border: solid 0px;
}

.select {
	font-family: Verdana, Arial, Serif;
	font-size: 11px;
	color: #336699;
	background-color: #FFFFFF;
}

-->
</style>

<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript">
<!--

function KartuPremi(theForm){
  var polis=theForm.pertanggungan.value;
   if (!polis =='') { 
    var prefix=polis.substring(0,2);
		var noper=polis.substring(3);
	  NewWindow('../akunting/kartupremi1.php?prefix='+prefix+'&noper='+noper+'','kartupremi',700,600,1)
  	return true;
	 }	
}
function KartuGadai(theForm){
  var polis=theForm.pertanggungan.value;
   if (!polis =='') { 
    var prefix=polis.substring(0,2);
		var noper=polis.substring(3);
	  NewWindow('../akunting/kartugadai1.php?prefix='+prefix+'&noper='+noper+'','kartugadai',700,600,1)
  	return true;
	 }	
}
function Polis(theForm){
  var polis=theForm.pertanggungan.value;
   if (!polis =='') { 
    var prefix=polis.substring(0,2);
		var noper=polis.substring(3);
	  NewWindow('polis.php?prefix='+prefix+'&noper='+noper+'','polis',700,600,1)
  	return true;
	 }	
}

function GantiKlaim(theForm) {
var prefix=theForm.prefix.value;
var noper=theForm.noper.value;
var kdklaim=theForm.jnsklaim.value;
prefix=prefix.toUpperCase();
window.location.replace('pengajuanklaim_akdp.php?prefix='+prefix+'&noper='+noper+'&kdklaim='+kdklaim+'');
}

function OpenWin(prefix,noper) {
var kdklaim=document.propmtc.jnsklaim.value;
NewWindow('loadpengajuan_akdp.php?prefix='+prefix+'&noper='+noper+'&kode='+kdklaim+'','',700,400,1)
}

function CariPolis () {
prefix = document.propmtc.prefix.value;
noper = document.propmtc.noper.value;

loadOK = true;
 if ( prefix == '' && loadOK) {
  alert('Masukkan Prefix Pertanggungan atau \nKlik Pilih Polis');
	document.propmtc.prefix.focus();
	loadOK = false;
 }
 if ( ( noper == '' || noper=='000000000') && loadOK ) {
  alert('Masukkan Nomor Pertanggungan');
	document.propmtc.prefix.focus();
	loadOK = false;
 }
 if (loadOK) {  
   OpenWin(prefix,noper);
 }
 return loadOK
}
function OnSumbit(theForm) {
var pert=theForm.pertanggungan.value;
 if (pert =='') {
  alert ('Nomor Polis Kosong, Masukkan Nomor Polis Yang Benar Atau Cari Dari Popup');
 	theForm.prefix.focus();
	return false;
 } else {
  return true
 }
}

function PilihAo(theForm) {
 var polis=theForm.pertanggungan.value;
		NewWindow('loadinsurable.php?nopertanggungan='+polis+'','popupcari',500,200,1);
}
//-->
</script>
<?
	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	
 if ($klp=='D') {
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function KonverDate(theForm) {\n" );
  print( " tglmati=theForm.tglmeninggal.value;\n" );
  print( " if (!tglmati=='') {\n" );
  print( "  convert_date(theForm.tglmeninggal);\n" );
  print( "	return true;\n" );
  print( " } else {\n" );
  print( "  alert('Tanggal Meninggal Wajib Diisi');\n" );
  print( "	theForm.tglmeninggal.focus();\n" );
  print( "	return false;\n" );
  print( " }		\n" );
  print( "}\n" );
  print( "//-->\n" );
  print( "</script>\n" );
 }
?>
</script>

</head>
<body>

<div align="center">
<form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>"  onsubmit="return OnSumbit(document.propmtc)">

<table bgcolor="#e5e5e5" border="1" width="780" align="center" cellpadding="2" style="border-collapse: collapse" bordercolor="#a4a4a4" id="AutoNumber1" cellspacing="0">
  <tr>
    <td width="100%" height="25" bgcolor="#fac67e" align="center"><b>Create Event Blast</b></td>
  </tr>
  <tr>
    <td width="100%">
    <table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
      <tr>
        <td>Jenis Blast</td>
        <td>: 
  				<select name="jnsblast" class="select">
  				<?
  				/*switch($kdklaim)
  				{
  				  case "MENINGGAL": $m="selected"; break;
  					case "CACAT": $c="selected"; break;
  					case "RAWATINAP": $r="selected"; break;
  				}*/
  				  echo "<option value='EMAIL_JATUH_PREMI_BERKALA'>EMAIL_JATUH_PREMI_BERKALA</option>";
  					echo "<option value='EMAIL_PREMIUM_STATEMENT'>EMAIL_PREMIUM_STATEMENT</option>";
  					//echo "<option value='EMAIL_JATUH_BENEFIT'>EMAIL_JATUH_BENEFIT</option>";
  					//echo "<option value='UCAPAN_TAHUN_BARU'>UCAPAN_TAHUN_BARU</option>";
  				?>
  				</select>
				</td>        
      </tr>      
      <tr>
        <td colspan="4"><hr color="#c0c0c0" size="1"></td>
      </tr>
      <!--tr>
        <td>Nama Event</td>
        <td>: <input type="text" name="tertanggung" size="36"></td>        
      </tr-->      
	  <tr>
        <td>Periode</td>
        <td colspan="3">: 
        <input type="text" name="periode" size="16"> (MM/YYYY)</td>
      </tr>		
    </table>
    </td>
  </tr>
  <tr>
    <td width="100%" height="25" bgcolor="#fac67e" align="center"><input type="submit" name="billing" value="billing" /></td>
  </tr>
	</form>
</table>

<br>
<br>
<table width="800">
  <tr>
    <td width="50%" class="arial10" align="left"><a href="../polisserv.php">Policy Servicing</a></td>
		<td width="50%" class="arial10" align="right"></td>
	</tr>
</table>


</div>
</body>
</html>
<?}?>