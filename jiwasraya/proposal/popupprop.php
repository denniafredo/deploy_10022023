<?  
  include "../../includes/session.php";  
  include "../../includes/database.php";  
  include "../../includes/kantor.php";  
	include "../../includes/atozsortnama.php";
	
	$prefixpertanggungan = $kantor;
	$DB = new database($userid, $passwd, $DBName);	
	$PWK = new Kantor($userid,$passwd,$kantor);
?>
<html><head>
<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript">
	<!--
  function OnSumbit(theForm) {
	 var a = theForm.nama.value;
	 if (a.length < 3) {
	  if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya (Lama)')) {
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
</head>
<body>
<div align=center>
<form name="porm" method="post" action="<?echo $PHP_SELF;?>" onsubmit="return OnSumbit(document.porm)">
<table width="100%" cellpadding="1" cellspacing="1">
 <tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1401</font></td></tr>
  <tr class="tblisi"><td class="arial10">Nama Tertanggung <font size=1 face="Verdana" color="red">(min 3 karakter): &nbsp;
	 <input type="text" class="c" name="nama" size="10" onfocus="highlight(event)" value="<?echo strtoupper($nama);?>">
	 <input type="submit" name="submit" value="Cari" class="buton">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Klik Nomor / Nama Untuk Sorting
	 </td>
 </tr>
 <tr><td align="center" class="arial12bluen">DAFTAR PROPOSAL &nbsp;<font class="arial10blk">Kantor <?echo $kantor." [".$PWK->namakantor; ?>]</td></tr>
</table>
				<table>
<?

  		 if (!$nama) {
	 		  $dannama = 'kampret';
			 } elseif ($nama=='ALL') {
	 		  $dannama = '';
			 } else { 
   		  $dannama = "and b.namaklien1 like '".strtoupper($nama)."%' "; 
       }
			 
			 	$ad = ($o==1) ? 'asc' : 'desc';
				$f = (!$f) ? '1' : $f;
	
			    	$sql="select a.nopertanggungan,b.namaklien1,a.prefixpertanggungan,a.nopolbaru,a.kdproduk,a.kdstatusemail,".
								 "b.gelar,a.userupdated,c.namacarabayar,decode (a.kdstatusmedical,'M','<font color=green>M','<font color=blue>N')kdstatusmedical,decode(a.kdvaluta,'0','Idx','1','Rp','USD') valas,".
								 "decode(kdstatusemail,'1','<font color=green>SUDAH','<font color=red>BELUM') statusemail, ".
								 "a.userupdated,to_char(a.premi1,'999,999,999.99') premi1,to_char(a.juamainproduk,'999,999,999,999.99') juamainproduk,".
								 "to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.tglupdated,'HH:mi:ss') jamupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from $DBUser.tabel_100_klien b,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar c ".
			           "where a.notertanggung=b.noklien(+) ".
								 "and a.kdcarabayar=c.kdcarabayar and a.kdstatusfile='1' ".
								 $dannama.
			           "and prefixpertanggungan='$prefixpertanggungan' and a.kdpertanggungan='1' ".
				 				 " order by $f ".
								 $ad;		  	 
			//echo $sql;
					 $DB->parse($sql);
					 $DB->execute();
					 
		 $o = (int)!((boolean)$o);

    print( "<tr class=hijao>\n" );
		print( " <td align=\"center\" rowspan=\"2\"><a href=\"$PHP_SELF?nama=$nama&f=1&o=$o\">Nomor</a></td>\n" );
    print( " <td align=\"center\" rowspan=\"2\"><a href=\"$PHP_SELF?nama=$nama&f=2&o=$o\">Nama Tertanggung</a></td>\n" );			 
?>
							<td rowspan="2"  align=center><a href="#" onclick="window.open('popupprod.php','','width=250,height=200,top=100,left=100,scrollbars=yes')">Produk</a></font></td>
							<td rowspan="2"  align=center>J U A</td>
							<td rowspan="2"  align=center>Cara Bayar</td>
							<td rowspan="2"  align=center>M</td>
							<td rowspan="2"  align=center>Val</td>
							<td rowspan="2"  align=center>Mulai Ass</td>
							<td colspan="3" align=center>Update</td>
							<td rowspan="2" align=center>Email</td>
 						</tr>
						<tr class="hijao">
						 <td align=center>Tanggal</td>
						 <td align=center>Jam</td>
						 <td align=center>User</td>
						</tr>
<?				 
					 $i=1;		 
					 while($arr=$DB->nextrow()) {
					   include "../../includes/belang.php";
						   printf("<td class=arial8blue><a href=\"#\" onclick=\"javascript:window.opener.document.propmtc01.nopertanggungan.value='%s';javascript:window.opener.document.propmtc01.nopolis.value='%s';window.close();\">%s</a></font></td>",$arr["NOPERTANGGUNGAN"],$arr["NOPOLBARU"], /*$arr["PREFIXPERTANGGUNGAN"]." - ".$arr["NOPERTANGGUNGAN"]*/ $arr['NOPOLBARU']);
		          echo("<td><font size=1 face=Verdana>".$arr["NAMAKLIEN1"]."</td>");
		          echo("<td class=arial8blue align=center>".$arr["KDPRODUK"]."</td>");
							echo("<td class=arial8blue align=right>".$arr["JUAMAINPRODUK"]."</td>");
		          echo("<td class=arial8blue>".$arr["NAMACARABAYAR"]."</td>");
							echo("<td class=arial8blue align=center>".$arr["KDSTATUSMEDICAL"]."</td>");
							echo("<td class=arial8blue align=center>".$arr["VALAS"]."</td>");
							echo("<td class=arial8blue>".$arr["MULAS"]."</td>");
							echo("<td class=arial8blue>".$arr["TGLUPDATED"]."</td>");
							echo("<td class=arial8blue align=center>".$arr["JAMUPDATED"]."</td>");
							echo("<td class=arial8blue align=center>".$arr["USERUPDATED"]."</td>");
              echo("<td class=arial8blue align=center>".$arr["STATUSEMAIL"]."</td>");
              echo("</tr>");
					   $i++;
					 }				 
?>
</table>
</form>
</div>
</body>
</html>

