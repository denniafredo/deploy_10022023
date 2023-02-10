<?
   include "../../includes/session.php";	 
	include "../../includes/database.php";
	//$DB=new Database("DEDI","DEDE","JSDB");
	//$DB1=new Database("DEDI","DEDE","JSDB");
	$DB=new database($userid, $passwd, $DBName); 
	$DB1=new database($userid, $passwd, $DBName);
	
if (!substr($REMOTE_ADDR,0,9)=='192.168.2') {
 echo "Hanya Untuk Administrator Dari Kantor Pusat, Dont' Try Me";
 die;
}
?>

<html>
<title>Pemeliharaan Proposal</title>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<link href="../jws.css" rel="stylesheet" type="text/css" />
</head>
<script LANGUAGE="JavaScript">
function submitForms() {
if ( (isProposal()))
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

function isProposal() {
 var prefix = document.propmtc01.prefixpertanggungan.value;
 var noper = document.propmtc01.nopertanggungan.value;
 var nopol = document.propmtc01.nopol.value;
 if (prefix == "" && noper == "" && nopol == "") {
   alert("Silakan isi Nomor Proposal / Polis atau Nomor Polis Lama!!")
	 document.propmtc01.nopertanggungan.focus();
	 return false;
 }
 return true;
}

</script>

<body topmargin="0" bgcolor="#b9e1f7">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1400</font></td></tr>
</table>
<strong>KANTOR PUSAT</strong>
<hr size=1>
<table border="0" cellspacing="0" width="60%" cellpadding="0" class="tblisi">
  <tr>
   <td>     Kantor Pusat Jakarta (KP)<br />
     JL. Ir. H. Juanda No. 34 Jakarta - 10120<br />
     Jakarta Pusat, Daerah Khusus Ibukota Jakarta - 10120<br />
     Telp. +62 21 3845031<br />
    Email : asuransi@ifg-life.co.id </td>
</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Regional Office  </td>
  </tr>
  <tr>
    <td><form id="layan" name="layan" method="post" action="#">
    <?
	$sql="select kdkantorinduk,kdkantor,namakantor,alamat01,alamat02,kodepos,propinsi,phone01,phone02,email ".
	     "from $DBUser.tabel_001_kantor where kdjeniskantor='1' order by namakantor";
	$DB->parse($sql);
	   $DB->execute();
	   echo "<select name=ro>";
	   while($arr=$DB->nextrow()){
	   if($arr["KDKANTOR"]==$ro){
	   echo "<option value=".$arr["KDKANTOR"]." selected>-----".$arr["NAMAKANTOR"]."-----</option>";
	   }else{
	   echo "<option value=".$arr["KDKANTOR"].">-----".$arr["NAMAKANTOR"]."-----</option>";
	   }
	   }
	   echo "</select>";
	   echo "<input type=submit name=cari value='Lihat Kantor Layanan' />";
	?>   
		
        
        
    </form>
	
	
    </td>
  </tr>
</table>

<hr size=1>
<?
if(isset($cari)){
?>
<table width="100%" border="1" class=verdana10blk style="border-collapse:collapse" bordercolor="#999999">
  <tr>
    <td align="center">Kantor Induk </td>
    <td align="center">Kode Kantor </td>
    <td align="center">Nama Kantor </td>
    <td align="center">Alamat</td>
    <td align="center">Kodepos</td>
    <td align="center">Propinsi</td>
    <td align="center">No. Telp 1 </td>
    <td align="center">No. Telp 2 </td>
    <td align="center">Email</td>

  </tr>
  <?
  $sql="select kdkantorinduk,kdkantor,namakantor,alamat01,alamat02,kodepos,propinsi,phone01,phone02,email ".
	     "from $DBUser.tabel_001_kantor where kdkantor like '".substr($ro,0,1)."%' order by kdkantor";
	$DB1->parse($sql);
	   $DB1->execute();
	   while($arr1=$DB1->nextrow()){
  ?>
  <tr>
    <td align="center"><?=$arr1["KDKANTORINDUK"]; ?></td>
    <td align="center"><?=$arr1["KDKANTOR"]; ?></td>
    <td><?=$arr1["NAMAKANTOR"]; ?></td>
    <td><?=$arr1["ALAMAT01"].", ".$arr1["ALAMAT02"]; ?></td>
    <td align="center"><?=$arr1["KODEPOS"]; ?></td>
    <td align="center"><?=$arr1["PROPINSI"]; ?></td>
    <td><?=$arr1["PHONE01"]; ?></td>
    <td><?=$arr1["PHONE02"]; ?></td>
    <td><?=$arr1["EMAIL"]; ?></td>

  </tr>
  <? } ?>
</table>

<?
}
?>
<font face="verdana" size="2"><a href="../pelaporan/">Menu Pelaporan</a></font>
</body>
</html>


