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
                    <form>
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

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                <th style="text-align:center; vertical-align:middle;">Area Office</th>
                                <th style="text-align:center; vertical-align:middle;">Unit Produksi</th>
                                <th style="text-align:center; vertical-align:middle;">Jml Agenda</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($agendabinaan as $i => $v) {
                                    if ($v['KDJABATANAGEN'] == "07") {
                                        echo "<tr style='background:#468966; color: #fff;'>";
                                        agen($v, $i, $this->url);
                                        echo "</tr>";
                                    } else if ($v['KDJABATANAGEN'] == "06") {
                                        echo "<tr style='background:#8E2800; color: #fff;'>";
                                        agen($v, $i, $this->url);
                                        echo "</tr>";
                                    } else if ($v['KDJABATANAGEN'] == "02") {
                                        echo "<tr style='background:#FFB03B; color: #000;'>";
                                        agen($v, $i, $this->url);
                                        echo "</tr>";
                                    } else if ($v['KDJABATANAGEN'] == "05") {
                                        echo "<tr style='background:#FFF0A5; color: #000;'>";
                                        agen($v, $i, $this->url);
                                        echo "</tr>";
                                    } else {
                                        echo "<tr>";
                                        agen($v, $i, $this->url);
                                        echo "</tr>";
                                    }
                                }

                                function agen($v, $i, $url) { ?>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td><?=$v['PREFIXAGEN'].'-'.$v['NOAGEN']?></td>
                                    <td><?=$v['NAMAKLIEN1']?></td>
                                    <td><?=$v['NAMAJABATANAGEN']?></td>
                                    <td><?=$v['KDAREAOFFICE'].' - '.$v['NAMAAREAOFFICE']?></td>
                                    <td><?=$v['KDUNITPRODUKSI'].' - '.$v['NAMAUNITPRODUKSI']?></td>
                                    <td align="center"><?=$v['JMLAGENDA']?></td>
                                    <td class="text-center" width="50">
                                    <?php if ($v['JMLAGENDA'] > 0) { ?>
                                        <a href="<?="$url/agenda-binaan?id=".rawurlencode($v['NOAGEN'])."&nm=".rawurlencode(strtolower($v['NAMAKLIEN1']))?>" class="btn btn-xs yellow-gold tooltips btn-edit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><i class="fa fa-search-plus btn-xs-tbl"></i></a>
                                    <?php } else { echo "N/A"; } ?>
                                    </td>
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