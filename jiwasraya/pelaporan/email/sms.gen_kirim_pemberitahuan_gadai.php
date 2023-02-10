<? 
	set_time_limit(10000001);
	include "../../includes/session.php"; 
	include "../../includes/database.php"; 
	include "../../includes/month_selector.php";
	include "../../includes/fungsi.php";
	include "../../includes/koneksi.php";

	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
	$DB2=new database($userid, $passwd, $DBName);
	
	$sql = "SELECT c.*,
				to_char(c.TGLBOOKED,'MM/YYYY') periode,
				to_char(c.TGLBOOKED,'YYYYMM') tglcari,
				e.NAMAKLIEN1,
				c.PREFIXPERTANGGUNGAN ||'-'||c.NOPERTANGGUNGAN as NO_POLIS,
				a.NOPOL,
				DECODE(e.JENISKELAMIN,'P','Ibu','L','Bapak','Bapak/Ibu') ANDA, 
				(SELECT NOACCOUNT FROM $DBUser.TABEL_700_GADAI_ACCOUNT WHERE PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN) NOACCOUNT
			FROM $DBUser.PENERIMA_EMAIL_BLAST c,
				$DBUser.TABEL_200_PERTANGGUNGAN a,
				$DBUser.TABEL_100_KLIEN e
			WHERE c.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND c.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
				AND a.NOPEMEGANGPOLIS = e.NOKLIEN
				AND c.NO_HP IS NOT NULL 
				AND c.NO_HP != ' '
				AND SUBSTR(c.NO_HP, 0, 2) = '08'
				AND c.ID_BLAST = '".$_GET['idblast']."'
				AND c.TGL_KIRIM_SMS IS NULL
				AND c.JENIS IN ('J')
				AND (c.STATUS != '1' OR c.status IS NULL)
			ORDER BY c.PREFIXPERTANGGUNGAN, c.NOPERTANGGUNGAN, c.RAYONPENAGIHAN
			";
	$DB->parse($sql);
	$DB->execute();
	while ($row=$DB->nextrow()) {
		$no_va = $row['NOACCOUNT'];
		$nopol = $row['NO_POLIS'];

		$sqlisi = " SELECT a.prefixpertanggungan, a.nopertanggungan, 
						to_char(f.tglbooked, 'DD/MM/YYYY') tglbooked,
						NVL(e.phonetagih01, e.phonetetap01) nohp,
						'98855085'||substr(a.nopertanggungan, 2, 8) as noaccount,
						a.kdvaluta,
						CASE
							WHEN a.kdvaluta = 3 THEN '$ '
							WHEN a.kdvaluta != 3 THEN 'Rp. '
						END AS kdnominal,
						(f.saldopinjaman + NVL(f.kapitalisasi, 0) - NVL(f.angsuranpokok, 0)) AMOUNTPOKOK,
						(NVL(f.bunga, 0)) AMOUNTBUNGA
					FROM $DBUser.tabel_200_pertanggungan c, 
						$DBUser.tabel_700_gadai a, 
						$DBUser.tabel_500_penagih d, 
						$DBUser.tabel_999_kode_status b, 
						$DBUser.tabel_100_klien e,
						$DBUser.tabel_701_pelunasan_gadai f,
						$DBUser.tabel_001_kantor g
					WHERE a.prefixpertanggungan=c.prefixpertanggungan 
						and a.nopertanggungan=c.nopertanggungan and c.nopenagih=d.nopenagih 
						and a.prefixpertanggungan = g.kdkantor
						and d.kdrayonpenagih in ( SELECT kdkantor FROM $DBUser.TABEL_001_KANTOR START WITH KDKANTOR = 'KP' CONNECT BY PRIOR KDKANTOR = KDKANTORINDUK ) 
						and a.status=b.kdstatus and c.nopemegangpolis = e.noklien
						and a.prefixpertanggungan=f.prefixpertanggungan and a.nopertanggungan=f.nopertanggungan
						and a.tglgadai = (select max(tglgadai) from $DBUser.tabel_700_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and status='3' group by nopertanggungan) 
						and a.tglgadai = f.tglgadai 
						and a.nopertanggungan in (select nopertanggungan from $DBUser.TABEL_700_GADAI_ACCOUNT where status='0') 
						and b.jenisstatus='GADAI' 
						and f.saldopinjaman > 0
						and a.status = '3'
						and f.status = '3'
						and c.kdstatusfile = '1'
						-- and c.nopertanggungan NOT IN  ('001236192',
		    --             	'001200862',
		    --             	'001945792',
		    --             	'001461180'
		    --             	)
						and to_char(f.tglbooked, 'MM/YYYY') = to_char(sysdate, 'MM/YYYY')
						and a.prefixpertanggungan ||'-'|| a.nopertanggungan = '".$row['NO_POLIS']."'
						and f.tglrekam = (SELECT max(tglrekam) from $DBUser.tabel_701_pelunasan_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and tglgadai=a.tglgadai group by nopertanggungan)
				";

		//echo $sqlisi;
		$DB1->parse($sqlisi);
		$DB1->execute();
		while ($rowx=$DB1->nextrow()) {
			$nilai_pokok = number_format($rowx['AMOUNTPOKOK'],2,',','.');
			$nilai_bunga = number_format($rowx['AMOUNTBUNGA'],2,',','.');
			$isi_pesan = "Nasabah Yth, Tks kepercayaan Anda mjd nasabah IFG LIFE, Kami sampaikan Posisi Gadai Polis ".$nopol." dgn Pokok Pinjaman ".$rowx['KDNOMINAL']." ".$nilai_pokok." & Bunga Pinjaman ".$rowx['KDNOMINAL']." ".$nilai_bunga.". Utk menghindari kapitalisasi Bunga menjadi Pokok, mohon lakukan pembayaran minimal sebesar Tagihan bunga gadai. Info 1500151/kantor JS terdekat.";
			//echo $isi_pesan;
		}
		
		$mysqlins="INSERT INTO smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) 
					VALUES('".$row['NO_HP']."','".$isi_pesan."','Pemberitahuan Posisi Pinjaman','".$row['RAYONPENAGIHAN']."','MSCM', '".$row['NO_POLIS']."')";
		$ok = mysql_query($mysqlins);
		
		if($ok == '1'){
			$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST SET TGL_KIRIM_SMS = sysdate WHERE id_blast = '".$_GET['idblast']."' AND ID_AUDIENCE = '".$row['ID_AUDIENCE']."' ";
			$DB1->parse($query);
			$DB1->execute();
			$row1=$DB1->nextrow();

			//FUNGSI UNTUK MENYIMPAN HISTORIS SMS
			$sqlselect=" INSERT INTO $DBUser.tabel_200_sms (PHONE, MESSAGE, TGLREKAM, EXPIREDDATE, KDSMS, STATUS, TGLBOOKED, KDKANTOR, DIVISI, NOMORPOLIS)
								VALUES('".$row['NO_HP']."','".$isi_pesan."',TO_DATE(SYSDATE, 'DD/MM/YY'), '' ,'J', '1', TO_DATE(SYSDATE, 'DD/MM/YYYY'), '".$row['RAYONPENAGIHAN']."','MSCM', '".$row['NOPOL']."')";
			$DB2->parse($sqlselect);
			$DB2->execute();
		}
	}
	header("Location: blast_system.php");
?>