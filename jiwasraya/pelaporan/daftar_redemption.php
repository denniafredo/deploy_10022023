<?php
	include "../../includes/common.php";
 	include "../includes/database.php";  
	include "../includes/session.php";
	$DB = new Database($DBUser,$DBPass,$DBName);
	$DB2 = new Database($DBUser,$DBPass,$DBName);

	$pilihbulan = $pilihbulan ? $pilihbulan : date('n');
	$pilihtahun = $pilihtahun ? $pilihtahun : date('Y');

?>

<html>
<head>
	<meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge" /> 
	<title>Redemption</title>
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
	</script>
</head>

<body>
	<div id="loader" class="center"></div>
	<h4>DAFTAR PENGAJUAN REDEMPTION</h4>
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
			<td><b>Kode Produk</b></td>
			<td><b>Status Polis</b></td>
			<td><b>Tgl. Pengajuan</b></td>
			<td><b>Jenis Redemption</b></td>
			<td><b>Nama Fund</b></td>
			<td><b>Jumlah Unit / Rupiah</b></td>
			<td><b>Nama Penerima</b></td>
			<td><b>No. Rekening</b></td>
			<td><b>Nama Bank</b></td>
			<td><b>Cabang</b></td>
			<!-- <td bgcolor="#66FFB2"><b>Status</b></td> -->
		</tr>
		<?php
		if ($cari) {
			
			$filterkantor = $pilihkantor != 'semua' ? " AND a.kantorproses = '$pilihkantor' " : "";
			
			if($pilihtanggal != 'semua'){
				$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tgl_pengajuan, 'ddmmyyyy') = '".str_pad($pilihtanggal, 2, "0", STR_PAD_LEFT).str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : "";
			}else{
				$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tgl_pengajuan, 'mmyyyy') = '".str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : "AND TO_CHAR(a.tgl_pengajuan, 'yyyy') = '$pilihtahun' ";
			}

			$sql = "SELECT A.PREFIXPERTANGGUNGAN,
						A.NOPERTANGGUNGAN,
						NVL(B.NOPOLBARU, B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN) NOMOR_POLIS,
						B.KDPRODUK,
						(SELECT NAMASTATUSFILE FROM $DBUser.TABEL_299_STATUS_FILE WHERE KDSTATUSFILE = B.KDSTATUSFILE) STATUSPOLIS,
						C.NAMAKLIEN1 NAMA_PP,
						TO_CHAR(A.TGL_PENGAJUAN, 'DD/MM/YYYY') TGL_PENGAJUAN,
						DECODE(A.KODE_JENIS, 'U', 'UNIT', 'RUPIAH') JENISREDEMPTION,
						A.JUMLAH,
						A.PENERIMA,
						A.REKENING,
						A.BANK,
						A.CABANG,
						A.KDFUND,
						(SELECT NAMAFUND FROM $DBUser.TABEL_UL_KODE_FUND WHERE KDFUND = A.KDFUND) NAMAFUND,
						A.STATUS
					FROM $DBUser.TABEL_UL_PENGAJUAN_REDEMPTION A
					INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN B ON A.PREFIXPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN AND A.NOPERTANGGUNGAN = B.NOPERTANGGUNGAN
					LEFT JOIN $DBUser.TABEL_100_KLIEN C ON B.NOPEMEGANGPOLIS = C.NOKLIEN
					WHERE B.KDPERTANGGUNGAN = '2'
						".$filterbulan."
					ORDER BY A.TGL_PENGAJUAN DESC, A.PREFIXPERTANGGUNGAN, A.NOPERTANGGUNGAN, A.KDFUND ASC 
					";
			// echo $sql;
			$DB->parse($sql);
			$DB->execute();
			$i=1; 
			while ($r=$DB->nextrow()) { 
				$prefix = $r['PREFIXPERTANGGUNGAN'];
				$noper = $r['NOPERTANGGUNGAN'];
				$bgcolor = $r['SUSPEND'] == "1" ? "#FFFF33" : ($i%2 ? "#FFFFFF" : "");
		?>

				<tr bgcolor="<?=$bgcolor?>">
					<td align="center"><?=$i;?></td>
					<td>
						<a href="#" onclick="NewWindow('../polis/polis.php?prefix=<?=$r['PREFIXPERTANGGUNGAN']?>&noper=<?=$r['NOPERTANGGUNGAN']?>','',800,600,1);"><?=$r['NOMOR_POLIS']?></a>
					</td>
					<td align="left"><?=$r['NAMA_PP']?></td>
					<td align="center"><?=$r['KDPRODUK']?></td>
					<td align="center"><?=$r['STATUSPOLIS']?></td>
					<td align="center"><?=$r['TGL_PENGAJUAN']?></td>
					<td align="center"><?=$r['JENISREDEMPTION']?></td>
					<td align="center"><?=$r['NAMAFUND']?></td>
					<td align="center"><?=$r['JUMLAH']?></td>
					<td align="center"><?=$r['PENERIMA']?></td>
					<td align="center"><?=$r['REKENING']?></td>
					<td align="center"><?=$r['BANK']?></td>
					<td align="center"><?=$r['CABANG']?></td>
					<!-- <td align="center"><?=$r['STATUS']?></td> -->
				</tr>
				<?php $i++;
			}
		} ?>
		
	</table>

	
	<hr size="1" color="#c0c0c0">
	
	<table width="100%">
		<tr>
			<td width="50%" class="arial10" align="left"><a href="../submenu.php?mnuinduk=150">Menu All New Unit Link</a></td>
			<td width="50%" class="arial10" align="right"><a href="../mnuutama.php">Menu Utama</a></td>
		</tr>
	</table>

</body>
</html>