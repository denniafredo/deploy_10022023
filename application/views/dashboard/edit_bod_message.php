<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-summernote/summernote.css">
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?="$this->url/admin-bod-message"?>">Pesan BOD</a>
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
                        <span class="caption-subject font-green-sharp bold uppercase">Tambah Pesan BOD</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light">

                            <form class="form-horizontal" action="<?="$this->url/save-bod-message"?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="idbodmsg" value="<?=$bodmsg['IDBODMSG']?>" />
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Judul <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="judul" class="form-control" placeholder="Judul Pesan BOD" autocomplete="off" value="<?=$bodmsg['JUDUL']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama BOD" autocomplete="off" value="<?=$bodmsg['NAMA']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tempat <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="tempat" class="form-control" placeholder="Tempat BOD" autocomplete="off" value="<?=$bodmsg['TEMPAT']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pesan <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <textarea id="summernote_1" name="pesan"><?=$bodmsg['PESAN']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Gambar <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="file" name="gambar">
                                            <p class="help-block">Maks 1900x1280, format .gif.jpg.jpeg.png, Abaikan jika tidak ingin mengganti gambar</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label><input type="radio" name="status" class="icheck" value="1" <?=($bodmsg['KDSTATUS'] == 1 ? 'checked' : null)?>> Aktif </label>
                                                <label><input type="radio" name="status" class="icheck" value="0" <?=($bodmsg['KDSTATUS'] == 0 ? 'checked' : null)?>> Non Aktif </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">Simpan</button>
                                            <a href="<?="$this->url/admin-bod-message"?>" class="btn default">Kembali</a>
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
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-summernote/summernote.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        // wysiwyg summernote
        $('#summernote_1').summernote({height: 300});

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
    });
</script>
<!-- END JAVASCRIPTS -->