<? 
  include "../../includes/common.php";
	include "../../includes/database.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";
	
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
	$DB=New database($userid, $passwd, $DBName);
  $FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);

	function GetFormula($DBX,$kdrumus) {
	  $sql="select rumus from $DBUser.tabel_224_rumus ".
		     "where kdrumus='$kdrumus'";
   	$DBX->parse($sql);
    $DBX->execute();
    $arr=$DBX->nextrow();
		$rumus=$arr["RUMUS"];
		return $rumus;
	}
	
	function CompComm($DBX,$prefix,$noper,$premistd,$p1) {
		$sql="begin $DBUser.compcomm('$prefix','$noper',$premistd,$p1); end;";
		//echo $sql;
		$DBX->parse($sql);
		$DBX->execute();
		return;
	}
	
	function CompComm1($DBX,$prefix,$noper,$premisum,$premistd) {
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
	 echo "";
	 //echo $hasil."<br>";
	 $premistandar+=$hasil;
	}

	if (!$kdcarabayarlama=='') {
	 $sql="update $DBUser.tabel_200_temp set kdcarabayar='$kdcarabayarlama',premistd=$premistandar ".
			  "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
	}
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();
	$DB->commit();
	     
if ($nopertanggungan <> $noproposal) {	  	
	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, ".
			 "a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit, b.kdrumusakhirpmb ".
       "from $DBUser.tabel_223_temp a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+)";
} else {
	$sql="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit, ".
			 "a.expirasi,b.kdrumusbenefit, b.kdrumuspremi, b.kdrumusexpirasi,c.namabenefit, b.kdrumusakhirpmb ".
       "from $DBUser.tabel_223_temp a, $DBUser.tabel_200_temp x, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan=x.prefixpertanggungan and a.nopertanggungan=x.nopertanggungan ".
			 "and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+)";
}

  //echo $sql;		 
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
			$expirasi = ${"exp".$kdbenefit};  if (strlen($expirasi)==0) $expirasi="";
      // edit panjang tanggal JSP
			$akhirpembayaran = ${"akh".$kdbenefit};			
			$akhirpmb = ($akhirpembayaran==""||is_null($akhirpembayaran)||strlen($akhirpembayaran)<10) ? 'NULL' : "to_date('".$akhirpembayaran."','DD/MM/YYYY')";
			$expir = ($expirasi==""||is_null($expirasi)||strlen($expirasi)<10) ? 'NULL' : "to_date('".$expirasi."','DD/MM/YYYY')";      
		
			if($kdbenefit=="RISKER"){ //resiko kerja rumus salah harusnya faktor resiko X faktor resiko kerja
  			$sql="update $DBUser.tabel_223_temp ".
  			     "set premi=$resikokerja, nilaibenefit=$benefit,expirasi=$expir,".
  					 "akhirpmb=$akhirpmb ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			} else {
  			$sql="update $DBUser.tabel_223_temp ".
  			     "set premi=$premi, nilaibenefit=$benefit,expirasi=$expir,".
  					 "akhirpmb=$akhirpmb ".
    	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
  			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			}
			//echo $sql."<BR><BR>";
			$DB->parse($sql);
      $DB->execute();
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

		$sqlx2 = "select sum(premi) premi2jsp ".
				   	 "from $DBUser.tabel_223_temp ".
				   	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 	 "and kdbenefit not in ('WAIVER','EXTPREM')";
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
		
	  // Khusus perlakuan JSP diupdate tgl 9 okt 2003 by agus n kd
		if($kdproduk=="JSP"){
				$premistandar=$premix2;
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
	 	}	else if ($FM->cabayar=='X') {   //or $FM->cabayar=='E') { di komen tgl 07/10/2004
		  $premi2=0;
		}	else if ($FM->cabayar=='J' or $FM->cabayar=='E'){				 
		 
  		 if($kdproduk=="DMP"){
    				$premi2=$premi2dmp / 1.05;
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
		
		echo "JUA :".$jua1." | premi2 :".$premi2." premistandar  $premistd<br><br>";
		
    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
	  if ($jua1==0) {
     print( "	 alert('Nilai JUA Nol, Kemungkinan Belum Ada Tarifnya')\n" );
	   echo "window.opener.document.ntryprop.submit.disabled=true;";
	  }
	  printf ("window.opener.document.ntryprop.premi2.value='%s';".
					  "window.opener.document.ntryprop.juamainproduk.value='%s';".
					  "window.opener.document.ntryprop.premistd.value='%s';",$premi2,$jua1,$premistd);
	  print("window.close()");
    print("//-->\n" );
    print("</script>\n" );
	 } 
	 break;
	 
	 case 'jua' : {
		$sql = "select premi from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				   "and kdjenisbenefit='X' ";
		$DB->parse($sql);
    $DB->execute();
		$ari=$DB->nextrow();
		$extra = $ari["PREMI"];
		
		#-------------------------[ JSP START ]-----------------------------------------------
	  $sqlx1 = "select sum(premi) premi1jsp ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdbenefit <>'WAIVER2' ";
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

		#-------------------------[ JSP END ]-----------------
		// perlakuan khusus untuk produk JSP
		if($kdproduk=="JSP"){
		    $premiup=$premix2;
				$jmlpremi=$premix1;
		} else {
			  $premiup= $jmlpremi-$extra;
		}
		
		if ($FM->kdjeniscb=='B') { //cara bayar berkala	
				$p2 = $premiup * $faktor;
				$p1 = $jmlpremi * $faktor;
		} else if ($FM->cabayar== 'X')  {
				$p2=0;
				$p1=$jmlpremi  * $faktor;
		} else if ($FM->cabayar == 'J'or $FM->cabayar== 'E'){
				$p1=$jmlpremi * $faktor;
			
			   if($kdproduk=="DMP"){
            $p2=$p1 /1.05 ;
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
    # 
    #-----[ PERHITUNGAN TAMBAHAN RESIKO PEKERJAAN ]------------------------------------------ 
    # 
		echo "premi std = ".number_format($premistd,2)."<br>";
		echo "premi 1 = ".number_format($p1,2)."<br>";
		echo "premi 2 = ".number_format($p2,2)."<br>";
		echo "resiko pekerjaan = ".number_format($jmlresikokerja,2)."<br>";
		echo "Premi 1 akhir = ".number_format($premi1akhir,2)."<br>";
		echo "Premi 2 akhir = ".number_format($premi2akhir,2)."<br>";
		
	  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
	  if ($p1 == 0) {
     print( "	 alert('Nilai Premi Nol, Periksa Lagi atau Mungkin Belum Ada Tarifnya')\n" );
	   echo "window.opener.document.ntryprop.submit.disabled=true;";
	  }
	  printf ("window.opener.document.ntryprop.premi1.value='%s';".
					  "window.opener.document.ntryprop.premi2.value='%s';".
						"window.opener.document.ntryprop.premistd.value='%s';",$p1,$p2,$premistd);
	  print( "window.close()");
    print( "//-->\n" );
    print( "</script>\n" );

	 } 	break;
	}  //switch
		
		$sql = "update $DBUser.tabel_200_temp set premistd=$premistd ".
				 	 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";
		$DB->parse($sql);
		$DB->execute();
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
	  print( "		window.opener.document.ntryprop.submit.disabled=true;\n" );
	  print( "		window.opener.document.ntryprop.cekpolis.disabled=false;\n" );
	  print( "		window.opener.document.ntryprop.buton.disabled=true;\n" );
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

</head>
<body>
<form name="propmtc14" method="POST" action="<? PHP_SELF; ?>">
<b>Benefit Produk</b>
<hr size="1">
<table width="100%" cellpadding="1" cellspacing="1">
<tr>
 <td>
 <table width="100%" cellpadding="1" cellspacing="0">
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

<hr size=1>
<table width="100%" cellpadding="1" cellspacing="1">
<tr>
 <td>
 <table border=0 width="100%">
	<tr align=center>
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
		//echo $kdrumus."|".$rumuspremi;
 	  $kdrumus = $arr["KDRUMUSBENEFIT"];
		$rumusbenefit = GetFormula($DB,$kdrumus);
		$kdrumus = $arr["KDRUMUSEXPIRASI"];
		$rumusexpirasi = GetFormula($DB,$kdrumus);
		$kdrumus = $arr["KDRUMUSAKHIRPMB"];
		$rumusakhirpmb = GetFormula($DB,$kdrumus);
		//echo $rumusakhirpmb;
		if ($kdjenisbenefit=="R") {  //Additional benefit
			$FM->add1 = $arr["PERIODEBAYAR"];
			$FM->add2 = $arr["PERIODEBENEFIT"];
		}
		$hasilpremi = $arr["PREMI"];
		$hasilbenefit = $arr["NILAIBENEFIT"];
		//echo $hasilbenefit;
   /*********************************************************************/ 
		if(is_null($hasilpremi)||is_null($hasilbenefit)||is_null($hasilexpirasi)) {
		  if ((strlen($rumuspremi)==0) && (strlen($rumusbenefit)==0)) {
		    $hasilpremi = 0;
		    $hasilbenefit = 0;
				$hasilexpirasi = NULL;
		  } else {	
			  $FM->parse($rumuspremi);
		    $hasilpremi=$FM->execute($DB);
				$FM->parse($rumusbenefit);
        $hasilbenefit=$FM->execute($DB);	
				$FM->parse($rumusexpirasi);
        $hasilexpirasi=$FM->execute($DB);
				$FM->parse($rumusakhirpmb);
        $hasilakhirpmb=$FM->execute($DB);
		
				$premistandar = ($premistandar==0||$premistandar=='') ? $hasilpremi : $premistandar;
				if ($kdjenisbenefit=="U") {
				 $hasilpremiu = $hasilpremi;
				 global $hasilpremiu;
				}
			}		
		}	//if
   include "../../includes/belang.php";
		echo "<td align=center>$no</td>\n";
		echo "<td>".$kdbenefit."</td>";
		echo "<td>".$namabenefit."</td>";
		
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
  	}	
	  #-------------------------------------- end resiko kerja -----------------------------
		if($kdbenefit=="RISKER"){
		 $test=number_format($resikokerja,2);
		 $hasilpremi=$resikokerja;
		} else {
		 $test=$hasilpremi!=0 ? number_format($hasilpremi*$faktor,2):'';
		}
		$tist=$hasilbenefit!=0 ? number_format($hasilbenefit,2):'';
		$tast=(strlen($hasilexpirasi)==10) ? $hasilexpirasi : '';
		echo "<td align=right>".$tist." ";
		echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hasilbenefit."></td>";
		echo "   <input type=\"hidden\" name=exp".$kdbenefit." value=".$hasilexpirasi.">";
		echo "<td align=\"right\">".$test." ";
		echo "   <input type=\"hidden\" name=prm".$kdbenefit." value=".$hasilpremi.">";
		echo "   <input type=\"hidden\" name=akh".$kdbenefit." value=".$hasilakhirpmb.">";
		echo "</td>";
		echo "<td align=centerblk>".$tast." </td>";
		echo "<td align=center>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "</tr>";
		
		$jmlpremi = $jmlpremi + $hasilpremi; 

		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		$no ++;
		$i++;
		
	} //foreach
 //ganti dari jmlpremiu ke jmlpremi(premi tahunan);
					 if ($cabayar=='X' or $cabayar=='E' or $cabayar=='J') {
					 		CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$jmlpremi*$faktor);
					 } else {
				      CompComm($DB,$prefixpertanggungan,$nopertanggungan,$hasilpremiu,$jmlpremi*$faktor);
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
	<tr>
	<td colspan="4" align=left>Premi Yang Harus Dibayar Secara <? echo $cabar; ?></td>
	<td align=right><? echo number_format($jmlpremi*$faktor,2); ?></td>
	<td colspan=2></td>
	</tr>
	<tr>
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
    	$sql = "select a.kdvaluta ".
    	       "from $DBUser.tabel_200_temp a ".
    			   "where a.prefixpertanggungan='$prefixpertanggungan' ".
    				 "and a.nopertanggungan='$nopertanggungan'";
    	$DB->parse($sql);
    	$DB->execute();
      $val=$DB->nextrow();
    	$kdvaluta=$val["KDVALUTA"];
			
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


if($premijua=="jua"){
  if($premirp >= 100000 || substr($kdproduk,0,2)=="PA") {
	  //echo "ok";
		//echo $premirp;
	} else {
		echo "Premi hitung kurang dari syarat minimal (Rp. 100.000,-), proses tidak dapat dilanjutkan<br>".
				 "Tingkatkan JUA sampai premi mecapai syarat minimal! <br><br>";
		echo "<a href=javascript:window.close()>CLOSE</a>";
		die;
	};
}

if ($juarp >= $juaminimal || $juaminimal==""){
?>
<table width="100%">
<tr>
  <td><a href="simulasi_benefit.php?state=0&premijua=<?echo $premijua;?>&noproposal=<?echo $noproposal;?>&nopertanggungan=<?echo $nopertanggungan;?>&prefixpertanggungan=<?echo $prefixpertanggungan;?>&kdper=<?echo $kdper;?>&vara=<?echo $vara;?>&kdproduk=<?echo $kdproduk;?>">Back</a></td>
	<td align="right">
	  <input type="hidden" name="mode" value="insert">
	  <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
	  <input type="hidden" name="premistd" value="<? echo $premistandar; ?>">
	  <input type="hidden" name="jmlpremi" value="<? echo $jmlpremi; ?>">
	  <input type="hidden" name="jmlbenefit" value="<? echo $jmlbenefit; ?>">
		<input type="hidden" name="resikokerja" value="<? echo $resikokerja; ?>">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"Nilai Tebus\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s','popuptebus',400,500,1);\">",$jua,$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"Komisi\" onclick=\"NewWindow('popupkom.php?cabayar=%s&prefixpertanggungan=%s&nopertanggungan=%s&noproposal=%s&noagen=%s','popupkomisi',500,350,1);\">",$cabayar,$prefixpertanggungan,$nopertanggungan,$noproposal,$noagen); ?>
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
