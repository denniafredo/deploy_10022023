<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
	
	$DB=New database($userid, $passwd, $DBName);
	
	$prefixpertanggungan=$kantor;

	$sql = "select count(*) as jml from $DBUser.tabel_212_dok_cek_uw  where ".
			   "nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan'";
	$DB->parse($sql);
	$DB->execute();	  
	$arr=$DB->nextrow();
	$cekdok = $arr["JML"];

	if($cekdok == 0){
  	$sql  = "begin $DBUser.insdocmed('$prefixpertanggungan','$nopertanggungan'); end;";
  	$DB->parse($sql);
  	$DB->execute();
    $DB->commit();
	}
	
	header("location:http://$HTTP_HOST/$KAMP/proposal/propdoc11.php?nopertanggungan=$nopertanggungan");
?>