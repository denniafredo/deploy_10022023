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
                        <span class="caption-subject font-green-sharp bold uppercase">Menu <?=$menu['MENU']?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a href="<?="$this->url/menu"?>" class="btn purple-wisteria tooltips btn-back" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                            </span>
                            <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                            <span class="input-group-btn">
                                <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                <a href="<?="$this->url/add-menu"?>" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_ADD?>"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Kode Menu</th>
                                <th style="text-align:center; vertical-align:middle;">Menu</th>
                                <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                                <th style="text-align:center; vertical-align:middle;">Url</th>
                                <th style="text-align:center; vertical-align:middle;">Icon</th>
                                <th style="text-align:center; vertical-align:middle;">Aktif</th>
                                <th style="text-align:center; vertical-align:middle;">Childs</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($child as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td><?=$v['KDMENU']?></td>
                                    <td><?=$v['MENU']?></td>
                                    <td><?=$v['KETERANGAN']?></td>
                                    <td><?=$v['URL']?></td>
                                    <td><?=$v['ICON']?></td>
                                    <td align="center"><input type="checkbox" <?=($v['KDSTATUS'] == 1 ? 'checked' : null)?>></td>
                                    <td align="center"><?=$v['JMLMENU']?></td>
                                    <td class="text-center" width="110">
                                        <a href="<?="$this->url/edit-menu/$v[KDMENU]"?>" class="btn btn-xs yellow-gold tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_EDIT?>"><i class="fa fa-pencil btn-xs-tbl"></i></a>
                                        <a class="btn btn-xs red-flamingo tooltips btn-delete" data-value="<?=$v['KDMENU']?>" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
                                        <?php if ($v['JMLMENU'] > 0) { ?>
                                            <a href="<?="$this->url/detail-menu/$v[KDMENU]"?>" class="btn btn-xs blue tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DETAIL?>"><i class="fa icon-grid btn-xs-tbl"></i></a>
                                        <?php } ?>
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