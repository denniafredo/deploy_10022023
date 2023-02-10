<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
	include "../../includes/tgl.php";
//	include "../../includes/sendemail.php";  
	include "../../includes/email.php";
		include "../../includes/kantor.php";
//var_dump($_POST);
  $KTR = New Kantor($userid,$passwd,$kantor);
  $DB = new database($userid, $passwd, $DBName);

  echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";	

	echo "<font face=\"Verdana\" size=\"2\"><b>Kirim Email</b></font>";
	echo "<hr size=\"1\">";
	echo "<font face=\"Verdana\" size=\"2\">Tanggal ".$tanggal."</font><br><br>";		
	
	$sql = "SELECT email, namauser FROM $DBUser.tabel_888_userid WHERE userid = '$userid'";
	//echo $sql;
    $DB->parse($sql);
    $DB->execute();
    $sender = $DB->nextrow();
	$namasender=$sender['NAMAUSER'];

    $mail->AddCC($sender['EMAIL'], $sender['NAMAUSER']);
    $mail->AddReplyTo($sender['EMAIL'], $sender['NAMAUSER']);
    $mail->SetFrom($mail->Username, 'Aplikasi JLINDO');
    $mail->Subject  = "Permohonan Approval Proposal ";
	//--------------------------------- start email tujuan kantor pusat	------------------	
   				
 	       echo "<font color=\"black\" face=\"Verdana\" size=\"1\"><b><u>Medical</u></b></font><br>";		

	      $sqlx  = "select a.prefixpertanggungan,a.nopertanggungan,a.kdpertanggungan,a.notertanggung,".
	               "a.kdproduk,a.mulas,a.lamaasuransi_th,a.lamaasuransi_bl,a.premi1,a.premi2,a.kdvaluta,a.kdstatusmedical,".
				         "a.kdcarabayar,a.nopenagih,a.noagen,a.juamainproduk,a.kdstatusemail,".
					       "c.namaklien1 ttg,d.namaklien1 pmgpol ".
					       "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_100_klien c,$DBUser.tabel_100_klien d ".
                 "where ".
					         "(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                   "where kdstatusunderwriting='0' ".
                   "and a.prefixpertanggungan=b.prefixpertanggungan ".
                   "and a.nopertanggungan=b.nopertanggungan)=0 ".
                 "and a.prefixpertanggungan='$kantor' and a.kdstatusemail is null and ".
					       "a.notertanggung=c.noklien and a.nopemegangpolis=d.noklien and a.kdpertanggungan='1' ".
                 "and a.kdstatusmedical in ('M')";
				 //echo $sqlx;
	        $DB->parse($sqlx);
	        $DB->execute();
		      $res = $DB->result();
		
		     foreach ($res as $foo => $data) {
	         $i=0;
					 if (${$data["NOPERTANGGUNGAN"]} == "ON") {
					 $i = $count + 1;
		       $prefix = $data["PREFIXPERTANGGUNGAN"];					 
		       $nopert = $data["NOPERTANGGUNGAN"];
					 $pmgpol = $data["PMGPOL"];
					 $kdproduk = $data["KDPRODUK"];
					 $noprop .= $i."\t".$prefix."-".$nopert."\t ".$pmgpol."\t ".$kdproduk."\n";
					 
					 $query = "update $DBUser.tabel_200_pertanggungan set ".
	                  "kdstatusemail='1',tglsendemail=sysdate where nopertanggungan='$nopert' and ".
							      "kdpertanggungan='1' and kdstatusemail is null";
           $DB->parse($query);
           $DB->execute();
					 $DB->commit();
					 $count++;
			}
			}
				if (!$nopert) {
			       echo "Anda belum memilih proposal Medical !";
			  } else {
			       echo "<pre>";        
	           echo $noprop."<br>";
             echo "</pre>";	           
	   
	
	
	      $isim .= "Kepada Yth.\nKEPALA BAGIAN UNDERWRITING\nDIVISI PERTANGGUNGAN PERORANGAN\nKANTOR PUSAT\n\n";
		    $isim .= "Perihal : Permohonan Akseptasi \n\n";
		    $isim .= "Berikut ini kami sampaikan daftar proposal untuk \ndapat segera diproses akseptasinya, sebagai berikut :\n\n";
	 
	 	    $isim .= "No.\tNomor Proposal \tNama \tKode Produk\n";
        $isim .= "-----------------------------------------------\n";
				$isim .= "$noprop";
        $isim .= "-----------------------------------------------\n\n";
	      $isim .= "Demikian kami sampaikan atas perhatiannya \nkami ucapkan terima kasih.\n\n\n";
			  $isim .= $kodya.", ".$tanggal."\n";
			  
		    $isim .= "Branch Manager\n";
			  $isim .= $pejabat;
			  
			  // Email ke pegawai pertanggungan
    /*$sql = "SELECT namauser, email, c.namarole
            FROM $DBUser.tabel_888_userid a
            INNER JOIN $DBUser.wuser_role b ON a.userid = b.userid
            INNER JOIN $DBUser.wrole c ON b.kdmodul = c.kdrole
            WHERE a.kdkantor = 'KP'
                AND status = '0'
                AND kdrole = 'AAL'
            ORDER BY kdrole";*/
	$sql = "SELECT namauser, email, c.namarole
            FROM $DBUser.tabel_888_userid a
            INNER JOIN $DBUser.wuser_role b ON a.userid = b.userid
            INNER JOIN $DBUser.wrole c ON b.kdmodul = c.kdrole
            WHERE a.userid in ('SAL_MAN','DEDI')";
    $DB->parse($sql);
    $DB->execute();
    while ($r = $DB->nextrow()) {
       // $mail->AddAddress($r['EMAIL'], $r['NAMAUSER']); // Silahkan hilangkan tanda komentar pada baris ini		
		//$mail->AddAddress('dedi_zufrianto@jiwasraya.co.id', 'Dedi'); // Silahkan berikan / bubuhkan tanda komentar pada baris ini
    }
	$mail->AddAddress('dedi_zufrianto@jiwasraya.co.id', 'Dedi'); // Silahkan berikan / bubuhkan tanda komentar pada baris ini
	$mail->Body=$isim;
	if(!$mail->send()) {
        echo 'Email gagal dikirim.';
        echo 'Error : ' . $mail->ErrorInfo;
    } else {
        echo "<br><font color=\"black\" face=\"Verdana\" size=\"1\">Sudah dikirim ke ".$emailkp."</font>";
    }
    
	//mail($emailkp,"Proposal Alert ($kantor/$today)",$isim,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
				
				}
	
	echo "<br><br>";
	if ($nonmedical == "") {
	  	 echo " <font face=\"Verdana\" size=\"2\">Proposal Non Medical Tidak ada</font>";
	} else {
	
	  echo "<font color=\"black\" face=\"Verdana\" size=\"1\"><b><u>Non Medical</u></b></font><br>";		
		
		$sqly= "select a.nopolbaru, a.prefixpertanggungan,".
	      "a.nopertanggungan,a.kdpertanggungan,a.notertanggung,a.kdproduk,a.mulas,".
				"a.lamaasuransi_th,a.lamaasuransi_bl,a.premi1,a.premi2,a.kdvaluta,".
				"a.kdstatusmedical,a.kdcarabayar,a.nopenagih,a.noagen,a.juamainproduk,a.kdstatusemail,".
				"(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar,".
				"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) ttg,".
				"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) pmgpol,".
				"(select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
				"where  a.prefixpertanggungan = g.prefixpertanggungan ".
				"AND a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005')) nilaipembayaran ".
				"from ".
				"$DBUser.tabel_200_pertanggungan a ".
				"where ".
				"a.kdstatusemail is null ".
				"AND a.nopenagih is not null ".
				"AND a.premi1 != '0' ".
				"AND a.prefixpertanggungan = '$kantor' ".
				"AND a.kdstatusmedical = 'N' ".
				"AND a.kdpertanggungan = '1' ";


	           $DB->parse($sqly);
	           $DB->execute();
		         $res = $DB->result();
		
		     foreach ($res as $foo => $data) {
	         $j=0;
					if (${$data["NOPERTANGGUNGAN"]} == "ON") {
						$j = $hit + 1;
				    	$prefixn = $data["PREFIXPERTANGGUNGAN"];					 
				    	$nopertn = $data["NOPERTANGGUNGAN"];
						$pmgpoln = $data["PMGPOL"];
						$kdproduk = $data["KDPRODUK"];
						$nopropn .= $j."\t"./*$prefixn."-".$nopertn*/$data['NOPOLBARU']."\t ".$pmgpoln."\t ".$kdproduk."\n";

					 	$query = "update $DBUser.tabel_200_pertanggungan set ".
	                				"kdstatusemail='1',tglsendemail=sysdate where nopertanggungan='$nopertn' and ".
									"kdpertanggungan='1' and kdstatusemail is null";
		            	$DB->parse($query);
		            	$DB->execute();
						$DB->commit();

						//Tambahan ketika klik lanjut pending dari kantor cabang maka akan tersimpan ke histori mutasi underwriting - Teguh 08/11/2019             
			            $sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
			                      VALUES ('$prefixn', '$nopertn', 'Proposal Baru Dikirim',  '-', '-', '-', sysdate, '$userid')";
			            $DB->parse($sqlip);
			            $DB->execute();
			            // End Tambahan - teguh (08/11/2019)

						$hit++;
			}
			} 				
			if (!$nopertn) {
			       echo "Anda belum memilih proposal Non Medical !";
			  } else {
						 echo "<pre>";        
	           echo $nopropn."<br>";
             echo "</pre>";	   
				/*
				$isin .= "Kepada Yth.\nKEPALA BAGIAN PERTANGGUNGAN\n".$namakantor."\ndi Tempat \n\n";
				
		    $isin .= "Perihal : Pemberitahuan Proposal Baru \n\n";
		    $isin .= "Berikut ini kami sampaikan daftar proposal yang  \nsudah siap diakseptasi, sebagai berikut :\n\n";
	 			*/
				$isin .= "Kepada Yth.\nKEPALA BAGIAN UNDERWRITING\nKANTOR PUSAT\ndi Tempat \n\n";
				
		    $isin .= "Perihal : Permohonan Approval Proposal \n\n";
		    $isin .= "Berikut ini kami sampaikan daftar proposal untuk \ndapat segera diproses approvalnya, sebagai berikut :\n\n";
	 
	 	    $isin .= "No.\tNomor Proposal \tNama \tKode Produk\n";
        $isin .= "-----------------------------------------------\n";
	      $isin .= "$nopropn";
				$isin .= "-----------------------------------------------\n\n";
	      $isin .= "Demikian kami sampaikan atas perhatiannya \nkami ucapkan terima kasih.\n\n\n";
			  $isin .= $KTR->kotamadya.", ".$tanggal."\n";
		    $isin .= "$namasender\n";
			  $isin .= $pejabat;
  			$mail->Body=$isin;


	if(!$mail->send()) {
        echo 'Email gagal dikirim.';
        echo 'Error : ' . $mail->ErrorInfo;
    } else {
        echo "<br><font color=\"black\" face=\"Verdana\" size=\"1\">Sudah dikirim ke ".$emailkp."</font>";
    }
	//mail($emailcabang,"Proposal Alert ($kantor/$today)",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());	
	//			echo "<font color=\"black\" face=\"Verdana\" size=\"1\">Sudah dikirim ke Kantor Pusat</font>";

		}
	 }  
  echo "<br><br>";
	echo "<hr size=\"1\">";
	//echo "[<font face=\"Verdana\" size=\"2\"><a href=\"#\" onclick=\"javascript:window.print();\">CETAK</a>]";
  //echo "&nbsp;&nbsp;&nbsp;<font color=\"red\">Cetak halaman pengiriman email ini sebagai bukti anda telah menyelesaikan entry proposal.</font></font>";
 ?>
<hr size="1">
<font face="verdana" size="2"><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></font>
