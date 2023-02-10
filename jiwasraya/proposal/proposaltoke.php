<?
  include "../../includes/common.php";
	include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);
	$DA=New database($userid, $passwd, $DBName);

$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
if ($submit){
	if($kdproduk=="JSSP" || $kdproduk=="JSSK" || $kdproduk=="JSSPA" || $kdproduk=="JSSPA6" || $kdproduk=="JSSP6" || $kdproduk=="JSSPB1" || $kdproduk=="JSSPAB1" || $kdproduk=="JSSPAN3" || $kdproduk=="JSSPAN6" || $kdproduk=="JSSPAN12" || $kdproduk=="JSSPAN24")
		{
		$sql="update $DBUser.tabel_200_pertanggungan set mulas=tgltransfer, tglakhirpremi=add_months(mulas,lamapembpremi_th*12), expirasi=add_months(mulas,lamaasuransi_th*12) ".
		 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		 $DB->parse($sql);
  		 $DB->execute();
		}
	/* Untuk Produk kerjasama dengan BTN kdbank langsung di flag BTN dan status autodebet 1 oleh Dedi Z. 6 Oktober 2015*/
	if(substr($kdproduk,-3)=="BTN"){
	$autodebet='1';	
	$kdbank='BTN';
	}
	/* ---END--- */
	$sql = "update $DBUser.tabel_200_pertanggungan  set (nopol,notertanggung,kdproduk,nosp,tglsp,kdvaluta,kdcarabayar,mulas,nopenagih,juamainproduk,noagen,".
			   " nopemegangpolis,expirasi,tglakhirpremi,indexawal,nobp3,tglbp3,gadaiotomatis,premistd, ".
		 	 	 " nopembayarpremi,kdstatusmedical,premi1,premi2,lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,usia_th,usia_bl,tglupdated,userupdated,risk,".
				 "autodebet,kdbank,norekeningdebet)".
				 " = (select prefixpertanggungan||'$noproposal',notertanggung,kdproduk,nosp,tglsp,kdvaluta,kdcarabayar,mulas,nopenagih,$juamainproduk,noagen,".
				 " nopemegangpolis,expirasi,tglakhirpremi,indexawal,nobp3,tglbp3,gadaiotomatis,premistd, ".
				 " nopembayarpremi,kdstatusmedical,$premi1,$premi2,lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,usia_th,usia_bl,tglupdated,userupdated,risk, ".
				 "'$autodebet','$kdbank','$norekening' ".
				 " from $DBUser.tabel_200_temp". 
				 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan') ".
				 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal' ";
	//echo $sql."<br>";
	if($norekening!="1190002197521"){ //Untuk mencegah penyalahgunaan rekening PT Asuransi Jiwa IFG oleh Dedi 13/12/2011
	$DB->parse($sql);
	$DB->execute();	  
	$DB->commit();
	}
	
  if (!$kdper=='2') {
  	$sql = "delete from $DBUser.tabel_212_dok_cek_uw ".
  	 		 	 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal'";
    $DB->parse($sql);
  	$DB->execute();	  
  	$DB->commit();
  	$sql="begin $DBUser.insdocmed('$prefixpertanggungan','$noproposal'); end;";
  	//echo $sql;
  	$DB->parse($sql);
    $DB->execute();
    $DB->commit();
  }
 	
	//diblok by kade untuk kepentingan benefit topup
	
	$sql = "delete from $DBUser.tabel_223_transaksi_produk ".
	 		 	 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";//and kdjenisbenefit<>'T'";
  $DB->parse($sql);
	$DB->execute();	  
	$DB->commit();	
	
	//echo $sql."<br><br>";		
	 
	$sql = "insert into $DBUser.tabel_223_transaksi_produk (prefixpertanggungan,nopertanggungan,kdproduk,".
			 	 " kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,expirasi,akhirpmb,tglmutasi)".
				 " select prefixpertanggungan,nopertanggungan,kdproduk,".
					" kdbenefit,premi,nilaibenefit,kdjenisbenefit,periodebayar,periodebenefit,expirasi,akhirpmb,tglmutasi".
					" from $DBUser.tabel_223_temp".
					" where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";//and kdjenisbenefit<>'T'";		
	//echo $sql."<br><br>";
  $DB->parse($sql);
	$DB->execute();	  
	$DB->commit();
	
	
	
	
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
						 "nopertanggungan='$nopertanggungan' and ".
						 "kdmutasi='21' and tglmutasi='$mulas'";
    		$DB->parse($sql);
    		$DB->execute();	  
    		$DB->commit();
	
	//insert ke table 603_mutasi_pert		 
			  $sql="insert into $DBUser.tabel_603_mutasi_pert ".
					 	 "(prefixpertanggungan,nopertanggungan,kdmutasi,tglmutasi,".
						 "kdproduk,mulas,kdvaluta,kdcarabayar,juamainproduk,premi1,premi2,".
						 "lamapembpremi_th,lamapembpremi_bl,expirasi,status) values ".
						 "('$prefixpertanggungan','$nopertanggungan','21','$mulas',".
						 "'$kdproduk','$mulas','$kdvaluta','$kdcarabayar','$juamainproduk','$p1','$p1',".
						 "'$lamapembpremi_th','$lamapembpremi_bl','$expirasi','0')";
    		$DB->parse($sql);
    		$DB->execute();	  
    		$DB->commit();
				//echo $sql;
	}
	
	//add 223 savingplan
	$sql = "delete from $DBUser.tabel_223_transaksi_savingplan ".
	 		 	 " where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 " and tglmutasi='$mulas'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();	  
	$DB->commit();	
	if ($kdproduk=="JSSPA6" || $kdproduk=="JSSP6") {$bln=6;} else {$bln=12;}
	
	$sql = "insert into $DBUser.tabel_223_transaksi_savingplan ".
             "select prefixpertanggungan, nopertanggungan, premi1,tglpenawaranstart, tglpenawaranend, bunga,".
                "add_months(mulas,$bln), '0',null,null,mulas,null,juamainproduk, ".
                "POWER((1+bunga),DECODE(a.KDPRODUK,'JSSPAN24',2,1))*premi1,sysdate ".
             "from ".
						 		"$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_999_bunga_savingplan b ".
             //"where kdproduk in ('JSSP','JSSK') ".
			 "where a.kdproduk ='$kdproduk' and b.kdproduk ='$kdproduk' ".
			 "and premi1 between premimin and premimax ".
			 "and tgltransfer between tglmulasstart and tglmulasend ".
       "and kode='N' and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
  //echo $sql;
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
  }
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();	  
	$DB->commit();
		
	
	//$sql="begin $DBUser.premipayment2('$prefixpertanggungan','$noproposal'); end;";
	//$DB->parse($sql);
	//$DB->execute();	  
	//$DB->commit();		 

	$sql = "insert into $DBUser.tabel_219_pemegang_polis_baw(prefixpertanggungan,nopertanggungan,notertanggung,nourut,kdinsurable,noklien) ".
			   "select prefixpertanggungan,nopertanggungan,notertanggung,nourut,kdinsurable,noklien ".
				 "from $DBUser.tabel_219_temp ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
  $DB->parse($sql);
	$hasil=$DB->execute();
	if (!$hasil) {
	 echo "Tidak ada perubahan Ahli waris";
	} else {
	 $sql = "delete from $DBUser.tabel_219_temp ".
				 "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
   $DB->parse($sql);
	 $DB->execute();
	}
  
	$sql="delete from $DBUser.tabel_223_temp where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ";	
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
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();	 
	$DB->commit();

}
	
?>
<html><head>
</head><body topmargin="0">
<link href="../jws.css" rel="stylesheet" type="text/css">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1320</font></td></tr>
</table>
<div align="center">
<font face="Verdana" size="2">Nomor Proposal/Polis yang baru saja anda Edit adalah : <br><br></font>
<font face="Verdana" size="4"><b><?echo $prefixpertanggungan."-".$noproposal; ?></b><br></font>
<font face="Verdana" size="2">Terima kasih telah menggunakan<br><br>
<?
if (!$prefixpertanggungan==$kantor || $kdper=='2') {
 echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/mbah/perbaiki.php\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" );
 echo ("<a href=\"http://$HTTP_HOST/$KAMP/mbah/perbaiki.php\">Kembali</a></font>" );
} else {
 echo ( "<a  href=\"http://$HTTP_HOST/$KAMP/mnuptgbaru.php\"><img name=\"a\" border=\"0\" src=\"../img/xlindo.gif\" border=\"0\"></a><br><br>" );
 echo ("<a href=\"http://$HTTP_HOST/$KAMP/mnuptgbaru.php\">Kembali</a></font>" );
}
?>
</div>
<hr size="1">
</body>
</html>