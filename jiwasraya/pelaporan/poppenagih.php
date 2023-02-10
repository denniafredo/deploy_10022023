<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	$formname=(!$a) ? "ntryprop" : $a;	
	$fieldname=(!$b) ? "nopenagih" : $b;
	$DB=New Database($userid, $passwd, $DBName);
?>	
  <html><title>Penagih List</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript">
	<!--
  function OnSumbit(theForm) {
	 var a = theForm.nama.value;
	 if (a.length < 3) {
	  if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya')) {
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
	//-->
	</script>				
	<body topmargin="0">
	<div align=center>
	<form name="porm" method="post" action="<?echo $PHP_SELF;?>" onsubmit="return OnSumbit(document.porm)">
  <table width="100%" cellpadding="1" cellspacing="1" >
	<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1332</font></td></tr>
   <tr class="tblisi"><td class="arial10">Nama Agen <font size=1 color=red>(min 3 karakter): &nbsp;
	 <input type="text" class="c" name="nama" size="10" onfocus="highlight(event)" value="<?echo strtoupper($nama);?>">
	 <input type="submit" name="submit" value="Cari" class="buton">
	 <input type="hidden" name="a" value="<?echo $a;?>">
	 <input type="hidden" name="b" value="<?echo $b;?>">
	 <input type="hidden" name="kdkantor" value="<?echo $kdkantor;?>">
	 </td>
	</tr>
  </table>
	<b><font face="Verdana" size="2">Daftar Premium Collector Kantor <?echo $kdkantor;?></b></font><br>
<?
  if (!$nama) {
	 $dannama = 'kampret';
	} elseif ($nama=='ALL') {
	 $dannama = '';
	} else{ 
   $dannama = "and b.namaklien1 like '".strtoupper($nama)."%'"; 
  }
	$ad = ($o==1) ? 'asc' : 'desc';
	$f = (!$f) ? '1' : $f;
	
  $sql="select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
			 "from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
	     "where a.nopenagih=b.noklien and a.kdstatuspenagih!='04' and a.kdrayonpenagih='".$kdkantor."' ".
				 $dannama.
				 " order by $f ".
				 $ad;			 
	//echo $sql;
	
	$DB->parse($sql);
	$DB->execute();
?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="tblisi">
  <tr class="hijao">
<?
 $o = (int)!((boolean)$o);
    print( "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o\">Nomor</a></td>\n" );
    print( "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o\">Nama</a></td>\n" );
?>
		<td align=center>Asal</td>
    <td align=center>Rayon</td>
  </tr>
<?
	$i=0;
	while($arr=$DB->nextrow()) {
	  include "../../includes/belang.php";
		$nama = (strlen($arr["GELAR"])==0 || preg_match("/^[0-9]/",substr($arr["GELAR"],0,1))) ? $arr["NAMAKLIEN1"] : $arr["NAMAKLIEN1"].",".$arr["GELAR"];
		$nama = ereg_replace("'","`",$nama);	
		$a="<td class=arial10ungu align=center>".
		"<a href=\"#\" onclick=\"javascript:window.opener.document.premitagih.nopenagih.value='".$arr["NOPENAGIH"]."';window.close();\" >".$arr["NOPENAGIH"]."</a></td>".
    "<td  class=arial10ungu>".$nama."</td>".
    "<td  class=arial10ungu align=center>".$arr["PREFIXPENAGIH"]."</td>".
    "<td  class=arial10ungu align=center>".$arr["KDRAYONPENAGIH"]."</td>".
    "</tr>";
		echo($a);
		$i++;
	}
?>
</table>
</form>
</div>
</body>
</html>