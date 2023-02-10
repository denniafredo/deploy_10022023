<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("access-control-allow-origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
date_default_timezone_set("Asia/Jakarta");
	/*
	* API file untuk aplikasi JSPROSALES
	* method untuk data POLIS
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$r	= $_GET['r'];
	$p	= $_GET['p'];
	$p2 = $_GET['p2'];
	$search_str = strtoupper($_GET['search_str']);
	$search_p = null;
	
	if($search_str != ""){
		$search_p = " 
			AND  ( UPPER(A.NOPERTANGGUNGAN) like '%".$search_str."%' 
					OR UPPER(A.NAMAPEMEGANGPOLIS)  like '%".$search_str."%' 
					OR UPPER(A.NAMATERTANGGUNG)  like '%".$search_str."%' 
					OR UPPER(A.NAMAPRODUK)  like '%".$search_str."%' 
					OR UPPER(A.STATUSPOLIS)  like '%".$search_str."%' 
				)
		";
	} else {
	
		$search_p = "";
	}
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	$DC = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	
	if (strcasecmp($r, 'X') == 0) {
	//get data POLIS dan PROSPEK dari JLINDO
	//get data POLIS dan PROSPEK dari JLINDO
	$p	= addslashes($p);
	
	$ssql = "
SELECT A.PREFIXPERTANGGUNGAN,
       a.NOPERTANGGUNGAN,
       A.PREFIXPERTANGGUNGAN || '-' || a.nopertanggungan nopolis,
       A.NAMAPEMEGANGPOLIS,
       A.NOPONSELPEMPOL PH01A,
       A.NOPONSELPEMPOL2 PH02A,
	          (SELECT MAX (tglbooked)
          FROM tabel_300_historis_premi
         WHERE     prefixpertanggungan = a.prefixpertanggungan
               AND nopertanggungan = a.nopertanggungan)
          AS lunasterakhir,
       (SELECT KL.NO_PONSEL
          FROM tabel_100_klien kl, tabel_200_pertanggungan pp
         WHERE     PP.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND PP.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
               AND KL.NOKLIEN = PP.NOTERTANGGUNG)
          PH01B,
       (SELECT KL.NO_PONSEL2
          FROM tabel_100_klien kl, tabel_200_pertanggungan pp
         WHERE     PP.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND PP.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
               AND KL.NOKLIEN = PP.NOTERTANGGUNG)
          PH02B,
       A.NAMATERTANGGUNG,
       A.PREMI1,
       A.PREMI2,
       A.PREMISTD,
       A.STATUSPOLIS,
       A.KDPRODUK,
       A.NAMAPRODUK,
       A.SPAJ,
       A.TGLLAHIRPEMPOL TGLLAHIRPEMEGANGPOLIS,
       A.TGLAKHIRPREMI AKHIRPREMI,
       (SELECT namacarabayar
          FROM tabel_305_cara_bayar cb, tabel_200_pertanggungan pp
         WHERE     cb.kdcarabayar = pp.kdcarabayar
               AND pp.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
               AND pp.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN)
          CARABAYAR,
       (SELECT TGLLAHIR
          FROM tabel_100_klien kl, tabel_200_pertanggungan pp
         WHERE     PP.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND PP.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
               AND KL.NOKLIEN = PP.NOTERTANGGUNG)
          TGLLAHIRTERTANGGUNG,
       (SELECT tglsendemail
          FROM TABEL_200_PERTANGGUNGAN
         WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)
          AS TGLkirimemail,
       (SELECT TGLREKAM
          FROM TABEL_200_PERTANGGUNGAN
         WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)
          AS TGLREKAMPOLIS,
       (SELECT DECODE (KDSTATUSMEDICAL,  'N', 'NON MEDICAL',  'M', 'MEDICAL')
          FROM TABEL_200_PERTANGGUNGAN
         WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)
          AS STATUSMEDICAL,
      -- B.TGLUNDERWRITING AS TGLAPPROVAL,
       (SELECT TGLBAYAR
          FROM TABEL_300_HISTORIS_PREMI
         WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
               AND TGLSEATLED IS NOT NULL
               AND KDKUITANSI = 'BP3'
               AND ROWNUM = 1)
          AS TGLTRANSFERHOSTOHOST,
       X.TGLACCEPTANCE AS TGLAKSEPTASI,
       (SELECT TGLKONVERSI
          FROM TABEL_200_PERTANGGUNGAN
         WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)
          AS TGLKONVERSI,
       (SELECT TGLCETAK
          FROM TABEL_200_PERTANGGUNGAN
         WHERE     PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
               AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)
          AS TGLCETAKPOLIS,
       TO_DATE (A.MULAS, 'DD/MM/YYYY') AS MULAS
  FROM --TABEL_214_UNDERWRITING B,
       V_PROFILE_PEMPOL a LEFT JOIN TABEL_214_ACCEPTANCE_DOKUMEN X ON     A.PREFIXPERTANGGUNGAN =
                                                                             X.PREFIXPERTANGGUNGAN
                                                                      AND A.NOPERTANGGUNGAN =
                                                                             X.NOPERTANGGUNGAN
 WHERE    -- A.PREFIXPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN
       -- AND A.NOPERTANGGUNGAN = B.NOPERTANGGUNGAN
				  a.noagen = '$p'
				 ".	 $search_p	 ."
				 AND A.STATUSPOLIS IN ('KLAIM','AKTIF','BPO')
				 and a.prefixpertanggungan||a.nopertanggungan in (
					select distinct (prefixpertanggungan||nopertanggungan)
					from v_jsprosales_klaim ff where ff.noagen = a.noagen
					and ff.tglpengajuan > to_date('2015/12/01','yyyy/mm/dd')
						and ff.tglpengajuan is not null
					and ff.status is not null
				 )
		ORDER BY A.STATUSPOLIS DESC, TO_DATE (MULAS, 'DD/MM/YYYY') DESC
	";

	//echo $ssql;exit;
	
		$DB->parse($ssql);
		$DB->execute();
		
		$datas = null;
		while($row = $DB->nextrow()){
		

			$datas[] = $row;
		}
		
		if(count($datas) < 1){
			$datas[0] = "NOT FOUND";
		}else{
			$i = 0;
			foreach($datas as $data){
 			 $xsql = "
				SELECT
					   kdbenefit,
					   --(SELECT namabenefit
						 -- FROM TABEL_207_KODE_BENEFIT d
						 --WHERE d.kdbenefit = vf.kdbenefit)
						 -- nmbenefit,
					  nilaibenefit,
					   kdjenisbenefit
				  FROM TABEL_223_TRANSAKSI_PRODUK vf
				 WHERE nilaibenefit > 0
				 and vf.PREFIXPERTANGGUNGAN = '".$data['PREFIXPERTANGGUNGAN']."'
				 and vf.NOPERTANGGUNGAN = '".$data['NOPERTANGGUNGAN']."'
				";

				$DB->parse($xsql);
				$DB->execute();
					
				$dataBenefit = null;
				while($row = $DB->nextrow()){
					$dataBenefit[] = implode(',',$row);
				}
				
				$datas[$i]['BENEFIT'] = $dataBenefit; 
				
				
				//Get Data Klaim
				$datas[$i]['KLAIM'] = getDataKlaim($DC,$p,$data['PREFIXPERTANGGUNGAN'].$data['NOPERTANGGUNGAN']);
				$i++;
			}
		
		
		}
		
		echo json_encode($datas);
		
	//get data POLIS dan PROSPEK dari JLINDO
	//get data POLIS dan PROSPEK dari JLINDO
	}
	
	
	function getDataKlaim($DC,$noagen,$nopolis){
		//GET KLAIM
		
		$tssq = " select distinct * from (
    SELECT a.kdrayonpenagih AS kdkantor,
       a.prefixpertanggungan,
       a.nopertanggungan,
       a.nopollama,
       a.namapemegangpolis,
       a.namatertanggung,
       a.noagen,
       a.jnskelamintertanggung,
       a.kdproduk,
       a.namaproduk,
       a.juamainproduk,
       JENISPEMBAYARAN,
       a.kdvaluta,
       a.valuta,
       a.indexawal,
       \"NILAIPEMBY(RP)\" AS nilaipembayaranrupiah,
       a.nilaibenefit,
       a.kursstandar,
       a.kurstransaksi,
       \"NILAIBENEFIT(RP)\" AS nilaibenefitrupiah,
       KLAIM.TGLJATUHTEMPO,
       --A.NOMORSIP,
       KLAIM.TGLPENGAJUAN,
       KLAIM.TGLHITUNG AS tgldesisi,
       KLAIM.TGLOTORISASI,
       KLAIM.TGLMENINGGAL,
       KLAIM.SEBABMENINGGAL,
       a.kdstatusmedical,
       (SELECT namacarabayar
          FROM tabel_305_cara_bayar
         WHERE kdcarabayar = a.kdcarabayar)
          AS cara_bayar,
       a.mulas,
       a.usia_th,
       a.expirasi,
       LAMAASURANSI_TH,
       AKHIRPREMI,
       LAMAPEMBPREMI_TH,
       PREMI1,
       PREMI2,
       PREMISTD,
       a.tglsip,
       statuspolis,
       klaim.status,
       (SELECT namastatus
          FROM tabel_999_kode_status
         WHERE kdstatus = klaim.status AND jenisstatus = 'KLAIM')
          statusklaim,
       KLAIM.KDKLAIM,
       (SELECT MAX (tglbooked)
          FROM tabel_300_historis_premi
         WHERE     prefixpertanggungan = a.prefixpertanggungan
               AND nopertanggungan = a.nopertanggungan)
          AS lunasterakhir
  FROM (SELECT (SELECT KDRAYONPENAGIH
                  FROM TABEL_500_PENAGIH
                 WHERE NOPENAGIH = D.NOPENAGIH)
                  AS KDRAYONPENAGIH,
               a.prefixpertanggungan,
               a.nopertanggungan,
               D.NOPOL AS NOPOLLAMA,
               (SELECT NAMAKLIEN1
                  FROM TABEL_100_KLIEN
                 WHERE NOKLIEN = D.NOPEMEGANGPOLIS)
                  AS NAMAPEMEGANGPOLIS,
               (SELECT NAMAKLIEN1
                  FROM TABEL_100_KLIEN
                 WHERE NOKLIEN = D.NOTERTANGGUNG)
                  AS NAMATERTANGGUNG,
               (SELECT JENISKELAMIN
                  FROM TABEL_100_KLIEN
                 WHERE NOKLIEN = D.NOTERTANGGUNG)
                  AS JNSKELAMINTERTANGGUNG,
               d.kdproduk,
               (SELECT NAMAPRODUK
                  FROM TABEL_202_PRODUK
                 WHERE KDPRODUK = D.KDPRODUK)
                  AS NAMAPRODUK,
               D.JUAMAINPRODUK,
               d.kdvaluta,
               (SELECT NAMAVALUTA
                  FROM TABEL_304_VALUTA
                 WHERE KDVALUTA = D.KDVALUTA)
                  AS VALUTA,
               D.INDEXAWAL,
               a.nilaipembayaran AS \"NILAIPEMBY(RP)\",
               (SELECT nilai
                  FROM tabel_900_sip
                 WHERE nourut = '1' AND nomorsip = a.nomorsip)
                  AS NILAIBENEFIT,
               A.KURSSTANDAR,
               A.KURSTRANSAKSI,
                 ( (SELECT nilai
                      FROM tabel_900_sip
                     WHERE nourut = '1' AND nomorsip = a.nomorsip))
               * A.KURSSTANDAR
                  AS \"NILAIBENEFIT(RP)\",
               (SELECT rekening1
                  FROM tabel_900_sip
                 WHERE nourut = '1' AND nomorsip = a.nomorsip)
                  rekening1,
               a.nomorsip,
               d.noagen,
               a.tglsip AS tglsip,
               TO_CHAR (a.tglhitung, 'DD/MM/YYYY') AS tglhitung,
               a.novoucher,
               (SELECT NAMAPEMBAYARAN
                  FROM TABEL_801_TEMP
                 WHERE KDPEMBAYARAN = A.KDPEMBAYARAN)
                  AS JENISPEMBAYARAN,
               D.KDSTATUSMEDICAL,
               d.kdcarabayar,
               D.EXPIRASI,
               d.usia_th,
               d.mulas,
               LAMAASURANSI_TH,
               D.TGLAKHIRPREMI AS akhirpremi,
               LAMAPEMBPREMI_TH,
               PREMI1,
               PREMI2,
               PREMISTD,
               (SELECT namastatusfile
                  FROM tabel_299_status_file
                 WHERE kdstatusfile = d.kdstatusfile)
                  AS statuspolis
          FROM tabel_800_pembayaran_keluar a,
               tabel_200_pertanggungan d
         WHERE     d.prefixpertanggungan = a.prefixpertanggungan
               AND d.nopertanggungan = a.nopertanggungan
               and d.noagen is not null
			   
               --FILTER HERE
				   AND d.prefixpertanggungan|| d.nopertanggungan = '".$nopolis."'
				   AND d.noagen = '".$noagen."'
			   --FILTER HERE
			   
               AND TO_CHAR (A.TGLSIP, 'YYYY') = TO_CHAR (SYSDATE, 'yyyy')) a
       LEFT JOIN
       tabel_901_pengajuan_klaim klaim
          ON     a.prefixpertanggungan = klaim.prefixpertanggungan
             AND a.nopertanggungan = klaim.nopertanggungan
             and klaim.status != '3'
              and klaim.status is not null

             order by tglpengajuan desc
             )
		";
		
		//var_dump($tssq);exit;
		$DC->parse($tssq);
		$DC->execute();

		$datas = null;
		while($rows = $DC->nextrow()){
			$datas[] = $rows;
		}
		
		return $datas;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*===== tarik data agen untuk session aplikasi =====*/
	if (strcasecmp($r, '1') == 0) {
		error_reporting(0);
		
		$p	= addslashes($p);
		
		$sql = "SELECT KDUNITPRODUKSI, a.KDKANTOR, KDJABATANAGEN, KDAREAOFFICE, b.NAMAKLIEN1 as NAMALENGKAP,
				    FOTOAGEN as AVATAR, b.EMAILTETAP, c.NAMAKANTOR, 
				    CASE WHEN c.PHONE01 IS NOT NULL AND c.PHONE02 IS NOT NULL THEN c.PHONE01 || ' / ' || c.PHONE02 
				        WHEN c.PHONE01 IS NOT NULL AND c.PHONE02 IS NULL THEN c.PHONE01 ELSE c.PHONE02 END AS PHONEKANTOR,
				    c.EMAIL AS EMAILKANTOR,
				    d.NAMAKANTOR AS NAMAINDUK,
				    CASE WHEN d.PHONE01 IS NOT NULL AND d.PHONE02 IS NOT NULL THEN d.PHONE01 || ' / ' || d.PHONE02 
				        WHEN d.PHONE01 IS NOT NULL AND d.PHONE02 IS NULL THEN d.PHONE01 ELSE d.PHONE02 END AS PHONEINDUK,
				    d.EMAIL AS EMAILINDUK, a.KDSTATUSAGEN
				FROM TABEL_400_AGEN a
				LEFT OUTER JOIN TABEL_100_KLIEN b ON a.NOAGEN = b.NOKLIEN
				LEFT OUTER JOIN TABEL_001_KANTOR c ON a.KDKANTOR = c.KDKANTOR
				LEFT OUTER JOIN TABEL_001_KANTOR d ON c.KDKANTORINDUK = d.KDKANTOR
				WHERE NOAGEN = '$p'";
		
		$DB->parse($sql);
		$DB->execute();
		$value = $DB->nextrow();
		
		// copy image from API JLINDO to API JAIM
		$save_location = "avatar/$value[AVATAR]";
		$from_location = file_get_contents(C_URL_API_JLINDO."/agen/fotoagen/".rawurlencode($value['AVATAR']));
		
		$fp = fopen($save_location, "w");
		fwrite($fp, $from_location);
		fclose($fp);
		
		echo json_encode($value);
		//echo $sql;
	}
	
	
	/*===== identitas agen =====*/
	if (strcasecmp($r, '2') == 0) {
		$p = addslashes($p);
		
		$sql = "SELECT NOAGEN, b.NAMAKLIEN1, d.NAMASTATUSAGEN, b.TEMPATLAHIR, b.TGLLAHIR, c.NAMAJABATANAGEN, 
					a.NOLISENSIAGEN, TO_CHAR(a.TGLMULAILISENSI, 'DD/MM/YYYY') AS TGLMULAILISENSI, 
					TO_CHAR(a.TGLAKHIRLISENSI, 'DD/MM/YYYY') AS TGLAKHIRLISENSI
				FROM TABEL_400_AGEN a
				INNER JOIN TABEL_100_KLIEN b ON a.NOAGEN = b.NOKLIEN
				LEFT OUTER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN
				LEFT OUTER JOIN TABEL_409_STATUS_AGEN d ON a.KDSTATUSAGEN = d.KDSTATUSAGEN
				WHERE NOAGEN = '$p'";
		
		$DB->parse($sql);
		$DB->execute();
		$value = $DB->nextrow();
		
		echo json_encode($value);
	}
	
	
	/*===== riwayat keluarga =====*/
	if (strcasecmp($r, '3') == 0) {
		$value = array();
		$p = addslashes($p);
		
		$sql = "SELECT NAMA, HUBUNGAN, TEMPAT_LAHIR, TO_CHAR(TGL_LAHIR, 'DD/MM/YYYY') AS TGLLAHIR
				FROM TABEL_420_KELUARGA_AGEN
				WHERE NOAGEN = '$p'
				ORDER BY TGL_LAHIR";
		
		$DB->parse($sql);
		$DB->execute();
		
		while ($result = $DB->nextrow()) {
			$value[] = $result;
		}

		echo json_encode($value);
	}
	
	
	/*===== pendidikan formal =====*/
	if (strcasecmp($r, '4') == 0) {
		$value = array();
		$p = addslashes($p);
		
		$sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, NAMAJENISPENDIDIKAN, KETERANGAN
				FROM TABEL_414_HISTORI_PENDIDIKAN a
				INNER JOIN TABEL_999_JENIS_PENDIDIKAN b ON a.KDJENISPENDIDIKAN = b.KDJENISPENDIDIKAN
				WHERE KDKATEGORIPENDIDIKAN = '01' AND NOAGEN = '$p'
				ORDER BY TGLMULAI DESC";
		
		$DB->parse($sql);
		$DB->execute();
		
		while ($result = $DB->nextrow()) {
			$value[] = $result;
		}

		echo json_encode($value);
	}
	
	
	/*===== pendidikan extern =====*/
	if (strcasecmp($r, '5') == 0) {
		$value = array();
		$p = addslashes($p);
		
		$sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, URAIAN AS NAMAJENISPENDIDIKAN, KETERANGAN
				FROM TABEL_414_HISTORI_PENDIDIKAN a
				INNER JOIN TABEL_999_JENIS_PENDIDIKAN b ON a.KDJENISPENDIDIKAN = b.KDJENISPENDIDIKAN
				WHERE KDKATEGORIPENDIDIKAN = '03' AND NOAGEN = '$p'
				ORDER BY a.TGLMULAI DESC";
		
		$DB->parse($sql);
		$DB->execute();
		
		while($result = $DB->nextrow()) {
			$value[] = $result;
		}
		
		echo json_encode($value);
	}
	
	
	/*===== pengalaman kerja =====*/
	if (strcasecmp($r, '6') == 0) {
		$value = array();
		$p = addslashes($p);
		
		$sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, URAIAN AS PERUSAHAAN, KETERANGAN
				FROM TABEL_415_HISTORI_KERJA a
				WHERE NOAGEN = '$p'
				ORDER BY a.TGLMULAI DESC";
		
		$DB->parse($sql);
		$DB->execute();
		
		while($result = $DB->nextrow()) {
			$value[] = $result;
		}
		
		echo json_encode($value);
	}
	
	
	/*===== prestasi =====*/
	if (strcasecmp($r, '7') == 0) {
		$value = array();
		$p = addslashes($p);
		
		$sql = "SELECT TO_CHAR(TGLJASA, 'DD/MM/YYYY') TGLJASA, URAIAN, KETERANGAN
				FROM TABEL_416_HISTORI_JASA a
				WHERE NOAGEN = '$p' AND KDJENISJASA = '1'
				ORDER BY a.TGLJASA DESC";
		
		$DB->parse($sql);
		$DB->execute();
		
		while($result = $DB->nextrow()) {
			$value[] = $result;
		}
		
		echo json_encode($value);
	}
	
	
	/*===== riwayat jabatan =====*/
	if (strcasecmp($r, '8') == 0) {
		$value = array();
		$p = addslashes($p);
		
		$sql = "SELECT TO_CHAR(a.TGLJABATAN, 'DD/MM/YYYY') TGLJABATAN, a.URAIAN, a.KETERANGAN, a.KDJABATANAGEN,
					a.KDKELASAGEN, b.NAMAJABATANAGEN, c.NAMAKELASAGEN
				FROM TABEL_417_HISTORI_JABATAN a
				INNER JOIN TABEL_413_JABATAN_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN
				INNER JOIN TABEL_408_KODE_KELAS_AGEN c ON a.KDKELASAGEN = c.KDKELASAGEN
				WHERE NOAGEN = '$p'
				ORDER BY a.TGLJABATAN DESC";
		
		$DB->parse($sql);
		$DB->execute();
		
		while($result = $DB->nextrow()) {
			$value[] = $result;
		}
		
		echo json_encode($value);
	}

	
	/*===== tarik data kancab & kanwil untuk session aplikasi =====*/
	if (strcasecmp($r, '9') == 0) {
		error_reporting(0);
		
		$p	= addslashes($p);
		
		$sql = "SELECT a.NAMAKANTOR, 
					CASE WHEN a.PHONE01 IS NOT NULL AND a.PHONE02 IS NOT NULL THEN a.PHONE01 || ' / ' || a.PHONE02 
						 WHEN a.PHONE01 IS NOT NULL AND a.PHONE02 IS NULL THEN a.PHONE01 ELSE a.PHONE02 
					END AS PHONEKANTOR, a.EMAIL AS EMAILKANTOR, b.NAMAKANTOR AS NAMAINDUK, 
					CASE WHEN b.PHONE01 IS NOT NULL AND b.PHONE02 IS NOT NULL THEN b.PHONE01 || ' / ' || b.PHONE02 
						 WHEN b.PHONE01 IS NOT NULL AND b.PHONE02 IS NULL THEN b.PHONE01 ELSE b.PHONE02 
					END AS PHONEINDUK, b.EMAIL AS EMAILINDUK,
					'' KDSTATUSAGEN, c.NAMALENGKAP, '' KDJABATANAGEN, a.KDKANTOR, '' KDAREAOFFICE,
					'' KDUNITPRODUKSI, c.AVATAR, a.EMAIL EMAILTETAP
				FROM TABEL_001_KANTOR a 
				LEFT OUTER JOIN TABEL_001_KANTOR b ON a.KDKANTORINDUK = b.KDKANTOR 
				LEFT OUTER JOIN JAIM_900_USER@JAIM c ON a.KDKANTOR = c.USERNAME
				WHERE a.KDKANTOR = '$p' ";
		
		$DB->parse($sql);
		$DB->execute();
		$value = $DB->nextrow();
		
		echo json_encode($value);
		//echo $sql;
	}
?>