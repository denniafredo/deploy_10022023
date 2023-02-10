<!-- BEGIN PAGE LEVEL STYLES -->
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
            <a href="javascript:;">Pencapaian</a>
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
                                    <span class="caption-subject font-green-sharp bold uppercase">Data Aktivasi Penjualan Bulan <?=date('m/Y')?></span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-aktivasi" class="form-horizontal" role="form" action="<?="$this->url/save-cabang"?>" method="post" enctype="multipart/form-data">
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
                                            <label class="col-md-3 control-label">Jenis Kegiatan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="ddlkdjeniskegiatan" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php foreach($jeniskegiatan as $i => $v) {
                                                            echo "<option value='$v[KDJENISKEGIATAN]'>$v[JENISKEGIATAN]</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Waktu Pelaksanaan <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="txtPelaksanaanAwal" data-date-format="dd/mm/yyyy" data-date-autoclose="1" placeholder="dd/mm/yyyy" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="text-align:center;">
                                                <label class="control-label">S / D</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="txtPelaksanaanAkhir" data-date-format="dd/mm/yyyy" data-date-autoclose="1" placeholder="dd/mm/yyyy" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tempat <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txtTempat" class="form-control" placeholder="Jakarta Pusat">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Deskripsi Kegiatan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea name="txtDeskripsi" class="form-control" rows="2" placeholder="Sosialisasi produk JS Prestasi di Sekolah"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Pelaksana Kegiatan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div id="divpelaksana" class="form-control height-auto">
                                                    <?php foreach ($areaoffice as $i => $v) { ?>
                                                        <label><input type="checkbox" class="cb-element" name="kdareaoffice[]" value="<?=$v['KDAREAOFFICE']?>" onclick="cekPelaksana()" /><?=$v['NAMAAREAOFFICE']?></label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Agen Pelaksana <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class='form-control height-auto'>
                                                    <div class="scroller" style="height:275px;" data-always-visible="1">
                                                        <span id="sagenpelaksana"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Potensi Premi Berkala<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="premiberkala" placeholder="200000" />
                                                </div>
                                                <span class="help-block">minimal: Rp200.000 </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Potensi Premi Sekaligus<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="premisekaligus" placeholder="10000000" />
                                                </div>
                                                <span class="help-block">minimal: Rp10.000.000 </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Potensi Prospek /Orang <span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" class="form-control" name="prospek" placeholder="999999" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Biaya <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="ddlbiaya" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <option value="cabang">Cabang </option>
                                                        <option value="pusat">Kantor Pusat</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group fnotadinaskp" style="display:none;">
                                            <label class="col-md-3 control-label">Upload Nota Dinas <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="file" name="fnotadinas">
                                                </div>
                                                <span class="help-block">maksimal: 1 Megabyte </span>
                                                <span class="help-block">dokumen: pdf </span>
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

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();

        // Pilih waktu pelaksanaan
        $("input[name='txtPelaksanaanAwal']").datepicker().on('changeDate', function(selected){
            startDate = new Date(selected.date.valueOf());
            $("input[name='txtPelaksanaanAkhir']").datepicker('setStartDate', startDate);
            endDate = new Date(startDate.getTime()+1209600000);
            $("input[name='txtPelaksanaanAkhir']").datepicker('setEndDate', endDate);
            $("input[name='txtPelaksanaanAkhir']").val('');
            $("#sagenpelaksana").html('');
            $("input:checkbox").removeAttr('checked');
            $.uniform.update('input:checkbox');
        });

        // ubah biaya
        $("select[name='ddlbiaya']").on('change', function (e) {
            if (this.value == 'pusat') {
                $(".fnotadinaskp").show();
            } else {
                $(".fnotadinaskp").hide();
            }
        });

        // form validation submit
        var error = $(".alert-danger", $("#form-aktivasi"));
        var success = $(".alert-success", $("#form-aktivasi"));
        $("#form-aktivasi").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                ddlkdjeniskegiatan : {
                    required: true
                },
                txtPelaksanaanAwal : {
                    required: true
                },
                txtPelaksanaanAkhir : {
                    required: true
                },
                txtTempat : {
                    required: true
                },
                txtDeskripsi : {
                    required: true
                },
                /*premiberkala : {
                    required: true,
                    minlength: 2,
                    min: 200000
                },
                premisekaligus : {
                    required: true,
                    minlength: 2,
                    min: 10000000
                },*/
                prospek : {
                    required: true
                },
                ddlbiaya : {
                    required: true
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
    
    function cekPelaksana() {
        var kdareaoffice = $("input[name='kdareaoffice[]']:checked").map(function () {return "'"+this.value+"'";}).get().join(",");
        var waktupelaksanaanawal = $("input[name='txtPelaksanaanAwal']").val();
        $.ajax({
            url: "<?="$this->url/ajax-agen-pelaksana"?>",
            type: "post",
            data: "kdareaoffice="+kdareaoffice+"&waktupelaksanaanawal="+waktupelaksanaanawal,
            async: false,
            success: function (data) {
                $("#sagenpelaksana").html(data);
                $("input:checkbox").uniform();
            }
        })

    }
</script>
<!-- END JAVASCRIPTS -->