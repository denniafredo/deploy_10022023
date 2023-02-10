<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8">
	<title>JAIM | Beranda</title>
	<link rel="shortcut icon" href="http://jaim.jiwasraya.co.id/asset/img/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="Aplikasi Manajemen Informasi Keagenan" name="description">
	<meta content="Fendy Christianto" name="author">
	
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"-->
	<link href="http://jaim.jiwasraya.co.id/asset/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/plugin/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/plugin/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
	<!-- END GLOBAL MANDATORY STYLES -->
	
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="http://jaim.jiwasraya.co.id/asset/plugin/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/plugin/morris/morris.css" rel="stylesheet" type="text/css">
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	
	<!-- BEGIN PAGE STYLES -->
	<link href="http://jaim.jiwasraya.co.id/asset/css/tasks.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE STYLES -->
	
	<!-- BEGIN THEME STYLES -->
	<link href="http://jaim.jiwasraya.co.id/asset/css/components-rounded.min.css" id="style_components" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/css/plugins.min.css" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="http://jaim.jiwasraya.co.id/asset/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color">
	<link href="http://jaim.jiwasraya.co.id/asset/css/custom.css" rel="stylesheet" type="text/css">
	<!-- END THEME STYLES -->
	
	
	
	<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<script src="http://jaim.jiwasraya.co.id/asset/js/jquery.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/js/jquery-migrate.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="http://jaim.jiwasraya.co.id/asset/plugin/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/plugin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/plugin/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/plugin/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/js/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/js/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/plugin/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
		
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="http://jaim.jiwasraya.co.id/asset/js/metronic.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/js/layout.js" type="text/javascript"></script>
	<script src="http://jaim.jiwasraya.co.id/asset/js/demo.js" type="text/javascript"></script>
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
<body>
<div class="page-header-top">
			<div class="container">
				<!-- BEGIN LOGO -->
				<div class="page-logo">
					<a href="http://jaim.jiwasraya.co.id/" style="text-decoration:none;" class="tooltips" data-container="body" data-placement="right" data-original-title="Jiwasraya Agency Information Management"><!--img src="http://jaim.jiwasraya.co.id/asset/img/logo-default.png" alt="logo" class="logo-default"--><span class="logo-default">JAiM</span></a>
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
														<span class="badge badge-default">1</span>
							</a>
							<ul class="dropdown-menu">
								<li class="external">
									<h3>Anda memiliki <strong>1</strong> notifikasi</h3>
									<!--a href="javascript:;">view all</a-->
								</li>
								<li>
									<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 275px;"><ul class="dropdown-menu-list scroller" style="height: 275px; overflow: hidden; width: auto;" data-handle-color="#637283" data-initialized="1">
																					<li>
												<a href="http://jaim.jiwasraya.co.id/account/ubah-password">
												<span class="time">baru</span>
												<span class="details">
												<span class="label label-sm label-icon label-warning">
												<i class="fa fa-key"></i>
												</span>
												Segera ubah password Anda. </span>
												</a>
											</li>
										
										
										
																			</ul><div class="slimScrollBar" style="background: rgb(99, 114, 131); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
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
							<img alt="" class="img-circle" src="http://jaim.jiwasraya.co.id/asset/avatar/11300167.jpg">
							<span class="username username-hide-mobile">GIDEON WAHYU PUTRA</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="http://jaim.jiwasraya.co.id/account/myprofile">
									<i class="icon-user"></i> Profil Saya</a>
								</li>
								<li>
									<a href="http://jaim.jiwasraya.co.id/account/ubah-password">
									<i class="fa fa-key"></i> Ubah Sandi </a>
								</li>
								<li>
									<a href="http://jaim.jiwasraya.co.id/account/signout">
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
