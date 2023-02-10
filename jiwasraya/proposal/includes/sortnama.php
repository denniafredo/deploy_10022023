<?
function SortNama ($page) {
	printf("<font face=Verdana size=2><a href=".$page."?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0; $i<26; $i++) {
	  $aray[]=chr(65+$i);
	  printf("<font face=Verdana size=2><a href=".$page."?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=".$page."?id=all>All</a></font>&nbsp;");
}
?>
