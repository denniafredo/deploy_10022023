<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  $noproposal=$nopertanggungan;
	$DB = New database($userid, $passwd, $DBName);
	$DB1 = New database($userid, $passwd, $DBName);
	$DB2 = New database($userid, $passwd, $DBName);
	$DB3 = New database($userid, $passwd, $DBName);
	$DB4 = New database($userid, $passwd, $DBName);
  $today = date("d F Y");

$sqlcek="insert into $DBUser.tabel_118_cek_skk (noklien,cekgejala,cekrawatinap) values ('$noklien','$gejalaTtgYa','$rawatinap')";
//echo $sqlcek;
$DB3->parse($sqlcek);
$DB3->execute();
$sqlcek2="insert into $DBUser.tabel_118_cek_skk (noklien,cekgejala,cekrawatinap) values ('$notert2','$gejalaTtgYa2','$rawatinap2')";
$DB4->parse($sqlcek2);
$DB4->execute();

$sql1="insert into $DBUser.tabel_118_gejala_penyakit_n (NOKLIEN,JANTUNG,KELENJAR,TUMOR,MAAG,MIGRAIN,REMATIK,BATUK,ANEMIA,MALARIA,".
							"NYERIDADA,EPILEPSI,DIABET,POLIO,HIPERTENSI,PSIKO,GINJAL,LAINNYA,KETLAINNYA) values".
							"('".$_POST['noklien']."','$jantungT1','$kelenjar','$tumor','$maag','$migrain','$rematik','$batuk','$anemia',".
							"'$malaria','$nyeridada','$epilepsi','$diabet','$polio','$hipertensi','$psiko','$ginjalT1','$lainnyaT1','$ketlainnya')";
							//echo $sql1;
	$DB2->parse($sql1);
	$DB2->execute();

$sql2="insert into $DBUser.tabel_118_gejala_penyakit_n (NOKLIEN,JANTUNG,KELENJAR,TUMOR,MAAG,MIGRAIN,REMATIK,BATUK,ANEMIA,MALARIA,".
							"NYERIDADA,EPILEPSI,DIABET,POLIO,HIPERTENSI,PSIKO,GINJAL,LAINNYA,KETLAINNYA) values".
						"('".$_POST['notert2']."','$jantungT2','$kelenjarT2','$tumorT2','$maagT2','$migrainT2','$rematikT2',".		
						"'$batukT2','$anemiaT2','$malariaT2','$nyeridadaT2','$epilepsiT2','$diabetT2','$polioT2',".
							"'$hipertensiT2','$psikoT2','$ginjalT2','$lainnyaT2','$ketlainnyaT2')";
	$DB->parse($sql2);
	$DB->execute();
