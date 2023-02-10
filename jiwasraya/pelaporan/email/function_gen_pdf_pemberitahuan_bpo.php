<?
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/kantor.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/gadai.php";
	include "../../includes/fungsi.php";

	 //$prefixpertanggungan	= 'AF';
	 //$nopertanggungan		= '000033929';
	 //$kdkantor 				= 'AF';
	 //$id_blast 				= '13';
	$passwd = 'jsadmoke';
	$userid = 'jsadm';

	$DB1	= new database($userid, $passwd, $DBName);
	$DBD	= new database($userid, $passwd, $DBName);
	$cetak 	= $_GET['cetak'];
	if($cetak == 1){
		$cari 	= " AND (STATUS != '1' OR STATUS IS NULL) AND TGL_KIRIM_SMS IS NULL";
	}else{
		$cari 	= '';
	}
	$sqlcek	= "SELECT * FROM $DBUser.PENERIMA_EMAIL_BLAST where ID_BLAST = '".$_GET['idblast']."'
				$cari
				";
	//echo $sqlcek;
	$DBD->parse($sqlcek);
	$DBD->execute();

	require_once('../libs/fpdf/fpdf.php');
	$pdf = new FPDF('P','mm','A4');

	while ($rowd = $DBD->nextrow()) {
		if($cetak == 0){
			require_once('../libs/fpdf/fpdf.php');
			$pdf = new FPDF('P','mm','A4');
		}
		$prefixpertanggungan 	= $rowd['PREFIXPERTANGGUNGAN'];
		$nopertanggungan 		= $rowd['NOPERTANGGUNGAN'];
		$kdkantor 				= $rowd['RAYONPENAGIHAN'];
		$id_blast 				= $rowd['ID_BLAST'];
		$id_audience 			= $rowd['ID_AUDIENCE'];

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
					(SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null) tertunggak,
					(SELECT substr(noaccount,6,11) FROM $DBUser.tabel_100_klien_account va WHERE va.prefixpertanggungan=ptg.prefixpertanggungan AND va.nopertanggungan=ptg.nopertanggungan AND va.kdbank='BNI') VBNI
				FROM $DBUser.tabel_200_pertanggungan ptg
				WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";
		//echo $sql;
		$DBZ->parse($sql);
		$DBZ->execute();
		while ($row = $DBZ->nextrow()) {
			
			$pdf->AddPage();

			/*** HEADER ***/
			$pdf->ln();
			$pdf->SetLeftMargin(20);
			$image1 = "../libs/logo_js.jpg";
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'PT ASURANSI JIWA IFG',0,0,'L');
			$pdf->Ln();	
			$pdf->Cell(70,4,'KANTOR PUSAT',0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(70,4,'JL. IR H. JUANDA NO.34',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(70,4,'JAKARTA',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(70,4,'Telp.021-3845031 Fax.021-3862344',0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'www.ifg-life.co.id',0,0,'L');

			//$pdf->SetLeftMargin(120);
			$pdf->Image($image1, 144, 10, 50);
			$pdf->Ln(15);

			/*** ALAMAT PENGIRIMAN ***/
			$pdf->SetLeftMargin(20);
			$pdf->ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(170,4,'Jakarta, '.date("d/m/Y"),0,0,'R');
			$pdf->ln(7);
			$pdf->Cell(30,4,'Kepada Yth.',0,0,'L');
			$pdf->ln();
			$pdf->Cell(160,4,$row["ANDA"].'. '. $row["PEMPOL"],0,0,'L');
			$pdf->ln();
			$pdf->MultiCell(80,4,$row["ALAMAT"],0,'L','');
			$pdf->Cell(160,4,$row["KOTA"],0,0,'L');
			$pdf->ln(15);

			/*** ISI SURAT ***/
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(170,4,'Perihal : PEMBERITAHUAN KONDISI POLIS BPO',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(170,4,'Pemegang Polis Yang Terhormat, ',0,0,'L');
			$pdf->ln(7);
			$pdf->MultiCell(180,4,'Terima kasih atas kepercayaan '.$row["ANDA"].' kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi '.$row["ANDA"].' dan keluarga.',0,'L','');
			$pdf->ln(2);
			$pdf->Cell(170,4,'Berikut ini adalah data Polis '.$row["ANDA"].' :',0,0,'L');
			$pdf->ln(7);

			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Nomor Polis',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4,$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].' / '.$row["NOPOL"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Nama Pemegang Polis',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4,$row["PEMPOL"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Jenis Produk',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4,$row["PRODUK"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Valuta',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4,$row["VALUTA"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Cara Pembayaran Premi',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4,$row["CARA"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Premi terakhir yang sudah dilunasi per',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4,$row["LUNAS"],0,0,'L');
			$pdf->ln();
			$pdf->Cell(10,4,'',0,0,'L');
			$pdf->Cell(70,4,'Mulai Jatuh tempo Premi tertunggak',0,0,'L');
			$pdf->Cell(3,4,':',0,0,'L');
			$pdf->Cell(50,4, $row["TERTUNGGAK"],0,0,'L');
			$pdf->ln(7);

			//$pdf->SetLeftMargin(15);
			$pdf->MultiCell(170,4,'Berdasarkan data tersebut di atas, saat ini Polis Bapak/Ibu dalam kondisi BPO (Bebas Premi Otomatis), sehingga terhadap kondisi polis tersebut, kami hitung ulang berdasarkan data pelunasan premi yang ada. Hasil perhitungan tersebut akan menimbulkan kondisi sebagai berikut :',0,'J','');
			$pdf->ln();

			$pdf->Cell(5,4,'',0,0,'L');
			$pdf->Cell(5,4,'1. ',0,0,'L');
			$pdf->Cell(160,4,'Polis yang belum mempunyai nilai tunai, menjadi batal tanpa suatu pembayaran.',0,0,'L');
			$pdf->ln();
			$pdf->Cell(5,8,'',0,0,'L');
			$pdf->Cell(5,4,'2. ',0,0,'L');
			$pdf->MultiCell(160,4,'Penurunan Jumlah Uang Asuransi dan secara otomatis premi lanjutan tidak kami tagih kembali. Segala manfaat asuransi yang timbul akan dihitung berdasarkan uang asuransi yang telah diturunkan.',0,'J','');
			$pdf->Cell(5,12,'',0,0,'L');
			$pdf->Cell(5,4,'3. ',0,0,'L');
			$pdf->MultiCell(160,4,'Dalam hal pembayaran Premi telah dilakukan oleh Bapak/Ibu dan atau data Polis di atas tidak sesuai serta jika ada informasi lain yang ingin Bapak/Ibu ketahui, mohon untuk dapat menghubungi Kantor PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG : (021) 1500151 atau email: customer_service@ifg-life.co.id, dengan melampirkan bukti pelunasan premi yang sah.',0,'J','');
			$pdf->Cell(5,12,'',0,0,'L');
			$pdf->Cell(5,4,'4. ',0,0,'L');
			$pdf->MultiCell(160,4,'Sesuai dengan Regulasi yang berlaku dan demi Keamanan Bapak/Ibu, PT Asuransi Jiwa IFG tidak lagi menerima pembayaran premi secara tunai melalui Petugas Kami di lapangan (Agen/Marketing). Pembayaran hanya dapat dilakukan melalui chanel resemi berikut bit.ly/bayar premi atau melaui Host to host (Mandiri/BRI/BNI/Indomaret/PT POS/ Alfa Group) /Autodebet/Virtual Accpunt, Pembayaran Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya dapat menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau email : customer_service@ifg-life.co.id.',0,'J','');
			$pdf->ln();
			$pdf->Cell(170,4,'Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.',0,0,'L');
			$pdf->ln(15);
			$pdf->Cell(170,4,'Hormat kami',0,0,'L');
			$pdf->ln();
			$pdf->Cell(170,4,'PT ASURANSI JIWA IFG',0,0,'L');
			$pdf->ln(15);
			$pdf->SetFont('Arial',I,6);
			$pdf->Cell(170,4,'Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.',0,0,'L');

		}

		/*** HALAMAN UNTUK MENGECEK FOLDER ***/
		$dirname = date("Y");
		$filename = "pdf_bpo/" . $dirname . "/";

		if (!file_exists($filename)) {
		    mkdir("pdf_bpo/" . $dirname, 0777);
		    
		} else {
		    
		}

		if($cetak == 0){
			$pdf->Output($filename.date("m").date("Y").'_SURAT_PEMBERITAHUAN_BPO_'.$prefixpertanggungan.$nopertanggungan.'.pdf');

			$nama_file = date("m").date("Y").'_SURAT_PEMBERITAHUAN_BPO_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST SET FILE_PDF = '".$nama_file."' WHERE id_blast = '".$id_blast."' AND ID_AUDIENCE = '".$id_audience."' ";
			$DB1->parse($query);
			$DB1->execute();


			/*** FUNGSI UNTUK MENYIMPAN FILE KE SERVER FTP ***/
			// $ftp_server = "192.168.2.94";
			// $ftp_username = "ftpuser";
			// $ftp_userpass = "JS#34-ftp!";
			// $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
			// $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

			// $file = $filename.date("m").date("Y").'_SURAT_PEMBERITAHUAN_BPO_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			// $namafileftp = 'DOKUMEN_PEMBERITAHUAN_BPO/2019/'.date("m").date("Y").'_SURAT_PEMBERITAHUAN_BPO_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			// // upload file
			// if (ftp_put($ftp_conn, $namafileftp, $file, FTP_ASCII)){
			// 	echo "Successfully uploaded!";
			// }else{
			// 	echo "Error uploading!";
			// }
			// close connection
			//ftp_close($ftp_conn);
		}else{
			
		}		
	}

	if($cetak == 0){
		$query = "UPDATE $DBUser.EMAIL_BLAST_EVENT_TESTING SET KDGENERATE = '1' WHERE id_blast = '".$id_blast."' ";
		$DB1->parse($query);
		$DB1->execute();
		header("Location: blast_system.php");
	}else{
		$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST SET TGL_CETAK_SURAT = SYSDATE WHERE id_blast = '".$id_blast."' AND ID_AUDIENCE = '".$id_audience."' ";
		$DB1->parse($query);
		$DB1->execute();

		$pdf->Output();
	}
?>