<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  include "../../includes/formula44.php";
  include "../../includes/klien.php";
	
	$DB=New database($userid, $passwd, $DBName);
	$DB1=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	$FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);

	//echo $prefixpertanggungan."-".$nopertanggungan;
	function getclient($db,$noklien,&$nama) {
	  $sql="select namaklien1,to_char(tgllahir,'DD/MM/YYYY') tgllahir,jeniskelamin ".
		     "from $DBUser.tabel_100_klien ".
				 "where noklien='$noklien'";
    $db->parse($sql);
	  $db->execute();
	  $res=$db->nextrow();
	  $nama = $res["NAMAKLIEN1"];
	}

	function GetFormula($DBX,$kdrumus) {
	  $sql="select rumus from $DBUser.tabel_224_rumus ".
		     "where kdrumus='$kdrumus'";
	  if($kdrumus=="JCPM300PRM"){
		//echo $sql;
		//die;
	}
	//echo $sql."<br><br>";
	//die;
   	$DBX->parse($sql);
    $DBX->execute();
    $arr=$DBX->nextrow();
		$rumus=$arr["RUMUS"];
		return $rumus;
	}
/************************************************************************************************/

	/* update jua dan premi dari spajol by fendy 17/08/2021 */
	$sql = "SELECT premi, uangasuransi, b.kdproduk
			FROM $DBUser.tabel_spaj_online_produksi a
			INNER JOIN $DBUser.tabel_200_temp b ON a.nospaj = b.nosp
			WHERE b.prefixpertanggungan = '$prefixpertanggungan'
				AND b.nopertanggungan = '$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	$smbr = $DB->nextrow();
	
	/*$sql = "UPDATE $DBUser.tabel_200_temp SET juamainproduk = '$smbr[UANGASURANSI]', premi1 = '$smbr[PREMI]'
			WHERE prefixpertanggungan = '$prefixpertanggungan'
				AND nopertanggungan = '$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();*/
	/* akhir update jua dan premi dari spajol by fendy 17/08/2021 */

	$sql = "select a.nosp,a.noagen,a.lamapembpremi_th,b.namaproduk,to_char(a.mulas,'DD/MM/YYYY') as tglmulas,premi1,".
			   "a.indexawal,a.notertanggung,a.juamainproduk, ".
				 "a.kdproduk,a.kdcarabayar,a.kdstatusmedical,a.usia_th,a.lamaasuransi_th,a.kdvaluta, a.nopolswitch ".
	       "from $DBUser.tabel_200_temp a, $DBUser.tabel_202_produk b ".
			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
				 "and a.nopertanggungan='$nopertanggungan' and a.kdproduk=b.kdproduk";
 // echo $sql."<br><br>";
  //die;
	$DB->parse($sql);
	$DB->execute();
  $prd=$DB->nextrow();
	//var_dump($prd);
	$kdproduk=$prd["KDPRODUK"];
	$kdcarabayar=$prd["KDCARABAYAR"];
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
	$tglmulas=$prd["TGLMULAS"];
	$polswitch=$prd["NOPOLSWITCH"];
	$premisatu=$prd["PREMI1"];
	
	
	
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
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$fakrnow=($res["RESIKO"]==0) ? 1 : $res["RESIKO"];
	
	$rskg = $fakrnow*$juadlrp;
	//echo "Resiko Saat ini : ".$rskg."<br>";
	//echo "Faktor Resiko Pekerjaan : ".$KLN->nilairesiko."<br>";
	//echo "Penambahan Resiko : ".($KLN->nilairesiko * $rskg)."<br>";


	
