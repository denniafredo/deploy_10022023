<?
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
  include "../../includes/formula44.php";
	include "../../includes/klien.php";

	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
	$DB=New database($userid, $passwd, $DBName);
  $FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
	//echo $prefixpertanggungan."-".$nopertanggungan;
	//echo $userid." | ".$passwd." | ".$prefixpertanggungan." | ".$nopertanggungan." <br> ";
  //echo $FM->kdbasispremi;
	//masukkan data topup khusus JL2
	/*----------------------- start top up -------------------*/
	
	if($premitopup < $minpremitopup)
	{
	 echo "gagal... premi TOP UP minimal  $minpremitopup";
	}
	else
	{
	  $komisitopup = 0.03 * $premitopup;
		$komisitopuplain = 0.02 * $premitopup;
		$bentopupinvest = 0.95 * $premitopup;
		
    if(isset($addtopup))
    {
			$sql = "insert into $DBUser.tabel_223_temp ".
    			 	 "(prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,premi,kdjenisbenefit) ".
    				 "values ".
    				 "('$prefixpertanggungan','$nopertanggungan','$kodeproduk','BNFTOPUP','$premitopup','T')";
    	//echo $sql;
    	$DB->parse($sql);
      $DB->execute();
			
			$sql = "insert into $DBUser.tabel_404_temp ".
            					 "(prefixpertanggungan,nopertanggungan,komisiagen,".
            					 "kdkomisiagen,noagen,thnkomisi,komisiagencb) ".
              		   "values ('$prefixpertanggungan','$nopertanggungan',$komisitopup,".
  									 		"'29','$noagen','1',$komisitopup) ";
      $DB->parse($sql);
      $DB->execute();
      
			$sql = "insert into $DBUser.tabel_404_temp ".
            					 "(prefixpertanggungan,nopertanggungan,komisiagen,".
            					 "kdkomisiagen,noagen,thnkomisi,komisiagencb) ".
              		   "values ('$prefixpertanggungan','$nopertanggungan',$komisitopuplain,".
  									 		"'30','$noagen','1',$komisitopuplain) ";
			$DB->parse($sql);
      $DB->execute();
    }
  	
  	if(isset($updatetopup))
    {
      $sql = "update $DBUser.tabel_223_temp set premi='$premitopup' ".
    			 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdproduk='$kodeproduk' and kdbenefit='BNFTOPUP'";
    	//echo $sql;
    	$DB->parse($sql);
      $DB->execute();
			
			$sql = "update $DBUser.tabel_404_temp set komisiagen=$komisitopup, komisiagencb=$komisitopup ".
            	"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					  "and kdkomisiagen='29' and noagen='$noagen' ";
			$DB->parse($sql);
      $DB->execute();
			
			$sql = "update $DBUser.tabel_404_temp set komisiagen=$komisitopuplain, komisiagencb=$komisitopuplain ".
            	"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					  "and kdkomisiagen='30' and noagen='$noagen' ";
			$DB->parse($sql);
      $DB->execute();
    }
  	
  	if(isset($deletetopup))
    {
      $sql = "delete $DBUser.tabel_223_temp ".
    			 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdproduk='$kodeproduk' and kdbenefit='BNFTOPUP'";
    	//echo $sql;
    	$DB->parse($sql);
      $DB->execute();
			
			$sql = "delete $DBUser.tabel_404_temp where kdkomisiagen in ('29','30') ".
             "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
			$DB->parse($sql);
      $DB->execute();
			
			$bentopupinvest = 0;
    }
	}
	
	//die;
  /*----------------------- end top up -------------------*/
	
	function getclient($db,$noklien,&$nama) {
	  $sql="select noklien,namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir,jeniskelamin ".
		     "from $DBUser.tabel_100_klien ".
				 "where noklien='$noklien'";
    $db->parse($sql);
	  $db->execute();
	  $res=$db->nextrow();
	  $nama = $res["NAMAKLIEN1"];
		$nokln = $res["NOKLIEN"];
	}
	
	function GetFormula($DBX,$kdrumus) {
	  $sql="select rumus from $DBUser.tabel_224_rumus ".
		     "where kdrumus='$kdrumus'";
	  //echo $sql."<br><br>";
   	$DBX->parse($sql);
    $DBX->execute();
    $arr=$DBX->nextrow();
		$rumus=$arr["RUMUS"];
		return $rumus;
	}

	//echo "Echo : ".$DBX." ".$prefix." ".$noper."".$p1."".$FM->produk."<br>";
	//echo "Echo : ".$premistd." ".$premisum;

	function CompComm($DBX,$prefix,$noper,$premistd,$p1) {
	  //ditambah dalam rangka hitung komisi ADX 
	  $sql = "update $DBUser.tabel_200_temp set premi1='$p1' where ".
				 	 "prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
		// echo $sql;
		$DBX->parse($sql);
	  $DBX->execute();
		
		$sql="begin $DBUser.compcomm('$prefix','$noper',$premistd,$p1); end;";
		//echo $sql;
		$DBX->parse($sql);
		$DBX->execute();
		return;
	}

	function CompComm1($DBX,$prefix,$noper,$premisum,$premistd){
		$sql="begin $DBUser.compcomm1('$prefix','$noper',$premisum,$premistd); end;";
		//echo $sql;
		$DBX->parse($sql);
		$DBX->execute();
		return;
	}
	
	$kdcarabayarlama=$FM->cabayar;
	$nosp = $FM->nosp;
	$kdprod = $FM->produk;
	$masa = $FM->masa;
	//echo $kdcarabayarlama;
	$sql = "select nvl(skg,'0') skg from $DBUser.tabel_202_produk ".
			   "where kdproduk='$kdprod'";
	//echo $sql;			 
	$DB->parse($sql);
  $DB->execute();
	$arb=$DB->nextrow();
	$skg = $arb["SKG"]; // skg=1 hanya untuk override faktor perkalian komisi 1,14 HANYA UNTUK CARA BAYAR SEKALIGUS
	//echo $skg;
	
	//	if ($masa==1||($skg && $kdcarabayarlama=='X')) {

	if ($masa==1) {
	 $sql="update $DBUser.tabel_200_temp c set c.kdcarabayar='X' ".
	      "where c.prefixpertanggungan='$prefixpertanggungan' and ".
			  "c.nopertanggungan='$nopertanggungan' ";
	} else   {
	 $sql="update $DBUser.tabel_200_temp c set c.kdcarabayar= ".
	     "decode(c.kdcarabayar,'M','M','Q','Q','H','H','A','A','4') ".
			 "where c.prefixpertanggungan='$prefixpertanggungan' and ".
			 "c.nopertanggungan='$nopertanggungan' "; 
	}
	//echo $sql;
 
	$DB->parse($sql);
  $DB->execute();
	$DB->commit();				 	
	
	
	$sql="select distinct b.kdrumuspremi ".
	     "from $DBUser.tabel_223_temp a,$DBUser.tabel_206_produk_benefit b ".	
	     "where a.kdproduk=b.kdproduk and a.kdjenisbenefit='U' and ".
			 "a.kdjenisbenefit=b.kdjenisbenefit and ".
			 "a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ";
	
	//echo $sql;
	
	$DBA=New database($userid, $passwd, $DBName);
	$DBA->parse($sql);
  $DBA->execute();
	$premistandar=0;
  while ($has=$DBA->nextrow()) {
	 $koderumusstd=$has["KDRUMUSPREMI"];
	 $rumuspremistd = GetFormula($DBA,$koderumusstd);	
	 $FM1=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
	 $FM1->parse($rumuspremistd);
	 $hasil = $FM1->execute($DBA);
	 /*
	 echo $koderumusstd."<br>";
	 echo $rumuspremistd."<br>";
	 echo $hasil."<br>";
	 */
	 $premistandar+=$hasil;
	}
	//============================================================================
	//Ambil jumlah premi rider untuk mencari nilai premi waiver
	//ditambahkan oleh agus , tanggal : 04 Agustus 2005

    
	$sqlrdr = "select b.kdrumuspremi  ".
						"from 	$DBUser.tabel_223_temp a, ".
						"				$DBUser.tabel_206_produk_benefit b, ".
						"				$DBUser.tabel_207_kode_benefit c  ".
						"where 	a.kdproduk=b.kdproduk ".
						"and    a.kdbenefit=b.kdbenefit ".
						"and   	c.faktorbenefit='1' ".
						"and  	c.kdjenisbenefit='R' ".
						"and    a.kdbenefit = c.kdbenefit ".
						"and 		a.kdjenisbenefit='R'  ".
						"and 		a.prefixpertanggungan='$prefixpertanggungan' ".
						"and 		a.nopertanggungan='$nopertanggungan' ";

	$DBA=New database($userid, $passwd, $DBName);
	$DBA->parse($sqlrdr);
  $DBA->execute();
	$premirider=0;
  while ($has=$DBA->nextrow()) {
	 $koderumusrdr=$has["KDRUMUSPREMI"];
	 $rumuspremirider = GetFormula($DBA,$koderumusrdr);
	 $FM1=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
	 $FM1->parse($rumuspremirider);
	 $hasilx = $FM1->execute($DBA);

	 echo "";
	// echo $rumuspremistd."<br>";
	// echo $hasil."<br>";

	 $premirider+=$hasilx;
	}

	//============================================================================

	//echo $premirider;


  //tambahan untuk ngecek status medical

	$sqlm = "select kdstatusmedical statusm from $DBUser.tabel_200_temp ".
			   " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";

	//echo $sql;
	$DB->parse($sqlm);
  $DB->execute();
	$arb=$DB->nextrow();
	$medical = $arb["STATUSM"];


	if (!$kdcarabayarlama=='') {
	 $sql="update $DBUser.tabel_200_temp set kdcarabayar='$kdcarabayarlama',premistd=$premistandar ".//, premirider =$premirider ".
			  "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
	}
	//echo $sql;

	$DB->parse($sql);
  $DB->execute();
	$DB->commit();


