<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
		
		/*$kodeprospek = $_GET['kodeprospek'];
		$DataAgen = $this->ModSimulasi->GetDataAgen($kodeprospek);
		$idAgen = $DataAgen['NOAGEN'];*/
        
        $DataAgen = $this->ModSimulasi->getHitung($_GET['build_id']);
        $idAgen = $DataAgen['ID_AGEN'];

		$api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$idAgen"), true);
		
		$namaagen = $api['NAMALENGKAP'];
		$nomeragen = $idAgen;
		
		$kantorcabang_old = str_replace("KANTOR CABANG","",$api['NAMAKANTOR']);
		$kantorcabang = str_replace("AGENCY SERVICE CENTER","ASC",$kantorcabang_old);

		$image1 = FCPATH.'assets/img/logo-js.png';
		$imageai = FCPATH.'assets/img/anuitas1.png';
		$imageai2 = FCPATH.'assets/img/anuitas2.png';
	    // Generate PDF by saying hello to the world
	    foreach($hasil300Hitung as $data) {
	    	$mulas = $data->MULAS;
	    	$premi = $data->JUMLAH_PREMI;
	    	$pht = $data->PHT;
	    	$pjd = 0.6 * $pht;
	    	$pyt = 0.6 * $pht;
	    }


	    /* HALAMAN 1 */
		$this->pdf->AddPage();

		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(65,105,225);
		$this->pdf->Cell(50,5,'CALL 021500151',1,0,'L', true);
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','I',8);
		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(50,5,'http://www.jiwasraya.co.id',1,0,'L', true);
		$this->pdf->ln(10);
		$this->pdf->SetTextColor(178,178,178);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->SetFont('Arial','B',20);
		$this->pdf->Cell(190,8,'Program Pensiun',0,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Times','B',20);
		$this->pdf->SetTextColor(0,0,0);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->Cell(190,8,'JS ANUITAS',0,0,'C');
		$this->pdf->ln(10);



		foreach($hasilProTertanggung as $data) {
			if($data->MERITALSTATUS == 'K'){
				$status_pernikahan = 'Kawin';
			}else{
				$status_pernikahan = 'Lajang/Bujang';
			}
			// DATA
			$this->pdf->SetFont('Arial','B',12);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(0,32,96);
			$this->pdf->Cell(190,5,'Data',0,0,'L',true);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(5,5,'',0,0,'L', true);
			$this->pdf->Cell(70,5,'Nama Pemegang Polis/Tertanggung',0,0,'L', true);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(10,5,':',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(44,5,''.$data->NAMA.'',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(60.9,5,'',0,0,'L', true);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(5,5,'',0,0,'L', true);
			$this->pdf->Cell(70,5,'Tanggal Lahir Pemegang Polis/Tertanggung',0,0,'L', true);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(10,5,':',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(44,5,''.$data->TGL_LAHIR.'',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(60.9,5,'',0,0,'L', true);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(5,5,'',0,0,'L', true);
			$this->pdf->Cell(70,5,'Status',0,0,'L', true);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(10,5,':',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(44,5,''.$status_pernikahan.'',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(60.9,5,'',0,0,'L', true);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(5,5,'',0,0,'L', true);
			$this->pdf->Cell(70,5,'Mulai Asuransi',0,0,'L', true);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(10,5,':',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(44,5,''.$mulas.'',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(60.9,5,'',0,0,'L', true);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(5,5,'',0,0,'L', true);
			$this->pdf->Cell(70,5,'Usia Pemegang Polis/Tertanggung',0,0,'L', true);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(10,5,':',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(44,5,''.$data->USIA_TH.' TAHUN '.$data->USIA_BL.' BULAN ',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(60.9,5,'',0,0,'L', true);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(5,5,'',0,0,'L', true);
			$this->pdf->Cell(70,5,'Dana yang disetor',0,0,'L', true);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(10,5,':',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(44,5,'Rp. '.number_format($premi,0,'.',',').'',0,0,'L', true);
			$this->pdf->SetTextColor(255,255,255);
			$this->pdf->SetFillColor(51,102,255);
			$this->pdf->Cell(60.9,5,'',0,0,'L', true);
			$this->pdf->ln(10);
		}

		if($status_pernikahan == 'Kawin'){
			// MANFAAT YANG DITERIMA
			$this->pdf->SetFont('Arial','BU',12);
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->SetTextColor(255,0,0);
			$this->pdf->SetFont('Arial','BU',12);
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->SetTextColor(255,0,0);
			$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH:',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(3,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'1. Pensiun Hari Tua (PHT) dibayarkan secara bulanan, dimulai satu bulan berikutnya  setelah premi lunas sampai dengan Tertanggung meninggal ',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(6,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'dunia, sebesar: Rp. '.number_format($pht,0,'.',',').'.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(3,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'2. Pensiun Janda/Duda (PJD) dibayarkan secara bulanan setelah penerima PHT meninggal dunia sampai dengan Janda/Duda meninggal dunia',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(6,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'atau menikah lagi sebesar Rp. '.number_format($pjd,0,'.',',').'.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(3,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'3. Pensiun Yatim (PYT) atau menikah lagi dibayarkan secara bulanan setelah penerima PJD meninggal dunia, diakhiri ketika Yatim berusia',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(6,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'25 tahun dan/atau sudah menikah dan/atau sudah bekerja dan/atau meninggal dunia, sebesar Rp. '.number_format($pyt,0,'.',',').'.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(3,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'4. Pengembalian sisa dana (jika ada) kepada AhliWaris yang sah secara hukum pada saat penerima PHT, PJD telah Meninggal Dunia dan Penerima',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(6,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'PYT berusia 25 tahun atau sudah menikah atau sudah bekerja atau Meninggal Dunia.',0,0,'L');
			$this->pdf->ln();

			//ILUSTRASI
			$this->pdf->Image($imageai, 23, 155, -195);
			$this->pdf->ln(40);
		}else{
			// MANFAAT YANG DITERIMA
			$this->pdf->SetFont('Arial','BU',12);
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->SetTextColor(255,0,0);
			$this->pdf->SetFont('Arial','BU',12);
			$this->pdf->SetFillColor(255,255,255);
			$this->pdf->SetTextColor(255,0,0);
			$this->pdf->Cell(190,5,'MANFAAT YANG DIPEROLEH:',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(3,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'1. Pensiun Hari Tua (PHT) dibayarkan secara bulanan, dimulai satu bulan berikutnya setelah premi lunas sampai dengan Tertanggung meninggal ',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(6,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'dunia, sebesar: Rp. '.number_format($pht,0,'.',',').'.',0,0,'L');	
			$this->pdf->ln();
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(3,5,'',0,0,'L');
			$this->pdf->Cell(190,5,'2. Pengembalian sisa dana (jika ada) kepada Ahli Waris pada saat penerima PHT Meninggal Dunia.',0,0,'L');
			$this->pdf->ln();

			//ILUSTRASI
			$this->pdf->Image($imageai2, 12, 140, -175);	
			$this->pdf->ln(120);
		}
			

		// FOOTER
		$this->pdf->SetY(-40);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,4,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,4,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,4,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,4,''.$nomeragen.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,4,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,4,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,4,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,4,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,4,''.$kantorcabang.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,4,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,4,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,4,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(27,4,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LBR',0,'C');
		$this->pdf->Cell(40,4,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');


		//PAGE 2		
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(15);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'PROGRAM ANUITAS PERTANGGUNGAN PERORANGAN','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// DISAJIKAN OLEH
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'DISAJIKAN OLEH',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nama Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Nomor Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$nomeragen.'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'Tanggal Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->ln(20);

		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'L');
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'L');
		$this->pdf->ln(35);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->Cell(95,5,''.$data->NAMA.'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'L');
		$this->pdf->Cell(95,5,'Saya mengerti proposal ini bukan merupakan kontrak asuransi dan manfaat selengkapnya tertera di Polis',0,0,'L');
		$this->pdf->ln(120);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(190,5,'Produk JS Anuitas merupakan produk Asuransi Jiwa seumur hidup dan saya bersedia untuk tidak melakukan penebusan nilai Polis sampai dengan masa Asuransi JS Anuitas berakhir',1,0,'C');
		$this->pdf->ln(10);

		// FOOTER
		$this->pdf->SetY(-40);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,4,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,4,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,4,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,4,''.$nomeragen.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,4,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,4,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,4,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,4,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(25,4,''.$kantorcabang.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->Cell(40,4,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,4,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,4,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,4,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(27,4,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,4,'','LBR',0,'C');
		$this->pdf->Cell(40,4,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');

		$this->pdf->Output();
		
?>