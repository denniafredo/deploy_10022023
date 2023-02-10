<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/tgl.php";
	include "../../includes/hide.php";
	
	$DB = new database($userid, $passwd, $DBName);
	$z = 0;
	$add = false;
		
	if ($kantor != 'KP') {
		echo "Halaman ini hanya dapat diakses dari rayon kantor pusat (KP)<br><br>";
		echo "<a href='../submenu.php?mnuinduk=200' style='text-decoration:none;'>Pertanggungan Baru</a>";
		exit;
	}
	
	if ($lihat) {
		// data polis yang di akseptasi periode A s/d B
		$sql = "SELECT a.prefixpertanggungan, a.nopertanggungan
				FROM $DBUser.tabel_200_pertanggungan a
                INNER JOIN $DBUser.tabel_214_acceptance_dokumen b ON a.prefixpertanggungan = b.prefixpertanggungan
                    AND a.nopertanggungan = b.nopertanggungan
				LEFT OUTER JOIN $DBUser.enroll_2_admedika_detail c ON a.prefixpertanggungan = c.prefixpertanggungan
					AND a.nopertanggungan = c.nopertanggungan
                WHERE a.kdproduk IN ('JSR1', 'JSR2', 'JSR3')
                    AND a.kdpertanggungan = '2' AND a.kdstatusfile = '1' AND b.kdacceptance = '1'
                    AND TO_DATE(TO_CHAR(b.tglacceptance,'dd/mm/yyyy'),'dd/mm/yyyy') BETWEEN TO_DATE('$tgl1/$bln1/$thn1', 'dd/mm/yyyy') 
						AND TO_DATE('$tgl2/$bln2/$thn2', 'dd/mm/yyyy')
					AND c.nopertanggungan IS NULL";
		$DB->parse($sql);
		$DB->execute();
		$arr = $DB->result();
		
		// jika ada data polis yang belum masuk ke tabel enroll di periode A s/d B masukkan
		if (count($arr)>0) {
			$add = true;
			
			$sql = "SELECT $DBUser.f_gen_noenroll noenroll FROM dual";
			$DB->parse($sql);
			$DB->execute();
			$noenroll = $DB->nextrow();
			
			$sql = "INSERT INTO $DBUser.enroll_2_admedika (noenroll, namafile, periode, tglrekam, userrekam)
					VALUES ('$noenroll[NOENROLL]', '$noenroll[NOENROLL]_' || TO_CHAR(sysdate, 'ddmmyyyyhh24miss') || '.txt', 
						'$tgl1/$bln1/$thn1 s/d $tgl2/$bln2/$thn2', sysdate, user)";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit;
			$z = $DB->affected();
			
			$sql = "INSERT INTO $DBUser.enroll_2_admedika_detail (noenroll, prefixpertanggungan, nopertanggungan)
					SELECT '$noenroll[NOENROLL]', a.prefixpertanggungan, a.nopertanggungan
					FROM $DBUser.tabel_200_pertanggungan a
					INNER JOIN $DBUser.tabel_214_acceptance_dokumen b ON a.prefixpertanggungan = b.prefixpertanggungan
						AND a.nopertanggungan = b.nopertanggungan
					LEFT OUTER JOIN $DBUser.enroll_2_admedika_detail c ON a.prefixpertanggungan = c.prefixpertanggungan
						AND a.nopertanggungan = c.nopertanggungan
					WHERE a.kdproduk IN ('JSR1', 'JSR2', 'JSR3', 'JSR4')
						AND a.kdpertanggungan = '2' AND a.kdstatusfile = '1' AND b.kdacceptance = '1'
						AND TO_DATE(TO_CHAR(b.tglacceptance,'dd/mm/yyyy'),'dd/mm/yyyy') BETWEEN TO_DATE('$tgl1/$bln1/$thn1', 'dd/mm/yyyy') 
							AND TO_DATE('$tgl2/$bln2/$thn2', 'dd/mm/yyyy')
						AND c.nopertanggungan IS NULL";
			$DB->parse($sql);
			$DB->execute();
			$DB->commit();
			$z += $DB->affected();
		}
	}
	
	$sql = "SELECT c.noenroll, c.namafile, c.periode, TO_CHAR(c.tglrekam, 'dd/mm/yyyy') tglrekam, c.userrekam, 
				TO_CHAR(c.tglkirim, 'dd/mm/yyyy') tglkirim, c.userkirim
			FROM $DBUser.tabel_214_acceptance_dokumen a
			INNER JOIN $DBUser.enroll_2_admedika_detail b ON a.prefixpertanggungan = b.prefixpertanggungan
				AND a.nopertanggungan = b.nopertanggungan
			INNER JOIN $DBUser.enroll_2_admedika c ON b.noenroll = c.noenroll
			WHERE TO_DATE(TO_CHAR(a.tglacceptance,'dd/mm/yyyy'),'dd/mm/yyyy') BETWEEN TO_DATE('$tgl1/$bln1/$thn1', 'dd/mm/yyyy') 
				AND TO_DATE('$tgl2/$bln2/$thn2', 'dd/mm/yyyy')
			GROUP BY c.noenroll, c.namafile, c.periode, c.tglrekam, c.userrekam, c.tglkirim, c.userkirim";
	$DB->parse($sql);
	$DB->execute();
	$crr = $DB->result();
	$polisgagal = count($arr)+1-$z;
