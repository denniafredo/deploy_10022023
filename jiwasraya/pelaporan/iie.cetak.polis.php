<?php

/*********************************************
	Title		: perubahan metoda cetak polis
	Author		: Iie Sumitra
	Libs Req.	: FlexPaper, SWFTools, Fpdf153, phpQRCode
	Date		: 09 March 2012
***********************************************/

include "../../includes/database.php"; 
include "../../includes/session.php"; 
include "../../includes/common.php";
include "../../includes/pertanggungan.php";
include "../../includes/klien.php";
require("../libs/fpdf153/fpdf.php");
//include "../libs/phpqrcode/qrlib.php";

	

$ipremote = str_replace(".","",$_SERVER['REMOTE_ADDR']);
define("DIR_TEMP", "../libs/SWFTools/temp");
define("PDFTOSWF", "../libs/SWFTools");
//define("QRCODE", "../libs/phpqrcode");
//define("QRCODE_TEMP_DIR", "../libs/phpqrcode/temp");
define("DIRECTOR_SIGNATURE", "../images/signature.jpg");
define("HREF_SWF_TEMP", "http://".$_SERVER['HTTP_HOST']."/jiwasraya/libs/SWFTools/temp");
define("UKURAN_KERTAS", "A4");
define("JENIS_KERTAS", "P");
define("MEASURE_KERTAS", "mm");

define("DIRECTOR_NAME", "INDRA CATARYA SITUMEANG, M.Sc., FSAI");





 
    


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

$DA = new Database($userid, $passwd, $DBName);
$DB = new Database($userid, $passwd, $DBName);

$prefix				= trim($_GET['prefix']);
$nopertanggungan	= trim($_GET['nopertanggungan']);	
$tglCetak			= date("Ymd");
$jamCetak			= date("His");


/*QRCode engine*/
//$filename = QRCODE_TEMP_DIR."/".$ipremote.substr(md5(md5(strtotime('now')+date("u"))), -10, 10).".png";
//$errorCorrectionLevel = 'L';
//$matrixPointSize = 4;
//$data = $prefix.$nopertanggungan." ".$tglCetak." ".$jamCetak." ".$userid;
//QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
/*end of QRCode */



$sql = "select ".
            "a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
          	"a.expirasi, a.lamapembpremi_bl as periode_bulan,a.nopemegangpolis, ".
          	"a.lamaasuransi_th, a.lamaasuransi_bl, ".
          	"a.juamainproduk, a.premi1, a.premi2, a.nosp,a.kdvaluta, a.kdcarabayar,".
          	"a.kdstatusmedical,a.lamapembpremi_th,a.kdproduk, ".
          	"a.tglnextbook, a.tgllastpayment, ".
          	"b.namaproduk, b.keterangan, ".
          	"c.namacarabayar, ".
          	"e.gelar gelarpp,e.alamattetap01,e.alamattetap02, ".
          	"e.kodepostetap,e.phonetetap01,e.namaklien1 as pemegangpolis,".
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


	$sqlx1 = "select sum(a.premi)premi1jsap ".
         "from ".
            "$DBUser.tabel_223_transaksi_produk a, ".
          	"$DBUser.tabel_200_pertanggungan b ".
          "where ".
            "b.prefixpertanggungan = a.prefixpertanggungan and ".
            "b.nopertanggungan=a.nopertanggungan and ".
            "a.kdjenisbenefit in ('U','X') and  ".						
          	"a.prefixpertanggungan='$prefix' and ".
          	"a.nopertanggungan='$nopertanggungan' ";
	$DB->parse($sqlx1);
	$DB->execute();
	$arrs=$DB->nextrow();
	$premi1jsap =$arrs["PREMI1JSAP"];
		
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


$pdf = new CetakPolis(JENIS_KERTAS, MEASURE_KERTAS, UKURAN_KERTAS);

$KLN = new Klien($userid,$passwd,$arr["NOPEMEGANGPOLIS"]);

$numspace = 22;
$numindent = 12;



$pdf->AddPage();
//$pdf->WaterMarkBack( "S  P  E  C  I  M  E  N" );
$pdf->SetFont('Arial','B',13);
$pdf->Text('52'+$numindent,'15'+$numspace,'PT ASURANSI JIWA IFG');
$pdf->SetFont('Arial','B',9);
$pdf->Text('72'+$numindent,'20'+$numspace,'BERKEDUDUKAN DI JAKARTA');
$pdf->Text('62'+$numindent,'25'+$numspace,'(SELANJUTNYA DISEBUT PERUSAHAAN)');

//$pdf->SetLineWidth(0.5);
//$pdf->Rect(156, 10, 40, 13);

$pdf->SetFont('Arial','B',9);
$pdf->Text('161','4', "NOMOR POLIS");
$pdf->Text('161','13', $prefix."-".$nopertanggungan);

