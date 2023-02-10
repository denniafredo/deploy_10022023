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
	$sqlupd="update $DBUser.tabel_100_klien set no_ponsel='$nohp' ".
				"where noklien='$noklien'";
	//echo $sqlupd;
	
	$DB->parse($sqlupd);
	$DB->execute();
	}

	$sql= "select namaklien1,jeniskelamin,tempatlahir,to_char(tgllahir,'DD/MM/YYYY') tgllahir,".
				"kdid,noid,pendapatan,no_ponsel,".
	      "gelar,kdagama,meritalstatus,kdpekerjaan,kdhobby,tinggibadan,beratbadan ".
				"from $DBUser.tabel_100_klien ".
				"where noklien='$noklien'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();

?>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<? echo "updateponsel.php?noklien=$noklien" ?>">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO KLIEN</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NAMA KLIEN</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO HP KLIEN</b></font></td>
  </tr>
  <tr>
    <td align="center"><font face="Verdana" size="1"><b><?=$noklien;?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><?=$arc["NAMAKLIEN1"];?></b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><input type="text" name="nohp" value="<?=$arc["NO_PONSEL"];?>"</b></font></td>
  </tr>
  <tr>
    <td bgcolor="#C2CAED" colspan="3" align="center"><input type="submit" name="simpan" value="SAVE" onClick="window.opener.location.reload(true);"></td>
  </tr>

</form>
</table>


