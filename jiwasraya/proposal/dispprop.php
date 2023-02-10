<?
	include "../../includes/database.php";
	include "../../includes/session.php";
	$prefixpertanggungan=$kantor;

 	function getclient($db,$noklien,&$nama,&$lahir,&$sex) {
	  $sql="select namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir,jeniskelamin ".
		     "from $DBUser.tabel_100_klien ".
				 "where noklien='$noklien'";
    $db->parse($sql);
	  $db->execute();
	  $res=$db->nextrow();
	  $nama = $res["NAMAKLIEN1"];
	  $lahir = $res["TGLLAHIR"];
	  $sex = $res["JENISKELAMIN"];
	}
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1240</font></td></tr>
</table>
	<!-------------------------------------- start php -------------------------------->				
	<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#C0C0C0">
  <tr>
    <td bgcolor="#FFFFFF" align="center">
<?
	$DB = new database($userid, $passwd, $DBName);
	$query="select prefixpertanggungan,kdpertanggungan,notertanggung,nosp,".
         "nopertanggungan,to_char(tglsp,'DD/MM/YYYY') tglsp,nobp3,kdproduk,to_char(mulas,'DD/MM/YYYY') mulas,usia_th,usia_bl,to_char(expirasi,'DD/MM/YYYY') expirasi,".
         "lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,".
				 "premi1,kdcarabayar,indexawal,premi2,nopenagih,kdstatusfile,noagen,kdstatusmedical,nopemegangpolis,nopembayarpremi ".
	       "from $DBUser.tabel_200_pertanggungan ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal'"; 
  $DB->parse($query);
	$DB->execute();
if ($arr=$DB->nextrow()) {
?>
<table border="0" width="100%" cellspacing="2" bgcolor="#C8D5DD">
  <tr>
    <td width="100%" colspan="2" bgcolor="#6666FF">
      <table width="300">
		  <?echo "<tr><td><font face=\"arial\" size=\"2\" color=\"white\"><b>Nomor Proposal</b></font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\" color=\"white\"><b>".$arr["PREFIXPERTANGGUNGAN"]." ".$arr["NOPERTANGGUNGAN"]."</b></font></td></tr>";?>
		  </table>
		</td>
  </tr>
  <tr>
    <td width="50%" valign="top" align="left">
		<table width="350">
		<?
		  $nottg = $arr["NOTERTANGGUNG"];
			getclient($DB,$nottg,$nama,$lahir,$sex);
			echo "<TR><TD><font face=\"arial\" size=\"2\">Tertanggung</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOTERTANGGUNG"]."&nbsp;".$nama."</font></TD></TR>";
		  $nottg = $arr["NOPEMEGANGPOLIS"];
			getclient($DB,$nottg,$nama,$lahir,$sex);
			echo "<TR><TD><font face=\"arial\" size=\"2\">Pemegang Polis</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOPEMEGANGPOLIS"]."&nbsp;".$nama."</font></TD></TR>";
      $nottg = $arr["NOPEMBAYARPREMI"];
			getclient($DB,$nottg,$nama,$lahir,$sex);
			echo "<TR><TD><font face=\"arial\" size=\"2\">Pembayar Premi</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOPEMBAYARPREMI"]."&nbsp;".$nama."</font></TD></TR>";	
			echo "<TR><TD><font face=\"arial\" size=\"2\">Pertanggungan</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["KDPERTANGGUNGAN"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Nomor SP</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOSP"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Tanggal SP</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["TGLSP"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Nomor BP3</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOBP3"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Produk</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["KDPRODUK"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Medical</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["KDSTATUSMEDICAL"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Mulas</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["MULAS"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Expirasi</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["EXPIRASI"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Usia</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["USIA_TH"]."/".$arr["USIA_BL"]."</font></TD></TR>";
		?>
		</table>
		</td>
    <td width="50%" valign="top" align="left">
		<table width="350">
		<?
			echo "<TR><TD><font face=\"arial\" size=\"2\">Lama Asuransi</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["LAMAASURANSI_TH"]."/".$arr["LAMAASURANSI_BL"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Lama Pemb. Premi</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["LAMAPEMBPREMI_TH"]."/".$arr["LAMAPEMBPREMI_BL"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Valuta</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["KDVALUTA"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">JUA Produk</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["JUAMAINPRODUK"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Premi 1</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["PREMI1"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Cara Bayar</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["KDCARABAYAR"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Index Awal</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["INDEXAWAL"]."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Premi 2</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["PREMI2"]."</font></TD></TR>";
      $nottg = $arr["NOPENAGIH"];
			getclient($DB,$nottg,$nama,$lahir,$sex);
			echo "<TR><TD><font face=\"arial\" size=\"2\">Penagih</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOPENAGIH"]."&nbsp;".$nama."</font></TD></TR>";
			echo "<TR><TD><font face=\"arial\" size=\"2\">Status</font></TD><TD>:</TD><TD ><font face=\"arial\" size=\"2\">".$arr["KDSTATUSFILE"]."</font></TD></TR>";
      $nottg = $arr["NOAGEN"];
			getclient($DB,$nottg,$nama,$lahir,$sex);
			echo "<TR><TD><font face=\"arial\" size=\"2\">Agen</font></TD><TD>:</TD><TD><font face=\"arial\" size=\"2\">".$arr["NOAGEN"]."&nbsp;".$nama."</font></TD></TR>";
		?>
		</table>
		</td>
  </tr>
</table>
<? } ?>
</td></tr></table>
<hr size="1">
<font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>&nbsp;&nbsp;&nbsp;
<font face="verdana" size="2"><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></font>
</body>
</html>