$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'35'+$numspace,'BERDASARKAN SURAT PERMINTAAN ASURANSI JIWA NOMOR '.$arr["NOSP"].", ".$arr["TGLSP"]." DARI");
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'40'+$numspace,'NAMA');
$pdf->Text('30'+$numindent,'40'+$numspace,':');
$pdf->SetFont('Arial','',9);
$gelarpp=(strlen($arr["GELARPP"])==0) ? '' : ", ".$arr["GELARPP"];
$pdf->Text('35'+$numindent,'40'+$numspace, $arr["PEMEGANGPOLIS"].$gelarpp);

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'45'+$numspace,'ALAMAT'); 
$pdf->Text('30'+$numindent,'45'+$numspace,':');
$pdf->SetFont('Arial','',9);
$pdf->Text('35'+$numindent,'45'+$numspace, $arr["ALAMATTETAP01"]);
$pdf->Text('35'+$numindent,'50'+$numspace, $arr["ALAMATTETAP02"]);
//$pdf->Text('35'+$numindent,'50'+$numspace, $arr["ALAMATTETAP02"]." ".$KLN->namakodyatetap."  ".$arr["KODEPOSTETAP"]);
$pdf->Text('35'+$numindent,'55'+$numspace, "Telp. ".$arr["PHONETETAP01"]);

$pdf->SetFont('Arial','B',9);
$pdf->Text('60'+$numindent,'60'+$numspace, "(SELANJUTNYA DISEBUT PEMEGANG POLIS)");
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'65'+$numspace, "DENGAN INI PERUSAHAAN DAN PEMEGANG POLIS MENGADAKAN PERJANJIAN ASURANSI ATAS JIWA :");
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'70'+$numspace,'NAMA');
$pdf->Text('30'+$numindent,'70'+$numspace,':');
$pdf->SetFont('Arial','',9);
$namatertanggung = (($arr["GELARTTG"]=="")||preg_match("/\t\n\r\f/",$arr["GELARTTG"])) ? $arr["TERTANGGUNG"] : $arr["TERTANGGUNG"].", ".$arr["GELARTTG"];	
$pdf->Text('35'+$numindent,'70'+$numspace, $namatertanggung);
$pdf->SetFont('Arial','B',9);
$pdf->Text('135'+$numindent,'70'+$numspace, "UMUR : ");
$pdf->SetFont('Arial','',9);
$pdf->Text('146'+$numindent,'70'+$numspace, "   ".$arr["USIA_TH"]." TAHUN");
$pdf->SetFont('Arial','B',9);
$pdf->Text('60'+$numindent,'75'+$numspace, "(SELANJUTNYA DISEBUT TERTANGGUNG)");
$pdf->SetFont('Arial','',9);
$pdf->Text('10'+$numindent,'80'+$numspace, "MENURUT KETENTUAN-KETENTUAN SEBAGAI BERIKUT :");
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'85'+$numspace, "1. MACAM POLIS");
$pdf->Text('50'+$numindent,'85'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('55'+$numindent,'85'+$numspace, "POLIS ".$macampolis);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'90'+$numspace, "2. MACAM ASURANSI");
$pdf->Text('50'+$numindent,'90'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('55'+$numindent,'90'+$numspace, $arr["NAMAPRODUK"]);

$cutproduk=substr($arr["NAMAPRODUK"],0,3);
	switch($cutproduk){
	case "ANU": 
	    $judulbenefit="PENSIUN HARI TUA"; 
		//$masaasuransi= "SEUMUR HIDUP";
		$masaasuransi=$arr["MULAS"]." SAMPAI ".$arr["EXPIRASI"];
		break;
		default: 
		$judulbenefit="UANG ASURANSI";
		$masaasuransi=$arr["MULAS"]." SAMPAI ".$arr["EXPIRASI"];
	}

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'95'+$numspace, "3. ".$judulbenefit);
$pdf->Text('50'+$numindent,'95'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('55'+$numindent,'95'+$numspace, $arr["NOTASI"]."".number_format($arr["JUAMAINPRODUK"],2));
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'100'+$numspace, "4. MASA ASURANSI");
$pdf->Text('50'+$numindent,'100'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('55'+$numindent,'100'+$numspace, $masaasuransi);
$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'105'+$numspace, "5. PREMI");
$pdf->Text('50'+$numindent,'105'+$numspace, ":");
$pdf->SetFont('Arial','',9);
$pdf->Text('14'+$numindent,'110'+$numspace, "a) BESARNYA");
$pdf->SetFont('Arial','B',9);
$pdf->Text('50'+$numindent,'110'+$numspace, ":");
$pdf->SetFont('Arial','',9);


if(strlen(trim($besarnya)) > 50)
{
	$numspace = 27;
	//$pdf->SetX(55+$numindent);
	//$pdf->SetY(101.5+$numspace);
	$pdf->SetXY(54+$numindent ,101.5+$numspace);
	$pdf->MultiCell(120, 5, trim($besarnya) );
}
else
{
	$pdf->Text('55'+$numindent,'110'+$numspace, trim($besarnya));
}




$pdf->Text('14'+$numindent,'115'+$numspace, "a) LAMA PEMBAYARAN");
$pdf->SetFont('Arial','B',9);
$pdf->Text('50'+$numindent,'115'+$numspace, ":");
$pdf->SetFont('Arial','',9);

