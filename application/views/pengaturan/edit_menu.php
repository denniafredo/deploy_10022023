<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Pengaturan</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?="$this->url/menu"?>">Menu</a>
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
                        <i class="fa icon-grid font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Tambah Menu</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light">

                            <form id="form-menu" class="form-horizontal" role="form" action="<?="$this->url/save-menu"?>" method="post">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kode Menu</label>
                                        <div class="col-md-9">
                                            <input type="text" name="kdmenu" class="form-control" value="<?=$menu['KDMENU']?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kategori <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <select name="kdkategori" class="form-control">
                                                <option value="">Silahkan Pilih</option>
                                                <?php foreach($kategori as $i => $v) {
                                                    if ($menu['KDKATEGORI'] == $v['KDKATEGORI'])
                                                        echo "<option value='$v[KDKATEGORI]' selected>$v[NAMAKATEGORI]</option>";
                                                    else
                                                        echo "<option value='$v[KDKATEGORI]'>$v[NAMAKATEGORI]</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Grup Menu</label>
                                        <div class="col-md-9">
                                            <select name="idparent" class="form-control">
                                                <option value="">Parent Menu</option>
                                                <?php foreach($parent as $i => $v) {
                                                    if ($menu['IDPARENT'] == $v['KDMENU'])
                                                        echo "<option value='$v[KDMENU]' selected>$v[MENU] - $v[KDMENU] - $v[KETERANGAN]</option>";
                                                    else
                                                        echo "<option value='$v[KDMENU]'>$v[MENU] - $v[KDMENU] - $v[KETERANGAN]</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama Menu <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="menu" class="form-control" value="<?=$menu['MENU']?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">URL</label>
                                        <div class="col-md-9">
                                            <input type="text" name="url" class="form-control" value="<?=$menu['URL']?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Icon</label>
                                        <div class="col-md-9">
                                            <input type="text" name="icon" class="form-control" value="<?=$menu['ICON']?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Keterangan</label>
                                        <div class="col-md-9">
                                            <input type="text" name="keterangan" class="form-control" value="<?=$menu['KETERANGAN']?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label><input type="radio" name="kdstatus" <?=($menu['KDSTATUS'] == 1 ? 'checked' : null)?> class="icheck" value="1"> Aktif </label>
                                                <label><input type="radio" name="kdstatus" <?=($menu['KDSTATUS'] == 0 ? 'checked' : null)?> class="icheck" value="0"> Non Aktif </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">Simpan</button>
                                            <a href="<?="$this->url/menu"?>" class="btn default">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

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
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/form-validation.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        // ajax kategori menu for menu
        $("select[name='kdkategori']").change(function() {
            $.ajax({
                url: "<?="$this->url/ajax-kategori-menu"?>",
                type: "post",
                data: "id="+this.value,
                success: function (data) {
                    $("select[name='idparent']").empty();
                    $("select[name='idparent']").append('<option value="">Parent Menu</option>');
                    for (var i=0; i<data.length; i++) {
                        $("select[name='idparent']").append('<option value="' + data[i].KDMENU + '">' + data[i].MENU + ' - ' + data[i].KDMENU + ' - ' + (data[i].KETERANGAN === null ? '' : data[i].KETERANGAN) + '</option>');
                    }
                },
                dataType: "json",
            })
        });

        // form validation submit
        var error = $(".alert-danger", $("#form-menu"));
        var success = $(".alert-success", $("#form-menu"));
        $("#form-menu").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                kdkategori: {
                    required: true
                },
                menu: {
                    required: true
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

            success: function (label, element) { // if success

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