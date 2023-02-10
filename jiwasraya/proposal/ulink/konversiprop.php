<?

function tanggal($ld_bln,&$month)
{
	$substr = substr($ld_bln,3,3);
	switch ($substr) {
	case "Jan":
		$month = '1';
		break;
	case "Feb":
		$month = '2';
		break;
	case "Mar":
		$month = '3';
		break;
	case "Apr":
		$month = '4';
		break;
	case "Mei":
		$month = '5';
		break;
	case "Jun":
		$month = '6';
		break;
	case "jul":
		$month = '7';
		break;
	case "Aug":
		$month = '8';
		break;
	case "Sep":
		$month = '9';
		break;
	case "Oct":
		$month = '10';
		break;
	case "Nov":
		$month = '11';
		break;
	case "Dec":
		$month = '12';
		break;
	}

}

function CheckDocument($prefixpert,$noprop)
{

	global $userid,$passwd;

	$DB=new database($userid, $passwd, $DBName);
	$li_num = null;

	IF ($medical=='N')		//Non Medical
	{ RETURN 1; }
	
	$sql="SELECT count(*) li_num ".
		 "FROM  $DBUser.tabel_212_dok_cek_uw ".
	     "WHERE prefixpertanggungan='".$prefixpert."' AND nopertanggungan='".$noprop."' AND kdstatusunderwriting='0'";

	$DB->parse($sql);
	$DB->execute();
	$arr= $DB->nextrow();
	$li_num = $arr["LI_NUM"];
		
	IF ($li_num == null)
	{	RETURN -2; }
	ELSEIF ($li_num > 0 )
	{	RETURN -1; }

	RETURN 1;
}

function CheckPremi($prefixpert,$noprop)
{
	global $userid,$passwd;

	$DB=new database($userid, $passwd, $DBName);
	$LD_PREMI = null;

	$sql="SELECT ROUND((B.BAYAR-(B.BPOLIS + B.BMATERAI)) - DECODE(A.KDVALUTA,'0',(A.PREMI1/A.INDEXAWAL*B.KURS),'3',(A.PREMI1*B.KURS),A.PREMI1))  LD_PREMI
	FROM  	(SELECT  PREFIXPERTANGGUNGAN, NOPERTANGGUNGAN, SUM(NILAIPEMBAYARAN) BAYAR, MAX(KURS) KURS, SUM(BIAYAPOLIS) BPOLIS, SUM(BIAYAMATERAI) BMATERAI  
					FROM  $DBUser.TABEL_800_PEMBAYARAN
					WHERE KDPEMBAYARAN IN ('001','002','005','008')
					GROUP BY PREFIXPERTANGGUNGAN, NOPERTANGGUNGAN) B,
				$DBUser.TABEL_200_PERTANGGUNGAN A
	WHERE 	A.PREFIXPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN
	AND   	A.NOPERTANGGUNGAN = B.NOPERTANGGUNGAN
	AND  		A.PREFIXPERTANGGUNGAN = '$prefixpert'
	AND 		A.NOPERTANGGUNGAN  = '$noprop'";
	
	$DB->parse($sql);
	$DB->execute();
	$arr= $DB->nextrow();
	$LD_PREMI = $arr["LD_PREMI"];
	
	IF ($LD_PREMI == null) 
	{	RETURN -2; }
	ELSEIF ($LD_PREMI < 0 )
	{	RETURN -1; }

	RETURN 1;
}

function CheckAkseptasi($prefixpert,$noprop)
{
	global $userid,$passwd;

	$DB=new database($userid, $passwd, $DBName);
	$lc_akseptasi = null;

	$sql="SELECT kdacceptance lc_akseptasi
	FROM $DBUser.tabel_214_acceptance_dokumen
	WHERE prefixpertanggungan = '$prefixpert'
		AND nopertanggungan = '$noprop'";

	$DB->parse($sql);
	$DB->execute();
	$arr= $DB->nextrow();
	$lc_akseptasi = $arr["LC_AKSEPTASI"];

	//IF (SQLCA.SQLCode == 100 AND SQLCA.SQLNrows==0 )
	//{	RETURN -1; }

	IF ($lc_akseptasi == null) 
	{	RETURN -2; }
	ELSEIF ($lc_akseptasi <> '1')
	{	RETURN -1; }

	RETURN 1;
}

