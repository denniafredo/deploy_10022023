<?
  include "includes/session.php";
  include "includes/database.php";
	include "includes/klien.php";
	$DB=new database($userid, $passwd, $DBName);
	
if (!strlen($noklien)==0) {
  $sql = "select namaklien1 from $DBUser.tabel_100_klien ".
         "where noklien='$noklien'";
}
 $DB->parse($sql);
 $DB->execute();
 $arr=$DB->nextrow();
  $namaklien=$arr["NAMAKLIEN1"];
  $namaklien=stripslashes($namaklien);	


if($insert=="Insert") {
	$KL=New Klien ($userid,$passwd,$noklieninsurable);
	if ($KL->jeniskelamin=='L' && ($kdhubungan=='I'||$kdhubungan=='U'||$kdhubungan=='N'||$kdhubungan=='W')) {
?>
		<script language="JavaScript" type="text/javascript">
		alert ('Hubungan Tidak Sesuai Jenis Kelamin.\nUlangi lagi !');
		</script>
<?
	} else if ($KL->jeniskelamin=='P' && ($kdhubungan=='S'||$kdhubungan=='A'||$kdhubungan=='K'||$kdhubungan=='L')) {
?>
		<script language="JavaScript" type="text/javascript">
		alert ('Hubungan Tidak Sesuai Jenis Kelamin.\nUlangi lagi !');
		</script>
<?
	} else {
		$sql="insert into $DBUser.tabel_113_insurable (notertanggung,kdhubungan,noklieninsurable) ".
         "values ('$noklien','$kdhubungan','$noklieninsurable')";
    //echo $sql;
	  $DB->parse($sql);
	  $DB->execute();
	}
} else if ($delete=="Delete"){
	$sql="select noklieninsurable,kdhubungan ".
	     "from $DBUser.tabel_113_insurable ".
	     "where notertanggung='$noklien'";
	$DB->parse($sql);
	$DB->execute();
	$res = $DB->result();
	foreach ($res as $foo => $data) {
    if (${$data["NOKLIENINSURABLE"]} == "ON") {
	    $noklins = $data["NOKLIENINSURABLE"];
	    $sql="delete from $DBUser.tabel_113_insurable ".
 					 "where notertanggung='$noklien' and noklieninsurable='$noklins'";
	    $DB->parse($sql);
		  $DB->execute();
	  }
  }
	$DB->commit();
}
	$sqa="select a.noklieninsurable,a.kdhubungan,b.namaklien1 ".
	     "from $DBUser.tabel_100_klien b, $DBUser.tabel_113_insurable a ".
	     "where a.notertanggung='$noklien' and a.noklieninsurable=b.noklien(+)";
	//echo $sqa;
	$DB->parse($sqa);
	$DB->execute();
	$insurable=$DB->result();
	
	$sql="select kdhubungan,namahubungan from $DBUser.tabel_218_kode_hubungan";
	$DB->parse($sql);
	$DB->execute();		
	$result=$DB->result();
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<? include "includes/hide.php";  ?>
<link href="includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="includes/window.js"></script>
<script language="JavaScript" type="text/javascript">
function CariNama () {
	var noklien=document.ntryclnthub.noklieninsurable.value;
	if (!noklien==''){
		window.open('carinama.php?namahalaman=ntryclnthub&noklien='+noklien+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
	}
}
</script>
</head>
<body topmargin="0">
<div align="center">
<table width="100%">
	<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1314</font></td></tr>
	<tr><td class="arial10blk">Pemeliharaan Data Klien</td></tr>
</table>

<hr size="1">
<form name="ntryclnthub" method="POST" action=<? PHP_SELF; ?>>


<table border="0" width="100%" class="tblborder" cellspacing="1" cellpadding="1">
<tr>
<td class="tblisi1">
<table width="100%" cellpadding="1" cellspacing="4" class="verdana10">
 <tr>
  <td width="100">Kode Klien</td>
	<td>: <? echo $noklien." - <b>".$namaklien; ?></td>
  <td align="right"><font color="red"><b>Edit</td>
 </tr>
 <tr>
  <td>Jenis Klien</td>
	<td>: I Individual</td>
  <td align="right">Status : Aktif</td>
 </tr>
</table>
</td>
</tr>
</td>
</tr>
</table>
<br>

<table border="0" width="100%" cellspacing="1" cellpadding="0" align="center">
<tr class="verdana8">
<td>
 Masukkan Nomor Klien (jika sudah tahu) Atau Klik <img src="../img/jswindow.gif" border="0">
 Untuk Memilih Klien (Sebaiknya Nomor Klien Insurable Interest Yang Dientry dicatat, sehingga sekarang tinggal 
 Memasukkan Nomornya saja)
</td>
</tr>
</table>
<br>

<table border="0" width="100%" cellspacing="1" cellpadding="0" align="center" class="tblisi">
 <tr class="hijao"> 
	<td align="center">No.</th>
  <td align="center">No. Klien</th>
  <td align="center">Nama Klien</th>
  <td align="center">Jenis Hubungan</th>
  <td align="center">Umur</th>
  <td align="center">Cek</th>
 </tr>	
<? 
  $i=1;
	//while ($arr=$DB->nextrow()) {
	foreach ($insurable as $foo => $val) {
	  include "includes/belang.php";
		$noklieninsurable = $val["NOKLIENINSURABLE"];
		$kdhubungan = $val["KDHUBUNGAN"];
		$KL=new Klien($userid,$passwd,$noklieninsurable);
		echo("<td class=\"arial10\" align=\"right\">".$i.".</td>");
		echo("<td class=\"arial10\" align=\"center\">".$noklieninsurable."</td>"); 
		echo("<td class=\"arial10\" align=\"left\">".$val["NAMAKLIEN1"]."</td>"); 
		echo("<td class=\"arial10\" align=\"left\">");
		foreach($result as $coo => $data) {
  	  if ($val["KDHUBUNGAN"]==$data["KDHUBUNGAN"]) {
		    echo($data["NAMAHUBUNGAN"]);
	    } 
		}
		echo("</td>"); 
		echo("<td class=\"arial10\" align=\"center\">".$KL->Umur()." th, ".$KL->Umurbl()." bl</td>"); 
		echo("<td class=\"arial10\" align=\"center\"><input type=\"checkbox\" name=".$val["NOKLIENINSURABLE"]." value=\"ON\">&nbsp;&nbsp;");
		echo("<a href=\"#\" onclick=\"NewWindow('updclnthub.php?noklien=$noklien&noklieninsurable=$noklieninsurable&kdhubungan=$kdhubungan','updclnt',500,200,1);\">edit</a></td>");
		echo("</tr>");
		$i++;
	}
	echo("<tr>");
	echo("<td class=\"arial10\" align=\"right\" >".$i.".</td>");
	echo("<td class=\"arial10\" align=\"center\"><input class=c type=\"text\" size=\"10\" maxlength=\"10\" name=\"noklieninsurable\" onfocus=\"highlight(event)\" onblur=\"validasi10(this.form.noklieninsurable);CariNama()\"></td>");
	echo("<td class=\"arial10\" align=\"left\"><input class=a type=\"text\" size=\"40\" maxlength=\"40\" name=\"namaklien1\"  readonly></td>");
	echo("<td class=\"arial10\" align=\"left\" class=buton><select class=a size=1 name=\"kdhubungan\" onfocus=\"highlight(event)\">");
	foreach($result as $coo => $data) {
	  $kdhubungan = $data["KDHUBUNGAN"];
	  $namahubungan = $data["NAMAHUBUNGAN"];
		echo("<option value=$kdhubungan>$namahubungan");
	}
	echo("</select></td>"); 
	echo("<td align=\"center\"></td>"); 
	echo("<td align=\"center\" ><a href=\"#\" onclick=\"NewWindow('popupclnt_link.php','popuppage',450,300,1);\">&nbsp;<img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari daftar klien\"></a></td>");
	echo("</tr>");
?>  
</table>




<hr size=1>
<table width="100%">
<tr>
  <td><font face="verdana" size="2"><a href="mnuclntmtc.php?noklien=<?echo $noklien; ?>&namaklien=<?echo $namaklien;?>">Back</a>&nbsp;&nbsp;&nbsp;&nbsp;
<? echo "<font face=\"Verdana\" size=\"2\"><a href=\"mnuklien.php?noklien=$noklien&namaklien=$namaklien\">Menu Klien</a>";?>
	</td>
  <td align="right">
	  <input type="hidden" name="noklien" value=<? echo $noklien; ?>>
	  <input type="hidden" name="namaklien" value=<? echo $namaklien; ?>>
    <input type="submit" name="insert" value="Insert">
    <input type="submit" name="delete" value="Delete">
	</td>
</tr>
</table>
</div>
</form>
</body>
</html>
