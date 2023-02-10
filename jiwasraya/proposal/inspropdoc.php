<?
  include "../../includes/database.php";
	include "../../includes/session.php";
  $DB=new database($userid, $passwd, $DBName);
	for($i=0;$i<$numofdoc;$i++) {
	  $sql="begin SP_212_DOK_CEK_UW_UID('I','$kantor','$noproposal','$kddokunderwriting[$i]',$kdstatusunderwriting[$i],'','',''); end;";
		$DB->parse($sql);
		$DB->execute();
	}
	$DB->commit();
	echo "<a href=\"qrypropdoc.php?$SID\">query proposal document</a>";
?>
