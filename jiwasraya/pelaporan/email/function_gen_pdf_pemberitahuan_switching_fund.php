<?
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/kantor.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/gadai.php";
	include "../../includes/fungsi.php";

	$prefixpertanggungan	= $_GET['prefix'];
	//$nopertanggungan		= '002401602';
	$passwd = 'jsadmoke';
	$userid = 'jsadm';

	$DB1	= new database($userid, $passwd, $DBName);
	$DBD	= new database($userid, $passwd, $DBName);

	$sql 	= "SELECT a.PREFIXPERTANGGUNGAN, 
				a.NOPERTANGGUNGAN, 
				a.KDPRODUK, 
				a.KDSTATUSFILE, 
				b.KDFUND,
				(SELECT NAMAFUND FROM $DBUser.TABEL_UL_KODE_FUND WHERE KDFUND = b.KDFUND)NAMAFUND,
				(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR = a.KDCARABAYAR) CARA,
				(SELECT namaklien1 FROM $DBUser.tabel_100_klien kli WHERE kli.NOKLIEN = a.NOPEMEGANGPOLIS) PEMPOL,
				(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu') FROM $DBUser.tabel_100_klien kli WHERE kli.NOKLIEN = a.NOPEMEGANGPOLIS) ANDA,
				(SELECT alamattagih01||' '||alamattagih02 FROM $DBUser.tabel_100_klien kli WHERE kli.NOKLIEN = a.NOPEMEGANGPOLIS) ALAMAT,
				NVL(
					(SELECT ktm.namakotamadya FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm WHERE kli.NOKLIEN = a.NOPEMEGANGPOLIS AND kli.kdkotamadyatagih=ktm.kdkotamadya),
					(SELECT namapropinsi FROM $DBUser.tabel_100_klien kli, $DBUser.tabel_108_propinsi kp WHERE kli.NOKLIEN = a.NOPEMEGANGPOLIS AND kli.kdpropinsitagih=kp.kdpropinsi)
				) KOTA,
				(SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=a.prefixpertanggungan AND hp.nopertanggungan=a.nopertanggungan AND hp.tglseatled is null) tertunggak
			FROM $DBUser.TABEL_200_PERTANGGUNGAN a,
				$DBUser.TABEL_UL_OPSI_FUND b
			WHERE a.KDPRODUK LIKE 'JL4%'
				AND a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
				AND a.KDPERTANGGUNGAN = '2'
				AND a.KDSTATUSFILE IN ('1','4')
				AND B.KDFUND IN ('IH', 'IG')
				AND a.PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
			ORDER BY a.PREFIXPERTANGGUNGAN, b.NOPERTANGGUNGAN ASC";
	//echo $sql;
	$DBD->parse($sql);
	$DBD->execute();

	require_once('../libs/fpdf/fpdf.php');
	$pdf = new FPDF('P','mm','A4');
	$i = 1;
	while ($row = $DBD->nextrow()) {
		/*** SURAT UNTUK YANG BPO ***/
		if($row["KDSTATUSFILE"] == '4'){
			$pdf->AddPage();

			/*** HEADER ***/
			if($i == 1){
				$pdf->ln();
				$pdf->SetLeftMargin(10);
				$image1 = "../libs/logo_js.jpg";
				$pdf->Ln(5);
				$pdf->Image($image1, 140, 10, 50);
				$pdf->Ln(39);
			}else{
				$image1 = "../libs/logo_js.jpg";
				$pdf->Image($image1, 140, 10, 50);
				$pdf->Ln(40);
			}

			/*** ALAMAT PENGIRIMAN ***/
			$pdf->SetLeftMargin(20);
			$pdf->ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(100,4,'Kepada Yth.',0,0,'L');
			$pdf->Cell(30,4,'Tanggal',0,0,'L');
			$pdf->Cell(40,4,': '.date("d/m/Y"),0,0,'L');
			$pdf->ln();
			$pdf->Cell(100,4,$row["ANDA"].'. '. $row["PEMPOL"],0,0,'L');
			$pdf->Cell(30,4,'Nomor Polis',0,0,'L');
			$pdf->Cell(40,4,': '.$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"],0,0,'L');
			$pdf->ln();
			$pdf->MultiCell(80,4,$row["ALAMAT"],0,'L','');
			$pdf->SetXY(120, 62);
			$pdf->Cell(30,4,'Cara Bayar',0,0,'L');
			$pdf->Cell(40,4,': '.$row["CARA"],0,0,'L');
			$pdf->ln(8);
			$pdf->Cell(100,4,$row["KOTA"],0,0,'L');
			$pdf->Cell(30,4,'Jatuh Tempo',0,0,'L');
			$pdf->Cell(40,4,': '.$row["TERTUNGGAK"],0,0,'L');
			$pdf->ln(15);

			/*** ISI SURAT ***/
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(170,4,'Perihal : PEMBERITAHUAN BATAL POLIS OTOMATIS DAN SWITCHING FUND',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(170,4,'Pemegang Polis Yang Terhormat, ',0,0,'L');
			$pdf->ln(7);
			$pdf->MultiCell(170,4,'Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan kepada PT Asuransi Jiwa IFG untuk memberikan perlindungan finansial bagi Bapak/Ibu sekeluarga.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Kami menyadari bahwa mungkin disebabkan oleh kesibukan Bapak/Ibu, maka sampai dengan berakhirnya grace period (masa leluasa pembayaran premi), premi Bapak/Ibu yang telah jatuh tempo belum kami terima. Sehingga mengakibatkan status Polis tersebut menjadi batal.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Mengingat pentingnya perlindungan Asuransi tersebut, maka kami menyarankan Bapak/Ibu untuk dapat segera mengajukan pemulihan Polis dengan menandatangani formulir terlampir dan melunasi premi tertunggak sejak jatuh tempo premi.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Bersama surat ini disampaikan bahwa selaras dengan tujuan transformasi yang dilakukan, untuk itu perusahaan mengambil kebijakan untuk menutup 2 (dua) jenis fund pada polis Asuransi Jiwa JS Pro Mapan yaitu JS Guardian 75 dan JS Guardian 85 pada tanggal 29 Februari 2020. Hal itu dilakukan untuk menghindari terjadinya kerugian akibat Nilai Aktiva Bersih (NAB) yang tidak berkembang disebabkan tidak adanya penambahan dana.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Apabila Bapak/Ibu berniat untuk melanjutkan pembayaran premi, maka dengan ini kami menawarkan kepada Bapak/Ibu untuk mengalihkan dananya ke jenis investasi lain yang tersedia yaitu:',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'a.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Pasar Uang, adalah jenis alokasi investasi dengan risiko rendah dimana alokasi penempatan Dana Investasi adalah maksimal 100% (seratus persen) pada instrumen Pasar Uang dan/atau Unit Penyertaan Reksa Dana Pasar Uang.',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'b.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Pendapatan Tetap,  adalah jenis alokasi investasi dengan risiko sedang dimana alokasi penempatan Dana Investasi adalah minimal 80% (delapan puluh persen) pada instrumen Obligasi dan/atau Unit Penyertaan Reksa Dana Pendapatan Tetap dan minimal 5% (lima persen) pada instrumen Pasar Uang.',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'c.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Berimbang,   adalah jenis alokasi investasi dengan risiko sedang tinggi dimana alokasi penempatan Dana Investasi adalah minimal 25% (dua puluh lima persen) dan maksimal 75% (tujuh puluh lima persen) pada instrumen Saham, Obligasi, Unit Penyertaan Reksa Dana Saham, Reksa Dana Campuran, Reksa Dana Pendapatan Tetap, dan minimal 5% (lima persen) pada Investasi Pasar Uang dan/atau Reksa Dana Pasar Uang.',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'d.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Ekuitas,   adalah jenis alokasi investasi dengan risiko tinggi dimana alokasi penempatan Dana Investasi adalah minimal 80% (delapan puluh persen) pada instrumen Saham dan/atau Unit Penyertaan Reksa Dana Saham, maksimal 20% (dua puluh persen) pada instrumen Obligasi, dan minimal 5% (lima persen) pada instrumen Pasar Uang.',0,'J','');
			$pdf->ln(4);
			$pdf->MultiCell(170,4,'Dalam hal Pemegang Polis tidak menggunakan kesempatan tersebut dalam waktu paling lama 14 (empat belas) hari kalender setelah penutupan tersebut dilakukan oleh Penanggung, maka Pemegang Polis memberikan hak kepada Penanggung berhak untuk menentukan jenis alokasi investasi tersebut atas nama Pemegang Polis.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Untuk premi lanjutan selanjutnya akan dialokasikan pada jenis investasi baru yang telah Bapak/Ibu pilih. Terlampir formulir switching (pengalihan dana) dan formulir pemulihan yang dapat diisi oleh Bapak/Ibu, setelah terisi dengan lengkap dan benar agar dapat dikirimkan kepada kami dengan alamat: customerservice@ifg-life.co.id, namun jika masih terdapat pertanyaan, Bapak/Ibu dapat menghubungi kami Call Center PT Asuransi Jiwa IFG di 021-1500151 atau mendatangi kantor PT Asuransi Jiwa IFG terdekat.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Sebagai informasi, polis yang belum dipulihkan dalam waktu 3 (tiga) bulan sejak tanggal jatuh tempo premi terakhir yang belum terbayar dan memiliki jumlah saldo dana kurang dari atau sama dengan Rp 10.000,- (sepuluh ribu rupiah), maka mengacu pada ketentuan batas minimum transfer melalui Bank, kami informasikan bahwa saldo dana tersebut tidak dapat kami kembalikan.',0,'J','');
			$pdf->ln();
			$pdf->Cell(170,4,'Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.',0,0,'L');
			$pdf->ln(8);
			$pdf->Cell(170,4,'Hormat kami',0,0,'L');
			$pdf->ln();
			$pdf->Cell(170,4,'PT ASURANSI JIWA IFG',0,0,'L');
			$pdf->ln(5);
			$pdf->SetFont('Arial',I,6);
			$pdf->Cell(170,4,'Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.',0,0,'L');
			$pdf->ln();
			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(25, 153);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(25,4,'JS Link Pasar Uang,',0,1,'L',true);

			$pdf->SetXY(25, 163);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(33,4,'JS Link Pendapatan Tetap,',0,1,'L',true);

			$pdf->SetXY(25, 177);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(23,4,'JS Link Berimbang,',0,1,'L',true);

			$pdf->SetXY(25, 191);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(20,4,'JS Link Ekuitas,',0,1,'L',true);

			$pdf->SetFont('Arial','I',7);
			$pdf->SetXY(20, 229);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(38,4,'customerservice@ifg-life.co.id,',0,1,'L',true);

			$pdf->SetFont('Arial','I',7);
			$pdf->SetXY(145, 229);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(14,4,'Call Center',0,1,'L',true);

			$i++;
		 }
			else{
			$pdf->AddPage();

			/*** HEADER ***/
			if($i == 1){
				$pdf->ln();
				$pdf->SetLeftMargin(10);
				$image1 = "../libs/logo_js.jpg";
				$pdf->Ln(5);
				$pdf->Image($image1, 140, 10, 50);
				$pdf->Ln(39);
			}else{
				$image1 = "../libs/logo_js.jpg";
				$pdf->Image($image1, 140, 10, 50);
				$pdf->Ln(40);
			}

			/*** ALAMAT PENGIRIMAN ***/
			$pdf->SetLeftMargin(20);
			$pdf->ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(100,4,'Kepada Yth.',0,0,'L');
			$pdf->Cell(30,4,'Tanggal',0,0,'L');
			$pdf->Cell(40,4,': '.date("d/m/Y"),0,0,'L');
			$pdf->ln();
			$pdf->Cell(100,4,$row["ANDA"].'. '. $row["PEMPOL"],0,0,'L');
			$pdf->Cell(30,4,'Nomor Polis',0,0,'L');
			$pdf->Cell(40,4,': '.$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"],0,0,'L');
			$pdf->ln();
			$pdf->MultiCell(80,4,$row["ALAMAT"],0,'L','');
			$pdf->SetXY(120, 62);
			$pdf->Cell(30,4,'Cara Bayar',0,0,'L');
			$pdf->Cell(40,4,': '.$row["CARA"],0,0,'L');
			$pdf->ln(8);
			$pdf->Cell(100,4,$row["KOTA"],0,0,'L');
			$pdf->ln(15);

			/*** ISI SURAT ***/
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(170,4,'Perihal : PEMBERITAHUAN UNTUK SWITCHING FUND',0,0,'L');
			$pdf->ln(7);
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(170,4,'Pemegang Polis Yang Terhormat, ',0,0,'L');
			$pdf->ln(7);
			$pdf->MultiCell(170,4,'Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan kepada PT Asuransi Jiwa IFG untuk memberikan perlindungan finansial bagi Bapak/Ibu sekeluarga.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Bersama surat ini disampaikan bahwa selaras dengan tujuan transformasi yang dilakukan, untuk itu perusahaan mengambil kebijakan untuk menutup 2 (dua) jenis fund pada polis Asuransi Jiwa JS Pro Mapan yaitu JS Guardian 75 dan JS Guardian 85 pada tanggal 29 Februari 2020. Hal itu dilakukan untuk menghindari terjadinya kerugian akibat Nilai Aktiva Bersih (NAB) yang tidak berkembang disebabkan tidak adanya penambahan dana, maka dengan ini kami menawarkan kepada Bapak/Ibu untuk dapat mengalihkan dananya ke jenis investasi lain yang tersedia yaitu: ',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'a.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Pasar Uang, adalah jenis alokasi investasi dengan risiko rendah dimana alokasi penempatan Dana Investasi adalah maksimal 100% (seratus persen) pada instrumen Pasar Uang dan/atau Unit Penyertaan Reksa Dana Pasar Uang.',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'b.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Pendapatan Tetap,  adalah jenis alokasi investasi dengan risiko sedang dimana alokasi penempatan Dana Investasi adalah minimal 80% (delapan puluh persen) pada instrumen Obligasi dan/atau Unit Penyertaan Reksa Dana Pendapatan Tetap dan minimal 5% (lima persen) pada instrumen Pasar Uang.',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'c.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Berimbang,   adalah jenis alokasi investasi dengan risiko sedang tinggi dimana alokasi penempatan Dana Investasi adalah minimal 25% (dua puluh lima persen) dan maksimal 75% (tujuh puluh lima persen) pada instrumen Saham, Obligasi, Unit Penyertaan Reksa Dana Saham, Reksa Dana Campuran, Reksa Dana Pendapatan Tetap, dan minimal 5% (lima persen) pada Investasi Pasar Uang dan/atau Reksa Dana Pasar Uang.',0,'J','');
			$pdf->ln(2);
			$pdf->Cell(5,4,'d.',0,0,'L');
			$pdf->MultiCell(165,4,'JS Link Ekuitas,    adalah jenis alokasi investasi dengan risiko tinggi dimana alokasi penempatan Dana Investasi adalah minimal 80% (delapan puluh persen) pada instrumen Saham dan/atau Unit Penyertaan Reksa Dana Saham, maksimal 20% (dua puluh persen) pada instrumen Obligasi, dan minimal 5% (lima persen) pada instrumen Pasar Uang.',0,'J','');
			$pdf->ln(4);
			$pdf->MultiCell(170,4,'Besar harapan kami, Bapak/Ibu dapat mengalihkan dananya ke salah satu jenis investasi tersebut di atas. Sebagai informasi pemindahan dana ini tidak akan berpengaruh pada besarnya manfaat perlindungan Polis.',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Dalam hal Pemegang Polis tidak menggunakan kesempatan tersebut dalam waktu paling lama 14 (empat belas) hari kalender setelah penutupan tersebut dilakukan oleh Penanggung, maka Pemegang Polis memberikan hak kepada Penanggung berhak untuk menentukan jenis alokasi investasi tersebut atas nama Pemegang Polis. ',0,'J','');
			$pdf->ln(2);
			$pdf->MultiCell(170,4,'Berikut adalah formulir switching (pengalihan dana) yang dapat diisi oleh Bapak/Ibu, setelah terisi dengan lengkap dan benar agar dapat dikirimkan kepada kami dengan alamat: customerservice@ifg-life.co.id, namun jika masih terdapat pertanyaan, Bapak/Ibu dapat menghubungi kami Call Center PT Asuransi Jiwa IFG di 021-1500151 atau mendatangi kantor PT Asuransi Jiwa IFG terdekat.',0,'J','');
			$pdf->ln();
			$pdf->Cell(170,4,'Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.',0,0,'L');
			$pdf->ln(10);
			$pdf->Cell(170,4,'Hormat kami',0,0,'L');
			$pdf->ln();
			$pdf->Cell(170,4,'PT ASURANSI JIWA IFG',0,0,'L');
			$pdf->ln(5);
			$pdf->SetFont('Arial',I,6);
			$pdf->Cell(170,4,'Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.',0,0,'L');
			$pdf->ln();

			$pdf->SetFont('Arial','B',7);
			$pdf->SetXY(25, 127);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(25,4,'JS Link Pasar Uang,',0,1,'L',true);

			$pdf->SetXY(25, 137);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(33,4,'JS Link Pendapatan Tetap,',0,1,'L',true);

			$pdf->SetXY(25, 151);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(23,4,'JS Link Berimbang,',0,1,'L',true);

			$pdf->SetXY(25, 165);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(20,4,'JS Link Ekuitas,',0,1,'L',true);

			$pdf->SetFont('Arial','I',7);
			$pdf->SetXY(53, 209);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(38,4,'customerservice@ifg-life.co.id,',0,1,'L',true);

			$pdf->SetFont('Arial','I',7);
			$pdf->SetXY(176, 209);
			$pdf->SetFillColor(255,255,255);
			$pdf->Cell(14,4,'Call Center',0,1,'R',true);

		 $i++;
		}
	}
	$pdf->Output();
	
?>