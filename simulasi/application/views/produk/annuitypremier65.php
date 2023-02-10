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
		$("#tertanggungsamadenganpemegangpolis").attr('checked', 'checked');
		cekCPPsamadenganCTT();

		//Menghitung usia calon tertanggung
		$('#tanggallahircalontertanggung').on('change', function() {
			usiaTahunBulan();
		});

		// status kawin tertanggung diubah
		$('#meritalstatustertanggung').on('change', function() {
			hitung_benefit();
			cekBenefit();
		});

		// manfaat tertanggung diubah
		$('#manfaattertanggung').on('change', function() {
			hitung_benefit();
			cekBenefit();
		});

		// menghitung resiko finansial
		$('#penghasilansatutahun').on('blur', function() {
			$.LoadingOverlay("show");
			
			usia = $("#usiacalontertanggungtahun").val();
			
			$('#resikofinansialctt').val(number_format((<?=$produk['USIAMAX']?> - usia) * $(this).val(), 0, ',', '.'));
			
			$.LoadingOverlay("hide");
		});

		// menghitung total premi
		$('#totalpremi').on('blur', function() {
			premi = $(this).val();
			penghasilan = $('#penghasilansatutahun').val();
			minpremi = <?=$produk['PREMIMIN']?>;
			maxpremi = <?=$produk['PREMIMAX']?>;
			
			if (!penghasilan) {
				$('#totalpremi').val('');
				$('#penghasilansatutahun').focus();
				alert("Silahkan isi Penghasilan Satu Tahun terlebih dahulu!");
			} else if (premi < minpremi) {
				$('#totalpremi').val('');
				alert("Premi Sekaligus minimum adalah sebesar "+number_format(minpremi, 0, ',', '.'));
			} else if (premi > maxpremi) {
				$('#totalpremi').val('');
				alert("Premi Sekaligus maksimum adalah sebesar "+number_format(maxpremi, 0, ',', '.'));
			} else {
				hitung_benefit();
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
			} else if (!$("#meritalstatustertanggung").val()) {
				bootbox.alert("Status Tertanggung wajib dipilih!");
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
				$("#form-anuitas").submit();
			}

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
			var meritalstatus = $("#meritalstatuspemegangpolis").val();

			if (meritalstatus == 'J' || meritalstatus == 'D') {
				$(".labelmanfaattertanggung").removeClass("hide");
			} else {
				$(".labelmanfaattertanggung").addClass("hide");
			}

			$("#namacalontertanggung").val($("#namapemegangpolis").val()).prop('disabled', true);
			$("#tanggallahircalontertanggung").val($("#tanggallahirpemegangpolis").val()).prop('disabled', true);
			$("#kdjeniskelamincalontertanggung").val($("#kdjeniskelaminpemegangpolis").val()).prop('disabled', true);
			$("#usiacalontertanggung").val($("#usiapemegangpolis").val());
			$("#usiacalontertanggungtahunbulan").val($("#usiapemegangpolistahunbulan").val()).prop('disabled', true);
			$("#noktpcalontertanggung").val($("#noktppemegangpolis").val()).prop('disabled', true);
			$("#hubungandenganpempol").val('04').prop('disabled', true);
			$("#kdpekerjaancalontertanggung").val(kdpekerjaanctt).prop('disabled', true);
			$("#kdhobicalontertanggung").val(kdhobictt).prop('disabled', true);
            $("#meritalstatustertanggung").val(meritalstatus).prop('disabled', true);
		} else {
			$("#namacalontertanggung").val('').prop('disabled', false);
			$("#tanggallahircalontertanggung").val('').prop('disabled', false);
			$("#kdjeniskelamincalontertanggung").val('').prop('disabled', false);
			$("#usiacalontertanggung").val('');
			$("#usiacalontertanggungtahunbulan").val('').prop('disabled', false);
			$("#noktpcalontertanggung").val('').prop('disabled', false);
			$("#hubungandenganpempol").val('').prop('disabled', false);
			$("#kdpekerjaancalontertanggung").val('').prop('disabled', false);
			$("#kdhobicalontertanggung").val('').prop('disabled', false);
            $("#meritalstatustertanggung").val('').prop('disabled', false);
		}

		cekBenefit();
		usiaTahunBulan();
		$.LoadingOverlay("hide");
	}

	// Tampilkan data benefit sesuai status kawin
	function cekBenefit() {
		$.LoadingOverlay("show");
		var status = $('#meritalstatustertanggung').val();
		var manfaat = $('#manfaattertanggung').val();

		if (status == 'K') {
			$('.benefitJandaDuda').removeClass('hide');
			$('.benefitYatim').removeClass('hide');
		} else if ((status == 'J' || status == 'D') && manfaat == 'K') {
			$('.benefitJandaDuda').removeClass('hide');
			$('.benefitYatim').removeClass('hide');
		} else {
			$('.benefitJandaDuda').addClass('hide');
			$('.benefitYatim').addClass('hide');
		}
		$.LoadingOverlay("hide");
	}

	// Tampilkan data usia tahun bulan
	function usiaTahunBulan() {
		var tgllahirctt = $("#tanggallahircalontertanggung").val();

		if (tgllahirctt.length > 0) {
			var tgllahircttsplit = tgllahirctt.split("-");
			var hariini = new Date();
			var birthday_ctt = new Date(+tgllahircttsplit[2], tgllahircttsplit[1] - 1, +tgllahircttsplit[0]);
			
			if (hariini.getMonth() < birthday_ctt.getMonth()) {
				var tahun = 1;
				var usiabl = (12 - birthday_ctt.getMonth()) + hariini.getMonth();
				if (hariini.getDate() < birthday_ctt.getDate()) {
					usiabl -= 1;
				}
			} else if ((hariini.getMonth() == birthday_ctt.getMonth()) && hariini.getDate() < birthday_ctt.getDate()) {
				var tahun = 1;
				var usiabl = 11;
			} else {
				var tahun = 0;
				var usiabl = hariini.getMonth() - birthday_ctt.getMonth();
				if (hariini.getDate() < birthday_ctt.getDate()) {
					usiabl -= 1;
				}
			}

			var usiath = hariini.getFullYear() - birthday_ctt.getFullYear() - tahun; 
			$("#usiacalontertanggungtahun").val(Math.floor(usiath));
			$("#usiacalontertanggungbulan").val(Math.floor(usiabl));
			$('#usiacalontertanggungtahunbulan').val($('#usiacalontertanggungtahun').val()+' Tahun'+' '+$('#usiacalontertanggungbulan').val()+' Bulan');

			if(usiath < <?=$produk['USIAMIN']?> || usiath > <?=$produk['USIAMAX']?>) {
				$('#tanggallahircalontertanggung').val('');
				bootbox.alert("Calon Tertanggung Minimal berusia <?=$produk['USIAMIN']?> tahun dan Maksimal berusia <?=$produk['USIAMAX']?> tahun");
			}
		}
	}

	// Kalkulasi benefit
	function hitung_benefit() {
		var usiath = $('#usiacalontertanggungtahun').val();
		var usiabl = $('#usiacalontertanggungbulan').val();
		var bk, pjd, pyt;

		if ($('#meritalstatustertanggung').val() == 'K') {
			bk = 'K';
			pjd = true;
			pyt = true;
		} else if (($('#meritalstatustertanggung').val() == 'J' || $('#meritalstatustertanggung').val() == 'D') && $('#manfaattertanggung').val() == 'K') {
			bk = 'K'
			pjd = false;
			pyt = true;
		} else {
			bk = '*';
			pjd = false;
			pyt = false;
		}

		$.ajax({
			type	: "GET",
			dataType: "json",
			url		: "<?=base_url('master/tarif')?>",
			data	: "kdproduk=<?=$kdproduk?>&usiath="+usiath+"&bk="+bk,
			beforeSend: function() {
				$.LoadingOverlay("show");
			},
			success : function(data) {
				$.ajax({
					type	: "GET",
					dataType: "json",
					url		: "<?=base_url('master/tarif')?>",
					data	: "kdproduk=<?=$kdproduk?>&usiath="+(parseInt(usiath)+1)+"&bk="+bk,
					success	: function(data2) {
						var tarif = ((data.message.TARIF * (12 - usiabl)) + (data2.message.TARIF * usiabl)) / 12;
						var bnfpht = Math.round($('#totalpremi').val() / tarif * 100);
						var bnfpjt = Math.round(bnfpht*0.6);

						$('#manfaatharitua').val(number_format(bnfpht, 0, ',', '.'));
						$('#manfaatjandaduda').val(number_format(pjd ? bnfpjt : 0, 0, ',', '.'));
						$('#manfaatyatim').val(number_format(pyt ? bnfpjt : 0, 0, ',', '.'));

						$("input[name='manfaatharitua']").val(bnfpht);
						$("input[name='manfaatjandaduda']").val(pjd ? bnfpjt : 0);
						$("input[name='manfaatyatim']").val(pyt ? bnfpjt : 0);

						if (bnfpht <= 500000) {
							bootbox.alert("Manfaat Hari Tua minimal Rp500.000, Silahkan tambah nilai Premi Sekaligus");
							$('#totalpremi').val('');
						}
					}
				});
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
									<form action="<?=base_url("annuitypremier/save")?>" class="form-horizontal" id="form-anuitas" method="post">
										<input type="hidden" name="noagen" value="<?=$this->input->get('noagen')?>" />
										<input type="hidden" name="kdproduk" value="<?=$this->input->get('kdproduk')?>" />
										<div class="form-wizard">
											<div class="form-body">
												<div class="box box-info">
													<!--Start Input Data Calon Pemegang Polis-->
													<div class="box-header with-border">
														<input type="checkbox" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onclick="cekCPPsamadenganCTT()" value="1" style="display:none;" />
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
                                                                <!--Input Status Pernikahan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Status</label>
                                                                    <label class="control-label col-md-8" style="text-align:left;">: 
                                                                        <b>
                                                                            <?php switch($prospek['MERITALSTATUS']) {
                                                                                case 'L':
                                                                                    echo "Lajang";
                                                                                    break;
                                                                                case 'K':
                                                                                    echo "Kawin";
                                                                                    break;
                                                                                case 'J':
                                                                                    echo "Janda";
                                                                                    break;
                                                                                case 'D':
                                                                                    echo "Duda";
                                                                                    break;
                                                                            } ?>
                                                                        </b>
                                                                        <input type="hidden" name="meritalstatuspemegangpolis" id="meritalstatuspemegangpolis" value="<?=$prospek['MERITALSTATUS']?>" />
                                                                    </label>
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
																<input type="checkbox" value="1" checked="checked" disabled />
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
																		<input readonly type="text" class="form-control" name="usiacalontertanggungtahunbulan" id="usiacalontertanggungtahunbulan" style="border:0px;" />
																		<input readonly type="text" class="form-control" name="usiacalontertanggungtahun" id="usiacalontertanggungtahun" style="display:none;" />
																		<input readonly type="text" class="form-control" name="usiacalontertanggungbulan" id="usiacalontertanggungbulan" style="display:none;" />
																	</div>
																</div>
                                                                <!--Input Status Pernikahan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Status<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="meritalstatustertanggung" id="meritalstatustertanggung" >
																			<option value="">Silahkan Pilih</option>
																			<option value="L">Lajang</option>
																			<option value="K">Kawin</option>
                                                                            <option value="J">Janda</option>
                                                                            <option value="D">Duda</option>
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
																<!--Input Manfaat-->
																<div class="form-group labelmanfaattertanggung">
																	<label class="control-label col-md-4">Manfaat<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="manfaattertanggung" id="manfaattertanggung" >
																			<option value="L" selected>Tanpa Anak</option>
																			<option value="K">Dengan Anak</option>
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
																		<input type="text" class="form-control" name="masaasuransi" id="masaasuransi" type="number" value="Sampai Usia 65 Tahun" readonly style="border:0px;">
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
																	<label class="control-label col-md-4">Premi Sekaligus<span class="required">*</span></label>
																	<div class="col-md-4">
                                                                        <input type="text" class="form-control" name="totalpremi" id="totalpremi" placeholder="<?=$produk['PREMIMIN']?>">
																	</div>	
																</div>
															</div>

															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!-- Input Pensiun Hari Tua -->
																<div class="form-group">
																	<label class="control-label col-md-4"><i><b>Manfaat Hari Tua</b></i></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="manfaatharitua" placeholder="0" style="border:0px;" />
																		<input type="text" name="manfaatharitua" style="display:none;" />
																	</div>
																</div>
																<!--Input Pensiun Janda Duda-->
																<div class="form-group benefitJandaDuda hide">
																	<label class="control-label col-md-4"><b><i>Manfaat Janda/Duda</b></i></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="manfaatjandaduda" placeholder="0" style="border:0px;" />
																		<input type="text" name="manfaatjandaduda" style="display:none;" />
																	</div>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group benefitYatim hide">
																	<label class="control-label col-md-4"><b><i>Manfaat Yatim</b></i></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="manfaatyatim" placeholder="0" style="border:0px;" />
																		<input type="text" name="manfaatyatim" style="display:none;" />
																	</div>
																</div>
																<!--Input Resiko Finansial-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Finansial</b></i></label>
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