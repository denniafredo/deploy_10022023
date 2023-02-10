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
                            <label class="control-label col-md-1 col-sm-2 col-xs-3" style="margin-top: 5px;">Periode</label>
                             <div class="col-md-4">
                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
									<input type="text" data-field="date" class="form-control" name="txtTglAwal" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAwal')?>" readonly>
                                    <span class="input-group-addon">
                                    to </span>
                                    <input type="text" data-field="date" class="form-control" name="txtTglAkhir" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAkhir')?>" readonly>
                                </div>
                            </div>
							<?php if($this->session->KDROLE == 5 || $this->session->KDROLE == 6) { ?>
							<? if(!empty($daftarkantor)){?>
                                <div class="col-md-2 col-sm-3 col-xs-3">
                                    <select class="form-control input-sm" name="kantor" id="kantor">
                                        <option value="">Semua Kantor</option>
                                        <?php foreach ($daftarkantor as $datakantor){ ?>
                                                <option value="<?=$datakantor["KDKANTOR"]?>" <?php if($datakantor["KDKANTOR"] == $kdkantor ) { echo "selected";}?>><?= $datakantor["NAMAKANTOR"];?></option>
                                        <? } ?>
                                    </select>
                                </div>
								<? } ?>
								<div class="col-md-2 col-sm-3 col-xs-3">
								  <!--<input type="text" data-field="date" class="form-control" name="noagenbp" placeholder="noagenbp" value="<?=$noagenbp;?>">-->
                                    <select class="form-control input-sm" name="noagenbp" id="noagenbp">
                                        <option value="">Pilih BP</option>
                                        <? foreach ($agenbp as $agenbp){ ?>
                                                <option value="<?=$agenbp['NOAGEN']?>"<?php if($agenbp['NOAGEN'] == $noagenbp ) { echo "selected";}?>><?=$agenbp['NOAGEN'] .' - '.$agenbp['NAMAKLIEN1']?></option>
                                        <? } ?>
                                    </select>
                                </div>
							<?php }  ?>
                            <div class="col-md-1 col-sm-4 col-xs-3" align="center">
                                <button class="btn blue btn-sm" type="submit">Tampilkan</button>
                            </div>
                        </form>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" id="datakomisi" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="text-align:center; vertical-align:middle;">No</th>
                                    <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
									<th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                    <th style="text-align:center; vertical-align:middle;">Pempol</th>
                                    <th style="text-align:center; vertical-align:middle;">Kantor Representatif</th>
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
                                <tr style="background:#468966; color:#FFF0A5;">
                                     <th colspan="14" style="text-align: center;"><!-- <?if(!empty($pendapatan)){ echo $pendapatan[0]["NAMAKANTOR"]; }?> --></th>
                                </tr>
                                <?php
                                    $total = 0;
                                    $flag_area = 0;
                                    $flag_unit = 0;
                                    $noagen = 0;
                                    $nomor = 0;
									$totalsub = 0;
                                    // /print_r($pendapatan);
                                    foreach($pendapatan as $i => $v) {
                                        $nomor++;
										$total += $v['KOMISIAGENRP'];
										$totalsub += $v['KOMISIAGENRP'];
                                        
                                        if ($v['KDJABATANAGEN'] == "02") {
                                            echo "<tr style='background:#FFB03B; color: #000;'>";
                                        }
                                        else if ($v['KDJABATANAGEN'] == "05") {
                                            echo "<tr style='background:#FFF0A5; color: #000;'>";
                                        }
                                         else if ($v['KDJABATANAGEN'] == "19") {
                                            echo "<tr style='background:#69B7EA; color: #000;'>";
                                        }
                                        else if (!empty($v['NOAGEN']) && $v['NOAGEN'] != '9999999999') {
                                            echo "<tr>";
                                        }
                                        echo "<td align='center'>".$nomor."</td>";
                                        agen($v);
                                        echo "</tr>";
										
										if($totalsub >= 0) {
											if(@$pendapatan[$i+1]['NOAGEN'] != $v['NOAGEN']) {
												subtotal($totalsub);
												$totalsub = 0;	
											}
										}
										
                                    }

                                    function agen($v) {
                                    ?>
                                        <td align="center"><?=$v['PREFIXPERTANGGUNGAN']?>-<?=$v['NOPERTANGGUNGAN']?></td>
										<td><?=$v['NOPOLBARU']?></td>
                                        <td><?=$v['NAMAPEMPOL']?></td>
                                        <td><?=$v['KTRREPRESENTATIF']?></td>
                                        <td align="center"><?=$v['NOAGEN']?></td>
                                        <td><?=$v['NAMAKLIEN1']?></td>
                                        <td align="center"><?=$v['NOREKENING']?></td>
                                        <td><?=$v['NAMAKOMISIAGEN']?></td>
                                        <td><?=$v['CARABAYAR']?></td>
                                        <td align="center"><?=$v['THNKOMISI']?></td>
                                        <td align="right"><?=number_format($v['KOMISIAGENRP'], 0, ',', '.')?></td>
                                        <td align="center"><?=$v['TGLBOOKED']?></td>
                                        <td align="center"><?=$v['TGLPROSES']?></td>
                                    <?
                                    }
									
									function subtotal($totalsub) { ?>
									<tr style="background:#468966; color:#FFF0A5;">
                                        <th colspan="11" style="text-align: center;">Sub KOMISI</th>
                                        <th style="text-align:right;"><?=number_format($totalsub, 0, ',', '.')?></th>
                                        <th colspan="2"></th>
									</tr>
									<?
																	
									}
									
                                    if ($total > 0) { ?>
                                    <tr style="background:#468966; color:#FFF0A5;">
                                        <th colspan="11" style="text-align: center;">TOTAL KOMISI</th>
                                        <th style="text-align:right;"><?=number_format($total, 0, ',', '.')?></th>
                                        <th colspan="2"></th>
                                    </tr>
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
		// $('#datakomisi').DataTable({
		// 	"pagingType": "simple" // "simple" option for 'Previous' and 'Next' buttons only
		// });
		// $('.dataTables_length').addClass('bs-select');
    jQuery(document).ready(function() {
        //ComponentsPickers.init();
        $("#dtBox").DateTimePicker();
		
		
    });
</script>
<!-- END JAVASCRIPTS -->