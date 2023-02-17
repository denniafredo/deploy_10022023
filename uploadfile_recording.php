
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/custom-bootbox-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>
<!-- END PAGE LEVEL STYLES -->


<!-- BEGIN RECORDING SUPPORT -->
<link href="https://unpkg.com/video.js@7.20.1/dist/video-js.min.css" rel="stylesheet">
<link href="https://unpkg.com/videojs-record/dist/css/videojs.record.min.css" rel="stylesheet">

<script src="https://unpkg.com/video.js@7.20.1/dist/video.min.js"></script>
<script src="https://unpkg.com/recordrtc/RecordRTC.js"></script>
<script src="https://unpkg.com/webrtc-adapter/out/adapter.js"></script>

  <script src="https://unpkg.com/wavesurfer.js/dist/wavesurfer.min.js"></script>
  <script src="https://unpkg.com/wavesurfer.js/dist/plugin/wavesurfer.microphone.min.js"></script>
  <script src="https://unpkg.com/videojs-wavesurfer/dist/videojs.wavesurfer.min.js"></script>

<script src="https://unpkg.com/videojs-record/dist/videojs.record.min.js"></script>

<script src="<?=base_url()?>asset/record/browser-workarounds.js"></script>

<style>
/* change player background color */
#myVideo {
  background-color: #7a9ab8;
}
/* change player background color */
#myAudio {
  background-color: #7a9ab8;
}
</style>
<!-- BEGIN RECORDING SUPPORT -->



<?php 

require 'application/config/credential.php';

$conn = oci_connect($config['db_username'], $config['db_password'], 'database.ifg-life.id/IFGAGENCY');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], 
ENT_QUOTES), E_USER_ERROR);
}


$query= "SELECT meta_files from JAIM_302_DOKUMEN where buildid='$build' and noid='$noid' and jenis_dokumen_id='4' ";
$query2= "SELECT meta_files from JAIM_302_DOKUMEN where buildid='$build' and noid='$noid' and jenis_dokumen_id='1' ";
$query3= "SELECT meta_files from JAIM_302_DOKUMEN where buildid='$build' and noid='$noid' and jenis_dokumen_id='3' ";
$query4= "SELECT meta_files from JAIM_302_DOKUMEN where buildid='$build' and noid='$noid' and jenis_dokumen_id='2' ";
/* mysql way 
 * $result= mysql_query($query) or die(mysql_error());
 * while ($rows=mysql_fetch_object($result)){
 *  echo $rows->nama 
 * }
 */
 /* ini cara oracle */
 $filename = "ftp://storage.ifg-life.id/VOLUME1/JLINDO/WELCOME/";
$parsesql = oci_parse($conn, $query); // Document Needed Assesment 4
oci_execute($parsesql);
$no=1;

$parsesql2 = oci_parse($conn, $query2); // Document Pernyataan pemahaman 1
oci_execute($parsesql2);
$no=1;

$parsesql3 = oci_parse($conn, $query3); // Document Profil Resiko 3
oci_execute($parsesql3);
$no=1;

$parsesql4 = oci_parse($conn, $query4); // Recording Pernyataan Pemahaman 2
oci_execute($parsesql4);
$no=1;
//proses menampilkan data
?>

<?php 
// while($rows=oci_fetch_object($parsesql)){
//     echo "http://10.170.64.152" . $rows->META_FILES;
// };
?>


