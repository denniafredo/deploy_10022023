<?php

define('FPDF_FONTPATH','./libs/fpdf153/font/');
require('./libs/fpdf153/fpdf.php');

// include "./includes/database.php"; 
// include "./includes/pertanggungan.php";
// include "./includes/klien.php";
// $DA = new database($userid, $passwd, $DBName);
// $DB = new database($userid, $passwd, $DBName);

include "./includes/database.php"; 
include "./includes/session.php"; 
include "./includes/common.php";
include "./includes/pertanggungan.php";	
include "./includes/duit.php";
include "./includes/klien.php";

$DA=New database($userid, $passwd, $DBName);
$DB = New database($userid, $passwd, $DBName);

class CetakPolis extends FPDF
{
	function GetMonthNameById($m){
		
		switch ($m) {
			case "1": 
				$m = "Januari"; 
			break;
			case "2": 
				$m = "Februari";
			break;
			case "3": 
				$m = "Maret";
			break;
			case "4": 
				$m = "April";
			break;
			case "5": 
				$m = "Mei";
			break;
			case "6": 
				$m = "Juni";
			break;
			case "7": 
				$m = "Juli";
			break;
			case "8": 
				$m = "Agustus";
			break;
			case "9": 
				$m = "September";
			break;
			case "10": 
				$m = "Oktober";
			break;
			case "11": 
				$m = "November";
			break;
			case "12": 
				$m = "Desember";
			break;
		}
		return $m;
	}
}

$pdf=new CetakPolis();

$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);




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

			
$pdf->SetFont('Arial','B',12);
$pdf->Text('143'+$numindent,'5'+$numspace,'NOMOR POLIS');
$pdf->SetFont('Arial','B',12);
$pdf->Text('144'+$numindent,'10'+$numspace,$prefix."-".$nopertanggungan);
$pdf->SetFont('Arial','B',12);
$pdf->Text('52'+$numindent,'20'+$numspace,'PT ASURANSI JIWA IFG');
$pdf->SetFont('Arial','',9);
$pdf->Text('70'+$numindent,'25'+$numspace,'BERKEDUDUKAN DI JAKARTA');
$pdf->Text('63'+$numindent,'30'+$numspace,'SELANJUTNYA DISEBUT PERUSAHAAN');

$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'40'+$numspace,'Atas Surat Permohonan Asuransi Jiwa (SPAJ) nomor :');  //'.$arr["NOSP"].", beserta semua pernyataan dan keterangan yang ");
$pdf->SetFont('Arial','B',9);
$pdf->Text('88'+$numindent,'40'+$numspace,$arr["NOSP"]);
$pdf->SetFont('Arial','',9);
$pdf->Text('103'+$numindent,'40'+$numspace,", beserta semua pernyataan dan keterangan yang");
$pdf->Text('10'+$numindent,'45'+$numspace,"disampaikan oleh :");
$pdf->SetFont('Arial','B',12);
//$pdf->Text('74'+$numindent-($arr["PANJANG"]/2),'45'+$numspace,$arr["PEMEGANGPOLIS"].$arr["PANJANG"]);
//$pdf->Text(90-round(($arr["PANJANG"]/2),0),'58'+$numspace,$arr["PEMEGANGPOLIS"]);
$pdf->setY(74);
$pdf->setX(21);
$pdf->Cell(165, 10, $arr["PEMEGANGPOLIS"], 0, 1, "C");
$pdf->SetFont('Arial','',9);
$pdf->Text('66'+$numindent,'63'+$numspace, "(Selanjutnya disebut Pemegang Polis)");
$pdf->Text('10'+$numindent,'70'+$numspace, "Penanggung  dengan  ini  menyatakan setuju untuk membayarkan  manfaat  atas  penyerahan  Polis  ini  berkenaan");
$pdf->Text('10'+$numindent,'75'+$numspace, "dengan  diri  Tertanggung  berdasarkan Syarat  dan ketentuan  sebagaimana  dalam data Polis, Syarat Umum Polis, ");
$pdf->Text('10'+$numindent,'80'+$numspace, "Syarat Khusus, ketentuan tambahan  dan ketentuan  lainnya (bila ada)  yang  dilekatkan/ dilampirkan  pada  Polis ini ");
$pdf->Text('10'+$numindent,'85'+$numspace, "yang merupakan bagian yang tidak terpisahkan dari Polis ini. ");


