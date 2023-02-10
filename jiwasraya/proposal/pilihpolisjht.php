<?  
  include "../../includes/session.php";  
  include "../../includes/database.php";  
	include "../../includes/pertanggungan.php";
	
	$DB=New Database("PLADM","PLADM","PLTEST");
//	$DB=new database($userid, $passwd, $DBName);
?>
<html>
<head>
<title>List Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript">
  function OnSumbit(theForm) {
	 var a = theForm.nama.value;
	 if (a.length < 3) {
	  if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya\nLama Tanggung Sendiri')) {
		 theForm.nama.value='ALL';
		 return true;
		} else {
		 theForm.nama.focus();
		 return false;
		}  
	 } else {
	  return true;
	 }	
	} 
		
</script>
</head>
<body>
<div align=center>

<font color="003399" face="Verdana"><b>DAFTAR POLIS</b></font><br>
<hr size="1">
<!--table width="100%">
<form method="post" name="porm" action="<? $PHP_SELF; ?>" onSubmit="return OnSumbit(document.porm)">
	<tr class=vercyan>
	 <td class=ver8ungu align="left">Masukkan Nama Tertanggung &nbsp;<font size="1" color="red">(Minimal 3 karakter) 
	 <input type="text" name="nama" size="20" class="c"  value="<?echo strtoupper($nama);?>" onFocus="highlight(event)">
	 <input type="submit" name="cari" value="Cari"></td>
	</tr>
</form>	
</table-->
<br>
<table>
<form name="polis" method="post" action="<? echo $PHP_SELF; ?>">
				 
<?	  	
	  $sql="select no_polis,pemegang_polis,no_polis_lama from pladm.polis order by no_polis";		
	//echo $sql;
		$DB->parse($sql); 
	  $DB->execute();

// $o = (int)!((boolean)$o);
?>
	 			<tr class="hijao">
					<td align=center>Nomor Polis</td>				
					 <td align=center>No Polis Lama</td>
					 <td align=center>Pemegang Polis</td>
    				</tr>	 					
<?		
		$i=0;
		while($arr=$DB->nextrow()) {
		//$PER=New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
		include "../../includes/belang.php";
				$link = "<td class=arial10ungu><a href=\"#\" onclick=\"javascript:".
										"window.opener.document.porm.no_polis.value='".$arr["NO_POLIS"]."';\n".
										"window.close();\n".
										"\">".$arr["NO_POLIS"]."</a></font></td>";
						echo	$link;					
				      echo("<td class=arial10ungu>".$arr["NO_POLIS_LAMA"]."</font></td>");		    					
							echo("<td class=arial10ungu>".$arr["PEMEGANG_POLIS"]."</font></td>");		        
		         // echo("<td class=arial10ungu align=right>".number_format($PER->jua,2)."</font></td>");
		         // echo("<td class=arial10ungu align=right>".number_format($PER->premi1,2)."</font></td>");
		          echo("</tr>");
		$i++;
		}

?>	
</table>
	</form>
</div>
</body>
	</html>
