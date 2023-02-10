<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";	
  include "../../includes/duit.php";
  include "../../includes/koneksi.php";

  $DB = new database($userid, $passwd, $DBName);
  $DC = new database($userid, $passwd, $DBName);
  $DSMS = new database($userid, $passwd, $DBName);

	if (isset($simpan)) {
	$sqlupd="update $DBUser.TABEL_100_KLIEN_ACCOUNT set noaccount='$nova' ".
				"where prefixpertanggungan||nopertanggungan='$nopol' and jenis='VA' and kdbank='BNI'";
	//echo $sqlupd;
	
	$DB->parse($sqlupd);
	$DB->execute();
	}

	$sql= "select (select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namaklien1, ".
		  "(select noaccount from $DBUser.TABEL_100_KLIEN_ACCOUNT where prefixpertanggungan=a.prefixpertanggungan 
		  and nopertanggungan=a.nopertanggungan and jenis='VA' and kdbank='BNI') va ".	
				"from $DBUser.tabel_200_pertanggungan a ".
				"where prefixpertanggungan||nopertanggungan='$nopol'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();

?>
<table border="0" width="100%" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<? echo "update_va.php?nopol=$nopol" ?>">
  <tr>
  <td colspan="4">Nomor Polis <input type="text" name="nopol" size="15" value="<?=$nopol;?>" />&nbsp;<input type="submit" name="retr" value="SUBMIT" /></td>
  </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO POLIS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG POLIS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO VA LAMA</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO VA BARU</b></font></td>
  </tr>
  <tr>
    <td align="center"><font face="Verdana" size="1"><b><?=$nopol;?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><?=$arc["NAMAKLIEN1"];?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><?=$arc["VA"];?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><input type="text" name="nova" value="<?=$arc["VA"];?>"</b></font></td>
  </tr>
  <tr>
    <td bgcolor="#C2CAED" colspan="4" align="center"><input type="submit" name="simpan" value="UPDATE" onClick="window.opener.location.reload(true);"></td>
  </tr>

</form>
</table>


