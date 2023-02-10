<?php
$pdf = new SertifikatPDF($pelatihan);
$pdf->Output();

class SertifikatPDF extends FPDF {
	private $pg_w = 271;
	private $height = 5;
	private $data;
	
	function __construct($pelatihan) {
        parent::__construct('L', 'mm', 'A4');
		$this->SetMargins(13, 55);
		$this->data = $pelatihan;
		
		$this->body();
	}
	
	public function header() {
		$this->Image(base_url('asset/img/bhun.png'), 18, 20, 40);
		$this->Image(base_url('asset/img/logo.jpg'), 240, 10, 40);
		$this->Image(base_url('asset/img/logo_big_watermark.png'), 50, 25, 200);
	}
	
	public function body() {
		$this->AddPage();
		$height = $this->height;
		$r = $this->data;
		
		$this->SetFont('times','B',36);
		$this->Cell($this->pg_w, 10, 'C E R T I F I C A T E', 0, 1, 'C');
		$this->Ln(4);
		$this->SetFont('times','',14);
		$this->Cell($this->pg_w, $height, $r['NO'], 0, 1, 'C');
		$this->Ln(8);
		$this->SetFont('times','B',24);
		$this->Cell($this->pg_w, 10, 'PT ASURANSI JIWASRAYA (PERSERO)', 0, 1, 'C');
		$this->Ln(5);
		$this->SetFont('times','I',14);
		$this->Cell($this->pg_w, $height, "certify that:", 0, 1, 'C');
		$this->Ln(7);
		$this->SetFont('times','B',28);
		$this->MultiCell($this->pg_w, 10, $r['NAMAKLIEN1'], 0, 'C');
		$this->Ln(5);
		$this->SetFont('times','',14);
		$this->Cell($this->pg_w, 7, "in recognition of professional achievement for successfully completing", 0, 1, 'C');
		$this->SetFont('times','B',16);
		$this->MultiCell($this->pg_w, 7, $r['NAMAPELATIHAN'], 0, 'C');
		$this->SetFont('times','',14);
		$this->Cell($this->pg_w, 7, "held on $r[TGLPELAKSANAAN]", 0, 1, 'C');
		$this->Ln(6);
		$this->Cell($this->pg_w-90, $this->height, null, 0, 0, 'C');
		$this->MultiCell(0, $this->height, "$r[ALAMAT02], $r[TGLCETAK]\n\n\n\n\n", 0, 'L');
		$this->Cell($this->pg_w-90, $this->height, null, 0, 0, 'C');
		$this->SetFont('times','B',14);
		$this->Cell(0, $this->height, "$r[NAMAPEJABAT]", 0, 1, 'L');
		$this->Cell($this->pg_w-90, $this->height, null, 0, 0, 'C');
		$this->SetFont('times','',14);
		$this->Cell(0, $this->height, "$r[NAMAJABATAN]", 0, 1, 'L');
		$this->Image(base_url('asset/img/ttd_dir_indra.png'), 196, 159, 40);
	}
}
?>