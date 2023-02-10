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
        <li>
            <a href="<?="$this->url/pkajonline"?>">Pkaj Online</a>
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
                        <span class="caption-subject font-green-sharp bold uppercase">Cetak PKAJ</span>
                    </div>
                </div>
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
														<span lang="FI" style="font-family: Arial,sans-serif">NO.<?=$row["NOPKAJAGEN"];?>/IFGL/BAS/<?=$row["BLN"];?>/<?=$row["THN"];?>
															
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
												<span lang="FI" style="font-family: Arial,sans-serif">Graha CIMB Niaga Lt. 6, Jl.Jend. Sudirman Kav. 58 Jakarta 12190</span></td>
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
												<span lang="FI" style="font-family: Arial,sans-serif">1500176</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span style="font-family: Arial,sans-serif">
												bertindak dalam jabatannya tersebut berdasarkan Surat Kuasa PT Asuransi Jiwa IFG, Nomor 5/SKU/AJIFG/U/I/2023 tanggal 24 Januari 2023, dan karenanya berwenang bertindak untuk dan atas nama PT Asuransi Jiwa IFG, berkedudukan dan berkantor di Jakarta Selatan sesuai dengan Anggaran Dasar PT Asuransi Jiwa IFG yang termuat dalam Akta Pendirian Perseroan Terbatas PT Asuransi Jiwa IFG Nomor 39 tanggal 22 Oktober 2020 yang dibuat di hadapan Hadijah, S.H., Notaris di Jakarta, sebagaimana yang terakhir disesuaikan dan ditambahkan dengan Akta Pernyataan Keputusan Para Pemegang Saham PT Asuransi Jiwa IFG Nomor 62 tanggal 31 Mei 2022 dan telah dicatat dalam Keputusan Kementerian Hukum dan Hak Asasi Manusia Republik Indonesia sesuai Surat Nomor AHU-AH.01.03-0249062 tanggal 13 Juni 2022, selanjutnya disebut “<b>Perusahaan</b>”; dan
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
												<span lang="FI" style="font-family: Arial,sans-serif">Alamat (Sesuai KTP)</span></td>
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
												<span lang="FI" style="font-family: Arial,sans-serif">Nomor KTP</span></td>
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
												<span lang="FI" style="font-family: Arial,sans-serif">bertindak untuk dan atas nama diri sendiri, selanjutnya disebut “<b><i>Mitra Pemasar Bisnis Bancassurance</i></b>”.</span></td>
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
														Perusahaan dan Mitra Pemasar Bisnis Bancassurance secara bersama-sama disebut sebagai “<b>Para Pihak</b>” atau masing-masing disebut “<b>Pihak</b>” dalam kedudukannya sebagaimana tersebut di atas, terlebih dahulu menerangkan hal-hal sebagai berikut : 
														<ul align="justify" style="font-family: Arial,sans-serif">
															<li>Bahwa Perusahaan adalah suatu perseroan terbatas yang bergerak di bidang asuransi jiwa yang produknya dipasarkan melalui Mitra Pemasar Bisnis Bancassurance.
															<li>Bahwa Mitra Pemasar Bisnis Bancassurance merupakan professional yang telah memiliki Sertifikasi dan Lisensi AAJI, serta terdaftar di Otoritas Jasa Keuangan dengan keahlian dan perizinan yang dimilikinya dalam Perjanjian ini bersedia bertindak untuk dan atas nama Perusahaan dalam melakukan kegiatan jasa pemasaran produk-produk asuransi yang dikembangkan dan/atau diterbitkan oleh Perusahaan.</li>
															
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
												<span style="font-family: Arial,sans-serif">1.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif"><b>Perusahaan</b> adalah PT Asuransi Jiwa IFG, atau penggantinya menurut hukum;
													</span>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">2.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Bisnis</b> adalah usaha perasuransian yang dijalankan oleh Perusahaan, yang meliputi penjualan produk asuransi, dan meliputi pula usaha lainnya dari Perusahaan yang dijalankan dari waktu ke waktu;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">3.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Calon Pemegang Polis</b> adalah subyek hukum yang memiliki <i>insurable interest</i> dengan Tertanggung yang akan mengadakan perjanjian asuransi dengan Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">4.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Calon Tertanggung/Peserta</b> adalah orang yang atas jiwanya akan diadakan perjanjian asuransi dengan Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">5.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i>Case Count</i></b> adalah jumlah polis baru berdasarkan nama para Pemegang Polis yang pembayaran premi pertamanya telah diterima dan disetujui Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">6.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Evaluasi</b> adalah penilaian yang dilakukan oleh Perusahaan berdasarkan pencapaian kinerja Mitra Pemasar Bisnis Bancassurance sesuai dengan ketentuan yang telah ditetapkan oleh Perusahaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">7.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b><i>Field Underwriting</i></b> adalah kewajiban Mitra Pemasar Bisnis Bancassurance melakukan verifikasi terhadap kebenaran, kelengkapan dan akurasi data-data/informasi, termasuk sumber dana dari Calon Pemegang Polis dan/atau Calon Tertanggung/Peserta sebagaimana isian pada Surat Permintaan Asuransi Jiwa (SPAJ) serta memberikan informasi penting lainnya kepada  Perusahaan tentang kondisi Calon Pemegang Polis dan/atau Calon Tertanggung/Peserta yang dapat mempengaruhi  Perusahaan dalam memutuskan penerimaan/penolakan penutupan asuransi;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">8.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Indikator Kinerja Utama atau KPI</b> adalah ukuran yang ditetapkan oleh Perusahaan dari waktu ke waktu untuk mengukur tingkatan minimum dari standar kinerja seorang Mitra Pemasar Bisnis Bancassurance  untuk mempertahankan penunjukan Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini dan sebagaimana tersebut dalam Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">9.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Informasi Rahasia</b> adalah segala informasi yang bersifat teknis maupun komersial dalam bentuk apapun baik secara tertulis dengan diberi tanda “Rahasia” maupun tidak ataupun dalam bentuk lisan yang diberikan untuk tujuan Perjanjian ini atau berkaitan dengan Perjanjian ini yang dikuasai dan/atau dimiliki oleh Perusahaan. Informasi Rahasia ini termasuk namun tidak terbatas pada data, informasi dan daftar mengenai para nasabah, para Pemegang Polis dan/atau Tertanggung, para Calon Pemegang Polis dan/atau Calon Tertanggung/Peserta, karyawan, penasehat keuangan,  Pejabat Di Bawah BOD-2 Unit Kerja Yang Menjalankan Fungsi Sales pada Bisnis Bancassurance, informasi yang berhubungan dengan Bisnis, rahasia dagang, kompensasi, cara kerja produk apapun, proses, penemuan, peningkatan, atau pengembangan yang dilaksanakan atau digunakan oleh Perusahaan dan informasi yang terkait dengan proyek riset, teknologi, pengetahuan teknis (know-how), harga, potongan harga, mark-ups (penggelembungan biaya), strategi bisnis, pemasaran, tender dan serta segala informasi yang bersifat sensitif mengenai Perusahaan, dan termasuk segala informasi yang dimiliki dan harus dijaga oleh PT Asuransi Jiwa IFG berdasarkan peraturan Perasuransian yang berlaku;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">10.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Kantor Representatif</b> adalah kantor representatif PT Asuransi Jiwa IFG;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">11.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Keadaan Memaksa/<i>Force Majeure</i></b> adalah kondisi tertentu yang berada di luar kendali Perusahaan dan/atau Mitra Pemasar Bisnis Bancassurance termasuk namun tidak terbatas pada perang, kondisi hukum tertentu di mana hukum militer diberlakukan, pernyataan nasional atas keadaan darurat, revolusi, bencana alam, gangguan atau penutupan bursa efek, bank atau lembaga kliring, tindakan pemerintah, demonstrasi, kerusuhan, kebakaran, ledakan, sabotase, terorisme atau kondisi pelarangan (embargo);</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">12.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Ketentuan Kompensasi Mitra Pemasar Bisnis <i>Bancassurance</i></b> adalah ketentuan tertulis yang diterbitkan oleh Perusahaan yang mengatur secara rinci mengenai Kompensasi, target dan Evaluasi dari Mitra Pemasar Bisnis Bancassurance yang ditetapkan oleh Perusahaan dari waktu ke waktu dan merupakan bagian yang tidak terpisahkan dari Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">13.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Kompensasi</b> adalah sejumlah <i>allowance</i>, insentif atau apapun namanya yang diberikan Perusahaan kepada Mitra Pemasar Bisnis Bancassurance sebagai imbalan atas jasa Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini sebagaimana diatur dalam Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance dan tidak dapat dikategorikan atau didefinisikan sebagai gaji atau upah sebagaimana dimaksud dalam peraturan perundang-undangan yang belaku di bidang ketenagakerjaan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">14.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Masa Kemitraan</b> adalah periode di mana Mitra Pemasar Bisnis Bancassurance telah bermitra dengan Perusahaan, yang dimulai sejak tanggal Perjanjian ini ditandatangani dan akan berakhir sesuai dengan ketentuan yang terdapat dalam Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">15.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Masa Mempelajari Polis (<i>Freelook Period</i>)</b> adalah masa tertentu yang diberikan kepada Pemegang Polis untuk dapat mempelajari Polis dan mengembalikan Polis kepada Perusahaan apabila Pemegang Polis tidak menyetujui syarat-syarat umum Polis dan ketentuan lainnya.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">16.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Mitra Pemasar Bisnis Bancassurance</b> adalah mitra pemasar yang bertugas sebagai <i>advisor</i> dengan melakukan sosialisasi konsep <i>Protecting Life’s Progress</i> dan mampu memberikan solusi komprehensif berupa produk Perusahaan kepada masyarakat Indonesia, khususnya melalui Bank yang memiliki potensi untuk menjalin kerja sama dengan hubungan kemitraan tertuang dalam PKAJ</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">17.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Mitra Pemasar Bisnis Bancassurance yang Menjalankan Fungsi <i>Sales</i></b> (yang selanjutnya disebut sebagai Bancassurance Specialist/BS) adalah Mitra Pemasar Bisnis Bancassurance yang bertindak untuk dan atas nama PT Asuransi Jiwa IFG yang memberikan jasa untuk melakukan pemasaran atas produk asuransi pada kanal distribusi bancassurance dengan hubungan kemitraan yang tertuang dalam PKAJ.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">18.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Mitra Pemasar Bisnis Bancassurance yang Menjalankan Fungsi Supervisi Area</b> (yang selanjutnya disebut sebagai Bancassurance Area Manager/BAM) adalah Mitra Pemasar Bisnis Bancassurance yang bertindak untuk dan atas nama PT Asuransi Jiwa IFG yang memberikan jasa untuk melakukan monitoring, evaluasi dan development terkait aktivitas pemasaran atas produk asuransi pada kanal distribusi Bancassurance yang dilakukan oleh Mitra Pemasar Bisnis Bancassurance yang Menjalankan Fungsi Sales di Area yang menjadi tanggung jawabnya dengan hubungan kemitraan yang tertuang dalam PKAJ. </span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">19.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>MPS atau <i>Minimum Performance Standard</i></b> adalah pengukuran kualitas bisnis dari  Mitra Pemasar Bisnis Bancassurance untuk menentukan standar kualitas bisnis seorang Mitra Pemasar Bisnis Bancassurance;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">20.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pejabat Di Bawah BOD-2 Unit Kerja Yang Menjalankan Fungsi Sales pada Bisnis <i>Bancassurance</i></b> (yang selanjutnya disebut dengan “<i>Bancassurance Regional Manager</i> /BRM) adalah pejabat yang ditetapkan oleh Perusahaan sebagai leader bagi Mitra Pemasar Bisnis Bancassurance yang Menjalankan Fungsi Supervisi Area dan Mitra Pemasar Bisnis Bancassurance yang Menjalankan Fungsi Sales yang bertanggung jawab dalam melakukan perencanaan, pengorganisasian, pengendalian, dan menggerakkan aktivitas operasional pemasaran/penjualan bisnis di wilayah yang menjadi tanggung jawabnya.</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">21.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pelanggaran</b> adalah suatu perbuatan yang dilakukan secara terang dan sadar oleh Mitra Pemasar Bisnis Bancassurance yang mana atas perbuatannya tersebut mengakibatkan ketidaksesuaian terhadap pelaksanaan kewajiban maupun batasan Mitra Pemasar Bisnis Bancassurance yang telah diatur dalam Perjanjian ini termasuk perubahannya (apabila ada) namun tidak terbatas termasuk pelanggaran terhadap ketentuan internal Perusahaan, standar praktik dan kode etik tenaga pemasar asuransi jiwa, melanggar norma hukum pidana/perdata serta peraturan perundang-undangan yang berlaku;</span></td>
											</tr><tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">22.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pelatihan</b> adalah sesi yang dilaksanakan oleh Perusahaan untuk kepentingan para Mitra Pemasar Bisnis Bancassurance sampai dengan penempatan di Kantor Representatif;</span></td>
											</tr><tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">23.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pemberitahuan</b> adalah setiap pemberitahuan, informasi, surat menyurat, korespondensi lainnya yang timbul sehubungan dengan Perjanjian ini;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">24.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Pemegang Polis</b> adalah pihak yang mengadakan perjanjian asuransi atau penggantinya menurut hukum dengan Perusahaan; </span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">25.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Perjanjian</b> adalah Perjanjian Keagenan Asuransi Jiwa beserta lampiran dan perubahan-perubahannya yang menguraikan hak dan kewajiban Para Pihak yang harus dipatuhi dan dilaksanakan agar mencapai bisnis perasuransian yang saling menguntungkan;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">26.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Peraturan</b> adalah semua peraturan perundang-undangan yang berlaku di wilayah Republik Indonesia termasuk namun tidak terbatas pada peraturan-peraturan yang dikeluarkan oleh Perusahaan yang berkaitan dengan pelaksanaan Perjanjian ini;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">27.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Peraturan dan Kode Etik</b> adalah peraturan-peraturan dan kebijakan tertulis mengenai prosedur, pedoman dan standar pelaksanaan Perjanjian yang harus dipatuhi atau diharapkan dari seorang Mitra Pemasar Bisnis Bancassurance dalam menjalankan tugas sebagai penasehat keuangan dalam hubungannya dengan para Pemegang Polis atau Prospek dan dengan PT Asuransi Jiwa IFG, yang dikeluarkan oleh Perusahaan dari waktu ke waktu dan menjadi bagian yang tidak terpisahkan dari Perjanjian ini;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">28.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Polis</b> adalah dokumen yang diterbitkan oleh Perusahaan yang merupakan suatu perjanjian pertanggungan asuransi jiwa antara Perusahaan dan Pemegang Polis;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">29.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Premi</b> adalah sejumlah uang yang tertera dalam Polis yang disetujui oleh Pemegang Polis untuk dibayarkan kepada Perusahaan sesuai dengan ketentuan-ketentuan Polis;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">30.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Prospek</b> adalah Calon Pemegang Polis yang menurut pertimbangan Mitra Pemasar Bisnis Bancassurance memenuhi syarat untuk menjadi pembeli produk-produk asuransi Perusahaan;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">31.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Sertifikasi dan Lisensi AAJI</b> adalah sebuah penetapan yang diberikan atau diterbitkan oleh organisasi atau asosiasi profesi perasuransian dalam hal ini AAJI yang wajib dimiliki Mitra Pemasar Bisnis Bancassurance sebelum melakukan pemasaran dan/atau penjualan produk asuransi jiwa yang biayanya ditanggung oleh Mitra Pemasar Bisnis Bancassurance;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">32.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Surat Penetapan (SPA)</b> adalah surat yang diterbitkan oleh Perusahaan untuk Mitra Pemasar Bisnis Bancassurance yang berisikan tentang penetapan administrasi keagenan sesuai ketentuan yang berlaku di Perusahaan. Apabila diperlukan, surat ini dapat diubah sewaktu-waktu oleh Perusahaan sesuai kebutuhan;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">33.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Target</b> adalah standar yang ditetapkan oleh Perusahaan dari waktu ke waktu yang diharapkan untuk dipenuhi oleh Mitra Pemasar Bisnis Bancassurance sebagai mitra Perusahaan dalam melakukan penjualan;</span></td>
											</tr>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span style="font-family: Arial,sans-serif">34.</span></td>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif"><b>Tertanggung/Peserta</b> adalah orang yang atas jiwanya diadakan perjanjian asuransi jiwa, di mana jenis perjanjian asuransinya diuraikan dalam Polis;</span></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dengan tunduk pada persyaratan dan ketentuan Perjanjian ini dan terhitung sejak tanggal Perjanjian ini, Perusahaan, secara <i>non-ekslusif</i>, dengan ini menunjuk Mitra Pemasar Bisnis Bancassurance sebagai mitra untuk mewakili Perusahaan dalam memasarkan produk-produk asuransi Perusahaan yang dikembangkan atau diterbitkan oleh Perusahaan dan Mitra Pemasar Bisnis Bancassurance menerima penunjukan tersebut. Namun dalam hal ini proses pemasaran produk asuransi oleh Mitra Pemasar Bisnis Bancassurance tetap harus memenuhi ketentuan yang berlaku di Perusahaan.</span></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam Perjanjian ini, telah dipahami dan disepakati oleh Para Pihak bahwa tidak ada hubungan kerja perusahaan-karyawan atau pekerja-pengusaha baik yang tersurat maupun yang tersirat antara Perusahaan dan Mitra Pemasar Bisnis Bancassurance dan tidak ada bagian apapun yang terkandung dalam Perjanjian ini yang dapat ditafsirkan sebagai menciptakan hubungan kerja sebagaimana dimaksud dalam peraturan perundang-undangan yang berlaku di bidang ketenagakerjaan.</td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance akan bertindak dalam kapasitasnya untuk dan atas nama Perusahaan dan tidak akan menerima penunjukan lain sebagai seorang Mitra Pemasar Bisnis Bancassurance atau sebagai agen pemasaran dari manapun atau dari perusahaan asuransi lain atau perusahaan yang terkait dengan asuransi apapun atau perusahaan keuangan lainnya termasuk untuk tidak memasarkan atau menjual, baik langsung maupun tidak langsung dan dengan cara apapun, produk asuransi atau produk keuangan lainnya dari perusahaan asuransi maupun perusahaan keuangan lainnya atau perseorangan kecuali dengan izin tertulis dari Perusahaan.</span></td>
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
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														memberikan atau membayarkan Kompensasi kepada Mitra Pemasar Bisnis Bancassurance sebagai imbalan atas penjualan produk asuransi yang dilakukan Mitra Pemasar Bisnis Bancassurance  berdasarkan Perjanjian ini sebagaimana diatur dalam Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance dan sebagaimana dapat diubah atau dicabut/dibatalkan oleh Perusahaan dari waktu ke waktu dengan Pemberitahuan secara tertulis;
													</li>
													<li>
														melakukan pemotongan pajak penghasilan atas seluruh Kompensasi yang diterima oleh Mitra Pemasar Bisnis Bancassurance sesuai dengan ketentuan hukum yang berlaku;
													</li>			
													<li>
														membayarkan dan melaporkan pemotongan pajak penghasilan ke Kantor Pelayanan Pajak setempat; dan
													</li>
													<li>
														memberikan bukti pemotongan pajak penghasilan sesuai peraturan yang berlaku pada Mitra Pemasar Bisnis Bancassurance setiap tahun.
													</li>
													
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
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														menetapkan, mengubah, atau mencabut rumus, pedoman, prosedur dan parameter perhitungan Kompensasi, Target dan Evaluasi dalam Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance Perjanjian ini dengan Pemberitahuan secara tertulis; 
													</li>
													<li>
														menetapkan, mengubah, mencabut atau membatalkan Peraturan dan Kode Etik Perjanjian ini dengan Pemberitahuan secara tertulis;
													</li>			
													<li>
														mengadakan evaluasi penilaian secara menyeluruh mengenai tugas serta tanggung jawab Mitra Pemasar Bisnis Bancassurance sesuai dengan Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance; 
													</li>
													<li>
														menempatkan Mitra Pemasar Bisnis Bancassurance atau memindahkan Mitra Pemasar Bisnis Bancassurance ke Kantor Representatif manapun atau ke tempat lain sebagaimana ditetapkan oleh Perusahaan berdasarkan kebijaksanaan penuh dari Perusahaan dari waktu ke waktu, dari Kantor Representatif atau tempat lain dimana Mitra Pemasar Bisnis Bancassurance akan melaksanakan kewajibannya berdasarkan Perjanjian ini dari waktu ke waktu;
													</li>
													<li>
														melakukan pemotongan secara sah atas hak-hak Mitra Pemasar Bisnis Bancassurance yang mungkin ada berdasarkan Perjanjian ini, termasuk tapi tidak terbatas pada setiap Kompensasi baik sudah dibayarkan atau belum untuk digunakan sebagai pelunasan atas semua hutang atau kewajiban dari Mitra Pemasar Bisnis Bancassurance dalam hal ini termasuk namun tidak terbatas pada pengembalian Kompensasi karena adanya kesalahan pada proses penjualan, hilangnya aset Perusahaan, yang terjadi pada Masa Kemitraan. Hak-hak tagih atas pemenuhan kewajiban tersebut di atas akan tetap berlaku walaupun Perjanjian ini berakhir; 
													</li>
													<li>
														dengan mengirimkan Pemberitahuan kepada Mitra Pemasar Bisnis Bancassurance, Perusahaan berhak menghentikan penerimaan permohonan Polis baru yang disampaikan oleh Mitra Pemasar Bisnis Bancassurance kepada Perusahaan, baik selamanya maupun untuk jangka waktu tertentu, jika menurut pertimbangan Perusahaan hal tersebut dianggap patut;
													</li>
													<li>
														menerima atau menolak seluruh permohonan pengajuan asuransi untuk produk-produk asuransi yang dikembangkan atau diterbitkan oleh Perusahaan yang diserahkan dan diterima oleh Mitra Pemasar Bisnis Bancassurance; 
													</li>
													<li>
														mengenakan sanksi terhadap Mitra Pemasar Bisnis Bancassurance dalam hal Mitra Pemasar Bisnis Bancassurance yang terbukti telah melakukan Pelanggaran;
													</li>
													<li>
														menyediakan sarana/prasarana yang dianggap perlu oleh Perusahaan untuk melaksanakan tugas Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini;
													</li>
													<li>
														memberikan bimbingan, penjelasan dan/atau Pelatihan bagi Mitra Pemasar Bisnis Bancassurance dalam rangka melakukan pemasaran produk; 
													</li>
													<li>
														meminta Mitra Pemasar Bisnis Bancassurance untuk segera mengembalikan seluruh aset milik Perusahaan, baik berupa barang, uang maupun data atau informasi yang sewaktu-waktu dapat berada dalam penguasaan Mitra Pemasar Bisnis Bancassurance dan/atau Kantor Representatif;
													</li>
													<li>
														setiap saat melakukan pembinaan, pengendalian, pengawasan, audit, dan evaluasi atas kinerja Mitra Pemasar Bisnis Bancassurance dalam melakukan pemasaran produk;
													</li>
													<li>
														mengakhiri Perjanjian secara sepihak dalam hal Mitra Pemasar Bisnis Bancassurance telah terbukti secara sah dan meyakinkan telah melakukan Pelanggaran terhadap syarat dan ketentuan berdasarkan Perjanjian ini; dan
													</li>
													<li>
														apabila Perusahaan tidak segera mengambil tindakan terhadap Pelanggaran atas ketentuan dan persyaratan Perjanjian ini beserta perubahannya jika ada atau Pelanggaran terhadap peraturan perundang-undangan yang berlaku termasuk petunjuk dan pedoman yang ditetapkan oleh pemerintah atau Kode Etik Keagenan sebagaimana yang ditetapkan oleh Asosiasi Asuransi Jiwa Indonesia (AAJI) yang dilakukan oleh Mitra Pemasar Bisnis Bancassurance, maka hal ini tidak dapat dianggap sebagai pengesampingan dan penghapusan atas hak-hak Perusahaan untuk dengan segera mengakhiri Perjanjian ini atau melakukan upaya hukum menurut hukum yang berlaku dari waktu ke waktu, atau ditafsirkan sebagai suatu pemberian persetujuan kepada Mitra Pemasar Bisnis Bancassurance  untuk tidak bertindak sesuai dengan Perjanjian ini.
													</li>
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
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEWAJIBAN DAN HAK MITRA PEMASAR BISNIS BANCASSURANCE</span></b></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlaku Perjanjian ini, Mitra Pemasar Bisnis Bancassurance  berkewajiban untuk:
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														Memiliki lisensi dari Asosiasi Asuransi Jiwa Indonesia (AAJI);
													</li>
													<li>
														Tidak memiliki ikatan perjanjian dengan perusahaan asuransi yang sejenis atau memiliki kegiatan usaha yang sama dengan kegiatan usaha Perusahaan;
													</li>
													<li>
														melakukan koordinasi dengan Perusahaan dan juga pihak lembaga keuangan atau lembaga lainnya dalam melakukan pemasaran produk dengan baik dan benar sesuai dengan peraturan, ketentuan dan kebijakan yang ditetapkan oleh Perusahaan dari waktu ke waktu;
													</li>
													<li>
														bekerja sama dengan Perusahaan untuk mendukung tugasnya serta berkoordinasi dengan unit-unit kerja yang lain yang ada di Perusahaan dalam menjalankan tugasnya tersebut sehingga dapat terjamin bahwa segala laporan yang terkait dengan pemasaran produk dapat dipastikan telah dikirimkan ke pihak-pihak terkait sesuai jadwal yang telah ditentukan oleh Perusahaan;
													</li>
													<li>
														membuat laporan kegiatan harian atau mingguan atau bulanan yang diperlukan untuk memastikan bahwa kegiatan yang dilakukan oleh Mitra Pemasar Bisnis Bancassurance sudah sesuai dengan yang telah ditetapkan;
													</li>
													<li>
														memenuhi Target pemasaran produk Perusahaan yang ditentukan bagi Mitra Pemasar Bisnis Bancassurance dari waktu ke waktu; 
													</li>
													<li>
														bersedia ditempatkan di lokasi pemasaran produk yang ditunjuk Perusahaan; 
													</li>
													<li>
														mematuhi peraturan perundang-undangan dan kode etik profesi agen asuransi jiwa yang berlaku sekarang maupun di kemudian hari, serta peraturan-peraturan dan ketentuan-ketentuan Perusahaan serta kebijakan-kebijakan atau arahan-arahan lainnya dari waktu ke waktu termasuk Kode Etik bisnis dan Kode Etik bisnis agen;
													</li>
													<li>
														mengikuti dan menghadiri segala Pelatihan yang diadakan oleh Perusahaan yang bertujuan untuk memberikan pengetahuan mengenai produk dan prosedur penjualan serta hal-hal lainnya yang terkait dengan pemasaran produk;
													</li>
													<li>
														mengikuti setiap kontes yang diadakan oleh Perusahaan berkenaan dengan pemasaran produk Perusahaan dengan mematuhi ketentuan yang berlaku;
													</li>
													<li>
														mencurahkan seluruh waktu, keahlian dan tenaganya kepada usaha pemasaran produk; 
													</li>
													<li>
														menempatkan kepentingan peserta asuransi atau Pemegang Polis di atas kepentingan dirinya sendiri; 
													</li>
													<li>
														selalu terus berusaha meningkatkan kemahiran sebagai seorang Mitra Pemasar Bisnis Bancassurance menyangkut keahlian pemasaran produk, pengetahuan asuransi jiwa dan peraturan-peraturan perasuransian pada umumnya;
													</li>
													<li>
														memperoleh dan memastikan segala perizinan, tanda terdaftar dan kualifikasi yang disyaratkan Perusahaan untuk melaksanakan pemasaran produk masih berlaku sesuai ketentuan perundang-undangan dan menyimpannya dengan baik setiap waktu selama berlakunya Perjanjian ini;
													</li>
													<li>
														memelihara dalam keadaan yang baik segala sesuatu yang telah dipercayakan kepada Mitra Pemasar Bisnis Bancassurance, termasuk tetapi tidak terbatas pada peralatan sarana, prasarana, fasilitas, dan perangkat kantor dan bahan-bahan/materi penjualan, yang merupakan hak milik eksklusif Perusahaan, dan bertanggung jawab atas seluruh biaya perbaikan, restorasi atau penggantian apabila ada kerusakan dan kehilangan terhadap sarana, prasarana, fasilitas, dan perangkat kantor atau bahan-bahan/materi tersebut dan tanpa perlu adanya permintaan terlebih dahulu, dengan berakhirnya Perjanjian ini, Mitra Pemasar Bisnis Bancassurance  wajib mengembalikan dalam bentuk dan kondisi yang baik seluruh informasi, data, catatan, dokumen-dokumen, buku pedoman pemasaran produk Perusahaan, alat-alat tulis, formulir-formulir, buku-buku dan kertas-kertas, serta peralatan kantor lainnya yang berhubungan dengan usaha Perusahaan dan hak milik eksklusif dari Perusahaan. Kewajiban tersebut tetap berlaku meskipun Perjanjian ini telah berakhir;
													</li>
													<li>
														Menyediakan dan/atau menyampaikan informasi mengenai produk asuransi yang diterbitkan Perusahaan dan/atau layanan yang akurat, jujur, jelas dan tidak menyesatkan kepada konsumen dalam hal ini calon Pemegang Polis;
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance wajib menjaga sarana/prasarana atau fasilitas yang disediakan dan dipinjamkan Perusahaan dalam rangka menunjang pekerjaan Mitra Pemasar Bisnis Bancassurance dan mengembalikan kepada Perusahaan pada saat berakhirnya Perjanjian dalam keadaan baik;
													</li>
													<li>
														Setiap saat harus menjalankan dan mematuhi seluruh syarat-syarat dan ketentuan-ketentuan yang diuraikan dalam Perjanjian ini beserta perubahannya jika ada, peraturan perundangan-undangan yang berlaku, petunjuk dan pedoman yang ditetapkan oleh pemerintah dan Kode Etik Keagenan sebagaimana yang ditetapkan oleh AAJI (baik berupa lisan maupun tulisan) yang diberlakukan dari waktu ke waktu;
													</li>
													<li>
														menggunakan segala formulir, dokumen dan bahan apapun yang disediakan oleh Perusahaan dari waktu ke waktu kepadanya untuk menjalankan tugasnya berdasarkan Perjanjian ini. Mitra Pemasar Bisnis Bancassurance dilarang mengubah, menambah atau mengganti formulir, brosur, dokumen, atau bahan apapun milik Perusahaan atau menggunakan segala formulir, dokumen dan bahan apapun yang tidak disediakan oleh Perusahaan tanpa persetujuan tertulis sebelumnya dari Perusahaan. Seluruh formulir permohonan beserta seluruh dokumen pendukungnya yang telah diisi lengkap oleh Calon Pemegang Polis dan telah diterima oleh Mitra Pemasar Bisnis Bancassurance, harus segera diserahkan kepada Perusahaan; 
													</li>
													<li>
														dengan tetap memperhatikan ketentuan pada Perjanjian ini, menanggung segala pengeluaran yang timbul dalam pelaksanaan tugas-tugasnya sebagai Mitra Pemasar Bisnis Bancassurance sebagaimana diatur dalam Perjanjian ini, kecuali ada hal-hal lain yang secara khusus disepakati dan dinyatakan secara tertulis oleh Perusahaan;
													</li>
													<li>
														senantiasa memperhatikan dan menjaga kerahasiaan mengenai Bisnis atau orang-orang atau perusahaan-perusahaan yang dari waktu ke waktu berhubungan dengan Perusahaan (atau perusahaan lain yang terkait sebagaimana diberitahu oleh Perusahaan);
													</li>
													<li>
														mengungkapkan dengan segera kepada Perusahaan mengenai segala fakta dan keadaan yang diketahui Mitra Pemasar Bisnis Bancassurance yang terkait dengan penerimaan risiko atau Bisnis oleh Perusahaan dan harus menghubungi Perusahaan dengan segera dan seksama mengenai segala fakta yang terkait dengan penerimaan risiko atau transaksi bisnis tersebut yang diketahui oleh Mitra Pemasar Bisnis Bancassurance dengan cara bagaimanapun; 
													</li>
													<li>
														memberikan Pemberitahuan dengan segera kepada Perusahaan kapanpun dalam hal Mitra Pemasar Bisnis Bancassurance menerima pemberitahuan mengenai adanya kerugian atau tuntutan yang telah atau akan diajukan atas sebuah Polis atau sebuah kontrak tertentu atau atas adanya pelanggaran terhadap persyaratan dari atau pengalihan Polis atau kontrak atau terkait dengan Bisnis oleh Perusahaan yang diketahui oleh Mitra Pemasar Bisnis Bancassurance dengan cara bagaimanapun;
													</li>
													<li>
														melakukan <i>Field Underwriting</i> terhadap penjualan dan/atau pemasaran Produk serta mengedepankan prinsip <i>know your customer</i> sebagai mitigasi risiko tindakan Anti Pencucian Uang dan Pencegahan Pendanaan Terorisme (APU PPT).
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama berlakunya Perjanjian ini, Mitra Pemasar Bisnis Bancassurance menyatakan bahwa telah mengerti dan memahami bahwa Perusahaan mempunyai kebijakan “<i>Zero Tolerance to Fraud</i>” yaitu Perusahaan tidak akan memberikan toleransi kepada Mitra Pemasar Bisnis Bancassurance  yang melakukan tindakan <i>Fraud</i>. Tindakan <i>Fraud</i> dalam hal ini termasuk namun tidak terbatas pada beberapa hal diantaranya :
												<ol type="i" align="justify" style="font-family: Arial,sans-serif">
													<li>
														pencurian, penipuan, penggelapan, penyalahgunaan dana dan pencucian uang Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;
													</li>
													<li>
														dengan sengaja menghilangkan, menghapus, memalsukan, mengubah informasi, dokumen dan/atau data mengenai Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;
													</li>
													<li>
														memberikan penjelasan produk asuransi yang tidak sesuai dengan manfaat sebenarnya atau memberikan penjelasan yang salah perihal metode pembayaran premi atas polis asuransi kepada Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;
													</li>
													<li>
														<i>twisting</i> yaitu larangan untuk membujuk dan/atau mempengaruhi Pemegang Polis untuk mengubah spesifikasi Polis yang ada atau mengganti Polis yang ada dengan polis yang baru pada perusahaan asuransi jiwa lainnya, dan/atau membeli polis baru dengan menggunakan dana yang berasal dari polis yang masih aktif pada suatu perusahaan asuransi jiwa lainnya dalam waktu 6 (enam) bulan sebelum dan sesudah tanggal polis baru di perusahaan asuransi jiwa lain diterbitkan; dan
													</li>
													<li>
														<i>churning</i> yaitu tindakan membujuk dan mempengaruhi Pemegang Polis untuk mengubah spesifikasi Polis yang ada atau mengganti Polis yang ada dengan Polis yang baru pada Perusahaan, dan/atau membeli Polis baru dengan menggunakan dana yang berasal dari Polis yang masih aktif dari Perusahaan tanpa penjelasan terlebih dahulu kepada Pemegang Polis mengenai kerugian yang dapat diderita oleh Pemegang Polis akibat perubahan/penggantian tersebut.
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlakunya Perjanjian ini, Mitra Pemasar Bisnis Bancassurance dengan ini menyatakan, menjamin dan menyanggupi bahwa sehubungan dengan:
												<ol type="i" align="justify" style="font-family: Arial,sans-serif;">
													<li>
														semua transaksi yang diatur dalam Perjanjian ini;
													</li>
													<li>
														segala sesuatu yang berkaitan langsung maupun tidak langsung dengan Perjanjian ini, termasuk namun tidak terbatas pada perundingan atas Perjanjian ini dan pelaksanaan kewajiban dalam Perjanjian ini; atau
													</li>
													<li>
														pengaturan yang timbul dari dan/atau sehubungan dengan pelaksanaan dari Perjanjian ini: 
													</li>
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
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														tidak pernah melanggar dan menyatakan sanggup untuk tidak melanggar peraturan anti korupsi dan anti penyuapan yang berlaku di yuridiksi di mana salah satu Pihak berdomisili atau menjalankan usahanya, juga terhadap peraturan anti korupsi dan anti penyuapan yang berlaku di yuridiksi lain atau mungkin berlaku untuk transaksi sebagaimana diatur dalam Perjanjian ini;
													</li>
													<li>
														tidak pernah dan menyanggupi untuk tidak akan terkait/berhubungan dengan hal–hal berikut ini: melakukan pembayaran atau transfer atau menawarkan, atau menjanjikan atau memberikan keuntungan <i>financial</i> atau bentuk–bentuk keuntungan lainnya, atau meminta kesepakatan untuk menerima manfaat keuntungan <i>financial</i> baik yang berwujud ataupun yang tidak berwujud, termasuk pemberian atau suap, atau mengizinkan atau persetujuan atas hal-hal tersebut di atas baik secara langsung maupun tidak langsung, yang mempunyai tujuan atau berdampak penyuapan yang bersifat publik atau komersial atau penerimaan atau persetujuan dalam penyuapan, pemerasan, uang penerimaan atau persetujuan dalam penyuapan, pemerasan, uang pelancar atau perbuatan melawan hukum lain atau perbuatan tidak benar dalam artian untuk mendapatkan atau mempertahankan kerja sama, keuntungan komersial atau kegiatan yang tidak sebagaimana mestinya dari sebuah fungsi atau kegiatan;
													</li>
													<li>
														harus menjamin kepatuhan terhadap semua kewajiban di atas dari setiap orang-orang terkait, pejabat, karyawan atau agen, subkontraktor atau konsultan independen yang digunakan untuk melaksanakan kewajiban-kewajibannya berdasarkan Perjanjian ini; dan
													</li>
													<li>
														apabila diketahui terdapat tindakan oleh setiap orang yang terkait, karyawan, agen, subkontraktor atau konsultan independen yang dianggap merupakan tindakan-tindakan sebagaimana disebutkan dalam huruf b ayat ini, atau cukup memiliki kecurigaan yang beralasan atas sesuatu tindakan dimaksud di atas, maka harus segera memberitahu kepada Perusahaan atas diketahuinya hal tersebut dan apabila diminta oleh Perusahaan, menyediakan informasi dalam batasan yang wajar, yang diperlukan Perusahaan terkait dengan tindakan tersebut.
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Perjanjian ini berlangsung,  maka Mitra Pemasar Bisnis Bancassurance memiliki hak untuk menerima Kompensasi berdasarkan kinerja dan pencapaian Target sesuai dengan Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance Perjanjian ini sebagaimana diubah dari waktu ke waktu oleh Perusahaan.
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
												<b><span lang="IN" style="font-family: Arial,sans-serif">PEMBATASAN WEWENANG MITRA PEMASAR BISNIS BANCASSURANCE</span></b></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selain yang diotorisasikan secara tertulis kepada Mitra Pemasar Bisnis Bancassurance oleh Perusahaan, maka tidak ada kewenangan apapun yang diberikan kepada Mitra Pemasar Bisnis Bancassurance untuk bertindak atas nama Perusahaan, termasuk namun tidak terbatas pada: 
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														menerima segala bentuk risiko atau Bisnis, kecuali sebagaimana disahkan atau dimintakan secara tertulis oleh Perusahaan; 
													</li>
													<li>
														menerbitkan nota penutupan (<i>cover note</i>), Polis atau kontrak lainnya;
													</li>
													<li>
														mendapatkan atau menerima atau menyetujui segala bentuk pemberitahuan mengenai perubahan, pembatalan, penetapan atau pengalihan Polis atau Bisnis lainnya, segala bentuk pemberitahuan mengenai kerugian atau pemberitahuan lainnya; 
													</li>
													<li>
														mengesampingkan syarat atau ketentuan apapun dari Polis atau Bisnis lainnya;
													</li>
													<li>
														melakukan perundingan mengenai ketentuan penyelesaian, melunasi atau membayar setiap kerugian atau tuntutan atau mengesampingkan atau menunda pembayaran Premi atau pembayaran lainnya;
													</li>
													<li>
														memberikan jaminan, pernyataan atau janji yang berkaitan dengan Polis, kontrak tambahan atau Bisnis lainnya;
													</li>
													<li>
														menetapkan biaya tambahan selain dari Premi yang diwajibkan tanpa persetujuan tertulis sebelumnya dari Perusahaan; dan
													</li>
													<li>
														mengikat Perusahaan dengan pihak lain dengan cara bagaimanapun. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang memberikan pernyataan kepada Calon Pemegang Polis atau Calon Tertanggung atau penerima manfaat atau kepada siapapun bahwa ia diberi wewenang yang terkait dengan cara-cara tersebut di atas dan dilarang memberikan pernyataan kepada Calon Pemegang Polis, Calon Tertanggung atau penerima manfaat atau siapapun mengenai setiap tindakan tersebut kecuali apabila Perusahaan menentukan lain.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang melangsungkan perjanjian apapun atau pengaturan (<i>arrangement</i>) apapun dengan Mitra Pemasar Bisnis Bancassurance  lainnya atau dengan siapapun mengenai pelaksanaan tugas-tugas Mitra Pemasar Bisnis Bancassurance  berdasarkan Perjanjian ini atau membayar atau menawarkan untuk membayar kompensasi apapun kepada orang-orang tersebut untuk melaksanakan tugas-tugas tersebut.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang melimpahkan tugas-tugasnya berdasarkan Perjanjian ini kepada siapapun tanpa persetujuan tertulis terlebih dahulu dari Perusahaan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance tidak memiliki wewenang untuk melangsungkan perjanjian apapun atas nama Perusahaan dengan Mitra Pemasar Bisnis Bancassurance  lain sehubungan dengan pemenuhan dari segala persyaratan yang ditetapkan oleh Perusahaan atas Mitra Pemasar Bisnis Bancassurance tersebut. Mitra Pemasar Bisnis Bancassurance dilarang memberikan pernyataan kepada siapapun bahwa Mitra Pemasar Bisnis Bancassurance memiliki wewenang untuk melaksanakan hal-hal tersebut di atas.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang mempublikasikan atau menyebabkan dipublikasikannya segala bentuk iklan mengenai penunjukannya berdasarkan Perjanjian ini atau mempublikasikan atau menyebabkan dipublikasikannya iklan mengenai Perusahaan, transaksi bisnis yang mereka miliki atau segala bentuk asuransi atau transaksi bisnis lainnya dimana Mitra Pemasar Bisnis Bancassurance  diberi wewenang untuk menjalankannya atau menanganinya dalam surat kabar, majalah, publikasi atau media lainnya tanpa persetujuan tertulis terlebih dahulu dari Perusahaan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang menerbitkan, menyebarluaskan atau menyebabkan diterbitkannya atau disebarluaskannya segala bentuk edaran atau menulis atau menyebabkan ditulisnya dalam surat kabar, majalah, publikasi atau media lainnya hal-hal tersebut di atas atau yang mengenai perusahaan asuransi lainnya tanpa persetujuan tertulis terlebih dahulu dari Perusahaan. Jika ada tuntutan hukum yang diajukan terhadap Perusahaan sebagai akibat dari tindakan atau pernyataan Mitra Pemasar Bisnis Bancassurance  di luar kewenangannya, segala biaya, pengeluaran, serta kerusakan yang ditimbulkan sebagai akibat dari atau sehubungan dengan tindakan atau pernyataan tersebut harus ditanggung oleh Mitra Pemasar Bisnis Bancassurance secara pribadi.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang menggunakan atau menyebabkan digunakannya nama atau logo (atau bagian apapun dari nama atau logo tersebut) milik Perusahaan tanpa persetujuan tertulis lebih dahulu dari Perusahaan, dan dilarang mendaftarkan nama atau logo milik Perusahaan tersebut (atau bagian apapun dari nama atau logo tersebut) pada asosiasi, organisasi atau pihak berwenang manapun. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Tidak ada wewenang apapun yang diberikan kepada Mitra Pemasar Bisnis Bancassurance untuk bertindak untuk dan atas nama Perusahaan dalam rangka mengajukan, melakukan pembelaan atau ikut serta dalam persidangan perkara pengadilan yang berhubungan dengan Perusahaan. Mitra Pemasar Bisnis Bancassurance  harus dengan segera menyerahkan kepada Perusahaan seluruh dokumen yang diterima Mitra Pemasar Bisnis Bancassurance yang memiliki keterkaitan dengan persidangan perkara yang melibatkan Perusahaan tersebut. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Masa Kemitraan Perjanjian ini Mitra Pemasar Bisnis Bancassurance dilarang melangsungkan perjanjian keagenan dengan perusahaan asuransi lain atau bergabung dengan perusahaan asuransi lain sampai status kemitraan resmi berakhir sesuai dengan ketentuan yang berlaku. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Masa Kemitraan Perjanjian ini Mitra Pemasar Bisnis Bancassurance dilarang untuk:
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														Mempublikasikan informasi/data/pernyataan/opini/gambar yang bertentangan dengan Peraturan, dengan atau tanpa mengaitkannya secara langsung kepada Perusahaan dan Calon Pemegang Polis/Pemegang Polis dan/atau Calon tertanggung/Tertanggung; 
													</li>
													<li>
														Mempublikasikan informasi/data/pernyataan/opini/gambar yang bersifat negatif terkait dengan suku, agama, ras, politik dan golongan;
													</li>
													<li>
														Menggunakan kalimat dan bahasa yang tidak pantas/tidak menghargai/tidak sopan, termasuk mengutarakan pernyataan yang mengandung unsur provokatif;
													</li>
													<li>
														Mempublikasikan informasi/data/pernyataan/opini/gambar yang dapat ditafsirkan mengambil keuntungan dari pekerjaan orang lain; 
													</li>
													<li>
														Mempublikasikan, mendiskusikan, menyebarkan informasi/data/pernyataan/opini/gambar terkait dengan Perusahaan yang bersifat non-publik (“Non-public Information”), tidak benar dan atau merendahkan pihak lain;
													</li>
													<li>
														Mempublikasikan informasi/data/pernyataan/opini/gambar terkait dengan atau milik Perusahaan, tanpa mematuhi hukum dan peraturan mengenai privasi data, hak cipta dan hak atas kekayaan intelektual (HAKI) lainnya; 
													</li>
													<li>
														Mempublikasikan informasi/data/pernyataan/opini/gambar yang terkait dengan Perusahaan tanpa menjelaskan bahwa pendapat tersebut merupakan pendapat pribadi, dan bukan merupakan pendapat Perusahaan. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Membuat/mengubah/menghapus ketentuan dalam dokumen-dokumen Perusahaan, mengesampingkan hak, menentukan tarif premi selain yang telah ditentukan Perusahaan, memberikan persetujuan, pemberitahuan pengalihan, pemberitahuan kerugian, melakukan negosiasi atas syarat-syarat atau penyelesaian, menyelesaikan atau membayar kerugian atau klaim atau mengesampingkan/menunda pembayaran premi, atau mengikat Perusahaan atau afiliasinya dengan cara apapun juga; dan Mitra Pemasar Bisnis Bancassurance dilarang memberi pernyataan kepada calon peserta atau pihak lain bahwa ia memiliki kewenangan atau bahwa risiko telah disetujui atau penutupan telah berlaku atau polis atau produk lain dikeluarkan oleh atau atas nama Perusahaan (baik berdasarkan proposal yang pertama maupun pembaharuan) kecuali Perusahaan telah menyetujui secara tertulis mengenai hal tersebut.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama Perjanjian ini berlangsung, Mitra Pemasar Bisnis Bancassurance dilarang melakukan hal-hal sebagai berikut:
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span>
												</td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
													<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span>
												</td>
												<td valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">a.</span>
												</td>
												<td colspan="7" valign="top" style="width: 487px;">
													<p class="MsoNormal" style="text-align: justify;margin-left: -20pt">
													<span lang="IN" style="font-family: Arial,sans-serif"> Pelanggaran Ringan</span>
												</td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak memberikan pelayanan purna jual kepada Pemegang Polis/Tertanggung;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan manajemen aktivitas penjualan kepada Calon Pemegang Polis dan/atau Calon Tertanggung;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melaporkan perubahan data diri Mitra Pemasar Bisnis Bancassurance kepada Perusahaan sehubungan dengan tata administrasi keagenan yang berlaku.</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan perpanjangan Lisensi AAJI yang sudah berakhir masa berlakunya/tidak aktif;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak menjelaskan seluruh hak dan kewajiban Calon Pemegang Polis dan/atau Calon Tertanggung;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak melakukan pencatatan data aktivitas penjualan dengan menggunakan media yang ditentukan Perusahaan;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak ikut berpartisipasi dalam setiap Pelatihan, sosialisasi produk, dan program yang ditetapkan Perusahaan;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak mempertahankan dan menjaga persistensi Polis sesuai dengan Target yang telah ditetapkan Perusahaan;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak mengembalikan setiap Kompensasi  yang telah diperolehnya terkait dengan pengembalian Premi dari Perusahaan kepada Pemegang Polis dengan alasan apapun.</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak memberikan penjelasan tentang produk kepada Calon Pemegang Polis dan/atau Calon Tertanggung;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">tidak menjaga reputasi dan nama baik Perusahaan dengan melakukan perbuatan-perbuatan yang tidak sesuai dengan ketentuan Perusahaan;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">mengadakan perjanjian dan/atau hubungan kerja keagenan asuransi secara langsung dengan perusahaan asuransi lain;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">merekomendasikan Pemegang Polis/Tertanggung untuk membatalkan Polis atas dasar kepentingan pribadi;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">memberikan data/dokumen yang tidak sesuai dengan data diri Mitra Pemasar Bisnis Bancassurance kepada Perusahaan maupun Pemegang Polis/Tertanggung; </span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">memberikan potongan premi kepada Pemegang Polis/Tertanggung dalam bentuk apapun, kecuali potongan premi tersebut merupakan program Perusahaan;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">menerima setoran premi secara tunai dari Calon Pemegang Polis/Pemegang Polis dan/atau Calon Tertanggung/Tertanggung;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">memanipulasi, memalsukan dan/atau memberikan keterangan terkait Polis/surat/dokumen palsu kepada Perusahaan atau kepada pihak lain yang dapat mengakibatkan kerugian bagi Perusahaan atau pihak lain yang terkait dengan Perusahaan;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">memberikan informasi yang bersifat rahasia yang berkaitan dengan strategi, kebijakan, program dan produk kepada perusahaan asuransi lain dan/atau pihak-pihak lain;</span></td>
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
														<span lang="IN" style="font-family: Arial,sans-serif">mengajak atau menganjurkan sesuatu yang diketahui atau patut diduga akan menimbulkan kerugian Perusahaan dan/atau Pemegang Polis/Tertanggung;</span></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Atas pelanggaran ketentuan sebagaimana dimaksud pada ayat 6.1 Pasal ini, Mitra Pemasar Bisnis Bancassurance menyatakan bertanggung jawab sepenuhnya dan karenanya Mitra Pemasar Bisnis Bancassurance membebaskan Perusahaan dari segala tuntutan hukum baik pidana maupun perdata atau dalam bentuk apapun dari pihak lain, yang timbul sebagai akibat dari pelanggaran dimaksud serta bersedia untuk mengganti seluruh kerugian yang diderita Perusahaan atas perbuatan pelanggaran dan/atau larangan yang dilakukan dan bersedia dituntut oleh Perusahaan sesuai ketentuan hukum yang berlaku.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal Mitra Pemasar Bisnis Bancassurance terbukti melakukan salah satu pelanggaran dimaksud dalam ayat 6.1 Pasal ini, maka sesuai dengan bobot pelanggarannya Perusahaan berhak menjatuhkan sanksi, berupa: 
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
													<span lang="IN" style="font-family: Arial,sans-serif">Apabila setelah menjalani sanksi pelanggaran sedang, ternyata Mitra Pemasar Bisnis Bancassurance yang melakukan pelanggaran masih melakukan pelanggaran yang sifatnya sama, maka yang bersangkutan dapat dijatuhi sanksi pelanggaran berat, berupa: </span></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila pelanggaran yang dilakukan oleh Mitra Pemasar Bisnis Bancassurance mengandung unsur-unsur tindak pidana, maka selain sanksi dimaksud dalam Pasal ini, Perusahaan dapat melaporkan Mitra Pemasar Bisnis Bancassurance kepada pihak yang berwajib untuk menyelesaikan pelanggaran melalui jalur hukum dan Mitra Pemasar Bisnis Bancassurance bersedia untuk mempertanggungjawabkan segala perbuatan yang sudah dilakukan terhadap Perusahaan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat menunda dan/atau tidak membayarkan Kompensasi jika Mitra Pemasar Bisnis Bancassurance menerima sanksi pelanggaran sedang dan/atau pelanggaran berat sebagaimana yang disebutkan pada ayat 6.1 Pasal ini.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal terdapat keluhan terhadap Perusahaan  yang diduga disebabkan oleh kelalaian atau kesalahan Mitra Pemasar Bisnis Bancassurance dalam melakukan Pemasaran Produk, Perusahaan dapat meminta Mitra Pemasar Bisnis Bancassurance untuk membantu Perusahaan dalam melakukan investigasi, dan Mitra Pemasar Bisnis Bancassurance wajib untuk membantu investigasi serta memberikan seluruh informasi yang dimilikinya dengan benar kepada Perusahaan. Kewajiban sebagaimana dalam Pasal ini tetap berlaku walaupun Perjanjian telah berakhir 
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.8</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat menetapkan ketentuan tentang pelanggaran dan sanksi sebagaimana dimaksud dalam Pasal ini melalui ketentuan perusahaan yang akan disampaikan kemudian kepada Mitra Pemasar Bisnis Bancassurance.
												</span></td>
											</tr>
													<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">6.9</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Ketentuan tentang pelanggaran dan sanksi sebagaimana dimaksud dalam Pasal ini dapat berubah berdasarkan kebijakan Perusahaan yang akan disampaikan kemudian kepada Mitra Pemasar Bisnis Bancassurance.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Para Pihak sepakat bahwa Perusahaan akan menyediakan fasilitas Pelatihan untuk mendapatkan akreditasi dan sertifikasi bagi Mitra Pemasar Bisnis Bancassurance serta bersifat wajib untuk diikuti. Pelatihan akan diselenggarakan dalam bentuk pertemuan-pertemuan, sesi-sesi pelatihan dan seminar-seminar. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila Mitra Pemasar Bisnis Bancassurance berhalangan mengikuti Pelatihan tanpa alasan yang wajar dan yang dapat diterima oleh Perusahaan dan tidak berhasil mendapatkan akreditasi atau sertifikasi, maka Perusahaan mempunyai hak untuk mengakhiri Perjanjian ini.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal Mitra Pemasar Bisnis Bancassurance tidak menyelesaikan Pelatihan atau membatalkan keikutsertaan dalam Pelatihan, maka dengan adanya pembatalan tersebut Mitra Pemasar Bisnis Bancassurance wajib mengembalikan segala biaya-biaya yang timbul atas kepesertaan Pelatihan kepada Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama keikutsertaan Mitra Pemasar Bisnis Bancassurance dalam Pelatihan yang diselenggarakan oleh Perusahaan, segala macam bentuk data dan materi yang berkaitan dengan Pelatihan tersebut merupakan dokumen perusahaan yang bersifat rahasia sehingga Mitra Pemasar Bisnis Bancassurance tidak diperkenankan untuk memperbanyak dan menyebarluaskannya tanpa izin Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance  dilarang membayar atau memperbolehkan, atau menawarkan untuk membayar atau memperbolehkan, sebagai suatu bentuk bujukan (<i>an inducement</i>) kepada siapa pun untuk menjamin diberikannya atau melakukan transaksi-transaksi bisnis apapun, potongan harga atau premi atau segala bentuk bujukan apapun yang tidak ditetapkan secara khusus dalam Polis atau ketentuan Bisnis yang dilakukan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang melakukan atau melangsungkan pengaturan apapun dengan atau membujuk seseorang untuk mengajukan permohonan klaim asuransi dalam bentuk apapun yang bukan suatu bentuk klaim yang wajar dan sah. Mitra Pemasar Bisnis Bancassurance dilarang menerima atau mendapat, atau melangsungkan pengaturan apapun dengan siapapun berdasarkan mana Mitra Pemasar Bisnis Bancassurance akan mendapatkan atau menerima uang (baik sepenuhnya maupun sebagian) yang akan dibayarkan sesuai dengan ketentuan klaim atau penyelesaian atas klaim tersebut. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang membuat pernyataan yang tidak benar atau membuat pernyataan yang tidak lengkap atau pernyataan yang tidak akurat atau membuat perbandingan dalam rangka membujuk seseorang untuk melakukan konversi atas Polis yang dimilikinya, menghentikan Polis yang dimilikinya dengan cara tidak melakukan pembayaran Premi dan tidak cukupnya nilai tunai untuk keperluan pinjaman Premi (<i>lapse</i>), melepaskan Polis yang dimilikinya untuk memperoleh nilai tunai (<i>surrender</i>) atau menghentikan transaksi bisnisnya dengan Perusahaan.
												</span></td>
											</tr>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance tidak memiliki hak untuk menagih atau menerima atas nama Perusahaan segala bentuk pembayaran dalam bentuk uang dan pembayaran lainnya, kecuali apabila hal demikian secara jelas disahkan atau dimintakan oleh Perusahaan secara tertulis.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance tidak memiliki wewenang untuk menerbitkan tanda terima apapun (baik yang bersifat sementara (interim), bersyarat atau bentuk lainnya) atas nama Perusahaan atas segala bentuk pembayaran yang diterima oleh Mitra Pemasar Bisnis Bancassurance  atas nama Perusahaan tanpa persetujuan tertulis lebih dahulu dari Perusahaan. Jika Mitra Pemasar Bisnis Bancassurance  diberi wewenang untuk menerbitkan tanda terima tersebut, Mitra Pemasar Bisnis Bancassurance hanya dapat melakukannya dengan menggunakan formulir yang telah disediakan oleh Perusahaan dengan tetap memenuhi segala syarat dan ketentuan yang ditetapkan oleh Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance dilarang bertindak untuk menempatkan Perusahaan pada kondisi yang beresiko dengan jalan menyerahkan Polis, endorsemen atau kontrak tambahan yang diterbitkan kepada pihak pemohon yang kondisi kesehatan atau pekerjaannya telah Mitra Pemasar Bisnis Bancassurance ketahui atau memiliki alasan untuk menduga bahwa kondisi kesehatan atau pekerjaan tersebut telah berubah sejak tanggal permohonan. Mitra Pemasar Bisnis Bancassurance  dilarang menyerahkan kepada siapapun segala Polis atau bukti tanda terima perpanjangan (<i>renewal receipt</i>) kecuali apabila Perusahaan telah menerima Premi sepenuhnya pada masa pembayaran dan orang kepada siapa Polis tersebut diterbitkan pada saat itu berada dalam kondisi kesehatan yang baik.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dengan Pemberitahuan dari Perusahaan, Mitra Pemasar Bisnis Bancassurance akan melaksanakan tugas pada lokasi Kantor Representatif atau tempat lain yang diberitahukan oleh Perusahaan dari waktu ke waktu. Perusahaan dapat menetapkan atas kebijaksanaan sendiri untuk memindahkan Mitra Pemasar Bisnis Bancassurance ke lokasi Kantor Representatif atau tempat lainnya dengan Pemberitahuan tertulis terlebih dahulu kepada Mitra Pemasar Bisnis Bancassurance.</span></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dengan tunduk pada ketentuan-ketentuan Perjanjian ini, atas kegiatan penjualan yang akan dilakukan oleh Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini, maka Mitra Pemasar Bisnis Bancassurance berhak mendapatkan pembayaran Kompensasi yang akan diperhitungkan sesuai dengan pedoman dan prosedur yang berlaku di Perusahaan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Selama masa berlaku Perjanjian ini, Kompensasi atas Polis hanya akan dihitung dan dibayarkan kepada Mitra Pemasar Bisnis Bancassurance sesuai Ketentuan Kompensasi Mitra Pemasar Bisnis Bancassurance yang berlaku di Perusahaan setelah dipenuhinya keadaan-keadaan tersebut berikut ini: 
												<ol type="i" align="justify" style="font-family: Arial,sans-serif">
													<li>
														penerbitan Polis oleh Perusahaan sebagaimana ditentukan oleh Perusahaan dari waktu ke waktu, setelah diterimanya permohonan yang disahkan dengan nama Mitra Pemasar Bisnis Bancassurance; 
													</li>
													<li>
														telah diterimanya Premi atau pembayaran yang disyaratkan oleh Perusahaan; 
													</li>
													<li>
														Perusahaan telah menerima tanda terima polis atau berakhirnya Masa Mempelajari Polis (<i>Freelook Period</i>) yang berlaku;
													</li>
													<li>
														kepatuhan dan tidak terdapat Pelanggaran oleh Mitra Pemasar Bisnis Bancassurance terhadap segala persyaratan dan ketentuan apapun dalam Perjanjian ini, termasuk namun tidak terbatas pada seluruh perubahan, lampiran dan persyaratan dan ketentuan lainnya yang ditetapkan oleh Perusahaan mengenai segala hal. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Jika terdapat Polis atau kontrak yang diterbitkan setelah permohonan diserahkan oleh Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini yang kemudian diubah atau dikonversi menjadi Polis atau kontrak lain, maka Kompensasi sehubungan dengan Polis atau kontrak yang diubah atau dikonversi tersebut akan dibayarkan sesuai dengan aturan yang telah ditentukan oleh Perusahaan yang berlaku pada saat terjadinya perubahan atau konversi tersebut. Mitra Pemasar Bisnis Bancassurance tidak berhak atas Kompensasi dalam bentuk apapun sehubungan dengan Polis atau kontrak yang diubah atau dikonversi kecuali perubahan atau konversi tersebut dilakukan sesuai dengan peraturan Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Tidak ada Kompensasi yang dibayarkan untuk ekstra Premi yang timbul akibat alasan-alasan yang ditetapkan berdasarkan seleksi resiko (<i>underwriting</i>).
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan pada setiap saat berhak untuk melakukan perhitungan (<i>offset</i>) atas setiap Kompensasi atau jumlah pembayaran lainnya yang terhutang oleh Perusahaan kepada Mitra Pemasar Bisnis Bancassurance, dan menahan atau memotong dari Kompensasi atau jumlah pembayaran lainnya tersebut segala hutang, kewajiban atau tanggung jawab lainnya yang harus dibayar atau terhutang atau yang kelak harus dibayar atau terhutang oleh Mitra Pemasar Bisnis Bancassurance kepada Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan pada setiap saat berhak untuk melakukan perhitungan (<i>offset</i>) atas setiap Kompensasi atau jumlah pembayaran lainnya yang terhutang oleh Perusahaan kepada Mitra Pemasar Bisnis Bancassurance, dan menahan atau memotong dari Kompensasi atau jumlah pembayaran lainnya tersebut segala bentuk manfaat, insentif, kontes dan penghargaan yang dibatalkan oleh Perusahaan akibat ketidakjujuran atau penipuan yang dilakukan oleh Mitra Pemasar Bisnis Bancassurance, sebagaimana ditetapkan oleh Perusahaan atas keputusannya sendiri.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance wajib untuk mengganti kerugian yang timbul dan membayar kepada Perusahaan sejumlah uang yang sama dengan seluruh kerugian, kerusakan, tuntutan, permintaan, pengeluaran, dan bentuk kewajiban lainnya yang timbul atas Perusahaan sebagai akibat dari tindak penipuan, ketidakjujuran, tindakan yang tidak patut atau pelanggaran atau ketidakpatuhan Mitra Pemasar Bisnis Bancassurance atas syarat dan ketentuan Perjanjian ini beserta perubahannya (jika ada) atau pelanggaran terhadap peraturan perundang-undangan yang berlaku termasuk petunjuk dan pedoman yang ditetapkan oleh pemerintah atau Kode Etik Keagenan sebagaimana yang ditetapkan oleh AAJI, akibat kelalaian, kegagalan atau penolakan Mitra Pemasar Bisnis Bancassurance  untuk memberikan jasa, termasuk segala bentuk pernyataan kesanggupan yang dibuat oleh dan segala tindakan yang dilakukan Mitra Pemasar Bisnis Bancassurance yang tidak sah berdasarkan Perjanjian ini. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance membebaskan Perusahaan dari seluruh kerugian, kerusakan, tuntutan, permintaan, pengeluaran, dan bentuk kewajiban lainnya yang timbul atas Perusahaan sebagai akibat dari tindak penipuan, ketidakjujuran, tindakan yang tidak patut atau pelanggaran atau ketidakpatuhan Mitra Pemasar Bisnis Bancassurance atas syarat dan ketentuan Perjanjian ini beserta perubahannya (jika ada) atau pelanggaran terhadap peraturan perundang-undangan yang berlaku termasuk petunjuk dan pedoman yang ditetapkan oleh pemerintah atau Kode Etik Keagenan sebagaimana yang ditetapkan oleh AAJI, akibat kelalaian, kegagalan atau penolakan Mitra Pemasar Bisnis Bancassurance untuk memberikan jasa, termasuk segala bentuk pernyataan kesanggupan yang dibuat oleh dan segala tindakan yang dilakukan Mitra Pemasar Bisnis Bancassurance yang tidak sah berdasarkan Perjanjian ini. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini, dan segala hak serta kewajiban yang timbul berdasarkan Perjanjian ini, dapat dialihkan oleh Perusahaan, baik seluruhnya maupun sebagian, kepada penggantinya atau perusahaan afiliasi. Namun demikian, Mitra Pemasar Bisnis Bancassurance dilarang mengalihkan atau bermaksud mengalihkan segala hak serta kewajiban yang mungkin dimiliki Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini tanpa persetujuan tertulis sebelumnya dari Perusahaan.</span></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											
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
												<span lang="IN" style="font-family: Arial,sans-serif">Tanpa mengurangi keberlakuan persyaratan dan ketentuan lainnya dalam Perjanjian ini (termasuk, untuk menghindari keraguan, Pasal 18.5 yang mensyaratkan Mitra Pemasar Bisnis Bancassurance untuk menyerahkan salah satu diantaranya, barang milik Perusahaan) dan seluruh dan segala hak-hak Perusahaan yang bersifat tersirat, selama jangka waktu dan setelah berakhirnya Perjanjian ini, Mitra Pemasar Bisnis Bancassurance dilarang : 
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														menggunakan untuk kepentingan pribadi Mitra Pemasar Bisnis Bancassurance atau untuk kepentingan orang lain;
													</li>
													<li>
														mengungkapkan kepada siapapun; atau
													</li>
													<li>
														akibat kegagalan atau kelalaian dalam memberikan perhatian secara seksama (<i>due care</i>) atau melaksanakan seluruh uji tuntas (<i>due diligence</i>), menyebabkan atau mengizinkan pengungkapan secara tidak sah dari segala bentuk Informasi Rahasia mengenai atau yang berhubungan dengan Perusahaan, yang mungkin diterima, digunakan atau didapatkan oleh Mitra Pemasar Bisnis Bancassurance selama masa berlakunya Perjanjian ini. Seluruh Informasi Rahasia tersebut selamanya harus tetap menjadi barang milik atau properti Perusahaan. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Untuk menghindari keraguan, kewajiban Mitra Pemasar Bisnis Bancassurance mengenai kerahasiaan sebagaimana diatur dalam Pasal ini juga berlaku untuk Informasi Rahasia yang disimpan atau disalin dengan cara dan bentuk apapun, baik dalam bentuk dokumen, rekaman atau program komputer. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Ketentuan Kerahasiaan akan tetap berlaku walaupun Perjanjian ini berakhir
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
												<b><span lang="IN" style="font-family: Arial,sans-serif">KEADAAN MEMAKSA/<i>FORCE MAJEURE</i></span></b></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan berhak menetapkan berdasarkan kebijaksanaannya sendiri mengenai terjadi atau tidaknya suatu Keadaan Memaksa/<i>Force Majeure</i>. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila akibat dari Keadaan Memaksa/<i>Force Majeure</i> tersebut Perusahaan atau Mitra Pemasar Bisnis Bancassurance, tidak dapat melaksanakan sebagian ataupun seluruh kewajibannya berdasarkan Perjanjian ini, Perusahaan atau Mitra Pemasar Bisnis Bancassurance, diwajibkan menyampaikan pemberitahuan tertulis maksimal 3 (tiga) hari kerja sejak terjadinya Keadaan Memaksa/<i>Force Majeure</i> kepada Pihak lainnya dalam Perjanjian ini yang menjelaskan secara spesifik kewajiban apa yang tidak dapat dilakukannya dan Keadaan Memaksa/<i>Force Majeure</i> yang menyebabkannya. Setelah pemberitahuan tertulis disampaikan dan selama Keadaan Memaksa/<i>Force Majeure</i> tersebut masih berlangsung, kewajiban yang tidak dapat dilakukan akibat adanya Keadaan Memaksa/<i>Force Majeure</i> tersebut akan ditunda pelaksanaannya. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan atau Mitra Pemasar Bisnis Bancassurance tidak dapat dinyatakan telah melakukan kelalaian atau pelanggaran terhadap Perjanjian ini, apabila telah melakukan pemberitahuan tertulis kepada Pihak lainnya sesuai dengan jangka waktu sebagaimana disebutkan dalam ayat 16.2 Pasal ini.  
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan atau Mitra Pemasar Bisnis Bancassurance wajib segera memberitahu Pihak lainnya dalam Perjanjian ini mengenai telah selesainya Keadaan Memaksa/<i>Force Majeure</i>. 
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
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														Mitra Pemasar Bisnis Bancassurance harus berusaha sebaik mungkin untuk bekerja sama dengan Perusahaan atau pihak lainnya dalam rangka melakukan penyelidikan atas kejadian yang dimaksud dalam Pasal 18.3 Perjanjian ini (kecuali Pasal 18.3.b) dan harus memberikan seluruh informasi, dokumen dan bantuan yang diperlukan untuk maksud-maksud pelaksanaan penyelidikan tersebut; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance dilarang berusaha melaksanakan kegiatan Bisnis apapun atau menyediakan jasa sebagaimana diatur dalam Perjanjian ini yang berkaitan secara langsung maupun tidak langsung dengan usaha perasuransian tanpa persetujuan tertulis sebelumnya dari Perusahaan; dan 
													</li>
													<li>
														Perusahaan dapat menentukan sendiri untuk menahan seluruh pembayaran Kompensasi (baik yang telah diperhitungkan maupun yang belum).
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat melakukan evaluasi terhadap kinerja maupun pencapaian Mitra Pemasar Bisnis Bancassurance setiap 3 (tiga) bulan, dimana Perusahaan dapat mengakhiri secara sepihak apabila kinerja Mitra Pemasar Bisnis Bancassurance tidak sesuai ketentuan Perusahaan dan/atau tidak mencapai target penjualan yang telah ditetapkan Perusahaan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Tanpa mengurangi keberlakuan persyaratan dan ketentuan lainnya dalam Perjanjian ini, Perusahaan atau Mitra Pemasar Bisnis Bancassurance dapat pada setiap saat mengakhiri Perjanjian ini dengan memberikan Pemberitahuan sekurang-kurangnya 1 (satu) bulan sebelumnya kepada masing masing Pihak. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan dapat mengakhiri Perjanjian ini dengan mengirimkan Pemberitahuan (namun dalam hal Pasal 18.3.b, maka pemberhentian tersebut dapat dilaksanakan tanpa Pemberitahuan) kepada Mitra Pemasar Bisnis Bancassurance jika: 
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														izin, akreditasi, otorisasi atau registrasi Mitra Pemasar Bisnis Bancassurance dari atau pada lembaga pemerintah terkait atau badan regulator atau badan pengawas dicabut, dibatalkan atau dihentikan;
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance meninggal dunia; 
													</li>
													<li>
														menurut Perusahaan Mitra Pemasar Bisnis Bancassurance terbukti atau telah melakukan perbuatan fraud berdasarkan bukti-bukti yang cukup sebagaimana dijelaskan dalam Pasal 4.2 Perjanjian ini; 
													</li>
													<li>
														menurut pendapat Perusahaan, Mitra Pemasar Bisnis Bancassurance melakukan tindakan yang menyebabkan gangguan atau campur tangan dalam operasional Perusahaan; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance melanggar hukum termasuk tetapi tidak terbatas pada penggelapan, penipuan atau perusakan barang milik Perusahaan atau melanggar undang-undang atau peraturan lain;
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance melangsungkan perjanjian atau pengaturan dengan perusahaan lain atau orang lain (baik secara lisan maupun tertulis) untuk bertindak selaku penasehat keuangan; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance memberikan pernyataan tentang fakta-fakta yang salah dalam lamarannya sebagai Mitra Pemasar Bisnis Bancassurance atau selama Masa Kemitraan; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance tidak memenuhi persyaratan Pelatihan, rencana bisnis, proses penjualan, manajemen kegiatan, produksi (termasuk tetapi tidak terbatas pada Case Count), Persistensi atau persyaratan lainnya dalam kaitannya dengan penunjukan Mitra Pemasar Bisnis Bancassurance berdasarkan Perjanjian ini yang mungkin ditentukan oleh Perusahaan atau dipersyaratkan oleh undang-undang, perundangan, aturan, peraturan yang berlaku, kode dan pedoman pihak yang berwenang yang diberlakukan dari waktu ke waktu;
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance gagal memenuhi komponen mana saja dari KPI berdasarkan kegagalan Mitra Pemasar Bisnis Bancassurance untuk mencapai jumlah yang dipersyaratkan berdasarkan KPI; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance melanggar peraturan perundang-undangan, atau kode etik keagenan baik Kode Etik Bisnis Perusahaan atau Kode Etik Keagenan yang diterbitkan oleh AAJI atau instansi lain pengganti AAJI, atau melanggar standar praktek keagenan atau terlibat dalam suatu tindakan yang menurut pendapat Perusahaan yang wajar dapat menyebabkan reputasi buruk terhadap Perusahaan atau merugikan kepentingan Perusahaan;
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance melakukan wanprestasi atau melanggar isi Perjanjian ini; atau 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance mengalami cacat tubuh secara tetap dan permanen sehingga mengakibatkan Mitra Pemasar Bisnis Bancassurance tidak mampu menjalankan kewajibannya. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal berakhirnya Perjanjian ini, maka pembayaran atas Kompensasi akan dihentikan segera (baik yang telah diperhitungkan maupun yang belum). Seluruh hak-hak Mitra Pemasar Bisnis Bancassurance atas unsur manapun dari Kompensasi yang telah diperhitungkan sebelum berakhirnya Perjanjian ini segera menjadi hangus pada saat berakhirnya Perjanjian ini, dan Mitra Pemasar Bisnis Bancassurance dengan demikian melepaskan setiap dan seluruh haknya untuk menerima pembayaran tersebut. 
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
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														Mitra Pemasar Bisnis Bancassurance dilarang menyatakan dirinya sebagai bagian dari Perusahaan untuk tujuan apapun juga; 
													</li>
													<li>
														Tidak diperkenankan memasuki areal perkantoran dan/atau Kantor Representatif termasuk ruang-ruang kerja Perusahaan tanpa persetujuan Perusahaan;
													</li>
													<li>
														terlibat dan bergabung dengan perusahaan asuransi lain sebelum Perusahaan menyepakati pengakhiran Perjanjian, kewajiban yang dinyatakan dalam Perjanjian ini diselesaikan oleh Mitra Pemasar Bisnis Bancassurance, dan lisensi keagenan yang terdaftar untuk Perusahaan dicabut oleh lembaga penerbit lisensi; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance dan/atau ahli warisnya bertanggung jawab dan wajib segera menyelesaikan segala kewajiban-kewajiban dan/atau hutang (jika ada) kepada Perusahaan yang timbul dari Perjanjian ini; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance wajib segera menyerahkan kepada Perusahaan seluruh daftar dan informasi mengenai para Pemegang Polis dan/atau Tertanggung, karyawan, penasehat keuangan, korespondensi, dokumen-dokumen, dan seluruh barang lainnya yang merupakan milik Perusahaan dan/atau mengandung segala Informasi Rahasia (sebagaimana dimaksud dalam Pasal 15) yang mungkin dimiliki atau dikuasai oleh Mitra Pemasar Bisnis Bancassurance, termasuk, untuk menghindari keraguan, sebagaimana dimaksud dalam Pasal 15 di atas; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance harus dengan segera menyerahkan kepada Perusahaan seluruh material yang dapat digunakan kembali (termasuk namun tidak terbatas pada buku harian digital, personal computer, notebook computer,  flash disk, atau media lainnya) yang mengandung Informasi Rahasia (sebagaimana dimaksud dalam Pasal 15) untuk maksud penghapusan Informasi Rahasia tersebut; 
													</li>
													<li>
														Mitra Pemasar Bisnis Bancassurance berkewajiban mengembalikan seluruh inventaris Perusahaan dan dokumen lain yang masih dimiliki dan atau dikuasai oleh Mitra Pemasar Bisnis Bancassurance; dan 
													</li>
													<li>
														Perusahaan, jika menurut pendapat atau pertimbangannya dianggap patut, dapat mempublikasikan dan/atau mengedarkan kepada siapapun Pemberitahuan mengenai pemberhentian penunjukan Mitra Pemasar Bisnis Bancassurance. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance mengakui dan menyatakan bahwa Pasal 8, Pasal 13, Pasal 15, dan ketentuan pasal-pasal lainnya dalam Perjanjian ini yang relevan yang dapat dilaksanakan dalam keadaan apapun. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal Mitra Pemasar Bisnis Bancassurance  tidak memenuhi kenentuan dan persyaratan minimum yang ditetapkan oleh Perusahaan, maka Perusahaan dapat melakukan pengakhiran Perjanjian ini tanpa adanya tuntutan hukum dari Pihak Mitra Pemasar Bisnis Bancassurance, serta Perusahaan berhak menerima kompensasi/ganti rugi dari Mitra Pemasar Bisnis Bancassurance biaya-biaya yang telah dikeluarkan selama proses rekrutmen dan Pelatihan/Lisensi AAJI. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perjanjian ini ditandatangani oleh Para  Pihak dalam keadaan sehat fisik maupun mental tanpa adanya penipuan, kesalahan dan atau paksaan dari pihak  manapun juga.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Jika di kemudian hari Perjanjian ini ternyata mengandung kesalahan atau terdapat perubahan/hal-hal yang belum cukup diatur, maka Perjanjian ini dapat diubah dan atau ditambahkan secara tertulis, dan merupakan addendum yang tidak terpisahkan dari Perjanjian ini.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Jika pada suatu saat terdapat ketentuan dalam Perjanjian ini yang dinyatakan bertentangan dengan hukum yang berlaku atau menjadi tidak sah, atau tidak dapat diberlakukan, baik seluruhnya maupun sebagian, berdasarkan hukum perundangan yang berlaku dalam suatu wilayah hukum tertentu, maka legalitas, keabsahan dan keberlakuan ketentuan lainnya dalam Perjanjian ini (atau dalam hal adanya bagian dari ketentuan yang dinyatakan bertentangan dengan hukum yang berlaku atau menjadi tidak sah atau tidak dapat diberlakukan tersebut) berdasarkan hukum perundangan yang berlaku dalam wilayah hukum tersebut atau wilayah lainnya atau legalitas, keabsahan dan keberlakuan ketentuan lainnya tersebut - tidak akan terpengaruh atau berkurang.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Semua Pemberitahuan harus tertulis dan ditandatangani oleh Perusahaan atau Mitra Pemasar Bisnis Bancassurance (sebagaimana berlaku).
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
												<span lang="IN" style="font-family: Arial,sans-serif">Setiap Pemberitahuan yang diberikan oleh masing-masing Pihak dalam Perjanjian ini dianggap telah disampaikan secara patut atau diterima oleh pihak yang menerima pada saat disampaikan, jika disampaikan secara langsung; dan pada hari kerja kelima setelah tanggal pengiriman, jika dilakukan melalui surat/pos tercatat ke alamat terakhir Mitra Pemasar Bisnis Bancassurance yang diketahui Perusahaan, atau sebagaimana tercantum dalam Perjanjian ini, atau ke alamat Kantor Representatif dimana Mitra Pemasar Bisnis Bancassurance ditugaskan oleh Perusahaan atau ke alamat Kantor Representatif (sebagaimana berlaku). Dalam hal pengiriman Pemberitahuan dilakukan melalui media elektronik, suatu pemberitahuan dianggap telah diterima oleh pihak penerima pada tanggal pengiriman itu asalkan setelah itu salinan asli dari berita elektronik yang telah dibubuhi tanda tangan dikirimkan. 
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
												<ol type="a" align="justify" style="font-family: Arial,sans-serif">
													<li>
														Perjanjian ini merupakan keseluruhan perjanjian di antara Perusahaan dan Mitra Pemasar Bisnis Bancassurance, sehubungan dengan transaksi yang dimaksudkan di sini, dan, kecuali disebutkan sebaliknya dalam Perjanjian ini, menggantikan semua perjanjian yang telah dibuat sebelumnya antara Mitra Pemasar Bisnis Bancassurance dan Perusahaan, komitmen maupun kesepahaman baik lisan maupun tulisan mengenai hal yang diatur di sini. 
													</li>
													<li>
														Tidak ada perubahan, modifikasi atau pelepasan dari Perjanjian ini yang berlaku sah atau mengikat kecuali dinyatakan secara tertulis dan ditandatangani dan disampaikan secara sah oleh Perusahaan kepada siapa pelaksanaan dari perubahan, modifikasi atau pelepasan tersebut dimaksudkan.
													</li>
													<li>
														Dalam periode 1 (satu) tahun setelah dihentikannya Perjanjian ini, Mitra Pemasar Bisnis Bancassurance tidak diperkenankan untuk bersaing dengan Perusahaan secara langsung maupun tidak langsung (dalam kapasitasnya atau dalam kaitannya dengan orang lain, firma lain, perusahaan lain atau entitas lain) meminta, mempromosikan, atau mendekati dengan cara apa pun dengan tujuan untuk melakukan Bisnis dengan siapapun, firma manapun, perusahaan manapun atau entitas manapun yang adalah klien atau prospektif klien dari Perusahaan dalam jangka waktu tertentu, dan yang dengan siapa Mitra Pemasar Bisnis Bancassurance melakukan transaksi material dalam menyediakan jasanya (atau yang patut diketahui olehnya bahwa ia adalah klien atau prospektif klien), selama jangka waktu tertentu, dengan tujuan melakukan Bisnis atau aktivitas yang telah dilakukan oleh Perusahaan selama jangka waktu tertentu dan yang dalam Bisnis atau aktivitas yang mana Mitra Pemasar Bisnis Bancassurance berkaitan dengan pelaksanaan jasa Mitra Pemasar Bisnis Bancassurance selama jangka waktu tertentu. 
													</li>
													<li>
														Judul-judul yang digunakan dalam Perjanjian ini hanya untuk kemudahan saja dan tidak merupakan bagian dari Perjanjian ini.
													</li>
													<li>
														Setiap syarat atau ketentuan Perjanjian ini yang atau menjadi dilarang atau tidak dapat dilaksanakan oleh karena alasan apapun juga di yurisdiksi manapun juga, akan menjadi, dalam yurisdiksi tersebut, tidak berlaku sejauh larangan atau tidak berlakunya ketentuan tersebut dan larangan atau tidak berlakunya ketentuan tersebut tidak menyebabkan tidak absahnya ketentuan lain dari Perjanjian ini atau berdampak terhadap keabsahan atau keberlakukan dari ketentuan-ketentuan lainnya. 
													</li>
													<li>
														Seluruh dokumen atau lampiran atau perubahan Perjanjian yang akan dibuat dikemudian hari oleh Para Pihak merupakan satu kesatuan dan bagian yang tidak terpisahkan dari Perjanjian. 
													</li>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Segala hak dan kewajiban Mitra Pemasar Bisnis Bancassurance berlaku efektif sejak Pihak Pertama menyatakan dan menerbitkan secara tertulis Surat Penetapan (SPA) kepada Mitra Pemasar Bisnis Bancassurance dan/atau seluruh ketentuan/persyaratan minimum yang ditetapkan Perusahaan telah terpenuhi.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam Perjanjian ini Perusahaan akan menyediakan sarana, prasarana, fasilitas dan perangkat yang dianggap perlu dalam menunjang Mitra Pemasar Bisnis Bancassurance dalam menjalankan pekerjaannya, dimana Mitra Pemasar Bisnis Bancassurance akan menandatangani pernyataan tertulis atau berita acara penggunaan sarana, prasarana, fasilitas, perangkat Perusahaan yang dibuat secara terpisah daripada Perjanjian ini, namun mengikat dan merupakan satu kesatuan yang tidak terpisahkan dalam Perjanjian ini. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance setuju bahwa hanya piranti lunak (<i>software</i>) yang telah disetujui oleh Perusahaan yang dapat dipasang atau di <i>install</i> di dalam perangkat Perusahaan dan pemasangan harus dilakukan oleh staf departemen IT Perusahaan. Perjanjian penggunaan piranti lunak (<i>software licencing agreement</i>) harus ada di tempat Mitra Pemasar Bisnis Bancassurance berada ataupun pada departemen IT Perusahaan. Definisi piranti lunak tersebut termasuk piranti lunak berbasis <i>shareware</i>, <i>trial license</i> ataupun <i>evaluation copy</i>. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance tidak diizinkan untuk menggunakan piranti lunak asli yang sudah habis masa berlakunya. Penggunaan perangkat yang bukan milik Perusahaan (dengan atau tanpa piranti lunak yang asli) pada jaringan sistem  perangkat Perusahaan tidak diperbolehkan kecuali sudah dilakukan pemeriksaan dan disetujui oleh departemen IT Perusahaan. 
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan tidak turut bertanggung jawab atas penggunaan piranti lunak dan/atau penggunaan perangkat oleh Mitra Pemasar Bisnis Bancassurance yang tidak disetujui oleh Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Apabila terdapat kehilangan atau kerusakan atas sarana, prasarana, fasilitas dan perangkat yang disediakan Perusahaan untuk dipinjamkan kepada Mitra Pemasar Bisnis Bancassurance yang diakibatkan karena kelalaian atau kesalahan Mitra Pemasar Bisnis Bancassurance, maka Mitra Pemasar Bisnis Bancassurance setuju dan wajib untuk memberikan ganti rugi sejumlah kerugian yang timbul akibat kelalaian atau kesalahan yang telah dilakukannya tersebut.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam hal berakhirnya Perjanjian sebagaimana dalam Pasal 18 Perjanjian ini, maka Mitra Pemasar Bisnis Bancassurance  wajib mengembalikan segala sarana, prasarana, fasilitas, dan perangkat yang telah disediakan oleh Perusahaan paling lambat 1 (satu) hari kerja setelah surat pengakhiran Perjanjian disampaikan kepada Mitra Pemasar Bisnis Bancassurance. Adapun pengembalian sarana, prasarana, fasilitas, dan Perangkat Perusahaan tersebut diserahkan melalui Pejabat Di Bawah BOD-2 Unit Kerja Yang Menjalankan Fungsi Sales pada Bisnis Bancassurance dengan bukti tertulis dalam tanda terima dokumen sebagai bukti penyerahan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance  dilarang untuk membuat, menyebarkan, meneruskan atau mengirim email ke pihak lain kecuali Mitra Pemasar Bisnis Bancassurance  mengetahui dan dapat mengkonfirmasi mengenai ketepatan atau kebenaran atas isi dari informasi dalam email dimaksud. Mitra Pemasar Bisnis Bancassurance  bertanggung jawab atas setiap penggunaan email Perusahaan yang tidak berhubungan dengan tugas Mitra Pemasar Bisnis Bancassurance  di Perusahaan. Perusahaan tidak bertanggung jawab dan tidak turut bertanggung jawab atas penggunaan email yang tidak sesuai dengan ketentuan ini dan peraturan IT Perusahaan.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance  dilarang untuk menggunakan akun email selain yang telah disediakan oleh Perusahaan dalam kaitannya dengan pelaksanaan Perjanjian ini. 
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
												<b><span lang="IN" style="font-family: Arial,sans-serif">PERNYATAAN ANTI KORUPSI, PENYUAPAN, DAN PENCUCIAN UANG  </span></b></td>
											</tr>
											<tr>
												<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify">
														<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span>
													</p>
												</td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">(1)</span>
												</td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
													<span lang="IN" style="font-family: Arial,sans-serif">Demi terjaganya kondusifitas selama bekerja sama serta mendukung penerapan Sistem Manajemen Anti Penyuapan sesuai dengan ISO 37001:2016, maka dengan ini Para Pihak menyatakan sebagai berikut:  
													</span>
													<ol type="a" align="justify" style="font-family: Arial,sans-serif">
														<li>
															Tidak akan melakukan praktik korupsi, kolusi, nepotisme, dan pencucian uang;
														</li>
														<li>
															Tidak akan menerima, memberi, atau melakukan permintaan terhadap sesuatu yang dapat dikategorikan sebagai suap dan/atau gratifikasi baik sebelum proses maupun setelah diberlakukannya kerja sama.
														</li>
														<li>
															Tidak melakukan upaya yang bersifat memengaruhi keputusan pemangku kewenangan;
														</li>
														<li>
															Menjamin proses kerja sama yang dilakukan sesuai dengan ketentuan yang berlaku dan tidak ada unsur kepentingan pada masing-masing Pihak di dalamnya. 
														</li>
														<li>
															Tidak masuk dalam daftar hitam dari Lembaga Pemerintah dan tidak dalam pengawasan pengadilan, tidak dalam kondisi pailit, tidak sedang diberhentikan kegiatan usahanya, dan/atau pemilik atau pengurus yang bertindak tidak sedang terjerat kasus pidana atau pelanggaran hukum. 
														</li>
														<li>
															Tidak memiliki reputasi penyuapan, penipuan, ketidakjujuran atau perbuatan buruk serupa, atau pernah diinvestigasi, dituduh, dikenakan sanksi, atau dicekal karena penyuapan atau perbuatan kriminal serupa. 
														</li>
														<li>
															Akan melaksanakan proses kerja sama kemitraan sesuai dengan Perjanjian ini yang telah disepakati secara transparan dan profesional berdasarkan prinsip itikad baik dengan kecermatan yang tinggi, dan dalam keadaan bebas, mandiri atau tidak dibawah tekanan, maupun pengaruh dari pihak lain. 
														</li>
													</ol>
												</td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Dalam melaksanakan kewajibannya berdasarkan Perjanjian ini, Para Pihak harus mematuhi semua Hukum yang Berlaku terkait dengan pencucian uang, pembiayaan dan sanksi anti-terorisme ("APU PPT").  
												</span></td>
											</tr>
											<tr>
												<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
												<td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">(3)</span></td>
												<td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Pernyataan Para Pihak sebagaimana dimaksud pada ayat (1) Pasal ini akan tetap berlaku walaupun Perjanjian ini berakhir. 
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
												<b><span lang="IN" style="font-family: Arial,sans-serif">PASAL 30</span></b></td>
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
												<span lang="IN" style="font-family: Arial,sans-serif">Demikian Perjanjian ini dibuat pada tanggal sebagaimana tersebut di atas.Perjanjian ini adalah merupakan dokumen elektronik yang dinyatakan sah walaupun tanpa tanda tangan basah Para Pihak. Validasi terhadap data dalam Perjanjian ini dapat dilakukan melalui URL pada QR Code yang tercetak sesuai nama yang tercantum sebagai Para Pihak yang menyetujui Perjanjian ini.
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
												<span lang="IN" style="font-family: Arial,sans-serif">Perusahaan,</span></p>
											</td>
											</tr>
											<tr>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">PT ASURANSI JIWA IFG</span>
													</p>
												</td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
													<p class="MsoNormal" style="text-align: left; margin-left: -38.4pt">
														<span lang="IN" style="font-family: Arial,sans-serif">MITRA PEMASAR BISNIS BANCASSURANCE </span>
													</p>
												</td>
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p></td>
												
											</tr>
											<tr>
											<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p></td>
												
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
												<span lang="IN" style="font-family: Arial,sans-serif"><?=$row["JABATAN_TTD"];?></span></p></td>
												<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
												<p class="MsoNormal" style="text-align: justify; margin-left: -38.4pt">
												<span lang="IN" style="font-family: Arial,sans-serif">Mitra Pemasar Bisnis Bancassurance</span></p></td>
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
												<td width="615" colspan="11" valign="top" style="font-family: Arial,sans-serif;width: 461.4pt; height: 17.45pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in; text-align: justify;">
													Dokumen Elektronik ini dinyatakan sah walaupun tanpa tanda tangan basah dari Para Pihak. Validasi terhadap data dalam Dokumen Elektronik ini dapat dilakukan melalui URL pada QR Qode yang tercetak. Sesuai nama yang tercantum di bawahnya sebagai Para Pihak yang menyetujui atas PKAJ ini.
												</td>
											</tr>
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
											$agenName = 'Mitra Pemasar Bisnis Bancassurance';  
											include('kode_etik.php');
											include('pakta_integritas.php'); 
												    
											?>
										</table>
                                        <table width="780" border="0" cellspacing="0" cellpadding="0">
                                                     <tr>
                                                        <td width="256">

                                                        </td>
                                                        <td width="208">
                                                           <div align="center"></div>
                                                        </td>
                                                        <td width="316">
                                                            
                                                        </td>
                                                     </tr>
                                                     <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                     </tr>
                                                     <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                     </tr>
                                                     <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                     </tr>
                                                     <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                     </tr>
                                                     <tr>
                                                        <td style="width:70%">
                                                            <div align="justify">
                                                                <input type="checkbox" id="s_epaj" name="s_epaj" value="1">
                                                                <span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">
                                                                    Dengan ini Saya menyatakan setuju untuk melakukan penandatanganan EPKAJ   
                                                                    <br>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                           <div align="center"></div>
                                                        </td>
                                                        <td>
                                                            <div align="center">
                                                                <span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">
                                                                    <button type="button" onclick="otp_epkaj(event);" class="btn btn-primary waves-effect waves-light  pull-right">
                                                                        Submit
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                     </tr>
                                                     <tr>
                                                        <td>
                                                            <div align="center">
                                                                <span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black"></span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                           <div align="center"></div>
                                                        </td>
                                                        <td>

                                                        </td>
                                                     </tr>
                                                  </table>
                                                  </BR>
                                                  </BR>
                                                  <p style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">Catatan : </br>
                                                  </p>
                                                  <p style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">
							Dokumen Elektronik ini dinyatakan sah walaupun tanpa tanda tangan basah dari Para Pihak. Validasi terhadap data dalam Dokumen Elektronik ini dapat dilakukan melalui URL pada QR Qode yang tercetak.
							Sesuai nama yang tercantum di bawahnya sebagai Para Pihak yang menyetujui atas PKAJ ini. </br>
                                                  </p>
                                                  <p>&nbsp;</p>
                                              
											
                                         </table>
                                         <p>&nbsp;</p>
                                         <p class="MsoNormal" align="center" style="text-align: center">&nbsp;</p>
                                         <p class="MsoNormal" style="text-align: justify">
                                            <span lang="ES" style="font-family: Arial,sans-serif; color: black">&nbsp;</span>
                                         </p>
                                         <p class="MsoNormal" align="center" style="text-align: center">&nbsp;</p>
                                         <p class="MsoNormal" style="text-align: justify">
                                            <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span>
                                         </p>
                                         <p class="MsoNormal" align="center" style="text-align: center">&nbsp;</p>          
										
                                    
                                </body>
                            
                        </div>
                    <?php } ?>
                    </form>
                    <div class="text-center">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function otp_epkaj(event){
        event.preventDefault();

        if($('#s_epaj').prop('checked') == false){
          alert('Harap mencentang kotak dialog pernyataan bahwa anda setuju untuk melakukan penandatanganan digital');
          return false;
        }

        var noagen = $("#noagen").val();
        var nmagen = $("#nmagen").val();
        var nopkaj = $("#nopkaj").val();
        var tglpkaj = $("#tglpkaj").val();

        var contentForm = {};
        $("#form_epkaj").serializeArray().map(
            function(x){contentForm[x.name] = x.value;});
            console.log(contentForm);

        $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>" +"index.php/Pkajonline/otp_pkajonline",
            cache: false,
            data: contentForm,
            success: function(msg){

                window.location.href = "<?= base_url(); ?>" +"Pkajonline/otp_pkajonline?noagen=" + noagen +"&nopkaj=" + nopkaj +"&tglpkaj=" + tglpkaj +"&nmagen=" + nmagen + "&name=" + "<?= $this->session->NAMALENGKAP; ?>" + "&iduser=" + "<?= $this->session->IDUSER; ?>" ;

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('msg');
                // console.log('error ' + errorThrown);
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }
</script>