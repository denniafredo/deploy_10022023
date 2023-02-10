<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<style type="text/css">
    .table, .table thead tr th {
        font-size: 8px;
    }
</style>

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
                            <label class="control-label col-md-2" style="margin-top: 5px;">Cabang</label>
                            <div class="col-md-4">
                                <select class="form-control input-sm" name="txtCabang">
                                    <option>-- Silahkan Pilih --</option>
                                    <?php foreach ($cabang as $i => $v) {
                                        if ($this->input->get('txtCabang') == $v['KDKANTOR']) {
                                            echo "<option value='$v[KDKANTOR]' selected>$v[KDKANTOR] - ".ucwords(strtolower($v['NAMAKANTOR']))."</option>";
                                        }
                                        else {
                                            echo "<option value='$v[KDKANTOR]'>$v[KDKANTOR] - ".ucwords(strtolower($v['NAMAKANTOR']))."</option>";
                                        }
                                    } ?>
                                </select>
                            </div>

                            <label class="control-label col-md-2" style="margin-top: 5px;">Periode Evaluasi</label>
                            <div class="col-md-4">
                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                    <input type="text" class="form-control" name="txtTglAwal" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAwal')?>" readonly>
                                    <span class="input-group-addon">
                                    to </span>
                                    <input type="text" class="form-control" name="txtTglAkhir" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAkhir')?>" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn blue" type="submit">Cari !</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align:middle;">No</th>
                                <th rowspan="3" style="text-align:center; vertical-align:middle;">No Agen</th>
                                <th rowspan="3" style="text-align:center; vertical-align:middle;">Nama</th>
                                <th rowspan="3" style="text-align:center; vertical-align:middle;">Jabatan</th>
                                <th colspan="2" style="text-align:center; vertical-align:middle;">Target</th>
                                <th colspan="6" style="text-align:center; vertical-align:middle;">Realisasi</th>
                                <th colspan="2" style="text-align:center; vertical-align:middle;">Rasio (%)</th>
                            </tr>
                            <tr>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Premi NB</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                <th colspan="5" style="text-align:center;">Premi NB</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                <th rowspan="2" style="text-align:center; vertical-align:middle;">Premi NB</th>
                            </tr>
                            <tr>
                                <th>Sekaligus</th>
                                <th>Berkala</th>
                                <th>Berkala (L)</th>
                                <th>Top Up</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style='background:#8E2800; color: #fff;'>
                                <td align='center' colspan='14'><b><?=$kantor['NAMAKANTOR']?></b></td>
                            </tr>

                            <?php
                            $sum_pls = 0;
                            $sum_prmx = 0;
                            $sum_prmb = 0;
                            $sum_prmbl = 0;
                            $sum_prmtu = 0;
                            $sum_pls_ao = 0;
                            $sum_prmx_ao = 0;
                            $sum_prmb_ao = 0;
                            $sum_prmbl_ao = 0;
                            $sum_prmtu_ao = 0;
                            $sum_pls_up = 0;
                            $sum_prmx_up = 0;
                            $sum_prmb_up = 0;
                            $sum_prmbl_up = 0;
                            $sum_prmtu_up = 0;
                            $flag_area = 0;
                            $flag_unit = 0;
                            $tglawal = $this->input->get('txtTglAwal');
                            $tglakhir = $this->input->get('txtTglAkhir');

                            // jika tanggal awal dan akhir berisi nilai
                            if (!empty($tglawal) && !empty($tglakhir)) {
                                foreach($evaluasi as $i => $v) {
                                    $sum_pls += $v['REALISASI_POLIS'];
                                    $sum_prmx += desimal($v['REALISASI_PREMIX']);
                                    $sum_prmb += desimal($v['REALISASI_PREMIB']);
                                    $sum_prmbl += desimal($v['REALISASI_PREMIBL']);
                                    $sum_prmtu += desimal($v['REALISASI_PREMITOPUP']);

                                    if (!empty($v['KDAREAOFFICE']) && !$flag_area) {
                                        $flag_area = 1;
                                    }
                                    if (!empty($v['KDUNITPRODUKSI']) && !$flag_unit) {
                                        $flag_unit = 1;
                                    }

                                    if ($flag_area) {
                                        $sum_pls_ao += $v['REALISASI_POLIS'];
                                        $sum_prmx_ao += desimal($v['REALISASI_PREMIX']);
                                        $sum_prmb_ao += desimal($v['REALISASI_PREMIB']);
                                        $sum_prmbl_ao += desimal($v['REALISASI_PREMIBL']);
                                        $sum_prmtu_ao += desimal($v['REALISASI_PREMITOPUP']);
                                    }
                                    if ($flag_unit) {
                                        $sum_pls_up += $v['REALISASI_POLIS'];
                                        $sum_prmx_up += desimal($v['REALISASI_PREMIX']);
                                        $sum_prmb_up += desimal($v['REALISASI_PREMIB']);
                                        $sum_prmbl_up += desimal($v['REALISASI_PREMIBL']);
                                        $sum_prmtu_up += desimal($v['REALISASI_PREMITOPUP']);
                                    }

                                    // nama area / unit
                                    if (empty($v['NOAGEN']) && empty($v['KDUNITPRODUKSI'])) {
                                        echo "<tr style='background:#FFB03B; color: #000;'>";
                                        echo "<td align='center' colspan='14'><b>$v[KDAREAOFFICE] - $v[NAMAAREAOFFICE]</b></td>";
                                        echo "</tr>";
                                    }
                                    else if (empty($v['NOAGEN']) && !empty($v['KDUNITPRODUKSI'])) {
                                        echo "<tr style='background:#FFF0A5; color: #000;'>";
                                        echo "<td align='center' colspan='14'><b>$v[KDUNITPRODUKSI] - $v[NAMAUNITPRODUKSI]</b></td>";
                                        echo "</tr>";

                                        $sum_pls_up = 0;
                                        $sum_prmx_up = 0;
                                        $sum_prmb_up = 0;
                                        $sum_prmbl_up = 0;
                                        $sum_prmtu_up = 0;
                                    }
                                    else if ($v['NOAGEN'] == '9999999999' && $v['KDUNITPRODUKSI'] == 'XXX') {
                                        echo "<tr style='background:#FFB03B; color: #000;'>";
                                        total_area("TOTAL SE $v[KDAREAOFFICE] - $v[NAMAAREAOFFICE]", $v, $sum_pls_ao, $sum_prmx_ao, $sum_prmb_ao, $sum_prmbl_ao, $sum_prmtu_ao);
                                        echo "</tr>";
                                        echo "<tr><td colspan='14'>&nbsp;</td></tr>";

                                        $sum_pls_ao = 0;
                                        $sum_prmx_ao = 0;
                                        $sum_prmb_ao = 0;
                                        $sum_prmbl_ao = 0;
                                        $sum_prmtu_ao = 0;
                                    }
                                    else if ($v['NOAGEN'] == '9999999999' && $v['KDJABATANAGEN'] == '0') {
                                        echo "<tr style='background:#FFF0A5; color: #000;'>";
                                        total_area("TOTAL SE $v[KDUNITPRODUKSI] - $v[NAMAUNITPRODUKSI]", $v, $sum_pls_up, $sum_prmx_up, $sum_prmb_up, $sum_prmbl_up, $sum_prmtu_up);
                                        echo "</tr>";
                                        echo "<tr><td colspan='14'></td></tr>";

                                        $sum_pls_up = 0;
                                        $sum_prmx_up = 0;
                                        $sum_prmb_up = 0;
                                        $sum_prmbl_up = 0;
                                        $sum_prmtu_up = 0;
                                    }

                                    // data agen berdasarkan jabatan
                                    else if ($v['KDJABATANAGEN'] == "06") {
                                        echo "<tr style='background:#8E2800; color: #fff;'>";
                                        agen($v);
                                        echo "</tr>";
                                    }
                                    else if ($v['KDJABATANAGEN'] == "02") {
                                        echo "<tr style='background:#FFB03B; color: #000;'>";
                                        agen($v);
                                        echo "</tr>";
                                    }
                                    else if ($v['KDJABATANAGEN'] == "05") {
                                        echo "<tr style='background:#FFF0A5; color: #000;'>";
                                        agen($v);
                                        echo "</tr>";
                                    }
                                    else if (!empty($v['NOAGEN']) && $v['NOAGEN'] != '9999999999') {
                                        echo "<tr>";
                                        agen($v);
                                        echo "</tr>";
                                    }
                                }

                                ?>
                                <tr style='background:#8E2800; color: #fff;'>
                                    <td colspan='4'><b>TOTAL SE <?=$kantor['NAMAKANTOR']?></b></td>
                                    <td align="center"><?=number_format($kantor['TARGET_POLIS'], 0, ',', '.')?></td>
                                    <td align="right"><?=number_format($kantor['TARGET_NB'], 2, ',', '.')?></td>
                                    <td align="center"><?=number_format($sum_pls, 0, ',', '.')?></td>
                                    <td align="right"><?=number_format($sum_prmx, 2, ',', '.')?></td>
                                    <td align="right"><?=number_format($sum_prmb, 2, ',', '.')?></td>
                                    <td align="right"><?=number_format($sum_prmbl, 2, ',', '.')?></td>
                                    <td align="right"><?=number_format($sum_prmtu, 2, ',', '.')?></td>
                                    <td align="right"><?=number_format($sum_prmx+$sum_prmb+$sum_prmbl+$sum_prmtu, 2, ',', '.')?></td>
                                    <td align="center"><?=($kantor['TARGET_POLIS'] > 0 ? number_format($sum_pls/$kantor['TARGET_POLIS']*100, 2, ",", ".") . "%" : null)?></td>
                                    <td align="center"><?=($kantor['TARGET_NB'] > 0 ? number_format(($sum_prmx+$sum_prmb+$sum_prmbl+$sum_prmtu)/$kantor['TARGET_NB']*100, 2, ",", ".") . "%" : null)?></td>
                                </tr>
                                <?php
                            }

                            function agen($v) {
                                $nomor = trim($v['KDAREAOFFICE'])
                                    . trim((!empty($v['KDUNITPRODUKSI']) ? ".$v[KDUNITPRODUKSI]" : "$v[KDUNITPRODUKSI]"))
                                    . ($v['KDJABATANAGEN'] == "00" ? ".MA" : null);
                                ?>
                                <td nowrap align="center"><?=$nomor?></td>
                                <td><?=$v['PREFIXAGEN']?>-<?=$v['NOAGEN']?></td>
                                <td nowrap><?=$v['NAMAKLIEN1']?></td>
                                <td nowrap><?=$v['NAMAJABATANAGEN']?></td>
                                <td align="center"><?=$v['TRGPOLISNBPPHEAD']?></td>
                                <td align="right"><?=number_format($v['TRGPREMINBPPHEAD'], 2, ",", ".")?></td>
                                <td align="center"><?=$v['REALISASI_POLIS']?></td>
                                <td align="right"><?=number_format(desimal($v['REALISASI_PREMIX']), 2, ",", ".")?></td>
                                <td align="right"><?=number_format(desimal($v['REALISASI_PREMIB']), 2, ",", ".")?></td>
                                <td align="right"><?=number_format(desimal($v['REALISASI_PREMIBL']), 2, ",", ".")?></td>
                                <td align="right"><?=number_format(desimal($v['REALISASI_PREMITOPUP']), 2, ",", ".")?></td>
                                <td align="right"><?=number_format(desimal($v['REALISASI_PREMIX'])+desimal($v['REALISASI_PREMIB'])+desimal($v['REALISASI_PREMIBL'])+desimal($v['REALISASI_PREMITOPUP']), 2, ",", ".")?></td>
                                <td align="center"><?=($v['TRGPOLISNBPPHEAD'] > 0 ? number_format($v['REALISASI_POLIS']/$v['TRGPOLISNBPPHEAD']*100, 2, ",", ".") . "%" : null)?></td>
                                <td align="center"><?=($v['TRGPREMINBPPHEAD'] > 0 ? number_format((desimal($v['REALISASI_PREMIX'])+desimal($v['REALISASI_PREMIB'])+desimal($v['REALISASI_PREMIBL'])+desimal($v['REALISASI_PREMITOPUP']))/$v['TRGPREMINBPPHEAD']*100, 2, ",", ".") . "%" : null)?></td>
                            <?php }

                            function total_area($nama, $v, $sum_pls, $sum_prmx, $sum_prmb, $sum_prmbl, $sum_prmtu) { ?>
                                <td colspan='4'><b><?=$nama?></b></td>
                                <td align="center"><?=($v['TRGPOLISNBPPORG'] > 0 ? number_format($v['TRGPOLISNBPPORG'], 0, ',', '.') : null)?></td>
                                <td align="right"><?=($v['TRGPREMINBPPORG'] > 0 ? number_format($v['TRGPREMINBPPORG'], 2, ',', '.') : null)?></td>
                                <td align="center"><?=number_format($sum_pls, 0, ',', '.')?></td>
                                <td align="right"><?=number_format($sum_prmx, 2, ',', '.')?></td>
                                <td align="right"><?=number_format($sum_prmb, 2, ',', '.')?></td>
                                <td align="right"><?=number_format($sum_prmbl, 2, ',', '.')?></td>
                                <td align="right"><?=number_format($sum_prmtu, 2, ',', '.')?></td>
                                <td align="right"><?=number_format($sum_prmx+$sum_prmb+$sum_prmbl+$sum_prmtu, 2, ',', '.')?></td>
                                <td align="center"><?=($v['TRGPOLISNBPPORG'] > 0 ? number_format($sum_pls/$v['TRGPOLISNBPPORG']*100, 2, ",", ".") . "%" : null)?></td>
                                <td align="center"><?=($v['TRGPREMINBPPORG'] > 0 ? number_format(($sum_prmx+$sum_prmb+$sum_prmbl+$sum_prmtu)/$v['TRGPREMINBPPORG']*100, 2, ",", ".") . "%" : null)?></td>
                            <?php }

                            // fungsi untuk mengganti comma menjadi titik agar terbaca oleh php sebagai desimal
                            function desimal($bilangan) {
                                return str_replace(',', '.', $bilangan);
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