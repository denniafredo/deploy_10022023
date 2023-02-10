<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);

		$sql = "select a.kdproduk,count(a.nopertanggungan) as jumlah,b.namaproduk ".
	       "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_202_produk b where a.kdpertanggungan='2' and ".
				 "a.kdproduk=b.kdproduk ".
				 "group by a.kdproduk,b.namaproduk order by a.kdproduk";

	$DB->parse($sql);
	$DB->execute();
	?>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<div align="center">
	<p><font face="Verdana" size="2"><b>Informasi Polis Berdasarkan Produk</b></font></p>
  <table border="0" cellspacing="1" cellpadding="3">
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
	
		//-------------------------- 
	
	 		$sqlx = "select c.kdproduk,c.namaproduk from $DBUser.tabel_202_produk c where kdproduk in ".
			        "(select a.kdproduk from $DBUser.tabel_202_produk a minus ".
              "select distinct(b.kdproduk) from $DBUser.tabel_200_pertanggungan b where b.kdpertanggungan='2')";
			$DB->parse($sqlx);
	    $DB->execute();
				while($ars=$DB->nextrow()){
       	$i = 0;
	      $i = $count + 1;
	echo "<tr>";			
	echo "  <td align=\"center\" bgcolor=\"#FFE0C1\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
  echo "  <td bgcolor=\"#FFE0C1\"><font face=\"Verdana\" size=\"1\">".$ars["KDPRODUK"]." - ".$ars["NAMAPRODUK"]."</font><font face=\"Verdana\" size=\"2\" color=red>*</font></td>";
  echo "  <td align=\"center\" bgcolor=\"#FFE0C1\"><font face=\"Verdana\" size=\"1\">0</font></td>";
  echo "</tr>";
		//		echo $ars["KDPRODUK"]."-".$ars["NAMAPRODUK"]."<br>";
				$count++;
	      }
	//--------------------------
	
	echo "<tr>";
  echo "  <td bgcolor=\"#C4CDD2\" align=\"center\" colspan=\"2\"><font face=\"Verdana\" size=\"1\">Jumlah</font></td>";
  echo "  <td bgcolor=\"#C4CDD2\" align=\"center\"><font face=\"Verdana\" size=\"1\" color=\"blue\">".$jmlpolis."</font></td>";
  echo "</tr>";			
	echo "</table>";
  echo "<font face=\"Verdana\" size=\"1\"><font color=red size=2>*</font> = Produk belum dicoba</font>";
	echo "<hr size=1>";
		echo "<a href=\"showuser.php\"><font face=\"Verdana\" size=\"1\">BACK</font></a>";
?>
</div>	