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
                    <form action="<?="$this->url/binaan"?>" method="get" />
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
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Lahir</th>
                                <th style="text-align:center; vertical-align:middle;">Telp</th>
                                <th style="text-align:center; vertical-align:middle;">HP</th>
                                <th style="text-align:center; vertical-align:middle;">Usia</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($ultah as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1;?></td>
                                    <td><?=$v['NAMAKLIEN1']?></td>
                                    <td><?=$v['ALAMAT']?></td>
                                    <td><?=!empty($v['DLAHIR']) ? "$v[DLAHIR]/$v[MLAHIR]/$v[YLAHIR]" : null;?></td>
                                    <td align="center"><?=$v['PHONETAGIH']?></td>
                                    <td align="center"><?=$v['HP']?></td>
                                    <td align="center"><?=$v['USIA']?></td>
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