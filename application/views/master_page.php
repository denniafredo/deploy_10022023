<?error_reporting(0);?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js notranslate" translate="no">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <title>AIMS | <?=$this->template->title;?></title>
    <link rel="shortcut icon" href="<?=base_url()?>asset/img/favicon.ico" />
    <meta name="google" content="notranslate" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Aplikasi Manajemen Informasi Keagenan" name="description">
    <meta content="Fendy Christianto" name="author">
	<link rel="shortcut icon" href="<?= base_url('asset/img/favicon.ico') ?>">

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

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=base_url()?>asset/js/metronic.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/layout.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/demo.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {    
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            Demo.init(); // init demo(theme settings page)
        });
        // Popup windows open
        function openWin(url, reload = false) {
            var w  = window.screen.availWidth * 90 / 100, h = window.screen.availHeight * 60 / 100;
            var l  = (screen.width/2)-(w/2), t = (screen.height/2)-(h/2);
            window.open(url, "popup", "width="+w+", height="+h+", directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no, scrollbars=yes, left="+l+", top="+t);

            if (reload)
                location.reload();
        }
    </script>
    <!-- END JAVASCRIPTS -->
    <link rel="shortcut icon" href="favicon.ico">
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body class="page-header-menu-fixed">
    <!-- BEGIN HEADER -->
    <div class="page-header">
        <!-- BEGIN HEADER TOP -->
        <div class="page-header-top">
            <div class="container">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                        <a href="<?=base_url()?>" style="text-decoration:none;" class="tooltips" data-container="body" data-placement="right" data-original-title="IFG Agency Information Management System"><!--img src="<?=base_url()?>asset/img/logo-default.png" alt="logo" class="logo-default"--><span class="logo-default">IFG AIM</span></a>
                </div>
                <!-- END LOGO -->

                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler"></a>
                <!-- END RESPONSIVE MENU TOGGLER -->

                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">

                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <li class="dropdown dropdown-extended dropdown-dark dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-bell"></i>
                            <?php
                                $nonotif = 0;
                                //$data = $this->kuesioner_model->get_list_grup_kuesioner_user();
								$data = array();
                                $data2 = $this->user_model->get_biodata_by_id($this->session->USERNAME);
								//$data3 = $this->user_model->get_agen_kickoff($this->session->USERNAME);
								$data3 = array();
								$data4 = $this->prospek_model->get_list_pending();
                                $nonotif = count($data4) + count($data3) + count($data) + ($data2['SISAPKAJ'] <= 30 ? 1 : 0) + ($this->session->USERNAME == $this->session->PASSWORD ? 1 : 0);
                                
								if ($nonotif > 0) { ?>
									<span class="badge badge-default"><?=$nonotif?></span>
								<?php } ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>Anda memiliki <strong><?=$nonotif?></strong> notifikasi</h3>
                                    <!--a href="javascript:;">view all</a-->
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <?php if (strtolower($this->session->USERNAME) == strtolower($this->session->PASSWORD)) { ?>
                                            <li>
                                                <a href="<?=base_url("account/ubah-password")?>">
                                                    <span class="time">baru</span>
                                                    <span class="details">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-key"></i>
                                                    </span>Segera ubah password Anda. </span>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <?php /*foreach ($data as $ii => $k) { ?>
                                            <li>
                                                <a href="<?=base_url("kuesioner?id=$k[IDGRUP]&kategori=$k[IDKATEGORI]")?>">
                                                    <span class="time">baru</span>
                                                    <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                        <i class="fa fa-comments"></i>
                                                    </span>
                                                    <?=$k['JUDUL']?> </span>
                                                </a>
                                            </li>
                                        <?php }*/ ?>
                                            
                                        <?php if ($data2['SISAPKAJ'] <= 30) { ?>
                                            <li>
                                                <a href="javascript:void(0);" onclick="alert('Harap hubungi Seksi Operasional untuk perpanjangan atau SPAJ Anda tidak dapat diproses dan akun Anda akan dinonaktifkan');">
                                                    <span class="time">baru</span>
                                                    <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-warning"></i>
                                                    </span>PKAJ anda akan berakhir <?=$data2['SISAPKAJ'];?> hari </span>
                                                </a>
                                            </li>
                                        <?php } ?>
										
										<?php if (count($data4 > 0)) {
											foreach ($data4 as $i => $v) { ?>
												<li>
													<a href="<?=base_url("prospek/follow-up?buildid=$v[BUILDID]")?>">
														<span class="time">baru</span>
														<span class="details">
														<span class="label label-sm label-icon label-danger">
															<i class="fa fa-warning"></i>
														</span>Build ID <?=$v['BUILDID']?> Tertunda </span>
													</a>
												</li>
											<?php }
										} ?>

										<?php /*if ($data3['USERNAME'] == $this->session->USERNAME) { ?>
                                            <li>
                                                <a href="<?=base_url("asset/img/kickoff-youre-invited.jpg")?>" target="_blank">
                                                    <span class="time">baru</span>
                                                    <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span>Undangan kick off </span>
                                                </a>
                                            </li>
                                        <?php }*/ ?>

                                        <?php /*if (file_get_contents(C_URL_API_JAIM."/topagenaward.php?r=1&p=".$this->session->USERNAME)) { ?>
                                            <li>
                                                <a href="<?=base_url("topagenaward?id=".base64_encode($this->session->USERNAME))?>">
                                                    <span class="time">baru</span>
                                                    <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                    <i class="fa fa-bell-o"></i>
                                                    </span>
                                                    Undangan Top Agent Award
                                                     </span>
                                                </a>
                                            </li>
                                        <?php }*/ ?>

                                        <?php /*if (count($data) <= 0) { ?>
                                            <li>
                                                <a href="<?=base_url("kuesioner")?>">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                    <i class="fa fa-comments"></i>
                                                    </span>
                                                    Mengisi Kuesioner. </span>
                                                </a>
                                            </li>
                                        <?php }*/ ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->

                        <!-- BEGIN TODO DROPDOWN -->
                        <li class="dropdown dropdown-extended dropdown-dark dropdown-tasks" id="header_task_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-calendar"></i>
                                <span class="badge badge-default"><!--3--></span>
                            </a>
                            <ul class="dropdown-menu extended tasks">
                                <li class="external">
                                    <h3>Anda tidak memiliki notifikasi</h3>
                                </li>
                            </ul>
                        </li>
                        <!-- END TODO DROPDOWN -->

                        <li class="droddown dropdown-separator">
                            <span class="separator"></span>
                        </li>

                        <!-- BEGIN INBOX DROPDOWN -->
                        <li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="circle">0</span>
                                <span class="corner"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>Anda tidak memiliki pesan baru</h3>
                                </li>
                            </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class="dropdown dropdown-user dropdown-dark">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="<?=base_url("asset/avatar/".$this->session->AVATAR)?>">
                                <span class="username username-hide-mobile"><?php 
									if ($this->session->KDROLE == '5' || $this->session->KDROLE == '6') 
										{
											if($this->session->KDROLE == '5') {
												echo "Super User Agency";
											} else {
												echo "Super Admin Agency";
											}
										} 
									else 
										{
											echo $this->session->NAMALENGKAP;
										}
									?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?=base_url('account/myprofile')?>">
                                    <i class="icon-user"></i> Profil Saya</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('account/ubah-password')?>">
                                    <i class="fa fa-key"></i> Ubah Sandi </a>
                                </li>
                                <li>
                                    <a href="<?=base_url('account/signout')?>">
                                    <i class="fa fa-sign-out"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
        </div>
        <!-- END HEADER TOP -->

        <!-- BEGIN HEADER MENU -->
        <div class="page-header-menu">
            <div class="container">
                <div class="hor-menu ">
                    <ul class="nav navbar-nav"> <?php
                        // bentuk menu dari fungsi custom librari
                        foreach ($this->menu->l_menu() as $i => $r) {
                            $url = $r['URL'] ? base_url($r['URL']) : "javascript:;";
                            
                            if (empty($r['CHILDREN'])) {
                                if ($r['KDMENU'] == 'MN18030001' && $this->session->USERNAME == '0000030561') continue; // buat kondisi pembekuan menu SPAJ pada agen 0000030561
                                echo "<li><a href='$url'>$r[MENU]</a></li>";
                            } else {
				                if ($r['KDMENU'] == 'MN20020001' && $this->session->USERNAME != '0011300167') break; // bisa dihapus ketika sudah go live
                                echo "<li class='menu-dropdown classic-menu-dropdown'>
                                    <a data-hover='megamenu-dropdown' data-close-others='true' data-toggle='dropdown' href='$url'>
                                        $r[MENU] <i class='fa fa-angle-down'></i></a>
                                            <ul class='dropdown-menu pull-left'>";
                                                get_submenu($r['CHILDREN'], $this->session->USERNAME);
                                            echo "</ul>
                                    </li>";
                            }
                        }

                        // fungsi untuk membentuk sub menu
                        function get_submenu($submenu, $username) {
                            foreach ($submenu as $i => $r) {
                                $url = $r['URL'] ? base_url($r['URL']) : "javascript:;";

                                if (empty($r['CHILDREN'])) {
                                    if ($r['KDMENU'] == 'MN21070001' && $username == '0000030561') continue; // buat kondisi pembekuan menu prospek saya pada agen 0000030561
                                    echo "<li>
                                        <a href='$url'>
                                        <i class='$r[ICON]'></i>
                                        $r[MENU]
                                        </a></li>";
                                }
                                else {
                                    echo "<li class='dropdown-submenu'>
                                        <a href='$url'>
                                        <i class='$r[ICON]'></i>
                                        $r[MENU]
                                        </a>
                                        <ul class='dropdown-menu'>";
                                    get_submenu($r['CHILDREN']);
                                    echo "</ul></li>";
                                }
                            }
                        } ?>
                    </ul>
                </div>
                <!-- END MEGA MENU -->
            </div>
        </div>
        <!-- END HEADER MENU -->

    </div>
    <!-- END HEADER -->

    <!-- BEGIN PAGE CONTAINER -->
    <div class="page-container">
        <!-- BEGIN PAGE HEAD -->
        <div class="page-head">
            <div class="container">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                        <h1><?=(isset($page_title) ? $page_title : null)?> <small><?=(isset($page_title_small) ? $page_title_small : null)?></small></h1>
                </div>
                <!-- END PAGE TITLE -->
                <!-- BEGIN PAGE TOOLBAR -->
                <div class="page-toolbar">

                </div>
                <!-- END PAGE TOOLBAR -->
            </div>
        </div>
        <!-- END PAGE HEAD -->

        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
                <?=$this->template->content?>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- BEGIN PRE-FOOTER -->
    <div class="page-prefooter">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 footer-block">
                    <h2>Tentang</h2>
                    <p>
                        IFG AIM (IFG Life Agency Information Management) adalah aplikasi yang diperuntukan mitra kerja agen IFG.
                    </p>
                </div>

                <!--div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                    <h2>Layanan</h2>
                    <?=$this->session->NAMAKANTOR?>
                    <address class="margin-bottom-40">
                        Phone: <?=$this->session->PHONEKANTOR?><br>
                        Email: <a href="mailto:<?=$this->session->EMAILKANTOR?>"><?=$this->session->EMAILKANTOR?></a>
                    </address>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 footer-block">
                    <h2>&nbsp;</h2>
                    <?=$this->session->NAMAINDUK?>
                    <address class="margin-bottom-40">
                        Phone: <?=$this->session->PHONEINDUK?><br>
                        Email: <a href="mailto:<?=$this->session->EMAILINDUK?>"><?=$this->session->EMAILINDUK?></a>
                    </address>
                </div-->
            </div>
        </div>
    </div>
    <!-- END PRE-FOOTER -->
    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="container">
            Copyright &copy; 2015. PT. Asuransi Jiwa IFG. Develop by IT team. All Rights Reserved.
            <!--Copyright &copy; 2015. PT. Asuransi Jiwasraya (Persero). Develop by IT & Keagenan Staff (Fendy, Nuke & Gideon). All Rights Reserved. -->
        </div>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
    <!-- END FOOTER -->

    <!-- Google Analytic -->
    <!--script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function() {
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