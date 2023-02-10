<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/icheck/skins/all.css" rel="stylesheet"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

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
                        <span class="caption-subject font-green-sharp bold uppercase">Data Menu</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                        <div class="form-group col-md-4 col-sm-3">
                            <select class="form-control" name="f">
                                <?php foreach ($kategori as $i => $v) {
                                        if ($this->input->get('f') == $v['KDKATEGORI']) {
                                            echo "<option value='$v[KDKATEGORI]' selected>".ucwords(strtolower($v['NAMAKATEGORI']))."</option>";
                                        }
                                        else {
                                            echo "<option value='$v[KDKATEGORI]'>".ucwords(strtolower($v['NAMAKATEGORI']))."</option>";
                                        }
                                    } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-8 col-sm-9">
                            <div class="input-group">
                                <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                                <span class="input-group-btn">
                                    <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                    <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                    <a href="<?="$this->url/add-menu"?>" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_ADD?>"><i class="fa fa-plus"></i></a>
                                </span>
                            </div>
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
                            <?php foreach($menu as $i => $v) { ?>
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
                                        <a href="<?="$this->url/edit-menu?id=$v[KDMENU]"?>" class="btn btn-xs yellow-gold tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_EDIT?>"><i class="fa fa-pencil btn-xs-tbl"></i></a>
                                        <a class="btn btn-xs red-flamingo tooltips btn-delete" data-value="<?=$v['KDMENU']?>" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
                                        <?php if ($v['JMLMENU'] > 0) { ?>
                                            <a href="<?="$this->url/detail-menu?id=$v[KDMENU]"?>" class="btn btn-xs blue tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DETAIL?>"><i class="fa icon-grid btn-xs-tbl"></i></a>
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

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>asset/plugin/icheck/icheck.min.js"></script>
<script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        $("input[name='s']").focus();
        $("input[type='checkbox']").iCheck('disable');

        $('.btn-delete').click(function(){
            var kdmenu = $(this).attr('data-value');
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function(result){
                    if (result)
                        window.location.href = "<?="$this->url/delete-menu/"?>"+kdmenu;
                }
            });
        });

        /*===== toastr notification =====*/
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "showMethod": "fadeIn"
        };
        if ("<?=$status?>" == "<?=C_STATUS_SUKSES_SIMPAN?>")
            toastr.success('Oo yeaah, data berhasil disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN?>")
            toastr.error('Oo tidaak, data gagal disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_SUKSES_HAPUS?>")
            toastr.success('Oo yeaah, data berhasil dihapus.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_HAPUS?>")
            toastr.error('Oo tidaak, data gagal dihapus.');
    });
</script>
<!-- END JAVASCRIPTS -->