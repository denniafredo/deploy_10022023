<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);
/*
	$sql = "select a.kdproduk,a.prefixpertanggungan,count(a.nopertanggungan) as jumlah,b.namaproduk ".
	       "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_202_produk b where a.kdpertanggungan='2' and ".
				 "a.kdproduk=b.kdproduk and ".
				 "a.prefixpertanggungan='$kdkantor' and a.tglrekam >= to_date('14/04/2002','DD/MM/YYYY') ".
				 "group by a.kdproduk,a.prefixpertanggungan,".
				 "b.namaproduk order by kdproduk";
*/				 
	$sql = "select a.kdproduk,b.namaproduk,".
	       "count(a.kdproduk) as jumlah ".
	       "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_202_produk b ".
				 "where a.kdproduk=b.kdproduk and ".
				 //"a.tglrekam >= to_date('14/05/2002','DD/MM/YYYY') and ".
				 "(a.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ". 
				 "a.prefixpertanggungan='$kdkantor' and a.kdpertanggungan='2' group by ".
				 "a.kdproduk,b.namaproduk";
	$DB->parse($sql);
	$DB->execute();
	//echo $sql; 
	?>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<p><font face="Verdana" size="2">Informasi Polis Kantor <? echo $kdkantor; ?></font></p>
  <table border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Produk</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Jumlah</font></td>
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
  echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]." - ".$arr["NAMAPRODUK"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["JUMLAH"]."</font></td>";
  echo "</tr>";
	$count++;
	$jmlpolis += $jml;
	}
	echo "<tr>";
  echo "  <td bgcolor=\"#FFFFFF\" align=\"center\" colspan=\"2\"><font face=\"Verdana\" size=\"1\">Jumlah</font></td>";
  echo "  <td bgcolor=\"#FFFFFF\" align=\"center\"><font face=\"Verdana\" size=\"1\" color=\"blue\">".$jmlpolis."</font></td>";
  echo "</tr>";			
	echo "</table>";
		echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
	