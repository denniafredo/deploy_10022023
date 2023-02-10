<? 
$endtime = timer();
$loadtime = $endtime - $starttime;
$loadtime = number_format($loadtime, 7);
echo "<hr size=1 color=#e1f5ff>";
echo "<div align=right><a class=verdana8blk><font color=#80c9d9>Page loaded in $loadtime seconds.</font></a></div>";
?>