<?php

	/**=====================================
		noted 		: Rekap Welcoming call
		date  		: 13012022
		created by 	: rizal
	=====================================**/
	
	include "../../includes/session.php"; 
	include "../../includes/database.php";
	$pilihtanggal = $pilihtanggal ? $pilihtanggal : date('d');
	$pilihbulan = $pilihbulan ? $pilihbulan : date('n');
	$pilihtahun = $pilihtahun ? $pilihtahun : date('Y');

	$pilihtanggal2 = $pilihtanggal2 ? $pilihtanggal2 : date('d');
	$pilihbulan2 = $pilihbulan2 ? $pilihbulan2 : date('n');
	$pilihtahun2 = $pilihtahun2 ? $pilihtahun2 : date('Y'); 

	$hari_array = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );

    $bulan_array = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    );

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" /> 
	    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> 
		<title>Rekap Welcoming Call</title>
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


		    const downloadExcel = () => {
		    	let r = confirm('Apakah anda ingin mendownload data ini?');
		    	if(r){
				    let table 	= document.getElementById('rwc');
				    let tanggal = document.getElementById('pilihtanggal').value;
				    let bulan	= document.getElementById('pilihbulan').value;
				    let tahun 	= document.getElementById('pilihtahun').value;

		    		let link = document.createElement("a");
					link.href = 'data:application/vnd.ms-excel,' + encodeURIComponent(table.outerHTML);
					link.download = `Rekap_Welcoming_Call_${tanggal}${bulan}${tahun}.xls`;
					link.click();
		    		alert('terdownload');
		    	}
		    }

		</script>
	</head>
	<body>
		<div id="loader" class="center"></div>
		<h4>DAFTAR REKAP WELCOMING CALL</h4>
		<form id="frm-daftar" action="<?=$PHP_SELF;?>" method="post">
			<input type='hidden' name='cari' value='<?=$cari?>' />
			<table cellpadding="1" cellspacing="2" border="0">
				<tr>
					<td>Periode</td>
					<td>:</td>
					<td>
						<select name='pilihtanggal' id="pilihtanggal">
							<?php $tanggal = date('d');
							for ($i=1;$i<=31;$i++) {
								$selected = $pilihtanggal == $i ? 'selected' : '';
								echo "<option value='$i' $selected>$i</option>";
							} ?>
						</select>
						<select name='pilihbulan' id="pilihbulan">
							<?php
							foreach ($bulan_array as $i => $v) {
								$selected = $pilihbulan == $i ? 'selected' : '';
								echo "<option value='$i' $selected>$v</option>";
							} ?>
						</select>
						<select name='pilihtahun' id="pilihtahun">
							<?php $tahun = date('Y')+1;
							for ($i=$tahun-5;$i<=$tahun;$i++) {
								$selected = $pilihtahun == $i ? 'selected' : '';
								echo "<option value='$i' $selected>$i</option>";
							} ?>
						</select>
					</td>
					<td>
						<b>s/d</b>
						<select name='pilihtanggal2' id="pilihtanggal2">
							<?php $tanggal = date('d');
							for ($i=1;$i<=31;$i++) {
								$selected = $pilihtanggal2 == $i ? 'selected' : '';
								echo "<option value='$i' $selected>$i</option>";
							} ?>
						</select>
						<select name='pilihbulan2' id="pilihbulan2">
							<?php
							foreach ($bulan_array as $i => $v) {
								$selected = $pilihbulan2 == $i ? 'selected' : '';
								echo "<option value='$i' $selected>$v</option>";
							} ?>
						</select>
						<select name='pilihtahun2' id="pilihtahun2">
							<?php $tahun = date('Y')+1;
							for ($i=$tahun-5;$i<=$tahun;$i++) {
								$selected = $pilihtahun2 == $i ? 'selected' : '';
								echo "<option value='$i' $selected>$i</option>";
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td colspan="1" align="left"><input name="cari" value="Cari" type="submit" style="padding:2px 12px;"></td>
					<td rowspan="5" valign="top">
						<table border="0" style="margin-left:1px;" cellpadding="3">
							<tr>
								<td>
									<font face="Verdana" size="1">
										<a href="javascript:;" onclick="downloadExcel()" style="text-decoration: none;"><i class="fa fa-download" style="color:green;"></i>&nbsp;Download Excel</a>
									</font>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</form>

		<hr size="1">
		<div id="table_wrapper">
			<table border="0" cellspacing="1" cellpadding="4" width="100%" bordercolor="#B3CFFF" id="rwc">
				<tr bgcolor="#b1c8ed" align="center">
					<td rowspan='2'><b>No</b></td>
					<td rowspan='2'><b>No Polis</b></td>
					<td rowspan='2'><b>Tanggal Agenda</b></td>
					<td rowspan='2'><b>Waktu Agenda</b></td>
					<td rowspan='2'><b>Keterangan</b></td>
				</tr>
				<tr>
				<?php
					/**  
						untuk mencari filter tanggal
					*/

					$results = array();

					if($cari){
						$filterbulan1 = str_pad($pilihtanggal, 2, "0", STR_PAD_LEFT).'-'.str_pad($pilihbulan, 2, "0", STR_PAD_LEFT).'-'."$pilihtahun";
						$filterbulan2 = str_pad($pilihtanggal2, 2, "0", STR_PAD_LEFT).'-'.str_pad($pilihbulan2, 2, "0", STR_PAD_LEFT).'-'."$pilihtahun2";
					}else{
						$filterbulan1 =  date("d-m-Y");
						$filterbulan2 =  date("d-m-Y");
					}

						/**
							noted 		: API untuk get data Follow up, by TGL Mutasi
							date 		: 13012022
							created by 	: Rizal Jihadudin

						**/

						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'https://aims.ifg-life.id/api/jsspaj/master/history-followup?from='.$filterbulan1.'&to='.$filterbulan2,
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'GET',
						));

						$response = curl_exec($curl);

						curl_close($curl);
						$results = json_decode($response);
						$results = $results->message->data;

						
				?>
				<?php 
					$no = 1; 

					$dataCount = count($results);

					if($dataCount > 0){

						foreach($results as $data) {
								$date 		= date_create($data->AGENDA_DATE);
								$hr 		= date('w', strtotime($data->AGENDA_DATE));
								$bl 		= date('n', strtotime($data->AGENDA_DATE));
								$tahun 		= date('Y', strtotime($data->AGENDA_DATE));
								$jam 		= date('H:i:s', strtotime($data->AGENDA_DATE));
								$tanggal 	= date('j', strtotime($data->AGENDA_DATE));
								$hari 		= $hari_array[$hr];
								$bulan 		= $bulan_array[$bl];

						?>
						<tr>			
							<td align="center"><?= $no++; ?>.</td>
							<td align="center"><?= $data->PREFIXPERTANGGUNGAN.$data->NOPERTANGGUNGAN ?></td>
							<td align="center"><?= $hari.', '.$tanggal.' '.$bulan.' '.$tahun ?></td>
							<td align="center"><?= $jam ?></td>
							<td align="left"><?= $data->KETERANGANMUTASI ?></td>
						</tr>
					
					<?php }?>
				<?php } else { ?>
					<tr>
						<td align="center" colspan="5">Tidak ada data</td>
					</tr>
				<?php }?>
			</table>
		</div>

		<hr size="1" color="#c0c0c0">
		<table width="100%">
		<tr>
			<td width="50%" class="arial10" align="left"><a href="../pelaporan/index.php">Menu Manajemen Informasi</a></td>
			<td width="50%" class="arial10" align="right"><a href="../mnuutama.php">Menu Utama</a></td>
		</tr>
	</table>

	</body>
</html>