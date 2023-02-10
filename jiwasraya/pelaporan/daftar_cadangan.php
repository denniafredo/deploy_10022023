<?
  include "../../includes/session.php"; 
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
  $sqlktr1="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantorinduk like '%A' order by kdkantor ASC";
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
                            <td rowspan="2" bgcolor="#89acd8" align="center"> </td>
  							<td rowspan="2" bgcolor="#89acd8" align="center">No.</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center"></td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Nama Prospek</td>
							<td rowspan="2" bgcolor="#89acd8" align="center">Bisnis</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Peserta</td>
  							<td rowspan="2" bgcolor="#89acd8" align="center">Produk</td>
                            <td colspan="2" bgcolor="#89acd8" align="center">Penawaran</td>
                            
                            <td rowspan="2" bgcolor="#89acd8" align="center">Kategori</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Asumsi Penutupan</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Kendala& Support</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Status</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Core Business</td>
                            <td rowspan="2" bgcolor="#89acd8" align="center">Eksekusi</td>
  							<td rowspan="2" bgcolor="#89acd8" align="center">Premi Transaksi</td>
                          	
  </tr>
                            <td bgcolor="#89acd8" align="center">Plan</td>
                            <td bgcolor="#89acd8" align="center">Premi</td>
                            
                          	</tr>								
							<tr><td colspan="4">
                                                <a href="#" onClick="NewWindow('./daftar_cadanganxx.php?a=porm','popuppage','420','500','yes')"><img src="./img/Add-icon.png" height="15" width="15" border="0" alt="Tambah Data">&nbsp;Tambah Data Cadangan</a>
                                                </td></tr>
                            <?
                            
$sql="select * from $DBUser.TABEL_CADANGAN_PREMI where kdkantor='$kantornya'";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();			
		$i = 1;
		$nr=1;
   	while ($arr=$DB->nextrow()) {
	
	
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
  <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center" ALIGN="CENTER" onClick="showLevel('_menuHistory_', <?=$i;?>, 2);"><IMG src="./img/download.png" WIDTH="12" HEIGHT="12"></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
    <? if ($arr["EKSEKUSI"]=='BARU') { echo "<IMG src=\"./img/warning.png\" WIDTH=\"15\" HEIGHT=\"15\">";}
	   else if ($arr["EKSEKUSI"]=='CLOSING') { echo "<IMG src=\"./img/accepted.png\" WIDTH=\"15\" HEIGHT=\"15\">";} 
	   else { echo "<IMG src=\"./img/error.png\" WIDTH=\"15\" HEIGHT=\"15\">";} ;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["PROSPEK"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["BISNIS"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["PST"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["PRODUK"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["PRODUKPLAN"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMI"],2,",",".");?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KATEGORI"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["ASUMSITUTUP"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KENDALA"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["STATUS"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["CORE"];?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["EKSEKUSI"];?></td>
  <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMITRANSAKSI"],2,",",".");?></td>
  <tr><td></td><td colspan="10">

	
												<DIV ID="_menuHistory_<?=+$i;?>" style="display:none;">
												
												
													<TABLE WIDTH="100%" align="center" border="1" style="border-collapse: collapse" bordercolor="#00509f">
													<TR align="center"><TD colspan="10">Data Historis Follow Up</TD></TR>
													<TR align="center">
														<TD bgcolor="#55aaff">Kategori</TD>
														<TD bgcolor="#55aaff">Eksekusi</TD>
														<TD bgcolor="#55aaff">Keterangan</TD>
														<TD bgcolor="#55aaff">Tanggal</TD>
                                                        <TD bgcolor="#55aaff">Premi Transaksi</TD>
														
													</TR>
                                                   
													  <?
  $sqlc="select * from $DBUser.TABEL_CADANGAN_PREMI_ACT where id='".$arr["ID"]."' order by tglact desc";
  //echo $sqlc;
  $DBC->parse($sqlc);
  $DBC->execute();	
  while ($arrc=$DBC->nextrow()) {
  ?>
													
													<TR valign="top">
														<TD align="center"><?=$arrc["KATEGORI"];?></TD>
                                                        <TD align="center"><?=$arrc["EKSEKUSI"];?></TD>
                                                        <TD align="left"><?=$arrc["KETERANGAN"];?></TD>
														<TD align="center"><?=$arrc["TGLACT"];?></TD>
														<TD align="center"><?=number_format($arrc["PREMITRANSAKSI"],2,',','.');?></TD>
													</TR>
	<? }?>											
												
                                                <tr><td colspan="5"><!--<IMG src="./img/Add-icon.png" WIDTH="12" HEIGHT="12">-->
                                                <? //echo "<a onclick='topWindow()' href=daftar_cadangan.php?idx=".$arr["ID"]."&kantornya=".$kantornya."&sho=$i> Tambah Data</a>";?><a href="daftar_cadangan.php?idx=<?=$arr["ID"];?>&kantornya=<?=$kantornya;?>&sho=<?=$i;?>" onClick="NewWindow('./daftar_cadanganx.php?id=<?=$arr["ID"];?>','popuppage','420','500','yes')"><img src="./img/Add-icon.png" height="15" width="15" border="0" alt="Tambah Data">&nbsp;Tambah Data</a>
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