if ($nopertanggungan <> $noproposal) {
	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, ".
			 "TO_CHAR(a.expirasi,'DD/MM/YYYY'),b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit, b.kdrumusakhirpmb ".
       "from $DBUser.tabel_223_temp a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
			 "order by decode(a.kdjenisbenefit,'U',1,'R',2,'W',3,'I',99,'T',100,4) ";
} else {
	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, ".
			 "TO_CHAR(a.expirasi,'DD/MM/YYYY'),b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit, b.kdrumusakhirpmb ".
       "from $DBUser.tabel_223_temp a, $DBUser.tabel_200_temp x, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan=x.prefixpertanggungan and a.nopertanggungan=x.nopertanggungan ".
			 "and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+) ".
			 "order by decode(a.kdjenisbenefit,'U',1,'R',2,'W',3,'I',99,'T',100,4) ";
}

//echo $sql."<br><br>";
	$DB->parse($sql);
  $DB->execute();
  $result = $DB->result();

/*********************************************************************************************************/
/*    LANJUT    */
/* 1. Update tabel 223 transaksi produk
/*********************************************************************************************************/

if($propmtc14lanjut=="Lanjut") { //submit
  foreach ($result as $foo => $arr) {
		  $kdproduk  = $arr["KDPRODUK"];
		  $kdbenefit = $arr["KDBENEFIT"];
			$premi = ${"prm".$kdbenefit};			if (strlen($premi)==0) $premi="null";
			$benefit = ${"bnf".$kdbenefit};   if (strlen($benefit)==0) $benefit="null";
			$expirasi = ${"exp".$kdbenefit};  if (strlen($expirasi)==0) $expirasi="null";
			//echo $benefit;
			//echo $kdbenefit.$expirasi;
			//$lamapembayaran = ${"rms".$kdbenefit};
      // edit panjang tanggal JSP
			$akhirpembayaran = ${"akh".$kdbenefit};			
			$akhirpmb = ($akhirpembayaran==""||is_null($akhirpembayaran)||strlen($akhirpembayaran)<10) ? 'NULL' : "to_date('".$akhirpembayaran."','DD/MM/YYYY')";
			$expir = ($expirasi==""||is_null($expirasi)||strlen($expirasi)<10) ? 'NULL' : "to_date('".$expirasi."','DD/MM/YYYY')";      
			//$akhirpmb = ($akhirpembayaran==""||is_null($akhirpembayaran)) ? 'NULL' : "to_date('".$akhirpembayaran."','DD/MM/YYYY')";
			//$expir = ($expirasi==""||is_null($expirasi)) ? 'NULL' : "to_date('".$expirasi."','DD/MM/YYYY')";      
			
			if($kdbenefit=="RISKER"){ //resiko kerja rumus salah harusnya faktor resiko X faktor resiko kerja
  			if(substr($kdproduk,0,3)=="JL2")
  			{
  			}
  			else
  			{
  			$sql="update $DBUser.tabel_223_temp ".
  			     "set premi=$resikokerja, nilaibenefit=$benefit,expirasi=$expir,".
  					 "akhirpmb=$akhirpmb ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
  			}
			} 
			else 
			{
  			$sql="update $DBUser.tabel_223_temp ".
  			     "set premi=$premi, nilaibenefit=$benefit,expirasi=$expir,".
  					 "akhirpmb=$akhirpmb ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			}
			//echo $sql."<br /><br />";
			if($kdbenefit!="BNFTOPUP"){
			$DB->parse($sql);
      $DB->execute();
			}
	}    //foreach

  /***********************************output***********************************************************/

	$faktor = $FM->faktorbayar;

	switch ($premijua) {
	 case 'premi': {
		$sql = "select sum(premi) premistd ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdjenisbenefit <>'X' ";
		$DB->parse($sql);
        $DB->execute();
		$ari=$DB->nextrow();

        //echo $sql;

		$sqlx2 = "select sum(premi) premi2jsp ".
				   	 "from $DBUser.tabel_223_temp ".
				   	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 	 "and kdbenefit not in ('WAIVER','EXTPREM')";

		//echo 	$sqlx2;
		$DB->parse($sqlx2);
        $DB->execute();
		$arix2=$DB->nextrow();
		$premix2=$arix2["PREMI2JSP"];
		
		$sqlx3 = "select sum(premi) premi2dmp ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdjenisbenefit in ('W','U')";
		$DB->parse($sqlx3);
        $DB->execute();
		$arix3=$DB->nextrow();
		$premi2dmp=$arix3["PREMI2DMP"]; //untuk menghitung premi 2 DMP
		
		//$premistd dari hidden untuk carabayar berkala dan skg <> 1
		//echo $premistandar."|".$premistd."|harus sama";
  
	  // Khusus perlakuan JSP diupdate tgl 9 okt 2003 by agus n kd
		
		
		//Script dibawah ini dipakai untuk menghandle kondisi khusus produk JSAP1 DAN JSAP2
		//dibuat oleh agus pada tanggal : 07/06/2005
		//==================================================================================
		
	
		if($kdproduk=="JSP"){
				$premistandar=$premix2;
				echo $premix2;
		} else {
		    $premistandar=$premistandar; 
		}

	
		if ($FM->kdjeniscb=='B') { //cara bayar berkala
  			//pengeculian produk DMP, premi 2 = premistd + sadu
				if($kdproduk=="DMP"){
  				$premi2=$premi2dmp * $faktor;
  				} else {
  		    $premi2=$premistandar * $faktor;
  			}
	 	
	//	  $premi2=$premistandar * $faktor;
		}	else if ($FM->cabayar=='X' or $FM->cabayar=='E') { // CARA BAYAR E, PREMI2=0, BY MR. JUMRY PP , TGL : 14/09/2005
		  $premi2=0;
		}	else if ($FM->cabayar=='J' ){ //or $FM->cabayar=='E'				 
		 // $premi2= $premix2 * $faktor;  //$premi2=$FM->premi1; untuk cara bayar sekaligus cicilan
		 
		// $premi2=$FM->premi1;
		//untuk produk DMP premi2= 0.95 premi1, diedit tgl 07/10/2004
		 
  		 if($kdproduk=="DMP"){
			     if($medical=="N"){ //perlakuan khusus untuk produk dmp medical. tarip premi pakai yang non tapi sudah ditambah 1.05
					 		$premi2=$premi2dmp / 1.05;
			       } else {
    		      $premi2=$FM->premi1;
							$jua1 = $jua1 * 1.05; //harus dikali lagi karena tarif preminya dikali 1.05 sehingga jua juga harus dikalikan 1.05
    			   }	
							
    			} else {
    		    $premi2=$FM->premi1; 
    			}
		}
		if ($FM->masa <= 5) {
		 $premi2=0;
		}
		
		if ($FM->valuta=='3') { //valuta
		  $jua1 =   round($jua1,2);
			$premi2 = round($premi2,2);
		} else {
			$jua1 =  round($jua1,0);
			$premi2 = round($premi2,0);
			$premistd = round($premistd,0);
		}
		
	//	echo "JUA :".$jua1." | premi2 :".$premi2." premistandar  $premistd<br><br>";

    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
	  if ($jua1==0) {
     print( "	 alert('Nilai JUA Nol, Kemungkinan Belum Ada Tarifnya')\n" );
	   echo "window.opener.document.ntryprop.submit.disabled=true;";
	  }
	  printf ("window.opener.document.ntryprop.nilai.value='%s';".
					  "window.opener.document.ntryprop.premi2.value='%s';".
					  "window.opener.document.ntryprop.juamainproduk.value='%s';".
					  "window.opener.document.ntryprop.premistd.value='%s';",$premiakhir,$premi2,$jua1,$premistd);

	  print("window.close()");
    print("//-->\n" );
    print("</script>\n" );
	 } 
	 break;
	 
	 case 'jua' : {
		$sql = "select premi from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				   "and kdjenisbenefit='X' ";		 
		//echo $sqlx1;
		$DB->parse($sql);
    $DB->execute();
		$ari=$DB->nextrow();
		$extra = $ari["PREMI"];
		
		#-------------------------[ JSP START ]-----------------------------------------------
	  $sqlx1 = "select sum(premi) premi1jsp ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdbenefit <>'WAIVER2' ";
		//echo $sqlx1;
		$DB->parse($sqlx1);
    $DB->execute();
		$arix1=$DB->nextrow();
		$premix1=$arix1["PREMI1JSP"];
					 
		$sqlx2 = "select sum(premi) premi2jsp ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdjenisbenefit <>'X' and kdbenefit <>'WAIVER'";
		$DB->parse($sqlx2);
    $DB->execute();
		$arix2=$DB->nextrow();
		$premix2=$arix2["PREMI2JSP"];
		
		$sqlx3 = "select sum(premi) premi3jsp ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdjenisbenefit='U'";
		$DB->parse($sqlx3);
    $DB->execute();
		$arix3=$DB->nextrow();
		$premix3=$arix3["PREMI3JSP"];
		
		
		//-----------------------------------------------
				 
		#
		#-------------------------[ JSP END ]-----------------
		#
		// perlakuan khusus untuk produk JSP
		if($kdproduk=="JSP"){
		    $premiup=$premix2;
				$jmlpremi=$premix1;
		} else {
		    //echo $premistandar."|".$premistd;
			  $premiup= $jmlpremi-$extra;
		}
		
		
		if ($FM->kdjeniscb=='B') { //cara bayar berkala	
				$p2 = $premiup * $faktor;
				$p1 = $jmlpremi * $faktor;
		} else if ($FM->cabayar== 'X' or $FM->cabayar== 'E' ){ //CARA BAYAR E, PREMI2 =0, BY MR. JUMRY KP TGL:14/09/2005
				$p2=0;
				$p1=$jmlpremi  * $faktor;
		} else if ($FM->cabayar == 'J'){ //or $FM->cabayar== 'E'
				$p1=$jmlpremi * $faktor;
				
				//tambahan premi2 DMP, premi2=0.95 premi1
				
				//untuk produk DMP premi2= 0.95 premi1, diedit tgl 07/10/2004
		 
    		 if($kdproduk=="DMP"){
				 			//tambahan kondisi untuk DMP medical premi1 = premi2, diedit tanggall 08/02/2005
							
    							if ($medical =="M"){
    								 	$p2=$p1 /1.05 ;
    									$p1=$p2;
          				} else {
          						$p2=$p1 /1.05 ;
          				}
     				} else {
      				$p2=$premiup * $faktor;
      			}
		}
		if ($FM->masa <= 5) {
		 $p2=0;
		}
						//valuta 
						if ($FM->valuta=='3') {
							 $p1=round($p1,2);
							 $p2=round($p2,2);
						} else {
							 $p1=round($p1,0);
							 $p2=round($p2,0);
						}							 
						//desimal jika dollar
		$premi1akhir=round($p1 + $jmlresikokerja,0);
		$premi2akhir=round($p2 + $jmlresikokerja,0);	
		
		#-----[ PERHITUNGAN TAMBAHAN RESIKO PEKERJAAN ]------------------------------------------ 
    # 
		/*
		echo "premi std = ".number_format($premistd,2)."<br>";
		echo "premi 1 = ".number_format($p1,2)."<br>";
		echo "premi 2 = ".number_format($p2,2)."<br>";
		echo "resiko pekerjaan = ".number_format($jmlresikokerja,2)."<br>";
		echo "Premi 1 akhir = ".number_format($premi1akhir,2)."<br>";
		echo "Premi 2 akhir = ".number_format($premi2akhir,2)."<br>";
		*/
		
		if($kdproduk=="JSP"){ // hitung ulang komisi agen karena premi dipotong waiver
      CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistd,$p1);
    }
		
	  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
	  if ($p1 == 0) {
     print( "	 alert('Nilai Premi Nol, Periksa Lagi atau Mungkin Belum Ada Tarifnya')\n" );
	   echo "window.opener.document.ntryprop.submit.disabled=true;";
	  }
	  printf ("window.opener.document.ntryprop.premi1.value='%s';".
					  "window.opener.document.ntryprop.premi2.value='%s';".
				    "window.opener.document.ntryprop.premistd.value='%s';",$p1,$p2,$premistd,$premirider);
			
	  print( "window.close()");
    print( "//-->\n" );
    print( "</script>\n" );

	 } 	break;
	}  //switch
		
		if(substr($kdproduk,0,3)=="JL2")
 	  {
		$sql = "update $DBUser.tabel_200_temp set premistd=$premistd,premi1=$premiakhir,premilink=$premiakhir ".
				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
		$DB->parse($sql);
		$DB->execute();
		}
		
		if(substr($kdproduk,0,3)=="JL2")
 	  {
		$sql = "update $DBUser.tabel_223_temp set nilaibenefit=$benfitinvestakhir  ".
				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
					 "and kdbenefit='INVPRDJL' ";
		$DB->parse($sql);
		$DB->execute();
		}
		else
		{
		$sql = "update $DBUser.tabel_200_temp set premistd=$premistd ".
				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
		$DB->parse($sql);
		$DB->execute();
		}
		
		exit;
}	  //if
/*********************************************************************************************************************/
	$faktor = $FM->faktorbayar;
  $kdproduk=$FM->produk;
	$noagen=$FM->agen; 
 	$pt=$FM->pt;
	$jua=$FM->jua;
	$kdbasispremi=$FM->kdbasispremi;
	$cabayar=$FM->cabayar;
	$cabar=$FM->namacarabayar;	
	
	$sql="select namaproduk from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
  $DB->parse($sql);
	$DB->execute();
  $prd=$DB->nextrow();
	$namaproduk=$prd["NAMAPRODUK"];

