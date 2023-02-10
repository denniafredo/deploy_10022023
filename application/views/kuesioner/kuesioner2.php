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
                        <span class="caption-subject font-green-sharp bold uppercase"><?=(count($kuesioner) > 0 ? $kuesioner[0]['NAMAGRUP']." ".$kuesioner[0]['NAMAWAJIB'] : null)?></span>
                    </div>
                </div>
                <div class="portlet-body form">

                    <form role="form" action="<?="$this->url/save-kuesioner"?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="idgrup" value="<?=$this->input->get('id')?>" />
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; vertical-align:middle;">No</th>
                                        <th style="text-align:center; vertical-align:middle;">Pertanyaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $kdstatussaran = 0;
                                    foreach($kuesioner as $i => $v) {
                                    $kdstatussaran = $v['KDSTATUSSARAN']; ?>
                                    <tr>
                                        <td align="center"><?=$i+1?></td>
                                        <td><?=$v['PERTANYAAN']?><input type="hidden" name="idkuesioner<?=$i?>" value="<?=$v['IDKUESIONER']?>" /></td>
                                    </tr>

                                    <?php foreach ($jawaban as $j => $w) {
                                        if ($v['IDKUESIONER'] == $w['IDKUESIONER']) { ?>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <label class="radio-inline" style="margin:0px;padding:0px;font-size:12px;">
                                                        <input type="radio" name="kuesionerjawaban<?=$i?>" onclick="cekjawaban('<?=$v['IDKUESIONER']?>')" value="<?=$w['IDKUESIONERJAWABAN']?>"> <?=$w['JAWABAN']?>
                                                    </label>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="maxnumber" value="<?=$i?>" />

                        <?php if ($kdstatussaran) { ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Saran atau Masukan</label>
                                    <div class="input-group col-md-12">
                                        <textarea id="summernote_1" name="saran"></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-7">
                                    <button type="submit" id="submit" class="btn green">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="tempid" />
<input type="hidden" id="jmljwbn" value="0" />

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-summernote/summernote.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        // wysiwyg summernote
        $('#summernote_1').summernote({height: 300});
        //$("#submit").hide();
    });

    function cekjawaban(id) {
        var tid = $("#tempid").val();
        var jj = $("#jmljwbn").val();
        var tjj = parseInt(jj) + parseInt(1);

        if (tid != id) {
            $("#tempid").val(id);
            $("#jmljwbn").val(tjj);
        }

        if ('<?=count($kuesioner)?>' >= tjj) {
            $("#submit").show();
        } else {
            $("#submit").hide();
        }

    }
</script>
<!-- END JAVASCRIPTS -->