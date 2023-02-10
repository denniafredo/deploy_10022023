<?php
//echo 'masuk ddn'; die;
    /*  */
    //include '../include/config.php'; 
    //include '../include/authentication.php';
	include "../../includes/database.php";
	include './libs/PHPMailer/class.phpmailer.php';
    require('./libs/fpdf/fpdf.php');
    

	class PDF extends FPDF
	{
	// Page header
	function Header()
	{
		// Logo
		//$this->Image('logo.png',10,6,30);
		// Arial bold 15
		//$this->SetFont('Arial','B',15);
		// Move to the right
		//$this->Cell(80);
		// Title
		//$this->Cell(30,10,'Title',1,0,'C');
		// Line break
		//$this->Ln(20);
	}

	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	}
	
	//** GENERATE DATA DULU
	$userid='JSADM';
	$passwd='JSADMOKE';
	$DB=New database($userid, $passwd, $DBName);		
	$DBx=New database($userid, $passwd, $DBName);		
	//$db = new ConnectionJL();
	//$conn = $db->Open();	
	$queryxx = "SELECT PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN,EMAIL,TO_CHAR(TGL_BOOKED,'DD/MM/YYYY') TGL_BOOKED FROM $DBUser.TABLE_KIRIM_EMAIL WHERE EMAIL IS NOT NULL and jenis = 'F' order by PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,RAYONPENAGIHAN";
	//echo $query;
	//$dbxx->Parse($queryxx);
	//$dbxx->Execute();
	$DBx->parse($queryxx);
	$DBx->execute();
	while ($rowxx=$DBx->nextrow()) {		
	//while ($rowxx = oci_fetch_array($dbxx->get_statement())) {
		
		// Instanciation of inherited class
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont('Times','',12);
		
		$prefixpertanggungan = $rowxx['PREFIXPERTANGGUNGAN'];
		$nopertanggungan = $rowxx['NOPERTANGGUNGAN'];
		$kdkantor = $rowxx['RAYONPENAGIHAN'];
		$email = $rowxx['EMAIL'];
		$tglexp = $rowxx['TGL_BOOKED'];
		
		echo 'Kirim email ke '.$prefixpertanggungan.$nopertanggungan.$kdkantor.'<br>';
		
			$queryx = "SELECT   ptg.prefixpertanggungan PREFIXPERTANGGUNGAN,
						 ptg.nopertanggungan NOPERTANGGUNGAN,
						 nvl(ptg.nopol,ptg.prefixpertanggungan||ptg.nopertanggungan) nopol,
						 ptg.notertanggung,
						 DECODE (ptg.indexawal, 0, 1, ptg.indexawal) indexawal,
						 TO_CHAR (SYSDATE, 'dd/mm/yyyy') tgl,         
						 TO_CHAR (mulas, 'DD/MM/YYYY') MULAS,
						 to_char(expirasi,'dd/mm/yyyy') expirasi,
						 case when expirasi < sysdate then 'sudah' else 'akan' end akansudah,
						 (SELECT   GRACEPERIODE * 30
							FROM   $DBUser.TABEL_241_GRACE_PERIODE
						   WHERE   kdproduk = ptg.kdproduk)
							gp,
						 (SELECT   NAMACARABAYAR
							FROM   $DBUser.TABEL_305_CARA_BAYAR
						   WHERE   kdcarabayar = ptg.kdcarabayar)
							CARA,
						 (SELECT   NAMAVALUTA
							FROM   $DBUser.TABEL_304_VALUTA
						   WHERE   kdvaluta = ptg.kdvaluta)
							valuta,
						 (SELECT   namaproduk
							FROM   $DBUser.TABEL_202_PRODUK
						   WHERE   kdproduk = ptg.kdproduk)
							produk,
						 (SELECT   namaklien1
							FROM   $DBUser.tabel_100_klien kli
						   WHERE   kli.noklien = ptg.nopemegangpolis)
							PEMPOL,
						 (SELECT   namaklien1
							FROM   $DBUser.tabel_100_klien kli
						   WHERE   kli.noklien = ptg.notertanggung)
							TERTANGGUNG,							 
						 (SELECT   COALESCE(NO_PONSEL,PHONETAGIH01,PHONETAGIH02)
							FROM   $DBUser.tabel_100_klien kli
						   WHERE   kli.noklien = ptg.notertanggung)
							NO_HP,
						 (SELECT   COALESCE(PHONETAGIH01,PHONETAGIH02,NO_PONSEL)
							FROM   $DBUser.tabel_100_klien kli
						   WHERE   kli.noklien = ptg.notertanggung)
							NO_TELP,	
						 (SELECT (SELECT NAMAHUBUNGAN FROM $DBUser.TABEL_218_KODE_HUBUNGAN WHERE KDHUBUNGAN = A.KDINSURABLE)
						  FROM $DBUser.TABEL_219_PEMEGANG_POLIS_BAW A
						  WHERE NOPERTANGGUNGAN = ptg.nopertanggungan
						  AND PREFIXPERTANGGUNGAN = ptg.prefixpertanggungan         
						  AND NOKLIEN = ptg.nopemegangpolis) HUBUNGAN,		
						 (SELECT   alamattagih01 || ' ' || alamattagih02
							FROM   $DBUser.tabel_100_klien kli
						   WHERE   kli.noklien = ptg.notertanggung)
							ALAMAT,
						 (SELECT   DECODE (jeniskelamin,
										   'P', 'Ibu',
										   'L', 'Bapak',
										   'Bapak/Ibu')
							FROM   $DBUser.tabel_100_klien kli
						   WHERE   kli.noklien = ptg.nopemegangpolis)
							anda,
						 (SELECT   namakotamadya
							FROM   $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
						   WHERE   kli.noklien = ptg.notertanggung
								   AND kdkotamadyatagih = kdkotamadya)
							KOTA,
							(SELECT   to_char(expirasi,'dd/mm/yyyy')||namabenefit
				  FROM   $DBUser.tabel_223_transaksi_produk tpro,$DBUser.TABEL_207_KODE_BENEFIT kdbnf
				 WHERE       nopertanggungan = ptg.nopertanggungan
						 AND prefixpertanggungan = ptg.prefixpertanggungan
						 AND tpro.kdbenefit IN ('BNFTHPPT', 'BNFTHPSD', 'BNFTHPSMA', 'BNFTHPSMP')
						 AND to_char(expirasi,'dd/mm/yyyy')='$tglexp'
						 AND tpro.kdbenefit=kdbnf.kdbenefit) namabenefit,
						 (SELECT   namakantor || ' ' || alamat01 || ' ' || alamat02
				  FROM   $DBUser.tabel_001_kantor ktr,$DBUser.TABEL_500_penagih pngh
				 WHERE       kdrayonpenagih = kdkantor
						 AND nopenagih=ptg.nopenagih) namakantor
				  FROM   $DBUser.tabel_200_pertanggungan ptg
				 WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";	
	
			$query = "select TO_CHAR(sysdate,'dd/mm/yyyy') hariini,a.emailxlindo,a.email,a.emailopr,a.emailadlog, decode(a.kdjeniskantor,'1','KANTOR CABANG','2','KANTOR PERWAKILAN') jeniskantor, ".
					 "a.kdkantorinduk, a.namakantor, a.kdkantorinduk, a.alamat01,a.alamat02,a.kodepos,a.phone01,a.phone02,a.phone03,a.phone04, ".
					 "(select namakantor from $DBUser.tabel_001_kantor where kdkantor=a.kdkantorinduk) as namakantorinduk,".
					 "b.namakotamadya,c.namapropinsi,
					  (SELECT NAMAPEJABAT
					   FROM $DBUser.TABEL_002_PEJABAT A
					   WHERE KDKANTOR = '$kdkantor' 
					   AND KDORGANISASI = '163') KASIADLOG,                 
					  (SELECT NAMAPEJABAT
					   FROM $DBUser.TABEL_002_PEJABAT A
					   WHERE KDKANTOR = '$kdkantor' 
					   AND KDORGANISASI = '161') KASIOPS	
					 ".
					 "from $DBUser.tabel_001_kantor a, ".
					 "$DBUser.tabel_109_kotamadya b,$DBUser.tabel_108_propinsi c ".
					 "where a.kdkantor='$kdkantor' and ".
					 "a.kdkotamadya=b.kdkotamadya(+) and ".
					 "a.propinsi=c.kdpropinsi(+)";
					 "e.namajabatan like (select  from $DBUser.tabel_001_kantor ".
					 "where kdkantor='$kdkantor') ";
			//echo $queryx;
			$DB->parse($query);
			$DB->execute();
			$row=$DB->nextrow();
			
			//$db->Parse($query);
			//$db->Execute();
			//$i = 1;
			//$row = oci_fetch_array($db->get_statement());
			
			
			$DB->parse($queryx);
			$DB->execute();
			$rowx=$DB->nextrow();
			
			//$db->Parse($queryx);
			//$db->Execute();
			//$i = 1;
			//$rowx = oci_fetch_array($db->get_statement());
			//echo 'ini kantor '.$row['NAMAKANTOR'];
			//**** ini isi
			$pdf->SetLeftMargin(25);
			$image1 = "./libs/logo_js.jpg";
			$pdf->Ln(10);
			$pdf->Image($image1, 18, 15, 50);
			$pdf->SetFont('Arial','B',8);
			$pdf->SetLeftMargin(120);
			$pdf->Cell(70,4,'PT ASURANSI JIWA IFG',0,0,'R');
			$pdf->Ln();	
			$pdf->Cell(70,4,$row['NAMAKANTOR'],0,0,'R');
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(70,4,$row['ALAMAT01'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$row['ALAMAT02'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$row['KODEPOS'],0,0,'R');
			$pdf->Ln();
			$pdf->Cell(70,4,$row['PHONE01'],0,0,'R');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);	
			$pdf->Cell(70,4,'www.ifg-life.co.id',0,0,'R');
			$pdf->Ln(20);	
			
			
			//$pdf->Image($image1, 20, 6, 50);
			$pdf->Cell(70,4,$row['NAMAKOTAMADYA'].', '.$row['HARIINI'],0,0,'R');
			$pdf->SetLeftMargin(20);
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(95,4,'Kepada Yth.',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();		
			$pdf->Cell(95,4,$rowx["ANDA"].' '.$rowx["PEMPOL"],0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(95,4,$rowx["ALAMAT"],0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(95,4,$rowx["KOTA"],0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln(5);	
			$pdf->Cell(95,4,'Dengan Hormat,',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln(6);
			$pdf->Cell(20,4,'Perihal',0,0,'L');
			$pdf->Cell(5,4,':',0,0,'C');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'PEMBERITAHUAN JATUH TEMPO '.substr($rowx["NAMABENEFIT"],10,strlen($rowx["NAMABENEFIT"])-10).' POLIS NO : '.$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"].' / '.$rowx["NOPOL"].' KE-1',0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(20,4,'Atas Nama',0,0,'L');
			$pdf->Cell(5,4,':',0,0,'C');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(50,4,$rowx["PEMPOL"],0,0,'L');
			$pdf->Ln(10);
			$pdf->SetFont('Arial','',8);
			$pdf->MultiCell(170,4,'Berdasarkan catatan yang ada pada kami, jatuh tempo pembayaran benefit '.substr($rowx["NAMABENEFIT"],10,strlen($rowx["NAMABENEFIT"])-10).' untuk polis nomor '.$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"].' / '.$rowx["NOPOL"].' atas nama '.$rowx["PEMPOL"].' '.$rowx["AKANSUDAH"].' jatuh tempo pada tanggal '.$tglexp.'.');
			$pdf->SetFont('Arial','',8);	
			$pdf->Ln(4);
			$pdf->MultiCell(170,4,'Untuk itu kami mohon kehadiran Bapak/Ibu di PT. Asuransi Jiwa IFG '.$row['NAMAKANTOR'].' '.$row['ALAMAT01'].' '.$row['NAMAKOTAMADYA'].'.');		
			$pdf->Ln(4);
			$pdf->Cell(50,4,'dengan membawa kelengkapan berupa :',0,0,'L');
			$pdf->Ln(4);
			$pdf->Cell(50,4,'1.    Polis Asli',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(50,4,'2.    Copy Identitas (KTP, SIM)',0,0,'L');
			$pdf->Ln();
			//$pdf->Cell(50,4,'3.    Copy Identitas (KTP, SIM)',0,0,'L');
			//$pdf->Ln();
			$pdf->Ln();
			$pdf->MultiCell(170,4,'Demikian kami sampaikan, atas perhatian dan kepercayaan yang diberikan kepada PT. Asuransi Jiwa IFG selama ini kami ucapkan terima kasih.');
			$pdf->Ln(10);
			$pdf->Cell(50,4,'Hormat kami',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(50,4,'PT ASURANSI JIWA IFG',0,0,'L');
			$pdf->Ln();
			$pdf->Cell(50,4,$row['NAMAKANTOR'],0,0,'L');
			$pdf->Ln(15);
			$pdf->SetFont('Arial','',5);
			$pdf->Cell(50,4,'Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->AddPage();	
			//**** akhir isi	
			
			//** isi pengajuan
			$pdf->SetLeftMargin(145);
			//$image1 = "../images/jssor/logo_js.jpg";	
			//$pdf->SetLeftMargin(125);
			$pdf->Image($image1, 140, 5, 50);
			$pdf->Ln(20);
			$pdf->SetFont('Arial','',8);
			$pdf->SetLeftMargin(20);
			$pdf->Ln();	
			$pdf->Cell(170,4,'P E N G A J U A N  K L A I M',0,0,'C');
			$pdf->Ln();	
			$pdf->Cell(170,4,'EKSPIRASI / TAHAPAN / BERKALA / PENEBUSAN *)',0,0,'C');
			$pdf->Ln();	
			$pdf->Cell(170,4,'PERTANGGUNGAN PERORANGAN',0,0,'C');
			$pdf->Ln();	
			$pdf->Ln();	
			$pdf->Ln();	
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'A.   Diisi dan ditandatangani oleh Pemegang Polis.',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(70,4,'       1. Polis Nomor',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(50,4,$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"],0,0,'L');
			$pdf->Ln();
			$pdf->Cell(70,4,'           Nama Pemegang Polis',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(50,4,$rowx["PEMPOL"],0,0,'L');
			$pdf->Ln();
			$pdf->Cell(70,4,'           Nama Tertanggung',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(50,4,$rowx["TERTANGGUNG"],0,0,'L');
			$pdf->Ln();	
			$pdf->Ln();
			$pdf->Cell(70,4,'       2. Yang mengajukan klaim',0,0,'L');
			//$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(50,4,$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"],0,0,'L');
			$pdf->Ln();
			$pdf->Cell(70,4,'           Nama ',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(50,4,$rowx["PEMPOL"],0,0,'L');
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'           Alamat lengkap',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->MultiCell(85,4,$rowx["ALAMAT"]);
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();	
			$pdf->Cell(70,4,'           ',0,0,'L');
			$pdf->Cell(15,4,'',0,0,'C');
			//$pdf->MultiCell(85,4,$rowx["ALAMAT"]);
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();	
			$pdf->Cell(70,4,'           No. Telp / No. HP ',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(50,4,$rowx["NO_HP"].' / '.$rowx["NO_TELP"],0,0,'L');
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'           Hubungan dengan Tertanggung',0,0,'L');
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["HUBUNGAN"]);
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();	
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'B.   Hak Atas Pembayaran.',0,0,'L');	
			$pdf->Ln();	
			$pdf->Cell(70,4,'       1. Ekspirasi',0,0,'L');	
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(70,4,'           Jatuh Tempo Tanggal',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["EXPIRASI"]);	
			$pdf->Cell(85,4,'..........................................................................................................');	
			
			
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'       2. Tahapan',0,0,'L');	
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(70,4,'           Jatuh Tempo Tanggal',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["EXPIRASI"]);	
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'           Jenis Tahapan',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["EXPIRASI"]);	
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'           Periode',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["EXPIRASI"]);	
			$pdf->Cell(85,4,'..........................................................................................................');	
			
			
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'       3. Berkala',0,0,'L');	
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(70,4,'           Jatuh Tempo Tanggal',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["EXPIRASI"]);	
			$pdf->Cell(85,4,'..........................................................................................................');	
			
			
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'       4. Penebusan',0,0,'L');	
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(70,4,'           Pertanggal',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			//$pdf->Cell(85,4,$rowx["EXPIRASI"]);	
			$pdf->Cell(85,4,'..........................................................................................................');	
			
			
			
			$pdf->Ln();	
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'C.   Manfaat Klaim agar ditransfer ke :',0,0,'L');
			$pdf->Ln();	
			$pdf->Cell(70,4,'       (wajib diisi denga rekening atas nama Pemegang Polis)',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(70,4,'       Bank',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(195,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'       Unit/Cabang',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'       No Rekening',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(85,4,'..........................................................................................................');
			$pdf->Ln();
			$pdf->Cell(70,4,'       Atas Nama',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(85,4,'..........................................................................................................');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetLeftMargin(125);
			$pdf->Cell(85,4,'........................................,....................................');
			$pdf->Ln();
			$pdf->Cell(85,4,'Yang mengajukan klaim,');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(85,4,'(...........................................................................)');
			$pdf->Ln();
			$pdf->Cell(85,4,'Nama Lengkap');	
			$pdf->SetLeftMargin(20);
			$pdf->Ln();	
			$pdf->Cell(85,4,'____________________________________________________________________________________________________________');
			$pdf->Ln();	
			$pdf->Ln();	
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,4,'D.   Diisi oleh PT Asuransi Jiwa IFG.',0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Ln();
			$pdf->Cell(70,4,'       Pelunasan premi terakhir per',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(195,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'       Bukti Lunas',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(85,4,'..........................................................................................................');	
			$pdf->Ln();
			$pdf->Cell(70,4,'       Besar Sisa Pinjaman',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(85,4,'..........................................................................................................');
			$pdf->Ln();
			$pdf->Cell(70,4,'       Besar bunga pinjaman',0,0,'L');	
			$pdf->Cell(15,4,':',0,0,'C');
			$pdf->Cell(85,4,'..........................................................................................................');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Cell(85,4,'       ........................................,....................................');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln(); 
			$pdf->SetLeftMargin(30);
			$pdf->Cell(70,4,'('.$row["KASIADLOG"].')',0,0,'C');	
			$pdf->Cell(70,4,'('.$row["KASIOPS"].')',0,0,'C');	
			$pdf->Ln();	
			$pdf->Cell(70,4,'Kasi Keuangan & Umum',0,0,'C');	
			$pdf->Cell(70,4,'Kasi Operasional & Penjualan',0,0,'C');
			//** akhir isi pengajuan
			//$pdf->Output();
			
			$path_name = 'pdf_email/JTHP-'.$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"].'.pdf';
			$pdf->Output($path_name);	
			
			try{	
				$mail = new PHPMailer(true); //New instance, with exceptions enabled

				$body="<br> ini body";
				//$body             = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/get_cetakjatuhtempo_expirasi.php?prefixpertanggungan='.$rowx["PREFIXPERTANGGUNGAN"].'&nopertanggungan='.$rowx["NOPERTANGGUNGAN"].'&tglexp='.$rowx["EXPIRASI"]);
				//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

				$mail->SMTPSecure = "";
				$mail->IsSMTP();                           // tell the class to use SMTP
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->Port       = 25;                    // set the SMTP server port                  
				$mail->Host       = "mail.jiwasraya.co.id"; 	
				$mail->Username   = "postmaster@jiwasraya.co.id"; 	
				$mail->Password   = "P4ssw0rd_151";
				//$mail->From       = "PT. Asuransi Jiwasraya <postmaster@jiwasraya.co.id>";
				$mail->From       = "postmaster@jiwasraya.co.id";
				$mail->FromName   = "PT. Asuransi Jiwasraya (Persero)";
				//$mail->FromName   = $_SESSION['uname'].' - '.$_SESSION['nama_org'];
				


				//$mail->IsSendmail();  // tell the class to use Sendmail

				$mail->AddReplyTo("no-reply@jiwasraya.co.id","Tidak Untuk Dibalas");

				//$to = $_POST['user'];
				$to = $email;

				$mail->AddAddress($to);
				$mail->addAttachment($path_name);
				//$mail->Subject  = " ".$row['DESKRIPSI'];
				$mail->Subject  = " Pemberitahuan Jatuh Tempo ".substr($rowx["NAMABENEFIT"],10,strlen($rowx["NAMABENEFIT"])-10)." Polis ".$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"]. " atas nama tertanggung ".$rowx["TERTANGGUNG"];

				//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
				$mail->WordWrap   = 80; // set word wrap
				
				//$mail->MsgHTML("</br> You Have a new memo with the title '".$row['DESKRIPSI']."'.</br>Please check it <a href='http://192.168.2.7/smart/tiket/'>here.</a></br>Under menu : Memo Administration>My Memo.</br>Thank You for Your attention...");
				$isipesan = file_get_contents('http://192.168.2.23/jiwasraya/pelaporan/get_cetakjatuhtempo_tahapan.php?prefixpertanggungan='.$rowx["PREFIXPERTANGGUNGAN"].'&nopertanggungan='.$rowx["NOPERTANGGUNGAN"].'&tglexp='.$rowx["EXPIRASI"].'&kantor='.$kdkantor.'&tglexp='.$tglexp);
				$mail->MsgHTML($isipesan);
						
				/*attach : $path, $name = "", $encoding = "base64", $type = "application/octet-stream"*/
				//$mail->AddAttachment("E:/CI/mimemessage-2009-08-11.zip","mimemessage-2009-08-11.zip","base64","application/zip");
				//$mail->AddAttachment("E:/trf_rini_mei10.pdf","trf_rini_mei10.pdf","base64","application/pdf");

				$mail->IsHTML(true); // send as HTML

				$mail->Send();
			} catch (phpmailerException $e) {
				$query = "update $DBUser.TABLE_KIRIM_EMAIL set status = 'X' WHERE PREFIXPERTANGGUNGAN = '".$rowx["PREFIXPERTANGGUNGAN"]."' AND NOPERTANGGUNGAN = '".$rowx["NOPERTANGGUNGAN"]."' AND JENIS = 'F' ";
				echo $query;
				$DB->parse($query);
				$DB->execute();
				$row=$DB->nextrow();
			}	
  	}
?>