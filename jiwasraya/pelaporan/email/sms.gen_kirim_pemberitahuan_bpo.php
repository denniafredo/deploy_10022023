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
				DECODE(e.JENISKELAMIN,'P','Ibu','L','Bapak','Bapak/Ibu') ANDA
			FROM $DBUser.PENERIMA_EMAIL_BLAST c,
				$DBUser.TABEL_200_PERTANGGUNGAN a,
				$DBUser.TABEL_100_KLIEN e
			WHERE c.PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN AND c.NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
				AND a.NOPEMEGANGPOLIS = e.NOKLIEN
				AND c.NO_HP IS NOT NULL
				AND SUBSTR(c.NO_HP, 0, 2) = '08'
				AND c.ID_BLAST = '".$_GET['idblast']."'
				AND c.TGL_KIRIM_SMS IS NULL
				AND c.JENIS IN ('Z')
				AND (c.STATUS != '1' OR c.status IS NULL)
			ORDER BY c.PREFIXPERTANGGUNGAN, c.NOPERTANGGUNGAN, c.RAYONPENAGIHAN
			";
	$DB->parse($sql);
	$DB->execute();
	while ($row=$DB->nextrow()) {
		$nopol = $row['NO_POLIS'];
		$isi_pesan = "Nasabah Yth, Masa tenggang pembayaran premi Polis ".$nopol.", telah habis. Segera ajukan pemulihan polis agar polis anda Aktif kembali. Info 021-1500151";
		
		$mysqlins="INSERT INTO smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) 
					VALUES('".$row['NO_HP']."','".$isi_pesan."','Pemberitahuan Kondisi BPO','".$row['RAYONPENAGIHAN']."','MSCM', '".$row['NOPOL']."')";
		$ok = mysql_query($mysqlins);
		//print_r($ok);	
		if($ok == '1'){
			$query = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST SET TGL_KIRIM_SMS = sysdate WHERE id_blast = '".$_GET['idblast']."' AND ID_AUDIENCE = '".$row['ID_AUDIENCE']."' ";
			$DB1->parse($query);
			$DB1->execute();
			$row1=$DB1->nextrow();

			//FUNGSI UNTUK MENYIMPAN HISTORIS SMS
			$sqlselect=" INSERT INTO $DBUser.tabel_200_sms (PHONE, MESSAGE, TGLREKAM, EXPIREDDATE, KDSMS, STATUS, TGLBOOKED, KDKANTOR, DIVISI, NOMORPOLIS)
								VALUES('".$row['NO_HP']."','".$isi_pesan."',TO_DATE(SYSDATE, 'DD/MM/YY'), '' ,'Z', '1', TO_DATE(SYSDATE, 'DD/MM/YYYY'), '".$row['RAYONPENAGIHAN']."','MSCM', '".$row['NOPOL']."')";
			$DB2->parse($sqlselect);
			$DB2->execute();
		}
	}
	header("Location: blast_system.php");
?>