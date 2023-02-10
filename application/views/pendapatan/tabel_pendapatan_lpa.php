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
                        <form>
                            <label class="control-label col-md-2" style="margin-top: 5px;">Periode Komisi</label>
                            <div class="col-md-4">
                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                    <input type="text" data-field="date" class="form-control" name="txtTglAwal" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAwal')?>" readonly>
    								<span class="input-group-addon">
    								to </span>
                                    <input type="text" data-field="date" class="form-control" name="txtTglAkhir" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAkhir')?>" readonly>
    								<!-- <span class="input-group-btn">
    									<button class="btn blue" type="submit">Cari !</button>
    								</span> -->
                                </div>
                            </div>

                            <div>
                                <span class="input-group-btn">
                                    <button class="btn blue" type="submit">Cari !</button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" id="datakomisi" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No</th>
                                    <th style="text-align:center; vertical-align:middle;">Noagen</th>
									<th style="text-align:center; vertical-align:middle;">Komponen Remunerasi</th>
                                    <th style="text-align:center; vertical-align:middle;">Tgl Periode</th>
									<th style="text-align:center; vertical-align:middle;">Slip Gaji</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php
                                    $no = 1;
                                    foreach($pendapatan as $i => $v) {
                                ?>
								<tr>
								<td style="text-align:center; vertical-align:middle;"><?= $no;?></td>
								<td style="text-align:center; vertical-align:middle;"><?= $v['NOAGEN'];?></td>
								<td style="text-align:center; vertical-align:middle;"><?= $v['NAMAKOMISI'];?></td>
								<td style="text-align:center; vertical-align:middle;"><?= $v['TGLPROSES'];?></td>
								<td style="text-align:center; vertical-align:middle;"><a class="btn btn-primary" href="<?= base_url('pendapatan/slip_gaji_lpa').'/'.$v['KDKOMISIAGEN'].'/'.$v['TGLBILLING'];?>">Slip Gaji</td>
								</tr>
								<?php 
								$no++;
								} ?>								
                            </tbody>
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

    $(document).ready(function () {
      $('#datakomisi').DataTable({
        "pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
      });
      $('.dataTables_length').addClass('bs-select');
    });
</script>
<!-- END JAVASCRIPTS -->