//$pdf->Image(DIRECTOR_SIGNATURE, 105, 110, 85, 20);
//$pdf->Image($filename, 20, 215, 30, 30);

$pdf->Text('115','115', "Jakarta, ".date("d")." ".$pdf->GetMonthNameById(date("m"))." ".date("Y")  ) ;
//$pdf->Text('115','115', "Jakarta, 21 Januari 2014");
$pdf->Text('115','120', "PT ASURANSI JIWA IFG");

//$pdf->SetLineWidth(0.1);
$pdf->Line(62+$numindent,142,110,142);
$pdf->Text(67+$numindent,145, "Bea Materai Lunas");
$pdf->Line(62+$numindent,142,62+$numindent,152); //garis vertikal
$pdf->Line(62+$numindent,147,110,147); 
$pdf->Text(73+$numindent,151, "Rp. 6000");
$pdf->Line(110,142,110,152); //garis vertikal
$pdf->Line(62+$numindent,152,110,152);

$pdf->Text('10'+$numindent,'145', "Bagian Polis & Underwriting PP");
$pdf->Text('115','145', "Hendrisman Rahim");
$pdf->Image('./images/ttd_dir.png', 110,120,70);
//Line(float x1, float y1, float x2, float y2)
//$pdf->SetLineWidth(0.1);
//$pdf->Line(115,131,180,131);
$pdf->Text('10'+$numindent,'150', "Verifikator");
$pdf->Text('115','150', "Direktur Pertanggungan");

$pdf->SetFont('Arial','B',9);
$pdf->Text('55'+$numindent,'143'+$numspace,'MOHON PELAJARI POLIS INI DENGAN CERMAT');
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'150'+$numspace, "Anda dapat membatalkan maksud Anda untuk mempertanggungkan diri Tertanggung  berdasarkan  Polis ini dengan");
$pdf->Text('10'+$numindent,'155'+$numspace, "mengembalikan  Polis  ini  pada  masa Freelook  Period, yaitu  dalam jangka  waktu  10  hari  kerja  sejak  Polis ini");
$pdf->Text('10'+$numindent,'160'+$numspace, "diterima  oleh  Anda, selama Anda tidak pernah mengajukan klaim atas manfaat  Asuransi  yang  ditanggung  dalam");
$pdf->Text('10'+$numindent,'165'+$numspace, "dalam Polis ini. Dalam hal terjadi yang demikian, maka kami akan melakukan hal-hal sebagai berikut :");
$pdf->Text('10'+$numindent,'175'+$numspace, "1. ");
$pdf->Text('14'+$numindent,'175'+$numspace, "Berkaitan dengan Premi Single  yang telah dibayarkan, akan kami  kembalikan  setelah  dikurangi  dengan  biaya");
$pdf->Text('14'+$numindent,'180'+$numspace, "Polis Rp. 150.000,- (duaratus limapuluh ribu rupiah) dan biaya pemeriksaan kesehatan (bila ada).");
$pdf->Text('10'+$numindent,'185'+$numspace, "2. ");
$pdf->Text('14'+$numindent,'185'+$numspace, "Berkaitan dengan Top Up Premi Single yang telah dibayarkan, akan  kami  kembalikan  Nilai  Tunai  atas Top Up ");
$pdf->Text('14'+$numindent,'190'+$numspace, "Premi Single ditambah dengan biaya  Top Up Premi Single.");


