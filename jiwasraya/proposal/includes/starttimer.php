<?php
function timer() {
$time = explode(" ", microtime());
return $time[1] + $time[0];
}

$starttime = timer();
?> 
