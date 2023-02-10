<?
ob_start();
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";



		function GetNewClientNo($DBX){
	   //$query = "select max(noklien) as maxnoklien from $DBUser.tabel_100_klien";
	   $query = "select $DBUser.no_klien.nextval as maxnoklien from dual";
	   $DBX->parse($query);
		 $DBX->execute();
		 $arr = $DBX->nextrow();
		 $maxnoklien = $arr["MAXNOKLIEN"];
		
		 if (strlen($maxnoklien)==0) {
		  $maxnoklien = "0000000001";
		 } else {
        $newnoklien = $maxnoklien + 1;
		    $maxnoklien = str_pad($newnoklien,10,"0",STR_PAD_LEFT);
		 } 
		  return $maxnoklien;
	  }		 
	
  $DB=new database($userid, $passwd, $DBName);


	$kdid = 	(strlen($kdid)==0) ? "NULL" :  "'".$kdid."'";
	$noid = 	(strlen($noid)==0) ? "NULL" :  "'".$noid."'";
	$tplhr = 	(strlen($tempatlahir)==0) ? "NULL" :  $tempatlahir;
	$tgbdn = 	(strlen($tinggibadan)==0) ? "NULL" :  "'".$tinggibadan."'";
	$brtbdn = (strlen($beratbadan)==0) ? "NULL" :  "'".$beratbadan."'";
	$pdpt = 	(strlen($pendapatan)==0) ? "NULL" :  $pendapatan;
  $gelar =   (strlen($gelar)==0) ? "NULL" : "'".strtoupper($gelar)."'";
	$tplhr =   (strlen($tplhr)==0) ? "NULL" : "'".strtoupper($tplhr)."'";
	$kdagama = 	(strlen($kdagama)==0) ? "NULL" :  "'".$kdagama."'";
  $kdhobby = 	(strlen($kdhobby)==0) ? "NULL" :  "'".$kdhobby."'";
  $kdpekerjaan = 	(strlen($kdpekerjaan)==0) ? "NULL" :  "'".$kdpekerjaan."'";
  $meritalstatus = (strlen($meritalstatus)==0) ? "NULL" :  "'".$meritalstatus."'";
	
		$namaklien1=strtoupper($namaklien1);	
    $namaklien1=stripslashes($namaklien1);
		$namaklien1=ereg_replace("'","''",$namaklien1);	
				
	if ($mode=="insert"){
	  
	  $noklien = (!$namaklien1=='' || is_null($namaklien1)) ? GetNewClientNo($DB) : "NULL";
	 //--------------------------------------- INSERT -----------------------------------------------------
    $sql = "insert into $DBUser.tabel_100_klien(kdklien,noklien,namaklien1,gelar,jeniskelamin,tempatlahir, ".
	         "tgllahir,kdagama,meritalstatus,tinggibadan,beratbadan,kdid,noid,kdpekerjaan,kdhobby,pendapatan, ".
					 "tglrekam,userrekam,tglupdated,userupdated,".
					 //tambahan oleh dedi z untuk memenuhi permintaan PMN dari Div. URC 19/07/2011
						"npwp,warganegara,dik_akhir,tglexpired_id,namaibukand,alamattetap01,alamattetap02,status_tinggal,kdpropinsitetap,KDKOTAMADYATETAP,phonetetap01,fax_rmh,emailtetap,".
            "kodepostetap,alamattagih01,alamattagih02,kdpropinsitagih,KDKOTAMADYATAGIH,kodepostagih,no_ponsel2,".
						"pangkat,nama_pers,alamat_pers,telpon_pers,fax_pers,ket_usaha,bid_usaha,nama_usaha,".
						"alamat_usaha,besar_pendapatan,sumber_dana,sumber_penghasilan,nama_pasangan,nama_ktr_pasangan,".
						"alamat_ktr_pasangan,tglnikah,tuj_email,NO_PONSEL,ALAMATTINGGALKTP,ALAMATTINGGALKTP2,KDKOTAMADYAKTP,KDPROPINSIKTP,".
						"KDPOSKTP,ALAMATTINGGALKP,ALAMATTINGGALKP2,KDPROPINSIKP,KDKOTAMADYAKP,KDPOSKP,MEROKOK)".
		       "values ('N','$noklien','$namaklien1',$gelar,'$jeniskelamin',$tplhr, ".
					 "to_date('$tgllahir','DD/MM/YYYY'),$kdagama,$meritalstatus,'$tinggibadan','$beratbadan',$kdid,$noid,$kdpekerjaan,$kdhobby,$pdpt,".
					"sysdate,user,NULL,NULL,'$npwp','$staWN','$pendAkhir',".
					"to_date('$idexpired','dd/MM/YYYY'),'$ibuKand','$alamatTinggal','$alamatTinggal2','$staTptTinggal','$kdpropinsi','$kdkotamadya','$phonetetap','$faxRumah','$emailtetap',".
					"'$kdpos','$alamatTinggal','$alamatTinggal2','$kdpropinsi','$kdkotamadya','$kdpos','$no_ponsel2','$jabatan','$namaPers','$almtPers',".
					"'$telpPers','$faxPers','$ketUsaha','$bidUsaha','$namaUsaha','$almtUsaha','$gajiPerbulan','$sumberDana',".					
           "'$sumberDanaLain','$suamiIstri','$ktrSuamiIstri','$almKtrSuamiIstri',to_date('$tglMenikah','DD/MM/YYYY'),'$tujuanEmail',".
           "'$no_ponsel','$alamatTinggalKTP','$alamatTinggalKTP2','$kdkotamadyaKTP','$kdpropinsiKTP','$kdposKTP','$alamatTinggalKP','$alamatTinggalKP2',".
           "'$kdpropinsiKP','$kdkotamadyaKP','$kdposKP','$merokok')";
              // echo $sql;
              // echo $_POST["pempol"];
               //die;

  } else if ($mode=="update") {  
		
    $sql = "update $DBUser.tabel_100_klien set namaklien1='$namaklien1',gelar=$gelar,jeniskelamin='$jeniskelamin',tempatlahir=$tplhr, ".
	         "tgllahir=to_date('$tgllahir','DD/MM/YYYY'),kdagama=$kdagama,meritalstatus=$meritalstatus,tinggibadan=$tgbdn,beratbadan=$brtbdn, ".
					 "kdid=$kdid,noid=$noid,kdpekerjaan=$kdpekerjaan,kdhobby=$kdhobby,pendapatan=$pdpt, ".
					 "tglupdated=sysdate,userupdated=user ".
					 "where noklien='$noklien'";
	}
	echo $sql;
  $DB->parse($sql);
	//die;
	if ($DB->execute()) {
	 
	 $sql = "delete from $DBUser.tabel_100_temp ".
		 	 	  "where namaklien1='$namaklien1'";
   //echo $sql;
	 $DB->parse($sql); 
	 $DB->execute();
	 $DB->commit();
	   //header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/entryklien_ul.php");
		  header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link.php?noklien=$noklien");
	
	  //header("location:http://$HTTP_HOST/$KAMP/klien/mnuclntmtc_d3d1.php?noklien=$noklien&namaklien=$namaklien1");
  } else {
	 echo "<br>Proses Gagal<br><br>";
	 echo "<a href=editclntmain_link.php>Kembali</a>";
	}
	
?>
