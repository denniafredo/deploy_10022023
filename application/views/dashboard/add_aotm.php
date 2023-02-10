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
            <a href="<?="$this->url/admin-aotm"?>">Agen of the Month</a>
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
                        <i class="fa fa-star font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Tambah Agen of the Month</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet light">

                            <form class="form-horizontal" action="<?="$this->url/save-aotm"?>" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">No Agen <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="noagen" class="form-control" placeholder="Nomor Agen" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Agen Jiwasraya" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Prakata <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="prakata" class="form-control" placeholder="Prakata" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Narasi <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <textarea id="summernote_1" name="narasi"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Gambar <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="file" name="gambar">
                                            <p class="help-block">Maks 1900x1280, format .gif.jpg.jpeg.png</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kantor <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="kantor" class="form-control" placeholder="Nama Kantor" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Periode B/T <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <select name="bulan" class="form-control inline input-xsmall">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                            <select name="tahun" class="form-control inline input-xsmall">
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label><input type="radio" name="status" class="icheck" value="1"> Aktif </label>
                                                <label><input type="radio" name="status" checked class="icheck" value="0"> Non Aktif </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">Simpan</button>
                                            <a href="<?="$this->url/admin-aotm"?>" class="btn default">Kembali</a>
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
    });
</script>
<!-- END JAVASCRIPTS -->