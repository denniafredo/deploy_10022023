<?php
	include "../../includes/database.php";
	include '../libs/PHPMailer/class.phpmailer.php';
	
	/** GENERATE DATA DULU **/
	$userid='jsadm';
	$passwd='jsadmoke';
	$DB=New database($userid, $passwd, $DBName);
	$DBx=New database($userid, $passwd, $DBName);

	if($_GET['delete'] == '1'){
		$sqldel = "DELETE FROM $DBUser.EMAIL_BLAST_EVENT_TESTING WHERE ID_BLAST = '".$_GET['idblast']."'";
		$DB->parse($sqldel);
		$DB->execute();

		$sqldeld = "DELETE FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = '".$_GET['idblast']."'";
		$DBx->parse($sqldeld);
		$DBx->execute();
	}else{
		$queryxx = "SELECT c.*
				FROM $DBUser.PENERIMA_EMAIL_BLAST c
				WHERE c.STATUS IS NULL 
					AND c.EMAIL IS NOT NULL
					AND c.ID_BLAST = '".$_GET['idblast']."'
					AND c.JENIS = 'H'
					AND upper(c.EMAIL) not in (select upper(karakter) from $DBUser.exception_sendemail)
				";
		
		$DBx->parse($queryxx);
		$DBx->execute();

		while ($rowxx=$DBx->nextrow()) {
			$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
			$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
			$email = $rowxx['EMAIL'];
			$jenis = $rowxx['JENIS'];
			//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
			//$isipesan_new = "<img src='content_blast/Ramadan 1441 H - Eid 01.jpg'>";

			// $isipesan = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/email/email.get_cetakjatuhtempo_premi_simple.php?prefixpertanggungan='.$prefixpertanggungan.'&nopertanggungan='.$nopertanggungan.'&tglexp='.$periode.'&kantor='.$kdkantor);

			//echo $isipesan_new;
			try {
				$mail = new PHPMailer(true);
				$body="<br> ini body";
				$mail->SMTPSecure = "";
				$mail->IsSMTP();
				$mail->SMTPAuth   = true;
				$mail->Port       = 25;
				$mail->Host       = "mail.ifg-life.co.id";
				$mail->Username   = "admin.app@ifg-life.co.id";
				$mail->Password   = "!@#Jiwasraya123";
				$mail->From       = "admin.app@ifg-life.co.id";
				$mail->FromName   = "PT. Asuransi Jiwa IFG";

				$mail->AddReplyTo("no-reply@ifg-life.co.id","Tidak Untuk Dibalas");
				$mail->AddAddress($email);
				// $mail->addAttachment($path_name);
				$mail->Subject  = " SELAMAT IDUL FITRI 1 SYAWAL 1441 HIJRIAH ";
				$mail->WordWrap   = 80;
				// $mail->MsgHTML($isipesan_new);
				$mail->IsHTML(true);
				$mail->AddEmbeddedImage('Ramadan 1441 H - Eid 01.jpg', 'EID_MUBARAK', 'Ramadan 1441 H - Eid 01.jpg');
				$mail->Body="<p> <img src=\"cid:EID_MUBARAK\"></p>";
				$mail->AltBody="";

				$mail->Send();
					$query = "update $DBUser.PENERIMA_EMAIL_BLAST set status = '1',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
					//echo $query;
					$DB->parse($query);
					$DB->execute();
					$row=$DB->nextrow();
			} catch (phpmailerException $e) {
					$query = "update $DBUser.PENERIMA_EMAIL_BLAST set status = 'X',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
					//echo $query;
					$DB->parse($query);
					$DB->execute();
					$row=$DB->nextrow();
			}	
		}
	}
	
	
	// header("Location: blast_system.php");
?>