
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/custom-bootbox-modal.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>
<!-- END PAGE LEVEL STYLES -->

<?php 
require 'application/config/credential.php';

$conn = oci_connect($config['db_username'], $config['db_password'], 'database.ifg-life.id/IFGAGENCY');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], 
ENT_QUOTES), E_USER_ERROR);
}


$filename = "ftp://storage.ifg-life.id/VOLUME1/JLINDO/WELCOME/";

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
                                    <span class="caption-subject font-green-sharp bold uppercase">Upload File Needed Assesment</span>
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
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Upload File<span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <div>
                                                    <input type="hidden" name="item[0][status]" class="form-control" value="2" readonly>
                                                    <input type="file" name="item[0][upload]" accept="video/*, audio/*">
                                                    <!-- <label style="font-size:12px;color:red;">* Max 1mb</label></br> -->
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
                                            while($rows=oci_fetch_object($parsesql4))
                                            {
                                        ?>
										<?php if(@$rows): ?>
											<a target="_blank" href="<?= $filename.$rows->META_FILES ?>" >File Recording Pernyataan</a>
                                        <?php endif; ?>
										<?php } ?>
                                        </span>
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
					
					var form = $('#form-recording')[0]; 
					
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