?>

<html>
<head>
<title>Benefit Proposal Lanjutan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<?
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
	print( "function SubmitOK(){\n" );

  switch ($premijua) {
	case 'jua':
	print("window.opener.document.ntryprop.submit.disabled=false;\n" );
  break;
	case 'premi':
	 switch ($vara){
	 case '0': //ok
	  print( "		window.opener.document.ntryprop.vara.value=1;\n" );
	  print( "		window.opener.document.ntryprop.submit.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=false;\n" );
	 break;
	 case '1':
	  print( "		window.opener.document.ntryprop.vara.value=2;\n" );
	  print( "		window.opener.document.ntryprop.submit.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=true;\n" );
	 break;
	 case '2':
	  print( "		window.opener.document.ntryprop.vara.value=0;\n" );
	  print( "		window.opener.document.ntryprop.submit.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=true;\n" );
	 break;
	 }
	
  break;
	}	
	print( "}\n" );
  print( "//-->\n" );
  print( "</script>" );
?>
<script language="JavaScript">
<!-- 
function open_on_entrance(url,name)
{ 
  new_window = window.open('refresh.php','refresh', ' menubar,resizable,dependent,status,width=300,height=200,left=10,top=10')
}
// -->
</script>
</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<? getclient($DB,$noagen,$namaagen); ?>	
<font face="Verdana" size="2">
<table width="100%">
 <tr>
  <td align="right"><font face="Verdana" size="1" color="#0033CC">F1336</font></td>
 </tr>
 <tr>
  <td align="center" class="arial12blkb"><b>Benefit Produk <?echo ($noproposal==$nopertanggungan) ? "Proposal Nomor ".$prefixpertanggungan."-".$nopertanggungan : '';?></b></td>
 </tr>
