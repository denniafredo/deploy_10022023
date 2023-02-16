<?php
$dir="";
$filename=base64_decode($_GET['file']);
$file_path=$dir.$filename;

//$namefile = str_replace('https://aims.ifg-life.id/api/jsspaj/assets/web/upload/recording_welcoming_call/', '', $file_path);
//Clear the cache
clearstatcache();

// Configure.
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$namefile."\"");

// Actual download.
readfile($file_path);
exit;
?>