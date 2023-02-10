<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<!-- END PAGE LEVEL STYLES -->

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
                    <form action="<?=base_url("prospek/download-prospek-se-kapus-excel")?>">
                        <label class="control-label col-md-2" style="margin-top: 5px;">Kantor</label>
                        <div class="col-md-4">
                            <select class="form-control" name="ktr">
                                <option value="">ALL - Pilih Semua Kantor</option>
                                <?php foreach ($cabang as $i => $v) {
                                    $hidden = in_array($v['KDKANTOR'], array('RA', 'XA')) ? "style='display:none;'" : null;
                                    $select = $this->input->get('ktr') == $v['KDKANTOR'] ? 'selected' : null;

                                    echo "<option value='$v[KDKANTOR]' $hidden $select>$v[KDKANTOR] - ".ucwords(strtolower($v['NAMAKANTOR']))."</option>";
                                } ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="dd/mm/yyyy">
                                <input type="text" class="form-control" name="txtTglAwal" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAwal')?>" readonly>
                                <span class="input-group-addon"> to </span>
                                <input type="text" class="form-control" name="txtTglAkhir" placeholder="dd/mm/yyyy" value="<?=$this->input->get('txtTglAkhir')?>" readonly>
								<span class="input-group-btn">
                                    <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DOWNLOAD?>"><i class="fa fa-download"></i></button>
                                    <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                </span>
                            </div>
                        </div>
                    </form>

                    <div class="clearfix margin-bottom-10"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();
    });
</script>
<!-- END JAVASCRIPTS -->