</table>
<hr size="1">
<table width="100%" cellpadding="1" cellspacing="1" class="tblhead">
<tr class="tblhead1">
 <td>
 <table width="100%" cellpadding="1" cellspacing="0" class="tblhead1">
  <tr>
   <td>No. SP</td>
   <td>: <?echo $nosp. "".$nokln;?> </td>
	 <td>Agen Penutup</td>
	 <td>: <? echo $namaagen."  [".$noagen."]" ?> </td>
  </tr>
  <tr>
   <td>Kode Produk</td>
	 <td>: <? echo $kdproduk . " - ".$namaproduk; ?> </td>
   <td>Lama Pembayaran Premi</td>
	 <td>: <? echo $pt; ?> tahun secara <? echo $cabar; ?></td>
  </tr>
	<tr>
   <td>Basis Premi</td>
	 <td>: <? echo $kdbasispremi; ?> </td>
   <td>Basis Bayar</td>
	 <td>: <? echo $FM->kdbasisbayar ?> </td>
  </tr>
  </tr>
 </table>
 </td>
</tr>
</table> 
<?
	if(substr($kdproduk,0,3)=="JL2")
 	{
	$sql = "select premilink from $DBUser.tabel_200_temp where ".
				 "prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
	$DB->parse($sql);
  $DB->execute();
  $r=$DB->nextrow();
	$premilink = $r["PREMILINK"];
  }	
?>
<hr size=1>
<table width="100%" cellpadding="1" cellspacing="1" class="tblhead">
<tr class="tblisi1">
 <td>
 <table border=0 width="100%" class=tblisi>
	<tr class=hijao align=center>
	 <td>No</font>
	 <td>Kode</td>
	 <td>Nama Benefit</td>
	 <td>Jumlah Benefit</td>
	 <td>Premi</td>
	 <td>Jatuh Tempo</td>
	 <td>Jenis</td>
	</tr>
