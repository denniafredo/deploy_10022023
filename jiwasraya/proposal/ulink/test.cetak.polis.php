<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include "./includes/session.php";
define('FPDF_FONTPATH','./libs/fpdf153/font/');


// include "./includes/database.php"; 
// include "./includes/pertanggungan.php";
// include "./includes/klien.php";
// $DA = new database($userid, $passwd, $DBName);
// $DB = new database($userid, $passwd, $DBName);



include "./includes/database.php"; 
include "./includes/common.php";
include "./includes/pertanggungan.php";	
include "./includes/duit.php";
include "./includes/klien.php";
require('./libs/fpdf153/fpdf.php');
include "./libs/qr-sat/qr_img.php";


define("QRCODE", "./libs/phpqrcode");
define("QRCODE_TEMP_DIR", "./libs/qr-sat/temp");


$DA=New database($userid, $passwd, $DBName);
$DB = New database($userid, $passwd, $DBName);

class CetakPolis extends FPDF
{
	var $angle=0;
	var $B;
	var $I;
	var $U;
	var $HREF;

	function Rotate($angle,$x=-1,$y=-1)
	{
		if($x==-1)
			$x=$this->x;
		if($y==-1)
			$y=$this->y;
		if($this->angle!=0)
			$this->_out('Q');
		$this->angle=$angle;
		if($angle!=0)
		{
			$angle*=M_PI/180;
			$c=cos($angle);
			$s=sin($angle);
			$cx=$x*$this->k;
			$cy=($this->h-$y)*$this->k;
			$this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
		}
	}

	function WaterMarkBack( $texte )
	{
		$this->SetFont('Arial','B',60);
		$this->SetTextColor(203,203,203);
		$this->Rotate(45,55,190);
		$this->Text(40,190,$texte);
		$this->Rotate(0);
		$this->SetTextColor(0,0,0);
	}


function PDF($orientation='P',$unit='mm',$format='A4')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';
}

function WriteHTML($html)
{
    //HTML parser
    $html=str_replace("\n",' ',$html);
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            //Tag
            if($e{0}=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                    if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag,$attr)
{
    //Opening tag
    if($tag=='B' or $tag=='I' or $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF=$attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='B' or $tag=='I' or $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
}

function SetStyle($tag,$enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s)
        if($this->$s>0)
            $style.=$s;
    $this->SetFont('',$style);
}

function PutLink($URL,$txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}


function GetMonthNameById($m){

		
		switch ($m) {
			case "01": 
				$m = "Januari"; 
			break;
			case "02": 
				$m = "Februari";
			break;
			case "03": 
				$m = "Maret";
			break;
			case "04": 
				$m = "April";
			break;
			case "05": 
				$m = "Mei";
			break;
			case "06": 
				$m = "Juni";
			break;
			case "07": 
				$m = "Juli";
			break;
			case "08": 
				$m = "Agustus";
			break;
			case "09": 
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
		return strtoupper($m);
	}
	
	function dateEnToID($var){
	$temp = explode("/", $var);
	
	return $temp[0]." ".$this->GetMonthNameById($temp[1])." ".$temp[2];	
	}


}




$prefix				= trim($_GET['prefix']);
$nopertanggungan	= trim($_GET['nopertanggungan']);	
$tglCetak			= date("Ymd");
$jamCetak			= date("His");
$premi1				= 0;
$premi2				= 0;


/*QRCode engine*/
$filename = QRCODE_TEMP_DIR."/".substr(md5(md5(strtotime('now')+date("u"))), -10, 10).".png";
$data = ('http://www.jiwasraya.co.id/scan/?q='.base64_encode($prefix.$nopertanggungan));
$image = new Qrcode();
$image->setdata($data);
$image->calculate();
$image->save($filename);
/*end of QRCode */

$pdf=new CetakPolis();

$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);