$pdf->SetLeftMargin(35);
$pdf->SetTopMargin(20);
$pdf->AddPage();
//$pdf->WaterMarkBack( "S  P  E  C  I  M  E  N" );
$pdf->SetFont('Arial','B',12);
$pdf->Text('95','20'+$numspace,'DATA POLIS');
$pdf->SetFont('Arial','B',12);
$pdf->Text('85','25'+$numspace, "NOMOR ".$prefix."-".$nopertanggungan);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'40'+$numspace, "Nama Pemegang Polis ");
$pdf->Text('66'+$numindent,'40'+$numspace,":            ".$arr["PEMEGANGPOLIS"]);
$pdf->Text('10'+$numindent,'45'+$numspace, "Macam Asuransi ");
$pdf->Text('66'+$numindent,'45'+$numspace,":            ".$arr["NAMAPRODUK"]);
$pdf->Text('10'+$numindent,'50'+$numspace, "Mulai Asuransi ");
$pdf->Text('66'+$numindent,'50'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'50'+$numspace, $arr["MULAS"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'55'+$numspace, "Valuta ");
$pdf->Text('66'+$numindent,'55'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'55'+$numspace, $arr["NAMAVALUTA"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'60'+$numspace, "Premi Single ");
$pdf->SetFont('Arial','',9);
$pdf->Text('66'+$numindent,'60'+$numspace, ":            Rp.");
$pdf->Text('85'+$numindent,'60'+$numspace, number_format($premi1,2));
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'65'+$numspace, "Top Up Single ");

$pdf->SetFont('Arial','',9);
$pdf->Text('66'+$numindent,'65'+$numspace, ":            Rp.");
$pdf->Text('85'+$numindent,'65'+$numspace, number_format($arrs["PREMITUB"],2));
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'70'+$numspace, "Cara Bayar Premi");
$pdf->Text('66'+$numindent,'70'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'70'+$numspace, $arr["NAMACARABAYAR"]);

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'80'+$numspace, "Penerima Manfaat Asuransi");
$pdf->SetFont('Arial','',9);

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

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'5'+$y, "Nama Tertanggung Utama");
$pdf->Text('66'+$numindent,'5'+$y, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('70'+$numindent,'5'+$y,$arr["TERTANGGUNG"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('133'+$numindent,'5'+$y, "Tanggal Lahir");
$pdf->Text('157'+$numindent,'5'+$y, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('160'+$numindent,'5'+$y,$arr["TGLLAHIR"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'10'+$y, "Nama Pemegang Polis");
$pdf->Text('66'+$numindent,'10'+$y,":");
$pdf->SetFont('Arial','',9);
$pdf->Text('70'+$numindent,'10'+$y,$arr["PEMEGANGPOLIS"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('133'+$numindent,'10'+$y, "Tanggal Lahir");
$pdf->Text('157'+$numindent,'10'+$y,":");
$pdf->SetFont('Arial','',9);
$pdf->Text('160'+$numindent,'10'+$y,$arr["TGLLAHIR"]);

$pdf->SetFont('Arial','B',9);


// $pdf->SetLineWidth(0.1);
// $pdf->Line(10+$numindent,116,190,116);
// $pdf->Text('10'+$numindent,'105'+$numspace, "Macam Asuransi");
// $pdf->Text('45'+$numindent,'100'+$numspace, "Ketentuan &");
// $pdf->Text('45'+$numindent,'105'+$numspace, "Manfaat di");
// $pdf->Text('70'+$numindent,'105'+$numspace, "Uang Asuransi");
// $pdf->Text('100'+$numindent,'100'+$numspace, "Atas Diri");
// $pdf->Text('100'+$numindent,'105'+$numspace, "Tertanggung");
// $pdf->Text('125'+$numindent,'100'+$numspace, "Tanggal");
// $pdf->Text('125'+$numindent,'105'+$numspace, "Akhir");
// $pdf->Text('125'+$numindent,'110'+$numspace, "Asuransi");
// $pdf->Text('152'+$numindent,'100'+$numspace, "Tanggal Akhir");
// $pdf->Text('152'+$numindent,'105'+$numspace, "Pengenaan Biaya");
// $pdf->Text('152'+$numindent,'110'+$numspace, "Asuransi");
// $pdf->Line(10+$numindent,136,190,136);

//Bikin header kolom dengan background warna abu2
$pdf->setY(15+$y);
$pdf->setX(21);
$pdf->SetFillColor(224,224,224);
$pdf->Cell(170, 17, "", 0, 1, "L", true); 
$pdf->Text('15'+$numindent,'25'+$y, "Macam Asuransi");
$pdf->Text('45'+$numindent,'20'+$y, "Ketentuan &");
$pdf->Text('46'+$numindent,'25'+$y, "Manfaat di");
$pdf->Text('70'+$numindent,'20'+$y, "Uang Asuransi");
$pdf->Text('103'+$numindent,'20'+$y, "Atas Diri");
$pdf->Text('100'+$numindent,'25'+$y, "Tertanggung");
$pdf->Text('128'+$numindent,'20'+$y, "Tanggal");
$pdf->Text('130'+$numindent,'25'+$y, "Akhir");
$pdf->Text('127'+$numindent,'30'+$y, "Asuransi");
$pdf->Text('153'+$numindent,'20'+$y, "Tanggal Akhir");
$pdf->Text('150'+$numindent,'25'+$y, "Pengenaan Biaya");
$pdf->Text('157'+$numindent,'30'+$y, "Asuransi");

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'40'+$y, "ASURANSI DASAR");
$pdf->SetFont('Arial','',8);
$pdf->Text('10'+$numindent,'45'+$y, $arr["NAMAPRODUK"]);
$pdf->Text('50'+$numindent,'45'+$y, $arr["KDPRODUK"]);
$pdf->Text('71'+$numindent,'45'+$y, number_format($arr["JUAMAINPRODUK"],2));
$pdf->Text('104'+$numindent,'45'+$y, "UTAMA");
$pdf->Text('127'+$numindent,'45'+$y, $arr["EXPIRASI"]);
$pdf->Text('157'+$numindent,'45'+$y, $arr["EXPIRASI"]);
// $pdf->Text('10'+$numindent,'165'+$numspace, $arr["NAMAPRODUK"]);
// $pdf->Text('50'+$numindent,'165'+$numspace, $arr["KDPRODUK"]);
// $pdf->Text('70'+$numindent,'165'+$numspace,number_format($arr["JUAMAINPRODUK"],2));
// $pdf->Text('105'+$numindent,'165'+$numspace, "UTAMA");
// $pdf->Text('125'+$numindent,'165'+$numspace, $arr["EXPIRASI"]);
// $pdf->Text('155'+$numindent,'165'+$numspace, $arr["EXPIRASI"]);

// $pdf->Text('10'+$numindent,'175'+$numspace, "Asuransi Tambahan");
// $sql  = "select a.*,b.*, to_char(a.akhirpmb,'dd/mm/yyyy') exp from $DBUser.TABEL_223_TRANSAKSI_PRODUK A, $DBUser.TABEL_207_KODE_BENEFIT B ".
		// "WHERE PREFIXPERTANGGUNGAN='$prefix'".
		// "and NOPERTANGGUNGAN='$nopertanggungan' ".
		// "AND A.KDJENISBENEFIT='R' AND A.KDBENEFIT=B.KDBENEFIT";
       	// $DB->parse($sql);
       	// $DB->execute();
       	// $i = 0;
		// $y = 180+$numspace;
       	// while($ars=$DB->nextrow())
		// {
		 	// $pdf->Text('10'+$numindent,$y, trim($ars["NAMABENEFIT"]));
			// $pdf->Text('50'+$numindent,$y, trim($ars["KDBENEFIT"]));
			// $pdf->Text('70'+$numindent,$y, number_format($ars["NILAIBENEFIT"],2));
			// $pdf->Text('105'+$numindent,$y, "UTAMA");
			// $pdf->Text('125'+$numindent,$y, $ars["EXP"]);
			// $pdf->Text('155'+$numindent,$y, $ars["EXP"]);
				// $i++;
				// $y = $y+5;
    		// }
// $pdf->SetLeftMargin(35);
// $pdf->SetTopMargin(20);
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Text('90','20'+$numspace,'LAMPIRAN POLIS');
$pdf->SetFont('Arial','B',12);
$pdf->Text('85','25'+$numspace, "NOMOR ".$prefix.$nopertanggungan);

$pdf->SetFont('Arial','B',9);

//$pdf->Text('10'+$numindent,'35'+$numspace,'Asuransi Tambahan dan Ketentuan Khusus yang tidak berlaku');
// $sql  = "SELECT   *
		  // FROM   $DBUser.TABEL_206_PRODUK_BENEFIT a, $DBUser.TABEL_207_KODE_BENEFIT b
		 // WHERE   kdproduk = 'JL4X' AND a.kdjenisbenefit = 'R'
				 // AND a.kdbenefit NOT IN
						  // (SELECT   kdbenefit
							 // FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK
							// WHERE       prefixpertanggungan = 'AC'
									// AND nopertanggungan = '001779346'
									// AND kdjenisbenefit = 'R')
				 // AND a.kdbenefit = b.kdbenefit";
// $DB->parse($sql);
       	// $DB->execute();
       	// $y = 35;
		// $y = $y+$numspace-5;
       	// while($ars=$DB->nextrow())
		// {
		 	// $pdf->Text('10'+$numindent,$y, trim($ars["NAMABENEFIT"]));
			// $pdf->Text('105'+$numindent,$y, trim($ars["KDBENEFIT"]));
				// $i++;
				// $y = $y+5;
    		// }
			
// $pdf->Text('10'+$numindent,'20'+$numspace,'Asuransi Tambahan');
// $pdf->Text('105'+$numindent,'20'+$numspace,'Ketentuan & Manfaat di');
// $pdf->SetFont('Arial','',9);

if($arr["KDPRODUK"] != "JL4B")
{

$pdf->Text('10'+$numindent,'35'+$numspace, 'Pilihan Jenis Dana Investasi Awal :');
$pdf->SetFont('Arial','',9);
$sql  = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B ".
		"WHERE A.KDFUND=B.KDFUND AND PREFIXPERTANGGUNGAN='$prefix'".
		"and NOPERTANGGUNGAN='$nopertanggungan'";
       	$DB->parse($sql);
       	$DB->execute();
       	$y = 46;
		$y = $y+$numspace-5;
       	while($ars=$DB->nextrow())
		{
		 	$pdf->Text('10'+$numindent,$y, trim($ars["NAMAFUND"]));
			$pdf->Text('105'+$numindent,$y, trim($ars["PORSI"]).' %');
				$i++;
				$y = $y+5;
    	}

$pdf->SetFont('Arial','B',9);			
$pdf->Text('10'+$numindent,$y+40, 'Alokasi Dana atas Premi Single');
$pdf->SetFont('Arial','',9);		
$pdf->Text('10'+$numindent,$y+46, 'Persentasi Porsi Dana Investasi atas Premi Single adalah 95%');
$pdf->Text('10'+$numindent,$y+51, 'Prosentasi Biaya Akuisisi atas Premi Single adalah 5%');

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,$y+59, 'Alokasi Dana atas Top Up Premi Single');
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,$y+64, 'Persentasi Porsi Dana Investasi atas Top Up Premi Single adalah 95%');
$pdf->Text('10'+$numindent,$y+69, 'Prosentasi Biaya Top Up atas Top Up Premi Single adalah 5%');

}
else
{

$pdf->Text('10'+$numindent,'37'+$numspace,'Asuransi Tambahan dan Ketentuan Khusus yang tidak berlaku');
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'45'+$numspace,'Asuransi Tambahan');
$pdf->Text('105'+$numindent,'45'+$numspace,'Ketentuan & Manfaat di');
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'50'+$numspace,'UL - SPOUSE PAYOR TPD');
$pdf->Text('115'+$numindent,'50'+$numspace,'SPTPD');
$pdf->Text('10'+$numindent,'55'+$numspace,'UL - PAYOR TPD');
$pdf->Text('115'+$numindent,'55'+$numspace,'PBTPD');
$pdf->Text('10'+$numindent,'60'+$numspace,'UL - PAYOR DEATH');
$pdf->Text('117'+$numindent,'60'+$numspace,'PBD');
$pdf->Text('10'+$numindent,'65'+$numspace,'UL - CRITICAL ILLNESS 53');
$pdf->Text('117'+$numindent,'65'+$numspace,'CI53');
$pdf->Text('10'+$numindent,'70'+$numspace,'UL - ACC DEATH & DIS BENEFIT');
$pdf->Text('116'+$numindent,'70'+$numspace,'ADDB');
$pdf->Text('10'+$numindent,'75'+$numspace,'UL - SPOUSE PAYOR DEATH');
$pdf->Text('116'+$numindent,'75'+$numspace,'SPBD');

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'85'+$numspace, 'Pilihan Jenis Dana Investasi Awal :');
$pdf->SetFont('Arial','',9);
$sql  = "select * from $DBUser.TABEL_UL_OPSI_FUND A, $DBUser.TABEL_UL_KODE_FUND B ".
		"WHERE A.KDFUND=B.KDFUND AND PREFIXPERTANGGUNGAN='$prefix'".
		"and NOPERTANGGUNGAN='$nopertanggungan'";
       	$DB->parse($sql);
       	$DB->execute();
       	$y = 93;
		$y = $y+$numspace-5;
       	while($ars=$DB->nextrow())
		{
		 	$pdf->Text('10'+$numindent,$y, trim($ars["NAMAFUND"]));
			$pdf->Text('105'+$numindent,$y, trim($ars["PORSI"]).' %');
				$i++;
				$y = $y+5;
    	}

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,$y+40, 'Presentase Alokasi Dana Berdasarkan Tahun Polis');
$pdf->SetFont('Arial','',9);
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

$pdf->Text('17'+$numindent,$y+75, '1');
$pdf->Text('36'+$numindent,$y+75, '10%');
$pdf->Text('63'+$numindent,$y+75, '95%');

$pdf->Text('107'+$numindent,$y+75, '90%');
$pdf->Text('144'+$numindent,$y+75, '5%');

$pdf->Text('17'+$numindent,$y+80, '2');
$pdf->Text('36'+$numindent,$y+80, '50%');
$pdf->Text('63'+$numindent,$y+80, '95%');

$pdf->Text('107'+$numindent,$y+80, '50%');
$pdf->Text('144'+$numindent,$y+80, '5%');

$pdf->Text('17'+$numindent,$y+85, '3');
$pdf->Text('36'+$numindent,$y+85, '60%');
$pdf->Text('63'+$numindent,$y+85, '95%');

$pdf->Text('107'+$numindent,$y+85, '40%');
$pdf->Text('144'+$numindent,$y+85, '5%');

$pdf->Text('17'+$numindent,$y+90, '4');
$pdf->Text('36'+$numindent,$y+90, '70%');
$pdf->Text('63'+$numindent,$y+90, '95%');

$pdf->Text('107'+$numindent,$y+90, '30%');
$pdf->Text('144'+$numindent,$y+90, '5%');

$pdf->Text('17'+$numindent,$y+95, '5');
$pdf->Text('36'+$numindent,$y+95, '90%');
$pdf->Text('63'+$numindent,$y+95, '95%');

$pdf->Text('107'+$numindent,$y+95, '10%');
$pdf->Text('144'+$numindent,$y+95, '5%');

$pdf->Text('14'+$numindent,$y+100, '6 dst');
$pdf->Text('35'+$numindent,$y+100, '100%');
$pdf->Text('63'+$numindent,$y+100, '95%');

$pdf->Text('108'+$numindent,$y+100, '0%');
$pdf->Text('144'+$numindent,$y+100, '5%');

$pdf->Line(10+$numindent,$y+103,190,$y+103);
}

$pdf->Output();



?>