/*$box=$gejalaSakit; 
      	$box_count=count($box);
      	if (($box_count)<1)
				{
				}
				else
				{
    				foreach ($box as $dear) {
					$conn=ocilogon("JSADM","JSDB","JSDB");
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					$ket = $dear;
					$sql1="insert into $DBUser.tabel_118_gejala_penyakit (noklien,kodepenyakit,kdmutasipenyakit) values('".$_POST['noklien']."','".$dear."','GEJALA')";
						  //echo $sql1."<br>";
						  //die;
					$DB2->parse($sql1);
					$DB2->execute();
					}							
					}

$boxT2=$gejalaSakitT2; 
      	$box_countT2=count($boxT2);
      	if (($box_countT2)<1)
				{
				}
				else
				{
    				foreach ($boxT2 as $dearT2) {
					$conn=ocilogon("JSADM","JSDB","JSDB");
    				$tglapprove=date("d/m/Y");//echo "XXXX".$dear;		
					$jam=date("h:m:s");					
					$ket = $dear;
					$sql2="insert into $DBUser.tabel_118_gejala_penyakit (noklien,kodepenyakit,kdmutasipenyakit) values('".$_POST['notert2']."','".$dearT2."','GEJALA')";
						  //echo $sql1."<br>";	
						  //die;
					$DB2->parse($sql2);
					$DB2->execute();
					}							
					}
*/
$sqlhepaTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['hepaTU']."','".$_POST['namahepa']."','".$_POST['hepa']."',to_date('".$_POST['tglHepa']."','dd/mm/yyyy'),'".$_POST['dokterAlamatHepa']."')";
$sqlhepaTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['hepaTT']."','".$_POST['namahepa2'].",'".$_POST['hepa2']."',to_date('".$_POST['tglHepa2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatHepa2']."')";
$sqlUsusTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['UsusTU']."','".$_POST['namausus']."','".$_POST['Usus']."',to_date('".$_POST['tglUsus']."','dd/mm/yyyy'),'".$_POST['dokterAlamatUsus']."')";
$sqlUsusTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['UsusTT']."','".$_POST['namausus2']."','".$_POST['Usus2']."',to_date('".$_POST['tglUsus2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatUsus2']."')";			
$sqlGinjalTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['ginjalTU']."','".$_POST['namaginjal']."','".$_POST['ginjal']."',to_date('".$_POST['tglGinjal']."','dd/mm/yyyy'),'".$_POST['dokterAlamatGinjal']."')";
$sqlGinjalTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['ginjalTT']."','".$_POST['namaginjal2']."','".$_POST['ginjal2']."',to_date('".$_POST['tglGinjal2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatGinjal2']."')";			
$sqlJantungTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['jantungTU']."','".$_POST['namajantung']."','".$_POST['jantung']."',to_date('".$_POST['tglJantung']."','dd/mm/yyyy'),'".$_POST['dokterAlamatJantung']."')";
$sqlJantungTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['jantungTT']."','".$_POST['namajantung2']."','".$_POST['jantung2']."',to_date('".$_POST['tglJantung2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatJantung2']."')";
$sqlPayudaraTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['payudaraTU']."','".$_POST['namapayudara']."','".$_POST['payudara']."',to_date('".$_POST['tglPayudara']."','dd/mm/yyyy'),'".$_POST['dokterAlamatPayudara']."')";
$sqlPayudaraTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['payudaraTT']."','".$_POST['namapayudara2']."','".$_POST['payudara2']."',to_date('".$_POST['tglPayudara2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatPayudara2']."')";
$sqlAlergiTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['alergiTU']."','".$_POST['namaalergi']."','".$_POST['alergi']."',to_date('".$_POST['tglAlergi']."','dd/mm/yyyy'),'".$_POST['dokterAlamatAlergi']."')";
$sqlAlergiTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['alergiTT']."','".$_POST['namaalergi2']."','".$_POST['alergi2']."',to_date('".$_POST['tglAlergi2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatAlergi2']."')";
$sqlMataTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['mataTU']."','".$_POST['namamata']."','".$_POST['mata']."',to_date('".$_POST['tglMata']."','dd/mm/yyyy'),'".$_POST['dokterAlamatMata']."')";
$sqlMataTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['mataTT']."','".$_POST['namamata2']."','".$_POST['mata2']."',to_date('".$_POST['tglMata2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatMata2']."')";
$sqlOtakTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['otakTU']."','".$_POST['namaotak']."','".$_POST['otak']."',to_date('".$_POST['tglOtak']."','dd/mm/yyyy'),'".$_POST['dokterAlamatOtak']."')";
$sqlOtakTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['otakTT']."','".$_POST['namaotak2']."','".$_POST['otak2']."',to_date('".$_POST['tglOtak2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatOtak2']."')";
$sqlCederaTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['cederaTU']."','".$_POST['namacedera']."','".$_POST['cedera']."',to_date('".$_POST['tglCedera']."','dd/mm/yyyy'),'".$_POST['dokterAlamatCedera']."')";
$sqlCederaTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['cederaTT']."','".$_POST['namacedera2']."','".$_POST['cedera2']."',to_date('".$_POST['tglCedera2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatCedera2']."')";
$sqlHerniaTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['herniaTU']."','".$_POST['namahernia']."','".$_POST['hernia']."',to_date('".$_POST['tglHernia']."','dd/mm/yyyy'),'".$_POST['dokterAlamatHernia']."')";
$sqlHerniaTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['herniaTT']."','".$_POST['namahernia2']."','".$_POST['hernia2']."',to_date('".$_POST['tglHernia2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatHernia2']."')";
$sqlKolesterolTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['kolesterolTU']."','".$_POST['namakolesterol']."','".$_POST['kolesterol']."',to_date('".$_POST['tglKolesterol']."','dd/mm/yyyy'),'".$_POST['dokterAlamatKolesterol']."')";
$sqlKolesterolTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['kolesterolTT']."','".$_POST['namakolesterol2']."','".$_POST['kolesterol2']."',to_date('".$_POST['tglKolesterol2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatKolesterol2']."')";
$sqlUratTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['uratTU']."','".$_POST['namaurat']."','".$_POST['urat']."',to_date('".$_POST['tglUrat']."','dd/mm/yyyy'),'".$_POST['dokterAlamatUrat']."')";
$sqlUratTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['uratTT']."','".$_POST['namaurat2']."','".$_POST['urat2']."',to_date('".$_POST['tglUrat2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatUrat2']."')";
$sqlEndokrinTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['endokrinTU']."','".$_POST['namaendokrin']."','".$_POST['endokrin']."',to_date('".$_POST['tglEndokrin']."','dd/mm/yyyy'),'".$_POST['dokterAlamatEndokrin']."')";
$sqlEndokrinTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['endokrinTT']."','".$_POST['namaendokrin2']."','".$_POST['endokrin2']."',to_date('".$_POST['tglEndokrin2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatEndokrin2']."')";
$sqlTbcTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['tbcTU']."','".$_POST['namatbc']."','".$_POST['tbc']."',to_date('".$_POST['tglTbc']."','dd/mm/yyyy'),'".$_POST['dokterAlamatTbc']."')";
$sqlTbcTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['tbcTT']."','".$_POST['namatbc2']."','".$_POST['tbc2']."',to_date('".$_POST['tglTbc2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatTbc2']."')";
$sqlAidsTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['aidsTU']."','".$_POST['namaaids']."','".$_POST['aids']."',to_date('".$_POST['tglAids']."','dd/mm/yyyy'),'".$_POST['dokterAlamatAids']."')";
$sqlAidsTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['aidsTT']."','".$_POST['namaaids2']."','".$_POST['aids2']."',to_date('".$_POST['tglAids2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatAids2']."')";
$sqlCacatTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['cacatTU']."','".$_POST['namacacat']."','".$_POST['cacat']."',to_date('".$_POST['tglCacat']."','dd/mm/yyyy'),'".$_POST['dokterAlamatCacat']."')";
$sqlCacatTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['cacatTT']."','".$_POST['namacacat2']."','".$_POST['cacat2']."',to_date('".$_POST['tglCacat2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatCacat2']."')";
$sqlLainnyaTU="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['noklien']."','".$_POST['lainnyaTU']."','".$_POST['namalainnya']."','".$_POST['lainnya']."',to_date('".$_POST['tglLainnya']."','dd/mm/yyyy'),'".$_POST['dokterAlamatLainnya']."')";
$sqlLainnyaTT="insert into $DBUser.tabel_118_klien_penyakit (noklien,kdstatussakit,kodepenyakit,namapenyakitlain,tglmutasi,namadokter) values 
			('".$_POST['notert2']."','".$_POST['lainnyaTT']."','".$_POST['namalainnya2']."','".$_POST['lainnya2']."',to_date('".$_POST['tglLainnya2']."','dd/mm/yyyy'),'".$_POST['dokterAlamatLainnya2']."')";
			//echo $sqlUsusTU;
			$DB2->parse($sqlhepaTU);
			$DB2->execute();
			$DB2->parse($sqlhepaTT);
			$DB2->execute();
			$DB2->parse($sqlUsusTU);
			$DB2->execute();
			$DB2->parse($sqlUsusTT);
			$DB2->execute();
			$DB2->parse($sqlGinjalTU);
			$DB2->execute();
			$DB2->parse($sqlGinjalTT);
			$DB2->execute();
			$DB2->parse($sqlJantungTU);
			$DB2->execute();
			$DB2->parse($sqlJantungTT);
			$DB2->execute();
			$DB2->parse($sqlPayudaraTU);
			$DB2->execute();
			$DB2->parse($sqlPayudaraTT);
			$DB2->execute();
			$DB2->parse($sqlAlergiTU);
			$DB2->execute();
			$DB2->parse($sqlAlergiTT);
			$DB2->execute();
			$DB2->parse($sqlMataTU);
			$DB2->execute();
			$DB2->parse($sqlMataTT);
			$DB2->execute();
			$DB2->parse($sqlOtakTU);
			$DB2->execute();
			$DB2->parse($sqlOtakTT);
			$DB2->execute();
			$DB2->parse($sqlCederaTU);
			$DB2->execute();
			$DB2->parse($sqlCederaTT);
			$DB2->execute();
			$DB2->parse($sqlHerniaTU);
			$DB2->execute();
			$DB2->parse($sqlHerniaTT);
			$DB2->execute();
			$DB2->parse($sqlKolesterolTU);
			$DB2->execute();
			$DB2->parse($sqlKolesterolTT);
			$DB2->execute();
			$DB2->parse($sqlUratTU);
			$DB2->execute();
			$DB2->parse($sqlUratTT);
			$DB2->execute();
			$DB2->parse($sqlEndokrinTU);
			$DB2->execute();
			$DB2->parse($sqlEndokrinTT);
			$DB2->execute();
			$DB2->parse($sqlTbcTU);
			$DB2->execute();
			$DB2->parse($sqlTbcTT);
			$DB2->execute();
			$DB2->parse($sqlAidsTU);
			$DB2->execute();
			$DB2->parse($sqlAidsTT);
			$DB2->execute();
			$DB2->parse($sqlCacatTU);
			$DB2->execute();
			$DB2->parse($sqlCacatTT);
			$DB2->execute();
			$DB2->parse($sqlLainnyaTU);
			$DB2->execute();
			$DB2->parse($sqlLainnyaTT);		
			$DB2->execute();

					

  $sqltert2="select notertanggung2 from $DBUser.tabel_200_pertanggungan where notertanggung='".$_GET['noklien']."'";
 // echo $sqltert2;
  $DB1->parse($sqltert2);
  $DB1->execute();
  $arrtert2=$DB1->nextrow();
  //$notert2=$arrtert2["NOTERTANGGUNG2"];
  $noklien=$_POST['noklien'] ? $_POST['noklien'] : $_GET['noklien'] ;
  $notert2=$_POST['notert2'] ? $_POST['notert2'] : $_GET['notert2'] ;
  if($notert2!=""){
	//  $disebled="disabled";
  }else{
	//  $disebled="";
  }
 
  $sql ="select a.noklien,a.namaklien1 tertanggung1,a.tempatlahir,a.kdpekerjaan,a.alamattetap01,a.alamatkerja, ".
			 "decode(a.jeniskelamin,'L','LAKI-LAKI','P','PEREMPUAN') jeniskelamin,a.tinggibadan,a.beratbadan, ".
			 "a.meritalstatus, decode(a.meritalstatus,'D','DUDA','J','JANDA','L','LAJANG','K','KAWIN') namameritalstatus, ".
       "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir,to_char(a.tglkawin,'DD/MM/YYYY') nganten, ".
			 "c.namapekerjaan,a.kdpekerjaanlama,a.kdgantipekerjaan,d.namaid,a.noid,a.kdid, ".
			 "(select namaklien1 from $DBUser.tabel_100_klien where noklien='".$noklien."') tertanggung1 ".
       "from ".
			 "$DBUser.tabel_100_klien a,  ".
			 "$DBUser.tabel_105_pekerjaan c, $DBUser.tabel_104_kartu_identitas d ".
		   "where a.noklien='".$noklien."' and a.kdpekerjaan=c.kdpekerjaan(+) and a.kdid=d.kdid(+)";
  //echo $sql;
	$DB->parse($sql);
  $DB->execute();
  $arr=$DB->nextrow();
