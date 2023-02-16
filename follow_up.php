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
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa icon-user font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Historis Follow Up Proposal No <?=$this->input->get('buildid')?></span>
						
                    </div>
					<?php if(@$histories['status']['KDSTATUS'] != 1): ?>
						
						<div class="caption" style="float: right;">
							
							<a href="<?= site_url('prospek/follow-up-polis?buildid='. $buildid) ?>" class="btn btn-primary">
								<i class="fa fa-pencil"></i> &nbsp;
								<span>Follow Up</span>
							</a>
						</div>
					<?php endif ?>
                </div>
                <div class="portlet-body">

                    <div class="clearfix margin-bottom-10"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;width:50px;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Status</th>
                                <th style="text-align:center; vertical-align:middle;">Oleh</th>
                                <th style="text-align:center; vertical-align:middle;">Tanggal</th>
                                <th style="text-align:center; vertical-align:middle;" width="400">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; foreach($followup as $j => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i++?></td>
                                    <td><?=$v['NAMASTATUS']?></td>
                                    <td nowrap><?=$v['USERREKAM']?></td>
                                    <td nowrap><?=$v['TGLREKAM']?></td>
                                    <td><?=$v['KETERANGAN']?></td>
                                </tr>
                            <?php } ?>
							<?php foreach($histories['data'] as $his): ?>
								<?php 
									$statusMessage  = '';
									if($his['KDSTATUS'] == 1 || $his['KDSTATUS'] == 2){
										$statusMessage  = 'Berhasil Welcoming Call';
									}elseif($his['KDSTATUS'] == 2){
										$statusMessage  = 'Berhasil Welcoming Call Dengan Catatan';
									}elseif($his['KDSTATUS'] == 9){
										$statusMessage  = 'Followup Agent - Welcoming Call';
									}else{
										$statusMessage  = 'Gagal Welcoming Call';
									}
								?>
								<tr>
                                    <td align="center"><?=$i++?></td>
                                    <td><?= $statusMessage; ?></td>
                                    <td nowrap></td>
                                    <td nowrap><?= date('d-m-Y H:i:s', strtotime($his['TGL_MUTASI'])) ?></td>
                                    <td><?= $his['KETERANGANMUTASI']; ?></td>
                                </tr>
							<?php endforeach ?>
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