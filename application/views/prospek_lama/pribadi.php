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
        <li>
            <a href="javascript:;">Workbook</a>
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
                        <i class="fa icon-doc font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Data Prospek</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="<?="$this->url/pribadi"?>" method="get" />
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                            <span class="input-group-btn">
                                <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                <a href="<?="$this->url/add-pribadi"?>" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_ADD?>"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                    </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Rayon</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                <th style="text-align:center; vertical-align:middle;">Kota</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Lahir</th>
                                <th style="text-align:center; vertical-align:middle;">HP</th>
                                <th style="text-align:center; vertical-align:middle;">Telp</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($prospek as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td align="center"><?=$v['KDKANTOR']?></td>
                                    <td><?=$v['NAMA']?></td>
                                    <td><?=$v['ALAMAT']?></td>
                                    <td><?=$v['KOTA']?></td>
                                    <td align="center"><?=$v['TGLLAHIR']?></td>
                                    <td align="center"><?=$v['HP']?></td>
                                    <td align="center"><?=$v['TELP']?></td>
                                    <td class="text-center" width="95">
                                        <a href="<?="$this->url/edit-pribadi?id=$v[NOPROSPEK]"?>" class="btn btn-xs yellow-gold tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_EDIT?>"><i class="fa fa-pencil btn-xs-tbl"></i></a>
                                        <a href="<?="$this->url/proposal-pribadi?id=$v[NOPROSPEK]"?>" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="Proposal"><i class="fa fa-search-plus btn-xs-tbl"></i></a>
                                        <a class="btn btn-xs red-flamingo tooltips btn-delete" data-value="<?=$v['NOPROSPEK']?>" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
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
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        $("input[name='s']").focus();

        $('.btn-delete').click(function(){
            var noprospek = $(this).attr('data-value');
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function(result){
                    if (result)
                        window.location.href = "<?="$this->url/delete-pribadi?id="?>"+noprospek;
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
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN_KTP?>")
            toastr.error('Oo tidaak, data dengan no ktp yang dientry sudah ada.');
    });
</script>
<!-- END JAVASCRIPTS -->