function checkMedical($prefixpert,$noprop,$medical,$kdbayar,$user,$mulas)
{
	$ls_msg = '';
	$ls_nopol = $prefixpert.''.$noprop;
	global $userid,$passwd;

	$DB=new database($userid, $passwd, $DBName);

	if ($medical=='M')
	{ // MEDICAL
		$ld_rateup = null;
		$lc_status = '';
		
		$sql = "SELECT tambahanusia ld_rateup, status lc_status 
		FROM $DBUser.tabel_215_rate_up
		WHERE prefixpertanggungan='$prefixpert'
		AND   nopertanggungan='$noprop'";
		
		$DB->parse($sql);
		$DB->execute();
		$arr= $DB->nextrow();

		IF (($arr['LD_RATEUP'] == null) OR $arr['LD_RATEUP'] == 0)
			{$lc_status = '2';}	//Standard decision: no rateup
		
		IF (CheckDocument($prefixpert,$noprop)==1 AND CheckPremi($prefixpert,$noprop)==1 AND CheckAkseptasi($prefixpert,$noprop)==1 AND $lc_status=='2') 
		{
			$sql = "UPDATE $DBUser.tabel_200_pertanggungan
			SET kdpertanggungan='2', tglkonversi = SYSDATE, userkonversi = '$user',nopol='$ls_nopol'
			WHERE prefixpertanggungan='$prefixpert'
			AND nopertanggungan='$noprop'";

			$DB->parse($sql);
			$DB->execute();
			
			//IF of_createjurnal(as_args) = 1 THEN //commented by bugghost 6 Okt 2010, this function is not being used anymore
				$ls_msg = 'BKJ';
			//ELSE
			//	ls_msg = 'BKJF'
			//END IF
		}
		ELSEIF (CheckDocument($prefixpert,$noprop) <> 1 AND CheckPremi($prefixpert,$noprop) == 1 AND CheckAkseptasi($prefixpert,$noprop) == 1 AND $lc_status =='2')
		{   $ls_msg = 'GKD'; }
		ELSEIF (CheckDocument($prefixpert,$noprop) == 1 AND CheckPremi($prefixpert,$noprop) <> 1 AND CheckAkseptasi($prefixpert,$noprop) == 1 AND $lc_status =='2')
		{	$ls_msg = 'GKP'; }
		ELSEIF (CheckDocument($prefixpert,$noprop) == 1 AND CheckPremi($prefixpert,$noprop) == 1 AND CheckAkseptasi($prefixpert,$noprop) <> 1 AND $lc_status =='2')
		{	$ls_msg = 'GKA'; }
		ELSEIF (CheckDocument($prefixpert,$noprop) == 1 AND CheckPremi($prefixpert,$noprop) == 1 AND CheckAkseptasi($prefixpert,$noprop) == 1 AND $lc_status <> '2')
		{	$ls_msg = 'GKR'; }
		
	}
	else
	{ // NON MEDICAL
		IF (CheckPremi($prefixpert,$noprop)==1 AND CheckAkseptasi($prefixpert,$noprop) == 1)
		{
			$sql="UPDATE $DBUser.tabel_200_pertanggungan
			SET kdpertanggungan='2', tglkonversi = SYSDATE, userkonversi = '$user',nopol='$ls_nopol'
			WHERE prefixpertanggungan='$prefixpert'
				AND nopertanggungan='$noprop'";

			$DB->parse($sql);
			$DB->execute();

		//IF of_createjurnal(as_args) = 1 THEN //commented by bugghost 6 Okt 2010, this function is not being used anymore
			$ls_msg = 'BKJ';
		//ELSE
		//	ls_msg = 'BKJF'
		//END IF
		}
		ELSEIF (CheckPremi($prefixpert,$noprop) == 1 && CheckAkseptasi($prefixpert,$noprop) <> 1)
		{	$ls_msg = 'GKA'; }
		ELSEIF (CheckPremi($prefixpert,$noprop) <> 1 && CheckAkseptasi($prefixpert,$noprop) ==1)
		{	$ls_msg ='GKP'; }
		ELSEIF (CheckPremi($prefixpert,$noprop) <> 1 && CheckAkseptasi($prefixpert,$noprop) <> 1)
		{	$ls_msg ='GKAP'; }
	}

	switch ($ls_msg)
	{
		CASE "BKJ":
			//$ls_msg1 = "Konversi Berhasil!, Create Jurnal Berhasil!";
			$ls_msg1 = "Konversi Berhasil!";
			break;
		CASE "BKJF": 
			$ls_msg1 = "Konversi Berhasil!, Create Jurnal Gagal !";
			break;
		CASE "GKD":
			$ls_msg1 = "Konversi Gagal!, Data Dokumen belum lengkap, Periksa kelengkapan Dokumen!";
			break;
		CASE "GKP":
			$ls_msg1 = "Konversi Gagal!, Premi belum semuanya dilunasi! Periksa data Premi!";
			break;
		CASE "GKA":
			$ls_msg1 = "Konversi Gagal!, Proposal Belum diakseptasi! Periksa data akseptasi!";
			break;
		CASE "GKR": 
			$ls_msg1 = "Konversi Gagal!, Proses Rate up belum lengkap! Periksa data Rate up!";
			break;
		CASE "GKAP":
			$ls_msg1 = "Konversi Gagal!, Data Akseptasi dan Premi belum lengkap! Periksa kelengkapan data !".CheckPremi($prefixpert,$noprop);
			break;
		default:
			$ls_msg1 = "ga da".CheckPremi($prefixpert,$noprop);
			break;
	}
	$mpesan = $ls_msg.'|'.$ls_msg1;
	return $mpesan;

}

