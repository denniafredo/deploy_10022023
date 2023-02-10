<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
	
  $sql = "select a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
	       "a.expirasi, a.lamapembpremi_th, a.lamapembpremi_bl as periode_bulan, ".
				 "a.lamaasuransi_th, a.lamaasuransi_bl, ".
				 "a.juamainproduk, a.premi1, a.premi2, a.nosp, a.kdcarabayar, ".
				 "a.tglnextbook, a.tgllastpayment, b.namaproduk, b.keterangan, ".
				 "c.namacarabayar, pemegangpolis.alamattetap01, pemegangpolis.alamattetap02, ".
				 "pemegangpolis.kodepostetap, pemegangpolis.phonetetap01, ".
				 "pemegangpolis.namaklien1 as pemegangpolis, tertanggung.namaklien1 as tertanggung ".
				 "from ".
				 "tabel_100_klien pemegangpolis, tabel_100_klien tertanggung, ".
				 "tabel_200_pertanggungan a, tabel_202_produk b, tabel_305_cara_bayar c ".
				 "where ".
				 "(b.kdproduk=a.kdproduk) and (a.notertanggung=tertanggung.noklien) and ".
				 "(a.nopemegangpolis=pemegangpolis.noklien) and (a.kdcarabayar=c.kdcarabayar) and ".
				 "(a.kdpertanggungan='2') and (a.prefixpertanggungan='BW') and ".
				 "(a.nopertanggungan='$nopertanggungan')";
	$DB->parse($sql);
	$DB->execute();
	echo "<h2>POLIS</h2>";
	echo "<hr size=\"1\">";
	echo $arr["LAMAPEMBPREMI_TH"];
	while($arr=$DB->nextrow()){
	$lamapremi = $arr["LAMAPEMBPREMI_TH"];
	$extrapremi = 5;
	$sisabayar = $lamapremi - $extrapremi;
	//echo $sisabayar;
		 echo "<pre>";
		 echo "No.Pertanggungan      : ".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."<br>";
		 echo "Pemegang Polis        : ".$arr["PEMEGANGPOLIS"]."    usia ".$arr["USIA_TH"]." TAHUN<br>";
		 echo "Tertanggung           : ".$arr["TERTANGGUNG"]."<br>";
		 echo "Macam Asuransi        : ".$arr["NAMAPRODUK"]."<br>";
		 echo "Mulai Asuransi        : ".$arr["MULAS"]."<br>";
		 echo "Masa Asuransi         : ".$arr["LAMAASURANSI_TH"]." tahun ".$arr["LAMAASURANSI_BL"]." bulan<br>";
	   echo "Masa Pembayaran Premi : ".$arr["LAMAPEMBPREMI_TH"]." tahun ".$arr["PERIODE_BULAN"]." bulan<br>";
		 echo "Jumlah Uang Asuransi  : ".number_format($arr["JUAMAINPRODUK"],2)."<br>";
		 echo "<br>";
	   echo "Premi Sebesar         : ".number_format($arr["PREMI1"],2)." dibayar secara: ".$arr["NAMACARABAYAR"]." selama 5 tahun<br>";
		 echo "                        DAN ".number_format($arr["PREMI2"],2)." untuk ".$sisabayar." tahun berikutnya <br>";
		 echo "Alamat                : ".$arr["ALAMATTETAP01"]."<br>";
		 echo "                        ".$arr["ALAMATTETAP02"]." - ".$arr["KODEPOSTETAP"]."<br>";
		 echo "                        Telp. ".$arr["PHONETETAP01"]."<br>";

		 echo "Expirasi              : ".$arr["EXPIRASI"]."<br>";
		 echo "</pre>";
	}
