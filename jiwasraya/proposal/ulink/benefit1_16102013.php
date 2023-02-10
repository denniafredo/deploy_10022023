<?
  	include "./includes/session.php";
  	include "./includes/common.php";
	include "./includes/database.php";
  	include "./includes/formula44.php";
	include "./includes/klien.php";

?>
	<script language="JavaScript"> 
		function Cekbok(doc){ 
		 if (doc == true)
		 {
		 checkedAll('getpremi', true);
		 }
		 else
		 {
		 checkedAll('getpremi', false);
		 }
		} 
		
		function showHide (obj) { 
		if (obj.style.visibility == "hidden") { 
		obj.style.visibility = "visible"; 
		} else { 
		obj.style.visibility = "hidden"; 
		} 
		}
	function limitCheckbox(el, max) {
		var count = 0,
			i;
		var checkboxes = document.getElementsByName(el.name);
		
		for (i = 0; i < checkboxes.length; i += 1) {
			if (checkboxes[i].checked) {
				count = count + 1;
			}
		}	 
		if (count > max) {
			alert('Pilih Maksimal ' +  max + ' Jenis Fund saja!');
			el.checked = false;
		}
	}
	
	function limitMin(el) {
		var countt = 0,
			x;
		var checkboxes = document.getElementsByName('box');
		
		for (x = 0; x < checkboxes.length; x += 1) {
			if (checkboxes[x].checked) {
				countt = countt + 1;
			}
		}
		
		var satu=document.getElementById('xBF');
		var dua=document.getElementById('xEF');
		var tiga=document.getElementById('xFF');
		var empat=document.getElementById('xMM');
		var total=(1*satu.value)+(1*dua.value)+(1*tiga.value)+(1*empat.value);
		
		if ((total<100) && (countt=2)) {
			alert('Prosentase kurang dari 100%!');
			//el.checked = false;
		    //el.value=0;
			//el.focus();		
			document.propmtc14.sporsi.disabled = true; 	
		} else if ((total=100) && (countt=2)){
			//alert('xxx');
			document.propmtc14.sporsi.disabled = false; 
		}
		
	}
	function limitMax(el) {
		
		var satu=document.getElementById('xBF');
		var dua=document.getElementById('xEF');
		var tiga=document.getElementById('xFF');
		var empat=document.getElementById('xMM');
		var total=(1*satu.value)+(1*dua.value)+(1*tiga.value)+(1*empat.value);
		
		if (total>100) {
			alert('Prosentase melebihi 100%!');
			//el.checked = false;
		    el.value=0;
			el.focus();			
		}		
	}	
	</script>
