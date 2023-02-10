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
            <a href="<?="$this->url/binaan"?>">Prospek Binaan</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?="$this->url/binaan-detail?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))?>"><?=ucwords(str_replace('-', ' ', $this->input->get('nm')))?></a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?="$this->url/proposal-binaan?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))."&np=".$this->input->get('np')?>">Proposal</a>
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
                        <span class="caption-subject font-green-sharp bold uppercase">Historis Follow Up</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="btn-group btn-group-solid pull-right">
                        <a href="<?="$this->url/proposal-binaan?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))."&np=".$this->input->get('np')?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                    </div>

                    <div class="clearfix margin-bottom-10"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;width:50px;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Status</th>
                                <th style="text-align:center; vertical-align:middle;width:1%;" colspan="2">Oleh</th>
                                <th style="text-align:center; vertical-align:middle;width:1%;">Tanggal</th>
                                <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($followup as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td><?=$v['NAMASTATUS']?></td>
                                    <td nowrap><?=ucwords(strtolower($v['NAMAKLIEN1']))?></td>
                                    <td nowrap><?=$v['OLEH']?></td>
                                    <td nowrap><?=$v['TGLREKAM']?></td>
                                    <td><?=$v['KETERANGAN']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>