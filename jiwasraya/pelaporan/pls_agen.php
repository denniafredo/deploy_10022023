<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
	
	switch ($thmulas)
	{
	  case "":
		  $tahunmulas = "Semua Tahun";
			break;
		  default:
		  $tahunmulas = $thmulas;
	}
	
 $sql  = "select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantor='$kdkantor'";
	$DB->parse($sql);
	$DB->execute();
	if($ass=$DB->nextrow()) {
	  $namakantor=$ass["NAMAKANTOR"];
  }
	
 $sql  = "select kdvaluta,namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta'";
	$DB->parse($sql);
	$DB->execute();
	if($ass=$DB->nextrow()) {
	  $namavaluta=$ass["NAMAVALUTA"];
  }
	
	$sql= "select a.kdkantor,a.kdjeniskantor,a.kdkantorinduk,a.namakantor,".
	      "b.namajeniskantor from ".
        "$DBUser.tabel_001_kantor a,$DBUser.tabel_006_jeniskantor b ".
			  "where a.kdjeniskantor=b.kdjeniskantor and a.kdkantorinduk='$kdkantor'";
			
	$DB->parse($sql);
	$DB->execute();

?>
<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5320</font></td></tr>
</table>
<font face="Verdana" size="2"><b>DAFTAR POLIS PERTANGGUNGAN BARU BERDASARKAN JENIS VALUTA</b></font>
<hr size="1">
<pre>
KANTOR : <? echo "$namakantor";?> <br>TAHUN  : <? echo $tahunmulas;?> </b></font></pre>
<table border="0" bgcolor="#DFDFBF" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Kode Kantor</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nama Kantor</b></font></td>
<!--    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Jenis Kantor</b></font></td> -->
  </tr>
	<? while($arr=$DB->nextrow()){
	   $i = 0;
		 $i = $count + 1;
	 ?>
  <tr>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><a href="agen_polis.php?prefixpertanggungan=<? echo $arr["KDKANTOR"]; ?>&tahun=<? echo $thmulas; ?>"><? echo $arr["KDKANTOR"]; ?></a></font></td>
		<td bgcolor="#FFFFFF"><font face="Verdana" size="1"><a href="agen_polis.php?prefixpertanggungan=<? echo $arr["KDKANTOR"]; ?>&tahun=<? echo $thmulas; ?>"><? echo $arr["NAMAKANTOR"]; ?></a></font></td> 
<!--		<td bgcolor="#FFFFFF"><font face="Verdana" size="1"><? echo $arr["NAMAJENISKANTOR"]; ?></font></td> -->
  </tr>
	<? 
	$count++;
	} ?>
	<!--		-->

</table>
<hr size="1">
<table>
<tr>
<td><font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a>&nbsp;&nbsp;</font></td>
<td><font face="verdana" size="2"><a href="index.php">Menu Pelaporan</a></font></td>
</tr>
</table>
	  
</body>
</html>
