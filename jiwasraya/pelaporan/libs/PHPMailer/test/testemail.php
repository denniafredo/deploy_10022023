<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	//$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->SMTPSecure = "";
	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port                  
	$mail->Host       = "mail.jiwasraya.co.id"; 	
	$mail->Username   = "postmaster@jiwasraya.co.id"; 	
	$mail->Password   = "P4ssw0rd_151";
	$mail->From       = "PT. Asuransi Jiwasraya <postmaster@jiwasraya.co.id>";
	$mail->FromName   = "PT. Asuransi Jiwasraya";


	//$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("helpdesk.ti@jiwasraya.co.id","First Last");

	$to = "bagus@jiwasraya.co.id";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap
	$mail->MsgHTML("Hanya test email saja");
			
	/*attach : $path, $name = "", $encoding = "base64", $type = "application/octet-stream"*/
	//$mail->AddAttachment("E:/CI/mimemessage-2009-08-11.zip","mimemessage-2009-08-11.zip","base64","application/zip");
	//$mail->AddAttachment("E:/trf_rini_mei10.pdf","trf_rini_mei10.pdf","base64","application/pdf");

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo 'Message has been sent.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();
}
?>