<?php
//var_dump($pos); exit;
$pdf = new PAPDF($pos);
$pdf->AliasNbPages();
$pdf->Output();

class PAPDF extends FPDF {
	private $PG_W = 190;
	private $height = 5;
	private $border = 0;
	private $napek_w = 34;
    private $data;
	private $pembagi = 1000;

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
		$this->Cell(50, $this->height, 'Merokok', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCPP']]['MEROKOK'] == 'Y' ? 'Ya' : 'Tidak', $this->border, 1, 'L');
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
		$this->Cell(50, $this->height, 'Merokok', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCTT']]['MEROKOK'] == 'Y' ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		
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
		$this->Cell(50, $this->height, 'Premi Dasar Sekaligus', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, 'Rp'.number_format($this->data['PREMI'], 0, ',', '.'), $this->border, 1, 'R');
		$this->Cell(50, $this->height, 'Top Up Sekaligus', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, 'Rp'.number_format($this->data['TOPUPSEKALIGUS'], 0, ',', '.'), 'B', 1, 'R');
		$this->Cell(50, $this->height, 'Total Premi yang dibayar', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, 'Rp'.number_format($this->data['PREMI']+$this->data['TOPUPSEKALIGUS'], 0, ',', '.'), $this->border, 1, 'R');
		$this->Cell(50, $this->height, 'Medical', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $this->data['KDSTATUSMEDICAL']=='M'?'Ya':'Tidak', $this->border, 1, 'L');
		$this->SetFont('Monserrat', 'I', 5);
		if ($this->data['KDSTATUSMEDICAL']!='M') {
			$this->MultiCell($this->PG_W, 3, "PT Asuransi Jiwa IFG berhak melakukan pemeriksaan medis bagi SPAJ non medical secara acak.\nStatus proposal bisa berubah menjadi medical sesuai dengan penilaian underwriter perusahaan", $this->border, 'J');
		}
		$this->Ln(2);
		
		// Alokasi dana
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'ALOKASI DANA INVESTASI (%)', 1, 1, 'L', true);
		$this->SetFont('Monserrat', '', 7);
		foreach ($this->data['OPSIFUND'] as $i => $v) {
			$this->Cell(50, $this->height, $v['NAMAFUND'], 'LTB', 0, 'L');
			$this->Cell(2, $this->height, ':', 'TB', 0, 'C');
			$this->Cell($this->PG_W-52, $this->height, "$v[PORSI]%", 'RTB', 1, 'L');
		}
		$this->Ln(3);
		
		// Biaya asuransi
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'BIAYA ASURANSI', 1, 1, 'L', true);
		$this->Cell(90, $this->height*2, 'Nama Asuransi', 1, 0, 'C');
		$x1 = $this->GetX();
		$y1 = $this->GetY();
		$this->MultiCell(24, $this->height, "Sampai Usia Tertanggung", 1, 'C');
		$y2 = $this->GetY();
		$yH = $y2 - $y1;
		$this->SetXY($x1 + 24, $y2 - $yH);
		$this->Cell(38, $this->height*2, 'Uang Asuransi', 1, 0, 'C');
		$this->MultiCell(38, $this->height, "Biaya Asuransi Per Bulan", 1, 'C');
		$this->SetFont('Monserrat', '', 7);
		foreach ($this->data['RIDER'] as $i => $v) {
			$this->Cell(90, $this->height, $v['NAMABENEFIT'], 1, 0, 'L');
			$this->Cell(24, $this->height, "99 Tahun", 1, 0, 'C');
			$this->Cell(38, $this->height, 'Rp'.number_format($v['MANFAAT'], 0, ',', '.'), 1, 0, 'R');
			$this->Cell(38, $this->height, 'Rp'.number_format($v['BIAYA'], 0, ',', '.'), 1, 1, 'R');
		}
		$this->Ln(2);
		$this->SetFont('Monserrat', 'I', 5);
		$this->MultiCell($this->PG_W, 3, "Biaya sudah termasuk extra premi karena risiko pekerjaan dan hobi.\nBiaya asuransi per bulan dapat berubah sesuai dengan penilaian dari Underwriter Perusahaan.", $this->border, 'J');
		$this->Ln(3);		
		
