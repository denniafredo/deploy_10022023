<?php
//echo 'masuk ddn'; die;
    /*  */
    //include '../include/config.php'; 
    //include '../include/authentication.php';
	include "../../includes/database.php";
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

	// Instanciation of inherited class
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	
	$prefixpertanggungan = $_GET['prefixpertanggungan'];
	$nopertanggungan = $_GET['nopertanggungan'];
	$kdkantor = $_GET['kdkantor'];
	
	//** GENERATE DATA DULU
	$userid='JSADM';
	$passwd='JSADMOKE';
	$DB=New database($userid, $passwd, $DBName);		
	//$db = new ConnectionJL();
	//$conn = $db->Open();	
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
							(SELECT   kdmapping
                      FROM   $DBUser.TABEL_001_KANTOR
                     WHERE   kdkantor = prefixpertanggungan)
                   || ptg.nopertanggungan
                      h2h,
           (SELECT   namakantor || ' ' || alamat01 || ' ' || alamat02
            FROM   $DBUser.tabel_001_kantor ktr, $DBUser.TABEL_500_penagih pngh
           WHERE   kdrayonpenagih = kdkantor AND nopenagih = ptg.nopenagih)
            namakantor, 
           (SELECT   TO_CHAR (MAX (tglbooked), 'DD/MM/YYYY')
                      FROM   $DBUser.tabel_300_historis_premi hpl
                     WHERE   hpl.prefixpertanggungan =
                                ptg.prefixpertanggungan
                             AND hpl.nopertanggungan = ptg.nopertanggungan
                             AND NOT (hpl.tglseatled IS NULL))
                      lunas,
                   CASE
                      WHEN (MONTHS_BETWEEN (TO_DATE ('', 'DD/MM/YYYY'),
                                            MULAS)
                            / 12) >= 5
                      THEN
                         PREMI2
                      ELSE
                         PREMI1
                   END
                      PREMI, 
						 (SELECT   namakantor || ' ' || alamat01 || ' ' || alamat02
				  FROM   $DBUser.tabel_001_kantor ktr,$DBUser.TABEL_500_penagih pngh
				 WHERE       kdrayonpenagih = kdkantor
						 AND nopenagih=ptg.nopenagih) namakantor
				  FROM   $DBUser.tabel_200_pertanggungan ptg
				 WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";	
	
	$query = "select TO_CHAR(sysdate,'dd ')||BULAN_KATA(TO_CHAR(sysdate,'mm'))||TO_CHAR(sysdate,' yyyy') hariini,a.emailxlindo,a.email,a.emailopr,a.emailadlog, decode(a.kdjeniskantor,'1','KANTOR CABANG','2','KANTOR PERWAKILAN') jeniskantor, ".
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
	// halaman 1
	$pdf->SetLeftMargin(20);
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
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(95,4,'Kepada Yth.',0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();		
	$pdf->Cell(95,4,$rowx["ANDA"].' '.$rowx["PEMPOL"],0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->Cell(95,4,$rowx["ALAMAT"],0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->Cell(95,4,$rowx["KOTA"],0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln(10);		
	$pdf->Cell(20,4,'Perihal',0,0,'L');
	$pdf->Cell(5,4,':',0,0,'C');
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(70,4,'PEMBERITAHUAN JATUH TEMPO PREMI',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(70,4,'Nasabah Yang Terhormat, ',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->MultiCell(170,4,'Terima kasih atas kepercayaan Ibu kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi Ibu dan keluarga.');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(70,4,'Berikut ini adalah data Polis '.$rowx["ANDA"].', ',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(70,4,'           Nomor Polis',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["PREFIXPERTANGGUNGAN"].'-'.$rowx["NOPERTANGGUNGAN"].' / '.$rowx["NOPOL"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Nomor Host to Host',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["H2H"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Nama Pemegang Polis',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["PEMPOL"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Jenis Produk',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["PRODUK"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Valuta',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["VALUTA"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Mulai Asuransi',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["MULAS"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Cara Pembayaran Premi',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["CARA"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Premi terakhir yang sudah dilunasi per',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["LUNAS"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Jatuh tempo pembayaran Premi pada tanggal',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	$pdf->Cell(50,4,$rowx["PEMPOL"],0,0,'L');
	$pdf->Ln();
	$pdf->Cell(70,4,'           Jumlah Premi sebesar',0,0,'L');
	$pdf->Cell(15,4,':',0,0,'C');
	if ($rowx["VALUTA"] == 'RUPIAH TANPA INDEKS' || $rowx["VALUTA"] =="DOLLAR AMERIKA SERIKAT"){
		$pdf->Cell(50,4,number_format($rowx["PREMI"],2,",","."),0,0,'L');
	}else{
		$pdf->Cell(50,4,number_format($rowx["PREMI"]/$rowx["INDEXAWAL"],2,",","."),0,0,'L');
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->MultiCell(170,4,'Mohon untuk dapat melakukan pembayaran premi tersebut diatas setelah tanggal jatuh tempo. Untuk menjaga kesinambungan manfaat Polis Ibu agar pembayaran premi dilakukan tidak melebihi masa kelonggaran pembayaran premi (grace period) yaitu 60 hari setelah tanggal jatuh tempo premi.');
	$pdf->Ln();	
	$pdf->MultiCell(170,4,'Keterlambatan pembayaran premi ataupun hal-hal lainnya yang menyebabkan premi tidak terbayarkan dan melewati masa kelonggaran pembayaran premi, akan menyebabkan manfaat polis terhenti dan polis menjadi Lapse (Batal).');		
	$pdf->Ln();	
	$pdf->MultiCell(170,4,'Abaikan surat pemberitahuan jatuh tempo ini apabila Bapak sudah melakukan pembayaran premi tersebut.');
	$pdf->Ln();	
	$pdf->MultiCell(170,4,'Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.');		
	$pdf->Ln();
	$pdf->Ln();	
	$pdf->Cell(50,4,'Hormat kami',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(50,4,'PT ASURANSI JIWA IFG',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','',7);
	$pdf->MultiCell(170,4,'Informasi lebih lanjut dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG 021-1500151 atau email customer_service@ifg-life.co.id atau kunjungi www.ifg-life.co.id',1);			
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','',5);
	$pdf->Cell(50,4,'*Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.',0,0,'L');
	$pdf->Ln(2);
	$pdf->Cell(50,4,'*Abaikan tagihan ini jika Anda sudah membayar.',0,0,'L');	
	$pdf->Ln();
	$pdf->Ln();
	
	$pdf->AddPage();
	
	// halaman 2
	
	$pdf->SetLeftMargin(20);
	$image1 = "./libs/logo_js.jpg";
	$pdf->Ln(10);
	$pdf->Image($image1, 18, 15, 50);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetLeftMargin(120);
	$pdf->Cell(70,4,'PT ASURANSI JIWA IFG',0,0,'R');
	$pdf->Ln();	
	$pdf->Cell(70,4,$row['NAMAKANTOR'],0,0,'R');
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(70,4,$row['ALAMAT01'],0,0,'R');
	$pdf->Ln();
	$pdf->Cell(70,4,$row['ALAMAT02'],0,0,'R');
	$pdf->Ln();
	$pdf->Cell(70,4,$row['KODEPOS'],0,0,'R');
	$pdf->Ln();
	$pdf->Cell(70,4,$row['PHONE01'],0,0,'R');
	$pdf->Ln();
	$pdf->SetFont('Arial','B',9);	
	$pdf->Cell(70,4,'www.ifg-life.co.id',0,0,'R');
	$pdf->Ln(20);	
	
	
	//$pdf->Image($image1, 20, 6, 50);
	$pdf->Cell(70,4,$row['NAMAKOTAMADYA'].', '.$row['HARIINI'],0,0,'R');
	$pdf->SetLeftMargin(20);
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->Cell(95,4,'Kepada Yth.',0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();		
	$pdf->Cell(95,4,$rowx["ANDA"].' '.$rowx["PEMPOL"],0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->Cell(95,4,$rowx["ALAMAT"],0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln();
	$pdf->Cell(95,4,$rowx["KOTA"],0,0,'L');
	$pdf->SetFont('Arial','',9);
	$pdf->Ln(15);
	$pdf->Cell(70,4,'Pemegang Polis Yang Terhormat,  ',0,0,'L');
	$pdf->Ln();
	$pdf->Ln();
	$pdf->MultiCell(170,4,'Dalam rangka meningkatkan pelayanan kepada Nasabah, sejak tanggal 1 Maret 2012 PT Asuransi Jiwa IFG tidak menerima pembayaran tunai melalui petugas lapangan, pembayaran premi saat ini dapat dilakukan melalui :');
	$pdf->Ln();	
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(70,4,'1.  Auto Debet.',0,0,'L');
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->SetLeftMargin(24);
	$pdf->Cell(70,4,'a.  Auto Debet Tabungan Bank Mandiri/BNI/BRI',0,0,'L');	
	$pdf->SetLeftMargin(28);
	$pdf->Ln();
	$pdf->MultiCell(163,4,'Pembayaran melalui Auto Debet tabungan Bank Mandiri/BNI/BRI dapat dilakukan dengan mengisi Surat Kuasa Pendebetan Rekening, foto copy buku tabungan Bank halaman 1 (satu), fotocopy KTP. Formulir surat kuasa dapat diperoleh melalui Kantor PT Asuransi Jiwa IFG di wilayah Anda atau download di www.ifg-life.co.id menu formulir dan dokumen.');	
	$pdf->SetLeftMargin(24);
	$pdf->Ln();
	$pdf->Cell(70,4,'b.  Auto Debet Kartu Kredit',0,0,'L');		
	$pdf->SetLeftMargin(28);
	$pdf->Ln();
	$pdf->MultiCell(163,4,'Pembayaran melalui Auto Debet Kartu Kredit berlogo Visa/Master dapat dilakukan dengan mengisi Surat Kuasa Pendebetan Kartu Kredit, foto copy kartu kredit, foto copy KTP.Formulir surat kuasa dapat diperoleh melalui Kantor Jiwasraya di wilayah Anda atau download di www.ifg-life.co.id menu formulir dan dokumen.');
	$pdf->SetLeftMargin(20);
	$pdf->Ln();
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(70,4,'2.  Virtual Account BNI.',0,0,'L');
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);
	$pdf->SetLeftMargin(24);
	$pdf->MultiCell(166,4,'Nomor Virtual Account BNI Anda adalah 9885190001612098, pembayaran melalui Virtual Account BNI dapat dilakukan melalui Setoran tunai di Teller BNI, ATM (BNI / ATM Bersama) dan Internet Banking.');		
	$pdf->SetLeftMargin(20);
	$pdf->Ln();	
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(70,4,'3.  Host to Host',0,0,'L');	
	$pdf->SetFont('Arial','',9);
	$pdf->SetLeftMargin(24);
	$pdf->Ln();
	$pdf->Cell(70,4,'Pembayaran menggunakan Host to Host dapat dilakukan melalui :',0,0,'L');	
	$pdf->Ln();
	$pdf->Cell(70,4,'a. Bank Mandiri',0,0,'L');	
	$pdf->SetLeftMargin(28);
	$pdf->Ln();
	$pdf->Cell(70,4,'>  Setoran tunai di Teller Bank Mandiri',0,0,'L');	
	$pdf->Ln();
	$pdf->Cell(70,4,'>  ATM Mandiri',0,0,'L');	
	$pdf->Ln();
	$pdf->Cell(70,4,'>  Internet Banking Bank Mandiri',0,0,'L');	
	
	$pdf->SetLeftMargin(24);
	$pdf->Ln();	
	$pdf->Cell(70,4,'b. Bank Rakyat Indonesia (BRI) ',0,0,'L');	
	$pdf->SetLeftMargin(28);
	$pdf->Ln();
	$pdf->Cell(70,4,'>  Setoran tunai di Teller BRI',0,0,'L');	
	$pdf->Ln();
	$pdf->Cell(70,4,'>  ATM BRI',0,0,'L');	
	
	$pdf->SetLeftMargin(24);
	$pdf->Ln();	
	$pdf->Cell(70,4,'c. Bank Negara Indonesia (BNI) ',0,0,'L');	
	$pdf->SetLeftMargin(28);
	$pdf->Ln();	
	$pdf->Cell(70,4,'>  ATM BNI',0,0,'L');	
	$pdf->SetLeftMargin(24);
	$pdf->Ln();	
	$pdf->Cell(70,4,'d. Pos Indonesia ',0,0,'L');	
	$pdf->Ln();	
	$pdf->Cell(70,4,'e. Seluruh Jaringan Indomaret ',0,0,'L');	
	$pdf->Ln();	
	$pdf->Cell(70,4,'f.  Jaringan Payment Point FastPay ',0,0,'L');		
	$pdf->Ln();	
	$pdf->SetLeftMargin(20);
	$pdf->Ln();
	
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(70,4,'4.  Kantor Cabang PT Asuransi Jiwa IFG di seluruh Indonesia',0,0,'L');
	$pdf->Ln();
	$pdf->SetFont('Arial','',9);	
	$pdf->Ln();	
	$pdf->MultiCell(170,4,'Informasi lebih lanjut dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG 021-1500151 atau email customer_service@ifg-life.co.id atau kunjungi www.ifg-life.co.id');	
	$pdf->Ln();	
	
	//**** akhir isi		
	//** akhir isi pengajuan
	$pdf->Output();
	//$pdf->Output('file_pdf/'.$rowx["PREFIXPERTANGGUNGAN"].$rowx["NOPERTANGGUNGAN"].$rowx["PEMPOL"].'.pdf');

  	
?>