<?php
//phpinfo(); 
//die;
    /*  */
    //include '../include/config.php'; 
    //include '../include/authentication.php';
	include "../../includes/database.php";
    //require('../libs/fpdf/fpdf.php');
	include '../libs/PHPMailer/class.phpmailer.php';		
	// Instanciation of inherited class
	
	$prefixpertanggungan = $_GET['prefixpertanggungan'];
	$nopertanggungan = $_GET['nopertanggungan'];
	$kdkantor = $_GET['kdkantor'];
	
	//** GENERATE DATA DULU
	$userid='jsadm';
	$passwd='jsadmoke';
	$DB=New database($userid, $passwd, $DBName);	
	$DBx=New database($userid, $passwd, $DBName);	
	//$db = new ConnectionJL();
	//$conn = $db->Open();	
	$queryxx = "SELECT c.*,to_char(TGLBOOKED,'MM/YYYY') periode,to_char(TGLBOOKED,'YYYYMM') tglcari,
					   (select NAMAKLIEN1
						from tabel_200_pertanggungan a, TABEL_100_KLIEN b 
						where a.prefixpertanggungan = C.prefixpertanggungan 
						and a.nopertanggungan = C.nopertanggungan 
						and a.NOTERTANGGUNG = b.NOKLIEN) NAMAKLIEN	
				/*FROM $DBUser.TABLE_KIRIM_EMAIL */ 
				/*FROM $DBUser.PENERIMA_EMAIL_TES */
				FROM $DBUser.PENERIMA_EMAIL_TES c
				WHERE EMAIL IS NOT NULL 
				/*and status is null */
				and ID_BLAST = '".$_GET['idblast']."'
				and ID_AUDIENCE = '".$_GET['idaudience']."'
				and jenis in ('M','N','X','R','T','L','P') 
				/*and to_char(tgl_record,'mm/yyyy') = to_char(sysdate,'mm/yyyy')*/
				and upper(email) not in (select upper(karakter) from $DBUser.exception_sendemail) 
				order by PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN";
	//echo $queryxx;die;
	//$dbxx->Parse($queryxx);
	//$dbxx->Execute();
	$DBx->parse($queryxx);
	$DBx->execute();
	//include 'function_gen_pdf_jatuh_tempo.php';	
	//include 'function_gen_pdf_ftp_jatuh_tempo.php';	
	while ($rowxx=$DBx->nextrow()) {		
	//$db = new ConnectionJL();
	//$conn = $db->Open();	
		$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
		$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
		$kdkantor = $rowxx['RAYONPENAGIHAN'];
		$email = $rowxx['EMAIL'];
		$jenis = $rowxx['JENIS'];
		$periode = $rowxx['PERIODE'];
		$namaklien = $rowxx['NAMAKLIEN'];
		$tglcari = $rowxx['TGLCARI'];
		echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
		
		//gen_pdf($prefixpertanggungan,$nopertanggungan,$tglcari); 
		$path_name = 'pdf/'.$tglcari.'_JATUH_TEMPO_PREMI_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';		
		try {	
			$mail = new PHPMailer(true); //New instance, with exceptions enabled

			$body="<br> ini body";
			//$body             = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/get_cetakjatuhtempo_expirasi.php?prefixpertanggungan='.$rowx["PREFIXPERTANGGUNGAN"].'&nopertanggungan='.$rowx["NOPERTANGGUNGAN"].'&tglexp='.$rowx["EXPIRASI"]);
			//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
			//$mail->SMTPDebug = true;
			$mail->SMTPSecure = "";
			$mail->IsSMTP();                           // tell the class to use SMTP
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Port       = 25;                    // set the SMTP server port                  
			$mail->Host       = "mail.ifg-life.co.id"; 	
			$mail->Username   = "admin.app@ifg-life.co.id"; 	
			$mail->Password   = "!@#Jiwasraya123";
			//$mail->From       = "PT. Asuransi Jiwa IFG <postmaster@ifg-life.co.id>";
			$mail->From       = "admin.app@ifg-life.co.id";
			$mail->FromName   = "PT. Asuransi Jiwa IFG";
			//$mail->FromName   = $_SESSION['uname'].' - '.$_SESSION['nama_org'];
			


			//$mail->IsSendmail();  // tell the class to use Sendmail

			$mail->AddReplyTo("no-reply@jiwasraya.co.id","Tidak Untuk Dibalas");

			//$to = $_POST['user'];
			$to = $email;

			$mail->AddAddress($to);
			$mail->addAttachment($path_name);
			//$mail->Subject  = " ".$row['DESKRIPSI'];
			$mail->Subject  = "Pemberitahuan Jatuh Tempo Premi Polis ".$prefixpertanggungan.'-'.$nopertanggungan. " atas nama tertanggung ".$namaklien;

			//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
			$mail->WordWrap   = 80; // set word wrap
			
			//$mail->MsgHTML("</br> You Have a new memo with the title '".$row['DESKRIPSI']."'.</br>Please check it <a href='http://192.168.2.7/smart/tiket/'>here.</a></br>Under menu : Memo Administration>My Memo.</br>Thank You for Your attention...");
			//$isipesan = file_get_contents('http://192.168.5.23:8083/jiwasraya/pelaporan/email/email.get_cetakjatuhtempo_premi.php?prefixpertanggungan='.$prefixpertanggungan.'&nopertanggungan='.$nopertanggungan.'&tglexp='.$rowx["PERIODE"].'&kantor='.$kdkantor);
			//$isipesan = file_get_contents('http://192.168.5.23:8083/jiwasraya/pelaporan/email/email.get_cetakjatuhtempo_premi_simple.php?prefixpertanggungan='.$prefixpertanggungan.'&nopertanggungan='.$nopertanggungan.'&tglexp='.$periode.'&kantor='.$kdkantor);
			$isipesan = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/email/email.get_cetakjatuhtempo_premi_simple.php?prefixpertanggungan='.$prefixpertanggungan.'&nopertanggungan='.$nopertanggungan.'&tglexp='.$periode.'&kantor='.$kdkantor);
			//echo 'http://192.168.5.23:8083/jiwasraya/pelaporan/email/email.get_cetakjatuhtempo_premi.php?prefixpertanggungan='.$rowx["PREFIXPERTANGGUNGAN"].'&nopertanggungan='.$rowx["NOPERTANGGUNGAN"].'&tglexp='.$rowx["EXPIRASI"].'&kantor='.$kdkantor;
			$mail->MsgHTML($isipesan);
			//$mail->AltBody=$isipesan;	
			/*
			$mail->MsgHTML = $isipesan;
			$mail->AltBody = $isipesan;	
			*/			
			/*attach : $path, $name = "", $encoding = "base64", $type = "application/octet-stream"*/
			//$mail->AddAttachment("E:/CI/mimemessage-2009-08-11.zip","mimemessage-2009-08-11.zip","base64","application/zip");
			//$mail->AddAttachment("E:/trf_rini_mei10.pdf","trf_rini_mei10.pdf","base64","application/pdf");

			$mail->IsHTML(true); // send as HTML

			$mail->Send();
			//$mail->SMTPDebug = 4;
				//$query = "update $DBUser.TABLE_KIRIM_EMAIL set status = '1' WHERE PREFIXPERTANGGUNGAN = '".$rowx["PREFIXPERTANGGUNGAN"]."' AND NOPERTANGGUNGAN = '".$rowx["NOPERTANGGUNGAN"]."' AND JENIS = '$jenis' ";
				$query = "update $DBUser.PENERIMA_EMAIL_TES set status = '1',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
				//$query = "update $DBUser.PENERIMA_EMAIL set status = '1',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' ";
				echo $query;
				//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
				$DB->parse($query);
				$DB->execute();
				$row=$DB->nextrow();
		} catch (phpmailerException $e) {
				//$query = "update $DBUser.TABLE_KIRIM_EMAIL set status = 'X' WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' ";
				//$mail->SMTPDebug = 4;
				$query = "update $DBUser.PENERIMA_EMAIL_TES set status = 'X',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
				//$query = "update $DBUser.PENERIMA_EMAIL set status = 'X',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' ";
				echo $query;
				echo '<br><br>'.$e;
				$DB->parse($query);
				$DB->execute();
				$row=$DB->nextrow();
		}
		
		
	}
	//header("Location: detail_daftar_email.php?idblast=".$_GET['idblast']);
?>