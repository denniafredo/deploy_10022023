<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    Widget settings form goes here
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn blue">Save changes</button>
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?=base_url('account/myprofile')?>">Profil Saya</a>
            <i class="fa fa-circle"></i>
        </li>
        <li class="active">
            Biodata
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="row margin-top-10">
        <div class="col-md-12">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="profile-sidebar" style="width: 250px;">
                <!-- PORTLET MAIN -->
                <div class="portlet light profile-sidebar-portlet">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="<?=base_url('asset/avatar/'.$this->session->AVATAR)?>" class="img-responsive" alt="">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?=ucwords(strtolower($this->session->NAMALENGKAP))?>
                        </div>
                        <div class="profile-usertitle-job">
                            <?=$user['NAMAJABATANAGEN']?>
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <!--div class="profile-userbuttons">
                        <button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
                        <button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
                    </div-->
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <!--li>
                                <a href="extra_profile.html">
                                <i class="icon-home"></i>
                                Ikhtisar </a>
                            </li-->
                            <li>
                                <a href="<?=base_url('account/myprofile')?>">
                                    <i class="icon-user"></i>
                                    Biodata </a>
                            </li>
                            <li class="active">
                                <a href="<?=base_url('account/ubah-password')?>">
                                    <i class="fa fa-key"></i>
                                    Ubah Sandi </a>
                            </li>
                            <!--li>
                                <a href="extra_profile_help.html">
                                <i class="icon-info"></i>
                                Help </a>
                            </li-->
                        </ul>
                    </div>
                    <!-- END MENU -->
                </div>
            </div>
            <!-- END BEGIN PROFILE SIDEBAR -->

            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">

                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa icon-key font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">Ubah Kata Sandi</span>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form id="form-ubah-sandi" class="form-horizontal" role="form" action="<?="$this->url/save-ubah-password"?>" method="post">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button>
                                                You have some form errors. Please check below.
                                            </div>
                                            <div class="alert alert-warning display-hide">
                                                <button class="close" data-close="alert"></button>
                                                Oh Tidak! Password salah.
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Password Lama <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="password" name="password" class="form-control" value="" placeholder="oooooooooooo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Password Baru <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="password" name="newpassword" class="form-control" value="" placeholder="oooooooooooo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Ulangi Password <span class="required">*</span></label>
                                                <div class="col-md-9">
                                                    <div class="input-icon right">
                                                        <i class="fa"></i>
                                                        <input type="password" name="repeatpassword" class="form-control" value="" placeholder="oooooooooooo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/form-validation.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        $("input[name='password']").focusout(function() {
            $.ajax({
                url: "<?="$this->url/ajax-cek-password"?>",
                type: "post",
                data: "val="+this.value,
                success: function (data) {
                    if (data == '0')
                        $(".alert-warning").show();
                    else
                        $(".alert-warning").hide();
                }
            })
        });

        /*===== toastr notification =====*/
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "showMethod": "fadeIn"
        };
        if ("<?=$status?>" == "<?=C_STATUS_SUKSES_SIMPAN?>")
            toastr.success('Oo yeaah, data berhasil disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN?>")
            toastr.error('Oo tidaak, data gagal disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_SUKSES_HAPUS?>")
            toastr.success('Oo yeaah, data berhasil dihapus.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_HAPUS?>")
            toastr.error('Oo tidaak, data gagal dihapus.');
        /*===== end of toastr notification =====*/

        // form validation submit
        var error = $(".alert-danger", $("#form-ubah-sandi"));
        var success = $(".alert-success", $("#form-ubah-sandi"));
        $("#form-ubah-sandi").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                password: {
                    required: true
                },
                newpassword : {
                    required: true
                },
                repeatpassword : {
                    required: true,
                    equalTo : "input[name='newpassword']"
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