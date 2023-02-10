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
            <a href="javascript:;">Pencapaian</a>
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
                        <span class="caption-subject font-green-sharp bold uppercase">DAFTAR AKTIVASI PENJUALAN</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="<?="$this->url/index-kapus"?>" method="get" />
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                            <span class="input-group-btn">
                                <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                <a href="<?="$this->url/download-aktivasi-se-kapus"?>" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DOWNLOAD?>"><i class="fa fa-download"></i></a>
                            </span>
                        </div>
                    </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">No</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Kantor</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Kegiatan</th>
                                <th colspan="2" style="text-align:center; vertical-align:middle;">Rencana Pelaksanaan</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Tempat</th>
                                <th colspan="3" style="text-align:center; vertical-align:middle;">Potensi</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Biaya</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Realisasi Pelaksanaan</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Monitor</th>
                            </tr>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">Awal</th>
                                <th style="text-align:center; vertical-align:middle;">Akhir</th>
                                <th style="text-align:center; vertical-align:middle;">Premi B</th>
                                <th style="text-align:center; vertical-align:middle;">Premi S</th>
                                <th style="text-align:center; vertical-align:middle;">Prospek</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($aktivasi as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td align="center"><?=$v['KDKANTOR']?></td>
                                    <td align="center"><?=$v['JENISKEGIATAN']?></td>
                                    <td align="center"><?=$v['WAKTUPELAKSANAANAWAL']?></td>
                                    <td align="center"><?=$v['WAKTUPELAKSANAANAKHIR']?></td>
                                    <td><?=$v['TEMPAT']?></td>
                                    <td align="right"><?=number_format($v['POTENSIPREMIBERKALA'], 0, ',', '.')?></td>
                                    <td align="right"><?=number_format($v['POTENSIPREMISEKALIGUS'], 0, ',', '.')?></td>
                                    <td align="right"><?=number_format($v['POTENSIPROSPEK'], 0, ',', '.')?></td>
                                    <td><?=$v['BIAYA']?></td>
                                    <td align="center"><?=$v['TGLPELAKSANAAN']?></td>
                                    <td class="text-center" width="95">
                                        <?php if ($v['BIAYA']=='pusat') { ?>
                                        <a href="javascript:void(0);" onclick="openWin('<?=base_url("asset/notdin/aktivasi/$v[FILENOTADINAS]")?>')" class="btn btn-xs yellow-gold tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="Lihat"><i class="fa fa fa-file btn-xs-tbl"></i></a>
                                        <a href="<?="$this->url/upload-nota-kapus?id=$v[NOAKTIVASI]"?>" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_UPLOAD?>"><i class="fa fa-upload btn-xs-tbl"></i></a>
                                        <?php } else { echo "-"; } ?>
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

        /* ===== toastr notification ===== */
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