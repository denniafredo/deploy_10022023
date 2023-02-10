<?
	include "./includes/common.php";
  include "./includes/session.php";	 
  include "./includes/database.php";
  //include "./includes/koneksi.php";
  include "./includes/pertanggungan.php";
  include "./includes/klien.php";
  
if($norekening!="1190002197521"){ //Untuk mencegah penyalahgunaan rekening jiwasraya oleh Dedi 13/12/2011
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
  /******************MURNI UNTUK INSERT BARU****************************************/
	
	function GetNewPropNo($DBX)	{
		include "../../../includes/common.php";
	  //$query = "select max(nopertanggungan) as maxnopert from $DBUser.tabel_200_pertanggungan ";
	  $query = "SELECT $DBUser.NOPOL.NEXTVAL as maxnopert FROM DUAL";
	  $DBX->parse($query);
		$DBX->execute();
		$arr = $DBX->nextrow();
		$maxnopert = $arr["MAXNOPERT"];
		if (strlen($maxnopert)==0) {
		  $maxnopert = "000000001";
		} else {
      $newnopert = $maxnopert;
		  $maxnopert = str_pad($newnopert,9,"0",STR_PAD_LEFT);
		} 
		return $maxnopert;
	}		 
	
	$DB=New database($userid, $passwd, $DBName);
	$DB2=New database($userid, $passwd, $DBName);
	$DA=New database($userid, $passwd, $DBName);
	$DC=New database($userid, $passwd, $DBName);
	$kdstatusfile='1';
	
if ($mode='edit'){
	
	//delete dulu ahli waris
	$sql = "select count(*) jml from $DBUser.tabel_219_temp ".
			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";	
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();	  
	$arf=$DB->nextrow();
	if (!$arf["JML"]==0) {
	 $sql = "delete from $DBUser.tabel_219_pemegang_polis_baw ".
			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";	
  }
	//echo $sql;
	$DA->parse($sql);
	$DA->execute();	  
	$DA->commit();
}
		
if ($noproposal=='' || strlen($noproposal==0) || !$noproposal) {
	
	$noproposal = GetNewPropNo($DB);
	
	if ($submit){
	
	$sql = "insert into $DBUser.tabel_200_pertanggungan ".
      			 	 "(prefixpertanggungan,kdpertanggungan,notertanggung,gadaiotomatis, ".
      			   "nosp,nopertanggungan,tglsp,nobp3,tglbp3,kdproduk,mulas,usia_th,usia_bl,expirasi,tglakhirpremi,lamaasuransi_th, ".
      				 "lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,premi1,kdcarabayar, ".
      				 "indexawal,premi2,nopenagih,kdstatusfile,noagen,tglrekam,userrekam,tglupdated,userupdated, ".
      				 "kdstatusmedical,nopemegangpolis,nopembayarpremi,premistd,nopol,risk,premirider,".
      				 "autodebet,kdbank,norekeningdebet,premiumholiday,tgltransfer,jmltransfer,nopolswitch,taltup".
							 ") ".
				 "select ".
				 			 "prefixpertanggungan,kdpertanggungan,notertanggung,gadaiotomatis, ".
      				 "nosp,'$noproposal',tglsp,nobp3,tglbp3,kdproduk,mulas,usia_th,usia_bl,expirasi,tglakhirpremi,lamaasuransi_th, ".
      				 "lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,$premi1,kdcarabayar, ".
      				 "indexawal,$premi1,nopenagih,kdstatusfile,noagen,tglrekam,userrekam,tglupdated,userupdated, ".
      				 "kdstatusmedical,nopemegangpolis,nopembayarpremi,premistd,prefixpertanggungan||'$noproposal',risk,premirider, ".
      				 "'$autodebet','','$norekening',premiumholiday,tgltransfer,jmltransfer,nopolswitch,taltup ".
				 "from 	$DBUser.tabel_200_temp ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
	//echo $sql;
	//die;
	$DB->parse($sql);
   if ($DB->execute()) {
   	  if($kdproduk=="JSSP" || $kdproduk=="JSSK" || $kdproduk=="JSSPA" || $kdproduk=="JSSPA6" || $kdproduk=="JSSP6" || $kdproduk=="JSSPAN3" || $kdproduk=="JSSPAN6" || $kdproduk=="JSSPAN12" || $kdproduk=="JSSPAN24")
		{
		$sql="update $DBUser.tabel_200_pertanggungan set mulas=tgltransfer, tglakhirpremi=add_months(mulas,lamapembpremi_th*12), expirasi=add_months(mulas,lamaasuransi_th*12) ".
		 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		 $DB->parse($sql);
  		 $DB->execute();
		}
	  $query = "SELECT $DBUser.UL_NOKLIEN.NEXTVAL as noidnasabah FROM DUAL";
	  $DC->parse($query);
	  $DC->execute();
	  $arr = $DC->nextrow();
	  $noidnasabah = $arr["NOIDNASABAH"];
	  
	  $sql = "delete $DBUser.TABEL_UL_OPSI_FUND ".
			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";

      $DB->parse($sql);
  	  $DB->execute();
	  
		//$sql = "insert into $DBUser.TABEL_UL_OPSI_FUND (prefixpertanggungan,nopertanggungan,kdfund,porsi, status,tglrekam,userrekam, tglefektif, idnasabah) ".
		//           " select prefixpertanggungan,'$noproposal',kdfund,porsi, status,tglrekam,userrekam, trunc(sysdate), 
		//  replace(to_char(sysdate,'yyyymmdd')||to_char(".$noidnasabah.",'0000000'),' ','') from $DBUser.TABEL_UL_OPSI_FUND_TEMP ".
		//  " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";

		//$DB->parse($sql);
		//$DB->execute();

  	  	$sql_idn = "SELECT prefixpertanggungan, nopertanggungan, kdfund, porsi, status, userrekam
					FROM $DBUser.TABEL_UL_OPSI_FUND_TEMP 
					WHERE prefixpertanggungan='$prefixpertanggungan' 
						AND nopertanggungan='$nopertanggungan'";
		// echo $sql_idn;
		$DB->parse($sql_idn);
		$DB->execute();

		while ($arr_idn=$DB->nextrow()) {
			// echo "CEK : ".$arr_idn["KDFUND"]."</br>";

			$sql_i = "INSERT INTO $DBUser.TABEL_UL_OPSI_FUND (
							prefixpertanggungan,
							nopertanggungan,
							kdfund,
							porsi,
							status,
							tglrekam,
							userrekam,
							tglefektif, 
							idnasabah)
						VALUES(
							'".$arr_idn["PREFIXPERTANGGUNGAN"]."',
							'$noproposal',
							'".$arr_idn["KDFUND"]."',
							".$arr_idn["PORSI"].",
							'".$arr_idn["STATUS"]."',
							SYSDATE,
							'".$arr_idn["USERREKAM"]."',
							trunc(sysdate),
							replace(to_char(sysdate,'yyyymmdd')||to_char(".$noidnasabah.",'0000000'),' ','')
						)";
			// echo $sql_i."</br>";
			$DB2->parse($sql_i);
			$DB2->execute();
		}


	 //echo $sql;
	  $sql = "insert into $DBUser.tabel_223_transaksi_produk(prefixpertanggungan,nopertanggungan,kdproduk,expirasi,akhirpmb, ".
				 	 "kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,tglmutasi) ".
					 "select prefixpertanggungan,'$noproposal',kdproduk,expirasi,akhirpmb, ".
					 "kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,tglmutasi ".
					 "from $DBUser.tabel_223_temp ".
					 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		$DB->parse($sql);
  		$DB->execute();
	
	// JS Hospital Care Tertanggung
	 $sql="INSERT INTO $DBUser.TABEL_219_HOSPITAL (PREFIXPERTANGGUNGAN,
                                     NOPERTANGGUNGAN,
                                     KDINSURABLE,
                                     NOTERTANGGUNG,
                                     NOKLIEN,
                                     NOURUT)
									 select PREFIXPERTANGGUNGAN,
                                     '$noproposal',
                                     KDINSURABLE,
                                     NOTERTANGGUNG,
                                     NOKLIEN,
                                     NOURUT from $DBUser.TABEL_219_HOSPITAL_TEMP
									 where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'"; 
	$DB->parse($sql);
  	$DB->execute();
	//echo $sql;
	//============
									 
	$sql="begin $DBUser.insdocmed('$prefixpertanggungan','$noproposal'); end;";
	$DB->parse($sql);
  	$DB->execute();
	
		$sql = "update $DBUser.tabel_200_pertanggungan  set juamainproduk='$juamainproduk',premi1='$premi1',premi2='$premi2' ".
		  		 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal' ";
		$DB->parse($sql);
		$DB->execute();	  
  
  	//cari data proposal sementara 
  	$sql = "select ".
  			 	 	 "kdproduk,nosp,tglsp,kdvaluta,kdcarabayar,mulas,nopenagih,juamainproduk,noagen,".
    				 "nopemegangpolis,expirasi,tglakhirpremi,indexawal,nobp3,tglbp3,gadaiotomatis,premistd, ".
    				 "nopembayarpremi,kdstatusmedical,premi1,premi2,lamaasuransi_th,".
  					 "lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,usia_th,usia_bl,".
  					 "tglupdated,userupdated,risk ".
  				 "from $DBUser.tabel_200_temp ". 
  				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  	$DB->parse($sql);
  	$DB->execute();
    $pro=$DB->nextrow();
  	$kdproduk=$pro["KDPRODUK"];
  	$kdvaluta=$pro["KDVALUTA"];
  	$mulas=$pro["MULAS"];
		
		// tambahan produk savingplan
		if($kdproduk=="JSSP" || $kdproduk=="JSSK" || $kdproduk=="JSSPA" || $kdproduk=="JSSPA6" || $kdproduk=="JSSP6" || $kdproduk=="JSSPB1" || $kdproduk=="JSSPAB1" || $kdproduk=="JSSPAN3" || $kdproduk=="JSSPAN6" || $kdproduk=="JSSPAN12" || $kdproduk=="JSSPAN24")
		{
			//if ($kdproduk=="JSSPA6" || $kdproduk=="JSSP6") {$bln=6;} else {$bln=12;}
  		$sql = "insert into $DBUser.tabel_223_transaksi_savingplan ".
             "select prefixpertanggungan, nopertanggungan, premi1,tglpenawaranstart, tglpenawaranend, bunga,".
                "add_months(mulas,12), '0',null,null,mulas,null,juamainproduk, ".
				"POWER((1+bunga),DECODE(a.KDPRODUK,'JSSPAN24',2,1))*premi1,sysdate ".
               /* "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
                "where prefixpertanggungan=a.prefixpertanggungan ".
								"and nopertanggungan=a.nopertanggungan ".
                "and kdbenefit='EXPPREMI') ".*/
             "from ".
						 		"$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_999_bunga_savingplan b ".
             //"where kdproduk in ('JSSP','JSSK') ".
			 "where a.kdproduk ='$kdproduk' and b.kdproduk ='$kdproduk' ".
			 					"and premi1 between premimin and premimax ".
						 		"and tgltransfer between tglmulasstart and tglmulasend ".
                "and kode='N' and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal'";
    	//echo $sql;
			$DB->parse($sql);
    	$DB->execute();
		}
	
		//cek apakah ada tambahan produk JSAP12
  	$sql = "select ".
    			 	 "prefixpertanggungan,nopertanggungan,kdproduk,".
    			 	 "kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,".
  					 "periodebenefit,expirasi,akhirpmb ".
  				 "from ".
  				 	 "$DBUser.tabel_223_temp ".
  				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
  				   "kdjenisbenefit='R'";
  	$DB->parse($sql);
  	$DB->execute();
    $jsap=$DB->nextrow();
  	$kdbenefit=$jsap["KDBENEFIT"];
		$expirasi=$jsap["EXPIRASI"];
  	$kdjenisbenefit=$jsap["KDJENISBENEFIT"];
  	$p1=$jsap["PREMI"];
  	
  	//echo "Rider : ".$kdbenefit." ".$kdjenisbenefit." premi = ".$p1." ?<br><br>";
  	if($kdjenisbenefit=="R")
  	{
  	//delete dulu 
  			  $sql="delete $DBUser.tabel_603_mutasi_pert ".
  					 	 "where prefixpertanggungan='$prefixpertanggungan' and ".
  						 "nopertanggungan='$noproposal' and ".
  						 "kdmutasi='21' and tglmutasi='$mulas'";
      		$DB->parse($sql);
      		$DB->execute();	  
      		$DB->commit();
  	
  	//insert ke table 603_mutasi_pert		 
  			  $sql="insert into $DBUser.tabel_603_mutasi_pert ".
  					 	 "(prefixpertanggungan,nopertanggungan,kdmutasi,tglmutasi,".
  						 "kdproduk,mulas,kdvaluta,kdcarabayar,juamainproduk,premi1,premi2,".
  						 "lamapembpremi_th,lamapembpremi_bl,expirasi,status) values ".
  						 "('$prefixpertanggungan','$noproposal','21','$mulas',".
  						 "'$kdproduk','$mulas','$kdvaluta','$kdcarabayar','$juamainproduk','$p1','$p1',".
  						 "'$lamapembpremi_th','$lamapembpremi_bl','$expirasi','0')";
      		$DB->parse($sql);
      		$DB->execute();	  
      		$DB->commit();
  				//echo $sql;
  	}
		
	 } else {
	 echo $nopropos;
 	  print ("<body bgcolor=#ccccff><div align=center><font face=Verdana size=3><b>Proses Gagal, Mohon Submit Ulang</b></font><br>");
   	print( "<a href=\"".$PHP_SELF."?submit=1&prefixpertanggungan=".$prefixpertanggungan."&nopertanggungan=".$nopertanggungan."&juamainproduk=".$juamainproduk."&premi1=".$premi1."&premi2=".$premi2."\" ><font size=\"2\" face=\"Verdana\">Ulang</font></a>\n" );
		die;
	 }
	} //submit
	
} 
else 
{ //proposal bayar di depan,noproposal udah ada,
	//$noproposal=&$noproposal;
	//echo $submit;
	if ($submit && (!strlen($noproposal)==0)){
	  $sql = "update $DBUser.tabel_200_pertanggungan  set (premistd,nopol,tglbp3,nobp3,notertanggung,kdproduk,nosp,".
				   "tglsp,kdvaluta,kdcarabayar,mulas,nopenagih,juamainproduk,noagen,nopemegangpolis,expirasi,tglakhirpremi,indexawal,gadaiotomatis, ".
		 	 		 " nopembayarpremi,kdstatusmedical,premi1,premi2,lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,usia_th,usia_bl,tglupdated,userupdated,risk,premirider,premiumholiday,tgltransfer,jmltransfer)".
					 " = (select premistd,prefixpertanggungan||'$noproposal',tglbp3,nobp3,notertanggung,kdproduk,nosp,tglsp,kdvaluta,kdcarabayar,mulas,nopenagih,$juamainproduk,".
					 " noagen,nopemegangpolis,expirasi,tglakhirpremi,indexawal,gadaiotomatis, ".
					 " nopembayarpremi,kdstatusmedical,$premi1,$premi2,lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,usia_th,usia_bl,tglupdated,userupdated,risk,premirider,premiumholiday,tgltransfer,jmltransfer ".
					 " from $DBUser.tabel_200_temp". 
					 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan') ".
					 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal' ";
	  /*
		echo $nopertanggungan."<br><br>";
		echo $noproposal."<br><br>";
		echo $sql;
		*/
		$DB->parse($sql);
/*		
	  $DB->execute();	  
	
		$sql = "update $DBUser.tabel_200_pertanggungan  set juamainproduk='$juamainproduk', premi1='$premi1',premi2='$premi2' ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal' ";
	  $DB->parse($sql);
*/
		if ($DB->execute()) {	  
	
		 $sql="begin $DBUser.insdocmed('$prefixpertanggungan','$noproposal'); end;";
		
		 $DB->parse($sql);
  	 	 $DB->execute();
		 $DB->commit();
		 //$sql="begin $DBUser.premipayment2('$prefixpertanggungan','$noproposal'); end;";
		 //echo $sql;
			
  	 $DB->parse($sql);
		 if ($DB->execute()) {	  
		 $sql = "insert into $DBUser.tabel_223_transaksi_produk(prefixpertanggungan,nopertanggungan,kdproduk,".
			 	   " kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,expirasi,akhirpmb,tglmutasi)".
				   " select prefixpertanggungan,'$noproposal',kdproduk,".
				   " kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,expirasi,akhirpmb,tglmutasi".
				   " from $DBUser.tabel_223_temp".
				   " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  	 $DB->parse($sql);
  		if ($DB->execute()) {
			 echo "Sukses";
			 // tambahan produk savingplan
  		$sql = "insert into $DBUser.tabel_223_transaksi_savingplan ".
             "select prefixpertanggungan, nopertanggungan, premi1,tglpenawaranstart, tglpenawaranend, bunga,".
                "add_months(mulas,12), '0',null,null,mulas,null,juamainproduk, ".
				"POWER((1+bunga),DECODE(a.KDPRODUK,'JSSPAN24',2,1))*premi1,sysdate ".
               /* "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
                "where prefixpertanggungan=a.prefixpertanggungan ".
								"and nopertanggungan=a.nopertanggungan ".
                "and kdbenefit='EXPPREMI') ".*/
             "from ".
						 		"$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_999_bunga_savingplan b ".
             //"where kdproduk in ('JSSP','JSSK') ".
			 "where a.kdproduk ='$kdproduk' and b.kdproduk ='$kdproduk' ".
			 					"and premi1 between premimin and premimax ".
						 		"and tgltransfer between tglmulasstart and tglmulasend ".
                "and kode='N' and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal'";
			//echo $sql;	
    	$DB->parse($sql);
    	$DB->execute();
		
			} else {
			 echo "Gagal";
			}  
     }
		}  							 
	} //submit
} //else if


		//delete dulu ahli waris
	$sql = "select count(*) jml from $DBUser.tabel_219_temp ".
			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";	
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();	  
	$arf=$DB->nextrow();
	if (!$arf["JML"]==0) {
	 $sql = "delete from $DBUser.tabel_219_pemegang_polis_baw ".
			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";	
  }//echo $sql;
	$DB->parse($sql);
	$DB->execute();	  
	$DB->commit();
	
	$sql = "insert into $DBUser.tabel_219_pemegang_polis_baw(prefixpertanggungan,nopertanggungan,notertanggung,nourut,kdinsurable,noklien) ".
			   "select prefixpertanggungan,'$noproposal',notertanggung,nourut,kdinsurable,noklien ".
				 "from $DBUser.tabel_219_temp ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
  //echo $sql;
	$DB->parse($sql);
	$hasil=$DB->execute();
	if (!$hasil) {
	 //echo "Insert Tabel 219 Gatal";
	} else {
	 $sql = "delete from $DBUser.tabel_219_temp ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
   $DB->parse($sql);
	 $DB->execute();
	}
			
				 
	$sql = "update $DBUser.tabel_404_temp set nopertanggungan='$noproposal' ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
  $DB->parse($sql);
	$DB->execute();	  
	$DB->commit();

  $sql = "delete from $DBUser.tabel_247_pertanggungan_basis ".
	 			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
  $DB->parse($sql);
	$DB->execute();	
	$DB->commit();
  $sql = "insert into $DBUser.tabel_247_pertanggungan_basis(prefixpertanggungan,nopertanggungan,kdbasispremi,kdbasistebus,kdbasisskg,kdbasiscwa,kdbasisbayar) ".
			   "select '$prefixpertanggungan','$noproposal',kdbasispremi,kdbasistebus,kdbasisskg,kdbasiscwa,kdbasisbayar from $DBUser.tabel_247_temp ".
	 			 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
  $DB->parse($sql);
	$DB->execute();	
	$DB->commit();
		//$sql = "delete from $DBUser.tabel_247_temp ".
					 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		//echo $sql;		
		$DB->parse($sql);
  	$DB->execute();
		$DB->commit();	 

	// SAE SPAJOL
	$sql = "SELECT prefixpertanggungan, nopertanggungan, nosp
			FROM $DBUser.tabel_200_temp 
			WHERE prefixpertanggungan = '$prefixpertanggungan' and nopertanggungan = '$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	$rsae = $DB->nextrow();
	@file_get_contents("http://192.168.2.82/smart_ifglife/administrator/process_doc_spajol.php?nospaj=$rsae[NOSP]&model=normal&kode_kantor=$kantor&submit=submit&no_polis_1=$prefixpertanggungan&no_polis_2=$noproposal");
