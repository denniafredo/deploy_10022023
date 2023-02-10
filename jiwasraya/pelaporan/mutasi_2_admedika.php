<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/tgl.php";
	include "../../includes/hide.php";
	
	$DB = new database($userid, $passwd, $DBName);
	$DB2 = new database($DBUser,$DBPass,$DBName);
		
	if ($kantor != 'KP') {
		echo "Halaman ini hanya dapat diakses dari rayon kantor pusat (KP)<br><br>";
		echo "<a href='../polisserv.php' style='text-decoration:none;'>Pemeliharaan Polis</a>";
		exit;
	}
	
	if ($lihat) {
		// data mutasi status polis pada periode A s/d B
		$sql = "SELECT b.statusbaru kdstatusfile, a.prefixpertanggungan, a.nopertanggungan
				FROM $DBUser.tabel_200_pertanggungan a
				INNER JOIN $DBUser.polis_history_status b ON a.prefixpertanggungan = b.prefixpertanggungan
					AND a.nopertanggungan = b.nopertanggungan
					AND a.kdstatusfile = b.statusbaru
				LEFT OUTER JOIN $DBUser.mutasi_2_admedika_detail c ON a.prefixpertanggungan = c.prefixpertanggungan
					AND a.nopertanggungan = c.nopertanggungan AND b.tglmutasi = c.tglmutasi
				WHERE a.kdproduk IN ('JSR1','JSR2','JSR3','JSR4')
					AND a.kdpertanggungan = '2'
					AND a.kdstatusfile IN ('1','4','X','L','3','5','7')
					AND b.tglmutasi BETWEEN TO_DATE('$tgl1/$bln1/$thn1', 'dd/mm/yyyy') 
							AND TO_DATE('$tgl2/$bln2/$thn2', 'dd/mm/yyyy')
					AND c.nopertanggungan IS NULL
				ORDER BY a.prefixpertanggungan, a.nopertanggungan, b.tglmutasi";
		$DB->parse($sql);
		$DB->execute();
		$arr = $DB->result();
		
		// jika ada data mutasi yang belum masuk ke tabel mutasi admedika di periode A s/d B masukkan
		if (count($arr) > 0) {
			$add = true;
			
			$sql = "SELECT $DBUser.f_gen_nomutasi_admedika nomutasi FROM DUAL";
			$DB->parse($sql);
			$DB->execute();
			$noenroll = $DB->nextrow();
			
			$sql = "INSERT INTO $DBUser.mutasi_2_admedika (nomutasi, namafile, periode, tglrekam, userrekam)
					VALUES ('$noenroll[NOMUTASI]', '$noenroll[NOMUTASI]_' || TO_CHAR(sysdate, 'ddmmyyyyhh24miss') || '.txt', 
						'$tgl1/$bln1/$thn1 s/d $tgl2/$bln2/$thn2', sysdate, user)";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit;
			$z = $DB->affected();
			
			$sql = "INSERT INTO $DBUser.mutasi_2_admedika_detail (nomutasi, prefixpertanggungan, nopertanggungan, kdstatusfile, tglmutasi)
					SELECT '$noenroll[NOMUTASI]', a.prefixpertanggungan, a.nopertanggungan, b.statusbaru, b.tglmutasi
					FROM $DBUser.tabel_200_pertanggungan a
					INNER JOIN $DBUser.polis_history_status b ON a.prefixpertanggungan = b.prefixpertanggungan
						AND a.nopertanggungan = b.nopertanggungan
						AND a.kdstatusfile = b.statusbaru
					LEFT OUTER JOIN $DBUser.mutasi_2_admedika_detail c ON a.prefixpertanggungan = c.prefixpertanggungan
						AND a.nopertanggungan = c.nopertanggungan AND b.tglmutasi = c.tglmutasi
					WHERE a.kdproduk IN ('JSR1','JSR2','JSR3','JSR4')
						AND a.kdpertanggungan = '2'
						AND a.kdstatusfile IN ('1','4','X','L','3','5','7')
						AND b.tglmutasi BETWEEN TO_DATE('$tgl1/$bln1/$thn1', 'dd/mm/yyyy') 
								AND TO_DATE('$tgl2/$bln2/$thn2', 'dd/mm/yyyy')
						AND c.nopertanggungan IS NULL
					ORDER BY a.prefixpertanggungan, a.nopertanggungan, b.tglmutasi";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit();
			$z += $DB->affected();
		}
	}
	
	$sql = "SELECT b.nomutasi, b.namafile, b.periode, to_char(b.tglkirim, 'dd/mm/yyyy') tglkirim, b.userkirim, 
				to_char(b.tglrekam, 'dd/mm/yyyy') tglrekam, b.userrekam
			FROM $DBUser.mutasi_2_admedika_detail a
			INNER JOIN $DBUser.mutasi_2_admedika b ON a.nomutasi = b.nomutasi
			WHERE a.tglmutasi BETWEEN TO_DATE('$tgl1/$bln1/$thn1', 'dd/mm/yyyy') 
				AND TO_DATE('$tgl2/$bln2/$thn2', 'dd/mm/yyyy')
			GROUP BY b.nomutasi, b.namafile, b.periode, b.tglkirim, b.userkirim, b.tglrekam, b.userrekam
			ORDER BY b.tglrekam DESC";
	$DB->parse($sql);
	$DB->execute();
	$crr = $DB->result();
	$polisgagal = count($arr)+1-$z;
