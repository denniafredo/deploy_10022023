<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');

include('../conndb.php');
include('class/oci.helper.php');

$db = new OracleConnection($oracle_config);

$API_INTERNAL = "http://localhost/api/";
$result = FALSE;

if(isset($_GET['idagen']) && $_GET['idagen'] != ""){
	$token = "";
	if(isset($_GET['token'])  && $_GET['token'] != "" ){
		$token = $_GET['token'];
	}
	
	$idagen = $_GET['idagen'];
	
	$con = oci_connect('JAIM', 'ifg#dbs#jaim#2020', $conn);
	if (!$con) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}

	$stid = oci_parse($con, "SELECT * FROM JAIM_900_USER where USERNAME='$idagen' 
		and MOBILETOKEN = upper('$token')  ");
	oci_execute($stid);

	$dt = null;
	$dtver = null;
	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
		$dt = $row;
	}
	
	if( (!isset($dt['IDUSER']) || $dt['IDUSER'] = "") && !$_GET['act'] == 'has_edit_spaj'&& !$_GET['act'] == 'login_espaj'){
		$result = array(
			"status" => FALSE
			,"message" => "Invalid user or token" 
		);
	} else {
		if(isset($_GET['act'])){
			$guid = "";
			$otp = "";
			$msisdn = "";
			
			if(isset($_GET['guid'])){
				$guid = $_GET['guid'];
			}
			if(isset($_GET['otp'])){
				$otp = $_GET['otp'];
			}
			if(isset($_GET['msisdn'])){
				$msisdn = $_GET['msisdn'];
			}
			
			switch ($_GET['act']){
				case 'get_prospek': 
					$result = get_prospek($idagen,$db);
				break;				
				case 'get_processed': 
					$result = get_processed($idagen,$db);
				break;
				case 'get_underwrite': 
					$result = get_underwrite($idagen,$db);
				break;
				case 'get_polis': 
					$result = get_polis($idagen,$db);
				break;
				case 'get_build_id': 
					$result = get_build_id($idagen,$db);
				break;
				case 'gen_OTP': 
					$result = gen_OTP($idagen,$guid,$msisdn,$db);
				break;
				case 'validate_OTP': 
					$result = validate_OTP($idagen,$guid,$otp,$db);
				break;
				case 'has_edit_spaj': 
					$result = has_edit_spaj($idagen,$guid,$db);
				break;
				case 'get_profile': 
					$result = get_profile($idagen,$db);
				break;
				case 'login_espaj': 
					$json = json_decode(@file_get_contents('php://input'));

					$password = '';
					if(isset($json->password)){
						$password = $json->password;
						$idagen = $json->username;
					}
					$result = login_espaj($idagen,$password,$db);
				break;
			}
		}
	}
}

echo json_encode($result); exit; 

function get_profile($idagen,$db){
		$sql = "SELECT a.noagen, b.namaklien1, d.namastatusagen, b.tempatlahir, b.tgllahir, a.kdjabatanagen, 
				 c.namajabatanagen, a.nolisensiagen, TO_CHAR(a.tglmulailisensi, 'DD/MM/YYYY') AS tglmulailisensi, 
				 TO_CHAR(a.tglakhirlisensi, 'DD/MM/YYYY') AS tglakhirlisensi,
				 FLOOR(MONTHS_BETWEEN(sysdate, a.tglakhirlisensi) / 12) yearexpls,
				 FLOOR(MONTHS_BETWEEN(sysdate, e.tglpkajagen) / 12) yearexppkaj,
				 CASE WHEN FLOOR(ADD_MONTHS(e.tglpkajagen, 24) - sysdate) > 0 THEN FLOOR(ADD_MONTHS(e.tglpkajagen, 24) - sysdate) ELSE 0 END sisapkaj
			 FROM jsadm.tabel_400_agen@jlindo a
			 INNER JOIN jsadm.tabel_100_klien@jlindo b ON a.noagen = b.noklien
			 LEFT OUTER JOIN jsadm.tabel_413_jabatan_agen@jlindo c ON a.kdjabatanagen = c.kdjabatanagen
			 LEFT OUTER JOIN jsadm.tabel_409_status_agen@jlindo d ON a.kdstatusagen = d.kdstatusagen
			 LEFT OUTER JOIN (
				 SELECT noagen, MAX(tglpkajagen) tglpkajagen
				 FROM jsadm.tabel_400_pkaj_agen@jlindo
				 GROUP BY noagen
			 ) e ON a.noagen = e.noagen
			 WHERE a.noagen = '".$idagen."'";
        
			$result = array(
				"status" => FALSE
				,"message" => "Invalid ID!"
			);
			$dt = $db->query_array($sql);
				if(count($dt) > 0){
				$result = $dt[0];
				$result['status'] = TRUE;
			}
        return $result;
}