FUNCTION premito($prefixpert,$noprop,$mulas2,$user) 
 {
	global $userid,$passwd;

	$DB=new database($userid, $passwd, $DBName);
	
    $ad_bln = $mulas2;

	$sql1 = "SELECT     a.kurs ld_kursidx     
	FROM      $DBUser.tabel_999_kurs_transaksi a
	WHERE     a.kdvaluta = '0'
	AND    a.tglkursberlaku = (select max(b.tglkursberlaku)
								 from  $DBUser.tabel_999_kurs_transaksi b
								   where b.kdvaluta = a.kdvaluta
								  and   b.tglkursberlaku <= sysdate)"; //kurs valuta rupiah dengan index
	$DB->parse($sql1);
	$DB->execute();
	$ars = $DB->nextrow();
	$ld_kursidx = $ars['LD_KURSIDX'];

	$sql2 = "SELECT     a.kurs ld_kursdlr      
	FROM      $DBUser.tabel_999_kurs_transaksi a
	WHERE     a.kdvaluta = '3'
	AND        a.tglkursberlaku = (select max(b.tglkursberlaku)
								 from  $DBUser.tabel_999_kurs_transaksi b
								   where b.kdvaluta = a.kdvaluta
								  and   b.tglkursberlaku <= sysdate)"; //kurs valuta dollar as
	$DB->parse($sql2);
	$DB->execute();
	$art = $DB->nextrow();
	$ld_kursdlr = $art['LD_KURSDLR'];

    $sql3 = "SELECT a.premi1 ld_premi1,a.premi2 ld_premi2,a.kdvaluta ls_valuta,a.mulas ld_mulas,
        DECODE(a.kdcarabayar,'X','X','E','X','J','X','B') ls_cb,a.kdproduk ls_produk,b.kdcabas ls_cabas,
        DECODE(a.kdcarabayar,'1',1,'M',1,'2',3,'Q',3,'3',6,'H',6,'4',12,'A',12,'E',12,'J',12,NULL) li_faktor,
        a.tglakhirpremi ld_akhir,NVL(a.gadaiotomatis,'0') lc_gpo, NVL(a.bpotomatis,'0') lc_bpo, a.tglnextbook ld_nextbook, a.indexawal ld_indexa, a.tglkonversi ld_tglkonversi
    FROM $DBUser.tabel_200_pertanggungan a,
        $DBUser.tabel_202_produk b
    WHERE   a.kdproduk=b.kdproduk
        AND a.prefixpertanggungan='$prefixpert' AND a.nopertanggungan='$noprop'";

	$DB->parse($sql3);
	$DB->execute();
	$arr= $DB->nextrow();

	$ls_cabas = $arr['LS_CABAS'];
	$ls_valuta = $arr['LS_VALUTA'];
	$ls_cb = $arr['LS_CB'];
	$ls_produk = $arr['LS_PRODUK'];
	$li_faktor = $arr['LI_FAKTOR'];
	$ld_premi1 = $arr['LD_PREMI1'];
	$ld_mulas = $arr['LD_MULAS'];
	$ld_indexa = $arr['LD_INDEXA'];
	$ld_tglkonversi = $arr['LD_TGLKONVERSI'];
	$ld_akhir = $arr['LD_AKHIR'];

	IF ($li_faktor <> 1)
	 {
        RETURN -1;    
	 }

	$ld_bln = date('d-M-Y', mktime(0, 0, 0, date(substr($ld_mulas,3,2))+$li_faktor, date("1"), date(substr($ld_mulas,6,4))));
    IF ($ld_bln == NULL)
	 {
        RETURN -1;
	 }
        
    $sql4 = "SELECT rekening1 ls_kdrek1,rekening2 ls_kdrek2 
    FROM $DBUser.tabel_803_kode_rekening
    WHERE kdcabas='$ls_cabas' AND kdvaluta='$ls_valuta' AND kdcarabayar='$ls_cb'
    AND jnspembayaran='NB'||DECODE(SUBSTR('$ls_produk',1,3), 
    'JL3',SUBSTR('$ls_produk',-2),
    'JL2',SUBSTR('$ls_produk',-2), '')"; 
    /* Modified At Feb 23rd, 2009 to handle JL2% specila account */

	$DB->parse($sql4);
	$DB->execute();
	$arb = $DB->nextrow();
	$ls_kdrek1 = $arb['LS_KDREK1'];
	$ls_kdrek2 = $arb['LS_KDREK2'];

	IF ($arb['LS_KDREK1'] == NULL)
	{
		$ls_kdrek1 = NULL;
		$ls_kdrek2 = NULL;
	}
    
    IF ($ls_valuta == '0')
	 { $ld_premirp = ($ld_premi1/$ld_indexa) * $ld_kursidx ; }
    ELSEIF ($ls_valuta =='3')
	 { $ld_premirp = $ld_premi1 * $ld_kursdlr ; }
    ELSE
	 { $ld_premirp = $ld_premi1 ; }
	
	tanggal($ld_bln,$month);
	$ld_bln = date('d-m-Y', mktime(0, 0, 0, date($month), date("1"), date(substr($ld_bln,7,4))));
	$tgl_konversi = date('d-m-Y', mktime(0, 0, 0, date(substr($ld_tglkonversi,3,2))+$li_faktor, date("1"), date(substr($ld_tglkonversi,6,4))));

	while (strtotime($ld_bln) <= strtotime($tgl_konversi)) //--------EXIT WHEN ld_bln > ADD_MONTHS(TRUNC($arr['ld_tglkonversi'],'MONTH'),li_faktor);
	{
	$sql5 = "INSERT INTO $DBUser.tabel_300_historis_premi (prefixpertanggungan,nopertanggungan,tglbooked,
		tglseatled,kdrekeningpremi,kdkuitansi,kdvaluta,kdrekeninglawan,premitagihan,tglrekam,
		userrekam,tglupdated,userupdated,nilairp,buktisetor,status,tglstatus,lunas,tgllunas,transfer,tgltransfer,billstatus,tglcetak)
	VALUES ('$prefixpert','$noprop',TO_DATE('$ld_bln','DD-MM-YYYY'),null,'$ls_kdrek1','NB1','$ls_valuta','$ls_kdrek2','$ld_premi1',sysdate,
		'$user',sysdate,'$user','$ld_premirp',NULL,'0',NULL,'0',NULL,'0',NULL,'1',null)";

	$DB->parse($sql5);
	$DB->execute();
	
	$ld_bln2 = date('d-m-Y', mktime(0, 0, 0, date(substr($ld_bln,3,2))+$li_faktor, date("1"), date(substr($ld_bln,6,4))));
	IF (strtotime($ld_bln2) == strtotime($ld_akhir))
		{
		$sql6 = "UPDATE $DBUser.tabel_200_pertanggungan
		SET kdstatusfile='3',userupdated='$user',tglupdated=sysdate
		WHERE prefixpertanggungan='$prefixpert'
			AND nopertanggungan='$noprop'";

		$DB->parse($sql6);
		$DB->execute();

		}
	ELSEIF (strtotime($ld_bln2) < strtotime($ld_akhir))
		{
		$sql6 = "UPDATE $DBUser.tabel_200_pertanggungan
		SET tglnextbook='$ld_bln2',userupdated='$user',tglupdated=sysdate
		WHERE prefixpertanggungan='$prefixpert'
			AND nopertanggungan='$noprop'";

		$DB->parse($sql6);
		$DB->execute();

		}

    $ld_bln = date('d-m-Y', mktime(0, 0, 0, date(substr($ld_bln,3,2))+$li_faktor, date("1"), date(substr($ld_bln,6,4)))); 
	}

    RETURN 0;
 }


