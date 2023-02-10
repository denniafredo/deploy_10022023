<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li><a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i></li>
        <li><a href="javascript:;">Pencapaian</a><i class="fa fa-circle"></i></li>
        <?php $tglawal = rawurlencode($this->input->get('txtTglAwal')); $tglakhir = rawurlencode($this->input->get('txtTglAkhir')); ?>
        <li><a href="<?="$this->url/se_cabang?txtTglAwal=$tglawal&txtTglAkhir=$tglakhir"?>">Pendapatan Agen Se-Cabang </a><i class="fa fa-circle"></i></li>
        <li class="active"><?=$this->template->title?></li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="row margin-top-10">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-body">
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <a href="<?="$this->url/se_cabang?txtTglAwal=$tglawal&txtTglAkhir=$tglakhir"?>" class="btn btn-circle btn-sm purple-wisteria tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>">
                                <i class="fa fa-undo"></i>
                            </a>
                            <a href="javascript:location.reload();" class="btn btn-circle btn-sm grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Polis</th>
                                <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">No Rekening</th>
                                <th style="text-align:center; vertical-align:middle;">Komisi</th>
                                <th style="text-align:center; vertical-align:middle;">Cara Bayar</th>
                                <th style="text-align:center; vertical-align:middle;">Tahun Komisi</th>
                                <th style="text-align:center; vertical-align:middle;">Komisi</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Booked</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Periode</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total = 0;
                            foreach($pendapatan as $i => $v) {
                                $total += str_replace(',', '.', $v['KOMISIAGENRP']); ?>
                                <tr>
                                    <td align="center"><?=($i+1)?></td>
                                    <td align="center"><?=$v['PREFIXPERTANGGUNGAN']?>-<?=$v['NOPERTANGGUNGAN']?></td>
                                    <td align="center"><?=$v['NOAGEN']?></td>
                                    <td><?=$v['NAMAKLIEN1']?></td>
                                    <td align="center"><?=$v['NOREKENING']?></td>
                                    <td><?=$v['NAMAKOMISIAGEN']?></td>
                                    <td><?=$v['CARABAYAR']?></td>
                                    <td align="center"><?=$v['THNKOMISI']?></td>
                                    <td align="right"><?=number_format(str_replace(',', '.', $v['KOMISIAGENRP']), 0, ',', '.')?></td>
                                    <td align="center"><?=$v['TGLBOOKED']?></td>
                                    <td align="center"><?=$v['TGLPROSES']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr style="background:#468966; color:#FFF0A5;">
                                <th colspan="8" style="text-align: center;">TOTAL KOMISI</th>
                                <th style="text-align:right;"><?=number_format($total, 0, ',', '.')?></th>
                                <th colspan="2"></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();
    });
</script>
<!-- END JAVASCRIPTS -->