<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  
  $DB = new database($userid, $passwd, $DBName);
//--------------------------- check data ----------------	
echo "<b>SendMail Desisi 1 </b><br><br>";
/*echo "Kantor : ".$kantor."<br>";
echo "Tertanggung : ".$tertanggung."<br>";
echo "Macam Polis : ".$macampolis."<br>";
echo "Jml Uang Asuransi : ".$jua."<br>";
echo "Alamat Penagih : ".$alamatpenagih1."<br>";
*/
//---------------------- send mail --------------------------
	
		 $sqlkp= "select kdkantor,email,namakantor,alamat02,emailxlindo ".
	           "from $DBUser.tabel_001_kantor ".
	           "where kdkantor ='$kantor'";
					 
     $DB->parse($sqlkp);
	   $DB->execute();
	   $ark=$DB->nextrow();
		   $namakantor = $ark["NAMAKANTOR"];
	     $email = $ark["EMAILXLINDO"];	

     $today = date("F j, Y, g:i a");    
		 echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";  
		 //---------------------------- isi email ------------------------------           
     $isi .= "Kepada Yth.\n".$namakantor."\ndi Tempat \n\n";			
	   $isi .= "Perihal : Desisi Asuransi Jiwa Medical \n\n";
		 
     $isi .= "DESISI ASURANSI JIWA MEDICAL\n\n";
		 $isi .= "Untuk Branch Office      \t:  ".$namakantor."\n\n";
		 $isi .= "1. Nomor S.P.A.J         \t:  ".$nospaj."\n";
		 $isi .= "   Tanggal               \t:  ".$tglspaj."\n";
		 $isi .= "2. Nama Pemegang Polis   \t:  ".$pemegangpolis."\n";
		 $isi .= "3. Nama Tertanggung      \t:  ".$tertanggung."\n\n";
		 
		 $isi .= "DITERIMA SUBSTANDARD PER\n\n";
     $isi .= "Dengan ketentuan \n";
		 $isi .= "a) Macam Polis           \t:  ".$macampolis."\n";
		 $isi .= "b) Macam Asuransi        \t:  ".$macamasuransi."\n";
		 $isi .= "c) Jumlah Uang Asuransi  \t:  ".$jua."\n";
		 $isi .= "d) Lama Asuransi         \t:  ".$lamaasuransi_th." TAHUN ".$lamaasuransi_bl." BULAN\n";
		 $isi .= "e) Lama Pembayaran Premi \t:  ".$lamapembpremi_th." TAHUN ".$lamapembpremi_bl." BULAN\n";
		 $isi .= "f) Cara Pembayaran Premi \t:  ".$carabayar."\n";
		 $isi .= "g) Premi Standard Tahunan\t:  ".$premi1."\n";
		 $isi .= "h) Premi                 \t:  ".$premi2."\n";
		 $isi .= "i) Indeks Dasar          \t:  ".$indexdasar."\n";
		 $isi .= "j) Alamat Pemegang Polis \t:  ".$almtpemegangpls1." ".$almtpemegangpls2."\n";
		 $isi .= "                         \t   ".$almtpemegangpkdpos." Telp.".$almtpemegangplsphone."\n";
     $isi .= "k) Alamat Penagih Premi  \t:  ".$alamatpenagih1." ".$alamatpenagih2."\n";
	   $isi .= "                         \t   ".$kdpospenagih." Telp.".$telppenagih."\n\n";
	   $isi .= "4. Besar bunga keterlambatan pembayaran\n";
		 $isi .= "   premi (jika ada)      \t:  ".$bungapremi."\n";
		 $isi .= "5. Keterangan            \t:  a). Besar premi tersebut di atas berlaku apabila \n";
		 $isi .= "                         \t       dilunasi pada bulan ".$bulanlunas."\n";
	   $isi .= "                         \t   b). Premi BP3 + Biaya Polis + Materai agar dilunasi dan\n";
	   $isi .= "                         \t       disetorkan ke Kas Perusahaan, segera dilaporkan\n";
	   $isi .= "                         \t       ke ".$namakantor."\n";
		 $isi .= "                         \t       supaya polis dapat diterbitkan. \n\n";
	
	   $isi .= "                         \t       Jakarta ".$today."\n";
		 $isi .= "                         \t       DIVISI PERTANGGUNGAN PERORANGAN\n\n";
		 
		 $isi .= "                         \t       ".$pejabat."\n";
		 $isi .= "                         \t       Kepala Divisi\n\n";
		 $isi .= "Tembusan\n";
     $isi .= "1. B.A.P. Head Office; Divisi PP\n";		 
		 $isi .= "2. B.A.P. ".$namakantor."; Bagian Pertanggungan\n";
		 $isi .= "3. Pemeriksa. ".$namakantor."; untuk ditindak lanjuti\n";
		 $isi .= "4. Arsip.\n";	
		 
	$message = $isi;
	mail($email,"Desisi Asuransi Jawa Medical ($today)",$message,"From: $emailpengirim\nReply-To: $emailpengirim\ncc: $emailpengirim\nX-Mailer: PHP/" . phpversion());
 	
	echo "<font face=\"Verdana\" size=\"2\">Email di kirim ke ".$email."</font>";
  echo "<br><br>";
	echo "<hr size=1>";
	echo "<font face=\"Verdana\" size=\"2\"><a href=\"desisimedical1.php\">Back</a></font>";
 ?>
