<?php
class UsersOnline {
    var $host     = '192.168.2.10';
    var $database = 'JSDB';
    var $user     = 'JSADM';
    var $password = 'JSADM';
    var $timeoutSeconds = 60;
    var $numberOfUsers = 0;
		
    function UsersOnline() {
        $this->refresh();                                                                               
    }  
    function getNumber() {
        return $this->numberOfUsers;
    }
    function refresh($namusr="",$kantor="") {
		    global $REMOTE_ADDR, $PHP_SELF;

        $currentTime = time();
        $timeout = $currentTime - $this->timeoutSeconds;
				
				$connection = OCILogon ($this->user, $this->password, $this->database);
				$query = "insert into $DBUser.usersonline(timestamp,ip,users,kdkantor,tgl) ".
				         "values ('$currentTime','$REMOTE_ADDR','$namusr','$kantor',sysdate)";
				echo $query."<br><br>";
        $cursor = OCIParse ($connection, $query);
				$result = OCIExecute ($cursor);
				OCICommit ($connection);
				
				$query = "delete from $DBUser.usersonline where timestamp < $timeout";
				$cursor = OCIParse ($connection, $query);
				$result = OCIExecute ($cursor);
				OCICommit ($connection);

				$query = "select distinct ip,timestamp from $DBUser.usersonline where timestamp is not null";
				$cursor = OCIParse ($connection, $query);
       	$result = OCIExecute ($cursor);
			  $i=1;
				while (OCIFetchInto ($cursor, $row)){
           $ip = $row[0];
					 $tm = $row[1];
           echo "$i. $ip : $tm<br>";
        $i++;
				}
		}
}

$ol = new UsersOnline();
$ol->refresh("KAMPRETO SONTOLOYO","BH"); 
?>

