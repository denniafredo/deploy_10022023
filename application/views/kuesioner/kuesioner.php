<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-summernote/summernote.css">
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
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
                        <i class="fa fa-comments font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase"><?=(count($kuesioner) > 0 ? $kuesioner[0]['NAMAGROUP'] : null)?></span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form role="form" action="<?="$this->url/save-kuesioner"?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idgrup" value="<?=$idgrup?>" />
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" style="font-size: 12px;">
                                <thead>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No</th>
                                    <th style="text-align:center; vertical-align:middle;">Nama</th>
                                    <th style="text-align:center; vertical-align:middle;">Kurang Sekali</th>
                                    <th style="text-align:center; vertical-align:middle;">Kurang</th>
                                    <th style="text-align:center; vertical-align:middle;">Baik</th>
                                    <th style="text-align:center; vertical-align:middle;">Sangat Baik</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($kuesioner as $i => $v) { ?>
                                    <tr>
                                        <td align="center"><?=$i+1?></td>
                                        <td><?=$v['KRITERIA']?><input type="hidden" name="idkuesioner<?=$i?>" value="<?=$v['IDKUESIONER']?>" /></td>
                                        <td align="center"><input type="radio" name="pilihan<?=$i?>" value="kurangsekali" class="icheck"></td>
                                        <td align="center"><input type="radio" name="pilihan<?=$i?>" value="kurang" class="icheck"></td>
                                        <td align="center"><input type="radio" name="pilihan<?=$i?>" value="baik" class="icheck"></td>
                                        <td align="center"><input type="radio" name="pilihan<?=$i?>" value="sangatbaik" class="icheck"></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="maxnumber" value="<?=$i?>" />

                        <div class="form-body">
                            <div class="form-group">
                                <label>Saran atau Masukan</label>
                                <div class="input-group col-md-12">
                                    <textarea id="summernote_1" name="saran"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-7">
                                    <button type="submit" class="btn green">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>

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