function login_espaj($idagen,$password,$db){
	$sql = "select USERNAME,MOBILETOKEN from JAIM_900_USER@JAIM where 1=1 
			and USERNAME = '".strtoupper($idagen)."' 
			and PASSWORD = '".strtoupper($password)."' 
			";
	//echo $sql;exit;
	$result = array(
		"status" => FALSE
		,"message" => "Invalid login!"
	);
	$dt = $db->query_array($sql);

	if($dt && count($dt) > 0){
		//var_dump($dt);
		$result = $dt[0];
		$result['status'] = TRUE;
	}else{
		$result['status'] = FALSE;
		$result['message'] = "Login Invalid!";
	}
	
	return $result;
}
 
function has_edit_spaj($idagen,$guid){
	$result = array(
		"status"=>FALSE
		,"message"=>"Nope."
	);
	
	$path = '/opt/bitnami/apps/jaim/htdocs/mobileapi/spaj_bridge/spaj_files/'.$idagen.'/update/spaj_'.$guid.'.edit.json';
	
	//$path = '/opt/bitnami/apps/jaim/htdocs/mobileapi/spaj_bridge/spaj_files/0011300167/update/';
	//echo 	$path ;
	if(file_exists($path)){
		$result = array("status"=>TRUE
			,"message"=>"$guid"
		);
	}
	return $result;
}