<? 
	$no = 1; 
	$jmlpremi = 0; 
	$jmlbenefit = 0;
  $i = 0;
	reset($result);
  foreach ($result as $foo => $arr) {
		$kdproduk = $arr["KDPRODUK"];
		$kdbenefit = $arr["KDBENEFIT"];
		$namabenefit = $arr["NAMABENEFIT"];
		$kdjenisbenefit = $arr["KDJENISBENEFIT"];
 	  $kdrumus = $arr["KDRUMUSPREMI"];
		$rumuspremi = GetFormula($DB,$kdrumus);
		//echo "Rumus Premi : ".$rumuspremi."<br>";
 	  $kdrumus = $arr["KDRUMUSBENEFIT"];
		$rumusbenefit = GetFormula($DB,$kdrumus);
		$kdrumus = $arr["KDRUMUSEXPIRASI"];
		$rumusexpirasi = GetFormula($DB,$kdrumus);
		$kdrumus = $arr["KDRUMUSAKHIRPMB"];
		$rumusakhirpmb = GetFormula($DB,$kdrumus);

		switch(substr($kdbenefit,0,2)){
		  case "CP": $adacp="Y"; $premi_cp=0; break;
		  default : $premi_cp=$hasilpremi;
		}

		if ($kdjenisbenefit=="R") {  //Additional benefit
			$FM->add1 = $arr["PERIODEBAYAR"];
			$FM->add2 = $arr["PERIODEBENEFIT"];
			$kdrumus = $arr["KDRUMUSEXPIRASI"];
			$rumusexpirasi = GetFormula($DB,$kdrumus);
			//echo $kdbenefit."|".$rumusexpirasi;
		}
		$hasilpremi = $arr["PREMI"];
		$hasilbenefit = $arr["NILAIBENEFIT"];
		$hasilexpirasi = $arr["EXPIRASI"];
		
		//echo $kdbenefit."| rumuspremi == ".$rumuspremi."|".$premistandar."|".$hasilpremi."|".$faktor."|".$hasilexpirasi."<br><br>";

   /*********************************************************************/ 
		if(is_null($hasilpremi)||is_null($hasilbenefit)||is_null($hasilexpirasi)) {
		  if ((strlen($rumuspremi)==0) && (strlen($rumusbenefit)==0)) {
		    $hasilpremi = 0;
		    $hasilbenefit = 0;
				$hasilexpirasi = NULL;
		  } 
			else 
			{
			  $FM->parse($rumuspremi);
		    $hasilpremi=$FM->execute($DB);
				$FM->parse($rumusbenefit);
        $hasilbenefit=$FM->execute($DB);	
				$FM->parse($rumusexpirasi);
        $hasilexpirasi=$FM->execute($DB);
				$FM->parse($rumusakhirpmb);
        $hasilakhirpmb=$FM->execute($DB);
		
				// premi standar khusus produk anyar JL2XB -- update 
				//echo "premilink = ".$premilink;
				
				if(substr($kdproduk,0,3)=="JL2"){
					 $premistandar = $premilink;
		 		}
				else
				{
					 $premistandar = ($premistandar==0||$premistandar=='') ? $hasilpremi : $premistandar;
				}
				
				if ($kdjenisbenefit=="U") {
				 $hasilpremiu = $hasilpremi;
				 global $hasilpremiu;
				}
				
				//echo $kdbenefit."| rumus premi : ".$rumuspremi."| premistd : ".$premistandar."| hasil premi : ".$hasilpremi."| faktor : ".$faktor."<br><br>";
				//echo $kdbenefit."|".$rumusexpirasi."|".$hasilexpirasi."<br><br>";
			}		
//			echo $kdbenefit."|".$rumuspremi."|".$premistandar."|".$hasilpremi."|".$faktor."<br><br>";
		}	//if
		
		if(substr($kdproduk,0,3)=="JL2"){
    		if($arr["KDJENISBENEFIT"]=="R")
    		{
    		  $premi_r += $hasilpremi; 
					//update premi rider 
					$sql = "update $DBUser.tabel_223_temp set premi='".round($hasilpremi,2)."' where ".
							 	 "kdbenefit='".$kdbenefit."' and prefixpertanggungan='$prefixpertanggungan' ".
    				 		 "and nopertanggungan='$nopertanggungan'";
    		  //echo $sql."<br />";
					$DB->parse($sql);
    			$DB->execute();
				}
    		//echo "jenisbenefit : ".$arr["KDJENISBENEFIT"]."=".$hasilpremi."<br />";
    		if($kdbenefit=="KMSTTPJL")
    		{
    		  $benefit_r = $hasilbenefit; 
    		}
    		//echo "benefit r = ".$benefit_r."<br />";
    		$pengurangpremi = $premi_r + $benefit_r;
    		//echo "pengurang = ".$pengurangpremi."<br />";
		}
    include "../../includes/belang.php";
		echo "<td class=verdana8 align=center>$no</td>\n";
		echo "<td class=verdana8>".$kdbenefit."</td>";
		echo "<td class=verdana8>".$namabenefit."</td>";

		/*  kalo 0 jangan diliatin */	
		//echo $hasilpremi." * ".$faktor;
		
    #---------[ penambahan resiko pekerjaan ------------------------------------------------ 
    if($kdbenefit=="RISKER"){
    	$sql = "select a.nosp,a.noagen,a.lamapembpremi_th,b.namaproduk,".
    			   "a.indexawal,a.notertanggung,a.juamainproduk, ".
    				 "a.kdproduk,a.kdcarabayar,a.kdstatusmedical,a.usia_th,a.lamaasuransi_th,a.kdvaluta ".
    	       "from $DBUser.tabel_200_temp a, $DBUser.tabel_202_produk b ".
    			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
    				 "and a.nopertanggungan='$nopertanggungan' and a.kdproduk=b.kdproduk";
      //echo $sql."<br><br>";
    	$DB->parse($sql);
    	$DB->execute();
      $prd=$DB->nextrow();
    	
    	$namaproduk=$prd["NAMAPRODUK"];
    	$noagen=$prd["NOAGEN"];
    	$nosp=$prd["NOSP"];
    	$kdvaluta=$prd["KDVALUTA"];
    	$pt=$prd["LAMAPEMBPREMI_TH"];
    	$medical=$prd["KDSTATUSMEDICAL"];
    	$nottg=$prd["NOTERTANGGUNG"];
    	$usia=$prd["USIA_TH"];
    	$masa=$prd["LAMAASURANSI_TH"];
    	$jua=$prd["JUAMAINPRODUK"];
    	
    	$sql = "select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
    	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
    	     	 "where tglkursberlaku<=sysdate and kdvaluta='$kdvaluta') ".
    	     	 "and kdvaluta='$kdvaluta'";	
    	$DB->parse($sql);
    	$DB->execute();
    	$res=$DB->nextrow();
    	$idx = $res["KURS"];
     
      $indexawal = ($indexawal==''||strlen($indexawal)==0) ? $idx : $indexawal;					 		
      $juadlrp=$jua*$indexawal;
      
    	$KLN=new Klien($userid,$passwd,$nottg);		
    	
    	// cari resiko pekerjaan :
    	$sql="select faktorresiko/1000 resiko ".
    			 "from $DBUser.tabel_229_resiko_produk ".
    			 "where kdproduk='$kdproduk' and kdvaluta='$kdvaluta' and usia=$usia and masa=$masa ";
    	$DB->parse($sql);
    	$DB->execute();
    	$res=$DB->nextrow();
    	$fakrnow=($res["RESIKO"]==0) ? 1 : $res["RESIKO"];
    	$rskg = $fakrnow*$juadlrp;
    	$resikokerja=$KLN->nilairesiko * $rskg;
    	/*
			echo "Resiko Saat ini : ".number_format($rskg,2)."<br>";
    	echo "Faktor Resiko Pekerjaan : ".$KLN->nilairesiko."<br>";
      echo "Penambahan Resiko : ".number_format($resikokerja,2)."<br>";
		  */
		}	
	  #-------------------------------------- end resiko kerja -----------------------------
		if($kdbenefit=="RISKER"){
		 if(substr($kdproduk,0,3)=="JL2"){
					$hasilpremi = ($arr["KDJENISBENEFIT"]=="U") ? $premilink : $hasilpremi;
					$test=$hasilpremi!=0 ? number_format($hasilpremi*$faktor,2):'';
		 }
		 else
		 {
		 $test=number_format($resikokerja,2);
		 $hasilpremi=$resikokerja;
		 }
		} 
		else 
		{
		 if(substr($kdproduk,0,3)=="JL2"){
					$hasilpremi = ($arr["KDJENISBENEFIT"]=="U") ? $premilink : $hasilpremi;
		 }
		 $test=$hasilpremi!=0 ? number_format($hasilpremi*$faktor,2):'';
		}
		
		if(substr($kdproduk,0,3)=="JL2" && $kdbenefit=="INVPRDJL")
		{
		  $benfitinvestakhir = $premilink - $pengurangpremi + $bentopupinvest;
		  $tist= number_format($benfitinvestakhir,2);
			//$tist= $tist + $bentopupinvest;
		}
		else
		{
		  $tist=$hasilbenefit!=0 ? number_format($hasilbenefit,2):'';
		}
		
		//JL2 -> tampilkan premi top up
		$premitopup = $arr["PREMI"];
		$test = ($arr["KDBENEFIT"]=="BNFTOPUP") ?  number_format($premitopup,2) : $test;
		/****
		 *  Analysis: 
		 *
		 *	If date value in the form '01-AUG-05', the following line will fail
		 *  the date representation must uniform in 'DD/MM/YYYY' format
		 *  
		 * (I'm not sure, it's need confirmation!)
		 *
		 *  --- Udi --- Aug, 24th, 2005
		 ****/
		$tast=(strlen($hasilexpirasi)==10) ? $hasilexpirasi : '';
		
		echo "<td align=right class=verdana8>".$tist." ";
		echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hasilbenefit."></td>";
		echo "   <input type=\"hidden\" name=exp".$kdbenefit." value=".$hasilexpirasi.">";
		echo "<td align=\"right\" class=verdana8>".$test." ";
		echo "   <input type=\"hidden\" name=prm".$kdbenefit." value=".$hasilpremi.">";
		echo "   <input type=\"hidden\" name=akh".$kdbenefit." value=".$hasilakhirpmb.">";
		echo "</td>";
		echo "<td align=center class=verdana8blk>".$tast." </td>";
		echo "<td align=center class=verdana8>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "</tr>";
		
		if(substr($kdproduk,0,3)=="JL2"){
					$hasilpremi = ($arr["KDJENISBENEFIT"]=="U") ? $hasilpremi : 0;
		}
		
		$jmlpremi = $jmlpremi + ($arr["KDJENISBENEFIT"]=="S" ? 0 : $hasilpremi); 
		
		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		
		$jmlpremi_cp+=$premi_cp;
		
		$no ++;
		$i++;
		
	} //foreach
	
	         if ($cabayar=='X' or $cabayar=='E' or $cabayar=='J') {
					 		CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$jmlpremi*$faktor);
					 } else {
					    if(substr($kdproduk,0,3)=="JL2"){
							CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$jmlpremi*$faktor);
							//echo "compcommdisini: premistandar = $premistandar; hasilpremiu = $hasilpremiu; jmlpremi=$jmlpremi";
							}
							else
							{
				      CompComm($DB,$prefixpertanggungan,$nopertanggungan,$hasilpremiu,$jmlpremi*$faktor);
							}
					 }
					 
					 if(substr($kdproduk,0,3)=="JL2"){
  					 $sql = "select sum(premi) as premirider ".
                      "from $DBUser.tabel_223_temp where substr(kdproduk,1,3)='JL2' and kdjenisbenefit='R' ".
                      "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  					 //echo $sql;
						 $DB->parse($sql);
          	 $DB->execute();
          	 $pres=$DB->nextrow();
						 //echo $pres["PREMIRIDER"];
  					 $premirider =  $pres["PREMIRIDER"] * (1.5/100);
  					 
  					 
  					 $sql = "insert into $DBUser.tabel_404_temp ".
            					 "(PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,KOMISIAGEN,".
            					 "KDKOMISIAGEN,NOAGEN,THNKOMISI,KOMISIAGENCB) ".
              		   "values ('$prefixpertanggungan','$nopertanggungan',$premirider,".
  									 		"'24','$noagen','1',$premirider) ";
             //echo $sql;
						 $DB->parse($sql);
             $DB->execute();
             $DB->commit;
					 }
				 
    $sql = "delete from $DBUser.tabel_247_temp ".
    		   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal' ";
    $DB->parse($sql);
    $DB->execute();
    $DB->commit;
    
    $sql = "insert into $DBUser.tabel_247_temp(prefixpertanggungan,nopertanggungan,".
    		   "kdbasispremi,kdbasistebus,kdbasisskg,kdbasiscwa,kdbasisbayar) values ".
    			 "('$prefixpertanggungan','$nopertanggungan',".
    			 "'".$FM->kdbasispremi."','".$FM->kdbasistebus."','".$FM->kdbasisskg."".
    			 "','".$FM->kdbasiscwa."','".$FM->kdbasisbayar."')";			
    //echo $sql;
    $DB->parse($sql);
    $DB->execute();
    $DB->commit;

