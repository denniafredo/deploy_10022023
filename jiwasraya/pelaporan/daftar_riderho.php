<?php
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
<title>Untitled Document</title>
</head>

<!--<body class="contentPage" onLoad="hideAll('_menuHistory_',2);">-->
<body class="contentPage" onLoad="showLevel('_menuHistory_', <?=$sho;?>, 2);">

<form name="myform" action="<?=$PHP_SELF;?>" method="POST">	
<?

if (isset($sho)) {
 $squ="update $DBUser.tabel_223_transaksi_produk set transfer='".$pilcb."' where prefixpertanggungan='".$pfx."' and nopertanggungan='".$npr."' and kdjenisbenefit='R'";}
 //echo $squ;
 $DB->parse($squ);
 $DB->execute();
?>
Pilih Kantor : <select name="kantornya" size="1" onChange="GantiCari(document.getpremi)">
  <!--<option value="KP">SELURUH KANTOR</option>-->
    <?php
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
  ?><input type="submit" name="submit" value="Cari"></input>								
							<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
							<tr>
                            <td bgcolor="#89acd8" align="center">No.</td>
                            <td bgcolor="#89acd8" align="center">BO</td>
							<td bgcolor="#89acd8" align="center">No. Polis</td>
                            <td bgcolor="#89acd8" align="center">Tertanggung</td>
                            <td bgcolor="#89acd8" align="center">Produk</td>
                            <td bgcolor="#89acd8" align="center">Rider</td>
                            <td bgcolor="#89acd8" align="center">+</td>
                            <td bgcolor="#89acd8" align="center">Tgl. Mulas</td>
                            <td bgcolor="#89acd8" align="center">Tgl. Expirasi</td>
                            <td bgcolor="#89acd8" align="center">Premi I </td>
                            <td bgcolor="#89acd8" align="center">Cara Bayar</td>
                          	</tr>								

										<!-- MASTER 1 -->
