<?php

define('FPDF_FONTPATH','./libs/fpdf153/font/');
require('./libs/fpdf153/fpdf.php');



$pdf=new FPDF();

$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);



include "./includes/database.php"; 
include "./includes/pertanggungan.php";
include "./includes/klien.php";
$DA = new database($userid, $passwd, $DBName);
$DB = new database($userid, $passwd, $DBName);



$sql = "select ".
            "a.prefixpertanggungan, a.tglsp, TO_CHAR(a.mulas,'DD/MM/YYYY') MULAS, a.usia_th, a.nopertanggungan, ".
          	"TO_CHAR(a.EXPIRASI,'DD/MM/YYYY') EXPIRASI, a.lamapembpremi_bl as periode_bulan,a.nopemegangpolis, ".
          	"a.lamaasuransi_th, a.lamaasuransi_bl, a.JUAMAINPRODUK, ".
          	"a.juamainproduk, a.premi1, a.premi2, a.nosp,a.kdvaluta, a.kdcarabayar,".
          	"a.kdstatusmedical,a.lamapembpremi_th,a.kdproduk, (SELECT NAMAVALUTA FROM $DBUser.TABEL_304_VALUTA WHERE KDVALUTA=a.KDVALUTA) NAMAVALUTA,".
          	"a.tglnextbook, a.tgllastpayment, ".
          	"b.namaproduk, b.keterangan, ".
          	"c.namacarabayar, ".
          	"e.gelar gelarpp,e.alamattetap01,e.alamattetap02, to_char(e.tgllahir,'dd/mm/yyyy') tgllahir,".
          	"e.kodepostetap,e.phonetetap01,e.namaklien1 as pemegangpolis, length(e.namaklien1) panjang,".
          	"f.gelar gelarttg,f.namaklien1 as tertanggung, ".
						"(select x.faktorbayar from $DBUser.tabel_311_faktor_bayar x  ".
						" where x.kdvaluta = a.kdvaluta and x.kdcarabayar = a.kdcarabayar and x.kdbasis = g.kdbasisbayar) faktorbayar ".
         "from ".
            "$DBUser.tabel_100_klien e, ".
          	"$DBUser.tabel_100_klien f, ".
          	"$DBUser.tabel_200_pertanggungan a, ".
				  	"$DBUser.tabel_247_pertanggungan_basis g, ".
          	"$DBUser.tabel_202_produk b, ".
          	"$DBUser.tabel_305_cara_bayar c ".
         "where ".
            "b.kdproduk=a.kdproduk and ".
            "a.notertanggung=f.noklien and ".
						"g.prefixpertanggungan(+)=a.prefixpertanggungan and ".
						"g.nopertanggungan(+)=a.nopertanggungan and ".
          	"a.nopemegangpolis=e.noklien and ".
          	"a.kdcarabayar=c.kdcarabayar and ".
          	"a.kdpertanggungan='2' and ".
          	"a.prefixpertanggungan='$prefix' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DA->parse($sql);
	$DA->execute();
	$today = date("j-g-Y");


	$sqlx1 = "select sum(a.premi)premitub ".
         "from ".
            "$DBUser.tabel_223_transaksi_produk a, ".
          	"$DBUser.tabel_200_pertanggungan b ".
          "where ".
            "b.prefixpertanggungan = a.prefixpertanggungan and ".
            "b.nopertanggungan=a.nopertanggungan and ".
            "a.kdbenefit in ('BNFTOPUP') and  ".						
          	"a.prefixpertanggungan='$prefix' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DB->parse($sqlx1);
	$DB->execute();
	$arrs=$DB->nextrow();
	
		
	$sqlx2 = "select sum(a.premi)premi2jsap ".
         "from ".
            "$DBUser.tabel_223_transaksi_produk a, ".
          	"$DBUser.tabel_200_pertanggungan b ".
          "where ".
            "b.prefixpertanggungan = a.prefixpertanggungan and ".
            "b.nopertanggungan=a.nopertanggungan and ".
            "a.kdjenisbenefit in ('U') and  ".
          	"a.prefixpertanggungan='$prefix' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DB->parse($sqlx2);
	$DB->execute();
	$arrr=$DB->nextrow();
	$premi2jsap =$arrr["PREMI2JSAP"];

		$arr=$DA->nextrow();
					$lamapremi = $arr["LAMAPEMBPREMI_TH"];
					$kdproduk = $arr["KDPRODUK"];
					$kdht = substr($kdproduk,0,2);
					$kdsttmed = $arr["KDSTATUSMEDICAL"];
					$kdcabar = $arr["KDCARABAYAR"];
	        $extrapremi = 5;
	        $sisabayar = $lamapremi - $extrapremi;
				  $tglcetak = $arr["TGLCETAK"];
					$fkcb = $arr["FAKTORBAYAR"];
							
				switch ($arr["KDVALUTA"]){
				  case '0':
          $macampolis = "RUPIAH DENGAN INDEX";
					break;
					case '1':
          $macampolis = "RUPIAH TANPA INDEX";
					break;
					case '3':
          $macampolis = "US DOLLAR";
					break;
					}
				
				  if($kdproduk =="JSAP1" || $kdproduk=="JSAP2") {
				 		 						 
  					 $premi1 = $premi1jsap * $fkcb;
  					 $premi2 = $premi2jsap * $fkcb;
						 
						 //echo "$premi1 = ".$premi1jsap." * ".$fkcb;
  					 }
				  else
						{
						  $premi1 = $arr["PREMI1"];
							$premi2 = $arr["PREMI2"];
						}
						
		
								
				if(($kdcabar=="X") || ($kdcarabayar=="E") || ($kdcarabayar=="J") || ($kdsttmed=="M") || ($kdht=="HT") || ($lamapremi < 5) ){
  				  $besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]."";
				} else {
					  $besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]." SELAMA 5 TAHUN ".
		                    " DAN ".$arr["NOTASI"]." ".number_format($premi2,2)." UNTUK ".$sisabayar." TAHUN BERIKUTNYA ";
				}