/*******************************************************run once*******************************/
if ($state) { //perubahan produk hapus isi 223temp kecuali 'R'
	$sql="begin $DBUser.delbnft('$prefixpertanggungan','$nopertanggungan'); end;";
	//echo $sql;
	$DB->parse($sql);
 	$DB->execute();
 	$DB->commit();
	
	if ($FM->medstat=='M' or $FM->cabayar=='X') { // or $FM->cabayar=='E'					
		$sql="begin	$DBUser.insbnftnxtra('$prefixpertanggungan','$nopertanggungan','$kdproduk');end;";		
	} else {
		$sql="begin	$DBUser.insbnft('$prefixpertanggungan','$nopertanggungan','$kdproduk');end;";			
	}	
	//echo $sql;
  $DB->parse($sql);
  $DB->execute();
  $DB->commit();
	
	//khusus produk switching
	if(substr($kdproduk,0,5)=="JL2XS" || substr($kdproduk,0,5)=="JL3XS")
	{
	  $sql = "delete $DBUser.tabel_223_temp where kdjenisbenefit IN ('R','D')";
		$DB->parse($sql);
    $DB->execute();
    $DB->commit();
	  //echo "kdproduk = ".$kdproduk;
		$sql = "insert into $DBUser.tabel_223_temp ".
				 	 		"(prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,kdcbanuitas,expirasi) ".
  			 	 		"select '$prefixpertanggungan','$nopertanggungan',kdproduk,kdbenefit,periodebayar,lamaperiode,kdjenisbenefit,kdcbanuitas,null ".
						//"(select TGLAKHIRPREMI from $DBUser.tabel_200_PERTANGGUNGAN where PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN='$polswitch') ".
  						"from $DBUser.tabel_206_produk_benefit ".
  				 "where kdproduk='".$kdproduk."' and kdbenefit IN ('BNFCRIL','JMNKEC')";
		//echo $sql;
		$DB->parse($sql);
    $DB->execute();
    $DB->commit();
	}
	
/*******************************************************run many******************************************/
} 
else 
{
	$state=0;
	//echo "tess";
	if($propmtc12insert=="Insert") { //insert additional produk
	    if (strlen($periodebayar)==0) $periodebayar="null";
	    if (strlen($periodebenefit)==0) $periodebenefit="null";

        /********************************
		     * The following lines of code updated by Udi at Aug, 23rd, 2006
         *
         * There are new Cash Plan Rider Setup applied to almost all product
         * Separate the three model of Cash Plan since it used for different purpose
         *****/
        if($kdbenefit=="CP1" || $kdbenefit=="CP2" || $kdbenefit=="CP3" || $kdbenefit=="CP4" || $kdbenefit=="CP5") {
        		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
        		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
        						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU','$kdbenefit'||'BDH')";
        } elseif ($kdbenefit=="CP200" || $kdbenefit=="CP300" || $kdbenefit=="CP400" || $kdbenefit=="CP500" || $kdbenefit=="CP600") {
        		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
        		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
        						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU')";
        //Client choose CashPlan with Surgery (Bedah)
        } 
		elseif ($kdbenefit=="JSHCPS100" || $kdbenefit=="JSHCPS200" || $kdbenefit=="JSHCPS300" || $kdbenefit=="JSHCPS400" || $kdbenefit=="JSHCPS500" ) {
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'R','$kdbenefit'||'I')";
		}
		elseif ($kdbenefit=="CP200B" || $kdbenefit=="CP300B" || $kdbenefit=="CP400B" || $kdbenefit=="CP500B" || $kdbenefit=="CP600B") {
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU','$kdbenefit'||'BDH')";
        // New Cash Plan Murni dan Bedah per 18/08/2009
		} elseif ($kdbenefit=="CPM100" || $kdbenefit=="CPM200" || $kdbenefit=="CPM300" || $kdbenefit=="CPM400" || $kdbenefit=="CPM500") {
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU')";
							 //echo $sql;
        } elseif ($kdbenefit=="CPB1000" || $kdbenefit=="CPB2000" || $kdbenefit=="CPB3000" || $kdbenefit=="CPB4000" || $kdbenefit=="CPB5000") {
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('CPM".substr($kdbenefit,3,3)."'||'RWI','CPM".substr($kdbenefit,3,3)."'||'ICU','$kdbenefit'||'BDH')";
      	} else 
      	{
        		/*----------------------------------------------------------------------
        		ditambahkan oleh agus, tanggal : 26/04/2005
        		pencarian faktor benefit ini dipakai untuk menambahkan benefit waiver produk JSAP,
        		----------------------------------------------------------------------*/

        		$sqlxx ="select faktorbenefit from $DBUser.tabel_207_kode_benefit ".
        		  		 	"where kdbenefit='$kdbenefit' ";
        		
        		$DB->parse($sqlxx);
        		$DB->execute();
        		$res=$DB->nextrow();
        		$faktorbnf= $res["FAKTORBENEFIT"];
        				
        		if($faktorbnf=="A") {
						/*
						untuk waiver anak , jika dia belum membeli waiver tertanggung, maka yang dia masukan hanyalah
						benefit bebas preminya sendiri diikuti oleh waiver-waiver  yang lain, walaupun dia sudah beli rider nya. 
						*/
						$sqlyy ="select to_char(count(1)) cek from $DBUser.tabel_223_temp a,  ".
        		  		 	"$DBUser.tabel_207_kode_benefit b ".
										"where a.kdbenefit = b.kdbenefit ". 
										"and b.faktorbenefit ='W' ".
										"and a.prefixpertanggungan ='$prefixpertanggungan' ".
										"and a.nopertanggungan ='$nopertanggungan' ";
        		
        		$DB->parse($sqlyy);
        		$DB->execute();
        		$res=$DB->nextrow();
        		$cek= $res["CEK"];
						
						//Agus, 03/06/2005 --untuk sementara tidak perlu ada cek, bebas memilih apakah 
						//waiver anak mau dibeli dulu atau tidak...
												
						//if ($cek =="0"){ //tidak ada benefit waiver untuk ayahnya...
    				//			 $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
            //		   		 "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','$kdbenefit',$periodebayar,$periodebenefit,'R')";	 	
						//} else {
       						$sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
              		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',a.kdbenefit,null,null,a.kdjenisbenefit ". 
      										 "from $DBUser.tabel_207_kode_benefit a,  ".
      										 "		 $DBUser.tabel_223_temp b  ".	 
              						 "where 'A'||b.kdbenefit = a.kdbenefit  ".
      										 "AND b.prefixpertanggungan= '$prefixpertanggungan'  ".
      										 "AND b.nopertanggungan ='$nopertanggungan' ".
      										 "AND a.faktorbenefit IN ('X','A')  ".
      										 "UNION ".
      										 "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
              						 "where faktorbenefit ='A' ";
							//			}
						} else if ($faktorbnf=="W") {
						$sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
        		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',a.kdbenefit,null,null,a.kdjenisbenefit ". 
										 "from $DBUser.tabel_207_kode_benefit a,  ".
										 "		 $DBUser.tabel_223_temp b  ".	 
        						 "where 'W'||b.kdbenefit = a.kdbenefit  ".
										 "AND b.prefixpertanggungan= '$prefixpertanggungan'  ".
										 "AND b.nopertanggungan ='$nopertanggungan' ".
										 "AND a.faktorbenefit IN ('X')  ".
										  "UNION ".
										 "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit from $DBUser.tabel_207_kode_benefit ".
        						 "where faktorbenefit ='W' ";
										 
						} else {
						
						//============
						$sql = "select a.nosp,a.noagen,a.lamapembpremi_th,b.namaproduk,to_char(a.mulas,'DD/MM/YYYY') as tglmulas,".
								   "a.indexawal,a.notertanggung,a.juamainproduk, a.premistd, ".
									 "a.kdproduk,a.kdcarabayar,a.kdstatusmedical,a.usia_th,a.lamaasuransi_th,a.kdvaluta,premi1, a.nopemegangpolis ". //,notertanggung2 ".
							   "from $DBUser.tabel_200_temp a, $DBUser.tabel_202_produk b ".
								   "where a.prefixpertanggungan='$prefixpertanggungan' ".
									 "and a.nopertanggungan='$nopertanggungan' and a.kdproduk=b.kdproduk";
					  //echo $sql."<br><br>";
					 
						$DB->parse($sql);
						$DB->execute();
					  $prd=$DB->nextrow();
						 
						$kdproduk=$prd["KDPRODUK"];
						$kdcarabayar=$prd["KDCARABAYAR"];
						$namaproduk=$prd["NAMAPRODUK"];
						$noagen=$prd["NOAGEN"];
						$nosp=$prd["NOSP"];
						$kdvaluta=$prd["KDVALUTA"];
						$pt=$prd["LAMAPEMBPREMI_TH"];
						$medical=$prd["KDSTATUSMEDICAL"];
						$nottg=$prd["NOTERTANGGUNG"];
						//$nottg2=$prd["NOTERTANGGUNG2"];
						$nottg2=$prd["NOPEMEGANGPOLIS"];
						$usia=$prd["USIA_TH"];
						$masa=$prd["LAMAASURANSI_TH"];
						$jua=$prd["JUAMAINPRODUK"];
						$tglmulas=$prd["TGLMULAS"];
						$premi1=$prd["PREMI1"];	
						$premistd=$prd["PREMISTD"];
						
						
						switch($kdcarabayar){
							case 'M':
								$varcb=12;
								$faktorcb=12;
								break;
							case 'Q':
								$varcb=4;
								$faktorcb=4;
								//$faktorcb=12;
								break;
							case 'H':
								$varcb=2;
								$faktorcb=2;
								//$faktorcb=12;
								break;
							case 'A':
								$varcb=1;
								$faktorcb=1;
								//$faktorcb=12;
								break;
							case 'X':
								$varcb=1;
								$faktorcb=1;
								break;	
						}
						
						switch($kdbenefit){
								case 'ADDB' :
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;									
									break;
								case 'CI53':
									$maxuarider=$nilaiua*1;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									break;
								case 'TI':
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									break;
								case 'TPD':
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									break;
								case 'PBD':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=$premi1*$faktorcb;
									
									//echo $vbenefit;
									break;
								case 'PBTPD':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=$premi1*$faktorcb;
									
									break;
								case 'WAIVER':
									//$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=$premi1*$faktorcb;
									
									break;
								case 'SPBDX':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=($premi1*$faktorcb);
									$vbenefit=$premi1;
									//$vbenefit=$premistd*$faktorcb;
									break;
								case 'SPTPDX':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=$premi1*$faktorcb;
									$vbenefit=$premi1;
									//$vbenefit=$premistd*$faktorcb;
									break;
							}
							echo $kdcarabayar.'</br>'.$kdbenefit.'</br>'.$vbenefit;
							//die;
						//============
        		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit, nilaibenefit, tglmutasi) ".
        		   		   "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','$kdbenefit',$periodebayar,$periodebenefit,'R','$vbenefit', to_date('$tglmulas','DD/MM/YYYY'))";
        		}
		}
		//echo $sqlyy."<br /><br />" ;		
		//echo $sql;
		
    $DB->parse($sql);
		$DB->execute();
  	$DB->commit();
		
  } else if($del=="X") {
	    $sql = "delete from  $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' ".
		 			 	 "and nopertanggungan='$nopertanggungan' and kdjenisbenefit='R' and kdbenefit='$kdbnfx'";
  		//echo $sql."<br>";
      $DB->parse($sql);
  		$DB->execute();
  		// hapus juga kalo update
			$sql = "delete from  $DBUser.tabel_223_transaksi_produk where prefixpertanggungan='$prefixpertanggungan' ".
		 			   "and nopertanggungan='$nopertanggungan' and kdjenisbenefit='R' and kdbenefit='$kdbnfx'";
  		$DB->parse($sql);
			
  	  $DB->commit();	
	} else if($propmtc12lanjut=="Lanjut") {
		/*-------------------------------------------------------premia atawa jua-------------------------------------------------- */
  	//============================================================================
  	//Ambil jumlah premi rider untuk mencari nilai premi waiver
  	//ditambahkan oleh agus , tanggal : 04 Agustus 2005
  	
  	$sqlrdr = "select b.kdrumuspremi, b.kdbenefit  ". 
  						"from 	$DBUser.tabel_223_temp a, ".
  						"				$DBUser.tabel_206_produk_benefit b, ".
  						"				$DBUser.tabel_207_kode_benefit c  ".
  						"where 	a.kdproduk=b.kdproduk ".
  						"and    a.kdbenefit=b.kdbenefit ".
  						"and   	c.faktorbenefit='1' ".
  						"and  	c.kdjenisbenefit='R' ".
  						"and    a.kdbenefit = c.kdbenefit ".
  						"and 		a.kdjenisbenefit='R' ".
  						"and 		a.prefixpertanggungan='$prefixpertanggungan' ".
  						"and 		a.nopertanggungan='$nopertanggungan' ";
  	//echo $sqlrdr;
	//die;
  	$DBA=New database($userid, $passwd, $DBName);
  	$DBA->parse($sqlrdr);
    $DBA->execute();
  	$premirider=0;
    while ($has=$DBA->nextrow()) {
  	 $koderumusrdr=$has["KDRUMUSPREMI"];
	   $kdbnf = $has["KDBENEFIT"];

  	 $rumuspremirider = GetFormula($DBA,$koderumusrdr);
  	 $FM1=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
  	 $FM1->parse($rumuspremirider);
  	 $hasilx = $FM1->execute($DBA);
		 
		 $premirider=$hasilx;
  if($koderumusrdr=="JCPM300PRM"){
		echo $premirider;
		//die;
		}
  	 
	 //die;
  	// echo $rumuspremistd."<br>";
  	// echo $hasil."<br>";
	
	//dikoment tanggal 15 agustus, yang diupdate adalah nilai preminya terlebih dahulu
	//untuk masing-masing rider
		
	$sql="update $DBUser.tabel_223_temp set premi =$premirider ".
			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
			 "and kdbenefit ='$kdbnf' ";

  	
		
  	$DB->parse($sql);
    $DB->execute();
  	$DB->commit();
	 
		
				
  	// $premirider+=$hasilx; 
  	}
/*
	  $sql="update $DBUser.tabel_200_temp set premirider =$premirider ".
			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
  	//echo $sql;
  	$DB->parse($sql);
    $DB->execute();
  	$DB->commit();
*/     
  	//echo $premirider;
	
	
	$sql = "SELECT * FROM $DBUser.tabel_200_temp WHERE prefixpertanggungan = '$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	$prm = $DB->nextrow();
	
  	//============================================================================
  		
		switch ($premijua) {
		  case 'jua' : {
			  header("location:benefit1.php?vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper");//asli propmtc14
			} break;
			case 'premi' : {
			  header("location:benefit2.php?vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper&$premisatu=$premisatu&premi1=$prm[PREMI1]");//asli propmtc14
			} break;
		}				
		exit;
		
	} //if insert
} // end run

  /*-----------------------------------tampilin daftar benefit--------------------------------------------------------------------*/
	$cabayar=$FM->cabayar;
	$cabar = $FM->namacarabayar; //var_dump($FM);
  /*
  if ($nopertanggungan == $noproposal) {	
    $sql="insert into $DBUser.tabel_223_temp select * from $DBUser.tabel_223_transaksi_produk ".
  			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			 "and kdjenisbenefit='R' "; 
  			 "and nvl(periodebayar,0) <> 0";
    echo $nopertanggungan."|".$noproposal."|".$sql;
  	$DB->parse($sql);
  	$DB->execute();
  }
  */
	
	
	$jua = substr($smbr['KDPRODUK'], 0, 2) == 'PA' ? $smbr['UANGASURANSI'] : $jua;
	$sqlpremi = substr($smbr['KDPRODUK'], 0, 2) == 'PA' ? ", premi = '$smbr[PREMI]'" : "";
	

	/*===== update by fendy ubah deathma berdasarkan jua 11/10/2019 =====*/
	$sql = "UPDATE $DBUser.tabel_223_temp SET nilaibenefit = $jua 
				$sqlpremi
			WHERE prefixpertanggungan = '$prefixpertanggungan' 
				AND nopertanggungan = '$nopertanggungan'
				AND kdbenefit IN ('DEATHMA', 'DEATHKC')";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	/*===== end of update by fendy =====*/


	
	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,".
			 "b.namabenefit,a.nilaibenefit,".
			 "a.premi,a.kdjenisbenefit,to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi ".
	     "from $DBUser.tabel_223_temp a,$DBUser.tabel_207_kode_benefit b ". //watch the fuck temp
			 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
			 "and a.kdbenefit=b.kdbenefit(+) and a.kdproduk='$kdproduk' ";
			 //echo $sql;
			 //die;
  		 $DB->parse($sql);
			 $DB->execute();


