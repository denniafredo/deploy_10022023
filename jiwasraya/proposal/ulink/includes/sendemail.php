<?
  $DB = new database($userid, $passwd, $DBName);
	$prefixpertanggungan = $kantor;

		 $sqlkp= "select kdkantor,email,namakantor,alamat02,emailxlindo,emailadlog ".
	           "from $DBUser.tabel_001_kantor ".
	           "where kdkantor ='$prefixpertanggungan'";	 
     $DB->parse($sqlkp);
	   $DB->execute();
	   $ark=$DB->nextrow();
	   $emailpengirim = $ark["EMAILXLINDO"];	
		 $emailadlog = $ark["EMAILADLOG"];	
		 $kantorcabang = $ark["NAMAKANTOR"];
		
	   $sql= "select kdkantor,email,namakantor,alamat02,emailxlindo,emailopr ".
	         "from $DBUser.tabel_001_kantor where kdkantor ='KP'";		 
     $DB->parse($sql);
	   $DB->execute();
	   $arr=$DB->nextrow();
     $kantorpusat = $arr["NAMAKANTOR"];
	   $perwakilan = $arr["ALAMAT02"];
	   $emailkp = $arr["EMAILOPR"];	
	   
		 $sql= "select kdkantor,email,namakantor,alamat02,emailxlindo ".
	         "from $DBUser.tabel_001_kantor ".
	         "where kdkantor in (select kdkantorinduk from $DBUser.tabel_001_kantor where kdkantor='$kantor')";
	   $DB->parse($sql);
	   $DB->execute();
	   $arr=$DB->nextrow();
     $namakantor = $arr["NAMAKANTOR"];
	   $perwakilan = $arr["ALAMAT02"];
	   $emailcabang = $arr["EMAILXLINDO"];
			 
 	   $qry= "select a.kdkantor,a.namapejabat,a.namajabatan,b.namakantor ".
	         "from $DBUser.tabel_002_pejabat a,$DBUser.tabel_001_kantor b ".
	         "where a.kdkantor ='$kantor' and a.kdkantor=b.kdkantor and a.kdorganisasi='160'";
	   $DB->parse($qry);
	   $DB->execute();
	   $ars=$DB->nextrow();
	   $pejabat = $ars["NAMAPEJABAT"];
		 $jabatan = $ars["NAMAJABATAN"];
	   $branchoffice = $ars["NAMAKANTOR"];

		 $kodya=substr($branchoffice,0,-14);
		 
		 $kdy = "select s.namakotamadya,sysdate from ". 
               "$DBUser.tabel_100a_perwakilan t,".
               "$DBUser.tabel_109_kotamadya s ".
            "where ". 
               "t.kdkantor='$kantor' and ".
               "t.kdkotamadya=s.kdkotamadya and ".
               "t.kdpropinsi=s.kdpropinsi";
							 //echo $kdy;
			$DB->parse($kdy);
	    $DB->execute();
	    $kod=$DB->nextrow();
			$namakodya=$kod["NAMAKOTAMADYA"];
				
		 
     $today = date("F j, Y, g:i a");
	
 switch ($vbln)
 {
   case "1":
          $vbln = "Januari"; break;
   case "2":
          $vbln = "Februari"; break;
   case "3":
          $vbln = "Maret"; break;
   case "4":
          $vbln = "April"; break;
   case "5":
          $vbln = "Mei"; break;
   case "6":
          $vbln = "Juni"; break;
   case "7":
          $vbln = "Juli"; break;
   case "8":
          $vbln = "Agustus"; break;
   case "9":
          $vbln = "September"; break;					
   case "10":
          $vbln = "Oktober"; break;
   case "11":
          $vbln = "Nopember"; break;
   case "12":
          $vbln = "Desember"; break;										
 }
?>
