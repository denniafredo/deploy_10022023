<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<!-- END PAGE LEVEL STYLES -->

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
                                <form id="form-prospek" class="form-horizontal" role="form" action="<?="$this->url/save-pribadi"?>" method="post">
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
                                                    <input type="text" id="tgllahirnasabah" name="txtTglLahir" class="form-control form-control-inline input-medium date-picker" data-date-format="dd/mm/yyyy" value="<?=$prospek['TGLLAHIR']?>" placeholder="31/12/2015" readonly />
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
                                        <!--Tambahan untuk input pekerjaan oleh Teguh 17/09/2019-->
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Jenis Pekerjaan <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdPekerjaan" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php foreach($jenispekerjaan as $i => $v) {
                                                            if ($v['KDJENISPEKERJAAN'] == $prospek['KDJENISPEKERJAAN'])
                                                                echo "<option value='$v[KDJENISPEKERJAAN]' selected>$v[NAMAPEKERJAAN]</option>";
                                                            else
                                                                echo "<option value='$v[KDJENISPEKERJAAN]'>$v[NAMAPEKERJAAN]</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="control-label col-md-3">Hobi <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="kdHobi" id="kdHobi" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php foreach($hobi as $i => $v) {
															$selected = $v['KDHOBI'] == $prospek['KDHOBI'] ? 'selected' : '';
                                                            echo "<option value='$v[KDHOBI]' $selected>$v[NAMAHOBI]</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">HP / No Telp <span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" id="idPhone2" name="txtPhone2" class="form-control" value="<?=$prospek['HP']?>" placeholder="08123456789">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" id="idPhone1" name="txtPhone1" class="form-control" value="<?=$prospek['TELP']?>" placeholder="0211500151">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">No KTP <span class="required">*</span></label>
                                            <div class="col-md-4">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="number" name="noKTP" class="form-control" value="<?=$prospek['NO_KTP']?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                *No KTP unik
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
                                                <a href="<?="$this->url/pribadi"?>" class="btn default">Kembali</a>
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
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?=base_url()?>asset/js/components-pickers.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/js/jquery.formatter.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    $('#tgllahirnasabah').on('change', function() {
        var birthdaycpp = +new Date(document.getElementById("tgllahirnasabah").value);
        var now = Date.now("MM-dd-yyyy");
        var sls =((now - birthdaycpp) / 31557600000);
        var usiacalonpemegangpolis = Math.floor(sls);
        if(usiacalonpemegangpolis < 17){
            alert("Minimal usia nasabah adalah 17 tahun");
            document.getElementById("tgllahirnasabah").value = "";
            exit();
        }
    });


    $("#idPhone2, #idPhone1").formatter({'pattern': '{{999999999999}}' });

    jQuery(document).ready(function() {
        //ComponentsPickers.init();

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
				kdPekerjaan : {
                    required: true
                },
				kdHobi : {
					required: true
				},
                txtPhone1 : {
                    required: true,
                    number: true
                },
                noKTP : {
                    required: true,
                    number: true,
                    minlength: 16,
                    maxlength: 16
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

            success: function (label, element) {
                var icon = $(element).parent('.input-icon').children('i');
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                icon.removeClass("fa-warning").addClass("fa-check");
            },

            submitHandler: function (form) {
                success.show();
                error.hide();
                form[0].submit(); // submit the form
            }
        });
        // end of form validation submit
    });
</script>
<!-- END JAVASCRIPTS -->