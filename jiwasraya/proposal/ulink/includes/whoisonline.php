<? 
  $DB=New Database($userid,$passwd,$DBName);	
	global $REMOTE_ADDR,$userid; 
   			$exp = time() + 300; //300 seconds for 5 minutes 
   			$time = time(); 
	
	$sql="select count(ip) as ip from $DBUser.usersonline where ".
	     "ip='$REMOTE_ADDR' and status is null and waktu is not null";
	$DB->parse($sql);
	$DB->execute();
  $ars=$DB->nextrow();
	$ip=$ars["IP"];

  if ($ip > 0) { 
	    $sqlz="update $DBUser.usersonline set tgl=sysdate,".
			 			"waktu='$exp',users=user,kdkantor='$kantor' ".
						"where ip='$REMOTE_ADDR' and status is null";
	} else {
	    $sqlz="insert into $DBUser.usersonline (ip,users,kdkantor,waktu,tgl) values ".
			 			"('$REMOTE_ADDR',user,'$kantor','$exp',sysdate)";
	}
	$DB->parse($sqlz);
	$DB->execute();
	$DB->commit();
	
	$sqly="update $DBUser.usersonline set status='1' where ".
 				"'$time' > waktu and waktu is not null";
 	$DB->parse($sqly);
	$DB->execute();
	$DB->commit();
?>