<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Workbook</a>
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

                        <!-- UPLOAD NEDDED ASSESMENT -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Upload File Nedded Assesment</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-needassesment" class="form-horizontal" role="form" action="<?="$this->url/submit"?>" method="post">
                                    <input type="hidden" name="buildid" class="form-control" value="<?=$this->input->get('buildid')?>" readonly>
                                    <input type="hidden" name="noid" class="form-control" value="<?=$this->input->get('id')?>" readonly>
                                    <input type="hidden" name="noagen" class="form-control" value="<?=$this->session->USERNAME?>" readonly>
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
                                            <label class="col-md-3 control-label">Upload File<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div>
                                                        <input type="hidden" name="item[0][status]" class="form-control" value="4" readonly>
                                                        <input type="file" name="item[0][upload]" id="neededassesmentfile" accept="image/*, .pdf">
                                                        <label style="font-size:12px;color:red;">* Max 10Mb</label></br>
                                                        <button type="submit" name="submit" class="btn green">Upload</button>
                                                
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <label class="col-md-3 control-label">Files Uploaded<span class="required">*</span>
                                         : 
                                        
                                        </label>  
                                        <span >
                                        

										<?php 
                                            while($rows=oci_fetch_object($parsesql))
                                            {
                                        ?>
										<?php if(@$rows): ?>
											<a target="_blank" href="<?= $filename.$rows->META_FILES ?>" >File Needed Assesment</a>
                                        <?php endif; ?>
										<?php } ?>
                                        </span>   
                                           
                                            
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                        <!-- END NEDDED ASSESMENT -->

                        <!-- upload pernyataan pemahaman-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Upload File Pernyataan Pemahaman</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-pemahaman" class="form-horizontal" role="form" action="<?="$this->url/submit"?>" method="post">
                                <input type="hidden" name="buildid" class="form-control" value="<?=$this->input->get('buildid')?>" readonly>
                                    <input type="hidden" name="noid" class="form-control" value="<?=$this->input->get('id')?>" readonly>
                                    <input type="hidden" name="noagen" class="form-control" value="<?=$this->session->USERNAME?>" readonly>
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
                                            <label class="col-md-3 control-label">Upload File<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div>
                                                        <input type="hidden" name="item[0][status]" class="form-control" value="1" readonly>
                                                        <input type="file" name="item[0][upload]" accept="image/*, document/*, image/jpeg, image/jpg, .pdf,video/*, audio/*, .m4a, image/gif">
                                                        <label style="font-size:12px;color:red;">* Max 10Mb</label></br>
                                                        <button type="submit" name="save1" class="btn green">Upload</button>
                                                    </div>

                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        <label class="col-md-3 control-label">Files Uploaded<span class="required">*</span>
                                         : 
                                        
                                        </label>  
                                        <span >
                                             
                                        <?php 
                                            while($rows=oci_fetch_object($parsesql2))
                                            {
                                        ?>
										<?php if(@$rows): ?>
											<a target="_blank" href="<?= $filename.$rows->META_FILES ?>" >File Pernyataan Pemahaman</a>
                                        <?php endif; ?>
										<?php } ?>   
                                        </span>   
                                        
                                       
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                        <!-- end pernyataan pemahaman -->

                        <!-- upload file resiko -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Upload File Profile Resiko</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-profileresiko" class="form-horizontal" role="form" action="<?="$this->url/submit"?>" method="post">
                                    <input type="hidden" name="buildid" class="form-control" value="<?=$this->input->get('buildid')?>" readonly>
                                    <input type="hidden" name="noid" class="form-control" value="<?=$this->input->get('id')?>" readonly>
                                    <input type="hidden" name="noagen" class="form-control" value="<?=$this->session->USERNAME?>" readonly>
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
                                            <label class="col-md-3 control-label">Uploaded File<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div>
                                                    <input type="hidden" name="item[0][status]" class="form-control" value="3" readonly>
                                                    <input type="file" name="item[0][upload]" accept="image/*, image/jpeg, image/jpg, .pdf,video/*, audio/*, .m4a, image/gif">
                                                    <label style="font-size:12px;color:red;">* Max 10Mb</label></br>
                                                    <button type="submit" name="submit" class="btn green">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        <label class="col-md-3 control-label">Files Uploaded<span class="required">*</span>
                                         : 
                                        
                                        </label>  
                                        <span >
                                             
                                        <?php 
                                            while($rows=oci_fetch_object($parsesql3))
                                            {
                                        ?>
										<?php if(@$rows): ?>
											<a target="_blank" href="<?= $filename.$rows->META_FILES ?>" >File Profil Resiko</a>
                                        <?php endif; ?>
										<?php } ?>
                                           
                                        </span>   
                                        

                                       
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                        <!-- end file resiko -->

                        <!-- upload recording pernyataan -->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-cogs font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Upload File Recording Pernyataan</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    <a href="javascript:;" onclick="window.location.reload();" class="reload"></a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-recording" class="form-horizontal" role="form" action="<?="$this->url/submit"?>" method="post">
                                <input type="hidden" name="buildid" class="form-control" value="<?=$this->input->get('buildid')?>" readonly>
                                    <input type="hidden" name="noid" class="form-control" value="<?=$this->input->get('id')?>" readonly>
                                    <input type="hidden" name="noagen" class="form-control" value="<?=$this->session->USERNAME?>" readonly>
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>
                                        <div class="alert alert-success display-hide">
                                            <button class="close" data-close="alert"></button>
                                            Your form validation is successful!
                                        </div>
										
										
										<ul class="nav nav-tabs">
										  <li class="active"><a data-toggle="tab" href="#tab_record0">Rekam Audio</a></li>
										  <li class=""><a data-toggle="tab" href="#tab_record1">Rekam Video</a></li>
										  <li><a data-toggle="tab" href="#tab_record2">Upload File Rekaman</a></li>
										</ul>
										
										<div class="tab-content">


										
										<div id="tab_record0" class="tab_record1 tab-pane fade in active">
										<!-- RECORDING SUPPORT -->

											<audio id="myAudio" class="video-js vjs-default-skin"></audio>
										</div>

										
										<div id="tab_record1" class="tab_record1 tab-pane fade out">
										<!-- RECORDING SUPPORT -->

										<video id="myVideo" playsinline class="video-js vjs-default-skin">
										  <p class="vjs-no-js">
											To view this video please enable JavaScript, or consider upgrading to a
											web browser that
											<a href="https://videojs.com/html5-video-support/" target="_blank">
											  supports HTML5 video.
											</a>
										  </p>
										</video>
										</div>
										
										<div id="tab_record2" class="tab_record2 tab-pane fade out" class="" style="min-height:320px;">
                                        <div class="form-group">
										
                                            <label class="col-md-3 control-label">Upload File<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div>
                                                    <input type="hidden" name="item[0][status]" class="form-control" value="2" readonly>
													<input type="file" id="file-record" name="item[0][upload]" accept="video/*, audio/*">
                                                    <!--input type="file" id="audio-record" name="item[1][upload]" accept="" class="">
													<input type="file" id="video-record" name="item[2][upload]" accept="" class="">
                                                    
                                                    
                                                    < <label style="font-size:12px;color:red;">* Max 1mb</label></br> -->
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        <label class="col-md-3 control-label">Files Uploaded<span class="required">*</span>
                                         : 
                                        
                                        </label>  
                                        <span >
                                        
										<?php 
                                            while($rows=oci_fetch_object($parsesql4))
                                            {
                                        ?>
										<?php if(@$rows): ?>
											<a target="_blank" href="<?= $filename.$rows->META_FILES ?>" >File Recording Pernyataan</a>
                                        <?php endif; ?>
										<?php } ?>
                                        </span>
										</div>
										
										
										</div>
									<button type="submit" name="submit" class="btn green">Upload Rekaman</button>
									
									
									
									
									
									
									
									
									
									
									</div>
                                    
                                </form>
                                
                            </div>
                        </div>
                        <!-- end recording pernyataan -->
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dtBox"></div>





