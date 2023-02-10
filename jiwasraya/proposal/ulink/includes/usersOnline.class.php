<?php
/*
usersOnline.class.php
Author: Ilir Fekaj
Contact: tebrino@hotmail.com
Date: December 21, 2003
Latest version & info: http://www.free-midi.org/scripts/
Demo: http://www.free-midi.org

This very simple class enables you to track number of visitors online in
an easy and accurate manner. It's free for all purposes, just please don't
claim you wrote it. If you have any problems, please feel free to contact me.
Also if you use it, please send me the page URL.

Example usage:

include_once ("usersOnline.class.php");
$visitors_online = new usersOnline();

if ($visitors_online->count_users() == 1) {
	echo "There is " . $visitors_online->count_users() . " visitor online";
}
else {
	echo "There are " . $visitors_online->count_users() . " visitors online";
}

Important: You need to create database connection and select database before creating object!
--------------------------------------------
Table structure:
CREATE TABLE `useronline` (
  `id` int(10) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '',
  `timestamp` varchar(15) NOT NULL default '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id`(`id`)
) TYPE=MyISAM COMMENT='' AUTO_INCREMENT=1 ;

*/

class usersOnline {

	//var $timeout = 1500; //600
	var $timeout = 600;
	var $count = 0;
	var $userid;
	var $kantor;
	
	function usersOnline ($userid,$kantor) {
		$this->timestamp = time();
		$this->ip = $this->ipCheck();
		$this->new_user($userid,$kantor);
		$this->delete_user();
		$this->count_users();
		
		$this->userid = $userid;
		$this->kantor = $kantor;
	}
	
	function ipCheck() {
	/*
	This function checks if user is coming behind proxy server. Why is this important?
	If you have high traffic web site, it might happen that you receive lot of traffic
	from the same proxy server (like AOL). In that case, the script would count them all as 1 user.
	This function tryes to get real IP address.
	Note that getenv() function doesn't work when PHP is running as ISAPI module
	*/
		if (getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif (getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_X_FORWARDED')) {
			$ip = getenv('HTTP_X_FORWARDED');
		}
		elseif (getenv('HTTP_FORWARDED_FOR')) {
			$ip = getenv('HTTP_FORWARDED_FOR');
		}
		elseif (getenv('HTTP_FORWARDED')) {
			$ip = getenv('HTTP_FORWARDED');
		}
		else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	function new_user($userid,$kantor) {
	  $qry = "INSERT INTO useronline(timestamp, ip, userid, kdkantor,tanggal) VALUES ('$this->timestamp', '$this->ip', '$userid', '$kantor',sysdate())";
		$insert = mysql_query ($qry);
	}
	
	function delete_user() {
		$delete = mysql_query ("DELETE FROM useronline WHERE timestamp < ($this->timestamp - $this->timeout)");
	}
	
	function count_users() {
		$count = mysql_num_rows ( mysql_query("SELECT DISTINCT ip FROM useronline"));
		return $count;
	}

}
?>