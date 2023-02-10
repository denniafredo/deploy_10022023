<?php  
  include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	include "../../includes/session.php";
	include "../../includes/duit.php";
	
	$DB=new database($userid, $passwd, $DBName);	
	
	//validasi benefit
	//echo $kode;
	$sql = 	"select ".
					"a.kdproduk,a.kdbenefit,a.nilaibenefit,a.status,b.kdstatusfile ".
			"from ".
					"$DBUser.tabel_223_transaksi_produk a, ".
					"$DBUser.tabel_200_pertanggungan b ".
			"where ".
					"a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
					"and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
					"and substr(a.kdbenefit,1,2)='CP' ".
					"and nvl(a.status,0) IN (0, 7) and b.kdstatusfile='1' and nilaibenefit<>0";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	echo $sql;
	//die;
	$nilainenefit=$arr["NILAIBENEFIT"];
	if($nilainenefit==""){
		echo "<script language='javascript'>alert('Proses tidak dapat dilanjutkan, polis $prefix-$noper tidak memiliki benefit Cash Plan');</script>";
		//echo "Polis $prefix-$noper tidak memiliki benefit $kode, sudah pernah diklaim sebelumnya atau polis sudah expirasi";
		//echo "<br /><br /><a href=javascript:window.close()>Close</a>";
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
	 
	 //switch ($klpbnf) {
	 // default:
	 
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
	   echo $sql;
	   $DA->parse($sql);
	   $DA->execute();
	   $arr=$DA->nextrow();
	   $tglbooked=$arr["TGLBOOKED"];
		 //echo $tglbooked;
	 //  $tglb = "window.opener.document.propmtc.tglbooked.value='$tglbooked';\n";
	 /*
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
		*/
		
	 $htm =	"parent.document.propmtc.prefix.value='$prefix';\n".
			"parent.document.propmtc.noper.value='$noper';\n".
	  		"parent.document.propmtc.tertanggung.value='".$PERT->namatertanggung."';\n".
			"parent.document.propmtc.pemegangpolis.value='".$PERT->namapemegangpolis."';\n".
			"parent.document.propmtc.valuta.value='".$PERT->namavaluta."';\n".
			"parent.document.propmtc.premi1.value='".number_format($PERT->premi1,2)."';\n".
			"\n";
			
	}			

    $prefix	= strtoupper($prefix);
	$sql = 	"select a.prefixpertanggungan,a.nopertanggungan ".
			"from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
 			"where ".
				"a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' and ".
				"a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' ".
				"and a.kdpertanggungan = '2' ";
  	//echo $sql;				  
	$DB->parse($sql);
	$DB->execute();
	
	if (!($ari=$DB->nextrow())) 
	{ 
		echo "<script language='javascript'>alert('Proses Gagal! Polis bukan milik rayon Anda');</script>";
		die;
		/*
		$sql = "select ".
					"to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan ".
				"from $DBUser.tabel_901_pengajuan_klaim ".
				"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
				"and kdklaim='$kode' ";
				 //echo $sql;
		$DB->parse($sql);
		$DB->execute();
		if (!$arr=$DB->nextrow()) {
				echo "<script language='javascript'>alert('Proses Gagal! Polis bukan milik rayon Anda');</script>";
		  
		} else {
				$tglklaim=$arr["TGLPENGAJUAN"];
				echo "<script language='javascript'>alert('Proses Gagal! Klaim sudah pernah diajukan');</script>";
				die ;
		}	
		*/
	} else {
	  Klik($userid,$passwd,$prefix,$noper,$klp,&$htm);
	  print ("<body onload=\"".$htm."\"></body>");
	}
?>