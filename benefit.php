<?
  include "./includes/session.php";
  include "./includes/database.php";
  include "./includes/formula44.php";
  include "./includes/klien.php";
	ob_start();
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
	  //echo $sql."<br><br>";
   	$DBX->parse($sql);
    $DBX->execute();
    $arr=$DBX->nextrow();
		$rumus=$arr["RUMUS"];
		return $rumus;
	}
/************************************************************************************************/

	$sql = "select a.nosp,a.noagen,a.lamapembpremi_th,b.namaproduk,to_char(a.mulas,'DD/MM/YYYY') as tglmulas,".
			   "a.indexawal,a.notertanggung,a.juamainproduk, a.premistd, ".
				 "a.kdproduk,a.kdcarabayar,a.kdstatusmedical,a.usia_th,a.lamaasuransi_th,a.kdvaluta,premi1, a.nopemegangpolis ". //,notertanggung2 ".
	       "from $DBUser.tabel_200_temp a, $DBUser.tabel_202_produk b ".
			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
				 "and a.nopertanggungan='$nopertanggungan' and a.kdproduk=b.kdproduk";
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
	
	$sql="select faktorresiko from $DBUser.tabel_229_resiko_rider where rider='WAIVER' and kdvaluta='$kdvaluta' and masa=(65-$usia)";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
  	$resrdr=$DB->nextrow();
	//echo $resrdr["FAKTORRESIKO"];
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
	$anp=$premi1*$varcb;
	
	$sql="select * from $DBUser.TABEL_UL_FAKTOR_UA where kdproduk='".$kdproduk."' and usia=".$usia;
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arfua=$DB->nextrow();
	
	$uamin= $arfua['FAKTORMIN'] * $anp;
	$uamax= $arfua['FAKTORMAX'] * $anp;
	//echo $anp;
	//UAMAX sesuaikan dg penghasilan setahun
	if ($kdproduk=='JL4BL' || $kdproduk=='JL4BLN' || $kdproduk=='JL4BIFG' || $kdproduk=='JL4SMR' || $kdproduk=='JL4BPRO') {$uamin=$anp*5; $uamax=10000000000;} else {$uamin=$uamin; $uamax=$uamax;};
	
	
