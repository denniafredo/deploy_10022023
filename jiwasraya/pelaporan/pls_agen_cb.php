<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
	
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
	
	$sql= "select kdkantor,kdjeniskantor,kdkantorinduk,namakantor from ".
      "$DBUser.tabel_001_kantor ".
			"where kdkantorinduk='$kdkantor'";
			
	$DB->parse($sql);
	$DB->execute();

?>
<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>


<p><font face="Verdana" size="2"><b>DAFTAR POLIS PERTANGGUNGAN BARU BERDASARKAN JENIS VALUTA<br>
<hr size="1">

		<select size="1" name="kdkantor">
		<? 
	   $sql= "select kdkantor,kdjeniskantor,kdkantorinduk,namakantor from ".
      "$DBUser.tabel_001_kantor ".
			"where kdkantorinduk='$kdkantor'";
			$DB->parse($sql);
			$DB->execute();
			
			while($arr=$DB->nextrow()){
			  echo("<option value=".$arr["KDKANTOR"].">".$arr["NAMAKANTOR"]."</option>");
			}			 
		?>
		</select>
		
<hr size="1">
<table>
<tr>
<td><font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a>&nbsp;&nbsp;</font></td>
<td><font face="verdana" size="2"><a href="index.php">Menu Pelaporan</a></font></td>
</tr>
</table>
	  
</body>
</html>
