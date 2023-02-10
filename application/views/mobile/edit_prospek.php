<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <title>JAIM | <?=$this->template->title;?></title>
    <link rel="shortcut icon" href="<?=base_url()?>asset/img/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Aplikasi Manajemen Informasi Keagenan" name="description">
    <meta content="Fendy Christianto" name="author">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"-->
    <link href="<?=base_url()?>asset/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="<?=base_url()?>asset/plugin/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/morris/morris.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGIN STYLES -->

    <!-- BEGIN PAGE STYLES -->
    <link href="<?=base_url()?>asset/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="<?=base_url()?>asset/css/components-rounded.min.css" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/css/plugins.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?=base_url()?>asset/css/custom.css" rel="stylesheet" type="text/css">
    <!-- END THEME STYLES -->



    <!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="../../assets/global/plugins/respond.min.js"></script>
    <script src="../../assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?=base_url()?>asset/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?=base_url()?>asset/plugin/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!--script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <!--script src="<?=base_url()?>asset/plugin/morris/morris.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/morris/raphael-min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/js/jquery.sparkline.min.js" type="text/javascript"></script-->
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=base_url()?>asset/js/metronic.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/layout.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/demo.js" type="text/javascript"></script>
    <!--script src="<?=base_url()?>asset/js/index3.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/js/tasks.js" type="text/javascript"></script-->
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            Demo.init(); // init demo(theme settings page)
            /*Index.init(); // init index page
             Tasks.initDashboardWidget(); // init task dashboard widget*/
        });
    </script>
    <!-- END JAVASCRIPTS -->
    <link rel="shortcut icon" href="favicon.ico">
</head>

<body class="page-header-menu-fixed">
<div style="background: #3b434c;color: #a2abb7; position: fixed; top: 0; left: 0; z-index: 1; width: 100%;">
    <!--<a href="<?=$this->url?>" class="btn btn-sm blue pull-left">
        JAiM <i class="icon-home"></i>
    </a>-->

    <span class="input-group-btn">
        <a href="<?=current_url()?>" class="btn btn-sm grey-cascade tooltips pull-right">
            <i class="fa fa-refresh"></i>
        </a>

        <a href="<?="$this->url/simulasi"?>" class="btn btn-sm purple-wisteria tooltips pull-right">
            <i class="icon-action-undo"></i>
        </a>
    </span>
</div>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">

        </div>
    </div>
    <!-- END PAGE HEAD -->

    <div class="clearfix margin-bottom-10"></div>

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
        <!-- END PAGE LEVEL STYLES -->

        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">

                    <!-- BEGIN EDIT PROSPEK -->
                    <div class="portlet light">
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Data Prospek</span>
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"></a>
                                            <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form id="form-prospek" class="form-horizontal" role="form" action="<?="$this->url/simulasi-proses"?>" method="post">
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
                                                    <label class="col-md-3 control-label">No Prospek</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="txtNoProspek" class="form-control" value="<?=$prospek['NOPROSPEK']?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">No Agen</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="txtNoAgen" class="form-control" value="<?=$this->session->USERNAME?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nama Lengkap <span class="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" name="txtNamaLengkap" class="form-control" value="<?=$prospek['NAMA']?>" placeholder="Jiwasraya Agency Information Management">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Alamat <span class="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <textarea name="txtAlamat" class="form-control" rows="2" placeholder="Jln. IR. H. Juanda No 34"><?=$prospek['ALAMAT']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Kota <span class="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" name="txtKota" class="form-control" value="<?=$prospek['KOTA']?>" placeholder="Jakarta Pusat">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Provinsi <span class="required">*</span></label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <select name="ddlKdProvinsi" class="form-control">
                                                                <option value="">Silahkan Pilih</option>
                                                                <?php foreach($provinsi as $i => $v) {
                                                                    if ($v['KDPROVINSI'] == $prospek['KDPROVINSI'])
                                                                        echo "<option value='$v[KDPROVINSI]' selected>$v[NAMAPROVINSI]</option>";
                                                                    else
                                                                        echo "<option value='$v[KDPROVINSI]'>$v[NAMAPROVINSI]</option>";
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Tanggal Lahir <span class="required">*</span></label>
                                                    <div class="col-md-3">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" name="txtTglLahir" class="form-control form-control-inline input-medium date-picker" data-date-format="dd/mm/yyyy" value="<?=$prospek['TGLLAHIR']?>" placeholder="31/12/2015" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Jenis Kelamin <span class="required">*</span></label>
                                                    <div class="col-md-9 radio-list">
                                                        <label class="radio-inline"><input type="radio" name="rbJnsKelamin" id="jeniskelamin" value="M" <?=($prospek['JENISKELAMIN'] == 'M' ? 'checked' : null)?>> Pria </label>
                                                        <label class="radio-inline"><input type="radio" name="rbJnsKelamin" id="jeniskelamin" value="F" <?=($prospek['JENISKELAMIN'] == 'F' ? 'checked' : null)?>> Wanita </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">No Telp / HP <span class="required">*</span></label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="text" name="txtPhone1" class="form-control" value="<?=$prospek['TELP']?>" placeholder="0213845031">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" name="txtPhone2" class="form-control" value="<?=$prospek['HP']?>" placeholder="0211500151">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email <span class="required">*</span></label>
                                                    <div class="col-md-4">
                                                        <div class="input-icon right">
                                                            <i class="fa"></i>
                                                            <input type="email" name="txtEmail" class="form-control" value="<?=$prospek['EMAIL']?>" placeholder="Email@jiwasraya.co.id">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="submit" class="btn green">Simpan</button>
                                                        <a href="<?="$this->url/simulasi"?>" class="btn default">Kembali</a>
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
                    <!-- END EDIT PROSPEK -->

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
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
                $("#form-prospek").validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "",  // validate all fields including form hidden input
                    rules: {
                        txtNamaLengkap: {
                            minlength:2,
                            required: true
                        },
                        txtAlamat : {
                            required: true
                        },
                        txtKota : {
                            required: true
                        },
                        ddlKdProvinsi : {
                            required: true
                        },
                        txtTglLahir : {
                            required: true
                        },
                        txtPhone1 : {
                            required: true,
                            number: true
                        },
                        txtEmail : {
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

    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container">
        Copyright &copy; 2015. PT. Asuransi Jiwasraya (Persero). Develop by IT team. All Rights Reserved.
        <!--Copyright &copy; 2015. PT. Asuransi Jiwasraya (Persero). Develop by IT & Keagenan Staff (Fendy, Nuke & Gideon). All Rights Reserved. -->
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->

<!-- Google Analytic -->
<!--script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-70603952-1', 'auto');
    ga('send', 'pageview');
</script>
<!-- End of Google Analytic -->
</body>
<!-- END BODY -->
</html>