//echo "<input type=hidden name=uaminnya value=$uamin><input type=hidden name=uamaxnya value=$uamax>UA Minimal = ".number_format($uamin,2,",",".")." <br>";
echo "<input type=hidden name=uaminnya value=$uamin><input type=hidden name=uamaxnya value=$uamax>UA Minimal = ".number_format($uamin,2,",",".")." <br>";
//	echo "<input type=text name=juanya onBlur=\"javascript:uaOK()\"><br> ";
echo "UA Maximal = ".number_format($uamax,2,",",".");
	
	
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
	if(substr($kdproduk,0,5)=="JL4XS" || substr($kdproduk,0,5)=="JL3XS")
	{
	  $sql = "delete $DBUser.tabel_223_temp where kdjenisbenefit IN ('R','D')";
		$DB->parse($sql);
    $DB->execute();
    $DB->commit();
	  //echo "kdproduk = ".$kdproduk;
		$sql = "insert into $DBUser.tabel_223_temp ".
				 	 		"(prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,kdcbanuitas) ".
  			 	 		"select '$prefixpertanggungan','$nopertanggungan',kdproduk,kdbenefit,periodebayar,lamaperiode,kdjenisbenefit,kdcbanuitas ".
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
	
	if($insertdeathma=="Save") {
		if ($kdproduk=='JL4BF') {
			$sql1="update $DBUser.tabel_223_temp set nilaibenefit=$nilaiua,premi=$premi1 where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit='DEATHMA'";
			$sql2="update $DBUser.tabel_200_temp set juamainproduk=$nilaiua where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
			//echo $sql1;
			$DB->parse($sql1);
			$DB1->parse($sql2);
			if($DB->execute() && $DB1->execute()){
			echo "<br>Nilai UA Berhasil Ditambahkan";
			$nilaiuanya=$nilaiua;}
		
		} else {
			if($nilaiua<$uamin){
				echo "<br>Nilai UA lebih Kecil dari UA Minimal";
			}elseif($nilaiua>$uamax){
				echo "<br>Nilai UA lebih Besar dari UA Maximal";
			}else{
			$sql1="update $DBUser.tabel_223_temp set nilaibenefit=$nilaiua,premi=$premi1 where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit='DEATHMA'";
			$sql2="update $DBUser.tabel_200_temp set juamainproduk=$nilaiua where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
			//echo $sql1;
			$DB->parse($sql1);
			$DB1->parse($sql2);
			if($DB->execute() && $DB1->execute()){
			echo "<br>Nilai UA Berhasil Ditambahkan";
			$nilaiuanya=$nilaiua;
			}
		}
		}
	}
	
	if($propmtc12insert=="Insert") { //insert additional produk
	    if (strlen($periodebayar)==0) $periodebayar="null";
	    if (strlen($periodebenefit)==0) $periodebenefit="null";

		/*if(substr($kdbenefit,0,2)=="CP"){		
		//if(substr($kdbenefit,0,3)=="CPM"){
		$cekbnfb="select count(*) jmlbnf from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
				"substr(kdbenefit,1,2)='CPB'";
		$DB->parse($cekbnfb);
		$DB->execute();
		$arrjmlbnfb=$DB->nextrow();
		$jmlbnfcpb=$arrjmlbnfb["JMLBNF"];
		
		//}elseif(substr($kdbenefit,0,3)=="CPB"){
		$cekbnfm="select count(*) jmlbnf from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
				 "substr(kdbenefit,1,3)='CPM' and substr(kdbenefit,4,3)='".substr($kdbenefit,3,3)."'";	
				 //echo $cekbnfm;
		$DB->parse($cekbnfm);
		$DB->execute();
		$arrjmlbnfm=$DB->nextrow();		
		$jmlbnfcpm=$arrjmlbnfb["JMLBNF"];
		//}
		}
		if($jmlbnfcpb>0 && $jmlbnfcpm==0){
			$error="Anda Tidak Bisa mengambil benefit ini karena sudah Pernah Mengambil Cash Plan Bedah sebelumnya!!";
			$statuscp=0;
		}elseif($jmlbnfcpb==0 && $jmlbnfcpm==0){
			$error="Anda Tidak Bisa mengambil benefit ini karena Cash Plan Bedah Tidak Sesuai dengan Cash Plan Murni!!";
			$statuscp=1;			
		//}elseif($jmlbnfcpb==0 && $jmlbnfcpm>0){
			//$statuscp=1;			
		}*/
		
        /********************************
		     * The following lines of code updated by Udi at Aug, 23rd, 2006
         *
         * There are new Cash Plan Rider Setup applied to almost all product
         * Separate the three model of Cash Plan since it used for different purpose
         *****/
		//$nilaiuanya=$_POST['$nilaiuanya'];
		//echo $kdbenefit;
		//echo substr($kdbenefit,0,4);
		
        if($kdbenefit=="CP1" || $kdbenefit=="CP2" || $kdbenefit=="CP3" || $kdbenefit=="CP4" || $kdbenefit=="CP5") {
        		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
        		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit ".
        						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU','$kdbenefit'||'BDH')";
        } elseif ($kdbenefit=="CP200" || $kdbenefit=="CP300" || $kdbenefit=="CP400" || $kdbenefit=="CP500" || $kdbenefit=="CP600") {
        		  $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
        		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit ".
        						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU')";
        }
		 //CASHPLAN BARU
		 elseif (substr($kdbenefit,0,4)=="CP19") {
			
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU','$kdbenefit'||'BDH')";
							 //echo $sql;
		//Client choose CashPlan with Surgery (Bedah) 	
        } elseif ($kdbenefit=="CP200B" || $kdbenefit=="CP300B" || $kdbenefit=="CP400B" || $kdbenefit=="CP500B" || $kdbenefit=="CP600B") {
			
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU','$kdbenefit'||'BDH')";
			
        // New Cash Plan Murni dan Bedah per 18/08/2009
		} elseif ($kdbenefit=="CPM100" || $kdbenefit=="CPM200" || $kdbenefit=="CPM300" || $kdbenefit=="CPM400" || $kdbenefit=="CPM500") {
     	       $cekbnfb="select count(*) jmlbnf from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
				 		"substr(kdbenefit,1,2)='CP'";	
						//echo "<br>".$cekbnfb;
			   $DB->parse($cekbnfb);
			   $DB->execute();
			   $arrjmlbnfb=$DB->nextrow();		
			   $jmlbnfcpb=$arrjmlbnfb["JMLBNF"];
			  if($jmlbnfcpb>0){ 
			  $sql = "Select sysdate from dual";
			  }else{
				  $sql="insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ('$kdbenefit'||'RWI','$kdbenefit'||'ICU')";
							// echo $sql;
			  }
        } elseif ($kdbenefit=="CPB1000" || $kdbenefit=="CPB2000" || $kdbenefit=="CPB3000" || $kdbenefit=="CPB4000" || $kdbenefit=="CPB5000") {
			   $cekbnfm="select count(*) jmlbnf from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
				 		"((substr(kdbenefit,1,3)='CPM' and substr(kdbenefit,4,3)='".substr($kdbenefit,3,3)."' OR (SUBSTR (kdbenefit, 1, 3) = '".substr($kdbenefit,0,3)."')))";	
						//echo "<br>".$cekbnfm;
			   $DB->parse($cekbnfm);
			   $DB->execute();
			   $arrjmlbnfm=$DB->nextrow();		
			   $jmlbnfcpm=$arrjmlbnfm["JMLBNF"];
			   echo "<br>aa".$jmlbnfcpm;
			   if($jmlbnfcpm==2){
     	       $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit a ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ".
							 "('CPM".substr($kdbenefit,3,3)."'||'RWI','CPM".substr($kdbenefit,3,3)."'||'ICU','$kdbenefit'||'BDH') and not exists ".
							 "(select '1' from $DBUser.tabel_223_temp where prefixpertanggungan = '$prefixpertanggungan' and NOPERTANGGUNGAN = '$nopertanggungan' ".
							 "and KDPRODUK = '$kdproduk' and KDBENEFIT = a.KDBENEFIT)";
							// echo "<br>".$sql;
			   }elseif($jmlbnfcpm==0){
			   $cekbnfm1="select count(*) jmlbnf from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
				 		"substr(kdbenefit,1,2)='CP'";	
						//echo "<br>".$cekbnfm1;
			   $DB->parse($cekbnfm1);
			   $DB->execute();
			   $arrjmlbnfm1=$DB->nextrow();		
			   $jmlbnfcpm1=$arrjmlbnfm1["JMLBNF"];
			   if($jmlbnfcpm1==0){
				$sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit,expirasi,tglmutasi) ".
    		   		   "select '$prefixpertanggungan','$nopertanggungan','$kdproduk',kdbenefit,null,null,kdjenisbenefit,".
						   "add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)),to_date('$tglmulas','DD/MM/YYYY') from $DBUser.tabel_207_kode_benefit a ".
    						 "where kdjenisbenefit='R' and kdkelompokbenefit='C' and kdbenefit IN ".
							 "('CPM".substr($kdbenefit,3,3)."'||'RWI','CPM".substr($kdbenefit,3,3)."'||'ICU','$kdbenefit'||'BDH') and not exists ".
							 "(select '1' from $DBUser.tabel_223_temp where prefixpertanggungan = '$prefixpertanggungan' and NOPERTANGGUNGAN = '$nopertanggungan' ".
							 "and KDPRODUK = '$kdproduk' and KDBENEFIT = a.KDBENEFIT)";   
			   }else{
			   $sql="Select sysdate from dual";
			   }
			   }else{
			   $sql="Select sysdate from dual";
			   }
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
						//waiver anak mau dibeli dulu atau tidak..//if ($cek =="0"){ //tidak ada benefit waiver untuk ayahnya..//			 $sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit) ".
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
									 //echo $sql;
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
							switch($kdbenefit){
								case 'ADDB' :
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;									
									break;
								case 'CI53':
									if($kdproduk=="JL4BF")
									$maxuarider=$nilaiua*3;
									else
									$maxuarider=$nilaiua*3;			
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
									//$vbenefit=$premi1*$faktorcb;
									$vbenefit=($premi1*$faktorcb)/0.7;
									
									//echo $vbenefit;
									break;
								case 'ADB':
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									
									//echo $vbenefit;
									break;
								
								case 'PBCI':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=($premi1*$faktorcb)/0.7;
									
									//echo $vbenefit;
									break;
								case 'PBTPD':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									//$vbenefit=$premi1*$faktorcb;
									$vbenefit=($premi1*$faktorcb)/0.7;
									
									break;
								case 'SPBD':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									//$vbenefit=$premi1*$faktorcb;
									//$vbenefit=$premistd*$faktorcb;
									$vbenefit=($premi1*$faktorcb)/0.7;
									break;
								case 'SPBCI':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									$vbenefit=($premi1*$faktorcb)/0.7;
									//$vbenefit=$premistd*$faktorcb;
									break;
								case 'SPTPD':
									$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>500000000)
									$maxuarider=500000000;
									//$vbenefit=$premi1*$faktorcb;
									$vbenefit=($premi1*$faktorcb)/0.7;
									//$vbenefit=$premistd*$faktorcb;
									break;
								case 'WAIVER':
									//$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									$vbenefit=$premi1*$faktorcb;
									$vbenefit=$premi1*$resrdr["FAKTORRESIKO"]*12/1000;
									break;
								case 'WPTPD':
									//$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									//$vbenefit=$premi1*$resrdr["FAKTORRESIKO"]*12/1000;
									$vbenefit=$premi1*$faktorcb;
									break;
								case 'WPCI51':
									//$vbenefit=$premi1*$faktorcb;
									$maxuarider=$nilaiua*3;
									if($maxuarider>1500000000)
									$maxuarider=1500000000;
									//$vbenefit=$premi1*$resrdr["FAKTORRESIKO"]*12/1000;
									$vbenefit=$premi1*$faktorcb;
									break;
							}
						$btsumur=65;
						if(($vbenefit>$maxuarider) && ($kdbenefit=="ADDB" || $kdbenefit=="TI" || $kdbenefit=="TPD" || $kdbenefit=="PBTPD" || $kdbenefit=="SPTPD" || $kdbenefit=="PBD" || $kdbenefit=="SPBD" || $kdbenefit=="CI53" || $kdbenefit=="PBCI" || $kdbenefit=="SPBCI" )){
							echo "<br>UA Rider Lebih Besar dari pada UA Maximal Rider, UA Max= ".$maxuarider;
						}else{
							//if($kdbenefit=="PBTPD" || $kdbenefit=="SPTPD" || $kdbenefit=="PBD" || $kdbenefit=="SPBD" || $kdbenefit=="WPCI51" || $kdbenefit=="WPTPD" || $kdbenefit=="CI53"){
							if (in_array($kdbenefit, array('PBTPD','SPTPD','PBD','SPBD','WPCI51','WPTPD','CI53','TI','ADDB','TPD','ADB','PBCI','SPBCI'))) {
								if($kdbenefit=="PBTPD"){
									$kdbenefitnya="PTPD";
								}else{
									$kdbenefitnya=$kdbenefit;
								}
								
								$sqlcekumur="SELECT   FLOOR (MONTHS_BETWEEN (mulas, b.tgllahir) / 12) usia_payor,
												65 - FLOOR (MONTHS_BETWEEN (mulas, b.tgllahir) / 12) bts_usia_payor,
												usia_th,
												(25 - usia_th) bts_usia_tert 
												FROM   $DBUser.tabel_200_temp a, $DBUser.tabel_100_klien b
												WHERE       a.nopembayarpremi = b.noklien
												AND a.prefixpertanggungan = '$prefixpertanggungan'
												AND a.nopertanggungan = '$nopertanggungan'";
								//echo $sqlcekumur."<br />";
								//if($kdbenefit=="PBD" || $kdbenefit=="PBTPD" || $kdbenefit=="PTPD" || $kdbenefit=="WPCI51"  || $kdbenefit=="WPTPD" ){
								if(in_array($kdbenefit, array("PBD","PBTPD","PTPD","PBCI"))) {
									    $DB->parse($sqlcekumur);
										$DB->execute();
										$arrcekbatasumur=$DB->nextrow();
										if($arrcekbatasumur['BTS_USIA_PAYOR']>$arrcekbatasumur['BTS_USIA_TERT']){
											//$btsumur=25;
											$btsumur=$arrcekbatasumur['BTS_USIA_TERT'];
											$usia_tert=$arrcekbatasumur['USIA_TH'];
											$queryklien="a.nopemegangpolis = b.noklien AND";
										}else{
											//$btsumur=65;
											$btsumur=$arrcekbatasumur['BTS_USIA_PAYOR'];
											$usia_tert=$arrcekbatasumur['USIA_PAYOR'];
											$queryklien="a.nopemegangpolis = b.noklien AND";
										}
								} else if (in_array($kdbenefit, array("SPTPD","SPBD","SPBCI"))) {
									$DB->parse($sqlcekumur);
									$DB->execute();
									$arrcekbatasumur = $DB->nextrow();
									$btsumur = $arrcekbatasumur['BTS_USIA_PAYOR'];
									$queryklien="a.nopemegangpolis = b.noklien AND";
									//echo $btsumur."-fdsafdsafa-";
								} else if (in_array($kdbenefit,array('CI53','TI','ADDB','TPD','WPCI51','WPTPD','ADB'))) {
									$DB->parse($sqlcekumur);
									$DB->execute();
									$arrcekbatasumur=$DB->nextrow();
									$btsumur = 65-$arrcekbatasumur['USIA_TH'];
									//$queryklien="a.nopemegangpolis = b.noklien AND";
								}else{
									$btsumur=65;
								}
								//$cekkls="SELECT   noklien,to_char(b.tgllahir,'dd/mm/yyyy') tgllahir,floor(months_between(mulas,b.tgllahir)/12) usia_th,b.merokok,((".$vbenefit." / 1000) * tarif) / $faktorcb as premirider FROM   $DBUser.tabel_200_temp a,".
								$cekkls="SELECT   noklien,to_char(b.tgllahir,'dd/mm/yyyy') tgllahir,floor(months_between(mulas,b.tgllahir)/12) usia_th,b.merokok,((".$vbenefit." / 1000) * tarif) / 12 as premirider FROM   $DBUser.tabel_200_temp a,".
											//"$DBUser.tabel_100_klien b,$DBUser.tabel_205_tarip_premirider d WHERE ".
											"$DBUser.tabel_100_klien b,$DBUser.tabel_205_tarip_premi d ,$DBUser.TABEL_246_PRODUK_BASIS e WHERE ".
											//"a.nopemegangpolis = b.noklien ".
											$queryklien.
											" A.PREFIXPERTANGGUNGAN = '$prefixpertanggungan' AND a.nopertanggungan = '$nopertanggungan' AND d.kdproduk = a.kdproduk ".
											"AND d.usia = floor(months_between(mulas,b.tgllahir)/12) AND kdtarif='$kdbenefitnya' AND d.kdproduk = e.kdproduk  and e.kdbasispremi=d.kdbasis";
							}else{
							//$cekkls="SELECT   noklien,to_char(b.tgllahir,'dd/mm/yyyy') tgllahir,usia_th,b.merokok,((".$vbenefit." / 1000) * tarif) / $faktorcb as premirider FROM   $DBUser.tabel_200_temp a,".
							$cekkls="SELECT   noklien,to_char(b.tgllahir,'dd/mm/yyyy') tgllahir,usia_th,b.merokok,((".$vbenefit." / 1000) * tarif) / 12 as premirider FROM   $DBUser.tabel_200_temp a,".
										//"$DBUser.tabel_100_klien b,$DBUser.tabel_205_tarip_premirider d WHERE ".
										"$DBUser.tabel_100_klien b,$DBUser.tabel_205_tarip_premi d ,$DBUser.TABEL_246_PRODUK_BASIS e WHERE ".
										"a.notertanggung = b.noklien ".
										"AND A.PREFIXPERTANGGUNGAN = '$prefixpertanggungan' AND a.nopertanggungan = '$nopertanggungan' AND d.kdproduk = a.kdproduk ".
										"AND d.usia = a.usia_th AND kdtarif='$kdbenefit' AND d.kdproduk = e.kdproduk  and e.kdbasispremi=d.kdbasis";
							}
							//echo "<br>".$cekkls."<br>";
								$DB->parse($cekkls);
								$DB->execute();
								$arrcekkls=$DB->nextrow();	
							$usiatert=$usia_tert ? $usia_tert : $arrcekkls["USIA_TH"];
							$tgllahir=$arrcekkls["TGLLAHIR"];							
							$sql = "insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit, nilaibenefit, tglmutasi,expirasi,premi) ".
        		   		   "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','$kdbenefit',$periodebayar,$periodebenefit,'R','$vbenefit', ".
						   //"to_date('$tglmulas','DD/MM/YYYY'),add_months(to_date('$tglmulas','DD/MM/YYYY'),(($btsumur-".$usiatert.")*12)),'".$arrcekkls["PREMIRIDER"]."')";
						   "to_date('$tglmulas','DD/MM/YYYY'),add_months(to_date('$tglmulas','DD/MM/YYYY'),(($btsumur)*12)),'".$arrcekkls["PREMIRIDER"]."')";
							//echo "<br>".$sql;
							
							// Insert benefit Risker untuk masing2 rider
							if($kdbenefit=="PBTPD" || $kdbenefit=="SPTPD" || $kdbenefit=="PBD" || $kdbenefit=="SPBD" || $kdbenefit=="WPTPD" || $kdbenefit=="WPCI51" || $kdbenefit=="PBCI" || $kdbenefit=="SPBCI"){
								$cekkerjaan="select kdpekerjaan as kdpekerjaan2 from $DBUser.tabel_100_klien where noklien='$nottg2'";
								//echo $cekkerjaan;
								$DB->parse($cekkls);
								$DB->execute();
								$arrcekkerjaan=$DB->nextrow();
								$kdpekerjaan2=$arrcekkerjaan["KDPEKERJAAN2"];							
								//Cari nilai extra premi risker
								//$cekkls="select extrapremium*".$premi1." as extra from $DBUser.tabel_105_pekerjaan where  kdpekerjaan='".$kdpekerjaan2."'";
								$cekkls="SELECT   usia_th,b.merokok,(((".$vbenefit." / 1000) * tarif) / $faktorcb) * extrapremium  as extra FROM   $DBUser.tabel_200_temp a,".
										//"$DBUser.tabel_100_klien b,$DBUser.tabel_105_pekerjaan c,$DBUser.tabel_205_tarip_premirider d WHERE ".
										"$DBUser.tabel_100_klien b,$DBUser.tabel_105_pekerjaan c,$DBUser.tabel_205_tarip_premi d WHERE ".
										"b.kdpekerjaan = c.kdpekerjaan AND a.nopemegangpolis = b.noklien ".
										"AND A.PREFIXPERTANGGUNGAN = '$prefixpertanggungan' AND a.nopertanggungan = '$nopertanggungan' AND d.kdproduk = a.kdproduk ".
										"AND d.usia = a.usia_th AND kdtarif='$kdbenefit'";
								//echo "<br>".$cekkls."<br>";
								$DB->parse($cekkls);
								$DB->execute();
								$arrcekkls=$DB->nextrow();							
								//$facpremi=number_format($arrcekkls["EXTRAPREMIUM"],2);
								$extpremi=$arrcekkls["EXTRA"];
								$usiatert=$arrcekkls["USIA_TH"];
							}else{
								//$cekkls="select extrapremium*".$premi1." as extra from $DBUser.tabel_105_pekerjaan where  kdpekerjaan='".$KLN->kdpekerjaan."'";
								if($kdbenefit=="TERM" || $kdbenefit=="TI")
								$smoker="AND d.bk =b.merokok";
								else
								$smoker="";
								//$cekkls="SELECT   usia_th,b.merokok,round((((".$vbenefit." / 1000) * tarif) * extrapremium )/ $faktorcb,2)  as extra FROM   $DBUser.tabel_200_temp a,".
								$cekkls="SELECT   usia_th,b.merokok,round((((".$vbenefit." / 1000) * tarif) * extrapremium )/ 12,2)  as extra FROM   $DBUser.tabel_200_temp a,".
										"$DBUser.tabel_100_klien b,$DBUser.tabel_105_pekerjaan c,$DBUser.tabel_205_tarip_premi d WHERE ".
										"b.kdpekerjaan = c.kdpekerjaan AND a.notertanggung = b.noklien ".
										"AND A.PREFIXPERTANGGUNGAN = '$prefixpertanggungan' AND a.nopertanggungan = '$nopertanggungan' AND d.kdproduk = a.kdproduk ".
										"AND d.usia = a.usia_th AND kdtarif='$kdbenefit' and NVL(b.merokok,'0')";
								//echo "<br>".$cekkls."<br>";
								$DB->parse($cekkls);
								$DB->execute();
								$arrcekkls=$DB->nextrow();							
								//$facpremi=number_format($arrcekkls["EXTRAPREMIUM"],2);
								$extpremi=$arrcekkls["EXTRA"];
								$usiatert=$arrcekkls["USIA_TH"];
							}
							//echo "<br>".$extpremi."<br>";
							if($kdbenefit=="TPD" || $kdbenefit=="ADDB"){
								   $insRisk="insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit, tglmutasi,premi,expirasi) ".
													   "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','RISK $kdbenefit',$periodebayar,$periodebenefit,'R', ".
													   //"to_date('$tglmulas','DD/MM/YYYY'),'$extpremi',add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$usiatert.")*12)))";
													   "to_date('$tglmulas','DD/MM/YYYY'),'$extpremi',add_months(to_date('$tgllahir','DD/MM/YYYY'),((65)*12)))";

													  //echo $insRisk;
								   $DB->parse($insRisk);
								   $DB->execute();
							}
						}
        		  
							
        		}
		}
		//echo $sql;
		
		$DB->parse($sql);
							$DB->execute();
						  	$DB->commit();
		//echo $sqlyy."<br /><br />" ;		
		//echo $sql;
		//die;
   // Cek Risker untuk tertanggung
 
 /*  $checkPA="select count(kdbenefit) jml from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit in ('TPD','ADDB','PBTPD','PBD','SPTPD','SPBD')";
   //echo $checkPA;
   $DB->parse($checkPA);
   $DB->execute();
   $arrcheckPA=$DB->nextrow();
   $countPA=$arrcheckPA["JML"];
  */
  /* $cekrisker="select count(kdbenefit) jmlrisk from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit='RISKER'";
   $DB->parse($cekrisker);
   $DB->execute();
   $arrcekrisker=$DB->nextrow();
   $countrisk=$arrcekrisker["JMLRISK"];*/

   // Cek Risker untuk tertanggung2 Payor
 
 /* $checkPPA="select count(kdbenefit) jml from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit in ('PBTPD','PBD')";
   $DB->parse($checkPPA);
   $DB->execute();
   $arrcheckPPA=$DB->nextrow();
   $countPPA=$arrcheckPPA["JML"];
   
   // Cek Risker untuk tertanggung2 Spouse
   $checkSPPA="select count(kdbenefit) jml  from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit in ('SPTPD','SPBD')";
   $DB->parse($checkSPPA);
   $DB->execute();
   $arrcheckSPPA=$DB->nextrow();
   $countSPPA=$arrcheckSPPA["JML"];
 */  
  // if($countPA>0 && $countrisk==0){

