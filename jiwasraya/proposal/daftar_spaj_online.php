<?
 include "../../includes/database.php";
 include "../../includes/session.php";
// include "../../includes/klien_online.php";
 //include "../../includes/pertanggungan_online.php";
 
 //$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
 $DB=new Database("JSADM","JSADMOKE","JSDEPLOY");
 $DB1=new Database("JSADM","JSADMOKE","JSDEPLOY");
if($_GET["action"]=="yes"){
	
	$sql="update dimas.L#3278 set L#3279='1' where entity_id='".$_GET['id']."'";
	$DB->parse($sql);
	$DB->execute();
}elseif($_GET["action"]=="no"){
	$sql="update dimas.L#3278 set L#3279='2' where entity_id='".$_GET['id']."'";
	$DB->parse($sql);
	$DB->execute();
}

?>
<br><br><div align="center"><font face="Verdana"><b>DAFTAR SPAJ ONLINE KOPERASI NUSANTARA</b></font></div>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO. SPAJ</b></font></td>
    <td bgcolor="#C2CAED" align="center"><p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
	  <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO ID</b></font></td>
	  <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO IDSPAJ</b></font></td>
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
	<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>ACTIONaa</b></font></td>
   </tr>  
<?php 
$sql="select PATHALIAS,NOSPAJ,NAMATERTANGGUNG,NOID,idspaj,TGLEXPIRED_ID,TEMPATLAHIR, tgllahir,decode(JENISKELAMIN,'L','LAKI-LAKI','P','PEREMPUAN') jeniskelamin,".
     "(select namaagama from $DBUser.tabel_102_agama where kdagama=a.kdagama) AGAMA,TINGGIBADAN,BERATBADAN,NAMAIBUKAND,DIKAKHIR,NPWP,MERITALSTATUS,".
	 "tglnikah from DIMAS.TABEL_MAPPING_KLIEN a";
$DB->parse($sql);
$DB->execute();
	//echo $sql;
$no=1;	
while($arr=$DB->nextrow()){
	//echo "TES".$no;
	//$no++;

?>
<tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $no;?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&nosp=".$arr["NOSPAJ"]."','',800,500,1)\">".$arr["NOSPAJ"]."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATERTANGGUNG"];?><?// echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["NOID"];?></font></td>
	<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["IDSPAJ"];?></font></td>
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
	<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1">
	<?php
	$sql1="select L#3279 status,entity_id from dimas.L#3278 where entity_id='".$arr["IDSPAJ"]."'";
	$DB1->parse($sql1);
	$DB1->execute();
	$arrstat=$DB1->nextrow();
	if($arrstat["STATUS"]=="1"){
	?><a href="#" onclick="window.open('insprop_sponline.php?spaj=<?php echo $arr["NOSPAJ"]; ?>&id=<?=$arr["IDSPAJ"]?>&noagen=0000056552&nopenagih=0000050076&kdproduk=JSSPKN','popuppage','scrollbars=yes,width=780,height=600,top=100,left=50')">Lihat Proposal</a> | 
	<?php }else{ ?>
	<a href="?action=yes&nosp=<?php echo $arr["NOSPAJ"]; ?>&id=<?php echo $arr["IDSPAJ"]; ?>"> Approve</a> | 
	<?php } ?>
	<a href="?action=no&nosp=<?php echo $arr["NOSPAJ"]; ?>&id=<?php echo $arr["NOKLIEN"]; ?>">Reject</a>|<a href="#" onclick="window.open('http://jaim.jiwasraya.co.id/spaj/<?php echo $arr["PATHALIAS"]; ?>','popuppage','scrollbars=yes,width=1280,height=800,top=100,left=50')">Lihat SPAJ</a></font></td></tr>
<?php

	$no++;
	
}

?>
</form>
</table>
<?
include "footer.php";
?>
