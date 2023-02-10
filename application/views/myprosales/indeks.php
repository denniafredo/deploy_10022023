<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/fullcalendar/fullcalendar.css" rel="stylesheet"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
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
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>  Token
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
			<?php foreach($userdata as $i => $v) { ?>
                <tr>
                    Nomor Token Anda: <td align="center" style="font-weight:bold"> <?=$v?></td>
                </tr>
            <?php } ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <span class="glyphicon glyphicon-book" aria-hidden="true"></span> Manual Book
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                                <th style="text-align:center; vertical-align:middle;">Unduh</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center">User Manual JS Pro Sales </td>
                                    <td class="text-center" width="36">
                                        <a style="width:52px;height:52px;" href="<?=base_url("mobileapi/file/User Manual JS Pro Sales v_1_0_2.pdf")?>" class="btn btn-xs grey tooltips btn-edit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><br /><i class="fa fa-file-pdf-o btn-xs-tbl" style="font-size:2em;"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <span class="glyphicon glyphicon-phone" aria-hidden="true"></span> Download APK
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <div class="table-scrollable">
            <table class="table table-bordered table-hover" style="font-size: 12px;">
                <thead>
                <tr>
                    <th style="text-align:center; vertical-align:middle;">Keterangan & Versi</th>
                    <th style="text-align:center; vertical-align:middle;">Besar File</th>
					<th style="text-align:center; vertical-align:middle;"><br /><br /><br />Unduh</th>
                    <th style="text-align:center; vertical-align:middle;">Tgl Rilis</th>
                    
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td align="" valign="center"> <br /><b><?=$appversion['NAMA']?></b>
						<br />
						<br />
						Change log:
						<br />
<pre style="align:left;">
<?=$appversion['KETERANGAN']?>
</pre>
						</td>
                        <td align="center" valign="center"><?=$appversion['UKURAN']?></td>                        <td class="text-center" width="36" valign="center">
                            <a href="<?="$this->url/save-historis-dl?url=$appversion[URL]"?>" class="btn btn-xs grey btn-edit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>" style="width:52px;height:52px;">
                                <br />
                                <i class="fa fa-download btn-xs-tbl" style="font-size:2em;"></i>
                            </a>
                        </td>
                        <td align="center" valign="center"><?=$appversion['TGLRILIS']?></td>

                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Daftar Check-In
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="portlet light">
                <div class="portlet-body">

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">Catatan</th>
                                <th style="text-align:center; vertical-align:middle;">Alamat</th>
                                <th style="text-align:center; vertical-align:middle;">Koordinat</th>
                                <th style="text-align:center; vertical-align:middle;">Tanggal</th>
                                <th style="text-align:center; vertical-align:middle;">Gambar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							if (!empty($checkin)) { 
								foreach($checkin as $i => $v) {
									if ($v['dataType'] == 'CHECKIN') 
										{ ?>
										<tr>
											<td><?=$v['notes']?></td>
											<td><?=$v['address']?></td>
											<td><a href="https://www.google.com/maps/place/@<?="$v[lat],$v[lng]"?>,17z/data=!4m2!3m1!1s0x0:0x0" target="_blank"><?="$v[lat],$v[lng]"?></a></td>
											<td><?=(!empty($v['checkinDate']) ? $v['checkinDate'] : null)?></td>
											<td align="center"><img width="50" src="<?=base64_decode($v['pict'])?>" /><br />
											<img width="50" src="<?=base64_decode($v['pictTertanggung'])?>" /></td>
										</tr>
										<?php 
										}
                            		} 
							}?>
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
  