		// Biaya asuransi
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'KETERANGAN MANFAAT ASURANSI', 1, 1, 'L', true);
		$this->SetFont('Monserrat', '', 7);
		foreach ($this->data['RIDER'] as $i => $v) {
			$this->Cell(50, $this->height, $v['NAMABENEFIT'], $this->border, 0, 'L');
			$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			$this->Multicell($this->PG_W-52, $this->height, $v['DESKRIPSI'], $this->border, 'J');
		}
		
		
		/*===== Halaman 2 =====*/
		$this->AddPage();
		$this->SetFont('Monserrat', '', 7);
		$this->SetFillColor(200,200,200);
		$this->Cell(64, $this->height*1.5, null, 1, 0, 'C', true);
		$this->SetX(10);
		$this->Write($this->height*1.5, 'Hanya Sebuah Ilustrasi dan Tidak Dijamin');
		$this->subWrite($this->height*1.5, '(a)', '', 6, 4);
		$this->SetX(74);
		$this->Cell(63, $this->height*1.5, null, 1, 0, 'C');
		$this->SetX(74);
		$this->Write($this->height*1.5, 'Saldo Dana');
		$this->subWrite($this->height*1.5, '(b)', '', 6, 4);
		$this->SetX(137);
		$this->Cell(63, $this->height*1.5, 'Manfaat Meninggal Dunia', 1, 1, 'L');
		
		$this->Cell(10, $this->height*1.5, 'Tahun', 1, 0, 'C', false);
		$this->Cell(10, $this->height*1.5, null, 1, 0, 'C', false);
		$this->SetX(20);
		$this->Write($this->height*1.5, 'Usia');
		$this->subWrite($this->height*1.5, '(c)', '', 6, 4);
		$this->SetX(30);
		$this->Cell(20, $this->height*1.5, 'Premi', 1, 0, 'C', false);
		$this->Cell(24, $this->height*1.5, 'Topup Sekaligus', 1, 0, 'C', false);
		$rendah = 0;
		$sedang = 0;
		$tinggi = 0;
		foreach ($this->data['OPSIFUND'] as $i => $v) {
			$rendah += $v['RENDAH'] * ($v['PORSI']);
			$sedang += $v['SEDANG'] * ($v['PORSI']);
			$tinggi += $v['TINGGI'] * ($v['PORSI']);
		}
		$this->Cell(21, $this->height*1.5, "Rendah (".(number_format($rendah/$i, 2, ',', '.'))."%)", 1, 0, 'C', false);
		$this->Cell(21, $this->height*1.5, "Sedang (".(number_format($sedang/$i, 2, ',', '.'))."%)", 1, 0, 'C', false);
		$this->Cell(21, $this->height*1.5, "Tinggi (".(number_format($tinggi/$i, 2, ',', '.'))."%)", 1, 0, 'C', false);
		$this->Cell(21, $this->height*1.5, "Rendah (".(number_format($rendah/$i, 2, ',', '.'))."%)", 1, 0, 'C', false);
		$this->Cell(21, $this->height*1.5, "Sedang (".(number_format($sedang/$i, 2, ',', '.'))."%)", 1, 0, 'C', false);
		$this->Cell(21, $this->height*1.5, "Tinggi (".(number_format($tinggi/$i, 2, ',', '.'))."%)", 1, 1, 'C', false);
		$this->SetFont('Monserrat', '', 6);
		foreach ($this->data['HASIL'] as $i => $v) {
			if ($i>34 && !in_array($v['USIA'], array(80,99))) {
				continue;
			}
			
			$this->Cell(10, $this->height*0.6, $v['TAHUN'], 1, 0, 'C', false);
			$this->Cell(10, $this->height*0.6, $v['USIA'], 1, 0, 'C', false);
			$this->Cell(20, $this->height*0.6, number_format($v['PREMI']/$this->pembagi, 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(24, $this->height*0.6, number_format($v['TOPUPSEKALIGUS']/$this->pembagi, 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(21, $this->height*0.6, $v['INVESTASIRENDAH'] <= 0 ? '(d)' : number_format(floor($v['INVESTASIRENDAH']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(21, $this->height*0.6, $v['INVESTASISEDANG'] <= 0 ? '(d)' : number_format(floor($v['INVESTASISEDANG']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(21, $this->height*0.6, $v['INVESTASITINGGI'] <= 0 ? '(d)' : number_format(floor($v['INVESTASITINGGI']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(21, $this->height*0.6, $v['INVESTASIUARENDAH'] <= 0 ? '(d)' : number_format(floor($v['INVESTASIUARENDAH']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(21, $this->height*0.6, $v['INVESTASIUASEDANG'] <= 0 ? '(d)' : number_format(floor($v['INVESTASIUASEDANG']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(21, $this->height*0.6, $v['INVESTASIUATINGGI'] <= 0 ? '(d)' : number_format(floor($v['INVESTASIUATINGGI']), 0, ',', '.'), 1, 1, 'R', false);
		}
		$this->Ln(2);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell($this->PG_W, $this->height, 'Asumsi tingkat investasi yang digunakan adalah sebagai berikut :', $this->border, 1, 'L');
		$this->Cell(64, $this->height, 'Alokasi Dana', 1, 0, 'C');
		$this->Cell(21, $this->height, 'Nilai Alokasi', 1, 0, 'C');
		$this->Cell(21, $this->height, null, 1, 0, 'L');
		$this->SetX(95);
		$this->Write($this->height, 'Rendah');
		$this->subWrite($this->height, '(e)', '', 6, 3);
		$this->SetX(116);
		$this->Cell(21, $this->height, null, 1, 0, 'L');
		$this->SetX(116);
		$this->Write($this->height, 'Sedang');
		$this->subWrite($this->height, '(e)', '', 6, 3);
		$this->SetX(137);
		$this->Cell(21, $this->height, null, 1, 0, 'L');
		$this->SetX(137);
		$this->Write($this->height, 'Tinggi');
		$this->subWrite($this->height, '(e)', '', 6, 3);
		$this->Ln();
		foreach ($this->data['OPSIFUND'] as $i => $v) {
			$this->Cell(64, $this->height, $v['NAMAFUND'], 1, 0, 'L');
			$this->Cell(21, $this->height, "$v[PORSI]%", 1, 0, 'C');
			$this->Cell(21, $this->height, ($v['RENDAH']*100)."%", 1, 0, 'C');
			$this->Cell(21, $this->height, ($v['SEDANG']*100)."%", 1, 0, 'C');
			$this->Cell(21, $this->height, ($v['TINGGI']*100)."%", 1, 1, 'C');
		}
		$this->Ln(2);
		$this->SetFont('Monserrat', 'I', 5);
		$this->Cell(5, $this->height*0.5, "(a)", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height*0.5, "Ilustrasi di atas dalam ribuan rupiah.", $this->border, 'J');
		$this->Cell(5, $this->height*0.5, "(b)", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height*0.5, "Saldo Dana telah mempertimbangkan seluruh biaya-biaya.", $this->border, 'J');
		$this->Cell(5, $this->height*0.5, "(c)", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height*0.5, "Masa Asuransi sampai dengan Tertanggung mencapai usia 99 tahun.", $this->border, 'J');
		$this->Cell(5, $this->height*0.5, "(d)", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height*0.5, "Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan administrasi, dan oleh karena itu Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melakukan top up sekaligus.", $this->border, 'J');
		$this->Cell(5, $this->height*0.5, "(e)", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height*0.5, "Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.", $this->border, 'J');
		
		/*===== Halaman 3 =====*/
		$this->AddPage();
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'HAL-HAL PENTING', 1, 0, 'L', true);
		$this->ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(5, $this->height, "1.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Alokasi Premi yang dibentuk ke dalam Premi.", $this->border, 'J');
		$this->Cell(70, $this->height, null, $this->border, 0, 'L');
		$this->Cell(30, $this->height, 'Tahun 1', 1, 1, 'C');
		$this->Cell(30, $this->height*2, "Premi Sekaligus", 1, 0, 'L');
		$this->Cell(40, $this->height, "Investasi", 1, 0, 'L');
		$this->Cell(30, $this->height, "95%", 1, 0, 'C');
		$this->SetXY(40,$this->GetY()+$this->height);
		$this->Cell(40, $this->height, "Biaya", 1, 0, 'L');
		$this->Cell(30, $this->height, "5%", 1, 1, 'C');
		$this->Cell(30, $this->height*2, "Top Up Sekaligus", 1, 0, 'L');
		$this->Cell(40, $this->height, "Investasi", 1, 0, 'L');
		$this->Cell(30, $this->height, "95%", 1, 0, 'C');
		$this->SetXY(40,$this->GetY()+$this->height);
		$this->Cell(40, $this->height, "Biaya", 1, 0, 'L');
		$this->Cell(30, $this->height, "5%", 1, 1, 'C');
		$this->ln(2);
		$this->Cell(5, $this->height, "2.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Ilustrasi di atas akan diperhitungkan dengan:", $this->border, 'J');
		$this->Cell(10, $this->height, "a.", $this->border, 0, 'R');
		$this->MultiCell($this->PG_W-10, $this->height, "Biaya administrasi sebesar Rp27.500 per bulan selama masa asuransi.", $this->border, 'J');
		$this->Cell(10, $this->height, "b.", $this->border, 0, 'R');
		$this->MultiCell($this->PG_W-10, $this->height, "Biaya Asuransi (Cost Of insurance dan Cost Of Rider) akan dikenakan setiap bulan selama masa Asuransi. Besarnya COI dan COR akan naik setiap tahun sesuai dengan bertambahnya usia Tertanggung.", $this->border, 'J');
		$this->Cell(10, $this->height, "c.", $this->border, 0, 'R');
		$this->MultiCell($this->PG_W-10, $this->height, "Biaya pengelolaan investasi maksimal 2% per tahun tergantung jenis reksadana yang dipilih.", $this->border, 'J');
		$this->Cell(5, $this->height, "3.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Unit yang dihitung berdasarkan Harga Unit pada saat tertentu.", $this->border, 'J');
		$this->Cell(5, $this->height, "4.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Asumsi tinggi rendahnya tingkat hasil investasi ini hanya bertujuan untuk ilustrasi saja dan bukan merupakan tolak ukur untuk perhitungan rata-rata tingkat hasil investasi yang terendah dan tertinggi.", $this->border, 'J');
		$this->Cell(5, $this->height, "5.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Perubahan harga unit menggambarkan hasil investasi dari dana investasi. Kinerja dari investasi tidak dijamin tergantung dari risiko masing-masing dana investasi. Pemegang Polis diberi keleluasaan untuk menempatkan alokasi dana investasi yang memungkinkan Optimalisasi tingkat pengembalian investasi, sesuai dengan kebutuhan dan profil risiko Pemegang Polis.", $this->border, 'J');
		$this->Cell(5, $this->height, "6.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Besarnya Nilai Tunai yang dibayarkan (bisa lebih besar atau lebih kecil dari yang diilustrasikan) akan bergantung pada perkembangan dari dana investasi ".$this->data['NAMAPRODUK'].".", $this->border, 'J');
		$this->Cell(5, $this->height, "7.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Jumlah minimum Top Up Sekaligus adalah Rp1.000.000.", $this->border, 'J');
		$this->Cell(5, $this->height, "8.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Minimum penarikan dana (Redemptions) adalah Rp1.000.000 dan menyisakan dana minimum setara dengan 1.000 unit.", $this->border, 'J');
		$this->Cell(5, $this->height, "9.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Polis bebas biaya penarikan dana.", $this->border, 'J');
		$this->Cell(5, $this->height, "10.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Penilaian harga unit dilakukan pada setiap hari kerja, Senin sampai dengan Jumat dengan menggunakan metode harga pasar yang berlaku bagi instrumen investasi yang mendasari masing-masing alokasi dana investasi yang dipilih.", $this->border, 'J');
		$this->Cell(5, $this->height, "11.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Besarnya Nilai Tunai yang terbentuk pada polis ini (dapat lebih besar atau lebih kecil dari dana yang diinvestasikan oleh Pemegang Polis), akan dipengaruhi oleh fluktuasi dari harga unit atau faktor biaya-biaya sebagaimana disebutkan di atas.", $this->border, 'J');
		$this->Cell(5, $this->height, "12.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Harga unit yang digunakan pada Premi Pertama akan terbentuk setelah diterimanya SPAJ dan teridentifikasinya seluruh pembayaran Premi Pertama di Kantor Pusat oleh PT Asuransi Jiwa IFG. Tanggal Perhitungan Harga Unit adalah Tanggal Perhitungan berikutnya setelah diterimanya SPAJ. Atau teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat, mana yang paling akhir.", $this->border, 'J');
		$this->Cell(5, $this->height, "13.", $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, "Memiliki Polis Asuransi Jiwa merupakan komitmen jangka panjang. ".$this->data['NAMAPRODUK']." adalah suatu produk asuransi jiwa yang dikaitkan dengan investasi. Untuk dapat menikmati manfaat polis ini, maka kami sarankan Anda untuk melakukan top up sekaligus pada Masa Asuransi.", $this->border, 'J');
		
		/*===== Halaman 4 =====*/
		$this->AddPage();
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'RINGKASAN MANFAAT', 1, 0, 'L', true);
		$this->ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nama Tertanggung', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data[$this->data['NOCTT']]['NAMAKLIEN'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Usia Tertanggung', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->_Age($this->data[$this->data['NOCTT']]['TGLLAHIR'], $this->data['TGLREKAM']).' Tahun', $this->border, 1, 'L');
		$this->SetFont('Monserrat', 'B', 7);
		$this->MultiCell($this->PG_W, $this->height, "A. Masa Pembayaran Premi adalah ".$this->data['NAMACARABAYAR'], $this->border, 'J');
		$this->SetFont('Monserrat', 'I', 6);
		$this->MultiCell($this->PG_W, $this->height, "Informasi mengenai Uraian Biaya-biaya terdapat dalam halaman Hal-Hal Penting.", $this->border, 'J');
		$this->SetFont('Monserrat', 'B', 7);
		//$this->MultiCell($this->PG_W, $this->height, "", $this->border, 'J');
		$this->Write($this->height, 'B. Asumsi Nilai Tunai dimasa yang akan datang');
		$this->subWrite($this->height, '(a)', '', 6, 4);
		$this->Ln();
		$this->Cell($this->PG_W, $this->height, 'HANYA SEBUAH ILUSTRASI DAN TIDAK DIJAMIN', 1, 1, 'C', true);
		$this->Cell(46, $this->height, 'Usia', 1, 0, 'C');
		$this->Cell(48, $this->height, 'Rendah', 1, 0, 'C');
		$this->Cell(48, $this->height, 'Sedang', 1, 0, 'C');
		$this->Cell(48, $this->height, 'Tinggi', 1, 1, 'C');
		$this->SetFont('Monserrat', '', 7);
		$flagb = false;
		foreach ($this->data['HASIL'] as $i => $v) {
			if (!in_array($v['USIA'], array(50,60,70))) {
				continue;
			}
			
			$flagb = $v['INVESTASIRENDAH'] < 0 || $v['INVESTASISEDANG'] < 0 || $v['INVESTASITINGGI'] < 0 ? true : false;
			
			$this->Cell(46, $this->height, $v['USIA'], 1, 0, 'C', false);
			$this->Cell(48, $this->height, $v['INVESTASIRENDAH'] < 0 ? '(b)' : number_format(floor($v['INVESTASIRENDAH']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(48, $this->height, $v['INVESTASISEDANG'] < 0 ? '(b)' : number_format(floor($v['INVESTASISEDANG']), 0, ',', '.'), 1, 0, 'R', false);
			$this->Cell(48, $this->height, $v['INVESTASITINGGI'] < 0 ? '(b)' : number_format(floor($v['INVESTASITINGGI']), 0, ',', '.'), 1, 1, 'R', false);
		}
		$this->Ln(2);
		$this->SetFont('Monserrat', 'I', 6);
		$this->Cell(5, $this->height, '(a)', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-5, $this->height, "Nilai Tunai dihitung dengan menggunakan asumsi tingkat investasi. Besarnya Nilai Tunai yang dibayarkan (dapat lebih besar atau lebih kecil dari yang diilustrasikan), akan bergantung pada perkembangan dari dana investasi.", $this->border, 'J');
		if ($flagb) {
			$this->Cell(5, $this->height, '(b)', $this->border, 0, 'C');
			$this->MultiCell($this->PG_W-5, $this->height, "Menunjukkan bahwa Nilai Tunai pada tahun tersebut tidak mencukupi untuk membayar Biaya Asuransi dan Administrasi, dan oleh karena itu Polis akan batal (lapse). Supaya Manfaat Polis dapat terus berlanjut, maka Anda diminta untuk melakukan top up sekaligus.", $this->border, 'J');
		}
		$this->SetFont('Monserrat', 'B', 7);
		$this->MultiCell($this->PG_W, $this->height, "C. Asuransi Dasar", $this->border, 'J');
		$this->SetFont('Monserrat', '', 7);
		$this->MultiCell($this->PG_W, $this->height, "Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah besar Nilai Investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit atau karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi ".$this->data['NAMAPRODUK']." sebesar Rp".number_format($this->data['JUA'], 0, ',', '.')." ditambah Saldo Dana Investasi.", $this->border, 'J');
		$this->Ln(2);
		$this->SetFont('Monserrat', 'I', 5);
		$this->MultiCell($this->PG_W, $this->height, "(Hanya untuk ilustrasi, keterangan lengkap menganai Manfaat Asuransi pada produk Asuransi, termasuk syarat-syarat dan pengecualian tercantum pada Polis dan berlaku mengikat)", $this->border, 'J');
		
		/*===== Halaman 5 =====*/
		$this->AddPage();
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'RISIKO', 1, 0, 'L', true);
		$this->ln(5);
		$this->SetFont('Monserrat', 'B', 7);
		$this->MultiCell($this->PG_W, $this->height, "Risiko Asuransi Unit Link", $this->border, 'J');
		$this->SetFont('Monserrat', '', 7);
		$this->MultiCell($this->PG_W, $this->height, "Harga Unit dapat mengalami fluktuasi mengikuti harga pasar. Hal ini akan terlihat pada volatilitas dari harga unit dan akan menyebabkan kemungkinan terjadinya kenaikan atau penurunan nilai investasi.", $this->border, 'J');
		$this->SetFont('Monserrat', 'B', 7);
		$this->MultiCell($this->PG_W, $this->height, "Risiko Operasional", $this->border, 'J');
		$this->SetFont('Monserrat', '', 7);
		$this->MultiCell($this->PG_W, $this->height, "Suatu risiko kerugian yang disebabkan karena tak berjalannya atau gagalnya proses internal, manusia, dan sistem serta oleh peristiwa eksternal.", $this->border, 'J');
		$this->Ln(2);
		$this->MultiCell($this->PG_W, $this->height, "Pertanggungan asuransi ".$this->data['NAMAPRODUK']." tidak berlaku apabila Tertanggung meninggal dalam keadaan sebagai berikut :", $this->border, 'J');
		$this->Cell(5, $this->height, 'a.', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-5, $this->height, "Akibat tindakan bunuh diri yang terjadi dalam waktu 2 (dua) tahun terhitung sejak Tanggal Penerbitan Polis atau Addendum yang terkini atau tanggal penerbitan pemulihan yang terkini (mana saja yang terjadi terakhir).", $this->border, 'J');
		$this->Cell(5, $this->height, 'b.', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-5, $this->height, "Tertanggung sedang/sebagai akibat melakukan tindak kejahatan.", $this->border, 'J');
		$this->Cell(5, $this->height, 'c.', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-5, $this->height, "Tertanggung menjalani eksekusi hukuman mati oleh pengadilan.", $this->border, 'J');
		$this->Cell(5, $this->height, 'd.', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-5, $this->height, "Terjadi akibat tindak kejahatan atau pembunuhan yang dilakukan oleh yang berkepentingan dalam pertanggungan.", $this->border, 'J');
		$this->SetFont('Monserrat', 'I', 5);
		$this->MultiCell($this->PG_W, $this->height, "(Detail lengkap klausul Pengecualian dinyatakan dalam Ketentuan Umum dan Ketentuan Khusus Polis)", $this->border, 'J');
		
		/*===== Halaman 6 =====*/
		/*$this->AddPage();
		$this->SetFont('Monserrat', 'B', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height, 'DISAJIKAN OLEH', 1, 0, 'L', true);
		$this->ln(5);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nama Agen', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['NAMAAGEN'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor Agen', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['NOAGEN'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell(43, $this->height, $this->data['TGLREKAM'], $this->border, 1, 'L');
		$this->Ln(30);
		$this->Cell($this->PG_W/2, $this->height, 'Tanda Tangan Agen', $this->border, 0, 'C');
		$this->Cell($this->PG_W/2, $this->height, 'Tanda Tangan Calon Pemegang Polis', $this->border, 0, 'C');
		$this->Ln(40);
		$this->Cell($this->PG_W/2, $this->height, $this->data['NAMAAGEN'], $this->border, 0, 'C');
		$this->Cell($this->PG_W/2, $this->height, $this->data[$this->data['NOCPP']]['NAMAKLIEN'], $this->border, 1, 'C');
		$this->SetFont('Monserrat', 'I', 5);
		$this->Cell($this->PG_W/2, $this->height, 'Saya telah menjelaskan Ilustrasi ini kepada Calon Pemegang Polis', $this->border, 0, 'C');
		$this->Cell($this->PG_W/2, $this->height, 'Saya telah membaca, memahami dan mengerti risiko dan isi dari ilustrasi ini', $this->border, 0, 'C');*/
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