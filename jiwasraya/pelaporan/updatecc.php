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
	$sqldel="DELETE $DBUser.TABEL_100_KLIEN_ACCOUNT WHERE 
					 prefixpertanggungan = '$pfx'
                     AND nopertanggungan = '$np'
					 AND JENIS='CC' AND 
					 /*KDBANK='BNI' commented karena tidak termasuk primary key by salman 25/09/2015*/					 
					 ";
	//echo $sqldel;
	
	$DB->parse($sqldel);
	$DB->execute();
	
	$sqlins="INSERT INTO $DBUser.TABEL_100_KLIEN_ACCOUNT (PREFIXPERTANGGUNGAN,
                                     NOPERTANGGUNGAN,
                                     STATUS,
                                     JENIS,
                                     KDBANK,
                                     CABANGBANK,
                                     NOACCOUNT,
                                     TGLEXPIRASI,
                                     TGLREKAM,
                                     USERREKAM,
                                     KETERANGAN)
				  VALUES   ('$pfx',
							'$np',
							'0',
							'CC',
							'BNI',
							null,
							'$ccn',
							to_date('$jt','dd/mm/yyyy'),
							sysdate,
							user,
							upper('$nm'))";

	//echo $sqlins;
	//die;
	$DB->parse($sqlins);
	$DB->execute();
	}

	$sql= "SELECT  noaccount, keterangan, to_char(tglexpirasi,'dd/mm/yyyy') exp FROM $DBUser.TABEL_100_KLIEN_ACCOUNT WHERE 
					 prefixpertanggungan = '$pfx'
                     AND nopertanggungan = '$np'
					 AND JENIS='CC' AND KDBANK='BNI'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();

?>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<? echo "updatecc.php?ccn=$ccn&pfx=$pfx$noklien&np=$np" ?>">
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>NO. CC</b></font></td>
    <!--td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>KODE BANK</b></font></td-->
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>EXPIRED DATE</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>CARD HOLDER</b></font></td>
  </tr>
  <tr>
    <td align="center"><font face="Verdana" size="1"><b><?=$ccn?></b></font></td>
    <!--td align="center"><font face="Verdana" size="1"><b>
	<select>
		<option value="CBN">PENAGIH CREDIT CARD BNI</option>
		<option>x</option>
		<option>x</option>
	</select>
	</b></font></td-->
    <td align="center"><font face="Verdana" size="1"><b><input size="15" type="text" name="jt" value="<?=$arc["EXP"];?>"</b></font></td>
    <td align="center"><font face="Verdana" size="1"><b><input size="15" type="text" name="nm" value="<?=$arc["KETERANGAN"];?>"</b></font></td>
  </tr>
  <tr>
    <td bgcolor="#C2CAED" colspan="3" align="center"><input type="submit" name="simpan" value="SAVE" onClick="window.opener.location.reload(true);"></td>
  </tr>

</form>
</table>


