<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
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
                        <i class="fa fa-bullhorn font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Daftar Pesan BOD</span>
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
                                <a href="<?="$this->url/add-bod-message"?>" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_ADD?>"><i class="fa fa-plus"></i></a>
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
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Pesan</th>
                                <th style="text-align:center; vertical-align:middle;">Aktif</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($bodmsg as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td><?=$v['JUDUL']?></td>
                                    <td><?=$v['NAMA']?></td>
                                    <td><?=substr(htmlentities($v['PESAN']), 0, 80)?></td>
                                    <td align="center"><input type="checkbox" <?=($v['KDSTATUS'] == 1 ? 'checked' : null)?> disabled></td>
                                    <td align="center">
                                        <?php if ($v['KDSTATUS'] != 1) { ?>
                                            <a href="<?="$this->url/aktif-bod-message/$v[IDBODMSG]"?>" class="btn btn-xs blue-ebonyclay tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_AKTIFKAN?>"><i class="fa fa-check btn-xs-tbl"></i></a>
                                        <?php } ?>
                                        <a href="<?="$this->url/edit-bod-message/$v[IDBODMSG]"?>" class="btn btn-xs yellow-gold tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_EDIT?>"><i class="fa fa-pencil btn-xs-tbl"></i></a>
                                        <?php if ($v['KDSTATUS'] != 1) { ?>
                                            <a data-value="<?=$v['IDBODMSG']?>" class="btn btn-xs red-flamingo tooltips btn-delete" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
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
<script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        $('.btn-delete').click(function(){
            var idbodmsg = $(this).attr('data-value');
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function(result){
                    if (result)
                        window.location.href = "<?="$this->url/delete-bod-message/"?>"+idbodmsg;
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
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_UPLOAD?>")
            toastr.error("<?=$pesan?>");
        /*===== end of toastr notification =====*/
    });
</script>
<!-- END JAVASCRIPTS -->