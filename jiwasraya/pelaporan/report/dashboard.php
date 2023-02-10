<? 
	//include "../../includes/session.php"; 
	include "../../includes/database.php";
	$DB = new database($DBUser, $DBPass, $DBName);
	$DBD = new database($DBUser, $DBPass, $DBName);

	$data_0 = array();
	$tahun  = date('Y');
	$months = array('01','02','03','04','05','06','07','08','09','10','11','12');
	foreach ($months as $bln) {
		$sql_b = "SELECT COUNT(NOPERTANGGUNGAN) AS JML_POLIS
					FROM $DBUser.TABEL_200_PERTANGGUNGAN
					WHERE KDPERTANGGUNGAN ='2'
						AND KDSTATUSEMAIL = '1'
						--AND KDSTATUSFILE = '1'
						AND TO_CHAR(MULAS, 'MM/YYYY') = '".$bln."/".$tahun."'";
		$DB->parse($sql_b);
		$DB->execute();
		while ($arr_b=$DB->nextrow()){
			$array_0 = array(
				'date' 	=> $tahun.'-'.$bln,
				'value' => $arr_b['JML_POLIS']
			);
			$data_0[] = $array_0;
		}
	}
	$data_0_final = json_encode($data_0);

	$sql = "SELECT DISTINCT(X.JABATAN_TTD) AS REGIONAL,
				SUBSTR(X.JABATAN_TTD, 0, 5) AS RAYON,
			    (
			        SELECT COUNT(A.NOPERTANGGUNGAN)
			        FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
			            $DBUser.TABEL_500_PENAGIH B,
			            $DBUser.TABEL_001_KANTOR C,
			            $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
			        WHERE A.NOPENAGIH = B.NOPENAGIH
			            AND B.KDRAYONPENAGIH = C.KDKANTOR
			            AND C.KDKANTOR = D.KODE_KANTOR
			            AND D.JABATAN_TTD = X.JABATAN_TTD
			            AND D.JABATAN_AGEN = '00'
			            AND A.KDPERTANGGUNGAN ='2'
			            --AND A.KDSTATUSFILE = '1'
			            AND A.KDSTATUSEMAIL = '1' 
			            AND TO_CHAR(A.MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
			    ) JUMLAH,
			    (
			        SELECT SUM(PREMI1)
			        FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
			            $DBUser.TABEL_500_PENAGIH B,
			            $DBUser.TABEL_001_KANTOR C,
			            $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
			        WHERE A.NOPENAGIH = B.NOPENAGIH
			            AND B.KDRAYONPENAGIH = C.KDKANTOR
			            AND C.KDKANTOR = D.KODE_KANTOR
			            AND D.JABATAN_TTD = X.JABATAN_TTD
			            AND D.JABATAN_AGEN = '00'
			            AND A.KDPERTANGGUNGAN ='2'
			            --AND A.KDSTATUSFILE = '1' 
			            AND A.KDSTATUSEMAIL = '1' 
			            AND TO_CHAR(A.MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
			    ) PREMI,
			    (
                    SELECT 
                        SUM(
                              CASE
                                  WHEN A.KDCARABAYAR = 'M' THEN A.PREMI1 * 12
                                  WHEN A.KDCARABAYAR = 'Q' OR A.KDCARABAYAR = 'K' THEN A.PREMI1 * 4
                                  WHEN A.KDCARABAYAR = 'H' THEN A.PREMI1 * 2
                                  WHEN A.KDCARABAYAR = 'A' THEN A.PREMI1 * 1
                                  WHEN A.KDCARABAYAR = 'X' THEN A.PREMI1 * 0.1
                              END
                         )
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '2'
                        --AND A.KDSTATUSFILE = '1'  
                        AND A.KDSTATUSEMAIL = '1' 
                        AND TO_CHAR(A.MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
                ) ANP_LUNAS
			FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ X
			WHERE X.JABATAN_AGEN = '00'
			ORDER BY RAYON DESC";
	$DB->parse($sql);
	$DB->execute();
	$data_1 = array();
	$polis_total = 0;
	$premi_lunas_total = 0;
	$anp_lunas_total = 0;
	while ($arr_l=$DB->nextrow()){
		$array_1 = array(
					'rayon_1' 	=> $arr_l['RAYON'],
					'jumlah_1' 	=> $arr_l['JUMLAH']
				);
		$data_1[] = $array_1;

		$polis_total = $polis_total + $arr_l['JUMLAH'];
		$premi_lunas_total = $premi_lunas_total + $arr_l['PREMI'];
		$anp_lunas_total = $anp_lunas_total + $arr_l['ANP_LUNAS'];
	}
	$data_1_final = json_encode($data_1);

	if ($submit) {
	 	// echo "RAYON : ".$rayon_cari."</br>";
	 	// echo "PERIODE : ".$bulan_cari."</br>";
	 	if($bulan_cari == ''){
	 		$sendemail = "AND TO_CHAR(A.TGLSENDEMAIL, 'YYYY') = '$tahun_cari'";
	 	}else{
	 		$sendemail = "AND TO_CHAR(A.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'";
	 	}
	 	//echo $sendemail;
	 	$sql = "SELECT DISTINCT(X.JABATAN_TTD) AS REGIONAL,
                 SUBSTR(X.JABATAN_TTD, 0, 5) AS RAYON,
                (
                    SELECT SUM (CASE
                                    WHEN A.KDSTATUSFILE = '7' AND E.NOPERTANGGUNGAN IS NULL THEN 0
                                    ELSE 1
                                END)
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        INNER JOIN $DBUser.TABEL_500_PENAGIH B ON A.NOPENAGIH = B.NOPENAGIH
                        INNER JOIN $DBUser.TABEL_001_KANTOR C ON B.KDRAYONPENAGIH = C.KDKANTOR
                        INNER JOIN $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D ON C.KDKANTOR = D.KODE_KANTOR
                        LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL E ON E.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND E.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
                    WHERE D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDSTATUSEMAIL = '1'
                        ".$sendemail."
                ) PROPOSAL,
                (
                    SELECT SUM (CASE
                                    WHEN A.KDSTATUSFILE = '7' AND E.NOPERTANGGUNGAN IS NULL THEN 0
                                    ELSE A.PREMI1
                                END)
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        INNER JOIN $DBUser.TABEL_500_PENAGIH B ON A.NOPENAGIH = B.NOPENAGIH
                        INNER JOIN $DBUser.TABEL_001_KANTOR C ON B.KDRAYONPENAGIH = C.KDKANTOR
                        INNER JOIN $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D ON C.KDKANTOR = D.KODE_KANTOR
                        LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL E ON E.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND E.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
                    WHERE D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDSTATUSEMAIL = '1'
                        ".$sendemail."
                ) POTENSI_PREMI,
                (
                    SELECT 
                        SUM (
                            CASE
                                WHEN A.KDSTATUSFILE = '7' AND E.NOPERTANGGUNGAN IS NULL THEN 0
                                ELSE (
                                        CASE
                                            WHEN A.KDCARABAYAR = 'M' THEN A.PREMI1 * 12
                                            WHEN A.KDCARABAYAR = 'Q' OR A.KDCARABAYAR = 'K' THEN A.PREMI1 * 4
                                            WHEN A.KDCARABAYAR = 'H' THEN A.PREMI1 * 2
                                            WHEN A.KDCARABAYAR = 'A' THEN A.PREMI1 * 1
                                            WHEN A.KDCARABAYAR = 'X' THEN A.PREMI1 * 0.1
                                        END
                                    )
                            END
                        )
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        INNER JOIN $DBUser.TABEL_500_PENAGIH B ON A.NOPENAGIH = B.NOPENAGIH
                        INNER JOIN $DBUser.TABEL_001_KANTOR C ON B.KDRAYONPENAGIH = C.KDKANTOR
                        INNER JOIN $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D ON C.KDKANTOR = D.KODE_KANTOR
                        LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL E ON E.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND E.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
                    WHERE D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDSTATUSEMAIL = '1'
                        ".$sendemail."
                ) POTENSI_ANP,
                (
                    SELECT COUNT(A.NOPOL) 
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '1'
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                        AND A.KDSTATUSFILE != '7'
                        AND A.SUSPEND IS NULL
                        AND A.KETERANGAN IS NULL
                        AND A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN NOT IN (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL)
                ) WAITING,
                (
                    SELECT COUNT(A.NOPOL) 
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '1'
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                        AND A.KDSTATUSFILE != '7'
                        AND A.SUSPEND = '1'
                        AND A.KETERANGAN IS NOT NULL
                ) PENDING,
                (
                    SELECT COUNT(A.NOPOL) 
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D,
                        $DBUser.TABEL_214_APPROVAL_PROPOSAL E
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND A.PREFIXPERTANGGUNGAN = E.PREFIXPERTANGGUNGAN 
                        AND A.NOPERTANGGUNGAN = E.NOPERTANGGUNGAN 
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '1'
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                        AND A.KDSTATUSFILE != '7'
                ) APPROVE,
                (
                    SELECT COUNT(A.NOPOL)
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '2'
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                        --AND A.KDSTATUSFILE != '7'
                ) BAYAR,
                (
                    SELECT COUNT (A.NOPOL)
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D,
                        $DBUser.TABEL_214_APPROVAL_PROPOSAL E
                       WHERE     A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND A.PREFIXPERTANGGUNGAN = E.PREFIXPERTANGGUNGAN
                        AND A.NOPERTANGGUNGAN = E.NOPERTANGGUNGAN
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '1'
                        AND A.KDSTATUSEMAIL = '1'
                        ".$sendemail."
                        AND A.KDSTATUSFILE = '7' 
                ) BATAL,
                (
                    SELECT SUM(A.PREMI1)
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '2'
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                ) LUNAS,
                (
                    SELECT 
                        SUM (
                            CASE
                                WHEN A.KDSTATUSFILE = '7'  THEN 0
                                ELSE A.PREMI1
                            END
                        )
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        INNER JOIN $DBUser.TABEL_500_PENAGIH B ON A.NOPENAGIH = B.NOPENAGIH
                        INNER JOIN $DBUser.TABEL_001_KANTOR C ON B.KDRAYONPENAGIH = C.KDKANTOR
                        INNER JOIN $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D ON C.KDKANTOR = D.KODE_KANTOR
                        LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL E ON E.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND E.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
                    WHERE D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '1'
                        AND A.KDSTATUSEMAIL = '1'
                        ".$sendemail."
                ) PREMI_BELUMLUNAS,
                ( 
                    SELECT SUM(A.PREMI1) 
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A, 
                        $DBUser.TABEL_500_PENAGIH B, 
                        $DBUser.TABEL_001_KANTOR C, 
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D, 
                        $DBUser.TABEL_214_APPROVAL_PROPOSAL E 
                    WHERE A.NOPENAGIH = B.NOPENAGIH 
                        AND B.KDRAYONPENAGIH = C.KDKANTOR 
                        AND C.KDKANTOR = D.KODE_KANTOR 
                        AND A.PREFIXPERTANGGUNGAN = E.PREFIXPERTANGGUNGAN
                        AND A.NOPERTANGGUNGAN = E.NOPERTANGGUNGAN
                        AND D.JABATAN_TTD = X.JABATAN_TTD 
                        AND D.JABATAN_AGEN = '00' 
                        AND A.KDPERTANGGUNGAN = '1' 
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail." 
                        AND A.KDSTATUSFILE = '7' 
                ) PREMI_BATAL, 
                (
                    SELECT 
                        SUM(
                              CASE
                                  WHEN A.KDCARABAYAR = 'M' THEN A.PREMI1 * 12
                                  WHEN A.KDCARABAYAR = 'Q' OR A.KDCARABAYAR = 'K' THEN A.PREMI1 * 4
                                  WHEN A.KDCARABAYAR = 'H' THEN A.PREMI1 * 2
                                  WHEN A.KDCARABAYAR = 'A' THEN A.PREMI1 * 1
                                  WHEN A.KDCARABAYAR = 'X' THEN A.PREMI1 * 0.1
                              END
                         )
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
                        $DBUser.TABEL_500_PENAGIH B,
                        $DBUser.TABEL_001_KANTOR C,
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D
                    WHERE A.NOPENAGIH = B.NOPENAGIH
                        AND B.KDRAYONPENAGIH = C.KDKANTOR
                        AND C.KDKANTOR = D.KODE_KANTOR
                        AND D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '2'
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                        --AND A.KDSTATUSFILE != '7'
                ) ANP_LUNAS,
                (
                    SELECT 
                        SUM (
                            CASE
                                WHEN A.KDSTATUSFILE = '7' THEN 0
                                ELSE (
                                        CASE
                                            WHEN A.KDCARABAYAR = 'M' THEN A.PREMI1 * 12
                                            WHEN A.KDCARABAYAR = 'Q' OR A.KDCARABAYAR = 'K' THEN A.PREMI1 * 4
                                            WHEN A.KDCARABAYAR = 'H' THEN A.PREMI1 * 2
                                            WHEN A.KDCARABAYAR = 'A' THEN A.PREMI1 * 1
                                            WHEN A.KDCARABAYAR = 'X' THEN A.PREMI1 * 0.1
                                        END
                                    )
                            END
                        )
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A
                        INNER JOIN $DBUser.TABEL_500_PENAGIH B ON A.NOPENAGIH = B.NOPENAGIH
                        INNER JOIN $DBUser.TABEL_001_KANTOR C ON B.KDRAYONPENAGIH = C.KDKANTOR
                        INNER JOIN $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D ON C.KDKANTOR = D.KODE_KANTOR
                        LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL E ON E.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND E.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
                    WHERE D.JABATAN_TTD = X.JABATAN_TTD
                        AND D.JABATAN_AGEN = '00'
                        AND A.KDPERTANGGUNGAN = '1'
                        AND A.KDSTATUSEMAIL = '1'
                        ".$sendemail."
                ) ANP_BELUMLUNAS,
                ( 
                    SELECT 
                        SUM( 
                            CASE 
                                WHEN A.KDCARABAYAR = 'M' THEN A.PREMI1 * 12 
                                WHEN A.KDCARABAYAR = 'Q' OR A.KDCARABAYAR = 'K' THEN A.PREMI1 * 4 
                                WHEN A.KDCARABAYAR = 'H' THEN A.PREMI1 * 2 
                                WHEN A.KDCARABAYAR = 'A' THEN A.PREMI1 * 1 
                                WHEN A.KDCARABAYAR = 'X' THEN A.PREMI1 * 0.1 
                            END 
                        ) 
                    FROM $DBUser.TABEL_200_PERTANGGUNGAN A, 
                        $DBUser.TABEL_500_PENAGIH B, 
                        $DBUser.TABEL_001_KANTOR C, 
                        $DBUser.TABEL_400_PENANDATANGANAN_PKAJ D,
                        $DBUser.TABEL_214_APPROVAL_PROPOSAL E
                    WHERE A.NOPENAGIH = B.NOPENAGIH 
                        AND B.KDRAYONPENAGIH = C.KDKANTOR 
                        AND C.KDKANTOR = D.KODE_KANTOR 
                        AND A.PREFIXPERTANGGUNGAN = E.PREFIXPERTANGGUNGAN
                        AND A.NOPERTANGGUNGAN = E.NOPERTANGGUNGAN
                        AND D.JABATAN_TTD = X.JABATAN_TTD 
                        AND D.JABATAN_AGEN = '00' 
                        AND A.KDPERTANGGUNGAN = '1' 
                        AND A.KDSTATUSEMAIL = '1' 
                        ".$sendemail."
                        AND A.KDSTATUSFILE = '7' 
                ) ANP_BATAL
            FROM $DBUser.TABEL_400_PENANDATANGANAN_PKAJ X
            WHERE X.JABATAN_AGEN = '00'
            	--AND X.JABATAN_TTD = '".$rayon_cari."'
            ORDER BY RAYON DESC";
        // echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		$data_2 = array();
		$data_3 = array();
		$data_4 = array();
		$data_5 = array();

		$proposal_perrayon_final = 0;
		$proposal_total = 0;

		$potensi_premi_perrayon_final = 0;
		$potensi_premi_total = 0;
		
        $potensi_anp_perrayon_final = 0;
		$potensi_anp_total = 0;

		$proposal_proses = 0;
		$proposal_pending_final = 0;
		$proposal_waiting_final = 0;
		$proposal_approve_final = 0;
		$proposal_bayar_final = 0;
        $proposal_belumbayar_final = 0;
        $proposal_batal_final = 0;

		$premi_lunas_perrayon_final = 0;
		$premi_belumlunas_perrayon_final = 0;
        $premi_batal_perrayon_final = 0;

		$anp_lunas_perrayon_final = 0;
		$anp_belumlunas_perrayon_final = 0;
        $anp_batal_perrayon_final = 0;

		while ($arr_l=$DB->nextrow()){
			if($rayon_cari == $arr_l['REGIONAL']){
				$proposal_perrayon 	= $arr_l['PROPOSAL'];
				
                $potensi_premi 		= $arr_l['POTENSI_PREMI'];
				$potensi_anp 		= $arr_l['POTENSI_ANP'];
				
                $proposal_pending 	= $arr_l['PENDING'];
				$proposal_waiting 	= $arr_l['WAITING'];
				$proposal_approve 	= $arr_l['APPROVE'];
				$proposal_bayar 	= $arr_l['BAYAR'];
                $proposal_batal     = $arr_l['BATAL'];
				
                $premi_lunas 		= $arr_l['LUNAS'];
                $premi_belumlunas   = $arr_l['PREMI_BELUMLUNAS'];
                $premi_batal        = $arr_l['PREMI_BATAL'];

				$anp_lunas 			= $arr_l['ANP_LUNAS'];
				$anp_belumlunas 	= $arr_l['ANP_BELUMLUNAS'];
                $anp_batal          = $arr_l['ANP_BATAL'];

			}else{
				$proposal_perrayon 	= 0;

				$potensi_premi 		= 0;
				$potensi_anp 		= 0;

				$proposal_pending 	= 0;
				$proposal_waiting 	= 0;
				$proposal_approve 	= 0;
				$proposal_bayar 	= 0;
                $proposal_batal     = 0;

				$premi_lunas 		= 0;
                $premi_belumlunas   = 0;
                $premi_batal        = 0;

				$anp_lunas 			= 0;
				$anp_belumlunas 	= 0;
                $anp_batal          = 0;
			}
			$proposal_perrayon_final             = $proposal_perrayon_final + $proposal_perrayon;
			$proposal_total                      = $proposal_total + $arr_l['PROPOSAL'];

			$potensi_premi_perrayon_final        = $potensi_premi_perrayon_final + $potensi_premi;
			$potensi_premi_total 			     = $potensi_premi_total + $arr_l['POTENSI_PREMI'];

			$potensi_anp_perrayon_final          = $potensi_anp_perrayon_final + $potensi_anp;
			$potensi_anp_total                   = $potensi_anp_total + $arr_l['POTENSI_ANP'];

			$proposal_proses                     = $proposal_proses + $proposal_pending + $proposal_waiting;
			$proposal_belum_proses               = $proposal_total - $proposal_proses;
			
			$proposal_pending_final              = $proposal_pending_final + $proposal_pending;
			$proposal_waiting_final              = $proposal_waiting_final + $proposal_waiting;

            /* Mencatat semua proposal yang sudah diapprove baik status aktif atau sudah delete otomatis */
			$proposal_approve_final              = $proposal_approve_final + $proposal_approve + $proposal_bayar + $proposal_batal;

			$proposal_bayar_final                = $proposal_bayar_final + $proposal_bayar;
			$proposal_belumbayar_final           = $proposal_belumbayar_final + $proposal_approve;
            $proposal_batal_final                = $proposal_batal_final + $proposal_batal;

			$premi_lunas_perrayon_final 	     = $premi_lunas_perrayon_final + $premi_lunas;
            $premi_belumlunas_perrayon_final     = $premi_belumlunas_perrayon_final + $premi_belumlunas;
            $premi_batal_perrayon_final          = $premi_batal_perrayon_final + $premi_batal;

			$anp_lunas_perrayon_final 		     = $anp_lunas_perrayon_final + $anp_lunas;
			$anp_belumlunas_perrayon_final 	     = $anp_belumlunas_perrayon_final + $anp_belumlunas;
            $anp_batal_perrayon_final            = $anp_batal_perrayon_final + $anp_batal;
		}

		/* Simpan Data untuk grafik 2 */
		if($proposal_perrayon_final == 0){
            $percentase_proses  = 0;
        }else{
            $percentase_proses  = number_format((($proposal_proses/$proposal_perrayon_final)*100),1);
        }

		$data_2[] 	= array('jenis_2' => 'PROCESS',
					'jumlah_2' 	=> $proposal_proses,
					'color_2' => '#FE2E2E');
		$data_2[]	= array('jenis_2' => 'DONE',
					'jumlah_2' 	=> $proposal_belum_proses,
					'color_2' => '#E6E6E6');
		$data_2_final = json_encode($data_2);
		/* End grafik 2 */

		/* Simpan Data untuk grafik 3 */
		$data_3[] 	= array('jenis_3' => 'WAITING',
					'jumlah_3' 	=> $proposal_waiting_final,
					'color_3' => '#FE9A2E');
		$data_3[]	= array('jenis_3' => 'PENDING',
					'jumlah_3' 	=> $proposal_pending_final,
					'color_3' => '#FE2E2E');
		$data_3_final = json_encode($data_3);
		/* End grafik 3 */

		/* Simpan Data untuk grafik 4 */
        if($proposal_perrayon_final == 0){
            $percentase_approve = 0;
        }else{
            $percentase_approve = number_format((($proposal_approve_final/$proposal_perrayon_final)*100),1);
        }
		$data_4[] 	= array('jenis_4' => 'APPROVE',
					'jumlah_4' 	=> $proposal_approve_final,
					'color_4' => '#3ADF00');
		$data_4[]	= array('jenis_4' => 'PROCESS',
					'jumlah_4' 	=> $proposal_proses,
					'color_4' => '#E6E6E6');
		$data_4_final = json_encode($data_4);
		/* End grafik 4 */

		/* Simpan Data untuk grafik 5 */
		$data_5[]	= array('jenis_5' => 'BELUM LUNAS',
					'jumlah_5' 	=> $proposal_belumbayar_final,
					'color_5' => '#FE9A2E');
		$data_5[] 	= array('jenis_5' => 'LUNAS',
					'jumlah_5' 	=> $proposal_bayar_final,
					'color_5' => '#3ADF00');
		$data_5_final = json_encode($data_5);
		/* End grafik 5 */

	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>DASHBOARD</title>

		<script type="text/javascript" src="../../includes/js/chart/core.js"></script>
		<script type="text/javascript" src="../../includes/js/chart/charts.js"></script>
		<script type="text/javascript" src="../../includes/js/chart/animated.js"></script>
        <script type="text/javascript" src="../../includes/js/chart/jquery-2.2.1.min.js"></script>

		<style type="text/css">
            .preloader {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              z-index: 9999;
              background-color: #fff;
            }
            .preloader .loading {
              position: absolute;
              left: 50%;
              top: 50%;
              transform: translate(-50%,-50%);
              font: 14px arial;
            }

			.kolom {
                height: 450px;
                width: 260px;
                margin-bottom: 30px;
                float: left;
                margin-right: 20px;
                text-align: center;
            }

            .kolom2 {
                width: 280px;   
            }

            .kolom3 {
                width: 380px;
                float: left;
                text-align: center;
            }

            .kolom4 {
                width: 450px;
                float: left;
                text-align: center;
            }

            .kolom5 {
                width: 1000px;
                float: left;
                text-align: center;
            }

            .kolom6 {
                height: 200px;
                width: 260px;
                margin-top: 10%;
                float: left;
            }

            body, html {
                height: 100%;
                width: 100%;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            }

            h1 {
                color:#045FB4;
                font-size: 44px;
                font-family: Trebuchet MS;
            }

            small{
                font-size: 14px;
                color: #000000;
            }

            #chartdiv {
                width: 100%;
                height: 300px;
                padding-top: 10%;
                padding-left: 20px;
                margin-bottom: 15px;
            }
            
            #chartline {
                width: 100%;
                height: 400px;
            }

            #chartprocess_1 {
                width: 100%;
                height: 300px;
            }

            #chartapprove {
                width: 100%;
                height: 300px;
            }

            #chartprocess_2{
                width: 100%;
                height: 300px;
                padding-top: 10%;
                border-radius: 30px;
                border-style: solid;
                border-color: #3c8dbc;
            }

            #chartpelunasan{
                width: 100%;
                height: 300px;
                padding-top: 10%;
                border-radius: 30px;
                border-style: solid;
                border-color: #3c8dbc;
                margin-bottom: 15px;
            }

			tr.border_bottom td {
				border-bottom:1pt solid black;
				/*text-align: center;*/
			}
		</style>
	</head>

	<body>
        <div class="preloader">
            <div class="loading">
                <img src="../../images/Poi.gif" width="80">
                <p>Harap Tunggu</p>
            </div>
        </div>
		<div class="header" style="text-align: center;">
            <h1>DASHBOARD</h1>
            <div class="kolom5">
                <div id="chartline"></div>
            </div>
            <div class="kolom6">
                <table style="text-align: left; width: 100%; font-size: 16px; font-style: italic;" >
                    <tr>
                        <td colspan="2" style="border-bottom-style: solid; font-size: 28px;">Portofolio</br>Tahun 2020</td>
                    </tr>
                    <tr>
                        <td width="25%">Total Polis</td>
                        <td width="75%">: <b><?php echo (number_format($polis_total,0,',','.'));?></b></td>
                    </tr>
                    <tr>
                        <td>Total Premi</td>
                        <td>: <b><?php echo "Rp. ".(number_format($premi_lunas_total,0,',','.'));?></b></td>
                    </tr>
                    <tr>
                        <td>ANP</td>
                        <td>: <b><?php echo "Rp. ".(number_format($anp_lunas_total,0,',','.'));?></b></td>
                    </tr>
            </table>
            </div>
            <div class="kolom kolom4">
                <div id="chartdiv"></div>
            </div>
        </div>
		<div id="header" style="height: 70px;width:100%;background-color: #F2F2F2; margin-bottom: 40px; float: left;">
			<form name="prop" action="" method="get">
				<table>
					<tr align="left">
						<td width="45%"><h3>PRODUCTION TRACKING</h3></td>
						<td>Regional Agency Head : </td>
						<td width="10%">
							<select class="form-control" name="rayon_cari" id="rayon_cari">
								<option value="EAST REGIONAL AGENCY HEAD" selected>EAST</option>
								<option value="WEST REGIONAL AGENCY HEAD">WEST</option>
								<option value="SOUTH REGIONAL AGENCY HEAD">SOUTH</option>
							</select>
						</td>
						<td>Periode :</td>
						<td>
							<select class="form-control" name="bulan_cari" id="bulan_cari">
								<option value="">All</option>
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="tahun_cari" id="tahun_cari">
								<option value="2019">2019</option>
								<option value="2020" selected>2020</option>
								<option value="2021">2021</option>
							</select>
						</td>
						<td width="10%" align="right">
							<input type="submit" value="SEARCH" name="submit"> 
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="header">
			<div class="kolom">
				<label>
					<b><i>Tracking</b></i>
				</label>
				<h1><?php echo(substr($rayon_cari,0,5));?></h1>
				<label>
					Periode : 
							<?php 
								if($bulan_cari == ''){
									echo $tahun_cari;
								}else{
									echo $bulan_cari."/".$tahun_cari;
								}
							?>
				</label></br></br>
				<b><i>Proposal</b></i>
				<h1><?php echo $proposal_perrayon_final;?><small> / <?=$proposal_total;?></small></h1>
				<h4><i>Potensi Premi : </i></h4>
				<h4><?php echo "Rp. ".(number_format($potensi_premi_perrayon_final,0,',','.'));?><small style="font-size:12px"> / <?php echo "Rp. ".(number_format($potensi_premi_total,0,',','.'));?></small></h4>
				<h4><i>Potensi ANP : </i></h4>
				<h4><?php echo "Rp. ".(number_format($potensi_anp_perrayon_final,0,',','.'));?><small style="font-size:12px"> / <?php echo "Rp. ".(number_format($potensi_anp_total,0,',','.'));?></small></h4>

			</div>
		</div>

		<div class="header">
			<div class="kolom kolom2">
				<label>
					<b><i>On Process</b></i>
				</label></br>
				<h1><?php echo $proposal_proses;?><small> / <?=$proposal_perrayon_final;?></small></h1>
				<div id="chartprocess_1"></div>
			</div>

			<div class="kolom kolom3">
				<div id="chartprocess_2"></div>
			</div>
		</div>

		<div class="header">
			<div class="kolom kolom2">
				<label>
					<b><i>Approve</b></i>
				</label></br>
				<h1><?php echo $proposal_approve_final;?><small> / <?=$proposal_perrayon_final;?></small></h1>
				<div id="chartapprove"></div>
			</div>
			<div class="kolom kolom4" style="margin-bottom: 60px;">
				<div id="chartpelunasan"></div>
				<table style="text-align: left; width: 100%; font-size: 12px; font-style: italic;" >
                    <tr align="center">
                        <td colspan="5">Lunas : <a target="_blank" href="http://192.168.2.23/jiwasraya/pelaporan/report/detail_dashboard.php?rayon_cari=<?=$rayon_cari;?>&bulan_cari=<?=$bulan_cari;?>&tahun_cari=<?=$tahun_cari;?>&jenis_cari=LUNAS"><?=$proposal_bayar_final;?></a></td>
                    </tr>
                        <tr align="center">
                    <td colspan="5">Premi : <?php echo "Rp. ".(number_format($premi_lunas_perrayon_final,0,',','.'));?></td>
                        </tr>
                    <tr align="center">
                        <td colspan="5">ANP : <?php echo "Rp. ".(number_format($anp_lunas_perrayon_final,0,',','.'));?></td>
                    </tr>

                    <tr>
                        <td width="15%">Belum Lunas</td>
                        <td width="25%">: <a target="_blank" href="http://192.168.2.23/jiwasraya/pelaporan/report/detail_dashboard.php?rayon_cari=<?=$rayon_cari;?>&bulan_cari=<?=$bulan_cari;?>&tahun_cari=<?=$tahun_cari;?>&jenis_cari=BELUM_LUNAS"><?=$proposal_belumbayar_final;?></a></td>
                        <td></td>
                        <td width="20%" style="color: red;">Batal</td>
                        <td width="25%">: <a target="_blank" href="http://192.168.2.23/jiwasraya/pelaporan/report/detail_dashboard.php?rayon_cari=<?=$rayon_cari;?>&bulan_cari=<?=$bulan_cari;?>&tahun_cari=<?=$tahun_cari;?>&jenis_cari=BATAL" style="color: red;"><?=$proposal_batal_final;?></a></td>
                    </tr>
                    <tr>
                        <td style="border-bottom-style: solid;">
                            GAP Premi
                        </td>
                        <td style="border-bottom-style: solid;">
                            : <?php echo "Rp. ".(number_format($premi_belumlunas_perrayon_final,0,',','.')); ?>
                        </td>
                        <td></td>
                        <td style="border-bottom-style: solid;">
                            <font style="color: red;">GAP Premi</font>
                        </td>
                        <td style="border-bottom-style: solid;">
                            <font style="color: red;">: <?php echo "Rp. ".(number_format($premi_batal_perrayon_final,0,',','.')); ?></font>
                        </td>
                    </tr>
                    <tr>
                        <td>GAP ANP</td>
                        <td>: <?php echo "Rp. ".(number_format($anp_belumlunas_perrayon_final,0,',','.')); ?></td>
                        <td></td>
                        <td style="color: red;">GAP ANP</td>
                        <td style="color: red;">: <?php echo "Rp. ".(number_format($anp_batal_perrayon_final,0,',','.')); ?></td>
                    </tr>
                </table>
			</div>
		</div>

		<div class="header2">
			<table style="width: 80%; margin-left: 10%;border-collapse: collapse;">
				<tr bgcolor="#89acd8" align="center" height="50px">
					<th>No</th>
                    <th>Rayon RAH</th>
                    <th>Rayon</th>
                    <th>Nama SAM</th>
                    <th>Kantor</th>
                    <th>Proposal</th>
                    <th>Waiting</th>
                    <th>Pending</th>
                    <th>Approve</th>
                    <th>Lunas</th>
                    <th>Batal</th>
                    <th>Potensi Premi</th>
                    <th>Potensi ANP</th>
                    <th>Lunas</th>
                    <th>ANP Lunas</th>
                    <th>GAP ANP (Belum Lunas)</th>
                    <th>GAP ANP (Batal)</th>
				</tr>

				<?php
					$i = 1;
					$sql_d = "SELECT  
				                  SUBSTR(C.JABATAN_TTD, 0, 5) AS RAYON,
				                  A.KDKANTOR,
				                  'SAM ' || SUBSTR(A.NAMAKANTOR, 23) KANTOR, 
				                  B.NO_SAM,
				                  (SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = B.NO_SAM) NM_SAM,
                                  (
                                      SELECT 
                                          SUM 
                                            (CASE
                                                WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                                ELSE 1
                                            END)
                                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
                                          AND X.KDSTATUSEMAIL = '1'
                                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
                                  ) PROPOSAL,
				                  (
				                      SELECT 
				                          COUNT(NOPOL) 
				                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
				                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
				                          AND KDPERTANGGUNGAN = '1' 
				                          AND KDSTATUSEMAIL = '1' 
				                          AND TO_CHAR(TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
				                          AND KDSTATUSFILE != '7'
				                          AND SUSPEND IS NULL
				                          AND KETERANGAN IS NULL
				                          AND PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN NOT IN (SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN FROM $DBUser.TABEL_214_APPROVAL_PROPOSAL)
				                  ) WAITING,
				                  (
				                      SELECT 
				                          COUNT(NOPOL) 
				                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
				                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
				                          AND KDPERTANGGUNGAN = '1' 
				                          AND KDSTATUSEMAIL = '1' 
				                          AND TO_CHAR(TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
				                          AND SUSPEND = '1'
				                          AND KETERANGAN IS NOT NULL
				                          AND KDSTATUSFILE != '7'
				                  ) PENDING,
				                  (
				                      SELECT 
				                          COUNT(X.NOPOL) 
				                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X, $DBUser.TABEL_214_APPROVAL_PROPOSAL Y
				                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
				                          AND X.PREFIXPERTANGGUNGAN = Y.PREFIXPERTANGGUNGAN AND X.NOPERTANGGUNGAN = Y.NOPERTANGGUNGAN 
				                          AND X.KDPERTANGGUNGAN = '1' 
				                          AND X.KDSTATUSEMAIL = '1' 
				                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
				                          AND X.KDSTATUSFILE != '7'
				                  ) APPROVE,
				                  (
				                      SELECT 
				                          COUNT(NOPOL) 
				                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
				                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
				                          AND KDPERTANGGUNGAN = '2' 
				                          AND KDSTATUSEMAIL = '1' 
				                          AND TO_CHAR(TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
				                          AND KDSTATUSFILE != '7'
				                  ) BAYAR,
                                  (
                                      SELECT 
                                          COUNT(X.NOPOL) 
                                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X, $DBUser.TABEL_214_APPROVAL_PROPOSAL Y
                                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
                                          AND X.PREFIXPERTANGGUNGAN = Y.PREFIXPERTANGGUNGAN AND X.NOPERTANGGUNGAN = Y.NOPERTANGGUNGAN 
                                          AND X.KDPERTANGGUNGAN = '1' 
                                          AND X.KDSTATUSEMAIL = '1' 
                                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
                                          AND X.KDSTATUSFILE = '7'
                                  ) BATAL,
                                  (
                                      SELECT 
                                          SUM 
                                            (CASE
                                                WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                                ELSE PREMI1
                                            END)
                                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR  
                                          AND X.KDSTATUSEMAIL = '1' 
                                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
                                  ) POTENSI_PREMI,
                                  (
                                      SELECT
                                          SUM 
                                            (CASE
                                                WHEN X.KDSTATUSFILE = '7' AND Y.NOPERTANGGUNGAN IS NULL THEN 0
                                                ELSE (
                                                    CASE
                                                        WHEN X.KDCARABAYAR = 'M' THEN X.PREMI1 * 12
                                                        WHEN X.KDCARABAYAR = 'Q' OR X.KDCARABAYAR = 'K' THEN X.PREMI1 * 4
                                                        WHEN X.KDCARABAYAR = 'H' THEN X.PREMI1 * 2
                                                        WHEN X.KDCARABAYAR = 'A' THEN X.PREMI1 * 1
                                                        WHEN X.KDCARABAYAR = 'X' THEN X.PREMI1 * 0.1
                                                    END
                                                )
                                            END)
                                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X
                                      LEFT OUTER JOIN $DBUser.TABEL_214_APPROVAL_PROPOSAL Y ON Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR  
                                          AND X.KDSTATUSEMAIL = '1' 
                                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
                                  ) POTENSI_ANP,
				                  (
				                      SELECT 
				                          SUM(PREMI1) 
				                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
				                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
				                          AND KDPERTANGGUNGAN = '2' 
				                          AND KDSTATUSEMAIL = '1' 
				                          AND TO_CHAR(TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
				                          AND KDSTATUSFILE != '7'
				                  ) LUNAS,
				                  (
				                      SELECT 
				                          SUM(
				                              CASE
				                                  WHEN KDCARABAYAR = 'M' THEN PREMI1 * 12
				                                  WHEN KDCARABAYAR = 'Q' OR KDCARABAYAR = 'K' THEN PREMI1 * 4
				                                  WHEN KDCARABAYAR = 'H' THEN PREMI1 * 2
				                                  WHEN KDCARABAYAR = 'A' THEN PREMI1 * 1
				                                  WHEN KDCARABAYAR = 'X' THEN PREMI1 * 0.1
				                              END
				                         )
				                      FROM $DBUser.TABEL_200_PERTANGGUNGAN 
				                      WHERE PREFIXPERTANGGUNGAN = A.KDKANTOR 
				                          AND KDPERTANGGUNGAN = '2'
				                          AND KDSTATUSEMAIL = '1' 
				                          AND TO_CHAR(TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
				                          AND KDSTATUSFILE != '7'
				                  ) ANP_LUNAS,
                                  (
                                       SELECT 
                                          SUM(
                                              CASE
                                                  WHEN KDCARABAYAR = 'M' THEN PREMI1 * 12
                                                  WHEN KDCARABAYAR = 'Q' OR KDCARABAYAR = 'K' THEN PREMI1 * 4
                                                  WHEN KDCARABAYAR = 'H' THEN PREMI1 * 2
                                                  WHEN KDCARABAYAR = 'A' THEN PREMI1 * 1
                                                  WHEN KDCARABAYAR = 'X' THEN PREMI1 * 0.1
                                              END
                                         ) 
                                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X, $DBUser.TABEL_214_APPROVAL_PROPOSAL Y
                                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
                                          AND X.PREFIXPERTANGGUNGAN = Y.PREFIXPERTANGGUNGAN AND X.NOPERTANGGUNGAN = Y.NOPERTANGGUNGAN 
                                          AND X.KDPERTANGGUNGAN = '1' 
                                          AND X.KDSTATUSEMAIL = '1' 
                                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
                                          AND X.KDSTATUSFILE != '7'
                                  ) ANP_BELUMLUNAS,
                                  (
                                      SELECT
                                          SUM 
                                            (
                                                CASE
                                                    WHEN X.KDCARABAYAR = 'M' THEN X.PREMI1 * 12
                                                    WHEN X.KDCARABAYAR = 'Q' OR X.KDCARABAYAR = 'K' THEN X.PREMI1 * 4
                                                    WHEN X.KDCARABAYAR = 'H' THEN X.PREMI1 * 2
                                                    WHEN X.KDCARABAYAR = 'A' THEN X.PREMI1 * 1
                                                    WHEN X.KDCARABAYAR = 'X' THEN X.PREMI1 * 0.1
                                                END
                                            )
                                      FROM $DBUser.TABEL_200_PERTANGGUNGAN X, $DBUser.TABEL_214_APPROVAL_PROPOSAL Y
                                      WHERE X.PREFIXPERTANGGUNGAN = A.KDKANTOR
                                          AND Y.PREFIXPERTANGGUNGAN = X.PREFIXPERTANGGUNGAN 
                                          AND Y.NOPERTANGGUNGAN = X.NOPERTANGGUNGAN
                                          AND X.KDPERTANGGUNGAN = '1'  
                                          AND X.KDSTATUSEMAIL = '1' 
                                          AND X.KDSTATUSFILE = '7'
                                          AND TO_CHAR(X.TGLSENDEMAIL, 'MMYYYY') = '$bulan_cari$tahun_cari'
                                  ) ANP_BATAL
				              FROM $DBUser.TABEL_001_KANTOR A, 
				                  $DBUser.TABEL_400_SAM_KANTOR_MERGE B,
				                  $DBUser.TABEL_400_PENANDATANGANAN_PKAJ C
				              WHERE A.KDKANTOR = B.KODE_KANTOR
				                  AND C.KODE_KANTOR = A.KDKANTOR
				                  AND A.KDJENISKANTOR = '2' 
				                  AND A.KDKANTOR NOT IN ('KM', 'KN')
				                  AND C.JABATAN_AGEN = '00'
				                  AND C.JABATAN_TTD = '".$rayon_cari."'
				              ORDER BY C.JABATAN_TTD, NM_SAM, A.KDKANTOR ASC";
					$DBD->parse($sql_d);
					$DBD->execute();
					while ($arr_d=$DBD->nextrow()){
				?>
					<tr class="border_bottom" align="center">
						<td><?=$i;?></td>
						<td><?=$arr_d["RAYON"];?></td>
						<td><?=$arr_d["KDKANTOR"];?></td>
						<td align="left"><?=$arr_d["NM_SAM"];?></td>
						<td align="left"><?=$arr_d["KANTOR"];?></td>
						<td><?=$arr_d["PROPOSAL"];?></td>
						<td><?=$arr_d["WAITING"];?></td>
						<td><?=$arr_d["PENDING"];?></td>
						<td><?=$arr_d["APPROVE"];?></td>
						<td><?=$arr_d["BAYAR"];?></td>
                        <td><?=$arr_d["BATAL"];?></td>
						<td align="right"><?php echo(number_format($arr_d["POTENSI_PREMI"],0,',','.'));?></td>
						<td align="right"><?php echo(number_format($arr_d["POTENSI_ANP"],0,',','.'));?></td>
						<td align="right"><?php echo(number_format($arr_d["LUNAS"],0,',','.'));?></td>
						<td align="right"><?php echo(number_format($arr_d["ANP_LUNAS"],0,',','.'));?></td>
						<td align="right"><?php echo(number_format($arr_d["ANP_BELUMLUNAS"],0,',','.'));?></td>
                        <td align="right"><?php echo(number_format($arr_d["ANP_BATAL"],0,',','.'));?></td>
					</tr>
				<?php
						$i++;
					}
				?>
			</table>
		</div>

        <div id="header" style="height: 50px; width:100%; color: #FFFFFF ; background-color: #000000; margin-top: 30px; float: left; padding-top: 23px; padding-left: 15px;">
            <footer>
                &copy;2020 PT. Asuransi Jiwa IFG | Divisi Teknologi Informasi
            </footer>
        </div>
	</body>
	
	<script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartline", am4charts.XYChart);

        chart.data = <?=$data_0_final?>;/* Add data */

        /* Create axes */
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 50;
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        /* Create series */
        var series = chart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "value";
        series.dataFields.dateX = "date";
        series.strokeWidth = 2;
        series.minBulletDistance = 10;
        series.tooltipText = "Jumlah Polis:[/][bold] {value}";
        series.tooltip.pointerOrientation = "vertical";

        /* Add cursor */
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.xAxis = dateAxis;
    </script>

    <script type="text/javascript">
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.PieChart);
        chart.width = 450;
        chart.height = 250;

        chart.data = <?=$data_1_final?>;/* Add data */

        /* Add label */
        chart.innerRadius = 70;
        var label = chart.seriesContainer.createChild(am4core.Label);
        label.text = "IFGLIFE";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.fontSize = 30;

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah_1";
        pieSeries.dataFields.category = "rayon_1";
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
    </script>

	<script type="text/javascript">
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartprocess_1", am4charts.PieChart);

		chart.data = <?=$data_2_final?>;/* Add data */

		/* Add label */
        chart.innerRadius = 80;
        var label = chart.seriesContainer.createChild(am4core.Label);
        label.text = "<?=$percentase_proses;?>%";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.fontSize = 40;

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;
        pieSeries.slices.template.tooltipText = "";
        pieSeries.dataFields.value = "jumlah_2";
        pieSeries.dataFields.category = "jenis_2";
        pieSeries.slices.template.propertyFields.fill = "color_2";
	</script>

	<script type="text/javascript">
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartprocess_2", am4charts.PieChart);
		chart.width = 350;
        chart.height = 250;

		chart.data = <?=$data_3_final?>; /* Add data */

		/* Add label */
        chart.innerRadius = 60;
        var label = chart.seriesContainer.createChild(am4core.Label);

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah_3";
        pieSeries.dataFields.category = "jenis_3";
        //pieSeries.slices.template.propertyFields.fill = "color_3";
        pieSeries.alignLabels = false;
        pieSeries.legendSettings.itemValueText = ": {value}";
        pieSeries.fontSize = 12;

        // Add a legend
        chart.legend = new am4charts.Legend();
        chart.legend.fontSize = 12;

	</script>

	<script type="text/javascript">
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartapprove", am4charts.PieChart);

		chart.data = <?=$data_4_final?>; /* Add data */

		/* Add label */
        chart.innerRadius = 80;
        var label = chart.seriesContainer.createChild(am4core.Label);
        label.text = "<?=$percentase_approve;?>%";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.fontSize = 40;

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;
        pieSeries.slices.template.tooltipText = "";
        pieSeries.dataFields.value = "jumlah_4";
        pieSeries.dataFields.category = "jenis_4";
        pieSeries.slices.template.propertyFields.fill = "color_4";
	</script>

	<script type="text/javascript">
		am4core.useTheme(am4themes_animated);
		var chart = am4core.create("chartpelunasan", am4charts.PieChart);
		chart.width = 350;
        chart.height = 250;

		chart.data = <?=$data_5_final?>; /* Add data */

		/* Add label */
        chart.innerRadius = 60;
        var label = chart.seriesContainer.createChild(am4core.Label);

        /* Add and configure Series */
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah_5";
        pieSeries.dataFields.category = "jenis_5";
        //pieSeries.slices.template.propertyFields.fill = "color_5";
        pieSeries.alignLabels = false;
        pieSeries.legendSettings.itemValueText = ": {value}";
        pieSeries.fontSize = 12;

        // Add a legend
        chart.legend = new am4charts.Legend();
        chart.legend.fontSize = 12;
	</script>
</html>