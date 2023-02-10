<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>

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
                <div class="portlet-body">
                    <div class="form-group">
                        <label class="control-label col-md-2" style="margin-top: 5px;">Periode Komisi</label>
                        <div class="col-md-10">
                            <form>
                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                    <input type="text" data-field="date" class="form-control" name="txtTglAwal" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAwal')?>" readonly>
									<span class="input-group-addon">
									to </span>
                                    <input type="text" data-field="date" class="form-control" name="txtTglAkhir" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAkhir')?>" readonly>
									<span class="input-group-btn">
										<button class="btn blue" type="submit">Cari !</button>
									</span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                <th style="text-align:center; vertical-align:middle;">Area Office</th>
                                <th style="text-align:center; vertical-align:middle;">Unit Produksi</th>
                                <th style="text-align:center; vertical-align:middle;">No Rekening</th>
                                <th style="text-align:center; vertical-align:middle;">Komisi</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $tglawal = rawurlencode($this->input->get('txtTglAwal'));
                                $tglakhir = rawurlencode($this->input->get('txtTglAkhir'));
                                $total = 0;
                                foreach($pendapatan as $i => $v) {
                                    $total += str_replace(',', '.', $v['KOMISIAGENRP']); ?>
                                    <tr>
                                        <td align="center"><?=($i+1)?></td>
                                        <td align="center"><?="$v[PREFIXAGEN]-$v[NOAGEN]"?></td>
                                        <td><?=$v['NAMAKLIEN1']?></td>
                                        <td><?=$v['NAMAJABATANAGEN']?></td>
                                        <td><?="$v[KDAREAOFFICE]-$v[NAMAAREAOFFICE]"?></td>
                                        <td><?="$v[KDUNITPRODUKSI]-$v[NAMAUNITPRODUKSI]"?></td>
                                        <td align="center"><?=$v['NOREKENING']?></td>
                                        <td align="right"><?=number_format(str_replace(',', '.', $v['KOMISIAGENRP']), 0, ',', '.')?></td>
                                        <td align="center">
                                            <a href="<?="$this->url/agen-se-cabang?id=$v[NOAGEN]&txtTglAwal=$tglawal&txtTglAkhir=$tglakhir"?>" class="btn btn-xs blue tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DETAIL?>">
                                                <i class="fa fa-search btn-xs-tbl"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr style="background:#468966; color:#FFF0A5;">
                                <th colspan="7" style="text-align: center;">TOTAL KOMISI</th>
                                <th style="text-align:right;"><?=number_format($total, 0, ',', '.')?></th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dtBox"></div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        //ComponentsPickers.init();
        $("#dtBox").DateTimePicker();
    });
</script>
<!-- END JAVASCRIPTS -->