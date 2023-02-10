<HTML><BODY BGCOLOR=FFFFFF> 
    <?php 
      $to = 'ikdbud@yahoo.com'; 
      $from = 'belikade@yahoo.com'; 
       
        //Check if we have something POSTed by the form. 
        if (isset($HTTP_POST_VARS)){ 
            //Start with an empty body for the mail message 
            $body = ''; 
            //Iterate through all the POSTed variables, and add them to the message body. 
            while (list($key, $value) = each($HTTP_POST_VARS)){ 
                $body .= $key . ' = ' . $value . "\r\n"; 
            } 
            //Build up some nice From/Reply Headers 
            $headers = "From: $from\r\n"; 
            $headers .= "Reply-To: $from\r\n"; 
            //Mail the message out. 
            //Requires setting php.ini sendmail path as per instructions 
            $success = mail($to, "Posted " . date("m/d/Y"), $body, $headers); 
            //Always check return codes from functions. 
            if ($success){ 
                echo "<B><CENTER>Thank you for your input</CENTER></B>\n"; 
            } 
            else{ 
                echo "<CENTER><B>Internal Error</B>:  Your input was unprocessed.<BR>Contact $from</CENTER>\n"; 
            } 
        } 
    ?> 
    <FORM ACTION=formmail.php METHOD=POST> 
        <INPUT NAME=sample><BR> 
        <INPUT TYPE=SUBMIT> 
    </FORM> 
</BODY></HTML> 
