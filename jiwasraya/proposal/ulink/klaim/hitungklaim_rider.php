<?
	include "../../includes/common.php";
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/duit.php";
	include "../../includes/tunggakan.php";
	include "../../includes/gadai.php";
	include "../../includes/tgl.php";
	include "../../includes/kantor.php";
	echo "<link href=\"../../includes/jws2005.css\" rel=\"stylesheet\" type=\"text/css\">";
	
	$prefix = 	strtoupper($prefix);
	$DB		=	new database($userid, $passwd, $DBName);
	$DA		=	new database($userid, $passwd, $DBName);
	$PER	=	New Pertanggungan($userid,$passwd,$prefix,$noper);
	$kdproduk	=	$PER->produk;
	$TR 	= New Transaksi($userid,$passwd);
	$PWK 	= New Kantor($userid,$passwd,$kantor);
	$KT  	= New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$KP  	= New KantorPusat($userid,$passwd);
	
	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	//echo $sql;
	$sql = "select to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan,to_char(tglmeninggal,'DDMMYYYY') tglmeninggal ".
			   "from $DBUser.tabel_901_pengajuan_klaim ".
			 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' ".
				 "and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";

	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$tglpengajuan=$arr["TGLPENGAJUAN"];				 
	$tglmeninggal=$arr["TGLMENINGGAL"];
	
					 	