//$pdf = new CetakPolis(JENIS_KERTAS, MEASURE_KERTAS, UKURAN_KERTAS);

$KLN = new Klien($userid,$passwd,$arr["NOPEMEGANGPOLIS"]);

$numspace = 22;
$numindent = 12;

			
$pdf->SetFont('Arial','B',13);
$pdf->Text('90'+$numindent,'5'+$numspace,'POLIS');
$pdf->SetFont('Arial','B',13);
$pdf->Text('72'+$numindent,'10'+$numspace,"Nomor ".$prefix."-".$nopertanggungan);
$pdf->SetFont('Arial','B',13);
$pdf->Text('52'+$numindent,'20'+$numspace,'PT ASURANSI JIWA IFG');
$pdf->SetFont('Arial','',9);
$pdf->Text('75'+$numindent,'25'+$numspace,'Berkedudukan di Jakarta');
$pdf->Text('68'+$numindent,'30'+$numspace,'(Selanjutnya disebut Penanggung)');

$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'40'+$numspace,'Atas Surat Permohonan Asuransi Jiwa (SPAJ) nomor :  '.$arr["NOSP"].", beserta semua pernyataan dan keterangan yang ");
$pdf->Text('10'+$numindent,'45'+$numspace,"disampaikan oleh :");
$pdf->SetFont('Arial','B',13);
//$pdf->Text('74'+$numindent-($arr["PANJANG"]/2),'45'+$numspace,$arr["PEMEGANGPOLIS"].$arr["PANJANG"]);
$pdf->Text(83-round(($arr["PANJANG"]/2),0),'50'+$numspace,$arr["PEMEGANGPOLIS"]);
$pdf->SetFont('Arial','',9);
$pdf->Text('66'+$numindent,'55'+$numspace, "(Selanjutnya disebut Pemegang Polis)");
$pdf->Text('10'+$numindent,'65'+$numspace, "Penanggung  dengan  ini  menyatakan setuju untuk membayarkan  manfaat  atas  penyerahan  Polis  ini  berkenaan");
$pdf->Text('10'+$numindent,'70'+$numspace, "dengan  diri  Tertanggung  berdasarkan Syarat  dan ketentuan  sebagaimana  dalam data Polis, Syarat Umum Polis, ");
$pdf->Text('10'+$numindent,'75'+$numspace, "Syarat Khusus, ketentuan tambahan  dan ketentuan  lainnya (bila ada)  yang  dilekatkan/ dilampirkan  pada  Polis ini ");
$pdf->Text('10'+$numindent,'80'+$numspace, "yang merupakan bagian yang tidak terpisahkan dari Polis ini. ");