?>
<html>
  <head>
    <title>Data Pribadi Tertanggung
    </title>
    <link href="../../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<?
  print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
  print( "function OnLod(){\n" );
	$sql="select kdpekerjaan,namapekerjaan from $DBUser.tabel_105_pekerjaan order by namapekerjaan";
	$DB->parse($sql);
	$DB->execute();
	$i=0;
	while($data=$DB->nextrow()){
	  if ($arr["KDPEKERJAANLAMA"]==$data["KDPEKERJAAN"]) {
	    print("document.skk1.kdpekerjaanlama.options[".$i."].selected='true';\n" );
	  }
  	$i++;
  }
  if ($arr["KDGANTIPEKERJAAN"]) {
	  print("document.skk1.kdgantipekerjaan[0].checked='true';\n" );
  }
	print("document.skk1.alamatkerja.value='".$arr["ALAMATKERJA"]."';\n" );
  print( "}\n" );
  print( "</script>" );
    ?>
  </head>
  <body onLoad="OnLod()">
    <div align="center">
      <form name="skk1" action="skk4_newjslink.php" method="post">
        <table align="center" border="0" width="800" cellpadding="1" cellspacing="2" class="tblhead">
          <tr>
            <td width="100%" class="tblisi">
              <table border="0" width="100%"  cellpadding="0" cellspacing="0">
                <tr>
                  <td width="16%" colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%" class="arial10" align="center">&nbsp;</td>
                  <td width="30%" class="verdana10blkb">&nbsp;</td>
                  <br>
                  <td width="53%" colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
                </tr>
                <tr>
                  <td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
                  <td width="1%" class="arial10" align="center">:</td>
                  <td width="30%" class="verdana10blkb">
                    <? echo $today;?></td>
                  <td width="53%" colspan="3" class="verdana8" align="center">Beri Tanda V Pada Kolom Yang Sesuai.</td>
                </tr>
                <tr>
                  <td width="16%" colspan="2" class="arial10">Tertanggung</td>
                  <td width="1%" class="arial10" align="center">:</td>
                  <td width="30%" class="verdana10blkb" align="left">
