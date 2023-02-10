<?
	$DB=New database($userid, $passwd, $DBName);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
	$sql="select a.premitagihan,b.premi1,b.kdstatusemail ".
			 "from $DBUser.tabel_300_historis_premi a, $DBUser.tabel_200_pertanggungan b".
  		 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
			 "and a.prefixpertanggungan=b.prefixpertanggungan and a.nopertangungan=b.nopertanggungan ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();

 switch ($arr["KDSTATUSEMAIL"]) {
  case '1':
   $em = 'Email Sudah Terkirim<br>';
  break;
  default:
   $em = 'Email Belum Terkirim<br>';
  break;
 } 	
 if ($arr["PREMITAGIHAN"] == $arr["PREMI1"]) {
  $st = 'Premi Dibayar Lunas';
	$se = true;
 } else {
  $st = 'Premi Belum Lunas';
	$se = false;
 }

if ($arr["KDSTATUSEMAIL"] && $se) {
  echo $em;
	echo $st;
	echo "<font size=2 face=Verdana color=red>PROPOSAL TIDAK BOLEH DIEDIT LAGI</font>"; 
  echo "<a href=\"#\" onclick=\"javascript:history.go(-1)\">Back</a>";
  die;
} else { 		 			 

if ($nopertanggungan<>''){	
	$sql = "select prefixpertanggungan,nopertanggungan,notertanggung,nosp,kdpertanggungan, ".
			 	 "to_char(tglsp,'DD/MM/YYYY') tglsp, gadaiotomatis, ".
				 "nobp3,kdproduk,to_char(tglbp3,'DD/MM/YYYY') tglbp3,".
				 "to_char(mulas,'DD/MM/YYYY') mulas,kdstatusfile, ".
				 "to_char(expirasi,'DD/MM/YYYY') expirasi, ".
				 "to_char(tglakhirpremi,'DD/MM/YYYY') akhirpremi, ".
				 "usia_th,usia_bl,lamaasuransi_th,lamaasuransi_bl, ".
				 "lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,premi1,kdcarabayar,indexawal, ".
				 "premi2,nopenagih,kdstatusfile,noagen,kdstatusmedical,nopemegangpolis,nopembayarpremi, ".
				 "autodebet,kdbank,norekeningdebet ".
				 "from $DBUser.tabel_200_pertanggungan where nopertanggungan='$nopertanggungan' and ".
				 "prefixpertanggungan='$prefixpertanggungan'";
} else { 
  if ($noprop<>''){
	$sql = "select prefixpertanggungan,nopertanggungan,notertanggung,nosp,kdpertanggungan, ".
			 	 "to_char(tglsp,'DD/MM/YYYY') tglsp, gadaiotomatis, ".
				 "nobp3,kdproduk,to_char(tglbp3,'DD/MM/YYYY') tglbp3,".
				 "to_char(mulas,'DD/MM/YYYY') mulas,kdstatusfile, ".
				 "to_char(expirasi,'DD/MM/YYYY') expirasi, ".
				 "to_char(tglakhirpremi,'DD/MM/YYYY') akhirpremi, ".
				 "usia_th,usia_bl,lamaasuransi_th,lamaasuransi_bl, ".
				 "lamapembpremi_th,lamapembpremi_bl,kdvaluta,juamainproduk,premi1,kdcarabayar,indexawal, ".
				 "premi2,nopenagih,kdstatusfile,noagen,kdstatusmedical,nopemegangpolis,nopembayarpremi ".
				 "from $DBUser.tabel_200_temp where nopertanggungan='$noprop' and ".
				 "prefixpertanggungan='$prefixpertanggungan'";
  }
}
}
	//echo $sql;			 
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();

