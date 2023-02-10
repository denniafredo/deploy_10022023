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
                                <th style="text-align:center; vertical-align:middle;">Ebook</th>
                                <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Unggah</th>
                                <th style="text-align:center; vertical-align:middle;">Unduh</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($ebook as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td><?=$v['NAMAEBOOK']?></td>
                                    <td><?=$v['KETERANGAN']?></td>
                                    <td class="text-center"><?=$v['TGLREKAM']?></td>
                                    <td class="text-center" width="36">
                                        <a href="<?=base_url("asset/learning/ebook/$v[EBOOK]")?>" class="btn btn-xs grey tooltips btn-edit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><i class="fa fa-file-pdf-o btn-xs-tbl"></i></a>
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