<?
  include "../../includes/session.php";
  include "../../includes/common.php";	 
  include "../../includes/database.php";
  include "../../includes/koneksi.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";

if($norekening!="1190002197521"){ //Untuk mencegah penyalahgunaan rekening PT Asuransi Jiwa IFG oleh Dedi 13/12/2011
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
  /******************MURNI UNTUK INSERT BARU****************************************/
	
	function GetNewPropNo($DBX)	{
		include "../../includes/common.php";	 
  
	  //$query = "select max(nopertanggungan) as maxnopert from $DBUser.tabel_200_pertanggungan ";
	  $query = "SELECT $DBUser.NOPOL.NEXTVAL as maxnopert FROM DUAL"; //echo $query;
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
	$DA=New database($userid, $passwd, $DBName);
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
	/* Untuk Produk kerjasama dengan BTN kdbank langsung di flag BTN dan status autodebet 1 oleh Dedi Z. 6 Oktober 2015*/
	if(substr($kdproduk,-3)=="BTN"){
	$autodebet='1';	
	$kdbank='BTN';
	}
	/* ---END--- */
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
      				 "'$autodebet','$kdbank','$norekening',premiumholiday,tgltransfer,jmltransfer,nopolswitch,taltup ".
				 "from 	$DBUser.tabel_200_temp ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
	//echo $sql."<br>";
	$DB->parse($sql);
	if ($DB->execute()) {
   	  if($kdproduk=="JSSP" || $kdproduk=="JSSK" || $kdproduk=="JSSPA" || $kdproduk=="JSSPA6" || $kdproduk=="JSSP6" || $kdproduk=="JSSPAN3" || $kdproduk=="JSSPAN6" || $kdproduk=="JSSPAN12" || $kdproduk=="JSSPAN24")
		{
		$sql="update $DBUser.tabel_200_pertanggungan set mulas=tgltransfer, tglakhirpremi=add_months(mulas,lamapembpremi_th*12), expirasi=add_months(mulas,lamaasuransi_th*12) ".
		 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		 $DB->parse($sql);
  		 $DB->execute();
		}
	  $sql = "insert into $DBUser.tabel_223_transaksi_produk(prefixpertanggungan,nopertanggungan,kdproduk,expirasi,akhirpmb, ".
				 	 "kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,tglmutasi) ".
					 "select prefixpertanggungan,'$noproposal',kdproduk,expirasi,akhirpmb, ".
					 "kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,tglmutasi ".
					 "from $DBUser.tabel_223_temp ".
					 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
					// echo $sql."<br>";
		$DB->parse($sql);
  	$DB->execute();

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
else { //proposal bayar di depan,noproposal udah ada,
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

	// delete dulu hospital
	$sql = "SELECT COUNT(*) jml FROM $DBUser.tabel_219_hospital_temp
			WHERE prefixpertanggungan = '$prefixpertanggungan'
				AND nopertanggungan = '$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();	  
	$arh=$DB->nextrow();
	
	if (!$arh['JML']==0) {
		$sql = "DELETE FROM $DBUser.tabel_219_hospital WHERE prefixpertanggungan = '$prefixpertanggungan'
					AND nopertanggungan = '$nopertanggungan'";
		$DB->parse($sql);
		$DB->execute();
	}

	$sql = "INSERT INTO $DBUser.tabel_219_hospital(prefixpertanggungan, nopertanggungan, kdinsurable,
				notertanggung, noklien, nourut)
			SELECT a.prefixpertanggungan, a.nopertanggungan, a.kdinsurable, a.notertanggung, a.noklien,
				a.nourut
			FROM $DBUser.tabel_219_hospital_temp a
			WHERE a.prefixpertanggungan = '$prefixpertanggungan'
				AND a.nopertanggungan = '$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	
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
	//Push data dokumen dari SPAJOL ke SAE
	//PENTING: !!!
	@file_get_contents("http://192.168.2.82/smart_ifglife/administrator/process_doc_spajol.php?nospaj=$rsae[NOSP]&model=normal&kode_kantor=$kantor&submit=submit&no_polis_1=$prefixpertanggungan&no_polis_2=$noproposal");
?>	
<html><head>
</head><body topmargin="0">
<link href="../jws.css" rel="stylesheet" type="text/css">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1320</font></td></tr>
</table>
<div align="center">
<?php
$PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$noproposal);
$KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
?>
<font face="Verdana" size="2">Nomor Proposal yang baru saja anda entry adalah : <br><br></font>
<font face="Verdana" size="4"><b><? echo /*$prefixpertanggungan."-".$noproposal*/$PER->nopolbaru; ?></b><br></font>
<font face="Verdana" size="2">Terima kasih telah menggunakan<br><br>
<?
//================SMS SENDING================
$msg="Yth. Bpk/Ibu ".$PER->namapemegangpolis.", terimakasih atas kepercayaan Anda kpd kami.".
	 "Permohonan polis Anda akan kami proses lebih lanjut. Utk info hub 021-1500151";
	 
//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$KLN->telepon."','".$msg."')";
$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$KLN->ponsel."','".$msg."','SPAJ DIPROSES','$kantor','UNDERWRITING','".$prefixpertanggungan.$nopertanggungan."')";
// echo $mysqlins;
 if ($kdproduk<>"JTP" || $kdproduk<>"JSSPHANA") { // entry susulan teleproteksi
 	mysql_query($mysqlins);}
//================SMS SENDING================

echo $nopropos;
if (!$prefixpertanggungan==$kantor || $kdper=='2') {
 echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/mbah/perbaiki.php\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" );
 echo ("<a href=\"http://$HTTP_HOST/$KAMP/mbah/perbaiki.php\">Kembali</a></font>" );
} else {
 echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/mnuptgbaru.php\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" );
 echo ("<a href=\"http://$HTTP_HOST/$KAMP/mnuptgbaru.php\">Kembali</a></font>" );
 //echo ("<a href=\"javascript:window.close()\">Close</a></font>" );
}
?>
</div>
<hr size="1">
</body>
</html>
<? } ?>
