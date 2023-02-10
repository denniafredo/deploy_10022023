<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Kontes</a>
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
                        <i class="fa fa-bullhorn font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Top 12 Premi Reward 156</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <a href="<?="$this->url/polis"?>" class="btn blue"><i class="fa icon-notebook"></i> Polis</a>
                            <a href="javascript:;" class="btn default"><i class="fa icon-badge"></i> Premi</a>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;"><i class="fa icon-trophy"></i> </th>
                                <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                <th style="text-align:center; vertical-align:middle;">Area Office</th>
                                <th style="text-align:center; vertical-align:middle;">Jml Polis</th>
                                <th style="text-align:center; vertical-align:middle;">Jml Premi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($rekrut as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td><?="$v[KDKANTOR] - $v[NAMAKANTOR]"?></td>
                                    <td><?="$v[KDAREAOFFICE]- $v[NAMAAREAOFFICE]"?></td>
                                    <td align="center"><?=$v['JMLPOLIS']?></td>
                                    <td align="right"><?=number_format(str_replace(",", ".", $v['JMLPREMI']), 2, ",", ".")?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <form method="get">
                        <?php if (!isset($noagen) && !isset($pesen)) { ?> <input type="text" name="noagen" style="border:none;" />
                        <?php } else if (isset($noagen)) { echo $noagen; ?> <input type="hidden" name="noagen" value="<?=$noagen?>" style="border:none;" />
                            <select name="kdkelas" style="border:none;"><option value="2">2F</option><option value="1">1B</option><option value="3">3B</option></select>
                            <input type="submit" style="background:none;border:none;" value="JAIM" />
                        <?php } else if (isset($pesen)) { echo $pesen; } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 0.01px;
        text-overflow: '';
    }
</style>