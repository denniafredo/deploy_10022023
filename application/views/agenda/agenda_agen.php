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
        <li>
            <a href="<?="$this->url/agen-se-wilayah"?>">Agenda Agen</a>
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
                    <form>
                    <input type="hidden" name="id" value="<?=$this->input->get('id')?>" />
                    <div class="form-group">
                        <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn purple-wisteria tooltips btn-back" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></button>
                                </span>
                            <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                                <span class="input-group-btn">
                                    <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                </span>
                        </div>
                    </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No Agenda</th>
                                <th style="text-align:center; vertical-align:middle;">Agenda</th>
                                <th style="text-align:center; vertical-align:middle;">Mulai</th>
                                <th style="text-align:center; vertical-align:middle;">Selesai</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($agenda as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NOAGENDA']?></td>
                                    <td><?=$v['AGENDA']?></td>
                                    <td align="center"><?=$v['TGLMULAI']?></td>
                                    <td align="center"><?=$v['TGLSELESAI']?></td>
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

<script>
    jQuery(document).ready(function() {
        $("input[name='s']").focus();

        $('.btn-back').click(function() {
            window.location.href = "<?="$this->url/$urlback"?>";
        });
    });
</script>
<!-- END JAVASCRIPTS -->