$sql = "select ".
            "a.prefixpertanggungan, a.tglsp, TO_CHAR(a.mulas,'DD/MM/YYYY') MULAS, a.usia_th, a.nopertanggungan, ".
          	"TO_CHAR(a.EXPIRASI,'DD/MM/YYYY') EXPIRASI, a.lamapembpremi_bl as periode_bulan,a.nopemegangpolis, ".
          	"a.lamaasuransi_th, a.lamaasuransi_bl,TO_CHAR(a.tglcetak,'DD/MM/YYYY') TGLCETAK, a.JUAMAINPRODUK, ".
          	"a.juamainproduk, a.premi1, a.premi2, a.nosp,a.kdvaluta, a.kdcarabayar,".
          	"a.kdstatusmedical,a.lamapembpremi_th,a.kdproduk, (SELECT NAMAVALUTA FROM $DBUser.TABEL_304_VALUTA WHERE KDVALUTA=a.KDVALUTA) NAMAVALUTA,".
          	"a.tglnextbook, a.tgllastpayment, ".
          	"b.namaproduk, b.keterangan, ".
          	"c.namacarabayar, ".
			"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen, ".
			"(select (select namaareaoffice from $DBUser.tabel_410_area_office where kdareaoffice=v.kdareaoffice and kdkantor=v.kdkantor) from $DBUser.tabel_400_agen v where noagen=a.noagen) ktragen, ".			
			
			"(select kn.namakantor from $DBUser.TABEL_001_KANTOR kn, $DBUser.tabel_400_agen ag WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.noagen ) kantorfooter, ".	

			"(select pj.NAMAPEJABAT from $DBUser.TABEL_001_KANTOR kn, $DBUser.tabel_400_agen ag, $DBUser.TABEL_002_PEJABAT pj WHERE kn.KDKANTOR = ag.KDKANTOR AND ag.NOAGEN = a.noagen AND kn.KDKANTOR = pj.KDKANTOR AND pj.KDORGANISASI = '160' ) namapejabat, ".	
			
          	"e.gelar gelarpp,e.alamattetap01,e.alamattetap02, to_char(e.tgllahir,'dd/mm/yyyy') tgllahir,".
          	"e.kodepostetap,e.phonetetap01,e.namaklien1 as pemegangpolis, length(e.namaklien1) panjang,".
          	"decode(f.gelar,null,null,', '||f.gelar) gelarttg,decode(e.gelar,null,null,', '||e.gelar) gelarpp, f.namaklien1 as tertanggung,  to_char(f.tgllahir,'dd/mm/yyyy') tgllahirtt, ".
						"(select x.faktorbayar from $DBUser.tabel_311_faktor_bayar x  ".
						" where x.kdvaluta = a.kdvaluta and x.kdcarabayar = a.kdcarabayar and x.kdbasis = g.kdbasisbayar) faktorbayar, a.PREMISTD ".
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


	/*$sqlx1 = "select sum(a.premi)premitub ".
         "from ".
            "$DBUser.tabel_223_transaksi_produk a, ".
          	"$DBUser.tabel_200_pertanggungan b ".
          "where ".
            "b.prefixpertanggungan = a.prefixpertanggungan and ".
            "b.nopertanggungan=a.nopertanggungan and ".
            "a.kdbenefit in ('BNFTOPUP') and  ".						
          	"a.prefixpertanggungan='$prefix' and ".
          	"a.nopertanggungan='$nopertanggungan' ";*/
  $sqlx1="select nvl((select nvl(premi,0) from $DBUser.tabel_223_transaksi_produk 
          where prefixpertanggungan=a.prefixpertanggungan
          and nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG'),0)  premitup,
          nvl((select nvl(premi,0) from $DBUser.tabel_223_transaksi_produk 
          where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
          and kdbenefit='BNFTOPUP'),0) premitub from $DBUser.tabel_200_pertanggungan a where          
          a.prefixpertanggungan = '$prefix' AND a.nopertanggungan = '$nopertanggungan'";        	
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
	$premistandard=$arrr["PREMI2JSAP"];
	$premi2jsap =$arrr["PREMI2JSAP"];

		$arr=$DA->nextrow();
					$lamapremi = $arr["LAMAPEMBPREMI_TH"];
					$kdproduk = $arr["KDPRODUK"];
					$kdht = substr($kdproduk,0,2);
					$kdsttmed = $arr["KDSTATUSMEDICAL"];
					$kdcabar = $arr["KDCARABAYAR"];
					$namaagen = $arr["NAMAAGEN"];
					$ktragen = $arr["KTRAGEN"];
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


if($arr["KDPRODUK"]=='JL4B')
{
	define("MACAS","Regular");
}
elseif($arr["KDPRODUK"]=='JL4X')
{
	define("MACAS","Single");
}

			
$pdf->SetFont('Arial','B',14);
$pdf->Text('63'+$numindent,'5'+$numspace,'POLIS ASURANSI JIWA');
$pdf->SetFont('Arial','B',10);
$pdf->Text('64'+$numindent,'10'+$numspace,'NOMOR POLIS : '.$prefix."-".$nopertanggungan);
$pdf->SetFont('Arial','B',12);

$pdf->Text('52'+$numindent,'20'+$numspace,'PT ASURANSI JIWA IFG');
$pdf->SetFont('Arial','',9);
$pdf->Text('73'+$numindent,'25'+$numspace,'Berkedudukan di Jakarta');
$pdf->Text('67'+$numindent,'30'+$numspace,'Selanjutnya disebut Penanggung');