<?
$sql = "select ".
              "c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,d.namaproduk,b.kdproduk, max(premi1) premi1,b.KDCARABAYAR".
			  /*"(select count(a.kdjenisbenefit) from $DBUser.tabel_223_transaksi_produk where prefixpertanggungan=a.prefixpertanggungan 
and nopertanggungan=a.nopertanggungan and kdjenisbenefit='R' AND expirasi=a.expirasi) X,".*/
              //"to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.userupdated, ".
              ",to_char(b.expirasi,'DD/MM/YYYY') expirasi ".
              ",to_char(b.mulas,'DD/MM/YYYY') mulas".
			  ",(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR=b.KDCARABAYAR) CARABAYAR".
              ",count(kdbenefit) kdbenefit, (select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) tertanggung ".
             // "b.kdcarabayar,b.nopolswitch, premi1 b.premi".
          "from  ".
              //"$DBUser.tabel_223_transaksi_produk a, ".
              "$DBUser.TABEL_223_TRANSAKSI_produk a, ".
              "$DBUser.tabel_200_pertanggungan b, ".
              "$DBUser.tabel_500_penagih c, ".
              "$DBUser.tabel_202_produk d ".
          "where  ".
              "a.prefixpertanggungan=b.prefixpertanggungan  ".
              "and a.nopertanggungan=b.nopertanggungan ".
              //"--and a.status='0' ".
              "and b.nopenagih=c.nopenagih ".
              "and b.kdstatusfile in ('1')  ".
              "and b.kdproduk=d.kdproduk ".
              "and b.kdpertanggungan='2' ".
			  //"and c.kdrayonpenagih='$kantor' and substr(a.kdproduk,1,3) in ('JL2','JL3') ".
			  "and c.kdrayonpenagih='$kantornya' and a.kdproduk in ".
			  "(select kdproduk from $DBUser.TABEL_202_PRODUK where ".
			  "kdproduk LIKE 'JL%' UNION select KDPRODUK from $DBUser.TABEL_202_PRODUK where kdproduk like 'JS%' ".
			  "and status is null and kdproduk not in ('JSAEP','JSAP1','JSAP2','JSPEI5') AND NAMAPRODUK NOT LIKE 'JS%PLAN%') ".
			  "AND a.KDBENEFIT NOT IN ('BNFCRIL', 'JMNKEC','GADPOL') ".
			  "and kdjenisbenefit='R' ".
              //"and a.kdbenefit='BNFTOPUPSG'  ".
				//			$filtercari.
              //"and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ".
			  "group by c.kdrayonpenagih,b.prefixpertanggungan,b.nopertanggungan,d.namaproduk,b.kdproduk, b.notertanggung, b.mulas, b.expirasi, b.kdcarabayar ".
					"order by c.kdrayonpenagih";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();			
		$i = 1;
		$nr=1;
   	while ($arr=$DB->nextrow()) {
	
	
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDRAYONPENAGIH"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["TERTANGGUNG"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDPRODUK"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDBENEFIT"];?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center" ALIGN="CENTER" onClick="showLevel('_menuHistory_', <?=$i;?>, 2);"><IMG src="./img/Add-icon.png" WIDTH="12" HEIGHT="12"></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["MULAS"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["EXPIRASI"];?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["PREMI1"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["CARABAYAR"];?></td>
  </tr>
  <tr><td></td><td colspan="10">

	
												<DIV ID="_menuHistory_<?=+$i;?>" style="display:none;">
												
												
													<TABLE WIDTH="100%" align="center" border="1" style="border-collapse: collapse" bordercolor="#00509f">
													<TR align="center"><TD colspan="10">Data Rider <?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></TD></TR>
													<TR align="center">
														<TD bgcolor="#55aaff">Rider</TD>
														<TD bgcolor="#55aaff">Benefit</TD>
														<TD bgcolor="#55aaff">Premi</TD>
														<TD bgcolor="#55aaff">Mulai</TD>
														<TD bgcolor="#55aaff">Sampai</TD>
														<TD WIDTH="7%" bgcolor="#55aaff">Cara Bayar</TD>
                                                        <TD colspan="2" bgcolor="#55aaff">Update Cara Bayar Rider 
                                                        </TD>						
													</TR>
                                                    <tr><td colspan="6"></td><td align="center"><? //echo "<a href=daftar_riderx.php?mode=edit&sho=$i&pilcbx=".$pilcb."><img onclick='myform.submit();' alt='Simpan Perubahan Cara Bayar' border='0' src='./img/save.png' width='17' height='17' alt='Update'>Tahunan</a>";
													echo "<a href=daftar_riderx.php?pfx=".$arr["PREFIXPERTANGGUNGAN"]."&npr=".$arr["NOPERTANGGUNGAN"]."&sho=$i&pilcb=4>Tahunan</a>"?></td>
                                                    &nbsp;&nbsp;<? echo "<td align='center'><a href=daftar_riderx.php?pfx=".$arr["PREFIXPERTANGGUNGAN"]."&npr=".$arr["NOPERTANGGUNGAN"]."&sho=$i&pilcb=".$arr["KDCARABAYAR"].">Sesuai CB</a>"?></td>
                                                    </tr>
													  <?
  $sqlc="select a.*,b.*, to_char(a.tglmutasi,'dd/mm/yyyy') tglmutasi,  to_char(a.expirasi,'dd/mm/yyyy') expirasi ".
   ",(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR=a.KDCBANUITAS) CARABAYAR ".
   ",(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR=a.TRANSFER) CARABAYARU ".
  "from $DBUser.tabel_223_transaksi_produk a, $DBUser.TABEL_207_KODE_BENEFIT b
 WHERE   a.kdbenefit=b.kdbenefit and prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and a.kdjenisbenefit='R'";
  //echo $sqlc;
  $DBC->parse($sqlc);
  $DBC->execute();	
  while ($arrc=$DBC->nextrow()) {
  ?>
													
													<TR valign="top">
														<TD ><?=$arrc["KDBENEFIT"].' - '.$arrc["NAMABENEFIT"];?></TD>
														<TD align="right" ><?=number_format($arrc["NILAIBENEFIT"],2,",",".");?></TD>
														<TD align="right"><?=number_format($arrc["PREMI"],2,",",".");?></TD>
														<TD align="center"><?=$arrc["TGLMUTASI"];?></TD>
														<TD align="center"><?=$arrc["EXPIRASI"];?></TD>
                                                        <TD align="right"><?=$arrc["CARABAYAR"];?></TD>
                                                        <td align="center" colspan="2"><?=$arrc["CARABAYARU"];?>
                                                        </td>
													</TR>
	<? }?>											
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
