<?
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/kantor.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/gadai.php";
	include "../../includes/fungsi.php";

	// $prefixpertanggungan	= 'NB';
	// $nopertanggungan		= '001639052';
	// $kdkantor 				= 'NB';
	// $id_blast 				= '4';
	$passwd = 'jsadmoke';
	$userid = 'jsadm';

	$DB1	= new database($userid, $passwd, $DBName);
	$DBD	= new database($userid, $passwd, $DBName);
	$cetak 	= $_GET['cetak'];
	if($cetak == 1){
		$cari 	= " AND (STATUS != '1' OR STATUS IS NULL) AND TGL_KIRIM_SMS IS NULL";
	}else{
		$cari 	= '';
	}
	$sqlcek	= "SELECT * FROM $DBUser.PENERIMA_EMAIL_BLAST where ID_BLAST = '".$_GET['idblast']."'
				$cari
				";
	//echo $sqlcek;
	$DBD->parse($sqlcek);
	$DBD->execute();

	require_once('../libs/fpdf/fpdf.php');
	$pdf = new FPDF('P','mm','A4');

	while ($rowd = $DBD->nextrow()) {
		if($cetak == 0){
			require_once('../libs/fpdf/fpdf.php');
			$pdf = new FPDF('P','mm','A4');
		}
		$prefixpertanggungan 	= $rowd['PREFIXPERTANGGUNGAN'];
		$nopertanggungan 		= $rowd['NOPERTANGGUNGAN'];
		$kdkantor 				= $rowd['RAYONPENAGIHAN'];
		$id_blast 				= $rowd['ID_BLAST'];
		$id_audience 			= $rowd['ID_AUDIENCE'];

		$DBZ	= new database($userid, $passwd, $DBName);
		$sql	= "SELECT a.*, to_char(b.tglgadai, 'DD/MM/YYYY') TGLGADAI, c.NOACCOUNT 
					FROM $DBUser.PENERIMA_EMAIL_BLAST a,
						$DBUser.TABEL_701_PELUNASAN_GADAI b,
						$DBUser.TABEL_700_GADAI_ACCOUNT c
					WHERE a.prefixpertanggungan = b.prefixpertanggungan
						AND a.nopertanggungan = b.nopertanggungan
						AND a.prefixpertanggungan = c.prefixpertanggungan
						AND a.nopertanggungan = c.nopertanggungan
						AND a.id_blast = '".$id_blast."'
						AND b.prefixpertanggungan = '".$prefixpertanggungan."'
						AND b.nopertanggungan = '".$nopertanggungan."'
						AND b.tglrekam = (SELECT max(tglrekam) from $DBUser.tabel_701_pelunasan_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = b.nopertanggungan
				 			group by nopertanggungan)";
		//echo $sql;
		$DBZ->parse($sql);
		$DBZ->execute();

		while ($row = $DBZ->nextrow()) {
			$tglgadai = $row['TGLGADAI'];
			$no_va    = $row['NOACCOUNT'];
			
			$PERT = New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
			$KLN = New Klien($userid,$passwd,$PERT->nopemegangpolis);
			$KTR = New Kantor($userid,$passwd,$kantor);
			$GDI = New Gadai($userid,$passwd,$prefixpertanggungan,$nopertanggungan,$tglgadai);
			$nosurat = str_pad($GDI->nourutgadai,3,"0",STR_PAD_LEFT);
			$tgl 	= date("m/Y");
		}

		$DB	= new database($userid, $passwd, $DBName);
		$sql = "SELECT
					to_char(tglbooked,'DD/MM/YYYY') as tglbooked, to_char(tglseatled,'DD/MM/YYYY') as tglseatled,
					angsuranpokok,saldopinjaman,periodebayar,
					bunga,nilaipembayaran,to_char(last_day(sysdate),'DD/MM/YYYY') as akhirbulan
				FROM $DBUser.tabel_701_pelunasan_gadai
				WHERE prefixpertanggungan='$prefixpertanggungan' AND nopertanggungan='$nopertanggungan' 
					AND tglbooked IN
						(SELECT max(tglbooked) FROM $DBUser.tabel_701_pelunasan_gadai 
						WHERE prefixpertanggungan='$prefixpertanggungan' AND nopertanggungan='$nopertanggungan')
				AND to_char(tglgadai,'DD/MM/YYYY')='$tglgadai' ";
		$DB->parse($sql);
		$DB->execute();
		$arr = $DB->nextrow();
		$bln = substr($arr["TGLBOOKED"],3,2);
		$thn = substr($arr["TGLBOOKED"],-4);
		$periodebayar = $arr["PERIODEBAYAR"];
		$akhirbulan = $arr["AKHIRBULAN"];

		switch ($bln) {
			case "01":  $vbulan = "JANUARI"; break;
			case "02":  $vbulan = "PEBRUARI"; break;
			case "03":  $vbulan = "MARET"; break;
			case "04":  $vbulan = "APRIL"; break;
			case "05":  $vbulan = "MEI"; break;
			case "06":  $vbulan = "JUNI"; break;
			case "07":  $vbulan = "JULI"; break;
			case "08":  $vbulan = "AGUSTUS"; break;
			case "09":  $vbulan = "SEPTEMBER"; break;
			case "10":  $vbulan = "OKTOBER"; break;
			case "11":  $vbulan = "NOPEMBER"; break;
			case "12":  $vbulan = "DESEMBER"; break;
		}

		//require( "fpdf.php" );
		// require_once('../libs/fpdf/fpdf.php');
		// $pdf = new FPDF('P','mm','A4');

		$pdf->AddPage();

		/*** HEADER ***/
		$pdf->ln();
		$pdf->SetLeftMargin(10);
		$image1 = "../libs/logo_js.jpg";
		$pdf->Ln(5);
		$pdf->Image($image1, 18, 10, 50);
		$pdf->SetFont('Arial','B',8);
		$pdf->SetLeftMargin(120);
		$pdf->Cell(70,4,'PT ASURANSI JIWA IFG',0,0,'R');
		$pdf->Ln();	
		$pdf->Cell(70,4,'KANTOR PUSAT',0,0,'R');
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(70,4,'JL. IR H. JUANDA NO.34',0,0,'R');
		$pdf->Ln();
		$pdf->Cell(70,4,'JAKARTA',0,0,'R');
		$pdf->Ln();
		$pdf->Cell(70,4,'Telp.021-3845031 Fax.021-3862344',0,0,'R');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(70,4,'www.ifg-life.co.id',0,0,'R');
		$pdf->Ln(5);

		/*** NOMOR DAN ALAMAT PENGIRIMAN ***/
		$pdf->SetLeftMargin(10);
		$pdf->SetFont('Arial','',7);
		$pdf->SetFillColor(200,200,200);
		$pdf->Cell(190,4,'Jakarta, 17 Desember 2019',0,0,'R');
		$pdf->ln(8);
		$pdf->Cell(12,4,'Nomor',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(170,4,$nosurat.'/JIWASRAYA/'.$kantor.'/'.$tgl.'',0,0,'L');
		$pdf->ln();
		$pdf->Cell(12,4,'Nama',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(170,4,$KLN->nama,0,0,'L');
		$pdf->ln();
		$pdf->Cell(12,4,'Alamat',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->MultiCell(70,4,$KLN->alamattagih,0,'L','');
		$pdf->ln(7);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(190,4,'PEMBERITAHUAN POSISI PINJAMAN POLIS',0,0,'C');
		$pdf->ln(7);
		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(190,4,'DATA POSISI',0,0,'L');
		$pdf->ln();
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(40,4,'Nomor Polis',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$prefixpertanggungan.'-'.$nopertanggungan,0,0,'L');
		$pdf->Cell(30,4,'Macam Asuransi',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(49,4,$PERT->namaproduk,0,0,'L');
		$pdf->ln();
		$pdf->Cell(40,4,'Pemegang Polis',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$PERT->namapemegangpolis,0,0,'L');
		$pdf->Cell(30,4,'Cara bayar Premi',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(49,4,$PERT->namacarabayar,0,0,'L');
		$pdf->ln();
		$pdf->Cell(40,4,'JUA',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,number_format($PERT->jua,2,",","."),0,0,'L');
		$pdf->Cell(30,4,'Valuta',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(49,4,$PERT->namavaluta,0,0,'L');
		$pdf->ln();
		$pdf->Cell(40,4,'Mulai Asuransi',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$PERT->mulas,0,0,'L');
		$pdf->ln();
		$pdf->Cell(40,4,'Akhir Pembayaran Premi',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$PERT->akhirpremi,0,0,'L');
		$pdf->ln(7);

		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(190,4,'DATA PINJAMAN POLIS',0,0,'L');
		$pdf->ln();
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(40,4,'Mulai Pinjaman Polis',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$GDI->tglgadai,0,0,'L');
		$pdf->Cell(30,4,'Bunga Pinjaman Polis',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(49,4,$GDI->sbgadai.'% p.a',0,0,'L');
		$pdf->ln();
		$pdf->Cell(40,4,'Akhir Pinjaman Polis',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$GDI->akhirgadai,0,0,'L');
		$pdf->Cell(30,4,'Jenis',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(49,4,$GDI->kdjenisgadai==0 ? "GADAI BARU" : "GADAI LAMA",0,0,'L');
		$pdf->ln();
		$pdf->Cell(40,4,'Nominal Pinjaman',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$GDI->notasi.' '.number_format($GDI->pokokgadai,2,",","."),0,0,'L');
		$pdf->ln(7);

		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(190,4,'LEMBAR TRANSAKSI PINJAMAN POLIS',0,0,'L');
		$pdf->ln();

		// DATA RINCIAN POLIS
		$pdf->SetFont('Arial','B',6);
		$pdf->SetFillColor(0,32,96);
		$pdf->SetTextColor(255,255,255);
		$pdf->Cell(38,4,'Tanggal','LTR',0,'C',true);
		$pdf->Cell(38,4,'Uraian','LTR',0,'C',true);
		$pdf->Cell(38,4,'Pokok','LTR',0,'C',true);
		$pdf->Cell(38,4,'Bunga','LTR',0,'C',true);
		$pdf->Cell(38,4,'Keterangan','LTR',0,'C',true);
		$pdf->ln();
		$pdf->SetFont('Arial','',6);
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0,0,0);

		$DB	= new database($userid, $passwd, $DBName);
		$sql = "SELECT
					to_char(tglbooked,'DD/MM/YYYY') as tglbooked,
					to_char(tglseatled,'DD/MM/YYYY') as tglseatled,
					angsuranpokok,saldopinjaman,periodebayar,
					bunga,angsuranbunga,nilaipembayaran,nvl(kapitalisasi,0) as kapitalisasi,totalangsuran
				FROM $DBUser.tabel_701_pelunasan_gadai 
				WHERE prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'
					and to_char(tglgadai,'DD/MM/YYYY')='$tglgadai'
					--and tglbooked > TO_DATE('01/' || to_char(ADD_MONTHS(TO_DATE(sysdate, 'dd/mm/yy'), -12), 'MM/YYYY'), 'DD/MM/YY')
				UNION
				SELECT
					to_char(tglbooked,'DD/MM/YYYY') as tglbooked,
					to_char(tglseatled,'DD/MM/YYYY') as tglseatled,
					angsuranpokok,saldopinjaman,periodebayar,
					bunga,angsuranbunga,nilaipembayaran,nvl(kapitalisasi,0) as kapitalisasi,totalangsuran
				FROM $DBUser.tabel_701_pelunasan_gadai 
				WHERE prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'
					and to_char(tglgadai,'DD/MM/YYYY')='$tglgadai'
					and periodebayar='1'
				ORDER BY periodebayar ";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		while($ar2=$DB->nextrow()){

			if($ar2["PERIODEBAYAR"]==1){ 
				$uraian = "Saldo Pinjaman";
				$pokok  = $ar2["SALDOPINJAMAN"];
				$pokokp = number_format($ar2["SALDOPINJAMAN"],2,",",".");
				$angsuranpokok 	= 0;
				$bunga 			= 0;
				$startpay 		= 1;
				$bungap 		= $ar2["BUNGA"];
			}else{
				$uraian = "Tagihan Bunga";
				$pokokp = number_format(0,2,",",".");
				$angsuranpokok = $ar2["ANGSURANPOKOK"];
				$bunga         = $ar2["ANGSURANBUNGA"];
				$startpay      = 0;
				if($ar2["TGLSEATLED"]!=""){
					$bungap       = $ar2["ANGSURANBUNGA"];
				}else{
					$bungap       = $ar2["BUNGA"];
				}
			}

			if($ar2["KAPITALISASI"] > 0){
				$pdf->Cell(38,4,$ar2['TGLBOOKED'],'LR',0,'C',true);
				$pdf->Cell(38,4,'Kapitalisasi','LR',0,'L',true);
				$pdf->Cell(38,4,number_format($ar2["KAPITALISASI"],2,",","."),'LR',0,'R',true);
				$pdf->Cell(38,4,number_format($ar2["KAPITALISASI"],2,",","."),'LR',0,'R',true);
				$pdf->Cell(38,4,'CR','LR',0,'L',true);
				$pdf->ln();
			}
			if($ar2["TGLSEATLED"]!="" && $startpay==0){
				$pdf->Cell(38,4,$ar2['TGLSEATLED'],'LR',0,'C',true);
				$pdf->Cell(38,4,'Pembayaran','LR',0,'L',true);
				$pdf->Cell(38,4,number_format($angsuranpokok,2,",","."),'LR',0,'R',true);
				$pdf->Cell(38,4,number_format($bungap,2,",","."),'LR',0,'R',true);
				$pdf->Cell(38,4,'CR','LR',0,'L',true);
				$pdf->ln();
			}else{
				$pdf->Cell(38,4,$ar2['TGLBOOKED'],'LR',0,'C',true);
				$pdf->Cell(38,4,$uraian,'LR',0,'L',true);
				$pdf->Cell(38,4,$pokokp,'LR',0,'R',true);
				$pdf->Cell(38,4,number_format($bungap,2,",","."),'LR',0,'R',true);
				$pdf->Cell(38,4,'','LR',0,'L',true);
				$pdf->ln();
			}
			$prevbooked = $ar2["TGLBOOKED"];
			$prevseatled = $ar2["TGLSEATLED"];
		}

		$sql = "SELECT saldopinjaman,bunga,angsuranbunga,kapitalisasi,totalangsuran,periodebayar
				FROM $DBUser.tabel_701_pelunasan_gadai 
				WHERE prefixpertanggungan='$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan'
					AND to_char(tglgadai,'DD/MM/YYYY')='$tglgadai'
					AND periodebayar IN (SELECT max(periodebayar)
											FROM $DBUser.tabel_701_pelunasan_gadai 
											WHERE prefixpertanggungan='$prefixpertanggungan' AND nopertanggungan ='$nopertanggungan'
												AND to_char(tglgadai,'DD/MM/YYYY') = '$tglgadai') 
				";
		$DB->parse($sql);
		$DB->execute();
		$row = $DB->nextrow();
		$totalangsuran = $row["TOTALANGSURAN"]=="" ? $row["SALDOPINJAMAN"] : $row["TOTALANGSURAN"];
		$saldoakhir    = $row["PERIODEBAYAR"]==1 ? $row["SALDOPINJAMAN"] : $totalangsuran;
		$bungaakhir    = $row["BUNGA"];
		$kapitalisasi  = $row["KAPITALISASI"];  
		$saldobaru = $saldoakhir + $kapitalisasi;

		$pdf->Cell(38,4,$prevseatled=="" ? $prevbooked : $prevseatled,'LTRB',0,'C',true);
		$pdf->Cell(38,4,'Saldo Pinjaman','LTRB',0,'L',true);
		$pdf->Cell(38,4,idNumberFormat($saldobaru),'LTRB',0,'R',true);
		$pdf->Cell(38,4,idNumberFormat($bungaakhir),'LTRB',0,'R',true);
		$pdf->Cell(38,4,'','LTRB',0,'R',true);
		$pdf->ln(7);

		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(190,4,'Data Pinjaman Polis',0,0,'L');
		$pdf->ln();
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(50,4,'Saldo Pokok per '.substr($prevbooked,0,2).' '.ucwords(strtolower($vbulan)).' '.$thn,0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$GDI->notasi.'.  '.idNumberFormat($saldobaru),0,0,'L');
		$pdf->ln();
		$pdf->Cell(50,4,'Tagihan Bunga per '.substr($prevbooked,0,2).' '.ucwords(strtolower($vbulan)).' '.$thn,0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,$GDI->notasi.'.  '.idNumberFormat($bungaakhir),0,0,'L');
		$pdf->ln();
		$pdf->Cell(50,4,'Tanggal Jatuh Tempo Bunga',0,0,'L');
		$pdf->Cell(3,4,':',0,0,'L');
		$pdf->Cell(65,4,toTglIndo($akhirbulan),0,0,'L');
		$pdf->ln(7);

		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(190,4,'Cara Pembayaran',0,0,'L');
		$pdf->ln();
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(115,4,'Pembayaran Gadai untuk Polis '.$prefixpertanggungan.'-'.$nopertanggungan.' hanya dapat dilakukan melalui Virtual Account (VA) BNI :',0,0,'L');
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(65,4,$no_va,0,0,'L');
		$pdf->ln(7);
		$pdf->Cell(190,4,'* Untuk menghindari kapitalisasi Bunga menjadi Pokok, mohon melakukan pembayaran Gadai minimal sebesar Tagihan Bunga Gadai.',0,0,'L');
		$pdf->ln(7);

		$pdf->SetFont('Arial','',7);
		$pdf->MultiCell(190,4,'Apabila ada pertanyaan mengenai pemberitahuan ini harap segera menghubungi kami di Kantor Pusat PT.Asuransi Jiwa IFG Jl. Ie H. Juanda No.34 - 10120 Telp.021-3845031 ','', '');
		$pdf->ln();
		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(190,4,'Lembar Pemberitahuan ini sah dan tidak memerlukan tandatangan Pejabat PT. Asuransi Jiwa IFG maupun stempel Perusahaan',0,0,'L');
		$pdf->ln(7);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(190,4,'Tgl. Dicetak : '.date("d/m/Y"),0,0,'L');
		$pdf->ln(7);
		$pdf->SetFont('Arial','B',9);
		$pdf->MultiCell(190,5,'APABILA SALDO BUNGA PINJAMAN TIDAK DILUNASI SAMPAI DENGAN AKHIR BULAN JUNI DAN DESEMBER, MAKA SALDO BUNGA PINJAMAN TERSEBUT AKAN DITAMBAHKAN/KAPITALISASI KE POKOK PINJAMAN PADA BULAN BERIKUTNYA','LTRB', 'L');
		$pdf->ln();


		/*** HALAMAN UNTUK MENGECEK FOLDER ***/
		$dirname = date("Y");
		$filename = "pdf_gadai/" . $dirname . "/";

		if (!file_exists($filename)) {
		    mkdir("pdf_gadai/" . $dirname, 0777);
		    
		} else {
		    
		}

		if($cetak == 0){
			$pdf->Output($filename.date("m").date("Y").'_SURAT_PEMBERITAHUAN_GADAI_'.$prefixpertanggungan.$nopertanggungan.'.pdf');

			$nama_file = date("m").date("Y").'_SURAT_PEMBERITAHUAN_GADAI_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST SET FILE_PDF = '".$nama_file."' WHERE id_blast = '".$id_blast."' AND ID_AUDIENCE = '".$id_audience."' ";
			$DB1->parse($query);
			$DB1->execute();


			/*** FUNGSI UNTUK MENYIMPAN FILE KE SERVER FTP ***/
			$ftp_server = "192.168.2.94";
			$ftp_username = "ftpuser";
			$ftp_userpass = "JS#34-ftp!";
			$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
			$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

			$file = $filename.date("m").date("Y").'_SURAT_PEMBERITAHUAN_GADAI_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			$namafileftp = 'DOKUMEN_PEMBERITAHUAN_GADAI/2019/'.date("m").date("Y").'_SURAT_PEMBERITAHUAN_GADAI_'.$prefixpertanggungan.$nopertanggungan.'.pdf';
			// upload file
			if (ftp_put($ftp_conn, $namafileftp, $file, FTP_ASCII)){
				echo "Successfully uploaded!";
			}else{
				echo "Error uploading!";
			}
			// close connection
			ftp_close($ftp_conn);
		}else{
			
		}		
	}

	if($cetak == 0){
		
	}else{
		$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST SET TGL_CETAK_SURAT = SYSDATE WHERE id_blast = '".$id_blast."' AND ID_AUDIENCE = '".$id_audience."' ";
		$DB1->parse($query);
		$DB1->execute();

		$pdf->Output();
	}
?>