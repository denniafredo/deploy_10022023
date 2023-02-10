<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB = new Database($userid, $passwd, $DBName);

if ($submit)	{
  $sql = "update $DBUser.tabel_faq set status='4' where status='3'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
//	echo $sql."<br><br>";
	
	$query = "select max(to_number(idqa)) as maxidqa from $DBUser.tabel_faq";
	$DB->parse($query);
	$DB->execute();
	$arr = $DB->nextrow();
	$maxidqa = $arr["MAXIDQA"];
	$idqa = $maxidqa + 1;		
	
	$tanya=strtoupper($tanya);
	$tanya=strip_tags(stripslashes($tanya));
	$tanya=ereg_replace("'","''",$tanya);
	$namauser=strtoupper($namauser);
	$namauser=strip_tags(stripslashes($namauser));
	$namauser=ereg_replace("'","''",$namauser);
	
	$sql = "insert into $DBUser.tabel_faq(idqa,userid,".
	       "namauser,tglmasuk,tanya,status) ".
	       "values ('$idqa','$user','$namauser',sysdate,'$tanya','3')";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
//	echo "<br>".$sql;
	echo "Informasi terbaru sudah masuk ke database Forum XL-iNdO<br><br>";
	echo "<a href=\"faq.php?start=1&end=5\">Lihat Forum XL-iNdO</a>";
		
} else {
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<div align="center">
<? 
	$query = "select tanya from $DBUser.tabel_faq where status='3'";
	$DB->parse($query);
	$DB->execute();
	$arr = $DB->nextrow();
	
 ?>
<form method="POST" name="faq" action="<? echo $PHP_SELF;?>" onSubmit="return submitForms()">
<table border="0" bgcolor="#000080" cellspacing="1" cellpadding="4" width="600">
  <tr>
    <td width="100%" class="verdana10blk">
      <p align="center"><font color="#FFFFFF"><b>ADMINISTRATOR FORUM XL-iNdO</b></font></td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#FFFFFF">
      <table border="0" width="100%" cellspacing="3">
        <tr>
          <td valign="top" align="left" class="verdana10blk">User ID</td>
          <td><input type="text" name="user" readonly size="3" value="KP"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Nama</td>
          <td><input type="text" name="namauser" size="30"></td>
        </tr>
        <tr>
          <td valign="top" align="left" class="verdana10blk">Informasi</td>
          <td><textarea rows="5" name="tanya" cols="60"><? echo $arr["TANYA"]; ?></textarea></td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="Submit" name="submit"><input type="reset" value="Reset" name="B2"><!--<input type="submit" value="Lihat FAQ" name="lihat">--></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
</div>
<hr size="1">
<? 
}
 ?>
