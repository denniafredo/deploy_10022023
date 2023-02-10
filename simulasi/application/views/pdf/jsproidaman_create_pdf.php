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
	    // Generate PDF by saying hello to the world
		
		// Page 1
		$this->pdf->AddPage();
		

		// HEADER
		$this->pdf->Image($image1, 10, 5);
		$this->pdf->AddFont('Monserrat', '', 'fpdf/font/Montserrat-Medium.php');
        $this->pdf->AddFont('Monserrat', 'B', 'fpdf/font/Montserrat-Bold.php');
        $this->pdf->AddFont('Monserrat', 'I', 'fpdf/font/Montserrat-MediumItalic.php');
		
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',14);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'PT ASURANSI JIWA IFG',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190',0,0,'L');
		$this->pdf->ln(10);		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,4,'IFG ULTIMATE PROTECTION','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Monserrat','',7);
		$this->pdf->Cell(50,4,'Nomor Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,$_GET['build_id'],0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Monserrat','',7);
		$this->pdf->Cell(50,4,'Tanggal Ilustrasi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->ln(8);
		
				
		// CALON PEMEGANG POLIS
		foreach($hasilProPempol as $data) {
			$usiacalonpemegangpolis = $data->USIA_TH;
		
			$this->pdf->SetFont('Monserrat','B',8);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,3,'CALON PEMEGANG POLIS',1,0,'L', true);
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Nama Pemegang Polis',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->NAMA.' ',0,0,'L');
			
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Jenis Kelamin',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->JENIS_KELAMIN == 'M' ? 'Laki-Laki' : 'Perempuan').' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Tanggal Lahir',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.date('d/m/Y',strtotime($data->TGL_LAHIR)).' / '.$data->USIA_TH.' Tahun',0,0,'L');
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Telp',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->TELEPON.' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Email',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->EMAIL.' ',0,0,'L');
			
			//$this->pdf->ln(5);
			
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Hp',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->HP.' ',0,0,'L');
			$this->pdf->ln();

			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Status Perokok',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->IS_PEROKOK == 'T' ? 'Tidak' : 'Ya').' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Jenis Pekerjaan',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.ucwords(strtolower($data->NAMAPEKERJAAN)).' ',0,0,'L');			
			$this->pdf->Cell(10);
			$this->pdf->ln(5);
		}
		
		// CALON Tertangggung
		foreach($hasilProTertanggung as $data) {
			$usiacalontertanggung = $data->USIA_TH;
			
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Monserrat','B',8);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,4,'CALON TERTANGGUNG',1,0,'L', true);
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Nama Tertangggung',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->NAMA.' ',0,0,'L');
			
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Jenis Kelamin',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->JENIS_KELAMIN == 'M' ? 'Laki-Laki' : 'Perempuan').' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Tanggal Lahir',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->TGL_LAHIR.' / '.$data->USIA_TH.' tahun',0,0,'L');
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Hubungan Dengan Pemegang Polis',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			if ($data->HUBUNGAN == '')
			{
				$data->HUBUNGAN = 'LAINNYA';
			}
			else if ($data->HUBUNGAN == '1')
			{
				$data->HUBUNGAN = 'SUAMI/ISTRI';	
			}
			else if ($data->HUBUNGAN == '2')
			{
				$data->HUBUNGAN = 'ORANG TUA/ANAK';	
			}
			else if ($data->HUBUNGAN == '3')
			{
				$data->HUBUNGAN = 'DIRI SENDIRI';	
			}
			$this->pdf->Cell(32,3,''.($data->HUBUNGAN).' ',0,0,'L');
			$this->pdf->ln();

			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Status Perokok',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->IS_PEROKOK == 'T' ? 'Tidak' : 'Ya').' ',0,0,'L');
			$this->pdf->ln();

			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,3,'Jenis Pekerjaan',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.ucwords(strtolower($data->NAMAPEKERJAAN)).' ',0,0,'L');
			$this->pdf->Cell(10);
			$this->pdf->ln(5);
			
		}
		
		foreach($hasilProAsuransiPokok as $data) {
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(190,4,'','B',1,'L');
			$this->pdf->ln(1);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Cara Bayar',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,'SEKALIGUS',0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Uang Pertanggungan',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->UA,0,',','.'),0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Mata Uang',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,''.$data->VALUTA.' ',0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Premi Dasar Sekaligus',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->PREMI_BERKALA,0,',','.'),0,0,'R');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Top Up Sekaligus',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->TOPUP_SEKALIGUS,0,',','.'),'B',0,'R');
			$this->pdf->ln(5);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Total Premi yang dibayar',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->PREMI_BERKALA+$data->TOPUP_BERKALA+$data->TOPUP_SEKALIGUS,0,',','.'),0,0,'R');
			$this->pdf->SetFont('Monserrat','I',6);
			$this->pdf->Cell(10);
			$this->pdf->Cell(90,4,'PT Asurnasi Jiwa IFG berhak melakukan pemeriksaan medis bagi SPAJ non medical secara acak.',0,0,'L');			
			$this->pdf->ln(5);
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(50,4,'Medical',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);

			if($data->PEMERIKSAAN != ''){
				$this->pdf->Cell(32,4,'YA',0,0,'L');
			}else{
				$this->pdf->Cell(8,4,'TIDAK',0,0,'L');
				$this->pdf->SetFont('Monserrat','I',6);
				$this->pdf->Cell(90,4,'(Status proposal bisa berubah menjadi medical sesuai dengan penilaian underwriter perusahaan)',0,0,'L');
			}
			$this->pdf->ln(6);
		}
				
		foreach($hasilProAlokasiDana as $data) {
			$this->pdf->SetFont('Monserrat','B',7);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,4,'ALOKASI DANA INVESTASI (%)',1,0,'L', true);
			$this->pdf->ln();			
			$this->pdf->SetFont('Monserrat','',7);
			$this->pdf->Cell(95,4,''.$data->NAMA_ALOKASI1.' ','LTB',0,'L');
			$this->pdf->Cell(95,4,''.($data->ALOKASI1).' %','RTB',0,'R');			
			if($data->ALOKASI1 < 100){
				$this->pdf->ln();
				$this->pdf->SetFont('Monserrat','',7);
				$this->pdf->Cell(95,4,''.$data->NAMA_ALOKASI2.' ','LTB',0,'L');
				$this->pdf->Cell(95,4,''.($data->ALOKASI2).' %','RTB',0,'R');
				$alokasi2 = $data->NAMA_ALOKASI2;
				$proalokasi2 = $data->ALOKASI2;
				$prosalokasilow2 = $data->PROLOW2;
				$prosalokasimed2 = $data->PROMED2;
				$prosalokasihigh2 = $data->PROHIGH2;
			}
			$alokasi1 = $data->NAMA_ALOKASI1;
			$proalokasi1 = $data->ALOKASI1;
			$prosalokasilow1 = $data->PROLOW1;
			$prosalokasimed1 = $data->PROMED1;
			$prosalokasihigh1 = $data->PROHIGH1;
		}
		
		$this->pdf->ln(4);
		$this->pdf->ln(4);
		$this->pdf->SetFont('Monserrat','B',7);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'BIAYA ASURANSI',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',7);
		$this->pdf->Cell(47.5,4,'NAMA ASURANSI',1,0,'C');
		$this->pdf->Cell(47.5,4,'SAMPAI USIA TERTANGGUNG',1,0,'C');
		$this->pdf->Cell(47.5,4,'UANG ASURANSI',1,0,'C');
		$this->pdf->Cell(47.5,4,'BIAYA ASURANSI PER BULAN **',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',7);
		foreach($hasilProDataRiderNew as $data) {
			$maxasuransispousepayor = 65-$usiacalonpemegangpolis+$usiacalontertanggung;
			$maxasuransipayor = $usiacalontertanggung + min((25-$usiacalontertanggung),(65-$usiacalonpemegangpolis));

			if ($data->IS_UADASAR == 1)
			{
				foreach($hasilProTertanggung as $datas) {
					if ($datas->EKSTRALIFE_CTT != 0){
						$this->pdf->Cell(47.5,3,'Asuransi Dasar *','L',0,'L');
					}else{
						$this->pdf->Cell(47.5,3,'Asuransi Dasar','L',0,'L');
					}
				}
				$this->pdf->Cell(47.5,3,'99','L',0,'C');
				$this->pdf->Cell(47.5,3,number_format(ROUND($data->UADASAR),0,',','.'),'L',0,'R');
				$this->pdf->Cell(47.5,3,number_format(ROUND($data->BIAYA_UADASAR),0,',','.'),'LR',0,'R');
				$this->pdf->ln();
			}
		}
		$this->pdf->Cell(47.5,4,'','T',0,'L');			
		$this->pdf->Cell(47.5,4,'','T',0,'C');
		$this->pdf->Cell(47.5,4,'','T',0,'R');
		$this->pdf->Cell(47.5,4,'','T',0,'R');
		$this->pdf->ln(1);
		$this->pdf->SetFont('Monserrat','I',7);
		$this->pdf->Cell(100,3,'*   Biaya sudah termasuk extra premi karena risiko pekerjaan.','',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(100,3,'**  Biaya dapat berubah sesuai dengan penilaian dari Underwriter Perusahaan.','',0,'L');
		$this->pdf->ln(6);

		$this->pdf->SetFont('Monserrat','B',7);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'KETERANGAN MANFAAT ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);		
		$this->pdf->SetFont('Monserrat','',7);
		$this->pdf->SetLineWidth(0.2);
		foreach($hasilProDataRiderNew as $data) {
			if ($data->IS_UADASAR == 1)
			{
				$this->pdf->Cell(50,3,'Asuransi Dasar',0,0,'L');
				$this->pdf->MultiCell(140,3,'Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah besar Nilai Investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit atau karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi IFG ULTIMATE PROTECTION ditambah Saldo Dana Investasi.',0);
				$this->pdf->ln(1);
				$x = $this->pdf->GetX();
				$y = $this->pdf->GetY();
				$this->pdf->ln(2);
				$this->pdf->Line($x,$y,$x+190,$y);
			}
		}	
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		// PAGE 2
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 10, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',14);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'PT ASURANSI JIWA IFG',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190',0,0,'L');
		$this->pdf->ln(7);		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,5,'IFG ULTIMATE PROTECTION','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'HANYA SEBUAH ILUSTRASI DAN TIDAK DIJAMIN',1,0,'L', true);
		$this->pdf->ln();		
		
		$this->pdf->SetFont('Monserrat','BU',7);
		$this->pdf->Cell(70,5,' '.$alokasi1.' &  '.$alokasi2.' ','BR',0,'L');
		$this->pdf->SetFont('Monserrat','',8);		
		$this->pdf->Cell(60,5,'SALDO DANA','R',0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA','R',0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(15,3,'Tahun',1,0,'C');
		$this->pdf->Cell(15,3,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,3,'Premi',1,0,'C');
		$this->pdf->Cell(20,3,'Top Up Sekaligus',1,0,'C');

		$this->pdf->Cell(20,3,'Rendah ('.$prosalokasilow1.'%)',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang ('.$prosalokasimed1.'%)',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi ('.$prosalokasihigh1.'%)',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah ('.$prosalokasilow1.'%)',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang ('.$prosalokasimed1.'%)',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi ('.$prosalokasihigh1.'%)',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',6);

		foreach($hasilProAsuransiPokok as $data) {
			
			if ($data->CARA_BAYAR == '1')
			{
				$faktorkali = 12;
			}
			else if ($data->CARA_BAYAR == '3')
			{
				$faktorkali = 4;
			}else if ($data->CARA_BAYAR == '4')
			{
				$faktorkali = 2;
			}else
			{
				$faktorkali = 1;
			}
			
		}
		
		foreach($hasilProTotalInvestasi1 as $data) {
			
			if ($data->TAHUN <= 35)
			{
				$this->pdf->Cell(15,3,$data->TAHUN,'LBR',0,'C');
				$this->pdf->Cell(15,3,$data->USIA_TT,1,0,'C');
				$this->pdf->Cell(20,3,number_format(ROUND($data->PREMI+$data->TOPUPB)*$faktorkali,0,'.',','),1,0,'R');
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPX),0,'.',','),1,0,'R');							
				
				if ($data->INVLOW <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVLOW > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVLOW),0,'.',','),1,0,'R');	
				}
				
				if ($data->INVMED <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVMED > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVMED),0,'.',','),1,0,'R');	
				}
				
				if ($data->INVHIGH <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVHIGH > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVHIGH),0,'.',','),1,0,'R');	
				}
				

				
				if ($data->JUAINVLOW <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVLOW > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVLOW),0,'.',','),1,0,'R');	
				}
				
				
				if ($data->JUAINVMED <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVMED > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVMED),0,'.',','),1,0,'R');	
				}
				
				
				if ($data->JUAINVHIGH <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVHIGH > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVHIGH),0,'.',','),1,0,'R');	
				}

				$this->pdf->ln();
			}
			else if ($data->USIA_TT == 80)
			{
				$this->pdf->Cell(15,3,$data->TAHUN,'LBR',0,'C');
				$this->pdf->Cell(15,3,$data->USIA_TT,1,0,'C');
				$this->pdf->Cell(20,3,number_format(ROUND($data->PREMI+$data->TOPUPB)*$faktorkali,0,'.',','),1,0,'R');
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPX),0,'.',','),1,0,'R');							

				if ($data->INVLOW <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVLOW > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVLOW),0,'.',','),1,0,'R');	
				}
				
				if ($data->INVMED <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVMED > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVMED),0,'.',','),1,0,'R');	
				}
				
				if ($data->INVHIGH <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVHIGH > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVHIGH),0,'.',','),1,0,'R');	
				}
				

				
				if ($data->JUAINVLOW <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVLOW > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVLOW),0,'.',','),1,0,'R');	
				}
				
				
				if ($data->JUAINVMED <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVMED > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVMED),0,'.',','),1,0,'R');	
				}
				
				
				if ($data->JUAINVHIGH <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVHIGH > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVHIGH),0,'.',','),1,0,'R');	
				}	
				$this->pdf->ln();	
			}
			else if ($data->USIA_TT == 99)
			{	
				$this->pdf->Cell(15,3,$data->TAHUN,'LBR',0,'C');
				$this->pdf->Cell(15,3,$data->USIA_TT,1,0,'C');
				$this->pdf->Cell(20,3,number_format(ROUND($data->PREMI+$data->TOPUPB)*$faktorkali,0,'.',','),1,0,'R');
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPX),0,'.',','),1,0,'R');							

				if ($data->INVLOW <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVLOW > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVLOW),0,'.',','),1,0,'R');	
				}
				
				if ($data->INVMED <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVMED > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVMED),0,'.',','),1,0,'R');	
				}
				
				if ($data->INVHIGH <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->INVHIGH > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->INVHIGH),0,'.',','),1,0,'R');	
				}
				

				
				if ($data->JUAINVLOW <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVLOW > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVLOW),0,'.',','),1,0,'R');	
				}
				
				
				if ($data->JUAINVMED <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVMED > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVMED),0,'.',','),1,0,'R');	
				}
				
				
				if ($data->JUAINVHIGH <= 0)
				{
					$this->pdf->Cell(20,3,'***',1,0,'R');	
				}
				else if ($data->JUAINVHIGH > 0)
				{
					$this->pdf->Cell(20,3,number_format(ROUND($data->JUAINVHIGH),0,'.',','),1,0,'R');	
				}	
				$this->pdf->ln(5);	
			}
			
		}
		
		// ASUMSI TINGKAT INVESTASI
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(190,3,'Asumsi tingkat investasi yang digunakan adalah sebagai berikut :',0,0,'L');
		$this->pdf->ln(5);
		
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Dana Investasi',1,0,'C');
		$this->pdf->Cell(20,3,'Nilai Alokasi',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah **',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang **',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi **',1,0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(40,3,$alokasi1,1,0,'C');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(20,3,$proalokasi1.' %',1,0,'C');
		$this->pdf->Cell(20,3,$prosalokasilow1.' %',1,0,'C');
		$this->pdf->Cell(20,3,$prosalokasimed1.' %',1,0,'C');
		$this->pdf->Cell(20,3,$prosalokasihigh1.' %',1,0,'C');
		$this->pdf->ln(4);

		if($proalokasi1 < 100){
			$this->pdf->ln(2);
			$this->pdf->SetFont('Monserrat','',6);
			$this->pdf->Cell(40,3,'Dana Investasi',1,0,'C');
			$this->pdf->Cell(20,3,'Nilai Alokasi',1,0,'C');
			$this->pdf->Cell(20,3,'Rendah **',1,0,'C');
			$this->pdf->Cell(20,3,'Sedang **',1,0,'C');
			$this->pdf->Cell(20,3,'Tinggi **',1,0,'C');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Monserrat','B',6);
			$this->pdf->Cell(40,3,$alokasi2,1,0,'C');
			$this->pdf->SetFont('Monserrat','',6);
			$this->pdf->Cell(20,3,$proalokasi2.' %',1,0,'C');
			$this->pdf->Cell(20,3,$prosalokasilow2.' %',1,0,'C');
			$this->pdf->Cell(20,3,$prosalokasimed2.' %',1,0,'C');
			$this->pdf->Cell(20,3,$prosalokasihigh2.' %',1,0,'C');
			$this->pdf->ln(4);
		}
		
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(20,3,'^',0,0,'L');
		$this->pdf->Cell(170,3,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'*',0,0,'L');
		$this->pdf->Cell(170,3,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'**',0,0,'L');
		$this->pdf->MultiCell(170,3,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0,'J');
		$this->pdf->Cell(20,3,'***',0,0,'L');
		$this->pdf->MultiCell(170,3,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melakukan top up sekaligus.',0,'J');
		$this->pdf->Cell(20,3,'****',0,0,'L');
		$this->pdf->MultiCell(170,3,'Saldo Dana telah mempertimbangkan seluruh biaya-biaya',0,'J');
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');

		// PAGE 5
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 10, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',14);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'PT ASURANSI JIWA IFG',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190',0,0,'L');
		$this->pdf->ln(7);		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,5,'IFG ULTIMATE PROTECTION','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'HANYA SEBUAH ILUSTRASI DAN TIDAK DIJAMIN',1,0,'L', true);
		$this->pdf->ln(5);

		
		// HAL-HAL PENTING
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'HAL-HAL PENTING',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Monserrat','',6);
		
		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '1.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Alokasi Premi yang dibentuk ke dalam Premi.',0);

		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(90,5,'',0,0,'C');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(90,5,'Tahun 1',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(90,5,'Premi Sekaligus',1,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(90,5,'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'Investasi',1,0,'C');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'95%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'Biaya',1,0,'C');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'5%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(90,5,'Top Up Sekaligus',1,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(90,5,'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'Investasi',1,0,'C');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'95%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(7);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'Biaya',1,0,'C');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(90,5,'5%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(6);
		$this->pdf->ln();
		
		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '2.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Ilustrasi di atas akan diperhitungkan dengan:',0);

		$this->pdf->Cell(10,5, 'a.',0,0,'R');
		$this->pdf->MultiCell(180,5,'Biaya administrasi sebesar Rp. 27.500,- per bulan selama masa asuransi.',0);

		$this->pdf->Cell(10,5, 'b.',0,0,'R');
		$this->pdf->MultiCell(180,5,'Biaya Asuransi (Cost Of insurance dan Cost Of Rider) akan dikenakan setiap bulan selama masa Asuransi. Besarnya COI dan COR akan naik setiap tahun sesuai dengan bertambahnya usia Tertanggung.',0);

		$this->pdf->Cell(10,5, 'c.',0,0,'R');
		$this->pdf->MultiCell(180,5,'Biaya pengelolaan investasi maksimal 2% per tahun tergantung jenis reksadana yang dipilih.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '3.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Unit yang dihitung berdasarkan Harga Unit pada saat tertentu.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '4.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '5.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Perubahan harga unit menggambarkan hasil investasi dari dana investasi. Kinerja dari investasi tidak dijamin tergantung dari risiko masing-masing dana investasi. Pemegang Polis diberi keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan Optimalisasi tingkat pengembalian investasi, sesuai dengan kebutuhan dan profil risiko Pemegang Polis',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '6.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Besarnya Nilai Tunai yang dibayarkan (bisa lebih besar atau lebih kecil dari yang diilustrasikan) akan bergantung pada perkembangan dari dana investasi IFG ULTIMATE PROTECTION.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '7.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Jumlah minimum Top Up Sekaligus adalah Rp. 1.000.000,-.',0);
		
		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '8.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Minimum penarikan dana (Redemptions) adalah Rp. 1.000.000,- dan menyisakan dana minimum setara dengan 1.000 unit.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '9.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Polis bebas biaya penarikan dana.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '10.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Penilaian harga unit dilakukan pada setiap hari kerja, Senin sampai dengan Jum`at dengan menggunakan metode harga pasar yang berlaku bagi instrumen investasi yang mendasari masing-masing alokasi dana investasi yang dipilih.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '11.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Besarnya Nilai Tunai yang terbentuk pada polis ini (dapat lebih besar atau lebih kecil dari dana yang diinvestasikan oleh Pemegang Polis), akan dipengaruhi oleh fluktuasi dari harga unit atau faktor biaya-biaya sebagaimana disebutkan di atas.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '12.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Harga unit yang digunakan pada Premi Pertama akan terbentuk setelah diterimanya SPAJ dan teridentifikasinya seluruh pembayaran Premi Pertama di Kantor Pusat oleh PT Asuransi Jiwa IFG. Tanggal Perhitungan Harga Unit adalah Tanggal Perhitungan berikutnya setelah diterimanya SPAJ. Atau teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat, mana yang paling akhir.',0);

		$this->pdf->Cell(1);
		$this->pdf->Cell(5,5, '13.',0,0,'L');
		$this->pdf->MultiCell(185,5,'Memiliki Polis Asuransi Jiwa merupakan komitmen jangka panjang. IFG ULTIMATE PROTECTION adalah suatu produk asuransi jiwa yang dikaitkan dengan investasi. Untuk dapat menikmati manfaat polis ini, maka kami sarankan Anda untuk melakukan top up sekaligus pada Masa Asuransi.',0);

		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');

		// PAGE 4
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 10, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',14);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'PT ASURANSI JIWA IFG',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190',0,0,'L');
		$this->pdf->ln(7);		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,5,'IFG ULTIMATE PROTECTION','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'HANYA SEBUAH ILUSTRASI DAN TIDAK DIJAMIN',1,0,'L', true);
		$this->pdf->ln(5);

		// RINGKASAN MANFAAT
		foreach($hasilProTertanggung as $data) {
			
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(190,5,'RINGKASAN MANFAAT',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(50,5,'Nama Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(32,5,''.$data->NAMA.' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(50,5,'Usia Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(32,5,''.$data->USIA_TH.' Tahun',0,0,'L');
			
		}

		foreach($hasilProAsuransiPokok as $data) {
			
		$this->pdf->ln(4);
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(50,5,'A. Masa Pembayaran Premi adalah sekaligus',0,0,'L');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','I',8);
		$this->pdf->Cell(190,5,'Informasi mengenai Uraian Biaya-biaya terdapat dalam halaman Hal-Hal Penting.',0,0,'L');
		
		}
		
		$this->pdf->ln(4);
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(50,5,'B. Asumsi Nilai Tunai dimasa yang akan datang **',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(47.5,5,'USIA',1,0,'C');
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(47.5,5,'RENDAH',1,0,'C');
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(47.5,5,'SEDANG',1,0,'C');
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(47.5,5,'TINGGI',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',8);
		foreach($hasilProTotalKomparasi as $data) {
			
			if ($data->USIA_TT == 50)
			{
				$this->pdf->Cell(47.5,5,$data->USIA_TT,1,0,'C');
				
				if ($data->INVLOW <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVLOW),0,'.',','),1,0,'R');
				}
				
				if ($data->INVMED <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVMED),0,'.',','),1,0,'R');
				}
				
				if ($data->INVHIGH <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVHIGH),0,'.',','),1,0,'R');
				}
				
				$this->pdf->ln();
			}
			else if ($data->USIA_TT == 60)
			{
				$this->pdf->Cell(47.5,5,$data->USIA_TT,1,0,'C');
				if ($data->INVLOW <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVLOW),0,'.',','),1,0,'R');
				}
				
				if ($data->INVMED <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVMED),0,'.',','),1,0,'R');
				}
				
				if ($data->INVHIGH <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVHIGH),0,'.',','),1,0,'R');
				}
				$this->pdf->ln();
			}
			else if ($data->USIA_TT == 70)
			{
				$this->pdf->Cell(47.5,5,$data->USIA_TT,1,0,'C');
				if ($data->INVLOW <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVLOW),0,'.',','),1,0,'R');
				}
				
				if ($data->INVMED <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVMED),0,'.',','),1,0,'R');
				}
				
				if ($data->INVHIGH <= 0)
				{
					$this->pdf->Cell(47.5,5,'***',1,0,'R');	
				}
				else
				{
					$this->pdf->Cell(47.5,5,number_format(ROUND($data->INVHIGH),0,'.',','),1,0,'R');
				}
				$this->pdf->ln();
			}
		}
		$this->pdf->ln();
		
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(10,5,'*',0,0,'L');
		$this->pdf->Cell(180,5,'Sesuai dengan cuti premi yang dipilih.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(10,5,'**',0,0,'L');
		$this->pdf->Cell(180,5,'Nilai Tunai dihitung dengan menggunakan asumsi tingkat investasi. Besarnya Nilai Tunai yang dibayarkan (dapat lebih',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(180,5,'besar atau lebih kecil dari yang diilustrasikan), akan bergantung pada perkembangan dari dana investasi.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(10,5,'***',0,0,'L');
		$this->pdf->Cell(180,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan Administrasi, dan oleh karena itu',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(190,5,'Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melakukan top up sekaligus.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(190,5,'',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(50,5,'C. Asuransi Dasar',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(60,5,'(Hanya untuk ilustrasi, keterangan lengkap menganai Manfaat Asuransi pada produk Asuransi, termasuk syarat-syarat dan pengecualian tercantum pada Polis dan berlaku mengikat)',0,0,'L');
		$this->pdf->SetFont('Monserrat','',8);
		
		$this->pdf->ln();
		$this->pdf->MultiCell(150, 3, 'Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah besar Nilai Investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit atau karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi IFG ULTIMATE PROTECTION ditambah Saldo Dana Investasi.', '0','0');
				
		foreach($hasilProDataRiderNew as $data) {
			if ($data->IS_UADASAR == 1)
			{
				
				$this->pdf->Text(180, 124, "".  number_format($data->UADASAR,0,'.',','));
				
			}
		}
		
		$this->pdf->ln(3);

		$this->pdf->ln();
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		// PAGE 9
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 10, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',14);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'PT ASURANSI JIWA IFG',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190',0,0,'L');
		$this->pdf->ln(15);		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,5,'IFG ULTIMATE PROTECTION','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'HANYA SEBUAH ILUSTRASI DAN TIDAK DIJAMIN',1,0,'L', true);
		$this->pdf->ln(10);
		
		// RISIKO
		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,10,'RISIKO','BT',0,'C');
		$this->pdf->ln(15);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->Cell(190,5,'Risiko Asuransi Unit Link',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(190,5,'Harga Unit dapat mengalami fluktuasi mengikuti harga pasar. Hal ini akan terlihat pada volatilitas dari harga unit dan akan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(190,5,'menyebabkan kemungkinan terjadinya kenaikan atau penurunan nilai investasi.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->Cell(190,5,'Risiko Operasional',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(190,5,'Suatu risiko kerugian yang disebabkan karena tak berjalannya atau gagalnya proses internal, manusia, dan sistem serta',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(190,5,'oleh peristiwa eksternal.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(190,5,'Pertanggungan asuransi IFG ULTIMATE PROTECTION tidak berlaku apabila Tertanggung meninggal dalam keadaan sebagai berikut:',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(10,5,'a. ',0,0,'L');
		$this->pdf->Cell(180,5,'Akibat tindakan bunuh diri yang terjadi dalam waktu 2 (dua) tahun terhitung sejak Tanggal Penerbitan Polis atau',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Addendum yang terkini atau tanggal penerbitan pemulihan yang terkini (mana saja yang terjadi terakhir).',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(10,5,'b. ',0,0,'L');
		$this->pdf->Cell(180,5,'Tertanggung sedang/sebagai akibat melakukan tindak kejahatan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(10,5,'c. ',0,0,'L');
		$this->pdf->Cell(180,5,'Tertanggung menjalani eksekusi hukuman mati oleh pengadilan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(10,5,'d. ',0,0,'L');
		$this->pdf->Cell(180,5,'Terjadi akibat tindak kejahatan atau pembunuhan yang dilakukan oleh yang berkepentingan dalam pertanggungan.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(190,5,'Note: Detail lengkap klausul Pengecualian dinyatakan dalam Ketentuan Umum dan Ketentuan Khusus Polis.',0,0,'L');
		$this->pdf->ln();

		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
	

		// PAGE 10
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 10, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','B',14);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'PT ASURANSI JIWA IFG',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',10);
		$this->pdf->Cell(35, 4, '', 0, 0, 'L');
		$this->pdf->Cell(165,4,'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190',0,0,'L');
		$this->pdf->ln(15);		$this->pdf->SetFont('Monserrat','B',12);
		$this->pdf->Cell(190,5,'IFG ULTIMATE PROTECTION','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Monserrat','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'HANYA SEBUAH ILUSTRASI DAN TIDAK DIJAMIN',1,0,'L', true);
		$this->pdf->ln(10);
		
		// DISAJIKAN OLEH
		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(190,5,'DISAJIKAN OLEH',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(50,5,'Nama Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(32,5,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(50,5,'Nomor Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(32,5,''.$nomeragen.'',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(50,5,'Tanggal Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(32,5,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->ln(50);

		$this->pdf->SetFont('Monserrat','B',8);
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'C');
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'C');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Monserrat','',8);
		$this->pdf->Cell(95,5,''.substr($namaagen,0,9).' ',0,0,'C');
		// CALON PEMEGANG POLIS
		foreach($hasilProPempol as $data) {
			$this->pdf->Cell(95,5,''.$data->NAMA.' ',0,0,'C');
		}
		$this->pdf->ln();
		$this->pdf->SetFont('Monserrat','I',6);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'C');
		$this->pdf->Cell(95,5,'Saya telah membaca, memahami dan mengerti risiko dan isi dari ilustrasi ini.',0,0,'C');
		$this->pdf->ln();

		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',5);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Monserrat','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Monserrat','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		$this->pdf->Output();
//		$this->pdf->Output('./files/pdf/'.$_GET['filepdf'].'.pdf','F');

?>