</div>
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
        <h4 class="modal-title">Agenda No: <span id="noAgenda"></span></h4>
        <input type="hidden" name="txtNoAgenda">
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <address>
                        <strong><span id="agenda"></span></strong>
                    </address>
                    <address>
                        Mulai: <span id="tglMulai"></span><br>
                        Sampai: <span id="tglSampai"></span><br/>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btnEdit" data-dismiss="modal" class="btn yellow-gold">Ubah</button>
        <a id="btnDelete" class="btn red-flamingo">Hapus</a>
        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/calendar.js"></script>
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<script src="<?=base_url()?>asset/js/form-validation.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        /*Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features*/
        Calendar.init();
        ComponentsPickers.init();

        $("#btnEdit").click(function() {
            var noagenda = $("input[name='txtNoAgenda']").val();
            var agenda = $("#agenda").text();
            var tglmulai = $("#tglMulai").text();
            var tglselesai = $("#tglSampai").text();

            $("#event_add").text(' Ubah ');
            $("input[name='txtNoAgendaBaru']").val(noagenda);
            $("textarea[name='txtAgenda']").val(agenda);
            $("input[name='txtTglAwal']").val(tglmulai);
            $("input[name='txtTglAkhir']").val(tglselesai);
        });

        $('#btnDelete').click(function(){
            var noagenda = $("input[name='txtNoAgenda']").val();
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function(result){
                    if (result)
                        window.location.href = "<?="$this->url/hapus-pribadi?id="?>"+noagenda;
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
            toastr.success('Oo yeaah, agenda berhasil disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN?>")
            toastr.error('Oo tidaak, agenda gagal disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_SUKSES_HAPUS?>")
            toastr.success('Oo yeaah, agenda berhasil dihapus.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_HAPUS?>")
            toastr.error('Oo tidaak, agenda gagal dihapus.');
        /*====== end of toastr notification =====*/

        // form validation submit
        var error = $(".alert-danger", $("#form-agenda"));
        var success = $(".alert-success", $("#form-agenda"));
        $("#form-agenda").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                txtAgenda: {
                    required: true
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success.hide();
                error.show();
                Metronic.scrollTo(error, -200);
            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var icon = $(element).parent('.input-icon').children('i');
                icon.removeClass('fa-check').addClass("fa-warning");
                icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight

            },

            success: function (label, element) { // if success
                /*var icon = $(element).parent('.input-icon').children('i');
                 $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                 icon.removeClass("fa-warning").addClass("fa-check");*/
            },

            submitHandler: function (form) {
                //success.show();
                error.hide();
                form[0].submit(); // submit the form
            }
        });
        // end of form validation submit
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
                    events: [],
                    eventClick: function(calEvent, jsEvent, view) {
                        var tgl = new Date(calEvent.start);
                        var pad = "00";
                        var month = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                        var tmulai = pad.substring(0, pad.length - tgl.getDate().toString().length) + tgl.getDate() + '/' + month[tgl.getMonth()] + '/' + tgl.getFullYear();
                        var jmulai = pad.substring(0, pad.length - tgl.getHours().toString().length) + tgl.getHours() + ':' + pad.substring(0, pad.length - tgl.getMinutes().toString().length) + tgl.getMinutes() + ':' + pad.substring(0, pad.length - tgl.getSeconds().toString().length) + tgl.getSeconds();
                        var tgl = new Date(calEvent.end);
                        var tsampai = pad.substring(0, pad.length - tgl.getDate().toString().length) + tgl.getDate() + '/' + month[tgl.getMonth()] + '/' + tgl.getFullYear();
                        var jsampai = pad.substring(0, pad.length - tgl.getHours().toString().length) + tgl.getHours() + ':' + pad.substring(0, pad.length - tgl.getMinutes().toString().length) + tgl.getMinutes() + ':' + pad.substring(0, pad.length - tgl.getSeconds().toString().length) + tgl.getSeconds();

                        $("#btnModal").click();
                        $("#noAgenda").text(calEvent.id);
                        $("input[name='txtNoAgenda']").val(calEvent.id);
                        $("#agenda").text(calEvent.title);
                        $("#tglMulai").text(tmulai + ' ' + jmulai);
                        $("#tglSampai").text(tsampai + ' ' + jsampai);
                        //alert('Event id: ' + calEvent.id);
                        //alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
                        //alert('View: ' + view.name);
                    }
                    /*events: [{
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: Metronic.getBrandColor('yellow')
                    }, {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: Metronic.getBrandColor('green')
                    }, {
                        title: 'Repeating Event',
                        start: new Date(y, m, d - 3, 16, 0),
                        allDay: false,
                        backgroundColor: Metronic.getBrandColor('red')
                    }, {
                        title: 'Repeating Event',
                        start: new Date(y, m, d + 4, 16, 0),
                        allDay: false,
                        backgroundColor: Metronic.getBrandColor('green')
                    }, {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                    }, {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        backgroundColor: Metronic.getBrandColor('grey'),
                        allDay: false,
                    }, {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        backgroundColor: Metronic.getBrandColor('purple'),
                        allDay: false,
                    }, {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        backgroundColor: Metronic.getBrandColor('yellow'),
                        url: 'http://google.com/',
                    }]*/
                });

            }

        };

    }();
</script>
<!-- END JAVASCRIPTS -->