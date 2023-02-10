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
                        <span class="caption-subject font-green-sharp bold uppercase">Proposal </?=$prospek['NAMA']?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="btn-group btn-group-solid pull-right">
                        <a href="<?="$this->url/binaan-detail?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                    </div>

                    <div class="clearfix margin-bottom-10"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Proposal</th>
                                <th style="text-align:center; vertical-align:middle;">Produk</th>
                                <th style="text-align:center; vertical-align:middle;">Cara Bayar</th>
                                <th style="text-align:center; vertical-align:middle;">Premi</th>
                                <th style="text-align:center; vertical-align:middle;">Status</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Rekam</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($proposal as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td align="center"><?=$v['NOPROPOSAL']?></td>
                                    <td><?=$v['NAMA_PRODUK']?></td>
                                    <td><?=$v['CARA_BAYAR']?></td>
                                    <td align="right"><?=number_format(str_replace(",", ".", $v['JUMLAH_PREMI']), 0, ",", ".")?></td>
                                    <td align="center"><?=$v['NAMASTATUS']?></td>
                                    <td align="center"><?=$v['TGLREKAM']?></td>
                                    <td class="text-center" width="76">
                                        <a href="<?="$this->url/follow-up-proposal-binaan?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))."&np=$prospek[NOPROSPEK]&pr=$v[NOPROPOSAL]"?>" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="Follow Up"><i class="fa fa-search-plus btn-xs-tbl"></i></a>
                                        <a href="<?=base_url("simulasi/files/pdf/$v[FILE_PDF]")?>" class="btn btn-xs blue tooltips" target="_blank" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><i class="fa fa-file-pdf-o btn-xs-tbl"></i></a>
                                    </td>
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