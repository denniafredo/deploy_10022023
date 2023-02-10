<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/css/news.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/pricing-table.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/portfolio.css" rel="stylesheet" type="text/css"/>

    <style>
		/* Always set the map height explicitly to define the size of the div
		* element that contains the map. */
		
		#map {
			height: 100%;
		}
		/* Optional: Makes the sample page fill the window. */
		html, body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		img.mark{
			border-radius:16px;
			border:1px solid #000 !important;
		}
    </style>
<!-- END PAGE LEVEL STYLES -->

<style type="text/css">
    .table-formasi, .table-formasi thead tr th, .table-formasi tbody tr td {
        font-size: 12px;
    }
    .table-formasi thead tr th, .table-formasi tbody tr td {
        line-height: 6px;
    }
</style>

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
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
                    <div class="row">
                        <div class="col-md-12 news-page">
                            <!-- BEGIN ROW -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Penggunaan</span>
                                                <span class="caption-helper">aplikasi jaim tahun <?=date('Y')?></span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse">
                                                </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config">
                                                </a>
                                                <a href="javascript:;" class="reload">
                                                </a>
                                                <a href="javascript:;" class="fullscreen">
                                                </a>
                                                <a href="javascript:;" class="remove">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="piechartlogin" class="chart" style="height: 400px;">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>

                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-users font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Formasi</span>
                                                <span class="caption-helper">agen jiwasraya</span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse">
                                                </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config">
                                                </a>
                                                <a href="javascript:;" class="reload">
                                                </a>
                                                <a href="javascript:;" class="fullscreen">
                                                </a>
                                                <a href="javascript:;" class="remove">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-bordered table-hover table-formasi">
                                                    <thead>
                                                    <tr>
                                                        <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                                        <th style="text-align:center; vertical-align:middle;">UKA</th>
                                                        <th style="text-align:center; vertical-align:middle;">AM</th>
                                                        <th style="text-align:center; vertical-align:middle;">UM</th>
                                                        <th style="text-align:center; vertical-align:middle;">MA</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $tuka = 0;
                                                    $tam = 0;
                                                    $tum = 0;
                                                    $tma = 0;
                                                    foreach($formasi as $i => $v) {
                                                        $tuka += $v['UKA'];
                                                        $tam += $v['AM'];
                                                        $tum += $v['UM'];
                                                        $tma += $v['MA'];
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['KDKANTOR']?></td>
                                                            <td align="center"><?=$v['UKA']?></td>
                                                            <td align="center"><?=$v['AM']?></td>
                                                            <td align="center"><?=$v['UM']?></td>
                                                            <td align="center"><?=$v['MA']?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                    <thead>
                                                    <tr>
                                                        <th style="text-align:center; vertical-align:middle;">Total</th>
                                                        <th style="text-align:center; vertical-align:middle;"><?=$tuka?></th>
                                                        <th style="text-align:center; vertical-align:middle;"><?=$tam?></th>
                                                        <th style="text-align:center; vertical-align:middle;"><?=$tum?></th>
                                                        <th style="text-align:center; vertical-align:middle;"><?=$tma?></th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>
                            <!-- END ROW -->
							
							<div class="row">
							
								 <div class="col-md-12">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-users font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Lokasi</span>
                                                <span class="caption-helper">agen jiwasraya</span>
                                            </div>
											 <div class="tools">
                                                <a href="javascript:;" class="collapse">
                                                </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config">
                                                </a>
                                                <a href="javascript:;" class="reload">
                                                </a>
                                                <a href="javascript:;" class="fullscreen">
                                                </a>
                                                <a href="javascript:;" class="remove">
                                                </a>
                                            </div>
                                        </div>
										<div class="portlet-body">
										<div class="col-md-3">
											<div class="caption">
                                                <i class="fa fa-users font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Nomor</span>
                                                <span class="caption-helper">agen jiwasraya</span>
                                            </div>
											
											
											 <div class="table-scrollable" style="max-height:400px;overflow:auto;">
                                                <table class="table table-bordered table-hover table-formasi">
                                                    <thead>
                                                    <tr>
                                                        <th style="text-align:center; vertical-align:middle;">KTR</th>
                                                        <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach($list_agen as $i => $v) {
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?=$v['KDKANTOR']?></td>
                                                            <td align="left">
															<?php 
															$cts = null;
																if($v['LAT']!=''){
																	$cts = '<img src="../asset/img/asterix-small.png" width="10px"/>';
																}
															?>
																<span class="noagen" style="line-height: 1.3em;color:navy;cursor: help;" data="<?=base64_encode($v['KDKANTOR'].'-'.$v['NOAGEN'].'-'.$v['MOBILETOKEN'])?>">
																	<?=$v['NOAGEN']." ".$v['NAMAKLIEN1']." ".$cts?>
																</span>
															</td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
											
										</div>
										<div class="col-md-9">
											<div class="caption">
                                                <i class="fa fa-users font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Historis Lokasi</span>
                                                <span class="caption-helper">agen jiwasraya</span>
												<br />
												<div>
													Tanggal : <input type="date" id="datestart" value="<?=date('Y-m-d', strtotime("-2 month"))?>"></input> - <input type="date" id="dateend" value="<?= date('Y-m-d')?>"></input>
												</div>
                                            </div>
											<div id="map" style="min-height:400px;min-width:200px;"></div>

										</div>
										
										</div>
                                    </div>
										
							</div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/amcharts/amcharts.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/amcharts/gauge.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/amcharts/themes/light.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCc1ufSEO9Y0tufuYLD19B3oQr2ihVa8Xo">
</script>
<script type="text/javascript">
var google_api_key = "AIzaSyCc1ufSEO9Y0tufuYLD19B3oQr2ihVa8Xo";

function getQueryParam(param) {
	location.search.substr(1)
	.split("&")
	.some(function(item) { // returns first occurence and stops
		return item.split("=")[0] == param && (param = item.split("=")[1])
	})
	return param
}

    var login = <?=round($r['JMLLOGIN']/$r['JMLAGEN']*100, 2)?>;
    var dl = <?=round(($r['JMLDLAPP'])/$r['JMLLOGIN']*100, 2)?>;
    var prop = <?=round($r['JMLPROP']/$r['JMLLOGIN']*100, 2)?>;

	$globalGpsData = null;
	idagen = '0000001416';getQueryParam('idagen');
	token = '855f1ef1';getQueryParam('token');
	android_version = 'WEB';getQueryParam('android_ver');
	device = 'JAIM-DIRECT'
	app_version = '1.0.1';
	limit='150';getQueryParam('limit');
	
    var gaugeChart = AmCharts.makeChart("piechartlogin", {
        "type": "gauge",
        "theme": "light",
        "axes": [{
            "axisAlpha": 0,
            "tickAlpha": 0,
            "labelsEnabled": false,
            "startValue": 0,
            "endValue": 100,
            "startAngle": 0,
            "endAngle": 270,
            "bands": [{
                "color": "#eee",
                "startValue": 0,
                "endValue": 100,
                "radius": "100%",
                "innerRadius": "85%"
            }, {
                "color": "#84b761",
                "startValue": 0,
                "endValue": login,
                "radius": "100%",
                "innerRadius": "85%",
                "balloonText": "<?=$r['JMLLOGIN']?> ("+login+"%)"
            }, {
                "color": "#eee",
                "startValue": 0,
                "endValue": 100,
                "radius": "80%",
                "innerRadius": "65%"
            }, {
                "color": "#67b7dc",
                "startValue": 0,
                "endValue": dl,
                "radius": "80%",
                "innerRadius": "65%",
                "balloonText": "<?=$r['JMLDLAPP']?> ("+dl+"%)"
            }, {
                "color": "#eee",
                "startValue": 0,
                "endValue": 100,
                "radius": "60%",
                "innerRadius": "45%"
            }, {
                "color": "#cc4748",
                "startValue": 0,
                "endValue": prop,
                "radius": "60%",
                "innerRadius": "45%",
                "balloonText": "<?=$r['JMLPROP']?> ("+prop+"%)"
            }]
        }],
        "allLabels": [{
            "text": "Login Jaim",
            "x": "49%",
            "y": "5%",
            "size": 15,
            "bold": true,
            "color": "#84b761",
            "align": "right"
        }, {
            "text": "Unduh Pro Sales",
            "x": "49%",
            "y": "15%",
            "size": 15,
            "bold": true,
            "color": "#67b7dc",
            "align": "right"
        }, {
            "text": "Akses POS",
            "x": "49%",
            "y": "24%",
            "size": 15,
            "bold": true,
            "color": "#cc4748",
            "align": "right"
        }],
        "export": {
            "enabled": true
        }
    });
	
	asa = null;
	function initMap(idagen) {
		if($globalGpsData.data_gps == null){
			$('#map').html("<br /><br />Belum ada data GPS untuk nomor agen "+idagen+".");
			return false;
		}else{
			try{
				$dtprofile = null;
				
				$.ajax({
					  url: "https://jaim.jiwasraya.co.id/dashboard/get_profile_agen/"+idagen,
					  context: document.body,
					  async:false
					}).done(function(data) {
					  $dtprofile = JSON.parse(data);
					  asa = $dtprofile;

					});
				
			var map = new google.maps.Map(document.getElementById('map'), {
			  zoom: 16,
			  center: $globalGpsData.gps_end_point,
			  mapTypeId: 'terrain'
			});
			var image = {
			  url: "../asset/avatar/"+$dtprofile.AVATAR,
			  size: new google.maps.Size(82, 120),
			  shape:{coords:[17,17,18],type:'circle'},
			  optimized:false,
			  origin: new google.maps.Point(0, 0),
			  anchor: new google.maps.Point(17, 34),
			  scaledSize: new google.maps.Size(32, 42)
			};
			
			var marker = new google.maps.Marker({
			  position: $globalGpsData.gps_end_point,
			  icon:image,
			  map: map,
			  title: 'Posisi terbaru agen '+idagen
			});

			var flightPlanCoordinates = $globalGpsData.data_gps;

			var flightPath = new google.maps.Polyline({
			  path: flightPlanCoordinates,
			  geodesic: true,
			  strokeColor: '#FF0000',
			  strokeOpacity: .8,
			  strokeWeight: 2
			});

			flightPath.setMap(map);
		
		
		}catch(e){
			//alert('Data GPS tidak ditemukan. Pastikan GPS dan koneksi internet aktif.')
			console.log(e);
			$('#map').html("Silahkan KLIK nomor agen.");
		}
		}

      }
	  
	function init() {
		$.ajax({
		  url: "https://jaim.jiwasraya.co.id/mobileapi/jsprosales_get_gps_data.php?idagen="+idagen
			+"&token="+token
			+"&android_ver="+android_version
			+"&device="+device
			+"&app_version="+app_version
			+"&limit="+limit
			+"&act=view",
		  context: document.body,
		  async:false
		}).done(function(data) {
		  $globalGpsData = data
		});

		//console.log($globalGpsData );
		initMap(idagen);
	}
	
	$('.noagen').on('click',function(){
		t = $(this).attr('data');
		t = window.atob(t);
		var arr = t.split('-');
		//console.log(arr);

		idagen = arr[1];
		token = arr[2];
		
		date_range = $("#datestart").val()+'|'+$("#dateend").val();
		date_range = window.btoa(date_range);
		
 		$.ajax({
		  url: "https://jaim.jiwasraya.co.id/mobileapi/jsprosales_get_gps_data.php?idagen="+idagen
			+"&token="+token
			+"&android_ver="+android_version
			+"&device="+device
			+"&app_version="+app_version
			+"&limit="+limit
			+"&act=view"
			+"&date_range="+date_range,
		  context: document.body,
		  async:false
		}).done(function(data) {
		  $globalGpsData = data
		}) 

		initMap(idagen);
		
	})//14029691.81
	
	init();
</script>