<?php
	set_time_limit(10000001);
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
					(SELECT namakotamadya FROM $DBUser.TABEL_109_KOTAMADYA WHERE kdkotamadya = e.kdkotamadyatagih) KOTA
				FROM $DBUser.PENERIMA_EMAIL_BLAST c,
					$DBUser.TABEL_200_PERTANGGUNGAN a,
					$DBUser.TABEL_100_KLIEN e
				WHERE c.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND c.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
					AND a.NOPEMEGANGPOLIS = e.NOKLIEN
					AND c.STATUS IS NULL 
					AND c.EMAIL IS NOT NULL
					AND c.ID_BLAST = '".$_GET['idblast']."'
					AND c.JENIS IN ('Z') 
					AND upper(c.EMAIL) not in (select upper(karakter) from $DBUser.exception_sendemail) 
				ORDER BY c.PREFIXPERTANGGUNGAN, c.NOPERTANGGUNGAN, c.RAYONPENAGIHAN
				";
		//echo $queryxx;
		//exit();
		$DBx->parse($queryxx);
		$DBx->execute();

		while ($rowxx=$DBx->nextrow()) {
			$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
			$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
			$kdkantor = $rowxx['RAYONPENAGIHAN'];
			$email = $rowxx['EMAIL'];
			$email2 = $rowxx['EMAIL2'];
			$jenis = $rowxx['JENIS'];
			$periode = $rowxx['PERIODE'];
			$namaklien = $rowxx['NAMAKLIEN1'];
			$tglcari = $rowxx['PERIODE'];
			

			$path_name = 'pdf_bpo/'.date("Y").'/'.date("m").date("Y").'_SURAT_PEMBERITAHUAN_BPO_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			$form_pulih = 'content_blast/Surat Permintaan Pemulihan Polis.pdf';
			//echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';

			$DBZ	= new database($userid, $passwd, $DBName);
			$sql	= "SELECT to_char(TO_DATE ('".$tglexp."', 'DD/MM/YYYY'),'DD/MM/YYYY') sdtgl, ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, 
						ptg.nopertanggungan NOPERTANGGUNGAN, ptg.nopol,
						ptg.notertanggung,decode(ptg.indexawal,0,1,ptg.indexawal) indexawal, to_char(sysdate,'dd/mm/yyyy') tgl,
						CASE
							WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
							THEN
								PREMI2
							ELSE
								PREMI1
						END PREMI,
						premi1,premi2,
						TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
						(SELECT   TO_char(ADD_MONTHS(TO_DATE ((SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null), 'DD/MM/YYYY'),GRACEPERIODE),'DD/MM/YYYY') 
							FROM   $DBUser.TABEL_241_GRACE_PERIODE 
							WHERE   kdproduk = ptg.kdproduk) sdtglplus,
						(SELECT   TO_char(ADD_MONTHS(TO_DATE ((SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null), 'DD/MM/YYYY'),GRACEPERIODE)-1,'DD/MM/YYYY') 
							FROM   $DBUser.TABEL_241_GRACE_PERIODE 
							WHERE   kdproduk = ptg.kdproduk) sdtglak,
						(SELECT   NAMACARABAYAR
							FROM   $DBUser.TABEL_305_CARA_BAYAR
							WHERE   kdcarabayar = ptg.kdcarabayar) CARA,
						(SELECT   NAMAVALUTA
							FROM   $DBUser.TABEL_304_VALUTA
							WHERE   kdvaluta = ptg.kdvaluta) valuta,decode(ptg.kdvaluta,'1','Rp. ','0','RpI. ','$') simval,
						(SELECT   namaproduk
							FROM   $DBUser.TABEL_202_PRODUK 
							WHERE   kdproduk = ptg.kdproduk) produk, 
						(SELECT namaklien1
							FROM $DBUser.tabel_100_klien kli
							WHERE kli.noklien = ptg.nopemegangpolis) PEMPOL,
						(SELECT alamattagih01||' '||alamattagih02
							FROM $DBUser.tabel_100_klien kli
							WHERE kli.noklien = ptg.nopemegangpolis) ALAMAT,
						(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
							FROM $DBUser.tabel_100_klien kli
							WHERE kli.noklien = ptg.nopemegangpolis) anda,
						(SELECT namakotamadya
							FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
							WHERE kli.noklien = ptg.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
						(SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
						(SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null) tertunggak
					FROM $DBUser.tabel_200_pertanggungan ptg
					WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";
			//echo $sql;
			$DBZ->parse($sql);
			$DBZ->execute();
			while ($row = $DBZ->nextrow()) {
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
										<td width='50' valign='top' class='style5'>".$row["PEMPOL"]."</td>
									</tr>
									<tr>
										<td width='50' valign='top' class='style5'>".$row["ALAMAT"]."</td>
									</tr>
									<tr>
										<td width='50' valign='top' class='style5'>".$row["KOTA"]."</td>
									</tr>
								</table>
							</div>
							<p align='justify'>Pemegang Polis Yang Terhormat,</p>
							<p align='justify'>Terimakasih atas kepercayaan ".$row["ANDA"]." menjadi nasabah PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi Ibu dan keluarga.</p>
							<p align='justify'>Berikut ini adalah data Polis ".$row["ANDA"]." : </p>

							<table>
								<tr>
									<td width=350px>Nomor Polis</td>
									<td> : ".$prefixpertanggungan.$nopertanggungan."</td>
								</tr>
								<tr>
									<td>Nama Pemegang Polis</td>
									<td> : ".$row["PEMPOL"]."</td>
								</tr>
								<tr>
									<td>Jenis Produk</td>
									<td> : ".$row["PRODUK"]."</td>
								</tr>
								<tr>
									<td>Valuta</td>
									<td> : ".$row["VALUTA"]."</td>
								</tr>
								<tr>
									<td>Cara Pembayaran Premi</td>
									<td> : ".$row["CARA"]."</td>
								</tr>
								<tr>
									<td>Premi terakhir yang sudah dilunasi per</td>
									<td> : ".$row["LUNAS"]."</td>
								</tr>
								<tr>
									<td>Mulai Jatuh tempo Premi tertunggak</td>
									<td> : ".$row["TERTUNGGAK"]."</td>
								</tr>
							</table>

							<p align='justify'>Berdasarkan data tersebut di atas, saat ini Polis Bapak/Ibu dalam kondisi BPO (Bebas Premi Otomatis), sehingga terhadap kondisi polis tersebut, kami hitung ulang berdasarkan data pelunasan premi yang ada. Hasil perhitungan tersebut akan menimbulkan kondisi sebagai berikut :
								<ol>
									<li>Polis yang belum mempunyai nilai tunai, menjadi batal tanpa suatu pembayaran.</li>
									<li>Penurunan Jumlah Uang Asuransi dan secara otomatis premi lanjutan tidak kami tagih kembali. Segala manfaat asuransi yang timbul akan
										dihitung berdasarkan uang asuransi yang telah diturunkan.
									</li>
									<li>Dalam hal pembayaran Premi telah dilakukan oleh Bapak/Ibu dan atau data Polis di atas tidak sesuai serta jika ada informasi lain yang ingin Bapak/Ibu ketahui, mohon untuk dapat menghubungi Kantor PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG : (021) 1500151 atau email: customer_service@ifg-life.co.id, dengan melampirkan bukti pelunasan premi yang sah.
									</li>
									<li>
										Sesuai dengan Regulasi yang berlaku dan demi Keamanan Bapak/Ibu, PT Asuransi Jiwa IFG tidak lagi menerima pembayaran premi secara tunai melalui Petugas Kami di lapangan (Agen/Marketing). Pembayaran hanya dapat dilakukan melalui chanel resemi berikut bit.ly/bayar premi atau melaui Host to host (Mandiri/BRI/BNI/Indomaret/PT POS/ Alfa Group) /Autodebet/Virtual Accpunt, Pembayaran Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya dapat menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau email : customer_service@ifg-life.co.id.
									</li>
								</ol>
							</p>
							

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
									<li>Apabila membutuhkan informasi lebih lanjut berkaitan Pemulihan Polis atau alamat korespondensi/email/nomor handphone Anda berubah silahkan hubungi Call Center PT Asuransi Jiwa IFG 021-1500151 atau e-mail customer_service@ifg-life.co.id
									</li>
									<li>Informasi kurs transaksi Dolar Amerika dan Rupiah Dengan Index, silahkan <a href='http://www.ifg-life.co.id'>klik disini</a> 
									</li>
									<li>Informasi tata cara pemulihan polis, silahkan <a href='http://www.ifg-life.co.id'>klik disini</a> 
									</li>
								</ol>
	    					</p>
	  					</tr>
	  					<tr>
	    					<td style='border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1'>&nbsp;</td>
	  					</tr>
					</table>
				";
			}	

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
				$mail->addAttachment($form_pulih);
				$mail->Subject  = "Pemberitahuan Kondisi Polis BPO  ".$prefixpertanggungan.'-'.$nopertanggungan. " atas nama ".$namaklien;
				$mail->WordWrap   = 80;
				$mail->MsgHTML($isipesan_new);
				$mail->IsHTML(true);

				$mail->Send();
					$query = "update $DBUser.PENERIMA_EMAIL_BLAST set status = '1',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
					$DB->parse($query);
					$DB->execute();
					$row=$DB->nextrow();
			} catch (phpmailerException $e) {
					$query = "update $DBUser.PENERIMA_EMAIL_BLAST set status = 'X',tgl_kirim=sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
					$DB->parse($query);
					$DB->execute();
					$row=$DB->nextrow();
			}

			if($email != $email2){
				try {
					$mail = new PHPMailer(true);
					$body="<br> ini body";
					$mail->SMTPSecure = "";
					$mail->IsSMTP();
					$mail->SMTPAuth   = true;
					$mail->Port       = 25;
					$mail->Host       = "mail.jiwasraya.co.id";
					$mail->Username   = "admin.app@jiwasraya.co.id";
					$mail->Password   = "!@#Jiwasraya123";
					$mail->From       = "admin.app@jiwasraya.co.id";
					$mail->FromName   = "PT. Asuransi Jiwasraya (Persero)";

					$mail->AddReplyTo("no-reply@jiwasraya.co.id","Tidak Untuk Dibalas");
					$mail->AddAddress($email2);
					$mail->addAttachment($path_name);
					$mail->addAttachment($form_pulih);
					$mail->Subject  = "Pemberitahuan Kondisi Polis BPO  ".$prefixpertanggungan.'-'.$nopertanggungan. " atas nama ".$namaklien;
					$mail->WordWrap   = 80;
					$mail->MsgHTML($isipesan_new);
					$mail->IsHTML(true);

					$mail->Send();
						$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST set status2 = '1', tgl_kirim2 = sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
						$DB->parse($query);
						$DB->execute();
						$row=$DB->nextrow();
				} catch (phpmailerException $e) {
						$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST set status2 = 'X', tgl_kirim2 = sysdate WHERE PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."' AND NOPERTANGGUNGAN = '".$nopertanggungan."' AND JENIS = '$jenis' and ID_BLAST = '".$_GET['idblast']."'";
						$DB->parse($query);
						$DB->execute();
						$row=$DB->nextrow();
				}
			}

			
		}
	}
	
	header("Location: blast_system.php");
?>