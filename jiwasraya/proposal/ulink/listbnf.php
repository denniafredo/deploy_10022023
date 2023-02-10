<?
ob_start();
  include "./includes/session.php";
  include "./includes/database.php";
	$DB=New database($userid, $passwd, $DBName);

/*$sql="SELECT   KDINSURABLE
  FROM   $DBUser.tabel_219_temp a, $DBUser.tabel_200_temp b
 WHERE       a.nopertanggungan = b.nopertanggungan
         AND a.notertanggung = B.NOTERTANGGUNG
         AND nopemegangpolis = noklien
         AND b.nopertanggungan = '$nopertanggungan'";*/
		 $sql="/* Formatted on 4/2/2014 6:38:00 AM (QP5 v5.114.809.3010) */
SELECT   a.kdproduk, a.kdbenefit, b.namabenefit, b.kdjenisbenefit
  FROM   $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b
 WHERE       a.kdbenefit = b.kdbenefit
         AND a.kdproduk = 'JL4B'
         AND a.kdjenisbenefit = 'R'
         AND b.kdbenefit <> 'RATEUP'
         AND a.kdbenefit LIKE '%'
         AND b.kdkelompokbenefit IS NULL
         AND ( (SUBSTR (a.kdbenefit, 1, 2) <> 'CP'
                OR (SUBSTR (a.kdbenefit, 1, 3) IN ('CPM', 'CPB')
                    AND NOT (SUBSTR (a.kdbenefit, -3) IN
                                   ('RWI', 'ICU', 'BDH'))))
              AND a.kdbenefit <> 'RISKER')
UNION
SELECT   a.kdproduk, a.kdbenefit, b.namabenefit, b.kdjenisbenefit
  FROM   $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b
 WHERE       a.kdbenefit = b.kdbenefit
         AND a.kdproduk = 'JL4B'
         AND a.kdjenisbenefit = 'R'
         AND b.kdbenefit <> 'RATEUP'
         AND b.kdkelompokbenefit IN ('B', 'E', 'D', 'T', 'C', 'R')
         AND b.faktorbenefit <> 'X'
         AND a.kdbenefit NOT IN ('SPBD', 'SPTPD', 'PBD', 'PBTPD')
         AND ( (SUBSTR (a.kdbenefit, 1, 2) <> 'CP'
                OR (SUBSTR (a.kdbenefit, 1, 3) IN ('CPM', 'CPB')
                    AND NOT (SUBSTR (a.kdbenefit, -3) IN
                                   ('RWI', 'ICU', 'BDH'))))
              AND a.kdbenefit <> 'RISKER')
UNION
SELECT   a.kdproduk, a.kdbenefit, b.namabenefit, b.kdjenisbenefit
  FROM   $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b
 WHERE       a.kdbenefit = b.kdbenefit
         AND a.kdproduk = 'JL4B'
         AND a.kdjenisbenefit = 'R'
         AND a.kdbenefit IN ('PBD', 'PBTPD','SPTPD','SPBD')";
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
<tr><td class=arial10bold align=center>Pilih Jaminan Tambahan</td></tr>
</table>	
<form name="popupjam" method="POST" action=<? PHP_SELF; ?>>
<table width="100%">
<tr class="hijao">
<td align=center>Kode Benefit</td>
<td align=center>Nama Benefit</td>
<td align=center>Jenis benefit</td>
</tr>
<?
	reset($result);
	$i=0;
	foreach($result as $foo => $arr){
	  include "./includes/belang.php";
		$htm = "<td class=arial10ungu><a href=\"#\" onclick=\"javascript:\n".
					 "window.opener.document.porm2.KDBENEFITNEW.value='%s';\n".
					 "window.opener.document.porm2.KDJENISBENEFIT.value='%s';\n".
					 "window.close();\" >%s</a></td>\n".
					 "<td class=arial10ungu>%s</td>\n".
					 "<td class=arial10ungu>%s</td>\n";
		printf ($htm,$arr["KDBENEFIT"],$arr["KDJENISBENEFIT"],$arr["KDBENEFIT"],$arr["NAMABENEFIT"],$arr["KDJENISBENEFIT"]);
	
	print( "</tr>" );
	$i++;
	}		 
?>

</table>	
</body>
</form>
</html>
