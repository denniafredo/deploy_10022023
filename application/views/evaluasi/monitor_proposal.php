<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>


<div class="container">
    sBEGIN PAGE BREADCRUMB -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>

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
                                <?php if($this->session->KDJABATANAGEN != "29") { ?>
                                <div class="col-md-2 col-sm-6 col-xs-6">
                                    <select class="form-control input-sm" name="jabatan" id="jabatan">
                                        <option value=""  <?php if($jbt == '') {echo "selected";} ?>>Semua Jabatan</option>
                                        <option value="26" <?php if($jbt == '26') {echo "selected";} ?>>Business Partner</option>
                                        <option value="25" <?php if($jbt == '25') {echo "selected";} ?>>Business Manager</option>
                                        <option value="24" <?php if($jbt == '24') {echo "selected";} ?>>Business Executive</option>
                                    </select>
                                </div>
                                <?php } ?>
                                <?php if($this->session->KDROLE == 5 || $this->session->KDROLE == 6) { ?>
                                <? if(!empty($daftarkantor)){?>
                                    <div class="col-md-2 col-sm-3 col-xs-3">
                                        <select class="form-control input-sm" name="kantor" id="kantor">
                                            <option value="">Semua Kantor</option>
                                            <?php foreach ($daftarkantor as $datakantor){ ?>
                                                    <option value="<?=$datakantor['KDKANTOR']?>" <?php if($datakantor['KDKANTOR'] == $kdkantor ) { echo "selected";}?>><?=$datakantor['NAMAKANTOR']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <? } ?>
                                    <div class="col-md-2 col-sm-3 col-xs-3">
                                      <!--<input type="text" data-field="date" class="form-control" name="noagenbp" placeholder="noagenbp" value="<?=$noagenbp;?>">-->
                                        <select class="form-control input-sm" name="noagenbp" id="noagenbp">
                                            <option value="">Pilih BP</option>
                                            <?php foreach ($agenbp as $agenbp){ ?>
                                                    <option value="<?=$agenbp['NOAGEN']?>"<?php if($agenbp['NOAGEN'] == $noagenbp ) { echo "selected";}?>><?=$agenbp['NOAGEN'] .' - '.$agenbp['NAMAKLIEN1']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } else {  ?>
                                <?php if(!empty($daftarkantor)){?>
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <select class="form-control input-sm" name="kantor" id="kantor">
                                            <option value="">Semua Kantor</option>
                                            <? foreach ($daftarkantor as $datakantor){ ?>
                                                    <option value="<?=$datakantor['KODE_KANTOR']?>" <?php if($datakantor['KODE_KANTOR'] == $kdkantor ) { echo "selected";}?>><?=$datakantor['NAMAKANTOR']?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
                                <div class="col-md-1 col-sm-4 col-xs-3" align="center">
                                    <button class="btn blue btn-sm" type="submit">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                        <br />
                        <hr />
                        <div class="clearfix"></div>
                        <div class="table-scrollable" style="width: 100%; height: 600px; overflow-y: scroll;">
                            <table class="table table-bordered table-hover" style="font-size: 12px;">
                                <thead>
                                    <?php if($this->session->KDJABATANAGEN == '29') { ?>
                                        <tr>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">No</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Nama</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Kantor Representatif</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">Penawaran</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">SPAJ</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">Proposal</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">Approval</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">Pelunasan</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">Acceptance (polis)</th>
                                            <th colspan="1" style="text-align:center; vertical-align:middle;">Polis Kirim</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">FYP</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Unit Sebawah</th>
                                        </tr>
                                        <tr>
                                            <?php for($i=0;$i<7;$i++){ ?>
                                            <th>Jumlah</th>
                                            <?php } ?>
                                        </tr>
                                    <?php } else { ?>
                                        <tr>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">No</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Nama</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Kantor Representatif</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">Penawaran</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">SPAJ</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">Proposal</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">Approval</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">Pelunasan</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">Acceptance (polis)</th>
                                            <th colspan="2" style="text-align:center; vertical-align:middle;">Polis Kirim</th>
                                            <th rowspan="2" style="text-align:center; vertical-align:middle;">Unit Sebawah</th>
                                        </tr>
                                        <tr>
                                            <?php for($i=0;$i<7;$i++){ ?>
                                            <th>Jumlah</th>
                                            <th>APE</th>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                   <?php $no=0;
                                      $jml_penawaran=0;$anp_penawaran=0;$jml_spaj=0;$anp_spaj=0;$jml_proposal=0;$anp_proposal=0;$jml_approval=0;$anp_approval=0;
                                      $jml_pelunasan=0;$anp_pelunasan=0;$jml_terkirim=0;$anp_terkirim=0;
                                      //$agen_sebawah=0;
                                      foreach($hasilrekap as $datarekap){ 
                                        $no++; 
                                        $color = ''; 
                                        $directDesc= '';
                                        if($this->session->KDJABATANAGEN == '26' || $this->session->KDROLE == 5 || $this->session->KDROLE == 6){
                                            $directFlag = 0;
                                            $directLevel2 = array("25","24","27");
                                            $directLevel3 = array("24","27");
    
                                            if($datarekap["LEVELHIRARKI"] == 1){
                                                $color = '#1877C3'; 
                                            }else if($datarekap["LEVELHIRARKI"] == 2){
                                                $color= '#FA9F83';
                                                if(in_array($datarekap["KDJABATANAGEN"], $directLevel2) ){
                                                    $directFlag= 1;
                                                    $directDesc= 'Direct BP';
                                                    if($datarekap["KDJABATANAGEN"] == '25'){
                                                        $color = '#89D1F8';
                                                    }else{
                                                        $color = '#D0EDFC';
                                                    }
                                                }
                                            }else if ($datarekap["LEVELHIRARKI"] == 3){
                                                $color = '#E2DCFC';
                                                if(in_array($datarekap["KDJABATANAGEN"], $directLevel3)){
                                                    $directFlag = 1;
                                                    $directDesc= 'Direct BM';
                                                    $color = '#FCE3DC';
                                                    if($datarekap["JABATANATASAN"] == '25'){
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
    
                                            if ($jbt == '' || !isset($jbt)){
                                                
                                                if($datarekap['KDJABATANAGEN'] == '26'){
                                                    
                                                    $jml_penawaran = $jml_penawaran + $datarekap['JML_PENAWARAN'];
                                                    $anp_penawaran = $anp_penawaran + $datarekap['ANP_PENAWARAN'];
                                                    $jml_spaj = $jml_spaj + $datarekap['JML_SPAJ'];
                                                    $anp_spaj = $anp_spaj + $datarekap['ANP_SPAJ'];
                                                    $jml_proposal = $jml_proposal + $datarekap['JML_PROPOSAL'];
                                                    $anp_proposal = $anp_proposal + $datarekap['ANP_PROPOSAL'];
                                                    $jml_approval = $jml_approval + $datarekap['JML_APPROVAL'];
                                                    $anp_approval = $anp_approval + $datarekap['ANP_APPROVAL'];
                                                    $jml_pelunasan = $jml_pelunasan + $datarekap['JML_PELUNASAN'];
                                                    $anp_pelunasan = $anp_pelunasan + $datarekap['ANP_PELUNASAN'];
                                                    $jml_terkirim = $jml_terkirim + $datarekap['JML_TERKIRIM'];
                                                    $anp_terkirim = $anp_terkirim + $datarekap['ANP_TERKIRIM'];
                                                }
                                                if($datarekap['KDJABATANAGEN'] == '29') {
                                                    $jml_penawaran = $jml_penawaran + $datarekap['JML_PENAWARAN'];
                                                    $anp_penawaran = $anp_penawaran + $datarekap['ANP_PENAWARAN'];
                                                    $jml_spaj = $jml_spaj + $datarekap['JML_SPAJ'];
                                                    $anp_spaj = $anp_spaj + $datarekap['ANP_SPAJ'];
                                                    $jml_proposal = $jml_proposal + $datarekap['JML_PROPOSAL'];
                                                    $anp_proposal = $anp_proposal + $datarekap['ANP_PROPOSAL'];
                                                    $jml_approval = $jml_approval + $datarekap['JML_APPROVAL'];
                                                    $anp_approval = $anp_approval + $datarekap['ANP_APPROVAL'];
                                                    $jml_pelunasan = $jml_pelunasan + $datarekap['JML_PELUNASAN'];
                                                    $anp_pelunasan = $anp_pelunasan + $datarekap['ANP_PELUNASAN'];
                                                    $jml_terkirim = $jml_terkirim + $datarekap['JML_TERKIRIM'];
                                                    $anp_terkirim = $anp_terkirim + $datarekap['ANP_TERKIRIM'];
                                                    $totalfyp=0;
                                                    $totalfyp += @$datarekap['FYP'];
                                                }
                                            } else {
                                                
                                                    $jml_penawaran = $jml_penawaran + $datarekap['JML_PENAWARAN'];
                                                    $anp_penawaran = $anp_penawaran + $datarekap['ANP_PENAWARAN'];
                                                    $jml_spaj = $jml_spaj + $datarekap['JML_SPAJ'];
                                                    $anp_spaj = $anp_spaj + $datarekap['ANP_SPAJ'];
                                                    $jml_proposal = $jml_proposal + $datarekap['JML_PROPOSAL'];
                                                    $anp_proposal = $anp_proposal + $datarekap['ANP_PROPOSAL'];
                                                    $jml_approval = $jml_approval + $datarekap['JML_APPROVAL'];
                                                    $anp_approval = $anp_approval + $datarekap['ANP_APPROVAL'];
                                                    $jml_pelunasan = $jml_pelunasan + $datarekap['JML_PELUNASAN'];
                                                    $anp_pelunasan = $anp_pelunasan + $datarekap['ANP_PELUNASAN'];
                                                    $jml_terkirim = $jml_terkirim + $datarekap['JML_TERKIRIM'];
                                                    $anp_terkirim = $anp_terkirim + $datarekap['ANP_TERKIRIM'];
                                            }
                                      
                                        
                                       // $agen_sebawah = $agen_sebawah + $datarekap['AGEN_SEBAWAH'];
                                   ?>   
                                        <?php if($this->session->KDJABATANAGEN == '29') { ?>
                                            <tr bgcolor='<?=$color;?>'>
                                                <td><?=$no;?></td>
                                                <td><?=$datarekap['NOAGEN']?></td>
                                                <td><?=$datarekap['NAMAAGEN']?></td>
                                                <td><?=$datarekap['NAMAJABATANAGEN']?></td>
                                                <td><?php $arrktr = explode(" ",$datarekap['NAMAKANTOR']); echo $arrktr[2]; ?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=1&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PENAWARAN']?></a></td>
                                                
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=2&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_SPAJ']?></a></td>
                                               
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=7&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PROPOSAL']?></td>
                                               
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=4&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_APPROVAL']?></a></td>
                                                
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=5&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PELUNASAN']?></a></td>
                                                
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=5&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PELUNASAN']?></a></td>
                                                
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=6&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_TERKIRIM']?></a></td>
                                                
                                                <td><?= number_format(str_replace(',','.',(@$datarekap["FYP"] ? $datarekap["FYP"] : 0)), 2,",",".");?></td>
                                                <td><?=$datarekap['AGEN_SEBAWAH']?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr bgcolor='<?=$color;?>'>
                                                <td><?=$no;?></td>
                                                <td><?=$datarekap['NOAGEN']?></td>
                                                <td><?=$datarekap['NAMAAGEN']?></td>
                                                <td><?=$datarekap['NAMAJABATANAGEN']?></td>
                                                <td><?php $arrktr = explode(" ",$datarekap['NAMAKANTOR']); echo $arrktr[2]; ?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=1&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PENAWARAN']?></a></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_PENAWARAN"])), 2,",",".");?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=2&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_SPAJ']?></a></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_SPAJ"])), 2,",",".");?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=7&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PROPOSAL']?></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_PROPOSAL"])), 2,",",".");?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=4&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_APPROVAL']?></a></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_APPROVAL"])), 2,",",".");?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=5&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PELUNASAN']?></a></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_PELUNASAN"])), 2,",",".");?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=5&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_PELUNASAN']?></a></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_PELUNASAN"])), 2,",",".");?></td>
                                                <td><a href="<?="$this->url/detail-rekap?kddetail=6&noagen=$datarekap[NOAGEN]&kantor=$datarekap[KDKANTORFILTER]&tgawal=$tglawal&tgakhir=$tglakhir"?>" data-container="body" data-placement="top"><?=$datarekap['JML_TERKIRIM']?></a></td>
                                                <td><? echo number_format(str_replace(',','.',($datarekap["ANP_TERKIRIM"])), 2,",",".");?></td>
                                                <td><?=$datarekap['AGEN_SEBAWAH']?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if($this->session->KDJABATANAGEN == '29') { ?>
                                        <tr bgcolor = "#B7E9A5">
                                            <td colspan = 5> TOTAL </td>
                                            <td> <?=$jml_penawaran;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_penawaran)), 2,",",".");?> </td> -->
                                            <td> <?=$jml_spaj;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_spaj)), 2,",",".");?> </td> -->
                                            <td> <?=$jml_proposal;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_proposal)), 2,",",".");?> </td> -->
                                            <td> <?=$jml_approval;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_approval)), 2,",",".");?> </td> -->
                                            <td> <?=$jml_pelunasan;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_pelunasan)), 2,",",".");?> </td> -->
                                            <td> <?=$jml_pelunasan;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_pelunasan)), 2,",",".");?> </td> -->
                                            <td> <?=$jml_terkirim;?> </td>
                                            <!-- <td> <? echo number_format(str_replace(',','.',($anp_terkirim)), 2,",",".");?> </td> -->
                                            <td><?=number_format(str_replace(',','.',($totalfyp)), 2,",",".");?></td>
                                            <td> </td>
                                        </tr>       
                                    <?php } else { ?>
                                        <tr bgcolor = "#B7E9A5">
                                            <td colspan = 5> TOTAL </td>
                                            <td> <?=$jml_penawaran;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_penawaran)), 2,",",".");?> </td>
                                            <td> <?=$jml_spaj;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_spaj)), 2,",",".");?> </td>
                                            <td> <?=$jml_proposal;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_proposal)), 2,",",".");?> </td>
                                            <td> <?=$jml_approval;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_approval)), 2,",",".");?> </td>
                                            <td> <?=$jml_pelunasan;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_pelunasan)), 2,",",".");?> </td>
                                            <td> <?=$jml_pelunasan;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_pelunasan)), 2,",",".");?> </td>
                                            <td> <?=$jml_terkirim;?> </td>
                                            <td> <? echo number_format(str_replace(',','.',($anp_terkirim)), 2,",",".");?> </td>
                                            <td> </td>
                                        </tr>
                                    <?php }?>
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
            // ComponentsPickers.init();
            $("#dtBox").DateTimePicker();
        });
    </script>
    <!-- END JAVASCRIPTS -->