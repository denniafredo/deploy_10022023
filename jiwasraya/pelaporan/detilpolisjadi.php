<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);
  //echo $awalperiode." - ".$akhirperiode;
	$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,".
	       "a.premi1,a.juamainproduk,f.namacarabayar,".
				 "to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
	       "d.userupdated,a.userrekam,a.kdproduk,decode(a.kdvaluta,'1','RUPIAH','3','DOLLAR','RUPIAH INDEKS') kdvaluta,".
				 "to_date(a.tglcetak,'DD/MM/YYYY') tglcetak,b.namaproduk,c.namaklien1,e.kdkantor,".
				 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) as namaagen ".
	       "from ".
				 "$DBUser.tabel_100_klien c,".
				 "$DBUser.tabel_200_pertanggungan a,".
				 "$DBUser.tabel_202_produk b,".
				 "$DBUser.tabel_214_acceptance_dokumen d, ".
				 "$DBUser.tabel_305_cara_bayar f, ".
				 "$DBUser.tabel_888_userid e ".
				 "where ".
				 "a.kdproduk=b.kdproduk and ".
				 //"a.tglrekam >= to_date('14/05/2002','DD/MM/YYYY') and ".
				 "(a.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ". 
				 "a.notertanggung=c.noklien and a.nopertanggungan=d.nopertanggungan and ".
				 "a.userrekam=e.userid and ".
				 "a.kdcarabayar=f.kdcarabayar(+) and ".
				 "e.kdkantor='$kdkantor' and a.kdpertanggungan='2' ".
				 "order by a.prefixpertanggungan,a.nopertanggungan ";
 	 				 
	$DB->parse($sql);
	$DB->execute();
	?>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<p><font face="Verdana" size="2"><b>Informasi Polis Kantor <? echo $kdkantor; ?></b></font></p>
  <table border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Polis Nomor</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tertanggung</font></td>	
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Agen</font></td>	
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Produk</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Cara Bayar</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Valuta</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Premi</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">JUA</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl. Akseptasi</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">User Akseptasi</font></td>
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
   echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>";
	 echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMAAGEN"]."</font></td>";
   echo "  <td><font face=\"Verdana\" size=\"1\">(".$arr["KDPRODUK"].")".$arr["NAMAPRODUK"]."</font></td>";
   echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>";
	 echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["KDVALUTA"]."</font></td>";
	 echo "  <td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>";
	 echo "  <td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>";
	 echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>";
   echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["USERUPDATED"]."</font></td>";
   echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$cetak."</font></td>";
   echo "</tr>";
	 $i++;
	 $jmlpolis += $jml;
	}
	echo "</table>";
	echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
	