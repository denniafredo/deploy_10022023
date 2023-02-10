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

<body class="page-header-menu-fixed" style="background-color:#436EB3">


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
    <div class="page-content" style="background-color:#436EB3">

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url()?>asset/css/news.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>asset/css/pricing-table.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>asset/plugin/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>asset/css/portfolio.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->

        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">

                    <!-- BEGIN OTHERS-->
                    <div class="portlet light">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-12 news-page">


                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- BEGIN SAMPLE TABLE PORTLET-->
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-money font-green-sharp"></i>
                                                        <span class="caption-subject font-green-sharp bold uppercase">Info Kurs</span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-striped table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th style="text-align:center;">Kurs</th>
                                                                <th style="text-align:center;">Berlaku</th>
                                                                <th style="text-align:center;">Nilai</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($kurstransaksi as $i => $v) { ?>
                                                                <tr>
                                                                    <td><?=$v['VALUTA']?></td>
                                                                    <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                                    <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <th colspan="3">Nilai Aktiva Bersih</th>
                                                            </tr>
                                                            <tr>
                                                                <td><?=$kursjsfixed['VALUTA']?></td>
                                                                <td align="center"><?=$kursjsfixed['TGLBERLAKU']?></td>
                                                                <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $kursjsfixed['KURS']), 2, ",", ".")?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="3">NAB Jual</th>
                                                            </tr>
                                                            <?php foreach ($kursnabjual as $i => $v) { ?>
                                                                <tr>
                                                                    <td><?=$v['VALUTA']?></td>
                                                                    <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                                    <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <th colspan="3">NAB Beli</th>
                                                            </tr>
                                                            <?php foreach ($kursnabbeli as $i => $v) { ?>
                                                                <tr>
                                                                    <td><?=$v['VALUTA']?></td>
                                                                    <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                                    <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                                </tr>
                                                            <?php } ?>
                                                            <tr>
                                                                <th colspan="3">NAB JS New</th>
                                                            </tr>
                                                            <?php foreach ($kursnabnew as $i => $v) { ?>
                                                                <tr>
                                                                    <td><?=$v['VALUTA']?></td>
                                                                    <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                                    <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END SAMPLE TABLE PORTLET-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OTHERS -->

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->

    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container">
        Copyright &copy; 2016. PT. Asuransi Jiwasraya (Persero). Develop by IT team. All Rights Reserved.
        <!--Copyright &copy; 2015. PT. Asuransi Jiwasraya (Persero). Develop by IT & Keagenan Staff (Fendy, Nuke & Gideon). All Rights Reserved. -->
    </div>
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