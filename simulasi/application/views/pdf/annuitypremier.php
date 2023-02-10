<?php

$pdf = new PAPDF($pos);
$pdf->AliasNbPages();
$pdf->Output();

class PAPDF extends FPDF {
	private $PG_W = 190;
	private $height = 5;
	private $border = 0;
    private $borderm = 1;
	private $napek_w = 34;
    private $data;
	private $msp;
	private $mst;

    function __construct($pos) {
        parent::__construct('P', 'mm', 'A4');
		$this->data = $pos;
        $this->AddFont('Monserrat', '', 'fpdf/font/Montserrat-Medium.php');
        $this->AddFont('Monserrat', 'B', 'fpdf/font/Montserrat-Bold.php');
        $this->AddFont('Monserrat', 'I', 'fpdf/font/Montserrat-MediumItalic.php');
		switch($pos['MERITALSTATUSPEMPOL']) { case 'L': $this->msp = "Lajang"; break; case 'K': $this->msp = "Kawin"; break; case 'J': $this->msp = "Janda"; break; case 'D': $this->msp = "Duda"; break; }
		switch($pos['MERITALSTATUSTERTANGGUNG']) { case 'L': $this->mst = "Lajang"; break; case 'K': $this->mst = "Kawin"; break; case 'J': $this->mst = "Janda"; break; case 'D': $this->mst = "Duda"; break; }
		
        $this->AddPage();
        $this->Body();
    }

    function Header() {
        $this->Image(FCPATH.'assets/img/logo-js.png', 10, 5);
		$this->Ln();
		$this->SetFont('Monserrat', 'B', 14);
		$this->Cell(35, $this->height, '', $this->border, 0, 'L');
		$this->Cell(155, $this->height, 'PT ASURANSI JIWA IFG', $this->border, 1, 'L');
		$this->SetFont('Monserrat', '', 10);
		$this->Cell(35, $this->height, '', $this->border, 0, 'L');
		$this->Cell(155, $this->height, 'Graha CIMB Niaga Lt. 6, Jl. Jend. Sudirman Kav 58 Jakarta - 12190', $this->border, 1, 'L');
		$this->Ln(5);
		$this->SetFont('Monserrat', 'B', 12);
		$this->Cell(190, 4, strtoupper(strtolower($this->data['NAMAPRODUK'])), 'B', 1, 'L');
		$this->Ln(2);
    }

    function Body() {
        $this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nomor Proposal', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['BUILDID'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Tanggal Ilustrasi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['TGLREKAM'], $this->border, 1, 'L');
		$this->Ln(2);
		
		// Calon pemegang polis
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'CALON PEMEGANG POLIS', 1, 0, 'L', true);
		$this->ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, strtoupper(strtolower($this->data['NAMAPEMPOL'])), $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Nomor Telepon', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['TELEPONPEMPOL'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['TGLLAHIRPEMPOL'].' / '.$this->_Age($this->data['TGLLAHIRPEMPOL'], $this->data['TGLREKAM']).' Tahun', $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Nomor Handphone', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['HPPEMPOL'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Email', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['EMAILPEMPOL'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Pekerjaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data['PEKERJAANPEMPOL'], $this->border, 'L');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['JENISKELAMINPEMPOL'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Hobi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data['HOBIPEMPOL'], $this->border, 'L');
		$this->Cell(50, $this->height, 'Status', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->msp, $this->border, 0, 'L');
		$this->Cell(50, $this->height, null, $this->border, 0, 'L');
		$this->Cell(2, $this->height, null, $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, null, $this->border, 'L');
		$this->Ln(2);
		
		// Calon tertanggung
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'CALON TERTANGGUNG', 1, 0, 'L', true);
		$this->Ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, strtoupper(strtolower($this->data['NAMATERTANGGUNG'])), $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'No KTP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['NOIDTERTANGGUNG'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['TGLLAHIRTERTANGGUNG'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Hubungan Dengan Pemegang Polis', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, ucwords(strtolower($this->data['NAMAHUBUNGAN'])), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Usia', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->_Age($this->data['TGLLAHIRTERTANGGUNG'], $this->data['TGLREKAM']).' Tahun', $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Pekerjaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data['PEKERJAANTERTANGGUNG'], $this->border, 'L');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['JENISKELAMINTERTANGGUNG'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Hobi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data['HOBITERTANGGUNG'], $this->border, 'L');
		$this->Cell(50, $this->height, 'Status', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->mst, $this->border, 0, 'L');
		$this->Cell(50, $this->height, null, $this->border, 0, 'L');
		$this->Cell(2, $this->height, null, $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, null, $this->border, 'L');
		
