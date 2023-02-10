<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
  include "../../includes/pertanggungan.php";
	$DB=New database($userid, $passwd, $DBName);
	$PER=new Pertanggungan($userid,$passwd,$pref,$noper);
?>
<html>
<head><title>Historis Cetak Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<div align="center">
<?	
	$pref = $_GET['pref'];
	$noper = $_GET['noper'];
//	echo "$pref";
	$sql="select kdkantor, prefix, prefixpertanggungan, nopertanggungan, kdstatus,
			keterangan, userrekam, tglrekam, userupdated, tglupdated,
			nvl(kdblanko, prefix || '-' || noblanko) noblanko
		  from $DBUser.tabel_248_blanko_cetak 
		  where prefixpertanggungan='$pref' and nopertanggungan='$noper'";
	
	//echo $sql;
		$DB->parse($sql);
	  $DB->execute();
?>
	<font face="Verdana" size="2"><b>Historis Cetak Polis <? echo ($PER->nopolbaru?$PER->nopolbaru:$pref.'-'.$noper);?></b></font><br>		
	<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
	<tr class="tblhead" align="center">
  	<td>KANTOR CETAK</td>
	<td>PREFIX-NO BLANKO</td>
	<td>KD STATUS</td>
	<td>KETERANGAN</td>
	<td>USER REKAM</td>
	<td>TGL REKAM</td>
	<td>USER UDPATE</td>
	<td>TGL UPDATE</td>	
	</tr>
<?	  $i=0;
	  while($res=$DB->nextrow()){
	  include "../../includes/belang.php";
		?>
		
	<td align="left" class="verdana9"><?=$res["KDKANTOR"];?></td>
	<td align="left" class="verdana9"><?=$res["NOBLANKO"];?></td>
	<td align="left" class="verdana9">
		<?
			if($res["KDSTATUS"]=='1')
				{echo "(".$res["KDSTATUS"].") "."BERHASIL";}
			else
				{echo "(".$res["KDSTATUS"].") "."GAGAL";}
		?>
	</td>
	<td align="left" class="verdana9"><?=$res["KETERANGAN"];?></td>
    <td align="left" class="verdana9"><?=$res["USERREKAM"];?></td>
	<td align="left" class="verdana9"><?=$res["TGLREKAM"];?></td>
    <td align="left" class="verdana9"><?=$res["USERUPDATED"];?></td>	
    <td align="left" class="verdana9"><?=$res["TGLUPDATED"];?></td>
	</tr>
     <? }?>
	 </table>

	  <td align="left" class="verdana9"><a href="#" onClick="window.print();">Print</a></td>
	  <td align="right" class="verdana9"><a href="#" onClick="window.close();" >Close</a></td>
</div>
</body>
</html>