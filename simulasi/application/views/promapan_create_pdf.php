<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Connection: close");
/*
foreach($hasilProTertanggung as $data) {
	echo $data->BUILD_ID;
	echo $data->HUBUNGAN;
	echo $data->JENIS_KELAMIN;
	echo $data->TGL_LAHIR;
	echo $data->JENIS_KELAMIN;
	echo $data->IS_PEROKOK;
	echo $data->USIA_BL;
}
*/

		
		$kodeprospek = $_GET['kodeprospek'];
		$DataAgen = $this->ModSimulasi->GetDataAgen($kodeprospek);
		$idAgen = $DataAgen['NOAGEN'];
		
		$api = json_decode(file_get_contents(C_URL_API_JAIM."/agen.php?r=1&p=$idAgen"), true);
		
		$namaagen = $api['NAMALENGKAP'];
		$nomeragen = $idAgen;
		$kantorcabang = str_replace("KANTOR CABANG","",$api['NAMAKANTOR']);


		$image1 = FCPATH.'assets/img/logo-js.png';
	    // Generate PDF by saying hello to the world
		
		// Page 1
		$this->pdf->AddPage();

		

		// HEADER
		$this->pdf->Image($image1, 170, 5);
		
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,4,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,4,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,4,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(50,4,'Nomor Proposal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,$_GET['build_id'],0,0,'L');
		$this->pdf->Cell(10);
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->Cell(50,4,'Tanggal Ilustrasi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,4,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(32,4,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->ln(5);
		
				
		// CALON PEMEGANG POLIS
		foreach($hasilProPempol as $data) {
			
		
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,3,'CALON PEMEGANG POLIS',1,0,'L', true);
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Nama Pemegang Polis',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->NAMA.' ',0,0,'L');
			
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Jenis Kelamin',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->JENIS_KELAMIN == 'L' ? 'Laki-Laki' : 'Perempuan').' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Tanggal Lahir',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.date('d/m/Y',strtotime($data->TGL_LAHIR)).' / '.$data->USIA_TH.' Tahun',0,0,'L');
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Status Perokok',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->IS_PEROKOK == 'Y' ? 'Perokok' : 'Tidak').' ',0,0,'L');
			$this->pdf->ln();			
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Telp',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->TELEPON.' ',0,0,'L');
			//$this->pdf->ln(5);
			
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Hp',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->HP.' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Email',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->EMAIL.' ',0,0,'L');			
			
		}
		
		// CALON Tertangggung
		foreach($hasilProTertanggung as $data) {
			
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,4,'CALON TERTANGGUNG',1,0,'L', true);
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Nama Tertangggung',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->NAMA.' ',0,0,'L');
			
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Jenis Kelamin',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->JENIS_KELAMIN == 'L' ? 'Laki-Laki' : 'Perempuan').' ',0,0,'L');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Tanggal Lahir',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.$data->TGL_LAHIR.' / '.$data->USIA_TH.' tahun',0,0,'L');
			$this->pdf->Cell(10);
			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,3,'Status Perokok',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,3,''.($data->IS_PEROKOK == 'Y' ? 'Perokok' : 'Tidak').' ',0,0,'L');
			$this->pdf->ln();

			$this->pdf->SetFont('Arial','',7);
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
				$data->HUBUNGAN = 'ANAK';	
			}
			$this->pdf->Cell(32,3,''.($data->HUBUNGAN).' ',0,0,'L');
			$this->pdf->ln(1);		
			
		}
		
		foreach($hasilProAsuransiPokok as $data) {
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(190,4,'','B',1,'L');
			$this->pdf->ln(1);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Cara Bayar',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,''.($data->CARA_BAYAR == '1' ? 'BULANAN' : 'TAHUNAN').' ',0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Uang Pertanggungan',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->UA,0,',','.'),0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Mata Uang',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,''.$data->VALUTA.' ',0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Premi Berkala',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->PREMI_BERKALA,0,',','.'),0,0,'R');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Top Up Berkala',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->TOPUP_BERKALA,0,',','.'),0,0,'R');
			$this->pdf->ln(3);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Top Up Sekaligus',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->TOPUP_SEKALIGUS,0,',','.'),'B',0,'R');
			$this->pdf->ln(5);
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(50,4,'Total Premi yang dibayar',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,4,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(32,4,number_format($data->PREMI_BERKALA+$data->TOPUP_BERKALA+$data->TOPUP_SEKALIGUS,0,',','.'),0,0,'R');
			$this->pdf->SetFont('Arial','I',6);
			$this->pdf->Cell(10);
			$this->pdf->Cell(90,4,'Jiwasraya berhak melakukan pemeriksaan medis bagi SPAJ non medical secara acak.',0,0,'L');			
			$this->pdf->ln(6);	
		}
				
		foreach($hasilProAlokasiDana as $data) {
			$this->pdf->SetFont('Arial','B',7);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,4,'ALOKASI DANA INVESTASI (%)',1,0,'L', true);
			$this->pdf->ln();			
			$this->pdf->SetFont('Arial','',7);
			$this->pdf->Cell(95,4,''.$data->NAMA_ALOKASI1.' ','LTB',0,'L');
			$this->pdf->Cell(95,4,''.($data->ALOKASI1).' %','RTB',0,'R');			
			if($data->ALOKASI1 < 100){
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',7);
				$this->pdf->Cell(95,4,''.$data->NAMA_ALOKASI2.' ','LTB',0,'L');
				$this->pdf->Cell(95,4,''.($data->ALOKASI2).' %','RTB',0,'R');
				$alokasi2 = $data->NAMA_ALOKASI2;
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
		$this->pdf->SetFont('Arial','B',7);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'BIAYA ASURANSI',1,0,'L', true);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',7);
		$this->pdf->Cell(47.5,4,'NAMA ASURANSI',1,0,'C');
		$this->pdf->Cell(47.5,4,'SAMPAI USIA TERTANGGUNG',1,0,'C');
		$this->pdf->Cell(47.5,4,'UANG ASURANSI',1,0,'C');
		$this->pdf->Cell(47.5,4,'BIAYA ASURANSI PER BULAN',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',7);
		foreach($hasilProDataRider as $data) {	
			if ($data->UA != 0)
			{
				$this->pdf->Cell(47.5,3,$data->NAMA,'L',0,'L');			
				$this->pdf->Cell(47.5,3,$data->SU,'L',0,'C');
				$this->pdf->Cell(47.5,3,number_format(ROUND($data->UA),0,',','.'),'L',0,'R');
				$this->pdf->Cell(47.5,3,number_format(ROUND($data->PREMI),0,',','.'),'LR',0,'R');			
				$this->pdf->ln();
			}
		}
		$this->pdf->Cell(47.5,4,'','T',0,'L');			
		$this->pdf->Cell(47.5,4,'','T',0,'C');
		$this->pdf->Cell(47.5,4,'','T',0,'R');
		$this->pdf->Cell(47.5,4,'','T',0,'R');			
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','B',7);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,4,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);		
		$this->pdf->SetFont('Arial','',7);
		$this->pdf->SetLineWidth(0.2);			
		
		foreach($hasilProDataRider as $data) {						
			$this->pdf->Cell(40,3,$data->NAMA,0,0,'L');
			$this->pdf->MultiCell(150,3,$data->DESKRIPSI,0);
			$x = $this->pdf->GetX();			
			$y = $this->pdf->GetY();
			$this->pdf->ln(2);						
			$this->pdf->Line($x,$y,$x+190,$y);			
		}
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').'',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		// PAGE 2
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln();		
		
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(70,5,$alokasi1,'BR',0,'L');
		$this->pdf->SetFont('Arial','',8);		
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI','R',0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA','R',0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
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
		$this->pdf->SetFont('Arial','',6);

		foreach($hasilProAsuransiPokok as $data) {
			
			if ($data->CARA_BAYAR == '1')
			{
				$faktorkali = 12;	
				
			}
			else if ($data->CARA_BAYAR == '2')
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
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,3,'Asumsi tingkat investasi yang digunakan adalah sebagai berikut :',0,0,'L');
		$this->pdf->ln(5);
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Dana Investasi',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah **',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang **',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi **',1,0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(40,3,$alokasi1,1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,3,$prosalokasilow1.' %',1,0,'C');
		$this->pdf->Cell(20,3,$prosalokasimed1.' %',1,0,'C');
		$this->pdf->Cell(20,3,$prosalokasihigh1.' %',1,0,'C');
		$this->pdf->ln(4);
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,3,'^',0,0,'L');
		$this->pdf->Cell(170,3,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'*',0,0,'L');
		$this->pdf->Cell(170,3,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'**',0,0,'L');
		$this->pdf->Cell(170,3,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'',0,0,'L');
		$this->pdf->Cell(170,3,'terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'***',0,0,'L');
		$this->pdf->Cell(170,3,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse). Supaya ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'',0,0,'L');
		$this->pdf->Cell(170,3,'Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		$this->pdf->ln();
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		if($proalokasi1 < 100){
			// PAGE 3 kalau alokasi ada 2
			$this->pdf->AddPage();
			
			// HEADER
			$this->pdf->Image($image1, 170, 5);
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','B',14);
			$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',10);
			$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
			$this->pdf->ln(7);
			$this->pdf->SetFont('Arial','B',12);
			$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
			$this->pdf->ln(7);
			$this->pdf->SetFont('Arial','B',10);
			$this->pdf->SetFillColor(200,200,200);
			$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
			$this->pdf->ln();			
			
			$this->pdf->SetFont('Arial','BU',8);
			$this->pdf->Cell(70,5,$alokasi2,'BR',0,'L');//$alokasi2
			$this->pdf->SetFont('Arial','',8);		
			$this->pdf->Cell(60,5,'MANFAAT INVESTASI','R',0,'C');
			$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA','R',0,'C');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(15,3,'Tahun',1,0,'C');
			$this->pdf->Cell(15,3,'Usia ^',1,0,'C');
			$this->pdf->Cell(20,3,'Premi',1,0,'C');
			$this->pdf->Cell(20,3,'Top Up Sekaligus',1,0,'C');
			$this->pdf->Cell(20,3,'Rendah ('.$prosalokasilow2.'%)',1,0,'C');
			$this->pdf->Cell(20,3,'Sedang ('.$prosalokasimed2.'%)',1,0,'C');
			$this->pdf->Cell(20,3,'Tinggi ('.$prosalokasihigh2.'%)',1,0,'C');
			$this->pdf->Cell(20,3,'Rendah ('.$prosalokasilow2.'%)',1,0,'C');
			$this->pdf->Cell(20,3,'Sedang ('.$prosalokasimed2.'%)',1,0,'C');
			$this->pdf->Cell(20,3,'Tinggi ('.$prosalokasihigh2.'%)',1,0,'C');
			$this->pdf->ln();
			$this->pdf->SetFont('Arial','',6);
			
			foreach($hasilProAsuransiPokok as $data) {
			
				if ($data->CARA_BAYAR == '1')
				{
					$faktorkali = 12;	

				}
				else if ($data->CARA_BAYAR == '2')
				{
					$faktorkali = 1;	
				}

			}
			
			foreach($hasilProTotalInvestasi2 as $data) {
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
					$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(190,3,'Asumsi tingkat investasi yang digunakan adalah sebagai berikut :',0,0,'L');
			$this->pdf->ln(5);
			
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(40,3,'Dana Investasi',1,0,'C');
			$this->pdf->Cell(20,3,'Rendah **',1,0,'C');
			$this->pdf->Cell(20,3,'Sedang **',1,0,'C');
			$this->pdf->Cell(20,3,'Tinggi **',1,0,'C');
			$this->pdf->ln();
			
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(40,3,$alokasi2,1,0,'C');
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(20,3,$prosalokasilow2.' %',1,0,'C');
			$this->pdf->Cell(20,3,$prosalokasimed2.' %',1,0,'C');
			$this->pdf->Cell(20,3,$prosalokasihigh2.' %',1,0,'C');
			$this->pdf->ln(4);
			
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(20,3,'^',0,0,'L');
			$this->pdf->Cell(170,3,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(20,3,'*',0,0,'L');
			$this->pdf->Cell(170,3,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(20,3,'**',0,0,'L');
			$this->pdf->Cell(170,3,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(20,3,'',0,0,'L');
			$this->pdf->Cell(170,3,'yang terendah dan tertinggi.',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(20,3,'***',0,0,'L');
			$this->pdf->Cell(170,3,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse).',0,0,'L');
			$this->pdf->ln();
			$this->pdf->Cell(20,3,'',0,0,'L');
			$this->pdf->Cell(170,3,'Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
			$this->pdf->ln();
			
			// FOOTER
			$this->pdf->SetY(-37);
			$this->pdf->Cell(190,4,'','B',0,'L');
			$this->pdf->ln(4);

			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(3);
			$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(5);
			$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(3);
			$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
			$this->pdf->Cell(5);
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
			$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
			$this->pdf->ln();

			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(3);
			$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(5);
			$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->SetFont('Arial','',4);
			$this->pdf->Cell(3);
			$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
			$this->pdf->Cell(5);
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(40,3,'','LR',0,'C');
			$this->pdf->Cell(40,3,'','LR',0,'C');
			$this->pdf->ln();

			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(8,3,'Build ID',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,':',0,0,'L');
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(3);
			$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
			$this->pdf->SetFont('Arial','B',6);
			$this->pdf->Cell(5);
			$this->pdf->Cell(10,3,'',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,3,'',0,0,'L');
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(3);
			$this->pdf->Cell(17,3,''.''.'',0,0,'L');
			$this->pdf->Cell(5);
			$this->pdf->SetFont('Arial','',6);
			$this->pdf->Cell(40,3,'','LBR',0,'C');
			$this->pdf->Cell(40,3,'','LBR',0,'C');

			$this->pdf->ln();
			$this->pdf->AliasNbPages('{totalPages}');
			$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
			
		}
		
		// PAGE 4
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln();		
		
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(70,5,'RINGKASAN','BR',0,'L');
		$this->pdf->SetFont('Arial','',8);		
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI','R',0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA','R',0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15,3,'Tahun',1,0,'C');
		$this->pdf->Cell(15,3,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,3,'Premi',1,0,'C');
		$this->pdf->Cell(20,3,'Top Up Sekaligus',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);

		foreach($hasilProAsuransiPokok as $data) {
			
			if ($data->CARA_BAYAR == '1')
			{
				$faktorkali = 12;	

			}
			else if ($data->CARA_BAYAR == '2')
			{
				$faktorkali = 1;	
			}

		}
		
		foreach($hasilProTotalRingkasan as $data) {
			if ($data->TAHUN <= 35)
			{
				$this->pdf->Cell(15,3,$data->TAHUN,'LBR',0,'C');
				$this->pdf->Cell(15,3,$data->USIA_TT,1,0,'C');
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,3,'^',0,0,'L');
		$this->pdf->Cell(170,3,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'*',0,0,'L');
		$this->pdf->Cell(170,3,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'**',0,0,'L');
		$this->pdf->Cell(170,3,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'',0,0,'L');
		$this->pdf->Cell(170,3,'yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'***',0,0,'L');
		$this->pdf->Cell(170,3,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse).',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'',0,0,'L');
		$this->pdf->Cell(170,3,'Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		$this->pdf->ln();
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		// PAGE 5
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln();				
		
		$this->pdf->SetFont('Arial','BU',8);
		$this->pdf->Cell(70,5,'KOMPARASI RINGKASAN','BR',0,'L');
		$this->pdf->SetFont('Arial','',8);		
		$this->pdf->Cell(60,5,'MANFAAT INVESTASI','R',0,'C');
		$this->pdf->Cell(60,5,'MANFAAT MENINGGAL DUNIA','R',0,'C');
		$this->pdf->ln();
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(15,3,'Tahun',1,0,'C');
		$this->pdf->Cell(15,3,'Usia ^',1,0,'C');
		$this->pdf->Cell(20,3,'Premi',1,0,'C');
		$this->pdf->Cell(20,3,'Top Up Sekaligus',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi',1,0,'C');
		$this->pdf->Cell(20,3,'Rendah',1,0,'C');
		$this->pdf->Cell(20,3,'Sedang',1,0,'C');
		$this->pdf->Cell(20,3,'Tinggi',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);

		foreach($hasilProAsuransiPokok as $data) {
			
			if ($data->CARA_BAYAR == '1')
			{
				$faktorkali = 12;	

			}
			else if ($data->CARA_BAYAR == '2')
			{
				$faktorkali = 1;	
			}

		}
		
		foreach($hasilProTotalKomparasi as $data) {
			if ($data->TAHUN <= 35)
			{
				$this->pdf->Cell(15,3,$data->TAHUN,'LBR',0,'C');
				$this->pdf->Cell(15,3,$data->USIA_TT,1,0,'C');
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
				$this->pdf->Cell(20,3,number_format(ROUND($data->TOPUPB+$data->PREMI)*$faktorkali,0,'.',','),1,0,'R');
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
		
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,3,'1',0,0,'L');
		$this->pdf->Cell(170,3,'Apabila pembayaran premi dilakukan sampai usia Tertanggung 99 Tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(20,3,'^',0,0,'L');
		$this->pdf->Cell(170,3,'Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'*',0,0,'L');
		$this->pdf->Cell(170,3,'Ilustrasi di atas dalam ribuan rupiah.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'**',0,0,'L');
		$this->pdf->Cell(170,3,'Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'',0,0,'L');
		$this->pdf->Cell(170,3,'yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'***',0,0,'L');
		$this->pdf->Cell(170,3,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse).',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(20,3,'',0,0,'L');
		$this->pdf->Cell(170,3,'Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti dinyatakan dalam ilutrasi ini.',0,0,'L');
		$this->pdf->ln();
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');

		
		foreach($hasilProDataRider as $data) {
				
				if ($data->NAMA == 'JS HCP')
				{
					// PAGE JS HCP
					$this->pdf->AddPage();

					// HEADER
					$this->pdf->Image($image1, 170, 5);
					$this->pdf->ln();
					$this->pdf->SetFont('Arial','B',14);
					$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
					$this->pdf->ln();
					$this->pdf->SetFont('Arial','',10);
					$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
					$this->pdf->ln(7);
					$this->pdf->SetFont('Arial','B',12);
					$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
					$this->pdf->ln(7);
					$this->pdf->SetFont('Arial','B',10);
					$this->pdf->SetFillColor(200,200,200);
					$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
					$this->pdf->ln(5);

					// MANFAAT JS HOSPITAL CASH PLAN
					$this->pdf->SetFont('Arial','B',8);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'Manfaat JS Hospital Cash Plan',0,0,'L');
					$this->pdf->ln(6);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'Santunan','LTR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'HCP - 100','LTR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'HCP - 200','LTR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'HCP - 300','LTR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'HCP - 400','LTR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'HCP - 500','LTR',0,'C');
					$this->pdf->ln();
					$this->pdf->Cell(31.67,5,'(dalam ribuan Rupiah)','LBR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->ln();
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'Santunan harian RS','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'100','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'200','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'300','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'400','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'500','LTR',0,'C');
					$this->pdf->ln();
					$this->pdf->Cell(31.67,5,'Maksimal 180 hari / tahun','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->ln();
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'Santunan harian ICU / ICCU','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'200','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'400','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'600','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'800','LTR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'1,000','LTR',0,'C');
					$this->pdf->ln();
					$this->pdf->Cell(31.67,5,'Maksimal 10 hari / perawatan','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'','LBR',0,'C');
					$this->pdf->ln();
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'Biaya Operasi',1,0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'1,000',1,0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'2,000',1,0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'3,000',1,0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'4,000',1,0,'C');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(31.67,5,'5,000',1,0,'C');
					$this->pdf->ln(6);

					// PENGECUALIAN
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'Pengecualian',0,0,'L');
					$this->pdf->ln();
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'1. Masa Tunggu',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Penyakit yang diderita Tertanggung dalam Masa Tunggu. Perawatan rawat inap yang disebabkan oleh Kecelakaan, tidak ada masa tunggu.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'2. Akibat Perbuatan Sendiri',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Akibat percobaan bunuh diri atau cidera yang diakibatkan oleh perbuatan sendiri yang disengaja baik dalam keadaan sadar maupun tidak sadar.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'3. Alat Kosmetika',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Operasi atau perawatan kosmetika kecuali yang dinyatakan perlu karena akibat Kecelakaan yang terjadi selama Masa Asuransi.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'4. Tindak Kejahatan',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Perawatan yang disebabkan karena Tertanggung dengan sengaja melakukan atau turut serta dalam tindak kejahatan.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'5. Cacat Bawaan',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Cacat bawaan (kelainan fisik sebelum dan atau yang terbentuk dalam waktu 14 (empat belas) hari setelah lahir).',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'6. Kejiwaan',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Penyakit kejiwaan dan gangguan mental lainnya.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'7. Proses Kehamilan',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Segala jenis Abortus, penyakit yang berhubungan dengan kehamilan, usaha yang berhubungan dengan kesuburan, dan kelahiran bayi.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'8. Penyakit Kelamin',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Pengobatan penyakit kelamin atau penyakit yang ditularkan melalui hubungan seksual, termasuk AIDS (Acquired Immune Deficiency Syndrom) dan ARC (AIDS Related Complex).',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(2);
					$this->pdf->Cell(190,5,'9. Perawatan Kurang dari 48 jam',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Penyakit yang memerlukan perawatan di rumah sakit kurang dari 48(empat puluh delapan) jam.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'10. Pengobatan Gigi',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Perawatan dan pengobatan gigi, termasuk operasi gigi, kecuali dinyatakan perlu karena cidera akibat Kecelakaan.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'11. Perawatan Biasa / Rutin',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Perawatan atau pengobatan yang tidak diperlukan secara medis atau tidak berhubungan dengan pengobatan suatu penyakit atau cidera.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'12. Akibat Obat Terlarang',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Penyakit atau cidera yang timbul akibat pemakaian obat-obat terlarang atau alkohol.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'13. Peperangan',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Cidera atau penyakit yang timbul akibat perang atau tindakan peperangan, yang dinyatakan atau tidak, huru-hara, bentrokan, atau keributan sipil.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'14. Olah Raga Berbahaya',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Cidera atau penyakit yang timbul dari olah raga atau hobby berbahaya yaitu segala jenis perlombaan balap (kecuali balap lari), terjun payung, terbang layang, berlayar atau berenang di laut lepas,',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'mendaki gunung, bertinju, bergulat, serta olah raga',0,0,'L');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->ln(3);
					$this->pdf->Cell(1);
					$this->pdf->Cell(190,5,'15. Penumpang Pesawat Terbang',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'Tertanggung sebagai penumpang pesawat terbang :',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'- Yang diselenggarakan oleh perusahaan penerbangan non komersial.',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'- Yang diselenggarakan oleh perusahaan penerbangan penumpang komersial (Commercial Passenger Airlines) tetapi tidak sedang melayani jalur penerbangan untuk pengangkutan umum yang',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(6);
					$this->pdf->Cell(190,5,'terjadwal tetap dan teratur (charter flight).',0,0,'L');
					$this->pdf->ln(3);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(4.5);
					$this->pdf->Cell(190,5,'- Helikopter.',0,0,'L');
					$this->pdf->ln(40);

					// FOOTER
					$this->pdf->SetY(-37);
					$this->pdf->Cell(190,4,'','B',0,'L');
					$this->pdf->ln(4);

					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
					$this->pdf->Cell(3);
					$this->pdf->Cell(2,3,':',0,0,'L');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(3);
					$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(5);
					$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
					$this->pdf->Cell(3);
					$this->pdf->Cell(2,3,':',0,0,'L');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(3);
					$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
					$this->pdf->Cell(5);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
					$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
					$this->pdf->ln();

					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
					$this->pdf->Cell(3);
					$this->pdf->Cell(2,3,':',0,0,'L');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(3);
					$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(5);
					$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
					$this->pdf->Cell(3);
					$this->pdf->Cell(2,3,':',0,0,'L');
					$this->pdf->SetFont('Arial','',4);
					$this->pdf->Cell(3);
					$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
					$this->pdf->Cell(5);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(40,3,'','LR',0,'C');
					$this->pdf->Cell(40,3,'','LR',0,'C');
					$this->pdf->ln();

					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(8,3,'Build ID',0,0,'L');
					$this->pdf->Cell(3);
					$this->pdf->Cell(2,3,':',0,0,'L');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(3);
					$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
					$this->pdf->SetFont('Arial','B',6);
					$this->pdf->Cell(5);
					$this->pdf->Cell(10,3,'',0,0,'L');
					$this->pdf->Cell(3);
					$this->pdf->Cell(2,3,'',0,0,'L');
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(3);
					$this->pdf->Cell(17,3,''.''.'',0,0,'L');
					$this->pdf->Cell(5);
					$this->pdf->SetFont('Arial','',6);
					$this->pdf->Cell(40,3,'','LBR',0,'C');
					$this->pdf->Cell(40,3,'','LBR',0,'C');

					$this->pdf->ln();
					$this->pdf->AliasNbPages('{totalPages}');
					$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
				}
		}

//		JS CI53
		
		foreach($hasilProDataRider as $data) {
				
			if ($data->NAMA == 'JS CI 53')
			{
				// HEADER
				$this->pdf->Image($image1, 170, 5);
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','B',14);
				$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
				$this->pdf->ln();
				$this->pdf->SetFont('Arial','',10);
				$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
				$this->pdf->ln(7);
				$this->pdf->SetFont('Arial','B',12);
				$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
				$this->pdf->ln(7);
				$this->pdf->SetFont('Arial','B',10);
				$this->pdf->SetFillColor(200,200,200);
				$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
				$this->pdf->ln(5);

				// 53 Penyakit Kritis
				$this->pdf->SetFont('Arial','B',8);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'53 Penyakit Kritis',0,0,'L');
				$this->pdf->ln(4);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'1. Kanker (Cancer).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'2. Serangan Jantung (Myocardial Infractions).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'3. Stroke (Stroke).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'4. Penyakit Arteri Koronaria yang mensyaratkan Pembedahan (Coronary Artery Disease Surgery).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'5. Gagal Ginjal (Renal Failure / Kidney Failure / End Stage Renal Disease).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'6. Pencangkokan Organ Tubuh Utama (Major Organ Transplantation).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'7. Lumpuh (Paralysis).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'8. Kehilangan Kemampuan Melihat (Blindness).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(2);
				$this->pdf->Cell(190,5,'9. Operasi Katup Jantung (Heart Valve Surgery).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'10. Operasi Pembuluh darah Aorta (Surgery of Aorta).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'11. Alzheimer (Alzheimer`s Disease).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'12. Amyotrophic Lateral Schlerosis.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'13. Angioplasty.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'14. Anemia Aplastik (Aplastic Anaemia).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'15. Radang Selaput Otak (Bacterial Meningitis).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'16. Tumor Jinak Otak (Benign Brain Tumor).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'17. Penyakit Paru-paru Kronis (Chronic Lung Disease).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'18. Koma (Coma).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'19. Pengobatan Arteri Koroner dengan Laser (Coronary Laser Treatment).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'20. Kehilangan Kemampuan Mendengar (Deafness).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'21. Radang Otak (Enchepalitis).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'22. Hepatitis Fulminant.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'23. Kehilangan Anggota Tubuh (Loss of Limits).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'24. Kehilangan Kemampuan Berbicara (Loss of Speech).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'25. Luka Bakar (Major Burns).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'26. Memar Otak Serius (Major Head Trauma).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'27. Penyakit Motor Neuron.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'28. Muscullar Dystrophy.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'29. Parkinson (Parkinson`s Disease).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'30. Pulmonary Arterial Hypertension.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'31. Multiple Sclerosis.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'32. Poliomyelitis.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'33. Lupus Eritematosus Sistemik (Systemic Lupus Erythematosus).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'34. Penyakit Hati Kronis.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'35. Colitis Ulcerative Berat (Cronh`s Disease).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'36. HIV yang disebabkan oleh transfusi darah dan terjangkit dari suatu jenis pekerjaan.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'37. Terminal Illness.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'38. Kista Medullary.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'39. Pankreatitis menahun yang berulang.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'40. Hilangnya kemandirian hidup.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'41. Rheumatoid Arthritis Berat.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'42. Appalic Syndrome.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'43. Penyakit Kaki Gajah Kronis.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'44. Cardiomyopathy.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'45. Aneurisma pembuluh darah otak yang mensyaratkan pembedahan.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'46. Terputusnya akar-akar syaraf Plexus brachialis.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'47. Stroke yang memerlukan operasi arteri carotid.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'48. Operasi scoliosis idiopatik.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'49. Skleroderma Progresif.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'50. Kematian selaput otot atau jaringan (gangrene).',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'51. Penyakit Kawasaki Yang Mengakibatkan Komplikasi Pada Jantung.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'52. Eisenmerger.',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(1);
				$this->pdf->Cell(190,5,'53. Myasthenia Gravis.',0,0,'L');
				$this->pdf->ln(30);

				// FOOTER
				$this->pdf->SetY(-37);
				$this->pdf->Cell(190,4,'','B',0,'L');
				$this->pdf->ln(4);

				$this->pdf->SetFont('Arial','B',6);
				$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
				$this->pdf->Cell(3);
				$this->pdf->Cell(2,3,':',0,0,'L');
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(3);
				$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
				$this->pdf->SetFont('Arial','B',6);
				$this->pdf->Cell(5);
				$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
				$this->pdf->Cell(3);
				$this->pdf->Cell(2,3,':',0,0,'L');
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(3);
				$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
				$this->pdf->Cell(5);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
				$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
				$this->pdf->ln();

				$this->pdf->SetFont('Arial','B',6);
				$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
				$this->pdf->Cell(3);
				$this->pdf->Cell(2,3,':',0,0,'L');
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(3);
				$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
				$this->pdf->SetFont('Arial','B',6);
				$this->pdf->Cell(5);
				$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
				$this->pdf->Cell(3);
				$this->pdf->Cell(2,3,':',0,0,'L');
				$this->pdf->SetFont('Arial','',4);
				$this->pdf->Cell(3);
				$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
				$this->pdf->Cell(5);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(40,3,'','LR',0,'C');
				$this->pdf->Cell(40,3,'','LR',0,'C');
				$this->pdf->ln();

				$this->pdf->SetFont('Arial','B',6);
				$this->pdf->Cell(8,3,'Build ID',0,0,'L');
				$this->pdf->Cell(3);
				$this->pdf->Cell(2,3,':',0,0,'L');
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(3);
				$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
				$this->pdf->SetFont('Arial','B',6);
				$this->pdf->Cell(5);
				$this->pdf->Cell(10,3,'',0,0,'L');
				$this->pdf->Cell(3);
				$this->pdf->Cell(2,3,'',0,0,'L');
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(3);
				$this->pdf->Cell(17,3,''.''.'',0,0,'L');
				$this->pdf->Cell(5);
				$this->pdf->SetFont('Arial','',6);
				$this->pdf->Cell(40,3,'','LBR',0,'C');
				$this->pdf->Cell(40,3,'','LBR',0,'C');

				$this->pdf->ln();
				$this->pdf->AliasNbPages('{totalPages}');
				$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
			}
		}

		// PAGE 5
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);

		
		// HAL-HAL PENTING
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'HAL-HAL PENTING',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'1. Alokasi Premi yang dibentuk ke dalam Premi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(35,5,'',0,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 1',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 2',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 3',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 4',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 5',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'Tahun 6',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(35,5,'Premi Berkala',1,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Investasi',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'10%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'50%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'60%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'70%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'90%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'100%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Biaya',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'90%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'50%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'40%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'30%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'10%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'0%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(35,5,'Top Up',1,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(25,5,'',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Investasi',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'95%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(35,5,'Biaya',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(25,5,'5%',1,0,'C');
		$this->pdf->ln();
		$this->pdf->Cell(6);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'2. Ilustrasi di atas akan diperhitungkan dengan:',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'a. Biaya administrasi sebesar Rp. 27,500.- per bulan selama masa asuransi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'b. Biaya Asuransi (Cost Of insurance dan Cost Of Rider) akan dikenakan setiap bulan selama masa Asuransi. Besarnya COI dan COR akan naik setiap tahun sesuai dengan bertambahnya usia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(6);
		$this->pdf->Cell(190,5,'Tertanggung.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'c. Biaya pengelolaan investasi maksimal 2% per tahun tergantung jenis reksadana yang dipilih.',0,0,'L');
		$this->pdf->ln();
//		$this->pdf->Cell(4);
//		$this->pdf->Cell(190,5,'d. Biaya pembelian unit adalah sebesar 5% dari dana investasi.',0,0,'L');
//		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'3. Jika unit yang terbentuk pada tahun 1 tidak mencukupi untuk membayar Biaya Asuransi, dan Biaya Administrasi, maka biaya-biaya tersebut dinyatakan sebagai biaya-biaya terhutang yang akan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'dipotong dari unit yang terbentuk pada bulan ke 13.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'4. Nilai Tunai adalah Nilai Saldo Unit yang dihitung berdasarkan Harga Unit pada saat tertentu.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'5. Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'6. Perubahan harga unit menggambarkan hasil investasi dari dana investasi. Kinerja dari investasi tidak dijamin tergantung dari risiko masing-masing dana investasi. Pemegang Polis diberi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan Optimalisasi tingkat pengembalian investasi, sesuai dengan kebutuhan dan profil risiko Pemegang Polis.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(145,5,'7. Besarnya Nilai Tunai yang dibayarkan (bisa lebih besar atau lebih kecil dari yang diilustrasikan) akan bergantung pada perkembangan dari dana investasi',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(2);
		$this->pdf->Cell(0,5,'JS PROMAPAN.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'8. Jumlah minimum Top Up Sekaligus adalah Rp. 1,000,000.-,',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(1);
		$this->pdf->Cell(190,5,'9. Minimum penarikan dana (Redemptions) adalah Rp. 1,000,000.- dan menyisakan dana minimum Rp. 2,000,000.-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'10. Produk JS PROMAPAN tidak dikenakan biaya penarikan.',0,0,'L');
//		$this->pdf->Cell(190,5,'10. Pemegang Polis tidak dikenakan biaya penarikan dana, jika penarikan dilakukan setelah usia polis 2 tahun. Jika penarikan dana dilakukan selama usia polis kurang dari 2 tahun, maka akan',0,0,'L');
//		$this->pdf->ln();
//		$this->pdf->SetFont('Arial','',6);
//		$this->pdf->Cell(4);
//		$this->pdf->Cell(12,5,'dikenakan biaya sebesar 2% dari total dana penarikan.',0,0,'L');
		$this->pdf->ln();
		/*$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'11. Untuk setiap penarikan sebelum usia polis 3 tahun, akan dikenakan pajak penghasilan sesuai ketentuan pemerintah yang berlaku atas kelebihan Nilai Tunai terhadap total premi yang dibayarkan ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku. Peraturan perpajakan dapat berubah sesuai keputusan legislatif dan di luar kebijakan PT. Asuransi',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'Jiwasraya (Persero) sebagai Penanggung.',0,0,'L');
		$this->pdf->ln();*/
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'11. Penilaian harga unit dilakukan pada setiap hari kerja, Senin sampai dengan Jum`at dengan menggunakan metode harga pasar yang berlaku bagi instrumen investasi yang mendasari masing-',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'masing alokasi dana investasi yang dipilih.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'12. Besarnya Nilai Tunai yang terbentuk pada polis ini (dapat lebih besar atau lebih kecil dari dana yang diinvestasikan oleh Pemegang Polis), akan dipengaruhi oleh fluktuasi dari harga unit atau faktor ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'biaya-biaya sebagaimana disebutkan di atas.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'13. Perpanjangan masa pertanggungan asuransi tambahan setelah berakhirnya masa asuransi akan dilakukan underwriting/seleksi risiko ulang sehingga perpanjangan dapat diterima dengan rate ',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'standar atau bahkan ditolak.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'14. Harga unit yang digunakan pada Premi Pertama akan terbentuk setelah diterimanya SPAJ dan teridentifikasinya seluruh pembayaran Premi Pertama di Kantor Pusat oleh Jiwasraya. Tanggal',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->ln();
		$this->pdf->Cell(4);
		$this->pdf->Cell(190,5,'Perhitungan Harga Unit adalah Tanggal Perhitungan berikutnya setelah diterimanya SPAJ. Atau teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat, mana yang paling akhir.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(190,5,'15. Memiliki Polis Asuransi Jiwa merupakan komitmen jangka panjang. JS PROMAPAN adalah suatu produk asuransi jiwa yang dikaitkan dengan investasi. Untuk dapat menikmati manfaat polis ini,',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(4);
		$this->pdf->Cell(12,5,'maka kami sarankan Anda untuk melakukan pembayaran Premi selama Masa Asuransi.',0,0,'L');
		$this->pdf->ln();

		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');

		// PAGE 6
		$this->pdf->AddPage();
		
		// HEADER
		$this->pdf->Image($image1, 170, 5);
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',14);
		$this->pdf->Cell(190,5,'PT ASURANSI JIWASRAYA (PERSERO)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Jl. Ir. H. Juanda No. 34 Jakarta - 10120',0,0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(7);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(5);

		// RINGKASAN MANFAAT
		foreach($hasilProTertanggung as $data) {
			
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(190,5,'RINGKASAN MANFAAT',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Nama Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data->NAMA.' ',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Usia Tertanggung',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(32,5,''.$data->USIA_TH.' Tahun',0,0,'L');
			
		}

		foreach($hasilProAsuransiPokok as $data) {
			
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'A. Rencana masa pembayaran premi yang dikehendaki adalah',0,0,'L');
		$this->pdf->Cell(36);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(5,5,''.$data->ASUMSI_CUTI_PREMI.' ',0,0,'L');
		$this->pdf->Cell(55,5,'Tahun *',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'Total Premi',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,5,':',0,0,'L');
		$this->pdf->Cell(3);
		if ($data->CARA_BAYAR == 2)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(32,5,number_format($data->PREMI_BERKALA  * $data->ASUMSI_CUTI_PREMI,0,'.',','),0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->Cell(5);
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(50,5,'Total Top Up Berkala',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,5,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(32,5,number_format($data->TOPUP_BERKALA  * $data->ASUMSI_CUTI_PREMI,0,'.',','),0,0,'L');
		}
		else if ($data->CARA_BAYAR == 1)
		{
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(32,5,number_format($data->PREMI_BERKALA * 12 * $data->ASUMSI_CUTI_PREMI,0,'.',','),0,0,'L');
			$this->pdf->ln(3);
			$this->pdf->Cell(5);
			$this->pdf->SetFont('Arial','B',8);
			$this->pdf->Cell(50,5,'Total Top Up Berkala',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->Cell(2,5,':',0,0,'L');
			$this->pdf->Cell(3);
			$this->pdf->SetFont('Arial','',8);
			$this->pdf->Cell(32,5,number_format($data->TOPUP_BERKALA  * 12 * $data->ASUMSI_CUTI_PREMI,0,'.',','),0,0,'L');
		}
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','BI',8);
		$this->pdf->Cell(190,5,'Informasi mengenai Uraian Biaya-biaya terdapat dalam halaman Hal-Hal Penting.',0,0,'L');
		
		}
		
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'B. Asumsi Nilai Tunai dimasa yang akan datang **',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'USIA',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'RENDAH',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'SEDANG',1,0,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(47.5,5,'TINGGI',1,0,'C');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',8);
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
		
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'*',0,0,'L');
		$this->pdf->Cell(180,5,'Sesuai dengan cuti premi yang dipilih.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'**',0,0,'L');
		$this->pdf->Cell(180,5,'Nilai Tunai dihitung dengan menggunakan asumsi tingkat investasi. Besarnya Nilai Tunai yang dibayarkan (dapat lebih',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(180,5,'besar atau lebih kecil dari yang diilustrasikan), akan bergantung pada perkembangan dari dana investasi.',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10,5,'***',0,0,'L');
		$this->pdf->Cell(180,5,'Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan Administrasi, dan oleh karena itu',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(190,5,'Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melanjutkan pembayaran premi tahunan seperti',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(10);
		$this->pdf->Cell(190,5,'dinyatakan dalam ilustrasi ini.',0,0,'L');
		$this->pdf->ln(4);
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'C. Rangkuman Manfaat Meninggal Dunia',0,0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Jika Tertanggung meninggal dunia karena kecelakaan sebelum berusia 65 Tahun, Manfaat yang diterima','T',0,'L');
		$this->pdf->SetFont('Arial','',8);
		foreach($hasilProDataRider as $data) {
			if ($data->NAMA == 'Asuransi Dasar')
			{
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'T',0,'L');
			}
		}
		
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'adalah sejumlah Uang Asuransi ditambah dengan Nilai Tunai pada Saat Tertanggung Meninggal Dunia.','B',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->ln();
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Jika Tertanggung meninggal dunia sebelum berusia 65 Tahun, maka Manfaat yang diterima adalah sejumlah','T',0,'L');
		$this->pdf->SetFont('Arial','',8);
		foreach($hasilProDataRider as $data) {
			
			if ($data->NAMA == 'Asuransi Dasar')
			{
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'T',0,'L');
			}
		}
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Uang Pertanggungan ditambah dengan Nilai Tunai pada saat Tertanggung Meninggal Dunia.','B',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','B',0,'L');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(50,5,'D. Manfaat',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,'(Hanya untuk ilustrasi, keterangan lengkap mengenai Manfaat Asuransi tiap produk Asuransi, termasuk syarat-syarat dan pengecualian, tercantum',0,0,'L');
		$this->pdf->ln(3);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(190,5,' pada Polis, berlaku dan mengikat).',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'Asuransi Dasar: Apabila Tertanggung meninggal dunia dalam masa asuransi sebelum usia 99 Tahun, maka','LTR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		foreach($hasilProDataRider as $data) {
			if ($data->NAMA == 'Asuransi Dasar')
			{
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'TR',0,'C');
			}
		}
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'akan dibayarkan Uang Asuransi Dasar ditambah dengan Nilai Tunai Polis, Apabila Tertanggung hidup sampai','LR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LR',0,'L');
		$this->pdf->ln(3);
		$this->pdf->Cell(1);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(140,5,'berakhirnya Masa Asuransi, maka Jiwasraya akan membayarkan Nilai Tunai (Jumlah Unit x NAB).','LBR',0,'L');
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(50,5,'','LBR',0,'L');
		
		foreach($hasilProDataRider as $data) {
			
			if ($data->NAMA == 'JS TPD')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'JS Total Permanent Disability: Apabila Tertanggung mengalami Cacat Tetap Total, maka akan dibayarkan','LTR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'sebesar','LBR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LBR',0,'L');
			}
			if ($data->NAMA == 'JS Payor Benefit Death')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'JS Payor Death Benefit: Apabila Pemegang Polis meninggal dunia, maka Polis menjadi bebas premi',1,0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
			}
			if ($data->NAMA == 'JS Spouse Payor Death')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'JS Spouse Payor Death Benefit: Apabila Pemegang Polis meninggal dunia, maka Polis menjadi bebas premi',1,0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
			}
			if ($data->NAMA == 'JS CI 53')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'JS Critical Illness: Apabila Tertanggung terdiagnosa untuk pertama kali menderita salah satu dari 53 jenis','LTR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'penyakit kritis sesuai dengan daftar penyakit kritis, maka akan dibayarkan sebesar','LBR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LBR',0,'L');
			}
			if ($data->NAMA == 'JS ADDB')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'JS Accident Death & Dismemberment: Apabila Tertanggung Meninggal Dunia atau Cacat karena kecelakaan','LTR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'sebelum Tertanggung berusia 65 Tahun, maka akan dibayarkan manfaat Uang Asuransi sebesar','LBR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LBR',0,'L');
			}
			if ($data->NAMA == 'JS Term Life')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'Apabila Tertanggung meninggal dunia karena Sakit atau kecelakaan usia tertanggung tidak lebih dari 65','LTR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'Tahun, maka akan dibayarkan Uang Asuransi JS Term Rider','LBR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LBR',0,'L');
			}
			if ($data->NAMA == 'JS Payor TPD')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'Apabila Pemegang Polis menderita Cacat Tetap Total (TPD) baik karena sakit maupun karena kecelakaan','LTR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan','LR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LR',0,'L');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'kepada Pemegang Polis','LBR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LBR',0,'L');
			}
			if ($data->NAMA == 'JS Spouse Payor TPD')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'Apabila Pemegang Polis menderita Cacat Tetap Total baik karena sakit maupun karena kecelakaan','LTR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),'LTR',0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan','LR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LR',0,'L');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'kepada Pemegang Polis','LBR',0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,'','LBR',0,'L');
			}
			if ($data->NAMA == 'JS HCP')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(190,5,'JS Hospital Care Benefit, Apabila tertanggung dirawat di Rumah Sakit sebelum berusia 65 Tahun, maka akan dibayarkan sebesar:',0,0,'L');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'a. Rawat Inap Rumah Sakit per Hari, sebesar',0,0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),0,0,'C');
				$this->pdf->ln(3);
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'b. Rawat ICU/ICCU per Hari, sebesar',0,0,'L');
				$this->pdf->Cell(50,5,number_format($data->UA*2,0,'.',','),0,0,'C');
				$this->pdf->SetFont('Arial','',8);
			}
			if ($data->NAMA == 'JS HCP Bedah')
			{
				$this->pdf->ln();
				$this->pdf->Cell(1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(140,5,'c. Pembedahan ',0,0,'L');
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->Cell(50,5,number_format($data->UA,0,'.',','),0,0,'C');
			}
			
		}


		$this->pdf->ln();
		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		// PAGE 9
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
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->SetFillColor(200,200,200);
		$this->pdf->Cell(190,5,'ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI',1,0,'L', true);
		$this->pdf->ln(10);
		
		// RISIKO
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,10,'RISIKO','BT',0,'C');
		$this->pdf->ln(15);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'Risiko Pasar',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Harga Unit dapat mengalami fluktuasi mengikuti harga pasar. Hal ini akan terlihat pada volatilitas dari harga unit dan akan',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'menyebabkan kemungkinan terjadinya kenaikan atau penurunan nilai investasi.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'Risiko Kredit',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Pemegang Polis akan terekspos pada risiko kredit PT. Asuransi Jiwasraya (Persero) sebagai penyeleksi risiko dari produk',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'asuransi. Risiko kredit berkaitan dengan kemampuan membayar kewajiban oleh PT. Asuransi Jiwasraya (Persero)',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'terhadap nasabahnya.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,'Risiko Operasional',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Suatu risiko kerugian yang disebabkan karena tak berjalannya atau gagalnya proses internal, manusia, dan sistem serta',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'oleh peristiwa eksternal.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Pertanggungan asuransi JS PROMAPAN tidak berlaku apabila Tertanggung meninggal dalam keadaan sebagai berikut:',0,0,'L');
		$this->pdf->ln(5);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(10,5,'a. ',0,0,'L');
		$this->pdf->Cell(180,5,'Akibat tindakan bunuh diri yang terjadi dalam waktu 2 (dua) tahun terhitung sejak Tanggal Penerbitan Polis atau',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(10,5,'',0,0,'L');
		$this->pdf->Cell(190,5,'Addendum yang terkini atau tanggal penerbitan pemulihan yang terkini (mana saja yang terjadi terakhir).',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(10,5,'b. ',0,0,'L');
		$this->pdf->Cell(180,5,'Tertanggung sedang/sebagai akibat melakukan tindak kejahatan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(10,5,'c. ',0,0,'L');
		$this->pdf->Cell(180,5,'Tertanggung menjalani eksekusi hukuman mati oleh pengadilan.',0,0,'L');
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(10,5,'d. ',0,0,'L');
		$this->pdf->Cell(180,5,'Terjadi akibat tindak kejahatan atau pembunuhan yang dilakukan oleh yang berkepentingan dalam pertanggungan.',0,0,'L');
		$this->pdf->ln(10);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->Cell(190,5,'Note: Detail lengkap klausul Pengecualian dinyatakan dalam Ketentuan Umum dan Ketentuan Khusus Polis.',0,0,'L');
		$this->pdf->ln();

		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
	

		// PAGE 10
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
		$this->pdf->Cell(190,5,'JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)','B',0,'L');
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
		$this->pdf->ln(50);

		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(95,5,'TANDA TANGAN AGEN',0,0,'C');
		$this->pdf->Cell(95,5,'TANDA TANGAN CALON PEMEGANG POLIS',0,0,'C');
		$this->pdf->ln(50);
		$this->pdf->SetFont('Arial','',8);
		$this->pdf->Cell(95,5,''.substr($namaagen,0,9).' ',0,0,'C');
		// CALON PEMEGANG POLIS
		foreach($hasilProPempol as $data) {
			$this->pdf->Cell(95,5,''.$data->NAMA.' ',0,0,'C');
		}
		$this->pdf->ln();
		$this->pdf->SetFont('Arial','I',6);
		$this->pdf->Cell(95,5,'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis',0,0,'C');
		$this->pdf->Cell(95,5,'Saya telah membaca, memahami dan mengerti resiko dan isi dari ilustrasi ini.',0,0,'C');
		$this->pdf->ln();

		
		// FOOTER
		$this->pdf->SetY(-37);
		$this->pdf->Cell(190,4,'','B',0,'L');
		$this->pdf->ln(4);

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Disajikan',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.substr($namaagen,0,9).' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Agen',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$nomeragen.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'Tanda Tangan Agen','LTR',0,'C');
		$this->pdf->Cell(40,3,'Tanda Tangan Calon Pemegang Polis','LTR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Tanggal',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.date('d/m/Y').' ',0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(12,3,'Kode Cabang',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',4);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,''.$kantorcabang.' ',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->Cell(40,3,'','LR',0,'C');
		$this->pdf->ln();

		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(8,3,'Build ID',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,':',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(15,3,$_GET['build_id'],0,0,'L');
		$this->pdf->SetFont('Arial','B',6);
		$this->pdf->Cell(5);
		$this->pdf->Cell(10,3,'',0,0,'L');
		$this->pdf->Cell(3);
		$this->pdf->Cell(2,3,'',0,0,'L');
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(3);
		$this->pdf->Cell(17,3,''.''.'',0,0,'L');
		$this->pdf->Cell(5);
		$this->pdf->SetFont('Arial','',6);
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		$this->pdf->Cell(40,3,'','LBR',0,'C');
		
		$this->pdf->ln();
		$this->pdf->AliasNbPages('{totalPages}');
		$this->pdf->Cell(190,3, "Page " . $this->pdf->PageNo() . " of {totalPages}",' ', 0, 'R');
		
		$this->pdf->Output();
//		$this->pdf->Output('./files/pdf/'.$_GET['filepdf'].'.pdf','F');

?>