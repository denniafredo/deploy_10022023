<?php
  include "../../includes/session.php"; 
  include "../../includes/common.php"; 
  include "../../includes/database.php"; 
  $DB=new database($userid, $passwd, $DBName);
  $DBC=new database($userid, $passwd, $DBName);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<SCRIPT LANGUAGE="JavaScript" SRC="js/global.js"></SCRIPT>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; }
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

#filterbox{
  border: solid 1px #c0c0c0;
	padding : 5px;
	width:100%;
	margin : 0 0 10px 0;
}
form{
  margin : 0;
	padding : 0;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript" type="text/javascript"> 
function topWindow() {
var var_id = <?php echo $idx; ?>;
var popup = window.open('daftar_cadanganx.php?id='+var_id,'Testing','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollb ars=no,resizable=no,width=600,height=500,left=350,top=200');
popup.focus();
}
</script>

<title>Untitled Document</title>
</head>


<body class="contentPage" onLoad="showLevel('_menuHistory_', <?=$sho;?>, 2);">

<form name="myform" action="<?=$PHP_SELF;?>" method="POST">	


<?

if (isset($shox)) {
 $squ="update $DBUser.tabel_223_transaksi_produk set transfer='".$pilcb."' where prefixpertanggungan='".$pfx."' and nopertanggungan='".$npr."' and kdjenisbenefit='R'";}
 //echo $squ;
 $DB->parse($squ);
 $DB->execute();
 
 //if ($act=='tfo') {
 $squ="insert into $DBUser.TABEL_CADANGAN_PREMI_ACT (ID,
                                      TGLACT,
                                      KATEGORI,
                                      EKSEKUSI,
                                      KETERANGAN) values ('".$idx."',sysdate,'".$kategori."','".$eksekusi."','test')";
									  //}
 //echo $squ;
 $DB->parse($squ);
 $DB->execute();