/*untuk semetara ditutup karena RISKER dibagi kemasing2 benefit rider 
  
   if($countPA=2 || $countPPA==2 || $countSPPA==2){
	   $cekkls="select extrapremium*".$premi1." as extra from $DBUser.tabel_105_pekerjaan where  kdpekerjaan='".$KLN->kdpekerjaan."'";
							//echo "<br>".$cekkls."<br>";
							$DB->parse($cekkls);
							$DB->execute();
							$arrcekkls=$DB->nextrow();							
							//$facpremi=number_format($arrcekkls["EXTRAPREMIUM"],2);
							$extpremi=$arrcekkls["EXTRA"];
							//echo $arrcekkls["EXTRA"]."<br>";

	   $insRisk="insert into $DBUser.tabel_223_temp (prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,periodebayar,periodebenefit,kdjenisbenefit, tglmutasi,premi,expirasi) ".
        		   		   "values ('$prefixpertanggungan','$nopertanggungan','$kdproduk','RISKER',$periodebayar,$periodebenefit,'R', to_date('$tglmulas','DD/MM/YYYY'),$extpremi,add_months(to_date('$tglmulas','DD/MM/YYYY'),((65-".$KLN->usia.")*12)))";
						//   echo $insRisk;
	   $DB->parse($insRisk);
   	   $DB->execute();
						   
   } */
		
  } else if($del=="X") {
  
  	    if ($_POST['del']) {
      	
      	$box=$_POST['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
					
					$sqa = "delete from  $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' ".
		 			 	 "and nopertanggungan='$nopertanggungan' and kdjenisbenefit='R' and kdbenefit like '$dear%'";
					//echo $sqa;
					$DB->parse($sqa);
      				$DB->execute();				
        			}						
						}
				}
	    //$sql = "delete from  $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' ".
		 //			 	 "and nopertanggungan='$nopertanggungan' and kdjenisbenefit='R' and kdbenefit='$kdbnfx'";
  		//echo $sql."<br>";
     // $DB->parse($sql);
  		//$DB->execute();
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
  	
  	$sqlrdr = "select a.nilaibenefit nilai, b.kdrumuspremi, b.kdbenefit  ". 
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
  						"and 		a.nopertanggungan='$nopertanggungan' ".
						"and a.kdbenefit not in ('PBD','PBTPD','SPTPD','SPBD')";
						
  	//echo $sqlrdr; exit;
	
  	$DBA=New database($userid, $passwd, $DBName);
  	$DBA->parse($sqlrdr);
    $DBA->execute();
  	$premirider=0;
    while ($has=$DBA->nextrow()) {
  	 $koderumusrdr=$has["KDRUMUSPREMI"];
	   $kdbnf = $has["KDBENEFIT"];
  	 $rumuspremirider = GetFormula($DBA,$koderumusrdr);
	 //echo str_replace('UABNF', $has["NILAI"],$rumuspremirider).$has["NILAI"].$koderumusrdr;
//die;

  	 $FM1=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
  	 //$FM1->parse($rumuspremirider);
	  $FM1->parse(str_replace('UABNF', $has["NILAI"],$rumuspremirider));
  	 //$FM1->parse('(+ 1 2)');
	 $hasilx = $FM1->execute($DBA);
		 
		 $premirider=$hasilx;
  
  	 echo "";
  	// echo $rumuspremistd."<br>";
  	// echo 'xxxx'.$hasilx."<br>";die;
	
	//dikoment tanggal 15 agustus, yang diupdate adalah nilai preminya terlebih dahulu
	//untuk masing-masing rider
	//if($kdbnf!="ADDB" || $kdbnf!="SPTPD" || $kdbnf!="PBD" || $kdbnf!="PBTPD" || $kdbnf!="SPBD"){	
	$sql="update $DBUser.tabel_223_temp set premi =$premirider ".
			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
			 "and kdbenefit ='$kdbnf' ";

  	//echo $sql;
  	if($kdbnf!="TI"){
    		$DB->parse($sql);
      $DB->execute();
      }
      
  	$DB->commit();
	//}
	// die;	
				
  	// $premirider+=$hasilx; 
  	}
	
	//echo str_replace('UABNF', $has["NILAIBENEFIT"],$rumuspremirider); die;
