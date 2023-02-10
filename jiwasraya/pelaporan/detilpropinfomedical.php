<?
  include "../../includes/database.php";	
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);
  switch($sttmed){
	  case "M" : $medical="M"; $title="Medical"; break;
		case "N" : $medical="N"; $title="Non Medical"; break;
	}
		$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam,".
		     "to_char(a.tglsendemail,'DD/MM/YYYY HH24:MI:SS') tglsendemail,".
	       "a.userupdated,a.userrekam,a.kdproduk,b.namaproduk,c.namaklien1,d.kdkantor,e.kdacceptance ".
	       "from ".
				 "$DBUser.tabel_100_klien c,".
				 "$DBUser.tabel_200_pertanggungan a,".
				 "$DBUser.tabel_214_acceptance_dokumen e, ".
				 "$DBUser.tabel_888_userid d, ".
				 "$DBUser.tabel_202_produk b ".
				 "where a.kdproduk=b.kdproduk(+) and ".
				 //"a.tglrekam >= to_date('14/05/2002','DD/MM/YYYY') and ".
				 "(a.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ". 
				 "a.notertanggung=c.noklien(+) and ".
				 "a.userrekam=d.userid and a.kdstatusmedical='$medical' and ".
				 "a.nopertanggungan=e.nopertanggungan(+) and ".
				 "d.kdkantor='$kdkantor' and a.kdpertanggungan='1' ".
				 "order by a.prefixpertanggungan,a.nopertanggungan ";
    //echo $sql;    
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
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl. Rekam</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">User Rekam</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Tgl.Kirim Email</font></td>
		<td bgcolor="#000080" align="center"><font face="Verdana" size="1" color="#FFFFFF">Status Akseptasi</font></td>
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
	
	include "../../includes/belang.php"; 
	switch ($kdacceptance){
			case "1": $accept = "<font color=\"blue\" face=\"Verdana\" size=\"1\">Sudah</font>"; break;
			case "": $accept = "<font color=\"red\" face=\"Verdana\" size=\"1\">Belum</font>"; break;
	}
  //echo "<tr>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
	echo "  <td><font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"window.open('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";
  echo "  <td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>";
  echo "  <td><font face=\"Verdana\" size=\"1\">(".$arr["KDPRODUK"].")".$arr["NAMAPRODUK"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["TGLREKAM"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$arr["USERREKAM"]."</font></td>";
  echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$tglsendemail."</font></td>";
	echo "  <td align=\"center\"><font face=\"Verdana\" size=\"1\">".$accept."</font></td>";
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
	