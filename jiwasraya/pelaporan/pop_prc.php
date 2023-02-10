<? 
  //include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";
	include "../../includes/pertanggungan.php";
	 $DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
	 $DBB = new Database($suid_GLLINK08,$spass_GLLINK08,$sdb_GLLINK08);
	
?>

<html>
<head>
<title>Detail Polis Pertanggungan Perorangan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<div align="center">
DETAIL TRANSAKSI

	<?
	$i=1;
  $DB = new Database($userid, $passwd, $DBName);

// Kondisi Kantor
	if ($_GET["wherektr"]==''){
		 $wherektr="";
	}
	else if (substr($_GET["wherektr"],1,1)=='Z'){
		 $wherektr="prefixpertanggungan like '".substr($wherektr,0,1)."%' and ";	
	}
	else{
		 $wherektr="prefixpertanggungan='".$wherektr."' and ";	
	}

// Kondisi Valuta
	if ($_GET["wherevaluta"]==''){
		 $wherevaluta="";	
	}
	else{
		 $wherevaluta="kdvaluta=".$wherevaluta." and ";		
	}

// Kondisi Produk
	if ($_GET["whereproduk"]==''){
		 $whereproduk="";
	}
	else{
		 $whereproduk="kdproduk like '".$whereproduk."%' and ";	
	}
	
// Kondisi Kode Pertanggungan
	if ($_GET["wherepertanggungan"]==''){
		 $wherepertanggungan="kdpertanggungan='2' and ";
	}
	else{
		 $wherepertanggungan="";
	}

// Kondisi Field Tanggal yang akan dibuatkan perbandingan
	if ($_GET["fieldtgl"]==''){
		 $fieldtgl="mulas";
	}
			
  // Periode Tgl Dari s/d Tgl Sampai
  /*$sqa = "select * ".
         "from $DBUser.tabel_200_pertanggungan ".
  			 "where ".$wherektr.$wherevaluta.$whereproduk.$wherepertanggungan.
  			 "to_char(".$fieldtgl.",'YYYYMMDD')>='".$_GET["tglDariCari"]."' and to_char(".$fieldtgl.",'YYYYMMDD')<='".$_GET["tglSampaiCari"]."'";*/
	if ($posted=='all') {
				$whereposted="";
			}
			else if ($posted=='Y') {
				$whereposted="posted='Y' and ";
				//$post="Y";
			}
			else if ($posted=='N') {
				$whereposted="posted='N' and ";
				//$post="N";
			}
			
	if ($_GET['ktr']==''){
			 		$wherektr="";
			 		$wherektr1="";
					$kdktr="";
					
					$namakantor="SELURUH KANTOR PT ASURANSI JIWA IFG";
			 }
	elseif (substr($ktr,1,1)!='Z'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".$ktr."' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();					 
    		  while ($arr=$DB->nextrow()) {
								$namakantor=$arr["NAMAKANTOR"];
    			}					
			 		$wherektr="prefixpertanggungan='".$ktr."' and ";
			 		$wherektr1="kdkantor='".$ktr."' and ";
					$kdktr=$ktr;
  		 }
	elseif (substr($_GET['ktr'],1,1)=='Z'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".substr($ktr,0,1)."A' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();	
			$wherektr1="kdkantor like '".substr($_GET['ktr'],0,1)."%' and ";				 
    		      			}
	
	//echo $wherektr1;
	//echo $whereposted;