?>
	<tr class=tblhead>
	<td colspan="4" align=left>Premi Yang Harus Dibayar Secara <? echo $cabar; ?></td>
	<td align=right><? echo number_format($jmlpremi*$faktor,2);	?></td>
	<td colspan=2></td>
	</tr>
	<tr class="tblisi1">
	<td colspan="4" align=left>Premi Standar Tahunan</td>
	<td align=right><? echo number_format($premistandar,2); ?></td>
	<td colspan=2></td>
	</tr>
	</table>
	
</td>
</tr>
</table>

<hr size=1>
<?php 
// cek JUA dan Premi minimal
    	$sql = "select a.kdvaluta,TO_CHAR(a.tglsp,'DD/MM/YYYY') as tglsp ".
    	       "from $DBUser.tabel_200_temp a ".
    			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
    				 "and a.nopertanggungan='$nopertanggungan'";
					//echo $sql;	 
    	$DB->parse($sql);
    	$DB->execute();
      $val=$DB->nextrow();
    	$kdvaluta=$val["KDVALUTA"];
			$tglsp	 =$val["TGLSP"];
			
    	$sql = "select kurs from $DBUser.tabel_999_kurs_transaksi where tglkursberlaku=".
    	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi ".
    	     	 "where tglkursberlaku<=sysdate and kdvaluta='$kdvaluta') ".
    	     	 "and kdvaluta='$kdvaluta'";	
			//			 echo $sql;
    	$DB->parse($sql);
    	$DB->execute();
    	$res=$DB->nextrow();
    	$idx = $res["KURS"];