		$this->Cell($this->PG_W, $this->height, '', 'B', 1, 'L');
		$this->Cell(50, $this->height, 'Cara Bayar', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['NAMACARABAYAR'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, '', $this->border, 0, 'L');
		$this->Cell(2, $this->height, '', $this->border, 0, 'C');
		$this->Cell(43, $this->height, '', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Mata Uang', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, 'IDR', $this->border, 0, 'L');
        if (in_array($this->data['MERITALSTATUSTERTANGGUNG'], array('K','J','D'))) {
            $this->Cell(50, $this->height, '', $this->border, 0, 'L');
            $this->Cell(2, $this->height, '', $this->border, 0, 'C');
            $this->Cell(43, $this->height, '', $this->border, 1, 'L');
        } else {
            $this->Cell(95, $this->height, NULL, $this->border, 1, 'L');
        }
		$this->Cell(50, $this->height, 'Premi yang dibayar', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, 'Rp'.number_format($this->data['PREMI'], 0, ',', '.'), $this->border, 0, 'L');
        if (in_array($this->data['MERITALSTATUSTERTANGGUNG'], array('K','J','D'))) {
            $this->Cell(50, $this->height, '', $this->border, 0, 'L');
            $this->Cell(2, $this->height, '', $this->border, 0, 'C');
            $this->Cell(43, $this->height, '', $this->border, 1, 'L');
        } else {
            $this->Cell(95, $this->height, NULL, $this->border, 1, 'L');
        }
		$this->Ln(2);
		
		
		// Manfaat anuitas
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'KETERANGAN MANFAAT ANUITAS', 1, 1, 'L', true);
        $this->Ln(3);
        $this->SetFont('Monserrat', 'B', 7);
		$this->Cell(6, $this->height-1, 'No', $this->borderm, 0, 'C');
        $this->Cell(40, $this->height-1, 'Manfaat', $this->borderm, 0, 'C');
        $this->Cell($this->PG_W-90, $this->height-1, 'Penjelasan', $this->borderm, 0, 'C');
		$this->Cell(44, $this->height-1, 'Nilai', $this->borderm, 1, 'C');
		$this->SetFont('Monserrat', '', 7);

        $no = 1;
        if ($this->data['KDPRODUK'] == 'APP65') {
            $sampaiusia = '65';
            $seumurhidup = false;
			$height = 4;
        } else if ($this->data['KDPRODUK'] == 'APP75') {
            $sampaiusia = '75';
            $seumurhidup = false;
			$height = 4;
        } else if ($this->data['KDPRODUK'] == 'APP85') {
            $sampaiusia = '85';
            $seumurhidup = false;
			$height = 4;
        } else if ($this->data['KDPRODUK'] == 'APPSH') {
			$seumurhidup = true;
			$height = 3;
		}
        $this->Cell(6, ($this->height-1)*$height, $no, $this->borderm, 0, 'C');
        $this->Cell(40, ($this->height-1)*$height, 'Berkala Bulanan', $this->borderm, 0, 'L');
        $x1 = $this->GetX();
		$y1 = $this->GetY();
        if ($seumurhidup) {
			$this->MultiCell($this->PG_W-90, $this->height-1, "Pembayaran manfaat anuitas secara berkala bulanan dimulai 1 (satu) bulan berikutnya setelah premi sekaligus dilunasi sampai dengan Tertanggung meninggal dunia", $this->borderm, 'J');
        } else {
            $this->MultiCell($this->PG_W-90, $this->height-1, "Pembayaran manfaat anuitas secara berkala bulanan dimulai 1 (satu) bulan berikutnya setelah premi sekaligus dilunasi sampai dengan Tertanggung meninggal dunia atau sampai dengan usia Tertanggung $sampaiusia Tahun atau sampai dengan Tanggal Akhir Asuransi", $this->borderm, 'J');
        }
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + $this->PG_W-90, $y2 - $yH);
		$this->Cell(44, ($this->height-1)*$height, 'Rp'.number_format($this->data['JPHT'], 0, ',', '.'), $this->borderm, 1, 'R');

