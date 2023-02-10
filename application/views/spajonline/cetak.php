<?php
//var_dump($spaj); exit;

class SPAJPDF extends FPDF {
	private $PG_W = 190;
	private $selfi_h = 50;
	private $ttd_h = 18;
	private $height = 5;
	private $border = 0;
	private $data;
	
	function __construct($spaj) {
        parent::__construct('P', 'mm', 'A4');
		$this->SetMargins(10, 10);
		$this->data = $spaj;
        $this->AddFont('Monserrat', '', 'Montserrat-Medium.php');
        $this->AddFont('Monserrat', 'B', 'Montserrat-Bold.php');
        $this->AddFont('Monserrat', 'I', 'Montserrat-MediumItalic.php');
		
		$this->body();
	}
	
	public function header() {
		$this->Image(FCPATH.'asset/img/logo-ifg.png', 10, 0, 32);
		$this->Ln();
		$this->SetFont('Monserrat', 'B', 14);
		$this->Cell(35, $this->height, '', $this->border, 0, 'L');
		$this->Cell(155, $this->height, 'SURAT PERMINTAAN ASURANSI JIWA (SPAJ)', $this->border, 1, 'L');
		$this->SetFont('Monserrat', '', 10);
		$this->Cell(35, $this->height, '', $this->border, 0, 'L');
		$this->Cell(155, $this->height, 'Nomor ' . @$this->data['nospaj'], $this->border, 1, 'L');
		$this->Ln(5);
		$this->SetFont('Monserrat', 'B', 12);
		//$this->Cell(190, 4, strtoupper(strtolower($this->data['NAMAPRODUK'])), 'B', 1, 'L');
		$this->Ln(2);
	}
	
