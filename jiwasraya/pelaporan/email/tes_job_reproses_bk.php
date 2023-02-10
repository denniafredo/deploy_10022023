<?php 
 
 include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";
	include "../../includes/fungsi.php";
	
$DB1 = New Database($DBUser, $DBPass, $DBName);
  $DB2 = New Database($DBUser, $DBPass, $DBName);
  $DB3 = New Database($DBUser, $DBPass, $DBName);

$updateselesai="insert into $DBUser.LOG_QUERY values ('salman',to_char(sysdate,'dd/mm/yyyy hh:mi:ss'))";
    //echo $updateselesai."<br />";
    $DB2->parse($updateselesai);	
    $DB2->execute();

//akhir sms tagihan premi
//}

// sms Idulfitri 2018

// akhir sms Idulfitri 2018

?>
