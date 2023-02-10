<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/loadingoverlay.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery.formatter.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootbox/bootbox.all.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		$('.datepicker').datepicker({format: 'dd-mm-yyyy'});
		$("#noktpcalontertanggung").formatter({'pattern': '{{9999999999999999}}' });
		
		// Kirim data simpan simulasi
		$('#submitProposal').click(function() {
			$.LoadingOverlay("show");
			
			if (!$("#namacalontertanggung").val()) {
				bootbox.alert("Nama Lengkap Tertanggung wajib diisi!");
			} else if (!$("#tanggallahircalontertanggung").val()) {
				bootbox.alert("Tanggal Lahir Tertanggung wajib diisi!");
			} else if (!$("#kdjeniskelamincalontertanggung").val()) {
				bootbox.alert("Jenis Kelamin Tertanggung wajib dipilih!");
			} else if (!$("#noktpcalontertanggung").val()) {
				bootbox.alert("No KTP Tertanggung wajib diisi!");
			} else if ($("#noktpcalontertanggung").val().length < 16) {
				bootbox.alert("No KTP Tertanggung tidak valid!");
			} else if (!$("#hubungandenganpempol").val()) {
				bootbox.alert("Hubungan dengan calon pemegang polis wajib diisi!");
			} else if (!$("#kdpekerjaancalontertanggung").val()) {
				bootbox.alert("Pekerjaan Tertanggung wajib dipilih!");
			} else if (!$("#kdhobicalontertanggung").val()) {
				bootbox.alert("Hobi Tertanggung wajib dipilih!");
			} else if (!$('#totalpremi').val()) {
				bootbox.alert("Premi harus lebih besar dari 0!");
			} else {
				$("#form-pa").submit();
			}
		});
		
		
		// pekerjaan diubah
		$('#kdpekerjaancalontertanggung').change(function() {
			get_pekerjaan_hobi();
			hitung_premi();
		});
		
		
		// Hobi diubah
		$('#kdhobicalontertanggung').change(function() {
			get_pekerjaan_hobi();
			hitung_premi();
		});
		
		
		//Menghitung usia calon tertanggung
		$('#tanggallahircalontertanggung').on('change', function() {
			var tgllahirctt = $("#tanggallahircalontertanggung").val();
			var tgllahircttsplit = tgllahirctt.split("-");
			var hariini = new Date();
			var birthday_ctt = new Date(+tgllahircttsplit[2], tgllahircttsplit[1] - 1, +tgllahircttsplit[0]);
			
			if (hariini.getMonth() < birthday_ctt.getMonth()) {
				var tahun = 1;
			} else if ((hariini.getMonth() == birthday_ctt.getMonth()) && hariini.getDate() < birthday_ctt.getDate()) {
				var tahun = 1;
			} else {
				var tahun = 0;
			}
			var age = hariini.getFullYear() - birthday_ctt.getFullYear() - tahun;
			$("#usiacalontertanggung").val(Math.floor(age));
			$('#usiacalontertanggungtahun').val($('#usiacalontertanggung').val()+' Tahun');
			var usia = Math.floor((hariini-birthday_ctt) / (365.7 * 24 * 60 * 60 * 1000));
			
			if(usia < 17 || age > 69) {
				$("#tanggallahircalontertanggung").val('');
				bootbox.alert("Calon Tertanggung Minimal berusia 17 tahun dan Maksimal berusia 69 tahun");
			}
		});
		
		
		// menghitung uang asuransi
		$('#uangasuransi').on('blur', function() {
			ua = $(this).val();
			penghasilan = $('#penghasilansatutahun').val();
			minua = 50000000;
			maxua = 500000000;
			
			if (!penghasilan) {
				$('#uangasuransi').val('');
				alert("Silahkan isi Penghasilan Satu Tahun terlebih dahulu!");
			} else if (ua < minua) {
				$('#uangasuransi').val('');
				alert("Uang Asuransi minimum adalah sebesar "+number_format(minua, 0, ',', '.'));
			} else if (ua > maxua) {
				$('#uangasuransi').val('');
				alert("Uang Asuransi maksimum adalah sebesar "+number_format(maxua, 0, ',', '.'));
			} else if (ua > (penghasilan*2)) {
				$('#uangasuransi').val('');
				alert("Uang Asuransi maksimum adalah sebesar 2 x Penghasilan Satu Tahun dan tidak melebihi "+number_format(maxua, 0, ',', '.'));
			} else {
				hitung_premi();
			}
		});
		
		// menghitung resiko finansial
		$('#penghasilansatutahun').on('blur', function() {
			$.LoadingOverlay("show");
			
			usia = $("#usiacalontertanggung").val();
			
			$('#resikofinansialctt').val(number_format((55 - usia) * $(this).val(), 0, ',', '.'));
			
			$.LoadingOverlay("hide");
		});
	});
	
	// Checkbox tertanggung sama dengan pemegang polis
	function cekCPPsamadenganCTT() {
		$.LoadingOverlay("show");
		var checkBox = document.getElementById("tertanggungsamadenganpemegangpolis");
		
		if (checkBox.checked == true) {
			var kdpekerjaanctt = $("#kdpekerjaanpemegangpolis").val();
			var kdhobictt = $("#kdhobipemegangpolis").val();
			
			$("#namacalontertanggung").val($("#namapemegangpolis").val()).prop('disabled', true);
			$("#tanggallahircalontertanggung").val($("#tanggallahirpemegangpolis").val()).prop('disabled', true);
			$("#kdjeniskelamincalontertanggung").val($("#kdjeniskelaminpemegangpolis").val()).prop('disabled', true);
			$("#usiacalontertanggung").val($("#usiapemegangpolis").val());
			$("#usiacalontertanggungtahun").val($("#usiapemegangpolistahun").val()).prop('disabled', true);
			$("#noktpcalontertanggung").val($("#noktppemegangpolis").val()).prop('disabled', true);
			$("#hubungandenganpempol").val('04').prop('disabled', true);
			$("#kdpekerjaancalontertanggung").val(kdpekerjaanctt).prop('disabled', true);
			$("#kdhobicalontertanggung").val(kdhobictt).prop('disabled', true);
			
			get_pekerjaan_hobi();
		} else {
			$("#namacalontertanggung").val('').prop('disabled', false);
			$("#tanggallahircalontertanggung").val('').prop('disabled', false);
			$("#kdjeniskelamincalontertanggung").val('').prop('disabled', false);
			$("#usiacalontertanggung").val('');
			$("#usiacalontertanggungtahun").val('').prop('disabled', false);
			$("#noktpcalontertanggung").val('').prop('disabled', false);
			$("#hubungandenganpempol").val('').prop('disabled', false);
			$("#kdpekerjaancalontertanggung").val('').prop('disabled', false);
			$("#kdhobicalontertanggung").val('').prop('disabled', false);
		};
		
		$('#penghasilansatutahun').val('');
		$('#uangasuransi').val('');
		$('#totalpremi').val('');
		$('#totalpremirp').val('');
		$('#resikoawalproposalctt').val('');
		$("input[name='resikoawalproposalctt']").val('');
		$('#resikoawalproposalcpp').val('');
		$("input[name='resikoawalproposalcpp']").val('');
					
		$.LoadingOverlay("hide");
	};
	
	
	// Ambil tarif pekerjaan dan hobi
	function get_pekerjaan_hobi() {
		var kdpekerjaanctt = $("#kdpekerjaancalontertanggung").val();
		var kdhobictt = $("#kdhobicalontertanggung").val();
		
		if (kdpekerjaanctt) { console.log('asfdas');
			$.ajax({
				type	: "GET",
				dataType: "json",
				//url		: "<?=C_URL_API.'/master/pekerjaan/';?>"+kdpekerjaanctt,
				url		: "<?=base_url('master/pekerjaan')?>/"+kdpekerjaanctt,
				success : function(data) {
					if (!data.error) {
						$("#pekerjaanpa").val(data.message.PA);
						$("#pekerjaanpembagipa").val(data.message.PEMBAGIPA);
						
						if (data.message.FLAGPA == 'DECLINE') {
							redirect_resiko_tinggi();
						}
					}
				}
			});
		}
		
		if (kdhobictt) {
			$.ajax({
				type	: "GET",
				dataType: "json",
				//url		: "<?=C_URL_API.'/master/hobi/';?>"+kdhobictt,
				url		: "<?=base_url('master/hobi')?>/"+kdhobictt,
				success : function(data) {
					if (!data.error) {
						$("#hobipa").val(data.message.PA);
						$("#hobipembagipa").val(data.message.PEMBAGIPA);
						
						if (data.message.FLAGPA == 'DECLINE') {
							redirect_resiko_tinggi();
						}
					}
				}
			});
		}
	}
	
	
	// Redirect resiko terlalu tinggi
	function redirect_resiko_tinggi() {
		bootbox.alert("Maaf permintaan asuransi Anda tidak dapat kami penuhi karena resiko Anda terlalu tinggi!", function(){ 
			window.location.href = '<?=str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=".$this->input->get("noid")?>';
		});
	}
	
	
	// Kalkulasi premi
	function hitung_premi() {
		$.ajax({
			type	: "GET",
			dataType: "json",
			//url		: "<?=C_URL_API.'/master/tarif';?>",
			url		: "<?=base_url('master/tarif')?>",
			data	: "kdproduk=<?=$kdproduk?>&usiath="+$("#usiacalontertanggung").val(),
			beforeSend: function() {
				$.LoadingOverlay("show");
			},
			success : function(data) {
				if (!data.error) {
					var ua = $('#uangasuransi').val();
					var sama = $('#tertanggungsamadenganpemegangpolis').is(":checked");
				
					premistd = (ua*data.message.TARIF)/1000000;
					resikopekerjaan = premistd * $("#pekerjaanpa").val() / $("#pekerjaanpembagipa").val();
					resikohobi = ua * $("#hobipa").val() / $("#hobipembagipa").val();
					$('#totalpremi').val(Math.round(premistd+resikopekerjaan+resikohobi));
					$('#totalpremirp').val(number_format($('#totalpremi').val(), 0, ',', '.'));
					$('#resikoawalproposalctt').val(number_format(ua, 0, ',', '.'));
					$("input[name='resikoawalproposalctt']").val(ua);
					$('#resikoawalproposalcpp').val(number_format(sama ? ua : 0, 0, ',', '.'));
					$("input[name='resikoawalproposalcpp']").val(sama ? ua : 0);
					
					// Tampilkan informasi premi substandard
					if (resikopekerjaan+resikohobi > 0) {
						$(".premiSubStandard").removeClass('hide');
					} else {
						$(".premiSubStandard").addClass('hide');
					}
					
					console.log('sama : ' +sama);
					console.log('premistd : ' +premistd);
					console.log('resikopekerjaan : ' +resikopekerjaan);
					console.log('resikohobi : '+resikohobi);
				}
			},
			complete: function() {
				$.LoadingOverlay("hide");
			}
		});
	}
	
	
	
