<? 
  include "../../includes/common.php";
	include "../../includes/database.php";
  include "../../includes/formula44.php";
  include "../../includes/session.php";

	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
	$DB=New database($userid, $passwd, $DBName);
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
   //echo $rumuspremistd."|".$prefixpertanggungan."-".$nopertanggungan;
	 $FM1=new Formula($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
	 $FM1->parse($rumuspremistd);
	 $hasil = $FM1->execute($DBA);
	 echo "";
	 //echo $hasil."<br>";
	 $premistandar+=$hasil;
	}
	//$premistandar=ceil($premistandar);
  //echo $koderumusstd."|".$rumuspremistd."|".$premistandar;
	
	//premistandar MQHA=jmlbulan*preminya
	/*jika hitungan kosong lihat tglberlaku untuk basisnya*/
	
	//echo $kdcarabayarlama;
	
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
			//echo $expirasi;
			//$lamapembayaran = ${"rms".$kdbenefit};
			$akhirpembayaran = ${"akh".$kdbenefit};			
			$akhirpmb = ($akhirpembayaran==""||is_null($akhirpembayaran)) ? 'NULL' : "to_date('".$akhirpembayaran."','DD/MM/YYYY')";
			$expir = ($expirasi==""||is_null($expirasi)) ? 'NULL' : "to_date('".$expirasi."','DD/MM/YYYY')";      
			
			$sql="update $DBUser.tabel_223_temp ".
			     "set premi=$premi, nilaibenefit=$benefit,expirasi=$expir,".
					 "akhirpmb=$akhirpmb ".
  	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			//echo $sql."<BR>";
			$DB->parse($sql);
      $DB->execute();
	}    //foreach

  /***********************************output***********************************************************/

	$faktor = $FM->faktorbayar;	


	//$premistd=($skg=='1' && $FM->cabayar=='X') ? $jmlpremi : $premistd; //premi dasar
	//echo $jmlpremi."|".$premistandar."|".$premistd."|".$skg;
			

	switch ($premijua) {
	 case 'premi': {
		$sql = "select sum(premi) premistd ".
				   "from $DBUser.tabel_223_temp ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' ".
				 	 "and kdjenisbenefit <>'X' ";
		//echo $sql."<br>";
		$DB->parse($sql);
    $DB->execute();
		$ari=$DB->nextrow();
		
		
		///$premistd dari hidden untuk carabayar berkala dan skg <> 1
					 
		
		//echo $premistandar."|".$premistd."|harus sama";
									 
		if ($FM->kdjeniscb=='B') { //cara bayar berkala	
		  $premi2=$premistandar * $faktor;
		}	else if ($FM->cabayar=='X' or $FM->cabayar=='E') {
		  $premi2=0;
		}	else if ($FM->cabayar=='J') {						 
		  $premi2=$FM->premi1;
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
		//echo $sql;
		$DB->parse($sql);
    $DB->execute();
		$ari=$DB->nextrow();
		$extra = $ari["PREMI"];
		
		//echo $premistandar."|".$premistd;
		
		$premiup=$jmlpremi-$extra;
		
		if ($FM->kdjeniscb=='B') { //cara bayar berkala	
				$p2 = $premiup * $faktor;
				$p1 = $jmlpremi * $faktor;
		} else if ($FM->cabayar== 'X' or $FM->cabayar== 'E') {
				$p2=0;
				$p1=$jmlpremi  * $faktor;
		} else if ($FM->cabayar == 'J') {
				$p1=$jmlpremi * $faktor;
				$p2=$premiup * $faktor;	 
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
				//echo $rumuspremi."|".$premistandar."|".$hasilpremi."|".$faktor;
/*	 			
  		  if ($kdjenisbenefit=="U") {
					 if ($cabayar=='X' or $cabayar=='E' or $cabayar=='J') {
					 		CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$hasilpremi*$faktor);
					 		//premi standar untuk digunakan menghitung komisi agen 02 jika carabayar sekaligus
					 } else {
				      CompComm($DB,$prefixpertanggungan,$nopertanggungan,$hasilpremi,$hasilpremi*$faktor);
					 }
					 	
			  }										
*/

			}		
		}	//if
   include "../../includes/belang.php";
		echo "<td class=verdana8 align=center>$no</td>\n";
		echo "<td class=verdana8>".$kdbenefit."</td>";
		echo "<td class=verdana8>".$namabenefit."</td>";

		/*  kalo 0 jangan diliatin */	
		//echo $faktor;
		$test=$hasilpremi!=0 ? number_format($hasilpremi*$faktor,2):'';
		$tist=$hasilbenefit!=0 ? number_format($hasilbenefit,2):'';
		$tast=(strlen($hasilexpirasi)==10) ? $hasilexpirasi : '';
		echo "<td align=right class=verdana8>".$tist."";
		echo "   <input type=\"hidden\" name=bnf".$kdbenefit." value=".$hasilbenefit."></td>";
		echo "   <input type=\"hidden\" name=exp".$kdbenefit." value=".$hasilexpirasi.">";
		echo "<td align=\"right\" class=verdana8>".$test." ";
		echo "   <input type=\"hidden\" name=prm".$kdbenefit." value=".$hasilpremi.">";
		echo "   <input type=\"hidden\" name=akh".$kdbenefit." value=".$hasilakhirpmb.">";
		echo "</td>";
		echo "<td align=center class=verdana8blk>".$tast."</td>";
		echo "<td align=center class=verdana8>".$arr["KDJENISBENEFIT"]."</td>";
	  echo "</tr>";
		
		$jmlpremi = $jmlpremi + $hasilpremi; 

		$jmlbenefit = $jmlbenefit + $hasilbenefit; 
		$no ++;
		$i++;
		
	} //foreach
 //ganti dari jmlpremiu ke jmlpremi(premi tahunan);
	
					 if ($cabayar=='X' or $cabayar=='E' or $cabayar=='J') {
					// 		echo $premistandar+ "<br> "; 
					//		echo $jmlpremi + "<br> ";
					//		echo $faktor;
					 		CompComm($DB,$prefixpertanggungan,$nopertanggungan,$premistandar,$jmlpremi*$faktor);
					 } else {
				      CompComm($DB,$prefixpertanggungan,$nopertanggungan,$hasilpremiu,$jmlpremi*$faktor);
					 }
					 
//echo $premistandar."|".$hasilpremiu."|".$jmlpremi."|".$faktor."|".$jmlpremi*$faktor;	
	//hitung komisi agen 02 /komisiprmi1 tergantung cara bayar
				/*	 
					 if ($cabayar=='X' or $cabayar=='E' or $cabayar=='J') {
					 	 CompComm1($DB,$prefixpertanggungan,$nopertanggungan,$jmlpremi,$premistandar);//aslinya premistandarejx
					 } else {
					   CompComm1($DB,$prefixpertanggungan,$nopertanggungan,$jmlpremi*$faktor,$premistandar);
					 }
			 	*/						 		
//echo $jmlpremi."|".$premistandar."|".$cabayar."|".$jmlpremi."|".$faktor."|".$jmlpremi*$faktor."|".$p1;			  

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
	<td align=right><? echo number_format($jmlpremi*$faktor,2); ?></td>
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
<table width="100%">
<tr>
  <td class="arial10"><a href="benefit.php?state=0&premijua=<?echo $premijua;?>&noproposal=<?echo $noproposal;?>&nopertanggungan=<?echo $nopertanggungan;?>&prefixpertanggungan=<?echo $prefixpertanggungan;?>&kdper=<?echo $kdper;?>&vara=<?echo $vara;?>&kdproduk=<?echo $kdproduk;?>">Back</a></td>
	<td align="right">
	  <input type="hidden" name="mode" value="insert">
	  <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
	  <input type="hidden" name="premistd" value="<? echo $premistandar; ?>">
	  <input type="hidden" name="jmlpremi" value="<? echo $jmlpremi; ?>">
	  <input type="hidden" name="jmlbenefit" value="<? echo $jmlbenefit; ?>">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"Nilai Tebus\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s','popuptebus',400,500,1);\">",$jua,$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"Komisi\" onclick=\"NewWindow('popupkom.php?cabayar=%s&prefixpertanggungan=%s&nopertanggungan=%s&noproposal=%s&noagen=%s','popupkomisi',500,350,1);\">",$cabayar,$prefixpertanggungan,$nopertanggungan,$noproposal,$noagen); ?>
    <input type="submit" name="propmtc14lanjut" value="Lanjut"  onclick="javascript:SubmitOK();">
	</td>
</tr> 
</table>
</form>
</body>
</html>
