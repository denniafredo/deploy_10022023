<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.css"/>
<!-- END PAGE LEVEL STYLES -->
<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
		 <li>
            <a href="javascript:;">Pencapaian</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a onclick="javascript:history.back()">Daftar List Gaji LPA</a>
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
                        <i class="fa fa-file-text-o font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Slip</span>
                    </div>
                </div>
                <div id="printableArea">
                
                <?php foreach($pendapatan as $i => $row) { ?>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" style="font-size: 12px;">
                              <body>
                                 <table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" width="80%" align="center" style="border-collapse: collapse; border: medium none">
                                    <tr>
										<td>
										
										<?php
										
											$bulan = array (
												1 =>   'Januari',
												'Februari',
												'Maret',
												'April',
												'Mei',
												'Juni',
												'Juli',
												'Agustus',
												'September',
												'Oktober',
												'November',
												'Desember'
											);
											$pecahkan = $tgl;
											
											$tanggal = substr($pecahkan,0,2) . ' ' . $bulan[ (int)(substr($pecahkan,3,1)) ] . ' ' . substr($pecahkan,-4);
										
										?>
										
										<table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" width="615" style="border-collapse: collapse; border: medium none">
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<img src=" <?php echo base_url('asset/img/logo-ifg.png');?>" width="180" height="150">
												</td>
											</tr>
											<tr>
												
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center"><b>
												<?php if ($kdkomisi == 'F1') {?>
												<span lang="FI" style="font-family: Arial,sans-serif">SLIP GAJI</span></b></td>
												<?php } else { ?>
												<span lang="FI" style="font-family: Arial,sans-serif">SLIP INSENTIF</span></b></td>
												<?php } ?>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<span lang="FI" style="font-family: Arial,sans-serif"><?=$tanggal;?></span>
												</td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif"><b>TOTAL PENDAPATAN</b></span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><b>...........................................................................</b></span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><b><?= "Rp " . number_format($row['PENDAPATAN'],2,',','.');?></b></span></td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												<?php if ($kdkomisi == 'F1') {?>
												BASIC ALLOWANCE 
												<?php } else { ?>
												 INSENTIF 
												<?php }?>
												</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">...........................................................................</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= "Rp " . number_format($row['PENDAPATAN'],2,',','.');?></span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span>
												</td>
											</tr>
											<?php if ($kdkomisi == 'F1') { ?>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												<b> TOTAL POTONGAN </b>
												</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><b>...........................................................................</b></span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><b><?= "Rp " . number_format(substr($row['LISENSI'],1),2,',','.');?></b></span></td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												 BIAYA LISENSI 
												</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">...........................................................................</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= "Rp " . number_format(substr($row['LISENSI'],1),2,',','.');?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												SUB TOTAL 
												</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">...........................................................................</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= "Rp " . number_format($row['PENDAPATAN']+$row['LISENSI'],2,',','.');?></span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span>
												</td>
											</tr>
											<?php } ?>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												PAJAK 
												</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">...........................................................................</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= "Rp " . number_format($row['PAJAK'],2,',','.');?></span></td>
											</tr>
											<?php $gajibersih = ($row['PENDAPATAN']+$row['LISENSI']);
												  $insentifbersih = $row['PENDAPATAN'] - $row['PAJAK'];
											
											?>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif"><b>
												<?php if ($kdkomisi == 'F1') {?>
												GAJI BERSIH
												<?php } else { ?>
												 INSENTIF BERSIH 
												<?php }?></b>
												</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><b>...........................................................................</b></span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><b>
												<?php if ($kdkomisi == 'F1') {?>
												<?= "Rp " . number_format($gajibersih,2,',','.');?>
												<?php } else { ?>
													<?= "Rp " . number_format($insentifbersih,2,',','.');?>
												<?php }?>
												</b></span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												INFO BANK
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												NAMA BANK
												</span></td>
												<td colspan="7" valign="top" style="width:20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -210.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['NAMABANK'];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												PEMILIK REKENING
												</span></td>
												<td colspan="7" valign="top" style="width:20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -210.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['NAMAKLIEN'];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width:150px; padding-left: -5.4pt; padding-right: -5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">
												NO REKENING
												</span></td>
												<td colspan="7" valign="top" style=" width:20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td  valign="top" style="width: 180px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -210.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['NOREKENING'];?></span></td>
											</tr>
										</table>
                                               
										<!-- Button print PDF -->
                                        <div align="center" style="margin-right: 100px; margin-bottom: 100px; ">
                                            <span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black;">

                                               <button id="printpagebutton" type="button" onclick="PrintDiv('printableArea');" class="btn btn-primary waves-effect waves-light  pull-right">
                                                    Print PDF
                                                </button>
                                                   
                                            </span>
                                        </div>
										<!-- End Button print PDF -->
                                    
                                </body>
                            </table>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="text-center">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dtBox"></div>

<script type="text/javascript">     
function PrintDiv() {    

    var printableArea = document.getElementById('printableArea');
    var popupWin = window.open('', '_blank', 'width=300,height=300');

    //Get the print button and put it into a variable
    var printButton = document.getElementById("printpagebutton");
    //Set the print button visibility to 'hidden' 
    printButton.style.visibility = 'hidden';

    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + printableArea.innerHTML + '</body></html>');
    popupWin.document.close();
        }
</script>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/date-time-picker/DateTimePicker.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

