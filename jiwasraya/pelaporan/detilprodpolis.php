<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);
 
 	if($periodeth){
	 $mulas="to_char(mulas,'YYYY')='$periodeth'";
	} else {
	 $mulas="to_char(mulas,'MMYYYY')='$periode'";
	}
	/*$sql = "select a.prefixpertanggungan,a.nopertanggungan,to_char(a.mulas,'DD/MM/YYYY') mulas,".
	       "a.kdpertanggungan, a.kdstatusmedical,a.kdproduk,a.tglcetak,".
				 "b.namaproduk,c.namaklien1 from $DBUser.tabel_100_klien c,$DBUser.tabel_200_pertanggungan a,".
				 "$DBUser.tabel_202_produk b,$DBUser.tabel_500_penagih d where ".
				 "a.kdproduk=b.kdproduk and a.notertanggung=c.noklien and ".
				 "a.nopenagih=d.nopenagih and d.kdrayonpenagih='$kdkantor' and a.kdpertanggungan='2' and ".
				 "$mulas order by a.mulas";*/
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,to_char(a.mulas,'DD/MM/YYYY') mulas, premi1, ".
	       "a.kdpertanggungan, a.kdstatusmedical,a.kdproduk,a.tglcetak,".
				 "(select namaproduk from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) namaproduk,(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) namaklien1 from $DBUser.tabel_200_pertanggungan a,".
				 "$DBUser.tabel_500_penagih d where ".
				 "a.nopenagih=d.nopenagih and d.kdrayonpenagih='$kdkantor' and a.kdpertanggungan='2' and ".
				 "$mulas order by a.mulas";
				 //ECHO $sql;
	$DB->parse($sql);
	$DB->execute();
	?>
	<title>DAFTAR POLIS</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<p><font face="Verdana" size="2"><b>Informasi Polis Kantor <? echo $kdkantor; ?></b></font></p>
  <table border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Polis Nomor</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Premi</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tertanggung</font></td>	
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Produk</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Mulai Asuransi</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl. Cetak Polis</font></td>
  </tr>
	<?
	$jmlpolis = 0;$i = 1 ;
	while($arr=$DB->nextrow()){
	 $jml = $arr["JUMLAH"];
	 $tglcetak = $arr["TGLCETAK"];
	 if(!$tglcetak){
	   $cetak = "<font face=\"Verdana\" color=red size=\"1\">BELUM</font>";
	 } else {
	   $cetak = $tglcetak;
	 }
   include "../../includes/belang.php";  
   echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
	 echo "  <td><font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";
    echo "  <td align=\"right\"><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>";
   echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>";
   echo "  <td><font face=\"Verdana\" size=\"1\">(".$arr["KDPRODUK"].")".$arr["NAMAPRODUK"]."</font></td>";
   echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>";
   echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$cetak."</font></td>";
   echo "</tr>";
	 $i++;
	 $jmlpolis += $jml;
	}
	echo "</table>";
	echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
	