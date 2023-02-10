<?php
	include "../../includes/class.phpmailer.php";
	include "../../includes/session.php";
	include "../../includes/database.php";
	$DB = New database($userid, $passwd, $DBName);

	$prefixpertanggungan	= 'JE';
	$nopertanggungan		= '002454442';
	$kategoripending_		= 'Proses Underwriting';
	$keterangan 			= 'dikenakan ekstra premi krn resiko pekerjaan';
	
	$mail = new PHPMailer; 
	$mail->IsSMTP();
	$mail->SMTPSecure = ''; 
	$mail->Host = "mail.jiwasraya.co.id"; //host masing2 provider email
	//$mail->SMTPDebug = 2;
	$mail->Port = 25;
	$mail->SMTPAuth = true;
	$mail->SMTPDebug  = 1;
	// $mail->Username = "admin.app@jiwasraya.co.id"; //user email
	// $mail->Password = "!@#Jiwasraya123"; //password email
	$mail->Username = "underwriting@jiwasraya.co.id"; //user email
	$mail->Password = "Jiwa.160!"; //password email

	//Fungsi untuk menentukan siapa user yang melakukan pending
	// $sql = "SELECT * FROM $DBUser.TABEL_888_USERID
	// 		WHERE KDKANTOR = 'KP'
	// 			AND STATUS = '0'
	// 			AND USERID = '$userid'
	// 		";
	// $DB->parse($sql);
 //  	$DB->execute();
	// while ($arrx=$DB->nextrow()) {
	// 	$mail->SetFrom($arrx['EMAIL'], $arrx['NAMAUSER']);  //Tujuan email
	// }

	$mail->SetFrom("underwriting@jiwasraya.co.id","Underwriting KP"); //set email pengirim
	$mail->Subject = "Pending Proposal ".$prefixpertanggungan.'-'.$nopertanggungan." "; //subyek email
	

	//Fungsi untuk memanggil daftar penerima email (Kantor Cabang)
	// $sql = "SELECT * FROM $DBUser.TABEL_888_USERID
	// 		WHERE KDKANTOR = 'KP'
	// 			AND STATUS = '0'
	// 			AND USERID IN ('TEGUH_NB')
	// 		";

	$sql = "SELECT b.kdkantor, a.userid, b.namauser, b.email, b.status, b.jabatan
			FROM $DBUser.WUSER_ROLE a,
				$DBUser.TABEL_888_USERID b
			WHERE a.kdmodul = '2SC'
				AND b.kdkantor = '".$prefixpertanggungan."'
				AND a.userid = b.userid
				AND b.status= '0'
				AND b.JABATAN NOT IN ('KABAG', 'INSTRUKTUR')
				AND b.jabatan NOT LIKE ('%SAM%')
			";
			
  	$DB->parse($sql);
  	$DB->execute();
	while ($arr=$DB->nextrow()) {
		$mail->AddAddress($arr['EMAIL'], $arr['NAMAUSER']);  //Tujuan email
	}

	//Fungsi untuk memanggil daftar cc email (Bagian Underwriting)
	$sql = "SELECT a.userid, b.namauser, b.email, b.status
			FROM $DBUser.WUSER_ROLE a,
			$DBUser.TABEL_888_USERID b
			WHERE a.kdmodul = 'AAL'
				AND a.userid = b.userid
				AND b.status= '0'
			";
	$DB->parse($sql);
	$DB->execute();
	while ($arry=$DB->nextrow()) {
		$mail->AddCC($arry['EMAIL'], $arr['NAMAUSER']); //Tujuan CC email
	}
	$mail->AddCC('teguh.budi@jiwasraya.co.id', 'Teguh Budi W'); //Tujuan CC email

	$mail->MsgHTML("
		<table border='0' cellspacing='1' cellpadding='2'>
			<tr>
				<td colspan='2'>Dengan Hormat,</td>
			</tr>
			<tr>
				<td colspan='2'>Sehubungan dengan adanya permintaan approve SPAJ, maka bersama ini kami sampaikan pending proposal sebagai berikut:</td>
			</tr>
			<tr>
				<td width='100px'><b>- Nomor Proposal</b></td>
				<td>: ".$prefixpertanggungan."-".$nopertanggungan."</td>
			</tr>
			<tr>
				<td><b>- Kategori Pending</b></td>
				<td>: ".$kategoripending_."</td>
			</tr>
			<tr>
				<td><b>- Keterangan Pending</b></td>
				<td>: ".$keterangan."</td>
			</tr>
			<tr>
				<td colspan='2' style='font-size: 18px;'><i>Catatan:</i></td>
			</tr>
			<tr>
				<td colspan='2'>
					Perlu kami sampaikan juga beberapa poin-poin yang sering menjadi penghambat proses approval <b><i>'untuk menjadi perhatian'</i></b> :
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					1.	Wajib SAE dan pastikan terupload.
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					2.	Cek kembali hasil sae setelah melakukan SAE hasil harus jelas, lengkap dan berurutan (contoh : eKTP yang buram dapat di sae berwarna).
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					3.	Cek SPAJ harus lengkap terisi sesuai data CPP/ CTT jangan sampai ada yang kosong.
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					4.	Cek setiap koreksi/ coretan/ penebalan, apakah sudah ditandatangani CPP (tidak boleh paraf) SPAJ yang telah di tipex-tipex wajib diganti.
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					5.	Cek terlebih dahulu proposal dengan SPAJ, KTP dan dokumen lainnya sebelum send email.
				</td>
			</tr>
		</table>
	");
	if($mail->Send()){
		echo "Message has been sent";
	}else{
		echo "Failed to sending message";
	}
?>