$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'40'+$numspace,'Atas Surat Permohonan Asuransi Jiwa (SPAJ) nomor :');  //'.$arr["NOSP"].", beserta semua pernyataan dan keterangan yang ");
$pdf->SetFont('Arial','B',9);
$pdf->Text('88'+$numindent,'40'+$numspace,$arr["NOSP"].', ');
$pdf->SetFont('Arial','',9);
$pdf->Text('106'+$numindent,'40'+$numspace," beserta  semua  pernyataan   dan  keterangan");
$pdf->Text('10'+$numindent,'45'+$numspace,"yang disampaikan oleh :");
$pdf->SetFont('Arial','B',12);
//$pdf->Text('74'+$numindent-($arr["PANJANG"]/2),'45'+$numspace,$arr["PEMEGANGPOLIS"].$arr["PANJANG"]);
//$pdf->Text(90-round(($arr["PANJANG"]/2),0),'58'+$numspace,$arr["PEMEGANGPOLIS"]);
$pdf->setY(74);
$pdf->setX(21);
$pdf->Cell(165, 10, $arr["PEMEGANGPOLIS"].$arr["GELARPP"], 0, 1, "C");
$pdf->SetFont('Arial','',9);
$pdf->Text('66'+$numindent,'63'+$numspace, "(Selanjutnya disebut Pemegang Polis)");
$pdf->Text('10'+$numindent,'70'+$numspace, "Penanggung  dengan  ini  menyatakan setuju untuk membayarkan  manfaat  atas  penyerahan  Polis  ini  berkenaan");
$pdf->Text('10'+$numindent,'75'+$numspace, "dengan  diri  Tertanggung  berdasarkan Syarat  dan ketentuan  sebagaimana  dalam data Polis, Syarat Umum Polis, ");
$pdf->Text('10'+$numindent,'80'+$numspace, "Syarat Khusus, ketentuan tambahan  dan ketentuan  lainnya (bila ada)  yang  dilekatkan/ dilampirkan  pada  Polis ini ");
$pdf->Text('10'+$numindent,'85'+$numspace, "yang merupakan bagian yang tidak terpisahkan dari Polis ini. ");


//$pdf->Image(DIRECTOR_SIGNATURE, 105, 110, 85, 20);
//$pdf->Image($filename, 20, 215, 30, 30);
if($tglcetak==""){
$pdf->Text('115','115', "Jakarta, ".date("d")." ".$pdf->GetMonthNameById(date("m"))." ".date("Y").$tglcetak  ) ;
}else{
$pdf->Text('115','115', "Jakarta, ".substr($tglcetak,0,2)." ".$pdf->GetMonthNameById(substr($tglcetak,3,2))." ".substr($tglcetak,6,4)  ) ;
}
//$pdf->Text('115','115', "Jakarta, 21 Januari 2014");
$pdf->Text('115','120', "PT ASURANSI JIWA IFG");

$pdf->SetLineWidth(0.1);
$pdf->SetFont('Arial','',6);
$pdf->Line(10+$numindent,142,55,142); //iie
$pdf->Text(11+$numindent,145, $arr["NAMAPEJABAT"]);
$pdf->Line(10+$numindent,142,10+$numindent,149); //garis vertikal iie
//$pdf->Line(10+$numindent,147,55,147); 
$pdf->Text(11+$numindent,148, "BRANCH MANAGER"); //iie
$pdf->Line(55,142,55,149); //garis vertikal
$pdf->Line(10+$numindent,149,55,149); //iie

$pdf->SetFont('Arial','',6);
$pdf->Text(50+$numindent,145, "Bea Materai Lunas Rp 6000 berdasarkan keputusan");
$pdf->Text(52+$numindent,148, "Kantor Pelayanan Pajak Tanggal : 20 Juni 2013");
$pdf->Text(54+$numindent,151, "Nomor SI-00054/SK/WPJ.06/KP.1203/2013");

$pdf->SetFont('Arial','',9);
//$pdf->Text('10'+$numindent,'145', "Bagian Polis & Underwriting PP");
$pdf->Text('115','145', "Drs. Hendrisman Rahim, MA., FSAI., AAIJ");
$pdf->Image('./images/ttd_dir.png', 111,121,70);
$pdf->Image($filename, 158, 220, 30, 30);
//Line(float x1, float y1, float x2, float y2)
//$pdf->SetLineWidth(0.1);
//$pdf->Line(115,131,180,131);
//$pdf->Text('10'+$numindent,'150', "Verifikator");
$pdf->Text('115','150', "Direktur Utama");

