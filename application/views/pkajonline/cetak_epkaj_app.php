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
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center"><b>
                                       <span lang="FI" style="font-family: Arial,sans-serif">PERJANJIAN 
                                       KEAGENAN ASURANSI JIWA KHUSUS AAP</span></b></td>
                                    </tr>
                                    <tr style="height: 23.25pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 23.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center">
                                       <span lang="FI" style="font-family: Arial,sans-serif">NOMOR :
                                                   <?=$row["NOPKAJAGEN"];?>
                                                   /E-PKAJ-
                                                   <!-- <?=$row["KDKANTOR"];?> - <?=$row["BLN"];?> <?=$row["THN"];?> -->
                                                  <?  if($row["THN"] >= 2020){
                                                      echo ("KP - ".
                                                      $row["BLN"].' '.
                                                      substr($row["THN"],-2));
                                                    }else{
                                                      echo ($row["KDKANTOR"]." - ".
                                                      $row["BLN"].' '.
                                                      $row["THN"]);
                                                    }
                                                  ?>
                                        </span>
                                        </p>
                                       <p class="MsoNormal" align="center" style="text-align: center"><b>
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></b></td>
                                    </tr>
                                    <tr>
                                      <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                        <p class="MsoNormal2" style="text-align: justify"> 
                                          <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                               Pada 
                                               hari ini
                                               <?=$HARI;?>
                                               tanggal
                                               <?=$TANGGAL;?>
                                               bulan
                                               <?=$BULAN;?>
                                               tahun
                                               <?=$TAHUN;?>
                                               yang bertanda tangan 
                                               di bawah ini :
                                            </span>
                                          </p>
                                      </td>
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
                                       <span lang="FI" style="font-family: Arial,sans-serif"> <?=$row["NAMABM"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor Kepegawaian/ 
                                       Agen</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><? if (strlen($row["NIPBM"])<2){ echo $row["NOAGENBM"];} else{echo $row["NIPBM"];}?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Jabatan&nbsp; </span>		</td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["JABATANBM"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Alamat Kantor</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["ALAMATKTR"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor 
                                       Telepon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["TELPONKTR"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor Faximile&nbsp;&nbsp;		</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="FI" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["FAXKTR"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">yang dalam perbuatan hukum 
                                       ini bertindak dalam jabatannya tersebut untuk dan atas nama dan 
                                       karenanya sah mewakili Direksi :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nama 
                                       Perusahaan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">PT. Asuransi 
                                       Jiwasraya (Persero)</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Alamat Kantor 
                                       Pusat</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Jl. Ir. H. Juanda 
                                       34 Jakarta Pusat (10120)</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor Telepon&nbsp;&nbsp;		</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                    <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span class="style1">021-3845031</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor Faximile</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                    <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span class="style1">021-<span style="font-family: Arial,sans-serif; color: black">3862344</span></span></td>
                                    </tr>
                                    <tr>
                                       <td width="207" colspan="8" valign="top" style="width: 155.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">yang selanjutnya 
                                       disebut</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr style="height: 5.25pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 5.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">&nbsp;</span><span style="font-family: Arial,sans-serif">----------------------------------------------------------<b>PERUSAHAAN</b>--------------------------------------------------------
                                       </span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">II.</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nama (sesuai 
                                       KTP)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
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
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span style="font-family: Arial,sans-serif">
                                          &nbsp;&nbsp;<?=$row["NOAGEN"];?>
                                    </span></span></td>
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
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><span style="font-family: Arial,sans-serif"><?=$row["TEMPATLAHIR"];?>
                                                         ,
                                                         <?=$row["TGLLAHIR"];?></span></td>
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
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">
                                       <?=$row["JENISKELAMIN"];?> </span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Alamat (sesuai 
                                       KTP)</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["ALAMATAGEN"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor KTP/SIM</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NOMORIDAGEN"];?></span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Nomor Telepon 
                                       Rumah/Hp</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["NOTELPONAGEN"];?></span></td>
                                    </tr>
                                    <!-- <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Alamat Email&nbsp;&nbsp;&nbsp;&nbsp;		</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif"><?=$row["EMAILTETAP"];?></span></td>
                                    </tr> -->
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="7" valign="top" style="width: 192px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Saluran Distribusi&nbsp;&nbsp;&nbsp;&nbsp;		</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="392" colspan="2" valign="top" style="width: 294.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">Unit Kerja Area Khusus PT Anggana Anggih Prima</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="FI" style="font-family: Arial,sans-serif">yang dalam hal ini 
                                       bertindak</span><span style="font-family: Arial,sans-serif"> untuk dan 
                                       atas nama diri sendiri, yang selanjutnya disebut :</span></td>
                                    </tr>
                                    <tr style="height: 9.75pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 9.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">&nbsp;<span lang="FI">--------------------------------------------------------------------<b>AGEN</b>------------------------------------------------------------</span></span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">sebagaimana dimaksud dalam 
                                       Undang-Undang Nomor 2 tahun 1992 tentang Usaha Perasuransian, 
                                       aturan-aturan pelaksanaannya serta perubahan-perubahannya yang dilakukan 
                                       dari waktu ke waktu dan berada pada saluran distribusi Branch Office 
                                       System (BOS) PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">PERUSAHAAN dan AGEN secara 
                                       bersama-sama selanjutnya disebut PARA PIHAK.</span></p>
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span style="font-family: Arial,sans-serif">PARA PIHAK telah bersepakat untuk mengadakan Perjanjian Keagenan Asuransi Jiwa Khusus yang selanjutnya disebut  "PKAJ  Khusus", di  mana  PERUSAHAAN menetapkan  dan  menunjuk  AGEN sebagaimana AGEN menerima dan menyetujui penetapan dan penunjukan terse but untuk memberikan jasa dalam memasarkan produk asuransi milik PERUSAHAAN untuk dan atas nama PERUSAHAAN, berdasarkan syarat-syarat dan ketentuan-ketentuan sebagaimana diatur dalam pasal-pasal di bawah ini:</span></td>
                                    </tr>
                                    <tr style="height: 13.05pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 13.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
                                       <span style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr style="height: 7.5pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 7.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center"><b>
                                       <span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 1</span></b></td>
                                    </tr>
                                    <tr style="height: 12.15pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 12.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">ARTI DARI 
                                       BEBERAPA ISTILAH</span></b></td>
                                    </tr>
                                    <tr style="height: 9.75pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 9.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="margin-right: -5.4pt"><b>
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Di dalam PKAJ KHUSUS ini 
                                       yang dimaksud dengan : </span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">1.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">PKAJ KHUSUS</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah Perjanjian 
                                       Keagenan Asuransi Jiwa ini, berikut lampiran-lampiran dan
                                       perubahan-perubahannya termasuk Sistem Keagenan yang berlaku;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">2.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Sistem Keagenan</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Adalah ketentuan 
                                       yang mengatur hak dan kewajiban PERUSAHAAN dan AGEN yang ditetapkan oleh 
                                       PERUSAHAAN termasuk ketentuan pelaksanaannya berikut 
                                       perubahan-perubahannya yang ditetapkan dari waktu ke waktu yang memuat 
                                       hak dan kewajiban antara PERUSAHAAN dengan AGEN sebagai mitra kerja dan 
                                       bukan merupakan syarat-syarat dan ketentuan dalam hubungan 
                                       ketenagakerjaan;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">3.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Jabatan </span>		</td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah posisi atau 
                                       kedudukan AGEN yang ditetapkan dalam Surat Penetapan Agen (SPA) 
                                       berdasarkan struktur Organisasi Keagenan Branch Office System yang 
                                       berlaku sebagaimana ditetapkan oleh PERUSAHAAN dari waktu ke waktu;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">4.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Branch Office 
                                       System (BOS)</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah saluran 
                                       distribusi penjualan yang secara administratif dan biayanya dikelola 
                                       oleh PERUSAHAAN serta mempunyai hirarki struktur organisasi keagenan 
                                       termasuk hak dan kewajiban AGEN ditentukan PERUSAHAAN berdasarkan Sistem 
                                       Keagenan yang berlaku,</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">5.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Surat Penetapan 
                                       Agen (SPA)</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah surat yang 
                                       dikeluarkan oleh PERUSAHAAN yang memuat tentang penunjukkan sebagai AGEN 
                                       yang berisikan dan/atau memuat nomor AGEN, nama AGEN, Jabatan, wilayah 
                                       penjualan, target AGEN dan/atau hal-hal lain yang berkaitan dengan 
                                       administrasi Keagenan.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">6.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Promosi </span>		</td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah kenaikan 
                                       Jabatan AGEN lebih tinggi dibandingkan&nbsp; Jabatan sebelumnya;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">7.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Degradasi </span>		</td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah penurunan 
                                       Jabatan AGEN lebih rendah dibandingkan&nbsp; Jabatan sebelumnya;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">8.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Penangguhan </span>		</td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah penundaan 
                                       kenaikan Jabatan AGEN;</span></p>
                                       <p class="MsoNormal" style="text-align: justify; line-height: 7.0pt; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">9.</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Produk </span>		</td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah 
                                       produk-produk PERUSAHAAN yang meliputi jasa Asuransi Jiwa dan/atau 
                                       pertanggungan risiko atau Produk yang berafiliasi/beraliansi dengan 
                                       perusahaan lain;</span></p>
                                       <p class="MsoNormal" style="text-align: justify; line-height: 7.0pt; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">10</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Fungsi Pemasaran		</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah fungsi 
                                       untuk memasarkan, menjual, memberikan penjelasan kepada calon Pemegang 
                                       Polis dan melakukan hal-hal yang dianggap perlu dalam memasarkan produk,&nbsp; 
                                       yang harus dilakukan oleh AGEN berdasarkan PKAJ KHUSUS;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">11</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Field Underwriting</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah melakukan 
                                       verifikasi terhadap kebenaran,&nbsp; kelengkapan dan akurasi data-data/informasi 
                                       tentang Calon Pemegang Polis sebagaimana tertera atau terlampir pada 
                                       form aplikasi (Surat Permintaan Asuransi Jiwa dan Surat Keterangan 
                                       Kesehatan) Calon Pemegang Polis yang bersangkutan;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">12</span></td>
                                       <td colspan="4" valign="top" style="width: 140px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Kode Etik Keagenan</span></p>
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td width="16" valign="top" style="width: 12.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify"><b>
                                       <span lang="IN" style="font-family: Arial,sans-serif">:</span></b></td>
                                       <td width="432" colspan="5" valign="top" style="width: 324.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">adalah ketentuan 
                                       yang ditetapkan dari waktu ke waktu oleh Asosiasi Asuransi Jiwa 
                                       Indonesia yang mengatur tata-cara, perilaku, larangan dan sanksi kepada 
                                       Agen Asuransi Jiwa Indonesia termasuk kepada AGEN berdasarkan PKAJ KHUSUS ini.</span></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">HUBUNGAN HUKUM</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Hubungan hukum 
                                       antara PERUSAHAAN dengan AGEN menurut PKAJ KHUSUS ini&nbsp; adalah hubungan antara 
                                       mitra kerja dan karenanya bukan merupakan hubungan hukum antara 
                                       pengusaha dan pekerja sekaligus tidak ada satupun dari syarat dan 
                                       ketentuan yang berlaku dalam PKAJ KHUSUS ini dapat diartikan atau ditafsirkan 
                                       sebagai suatu hubungan ketenagakerjaan sebagaimana dimaksud dan diatur 
                                       dalam perundangan tentang&nbsp; Ketenagakerjaan yang berlaku.</span></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">HAK DAN 
                                       KEWAJIBAN PERUSAHAAN</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Selama 
                                       berlangsungnya PKAJ KHUSUS ini, PERUSAHAAN berhak untuk :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menetapkan secara 
                                       periodik Sistem Keagenan dan atau mengubahnya dari waktu ke waktu jika 
                                       diperlukan.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menunjuk dan 
                                       memberi wewenang serta menetapkan penempatan AGEN untuk memasarkan 
                                       Produk di wilayah operasional&nbsp; PERUSAHAAN;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menetapkan Jabatan 
                                       AGEN berdasarkan penilaian PERUSAHAAN, dengan suatu penetapan tersendiri 
                                       yang menjadi satu kesatuan dan bagian yang tidak terpisahkan dari PKAJ KHUSUS 
                                       ini;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menerima hasil 
                                       penjualan Produk PERUSAHAAN dari AGEN;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menerima dari AGEN 
                                       hasil penagihan premi pertama sesuai dan berdasarkan perhitungan serta 
                                       ketentuan PERUSAHAAN yang berlaku, yaitu tidak lebih dari 1 x 24 jam 
                                       hari kerja baik diterima secara tunai dengan bukti kuitansi sah yang 
                                       dikeluarkan oleh PERUSAHAAN ataupun langsung melalui rekening yang telah 
                                       ditentukan oleh PERUSAHAAN dengan susulan bukti kuitansi sah;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menetapkan hak dan 
                                       kewajiban AGEN sesuai ketentuan Sistem Keagenan yang berlaku;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">g.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mengakhiri PKAJ KHUSUS 
                                       secara sepihak sesuai Pasal 10 ayat (1) huruf c dan d&nbsp; PKAJ KHUSUS ini;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">h.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       pengawasan terhadap pelaksanaan kewajiban-kewajiban AGEN ;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN 
                                       berkewajiban untuk :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Membayarkan hak 
                                       AGEN berdasarkan Sistem Keagenan yang berlaku;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan 
                                       informasi atau data&nbsp; atas penjualan yang telah dihasilkan oleh AGEN 
                                       berupa data evaluasi prestasi;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       pemotongan dari penghasilan yang diterima oleh AGEN atas beban pajak 
                                       yang ditetapkan undang-undang dan/atau sesuai ketentuan perpajakan yang 
                                       berlaku;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menyelenggarakan 
                                       pendidikan dan latihan fungsi pemasaran untuk AGEN;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menyediakan pusat 
                                       informasi yang memuat penjelasan-penjelasan tentang Fungsi Pemasaran 
                                       yang diperlukan AGEN;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menyediakan sarana 
                                       sumber daya kerja yang dapat mendukung AGEN dalam melaksanakan fungsi 
                                       pemasaran.</span></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">HAK DAN 
                                       KEWAJIBAN AGEN</span></b></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Selama 
                                       berlangsungnya PKAJ KHUSUS ini, AGEN berhak :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menerima hak-hak 
                                       AGEN sesuai dengan Sistem Keagenan yang berlaku;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mendapatkan 
                                       informasi dari PERUSAHAAN baik secara lisan maupun tertulis yang terkait 
                                       dengan hak dan kewajiban AGEN.</span></p>
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Selama 
                                       berlangsungnya PKAJ KHUSUS ini, AGEN berkewajiban:</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memiliki 
                                       sertifikasi dan lisensi Keagenan sebagaimana ditetapkan dalam peraturan 
                                       dan perundang-undangan yang berlaku;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mematuhi dan 
                                       melaksanakan ketentuan-ketentuan yang ditetapkan di dalam Sistem Keagenan 
                                       yang berlaku;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       perencanaan operasional;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan 
                                       penjelasan tentang Produk, Syarat-syarat Umum Polis Pertanggungan 
                                       Perorangan, Premi dan Penyelesaian Klaim serta ketentuan lainnya kepada 
                                       Calon Pemegang Polis/Calon Tertanggung;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mencatat data 
                                       prestasi dirinya pada kartu produksi dan menyimpannya;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melaporkan 
                                       hasil-hasil pekerjaannya kepada pejabat yang ditunjuk oleh PERUSAHAAN;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">g.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menjaga nama baik 
                                       PERUSAHAAN dengan tidak melakukan perbuatan-perbuatan yang dilarang 
                                       sebagaimana tercantum dalam Pasal 6 ayat (1) PKAJ KHUSUS ini;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">h.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan promosi 
                                       dan penjualan atau penutupan polis asuransi jiwa yang merupakan Produk 
                                       untuk kepentingan dan atas nama PERUSAHAAN;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">i.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       prospekting yaitu mencari, mengumpulkan, mencatat nama beserta data-data 
                                       Calon Pemegang Polis/Calon Tertanggung;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">j.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan layanan 
                                       purna jual kepada Pemegang Polis;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">k.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       kunjungan penjualan kepada Calon Pemegang Polis serta melaporkan hasil 
                                       kunjungannya tersebut dengan menggunakan blanko laporan kunjungan yang 
                                       ditandatangani oleh Calon Pemegang Polis;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">l.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mencapai target 
                                       yang ditetapkan oleh PERUSAHAAN sebagaimana tercantum dalam lampiran 
                                       PKAJ KHUSUS ini;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">m.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan field 
                                       underwriting&nbsp; terhadap Calon Pemegang Polis/Calon Tertanggung;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">n.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Membantu Calon 
                                       Pemegang Polis/Calon Tertanggung dalam proses pengajuan permintaan/penutupan 
                                       program asuransi jiwa yang dipilihnya;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">o.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan dokumen 
                                       pendukung asli yang disertakan dalam form aplikasi (Surat Permintaan 
                                       Asuransi Jiwa dan Surat Keterangan Kesehatan) calon Pemegang Polis/ 
                                       calon Tertanggung atau bilamana dalam bentuk fotokopi maka fotokopi 
                                       tersebut memuat data-data yang sama dengan dokumen aslinya, dan 
                                       tanda-tangan yang tertera dalam form aplikasi dan dokumen-dokumen 
                                       tersebut merupakan tanda-tangan asli dari masing-masing pihak yang 
                                       berwenang;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">p.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menyerahkan Surat 
                                       Permintaan Asuransi Jiwa dan Surat Keterangan Kesehatan bila diperlukan, 
                                       yang telah diisi dan ditandatangani oleh Calon Pemegang Polis/Calon 
                                       Tertanggung berikut bukti pelunasan premi yang sah kepada PERUSAHAAN;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">q.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menyetorkan kepada 
                                       PERUSAHAAN hasil penagihan premi pertama sesuai dan berdasarkan 
                                       perhitungan serta ketentuan PERUSAHAAN yang berlaku, yaitu tidak lebih 
                                       dari 1 x 24 jam hari kerja baik diterima secara tunai dengan bukti 
                                       kuitansi sah yang dikeluarkan oleh PERUSAHAAN ataupun langsung melalui 
                                       rekening yang telah ditentukan oleh PERUSAHAAN dengan susulan bukti 
                                       kuitansi sah;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">r.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menyerahkan Polis 
                                       kepada Pemegang Polis, dan mengembalikan kepada PERUSAHAAN tanda terima 
                                       polis yang telah ditandatangani sendiri oleh Pemegang Polis. AGEN harus 
                                       dapat membuktikan bahwa surat tanda terima polis telah ditanda-tangani 
                                       oleh Pemegang Polis;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">s.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Tunduk dan patuh 
                                       terhadap seluruh strategi, pedoman, ketentuan dan prosedur yang telah 
                                       ditetapkan oleh PERUSAHAAN dari waktu ke waktu sehubungan dengan kinerja 
                                       AGEN; &nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">t.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Tunduk dan patuh 
                                       terhadap Sistem Keagenan, Kode Etik Keagenan dan peraturan Asosiasi 
                                       Asuransi Jiwa Indonesia (AAJI);</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">u.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Berpartisipasi 
                                       dalam setiap pelatihan, sosialisasi produk dan program-program kepatuhan 
                                       (baik diadakan oleh PERUSAHAAN maupun pihak lain) yang ditetapkan oleh 
                                       PERUSAHAAN;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">v.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mempertahankan dan 
                                       menjaga persistensi polis;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">w.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam memberikan 
                                       jasa harus dengan niat baik, jujur integritas; dengan memperhatikan 
                                       kepentingan semua pihak;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">x.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan 
                                       informasi yang jelas dan benar tentang Produk, Syarat-syarat Umum Polis 
                                       Pertanggungan Perorangan, premi dan ketentuan lainnya yang terkait 
                                       dengan Produk tersebut;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">y.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memelihara 
                                       hubungan baik antar sesama AGEN, karyawan dan antara Pemegang Polis/Tertanggung 
                                       dengan PERUSAHAAN;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">z.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mengumpulkan dan 
                                       memberikan seluruh informasi mengenai Pemegang Polis/ Tertanggung kepada 
                                       PERUSAHAAN, serta mempersiapkan dokumen dan laporan yang dibutuhkan 
                                       tidak terbatas pada dokumen-dokumen sehubungan dengan pengajuan atau 
                                       perubahan Polis dari Pemegang Polis/ Tertanggung;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">aa</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Tunduk dan patuh 
                                       terhadap seluruh peraturan perundang-undangan yang berlaku dan wajib 
                                       memastikan bahwa jasa dilakukan dalam cara-cara yang baik dan/atau tidak 
                                       melanggar peraturan dan perundang-undangan yang berlaku di Indonesia 
                                       ataupun menurut ketentuan PERUSAHAAN atau tidak merusak reputasi 
                                       PERUSAHAAN;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">bb</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mengembalikan 
                                       setiap komisi yang telah diperolehnya terkait dengan pengembalian premi 
                                       dari PERUSAHAAN kepada Pemegang Polis dengan alasan apapun;&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">cc</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Wajib untuk 
                                       mengganti segala kerugian yang diderita oleh PERUSAHAAN dan/atau 
                                       Pemegang Polis/Tertanggung sebagai akibat dari:&nbsp;</span></td>
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
                                       <span lang="IN" style="font-family: Arial,sans-serif">cc.1</span></td>
                                       <td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Kelalaian/kesalahan 
                                       AGEN dalam memenuhi kewajiban dan tanggung jawab AGEN sebagaimana 
                                       disebut dalam ayat ini; atau</span></td>
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
                                       <span lang="IN" style="font-family: Arial,sans-serif">cc.2</span></td>
                                       <td colspan="7" valign="top" style="width: 487px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Pelanggaran yang 
                                       dilakukan oleh AGEN baik disengaja ataupun tidak sebagai pelanggaran 
                                       sebagaimana&nbsp; yang disebutkan dalam Pasal 6 PKAJ KHUSUS ini;</span></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">TARGET AGEN</span></b></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam melaksanakan 
                                       kewajibannya menurut ketentuan Pasal <span style="color: blue">4</span> 
                                       ayat (2) PKAJ KHUSUS ini, AGEN diberikan target berupa;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Penerimaan Premi;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Pencapaian polis;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Persistensi polis; 
                                       dan</span></p>
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Target lain yang 
                                       ditetapkan oleh PERUSAHAAN,</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">dalam kurun waktu 
                                       satu tahun terhitung mulai Januari s/d Desember dalam setiap tahun 
                                       berjalan atau dalam kurun waktu tertentu yang ditetapkan oleh PERUSAHAAN.</span></p>
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Target AGEN 
                                       sebagaimana dimaksud dalam ayat (1) pasal ini ditetapkan PERUSAHAAN 
                                       dalam masing-masing Surat Penetapan Agen (SPA) dan dicantumkan dalam 
                                       Sistem Keagenan yang berlaku</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 6</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">L A R A N G A N</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Selama PKAJ KHUSUS ini 
                                       berlangsung, AGEN dilarang melakukan hal-hal sebagai berikut :</span></p>
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mengadakan 
                                       perjanjian dan/atau hubungan kerja Keagenan Asuransi baik langsung 
                                       maupun tidak langsung dengan perusahaan Asuransi yang lain</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       pelanggaran terhadap Kode Etik Keagenan Asuransi Jiwa</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan hal-hal 
                                       yang berada di luar kewenangannya sebagai AGEN</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">

                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan 
                                       penjelasan atau keterangan tentang program-program Asuransi Jiwa Produk, 
                                       Syarat-syarat Umum Polis Pertanggungan Perorangan, Premi dan 
                                       Penyelesaian Klaim, serta ketentuan-ketentuan lain yang menyimpang atau 
                                       bertentangan dengan ketentuan yang berlaku.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">e.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Merekomendasikan 
                                       Pemegang Polis untuk membatalkan polis yang bertentangan dengan 
                                       ketentuan dan atas dasar kepentingan AGEN pribadi.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">f.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Merekomendasikan 
                                       dan/atau mempunyai nama AGEN fiktif&nbsp; kepada PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">g.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Membebankan premi 
                                       tambahan, membebankan biaya tambahan atau memberikan potongan premi 
                                       dalam bentuk apapun juga kepada Pemegang Polis, kecuali yang disebutkan 
                                       dalam tarif premi yang berlaku atau atas ijin PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">h.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Membuat, 
                                       menggunakan, menandatangani dan mengeluarkan kuitansi atau alat tagih 
                                       dalam bentuk apapun juga selain kuitansi sah yang diterbitkan PERUSAHAAN 
                                       sebagai tanda terima pembayaran premi dari Pemegang Polis.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">i.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Mengadakan 
                                       perjanjian dalam bentuk apapun dan/atau memberikan janji-janji kepada 
                                       pihak ketiga yang mengikat PERUSAHAAN tanpa mendapat persetujuan 
                                       terlebih dahulu dari PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">j.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menahan dan/atau 
                                       tidak menyetorkan premi ke PERUSAHAAN melebihi ketentuan yang berlaku 
                                       untuk itu.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">k.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memalsukan polis 
                                       atau memberikan polis palsu dan/atau kuitansi penagihan premi palsu 
                                       kepada Pemegang Polis.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">l.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Memberikan 
                                       informasi mengenai strategi, kebijakan, program dan Produk kepada 
                                       perusahaan asuransi dan/atau pihak-pihak lain.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">m.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan 
                                       pemisahan/pemecahan polis menjadi beberapa polis, yang bertentangan 
                                       dengan ketentuan Perusahaan yang berlaku.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">n.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Melakukan segala 
                                       perbuatan yang merugikan PERUSAHAAN baik secara materiil maupun 
                                       immateriil.</span></p>
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Atas pelanggaran 
                                       terahadap ketentuan dimaksud pada ayat (1) pasal ini,&nbsp; AGEN menyatakan 
                                       bertanggungjawab sepenuhnya dan karenanya AGEN membebaskan PERUSAHAAN 
                                       dari segala tuntutan dalam bentuk apapun dari pihak lain,&nbsp; yang timbul 
                                       sebagai akibat dari pelanggaran dimaksud.</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">PASAL&nbsp;&nbsp; 7</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">PROMOSI, 
                                       PENANGGUHAN&nbsp; DAN DEGRADASI</span></b></td>
                                    </tr>
                                    <tr style="height: 12.75pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 12.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr style="height: 17.2pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Untuk keperluan 
                                       Promosi, Penangguhan dan Degradasi, PERUSAHAN akan mengadakan evaluasi 
                                       penilaian secara keseluruhan terhadap AGEN sebagaimana diatur dalam Sistem 
                                       Keagenan yang berlaku.</span></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">SANKSI</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Apabila AGEN 
                                       terbukti melakukan pelanggaran terhadap salah satu larangan dimaksud 
                                       dalam&nbsp; Pasal 6 ayat (1) PKAJ KHUSUS ini, maka sesuai dengan bobot 
                                       pelanggarannya PERUSAHAAN berhak menjatuhkan sanksi, berupa:</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Teguran lisan		</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Peringatan 
                                       Tertulis, </span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Degradasi,</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Pemutusan PKAJ KHUSUS</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Apabila 
                                       pelanggaran yang dilakukan oleh AGEN mengandung unsur-unsur tindak 
                                       pidana, maka selain sanksi dimaksud dalam ayat (1) pasal ini, PERUSAHAAN 
                                       dapat melaporkan AGEN kepada pihak yang berwajib untuk penyelesaian 
                                       melalui jalur hukum.</span></td>
                                    </tr>
                                    <tr>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">PEMUTUSAN 
                                       SEMENTARA PKAJ KHUSUS</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN dapat 
                                       melakukan Pemutusan Sementara hubungan kemitraan dalam hal AGEN sedang 
                                       menjalani pemeriksaan internal maupun eksternal akibat perbuatan AGEN 
                                       yang melanggar pasal Larangan dalam PKAJ KHUSUS atau ketentuan hukum yang 
                                       berlaku.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal AGEN 
                                       dikenai pemutusan sementara hubungan kemitraan, maka PERUSAHAAN akan 
                                       mengeluarkan surat pemutusan sementara hubungan kemitraan. </span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal AGEN 
                                       dikenai pemutusan sementara hubungan kemitraan, maka pembayaran 
                                       kompensasi dan remunerasi akan diatur dalam surat pemutusan sementara 
                                       hubungan kemitraan.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(3)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal AGEN 
                                       dinyatakan terbukti tidak bersalah maka PERUSAHAAN akan mencabut 
                                       pemutusan sementara PKAJ KHUSUS dan sebaliknya apabila terbukti bersalah maka 
                                       PERUSAHAAN berhak menjatuhkan sanksi sebagaimana Pasal 8 PKAJ KHUSUS.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(4)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Pemutusan 
                                       sementara yang ditetapkan dalam pasal ini tidak/bukan merupakan sanksi 
                                       sebagaimana dimaksud pada Pasal 8 PKAJ KHUSUS ini.</span></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">PEMUTUSAN 
                                       PERJANJIAN KEAGENAN</span></b></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Pemutusan PKAJ KHUSUS 
                                       dilakukan atas dasar :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Berakhirnya jangka waktu PKAJ KHUSUS dan tidak diperpanjang  oleh Para Pihak,</span></td>
                                    </tr>
                                    <tr>
                                    <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">&nbsp;</td>
                                    <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                    <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                    <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">AGEN mengundurkan diri, dimana permohonan AGEN tersebut harus diajukan secara tertulis dengan memperhatikan tenggang waktu sekurang-kurangnya 1 (satu) bulan sebelumnya,</span></td>
                                 </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">AGEN meninggal 
                                       dunia,</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">AGEN terbukti 
                                       melakukan hal-hal yang dilarang menurut Pasal 6 ayat (1) Perjanjian ini,</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">d.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">AGEN tidak 
                                       memenuhi target minimal yang ditetapkan oleh PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal pemutusan PKAJ KHUSUS dilakukan karena AGEN mengundurkan diri atau karena AGEN tidak memenuhi target minimal, maka PERUSAHAAN akan :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menerbitkan Surat 
                                       tentang pemutusan/pengakhiran PKAJ KHUSUS dan</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Membayarkan hak 
                                       AGEN sesuai dengan Sistem Keagenan yang berlaku dan akan diperhitungkan 
                                       dengan kewajibannya terhadap PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(3)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal AGEN 
                                       meninggal dunia maka secara serta merta dan dengan sendirinya PKAJ KHUSUS 
                                       menjadi berakhir, dan PERUSAHAAN akan :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menerbitkan Surat 
                                       tentang pemutusan/pengakhiran PKAJ KHUSUS yang akan diberikan kepada ahli waris 
                                       yang sah dan</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Membayarkan hak 
                                       AGEN sesuai dengan Sistem Keagenan yang berlaku dan akan diperhitungkan 
                                       dengan kewajibannya terhadap PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(4)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam pemutusan 
                                       PKAJ KHUSUS dilakukan atas dasar AGEN terbukti melakukan hal-hal yang dilarang 
                                       menurut Pasal 6 ayat (1) PKAJ KHUSUS ini dan merugikan PERUSAHAAN, maka 
                                       PERUSAHAAN :</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">a.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menerbitkan surat 
                                       pemutusan/pengakhiran PKAJ KHUSUS, dan</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">b.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Menghentikan semua 
                                       pembayaran hak AGEN atau atas kebijaksanaan PERUSAHAAN semata, tetap 
                                       memperhitungkan hak-hak AGEN dengan kewajiban yang masih ada di 
                                       PERUSAHAAN dengan memperhatikan bobot pelanggarannya, dan,</span></td>
                                    </tr>
                                    <tr>
                                       <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td colspan="2" valign="top" style="width: 20px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">c.</span></td>
                                       <td colspan="8" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Berhak melaporkan 
                                       AGEN kepada yang berwajib untuk diproses secara hukum.</span></td>
                                    </tr>
                                    <tr style="height: 3.5pt">
                                       <td valign="top" style="width: 15px; height: 3.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(5)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; height: 3.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Apabila PERUSAHAAN bermaksud untuk memutuskan PKAJ KHUSUS ini diluar sebab-sebab yang tercantum pada pasal ini, maka PERUSAHAAN akan memberitahukan secara tertulis kepada AGEN tentang maksud pemutusan tersebut dan serta merta PKAJ KHUSUS menjadi berakhir.</span></td>
                                    </tr>
                                    <tr style="height: 3.5pt">
                                       <td valign="top" style="width: 15px; height: 3.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(6)</span></td>
                                       <td colspan="10" valign="top" style="width: 572px; height: 3.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-right: -5.4pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal terjadi 
                                       pemutusan/pengakhiran PKAJ KHUSUS ini sebagaimana dimaksud pada ayat (1) pasal 
                                       ini PARA PIHAK sepakat meniadakan berlakunya Pasal 1266 Kitab 
                                       Undang-undang Hukum Perdata.</span></td>
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
                                       PENYELESAIAN PERSELISIHAN</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Apabila terjadi 
                                       perselisihan dalam pelaksanaan PKAJ KHUSUS ini, PARA PIHAK sepakat&nbsp; 
                                       menyelesaikan secara musyawarah untuk mencapai mufakat, namun dalam hal&nbsp; 
                                       tidak tercapai permufakatan dalam musyawarah tersebut, maka PARA PIHAK 
                                       sepakat menyerahkan perselisihan tersebut melalui pengadilan dan untuk 
                                       itu PARA PIHAK sepakat memilih tempat kediaman/domisili hukum yang umum 
                                       dan tetap di kantor Kepaniteraan Pengadilan Negeri Jakarta Pusat.</span></td>
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
                                       LAMPIRAN</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <b><span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Lampiran-lampiran 
                                       PKAJ KHUSUS tersebut dibawah ini merupakan bagian yang tidak terpisahkan dalam 
                                       PKAJ KHUSUS ini :</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="567" style="border-collapse: collapse; margin-left: 5.4pt">
                                          <tr style="height: 14.75pt">
                                             <td valign="top" style="width: 24px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <a name="_Hlk197755084">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             a.</span></a></td>
                                             <td valign="top" style="width: 126px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             Lampiran 1</span></td>
                                             <td valign="top" style="width: 5px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             :</span></td>
                                             <td valign="top" style="width: 358px; height: 14.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             Surat Penetapan Agen (SPA)</span></td>
                                          </tr>
                                          <tr>
                                             <td valign="top" style="width: 24px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             b.</span></td>
                                             <td valign="top" style="width: 126px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             Lampiran 2</span></td>
                                             <td valign="top" style="width: 5px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             :</span></td>
                                             <td valign="top" style="width: 358px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                             <p class="MsoBodyTextIndent2" style="line-height: normal; margin-left: 0in; margin-right: 0in; margin-top: 0in; margin-bottom: .0001pt">
                                             <span lang="IN" style="font-family: Arial,sans-serif; color: black">
                                             Kode Etik Keagenan</span></td>
                                          </tr>
                                       </table>
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"></td>
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
                                       <b><span lang="IN" style="font-family: Arial,sans-serif">KETENTUAN 
                                       PENUTUP</span></b></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(1)</span></td>
                                       <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">PKAJ KHUSUS ini mulai berlaku untuk jangka waktu 2 (dua) tahun sejak tanggal ditandatanganinya PKAJ KHUSUS ini sebagaimana tersebut diatas atau berakhir setelah pemutusan/pengakhiran PKAJ KHUSUS ini berdasarkan ketentuan-ketentuan sebagaimana ditetapkan dalam Pasal 10 PKAJ KHUSUS ini atau jangka waktu tertentu sebagaimana ditetapkan oleh PERUSAHAAN.</span></td>
                                    </tr>
                                    <tr>
                                       <td width="39" colspan="2" valign="top" style="width: 29.25pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">(2)</span></td>
                                       <td width="576" colspan="9" valign="top" style="width: 432.15pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">Dalam hal terdapat 
                                       perubahan terhadap PKAJ KHUSUS ini akan diatur tersendiri dalam bentuk addendum 
                                       atau instrument tertulis lainnya yang disepakati PARA PIHAK dan menjadi 
                                       bagian yang tidak terpisahkan dari PKAJ KHUSUS ini.</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt"></td>
                                    </tr>
                                    <tr>
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr style="height: 23.0pt">
                                       <td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">PERUSAHAAN</span></td>
                                       <td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td width="205" valign="top" style="width: 153.8pt; height: 23.0pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">AGEN</span></td>
                                    </tr> 
                                    <tr style="height: 17.75pt">
                                       <td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">		
                                       <img src="<?php echo base_url('asset/images_qrcode/'.$row["KANCAB_QRCODE"].''); ?>" />
                                       <br>
                                       <?=$row["NAMABM"];?></span></td>
                                       <td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td width="205" valign="top" style="width: 153.8pt; height: 17.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">		
                                       <img src="<?php echo base_url('asset/images_qrcode/'.$row["AGEN_QRCODE"].''); ?>" />
                                       <br>
                                       <?=$row["NAMAKLIEN1"];?></span></td>
                                    </tr>
                                    <tr style="height: 17.55pt">
                                       <td width="205" colspan="7" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif"><?=$row["JABATANBM"];?></span></td>
                                       <td width="205" colspan="3" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                       <td width="205" valign="top" style="width: 153.8pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">AGEN</span></td>
                                    </tr>
                                    <tr style="height: 17.55pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                       <p class="MsoNormal" align="center" style="text-align: center; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
                                       <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>
                                    </tr>
                                    <tr style="height: 17.55pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                        <p style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">Catatan : </br> </p>
                                        <p style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black"> 
						Dokumen Elektronik ini dinyatakan sah walaupun tanpa tanda tangan basah dari Para Pihak. Validasi terhadap data dalam Dokumen Elektronik ini dapat dilakukan melalui URL pada QR Qode yang tercetak.
						Sesuai nama yang tercantum di bawahnya sebagai Para Pihak yang menyetujui atas PKAJ ini. </br> </p>
                                        <p>&nbsp;</p>
                                        <span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></td>       
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

