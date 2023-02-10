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
<div style="background: #3b434c;color: #a2abb7; position: fixed; top: 0; left: 0; z-index: 1; width: 100%;height:60px;">
    <!--<a href="<?=$this->url?>" class="btn btn-sm blue pull-left">
        JAiM <i class="icon-home"></i>
    </a>-->

    <span class="input-group-btn">
        <a href="<?="$this->url/add-simulasi"?>" class="btn btn-sm yellow-casablanca tooltips pull-right" 
		style="height:60px;width:60px;">
            <br /><i class="fa fa-plus"></i>
        </a>

        <a href="<?=current_url()?>" class="btn btn-sm grey-cascade tooltips pull-right" style="height:60px;width:60px;">
            <br /><i class="fa fa-refresh"></i>
        </a>

		<?php if ($this->session->USERDEVICE == 'browser') { ?>
        <a href="<?=$this->url?>" class="btn btn-sm purple-wisteria tooltips pull-right" style="height:60px;width:60px;">
            <br /><i class="icon-action-undo"></i><?=$idagen?>
        </a>
		<?php } ?>
    </span>
</div>
<br />
<br />
<br />
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
        <link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->

        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">

                    <!-- BEGIN DAFTAR PROSPEK -->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-doc font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Data Prospeks</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <form method="get" />
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="s" class="form-control" style="z-index:0;" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                                        <span class="input-group-btn">
                                            <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </form>

                            <div class="table-scrollable">
                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                    <tr>
                                        <th style="text-align:center; vertical-align:middle;">No</th>
                                        <th style="text-align:center; vertical-align:middle;">Nama</th>
                                        <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                        <th style="text-align:center; vertical-align:middle;">Tgl Lahir</th>
                                        <th style="text-align:center; vertical-align:middle;">Telp</th>
                                        <th style="text-align:center; vertical-align:middle;">HP</th>
                                        <th style="text-align:center; vertical-align:middle;">Opsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($prospek as $i => $v) { ?>
                                        <tr>
                                            <td align="center"><?=$v['NO']?></td>
                                            <td nowrap><?=$v['NAMA']?></td>
                                            <td nowrap><?=$v['ALAMAT']?></td>
                                            <td align="center"><?=$v['TGLLAHIR']?></td>
                                            <td align="center"><?=$v['TELP']?></td>
                                            <td align="center"><?=$v['HP']?></td>
                                            <td nowrap class="text-center" width="95">
                                                <a href="<?="$this->url/edit-simulasi?id=$v[NOPROSPEK]"?>" class="btn btn-xs yellow-gold tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_EDIT?>"><i class="fa fa-pencil btn-xs-tbl"></i></a>
                                                <a href="<?="$this->url/proposal?id=$v[NOPROSPEK]"?>" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="Proposal"><i class="fa fa-search-plus btn-xs-tbl"></i></a>
                                                <a class="btn btn-xs red-flamingo tooltips btn-delete" data-value="<?=$v['NOPROSPEK']?>" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center">
                                <?=$this->pagination->create_links();?>
                            </div>
                        </div>
                    </div>
                    <!-- END DAFTAR PROSPEK -->

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
        <script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
        <script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
        <script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <script>
            jQuery(document).ready(function() {
                $("input[name='s']").focus();

                $('.btn-delete').click(function(){
                    var noprospek = $(this).attr('data-value');
                    bootbox.confirm({
                        size: 'small',
                        message: 'Yakin hapus data?',
                        callback: function(result){
                            if (result)
                                window.location.href = "<?="$this->url/del-simulasi?id="?>"+noprospek;
                        }
                    });
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