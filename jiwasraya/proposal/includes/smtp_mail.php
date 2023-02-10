<?
  class smtp_mail {
	  var $fp = false;
		var $lastmsg = "";
		
		function read_line() {
		  
			$ret = false;
			
			$line = fgets($this->fp,1024);
			
			if (ereg("^([0-9]+).(.*)$",$line,&$data)) {
			  $recv_code = $data[1];
				$recv_msg = $data[2];
				
				$ret = array($recv_code,$recv_msg);
			}
		  
			return $ret;
		}
	  
		function dialogue($code,$cmd) {
		  $ret = true;
			
			fwrite($this->fp,$cmd,"\r\n");
			
			$line = $this->read_line($this->fp);
			
			if ($line == false) {
			  $ret = false;
				$this->lastmsg = "";
			} else {
			  $this->lastmsg = "$line[0] $line[1]";
				
				if ($line[0] != $code) {
				  $ret = false;
				}
			}
			return $ret;
		}
		
		function error_message() {
		  echo "SMTP protocol failure (".$this->lastmsg.").<br>";
		}
		
		function crlf_encode($data) {
		  $data .= "\n";
			$data = str_replace("\n","\r\n",$str_replace("\r","",$data));
			$data = str_replace("\n.\r\n","\n. \r\n",$data);
			
			return $data;
		}
		
		function handle_e_mail($from,$to,$data) {
		  $rcpts = explode(",",$to);
			
			$err = false;
			if(!$this->dialogue(250,"HELO phpclient" ) ||
			   !$this->dialogue(250,"MAIL FROM:$from")) {
			  $err = true;
			}
			
			for ($i=0;!$err && $i < count($rcpts); $i++) {
			  if (!$this->dialogue(250,"RCPT TO:$rcpts[$i]")) {
				  $err = true;
				}
			}
			
			if ($err || !$this->dialogue(354,"DATA") || !fwrite($this->fp,$data) ||
			    $this->dialogue(250,".") || !$this->dialogue(221,"QUIT")) {
					  $err = true;
			}
			
			if ($err) {
			  $this->error_message();
			}		
			
			return !$err;
		}
		
		function connect($hostname) {
		  $ret = false;
			
			$this->fp = fsockopen($hostname,25);
			
			if($this->fp) {
			  $ret = true;
			}
			
			return $ret;
		}
		
		function send_e_mail($hostname, $from,$to,$data,$crlf_encode=0) {
		  if(!$this->connect($hostname)) {
			  echo "cannot open socket<br>\n";
				return false;
			}
			
			$line = $this->read_line();
			$ret = false;
			
			if ($line && $line[0] == "220") {
			  if($crlf_encode) {
				  $data = $this->crlf_encode($data);
				}
				$ret = $this->handle_e_mail($from,$to,$data);
			} else {
			  $this->error_message();
			}
			fclose($this->fp);
			
			return $ret;
		}
	}
?>