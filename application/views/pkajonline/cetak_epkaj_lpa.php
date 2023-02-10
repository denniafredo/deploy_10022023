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
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">PKAJ Online</span>
                    </div>
                </div>
                <div id="printableArea">
                <form id="form_epkaj" name="form_epkaj" class="" action="#" />
                <?php foreach($pkaj as $i => $row) { ?>
                    <input type="hidden" value="<?=$row["NOAGEN"];?>" id="noagen" name="noagen">
                    <input type="hidden" value="<?=$row["NOPKAJAGEN"];?>" id="nopkaj" name="nopkaj">
                    <input type="hidden" value="<?=$row["TGLPKAJAGEN"];?>" id="tglpkaj" name="tglpkaj">
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover" style="font-size: 12px;">
                              <body>
                                 <table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" width="80%" align="center" style="border-collapse: collapse; border: medium none">
                                    <tr>
										<td>
										
										<?php
										$namahari = $HARI;
										$tanggal = $TANGGAL;
										$x = mktime(0, 0, 0, $row["BLN"], $row["TGL"],  $row["THN"]);
										$nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
										$tahun = $TAHUN;
										?>
										
										<table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" width="615" style="border-collapse: collapse; border: medium none">
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center"><b>
												<span lang="FI" style="font-family: Arial,sans-serif">PERJANJIAN 
												KEAGENAN ASURANSI JIWA</span></b></td>
											</tr>
											<tr style="height: 23.25pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 23.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center">
												<!--<span lang="FI" style="font-family: Arial,sans-serif">NOMOR :
														  <?=$row["NOPKAJAGEN"];?>
														  /EPKAJ-<? if($row["THN"] >= 2020){
															echo ("KP - ".
															$row["BLN"]." ".
															substr($row["THN"],-2));
														  }else{
															echo ($row["KDKANTOR"]." - ".
															$row["BLN"]." ".
															$row["THN"]);
														  }
														  ?>
															
														  </span>-->
														<span lang="FI" style="font-family: Arial,sans-serif">NO.<?=$row["NOPKAJAGEN"];?>/IFGL/LPA/<?=$row["BLN"];?>/<?=$row["THN"];?>
															
														  </span>
												</p>
												<p class="MsoNormal" align="center" style="text-align: center"><b>
												<span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span style="font-family: Arial,sans-serif">Perjanjian Kemitraan ini selanjutnya disebut <b>“Perjanjian”</b> dibuat pada 
														  <?=$namahari;?>
														  tanggal
										  <?=$tanggal;?>
														  bulan
										  <?=$nama_bulan[date("n", $x)];?>
														  tahun
										  <?=$tahun;?>
														  oleh dan antara:</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif">I.</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Nama</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"> <?=$row["NAMA_TTD"];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif"></span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Nomor induk pegawai</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NIK_TTD"];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif"></span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Jabatan&nbsp; </span>		</td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["JABATAN_TTD"];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif"></span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Alamat Kantor</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Graha CIMB Niaga Lt. 21, Jl.Jend. Sudirman Kav. 58 Jakarta 12190</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif"></span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Nomor Telepon&nbsp; </span>		</td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">021-2526769</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span style="font-family: Arial,sans-serif">
												bertindak dalam jabatannya tersebut berdasarkan Surat Kuasa PT Asuransi Jiwa IFG, Nomor 220/SKU/AJIFG/U/IV/2022 tanggal 28 April 2022, dan karenanya berwenang bertindak untuk dan atas nama PT Asuransi Jiwa IFG, berkedudukan dan berkantor di Jakarta Selatan sesuai dengan Anggaran Dasar PT Asuransi Jiwa IFG yang termuat dalam Akta Nomor 39 tanggal 22 Oktober 2020 yang dibuat dihadapan Notaris Hadijah, S.H., yang telah disahkan oleh Kementerian Hukum dan Hak Asasi Manusia Republik Indonesia melalui Surat Keputusan Nomor AHU-0055113.AH.01.01.TAHUN 2020 tanggal 22 Oktober 2020, sebagaimana telah diubah terakhir dengan Akta Pernyataan Keputusan Para Pemegang Saham PT Asuransi Jiwa IFG Nomor 36 tanggal 16 November 2021 dan telah dicatat dalam Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia sesuai Surat Nomor AHU-0067149.AH.01.02.TAHUN 2021 tanggal 25 November 2021, selanjutnya disebut “<b>Perusahaan</b>”; dan
												
												<!--bertindak dalam jabatannya tersebut berdasarkan Surat Kuasa nomor <?=$row["NOPKAJAGEN"];?>  Tanggal <?=$row["TGLPKAJAGEN"];?> dan karenanya berwenang untuk mewakili dan atas  nama <b>PT ASURANSI JIWA IFG</b>, suatu perusahaan asuransi, yang didirikan berdasarkan hukum Republik Indonesia, berkedudukan di Graha CIMB Niaga Lt. 21 Jalan Jend. Sudirman Kav. 58 Jakarta 12190, Indonesia, selanjutnya disebut <b>“Perusahaan”</b>; dan
												-->
											</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">II.</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Nama (sesuai KTP)</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NAMAKLIEN1"];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">No. Agen</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['NOAGEN'];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Tempat/Tgl Lahir</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												  <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span style="font-family: Arial,sans-serif"> <?=$row["TEMPATLAHIR"].", ".$row["TGLLAHIR"];?></span>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Jenis Kelamin</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												  <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span style="font-family: Arial,sans-serif"><?=$row["JENISKELAMIN"];?>  </span>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Alamat Sesuai KTP</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">  <?=$row["ALAMATAGEN"];?> </span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">No. KTP</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['NOMORIDAGEN'];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Nomor Telepon Rumah/Hp</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['NOTELPONAGEN'];?></span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">Alamat E-mail</span></td>
												<td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">:</span></td>
												<td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif"><?= $row['EMAILTETAP'];?></span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="FI" style="font-family: Arial,sans-serif">bertindak untuk dan atas nama diri sendiri, selanjutnya disebut “<b><i>Life Progress Advisor</i> (LPA)</b>”.</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span style="font-family: Arial,sans-serif">
														Perusahaan dan <i>Life Progress Advisor</i> (LPA) secara bersama-sama disebut sebagai “<b>Para Pihak</b>” atau masing-masing disebut “<b>Pihak</b>” dalam kedudukannya sebagaimana tersebut di atas, terlebih dahulu menerangkan hal-hal sebagai berikut : 
														<ul align="justify">
															<li>Bahwa Perusahaan adalah suatu perseroan terbatas yang bergerak di bidang asuransi jiwa yang produknya dipasarkan melalui <i>Life Progress Advisor</i> (LPA).</li>
															<li>Bahwa <i>Life Progress Advisor</i> (LPA) merupakan professional yang telah memiliki sertifikasi dan Lisensi AAJI, serta terdaftar di Otoritas Jasa Keuangan dengan keahlian dan perizinan yang dimilikinya dalam Perjanjian ini bersedia bertindak untuk dan atas nama Perusahaan dalam melakukan kegiatan jasa pemasaran produk-produk asuransi yang dikembangkan dan/atau diterbitkan oleh Perusahaan.</li>
															
														</ul>
														<br/>
													</span>
												</td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span style="font-family: Arial,sans-serif">Berdasarkan hal-hal tersebut di atas maka Para Pihak sepakat untuk mengadakan Perjanjian berdasarkan syarat-syarat dan ketentuan-ketentuan sebagaimana diatur dalam pasal-pasal dibawah ini.</span></td>
											</tr>
											<tr style="height: 40pt;border:0px solid #000;">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 13.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
												<span style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr style="height: 7.5pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 7.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center"><b>
												<span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;1</span></b></td>
											</tr>
											<tr style="height: 12.15pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 12.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">DEFINISI</span></b></td>
											</tr>
											<tr style="height: 9.75pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 9.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="margin-right: -5.4pt"><b>
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam Perjanjian ini kecuali didefinisikan lain dalam peraturan perundang-undangan yang berlaku, beberapa istilah-istilah yang menggunakan huruf besar dalam Perjanjian ini selanjutnya didefinisikan sebagai berikut: </span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">2.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif"><b>Perusahaan</b> berarti PT Asuransi Jiwa IFG
													</span>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">2.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Bisnis</b> berarti usaha perasuransian yang dijalankan oleh Perusahaan, yang meliputi penjualan produk asuransi, dan meliputi pula usaha lainnya dari Perusahaan yang dijalankan dari waktu ke waktu;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">3.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Calon Pemegang Polis</b> adalah subyek hukum yang memiliki insurable interest dengan Tertanggung yang akan mengadakan perjanjian asuransi dengan PERUSAHAAN;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">4.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Calon Tertanggung</b> adalah orang yang atas jiwanya akan diadakan perjanjian asuransi dengan PERUSAHAAN;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">5.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pemegang Polis</b> adalah pihak yang mengadakan perjanjian asuransi atau penggantinya menurut hukum dengan Penanggung;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">6.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Tertanggung</b> adalah orang yang atas jiwanya diadakan perjanjian asuransi jiwa, di mana jenis perjanjian asuransinya diuraikan dalam Polis;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">7.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i>Field Underwriting<i></b> adalah kewajiban LPA melakukan verifikasi terhadap kebenaran, kelengkapan dan akurasi data-data/informasi, termasuk sumber dana dari Calon Pemegang Polis dan/atau Calon Tertanggung sebagaimana isian pada Surat Permintaan Asuransi Jiwa (SPAJ) serta memberikan informasi penting lainnya kepada PERUSAHAAN tentang kondisi Calon Pemegang Polis dan/atau Calon Tertanggung yang dapat mempengaruhi PERUSAHAAN dalam memutuskan penerimaan/penolakan penutupan asuransi;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">8.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i>Case Count</i></b> berarti jumlah polis baru berdasarkan nama para Pemegang Polis yang pembayaran premi pertamanya telah diterima dan disetujui Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">9.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i>Life Progress Advisor</i> (LPA)</b> berarti orang yang memiliki keahlian dan perizinan untuk melakukan kegiatan pemasaran produk-produk asuransi yang dikembangkan dan/atau diterbitkan oleh Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">10.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Evaluasi</b> adalah penilaian yang dilakukan oleh Perusahaan berdasarkan pencapaian kinerja <i>Life Progress Advisor</i> (LPA) sesuai dengan ketentuan yang telah ditetapkan oleh Perusahaan;</span></td>
											</tr>
											<!--<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">11.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i>Fraud Policy</i></b> berarti kebijakan strategis yang penerapannya diwujudkan dalam sistem pengendalian fraud, kebijakan tertulis Perusahaan mengatur mengenai penggelapan, penipuan, termasuk definisi dari penipuan, pencegahan penipuan dan akibat dari penipuan yang dilakukan oleh <i>Life Progress Advisor</i> (LPA);</span></td>
											</tr>-->
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">11.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Indikator Kinerja Utama atau KPI</b> berarti ukuran yang ditetapkan oleh Perusahaan dari waktu ke waktu untuk mengukur tingkatan minimum dari standar kinerja seorang <i>Life Progress Advisor<i> (LPA) untuk mempertahankan penunjukan <i>Life Progress Advisor<i> (LPA) berdasarkan Perjanjian ini dan sebagaimana tersebut dalam Ketentuan Kompensasi <i>Life Progress Advisor<i> (LPA);</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">12.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Informasi Rahasia</b> berarti segala informasi yang bersifat teknis maupun komersial dalam bentuk apapun baik secara tertulis dengan diberi tanda “Rahasia” maupun tidak ataupun dalam bentuk lisan yang diberikan untuk tujuan Perjanjian ini atau berkaitan dengan Perjanjian ini yang dikuasai dan/atau dimiliki oleh Perusahaan, Informasi Rahasia ini termasuk namun tidak terbatas pada data, informasi dan daftar mengenai para Nasabah, para Pemegang Polis, para calon Pemegang Polis, karyawan, penasehat keuangan dan <i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i>, informasi yang berhubungan dengan Bisnis, rahasia dagang, kompensasi, cara kerja produk apapun, proses, penemuan, peningkatan, atau pengembangan yang dilaksanakan atau digunakan oleh Perusahaan dan informasi yang terkait dengan proyek riset, teknologi, pengetahuan teknis (<i>know-how</i>), harga, potongan harga, <i>mark-ups </i>(penggelembungan biaya), strategi bisnis, pemasaran, tender dan serta segala informasi yang bersifat sensitif mengenai Perusahaan, dan termasuk segala informasi yang dimiliki dan harus dijaga oleh PT Asuransi Jiwa IFG berdasarkan peraturan Perasuransian yang berlaku;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">13.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Kantor Representatif</b> berarti kantor representatif PT Asuransi Jiwa IFG;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">14.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Keadaan Memaksa / Force Majeure</b> berarti kondisi tertentu yang berada di luar kendali Perusahaan dan/atau <i>Life Progress Advisor<i> (LPA) termasuk namun tidak terbatas pada perang, kondisi hukum tertentu di mana hukum militer diberlakukan, pernyataan nasional atas keadaan darurat, revolusi, bencana alam, gangguan atau penutupan bursa efek, bank atau lembaga kliring, tindakan pemerintah, demonstrasi, kerusuhan, kebakaran, ledakan, sabotase, terorisme atau kondisi pelarangan (embargo);</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">15.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA)</b> berarti ketentuan tertulis yang diterbitkan oleh Perusahaan yang mengatur secara rinci mengenai kompensasi, target dan evaluasi dari <i>Life Progress Advisor</i> (LPA) yang ditetapkan oleh Perusahaan dari waktu ke waktu dan merupakan bagian yang tidak terpisahkan dari Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">16.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Kompensasi</b> berarti sejumlah basic allowance, insentif atau apapun namanya yang diberikan Perusahaan kepada <i>Life Progress Advisor</i> (LPA) sebagai imbalan atas jasa <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini sebagaimana diatur dalam Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA) dan tidak dapat dikategorikan atau didefinisikan sebagai gaji atau upah sebagaimana dimaksud dalam peraturan perundang-undangan yang belaku di bidang ketenagakerjaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">17.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i></b> berarti atasan langsung <i>Life Progress Advisor</i> (LPA) dengan apapun nama jabatannya yang diberikan dan ditunjuk Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">18.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Masa Kemitraan</b> berarti periode di mana <i>Life Progress Advisor</i> (LPA) telah bermitra dengan Perusahaan, yang dimulai sejak tanggal Perjanjian ini ditandatangani dan akan berakhir sesuai dengan ketentuan yang terdapat dalam Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">19.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>MPS atau <i>Minimum Performance Standard</i></b> berarti pengukuran kualitas bisnis dari  <i>Life Progress Advisor</i> (LPA) untuk menentukan standar kualitas bisnis seorang <i>Life Progress Advisor</i> (LPA); </span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">20.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pemberitahuan</b> berarti setiap pemberitahuan, informasi, surat menyurat, korespondensi lainnya yang timbul sehubungan dengan Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">21.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Peraturan dan Kode Etik</b> berarti peraturan-peraturan dan kebijakan tertulis mengenai prosedur, pedoman dan standar pelaksanaan Perjanjian yang harus dipatuhi atau diharapkan dari seorang <i>Life Progress Advisor</i> (LPA) dalam menjalankan tugas sebagai penasehat keuangan dalam hubungannya dengan para Pemegang Polis atau Prospek dan dengan PT Asuransi Jiwa IFG, yang dikeluarkan oleh Perusahaan dari waktu ke waktu dan menjadi bagian yang tidak terpisahkan dari Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">22.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Polis</b> berarti dokumen yang diterbitkan oleh Perusahaan yang merupakan suatu perjanjian pertanggungan asuransi jiwa antara Perusahaan dan Pemegang Polis;</span></td>
											</tr><tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">23.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Premi</b> berarti sejumlah uang yang tertera dalam Polis yang disetujui oleh Pemegang Polis untuk dibayarkan kepada Perusahaan sesuai dengan ketentuan-ketentuan Polis;</span></td>
											</tr><tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">24.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Prospek</b> berarti Calon Pemegang Polis yang menurut pertimbangan <i>Life Progress Advisor</i> (LPA) memenuhi syarat untuk menjadi pembeli produk-produk asuransi Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">25.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pelatihan</b> adalah sesi yang dilaksanakan oleh Perusahaan untuk kepentingan para <i>Life Progress Advisor</i> (LPA) sampai dengan penempatan di  Kantor Representatif;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">26.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Target</b> adalah standar yang ditetapkan oleh Perusahaan dari waktu ke waktu yang diharapkan untuk dipenuhi oleh <i>Life Progress Advisor</i> (LPA) sebagai mitra Perusahaan dalam melakukan penjualan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">27.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Peraturan</b> berarti semua peraturan perundang-undangan yang berlaku di wilayah Republik Indonesia termasuk namun tidak terbatas pada peraturan-peraturan yang dikeluarkan oleh Perusahaan yang berkaitan dengan pelaksanaan Perjanjian ini.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">28.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pelanggaran</b> adalah suatu perbuatan yang dilakukan secara terang dan sadar oleh <i>Life Progress Advisor</i> (LPA) yang mana atas perbuatannya tersebut mengakibatkan ketidaksesuaian terhadap pelaksanaan kewajiban maupun batasan <i>Life Progress Advisor</i> (LPA) yang telah diatur dalam Perjanjian ini termasuk perubahannya (apabila ada) namun tidak terbatas termasuk pelanggaran terhadap ketentuan internal Perusahaan, standar praktik dan kode etik tenaga pemasar asuransi jiwa, melanggar norma hukum pidana/perdata serta peraturan perundang-undangan yang berlaku.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">29.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Lisensi AAJI</b> adalah sebuah penetapan yang diberikan atau diterbitkan oleh organisasi atau asosiasi profesi perasuransian dalam hal ini AAJI yang wajib dimiliki <i>Life Progress Advisor</i> (LPA) sebelum melakukan pemasaran dan/atau penjualan produk asuransi jiwa.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">30.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Surat Penetapan Agen (SPA) </b> adalah surat yang diterbitkan oleh Perusahaan untuk <i>Life Progress Advisor</i> (LPA) yang berisikan tentang penetapan administrasi keagenan sesuai ketentuan yang berlaku di Perusahaan. Apabila diperlukan, surat ini dapat diubah sewaktu-waktu oleh Perusahaan sesuai kebutuhan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">31.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Perjanjian</b> adalah Perjanjian Keagenan Asuransi Jiwa beserta lampiran dan perubahan-perubahannya yang menguraikan hak dan kewajiban Para Pihak yang harus dipatuhi dan dilaksanakan agar mencapai bisnis perasuransian yang saling menguntungkan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">32.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Masa Mempelajari Polis (<i>Freelook Period</i>)</b> adalah masa tertentu yang diberikan kepada Pemegang Polis untuk dapat mempelajari Polis dan mengembalikan Polis kepada Perusahaan apabila Pemegang Polis tidak menyetujui syarat-syarat umum Polis dan ketentuan lainnya.</span></td>
											</tr>
											
											<tr style="height: 17.25pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp; 2</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEMITRAAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">2.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dengan tunduk pada persyaratan dan ketentuan Perjanjian ini dan terhitung sejak tanggal Perjanjian ini, Perusahaan, secara non-ekslusif, dengan ini menunjuk <i>Life Progress Advisor</i> (LPA) sebagai mitra untuk mewakili Perusahaan dalam memasarkan produk-produk asuransi Perusahaan yang dikembangkan atau diterbitkan oleh Perusahaan dan <i>Life Progress Advisor</i> (LPA) menerima penunjukan tersebut. Namun dalam hal ini proses pemasaran produk asuransi oleh <i>Life Progress Advisor</i> (LPA) tetap harus memenuhi ketentuan yang berlaku di Perusahaan.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">2.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam Perjanjian ini, telah dipahami dan disepakati oleh Para Pihak bahwa tidak ada hubungan kerja perusahaan-karyawan atau pekerja-pengusaha baik yang tersurat maupun yang tersirat antara Perusahaan dan <i>Life Progress Advisor</i> (LPA) dan tidak ada bagian apapun yang terkandung dalam Perjanjian ini yang dapat ditafsirkan sebagai menciptakan hubungan kerja sebagaimana dimaksud dalam peraturan perundang-undangan yang berlaku di bidang ketenagakerjaan.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">2.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) akan bertindak dalam kapasitasnya untuk dan atas nama Perusahaan dan tidak akan menerima penunjukan lain sebagai seorang <i>Life Progress Advisor</i> (LPA) atau sebagai agen pemasaran dari manapun atau dari perusahaan asuransi lain atau perusahaan yang terkait dengan asuransi apapun atau perusahaan keuangan lainnya termasuk untuk tidak memasarkan atau menjual, baik langsung maupun tidak langsung dan dengan cara apapun, produk asuransi atau produk keuangan lainnya dari perusahaan asuransi maupun perusahaan keuangan lainnya atau perseorangan kecuali dengan izin ijin tertulis dari Perusahaan.</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 3</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEWAJIBAN DAN HAK PERUSAHAAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">3.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlaku Perjanjian ini, Perusahaan berkewajiban untuk:
												<ol type="a" align="justify">
													<li>memberikan atau membayarkan Kompensasi kepada <i>Life Progress Advisor</i> (LPA) sebagai imbalan atas penjualan produk asuransi yang dilakukan <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini sebagaimana diatur dalam Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA) dan sebagaimana dapat diubah atau dicabut/dibatalkan oleh Perusahaan dari waktu ke waktu dengan Pemberitahuan secara tertulis;</li>
													<li>melakukan pemotongan Pajak Penghasilan atas seluruh Kompensasi yang diterima oleh <i>Life Progress Advisor</i> (LPA) sesuai dengan ketentuan hukum yang berlaku;</li>			
													<li>membayarkan dan melaporkan pemotongan pajak penghasilan ke Kantor Pelayanan Pajak setempat; dan</li>
													<li>memberikan bukti pemotongan Pajak Penghasilan sesuai peraturan yang berlaku pada <i>Life Progress Advisor</i> (LPA)  setiap tahun.</li>
													
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">3.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlaku Perjanjian ini, Perusahaan mempunyai hak dari waktu ke waktu untuk melakukan tindakan-tindakan sebagai berikut:
												<ol type="a" align="justify">
													<li>menetapkan, mengubah, atau mencabut rumus, pedoman, prosedur dan parameter perhitungan Kompensasi, Target dan Evaluasi dalam Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA) Perjanjian ini dengan pemberitahuan secara tertulis;</li>
													<li>menetapkan, mengubah, mencabut atau membatalkan Peraturan dan Kode Etik Perjanjian ini dengan pemberitahuan secara tertulis;</li>			
													<li>mengadakan evaluasi penilaian secara menyeluruh mengenai tugas serta tanggung jawab <i>Life Progress Advisor</i> (LPA) sesuai dengan Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA);</li>
													<li>menempatkan <i>Life Progress Advisor</i> (LPA) atau memindahkan <i>Life Progress Advisor</i> (LPA) ke Kantor Representatif manapun atau ke tempat lain sebagaimana ditetapkan oleh Perusahaan berdasarkan kebijaksanaan penuh dari Perusahaan dari waktu ke waktu, dari Kantor Representatif atau tempat lain dimana <i>Life Progress Advisor</i> (LPA) akan melaksanakan kewajibannya berdasarkan Perjanjian ini dari waktu ke waktu;</li>
													<li>melakukan pemotongan secara sah atas hak-hak <i>Life Progress Advisor</i> (LPA) yang mungkin ada berdasarkan Perjanjian ini, termasuk tapi tidak terbatas pada setiap Kompensasi baik sudah dibayarkan atau belum untuk digunakan sebagai pelunasan atas semua hutang atau kewajiban dari <i>Life Progress Advisor</i> (LPA) dalam hal ini termasuk namun tidak terbatas pada pengembalian Kompensasi karena adanya kesalahan pada proses penjualan, hilangnya aset Perusahaan, yang terjadi pada masa kemitraan. Hak-hak tagih atas pemenuhan kewajiban tersebut diatas akan tetap berlaku walaupun Perjanjian ini berakhir;</li>
													<li>dengan mengirimkan pemberitahuan kepada <i>Life Progress Advisor</i> (LPA), Perusahaan berhak menghentikan penerimaan permohonan Polis baru yang disampaikan oleh <i>Life Progress Advisor</i> (LPA) kepada Perusahaan, baik selamanya maupun untuk jangka waktu tertentu, jika menurut pertimbangan Perusahaan hal tersebut dianggap patut;</li>
													<li>menerima atau menolak seluruh permohonan pengajuan asuransi untuk produk-produk asuransi yang dikembangkan atau diterbitkan oleh Perusahaan yang diserahkan dan diterima oleh <i>Life Progress Advisor</i> (LPA);</li>
													<li>mengenakan sanksi terhadap <i>Life Progress Advisor</i> (LPA) dalam hal <i>Life Progress Advisor</i> (LPA) yang terbukti telah melakukan Pelanggaran ;</li>
													<li>menyediakan sarana/prasarana yang dianggap perlu oleh Perusahaan untuk melaksanakan tugas <i>Life Progress Advisor</i> (LPA)  berdasarkan Perjanjian ini;</li>
													<li>memberikan bimbingan, penjelasan dan/atau pelatihan bagi <i>Life Progress Advisor</i> (LPA) dalam rangka melakukan pemasaran produk;</li>
													<li>meminta <i>Life Progress Advisor</i> (LPA)  untuk segera mengembalikan seluruh aset milik Perusahaan, baik berupa barang maupun uang maupun data atau informasi yang sewaktu-waktu dapat berada dalam penguasaan <i>Life Progress Advisor</i> (LPA)  dan/atau Kantor Representatif;</li>
													<li>setiap saat melakukan pembinaan, pengendalian, pengawasan, audit, dan evaluasi atas kinerja <i>Life Progress Advisor</i> (LPA) dalam melakukan pemasaran produk;</li>
													<li>mengakhiri Perjanjian secara sepihak dalam hal <i>Life Progress Advisor</i> (LPA) telah terbukti secara sah dan meyakinkan telah melakukan Pelanggaran terhadap syarat dan ketentuan berdasarkan Perjanjian ini; dan</li>
													<li>apabila Perusahaan tidak segera mengambil tindakan terhadap Pelanggaran atas ketentuan dan persyaratan Perjanjian ini beserta perubahannya jika ada atau Pelanggaran terhadap peraturan perundang-undangan yang berlaku termasuk petunjuk dan pedoman yang ditetapkan oleh pemerintah atau Kode Etik Keagenan sebagaimana yang ditetapkan oleh Asosiasi Asuransi Jiwa Indonesia (AAJI) yang dilakukan oleh <i>Life Progress Advisor</i> (LPA), maka hal ini tidak dapat dianggap sebagai pengesampingan dan penghapusan atas hak-hak Perusahaan untuk dengan segera mengakhiri Perjanjian ini atau melakukan upaya hukum menurut hukum yang berlaku dari waktu ke waktu, atau ditafsirkan sebagai suatu pemberian persetujuan kepada <i>Life Progress Advisor</i> (LPA) untuk tidak bertindak sesuai dengan Perjanjian ini.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 4</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEWAJIBAN DAN HAK <i>Life Progress Advisor</i> (LPA)</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
												<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">4.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlaku Perjanjian ini, <i>Life Progress Advisor</i> (LPA) berkewajiban untuk:
												<ol type="a" align="justify">
													<li>Memiliki lisensi dari Asosiasi Asuransi Jiwa Indonesia (AAJI);</li>
													<li>Tidak memiliki ikatan perjanjian dengan perusahaan asuransi yang sejenis atau memiliki kegiatan usaha yang sama dengan kegiatan usaha Perusahaan;</li>
													<li>melakukan koordinasi dengan Perusahaan dan juga pihak lembaga keuangan atau lembaga lainnya dalam melakukan pemasaran produk dengan baik dan benar sesuai dengan peraturan, ketentuan dan kebijakan yang ditetapkan oleh Perusahaan dari waktu ke waktu;</li>
													<li>dbekerja sama dengan Perusahaan untuk mendukung tugasnya serta berkoordinasi dengan unit-unit kerja yang lain yang ada di Perusahaan dalam menjalankan tugasnya tersebut sehingga dapat terjamin bahwa segala laporan yang terkait dengan pemasaran produk dapat dipastikan telah dikirimkan ke pihak-pihak terkait sesuai jadwal yang telah ditentukan oleh Perusahaan;</li>
													<li>membuat laporan kegiatan harian atau mingguan atau bulanan yang diperlukan untuk memastikan bahwa kegiatan yang dilakukan oleh <i>Life Progress Advisor</i> (LPA) sudah sesuai dengan yang telah ditetapkan;</li>
													<li>memenuhi Target  pemasaran produk Perusahaan  yang ditentukan bagi <i>Life Progress Advisor</i> (LPA) dari waktu ke waktu;</li>
													<li>bersedia ditempatkan di lokasi pemasaran produk yang ditunjuk Perusahaan;</li>
													<li>mematuhi peraturan perundang-undangan dan kode etik profesi agen asuransi jiwa yang berlaku sekarang maupun di kemudian hari, serta peraturan-peraturan dan ketentuan-ketentuan Perusahaan serta kebijakan-kebijakan atau arahan-arahan lainnya dari waktu ke waktu termasuk kode etik bisnis dan kode etik bisnis agen;</li>
													<li>mengikuti dan menghadiri segala pelatihan yang diadakan oleh Perusahaan yang bertujuan untuk memberikan pengetahuan mengenai Produk dan prosedur penjualan serta hal-hal lainnya yang terkait dengan pemasaran produk;</li>
													<li>mengikuti setiap kontes yang diadakan oleh Perusahaan berkenaan dengan pemasaran produk Perusahaan dengan mematuhi ketentuan yang berlaku;</li>
													<li>mencurahkan seluruh waktu, keahlian dan tenaganya kepada usaha pemasaran produk;</li>
													<li>menempatkan kepentingan peserta asuransi atau pemegang polis di atas kepentingan dirinya sendiri;</li>
													<li>selalu terus berusaha meningkatkan kemahiran sebagai seorang <i>Life Progress Advisor</i> (LPA) menyangkut keahlian pemasaran produk, pengetahuan asuransi jiwa dan peraturan-peraturan perasuransian pada umumnya;</li>
													<li>memperoleh dan memastikan segala perizinan, tanda terdaftar dan kualifikasi yang disyaratkan Perusahaan untuk melaksanakan pemasaran produk masih berlaku sesuai ketentuan perundang-undangan dan menyimpannya dengan baik setiap waktu selama berlakunya Perjanjian ini;</li>
													<li>memelihara dalam keadaan yang baik segala sesuatu yang telah dipercayakan kepada <i>Life Progress Advisor</i> (LPA), termasuk tetapi tidak terbatas pada peralatan komputer, peralatan kantor dan bahan-bahan penjualan, yang merupakan hak milik eksklusif Perusahaan, dan bertanggung jawab atas seluruh biaya perbaikan, restorasi atau penggantian apabila ada kerusakan dan kehilangan terhadap peralatan atau bahan-bahan tersebut dan o.	tanpa perlu adanya permintaan terlebih dahulu, dengan berakhirnya Perjanjian ini, <i>Life Progress Advisor</i> (LPA) wajib mengembalikan dalam bentuk dan kondisi yang baik seluruh informasi, data, catatan, dokumen-dokumen, buku pedoman pemasaran produk Perusahaan, alat-alat tulis, formulir-formulir, buku-buku dan kertas-kertas, serta peralatan kantor lainnya yang berhubungan dengan usaha Perusahaan dan hak milik eksklusif dari Perusahaan. Kewajiban tersebut tetap berlaku meskipun Perjanjian ini telah berakhir;</li>
													<li>Menyediakan dan/atau menyampaikan informasi mengenai produk asuransi yang diterbitkan Perusahaan dan/atau layanan yang akurat, jujur, jelas dan tidak menyesatkan kepada konsumen dalam hal ini calon Pemegang Polis;</li>
													<li><i>Life Progress Advisor</i> (LPA) wajib menjaga sarana/prasarana atau fasilitas yang disediakan dan dipinjamkan Perusahaan dalam rangka menunjang pekerjaan <i>Life Progress Advisor</i> (LPA) dan akan mengembalikan kepada Perusahaan pada saat berakhirnya perjanjian;</li>
													<li>Setiap saat harus menjalankan dan mematuhi seluruh syarat-syarat dan ketentuan- ketentuan yang diuraikan dalam Perjanjian ini beserta perubahannya jika ada, peraturan perundangan-undangan yang berlaku, petunjuk dan pedoman yang ditetapkan oleh pemerintah dan Kode Etik Keagenan sebagaimana yang ditetapkan oleh AAJI (baik berupa lisan maupun tulisan) yang diberlakukan dari waktu ke waktu;</li>
													<li>menggunakan segala formulir, dokumen dan bahan apapun yang disediakan oleh Perusahaan dari waktu ke waktu kepadanya untuk menjalankan tugasnya berdasarkan Perjanjian ini. <i>Life Progress Advisor</i> (LPA) dilarang mengubah, menambah atau mengganti formulir, brosur, dokumen, atau bahan apapun milik Perusahaan atau menggunakan segala formulir, dokumen dan bahan apapun yang tidak disediakan oleh Perusahaan tanpa persetujuan tertulis sebelumnya dari Perusahaan. Seluruh formulir permohonan beserta seluruh dokumen pendukungnya yang telah diisi lengkap oleh Calon Pemegang Polis dan telah diterima oleh <i>Life Progress Advisor</i> (LPA), harus segera diserahkan kepada Perusahaan;</li>
													<li>dengan tetap memperhatikan ketentuan pada Perjanjian ini, menanggung segala pengeluaran yang timbul dalam pelaksanaan tugas-tugasnya sebagai <i>Life Progress Advisor</i> (LPA) sebagaimana diatur dalam Perjanjian ini, kecuali ada hal-hal lain yang secara khusus disepakati dan dinyatakan secara tertulis oleh Perusahaan;</li>
													<li>senantiasa memperhatikan dan menjaga kerahasiaan mengenai Bisnis atau orang-orang atau perusahaan-perusahaan yang dari waktu ke waktu berhubungan dengan Perusahaan (atau perusahaan lain yang terkait sebagaimana diberitahu oleh Perusahaan);</li>
													<li>mengungkapkan dengan segera kepada Perusahaan mengenai segala fakta dan keadaan yang diketahui <i>Life Progress Advisor</i> (LPA) yang terkait dengan penerimaan risiko atau Bisnis oleh Perusahaan dan harus menghubungi Perusahaan dengan segera dan seksama mengenai segala fakta yang terkait dengan penerimaan risiko atau transaksi bisnis tersebut yang diketahui oleh <i>Life Progress Advisor</i> (LPA) dengan cara bagaimanapun;</li>
													<li>memberikan Pemberitahuan dengan segera kepada Perusahaan kapanpun dalam hal <i>Life Progress Advisor</i> (LPA) menerima pemberitahuan mengenai adanya kerugian atau tuntutan yang telah atau akan diajukan atas sebuah Polis atau sebuah kontrak tertentu atau atas adanya pelanggaran terhadap persyaratan dari atau pengalihan Polis atau kontrak atau terkait dengan Bisnis oleh Perusahaan yang diketahui oleh <i>Life Progress Advisor</i> (LPA) dengan cara bagaimanapun;</li>
													<li>melakukan <i>Field Underwriting</i> terhadap penjualan dan/atau pemasaran Produk serta mengedepankan prinsip <i>Know Your Customer</i> sebagai mitigasi terhadap potensi Pencucian Uang.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">4.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama berlakunya Perjanjian ini, <i>Life Progress Advisor</i> (LPA) menyatakan bahwa telah mengerti dan memahami bahwa Perusahaan mempunyai kebijakan “<i>Zero Tolerance to Fraud</i>” yaitu Perusahaan tidak akan memberikan toleransi kepada <i>Life Progress Advisor</i> (LPA) yang melakukan tindakan <i>Fraud</i>. Tindakan <i>Fraud</i> dalam hal ini termasuk namun tidak terbatas pada beberapa hal diantaranya :
												<ol type="i" align="justify">
													<li>pencurian, penipuan, penggelapan, penyalahgunaan dana dan pencucian uang Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;</li>
													<li>dengan sengaja menghilangkan, menghapus, memalsukan, mengubah informasi, dokumen dan/atau data mengenai Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;</li>
													<li>memberikan penjelasan produk asuransi yang tidak sesuai dengan manfaat sebenarnya atau memberikan penjelasan yang salah perihal metode pembayaran premi atas polis asuransi kepada Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;</li>
													<li><i>twisting</i> yaitu larangan untuk membujuk dan/atau mempengaruhi Pemegang Polis untuk merubah spesifikasi polis yang ada atau mengganti polis yang ada dengan polis yang baru pada Perusahaan Asuransi Jiwa lainnya, dan/atau membeli polis baru dengan menggunakan dana yang berasal dari polis yang masih aktif pada suatu Perusahaan Asuransi Jiwa lainnya dalam waktu 6 (enam) bulan sebelum dan sesudah tanggal polis baru di Perusahaan Asuransi Jiwa lain diterbitkan; dan</li>
													<li><i>churning</i> yaitu tindakan membujuk dan mempengaruhi Pemegang Polis untuk mengubah spesifikasi polis yang ada atau mengganti polis yang ada dengan polis yang baru pada Perusahaan, dan/ atau membeli polis baru dengan menggunakan dana yang berasal dari polis yang masih aktif dari Perusahaan tanpa penjelasan terlebih dahulu kepada Pemegang Polis mengenai kerugian yang dapat di derita oleh Pemegang Polis akibat perubahan/pernggantian tersebut.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">4.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlakunya Perjanjian ini, <i>Life Progress Advisor</i> (LPA) dengan ini menyatakan, menjamin dan menyanggupi bahwa sehubungan dengan :
												<ol type="i" align="justify">
													<li>semua transaksi yang diatur dalam Perjanjian ini;</li>
													<li>segala sesuatu yang berkaitan langsung maupun tidak langsung dengan Perjanjian ini, termasuk namun tidak terbatas pada perundingan atas Perjanjian ini dan pelaksanaan kewajiban dalam Perjanjian ini; atau</li>
													<li>pengaturan yang timbul dari dan atau sehubungan dengan pelaksanaan dari Perjanjian ini</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify"> 
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 48.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">												
												<ol type="a" align="justify">
													<li>tidak pernah melanggar dan menyatakan sanggup untuk tidak melanggar peraturan anti korupsi dan anti penyuapan yang berlaku di yuridiksi di mana salah kesatuan Pihak berdomisili atau menjalankan usahanya, juga terhadap peraturan anti korupsi dan anti penyuapan yang berlaku di yuridiksi lain atau mungkin berlaku untuk transaksi sebagaimana diatur dalam Perjanjian ini;</li>
													<li>tidak pernah dan menyanggupi sanggup untuk tidak akan terkait / berhubungan dengan hal–hal berikut ini: melakukan pembayaran atau transfer atau menawarkan, atau menjanjikan atau memberikan keuntungan financial atau bentuk–bentuk keuntungan lainnya, atau meminta kesepakatan untuk menerima manfaat keuntungan financial baik yang berwujud ataupun yang tidak berwujud, termasuk pemberian atau suap, atau mengizinkan atau persetujuan atas hal-hal tersebut diatas baik secara langsung maupun tidak langsung, yang mempunyai tujuan atau berdampak penyuapan yang bersifat publik atau komersial atau penerimaan atau persetujuan dalam penyuapan, pemerasan, uang penerimaan atau persetujuan dalam penyuapan, pemerasan, uang pelancar atau perbuatan melawan hukum lain atau perbuatan tidak benar dalam artian untuk mendapatkan atau mempertahankan kerjasama, keuntungan komersial atau kegiatan yang tidak sebagaimana mestinya dari sebuah fungsi atau kegiatan;</li>
													<li>harus menjamin kepatuhan terhadap semua kewajiban diatas dari setiap orang-orang terkait, pejabat, karyawan atau agen, subkontraktor atau konsultan independen yang digunakan untuk melaksanakan kewajiban-kewajibannya berdasarkan Perjanjian ini; dan</li>
													<li>apabila diketahui terdapat tindakan oleh setiap orang yang terkait, karyawan, agen, subkontraktor atau konsultan independen yang dianggap merupakan tindakan-tindakan sebagaimana disebutkan dalam huruf b ayat ini diatas, atau cukup memiliki kecurigaan yang beralasan atas sesuatu tindakan dimaksud diatas, maka harus segera memberitahu kepada Perusahaan atas diketahuinya hal tersebut dan apabila diminta oleh Perusahaan, menyediakan informasi dalam batasan yang wajar, yang diperlukan Perusahaan terkait dengan tindakan tersebut</li>
												</ol></span></td>
												
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">4.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Perjanjian ini berlangsung, maka <i>Life Progress Advisor</i> (LPA) memiliki hak untuk menerima Kompensasi berdasarkan kinerja dan pencapaian Target sesuai dengan Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA) Perjanjian ini sebagaimana diubah dari waktu ke waktu oleh Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 5</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PEMBATASAN WEWENANG <i>Life Progress Advisor</i> (LPA)</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
												<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selain yang diotorisasikan secara tertulis kepada <i>Life Progress Advisor</i> (LPA) oleh Perusahaan, maka tidak ada kewenangan apapun yang diberikan kepada <i>Life Progress Advisor</i> (LPA) untuk bertindak atas nama Perusahaan, termasuk namun tidak terbatas pada:
												<ol type="a" align="justify">
													<li>menerima segala bentuk risiko atau Bisnis, kecuali sebagaimana disahkan atau dimintakan secara tertulis oleh Perusahaan;</li>
													<li>menerbitkan nota penutupan (cover note), Polis atau kontrak lainnya;</li>
													<li>mendapatkan atau menerima atau menyetujui segala bentuk pemberitahuan mengenai perubahan, pembatalan, penetapan atau pengalihan Polis atau Bisnis lainnya, segala bentuk pemberitahuan mengenai kerugian atau pemberitahuan lainnya;</li>
													<li>mengesampingkan syarat atau ketentuan apapun dari Polis atau Bisnis lainnya;</li>
													<li>melakukan perundingan mengenai ketentuan penyelesaian, melunasi atau membayar setiap kerugian atau tuntutan atau mengesampingkan atau menunda pembayaran Premi atau pembayaran lainnya;</li>
													<li>memberikan jaminan, pernyataan atau janji yang berkaitan dengan Polis, kontrak tambahan atau Bisnis lainnya;</li>
													<li>menetapkan biaya tambahan selain dari Premi  yang diwajibkan tanpa persetujuan tertulis sebelumnya dari Perusahaan; dan</li>
													<li>mengikat Perusahaan dengan pihak lain dengan cara bagaimanapun.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang memberikan pernyataan kepada calon Pemegang Polis atau tertanggung atau penerima manfaat atau kepada siapapun bahwa ia diberi wewenang yang terkait dengan cara-cara tersebut di atas dan dilarang memberikan pernyataan kepada calon Pemegang Polis, tertanggung atau penerima manfaat atau siapapun mengenai setiap tindakan tersebut kecuali apabila Perusahaan menentukan lain.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang melangsungkan perjanjian apapun atau pengaturan (arrangement) apapun dengan <i>Life Progress Advisor</i> (LPA) lainnya atau dengan siapapun mengenai pelaksanaan tugas-tugas <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini atau membayar atau menawarkan untuk membayar kompensasi apapun kepada orang-orang tersebut untuk melaksanakan tugas-tugas tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang melimpahkan tugas-tugasnya berdasarkan Perjanjian ini kepada siapapun tanpa persetujuan tertulis terlebih dahulu dari Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.5</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) tidak memiliki wewenang untuk melangsungkan perjanjian apapun atas nama Perusahaan dengan <i>Life Progress Advisor</i> (LPA) lain sehubungan dengan pemenuhan dari segala persyaratan yang ditetapkan oleh Perusahaan atas <i>Life Progress Advisor</i> (LPA)  tersebut. <i>Life Progress Advisor</i> (LPA) dilarang memberikan pernyataan kepada siapapun bahwa <i>Life Progress Advisor</i> (LPA) memiliki wewenang untuk melaksanakan hal-hal tersebut di atas.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.6</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang mempublikasikan atau menyebabkan dipublikasikannya segala bentuk iklan mengenai penunjukannya berdasarkan Perjanjian ini atau mempublikasikan atau menyebabkan dipublikasikannya iklan mengenai Perusahaan, transaksi bisnis yang mereka miliki atau segala bentuk asuransi atau transaksi bisnis lainnya dimana <i>Life Progress Advisor</i> (LPA) diberi wewenang untuk menjalankannya atau menanganinya dalam surat kabar, majalah, publikasi atau media lainnya tanpa persetujuan tertulis terlebih dahulu dari Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.7</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang menerbitkan, menyebarluaskan atau menyebabkan diterbitkannya atau disebarluaskannya segala bentuk edaran atau menulis atau menyebabkan ditulisnya dalam surat kabar, majalah, publikasi atau media lainnya hal-hal tersebut di atas atau yang mengenai perusahaan asuransi lainnya tanpa persetujuan tertulis terlebih dahulu dari Perusahaan. Jika ada tuntutan hukum yang diajukan terhadap Perusahaan sebagai akibat dari tindakan atau pernyataan <i>Life Progress Advisor</i> (LPA) di luar kewenangannya, segala biaya, pengeluaran, serta kerusakan yang ditimbulkan sebagai akibat dari atau sehubungan dengan tindakan atau pernyataan tersebut harus ditanggung oleh <i>Life Progress Advisor</i> (LPA) secara pribadi.
												</span></td>
											</tr><tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.8</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang menggunakan atau menyebabkan digunakannya nama atau logo (atau bagian apapun dari nama atau logo tersebut) milik Perusahaan tanpa persetujuan tertulis lebih dahulu dari Perusahaan, dan dilarang mendaftarkan nama atau logo milik Perusahaan tersebut (atau bagian apapun dari nama atau logo tersebut) pada asosiasi, organisasi atau pihak berwenang manapun.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.9</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Tidak ada wewenang apapun yang diberikan kepada <i>Life Progress Advisor</i> (LPA) untuk bertindak untuk dan atas nama Perusahaan dalam rangka mengajukan, melakukan pembelaan atau ikut serta dalam persidangan perkara pengadilan yang berhubungan dengan Perusahaan. <i>Life Progress Advisor</i> (LPA) harus dengan segera menyerahkan kepada Perusahaan seluruh dokumen yang diterima <i>Life Progress Advisor</i> (LPA) yang memiliki keterkaitan dengan persidangan perkara yang melibatkan Perusahaan tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.10</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Masa Kemitraan Perjanjian ini <i>Life Progress Advisor</i> (LPA) dilarang melangsungkan perjanjian keagenan dengan perusahaan asuransi lain atau bergabung dengan perusahaan asuransi lain sampai status kemitraan resmi berakhir sesuai dengan ketentuan yang berlaku.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.11</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Masa Kemitraan Perjanjian ini <i>Life Progress Advisor</i> (LPA) dilarang untuk:
												<ol type="a" align="justify">
													<li>Mempublikasikan informasi / data / pernyataan / opini / gambar yang bertentangan dengan Peraturan, dengan atau tanpa mengaitkannya secara langsung kepada Perusahaan dan Calon Pemegang Polis/Pemegang Polis dan/atau Calon tertanggung/Tertanggung;</li>
													<li>Mempublikasikan informasi / data / pernyataan / opini / gambar yang bersifat negatif terkait dengan suku, agama, ras, politik dan golongan;</li>
													<li>Menggunakan kalimat dan bahasa yang tidak pantas / tidak menghargai / tidak sopan, termasuk mengutarakan pernyataan yang mengandung unsur provokatif;</li>
													<li>Mempublikasikan informasi / data / pernyataan / opini / gambar yang dapat ditafsirkan mengambil keuntungan dari pekerjaan orang lain;</li>
													<li>Mempublikasikan, mendiskusikan, menyebarkan informasi / data / pernyataan / opini / gambar terkait dengan Perusahaan yang bersifat non-publik (“Non-public Information”), tidak benar dan atau merendahkan pihak lain;</li>
													<li>Mempublikasikan informasi / data / pernyataan / opini / gambar terkait dengan atau milik Perusahaan, tanpa mematuhi hukum dan peraturan mengenai privasi data, hak cipta dan hak atas kekayaan intelektual (HAKI) lainnya.</li>
													<li>Mempublikasikan informasi / data / pernyataan / opini / gambar yang terkait dengan Perusahaan tanpa menjelaskan bahwa pendapat tersebut merupakan pendapat pribadi, dan bukan merupakan pendapat Perusahaan.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.12</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Membuat/mengubah/menghapus ketentuan dalam dokumen-dokumen Perusahaan, mengesampingkan hak, menentukan tarif premi selain yang telah ditentukan Perusahaan, memberikan persetujuan, pemberitahuan pengalihan, pemberitahuan kerugian, melakukan negosiasi atas syarat-syarat atau penyelesaian, menyelesaikan atau membayar kerugian atau klaim atau mengesampingkan/menunda pembayaran premi, atau mengikat Perusahaan atau afiliasinya dengan cara apapun juga; dan <i>Life Progress Advisor</i> (LPA)  dilarang memberi pernyataan kepada calon peserta atau pihak lain bahwa ia memiliki kewenangan atau bahwa risiko telah disetujui atau penutupan telah berlaku atau polis atau produk lain dikeluarkan oleh atau atas nama Perusahaan (baik berdasarkan proposal yang pertama maupun pembaharuan) kecuali Perusahaan telah menyetujui secara tertulis mengenai hal tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.13</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Meminta atau menerima pembayaran dari pihak ketiga untuk jasa yang diberikan dalam bentuk apapun juga sehubungan dengan atau terkait dengan kegiatan usaha Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.14</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Mempergunakan atau meminta Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung untuk mempergunakan dan menandatangani surat permohonan asuransi jiwa atau formulir permohonan lainnya dalam keadaan kosong.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.15</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Melakukan suatu tindakan hukum terhadap permasalahan dengan pihak ketiga sehubungan dengan kegiatan usaha Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.16</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Mengambil tindakan yang dapat merugikan reputasi Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.17</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Memberi keterangan yang salah mengenai persyaratan dan ketentuan Produk apapun yang ditawarkan Perusahaan, atau memberi jaminan, pernyataan atau janji dengan atau tanpa rujukan kepada polis-polis, kontrak tambahan, produk atau jasa lain yang ditawarkan Perusahaan, kecuali atas izin tertulis Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.18</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Melakukan kegiatan usaha atau pekerjaan lain di luar Perusahaan yang dapat menimbulkan benturan kepentingan dengan kegiatan usaha Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.19</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Terlibat dalam suatu tindakan yang melanggar undang-undang, peraturan, atau hukum yang berlaku, atau standar-standar praktek yang berlaku dalam yurisdiksi manapun.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.20</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Melakukan perbuatan yang menyimpang dari pedoman Pemasaran Produk yang dikeluarkan oleh Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">5.21</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Merubah atau mengganti formulir, dokumen atau material apapun atau menggunakan segala formulir, dokumen, atau material yang tidak disediakan oleh Perusahaan tanpa persetujuan terlebih dahulu dari Perusahaan.
												</span></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;6</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PELANGGARAN DAN SANKSI</span></b></td>
											</tr>
											<tr style="height: 12.75pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 12.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Perjanjian ini berlangsung, <i>Life Progress Advisor</i> (LPA) dilarang melakukan hal-hal sebagai berikut:
												</span></td>
											</tr>
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif"> Pelanggaran</span></td>
												</tr>
													<!-- sub dari atas -->
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.1</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melaporkan hasil-hasil pekerjaannya kepada pihak yang ditunjuk sesuai dengan struktur yang telah ditetapkan Perusahaan;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.2</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak memberikan pelayanan purna jual kepada pemegang polis/tertanggung;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.3</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan manajemen aktivitas penjualan kepada Calon Pemegang Polis dan/ atau Calon Tertanggung;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.4</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melaporkan perubahan data diri <i>Life Progress Advisor</i> (LPA) kepada Perusahaan sehubungan dengan tata administrasi keagenan yang berlaku</span></td>
													</tr>
											
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif"> Pelanggaran Sedang</span></td>
												</tr>
													<!-- sub dari atas -->
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.1</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan perpanjangan Sertifikasi dan Lisensi yang sudah berakhir masa berlakunya / tidak aktif;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.2</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak menjelaskan seluruh hak dan kewajiban Calon Pemegang Polis dan/atau Calon Tertanggung.</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.3</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan pencatatan data aktivitas penjualan dengan menggunakan media     yang ditentukan Perusahaan;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.4</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak memenuhi syarat performa, kinerja, dan/atau sasaran produksi yang ditetapkan Perusahaan;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.5</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan <i>Field Underwriting</i> terhadap Calon Pemegang Polis dan/atau Calon Tertanggung;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.6</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak ikut berpartisipasi dalam setiap pelatihan, sosialisasi Produk, dan program yang ditetapkan Perusahaan;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.7</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak mempertahankan dan menjaga persistensi polis sesuai dengan target yang telah ditetapkan Perusahaan; </span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">b.8</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak mengembalikan setiap komisi yang telah diperolehnya terkait dengan pengembalian premi dari Perusahaan kepada pemegang polis dengan alasan apapun.</span></td>
													</tr>													
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif"> Pelanggaran Berat</span></td>
												</tr>
													<!-- sub dari atas -->
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.1</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak memberikan penjelasan tentang Produk kepada Calon Pemegang Polis dan/atau Calon Tertanggung; </span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.2</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">tidak menjaga reputasi dan nama baik Perusahaan dengan melakukan perbuatan-   perbuatan yang tidak sesuai dengan ketentuan Perusahaan;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.3</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">mengadakan perjanjian dan/atau hubungan kerja keagenan asuransi secara langsung dengan perusahaan asuransi lain; </span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.4</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">melakukan pelanggaran terhadap Kode Etik Keagenan dan ketentuan perundang undangan yang berlaku;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.5</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">merekomendasikan pemegang polis/tertanggung untuk membatalkan polis atas dasar  kepentingan pribadi;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.6</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">memberikan data/dokumen yang tidak sesuai dengan data diri <i>Life Progress Advisor</i> (LPA) kepada Perusahaan maupun pemegang polis/tertanggung;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.7</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">membebankan premi tambahan dan biaya tambahan dalam bentuk apapun juga kepada Pemegang Polis/Tertanggung;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.8</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">memberikan potongan premi kepada pemegang polis/tertanggung dalam bentuk apapun, kecuali potongan premi tersebut merupakan program Perusahaan; </span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.9</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">menerima setoran premi secara tunai dari Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung; </span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.10</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">memanipulasi, memalsukan dan/atau memberikan keterangan terkait polis/surat/dokumen palsu kepada Perusahaan atau kepada pihak lain yang dapat mengakibatkan kerugian bagi Perusahaan atau pihak lain yang terkait dengan Perusahaan;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.11</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">Memberikan informasi yang bersifat rahasia yang berkaitan dengan strategi, kebijakan, program dan produk kepada perusahaan asuransi lain dan/atau pihak-pihak lain;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.12</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">mengajak atau menganjurkan sesuatu yang diketahui atau patut diduga akan menimbulkan kerugian Perusahaan dan/atau pemegang polis/tertanggung </span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.13</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">melakukan kegiatan bersama-sama dengan teman sejawat dan/atau orang lain di dalam maupun di luar lingkungan Perusahaan dengan tujuan untuk keuntungan pribadi, golongan atau pihak lain yang secara langsung merugikan Perusahaan;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.14</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">mengadakan perjanjian dalam bentuk apapun dan/atau memberikan janji-janji kepada pihak ketiga yang mengikat Perusahaan tanpa mendapat persetujuan terlebih dahulu dari Perusahaan;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.15</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">melakukan segala perbuatan yang merugikan Perusahaan baik secara materiil maupun immateriil termasuk namun tidak terbatas pada perbuatan-perbuatan penyalahgunaan uang Perusahaan dan pemegang polis/tertanggung;</span></td>
													</tr>	
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">c.16</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -50.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">Melakukan tindakan <i>Pooling, Twisting, Churning,</i> dan <i>Rebating</i> untuk kepentingan pribadi yang dapat merugikan Perusahaan.</span></td>
													</tr>			
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Atas pelanggaran ketentuan sebagaimana dimaksud pada ayat (1) Pasal ini, <i>Life Progress Advisor</i> (LPA) menyatakan bertanggung jawab sepenuhnya dan karenanya <i>Life Progress Advisor</i> (LPA) membebaskan Perusahaan dari segala tuntutan hukum baik pidana maupun perdata atau dalam bentuk apapun dari pihak lain, yang timbul sebagai akibat dari pelanggaran dimaksud serta bersedia untuk mengganti seluruh kerugian yang diderita Perusahaan atas perbuatan pelanggaran dan/atau larangan yang dilakukan dan bersedia dituntut oleh Perusahaan sesuai ketentuan hukum yang berlaku.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal <i>Life Progress Advisor</i> (LPA) terbukti melakukan salah satu pelanggaran dimaksud dalam ayat (1) Pasal ini, maka sesuai dengan bobot pelanggarannya Perusahaan berhak menjatuhkan sanksi, berupa
												</span></td>
											</tr>
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">Sanksi pelanggaran ringan terdiri dari:</span></td>
												</tr>
													<!-- sub dari atas -->
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.1</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -55.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">teguran lisan;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.2</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -55.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">peringatan tertulis I;</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.3</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -55.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">peringatan tertulis II; dan</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">a.4</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -55.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">peringatan tertulis III.</span></td>
													</tr>
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">Apabila peringatan tertulis III tidak dipatuhi, maka kepada yang bersangkutan dapat dijatuhi sanksi pelanggaran sedang.</span></td>
												</tr>
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">Sanksi pelanggaran sedang terdiri dari pembekuan Perjanjian, sekurang-kurangnya 1 (satu) bulan dan maksimal sampai dengan 6 (enam) bulan.</span></td>
												</tr>
												<tr>
													<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
													<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
													<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">Apabila setelah menjalani sanksi pelanggaran sedang, ternyata <i>Life Progress Advisor</i> (LPA) yang melakukan pelanggaran masih melakukan pelanggaran yang sifatnya sama, maka yang bersangkutan dapat dijatuhi sanksi pelanggaran berat, berupa:</span></td>
												</tr>
													<!--sub dari atas -->
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">d.1</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -55.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">pembekuan Perjanjian, sekurang-kurangnya 6 (enam) bulan dan maksimal sampai dengan 12 (dua belas) bulan; dan</span></td>
													</tr>
													<tr>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
														<td valign="top" style="width: 38px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -25.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">d.2</span></td>
														<td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
														<p class="MsoNormal" style="text-align: justify; margin-left: -55.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
														<span lang="IN" style="font-family: Arial,sans-serif">pemutusan atau pengakhiran Perjanjian.</span></td>
													</tr>
											
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Sanksi sebagaimana dimaksud ayat (3) Pasal ini, dapat dikenakan secara bersamaan dan/atau tidak harus berurutan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.5</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila pelanggaran yang dilakukan oleh <i>Life Progress Advisor</i> (LPA) mengandung unsur-unsur tindak pidana, maka selain sanksi dimaksud dalam Pasal ini, Perusahaan dapat melaporkan <i>Life Progress Advisor</i> (LPA) kepada pihak yang berwajib untuk menyelesaikan pelanggaran melalui jalur hukum dan <i>Life Progress Advisor</i> (LPA) bersedia untuk mempertanggungjawabkan segala perbuatan yang sudah dilakukan terhadap Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.6</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat menunda dan/atau tidak membayarkan komisi jika <i>Life Progress Advisor</i> (LPA) menerima sanksi pelanggaran sedang dan/atau pelanggaran berat sebagaimana yang disebutkan pada ayat 1 Pasal ini.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.7</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal terdapat keluhan terhadap Perusahaan  yang diduga disebabkan oleh kelalaian atau kesalahan <i>Life Progress Advisor</i> (LPA) dalam melakukan Pemasaran Produk, Perusahaan dapat meminta <i>Life Progress Advisor</i> (LPA) untuk membantu Perusahaan dalam melakukan investigasi, dan <i>Life Progress Advisor</i> (LPA) wajib untuk membantu investigasi serta memberikan seluruh informasi yang dimilikinya dengan benar kepada Perusahaan. Kewajiban sebagaimana dalam Pasal ini tetap berlaku walaupun Perjanjian telah berakhir
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;7</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PELATIHAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">7.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Para Pihak sepakat bahwa Perusahaan akan menyediakan fasilitas pelatihan untuk mendapatkan akreditasi dan lisensi bagi <i>Life Progress Advisor</i> (LPA) serta bersifat wajib untuk diikuti. Pelatihan akan diselenggarakan dalam bentuk pertemuan-pertemuan, sesi-sesi pelatihan dan seminar-seminar.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">7.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila <i>Life Progress Advisor</i> (LPA) berhalangan mengikuti pelatihan tanpa alasan yang wajar dan yang dapat diterima oleh Perusahaan dan tidak berhasil mendapatkan akreditasi atau sertifikasi, maka Perusahaan mempunyai hak untuk mengakhiri Perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">7.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal <i>Life Progress Advisor</i> (LPA) tidak menyelesaikan pelatihan atau membatalkan keikutsertaan dalam pelatihan, maka dengan adanya pembatalan tersebut <i>Life Progress Advisor</i> (LPA) wajib mengembalikan segala biaya-biaya yang timbul atas kepesertaan pelatihan kepada Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">7.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama keikutsertaan <i>Life Progress Advisor</i> (LPA) dalam pelatihan yang diselenggarakan oleh Perusahaan, segala macam bentuk data dan materi yang berkaitan dengan pelatihan tersebut merupakan dokumen perusahaan yang bersifat rahasia sehingga <i>Life Progress Advisor</i> (LPA) tidak diperkenankan untuk memperbanyak dan menyebarluaskannya tanpa izin Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp; 8</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">LARANGAN POTONGAN BIAYA ATAU BUJUKAN</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">8.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang membayar atau memperbolehkan, atau menawarkan untuk membayar atau memperbolehkan, sebagai suatu bentuk bujukan (an inducement) kepada siapa pun untuk menjamin diberikannya atau melakukan transaksi-transaksi bisnis apapun, potongan harga atau premi atau segala bentuk bujukan apapun yang tidak ditetapkan secara khusus dalam Polis atau ketentuan Bisnis yang dilakukan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">8.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang melakukan atau melangsungkan pengaturan apapun dengan atau membujuk seseorang untuk mengajukan permohonan klaim asuransi dalam bentuk apapun yang bukan suatu bentuk klaim yang wajar dan sah. <i>Life Progress Advisor</i> (LPA) dilarang menerima atau mendapat, atau melangsungkan pengaturan apapun dengan siapapun berdasarkan mana <i>Life Progress Advisor</i> (LPA) akan mendapatkan atau menerima uang (baik sepenuhnya maupun sebagian) yang akan dibayarkan sesuai dengan ketentuan klaim atau penyelesaian atas klaim tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">8.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang membuat pernyataan yang tidak benar atau membuat pernyataan yang tidak lengkap atau pernyataan yang tidak akurat atau membuat perbandingan dalam rangka membujuk seseorang untuk melakukan konversi atas Polis yang dimilikinya, menghentikan Polis yang dimilikinya dengan cara tidak melakukan pembayaran Premi dan tidak cukupnya nilai tunai untuk keperluan pinjaman Premi (lapse), melepaskan Polis yang dimilikinya untuk memperoleh nilai tunai (surrender) atau menghentikan transaksi bisnisnya dengan Perusahaan.
												</span></td>
											</tr>
											<!--<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">8.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam periode 1 (satu) tahun setelah dihentikannya Perjanjian ini, <i>Life Progress Advisor</i> (LPA) tidak diperkenankan baik secara langsung maupun tidak langsung untuk meminta, merayu, mendorong atau membujuk atau mencoba untuk meminta, merayu, mendorong atau membujuk karyawan, penasehat keuangan, agen, atau <i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i> dari Perusahaan selama jangka waktu tertentu yang dengan siapa <i>Life Progress Advisor</i> (LPA) melakukan transaksi material dalam menyediakan jasanya berdasarkan Perjanjian ini (atau yang patut diketahui olehnya adalah karyawan, penasehat keuangan, agent,  atau <i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i> selama jangka waktu tertentu untuk meninggalkan pekerjaan atau untuk memutuskan perjanjian kontraktual keagenan atau manajemen keagenan mereka (dalam bentuk apapun) dengan Perusahaan, tanpa mempertimbangkan apakah hal ini merupakan pelanggaran perjanjian karyawan, penasehat keuangan, agen, atau <i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i> dan untuk bertindak dalam kapasitas yang sama dalam hubungannya dengan bidang pekerjaan yang sama atau serupa untuk perusahaan atau perusahaan lain yang baik secara langsung ataupun tidak langsung bersaing dengan Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">8.5</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal <i>Life Progress Advisor</i> (LPA) terbukti melakukan Pelanggaran terhadap Perjanjian ini yang menyebabkan kerugian materiil maupun imateriil bagi Perusahaan, maka Perusahaan akan melakukan tindakan berupa pemanggilan melalui surat tertulis kepada <i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i> untuk dilakukan penyelesaian secara musyawarah mufakat dengan kewajiban mengganti kerugian yang dialami Perusahaan, dalam hal tidak tercapainya suatu kemufakatan serta terhadap Pelanggaran yang dilakukan <i><i><i>Alternative Distribution Regional Business Manager (ARM)</i></i></i>  terbukti melanggar norma hukum baik pidana / perdata maka Perusahaan berhak mengajukan tuntutan atau upaya hukum kepada <i>Life Progress Advisor</i> (LPA) .
												</span></td>
											</tr>-->
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">8.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Ketentuan dalam Pasal ini tetap berlaku walaupun terjadi pengakhiran Perjanjian ini.
												</span></td>
											</tr>
											
											<tr style="height: 0px;border:0px solid #000;">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">Pasal 9</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PENAGIHAN DAN PENGIRIMAN DANA</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">9.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) tidak memiliki hak untuk menagih atau menerima atas nama Perusahaan segala bentuk pembayaran dalam bentuk uang dan pembayaran lainnya, kecuali apabila hal demikian secara jelas disahkan atau dimintakan oleh Perusahaan secara tertulis.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">9.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) tidak memiliki wewenang untuk menerbitkan tanda terima apapun (baik yang bersifat sementara (interim), bersyarat atau bentuk lainnya) atas nama Perusahaan atas segala bentuk pembayaran yang diterima oleh <i>Life Progress Advisor</i> (LPA) atas nama Perusahaan tanpa persetujuan tertulis lebih dahulu dari Perusahaan. Jika <i>Life Progress Advisor</i> (LPA) diberi wewenang untuk menerbitkan tanda terima tersebut, <i>Life Progress Advisor</i> (LPA) hanya dapat melakukannya dengan menggunakan formulir yang telah disediakan oleh Perusahaan dengan tetap memenuhi segala syarat dan ketentuan yang ditetapkan oleh Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">9.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang bertindak untuk menempatkan Perusahaan pada kondisi yang beresiko dengan jalan menyerahkan Polis, endorsemen atau kontrak tambahan yang diterbitkan kepada pihak pemohon yang kondisi kesehatan atau pekerjaannya telah <i>Life Progress Advisor</i> (LPA) ketahui atau memiliki alasan untuk menduga bahwa kondisi kesehatan atau pekerjaan tersebut telah berubah sejak tanggal permohonan. <i>Life Progress Advisor</i> (LPA) dilarang menyerahkan kepada siapapun segala Polis atau bukti tanda terima perpanjangan (<i>renewal receipt</i>) kecuali apabila Perusahaan telah menerima Premi sepenuhnya pada masa pembayaran dan orang kepada siapa Polis tersebut diterbitkan pada saat itu berada dalam kondisi kesehatan yang baik.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 10</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PENEMPATAN</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
												<td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dengan Pemberitahuan dari Perusahaan, <i>Life Progress Advisor</i> (LPA) akan melaksanakan tugas pada lokasi Kantor Refresentatif atau tempat lain yang diberitahukan oleh Perusahaan dari waktu ke waktu. Perusahaan dapat menetapkan atas kebijaksanaan sendiri untuk memindahkan <i>Life Progress Advisor</i> (LPA) ke lokasi Kantor Representatif atau tempat lainnya dengan Pemberitahuan tertulis terlebih dahulu kepada <i>Life Progress Advisor</i> (LPA).</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
												PASAL 11</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
												PEMBAYARAN DAN PERUBAHAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dengan tunduk pada ketentuan-ketentuan Perjanjian ini, atas kegiatan penjualan yang akan dilakukan oleh <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini, maka <i>Life Progress Advisor</i> (LPA) berhak mendapatkan pembayaran Kompensasi yang akan diperhitungkan sesuai dengan pedoman dan prosedur tersebut dalam Ketentuan Advisor <i>Life Progress Advisor</i> (LPA).
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlaku Perjanjian ini, Kompensasi atas Polis hanya akan dihitung dan dibayarkan kepada <i>Life Progress Advisor</i> (LPA) sesuai Ketentuan Kompensasi <i>Life Progress Advisor</i> (LPA) Perjanjian ini setelah dipenuhinya keadaan-keadaan tersebut berikut ini:
												<ol type="i" align="justify">
													<li>penerbitan Polis oleh Perusahaan sebagaimana ditentukan oleh Perusahaan dari waktu ke waktu, setelah diterimanya permohonan yang disahkan dengan nama <i>Life Progress Advisor</i> (LPA);</li>
													<li>telah diterimanya Premi atau pembayaran yang disyaratkan oleh Perusahaan;</li>
													<li>Perusahaan telah menerima tanda terima polis atau berakhirnya Masa Mempelajari Polis (Freelook Period) yang berlaku; </li>
													<li>kepatuhan dan tidak terdapat Pelanggaran oleh <i>Life Progress Advisor</i> (LPA) terhadap segala persyaratan dan ketentuan apapun dalam Perjanjian ini, termasuk namun tidak terbatas pada seluruh perubahan, lampiran dan persyaratan dan ketentuan lainnya yang ditetapkan oleh Perusahaan mengenai segala hal;</li>
													<!--<li>terdaftarnya nama dan nomor identifikasi <i>Life Progress Advisor</i> (LPA). <i>Life Progress Advisor</i> (LPA) tidak memiliki hak untuk mendapatkan Kompensasi atas Bisnis apapun jika nama dan nomor identifikasinya tidak muncul pada permohonan.</li>-->
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika terdapat Polis atau kontrak yang diterbitkan setelah permohonan diserahkan oleh <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini yang kemudian diubah atau dikonversi menjadi Polis atau kontrak lain, maka Kompensasi sehubungan dengan Polis atau kontrak yang diubah atau dikonversi tersebut akan dibayarkan sesuai dengan aturan yang telah ditentukan oleh Perusahaan yang berlaku pada saat terjadinya perubahan atau konversi tersebut. <i>Life Progress Advisor</i> (LPA) tidak berhak atas Kompensasi dalam bentuk apapun sehubungan dengan Polis atau kontrak yang diubah atau dikonversi kecuali perubahan atau konversi tersebut dilakukan sesuai dengan peraturan Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal sebuah Polis diterbitkan dalam jangka waktu 6 (enam) bulan sebelum atau setelah dihentikannya Polis sebelumnya yang diterbitkan kepada tertanggung yang sama, maka Kompensasi sehubungan dengan Polis baru akan dibayar sesuai dengan ketetapan Perusahaan yang dibuat dengan mengacu pada aturan dari Perusahaan yang berlaku pada saat penerbitan Polis tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.5</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Tidak ada Kompensasi yang dibayarkan untuk Premi asuransi interim (<i>interim term premium</i>) atau untuk Premi ekstra yang timbul akibat alasan-alasan yang ditetapkan berdasarkan seleksi resiko (<i>underwriting</i>).
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.6</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal sebuah Polis sudah batal akibat tidak dibayarnya Premi dan kemudian diaktifkan kembali (pemulihan polis), maka Kompensasi sehubungan dengan Polis yang diaktifkan kembali tersebut (pemulihan polis) akan dibayarkan sesuai dengan aturan ketetapan Perusahaan pada saat terjadinya pengaktifan kembali (pemulihan polis) tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.7</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan pada setiap saat berhak untuk melakukan perhitungan (<i>offset</i>) atas setiap Kompensasi atau jumlah pembayaran lainnya yang terhutang oleh Perusahaan kepada Life Progress Advisor, dan menahan atau memotong dari Kompensasi atau jumlah pembayaran lainnya tersebut segala hutang, kewajiban atau tanggung jawab lainnya yang harus dibayar atau terhutang atau yang kelak harus dibayar atau terhutang oleh <i>Life Progress Advisor</i> (LPA) kepada Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">11.8</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan pada setiap saat berhak untuk melakukan perhitungan (<i>offset</i>) atas setiap Kompensasi atau jumlah pembayaran lainnya yang terhutang oleh Perusahaan kepada <i>Life Progress Advisor</i> (LPA), dan menahan atau memotong dari Kompensasi atau jumlah pembayaran lainnya tersebut segala bentuk manfaat, insentif, kontes dan penghargaan yang dibatalkan oleh Perusahaan akibat ketidakjujuran atau penipuan yang dilakukan oleh <i>Life Progress Advisor</i> (LPA), sebagaimana ditetapkan oleh Perusahaan atas keputusannya sendiri.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
												PASAL 12</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">
												PERNYATAAN DAN JAMINAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Setiap Pihak menyatakan dan menjamin kepada Pihak lainnya bahwa:</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">12.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Setiap Pihak berwenang membuat, melangsungkan dan melaksanakan Perjanjian ini dan dokumen-dokumen lain sehubungan dengan Perjanjian ini, serta telah melaksanakan semua tindakan dan persyaratan yang disyaratkan untuk sahnya penandatanganan dan pelaksanaan Perjanjian ini dan dokumen-dokumen lain sehubungan dengan Perjanjian
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">12.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini, tambahan, lampiran, perubahan dan dokumen-dokumen lainnya yang sehubungan dengan Perjanjian adalah sah, berlaku dan mengikat sah dan menimbulkan kewajiban hukum terhadap Para Pihak, sesuai dengan syarat dan ketentuan yang tercantum didalamnya.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">12.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Setiap izin, pemberian kewenangan atau persetujuan yang diperlukan oleh suatu Pihak sehubungan dengan pelaksanaan, penyerahan, keabsahan, keberlakuan Perjanjian ini atau pelaksanaannya oleh Pihak tersebut atas kewajibannya menurut Perjanjian ini telah diperoleh atau dibuat dan berlaku penuh.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 13</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">GANTI RUGI</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">13.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) wajib untuk mengganti kerugian yang timbul dan membayar kepada Perusahaan sejumlah uang yang sama dengan seluruh kerugian, kerusakan, tuntutan, permintaan, pengeluaran, dan bentuk kewajiban lainnya yang timbul atas Perusahaan sebagai akibat dari tindak penipuan, ketidakjujuran, tindakan yang tidak patut atau pelanggaran atau ketidakpatuhan <i>Life Progress Advisor</i> (LPA) atas syarat dan ketentuan Perjanjian ini beserta perubahannya (jika ada) atau pelanggaran terhadap peraturan perundang-undangan yang berlaku termasuk petunjuk dan pedoman yang ditetapkan oleh pemerintah atau Kode Etik Keagenan sebagaimana yang ditetapkan oleh AAJI, akibat kelalaian, kegagalan atau penolakan <i>Life Progress Advisor</i> (LPA) untuk memberikan jasa, termasuk segala bentuk pernyataan kesanggupan yang dibuat oleh dan segala tindakan yang dilakukan <i>Life Progress Advisor</i> (LPA) yang tidak sah berdasarkan Perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">13.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) membebaskan Perusahaan dari seluruh kerugian, kerusakan, tuntutan, permintaan, pengeluaran, dan bentuk kewajiban lainnya yang timbul atas Perusahaan sebagai akibat dari tindak penipuan, ketidakjujuran, tindakan yang tidak patut atau pelanggaran atau ketidakpatuhan <i>Life Progress Advisor</i> (LPA) atas syarat dan ketentuan Perjanjian ini beserta perubahannya (jika ada) atau pelanggaran terhadap peraturan perundang-undangan yang berlaku termasuk petunjuk dan pedoman yang ditetapkan oleh pemerintah atau Kode Etik Keagenan sebagaimana yang ditetapkan oleh AAJI, akibat kelalaian, kegagalan atau penolakan <i>Life Progress Advisor</i> (LPA) untuk memberikan jasa, termasuk segala bentuk pernyataan kesanggupan yang dibuat oleh dan segala tindakan yang dilakukan <i>Life Progress Advisor</i> (LPA) yang tidak sah berdasarkan Perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Ketentuan dalam Pasal ini tetap berlaku setelah pemutusan atau berakhirnya Perjanjian.</span></td>
												
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 14</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PENGALIHAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini, dan segala hak serta kewajiban yang timbul berdasarkan Perjanjian ini, dapat dialihkan oleh Perusahaan, baik seluruhnya maupun sebagian, kepada penggantinya atau perusahaan afiliasi. Namun demikian, <i>Life Progress Advisor</i> (LPA) dilarang mengalihkan atau bermaksud mengalihkan segala hak serta kewajiban yang mungkin dimiliki <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini tanpa persetujuan tertulis sebelumnya dari Perusahaan.</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<!--<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 15</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">BUKU DAN CATATAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) harus membuat dan menyediakan buku-buku dan catatan-catatan akuntansi serta dokumen lainnya yang layak dan lengkap dalam bentuk sebagaimana disyaratkan oleh Perusahaan dari waktu ke waktu yang dapat menjelaskan seluruh transaksi, masalah dan hal hal lainnya mengenai transaksi bisnis <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini. Buku-buku akuntansi, catatan-catatan, dan dokumen-dokumen lainnya disimpan selama berlakunya Perjanjian ini di tempat di mana <i>Life Progress Advisor</i> (LPA) ditempatkan atau tempat lain yang mungkin ditetapkan oleh Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan memiliki hak untuk setiap saat memeriksa buku-buku, catatan-catatan akuntansi, serta dokumen-dokumen tersebut, dan <i>Life Progress Advisor</i> (LPA) harus menyediakan seluruh fasilitas tersebut untuk keperluan pemeriksaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Seluruh catatan-catatan tersebut termasuk dalam Informasi Rahasia Perusahaan
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>-->
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 15</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KERAHASIAAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Tanpa mengurangi keberlakuan persyaratan dan ketentuan lainnya dalam Perjanjian ini (termasuk, untuk menghindari keraguan, Pasal 19.5 yang mensyaratkan <i>Life Progress Advisor</i> (LPA) untuk menyerahkan diantaranya, barang milik Perusahaan) dan seluruh dan segala hak-hak Perusahaan yang bersifat tersirat, selama jangka waktu dan setelah berakhirnya Perjanjian ini, <i>Life Progress Advisor</i> (LPA) dilarang :
												<ol type="a" align="justify">
													<li>menggunakan untuk kepentingan pribadi <i>Life Progress Advisor</i> (LPA) atau untuk kepentingan orang lain; atau</li>
													<li>mengungkapkan kepada siapapun; atau</li>
													<li>akibat kegagalan atau kelalaian dalam memberikan perhatian secara seksama (<i>due care</i>) atau melaksanakan seluruh uji tuntas (<i>due diligence</i>), menyebabkan atau mengizinkan pengungkapan secara tidak sah dari segala bentuk Informasi Rahasia mengenai atau yang berhubungan dengan Perusahaan, yang mungkin diterima, digunakan atau didapatkan oleh <i>Life Progress Advisor</i> (LPA) selama masa berlakunya Perjanjian ini. Seluruh Informasi Rahasia tersebut selamanya harus tetap menjadi barang milik atau properti Perusahaan.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Untuk menghindari keraguan, kewajiban <i>Life Progress Advisor</i> (LPA) mengenai kerahasiaan sebagaimana diatur dalam Pasal ini juga berlaku untuk Informasi Rahasia yang disimpan atau disalin dengan cara dan bentuk apapun, baik dalam bentuk dokumen, rekaman atau program komputer.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jumlah Kompensasi yang dibayarkan dari waktu ke waktu berdasarkan Perjanjian ini harus diperlakukan secara sangat rahasia.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">15.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Ketentuan Kerahasiaan akan tetap berlaku walaupun Perjanjian ini berakhir.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 16</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEADAAN MEMAKSA / FORCE MAJEURE</span></b></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">16.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan berhak menetapkan berdasarkan kebijaksanaannya sendiri mengenai terjadi atau tidaknya suatu Keadaan Memaksa / Force Majeure.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">16.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila akibat dari Keadaan Memaksa / <i>Force Majeure</i> tersebut Perusahaan atau <i>Life Progress Advisor</i> (LPA), tidak dapat melaksanakan sebagian ataupun seluruh kewajibannya berdasarkan Perjanjian ini, Perusahaan atau <i>Life Progress Advisor</i> (LPA),  diwajibkan menyampaikan pemberitahuan tertulis maksimal 3 (tiga) hari kerja sejak terjadinya Keadaan Memaksa / Force Majeure kepada Pihak lainnya dalam Perjanjian ini yang menjelaskan secara spesifik kewajiban apa yang tidak dapat dilakukannya dan Keadaan Memaksa / Force Majeure yang menyebabkannya. Setelah pemberitahuan tertulis disampaikan dan selama Keadaan Memaksa / Force Majeure tersebut masih berlangsung, kewajiban yang tidak dapat dilakukan akibat adanya Keadaan Memaksa / Force Majeure tersebut akan ditunda pelaksanaannya.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">16.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan atau <i>Life Progress Advisor</i> (LPA) tidak dapat dinyatakan telah melakukan kelalaian atau pelanggaran terhadap Perjanjian ini, apabila telah melakukan pemberitahuan tertulis kepada Pihak lainnya sesuai dengan jangka waktu sebagaimana disebutkan dalam ayat 16.2 Pasal ini.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">16.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan atau <i>Life Progress Advisor</i> (LPA) wajib segera memberitahu Pihak lainnya dalam Perjanjian ini mengenai telah selesainya Keadaan Memaksa / <i>Force Majeure</i>.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 17</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PEMBEKUAN SEMENTARA PERJANJIAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">17.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika menurut pendapat Perusahaan telah terjadi suatu peristiwa tersebut dalam Pasal  18.3 (kecuali Pasal 18.3.b), maka Perusahaan dapat menetapkan dengan kebijaksanaannya sendiri untuk menghentikan sementara pelaksanaan Perjanjian ini dengan mengirimkan Pemberitahuan tanpa kewajiban menjelaskan alasan penghentian sementara tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">17.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika ternyata pelaksanaan dari Perjanjian ini memang harus dihentikan sementara untuk alasan apapun maka:
												<ol type="a" align="justify">
													<li><i>Life Progress Advisor</i> (LPA) harus berusaha sebaik mungkin untuk bekerja sama dengan Perusahaan atau pihak lainnya dalam rangka melakukan penyelidikan atas kejadian yang dimaksud dalam Pasal 18.3 Perjanjian  ini (kecuali Pasal 18.3.b) dan harus memberikan seluruh informasi, dokumen dan bantuan yang diperlukan untuk maksud-maksud pelaksanaan penyelidikan tersebut;</li>
													<li><i>Life Progress Advisor</i> (LPA) dilarang berusaha melaksanakan kegiatan Bisnis apapun atau menyediakan jasa sebagaimana diatur dalam Perjanjian ini yang berkaitan secara langsung maupun tidak langsung dengan usaha perasuransian tanpa persetujuan tertulis sebelumnya dari Perusahaan; dan</li>
													<li>Perusahaan dapat menentukan sendiri untuk menahan seluruh pembayaran Kompensasi (baik yang telah diperhitungkan maupun yang belum).</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 18</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">EVALUASI DAN BERAKHIRNYA PERJANJIAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat melakukan evaluasi terhadap kinerja maupun pencapaian <i>Life Progress Advisor</i> (LPA) setiap 3 (tiga) bulan, dimana Perusahaan dapat mengakhiri secara sepihak apabila kinerja <i>Life Progress Advisor</i> (LPA) tidak sesuai harapan Perusahaan dan/atau tidak mencapai target penjualan yang telah ditetapkan Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Tanpa mengurangi keberlakuan persyaratan dan ketentuan lainnya dalam Perjanjian ini, Perusahaan atau <i>Life Progress Advisor</i> (LPA) dapat pada setiap saat mengakhiri Perjanjian ini dengan memberikan Pemberitahuan sekurang-kurangnya 1 (satu) bulan sebelumnya kepada masing masing Pihak.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat mengakhiri Perjanjian ini dengan segera dengan mengirimkan Pemberitahuan (namun dalam hal Pasal 18.3.b maka pemberhentian tersebut dapat dilaksanakan tanpa Pemberitahuan) kepada <i>Life Progress Advisor</i> (LPA) jika:
												<ol type="a" align="justify">
													<li>izin, akreditasi, otorisasi atau registrasi <i>Life Progress Advisor</i> (LPA) dari atau pada lembaga pemerintah terkait atau badan regulator atau badan pengawas dicabut, dibatalkan atau dihentikan;</li>
													<li><i>Life Progress Advisor</i> (LPA) meninggal dunia;</li>
													<li>menurut Perusahaan <i>Life Progress Advisor</i> (LPA) terbukti atau telah melakukan perbuatan Fraud berdasarkan bukti-bukti yang cukup sebagaimana dijelaskan dalam Pasal 4.2 Perjanjian ini;</li>
													<li>menurut pendapat Perusahaan, <i>Life Progress Advisor</i> (LPA) melakukan tindakan yang menyebabkan gangguan atau campur tangan dalam operasional Perusahaan;</li>
													<li><i>Life Progress Advisor</i> (LPA) melanggar hukum termasuk tetapi tidak terbatas pada penggelapan, penipuan atau perusakan barang milik Perusahaan atau melanggar undang-undang atau peraturan lain;</li>
													<li><i>Life Progress Advisor</i> (LPA) melangsungkan perjanjian atau pengaturan dengan perusahaan lain atau orang lain (baik secara lisan maupun tertulis) untuk bertindak selaku penasehat keuangan;</li>
													<li><i>Life Progress Advisor</i> (LPA) memberikan pernyataan tentang fakta-fakta yang salah dalam lamarannya sebagai <i>Life Progress Advisor</i> (LPA) atau selama Masa Kemitraan;</li>
													<li><i>Life Progress Advisor</i> (LPA) tidak memenuhi persyaratan pelatihan, rencana bisnis, proses penjualan, manajemen kegiatan, produksi (termasuk tetapi tidak terbatas pada Case Count), Persistensi atau persyaratan lainnya dalam kaitannya dengan penunjukan <i>Life Progress Advisor</i> (LPA) berdasarkan Perjanjian ini yang mungkin ditentukan oleh Perusahaan atau dipersyaratkan oleh undang-undang, perundangan, aturan, peraturan yang berlaku, kode dan pedoman pihak yang berwenang yang diberlakukan dari waktu ke waktu; atau</li>
													<li><i>Life Progress Advisor</i> (LPA) gagal memenuhi komponen mana saja dari KPI berdasarkan kegagalan <i>Life Progress Advisor</i> (LPA) untuk mencapai jumlah yang dipersyaratkan berdasarkan KPI.</li>
													<li><i>Life Progress Advisor</i> (LPA) melanggar peraturan perundang-undangan, atau kode etik keagenan baik Kode Etik Bisnis Perusahaan atau Kode Etik Keagenan yang diterbitkan oleh AAJI atau instansi lain pengganti AAJI, atau melanggar standar praktek keagenan atau terlibat dalam suatu tindakan yang menurut pendapat Perusahaan yang wajar dapat menyebabkan reputasi buruk terhadap Perusahaan atau merugikan kepentingan Perusahaan;</li>
													<li><i>Life Progress Advisor</i> (LPA) melakukan wanprestasi atau melanggar isi Perjanjian ini;</li>
													<li><i>Life Progress Advisor</i> (LPA) mengalami cacat tubuh secara tetap dan permanen sehingga mengakibatkan <i>Life Progress Advisor</i> (LPA) tidak mampu menjalankan kewajibannya.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"></span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Pengakhiran Perjanjian akan dinyatakan efektif setelah ditetapkan oleh Perusahaan.</span></td>
												
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal berakhirnya Perjanjian ini, maka pembayaran atas Kompensasi akan dihentikan segera (baik yang telah diperhitungkan maupun yang belum). Seluruh hak-hak <i>Life Progress Advisor</i> (LPA) atas unsur manapun dari Kompensasi yang telah diperhitungkan sebelum berakhirnya Perjanjian ini segera menjadi hangus pada saat berakhirnya Perjanjian ini, dan <i>Life Progress Advisor</i> (LPA) dengan demikian melepaskan setiap dan seluruh haknya untuk menerima pembayaran tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.5</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Pada saat berakhirnya Perjanjian ini:
												<ol type="a" align="justify">
													<li><i>Life Progress Advisor</i> (LPA) dilarang menyatakan dirinya sebagai bagian dari Perusahaan untuk tujuan apapun juga;</li>
													<li>tidak diperkenankan memasuki areal perkantoran dan/atau kantor pemasaran termasuk ruang-ruang kerja Perusahaan tanpa persetujuan Perusahaan ;</li>
													<!--<li><i>Life Progress Advisor</i> (LPA) tidak akan selama enam bulan sejak tanggal pengakhiran, baik untuk dirinya sendiri atau untuk Perusahaan, orang, korporasi, atau asosiasi lain, secara langsung maupun tidak langsung menerima pembayaran dalam bentuk apapun;</li>-->
													<li>terlibat dan bergabung dengan perusahaan asuransi lain sebelum Perusahaan menyepakati pengakhiran Perjanjian, kewajiban yang dinyatakan dalam Perjanjian ini diselesaikan oleh <i>Life Progress Advisor</i> (LPA), dan lisensi keagenan atau pemasaran yang disponsori oleh Perusahaan dicabut oleh lembaga penerbit lisensi;</li>
													<li><i>Life Progress Advisor</i> (LPA) dan/atau ahli warisnya bertanggung jawab dan wajib segera menyelesaikan segala kewajiban-kewajiban dan/atau hutang (jika ada) kepada Perusahaan yang timbul dari Perjanjian ini.</li>
													<li><i>Life Progress Advisor</i> (LPA) wajib  segera menyerahkan kepada Perusahaan seluruh daftar dan informasi mengenai para  Pemegang Polis dan/atau Tertanggung, karyawan, penasehat keuangan, korespondensi, dokumen-dokumen, dan seluruh barang lainnya yang merupakan milik Perusahaan dan/atau mengandung segala Informasi Rahasia (sebagaimana dimaksud dalam Pasal 15) yang mungkin dimiliki atau dikuasai oleh <i>Life Progress Advisor</i> (LPA), termasuk, untuk menghindari keraguan, sebagaimana dimaksud dalam Pasal 15 di atas;</li>
													<li><i>Life Progress Advisor</i> (LPA) harus dengan segera menyerahkan kepada Perusahaan seluruh material yang dapat digunakan kembali (termasuk namun tidak terbatas pada buku harian digital, personal computer, notebook computer,  flash disk, atau media lainnya) yang mengandung Informasi Rahasia (sebagaimana dimaksud dalam Pasal 16) untuk maksud penghapusan Informasi Rahasia tersebut;</li>
													<li><i>Life Progress Advisor</i> (LPA) berkewajiban mengembalikan seluruh inventaris Perusahaan dan dokumen lain yang masih dimiliki dan atau dikuasai oleh <i>Life Progress Advisor</i> (LPA); dan</li>
													<li>Perusahaan, jika menurut pendapat atau pertimbangannya dianggap patut, dapat mempublikasikan dan/atau mengedarkan kepada siapapun pemberitahuan mengenai pemberhentian penunjukan <i>Life Progress Advisor</i> (LPA).</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.6</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) mengakui dan menyatakan bahwa Pasal 8, Pasal 13, Pasal 15, dan ketentuan pasal-pasal lainnya  dalam Perjanjian ini yang relevan yang dapat dilaksanakan dalam keadaan apapun.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.7</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Para Pihak mengenyampingkan keberlakuan Pasal 1266 Kitab Undang-undang Hukum Perdata sejauh diperlukannya kepastian bahwa diperolehnya intervensi yudisial atau persetujuan untuk pembatalan atau pengakhiran Perjanjian ini ataupun untuk pemberian ganti rugi adalah tidak diperlukan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">18.8</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal <i>Life Progress Advisor</i> (LPA) tidak memenuhi kenentuan dan persyaratan minimum yang ditetapkan oleh Perusahaan, maka Perusahaan dapat melakukan pengakhiran Perjanjian ini tanpa adanya tuntutan hukum dari Pihak <i>Life Progress Advisor</i> (LPA), serta Perusahaan berhak menerima kompensasi / ganti rugi dari <i>Life Progress Advisor</i> (LPA) atas biaya-biaya yang telah dikeluarkan selama proses rekrutmen dan Pelatihan / Lisensi AAJI.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 19</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEBEBASAN BERKONTRAK</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">19.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini ditandatangani oleh PARA PIHAK dalam keadaan sehat fisik maupun mental tanpa adanya penipuan, kesalahan dan atau paksaan dari pihak lain manapun juga.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">19.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika di kemudian hari Perjanjian ini ternyata mengandung kesalahan atau terdapat hal-hal yang belum cukup diatur, maka Perjanjian ini dapat diubah dan atau ditambahkan secara tertulis, dan merupakan addendum yang tidak terpisahkan dari Perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 20</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KETENTUAN LAIN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">20.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika pada suatu saat terdapat ketentuan dalam Perjanjian ini yang dinyatakan bertentangan dengan hukum yang berlaku atau menjadi tidak sah, atau tidak dapat diberlakukan, baik seluruhnya maupun sebagian, berdasarkan hukum perundangan yang berlaku dalam suatu wilayah hukum tertentu, maka legalitas, keabsahan dan keberlakuan ketentuan lainnya dalam Perjanjian ini (atau dalam hal adanya bagian dari ketentuan yang dinyatakan bertentangan dengan hukum yang berlaku atau menjadi tidak sah atau tidak dapat diberlakukan tersebut) ) berdasarkan hukum perundangan yang berlaku dalam wilayah hukum tersebut atau wilayah lainnya atau legalitas, keabsahan dan keberlakuan ketentuan lainnya tersebut - tidak akan terpengaruh atau berkurang.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">20.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika pada suatu saat terdapat ketentuan dalam Perjanjian ini yang dinyatakan bertentangan dengan hukum yang berlaku atau menjadi tidak sah, atau tidak dapat diberlakukan, baik seluruhnya maupun sebagian, berdasarkan hukum perundangan yang berlaku dalam suatu wilayah hukum tertentu, namun dapat dinyatakan berlaku, sah dan dapat diberlakukan jika ada bagian yang dihilangkan atau lingkup atau jangka waktunya dikurangi atau dibatasi, maka ketentuan tersebut akan berlaku dalam wilayah hukum tersebut dengan segala bentuk perubahan atau modifikasi yang dianggap perlu agar ketentuan tersebut menjadi berlaku, sah dan dapat diberlakukan dalam wilayah hukum yang bersangkutan.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 21</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PEMBERITAHUAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">21.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Semua Pemberitahuan harus tertulis dan ditandatangani oleh Perusahaan atau <i>Life Progress Advisor</i> (LPA) (sebagaimana berlaku).
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">21.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Setiap Pemberitahuan yang diberikan oleh masing-masing pihak dalam Perjanjian ini dianggap telah disampaikan secara patut atau diterima oleh pihak yang menerima pada saat disampaikan, jika disampaikan secara langsung dan pada hari kerja kelima setelah tanggal pengiriman, jika dilakukan melalui surat/pos tercatat ke alamat terakhir Life Progress Advisor (LPA yang diketahui Perusahaan, atau sebagaimana tercantum dalam Perjanjian ini, atau ke alamat Kantor Representatif dimana <i>Life Progress Advisor</i> (LPA) ditugaskan oleh Perusahaan atau ke alamat Kantor Representatif (sebagaimana berlaku). Dalam hal pengiriman Pemberitahuan dilakukan melalui faksimili atau media elektronik, suatu pemberitahuan dianggap telah diterima oleh pihak penerima pada tanggal pengiriman itu asalkan setelah itu salinan asli dari faksimili atau berita elektronik yang telah dibubuhi tandatangan dikirimkan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">21.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Setiap pihak dapat merubah rincian alamatnya dengan memberikan Pemberitahuan sekurangnya 5 (lima) hari sebelumnya kepada pihak yang lain.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 22</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">KETENTUAN UMUM</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">22.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Pengesampingan atas pelaksanaan salah satu syarat atau ketentuan dalam Perjanjian ini atau pengesampingan atas pelanggaran terhadap salah satu syarat dan ketentuan tersebut bukan merupakan atau tidak dapat dianggap sebagai pengesampingan atas syarat dan ketentuan lainnya atau atas pelanggaran atau pelanggaran-pelanggaran lainnya yang mungkin terjadi di kemudian hari terhadap suatu syarat atau ketentuan atau dianggap sebagai pengesampingan yang berkelanjutan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">22.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Seluruh Perjanjian dan Perubahan
												<ol type="a" align="justify">
													<li>Perjanjian ini merupakan keseluruhan perjanjian di antara Perusahaan dan <i>Life Progress Advisor</i> (LPA), sehubungan dengan transaksi yang dimaksudkan di sini, dan, kecuali disebutkan sebaliknya dalam Perjanjian ini, menggantikan semua perjanjian yang telah dibuat sebelumnya antara <i>Life Progress Advisor</i> (LPA) dan Perusahaan, komitmen maupun kesepahaman baik lisan maupun tulisan mengenai hal yang diatur di sini.</li>
													<li>Tidak ada perubahan, modifikasi atau pelepasan dari Perjanjian ini yang berlaku sah atau mengikat kecuali dinyatakan secara tertulis dan ditandatangani dan disampaikan secara sah oleh Perusahaan kepada siapa pelaksanaan dari perubahan, modifikasi atau pelepasan tersebut dimaksudkan.</li>
													<li>Dalam periode 1 (satu) tahun setelah dihentikannya Perjanjian ini, <i>Life Progress Advisor</i> (LPA)  tidak diperkenankan untuk bersaing dengan Perusahaan secara langsung maupun tidak langsung (dalam kapasitasnya atau dalam kaitannya dengan orang lain, firma lain, perusahaan lain atau entitas lain) meminta, mempromosikan, atau mendekati dengan cara apa pun dengan tujuan untuk melakukan Bisnis dengan siapapun, firma manapun, perusahaan manapun atau entitas manapun yang adalah klien atau prospektif klien dari Perusahaan dalam jangka waktu tertentu, dan yang dengan siapa <i>Life Progress Advisor</i> (LPA) melakukan transaksi material dalam menyediakan jasanya (atau yang patut diketahui olehnya bahwa ia adalah klien atau prospektif klien), selama jangka waktu tertentu, dengan tujuan melakukan Bisnis atau aktifitas yang telah dilakukan oleh Perusahaan selama jangka waktu tertentu dan yang dalam Bisnis atau aktifitas mana <i>Life Progress Advisor</i> (LPA) berkaitan dengan pelaksanaan jasa <i>Life Progress Advisor</i> (LPA) selama jangka waktu tertentu.</li>
													<li>Judul-judul yang digunakan dalam Perjanjian ini hanya untuk kemudahan saja dan tidak merupakan bagian dari Perjanjian ini.</li>
													<li>Setiap syarat atau ketentuan Perjanjian ini yang atau menjadi dilarang atau tidak dapat dilaksanakan oleh karena alasan apapun juga di yurisdiksi manapun juga, akan menjadi, dalam yurisdiksi tersebut, tidak berlaku sejauh larangan atau tidak berlakunya ketentuan tersebut dan larangan atau tidak berlakunya ketentuan tersebut tidak menyebabkan tidak absahnya ketentuan lain dari Perjanjian ini atau berdampak terhadap keabsahan atau keberlakukan dari ketentuan-ketentuan lainnya.</li>
													<li>Seluruh dokumen atau lampiran atau perubahan Perjanjian yang akan dibuat dikemudian hari oleh Para Pihak merupakan satu kesatuan dan bagian yang tidak terpisahkan dari Perjanjian.</li>
												</ol>
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 23</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">HUKUM YANG MENGATUR</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini diatur dan dilaksanakan berdasarkan hukum Negara Republik Indonesia.</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 24</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PENYELESAIAN PERSELISIHAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">24.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Semua perselisihan, pertentangan atau perbedaan yang mungkin timbul antara Para Pihak dari atau sehubungan dengan atau berkaitan dengan Perjanjian ini atau pelaksanaannya atau dari pelanggaran terhadap Perjanjian ini (“Perselisihan”), akan diselesaikan secara musyawarah dengan itikad baik.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">24.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Jika Perselisihan tersebut tidak dapat diselesaikan secara musyawarah dalam waktu 60 (enam puluh) hari setelah Pemberitahuan dari satu Pihak ke Pihak lain,  maka Para Pihak sepakat menyerahkan perselisihan tersebut melalui pengadilan dan untuk itu Para Pihak sepakat memilih tempat kedudukan/domisili hukum Perusahaan yang umum dan tetap di kantor Kepaniteraan Pengadilan Negeri Jakarta Selatan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">24.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Biaya-biaya yang timbul dalam rangka penyelesaian Perselisihan tersebut merupakan beban dan tanggung jawab masing-masing pihak.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 25</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">MASA BERLAKU</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">25.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini secara hukum mengikat mulai berlaku sejak ditandatangani oleh Para Pihak untuk jangka waktu yang tidak ditentukan sampai dengan terjadinya perubahan pada Perjanjian ini (apabila ada).
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">25.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini dapat berakhir berdasarkan ketentuan-ketentuan sebagaimana ditetapkan dalam Pasal 18 Perjanjian ini dan/atau dapat berakhir berdasarkan kebijakan Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">25.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Segala hak dan kewajiban <i>Life Progress Advisor</i> (LPA) berlaku efeketif sejak Pihak Pertama menyatakan  dan menerbitkan secara tertulis Surat Penetapan kepada <i>Life Progress Advisor</i> (LPA).
												</span></td>
											</tr>
											<!--<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">25.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat melakukan evaluasi terhadap kinerja maupun pencapaian <i>Life Progress Advisor</i> (LPA) setiap 3 (tiga) bulan, dimana Perusahaan dapat mengakhiri secara sepihak apabila kinerja <i>Life Progress Advisor</i> (LPA) tidak sesuai harapan Perusahaan dan/atau tidak mencapai target penjualan yang telah ditetapkan Perusahaan.
												</span></td>
											</tr>-->
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 26</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">SALINAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini dapat ditandatangani dalam beberapa salinan. Semua salinan, secara bersama-sama, merupakan satu dokumen. Suatu Pihak dapat menandatangani Perjanjian ini dengan cara menandatangani suatu salinan.</span></td>
												
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 27</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">SARANA, PRASARANA, FASILITAS DAN PERANGKAT PERUSAHAAN</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">27.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam Perjanjian ini Perusahaan akan menyediakan sarana, prasarana, fasilitas dan perangkat yang dianggap perlu dalam menunjang <i>Life Progress Advisor</i> (LPA) dalam menjalankan pekerjaannya, dimana <i>Life Progress Advisor</i> (LPA) akan menandatangani pernyataan tertulis atau berita acara penggunaan fasilitas Perusahaan yang dibuat secara terpisah daripada Perjanjian ini namun mengikat dan merupakan satu kesatuan yang tidak terpisahkan dalam perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">27.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) setuju bahwa hanya piranti lunak (<i>software</i>) yang telah disetujui oleh Perusahaan yang dapat dipasang atau di install di dalam komputer Perusahaan dan pemasangan harus dilakukan oleh staf departemen IT Perusahaan. Perjanjian penggunaan piranti lunak (software licencing agreement) harus ada di tempat <i>Life Progress Advisor</i> (LPA) berada ataupun pada departemen IT Perusahaan. Definisi piranti lunak tersebut termasuk piranti lunak berbasis shareware, trial license ataupun evaluation copy.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">27.3</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) tidak diizinkan untuk menggunakan piranti lunak asli yang sudah habis masa berlakunya. Penggunaan komputer yang bukan milik Perusahaan (dengan atau tanpa piranti lunak yang asli) pada jaringan sistem komputer Perusahaan tidak diperbolehkan kecuali sudah dilakukan pemeriksaan dan disetujui oleh departemen IT Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">27.4</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan tidak turut bertanggungjawab atas penggunaan piranti lunak dan/atau penggunaan komputer oleh <i>Life Progress Advisor</i> (LPA) yang tidak disetujui oleh Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">27.5</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila terdapat kehilangan atau kerusakan atas sarana, prasarana, fasilitas dan perangkat alat–alat yang dimiliki Perusahaan termasuk dalam hal ini adalah Notebook, PC, Smartphone, dan fasilitas lainnya yang disediakan Perusahaan untuk dipinjamkan kepada <i>Life Progress Advisor</i> (LPA) guna memperlancar kegiatan usaha Perusahaan yang diakibatkan karena kelalaian atau kesalahan <i>Life Progress Advisor</i> (LPA), maka <i>Life Progress Advisor</i> (LPA) setuju untuk memberikan ganti kerugian sejumlah kerugian yang timbul akibat kelalaian atau kesalahan yang telah dilakukannya tersebut.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">27.6</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal berakhirnya perjanjian sebagaimana dalam Pasal 19 Perjanjian ini, maka <i>Life Progress Advisor</i> (LPA) wajib mengembalikan segala fasilitas yang telah disediakan oleh Perusahaan paling lambat 1 (satu) hari setelah surat pengakhiran perjanjian disampaikan kepada <i>Life Progress Advisor</i> (LPA), adapun pengembalian fasilitas Perusahaan tersebut diserahkan melalui <i><i>Alternative Distribution Regional Business Manager (ARM)</i></i> dengan bukti tertulis dalam tanda terima dokumen sebagai bukti penyerahan.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 28</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PENGGUNAAN E-MAIL</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">28.1</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang untuk membuat, menyebarkan, meneruskan atau mengirim email ke pihak lain kecuali <i>Life Progress Advisor</i> (LPA) mengetahui dan dapat mengkonfirmasi mengenai ketepatan atau kebenaran atas isi dari informasi dalam email dimaksud. <i>Life Progress Advisor</i> (LPA) bertanggung jawab atas setiap penggunaan email Perusahaan yang tidak berhubungan dengan tugas <i>Life Progress Advisor</i> (LPA) di Perusahaan. Perusahaan tidak bertanggung jawab dan tidak turut bertanggungjawab atas penggunaan email yang tidak sesuai dengan ketentuan ini dan peraturan IT Perusahaan.
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">28.2</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i> (LPA) dilarang untuk menggunakan akun email selain yang telah disediakan oleh Perusahaan dalam kaitannya dengan pelaksanaan Perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 29</span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<b><span lang="IN" style="font-family: Arial,sans-serif">LAMPIRAN</span></b></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Lampiran-lampiran perjanjian tersebut dibawah ini merupakan bagian yang tidak terpisahkan dalam perjanjian ini :</span></td>
												
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Kode Etik Keagenan (lampiran 1);</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Pakta Intergritas (lampiran 2);</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Surat Penetapan Agen (lampiran 3).</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Demikian Perjanjian ini dibuat pada tanggal sebagaimana tersebut di atas. Perjanjian ini adalah merupakan dokumen elektronik yang dinyatakan sah walaupun tanpa tanda tangan basah Para Pihak. Validasi terhadap data dalam Perjanjian ini dapat dilakukan melalui URL pada QR Code yang tercetak sesuai nama yang tercantum sebagai Para Pihak yang menyetujui Perjanjian ini.
												</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan,</span></p></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -38.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor (LPA)</i>, </span></p></td>
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">PT ASURANSI JIWA IFG</span></p></td>
												
											</tr>
											
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p></td>
												
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p style="text-align: left;"><strong>&nbsp;</strong><img src="https://chart.googleapis.com/chart?chs=130x130&cht=qr&chl=<?='EPKAJ-'.$row["NOPKAJAGEN"].' / '.$row["NIK_TTD"].' / '.$row["NAMA_RAH"] . ' / ' . SUBSTR($row['QRAGEN'],-19) ;?>&choe=UTF-8&chld=H|0" /></p></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: -5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -34.4pt"><strong>&nbsp;</strong><img src="https://chart.googleapis.com/chart?chs=130x130&cht=qr&chl=<?=$row["QRAGEN"];?>&choe=UTF-8&chld=H|0" /></p></td>
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p></td>	
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><?=$row["NAMA_TTD"];?></span></p></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -38.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><?= $row["NAMAKLIEN1"];?></span></p></td>
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Head of Bancassurance & Alternative Distribution Sales</span></p></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -38.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><i>Life Progress Advisor</i></span></p></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr style="height: 17.45pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.45pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Catatan :</span></td>
											</tr>
											<tr style="height: 17.45pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.45pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in; text-align: justify;">
													Dokumen Elektronik ini dinyatakan sah walaupun tanpa tanda tangan basah dari Para Pihak. Validasi terhadap data dalam Dokumen Elektronik ini dapat dilakukan melalui URL pada QR Qode yang tercetak.
													Sesuai nama yang tercantum di bawahnya sebagai Para Pihak yang menyetujui atas PKAJ ini.
												</td>
											</tr>
											<!--tr style="height: 17.45pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.45pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoBodyTextIndent2" style="text-align: justify; text-indent: -.25in; line-height: normal; margin-left: .25in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">1.<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;
												</span>Untuk Kantor Cabang bermeterai (PKAJ dengan tanda tangan AGEN di atas meterai)</span></td>
											</tr>
											<tr style="height: 17.45pt">
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.45pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoBodyTextIndent2" style="text-align: justify; text-indent: -.25in; line-height: normal; margin-left: .25in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">2.<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;
												</span>Untuk AGEN yang bersangkutan bermaterai (PKAJ dengan tanda tangan Kepala Cabang di atas meterai)</span></td>
											</tr-->
											<tr height="0">
												<td width="29" style="border: medium none">&nbsp;</td>
												<td width="29" style="border: medium none">&nbsp;</td>
												<td width="4" style="border: medium none">&nbsp;</td>
												<td width="52" style="border: medium none">&nbsp;</td>
												<td width="80" style="border: medium none">&nbsp;</td>
												<td width="18" style="border: medium none">&nbsp;</td>
												<td width="22" style="border: medium none">&nbsp;</td>
												<td width="2" style="border: medium none"></td>
												<td width="18" style="border: medium none">&nbsp;</td>
												<td width="182" style="border: medium none">&nbsp;</td>
												<td width="205" style="border: medium none">&nbsp;</td>
											</tr>
											<?php  
											include('kode_etik.php');
											include('pakta_integritas.php'); 
											?>
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
                    </form>
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
    popupWin.document.write('<html><body onload="window.print()">' + printableArea.innerHTML + '</html>');
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