        if (in_array($this->data['MERITALSTATUSTERTANGGUNG'], array('K','J','D'))) {
            if ($this->data['KDPRODUK'] == 'APP65') {
                $sampaiusia = '65';
                $seumurhidup = false;
				$heightj = 6;
				$heighty = 12;
            } else if ($this->data['KDPRODUK'] == 'APP75') {
                $sampaiusia = '75';
                $seumurhidup = false;
				$heightj = 6;
				$heighty = 12;
            } else if ($this->data['KDPRODUK'] == 'APP85') {
                $sampaiusia = '85';
                $seumurhidup = false;
				$heightj = 6;
				$heighty = 12;
            } else if ($this->data['KDPRODUK'] == 'APPSH') {
				$seumurhidup = true;
				$heightj = 5;
				$heighty = 11;
			}

			if ($this->data['JPJD'] > 0) {
				$no++;
				$this->Cell(6, ($this->height-1)*$heightj, $no, $this->borderm, 0, 'C');
				$this->Cell(40, ($this->height-1)*$heightj, 'Berkala Bulanan Janda/Duda', $this->borderm, 0, 'L');
				$x1 = $this->GetX();
				$y1 = $this->GetY();
				if ($seumurhidup) {
					$this->MultiCell($this->PG_W-90, $this->height-1, "Pembayaran manfaat anuitas secara berkala bulanan bagi Janda/Duda sebesar persentase tertentu dari Manfaat Anuitas Berkala Bulanan dimulai jatuh tempo berikutnya sejak Tertanggung meninggal dunia, dibayarkan selama Janda/Duda hidup dan berakhir pada saat Janda/Duda menikah kembali atau menginggal dunia", $this->borderm, 'J');
				} else {
					$this->MultiCell($this->PG_W-90, $this->height-1, "Pembayaran manfaat anuitas secara berkala bulanan bagi Janda/Duda sebesar persentase tertentu dari Manfaat Anuitas Berkala Bulanan dimulai jatuh tempo berikutnya sejak Tertanggung meninggal dunia, dibayarkan selama Janda/Duda hidup dan berakhir pada saat Janda/Duda menikah kembali atau menginggal dunia atau sampai dengan usia Tertanggung $sampaiusia Tahun atau sampai dengan Tanggal Akhir Asuransi", $this->borderm, 'J');
				}
				$y2 = $this->GetY();
				$yH = $y2 - $y1;
				$this->SetXY($x1 + $this->PG_W-90, $y2 - $yH);
				$this->Cell(44, ($this->height-1)*$heightj, 'Rp'.number_format($this->data['JPJD'], 0, ',', '.'), $this->borderm, 1, 'R');
			}

			if ($this->data['JPYT'] > 0) {
				$no++;
				$this->Cell(6, ($this->height-1)*$heighty, $no, $this->borderm, 0, 'C');
				$this->Cell(40, ($this->height-1)*$heighty, 'Berkala Bulanan Yatim/Piatu', $this->borderm, 0, 'L');
				$x1 = $this->GetX();
				$y1 = $this->GetY();
				if ($seumurhidup) {
					$this->MultiCell($this->PG_W-90, $this->height-1, "Pembayaran manfaat anuitas secara berkala  bulanan bagi anak Tertanggung sebesar  persentase tertentu dari manfaat anuitas bekala  bulanan dimulai jatuh tempo berikutnya sejak  Janda/Duda meninggal dunia atau menikah lagi  dan Tertanggung meninggal dunia dalam hal  Istri/suami meninggal dunia lebih dahulu,  dan Pembayaran berakhir pada saat anak Tertanggung (yatim/piatu) berusia 25 (dua puluh lima) tahun atau sudah bekerja atau sudah menikah atau   meninggal dunia dan akan digantikan anak yang sah berikutnya dari Tertanggung sesuai yang tercantum dalam di data Polis dengan ketentuan masih memenuhi ketentuan penerima manfaat anuitas berkala bulanan Yatim/Piatu dan maksimal sebanyak 3 (tiga) orang anak", $this->borderm, 'J');
				} else {
					$this->MultiCell($this->PG_W-90, $this->height-1, "Pembayaran manfaat anuitas secara berkala bulanan bagi anak Tertanggung sebesar persentase tertentu dari manfaat anuitas bekala bulanan dimulai jatuh tempo berikutnya sejak Janda/Duda meninggal dunia atau menikah lagi dan Tertanggung meninggal dunia dalam hal Istri/suami meninggal dunia lebih dahulu, dibayarkan sampai dengan usia Tertanggung $sampaiusia Tahun atau sampai dengan Tanggal Akhir Asuransi dan Pembayaran berakhir pada saat anak Tertanggung (yatim/piatu) berusia 25 (dua puluh lima) tahun atau sudah bekerja atau sudah menikah atau meninggal dunia dan akan digantikan anak yang sah berikutnya dari Tertanggung sesuai yang tercantum dalam di data Polis dengan ketentuan masih memenuhi ketentuan penerima manfaat anuitas berkala bulanan Yatim/Piatu dan maksimal sebanyak 3 (tiga) orang anak", $this->borderm, 'J');
				}
				$y2 = $this->GetY();
				$yH = $y2 - $y1;
				$this->SetXY($x1 + $this->PG_W-90, $y2 - $yH);
				$this->Cell(44, ($this->height-1)*$heighty, 'Rp'.number_format($this->data['JPYT'], 0, ',', '.'), $this->borderm, 1, 'R');
			}
        }

