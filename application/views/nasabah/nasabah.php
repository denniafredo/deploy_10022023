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
                    <form action="<?="$this->url"?>" method="get" />
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
                                <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
                                <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Lahir</th>
                                <th style="text-align:center; vertical-align:middle;">Telp</th>
                                <th style="text-align:center; vertical-align:middle;">HP</th>
                                <th style="text-align:center; vertical-align:middle;">Polis</th>
                                <th style="text-align:center; vertical-align:middle;">Premi</th>
                                <th style="text-align:center; vertical-align:middle;">Usia</th>
                                <th style="text-align:center; vertical-align:middle;">Mulai</th>
                                <th style="text-align:center; vertical-align:middle;">Ekspirasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($nasabah as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$v['NO']?></td>
                                    <td align="center"><?=$v['NOPOLIS']?></td>
                                    <td align="center"><?=$v['NOPOLBARU']?></td>
                                    <td><?=$v['NAMAKLIEN1']?></td>
                                    <td><?=$v['ALAMAT']?></td>
                                    <td><?=$v['TGLLAHIR']?></td>
                                    <td align="center"><?=$v['PHONETAGIH01']?></td>
                                    <td align="center"><?=$v['PHONETAGIH02']?></td>
                                    <td><?=$v['POLIS']?></td>
                                    <td align="right"><?=number_format(str_replace(",", ".", $v['PREMI1']), 0, ",", ".")?></td>
                                    <td align="center"><?=$v['USIA']?></td>
                                    <td align="center"><?=$v['MULAS']?></td>
                                    <td align="center"><?=$v['AKLAS']?></td>
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