/*
	  $sql="update $DBUser.tabel_200_temp set premirider =$premirider ".
			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
  	//echo $sql;
  	$DB->parse($sql);
    $DB->execute();
  	$DB->commit();
*/     
  	//echo $premirider;
  	//============================================================================
  		//echo $premijua; exit;
		switch ($premijua) {
		  case 'jua' : {
			  header("location:benefit1.php?vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper");//asli propmtc14
			} break;
			case 'premi' : {
				$noproposal=$noproposal=="" ? $nopertanggungan : $noproposal;
				echo "vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper";
			  header("location:benefit2.php?vara=$vara&premijua=$premijua&prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan&noproposal=$noproposal&kdper=$kdper");//asli propmtc14
			} break;
		}				
		exit;
		
	} //if insert
} // end run

  /*-----------------------------------tampilin daftar benefit--------------------------------------------------------------------*/
	$cabayar=$FM->cabayar;
	$cabar = $FM->namacarabayar;
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
	
	

?>
<html>
<head>
<title>Benefit Proposal</title>
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js"></script>
<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
<input type="hidden" name="kdproduk" value="<? echo $kdproduk; ?>">
</head>
<?php if($kdcarabayar!="X"){ ?>
<body onLoad="document.propbnft.propmtc12insert.disabled=true">
<?php }else{ ?>
<body onLoad="document.propbnft.propmtc12insert.disabled=true; document.propbnft.propmtc12lanjut.disabled=false;">
<?php } ?>
<form name="propbnft" method="POST" action="<? PHP_SELF; ?>">

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
//$sql="delete from $DBUser.tabel_223_temp a ". //watch the fuck temp
//	 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' and kdjenisbenefit='R'";
//$DB->parse($sql);
//$DB->execute();

