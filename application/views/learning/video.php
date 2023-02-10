<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Learning</a>
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
                        <i class="fa fa-file-text-o font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Today a reader tommorow a leader</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                                <span class="input-group-btn">
                                    <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                    <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                </span>
                            </div>
                        </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Judul</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Unggah</th>
                                <th style="text-align:center; vertical-align:middle;">Lihat</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($video as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td><?=$v['JUDUL']?></td>
                                    <td class="text-center"><?=$v['TGLREKAM']?></td>
                                    <td class="text-center" width="36">
                                        <a class="btn btn-xs grey tooltips btn-view" data-modal="<?=base_url("asset/learning/video/$v[URL]")?>" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><i class="fa fa-file-video-o btn-xs-tbl"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<a id="btnmodal" data-toggle="modal" class="hidden" href="#modal"></a>
<div class="modal fade bs-modal-lg" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 id="mdljudul" class="modal-title">Modal Title</h4>
            </div>
            <div class="modal-body text-center">
                <video width="320" height="240" controls autoplay>
                    <source id="srcmp4" type="video/mp4">
                    <source id="srcogg" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    jQuery(document).ready(function() {
        $(".btn-view").click(function() {
            var jdl = $(this).parent().prev().prev().html();
            var mp4 = $(this).attr('data-modal');
            var ogg = mp4.replace('.mp4', '.ogg');

            $("#srcmp4").attr('src', mp4);
            $("#srcogg").attr('src', ogg);

            $(".modal-body video")[0].load();
            $("#mdljudul").html(jdl);
            $( "#btnmodal" ).trigger( "click" );
        });

        $('body').on('hidden.bs.modal', '.modal', function () {
            $('video').trigger('pause');
        });
    });
</script>
<!-- END JAVASCRIPTS -->