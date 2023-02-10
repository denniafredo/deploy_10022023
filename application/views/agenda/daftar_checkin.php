<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" xmlns="http://www.w3.org/1999/html"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
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
        <li>
            <a href="<?="$this->url/pribadi";?>">Agenda Saya</a>
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

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">Catatan</th>
                                <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                <th style="text-align:center; vertical-align:middle;">Koordinat</th>
                                <th style="text-align:center; vertical-align:middle;">Tanggal</th>
                                <th style="text-align:center; vertical-align:middle;">Gambar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($checkin as $i => $v) {
                                if ($v['dataType'] == 'CHECKIN') { ?>
                                    <tr>
                                        <td><?=$v['notes']?></td>
                                        <td><?=$v['address']?></td>
                                        <td><?="$v[lat] $v[lng]"?></td>
                                        <td><?=(!empty($v['checkinDate']) ? $v['checkinDate'] : null)?></td>
                                        <td><img width="50" src="<?=base64_decode($v['pict'])?>" /></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- button trigger extended modals -->
<a id="btnModal" class="btn default hidden" data-toggle="modal" href="#responsive"></a>
<!-- responsive -->
<div id="responsive" class="modal fade" tabindex="-1" data-width="500">
    <form class="inline-form" action="<?="$this->url/edit-daftar-pribadi"?>" method="post">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Agenda No: <span id="noAgenda"></span></h4>
            <input type="hidden" name="txtNoAgenda">
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="txtAgenda" rows="2" placeholder="Isi Agenda....."></textarea>
                    </div>
                    <div class="form-group">
                        <div class="input-group date form_datetime" data-date-format="dd/mm/yyyy hh:ii:ss">
                            <input type="text" name="txtTglAwal" size="16" readonly class="form-control" placeholder="Tanggal Mulai">
                            <span class="input-group-btn">
                                <button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
                                <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="input-group date form_datetime" data-date-format="dd/mm/yyyy hh:ii:ss">
                        <input type="text" name="txtTglAkhir" size="16" readonly class="form-control" placeholder="Tanggal Selesai">
                        <span class="input-group-btn">
                            <button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn yellow-gold">Ubah</button>
            <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
        </div>
    </form>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        ComponentsPickers.init();

        $("input[name='s']").focus();

        $('.btn-back').click(function() {
            window.location.href = "<?="$this->url/pribadi"?>";
        });
        $('.btn-edit').click(function() {
            var noagenda = $(this).parent().prev().prev().prev().prev().html();
            var isiagenda = $(this).parent().prev().prev().prev().html();
            var tglmulai = $(this).parent().prev().prev().html();
            var tglselesai = $(this).parent().prev().html();

            $("#btnModal").click();
            $("#noAgenda").text(noagenda);
            $("input[name='txtNoAgenda']").val(noagenda);
            $("textarea[name='txtAgenda']").val(isiagenda);
            $("input[name='txtTglAwal']").val(tglmulai);
            $("input[name='txtTglAkhir']").val(tglselesai);
        });
        $('.btn-delete').click(function(){
            var noagenda = $(this).parent().prev().prev().prev().prev().html();
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function(result){
                    if (result)
                        window.location.href = "<?="$this->url/hapus-daftar-pribadi?id="?>"+noagenda;
                }
            });
        });

        /*===== toastr notification =====*/
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "showMethod": "fadeIn"
        };
        if ("<?=$status?>" == "<?=C_STATUS_SUKSES_SIMPAN?>")
            toastr.success('Oo yeaah, agenda berhasil disimpan.')
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN?>")
            toastr.error('Oo tidaak, agenda gagal disimpan.')
        else if ("<?=$status?>" == "<?=C_STATUS_SUKSES_HAPUS?>")
            toastr.success('Oo yeaah, agenda berhasil dihapus.')
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_HAPUS?>")
            toastr.error('Oo tidaak, agenda gagal dihapus.')
    });
</script>
<!-- END JAVASCRIPTS -->