<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/custom-bootbox-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Workbook</a>
            <i class="fa fa-circle"></i>
        </li>
        <li class="active">
            <?=$this->template->title?>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="row margin-top-10">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Ubah Prospek</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-prospek" class="form-horizontal" role="form" action="<?="$this->url/save"?>" method="post">
									<input type="hidden" name="username" class="form-control" value="<?=$this->session->USERNAME?>" readonly>
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Your form validation is successful!
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">No KTP <span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" id="idKTP" name="noid" class="form-control" size="16" placeholder="3377150319760001" value="<?=$prospek['NOID']?>" readonly>
                                                </div>
                                            </div>
											<div class="col-md-4">
												*No KTP tidak dapat diubah
											</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nama Lengkap <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="namaklien" class="form-control" placeholder="Nama Lengkap" value="<?=$prospek['NAMAKLIEN']?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Provinsi <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdprovinsi" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php if (!$provinsi['error']) {
															foreach($provinsi['message'] as $i => $v) {
																$selected = $prospek['KDPROVINSI'] == $v['KDPROPINSI'] ? 'selected' : '';
																echo "<option value='$v[KDPROPINSI]' $selected>$v[NAMAPROPINSI]</option>";
															}
														} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Kota <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdkotamadya" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
														<?php if (!$kota['error']) {
															foreach($kota['message'] as $i => $v) {
																$selected = $prospek['KDKOTAMADYA'] == $v['KDKOTAMADYA'] ? 'selected' : '';
																echo "<option value='$v[KDKOTAMADYA]' $selected>$v[NAMAKOTAMADYA]</option>";
															}
														} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-3 control-label">Kecamatan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="ddlKdKecamatan" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
														<?php if (!$kecamatan['error']) {
															foreach($kecamatan['message'] as $i => $v) {
																$selected = $prospek['KDKECAMATAN'] == $v['KDKECAMATAN'] ? 'selected' : '';
																echo "<option value='$v[KDKECAMATAN]' $selected>$v[NAMAKECAMATAN]</option>";
															}
														} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-3 control-label">Kelurahan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdkelurahan" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
														<?php if (!$kelurahan['error']) {
															foreach($kelurahan['message'] as $i => $v) {
																$selected = $prospek['KDKELURAHAN'] == $v['KDKELURAHAN'] ? 'selected' : '';
																echo "<option value='$v[KDKELURAHAN]' $selected>$v[NAMAKELURAHAN]</option>";
															}
														} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Kodepos<span class="required"></span></label>
                                            <div class="col-md-2">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txtKdPos" id="txtkodepos" class="form-control" placeholder="12345" value="<?=$prospek['KODEPOS']?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Alamat <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea name="alamat" class="form-control" rows="2" placeholder="Jalan XYZ"><?=$prospek['ALAMAT']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Tanggal Lahir (dd-mm-yyyy)<span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="tgllahir" class="form-control form-control-inline input-medium date-picker" data-field="date" placeholder="31-12-2015" value="<?=$prospek['TGLLAHIR']?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jenis Kelamin <span class="required">*</span></label>
                                            <div class="col-md-9 radio-list">
                                                <label class="radio-inline"><input type="radio" name="kdjeniskelamin" value="L" <?=$prospek['KDJENISKELAMIN']=='L'?'checked':''?>> Pria </label>
                                                <label class="radio-inline"><input type="radio" name="kdjeniskelamin" value="P" <?=$prospek['KDJENISKELAMIN']=='P'?'checked':''?>> Wanita </label>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3">Status Pernikahan <span class="required">*</span></label>
                                            <div class="col-md-9 radio-list">
                                                <label class="radio-inline"><input type="radio" name="meritalstatus" value="L" <?=$prospek['MERITALSTATUS']=='L'?'checked':''?> checked> Lajang </label>
                                                <label class="radio-inline"><input type="radio" name="meritalstatus" value="K" <?=$prospek['MERITALSTATUS']=='K'?'checked':''?>> Kawin </label>
												<label class="radio-inline"><input type="radio" name="meritalstatus" value="J" <?=$prospek['MERITALSTATUS']=='J'?'checked':''?>> Janda </label>
                                                <label class="radio-inline"><input type="radio" name="meritalstatus" value="D" <?=$prospek['MERITALSTATUS']=='D'?'checked':''?>> Duda </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jenis Pekerjaan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdpekerjaan" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php if (!$pekerjaan['error']) {
															foreach($pekerjaan['message'] as $i => $v) {
																$selected = $prospek['KDPEKERJAAN'] == $v['KDPEKERJAAN'] ? 'selected' : '';
																echo "<option value='$v[KDPEKERJAAN]' $selected>$v[NAMAPEKERJAAN]</option>";
															}
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Hobi <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdhobi" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php if (!$hobi['error']) {
															foreach($hobi['message'] as $i => $v) {
																$selected = $prospek['KDHOBI'] == $v['KDHOBI'] ? 'selected' : '';
																echo "<option value='$v[KDHOBI]' $selected>$v[NAMAHOBI]</option>";
															}
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-3 control-label">Telepon Rumah<span class="required"></span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" id="idPhone1" name="telepon" class="form-control" placeholder="0211500151" value="<?=$prospek['TELEPON']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Telepon Selular <span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" id="idPhone2" name="hp" class="form-control" placeholder="08123456789" value="<?=$prospek['HP']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="email" name="email" class="form-control" placeholder="email@ifg-life.id" value="<?=$prospek['EMAIL']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Simpan</button>
                                                <a href="<?="$this->url"?>" class="btn default">Kembali</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dtBox"></div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/loadingoverlay.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/moment.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?=base_url()?>asset/js/components-pickers.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/js/jquery.formatter.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
	$("select[name='kdprovinsi']").change(function() {
		$.ajax({
			type: "get",
			dataType: "json",
			url: "<?=base_url(C_URL_API)?>/master/kota?kdprovinsi="+$(this).val(),
			beforeSend: function() { $.LoadingOverlay("show"); },
			complete: function() { $.LoadingOverlay("hide"); },
			success: function(data) {
				if (!data.error) {
					resetKota();
					
					for (const v of data.message) { // You can use `let` instead of `const` if you like
						
						$("select[name='kdkotamadya'").append($('<option>', { 
							value: v.KDKOTAMADYA,
							text : v.NAMAKOTAMADYA 
						}));
					}
				}
			}
		});
	});
	
	$("select[name='kdkotamadya']").change(function() {
		$.ajax({
			type: "get",
			dataType: "json",
			url: "<?=base_url(C_URL_API)?>/master/kecamatan?kdkotamadya="+$(this).val(),
			beforeSend: function() { $.LoadingOverlay("show"); },
			complete: function() { $.LoadingOverlay("hide"); },
			success: function(data) {
				if (!data.error) {
					resetKecamatan();
					
					for (const v of data.message) { // You can use `let` instead of `const` if you like
						
						$("select[name='ddlKdKecamatan'").append($('<option>', { 
							value: v.KDKECAMATAN,
							text : v.NAMAKECAMATAN 
						}));
					}
				}
			}
		});
	});
	
	$("select[name='ddlKdKecamatan']").change(function() {
		$.ajax({
			type: "get",
			dataType: "json",
			url: "<?=base_url(C_URL_API)?>/master/kelurahan?kdkecamatan="+$(this).val(),
			beforeSend: function() { $.LoadingOverlay("show"); },
			complete: function() { $.LoadingOverlay("hide"); },
			success: function(data) {
				if (!data.error) {
					resetKelurahan();
					
					for (const v of data.message) { // You can use `let` instead of `const` if you like
						
						$("select[name='kdkelurahan'").append($('<option>', { 
							value: v.KDKELURAHAN,
							text : v.NAMAKELURAHAN 
						}));
					}
				}
			}
		});
	});
	
	$("select[name='kdkelurahan']").change(function() {
		$.ajax({
			type: "get",
			dataType: "json",
			url: "<?=base_url(C_URL_API)?>/master/kelurahan/"+$(this).val(),
			beforeSend: function() { $.LoadingOverlay("show"); },
			complete: function() { $.LoadingOverlay("hide"); },
			success: function(data) {
				if (!data.error) {
					$('#txtkodepos').val(data.message.KODEPOS);
				}
			}
		});
	});
	
    $("input[name='tgllahir']").on('change', function() {
		var tgllahir = moment($(this).val(), "DD-MM-YYYY");
		if (moment().diff(tgllahir, 'year') < 17) {
			bootbox.alert("Minimal usia nasabah adalah 17 tahun.", function(){ 
				$("input[name='tgllahir']").val('');
			});
		}
		
		console.log();
    });
	
	function resetKota() {
		$("select[name='kdkotamadya'").empty();
		$("select[name='kdkotamadya'").append("<option value=''>Silahkan Pilih</option>");
		resetKecamatan();
		resetKelurahan();
	}
	
	function resetKecamatan() {
		$("select[name='ddlKdKecamatan'").empty();
		$("select[name='ddlKdKecamatan'").append("<option value=''>Silahkan Pilih</option>");
		resetKelurahan();
	}
	
	function resetKelurahan() {
		$("select[name='kdkelurahan'").empty();
		$("select[name='kdkelurahan'").append("<option value=''>Silahkan Pilih</option>");
		$('#txtkodepos').val('');
		
	}

    jQuery(document).ready(function() {
        //ComponentsPickers.init();
        $("#dtBox").DateTimePicker({ dateSeparator: "-", dateFormat: "dd-MM-yyyy" });
		$("#idPhone2, #idPhone1").formatter({'pattern': '{{999999999999999}}' });
		$("#idKTP").formatter({'pattern': '{{9999999999999999}}' });

        // form validation submit
        var error = $(".alert-danger", $("#form-prospek"));
        var success = $(".alert-success", $("#form-prospek"));
        $("#form-prospek").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                namaklien: {
                    minlength:2,
                    required: true
                },
                kdprovinsi : {
                    required: true
                },
                kdkotamadya : {
                    required: true
                },
                ddlKdKecamatan : {
                    required: true
                },
                kdkelurahan : {
                    required: true
                },
                alamat : {
                    required: true
                },
                tgllahir : {
                    required: true
                },
                kdpekerjaan : {
                    required: true
                },
				kdhobi : {
					required: true
				},
                hp : {
                    required: true,
                    number: true
                },
                noid : {
                    required: true,
                    number: true,
                    minlength: 16,
                    maxlength: 16
                },
                email : {
                    required: true,
                    email: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success.hide();
                error.show();
                Metronic.scrollTo(error, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight

            },

            success: function (label, element) { // if success
                /*var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");*/
            },

            submitHandler: function (form) {
                //success.show();
                error.hide();
                form[0].submit(); // submit the form
            }
        });
        // end of form validation submit
    });
</script>
<!-- END JAVASCRIPTS -->