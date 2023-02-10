<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
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
        <li>
            <a href="<?="$this->url/pribadi"?>">Prospek Saya</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?="$this->url/proposal-pribadi?id=".$this->input->get('r')?>">Proposal</a>
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
                <?php if (!$isdelete) { ?>
                <!--div class="portlet-title">
                    <div class="caption">
                        <i class="fa icon-user font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Proposal No <?=$this->input->get('id')?></span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="btn-group btn-group-solid pull-right">
                        <a href="<?="$this->url/proposal-pribadi?id=".$this->input->get('r')?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                    </div>

                    <div class="clearfix margin-bottom-10"></div>

                    <form id="form-followup" class="form-horizontal" role="form" action="<?="$this->url/save-follow-up"?>" method="post">
                        <input type="hidden" name="txtnoprospek" value="<?=$this->input->get('r')?>" />
                        <input type="hidden" name="txtbuildid" value="<?=$this->input->get('id')?>" />
                        <input type="hidden" name="txtnofollowup" value="<?=$this->input->get('nf')?>" />
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Status Proposal <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <select name="ddlstatus" class="form-control">
                                            <option value="">Silahkan Pilih</option>
                                            <?php foreach($statusproposal as $i => $v) {
                                                if ($v['KDSTATUS'] == $edited['KDSTATUS'])
                                                    echo "<option value='$v[KDSTATUS]' selected>$v[NAMASTATUS]</option>";
                                                else
                                                    echo "<option value='$v[KDSTATUS]'>$v[NAMASTATUS]</option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group spaj <?=($edited['KDSTATUS'] == 4 ? null : 'display-hide')?>">
                                <label class="col-md-3 control-label">No SPAJ <span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" name="txtnospaj" class="form-control" value="<?=$edited['NOSPAJ']?>" placeholder="9999999999">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group spaj <?=($edited['KDSTATUS'] == 4 ? null : 'display-hide')?>">
                                <label class="control-label col-md-3">Tanggal SPAJ <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" name="txttglspaj" class="form-control form-control-inline date-picker" value="<?=$edited['TGLSPAJ']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group presentasi <?=($edited['KDSTATUS'] == 3 ? null : 'display-hide')?>">
                                <label class="control-label col-md-3">Tanggal Presentasi <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" name="txttglpresentasi" class="form-control form-control-inline date-picker" value="<?=$edited['TGLPRESENTASI']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pelunasan <?=($edited['KDSTATUS'] == 5 ? null : 'display-hide')?>">
                                <label class="control-label col-md-3">Premi Pelunasan <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" name="txtpremipelunasan" class="form-control form-control-inline" value="<?=$edited['PREMI']?>" placeholder="9999999" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group pelunasan <?=($edited['KDSTATUS'] == 5 ? null : 'display-hide')?>">
                                <label class="control-label col-md-3">Tanggal Pelunasan <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" name="txttglpelunasan" class="form-control form-control-inline date-picker" value="<?=$edited['TGLPELUNASAN']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group batal <?=($edited['KDSTATUS'] == 99 ? null : 'display-hide')?>">
                                <label class="control-label col-md-3">Tanggal Pembatalan <span class="required">*</span></label>
                                <div class="col-md-3">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <input type="text" name="txttglpembatalan" class="form-control form-control-inline input-medium date-picker" value="<?=$edited['TGLPEMBATALAN']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Keterangan</label>
                                <div class="col-md-9">
                                    <div class="input-icon right">
                                        <i class="fa"></i>
                                        <textarea name="txtketerangan" class="form-control" rows="2"><?=$edited['KETERANGAN']?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn green btn-submit">Simpan</button>
                                    <a href="<?="$this->url/pribadi"?>" class="btn default">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div-->
                <?php } ?>

                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa icon-user font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Historis Follow Up Proposal No <?=$this->input->get('id')?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php if ($isdelete) { ?>
                    <div class="btn-group btn-group-solid pull-right">
                        <a href="<?="$this->url/proposal-pribadi?id=".$this->input->get('r')?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                    </div>
                    <?php } ?>

                    <div class="clearfix margin-bottom-10"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;width:50px;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Status</th>
                                <th style="text-align:center; vertical-align:middle;width:1%;" colspan="2">Oleh</th>
                                <th style="text-align:center; vertical-align:middle;width:1%;">Tanggal</th>
                                <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($followup as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td><?=$v['NAMASTATUS']?></td>
                                    <td nowrap><?=ucwords(strtolower($v['NAMAKLIEN1']))?></td>
                                    <td nowrap><?=$v['OLEH']?></td>
                                    <td nowrap><?=$v['TGLREKAM']?></td>
                                    <td><?=$v['KETERANGAN']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();

        $('.btn-delete').click(function () {
            var nofollowup = $(this).attr('data-value');
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function (result) {
                    if (result)
                        window.location.href = "<?="$this->url/delete-follow-up?r=".$this->input->get('r')."&id=".$this->input->get('id')."&nf="?>" + nofollowup;
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
        /*===== end of toastr notification =====*/

        $("select[name='ddlstatus']").change(function() {
            var option = this.value;

            switch(option) {
                case '3':
                    $(".spaj").hide();
                    $(".presentasi").show();
                    $(".pelunasan").hide();
                    $(".batal").hide();
                    break;
                case '4':
                    $(".spaj").show();
                    $(".presentasi").hide();
                    $(".pelunasan").hide();
                    $(".batal").hide();
                    break;
                case '5':
                    $(".spaj").hide();
                    $(".presentasi").hide();
                    $(".pelunasan").show();
                    $(".batal").hide();
                    break;
                case '99':
                    $(".spaj").hide();
                    $(".presentasi").hide();
                    $(".pelunasan").hide();
                    $(".batal").show();
                    break;
                default:
                    $(".spaj").hide();
                    $(".presentasi").hide();
                    $(".pelunasan").hide();
                    $(".batal").hide();
                    break;
            }
        });

        $(".btn-submit").click(function() {
            var option = $("select[name='ddlstatus']").val();
            var sukses = 1;

            switch(option) {
                case '3':
                    if ($("input[name='txttglpresentasi']").val().length == 0) {
                        alert('Tanggal Presentasi wajib diisi');
                        sukses = 0;
                    }
                    break;
                case '4':
                    if ($("input[name='txtnospaj']").val().length == 0 || $("input[name='txttglspaj']").val().length == 0) {
                        alert('No & Tanggal SPAJ wajib diisi');
                        sukses = 0;
                    }
                    break;
                case '5':
                    if ($("input[name='txtpremipelunasan']").val().length == 0 || $("input[name='txttglpelunasan']").val().length == 0) {
                        alert('Premi & Tanggal Pelunasan wajib diisi');
                        sukses = 0;
                    }
                    break;
                case '99':
                    if ($("input[name='txttglpembatalan']").val().length == 0) {
                        alert('Tanggal Pembatalan wajib diisi');
                        sukses = 0;
                    }
                    break;
            }

            if (sukses)
                $("#form-followup").submit();
        });
    });
</script>
<!-- END JAVASCRIPTS -->