function BillingSusulan($prefixpert,$noprop,$medical,$kdcarabayar,$user,$mulas,$ls_msg,$kode)
{
	global $userid,$passwd;

	$DB=new Database("JSADM","JSDB","JSDB");
	$conect = ocilogon("JSADM","JSDB","JSDB");

	$mulas2 = substr($mulas,3,2).substr($mulas,6,4);
	
	IF (substr($ls_msg,0,2)=='BK' AND ($kdcarabayar=='1' OR $kdcarabayar=='M'))
	{
		if ($kode==1)
		{
			return 'Akan Dilanjutkan dengan Proses Billing Susulan';
		}

		$ls_jml = '';
		$li_rtn = 0;
		
		//$prefixpert = strtoupper($prefixpert);
		//$user = strtoupper($user);
		//$noprop = $noprop;

		//$sql = "begin $DBUser.BILLINGX.PREMITO('".$prefixpert."', '".$noprop."', '".$mulas2."', '".$user."'); end;";
		//$query=ociparse($conect,$sql);
		//ociexecute($query);

		premito($prefixpert,$noprop,$mulas2,$user);

		//$conn = oci_connect("JSADM","JSDB","JSDB");

		/*$query="DECLARE".
			   "RESULT NUMBER(1);".
			   "BEGIN".
			   ":RESULT := $DBUser.BILLINGX.PREMITO(:prefix, :noprop, :mulas, :userid);".
			   "END;";*/

		//$query="SELECT $DBUser.BILLINGX.PREMITO('$prefixpert', '$noprop', '$mulas2', '$user') TEST FROM DUAL ";		
		//select $DBUser.polis.gettebus2('$prefix','$nopertanggungan') tebus from dual
		//$curs = ocinewcursor($conn);
		//$DB->parse($query);
		//$DB->execute();
		//$res=$DB->nextrow();
		
		//oci_bind_by_name($stid, ":RESULT",  &$curs, -1, OCI_B_CURSOR);
		/*oci_bind_by_name($stid, ":prefix",  &$prefixpert, -1);
		oci_bind_by_name($stid, ":noprop",  &$noprop, -1);
		oci_bind_by_name($stid, ":mulas",   &$mulas2, -1);
		oci_bind_by_name($stid, ":userid",  &$user, -1);	*/
		
		//oci_execute($stid);
		//ociexecute($curs);
		//$DB->execute($stid,$query);
		//$arr= $DB->nextrow();
		
		//while(ocifetch($stid))
		//{$ls_result=ociresult($stid,"NMKANTOR");}
		//return "Proses Biling Susulan Tidak Berhasil" ;

		/*IF ($arr['ls_result'] == '0')
		{	return "Proses Biling Susulan Berhasil !"; }
		else
		{	return "Proses Biling Susulan Tidak Berhasil !"; }*/

		
		/*str_compressed	lstr_result
		string	ls_jml
		integer  li_rtn

		DECLARE sp_billing PROCEDURE FOR
			$DBUser.billingx.premito($prefixpertanggungan,$noproposal,$mulas,$userid)
			USING	itr_trans;
			
		EXECUTE sp_billing;
		FETCH sp_billing INTO :li_rtn;
		CLOSE sp_billing;

		ls_jml = string(li_rtn);

		inv_zip.of_zip(ls_jml,lstr_result)

		RETURN lstr_result ;



		ls_args[1] = "BILLINGSUSULAN"
		ls_args[2] = dw_1.object.prefixpertanggungan[ll_row]
		ls_args[3] = dw_1.object.nopertanggungan[ll_row]
		ls_args[4] = String(dw_1.object.mulas[ll_row],'MMYYYY')
		ls_args[5] = gstr_user.userid
		
		ls_result = uo_navi.inv_bridge.of_Process(ls_args)
		IF ls_result = '0' THEN
			MessageBox("Konversi","Proses Biling Susulan Berhasil !")
		END IF*/
	}
}

?>