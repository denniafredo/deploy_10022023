<?

	//include "../../includes/database.php";
	//include "../../includes/session.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";	

	//$prefixpertanggungan="AC";
	//$nopertanggungan="001226250";
	function gen_pdf($prefixpertanggungan,$nopertanggungan,$tglcari,$kdkantor){
	//echo 'masuk.... function';	
		$PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
		$KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
		$KTR=New Kantor($userid,$passwd,$kantor);

		$userid = 'jsadm';
		$passwd = 'jsadmoke';
		$DEBE=New database($userid, $passwd, $DBName);
		$DEBEX=New database($userid, $passwd, $DBName);
		$DBq=New database($userid, $passwd, $DBName);	
		$DEBEP=New database($userid, $passwd, $DBName);	
		
		if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
		elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
		elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
		elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
		elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
		elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}

		$query="SELECT a.prefixpertanggungan
				  || a.nopertanggungan nopol,
				  (SELECT noaccount
				  FROM tabel_100_klien_account
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND status                = '0'
				  AND jenis                 = 'VA'
				  AND kdbank                = 'BNI'
				  AND NOACCOUNT NOT LIKE '-%'
				  ) vaccount,
				  (SELECT namaklien1 FROM tabel_100_klien WHERE noklien = a.notertanggung
				  ) tertanggung,
				  b.namaklien1 pemegangpolis,
				  (SELECT namaproduk FROM tabel_202_produk WHERE kdproduk = a.kdproduk
				  ) JENIS,
				  b.alamattetap01,
				  b.alamattetap02,
				  b.kodepostetap kodepos,
				  (SELECT namakotamadya
				  FROM tabel_109_kotamadya
				  WHERE kdkotamadya = b.kdkotamadyatetap
				  ) kotamadya,
				  b.alamattagih01,
				  b.alamattagih02,
				  b.kodepostagih kodepostagih,
				  (SELECT namakotamadya
				  FROM tabel_109_kotamadya
				  WHERE kdkotamadya = b.kdkotamadyatagih
				  )kotamadyatagih,
				  (SELECT namavaluta FROM tabel_304_valuta WHERE kdvaluta = a.kdvaluta
				  ) valuta,
				  TO_CHAR (a.mulas, 'YYYY-MM-DD') mulas,
				  (SELECT namacarabayar
				  FROM tabel_305_cara_bayar
				  WHERE kdcarabayar = a.kdcarabayar
				  ) carabayar,
				  (SELECT premi
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND kdbenefit             = 'DEATHMA'
				  ) premiberkala,
				  (SELECT premi
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND kdbenefit             = 'BNFTOPUP'
				  ) topupberkala,
				  (SELECT premi
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND kdbenefit             = 'BNFTOPUPSG'
				  ) topupsekaligus,
				  (SELECT nilaibenefit
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND kdbenefit             = 'DEATHMA'
				  ) jua,
				  (SELECT nilaibenefit
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND kdbenefit             = 'TERM'
				  ) term,
				  (SELECT SUM(nilaibenefit)
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND SUBSTR(kdbenefit,1,3) ='CPM'
				  GROUP BY SUBSTR(kdbenefit,1,3)
				  ) cpm,
				  (SELECT SUM(nilaibenefit)
				  FROM tabel_223_transaksi_produk
				  WHERE prefixpertanggungan = a.prefixpertanggungan
				  AND nopertanggungan       = a.nopertanggungan
				  AND SUBSTR(kdbenefit,1,3) ='CPB'
				  GROUP BY SUBSTR(kdbenefit,1,3)
				  ) cpb,
				  a.noagen,
				  (SELECT namaklien1 FROM tabel_100_klien WHERE noklien = a.noagen
				  ) agen,
				  c.kdrayonpenagih kdkantor,
				  (SELECT namakantor FROM tabel_001_kantor WHERE kdkantor = c.kdrayonpenagih
				  ) kantor,
				  (SELECT email FROM tabel_001_kantor WHERE kdkantor = c.kdrayonpenagih
				  ) email,
				  (SELECT namastatusfile
				  FROM tabel_299_status_file
				  WHERE kdstatusfile = a.kdstatusfile
				  )status,
				  cek_fund_jl4(a.prefixpertanggungan,a.nopertanggungan,'1') inv1,				  
				  cek_fund_jl4(a.prefixpertanggungan,a.nopertanggungan,'2') inv2,
				  TO_CHAR(SYSDATE,'DD-MM-YYYY')tglcetak,
				  TO_CHAR(SYSDATE,'YYYY') TAHUN,
				  (SELECT porsi
				  FROM tabel_ul_opsi_fund
				  WHERE prefixpertanggungan
					|| nopertanggungan = a.prefixpertanggungan||a.nopertanggungan
				  AND kdfund           = cek_fund_jl4(a.prefixpertanggungan,a.nopertanggungan,'1')
				  )porsi1,
				  (SELECT porsi
				  FROM tabel_ul_opsi_fund
				  WHERE prefixpertanggungan
					|| nopertanggungan = a.prefixpertanggungan||a.nopertanggungan
				  AND kdfund           = cek_fund_jl4(a.prefixpertanggungan,a.nopertanggungan,'2')
				  )porsi2,  
				  (SELECT SUM(
					CASE trx_type
					  WHEN 'S'
					  THEN 1 * unit
					  WHEN 'T'
					  THEN 1 * unit
					  WHEN 'R'
					  THEN -1 * unit
					  WHEN 'C'
					  THEN -1 * unit
					END)
				  FROM tabel_ul_transaksi
				  WHERE nomor_polis         = a.prefixpertanggungan||a.nopertanggungan
				  AND SUBSTR(kode_fund, -2) = cek_fund_jl4(a.prefixpertanggungan,a.nopertanggungan,'1')
				  AND status                ='GOOD FUND'
				  )totalunit1,
				  (SELECT SUM(
					CASE trx_type
					  WHEN 'S'
					  THEN 1 * unit
					  WHEN 'T'
					  THEN 1 * unit
					  WHEN 'R'
					  THEN -1 * unit
					  WHEN 'C'
					  THEN -1 * unit
					END)
				  FROM tabel_ul_transaksi
				  WHERE nomor_polis         = a.prefixpertanggungan||a.nopertanggungan
				  AND SUBSTR(kode_fund, -2) = cek_fund_jl4(a.prefixpertanggungan,a.nopertanggungan,'2')
				  AND status                ='GOOD FUND'
				  )totalunit2,
				  '' biayaakuisisi,
				  '' biayatopup,
				  '' biayatopupskg,
				  (select max(tglbooked)
				  from tabel_300_historis_premi
				  where prefixpertanggungan = a.prefixpertanggungan
				  and nopertanggungan = a.nopertanggungan
				  and tglseatled is NOT null) last_booked_lunas,
				 (select max(tglseatled)
				  from tabel_300_historis_premi
				  where prefixpertanggungan = a.prefixpertanggungan
				  and nopertanggungan = a.nopertanggungan
				  and tglseatled is NOT null) last_lunas 
				FROM tabel_200_pertanggungan a,
				  tabel_100_klien b,
				  tabel_500_penagih C
				WHERE a.kdstatusfile     IN ('1','4')
				AND a.kdpertanggungan     = '2'
				AND b.noKlien             = a.nopemegangpolis
				AND C.nopenagih           = a.nopenagih
				AND A.KDPRODUK LIKE 'JL4%'
				AND a.prefixpertanggungan = '$prefixpertanggungan'  
				AND a.NOpertanggungan = '$nopertanggungan'";
		//echo $query;
		//echo '<br><br>';
		$DEBEX->parse($query);
		$DEBEX->execute();	
		$row=$DEBEX->nextrow();		
		
		
		//require( "fpdf.php" );
		require_once('../libs/fpdf/fpdf.php');

		$pdf = new FPDF('P','mm','A4');

		// PAGE 1
		$pdf->AddPage();

		// HEADER	
		//--> ini awal dari kotak				
		$pdf->SetFont('Arial','B',8);
		$pdf->Ln(35);		
		$image1 = "../libs/logo_js.jpg";
		$pdf->Ln(5);
		$pdf->Image($image1, 140, 15, 50);		
		$pdf->Ln();		
		$pdf->Ln();
		$pdf->SetLeftMargin(10);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();			
		$pdf->Ln();
		$pdf->Ln();
		$text = $row["PEMEGANGPOLIS"]."xxx\n\n".
				$row["ALAMATTETAP01"]." ".$row["ALAMATTETAP02"]."\n".
				$row["ALAMATTETAP02"]." ".$row["KOTAMADYA"]." ".$row["KODEPOS"]."\n\n\n".
				$row["NOPOL"]."/".$row["KANTOR"]."/".$row["TGLCETAK"];
				
		$text1 = "a. Pembayaran Top Up Sekaligus JS Promapan dapat dilakukan melalui :\n".
				 "   - Transfer ke Rekening Mandiri Jakarta Juanda no. 1190005168644 atas nama PT Asuransi\n".
				 "     Jiwa IFG dengan mencantumkan referensi nomor polis dan nama pemegang\n".
				 "     polis, contoh : BC001642746-ADI WIJAYA\n".
				 "   - Mengisi Formulir Top Up Sekaligus dan melampirkan Bukti Transfer Premi Top Up Sekaligus\n".
				 "     dikirimkan ke Kantor PT. Asuransi Jiwa IFG terdekat atau melalui faksimili ke\n".
				 "     nomor 021 - 34831670\n".
				 "b. Ketentuan Top Up Sekaligus:\n".
				 "   - Dapat dilakukan setiap saat\n".				 
				 "   - Minimal Rp. 1.000.000,-\n".
				 "c. Apabila terdapat hal-hal yang kurang jelas dan membutuhkan informasi lebih lanjut, Bapak/ibu:\n".
				 "   dapat menghubungi PT. Asuransi Jiwa IFG :\n".				 
				 "               - JS Call Center            : 021 - 500151\n".
				 "               - email                     : customer_service@ifg-life\n"				 
				;
		$pdf->Ln();
		$pdf->Ln();
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell(90, 5, $row["PEMEGANGPOLIS"], 0, 1);		
		$pdf->SetXY($x + 98, $y);
		$pdf->SetFont('Arial','',5);
		$pdf->MultiCell(90, 3, $text1, 1, 1);
		$pdf->Ln();
		$pdf->SetXY($x, $y+5);				
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();				
		$pdf->Cell(50,4,$row["ALAMATTETAP01"].' '.$row["ALAMATTETAP02"],0,0,'L');
		$pdf->Ln();		
		$pdf->Cell(50,4,$row["ALAMATTETAP02"].' '.$row["KOTAMADYA"].' '.$row["KODEPOS"],0,0,'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',5);
		$pdf->Cell(50,4,$row["NOPOL"].'/'.$row["KANTOR"].'/'.$row["TGLCETAK"],0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(50,4,'Perihal					:  Historis Transaksi',0,0,'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(50,4,'Terima kasih atas kepercayaan yang diberikan kepada PT. Asuransi Jiwasraya dalam memberikan perlindungan asuransi kepada Bapak/ibu',0,0,'L');
		$pdf->Ln();
		$pdf->Cell(50,4,'beserta keluarga. Bersama ini kami sampaikan rincian transaksi Bapak/Ibu sebagai berikut :',0,0,'L');		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(115,4,'Data Polis',0,0,'L');
		$pdf->Cell(50,4,'Pilihan Dana Investasi',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();
		$pdf->Cell(70,4,'No. Virtual Account BNI',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["VACCOUNT"],0,0,'L');		
		
		$pdf->Cell(40,4,'JSLE',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,' 100',0,0,'L');
		$pdf->Ln();		
		$pdf->Cell(70,4,'Nomor Polis',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["NOPOL"],0,0,'L');
		$pdf->Ln();		
		$pdf->Cell(70,4,'Nama Tertanggung',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["TERTANGGUNG"],0,0,'L');
		$pdf->Ln();		
		$pdf->Cell(70,4,'Jenis Produk',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["JENIS"],0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(50,4, 'Rincian Transaksi',0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();		
		$pdf->Cell(70,4,'Valuta',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["VALUTA"],0,0,'L');
		
		$pdf->Cell(40,4,'Tanggal Cetak',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,$row["TGLCETAK"],0,0,'L');
		$pdf->Ln();
		//$pdf->Cell(50,4, 'Biaya Top Up Berkala	:	',0,0,'L');		
		$pdf->Cell(70,4,'Mulai Asuransi',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["MULAS"],0,0,'L');
		
		$pdf->Cell(40,4,'Periode Transaksi',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,'',0,0,'L');
		$pdf->Ln();
		
		$pdf->Cell(70,4,'Total Premi',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,number_format($row["PREMIBERKALA"]+$row["TOPUPBERKALA"],2,",","."),0,0,'L');
		
		$pdf->Cell(40,4,'Premi Berkala',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,number_format($row["PREMIBERKALA"],2,",","."),0,0,'L');
		$pdf->Ln();
		
		$pdf->Cell(70,4,'Cara Bayar',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["CARABAYAR"],0,0,'L');
		
		$pdf->Cell(40,4,'Biaya Akuisisi',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,number_format($row["BIAYAAKUISISI"],2,",","."),0,0,'L');
		$pdf->Ln();
		
		$pdf->Cell(70,4,'Jatuh Tempo Pelunasan Premi Terakhir',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["LAST_BOOKED_LUNAS"],0,0,'L');
		
		$pdf->Cell(40,4,'Top Up Berkala',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,number_format($row["TOPUPBERKALA"],2,",","."),0,0,'L');
		$pdf->Ln();
		
		$pdf->Cell(70,4,'Tanggal Pembukuan Pelunasan Premi Terakhir',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["LAST_LUNAS"],0,0,'L');
		
		$pdf->Cell(40,4,'Biaya Top Up Berkala',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(35,4,number_format($row["BIAYATOPUP"],2,",","."),0,0,'L');
		$pdf->Ln();
		
		$pdf->Cell(70,4,'Status Polis',0,0,'L');		
		$pdf->Cell(5,4,':  ',0,0,'L');		
		$pdf->Cell(40,4,$row["STATUS"],0,0,'L');
		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->SetLineWidth(1);
		//$pdf->SetDash(5,5); //5mm on, 5mm off
		$pdf->Line($x,$y,$x+188,$y);
		$pdf->Ln();
		$pdf->SetFillColor(0,230,230);
		$pdf->Cell(20,4,"Pilihan Dana",0,0,'C',1);
		$pdf->Cell(7,4,"Tipe",0,0,'C',1);
		$pdf->Cell(50,4,"Keterangan",0,0,'C',1);
		$pdf->Cell(37,4,"Jumlah (Unit)",0,0,'R',1);
		$pdf->Cell(37,4,"Nilai NAB",0,0,'R',1);
		$pdf->Cell(37,4,"Jumlah Dana",0,0,'R',1);
		$pdf->SetFillColor(255,255,255);		
		//$pdf->Ln(5);
		$pdf->SetFont('Arial','B',8);
		//$pdf->Cell(20,4,"JSLE",0,0,'C',1);				
		$pdf->SetFont('Arial','',8);
		//$pdf->Ln();				
		$tahun = $row["TAHUN"];
		$tglcetak = $row["TGLCETAK"];
		$porsi1 = $row["INV1"];
		$porsi2 = $row["INV2"];
		
		$query="SELECT nomor_polis,  
				  TO_CHAR(TRX_DATE,'YYYY')TAHUN,
				  'A'tipe,
				  '0'invpremi,
				  '0'gross,
				  '0'fee,
				  '0'nett,
				  '0'totalinv,
				  '0'nab,
				  TO_CHAR(SUM(DECODE(trx_type, 'R',-1,1 )*NVL(unit, 0)),'9999999999.9999') totalunit,
				  (SELECT   nab_jual
					FROM   $DBUser.TABEL_UL_NAB
				   WHERE   tgl_nab IN (SELECT   MAX (tgl_nab)
										 FROM   $DBUser.tabel_ul_nab
										WHERE   kode_fund = '$porsi1')
						   AND kode_fund = '$porsi1') nab
				FROM tabel_ul_transaksi
				WHERE nomor_polis             ='".$prefixpertanggungan.$nopertanggungan."'
				AND status                    ='GOOD FUND'
				AND TO_CHAR(TRX_DATE,'YYYY') <= '$tahun'
				AND SUBSTR (KODE_FUND, -2,2) = '$porsi1'
				AND st_proses                <> 'X'
				GROUP BY nomor_polis,  
				  TO_CHAR(TRX_DATE,'YYYY')
				ORDER BY TO_CHAR(TRX_DATE,'YYYY') ASC";
		//echo $query;
		//echo '<br><br>';
		$DEBEX->parse($query);
		$DEBEX->execute();	
		$totalunit1 = 0;
		$totalunit2 = 0;		
		$totaldana1 = 0;
		$totaldana2 = 0;		
		while ($row=$DEBEX->nextrow()) {	
			$pdf->Ln();
			$pdf->Cell(20,4,"$porsi1",0,0,'C',1);
			$pdf->Cell(7,4,$row["TIPE"],0,0,'C',1);
			$pdf->Cell(50,4,"SUMMARY ".$row["TAHUN"],0,0,'C',1);
			$pdf->Cell(37,4,number_format($row["TOTALUNIT"],2,",","."),0,0,'R',1);
			$pdf->Cell(37,4,"0,00",0,0,'R',1);
			$pdf->Cell(37,4,"0,00",0,0,'R',1);
			$totalunit1 += $row["TOTALUNIT"];
			$nab = $row["NAB"];
		}
		$pdf->Ln();
		$pdf->SetFillColor(0,230,230);
		$pdf->Cell(20,4,"Total Unit",0,0,'C',1);
		$pdf->Cell(7,4,"$porsi1",0,0,'C',1);
		$pdf->Cell(50,4,"",0,0,'C',1);
		$pdf->Cell(37,4,number_format($totalunit1,2,",","."),0,0,'R',1);
		$pdf->Cell(37,4,number_format($nab,2,",","."),0,0,'R',1);
		$pdf->Cell(37,4,number_format($nab*$totalunit1,2,",","."),0,0,'R',1);
		$pdf->SetFillColor(255,255,255);			
		$pdf->Ln();
		$totaldana1 = $nab*$totalunit1;
		if($porsi2<>''){			
			$pdf->Ln();
			$pdf->SetFillColor(0,230,230);
			$pdf->Cell(20,4,"Pilihan Dana",0,0,'C',1);
			$pdf->Cell(7,4,"Tipe",0,0,'C',1);
			$pdf->Cell(50,4,"Keterangan",0,0,'C',1);
			$pdf->Cell(37,4,"Jumlah (Unit)",0,0,'R',1);
			$pdf->Cell(37,4,"Nilai NAB",0,0,'R',1);
			$pdf->Cell(37,4,"Jumlah Dana",0,0,'R',1);
			$pdf->SetFillColor(255,255,255);
			
			$query="SELECT nomor_polis,  
					  TO_CHAR(TRX_DATE,'YYYY')TAHUN,
					  'A'tipe,
					  '0'invpremi,
					  '0'gross,
					  '0'fee,
					  '0'nett,
					  '0'totalinv,
					  '0'nab,
					  TO_CHAR(SUM(DECODE(trx_type, 'R',-1,1 )*NVL(unit, 0)),'9999999999.9999') totalunit,
					  (SELECT   nab_jual
						FROM   $DBUser.TABEL_UL_NAB
					   WHERE   tgl_nab IN (SELECT   MAX (tgl_nab)
											 FROM   $DBUser.tabel_ul_nab
											WHERE   kode_fund = '$porsi2')
							   AND kode_fund = '$porsi2') nab
					FROM tabel_ul_transaksi
					WHERE nomor_polis             ='".$prefixpertanggungan.$nopertanggungan."'
					AND status                    ='GOOD FUND'
					AND TO_CHAR(TRX_DATE,'YYYY') <= '$tahun'
					AND SUBSTR (KODE_FUND, -2,2) = '$porsi2'
					AND st_proses                <> 'X'
					GROUP BY nomor_polis,  
					  TO_CHAR(TRX_DATE,'YYYY')
					ORDER BY TO_CHAR(TRX_DATE,'YYYY') ASC";
			//echo $query;
			//echo '<br><br>';
			$DEBEX->parse($query);
			$DEBEX->execute();	
			while ($row=$DEBEX->nextrow()) {	
				$pdf->Ln();
				$pdf->Cell(20,4,"$porsi2",0,0,'C',1);
				$pdf->Cell(7,4,$row["TIPE"],0,0,'C',1);
				$pdf->Cell(50,4,"SUMMARY ".$row["TAHUN"],0,0,'C',1);
				$pdf->Cell(37,4,number_format($row["TOTALUNIT"],2,",","."),0,0,'R',1);
				$pdf->Cell(37,4,"0,00",0,0,'R',1);
				$pdf->Cell(37,4,"0,00",0,0,'R',1);
				$totalunit2 += $row["TOTALUNIT"];
				$nab = $row["NAB"];
			}
			$pdf->Ln();
			$pdf->SetFillColor(0,230,230);
			$pdf->Cell(20,4,"Total Unit",0,0,'C',1);
			$pdf->Cell(7,4,"$porsi2",0,0,'C',1);
			$pdf->Cell(50,4,"",0,0,'C',1);
			$pdf->Cell(37,4,number_format($totalunit2,2,",","."),0,0,'R',1);
			$pdf->Cell(37,4,number_format($nab,2,",","."),0,0,'R',1);
			$pdf->Cell(37,4,number_format($nab*$totalunit2,2,",","."),0,0,'R',1);
			$pdf->SetFillColor(255,255,255);			
			$pdf->Ln();
			$totaldana2 = $nab*$totalunit2;
		}
		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFillColor(0,230,230);		
		$pdf->Cell(77,4,"Total Dana Investasi",0,0,'C',1);
		$pdf->Cell(37,4,"",0,0,'R',1);
		$pdf->Cell(37,4,"",0,0,'R',1);				
		$pdf->Cell(37,4,"Nilai Unit * ",0,0,'R',1);
		$pdf->Ln();
		$pdf->Cell(77,4,"",0,0,'C',1);
		$pdf->Cell(37,4,"",0,0,'R',1);
		$pdf->Cell(37,4,"",0,0,'R',1);				
		$pdf->Cell(37,4,"Harga Unit",0,0,'R',1);
		$pdf->SetFillColor(255,255,255);
		$pdf->Ln();
		$pdf->Cell(77,4,"",0,0,'C',1);
		$pdf->Cell(37,4,"",0,0,'R',1);
		$pdf->Cell(37,4,'',0,0,'R',1);				
		$pdf->Cell(37,4,number_format($totaldana1+$totaldana2,2,",","."),0,0,'R',1);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(100,4,'* Nilai unit-unit di atas dihitung berdasarkan harga unit pada tanggal cetak.',0,0,'L',1);				
		$pdf->Ln();
		$pdf->Cell(100,4,'* Total Nilai Unit adalah Jumlah sebelum dikurangi dengan biaya Asuransi, administrasi yang belum dibebankan jika ada.',0,0,'L',1);				
		$pdf->Ln();
		$pdf->Cell(100,4,'* Premi Jaminan Tambahan (Rider) berlaku untuk 1 (satu) tahun dan premi untuk tahun selanjutnya sesuai dengan tarif usia tertanggung.',0,0,'L',1);				
		$pdf->Ln();
		$pdf->Cell(100,4,'* Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.',0,0,'L',1);				
		// OUTPUT
		$pdf->Output('pdf/'.$tglcari.'_HISTORIS_TRANSAKSI_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf');
		
		//$pdf->Output();
		
		$ftp_server = "192.168.2.94";
		$ftp_username = "ftpuser";
		$ftp_userpass = "JS#34-ftp!";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

		$file = 'pdf/'.$tglcari.'_HISTORIS_TRANSAKSI_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
		//echo $file;
		//die;
		$namafile = 'DOKUMEN_NOTIFIKASI_EMAIL/'.$tglcari.'_HISTORIS_TRANSAKSI_'.$prefixpertanggungan.'-'.$nopertanggungan.'.pdf';
		// upload file
		if (ftp_put($ftp_conn, $namafile, $file, FTP_ASCII))
		  {
		  echo "Successfully uploaded $file.";
		  }
		else
		  {
		  echo "Error uploading $file.";
		  }

		// close connection
		ftp_close($ftp_conn);
		
		
	}	
	?>