	public function body() {
		$this->AddPage();
		$height = $this->height;
		$r = $this->data;
		$genders = array('0' => '--Pilih--', 'L' => 'Laki-laki', 'P' => 'Perempuan');
		$agamas = array('0' => '-- pilih --', '1' => 'ISLAM', '2' => 'PROTESTAN', '3' => 'KATHOLIK', '4' => 'HINDU', '5' => 'BUDHA', '6' => 'KONGHUTJU', '7' => 'ALIRAN KEPERCAYAAN LAIN');
		$selfictu = $this->genImageFromBase64(@$r['proposal_build_id'].@$r['data_diri_tertanggung']['nomorKTPTertanggung'], base64_decode(base64_decode(@$r['data_diri_tertanggung']['imageKTPTertanggung'])));
		$selficpp = $this->genImageFromBase64(@$r['proposal_build_id'].@$r['data_diri_pemegang_polis']['nomorKTPPempol'], base64_decode(base64_decode(@$r['data_diri_pemegang_polis']['imageKTPpempol'])));
		$statustinggal = array('0' => '--Pilih--', '1' => 'Milik Sendiri', '2' => 'Sewa', '3' => 'Lainnya');
		$provinsi = array();
		foreach (@$r['provinsi'] as $i => $v) {
			$provinsi = array_merge($provinsi, array($v['KDPROPINSI'] => $v['NAMAPROPINSI']));
		}
		$kota = array();
		foreach (@$r['kota'] as $i => $v) {
			$kota = array_merge($kota, array($v['KDKOTAMADYA'] => $v['NAMAKOTAMADYA']));
		}
		$hubungans = array('A' => 'Ayah', 'U' => 'Ibu', '1' => 'Anak', 'I' => 'Istri', 'S' => 'Suami', '04' => 'Diri Sendiri');
		$statusnikah = array('0' => '--Pilih--', 'L' => 'Lajang', 'K' => 'Kawin', 'J' => 'Janda', 'D' => 'Duda');
		$hubunganttg = array('0' => '--Pilih--', 'AT' => 'Ayah Tiri', '1T' => 'Anak Tiri', '2T' => 'Anak Tiri yang Dibeasiswakan', 'I' => 'Istri', 'S' => 'Suami', '1' => 'Anak', 'A' => 'Ayah', 'U' => 'Ibu', 'K' => 'Kakek', 'N' => 'Nenek', 'P' => 'Karyawan', 'B' => 'Kakak Kandung', 'C' => 'Adik Kandung', 'D' => 'Anak Angkat', 'G' => 'Cucu', 'Q' => 'Orang Tua Angkat', 'T' => 'Saudara Angkat', '04' => 'Diri Tertanggung', 'G2' => 'Cucu yang Dibeasiswakan', 'K2' => 'Keponakan yang Dibeasiswakan', 'K1' => 'Keponakan', 'O2' => 'Pemegang Polis', 'A2' => 'Anak yang Dibeasiswakan', 'PP' => 'Pemilih Perusahaan', 'PM' => 'Pimpinan Perusahaan', 'UT' => 'Ibu Tiri', 'ZZ' => 'Undefined');
		// echo "<pre>";
		// var_dump(@$r['pekerjaan']);die;
		$pekerjaan = array();
		foreach (@$r['pekerjaan'] as $i => $v) {
			$pekerjaan = array_merge($pekerjaan, array($v['KDPEKERJAAN'] => $v['NAMAPEKERJAAN']));
		}
		$pangkat = array('0' => '--Pilih--', 'staff' => 'Staff/Administrasi', 'supervisor' => 'Supervisor', 'manajer' => 'Manajer', 'kepalaseksi' => 'Kepala Seksi', 'kepalabagian' => 'Kepala Bagian', 'kepaladivisi' => 'Kepala Divisi', 'kepaladepartemen' => 'Kepala Departemen', 'pimpinan' => 'Pimpinan', 'lainnya' => 'Lainnya');
		$perusahaan = array('0' => '--Pilih--', 'swasta' => 'Swasta', 'bumnd' => 'BUMN/BUMD', 'pns' => 'PNS', 'tni' => 'TNI', 'polri' => 'POLRI', 'instansipemerintah' => 'Instansi Pemerintah', 'lainnya' => 'Lainnya');
		$bayarberikutnyas = array('0' => '--Pilih--', 'autodebet' => 'Auto Debet', 'host2host' => 'Host to Host', 'virtualaccount' => 'Virtual Account', 'ccdebet' => 'Credit Card');
		$hobi = array();
		foreach (@$r['hobi'] as $i => $v) {
			$hobi = array_merge($hobi, array($v['KDHOBI'] => $v['NAMAHOBI']));
		}
		$kirimpolis = array('alamatkorespondensi' => 'Alamat Korespondensi', 'alamatktp' => 'Alamat KTP', 'alamatemail' => 'Melalui Email (E-Polis)');
		$penutup = array('CPP_CT_CPP' => 'Calon Pemegang Polis/Calon Tertanggung/Calon Pembayar Premi', 'AGEN_PENUTUP' => 'Agen Penutup', 'LAINNYA' => 'Lainnya');
		$ttdctu = $this->genImageFromBase64(@$r['proposal_build_id'].@$r['data_diri_tertanggung']['nomorKTPTertanggung'].'_ttd', base64_decode(base64_decode(@$r['data_persetujuan']['sign1enc'])));
		$ttdcpp = $this->genImageFromBase64(@$r['proposal_build_id'].@$r['data_diri_pemegang_polis']['nomorKTPPempol'].'_ttd', base64_decode(base64_decode(@$r['data_persetujuan']['sign2enc'])));
		$ttdagn = $this->genImageFromBase64(@$r['proposal_build_id'].@$r['id_agen'].'_ttd', base64_decode(base64_decode(@$r['data_persetujuan']['sign3enc'])));
		$tipedokumen = array('0' => '--Pilih--', 'KTP' => 'Kartu Tanda Penduduk', 'KK' => 'Kartu Keluarga', 'AKTE BUKU NIKAH' => 'Akte/Buku Nikah', 'AKTE LAHIR ANAK' => 'Akte Kelahiran Anak', 'SPESIMEN TTD' => 'Spesimen Tanda Tangan', 'LAIN LAIN' => 'LAIN LAIN');
		
		/**
			date : 05012023
			note : tambahan untuk PAP
		**/
		$premierAnnuity = ['APP65', 'APP75', 'APP85', 'APPSH'];

		
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Build ID', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['proposal_build_id'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'No Agen', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['id_agen'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Agen', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['namaAgen'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'GUID', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['spaj_guid'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal SPAJ', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['spaj']['TGLREKAM'], $this->border, 1, 'L');
		
		// Identitas Tertanggung Utama
		$this->ln(2);
		$this->SetFont('Monserrat', '', 8);
		$this->SetFillColor(200,200,200);
		$this->Cell($this->PG_W, $this->height+2, 'Identitas Tertanggung Utama', $this->border, 1, 'L', true);
		$this->SetFont('Monserrat', '', 7);
		$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['namaLengkapTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Alias', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['namaAliasTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor KTP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['nomorKTPTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, date('d-m-Y', strtotime(@$r['data_diri_tertanggung']['tglLahirTertanggung'])), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tempat Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['tempatLahirTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor NPWP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['nomorNPWPTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$genders[@$r['data_diri_tertanggung']['jenkelTertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Agama', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$agamas[@$r['data_diri_tertanggung']['agamaTertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Swafoto', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Image(FCPATH.$selfictu, $this->GetX(), $this->GetY(), 0, $this->selfi_h);
		$this->SetY($this->GetY()+$this->selfi_h);
		
		// Alamat KTP Tertanggung Utama
		$this->ln(2);
		$this->SetFont('Monserrat', '', 8);
		$this->Cell($this->PG_W, $this->height+2, 'Alamat KTP Tertanggung Utama', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Status', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$statustinggal[@$r['data_diri_tertanggung']['statusTinggalKTPtertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['alamatKTPtertanggung'], $this->border, 'J');
		$this->Cell(50, $this->height, 'Provinsi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$provinsi[@$r['data_diri_tertanggung']['provinsiKTPtertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kabupaten/Kota', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$kota[@$r['data_diri_tertanggung']['kabupatenKTPtertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kodepos', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['kodeposKTPtertanggung'], $this->border, 1, 'L');
		
		// Alamat Surat Tertanggung Utama
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Alamat Surat Menyurat Tertanggung Utama', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Status', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['isAlamatKTPtertanggungSama'] ? @$statustinggal[@$r['data_diri_tertanggung']['statusTinggalKTPtertanggung']] : @$statustinggal[@$r['data_diri_tertanggung']['statusTinggalSurattertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['isAlamatKTPtertanggungSama'] ? @$r['data_diri_tertanggung']['alamatKTPtertanggung'] : @$r['data_diri_tertanggung']['alamatSurattertanggung'], $this->border, 'J');
		$this->Cell(50, $this->height, 'Provinsi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['isAlamatKTPtertanggungSama'] ? @$provinsi[@$r['data_diri_tertanggung']['provinsiKTPtertanggung']] : @$provinsi[@$r['data_diri_tertanggung']['provinsiSurattertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kabupaten/Kota', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['isAlamatKTPtertanggungSama'] ? @$kota[@$r['data_diri_tertanggung']['kabupatenKTPtertanggung']] : @$kota[@$r['data_diri_tertanggung']['kabupatenSurattertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kodepos', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['isAlamatKTPtertanggungSama'] ? @$r['data_diri_tertanggung']['kodeposKTPtertanggung'] : @$r['data_diri_tertanggung']['kodeposSurattertanggung'], $this->border, 1, 'L');
		
		// Kontak dan Telepon Tertanggung Utama
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Kontak dan Telepon', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nomor HP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['nomorHptertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor Telepon', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['nomorTelptertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Email', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['emailtertanggung'], $this->border, 1, 'L');
		
		// Setuju 
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Persetujuan Agar Dapat Dihubungi', $this->border, 1, 'L', true);
		$this->Cell($this->PG_W, $this->height, (@$r['data_diri_tertanggung']['isSetujuHPtertanggung'] ? 'Saya ' : 'Saya Tidak ').'Setuju Ditelepon Melalui HP/Telepon.', $this->border, 1, 'L');
		$this->Cell($this->PG_W, $this->height, (@$r['data_diri_tertanggung']['isSetujuEmailtertanggung'] ? 'Saya ' : 'Saya Tidak ').'Setuju Dihubungi Melalui Email.', $this->border, 1, 'L');
		
		// Data Pendukung Tertanggung Utama
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Data Pendukung Tertanggung', $this->border, 1, 'L', true);
		$this->MultiCell($this->PG_W, $this->height, 'Hubungan Dengan Pemegang Polis : '.@$hubungans[@$r['data_diri_tertanggung']['hubdgnPempol']], $this->border, 'J');
		$this->Cell(50, $this->height, 'Usia Produktif', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['usiaProduktifTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tinggi Badan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['tinggiBadanTertanggung'].'cm', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Berat Badan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['beratBadanTertanggung'].'kg', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Ibu Kandung', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['ibuKandungTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendidikan Terakhir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['pendidikanTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Status Pernikahan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$statusnikah[@$r['data_diri_tertanggung']['statusPernikahanTertanggung']], $this->border, 1, 'L');
		
		/**
			jika jenis asuransi != premier annuity, tertanggung tambahannya di hide
		**/
		if(!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)) {
			// Data Tertanggung Tambahan
			$this->ln(2);
			$this->Cell($this->PG_W, $this->height+2, 'Tertanggung Tambahan', $this->border, 1, 'L', true);
			$this->Cell(50, $this->height, 'Jumlah Tertanggung Tambahan', $this->border, 0, 'L');
			$this->Cell(2, $this->height, ':', $this->border, 0, 'C'); //namaTertanggungTambahan1
			$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['jmlTertanggungTambahan'], $this->border, 1, 'L');
			
			if (@$r['data_diri_tertanggung']['jmlTertanggungTambahan'] > 0) {
				for ($i = 1; $i <= @$r['data_diri_tertanggung']['jmlTertanggungTambahan']; $i++) {
					$this->ln(2);
					$this->Cell($this->PG_W, $this->height+2, "Tertanggung Tambahan $i", $this->border, 1, 'L', true);
					$this->Cell(50, $this->height, 'Hubungan Dengan Tertanggung', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$hubunganttg[@$r['data_diri_tertanggung']['hubunganTT'.$i.'DenganTTU']], $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$genders[@$r['data_diri_tertanggung']['jenisKelaminTertanggungTambahan'.$i]], $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['namaTertanggungTambahan'.$i], $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'No KTP', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['noKtpTertanggungTambahan'.$i], $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, date('d-m-Y', strtotime(@$r['data_diri_tertanggung']['tglLahirTertanggungTambahan'.$i])), $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Tempat Lahir', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['tempatLahirTertanggungTambahan'.$i], $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Tinggi Badan', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['tinggiBadanTertanggungTambahan'.$i].'cm', $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Berat Badan', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['beratBadanTertanggungTambahan'.$i].'kg', $this->border, 1, 'L');
					$this->Cell(50, $this->height, 'Tertanggung Bekerja', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_tertanggung']['isTertanggungTambahan'.$i.'Bekerja'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
				}
			}

		}
		/**
			end
		**/
		
		$pekerjaanTertanggung = '';
		foreach (@$r['pekerjaan'] as $i => $v) {
			if(@$r['data_pekerjaan_tertanggung']['pekerjaanTertanggung']  == $v['KDPEKERJAAN']){
				$pekerjaanTertanggung = $v['NAMAPEKERJAAN'];
			}
		}
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pekerjaan Tertanggung', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Pekerjaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $pekerjaanTertanggung, $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pangkat/Golongan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$pangkat[@$r['data_pekerjaan_tertanggung']['pangkatTertanggung']], $this->border, 1, 'L');

		$hobiTertanggung = '';
		foreach (@$r['hobi'] as $i => $v) {
			if(@$r['data_skk']['hobbyTTU']  == $v['KDHOBI']){
				$hobiTertanggung = $v['NAMAHOBI'];
			}
		}

		// Pekerjaan Tertanggung
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Hobi Tertanggung', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Hobi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $hobiTertanggung, $this->border, 1, 'L');
		
		// Pendapatan Tertanggung
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pendapatan Setahun', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Gaji', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Range Gaji **/
		if(@$r['data_pekerjaan_tertanggung']['rangeGajiTertanggungJmlLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangeGajiTertanggungJmlLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['rangeGajiTertanggungJmlLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangeGajiTertanggungJmlLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Penghasilan Suami/Istri', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		if(@$r['data_pekerjaan_tertanggung']['rangePendapatanPasanganLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangePendapatanPasanganLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['rangePendapatanPasanganLainnya'] = 0;
		}
		$this->Cell(70, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangePendapatanPasanganLainnya']*1, 0, ',', '.'), $this->border, 0, 'L');

		$this->Cell(50, $this->height, 'Usia Produktif Suami/Istri', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Usia **/
		if(@$r['data_pekerjaan_tertanggung']['usiaProduktifPasangan'] == '' || @$r['data_pekerjaan_tertanggung']['usiaProduktifPasangan'] == null){
			@$r['data_pekerjaan_tertanggung']['usiaProduktifPasangan'] = '-';
		}

		$this->Cell(50, $this->height, @$r['data_pekerjaan_tertanggung']['usiaProduktifPasangan'] . ' Tahun', $this->border, 1,'L');


		/** Pendapatan Investasi **/
		$this->Cell(50, $this->height, 'Pendapatan Hasil Investasi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Test **/
		if(@$r['data_pekerjaan_tertanggung']['rangeHasilInvestasiLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangeHasilInvestasiLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['rangeHasilInvestasiLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangeHasilInvestasiLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendapatan Hasil Bisnis', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Test **/
		if(@$r['data_pekerjaan_tertanggung']['rangeBisnisLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangeBisnisLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['rangeBisnisLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangeBisnisLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Bonus/Investasi/Komisi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Test **/
		if(@$r['data_pekerjaan_tertanggung']['rangeBonusLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangeBonusLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['rangeBonusLainnya'] = 0;
		}


		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangeBonusLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');

		$this->Cell(50, $this->height, 'Pendapatan Orang Tua', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		if(@$r['data_pekerjaan_tertanggung']['rangePendapatanOrangTuaLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangePendapatanOrangTuaLainnya'] == '' ){
			@$r['data_pekerjaan_tertanggung']['rangePendapatanOrangTuaLainnya'] = 0;
		}


		$this->Cell(70, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangePendapatanOrangTuaLainnya']*1, 0, ',', '.'), $this->border, 0, 'L');

		$this->Cell(50, $this->height, 'Usia Produktif Orang Tua', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Usia **/
		if(@$r['data_pekerjaan_tertanggung']['usiaProduktifOrangTua'] == '' || @$r['data_pekerjaan_tertanggung']['usiaProduktifOrangTua'] == null){
			@$r['data_pekerjaan_tertanggung']['usiaProduktifOrangTua'] = '-';
		}

		$this->Cell(0, $this->height, @$r['data_pekerjaan_tertanggung']['usiaProduktifOrangTua'] . ' Tahun', $this->border, 1, 'L');

		$this->Cell(50, $this->height, 'Pendapatan Lain', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Test **/
		if(@$r['data_pekerjaan_tertanggung']['rangePendapatanTertanggungLainnya'] == null || @$r['data_pekerjaan_tertanggung']['rangePendapatanTertanggungLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['rangePendapatanTertanggungLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_tertanggung']['rangePendapatanTertanggungLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Sumber Pendapatan Lain', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Test **/
		if(@$r['data_pekerjaan_tertanggung']['sumberPendapatanLainnya'] == null || @$r['data_pekerjaan_tertanggung']['sumberPendapatanLainnya'] == ''){
			@$r['data_pekerjaan_tertanggung']['sumberPendapatanLainnya'] = '-';
		}

		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['sumberPendapatanLainnya'], $this->border, 1, 'L');
		
		// Wiraswasta
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Jika Usaha Sendiri (Wiraswasta)', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Kepemilikan Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['pemilikWirausahaTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Bidang Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['bidangWirausahaTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['namaWirausahaTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['alamatWirausahaTertanggung'], $this->border, 1, 'L');
		
		// Perusahaan Bekerja
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Perusahaan Tempat Bekerja', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Jenis Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$perusahaan[@$r['data_pekerjaan_tertanggung']['jenisPerusahaanTertanggung']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['namaPerusahaanTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['alamatPerusahaanTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kodepos Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['kodeposPerusahaanTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Telepon Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['nomorTeleponPerusahaanTertanggung'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Ekstension', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_tertanggung']['nomorEkstensiPerusahaanTertanggung'], $this->border, 1, 'L');
		
		// Tujuan Berasuransi
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Tujuan Berasuransi', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Proteksi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['isTujuanProteksi'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tabungan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['isTujuanTabungan'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendidikan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['isTujuanPendidikan'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Investasi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['isTujuanInvestasi'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pensiun', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['isTujuanPensiun'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Lainnya', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['isTujuanLainnya'] ? 'Ya' : 'Tidak', $this->border, 1, 'L');
		

		// Pilihan Produk
		/**
			Tambahan kondisi 10012023
			
		**/
		if(!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)) {
			@$r['data_produk']['masaBayarPremi'] = @$r['data_produk']['masaBayarPremi'];
		}else{
			@$r['data_produk']['masaBayarPremi'] = 1;
		}

		$masaAsuransi = '';

		if(@$r['data_produk']['jenisAsuransi'] == 'APPSH'){
			$masaAsuransi = 'Seumur Hidup';
		}else{
			$masaAsuransi = @$r['data_produk']['jangkaWaktuAsuransi']. ' Tahun';
		}
		/**
			End tambahan kondisi
		**/

		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pilihan Produk', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Jenis Asuransi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['namaProduk'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Cara Bayar', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['namaCaraBayar'], $this->border, 1, 'L');

		if(!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)) {
			$this->Cell(50, $this->height, 'Masa Pembayaran Premi', $this->border, 0, 'L');
			$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['masaBayarPremi'].' Tahun', $this->border, 1, 'L');
		}


		$this->Cell(50, $this->height, 'Masa Asuransi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $masaAsuransi, $this->border, 1, 'L');
		
		/**
			jika jenis asuransi tidak termasuk dalam Premier Annuity, maka munculkan rider
		**/
		if(!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)) {
			// Alokasi Dana
			if (@$r['data_produk']['nama_alokasi1']) {
				$this->Cell(50, $this->height, 'Alokasi Dana Unitlink', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['nama_alokasi1'].' ('.@$r['data_produk']['alokasi1'].'%)'.(@$r['data_produk']['nama_alokasi2'] ? ' & '.@$r['data_produk']['nama_alokasi2'].' ('.@$r['data_produk']['alokasi2'].'%)' : ''), $this->border, 1, 'L');
			}
		
			// Rider
			if (@$r['data_produk']['isTermRider'] || @$r['data_produk']['isADB'] || @$r['data_produk']['isADDB'] || @$r['data_produk']['isTPD'] || @$r['data_produk']['isCI53'] || @$r['data_produk']['hospitalCP'] || @$r['data_produk']['isPBD'] || @$r['data_produk']['isPBC151'] || @$r['data_produk']['isPBTPD'] || @$r['data_produk']['isSPD'] || @$r['data_produk']['SPBCI'] || @$r['data_produk']['isSPTBD'] || @$r['data_produk']['isWPCI51'] || @$r['data_produk']['isWPTPD']) {
				$this->Cell(50, $this->height, 'Rider', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$x = $this->GetX();
				
				if (@$r['data_produk']['isTermRider']) {
					$this->Cell($this->PG_W-52, $this->height, 'UA Term Life (TL) '.number_format(@$r['data_produk']['termRiderUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isADB']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Accidental Death Benefit (ADB) '.number_format(@$r['data_produk']['adbUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isADDB']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Accidental Death & Dismemberment Benefit (ADDB) '.number_format(@$r['data_produk']['addbUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isTPD']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Total Permanent Disability (TPD) '.number_format(@$r['data_produk']['tpdUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isCI53']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Critical Illness 53 (CI53) '.number_format(@$r['data_produk']['CI53UA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['hospitalCP']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'Hospital Cash Plan '.@$r['data_produk']['hcpTypeSelect'], $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isPBD']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Payor Benefit Death (PBD) '.number_format(@$r['data_produk']['PBD']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isPBC151']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Payor Benefit Critical Illness 51 (PBCI51) '.number_format(@$r['data_produk']['PBC151']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isPBTPD']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Payor Benefit Total Permanent Disability (PBTPD) '.number_format(@$r['data_produk']['pbtpdUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isSPD']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Spouse Payor Death Benefit (SPD) '.number_format(@$r['data_produk']['SPOUSE_TPDUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['SPBCI']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Spouse Payor Critical Illness51 (SPCI51) '.number_format(@$r['data_produk']['SPOUSE_CIUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isSPTBD']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Spouse Payor Total Permanent Disability (SPTPD) '.number_format(@$r['data_produk']['SPOUSE_DEATHUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isWPCI51']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Waiver Critical Illness51 (WPCI51) '.number_format(@$r['data_produk']['WPCI51UA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
				if (@$r['data_produk']['isWPTPD']) {
					$this->SetX($x);
					$this->Cell($this->PG_W-52, $this->height, 'UA Waiver Total Permanent Disability (WPTPD) '.number_format(@$r['data_produk']['WPTPDUA']*1, 0, ',', '.'), $this->border, 1, 'L');
				}
			}

		}
		/**
			end kondisi
		**/
		$this->Cell(50, $this->height, 'Premi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_produk']['premi']*1, 0, ',', '.'), $this->border, 1, 'L');


		/**
			Jika jenis asuransi != $premierAnnuity, maka munculkan premi berkala, topup berkala, top up sekaligus.
		**/
		if(!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)) {

			$this->Cell(50, $this->height, 'Premi Berkala', $this->border, 0, 'L');
			$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_produk']['premiBerkala']*1, 0, ',', '.'), $this->border, 1, 'L');
			$this->Cell(50, $this->height, 'Top Up Berkala', $this->border, 0, 'L');
			$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_produk']['topupBerkala']*1, 0, ',', '.'), $this->border, 1, 'L');
			$this->Cell(50, $this->height, 'Top Up Sekaligus', $this->border, 0, 'L');
			$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_produk']['topupSekaligus']*1, 0, ',', '.'), $this->border, 1, 'L');
		}

		/**
			end kondisi
		**/

		/** tambahan 17012023 **/
		$uAsuransi = '';
		if(in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)){
			$uAsuransi = 'Anuitas Sebulan';
		}else{
			$uAsuransi = 'Uang Asuransi';
		}

		$this->Cell(50, $this->height, $uAsuransi, $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_produk']['uangAsuransi']*1, 0, ',', '.'), $this->border, 1, 'L');
		
		// Pembayar Premi
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pembayar Premi', $this->border, 1, 'L', true);
		$this->MultiCell($this->PG_W, $this->height, 'Hubungan Dengan Tertanggung Utama : '.(@$r['data_produk']['pempolIsPembayarPremi'] ? @$hubungans[@$r['data_diri_pemegang_polis']['hubdgnTertanggung']] : @$hubunganttg[@$r['data_produk']['hubunganPembayarPremiDenganTTU']]), $this->border, 'J');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$genders[@$r['data_diri_pemegang_polis']['jenkelPempol']] : @$genders[@$r['data_produk']['jenisKelaminPembayarPremi']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['namaLengkapPempol'] : @$r['data_produk']['namaPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Alias', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['namaAliasPempol'] : @$r['data_produk']['aliasPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'No KTP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['nomorKTPPempol'] : @$r['data_produk']['noKtpPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat KTP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['alamatKTPPempol'] : @$r['data_produk']['alamatKTPtertanggung'], $this->border, 'J');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? date('d-m-Y', strtotime(@$r['data_diri_pemegang_polis']['tglLahirPempol'])) : date('d-m-Y', strtotime(@$r['data_produk']['tglLahirPembayarPremi'])), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tempat Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['tempatLahirPempol'] : @$r['data_produk']['tempatLahirPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor NPWP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['nomorNPWPPempol'] : @$r['data_produk']['noNpwpPembayarPremi'], $this->border, 1, 'L');
		
		// Pekerjaan Pembayar Premi
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pekerjaan Pembayar Premi', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nama Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_pekerjaan_pempol']['namaPerusahaanPempol'] : @$r['data_produk']['namaKantorPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_pekerjaan_pempol']['alamatPerusahaanPempol'] : @$r['data_produk']['alamatKantorPembayarPremi'], $this->border, 1, 'L');
		
		// Kontak Pembayar Premi
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Kontak dan Telepon', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nomor HP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');



		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['nomorHpPempol'] : @$r['data_produk']['nomorHpPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor Telepon', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** No. Telepon **/
		if(@$r['data_produk']['nomorTelpPembayarPremi'] == '' || @$r['data_produk']['nomorTelpPembayarPremi'] == null){
			@$r['data_produk']['nomorTelpPembayarPremi'] = '-';
		}

		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['nomorTelpPempol'] : @$r['data_produk']['nomorTelpPembayarPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Email', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['pempolIsPembayarPremi'] ? @$r['data_diri_pemegang_polis']['emailPempol'] : @$r['data_produk']['emailPembayarPremi'], $this->border, 1, 'L');
				
		// Rekening Pembayar Premi
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Rekening Pembayar Premi', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nama Bank', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['namaBankPembPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Cabang Bank', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['cabangBankPembPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor Rekening', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['nomorRekeningPembPremi'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Atas Nama', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_produk']['namaRekeningPembPremi'], $this->border, 1, 'L');
		
		// Cara Pembayaran Premi
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pembayaran Premi', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Mekanisme Pembayaran', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$bayarberikutnyas[@$r['data_produk']['bayarPremiSelanjutnya']].' '.@$r['data_produk']['paymentBankName'], $this->border, 1, 'L');
		
		// Data Penerima Manfaat
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Penerima Manfaat', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Jumlah Penerima Manfaat', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, count(@$r['data_penerima_manfaat']), $this->border, 1, 'L');
				
		if (@$r['data_penerima_manfaat']) {
			foreach (@$r['data_penerima_manfaat'] as $i => $v) {
				$this->ln(2);	
				$this->Cell($this->PG_W, $this->height+2, 'Penerima Manfaat '.($i+1), $this->border, 1, 'L', true);
				$this->Cell(50, $this->height, 'Hubungan Dengan Tertanggung', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$hubunganttg[@$v['penerimaManfaatHubungan']], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$v['namaPenerimaManfaat'], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'No KTP', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

				$this->Cell($this->PG_W-52, $this->height, @$v['noKtpPenerimaManfaat'], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, date('d-m-Y', strtotime(@$v['tglLahirPenerimaManfaat'])), $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Tempat Lahir', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$v['tempatLahirPenerima'], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$genders[@$v['jenkelPenerimaManfaat']], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Status Pernikahan', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$statusnikah[@$v['statusPenerimaManfaat']], $this->border, 1, 'L');
			}
		}
		
		// // Rekening Penerima Manfaat
		// $this->ln(2);
		// $this->Cell($this->PG_W, $this->height+2, 'Rekening Penerima Manfaat', $this->border, 1, 'L', true);
		// $this->Cell(50, $this->height, 'Nama Bank', $this->border, 0, 'L');
		// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		// $this->Cell($this->PG_W-52, $this->height, @$r['data_manfaat']['namaBankPenerimaManfaat'], $this->border, 1, 'L');
		// $this->Cell(50, $this->height, 'Cabang Bank', $this->border, 0, 'L');
		// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		// $this->Cell($this->PG_W-52, $this->height, @$r['data_manfaat']['cabangBankPenerimaManfaat'], $this->border, 1, 'L');
		// $this->Cell(50, $this->height, 'Nomor Rekening', $this->border, 0, 'L');
		// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		// $this->Cell($this->PG_W-52, $this->height, @$r['data_manfaat']['nomorRekeningPenerimaManfaat'], $this->border, 1, 'L');
		// $this->Cell(50, $this->height, 'Atas Nama', $this->border, 0, 'L');
		// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		// $this->Cell($this->PG_W-52, $this->height, @$r['data_manfaat']['namaRekeningPenerimaManfaat'], $this->border, 1, 'L');
		
		// SKK Tertanggung Utama
		if (!in_array(@$r['data_produk']['jenisAsuransi'], array('PAA', 'PAB')) && (!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity))) {
			$this->ln(2);
			$this->Cell($this->PG_W, $this->height+2, 'SKK Tertanggung Utama', $this->border, 1, 'L', true);
			// $this->Cell(50, $this->height, 'Ayah Kandung', $this->border, 0, 'L');
			// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			// $this->MultiCell($this->PG_W-52, $this->height, 
			// 	@$r['data_skk']['umurAyahTTU']." Tahun, ".
			// 	(@$r['data_skk']['isAyahHidup_TTU'] ? 
			// 		"Masih Hidup \n".(@$r['data_skk']['isAyahHidupSehat_TTU'] ? 'Sehat' : 'Tidak Sehat') : 
			// 		'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalAyah_TTU'] ? ' Karena '.@$r['data_skk']['sebabMeninggalAyah_TTU'] : '').
			// 			(@$r['data_skk']['lamaSakitAyah_TTU'] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitAyah_TTU'] : '' ).
			// 			(@$r['data_skk']['tglMeninggalAyah_TTU'] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalAyah_TTU'])) : '' )
			// 	).
			// 	(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @!$r['data_skk']['isAyahDiabet_TTU'] ? ', Diabetes' : '').
			// 	(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @!$r['data_skk']['isAyahHipertensi_TTU'] ? ', Hipertensi' : '').
			// 	(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @!$r['data_skk']['isAyahJantung_TTU'] ? ', Jantung/Stroke' : '').
			// 	(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @!$r['data_skk']['isAyahTumor_TTU'] ? ', Tumor/Kanker' : '').
			// 	(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @!$r['data_skk']['isAyahPenyakitKeturunan_TTU'] ? ', Penyakit Keturunan' : '')
				
			// , $this->border, 'J');
			// $this->Cell(50, $this->height, 'Ibu Kandung', $this->border, 0, 'L');
			// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			// $this->MultiCell($this->PG_W-52, $this->height, 
			// 	@$r['data_skk']['umurIbuTTU']." Tahun, ".
			// 	(@$r['data_skk']['isIbuHidup_TTU'] ? 
			// 		"Masih Hidup \n".(@$r['data_skk']['isIbuHidupSehat_TTU'] ? 'Sehat' : 'Tidak Sehat') : 
			// 		'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalIbu_TTU'] ? ' Karena '.@$r['data_skk']['sebabMeninggalIbu_TTU'] : '').
			// 			(@$r['data_skk']['lamaSakitIbu_TTU'] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitIbu_TTU'] : '' ).
			// 			(@$r['data_skk']['tglMeninggalIbu_TTU'] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalIbu_TTU'])) : '' )
			// 	).
			// 	(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuDiabet_TTU'] ? ', Diabetes' : '').
			// 	(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuHipertensi_TTU'] ? ', Hipertensi' : '').
			// 	(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuJantung_TTU'] ? ', Jantung/Stroke' : '').
			// 	(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuTumor_TTU'] ? ', Tumor/Kanker' : '').
			// 	(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuPenyakitKeturunan_TTU'] ? ', Penyakit Keturunan' : '')
				
			// , $this->border, 'J');
			// if (@$r['data_skk']['isAdaPasangan_TTU']) {
			// 	$this->Cell(50, $this->height, 'Pasangan', $this->border, 0, 'L');
			// 	$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			// 	$this->MultiCell($this->PG_W-52, $this->height, 
			// 		@$r['data_skk']['umurPasanganTTU']." Tahun, ".
			// 		(@$r['data_skk']['isPasanganHidup_TTU'] ? 
			// 			"Masih Hidup \n".(@$r['data_skk']['isPasanganHidupSehat_TTU'] ? 'Sehat' : 'Tidak Sehat') : 
			// 			'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalPasangan_TTU'] ? ' Karena '.@$r['data_skk']['sebabMeninggalPasangan_TTU'] : '').
			// 				(@$r['data_skk']['lamaSakitPasangan_TTU'] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitPasangan_TTU'] : '' ).
			// 				(@$r['data_skk']['tglMenikahTTU'] ? ', Tanggal Menikah '.date('d-m-Y', strtotime(@$r['data_skk']['tglMenikahTTU'])) : '' )
			// 		).
			// 		(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganDiabet_TTU'] ? ', Diabetes' : '').
			// 		(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganHipertensi_TTU'] ? ', Hipertensi' : '').
			// 		(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganJantung_TTU'] ? ', Jantung/Stroke' : '').
			// 		(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganTumor_TTU'] ? ', Tumor/Kanker' : '').
			// 		(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganPenyakitKeturunan_TTU'] ? ', Penyakit Keturunan' : '')
					
			// 	, $this->border, 'J');
			// }
			// if (@$r['data_skk']['jumlahAnakTTU']) {
			// 	for ($i=0; $i< @$r['data_skk']['jumlahAnakTTU']; $i++) {
			// 		$this->Cell(50, $this->height, "Anak ".($i+1), $this->border, 0, 'L');
			// 		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			// 		$this->MultiCell($this->PG_W-52, 
			// 			$this->height, "Usia ".@$r['data_skk']['umurAnakTTU'][$i]." Tahun".
			// 			(@$r['data_skk']['isHidupAnakTTU'][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
			// 			(@$r['data_skk']['isHidupAnakTTU'][$i] && @$r['data_skk']['isSehatAnakTTU'][$i] ? "Sehat" : '').
			// 			(@$r['data_skk']['isHidupAnakTTU'][$i] && !@$r['data_skk']['isSehatAnakTTU'][$i] ? "Tidak Sehat" : '')
			// 		, $this->border, 'J');
			// 	}
			// }
			// if (@$r['data_skk']['jumlahSaudaraKandungLakiTTU']) {
			// 	for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungLakiTTU']; $i++) {
			// 		$this->Cell(50, $this->height, "Saudara Laki-laki ".($i+1), $this->border, 0, 'L');
			// 		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			// 		$this->MultiCell($this->PG_W-52, 
			// 			$this->height, "Usia ".@$r['data_skk']['umurSaudaraLkTTU'][$i]." Tahun".
			// 			(@$r['data_skk']['isHidupSaudaraLkTTU'][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
			// 			(@$r['data_skk']['isHidupSaudaraLkTTU'][$i] && @$r['data_skk']['isSehatSaudaraLkTTU'][$i] ? "Sehat" : '').
			// 			(@$r['data_skk']['isHidupSaudaraLkTTU'][$i] && !@$r['data_skk']['isSehatSaudaraLkTTU'][$i] ? "Tidak Sehat" : '')
			// 		, $this->border, 'J');
			// 	}
			// }
			// if (@$r['data_skk']['jumlahSaudaraKandungPerempuanTTU']) {
			// 	for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungPerempuanTTU']; $i++) {
			// 		$this->Cell(50, $this->height, "Saudara Perempuan ".($i+1), $this->border, 0, 'L');
			// 		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
			// 		$this->MultiCell($this->PG_W-52, 
			// 			$this->height, "Usia ".@$r['data_skk']['umurSaudaraPrTTU'][$i]." Tahun".
			// 			(@$r['data_skk']['isHidupSaudaraPrTTU'][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
			// 			(@$r['data_skk']['isHidupSaudaraPrTTU'][$i] && @$r['data_skk']['isSehatSaudaraPrTTU'][$i] ? "Sehat" : '').
			// 			(@$r['data_skk']['isHidupSaudaraPrTTU'][$i] && !@$r['data_skk']['isSehatSaudaraPrTTU'][$i] ? "Tidak Sehat" : '')
			// 		, $this->border, 'J');
			// 	}
			// }
			//var_dump(@$r['data_skk']);die;
			/** Surat Keterangan Sehat **/
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah ayah/ibu (Hidup/ Meninggal) pernah menderita dan/atau sedang menderita dan/atau meninggal dunia karena salah satu atau beberapa penyakit sebagi berikut: penyakit jantung, stroke, tekanan darah tinggi, TBC, diabetes,penyakit ginjal, hepatitis, tumor / kanker, kelainan psikologis, penyakit keturunan dan menular lainnya? '.(@$r['data_skk']['isPenyakitanOrtuTTU'] ? 'Ya' : 'Tidak'), $this->border, 'J');
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(50, $this->height, 'Ayah Kandung', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->MultiCell($this->PG_W-52, $this->height, 
					@$r['data_skk']['umurAyahTTU']." Tahun, ".
					(@$r['data_skk']['isAyahHidup_TTU'] ? 
						"Masih Hidup \n".(@$r['data_skk']['isAyahHidupSehat_TTU'] ? 'Sehat' : 'Tidak Sehat') : 
						'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalAyah_TTU'] ? ' Karena '.@$r['data_skk']['sebabMeninggalAyah_TTU'] : '').
							(@$r['data_skk']['lamaSakitAyah_TTU'] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitAyah_TTU'] : '' ).
							(@$r['data_skk']['tglMeninggalAyah_TTU'] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalAyah_TTU'])) : '' )
					).
					(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @$r['data_skk']['isAyahDiabet_TTU'] ? ', Diabetes' : '').
					(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @$r['data_skk']['isAyahHipertensi_TTU'] ? ', Hipertensi' : '').
					(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @$r['data_skk']['isAyahJantung_TTU'] ? ', Jantung/Stroke' : '').
					(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @$r['data_skk']['isAyahTumor_TTU'] ? ', Tumor/Kanker' : '').
					(@$r['data_skk']['isAyahHidup_TTU'] && !@$r['data_skk']['isAyahHidupSehat_TTU'] && @$r['data_skk']['isAyahPenyakitKeturunan_TTU'] ? ', Penyakit Keturunan' : '')
					
				, $this->border, 'J');

				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(50, $this->height, 'Ibu Kandung', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->MultiCell($this->PG_W-52, $this->height, 
					@$r['data_skk']['umurIbuTTU']." Tahun, ".
					(@$r['data_skk']['isIbuHidup_TTU'] ? 
						"Masih Hidup \n".(@$r['data_skk']['isIbuHidupSehat_TTU'] ? 'Sehat' : 'Tidak Sehat') : 
						'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalIbu_TTU'] ? ' Karena '.@$r['data_skk']['sebabMeninggalIbu_TTU'] : '').
							(@$r['data_skk']['lamaSakitIbu_TTU'] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitIbu_TTU'] : '' ).
							(@$r['data_skk']['tglMeninggalIbu_TTU'] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalIbu_TTU'])) : '' )
					).
					(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuDiabet_TTU'] ? ', Diabetes' : '').
					(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuHipertensi_TTU'] ? ', Hipertensi' : '').
					(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuJantung_TTU'] ? ', Jantung/Stroke' : '').
					(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuTumor_TTU'] ? ', Tumor/Kanker' : '').
					(@$r['data_skk']['isIbuHidup_TTU'] && !@$r['data_skk']['isIbuHidupSehat_TTU'] && @!$r['data_skk']['isIbuPenyakitKeturunan_TTU'] ? ', Penyakit Keturunan' : '')
					
				, $this->border, 'J');

			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah ada anggota keluarga (suami/istri,anak,kakak/adik) yang pernah menderita dan/atau sedang menderita dan/atau meninggal dunia karena salah satu atau beberapa penyakit sebagi berikut : penyakit jantung, stroke, tekanan darah tinggi, TBC, diabetes, penyakit ginjal, hepatitis, tumor / kanker, kelainan psikologis, penyakit keturunan dan menular lainnya? '.(@$r['data_skk']['isPenyakitanKeluargaTTU'] ? 'Ya' : 'Tidak'), $this->border, 'J');

			if (@$r['data_skk']['isPenyakitanKeluargaTTU']){

				if (@$r['data_skk']['isAdaPasangan_TTU']) {
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(50, $this->height, 'Pasangan', $this->border, 0, 'L');
					$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					$this->MultiCell($this->PG_W-52, $this->height, 
						@$r['data_skk']['umurPasanganTTU']." Tahun, ".
						(@$r['data_skk']['isPasanganHidup_TTU'] ? 
							"Masih Hidup \n".(@$r['data_skk']['isPasanganHidupSehat_TTU'] ? 'Sehat' : 'Tidak Sehat') : 
							'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalPasangan_TTU'] ? ' Karena '.@$r['data_skk']['sebabMeninggalPasangan_TTU'] : '').
								(@$r['data_skk']['lamaSakitPasangan_TTU'] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitPasangan_TTU'] : '' ).
								(@$r['data_skk']['tglMenikahTTU'] ? ', Tanggal Menikah '.date('d-m-Y', strtotime(@$r['data_skk']['tglMenikahTTU'])) : '' )
						).
						(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganDiabet_TTU'] ? ', Diabetes' : '').
						(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganHipertensi_TTU'] ? ', Hipertensi' : '').
						(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganJantung_TTU'] ? ', Jantung/Stroke' : '').
						(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganTumor_TTU'] ? ', Tumor/Kanker' : '').
						(@$r['data_skk']['isPasanganHidup_TTU'] && !@$r['data_skk']['isPasanganHidupSehat_TTU'] && @!$r['data_skk']['isPasanganPenyakitKeturunan_TTU'] ? ', Penyakit Keturunan' : '')
						
					, $this->border, 'J');
				}

				if (@$r['data_skk']['jumlahAnakTTU']) {
					for ($i=0; $i< @$r['data_skk']['jumlahAnakTTU']; $i++) {
						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(50, $this->height, "Anak ".($i+1), $this->border, 0, 'L');
						$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
						$this->MultiCell($this->PG_W-52, 
							$this->height, "Usia ".@$r['data_skk']['umurAnakTTU'][$i]." Tahun".
							(@$r['data_skk']['isHidupAnakTTU'][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
							(@$r['data_skk']['isHidupAnakTTU'][$i] && @$r['data_skk']['isSehatAnakTTU'][$i] ? "Sehat" : '').
							(@$r['data_skk']['isHidupAnakTTU'][$i] && !@$r['data_skk']['isSehatAnakTTU'][$i] ? "Tidak Sehat" : '')
						, $this->border, 'J');
					}
				}
				if (@$r['data_skk']['jumlahSaudaraKandungLakiTTU']) {
					for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungLakiTTU']; $i++) {
						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(50, $this->height, "Saudara Laki-laki ".($i+1), $this->border, 0, 'L');
						$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
						$this->MultiCell($this->PG_W-52, 
							$this->height, "Usia ".@$r['data_skk']['umurSaudaraLkTTU'][$i]." Tahun".
							(@$r['data_skk']['isHidupSaudaraLkTTU'][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
							(@$r['data_skk']['isHidupSaudaraLkTTU'][$i] && @$r['data_skk']['isSehatSaudaraLkTTU'][$i] ? "Sehat" : '').
							(@$r['data_skk']['isHidupSaudaraLkTTU'][$i] && !@$r['data_skk']['isSehatSaudaraLkTTU'][$i] ? "Tidak Sehat" : '')
						, $this->border, 'J');
					}
				}
				if (@$r['data_skk']['jumlahSaudaraKandungPerempuanTTU']) {
					for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungPerempuanTTU']; $i++) {
						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(50, $this->height, "Saudara Perempuan ".($i+1), $this->border, 0, 'L');
						$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
						$this->MultiCell($this->PG_W-52, 
							$this->height, "Usia ".@$r['data_skk']['umurSaudaraPrTTU'][$i]." Tahun".
							(@$r['data_skk']['isHidupSaudaraPrTTU'][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
							(@$r['data_skk']['isHidupSaudaraPrTTU'][$i] && @$r['data_skk']['isSehatSaudaraPrTTU'][$i] ? "Sehat" : '').
							(@$r['data_skk']['isHidupSaudaraPrTTU'][$i] && !@$r['data_skk']['isSehatSaudaraPrTTU'][$i] ? "Tidak Sehat" : '')
						, $this->border, 'J');
					}
				}

			}

			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah merasa sehat? '.(@$r['data_skk']['isSehatTTU'] ? 'Ya' : 'Tidak'.(@$r['data_skk']['alasanSakitTTU'] ? ', '.@$r['data_skk']['alasanSakitTTU']: '')), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda dapat melakukan pekerjaan dengan baik? '.(@$r['data_skk']['isSehatTTU'] ? 'Ya' : 'Tidak'.(@$r['data_skk']['alasanPekerjaanBaikTTU'] ? ', '.@$r['data_skk']['alasanPekerjaanBaikTTU']: '')), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, "Apakah Anda pernah mengalami gejala-gejala, diperiksa, menderita, mendapat pengobatan oleh dokter dan disarankan untuk rawat inap, rawat jalan di Fasilitas Kesehatan/Rumah Sakit?", $this->border, 'J');
			$textPenyakit01 = '';
			if (@$r['data_skk']['isPenyakitT01_TTU']) {
				$textPenyakit01 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT01_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT01_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT01_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT01_TTU'] ? 'Ya' : 'Tidak').", Hepatitis A/B/C/D/E, Hati (selain Hepatitis) dan Kandung Empedu. ".$textPenyakit01, $this->border, 'J');
			$textPenyakit02 = '';
			if (@$r['data_skk']['isPenyakitT02_TTU']) {
				$textPenyakit02 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT02_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT02_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT02_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT02_TTU'] ? 'Ya' : 'Tidak').", Usus, Pankreas, Wasir dan Organ Pencernaan lain. ".$textPenyakit02, $this->border, 'J');
			
			$textPenyakit03 = '';
			if (@$r['data_skk']['isPenyakitT03_TTU']) {
				$textPenyakit03 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT03_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT03_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT03_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT03_TTU'] ? 'Ya' : 'Tidak').", Ginjal, Batu Ginjal, Saluran Kemih dan Prostat. ".$textPenyakit03, $this->border, 'J');
			
			$textPenyakit04 = '';
			if (@$r['data_skk']['isPenyakitT04_TTU']) {
				$textPenyakit04 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT04_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT04_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT04_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT04_TTU'] ? 'Ya' : 'Tidak').", Nyeri Dada, Jantung, Jantung Bawaan, Demam Rheuma, Pembuluh Darah dan Stroke. ".$textPenyakit04, $this->border, 'J');
			
			$textPenyakit05 = '';
			if (@$r['data_skk']['isPenyakitT05_TTU']) {
				$textPenyakit05 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT05_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT05_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT05_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT05_TTU'] ? 'Ya' : 'Tidak').", Payudara, Kandungan dan Indung Telur. ".$textPenyakit05, $this->border, 'J');
			
			$textPenyakit06 = '';
			if (@$r['data_skk']['isPenyakitT06_TTU']) {
				$textPenyakit06 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT06_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT06_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT06_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT06_TTU'] ? 'Ya' : 'Tidak').", Alergi, Penyakit Kulit, penyakit kelamin. ".$textPenyakit06, $this->border, 'J');
			
			$textPenyakit07 = '';
			if (@$r['data_skk']['isPenyakitT07_TTU']) {
				$textPenyakit07 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT07_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT07_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT07_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT07_TTU'] ? 'Ya' : 'Tidak').", Mata, Telinga, Hidung, Tenggorokan (THT), Kelenjar Gondok/Tiroid, Sinus dan gangguan bicara. ".$textPenyakit07, $this->border, 'J');
			
			$textPenyakit08 = '';
			if (@$r['data_skk']['isPenyakitT08_TTU']) {
				$textPenyakit08 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT08_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT08_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT08_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT08_TTU'] ? 'Ya' : 'Tidak').", Sakit Kepala, Migran, Pusing, Vertigo, Otak, Syaraf, Epilepsi, Ayan, Kejang, Pingsan dan Kelumpuhan. ".$textPenyakit08, $this->border, 'J');
			
			$textPenyakit09 = '';
			if (@$r['data_skk']['isPenyakitT09_TTU']) {
				$textPenyakit09 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT09_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT09_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT09_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT09_TTU'] ? 'Ya' : 'Tidak').", Polio, Gangguan pada anggota tubuh, Gangguan Persendian, Rematik, Kelainan pada Otot, Sendi, Tulang. ".$textPenyakit09, $this->border, 'J');
			
			$textPenyakit10 = '';
			if (@$r['data_skk']['isPenyakitT10_TTU']) {
				$textPenyakit10 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT10_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT10_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT10_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT09_TTU'] ? 'Ya' : 'Tidak').", Kecelakaan dan cedera berat berkepanjangan. ".$textPenyakit10, $this->border, 'J');
			
			$textPenyakit11 = '';
			if (@$r['data_skk']['isPenyakitT11_TTU']) {
				$textPenyakit11 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT11_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT11_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT11_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT11_TTU'] ? 'Ya' : 'Tidak').", Hernia. ".$textPenyakit11, $this->border, 'J');
			
			$textPenyakit12 = '';
			if (@$r['data_skk']['isPenyakitT12_TTU']) {
				$textPenyakit12 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT12_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT12_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT12_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT12_TTU'] ? 'Ya' : 'Tidak').", Kelainan Psikologis. ".$textPenyakit12, $this->border, 'J');
			
			$textPenyakit13 = '';
			if (@$r['data_skk']['isPenyakitT13_TTU']) {
				$textPenyakit13 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT13_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT13_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT13_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT13_TTU'] ? 'Ya' : 'Tidak').", Kencing Manis, Asam Urat, Kolesterol, Penyakit Endokrin/ Hormon Lain. ".$textPenyakit13, $this->border, 'J');
			
			$textPenyakit14 = '';
			if (@$r['data_skk']['isPenyakitT14_TTU']) {
				$textPenyakit14 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT14_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT14_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT14_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT14_TTU'] ? 'Ya' : 'Tidak').", Tuberkulosis (TBC), Gangguan Pernafasan, batuk berkepanjangan, sesak nafas, Bronkitis, Asthma, Batuk darah. ".$textPenyakit14, $this->border, 'J');
			
			$textPenyakit15 = '';
			if (@$r['data_skk']['isPenyakitT15_TTU']) {
				$textPenyakit15 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT15_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT15_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT15_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT15_TTU'] ? 'Ya' : 'Tidak').", AIDS & kondisi yang berhubungan dengan AIDS (demam, kelelahan, diare kronis, penurunan berat badan, sariawan yang lama sembuh, pembengkakan getah bening atau luka di kulit berulang & berkepanjangan yang tidak diketahui penyebabnya). ".$textPenyakit15, $this->border, 'J');
			
			$textPenyakit16 = '';
			if (@$r['data_skk']['isPenyakitT16_TTU']) {
				$textPenyakit16 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT16_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT16_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT16_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT16_TTU'] ? 'Ya' : 'Tidak').", Tumor/Kista/Benjolan/pembengkakan/Kanker. ".$textPenyakit16, $this->border, 'J');
			
			$textPenyakit17 = '';
			if (@$r['data_skk']['isPenyakitT17_TTU']) {
				$textPenyakit17 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT17_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT17_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT17_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT17_TTU'] ? 'Ya' : 'Tidak').", Anemia, Hemofilia atau Kelainan Darah, Tekanan Darah Rendah, Tekanan Darah Tinggi. ".$textPenyakit17, $this->border, 'J');
			
			$textPenyakit18 = '';
			if (@$r['data_skk']['isPenyakitT18_TTU']) {
				$textPenyakit18 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT18_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT18_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT18_TTU'];
			}
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT18_TTU'] ? 'Ya' : 'Tidak').", Malaria. ".$textPenyakit18, $this->border, 'J');
			
			
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT20_TTU'] ? 'Ya' : 'Tidak').", Cacat bawaan / kehilangan fungsi pada anggota tubuh.".
					(@$r['data_skk']['isMataCacat_TTU'] && @$r['data_skk']['isMataCacat__TTU'] == 'kiri' ? ' Mata Kiri.' : '').
					(@$r['data_skk']['isMataCacat_TTU'] && @$r['data_skk']['isMataCacat__TTU'] == 'kanan' ? ' Mata Kanan.' : '').
					(@$r['data_skk']['isMataCacat_TTU'] && @$r['data_skk']['isMataCacat__TTU'] == 'keduanya' ? ' Kedua Mata.' : '').
					(@$r['data_skk']['isKakiCacat_TTU'] && @$r['data_skk']['isKakiCacat__TTU'] == 'kiri' ? ' Kaki Kiri.' : '').
					(@$r['data_skk']['isKakiCacat_TTU'] && @$r['data_skk']['isKakiCacat__TTU'] == 'kanan' ? ' Kaki Kanan.' : '').
					(@$r['data_skk']['isKakiCacat_TTU'] && @$r['data_skk']['isKakiCacat__TTU'] == 'keduanya' ? ' Kedua Kaki.' : '').
					(@$r['data_skk']['isTanganCacat_TTU'] && @$r['data_skk']['isTanganCacat__TTU'] == 'kiri' ? ' Tangan Kiri.' : '').
					(@$r['data_skk']['isTanganCacat_TTU'] && @$r['data_skk']['isTanganCacat__TTU'] == 'kanan' ? ' Tangan Kanan.' : '').
					(@$r['data_skk']['isTanganCacat_TTU'] && @$r['data_skk']['isTanganCacat__TTU'] == 'keduanya' ? ' Kedua Tangan.' : '')
				, $this->border, 'J');
			if (@$r['data_skk']['isPenyakitT19_TTU']) {
				$this->Cell(5, $this->height, '', $this->border, 0, 'L');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-10, $this->height, "Ya, ".@$r['data_skk']['namaPenyakitLainnyaT19_TTU'].". Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT19_TTU'])).". Nama Dokter ".@$r['data_skk']['namaDokterT19_TTU'].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT19_TTU'], $this->border, 'J');
			}
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah atau sedang menggunakan obat-obatan terlarang, narkoba atau bahan adiktif lainnya? '.(@$r['data_skk']['isNarkobaTTU'] ? 'Ya' : 'Tidak'), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah ada obat-obatan lain yang di konsumsi? '.(@$r['data_skk']['isObatLainTTU'] ? 'Ya'.(@$r['data_skk']['jenisObatLainTTU'] ? ', '.@$r['data_skk']['jenisObatLainTTU'] : '') : 'Tidak'), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda minum minuman beralkohol lebih dari 750 ml per minggu? '.(@$r['data_skk']['isMinumAlkoholTTU'] ? 'Ya' : 'Tidak'), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda Merokok? '.(@$r['data_skk']['isMerokokTTU'] ? 'Ya'.(@$r['data_skk']['rokokBatangPerhariTTU'] ? ', '.@$r['data_skk']['rokokBatangPerhariTTU'].' batang per hari' : '').(@$r['data_skk']['lamaMerokokTTU'] ? ' selama '.@$r['data_skk']['lamaMerokokTTU'] : '') : 'Tidak'), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah mengalami tanda dan/atau gejala gangguan kesehatan yang mengarah ke diagnosis COVID-19, dalam hal ini, termasuk namun tidak terbatas pada adanya demam, batuk, nyeri tenggorokan, sesak nafas, gangguan pernafasan, keletihan, dan/atau memiliki riwayat kontak dengan pasien suspek, terkonfirmasi COVID-19, PDP, ODP dalam waktu 14 (empat belas) hari terakhir? '.(@$r['data_skk']['isCovid19TTU'] ? 'Ya' : 'Tidak'), $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah memeriksakan pada dokter, dirawat di Rumah Sakit, Sanatorium, atau tempat istirahat lain karena sakit (pemulihan) atau saat ini sedang mendapat pengobatan dokter dan mendapatkan obat yang dikonsumsi secara teratur? '.
				(@$r['data_skk']['isPengobatanDokterTTU'] ? "\nYa," : 'Tidak').
				(@$r['data_skk']['namaPenyakitTTU'] ? " Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitTTU'] : '').
				(@$r['data_skk']['kapanDirawatPenyakitTTU'] ? " tanggal ".date('d-m-Y', strtotime(@$r['data_skk']['kapanDirawatPenyakitTTU'])) : '').
				(@$r['data_skk']['berapaLamaDirawatPenyakitTTU'] ? " lama dirawat ".@$r['data_skk']['berapaLamaDirawatPenyakitTTU'] : '').
				(@$r['data_skk']['namaDosisObatPenyakitTTU'] ? " dengan obat dan dosisi ".@$r['data_skk']['namaDosisObatPenyakitTTU'] : '').
				(@$r['data_skk']['namaRSDokterPenyakitTTU'] ? " nama rumah sakit ".@$r['data_skk']['namaRSDokterPenyakitTTU'] : '')
			, $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah mendapatkan luka berat atau dioperasi? '.
				(@$r['data_skk']['isOperasiTTU'] ? "\nYa," : 'Tidak').
				(@$r['data_skk']['tglOperasiTTU'] ? " tanggal ".date('d-m-Y', strtotime(@$r['data_skk']['tglOperasiTTU'])) : '').
				(@$r['data_skk']['jenisOperasiTTU'] ? " jenis operasi ".@$r['data_skk']['jenisOperasiTTU'] : '').
				(@$r['data_skk']['namaRsDokterTTU'] ? " di rumah sakit / oleh dokter ".@$r['data_skk']['namaRsDokterTTU'] : '')
			, $this->border, 'J');
			
			// SKK Jika Tertanggung Perempuan
			if (@$r['data_diri_tertanggung']['jenkelTertanggung'] == 'P') {
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-5, $this->height, 'Apakah saat ini Anda dalam keadaan hamil? '.(@$r['data_skk']['isSKKUmumHamil_TTU'] ? 'Ya' : 'Tidak'), $this->border, 'J');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah mengalami operasi (sectio caesarea), keguguran/aborsi/kehamilan diluar kandungan/ menderita kelainan payudara/ gangguan menstruasi/endometriosis/gangguan atau penyakit saat kehamilan atau melahirkan atau kelainan alat reproduksi lainnya? '.
					(@$r['data_skk']['isSKKCesar_TTU'] ? 'Ya,' : 'Tidak').
					(@$r['data_skk']['SKKPernahCesar_TTU'] ? " penyebabnya ".@$r['data_skk']['SKKPernahCesar_TTU'] : '').
					(@$r['data_skk']['SKKPernahCesarRS_TTU'] ? " di dokter/rumah sakit ".@$r['data_skk']['SKKPernahCesarRS_TTU'] : '')
				, $this->border, 'J');
				$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
				$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah melakukan Pap Smear / USG kandungan / mamografi? '.
					(@$r['data_skk']['isSKKUmumWanitaPAP_TTU'] ? 'Ya,' : 'Tidak').
					(@$r['data_skk']['tglPemeriksaanPAP_TTU'] ? " tanggal ".date('d-m-Y', strtotime(@$r['data_skk']['tglPemeriksaanPAP_TTU'])) : '').
					(@$r['data_skk']['hasilPemeriksaanPAP_TTU'] ? " hasilnya ".@$r['data_skk']['hasilPemeriksaanPAP_TTU'] : '')
				, $this->border, 'J');
			}
			
			$hobiTertanggungTambahan = '';
			foreach (@$r['hobi'] as $i => $v) {
				if(@$r['data_skk']['hobbyTT1'] == $v['KDHOBI']){
					$hobiTertanggungTambahan = $v['NAMAHOBI'];
				}
			}




			// SKK Tertanggung Tambahan
			// @$hobi[@$r['data_skk']['hobbyTT'.$i]]
			if (@$r['data_diri_tertanggung']['jmlTertanggungTambahan'] > 0) {
				for ($i = 1; $i <= @$r['data_diri_tertanggung']['jmlTertanggungTambahan']; $i++) {
					$this->ln(2);
					$this->Cell($this->PG_W, $this->height+2, "SKK Tertanggung Tambahan $i", $this->border, 1, 'L', true);
					if (@$r['data_skk']['isHobiAdaTT'.$i]) {
						$this->Cell(50, $this->height, 'Hobi', $this->border, 0, 'L');
						$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
						$this->Cell($this->PG_W-52, $this->height, $hobiTertanggungTambahan, $this->border, 1, 'L');
					}
					// $this->Cell(50, $this->height, 'Ayah Kandung', $this->border, 0, 'L');
					// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					// $this->MultiCell($this->PG_W-52, $this->height, 
					// 	@$r['data_skk']['umurAyahTT'.$i]." Tahun, ".
					// 	(@$r['data_skk']['isAyahHidup_TT'.$i] ? 
					// 		"Masih Hidup \n".(@$r['data_skk']['isAyahHidupSehat_TT'.$i] ? 'Sehat' : 'Tidak Sehat') : 
					// 		'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalAyah_TT'.$i] ? ' Karena '.@$r['data_skk']['sebabMeninggalAyah_TT'.$i] : '').
					// 			(@$r['data_skk']['lamaSakitAyah_TT'.$i] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitAyah_TT'.$i] : '' ).
					// 			(@$r['data_skk']['tglMeninggalAyah_TT'.$i] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalAyah_TT'.$i])) : '' )
					// 	).
					// 	(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahDiabet_TT'.$i] ? ', Diabetes' : '').
					// 	(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahHipertensi_TT'.$i] ? ', Hipertensi' : '').
					// 	(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahJantung_TT'.$i] ? ', Jantung/Stroke' : '').
					// 	(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahTumor_TT'.$i] ? ', Tumor/Kanker' : '').
					// 	(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahPenyakitKeturunan_TT'.$i] ? ', Penyakit Keturunan' : '')
						
					// , $this->border, 'J');
					// $this->Cell(50, $this->height, 'Ibu Kandung', $this->border, 0, 'L');
					// $this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					// $this->MultiCell($this->PG_W-52, $this->height, 
					// 	@$r['data_skk']['umurIbuTT'.$i]." Tahun, ".
					// 	(@$r['data_skk']['isIbuHidup_TT'.$i] ? 
					// 		"Masih Hidup \n".(@$r['data_skk']['isIbuHidupSehat_TT'.$i] ? 'Sehat' : 'Tidak Sehat') : 
					// 		'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalIbu_TT'.$i] ? ' Karena '.@$r['data_skk']['sebabMeninggalIbu_TT'.$i] : '').
					// 			(@$r['data_skk']['lamaSakitIbu_TT'.$i] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitIbu_TT'.$i] : '' ).
					// 			(@$r['data_skk']['tglMeninggalIbu_TT'.$i] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalIbu_TT'.$i])) : '' )
					// 	).
					// 	(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuDiabet_TT'.$i] ? ', Diabetes' : '').
					// 	(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuHipertensi_TT'.$i] ? ', Hipertensi' : '').
					// 	(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuJantung_TT'.$i] ? ', Jantung/Stroke' : '').
					// 	(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuTumor_TT'.$i] ? ', Tumor/Kanker' : '').
					// 	(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuPenyakitKeturunan_TT'.$i] ? ', Penyakit Keturunan' : '')
						
					// , $this->border, 'J');
					// if (@$r['data_skk']['isAdaPasangan_TT'.$i]) {
					// 	$this->Cell(50, $this->height, 'Pasangan', $this->border, 0, 'L');
					// 	$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
					// 	$this->MultiCell($this->PG_W-52, $this->height, 
					// 		@$r['data_skk']['umurPasanganTT'.$i]." Tahun, ".
					// 		(@$r['data_skk']['isPasanganHidup_TT'.$i] ? 
					// 			"Masih Hidup \n".(@$r['data_skk']['isPasanganHidupSehat_TT'.$i] ? 'Sehat' : 'Tidak Sehat') : 
					// 			'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalPasangan_TT'.$i] ? ' Karena '.@$r['data_skk']['sebabMeninggalPasangan_TT'.$i] : '').
					// 				(@$r['data_skk']['lamaSakitPasangan_TT'.$i] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitPasangan_TT'.$i] : '' ).
					// 				(@$r['data_skk']['tglMenikahTT'.$i] ? ', Tanggal Menikah '.date('d-m-Y', strtotime(@$r['data_skk']['tglMenikahTT'.$i])) : '' )
					// 		).
					// 		(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @!$r['data_skk']['isPasanganDiabet_TT'.$i] ? ', Diabetes' : '').
					// 		(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @!$r['data_skk']['isPasanganHipertensi_TT'.$i] ? ', Hipertensi' : '').
					// 		(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @!$r['data_skk']['isPasanganJantung_TT'.$i] ? ', Jantung/Stroke' : '').
					// 		(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @!$r['data_skk']['isPasanganTumor_TT'.$i] ? ', Tumor/Kanker' : '').
					// 		(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @!$r['data_skk']['isPasanganPenyakitKeturunan_TT'.$i] ? ', Penyakit Keturunan' : '')
							
					// 	, $this->border, 'J');
					// }
					/*if (@$r['data_skk']['jumlahAnakTT'.$i]) {
						for ($i=0; $i< @$r['data_skk']['jumlahAnakTT'.$i]; $i++) {
							$this->Cell(50, $this->height, "Anak ".($i+1), $this->border, 0, 'L');
							$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
							$this->MultiCell($this->PG_W-52, 
								$this->height, "Usia ".@$r['data_skk']['umurAnakTT'.$i][$i]." Tahun".
								(@$r['data_skk']['isHidupAnakTT'.$i][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
								(@$r['data_skk']['isHidupAnakTT'.$i][$i] && @$r['data_skk']['isSehatAnakTT'.$i][$i] ? "Sehat" : '').
								(@$r['data_skk']['isHidupAnakTT'.$i][$i] && !@$r['data_skk']['isSehatAnakTT'.$i][$i] ? "Tidak Sehat" : '')
							, $this->border, 'J');
						}
					}
					if (@$r['data_skk']['jumlahSaudaraKandungLakiTT'.$i]) {
						for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungLakiTT'.$i]; $i++) {
							$this->Cell(50, $this->height, "Saudara Laki-laki ".($i+1), $this->border, 0, 'L');
							$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
							$this->MultiCell($this->PG_W-52, 
								$this->height, "Usia ".@$r['data_skk']['umurSaudaraLkTT'.$i][$i]." Tahun".
								(@$r['data_skk']['isHidupSaudaraLkTT'.$i][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
								(@$r['data_skk']['isHidupSaudaraLkTT'.$i][$i] && @$r['data_skk']['isSehatSaudaraLkTT'.$i][$i] ? "Sehat" : '').
								(@$r['data_skk']['isHidupSaudaraLkTT'.$i][$i] && !@$r['data_skk']['isSehatSaudaraLkTT'.$i][$i] ? "Tidak Sehat" : '')
							, $this->border, 'J');
						}
					}
					if (@$r['data_skk']['jumlahSaudaraKandungPerempuanTT'.$i]) {
						for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungPerempuanTT'.$i]; $i++) {
							$this->Cell(50, $this->height, "Saudara Perempuan ".($i+1), $this->border, 0, 'L');
							$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
							$this->MultiCell($this->PG_W-52, 
								$this->height, "Usia ".@$r['data_skk']['umurSaudaraPrTT'.$i][$i]." Tahun".
								(@$r['data_skk']['isHidupSaudaraPrTT'.$i][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
								(@$r['data_skk']['isHidupSaudaraPrTT'.$i][$i] && @$r['data_skk']['isSehatSaudaraPrTT'.$i][$i] ? "Sehat" : '').
								(@$r['data_skk']['isHidupSaudaraPrTT'.$i][$i] && !@$r['data_skk']['isSehatSaudaraPrTT'.$i][$i] ? "Tidak Sehat" : '')
							, $this->border, 'J');
						}
					}*/
					/** Surat Keterangan Sehat **/
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah ayah/ibu (Hidup/ Meninggal) pernah menderita dan/atau sedang menderita dan/atau meninggal dunia karena salah satu atau beberapa penyakit sebagi berikut: penyakit jantung, stroke, tekanan darah tinggi, TBC, diabetes,penyakit ginjal, hepatitis, tumor / kanker, kelainan psikologis, penyakit keturunan dan menular lainnya? '.(@$r['data_skk']['isPenyakitanOrtuTT'.$i] ? 'Ya' : 'Tidak'), $this->border, 'J');
						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(50, $this->height, 'Ayah Kandung', $this->border, 0, 'L');
						$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
						$this->MultiCell($this->PG_W-52, $this->height, 
							@$r['data_skk']['umurAyahTT'.$i]." Tahun, ".
							(@$r['data_skk']['isAyahHidup_TT'.$i] ? 
								"Masih Hidup \n".(@$r['data_skk']['isAyahHidupSehat_TT'.$i] ? 'Sehat' : 'Tidak Sehat') : 
								'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalAyah_TT'.$i] ? ' Karena '.@$r['data_skk']['sebabMeninggalAyah_TT'.$i] : '').
									(@$r['data_skk']['lamaSakitAyah_TT'.$i] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitAyah_TT'.$i] : '' ).
									(@$r['data_skk']['tglMeninggalAyah_TT'.$i] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalAyah_TT'.$i])) : '' )
							).
							(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahDiabet_TT'.$i] ? ', Diabetes' : '').
							(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahHipertensi_TT'.$i] ? ', Hipertensi' : '').
							(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahJantung_TT'.$i] ? ', Jantung/Stroke' : '').
							(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahTumor_TT'.$i] ? ', Tumor/Kanker' : '').
							(@$r['data_skk']['isAyahHidup_TT'.$i] && !@$r['data_skk']['isAyahHidupSehat_TT'.$i] && @!$r['data_skk']['isAyahPenyakitKeturunan_TT'.$i] ? ', Penyakit Keturunan' : '')
							
						, $this->border, 'J');

						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(50, $this->height, 'Ibu Kandung', $this->border, 0, 'L');
						$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
						$this->MultiCell($this->PG_W-52, $this->height, 
							@$r['data_skk']['umurIbuTT'.$i]." Tahun, ".
							(@$r['data_skk']['isIbuHidup_TT'.$i] ? 
								"Masih Hidup \n".(@$r['data_skk']['isIbuHidupSehat_TT'.$i] ? 'Sehat' : 'Tidak Sehat') : 
								'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalIbu_TT'.$i] ? ' Karena '.@$r['data_skk']['sebabMeninggalIbu_TT'.$i] : '').
									(@$r['data_skk']['lamaSakitIbu_TT'.$i] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitIbu_TT'.$i] : '' ).
									(@$r['data_skk']['tglMeninggalIbu_TT'.$i] ? ', Tanggal Meninggal '.date('d-m-Y', strtotime(@$r['data_skk']['tglMeninggalIbu_TT'.$i])) : '' )
							).
							(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuDiabet_TT'.$i] ? ', Diabetes' : '').
							(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuHipertensi_TT'.$i] ? ', Hipertensi' : '').
							(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuJantung_TT'.$i] ? ', Jantung/Stroke' : '').
							(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuTumor_TT'.$i] ? ', Tumor/Kanker' : '').
							(@$r['data_skk']['isIbuHidup_TT'.$i] && !@$r['data_skk']['isIbuHidupSehat_TT'.$i] && @!$r['data_skk']['isIbuPenyakitKeturunan_TT'.$i] ? ', Penyakit Keturunan' : '')
							
						, $this->border, 'J');

					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah ada anggota keluarga (suami/istri,anak,kakak/adik) yang pernah menderita dan/atau sedang menderita dan/atau meninggal dunia karena salah satu atau beberapa penyakit sebagi berikut : penyakit jantung, stroke, tekanan darah tinggi, TBC, diabetes, penyakit ginjal, hepatitis, tumor / kanker, kelainan psikologis, penyakit keturunan dan menular lainnya? '.(@$r['data_skk']['isPenyakitanKeluargaTT'.$i] ? 'Ya' : 'Tidak'), $this->border, 'J');


					if (@$r['data_skk']['isPenyakitanKeluargaTT'.$i]){

						if (@$r['data_skk']['isAdaPasangan_TT'.$i]) {
							$this->Cell(5, $this->height, '', $this->border, 0, 'L');
							$this->Cell(50, $this->height, 'Pasangan', $this->border, 0, 'L');
							$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
							$this->MultiCell($this->PG_W-52, $this->height, 
								@$r['data_skk']['umurPasanganTT'.$i]." Tahun, ".
								(@$r['data_skk']['isPasanganHidup_TT'.$i] ? 
									"Masih Hidup \n".(@$r['data_skk']['isPasanganHidupSehat_TT'.$i] ? 'Sehat' : 'Tidak Sehat') : 
									'Telah Meninggal'.(@$r['data_skk']['sebabMeninggalPasangan_TT'.$i] ? ' Karena '.@$r['data_skk']['sebabMeninggalPasangan_TT'.$i] : '').
										(@$r['data_skk']['lamaSakitPasangan_TT'.$i] ? ', Lama Sakit '.@$r['data_skk']['lamaSakitPasangan_TT'.$i] : '' ).
										(@$r['data_skk']['tglMenikahTT'.$i] ? ', Tanggal Menikah '.date('d-m-Y', strtotime(@$r['data_skk']['tglMenikahTT'.$i])) : '' )
								).
								(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @$r['data_skk']['isPasanganDiabet_TT'.$i] ? ', Diabetes' : '').
								(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @$r['data_skk']['isPasanganHipertensi_TT'.$i] ? ', Hipertensi' : '').
								(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @$r['data_skk']['isPasanganJantung_TT'.$i] ? ', Jantung/Stroke' : '').
								(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @$r['data_skk']['isPasanganTumor_TT'.$i] ? ', Tumor/Kanker' : '').
								(@$r['data_skk']['isPasanganHidup_TT'.$i] && !@$r['data_skk']['isPasanganHidupSehat_TT'.$i] && @$r['data_skk']['isPasanganPenyakitKeturunan_TT'.$i] ? ', Penyakit Keturunan' : '')
								
							, $this->border, 'J');
						}

						if (@$r['data_skk']['jumlahAnakTT'.$i]) {
							for ($i=0; $i< @$r['data_skk']['jumlahAnakTT'.$i]; $i++) {
								$this->Cell(5, $this->height, '', $this->border, 0, 'L');
								$this->Cell(50, $this->height, "Anak ".($i+1), $this->border, 0, 'L');
								$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
								$this->MultiCell($this->PG_W-52, 
									$this->height, "Usia ".@$r['data_skk']['umurAnakTT'.$i][$i]." Tahun".
									(@$r['data_skk']['isHidupAnakTT'.$i][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
									(@$r['data_skk']['isHidupAnakTT'.$i][$i] && @$r['data_skk']['isSehatAnakTT'.$i][$i] ? "Sehat" : '').
									(@$r['data_skk']['isHidupAnakTT'.$i][$i] && !@$r['data_skk']['isSehatAnakTT'.$i][$i] ? "Tidak Sehat" : '')
								, $this->border, 'J');
							}
						}
						if (@$r['data_skk']['jumlahSaudaraKandungLakiTT'.$i]) {
							for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungLakiTT'.$i]; $i++) {
								$this->Cell(5, $this->height, '', $this->border, 0, 'L');
								$this->Cell(50, $this->height, "Saudara Laki-laki ".($i+1), $this->border, 0, 'L');
								$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
								$this->MultiCell($this->PG_W-52, 
									$this->height, "Usia ".@$r['data_skk']['umurSaudaraLkTT'.$i][$i]." Tahun".
									(@$r['data_skk']['isHidupSaudaraLkTT'.$i][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
									(@$r['data_skk']['isHidupSaudaraLkTT'.$i][$i] && @$r['data_skk']['isSehatSaudaraLkTT'.$i][$i] ? "Sehat" : '').
									(@$r['data_skk']['isHidupSaudaraLkTT'.$i][$i] && !@$r['data_skk']['isSehatSaudaraLkTT'.$i][$i] ? "Tidak Sehat" : '')
								, $this->border, 'J');
							}
						}
						if (@$r['data_skk']['jumlahSaudaraKandungPerempuanTT'.$i]) {
							for ($i=0; $i< @$r['data_skk']['jumlahSaudaraKandungPerempuanTT'.$i]; $i++) {
								$this->Cell(5, $this->height, '', $this->border, 0, 'L');
								$this->Cell(50, $this->height, "Saudara Perempuan ".($i+1), $this->border, 0, 'L');
								$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
								$this->MultiCell($this->PG_W-52, 
									$this->height, "Usia ".@$r['data_skk']['umurSaudaraPrTT'.$i][$i]." Tahun".
									(@$r['data_skk']['isHidupSaudaraPrTT'.$i][$i] ? " Masih Hidup\n" : ' Telah Meninggal').
									(@$r['data_skk']['isHidupSaudaraPrTT'.$i][$i] && @$r['data_skk']['isSehatSaudaraPrTT'.$i][$i] ? "Sehat" : '').
									(@$r['data_skk']['isHidupSaudaraPrTT'.$i][$i] && !@$r['data_skk']['isSehatSaudaraPrTT'.$i][$i] ? "Tidak Sehat" : '')
								, $this->border, 'J');
							}
						}

					}

					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah merasa sehat? '.(@$r['data_skk']['isSehatTT'.$i] ? 'Ya' : 'Tidak'.(@$r['data_skk']['alasanSakitTT'.$i] ? ', '.@$r['data_skk']['alasanSakitTT'.$i]: '')), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda dapat melakukan pekerjaan dengan baik? '.(@$r['data_skk']['isSehatTT'.$i] ? 'Ya' : 'Tidak'.(@$r['data_skk']['alasanPekerjaanBaikTT'.$i] ? ', '.@$r['data_skk']['alasanPekerjaanBaikTT'.$i]: '')), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					
					$this->MultiCell($this->PG_W-5, $this->height, "Apakah Anda pernah mengalami gejala-gejala, diperiksa, menderita, mendapat pengobatan oleh dokter dan disarankan untuk rawat inap, rawat jalan di Fasilitas Kesehatan/Rumah Sakit?", $this->border, 'J');
					
					// (@$r['data_skk']['isPenyakitT01_TT'.$i]) ? date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT01_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT01_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT01_TT'.$i];

					$textPenyakit01_TT1 = '';
					if (@$r['data_skk']['isPenyakitT01_TT'.$i]){
						$textPenyakit01_TT1 = 'Tanggal Sakit : ' .date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT01_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT01_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT01_TT'.$i];
					}
					
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT01_TT'.$i] ? 'Ya' : 'Tidak' ). ", Hepatitis A/B/C/D/E, Hati (selain Hepatitis) dan Kandung Empedu. ".$textPenyakit01_TT1, $this->border, 'J');
					
					$textPenyakit02_TT1 = '';
					if (@$r['data_skk']['isPenyakitT02_TT'.$i]) {
						$textPenyakit02_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT02_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT02_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT02_TT'.$i];
					}

					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT02_TT'.$i] ? 'Ya' : 'Tidak' ).", Usus, Pankreas, Wasir dan Organ Pencernaan lain. ".$textPenyakit02_TT1, $this->border, 'J');
					
					$textPenyakit03_TT1 = '';
					if (@$r['data_skk']['isPenyakitT03_TT'.$i]) {
						$textPenyakit03_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT03_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT03_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT03_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT03_TT'.$i] ? 'Ya' : 'Tidak' ).", Ginjal, Batu Ginjal, Saluran Kemih dan Prostat. ".$textPenyakit03_TT1, $this->border, 'J');
					
					$textPenyakit04_TT1 = '';
					if (@$r['data_skk']['isPenyakitT04_TT'.$i]) {
						$textPenyakit04_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT04_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT04_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT04_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT04_TT'.$i] ? 'Ya' : 'Tidak' ).", Nyeri Dada, Jantung, Jantung Bawaan, Demam Rheuma, Pembuluh Darah dan Stroke. ".$textPenyakit04_TT1, $this->border, 'J');
					
					$textPenyakit05_TT1 = '';
					if (@$r['data_skk']['isPenyakitT05_TT'.$i]) {
						$textPenyakit05_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT05_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT05_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT05_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT05_TT'.$i] ? 'Ya' : 'Tidak' ).", Payudara, Kandungan dan Indung Telur. ".$textPenyakit05_TT1, $this->border, 'J');
					
					$textPenyakit06_TT1 = '';
					if (@$r['data_skk']['isPenyakitT06_TT'.$i]) {
						$textPenyakit06_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT06_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT06_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT06_TT'.$i];
					}

					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT06_TT'.$i] ? 'Ya' : 'Tidak' ).", Alergi, Penyakit Kulit, penyakit kelamin. ".$textPenyakit06_TT1, $this->border, 'J');
					
					$textPenyakit07_TT1 = '';
					if (@$r['data_skk']['isPenyakitT07_TT'.$i]) {
						$textPenyakit07_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT07_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT07_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT07_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT07_TT'.$i] ? 'Ya' : 'Tidak' ).", Mata, Telinga, Hidung, Tenggorokan (THT), Kelenjar Gondok/Tiroid, Sinus dan gangguan bicara. ".$textPenyakit07_TT1, $this->border, 'J');
					
					$textPenyakit08_TT1 = '';
					if (@$r['data_skk']['isPenyakitT08_TT'.$i]) {
						$textPenyakit08_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT08_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT08_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT08_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT08_TT'.$i] ? 'Ya' : 'Tidak' ).", Sakit Kepala, Migran, Pusing, Vertigo, Otak, Syaraf, Epilepsi, Ayan, Kejang, Pingsan dan Kelumpuhan. ".$textPenyakit08_TT1, $this->border, 'J');
					
					$textPenyakit09_TT1 = '';
					if (@$r['data_skk']['isPenyakitT09_TT'.$i]) {
						$textPenyakit09_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT09_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT09_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT09_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT09_TT'.$i] ? 'Ya' : 'Tidak' ).", Polio, Gangguan pada anggota tubuh, Gangguan Persendian, Rematik, Kelainan pada Otot, Sendi, Tulang. ".$textPenyakit09_TT1, $this->border, 'J');
					
					$textPenyakit10_TT1 = '';
					if (@$r['data_skk']['isPenyakitT10_TT'.$i]) {
						$textPenyakit10_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT10_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT10_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT10_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT10_TT'.$i] ? 'Ya' : 'Tidak' ).", Kecelakaan dan cedera berat berkepanjangan. ".$textPenyakit10_TT1, $this->border, 'J');
					
					$textPenyakit11_TT1 = '';
					if (@$r['data_skk']['isPenyakitT11_TT'.$i]) {
						$textPenyakit11_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT11_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT11_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT11_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT11_TT'.$i] ? 'Ya' : 'Tidak' ).", Hernia. ".$textPenyakit11_TT1, $this->border, 'J');
					
					
					$textPenyakit12_TT1 = '';
					if (@$r['data_skk']['isPenyakitT12_TT'.$i]) {
						$textPenyakit12_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT12_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT12_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT12_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT12_TT'.$i] ? 'Ya' : 'Tidak' ).", Kelainan Psikologis. ".$textPenyakit12_TT1, $this->border, 'J');
					
					$textPenyakit13_TT1 = '';
					if (@$r['data_skk']['isPenyakitT13_TT'.$i]) {
						$textPenyakit13_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT13_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT13_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT13_TT'.$i];
					}

					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT13_TT'.$i] ? 'Ya' : 'Tidak' ).", Kencing Manis, Asam Urat, Kolesterol, Penyakit Endokrin/ Hormon Lain. ".$textPenyakit13_TT1, $this->border, 'J');
					
					$textPenyakit14_TT1 = '';
					if (@$r['data_skk']['isPenyakitT14_TT'.$i]) {
						$textPenyakit14_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT14_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT14_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT14_TT'.$i];
					}

						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
						$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT14_TT'.$i] ? 'Ya' : 'Tidak' ).", Tuberkulosis (TBC), Gangguan Pernafasan, batuk berkepanjangan, sesak nafas, Bronkitis, Asthma, Batuk darah. ".$textPenyakit14_TT1, $this->border, 'J');
					
					$textPenyakit15_TT1 = '';
					if (@$r['data_skk']['isPenyakitT15_TT'.$i]) {
						$textPenyakit15_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT15_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT15_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT15_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT15_TT'.$i] ? 'Ya' : 'Tidak' ).", AIDS & kondisi yang berhubungan dengan AIDS (demam, kelelahan, diare kronis, penurunan berat badan, sariawan yang lama sembuh, pembengkakan getah bening atau luka di kulit berulang & berkepanjangan yang tidak diketahui penyebabnya). ".$textPenyakit15_TT1, $this->border, 'J');
					
					$textPenyakit16_TT1 = '';
					if (@$r['data_skk']['isPenyakitT16_TT'.$i]) {
						$textPenyakit16_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT16_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT16_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT16_TT'.$i];
					}

					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT16_TT'.$i] ? 'Ya' : 'Tidak' ).", Tumor/Kista/Benjolan/pembengkakan/Kanker. ".$textPenyakit16_TT1, $this->border, 'J');
					
					$textPenyakit17_TT1 = '';
					if (@$r['data_skk']['isPenyakitT17_TT'.$i]) {
						$textPenyakit17_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT17_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT17_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT17_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT17_TT'.$i] ? 'Ya' : 'Tidak' ).", Anemia, Hemofilia atau Kelainan Darah, Tekanan Darah Rendah, Tekanan Darah Tinggi. ".$textPenyakit17_TT1, $this->border, 'J');
					
					$textPenyakit18_TT1 = '';
					if (@$r['data_skk']['isPenyakitT18_TT'.$i]) {
						$textPenyakit18_TT1 = "Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT18_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT18_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT18_TT'.$i];
					}
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT18_TT'.$i] ? 'Ya' : 'Tidak' ).", Malaria. ".$textPenyakit18_TT1, $this->border, 'J');
					
					//echo "isMataCacat_TT".$i;die;
					$this->Cell(5, $this->height, '', $this->border, 0, 'L');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-10, $this->height, (@$r['data_skk']['isPenyakitT20_TT'.$i] ? 'Ya' : 'Tidak' ).", Cacat bawaan / kehilangan fungsi pada anggota tubuh.".
						(@$r['data_skk']['isMataCacat_TT'.$i] && @$r['data_skk']['isMataCacat__TT'.$i] == 'kiri' ? ' Mata Kiri.' : '').
						(@$r['data_skk']['isMataCacat_TT'.$i] && @$r['data_skk']['isMataCacat__TT'.$i] == 'kanan' ? ' Mata Kanan.' : '').
						(@$r['data_skk']['isMataCacat_TT'.$i] && @$r['data_skk']['isMataCacat__TT'.$i] == 'keduanya' ? ' Kedua Mata.' : '').
						(@$r['data_skk']['isKakiCacat_TT'.$i] && @$r['data_skk']['isKakiCacat__TT'.$i] == 'kiri' ? ' Kaki Kiri.' : '').
						(@$r['data_skk']['isKakiCacat_TT'.$i] && @$r['data_skk']['isKakiCacat__TT'.$i] == 'kanan' ? ' Kaki Kanan.' : '').
						(@$r['data_skk']['isKakiCacat_TT'.$i] && @$r['data_skk']['isKakiCacat__TT'.$i] == 'keduanya' ? ' Kedua Kaki.' : '').
						(@$r['data_skk']['isTanganCacat_TT'.$i] && @$r['data_skk']['isTanganCacat__TT'.$i] == 'kiri' ? ' Tangan Kiri.' : '').
						(@$r['data_skk']['isTanganCacat_TT'.$i] && @$r['data_skk']['isTanganCacat__TT'.$i] == 'kanan' ? ' Tangan Kanan.' : '').
						(@$r['data_skk']['isTanganCacat_TT'.$i] && @$r['data_skk']['isTanganCacat__TT'.$i] == 'keduanya' ? ' Kedua Tangan.' : '')
					, $this->border, 'J');
					
					if (@$r['data_skk']['isPenyakitT19_TT'.$i]) {
						$this->Cell(5, $this->height, '', $this->border, 0, 'L');
						$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
						$this->MultiCell($this->PG_W-10, $this->height, "Ya, ".@$r['data_skk']['namaPenyakitLainnyaT19_TT'.$i].". Tanggal Sakit ".date('d-m-Y', strtotime(@$r['data_skk']['tglSakitT19_TT'.$i])).". Nama Dokter ".@$r['data_skk']['namaDokterT19_TT'.$i].". Penyakit yang diderita : ".@$r['data_skk']['namaPenyakitT19_TT'.$i], $this->border, 'J');
					}
					
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah atau sedang menggunakan obat-obatan terlarang, narkoba atau bahan adiktif lainnya? '.(@$r['data_skk']['isNarkobaTT'.$i] ? 'Ya' : 'Tidak'), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah ada obat-obatan lain yang di konsumsi? '.(@$r['data_skk']['isObatLainTT'.$i] ? 'Ya'.(@$r['data_skk']['jenisObatLainTT'.$i] ? ', '.@$r['data_skk']['jenisObatLainTT'.$i] : '') : 'Tidak'), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda minum minuman beralkohol lebih dari 750 ml per minggu? '.(@$r['data_skk']['isNarkobaTT'.$i] ? 'Ya' : 'Tidak'), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda Merokok? '.(@$r['data_skk']['isMerokokTT'.$i] ? 'Ya'.(@$r['data_skk']['rokokBatangPerhariTT'.$i] ? ', '.@$r['data_skk']['rokokBatangPerhariTT'.$i].' batang per hari' : '').(@$r['data_skk']['lamaMerokokTT'.$i] ? ' selama '.@$r['data_skk']['lamaMerokokTT'.$i] : '') : 'Tidak'), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah mengalami tanda dan/atau gejala gangguan kesehatan yang mengarah ke diagnosis COVID-19, dalam hal ini, termasuk namun tidak terbatas pada adanya demam, batuk, nyeri tenggorokan, sesak nafas, gangguan pernafasan, keletihan, dan/atau memiliki riwayat kontak dengan pasien suspek, terkonfirmasi COVID-19, PDP, ODP dalam waktu 14 (empat belas) hari terakhir? '.(@$r['data_skk']['isCovid19TT'.$i] ? 'Ya' : 'Tidak'), $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah memeriksakan pada dokter, dirawat di Rumah Sakit, Sanatorium, atau tempat istirahat lain karena sakit (pemulihan) atau saat ini sedang mendapat pengobatan dokter dan mendapatkan obat yang dikonsumsi secara teratur? '.
						(@$r['data_skk']['isPengobatanDokterTT'.$i] ? "\nYa," : 'Tidak').
						(@$r['data_skk']['namaPenyakitTT'.$i] ? " nama penyakit ".@$r['data_skk']['namaPenyakitTT'.$i] : '').
						(@$r['data_skk']['kapanDirawatPenyakitTT'.$i] ? " tanggal ".date('d-m-Y', strtotime(@$r['data_skk']['kapanDirawatPenyakitTT'.$i])) : '').
						(@$r['data_skk']['berapaLamaDirawatPenyakitTT'.$i] ? " lama dirawat ".@$r['data_skk']['berapaLamaDirawatPenyakitTT'.$i] : '').
						(@$r['data_skk']['namaDosisObatPenyakitTT'.$i] ? " dengan obat dan dosisi ".@$r['data_skk']['namaDosisObatPenyakitTT'.$i] : '').
						(@$r['data_skk']['namaRSDokterPenyakitTT'.$i] ? " nama rumah sakit ".@$r['data_skk']['namaRSDokterPenyakitTT'.$i] : '')
					, $this->border, 'J');
					$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
					$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah mendapatkan luka berat atau dioperasi? '.
						(@$r['data_skk']['isOperasiTT'.$i] ? "\nYa," : 'Tidak').
						(@$r['data_skk']['tglOperasiTT'.$i] ? " tanggal ".date('d-m-Y', strtotime(@$r['data_skk']['tglOperasiTT'.$i])) : '').
						(@$r['data_skk']['jenisOperasiTT'.$i] ? " jenis operasi ".@$r['data_skk']['jenisOperasiTT'.$i] : '').
						(@$r['data_skk']['namaRsDokterTT'.$i] ? " di rumah sakit / oleh dokter ".@$r['data_skk']['namaRsDokterTT'.$i] : '')
					, $this->border, 'J');
					
					// SKK Jika Tertanggung Perempuan

					if (@$r['data_diri_tertanggung']['jenisKelaminTertanggungTambahan'.$i] == 'P') {
						$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
						$this->MultiCell($this->PG_W-5, $this->height, 'Apakah saat ini Anda dalam keadaan hamil? '.(@$r['data_skk']['isSKKUmumHamil_TT'.$i] ? 'Ya' : 'Tidak'), $this->border, 'J');
						$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
						$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah mengalami operasi (sectio caesarea), keguguran/aborsi/kehamilan diluar kandungan/ menderita kelainan payudara/ gangguan menstruasi/endometriosis/gangguan atau penyakit saat kehamilan atau melahirkan atau kelainan alat reproduksi lainnya? '.
							(@$r['data_skk']['isSKKCesar_TT'.$i] ? 'Ya,' : 'Tidak').
							(@$r['data_skk']['SKKPernahCesar_TT'.$i] ? " penyebabnya ".@$r['data_skk']['SKKPernahCesar_TT'.$i] : '').
							(@$r['data_skk']['SKKPernahCesarRS_TT'.$i] ? " di dokter/rumah sakit ".@$r['data_skk']['SKKPernahCesarRS_TT'.$i] : '')
						, $this->border, 'J');
						$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
						$this->MultiCell($this->PG_W-5, $this->height, 'Apakah Anda pernah melakukan Pap Smear / USG kandungan / mamografi? '.
							(@$r['data_skk']['isSKKUmumWanitaPAP_TT'.$i] ? 'Ya,' : 'Tidak').
							(@$r['data_skk']['tglPemeriksaanPAP_TT'.$i] ? " tanggal ".date('d-m-Y', strtotime(@$r['data_skk']['tglPemeriksaanPAP_TT'.$i])) : '').
							(@$r['data_skk']['hasilPemeriksaanPAP_TT'.$i] ? " hasilnya ".@$r['data_skk']['hasilPemeriksaanPAP_TT'.$i] : '')
						, $this->border, 'J');
					}
				}
			}
		}
		
		// Identitas Pemegang Polis
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Identitas Pemegang Polis', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nama Lengkap', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['namaLengkapPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Alias', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['namaAliasPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor KTP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['nomorKTPPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tanggal Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, date('d-m-Y', strtotime(@$r['data_diri_pemegang_polis']['tglLahirPempol'])), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Tempat Lahir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['tempatLahirPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor NPWP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['nomorNPWPPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Jenis Kelamin', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$genders[@$r['data_diri_pemegang_polis']['jenkelPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Agama', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$agamas[@$r['data_diri_pemegang_polis']['agamaPempol']], $this->border, 1, 'L');
		if ($this->GetY() >= 225) {
			$this->AddPage();
		}
		$this->Cell(50, $this->height, 'Swafoto', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Image(FCPATH.$selficpp, $this->GetX(), $this->GetY(), 0, $this->selfi_h);
		$this->SetY($this->GetY()+$this->selfi_h);
		
		// Alamat KTP Pemegang Polis
		$this->ln(2);
		$this->SetFont('Monserrat', '', 8);
		$this->Cell($this->PG_W, $this->height+2, 'Alamat KTP Pemegang Polis', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Status', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$statustinggal[@$r['data_diri_pemegang_polis']['statusTinggalKTPPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['alamatKTPPempol'], $this->border, 'J');
		$this->Cell(50, $this->height, 'Provinsi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$provinsi[@$r['data_diri_pemegang_polis']['provinsiKTPPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kabupaten/Kota', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$kota[@$r['data_diri_pemegang_polis']['kabupatenKTPPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kodepos', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['kodeposKTPPempol'], $this->border, 1, 'L');
		
		// Alamat Surat Pemegang Polis
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Alamat Surat Menyurat Pemegang Polis', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Status', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['isAlamatKTPPempolSama'] ? @$statustinggal[@$r['data_diri_pemegang_polis']['statusTinggalKTPPempol']] : @$statustinggal[@$r['data_diri_pemegang_polis']['statusTinggalSuratPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->MultiCell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['isAlamatKTPPempolSama'] ? @$r['data_diri_pemegang_polis']['alamatKTPPempol'] : @$r['data_diri_pemegang_polis']['alamatSuratPempol'], $this->border, 'J');
		$this->Cell(50, $this->height, 'Provinsi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['isAlamatKTPPempolSama'] ? @$provinsi[@$r['data_diri_pemegang_polis']['provinsiKTPPempol']] : @$provinsi[@$r['data_diri_pemegang_polis']['provinsiSuratPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kabupaten/Kota', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['isAlamatKTPPempolSama'] ? @$kota[@$r['data_diri_pemegang_polis']['kabupatenKTPPempol']] : @$kota[@$r['data_diri_pemegang_polis']['kabupatenSuratPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kodepos', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['isAlamatKTPPempolSama'] ? @$r['data_diri_pemegang_polis']['kodeposKTPPempol'] : @$r['data_diri_pemegang_polis']['kodeposSuratPempol'], $this->border, 1, 'L');
		
		// Kontak dan Telepon Pemegang Polis
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Kontak dan Telepon', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nomor HP', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['nomorHpPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor Telepon', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['nomorTelpPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Email', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['emailPempol'], $this->border, 1, 'L');
		
		// Setuju 
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Persetujuan Agar Dapat Dihubungi', $this->border, 1, 'L', true);
		$this->Cell($this->PG_W, $this->height, (@$r['data_diri_pemegang_polis']['isSetujuHPPempol'] ? 'Saya ' : 'Saya Tidak ').'Setuju Ditelepon Melalui HP/Telepon.', $this->border, 1, 'L');
		$this->Cell($this->PG_W, $this->height, (@$r['data_diri_pemegang_polis']['isSetujuEmailPempol'] ? 'Saya ' : 'Saya Tidak ').'Setuju Dihubungi Melalui Email.', $this->border, 1, 'L');
		
		// Data Pendukung Pemegang Polis
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Data Pendukung Pemegang Polis', $this->border, 1, 'L', true);
		$this->MultiCell($this->PG_W, $this->height, 'Hubungan Dengan Tertanggung Utama : '.@$hubungans[@$r['data_diri_pemegang_polis']['hubdgnTertanggung']], $this->border, 'L');
		$this->Cell(50, $this->height, 'Tinggi Badan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['tinggiBadanPempol'].'cm', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Berat Badan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['beratBadanPempol'].'kg', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Ibu Kandung', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['namaIbuPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendidikan Terakhir', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['pendidikanPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Status Pernikahan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$statusnikah[@$r['data_diri_pemegang_polis']['statusNikahPempol']], $this->border, 1, 'L');
		if (in_array(@$r['data_produk']['jenisAsuransi'], array('PAA', 'PAB'))) {
			$this->MultiCell($this->PG_W, $this->height, 'Pernah mengajukan permohonan Asuransi Personal Accident, namun ditolak dengan alasan : '.@$r['data_diri_pemegang_polis']['ditolakPA'], $this->border, 'L');
		}
		
		// Pekerjaan Pemegang Polis
		// var_dump(expression)
		$pekerjaanPempol = '';
		foreach (@$r['pekerjaan'] as $i => $v) {
			if(@$r['data_pekerjaan_pempol']['pekerjaanPempol']  == $v['KDPEKERJAAN']){
				$pekerjaanPempol = $v['NAMAPEKERJAAN'];
			}
		}

		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pekerjaan Pemegang Polis', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Pekerjaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $pekerjaanPempol, $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pangkat/Golongan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$pangkat[@$r['data_pekerjaan_pempol']['pangkatPempol']], $this->border, 1, 'L');
		
		// Pendapatan Pemegang Polis
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pendapatan Setahun', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Gaji', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Gaji Pempol **/
		if(@$r['data_pekerjaan_pempol']['rangeGajiPempolJmlLainnya'] == '' || @$r['data_pekerjaan_pempol']['rangeGajiPempolJmlLainnya'] == null){
			@$r['data_pekerjaan_pempol']['rangeGajiPempolJmlLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangeGajiPempolJmlLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Penghasilan Suami/Istri', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Range Pendapatan **/
		if(@$r['data_pekerjaan_pempol']['rangePendapatanPasanganPempolLainnya'] == '' || @$r['data_pekerjaan_pempol']['rangePendapatanPasanganPempolLainnya'] == null){
			@$r['data_pekerjaan_pempol']['rangePendapatanPasanganPempolLainnya'] = 0;
		}

		$this->Cell(70, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangePendapatanPasanganPempolLainnya']*1, 0, ',', '.'), $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Usia Produktif Suami/Istri', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Usia  **/
		if(@$r['data_pekerjaan_pempol']['usiaProduktifPasanganPempol'] == '' || @$r['data_pekerjaan_pempol']['usiaProduktifPasanganPempol'] == null){
			@$r['data_pekerjaan_pempol']['usiaProduktifPasanganPempol'] = '-';
		}

		$this->Cell(30, $this->height, @$r['data_pekerjaan_pempol']['usiaProduktifPasanganPempol'].' Tahun', $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendapatan Hasil Investasi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		if(@$r['data_pekerjaan_pempol']['rangeHasilInvestasiPempolLainnya'] == '' || @$r['data_pekerjaan_pempol']['rangeHasilInvestasiPempolLainnya'] == null){
			@$r['data_pekerjaan_pempol']['rangeHasilInvestasiPempolLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangeHasilInvestasiPempolLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendapatan Hasil Bisnis', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		if(@$r['data_pekerjaan_pempol']['rangeBisnisPempolLainnya'] == '' || @$r['data_pekerjaan_pempol']['rangeBisnisPempolLainnya'] == null){
			@$r['data_pekerjaan_pempol']['rangeBisnisPempolLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangeBisnisPempolLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Bonus/Investasi/Komisi', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		if(@$r['data_pekerjaan_pempol']['rangeBonusPempolLainnya'] == '' || @$r['data_pekerjaan_pempol']['rangeBonusPempolLainnya'] == null){
			@$r['data_pekerjaan_pempol']['rangeBonusPempolLainnya'] = 0;
		}

		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangeBonusPempolLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Pendapatan Orang Tua', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		if(@$r['data_pekerjaan_pempol']['rangePendapatanOrangTuaPempolLainnya'] == '' || @$r['data_pekerjaan_pempol']['rangePendapatanOrangTuaPempolLainnya'] == null){
			@$r['data_pekerjaan_pempol']['rangePendapatanOrangTuaPempolLainnya'] = 0;
		}

		$this->Cell(70, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangePendapatanOrangTuaPempolLainnya']*1, 0, ',', '.'), $this->border, 0, 'L');
		$this->Cell(50, $this->height, 'Usia Produktif Orang Tua', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Usia  **/
		if(@$r['data_pekerjaan_pempol']['usiaProduktifOrangTuaPempol'] == '' || @$r['data_pekerjaan_pempol']['usiaProduktifOrangTuaPempol'] == null){
			@$r['data_pekerjaan_pempol']['usiaProduktifOrangTuaPempol'] = '-';
		}


		$this->Cell(50, $this->height, @$r['data_pekerjaan_pempol']['usiaProduktifOrangTuaPempol'].' Tahun', $this->border, 1, 'L');


		$this->Cell(50, $this->height, 'Pendapatan Lain', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		/** Test **/
		if(@$r['data_pekerjaan_pempol']['rangePendapatanPempolLainnya'] == null || @$r['data_pekerjaan_pempol']['rangePendapatanPempolLainnya'] == ''){
			@$r['data_pekerjaan_pempol']['rangePendapatanPempolLainnya'] = 0;
		}
		$this->Cell($this->PG_W-52, $this->height, number_format(@$r['data_pekerjaan_pempol']['rangePendapatanPempolLainnya']*1, 0, ',', '.'), $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Sumber Pendapatan Lain', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');

		/** Test **/
		if(@$r['data_pekerjaan_pempol']['sumberPendapatanLainnya'] == null || @$r['data_pekerjaan_pempol']['sumberPendapatanLainnya'] == ''){
			@$r['data_pekerjaan_pempol']['sumberPendapatanLainnya'] = '-';
		}

		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['sumberPendapatanLainnya'], $this->border, 1, 'L');
		
		// Wiraswasta
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Jika Usaha Sendiri (Wiraswasta)', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Kepemilikan Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['pemilikWirausahaPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Bidang Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['bidangWirausahaPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['namaWirausahaPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat Usaha', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['alamatWirausahaPempol'], $this->border, 1, 'L');
		
		// Perusahaan Bekerja
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Perusahaan Tempat Bekerja', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Jenis Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$perusahaan[@$r['data_pekerjaan_pempol']['jenisPerusahaanPempol']], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nama Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['namaPerusahaanPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Alamat Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['alamatPerusahaanPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Kodepos Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['kodeposPerusahaanPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Telepon Perusahaan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['nomorTeleponPerusahaanPempol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Ekstension', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_pekerjaan_pempol']['nomorEkstensiPerusahaanPempol'], $this->border, 1, 'L');


		// Data Kewajiban Pajak Luar Negeri

		if(@$r['data_pekerjaan_pempol']['negaraWajibPajakLuarNegeri'] != null || @$r['data_pekerjaan_pempol']['negaraWajibPajakLuarNegeri'] != ''){
			$negaraWajibPajakLuarNegeri = @$r['data_pekerjaan_pempol']['negaraWajibPajakLuarNegeri'];
		}else{
			$negaraWajibPajakLuarNegeri = '-';
		}

		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Data Kewajiban Pajak Luar Negeri', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Negara', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $negaraWajibPajakLuarNegeri, $this->border, 1, 'L');

		if(@$r['data_pekerjaan_pempol']['tinWajibPajakLuarNegeri'] != null || @$r['data_pekerjaan_pempol']['tinWajibPajakLuarNegeri'] != ''){
			$tinWajibPajakLuarNegeri = @$r['data_pekerjaan_pempol']['tinWajibPajakLuarNegeri'];
		}else{
			$tinWajibPajakLuarNegeri = '-';
		}

		$this->Cell(50, $this->height, 'Nomor Wajib Pajak', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $tinWajibPajakLuarNegeri, $this->border, 1, 'L');

		if(@$r['data_pekerjaan_pempol']['jelaskanWajibPajakLuarNegeri'] != null || @$r['data_pekerjaan_pempol']['jelaskanWajibPajakLuarNegeri'] != ''){
			$jelaskanWajibPajakLuarNegeri = @$r['data_pekerjaan_pempol']['jelaskanWajibPajakLuarNegeri'];
		}else{
			$jelaskanWajibPajakLuarNegeri = '-';
		}

		$this->Cell(54, $this->height, 'Alasan Jika Tidak Ada TIN, Jelaskan', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, $jelaskanWajibPajakLuarNegeri, $this->border, 1, 'L');

		// Rekening Pemegang Polis
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Rekening Pemegang polis', $this->border, 1, 'L', true);
		$this->Cell(50, $this->height, 'Nama Bank', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['namaBankPemPol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Cabang Bank', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['cabangBankPemPol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Nomor Rekening', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['nomorRekeningPemPol'], $this->border, 1, 'L');
		$this->Cell(50, $this->height, 'Atas Nama', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Cell($this->PG_W-52, $this->height, @$r['data_diri_pemegang_polis']['namaRekeningPemPol'], $this->border, 1, 'L');
		
		// Pernyataan Pemegang Polis

		// UAT 20012023
		$txtSKK = ' ';
		if(!in_array(@$r['data_produk']['jenisAsuransi'], $premierAnnuity)){
			$txtSKK = ' dan SKK ';
		}
		
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pernyataan Pemegang Polis', $this->border, 1, 'L', true);
		if (substr(@$r['data_produk']['jenisAsuransi'], 0, 2) == 'PA') {
			$this->MultiCell($this->PG_W, $this->height, 'Dengan ini saya/kami sebagai Calon Pemegang Polis dan/atau Calon Tertanggung atas nama sendiri dengan ini menyatakan dan menyetujui :', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Seluruh keterangan, informasi dan pernyataan yang tertulis di dalam SPA IFG Personal Accident serta dokumen lainnya sebagai dokumen pendukung SPA Personal Accident ini telah saya berikan sesuai dengan apa yang saya ketahui secara lengkap dan benar, dan akan menjadi dasar dari ketentuan-ketentuan dalam Polis.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Dalam hal SPA IFG Personal Accident ditulis oleh Agen penutup adalah semata-mata membantu saya untuk mempercepat proses penutupan asuransi ini yang didasarkan atas keinginan dari saya, seluruh isian yang tercantum didalamnya sudah saya ketahui kebenarannya sebelum saya tandatangani karena seluruh jawaban yang tertulis dalam SPA IFG Personal Accident tersebut berasal dari informasi saya kepada Agen Penutup yang bersangkutan.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Tunduk dan mengikat diri pada ketentuan-ketentuan dalam Syarat-syarat Umum Polis Asuransi dan Ketentuan Khusus Polis Asuransi PT Asuransi Jiwa IFG.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Saya mengerti dan telah mendapat penjelasan bahwa Pertanggungan akan dimulai sejak tanggal berlakunya Polis seperti yang tertera pada Polis.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Memberi kuasa kepada dokter, klinik / laboratorium, Rumah Sakit, perusahaan asuransi, badan hukum, instansi lain, organisasi lain atau perorangan, yang memiliki catatan atau mengetahui keadaan atau riwayat kesehatan saya, riwayat pengobatan atau perawatan di rumah sakit, untuk memberitahu kepada PT Asuransi Jiwa IFG atau yang ditunjuk oleh PT Asuransi Jiwa IFG. Kuasa ini tidak berakhir dengan sebab apapun, termasuk meninggalnya saya/kami maupun sebab-sebab yang disebutkan dalam Pasal 1813, 1814 dan 1816 Kitab Undang-undang Hukum Perdata Indonesia.', $this->border, 'J');
		} else {
			$this->MultiCell($this->PG_W, $this->height, 'Dengan ini saya/kami sebagai Calon Pemegang Polis dan/atau Calon Tertanggung atas nama sendiri dengan ini menyatakan dan menyetujui :', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Seluruh keterangan, informasi dan pernyataan yang tertulis di dalam SPAJ'.$txtSKK.'serta dokumen lainnya sebagai dokumen pendukung SPAJ ini telah Pemberi Pernyataan berikan sesuai dengan apa yang pihaknya ketahui secara lengkap dan benar, dan akan menjadi dasar dari ketentuan-ketentuan dalam Polis.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Semua keterangan, isian yang telah Pemberi Pernyataan sampaikan kepada PT Asuransi Jiwa IFG dan telah Pemberi Pernyataan tuliskan di dalam SPAJ'.$txtSKK.'ini adalah benar adanya, tanpa ada hal-hal lain yang Pemberi Pernyataan sembunyikan, tanpa ada tekanan ataupun paksaan dari siapaun juga dan Pemberi Pernyataan buat dalam keadaan sadar.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Dalam hal SPAJ'.$txtSKK.'ini dituliskan oleh Agen Penutup adalah semata-mata membantu Pemberi Pernyataan untuk mempercepat proses penutupan asuransi ini yang didasarkan atas keinginan dan persetujuan dari Pemberi Pernyataan, seluruh isian yang tercantum di dalamnya sudah Pemberi Pernyataan ketahui kebenarannya sebelum Pemberi Pernyataan tandatangani karena seluruh jawaban yang tertulis dalam SPAJ'.$txtSKK.'tersebut berasal dari informasi yang telah diberikan Pemberi Pernyataan kepada Agen Penutup yang bersangkutan.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Tunduk dan mengikatkan diri pada ketentuan-ketentuan dalam Polis, Syarat-syarat Umum Polis Asuransi dan Ketentuan Khusus Polis Asuransi PT Asuransi Jiwa IFG serta peraturan perundang-undangan yang berlaku di Indonesia.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Seluruh Transaksi yang dilakukan Calon Pemegang Polis pada PT Asuransi Jiwa IFG berdasarkan SPAJ ini tidak berasal dari Tindakan pidana pencucian uang (money laundering) sebagaimana dimaksud dalam undang-undang tentang pencegahan dan pemberantasan tindak pidana pencucian uang beserta perubahannya di kemudian hari dari waktu ke waktu. Tidak akan melakukan praktik suap, gratifikasi, serta tindakan yang mengarah pada Korupsi, Kolusi dan Nepotisme (KKN). Apabila ada indikasi pelanggaran atas undang-undang dimaksud, maka PT Asuransi Jiwa IFG akan melaksanakan kewajibannya sesuai dengan ketentuan yang berlaku, termasuk melakukan kewajiban pelaporan atas transaksi keuangan yang mencurigakan.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Pemberi Pernyataan mengerti dan telah mendapatkan penjelasan mengenai :', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Pertanggungan akan dimulai sejak Tanggal Berlakunya Polis yang tertera pada Polis atau dalam Perubahan Polis (lampiran/klausula Polis) dengan ketentuan bahwa Premi pertama telah dilunasi.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Bahwa Pemberi Pernyataan dapat membatalkan maksud Pemberi Pernyataan untuk mempertanggungkan diri Tertanggung berdasarkan Polis yang akan diterbitkan oleh PT Asuransi Jiwa IFG dengan mengembalikan Polis yang Pemberi Pernyataan terima dalam jangka waktu 14 (empat belas) hari kalender sejak tanggal Polis diterima oleh Pemberi Pernyataan.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Apabila Pemberi Pernyataan membatalkan Polis sebagaimana dimaksud butir b angka ini dan terdapat Pengembalian Premi pertama maka PT Asuransi Jiwa IFG akan melakukan transfer ke rekening yang telah disampaikan dalam SPAJ ini.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Kecuali ditentukan lain berdasarkan peraturan perundang-undangan yang berlaku, transaksi penarikan Nilai Tunai/penebusan Polis yang dilakukan tidak dikenakan Pajak.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Jika Pembayaran Premi dilakukan secara Regular/Berkala, maka Pembayaran Premi Regular/Berkala Lanjutan dilakukan secara non tunai yaitu melalui transfer atau sarana lain yang disediakan oleh Penanggung.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Bahwa semua data Calon Pemegang Polis maupun Calon Tertanggung yang tercantum di dalam Surat Permintaan Asuransi Jiwa dan seluruh data yang ada, di kemudian hari dapat dipergunakan oleh PT Asuransi Jiwa IFG untuk memberikan pelayanan atas SPAJ dan/atau Polis setelah diterbitkan dan memberi informasi produk terbaru dan informasi terkait lainnya.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Memberi kuasa kepada dokter, klinik / laboratorium, Rumah Sakit, perusahaan asuransi, badan hukum, instansi lain, organisasi lain atau perorangan, yang memiliki catatan atau mengetahui keadaan atau Riwayat Kesehatan Pemberi Pernyataan atau suami/istri atau putra/putri Pemberi Pernyataan, riwayat pengobatan atau perawatan di rumah sakit, untuk memberitahu kepada PT Asuransi Jiwa IFG atau pihak lain yang ditunjuk oleh PT Asuransi Jiwa IFG. Kuasa ini tidak berakhir dengan sebab apapun, termasuk meninggalnya Pemberi Pernyataan maupun sebab-sebab yang disebutkan dalam Pasal 1813, 1814 dan 1816 Kitab Undang-undang Hukum Perdata Indonesia.', $this->border, 'J');
		}		
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Saya menyetujui atas Proposal dengan build id : '.@$r['proposal_build_id'], $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Polis Dikirim ke : '.@$kirimpolis[@$r['data_persetujuan']['kirimPolisKe']], $this->border, 'J');
				
		// Pernyataan Khusus Pembentukan Unit
		if (substr(@$r['data_produk']['jenisAsuransi'], 0, 2) == 'JL') {
			$this->ln(2);
			$this->Cell($this->PG_W, $this->height+2, 'Pernyataan Khusus Pembentukan Unit', $this->border, 1, 'L', true);
			$this->MultiCell($this->PG_W, $this->height, 'Saya menyatakan bahwa saya telah membaca dan menyetujui Pernyataan Khusus Pembentukan Unit Premi pertama di bawah ini :', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Bahwa Saya/Kami yang memberikan tanda tangan di bawah ini telah mendapatkan penjelasan secara menyeluruh dari Agen Penutup dan selanjutnya mengerti dan menerima (khusus produk IFG Life Prime Protection & IFG Life Ultimate Protection) mengenai :', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Unit awal akan dibentuk dalam Polis berdasarkan harga unit yang akan ditentukan pada tanggal perhitungan berikutnya pada tanggal Polis di terbitkan.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Apabila Unit yang terbentuk dari Premi Regular di tahun ke-1 tidak mencukupi untuk membayar Biaya Asuransi dan Administrasi, maka kekurangan pembayaran tersebut dinyatakan sebagai biaya terhutang yang akan diperhitungkan dari unit yang terbentuk dari Premi Regular, Top Up Premi Regular dan Top Up Premi Single (jika ada) di bulan ke 13 Masa Asuransi.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Pertanggungan dan/atau Polis menjadi batal apabila keterangan, pernyataan atau pemberitahuan yang disampaikan kepada PT Asuransi Jiwa IFG ternyata tidak benar atau keliru yang sifatnya sedemikian rupa sehingga pertanggugan dan/atau Polis tidak akan diadakan atau tidak diadakan dengan syarat-syarat yang sama bila PT Asuransi Jiwa IFG mengetahui keadaan yang sesungguhnya tersebut.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Adanya biaya Akuisisi yaitu biaya yang dikenakan sehubungan dengan permohonan pertanggungan dan penerbitan Polis yang telah ditetapkan besarannya dan dikenakan sampai dengan masa tertentu.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Adanya Biaya Asuransi bulanan yang besarnya tergantung dari besarnya Uang Asuransi Dasar dan Uang Asuransi Tambahan (jika ada), Usia Tertanggung, Jenis Kelamin Tertanggung, Merokok atau tidaknya Tertanggung, Kelas Pekerjaan, Kesehatan Tertanggung dan ditambah Biaya Administrasi Bulanan.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Segala resiko pemilihan jenis alokasi dinvestasi menjadi tanggung jawab saya/kami.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Manfaat Asuransi Dasar dan Asuransi Tambahan termasuk syarat-syarat dan pengecualian yang tercantum dalam Polis Asuransi.', $this->border, 'J');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-5, $this->height, 'Saya/Kami menyatakan dengan sesungguhnya bahwa Saya/Kami telah membaca dan menyetujui Pernyataan Khusus Pembentukan Unit Premi pertama di bawah ini:', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Harga Unit yang digunakan pada Premi Pertama akan terbentuk setelah diterimanya SPAJ lengkap, teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat oleh Penanggung. Tanggal Perhitungan Harga Unit dalah Tanggal Perhitungan berikutnya setelah diterimanya SPAJ lengkap, teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat atau data SPAJ telah dientri melalui sistem, mana yang paling akhir.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Saya/Kami tidak dapat mengajukan perubahan besar nilai Premi, Jenis Dana Investasi dan Alokasi Dana Investasi sebelum Polis terbit.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Jika pengajuan asuransi saya dikenakan keputusan substandard dan terdapat perubahan nominal Premi maupun komposisi Premi, maka Tanggal Perhitungan Harga Unit menjadi Tanggal Perhitungan berikutnya setelah diterimanya surat persetujuan keputusan substandard atas SPAJ ini atau teridentifikasinya seluruh pembayaran Premi pertama di Kantor Pusat, mana yang paling akhir.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Pembayaran Premi Pertama untuk pembentukan Unit dilakukan melalui mekanisme Host To Host.', $this->border, 'J');
			$this->Cell(5, $this->height, '', $this->border, 0, 'L');
			$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
			$this->MultiCell($this->PG_W-10, $this->height, 'Untuk pembayaran Premi lanjutan, Tanggal Perhitungan Harga Unit untuk Premi Lanjutan adalah tanggal Perhitungan berikutnya setelah Premi lanjutan tersebut terindentifikasi di Kantor Pusat atau tanggal Polis terbit, mana yang paling akhir.', $this->border, 'J');
		}
		
		// Pernyataan Agen
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Pernyataan Agen Penutup', $this->border, 1, 'L', true);
		$this->MultiCell($this->PG_W, $this->height, 'Dengan Ini saya menyatakan bahwa :', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Saya mengenal Calon Pemegang Polis/Calon Tertanggung/Calon pembayar premi selama : '.@$r['data_persetujuan']['agenMengenalSelama'], $this->border, 'L');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Semua keterangan yang terdapat di SPAJ ini adalah semata-mata keterangan yang diberikan oleh Calon Pemegang Polis/Calon Tertanggung/Calon Pembayar Premi, saya tidak menyembunyikan informasi atau keterangan apapun yang telah diberikan oleh Calon Pemegang Polis/Calon Tertanggung/Calon Pembayar Premi yang dapat mempengaruhi penerimaan SPAJ ini.', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Saya telah menerangkan semua isi butir pernyataan di SPAJ dengan jelas dan menjelaskan informasi/ keterangan mengenai produk asuransi dan manfaatnya sesuai dengan Syarat Umum Polis dan/atau Syarat-Syarat Umum Polis dan Ketentuan Khusus Polis Asuransi, termasuk menjelaskan bahwa jawaban yang tidak benar pada pengisian SPAJ akan berakibat klaim tidak dibayarkan serta berakibat batalnya polis.', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Dalam hal saya membantu Calon Pemegang Polis/Calon Tertanggung mengisi SPAJ'.$txtSKK.'ini adalah semata-mata membantu berdasarkan keinginan dan permintaan Calon Pemegang Polis/Calon Tertanggung untuk mempercepat proses penutupan asuransi, dimana seluruh isian yang tercantum didalamnya sudah saya konfirmasi kebenarannya kepada Calon Pemegang Polis/Calon Tertanggung sebelum SPAJ'.$txtSKK.'ini ditandatangani oleh Calon Pemegang Polis/Calon Tertanggung.', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Calon Pemegang Polis/Calon Tertanggung/Calon Pembayar Premi adalah benar seorang yang berkepribadian baik dan jujur dalam segala urusan.', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Saya telah bertemu dan melihat secara langsung kondisi terakhir Calon Tertanggung pada saat SPAJ ini diisi dan ditandatangani serta mengecek kebenaran dan kelengkapan pengisiannya.', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Tertanggung dalam keadaan '.(@$r['data_persetujuan']['nyatakanTertanggungUtamaSehat'] == 'TTU_SEHAT' ? 'sehat' : 'tidak sehat').' sewaktu mengisi SPAJ ini', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Premi yang dibayar '.(@$r['data_persetujuan']['nyatakanSesuaiKondisiKeuangan'] == 'CPP_SESUAI' ? 'sudah' : 'tidak').' sesuai dengan kondisi keuangan Calon Pemegang Polis atau Calon Pembayar Premi untuk kelangsungan polis yang diajukan', $this->border, 'J');
		$this->Cell(5, $this->height, '-', $this->border, 0, 'L');
		$this->MultiCell($this->PG_W-5, $this->height, 'Yang memulai proses penutupan/closing asuransi jiwa ini adalah : '.(@$r['data_persetujuan']['penutupOleh'] == 'LAINNYA' ? @$r['data_persetujuan']['penutupOlehLainnya'] : @$penutup[@$r['data_persetujuan']['penutupOleh']]), $this->border, 'J');

				
		// Tanda Tangan
		
		// $this->ln(2);
		// $this->Cell($this->PG_W, $this->height, 'Dengan ini Pemegang Polis telah mengerti dan menyetujui hal-hal sebagai berikut:', $this->border, 1, 'L');
				// Setuju 
		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Dengan ini Pemegang Polis telah mengerti dan menyetujui hal-hal sebagai berikut:', $this->border, 1, 'L', true);
		$this->MultiCell($this->PG_W, $this->height,'Pemegang Polis wajib melakukan pembayaran premi asuransi melalui kanal/channel pembayaran resmi yang telah disediakan oleh Perusahaan.', 0, 'J');
		$this->MultiCell($this->PG_W, $this->height, 'Perusahaan hanya mengakui pembayaran premi asuransi yang dilakukan Pemegang Polis melalui kanal/channel pembayaran resmi yang disediakan Perusahaan.', 0, 'J');


		$this->ln(2);
		$this->Cell($this->PG_W, $this->height+2, 'Tanda Tangan', $this->border, 1, 'L', true);
		if ($this->GetY() >= 265) {
			$this->AddPage();
		}
		$this->Cell(50, $this->height, 'Tertanggung Utama', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Image(FCPATH.$ttdctu, $this->GetX(), $this->GetY(), 0, $this->ttd_h);
		$this->SetY($this->GetY()+$this->ttd_h);
		if ($this->GetY() >= 265) {
			$this->AddPage();
		}
		$this->Cell(50, $this->height, 'Pemegang Polis', $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Image(FCPATH.$ttdcpp, $this->GetX(), $this->GetY(), 0, $this->ttd_h);
		$this->SetY($this->GetY()+$this->ttd_h);
		if ($this->GetY() >= 265) {
			$this->AddPage();
		}
		$this->Cell(50, $this->height, 'Agen'.$this->GetY(), $this->border, 0, 'L');
		$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
		$this->Image(FCPATH.$ttdagn, $this->GetX(), $this->GetY(), 0, $this->ttd_h);
		$this->SetY($this->GetY()+$this->ttd_h);
		
		// Dokumen
		if (@$r['data_dokumen']) {
			$this->ln(2);
			$this->Cell($this->PG_W, $this->height+2, 'Dokumen', $this->border, 1, 'L', true);
			
			foreach (@$r['data_dokumen'] as $i => $v) {
				$dokumen[$i] = $this->genImageFromBase64(@$r['proposal_build_id']."_dokumen_$i", base64_decode(base64_decode(@$v['camDokumen'])));
				
				$this->Cell(50, $this->height, 'Tipe', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$tipedokumen[@$v['selectTipeDokumen']], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Nama', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$v['addNamaDokumen'], $this->border, 1, 'L');
				$this->Cell(50, $this->height, 'Keterangan', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Cell($this->PG_W-52, $this->height, @$v['addKeteranganDokumen'], $this->border, 1, 'L');
				if ($this->GetY() >= 225) {
					$this->AddPage();
				}
				$this->Cell(50, $this->height, 'File', $this->border, 0, 'L');
				$this->Cell(2, $this->height, ':', $this->border, 0, 'C');
				$this->Image(FCPATH.$dokumen[$i], $this->GetX(), $this->GetY(), 0, $this->selfi_h);
				$this->SetY($this->GetY()+$this->selfi_h);
				
				$this->delImageFromTmp($dokumen[$i]);
			}
		}
				
		// Deleting temp files
		$this->delImageFromTmp($selfictu);
		$this->delImageFromTmp($selficpp);
		$this->delImageFromTmp($ttdctu);
		$this->delImageFromTmp($ttdcpp);
		$this->delImageFromTmp($ttdagn);
	}
	
	private function genImageFromBase64($name, $imgdata) { //echo $imgdata." ";
		$extension = @explode('/', mime_content_type($imgdata))[1];
		$filename = "asset/tmp/$name.$extension";
		
		//file_put_contents('');
		@file_put_contents($filename, @file_get_contents($imgdata));
		
		return $filename;
	}
	
	private function delImageFromTmp($file) {
		@unlink($file);
	}
}

$pdf = new SPAJPDF($spaj);
$pdf->Output();
?>