$pdf->SetFont('Arial','B',9);
$pdf->Text('55'+$numindent,'143'+$numspace,'MOHON PELAJARI POLIS INI DENGAN CERMAT');
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'150'+$numspace, "Anda dapat membatalkan maksud Anda untuk mempertanggungkan diri Tertanggung  berdasarkan  Polis ini dengan");
$pdf->Text('10'+$numindent,'155'+$numspace, "mengembalikan  Polis  ini  pada  masa Freelook  Period, yaitu  dalam jangka  waktu  10  hari  kerja  sejak  Polis ini");
$pdf->Text('10'+$numindent,'160'+$numspace, "diterima  oleh  Anda, selama Anda tidak pernah mengajukan klaim atas manfaat  Asuransi  yang  ditanggung  dalam");
//$pdf->Text('10'+$numindent,'165'+$numspace, "dalam Polis ini. Dalam hal terjadi yang demikian, maka kami akan melakukan hal-hal sebagai berikut :");
$pdf->Text('10'+$numindent,'165'+$numspace, "dalam Polis ini.");
//$pdf->Text('10'+$numindent,'175'+$numspace, "1. ");
//$pdf->Text('14'+$numindent,'175'+$numspace, "Berkaitan dengan Premi ".MACAS."  yang telah dibayarkan, akan kami  kembalikan  setelah  dikurangi  dengan  biaya");
//$pdf->Text('14'+$numindent,'180'+$numspace, "Polis Rp. 150.000,- (seratus lima puluh ribu rupiah) dan biaya pemeriksaan kesehatan (bila ada).");
//$pdf->Text('10'+$numindent,'185'+$numspace, "2. ");
//$pdf->Text('14'+$numindent,'185'+$numspace, "Berkaitan dengan Top Up Premi ".MACAS." yang telah dibayarkan, akan  kami  kembalikan  Nilai  Tunai  atas Top Up ");
//$pdf->Text('14'+$numindent,'190'+$numspace, "Premi ".MACAS." ditambah dengan biaya  Top Up Premi ".MACAS.".");

$pdf->SetFont('Arial','',7);
$pdf->Text('110'+$numindent,'260'+$numspace, $namaagen.'/'.$ktragen);
$pdf->Text('110'+$numindent,'263'+$numspace, $arr["KANTORFOOTER"]);

//require('./libs/fpdf153/pdf_code39.php');
//$pdf1=new PDF_Code39();
//$pdf->AddPage();
//$pdf->Code39(14, 225, $prefix."-".$nopertanggungan);
//$pdf->Output();

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
$pdf->Text('66'+$numindent,'40'+$numspace,":            ".$arr["PEMEGANGPOLIS"].$arr["GELARPP"]);
$pdf->Text('10'+$numindent,'45'+$numspace, "Macam Asuransi ");
$pdf->Text('66'+$numindent,'45'+$numspace,":            ".$arr["NAMAPRODUK"]);
$pdf->Text('10'+$numindent,'50'+$numspace, "Uang Asuransi ");
$pdf->Text('66'+$numindent,'50'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'50'+$numspace, number_format($arr["JUAMAINPRODUK"],2,",","."));
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'55'+$numspace, "Masa Asuransi ");
$pdf->Text('66'+$numindent,'55'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'55'+$numspace, $pdf->dateEnToID($arr["MULAS"]).' SAMPAI '.$pdf->dateEnToID($arr["EXPIRASI"]));
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'60'+$numspace, "Valuta ");
$pdf->Text('66'+$numindent,'60'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'60'+$numspace, $arr["NAMAVALUTA"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'65'+$numspace, "Premi ");
$pdf->Text('66'+$numindent,'65'+$numspace, ":             Rp.");
$pdf->SetFont('Arial','',9);
//$pdf->Text('85'+$numindent,'60'+$numspace, number_format($arr['PREMISTD'],2));

//$pdf->Text('85'+$numindent,'65'+$numspace, number_format($premistandard,2,",",".")." DIBAYAR UNTUK 5 TAHUN PERTAMA");

$indentPremi2 = 0;
if(($kdcabar=="X") || ($kdcarabayar=="E") || ($kdcarabayar=="J") || ($kdsttmed=="M") || ($kdht=="HT") || ($lamapremi < 5) ){
  				  $besarnya = "".$arr["NOTASI"]." ".number_format($premi1,2)." DIBAYAR SECARA ".$arr["NAMACARABAYAR"]."";
				  
				  $pdf->Text('85'+$numindent,'65'+$numspace, $besarnya);
				  
				} else {
		

					$sisalamaPembayaran = abs($arr["LAMAPEMBPREMI_TH"]) - 5;
					
					
				  	if($premi2 > 0)
					{
						$indentPremi2 = 5;
						$pdf->Text('85'+$numindent,'65'+$numspace, number_format($premistandard,2,",",".")." DIBAYAR UNTUK 5 TAHUN PERTAMA");
						$pdf->Ln(5);
						$pdf->Text('78'+$numindent,'65'+$numspace+$indentPremi2, "DAN Rp. ".number_format($premi2,2)." UNTUK ".$sisalamaPembayaran." TAHUN BERIKUTNYA");
					}
					else
					{
						$pdf->Text('85'+$numindent,'65'+$numspace, number_format($premistandard,2,",",".")." DIBAYAR UNTUK 5 TAHUN PERTAMA");
					}
							
							
				  
				}



//$pdf->Text('85'+$numindent,'60'+$numspace, number_format($premi1,2));
//Tambahan untuk perubahan Topup agar jenis topup dimasukkan ada dua Single dan Reguler oleh Dedi 19/03/2014
$pdf->SetFont('Arial','B',9);
//$pdf->Text('10'+$numindent,'65'+$numspace, "Top Up ".MACAS." ");
$pdf->Text('10'+$numindent,'70'+$numspace+$indentPremi2, "Top Up Berkala ");
$pdf->Text('66'+$numindent,'70'+$numspace+$indentPremi2, ":             Rp.");
$pdf->SetFont('Arial','',9);
$pdf->Text('85'+$numindent,'70'+$numspace+$indentPremi2, number_format($arrs["PREMITUP"],2));

if($arr["KDPRODUK"]=='JL4B')
{
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'70'+$numspace+$indentPremi2, "Top Up Reguler ");
$pdf->Text('66'+$numindent,'70'+$numspace+$indentPremi2, ":             Rp.");
$pdf->SetFont('Arial','',9);
$pdf->Text('85'+$numindent,'70'+$numspace+$indentPremi2, number_format($arrs["PREMITUB"],2));
}
// Akhir tambahan topup  oleh Dedi 19/03/2014

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'75'+$numspace+$indentPremi2, "Cara Bayar Premi");
$pdf->Text('66'+$numindent,'75'+$numspace+$indentPremi2, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'75'+$numspace+$indentPremi2, $arr["NAMACARABAYAR"]);

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'80'+$numspace+$indentPremi2, "Lama Pembayaran");
$pdf->Text('66'+$numindent,'80'+$numspace+$indentPremi2, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('78'+$numindent,'80'+$numspace+$indentPremi2, $arr["LAMAPEMBPREMI_TH"].' TAHUN');

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'90'+$numspace+$indentPremi2, "Penerima Manfaat Asuransi");
$pdf->SetFont('Arial','',9);

