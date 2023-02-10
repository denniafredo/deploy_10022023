<?
function SortNama ($page,$bldp,$tgmh) {
	printf("<font face=Verdana size=2><a href=".$page."?id=all&blndpn=".$bldp."&tglmohon=".$tgmh.">All</a></font>&nbsp;");
	$aray=array();
	for($i=0; $i<26; $i++) {
	  $aray[]=chr(65+$i);
	  printf("<font face=Verdana size=2><a href=".$page."?id=".$aray[$i]."&blndpn=".$bldp."&tglmohon=".$tgmh.">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=".$page."?id=all&blndpn=".$bldp."&tglmohon=".$tgmh.">All</a></font>&nbsp;");
}
?>