<?
					 echo $arr["TERTANGGUNG1"];
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $PER->notertanggung." - ".$KLIEN->nama;
                    						?></td>
                  <td width="16%" class="arial8ab"></td>
                  <td width="35%"></td>
                  <td width="2%" class="arial8ab"></td>
                </tr>
              </table>
              <table border="0" width="100%">
                <tr>
                  <td width="100%" class="hijao" align="center">J A T I D I R I</td>
                </tr>
              </table>
              <table border="0" width="100%">
                <tr class="hijau">
                  <td width="1%"></td>
                  <td class="arial10" colspan="7">Saya Yang Bertanda-tangan di Bawah Ini :</td>
                </tr>
                <tr>
                  <td width="1%"></td>
                  <td width="16%"><span class="arial10">Nama Lengkap</span></td>
                  <td width="1%">:</td>
                  <td width="53%"><input type="text" class="a" name="namaklien1"  size="45" readonly value="<?=$arr["TERTANGGUNG1"]; ?>"></td>
                  <td colspan="2">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
                <tr>
                  <td width="1%"></td>
                  <td width="16%"><span class="arial10">Jenis Kelamin</span></td>
                  <td width="1%">:</td>
                  <td width="53%"><span class="arial10"> <input type="text" class="a" name="jeniskelamin" size="45" readonly value="<?=$arr["JENISKELAMIN"]; ?>"></span></td>
                  <td colspan="2" class="arial10">&nbsp;</td>
                  <td width="1%">&nbsp;</td>
                  <td width="20%">&nbsp;</td>
                </tr>
              </table>
              <br /><br />
              <br />
              <table border="1" class="verdana8" bordercolor="#000000">
                
                <tr><td>       <b>Riwayat Kesehatan Tertanggung</b>
                    <br>Beri Tanda (v) untuk pernyataan-pernyataan dibawah ini : </td>
                </tr>
                <tr>         <td>
                    <table class="verdana8">
                      <!-- Point 2  -->
                      <tr>
                        <td colspan="8">&nbsp;</td>
                      </tr>
                      <!-- end of point 2-->
                      <!-- Point 3-->
                      <tr>
                        <td rowspan="2" valign="top">   3.  </td>
                        <td colspan="7" align="left">Pernahkah Anda menjalani atau dianjurkan melakukan         pemeriksaan : jantung,darah, air seni, rontgen, USG, CT Scan, Biopsi, pemeriksaan penunjang atau diagnostik lainnya ? </td>
                      </tr>
                      <tr>
                        <td colspan="3"><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="diagnosa" id="diagnosa" value="Y">Ya,
                          <input type="checkbox">Tidak </td>
                        <td colspan="4"><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="diagnosa2" id="diagnosa2" <?=$disebled; ?>>Ya,
                          <input type="checkbox" <?=$disebled; ?>>Tidak </td>
                      </tr>
                      <tr>
                        <td colspan="8">Apabila Calon Tertanggung menjawab "Ya" untuk pertanyaan nomor 3, mohon menjawab pertanyaan dibawah ini. (Apabila jawabannya melebihi kolom yang tersedia,         mohon menuliskan jawabannya pada "Surat pernyataan untuk SPAJ" dan dilampirkan bersama SPAJ ini).</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>
                        <td width="17">a.</td>
                        <td width="350">Jenis Pemeriksaan <br />
                          <input type="text" name="jenisPemerikasaan" id="jenisPemerikasaan"></td>
                        <td width="7">&nbsp;</td>
                        <td width="319">
                          <input type="text" name="jenisPemerikasaan2" id="jenisPemerikasaan2"></td>
                        <td width="7">&nbsp;</td>
                        <td width="7">&nbsp;</td>
                        <td width="12">&nbsp;</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>        <td>b.</td>        <td>Alasan dilakukan pemeriksaan ?<br />
                          <input type="text" name="alasanPemerikasaan" id="alasanPemerikasaan"></td>        <td>&nbsp;</td>        <td>
                          <input type="text" name="alasanPemerikasaan2" id="alasanPemerikasaan2"></td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>        <td>c.</td>        <td>Tanggal dilakukan pemeriksaan<br />
                          <input type="date" name="tglPemeriksaan" id="tglPemeriksaan" onBlur="javascript:convert_date(tglPemeriksaan);">
                          DD/MM/YYYY</td>        <td>&nbsp;</td>        <td>
                          <input type="text" name="tglPemeriksaan2" id="tglPemeriksaan2" onBlur="javascript:convert_date(tglPemeriksaan2);">
