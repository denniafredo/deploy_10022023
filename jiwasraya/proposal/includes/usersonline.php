<?php

class UsersOnline {
    var $timeoutSeconds = 60;
    var $numberOfUsers = 0;
		
    function UsersOnline() {
   		$this->refresh();  
		}  

    function refresh($namusr="",$kantor="") {
		    global $REMOTE_ADDR, $PHP_SELF;

        $currentTime = time();
        $timeout = $currentTime - $this->timeoutSeconds;
				
				$connection = OCILogon ("JSADM","JSADM","JSDB");
				$query = "insert into $DBUser.usersonline(timestamp,ip,users,kdkantor,tgl,dir) ".
				         "values ('$currentTime','$REMOTE_ADDR','$namusr','$kantor',sysdate,'$PHP_SELF')";
				//echo $query."<br><br>";
        $cursor = OCIParse ($connection, $query);
				$result = OCIExecute ($cursor);
				
				$query = "update $DBUser.usersonline set status='1' where timestamp < $timeout";
				$cursor = OCIParse ($connection, $query);
				$result = OCIExecute ($cursor);
				$query = "delete from $DBUser.usersonline where users is null";
				$cursor = OCIParse ($connection, $query);
				$result = OCIExecute ($cursor);
				
		}
}
?>
