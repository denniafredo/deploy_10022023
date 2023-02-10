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
	$sqlupd="update $DBUser.tabel_315_pelunasan_va SET selisih='$slh'".
				"where nopolis='$np' and to_char(tglbooked,'mm/yyyy')='$bln'";
	echo $sqlupd;
	//die;
	
	$DB->parse($sqlupd);
	$DB->execute();
	}

	$sql= "select nopolis,selisih,to_char(tglbooked,'DD/MM/YYYY') tglbooked ".
				"from $DBUser.tabel_315_pelunasan_va ".
				"where nopolis='$np' and to_char(tglbooked,'mm/yyyy')='$bln'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();

?>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<? echo "updateselisih.php?np=$np&bln=$bln" ?>">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO POLIS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BULAN</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>SELISIH</b></font></td>
  </tr>
  <tr>
    <td align="center"><font face="Verdana" size="1"><b><?=$np;?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><?=$bln;?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><input type="text" name="slh" value="<?=$arc["SELISIH"];?>"</b></font></td>
  </tr>
  <tr>
    <td bgcolor="#C2CAED" colspan="3" align="center"><input type="submit" name="simpan" value="SAVE" onClick="window.opener.location.reload(true);"></td>
  </tr>

</form>
</table>


