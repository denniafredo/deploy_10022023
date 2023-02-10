<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	$DB = New database($userid, $passwd, $DBName);
	$pilihkantor = $pilihkantor ? $pilihkantor : $kantor;
	$pilihbulan = $pilihbulan ? $pilihbulan : date('n');
	$pilihtahun = $pilihtahun ? $pilihtahun : date('Y');
	$pending = in_array($modul, array('PSL','UND','ALL','ITC')) ? 1 : 0; // Role Pending ESPAJ : Presales, Underwriting dan All Menu
	$delete = in_array($modul, array('MKT','MKL','REP','ALL','ITC')) ? 1 : 0; // Role Tolak ESPAJ : Marketing Sales, KanRep dan All Menu
	$edit = in_array($modul, array('MKT','MKL','ALL','ITC','UND')); // Role Edit ESPAJ : Marketing and Sales dan All Menu
?>

<html>
<head>
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fontawesome.css" rel="stylesheet">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fa-brands.css" rel="stylesheet">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fa-solid.css" rel="stylesheet">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fa-regular.css" rel="stylesheet">
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<script type="text/javascript">
		function hapus(nospaj, pilihkantor, pilihbulan, pilihtahun, pilihstatus, pilihurut, pilihascdesc) {
			if (confirm('Apakah anda yakin data SPAJ no '+nospaj+' ingin dihapus?')) {
				window.location.href = "espaj.php?action=delete&submit=Cari&nospaj="+nospaj+"&pilihkantor="+pilihkantor+"&pilihbulan="+pilihbulan+"&pilihtahun="+pilihtahun+"&pilihstatus="+pilihstatus+"&pilihurut="+pilihurut+"&pilihascdesc="+pilihascdesc;
			}
		}
	</script>
    <title>Daftar ESPAJ</title>
