<? 
  $DB = new database($userid, $passwd, $DBName);
	
  $timeoutSeconds = 120;
  $currentTime = time();
  $timeout = $currentTime - $this->timeoutSeconds;	
	
  $sql = "delete from $DBUser.usersonline where timestamp < $timeout";
  $DB->parse($sql);
	$DB->execute();
	$DB->commit();
	
	$sql = "insert into $DBUser.usersonline values ".
	       "(sysdate,'$REMOTE_ADDR','$PHP_SELF','$namusr','$kantor','$currentTime')";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	?>
