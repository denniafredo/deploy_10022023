<?
function SortNama ($page) {
	$aray=array();
	for($i=0; $i<26; $i++) {
	  $aray[]=chr(65+$i);
	  printf("<font face=Verdana size=2><a href=".$page."?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
}
?>
