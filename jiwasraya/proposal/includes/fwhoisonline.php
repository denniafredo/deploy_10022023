<? 
$DB=New database($userid, $passwd, $DBName);	
		    
				global $REMOTE_ADDR,$userid; 
   			$exp = time() + 120; //300 seconds for 5 minutes 
   			$time = time(); 
			
$sql = "declare ". 
		     "x varchar2(30);".
				 "begin ".
				 "x := $DBUser.users_park('$REMOTE_ADDR','$userid','$kantor','$exp','$time');".
				 "dbms_output.put_line(x);".
				 "end;";
			$DB->parse($sql);
  		$DB->execute();
	//echo $sql;					 		
?>