//---------------------------------------- penerima faedah ------------------
 echo "<font face=\"Verdana\" size=\"1\"><b>PENERIMA FAEDAH MENURUT URUTAN :</b></font>";
 echo "<br>";
  $qry = "select ".
         "a.*, d.namaklien1, ".
				 "decode(a.notertanggung, a.noklien,'PEMEGANG POLIS', ".
				 "(select namahubungan from tabel_218_kode_hubungan c ".
				 "where b.kdhubungan=c.kdhubungan)) as hubungan ".
				 "from tabel_219_pemegang_polis_baw a, ".
				 "tabel_113_insurable b, tabel_100_klien d ".
				 "where a.notertanggung=b.notertanggung(+) and ".
				 "a.noklien=b.noklieninsurable(+) and ".
				 "a.noklien=d.noklien and ".
				 "a.kdinsurable='04' and ".
				 "a.prefixpertanggungan='BW' and ".
				 "a.nopertanggungan='$nopertanggungan'";
	
	$DB->parse($qry);
	$DB->execute();
	
	while($ars=$DB->nextrow()){
	   $i = 0;
		 $i = $count + 1;
		 
		 echo "<font face=\"Verdana\" size=\"1\">";
		 echo $i.". ";
		 echo $ars["HUBUNGAN"]." tertanggung, ";
		 echo $ars["NAMAKLIEN1"];
		 
		 echo "<br>";
		 echo "</font>";
		 $count++;
		 }
//---------------------------------------- ketentuan2 khusus ----------------
  echo "<br>";
	
	$query = "select ".
	         "polis.populate(prefixpertanggungan,nopertanggungan), ".
           "polis.parse(b.judulparagraph) as judulparagraph, ".
           "polis.parse(b.teks) as teks ".
           "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_232_ketentuan_polis b ".
           "where a.kdproduk=b.kdproduk and ".
		       "a.prefixpertanggungan ='BW' and ".
		       "a.nopertanggungan ='$nopertanggungan'";

	$DB->parse($query);
	$DB->execute();
	echo "<font face=\"Verdana\" size=\"1\"><b>KETENTUAN-KETENTUAN KHUSUS</b></font>";
	echo "<table border=0 cellpadding=5>";
	while($ars=$DB->nextrow()){
		echo"<tr>";
		echo"<td valign=\"top\" width=\"25%\"><font face=\"Verdana\" size=\"1\">";
		echo $ars["JUDULPARAGRAPH"];
		echo"</font></td>";
		echo"<td valign=\"top\"><font face=\"Verdana\" size=\"1\">";
		echo $ars["TEKS"];
		echo"</font></td>";
		echo"</tr>";
	}
	echo "</table>";
	
//-------------------------------  start nilai tebus ----------
	 $sql1 = "select ".
	        "a.t1, a.tebus1, a.t2, a.tebus2 ".
					"from tabel_231_temp a ".
					"where a.prefixpertanggungan='BW' and a.nopertanggungan='$nopertanggungan' ".
					"order by t1";
					
		$DB->parse($sql1);
	  $DB->execute();
		echo "<table border=0 bgcolor=\"#999999\" cellspacing=\"1\" cellpadding=\"2\">";
		echo"<tr>";
		echo"<td align=\"center\" bgcolor=\"#B3CCCC\"><font face=\"Verdana\" size=\"1\"><b>AKHIR<br> TH KE</b></font></td>";
		echo"<td align=\"center\" bgcolor=\"#B3CCCC\"><font face=\"Verdana\" size=\"1\"><b>NILAI TEBUS</b></font></td>";
		echo"<td align=\"center\" bgcolor=\"#B3CCCC\"><font face=\"Verdana\" size=\"1\"><b>AKHIR<br> TH KE</b></font></td>";
		echo"<td align=\"center\" bgcolor=\"#B3CCCC\"><font face=\"Verdana\" size=\"1\"><b>NILAI TEBUS</b></font></td>";
		echo"</tr>";
	  while ($res=$DB->nextrow()) {
		  echo "<tr>";
		  echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">";
		  echo $res["T1"];
			echo "</font></td>";
			echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">";
			echo $res["TEBUS1"];
			echo "</font></td>";
			echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">";
			echo $res["T2"];
			echo "</font></td>";
			echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">";
			echo $res["TEBUS2"];
			echo "</font></td>";
			echo "</tr>";
		}
		echo "</table>";

	?>