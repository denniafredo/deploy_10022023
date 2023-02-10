<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/common.php";
	include "../../includes/dateselector.php";	

	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<a class="verdana10blk"><b>USER LAST LOGIN</b></a>

	<hr size="1">
		<div align="center">
		<!--<a class=verdana10blk>Page : </a>-->
<?
		$DB=new Database($userid, $passwd, $DBName);
		$sqla = "select count(users) jml from $DBUser.usersonline where status='1' ";
		$DB->parse($sqla);
		$DB->execute();
		$ara=$DB->nextrow();
		$jml = $ara["JML"];
		$perhal=20;   
		$pg = ceil($jml / $perhal);

		$sqlz = "select sysdate from dual";
		$DB->parse($sqlz);
	  $DB->execute();
		$arz=$DB->nextrow();
	  $jani=$arz["SYSDATE"];
		$jani=substr($jani,0,6);
	
include "../../includes/navigasi.php";	
echo "<a class=verdana10blk> &nbsp;&nbsp;Total ".$pg." pages.</a>";

echo "<br><br>";
if(!$get){
 $get=1;
}
		/*
		$sql = "select * from (select rownum k,kdkantor,users,ip,tgl,tgl as tgln from ".
		       "(select kdkantor,users,ip,to_char(tgl,'DD/MM/YYYY HH24:MI:SS') tgl ".
					 "from $DBUser.usersonline where status='1')) ".
					 "where k between $start and $end";
		*/		 
		$sql = "select * from (select floor((rownum-1)/20) + 1 k,kdkantor,users,ip,tgl, ".
		       "to_char(tgl,'DD/MM/YYYY HH24:MI:SS') tglx ".
		       "from(select kdkantor,users,ip,tgl from $DBUser.usersonline where status='1' ".
					 "order by tgl desc)) where k='$get'";
		$DB->parse($sql);
	  $DB->execute();
		$currentTime = time();
		?>
	<table border="0" cellspacing="1" cellpadding="1" width="550">
  <tr>
    <td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>NO</b></td>
		<td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>OFFICE</b></td>
		<td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>USER LOGON</b></td>
    <td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>DATE/TIME</b></td>
		<td class="verdana8blu" align="center" bgcolor="#D7EAE7"><b>IP ADDRESS</b></td>
  </tr>
		<?
		$i=1;
		while($arr=$DB->nextrow()) {
		  $tgl = $arr["TGLX"];
			$jam = $arr["JAM"];
			$ip = $arr["IP"];
			$users = $arr["USERS"];
			$kdkantor = $arr["KDKANTOR"];
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
		echo " <td class=\"verdana8blk\" align=\"center\">$tgl $jam</td>";
		echo " <td class=\"verdana8blk\">$ip</td>";
		echo "<tr>";
		$i++;
		}
	 echo "</table>";				  
	 //include "../../includes/navigasi.php";	
echo "</div>";
?>

<hr size="1">
<a class="verdana10blk" href="userslogin.php">Back</a>