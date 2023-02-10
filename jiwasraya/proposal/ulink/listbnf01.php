<?
ob_start();
?><script language="JavaScript">
		
		function uaOK(){
			 var uaminnya=document.propmtc14.uaminnya.value;
			 var uamaxnya=document.propmtc14.uamaxnya.value;
			 var uanya=document.propmtc14.jua.value;
			 if(uanya<uaminnya){
				 alert("Nilainya UA harus lebih besar dari UA Minimal " + uanya + " < " + uaminnya);
				 document.propmtc14.jua.focus();
				 return uaminnya;
			 }else if (uanya>=uaminnya && uanya <=uamaxnya){
				 //document.propmtc14.propmtc14lanjut.disable=false;				 //return uanya; 
			 }else{
				 alert("Nilainya UA harus lebih Kecil dari UA Maximal " + uanya + " < " + uaminnya);
				 document.propmtc14.jua.focus();
				 return uamaxnya;
			 }
		 }
	</script>
	<?
  include "./includes/session.php";
  include "./includes/database.php";
	$DB=New database($userid, $passwd, $DBName);

/*$sql="SELECT   KDINSURABLE
  FROM   $DBUser.tabel_219_temp a, $DBUser.tabel_200_temp b
 WHERE       a.nopertanggungan = b.nopertanggungan
         AND a.notertanggung = B.NOTERTANGGUNG
         AND nopemegangpolis = noklien
         AND b.nopertanggungan = '$nopertanggungan'";*/
		 $sql=	"SELECT   a.kdproduk,".
         		"a.kdbenefit,".
         		"b.namabenefit,".
        		"b.kdjenisbenefit ".
  				"FROM $DBUser.TABEL_206_PRODUK_BENEFIT a, $DBUser.TABEL_207_KODE_BENEFIT b ".
 				"WHERE   a.kdbenefit = b.kdbenefit AND a.kdproduk = '".$_GET["kdproduk"]."' order by a.kdbenefit";
//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$result=$DB->result();
?>
<html>
<title>Jaminan Tambahan</title>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<body>
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1337</font></td></tr>
<tr>
  <td class=arial10bold align=center>Pilihan Benefit Produk</td></tr>
</table>	
<form name="popupjam" method="POST" action=<? PHP_SELF; ?>>
<table width="100%">
<tr class="hijao">
<td align=center>Kode Benefit</td>
<td align=center>Nama Benefit</td>
</tr>
<?
	reset($result);
	$i=0;
	foreach($result as $foo => $arr){
	  include "./includes/belang.php";
		$htm = "<td class=arial10ungu><a href=\"#\" onclick=\"javascript:\n".
				 	 "window.opener.document.porm3.KDBENEFITNEW.value='%s';\n".
					 "window.opener.document.porm3.KDJENISBENEFIT.value='%s';\n".
					 "window.close();\" >%s</a></td>\n".
					 "<td class=arial10ungu>%s</td>\n";
		printf ($htm,$arr["KDBENEFIT"],$arr["KDJENISBENEFIT"],$arr["KDBENEFIT"],$arr["NAMABENEFIT"]);
	
	print( "</tr>" );
	$i++;
	}		 
?>

</table>	
</body>
</form>
</html>