/* $sql  = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,  ".
 		 "NVL(DECODE(A.NOTERTANGGUNG,A.NOKLIEN,'TERTANGGUNG',  ".
 		 "DECODE(B.KDHUBUNGAN,'2',(SELECT NAMAHUBUNGAN FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
		 "WHERE B.KDHUBUNGAN=C.KDHUBUNGAN),(SELECT NAMAHUBUNGAN||' '||'TERTANGGUNG' FROM $DBUser.TABEL_218_KODE_HUBUNGAN C  ".
      	 "WHERE B.KDHUBUNGAN=C.KDHUBUNGAN))),'') NAMAHUBUNGAN,  ".
		 "D.NAMAKLIEN1||DECODE(d.gelar, NULL,NULL,', '||d.gelar)  NAMAKLIEN1  ".
		 "FROM  $DBUser.TABEL_219_PEMEGANG_POLIS_BAW A,  ".
  		 "$DBUser.TABEL_113_INSURABLE B,  ".
  		 "$DBUser.TABEL_100_KLIEN D ".
		 "WHERE A.NOTERTANGGUNG=B.NOTERTANGGUNG(+) ".
		 "AND A.NOKLIEN=B.NOKLIENINSURABLE(+) ".
		 "AND A.NOKLIEN=D.NOKLIEN ".
		 "and A.PREFIXPERTANGGUNGAN='$prefix'".
		 "and A.NOPERTANGGUNGAN='$nopertanggungan' ".
		 "ORDER BY A.NOURUT ";    */
$sql = "SELECT   a.notertanggung,
           a.nourut,
           a.kdinsurable,
           a.noklien,
           decode(c.namahubungan,'DIRI TERTANGGUNG','',c.namahubungan||' ') || ' TERTANGGUNG' namahubungan,
           D.NAMAKLIEN1 || DECODE (d.gelar, NULL, NULL, ', ' || d.gelar)
              NAMAKLIEN1
    FROM   $DBUser.tabel_219_pemegang_polis_baw a,
           $DBUser.tabel_218_kode_hubungan c,
           $DBUser.TABEL_100_KLIEN D
   WHERE   a.noklien=d.noklien
   and     a.kdinsurable = c.kdhubungan
           AND a.prefixpertanggungan = '$prefix'
           AND a.nopertanggungan = '$nopertanggungan'           
