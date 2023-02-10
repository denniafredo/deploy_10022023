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
                                <input type="hidden" name="idagenmonth" value="<?=$aotm['IDAGENMONTH']?>" />
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        You have some form errors. Please check below.
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">No Agen <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="noagen" class="form-control" placeholder="Nomor Agen" autocomplete="off" value="<?=$aotm['NOAGEN']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Agen Jiwasraya" autocomplete="off" value="<?=$aotm['NAMA']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Prakata <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="prakata" class="form-control" placeholder="Prakata" autocomplete="off" value="<?=$aotm['PRAKATA']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Narasi <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <textarea id="summernote_1" name="narasi"><?=$aotm['NARASI']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Gambar <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <img src="<?="../../asset/aotm/$aotm[GAMBAR]"?>" class="col-md-2 col-sm-3 col-xs-5" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label"></label>
                                        <div class="col-md-9">
                                            <input type="file" name="gambar">
                                            <p class="help-block">Maks 1900x1280, format .gif.jpg.jpeg.png, Abaikan jika tidak ingin mengganti gambar</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kantor <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <input type="text" name="kantor" class="form-control" placeholder="Nama Kantor" autocomplete="off" value="<?=$aotm['NAMAKANTOR']?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Periode B/T <span class="required">*</span></label>
                                        <div class="col-md-9">
                                            <select name="bulan" class="form-control inline input-xsmall">
                                                <option value="1" <?=$aotm['NBULAN'] == '1' ? 'selected' : null?>>1</option>
                                                <option value="2" <?=$aotm['NBULAN'] == '2' ? 'selected' : null?>>2</option>
                                                <option value="3" <?=$aotm['NBULAN'] == '3' ? 'selected' : null?>>3</option>
                                                <option value="4" <?=$aotm['NBULAN'] == '4' ? 'selected' : null?>>4</option>
                                                <option value="5" <?=$aotm['NBULAN'] == '5' ? 'selected' : null?>>5</option>
                                                <option value="6" <?=$aotm['NBULAN'] == '6' ? 'selected' : null?>>6</option>
                                                <option value="7" <?=$aotm['NBULAN'] == '7' ? 'selected' : null?>>7</option>
                                                <option value="8" <?=$aotm['NBULAN'] == '8' ? 'selected' : null?>>8</option>
                                                <option value="9" <?=$aotm['NBULAN'] == '9' ? 'selected' : null?>>9</option>
                                                <option value="10" <?=$aotm['NBULAN'] == '10' ? 'selected' : null?>>10</option>
                                                <option value="11" <?=$aotm['NBULAN'] == '11' ? 'selected' : null?>>11</option>
                                                <option value="12" <?=$aotm['NBULAN'] == '12' ? 'selected' : null?>>12</option>
                                            </select>
                                            <select name="tahun" class="form-control inline input-xsmall">
                                                <option value="2015" <?=$aotm['TAHUN'] == '2015' ? 'selected' : null?>>2015</option>
                                                <option value="2016" <?=$aotm['TAHUN'] == '2016' ? 'selected' : null?>>2016</option>
                                                <option value="2017" <?=$aotm['TAHUN'] == '2017' ? 'selected' : null?>>2017</option>
                                                <option value="2018" <?=$aotm['TAHUN'] == '2018' ? 'selected' : null?>>2018</option>
                                                <option value="2019" <?=$aotm['TAHUN'] == '2019' ? 'selected' : null?>>2019</option>
                                                <option value="2020" <?=$aotm['TAHUN'] == '2020' ? 'selected' : null?>>2020</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-9">
                                            <div class="icheck-inline">
                                                <label><input type="radio" name="status" class="icheck" value="1" <?=$aotm['KDSTATUS'] == '1' ? 'checked' : null?>> Aktif </label>
                                                <label><input type="radio" name="status" class="icheck" value="0" <?=$aotm['KDSTATUS'] == '0' ? 'checked' : null?>> Non Aktif </label>
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