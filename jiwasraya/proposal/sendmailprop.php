<? 
echo "eh em ...";
$message="Hello Kampret";
$a=mail("lolin@bromo", "Test Mail", $message,
     "From: root@$SERVER_NAME\nReply-To: webmaster@$SERVER_NAME\nX-Mailer: PHP/" . phpversion());
?>
