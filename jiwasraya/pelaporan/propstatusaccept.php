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
	switch($sttacc){
	  case "tolak" : $acc="3"; $title="Ditolak"; break;
		case "tunda" : $acc="2"; $title="Ditunda"; break;
	}
  $sql = "select a.prefixpertanggungan,a.nopertanggungan,to_char(a.mulas,'DD/MM/YYYY') mulas,".
	       "to_char(a.tglsendemail,'DD/MM/YYYY HH24:MI:SS') tglsendemail,a.kdstatusmedical,".
	       "a.kdpertanggungan, a.kdstatusmedical,a.kdproduk,a.tglcetak,".
				 "b.namaproduk,c.namaklien1,d.kdacceptance,d.alasanacceptance ".
				 "from ".
				 "$DBUser.tabel_100_klien c,$DBUser.tabel_200_pertanggungan a,".
				 "$DBUser.tabel_202_produk b,$DBUser.tabel_214_acceptance_dokumen d where ".
				 "a.kdproduk=b.kdproduk and a.notertanggung=c.noklien and ".
				 "a.nopertanggungan=d.nopertanggungan(+) and ".
				 "d.kdacceptance='$acc' and ".
				 "a.prefixpertanggungan='$kdkantor' and a.kdpertanggungan='1' and ".
				 "$mulas order by a.mulas";
	$DB->parse($sql);
	$DB->execute();
	?>
	<title>LIST PROPOSAL</title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
	<p><font face="Verdana" size="2"><b>Informasi Proposal <? echo $title; ?> Kantor <? echo $kdkantor; ?></b></font></p>
  <table border="0" align="center" cellspacing="1" cellpadding="3">
  <tr>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.</font></td>
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">No.Pertanggungan</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Nama</font></td>	
    <td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Produk</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Stt. Med.</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl.Mulas</font></td>
 		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl.Kirim Email</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Status Akseptasi</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Alasan <? echo $title; ?></font></td>
 </tr>
	<?
	$jmlpolis = 0;
	while($arr=$DB->nextrow()){
	$i = 0;
	$i = $count + 1;
	$jml = $arr["JUMLAH"];
	$kdacceptance=$arr["KDACCEPTANCE"];
	$tglsendemail=$arr["TGLSENDEMAIL"];
	if($tglsendemail==''){
	  $tglsendemail = "<font color=\"red\" face=\"Verdana\" size=\"1\">Belum</font>";
	} else {
	  $tglsendemail=$arr["TGLSENDEMAIL"];
	}
	  if($i%2){
	  echo "<tr>";
    }
	else
	  {
	  echo "<tr bgcolor=\"#D9D7DB\">";
    } 
	switch ($kdacceptance){
			case "1": $accept = "<font color=\"green\" face=\"Verdana\" size=\"1\">Sudah</font>"; break;
			case "2": $accept = "<font color=\"blue\" face=\"Verdana\" size=\"1\">Ditunda</font>"; break;
			case "3": $accept = "<font color=\"#e1982b\" face=\"Verdana\" size=\"1\">Ditolak</font>"; break;
			case "": $accept = "<font color=\"red\" face=\"Verdana\" size=\"1\">Belum</font>"; break;
	}
  //echo "<tr>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
	echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</font></td>";
  echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>";
  echo "  <td><font face=\"Verdana\" size=\"1\">(".$arr["KDPRODUK"].")".$arr["NAMAPRODUK"]."</font></td>";
	echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$tglsendemail."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$accept."</font></td>";
	echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["ALASANACCEPTANCE"]."</font></td>";
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
	