//$pdf->Image(DIRECTOR_SIGNATURE, 105, 110, 85, 20);
//$pdf->Image($filename, 20, 215, 30, 30);

//$pdf->Text('115','105', "Jakarta, ".strtoupper(date("d")." ".$pdf->GetMonthNameById(date("m"))." ".date("Y")  ) );
$pdf->Text('115','110', "PT ASURANSI JIWA IFG");
$pdf->Text('115','115', "DIREKSI,");

$pdf->Text('115','135', DIRECTOR_NAME);
//Line(float x1, float y1, float x2, float y2)
$pdf->SetLineWidth(0.1);
$pdf->Line(115,131,180,131);
$pdf->Text('115','140', "Direktur Pertanggungan");

$pdf->SetFont('Arial','B',9);
$pdf->Text('40'+$numindent,'130'+$numspace,'MOHON DIBACA KEMBALI DAN PAHAMI POLIS INI DENGAN SEKSAMA');
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'135'+$numspace, "Anda dapat membatalkan maksud Anda untuk mempertanggungkan diri Tertanggung  berdasarkan  Polis ini dengan");
$pdf->Text('10'+$numindent,'140'+$numspace, "mengembalikan  Polis  ini  pada  masa Freelook  Period, yaitu  dalam jangka  waktu  14 hari kalender sejak  Polis ini");
$pdf->Text('10'+$numindent,'145'+$numspace, "diterima  oleh  Anda, selama Anda tidak pernah mengajukan klaim atas manfaat  Asuransi  yang  ditanggung  dalam");
$pdf->Text('10'+$numindent,'150'+$numspace, "dalam Polis ini. Dalam hal terjadi yang demikian, maka kami akan melakukan hal-hal sebagai berikut :");
$pdf->Text('10'+$numindent,'160'+$numspace, "1. ");
$pdf->Text('14'+$numindent,'160'+$numspace, "Berkaitan dengan Premi Single  yang telah dibayarkan, akan kami  kembalikan  setelah  dikurangi  dengan  biaya");
$pdf->Text('14'+$numindent,'165'+$numspace, "Polis Rp. 250.000,- (duaratus limapuluh ribu rupiah) dan biaya pemeriksaan kesehatan (bila ada).");
$pdf->Text('10'+$numindent,'170'+$numspace, "2. ");
$pdf->Text('14'+$numindent,'170'+$numspace, "Berkaitan dengan Top Up Premi Single yang telah dibayarkan, akan  kami  kembalikan  Nilai  Tunai  atas Top Up ");
$pdf->Text('14'+$numindent,'175'+$numspace, "Premi Single ditambah dengan biaya  Top Up Premi Single.");


$pdf->SetLeftMargin(35);
$pdf->SetTopMargin(20);
$pdf->AddPage();
//$pdf->WaterMarkBack( "S  P  E  C  I  M  E  N" );
$pdf->SetFont('Arial','B',9);
$pdf->Text('95','5'+$numspace,'DATA POLIS');
$pdf->SetFont('Arial','B',9);
$pdf->Text('90','10'+$numspace, "Nomor ".$prefix."-".$nopertanggungan);
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'40'+$numspace, "Nama Pemegang Polis ");
$pdf->Text('65'+$numindent,'40'+$numspace," :  ".$arr["PEMEGANGPOLIS"]);
$pdf->Text('10'+$numindent,'45'+$numspace, "Macam Asuransi ");
$pdf->Text('65'+$numindent,'45'+$numspace," :  ".$arr["NAMAPRODUK"]);
$pdf->Text('10'+$numindent,'50'+$numspace, "Mulai Asuransi ");
$pdf->Text('65'+$numindent,'50'+$numspace," :  ".$arr["MULAS"]);
$pdf->Text('10'+$numindent,'55'+$numspace, "Valuta ");
$pdf->Text('65'+$numindent,'55'+$numspace," :  ".$arr["NAMAVALUTA"]);
$pdf->Text('10'+$numindent,'60'+$numspace, "Premi Reguler ");
$pdf->Text('65'+$numindent,'60'+$numspace," :  ".number_format($premi1,2));
$pdf->Text('10'+$numindent,'65'+$numspace, "Top Up Reguler ");
$pdf->Text('65'+$numindent,'65'+$numspace," :  ".number_format($arrs["PREMITUB"],2));
$pdf->Text('10'+$numindent,'70'+$numspace, "Cara Bayar Premi");
$pdf->Text('65'+$numindent,'70'+$numspace," :  ".$arr["NAMACARABAYAR"]);
$pdf->Text('10'+$numindent,'80'+$numspace, "Penerima Manfaat Asuransi");

