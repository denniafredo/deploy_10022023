<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=new Database($userid,$passwd,$DBName);
	$prefixpertanggungan = $kantor;

	$sql="begin $DBUser.move4upd('$prefixpertanggungan','$nopertanggungan'); end;";
	$DB->parse($sql);
	$DB->execute();
	header("location:http://$HTTP_HOST/jiwasraya/proposal/qrypolis.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$kantor");
		//header("location:http://$HTTP_HOST/jiwasraya/proposal/propmtc11.php?nopertanggungan=$nopertanggungan");
	/*	exit;
	} else if ($modeopr=="query") {
		header("location:http://$HTTP_HOST/jiwasraya/proposal/dispprop.php?noproposal=$nopertanggungan");
		exit;
	}
	echo "hal. jumptopolis.php";
	*/
?>	
