<?
  include "./includes/database.php"; 
  include "./includes/session.php"; 
  include "./includes/common.php";
  $DB = new database($userid, $passwd, $DBName);
  $DBI = new database($userid, $passwd, $DBName);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Porsi Fund</title>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/window.js"></script>

</head>

<body>
<form name="porm" action="<?echo $PHP_SELF;?>" method="post">
<? include "./menu.php";?>
<div align="center">
<br />
<table border="0" cellspacing="5" class="tblisi" width="100%">
        <tr>
          
          <td width="20%"  align="left">Nomor Proposal : 
								<input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
		<input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>">
								
								</td>
          <td  align="left">
					<input type="submit" name="update" value="LANJUT"></td>
		  </tr>
</table>
</br></br>
<table border="0" width="60%" bgcolor="#C0C0C0" cellspacing="1" cellpadding="1">
		<tr>
      	<td width="20%" bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">KETERANGAN</font></span></div></td>
        <td width="10%" bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">PORSI (%)</font></span></div></td>
		<td width="10%" bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">TANGGAL EFEKTIF</font></span></div></td>
        </tr>
<?
$sqlX="SELECT A.*, B.*, to_char(mulas,'DD/MM/YYYY') MULAS FROM $DBUser.TABEL_200_PERTANGGUNGAN A, $DBUser.TABEL_UL_KODE_FUND B
WHERE  
A.PREFIXPERTANGGUNGAN='$prefixpertanggungan' AND A.NOPERTANGGUNGAN='$nopertanggungan'";
$DB->parse($sqlX);
$DB->execute();	


while ($arc=$DB->nextrow()) {
	//echo ${'txt'.$arc["KDFUND"]};
	if (isset($simpan)){
	$sql="insert into $DBUser.TABEL_UL_OPSI_FUND (select '$prefixpertanggungan','$nopertanggungan','".$arc["KDFUND"]."','". ${'txt'.$arc["KDFUND"]}."',to_date('".$arc["MULAS"]."','dd/mm/yyyy'),0, sysdate,'$userid',null,null from dual)";
	//echo $sql;
	$DBI->parse($sql);
    $DBI->execute();
	}
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?=$arc["NAMAFUND"];?></td>
		<td style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<div align="center"><input type="text" name="<?='txt'.$arc["KDFUND"];?>" size="4" value="<?=${'txt'.$arc["KDFUND"]};?>" />
        <? //echo '<input type="text" name="txt[$i]"} value="'.$i.$arc["KDFUND"].'" />'; ?>
        &nbsp;%</div></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?=$arc["MULAS"];?></td>
		
		 </tr>
<?	$i++;
$tgleff=$arc["MULAS"];
}

?>
<tr><td colspan="3" align="center"><input type="submit" name="simpan" value="SUBMIT"></td></tr>
</table>
<?
if (isset($simpan)) {
	//echo $kampret='$txt'.$arc["KDFUND"];
	//echo $$kampret;
	//echo '$txt'.$arc["KDFUND"];
	//$sql="insert into $DBUser.TABEL_UL_OPSI_FUND (prefixpertanggungan,nopertanggungan,kdfund,porsi,tglefektif) values ('$prefixpertanggungan','$nopertanggungan','EF','".$txtEF."',to_date('".$tgleff."','dd/mm/yyyy'))";
	$sql="insert into $DBUser.TABEL_UL_OPSI_FUND (select '$prefixpertanggungan','$nopertanggungan','BF','".$txtBF."',to_date('".$tgleff."','dd/mm/yyyy'),0, sysdate,'$userid',null,null from dual
union
select '$prefixpertanggungan','$nopertanggungan','EF','".$txtEF."',to_date('".$tgleff."','dd/mm/yyyy'),0, sysdate,'$userid',null,null from dual
union
select '$prefixpertanggungan','$nopertanggungan','FF','".$txtFF."',to_date('".$tgleff."','dd/mm/yyyy'),0, sysdate,'$userid',null,null from dual
union
select '$prefixpertanggungan','$nopertanggungan','MM','".$txtMM."',to_date('".$tgleff."','dd/mm/yyyy'),0, sysdate,'$userid',null,null from dual)";
	//echo $sql;
	//$DBI->parse($sql);
    //$DBI->execute();
	//echo 'insert into '.$txtBF;
	//echo 'insert into '.$txtFF;
	//echo $_POST['$txt'.$arc["KDFUND"]];
	//echo "\'$txt".$arc["KDFUND"]."\'";
	//echo "<td>".$txt["BF"]."</td>";
	}
?>
</form>
</div>
</body>
</html>