/*$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,".
			 "b.namabenefit,a.nilaibenefit,".
			 "a.premi,a.kdjenisbenefit,to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi ".
	     "from $DBUser.tabel_223_temp a,$DBUser.tabel_207_kode_benefit b ". //watch the fuck temp
			 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
			 "and a.kdbenefit=b.kdbenefit(+) and a.kdproduk='$kdproduk' ";*/
	$sql = "SELECT a.kdproduk, a.periodebayar, a.periodebenefit, a.kdbenefit, b.namabenefit, a.nilaibenefit,
				CASE WHEN d.nospaj IS NOT NULL AND a.kdbenefit = 'DEATHMA' THEN TO_NUMBER(d.uangasuransi) ELSE null END uangasuransi,
				a.premi, a.kdjenisbenefit, TO_CHAR (a.tglmutasi, 'DD/MM/YYYY') tglmutasi
			FROM $DBUser.tabel_223_temp a
			LEFT OUTER JOIN $DBUser.tabel_207_kode_benefit b ON a.kdbenefit = b.kdbenefit
			LEFT OUTER JOIN $DBUser.tabel_200_temp c ON a.prefixpertanggungan = c.prefixpertanggungan
				AND a.nopertanggungan = c.nopertanggungan
			LEFT OUTER JOIN $DBUser.tabel_spaj_online_produksi d ON c.nosp = d.nospaj
			WHERE a.prefixpertanggungan = '$prefixpertanggungan'
				AND a.nopertanggungan = '$nopertanggungan'
				AND a.kdproduk = '$kdproduk'
			GROUP BY a.kdproduk, a.periodebayar, a.periodebenefit, a.kdbenefit, b.namabenefit,
				d.nospaj, d.uangasuransi, a.nilaibenefit, a.premi, a.kdjenisbenefit, a.tglmutasi";
			 //echo $sql;
  		 $DB->parse($sql);
			 $DB->execute();
	$i = 1;
  while ($arr=$DB->nextrow()) {
	include "./includes/belang.php";
	 if ($arr["KDJENISBENEFIT"]=='R') {
	  print ("<input type=\"hidden\" name=\"kdbnfx\" value=\"".$arr["KDBENEFIT"]."\">\n" );
    //print( "<input type=\"hidden\" name=\"noproposal\" value=\"".$noproposal."\">\n" );
  	print( "<input type=\"hidden\" name=\"kdper\" value=\"".$kdper."\">\n" );
  	print( "<input type=\"hidden\" name=\"kdproduk\" value=\"".$arr["KDPRODUK"]."\">\n" );
  	print( "<input type=\"hidden\" name=\"mode\" value=\"insert\">\n" );
  	print( "<input type=\"hidden\" name=\"vara\" value=\"".$vara."\">\n" );
  	print( "<input type=\"hidden\" name=\"prefixpertanggungan\" value=\"".$prefixpertanggungan."\">\n" );
  	print( "<input type=\"hidden\" name=\"nopertanggungan\" value=\"".$nopertanggungan."\">" );
		echo "<td class=verdana8 align=center>".//<input name=del type=submit value=X class=buton>
		"<input type='checkbox' name='box1[]' value=".$arr["KDBENEFIT"].">
		</td>";
		
	 } else {
		print  ("<td class=verdana8 align=center>$i</td>\n" );
	 }	
		print  ("<td class=verdana8>".$arr["KDBENEFIT"]."</td>\n" );
			print  ("<td class=verdana8>".$arr["NAMABENEFIT"]."</td>\n" );
		if($kdcarabayar!="X"){
			if($arr["KDBENEFIT"]=="DEATHMA"){
			$uanya1=$arr["NILAIBENEFIT"] ? $arr["NILAIBENEFIT"] : $uamin;
			$uanya1=!empty($arr['UANGASURANSI']) ? $arr['UANGASURANSI'] : $uanya1;
			if($arr["NILAIBENEFIT"]==""){
				print  ("<td align=center class=verdana8><input type=\"text\" name=\"nilaiua\" size=\"10\"  class=\"a\" onfocus=highlight(event) value=$uanya1><input type=\"submit\" name=\"insertdeathma\" value=\"Save\"></td>\n" );
			}else{
				print  ("<td align=right class=verdana8>".number_format($uanya1,2,",",".")."<input type=\"hidden\" name=\"nilaiua\" value=$uanya1></td>\n" );
				$onlanjut=1;
			}
		}else{
			print  ("<td align=right class=verdana8>".number_format($arr["NILAIBENEFIT"],2,",",".")."</td>\n" );
		}
		}else{
			//Ditambah Oleh  Dedi untuk input UA JS Pro Idaman
			if($arr["KDBENEFIT"]=="DEATHMA"){
				$sql1="update $DBUser.tabel_223_temp set nilaibenefit=$uamin,premi=$premi1 where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and kdbenefit='DEATHMA'";
		$sql2="update $DBUser.tabel_200_temp set juamainproduk=$uamin where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		//echo $sql1;
		$DB->parse($sql1);
		$DB1->parse($sql2);
		$nilaiuanya=$uamin;
		$DB->execute();
		$DB1->execute();
		print  ("<td align=right class=verdana8>".number_format($nilaiuanya,2,",",".")."</td>\n" );						
			}
		else{	// akhir tambahn UA JS Pro Idaman
			print  ("<td align=right class=verdana8>".number_format($arr["NILAIBENEFIT"],2,",",".")."</td>\n" );						
		}
		}
		print  ("<td align=center class=verdana8>".$arr["KDJENISBENEFIT"]."</td>\n" );
	  print  ("</tr>\n" );
		$i ++;
	} 
	echo "<tr>";
	echo "<td  class=verdana8 align=center><input name=del type=submit value=X class=buton>$no</td>";
	echo "<td><input type=\"hidden\" name=\"premijua\" value=$premijua>";
	echo "<input type=\"text\" name=\"kdbenefit\" size=\"10\"  class=\"a\" readonly>";
  echo "</td>";
	echo "<td>";
	echo "<input type=\"text\" name=\"namabenefit\" size=\"20\"  class=\"a\" readonly>";
  echo "</td>";
	//echo "<td align=\"center\">UA <input type=\"text\" name=\"vbenefit\" size=\"5\"  class=\"a\" onfocus=highlight(event)> Faktor<input type=\"text\" name=\"periodebayar\" size=\"5\"  class=\"a\" onfocus=highlight(event)></td>";
	echo "<td align=\"left\">UA <input type=\"text\" name=\"vbenefit\" size=\"5\"  class=\"a\" onfocus=highlight(event)><input type=hidden name=nilaiuanya value=$uanya1></td>";
	// untuk entry ua rider
	//echo "<td align=\"center\"><input type=\"text\" name=\"vbenefit\" size=\"5\"  class=\"a\" onfocus=highlight(event)></td>";
	printf("<td align=\"center\"><a href=\"#\" onclick=\"NewWindow('popupjam1.php?x=$anp&medical=%s".
				 "&nopertanggungan=%s&kdproduk=%s&kdbenefit=%s&kdvaluta=%s&kdcarabayar=%s','popupjamtambahan',600,600,1)\">".
				 "<img src=\"../../img/jswindow.gif\" border=\"0\" alt=\"cari jaminan tambahan\"></a>".
				 "</td>",$medical,$nopertanggungan,$kdproduk,"%",$kdvaluta,$kdcarabayar);
	echo "</tr>";
	echo "</table>";

	if($userid == 'TEGUH_NB'){
		$onlanjut = 1;
	}
	
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
 	 <input type="submit" name="propmtc12lanjut" value="Lanjut" <? echo $onlanjut==1 ? "": "disabled"; ?>>
	</td> 
 </tr> 
 </table>
 
 <?
