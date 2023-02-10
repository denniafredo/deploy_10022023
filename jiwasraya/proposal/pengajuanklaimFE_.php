<?
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/duit.php";
	include "../../includes/tunggakan.php";
	include "../../includes/gadai.php";
	include "../../includes/tgl.php";
	include "../../includes/kantor.php";
	include "../../includes/constant.php";
	include "../../includes/formula44.php";
		
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
	
	$prefix = strtoupper($prefix);
	$DB			=	new database($userid, $passwd, $DBName);
	$DA			=	new database($userid, $passwd, $DBName);
	$DB1			=	new database($userid, $passwd, $DBName);
	$PER		=	New Pertanggungan($userid,$passwd,$prefix,$noper);
	$kdproduk = $PER->produk;
	$kdsts = $PER->kdstatusfile;
	$TR = New Transaksi($userid,$passwd);
	$PWK = New Kantor($userid,$passwd,$kantor);
	$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$KP  = New KantorPusat($userid,$passwd);
	$TGK  = New Tunggakan($userid,$passwd,$prefix,$noper,$tglpengajuan);

	
	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	
	$sql = "select to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan,to_char(tglmeninggal,'DDMMYYYY') tglmeninggal ".
			   "from $DBUser.tabel_901_pengajuan_klaim ".
			 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' ".
				 "and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$tglpengajuan=$arr["TGLPENGAJUAN"];				 
	$tglmeninggal=$arr["TGLMENINGGAL"];
	
	//echo "tgl pengajuan = ".$tglpengajuan;
	//die;
					 	
