<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green-meadow calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift"></i><?=$this->template->title?>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div id="calendar" class="has-toolbar"></div>
                        </div>
                    </div>
                    <!-- END CALENDAR PORTLET-->
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>

<!-- button trigger extended modals -->
<a id="btnModal" class="btn default hidden" data-toggle="modal" href="#responsive"></a>
<!-- responsive -->
<div id="responsive" class="modal fade" tabindex="-1" data-width="760">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">No Polis: <span id="noPolis"></span></h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <address>
                        Nama: <span id="txtNama"></span><br>
                        Benefit: <span id="txtBenefit"></span><br/>
                        Nilai: <span id="txtNilai"></span><br/>
                        Tgl Jatuh Tempo: <span id="txtTglJthTempo"></span><br/>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    </div>
</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=base_url()?>asset/plugin/moment.min.js"></script>
<script src="<?=base_url()?>asset/plugin/fullcalendar/fullcalendar.min.js"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/calendar.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        /*Metronic.init(); // init metronic core components
         Layout.init(); // init current layout
         Demo.init(); // init demo features*/
        Calendar.init();
        ComponentsPickers.init();
    });

    var Calendar = function() {

        return {
            //main function to initiate the module
            init: function() {
                Calendar.initCalendar();
            },

            initCalendar: function() {

                if (!jQuery().fullCalendar) {
                    return;
                }

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth();
                var y = date.getFullYear();

                var h = {};

                if (Metronic.isRTL()) {
                    if ($('#calendar').parents(".portlet").width() <= 720) {
                        $('#calendar').addClass("mobile");
                        h = {
                            right: 'title, prev, next',
                            center: '',
                            left: 'agendaDay, agendaWeek, month, today'
                        };
                    } else {
                        $('#calendar').removeClass("mobile");
                        h = {
                            right: 'title',
                            center: '',
                            left: 'agendaDay, agendaWeek, month, today, prev,next'
                        };
                    }
                } else {
                    if ($('#calendar').parents(".portlet").width() <= 720) {
                        $('#calendar').addClass("mobile");
                        h = {
                            left: 'title, prev, next',
                            center: '',
                            right: 'today,month,agendaWeek,agendaDay'
                        };
                    } else {
                        $('#calendar').removeClass("mobile");
                        h = {
                            left: 'title',
                            center: '',
                            right: 'prev,next,today,month,agendaWeek,agendaDay'
                        };
                    }
                }

                $('#calendar').fullCalendar('destroy'); // destroy the calendar
                $('#calendar').fullCalendar({ //re-initialize the calendar
                    header: h,
                    defaultView: 'month', // change default view with available options from http://arshaw.com/fullcalendar/docs/views/Available_Views/
                    slotMinutes: 15,
                    events: [
                        <?php foreach ($jatuhtempo as $i => $v) { ?>
                        {
                            title: "<?="$v[NOPOLIS]"?>",
                            start: new Date(<?=$v['YEXPIRASI']?>, <?=$v['MEXPIRASI']?> -1, <?=$v['DEXPIRASI']?>, 11, 00, 00),
                            end: new Date(<?=$v['YEXPIRASI']?>, <?=$v['MEXPIRASI']?> -1, <?=$v['DEXPIRASI']?>, 14, 00, 00),
                            backgroundColor: Metronic.getBrandColor('blue'),
                            editable: false,
                            id: "<?="$v[NAMAKLIEN1];$v[NAMABENEFIT];$v[NILAIBENEFIT]"?>",
                        },
                        <?php } ?>
                    ],
                    eventClick: function(calEvent, jsEvent, view) {
                        var res = calEvent.id.split(";");
                        var day = calEvent.start;

                        $("#btnModal").click();
                        $("#noPolis").text(calEvent.title);
                        $("#txtNama").text(res[0]);
                        $("#txtBenefit").text(res[1]);
                        $("#txtNilai").text(res[2].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                        $("#txtTglJthTempo").text(day.format('DD/MM/YYYY'));
                    }
                });

            }

        };

    }();
</script>
<!-- END JAVASCRIPTS -->