?>

<html>
	<head>
		<title>Informasi Upload Enrollment Admedika</title>
		
		<link href="../jws.css" rel="stylesheet" type="text/css">
		
		<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
		<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
		<script language="JavaScript" type="text/javascript" src="../../includes/jquery.min.js"></script>
	</head>

	<body>
		<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
		<div align="center">
			<table width="100%">
				<tr>
					<td align="center" class="arial10blk" colspan="5"><b>INFORMASI PROSES UPLOAD DATA ENROLLMENT KE ADMEDIKA (<?=$kantor;?>)</td>
				</tr>
				<tr>
					<td width="200">Periode Akseptasi Polis</td>
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
				<td class="tblhead" align="center" colspan="11"><b>DATA ENROLLMENT ADMEDIKA</td>
			</tr>
			<tr class="hijao" style="text-align:center;">
				<td>No</td>
				<td>Batch Enroll</td>
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
			$whereinnoenroll .= "$comma'$r[NOENROLL]'";
			$display = strlen($r['TGLKIRIM'])>0 ? 'style="display:none;"' : null; ?>
			<tr bgcolor='#ffffff' class=verdana7blu>
				<td><?=$i+1?></td>
				<td><?=$r['NOENROLL']?></td>
				<td><?=$r['NAMAFILE']?></td>
				<td><?=$r['PERIODE']?></td>
				<td><?=$r['TGLKIRIM']?></td>
				<td><?=$r['USERKIRIM']?></td>
				<td><?=$r['TGLREKAM']?></td>
				<td><?=$r['USERREKAM']?></td>
				<td>
					<input type='hidden' name='noenroll' value='<?=$r['NOENROLL']?>' />
					<input type='hidden' name='namafile' value='<?=$r['NAMAFILE']?>' />
					<input type='button' name='unduh' value='Unduh TXT' onclick="window.location = 'enrollment_admedika_txt.php?mode=1&noenroll=<?=$r['NOENROLL']?>&namafile=<?=$r['NAMAFILE']?>'" />
					<input type='button' name='kirim' onclick="openOtentikasi('<?=$r['NOENROLL']?>', '<?=$r['NAMAFILE']?>')" value='Kirim' <?=$display?> />
				</td>
			</tr>
			<?php } ?>
		</table>
		</form>
		
		<br>
		
		<form id='uploadftp' name='uploadftp' action='enrollment_admedika_txt.php' method='get'>
		<input type='hidden' name='mode' value='2' />
		<input type='hidden' id='noenroll' name='noenroll' />
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
				<td>Batch Enroll</td>
				<td>No Polis</td>
				<td>Tgl Akseptasi Polis</td>
			</tr>
			<?php 
			$sql = "SELECT noenroll, a.prefixpertanggungan, a.nopertanggungan, 
						TO_CHAR(tglacceptance, 'dd/mm/yyyy hh24:mi:ss') tglakseptasi
					FROM $DBUser.enroll_2_admedika_detail a
					INNER JOIN $DBUser.tabel_214_acceptance_dokumen b ON a.prefixpertanggungan = b.prefixpertanggungan
						AND a.nopertanggungan = b.nopertanggungan
					WHERE noenroll IN ($whereinnoenroll)
					ORDER BY tglacceptance";
			$DB->parse($sql);
			$DB->execute();
			$i = 1;
			while($r = $DB->nextrow()) { ?>
				<tr bgcolor='#ffffff' class=verdana7blu>
					<td><?=$i?></td>
					<td><?=$r['NOENROLL']?></td>
					<td><?="$r[PREFIXPERTANGGUNGAN]-$r[NOPERTANGGUNGAN]"?></td>
					<td><?=$r['TGLAKSEPTASI']?>
				</tr>
				<?php $i++;
			} ?>
		</table>

		<br>
		<a href='../submenu.php?mnuinduk=200' style='text-decoration:none;'>Pertanggungan Baru</a>
	</body>
</html>

<script type="text/javascript">
	function openOtentikasi(noenroll, namafile) {
		$("#otentikasi").show();
		$("#noenroll").val(noenroll);
		$("#namafile").val(namafile);
	}
</script>