<?php

include ('qr_img.php');

$image = new Qrcode();
$image->setdata("iie kasep");

$image->calculate();
//$image->output();

// or
$image->save('iiekasep4.png');

?>