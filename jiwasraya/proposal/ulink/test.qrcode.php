<?php

include "./libs/phpqrcode/qrlib.php";
define("QRCODE", "./libs/phpqrcode");
define("QRCODE_TEMP_DIR", "./libs/phpqrcode/temp");


/*QRCode engine*/
$filename = QRCODE_TEMP_DIR."/".substr(md5(md5(strtotime('now')+date("u"))), -10, 10).".png";

$errorCorrectionLevel = 'L';
$matrixPointSize = 4;
//$data = $prefix.$nopertanggungan." ".$tglCetak." ".$jamCetak." ".$userid;
$data = ('http://www.jiwasraya.co.id/scan/?q='.base64_encode('BC'.'AS'));
echo $data;
//die;
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 5);  

?>