$juarp=$jua*$idx;
$premirp=$jmlpremi*$faktor*$idx;
$jmlpremi_cp_rp = $jmlpremi_cp*$faktor*$idx;

//echo "Cash Plan : ".$adacp." Premi RP = ".$premirp." Hasil Premi : ".$jmlpremi_cp_rp." cara bayar : -".$FM->cabayar."-";

if($adacp=="Y")
{
  if(($FM->cabayar==1) || ($FM->cabayar==2) || ($FM->cabayar==3))
	{ 
    echo "CP hanya boleh dengan cara bayar Tahunan atau Sekaligus<br><br>";
  	echo "<a href=javascript:window.close()>CLOSE</a>";
  	die;
	} 
}


/* --- awal penguncian --*/

// ditutup sementara atas permintaan pak mul sampai tgl 10 Feb 2007
/* di non-aktifkan by Ari Faizal tgl 19/04/2007 karena JSSPO123 telah ditutup dan digantikan JSSPO456

if(substr($kdproduk,0,5)=="JSSPO")
{
   
	 $tgl = substr($tglsp,0,2);
	 $bln = substr($tglsp,3,2);
	 $thn = substr($tglsp,-4);
	 
	 //echo "lamapremi = ".$pt." ".$tglsp." bln : ".$bln;
	 
	 if(($pt==5 && $bln > 2) || ($pt==5 && $thn > 2007))
	 {
	    echo "Proposal Tidak bisa dilanjutkan. Produk ini ditutup sejak 10 Pebruari 2007";
		  die;
	 }
	 elseif(($pt==4 && $bln > 4) || ($pt==4 && $thn > 2007))
	 {
	    echo "Proposal Tidak bisa dilanjutkan. Produk ini ditutup  9 April 2007";
		  die;
	 }
	 else
	 {
	    //echo $bln.$thn;
	 }
	 
	 $tgl = substr($tglsp,0,2);
	 if($tgl > 10 && $pt==5)
	 {
	    echo "Proposal Tidak bisa dilanjutkan. Produk ini ditutup sejak 10 Pebruari 2007";
		  die;
	 }
	 elseif($tgl >= 10 && $bln >= 4 && $pt==4)
	 {
	   //echo "salah";
		 echo "Proposal Tidak bisa dilanjutkan. Produk ini ditutup mulai tanggal 10 April 2007";
		 die;
	 }
	 else
	 {
	 
	 }

	 /*
	 // add by kadek tgl 01 feb 2007 permintaan ari untuk membatasi kelebihan cadangan premi produk JSSPO
			 $premicadangan 			= 100000000000;
			 //$premicadangan 		= 150000000;
			 $premijsspohitungan = $jmlpremi;
			
			 $sql = "select sum(premi1) as totalpremimasuk ".
              "from $DBUser.tabel_200_pertanggungan ".
							"where kdproduk like 'JSSPO%' and  kdstatusfile='1' and  kdpertanggungan='2' ".
              "and lamaasuransi_th='".$pt."' group by lamaasuransi_th";
			 $DB->parse($sql);
    	 $DB->execute();
    	 $res=$DB->nextrow();
    	 $premicurrent      = $res["TOTALPREMIMASUK"];	
			 $totpremisementara = $premicurrent+$premijsspohitungan;
			 //echo "<br />Premi exist : ".$premicurrent." + ".$premijsspohitungan." = ".$totpremisementara;		
		   if($totpremisementara > $premicadangan)
			 {
			   echo "<font color=red>Proses proposal tidak dapat dilanjutkan, premi melebihi ketentuan. Silakan hubungi bagian Marketing Head Office</font><br /></br />";
			   echo "<a href=javascript:window.close()>CLOSE</a>";
				 die;
			 }
			 else
			 {
			   $msg = "";
			 }
			*/
