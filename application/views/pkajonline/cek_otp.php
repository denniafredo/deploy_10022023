<!--BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

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
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa icon-doc font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Verifikasi Kode OTP</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-body">
                                <form id="form_cekotp" name="form_cekotp" class="form-horizontal" role="form" method="post">                                  
                                    <input type="hidden" value="<?=$otp->MESSAGE;?>" id="message" name="message">
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
                                            <label class="col-md-3 control-label">Masukkan Kode OTP Anda</label>
                                            <div class="col-md-4">
                                                <input type="text" id="sms_otp" name="sms_otp" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions"> 
                                        <div class="row">     
                                            <div class="col-md-offset-3 col-md-9">
                                                    <button id="cekotp" name="cekotp" type="button" onclick="cekotp_epkaj(event);" class="btn btn-primary waves-effect waves-light  pull-right">
                                                        Submit
                                                    </button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php foreach($pkaj as $i => $v) { ?>

                                        <input type="hidden" value="<?=$v["NOAGEN"];?>" id="noagen" name="noagen">
                                        <input type="hidden" value="<?=$v["NOPKAJAGEN"];?>" id="nopkaj" name="nopkaj">
                                        <input type="hidden" value="<?=$v["TGLPKAJAGEN"];?>" id="tglpkaj" name="tglpkaj">
                                        <input type="hidden" value="<?=$v["KDKANTOR"];?>" id="kdkantor" name="kdkantor">
                                        <input type="hidden" value="<?=$v["NOTELPONAGEN"];?>" id="notlp" name="notlp">
                                    <?php } ?>    
                                </form>                                    
                                </div>
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                        <div style="height: 200px;">
                    </div>

                    <div class="text-center">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->


<!-- JAVASCRIPTS FOR CEK OTP CODE -->
<script>
    function cekotp_epkaj(event){
        event.preventDefault();

        if($("#message").val() == $("#sms_otp").val()){
        var noagen = $("#noagen").val();
        var nopkaj = $("#nopkaj").val();
        var tglpkaj = $("#tglpkaj").val();
        var sms_otp = $("#sms_otp").val();

        var contentForm = {};
        $("#form_cekotp").serializeArray().map(
            function(x){contentForm[x.name] = x.value;});
            console.log(contentForm);

        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>" +"index.php/Pkajonline/insert_pkajonline",
            cache: false,
            data: contentForm,
            success: function(msg){

                console.log(msg);

                window.location.href = "<?= base_url(); ?>" +"Pkajonline/cetak_pkajonline?noagen=" + noagen +"&nopkaj=" + nopkaj +"&tglpkaj=" + tglpkaj +"&message=" + message;

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error');
                // console.log('error ' + errorThrown);
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
        }else{

        alert('Kode OTP yang anda masukkan tidak sesuai!');

        }
    }
</script>
<!-- END JAVASCRIPTS -->


<!-- Time button after clicked -->
<script>
    var fewSeconds = 30;
    $('#cekotp').click(function(){
        // Ajax request
        var btn = $(this);
        btn.prop('disabled', true);
        setTimeout(function(){
            btn.prop('disabled', false);
        }, fewSeconds*1000);
    });
</script>
<!-- End time button after clicked -->