if ($submit=='Submit') {

  $pertanggungan=$prefix."-".$noper;
	//echo $pertanggungan;

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
	 			 		
			$sqa = "select kdbenefit ".
						  "from $DBUser.tabel_223_transaksi_produk  ".
							"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							"order by kdbenefit desc ";
			 //echo $sqa;
			$DB->parse($sqa);
			 $DB->execute();
					
			$nilaibnft = 0;		
			$ok = true;
			$bnftklm = array();
			while ($arr=$DB->nextrow()){	
			echo ${'cb'.$arr["KDBENEFIT"]}.' disini '.' cb'.$arr["KDBENEFIT"];	
			 if (${'cb'.$arr["KDBENEFIT"]}) {
			 		
			   echo $arr["KDBENEFIT"]."|".$$arr["KDBENEFIT"]."|".${'cb'.$arr["KDBENEFIT"]}."<br>";
				
				if($arr["KDBENEFIT"]=="DEATHKC" && (substr($kdproduk,0,2)=="AD" || substr($kdproduk,0,2)=="HT"))
				{
				  //echo "Siharta atau Artadana Meninggal akibat kecelakaan, benefit = nilai tunai + 200% JUA ";
					 $blnd = substr($tglpengajuan,0,2).substr($tglpengajuan,3,2).substr($tglpengajuan,6);
					 $sql = "select $DBUser.polis.nilaitebus('$prefix','$noper','$blnd') tebus from dual ";
        	 //echo $sql;
					 $DA->parse($sql);
        	 $DA->execute();
        	 $w = $DA->nextrow();
        	 $ptebus = $w["TEBUS"];
					 $nilaitebus = ($PER->valuta=='0') ? $ptebus/$PER->indexawal*$kt : $ptebus;
					 $nilaiklaim = $nilaitebus + ($PER->jua*2);
				   $nilaibnft	 = $nilaiklaim;
					 
    			 $sql = "insert into $DBUser.tabel_905_benefit_klaim ".
    				 		  "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,nilaibenefit,tglrekam,userrekam) ".
           			  "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$arr["KDBENEFIT"]."',".$nilaiklaim.",sysdate,user) ";
    			 echo $sql."<br>";
    			 die;
    			 $sqlxx=$sql;
				 $DA->parse($sql);
    			 $a=$DA->execute();
				}
				else
				{
				
				  //ditambahkan untuk produk investasi by jrobalian 28/05/2008 by Ari 24/07/2009 / JL0 & JL1 & JL2 & JL3
					if($arr["KDBENEFIT"]=="DEATHMA" && (substr($kdproduk,0,2)=="JL"))
					{
					  $nilaibenefit = $$arr["KDBENEFIT"] + $totaldanainvest;
						$nilaiinvestasi = $totaldanainvest;
					}
					else
					{
					  $nilaibenefit = $$arr["KDBENEFIT"];
					}
				$sql = "insert into $DBUser.tabel_905_benefit_klaim ".
				 		   "(prefixpertanggungan,nopertanggungan,kdklaim,tglpengajuan,kdproduk,kdbenefit,nilaibenefit,tglrekam,userrekam) ".
       			   "values ('$prefix','$noper','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'),'$kdproduk','".$arr["KDBENEFIT"]."',".$$arr["KDBENEFIT"].",sysdate,user) ";
				echo $sql."aaa<br>";
				die;
				$DA->parse($sql);
				$a=$DA->execute();
				}
				$nilaibnft += $$arr["KDBENEFIT"] + $nilaiinvestasi;
			  $ok = $ok AND $a;
				array_push($bnftklm,$arr["KDBENEFIT"]);
 			 }			
		  }		
			
			if($PER->valuta==3)
  	  {
  		  $nilaibnft = $nilaibnft;
  		} else {
  		  $nilaibnft = round($nilaibnft);
  		}
			#---------------------------------[ jika klaim meninggal ]------------------------------
			
		  if ($kdklaim=='MENINGGAL') { //kelompok meninggal
			    
  				 if ($PER->medstat=='N') 
  				 {
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
    							$mailtujuan	 = $KT->emailxlindo;
    		  				$kantortujuan = "KEPALA BAGIAN PERTANGGUNGAN ".$KT->namakantor;
    		 			 } else {
    		  				$mailtujuan	 = $KP->emailadlog;
    		  				$kantortujuan = "KEPALA BAGIAN PELAYANAN PP<BR>KANTOR PUSAT JAKARTA";
    		 			 }  
  	  			 
  				 } 
  				 else 
  				 {
  					 		$mailtujuan=$KP->emailadlog;
  		  		 		$kantortujuan = "KEPALA BAGIAN PELAYANAN PP<BR>KANTOR PUSAT JAKARTA";
  				 }  
					
					 // aturan baru mulai september 2005
					 /*
					 $mailtujuan=$KP->emailadlog;
		  		 $kantortujuan = "KEPALA BAGIAN PELAYANAN PP<BR>KANTOR PUSAT JAKARTA";
					 */
					 
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
	  		
					 @mail($mailtujuan,"PERMOHONAN ".$namaklaim." (".$pertanggungan.")",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
	 
					 $sql = "update $DBUser.tabel_901_pengajuan_klaim set emailto='$mailtujuan', ".
					 			  "userupdated=user,tglupdated=sysdate,status=4 ". 
					        "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
						 			"and kdklaim='$jnsklaim' and trunc(tglpengajuan)=trunc(sysdate)";
					 //echo $sql;
				   $DB->parse($sql);
					 $DB->execute();
				 	 $DB->commit();
					 
					 //cek apakah polis merupakan produk dengan benefit lanjut,jika YA maka akan merubah status secara otomatis menjadi klaim benefit lanjut
					  $sqlbl="select * from $DBUser.tabel_902_klaim_lanjut where kdproduk='$kdproduk' and kdklaim='$kdklaim'";
           //echo $sqlbl;
           $DB->parse($sqlbl);
           $DB->execute();
           $arrbl=$DB->nextrow();
           echo $arrbl["BENEFITLANJUT"];
           if($arrbl["BENEFITLANJUT"]=="1"){
           $kdklaim="MENINGGALX";
           $sqa = "update $DBUser.tabel_200_pertanggungan set lockmutasi='18',kdstatusfile='8', ".
					 			  "userupdated=user,tglupdated=sysdate ".
					        "where prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
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
           }else{
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
					 }
  				 print( "  <table width=\"100%\" class=tblisi>\n" );
     			 print( "  <tr class=arial8>\n" );
     			 print( "		<td width=\"100%\" colspan=2 align=\"left\"><pre>$isin</td>\n" );
     			 print( "	 </tr>\n" );
  				 print( "  <tr class=arial10>\n" );
     			 print( "		<td width=\"100%\" colspan=2><hr size=1></td>\n" );
     			 print( "	 </tr>\n" );
     			 print( "	</table>	" );
					 
    				echo "<a class=verdana10blk>Email sudah terkirim ke $mailtujuan</a><br /><br />";
    				echo "<a class=verdana10blk><font color=red><b>STATUS PERTANGGUNGAN SUDAH BERUBAH MENJADI KLAIM</b></font></a>";
    				include "footer.php"; 			 
	 		
			}
			
			
			#---------------------------------[ end meninggal ]--------------------------
			// mencari no ijin gadai
					$sql = "select max(nourut)+1 as maxurut from $DBUser.tabel_901_pengajuan_klaim ";
      		$DB->parse($sql);
        	$DB->execute();
        	$arr=$DB->nextrow();
        //	$maxurut = $arr["MAXURUT"]; 
					$nourut = $arr["MAXURUT"];
					
				/*	if (strlen($maxurut)==0) {
      		  $nourut = "1";
      		} else {
            $nourut = $maxurut + 1;
      		}*/ 
					$tglsurat = date('m')."/".date('Y');
					$noizinbaru = str_pad($nourut,4,"0",STR_PAD_LEFT);
					$noizin 		= $noizinbaru."/KLM/".$kantor."/".$tglsurat;
					
					
			 if($a){
				echo 'xxxxxxx'; 
  			  if($kdklaim=="MENINGGAL"){
    			  $sqa = "update $DBUser.tabel_901_pengajuan_klaim ".
    						   "set userptg=user,tglptg=sysdate,nilaibenefit=$nilaibnft,".//status=1, ". // tambahan  ganti status
    							 "userupdated=user,tglupdated=sysdate,tglhitung=trunc(sysdate), ".
    							 "sisagadai='$nilaigadai',sisabungagadai='$bungagadai',nourut='$nourut',noizin='$noizin' ".
    							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
    							 "and kdklaim='$kdklaim' AND to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
  							 //echo $sql;
  				} 
  				else 
  				{
					  
  				  //update status jika benfit kurang rp 50.000.000 atau usd 5.000 atau status file <> 1
  					if(($kdklaim=="EXPIRASI" && $PER->valuta==3 && $nilaibnft > 5000) || ($kdklaim=="EXPIRASI" && $PER->valuta==1 && $nilaibnft > 50000000) )// || ($PER->kdstatusfile!=1))
  					{
								 $nilaistatus=0;
      					 $mailke=$KT->emailxlindo;
      					 $emailpengirim=$PWK->emailxlindo;
      					 $kantortujuan = "KEPALA BAGIAN PERTANGGUNGAN ".$KT->namakantor;
        				 $isin .= "Kepada Yth.\n".$kantortujuan."\ndi Tempat \n\n";
      					 $isin .= "Perihal : PENGAJUAN KLAIM EXPIRASI\n";
      					 $isin .= $namaklaim."\n";
      		    	 $isin .= "Dengan ini kami sampaikan bahwa polis berikut :\n\n";
      	 	    	 $isin .= "No \tNomor Polis \tPemegang Polis\n";
              	 $isin .= "-----------------------------------------------\n";
      			 		 $isin .= "1. \t".$pertanggungan." \t".$PER->namapemegangpolis."\n";
      			 		 $isin .= "-----------------------------------------------\n\n";
      					 $isin .= "Mengajukan PERMOHONAN KLAIM EXPIRASI. \n";
      					 $isin .= "Mohon segera diproses DESISI nya.\n\n";
      			  	 $isin .= "Demikian kami sampaikan dan atas \nperhatiannya kami ucapkan terima kasih.\n\n\n";
      			  	 $isin .= $PWK->kotamadya.", ".$tanggal."\n\n";
      		    	 $isin .= $PWK->kepala."\n";
      					 $isin .= "-------------------------------\n";
      			 		 $isin .= "Branch Manager \n";
      	  		
      				   $kett  = $PER->valuta==3 ? "Nilai benefit diatas 5000 USD" : "Nilai benefit diatas rp 50.000.000";
      					 @mail($mailke,"PERMOHONAN ".$namaklaim." (".$pertanggungan.")",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
      	 				 echo "$kett. Email sudah terkirim ke $mailke untuk proses desisi (akseptasi).<br><br>";
						 $sqlsip="select sysdate from dual";
  					}
  					else
  					{
  				   		 $nilaistatus=1; // perlu desisi pusat
						 $sqlsip="begin $DBUser.sip('$prefix','$noper','$kantor','$kdklaim',to_date(".date('d/m/Y').",'DD/MM/YYYY'));end;";
  					}

				    $sqa = "update $DBUser.tabel_200_pertanggungan set lockmutasi='18', ".
					 			  "userupdated=user,tglupdated=sysdate ".
					        "where prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
					 //echo $sqa;
				   	 $DB->parse($sqa);
					 $DB->execute();
				 	 $DB->commit();
					 
  					$sqa = "update $DBUser.tabel_901_pengajuan_klaim ".
      						   	 "set userptg=user,tglptg=sysdate,nilaibenefit=$nilaibnft,status=$nilaistatus, ". // tambahan  ganti status
      							 	 "userupdated=user,tglupdated=sysdate,tglhitung=trunc(sysdate),tglsip=sysdate, ". // jika tidak memerlukan akseptasi HO,RO 
 "sisagadai='$nilaigadai',sisabungagadai='$bungagadai',nourut='$nourut',noizin='$noizin',refund='$nilairefund' ".
  								 "where ".
      								 "prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
      							 	 "and kdklaim='$kdklaim' AND to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
  				}
  				//echo $sql;
					//echo $sqa;
  				$DB->parse($sqa);
  				$DB->execute();
				$DB1->parse($sqlsip);
  				$DB1->execute();
					
  				for ($i=0; $i<count($bnftklm); $i++) {
    				 $sqa ="update $DBUser.tabel_223_transaksi_produk ".
    						   "set status='8' ".
    							 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
    							 "and kdbenefit ='".$bnftklm[$i]."' ";
    				 echo $sqa;
    				 $DB->parse($sqa);
    				 $DB->execute();
  				}			 
				
			 print( "  <table width=\"100%\">\n" );
   			 print( "   <tr>\n" );
			 print( "    <td align=\"left\" class=verdana10blk>Data sudah tersimpan silakan lanjutkan proses berikutnya <a href=\"#\" onclick=\"window.location.replace('entryklaim.php')\">disini</a></td>\n" );
   			 if($modul=="2KU"){
				 print( "    <td align=\"right\" class=verdana10blk><a href=\"#\" onclick=\"window.location.replace('pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=$kdklaim&tglpengajuan=$tglpengajuan')\">Lanjut</a></td>\n" );
 	       } 
	  		 print( "	 </tr>\n" );
   			 print( "	</table>	" );
			 }	 
			 else
			 {
			   echo $kdklaim;
			   echo "Data tidak bisa masuk ke tabel benefit klaim.  produk benefit(t202)!";
			 }
			 // end $a;
			 
			 
			 /*-------------------------------------
			 dokumen klaim 
			 ---------------------------------------*/
			 
			 if($kdklaim=="EXPIRASI" || $kdklaim=="MENINGGAL")
			 {
				 if($kdklaim=="MENINGGAL")
				 {
				   $filtertgk = "and tglbooked <= trunc(to_date('$tglmeninggal','DD/MM/YYYY')) ";
				 }
				 else
				 {
				   $filtertgk = "";
				 }
				 $sql = "select sum(premitagihan) as tunggakan from $DBUser.tabel_300_historis_premi 
				 				where prefixpertanggungan='$prefix' and nopertanggungan='$noper' 
								$filtertgk 
								and tglseatled is null";
				 //echo $sql;
				 $DB->parse($sql);
  			 $DB->execute();
  			 $arr=$DB->nextrow();
  			 $tunggakanpremi = $arr["TUNGGAKAN"];
				 $tunggakanpremi = $PER->valuta==0 ? round(($tunggakanpremi/$PER->indexawal),2) : $tunggakanpremi;
				 $filtertunggakan =  ",tunggakan='$tunggakanpremi' ";
				
			 }
			 else 
			 {
			   $filtertunggakan =  "";
			 }
			 
			 $sqa = "update $DBUser.tabel_901_pengajuan_klaim set userptg=user,".
			 				     "unitlink='$jmlunit',nab='$nilainab',".
									 "tglptg=sysdate $filtertunggakan ".
						   "where ".
    							 "prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
    							 "and kdklaim='$kdklaim' and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
			 //echo $sqa;
			 $DB->parse($sqa);
			 $DB->execute();
		 					
  	 	 $sqa = "select kddokumen ".
						   "from $DBUser.tabel_904_syarat_klaim  ".
							 "where kdklaim='$kdklaim' order by kddokumen desc ";
			 //echo $sqa;
			 $DB->parse($sqa);
			 $DB->execute();
			 $i=0;
			 while ($arr=$DB->nextrow()){			
  				//$sql = "update $DBUser.tabel_904__dok_klaim set status='".$$arr["KDDOKUMEN"]."' ,tglupdated=sysdate,userupdated=user ".
         	$sql = "update $DBUser.tabel_904__dok_klaim set status='".$sel[$i]."' ,tglupdated=sysdate,userupdated=user ".
         			   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' ".
  			 				 "and kddokumen='".$arr["KDDOKUMEN"]."' and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
  				//echo $sql."<br />";
					$DA->parse($sql);
  				$DA->execute();
			 $i++;
			 }

			 
			 #--------------------------[ end isi dokumen ]---------------	
				
} 
else 
{

	$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
  $DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$tanggal = $w["NOW"];
  ?>
  <html>
  <head>
  <title>Pengajuan Klaim Tanggal </title>
  <link href="../jws.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  <!--
  input, textarea, select {
  border-top-width : 1px; 
  border-right-width : 1px; 
  border-bottom-width : 1px; 
  border-left-width : 1px;  
  }
  -->
  </style>
  <?
  $DU   = new Duit($userid,$passwd);
  $TR   = new Transaksi($userid,$passwd);

  $kt=$TR->Kurs($PERT->valuta,$tglsip);
  $ks=$DU->Kurs($PERT->valuta,$tglsip);
  ?>
  
	<script language="javascript"> 	
  function di(sel){
        	var f = document.propmtc;
        		for(i=0;i<f.sel.length;i++){
  					  //alert(f.sel[i].value);
        			if(f.sel[i].value == 0){
        				f.submit.disabled = true;
						
						    
  							break;
        			}
  						else
  						{
  						  f.submit.disabled = false;
  						}
						
						
        		}
  	    if (f.nilaigadai.value*1+f.bungagadai.value*1>=f.jmltahapan.value*1) {
							alert('Nilai benefit lebih keci dari nilai pinjaman!');
							//f.submit.disabled=true;
							}
  }
  </script>
  <script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
  <?
    print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
    print( "<!--\n" );
     $sql = "select a.kdbenefit ".
  	 			  "from $DBUser.tabel_223_transaksi_produk a,$DBUser.tabel_207_kode_benefit b ".
  		 	    "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
  					"and b.kdkelompokbenefit='$klp' and a.kdbenefit=b.kdbenefit ";
	//echo $sql;				
  	 $DB->parse($sql);
  	 $DB->execute();
  	 while ($arr=$DB->nextrow()) {							 
      print( "function ".$arr["KDBENEFIT"]."(theForm) {\n" );
    	print( "   if (theForm.cb".$arr["KDBENEFIT"].".checked) {\n" );
		print( " theForm.jmltahapan.value=(theForm.jmltahapan.value*1)+(theForm.".$arr["KDBENEFIT"].".value*1);" );
			print( " if(theForm.cb".$arr["KDBENEFIT"].".name=='cbBNFTHPPT') {\n" );
			//print( "theForm.nilaigadai.value=theForm.saldopokok.value;" );
			print( "theForm.nilaigadai.setAttribute('readOnly','readonly');" );
			print( "	 }	\n" );
    	//print( "	  theForm.submit.disabled=false\n" );
    	print( "   } else {\n" );
		print( " theForm.jmltahapan.value=(theForm.jmltahapan.value*1)-(theForm.".$arr["KDBENEFIT"].".value*1);" );
			print( " if(theForm.cb".$arr["KDBENEFIT"].".name=='cbBNFTHPPT') {\n" );
			print( "theForm.nilaigadai.removeAttribute('readOnly','readonly');" );
			
			print( "	 }	\n" );
		//print( " alert(theForm.jmltahapan.value);" );
    	print( "    theForm.submit.disabled=true\n" );
    	print( "	 }	\n" );
		
		print( "   if (((theForm.nilaigadai.value*1)+(theForm.bungagadai.value*1))>theForm.jmltahapan.value) {\n" );
		print( " alert('Nilai benefit lebih keci dari nilai pinjaman!');" );
    	print( "    theForm.submit.disabled=true\n" );
    	print( "	 }	\n" );
    	print( " }\n" );
     }
  	 print( "//-->\n" );
     print( "</script>\n" );
  	 //echo $sql;
  ?>
  </head>
  <? 
  if ($bnf=="ON")
  {
  ?>
  <body onLoad="document.propmtc.submit.disabled=false">
  <? 
  } 
  else 
  { 
  ?>
  <body onload="document.propmtc.submit.disabled=true">
  <? 
  } 
  ?>
  <div align="center">

  <form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>">
  <input type="hidden" name="kdklaim" value="<? echo $kdklaim ?>">
  <input type="hidden" name="tglpengajuan" value="<? echo $tglpengajuan ?>">
  <input type="hidden" name="jmltahapan">
  <table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="800" align="center">
     <tr>
     <td colspan="2" class="tblisi"> 
  		 <table border="0" cellpadding="1" width="100%" cellspacing="1">
   		  <tr>
         <td align="center" colspan="6" class="tblhead"><b>PERHITUNGAN NILAI KLAIM</b></td>
   		  </tr>
   		  <tr>	 
  		   <td align="left" colspan="6" class="hijao">
  	 		  <li>Seksi Pertanggungan Perwakilan Mencocokkan Hitungan Nilai Klaim Yang Diterima</b>
  	 		 </td>
   	    </tr>
  
  
  				<tr>
  				<td class="arial10" width="23%">Tanggal Pengajuan</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><input name="tglpengajuan" class="a" readonly value="<? echo $tglpengajuan; ?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
  				
  				<tr>
  				<td class="arial10" width="23%">Klaim Yang Diajukan</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><input name="kdklaim" class="a" readonly value="<? echo $kdklaim; ?>"></td>
  				<td width="50%" colspan="3"></td>
  				</tr>
    			<tr>
      		<td class="arial10" width="23%">Nomor Polis</td>
      		<td class="arial9" width="2%">:</td>
  				<td class="arial9" width="23%">
  			  <input type="text" name="prefix" size="2" maxlength="2" class="a" readonly value="<? echo $prefix;?>">
  				-<input type="text" name="noper" size="10" class="a" readonly value="<? echo $noper;?>"></td>
    			<td class="arial9" width="23%">
  				</td> 
  				<td class="arial9" colspan="2" width="27%" class="arial10"><a href="#" onClick="NewWindow('polis.php?prefix=<?echo$prefix;?>&noper=<?echo$noper;?>','',800,600,1)">Lihat Polis</a></td>
  				</tr>
  											
  	   </table>	 
  	 </td>
  	 </tr>
  	 
  	 <tr>
      <td colspan="2"   class="tblisi">
  		<table  width="100%" border="0" cellspacing="1" cellpadding="0" class="tblisi1">
  				<tr>
  				<td colspan="6">
  				 <table width="100%" cellpadding="1" cellspacing="1" border="0" class="tblisi">
  				  <tr class="hijao">
  					 <td align="center">No</td>
  					 <td align="center">Nama Benefit</td>
  					 <td align="center">Nilai</td>
  					 <td align="center">Jatuh Tempo</td>
  					 <td align="center">Klp</td>
  					 <td align="center">Pilih</td>
     				</tr>
  				<?
				
					if($kdproduk=="JSP" ||$kdproduk=="JSAP2"||$kdproduk=="JSAP1"|| $kdproduk=="SW5" || $kdproduk=="SPH" || $kdproduk=="JSPS"){
					  $monthklaim = "decode(sign(months_between(add_months(SYSDATE,6),expirasi)),1,'1','0','1','0')  ";
					} else {
					  $monthklaim = "decode(sign(months_between(sysdate,expirasi)),1,'1','0','1','0')  ";
					}
  				
				
				if ($kdproduk=="JSKEL") {
					$sql="SELECT   d.rumus,
							   c.kdrumusbenefit,
							   a.kdproduk,
							   b.kdkelompokbenefit,
							   a.kdbenefit,
							   NVL (a.nilaibenefit, 0) nilaibenefit,
							   NVL (a.status, '0') status,
							   TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi,
							   b.namabenefit||' ('||namaklien1||')' namabenefit,
							   DECODE (SIGN (MONTHS_BETWEEN (SYSDATE, expirasi)),
									   1, '1',
									   '0', '1',
									   '0')
								  AS is_pil
						FROM   $DBUser.tabel_223_transaksi_produk a,
							   $DBUser.tabel_207_kode_benefit b,
							   $DBUser.tabel_206_produk_benefit c,
							   $DBUser.tabel_224_rumus d,
							   $DBUser.TABEL_219_PEMEGANG_POLIS_BAW e,
							   $DBUser.tabel_100_klien f
					   WHERE       a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper'
							   and e.noklien=f.noklien
							   AND a.prefixpertanggungan = e.prefixpertanggungan
							   AND a.nopertanggungan = e.nopertanggungan
							   AND a.kdbenefit = b.kdbenefit(+)
							   AND c.kdrumusbenefit = d.kdrumus(+)
							   AND a.kdjenisbenefit <> 'T'
							   and a.kdbenefit='DEATHMA'
							   AND a.kdproduk = c.kdproduk(+)
							   AND a.kdbenefit = c.kdbenefit(+)
					ORDER BY   a.expirasi";
				}
				else {
				$sql = "select ".
							 	 		 "d.rumus,c.kdrumusbenefit,a.kdproduk,b.kdkelompokbenefit,a.kdbenefit,nvl(a.nilaibenefit,0) nilaibenefit,".
  						   		 "nvl(a.status,'0') status,to_char(a.expirasi,'DD/MM/YYYY') expirasi, b.namabenefit, ".
  							 		 //"decode(sign(months_between(sysdate,expirasi)),1,'1','0','1','0')  ".
										 $monthklaim.
  							 "as is_pil from ".//add is_pil by salman 26072011
    								 "$DBUser.tabel_223_transaksi_produk a, ".
										 "$DBUser.tabel_207_kode_benefit b, ".
      							 "$DBUser.tabel_206_produk_benefit c, ".
										 "$DBUser.tabel_224_rumus d  ".
  							 "where ".
    								 "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
      							 "and a.kdbenefit=b.kdbenefit(+) and c.kdrumusbenefit=d.kdrumus(+) ".
      							 "and a.kdjenisbenefit <> 'T' and a.kdproduk=c.kdproduk(+) ".
										 "and a.kdbenefit=c.kdbenefit(+) ".
  							 "order by a.expirasi ";
							 }
  			  //echo $sql;
  				$DB->parse($sql);
  				$DB->execute();
  				$i=1;
  				while ($arr=$DB->nextrow()) {
  				 $kdbnft = $arr["KDBENEFIT"];
  				 $nilai =  $arr["NILAIBENEFIT"];

  				 if (is_null($nilai)||$nilai==0) {
    				  $sqa = "select $DBUser.formula.runy('$prefix','$noper','$tglmeninggal','".$arr["RUMUS"]."') bnfthit from dual ";
    					//echo $sqa."<br />";
							$DA->parse($sqa);
    					$DA->execute();
    					$arq=$DA->nextrow();
     					$nilai = $arq["BNFTHIT"];
  				 } 
  				 
  				 include "../../includes/belang.php";
  				 print( "<td class=\"verdana8\" align=\"center\">$i</td>\n" );
    			 print( "<td class=\"verdana8\" align=\"left\">".$arr["NAMABENEFIT"]."</td>\n" );
  				 if ($arr["KDPRODUK"]=='J30' && $arr["KDKELOMPOKBENEFIT"]=='D') {
    			  print( "<td class=\"verdana8\" align=\"right\"><input type=text name=$kdbnft class=\"akunc\" onfocus=\"highlight(event)\" value=".round($nilai,2)." ></td>\n" );
    			 } else {
				 	if($kdsts=='4'){
						print( "<td class=\"verdana8\" align=\"right\"><input type=text name=$kdbnft class=\"akund\"  value=".round($nilai,2)." ></td>\n" );
					}else{
  				  		print( "<td class=\"verdana8\" align=\"right\"><input type=text name=$kdbnft readonly class=\"akund\"  value=".round($nilai,2)." ></td>\n" );
				  	}
    			 }
  				 print( "<td class=\"verdana8\" align=\"center\">".$arr["EXPIRASI"]."</td>\n" );
    			 print( "<td class=\"verdana8\" align=\"center\">".$arr["KDKELOMPOKBENEFIT"]."</td>\n" );
    			 
  				 switch ($arr["STATUS"]) { 
  				  case '8' :
  					 if ($arr["KDKELOMPOKBENEFIT"]=='B'||$arr["KDKELOMPOKBENEFIT"]=='T'||$arr["KDKELOMPOKBENEFIT"]=='A') {
  					  $option = "<font size=3>K</font>";//<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"$kdbnft(document.propmtc)\">"; 
  					 } else {	
  					  $option = "KLAIM"; 
  					 }	
  					 break;
  					case '9' :
  					 $option = "BERAKHIR"; 
  					 break;
  					default :
  					 if ($klp=='B'||$klp=='A'||$klp=='T' ) {
//  					  if ($klp==$arr["KDKELOMPOKBENEFIT"] && (!$arr["EXPIRASI"]=='') && ($arr[""]=='1')) {
					  if ($klp==$arr["KDKELOMPOKBENEFIT"] && (!$arr["EXPIRASI"]=='') && ($arr["IS_PIL"]=='1')) {
//					  if ($klp==$arr["KDKELOMPOKBENEFIT"] && (!$arr["EXPIRASI"]=='') && ($arr[""]=='1')) {
					  //add is_pil by salman 26072011
					  //echo 'masuk sini';
  					   $option = "<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"$kdbnft(document.propmtc)\">"; 
  					  } else {	
  					   $option = "";
  					  }
  					 } else {
  					 	if ($klp==$arr["KDKELOMPOKBENEFIT"]) {
  					   $option = "<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"$kdbnft(document.propmtc)\">"; 
  					  } 
							//elseif(($klp=="O" && $arr["KDKELOMPOKBENEFIT"]=="E") || ($klp=="D" && $arr["KDKELOMPOKBENEFIT"]=="E")) {	//tambahan untuk klaim OTHERS = anak yg dibeasiswakan meninggal
							
							//Dirubah oleh Dedi 02/02/2011 
							elseif(($klp=="O" && ($arr["KDKELOMPOKBENEFIT"]=="E" || $arr["KDKELOMPOKBENEFIT"]=="D" || $arr["KDKELOMPOKBENEFIT"]=="C")) || ($klp=="D" && $arr["KDKELOMPOKBENEFIT"]=="E")) {
  					   $option = "<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"$kdbnft(document.propmtc)\">"; 
              //Tambahan untuk klaim benefit lanjut yang ingin mengajukan klaim dengan jenis klaim berbeda 5/1/2012
              }elseif($kdproduk=='ASI' || $kdproduk=='ASP' || $kdproduk=='AIP' || $kdproduk=='AI0' || $kdproduk=='AEP' || $kdproduk=='PIN'){
  					    $option = "<input type=\"checkbox\" name=cb$kdbnft value=\"1\" onclick=\"$kdbnft(document.propmtc)\">";
              }else {
  					   $option = "";
  					  }
  					 }	
  					 break;
  				 }	
  				 print( "<td class=\"verdana9barak\" align=\"center\">".$option."</td>\n" );
    			 print( "</tr>" );
  				 
  				 $i++;
  				}		 
  				?>	
  				</table>
  				</td>
  				</tr>
       </table>
  		 <br />
			 <? 
			 
// Jika Klaim Meninggal Produk UnitLink (JL)
			 if ($kdklaim=='MENINGGAL' && substr($kdproduk,0,2)=="JL") {

			  //echo "kdproduk = ".$kdproduk;
				$nopol = $prefix.$noper;
			  include "../../includes/msdb_connect.php";
				$sqa = "select SaldoUnit from vselisihsaldo where nopol like '$nopol%'";
        $res= mssql_query($sqa);
        $row = mssql_fetch_array($res);
        $totalunit = $row["SaldoUnit"];
        //echo "total unit = ".$totalunit;
        //echo "<br />";
        $msqry = "select convert(varchar, tanggal, 103) as tglmax,value as nilainab from tablenab where tanggal in (select max(tanggal) from tablenab) order by tanggal desc, productId desc";
                $res= mssql_query($msqry);
            		$row = mssql_fetch_array($res);
        				$nilainab = $row["nilainab"];
        				$tglnab = $row["tglmax"];
        //echo "nilai NAB ($tglnab) = ".$nilainab;
        //echo "<br />";
        //$npengembangan = number_format(($totalunit * $nilainab),2,",",".");
				$npengembangan = round(($totalunit * $nilainab),2);
				//echo "Total pengambangan dana = total unit * NAB = ".$npengembangan;
				?>
				<b>Investasi</b>
    		 <table>
    		   <tr>
    				<td class="arial10" width="23%">Jumlah Unit</td>
    				<td class="arial10" width="2%">:</td>
      			<td class="arial10" width="25%"><input type="text" name="jmlunit" value="<?=$totalunit;?>" size="15" class="akunc"></td>
    				</tr>
    				<tr>
    				<td class="arial10" width="23%">Nilai NAB (<?=$tglnab;?>)</td>
    				<td class="arial10" width="2%">:</td>
      			<td class="arial10" width="25%"><input type="text" name="nilainab" value="<?=$nilainab;?>" size="15" class="akunc"></td>
    				</tr>
						<tr>
    				<td class="arial10" width="23%">Total Pengembangan Dana (Unit x NAB)</td>
    				<td class="arial10" width="2%">:</td>
      			<td class="arial10" width="25%"><input type="text" name="totaldanainvest" value="<?=$npengembangan;?>" size="15" class="akunc"></td>
    				</tr>
      		</table>	
					<hr size="1">
					 <br />
				<?
			 }
			 ?>
			 <? 
			 // posisi gadai
			 $sql = "select decode(kdvaluta,'1','Rp','0','Rp','3','US$','.') as notasi,to_char(tglgadai,'dd/mm/yyyy') as tglgadai ".
			 				"from $DBUser.tabel_700_gadai ".
							"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
							"and status='3'";
			 $DB->parse($sql);
  		 $DB->execute();
  		 $arr=$DB->nextrow();
			 $tglgadai = $arr["TGLGADAI"];
			 $notasi	 = $arr["NOTASI"];
			 $sql = "select (saldopinjaman+kapitalisasi) saldopinjaman,bunga,totalangsuran,periodebayar ".
			 				"from $DBUser.tabel_701_pelunasan_gadai ".
  	  	     	"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
  					  "and to_char(tglgadai,'DD/MM/YYYY')='$tglgadai' ".
							"and periodebayar in ".
							  "(select max(periodebayar) from $DBUser.tabel_701_pelunasan_gadai ".
    	  	     	"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
    					  "and to_char(tglgadai,'DD/MM/YYYY')='$tglgadai')";
			 //echo $sql;
			 $DB->parse($sql);
  		 $DB->execute();
  		 $arr=$DB->nextrow();
			 $bungagadai = $arr["BUNGA"]; 
       //	Di Edit oleh Ari Faizal Aliaini tgl 07/04/2008
       //	$saldogadai = $arr["PERIODEBAYAR"]==1 ? $arr["SALDOPINJAMAN"] : $arr["TOTALANGSURAN"];
			 $saldogadai = $arr["SALDOPINJAMAN"]-$arr["ANGSURANPOKOK"];
			 
			 ?>
             <input type="hidden" name="saldopokok" value="<?=$saldogadai;?>">
			 <b>Tunggakan Gadai <?=$tglgadai=="" ? "" : "Tanggal $tglgadai"; ?> <font size="2" color="#ff0000"><!--(Kalau nilai gadai dan bunga dientry manual, isi nilai sesuai dengan valuta polis)--><br/>
             <li>Untuk THP SD, SMP dan SMU, nilai pada Pokok Gadai dapat diinput/diubah sesuai nilai angsuran.</li>
			 <li>Untuk THP PT, jika nilai pada Pokok Gadai < nilai THP PT, "Wajib" diperhitungkan langsung dgn THP PT .</li>
             <li>Untuk THP PT, jika nilai pada Pokok Gadai > nilai THP PT, agar mengikuti langkah-langkah sbb:</li>
             <li>- Ubahlah terlebih dahulu nilai pada Pokok Gadai menjadi 0.</li>
             <li>- Berkas agar diterima semua.</li>
             <li>  *jika muncul keterangan "nilai benefit < pinjaman", agar proses dilanjutkan saja.</li>
             <li>-  list Jenis Tahapan yang akan diterima.</li>
             <li>- Klik tombol "Submit".</li>
             <li>- Sisa Pokok Gadai akan diperhitungkan dgn THP Sekaligus (proses Tebus).</li>
             <li>Untuk Bunga Gadai "Wajib" diperhitungkan dgn setiap Tahapan.</li></font></b>
  		 <table>
  		   <? if ($kdklaim=='REFUND') { ?>
           <tr>
  				<td class="arial10" width="23%">Jumlah Refund</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><?=$notasi;?> <input type="text" name="nilairefund" value="<?=$saldogadai;?>" size="15" class="akunc"></td>
  				</tr><?
                }
				?>
           <tr>
  				<td class="arial10" width="23%">Pokok Gadai</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><?=$notasi;?> <input type="text" name="nilaigadai" value="<?=$saldogadai;?>" size="15" class="akunc"></td>
  				</tr>
  				
  				<tr>
  				<td class="arial10" width="23%">Bunga Gadai</td>
  				<td class="arial10" width="2%">:</td>
    			<td class="arial10" width="25%"><?=$notasi;?> <input type="text" readonly name="bungagadai" value="<?=$bungagadai;?>" size="15" class="akunc"></td>
  				</tr>
    		</table>	
  		 
  		 
  		</tr>
  		
  		<tr>
  		<td colspan="6">
  		<?
  		if ($bnf=="ON")
			{
			  //bnf dari awal hanya untuk meninggal
  		} 
			else 
			{
  		   
  				$sql = "select ".
							 	 		"a.kddokumen,a.userupdated,NVL(a.status,0) status,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, ".
										"b.namadokumen ".
  						  // "from $DBUser.tabel_904__dok_klaim a, $DBUser.tabel_903_dokumen_klaim b ".-> CHANGE FROM tabel_904__dok_klaim TO $DBUser.TABEL_904_CEK_DOK_KLAIM BY SALMAN 26072011
						   "from $DBUser.TABEL_904_CEK_DOK_KLAIM a, $DBUser.tabel_903_dokumen_klaim b ".
  							 "where ".
								    "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' and a.kddokumen=b.kddokumen ".
  							 "and a.kdklaim='$kdklaim' and to_char(a.tglpengajuan,'DD/MM/YYYY')='$tglpengajuan' ".
  							 "order by b.kddokumen ";
  				//echo $sql;			 
  				$DB->parse($sql);
  				$DB->execute();
  				$kam=$DB->result();
					$coun=count($kam);

  		?>
  		<table width="100%" cellpadding="1" cellspacing="1" border="0"  class="tblisi">
  		  <tr>
  			<td colspan="5" align="center" class="verdana10blk"> Dokumen</td>
  			</tr>
  				  <tr class="hijao">
  					 <td align="center">No</td>
  					 <td align="center">Nama Dokumen</td>
  					 <td align="center">Status</td>
  					 <td align="center">Tanggal</td>
  					 <td align="center">User</td>
  					</tr>
  					
  				<?
  
  				$i=1;
  				foreach ($kam as $foo => $arr) {
  				 include "../../includes/belang.php";
    			 print( "<td class=\"verdana8\" align=\"center\">$i</td>\n" );
    			 print( "<td class=\"verdana8\" align=\"left\">".$arr["NAMADOKUMEN"]."</td>\n" );
    			 
  				 switch ($arr["STATUS"]) { 
  				  case '0' :
  					 $option = "<option value=\"1\">SUDAH DITERIMA</option>". 
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
  				 print( "<td class=\"arial10ungub\" align=\"center\">".//".$arr["KDDOKUMEN"]." ".
  				 "<select name=\"sel\"  onChange=\"di(this.value)\" onfocus=\"highlight(event)\" class=\"buton\"> ".
  				 //"<select name=\"".$arr["KDDOKUMEN"]."\" onfocus=\"highlight(event)\" class=\"buton\"> ".
  				  $option.
  				 "</select>".
  				 "</td>\n" );
    			 print( "<td class=\"verdana8\" align=\"center\">".$arr["TGLUPDATED"]."</td>\n" );
    			 print( "<td class=\"verdana8\" align=\"left\">".$arr["USERUPDATED"]."</td>" );
  				 print( "</tr>" );
  				 //print( "<input type=\"hidden\" name=\"".$arr["KDDOKUMEN"]."\">" );
  
  				 $i++;
  				}		 
  				?>	
  		  </table>
  		<? } ?>
  
  		</td>
  		</tr>
  				<tr class="tblisi1">
  				<td colspan="2" class="verdana8"><font size=3 color=red>K</font>&nbsp;&nbsp;&nbsp;&nbsp;berarti sudah pernah diklaim sebelumnya (Termasuk Tahapan / Anuitas / Beasiswa). Tgl Jatuh Tempo adalah Jatuh Tempo untuk pertama Kalinya. Jatuh tempo yang diklaim ditunjukkan oleh Tanggal Pengajuan diatas</td>
  				</tr>				
  		    <tr class="tblhead">
      	   <td align="left" class="verdana8w">Pilihlah Benefit Sesuai Ketentuan Polis dengan Memberikan  pada checkbox di kolom Pilih. Kesalahan Entry Menjadi Tanggung Jawab Saudara/i</td>
  		     <td align="right">
  				 <input type="hidden" name="sebabmeninggal" value="<?=$sebabmeninggal;?>">
  				 <input type="hidden" name="bnf" value="<?=$bnf;?>">
  				 <input type="hidden" name="namadokter" value="<?=$namadokter;?>">
  				 <input type="hidden" name="alamatdokter" value="<?=$alamatdokter;?>">
  				 <input type="hidden" name="pemohon" value="<?=$pemohon;?>">
  				 <input type="hidden" name="resikoawal" value="<?=$resikoawal;?>">
  				 <input type="submit" name="submit" value="Submit" disabled></td>
  		    </tr>
  		
  		
  </table>
  <?	include "footer.php"; ?>
  </form>
  </div>
  </body>
  </html>
<?}?>