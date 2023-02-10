<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
	
$sql= "select a.prefixpertanggungan,a.nopertanggungan,a.kdpertanggungan,a.notertanggung,".
	      "a.kdproduk,a.mulas,a.lamaasuransi_th,a.lamaasuransi_bl,a.premi1,a.premi2,a.kdvaluta,".
				"a.kdcarabayar,a.nopenagih,a.noagen,a.juamainproduk,b.namacarabayar,c.namaklien1 ttg,d.namaklien1 pmgpol ".
				"from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar b,$DBUser.tabel_100_klien c,$DBUser.tabel_100_klien d ".
				"where a.kdcarabayar = b.kdcarabayar and a.notertanggung=c.noklien and a.nopemegangpolis=d.noklien"; 

	$DB->parse($sql);
	$DB->execute();

?>
<html>
<head>
<title>Untitled</title>
</head>
<body topmargin="0">

<p><font face="Verdana" size="2"><b>DAFTAR POLIS PERTANGGUNGAN BARU<br>
KANTOR : $KANTOR</b></font></p>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
  <tr>
    <td width="5%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td width="14%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.
      POLIS</b></font></td>
    <td width="21%" bgcolor="#C2CAED" colspan="2" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
    <td width="10%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JUMLAH
      PRODUKSI</b></font></td>
    <td width="10%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MACAM
      ASURANSI</b></font></td>
    <td width="10%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI
      ASURANSI</b></font></td>
    <td width="10%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA
      ASURANSI</b></font></td>
    <td width="10%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI</b></font></td>
    <td width="6%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CARA
      BAYAR</b></font></td>
    <td width="4%" bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>VALUTA</b></font></td>
  </tr>
  <tr>
    <td width="11%" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG
      PLS</b></font></td>
    <td width="10%" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
  </tr>
	<? while($arr=$DB->nextrow()){
	   $i = 0;
		 $i = $count + 1;
	 ?>
  <tr>
    <td width="5%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td width="14%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]; ?></font></td>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><? echo $arr["PMGPOL"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><? echo $arr["TTG"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["JUAMAINPRODUK"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["PREMI1"]; ?></font></td>
    <td width="6%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["NAMACARABAYAR"]; ?></font></td>
    <td width="4%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDVALUTA"]; ?></font></td>
  </tr>
	<? 
	$count++;
	} ?>
  <tr>
    <td width="40%" bgcolor="#FFFFFF" colspan="4">
      <p align="center"><font face="Verdana" size="1"><b>JUMLAH</b></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><b>$totalproduksi</b></font></td>
    <td width="30%" bgcolor="#FFFFFF" colspan="3">&nbsp;</td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><b>$jmlpremi</b></font></td>
    <td width="10%" bgcolor="#FFFFFF" colspan="2">&nbsp;</td>
  </tr>
</table>
<hr size="1">
	  <font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
</body>
</html>