?>
<html>
<head>
<title>Benefit Proposal</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<input type="hidden" name="kdproduk" value="<? echo $kdproduk; ?>">
</head>
<body onLoad="document.propbnft.propmtc12insert.disabled=true">
<form name="propbnft" method="POST" action="<?="benefit.php"?>">

<?getclient($DB,$noagen,$namaagen);?>
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
   <td>: <?echo $nosp;?> </td>
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
	 <td>: <? echo $FM->kdbasispremi ?> </td>
   <td>Basis Bayar</td>
	 <td>: <? echo $FM->kdbasisbayar ?> </td>
  </tr>  
 </table>
 </td>
</tr>
</table> 

</font>
<hr size=1>
<table width="100%" cellpadding="1" cellspacing="1" class="tblhead">
<tr class="tblisi1">
 <td>
 	<table border=0 width="100%" class=tblisi>
	<tr class=hijao align=center>
	 <td>No</td>
	 <td>Kode</td>
	 <td>Nama Benefit</td>
	 <td></td>
	 <td>Jenis</td>
	</tr>
<? 
	$i = 1;
  while ($arr=$DB->nextrow()) {
	include "../../includes/belang.php";
	 if ($arr["KDJENISBENEFIT"]=='R') {
	  print ("<input type=\"hidden\" name=\"kdbnfx\" value=\"".$arr["KDBENEFIT"]."\">\n" );
    //print( "<input type=\"hidden\" name=\"noproposal\" value=\"".$noproposal."\">\n" );
  	print( "<input type=\"hidden\" name=\"kdper\" value=\"".$kdper."\">\n" );
  	print( "<input type=\"hidden\" name=\"kdproduk\" value=\"".$arr["KDPRODUK"]."\">\n" );
  	print( "<input type=\"hidden\" name=\"mode\" value=\"insert\">\n" );
  	print( "<input type=\"hidden\" name=\"vara\" value=\"".$vara."\">\n" );
  	print( "<input type=\"hidden\" name=\"prefixpertanggungan\" value=\"".$prefixpertanggungan."\">\n" );
  	print( "<input type=\"hidden\" name=\"nopertanggungan\" value=\"".$nopertanggungan."\">" );
		echo "<td class=verdana8 align=center><input name=del type=button value=X class=buton onclick=\"window.location.href='?del=X&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&kdbnfx=$arr[KDBENEFIT]'\"></td>";
		
	 } else {
		print  ("<td class=verdana8 align=center>$i</td>\n" );
	 }	
		print  ("<td class=verdana8>".$arr["KDBENEFIT"]."</td>\n" );
		print  ("<td class=verdana8>".$arr["NAMABENEFIT"]."</td>\n" );
		print  ("<td align=right class=verdana8>".number_format($arr["NILAIBENEFIT"], 0, ',', '.')."</td>\n" );
		print  ("<td align=center class=verdana8>".$arr["KDJENISBENEFIT"]."</td>\n" );
	  print  ("</tr>\n" );
		$i ++;
	} 
	echo "<tr>";
	echo "<td  class=verdana8>$no</td>";
	echo "<td><input type=\"hidden\" name=\"premijua\" value=$premijua>";
	echo "<input type=\"text\" name=\"kdbenefit\" size=\"10\"  class=\"a\" readonly>";
  echo "</td>";
	echo "<td>";
	echo "<input type=\"text\" name=\"namabenefit\" size=\"20\"  class=\"a\" readonly>";
  echo "</td>";
	echo "<td align=\"center\">UA <input type=\"text\" name=\"vbenefit\" size=\"5\"  class=\"a\" onfocus=highlight(event)> Faktor<input type=\"text\" name=\"periodebayar\" size=\"5\"  class=\"a\" onfocus=highlight(event)></td>";
	// untuk entry ua rider
	//echo "<td align=\"center\"><input type=\"text\" name=\"vbenefit\" size=\"5\"  class=\"a\" onfocus=highlight(event)></td>";
	printf("<td align=\"center\"><a href=\"#\" onclick=\"NewWindow('popupjam1.php?medical=%s".
				 "&nopertanggungan=%s&kdproduk=%s&kdbenefit=%s&kdvaluta=%s&kdcarabayar=%s','popupjamtambahan',600,600,1)\">".
				 "<img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari jaminan tambahan\"></a>".
				 "</td>",$medical,$nopertanggungan,$kdproduk,"%",$kdvaluta,$kdcarabayar);
	echo "</tr>";
	echo "</table>";
	
