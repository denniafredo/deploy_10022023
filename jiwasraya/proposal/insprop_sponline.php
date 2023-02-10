<?
//echo $userid.'xxxx';
	include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	include "../../includes/null.php";
	include "../../includes/klien.php";  
  include "../../includes/roleptg.php";
  include "../../includes/formula44.php";
  $FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopert);
  
  	
	//$DB=New Database($userid,$passwd,"JSDEPLOY");
	$DB=New Database($DBUser, $DBPass, $DBName);
	$DBZ=New Database("JSADM","JSADMOKE","JSDEPLOY");
	$DBZZ=New Database("JSADM","JSADMOKE","JSDEPLOY");
    $DBX=New Database($DBUser, $DBPass, $DBName);
	$DBR=New Database($DBUser, $DBPass, $DBName);
	$DBP=New Database($DBUser, $DBPass, $DBName);
	$DBXX=New Database("JSADM","JSADMOKE","JSDEPLOY");
	$DBINS=New Database("JSADM","JSADMOKE","JSDEPLOY");				
	$DBINSR=New Database($DBUser, $DBPass, $DBName);
	$DBINSR1=New Database($DBUser, $DBPass, $DBName);
	$DBINSR2=New Database($DBUser, $DBPass, $DBName);
	$DBINSINS=New Database($DBUser, $DBPass, $DBName);

  function GetNewPropTemp($DBX)	{
    srand ((double) microtime() * 1000000);
    $randval = rand();
  	$maxnopert=substr($randval,0,9);
  	return (string)$maxnopert;
  }
	$nopert=GetNewPropTemp($DBZ);
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
	$sqlxx="select noklien from dimas.L#3278 where entity_id='".$_GET['id']."'";
	$DBXX->parse($sqlxx);
	$DBXX->execute();
	$arrkln=$DBXX->nextrow();
	$nokliennya=$arrkln["NOKLIEN"];
	if($nokliennya!=""){
	$noklienbaru=$nokliennya;	
	}else{
	//Cari Noklien	
	$sqlnoklien="select $DBUser.no_klien.nextval+1 as maxnoklien from dual";
	$DB->parse($sqlnoklien);
	$DB->execute();
	$arr = $DB->nextrow();
	$maxnoklien = $arr["MAXNOKLIEN"];
	$newnoklien = $maxnoklien;
	$noklienbaru = str_pad($newnoklien,10,"0",STR_PAD_LEFT);
	}
	//echo $noklienbaru;
	
	//ambil data klien dari tabel spaj online
	$sqlkln="select NAMATERTANGGUNG,NOID,nospaj,
     TGLEXPIRED_ID,TEMPATLAHIR,TGLLAHIR,JENISKELAMIN,KDAGAMA,     
     to_char(TINGGIBADAN)TINGGIBADAN,to_char(BERATBADAN)BERATBADAN,
     NAMAIBUKAND,DIKAKHIR as DIK_AKHIR,NPWP,MERITALSTATUS,TGLNIKAH as TGLKAWIN,
     ALAMATTINGGALKTP,ALAMATTINGGALKTP2,KDKOTAMADYAKTP,KDPROPINSIKTP,KDPOSKTP,ALAMATTETAP as ALAMATTETAP01,
     ALAMATTETAP2 as ALAMATTETAP02,KDKOTAMADYATINGGAL as KDKOTAMADYATETAP,KDPROPINSITINGGAL as KDPROPINSITETAP,KODEPOSTETAP,PHONETETAP01,
     FAX_RMH,NO_HP1 as NO_PONSEL,NO_HP2 as NO_PONSEL2,(select kdpekerjaan from dimas.tabel_105_pekerjaan_ol where namapekerjaan=a.KDPEKERJAAN) kdpekerjaan,JABATAN as PANGKAT,NAMA_PERS,ALAMAT_PERS,
     TELPON_PERS,FAX_PERS,KET_USAHA,BID_USAHA,NAMA_USAHA,ALAMAT_USAHA,PENDAPATAN as BESAR_PENDAPATAN,
	 TUJUANASURANSI,KDPRODUK,KDFUND,LAMA_PEMBAYARAN_PREMI,CARABAYAR,JUA,to_char(add_months(sysdate,to_number(LAMA_PEMBAYARAN_PREMI)*12),'dd/mm/yyyy') akhirpremi
	 from DIMAS.TABEL_MAPPING_KLIEN a where nospaj='$spaj'";
	 //echo $sqlkln."<BR>";
	 $DBZ->parse($sqlkln);
	 $DBZ->execute();
	 $arrkln=$DBZ->nextrow();
	 
	 if($nokliennya==""){
	 $ins = "insert into $DBUser.tabel_100_klien(kdklien,noklien,namaklien1,noid,
     TGLEXPIRED_ID,TEMPATLAHIR,TGLLAHIR,JENISKELAMIN,KDAGAMA,
     TINGGIBADAN,BERATBADAN,
     NAMAIBUKAND,DIK_AKHIR,NPWP,MERITALSTATUS,TGLKAWIN,
     ALAMATTINGGALKTP,ALAMATTINGGALKTP2,KDKOTAMADYAKTP,KDPROPINSIKTP,KDPOSKTP,ALAMATTETAP01,ALAMATTETAP02,KDKOTAMADYATETAP,KDPROPINSITETAP,KODEPOSTETAP,PHONETETAP01,
     FAX_RMH,NO_PONSEL,NO_PONSEL2,KDPEKERJAAN,PANGKAT,NAMA_PERS,ALAMAT_PERS,
     TELPON_PERS,FAX_PERS,KET_USAHA,BID_USAHA,NAMA_USAHA,ALAMAT_USAHA,BESAR_PENDAPATAN) values ('N','$noklienbaru','".$arrkln['NAMATERTANGGUNG']."','".$arrkln['NOID']."',
	 to_date('".$arrkln['TGLEXPIRED_ID']."','dd/mm/yyyy'),'".$arrkln['TEMPATLAHIR']."',to_date('".$arrkln['TGLLAHIR']."','dd/mm/yyyy'),'".$arrkln['JENISKELAMIN']."',
	 '".$arrkln['KDAGAMA']."',
	 '".$arrkln['TINGGIBADAN']."','".$arrkln['BERATBADAN']."','".$arrkln['NAMAIBUKAND']."','".$arrkln['DIK_AKHIR']."','".$arrkln['NPWP']."',
	 '".$arrkln['MERITALSTATUS']."',to_date('".$arrkln['TGLKAWIN']."','dd/mm/yyyy'),'".$arrkln['ALAMATTINGGALKTP']."','".$arrkln['ALAMATTINGGALKTP2']."',
	 '".$arrkln['KDKOTAMADYAKTP']."','".$arrkln['KDPROPINSIKTP']."','".$arrkln['KDPOSKTP']."','".$arrkln['ALAMATTETAP01']."',
	 '".$arrkln['ALAMATTETAP02']."','".$arrkln['KDKOTAMADYATETAP']."','".$arrkln['KDPROPINSITETAP']."','".$arrkln['KODEPOSTETAP']."',
	 '".$arrkln['PHONETETAP01']."','".$arrkln['FAX_RMH']."','".$arrkln['NO_PONSEL']."','".$arrkln['NO_PONSEL2']."','".$arrkln['KDPEKERJAAN']."',
	 '".$arrkln['PANGKAT']."','".$arrkln['NAMA_PERS']."','".$arrkln['ALAMAT_PERS']."','".$arrkln['TELPON_PERS']."','".$arrkln['FAX_PERS']."','".$arrkln['KET_USAHA']."',
	 '".$arrkln['BID_USAHA']."','".$arrkln['NAMA_USAHA']."','".$arrkln['ALAMAT_USAHA']."','".$arrkln['BESAR_PENDAPATAN']."')";
	 echo $ins."<br>";
	 $DB->parse($ins);
	 if($DB->execute()){
		 $sqlupdated="update dimas.L#3278 set noklien='$noklienbaru' where entity_id='".$_GET['id']."'";
		 $DBZZ->parse($sqlupdated);
		 $DBZZ->execute();		 		 
			 $cekinsr="select * from dimas.tabel_ahli_waris where nospaj='".$_GET['spaj']."'";
			 echo $cekinsr."<br>";
			 $DBINS->parse($cekinsr);
			 $DBINS->execute();
			 while($arrins=$DBINS->nextrow()){
				$sqlnoinsr="select $DBUser.no_klien.nextval+1 as maxnoinsr from dual";
				$DBINSR->parse($sqlnoinsr);
				$DBINSR->execute();
				$arrinsr = $DBINSR->nextrow();
				$maxnoinsr = str_pad($arrinsr["MAXNOINSR"],10,"0",STR_PAD_LEFT);
				$sqlklnins="insert into $DBUser.tabel_100_klien (kdklien,noklien,namaklien1,tempatlahir,tgllahir,jeniskelamin) values ('N','$maxnoinsr','".$arrins["NAMAAHLIWARIS"]."','".$arrins["TEMPATLAHIR"]."',to_date('".substr($arrins["TANGGALLAHIR"],0,10)."','yyyy-mm-dd'),'".$arrins["JENISKELAMIN"]."')";	 
				$sqlinsurable="insert into $DBUser.tabel_113_insurable (notertanggung,kdhubungan,noklieninsurable) values ('$noklienbaru','".$arrins["HUBUNGANTERTANGGUNG"]."','$maxnoinsr')";
				//echo $sqlklnins."<br>";
				$DBINSR1->parse($sqlklnins);
				$DBINSR1->execute();
				//echo $sqlinsurable."<br>";
				$DBINSR2->parse($sqlinsurable);
				$DBINSR2->execute();
			}
		 
		 	 
	 }else{
		 echo "Insert klien gagal";
	 }
	 
	 }//Insert data ke tabel klien
	 
	
	$lamaasuransi_th=5;//disesuaikan dengan masing produk
	$lamaasuransi_bl=0;//disesuaikan dengan masing produk
	$indexawal=1;//disesuaikan dengan masing produk
	$kdcarabayar='X';//disesuaikan dengan masing produk	
	$notertanggung=$noklienbaru;
	$nopembayarpremi=$noklienbaru;
	$nopemegangpolis=$noklienbaru;
	$pempolno=$noklienbaru;
	$nosp=$arrkln['NOSPAJ'];
	$pempreno=$noklienbaru;
	$pempolhub="DIRI TERTANGGUNG";
	$pemprehub="DIRI TERTANGGUNG";
	$pempolnama=$arrkln['NAMATERTANGGUNG'];
	$pemprenama=$arrkln['NAMATERTANGGUNG'];
	$kdstatusmedical='N';
	$noagen=$_GET['noagen'];;
	$nopenagih=$_GET['nopenagih'];
	
	$kdvaluta='1';
	$juamainproduk=$arrkln['JUA'];
	$kdproduk=$_GET['kdproduk'];
	if($kdproduk=="JSSPKN"){
		//$premi1=$juamainproduk/0.25;
		$premi1=$juamainproduk;
	}else{
		$premi1=$juamainproduk/0.25;
	}
	$premi2=0;
	$lamapembpremi_th=$arrkln['LAMA_PEMBAYARAN_PREMI'];
	$lamapembpremi_bl=0;
	$lamaasuransi_th=$arrkln['LAMA_PEMBAYARAN_PREMI'];
	$lamaasuransi_bl=0;
	$tglsp="";
	$mulas=date("d/m/Y");
	$akhirpremi=$arrkln['AKHIRPREMI'];
	$expirasi=$arrkln['AKHIRPREMI'];
	
	$sql="insert into $DBUser.tabel_200_temp(prefixpertanggungan,kdpertanggungan,tglakhirpremi,gadaiotomatis,".
	     "notertanggung,nosp,nopertanggungan,tglsp,kdproduk,mulas,usia_th,usia_bl,".                  
       "expirasi,lamaasuransi_th,lamaasuransi_bl,lamapembpremi_th,lamapembpremi_bl,".
       "kdvaluta,juamainproduk,premi1,kdcarabayar,indexawal,premi2,nopenagih,kdstatusfile,".
			 "noagen,tglrekam,userrekam,tglupdated,userupdated,kdstatusmedical,nopemegangpolis,nopembayarpremi,premistd) ".
	     "values ('$prefixpertanggungan','1',add_months(sysdate,(".$lamapembpremi_th."*12)),'$bpo',".
			 "'$notertanggung','$nosp','$nopert',to_date('$tglsp','DD/MM/YYYY'),'$kdproduk',".
			 "to_date('$mulas','DD/MM/YYYY'),round(MONTHS_BETWEEN(to_date('$mulas','DD/MM/YYYY'),to_date('".$arrkln['TGLLAHIR']."','dd/mm/yyyy'))/12),'0',add_months(to_date('$mulas','DD/MM/YYYY'),60),$lamaasuransi_th,$lamaasuransi_bl,".$arrkln['LAMA_PEMBAYARAN_PREMI'].",0,".
       "'$kdvaluta',$juamainproduk,$premi1,'$kdcarabayar',$indexawal,$premi2,'$nopenagih','1',".
			 "'$noagen',sysdate,user,to_date('$mulas','DD/MM/YYYY'),user,'$kdstatusmedical','$nopemegangpolis','$nopembayarpremi',$premi1)";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
	
	$sql="insert into $DBUser.tabel_247_temp".
			 "(prefixpertanggungan,nopertanggungan,kdbasispremi,kdbasistebus,kdbasisskg,kdbasiscwa,kdbasisbayar) ".
			 "select '$prefixpertanggungan','$nopert',a.kdbasispremi,a.kdbasistebus,a.kdbasisskg,a.kdbasiscwa,a.kdbasisbayar ".
			 "from $DBUser.tabel_246_produk_basis a ".
			 "where a.kdproduk='$kdproduk' and a.kdvaluta='$kdvaluta' ".
			 "and a.tglberlaku <= (select max(tglberlaku) from $DBUser.tabel_246_produk_basis ".
 			  "where kdbasispremi=a.kdbasispremi and kdbasistebus=a.kdbasistebus and kdbasisbayar=a.kdbasisbayar ".
					"and kdbasisskg=a.kdbasisskg and kdbasiscwa=a.kdbasiscwa ".
					"and kdproduk=a.kdproduk and kdvaluta=a.kdvaluta and tglberlaku <= sysdate) ";
	//echo $sql."<br>";		 
	$DB->parse($sql);
	$DB->execute();
	
	
	$sql="begin	$DBUser.insbnft('$prefixpertanggungan','$nopert','$kdproduk');end;";			
		
	//echo $sql;
  $DB->parse($sql);
  $DB->execute();
  $DB->commit();  
  
  $FM=new Formula($userid,$passwd,$prefixpertanggungan,$nopert);
  
  $sql ="insert into $DBUser.tabel_219_temp (prefixpertanggungan,nopertanggungan,kdinsurable,notertanggung,noklien,nourut) ".
            			   "values ('$prefixpertanggungan','$nopert','04','$notertanggung','$notertanggung',1) ";
  $sqlinsins ="insert into $DBUser.tabel_219_temp (prefixpertanggungan,nopertanggungan,kdinsurable,notertanggung,noklien,nourut) ".
            			   "select '$prefixpertanggungan','$nopert',KDHUBUNGAN,'$notertanggung',noklieninsurable,rownum+1 from tabel_113_insurable where notertanggung='$notertanggung'";
						   
            			 
            	//echo "<font size=1>$sql<br>";
            	$DB->parse($sql);
            	$DB->execute();
            	$DB->nextrow();
				$DBINSINS->parse($sqlinsins);
            	$DBINSINS->execute();            
				
 
  $sqls="begin $DBUser.compcomm('$prefixpertanggungan','$nopert',$premi1,$premi1); end;";
		$DBX->parse($sqls);
		$DBX->execute(); 
		
		
