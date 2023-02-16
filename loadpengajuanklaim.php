<script src="../../includes/js/jquery-3.3.1.slim.min.js"></script>
<script>
	function alertmsg(title, message) {
		$(".alertmsg").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>"+title+"!</strong> "+message+"<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
	} 
</script>

<?php	
// fungsi untuk mengecek lock mutasi
function f_cekdatapolis() {
	include "../../includes/common.php";
	
	// variabel global dari file yang memanggil loadpengajuanklaim.php
	global $kantor, $prefix, $noper, $jnsklaim, $DB, $kdproduk, $pakdp, $nilaibenefit;
	
	
	
	// Variabel constant
	$stebus = array('1','4','8','9','L','A'); // Status tebus
	$smati = array('1','4','8','L','A'); // Status mati
	$smatix = array('1','4','A','8'); // Status mati benefit lanjut
	$sexp = array('1','4','A','8','L'); // Status jatuh tempo/expirasi
	$stahapan = array('1','4','A','8','9','L'); // Status tahapan
	$sanuitas = array('1','3','4','A','8','9'); // Status anuitas
	$sbeasiswa = array('1','4','A','8','9','L'); // Status beasiswa
	$s223klaim = array('8'); // Status manfaat sudah diklaim
	$pmatix = array('ASI','ASP','AIP','AI0','AEP','PIN'); // Produk mati benefit lanjut
	$pakdp = array('PAA','PAB','IFGETRIP'); // Produk AKDP
	$pthp6 = array('JSP','JSPNN','SW5','SPH', 'JSPS', 'JSPSN', 'JSPNBTN'); // Produk yang tahapannya bisa diambil 6 bulan sebelum jatuh tempo
	$dakdp = 'DEATHKC'; // Benefit meninggal AKDP
	$jnsbnfpa = array("'BNFRWT'", "'CCTTTPA'", "'RIKC'"); // Jenis benefit AKDP
	//$riakdp = 'BNFRWT'; // Benefit rawat inap AKDP
	//$ctakdp = 'CCTTTPA'; // Benefit cacat AKDP
	$jnsrider = array('CI53', 'WPCI51', 'CI', 'SPBD', 'PBD', 'TPD', 'ADB', 'ADDB', 'PBTPD', 'SPTPD', 'PBCI', 'SPBCI', 'RTI'); // Jenis klaim benefit rider
	$waiver = array('WPCI51', 'WPTPD', 'WAIVER');
	$dinvestigasi = 24; // Dalam satuan bulan
	
	if (!empty($prefix) || !empty($noper) || !empty($jnsklaim)) {
		
		$sql = "SELECT b.kdmutasi, initcap(b.namamutasi) namamutasi, c.kdstatusfile, initcap(c.namastatusfile) namastatusfile,
					d.kdrayonpenagih, a.kdproduk, a.kdpertanggungan, FLOOR(MONTHS_BETWEEN(sysdate, a.mulas)) usiablnpolis,
					INITCAP(e.namaklaim) namaklaim, e.kelompok, f.namakelompokbenefit, 
					(
						SELECT TO_CHAR(MAX(tglpengajuan),'dd/mm/yyyy') 
						FROM $DBUser.tabel_901_pengajuan_klaim 
						WHERE prefixpertanggungan = a.prefixpertanggungan 
							AND nopertanggungan = a.nopertanggungan 
							AND kdklaim = e.kdklaim
					) tglpengajuan,
					(
						SELECT MAX(userrekam)
						FROM $DBUser.tabel_901_pengajuan_klaim 
						WHERE prefixpertanggungan = a.prefixpertanggungan 
							AND nopertanggungan = a.nopertanggungan 
							AND kdklaim = e.kdklaim
					) userpengajuan,
					(
						SELECT COUNT(nopertanggungan)
						FROM $DBUser.tabel_901_pengajuan_klaim 
						WHERE prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdklaim = e.kdklaim
							AND status IN ('0','1','2')
					) diproses,
					(
						SELECT COUNT(nopertanggungan) 
						FROM $DBUser.tabel_223_transaksi_produk z
						INNER JOIN $DBUser.tabel_207_kode_benefit y ON z.kdbenefit = y.kdbenefit
						WHERE z.prefixpertanggungan = a.prefixpertanggungan 
							AND z.nopertanggungan = a.nopertanggungan 
							AND y.kdkelompokbenefit = e.kelompok
							AND NVL(z.status, '0') IN ('0', '7')
					) jmlbenefit,
					(
						SELECT COUNT(nopertanggungan)
						FROM $DBUser.tabel_223_transaksi_produk z
						INNER JOIN $DBUser.tabel_207_kode_benefit y ON z.kdbenefit = y.kdbenefit
						WHERE z.prefixpertanggungan = a.prefixpertanggungan
							AND z.nopertanggungan = a.nopertanggungan
							AND y.kdkelompokbenefit = e.kelompok
							AND NVL(z.status, '0') IN ('0', '7')
							AND MONTHS_BETWEEN(TO_DATE(TO_CHAR(z.expirasi, 'mm/yyyy'), 'mm/yyyy'), TO_DATE(TO_CHAR(sysdate, 'mm/yyyy'), 'mm/yyyy')) <= 0
					) jmlbenefitexp,
					(
						SELECT COUNT(nopertanggungan)
						FROM $DBUser.tabel_223_transaksi_produk z
						INNER JOIN $DBUser.tabel_207_kode_benefit y ON z.kdbenefit = y.kdbenefit
						WHERE z.prefixpertanggungan = a.prefixpertanggungan
							AND z.nopertanggungan = a.nopertanggungan
							AND y.kdkelompokbenefit = e.kelompok
							AND NVL(z.status, '0') IN ('0', '7')
							AND MONTHS_BETWEEN(z.expirasi, ADD_MONTHS (sysdate, 6)) <= 0
					) jmlbenefitthp,
					(
						SELECT COUNT(nopertanggungan)
						FROM $DBUser.tabel_242_benefit_anuitas z
						INNER JOIN $DBUser.tabel_207_kode_benefit y ON z.kdbenefit = y.kdbenefit
						WHERE z.prefixpertanggungan = a.prefixpertanggungan
							AND z.nopertanggungan = a.nopertanggungan
							AND y.kdkelompokbenefit = e.kelompok
							AND NVL(z.status, '0') IN ('0', '7')
							AND MONTHS_BETWEEN (z.tgljatuhtempo, sysdate) <= 0
					) jmlbenefitanu
				FROM $DBUser.tabel_200_pertanggungan a 
				LEFT OUTER JOIN $DBUser.tabel_601_kode_mutasi b ON a.lockmutasi = b.kdmutasi 
				LEFT OUTER JOIN $DBUser.tabel_299_status_file c ON a.kdstatusfile = c.kdstatusfile 
				LEFT OUTER JOIN $DBUser.tabel_500_penagih d ON a.nopenagih = d.nopenagih
				LEFT OUTER JOIN $DBUser.tabel_902_kode_klaim e ON e.kdklaim = '$jnsklaim'
				LEFT OUTER JOIN $DBUser.tabel_244_kelompok_benefit f ON e.kelompok = f.kdkelompokbenefit
				WHERE a.prefixpertanggungan = '$prefix'
					AND a.nopertanggungan = '$noper'";
		//echo $sql;exit;
		$DB->parse($sql);
		$DB->execute();
		$r = $DB->nextrow();
		 
		// Set input text
		$kdproduk = $r['KDPRODUK'];
		
		// Portofolio polis tidak sama dengan kantor yang mengajukan klaim
		if (!empty($kantor) && $kantor != $r['KDRAYONPENAGIH']) {
			echo "<script type='text/javascript'>
					$('#tblpengajuanklaim tbody').append('<tr class=\"table-info\"><td colspan=\"2\"><small>Polis ini merupakan portofolio rayon <strong>$r[KDRAYONPENAGIH]</strong>. Jangan lupa mengirimkan nota pemberitahuan ke kantor tsb.</small></td></tr>');
				</script>";
		}
		
		// Polis tidak ditemukan
		if (!$r) {
			echo "<script type='text/javascript'>
					alertmsg('Kesalahan', 'Data polis tidak ditemukan, masukkan nomor polis dengan benar.');
				</script>";
		} 
		// Polis sedang dalam proses mutasi (lockmutasi)
		else if (!empty($r['KDMUTASI'])) {
			echo "<script type='text/javascript'>
					alertmsg('Peringatan', 'Polis sedang dalam proses mutasi $r[NAMAMUTASI]. Silahkan menghubungi bagian klaim untuk membuka unlock mutasi');
					$('.alert').removeClass('alert-danger').addClass('alert-warning');
				</script>";
		}
		// Polis masih dalam bentuk proposal (belum konversi)
		else if ($r['KDPERTANGGUNGAN'] == '1') {
			echo "<script type='text/javascript'>
					alertmsg('Kesalahan', 'Data polis masih berupa proposal, silahkan konversi menjadi polis.');
				</script>";
		}
		// Klaim Tebus
		else if ($jnsklaim == 'TEBUS') {
			$sql = "SELECT TO_CHAR(tglmohon, 'dd/mm/yyyy') tglmohon, userrekam
					FROM $DBUser.tabel_700_tebus
					WHERE prefixpertanggungan = '$prefix'
						AND nopertanggungan = '$noper'";
			$DB->parse($sql);
			$DB->execute();
			$q = $DB->nextrow();
			
			// Tebus sudah pernah diajukanoleh $q[USERREKAM]
			if ($q) {
				echo "<script type='text/javascript'>
						alertmsg('Informasi', 'Polis ini pernah mengajukan tebus tanggal $q[TGLMOHON] . Pengajuan tersebut akan dihapus jika anda tetap melanjutkan proses');
						$('.alert').removeClass('alert-danger').addClass('alert-info');
					</script>";
				return true;
			}
			// Status polis 1 (aktif), 4 (bpo), 8 (klaim benefit lanjut), 9 (ekspirasi benefit lanjut), L (bpo lock)
			else if (in_array($r['KDSTATUSFILE'], $stebus)) {
				return true;
			} else {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			}
		}
		// Klaim Meninggal
		else if ($r['KELOMPOK'] == 'D') {
			// Jika usia polis dibawah 2 tahun
			if ($r['USIABLNPOLIS'] < $dinvestigasi) {
				echo "<!--script type='text/javascript'>
						$('#tblpengajuanklaim tbody').append('<tr class=\"table-info\"><td colspan=\"2\"><small>Usia polis ini kurang dari 2 tahun. Jangan lupa untuk melakukan <strong>INVESTIGASI KLAIM</strong>.</small></td></tr>');
					</script-->";
			}
			
			// Sudah pernah diajukanoleh $r[USERPENGAJUAN]
			if (!empty($r['TGLPENGAJUAN'])) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim $r[NAMAKLAIM] sudah pernah diajukan tanggal $r[TGLPENGAJUAN] .');
					</script>";
			}
			// Jika produk AKDP
			else if (in_array($r['KDPRODUK'], $pakdp)) {
				$sql = "SELECT nilaibenefit 
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = '$prefix' 
							AND nopertanggungan = '$noper' 
							AND kdbenefit = '$dakdp'";
				$DB->parse($sql);
				$DB->execute();
				$q = $DB->nextrow();
			
				// Tidak ada benefit
				if (empty($q['NILAIBENEFIT']) || $q['NILAIBENEFIT'] == 0) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Polis $nopolis1 tidak memiliki benefit $dakdp.');
						</script>";
				} else {
					return true;
				}
			} else {
				// Status polis selain 1 (aktif), 4 (bpo), 8 (klaim benefit lanjut), L (bpo lock) untuk produk selain $pmatix
				// Status polis selain 1 (aktif), 4 (bpo), 8 (klaim benefit lanjut) untuk produk $pmatix
				if ((!in_array($r['KDSTATUSFILE'], $smati) && !in_array($r['KDPRODUK'], $pmatix)) || (!in_array($r['KDSTATUSFILE'], $smatix) && in_array($r['KDPRODUK'], $pmatix))) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
						</script>";
				}
				// Tidak ada benefit
				else if ($r['JMLBENEFIT'] == 0) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $r[NAMAKELOMPOKBENEFIT].');
						</script>";
				} else {
					return true;
				}
			}
		}
		// Klaim Jatuh Tempo / Expirasi
		else if ($r['KELOMPOK'] == 'E') {				
			// Sudah pernah diajukan// oleh $r[USERPENGAJUAN]
			if (!empty($r['TGLPENGAJUAN'])) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim $r[NAMAKLAIM] sudah pernah diajukan tanggal $r[TGLPENGAJUAN].');
					</script>";
			}
			// Status polis selain 1 (aktif), 4 (bpo), 8 (klaim benefit lanjut), L (bpo lock)
			else if (!in_array($r['KDSTATUSFILE'], $sexp)) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			}
			// Tidak ada benefit
			else if ($r['JMLBENEFITEXP'] == 0) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $r[NAMAKELOMPOKBENEFIT].');
					</script>";
			} 
			// Repeat Business
			else if ($jnsklaim == 'EXPIRASIRB') {
				$sql = "SELECT ROUND(MAX(nilaibenefit)) nilaibenefit
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = '$prefix' 
							AND nopertanggungan = '$noper' 
							AND kdbenefit IN ('EXPPREMI', 'BNFSTP')";
				$DB->parse($sql);
				$DB->execute();
				$q = $DB->nextrow();
				$nilaibenefit = $q['NILAIBENEFIT'];
				
				return true;
			} else {
				return true;
			}
		}
		// Klaim Tahapan
		else if ($r['KELOMPOK'] == 'T') {
			// Sedang diproses
			if ($r['DIPROSES']) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Selesaikan proses klaim $r[NAMAKLAIM] sebelumnya terdahulu.');
					</script>";
			}
			// Status polis selain 1 (aktif), 4 (bpo), 8 (klaim benefit lanjut), 9 (ekspirasi benefit lanjut), L (bpo lock)
			else if (!in_array($r['KDSTATUSFILE'], $stahapan)) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			}
			// Tidak ada benefit untuk produk yang bisa diambil 6 bulan sebelum maupun produk lain
			else if (($r['JMLBENEFITTHP'] == 0 && !in_array($r['KDPRODUK'], $pthp6)) || ($r['JMLBENEFITEXP'] == 0 && !in_array($r['KDPRODUK'], $pthp6))) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $r[NAMAKELOMPOKBENEFIT] yang sedang jatuh tempo.');
					</script>";
			} else {
				return true;
			}
		}
		// Klaim Anuitas
		else if ($r['KELOMPOK'] == 'A') {
			// Sedang diproses
			if ($r['DIPROSES']) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Selesaikan proses klaim $r[NAMAKLAIM] sebelumnya terdahulu.');
					</script>";
			}
			// Status polis selain 1 (aktif), 3 (ekspirasi), 4 (bpo), 8 (klaim benefit lanjut), 9 (ekspirasi benefit lanjut)
			else if (!in_array($r['KDSTATUSFILE'], $sanuitas)) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			}
			// Tidak ada benefit 
			else if ($r['JMLBENEFITEXP'] == 0 && $r['JMLBENEFITANU'] == 0 && !in_array($jnsklaim, $waiver)) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $r[NAMAKELOMPOKBENEFIT] yang sedang jatuh tempo.');
					</script>";
			} else {
				return true;
			}
		}
		// Klaim Beasiswa
		else if ($r['KELOMPOK'] == 'B') {
			// Sedang diproses
			if ($r['DIPROSES']) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Selesaikan proses klaim $r[NAMAKLAIM] sebelumnya terdahulu.');
					</script>";
			}
			// Status polis selain 1 (aktif), 4 (bpo), 8 (klaim benefit lanjut), 9 (ekspirasi benefit lanjut), L (bpo lock)
			else if (!in_array($r['KDSTATUSFILE'], $sbeasiswa)) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			}
			// Tidak ada benefit
			else if ($r['JMLBENEFITEXP'] == 0 && $r['JMLBENEFITANU'] == 0) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $r[NAMAKELOMPOKBENEFIT] yang sedang jatuh tempo.');
					</script>";
			} else {
				return true;
			}
		}
		// Klaim Rawat Inap
		else if ($r['KELOMPOK'] == 'R') {
			// Sedang diproses
			if ($r['DIPROSES']) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Selesaikan proses klaim $r[NAMAKLAIM] sebelumnya terdahulu.');
					</script>";
			} 
			// Status polis tidak aktif
			else if ($r['KDSTATUSFILE'] != '1') {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			}
			// Jika produk AKDP
			else if (in_array($r['KDPRODUK'], $pakdp)) {
				$sql = "SELECT nilaibenefit, NVL(status, 0) status
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = '$prefix' 
							AND nopertanggungan = '$noper' 
							AND kdbenefit = '$riakdp'";
				$DB->parse($sql);
				$DB->execute();
				$q = $DB->nextrow();
			
				// Tidak ada benefit
				if (empty($q['NILAIBENEFIT']) || $q['NILAIBENEFIT'] == 0) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $riakdp.');
						</script>";
				} else if (in_array($q['STATUS'], $s223klaim)) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Manfaat $riakdp pada polis $prefix-$noper sudah diklaim.');
						</script>";
				} else {
					return true;
				}
			} else {
				return true;
			}
		}
		// Klaim Cacat / Cashplan / Rider
		else if ($r['KELOMPOK'] == 'C') {
			// Sedang diproses
			if ($r['DIPROSES']) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Selesaikan proses klaim $r[NAMAKLAIM] sebelumnya terdahulu.');
					</script>";
			} 
			// Status polis tidak aktif
			else if ($r['KDSTATUSFILE'] != '1') {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Klaim tidak dapat dilanjutkan, Status polis $r[NAMASTATUSFILE].');
					</script>";
			} 
			// Jika produk AKDP & bukan klaim rider
			else if (in_array($r['KDPRODUK'], $pakdp) && !in_array($jnsklaim, $jnsrider)) {
				$sql = "SELECT nilaibenefit, NVL(status, 0) status
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = '$prefix' 
							AND nopertanggungan = '$noper' 
							AND kdbenefit IN (".implode(",",$jnsbnfpa).")";
				$DB->parse($sql);
				$DB->execute();
				$q = $DB->nextrow();
			
				// Tidak ada benefit
				if (empty($q['NILAIBENEFIT']) || $q['NILAIBENEFIT'] == 0) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit Cashplan.');
						</script>";
				} else if (in_array($q['STATUS'], $s223klaim)) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Manfaat pada polis $prefix-$noper sudah diklaim.');
						</script>";
				} else {
					return true;
				}
			} 
			// Jika klaim Rider
			else if (in_array($jnsklaim, $jnsrider)) {
				$sql = "SELECT MAX(nilaibenefit) nilaibenefit
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = '$prefix' 
							AND nopertanggungan = '$noper' 
							AND kdbenefit = decode('$jnsklaim', 'RTI', 'TI', '$jnsklaim')
							--AND kdbenefit = '$jnsklaim'";
				$DB->parse($sql);
				$DB->execute();
				$q = $DB->nextrow();
				
				// Sudah pernah diajukanoleh $r[USERPENGAJUAN]
				if (!empty($r['TGLPENGAJUAN'])) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Klaim $r[NAMAKLAIM] sudah pernah diajukan tanggal $r[TGLPENGAJUAN] .');
						</script>";
				}
				// Tidak ada benefit
				else if (empty($q['NILAIBENEFIT']) || $q['NILAIBENEFIT'] == 0) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $jnsklaim.');
						</script>";
				} else {
					return true;
				}
			} else {
				$sql = "SELECT MAX(nilaibenefit) nilaibenefit
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = '$prefix' 
							AND nopertanggungan = '$noper' 
							AND substr(kdbenefit,1,2) = 'CP'";
				$DB->parse($sql);
				$DB->execute();
				$q = $DB->nextrow();
			
				// Tidak ada benefit
				if (empty($q['NILAIBENEFIT']) || $q['NILAIBENEFIT'] == 0) {
					echo "<script type='text/javascript'>
							alertmsg('Kesalahan', 'Polis $prefix-$noper tidak memiliki benefit $r[NAMAKLAIM].');
						</script>";
				} else {
					return true;
				}
			}
		}
		// Jika Klaim Lainnya
		else {
			// Sedang diproses
			if ($r['DIPROSES']) {
				echo "<script type='text/javascript'>
						alertmsg('Kesalahan', 'Selesaikan proses klaim $r[NAMAKLAIM] sebelumnya terdahulu.');
					</script>";
			} else {
				return true;
			}
		}
	}
}
?>