?>
<html>
	<head>
		<title>Informasi Upload Aktivasi & Deaktivasi Kartu Admedika</title>
		
		<link href="../jws.css" rel="stylesheet" type="text/css">
		
		<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
		<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
		<script language="JavaScript" type="text/javascript" src="../../includes/jquery.min.js"></script>
	</head>

	<body>
		<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
		<div align="center">
			<table width="100%" border="0">
				<tr>
					<td align="center" class="arial10blk" colspan="5"><b>INFORMASI PROSES SUSPEND & NON-SUSPEND KE ADMEDIKA (<?=$kantor;?>)</td>
				</tr>
				<tr>
					<td width="200">Tanggal BPO Polis</td>
					<td width="5">:</td>
					<td width="190">
						<select name="tgl1" class="c">
						<?php for($i=1;$i<=31;$i++) {
							$selected = (strlen($tgl1)==0 && $i==date('d')) || (strlen($tgl1)>0 && $tgl1==$i) ? 'selected' : null;
							$tg = $i<10 ? "0$i" : $i; ?>
							<option value="<?="$tg"?>" <?=$selected?>><?="$tg"?></option>
						<?php } ?>
						</select>
						<select name="bln1" class="c">
						<?php $bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
						for ($i=1;$i<=12;$i++) {
							$bl = $i<10 ? "0$i" : $i;
							$selected = (strlen($bln1)==0 && $bl==date('m')) || (strlen($bln1)> 0 && $bl==$bln1) ? 'selected' : null; ?>
							<option value="<?=$bl?>" <?=$selected?>><?=$bulan[$i]?></option>
						<?php } ?>
						</select>
						<select name="thn1" class="c">
						<?php $th=(!$thn1) ? substr($tanggal,-4) : $thn1;
						$awalth = 2016;
						for($i=$awalth;$i<=substr($tanggal,-4);$i++) {
							$selected = $i==$th ? 'selected' : null; ?>
							<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
						<?php } ?>
						</select>
					</td>
					<td width="25">s/d</td>
					<td>
						<select name="tgl2" class="c">
						<?php for($i=1;$i<=31;$i++) {
							$selected = (strlen($tgl2)==0 && $i==date('d')) || (strlen($tgl2)>0 && $tgl2==$i) ? 'selected' : null;
							$tg = $i<10 ? "0$i" : $i; ?>
							<option value="<?="$tg"?>" <?=$selected?>><?="$tg"?></option>
						<?php } ?>
						</select>
						<select name="bln2" class="c">
						<?php $bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
						for ($i=1;$i<=12;$i++) {
							$bl = $i<10 ? "0$i" : $i;
							$selected = (strlen($bln2)==0 && $bl==date('m')) || (strlen($bln2)> 0 && $bl==$bln2) ? 'selected' : null; ?>
							<option value="<?=$bl?>" <?=$selected?>><?=$bulan[$i]?></option>
						<?php } ?>
						</select>
						<select name="thn2" class="c">
						<?php $th=(!$thn2) ? substr($tanggal,-4) : $thn2;
						$awalth = 2016;
						for($i=$awalth;$i<=substr($tanggal,-4);$i++) {
							$selected = $i==$th ? 'selected' : null; ?>
							<option value="<?=$i?>" <?=$selected?>><?=$i?></option>
						<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan='3'>
						<input name="lihat" value="Lihat Data" type="submit">
					</td>
				</tr>
				<tr>
					<td colspan="5">
						<?=$add && $z != count($arr)+1 ? "Ada $polisgagal dari $drr[JMLPOLIS] polis yang gagal dibentuk" : null?>
					</td>
				</tr>
			</table>
			
			<hr size="1">
		</div>
		
		<table border="0" class="tblborder" cellspacing="1" cellpadding="4">
			<tr>
				<td class="tblhead" align="center" colspan="11"><b>DATA MUTASI ADMEDIKA</td>
			</tr>
			<tr class="hijao" style="text-align:center;">
				<td>Batch Mutasi</td>
				<td>File Teks (.txt)</td>
				<td>Periode</td>
				<td>Tgl Kirim</td>
				<td>Pengirim</td>
				<td>Tgl Rekam</td>
				<td>User Rekam</td>
				<td></td>
			</tr>
			<?php foreach($crr as $i => $r) {
			$comma = $i > 0 ? ',' : null;
			$whereinnomutasi .= "$comma'$r[NOMUTASI]'";
			$eqnomutasi = $i == 0 ? $r['NOMUTASI'] : $eqnomutasi;
			$arrinnomutasi[$i] = $r['NOMUTASI'];
			$display = strlen($r['TGLKIRIM'])>0 ? 'style="display:none;"' : null; ?>
			<tr bgcolor='#ffffff' class=verdana7blu>
				<td><?=$r['NOMUTASI']?></td>
				<td><?=$r['NAMAFILE']?></td>
				<td><?=$r['PERIODE']?></td>
				<td><?=$r['TGLKIRIM']?></td>
				<td><?=$r['USERKIRIM']?></td>
				<td><?=$r['TGLREKAM']?></td>
				<td><?=$r['USERREKAM']?></td>
				<td>
					<input type='hidden' name='nomutasi' value='<?=$r['NOMUTASI']?>' />
					<input type='hidden' name='namafile' value='<?=$r['NAMAFILE']?>' />
					<input type='button' name='unduh' value='Unduh TXT' onclick="window.location = 'mutasi_2_admedika_txt.php?mode=1&nomutasi=<?=$r['NOMUTASI']?>&namafile=<?=$r['NAMAFILE']?>'" />
					<input type='button' name='kirim' onclick="openOtentikasi('<?=$r['NOMUTASI']?>', '<?=$r['NAMAFILE']?>')" value='Kirim' <?=$display?> />
				</td>
			</tr>
			<?php } ?>
		</table>
		</form>
		
		<br>
		
		<form id='uploadftp' name='uploadftp' action='mutasi_2_admedika_txt.php' method='get'>
		<input type='hidden' name='mode' value='2' />
		<input type='hidden' id='nomutasi' name='nomutasi' />
		<input type='hidden' id='namafile' name='namafile' />
		<table id='otentikasi' border="0" class="tblborder" cellspacing="1" cellpadding="4" style='display:none;'>
			<tr>
				<td class="tblhead" align="center" colspan="11"><b>DATA OTENTIKASI ADMEDIKA</td>
			</tr>
			<tr class="hijao" style="text-align:center;">
				<td>Username</td>
				<td bgcolor='#ffffff'><input type='text' id='username_admk' name='ftp_usn' placeholder='jiwasraya' size="40" /></td>
			</tr>
			<tr class="hijao" style="text-align:center;">
				<td>Password</td>
				<td bgcolor='#ffffff'><input type='password' id='password_admk' name='ftp_pwd' placeholder='*********' size="40" /></td>
			</tr>
			<tr class="hijao">
				<td></td>
				<td bgcolor='#ffffff'><input type='submit' name='otentikasi' value='Login' /></td>
			</tr>
			<tr bgcolor='#ffffff'>
				<td colspan="2">
					<font size='2'>Proses pengiriman memakan waktu 120 detik (bisa lebih), mohon bersabar</font>
				</td>
			</tr>
		</table>
		</form>
		
		<br>
		
		<table border="0" class="tblborder" cellspacing="1" cellpadding="4">
			<tr>
				<td class="tblhead" align="center" colspan="11"><b>DATA POLIS YANG TERBENTUK DI FILE TXT</td>
			</tr>
			<tr class="hijao" style="text-align:center;">
				<td>No</td>
				<td>Batch Mutasi</td>
				<td>No Polis</td>
				<td>Status</td>
				<td>Tgl Mutasi</td>
			</tr>
			<?php 
			$sql = "SELECT a.nomutasi, a.prefixpertanggungan, a.nopertanggungan, b.kdstatusfile,
						c.namastatusfile, TO_CHAR(a.tglmutasi, 'dd/mm/yyyy hh24:mi:ss') tglmutasi, a.nomutasi
					FROM $DBUser.mutasi_2_admedika_detail a
					INNER JOIN $DBUser.tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
						AND a.nopertanggungan = b.nopertanggungan 
					INNER JOIN $DBUser.tabel_299_status_file c ON b.kdstatusfile = c.kdstatusfile
					WHERE nomutasi = '$eqnomutasi' /*IN ($whereinnomutasi)*/";
			$DB->parse($sql);
			$DB->execute();
			$arrdetail = $DB->result();
			
			/*$sql = "DELETE FROM $DBUser.mutasi_2_admedika_detail WHERE nomutasi IN ($whereinnomutasi)";
			$DB2->parse($sql);
			$DB2->execute();
			$DB2->commit();*/
			
			foreach ($arrdetail as $j => $w) {
				/*$sql = "INSERT INTO $DBUser.mutasi_2_admedika_detail (nomutasi, prefixpertanggungan, 
							nopertanggungan, kdstatusfile, tglmutasi) 
						VALUES ('$w[NOMUTASI]', '$w[PREFIXPERTANGGUNGAN]', '$w[NOPERTANGGUNGAN]', 
						'$w[KDSTATUSFILE]', sysdate)";
				$DB->parse($sql);
				$DB->execute();*/
				$sql = "UPDATE $DBUser.mutasi_2_admedika_detail SET kdstatusfile = '$w[KDSTATUSFILE]'
						WHERE nomutasi = '$w[NOMUTASI]' AND prefixpertanggungan = '$w[PREFIXPERTANGGUNGAN]'
							AND nopertanggungan = '$w[NOPERTANGGUNGAN]'";
				$DB2->parse($sql);
				$DB2->execute();
				?>
				
				<tr bgcolor='#ffffff' class=verdana7blu>
					<td align="center"><?=$j+1?></td>
					<td><?=$w['NOMUTASI']?></td>
					<td><?="$w[PREFIXPERTANGGUNGAN]-$w[NOPERTANGGUNGAN]"?></td>
					<td><?=$w['NAMASTATUSFILE']?></td>
					<td><?=$w['TGLMUTASI']?></td>
				</tr>
			<?php } ?>
		</table>

		<br>
		<a href='../polisserv.php' style='text-decoration:none;'>Pemeliharaan Polis</a>
	</body>
</html>

<script type="text/javascript">	
	function openOtentikasi(nomutasi, namafile) {
		$("#otentikasi").show();
		$("#nomutasi").val(nomutasi);
		$("#namafile").val(namafile);
	}
</script>