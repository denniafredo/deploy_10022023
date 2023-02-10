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
                                <form id="form-aktivasi" class="form-horizontal" role="form" action="<?="$this->url/save-monitor"?>" method="post">
                                    <input type="hidden" name="noaktivasi" value="<?=$aktivasi['NOAKTIVASI']?>" />
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
                                            <label class="control-label col-md-3">Realisasi Pelaksanaan <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txtWaktuPelaksanaan" class="form-control form-control-inline input-medium date-picker" data-field="date" data-date-format="dd/mm/yyyy" placeholder="26/09/2017" value="<?=!empty($monitor['TGLPELAKSANAAN']) ? $monitor['TGLPELAKSANAAN'] : null?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">SPAJ <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class='form-control height-auto'>
                                                    <div class="scroller" style="height:275px;" data-always-visible="1">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">No SPAJ</th>
                                                                    <th class="text-center">Tgl SPAJ</th>
                                                                    <th class="text-center">Nama Pemegang Polis</th>
                                                                    <th class="text-center">Premi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 0; $total = 0;
                                                                foreach ($spaj as $i => $v) {
                                                                    $i++;
                                                                    $total += $v['PREMI']; ?>
                                                                    <tr>
                                                                        <td style="padding:4px;text-align:center"><?=$v['NOSP']?></td>
                                                                        <td style="padding:4px;text-align:center"><?=$v['TGLSP']?></td>
                                                                        <td style="padding:4px;text-align:left"><?=$v['NAMAPEMPOL']?></td>
                                                                        <td style="padding:4px;text-align:right"><?=number_format($v['PREMI'], 0, ',', '.')?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="2" class="text-center">Total</th>
                                                                    <th class="text-center"><?=$i?></th>
                                                                    <th class="text-right"><?=number_format($total, 0, ',', '.')?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Polis <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class='form-control height-auto'>
                                                    <div class="scroller" style="height:275px;" data-always-visible="1">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">No SPAJ</th>
                                                                    <th class="text-center">No Polis</th>
                                                                    <th class="text-center">Kode Produksi</th>
                                                                    <th class="text-center">Nama Pemegang Polis</th>
                                                                    <th class="text-center">Premi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $i = 0; $total = 0;
                                                                foreach ($polis as $i => $v) {
                                                                    $i++;
                                                                    $total += $v['PREMI']; ?>
                                                                    <tr>
                                                                        <td class="text-center"><?=$v['NOSP']?></td>
                                                                        <td class="text-center"><?="$v[PREFIXPERTANGGUNGAN]-$v[NOPERTANGGUNGAN]"?></td>
                                                                        <td><?=$v['KDPRODUK']?></td>
                                                                        <td><?=$v['NAMAPEMEGANGPOLIS']?></td>
                                                                        <td class="text-right"><?=number_format($v['PREMI'], 0, ',', '.')?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                            <thead>
                                                                <tr>
                                                                    <th colspan="3" class="text-center">Total</th>
                                                                    <th class="text-center"><?=$i?></th>
                                                                    <th class="text-right"><?=number_format($total, 0, ',', '.')?></th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Kendala <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea name="txtKendala" class="form-control" rows="2" placeholder=""><?=!empty($monitor['KENDALA']) ? $monitor['KENDALA'] : null?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Solusi <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea name="txtSolusi" class="form-control" rows="2" placeholder=""><?=!empty($monitor['SOLUSI']) ? $monitor['SOLUSI'] : null?></textarea>
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

        // form validation submit
        var error = $(".alert-danger", $("#form-prospek"));
        var success = $(".alert-success", $("#form-prospek"));
        $("#form-aktivasi").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                ddlkdjeniskegiatan : {
                    required: true
                },
                txtWaktuPelaksanaan : {
                    required: true
                },
                txtTempat : {
                    required: true
                },
                txtDeskripsi : {
                    required: true
                },
                premi : {
                    required: true,
                    minlength: 2,
                    min: 200000
                },
                prospek : {
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
        $.ajax({
            url: "<?="$this->url/ajax-agen-pelaksana"?>",
            type: "post",
            data: "kdareaoffice="+kdareaoffice,
            async: false,
            success: function (data) {
                $("#sagenpelaksana").html(data);
            }
        })

    }
</script>
<!-- END JAVASCRIPTS -->