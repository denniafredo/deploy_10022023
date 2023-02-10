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
                                    <span class="caption-subject font-green-sharp bold uppercase">Unggah nota kantor pusat Aktivasi No <?=$this->input->get('id')?></span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-aktivasi" class="form-horizontal" role="form" action="<?="$this->url/save-kapus"?>" method="post" enctype="multipart/form-data">
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
                                            <label class="col-md-3 control-label">Nota Dinas Cabang</label>
                                            <div class="col-md-9">
                                                <i class='fa fa-file' style='cursor:pointer;' onclick="openWin('<?=base_url("asset/notdin/aktivasi/$aktivasi[FILENOTADINAS]")?>')"> <?=$aktivasi['FILENOTADINAS']?></i>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Upload Nota Dinas KaPus <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="file" name="fnotadinaskapus">
                                                    <input type="hidden" name="oldfnotadinaskapus" value="<?=$aktivasi['FILEJAWABANKP']?>" >
                                                </div>
                                                <span class="help-block">disarankan maksimal : 1 Megabyte </span>
                                                <?php if (!empty($aktivasi['FILEJAWABANKP']) && strlen($aktivasi['FILEJAWABANKP'])) { ?>
                                                <i class='fa fa-file' style='cursor:pointer;' onclick="openWin('<?=base_url("asset/notdin/aktivasi/$aktivasi[FILEJAWABANKP]")?>')"> <?=$aktivasi['FILEJAWABANKP']?></i>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="submit" class="btn green">Simpan</button>
                                                <a href="<?="$this->url/index-kapus"?>" class="btn default">Kembali</a>
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

<script>
    jQuery(document).ready(function() {
        // form validation submit
        var error = $(".alert-danger", $("#form-aktivasi"));
        var success = $(".alert-success", $("#form-aktivasi"));
        $("#form-aktivasi").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                fnotadinaskapus : {
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
</script>
<!-- END JAVASCRIPTS -->