<!-- BEGIN PAGE LEVEL PLUGINS -->



<script>
var optionsVideo = {
    controls: true,
    bigPlayButton: true,
    width: 640,
    height: 480,
    plugins: {
        record: {
            audio: true,
            video: true,
            maxLength: 1200,
            displayMilliseconds: false,
			videoBitRate: 240,
			videoFrameRate: 15,
			audioSampleRate: 32000,
			audioBitRate:32,
			audioChannels:1,
            debug: true
        }
    }
};


// apply some workarounds for certain browsers
applyVideoWorkaround();

var playerVideos = videojs('myVideo', optionsVideo, function() {
    // print version information at startup
    var msg = 'Using video.js ' + videojs.VERSION +
        ' with videojs-record ' + videojs.getPluginVersion('record') +
        ' and recordrtc ' + RecordRTC.version;
    videojs.log(msg);
});

// error handling
playerVideos.on('deviceError', function() {
    console.log('device error:', playerVideos.deviceErrorCode);
});

playerVideos.on('error', function(element, error) {
    console.error(error);
});

// user clicked the record button and started recording
playerVideos.on('startRecord', function() {
    console.log('started recording!');
});

var tmpVideoRecord = null;

playerVideos.on('finishRecord', function() {
    // the blob object contains the recorded data that
    // can be downloaded by the user, stored on server etc.
    console.log('finished recording:', playerVideos.recordedData);

    var data = playerVideos.recordedData;
	tmpVideoRecord = data;

});




