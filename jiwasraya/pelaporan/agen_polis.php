<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB = new Database($userid, $passwd, $DBName);
	
	switch ($tahun)	{
	  case "":  $tahunmulas = "Semua Tahun";	break;
	  default:  $tahunmulas = $tahun;
	}
	$sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantor='$prefixpertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	if ($ass=$DB->nextrow()) {
		$namakantor=$ass["NAMAKANTOR"];
		$kodekantor=$ass["KDKANTOR"];
  }
	$sql="select kdproduk,namaproduk from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
	$DB->parse($sql);
	$DB->execute();
	if ($ass=$DB->nextrow()) {
	  $namaproduk=$ass["NAMAPRODUK"];
  }
$sql ="select distinct a.noagen,a.prefixagen,to_char(a.tglskagen,'DD/MM/YYYY') tglskagen,".
     "b.namaklien1,c.prefixpertanggungan ".
     "from $DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b,".
     "$DBUser.tabel_200_pertanggungan c ".
     "where c.prefixpertanggungan='$prefixpertanggungan' and ".
		 "a.noagen=b.noklien and a.noagen=c.noagen order by namaklien1";
		 //"a.noagen=b.noklien and a.noagen=c.noagen and a.tglskagen like '%$tahun'";
$DB->parse($sql);
$DB->execute();
?>
<html>
<head>
<title>DAFTAR POLIS PERTANGGUNGAN BARU BERDASARKAN NAMA AGEN</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F5330</font></td></tr>
</table>
<font face="Verdana" size="2"><b>DAFTAR POLIS PERTANGGUNGAN BARU BERDASARKAN NAMA AGEN</b></font><br>
<hr size="1">
<pre>
KANTOR : <? echo "$namakantor";?> <br>TAHUN  : <? echo $tahunmulas;?> </b></pre>
<table border="0" width="380" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
		<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO. AGEN</b></font></td>
		<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NAMA AGEN</b></font></td>
	 </tr>
<?
	$totpremi=0;
	$totjua=0;
	while($arr=$DB->nextrow()){
	   $i=0;
		 $i=$count+1;
?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["NOAGEN"]; ?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><a href="agen_polis_disp.php?noagen=<? echo $arr["NOAGEN"]."&prefixpertanggungan=".$kodekantor."&tahun=".$tahun.""?>"><? echo $arr["NAMAKLIEN1"]; ?></a></font></td>
  </tr>
<? 
	 	$totjua = $totjua + $arr["JUAMAINPRODUK"];
		$totpremi = $totpremi + $arr["PREMI1"];
		$count++;
	}
?>
</table>
<hr size="1">
<table>
<tr>
<td><font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a>&nbsp;&nbsp;</font></td>
<td><font face="verdana" size="2"><a href="index.php">Menu Pelaporan</a></font></td>
</tr>
</table>
</body>
</html>