$sql  = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,  ".
 		"NVL(DECODE(A.NOTERTANGGUNG,A.NOKLIEN,'TERTANGGUNG',  ".
 		"DECODE(B.KDHUBUNGAN,'2',(SELECT NAMAHUBUNGAN FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
		"WHERE B.KDHUBUNGAN=C.KDHUBUNGAN),(SELECT NAMAHUBUNGAN||' '||'TERTANGGUNG' FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
      	"WHERE B.KDHUBUNGAN=C.KDHUBUNGAN))),'') NAMAHUBUNGAN,  ".
		"D.NAMAKLIEN1,d.gelar  ".
		"FROM  $DBUser.TABEL_219_PEMEGANG_POLIS_BAW A,  ".
  		"$DBUser.TABEL_113_INSURABLE B,  ".
  		"$DBUser.TABEL_100_KLIEN D ".
		"WHERE A.NOTERTANGGUNG=B.NOTERTANGGUNG(+) ".
		"AND A.NOKLIEN=B.NOKLIENINSURABLE(+) ".
		"AND A.NOKLIEN=D.NOKLIEN ".
		"and A.PREFIXPERTANGGUNGAN='$prefix'".
		"and A.NOPERTANGGUNGAN='$nopertanggungan' ".
		"ORDER BY A.NOURUT ";
       	$DB->parse($sql);
       	$DB->execute();
       	$i = 0;
		$y = 85+$numspace;
       	while($ars=$DB->nextrow())
		{
       	   $nama = (strlen($ars["GELAR"])==0) ? $ars["NAMAKLIEN1"].",".$ars["GELAR"] : $ars["NAMAKLIEN1"];
     	   if ($ars["KDINSURABLE"]=='04') 
		   {
           	    $hub=($ars["NOKLIEN"]==$ars["NOTERTANGGUNG"]) ? "DIRI TERTANGGUNG" : "BELUM DIDEFINISIKAN";
           } 
		   else 
		   {
             	$hub = $ars["NAMAHUBUNGAN"];
           }		 
                		 $pdf->Text('10'+$numindent,$y, trim($ars["NOURUT"]).". ".trim($ars["NAMAHUBUNGAN"]).", ".trim($nama));
				
                		
                
				$i++;
				$y = $y+5;
				
    		}


$pdf->Text('10'+$numindent,'120'+$numspace, "Nama Tertanggung Utama ");
$pdf->Text('65'+$numindent,'120'+$numspace," :  ".$arr["PEMEGANGPOLIS"]);
$pdf->Text('125'+$numindent,'120'+$numspace, "Tanggal Lahir ");
$pdf->Text('145'+$numindent,'120'+$numspace," :  ".$arr["TGLLAHIR"]);
$pdf->Text('10'+$numindent,'125'+$numspace, "Nama Tertanggung Tambahan 1 ");
$pdf->Text('65'+$numindent,'125'+$numspace," :  ");
$pdf->Text('125'+$numindent,'125'+$numspace, "Tanggal Lahir ");
$pdf->Text('145'+$numindent,'125'+$numspace," :  ");
$pdf->Text('10'+$numindent,'130'+$numspace, "Nama Tertanggung Tambahan 2 ");
$pdf->Text('65'+$numindent,'130'+$numspace," :  ");
$pdf->Text('125'+$numindent,'130'+$numspace, "Tanggal Lahir ");
$pdf->Text('145'+$numindent,'130'+$numspace," :  ");