?>
Pilih Kantor : <select name="kantornya" size="1" onChange="GantiCari(document.getpremi)">
  <!--<option value="KP">SELURUH KANTOR</option>-->
    <? 
  $conn=ocilogon($DBUser, $DBPass, $DBName);  
  $sqlktr1="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantor='$kantor' and kdkantorinduk like '%A' order by kdkantor ASC";
  $sqlktr=ociparse($conn,$sqlktr1);
  ociexecute($sqlktr);
  while(ocifetch($sqlktr)){
  //$DB->parse($sqlktr);
  //$DB->execute();				
   //	while ($arrktr=$DB->nextrow()) {
   if(ociresult($sqlktr,"KDKANTOR")==$kantornya)
   {
	echo "<option value=".ociresult($sqlktr,"KDKANTOR")." selected>".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
	else
	{
	echo "<option value=".ociresult($sqlktr,"KDKANTOR").">".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
   }
  ?><input type="submit" name="submit" value="Cari">					
							<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
							<tr>
                            <td bgcolor="#FFBF55" align="center"> </td>
  							<td bgcolor="#FFBF55" align="center">No.</td>
                            <td bgcolor="#FFBF55" align="center">NAMA PEMEGANG POLIS</td>
							<td bgcolor="#FFBF55" align="center">JUMLAH POLIS</td>
  							</tr>
                            <?
                            
	$sql="SELECT   nopemegangpolis, (SELECT   namaklien1
								   FROM   $DBUser.tabel_100_klien
								  WHERE   noklien = nopemegangpolis)
								   namapempol, COUNT ( * ) jmlpolis
				FROM   $DBUser.TABEL_200_PERTANGGUNGAN A, $DBUser.TABEL_202_PRODUK B
			   WHERE       A.KDPRODUK = B.KDPRODUK
					   AND b.point > 0
					   AND MULAS>TO_DATE('31052013','DDMMYYYY')
					   AND KDPERTANGGUNGAN = '2'
					   and a.prefixpertanggungan='$kantornya'
			GROUP BY   nopemegangpolis";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();			
		$i = 1;
		$nr=1;
   	while ($arr=$DB->nextrow()) {
	
	
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "FFDFAA").">";
  	?>
  <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center" ALIGN="CENTER" onClick="showLevel('_menuHistory_', <?=$i;?>, 2);"><IMG src="./img/down.png" WIDTH="15" HEIGHT="15"></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["NAMAPEMPOL"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["JMLPOLIS"];?></td>
  <tr><td></td><td colspan="10">

	
												<DIV ID="_menuHistory_<?=+$i;?>" style="display:none;">
												
												
													<TABLE WIDTH="100%" align="center" border="1" style="border-collapse: collapse" bordercolor="#00509f">
													<TR align="center"><TD colspan="10">Data Polis</TD></TR>
													<TR align="center">
														<TD bgcolor="#55aaff">Nomor Polis</TD>
														<TD bgcolor="#55aaff">Produk</TD>
														<TD bgcolor="#55aaff">Premi</TD>
														<TD bgcolor="#55aaff">Point</TD>
                                                        <TD bgcolor="#55aaff">Tanggal Berlaku</TD>
                                                        <TD bgcolor="#55aaff">Tanggal Kadaluarsa</TD>
                                                        <TD bgcolor="#55aaff">Keterangan</TD>
														
													</TR>
                                                   
													  <?
  $sqlc="select NOPEMEGANGPOLIS,PREFIXPERTANGGUNGAN,
		  NOPERTANGGUNGAN,
		  KDPRODUK,
		  PREMI,
		  DECODE(PREFIXPERTANGGUNGAN,'R',-1*POINTREWARD,POINTREWARD) POINTREWARD,
		  to_char(berlaku,'dd/mm/yyyy') BERLAKU,
		  to_char(kadaluarsa,'dd/mm/yyyy') KADALUARSA,
		  KETERANGAN from $DBUser.TABEL_223_TRANSAKSI_POINT where nopemegangpolis='".$arr["NOPEMEGANGPOLIS"]."' order by berlaku";
  //echo $sqlc;
  $DBC->parse($sqlc);
  $DBC->execute();	
  $p = 0;
  while ($arrc=$DBC->nextrow()) {
  $p = $p + $arrc["POINTREWARD"];
  ?>
													
													<TR valign="top">
														<TD align="center"><?=$arrc["PREFIXPERTANGGUNGAN"].'-'.$arrc["NOPERTANGGUNGAN"];?></TD>
                                                        <TD align="center"><?=$arrc["KDPRODUK"];?></TD>
                                                        <TD align="right"><?=number_format($arrc["PREMI"],2,',','.');?></TD>
                                                        <TD align="center"><?=number_format($arrc["POINTREWARD"],2,',','.');?></TD>
														<TD align="center"><?=$arrc["BERLAKU"];?></TD>
														<TD align="center"><?=$arrc["KADALUARSA"];?></TD>
                                                        <TD align="center"><?=$arrc["KETERANGAN"];?></TD>
													</TR>
	<? }?>											
												
                                                <tr><td align="right" colspan="3"><strong>TOTAL POINT</strong></td><td align="center">
												<strong><?=number_format($p,2,',','.');?></strong></td><td colspan="3"></td>
                                                <tr><td colspan="7"><!--<IMG src="./img/Add-icon.png" WIDTH="12" HEIGHT="12">-->
                                                <? //echo "<a onclick='topWindow()' href=daftar_cadangan.php?idx=".$arr["ID"]."&kantornya=".$kantornya."&sho=$i> Tambah Data</a>";?>
                                                <!--<a href="daftar_point_reward.php?idx=<?=$arr["ID"];?>&kantornya=<?=$kantornya;?>&sho=<?=$i;?>" onClick="NewWindow('./daftar_pointx.php?id=<?=$arr["NOPEMEGANGPOLIS"];?>','popuppage','420','500','yes')"><img src="./img/error.png" height="15" width="15" border="0" alt="Tambah Data">&nbsp;Redeem Point</a>-->
                                                </td></tr>
                                                </TABLE>
												
											
												</DIV>
												</TD>
												</TR>
										<!-- END OF MASTER 1 -->
<? $i++;} ?>
											
											<!-- END OF SUB DETAIL MASTER 2 -->
						</table>
</form>
 </body>
</html>