if($propmtc12insertjshc=="Insert") { //insert tertanggung JSHC
if($nottg==$klienno){
$sql="INSERT INTO $DBUser.TABEL_219_HOSPITAL_TEMP (PREFIXPERTANGGUNGAN,
                                     NOPERTANGGUNGAN,
                                     KDINSURABLE,
                                     NOTERTANGGUNG,
                                     NOKLIEN,
                                     NOURUT)
  select '$prefixpertanggungan',
            '$nopertanggungan','04', '$nottg', '$klienno','$nourt' from dual";
			
			//echo $sql;
		$DB1->parse($sql);
		$DB1->execute();
}else{
$sql="INSERT INTO $DBUser.TABEL_219_HOSPITAL_TEMP (PREFIXPERTANGGUNGAN,
                                     NOPERTANGGUNGAN,
                                     KDINSURABLE,
                                     NOTERTANGGUNG,
                                     NOKLIEN,
                                     NOURUT)
  select '$prefixpertanggungan',
            '$nopertanggungan',kdhubungan, notertanggung, noklieninsurable,'$nourt' from $DBUser.tabel_113_insurable
where notertanggung='$nottg' and noklieninsurable='$klienno'";
			
		//	echo $sql;
		$DB1->parse($sql);
		$DB1->execute();
	}
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
			 "and a.kdbenefit=b.kdbenefit(+) and a.kdproduk='$kdproduk'  AND a.KDBENEFIT LIKE 'JSHC%'";
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

	  include "./includes/belang.php";
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
				 "<img src=\"../../img/jswindow.gif\" border=\"0\" alt=\"cari jaminan tambahan\"></a>".
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