<?
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	$DB=New database($userid, $passwd, $DBName);
	$DA=New database($userid, $passwd, $DBName);
  	$FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);


	//
	//$sql = "delete from $DBUser.TABEL_UL_OPSI_FUND_TEMP where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan'";

							//echo $sql;
							//$DA->parse($sql);
							//$DA->execute();
							//$DA->commit;
	
	/*$sql = "insert into $DBUser.TABEL_UL_OPSI_FUND_TEMP (prefixpertanggungan,nopertanggungan,kdfund,porsi, status,tglrekam,userrekam) values ".
             				"('$prefixpertanggungan','$nopertanggungan','BF','60',0, sysdate,'$userid')";
							//echo $sql;
							$DA->parse($sql);
							$DA->execute();
							$DA->commit;
	
	$sql = "insert into $DBUser.TABEL_UL_OPSI_FUND_TEMP (prefixpertanggungan,nopertanggungan,kdfund,porsi, status,tglrekam,userrekam) values ".
             				"('$prefixpertanggungan','$nopertanggungan','EF','40',0, sysdate,'$userid')";
							//echo $sql;
							$DA->parse($sql);
							$DA->execute();
							$DA->commit;
	*/
	//Akhir entry porsi awal
	
	
	
	//masukkan data topup khusus JL4
	/*----------------------- start top up -------------------*/


	if(isset($sporsi))
    {
		 $sqlx = "update $DBUser.tabel_223_temp set nilaibenefit = $fua*$premistd ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdbenefit in ('DEATHMA')";
			 //echo $sqlx;
			 $DB->parse($sqlx);
			 $DB->execute();
			 $DB->commit();
		if ($HTTP_POST_VARS['sporsi']) {
      	$sql = "delete from $DBUser.TABEL_UL_OPSI_FUND_TEMP where nopertanggungan='$nopertanggungan'";

							//echo $sql;
							$DA->parse($sql);
							$DA->execute();
							$DA->commit;
      	$box=$HTTP_POST_VARS['box1']; //as a normal var
      	$box_count=count($box); // count how many values in array
      	if (($box_count)<1)
				{
				//echo "No Data Updated !";
				}
				else
				{
    				foreach ($box as $dear) {
					$sql = "insert into $DBUser.TABEL_UL_OPSI_FUND_TEMP (prefixpertanggungan,nopertanggungan,kdfund,porsi, status,tglrekam,userrekam) values ".
             				"('$prefixpertanggungan','$nopertanggungan','".substr($dear,0,2)."','".${'x'.substr($dear,0,2)}."',0, sysdate,'$userid')";
							//echo $sql;
							$DA->parse($sql);
							$DA->execute();
							$DA->commit;

					//echo ${'x'.substr($dear,0,2)}.'</br>';
					//echo substr($dear,0,2);
        			}
						}
				}
		//echo $fua*$premistd;
		//$sql = "update $DBUser.tabel_200_temp set juamainproduk ='$fua*$premistd' ".
		//				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
			  //$DB->parse($sql);
			  //$DB->execute();
			  //$DB->commit();
			 
	}
	$minpremitopup=100000;
	if(isset($premitopup) && ($premitopup < $minpremitopup))
	{
	 echo "gagal... premi TOP UP minimal  $minpremitopup";
	}
	else
	{
	  $komisitopup = 0.02 * $premitopup;
		$komisitopuplain = 0.03 * $premitopup;
		$bentopupinvest = 0.95 * $premitopup;

    if(isset($addtopup))
    {
		  $sql = "delete $DBUser.tabel_404_temp where kdkomisiagen in ('29','30') ".
             "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
			//echo $sql;
			$DA->parse($sql);
      $DA->execute();
			$DA->commit;

			$sql = "insert into $DBUser.tabel_223_temp ".
    			 	 "(prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,premi,kdjenisbenefit,tglmutasi) ".
    				 "values ".
    				 "('$prefixpertanggungan','$nopertanggungan','$kodeproduk','BNFTOPUP','$premitopup','T',to_date('$tglmutasi','DD/MM/YYYY'))";
    	$DB->parse($sql);
      $DB->execute();
			$DB->commit;

			$sql = "insert into $DBUser.tabel_404_temp ".
            					 "(prefixpertanggungan,nopertanggungan,komisiagen,".
            					 "kdkomisiagen,noagen,thnkomisi,komisiagencb) ".
              		   "values ('$prefixpertanggungan','$nopertanggungan',$komisitopup,".
  									 		"'29','$noagen','1',$komisitopup) ";
      //echo $sql;
			$DB->parse($sql);
      $DB->execute();
			$DB->commit;

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
		  if($premitopup < $minpremitopup)
    	{
    	 echo "gagal... premi TOP UP minimal  $minpremitopup";
    	}
			else
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
    }

  	if(isset($deletetopup))
    {
      $sql = "delete $DBUser.tabel_223_temp ".
    			 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdproduk='$kodeproduk' and kdbenefit='BNFTOPUP'";
    	$DB->parse($sql);
      $DB->execute();

			$sql = "delete $DBUser.tabel_404_temp where kdkomisiagen in ('29','30') ".
             "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
			//echo $sql;
			$DB->parse($sql);
      $DB->execute();

			$bentopupinvest = 0;
    }
	}


	//add topup sekaligus
	if($premitopupskg!="")
	{
    $minpremitopupskg=1000000;
    if($premitopupskg<$minpremitopupskg){
     echo "gagal... premi TOP UP SEKALIGUS minimal  $minpremitopupskg";
    }else{
    $komisitopupskg = 0.02 * $premitopupskg;
		$komisitopuplainskg = 0.03 * $premitopupskg;
		$bentopupinvestskg = 0.95 * $premitopupskg;

		if(isset($addtopupskg))
    {
			$sql = "insert into $DBUser.tabel_223_temp ".
    			 	 "(prefixpertanggungan,nopertanggungan,kdproduk,kdbenefit,premi,kdjenisbenefit,tglmutasi) ".
    				 "values ".
    				 "('$prefixpertanggungan','$nopertanggungan','$kodeproduk','BNFTOPUPSG','$premitopupskg','T',to_date('$tglmutasi','DD/MM/YYYY'))";
    	//echo $sql;
    	$DB->parse($sql);
      $DB->execute();

			$sql = "insert into $DBUser.tabel_404_temp ".
            					 "(prefixpertanggungan,nopertanggungan,komisiagen,".
            					 "kdkomisiagen,noagen,thnkomisi,komisiagencb) ".
              		   "values ('$prefixpertanggungan','$nopertanggungan',$komisitopupskg,".
  									 		"'32','$noagen','1',$komisitopupskg) ";
			$DB->parse($sql);
      $DB->execute();

			$sql = "insert into $DBUser.tabel_404_temp ".
            					 "(prefixpertanggungan,nopertanggungan,komisiagen,".
            					 "kdkomisiagen,noagen,thnkomisi,komisiagencb) ".
              		   "values ('$prefixpertanggungan','$nopertanggungan',$komisitopuplainskg,".
  									 		"'33','$noagen','1',$komisitopuplainskg) ";
			$DB->parse($sql);
      $DB->execute();
		}

  	if(isset($updatetopupskg))
    {
      $sql = "update $DBUser.tabel_223_temp set premi='$premitopupskg' ".
    			 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdproduk='$kodeproduk' and kdbenefit='BNFTOPUPSG'";
    	//echo $sql;
    	$DB->parse($sql);
      $DB->execute();

			$sql = "update $DBUser.tabel_404_temp set komisiagen=$komisitopupskg, komisiagencb=$komisitopupskg ".
            	"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					  "and kdkomisiagen='32' and noagen='$noagen' ";
			$DB->parse($sql);
      $DB->execute();

			$sql = "update $DBUser.tabel_404_temp set komisiagen=$komisitopuplainskg, komisiagencb=$komisitopuplainskg ".
            	"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					  "and kdkomisiagen='33' and noagen='$noagen' ";
			$DB->parse($sql);
      $DB->execute();
	  }

  	if(isset($deletetopupskg))
    {
      $sql = "delete $DBUser.tabel_223_temp ".
    			 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdproduk='$kodeproduk' and kdbenefit='BNFTOPUPSG'";
    	//echo $sql;
    	$DB->parse($sql);
      $DB->execute();

			$sql = "delete $DBUser.tabel_404_temp where kdkomisiagen in ('32','33') ".
             "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
			$DB->parse($sql);
      $DB->execute();

			$bentopupinvestskg = 0;
	  }
	}
	}
	else
	{
	    $sql = "delete $DBUser.tabel_404_temp where kdkomisiagen in ('32','33') ".
             "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
			$DB->parse($sql);
      $DB->execute();
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
		//die;
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

	$sql="select kdproduk, kdstatusmedical from $DBUser.tabel_200_temp where ".
			 "prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
  $DB->parse($sql);
  $DB->execute();
	$pro=$DB->nextrow();
	$kproduk=$pro["KDPRODUK"];
	$med= $pro["KDSTATUSMEDICAL"];

	//echo "KODE PRODUK = ".$kproduk;
	/*
	if($kproduk=="JSP") {
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
  	 //dihide demi produk JSP tgl 23/09/2008 by kade & Bughost
  	 //$hasil = $FM1->execute($DBA);
     //$premistandar+=$hasil;
  	}

	}
	else
	{
	*/
	 	$sql="select distinct b.kdrumuspremi ".
  	     "from $DBUser.tabel_223_temp a,$DBUser.tabel_206_produk_benefit b ".
  	     "where a.kdproduk=b.kdproduk and a.kdjenisbenefit='U' and ".
  			 "a.kdjenisbenefit=b.kdjenisbenefit and ".
  			 "a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ";
  	//echo $sql."<br />";
  	$DBA=New database($userid, $passwd, $DBName);
  	$DBA->parse($sql);
    $DBA->execute();
  	$premistandar=0;
    while ($has=$DBA->nextrow()) {
  	 $koderumusstd=$has["KDRUMUSPREMI"];
  	 $rumuspremistd = GetFormula($DBA,$koderumusstd);
  	 $FM1=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
  	 $FM1->parse($rumuspremistd);
		//echo "KODE RUMUS STD = ".$koderumusstd."<br>";
  	 	//echo "RUMUS PREMI STD = ".$rumuspremistd."<br>";
  	 	//echo "HASIL = ".$hasil."<br>";
  	 $hasil = $FM1->execute($DBA);
     $premistandar+=$hasil;
  	}
	//}

	//echo $premistandar;

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



  //tambahan untuk ngecek status medical

	$sqlm = "select kdstatusmedical statusm from $DBUser.tabel_200_temp ".
			   " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";

	//echo $sql;
	$DB->parse($sqlm);
  $DB->execute();
	$arb=$DB->nextrow();
	$medical = $arb["STATUSM"];


	if (!$kdcarabayarlama=='') {
	// $sql="update $DBUser.tabel_200_temp set kdcarabayar='$kdcarabayarlama',premistd=$premistandar ".//, premirider =$premirider ".
	 $sql="update $DBUser.tabel_200_temp set kdcarabayar='$kdcarabayarlama',premistd=premi1 ".//, premirider =$premirider ".
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
			//Atas permintaan Team URC nilai benefit DEATHMA untuk produk JL4X = premi *1.25
			if($kdproduk=="JL4X")
			$benefit=$premi*1.25;
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

			if(substr($kdbenefit,0,4)=="RISK"){ //resiko kerja rumus salah harusnya faktor resiko X faktor resiko kerja
  			if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3")
  			{
  			}
  			else
  			{
  			/*$sql="update $DBUser.tabel_223_temp ".
  			     "set premi=$resikokerja, nilaibenefit=$benefit,expirasi=$expir,".
  					 "akhirpmb=$akhirpmb ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";*/
  			}
			}
			else
			{
  			if(substr($kdproduk,0,3)=="JL4"){
				$sql="select * from $DBUser.tabel_223_temp ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			}else{
			$sql="update $DBUser.tabel_223_temp ".
  			     "set premi=$premi, nilaibenefit=$benefit,expirasi=$expir,".
  					 "akhirpmb=$akhirpmb ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";	
			}
			}
			//echo $sql."<br /><br />";
			if($kdbenefit=="BNFTOPUP" || $kdbenefit=="BNFTOPUPSG"){}
			else
			{
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

		//echo "JUA :".$jua1." | premi2 :".$premi2." premistandar  $premistd<br><br>";



    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
	  if ($jua1==0) {
     print( "	 alert('Nilai JUA Nol, Kemungkinan Belum Ada Tarifnya')\n" );
	   echo "window.opener.document.ntryprop.submit.disabled=true;";
	  }

		if(substr($kdproduk,0,3)=="JL4")
		{
			//khusus unitlink berkala, JUA minimal sebesar Rp. 7.500.000, diupdate tgl 17/09/2008 by bughost/sukendro
			//if(substr($kdproduk,0,4)=="JL4B" && $jua1<7500000)
			//{
				  //$jua1 = 7500000;

				  		//$jua1=$fua*$premistd;
			/*$sql = "update $DBUser.tabel_200_temp set juamainproduk ='$jua1' ".
			"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
			 $DB->parse($sql);
			 $DB->execute();
			 $DB->commit();*/
			
			 
			 //$sql = "select juamainproduk from $DBUser.tabel_200_temp ".
			//"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
			$sql = "select decode(kdproduk,'JL4X',PREMI1*1.25, juamainproduk) JUAMAINPRODUK from $DBUser.tabel_200_temp ".
			"where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
			 //echo $sql;
			 //die;
			 $DB->parse($sql);
			 $DB->execute();
			 $arrjmp=$DB->nextrow();
			 $juanya=$arrjmp["JUAMAINPRODUK"];
			 //echo $sql;
			 //die;
			 
			
			
			//}

			  printf ("window.opener.document.ntryprop.nilai.value='%s';".
						"window.opener.document.ntryprop.premi2.value='%s';".
								"window.opener.document.ntryprop.juamainproduk.value='%s';".
								//"window.opener.document.ntryprop.premistd.value='%s';",$premiakhir,$premiakhir,$jua1,$premistd);
								"window.opener.document.ntryprop.premistd.value='%s';",$premiakhir,$premiakhir,$juanya,$premistd);

			}
			else
			{
					printf ("window.opener.document.ntryprop.premi2.value='%s';".
								"window.opener.document.ntryprop.juamainproduk.value='%s';".
								"window.opener.document.ntryprop.premistd.value='%s';",$premi2,$jua1,$premistd);
			}
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
				 	 "and kdbenefit <>'WAIVER2' and kdjenisbenefit <>'R'";
		//echo $sqlx1;
		$DB->parse($sqlx1);
    $DB->execute();
		$arix1=$DB->nextrow();
		$premix1=$arix1["PREMI1JSP"];

		$sqlx2 = "select sum(premi) premi2jsp ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdjenisbenefit <>'X' and kdbenefit <>'WAIVER' and kdjenisbenefit <>'R'";
		//echo $sqlx2;
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
		if($kdproduk=="JSP" || $kdproduk=="JSPS"){
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

		$sql = "update $DBUser.tabel_200_temp set premi1 ='$p1' ".
          			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
          $DB->parse($sql);
          $DB->execute();
          $DB->commit();

	  printf ("window.opener.document.ntryprop.premi1.value='%s';".
					  "window.opener.document.ntryprop.premi2.value='%s';".
				    "window.opener.document.ntryprop.premistd.value='%s';",$p1,$p2,$premistd,$premirider);

	  print( "window.close()");
    print( "//-->\n" );
    print( "</script>\n" );

	 } 	break;
	}  //switch


	if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3")
 	{
//		$sql = "update $DBUser.tabel_200_temp set premistd=$premistd,premi1=$premiakhir,premilink=$premiakhir ".
		$sql = "update $DBUser.tabel_200_temp set premistd=premi1,premi1=$premiakhir,premilink=$premiakhir ".
				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
		$DB->parse($sql);
		$DB->execute();
		}

    if(substr($kdproduk,0,5)=="JL4XS" || substr($kdproduk,0,5)=="JL3XS")
 	  {
  		$sql = "update $DBUser.tabel_223_temp set nilaibenefit=round(0.5*$premilinked)  ".
  				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdbenefit='JMNKEC' ";
  		$DB->parse($sql);
  		$DB->execute();
			//echo $sql;
			$sql = "update $DBUser.tabel_223_temp set nilaibenefit=round(0.25*$premilinked)  ".
  				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  					 "and kdbenefit='BNFCRIL' ";
  		$DB->parse($sql);
  		$DB->execute();
		}

		if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3")
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
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		}

		exit;
}	  //if
/*********************************************************************************************************************/
	$kdproduk=$FM->produk;
	$faktor = $FM->faktorbayar;
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
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js"></script>
<?
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
	print( "function SubmitOK(){\n" );



  switch ($premijua) {
	case 'jua':
	//print("window.opener.document.ntryprop.submit.disabled=false;\n" );   --> disabled  hingga mengisi tgltrasfer 19/4/2013 Dedi
	print("window.opener.document.ntryprop.jmltransfer.disabled=false;\n" );
  break;
	case 'premi':
	 switch ($vara){
	 case '0': //ok
	  print( "		window.opener.document.ntryprop.vara.value=1;\n" );
	  //print( "		window.opener.document.ntryprop.submit.disabled=false;\n" );   --> disabled  hingga mengisi tgltrasfer 19/4/2013 Dedi
	  print( "		window.opener.document.ntryprop.jmltransfer.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=false;\n" );
	 break;
	 case '1':
	  print( "		window.opener.document.ntryprop.vara.value=2;\n" );
   //print( "		window.opener.document.ntryprop.submit.disabled=false;\n" );   --> disabled  hingga mengisi tgltrasfer 19/4/2013 Dedi
	  print( "		window.opener.document.ntryprop.jmltransfer.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=true;\n" );
	 break;
	 case '2':
	  print( "		window.opener.document.ntryprop.vara.value=0;\n" );
   //print( "		window.opener.document.ntryprop.submit.disabled=false;\n" );   --> disabled  hingga mengisi tgltrasfer 19/4/2013 Dedi
	  print( "		window.opener.document.ntryprop.jmltransfer.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=true;\n" );
	 break;
	 }

  break;
	}

			print("var kprod = window.opener.document.ntryprop.kdproduk.value;\n" );
			print("if(kprod=='JSSK' || kprod=='JSSP'){ ");
			print("alert('Tanggal dan Jumlah Transfer mohon diisi!!');\n" );
			print( "window.opener.document.ntryprop.tgltransfer.focus();\n" );
			print( "window.opener.document.ntryprop.submit.disabled=true;\n" );
			print("} else {");
			print( "window.opener.document.ntryprop.tgltransfer.value='';\n" );
			print( "window.opener.document.ntryprop.jmltransfer.value='';\n" );
			print("}");

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
	if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3")
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
     <td>PersentasePremi</td>
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
		//echo $kdrumus."<br>";
		$rumuspremi = GetFormula($DB,$kdrumus);
		//echo "Rumus Premi : ".$rumuspremi."<br>";
 	  $kdrumus = $arr["KDRUMUSBENEFIT"];
		$rumusbenefit = GetFormula($DB,$kdrumus);
		//echo "Rumus benefit : ".$rumusbenefit."<br>";

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
		//echo $hasilbenefit;
		//echo "kdbenefit = ".$kdbenefit."|".$hasilbenefit."<br /> rumuspremi = ".$rumuspremi."<br /> premistandar= ".$premistandar."<br /> hasilpremi = ".$hasilpremi."<br />faktor = ".$faktor."<br /> hasilexpirasi=".$hasilexpirasi."<br><br>";

    /*********************************************************************/
		if(is_null($hasilpremi)||is_null($hasilbenefit)||is_null($hasilexpirasi)) {
		  if ((strlen($rumuspremi)==0) && (strlen($rumusbenefit)==0)) {
		    $hasilpremi = 0;
		    $hasilbenefit = 0;
				$hasilexpirasi = NULL;
		  }
			else
			{
			  //echo $rumuspremi."<br />";
			  $FM->parse($rumuspremi);
		    $hasilpremi=$FM->execute($DB);
				//echo "hasil premi = ".$hasilpremi."<br />";

				$FM->parse($rumusbenefit);
				$hasilbenefit=$FM->execute($DB);
				//echo "rumus benefit = ".$rumusbenefit." | ".$hasilbenefit;
				//echo "rumus benefit = ".$rumusbenefit."|| rumuspremi = $rumuspremi<br />";
        //;echo "rumuspremi = ".$rumuspremi."<br />";

				$FM->parse($rumusexpirasi);
        $hasilexpirasi=$FM->execute($DB);

				$FM->parse($rumusakhirpmb);
        $hasilakhirpmb=$FM->execute($DB);

				// premi standar khusus produk anyar JL4XB -- update
				//echo "premilink = ".$premilink;
				/*---------------------------------------------------------------------------*/
    		// ditutup berdasarkan permintaan Ary tgl 24 Juli 2008
    		// tidak ada pengurangan premi rider pada investasi

				if(substr($kdproduk,0,3)=="JL4"){
					 $premistandar = $premilink;
		 		}
				else
				{
				   $premistandar = ($premistandar==0||$premistandar=='') ? $hasilpremi : $premistandar;
				}
		    /*---------------------------------------------------------------------------*/
    		$premistandar = ($premistandar==0||$premistandar=='') ? $hasilpremi : $premistandar;


				if ($kdjenisbenefit=="U") {
//				 	 $hasilpremiu = $hasilpremi; --> Untuk JL4X atau JL4B premistandar sama dengan premi pokok dan premi link.
					 $hasilpremiu = $premilink;
				 	 global $hasilpremiu;
				}

				//echo $kdbenefit."| rumus premi : ".$rumuspremi."|".$premistandar."| hasil premi : ".$hasilpremi."|".$faktor."<br><br>";
				//echo $kdbenefit."|".$rumusexpirasi."|".$hasilexpirasi."<br><br>";
			}
			//echo $kdbenefit."|".$rumuspremi."|".$premistandar."|".$hasilpremi."|".$faktor."<br><br>";
		}	//if


		if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3"){
		    /*---------------------------------------------------------------------------*/
    		// ditutup berdasarkan permintaan Ary tgl 24 Juli 2008
    		// tidak ada pengurangan premi rider pada investasi
				/*
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
				*/
				/*---------------------------------------------------------------------------*/

    		//echo "jenisbenefit : ".$arr["KDJENISBENEFIT"]."=".$hasilpremi."<br />";


    		if($kdbenefit=="KMSTTPJL")
    		{
    		  $benefit_r = $hasilbenefit;
    		}
    		//echo "benefit r = ".$benefit_r."<br />";
    		$pengurangpremi = $premi_r + $benefit_r;
    		//echo "pengurang = ".$pengurangpremi."<br />";
		}

			if($arr["KDBENEFIT"]=="CI" || $arr["KDBENEFIT"]=="TERM" || $arr["KDBENEFIT"]=="DEATHSU65")
			{
			$akumulasiua=$akumulasiua+$hasilbenefit;
			}

    include "./includes/belang.php";
		echo "<td class=verdana8 align=center>$no</td>\n";
		echo "<td class=verdana8>".$kdbenefit."</td>";
		echo "<td class=verdana8>".$namabenefit."</td>";

		/*  kalo 0 jangan diliatin */
		//echo $hasilpremi." * ".$faktor;

    #---------[ penambahan resiko pekerjaan ------------------------------------------------
    if(substr($kdbenefit,0,4)=="RISK"){
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
		//$faktorrisker="select extrapremium*100 as perextrapremi,extrapremium*".$premilink." as extrapremi from $DBUser.tabel_105_pekerjaan where  kdpekerjaan='".$KLN->kdpekerjaan."'";
		$faktorrisker="select sum(premi) as extrapremi from $DBUser.tabel_223_temp where  prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and substr(kdbenefit,1,4)='RISK'";
		//echo $faktorrisker;
		$DB->parse($faktorrisker);
    	$DB->execute();
		$risker=$DB->nextrow();
		//$riskerja=$risker["PEREXTRAPREMI"]." %";
		//$riskerjanya=$risker["PEREXTRAPREMI"];
		$extrapremi=$risker["EXTRAPREMI"];
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
		
		//tambah premi risker
//		$hasilpremi=$hasilpremi+$premi1;
		
    	/*
			echo "Resiko Saat ini : ".number_format($rskg,2)."<br>";
    	echo "Faktor Resiko Pekerjaan : ".$KLN->nilairesiko."<br>";
      echo "Penambahan Resiko : ".number_format($resikokerja,2)."<br>";
		  */
		}
	  #-------------------------------------- end resiko kerja -----------------------------

		if(substr($kdbenefit,0,4)=="RISK"){
		 if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3"){
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
		 if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3"){
					$hasilpremi = ($arr["KDJENISBENEFIT"]=="U") ? $premilink : $hasilpremi;
		 }
		 $test=$hasilpremi!=0 ? number_format($hasilpremi*$faktor,2):'';
		}


		if(substr($kdproduk,0,3)=="JL4" && $kdbenefit=="INVPRDJL")
		{
		  $benfitinvestakhir = $premilink - $pengurangpremi + $bentopupinvest  + $bentopupinvestskg;

			//$tist= number_format($benfitinvestakhir,2);
			

		}
		else
		{
		   $tist=$hasilbenefit!=0 ? number_format($hasilbenefit,2):'';
		   //$tist= number_format(222222,2);
		}

		//JL4 -> tampilkan premi top up
		if($arr["KDBENEFIT"]=="BNFTOPUP"){
		  $premitopup = $arr["PREMI"];
		  $test = number_format($premitopup,2);
		} elseif ($arr["KDBENEFIT"]=="BNFTOPUPSG") {
		  $premitopupskg = $arr["PREMI"];
		  $test = number_format($premitopupskg,2);
		//TARIF RIDER TAHUNAN TIDAK DIKALIKAN FAKTOR BAYAR LAGI
		} elseif (substr($arr["KDBENEFIT"],0,2)=="CP" || $arr["KDBENEFIT"]=="ADBX" || $arr["KDBENEFIT"]=="WAIVER" || $arr["KDBENEFIT"]=="CACAD" || $arr["KDBENEFIT"]=="CI" || $arr["KDBENEFIT"]=="TERM") {
		  $test = number_format($hasilpremi,2);
		} else {
		  $premitopup = "";
			$premitopupskg = "";
		 // $test = $test;
		}

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
		$nilben= ($arr["KDJENISBENEFIT"]=="R" && substr($arr["KDBENEFIT"],0,2)!="CP" ) ? number_format($arr["NILAIBENEFIT"],2) : $tist;
		$prmben= ($arr["KDJENISBENEFIT"]=="R") ? number_format($arr["PREMI"],2) : $test;
		 if($kdproduk=="JL4X" && $arr["KDBENEFIT"]=="DEATHMA")
		 $nilben=number_format(1.25*$hasilpremi,2);
		echo "<td align=right class=verdana8>".$nilben;// premilink =  ".$premilink." - ".$pengurangpremi." + ".$bentopupinvest." + ".$bentopupinvestskg."";
		//echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hasilbenefit.">";
		$hslbnf=(is_null($hasilbenefit)) ? $arr["NILAIBENEFIT"] : $hasilbenefit;
		//echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hasilbenefit.">";
		echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hslbnf.">";
		echo "   <input type=\"hidden\" name=exp".$kdbenefit." value=".$hasilexpirasi."></td>";
		echo "<td align=\"right\" class=verdana8>".$prmben."";
		echo "   <input type=\"hidden\" name=prm".$kdbenefit." value=".$hasilpremi.">";
		echo "   <input type=\"hidden\" name=akh".$kdbenefit." value=".$hasilakhirpmb.">";
		echo "</td>";
		echo "<td align=center class=verdana8blk>".$riskerja."</td>";
		echo "<td align=center class=verdana8blk>".$tast."</td>";
		echo "<td align=center class=verdana8>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "</tr>";


		/*---------------------------------------------------------------------------*/
    // ditutup berdasarkan permintaan Ary tgl 24 Juli 2008
    // tidak ada pengurangan premi rider pada investasi

		/*
		if(substr($kdproduk,0,3)=="JL4"){
					$hasilpremi = ($arr["KDJENISBENEFIT"]=="U") ? $hasilpremi : 0;
		}
		*/
		/*---------------------------------------------------------------------------*/


		//hasil tambahan script oleh DediZ 02/07/2010 14:40 TAMBAHIN R
		//if($arr["KDJENISBENEFIT"]=="R"){


		//--------------------------------------------------
		$jmlpremi = $jmlpremi + ($arr["KDJENISBENEFIT"]=="U" ? $hasilpremi : 0);
		//hasil tambahan script oleh DediZ 02/07/2010 14:40

		//--------------------------------------------------
		$jmlbenefit = $jmlbenefit + $hasilbenefit;

		$jmlpremi_cp+=$premi_cp;
		//echo $hasilpremi;
		$no ++;
		$i++;