if($thn<=2008){
	if ($nourut=='C.1.') {
		$kdrekening="('305112','305122','305135','305313','305314','308002','315602','305212','305222','305312','305322','305412','305422','305512','305522','305612','305622','305712','305722','305812','305822','308101','308102','308103','308201','308202','308203','308301','308302','308303','308401','308402','308403','308501','308502','308503','308601','308602','308603','308701','308702','308703','308801','308802','308803','315102','315202','315302','315402','315502','315602','315702','315802','703112','703122','703212','703222','703312','703322','703412','703422','703512','703522','703612','703622','703712','703722','703812','703822','707102','707202','707302','707402','707502','707602','707702','707802','930004','308001','308305','305502','315502','305814')";
	}	
	elseif ($nourut=='C.2.1.') {
		$kdrekening="('307112','307113','307122','307212','307213','307222','307312','307313','307322','307412','307413','307422','307512','307513','307522','307523','307612','307613','307622','307712','307713','307722','307812','307813','307822','317102','317103','317202','317203','317302','317303','317402','317403','317502','317503','317602','317603','317702','317703','317802','317803','307642','307632','930004')";
	}
	elseif ($nourut=='C.2.2') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.4.1') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.4.2') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.4.3') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.4.4') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.5.1.') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.5.2.') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='C.6') {
		$kdrekening="('0')";
	}
	elseif ($nourut=='D.1.') {
    $kdrekening="('334115','334116','334215','334216','334315','334316','334415','334416','334515','334516','334615','334616','334715','334716','334815','334816','334105','334106','334205','334206','334305','334306','334405','334406','334505','334506','334605','334606','334705','334706','334805','334806','330123','330223','330323','330423','330523','330623','330723','330823','331103','331203','331303','331403','331503','331603','331703','331803','336114','336115','336214','336215','336314','336315','336414','336415','336514','336515','336614','336615','336714','336715','336814','336815','336104','336105','336204','336205','336304','336305','336404','336405','336504','336505','336604','336605','336704','336704','336804','336805','333113','333213','333313','333413','333513','333613','333713','333813','333103','333203','333303','333403','333503','333603','333703','333803','930006')";
	}
	elseif ($nourut=='E.1.') {
       $kdrekening="('305111','305121','305211','305221','305311','305321','305411','305421','305511','305521','305611','305621','305711','305721','305811','305821','315101','315201','315301','315401','315501','315601','315701','315801','702100','702200','702300','702400','702500','702600','702700','702800','703111','703121','703211','703221','703311','703321','703411','703421','703511','703521','703611','703621','703711','703721','703811','703821','706100','706200','706300','706400','706500','706600','706700','706800','707101','707201','707301','707401','707501','707601','707701','707801','930003')";
	}
	elseif ($nourut=='E.2.') {
       $kdrekening="('930005','330031','330111','330121','330211','330221','330311','330321','330411','330421','330511','330521','330611','330621','330711','330721','330811','330821','331001','331101','331201','331301','331401','331501','331601','331701','331801','338001','338101','338201','338301','338401','338501','338601','338701','338801','339001','339101','339201','339301','339401','339501','339601','339701','339801','716100','716200','716300','716400','716500','716600','716700','716800','717101','717111','717121','717201','717211','717221','717301','717311','717321','717401','717411','717421','717501','717511','717521','717601','717611','717621','717701','717711','717721','717801','717811','717821','332011','332013','332211','332213','722211','722213','333011','333111','333211','333411','333511','725111','725211','725511','337011','732000')";
	}
	elseif ($nourut=='A.') {
      $kdrekening="('509000','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','525001','525002','526000','527000','528000','529000','528001','508000','508001','519000','540000','541000','543000','544000','545000','549000','500000','500001','500002','500003','500004','500005','500006','500007','500008','500009','500010','500011','500020','500021','501000','501001','501002','501003','501004','501005','501006','500100','500101','500131','500200','500111','500121','500211','500300','502000','502001','502002','503000','503001','503002','504000','505000','507000','507001','507002')";
//      $kdrekening="('500000','500001','500002','500003','500004','500005','500006','500007','500008','500010','500011','500020','500021','500100','500101','500102','500103','500111','500121','500131','500200','500201','500202','500203','500211','500212','500300','501000','501001','501002','501003','501004','501005','502000','502001','503000','503001','503002','504000','505000','507000','508000','508001','509000','509001','509003','509004','510000','511000','512000','512001','513000','514000','515000','516000','517000','518000','519000','520000','525000','526000','527000','528000','529000','540000','541000','542000','544000','545000','549000','543000','502002','525001','500015','500009','507002','525002')";
	}
		
	//echo $_GET["nourut"].'</br>';
	//echo $nourut;
	//echo $kdrekening;		 
			 
	if ($nourut=='C.3.'||$nourut=='C.5.'/*||$nourut=='C.6.'*/||$nourut=='C.7.'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('M') and a.akun=b.akun and a.kdtrans>='".$tglAwalCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	elseif ($nourut=='C.6.'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K','L','M') and a.akun=b.akun and a.kdtrans>='".$tglAwalCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	elseif ($nourut=='C.5.2.'||$nourut=='C.4.1'||$nourut=='C.4.2'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K','L') and a.akun=b.akun and a.kdtrans>='".$tglAwalCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	elseif ($nourut=='A.'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K') and a.akun=b.akun and a.kdtrans>='".$tglAwalCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	else {
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K','L') and a.akun=b.akun and a.kdtrans>='".$tglAwalCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
  //echo $sqa;
  $DBB->parse($sqa);
  $DBB->execute();
}
else{	
	if ($nourut=='C.1.') {
		$kdrekening=
			"('311211500',".
			"'123121300',".
			"'123112100',".
			"'123112200',".
			"'123112300',".
			"'123112400',".
			"'123112500',".
			"'123112600',".
			"'123112700',".
			"'123112800',".
			"'123112900',".
			"'123122300',".
			"'123122400',".
			"'123122500',".
			"'123122600',".
			"'123122700',".
			"'123122800',".
			"'123122900',".
			"'123123000',".
			"'123121400',".
			"'123121500',".
			"'123120100',".
			"'123120200',".
			"'123121600',".
			"'123120300',".
			"'123121700',".
			"'123120600',".
			"'123121800',".
			"'123120700',".
			"'123121900',".
			"'123120800',".
			"'123122000',".
			"'123121100',".
			"'123122100',".
			"'123121200',".
			"'123122200',".
			"'123110100',".
			"'123111200',".
			"'123110200',".
			"'123111300',".
			"'123110300',".
			"'123111400',".
			"'123110400',".
			"'123111500',".
			"'123110700',".
			"'123111600',".
			"'123110800',".
			"'123111700',".
			"'123110900',".
			"'123111800',".
			"'123111000',".
			"'123111900',".
			"'123111100',".
			"'123112000',".
			"'123120500',".
			"'123110600',".
			"'123110500',".
			"'311211400',".
			"'123120400',".
			"'710600000')";
	}	
	elseif ($nourut=='C.2.1.') {
			$kdrekening=
			/*"(select akun from $DBUser.TABEL_802_ARUSKAS_DETAIL ".
			"where lv_neraca='1' and lv_subneraca='1' ".
			"and lv_keterangan='3' and lv_subketerangan='1' and akun not in ('123120000',". //savinplan skg 
			"'123410200','123410400','123410600','123410100','123410300','123410500','123131700')". //ulink skg
			"union ".
			"select akun from $DBUser.TABEL_802_ARUSKAS_DETAIL ".
			"where lv_neraca='1' and lv_subneraca='1' ".
			"and lv_keterangan='3' and lv_subketerangan='2'  and akun not in ('123120000',". //savinplan skg 
			"'123410200','123410400','123410600','123410100','123410300','123410500','123131700'))"; //ulink skg*/
			"('123113100',".
			"'123130100',".
			"'123130200',".
			"'123130300',".
			"'123130400',".
			"'123130500',".
			"'123130600',".
			"'123130700',".
			"'123130800',".
			"'123130900',".
			"'123131000',".
			"'123131100',".
			"'123131200',".
			"'123131300',".
			"'123131400',".
			"'123131500',".
			"'123131600',".
			//"'123131700',". PINDAH KE C.5.1
			"'123131800',".
			"'123131900',".
			"'123132000',".
			"'123132100',".
			"'123132200',".
			"'123132300',".
			"'123132400',".
			"'123132500',".
			"'123132600',".
			"'123132700',".
			"'123132800',".
			"'123132900',".
			"'123133000',".
			"'123133100',".
			"'123133200',".
			"'123133300',".
			"'123133400',".
			"'123133500',".
			"'123133600',".
			"'123133700',".
			"'123133800',".
			"'123133900',".
			"'123134000',".
			"'123134100',".
			"'123134200',".
			"'123134300',".
			"'123134400',".
			"'123134500',".
			"'123134600',".
			"'123134700',".
			"'123134800',".
			"'123134900',".
			"'123332700',".
			"'123332800',".
			"'123332900',".
			"'123131304',". //extra income
			//"'123131701',". //optima 7
			"'241140000','241150000','241160000','241180000',". //titipan premi
			"'123333000')";
	}
	elseif ($nourut=='C.2.2') {
			$kdrekening="('148170000')"; //tambahan rekening R/K
	}
	elseif ($nourut=='C.4.1') {
			//$kdrekening="('123410200','123410400','123410600')";
			//$kdrekening="('331200000','331300000','331400000','334100000')";
			$kdrekening="('123114100',
						'123114200',
						'123114300',
						'123410200',
						'123410400',
						'123410600',
						'123410700',
						'123410800',
						'123410811',
						'123410812',
						'241172000',
						'123410813')";
	}
	elseif ($nourut=='C.4.2') {
			//$kdrekening="('123410100','123410300','123410500')"; 
			//$kdrekening="('331100000','332100000','332200000','332300000')";
			$kdrekening="('123410100',
						'123410300',
						'123410500',
						'123410821',
						'123410822',
						'123410823')";
	}
	elseif ($nourut=='C.4.3') {
			$kdrekening="('148340000','148440000','148390000')"; //tambahan rekening R/K
	}
	elseif ($nourut=='C.4.4') {
			$kdrekening="('148290000','148310000','148320000','148330000','148350000','148400000')"; //tambahan rekening R/K
	}
	elseif ($nourut=='C.5.1.') {
			$kdrekening="('123120000','123131700','123120900','123121000','123131701','241170000','241171000')"; //optima
	}
	elseif ($nourut=='C.5.3.') {
			$kdrekening="('123120900','123121000')";
	}
	elseif ($nourut=='C.5.2.') {
			$kdrekening="('123121001','123121002','123121003','123121004')";
	}
	elseif ($nourut=='C.6') {
			$kdrekening="('148090000','148120000','148480000')"; //tambahan rekening R/K Auto debet
	}
	elseif ($nourut=='D.1.') {
  		$kdrekening=
		/*"('123330100',".
		"'123330200',".
		"'123330300',".
		"'123330400',".
		"'123330500',".
		"'123330600',".
		"'123330700',".
		"'123330800',".
		"'123330900',".
		"'123331000',".
		"'123331100',".
		"'123331200',".
		"'123331300',".
		"'123331400',".
		"'123331500',".
		"'123331600',".
		"'123331700',".
		"'123331800',".
		"'123331900',".
		"'123332000',".
		"'123332100',".
		"'123332200',".
		"'123332300',".
		"'123332400',".
		"'123332500',".
		"'123332600',".
		"'123333100',".
		"'123333200',".
		"'123333300',".
		"'123333400',".
		"'123333500',".
		"'123333600',".
		"'123333700',".
		"'123333800',".
		"'123333900',".
		"'123334000',".
		"'123334100',".
		"'123334200',".
		"'123334300',".
		"'123334400',".
		"'123334500',".
		"'123334600',".
		"'123230100',".
		"'123230200',".
		"'123230300',".
		"'123230400',".
		"'123230500',".
		"'123230600',".
		"'123230700',".
		"'123230800',".
		"'123230900',".
		"'123231000',".
		"'123231100',".
		"'123231200',".
		"'123231300',".
		"'123231400',".
		"'123231500',".
		"'123231600',".
		"'123231700',".
		"'123231800',".
		"'123231900',".
		"'123232000',".
		"'123232100',".
		"'123232200',".
		"'123232300',".
		"'123232400',".
		"'123232500',".
		"'123232600',".
		"'123232700',".
		"'123232800',".
		"'123232900',".
		"'123233000',".
		"'123233100',".
		"'123233200',".
		"'123233300',".
		"'123233400',".
		"'123233500',".
		"'123233600',".
		"'123233700',".
		"'123233800',".
		"'123233900',".
		"'123242000',".
		"'123242100',".
		"'123134900',".
		"'123234000',".
		"'123234100',".
		"'123234200',".
		"'123234300',".
		"'123234400',".
		"'123234500',".
		"'123234600',".
		"'123234700',".
		"'123234800',".
		"'123234900',".
		"'123235000',".
		"'123235100',".
		"'123235200',".
		"'123235300',".
		"'123235400',".
		"'123235500',".
		"'123235600',".
		"'123235700',".
		"'123235800',".
		"'123235900',".
		"'123236000',".
		"'123236100',".
		"'123236200',".
		"'123236300',".
		"'123236400',".
		"'123236500',".
		"'123236600',".
		"'123236700',".
		"'123236800',".
		"'123236900',".
		"'123237000',".
		"'123237100',".
		"'123237200',".
		"'123237300',".
		"'123237400',".
		"'123237500',".
		"'123320100',".
		"'123320200',".
		"'123320300',".
		"'123320400',".
		"'123320500',".
		"'123320600',".
		"'123320700',".
		"'123320800',".
		"'123320900',".
		"'123321000',".
		"'123321100',".
		"'123321200',".
		"'123321300',".
		"'123321400',".
		"'123321500',".
		"'123321600',".
		"'123321700',".
		"'123321800',".
		"'123321900',".
		"'123322000',".
		"'123322100',".
		"'123224800',".
		"'123224900',".
		"'123225000',".
		"'123225100',".
		"'123225200',".
		"'123225300',".
		"'123225400',".
		"'123225500',".
		"'123225600',".
		//"'321131800',". sel kurs PKNB dobel sama dg 710800000
		"'710800000',".
		"'123220100',".
		"'123220200',".
		"'123220300',".
		"'123220400',".
		"'123220500',".
		"'123220600',".
		"'123220700',".
		"'123220800',".
		"'123220900',".
		"'123221000',".
		"'123221100',".
		"'123221200',".
		"'123221300',".
		"'123221400',".
		"'123221500',".
		"'123221600',".
		"'123221700',".
		"'123221800',".
		"'123221900',".
		"'123222000',".
		"'123222100',".
		"'123222200',".
		"'123222300',".
		"'123222400',".
		"'123222500',".
		"'123222600',".
		"'123222700',".
		"'123222800',".
		"'123222900',".
		"'123223000',".
		"'123223100',".
		"'123223200',".
		"'123223300',".
		"'123223400',".
		"'123223500',".
		"'123223600',".
		"'123223700',".
		"'123223800',".
		"'123223900',".
		"'123224000',".
		"'123224100',".
		"'123224200',".
		"'123224300',".
		"'123224400',".
		"'123224500',".
		"'123224600',".
		"'123224700',".
		"'123225700',".
		"'123225800',".
		"'123225900',".
		"'123226000',".
		"'123226100',".
		"'123226200',".
		"'123226300',".
		"'123226400',".
		"'123226500')"*/
		"(select AKUN from TABEL_802_ARUSKAS_DETAIL ".
		"where lv_neraca='1' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='3' ".
		"union ".
		"select akun from TABEL_802_ARUSKAS_DETAIL ".
		"where lv_neraca='1' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='4' ".
		"union ".
		"select akun from TABEL_802_ARUSKAS_DETAIL ".
		"where lv_neraca='1' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='5' ".
		"union ".
		"select akun from TABEL_802_ARUSKAS_DETAIL ".
		"where lv_neraca='1' and lv_subneraca='1' and lv_keterangan='3' and lv_subketerangan='3' ".
		"UNION ".
		"select akun from TABEL_802_ARUSKAS_DETAIL ".
		"where lv_neraca='1' and lv_subneraca='1' and lv_keterangan='3' and lv_subketerangan='4' ".
		"UNION ".
		"select akun from TABEL_802_ARUSKAS_DETAIL ".
		"where lv_neraca='1' and lv_subneraca='1' and lv_keterangan='3' and lv_subketerangan='5' ".
		"UNION ".
		"select akun from TABEL_802_ARUSKAS_DETAIL  where akun in ('123237800','123238200','123242110'))";
	}
	elseif ($nourut=='E.1.') {
			 $kdrekening=
			 "('123140100',".
			"'123140200',".
			"'123140300',".
			"'123140400',".
			"'123140500',".
			"'123140600',".
			"'123140700',".
			"'123140800',".
			"'123140900',".
			"'123141000',".
			"'123141100',".
			"'123141200',".
			"'123141300',".
			"'123141400',".
			"'123141500',".
			"'123141600',".
			"'123141700',".
			"'123141800',".
			"'123141900',".
			"'123142000',".
			"'123142100',".
			"'123142200',".
			"'123142300',".
			"'123142400',".
			"'123142500',".
			"'123142600',".
			"'123142700',".
			"'312109000',".
			"'312309000',".
			"'314103000',".
			"'314105000',".
			"'314110000',".
			"'241110000','241120000','241130000',". //titipan premi
			//"'148120000',".//auto debet CITIBANK
			"'710500000')";
	}
	elseif ($nourut=='E.2.') {
			 $kdrekening=
			     //'118210000',". dihapus cad amortisasi
			"('123240100',".
			"'123240200',".
			"'123240300',".
			"'123240400',".
			"'123240500',".
			"'123240600',".
			"'123240700',".
			"'123240800',".
			"'123240900',".
			"'123241000',".
			"'123241100',".
			"'123241200',".
			"'123241300',".
			"'123241400',".
			"'123241500',".
			"'123241600',".
			"'123241700',".
			"'123241800',".
			"'123241900',".
			"'123242300',".
			"'123242400',".
			"'123242500',".
			"'123242600',".
			"'123242700',".
			"'123242800',".
			"'123242900',".
			"'123243000',".
			"'123243100',".
			"'123243200',".
			"'123243300',".
			"'123243400',".
			"'123243500',".
			"'123243600',".
			"'123243700',".
			"'123243800',".
			"'123243900',".
			"'123244000',".
			"'123244100',".
			"'123244200',".
			"'123244300',".
			"'123244400',".
			"'123244500',".
			"'123244600',".
			"'123244700',".
			"'123244800',".
			"'123244900',".
			"'123245000',".
			"'123245100',".
			"'123245200',".
			"'123245300',".
			"'123245400',".
			"'123245500',".
			"'123245600',".
			"'123245700',".
			"'123245800',".
			"'123245900',".
			"'123340100',".
			"'123340200',".
			"'123340300',".
			"'123340400',".
			"'123340500',".
			"'123340600',".
			"'241210000','241220000','241230000',". //titipan premi
			//"'324130900',". sel kurs PKOB dobel dengan 710700000
			"'710700000')";
	} 
	elseif ($nourut=='A.') {
		  $kdrekening=
		  /*"(select AKUN from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='1' ".
			"union ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='2' ".
			"union ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='3' ".
			"union ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='4' ".
			"UNION ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='5' ".
			"UNION ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='6' ".
			"UNION ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='7' ".
			"UNION ".
			"select akun from TABEL_802_RUGILABA_DETAIL ".
			"where lv_neraca='3' and lv_subneraca='1' and lv_keterangan='1' and lv_subketerangan='8')";*/
			"('511110000','511120000','511130000','511140000','511150000','511160000','511161000','512010000',
			'512020000','512030000','512040000','512050000','512060000','512070000','512080000','512101000',
			'512102000','512103000','512104000','512105000','512106000','512107000','512108000','512109000',
			'512109100','512110000','512111000','512112000','512113000','512114000','512115000','512116000',
			'512117000','512118000','512119000','512120000','512121000','512122000','512123000','512123100',
			'512123200','512123300','512123400','512123500','512123600','512123700','512124000','512201000',
			'512202000','512203000','512204000','512205000','512206000','512207000','512207100','512208000',
			'512209000','513010000','513011000','513020000','513030000','513040000','513050000','513060000',
			'513070000','513080000','513090000','513090000','513100000','513100000','513110000','513120000',
			'513130000','513140000','513150000','513151000','513160000','513161000','520100000','520200000',
			'520300000','520400000','520500000','520600000','520700000','520800000','520900000','521000000',
			'521100000','521200000','521300000','521400000','521500000','521600000','521700000','521800000',
			'521810000','530200000','530300000','530400000','530500000','530600000','530700000','530800000',
			'530900000','531000000','541000000','542000000','543000000','544000000','545000000','546000000',
			'551000000','561000000','562000000','563000000','563100000','563110000','563120000','563130000',
			'564000000','565000000','512111001','512111002','511140004')";
	}
	elseif ($nourut=='X.1') {
			$kdrekening="('148261000',
			'148290000',
			'148310000',
			'148330000',
			'148340000',
			'148341000',
			'148351000',
			'148390000',
			'148391000',
			'148410000',
			'148440000',
			'148441000')"; //tambahan rekening R/K
	}
	elseif ($nourut=='X.2') {
			$kdrekening="('148260000', '148291000', '148311000', '148331000', '148350000', '148400000')"; //tambahan rekening R/K
	}
	//echo $_GET["nourut"].'</br>';
	//echo $nourut;
	//echo $kdrekening;		 
			 
	if ($nourut=='C.3.'||$nourut=='C.5.'/*||$nourut=='C.6.'*/||$nourut=='C.7.'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('M') and a.akun=b.akun and a.kdtrans>='".$tglDariCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	elseif ($nourut=='C.6.'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K','L','M') and a.akun=b.akun and a.kdtrans>='".$tglDariCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	elseif ($nourut=='C.5.2.'||$nourut=='C.4.1'||$nourut=='C.4.2'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K','L') and a.akun=b.akun and a.kdtrans>='".$tglDariCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	elseif ($nourut=='A.'){
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K') and a.akun=b.akun and a.kdtrans>='".$tglDariCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
	else {
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(a.kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$wherektr1."substr(a.notrans,0,1) in ('B','K','L') and a.akun=b.akun and a.kdtrans>='".$tglDariCari."' and a.kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
	}
					 
  //echo $sqa;
  $DBA->parse($sqa);
  $DBA->execute();
}  
  $polisvrdi1=0;
  $polisvrti1=0;
  $polisva1=0;
  $juavrdi1=0;
  $juavrti1=0;
  $juava1=0;
  $premivrdi1=0;
  $premivrti1=0;
  $premiva1=0;
  
  //echo 'ktr='.$_GET['ktr'];
