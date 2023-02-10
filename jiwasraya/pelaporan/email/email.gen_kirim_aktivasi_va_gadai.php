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
		$queryxx = "SELECT c.*,
					to_char(c.TGLBOOKED,'MM/YYYY') periode,
					to_char(c.TGLBOOKED,'YYYYMM') tglcari,
					e.NAMAKLIEN1,
					DECODE(e.JENISKELAMIN,'P','Ibu','L','Bapak','Bapak/Ibu') ANDA,
					alamattagih01||' '||alamattagih02 ALAMAT,
					(SELECT namakotamadya FROM $DBUser.TABEL_109_KOTAMADYA WHERE kdkotamadya = e.kdkotamadyatagih) KOTA,
					(SELECT NOACCOUNT FROM $DBUser.TABEL_700_GADAI_ACCOUNT WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) NOACCOUNT
				FROM $DBUser.PENERIMA_EMAIL_BLAST c,
					$DBUser.TABEL_200_PERTANGGUNGAN a,
					$DBUser.TABEL_100_KLIEN e
				WHERE c.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND c.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
					AND a.NOPEMEGANGPOLIS = e.NOKLIEN
					AND c.STATUS IS NULL 
					AND c.EMAIL IS NOT NULL
					AND c.ID_BLAST = '".$_GET['idblast']."'
					AND c.JENIS IN ('J') 
					AND upper(c.EMAIL) not in (select upper(karakter) from $DBUser.exception_sendemail) 
				ORDER BY c.PREFIXPERTANGGUNGAN, c.NOPERTANGGUNGAN, c.RAYONPENAGIHAN
				";
		$DBx->parse($queryxx);
		$DBx->execute();

		while ($rowxx=$DBx->nextrow()) {
			$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
			$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
			$kdkantor = $rowxx['RAYONPENAGIHAN'];
			$email = $rowxx['EMAIL'];
			$jenis = $rowxx['JENIS'];
			$periode = $rowxx['PERIODE'];
			$namaklien = $rowxx['NAMAKLIEN1'];
			$tglcari = $rowxx['TGLCARI'];
			
			$path_name = 'content_blast/Manual_Book_Pembayaran_Cicilan_Gadai_VA_BNI.pdf';
			//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
			$isipesan_new = 
				"
					<table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='782' id='AutoNumber1'>
						<tr>
							<div align='justify'> 
								<table border='0' cellspacing='1' style='border-collapse: collapse' width='100%' id='table1' cellpadding='4' bordercolor='#B3CFFF'>
			  						<tr>
										<td width='50' valign='top' class='style5'>Kepada Yth.</td>
			  						</tr>
			  						<tr>
										<td width='50' valign='top' class='style5'>".$namaklien."</td>
			 						</tr>
			  						<tr>
										<td width='50' valign='top' class='style5'>".$rowxx['ALAMAT']."</td>
			  						</tr>
			  						<tr>
										<td width='50' valign='top' class='style5'>".$rowxx['KOTA']."</td>
			  						</tr>
								</table>
	    					</div>
	    					<p align='justify'>Terimakasih atas kepercayaan ".$rowxx['ANDA']." menjadi nasabah PT Asuransi Jiwa IFG</p>
	    					<p align='justify'>Bersama ini kami sampaikan mulai bulan Januari 2020 Pembayaran Gadai hanya dapat melalui Virtual Account (VA) BNI nomor <b><i>".$rowxx['NOACCOUNT']."</i></b> </p>
							<table border='0' cellspacing='1' style='border-collapse: collapse' width='100%' id='table1' cellpadding='4' bordercolor='#B3CFFF'>
			  					<tr>
									<td width='50' valign='top' class='style5'> </td>
			  					</tr>
			  					<tr>
									<td width='50' valign='top' class='style5'>Hormat kami </td>
			  					</tr>
			  					<tr>
									<td width='50' valign='top' class='style5'>PT ASURANSI JIWA IFG</td>
			  					</tr>
							</table> 
	    					<br><br><br><br><br><br><br>    
	    					<p align='justify'><strong><u>Info Penting</u></strong> <br>
		      					<ol>
									<li>PT Asuransi Jiwa IFG tidak menerima pembayaran premi melalui petugas lapangan, di luar cara bayar resmi PT Asuransi Jiwa IFG tidak bertanggung jawab apabila terjadi hal yang tidak diinginkan
									</li>
									<li>Apabila membutuhkan informasi lebih lanjut berkaitan dengan Posisi Gadai ini atau alamat korespondensi/email/nomor handphone Anda berubah silahkan hubungi Call Center PT Asuransi Jiwa IFG 021-1500151 atau e-mail customer_service@ifg-life.co.id
									</li>
									<li>Informasi kurs transaksi Dolar Amerika dan Rupiah Dengan Index, silahkan <a href='http://www.ifg-life.co.id'>klik disini</a> 
									</li>
									<li>Informasi tata cara pembayaran gadai, silahkan <a href='http://goo.gl/mH77Fq'>klik disini</a> 
									</li>
								</ol>
	    					</p>
	  					</tr>
	  					<tr>
	    					<td style='border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1'>&nbsp;</td>
	  					</tr>
					</table>
				";

			$isipesan = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/email/email.get_cetakjatuhtempo_premi_simple.php?prefixpertanggungan='.$prefixpertanggungan.'&nopertanggungan='.$nopertanggungan.'&tglexp='.$periode.'&kantor='.$kdkantor);

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
				$mail->addAttachment($path_name);
				$mail->Subject  = "Pemberitahuan Aktivasi Gadai ".$prefixpertanggungan.'-'.$nopertanggungan. " atas nama pemegang polis ".$namaklien;
				$mail->WordWrap   = 80;
				$mail->MsgHTML($isipesan_new);
				$mail->IsHTML(true);

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
	
	
	header("Location: blast_system.php");
?>