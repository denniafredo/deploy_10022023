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
						"npwp,warganegara,dik_akhir,tglexpired_id,namaibukand,alamattetap01,alamattetap02,status_tinggal,kdpropinsitetap,phonetetap01,fax_rmh,emailtetap,kodepostetap,no_ponsel2,".
						"pangkat,nama_pers,alamat_pers,telpon_pers,fax_pers,ket_usaha,bid_usaha,nama_usaha,".
						"alamat_usaha,besar_pendapatan,sumber_dana,sumber_penghasilan,nama_pasangan,nama_ktr_pasangan,".
						"alamat_ktr_pasangan,tglnikah,tuj_email) ".						
		       "values ('N','$noklien','$namaklien1',$gelar,'$jeniskelamin',$tplhr, ".
					 "to_date('$tgllahir','DD/MM/YYYY'),$kdagama,$meritalstatus,'$tinggibadan','$beratbadan',$kdid,$noid,$kdpekerjaan,$kdhobby,$pdpt,".
					"sysdate,user,NULL,NULL,'$npwp','$staWN','$pendAkhir',".
					"to_date('$idexpired','dd/MM/YYYY'),'$ibuKand','$alamatTinggal','$alamatTinggal2','$staTptTinggal','$kdpropinsi','$phonetetap01','$faxRumah','$emailtetap',".
					"'$kdpos','$no_ponsel2','$jabatan','$namaPers','$almtPers',".
					"'$telpPers','$faxPers','$ketUsaha','$bidUsaha','$namaUsaha','$almtUsaha','$gajiPerbulan','$sumberDana',".					
           "'$sumberDanaLain','$suamiIstri','$ktrSuamiIstri','$almKtrSuamiIstri',to_date('$tglMenikah','DD/MM/YYYY'),'$tujuanEmail')";
               echo $sql;
              // die;

  } else if ($mode=="update") {  
		
    $sql = "update $DBUser.tabel_100_klien set namaklien1='$namaklien1',gelar=$gelar,jeniskelamin='$jeniskelamin',tempatlahir=$tplhr, ".
	         "tgllahir=to_date('$tgllahir','DD/MM/YYYY'),kdagama=$kdagama,meritalstatus=$meritalstatus,tinggibadan=$tgbdn,beratbadan=$brtbdn, ".
					 "kdid=$kdid,noid=$noid,kdpekerjaan=$kdpekerjaan,kdhobby=$kdhobby,pendapatan=$pdpt, ".
					 "tglupdated=sysdate,userupdated=user,".
					"npwp='$npwp',warganegara='$staWN',dik_akhir='$pendAkhir',tglexpired_id=to_date('$idexpired','dd/MM/YYYY'),".							
					"namaibukand='$ibuKand',alamattetap01='$alamatTinggal',alamattetap02='$alamatTinggal2',status_tinggal='$staTptTinggal',".					
					"kdpropinsitetap='$kdpropinsi',KDKOTAMADYATETAP='$kdkotamadya',phonetetap01='$phonetetap',fax_rmh='$faxRumah',".
					"emailtetap='$emailtetap',kodepostetap='$kdpos',no_ponsel2='$no_ponsel2',".						
						"pangkat='$jabatan',nama_pers='$namaPers',alamat_pers='$almtPers',telpon_pers='$telpPers',fax_pers='$faxPers',".
						"ket_usaha='$ketUsaha',bid_usaha='$bidUsaha',nama_usaha='$namaUsaha',".
						"alamat_usaha='$almtUsaha',besar_pendapatan='$gajiPerbulan',sumber_dana='$sumberDana2',sumber_penghasilan='$sumberDanaLain2',".
						"nama_pasangan='$suamiIstri',nama_ktr_pasangan='$ktrSuamiIstri',".
						"alamat_ktr_pasangan='$almKtrSuamiIstri',tglnikah=to_date('$tglMenikah','DD/MM/YYYY'),".						
						"tuj_email='$tujuanEmail',NO_PONSEL='$no_ponsel',ALAMATTINGGALKTP='$alamatTinggalKTP',ALAMATTINGGALKTP2='$alamatTinggalKTP2'".
						",KDKOTAMADYAKTP='$kdkotamadyaKTP',KDPROPINSIKTP='$kdpropinsiKTP',".
						"KDPOSKTP='$kdposKTP',ALAMATTINGGALKP='$alamatTinggalKP',ALAMATTINGGALKP2='$alamatTinggalKP2',".
						"KDPROPINSIKP='$kdpropinsiKP',KDKOTAMADYAKP='$kdkotamadyaKP',KDPOSKP='$kdposKP',bid_pers='$bidangkerja' ".					
					 "where noklien='$noklien'";
	}
	echo $sql;
	//die;
  $DB->parse($sql);
	//die;
	if ($DB->execute()) {
	 
	 $sql = "delete from $DBUser.tabel_100_temp ".
		 	 	  "where namaklien1='$namaklien1'";
   //echo $sql;
	 $DB->parse($sql); 
	 $DB->execute();
	 $DB->commit();
	 if($_POST['pempol']=="pempol" && $_POST['pempre']=="pempre" && $_POST['tert']=="tert"){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/ntryprop_ulink.php?noklien=$noklien&pempre=$noklien&pempol=$noklien");
	 }elseif($_POST['pempol']=="pempol" && $_POST['pempre']=="pempre" && $_POST['tert']==""){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link2.php?pempre=$noklien&pempol=$noklien");
	 }elseif($_POST['pempol']=="pempol" && $_POST['tert']=="tert" && $_POST['pempre']==""){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link3.php?noklien=$noklien&pempol=$noklien");
	 }elseif($_POST['pempre']=="pempre" && $_POST['tert']=="tert" && $_POST['pempol']==""){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/ntryprop_ulink.php?noklien=$noklien&pempre=$noklien");
	 }elseif($_POST['pempre']=="" && $_POST['tert']=="" && $_POST['pempol']=="pempol"){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/editclntmain_link2.php?pempol=$noklien");
	 }elseif($_POST['pempre']=="" && $_POST['tert']=="tert" && $_POST['pempol']==""){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/ntryprop_ulink.php?noklien=$noklien");
	 }elseif($_POST['pempre']=="pempre" && $_POST['tert']=="" && $_POST['pempol']==""){
	 header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/ntryprop_ulink.php?pempre=$noklien");
	 }else{
		//  header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/entryklien_ul.php");
		  header("location:http://$HTTP_HOST/$KAMP/proposal/ulink/mnuclntmtc_link.php?noklien=$noklien&namaklien=$namaklien1");
	 }
	  //header("location:http://$HTTP_HOST/$KAMP/klien/mnuclntmtc_d3d1.php?noklien=$noklien&namaklien=$namaklien1");
  } else {
	 echo "<br>Proses Gagal<br><br>";
	 echo "<a href=editclntmain>Kembali</a>";
	}
	
?>
