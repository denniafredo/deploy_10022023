<?php  
  include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	include "../../includes/session.php";
	include "../../includes/duit.php";
	include "../../includes/common.php";
	
	$DB=new database($userid, $passwd, $DBName);	
	
	//validasi benefit
	//echo $kode;
	switch($kode){
	  case 'RAWATINAP': $kdbenefitklaim = "BNFRWT"; break;	
	  case 'CACAT': $kdbenefitklaim = "CCTTTPA"; break;	
	  case 'MENINGGAL': $kdbenefitklaim = "DEATHKC"; break;
	  case 'RTI': $kdbenefitklaim = "TI"; break;
	  case 'TPD': $kdbenefitklaim = "TPD"; break;
	  case 'CI53': $kdbenefitklaim = "CI53"; break;	
	  case 'CI': $kdbenefitklaim = "CI"; break;	
	  case 'ADDB': $kdbenefitklaim = "ADDB"; break;	
	  case 'ADB': $kdbenefitklaim = "ADB"; break;	
	  case 'SDB': $kdbenefitklaim = "SPBD"; break;	
	  case 'STPD': $kdbenefitklaim = "SPTPD"; break;
	  case "PDB": $kdbenefitklaim="PBD"; break;
	  case "PBCI": $kdbenefitklaim="PBCI"; break;
	  case "PTPD": $kdbenefitklaim="PBTPD"; break;
	  case "WPTPD": $kdbenefitklaim="WPTPD"; break;
	  case "WPCI51": $kdbenefitklaim="WPCI51"; break;	
	  default: $kdbenefitklaim = "DEATHKC"; break;
	}
					
	$sql = 	"select ".
					"a.kdproduk,a.kdbenefit,a.nilaibenefit,a.status,b.kdstatusfile ".
			"from ".
					"$DBUser.tabel_223_transaksi_produk a, ".
					"$DBUser.tabel_200_pertanggungan b ".
			"where ".
					"a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
					"and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
					"and a.kdbenefit='$kdbenefitklaim' ".
					"and nvl(a.status,0) IN (7, 0) and b.kdstatusfile='1'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$nilainenefit=$arr["NILAIBENEFIT"];
	if($nilainenefit==""){
		echo "Polis $prefix-$noper tidak memiliki benefit $kode, sudah pernah diklaim sebelumnya atau polis sudah expirasi";
		echo "<br /><br /><a href=javascript:window.close()>Close</a>";
		die;
	} else {}
	
	
	
	$sql = "select kelompok from $DBUser.tabel_902_kode_klaim where kdklaim='$kode'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
 
	 function Klik($userid,$passwd,$prefix,$noper,$klpbnf,&$htm)
	 {
	 $DA = new database($userid, $passwd, $DBName);	
	 $PERT = New Pertanggungan($userid,$passwd,$prefix,$noper);
	 switch ($klpbnf) {
	  default:
	 //echo KAMPRET.$klpbnf;
	   $sql="select to_char(min(tglb),'DD/MM/YYYY') tglbooked from ( ".
	 				"select min(a.tgljatuhtempo) tglb ".
	 			  "from $DBUser.tabel_242_benefit_anuitas a,$DBUser.tabel_207_kode_benefit d ".
					"where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
					"and a.kdbenefit=d.kdbenefit and d.kdkelompokbenefit='$klpbnf' and a.status='7' ".
					"union ".
					"select min(b.expirasi) tglb ".
					"from $DBUser.tabel_223_transaksi_produk b,$DBUser.tabel_207_kode_benefit c ".
					"where b.prefixpertanggungan='$prefix' and b.nopertanggungan='$noper' ".
					"and b.kdbenefit=c.kdbenefit and c.kdkelompokbenefit='$klpbnf' and ".
					"nvl(b.status,'0') in ('0','7') ".
					" ) ";
	   //echo $sql;
	   $DA->parse($sql);
	   $DA->execute();
	   $arr=$DA->nextrow();
	   $tglbooked=$arr["TGLBOOKED"];
		 //echo $tglbooked;
	   $tglb = "window.opener.document.propmtc.tglbooked.value='$tglbooked';\n";
	 	break; 
	  case 'D':
	 	 
		 $sql = "select prefixpertanggungan,nopertanggungan ".
		        "from $DBUser.tabel_200_pertanggungan ".
			 			"where notertanggung='$PERT->notertanggung' and ".
						"kdpertanggungan='2' and kdstatusfile in ('1','4') and ".
						"prefixpertanggungan <> '$prefix' and nopertanggungan <> '$noper' ".
			 			"order by prefixpertanggungan,nopertanggungan";
     	$DA->parse($sql);
		 $DA->execute();
		 $coun=0; $pol='';
		 while ($ari=$DA->nextrow()) {
 		 			 $coun++;
					 $pol .=$ari["PREFIXPERTANGGUNGAN"]."-".$ari["NOPERTANGGUNGAN"].";";
		 } 
		 //echo $coun;
		 
		 if (!$coun==0) {
		  $tglb .="window.opener.document.propmtc.ket.value='TERTANGGUNG MEMILIKI $coun POLIS LAIN, $pol';\n";
		 } else {
		  $tglb .="window.opener.document.propmtc.ket.value='TERTANGGUNG TIDAK MEMILIKI POLIS LAIN.';\n";
		 }
		 break;		 				
	 }	

	 $htm =	"window.opener.document.propmtc.pertanggungan.value='".$PERT->label."';\n".
	       	"window.opener.document.propmtc.prefix.value='$prefix';\n".
			"window.opener.document.propmtc.noper.value='$noper';\n".
	  		"window.opener.document.propmtc.tertanggung.value='".$PERT->namatertanggung."';\n".
			"window.opener.document.propmtc.pemegangpolis.value='".$PERT->namapemegangpolis."';\n".
			"window.opener.document.propmtc.produk.value='".$PERT->namaproduk."';\n".
			"window.opener.document.propmtc.valuta.value='".$PERT->namavaluta."';\n".
			"window.opener.document.propmtc.indexawal.value='".number_format($PERT->indexawal,2)."';\n".
			"window.opener.document.propmtc.premi1.value='".number_format($PERT->premi1,2)."';\n".
			"window.opener.document.propmtc.premi2.value='".number_format($PERT->premi2,2)."';\n".
			"window.opener.document.propmtc.jua.value='".number_format($PERT->jua,2)."';\n".
			"window.opener.document.propmtc.resikoawal.value='".number_format($PERT->resikoawal,2)."';\n".
			"window.close();";
			"\n";
	}			

    $prefix	= strtoupper($prefix);
	 	$sql = "select a.prefixpertanggungan,a.nopertanggungan ".
			   "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
 				 	 "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' and ".
					 "a.nopenagih=b.nopenagih /*and b.kdrayonpenagih='$kantor'*/ and a.kdpertanggungan = '2' ";
  	//echo $sql;				  
	$DB->parse($sql);
	$DB->execute();
	
	
	if (!($ari=$DB->nextrow())) { 
				 $sql = "select to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan from $DBUser.tabel_901_pengajuan_klaim ".
				 			  "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kode' ";
				 //echo $sql;
				 $DB->parse($sql);
				 $DB->execute();
				 if (!$arr=$DB->nextrow()) {
				  print ("<body bgcolor=#cff2b0><div align=center><font face=Verdana size=2>Mungkin Tidak Ada Benefit ".$kode." atau Belum Jatuh Tempo</font><br>");
   				print( "<a href=\"polis.php?prefix=$prefix&noper=$noper\">Lihat Polis $prefix-$noper</a><br><br><b> Pastikan Benefit yang akan diklaim ADA</b><br>" );
  				print( "<font face=Verdana size=1>Masukkan Prefix Pertanggungan dan Nomor Pertanggungan Yang Benar !<br><hr size=1><br>" );
  				print( "<a href=\"#\" onclick=\"javascript:window.close();\"><font size=\"2\" face=\"Verdana\"><b>Close</b></font></a>\n" );
	  		  
				 } else {
				  $tglklaim=$arr["TGLPENGAJUAN"];
				 
					print ("<body bgcolor=#ccccff><div align=center><font face=Verdana size=2><b>Polis ".$prefix."-".$noper." Pernah Mengajuan Klaim Jenis ".$kode." tanggal ".$tglklaim."</b></font><br>");
   			  print( "Masukkan Prefix Pertanggungan dan Nomor Pertanggungan Yang Benar !<br><hr size=1><br>" );
  				print( "<a href=\"#\" onclick=\"javascript:window.close();\"><font size=\"2\" face=\"Verdana\"><b>Close</b></font></a>\n" );
	  		  print( "<a href=\"#\" onclick=\"javascript:window.opener.location.replace('entryklaim.php?prefix=$prefix&noper=$noper');window.close();\"><font size=\"2\" face=\"Verdana\">Periksa Status Pengajuan Klaim</font></a>\n" );
	  		  die ;
				 }	
				 
	} else {
	
	  Klik($userid,$passwd,$prefix,$noper,$klp,&$htm);
	  print ("<body onload=\"".$htm."\"></body>");
	}
//}	 
?>