if ($submit=='Submit') {
  $pertanggungan=$prefix."-".$noper;
  print( "<html>\n" );
  print( "<head>\n" );
  print( "<title>Pengajuan Klaim Tanggal ".$tanggal."</title>\n" );
  print( "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">\n" );
  print( "</head>" );
  print( "<body>" );
	print( "<div align=center>" );

		 $sql = "delete from $DBUser.tabel_905_benefit_klaim ".
       			"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
						"and kdklaim='$kdklaim' and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
		 				//echo $sql;
		 $DA->parse($sql);
		 $DA->execute();	
			 
		 $sql = "select kdproduk from $DBUser.tabel_200_pertanggungan ".
						"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ";
		 $DA->parse($sql);
		 $DA->execute();	
		 $arr=$DA->nextrow();
		 $kdproduk=$arr["KDPRODUK"];
		 
		 //klaim CACAT	 		
		 if($kdklaim=="ADDB")
		 {
		   //cek klaim yang sudah pernah 
		   $sql = "select  sum(nilaibenefit) as jmlsudahklaim from $DBUser.tabel_905_historis_klaim_pa where ".
  						"prefixpertanggungan='$prefix' and ".
  						"nopertanggungan='$noper' and ".
  						"kdklaim='$kdklaim' and kdbenefit='".$kdbnft."'";
  		 //echo "<br>".$sql."<br>";
  		 	$DB->parse($sql);
  		 	$DB->execute();	
  		 	$max=$DB->nextrow();
  		 	$maxklaim = $max["MAXNOKLAIM"];
			$jmlklaim = $max["JMLSUDAHKLAIM"];
  		 	$noklaim	= $maxklaim+1; 
			 

			 $nil			= 0;
			 echo "<table>";
			 for ($i=0; $i < count($jmlbaris); $i++)
			 {
				//echo $i."|".$codecacat[$i]." | ".${"kc".$i}." | ".$namacacat[$i]." | ".$jumlahnilai[$i]."<br />";
				//if($codecacat[$i]==${"kc".$i})
				//{
				// echo "insert into...".$codecacat[$i]."=".$namacacat[$i]." | ".$jumlahnilai[$i]."<br />";	
				//}
				
				if($codecacat[$i]==${"kc".$i})
				{
			    echo "<tr>";
				  echo "<td>".$codecacat[$i]."</td><td>".$namacacat[$i]."</td><td align=right>".number_format($kdbnftcct[$i],2,",",".")."</td>";
					echo "</tr>";
					$nil = $kdbnftcct[$i];
					
					$sql = "insert into $DBUser.tabel_905_historis_klaim_pa ".
							 	 "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,".
								 "kdbenefit,nilaibenefit,tglrekam,userrekam,".
								 "kd_cacat,no_klaim) ".
								 "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk',".
								 "'".$kdbnft."',".$kdbnftcct[$i].",sysdate,user,".
								 "'".$codecacat[$i]."','$noklaim')";
					//echo $sql."<br>";
					$DA->parse($sql);	
					$DA->execute();
					
					$jmlnilai += $nil;	
				}
			 }
			    echo "<tr>";
				echo "<td colspan=2>Jumlah</td><td align=right>".number_format($jmlnilai,2,",",".")."</td>";
				echo "</tr>";
			 echo "</table><br>";
			 $sql = "update $DBUser.tabel_901_pengajuan_klaim set nilaibenefit=".$jmlnilai." ".
			 		"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
					"and kdklaim='$kdklaim' and tglpengajuan=to_date('$tglpengajuan','DD/MM/YYYY')";
			 $DA->parse($sql);	
			 $DA->execute();
			 
			 
			 $sql = "insert into $DBUser.tabel_905_benefit_klaim ".
				      "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,nilaibenefit,tglrekam,userrekam) ".
       			  "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$kdbnft."',".$jmlnilai.",sysdate,user) ";
			 $DA->parse($sql);
			 
			 if($DA->execute())
			 {
				 	//echo $sql."<br>";
  			 		//echo "<br><br>Pengajuan Klaim $kdklaim Sukses ... Proses selanjutnya dilakukan oleh kasir<br><br>";
				 	//echo "<a href=\"pengajuanklaim_akdp.php\">Back</a>";
				 $a="OK"; //pemicu update tabel pengajuan klaim
			 }
			 else
			 {
			   echo "Gagal! Pengajuan mungkin sudah pernah dilakukan";
			 }
		 }
  	 
		 //klaim RAWATINAP								
		 $sqa = "select kdbenefit ".
    				"from $DBUser.tabel_223_transaksi_produk  ".
    				"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
    				"order by kdbenefit desc ";
		 $DB->parse($sqa);
		 $DB->execute();
		 $nilaibnft = 0;		
		 $ok = true;
		 $bnftklm = array();
		 
		 while ($arr=$DB->nextrow()){		
			 if (${'cb'.$arr["KDBENEFIT"]}) {
			    //$jumlahnilai = $$arr["KDBENEFIT"];
					
  					$jumlahnilai = $nilaiklaim;
  			   		$sql = 	"insert into $DBUser.tabel_905_benefit_klaim ".
  				      		"(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,nilaibenefit,tglrekam,userrekam) ".
         			   	  "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$arr["KDBENEFIT"]."',".$jumlahnilai.",sysdate,user) ";
  			   	//echo $sql."<br>";
    			 	$DA->parse($sql);
    				$a=$DA->execute();
    				$nilaibnft += $$arr["KDBENEFIT"];
    			  	$ok = $ok AND $a;
    				array_push($bnftklm,$arr["KDBENEFIT"]); // mendefinisikan jumlah benefit
					
					if($kdklaim=="RAWATINAP")
					{
						// cari  jumlah berapa kali ngeklaim //
  					$sql = "select max(no_klaim) as maxnoklaim from $DBUser.tabel_905_historis_klaim_pa where ".
  							   "prefixpertanggungan='$prefix' and ".
  								 "nopertanggungan='$noper' and ".
  								 "kdklaim='$kdklaim' and kdbenefit='".$arr["KDBENEFIT"]."'";
  								 //echo "<br>".$sql."<br>";
  					$DB->parse($sql);
  		 			$DB->execute();	
  		 			$max=$DB->nextrow();
  		 			$maxklaim = $max["MAXNOKLAIM"];
  					$noklaim	= $maxklaim+1; 
  					//echo "<br>".$maxklaim." | ".$noklaim." | ".$nilaibnft." - ".$jumlahnilai."<br>";

  		      		if(!$kdcacat){$kdcacat=$arr["KDBENEFIT"];}
  					$sql = "insert into $DBUser.tabel_905_historis_klaim_pa ".
  							 	 "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,".
  								 "kdbenefit,nilaibenefit,tglrekam,userrekam,".
  								 "kd_cacat,no_klaim) ".
  								 "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk',".
  								 "'".$arr["KDBENEFIT"]."',".$jumlahnilai.",sysdate,user,".
  								 "'$kdcacat','$noklaim')";
  					//echo $sql;
  					$DA->parse($sql);	
  					$DA->execute();		
					}
					
					//add  by jro
					$sql = "update $DBUser.tabel_901_pengajuan_klaim set nilaibenefit=".$jumlahnilai." ".
			 		"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
					"and kdklaim='$kdklaim' and tglpengajuan=to_date('$tglpengajuan','DD/MM/YYYY')";
			 		$DA->parse($sql);	
			 		$DA->execute();
 			 }			
		 }	
		 	  	
			#---------------------------------[ jika klaim meninggal ]------------------------------
			
			if ($kdklaim=='MENINGGAL') { //kelompok meninggal
				  if ($PER->medstat=='N') {
					 if ($PER->valuta=='1' || $PER->valuta=='0') {
					  $batas = ((int)$PER->UsiaPolisBl() <= 36) ?  RISKAWALK3NMRP : RISKAWALB3NMRP;//3tahun
	  		   } else {
					  $batas = ((int)$PER->UsiaPolisBl() <= 36) ?  RISKAWALK3NMDOLAR : RISKAWALB3NMDOLAR;//3tahun
	  		   }
					 $sql = "select to_number('$resikoawal','999,999,999,999.99') ra from dual ";
					 $DB->parse($sql);
		 			 $DB->execute();
					 $arr=$DB->nextrow();
		 		 	 $ra = $arr["RA"];
					 if ($ra <= $batas) {	
							   $mailtujuan=$KT->emailxlindo;
		  					 $kantortujuan = "KEPALA BAGIAN PERTANGGUNGAN ".$KT->namakantor;
		 			 } else {
		  				   $mailtujuan=$KP->emailadlog;
		  					 $kantortujuan = "KEPALA BAGIAN PELAYANAN PP<BR>KANTOR PUSAT JAKARTA";
		 			 }  
	  			 
					} else {
					 $mailtujuan=$KP->emailadlog;
		  		 $kantortujuan = "KEPALA BAGIAN PELAYANAN PP<BR>KANTOR PUSAT JAKARTA";
					}  

					 $emailpengirim=$PWK->emailxlindo;
  				 $isin .= "Kepada Yth.\n".$kantortujuan."\ndi Tempat \n\n";
					 $isin .= "Perihal : PENGAJUAN KLAIM MENINGGAL DUNIA\n";
					 $isin .= $namaklaim."\n";
		    	 $isin .= "Dengan ini kami sampaikan bahwa polis berikut :\n\n";
	 	    	 $isin .= "No \tNomor Polis \tPemegang Polis\n";
        	 $isin .= "-----------------------------------------------\n";
			 		 $isin .= "1. \t".$pertanggungan." \t".$PER->namapemegangpolis."\n";
			 		 $isin .= "-----------------------------------------------\n\n";
					 $isin .= "Mengajukan PERMOHONAN KLAIM MENINGGAL DUNIA dengan data sbb : ".$namaklaim." \n";
					 $isin .= "Tanggal Meninggal adalah ".$tglmeninggal.". \n";
					 $isin .= "Sebab Meninggal adalah ".$sebabmeninggal.". \n";
					 $isin .= "Dokter Yang Merawat ".$namadokter.". \n";
					 $isin .= "Alamat Praktek : ".$alamatdokter.". \n";
					 $isin .= "Yang mengajukan permohonan : ".$pemohon.". \n";
					 $isin .= "Mohon segera diproses selanjutnya.\n\n";
			  	 $isin .= "Demikian kami sampaikan dan atas \nperhatiannya kami ucapkan terima kasih.\n\n\n";
			  	 $isin .= $PWK->kotamadya.", ".$tanggal."\n\n";
		    	 $isin .= $PWK->kepala."\n";
					 $isin .= "-------------------------------\n";
			 		 $isin .= "Branch Manager \n";
	  		
					 //mail($mailtujuan,"PERMOHONAN ".$namaklaim." (".$pertanggungan.")",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
	 
					 /***********************************end kirim email****************************************/		
   		     $sql = "update $DBUser.tabel_901_pengajuan_klaim set emailto='$mailtujuan', ".
					 			  "userupdated=user,tglupdated=sysdate,status=4 ".
					        "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
						 			"and kdklaim='$jnsklaim' and trunc(tglpengajuan)=trunc(sysdate)";
			  					
					 //echo $sql;
				   $DB->parse($sql);
					 $DB->execute();
				 	 $DB->commit();
					 //echo $PER->notertanggung;
					 $sqa = "update $DBUser.tabel_200_pertanggungan set lockmutasi='18',kdstatusfile='6', ".
					 			  "userupdated=user,tglupdated=sysdate ".
					        "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ";
									//echo $sqa;
				   $DB->parse($sqa);
					 $DB->execute();
				 	 $DB->commit();
				 
				 	 $sqa = "update $DBUser.tabel_100_klien set status='9', ".
					 			  "userupdated=user,tglupdated=sysdate ".
					        "where noklien='".$PER->notertanggung."' ";
					 //echo $sql;
				   $DB->parse($sqa);
					 $DB->execute();
				 	 $DB->commit();
					 
				 print( "  <table width=\"100%\" class=tblisi>\n" );
   			 print( "  <tr class=arial8>\n" );
   			 print( "		<td width=\"100%\" colspan=2 align=\"left\"><pre>$isin</td>\n" );
   			 print( "	 </tr>\n" );
				 print( "  <tr class=arial10>\n" );
   			 print( "		<td width=\"100%\" colspan=2><hr size=1></td>\n" );
   			 print( "	 </tr>\n" );
   			 print( "	</table>	" );
				
				 echo "<a class=verdana10blk><font color=red><b>STATUS PERTANGGUNGAN SUDAH BERUBAH MENJADI KLAIM</b></font></a><br><br>";
				 //include "footer.php"; 			 
	 			}
			#---------------------------------[ end meninggal ]--------------------------
			
			 if ($a) {
			  if($kdklaim=="MENINGGAL") {
      			  $sqa = "update $DBUser.tabel_901_pengajuan_klaim ".
      						   "set userptg=user,tglptg=sysdate,nilaibenefit=$nilaibnft,".//status=1, ". // tambahan  ganti status
      							 "userupdated=user,tglupdated=sysdate,tglhitung=trunc(sysdate) ".
      							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
      							 "and kdklaim='$kdklaim' ";
							 			 //echo $sql;
				} else {
      				$sqa = "update $DBUser.tabel_901_pengajuan_klaim ".
      						   "set userptg=user,tglptg=sysdate,status=1,".//nilaibenefit=".$jumlahnilai.", ". // tambahan  ganti status
      							 "userupdated=user,tglupdated=sysdate,tglhitung=trunc(sysdate) ".
      							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
      							 "and kdklaim='$kdklaim' ";
				}
				//echo $sqa;
				$DB->parse($sqa);
				$DB->execute();
				
				for ($i=0; $i<count($bnftklm); $i++) {
				 if($noklaim==2)
				 {
				 $sqa ="update $DBUser.tabel_223_transaksi_produk ".
						   "set status='8' ".
							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							 "and kdbenefit ='".$bnftklm[$i]."' ";
				 $DB->parse($sqa);
				 $DB->execute();
				 }
				}			 
				
				$sql = "insert into $DBUser.TABEL_UL_BENEFIT_KLAIM ".   				      "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,tglselesai,tglmulai,nilaibenefit,totalbenefit,tglrekam,userrekam,sisabenefit,kdcarabayar) ".
       			  "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$kdbnft."',to_date('$tglsampai','DD/MM/YYYY'),to_date('$tglmulai','DD/MM/YYYY'),".$premigratis.",".$premigratistotal.",sysdate,user,".(500000000-$premigratistotal).",'".$PER->kdcarabayar."') ";
			 $DA->parse($sql);
			 $DA->execute();
			 //echo $sql;
			 
				echo "Pengajuan Klaim Sukses... Proses selanjutnya adalah pembayaran klaim dilakukan oleh kasir.<br><br>";
				
				 print( "  <table width=\"100%\">\n" );
   			 print( "   <tr>\n" );
				 print( "    <td width=\"50%\" align=\"left\" class=verdana10blk><a href=\"pengajuanklaim_akdp.php\"><< Back</a></td>\n" );
   			 if($modul=="2KU"){
				 print( "    <td width=\"50%\" align=\"right\" class=verdana10blk><a href=\"#\" onclick=\"window.location.replace('pengajuanklaim_akdp.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=$tglpengajuan')\">Lanjut</a></td>\n" );
 	       } 
			 	 print( "	 </tr>\n" );
   			 print( "	</table>	" );
			 }	 
			 
			  //---------------------[ dokumen klaim ] -------------------
			$sqa = "DELETE FROM $DBUser.tabel_904_syarat_klaim 
							WHERE prefixpertanggungan = '$prefix' 
								AND nopertanggungan = '$noper' 
								AND kdklaim = '$kdklaim'
								AND TO_CHAR(tglpengajuan, 'dd/mm/yyyy') = '$tglpengajuan'";
			$DB->parse($sqa);
			$DB->execute();
  	 		$sqa = "select kddokumen ".
						   "from $DBUser.tabel_904_syarat_klaim  ".
							 "where kdklaim='$kdklaim' order by kddokumen desc ";
			$DB->parse($sqa);
			$DB->execute();

  			while ($arr=$DB->nextrow()){			
  				/*$sql = "update $DBUser.tabel_904_cek_dok_klaim set status='".$$arr["KDDOKUMEN"]."' ,tglupdated=sysdate,userupdated=user ".
         			   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' ".
  			 				 "and kddokumen='".$arr["KDDOKUMEN"]."' and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";*/
  				$sql = "INSERT INTO $DBUser.tabel_904_cek_dok_klaim (prefixpertanggungan, nopertanggungan, kdklaim, 
							kddokumen, userrekam, tglrekam, userupdated, tglupdtaed, status, tglpengajuan)
						VALUES ('$prefix', '$noper', '$kdklaim', '$arr[KDDOKUMEN]', user, sysdate, user, sysdate,
							'".$$arr["KDDOKUMEN"]."', TO_DATE('$tglpengajuan', 'dd/mm/yyyy'))";
  				$DA->parse($sql);
  				$DA->execute();
  			}

				//--------------------------[ end isi dokumen ]---------------	
			
			// update nilai klaim
			
				
} else {

	$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
  $DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$tanggal = $w["NOW"];
  ?>
  
  <html>
  <head>
  <title>Pengajuan Klaim Tanggal </title>
  
  <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  <?
	if($kdklaim!="CACAT")
	{
    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
    
     $sql = "select a.kdbenefit ".
  	 			  "from $DBUser.tabel_223_transaksi_produk a,$DBUser.tabel_207_kode_benefit b ".
  		 	    "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
  					"and b.kdkelompokbenefit='$klp' ".
  					"and a.kdbenefit=b.kdbenefit ";
     
  	 $DB->parse($sql);
  	 $DB->execute();
  	 while ($arr=$DB->nextrow()) {							 
      print( "function Cek".$arr["KDBENEFIT"]."(theForm) {\n" );
    	print( "   if (theForm.cb".$arr["KDBENEFIT"].".checked) {\n" );
    	print( "	  theForm.submit.disabled=false\n" );
    	print( "   } else {\n" );
    	print( "    theForm.submit.disabled=true\n" );
    	print( "	 }	\n" );
    	print( " }\n" );
     }
  	 print( "//-->\n" );
     print( "</script>\n" );
  	 //echo $sql;
  }
	?>
    <script language="JavaScript" type="text/javascript">
    function GantiNilai(nilainya) {
	document.propmtc.nilaiklaim.value=nilainya.value;}
	</script>
  </head>
  <? 
	if($kdklaim!="ADDB" )
	{
  if ($cekbnf=="ON"){
   ?>
  <body onLoad="document.propmtc.submit.disabled=false">
  <? } else { ?>
  <body onload="document.propmtc.submit.disabled=false">
  <? 
	   }
	}
	else
	{
	echo "<body>";
	}
	 ?>
  <div align="center">
  <form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>">
  <input type="hidden" name="kdklaim" value="<? echo $kdklaim ?>">
  <input type="hidden" name="tglpengajuan" value="<? echo $tglpengajuan ?>">
  
  <table border="0" bgcolor="#cff2b0" cellspacing="1" cellpadding="4" width="800" align="center">
     <tr bgcolor="#a0d268">
       <td align="center"><b>PERHITUNGAN NILAI KLAIM RIDER</b></td>
     </tr>
		 <tr>
      <td> 
		 
  		 <table border="0" cellpadding="1" width="100%" cellspacing="1">
  				<tr>
  				<td width="23%">Tanggal Pengajuan</td>
  				<td width="2%">:</td>
    			<td width="25%"><input name="tglpengajuan" readonly value="<? echo $tglpengajuan; ?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
  				
  				<tr>
  				<td width="23%">Klaim Yang Diajukan</td>
  				<td width="2%">:</td>
    			<td width="25%"><input name="kdklaim" readonly value="<? echo $kdklaim; ?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
    			<tr>
      		<td width="23%">Nomor Sertifikat</td>
      		<td width="2%">:</td>
  				<td width="23%">
  			  <input type="text" name="prefix" size="2" maxlength="2" readonly value="<? echo $prefix;?>">
  				-<input type="text" name="noper" size="10" readonly value="<? echo $noper;?>"></td>
    			<td width="23%">
  				</td> 
  				<td colspan="2" width="27%"><a href="#" onClick="NewWindow('polis.php?prefix=<?echo$prefix;?>&noper=<?echo$noper;?>','',800,600,1)">Lihat Polis</a></td>
  				</tr>						
  	   </table>	 
			 
  	 </td>
  	 </tr>
  	 
		 <tr bgcolor="#a0d268">
    		<td>Nilai Benefit</td>
		 </tr>
			
  	 <tr>
      <td align="center">

  				 <table bgcolor="#d5f0ec" width="100%" cellpadding="1" cellspacing="1" border="0">
  				  <tr bgcolor="#c0c0c0">
  					 <td align="center" height="20">Nama Benefit</td>
                     <td align="center">Nilai Benefit</td>
  					 <td align="center">Nilai Benefit Sudah diklaim</td>
  					 <td align="center">Nilai yang akan diklaim</td>
  					 <td align="center">Klp</td>
  					 <td align="center">Pilih</td>
     				</tr>
  					
    				<?
    				switch($kdklaim)
    				{
    				  	case "RAWATINAP" : $kdrumus="RWTINAP"; break;
    					case "CACAT" : $kdrumus="CCTTPPA"; break;
    					case "MENINGGAL" : $kdrumus="SBNF"; break;
    				}
					if ($kdklaim=='RTI') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='TI'";
					}
					else if ($kdklaim=='TPD') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='TPD'";
					}
					else if ($kdklaim=='CI53') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='CI53'";
					}
					else if ($kdklaim=='ADDB') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='ADDB'";
					}
					else if ($kdklaim=='SDB') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='SPBD'";
					}
					else if ($kdklaim=='STPD') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='SPTPD'";
					}
					else if ($kdklaim=='PDB') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='PBD'";
					}
					else if ($kdklaim=='PTPD') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='PBTPD'";
					}
					else if ($kdklaim=='WAIVER') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='WAIVER'";
					}
					else if ($kdklaim=='WPTPD') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='WPTPD'";
					}
					else if ($kdklaim=='WPCI') {
					$sql = "select * from $DBUser.tabel_223_transaksi_produk A, $DBUser.TABEL_207_KODE_BENEFIT B
					where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND A.KDBENEFIT=B.KDBENEFIT 
					and a.kdbenefit='WPCI51'";
					}
					else {
    				$sql = "select d.rumus,c.kdrumusbenefit,a.kdproduk,b.kdkelompokbenefit,a.kdbenefit,nvl(a.nilaibenefit,0) nilaibenefit,".
    						   "nvl(a.status,'0') status,to_char(a.expirasi,'DD/MM/YYYY') expirasi, b.namabenefit, ".
    							 "decode(sign(months_between(sysdate,expirasi)),1,'1','0','1','0') cek ".
    							 "from $DBUser.tabel_223_transaksi_produk a, $DBUser.tabel_207_kode_benefit b, ".
    							 "$DBUser.tabel_206_produk_benefit c, $DBUser.tabel_224_rumus d  ".
    							 "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
    							 "and a.kdbenefit=b.kdbenefit(+) and c.kdrumusbenefit=d.kdrumus(+) ".
    							 "and a.kdjenisbenefit <> 'T' and a.kdproduk=c.kdproduk(+) and a.kdbenefit=c.kdbenefit(+) ".
    							 "and c.kdrumusbenefit='$kdrumus' ".
    							 "order by a.expirasi ";}
    			  //echo $sql;
    				$DB->parse($sql);
    				$DB->execute();
    				$i=1;
    				while ($arr=$DB->nextrow()) {
    				 $kdbnft   = $arr["KDBENEFIT"];
  					 $kdproduk = $arr["KDPRODUK"];
    				 $nilai 	 = $arr["NILAIBENEFIT"];
  					 if($kdklaim=="CI53")
  					 {
    					$sql = "select sum(nilaibenefit) as jmlsudahklaim from $DBUser.tabel_901_pengajuan_klaim where ".
    							   "prefixpertanggungan='$prefix' and ".
    								 "nopertanggungan='$noper' and ".
    								 "kdklaim='$kdklaim'";
    								 //echo "<br>".$sql."<br>";
    					$DB->parse($sql);
    		 			$DB->execute();	
    		 			$max=$DB->nextrow();
    		 			$maxklaim = $max["MAXNOKLAIM"];
  						$jmlklaim = $max["JMLSUDAHKLAIM"];
						}
						
  					 if($kdklaim=="RAWATINAP" && $kdbnft=="BNFRWT")
  					 {
    					$sql = "select max(no_klaim) as maxnoklaim,sum(nilaibenefit) as jmlsudahklaim from $DBUser.tabel_905_historis_klaim_pa where ".
    							   "prefixpertanggungan='$prefix' and ".
    								 "nopertanggungan='$noper' and ".
    								 "kdklaim='$kdklaim' and kdbenefit='".$kdbnft."'";
    								 //echo "<br>".$sql."<br>";
    					$DB->parse($sql);
    		 			$DB->execute();	
    		 			$max=$DB->nextrow();
    		 			$maxklaim = $max["MAXNOKLAIM"];
  						$jmlklaim = $max["JMLSUDAHKLAIM"];
    					$noklaim	= $maxklaim+1; 
    					$echox 		= $maxklaim." | ".$noklaim." | ".$nilai." - ".$jmlklaim."<br>";
  						if($noklaim > 2)
  						{
  						  $note	 		= "<font color=red>Sudah diklaim!</font>";
  						}else
  						{
  						  $note	 		= "Klaim ke ".$noklaim." (Max 2x)";
  						}
  					 }
  		 
    				 //echo $arr["RUMUS"];
    				 if (is_null($nilai)||$nilai==0) {
    				  $sqa = "select $DBUser.formula.runx('$prefix','$noper','$tglmeninggal','".$arr["RUMUS"]."') bnfthit from dual ";
    					$DA->parse($sqa);
    					$DA->execute();
    					$arq=$DA->nextrow();
     					$nilai = $arq["BNFTHIT"];
    				  //echo $sqa;
    				 } 

  					 echo "<input type=\"hidden\" name=\"kdbnft\" value=\"$kdbnft\">";
  					 
  					 if($kdklaim!="ADDB") // sembunyikan jika klaim cacat
  					 {
  					 
      				 include "../../includes/belang.php";
    					 print( "<td align=\"left\">".$arr["NAMABENEFIT"]."</td>\n" );
      				  print( "<td align=\"right\">".number_format((round($nilai,2)),2,",",".")."</td>\n" );
					  
        			 if ($arr["KDPRODUK"]=='J30' && $arr["KDKELOMPOKBENEFIT"]=='D') {
        			  print( "<td align=\"right\"><input type=text name=$kdbnft  size=10 class=\"akunc\" onfocus=\"highlight(event)\" value=".round($nilai,2)." ></td>\n" );
        			 } else { //echo 'xxxxxx';
      				 // print( "<td align=\"right\"><input type=text readonly name=$kdbnft  size=10 class=\"akund\"  value=".round($jmlklaim,2)." ></td>\n" );
					 if ($jmlklaim=="") {$jmlklaim=0;} else {$jmlklaim=$jmlklaim;} 
        			  print( "<td align=\"right\">".number_format((round($jmlklaim,2)),2,",",".")."</td>\n" );
        			 }
      				 print( "<td align=\"center\"><input type=text name=nilaiklaim size=10 class=\"akund\" value=".($nilai-$jmlklaim)."> ".$note."</td>\n" );
        			 print( "<td align=\"center\">".$arr["KDKELOMPOKBENEFIT"]."</td>\n" );
        			 
      				 switch ($arr["STATUS"]) { 
    					  case '8' :
      					 if ($arr["KDKELOMPOKBENEFIT"]=='B'||$arr["KDKELOMPOKBENEFIT"]=='T'||$arr["KDKELOMPOKBENEFIT"]=='A') {
      					  $option = "<font size=3>K</font>";
      					 } else {	
      					  $option = "KLAIM"; 
      					 }	
      					 break;
      					
      					case '9' :
      					 $option = "BERAKHIR"; 
      					 break;
      					
      					default :
      					 if ($klp=='B'||$klp=='A'||$klp=='T' || $klp=='E') {
      					  if ($klp==$arr["KDKELOMPOKBENEFIT"] && (!$arr["EXPIRASI"]=='') && ($arr["CEK"]=='1')) {
      					   $option = "<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"Cek$kdbnft(document.propmtc)\">"; 
      					  } else {	
      					   $option = "";
      					  }
      					 } else {
      					   $option = "<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"Cek$kdbnft(document.propmtc)\">"; 
      					 }	
      					 break;
      				 }	
      				 print( "<td class=\"verdana9barak\" align=\"center\">".$option."</td>\n" );
        			 print( "</tr>" );
    					 
    				 }
    				 $i++;
    				}		 
  
    				if($kdklaim=="CACAT" || $kdklaim=="ADDB")
    				{
      				$sql = "select kd_cacat,nama_cacat,persentase from $DBUser.tabel_906_pros_cacattetap WHERE keterangan='$kdklaim'  order by kd_cacat";
      				//echo $sql;
					$DB->parse($sql);
      				$DB->execute();
      				$i=1;
    					//echo "<table>";
						$j=0;
      					while ($rar=$DB->nextrow()) 
      					{
    					$kdcct = $rar["KD_CACAT"];
						$nmcct = $rar["NAMA_CACAT"];
						include "../../includes/belang.php";
      				  	echo "<td align=\"left\">".$rar["NAMA_CACAT"]."</td>" ;
    					echo "<td align=\"right\">".$rar["PERSENTASE"]." JUA</td>" ;
						
    					$sqlx = "select max(no_klaim) as maxnoklaim,sum(nilaibenefit) as jmlsudahklaim from $DBUser.tabel_905_historis_klaim_pa where ".
    							   "prefixpertanggungan='$prefix' and ".
    								 "nopertanggungan='$noper' and ".
    								 "kdklaim='$kdklaim' and kd_cacat='".$kdcct."'";
    								 //echo "<br>".$sqlx."<br>";
    					$DA->parse($sqlx);
    		 			$DA->execute();	
    		 			$max=$DA->nextrow();
    		 			$maxklaim = $max["MAXNOKLAIM"];
  						$jmlklaim = $max["JMLSUDAHKLAIM"];
    					$noklaim	= $maxklaim+1; 
    					$echox 		= $maxklaim." | ".$noklaim." | ".$nilai." - ".$jmlklaim."<br>";
  						//echo $max["MAXNOKLAIM"];
						print( "<td align=\"right\">".number_format((round($jmlklaim,2)),2,",",".")."</td>\n" );
      				  	echo "<td align=\"right\">".
  									 			//"<input type=text name=$kdbnftcct class=\"akunc\" onfocus=\"highlight(event)\" value=".round(($PER->jua*$rar["PERSENTASE"]),2)." class=\"akunc\" size=20 >".
  									 			"<input type=text name=\"kdbnftcct[]\" class=\"akunc\" onfocus=\"highlight(event)\" value=".round(($nilai*$rar["PERSENTASE"]/100)-$jmlklaim,2)." class=\"akunc\" size=20 >".
  									 			"<input type=hidden name=\"jumlahnilai[]\" value=".round(($nilai*$rar["PERSENTASE"]/100)-$jmlklaim,2).">".
  												"<input type=hidden name=\"namacacat[]\" value=\"".$nmcct."\">".
												"<input type=hidden name=\"jmlbaris[]\" value=1>".
												"<input type=hidden name=\"codecacat[]\" value=".$kdcct.">".
  									 "</td>" ;
        			  	echo "<td></td>";
  						echo "<td align=\"center\"><input type=\"checkbox\" name=\"kc$j\" value=\"$kdcct\"></td>" ;
      			    	echo "</tr>";
      					$i++;
						$j++;
    					}
    				}
    				//echo $sql;
					if($kdklaim=="SDB" || $kdklaim=='STPD' || $kdklaim=='PDB' || $kdklaim=='PTPD' || $kdklaim=='WAIVER' || $kdklaim=='WPCI' || $kdklaim=='WPTPD'){
						echo "<tr>";
						//echo "<td></td>";
  						echo "<td align=\"left\" colspan=6>Tgl. Mulai&nbsp;<input type=text name=\"tglmulai\" class=\"akunc\" onfocus=\"highlight(event)\" value='' class=\"akunc\" size=10 >&nbsp;s/d&nbsp;
						<input type=text name=\"tglsampai\" class=\"akunc\" onfocus=\"highlight(event)\" value='' class=\"akunc\" size=10 >
						&nbsp;besar premi gratis &nbsp;
						<input type=text name=\"premigratis\" onfocus=\"highlight(event)\"  onKeyUp=\"GantiNilai(this)\" class=\"akunc\" size=10 value=\"$nilai\" ></td>" ;
      			    	echo "</tr>";
						echo "<tr>";
						//echo "<td></td>";
  						echo "<td align=\"left\" colspan=6>Total besar premi gratis&nbsp;
						<input type=text name=\"premigratistotal\" onfocus=\"highlight(event)\" class=\"akunc\" size=10 value=\"$premigratistotal\" ></td>" ;
      			    	echo "</tr>";
					}
    				?>
						</table>
			 </td>
  		</tr>
			
  		<tr bgcolor="#a0d268">
    		<td>Cek Dokumen</td>
			</tr>
			
  		<tr>
    		<td>
    		<?
    		if ($cekbnf=="ON"){
    		
    		} 
			else 
			{
    			/*$sql = "select ".
							"a.kddokumen,a.userupdated,a.status,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, b.namadokumen ".
    					"from ".
							"$DBUser.tabel_904_cek_dok_klaim a, ".
							"$DBUser.tabel_903_dokumen_klaim b ".
    					"where ".
							"a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
							"and a.kddokumen=b.kddokumen ".
    						"and a.kdklaim='$kdklaim' ".
							"and to_char(a.tglpengajuan,'DD/MM/YYYY')='$tglpengajuan' ".
    					"order by b.kddokumen ";*/
    			$sql = "SELECT a.kddokumen, a.namadokumen, NVL(c.status,0) status, 
							TO_CHAR(c.tglupdated, 'dd/mm/yyyy') tglupdated, c.userupdated
						FROM $DBUser.tabel_903_dokumen_klaim a
						INNER JOIN $DBUser.tabel_904_syarat_klaim b ON a.kddokumen = b.kddokumen
						LEFT OUTER JOIN $DBUser.tabel_904_cek_dok_klaim c ON a.kddokumen = c.kddokumen
							AND b.kdklaim = c.kdklaim
							AND c.prefixpertanggungan = 'LBl'
							AND c.nopertanggungan = '002385902'
							AND TO_CHAR(c.tglpengajuan, 'dd/mm/yyyy') = '$tglpengajuan'
						WHERE b.kdklaim = '$kdklaim'";
    				//echo $sql;
    				$DB->parse($sql);
    				$DB->execute();
    				$kam=$DB->result();
    				$coun=count($kam);
    		?>
    		<table bgcolor="#d5f0ec" width="100%" cellpadding="1" cellspacing="1" border="0">
    		  <tr bgcolor="#c0c0c0">
    					 <td align="center" height="20">No</td>
    					 <td align="center">Nama Dokumen</td>
    					 <td align="center">Status</td>
    					 <td align="center">Tanggal</td>
    					 <td align="center">User</td>
    			</tr>
    					
    				<?
    
    				$i=1;
    				foreach ($kam as $foo => $arr) {
    				 include "../../includes/belang.php";
      			 print( "<td align=\"center\">$i</td>\n" );
      			 print( "<td align=\"left\">".$arr["NAMADOKUMEN"]."</td>\n" );
      			 
    				 switch ($arr["STATUS"]) { 
    				  case '0' :
    					 $option = "<option value=\"1\" class=sudah>SUDAH DITERIMA</option>". 
    					           "<option selected value=\"0\" class=belum>BELUM DITERIMA</option>".
    										 "<option value=\"2\">TIDAK DIPERLUKAN</option>"; 
    					 break;
    					case '1' :
    					 $option = "<option selected value=\"1\" class=sudah>SUDAH DITERIMA</option>". 
    					           "<option value=\"0\">BELUM DITERIMA</option>".
    										 "<option value=\"2\">TIDAK DIPERLUKAN</option>"; 
    					 break;
    					case '2' :
    					 $option = "<option value=\"1\">SUDAH DITERIMA</option>". 
    					           "<option value=\"0\">BELUM DITERIMA</option>".
    										 "<option selected value=\"2\">TIDAK DIPERLUKAN</option>"; 
    					 break;
    				 }	
    				 print( "<td class=\"arial10ungub\" align=\"center\">".
    				 "<select name=\"".$arr["KDDOKUMEN"]."\" onfocus=\"highlight(event)\" class=\"buton\"> ".
    				  $option.
    				 "</select>".
    				 "</td>\n" );
      			 print( "<td align=\"center\">".$arr["TGLUPDATED"]."</td>\n" );
      			 print( "<td align=\"left\">".$arr["USERUPDATED"]."</td>" );
    				 print( "</tr>" );
    				 //print( "<input type=\"hidden\" name=\"".$arr["KDDOKUMEN"]."\">" );
    
    				 $i++;
    				}		 
    				?>	
    		  </table>
    		<? } ?>
    	 </td>
  		</tr>
			
  		<tr bgcolor="#f3e8c2">
  				<td><font size=3 color=red>K</font>&nbsp;&nbsp;&nbsp;&nbsp;berarti sudah pernah diklaim sebelumnya (Termasuk Tahapan / Anuitas / Beasiswa). Tgl Jatuh Tempo adalah Jatuh Tempo untuk pertama Kalinya. Jatuh tempo yang diklaim ditunjukkan oleh Tanggal Pengajuan diatas</td>
  		</tr>			
				
  		<tr bgcolor="#f5e4d6">
      	 <td align="left">Pilihlah Benefit Sesuai Ketentuan Polis dengan Memberikan CEK pada checkbox di kolom Pilih. Kesalahan Entry Menjadi Tanggung Jawab Saudara/i</td>
  		</tr>
			
			<tr>
  		   <td align="right">
  				 <input type="hidden" name="sebabmeninggal" value="<?=$sebabmeninggal;?>">
  				 <input type="hidden" name="tglmeninggal" value="<?=$tglkejadian;?>">
  				 <input type="hidden" name="kdproduk" value="<?=$kdproduk;?>">
  				 <input type="hidden" name="cekbnf" value="<?=$cekbnf;?>">
  				 <input type="hidden" name="namadokter" value="<?=$namadokter;?>">
  				 <input type="hidden" name="alamatdokter" value="<?=$alamatdokter;?>">
  				 <input type="hidden" name="pemohon" value="<?=$pemohon;?>">
  				 <input type="submit" name="submit" value="Submit">
			   </td>
  		</tr>
  </table>
  <?	include "../../footer.php"; ?>
  </form>
  </div>
  </body>
  </html>
<?}?>