var optionsAudio = {
    controls: true,
    bigPlayButton: true,
    width: 640,
    height: 480,
    plugins: {
        wavesurfer: {
            backend: 'WebAudio',
            waveColor: '#36393b',
            progressColor: 'black',
            displayMilliseconds: true,
            debug: true,
            cursorWidth: 1,
            hideScrollbar: true,
            plugins: [
                // enable microphone plugin
                WaveSurfer.microphone.create({
                    bufferSize: 4096,
                    numberOfInputChannels: 1,
                    numberOfOutputChannels: 1,
                    constraints: {
                        video: false,
                        audio: true
                    }
                })
            ]
        },
        record: {
            audio: true,
            video: false,
            maxLength: 1200,
            displayMilliseconds: true,
            debug: true
        }
    }
};

// apply some workarounds for certain browsers
applyAudioWorkaround();
var tmpAudioRecord = null;
// create player
var playerAudio = videojs('myAudio', optionsAudio, function() {
    // print version information at startup
    var msg = 'Using video.js ' + videojs.VERSION +
        ' with videojs-record ' + videojs.getPluginVersion('record') +
        ', videojs-wavesurfer ' + videojs.getPluginVersion('wavesurfer') +
        ', wavesurfer.js ' + WaveSurfer.VERSION + ' and recordrtc ' +
        RecordRTC.version;
    videojs.log(msg);
});

// error handling
playerAudio.on('deviceError', function() {
playerAudioconsole.log('device error:', playerAudio.deviceErrorCode);
});

playerAudio.on('error', function(element, error) {
    console.error(error);
});

// user clicked the record button and started recording
playerAudio.on('startRecord', function() {
    console.log('started recording!');
});

// user completed recording and stream is available
playerAudio.on('finishRecord', function() {
    // the blob object contains the recorded data that
    // can be downloaded by the user, stored on server etc.

    var data = playerAudio.recordedData;
	tmpAudioRecord = data;
	
    console.log('finished recording: ', playerAudio.recordedData);
});




</script>
<!-- RECORDING SUPPORT -->



