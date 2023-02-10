<?php
	include "../../includes/common.php";
 	include "../includes/database.php";  
	include "../includes/session.php";
	$DB = new Database($DBUser,$DBPass,$DBName);
	$DB2 = new Database($DBUser,$DBPass,$DBName);

	$user_approve = in_array($modul, array('UND','ALL','ITC'));

	$pilihbulan = $pilihbulan ? $pilihbulan : date('n');
	$pilihtahun = $pilihtahun ? $pilihtahun : date('Y');

?>

<html>
<head>
	<meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge" /> 
	<title>Pemulihan</title>
	<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fontawesome.css" rel="stylesheet">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fa-brands.css" rel="stylesheet">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fa-solid.css" rel="stylesheet">
	<link href="../../includes/fontawesome5/web-fonts-with-css/css/fa-regular.css" rel="stylesheet">
	<style> 
        #loader { 
            border: 12px solid #f3f3f3; 
            border-radius: 50%; 
            border-top: 12px solid #444444; 
            width: 70px; 
            height: 70px; 
            animation: spin 1s linear infinite; 
        } 
          
        @keyframes spin { 
            100% { 
                transform: rotate(360deg); 
            } 
        } 
          
        .center { 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            margin: auto; 
        } 
    </style>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<script language="JavaScript">
		document.onreadystatechange = function() { 
            if (document.readyState !== "complete") { 
                document.querySelector( 
                  "body").style.visibility = "hidden"; 
                document.querySelector( 
                  "#loader").style.visibility = "visible"; 
            } else { 
                document.querySelector( 
                  "#loader").style.display = "none"; 
                document.querySelector( 
                  "body").style.visibility = "visible"; 
            } 
        }; 
		

		function cetakpdf(prefix, noper, kdproduk) {

			NewWindow('historis_transaksi_unitlink.php?view=1&prefix='+prefix+'&noper='+noper, 'UpdateRekening', '620', '600');

		}


	</script>
</head>