?>
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					  <tr class='arial10' >
					  <td align="center" >No.</td>
					  <td align="center" >Kantor</td>
					  <td align="center" >Akun</td>
						<td align="center" >Keterangan</td>
						<td align="center">Debet</td>
						<td align="center" >Kredit</td>
						<td align="center" >Tanggal</td>
						<td align="center" >No. Trans</td>
						<td align="center" >Keterangan</td>
					 </tr>
<? 
if($thn<=2008){ 
  $dbase=$DBB;} 
  else {  	
  $dbase=$DBA;
}
//echo "while($arr=$DBA->nextrow()){";
while($arr=$dbase->nextrow()){
echo "<tr class='arial10' bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDKANTOR"];?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["AKUN"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMA"];?></td>
	<td align="right" style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["DEBET"],2,',','.');?></td>
	<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["KREDIT"],2,',','.');?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDTRANS"];?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOTRANS"];?></td>
	<td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KET"];?></td>
	
<? echo "</tr>";
		$i++;
		$tdebet += $arr["DEBET"];
		$tkredit += $arr["KREDIT"];
  }
?>
	<tr class="arial10"><td colspan="4"></td><td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($tdebet,2,',','.');?></td><td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($tkredit,2,',','.');?></td></tr>				 
	</table>
		 
<!--
<table width="100%">
	<tr>
    <td width="50%" class="arial10" align="left"><a href="#" onclick="window.print()">Print</a></td>
		<td width="50%" class="arial10" align="right"><a href="#" onclick="window.close()">Close</a></td>
	</tr>
</table>
-->

</div>
<br>
<? 
	 echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; 
?>
</body>
</html>