function get_prospek($idagen,$db){
	$m = (int)date('m') -1;
	$m = str_pad($m,2,"0",false); //prospek sebulan terakhir
	
	/*$sql = "select /*+DRIVING_SITE(protert)*//*+DRIVING_SITE(propemp)*//*+DRIVING_SITE(pros)*//*+DRIVING_SITE(pok)*//*+DRIVING_SITE(ag)*//*+DRIVING_SITE(rid)*/ 
        /*distinct 
		hit.build_id,hit.id_agen,hit.file_pdf,(case when hit.id_produk =  1 then 7 else hit.id_produk end) id_produk,hit.session_id,hit.tgl_rekam
		,hit.no_prospek,hit.cara_bayar,hit.jumlah_premi,hit.top_up,trunc(hit.tgl_rekam) tgl_rekam ,hit.flag_spaj,hit.jua	
		,(SELECT (case when kd_produk = 'JL4BLN_' then 'JL4BLN' else kd_produk end) kd_produk FROM JAIM_300_PRODUK@JAIM sa WHERE sa.id_produk = hit.id_produk and rownum = 1)  KD_PRODUK
		,pros.*,(select distinct KDPROPINSI from vw_PROPINSI_JAIM jm where pros.kdprovinsi = jm.kdprovinsi and rownum = 1) KDPROPINSI 
		,protert.*,propemp.*,alc.*,pok.*,ag.NAMAKLIEN1 NAMAAGEN,rid.*,(case when protert.NAMA = propemp.NAMA then 1 else 0 end) isTertanggungPempol
		 from JAIM_300_HITUNG@JAIM hit
				left join PRO_TERTANGGUNG@JAIM protert on (protert.build_id =  hit.build_id)
				left join PRO_PEMPOL@JAIM propemp on (hit.BUILD_ID = propemp.BUILD_ID)
				left join jaim_201_prospek@JAIM  pros on (pros.NOPROSPEK = hit.NO_PROSPEK)
				left join vw_spajol_alloc_fund alc on (alc.BUILD_ID = hit.BUILD_ID)
				left join PRO_ASURANSI_POKOK@JAIM pok on (pok.build_id = hit.BUILD_ID)
				left join TABEL_100_KLIEN ag on (ag.noklien = hit.id_agen)
				left join PRO_DATA_RIDER@jaim rid on (hit.BUILD_ID = rid.BUILD_ID)
		where  1=1 
				and hit.id_agen = '".$idagen."'
				and hit.build_id != '0'
				and hit.FLAG_SPAJ = 0
				and trim(hit.BUILD_ID)  not IN (
						SELECT DISTINCT TRIM (BUILDID) BUILD_ID  FROM TABEL_SPAJ_ONLINE ii 
						where  id_agen = hit.id_agen
						and ii.BUILDID is not null
					)
				and trunc(tgl_rekam) between to_date('201912','yyyymm') and sysdate

			ORDER BY hit.tgl_rekam DESC, hit.BUILD_ID DESC 
	";*/
	/*$sql = "select distinct 
		hit.build_id,hit.id_agen,hit.file_pdf,(case when TO_CHAR(hit.id_produk) =  '1' then '7' else TO_CHAR(hit.id_produk) end) id_produk, prod.nama_produk namaproduk, hit.session_id,hit.tgl_rekam tgl_rekamfull
		,hit.no_prospek,pok.cara_bayar, hit.cara_bayar namacarabayar, TO_NUMBER(hit.jumlah_premi) jumlah_premi,TO_NUMBER(hit.top_up) top_up,trunc(hit.tgl_rekam) tgl_rekam ,hit.flag_spaj,TO_NUMBER(hit.jua) jua	 
		,(SELECT (case when kd_produk = 'JL4BLN_' then 'JL4BLN' else kd_produk end) kd_produk FROM JAIM_300_PRODUK@JAIM sa WHERE sa.id_produk = hit.id_produk and rownum = 1)  KD_PRODUK
		,pros.noprospek, pros.noagen, pros.kdkantor, pros.kdareaoffice, pros.kdunitproduksi, pros.kdjabatanagen, TO_CHAR(pros.kdjenispekerjaan) kdjenispekerjaan, TO_CHAR(pros.kdhobi) kdhobi, pros.nama
		, pros.alamat, pros.kota kdkota, pros.kdprovinsi, pros.tgllahir, pros.jeniskelamin, pros.telp, pros.hp, pros.email, pros.no_ktp, pros.tglrekam, pros.dihapus, pros.tglhapus
		,(select distinct KDPROPINSI from vw_PROPINSI_JAIM jm where pros.kdprovinsi = jm.kdprovinsi and rownum = 1) KDPROPINSI 
		,protert.build_id, protert.hubungan kdhubunganctt, protert.nama namactt, protert.jenis_kelamin jeniskelaminctt, protert.tgl_lahir tgllahirctt, protert.is_perokok isperokokctt, protert.usia_th usiathctt, protert.usia_bl usiablctt, protert.telepon teleponctt
		,protert.email emailctt, protert.hp hpctt, protert.no_ktp noktpctt, TO_CHAR(protert.kdjnspekerjaan) kdjnspekerjaanttg, pkj.namapekerjaan nmjnspekerjaanctt, protert.maritalstatus maritalstatusctt, protert.kdhobi kdhobictt, hbi.namahobi nmhobictt
		,propemp.build_id, propemp.hubungan, propemp.nama, propemp.jenis_kelamin, propemp.tgl_lahir, propemp.is_perokok, propemp.usia_th, propemp.usia_bl, propemp.telepon
		,propemp.email, propemp.hp, TO_CHAR(propemp.kdjnspekerjaan) kdjnspekerjaan, propemp.no_ktp, propemp.maritalstatus
		,alc.*,pok.*,ag.NAMAKLIEN1 NAMAAGEN,rid.*,(case when protert.NAMA = propemp.NAMA then 1 else 0 end) isTertanggungPempol,
		(SELECT kdfund FROM pro_alokasi_fund@jaim WHERE fundalocid = pad.nama_alokasi1) kodealokasi1,
		(SELECT kdfund FROM pro_alokasi_fund@jaim WHERE fundalocid = pad.nama_alokasi2) kodealokasi2,
		(SELECT fundalocname FROM pro_alokasi_fund@jaim WHERE fundalocid = pad.nama_alokasi1) namaalokasi1,
		(SELECT fundalocname FROM pro_alokasi_fund@jaim WHERE fundalocid = pad.nama_alokasi2) namaalokasi2,
		pad.alokasi1*100 porsialokasi1, pad.alokasi2*100 porsialokasi2, kel.kodepos
		 from JAIM_300_HITUNG@JAIM hit
				left join PRO_TERTANGGUNG@JAIM protert on (protert.build_id =  hit.build_id)
				left join PRO_PEMPOL@JAIM propemp on (hit.BUILD_ID = propemp.BUILD_ID)
				left join jaim_201_prospek@JAIM  pros on (pros.NOPROSPEK = hit.NO_PROSPEK)
				left join vw_spajol_alloc_fund alc on (alc.BUILD_ID = hit.BUILD_ID)
				left join PRO_ASURANSI_POKOK@JAIM pok on (pok.build_id = hit.BUILD_ID)
				left join TABEL_100_KLIEN ag on (ag.noklien = hit.id_agen)
				left join PRO_DATA_RIDER@jaim rid on (hit.BUILD_ID = rid.BUILD_ID)
				left join JAIM_400_JENIS_PEKERJAAN@jaim pkj on protert.kdjnspekerjaan = pkj.kdjenispekerjaan
				left join pro_alokasi_dana@jaim pad on hit.build_id = pad.build_id
				left join jaim_201_prospek@jaim pros on hit.no_prospek = pros.noprospek
				left join tabel_111_kelurahan kel on pros.kdkelurahan = kel.kdkelurahan
				left join jaim_300_produk@jaim prod on hit.id_produk = prod.id_produk
				left join jaim_301_hobi@jaim hbi on protert.kdhobi = hbi.kdhobi
		where  1=1 
				and hit.id_agen = '$idagen'
				and hit.build_id != '0'
				and hit.FLAG_SPAJ = 0
				and trim(hit.BUILD_ID)  not IN (
						SELECT DISTINCT TRIM (BUILDID) BUILD_ID  FROM TABEL_SPAJ_ONLINE ii 
						where  id_agen = hit.id_agen
						and ii.BUILDID is not null
					)
				and trunc(tgl_rekam) between to_date('201912','yyyymm') and sysdate

			UNION
	
		SELECT a.buildid, a.noagen, '', NVL(TO_CHAR(b.id_produk), a.kdproduk), i.namaproduk, '', a.tglrekam, a.nocpp, a.kdcarabayar, j.namacarabayar, a.premi, NVL(a.topupberkala, a.topupsekaligus),
			TRUNC(a.tglrekam), a.flag, a.jua, a.kdproduk, a.nocpp, a.noagen, c.kdkantor, '', '', c.kdjabatanagen, d.kdpekerjaan, d.kdhobi, d.namaklien, d.alamat,
			e.kdkotamadya, d.kdprovinsi, d.tgllahir, DECODE(d.kdjeniskelamin, 'L', 'M', 'P', 'F'), d.telepon, d.hp, d.email, d.noid, d.tglrekam, 0, null, d.kdprovinsi, 
			a.buildid, f.kdhubungan, g.namaklien, DECODE(g.kdjeniskelamin, 'L', 'M', 'P', 'F'), g.tgllahir, g.merokok, null, null, g.telepon, g.email, g.hp, g.noid, g.kdpekerjaan, k.namapekerjaan, g.meritalstatus, g.kdhobi, l.namahobi,
			a.buildid, f.kdhubungan, d.namaklien, DECODE(d.kdjeniskelamin, 'L', 'M', 'P', 'F'), d.tgllahir, d.merokok, null, null, d.telepon, d.email, d.hp, d.kdpekerjaan, d.noid, d.meritalstatus,
			null, null, null, null, null, null, a.buildid, a.buildid, null, a.kdcarabayar, a.usiaproduktif, a.penghasilan, a.jua, a.juamaksimal, a.kdstatusmedical, a.premiberkala,
			a.topupberkala, a.topupsekaligus, 0, 'IDR', a.resikoawal, null, null, a.kdpaketmedical, null, a.periodetopup, h.namaklien1, a.buildid, null, null, null, null,
			null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 
			CASE WHEN a.nocpp = a.noctt THEN 1 ELSE 0 END,
			(SELECT MAX(kdfund) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) kodealokasi1,
			(SELECT MIN(kdfund) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MIN(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) kodealokasi2,
			(SELECT MAX(namafund) FROM jaim_302_opsi_fund@jaim z INNER JOIN jaim_301_fund@jaim y ON z.kdfund = y.kdfund WHERE z.buildid = a.buildid AND porsi = (SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) namaalokasi1,
			(SELECT MIN(namafund) FROM jaim_302_opsi_fund@jaim z INNER JOIN jaim_301_fund@jaim y ON z.kdfund = y.kdfund WHERE z.buildid = a.buildid AND porsi = (SELECT MIN(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) namaalokasi2,
			(SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) porsialokasi1,
			(SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MIN(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) porsialokasi1,
			e.kodepos
		FROM jaim_302_hitung@jaim a
		LEFT OUTER JOIN jaim_300_produk@jaim b ON a.kdproduk = b.kd_produk
			AND b.kd_status = 1
		LEFT OUTER JOIN tabel_400_agen c ON a.noagen = c.noagen
		LEFT OUTER JOIN jaim_302_klien@jaim d ON a.nocpp = d.noklien
		LEFT OUTER JOIN tabel_111_kelurahan e ON d.kdkelurahan = e.kdkelurahan
		LEFT OUTER JOIN jaim_302_insurable@jaim f ON a.nocpp = f.noklien
			AND a.buildid = f.buildid
		LEFT OUTER JOIN jaim_302_klien@jaim g ON a.noctt = g.noklien
		LEFT OUTER JOIN tabel_100_klien h ON a.noagen = h.noklien
		LEFT OUTER JOIN tabel_202_produk i ON a.kdproduk = i.kdproduk
		LEFT OUTER JOIN tabel_305_cara_bayar j ON a.kdcarabayar = j.kdcarabayar
        LEFT OUTER JOIN jaim_301_pekerjaan@jaim k ON g.kdpekerjaan = k.kdpekerjaan
        LEFT OUTER JOIN jaim_301_hobi@jaim l on g.kdhobi = l.kdhobi
		WHERE a.noagen = '$idagen'
			AND NVL(a.flag, 0) = 0
			AND trim(a.buildid) NOT IN (
				SELECT DISTINCT TRIM (BUILDID) BUILD_ID 
				FROM TABEL_SPAJ_ONLINE ii 
				WHERE kodeagen = a.noagen
					AND ii.buildid is not null
			)

		ORDER BY tgl_rekamfull DESC";*/
		
	$sql = "SELECT a.buildid, a.noagen, q.namaklien1 namaagen, a.kdproduk, p.namaproduk, a.kdcarabayar, b.namacarabayar, a.premi, NVL(a.premiberkala, 0) premiberkala, 
				NVL(a.topupberkala, 0) topupberkala, NVL(a.topupsekaligus, 0) topupsekaligus, a.periodetopup,
				a.jua, a.penghasilan, a.resikoawal, a.kdstatusmedical, a.tglrekam, c.namaklien namacpp, 
				c.alamat || ' Kec. ' || e.namakecamatan || ' Kel. ' || d.namakelurahan || ', ' || f.namakotamadya || ', ' || g.namapropinsi || ' ' || d.kodepos alamatcpp,
				d.kdkotamadya kdkotamadyacpp, d.kdpropinsi kdpropinsicpp, d.kodepos kdposcpp, c.tgllahir tgllahircpp, floor(months_between(TRUNC(sysdate), c.tgllahir)/12)  usiacpp,
				c.kdjeniskelamin kdjeniskelamincpp, c.telepon teleponcpp, c.hp hpcpp,
				c.email emailcpp, c.noid noktpcpp, c.kdpekerjaan kdpekerjaancpp, h.namapekerjaan namapekerjaancpp, c.kdhobi kdhobicpp, i.namahobi namahobicpp, 
				c.meritalstatus maritalstatuscpp, c.merokok merokokcpp, k.kdhubungan kdhubunganctt, l.namahubungan namahubunganctt, m.namaklien namactt,
				m.tgllahir tgllahirctt, floor(months_between(TRUNC(sysdate), m.tgllahir)/12)  usiactt, 
				m.kdjeniskelamin kdjeniskelaminctt, m.telepon teleponctt, m.hp hpctt, m.email emailctt, m.noid noktpctt, m.kdpekerjaan kdpekerjaanctt,
				n.namapekerjaan namapekerjaanctt, m.kdhobi kdhobictt, o.namahobi namahobictt, m.merokok merokokctt,
				(SELECT MAX(kdfund) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) kdalokasi1,
				(SELECT MIN(kdfund) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MIN(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) kdalokasi2,
				(SELECT MAX(namafund) FROM jaim_302_opsi_fund@jaim z INNER JOIN jaim_301_fund@jaim y ON z.kdfund = y.kdfund WHERE z.buildid = a.buildid AND porsi = (SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) namaalokasi1,
				(SELECT MIN(namafund) FROM jaim_302_opsi_fund@jaim z INNER JOIN jaim_301_fund@jaim y ON z.kdfund = y.kdfund WHERE z.buildid = a.buildid AND porsi = (SELECT MIN(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) namaalokasi2,
				(SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) persenalokasi1,
				(SELECT MAX(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid AND porsi = (SELECT MIN(porsi) FROM jaim_302_opsi_fund@jaim WHERE buildid = a.buildid)) persenalokasi2,
				null isaddb, null addb, null istpd, null tpd, '0' ishcpmurni, null plafonhcpmurni, null hcpmurni, null ishcpbedah, null plafonhcpbedah, null hcpbedah, null isci, null ci, 
				null istl, null tl, null ispd, null pd, null isptpd, null ptpd, null issd, null sd, null iswtpd, null wtpd, null iswci, null wci, null isstpd, null stpd, null isadb, null adb,
				null ispci, null pci, null issci, null sci,
				null usia_produktif
				/** perubahan untuk LPA 18 juli **/
				,agn.kdjabatanagen
				,(SELECT COUNT(*) FROM jaim.JAIM_302_DOKUMEN WHERE BUILDID = a.buildid) total_dokumen
				/** end perubahan **/
			FROM jaim_302_hitung@jaim a
			LEFT OUTER JOIN tabel_305_cara_bayar b ON a.kdcarabayar = b.kdcarabayar
			LEFT OUTER JOIN jaim_302_klien@jaim c ON a.nocpp = c.noklien
			LEFT OUTER JOIN tabel_111_kelurahan d ON c.kdkelurahan = d.kdkelurahan
			LEFT OUTER JOIN tabel_110_kecamatan e ON d.kdkecamatan = e.kdkecamatan
			LEFT OUTER JOIN tabel_109_kotamadya f ON d.kdkotamadya = f.kdkotamadya
			LEFT OUTER JOIN tabel_108_propinsi g ON d.kdpropinsi = g.kdpropinsi
			LEFT OUTER JOIN jaim_301_pekerjaan@jaim h ON c.kdpekerjaan = h.kdpekerjaan
			LEFT OUTER JOIN jaim_301_hobi@jaim i ON c.kdhobi = i.kdhobi
			LEFT OUTER JOIN jaim_302_insurable@jaim k ON a.buildid = k.buildid
				AND a.nocpp = k.noklien
			LEFT OUTER JOIN jaim_301_hubungan@jaim l ON k.kdhubungan = l.kdhubungan
			LEFT OUTER JOIN jaim_302_klien@jaim m ON a.noctt = m.noklien
			LEFT OUTER JOIN jaim_301_pekerjaan@jaim n ON m.kdpekerjaan = n.kdpekerjaan
			LEFT OUTER JOIN jaim_301_hobi@jaim o ON m.kdhobi = o.kdhobi
			LEFT OUTER JOIN tabel_202_produk p ON a.kdproduk = p.kdproduk
			LEFT OUTER JOIN tabel_100_klien q ON a.noagen = q.noklien
			/** perubahan untuk LPA 18 juli **/
			LEFT OUTER JOIN tabel_400_agen agn ON a.noagen = agn.noagen
			/** end perubahan **/
			WHERE a.noagen = '$idagen'
				AND a.buildid NOT IN (SELECT NVL(buildid,1) FROM tabel_spaj_online WHERE kodeagen = a.noagen)

			UNION ALL

			SELECT a.build_id, a.id_agen, s.namaklien1, b.kd_produk, r.namaproduk, t.kdcarabayar, a.cara_bayar, TO_NUMBER(a.jumlah_premi), c.premi_berkala, c.topup_berkala, c.topup_sekaligus, c.periode_topup,
				TO_NUMBER(a.jua), c.penghasilan, c.akumulasi_resiko_awal, c.medical, a.tgl_rekam, d.nama, 
				d.alamat || ' Kec. ' || f.namakecamatan || ' Kel. ' || e.namakelurahan || ', ' || g.namakotamadya || ', ' || h.namapropinsi || ' ' || e.kodepos,
				e.kdkotamadya, e.kdpropinsi, e.kodepos, d.tgllahir, floor(months_between(TRUNC(sysdate), d.tgllahir)/12),
				CASE d.jeniskelamin WHEN 'M' THEN 'L' WHEN 'F' THEN 'P' END, d.telp, d.hp,
				d.email, d.no_ktp, TO_CHAR(d.kdjenispekerjaan), i.namapekerjaan, TO_CHAR(d.kdhobi), j.namahobi, k.maritalstatus, k.is_perokok, 
				CASE k.hubungan WHEN '1' THEN 'S' WHEN '2' THEN '1' WHEN '3' THEN '04' WHEN '4' THEN 'B' WHEN '5' THEN 'C' WHEN '6' THEN 'K' WHEN '7' THEN 'G' WHEN '8' THEN 'R' WHEN '9' THEN 'K1' END,
				CASE k.hubungan WHEN '1' THEN 'Suami/Istri' WHEN '2' THEN 'Orang Tua/Anak' WHEN '3' THEN 'Diri Sendiri' WHEN '4' THEN 'Kakak Kandung' WHEN '5' THEN 'Adik Kandung' WHEN '6' THEN 'Kakek/Nenek' WHEN '7' THEN 'Cucu' WHEN '8' THEN 'Paman/Bibi' WHEN '9' THEN 'Keponakan' END, l.nama, l.tgl_lahir, 
				floor(months_between(TRUNC(sysdate), l.tgl_lahir)/12), 
				CASE l.jenis_kelamin WHEN 'M' THEN 'L' WHEN 'F' THEN 'P' END, null telepon, null hp, null email, l.no_ktp, TO_CHAR(l.kdjnspekerjaan), m.namapekerjaan, l.kdhobi, m.namahobi, 
				l.is_perokok, o.kdfund, p.kdfund, o.fundalocname, p.fundalocname, n.alokasi1*100, n.alokasi2*100,
				q.is_addb, q.addb, q.is_tpd, q.tpd, q.is_hcp_murni, q.plafon_hcp_murni, q.hcp_murni, q.is_hcp_bedah, q.plafon_hcp_bedah, q.hcp_bedah, q.is_ci, q.ci, q.is_tl, q.tl,
				q.is_payor_death, q.payor_death, q.is_payor_tpd, q.payor_tpd, q.is_spouse_death, q.spouse_death, q.is_waiver_tpd, q.waiver_tpd, q.is_waiver_ci, q.waiver_ci, 
				q.is_spouse_tpd, q.spouse_tpd, q.is_adb, q.adb, q.is_payor_ci, q.payor_ci, q.is_spouse_ci, q.spouse_ci,
				c.usia_produktif
				/** perubahan untuk LPA 18 juli **/
				,agn.kdjabatanagen
				,(SELECT COUNT(*) FROM jaim.JAIM_302_DOKUMEN WHERE BUILDID = a.build_id) total_dokumen
				/** end perubahan **/
			FROM jaim_300_hitung@jaim a
			LEFT OUTER JOIN jaim_300_produk@jaim b ON a.id_produk = b.id_produk
			LEFT OUTER JOIN pro_asuransi_pokok@jaim c ON a.build_id = c.build_id
			LEFT OUTER JOIN jaim_201_prospek@jaim d ON a.no_prospek = d.noprospek
			LEFT OUTER JOIN tabel_111_kelurahan e ON d.kdkelurahan = e.kdkelurahan
			LEFT OUTER JOIN tabel_110_kecamatan f ON e.kdkecamatan = f.kdkecamatan
			LEFT OUTER JOIN tabel_109_kotamadya g ON e.kdkotamadya = g.kdkotamadya
			LEFT OUTER JOIN tabel_108_propinsi h ON e.kdpropinsi = h.kdpropinsi
			LEFT OUTER JOIN jaim_400_jenis_pekerjaan@jaim i ON d.kdjenispekerjaan = i.kdjenispekerjaan
			LEFT OUTER JOIN jaim_301_hobi@jaim j ON d.kdhobi = j.kdhobi
			LEFT OUTER JOIN pro_pempol@jaim k ON a.build_id = k.build_id
			LEFT OUTER JOIN pro_tertanggung@jaim l ON a.build_id = l.build_id
			LEFT OUTER JOIN jaim_400_jenis_pekerjaan@jaim m ON l.kdjnspekerjaan = m.kdjenispekerjaan
			LEFT OUTER JOIN jaim_301_hobi@jaim m ON l.kdhobi = m.kdhobi
			LEFT OUTER JOIN pro_alokasi_dana@jaim n ON a.build_id = n.build_id
			LEFT OUTER JOIN pro_alokasi_fund@jaim o ON n.nama_alokasi1 = o.fundalocid
			LEFT OUTER JOIN pro_alokasi_fund@jaim p ON n.nama_alokasi2 = p.fundalocid
			LEFT OUTER JOIN pro_data_rider@jaim q ON a.build_id = q.build_id
			LEFT OUTER JOIN tabel_202_produk r ON b.kd_produk = r.kdproduk
			LEFT OUTER JOIN tabel_100_klien s ON a.id_agen = s.noklien
			LEFT OUTER JOIN tabel_305_cara_bayar t ON LOWER(a.cara_bayar) = LOWER(t.namacarabayar)
                AND t.kdstatus = 1 
				AND a.dihapus = '0'
			/** perubahan untuk LPA 18 juli **/
			LEFT OUTER JOIN tabel_400_agen agn ON a.id_agen = agn.noagen
			/** end perubahan **/
			WHERE a.id_agen = '$idagen'
				AND a.build_id NOT IN (SELECT NVL(buildid,1) FROM tabel_spaj_online WHERE kodeagen = a.id_agen)
			
			ORDER BY tglrekam DESC";

	//echo $sql; exit; 

	$dtx = $db->query_array($sql);

	//limit lastest 100
	$ctt = count($dtx);
	if($ctt > 100){
		$ctt = 100;
	}
	$dt = false;
	//for($i=0;$i<=count($dtx)-1;$i++){
	for($i=0;$i<$ctt;$i++){
		$dt[] = @$dtx[$i];
	}

	return $dt;
}

function validate_OTP($idagen,$guid,$otp,$db){
	$sql = " select to_char(EXPIRED,'YYYY-MM-DD HH24:mi:ss') EXPIRED,
		to_char(SYSDATE,'YYYY-MM-DD HH24:mi:ss')  NOW
	from TABEL_SPAJ_ONLINE_OTP where idagen = '".$idagen."' and guid = '".$guid."' 
		and OTP = '".$otp."'
		and sysdate <= EXPIRED
	";
	
	$dt = $db->query_array($sql);
	
	$result = array(
		"status" => FALSE
		,"message" => "OTP not Valid!"
	);
	
	if($dt){
		$result = $dt[0];
		$result['status'] = TRUE;
	}else{
		$result['status'] = FALSE;
		$result['message'] = "OTP tidak berlaku!";
	}
	
	return $result;
}

function gen_OTP($idagen,$guid,$msisdn,$db){
	$rand = rand(900009,999999);
	
	$sql = "insert into TABEL_SPAJ_ONLINE_OTP (idagen,guid,otp,msisdn) values (
		'".$idagen."','".$guid."','".$rand."','".$msisdn."'
	)";
	
	if($db->query($sql)){
		
		$messageOtp = "Kode OTP untuk ESPAJ Anda adalah " .addspaces((string)$rand). " Mohon Jaga kerahasiaannya.";
		
		send_sms($msisdn,$messageOtp);
		
		$result = array(
			"status" => TRUE
			,"message" => 'Sukses membuat OTP. OTP berlaku lima menit. Silahkan cek inbox SMS pada nomor HP terdaftar.'
		);
	} else {
		$result = array(
			"status" => FALSE
			,"message" => "Error create OTP!"
		);
	}
	return $result;
}

function get_build_id($idagen,$db){
	$sql = "select F_GEN_BUILD_ID@JAIM as build_id from dual";
	$dt = $db->query_array($sql);
	return $dt;
}

function get_polis($idagen,$db){
	$sql = "select nospaj,status,kodeagen,tanggalrekam,tanggalupdate,buildid,produk,(
		 select namaproduk from   TABEL_202_PRODUK_SOA@JLINDO f where f.kdproduk = a.produk
		) namaproduk,keterangan1,keterangan2 from TABEL_SPAJ_ONLINE@JLINDO a
		where 1=1
		and a.status in (6)
		and a.kodeagen = '".$idagen."' 
		order by buildid DESC";
		
	$dt = $db->query_array($sql);

	return $dt;
}

function get_underwrite($idagen,$db){
	$sql = "	select nospaj,status,kodeagen,tanggalrekam,tanggalupdate,buildid,produk,(
		 select namaproduk from   TABEL_202_PRODUK f where f.kdproduk = a.produk
		) namaproduk,keterangan1,keterangan2 
		,(select file_pdf from  JAIM_300_HITUNG@JAIM hi where hi.BUILD_ID = a.BUILDID) file_pdf
		from TABEL_SPAJ_ONLINE a
		where 1=1
			and a.status in (3)
			and a.kodeagen = '".$idagen."' 
			order by buildid DESC";
	
	$dt = $db->query_array($sql);

	return $dt;
}

function get_processed($idagen,$db){
	$sql = "			select nospaj,status,kodeagen,tanggalrekam,tanggalupdate,buildid,produk,(
		 select namaproduk from   TABEL_202_PRODUK f where f.kdproduk = a.produk
		) namaproduk,keterangan1,keterangan2,(case a.produk when 'JL4BLN' then 'jspromapannew' end) controller_pdf 
		,(select file_pdf from  JAIM_300_HITUNG@JAIM hi where hi.BUILD_ID = a.BUILDID) file_pdf from TABEL_SPAJ_ONLINE a
		where 1=1
			and a.status in(0,1,2,4,5)
			and a.kodeagen = '".$idagen."' 
			and a.buildid IS NOT NULL
		order by tanggalrekam DESC
		";

		$dt = $db->query_array($sql);

	return $dt;
}


function send_sms($msisdn,$smsmsg){
	$curl = curl_init();
	
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => "http://smsgw.ifg-life.id:8080/send.otp.php?msisdn=$msisdn&message=".urlencode($smsmsg),
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36'
	));
	
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	
	// Close request to clear up some resources
	curl_close($curl);
	
	/*$smsmsg = urlencode($smsmsg);

	$API_SMS = "";
	if(isset($msisdn)){
		$API_SMS = $msisdn."&senderid=JIWASRAYA&user=jiwasraya&password=6usmna&message=".$smsmsg;
	}
	
	//$curl = " curl -p ". $API_SMS;
	$x255 = chr ( 255 );
	$text = str_replace(' ', $x255, $API_SMS);
	$text = str_replace('/', '%2F', $API_SMS);
	$text = str_replace('/', '%2F', $API_SMS);
	
	$text =  $API_SMS;
	//ECHO $text;exit;
	
	$urld = 'https://portal.smsblast.id/api/sendsingle?msisdn='.$text;
	//$urld = 'https://new.smsblast.id/api/sendsingle?msisdn='.$text;
	//$urld = 'https://api2.smsblast.id/SmsblastGateway/otp/sendsms?msisdn='.$text;
	
	
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $urld,
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);*/

	/*$servername = "192.168.1.5";
	$username = "root";
	$password = "p4ss!@#$";
	$dbname = "ifgsms";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = "INSERT INTO smsjiwasraya (phone, message) VALUES ('$msisdn', '$smsmsg')";
	$result = $conn->query($sql);
	
	$conn->close();*/
}

function addspaces( $str ) {
	$temp = array();
	for ( $i = 0; $i < strlen( $str ); $i++ ) {
		$temp[$i] = $str[$i].' ';
	}
	$temp = implode( '', $temp );
	$temp = str_replace( ' ', ' ', $temp );
	return $temp;
}
