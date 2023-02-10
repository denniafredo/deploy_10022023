<?
 include "../../includes/database.php";
 include "../../includes/session.php";
// include "../../includes/klien_online.php";
 //include "../../includes/pertanggungan_online.php";
 
 //$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
 $DB=new Database("JSADM","JSADMOKE","JSDEPLOY");
if($_GET["action"]=="yes"){
	$sql="update ";
	$DB->parse($sql);
	$DB->execute();
}elseif($_GET["action"]=="no"){
	$sql="";
	$DB->parse($sql);
	$DB->execute();
}

?>
<br><br><div align="center"><font face="Verdana"><b>DAFTAR SPAJ REKSAMADANI ONLINE</b></font></div>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO. SPAJ</b></font></td>
    <td bgcolor="#C2CAED" align="center"><p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
	  <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO ID</b></font></td>
	  <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BERLAKU s/d</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TEMPAT LAHIR</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TGL. LAHIR</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>JENIS KELAMIN</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>AGAMA</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TINGGI BADAN (cm)</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BERAT BADAN (kg)</b></font></td>
	<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NAMA IBU KANDUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PENDIDIKAN TERAKHIR</b></font></td>
	<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NPWP</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>MERITAL STATUS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TGL. MENIKAH</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>STATUS TINGGAL</b></font></td>
	<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>ACTION</b></font></td>
   </tr>  
<?php 
$sql="select NOSPAJ,NAMATERTANGGUNG,NOID, TGLEXPIRED_ID,TEMPATLAHIR, tgllahir,decode(JENISKELAMIN,'L','LAKI-LAKI','P','PEREMPUAN') jeniskelamin,".
     "(select namaagama from $DBUser.tabel_102_agama where kdagama=a.kdagama) AGAMA,TINGGIBADAN,BERATBADAN,NAMAIBUKAND,DIKAKHIR,NPWP,MERITALSTATUS,".
	 "tglnikah,STATUSTINGGAL from DIMAS.TABEL_MAPPING_KLIEN a";
$DB->parse($sql);
$DB->execute();
//echo $sql;
$no=1;
while($arr=$DB->nextrow()){
?>
<tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $no;?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&nosp=".$arr["NOSPAJ"]."','',800,500,1)\">".$arr["NOSPAJ"]."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATERTANGGUNG"];?><?// echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["NOID"];?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["TGLEXPIRED_ID"];?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["TEMPATLAHIR"];?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLLAHIR"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["JENISKELAMIN"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["AGAMA"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["TINGGIBADAN"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["BERATBADAN"];?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["NAMAIBUKAND"];?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["DIKAKHIR"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NPWP"]." ".number_format($arr["TOPUP"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["MERITALSTATUS"]." ".number_format($arr["UATERM"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLMENIKAH"]." ".number_format($arr["UACI"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["STATUSTINGGAL"];?></font></td>
	<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><a href="?action=yes&nosp=<?php echo $arr["NOSPAJ"]; ?>"> Approve</a> | <a href="?action=no&nosp=<?php echo $arr["NOSPAJ"]; ?>">Reject</a></font></td>
<?php

	$no++;
}

include "footer.php";
?>
