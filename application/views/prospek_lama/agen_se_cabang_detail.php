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
            <a href="<?="$this->url/agen-se-cabang"?>">Prospek Agen</a>
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
                        <i class="fa icon-doc font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Data Prospek <?=ucwords(str_replace('-', ' ', $this->input->get('nm')))." ".$this->input->get('id')?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="hidden" name="id" value="<?=$this->input->get('id')?>" />
                            <input type="hidden" name="nm" value="<?=$this->input->get('nm')?>" />
                            <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                            <span class="input-group-btn">
                                <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                <a href="<?="$this->url/agen-se-cabang-detail?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                <a href="<?="$this->url/agen-se-cabang"?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                            </span>
                        </div>
                    </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">Rayon</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                <th style="text-align:center; vertical-align:middle;">Kota</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Lahir</th>
                                <th style="text-align:center; vertical-align:middle;">HP</th>
                                <th style="text-align:center; vertical-align:middle;">Telp</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($prospek as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td align="center"><?=$v['KDKANTOR']?></td>
                                    <td><?=$v['NAMA']?></td>
                                    <td><?=$v['ALAMAT']?></td>
                                    <td><?=$v['KOTA']?></td>
                                    <td><?=$v['TGLLAHIR']?></td>
                                    <td align="center"><?=$v['TELP']?></td>
                                    <td align="center"><?=$v['HP']?></td>
                                    <td class="text-center" width="38">
                                        <a href="<?="$this->url/proposal-se-cabang?id=".$this->input->get('id')."&nm=".rawurlencode($this->input->get('nm'))."&np=$v[NOPROSPEK]"?>" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="Proposal"><i class="fa fa-search-plus btn-xs-tbl"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        $("input[name='s']").focus();
    });
</script>
<!-- END JAVASCRIPTS -->