if ($arr["KDSTATUSFILE"]=='X') {
	echo "<font size=2 face=Verdana color=red>PROPOSAL TELAH DIHAPUS</font><br>"; 
  echo "<a href=\"../proposal/propmtc01.php\">Back</a>";
  die;
}

 function getnama($db,$noklieninsurable,&$nama){
	$sql = "select namaklien1,gelar ".
			 	 "from $DBUser.tabel_100_klien  ".
				 "where noklien='$noklieninsurable' ";
	//echo $sql;
	$db->parse($sql);
	$db->execute();
	$arr=$db->nextrow();
	$nama = (strlen($arr["GELAR"])==0) ? $arr["NAMAKLIEN1"] : $arr["NAMAKLIEN1"].",".$arr["GELAR"];
	$nama = ereg_replace("'","`",$nama);
 }
	
 function gethub($db,$noklieninsurable,$ttg,&$hub){
	$sql = "select c.kdhubungan,b.namahubungan ".
			 	 "from $DBUser.tabel_218_kode_hubungan b,$DBUser.tabel_113_insurable c ".
				 "where c.kdhubungan=b.kdhubungan and c.notertanggung='$ttg' and c.noklieninsurable='$noklieninsurable' ";
				 
	//echo $sql;
	$db->parse($sql);
	$db->execute();
	$arq=$db->nextrow();
	$hub=$arq["NAMAHUBUNGAN"];
	
	if (is_null($hub) && ($ttg==$noklieninsurable)){
		 $hub="Tertanggung";
	}
 }

	
	$sql = "select a.noklien,a.nourut,b.namahubungan ".
			   "from $DBUser.tabel_219_pemegang_polis_baw a,$DBUser.tabel_218_kode_hubungan b ".
			   "where a.nopertanggungan='$nopertanggungan' and ".
				 "a.prefixpertanggungan='$prefixpertanggungan' ".
				 "and a.kdinsurable=b.kdhubungan order by a.nourut";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	
	while ($arq=$DB->nextrow()) {
	$klienno[]=$arq["NOKLIEN"];
	$urut[]=$arq["NOURUT"];
	$namahubungan[]=$arq["NAMAHUBUNGAN"];
	//echo $arq["NAMAHUBUNGAN"];
	}

	$demit= (count($klienno));

/*  add 12 Nov */
    require("../proposal/chainselectors.php"); 
 
    //prepare names 
    $selectorNames = array( 
        CS_FORM=>"ntryprop",  
        CS_FIRST_SELECTOR=>"kdproduk",  
        CS_SECOND_SELECTOR=>"kdcarabayar"); 

		/*
		if($act=="update")
		{
		$Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk,c.usia_lpp,c.variabel ".
	          "from $DBUser.tabel_233_produk_cara_bayar b, $DBUser.tabel_305_cara_bayar a, $DBUser.tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
						"and nvl(status,0)!='X' ".
						"order by b.kdproduk,a.namacarabayar";
		}
		else
		{
	  $Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk,c.usia_lpp,c.variabel ".
	          "from $DBUser.tabel_233_produk_cara_bayar b, $DBUser.tabel_305_cara_bayar a, $DBUser.tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
						"and c.status is null ".
						"order by b.kdproduk,a.namacarabayar";
	  }
		*/
		 $Query= "select a.kdcarabayar, b.kdproduk, a.namacarabayar,c.namaproduk,c.usia_lpp,c.variabel ".
	          "from $DBUser.tabel_233_produk_cara_bayar b, $DBUser.tabel_305_cara_bayar a, $DBUser.tabel_202_produk c ".
			  		"where a.kdcarabayar = b.kdcarabayar and b.kdproduk = c.kdproduk ".
						//"and c.status is null ".
						"order by b.kdproduk,a.namacarabayar";
		
	  $DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow())
	  { 
		//echo "$row[VARIABEL] : $row[NAMAPRODUK] : $row[KDPRODUK]<br>";
        $nama = $row[KDPRODUK]."  -->  ".$row[NAMAPRODUK];
				$selectorData[] = array(
																						 		
						CS_SOURCE_ID=>$row[KDPRODUK],   
            CS_SOURCE_LABEL=>$nama,  
            CS_TARGET_ID=>$row[KDCARABAYAR],  
            CS_TARGET_LABEL=>$row[NAMACARABAYAR]);
		}				
		
		
	  $Query= "select  kdproduk, namaproduk ,usia_lpp,variabel,lama_min,lama_max ".
	          "from  $DBUser.tabel_202_produk where status is null";
	  $DB->parse($Query);
	  $DB->execute();
  	while ($row=$DB->nextrow())
	  { 	
						$addendum[] = array(
						PRODUK=>$row[KDPRODUK],
						VARIABEL=>$row[VARIABEL],
						USIA_LPP=>$row[USIA_LPP],
						LAMA_MIN=>$row[LAMA_MIN],
						LAMA_MAX=>$row[LAMA_MAX]);			
		}
		
    //instantiate class 
    $ProdukCaraBayar = new chainedSelectors($selectorNames,$selectorData,$addendum); 