<body>
	<div id="loader" class="center"></div>
	<h4>DAFTAR PENGAJUAN PEMULIHAN</h4>
	<form id="frm-daftar" action="<?=$PHP_SELF;?>" method="post">
	<table cellpadding="1" cellspacing="2">
		<tr>
			<td>Periode</td>
			<td>:</td>
			<td>
				<select name='pilihtanggal'>
					<option value='semua' selected>-- Semua --</option>
					<?php $tanggal = date('d');
					for ($i=1;$i<=31;$i++) {
						$selected = $pilihtanggal == $i ? 'selected' : '';
						echo "<option value='$i' $selected>$i</option>";
					} ?>
				</select>
				<select name='pilihbulan'>
					<option value='semua' selected>-- Semua --</option>
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
			<td>Kantor</td>
			<td width="10">:</td>
			<td>
				<select name='pilihkantor'>
					<?php if ($kantor == 'KP') { ?>
						<option value='semua' selected>-- Semua Kantor --</option>
					<?php } 
					$sql = "SELECT kdkantor, namakantor
							FROM $DBUser.tabel_001_kantor
							WHERE status = '1'
								".($kantor!='KP'?"AND kdkantor = '$kantor'":"")."
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
			<td>Status</td>
			<td>:</td>
			<td>

				<select name='pilihstatus'>
						<option value='semua' selected>-- Semua Status --</option>
					<?php 
					$sql = "SELECT kdstatus, namastatus 
							FROM $DBUser.tabel_999_kode_status 
							WHERE jenisstatus = 'PULIH' 
								AND kdstatus IN ('0', '1', '2', '3', 'X') 
							ORDER BY kdstatus";
					$DB->parse($sql);
					$DB->execute();
					
					while ($v = $DB->nextrow()) {
						$selected = $pilihstatus == $v['KDSTATUS'] ? 'selected' : '';
						echo "<option value='$v[KDSTATUS]' $selected>$v[KDSTATUS] - $v[NAMASTATUS]</option>";
					} ?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="1" align="left"><input name="cari" value="Cari" type="submit" style="padding:2px 12px;"></td>
		</tr>
	</table>
	</form>
	
	<hr size="1">

	<table border="0" cellspacing="1" cellpadding="4" width="100%" bordercolor="#B3CFFF">
		<tr bgcolor="#b1c8ed" align="center">
			<td><b>No</b></td>
			<td><b>Nomor Polis</b></td>
			<td><b>Pemegang Polis</b></td>
			<td><b>Tertanggung</b></td>
			<td><b>Produk</b></td>
			<td><b>Tgl. Pengajuan</b></td>
			<td><b>Tgl. Perhitungan</b></td>
			<td><b>Tgl. Otorisasi</b></td>
			<td><b>User Rekam</b></td>
			<td bgcolor="#66FFB2"><b>Status</b></td>
			<td><b>Status Approval</b></td>
			<td><b>Keterangan</b></td>
			<td><b>Action</b></td>
		</tr>
		<?php
		if ($cari) {
			
			$filterkantor = $pilihkantor != 'semua' ? " AND a.kantorproses = '$pilihkantor' " : "";
			
			if($pilihtanggal != 'semua'){
				$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tglrekam, 'ddmmyyyy') = '".str_pad($pilihtanggal, 2, "0", STR_PAD_LEFT).str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : "";
			}else{
				$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tglrekam, 'mmyyyy') = '".str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : "AND TO_CHAR(a.tglrekam, 'yyyy') = '$pilihtahun' ";
			}

			$filterstatus = $pilihstatus != 'semua' ? " AND a.status = '$pilihstatus' " : "";

			$sql = "SELECT a.prefixpertanggungan,
						a.nopertanggungan,
						NVL(b.nopolbaru, b.prefixpertanggungan||b.nopertanggungan) nomor_polis,
						(SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = b.nopemegangpolis)nama_pp,
						(SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = b.notertanggung)nama_tu,
						b.kdproduk,
						a.nomorsip,
						(SELECT namastatus FROM $DBUser.tabel_999_kode_status WHERE kdstatus = a.status AND jenisstatus = 'PULIH')namastatus,
						a.status,
						a.userrekam,
						TO_CHAR (a.tglrekam, 'DD/MM/YYYY HH24:MI') tglmohon,
						TO_CHAR (a.tglhitung, 'DD/MM/YYYY') tglhitung,
						TO_CHAR (a.tglotorisasi, 'DD/MM/YYYY') tglotorisasi,
						a.suspend,
						a.keterangan,
						(SELECT namastatus FROM $DBUser.tabel_999_kode_status WHERE kdstatus = a.kdjenisapproval AND jenisstatus = 'APPROVAL')jenisapproval
					FROM $DBUser.tabel_700_pulih a
         			INNER JOIN $DBUser.tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan AND a.nopertanggungan = b.nopertanggungan
					WHERE b.kdpertanggungan = '2'
						--AND a.status = '0'
						".$filterbulan."
						".$filterkantor."
						".$filterstatus."
					ORDER BY a.tglrekam ASC, a.prefixpertanggungan, a.nopertanggungan";
			// echo $sql;
			$DB->parse($sql);
			$DB->execute();
			$i=1; 
			while ($r=$DB->nextrow()) { 
				$prefix = $r['PREFIXPERTANGGUNGAN'];
				$noper = $r['NOPERTANGGUNGAN'];
				$tglhitung = $r['TGLHITUNG'];
				$bgcolor = $r['SUSPEND'] == "1" ? "#FFFF33" : ($i%2 ? "#FFFFFF" : "");
		?>

				<tr bgcolor="<?=$bgcolor?>">
					<td align="center"><?=$i;?></td>
					<td><a href="#" onclick="NewWindow('../polis/polis.php?prefix=<?=$r['PREFIXPERTANGGUNGAN']?>&noper=<?=$r['NOPERTANGGUNGAN']?>','',800,600,1);"><?=$r['NOMOR_POLIS']?></a></td>
					<td align="left"><?=$r['NAMA_PP']?></td>
					<td align="left"><?=$r['NAMA_TU']?></td>
					<td align="center"><?=$r['KDPRODUK']?></td>
					<td align="center"><?=$r['TGLMOHON']?></td>
					<td align="center"><?=$r['TGLHITUNG']?></td>
					<td align="center"><?=$r['TGLOTORISASI']?></td>
					<td align="center"><?=$r['USERREKAM']?></td>
					<td align="center"><?=$r['NAMASTATUS']?></td>
					<td align="center"><?=$r['JENISAPPROVAL']?></td>
					<td align="center"><?=$r['KETERANGAN']?></td>
					<td align="center">
						<?php
							if($r['STATUS'] == '0'){
								if ($r['SUSPEND'] == '1'){
	                              	// echo "<input type=\"button\" name=\"update_pending\" value=\"Lanjut\" onClick=\"window.location.href=('../mutasiDPBCLNT/pemulihan_pending.php?lanjut_pending=1&prefixpertanggungannew=$prefix&nopertanggungannew=$noper&tglhitungnew=$tglhitung')\">";
	                              	echo "
										<button type='button' onclick='NewWindow(\"../mutasiDPBCLNT/pemulihan_pending.php?lanjut_pending=1&prefixpertanggungannew=".$prefix."&nopertanggungannew=".$noper."&tglhitungnew=".$tglhitung."\",\"popuppage\",\"850\",\"550\",\"yes\");'>Lanjut</button>
									";
								}else{
									if($user_approve){
										echo "<a href=\"#\" onclick=\"window.open('../mutasiDPBCLNT/aktifkanPolisPemulihan.php?prefixpertanggungan=$prefix&nopertanggungan=$noper')\">KLIK DISINI</a>";
									}else{
										echo "-";
									}
								}
                          	}

                          	if ($r['STATUS'] == '1') {
                          		echo "<a href=# onclick=NewWindow('../polis/cetakbatalrider.php?kdsip=$jenis&prefixpertanggungan=".$r["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$r["NOPERTANGGUNGAN"]."&nomorsip=".$r["NOMORSIP"]."&tglsip=".$r["TGLSIP"]."','',700,400,1)>CETAK KLAUSUL BATAL RIDER</a>";
                          	}

                          	if ($r['STATUS'] == '2') {
                          		echo "SPP TERBIT";
                          	}

                          	if ($r['STATUS'] == '3') {
                          		echo "<a href=# onclick=NewWindow('../polis/cetakbatalrider.php?kdsip=$jenis&prefixpertanggungan=".$r["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$r["NOPERTANGGUNGAN"]."&nomorsip=".$r["NOMORSIP"]."&tglsip=".$r["TGLSIP"]."','',700,400,1)>CETAK KLAUSUL BATAL RIDER</a>";
                          	}
						?>
					</td>
				</tr>
				<?php $i++;
			}
		} ?>
		
	</table>

	
	<hr size="1" color="#c0c0c0">
	
	<table width="100%">
		<tr>
			<td width="50%" class="arial10" align="left"><a href="../polisserv.php">Menu Pemeliharaan Polis</a></td>
			<td width="50%" class="arial10" align="right"><a href="../mnuutama.php">Menu Utama</a></td>
		</tr>
	</table>

</body>
</html>