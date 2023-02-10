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
	<title>Dashboard Eklaim</title>
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
	<h4>DAFTAR HISTORIS POLIS LAPSE</h4>
	<form id="frm-daftar" action="<?=$PHP_SELF;?>" method="post">
	<table cellpadding="1" cellspacing="2">
		<tr>
			<td>Tgl. Lapse</td>
			<td>:</td>
			<td>
				<select name='pilihtanggal'>
					<option value='semua' selected>-- All --</option>
					<?php $tanggal = date('d');
					for ($i=1;$i<=31;$i++) {
						$selected = $pilihtanggal == $i ? 'selected' : '';
						echo "<option value='$i' $selected>$i</option>";
					} ?>
				</select>
				<select name='pilihbulan'>
					<option value='semua' selected>-- All --</option>
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
			<td>Kode Produk</td>
			<td width="10">:</td>
			<td>
				<select name='pilihproduk'>
					<?php if ($kantoruser == 'KP') { ?>
						<option value='semua' selected>-- Semua Produk --</option>
					<?php } 
					$sql = "SELECT B.KDPRODUK, C.NAMAPRODUK
							FROM $DBUser.TABEL_999_PROSES_BPO_LOG A
							INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN B ON A.PREFIXPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN AND A.NOPERTANGGUNGAN = B.NOPERTANGGUNGAN
							INNER JOIN $DBUser.TABEL_202_PRODUK C ON B.KDPRODUK = C.KDPRODUK
							GROUP BY B.KDPRODUK, C.NAMAPRODUK
							ORDER BY B.KDPRODUK
							";
					$DB->parse($sql);
					$DB->execute();
					
					while ($v = $DB->nextrow()) {
						$selected = $pilihproduk == $v['KDPRODUK'] ? 'selected' : '';
						echo "<option value='$v[KDPRODUK]' $selected>$v[KDPRODUK] - $v[NAMAPRODUK]</option>";
					} ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Cara Bayar</td>
			<td>:</td>
			<td>
				<select name="pilihcarabayar" onFocus="highlight(event)" class="c">
					<option value='semua'>-- Semua Cara Bayar --</option>
					<option value='M' <?php echo($pilihcarabayar == 'M')?'selected' : '';?> >BULANAN</option>
					<option value='K,Q' <?php echo($pilihcarabayar == 'K,Q')?'selected' : '';?> >KUARTALAN</option>
					<option value='H' <?php echo($pilihcarabayar == 'H')?'selected' : '';?> >SEMESTERAN</option>
					<option value='A' <?php echo($pilihcarabayar == 'A')?'selected' : '';?> >TAHUNAN</option>
					<option value='X' <?php echo($pilihcarabayar == 'X')?'selected' : '';?> >SEKALIGUS</option>
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
			<td><b>Produk</b></td>
			<td><b>Mulas</b></td>
			<td><b>Cara Bayar</b></td>
			<td><b>Lunas Terakhir</b></td>
			<td><b>Status Polis</b></td>
			<td><b>Tgl. Lapse</b></td>
			<td><b>Keterangan</b></td>
		</tr>
		<?php
		if ($cari) {

			if($pilihtanggal != 'semua'){
				$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tgllapse, 'ddmmyyyy') = '".str_pad($pilihtanggal, 2, "0", STR_PAD_LEFT).str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : "";
			}else{
				$filterbulan = $pilihbulan != 'semua' ? " AND TO_CHAR(a.tgllapse, 'mmyyyy') = '".str_pad($pilihbulan, 2, "0", STR_PAD_LEFT)."$pilihtahun' " : "AND TO_CHAR(a.tgllapse, 'yyyy') = '$pilihtahun' ";
			}
			
			$filterkantor = $pilihkantor != 'semua' ? " AND e.kdrayonpenagih = '$pilihkantor' " : "";
			$filterproduk = $pilihproduk != 'semua' ? " AND b.kdproduk = '$pilihproduk' " : "";
			$filtercarabayar = $pilihcarabayar != 'semua' ? " AND b.kdcarabayar = '$pilihcarabayar' " : "";

			$sql = "SELECT 
						A.PREFIXPERTANGGUNGAN,
						A.NOPERTANGGUNGAN,
						NVL(B.NOPOLBARU, B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN) NOPOLIS,
						C.NAMAKLIEN1 AS NAMA_PP,
						B.KDPRODUK,
						(SELECT NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR WHERE KDCARABAYAR = B.KDCARABAYAR) NAMACARABAYAR,
						TO_CHAR((SELECT MAX(TGLBOOKED) FROM $DBUser.TABEL_300_HISTORIS_PREMI WHERE PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN AND TGLSEATLED IS NOT NULL), 'DD/MM/YYYY') LUNAS_TERAKHIR,
						TO_CHAR(B.MULAS, 'DD/MM/YYYY') MULAS,
						TO_CHAR(A.TGLLAPSE, 'DD/MM/YYYY') TGLLAPSE,
						A.KETERANGAN,
						(SELECT NAMASTATUSFILE FROM $DBUser.TABEL_299_STATUS_FILE WHERE KDSTATUSFILE = B.KDSTATUSFILE) NAMASTATUSFILE
					FROM $DBUser.TABEL_999_PROSES_BPO_LOG A
					INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN B ON A.PREFIXPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN AND A.NOPERTANGGUNGAN = B.NOPERTANGGUNGAN
					LEFT JOIN $DBUser.TABEL_100_KLIEN C ON B.NOPEMEGANGPOLIS = C.NOKLIEN
					LEFT OUTER JOIN $DBUser.TABEL_500_PENAGIH E ON B.NOPENAGIH = E.NOPENAGIH
					WHERE B.KDPERTANGGUNGAN = '2'
						AND A.KETERANGAN NOT LIKE '%PREMIUM HOLIDAY%'
						".$filterbulan."
						".$filterkantor."
						".$filterproduk."
						".$filtercarabayar."
					ORDER BY A.TGLLAPSE, NVL(B.NOPOLBARU, B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN)";
			// echo $sql;
			$DB->parse($sql);
			$DB->execute();
			$i=1; 
			while ($r=$DB->nextrow()) { ?>
				
				<tr bgcolor="<?=$color?>" align="center">
					<td ><?=$i;?></td>
					<td><a href="#" onclick="NewWindow('../../polis/polis.php?prefix=<?=$r['PREFIXPERTANGGUNGAN']?>&noper=<?=$r['NOPERTANGGUNGAN']?>','',800,600,1);"><?=$r['NOPOLIS']?></a></td>
					<td align="left"><?=$r['NAMA_PP']?></td>
					<td><?=$r['KDPRODUK']?></td>
					<td><?=$r['MULAS']?></td>
					<td><?=$r['NAMACARABAYAR']?></td>
					<td><?=$r['LUNAS_TERAKHIR']?></td>
					<td><?=$r['NAMASTATUSFILE']?></td>
					<td><?=$r['TGLLAPSE']?></td>
					<td><?=$r['KETERANGAN']?></td>
				</tr>
				<?php $i++;
			}
		} ?>
	</table>
	
	<hr size="1" color="#c0c0c0">
	
	<table width="100%">
		<tr>
			<td width="50%" class="arial10" align="left"><a href="../../../polisserv.php">Menu Pemeliharaan Polis</a></td>
			<td width="50%" class="arial10" align="right"><a href="../../../mnuutama.php">Menu Utama</a></td>
		</tr>
	</table>

</body>
</html>