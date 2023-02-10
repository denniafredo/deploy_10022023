<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB = new database($userid, $passwd, $DBName);
  
	$sqlkp="select kdkantor,email,namakantor,alamat02,emailxlindo ".
	       "from $DBUser.tabel_001_kantor ".
	       "where kdkantor ='$kantor'";
	$DB->parse($sqlkp);
	$DB->execute();
	$ark=$DB->nextrow();
	$emailpengirim = $ark["EMAILXLINDO"];	
		 
	$sqlkodya="select a.kdkotamadya,b.namakotamadya ".
	          "from $DBUser.tabel_001_kantor a,$DBUser.tabel_109_kotamadya b ".
	          "where a.kdkantor='$kantor' and a.kdkotamadya=b.kdkotamadya";
  $DB->parse($sqlkodya);
	$DB->execute();
	$arm=$DB->nextrow();
	$kodya = $arm["NAMAKOTAMADYA"];
	$today = date("F j, Y, g:i a");
	//echo "Kodya :".$kodya."<br>";	
 // $kantor="KP";
	if ($kantor=="KP") {
	  $sql="select kdkantor,email,namakantor,alamat02,emailxlindo ".
	       "from $DBUser.tabel_001_kantor ".
	       "where kdkantor ='$kantor'";
     $DB->parse($sql);
	   $DB->execute();
	   $arr=$DB->nextrow();
     $namakantor = $arr["NAMAKANTOR"];
	   $perwakilan = $arr["ALAMAT02"];
	   $email = $arr["EMAILXLINDO"];	
  }	else { 
	  $sql="select kdkantor,email,namakantor,alamat02,emailxlindo ".
	       "from $DBUser.tabel_001_kantor ".
	       "where kdkantor in ".
				 "(select kdkantorinduk from $DBUser.tabel_001_kantor where kdkantor='$kantor')";
	   $DB->parse($sql);
	   $DB->execute();
	   $arr=$DB->nextrow();
     $namakantor = $arr["NAMAKANTOR"];
	   $perwakilan = $arr["ALAMAT02"];
	   $email1 = $arr["EMAILXLINDO"];
		 
		$sqlmail="select emailopr from $DBUser.tabel_001_kantor ".
	       "where kdkantor='KP'";
	   $DB->parse($sqlmail);
	   $DB->execute();
	   $ml=$DB->nextrow();
     $email = $ml["EMAILOPR"];
	}
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";	
 //--------------------- cari nama pejabat --------------

	$qry= "select kdkantor,namapejabat ".
	      "from $DBUser.tabel_002_pejabat ".
	      "where kdkantor ='$kantor'";
	$DB->parse($qry);
	$DB->execute();
	$ars=$DB->nextrow();
	$pejabat = $ars["NAMAPEJABAT"];
	//--------------------------------- start email tujuan kantor pusat	------------------	

		$sqlz="select kdstatusmedical ".
					"from $DBUser.tabel_200_pertanggungan ".
          "where prefixpertanggungan='$kantor' and nopertanggungan='$nopertanggungan'";
  $DB->parse($sqlz);
	$DB->execute();
	$rrr=$DB->nextrow();
	$statusmed = $rrr["KDSTATUSMEDICAL"];                                             

	 if ($statusmed != "M") { 
	    echo $kantor."-".$nopertanggungan."<br>";
			echo "<font face=\"Verdana\" size=\"2\" color=\"red\">Bukan Proposal Medical</font>";   
	 } else {	
		//--------------------------- content ------------	
		echo "<font face=\"Verdana\" size=\"2\"><b>Kirim Email</b></font>";
		echo "<hr size=\"1\">";
		echo "<font face=\"Verdana\" size=\"2\">Tanggal ".$today."</font><br><br>";	
		$sqlx="select a.prefixpertanggungan,a.nopertanggungan,a.kdpertanggungan,a.notertanggung,".
          "a.kdproduk,a.mulas,a.lamaasuransi_th,a.lamaasuransi_bl,a.premi1,a.premi2,a.kdvaluta,".
				  "a.kdstatusmedical,a.kdcarabayar,a.nopenagih,a.noagen,a.juamainproduk,a.kdstatusemail,".
			    "c.namaklien1 ttg,d.namaklien1 pmgpol ".
					"from ".
					"$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_100_klien c,$DBUser.tabel_100_klien d ".
          "where ".
          "a.prefixpertanggungan='$kantor' and ".
					"a.notertanggung=c.noklien and a.nopemegangpolis=d.noklien and ".
          "a.nopertanggungan='$nopertanggungan'";
		//echo $sqlx;
    $DB->parse($sqlx);
    $DB->execute();

	  $today = date("F j, Y, g:i a");                 
		$isin .= "Kepada Yth.\nKEPALA BAGIAN UNDERWRITING\nKANTOR PUSAT JAKARTA\ndi Tempat \n\n";
    $isin .= "Perihal : Pernyataan Perubahan Premi \n\n";
    $isin .= "Berikut ini kami sampaikan bahwa proposal berikut :\n\n";
    $isin .= "No.\tNomor Proposal \tNama\n";
    $isin .= "-----------------------------------------------\n";
	 	while($ary=$DB->nextrow()){
					$premi = $arr["PREMI1"];
	        $nilaibayar = $arr["NILAIPEMBAYARAN"];
					$nopertanggungan = $ary["NOPERTANGGUNGAN"];
				  $j = 0;	      
		      $j = $hit + 1;
          $isin .= $j."\t".$ary["PREFIXPERTANGGUNGAN"]."-".$ary["NOPERTANGGUNGAN"]."\t".$ary["PMGPOL"]."\n";
          echo "<font face=\"Verdana\" size=\"2\">Proposal <b>".$ary["PREFIXPERTANGGUNGAN"]."-".$ary["NOPERTANGGUNGAN"]." ".$ary["PMGPOL"]."</b></font><br>";
					$hit++;
    }		
				$isin .= "-----------------------------------------------\n\n";
				$isin .= "menyatakan \"".$ubahpremi."\" ketentuan Perubahan Premi.\n\n";
	      $isin .= "Demikian kami sampaikan atas perhatiannya \nkami ucapkan terima kasih.\n\n\n";
			  $isin .= $kodya.", ".$today."\n";
		    $isin .= "Branch Manager\n";
			  $isin .= $pejabat;
		    $message = $isin;
				$prihal = ($ubahpremi=="Menerima")? "Pernyataan Setuju Medical ($today)" : "Pernyataan Tidak Setuju Medical ($today)";
  			mail($email,$prihal,$message,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
  			echo "<br>";
				echo "<font color=\"black\" face=\"Verdana\" size=\"1\">Sudah dikirim ke ".$email."</font>";
  }
			//----------------------------- change kode statusemail ------------------
  if ($ubahpremi=="Menerima" ){
	           $query= "update $DBUser.tabel_215_rate_up set ".
	                   "status='1' where prefixpertanggungan='$kantor' and ".
										 "nopertanggungan='$nopertanggungan'";
             $DB->parse($query);
             $DB->execute();
						 $DB->commit();
  } else if ($ubahpremi=="Tidak Menerima" ){
	           $query= "update $DBUser.tabel_215_rate_up set ".
	                   "status='0' where prefixpertanggungan='$kantor' and ".
										 "nopertanggungan='$nopertanggungan'";
             $DB->parse($query);
             $DB->execute();
						 $DB->commit();
	}
echo "<hr size=\"1\">";				//----------------------------- end change kode statusemail -------------- 	
echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
?>
