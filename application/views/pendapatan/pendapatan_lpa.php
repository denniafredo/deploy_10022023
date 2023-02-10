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
									 <th style="text-align:center; vertical-align:middle;">No LPA</th>
									 <th style="text-align:center; vertical-align:middle;">Nama</th>
									 <th style="text-align:center; vertical-align:middle;">Kantor Representatif</th>
                                     <th style="text-align:center; vertical-align:middle;">No Polis</th>
                                    <th style="text-align:center; vertical-align:middle;">Tglbooked</th>
                                    <th style="text-align:center; vertical-align:middle;">Tgl Bayar</th>
                                    <th style="text-align:center; vertical-align:middle;">Produk</th>
									<th style="text-align:center; vertical-align:middle;">Jenis Produksi</th>
                                    <th style="text-align:center; vertical-align:middle;">Jumlah Produksi</th>
                                    <th style="text-align:center; vertical-align:middle;">Periode Remunerasi</th>
									<th style="text-align:center; vertical-align:middle;">Jenis Remunerasi</th>
									
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="background:#468966; color:#FFF0A5;">
                                     <th colspan="14" style="text-align: center;"><!-- <?if(!empty($pendapatan)){ echo $pendapatan[0]["NAMAKANTOR"]; }?> --></th>
                                </tr>
                                <?php
                                    $total = 0;
                                    $flag_area = 0;
                                    $flag_unit = 0;
                                    $noagen = 0;
                                    $nomor = 0;
									$nomor2 = 0;
									$totalsub = 0;
                                   
                                    foreach($pendapatan as $i => $v) {
                                        $nomor++;
										$nomor2++;
										$totalsub += $v['FYP'];
										$total += $v['FYP'];
                                        echo "<tr>";
                                        
                                        echo "<td align='center'>".$nomor."</td>";
								
										$basic = $v['NILAIPENDAPATAN'];
										
                                        agen($v);
                                        echo "</tr>";
										
										if($totalsub >= 0) {
											if(@$pendapatan[$i+1]['NAMAKOMISI'] != $v['NAMAKOMISI'] || @$pendapatan[$i+1]['TGLPERIODE'] != $v['TGLPERIODE']) {
												$periode =  $v['TGLPERIODE'];
												$remunerasi = $v['NAMAKOMISI'];
												
												subtotal($totalsub,$periode,$remunerasi,$basic);
												$totalsub = 0;
												$nomor2 = 0;
											}
										}
                                    }

                                    function agen($v) {
										
                                    ?>
										<td align="center"><?=$v['NOAGEN']?></td>
										<td align="center"><?=$v['NAMAAGEN']?></td>
										<td align="center"><?=$v['NAMAKANTOR']?></td>
                                        <td align="center"><?=$v['NOPOLIS']?></td>
										<td align="center"><?=$v['TGLBOOKED']?></td>
                                        <td align="center"><?=$v['TGLSEATLED']?></td>
                                        <td align="center"><?=$v['NAMAPRODUK']?></td>
										 <td align="center"><?=$v['NAMA_PRODUKSI']?></td>
                                        <td align="right"><?='Rp '.number_format($v['FYP'], 0, ',', '.')?></td>
                                        <td align="center"><?=$v['TGLPERIODE']?></td>
                                        <td  align="center"><?=$v['NAMAKOMISI']?></td>
									
                                    <?
									
                                    }
									
									function subtotal($totalsub,$periode,$remunerasi,$basic) { ?>
									<tr style="background:#468966; color:#FFF0A5;">
                                        <th colspan="9" style="text-align: center;">Total</th>
                                        <th style="text-align:right;"><?= 'Rp '.number_format($totalsub, 0, ',', '.')?></th>
										<th style="text-align:center;"><?=$periode;?></th>
										<th style="text-align:center;"><?=$remunerasi;?></th>
									</tr>
									<tr style="background:#468966; color:#FFF0A5;">
                                        <th colspan="9" style="text-align: center;">Jumlah Remunerasi</th>
										<th style="text-align:right;"><?= 'Rp '.number_format($basic, 0, ',', '.')?></th>
										<th colspan="9"></th>
									</tr>
									<?
																	
									}
									
                                    if ($total > 0) { ?>
                                    <!--<tr style="background:#468966; color:#FFF0A5;">
                                        <th colspan="9" style="text-align: center;">Total</th>
                                        <th style="text-align:center;"><?='Rp '.number_format($total, 0, ',', '.')?></th>
										<th style="text-align:right;"><?=$remunerasi;?></th>
                                        <th colspan="2"></th>
                                    </tr>-->
                                <?
                                    }
                                ?>
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