//tes formula44
function GetFormula($DBR,$kdrumus) {
	  $sql="select rumus from $DBUser.tabel_224_rumus ".
		     "where kdrumus='$kdrumus'";
			 //echo $sql."<br>";
			 //die;
   	$DBR->parse($sql);
    $DBR->execute();
    $arr=$DBR->nextrow();
		$rumus=$arr["RUMUS"];
		//echo $rumus;
		return $rumus;
	}
	
	$sqlr="select a.kdproduk,a.periodebayar,a.periodebenefit,a.kdbenefit,a.nilaibenefit,a.premi,a.kdjenisbenefit,b.kdrumusbenefit, b.kdrumuspremi, c.namabenefit, c.kdkelompokbenefit ".
       "from $DBUser.tabel_223_temp a, $DBUser.tabel_206_produk_benefit b, $DBUser.tabel_207_kode_benefit c ".
  	   "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopert' ".
       "and a.kdproduk=b.kdproduk(+) and a.kdbenefit=b.kdbenefit(+) and a.kdbenefit=c.kdbenefit(+)";
	   echo $sqlr;
	$DBR->parse($sqlr);
  $DBR->execute();
  $result = $DBR->result();
 $z=0; 
$no = 1; $jmlpremi = 0; $jmlbenefit = 0;
  reset($result);
  foreach ($result as $foo => $arr) {
		//echo "fuck";
		$kdbenefit = $arr["KDBENEFIT"];
		$namabenefit = $arr["NAMABENEFIT"];
		$kdjenisbenefit = $arr["KDJENISBENEFIT"];
		$kdkelompokbenefit = $arr["KDKELOMPOKBENEFIT"];
 	    $kdrumus = $arr["KDRUMUSPREMI"];				
		$rumuspremi = GetFormula($DBX,$kdrumus);		
		//echo $rumuspremi."monyet";
 	    $kdrumus = $arr["KDRUMUSBENEFIT"];
		$rumusbenefit = GetFormula($DBX,$kdrumus);
		//echo $rumusbenefit."monyet";
		if ($kdjenisbenefit=="R") {  
			$FM->add1 = $arr["PERIODEBAYAR"];
			$FM->add2 = $arr["PERIODEBENEFIT"];
		}

		$hasilpremi = $arr["PREMI"];
		$hasilbenefit = $arr["NILAIBENEFIT"];


		if(is_null($hasilpremi)||is_null($hasilbenefit)||is_null($hasilexpirasi)) {
		  if ((strlen($rumuspremi)==0) && (strlen($rumusbenefit)==0)) {
		    $hasilpremi = 0;
		    $hasilbenefit = 0;
			$hasilexpirasi = NULL;
		  } else {
				$FM->parse($rumuspremi);
				$hasilpremi=$FM->execute($DBP);
				$FM->parse($rumusbenefit);
				$hasilbenefit=$FM->execute($DBP);
				//echo "ini nilainya benefit ".$hasilbenefit."<br>";
				$FM->parse($rumusexpirasi);
        $hasilexpirasi=$FM->execute($DBP);
				$FM->parse($rumusakhirpmb);
        $hasilakhirpmb=$FM->execute($DBP);
        
		$sql="update $DBUser.tabel_223_temp ".
			     "set premi='$hasilpremi', nilaibenefit=$hasilbenefit ".
  	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopert' ".
			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			//echo $sql."<br>";
			
			$DB->parse($sql);
      $DB->execute();
  			  if ($kdproduk=="JSP" || $kdproduk=="JSPBTN" || $kdproduk=="JSPNN" || $kdproduk=="JSPSN"){
  				  if($kdbenefit=="WAIVER2"){
						  $hasilpremi=0;
						}
  				}
			 }
		}
		
		$jmlpremi = $jmlpremi + $hasilpremi;
		$jmlbenefit = $jmlbenefit + $hasilbenefit;
		$no ++;
		$z++;
	}
	$ni=1;
		 foreach ($result as $foo => $arr) {
		  $kdproduk  = $arr["KDPRODUK"];
		  $kdbenefit = $arr["KDBENEFIT"];
			//$premi = ${"prm".$kdbenefit};
			$premi = $hasilpremi[$ni];
			//echo "<br>ini prm-> ".$prm;
			if (strlen($premi)==0) $premi="null";
			//$benefit = ${"bnf".$kdbenefit};
			$benefit = $hasilbenefit[$ni];
			//echo "<br>ini benefit-> ".$benefit."<--$kdbenefit";
			if (strlen($benefit)==0) $benefit="null";
			$sql="update $DBUser.tabel_223_temp ".
			     "set premi=$premi, nilaibenefit=$benefit ".
  	       "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopert' ".
			     "and kdproduk='$kdproduk' and kdbenefit='$kdbenefit'";
			//echo $sql."<br>";
			
		//	$DB->parse($sql);
      //$DB->execute();
	  $no++;
	} 