?>	
<html><head>
</head><body topmargin="0">
<link href="./includes/jws.css" rel="stylesheet" type="text/css">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1320</font></td></tr>
</table>
<div align="center">
<font face="Verdana" size="2">Nomor Proposal yang baru saja anda entry adalah : <br><br></font>
<font face="Verdana" size="4"><b><?echo $prefixpertanggungan."-".$noproposal; ?></b><br></font>
<font face="Verdana" size="2">Terima kasih telah menggunakan<br><br>
<?

//================SMS SENDING================
$PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$noproposal);
$KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);

$msg="Yth. Bpk/Ibu ".$PER->namapemegangpolis.", terimakasih atas kepercayaan Anda kpd kami.".
	 "Permohonan polis Anda akan kami proses lebih lanjut. Utk info hub 1500176";
	 
//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$KLN->ponsel."','".$msg."')";
$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$KLN->ponsel."','".$msg."','SPAJ DIPROSES','$kantor','UNDERWRITING','".$prefixpertanggungan.$nopertanggungan."')";
// echo $mysqlins;
 	mysql_query($mysqlins);
//================SMS SENDING================

echo $nopropos;
if (!$prefixpertanggungan==$kantor || $kdper=='2') {
 //echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/mbah/perbaiki.php\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" );
echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/proposal/ulink/peliharaprop.php?nopertanggungan=$noproposal\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" ); 
 echo ("<a href=\"http://$HTTP_HOST/$KAMP/mbah/perbaiki.php\">Kembali</a></font>" );
} else {
 echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/proposal/ulink/peliharaprop.php?nopertanggungan=$noproposal\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" );
 echo ("<a href=\"http://$HTTP_HOST/$KAMP/mnuptgbaru.php\">Kembali</a></font>" );
 //echo ("<a href=\"javascript:window.close()\">Close</a></font>" );
 
 // redirect ke skk
 header("location:../entryskk.php?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$noproposal&jnscari=skkutama");
}
?>
</div>
<hr size="1">
</body>
</html>
<? } ?>