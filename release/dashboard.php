<?php

//echo "Maaf, eSPAJ sedang maintenance. Silahkan Buka Kembali pada pukul 19:00 WIB";
//exit;
$token = isset($token)?"'".$token."'":'null';
$idagen = isset($idagen)?"'".$idagen."'":'null';

$cd = $this->user_model->countdown($this->session->USERNAME);
$expiredUser = strtotime($cd['TGLAKHIRLISENSI']) < strtotime(date('d-M-y'));
$pbeUser = $this->session->KDJABATANAGEN == '27';
$pbeUser || $expiredUser ? header('Location: ' . base_url()) : '';
?>
<!DOCTYPE html>
<html lang="en">
<!-- https://codepen.io/paulmccann/pen/003dce22c6bc318133f304077866173f -->

<head>
	<meta charset="UTF-8">
	<title>eSPAJ</title>
	<link rel='stylesheet prefetch' href='../asset/css/bootstrap.min.css'>
	<style>
		.no-padding {
			padding: 0px;
		}
		
		.glyphicon-icon-rpad .glyphicon,
		.glyphicon-icon-rpad .glyphicon.m8,
		.fa-icon-rpad .fa,
		.fa-icon-rpad .fa.m8 {
			padding-right: 8px;
		}
		
		.glyphicon-icon-lpad .glyphicon,
		.glyphicon-icon-lpad .glyphicon.m8,
		.fa-icon-lpad .fa,
		.fa-icon-lpad .fa.m8 {
			padding-left: 8px;
		}
		
		.glyphicon-icon-rpad .glyphicon.m5,
		.fa-icon-rpad .fa.m5 {
			padding-right: 5px;
		}
		
		.glyphicon-icon-lpad .glyphicon.m5,
		.fa-icon-lpad .fa.m5 {
			padding-left: 5px;
		}
		
		.glyphicon-icon-rpad .glyphicon.m12,
		.fa-icon-rpad .fa.m12 {
			padding-right: 12px;
		}
		
		.glyphicon-icon-lpad .glyphicon.m12,
		.fa-icon-lpad .fa.m12 {
			padding-left: 12px;
		}
		
		.glyphicon-icon-rpad .glyphicon.m15,
		.fa-icon-rpad .fa.m15 {
			padding-right: 15px;
		}
		
		.glyphicon-icon-lpad .glyphicon.m15,
		.fa-icon-lpad .fa.m15 {
			padding-left: 15px;
		}
		
		ul.nav-menu-list-style .nav-header .menu-collapsible-icon {
			position: absolute;
			right: 3px;
			top: 16px;
			font-size: 9px;
		}
		
		ul.nav-menu-list-style {
			margin: 0;
		}
		
		ul.nav-menu-list-style .nav-header {
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #e8e8e8;
			display: block;
			margin: 0;
			line-height: 42px;
			padding: 0 8px;
			font-weight: 600;
		}
		
		ul.nav-menu-list-style> li {
			position: relative;
		}
		
		ul.nav-menu-list-style> li a {
			border-top: 1px solid #FFFFFF;
			border-bottom: 1px solid #e8e8e8;
			padding: 0 10px;
			line-height: 32px;
		}
		
		ul.nav-menu-list-style> li:first-child a {}
		
		ul.nav-menu-list-style {
			list-style: none;
			padding: 0px;
			margin: 0px;
		}
		
		ul.nav-menu-list-style li .badge,
		ul.nav-menu-list-style li .pull-right,
		ul.nav-menu-list-style li span.badge,
		ul.nav-menu-list-style li label.badge {
			float: right;
			margin-top: 7px;
		}
		
		ul.bullets {
			list-style: inside disc
		}
		
		ul.numerics {
			list-style: inside decimal
		}
		
		.ul.kas-icon-aero {}
		
		ul.kas-icon-aero li a:before {
			font-family: 'Glyphicons Halflings';
			font-size: 9px;
			content: "\e258";
			padding-right: 8px;
		}
		
		.container {
			background: #fafafa;
			width:100%;
		}
 
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3" style="max-width:160px;">
				<div class="well no-padding">
					<div>
						<ul class="nav nav-list nav-menu-list-style " data-toggle="collapse">
							<li  data-toggle="collapse">
								<label class="tree-toggle nav-header glyphicon-icon-rpad">
									<span class="glyphicon glyphicon-folder-close m5"></span>Daftar SPAJ
									<span class="menu-collapsible-icon glyphicon glyphicon-chevron-down"></span></label>
								<ul class="nav nav-list tree bullets">
									<li><a href="#" data-xhr="spaj-new">SPAJ Baru</a></li>
								</ul>
							</li>
							<li class="divider"></li>
							<li>
								<label  data-toggle="collapse" class="tree-toggle nav-header"><span class="glyphicon glyphicon-user m5"></span>&nbsp; IFG AIM</label>
								<ul class="nav nav-list tree">
									<li><a href="#" id='back'> Kembali IFG AIM</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-9" >
				<iframe id="iframe-spaj" src="<?=base_url("spajonline/blank");?>" 
				style="border-right:solid #dadada 1px;border-left:solid #dadada 1px;width:100%;
				min-width:680px;min-height:800px;height:100vh;" frameBorder="0">
				</iframe>
			</div>
		</div>
	</div>
	<script src='../asset/js/jquery.min.js'></script>
	<script src='../asset/js/bootstrap.min.js'></script>
	<!--script async src='../asset/js/iframely.js'></script-->
	<script>
		$mew = null;
		var $base_url_api = '<?=base_url("api/spajonline_v1/");?>';
		var idagen = <?=$idagen?>;
		var token = <?=$token?>;
		var android_ver = '00';

		$('.tree-toggle').click(function() {
			$(this).parent().children('ul.tree').toggle(200);
		});
		$(function() {
			$('.tree-toggle').parent().children('ul.tree').toggle(200);
		})

		//iframe-spaj-entri
		$('a').on('click', function() {
			$strauth = 'index.php?idagen=' + idagen + '&token=' + token + '&android_ver=' + android_ver;
			$mew = this;
			$me = $mew.getAttribute('data-xhr')
			if ($me != null) {
				//console.log($mew.getAttribute('data-xhr'));
				if ($me == 'spaj-entry') {
				} else if ($me == 'spaj-new') {
					$("#iframe-spaj").attr('src', $base_url_api + '/' + $strauth + '#/spaj_entry_list/////');
					console.log($base_url_api + '/' + $strauth + '#/spaj_entry_list/////');
				} else {

				}
			}
		});

		var getQueryParam = function(param) {
			location.search.substr(1)
				.split("&")
				.some(function(item) { // returns first occurence and stops
					return item.split("=")[0] == param && (param = item.split("=")[1])
				});
			return param;
		}
		
		$("#back").on('click', function() {
			window.location = "<?=base_url('account/myprofile');?>";
		});

	</script>

<style>
	html {
		height: 100vh; /* For 100% screen height */
		width:  100vw; /* For 100% screen width */
	}
	body {
		height: 100vh; /* For 100% screen height */
		width:  100vw; /* For 100% screen width */
		overflow-x: hidden;
	}
</style>
</body>

</html>