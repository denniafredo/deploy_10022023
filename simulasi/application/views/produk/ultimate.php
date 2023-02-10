<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/loadingoverlay.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery.formatter.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootbox/bootbox.all.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/moment.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		
		// Inisialisasi
		$('.datepicker').datepicker({format: 'dd-mm-yyyy'}).on('changeDate', function(e) { get_usia_ctt(); });
		$('#noktpcalontertanggung').formatter({'pattern': '{{9999999999999999}}' });
		$('#persentasealokasidana1, #persentasealokasidana2').formatter({'pattern': '{{999}}' });
		if ("<?=$prospek['USIA']?>" > 70) {
			bootbox.alert("Maksimal usia calon pemegang polis adalah 70 tahun", function() {
				window.location.href = '<?=str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=".$this->input->get("noid")?>';
			});
		}
		
		
		// pekerjaan diubah
		$('#kdpekerjaancalontertanggung').change(function() {
			get_pekerjaan_hobi();
			hitung_ua();
		});
		
		
		// Hobi diubah
		$('#kdhobicalontertanggung').change(function() {
			get_pekerjaan_hobi();
			hitung_ua();
		});
		
		// Hitung usia pensiun
		$('#usiapensiun').blur(function() { console.log('asdfa');
			if (!$('#tanggallahircalontertanggung').val()) {
				bootbox.alert("Tanggal lahir calon tertanggung wajib diisi");
				$(this).val('');
			} else {
				if ($(this).val()) {
					$('#usiaproduktif').val($(this).val() - $('#usiacalontertanggung').val());
					$('#usiaproduktiftahun').val($('#usiaproduktif').val()+' Tahun');
				} else {
					bootbox.alert("Usia pensiun harus lebih besar dari 0");
				}
			}
		});
		
		// Hitung resiko finansial
		$('#penghasilansatutahun').blur(function() {
			$('#resikofinansialctt').val($('#usiaproduktif').val() * $(this).val());
			$('#resikofinansialcttrp').val(number_format($('#resikofinansialctt').val(), 0, ',', '.'));
		});
		
		// Validasi nilai premi dasar
		$('#premidasar').blur(function() {
			merokokctt = $('#merokoktertanggung').val();
			usiapensiun = $('#usiapensiun').val();
			penghasilan = $('#penghasilansatutahun').val();
			minpremi = 12000000;
			
			if (!merokokctt) {
				bootbox.alert("Silahkan lengkapi data diri calon tertanggung terlebih dahulu!");
				$(this).val('');
				$('#merokoktertanggung').focus();
			} else if (!usiapensiun) {
				bootbox.alert("Silahkan isi usia pensiun terlebih dahulu!");
				$(this).val('');
			} else if (!penghasilan) {
				bootbox.alert("Silahkan isi penghasilan satu tahun terlebih dahulu!");
				$(this).val('');
				$('#penghasilansatutahun').focus();
			} else if ($(this).val() < minpremi || $(this).val() == '') {
				bootbox.alert("Minimal Premi adalah dua belas juta (Rp12.000.000)");
				$(this).val('').focus();
			} else {
				hitung_ua();
				total_premi();
			}
		});
		
		// Validasi nilai top up sekaligus
		$('#topup').change(function() {
			if ($(this).val() > 0 && $(this).val() < 1000000) {
				bootbox.alert("Minimal Topup Sekaligus adalah satu juta (Rp1.000.000)");
				$(this).val(0);
			} else if ($(this).val() >= 1000000) {
				$('#periodetopup').val(1);
				total_premi();
			}
		});
		
		// Validasi jumlah periode top up sekaligus
		$('#periodetopup').change(function() {
			if ($(this).val() == 0) {
				$('#topup').val(0);
			} else {
				total_premi();
			}
		});
		
		// Ambil persen investasi 1
		$('#alokasidana1').change(function() {
			$.ajax({
				type	: "GET",
				dataType: "json",
				//url		: "<?=C_URL_API.'/master/dana/'.$kdproduk.'/';?>"+$(this).val(),
				url		: '<?=base_url("master/dana/$kdproduk")?>/'+$(this).val(),
				success : function(data) {
					if (!data.error) {
						$("#investasirendah1").val(data.message.RENDAH);
						$("#investasisedang1").val(data.message.SEDANG);
						$("#investasitinggi1").val(data.message.TINGGI);
					}
				}
			});
		});
		
		// Ambil persen investasi 2
		$('#alokasidana2').change(function() {
			$.ajax({
				type	: "GET",
				dataType: "json",
				//url		: "<?=C_URL_API.'/master/dana/'.$kdproduk.'/';?>"+$(this).val(),
				url		: '<?=base_url("master/dana/$kdproduk")?>/'+$(this).val(),
				success : function(data) {
					if (!data.error) {
						$("#investasirendah2").val(data.message.RENDAH);
						$("#investasisedang2").val(data.message.SEDANG);
						$("#investasitinggi2").val(data.message.TINGGI);
					}
				}
			});
		});
		
		// Validasi alokasi dana 1
		$('#persentasealokasidana1').blur(function() {
			if ($(this).val() > 100) {
				bootbox.alert("Maksimum nilai alokasi dana adalah 100%");
				alokasi_dana(95,5);
			} else if ($(this).val() == '') {
				alokasi_dana(0, 100);
			} else if ($(this).val() == 0) {
				$('#persentasealokasidana2').val(100);
			} else if ($(this).val() == 100) {
				$('#persentasealokasidana2').val(0);
			} else if ($(this).val()%5 != 0) {
				bootbox.alert("Nilai alokasi dana harus kelipatan 5");
				alokasi_dana(95,5);
			} else {
				alokasi_dana($(this).val(),100-$(this).val());
			}
		});
		
		// Validasi alokasi dana 2
		$('#persentasealokasidana2').blur(function() {
			if ($(this).val() > 100) {
				bootbox.alert("Maksimum nilai alokasi dana adalah 100%");
				alokasi_dana(95,5);
			} else if ($(this).val() == '') {
				alokasi_dana(100, 0);
			} else if ($(this).val() == 0) {
				$('#persentasealokasidana1').val(100);
			} else if ($(this).val() == 100) {
				$('#persentasealokasidana1').val(0);
			} else if ($(this).val()%5 != 0) {
				bootbox.alert("Nilai alokasi dana harus kelipatan 5");
				alokasi_dana(95,5);
			} else {
				alokasi_dana(100-$(this).val(),$(this).val());
			}
		});
		
		// Kirim data simpan simulasi
		$('#submitProposal').click(function() {
			$.LoadingOverlay("show");
			
			if (!$("#namacalontertanggung").val()) {
				bootbox.alert("Nama Lengkap Tertanggung wajib diisi!");
			} else if (!$("#tanggallahircalontertanggung").val()) {
				bootbox.alert("Tanggal Lahir Tertanggung wajib diisi!");
			} else if (!$("#kdjeniskelamincalontertanggung").val()) {
				bootbox.alert("Jenis Kelamin Tertanggung wajib dipilih!");
			} else if (!$("#merokoktertanggung").val()) {
				bootbox.alert("Apakah Tertanggung merokok wajib dipilih!");
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
				$("#form-ultimate").submit();
			}
		});
		
	});
	
	
	// Checkbox tertanggung sama dengan pemegang polis
	function cekCPPsamadenganCTT() {
		var checkBox = document.getElementById("tertanggungsamadenganpemegangpolis");
		var usiacpp = $('#usiapemegangpolis').val();
		var merokokcpp = $("#merokokpemegangpolis").val();
			
		if (checkBox.checked == true && merokokcpp && usiacpp < 65) {
			$.LoadingOverlay("show");
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
			$("#merokoktertanggung").val($("#merokokpemegangpolis").val());
			
			get_pekerjaan_hobi();
		} else if (checkBox.checked == true && !merokokcpp) {
			bootbox.alert("Apakah Calon Pemegang Polis Perokok wajib dipilih!", function(){ 
				$('#tertanggungsamadenganpemegangpolis').prop('checked', false);
				$("#merokokpemegangpolis").focus();
			});
		} else if (usiacpp > 64) {
			bootbox.alert("Calon Tertanggung Maksimal berusia 64 tahun", function(){ 
				$('#tertanggungsamadenganpemegangpolis').prop('checked', false);
			});
		} else if (checkBox.checked == false) {
			$.LoadingOverlay("show");
			$("#namacalontertanggung").val('').prop('disabled', false);
			$("#tanggallahircalontertanggung").val('').prop('disabled', false);
			$("#kdjeniskelamincalontertanggung").val('').prop('disabled', false);
			$("#usiacalontertanggung").val('');
			$("#usiacalontertanggungtahun").val('').prop('disabled', false);
			$("#noktpcalontertanggung").val('').prop('disabled', false);
			$("#hubungandenganpempol").val('').prop('disabled', false);
			$("#kdpekerjaancalontertanggung").val('').prop('disabled', false);
			$("#kdhobicalontertanggung").val('').prop('disabled', false);
			$("#merokoktertanggung").val('');
		}
		
		$('#penghasilansatutahun').val('');
		$('#premidasar').val('');
		$('#uangasuransi').val('');
		$('#uangasuransirp').val('');
		$('#totalpremi').val('');
		$('#totalpremirp').val('');
		$('#resikoawalproposalctt').val('');
		$("input[name='resikoawalproposalctt']").val('');
		$('#uangasuransidasar').val(0);
		$('#uangasuransidasarrp').val(0);
		$('#biayauangasuransidasar').val(0);
		$('#biayauangasuransidasarrp').val(0);
					
		$.LoadingOverlay("hide");
	};
	
	// Fungsi hitung usia calon tertanggung
	function get_usia_ctt() {
		var tgllahir = moment($('#tanggallahircalontertanggung').val(), "DD-MM-YYYY");
		var usiath = moment().diff(tgllahir, 'year');
		var usiabl = moment().diff(tgllahir, 'month');
		
		if (usiabl < 6) {
			bootbox.alert("Calon Tertanggung Minimal berusia 6 bulan");
			$('#tanggallahircalontertanggung').val('');
		} else if (usiath > 64) {
			bootbox.alert("Calon Tertanggung Maksimal berusia 64 tahun");
			$('#tanggallahircalontertanggung').val('');
		} else {
			$("#usiacalontertanggung").val(usiath);
			$('#usiacalontertanggungtahun').val($('#usiacalontertanggung').val()+' Tahun');
		}
	}
	
	// Ambil tarif pekerjaan dan hobi
	function get_pekerjaan_hobi() {
		var kdpekerjaanctt = $("#kdpekerjaancalontertanggung").val();
		var kdhobictt = $("#kdhobicalontertanggung").val();
		
		if (kdpekerjaanctt) {
			$.ajax({
				type	: "GET",
				dataType: "json",
				//url		: "<?=C_URL_API.'/master/pekerjaan/';?>"+kdpekerjaanctt,
				url		: "<?=base_url('master/pekerjaan')?>/"+kdpekerjaanctt,
				success : function(data) {
					if (!data.error) {
						$("#pekerjaanlife").val(data.message.LIFE);
						$("#pekerjaanpembagilife").val(data.message.PEMBAGILIFE);
						
						if (data.message.FLAGLIFE == 'DECLINE') {
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
						$("#hobilife").val(data.message.LIFE);
						$("#hobipembagilife").val(data.message.PEMBAGILIFE);
						
						if (data.message.FLAGLIFE == 'DECLINE') {
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
	
	// Kalkulasi UA
	function hitung_ua() {
		var kdtarif = $('#merokoktertanggung').val() == 'Y' ? 'COIMEROKOK' : 'COI';
		var usiactt = $("#usiacalontertanggung").val();
		
		$.ajax({
			type	: "GET",
			dataType: "json",
			//url		: "<?=C_URL_API.'/master/tarif';?>",
			url		: "<?=base_url('master/tarif')?>",
			data	: "kdtarif="+kdtarif+"&kdproduk=<?=$kdproduk?>&usiath="+usiactt,
			beforeSend: function() {
				$.LoadingOverlay("show");
			},
			success : function(data) {
				if (!data.error) {
					var premi = $('#premidasar').val();
					var ua = Math.round(1.25*premi);
					var resikopekerjaan = $("#pekerjaanlife").val() / $("#pekerjaanpembagilife").val();
					var resikohobi = $("#hobilife").val() / $("#hobipembagilife").val();
					var tarif = (1 + (resikopekerjaan) + (resikohobi)) * (data.message.TARIF / 12);
					
					// Jika resiko finansial lebih kecil dari resiko awal maka keluar
					if (ua > $('#resikofinansialctt').val()) {
						bootbox.alert("Resiko Awal Anda melebihi Resiko Finansial!", function(){ 
							$('#premidasar, #totalpremi, #totalpremirp').val('')
							return;
						});
					}
					
					$('#uangasuransi').val(ua);
					$('#uangasuransirp').val(number_format($('#uangasuransi').val(), 0, ',', '.'));
					$("input[name='resikoawalproposalctt']").val($('#uangasuransi').val());
					$('#resikoawalproposalctt').val(number_format($('#uangasuransi').val(), 0, ',', '.'));
					$('#uangasuransidasar').val($('#uangasuransi').val());
					$('#uangasuransidasarrp').val($('#uangasuransirp').val());
					$('#biayauangasuransidasar').val($('#uangasuransi').val() * tarif / 1000);
					$('#biayauangasuransidasarrp').val(number_format($('#biayauangasuransidasar').val(), 0, ',', '.'));
					$('#kdtarif').val(kdtarif);
					
					// Tampilkan informasi premi substandard
					if (resikopekerjaan+resikohobi > 0) {
						$(".premiSubStandard").removeClass('hide');
					} else {
						$(".premiSubStandard").addClass('hide');
					}
					
					console.log('tarif : ' +tarif);
					console.log('resikopekerjaan : ' +resikopekerjaan);
					console.log('resikohobi : '+resikohobi);
					
					// Jenis pemeriksaan & medical
					if (usiactt <= 5){
						if (ua <= 1500000000) {
							pemeriksaan = '';
							medical = '';
						} else {
							pemeriksaan = 'LPK';
							medical = 'M';
						}							
					} else if (usiactt >= 6 && usiactt <= 14) {
						if (ua <= 1500000000) {
							pemeriksaan = '';
							medical = '';
						}else{
							pemeriksaan = 'A';
							medical = 'M';
						}							
					} else if (usiactt >= 15 && usiactt <= 16) {
						if (ua <= 1500000000) {
							pemeriksaan = '';
							medical = '';
						} else {
							pemeriksaan = 'B';
							medical = 'M';
						}							
					} else if (usiactt == 17) {
						if (ua <= 1500000000) {
							pemeriksaan = '';
							medical = '';
						} else if (ua >= 1500000001 && ua <= 2000000000) {
							pemeriksaan = 'B';
							medical = 'M';
						} else if (ua >= 2000000001 && ua <= 4000000000) {
							pemeriksaan = 'D';
							medical = 'M';
						} else {
							pemeriksaan = 'E';
							medical = 'M';
						}							
					} else if (usiactt >= 18 && usiactt <= 45){
						if (ua <= 2000000000) {
							pemeriksaan = '';
							medical = '';
						} else if (ua >= 2000000001 && ua <= 4000000000){
							pemeriksaan = 'D';
							medical = 'M';
						} else {
							pemeriksaan = 'E';
							medical = 'M';
						}
					} else if (usiactt >= 46 && usiactt <= 50){
						if (ua <= 1000000000) {
							pemeriksaan = '';
							medical = '';
						} else if (ua >= 1000000001 && ua <= 2000000000) {
							pemeriksaan = 'C';
							medical = 'M';
						} else {
							pemeriksaan = 'E';
							medical = 'M';
						}
					} else if (usiactt >= 51 && usiactt <= 55) {
						if (ua <= 800000000) {
							pemeriksaan = '';
							medical = '';
						} else if (ua >= 800000001 && ua <= 1000000000) {
							pemeriksaan = 'A';
							medical = 'M';
						} else if (ua >= 1000000001 && ua <= 2000000000) {
							pemeriksaan = 'C';
							medical = 'M';
						} else {
							pemeriksaan = 'E';
							medical = 'M';
						}
					} else if (usiactt >= 56 && usiactt <= 60) {
						if (ua <= 650000000) {
							pemeriksaan = '';
							medical = '';
						} else if (ua >= 650000001 && ua <= 1000000000) {
							pemeriksaan = 'B';
							medical = 'M';
						} else if (ua >= 1000000001 && ua <= 2000000000) {
							pemeriksaan = 'D';
							medical = 'M';
						} else {
							pemeriksaan = 'E';
							medical = 'M';
						}
					} else {
						if (ua <= 650000000) {
							pemeriksaan = '';
							medical = '';
						} else if (ua >= 650000001 && ua <= 1000000000) {
							pemeriksaan = 'C';
							medical = 'M';
						} else if (ua >= 1000000001 && ua <= 2000000000) {
							pemeriksaan = 'D';
							medical = 'M';
						} else {
							pemeriksaan = 'E';
							medical = 'M';
						}
					}
					console.log(pemeriksaan);
					$('#pemeriksaan').val(pemeriksaan);
					$('#medical').val(medical);
				}
			},
			complete: function() {
				$.LoadingOverlay("hide");
			}
		});
	}
	
	// Kalkulasi total bayar premi
	function total_premi() {
		$('#totalpremi').val(parseInt($('#premidasar').val())+(parseInt($('#topup').val())*parseInt($('#periodetopup').val())));
		$('#totalpremirp').val(number_format($('#totalpremi').val(), 0, ',', '.'));
	}
	
	// Set persetanse alokasi dana
	function alokasi_dana(nilai1 = 0, nilai2 = 0) {
		$('#persentasealokasidana1').val(nilai1);
		$('#persentasealokasidana2').val(nilai2);
	}
</script>

<!-- Header ada di file header.php terpisah -->
<?php error_reporting(0); ?>
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
									<form action="<?=base_url("ultimate/save")?>" class="form-horizontal" id="form-ultimate" method="post">
										<input type="hidden" name="resikopekerjaan" id="pekerjaanlife" />
										<input type="hidden" name="resikopembagipekerjaan" id="pekerjaanpembagilife" />
										<input type="hidden" name="resikohobi" id="hobilife" />
										<input type="hidden" name="resikopembagihobi" id="hobipembagilife" />
										<input type="hidden" name="noagen" value="<?=$this->input->get('noagen')?>" />
										<input type="hidden" name="kdproduk" value="<?=$this->input->get('kdproduk')?>" />
										<input type="hidden" name="pemeriksaan" id="pemeriksaan" />
										<input type="hidden" name="medical" id="medical" />
										<input type="hidden" name="kdtarif" id="kdtarif" />
										<div class="form-wizard">
											<div class="form-body">
												<div class="box box-info">
													<!--Start Input Data Calon Pemegang Polis-->
													<div class="box-header with-border">
													  <h3 class="box-title">Data Diri Calon Pemegang Polis</h3>
													</div>
													<br />
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
																<!--Input Jenis Merokok-->
																<div class="form-group">
																	<label class="control-label col-md-4">Apakah Anda Perokok?<span class="required">*</span></label>
																	<div class="col-md-6">
																		<select class="form-control" name="merokokpemegangpolis" id="merokokpemegangpolis" >
																			<option value="">Silahkan Pilih</option>
																			<option value="Y" <?=$prospek['MEROKOK']=='Y' ? 'selected' : ''?>>Ya</option>
																			<option value="T" <?=$prospek['MEROKOK']=='T' ? 'selected' : ''?>>Tidak</option>
																		</select>
																	</div>
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
																	<input type="hidden" name="phonepemegangpolis" id="phonepemegangpolis" value="<?=$prospek['TELP'];?>"/>
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
													<br />
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
																	<label class="control-label col-md-4">Usia<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" name="usiacalontertanggungtahun" id="usiacalontertanggungtahun" style="border:0px;" />
																		<input readonly type="text" class="form-control" name="usiacalontertanggung" id="usiacalontertanggung" style="display:none;" />
																	</div>
																</div>
																<!--Input Jenis Merokok-->
																<div class="form-group">
																	<label class="control-label col-md-4">Apakah Anda Perokok?<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="merokoktertanggung" id="merokoktertanggung" >
																			<option value="">Silahkan Pilih</option>
																			<option value="Y">Ya</option>
																			<option value="T">Tidak</option>
																		</select>
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
													<br />
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Lama Asuransi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Masa Asuransi Sampai Usia</label>
																	<div class="col-md-4">
																		<input type="text" name="masaasuransi" value="99" style="display:none;">
																		<input type="text" class="form-control" value="99 Tahun" readonly style="border:0px;">
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
																<!--Input Usia Pensiun-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia Pensiun<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" name="usiapensiun" id="usiapensiun" placeholder="0" />
																	</div>
																</div>
																<!--Input Usia Produktif-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia Produktif</label>
																	<div class="col-md-4">
																		<input type="text" class="form-control" name="usiaproduktiftahun" id="usiaproduktiftahun" readonly style="border:0px;" />
																		<input type="hidden" class="form-control" name="usiaproduktif" id="usiaproduktif" readonly style="border:0px;" />
																	</div>
																</div>
																<!--Input Penghasilan Satu Tahun-->
																<div class="form-group">
																	<label class="control-label col-md-4">Penghasilan Satu Tahun<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" name="penghasilansatutahun" id="penghasilansatutahun" placeholder="0" />
																	</div>
																</div>
																<!-- Input Premi Dasar Sekaligus-->
																<div class="form-group">
																	<label class="control-label col-md-4">Premi Dasar Sekaligus<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" placeholder="0" name="premidasar" id="premidasar" />
																	</div>	
																</div>
															</div>

															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!-- Input Top Up Sekaligus-->
																<div class="form-group">
																	<label class="control-label col-md-4">Top Up Sekaligus</label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" value="0" name="topup" id="topup" />
																	</div>	
																</div>
																<!-- Input Periode Top Up Sekaligus-->
																<div class="form-group">
																	<label class="control-label col-md-4">Periode Top Up Sekaligus</label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" value="0" name="periodetopup" id="periodetopup" />
																	</div>	
																</div>
																<!-- Input Total Premi -->
																<div class="form-group">
																	<label class="control-label col-md-4"><i><b>Premi Yang Dibayar <sup class="premiSubStandard hide">(a)</sup></b></i></label>
																	<div class="col-md-4">
																		<input type="text" readonly class="form-control" name="totalpremirp" id="totalpremirp" placeholder="0" />
																		<input type="hidden" class="form-control" name="totalpremi" id="totalpremi">
																	</div>
																	<label class="control-label col-md-4 premiSubStandard hide" style="text-align:left;">
																		<b><i><sup>(a)</sup>Premi Substandard</b></i>
																	</label>
																</div>
																<!-- Input Uang Asuransi -->
																<div class="form-group">
																	<label class="control-label col-md-4"><i><b>Uang Asuransi</b></i></label>
																	<div class="col-md-4">
																		<input type="text" readonly class="form-control" name="uangasuransirp" id="uangasuransirp" placeholder="0" />
																		<input type="text" class="form-control" name="uangasuransi" id="uangasuransi" style="display:none;">
																	</div>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Awal Calon Tertanggung</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikoawalproposalctt" placeholder="0" />
																		<input type="text" name="resikoawalproposalctt" style="display:none;" />
																	</div>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Awal Calon Pemegang Polis</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikoawalproposalcpp" placeholder="0" />
																		<input type="text" name="resikoawalproposalcpp" style="display:none;" value="0" />
																	</div>
																</div>
																<!--Input Resiko Finansial-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Finansial</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikofinansialcttrp" placeholder="0" style="border:0px;" />
																		<input type="text" id="resikofinansialctt" style="display:none;" value="0" />
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--End Input Data Pertanggungan-->
													
													<!--Start Input Data Alokasi Dana-->
													<div class="box-header with-border">
														<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Alokasi Dana</h3>
													</div>
													<br />
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Alokasi Dana 1-->
																<div class="form-group">
																	<label class="control-label col-md-4">Alokasi Dana Investasi<span class="required">*</span></label>
																	<div class="col-md-8">
																		<select class="form-control " name="alokasidana1" id="alokasidana1" >
																			<?php if (!$fund['error']) {
																				foreach($fund['message'] as $i => $v) {
																					$selected = $i == 0 ? 'selected' : '';
																					echo "<option value='$v[KDFUND]' $selected>$v[NAMAFUND]</option>";
																				}
																			} ?>
																		</select>
																		<?php if (!$fund['error']) {
																			foreach($fund['message'] as $i => $v) {
																				if ($i == 0) {
																					echo "<input type='hidden' name='investasirendah1' id='investasirendah1' value='$v[RENDAH]' />";
																					echo "<input type='hidden' name='investasisedang1' id='investasisedang1' value='$v[SEDANG]' />";
																					echo "<input type='hidden' name='investasitinggi1' id='investasitinggi1' value='$v[TINGGI]' />";
																				}
																			}
																		} ?>
																	</div>
																</div>
																<!--Input Alokasi Dana 2-->
																<div class="form-group">
																	<label class="control-label col-md-4"></label>
																	<div class="col-md-8">
																		<select class="form-control " name="alokasidana2" id="alokasidana2" >
																			<?php if (!$fund['error']) {
																				foreach($fund['message'] as $i => $v) {
																					$selected = $i == 1 ? 'selected' : '';
																					echo "<option value='$v[KDFUND]' $selected>$v[NAMAFUND]</option>";
																				}
																			} ?>
																			<?php if (!$fund['error']) {
																			foreach($fund['message'] as $i => $v) {
																				if ($i == 1) {
																					echo "<input type='hidden' name='investasirendah2' id='investasirendah2' value='$v[RENDAH]' />";
																					echo "<input type='hidden' name='investasisedang2' id='investasisedang2' value='$v[SEDANG]' />";
																					echo "<input type='hidden' name='investasitinggi2' id='investasitinggi2' value='$v[TINGGI]' />";
																				}
																			}
																		} ?>
																		</select>
																	</div>
																</div>
															</div>
															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!--Input Alokasi Dana 1-->
																<div class="form-group">
																	<div class="col-md-4">
																		<input class="form-control" type="text" name="persentasealokasidana1" id="persentasealokasidana1" value="95">
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-md-4">
																		<input class="form-control" type="text" name="persentasealokasidana2" id="persentasealokasidana2" value="5">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--End Input Data Alokasi Dana Investasi-->
													
													<!--Start Biaya Asuransi-->
													<div class="box-header with-border">
														<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Pilihan Asuransi Tambahan</h3>
													</div>
													<br />
													<div class="box-body">
														<div class="row">
															<div class="col-md-12">
																<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
																	<table class="table table-striped table-hover xxxtab">
																		<thead>
																			<tr>
																				<!-- <th>Number</th> -->
																				<th width="30%" style="text-align: center;">Nama Asuransi</th>
																				<th width="8%" style="text-align: center;">Y/N</th>
																				<th style="text-align: center;">Sampai Usia Tertanggung</th>
																				<th style="text-align: center;">Uang Asuransi</th>
																				<th style="text-align: center;">Biaya Asuransi Per Bulan</th>
																				<!--th style="text-align: center;">Tarif</th>
																				<th style="text-align: center;">Resiko Awal</th-->
																			</tr>
																		</thead>
																		<tbody>
																			<!-- Biaya Asuransi : Uang Asuransi Dasar -->
																			<tr>
																				<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp  Asuransi Dasar</td>
																				<td align="center">
																					<label class="el-checkbox el-checkbox-lg">
																						<input type="checkbox" name="pil_jsuangasuransidasar" id="pil_jsuangasuransidasar" checked disabled>
																						<span class="el-checkbox-style"></span>
																					</label>
																				</td>
																				<td>
																					<input class="form-control" type="text" value="99" readonly>
																				</td>
																				<td>
																					<input class="form-control" type="text" name="uangasuransidasarrp" id="uangasuransidasarrp"  value="0" disabled>
																					<input type="hidden" name="uangasuransidasar" id="uangasuransidasar" >
																				</td>
																				<td>
																					<input class="form-control" type="text" name="biayauangasuransidasarrp" id="biayauangasuransidasarrp" value="0" disabled>
																					<input type="hidden" name="biayauangasuransidasar" id="biayauangasuransidasar">
																				</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
													<!--End Biaya Asuransi-->
													
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