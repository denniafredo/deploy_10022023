<?
function SortNama ($page,$kd) {
	print("<font face=Verdana size=2><a href=".$page."?id=all&kode=".$kd.">All</a></font>&nbsp;");
	$aray=array();
	for($i=0; $i<26; $i++) {
	  $aray[]=chr(65+$i);
	  print("<font face=Verdana size=2><a href=".$page."?id=".$aray[$i]."&kode=".$kd.">".$aray[$i]."</a></font>&nbsp;");
	}
	print("<font face=Verdana size=2><a href=".$page."?id=all&kode=".$kd.">All</a></font>&nbsp;");
}
?>