//--------------------------------------------------------------------------------------------------//

			
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<? 
	$sql="select to_char(sysdate,'DD/MM/YYYY') tanggal from dual";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$res = $DB->nextrow();
	//echo $res["TANGGAL"];
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( " function tgl2(){\n" );
  print( "	document.ntryprop.tglsp.value='".$res["TANGGAL"]."';\n" );
  print( "}\n" );
  print( "//-->\n" );
  print( "</script>" );
?>
<script language="JavaScript" type="text/javascript">
<?php 
    $ProdukCaraBayar->printUpdateFunction(); 
?> 
</script> 
 
<?
/**************************************************************************/
 $nottg=$arr["NOTERTANGGUNG"];
 $nopro=$arr["NOPERTANGGUNGAN"];
 $kdper=$arr["KDPERTANGGUNGAN"];
 $nosp =$arr["NOSP"];
 $tglsp=$arr["TGLSP"];
 $gotom=$arr["GADAIOTOMATIS"];
 $kdcb =$arr["KDCARABAYAR"];
 $kdpro=$arr["KDPRODUK"];
 $kdmed=$arr["KDSTATUSMEDICAL"];
 $nobp3=$arr["NOBP3"];
 $tgbp3=$arr["TGLBP3"];
 $mulas=$arr["MULAS"];
 $usith=$arr["USIA_TH"];
 $usibl=$arr["USIA_BL"];
 $lamth=$arr["LAMAASURANSI_TH"];
 $lambl=$arr["LAMAASURANSI_BL"];
 $expir=$arr["EXPIRASI"];
 $akhpr=$arr["AKHIRPREMI"];
 $lprth=$arr["LAMAPEMBPREMI_TH"];
 $lprbl=$arr["LAMAPEMBPREMI_BL"];
 $kdval=$arr["KDVALUTA"];
 $idxaw=$arr["INDEXAWAL"];
 $nopng=$arr["NOPENAGIH"];
 $noagn=$arr["NOAGEN"];
 $nopp =$arr["NOPEMEGANGPOLIS"];
 $nopre=$arr["NOPEMBAYARPREMI"];
 $jua  =$arr["JUAMAINPRODUK"];
 $p1   =$arr["PREMI1"];
 $p2   =$arr["PREMI2"];
 $cabar=$arr["KDCARABAYAR"];
 
 $autodebet  = $arr["AUTODEBET"]=="" ? "0" : "1";
 $kdbank 		 = $arr["KDBANK"];
 $norekening = $arr["NOREKENINGDEBET"];
 