        $no++;
        $this->Cell(6, ($this->height-1)*4, $no, $this->borderm, 0, 'C');
        $this->Cell(40, ($this->height-1)*4, 'Pengembalian Sisa Dana', $this->borderm, 0, 'L');
        $x1 = $this->GetX();
		$y1 = $this->GetY();
        $this->MultiCell($this->PG_W-90, $this->height-1, "Pengembalian Sisa Dana (jika ada) yaitu selisih antara Premi dengan total manfaat yang telah dibayarkan, jika sudah tidak ada lagi yang berhak menerima Manfaat Anuitas. Pengembalian Sisa Dana diberikan kepada Penerima Manfaat yang sah secara hukum", $this->borderm, 'J');
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + $this->PG_W-90, $y2 - $yH);
		$this->Cell(44, ($this->height-1)*4, 'Jika Ada', $this->borderm, 1, 'R');
        $this->Ln(5);
        $this->SetFont('Monserrat', 'B', 7);
		$this->SetFillColor(255,0,0);
        $this->SetTextColor(255,255,255);
		$this->Cell($this->PG_W, $this->height, 'Ilustrasi bukan merupakan kontrak asuransi, namun hanya ilustrasi. Manfaat sebenarnya tercantum dalam polis', 1, 1, 'C', true);

        $this->SetTextColor(0,0,0);
	}
    
    function Footer() {
        $this->SetY(-25);
		$this->SetFont('Monserrat', 'B', 6);
		$this->Cell($this->PG_W, $this->height, '', 'B', 1, 'L');
		$this->Cell(30, 3, 'Build ID', $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'I', 6);
		$this->Cell(2, 3, ':', $this->border, 0, 'C');
		$this->Cell(63, 3, $this->data['BUILDID'], $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'B', 6);
		$this->Cell(30, 3, 'Nomor Agen', $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'I', 6);
		$this->Cell(2, 3, ':', $this->border, 0, 'C');
		$this->Cell(63, 3, $this->data['NOAGEN'], $this->border, 1, 'L');
		$this->SetFont('Monserrat', 'B', 6);
		$this->Cell(30, 3, 'Tanggal', $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'I', 6);
		$this->Cell(2, 3, ':', $this->border, 0, 'C');
		$this->Cell(63, 3, $this->data['TGLREKAM'], $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'B', 6);
		$this->Cell(30, 3, 'Kantor', $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'I', 6);
		$this->Cell(2, 3, ':', $this->border, 0, 'C');
		$this->Cell(63, 3, ucwords(strtolower($this->data['NAMAKANTOR'])), $this->border, 1, 'L');
		$this->SetFont('Monserrat', 'B', 6);
		$this->Cell(30, 3, 'Disajikan', $this->border, 0, 'L');
		$this->SetFont('Monserrat', 'I', 6);
		$this->Cell(2, 3, ':', $this->border, 0, 'C');
		$this->Cell(63, 3, ucwords(strtolower($this->data['NAMAAGEN'])), $this->border, 1, 'L');
		//$this->Ln(2);
		
        $this->Cell($this->PG_W, 5, 'Halaman '.$this->PageNo().' dari {nb}', 0, 0, 'R');
    }
	
	function _Age($tgllahir, $tglcetak) {
		$birthdate = explode("-", $tgllahir);
		$printdate = explode("-", $tglcetak);
		$bdate = date("md", date("U", mktime(0, 0, 0, $birthdate[1], $birthdate[0], $birthdate[2])));
		$pdate = date("md", date("U", mktime(0, 0, 0, $printdate[1], $printdate[0], $printdate[2])));
		
		return ($bdate > $pdate ? ((date("Y") - $birthdate[2]) - 1) : (date("Y") - $birthdate[2]));
	}
}