$pdf->SetLineWidth(0.1);
$pdf->Line(10+$numindent,157,190,157);
$pdf->Text('10'+$numindent,'140'+$numspace, "Macam Asuransi");
$pdf->Text('45'+$numindent,'140'+$numspace, "Keterntuan &");
$pdf->Text('45'+$numindent,'145'+$numspace, "Manfaat di");
$pdf->Text('70'+$numindent,'140'+$numspace, "Uang Asuransi");
$pdf->Text('100'+$numindent,'140'+$numspace, "Atas Diri");
$pdf->Text('100'+$numindent,'145'+$numspace, "Tertanggung");
$pdf->Text('125'+$numindent,'140'+$numspace, "Tanggal Akhir");
$pdf->Text('125'+$numindent,'145'+$numspace, "Asuransi");
$pdf->Text('153'+$numindent,'140'+$numspace, "Tanggal Akhir");
$pdf->Text('153'+$numindent,'145'+$numspace, "Pengenaan Biaya");
$pdf->Text('153'+$numindent,'150'+$numspace, "Asuransi");
$pdf->Line(10+$numindent,175,190,175);

$pdf->SetFont('Arial','',8);

$pdf->Text('10'+$numindent,'160'+$numspace, "Asuransi Dasar");
$pdf->Text('10'+$numindent,'165'+$numspace, $arr["NAMAPRODUK"]);
$pdf->Text('50'+$numindent,'165'+$numspace, $arr["KDPRODUK"]);
$pdf->Text('70'+$numindent,'165'+$numspace,number_format($arr["JUAMAINPRODUK"],2));
$pdf->Text('105'+$numindent,'165'+$numspace, "UTAMA");
$pdf->Text('125'+$numindent,'165'+$numspace, $arr["EXPIRASI"]);
$pdf->Text('155'+$numindent,'165'+$numspace, $arr["EXPIRASI"]);

$pdf->Text('10'+$numindent,'175'+$numspace, "Asuransi Tambahan");
$sql  = "select a.*,b.*, to_char(a.akhirpmb,'dd/mm/yyyy') exp from $DBUser.TABEL_223_TRANSAKSI_PRODUK A, $DBUser.TABEL_207_KODE_BENEFIT B ".
		"WHERE PREFIXPERTANGGUNGAN='$prefix'".
		"and NOPERTANGGUNGAN='$nopertanggungan' ".
		"AND A.KDJENISBENEFIT='R' AND A.KDBENEFIT=B.KDBENEFIT";
		
       	$DB->parse($sql);
       	$DB->execute();
       	$i = 0;
		$y = 180+$numspace;
       	while($ars=$DB->nextrow())
		{
		 	$pdf->Text('10'+$numindent,$y, trim($ars["NAMABENEFIT"]));
			$pdf->Text('50'+$numindent,$y, trim($ars["KDBENEFIT"]));
			$pdf->Text('70'+$numindent,$y, number_format($ars["NILAIBENEFIT"],2));
			$pdf->Text('105'+$numindent,$y, "UTAMA");
			$pdf->Text('125'+$numindent,$y, $ars["EXP"]);
			$pdf->Text('155'+$numindent,$y, $ars["EXP"]);
				$i++;
				$y = $y+5;
    		}
$pdf->SetLeftMargin(35);
$pdf->SetTopMargin(20);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'5'+$numspace,'Asuransi Tambahan dan Keterntuan Khusus yang tidak berlaku');
$sql  = "SELECT   *
		  FROM   $DBUser.TABEL_206_PRODUK_BENEFIT a, $DBUser.TABEL_207_KODE_BENEFIT b
		 WHERE   kdproduk = 'JL4X' AND a.kdjenisbenefit = 'R'
				 AND a.kdbenefit NOT IN
						  (SELECT   kdbenefit
							 FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK
							WHERE       prefixpertanggungan = 'AC'
									AND nopertanggungan = '001779346'
									AND kdjenisbenefit = 'R')
				 AND a.kdbenefit = b.kdbenefit";
$DB->parse($sql);
       	$DB->execute();
       	$y = 35;
		$y = $y+$numspace-5;
       	while($ars=$DB->nextrow())
		{
		 	$pdf->Text('10'+$numindent,$y, trim($ars["NAMABENEFIT"]));
			$pdf->Text('105'+$numindent,$y, trim($ars["KDBENEFIT"]));
				$i++;
				$y = $y+5;
    		}
			
