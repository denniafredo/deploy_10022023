<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Prestasi</a>
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
                        <span class="caption-subject font-green-sharp bold uppercase">Top 10 Polis <?=date('Y')?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="form-group">
                        <form>
                            <label class="control-label col-md-2 col-sm-2 col-xs-3" style="margin-top: 5px;">Lingkup</label>
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <select class="form-control input-sm" name="f">
                                    <option value="">Se - Nasional</option>
                                    <?php foreach ($kantor as $i => $v) {
                                        if ($this->input->get('f') == $v['KDKANTOR']) {
                                            echo "<option value='$v[KDKANTOR]' selected>Se - $v[KDKANTOR] ".ucwords(strtolower($v['NAMAKANTOR']))."</option>";
                                        }
                                        else {
                                            echo "<option value='$v[KDKANTOR]'>Se - $v[KDKANTOR] ".ucwords(strtolower($v['NAMAKANTOR']))."</option>";
                                        }
                                    } ?>
                                </select>
                            </div>

                            <div class="col-md-6 col-sm-4 col-xs-3">
                                <button class="btn blue btn-sm" type="submit">Cari !</button>
                            </div>
                        </form>
                    </div>

                    <div class="clearfix"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;"><i class="fa icon-trophy"></i> </th>
                                <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                <th style="text-align:center; vertical-align:middle;">Nama</th>
                                <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                <th style="text-align:center; vertical-align:middle;">Jml Polis</th>
                                <th style="text-align:center; vertical-align:middle;">Jml Premi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($toppolis as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td align="center"><?=$v['NOAGEN']?></td>
                                    <td><?=$v['NAMAKLIEN1']?></td>
                                    <td><?="$v[NAMAKANTOR]"?></td>
                                    <td align="center"><?=$v['JMLPOLIS']?></td>
                                    <td align="right"><?=number_format(str_replace(",", ".", $v['JMLPREMI']), 2, ",", ".")?></td>
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