ORDER BY   a.nourut";		 
       	 $DB->parse($sql);
       	 $DB->execute();
       	 $i = 0;
		 $y = 95+$numspace+$indentPremi2;
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
$pdf->Text('70'+$numindent,'5'+$y,$arr["TERTANGGUNG"].$arr["GELARTTG"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('133'+$numindent,'5'+$y, "Tanggal Lahir");
$pdf->Text('157'+$numindent,'5'+$y, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('160'+$numindent,'5'+$y,$arr["TGLLAHIRTT"]);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'10'+$y, "Nama Pemegang Polis");
$pdf->Text('66'+$numindent,'10'+$y,":");
$pdf->SetFont('Arial','',9);
$pdf->Text('70'+$numindent,'10'+$y,$arr["PEMEGANGPOLIS"].$arr["GELARPP"]);
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
$pdf->SetFont('Arial','',7);
$pdf->Text('10'+$numindent,'45'+$y, $arr["NAMAPRODUK"]);
//$pdf->Text('50'+$numindent,'45'+$y, $arr["KDPRODUK"]);
$pdf->Text('50'+$numindent,'45'+$y, "SUP");
$pdf->Text('71'+$numindent,'45'+$y, number_format($arr["JUAMAINPRODUK"],2));
$pdf->Text('105'+$numindent,'45'+$y, "UTAMA");
$pdf->Text('127'+$numindent,'45'+$y, $arr["EXPIRASI"]);
$pdf->Text('157'+$numindent,'45'+$y, $arr["EXPIRASI"]);
// $pdf->Text('10'+$numindent,'165'+$numspace, $arr["NAMAPRODUK"]);
// $pdf->Text('50'+$numindent,'165'+$numspace, $arr["KDPRODUK"]);
// $pdf->Text('70'+$numindent,'165'+$numspace,number_format($arr["JUAMAINPRODUK"],2));
// $pdf->Text('105'+$numindent,'165'+$numspace, "UTAMA");
// $pdf->Text('125'+$numindent,'165'+$numspace, $arr["EXPIRASI"]);
// $pdf->Text('155'+$numindent,'165'+$numspace, $arr["EXPIRASI"]);

 $sql_xjum  = "select COUNT(*) jumrec
from $DBUser.TABEL_223_TRANSAKSI_PRODUK A, $DBUser.TABEL_207_KODE_BENEFIT B
         WHERE PREFIXPERTANGGUNGAN='$prefix'
		 and NOPERTANGGUNGAN='$nopertanggungan' 
		 AND A.KDJENISBENEFIT='R' AND A.KDBENEFIT=B.KDBENEFIT ";
	 $DB->parse($sql_xjum);
     $DB->execute();
	 $arsc=$DB->nextrow();
	 $jumRecBnf4B = $arsc["JUMREC"];
	


$pdf->SetFont('Arial','B',9);
if($arr["KDPRODUK"] <> 'JL4B' && $jumRecBnf4B > 0)
{
	$pdf->Text('10'+$numindent,'175'+$numspace, "Asuransi Tambahan");
}
 $pdf->SetFont('Arial','',7);
/*
		 $sql="SELECT   MAX (nilaibenefit) nilaibenefit,
           kdbnfx,
           DECODE (SUBSTR (kdbnfx, 1, 4),
                   'HCPB', 'HCP PLUS BEDAH',
                   'HCPM', 'HCP MURNI',
				   'SP-D','JS SPOUSE PAYOR DB',
                   'SP-T','JS SPOUSE PAYOR TPD',
                   'PB-D','JS PAYOR DB',
                   'PB-T','JS PAYOR TPD',
                   MAX ( (SELECT   MAX (namabenefit)
                            FROM   $DBUser.TABEL_207_KODE_BENEFIT
                           WHERE   kdbenefit = xx.kdbnfx)))
              namabenefit,
			  DECODE (SUBSTR (kdbnfx, 1, 2),
                   'SP','TAMBAHAN',
                   'PB','TAMBAHAN','UTAMA') ATAS
    FROM   (SELECT   nilaibenefit,
                     EXP,
                     kdbnf,
                     CASE
                        WHEN x > 0 AND SUBSTR (kdbnf, 1, 3) = 'HCP'
                        THEN
                           'HCPB' || SUBSTR (kdbnf, -3)
                        ELSE
                           kdbnf
                     END
                        kdbnfx
              FROM   (SELECT   nilaibenefit,
                               (SELECT   NVL (KDASALBENEFIT, KDBENEFIT)
                                  FROM   $DBUser.TABEL_206_PRODUK_BENEFIT
                                 WHERE   KDPRODUK = A.KDPRODUK
                                         AND KDBENEFIT = A.KDBENEFIT)
                                  KDBNF,
                               TO_CHAR (a.akhirpmb, 'dd/mm/yyyy') EXP,
                               (SELECT   COUNT ( * )
                                  FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK
                                 WHERE   PREFIXPERTANGGUNGAN =
                                            a.PREFIXPERTANGGUNGAN
                                         AND NOPERTANGGUNGAN =
                                               a.NOPERTANGGUNGAN
                                         AND kdbenefit LIKE 'CPB%')
                                  x
                        FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK A,
                               $DBUser.TABEL_207_KODE_BENEFIT B
                       WHERE       PREFIXPERTANGGUNGAN = '$prefix'
                               AND NOPERTANGGUNGAN = '$nopertanggungan'
                               AND A.KDJENISBENEFIT = 'R'
                               AND A.KDBENEFIT NOT LIKE '%ICU%'
                               AND A.KDBENEFIT = B.KDBENEFIT)) xx
					GROUP BY   kdbnfx";*/
		  $sql="SELECT   MIN (nilaibenefit) nilaibenefit,
           kdbnfx,
           DECODE (SUBSTR (kdbnfx, 1, 4),
                   'HCPB', 'HCP PLUS BEDAH',
                   'HCPM', 'HCP MURNI',
                   'SP-D','JS SPOUSE PAYOR DB',
                   'SP-T','JS SPOUSE PAYOR TPD',
                   'PB-D','JS PAYOR DB',
                   'PB-T','JS PAYOR TPD',
                   MAX ( (SELECT   MAX (namabenefit)
                            FROM   $DBUser.TABEL_207_KODE_BENEFIT
                           WHERE   kdbenefit = xx.kdbnfx)))
              namabenefit,
              DECODE (SUBSTR (kdbnfx, 1, 2),
                   'SP','TAMBAHAN',
                   'PB','TAMBAHAN','UTAMA') ATAS,max(exp) exp
    FROM   (SELECT   nilaibenefit,
                     EXP,
                     kdbnf,
                     CASE
                        WHEN x > 0 AND SUBSTR (kdbnf, 1, 3) = 'HCP'
                        THEN
                           'HCPB' || SUBSTR (kdbnf, -3)
						WHEN x = 0 AND SUBSTR (kdbnf, 1, 3) = 'CPM'
                        THEN
                           'HCPM' || SUBSTR (kdbnf, -3)
                        ELSE
                           kdbnf
                     END
                        kdbnfx
              FROM   (SELECT   nilaibenefit,
                               (SELECT   NVL (KDASALBENEFIT, KDBENEFIT)
                                  FROM   $DBUser.TABEL_206_PRODUK_BENEFIT
                                 WHERE   KDPRODUK = A.KDPRODUK
                                         AND KDBENEFIT = A.KDBENEFIT)
                                  KDBNF,
                               TO_CHAR (a.expirasi, 'dd/mm/yyyy') EXP,
                               (SELECT   COUNT ( * )
                                  FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK
                                 WHERE   PREFIXPERTANGGUNGAN =
                                            a.PREFIXPERTANGGUNGAN
                                         AND NOPERTANGGUNGAN =
                                               a.NOPERTANGGUNGAN
                                         AND kdbenefit LIKE 'CPB%')
                                  x
                        FROM   $DBUser.TABEL_223_TRANSAKSI_PRODUK A,
                               $DBUser.TABEL_207_KODE_BENEFIT B
                       WHERE   PREFIXPERTANGGUNGAN = '$prefix'
                               AND NOPERTANGGUNGAN = '$nopertanggungan'
                               AND A.KDJENISBENEFIT = 'R'
                               AND A.KDBENEFIT NOT LIKE '%ICU%'
                               AND A.KDBENEFIT = B.KDBENEFIT)) xx --where substr(kdbnfx,1,2) <>'CP'
                    GROUP BY   kdbnfx";
       	 $DB->parse($sql);
       	 $DB->execute();
       	 $i = 0;
		 $y = 180+$numspace;
       	 while($ars=$DB->nextrow())
		 {
		 	 $pdf->Text('10'+$numindent,$y, trim(substr($ars["NAMABENEFIT"],0,25)));
			 $pdf->Text('50'+$numindent,$y, trim($ars["KDBNFX"]));
			 $pdf->Text('71'+$numindent,$y, number_format($ars["NILAIBENEFIT"],2));
			 $pdf->Text('105'+$numindent,$y, trim($ars["ATAS"]));
			 $pdf->Text('127'+$numindent,$y, $ars["EXP"]);
			 $pdf->Text('157'+$numindent,$y, $ars["EXP"]);
				 $i++;
				 $y = $y+5;
    		 }
			 
			 
 $pdf->SetLeftMargin(35);
 $pdf->SetTopMargin(25);
$pdf->AddPage();


$pdf->SetFont('Arial','B',8);
$pdf->Text('75','20','KETENTUAN - KETENTUAN KHUSUS');
$pdf->SetFont('Arial','B',8);

$sql1="select $DBUser.polis.getnotes2('$prefix','$nopertanggungan') notes from dual";
$DB->parse($sql1);
$DB->execute();
$res=$DB->nextrow();
$notes = $res["NOTES"];

$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
//$pdf->SetFont('courier','',8);
$html = nl2br($notes);
$pdf->WriteHTML("<pre>".$html."</pre>");


$pdf->Ln(5);
$sql1="select $DBUser.polis.gettebus2('$prefix','$nopertanggungan') tebus from dual"; 
$DB->parse($sql1);
$DB->execute();
$res=$DB->nextrow();
$tebus = $res["TEBUS"];
$pdf->SetFont('Arial','',8);

$html2 = "<pre>".nl2br($tebus)."</pre>";
$pdf->WriteHTML($html2);

$pdf->AddPage();
//$pdf->SetFont('Arial','B',12);
//$pdf->Text('90','20'+$numspace,'LAMPIRAN POLIS');
//$pdf->SetFont('Arial','B',12);
//$pdf->Text('85','25'+$numspace, "NOMOR ".$prefix.$nopertanggungan);

//$pdf->SetFont('Arial','B',9);

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
$pdf->SetFont('Arial','',9);

		
$pdf->Text('10'+$numindent,'37'+$numspace,'Asuransi Tambahan dan Ketentuan Khusus yang tidak berlaku');
/*
$sql  = "SELECT   a.kdproduk, a.kdbenefit, b.namabenefit ".
"  FROM   $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b ".
 "WHERE       a.kdbenefit = b.kdbenefit ".
         "AND a.kdproduk = '".$arr["KDPRODUK"]."' ".
         "AND a.kdjenisbenefit = 'R' ".
         "AND b.kdbenefit <> 'RATEUP' ".
         "AND b.kdkelompokbenefit IN ('B', 'E', 'D', 'T', 'C', 'R') ".
         "AND b.faktorbenefit <> 'X' ".
         "AND ( (SUBSTR (a.kdbenefit, 1, 2) <> 'CP' ".
                "OR (SUBSTR (a.kdbenefit, 1, 3) IN ('CPM', 'CPB') ".
                    "AND NOT (SUBSTR (a.kdbenefit, -3) IN ".
                                   "('RWI', 'ICU', 'BDH')))) ".
              "AND a.kdbenefit <> 'RISKER')".
			  " and a.kdbenefit not in ".
              "(select kdbenefit from $DBUser.tabel_223_transaksi_produk where ".
              "prefixpertanggungan='$prefix' and nopertanggungan='$nopertanggungan')";
			  */
$sql="select KDPRODUK, KDBENEFIT, NAMABENEFIT, max(LAMAPERIODE) from (
SELECT   KDPRODUK, KDBENEFIT, NAMABENEFIT, LAMAPERIODE
        FROM   (SELECT   a.kdproduk,
                     DECODE (SUBSTR (a.kdbenefit, 1, 2),
                             'CP', 'HCP',
                             NVL(a.KDASALBENEFIT,a.kdbenefit))
                        kdbenefit,
                     DECODE (SUBSTR (a.kdbenefit, 1, 2),
                             'CP', 'JS HOSPITAL CASH PLAN',
                             b.namabenefit)
                        namabenefit, lamaperiode
              FROM   $DBUser.tabel_206_produk_benefit a,
                     $DBUser.tabel_207_kode_benefit b
             WHERE       a.kdbenefit = b.kdbenefit
                     AND a.kdproduk = 'JL4B'
                     AND a.kdjenisbenefit = 'R'
                     AND b.kdbenefit <> 'RATEUP'
                     AND b.kdkelompokbenefit IN ('B', 'E', 'D', 'T', 'C', 'R')
                     AND b.faktorbenefit <> 'X'
                     AND DECODE (SUBSTR (a.kdbenefit, 1, 2),
                             'CP', 'HCP',
                             a.kdbenefit) NOT IN
                              (SELECT   DECODE (SUBSTR (kdbenefit, 1, 2),
                             'CP', 'HCP',
                             kdbenefit)
                                 FROM   $DBUser.tabel_223_transaksi_produk
                                WHERE   prefixpertanggungan = '$prefix'
                                        AND nopertanggungan = '$nopertanggungan'))
        GROUP BY   KDPRODUK, KDBENEFIT, NAMABENEFIT,LAMAPERIODE
        )
        group by KDPRODUK, KDBENEFIT, NAMABENEFIT
        ORDER BY max(LAMAPERIODE)";
		$DB->parse($sql);
       	$DB->execute();

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'45'+$numspace,'Asuransi Tambahan');
$pdf->Text('105'+$numindent,'45'+$numspace,'Ketentuan & Manfaat di');
$pdf->SetFont('Arial','',9);
$d = 55;
$d = $d+$numspace-5;
while($arrrx=$DB->nextrow())		
{
	$pdf->Text('10'+$numindent,$d,$arrrx["NAMABENEFIT"]);
	$pdf->Text('115'+$numindent,$d,$arrrx["KDBENEFIT"]);
	$d = $d+5;
}



//$pdf->Output();
$pdf->Output('cetak-'.$filename,'I');
$sqlxx = "update $DBUser.tabel_200_pertanggungan set tglcetak=sysdate ".
          "where ".
          	"prefixpertanggungan='$prefix' and ".
          	"nopertanggungan='$nopertanggungan' ";
	//$DB->parse($sqlxx);
	//$DB->execute();

?>