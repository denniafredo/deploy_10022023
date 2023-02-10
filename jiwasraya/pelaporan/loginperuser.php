<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/common.php";	
	include "../../includes/dateselector.php";	

	?>
	<title>Historis Login</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<a class="verdana10blk"><b>HISTORIS LOGIN <? echo $users; ?></b></a>

	<hr size="1">
		<div align="center">
		<!--<a class=verdana10blk>Page : </a>-->
<?
		$DB=new Database($userid, $passwd, $DBName);
		$sqla = "select count(users) jml from $DBUser.usersonline where users='$users'";
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
	
#------------------------------ START NAVIGASI ---------------------------
if($maju){
$total_pages = $total_pages + $lastpg;
$starthal = $total_pages - 10;
$xx=$lastpg + 10;
$linkm = $xx - 10;
} else 
if($mundur){
$total_pages = $lastpg - 20;
$starthal = $total_pages - 10;
$xx=$lastpg - 10;
$linkp = $starthal -10;
} else {
$total_pages = 11;
$starthal = 1;
$lastpg = 21;
$xx=$lastpg + 10;
}
#------------------------------------ PREV -------------------------------
if(!$linkp){
$linkp = $starthal - 10;
}
$urlp = $PHP_SELF . "?action=list&mundur=ok&lastpg=$xx&get=$linkp&users=$users"; 
if ($starthal==1){
print("<a class=verdana10blk><b>Prev</b> |</a>"); 
} else {
print("<a class=verdana10blk href=\"$urlp\" title=\"Previous Results\"><b>Prev</b></a> |&nbsp;"); 
}
#-------------------------------------------------------------------------
for ($i = $starthal; $i < $total_pages; $i++) { 
if ($mundur){
   $a = $xx + 10;
   $url = $PHP_SELF . "?action=list&mundur=ok&lastpg=$a&get=$i&users=$users"; 
} else {
   $a = $total_pages;
   $url = $PHP_SELF . "?action=list&maju=ok&lastpg=$a&get=$i&users=$users"; 
}
	if ($get==$i) {
	  	  print "<font type=Verdana color=#3825e2 size=3><b>&nbsp;$i&nbsp;</b></font> ";
  } else { 
        print(" <a class=verdana10blk href=\"$url\" title=\"Go to page $i\">&nbsp;$i&nbsp;</a> "); 
  }
}
#------------------------------------ NEXT -------------------------------
if(!$linkm){
$linkm = $starthal + 10;
}

$stop = $xx - 10;
$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm&users=$users";
if($stop > $pg){ 
  print("&nbsp;| <a class=verdana10blk><b>Next</b></a> "); 
} else {
  print("&nbsp;| <a class=verdana10blk href=\"$urln\" title=\"Next Results\"><b>Next</b></a> ");
}
#------------------------------------- END NAV ---------------------------
if($pg < 2){
 $hal = "page";
} else {
 $hal = "pages";
}
echo "<a class=verdana10blk> &nbsp;&nbsp;Total ".$pg." ".$hal."</a>";

echo "<br><br>";
if(!$get){
 $get=1;
}
 	  //$users=str_replace("`","'",$users);	
		$sql = "select * from (select floor((rownum-1)/20) + 1 k,kdkantor,users,ip,tgl, ".
		       "to_char(tgl,'DD/MM/YYYY HH24:MI:SS') tglx ".
		       "from (select kdkantor,users,ip,tgl from $DBUser.usersonline where users='$users' ".
					 "order by tgl desc)) where k='$get'";
					 //echo $sql."<br>";
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
<a class="verdana10blk" href="javascript:window.close();">Close</a>