//}

	
if($premijua=="jua"){
  if($premirp >= 100000 || substr($kdproduk,0,2)=="PA") {

		if(substr($kdproduk,0,5)=="JSSPO")
		{
		     /*
               Script ini di komentari oleh udi pada tgl 15 januari 2007
               untuk mengakomodasi pemilihan produk JSSPO dengan benefit Cash Plan
               sebab premi Cash Plan bukan kelipatan 500000

		      $batas = 500000;
			  $filterpremi = $premirp%$batas;
			  if($filterpremi==0)
				{}
				else
				{
				 echo "Premi hitung sebesar Rp. ".number_format($premirp,2,",",".").". Premi produk $kdproduk harus kelipatan Rp. 500.000,- sebaiknya Anda entry Premi saja<br /><br />";
				 echo "<a href=javascript:window.close()>CLOSE</a>";
    		 die;
				}
        */
				
			 
		}
		else
		{
		  //selain JSSPO
		}

		
	} else {
		echo "Premi hitung kurang dari syarat minimal (Rp. 100.000,-), proses tidak dapat dilanjutkan<br>".
				 "Tingkatkan JUA sampai premi mecapai syarat minimal! <br><br>";
		echo "<a href=javascript:window.close()>CLOSE</a>";
		die;
	}
	
	if(substr($kdproduk,0,4)=="JSAP")
	{
	  	if($adacp=="Y" && $jmlpremi_cp_rp < 3000000 && ($cabayar=="Y" || $cabayar=="4") )
    	{
    	  echo "Cara Bayar = Tahunan. Premi hitung kurang dari syarat minimal (Rp. 3.000.000,-) untuk tambahan CP, proses tidak dapat dilanjutkan<br>".
    				 "Tingkatkan JUA sampai premi mecapai syarat minimal! <br><br>";
    		echo "<a href=javascript:window.close()>CLOSE</a>";
    		die;
    	}
    	
    	if($adacp=="Y" && $jmlpremi_cp_rp < 40000000 && $cabayar=="X")
    	{
    	  echo "Cara Bayar = Sekaligus. Premi hitung kurang dari syarat minimal (Rp. 40.000.000,-) untuk tambahan CP, proses tidak dapat dilanjutkan<br>".
    				 "Tingkatkan JUA sampai premi mecapai syarat minimal! <br><br>";
    		echo "<a href=javascript:window.close()>CLOSE</a>";
    		die;
    	}
	
	}
	else
	{
      
			if($kdproduk=="JSSPO4" || $kdproduk=="JSSPO5" || $kdproduk=="JSSPO6")
			{
			  $sql = "select count(nopertanggungan) as jlmpolis, sum(premi1) as jmlpremi
                from $DBUser.tabel_200_pertanggungan where substr(kdproduk,1,5)='JSSPO'
                and kdstatusfile='1'";
								
								// and lamaasuransi_th='4'";
								
				$DB->parse($sql);
      	$DB->execute();
        $row = $DB->nextrow();
      	
				$currentpremi = $row["JMLPREMI"];				
				$maxallow 		= 380000000000;
				$premitemp 		= $currentpremi+$jmlpremi;
				
				echo "<table>";
				echo "<tr><td>#masakontrak</td><td> = </td><td>".$pt."</td></tr>";
				echo "<tr><td>#maxallow</td><td> = </td><td align=right>".number_format($maxallow,2,',','.')."</td></tr>" ;
				echo "<tr><td>#premihitungan</td><td> = </td><td align=right>".number_format($jmlpremi,2,',','.')."</td></tr>";
				echo "<tr><td>#currentpremi</td><td> = </td><td align=right>".number_format($currentpremi,2,',','.')."</td></tr>";
				echo "<tr><td>#premitemp</td><td> = </td><td align=right>".number_format($premitemp,2,',','.')."</td></tr>";
				echo "<tr><td>#sisapremiallow</td><td> = </td><td align=right>".number_format($maxallow-$premitemp,2,',','.')."</td></tr>";
				echo "</table>";
				
				// dibuka sementara tgl 21 agustus 2007 atas permintaan ari dan p mul
				//echo "kantor : ".$kantor;
//				if(($kantor=="EF" || $kantor=="ID") && date('d')<30)
				if(($kantor=="EI" || $kantor=="EC") && date('d')<7)
				{
//				 				echo "<h3><font color=#de8016>Kantor $kantor hanya bisa memproses JSSPO* sampai tanggal 29 April 2008</font></h3>";			 
				 				echo "<h3><font color=#de8016>Kantor $kantor hanya bisa memproses JSSPO* sampai tanggal 6 Mei 2008</font></h3>";			 
				}
				else
				{
    				if($premitemp > $maxallow)// && $pt==4)
    				{
        				echo "<h3>Proposal tidak boleh dilanjutkan</h3>Premi produk JSSPO melebihi batas yang diperbolehkan. Silakan hubungi kantor pusat";
        				echo "<br /><br /><a href=javascript:window.close()>CLOSE</a>";
        				die;
    				}
    				else
    				{}
				}
								
			}
				
			/*
            Script ini dikomenentari oleh Udi untuk mem bypass batasan minimal
            premi cash plan

	  	if($adacp=="Y" && $jmlpremi_cp_rp < 2500000 && ($cabayar=="Y" || $cabayar=="4") )
    	{
    	  echo "Cara Bayar = Tahunan. Premi hitung kurang dari syarat minimal (Rp. 2.500.000,-) untuk tambahan CP, proses tidak dapat dilanjutkan<br>".
    				 "Tingkatkan JUA sampai premi mecapai syarat minimal! <br><br>";
    		echo "<a href=javascript:window.close()>CLOSE</a>";
    		die;
    	}

    	if($adacp=="Y" && $jmlpremi_cp_rp < 20000000 && $cabayar=="X")
    	{
    	  echo "Cara Bayar = Sekaligus. Premi hitung kurang dari syarat minimal (Rp. 20.000.000,-) untuk tambahan CP, proses tidak dapat dilanjutkan<br>".
    				 "Tingkatkan JUA sampai premi mecapai syarat minimal! <br><br>";
    		echo "<a href=javascript:window.close()>CLOSE</a>";
    		die;
    	}

        */

	}
}

//echo $jmlpremi_cp_rp." | ".$cabayar." | ".$jmlpremi_cp." | ".$faktor." | ".$idx." | ".$cabayar." | ".$adacp;
// tambahan benefit TOP UP khusus untuk produk JL2 berkala
if(substr($kdproduk,0,3)=="JL2" && ($cabayar!="X" || $cabayar!="E" || $cabayar!= "J"))
{
?>
Premi Top UP 
<? 
if($premitopup==""){
$minimaltopupberkala = $premistandar * 0.3;
?>
<input type="text" name="premitopup" value="<?=$minimaltopupberkala;?>" size="20">
<input type="submit" name="addtopup" value="TAMBAH TOP UP" />
<? 
} else {
?>
<input type="text" name="premitopup" value="<?=$premitopup;?>" size="20">
<input type="submit" name="updatetopup" value="UPDATE" />
<input type="submit" name="deletetopup" value="DELETE" />
<? 
}
?>
<input type="hidden" name="minpremitopup" value="<?=$minimaltopupberkala;?>" />
<input type="hidden" name="premiakhir" value="<?=$premistandar+$premitopup;?>" />
<input type="hidden" name="benfitinvestakhir" value="<?=$benfitinvestakhir;?>" />

<hr size="1">
<?
}

if ($juarp >= $juaminimal || $juaminimal==""){
?>
<table width="100%">
<tr>
  <td class="arial10"><a href="benefit.php?state=0&premijua=<?echo $premijua;?>&noproposal=<?echo $noproposal;?>&nopertanggungan=<?echo $nopertanggungan;?>&prefixpertanggungan=<?echo $prefixpertanggungan;?>&kdper=<?echo $kdper;?>&vara=<?echo $vara;?>&kdproduk=<?echo $kdproduk;?>">Back</a></td>
	<td align="right">
	  <input type="hidden" name="mode" value="insert">
	  <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
	  <input type="hidden" name="premistd" value="<? echo $premistandar; ?>">
	  <input type="hidden" name="jmlpremi" value="<? echo $jmlpremi; ?>">
	  <input type="hidden" name="jmlbenefit" value="<? echo $jmlbenefit; ?>">
		<input type="hidden" name="resikokerja" value="<? echo $resikokerja; ?>">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"Nilai Tebus\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s','popuptebus',400,500,1);\">",$jua,$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"Komisi\" onclick=\"NewWindow('popupkom.php?cabayar=%s&prefixpertanggungan=%s&nopertanggungan=%s&noproposal=%s&noagen=%s&premi1=%s','popupkomisi',500,350,1);\">",$cabayar,$prefixpertanggungan,$nopertanggungan,$noproposal,$noagen,$jmlpremi); ?>
    <input type="submit" name="propmtc14lanjut" value="Lanjut"  onclick="javascript:SubmitOK();">
	</td>
</tr> 
</table>
<?

} else {
  echo "Jua hitung sebesar Rp. ".number_format($juarp,2)." kurang dari Jua minimal yang disyaratkan sebesar Rp.".number_format($juaminimal,2)."<br>";
	echo "<a href=javascript:window.close()>CLOSE</a>";
} ;

?>

</form>
</body>
</html>