/**************************************************************************/
	print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function Awal(){\n" );
  print( "document.ntryprop.notertanggung.value = '".$nottg."';\n" );
  print( "document.ntryprop.noproposal.value = '".$nopro."';\n" );
  print( "document.ntryprop.nosp.value ='".$nosp."';\n" );
  print( "document.ntryprop.tglsp.value ='".$tglsp."';\n" );
  if ($gotom=='1') {
 	 print( "document.ntryprop.bpo.checked ='TRUE';\n" );
	}
	if (!strlen($kdpro)==0) {
	 print( "document.ntryprop.kdcarabayar.value ='".$kdcb."';\n" );
   print( "document.ntryprop.kdproduk.value ='".$kdpro."';\n" );
  }
	print( "cek ='".$kdmed."';\n" );
  print( "switch (cek){\n" );
  print( "			 case 'M': {\n" );
  print( "			 			document.ntryprop.kdstatusmedical[0].checked=true;\n" );
  print( "						} break;\n" );
  print( "				case 'N': {\n" );
  print( "						 document.ntryprop.kdstatusmedical[1].checked=true;\n" );
  print( "						} break;\n" );
  print( "};\n	" );
	print( "document.ntryprop.nobp3.value ='".$nobp3."';\n" );
	print( "document.ntryprop.tglbp3.value ='".$tgbp3."';\n" );
  print( "document.ntryprop.mulas.value ='".$mulas."';\n" );
  print( "document.ntryprop.usia_th.value ='".$usith."';\n" );
	print( "document.ntryprop.usia_bl.value ='".$usibl."';\n" );
  print( "document.ntryprop.lamaasuransi_th.value ='".$lamth."';\n" );
  print( "document.ntryprop.lamaasuransi_bl.value ='".$lambl."';\n" );
  print( "document.ntryprop.expirasi.value ='".$expir."';\n" );
	print( "document.ntryprop.akhirpremi.value ='".$akhpr."';\n" );
  print( "document.ntryprop.lamapembpremi_th.value ='".$lprth."';\n" );
  print( "document.ntryprop.lamapembpremi_bl.value ='".$lprbl."';\n" );
  print( "document.ntryprop.kdvaluta.value ='".$kdval."';\n" );
  print( "document.ntryprop.indexawal.value ='".$idxaw."';\n" );
  print( "document.ntryprop.nopenagih.value =\"".$nopng."\";\n" );
  print( "document.ntryprop.noagen.value =\"".$noagn."\";\n" );
  print( "document.ntryprop.pempolno.value ='".$nopp."';\n" );
	
	print( "autodeb ='".$autodebet."';\n" );
  print( "switch (autodeb){\n" );
  print( "			 case '1': {\n" );
  print( "			 			document.ntryprop.autodebet.checked=true;\n" );
  print( "						} break;\n" );
  print( "			 case '0': {\n" );
  print( "						 document.ntryprop.autodebet.checked=false;\n" );
	print( "						 document.ntryprop.kdbank.disabled=true;\n" );
	print( "						 document.ntryprop.norekening.disabled=true;\n" );
  print( "						} break;\n" );
  print( "};\n	" );
	print( "document.ntryprop.kdbank.value ='".$kdbank."';\n" );
	print( "document.ntryprop.norekening.value ='".$norekening."';\n" );
	
	$ttg=$arr["NOTERTANGGUNG"];
	$noklieninsurable=$nopp;
	getnama($DB,$noklieninsurable,$nama);
	gethub($DB,$noklieninsurable,$ttg,$hub);	
	print( "document.ntryprop.pempolnama.value ='".$nama."';\n" );
	print( "document.ntryprop.pempolhub.value ='".$hub."';\n" );
  print( "document.ntryprop.pempreno.value ='".$nopre."';\n" );
	$noklieninsurable=$nopre;
	getnama($DB,$noklieninsurable,$nama);
	gethub($DB,$noklieninsurable,$ttg,$hub);	
	print( "document.ntryprop.pemprenama.value ='".$nama."';\n" );
	print( "document.ntryprop.pemprehub.value ='".$hub."';\n" );
  print( "document.ntryprop.nilai.value ='".$jua."';\n" );
	print( "document.ntryprop.premi1.value ='".$p1."';\n" );
  print( "document.ntryprop.premi2.value ='".$p2."';\n" );
  print( "document.ntryprop.cabar.value ='".$cabar."';\n" );

  print( "}\n" );
	print( "//-->\n" );
  print( "</script>\n" );

  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    $ProdukCaraBayar->selectCarabayar(); 
  print( "</script>\n" );
		
		
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function CallBenef() {\n" );
  print( "for (i=1;i<=".$demit.";i++)\n" );
  print( "Beneficiari();\n" );
		
	for ($i=1; $i<= $demit; $i++) {
  	$d=$i-1;
  	$noklieninsurable=$klienno[$d];
  	getnama($DB,$noklieninsurable,$nama);
  	gethub($DB,$noklieninsurable,$ttg,$hub);	
  	print( "document.ntryprop.nama".$i.".value='".$nama."';");
  	print( "document.ntryprop.hubungan".$i.".value='".$namahubungan[$d]."';");
  	print( "document.ntryprop.klienno".$i.".value='".$klienno[$d]."';");
  	print( "document.ntryprop.no".$i.".value='".$urut[$d]."';");	
	}
  print( "}\n" );
  print( "//-->\n" );
  print( "</script>" );
	
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "<!--\n" );
  print( "function GantiProduk(){\n" );
  print( "document.ntryprop.submit.disabled=true;\n" );
  print( "document.ntryprop.noagen.value =\"".$arr["NOAGEN"]."\";\n" );
  print( "document.ntryprop.buton.disabled=true\n" );
  print( "document.ntryprop.cekpolis.disabled=true\n" );
  print( "}\n" );
  print( "//-->\n" );
  print( "</script>" );
	$kdproduk = $arr["KDPRODUK"];
	
?>

<script language="JavaScript" type="text/javascript" src="../../includes/entryprop_all.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
