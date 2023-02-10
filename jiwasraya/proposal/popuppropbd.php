<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/sortnama.php";
	include "../../includes/kantor.php";
	$prefixpertanggungan = $kantor;
	$DB=new database($userid, $passwd, $DBName);	
	$PWK=new Kantor($userid,$passwd,$kantor);
?>
<html><head>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align=center>
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1401</font></td></tr>
<tr><td align="center" class="arial12bluen">DAFTAR PROPOSAL DIBAYAR DIDEPAN</td></tr>
<tr><td align="center" class="arial10">Kantor <?echo $kantor." [".$PWK->namakantor; ?>]</td></tr>
</table>
<form method="post" action=<? echo $PHP_SELF; ?>>
<table align="center" border="0">
	<tr>
	 <td class="arial10" align="left">Agen</td>
	 <td class="arial10" align="center" colspan="5"><? 	SortNama('popuppropbd.php'); ?></td>
	</tr> 
	<tr class="hijao">
	 <td align="center" rowspan="2">Nomor</td>
	 <td align="center" rowspan="2">Suspend (Rp)</td>
	 <td align="center" rowspan="2">Nama Agen</td>
	 <td align="center" colspan="3">Update</td>
	</tr>
						<tr class="hijao">
						 <td align=center>Tanggal</td>
						 <td align=center>Jam</td>
						 <td align=center>User</td>
						</tr>	
<? 
  if ($id=='all') {
 	$sql = "select a.prefixpertanggungan,a.nopertanggungan,to_char(c.nilaipembayaran,'999,999,999,999.00') suspend, ".
			   "to_char(a.tglupdated,'DD/MM/YYYY') tgl,to_char(a.tglupdated,'HH24:MI:SS') jam, ". 
				 "a.userupdated, b.namaklien1 agen ".
				 "from $DBUser.tabel_100_klien b,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_800_pembayaran c  ".
				 "where a.notertanggung is null and a.tglbp3 is not null and a.prefixpertanggungan='$kantor' ".
			 	 "and a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
				 "and c.kdpembayaran='002' and a.noagen=b.noklien ".
				 "order by a.nopertanggungan desc";
	} elseif ($id=='') {
	} else {
 	$sql = "select a.prefixpertanggungan,a.nopertanggungan,to_char(c.nilaipembayaran,'999,999,999,999.00') suspend, ".
			   "to_char(a.tglupdated,'DD/MM/YYYY') tgl,to_char(a.tglupdated,'HH24:MI:SS') jam, ". 
				 "a.userupdated, b.namaklien1 agen ".
				 "from $DBUser.tabel_100_klien b,$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_800_pembayaran c  ".
				 "where a.notertanggung is null and a.tglbp3 is not null and a.prefixpertanggungan='$kantor' ".
			 	 "and a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
				 "and c.kdpembayaran='002' and a.noagen=b.noklien and b.namaklien1 like '$id%' ".
				 "order by a.nopertanggungan desc";
	}
	$DB->parse($sql);
	$DB->execute();
//echo $sql;
			
					 $i=1	;		 
					 while($arr=$DB->nextrow()) {
					 include "../../includes/belang.php";	
					 printf("<td class=arial8blue><a href=\"#\" onclick=\"javascript:window.opener.document.propmtc01.noproposal.value='%s';window.close();\">%s</a></font></td>",$arr["NOPERTANGGUNGAN"],$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]);
		          echo("<td class=arial8blue align=right>".$arr["SUSPEND"]."</td>");
							echo("<td class=arial8blue align=left>".$arr["AGEN"]."</td>");
							echo("<td class=arial8blue align=center>".$arr["TGL"]."</td>");
							echo("<td class=arial8blue align=center>".$arr["JAM"]."</td>");
							echo("<td class=arial8blue align=left>".$arr["USERUPDATED"]."</td>");
							echo("</tr>");
					 $i++;
					 }				 
           
?>
	<tr>
	 <td class="arial10" align="left">Agen</td>
	 <td class="arial10" align="center" colspan="5"><? 	SortNama('popuppropbd.php'); ?></td>
	</tr> 
</table>
</form>
</div>
</body>
</html>