$arr["LAMAPEMBPREMI_TH"]==""? "-" : "".$arr["LAMAPEMBPREMI_TH"]." TAHUN "; 

if($arr["LAMAPEMBPREMI_TH"]=="")
{
	$tete = "-";
}
else
{
	$tete = "".$arr["LAMAPEMBPREMI_TH"]." TAHUN "; 
}

if ($arr["PERIODE_BULAN"] or $arr["PERIODE_BULAN"]<>"0")
{
	$tete2 = $arr["PERIODE_BULAN"]." BULAN ";
}

$pdf->Text('55'+$numindent,'115'+$numspace, $tete.$tete2);

$pdf->SetFont('Arial','B',9);
$pdf->Text('10'+$numindent,'120'+$numspace, "6. PENERIMA FAEDAH MENURUT URUTAN");
$pdf->Text('80'+$numindent,'120'+$numspace, ":");
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
		$y = 125+$numspace;
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
                		 $pdf->Text('13'+$numindent,$y, trim($ars["NOURUT"]).". ".trim($ars["NAMAHUBUNGAN"]).", ".trim($nama));
				
                		
                
				$i++;
				$y = $y+5;
				
    		}

$pdf->Text('10'+$numindent,$y+2, "PERJANJIAN ASURANSI INI BERLAKU SESUAI DENGAN SYARAT-SYARAT UMUM POLIS ASURANSI JIWA ");
$pdf->Text('10'+$numindent,$y+7, "PERORANGAN DAN KETENTUAN-KETENTUAN LAIN YANG TERCANTUM DALAM RUANG CATATAN DAN ATAU  ");
$pdf->Text('10'+$numindent,$y+12, "LAMPIRAN-LAMPIRAN POLIS YANG MENJADI BAGIAN MUTLAK YANG TIDAK DAPAT DIPISAHKAN DARI POLIS INI ");


$pdf->Image(DIRECTOR_SIGNATURE, 105, 250, 80, 20);
$pdf->Image($filename, 20, 245, 30, 30);

$pdf->Text('115','237', "JAKARTA, ".strtoupper(date("d")." ".$pdf->GetMonthNameById(date("m"))." ".date("Y")  ) );
$pdf->Text('115','247', "PT ASURANSI JIWA IFG");
$pdf->Text('115','252', "DIREKSI,");

$pdf->Text('115','272', DIRECTOR_NAME);
//Line(float x1, float y1, float x2, float y2)
$pdf->SetLineWidth(0.1);
$pdf->Line(115,273,180,273);
$pdf->Text('115','276.5', "DIREKTUR");

$pdf->SetLeftMargin(35);
$pdf->SetTopMargin(20);
$pdf->AddPage();
//$pdf->WaterMarkBack( "S  P  E  C  I  M  E  N" );
$pdf->SetFont('Arial','B',8);
$pdf->Text('75','20','KETENTUAN - KETENTUAN KHUSUS');
$pdf->SetFont('Arial','B',8);

//$pdf->Text('161','13', $prefix."-".$nopertanggungan);

$sql1="select $DBUser.polis.getnotes2('$prefix','$nopertanggungan') notes from dual";
$DB->parse($sql1);
$DB->execute();
$res=$DB->nextrow();
$notes = $res["NOTES"];

$pdf->Ln(5);
$pdf->SetFont('courier','',8);
$html = nl2br($notes);

//var_dump(str_replace("<br>","",str_replace("<br />", "<br>", $html)));

$pdf->WriteHTML("<pre>".$html."</pre>");
//$pdf->MultiCell('170','10',$html);

$pdf->Ln(5);
$sql1="select $DBUser.polis.gettebus2('$prefix','$nopertanggungan') tebus from dual"; 
$DB->parse($sql1);
$DB->execute();
$res=$DB->nextrow();
$tebus = $res["TEBUS"];
$html2 = "<pre>".nl2br($tebus)."</pre>";
$pdf->WriteHTML($html2);



















$acakfile = $ipremote.substr(md5(md5(strtotime('now')+date("u"))), -10, 10).".pdf";
$acakfileSWF = $ipremote."swf_".substr(md5(md5(strtotime('now')+date("u"))), 0, 7).".swf";
$destPDFFile = str_replace("/","\\\\",DIR_TEMP)."\\\\".$acakfile;
$destSWFFile = str_replace("/","\\\\",DIR_TEMP)."\\\\".$acakfileSWF;
$destSWFFileHREF = HREF_SWF_TEMP."/".$acakfileSWF;
$PDFTOSWFCONV =  str_replace("/","\\\\",PDFTOSWF);
$pdf->Output(DIR_TEMP."/".$acakfile, 'F');
$x = exec($PDFTOSWFCONV."\\\\pdf2swf.exe ".$destPDFFile." -o ".$destSWFFile." -T 9 -f"); 
unlink(DIR_TEMP."/".$acakfile);
if($x)
{	
	header("location:iie.cetak.polis.view.php?do=".base64_encode($destSWFFileHREF));
}








 
?>
