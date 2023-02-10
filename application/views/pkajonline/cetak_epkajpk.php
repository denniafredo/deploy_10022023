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

                                    </tr>
                                    <tr>
                                      <td><p class="MsoNormal2" align="center" style="text-align: center"><b><span lang="FI" style="font-family: Arial,sans-serif; color: black">PERJANJIAN KEAGENAN ASURANSI JIWA </span></b></p>
                                        <p class="MsoNormal2" align="center" style="text-align: center"><b> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> NOMOR :
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
                                        </span></b></p>
                                        <p class="MsoNormal2" align="center" style="text-align: center"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> </span></p>
                                        <p class="MsoNormal2" align="center" style="text-align: center"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal2" align="center" style="text-align: center"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
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
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: medium none">
                                          <tr style="height: 25.75pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif">I</span><span lang="IN" style="font-family: Arial,sans-serif; color: black">.</span></td>
                                            <td width="140" valign="top" style="width: 105.1pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black"> Nama&nbsp;&nbsp;&nbsp; </span></p>
                                                <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">No.Induk Pegawai/Agen</span></p>
                                              <!--<p align="left" class="MsoNormal" style="text-align: justify">
                                <span style="font-family: Arial,sans-serif; color: black">
                                No.Induk Agen </span></p>-->
                                                <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black"> Jabatan</span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Alamat 
                                                Kantor</span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Nomor 
                                                Telepon</span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Nomor 
                                                Faximile</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                                <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></td>
                                            <td width="454" valign="top" style="width: 340.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">
                                              <?=$row["NAMABM"];?>
                                            </span></p>
                                                <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">
                                                  <? if (strlen($row["NIPBM"])<2){ echo $row["NOAGENBM"];} else{echo $row["NIPBM"];}?>
                                                </span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify">
                                                  <!--<span style="font-family: Arial,sans-serif; color: black"><?=$row["NOAGENBM"];?></span></p>               
                                <p align="left" class="MsoNormal" style="text-align: justify">-->
                                                  <span style="font-family: Arial,sans-serif; color: black">
                                                    <?=$row["JABATANBM"];?>
                                                  </span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["ALAMATKTR"];?>
                                              </span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["TELPONKTR"];?>
                                              </span></p>
                                              <p align="left" class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["FAXKTR"];?>
                                              </span></p></td>
                                          </tr>
                                        </table>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">yang 
                                          dalam perbuatan hukum ini bertindak dalam jabatannya tersebut untuk dan 
                                          atas nama dan karenanya sah mewakili Direksi :</span></p>
                                        <p class="MsoNormal2" style="text-align: justify">&nbsp;</p>
                                        <table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: medium none">
                                          <tr style="height: 25.75pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"></td>
                                            <td width="140" valign="top" style="width: 105.1pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Nama 
                                              Perusahaan</span></p>
                                                <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Alamat 
                                                  Kantor Pusat</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Nomor 
                                                Telepon</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">Nomor 
                                                Faximil</span><span lang="FI" style="font-family: Arial,sans-serif; color: black">e</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                                <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></td>
                                            <td width="454" valign="top" style="width: 340.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">PT ASURANSI JIWASRAYA (PERSERO)</span></p>
                                                <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">JL. IR. H. JUANDA NO.34 JAKARTA</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">021-3845031</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">021-3862344</span></p></td>
                                          </tr>
                                        </table>
                                        <p class="MsoNormal2" style="text-align: justify">&nbsp;</p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">yang 
                                          selanjutnya disebut &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> -------------------------------------------------------------- <b>PERUSAHAAN</b>&nbsp; 
                                          --------------------------------------------------------------</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <table class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: medium none">
                                          <tr style="height: 25.75pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif">I</span><span lang="IN" style="font-family: Arial,sans-serif; color: black">I.</span></td>
                                            <td width="140" valign="top" style="width: 105.1pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Nama (sesuai KTP)&nbsp;</span></p>
                                                <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Nomor Agen</span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Tempat/Tgl Lahir</span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Jenis Kelamin</span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Alamat (sesuai KTP)</span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Nomor KTP/SIM</span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> Nomor Telp. Rumah/Hp</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                                <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></p>
                                              <p class="MsoNormal2" style="text-align: justify"> <span style="font-family: Arial,sans-serif; color: black">:</span></td>
                                            <td width="454" valign="top" style="width: 340.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                              <?=$row["NAMAKLIEN1"];?>
                                            </span></p>
                                                <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                                  <?=$row["NOAGEN"];?>
                                                </span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["TEMPATLAHIR"];?>
                                                ,
                                                <?=$row["TGLLAHIR"];?>
                                              </span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["JENISKELAMIN"];?>
                                              </span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["ALAMATAGEN"];?>
                                              </span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["NOMORIDAGEN"];?>
                                              </span></p>
                                              <p class="MsoNormal2" style="text-align: justify; text-indent: -.25in; margin-left: .25in"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">
                                                <?=$row["NOTELPONAGEN"];?>
                                              </span></p></td>
                                          </tr>
                                        </table>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">yang 
                                          dalam hal ini bertindak untuk dan atas nama diri sendiri, yang 
                                          selanjutnya disebut :</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> ------------------------------------------------------------------------ <b>AGEN</b>&nbsp; 
                                          ------------------------------------------------------------------------</span></p>
                                        <p class="MsoNormal2" style="text-align: justify; margin-top: 6.0pt"> <span lang="FI" style="font-family: Arial,sans-serif; color: black"> sebagaimana dimaksud dalam Undang-Undang Nomor 2 tahun 1992 tentang 
                                          Usaha Perasuransian, aturan-aturan pelaksanaannya serta 
                                          perubahan-perubahannya yang dilakukan dari waktu ke waktu dan berada 
                                          pada saluran distribusi Branch Office System (BOS) PERUSAHAAN, </span> </p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="FI" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="ES" style="font-family: Arial,sans-serif; color: black"> PERUSAHAAN dan AGEN secara bersama-sama selanjutnya disebut PARA PIHAK.</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="ES" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal2" style="text-align: justify"> <span lang="ES" style="font-family: Arial,sans-serif; color: black">PARA 
                                          PIHAK telah bersepakat untuk mengadakan Perjanjian Keagenan Asuransi 
                                          Jiwa yang selanjutnya disebut &ldquo;PKAJ&rdquo;, di mana PERUSAHAAN menetapkan dan 
                                          menunjuk AGEN sebagaimana AGEN menerima dan menyetujui penetapan dan 
                                          penunjukan tersebut untuk memberikan jasa dalam memasarkan produk 
                                          asuransi milik PERUSAHAAN untuk dan atas nama PERUSAHAAN, berdasarkan 
                                          syarat-syarat dan ketentuan-ketentuan sebagaimana diatur dalam 
                                      pasal-pasal di bawah ini :</span></p>
                                        <p class="MsoNormal2" style="text-align: justify">&nbsp;</p>
                                        <p class="MsoNormal3" align="center" style="text-align: center"><b><span lang="IN" style="font-family: Arial,sans-serif; color: black">PASAL&nbsp;&nbsp; 1</span></b></p>
                                        <p class="MsoNormal3" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black">ARTI 
                                          DARI BEBERAPA ISTILAH</span></b></p>
                                        <p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">Di 
                                          dalam PKAJ ini yang dimaksud dengan : </span></p>
                                        <p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <table width="829" class="MsoTableGrid" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: medium none">
                                          <tr style="height: 25.75pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 1.</span></td>
                                            <td width="286" valign="top" style="width: 205.1pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> PKAJ</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 25.75pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p align="justify" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah Perjanjian Keagenan Asuransi Jiwa ini, berikut 
                                              lampiran-lampiran dan perubahan-perubahannya termasuk Sistem 
                                              Keagenan yang berlaku;</span></td>
                                          </tr>
                                          <tr>
                                            <td width="37" valign="top" style="width: 27.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 2.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Sistem Keagenan </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Adalah ketentuan yang mengatur hak dan kewajiban PERUSAHAAN dan 
                                              AGEN yang ditetapkan oleh PERUSAHAAN termasuk ketentuan 
                                              pelaksanaannya berikut perubahan-perubahannya yang ditetapkan 
                                              dari waktu ke waktu yang memuat hak dan kewajiban antara 
                                              PERUSAHAAN dengan AGEN sebagai mitra kerja dan bukan merupakan 
                                              syarat-syarat dan ketentuan dalam hubungan ketenagakerjaan;</span></td>
                                          </tr>
                                          <tr style="height: 50.05pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 50.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 3.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 50.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Jabatan </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 50.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 50.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah posisi atau kedudukan AGEN yang ditetapkan dalam Surat 
                                              Penetapan Agen (SPA) berdasarkan struktur Organisasi Keagenan 
                                              Branch Office System yang berlaku sebagaimana ditetapkan oleh 
                                              PERUSAHAAN dari waktu ke waktu;</span></td>
                                          </tr>
                                          <tr style="height: 49.35pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 49.35pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 4.</span></td>
                                            <td width="286" valign="top" style="width: 205.1pt; height: 49.35pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Branch Office System (BOS)</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 49.35pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 49.35pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah saluran distribusi penjualan yang secara administratif 
                                              dan biayanya dikelola oleh PERUSAHAAN serta mempunyai hirarki 
                                              struktur organisasi keagenan termasuk hak dan kewajiban AGEN 
                                              ditentukan PERUSAHAAN berdasarkan Sistem Keagenan yang berlaku, </span></td>
                                          </tr>
                                          <tr style="height: 49.3pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 49.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 5.</span></td>
                                            <td width="286" valign="top" style="width: 205.1pt; height: 49.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Surat Penetapan Agen (SPA)</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 49.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 49.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah surat yang dikeluarkan oleh PERUSAHAAN yang memuat 
                                              tentang penunjukkan sebagai AGEN yang berisikan dan/atau memuat 
                                              nomor AGEN, nama AGEN, Jabatan, wilayah penjualan, target AGEN 
                                              dan/atau hal-hal lain yang berkaitan dengan administrasi 
                                              Keagenan.</span></td>
                                          </tr>
                                          <tr style="height: 28.65pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 28.65pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 7.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 28.65pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Promosi </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 28.65pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 340.2pt; height: 28.65pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah kenaikan Jabatan AGEN lebih tinggi dibandingkan Jabatan 
                                              sebelumnya;</span></td>
                                          </tr>
                                          <tr style="height: 29.9pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 29.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 8.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 29.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Degradasi </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 29.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 340.2pt; height: 29.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah penurunan Jabatan AGEN lebih rendah dibandingkan Jabatan 
                                              sebelumnya;</span></td>
                                          </tr>
                                          <tr style="height: 17.3pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 17.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 9.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 17.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Penangguhan </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 17.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 340.2pt; height: 17.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah penundaan kenaikan Jabatan AGEN;</span></p>
                                                <p class="MsoNormal3" style="text-align: justify; line-height: 7.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> &nbsp;</span></td>
                                          </tr>
                                          <tr style="height: 36.95pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 36.95pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 10.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 36.95pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Produk </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 36.95pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 36.95pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah produk-produk PERUSAHAAN yang meliputi jasa Asuransi Jiwa 
                                              dan/atau pertanggungan risiko atau Produk yang 
                                              berafiliasi/beraliansi dengan perusahaan lain;</span></p>
                                                <p class="MsoNormal3" style="text-align: justify; line-height: 7.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> &nbsp;</span></td>
                                          </tr>
                                          <tr style="height: 45.3pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 45.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 11.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 45.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Fungsi Pemasaran </span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 45.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 45.3pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah fungsi untuk memasarkan, menjual, memberikan penjelasan 
                                              kepada calon Pemegang Polis dan melakukan hal-hal yang dianggap 
                                              perlu dalam memasarkan produk,&nbsp; yang harus dilakukan oleh AGEN 
                                              berdasarkan PKAJ;</span></td>
                                          </tr>
                                          <tr>
                                            <td width="37" valign="top" style="width: 27.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 12.</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Field Underwriting</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="587" valign="top" style="width: 440.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah melakukan verifikasi terhadap kebenaran,&nbsp; kelengkapan dan 
                                              akurasi data-data/informasi tentang Calon Pemegang Polis 
                                              sebagaimana tertera atau terlampir pada form aplikasi (Surat 
                                              Permintaan Asuransi Jiwa dan Surat Keterangan Kesehatan) Calon 
                                              Pemegang Polis yang bersangkutan;</span></td>
                                          </tr>
                                          <tr style="height: 48.2pt">
                                            <td width="37" valign="top" style="width: 27.9pt; height: 48.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> 13</span></td>
                                            <td width="286" valign="top" style="width: 105.1pt; height: 48.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Kode Etik Keagenan</span></p>
                                                <p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> &nbsp;</span></td>
                                            <td width="19" valign="top" style="width: 14.2pt; height: 48.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> :</span></b></td>
                                            <td width="587" valign="top" style="width: 440.2pt; height: 48.2pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoNormal3" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> adalah ketentuan yang ditetapkan dari waktu ke waktu oleh 
                                              Asosiasi Asuransi Jiwa Indonesia yang mengatur tata-cara, 
                                              perilaku, larangan dan sanksi kepada Agen Asuransi Jiwa 
                                              Indonesia termasuk kepada AGEN berdasarkan PKAJ ini.</span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoNormal2" style="text-align: justify">&nbsp;</p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b><span lang="IN" style="font-family: Arial,sans-serif; color: black">PASAL&nbsp; 2</span></b></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> HUBUNGAN HUKUM</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="line-height: 10.0pt; margin-left: 14.2pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal4" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> Hubungan hukum antara PERUSAHAAN dengan AGEN menurut PKAJ ini&nbsp; adalah 
                                          hubungan antar mitra kerja dan karenanya bukan merupakan hubungan hukum 
                                          antara pengusaha dan pekerja sekaligus tidak ada satupun dari syarat dan 
                                          ketentuan yang berlaku dalam PKAJ ini dapat diartikan atau ditafsirkan 
                                          sebagai suatu hubungan ketenagakerjaan sebagaimana dimaksud dan diatur 
                                          dalam perundangan tentang &nbsp;Ketenagakerjaan yang berlaku.</span></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> PASAL&nbsp;&nbsp; 3</span></b></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black">HAK 
                                          DAN KEWAJIBAN PERUSAHAAN</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="line-height: 10.0pt; margin-left: 14.2pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">(1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Selama berlangsungnya PKAJ ini, PERUSAHAAN berhak untuk :</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menetapkan secara periodik Sistem Keagenan dan atau mengubahnya dari waktu 
                                              ke waktu jika diperlukan.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menunjuk dan memberi wewenang serta menetapkan penempatan AGEN untuk 
                                              memasarkan Produk di wilayah operasional &nbsp;PERUSAHAAN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menetapkan Jabatan AGEN berdasarkan penilaian PERUSAHAAN, dengan suatu 
                                              penetapan tersendiri yang menjadi satu kesatuan dan bagian yang tidak 
                                              terpisahkan dari PKAJ ini</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Menerima hasil penjualan Produk PERUSAHAAN dari AGEN;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">e.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menerima dari AGEN hasil penagihan premi pertama sesuai dan berdasarkan 
                                              perhitungan serta ketentuan PERUSAHAAN yang berlaku, yaitu tidak lebih 
                                              dari 1 x 24 jam hari kerja baik diterima secara tunai dengan bukti 
                                              kuitansi sah yang dikeluarkan oleh PERUSAHAAN ataupun langsung melalui 
                                              rekening yang telah ditentukan oleh PERUSAHAAN dengan susulan bukti 
                                              kuitansi </span>sah;</div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">f.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Menetapkan hak dan kewajiban AGEN sesuai ketentuan Sistem Keagenan yang 
                                              berlak</span>u;</div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">g.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mengakhiri PKAJ secara sepihak sesuai Pasal 10 ayat (1) huruf c dan d &nbsp;PKAJ 
                                              ini;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">h.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan pengawasan terhadap pelaksanaan kewajiban-kewajiban AGEN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -.25in; margin-left: 45.0pt; margin-right: 0in; margin-top: 4.0pt; margin-bottom: .0001pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="line-height: 8.0pt; margin-left: 26.95pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -1.0in; margin-left: 1.0in; margin-right: 0in; margin-top: 4.0pt; margin-bottom: .0001pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>PERUSAHAAN berkewajiban untuk :</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Membayarkan hak AGEN berdasarkan Sistem Keagenan yang berlaku</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memberikan informasi atau data&nbsp; atas penjualan yang telah 
                                              dihasilkan oleh AGEN berupa data evaluasi prestasi;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan pemotongan dari penghasilan yang diterima oleh AGEN 
                                              atas beban pajak yang ditetapkan undang-undang dan/atau sesuai ketentuan 
                                              perpajakan yang berlaku;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyelenggarakan pendidikan dan latihan fungsi pemasaran untuk 
                                              AGEN;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">e.</span></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyediakan pusat informasi yang memuat penjelasan-penjelasan 
                                              tentang Fungsi Pemasaran yang diperlukan AGEN;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">f.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyediakan sarana sumber daya kerja yang dapat mendukung AGEN 
                                              dalam melaksanakan fungsi pemasaran.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -1.0in; margin-left: 1.0in; margin-right: 0in; margin-top: 4.0pt; margin-bottom: .0001pt">&nbsp;</p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></b></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> PASAL&nbsp;&nbsp; 4</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 14.2pt"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> HAK DAN KEWAJIBAN AGEN</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="line-height: 10.0pt; margin-left: 14.2pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -17.85pt; margin-left: 17.85pt"> <span lang="IN" style="font-size: 10.0pt; font-family: 'Arial Unicode MS',sans-serif; color: black"> (1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp; </span></span> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Selama berlangsungnya PKAJ ini, AGEN berhak :</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menerima hak-hak AGEN sesuai dengan Sistem Keagenan yang berlaku;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mendapatkan informasi dari PERUSAHAAN baik secara lisan maupun 
                                              tertulis yang terkait dengan hak dan kewajiban AGEN</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -17.85pt; margin-left: 17.85pt"><span lang="IN" style="font-size: 10.0pt; font-family: 'Arial Unicode MS',sans-serif; color: black">(2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp; </span></span> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Selama berlangsungnya PKAJ ini, AGEN berkewajiban: </span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -17.85pt; margin-left: 17.85pt">&nbsp;</p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="26" valign="top"><div align="justify"></div></td>
                                            <td width="31" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memiliki sertifikasi dan lisensi Keagenan sebagaimana ditetapkan 
                                              dalam peraturan dan perundang-undangan yang berlak</span><span class="style1">u;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mematuhi dan melaksanakan ketentuan-ketentuan yang ditetapkan di 
                                              dalam Sistem Keagenan yang berlaku;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan perencanaan operasional;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memberikan penjelasan tentang Produk, Syarat-syarat Umum Polis 
                                              Pertanggungan Kumpulan, Premi dan Penyelesaian Klaim serta ketentuan 
                                              lainnya kepada Calon Pemegang Polis/Calon Tertanggung;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">e.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mencatat data prestasi dirinya pada kartu produksi dan 
                                              menyimpannya;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">f.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyediakan sarana sumber daya kerja yang dapat mendukung AGEN 
                                              dalam melaksanakan fungsi pemasaran.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">g.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menjaga nama baik PERUSAHAAN dengan tidak melakukan 
                                              perbuatan-perbuatan yang dilarang sebagaimana tercantum dalam Pasal 6 
                                              ayat (1) PKAJ ini</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">h.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan promosi dan penjualan atau penutupan polis asuransi 
                                              jiwa yang merupakan Produk untuk kepentingan dan atas nama PERUSAHAAN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">i.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan prospekting yaitu mencari, mengumpulkan, mencatat nama 
                                              beserta data-data Calon Pemegang Polis/Calon Tertanggung</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">j.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memberikan layanan purna jual kepada Pemegang Polis</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">k.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan kunjungan penjualan kepada Calon Pemegang Polis serta 
                                              melaporkan hasil kunjungannya tersebut dengan menggunakan blanko laporan 
                                              kunjungan yang ditandatangani oleh Calon Pemegang Polis</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">l.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mencapai target yang ditetapkan oleh PERUSAHAAN sebagaimana 
                                              tercantum dalam lampiran PKAJ in</span><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">i</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">m.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan field underwriting&nbsp; terhadap Calon Pemegang Polis/Calon 
                                              Tertanggung</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span class="style1">n.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Membantu Calon Pemegang Polis/Calon Tertanggung dalam proses 
                                              pengajuan permintaan/penutupan program asuransi jiwa yang dipilihnya</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">o.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"><span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman"> </span>Memberikan dokumen pendukung asli yang disertakan dalam form 
                                              aplikasi (Surat Permintaan Asuransi Jiwa dan Surat Keterangan Kesehatan) 
                                              calon Pemegang Polis/ calon Tertanggung atau bilamana dalam bentuk 
                                              fotokopi maka fotokopi tersebut memuat data-data yang sama dengan 
                                              dokumen aslinya, dan tanda-tangan yang tertera dalam form aplikasi dan 
                                              dokumen-dokumen tersebut merupakan tanda-tangan asli dari masing-masing 
                                              pihak yang berwenang</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">p.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyerahkan Surat Permintaan Asuransi Jiwa dan Surat Keterangan 
                                              Kesehatan bila diperlukan, yang telah diisi dan ditandatangani oleh 
                                              Calon Pemegang Polis/Calon Tertanggung berikut bukti pelunasan premi 
                                              yang sah kepada PERUSAHAAN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">q.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyetorkan kepada PERUSAHAAN hasil penagihan premi pertama 
                                              sesuai dan berdasarkan perhitungan serta ketentuan PERUSAHAAN yang 
                                              berlaku, yaitu tidak lebih dari 1 x 24 jam hari kerja baik diterima 
                                              secara tunai dengan bukti kuitansi sah yang dikeluarkan oleh PERUSAHAAN 
                                              ataupun langsung melalui rekening yang telah ditentukan oleh PERUSAHAAN 
                                              dengan susulan bukti kuitansi sah</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">r.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menyerahkan Polis kepada Pemegang Polis, dan mengembalikan kepada 
                                              PERUSAHAAN tanda terima polis yang telah ditandatangani sendiri oleh 
                                              Pemegang Polis. AGEN harus dapat membuktikan bahwa surat tanda terima 
                                              polis telah ditanda-tangani oleh Pemegang Poli</span>s;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">s.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Tunduk dan patuh terhadap seluruh strategi, pedoman, ketentuan 
                                              dan prosedur yang telah ditetapkan oleh PERUSAHAAN dari waktu ke waktu 
                                              sehubungan dengan kinerja AGEN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">t.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Tunduk dan patuh terhadap Sistem Keagenan, Kode Etik Keagenan dan 
                                              peraturan Asosiasi Asuransi Jiwa Indonesia (AAJI)</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">u.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Berpartisipasi dalam setiap pelatihan, sosialisasi produk dan 
                                              program-program kepatuhan (baik diadakan oleh PERUSAHAAN maupun pihak 
                                              lain) yang ditetapkan oleh PERUSAHAAN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">v.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mempertahankan dan menjaga persistensi polis</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">w.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Dalam memberikan jasa harus dengan niat baik, jujur integritas; 
                                              dengan memperhatikan kepentingan semua pihak</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">x.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"><span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman"></span>Memberikan informasi yang jelas dan benar tentang Produk, 
                                              Syarat-syarat Umum Polis Pertanggungan Kumpulan, premi dan ketentuan 
                                              lainnya yang terkait dengan Produk tersebut</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">y.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"><span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman"> </span>Memelihara hubungan baik antar sesama AGEN, karyawan dan antara 
                                              Pemegang Polis/Tertanggung dengan PERUSAHAAN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">z.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mengumpulkan dan memberikan seluruh informasi mengenai Pemegang 
                                              Polis/ Tertanggung kepada PERUSAHAAN, serta mempersiapkan dokumen dan 
                                              laporan yang dibutuhkan tidak terbatas pada dokumen-dokumen sehubungan 
                                              dengan pengajuan atau perubahan Polis dari Pemegang Polis/ Tertanggung</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">aa.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Tunduk dan patuh terhadap seluruh peraturan perundang-undangan 
                                              yang berlaku dan wajib memastikan bahwa jasa dilakukan dalam cara-cara 
                                              yang baik dan/atau tidak melanggar peraturan dan perundang-undangan yang 
                                              berlaku di Indonesia ataupun menurut ketentuan PERUSAHAAN atau tidak 
                                              merusak reputasi PERUSAHAAN</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">bb.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mengembalikan setiap komisi yang telah diperolehnya terkait 
                                              dengan pengembalian premi dari PERUSAHAAN kepada Pemegang Polis dengan 
                                              alasan apapun</span>;</div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">cc.</span></div></td>
                                            <td colspan="2" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Wajib untuk mengganti segala kerugian yang diderita oleh 
                                              PERUSAHAAN dan/atau Pemegang Polis/Tertanggung sebagai akibat dari:</span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td width="29" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">cc1.</span></div></td>
                                            <td width="917" valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"><span style="font-family: Arial,sans-serif; color: black">Kelalaian/kesalahan AGEN dalam memenuhi kewajiban dan tanggung 
                                              jawab AGEN sebagaimana disebut dalam ayat ini; atau</span></span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">cc2.</span></div></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"><span style="font-family: Arial,sans-serif; color: black">Pelanggaran yang dilakukan oleh AGEN baik disengaja ataupun tidak 
                                              sebagai pelanggaran sebagaimana&nbsp; yang disebutkan dalam Pasal 6 PKAJ ini;</span></span></div></td>
                                          </tr>
                                          <tr>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"></div></td>
                                            <td valign="top"><div align="justify"></div></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -17.85pt; margin-left: 17.85pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -17.85pt; margin-left: 44.8pt; margin-right: 0in; margin-top: 3.0pt; margin-bottom: .0001pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PASAL 5</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> TARGET AGEN</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="line-height: 10.0pt; margin-left: 14.2pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam melaksanakan kewajibannya menurut ketentuan Pasal 4 ayat 
                                          (2) PKAJ ini, AGEN diberikan target berupa;</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Penerimaan Premi;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Pencapaian poli</span><span class="style1">s;</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Persistensi polis; dan</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Target lain yang ditetapkan oleh PERUSAHAAN,</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">dalam <span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">kurun waktu satu tahun terhitung mulai Januari s/d Desember dalam 
                                              setiap tahun berjalan atau dalam kurun waktu tertentu yang ditetapkan 
                                              oleh PERUSAHAAN.</span></span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -.25in; margin-left: 45.35pt; margin-bottom: .0001pt;">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Target AGEN sebagaimana dimaksud dalam ayat (1) pasal ini 
                                          ditetapkan PERUSAHAAN dalam masing-masing Surat Penetapan Agen (SPA) dan 
                                          dicantumkan dalam Sistem Keagenan yang berlaku.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 17.85pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> PASAL&nbsp;&nbsp; 6</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> L A R A N G A N</span></b></p>
                                        <p class="MsoBodyTextIndent22"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Selama PKAJ ini berlangsung, AGEN dilarang melakukan hal-hal 
                                          sebagai berikut</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"><span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman"> </span>Mengadakan perjanjian dan/atau hubungan kerja Keagenan Asuransi 
                                              baik langsung maupun tidak langsung dengan perusahaan Asuransi yang 
                                              lain</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan pelanggaran terhadap Kode Etik Keagenan Asuransi Jiwa</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan hal-hal yang berada di luar kewenangannya sebagai AGEN.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memberikan penjelasan atau keterangan tentang program-program 
                                              Asuransi Jiwa Produk, Syarat-syarat Umum Polis Pertanggungan Kumpulan, 
                                              Premi dan Penyelesaian Klaim, serta ketentuan-ketentuan lain yang 
                                              menyimpang atau bertentangan dengan ketentuan yang berlaku.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">e.</span></td>
                                            <td valign="top"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Merekomendasikan Pemegang Polis untuk membatalkan polis yang 
                                              bertentangan dengan ketentuan dan atas dasar kepentingan AGEN pribadi.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">f.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Merekomendasikan dan/atau mempunyai nama AGEN fiktif&nbsp; kepada 
                                              PERUSAHAAN.</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">g.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Membebankan premi tambahan, membebankan biaya tambahan atau 
                                              memberikan potongan premi dalam bentuk apapun juga kepada Pemegang 
                                              Polis, kecuali yang disebutkan dalam tarif premi yang berlaku atau atas 
                                              ijin PERUSAHAAN</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">h.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Membuat, menggunakan, menandatangani dan mengeluarkan kuitansi 
                                              atau alat tagih dalam bentuk apapun juga selain kuitansi sah yang 
                                              diterbitkan PERUSAHAAN sebagai tanda terima pembayaran premi dari 
                                              Pemegang Polis</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">i.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Mengadakan perjanjian dalam bentuk apapun dan/atau memberikan 
                                              janji-janji kepada pihak ketiga yang mengikat PERUSAHAAN tanpa mendapat 
                                              persetujuan terlebih dahulu dari PERUSAHAAN</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">j.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menahan dan/atau tidak menyetorkan premi ke PERUSAHAAN melebihi 
                                              ketentuan yang berlaku untuk itu</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">k.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memalsukan polis atau memberikan polis palsu dan/atau kuitansi 
                                              penagihan premi palsu kepada Pemegang Polis</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">l.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Memberikan informasi mengenai strategi, kebijakan, program dan 
                                              Produk kepada perusahaan asuransi dan/atau pihak-pihak lain</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">m.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan pemisahan/pemecahan polis menjadi beberapa polis, yang 
                                              bertentangan dengan ketentuan Perusahaan yang berlaku</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">n.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Melakukan segala perbuatan yang merugikan PERUSAHAAN baik secara 
                                              materiil maupun immateriil</span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -17.85pt; margin-left: 44.8pt; margin-right: 0in; margin-top: 3.0pt; margin-bottom: .0001pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="line-height: 7.0pt; margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Atas pelanggaran terahadap ketentuan dimaksud pada ayat (1) pasal 
                                          ini,&nbsp; AGEN menyatakan bertanggungjawab sepenuhnya dan karenanya AGEN 
                                          membebaskan PERUSAHAAN dari segala tuntutan dalam bentuk apapun dari 
                                          pihak lain,&nbsp; yang timbul sebagai akibat dari pelanggaran dimaksud.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 99.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> PASAL&nbsp;&nbsp; 7</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PROMOSI, PENANGGUHAN&nbsp; DAN DEGRADASI.</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Untuk keperluan Promosi, Penangguhan dan Degradasi, PERUSAHAN akan 
                                          mengadakan evaluasi penilaian secara keseluruhan terhadap AGEN 
                                          sebagaimana diatur dalam Sistem Keagenan yang berlaku.</span></p>
                                        <p class="MsoBodyTextIndent22"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> &nbsp;PASAL&nbsp; 8</span></b></p>
                                        <p class="MsoNormal4" align="center" style="text-align: center"><b> <span lang="IN" style="font-family: Arial,sans-serif; color: black"> SANKSI</span></b></p>
                                        <p class="MsoNormal4" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Apabila AGEN terbukti melakukan pelanggaran terhadap salah satu 
                                          larangan dimaksud dalam&nbsp; Pasal 6 ayat (1) PKAJ ini, maka sesuai dengan 
                                          bobot pelanggarannya PERUSAHAAN berhak menjatuhkan sanksi, berupa:</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: .0001pt">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Teguran lisan</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Peringatan Tertulis,</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Degradasi,</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Pemutusan PKAJ.</span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -.25in; margin-left: 45.35pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Apabila pelanggaran yang dilakukan oleh AGEN mengandung 
                                          unsur-unsur tindak pidana, maka selain sanksi dimaksud dalam ayat (1) 
                                          pasal ini, PERUSAHAAN dapat melaporkan AGEN kepada pihak yang berwajib 
                                          untuk penyelesaian melalui jalur hukum.</span></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Pasal 9</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PEMUTUSAN SEMENTARA PKAJ</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">(1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>PERUSAHAAN dapat melakukan Pemutusan Sementara hubungan kemitraan 
                                          dalam hal AGEN sedang menjalani pemeriksaan internal maupun eksternal 
                                          akibat perbuatan AGEN yang melanggar pasal Larangan dalam PKAJ atau 
                                          ketentuan hukum yang berlaku.</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">(2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam hal AGEN dikenai pemutusan sementara hubungan kemitraan, 
                                          maka PERUSAHAAN akan mengeluarkan surat pemutusan sementara hubungan 
                                          kemitraan. </span></p>
                                        <p class="MsoNormal4" style="text-align: justify"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">(3)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam hal AGEN dikenai pemutusan sementara hubungan kemitraan, 
                                          maka pembayaran kompensasi dan remunerasi akan diatur dalam surat 
                                          pemutusan sementara hubungan kemitraan. </span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (4)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam hal AGEN dinyatakan terbukti tidak bersalah maka PERUSAHAAN 
                                          akan mencabut pemutusan sementara PKAJ dan sebaliknya apabila terbukti 
                                          bersalah maka PERUSAHAAN berhak menjatuhkan sanksi sebagaimana Pasal 8 
                                          PKAJ.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (5)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Pemutusan sementara yang ditetapkan dalam pasal ini tidak/bukan 
                                          merupakan sanksi sebagaimana dimaksud pada Pasal 8 PKAJ ini.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PASAL 10</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PEMUTUSAN PERJANJIAN KEAGENAN</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Pemutusan PKAJ dilakukan atas dasar :</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: .0001pt">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Permohonan AGEN yang harus diajukan secara tertulis dengan 
                                              memperhatikan tenggang waktu sekurang-kurangnya 1 (satu) bulan,</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">AGEN meninggal dunia,</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">AGEN terbukti melakukan hal-hal yang dilarang menurut Pasal 6 
                                              ayat (1) Perjanjian ini,</span></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">d.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">AGEN tidak memenuhi target minimal yang ditetapkan oleh 
                                              PERUSAHAAN.</span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam hal pemutusan PKAJ dilakukan atas permohonan AGEN atau 
                                          karena AGEN tidak memenuhi target minimal, maka PERUSAHAAN akan:</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: .0001pt">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menerbitkan Surat tentang pemutusan/pengakhiran PKAJ dan</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Membayarkan hak AGEN sesuai dengan Sistem Keagenan yang berlaku dan 
                                              akan diperhitungkan dengan kewajibannya terhadap PERUSAHAAN.</span></div></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt; margin-bottom: .0001pt;"><span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">&nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (3)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam hal AGEN meninggal dunia maka secara serta merta dan dengan 
                                          sendirinya PKAJ menjadi berakhir, dan PERUSAHAAN akan :</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: .0001pt">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menerbitkan Surat tentang pemutusan/pengakhiran PKAJ yang akan 
                                              diberikan kepada ahli waris yang sah dan</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Membayarkan hak AGEN sesuai dengan Sistem Keagenan yang berlaku dan 
                                              akan diperhitungkan dengan kewajibannya terhadap PERUSAHAAN.</span></div></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt">&nbsp;</p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (4)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam pemutusan PKAJ dilakukan atas dasar AGEN terbukti melakukan 
                                          hal-hal yang dilarang menurut Pasal 6 ayat (1) PKAJ ini dan merugikan 
                                          PERUSAHAAN, maka PERUSAHAAN :</span></p>
                                        <p class="MsoNormal4" style="text-align: justify; text-indent: -1.0in; margin-left: 1.0in">&nbsp; </p>
                                        <table width="803" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: .0001pt">
                                          <tr>
                                            <td width="29">&nbsp;</td>
                                            <td width="28"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">a.</span></td>
                                            <td width="946"><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menerbitkan surat pemutusan/pengakhiran PKAJ, dan</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">b.</span></td>
                                            <td><div align="justify"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Menghentikan semua pembayaran hak AGEN atau atas kebijaksanaan 
                                              PERUSAHAAN semata, tetap memperhitungkan hak-hak AGEN dengan kewajiban 
                                              yang masih ada di PERUSAHAAN dengan memperhatikan bobot pelanggarannya, 
                                              dan,</span></div></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">c.</span></td>
                                            <td><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">Berhak melaporkan AGEN kepada yang berwajib untuk diproses secara 
                                              hukum</span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -14.2pt; margin-left: 14.2pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -27.0pt; margin-left: 27.0pt"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (5)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dalam hal terjadi pemutusan/pengakhiran PKAJ ini sebagaimana 
                                          dimaksud pada ayat (1) pasal ini PARA PIHAK sepakat meniadakan 
                                          berlakunya Pasal 1266 Kitab Undang-undang Hukum Perdata.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PASAL 11</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PENYELESAIAN PERSELISIHAN</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Apabila terjadi perselisihan dalam pelaksanaan PKAJ ini, PARA PIHAK 
                                          sepakat&nbsp; menyelesaikan secara musyawarah untuk mencapai mufakat, namun 
                                          dalam hal&nbsp; tidak tercapai permufakatan dalam musyawarah tersebut, maka 
                                          PARA PIHAK sepakat menyerahkan perselisihan tersebut melalui pengadilan 
                                          dan untuk itu PARA PIHAK sepakat memilih tempat kediaman/domisili hukum 
                                          yang umum dan tetap di kantor Kepaniteraan Pengadilan Negeri Jakarta 
                                          Pusat.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PASAL 12</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> LAMPIRAN</span></b></p>
                                        <p class="MsoNormal4"><b> <span lang="IN" style="font-size: 11.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></b></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Lampiran-lampiran PKAJ tersebut dibawah ini merupakan bagian yang tidak 
                                          terpisahkan dalam PKAJ ini :</span></p>
                                        <table class="MsoNormalTable2" border="0" cellspacing="0" cellpadding="0" width="567" style="width: 424.9pt; border-collapse: collapse; margin-left: 5.4pt">
                                          <tr>
                                            <td width="38" valign="top" style="width: 28.35pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <a name="_Hlk197755084"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> a.</span></a></td>
                                            <td width="113" valign="top" style="width: 85.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Lampiran 1</span></td>
                                            <td width="28" valign="top" style="width: 20.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="387" valign="top" style="width: 290.6pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Surat Penetapan Agen (SPA)</span></td>
                                          </tr>
                                          <tr>
                                            <td width="38" valign="top" style="width: 28.35pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> b.</span></td>
                                            <td width="113" valign="top" style="width: 85.05pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Lampiran 2</span></td>
                                            <td width="28" valign="top" style="width: 20.9pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> :</span></td>
                                            <td width="387" valign="top" style="width: 290.6pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"><p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> Kode Etik Keagenan</span></td>
                                          </tr>
                                        </table>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"><b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PASAL 13</span></b></p>
                                        <p class="MsoBodyTextIndent22" align="center" style="text-align: center; margin-left: 0in"> <b> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> KETENTUAN PENUTUP</span></b></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -.25in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (1)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp; </span>PKAJ ini mulai berlaku sejak tanggal ditandanganinya PKAJ ini 
                                          sebagaimana tersebut diatas, dan akan berakhir setelah 
                                          pemutusan/pengakhiran PKAJ ini berdasarkan ketentuan-ketentuan 
                                          sebagaimana ditetapkan dalam Pasal 10 PKAJ ini atau jangka waktu 
                                          tertentu sebagaimana ditetapkan oleh PERUSAHAAN.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="text-indent: -.25in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> (2)<span style="font-style: normal; font-variant: normal; font-weight: normal; font-size: 7.0pt; font-family: Times New Roman">&nbsp;&nbsp; </span>Dalam hal terdapat perubahan terhadap PKAJ ini akan diatur 
                                          tersendiri dalam bentuk addendum atau instrument tertulis lainnya yang 
                                          disepakati PARA PIHAK dan menjadi bagian yang tidak terpisahkan dari 
                                          PKAJ ini.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> PKAJ ini dibuat dan ditandatangani oleh masing-masing pihak dalam 
                                          rangkap 2 (dua) dan bermeterai cukup serta mempunyai kekuatan hukum yang 
                                          sama.</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <p class="MsoBodyTextIndent22" style="margin-left: 0in"> <span lang="IN" style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black"> &nbsp;</span></p>
                                        <table width="780" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="256"><div align="center"><span style="font-size: 10.0pt; font-family: Arial,sans-serif; color: black">PERUSAHAAN&nbsp;</span></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="316"><div align="center"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">AGEN</span></div></td>
                                          </tr>
                                          <tr>
                                            <td width="208"><div align="center"></div></td>
                                            <td><div align="center"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">
                                                <img src="<?php echo base_url('asset/images_qrcode/'.$row["KANCAB_QRCODE"].''); ?>" />
                                                <br>
                                                <?=$row["NAMABM"];?>
                                            </span></div></td>
                                            <td><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td><div align="center"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">
                                                <img src="<?php echo base_url('asset/images_qrcode/'.$row["AGEN_QRCODE"].''); ?>" />
                                                <br>
                                                <?=$row["NAMAKLIEN1"];?>
                                            </span></div></td>
                                          </tr>
                                          <tr>
                                            <td width="208"><div align="center"></div></td>
                                            <td><div align="center"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">
                                                <?=$row["JABATANBM"];?>
                                            </span></div></td>
                                            <td><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td width="208"><div align="center"></div></td>
                                            <td><div align="center"><span style="font-size: 10.0pt; font-family: Arial, sans-serif; color: black">AGEN</span></div></td>
                                          </tr>
                                    <tr style="height: 17.55pt">
                                       <td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 17.55pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
                                        <br>
                                        <br>
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

