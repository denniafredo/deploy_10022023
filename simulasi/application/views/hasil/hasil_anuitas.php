<?php
	$buildid = $_GET['buildid'];

	$sql = "SELECT nama, 
				to_char(tgl_lahir, 'dd/mm/yyyy') tgllahir, 
				usia_th,
				CASE
					WHEN jenis_kelamin = 'M' THEN 'LAKI-LAKI'
					ELSE
						'PEREMPUAN'
				END jnskelamin
			FROM PRO_PEMPOL
			WHERE build_id = '".$buildid."'";
	$query = $this->db->query($sql);
	foreach ($query->result_array() as $row){
		$nama_cpp = $row["NAMA"];
		$tgllahir_cpp = $row["TGLLAHIR"];
		$usia_cpp	= $row["USIA_TH"];
		$jnskelamin_cpp = $row["JNSKELAMIN"];
	}

	$sql = "SELECT nama, 
				to_char(tgl_lahir, 'dd/mm/yyyy') tgllahir, 
				usia_th,
				CASE
					WHEN jenis_kelamin = 'M' THEN 'LAKI-LAKI'
					ELSE
						'PEREMPUAN'
				END jnskelamin
			FROM PRO_TERTANGGUNG
			WHERE build_id = '".$buildid."'";
	$query = $this->db->query($sql);
	foreach ($query->result_array() as $row){
		$nama_ctt = $row["NAMA"];
		$tgllahir_ctt = $row["TGLLAHIR"];
		$usia_ctt	= $row["USIA_TH"];
		$jnskelamin_ctt = $row["JNSKELAMIN"];
	}

	$sql = "SELECT 
				jumlah_premi,
				pht,
				to_char(tgl_rekam, 'dd/mm/yyyy') mulas 
			FROM JAIM_300_HITUNG
			WHERE build_id = '".$buildid."'";
	$query = $this->db->query($sql);
	foreach ($query->result_array() as $row){
		$premi = $row["JUMLAH_PREMI"];
		$mulas = $row["MULAS"];
		$pht = $row["PHT"];
		$pjd = $pht * 0.6;

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Proposal Anuitas</title>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?= base_url();?>assets/plugins/fonts.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<!-- BEGIN THEME STYLES -->
	<link href="<?= base_url();?>assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url();?>assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="<?= base_url();?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->
</head>
<body>
	<div class="">
		<div class="row" align="center">
			<div class="col-xs-12">
				<div class="well">
					<address>
						Ilustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi
					<address>
				</div>
			</div>
		</div>
		<div class="row invoice-logo">
			<div class="col-xs-6">
				<p>
					<h3>PT. ASURANSI JIWASRAYA (PERSERO)</h3>
				</p>
				<p>
					Jl. Ir. H. Juanda No. 34 Jakarta - 10120
				</p>
			</div>
			<div class="col-xs-6 invoice-logo-space" align="right" style="padding-right: 50px">
				<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
			</div>
		</div>
    	&nbsp;
		<div class="row" align="center">
			<div class="col-xs-12">
				<div class="well" style="font-weight:bold;font-size:16px">
					ILUSTRASI MANFAAT PROGRAM ANUITAS PERTANGGUNGAN PERORANGAN
				</div>
			</div>
		</div>
		<hr/>
		<div class="row">
			<div class="col-xs-12">
				<ul class="list-unstyled">
					<div class="well" style="font-weight:bold;font-size:14px">
						CALON PEMEGANG POLIS
					</div>
					<div style="font-weight:bold;font-size:12px; padding-left: 20px;">
						<li>
							<strong> Nama Pemegang Polis : </strong><?=$nama_cpp;?>
						</li>
						<li>
							<strong> Tanggal Lahir : </strong> <?=$tgllahir_cpp;?>
						</li>
						<li>
							<strong> Usia : <?=$usia_cpp;?> Tahun 
						</li>
						<li>
							<strong> Jenis Kelamin : </strong> <?=$jnskelamin_cpp;?> 
						</li>
					</div>
					
				</ul>
			</div>	
		</div>
		<div class="row">
			<div class="col-xs-12">
				<ul class="list-unstyled">
					<div class="well" style="font-weight:bold;font-size:14px">
						CALON TERTANGGUNG
					</div>
					<div style="font-weight:bold;font-size:12px; padding-left: 20px;">
						<li>
							<strong> Nama Pemegang Polis : </strong><?=$nama_ctt;?>
						</li>
						<li>
							<strong> Tanggal Lahir : </strong> <?=$tgllahir_ctt;?>
						</li>
						<li>
							<strong> Usia : <?=$usia_ctt;?> Tahun 
						</li>
						<li>
							<strong> Jenis Kelamin : </strong> <?=$jnskelamin_ctt;?> 
						</li>
						</li>
					</div>
				</ul>
				<hr/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<ul class="list-unstyled">
					<div style="font-weight:bold;font-size:12px; padding-left: 20px;">
						<li>
							<strong> Mulai program Anuitas	: </strong><?=$mulas;?>
						</li>
						<li>
							<strong> Premi Sekaligus : </strong> Rp. <?= number_format($premi,0,'.',',');?>
						</li>
					</div>
					<br>
					<div class="row" align="center"></div>
					<hr>
				</ul>
			</div>
		</div>
		<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
			<div class="col-md-6">
			</div>

			<h3 class="block" align="center">Nilai Anuitas</h3>

			<div class="col-md-12">
				<div class="table-scrollable">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>No.</th>
								<th></th>
								<th></th>
								<th>Kawin</th>
								<th></th>
								<th>Lajang/Bujang</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>1.</td>
								<td>Anuitas Ideal</td>
								<td>Rp.</td>
								<td>
									<input class="form-control" placeholder="" type="" name="aikawin" id="aikawin" onChange="" value="<?= number_format($pht,0,'.',',');?>" readonly>
								</td>
								<td>Rp.</td>
								<td>
									<input class="form-control" placeholder="" type="" name="aibujang" id="aibujang" onChange="" value="<?= number_format($pjd,0,'.',',');?>" readonly>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
    
		<br>
		<br>  
     
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-offset-3 col-md-9">
				<a href="<?php echo $str;?>/prospek/proposal-pribadi?id=<?php echo $NoProspek; ?>" class="btn green button-kembali">
					Halaman Prospek <i class="m-icon-swapleft m-icon-white"></i>
				</a>
				<a target="_blank" href="<?= base_url().'jsanuitas_new/CetakPDF?build_id='.$buildid;?>" class="btn blue button-next">
					Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</div>
		</div>
	</div>
</body>
</html>
