<? 

$emailpengirim="jrobalian@yahoo.com";
$email="kabagtang_ia@mailxlindo.jiwasraya.co.id";
$message = "test send email isi";
	
	mail($email,"test send email",$message,"From: $emailpengirim\nReply-To: $emailpengirim\ncc: $emailpengirim\nX-Mailer: PHP/" . phpversion());
 	
echo "test email ke $email";
 ?>