</script>

<!-- Header ada di file header.php terpisah -->

	<!-- BEGIN BODY -->
	<body class="page-header-fixed">
		<!--div class="clearfix"></div-->
	
		<!-- BEGIN CONTAINER -->
		<div class="">
	
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
							<h3 class="page-title" align="center">
								<img src="<?= base_url();?>assets/img/jspos.jpg"/> <small>Power on Sales</small>
							</h3>
					
						</div>
					</div>
					<!-- END PAGE HEADER-->
			
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue" id="form_wizard_1">
								<div class="portlet-title" align="center">
									<div class="caption">
										<i class="fa fa-reorder"></i> Simulasi Produk -
										<span class="step-title"><?=$produk['NAMAPRODUK']?></span>
									</div>
								</div>
								
								<div class="portlet-body form">
									<form action="<?=base_url("personalaccident/save")?>" class="form-horizontal" id="form-pa" method="post">
										<input type="text" id="pekerjaanpa" style="display:none;" />
										<input type="text" id="pekerjaanpembagipa" style="display:none;" />
										<input type="text" id="hobipa" style="display:none;" />
										<input type="text" id="hobipembagipa" style="display:none;" />
										<input type="hidden" name="noagen" value="<?=$this->input->get('noagen')?>" />
										<input type="hidden" name="kdproduk" value="<?=$this->input->get('kdproduk')?>" />
										<div class="form-wizard">
											<div class="form-body">
												<div class="box box-info">
													<!--Start Input Data Calon Pemegang Polis-->
													<div class="box-header with-border">
													  <h3 class="box-title">Data Diri Calon Pemegang Polis</h3>
													</div>
													</br>
													<div class="box-body">
														<div class="row">
															<!-- Kolom Kiri -->
															<div class="col-md-4">
																<!--Input Nama-->
																<div class="form-group">
																	<label class="control-label col-md-4">Nama Lengkap</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAKLIEN'];?></b></label>
																	<input type="hidden" name="namapemegangpolis" id="namapemegangpolis" value="<?=$prospek['NAMAKLIEN'];?>"/>
																</div>
																<!--Input Jenis Kelamin-->
																<div class="form-group">
																	<label class="control-label col-md-4">Jenis Kelamin</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAJENISKELAMIN'];?></b></label>
																	<input type="hidden" value="<?=$prospek['NAMAJENISKELAMIN'];?>"/>
																	<input type="hidden" id="kdjeniskelaminpemegangpolis" name="kdjeniskelaminpemegangpolis" value="<?=$prospek['KDJENISKELAMIN'];?>" />
																</div>
																<!--Input Tanggal Lahir-->
																<div class="form-group">
																	<label class="control-label col-md-4">Tanggal Lahir</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['TGLLAHIR'];?></b></label>
																	<input type="hidden" id="tanggallahirpemegangpolis" name="tanggallahirpemegangpolis" value="<?=$prospek['TGLLAHIR'];?>" />
																</div>	
																<!--Input Usia-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?="$prospek[USIA] Tahun"?></b></label>
																	<input type="hidden" id="usiapemegangpolistahun" value="<?="$prospek[USIA] Tahun"?>" />
																	<input type="hidden" name="usiapemegangpolis" id="usiapemegangpolis" value="<?=$prospek['USIA']?>" />
																</div>
															</div>
															<!-- Kolom Tengah -->
															<div class="col-md-4">
																<!--Input KTP-->
																<div class="form-group">
																	<label class="control-label col-md-4">No KTP</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NOID']?></b></label>
																	<input type="hidden" name="noktppemegangpolis" id="noktppemegangpolis" value="<?=$prospek['NOID'];?>" />
																</div>
																<!--Input Jenis Pekerjaan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Pekerjaan</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAPEKERJAAN']?></b></label>
																	<input type="hidden" value="<?=$prospek['NAMAPEKERJAAN'];?>"/>
																	<input type="hidden" name="kdpekerjaanpemegangpolis" id="kdpekerjaanpemegangpolis" value="<?=$prospek['KDPEKERJAAN'];?>" />
																</div>
																<!--Input Hobi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Hobi</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAHOBI']?></b></label>
																	<input type="hidden" value="<?=$prospek['NAMAHOBI'];?>"/>
																	<input type="hidden" name="kdhobipemegangpolis" id="kdhobipemegangpolis" value="<?=$prospek['KDHOBI'];?>" />
																</div>
																<!--Input nomor HP-->
																<div class="form-group">
																	<label class="control-label col-md-4">Telepon/HP</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b>
																		<?php if ($prospek['TELEPON'] && $prospek['HP']) { echo "$prospek[TELEPON]/$prospek[HP]"; }
																			else if ($prospek['TELEPON']) { echo $prospek['TELEPON']; }
																			else if ($prospek['HP']) { echo $prospek['HP']; }
																		?>
																		</b>
																	</label>
																	<input type="hidden" name="phonepemegangpolis" id="phonepemegangpolis" value="<?=$prospek['TELEPON'];?>"/>
																	<input type="hidden" name="handphonepemegangpolis" id="handphonepemegangpolis" value="<?=$prospek['HP'];?>"/>
																</div>
															</div>
															<!-- Kolom Kanan -->
															<div class="col-md-4">
																<!--Input Email-->
																<div class="form-group">
																	<label class="control-label col-md-4">Email</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['EMAIL']?></b></label>
																	<input type="hidden" name="emailpemegangpolis" id="emailpemegangpolis" value="<?=$prospek['EMAIL'];?>"/>
																</div>
																<!--Input Provinsi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Provinsi</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=($provinsi ? $provinsi['message']['NAMAPROPINSI'] : null)?></b></label>
																	<input type="hidden" name="kdprovinsipemegangpolis" id="kdprovinsipemegangpolis" value="<?=$prospek['KDPROVINSI'];?>" />
																</div>
																<!--Input Kota-->
																<div class="form-group">
																	<label class="control-label col-md-4">Kota</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=($kota ? $kota['message']['NAMAKOTAMADYA'] : null)?></b></label>
																	<input type="hidden" name="kdkotamadyapemegangpolis" id="kotapemegangpolis" value="<?=$prospek['KDKOTAMADYA'];?>"/>
																</div>
																<!--Input Alamat-->
																<div class="form-group">
																	<label class="control-label col-md-4">Alamat</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?="$prospek[ALAMAT]"?></b></label>
																	<input type="hidden" name="alamatpemegangpolis" id="alamatpemegangpolis" value="<?=$prospek['ALAMAT'];?>"/>
																</div>
															</div>
														</div>
													</div>
													<!-- End Input Data Calon Pemegang Polis -->
											
													<!--Start Input Data Calon Tertanggung-->
													<div class="box-header with-border">
														<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Data Diri Calon Tertanggung</h3>
													</div>
													</br>
													<div class="checkbox-list">
														<label>
															<label class="el-checkbox">
																<input type="checkbox" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onclick="cekCPPsamadenganCTT()" value="1" />
																<span class="el-checkbox-style"></span>&nbsp&nbsp
																<b>Tertanggung sama dengan Pemegang Polis</b>
															</label>
														</label>
													</div>
													</br>
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Nama-->
																<div class="form-group">
																	<label class="control-label col-md-4">Nama Lengkap<span class="required">*</span></label>
																	<div class="col-md-8">
																		<input type="text" class="form-control" name="namacalontertanggung" id="namacalontertanggung"/>
																	</div>
																</div>
																<!--Input Tanggal Lahir-->
																<div class="form-group">
																	<label class="control-label col-md-4">Tanggal Lahir<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input readonly class="form-control input-xs datepicker" style="padding-left:11px;" id="tanggallahircalontertanggung" name="tanggallahircalontertanggung" type="text" placeholder="dd-mm-yyyy">
																	</div>
																</div>
																<!--Input Jenis Kelamin-->
																<div class="form-group">
																	<label class="control-label col-md-4">Jenis Kelamin<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="kdjeniskelamincalontertanggung" id="kdjeniskelamincalontertanggung" >
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$jeniskelamin['error']) {
																				foreach($jeniskelamin['message'] as $i => $v) {
																					echo "<option value='$v[KDJENISKELAMIN]'>$v[NAMAJENISKELAMIN]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
																<!-- Input Usia-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia</label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" name="usiacalontertanggungtahun" id="usiacalontertanggungtahun" style="border:0px;" />
																		<input readonly type="text" class="form-control" name="usiacalontertanggung" id="usiacalontertanggung" style="display:none;" />
																	</div>
																</div>

															</div>

															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!-- Input No KTP-->
																<div class="form-group">
																	<label class="control-label col-md-4">No KTP<span class="required">*</span></label>
																	<div class="col-md-8">
																		<input type="text" class="form-control" name="noktpcalontertanggung" id="noktpcalontertanggung" required />
																	</div>
																</div>
																<!--Input Hubungan dengan Pemegang Polis-->
																<div class="form-group">
																	<label class="control-label col-md-4">Hubungan dgn Calon PemPol<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control " name="kdhubungan" id="hubungandenganpempol" >
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$hubungan['error']) {
																				foreach($hubungan['message'] as $i => $v) {
																					echo "<option value='$v[KDHUBUNGAN]'>$v[NAMAHUBUNGAN]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
																<!--Input Pekerjaan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Pekerjaan<span class="required">*</span></label>
																	<div class="col-md-8">
																		<select name="kdpekerjaancalontertanggung" id="kdpekerjaancalontertanggung" class="form-control">
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$pekerjaan['error']) {
																				foreach($pekerjaan['message'] as $i => $v) {
																					echo "<option value='$v[KDPEKERJAAN]'>$v[NAMAPEKERJAAN]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
																<!--Input Pekerjaan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Hobi<span class="required">*</span></label>
																	<div class="col-md-8">
																		<select name="kdhobicalontertanggung" id="kdhobicalontertanggung" class="form-control">
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$hobi['error']) {
																				foreach($hobi['message'] as $i => $v) {
																					echo "<option value='$v[KDHOBI]'>$v[NAMAHOBI]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--End Input Data Calon Tertanggung-->
											
													<!--Start Input Data Pertanggungan-->
													<div class="box-header with-border">
														<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Data Pertanggungan</h3>
													</div>
													</br>
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Lama Asuransi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Masa Asuransi</label>
																	<div class="col-md-4">
																		<input type="text" class="form-control" name="masaasuransi" id="masaasuransi" type="number" value="1 Tahun" readonly style="border:0px;">
																	</div>
																</div>
																<!--Input Cara Bayar-->
																<div class="form-group">
																	<label class="control-label col-md-4">Cara Bayar<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="kdcarabayar" >
																			<option value="X">Sekaligus</option>
																		</select>
																	</div>
																</div>
																<!--Input Penghasilan Satu Tahun-->
																<div class="form-group">
																	<label class="control-label col-md-4">Penghasilan Satu Tahun<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" name="penghasilansatutahun" id="penghasilansatutahun" placeholder="0" />
																	</div>
																</div>
																<!-- Input Nilai Uang Asuransi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Uang Asuransi<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" name="uangasuransi" id="uangasuransi" placeholder="50000000">
																	</div>	
																</div>
															</div>

															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!-- Input Total Premi -->
																<div class="form-group">
																	<label class="control-label col-md-4"><i><b>Premi Sekaligus <sup class="premiSubStandard hide">(a)</sup></b></i></label>
																	<div class="col-md-4">
																		<input type="text" readonly class="form-control" name="totalpremirp" id="totalpremirp" placeholder="0" style="border:0px;">
																		<input type="text" class="form-control" name="totalpremi" id="totalpremi" style="display:none;">
																	</div>
																	<label class="control-label col-md-4 premiSubStandard hide" style="text-align:left;">
																		<b><i><sup>(a)</sup>Premi Substandard</b></i>
																	</label>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Awal Calon Tertanggung</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikoawalproposalctt" placeholder="0" style="border:0px;" />
																		<input type="text" name="resikoawalproposalctt" style="display:none;" />
																	</div>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Awal Calon Pemegang Polis</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikoawalproposalcpp" placeholder="0" style="border:0px;" />
																		<input type="text" name="resikoawalproposalcpp" style="display:none;" />
																	</div>
																</div>
																<!--Input Resiko Finansial-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Finansial</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikofinansialctt" placeholder="0" style="border:0px;" />
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--End Input Data Pertanggungan-->

												</div>
												
												<div class="form-actions fluid">
													<div class="row">
														<div class="col-md-12 text-center">
															<a href="<?=str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=".$this->input->get('noid')?>" class="btn btn-lg green button-kembali" onclick='$.LoadingOverlay("show");'>
																 Halaman Prospek <i class="m-icon-swapleft m-icon-white"></i>
															</a>
															<a href="javascript:;" class="btn btn-lg blue button-next" id="submitProposal" name="submitProposal">
																 Submit Proposal <i class="m-icon-swapright m-icon-white"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- END PAGE CONTENT-->
            	
				</div>
			</div>
			<!-- END CONTENT -->
			
		</div>
		<!-- END CONTAINER -->
		
		
		<!-- BEGIN FOOTER -->
		<div class="footer">
			<!-- Begin page content -->
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-sm-4 col-xs-12"> 
						<h4 align="center" style="color:#FFFFFF">Terintegrasi Dengan</h4>
						<?php 
						$str = str_replace("/simulasi/", "", base_url());
						
						?>
						<a href="<?php echo $str;?>" class="thumbnail">
						<img height="250" width="250" src="<?= base_url();?>assets/img/jaim_logo.png" class="img-responsive img-rounded"/>
						</a>
					</div>
					<div class="col-lg-6 col-sm-4 col-xs-12"> 
					<h4 align="center" style="color:#FFFFFF">Dikembangkan Oleh</h4>
						<a class="thumbnail">
							<img height="250" width="250" src="<?= base_url();?>assets/img/logo_ti.png" class="img-responsive img-rounded"/>
						</a>
					</div>
				</div>
			</div>
			<div class="footer-inner" align="center">
				<?=C_COPYRIGHT?>
			</div>
			<div class="footer-tools">
				<span class="go-top">
					<i class="fa fa-angle-up"></i>
				</span>
			</div>
		</div>
		<!-- END FOOTER -->
		
	</body>
	<!-- END BODY -->
</html>