<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/loadingoverlay.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/moment.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?=base_url()?>asset/js/components-pickers.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/js/jquery.formatter.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<script type="text/javascript">

			
			$(function(){
				
				$('#form-needassesment').on('submit', async function(e){
					e.preventDefault();
					
					var form = $('#form-needassesment')[0]; 
					
                    //var form = ""
					
					let response = await fetch('<?= site_url(); ?>api/jsspaj/master/dokumen-penawaran', {
						method: 'POST',
						//mode: 'cors',
						//headers:{
						//	"token-access": `csoogckw044s8sww0wkk0cgskk4ww0wogooscssk`,
						//},
						body: new FormData(form)
					})
					.then((response) => response.json())
					.then((data) => {
						data = data[0]
						if(data.status){
							if(data.result == 1){
								alert(data.massage)
								setTimeout(function(){
									window.location.reload();
								}, 500);
								
							}else{
								alert(data.massage)
								setTimeout(function(){
									window.close();
								}, 1000);
							}
						}else{
							alert(data.massage)
							setTimeout(function(){
								window.location.reload();
							}, 500);
						}
						
						setTimeout(function(){
							$("#overlay").fadeOut(300);
						}, 200);
					});
					
					
				});
			});

            $(function(){
				
				$('#form-pemahaman').on('submit', async function(e){
					e.preventDefault();
					
					var form = $('#form-pemahaman')[0]; 
					
                    //var form = ""
					
					let response = await fetch('<?= site_url(); ?>api/jsspaj/master/dokumen-penawaran', {
						method: 'POST',
						//mode: 'cors',
						//headers:{
						//	"token-access": `csoogckw044s8sww0wkk0cgskk4ww0wogooscssk`,
						//},
						body: new FormData(form)
					})
					.then((response) => response.json())
					.then((data) => {
						data = data[0]
						if(data.status){
							if(data.result == 1){
								alert(data.massage)
								setTimeout(function(){
									window.location.reload();
								}, 500);
								
							}else{
								alert(data.massage)
								setTimeout(function(){
									window.close();
								}, 1000);
							}
						}else{
							alert(data.massage)
							setTimeout(function(){
								window.location.reload();
							}, 500);
						}
						
						setTimeout(function(){
							$("#overlay").fadeOut(300);
						}, 200);
					});
					
					
				});
			});


            $(function(){
				
				$('#form-profileresiko').on('submit', async function(e){
					e.preventDefault();
					
					var form = $('#form-profileresiko')[0]; 
					
                    //var form = ""
					
					let response = await fetch('<?= site_url(); ?>api/jsspaj/master/dokumen-penawaran', {
						method: 'POST',
						//mode: 'cors',
						//headers:{
						//	"token-access": `csoogckw044s8sww0wkk0cgskk4ww0wogooscssk`,
						//},
						body: new FormData(form)
					})
					.then((response) => response.json())
					.then((data) => {
						data = data[0]
						if(data.status){
							if(data.result == 1){
								alert(data.massage)
								setTimeout(function(){
									window.location.reload();
								}, 500);
								
							}else{
								alert(data.massage)
								setTimeout(function(){
									window.close();
								}, 1000);
							}
						}else{
							alert(data.massage)
							setTimeout(function(){
								window.location.reload();
							}, 500);
						}
						
						setTimeout(function(){
							$("#overlay").fadeOut(300);
						}, 200);
					});
					
					
				});
			});


            $(function(){
				
				$('#form-recording').on('submit', async function(e){
					e.preventDefault();
					
				
					
					let container = new DataTransfer();
					

					if(tmpAudioRecord != null){
						var audioFile = new File([tmpAudioRecord],'record-audio-0.webm',{type:"audio/webm", lastModified:new Date().getTime()} );
						let inputElement = document.getElementById('file-record');

						  container.items.add(audioFile);
						  inputElement.files = container.files;
						  console.log(inputElement.files);
						
					}
					
					if(tmpVideoRecord != null){
						var videoFile = new File([tmpVideoRecord],'record-video-0.webm',{type:"video/webm", lastModified:new Date().getTime()});
						let inputElement = document.getElementById('file-record');

						  container.items.add(videoFile);
						  inputElement.files = container.files;
						  console.log(inputElement.files);
					}
					
					

					var form = $('#form-recording')[0]; 
					
					
					var formData = new FormData(form);
					
					
					let response = await fetch('<?= site_url(); ?>api/jsspaj/master/dokumen-penawaran', {
						method: 'POST',
						//mode: 'cors',
						//headers:{
						//	"token-access": `csoogckw044s8sww0wkk0cgskk4ww0wogooscssk`,
						//},
						body: formData
					})
					.then((response) => response.json())
					.then((data) => {
						
						data = data[0]
						if(data.status){
							if(data.result == 1){
								alert(data.massage)
								setTimeout(function(){
									window.location.reload();
								}, 500);
								
							}else{
								alert(data.massage)
								setTimeout(function(){
									window.close();
								}, 1000);
							}
						}else{
							alert(data.massage)
							setTimeout(function(){
								window.location.reload();
							}, 500);
						}
						
						setTimeout(function(){
							$("#overlay").fadeOut(300);
						}, 200);
					});
					
					
				});
			});
			
		</script>


<!-- <script>
	        submitHandler: function (form) {
                //success.show();
                error.hide();
                form.submit(); // submit the form
            }
</script>
--> 
<!-- END JAVASCRIPTS -->