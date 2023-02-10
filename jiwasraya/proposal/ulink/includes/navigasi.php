<?
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
if(!$get){
 $get=1;
}

if(!$linkp){
$linkp = $starthal - 10;
}
$urlp = $PHP_SELF . "?action=list&mundur=ok&lastpg=$xx&get=$linkp"; 
if ($starthal==1){
print("<a class=verdana10blk><b>Prev</b> |</a>"); 
} else {
print("<a class=verdana10blk href=\"$urlp\" title=\"Previous Results\"><b>Prev</b></a> |&nbsp;"); 
}
#-------------------------------------------------------------------------
for ($i = $starthal; $i < $total_pages; $i++) { 
if ($mundur){
   $a = $xx + 10;
   $url = $PHP_SELF . "?action=list&mundur=ok&lastpg=$a&get=$i"; 
} else {
   $a = $total_pages;
   $url = $PHP_SELF . "?action=list&maju=ok&lastpg=$a&get=$i"; 
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
//$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm"; 
//print("&nbsp;| <a class=verdana10blk href=\"$urln\" title=\"Next Results\"><b>Next</b></a> "); 

$stop = $xx - 10;
$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm&users=$users";
if($stop > $pg){ 
  print("&nbsp;| <a class=verdana10blk><b>Next</b></a> "); 
} else {
  print("&nbsp;| <a class=verdana10blk href=\"$urln\" title=\"Next Results\"><b>Next</b></a> ");
}
#------------------------------------- END NAV ---------------------------
?>