DD/MM/YYYY</td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>
                      </tr>
                      <tr>        <td>&nbsp; </td>        <td>d.</td>        <td>Bagaimana hasilnya ? <br />
                          <input type="text" name="hasilPemeriksaan" id="hasilPemeriksaan"></td>        <td>&nbsp;</td>        <td>
                          <input type="text" name="hasilPemeriksaan2" id="hasilPemeriksaan2"></td>        <td>&nbsp;</td>        <td>&nbsp;</td>        <td>&nbsp;</td>
                      </tr>
                      <!-- end of point 3-->
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>Bila ada, mohon meminjamkan hasilnya.</td>         <td>&nbsp;</td>         <td>Ada dan dilampirkan pada SPAJ & SKK ini.</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><input type="checkbox" name="pinjamPeriksa" id="pinjamPeriksa" value="Y">
                        Ya,
                            <input type="checkbox" name="pinjamPeriksaXX" id="pinjamPeriksaXX" value="N">
                            Tidak </td>         <td>&nbsp;</td>         <td><input type="checkbox" name="lampirPeriksa" id="lampirPeriksa" value="Y">
                              Ya,
                                <input type="checkbox" name="lampirPeriksaXX" id="lampirPeriksaXX" value="N">
                                Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>4.</td>
                        <td colspan="4">Apakah Anda pernah atau sedang menggunakan obat-obatan terlarang, narkoba dan bahan adiktif lainnya?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="narkoba" id="narkoba" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="narkoba2" id="narkoba2" value="Y">           Ya,
                          <input type="checkbox">           Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>5.</td>
                        <td colspan="4">Apakah anda menyukai minuman yang mengandung alkohol ?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Kalau &quot;Ya&quot;, jenis apa dan berapa banyak sehari?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="alkohol" id="alkohol"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="alkohol2" id="alkohol2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b. </td>         <td>Jika &quot;Tidak&quot; minum lagi sejak kapan?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="tglTdkAlkohol" id="tglTdkAlkohol"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="tglTdkAlkohol2" id="tglTdkAlkohol2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>6. </td>
                        <td colspan="4">Apakah Anda Merokok?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Kalau &quot;Ya&quot; berapa batang sehari?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="merokok" id="merokok"> 
                          batang</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="merokok2" id="merokok2"> 
                          batang</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b. </td>         <td>Sejak kapan mulai merokok?</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="tglmerokok" id="tglmerokok"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="tglmerokok2" id="tglmerokok2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top">7.</td>
                        <td colspan="7">Apakah anda pernah memeriksakan pada dokter, dirawat dirumah sakit, sanatorium atau tempat istirahat lain karena sakit (pemulihan) atau saat ini sedang mendapat pengobatan dokter dan mendapatkan obat yang dikonsumsi secara teratur?</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Utama</b>
                          <br>
                          <input type="checkbox" name="rawatinappulih" id="rawatinappulih" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td><b>Calon Tertanggung Tambahan </b>
                          <br>
                          <input type="checkbox" name="rawatinappulih2" id="rawatinappulih2" value="Y">Ya,
                          <input type="checkbox">Tidak </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>
                        <td colspan="2">Jika anda menjawab &quot;Ya&quot; mohon diisi pertanyaan berikut :</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>a.</td>         <td>Nama penyakit </td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="penyakit" id="penyakit"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="penyakit2" id="penyakit2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>b.</td>         <td>Kapan berobat atau dirawat (bulan dan tahun)</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="blnRawat" id="blnRawat">
                          MM/YYYY</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="blnRawat2" id="blnRawat2">
                          MM/YYYY</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>c.</td>         <td>Berapa lama dirawat</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="lamaDirawat" id="lamaDirawat"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="lamaDirawat2" id="lamaDirawat2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>d.</td>         <td>Nama dan dosis obat</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="namaObat" id="namaObat"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="namaObat2" id="namaObat2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>e.</td>         <td>Nama Rumah Sakit/Dokter</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="rmhSakitRawat" id="rmhSakitRawat"></td>         <td>&nbsp;</td>         <td>
                          <input type="text" name="rmhSakitRawat2" id="rmhSakitRawat2"></td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                      <tr>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>         <td>&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
              </table>    </td>
          </tr>
        </table>
        <table width="700" align="center">
          <tr>
            <td align="left" class="arial10">
              <!--<a href="#" onClick="window.history.go(-1)">Back</a>--></td>
            <td align="right">
              <input type="hidden" name="noklien" value=<? echo $noklien; ?>>
              <input type="hidden" name="notert2" value=<? echo $notert2; ?>>
              <input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
              <input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
              <input type="hidden" name="jnscari" value=<?=$jnscari;?>>
              <input type="submit" name="submit" value="Lanjut">		</td>
          </tr>
        </table>
      </form>
  </body>
</html>
<? //} ?>