$pdf->Text('10'+$numindent,'20'+$numspace,'Asuransi Tambahan');
$pdf->Text('105'+$numindent,'20'+$numspace,'Ketentuan & Manfaat di');
$pdf->SetFont('Arial','',9);

$pdf->Text('10'+$numindent,'145'+$numspace, 'Pilihan Jenis Investasi Awal :');
$sql  = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B ".
		"WHERE A.KDFUND=B.KDFUND AND PREFIXPERTANGGUNGAN='$prefix'".
		"and NOPERTANGGUNGAN='$nopertanggungan' ".
		"AND STATUS='0'";
       	$DB->parse($sql);
       	$DB->execute();
       	$y = 155;
		$y = $y+$numspace-5;
       	while($ars=$DB->nextrow())
		{
		 	$pdf->Text('10'+$numindent,$y, trim($ars["NAMAFUND"]));
			$pdf->Text('105'+$numindent,$y, trim($ars["PORSI"]).' %');
				$i++;
				$y = $y+5;
    		}

			
$pdf->Text('10'+$numindent,$y+40, 'Presentase Alokasi Dana Berdasarkan Tahun Polis');
$pdf->SetLineWidth(0.1);
$pdf->Line(10+$numindent,$y+46,190,$y+46);

$pdf->Text('10'+$numindent,$y+50, 'Presentase Dana Investasi dari premi dan Top Up');
$pdf->Text('10'+$numindent,$y+55, 'Reguler berdasarkan Tahun Polis');

$pdf->Text('100'+$numindent,$y+50, 'Presentase Biaya Akuisisi dari Premi Reguler dan');
$pdf->Text('100'+$numindent,$y+55, 'Biaya Top Up dari Top Up');
$pdf->Text('100'+$numindent,$y+60, 'Berdasarkan Tahun Polis');
$pdf->Line(10+$numindent,$y+62,190,$y+62);

$pdf->Text('10'+$numindent,$y+67, 'Tahun Polis');
$pdf->Text('30'+$numindent,$y+67, 'Premi Reguler');
$pdf->Text('55'+$numindent,$y+67, 'Top Up Reguler');

$pdf->Text('100'+$numindent,$y+67, 'Premi Reguler');
$pdf->Text('135'+$numindent,$y+67, 'Top Up Reguler');

$pdf->Text('10'+$numindent,$y+75, '1');
$pdf->Text('30'+$numindent,$y+75, '10%');
$pdf->Text('55'+$numindent,$y+75, '95%');

$pdf->Text('100'+$numindent,$y+75, '90%');
$pdf->Text('135'+$numindent,$y+75, '5%');

$pdf->Text('10'+$numindent,$y+80, '2');
$pdf->Text('30'+$numindent,$y+80, '50%');
$pdf->Text('55'+$numindent,$y+80, '95%');

$pdf->Text('100'+$numindent,$y+80, '50%');
$pdf->Text('135'+$numindent,$y+80, '5%');

$pdf->Text('10'+$numindent,$y+85, '3');
$pdf->Text('30'+$numindent,$y+85, '60%');
$pdf->Text('55'+$numindent,$y+85, '95%');

$pdf->Text('100'+$numindent,$y+85, '40%');
$pdf->Text('135'+$numindent,$y+85, '5%');

$pdf->Text('10'+$numindent,$y+90, '4');
$pdf->Text('30'+$numindent,$y+90, '70%');
$pdf->Text('55'+$numindent,$y+90, '95%');

$pdf->Text('100'+$numindent,$y+90, '30%');
$pdf->Text('135'+$numindent,$y+90, '5%');

$pdf->Text('10'+$numindent,$y+95, '5');
$pdf->Text('30'+$numindent,$y+95, '90%');
$pdf->Text('55'+$numindent,$y+95, '95%');

$pdf->Text('100'+$numindent,$y+95, '10%');
$pdf->Text('135'+$numindent,$y+95, '5%');

$pdf->Text('10'+$numindent,$y+100, '6 dst');
$pdf->Text('30'+$numindent,$y+100, '100%');
$pdf->Text('55'+$numindent,$y+100, '95%');

$pdf->Text('100'+$numindent,$y+100, '0%');
$pdf->Text('135'+$numindent,$y+100, '5%');

$pdf->Line(10+$numindent,$y+103,190,$y+103);
$pdf->Output();


?>