//akhir tes formula44		
?>
<html>
<head>
<script type="text/javascript">
function blinkIt() {
 if (!document.all) return;
 else {
   for(i=0;i<document.all.tags('blink').length;i++){
      s=document.all.tags('blink')[i];
      s.style.visibility=(s.style.visibility=='visible')?'hidden':'visible';
   }
 }
}
</script>

<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body onload="setInterval('blinkIt()',300)">
<div align="center">
<?
if ($mode=='edit'){
  echo "<form action=\"proposaltoke.php\" method=\"post\" name=\"edit\">";
} else {
  //if ($userid=='BAGUS'){
  //echo "<form action=\"proposaloke.php?nopropos=001636864\" method=\"post\" name=\"insert\">";
  //}
  //else{	
  echo "<form action=\"proposaloke.php\" method=\"post\" name=\"insert\">";
  //}
}

?>
<table border="0" cellpadding="1" width="700" cellspacing="1" class="tblhead">
	<tr>
		<td class="tblisi">
			<table width="100%" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td width="100%" colspan="6"  align="center" class="tblhead"><b>KONFIRMASI PROPOSAL <?if (!strlen($noproposal)==0){echo $prefixpertanggungan."-".$noproposal; } ?>
					</b><br><?if (strlen($noproposal)==0){ echo "<font size=2>nomor diberikan otomatis setelah submit berhasil untuk proposal baru</font>"; }?>
					</td>
				</tr>
				<tr>
					<td width="100%" colspan="6"  align="center" class="tblisi1">
					<font size="2" color="red"><b>
					Periksa Baik baik Apakah Data Telah Lengkap Dan Benar</b><br>Premi dan JUA jangan sampai bernilai 0</td>
				</tr>				
				<tr>
					<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="1" cellspacing="1" class="verdana8">	
							<tr>
								<td width="18%" >SPAJ nomor</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $nosp; ?></td>
								<td width="18%" >Tanggal SPAJ</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $tglsp; ?></td>
							</tr>
							<tr>
								<td width="18%" >BP3 nomor</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $nobp3; ?></td>
								<td width="18%" >Tanggal BP3</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $tglbp3; ?></td>
							</tr>
						</table>
					</td>
				</tr>
                
                	
                
                
                
				<tr>
					<td width="100%" colspan="6"  class="tblhead1" align="center">Tertanggung</td>
				</tr>
				<tr>
					<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="0" cellspacing="0" class="verdana8">	
							<tr>
								<td width="18%" >Klien nomor</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $notertanggung; ?></td>
                <?
                
                	$sql="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,f.namaagama,".
                			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode(a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin,a.kdid||'-'||a.noid identitas, ".
                			 "a.tinggibadan,a.beratbadan,alamattetap01,alamattetap02,a.phonetetap01,a.phonetagih01,d.namakotamadya,e.namapropinsi,decode(a.meritalstatus,'L','LAJANG','K','KAWIN','J','JANDA','D','DUDA') merital ".
                			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
                			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e,$DBUser.tabel_102_agama f ".
                		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) and a.kdagama=f.kdagama(+) ".
                			 "and a.kdpropinsitetap=e.kdpropinsi(+) and a.kdkotamadyatetap=d.kdkotamadya(+) and a.noklien='$notertanggung' ";
                	//echo $sql."<br>";	 
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$nama = (strlen($ara["GELAR"])==0) ? $ara["NAMAKLIEN1"] : $ara["NAMAKLIEN1"].",".$ara["GELAR"];
                ?>
								<td width="18%" >Nama</td>
								<td width="2%" >:</td>
								<td width="30%" ><?echo $nama; ?>
			 					</td>
							</tr>
							<tr>
								<td width="18%" >Tgl Lahir</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["TGLLAHIR"]; ?></td>
								<td width="18%" >Jenis Kelamin</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["JENISKELAMIN"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Alamat</td>
								<td width="2%" >:</td>							
								<td  colspan="4"><? echo $ara["ALAMATTETAP01"]." ".$ara["ALAMATTETAP02"]." ".$ara["NAMAKOTAMADYA"]." ".$ara["NAMAPROPINSI"]; ?></td>
							</tr>																
							<tr>
								<td width="18%" >Pekerjaan</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NAMAPEKERJAAN"]; ?></td>
								<td width="18%" >Hobby</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NAMAHOBBY"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Tinggi Badan</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["TINGGIBADAN"]; ?> &nbsp;&nbsp;&nbsp;cm</td>
								<td width="18%" >Berat Badan</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["BERATBADAN"]; ?>&nbsp;&nbsp;&nbsp;kg</td>
							</tr>						
							<tr>
								<td width="18%" >Identitas</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["IDENTITAS"]; ?></td>
								<td width="18%" >Agama</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NAMAAGAMA"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Status Pernikahan</td>
								<td width="2%" >:</td>							
								<td  colspan="4"><? echo $ara["MERITAL"]; ?></td>
							</tr>	
							<tr>
								<td width="18%" >Telepon Tetap</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["PHONETETAP01"]; ?></td>
								<td width="18%" >Telepon Tagih</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["PHONETAGIH01"]; ?></td>
							</tr>
															
						</table>
					</td>
				</tr>
				<tr>
					<td width="100%" colspan="6"  class="tblhead1"><p align="center">Ketentuan Polis</td>
				</tr>
				<tr>
				  <td width="100%" align="center" colspan="6">
					  <table width="95%" border="0" cellpadding="0" cellspacing="0" class="verdana8">	
						  <tr>
							  <td width="18%" >Kode Produk</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $kdproduk; ?></td>
								<td width="18%" >Nama Produk</td>
								<td width="2%" >:</td>
                <?
								$sql = "select premi1 from $DBUser.tabel_200_temp ".
                			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopert'";
                //echo $sql;
                	$DB->parse($sql);
                	$DB->execute();
                	$arr=$DB->nextrow();
								  //$premi1 = $arr["PREMI1"];
									
                	$sql="select namaproduk,skg from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$kprod=$ara["SKG"];
                	
                	$sql = "select 'x' x from $DBUser.tabel_223_temp ".
                			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopert' and kdbenefit='JAMLKP'";
                	//echo $sql;
                	$DB->parse($sql);
                	$DB->execute();
                	$arr=$DB->nextrow();
                	$namaproduk = ($arr["X"]=='x') ? $ara["NAMAPRODUK"]." <font color=red>LENGKAP" : $ara["NAMAPRODUK"];
                  
                ?>
								<td width="30%" ><? echo $namaproduk; ?></td>
							</tr>
							<tr>
								<td width="18%" >Medical</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $kdstatusmedical; ?></td>
								<td width="18%" >Tgl Mulai</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $mulas; ?></td>
							</tr>
							<tr>
								<td width="18%" >Usia</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $usia_th." th, ".$usia_bl." bl."; ?></td>
								<td width="18%" >Lama Asuransi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $lamaasuransi_th." th, ".$lamaasuransi_bl." bl.";?></td>
							</tr>
							<tr>
								<td width="18%" >Tgl Ekspirasi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $expirasi; ?></td>
								<td width="18%" >Gadai Otomatis</td>
								<td width="2%" >:</td>
								<td width="30%" ><? if ($bpo=='1') { echo "SETUJU"; } else { echo "TIDAK SETUJU"; } ?>	</td>
							</tr>
							<tr>
								<td width="18%" >Akhir Premi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $akhirpremi; ?></td>
								<td width="18%" >Lama Premi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $lamapembpremi_th." th, ".$lamapembpremi_bl." bl.";?></td>
							</tr>
							<tr>
								<td width="18%" >V a l u t a</td>
								<td width="2%" >:</td>
                <?		
                	$sql="select namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta' ";
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                
                ?>
								<td width="30%" ><? echo $ara["NAMAVALUTA"]; ?></td>
								<td width="18%" >Cara Bayar</td>
								<td width="2%" >:</td> 
                <?		
                	$sql="select namacarabayar,kdjeniscb,faktorkomisi from $DBUser.tabel_305_cara_bayar where kdcarabayar='$kdcarabayar' ";
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$faktorkomisi=$ara["FAKTORKOMISI"];
                	$kdjeniscb=$ara["KDJENISCB"];
					$carabayar=$ara["NAMACARABAYAR"];
                  ?>
								<td width="30%" ><? echo $ara["NAMACARABAYAR"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Index  Awal</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $indexawal; ?></td>
								<td width="18%" >Premi 5 th I</td>
								<td width="2%" >:</td>
								<td width="30%" ><font color="red"><? echo number_format($premi1,2); ?></td>
							</tr>
							<tr>
								<td width="18%" >J U A</td>
								<td width="2%" >:</td>
								<td width="30%" ><font color="red"><? echo number_format($juamainproduk,2); ?></td>
								<td width="18%" >Premi >5 tahun</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($premi2,2); ?></td>
							</tr>
							
							<tr>
								<td width="18%" >Premi Standar</td>
								<td width="2%" >:</td>
								<td width="30%" ><font color="red"> <? echo number_format($premistd,2) ; ?></td>
								<td>Auto Debet</td>
								<td>:</td>
								<td>
								<?=($autodebet==1)? "YA" : "TIDAK";?> 
								
								<? 
								if($autodebet==1)
								{
								$sql = "select namabank from $DBUser.tabel_399_bank where kdbank='$kdbank'";
      					$DB->parse($sql);
      					$DB->execute();
								$arr=$DB->nextrow();
								
								echo "(".$arr["NAMABANK"]." No.Rek. $norekening)";
								}
								?>
								</td>
							</tr>			
							<?
							$sql = "select kdbenefit,premi from $DBUser.tabel_223_temp where  
                      kdbenefit in ('BNFTOPUP','BNFTOPUPSG')
                      and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
							$DB->parse($sql);
      			  $DB->execute();
							while($top=$DB->nextrow())
							{
							  if($top["KDBENEFIT"]=="BNFTOPUP")
								{
								  $ptopupbk = $top["PREMI"];
								} else {
								  $ptopupsg = $top["PREMI"];
								}
							}
							?>
							<tr>
								<td width="18%" >Premi Top-up Berkala</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($ptopupbk,2); ?></td>
								<td width="18%" ></td>
								<td width="2%" ></td>
								<td width="30%" ></td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td width="100%" align="center" colspan="6"  class="tblhead1">Benefit</td>
				</tr>
				<tr>
				  <td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="0" cellspacing="0" class="verdana8">	
							<tr class="hijao">
								<td colspan="3" width="30%" align="left">Nama Benefit</td>
								<td width="17%" align="center">Benefit</td>
								<td width="15%"  align="center">Jatuh Tempo</td>
								<td width="20%" align="right">Premi (per tahun)</td>
							</tr>
            <?
            	$sql="select a.namabenefit,b.premi,b.nilaibenefit,b.kdjenisbenefit,to_char(b.expirasi,'DD/MM/YYYY') expirasi ".
            			 "from $DBUser.tabel_223_temp b, $DBUser.tabel_207_kode_benefit a ".
            			 "where a.kdbenefit=b.kdbenefit and ".
            			 "b.prefixpertanggungan='$prefixpertanggungan' and b.nopertanggungan='$nopert'";
							$DB->parse($sql);
            	$DB->execute();
            	while ($ara=$DB->nextrow()) {
            	  $jmlpremi+=$ara["PREMI"];
            		$jmlbenefit+=$ara["NILAIBENEFIT"];
            		$nb=$ara["NILAIBENEFIT"]!=0 ? number_format($ara["NILAIBENEFIT"],2):' ';
            		$np=$ara["PREMI"]!=0 ? number_format($ara["PREMI"],2):' ';	
            		echo "<tr>";
            		echo "<td colspan=3>".$ara["NAMABENEFIT"]."</td>";
            		echo "<td align=\"right\">".$nb."</td>";
            		echo "<td  align=\"center\">".$ara["EXPIRASI"]."</td>";
            		echo "<td  align=\"right\">".$np."</td>";
            		echo "</tr>";
            	}
            	  echo "<tr>";
            		echo "<td ></td>";
            		echo "<td ></td>";
            		echo "<td ></td>";
            		echo "<td ><hr size=1></td>";
            		echo "<td ></td>";
            		echo "<td ><hr size=1></td>";
            		echo "</tr>";
            		echo "<tr>";
            		echo "<td colspan=3 align=right>Jumlah</td>";
            		echo "<td  align=\"right\"></b></td>";
            		echo "<td ></td>";
            		echo "<td align=\"right\"><b>".number_format($jmlpremi,2)."</b></td>";
            		echo "</tr>";
            ?>
				 		</table>
					</td>
			 	</tr>
		 	 	<tr>
			 		<td width="100%" align="center" colspan="6" class="tblhead1">Pemegang Polis, Pembayar Premi, Beneficiary</td>
				</tr>
			 	<tr>
			 		<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="0" cellspacing="0" class="verdana8">	
						 	<tr class="hijao">
						 		<td width="18%" align="center">Jenis</td>
								<td width="2%"></td>
								<td width="30%" align="center"> Nomor Klien</td>
								<td width="18%" align="center">Hubungan</td>
								<td width="2%"></td>
								<td width="30%" align="center">Nama</td>
							</tr>
			 				<tr>
			 					<td width="18%" >Pemegang Polis</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $pempolno; ?></td>
								<td width="18%" ><? echo $pempolhub; ?></td>
								<td width="2%" ></td>
								<td width="30%" ><? echo $pempolnama; ?></td>
							</tr>
			 				<tr>
			 					<td width="18%" >Pembayar Premi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $pempreno; ?></td>
								<td width="18%" ><? echo $pemprehub; ?></td>
								<td width="2%" ></td>
								<td width="30%" ><? echo $pemprenama; ?></td>
							</tr>
            <? 
           // $sql = "delete from $DBUser.tabel_219_temp ".
            	//	   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
            //	$DB->parse($sql);
            ///	$DB->execute();
            //	$DB->nextrow();
            		 
            for($i=1;$i<=$demit;$i++){
            	$k[$i]='klienno'.$i;
            	$a[$i]='hubungan'.$i;
            	$b[$i]='nama'.$i;
            	$ahw = $$k[$i];
            	
            	if ($notertanggung==$ahw) {
            	 $sql ="insert into $DBUser.tabel_219_temp (prefixpertanggungan,nopertanggungan,kdinsurable,notertanggung,noklien,nourut) ".
            			   "values ('$prefixpertanggungan','$nopertanggungan','04','$notertanggung','$ahw',$i) ";
            	} else {
            	 $sql1 ="insert into $DBUser.tabel_219_temp (prefixpertanggungan,nopertanggungan,kdinsurable,notertanggung,noklien,nourut) ".
            			   "select '$prefixpertanggungan','$nopertanggungan',b.kdhubungan,notertanggung,noklieninsurable,$i ".
            				 "from $DBUser.tabel_113_insurable a, $DBUser.tabel_218_kode_hubungan b ".
            				 "where a.notertanggung='$notertanggung' and a.noklieninsurable='$ahw' ".
            				 "and b.namahubungan='".$$a[$i]."' and a.kdhubungan=b.kdhubungan";
            	}			 
            	//echo "<font size=1>$sql<br>";
            	$DB->parse($sql);
            	$DB->execute();
            	$DB->nextrow();
            				 
            	echo "<tr>";
              echo "<td width=\"18%\" >Ahli Waris ".$i."</td>";
            	echo "<td width=\"2%\" >:</td>";
              echo "<td width=\"30%\" >".$ahw."</td>";
              echo "<td width=\"18%\" >".$$a[$i]."</td>";
            	echo "<td width=\"2%\" ></td>";
              echo "<td width=\"30%\" >".$$b[$i]."</td>";
              echo "</tr>";
            }
            ?>
			 			</table>
					</td>
			 	</tr>
		 	 	<tr>
			 		<td width="100%" align="center" colspan="6"  class="tblhead1">Penutup</td>
  			</tr>
			 	<tr>
			 		<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="1" cellspacing="1" class="verdana8">	
							<tr class="hijao">
				 				<td width="18%" align="center">Jenis</td>
								<td width="2%"></td>
								<td width="30%" align="center"> Nomor Klien</td>
								<td width="50%" align="center">Nama</td>
							</tr>  
				 			<tr>
				 				<td width="18%">Penagih</td>
								<td width="2%">:</td>
                <?	
                	$sql="select namaklien1,namaklien2,noklien from $DBUser.tabel_100_klien where noklien=$nopenagih ";
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                ?>
								<td width="30%" ><? echo $ara["NOKLIEN"]; ?></td>
								<td width="50%" ><? echo $ara["NAMAKLIEN1"]." ".$ara["NAMAKLIEN2"]; ?></td>
								<!--<td width="2%" ></td>
								<td width="30%" ><? echo $ara["NAMAKLIEN2"]; ?></td>-->
							</tr>
			 				<tr>
              <?		
              	$sql="select namaklien1,namaklien2,noklien from $DBUser.tabel_100_klien where noklien=$noagen ";
              	$DB->parse($sql);
              	$DB->execute();
              	$ara=$DB->nextrow();
              ?>
								<td width="18%" >Agen</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NOKLIEN"]; ?></td>
								<td width="50%" ><? echo $ara["NAMAKLIEN1"]." ".$ara["NAMAKLIEN2"]; ?></td>
  						</tr>
			 				<tr>
<?
	$sql="select kdstatusfile,namastatusfile from $DBUser.tabel_299_status_file";			
	$DB->parse($sql);			
	$DB->execute();	    
	$ara=$DB->nextrow();			    
?>	
								<td width="18%" >Status</td>
								<td width="2%" >:</td>
								<!--<td width="30%" ><? echo $ara["NAMASTATUSFILE"]; ?></td>-->
								<td width="30%" ><? echo "AKTIF"; ?></td>
								<td width="50%" ></td>
							</tr>
			 			</table>
					</td>
		 		</tr>
                
                <!--PMN-->
                <tr>
					<td width="100%" colspan="6"  class="tblhead1" align="center"><b><font color="#FF0000" >PMN - Prinsip Mengenal Nasabah</font></b></td>
				</tr>
                <tr>
					<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="0" cellspacing="0" class="verdana8">	
							<tr>
								<td width="18%" >Klien nomor</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $notertanggung; ?></td>
                <?
                
                	$sql="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,f.namaagama,".
                			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, ROUND(months_between (sysdate,a.tgllahir)/12,0) usiapp, decode(a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin,a.kdid||'-'||a.noid identitas, ".
                		"a.tinggibadan,a.beratbadan,alamattetap01,alamattetap02,a.phonetetap01,a.phonetagih01,d.namakotamadya,e.namapropinsi,decode(a.meritalstatus,'L','LAJANG','K','KAWIN','J','JANDA','D','DUDA') merital ".
                			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
                			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e,$DBUser.tabel_102_agama f ".
                		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) and a.kdagama=f.kdagama(+) ".
                			 "and a.kdpropinsitetap=e.kdpropinsi(+) and a.kdkotamadyatetap=d.kdkotamadya(+) and a.noklien='$pempolno' ";
                	//echo $sql;	 
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$nama = (strlen($ara["GELAR"])==0) ? $ara["NAMAKLIEN1"] : $ara["NAMAKLIEN1"].",".$ara["GELAR"];
					
					$warnaus = (($ara["USIAPP"]/1)>=22) ? "#009F00" : "#FF0000" ;
					$flagus = (($ara["USIAPP"]/1)>=22) ? "" : "<blink><img src='red_flag.png' width='15' height='15'></blink>" ;
					$warnacb = ($carabayar=='SEKALIGUS') ? "#FF0000" : "#009F00" ;
					$flagcb = ($carabayar=='SEKALIGUS') ? "<blink><img src='red_flag.png' width='15' height='15'></blink>" : "" ;
					$warnaprm = (($premi1/1)>=500000000) ? "#FF0000" : "#009F00"  ;
					$flagprm = (($premi1/1)>=500000000) ? "<blink><img src='red_flag.png' width='15' height='15'></blink>" : "" ;
					
					if ($ara["NAMAPEKERJAAN"]=='PEGAWAI BUMN' ||
					$ara["NAMAPEKERJAAN"]=='PEGAWAI BUMD' ||
					$ara["NAMAPEKERJAAN"]=='PEGAWAI NEGERI SIPIL' ||
					$ara["NAMAPEKERJAAN"]=='TNI / POLRI' ||
					$ara["NAMAPEKERJAAN"]=='IBU RUMAH TANGGA' ||
					$ara["NAMAPEKERJAAN"]=='MAHASISWA' ||
					$ara["NAMAPEKERJAAN"]=='GUBERNUR') {
						$warnakrj = "#FF0000" ;
						$flagkrj = "<blink><img src='red_flag.png' width='15' height='15'></blink>" ;
					} else {
						$warnakrj = "#009F00" ;
						$flagkrj = "" ;
					}
					






					
                ?>
								<td width="18%" >Nama</td>
								<td width="2%" >:</td>
								<td width="30%" ><?echo $nama;?>
			 					</td>
							</tr>
							<tr>
								<td width="18%" >Usia Pempol</td>
								<td width="2%" >:</td>
								<td width="30%" ><b><font color= "<? echo $warnaus; ?>"><? echo $ara["USIAPP"]; ?> &nbsp;TAHUN </font></b><? echo $flagus;?></td>
							</tr>
							<tr>
								<td width="18%" >Premi</td>
								<td width="2%" >:</td>							
								<td><b><font color= "<? echo $warnaprm; ?>"><? echo number_format($premi1,2); ?></font></b><? echo $flagprm;?></td>
                                <td width="18%" >Cara Bayar</td>
								<td width="2%" >:</td>
								<td width="30%" ><b><font color= "<? echo $warnacb; ?>"><? echo $carabayar; ?> </font></b><?echo $flagcb;?></td>
							</tr>																
							<tr>
								<td width="18%" >Pekerjaan</td>
								<td width="2%" >:</td>
								<td width="30%" ><b><font color= "<? echo $warnakrj; ?>"><? echo $ara["NAMAPEKERJAAN"]; ?></font></b><? echo $flagkrj;?></td>
								<td width="18%" ></td>
								<td width="2%" ></td>
								<td width="30%" ></td>
							</tr>
							
															
						</table>
					</td>
				</tr>
                <!--PMN-->
                
				<tr>
			 		<td width="100%" align="center" colspan="6" class="verdana8">
<?
	$sql="select a.thnkomisi,a.komisiagen,b.namakomisiagen,b.kdkomisiagen, ".
	     "decode(b.kdkomisiagen,'02',0,a.komisiagen) ko, a.komisiagen,".
			 "decode(b.kdkomisiagen,'02',b.namakomisiagen,b.namakomisiagen||' TAHUN '||a.thnkomisi) nk, ".
	     "decode(b.kdkomisiagen,'02',a.komisiagen,decode('$kprod','1',decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen),decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen*$faktorkomisi) ) ) k ".  
			 "from $DBUser.tabel_404_temp a, $DBUser.tabel_402_kode_komisi_agen b ".
			 "where a.kdkomisiagen=b.kdkomisiagen and ".
			 "a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopert' ".
			 "order by b.namakomisiagen desc";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
?>
	<table cellspacing="0" cellpadding="0" border="0" width="60%" class="verdana8">
  <tr class="tblhead1" align="center">
  <td rowspan="2" >Tahun</td>
  <td  rowspan="2">Nama Komisi</td>
  <td colspan="2">K o m i s i</td>
  </tr>
  <tr class="tblhead1" align="center">
  <td>Dalam Tahun</td>
  <td>Sesuai Cara Bayar</td>
  </tr>
<?
 
 $jmlkomisi=0;
	$i=1;
  while($arr=$DB->nextrow()) {
	  include "../../includes/belang.php";
		$ko = $arr["KO"];
		$k  = $arr["K"];
		//echo $arr["KOMISIAGEN"]."|".$ko."|".$k;
		$ko =  ($kdjeniscb=='X') ? $k : $ko;
	  $add = ($arr["KDKOMISIAGEN"]=='02') ? $k : $ko;
 		
		$ko = ($ko==0) ? '' : number_format($ko,2);
		$k = ($k==0) ? '' : number_format($k,2);
		echo "<td align=\"center\">".$arr["THNKOMISI"]."</font></td>";
		echo "<td align=\"left\">".$arr["NK"]."</font></td>";
	  echo "<td align=\"right\">".$ko."</font></td>";
		echo "<td align=\"right\">".$k."</font></td>";
	  echo "</tr>";
		$i++;
		$jmlkomisi += $add;
	}
  echo "<tr class=tblisi1>";
  echo "<td colspan=\"2\" align=center class=verdana8>Jumlah Komisi</td>";
  echo "<td align=\"right\"  class=verdana8>".number_format($jmlkomisi,2)."</td>";
  echo "<td></td></tr>";
	echo "</table>";	
?>	
					 </td>		
				 </tr>
		 	</table>
		</td>
	</tr>
</table>
<input type="hidden" name="mode" value="<? echo $mode; ?>">
<input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
<input type="hidden" name="prefixpertanggungan" value="<? echo $prefixpertanggungan; ?>">
<input type="hidden" name="nopertanggungan" value="<? echo $nopert; ?>">
<input type="hidden" name="premi1" value="<?php echo $premi1; ?>">
<input type="hidden" name="premi2" value="<?php echo $premi2; ?>">
<input type="hidden" name="juamainproduk" value="<?php echo $juamainproduk; ?>">
<input type="hidden" name="premistd" value="<?php echo $premistd; ?>">
<input type="hidden" name="notertanggung" value="<? echo $notertanggung; ?>">
<input type="hidden" name="kdper" value="<? echo $kdper; ?>">

<input type="hidden" name="autodebet" value="<?=$autodebet;?>">
<input type="hidden" name="kdbank" value="<?=$kdbank;?>">
<input type="hidden" name="norekening" value="<?=$norekening;?>">

<?
  $aw='';
	for($i=1;$i<=$demit;$i++){
		$k[$i]='klienno'.$i;	$a[$i]='hubungan'.$i;	$b[$i]='nama'.$i;
		print( "<input type=\"hidden\" name=\"no".$i."\" value=\"$no".$i."\">\n" );  
		print( "<input type=\"hidden\" name=\"nama".$i."\" value=\"".$$b[$i]."\">\n" );  
		print( "<input type=\"hidden\" name=\"klienno".$i."\" value=\"".$$k[$i]."\">\n" );  
		print( "<input type=\"hidden\" name=\"hubungan".$i."\" value=\"".$$a[$i]."\">");
		$aw.="&aw".$i."=".$$k[$i];
	}	
?>
<table width="700" cellpadding="0" cellspacing="0" border="0" align="center">
<tr>
 <td align="center" colspan="2"><input type="submit" value="SUBMIT" name="submit"></td>
</tr>
</form>
<tr>
 <form action="ntryprop.php" method="post" name="ediprop"> 
 <input type="hidden" name="nottg" value="<? echo $notertanggung; ?>">
 <input type="hidden" name="nosp" value="<? echo $nosp; ?>">
 <input type="hidden" name="tglsp" value="<? echo $tglsp; ?>">
 <input type="hidden" name="gotom" value="<? echo $bpo; ?>">
 <input type="hidden" name="kdcb" value="<? echo $kdcarabayar; ?>">
 <input type="hidden" name="kdpro" value="<? echo $kdproduk; ?>">
 <input type="hidden" name="kdmed" value="<? echo $kdstatusmedical; ?>">
 <input type="hidden" name="nobp3" value="<? echo $nobp3; ?>">
 <input type="hidden" name="tgbp3" value="<? echo $tglbp3; ?>">
 <input type="hidden" name="mulas" value="<? echo $mulas; ?>">
 <input type="hidden" name="usith" value="<? echo $usia_th; ?>">
 <input type="hidden" name="usibl" value="<? echo $usia_bl; ?>">
 <input type="hidden" name="lprth" value="<? echo $lamapembpremi_th; ?>">
 <input type="hidden" name="lprbl" value="<? echo $lamapembpremi_bl; ?>">
 <input type="hidden" name="lamth" value="<? echo $lamaasuransi_th; ?>">
 <input type="hidden" name="lambl" value="<? echo $lamaasuransi_bl; ?>">
 <input type="hidden" name="expir" value="<? echo $expirasi; ?>">
 <input type="hidden" name="akhpr" value="<? echo $akhirpremi; ?>">
 <input type="hidden" name="jua" value="<? echo $juamainproduk; ?>">
 <input type="hidden" name="cabar" value="<? echo $kdcarabayar; ?>">
 <input type="hidden" name="idxaw" value="<? echo $indexawal; ?>">
 <input type="hidden" name="kdval" value="<? echo $kdvaluta; ?>">
 <input type="hidden" name="p1" value="<? echo $premi1; ?>">
 <input type="hidden" name="p2" value="<? echo $premi2; ?>">
 <input type="hidden" name="nopng" value="<? echo substr($nopenagih,1,10); ?>">
 <input type="hidden" name="noagn" value="<? echo substr($noagen,1,10); ?>">
 <input type="hidden" name="nopp" value="<? echo $pempolno; ?>">
 <input type="hidden" name="nopre" value="<? echo $pempreno; ?>">
 <input type="hidden" name="hubpp" value="<? echo $pempolhub; ?>">
 <input type="hidden" name="hubpre" value="<? echo $pemprehub; ?>">
 <input type="hidden" name="nampp" value="<? echo $pempolnama; ?>">
 <input type="hidden" name="nampre" value="<? echo $pemprenama; ?>">
 <input type="hidden" name="demit" value="<? echo $demit; ?>">
 <input type="hidden" name="maxdemit" value="<? echo $maxdemit; ?>">
 <input type="hidden" name="kdper" value="<? echo $kdper; ?>">
<?
if (!$mode=='edit'||$mode=='baru') {
?> 
 <td class="verdana8" align="left"><input name="back" type="submit" value="Back"></td>
 <?
} 
 $noproposal = (!$noproposal) ? $nopertanggungan : $noproposal;
 //echo $noproposal."|".$nopertanggungan;
 
 //khusus JSP update temp lagi
 if($kdproduk=="JSP")
 {
   $sql = "update $DBUser.tabel_200_temp set premi1='$premi1' ".
					"where  prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
   $DB->parse($sql);
	 $DB->execute();
 }


 ?>
 <td class="verdana8" align="right"><input name="print" type="button" onClick="window.open('printprop.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopert;?>&mode=<?echo $mode;?>&noproposal=<?echo $nopert;?>&p1=<?echo $premi1;?>&p2=<?echo $premi2;?>&j=<?echo $juamainproduk;?>')" value="Print"></td>
 </form>
</tr>
</table>

</div>
</body>
</html>	


