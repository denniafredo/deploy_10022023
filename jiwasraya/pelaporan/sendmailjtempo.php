<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  
  $DB = new Database($userid, $passwd, $DBName);
  //$kantor = "BH";
		 $sqlkp= "select kdkantor,email,namakantor,alamat02,emailxlindo ".
	           "from $DBUser.tabel_001_kantor ".
	           "where kdkantor ='$kdkantor'";
					 
     $DB->parse($sqlkp);
	   $DB->execute();
	   $ark=$DB->nextrow();
	   $emailpengirim = $ark["EMAILXLINDO"];	
		 
		 $sqlkodya= "select a.kdkotamadya,b.namakotamadya ".
	              "from $DBUser.tabel_001_kantor a,$DBUser.tabel_109_kotamadya b ".
	              "where a.kdkantor='$kdkantor' and a.kdkotamadya=b.kdkotamadya";
					 
     $DB->parse($sqlkodya);
	   $DB->execute();
	   $arm=$DB->nextrow();
	     $kodya = $arm["NAMAKOTAMADYA"];
		//echo "Kodya :".$kodya."<br>";	
		 $today = date("F j, Y, g:i a");

	if ($kantor=="KP") {
	   $sql= "select kdkantor,email,namakantor,alamat02,emailxlindo ".
	         "from $DBUser.tabel_001_kantor ".
	         "where kdkantor ='$kantor'";
					 
     $DB->parse($sql);
	   $DB->execute();
	   $arr=$DB->nextrow();
       $namakantor = $arr["NAMAKANTOR"];
	     $perwakilan = $arr["ALAMAT02"];
	     $email = $arr["EMAILXLINDO"];	
	   } 
	else	 { 
	   $sql= "select kdkantor,email,namakantor,alamat02,emailxlindo ".
	         "from $DBUser.tabel_001_kantor ".
	         "where kdkantor in (select kdkantorinduk from $DBUser.tabel_001_kantor where kdkantor='$kdkantor')";
	   $DB->parse($sql);
	   $DB->execute();
	   $arr=$DB->nextrow();
       $namakantor = $arr["NAMAKANTOR"];
	     $perwakilan = $arr["ALAMAT02"];
	     $email = $arr["EMAILXLINDO"];
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
	echo "<font face=\"Verdana\" size=\"2\"><b>Kirim Email Pemberitahuan Jatuh Tempo ".$today."</b></font>";
	echo "<hr size=\"1\">";
	//echo "<font face=\"Verdana\" size=\"2\">Tanggal ".$today."</font><br><br>";		

  $sqly="select a.prefixpertanggungan,a.nopertanggungan,to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,".
	     "to_char(a.tglseatled,'DD/MM/YYYY') tglseatled,a.premitagihan,".
	     "b.namaklien1,c.nopertanggungan,c.kdproduk,c.juamainproduk,c.kdcarabayar,c.kdvaluta,".
			 "c.premi1,c.kdstatusmedical,to_char(c.mulas,'DD/MM/YYYY') mulas,to_char(c.tglupdated,'DD/MM/YYYY') tglupdated,".
			 "c.tglnextbook,d.notasi,e.namacarabayar ".
			 "from $DBUser.tabel_300_historis_premi a,$DBUser.tabel_100_klien b,$DBUser.tabel_200_pertanggungan c,".
			 "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e where ".
			 "a.nopertanggungan=c.nopertanggungan and ".
			 "c.notertanggung=b.noklien and c.kdvaluta=d.kdvaluta and c.kdcarabayar=e.kdcarabayar and ".
	     "a.prefixpertanggungan='$kdkantor' order by a.nopertanggungan";	
											  
					$yy = $DB->parse($sqly);
	        $DB->execute();
          $ary=$DB->nextrow();
	        $total = OCIRowCount($yy);                                             
            if ($total== 0) { 
	            echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	            echo "<br>";
              print "<font face=\"Verdana\" size=\"2\">Tidak ada jatuh tempo</font>";  
		         	echo "<br>";
  	       	}                                                            
            elseif ($total> 0)
            {
	
	 $sqly="select a.prefixpertanggungan,a.nopertanggungan,to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,".
	       "to_char(a.tglseatled,'DD/MM/YYYY') tglseatled,a.premitagihan,".
	       "b.namaklien1,c.nopertanggungan,c.kdproduk,c.juamainproduk,c.kdcarabayar,c.kdvaluta,".
			   "c.premi1,c.kdstatusmedical,to_char(c.mulas,'DD/MM/YYYY') mulas,to_char(c.tglupdated,'DD/MM/YYYY') tglupdated,".
			   "c.tglnextbook,d.notasi,e.namacarabayar ".
			   "from $DBUser.tabel_300_historis_premi a,$DBUser.tabel_100_klien b,$DBUser.tabel_200_pertanggungan c,".
			   "$DBUser.tabel_304_valuta d,$DBUser.tabel_305_cara_bayar e where ".
			   "a.nopertanggungan=c.nopertanggungan and ".
			   "c.notertanggung=b.noklien and c.kdvaluta=d.kdvaluta and c.kdcarabayar=e.kdcarabayar and ".
	       "a.prefixpertanggungan='$kdkantor' order by a.nopertanggungan";

	     $DB->parse($sqly);
	     $DB->execute();
			  $today = date("F j, Y, g:i a");                 
				$isin .= "Kepada Yth.\n".$namakantor."\ndi Tempat \n\n";
				
		    $isin .= "Perihal : Permohonan Cetak Jatuh Tempo\n\n";
		    $isin .= "Berikut ini kami sampaikan daftar polis yang \nakan jatuh tempo untuk diproses surat jatuh temponya, \nsebagai berikut :\n\n";
	 
	 	    $isin .= "No.\tNo.Pertanggungan \tNama\n";
        $isin .= "-----------------------------------------------\n";
				echo "<table>";
				echo "<tr><td><font face=\"Verdana\" size=\"1\">No.</font></td>";
				echo "<td><font face=\"Verdana\" size=\"1\">No. Pertanggungan</font></td>";
				echo "<td><font face=\"Verdana\" size=\"1\">Tertanggungan</font></td></tr>";
			 	while($ary=$DB->nextrow()){
				  $j = 0;	      
		      $j = $hit + 1;
          $isin .= $j."\t".$ary["PREFIXPERTANGGUNGAN"]."-".$ary["NOPERTANGGUNGAN"]."\t".$ary["NAMAKLIEN1"]."\n";
          
					echo "<tr><td><font face=\"Verdana\" size=\"1\">".$j."</font></td>";
					echo "<td><font face=\"Verdana\" size=\"1\">".$ary["PREFIXPERTANGGUNGAN"]."-".$ary["NOPERTANGGUNGAN"]."</font></td>";
					echo "<td><font face=\"Verdana\" size=\"1\">".$ary["NAMAKLIEN1"]."</font></td></tr>";
					$hit++;
			    }		
				echo "</table>";	
				$isin .= "-----------------------------------------------\n\n";
	      $isin .= "Demikian kami sampaikan atas perhatiannya \nkami ucapkan terima kasih.\n\n\n";
			  $isin .= $kodya.", ".$today."\n";
		    $isin .= "Branch Manager\n";
			  $isin .= $pejabat;
		    $message = $isin;
  			mail($email,"Jatuh Tempo ($today)",$message,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
  			echo "<font color=\"black\" face=\"Verdana\" size=\"1\">Sudah dikirim ke ".$email."</font>";
  		  }  
				//----------------------------- change kode statusemail ------------------
        /* 
		      if ($premi <=$nilaibayar ){
	           $query= "update $DBUser.tabel_200_pertanggungan set ".
	                   "kdstatusemail='1',tglsendemail=sysdate where prefixpertanggungan='$kantor' and ".
										 "tglsendemail is null and kdstatusemail is null and kdpertanggungan='1'";
							       
             $DB->parse($query);
             $DB->execute();
						 $DB->commit();
	           } 
					*/	 
				//----------------------------- end change kode statusemail -------------- 	
?>

<hr size="1">
<font face="verdana" size="2"><a href="index.php">Menu Pelaporan</a></font>
