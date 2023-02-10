<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
<div class="container"> 
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
                    <? if(!empty($daftarkantor)){ ?>
                        <div class="form-group">
                            <form>
                                <label class="control-label col-md-2 col-sm-2 col-xs-3" style="margin-top: 5px;">Coverage ASC</label>
                                <div class="col-md-4 col-sm-6 col-xs-6">
                                    <select class="form-control input-sm" name="kantor" id="kantor">
                                        <option value="">Pilih ASC</option>
                                        <? foreach ($daftarkantor as $datakantor){ ?>
                                                <option value="<?=$datakantor['KODE_KANTOR']?>"><?=$datakantor['NAMAKANTOR']?></option>
                                        <? } ?>
                                    </select>
                                </div>

                                <div class="col-md-6 col-sm-4 col-xs-3">
                                    <button class="btn blue btn-sm" type="submit">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                    <? } ?>
                        
                    <div class="clearfix"></div>
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">No</th>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">No Agen</th>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">Nama</th>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">Jabatan</th>
                                    <th colspan="2" style="text-align:center; vertical-align:middle;">Agen Rekrut</th>
                                    <th colspan="2" style="text-align:center; vertical-align:middle;">Validasi</th>
                                    <th colspan="5" style="text-align:center; vertical-align:middle;">Realisasi</th>
                                    <th colspan="3" style="text-align:center; vertical-align:middle;">Total</th>
                                    <th colspan="2" style="text-align:center; vertical-align:middle;">Rasio</th>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">Current Persistence (by Polis)</th>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">Pembatalan Polis</th>
                                    <th rowspan="3" style="text-align:center; vertical-align:middle;">Keterangan</th>
                                </tr>
                                <tr>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">Total</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">Berlisensi</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">ANP</th>
                                    <th colspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                    <th colspan="2" style="text-align:center; vertical-align:middle;">ANP</th>
                                    <th  style="text-align:center; vertical-align:middle;">Topup</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">ANP</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">Formasi</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">Polis</th>
                                    <th rowspan="2" style="text-align:center; vertical-align:middle;">ANP</th>
                                </tr>
                                <tr>
                                    <th>Sekaligus</th>
                                    <th>Berkala</th>
                                    <th>Sekaligus</th>
                                    <th>Berkala</th>
                                    <th>Sekaligus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style='background:#8E2800; color: #fff;'>
                                    <td align='center' colspan='21'><b><?=($evaluasi ? $evaluasi[0]['NAMAKANTOR'] : null)?></b></td>
                                </tr>
                                <? $no=0; foreach ($evaluasi as $dataeval){ 
                                    $totalpolis = $dataeval["POLIS_SEKALIGUS"] + $dataeval["POLIS_BERKALA"];
                                    $totalpremi = (0.1 * $dataeval["TOPUP_SEKALIGUS"])+ (0.1 * $dataeval["PREMI_SEKALIGUS"]) + ($dataeval["PREMI_BERKALA"]); 
                                    $no++;
                                    $color = ''; 
                                    $directDesc= '';
                                    if($this->session->KDJABATANAGEN == '19'){
                                        $directFlag = 0;
                                        $directLevel2 = array("00","09","05");
                                        $directLevel3 = array("00","09");

                                        if($dataeval["LEVELHIRARKI"] == 1){
                                            $color = '#1877C3'; 
                                        }else if($dataeval["LEVELHIRARKI"] == 2){
                                            $color= '#FA9F83';
                                            if(in_array($dataeval["KDJABATANAGEN"], $directLevel2) ){
                                                $directFlag= 1;
                                                $directDesc= 'Direct SAM';
                                                if($dataeval["KDJABATANAGEN"] == '05'){
                                                    $color = '#89D1F8';
                                                }else{
                                                    $color = '#D0EDFC';
                                                }
                                            }
                                        }else if ($dataeval["LEVELHIRARKI"] == 3){
                                            $color = '#E2DCFC';
                                            if(in_array($dataeval["KDJABATANAGEN"], $directLevel3)){
                                                $directFlag = 1;
                                                $directDesc= 'Direct AM';
                                                $color = '#FCE3DC';
                                                if($dataeval["JABATANATASAN"] == '05'){
                                                    $color = '#FFFFFF';
                                                    $directDesc= '';
                                                    $directFlag = 0;
                                                }
                                            }
                                        }else{
                                            $color = '#FFFFFF';
                                            $directDesc= '';
                                        }
                                    }
                                ?>
                                    <tr bgcolor='<?=$color;?>'>
                                        <td nowrap align="center"><?=$no;?></td>
                                        <td nowrap align="center"><?=$dataeval["NOAGEN"]?></td>
                                        <td nowrap align="center"><?=$dataeval["NAMAAGEN"]?></td>
                                        <td nowrap align="center"><?=$dataeval["NAMAJABATANAGEN"]?></td>
                                        <td nowrap align="center"><?=$dataeval["TOTALREKRUT"]?></td>
                                        <td nowrap align="center"><?=$dataeval["REKRUTBERLISENSI"]?></td>
                                        <td nowrap align="center"><?=$dataeval["TARGET_POLIS"]?></td>
                                        <td nowrap align="center"><?=$dataeval["TARGET_PREMI"] > 0 ? number_format(str_replace(',','.',$dataeval["TARGET_PREMI"]), 2,",",".") : ""?></td>
                                        <td nowrap align="center"><?=$dataeval["POLIS_SEKALIGUS"]?></td>
                                        <td nowrap align="center"><?=$dataeval["POLIS_BERKALA"]?></td>
                                        <td nowrap align="center"><? echo number_format(str_replace(',','.',(0.1 * $dataeval["PREMI_SEKALIGUS"])), 2,",",".");?></td>
                                        <td nowrap align="center"><? echo number_format(str_replace(',','.',($dataeval["PREMI_BERKALA"])), 2,",",".");?></td>
                                        <td nowrap align="center"><? echo number_format(str_replace(',','.',(0.1 * $dataeval["TOPUP_SEKALIGUS"])), 2,",",".");?></td>
                                        <td nowrap align="center"><?=$totalpolis;?></td>
                                        <td nowrap align="center"><? echo number_format(str_replace(',','.',$totalpremi), 2,",",".");?></td>
                                        <td nowrap align="center"><?=$dataeval["FORMASI"]?></td>
                                        <td nowrap align="center"><?=$dataeval["TARGET_POLIS"] > 0 ? number_format(str_replace(',','.',($totalpolis / $dataeval["TARGET_POLIS"] * 100)), 2,",",".")."%" : ""?></td>
                                        <td nowrap align="center"><?=$dataeval["TARGET_PREMI"] > 0 ? number_format(str_replace(',','.',($totalpremi / $dataeval["TARGET_PREMI"] * 100)), 2,",",".")."%" : ""?></td>
                                        <td nowrap align="center"> 
                                        <? 
                                            if($dataeval["PREMI_PERSISTENSI"] == 0 || empty($dataeval["PREMI_PERSISTENSI"])){
                                                $persistensi = 0;
                                            }else{
                                                $persistensi = ($dataeval["PREMI_PERSISTENSI"] - $dataeval["BATAL_TAHUN_LALU"])/$dataeval["PREMI_PERSISTENSI"] * 100;
                                            }
                                            echo number_format(str_replace(',','.',$persistensi), 2,",",".")."%";
                                        ?> 
                                        </td>
                                        <td nowrap align="center">
                                        <?
                                            if($dataeval["PREMI_BERKALA"] == 0 || empty($dataeval["PREMI_BERKALA"])){
                                                $batal = 0;
                                            }else{
                                                $batal = $dataeval["PREMI_BATAL_TEBUS"] / $dataeval["PREMI_BERKALA"] * 100;
                                            }
                                            echo number_format(str_replace(',','.',$batal), 2,",",".")."%";
                                        ?>
                                        </td>
                                        <td nowrap align="center">
                                            <? echo $directDesc; ?>
                                        </td>
                                    </tr>
                                <?
                                }?>
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