</head>
<body>
	<form name="xxx" method="GET" action="<?=$_SERVER['PHP_SELF']?>">
		<table border="0">
			<tr>
				<td colspan="3"><font face="Verdana" size="2"><b>DAFTAR ESPAJ AIMS</b></font></td>
				<td rowspan="6" valign="top">
					<table border="0" style="margin-left:8px;" cellpadding="3">
						<?php
						if ($pending) { ?>
							<tr>
								<td>
									<font face="Verdana" size="1">
									<i class="far fa-lightbulb fa-lg" style="color:blue;"></i> Tunda/Pending ESPAJ
									</font>
								</td>
							</tr>
						<?php } 
						if ($edit) { ?>
							<tr>
								<td>
									<font face="Verdana" size="1">
									<i class="far fa-edit fa-lg" style="color:blue;"></i> Edit ESPAJ
									</font>
								</td>
							</tr>
						<?php }
						if ($delete) { ?>
							<tr>
								<td>
									<font face="Verdana" size="1">
									<i class="far fa-trash-alt fa-lg" style="color:blue;"></i> Batalkan/Hapus ESPAJ
									</font>
								</td>
							</tr>
						<?php } ?>
					</table>
				</td>
			</tr>
			<tr>
				<td>Kantor</td>
				<td width="10">:</td>
				<td>
					<select name='pilihkantor'>
						<?php if ($kantoruser == 'KP') { ?>
							<option value='semua' selected>-- Semua Kantor --</option>
						<?php } 
						$sql = "SELECT kdkantor, namakantor
								FROM $DBUser.tabel_001_kantor
								WHERE status = '1'
									".($kantoruser!='KP'?"AND kdkantor = '$kantor'":"")."
								CONNECT BY PRIOR kdkantor = kdkantorinduk
								START WITH kdkantorinduk IS NULL
								ORDER BY namakantor";
						$DB->parse($sql);
						$DB->execute();
						
						while ($v = $DB->nextrow()) {
							$selected = $pilihkantor == $v['KDKANTOR'] ? 'selected' : '';
							echo "<option value='$v[KDKANTOR]' $selected>$v[KDKANTOR] - $v[NAMAKANTOR]</option>";
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Periode</td>
				<td>:</td>
				<td>
					<select name='pilihbulan'>
						<option value='semua' selected>-- Semua Bulan --</option>
						<?php
						$bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						foreach ($bulan as $i => $v) {
							$selected = $pilihbulan == $i ? 'selected' : '';
							echo "<option value='$i' $selected>$v</option>";
						} ?>
					</select>
					<select name='pilihtahun'>
						<?php $tahun = date('Y');
						for ($i=$tahun-3;$i<=$tahun;$i++) {
							$selected = $pilihtahun == $i ? 'selected' : '';
							echo "<option value='$i' $selected>$i</option>";
						} ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
					<select name='pilihstatus'>
						<option value='semua' selected>-- Semua Status --</option>
						<?php 
						$status = array('espaj' => 'ESPAJ Proses', 'espajriject' => 'ESPAJ Batal', 'proposal' => 'Proposal Aktif', 'proposalriject' => 'Proposal Delete', 'polis' => 'Polis Aktif', 'polisriject' => 'Polis Delete');
						foreach ($status as $i => $v) {
							$selected = $pilihstatus == $i ? 'selected' : '';
							echo "<option value='$i' $selected>$v</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Urutkan</td>
				<td>:</td>
				<td>
					<select name='pilihurut'>
						<?php
						$urut = array('a.tanggalrekam' => 'Tanggal ESPAJ', 'NVL(b.tglrekam, c.tgl_rekam)' => 'Tanggal Build ID', 'g.namaklien1' => 'Nama Agen', 'a.namaklien1' => 'Nama Pemegang Polis');
						foreach ($urut as $i => $v) {
							$selected = $pilihurut == $i ? 'selected' : '';
							echo "<option value='$i' $selected>$v</option>";
						}
						?>
					</select>
					<select name='pilihascdesc'>
						<?php
						$ascdesc = array('ASC' => 'Ascending', 'DESC' => 'Descending');
						foreach ($ascdesc as $i => $v) {
							$selected = $pilihascdesc == $i ? 'selected' : '';
							echo "<option value='$i' $selected>$v</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2'></td>
				<td>
					<input type='submit' name='submit' value='Cari' /> 
					<!--input type='button' name='back' value='Kembali' onclick="window.location.href='../submenu.php?mnuinduk=200'" /-->
				</td>
			</tr>
		</table>
	</form>
	
	<?php
	
	// Delete
	if ($action == 'delete') {
		$sql = "SELECT COUNT(*) jmlpolis
				FROM $DBUser.tabel_200_pertanggungan
				WHERE nosp = '$nospaj'";
		$DB->parse($sql);
		$DB->execute();
		$r = $DB->nextrow();
		
		if ($r['JMLPOLIS'] == 0) {
			$sql = "UPDATE $DBUser.tabel_spaj_online SET status = 1, tanggalupdate = sysdate, userupdate = user
				WHERE nospaj = '$nospaj'";
			$DB->parse($sql);
			$DB->execute();
			
			if ($DB->errorcode) {
				echo "<font style='color:red'>Gagal Menghapus No ESPAJ $nospaj<br>Error : ".$DB->errormessage."</font>";
			} else {
				echo "<font style='color:green'>No ESPAJ $nospaj Berhasil Dihapus</font>";
			}
		} else {
			echo "<font style='color:red'>No ESPAJ $nospaj tidak dapat dihapus karena digunakan oleh $r[JMLPOLIS] Proposal/Polis.<br />Silahkan menghubungi Underwriting untuk melakukan update status Proposal/Polis menjadi Delete</font>";
		}
	}
	
	?>
	
	<hr />
	
	<?php if ($submit) { ?>
	<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
        <tr>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>No</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Build ID</b></font></td>
            <td colspan="3" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>ESPAJ</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Channel</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Agen</b></font></td>
            <td colspan="6" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Proposal / Polis</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Produk</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Pemegang Polis</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Premi</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TopUp-X</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Kantor</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Keterangan</b></font></td>
            <td rowspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Opsi</b></font></td>
        </tr>
		<tr>
			<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nomor</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Tanggal</b></font></td>
			<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nomor</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Tanggal</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Status</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nomor</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nama</b></font></td>
			<td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nomor</b></font></td>
            <td colspan="2" bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Status</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Entri</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Disetujui</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BP3</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nama</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>HP</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Kode</b></font></td>
            <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>Nama</b></font></td>
		</tr>
		
		<?php
		$filterkantor = $pilihkantor != 'semua' ? " AND f.kdkantor = '$pilihkantor' " : "";
		
		$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tanggalrekam, 'mmyyyy') = '".str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : " AND TO_CHAR(a.tanggalrekam, 'yyyy') = $pilihtahun ";

		$filterstatus = $pilihstatus == 'espaj' ? " AND a.status = '2' " : 
			($pilihstatus == 'espajriject' ? " AND a.status = '1' " : 
			($pilihstatus == 'proposal' ? " AND i.kdpertanggungan = '1' AND i.kdstatusfile = '1' " : 
			($pilihstatus == 'proposalriject' ? " AND i.kdpertanggungan = '1' AND i.kdstatusfile = '7' " : 
			($pilihstatus == 'polis' ? " AND i.kdpertanggungan = '2' AND i.kdstatusfile = '1' " : 
			($pilihstatus == 'polisriject' ? " AND i.kdpertanggungan = '2' AND i.kdstatusfile = '7' " : " AND a.status >= 2 ")))));
		$sql = "SELECT a.buildid, TO_CHAR(NVL(b.tglrekam, c.tgl_rekam), 'dd-mm-yyyy') tglrekam, a.nospaj, 
					TO_CHAR(a.tanggalrekam, 'dd-mm-yyyy') tanggalrekam, e.namaproduk, a.namaklien1, a.no_ponsel, 
					NVL(b.premi, c.jumlah_premi) premi, a.kodeagen, g.namaklien1 namaagen, f.kdkantor, h.namakantor, 
					nopolbaru, i.kdpertanggungan, TO_CHAR(i.tglrekam, 'dd-mm-yyyy') tglproposal, j.kdunderwriting, 
					TO_CHAR(j.tglunderwriting, 'dd-mm-yyyy') tglunderwriting, 
					NVL(i.keterangan, (SELECT keterangan FROM $DBUser.tabel_spaj_online WHERE nospaj = a.nospaj)) keterangan, a.status,
					i.prefixpertanggungan, i.nopertanggungan, k.namastatusfile, TO_CHAR(tglseatled, 'dd-mm-yyyy') tglseatled,
					CASE a.status WHEN 0 THEN 'Dikirim' WHEN 1 THEN 'Dibatalkan' WHEN 2 THEN 'Diproses' WHEN 3 THEN 'Selesai' END namastatus,
					(SELECT topup_sekaligus FROM pro_asuransi_pokok@jaim WHERE build_id = a.buildid) topupx,
					CASE g.kdklien WHEN 'D' THEN 'Digital' WHEN 'L' THEN 'LPA' ELSE 'Agency' END channel
				FROM (
					SELECT a.nospaj, a.buildid, a.tanggalrekam, a.kodeagen, c.namaklien1, c.no_ponsel, a.status
					FROM $DBUser.tabel_spaj_online a
					LEFT OUTER JOIN $DBUser.tabel_spaj_online_relasi b ON a.nospaj = b.nospaj
						AND b.relasi = '04'
					LEFT OUTER JOIN $DBUser.tabel_spaj_online_klien c ON b.noklien = c.noklien
					WHERE a.buildid IS NOT null
				) a
				LEFT OUTER JOIN jaim_302_hitung@jaim b ON a.buildid = b.buildid
				LEFT OUTER JOIN jaim_300_hitung@jaim c ON a.buildid = c.build_id
				LEFT OUTER JOIN $DBUser.tabel_spaj_online_produksi d ON a.nospaj = d.nospaj
				LEFT OUTER JOIN $DBUser.tabel_202_produk e ON d.jenisasuransi = e.kdproduk
				LEFT OUTER JOIN $DBUser.tabel_400_agen f ON a.kodeagen = f.noagen
				LEFT OUTER JOIN $DBUser.tabel_100_klien g ON a.kodeagen = g.noklien
				LEFT OUTER JOIN $DBUser.tabel_001_kantor h ON f.kdkantor = h.kdkantor
				LEFT OUTER JOIN (
					SELECT prefixpertanggungan, nopertanggungan, kdpertanggungan, nopolbaru, keterangan, tglrekam, kdstatusfile, nosp
					FROM $DBUser.tabel_200_pertanggungan
				) i ON a.nospaj = i.nosp
				LEFT OUTER JOIN $DBUser.tabel_214_underwriting j ON i.prefixpertanggungan = j.prefixpertanggungan
					AND i.nopertanggungan = j.nopertanggungan
				LEFT OUTER JOIN $DBUser.tabel_299_status_file k ON i.kdstatusfile = k.kdstatusfile
				LEFT OUTER JOIN $DBUser.tabel_300_historis_premi l ON i.prefixpertanggungan = l.prefixpertanggungan
					AND i.nopertanggungan = l.nopertanggungan
					AND kdkuitansi = 'BP3'
				WHERE 1 = 1
					$filterkantor
					$filterbulan
					$filterstatus
				ORDER BY $pilihurut $pilihascdesc";
		// echo $sql;
		$DB->parse($sql);
		$DB->execute();
		$i = 1;
		while ($r = $DB->nextrow()) { 
			$bgcolor = $r['KETERANGAN'] ? "#FFFF33" : ($i%2 ? "#FFFFFF" : ""); ?>
			<tr>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?="$i".($r['STATUS']<1?'*':'');?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1">
					<a href='javascript:void(0);' onClick="NewWindow('<?="$HTTP_HOST_AIM/simulasi/cetak?bid=$r[BUILDID]"?>', 'popupdokumen', '1000', '800', 'yes');"><?=$r['BUILDID']?></a></font>
				</td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['TGLREKAM']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1">
					<a href='javascript:void(0);' onClick="NewWindow('<?="$HTTP_HOST_AIM/spajonline/cetak?bid=$r[BUILDID]"?>', 'popupdokumen', '1000', '800', 'yes');"><?=$r['NOSPAJ']?></a></font>
				</td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['TANGGALREKAM']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['NAMASTATUS']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['CHANNEL']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['KODEAGEN']?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?=$r['NAMAAGEN']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1">
					<a href='javascript:void(0);' onClick="NewWindow('<?="../polis/polis.php?prefix=$r[PREFIXPERTANGGUNGAN]&noper=$r[NOPERTANGGUNGAN]"?>', 'popupdokumen', '1000', '800', 'yes');" ><?=$r['NOPOLBARU']?></a></font>
				</td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['KDPERTANGGUNGAN']=='2'?'Polis':($r['KDPERTANGGUNGAN']=='1'?'Proposal':'');?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['NAMASTATUSFILE']?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?=$r['TGLPROPOSAL']?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?=$r['TGLUNDERWRITING']?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?=$r['TGLSEATLED']?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?=$r['NAMAPRODUK']?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?=$r['NAMAKLIEN1']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?=$r['NO_PONSEL']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="right"><font face="Verdana" size="1"><?=number_format($r['PREMI'], 0, ',', '.')?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="right"><font face="Verdana" size="1"><?=number_format($r['TOPUPX'], 0, ',', '.')?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center"><font face="Verdana" size="1"><?="$r[KDKANTOR]"?></font></td>
				<td bgcolor="<?=$bgcolor?>"><font face="Verdana" size="1"><?="$r[NAMAKANTOR]"?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="left"><font face="Verdana" size="1"><?=$r['KETERANGAN']?></font></td>
				<td bgcolor="<?=$bgcolor?>" align="center" nowrap>
					<font face="Verdana" size="1">
					<?php
					if ($pending && !$r['KDPERTANGGUNGAN']) { ?>
						<a href='javascript:void(0);' onClick="NewWindow('<?="espajpending.php?nospaj=$r[NOSPAJ]"?>', 'popupdokumen', '800', '600', 'yes');"><i class="far fa-lightbulb fa-lg" style="color:blue;margin:0 3px;"></i></a>
					<?php }
					if ($edit && $r['KDPERTANGGUNGAN'] != '2' && empty($r['TGLUNDERWRITING'])) { ?>
						<a href='javascript:void(0);' onClick="NewWindow('<?="http://aims.ifg-life.id/mobileapi/spaj_bridge/edit.php?buildid=".base64_encode($r['BUILDID'])."&u=".base64_encode($namusr)?>', 'popupdokumen', '1200', '800', 'yes');"><i class="far fa-edit fa-lg" style="color:blue;margin:0 3px;"></i></a>
					<?php }
					if ($delete && $r['KDPERTANGGUNGAN'] != '2' && empty($r['TGLUNDERWRITING'])) { ?>
						<a href="javascript:void(0);" onClick="hapus('<?=$r['NOSPAJ']?>', '<?=$pilihkantor?>', '<?=$pilihbulan?>', '<?=$pilihtahun?>', '<?=$pilihstatus?>', '<?=$pilihurut?>', '<?=$pilihascdesc?>')"><i class="far fa-trash-alt fa-lg" style="color:blue;margin:0 3px;"></i></a>
					<?php } ?>
					</font>
				</td>
			</tr>
		<?php $i++; } ?>
	</table>
	<font size='2'><i>*Proses SCKLIK sedang berlangsung / gagal</i></font>
	<?php } ?>
</body>
</html>