?>
</td>
</tr>
</table>

<hr size=1>
<table width="100%">
<tr>
  <td width=200>
	  <font face="verdana" size="2"><a href="javascript:window.history.back();">Back</a></font>
	</td>
	<td align="right">
	 <input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
	 <input type="hidden" name="kdper" value="<? echo $kdper; ?>">
	 <input type="hidden" name="kdproduk" value="<? echo $kdproduk; ?>">
	 <input type="hidden" name="mode" value="insert">
	 <input type="hidden" name="vara" value="<?echo $vara;?>">
	 <input type="hidden" name="prefixpertanggungan" value="<? echo $prefixpertanggungan; ?>">
	 <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
   <input type="submit" name="propmtc12insert" value="Insert">
 	 <input type="submit" name="propmtc12lanjut" value="Lanjut">
	</td> 
 </tr> 
 </table>
 
  <?
if($propmtc12insertjshc=="Insert") { //insert tertanggung JSHC

$sql="INSERT INTO $DBUser.TABEL_219_HOSPITAL_TEMP (PREFIXPERTANGGUNGAN,
                                     NOPERTANGGUNGAN,
                                     KDINSURABLE,
                                     NOTERTANGGUNG,
                                     NOKLIEN,
                                     NOURUT)
 SELECT   *
  FROM   (SELECT   '$prefixpertanggungan',
                   '$nopertanggungan',
                   kdhubungan,
                   notertanggung,
                   noklieninsurable,
                   '$nourt'
            FROM   $DBUser.tabel_113_insurable
           WHERE   notertanggung = '$nottg'
                   AND noklieninsurable = '$klienno'
          UNION
          SELECT   '$prefixpertanggungan',
                   '$nopertanggungan',
                   '04',
                   NOKLIEN,
                   NOKLIEN,
                    '$nourt'
            FROM   $DBUser.TABEL_100_KLIEN
           WHERE   NOKLIEN = '$nottg')
 WHERE   notertanggung = '$nottg' AND noklieninsurable = '$klienno'";			
			//echo $sql;
		$DB1->parse($sql);
		$DB1->execute();
} 
elseif ($propmtc12insertjshc=="X"){

	$box2=$_POST['box2']; //as a normal var
      	$box_count2=count($box2); // count how many values in array
      	if (($box_count2)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{
    				foreach ($box2 as $dear2) {
					
					$sqa = "delete from  $DBUser.TABEL_219_HOSPITAL_TEMP where prefixpertanggungan||nopertanggungan||NOTERTANGGUNG||NOKLIEN = '$dear2'";
					//echo $sqa;
					$DB->parse($sqa);
      				$DB->execute();				
        			}						
				}
				
}
 
$sql="select COUNT(*) ASKES ".
	     "from $DBUser.tabel_223_temp a,$DBUser.tabel_207_kode_benefit b ". //
			 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
			 "and a.kdbenefit=b.kdbenefit(+) and a.kdproduk='$kdproduk'  AND a.KDBENEFIT LIKE 'JSHC%' AND a.KDBENEFIT NOT LIKE 'JSHCPS%'";
			 //echo $sql;
  		$DB->parse($sql);
		$DB->execute();
		$aks=$DB->nextrow();
		if ($aks["ASKES"]>0) {
		?>
		<hr size=1>
<table width="100%" cellpadding="1" cellspacing="1" class="tblhead">
<tr class="tblisi1">
 <td>
 	<table border=0 width="100%" class=tblisi>
    <tr class=hijao align=center>
    <td colspan="4">Data Tertanggung JS Hospital Care</td>
    </tr>
	<tr class=hijao align=center>
	 <td>No Klien</td>
	 <td>Nama Tertanggung</td>
	 <td>Nama Hubungan</td>
     <td>Action</td>
	</tr>

		<?
		
	 $sql ="select b.noklien noklien, namahubungan, c.namaklien1 from $DBUser.tabel_100_klien c, $DBUser.TABEL_219_HOSPITAL_TEMP b ,$DBUser.tabel_218_kode_hubungan a where a.kdhubungan=b.kdINSURABLE and b.notertanggung='$nottg' and  prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and b.noklien=c.noklien(+) order by nourut";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=0;
	echo "<tr>";
	while($arr=$DB->nextrow()) {

	  include "../../includes/belang.php";
	    echo "<td  class=verdana8 align=center>".$arr["NOKLIEN"]."</td>";
		echo "<td class=verdana8 align=left>".$arr["NAMAKLIEN1"]."</td>";
		echo "<td class=verdana8 align=center>".$arr["NAMAHUBUNGAN"]."</td>";
		echo "<td class=verdana8 align=center>".//<input name=del type=submit value=X class=buton>
		"<input type='checkbox' name='box2[]' value=".$prefixpertanggungan.$nopertanggungan.$nottg.$arr["NOKLIEN"].">
		</td>";
		$i++;
	} 
	$x=$i+1; 
	echo "</tr>";
		
	echo "<tr>";
	echo "<td  class=verdana8 align=center><input type=\"text\" name=\"nourt\" size=\"5\"  class=\"a\" readonly value='$x'><input type=\"text\" name=\"klienno\" size=\"20\"  class=\"a\" readonly></td>";
	echo "<td>";
	echo "<input type=\"text\" name=\"nama\" size=\"30\"  class=\"a\" readonly>";
  	echo "</td>";
	echo "<td>";
	echo "<input type=\"text\" name=\"hubungan\" size=\"30\"  class=\"a\" readonly>";
  	echo "</td>";
	printf("<td align=\"center\"><a href=\"#\" onclick=\"NewWindow('insurable_jshc.php?c=$nottg&x=$anp&medical=%s".
				 "&nopertanggungan=%s&kdproduk=%s&kdbenefit=%s&kdvaluta=%s&kdcarabayar=%s','popupjamtambahan',600,600,1)\">".
				 "<img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari jaminan tambahan\"></a>".
				 "</td>",$medical,$nopertanggungan,$kdproduk,"%",$kdvaluta,$kdcarabayar);
	echo "</tr>";
	?>
	<tr>
    <td colspan="3"></td><td>
    <input type="submit" name="propmtc12insertjshc" value="Insert">
   <input type="submit" name="propmtc12insertjshc" value="X">
	</td>
    </tr>
    <?
    echo "</table>";
		}
		
?>

</form>
</body>
</html>
