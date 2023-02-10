<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);

		$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam,".
	       "a.userupdated,a.userrekam,a.kdproduk,b.namaproduk,c.namaklien1,d.kdkantor ".
	       "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_202_produk b,$DBUser.tabel_100_klien c, ".
				 "$DBUser.tabel_888_userid d ".
				 "where a.kdproduk=b.kdproduk(+) and a.tglrekam >= to_date('14/05/2002','DD/MM/YYYY') and ".
				 "a.notertanggung=c.noklien(+) and ".
				 "a.userrekam=d.userid and ".
				 "d.kdkantor='$kdkantor' and a.kdpertanggungan='1' ".
				 //"a.prefixpertanggungan='$kdkantor' and a.kdpertanggungan='1' ".
				 "order by a.prefixpertanggungan,a.nopertanggungan ";
    
	$DB->parse($sql);
	$DB->execute();
	?>
	<title>LIST PROPOSAL</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<p><font face="Verdana" size="2"><b>Informasi Proposal Kantor <? echo $kdkantor; ?></b></font></p>
  <table border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.Pertanggungan</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Nama</font></td>	
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Produk</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl. Rekam</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">User Rekam</font></td>
  </tr>
	<?
	$jmlpolis = 0;
	while($arr=$DB->nextrow()){
	$i = 0;
	$i = $count + 1;
	$jml = $arr["JUMLAH"];
	  if($i%2){
	  echo "<tr>";
    }
	else
	  {
	  echo "<tr bgcolor=\"#D9D7DB\">";
    } 
  //echo "<tr>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
	echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</font></td>";
  echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>";
  echo "  <td><font face=\"Verdana\" size=\"1\">(".$arr["KDPRODUK"].")".$arr["NAMAPRODUK"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["TGLREKAM"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["USERREKAM"]."</font></td>";
  echo "</tr>";
	$count++;
	$jmlpolis += $jml;
	}
	/*
	echo "<tr>";
  echo "  <td bgcolor=\"#FFFFFF\" align=\"center\" colspan=\"2\"><font face=\"Verdana\" size=\"1\">Jumlah</font></td>";
  echo "  <td bgcolor=\"#FFFFFF\" align=\"center\"><font face=\"Verdana\" size=\"1\" color=\"blue\">".$jmlpolis."</font></td>";
  echo "</tr>";			
	*/
	echo "</table>";
		echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
	