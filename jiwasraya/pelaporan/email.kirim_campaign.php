<?php

set_time_limit(0);
//echo 'masuk ddn'; die;
    /*  */
    //include '../include/config.php'; 
    //include '../include/authentication.php';
	include "../../includes/database.php";
	include './libs/PHPMailer/class.phpmailer.php';
    require('./libs/fpdf/fpdf.php');
    

	class PDF extends FPDF
	{
	// Page header
	function Header()
	{
		// Logo
		//$this->Image('logo.png',10,6,30);
		// Arial bold 15
		//$this->SetFont('Arial','B',15);
		// Move to the right
		//$this->Cell(80);
		// Title
		//$this->Cell(30,10,'Title',1,0,'C');
		// Line break
		//$this->Ln(20);
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	}
	
	//** GENERATE DATA DULU
	$userid='JSADM';
	$passwd='JSADMOKE';
	$DB=New database($userid, $passwd, $DBName);		
	$DBx=New database($userid, $passwd, $DBName);		
	//$db = new ConnectionJL();
	//$conn = $db->Open();	
	//$queryxx = "SELECT * FROM $DBUser.TABLE_KIRIM_EMAIL_CAMPAIN_tes WHERE STATUS IS NULL";
	$queryxx = "SELECT * FROM $DBUser.TABLE_KIRIM_EMAIL_CAMPAIN WHERE STATUS IS NULL and jenis = 'H'";
	//echo $query;
	//$dbxx->Parse($queryxx);
	//$dbxx->Execute();
	$DBx->parse($queryxx);
	$DBx->execute();
	while ($rowxx=$DBx->nextrow()) {		
	//while ($rowxx = oci_fetch_array($dbxx->get_statement())) {
						
		$kdkantor = $rowxx['RAYONPENAGIHAN'];
		$email = $rowxx['EMAIL'];
		
		echo 'Kirim email ke '.$email.'<br>';
				
		try{		
			$mail = new PHPMailer(true); //New instance, with exceptions enabled

			$body="<br> ini body";
			//$body             = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/get_cetakjatuhtempo_expirasi.php?prefixpertanggungan='.$rowx["PREFIXPERTANGGUNGAN"].'&nopertanggungan='.$rowx["NOPERTANGGUNGAN"].'&tglexp='.$rowx["EXPIRASI"]);
			//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

			$mail->SMTPSecure = "";
			$mail->IsSMTP();                           // tell the class to use SMTP
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Port       = 25;                    // set the SMTP server port                  
			$mail->Host       = "mail.jiwasraya.co.id"; 	
			$mail->Username   = "postmaster@jiwasraya.co.id"; 	
			$mail->Password   = "P4ssw0rd_151";
			//$mail->From       = "PT. Asuransi Jiwasraya <postmaster@jiwasraya.co.id>";
			$mail->From       = "postmaster@jiwasraya.co.id";
			$mail->FromName   = "PT. Asuransi Jiwasraya (Persero)";
			//$mail->FromName   = $_SESSION['uname'].' - '.$_SESSION['nama_org'];
			


			//$mail->IsSendmail();  // tell the class to use Sendmail

			$mail->AddReplyTo("no-reply@jiwasraya.co.id","Tidak Untuk Dibalas");

			//$to = $_POST['user'];
			$to = $email;

			$mail->AddAddress($to);
			//$mail->addAttachment($path_name);
			//$mail->Subject  = " ".$row['DESKRIPSI'];
			$mail->Subject  = " Ucapan Selamat Idul Fitri 1438 H ";

			//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 80; // set word wrap
			
			//$mail->MsgHTML("</br> You Have a new memo with the title '".$row['DESKRIPSI']."'.</br>Please check it <a href='http://192.168.2.7/smart/tiket/'>here.</a></br>Under menu : Memo Administration>My Memo.</br>Thank You for Your attention...");
			$isipesan = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/email.get_contentcampaign.php');
			//$isipesan = "<img src='email/ucapan_tahun_baru_2017.jpg'> ";
			$mail->MsgHTML($isipesan);
					
			/*attach : $path, $name = "", $encoding = "base64", $type = "application/octet-stream"*/
			//$mail->AddAttachment("E:/CI/mimemessage-2009-08-11.zip","mimemessage-2009-08-11.zip","base64","application/zip");
			//$mail->AddAttachment("E:/trf_rini_mei10.pdf","trf_rini_mei10.pdf","base64","application/pdf");

			$mail->IsHTML(true); // send as HTML

			$mail->Send();
			$query = "update $DBUser.TABLE_KIRIM_EMAIL_CAMPAIN set status = '1',tglkirim=sysdate WHERE email ='$email' and jenis = 'H' ";
			//$query = "update $DBUser.TABLE_KIRIM_EMAIL_CAMPAIN_tes set status = '1',tglkirim=sysdate WHERE email ='$email' and jenis = 'H' ";
			echo $query;
			$DB->parse($query);
			$DB->execute();
			$row=$DB->nextrow();
		} 
		catch (phpmailerException $e) {
				$query = "update $DBUser.TABLE_KIRIM_EMAIL_CAMPAIN set status = 'X',tglkirim=sysdate WHERE email ='$email' and jenis = 'H'";
				//$query = "update $DBUser.TABLE_KIRIM_EMAIL_CAMPAIN_tes set status = 'X',tglkirim=sysdate WHERE email ='$email' ";
				echo $query;
				$DB->parse($query);
				$DB->execute();
				$row=$DB->nextrow();
		}	
  	}
?>