$riskerja='';

	} //foreach

 //echo $premisubmit;

					 if ($cabayar=='X' or $cabayar=='E' or $cabayar=='J') {
					 		CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$jmlpremi*$faktor);
					 } else {
  					/*---------------------------------------------------------------------------*/
            // ditutup berdasarkan permintaan Ary tgl 24 Juli 2008
            // tidak ada pengurangan premi rider pada investasi
						/*
					    if(substr($kdproduk,0,3)=="JL4"){
							CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$jmlpremi*$faktor);
							//echo "compcommdisini: premistandar = $premistandar; hasilpremiu = $hasilpremiu; jmlpremi=$jmlpremi";
							}
							else
							{
					 */
				      CompComm($DB,$prefixpertanggungan,$nopertanggungan,$hasilpremiu,$jmlpremi*$faktor);
					 //		}
					 /*---------------------------------------------------------------------------*/
					 }

					 if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3"){
  					 $sql = "select sum(premi) as premirider ".
                      "from $DBUser.tabel_223_temp where substr(kdproduk,1,2)='JL' and kdjenisbenefit='R' ".
                      "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  					 //echo $sql;
						 $DB->parse($sql);
          	 $DB->execute();
          	 $pres=$DB->nextrow();
						 //echo $pres["PREMIRIDER"];
						 //$premirider =  $pres["PREMIRIDER"] * (1.5/100);
						 if ($cabayar=='X')
						 {
						 $premirider = 0;
						 }
						 else
						 {
  					 $premirider =  $pres["PREMIRIDER"] * (1.5/100);
  					 }

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

					 //==================================

					 if($kdproduk=="JSDG0" || $kdproduk=="JSDG0" || $kdproduk=="JSDM0" || $kdproduk=="JSDMPP" || $kdproduk=="JSP" || $kdproduk=="JSSHTT" || $kdproduk=="P30" ||$kdproduk=="SC5" || $kdproduk=="SC6" || $kdproduk=="ST5" || $kdproduk=="ST6"){
  					 $sql = "select sum(premi) as premirider ".
                      "from $DBUser.tabel_223_temp where kdjenisbenefit='R' ".
                      "and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  					 //echo $sql;
						$DB->parse($sql);
          	 			$DB->execute();
          	 			$pres=$DB->nextrow();
						 //echo $pres["PREMIRIDER"];
						 //$premirider =  $pres["PREMIRIDER"] * (1.5/100);
						 if ($cabayar=='4' || $cabayar=='A')
						 {
							$premirider =  $pres["PREMIRIDER"] * (1.5/100);
						 }
						 else
						 {
							$premirider = 0;
						 }

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
					 //==================================
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
	<td align=right><? 
	//echo number_format(($jmlpremi*$faktor)+$premitopup+$premitopupskg,2);  
	echo number_format(($jmlpremi*$faktor)+$premitopup+$premitopupskg,2);	
	?></td>
	<td colspan=3></td>
	</tr>
	<tr class="tblisi1">
	<td colspan="4" align=left>Premi Standar Tahunan</td>
	<td align=right><? 
	//echo number_format($premistandar+$premitopup+$premitopupskg,2); 
	echo number_format($premistandar+$premitopup+$premitopupskg,2); 
	?></td>
	<td colspan=3> </td>
	</tr>
	</table>
	<input type="hidden" name="premilinked" value="<?=$premilink;?>">

</td>
</tr>
</table>
</br>
<table width="100%" cellpadding="1" cellspacing="1" class="tblhead">
<tr class="tblisi1">
 <td>
 <table border=0 width="100%" class=tblisi>
	<tr class=hijao align=center>
	 <td>No</td>
	 <td>Kode</td>
	 <td>Nama Fund</td>
	 <td>Porsi Fund</td>
	</tr>
 <?
 $sql = "select * from $DBUser.TABEL_UL_OPSI_FUND_TEMP A, $DBUser.TABEL_UL_KODE_FUND B where A.KDFUND=B.KDFUND AND prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";


  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();
	$i = 1;
 while ($arr=$DB->nextrow()) {
	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	echo "<td class=verdana8>".$i."</td>";
	echo "<td class=verdana8>".$arr["KDFUND"]."</td>";
	echo "<td class=verdana8>".$arr["NAMAFUND"]."</td>";
	echo "<td class=verdana8 align=center>".$arr["PORSI"]."</td>";
	echo "</tr>";
	$i++;
	}
 ?>

 </table>
 </td>
 </tr>
 </table>
<hr size=1>
<?php
$akumulasiua=$akumulasiua+$jua;
$sql="select resikoawal from $DBUser.TABEL_226_BATAS_RESIKO where (select usia_th from $DBUser.tabel_200_temp a ".
    			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
    				 "and a.nopertanggungan='$nopertanggungan') between batasbawah and batasatas AND KDPRODUK=NVL((SELECT KDPRODUK FROM $DBUser.TABEL_226_BATAS_RESIKO WHERE KDPRODUK='$kdproduk' GROUP BY KDPRODUK),'*')";
$DB->parse($sql);
$DB->execute();
$batasua=$DB->nextrow();
//echo $sql;
//echo $batasua["RESIKOAWAL"].'/'.$akumulasiua;
//echo 'x'.$med;
if ($akumulasiua>$batasua["RESIKOAWAL"] && $med!='M') {
	 echo "<font color=red>Proses proposal harus Medical!, Akumulasi UA (".number_format($akumulasiua,2).") melebihi ketentuan (".number_format($batasua["RESIKOAWAL"],2)."). Ubah proposal menjadi medical atau silakan hubungi bagian Underwriting Head Office</font><br /></br />";
			   //echo "<a href=javascript:window.close()>CLOSE</a>";
				// die;
	}
// cek JUA dan Premi minimal
    	$sql = "select a.kdvaluta,to_char(a.mulas,'DD/MM/YYYY') as tglmulas ".
    	       "from $DBUser.tabel_200_temp a ".
    			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
    				 "and a.nopertanggungan='$nopertanggungan'";
					//echo $sql;
    	$DB->parse($sql);
    	$DB->execute();
      $val=$DB->nextrow();
    	$kdvaluta=$val["KDVALUTA"];
			$tglmulas=$val["TGLMULAS"];

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

if($adacp=="Y")// casplan boleh semua cara bayar
{
  //if(($FM->cabayar==1) || ($FM->cabayar==2) || ($FM->cabayar==3))
	//{
      //echo "CP hanya boleh dengan cara bayar Tahunan atau Sekaligus<br><br>";
  	  //echo "<a href=javascript:window.close()>CLOSE</a>";
  	  //die;
	//}
}

/* --- awal penguncian --*/

if($premijua=="jua"){
  if($premirp >= 100000 || substr($kdproduk,0,2)=="PA") {

		if(substr($kdproduk,0,5)=="JSSPO")
		{
		  //$premicadangan 			= 100000000000;
			$premicadangan 			= 150000000;
			$premijsspohitungan = $jmlpremi;

			//echo $kdproduk;
			//echo "| lama premi : ".$pt." jumlah premi : ".$jmlpremi;

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


//echo $jmlpremi_cp_rp." | CARABAYAR = ".$cabayar." | ".$jmlpremi_cp." | ".$faktor." | ".$idx." | ".$cabayar." | ".$adacp;

// tambahan benefit TOP UP khusus untuk produk JL4 berkala
if(substr($kdproduk,0,3)=="JL4" || substr($kdproduk,0,3)=="JL3")
{
?>
<table>
<?
$minimaltopupberkala = 100000;
//$minimaltopupberkala = 100000; //update by sukendro 17/07/2008
//$minimaltopupberkala = $premistandar * 0.3;

if($cabayar!="X"){ //kalau carabayar sekaligus, hanya pake yg berkala saja
?>
<tr>
<td><font size="2">Premi Top UP Berkala</font></td>
<td>
<?
if($premitopup==""){
?>
<input type="text" name="premitopup" value="<?=$minimaltopupberkala;?>" size="20">
<input type="submit" name="addtopup" value="TAMBAH" />
<?
} else {
?>
<input type="text" name="premitopup" value="<?=$premitopup;?>" size="20">
<input type="submit" name="updatetopup" value="UPDATE" />
<input type="submit" name="deletetopup" value="DELETE" />
<?
}
?>
</td>
</tr>
<?
}
?>
<tr>
<td><font size="2">Premi Top UP Sekaligus</font></td>
<td>
<?
if($premitopupskg==""){
//$minimaltopupsekaligus = $cabayar=="X" ? ($premistandar * 0.3) : 0;
?>
<input type="text" name="premitopupskg" value="<?=$minimaltopupsekaligus;?>" size="20">
<input type="submit" name="addtopupskg" value="TAMBAH" /> 
<font size="2">(Minimal 1000000)</font>
<?
} else {
?>
<input type="text" name="premitopupskg" value="<?=$premitopupskg;?>" size="20">
<input type="submit" name="updatetopupskg" value="UPDATE" />
<input type="submit" name="deletetopupskg" value="DELETE" /> 
<font size="2">(Minimal 1000000)</font>
<?
}
?>
</td>
</tr>
</table>

<table border=0 width="100%" bgcolor="d5e7fd">
<tr>
<td colspan="3" align="center"><font size="2"><b>Entry Porsi Fund</b></font></td>
</tr>
<tr>
<td class=verdana8 align="center"><font size="2">Cek <!--(Pilih 2)--></font></td><td class=verdana8><font size="2">Nama Fund</font></td><td class=verdana8><font size="2">Porsi (%)</font></td>
</tr>
<?
$sqlX="SELECT * from $DBUser.TABEL_UL_KODE_FUND";
$DB->parse($sqlX);
$DB->execute();


//while ($arc=$DB->nextrow()) {
/*echo "<tr><td class=verdana8>".$arc["NAMAFUND"]."</td><td class=verdana8><input size='2' type='text' value=";
if ($arc["KDFUND"]=='EF') { echo "'40'"; }elseif ($arc["KDFUND"]=='BF') { echo "'60'"; } else { echo "'' readonly ";};
echo " name='x".$arc["KDFUND"]."'/></td>";
echo "<td align='center'><input type='checkbox' "; if ($arc["KDFUND"]=='EF') { echo " checked "; }elseif($arc["KDFUND"]=='BF'){ echo " checked "; } else { echo " disabled ";};
echo " name='box1[]' value=".$arc["KDFUND"].$nopertanggungan."></td></tr>";*/
//echo "<tr><td class=verdana8>".$arc["NAMAFUND"]."</td><td class=verdana8><input size='2' type='text' name='x".$arc["KDFUND"]."'/></td>";
//echo "<td align='center'><input type='checkbox' name='box1[]' value=".$arc["KDFUND"].$nopertanggungan."></td></tr>";
//}
while ($arc=$DB->nextrow()) {
echo "<tr>";
echo "<td align='center'><input type='checkbox' onClick='limitCheckbox(this,2)' "; 
echo " name='box1[]' id='boxer' value=".$arc["KDFUND"].$nopertanggungan." onPropertyChange='showHide(x".$arc["KDFUND"].");'></td>";
echo "<td class=verdana8>".$arc["NAMAFUND"]."</td><td class=verdana8><input style='visibility: hidden;' onBlur='limitMax(this);limitMin(this)' id='x".$arc["KDFUND"]."' size='2' type='text' value='0'";
//if ($arc["KDFUND"]=='EF') { echo "'100'"; } else { echo "'' readonly ";};
if ($arc["KDFUND"]=='EF') { echo "'' "; } else { echo "'' ";};
echo " name='x".$arc["KDFUND"]."'/></td>";
//echo "<td align='center'><input type='checkbox' "; if ($arc["KDFUND"]=='EF') { echo " checked "; } else { echo " disabled ";};
echo "</tr>";
}
?>
<!--<tr>
<td align="center"><font size="2"><b>Entry Faktor UA</b></font></td>
<td> <select name="fua" id="select">
<?
	//switch($cabayar){
		//case $cb=;
	//$anp=$jmlpremi*$varcb;
	
	$sql="select * from $DBUser.TABEL_UL_FAKTOR_UA where kdproduk='".$kdproduk."' and usia=".$FM->usia;
	$DB->parse($sql);
	$DB->execute();
	$arfua=$DB->nextrow();

for ($i = $arfua['FAKTORMIN']; $i <= $arfua['FAKTORMAX']; $i++) {
	if($fua==$i) {$sel='selected';} else {$sel='';}
    echo "<option value='$i' ".$sel.">".$i*$premistd."</option>";
}

?>

  </select>
<? //echo $sql;?> <?//=$jmlpremi.$cabayar; ?>
</td><td></td>
</tr>-->
<tr><td></td><td></td><td align="center"><font size="2"><input type="submit" name="sporsi" value="SIMPAN" /></font></td></tr>
</table>
<input type="hidden" name="minpremitopup" value="<?=$minimaltopupberkala;?>" />
<input type="hidden" name="premiakhir" value="<?=$jmlpremi+$premitopup;?>" />
<input type="hidden" name="benfitinvestakhir" value="<?=$benfitinvestakhir;?>" />
<input type="hidden" name="tglmutasi" value="<?=$tglmulas;?>" />
<hr size="1">
<?
}
?>
<!--<table width="100%" cellpadding="1" cellspacing="1" class="tblisi">
<tr class="tblisi1">
<td align=center>Kode Benefit</td>
<td align=center>Nama Benefit</td>
<td align=center>Benefit</td>
</tr>
<? 
 $sql="SELECT   a.kdproduk, a.kdbenefit, b.namabenefit
		  FROM   $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b
		 WHERE       a.kdbenefit = b.kdbenefit
				 AND a.kdproduk = '$kdproduk'
				 AND a.kdjenisbenefit = 'R'
				 AND b.kdbenefit <> 'RATEUP'
				 AND a.kdbenefit LIKE '%'
				 AND b.kdkelompokbenefit IS NULL
				 AND (SUBSTR (a.kdbenefit, 1, 2) <> 'CP'
					  OR (SUBSTR (a.kdbenefit, 1, 3) IN ('CPM', 'CPB')
						  AND NOT (SUBSTR (a.kdbenefit, -3) IN ('RWI', 'ICU', 'BDH'))))
		UNION
		SELECT   a.kdproduk, a.kdbenefit, b.namabenefit
		  FROM   $DBUser.tabel_206_produk_benefit a, $DBUser.tabel_207_kode_benefit b
		 WHERE       a.kdbenefit = b.kdbenefit
				 AND a.kdproduk = '$kdproduk'
				 AND a.kdjenisbenefit = 'R'
				 AND b.kdbenefit <> 'RATEUP'
				 AND b.kdkelompokbenefit IN ('B', 'E', 'D', 'T', 'C')
				 AND b.faktorbenefit <> 'X'
				 AND (SUBSTR (a.kdbenefit, 1, 2) <> 'CP'
					  OR (SUBSTR (a.kdbenefit, 1, 3) IN ('CPM', 'CPB')
						  AND NOT (SUBSTR (a.kdbenefit, -3) IN ('RWI', 'ICU', 'BDH'))))";		 
//echo $sql;
	$DB->parse($sql);
	$DB->execute();
$i = 1;
while ($arr=$DB->nextrow()) {
	include "./includes/belang.php";
	print  ("<td class=verdana8>".$arr["KDBENEFIT"]."</td>\n" );
	print  ("<td class=verdana8>".$arr["NAMABENEFIT"]."</td>\n" );
	if ($arr["KDBENEFIT"]=='PBD' || $arr["KDBENEFIT"]==PBTPD) {
	print  ("<td class=verdana8>".$jmlpremi."</td>\n" );} else {
	print  ("<td class=verdana8>".$fua*$jmlpremi."</td>\n" );
	}
	echo "</tr>";
	$i++;
	}
	
	?>
</table>-->
<?
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
		<input type="hidden" name="kodeproduk" value="<? echo $kdproduk; ?>">
		<input type="hidden" name="noagen" value="<? echo $noagen; ?>">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"Nilai Tebus\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s','popuptebus',400,500,1);\">",$jua,$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"Komisi\" onclick=\"NewWindow('popupkom.php?cabayar=%s&prefixpertanggungan=%s&nopertanggungan=%s&noproposal=%s&noagen=%s&premi1=%s','popupkomisi',650,450,1);\">",$cabayar,$prefixpertanggungan,$nopertanggungan,$noproposal,$noagen,$jmlpremi); ?>
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