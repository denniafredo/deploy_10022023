<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <title>JAIM | <?=$this->template->title;?></title>
    <link rel="shortcut icon" href="<?=base_url()?>asset/img/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="Aplikasi Manajemen Informasi Keagenan" name="description">
    <meta content="Fendy Christianto" name="author">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"-->
    <link href="<?=base_url()?>asset/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="<?=base_url()?>asset/plugin/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/plugin/morris/morris.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGIN STYLES -->

    <!-- BEGIN PAGE STYLES -->
    <link href="<?=base_url()?>asset/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="<?=base_url()?>asset/css/components-rounded.min.css" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/css/plugins.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asset/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?=base_url()?>asset/css/custom.css" rel="stylesheet" type="text/css">
    <!-- END THEME STYLES -->



    <!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <!--[if lt IE 9]>
    <script src="../../assets/global/plugins/respond.min.js"></script>
    <script src="../../assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?=base_url()?>asset/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/jquery-migrate.min.js" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="<?=base_url()?>asset/plugin/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/plugin/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!--script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <!--script src="<?=base_url()?>asset/plugin/morris/morris.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/plugin/morris/raphael-min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/js/jquery.sparkline.min.js" type="text/javascript"></script-->
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?=base_url()?>asset/js/metronic.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/layout.js" type="text/javascript"></script>
    <script src="<?=base_url()?>asset/js/demo.js" type="text/javascript"></script>
    <!--script src="<?=base_url()?>asset/js/index3.js" type="text/javascript"></script>
	<script src="<?=base_url()?>asset/js/tasks.js" type="text/javascript"></script-->
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            Metronic.init(); // init metronic core componets
            Layout.init(); // init layout
            Demo.init(); // init demo(theme settings page)
            /*Index.init(); // init index page
             Tasks.initDashboardWidget(); // init task dashboard widget*/
        });
    </script>
    <!-- END JAVASCRIPTS -->
    <link rel="shortcut icon" href="favicon.ico">
</head>

<body class="page-header-menu-fixed">
<div style="background: #3b434c;color: #a2abb7; position: fixed; top: 0; left: 0; z-index: 1; width: 100%;">
    <!--<a href="<?=$this->url?>" class="btn btn-sm blue pull-left">
        JAiM <i class="icon-home"></i>
    </a>-->

    <span class="input-group-btn">
        <a href="<?="$this->url/followup-proposal?id=".$this->input->get('id')."&bid=".$this->input->get('bid')?>" class="btn btn-sm grey-cascade tooltips pull-right">
            <i class="fa fa-refresh"></i>
        </a>

        <a href="<?="$this->url/proposal?id=".$this->input->get('id')?>" class="btn btn-sm purple-wisteria tooltips pull-right">
            <i class="icon-action-undo"></i>
        </a>
    </span>
</div>

