<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/custom-bootbox-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
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
		<li>
            <a href="javascript:;">Prospek</a>
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
                                    <span class="caption-subject font-green-sharp bold uppercase">Follow Up Polis</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-prospek" class="form-horizontal" role="form" action="<?="$this->url/save-followup-polis"?>" method="post">

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
                                            <label class="col-md-3 control-label">Agent Terkait <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="username" value="<?= $this->session->USERNAME ?>" required hidden>
													<input type="text" name="agen" class="form-control" value="<?= $this->session->NAMALENGKAP ?>" required readonly>
													
                                                </div>
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-md-3 control-label">No Polis <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="nopolis" class="form-control" value="<?= $histories['polis']['NOPOLBARU'] ?>" required readonly>
													<input type="text" name="nospaj" value="<?= $histories['polis']['NOSPAJ'] ?>" hidden>
													<input type="text" name="buildId" value="<?= $histories['polis']['BUILDID'] ?>" hidden>
													<input type="text" name="prefix" value="<?= $histories['polis']['PREFIXPERTANGGUNGAN'] ?>" hidden>
													<input type="text" name="noper" value="<?= $histories['polis']['NOPERTANGGUNGAN'] ?>" hidden>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Hasil FollowUp<span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea name="hasil" class="form-control" rows="3" placeholder="Keterangan" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Waktu Agenda<span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="tanggal" class="form-control form-control-inline input-medium date-picker" data-field="datetime" placeholder="<?= date('d-m-Y H:i') ?>" readonly />
                                                </div>
                                            </div>
											<div class="col-md-6">
												<span>*Waktu agenda yang di set untuk nasabah yang akan di hubungi kembali</span>
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
<script src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
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
    });
	
	$("#idKTP").focusout(function() {
		var noagen = $("input[name='username']").val();
		$.ajax({
			type: "get",
			dataType: "json",
			url: "<?=base_url(C_URL_API)?>/pos/agen/"+noagen+"/"+$(this).val(),
			beforeSend: function() { $.LoadingOverlay("show"); },
			complete: function() { $.LoadingOverlay("hide"); },
			success: function(data) {
				if (!data.error) {
					if (data.message.length) {
						bootbox.alert("Data dengan No KTP yang dientry sudah ada.", function(){ 
							$("#idKTP").val('') 
						});						
					}
				}
			}
		});
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