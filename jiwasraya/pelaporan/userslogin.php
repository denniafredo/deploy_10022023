<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/common.php";
	include "../../includes/fwhoisonline.php";

	$DB=new Database($userid, $passwd, $DBName);
	  $sql = "select ".
		            "a.ip,a.users,to_char(a.tgl,'DD/MM/YYYY HH24:MI:SS') tgl,a.kdkantor, ".
								"b.namauser ".
					 "from ".
					      "$DBUser.usersonline a, ".
								"$DBUser.tabel_888_userid b ".
					 "where ".
					      "a.users=b.userid and ".
					      "a.status is null  and ".
								"a.waktu is not null and ".
								"a.timestamp is null ".
					 "order by a.kdkantor";
										//echo $sql;
 		$DB->parse($sql);
	  $DB->execute();
		$currentTime = time();
		//echo $currentTime;
	
 
		?>

	<link href="../jws.css" rel="stylesheet" type="text/css">
	<a class="verdana10blk"><b>USER ONLINE</b></a>
	<hr size="1">
	<div align="center">
	<table border="0" cellspacing="1" cellpadding="1" width="600">
  <tr>
    <td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>NO</b></td>
		<td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>OFFICE</b></td>
		<td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>USER LOGON</b></td>
    <td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>DATE/TIME</b></td>
    <td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>IP ADDRESS</b></td>
		<!--<td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>FILE</b></td>-->
  </tr>
		<?
		$i=1;
		while($arr=$DB->nextrow()) {
		  $tgl = $arr["TGL"];
			$ip = $arr["IP"];
			$users = $arr["NAMAUSER"];
			$kdkantor = $arr["KDKANTOR"];
			$dir = $arr["DIR"];
			$preip = substr($ip,0,3);
			switch ($preip){
			 case "10.": $ip = "<font color=green>$ip</font>"; break;
			 case "192": $ip = "<font color=blue>$ip</font>"; break;
			 default : $ip = "<font color=red>$ip</font>"; break;
			}
		include "../../includes/belang.php";
		//echo "<tr>";
		echo " <td class=\"verdana8blk\">$i</td>"; 
		echo " <td class=\"verdana8blk\" align=center>$kdkantor</td>";
		echo " <td class=\"verdana8blk\">$users</td>"; 
		echo " <td class=\"verdana8blk\" align=\"center\">$tgl</td>";
		echo " <td class=\"verdana8blk\"><b>$ip</b></td>";
		//echo " <td class=\"verdana8blk\"><b>$dir</b></td>";
		echo "<tr>";
		$i++;
		}
	 echo "</table>";				 
?>
</div>

<hr size="1">
<a class="verdana10blk" href="index.php">Menu Manajemen Informasi</a> &nbsp;&nbsp;&nbsp;<a class="verdana10blk" href="lastlogin.php?lihat=$lihat&start=1&end=20&page=1">User Terakhir Login</a>