<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">

        </div>
    </div>
    <!-- END PAGE HEAD -->

    <div class="clearfix margin-bottom-10"></div>

    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">

        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
        <link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL STYLES -->

        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12">

                    <!-- BEGIN FOLLOWUP PROPOSAL-->
                    <div class="portlet light">
                        <?php if (!$isdelete) { ?>
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa icon-user font-green-sharp"></i>
                                    <span class="caption-subject font-green-sharp bold uppercase">Proposal No <?=$this->input->get('id')?></span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form id="form-followup" class="form-horizontal" role="form" action="<?="$this->url/followup-proses"?>" method="post">
                                    <input type="hidden" name="txtnoprospek" value="<?=$this->input->get('id')?>" />
                                    <input type="hidden" name="txtbuildid" value="<?=$this->input->get('bid')?>" />
                                    <input type="hidden" name="txtnofollowup" value="<?=$this->input->get('nf')?>" />
                                    <div class="form-body">
                                        <div class="alert alert-danger display-hide">
                                            <button class="close" data-close="alert"></button>
                                            You have some form errors. Please check below.
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Status Proposal <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <select name="ddlstatus" class="form-control">
                                                        <option value="">Silahkan Pilih</option>
                                                        <?php foreach($statusproposal as $i => $v) {
                                                            if ($v['KDSTATUS'] == $edited['KDSTATUS'])
                                                                echo "<option value='$v[KDSTATUS]' selected>$v[NAMASTATUS]</option>";
                                                            else
                                                                echo "<option value='$v[KDSTATUS]'>$v[NAMASTATUS]</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group spaj <?=($edited['KDSTATUS'] == 4 ? null : 'display-hide')?>">
                                            <label class="col-md-3 control-label">No SPAJ <span class="required">*</span></label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txtnospaj" class="form-control" value="<?=$edited['NOSPAJ']?>" placeholder="9999999999">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group spaj <?=($edited['KDSTATUS'] == 4 ? null : 'display-hide')?>">
                                            <label class="control-label col-md-3">Tanggal SPAJ <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txttglspaj" class="form-control form-control-inline date-picker" value="<?=$edited['TGLSPAJ']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group presentasi <?=($edited['KDSTATUS'] == 3 ? null : 'display-hide')?>">
                                            <label class="control-label col-md-3">Tanggal Presentasi <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txttglpresentasi" class="form-control form-control-inline date-picker" value="<?=$edited['TGLPRESENTASI']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pelunasan <?=($edited['KDSTATUS'] == 5 ? null : 'display-hide')?>">
                                            <label class="control-label col-md-3">Premi Pelunasan <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txtpremipelunasan" class="form-control form-control-inline" value="<?=$edited['PREMI']?>" placeholder="9999999" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pelunasan <?=($edited['KDSTATUS'] == 5 ? null : 'display-hide')?>">
                                            <label class="control-label col-md-3">Tanggal Pelunasan <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txttglpelunasan" class="form-control form-control-inline date-picker" value="<?=$edited['TGLPELUNASAN']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group batal <?=($edited['KDSTATUS'] == 99 ? null : 'display-hide')?>">
                                            <label class="control-label col-md-3">Tanggal Pembatalan <span class="required">*</span></label>
                                            <div class="col-md-3">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <input type="text" name="txttglpembatalan" class="form-control form-control-inline input-medium date-picker" value="<?=$edited['TGLPEMBATALAN']?>" data-date-format="dd/mm/yyyy" placeholder="31/12/2015" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Keterangan</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa"></i>
                                                    <textarea name="txtketerangan" class="form-control" rows="2"><?=$edited['KETERANGAN']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button type="button" class="btn green btn-submit">Simpan</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>

                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa icon-user font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Historis Follow Up</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php if ($isdelete) { ?>
                                <div class="btn-group btn-group-solid pull-right">
                                    <a href="<?="$this->url/proposal-pribadi?id=".$this->input->get('r')?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                                </div>
                            <?php } ?>

                            <div class="clearfix margin-bottom-10"></div>

                            <div class="table-scrollable">
                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                    <tr>
                                        <th style="text-align:center; vertical-align:middle;">No</th>
                                        <th style="text-align:center; vertical-align:middle;">Status</th>
                                        <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                                        <th style="text-align:center; vertical-align:middle;">Tgl Presentasi</th>
                                        <th style="text-align:center; vertical-align:middle;">No SPAJ</th>
                                        <th style="text-align:center; vertical-align:middle;">Tgl SPAJ</th>
                                        <th style="text-align:center; vertical-align:middle;">Tgl Pelunasan</th>
                                        <th style="text-align:center; vertical-align:middle;">Premi Pelunasan</th>
                                        <th style="text-align:center; vertical-align:middle;">Tgl Pembatalan</th>
                                        <th style="text-align:center; vertical-align:middle;">Tgl Rekam</th>
                                        <th style="text-align:center; vertical-align:middle;">Opsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($followup as $i => $v) { ?>
                                        <tr>
                                            <td align="center"><?=$i+1?></td>
                                            <td align="center"><?=$v['NAMASTATUS']?></td>
                                            <td><?=$v['KETERANGAN']?></td>
                                            <td align="center"><?=$v['TGLPRESENTASI']?></td>
                                            <td><?=$v['NOSPAJ']?></td>
                                            <td><?=$v['TGLSPAJ']?></td>
                                            <td align="right"><?=(!empty($v['PREMI']) ? number_format(str_replace(',', '.', $v['PREMI']), 2, ',', '.') : null)?></td>
                                            <td align="center"><?=$v['TGLPELUNASAN']?></td>
                                            <td align="center"><?=$v['TGLPEMBATALAN']?></td>
                                            <td align="center"><?=$v['TGLREKAM']?></td>
                                            <td nowrap class="text-center" width="70">
                                                <?php if (empty($v['KUNCI']) && $v['KDSTATUS'] != '2') { ?>
                                                    <a href="<?="$this->url/edit-followup-proposal?id=".$this->input->get('id')."&bid=".$this->input->get('bid')."&nf=$v[NOFOLLOWUP]"?>" class="btn btn-xs yellow-gold tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_EDIT?>"><i class="fa fa-pencil btn-xs-tbl"></i></a>
                                                    <a class="btn btn-xs red-flamingo tooltips btn-delete" data-value="<?=$v['NOFOLLOWUP']?>" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
                                                <?php } else if ($v['KDSTATUS'] == '2') { ?>
                                                    <a href="<?=base_url("simulasi/files/pdf/$v[FILE_PDF]")?>" class="btn btn-xs blue tooltips" target="_blank" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><i class="fa fa-file-pdf-o btn-xs-tbl"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END FOLLOWUP PROPOSAL -->

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT INNER -->

        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <!-- END PAGE LEVEL PLUGINS -->

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?=base_url()?>asset/js/components-pickers.js"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <script>
            jQuery(document).ready(function() {
                ComponentsPickers.init();

                $('.btn-delete').click(function () {
                    var nofollowup = $(this).attr('data-value');
                    bootbox.confirm({
                        size: 'small',
                        message: 'Yakin hapus data?',
                        callback: function (result) {
                            if (result)
                                window.location.href = "<?="$this->url/del-followup-proposal?id=".$this->input->get('id')."&bid=".$this->input->get('bid')."&nf="?>" + nofollowup;
                        }
                    });
                });

                /*===== toastr notification =====*/
                toastr.options = {
                    "closeButton": true,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "0",
                    "hideDuration": "0",
                    "timeOut": "0",
                    "showMethod": "fadeIn"
                };

                if ("<?=$status?>" == "<?=C_STATUS_SUKSES_SIMPAN?>")
                    toastr.success('Oo yeaah, data berhasil disimpan.');
                else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN?>")
                    toastr.error('Oo tidaak, data gagal disimpan.');
                else if ("<?=$status?>" == "<?=C_STATUS_SUKSES_HAPUS?>")
                    toastr.success('Oo yeaah, data berhasil dihapus.');
                else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_HAPUS?>")
                    toastr.error('Oo tidaak, data gagal dihapus.');
                /*===== end of toastr notification =====*/

                $("select[name='ddlstatus']").change(function() {
                    var option = this.value;

                    switch(option) {
                        case '3':
                            $(".spaj").hide();
                            $(".presentasi").show();
                            $(".pelunasan").hide();
                            $(".batal").hide();
                            break;
                        case '4':
                            $(".spaj").show();
                            $(".presentasi").hide();
                            $(".pelunasan").hide();
                            $(".batal").hide();
                            break;
                        case '5':
                            $(".spaj").hide();
                            $(".presentasi").hide();
                            $(".pelunasan").show();
                            $(".batal").hide();
                            break;
                        case '99':
                            $(".spaj").hide();
                            $(".presentasi").hide();
                            $(".pelunasan").hide();
                            $(".batal").show();
                            break;
                        default:
                            $(".spaj").hide();
                            $(".presentasi").hide();
                            $(".pelunasan").hide();
                            $(".batal").hide();
                            break;
                    }
                });

                $(".btn-submit").click(function() {
                    var option = $("select[name='ddlstatus']").val();
                    var sukses = 1;

                    switch(option) {
                        case '3':
                            if ($("input[name='txttglpresentasi']").val().length == 0) {
                                alert('Tanggal Presentasi wajib diisi');
                                sukses = 0;
                            }
                            break;
                        case '4':
                            if ($("input[name='txtnospaj']").val().length == 0 || $("input[name='txttglspaj']").val().length == 0) {
                                alert('No & Tanggal SPAJ wajib diisi');
                                sukses = 0;
                            }
                            break;
                        case '5':
                            if ($("input[name='txtpremipelunasan']").val().length == 0 || $("input[name='txttglpelunasan']").val().length == 0) {
                                alert('Premi & Tanggal Pelunasan wajib diisi');
                                sukses = 0;
                            }
                            break;
                        case '99':
                            if ($("input[name='txttglpembatalan']").val().length == 0) {
                                alert('Tanggal Pembatalan wajib diisi');
                                sukses = 0;
                            }
                            break;
                    }

                    if (sukses)
                        $("#form-followup").submit();
                });
            });
        </script>
        <!-- END JAVASCRIPTS -->

    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container">
        Copyright &copy; 2015. PT. Asuransi Jiwasraya (Persero). Develop by IT team. All Rights Reserved.
        <!--Copyright &copy; 2015. PT. Asuransi Jiwasraya (Persero). Develop by IT & Keagenan Staff (Fendy, Nuke & Gideon). All Rights Reserved. -->
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->

<!-- Google Analytic -->
<!--script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-70603952-1', 'auto');
    ga('send', 'pageview');
</script>
<!-- End of Google Analytic -->
</body>
<!-- END BODY -->
</html>