<?  
  include "../../includes/session.php";  
  include "../../includes/database.php";  
  include "../../includes/pertanggungan.php";
	
	$DB=new database($userid, $passwd, $DBName);
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

<font color="003399" face="Verdana"><b>DAFTAR POLIS RAYON PENAGIHAN <? echo $kantor; ?></b></font><br>
<hr size="1">
<table width="100%">
<form method="post" name="porm" action="<? $PHP_SELF; ?>" onSubmit="return OnSumbit(document.porm)">
	<tr class=vercyan>
	 <td class=ver8ungu align="left">Masukkan Nama Tertanggung &nbsp;<font size="1" color="red">(Minimal 3 karakter) 
	 <input type="text" name="nama" size="20" class="c"  value="<?echo strtoupper($nama);?>" onFocus="highlight(event)">
	 <input type="submit" name="cari" value="Cari"></td>
	</tr>
</form>	
</table>
<br>
<table>
<form name="polis" method="post" action="<? echo $PHP_SELF; ?>">
				 
<?	
  if (!$nama) {
	 $dannama = 'kampret';
	} elseif ($nama=='ALL') {
	 $dannama = '';
	} else{ 
   $dannama = "and d.namaklien1 like '".strtoupper($nama)."%'"; 
  }
	$ad = ($o==1) ? 'asc' : 'desc';
	$f = (!$f) ? '1' : $f;
	
	  $sql="select a.nopertanggungan,d.namaklien1 namatertanggung,a.prefixpertanggungan,a.nopolbaru,a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
		     "to_char(a.tglupdated,'HH:mi:ss') jamupdated,b.nopenagih ".
				 "from $DBUser.tabel_100_klien d,$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
			   "where b.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' ".
				 "and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien ".
				 "and b.kdrayonpenagih='$kantor' ".
				 $dannama.
				 " order by $f ".
				 $ad;		
	//echo $sql;
		$DB->parse($sql);
	  $DB->execute();

 $o = (int)!((boolean)$o);
?>
	 				<tr class="hijao">
					<td align=center colspan="2">Nomor Polis</td>
<?
    print( "<td align=\"center\"  rowspan=\"2\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o\">Nama</a></td>\n" );
?>					
					 <td align=center rowspan="2">Produk</td>
					 <td align=center rowspan="2">Valuta</td>
					 <td align=center rowspan="2">Medical</td>
					 <td align=center rowspan="2">Carabayar</td>
					 <td align=center colspan="3">Update</td>
  				 </tr>
	 				<tr class="hijao">
					 <td align=center width="12%">Lama</td>
<?
    print( "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o\">Baru</a></td>\n" );
?>
					 <td align=center>Tanggal</td>
					 <td align=center>Jam</td>
					 <td align=center>User</td>
  				 </tr>	
<?		
		$i=0;
		while($arr=$DB->nextrow()) {
		$PER=New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
		include "../../includes/belang.php";
				$link = "<td class=arial10ungu><a href=\"#\" onclick=\"javascript:".
										"window.opener.document.porm.prefixpertanggungan.value='".$arr["PREFIXPERTANGGUNGAN"]."';\n".
										"window.opener.document.porm.nopertanggungan.value='".$arr["NOPERTANGGUNGAN"]."';\n".
										"window.opener.document.porm.nopolbaru.value='".$arr["NOPOLBARU"]."';\n".
										"window.close();\n".
										"\">"./*$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]*/$arr['NOPOLBARU']."</a></font></td>";
				      echo("<td class=arial10ungu>".$PER->nopol."</font></td>");
		    			echo	$link;			
							echo("<td class=arial10ungu>".$PER->namatertanggung."</font></td>");
		          echo("<td class=arial10ungu>".$PER->produk."</font></td>");
		          echo("<td class=arial10ungu>".$PER->notasi."</font></td>");
		         // echo("<td class=arial10ungu align=right>".number_format($PER->jua,2)."</font></td>");
		         // echo("<td class=arial10ungu align=right>".number_format($PER->premi1,2)."</font></td>");
							echo("<td class=arial10ungu align=center>".$PER->medstat."</font></td>");
              echo("<td class=arial10ungu>".$PER->namacarabayar."</font></td>");
							echo("<td class=arial10ungu>".$arr["TGLUPDATED"]."</td>");
							echo("<td class=arial10ungu>".$arr["JAMUPDATED"]."</td>");
							echo("<td class=arial10ungu align=center>".$arr["USERUPDATED"]."</td>");
		          echo("</tr>");
		$i++;
		}

?>	
</table>
	</form>
	</div>
	</body>
	</html>
