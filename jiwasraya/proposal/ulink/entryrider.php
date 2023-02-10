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
<title>Rider</title>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/window.js"></script>

</head>

<body>
<? include "./menu.php";?>
<br />
<form name="porm" action="<?echo $PHP_SELF;?>" method="post">
<div align="center">
<table border="0" cellspacing="5" class="tblisi" width="100%">
        <tr>
          
          <td width="20%"  align="left">Nomor Proposal: 
								<input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
		<input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>">
								
								</td>
          <td align="left">
					<input type="submit" name="update" value="LANJUT"></td>
		  </tr>
</table>
</br></br>
<table border="0" width="60%" bgcolor="#C0C0C0" cellspacing="1" cellpadding="1">
		<tr>
      	<td width="20%" bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">KETERANGAN RIDER</font></span></div></td>
        <td width="10%" bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">UA BENEFIT</font></span></div></td>
		<td width="10%" bgcolor="#0066CC"><div align="center"><span class="style1"><font face="Arial" size="2">TANGGAL EFEKTIF</font></span></div></td>
        </tr>
<?
if (isset($simpan)){
	$sql="insert into $DBUser.TABEL_223_TRANSAKSI_PRODUK (kdproduk,PREFIXPERTANGGUNGAN, NOPERTANGGUNGAN,KDBENEFIT, kdjenisbenefit,nilaibenefit,tglmutasi, expirasi)(select kdproduk,'$prefixpertanggungan','$nopertanggungan','".$rider."', 'R',$uarider,to_date('".$tglrider."','dd/mm/yyyy'), $DBUser.FORMULA.runy('$prefixpertanggungan','$nopertanggungan',to_date('".$tglrider."','dd/mm/yyyy'),'(DF TGLLAHIR 65)') from $DBUser.tabel_200_pertanggungan where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan')";
	echo $sql;
	$DBI->parse($sql);
    $DBI->execute();
	}
	
$sql="SELECT A.*, B.*, (select namabenefit from $DBUser.TABEL_207_KODE_BENEFIT where kdbenefit=b.kdbenefit) namabenefit, to_char(tglmutasi,'DD/MM/YYYY') TGLMUTASI, to_char(mulas,'DD/MM/YYYY') mulas FROM $DBUser.TABEL_200_PERTANGGUNGAN A, $DBUser.TABEL_223_TRANSAKSI_PRODUK B
WHERE  A.PREFIXPERTANGGUNGAN=B.PREFIXPERTANGGUNGAN AND A.NOPERTANGGUNGAN=B.NOPERTANGGUNGAN AND B.KDJENISBENEFIT='R' and
A.PREFIXPERTANGGUNGAN='$prefixpertanggungan' AND A.NOPERTANGGUNGAN='$nopertanggungan'";
$DB->parse($sql);
$DB->execute();	
//echo $sql;

while ($arc=$DB->nextrow()) {
	//echo ${'txt'.$arc["KDFUND"]};
	
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	?>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?='('.$arc["KDBENEFIT"].') '.$arc["NAMABENEFIT"];?></td>
		<td style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<div align="right"><?=number_format($arc["NILAIBENEFIT"],2,',','.');?></div></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
		<?=$arc["TGLMUTASI"];?></td>
		
		 </tr>
<?	$i++;
$tgleff=$arc["MULAS"];
}

?>
<tr><td align="center">
<?
$sqlX="select * from $DBUser.TABEL_206_PRODUK_BENEFIT a, $DBUser.TABEL_207_KODE_BENEFIT b
where a.kdbenefit=b.kdbenefit and a.kdproduk='JL4X' and b.kdjenisbenefit='R'";
$DB->parse($sqlX);
$DB->execute();	
//ECHO $sqlX;
?>
<select name="rider">
<option value="x">-- PILIH RIDER --</option>
<? while ($arr=$DB->nextrow()) {
echo "<option value=".$arr["KDBENEFIT"].">".$arr["NAMABENEFIT"]."</option>";
}
?>
</select>
</td><td align="center"><input type="text" name="uarider" size="15" /></td></td><td align="center"><input readonly="readonly" type="text" name="tglrider" size="10" value="<?=$tgleff;?>"/></td></tr>
<tr><td colspan="3" align="center"><input type="submit" name="simpan" value="SUBMIT"></td></tr>
</table>
<?
if (isset($simpan)) {
	//echo $kampret='$txt'.$arc["KDFUND"];
	//echo $$kampret;
	//echo '$txt'.$arc["KDFUND"];
	//$sql="insert into $DBUser.TABEL_UL_OPSI_FUND (prefixpertanggungan,nopertanggungan,kdfund,porsi,tglefektif) values ('$prefixpertanggungan','$nopertanggungan','EF','".$txtEF."',to_date('".$tgleff."','dd/mm/yyyy'))";
	
	}
?>
</div>
</form>
</body>
</html>
