<?php

$pdf = new PAPDF($pos);
$pdf->AliasNbPages();
$pdf->Output();

class PAPDF extends FPDF {
	private $PG_W = 190;
	private $height = 5;
	private $border = 0;
	private $napek_w = 34;
    private $data;

    function __construct($pos) {
        parent::__construct('P', 'mm', 'A4');
		$this->data = $pos;
        $this->AddFont('Monserrat', '', 'fpdf/font/Montserrat-Medium.php');
        $this->AddFont('Monserrat', 'B', 'fpdf/font/Montserrat-Bold.php');
        $this->AddFont('Monserrat', 'I', 'fpdf/font/Montserrat-MediumItalic.php');
		
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
		$this->Cell(155, $this->height, 'Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190', $this->border, 1, 'L');
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
		$this->Cell(43, $this->height, strtoupper(strtolower($this->data[$this->data['NOCPP']]['NAMAKLIEN'])), $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Nomor Telepon', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCPP']]['TELEPON'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCPP']]['TGLLAHIR'].' / '.$this->_Age($this->data[$this->data['NOCPP']]['TGLLAHIR'], $this->data['TGLREKAM']).' Tahun', $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Nomor Handphone', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCPP']]['HP'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Email', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCPP']]['EMAIL'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Pekerjaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data[$this->data['NOCPP']]['NAMAPEKERJAAN'], $this->border, 'L');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCPP']]['NAMAJENISKELAMIN'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Hobi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data[$this->data['NOCPP']]['NAMAHOBI'], $this->border, 'L');
		$this->Ln(2);
		
		// Calon tertanggung
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'CALON TERTANGGUNG', 1, 0, 'L', true);
		$this->Ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, strtoupper(strtolower($this->data[$this->data['NOCTT']]['NAMAKLIEN'])), $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'No KTP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCTT']]['NOID'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCTT']]['TGLLAHIR'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Hubungan Dengan Pemegang Polis', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCTT']]['NAMAHUBUNGAN'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Usia', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->_Age($this->data[$this->data['NOCTT']]['TGLLAHIR'], $this->data['TGLREKAM']).' Tahun', $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Pekerjaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data[$this->data['NOCTT']]['NAMAPEKERJAAN'], $this->border, 'L');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCTT']]['NAMAJENISKELAMIN'], $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Hobi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell(43, $this->height, $this->data[$this->data['NOCTT']]['NAMAHOBI'], $this->border, 'L');
		
		$this->Cell($this->PG_W, $this->height, '', 'B', 1, 'L');
		$this->Cell(50, $this->height, 'Cara Bayar', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $this->data['NAMACARABAYAR'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Uang Pertanggungan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, 'Rp'.number_format($this->data['JUA'], 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Mata Uang', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, 'IDR', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Premi yang dibayar', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, 'Rp'.number_format($this->data['PREMI'], 0, ',', '.'), $this->border, 1, 'L');
		$this->Ln(2);
		
		
		// Manfaat asuransi
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'KETERANGAN MANFAAT ASURANSI', 1, 0, 'L', true);
		$this->Ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(5, $this->height-1, '1)', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height-1, 'Jika Tertanggung di dalam Masa Asuransi oleh sebab sesuatu Kecelakaan yang diakui oleh Penanggung dan mengakibatkan meninggal dunia seketika atau sebagai akibat langsung dalam masa 90 x 24 jam setelah jam terjadinya Kecelakaan dimaksud maka Penanggung akan membayarkan Manfaat Asuransi kepada yang berhak sebesar 100% Uang Asuransi.', $this->border, 'J');
		$this->Cell(5, $this->height-1, '2)', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height-1, 'Jika Tertanggung di dalam Masa Asuransi oleh sebab suatu Kecelakaan yang dialaminya menjadi cacat tetap total seketika atau sebagai akibat langsung dalam masa 90 x 24 jam setelah jam terjadinya Kecelakaan dimaksud maka Penanggung akan membayarkan Manfaat Asuransi kepada yang berhak, sebesar maksimal 250% Uang Asuransi.', $this->border, 'J');
		$this->Cell(5, $this->height-1, '3)', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height-1, 'Dalam hal Cacat Tetap Sebagian, Penanggung akan membayarkan Manfaat Asuransi secara kumulatif apabila kehilangan atau kehilangan fungsi :', $this->border, 'J');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'a.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Lengan kanan mulai dari pundak kebawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 70% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'k.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Pendengaran kedua belah telinga', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 50% UA', $this->border, 1, 'L');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'b.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Lengan kiri mulai dari pundak kebawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 56% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'l.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Pendengaran sebelah telinga', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 15% UA', $this->border, 1, 'L');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'c.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Lengan kanan mulai dari siku/ atas siku ke bawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 65% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'm.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Ibu jari tangan kanan', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 25% UA', $this->border, 1, 'L');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'd.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Lengan kiri mulai dari siku/ atas siku ke bawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 52% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'n.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Ibu jari tangan kiri', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 20% UA', $this->border, 1, 'L');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'e.', $this->border, 0, 'L');
		
		$x1 = $this->GetX();
		$y1 = $this->GetY();
		$this->MultiCell(69, 4, 'Tangan kanan mulai pergelangan/ atas Pergelangan ke bawah', $this->border, 'J');
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + 69, $y2 - $yH);
		
		$this->Cell(19, $this->height-1, ': 60% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'o.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Jari telunjuk kanan', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 25% UA', $this->border, 1, 'L');
		$this->SetY($y2);
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'f.', $this->border, 0, 'L');
		
		$x1 = $this->GetX();
		$y1 = $this->GetY();
		$this->MultiCell(69, 4, 'Tangan kiri mulai pergelangan/atas Pergelangan ke  bawah', $this->border, 'J');
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + 69, $this->GetY() - $yH);
		
		$this->Cell(19, $this->height-1, ': 50% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'p.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Jari telunjuk kiri  ', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 12% UA', $this->border, 1, 'L');
		$this->SetY($y2);
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'g.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Sebelah kaki dari pinggul ke bawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 50% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'q.', $this->border, 0, 'L');
		
		$x1 = $this->GetX();
		$y1 = $this->GetY();
		$this->MultiCell(69, 4, 'Salah satu jari selain ibu jari dan jari telunjuk tangan kanan', $this->border, 'J');
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + 69, $this->GetY() - $yH);
		
		$this->Cell(18, $this->height-1, ': 5% UA', $this->border, 1, 'L');
		$this->SetY($y2);
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'h.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Kedua belah kaki dari mata kaki ke bawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 70% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'r.', $this->border, 0, 'L');
		
		$x1 = $this->GetX();
		$y1 = $this->GetY();
		$this->MultiCell(69, 4, 'Salah satu jari selain ibu jari dan jari telunjuk tangan kiri', $this->border, 'J');
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + 69, $this->GetY() - $yH);
		
		$this->Cell(18, $this->height-1, ': 4% UA', $this->border, 1, 'L');
		$this->SetY($y2);
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'i.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Sebelah kaki dari mata kaki ke bawah', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 35% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 's.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Salah satu ibu jari kaki', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 4% UA', $this->border, 1, 'L');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 'j.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Penglihatan sebelah mata', $this->border, 0, 'L');
		$this->Cell(19, $this->height-1, ': 50% UA', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, 't.', $this->border, 0, 'L');
		$this->Cell(69, $this->height-1, 'Salah satu jari selain ibu jari kaki', $this->border, 0, 'L');
		$this->Cell(18, $this->height-1, ': 3% UA', $this->border, 1, 'L');
		$this->Cell(5, $this->height-1, '4)', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height-1, 'Jika Tertanggung di dalam Masa Asuransi oleh sebab sesuatu Kecelakaan yang diakui oleh Penanggung dan mengakibatkan meninggal dunia seketika atau sebagai akibat langsung dalam masa 90 x 24 jam setelah jam terjadinya Kecelakaan dimaksud maka Penanggung akan membayarkan Manfaat Asuransi kepada yang berhak sebesar 100% Uang Asuransi.', $this->border, 'J');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, chr(127), $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-10, $this->height-1, 'Jumlah Manfaat Asuransi yang telah diterima lebih besar dari 100 % (seratus persen) Uang Asuransi, maka tidak ada lagi Manfaat Asuransi yang dibayarkan.', $this->border, 'J');
		$this->Cell(5, $this->height-1, '', $this->border, 0, 'L');
		$this->Cell(5, $this->height-1, chr(127), $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-10, $this->height-1, 'Jumlah Manfaat Asuransi yang telah diterima lebih kecil dari 100 % (seratus persen) Uang Asuransi, maka Manfaat Asuransi yang dibayarkan kepada yang berhak adalah sebesar 100 % (seratus persen) Uang Asuransi dikurangi dengan Manfaat Asuransi yang telah diterima.', $this->border, 'J');
		
		if ($this->data['KDPRODUK'] == 'PAB') {			
			$this->Cell(5, $this->height-1, '5)', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height-1, 'Apabila Tertanggung di dalam masa asuransi oleh sebab suatu kecelakaan yang dialami seketika atau langsung dalam masa 90 x 24 jam setelah jam terjadinya kecelakaan dirawat inap di rumah sakit, akan dibayarkan biaya penggantian perawatan dan pengobatan sebesar biaya sebagaimana yang tercantum pada kuitansi yang sah dari Rumah Sakit dengan maksimum sebesar 40% x Uang Asuransi untuk setiap kejadian kecelakaan. Kecelakaan yang dialami Tertanggug yang dijamin maksimum 2 (dua) kali kecelakaan dalam masa asuransi.', $this->border, 'J');
		}
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