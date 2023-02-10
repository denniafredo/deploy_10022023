<? 
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	$DB=New database($userid, $passwd, $DBName);

	$sql="select ".
	 					"a.prefixpertanggungan,".
						"a.nopertanggungan,".
						"a.nopenagih,".
	     			"a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
			 			"b.kdrayonpenagih,".
						"b.terminalpng,".
						"c.kdkantor, ".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopenagih ) namapenagih ".
			 "from ".
			      "$DBUser.tabel_200_pertanggungan a,".
						"$DBUser.tabel_600_historis_mutasi_pert d, ".
			 			"$DBUser.tabel_888_userid c,".
						"$DBUser.tabel_500_penagih b ".
			 "where ".
			 			"c.userid=a.userupdated and ".
			 			"a.nopenagih=b.nopenagih and ".
						"b.kdrayonpenagih='$kantor' and ".
			 			"d.nopertanggungan=a.nopertanggungan and ".
			 			"d.kdmutasi='01' and ".
			 			"a.kdpertanggungan='2' and ".
						"a.kdstatusfile='1' and ".
						"b.terminalpng='1'";
			 //echo $sql."<br><br>";	 
	$DB->parse($sql);
  $DB->execute();
	
?>
<html>
<head>
<title>Mutasi Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

<font face="Verdana" size="2">
<b>POLIS MUTASI KE KANTOR <? echo $kantor; ?></b>
</font>
<hr size=1>
<div align="center">
<table border="0" cellspacing="1">
  <tr class="hijao">
    <td align="center">NO</td>
		<td align="center">NO. PERTGN</td>
		<td align="center">TERTANGGUNG</td>
		<td align="center">PRODUK</td>
		<td align="center">MULAS</td>
		<td align="center">MED</td>
		<td align="center">VALUTA</td>
		<td align="center">JUA</td>
		<td align="center">PREMI1</td>
		<td align="center">PREMI2</td>
    <td align="center">ASAL</td>
    <td align="center">PENAGIH</td>
    <td align="center">UPDATE</td>
  </tr>
<?
	$i=1;
	while($his=$DB->nextrow()){
	$PER = New Pertanggungan($userid,$passwd,$his["PREFIXPERTANGGUNGAN"],$his["NOPERTANGGUNGAN"]);
	$ketmutasi=$his["KETERANGANMUTASI"];
	$prefix=$his["PREFIXPERTANGGUNGAN"];
	$noper=$his["NOPERTANGGUNGAN"];
	$pindah = substr($ketmutasi,21,2);
	  include "../../includes/belang.php";	 
    echo "<td align=\"right\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
		echo "<td><font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$his["PREFIXPERTANGGUNGAN"]."&noper=".$his["NOPERTANGGUNGAN"]."','',800,600,1);\">".$his["PREFIXPERTANGGUNGAN"]."-".$his["NOPERTANGGUNGAN"]."</a></td>\n";
  	echo "<td><font face=\"Verdana\" size=\"1\">".$PER->namatertanggung."</font></td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$PER->produk."</font></td>";
		echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$PER->mulas."</font></td>";
		echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$PER->medstat."</font></td>";
		echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$PER->notasi."</font></td>";
		echo "<td align=\"right\"><font face=\"Verdana\" size=\"1\">".number_format($PER->jua,2)."</font></td>";
		echo "<td align=\"right\"><font face=\"Verdana\" size=\"1\">".number_format($PER->premi1,2)."</font></td>";
		echo "<td align=\"right\"><font face=\"Verdana\" size=\"1\">".number_format($PER->premi2,2)."</font></td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\" color=blue><b>".$his["KDKANTOR"]."</td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\" color=red><b>".$his["NAMAPENAGIH"]."</td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\" color=green><b>".$his["TGLUPDATED"]."</td>";
    //echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\" color=blue><b><a href=updatepenagih.php?prefix=$prefix&noper=$noper&raybaru=$kantor>UPDATE</a> </td>";
    echo "</tr>";
		$i++;
	}
?>
</table>
</div>
<hr size="1">
<?
include "footer.php";
?>
</body>
</html>
