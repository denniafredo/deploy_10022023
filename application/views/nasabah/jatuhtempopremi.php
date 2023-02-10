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
            <a href="javascript:;">Nasabah</a>
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
                    
                    <!-- <form action="<?="$this->url/binaan"?>" method="get" />
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                                <span class="input-group-btn">
                                    <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                    <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                </span>
                            </div>
                        </div>
                    </form>
 -->
                    <form action="<?="$this->url/jatuhtempopremi_search"?>" method="get">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="input-group col-md-12">
                                        <label class="control-label col-md-2" style="text-align: right;"><b>Jenis Produk : </b></label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="jenisproduk">
                                                <option value="" selected="selected">ALL</option>
                                                <?php 
                                                    foreach($produk as $i => $v) {
                                                        echo "<option value='".$v['NAMAPRODUK']."'>".$v['NAMAPRODUK']."</option>";
                                                    } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-md-12">
                                        <label class="control-label col-md-2" style="text-align: right;"><b>Status Polis : </b></label>
                                        <div class="col-md-8">
                                            <select class="form-control" name="statuspolis">
                                                <option value="" selected="selected">ALL</option>
                                                <option value="1">AKTIF</option>
                                                <option value="4">BPO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-md-12">
                                        <label class="control-label col-md-2" style="text-align: right;"><b>Tgl. Jatuh Tempo : </b></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control form-control-inline input-xs datepicker" size="16" type="text" style="width:297px" name="tglawal" id="tglawal">
                                                <label class="col-md-1" style="padding: 7px 0 0 25px">s/d</label>
                                                <div class="col-md-4">
                                                    <input class="form-control form-control-inline input-xs datepicker" size="16" type="text" style="width:297px" name="tglakhir" id="tglakhir">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-md-12">
                                        <label class="control-label col-md-2"></label>
                                        <div class="col-md-8">
                                            <button class="btn blue tooltips"type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>">
                                            <i class="fa fa-search"></i>
                                            CARI
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
								 <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                <th style="text-align:center; vertical-align:middle;">Produk</th>
                                <th style="text-align:center; vertical-align:middle;">Status</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Telp</th>
                                <th style="text-align:center; vertical-align:middle;">HP</th>
                                <th style="text-align:center; vertical-align:middle;">Premi</th>
                                <th style="text-align:center; vertical-align:middle;">Jatuh Tempo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($jatuhtempo as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td align="center"><?=$v['NOPOLIS']?></td>
									 <td align="center"><?=$v['NOPOLBARU']?></td>
                                    <td><?="$v[NAMAPRODUK]"?></td>
                                    <td align="center"><?=$v['NAMASTATUSFILE']?></td>
                                    <td><?=$v['NAMAKLIEN1']?></td>
                                    <td align="center"><?=$v['PHONETAGIH']?></td>
                                    <td align="center"><?=$v['HP']?></td>
                                    <td align="right"><?=number_format(str_replace(",", ".", $v['PREMITAGIHAN']), 0, ",", ".")?></td>
                                    <td align="center"><?=!empty($v['DTGLBOOKED']) ? "$v[DTGLBOOKED]/$v[MTGLBOOKED]/$v[YTGLBOOKED]" : null;?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url();?>simulasi/assets/scripts/custom/components-pickers.js"></script>
<script type="text/javascript" src="<?= base_url();?>simulasi/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url();?>simulasi/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script>
     $(function () {
        $('.datepicker').datepicker();
     });
    
</script>
