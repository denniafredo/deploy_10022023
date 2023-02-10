<!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/plugin/bootstrap-datepicker/css/datepicker3.css"/>

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <style type="text/css">
    
    </style>
    <div class="container"> 
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="javascript:;">Pencapaian</a>
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
                        <div class="clearfix"></div>
                        <div class="table-scrollable" style="width: 100%; height: 300px; overflow-y: scroll;">
                            <? if($kddetail == 2){?>
                                <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Tgl Entry</th>
                                            <th style="text-align:center; vertical-align:middle;">No SPAJ</th>
                                            <th style="text-align:center; vertical-align:middle;">Pemegang Polis</th>
                                            <th style="text-align:center; vertical-align:middle;">No Penawaran</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailspaj as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["JUMLAH_PREMI"]; $jmlanp = $jmlanp+$detail["ANP_SPAJ"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['TANGGALREKAM']?></td>
                                            <td><a href="<? echo base_url();?>prospek/follow-up?buildid=<?=$detail['BUILDID']?>" data-container="body" data-placement="top"><?=$detail['NOSPAJ']?></a></td>
                                            <td align="center"><?=$detail['NMPEMPOL']?></td>
                                            <td align="center"><?=$detail['BUILDID']?></td>
                                            <td align="center"><?=$detail['PRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['KODEAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="center"><?=$detail['NAMAKTR']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["JUMLAH_PREMI"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP_SPAJ"])), 2,",",".");?></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="11" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? }else if($kddetail==1){?>
                                 <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Tanggal</th>
                                            <th style="text-align:center; vertical-align:middle;">No Penawaran</th>
                                            <th style="text-align:center; vertical-align:middle;">Calon Nasabah</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailpenawaran as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["PREMIJML"]; $jmlanp = $jmlanp+$detail["ANP_PENAWARAN"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['TGL_REKAM']?></td>
                                            <td><a href="<? echo base_url();?>prospek/follow-up?buildid=<?=$detail['BUILD_ID']?>" data-container="body" data-placement="top"><?=$detail['NO_PROSPEK']?></a></td>
                                            <!-- <td align="center"><?=$detail['NO_PROSPEK']?></td> -->
                                            <td align="center"><?=$detail['NAMA_PEMPOL']?></td>
                                            <td align="center"><?=$detail['NAMA_PRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['ID_AGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="center"><?=$detail['NAMAKTR']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["PREMIJML"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP_PENAWARAN"])), 2,",",".");?></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="10" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? } else if($kddetail==3){?>
                                 <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Tanggal</th>
                                            <th style="text-align:center; vertical-align:middle;">No Proposal</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                            <th style="text-align:center; vertical-align:middle;">No SPAJ</th>
                                            <th style="text-align:center; vertical-align:middle;">Pemegang Polis</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                            <th style="text-align:center; vertical-align:middle;">Status</th>
                                            <th style="text-align:center; vertical-align:middle;">User</th>
                                            <th style="text-align:center; vertical-align:middle;">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailgap1 as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["PREMI1"]; $jmlanp = $jmlanp+$detail["ANP_APPROVAL"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['TGLREKAM']?></td>
                                            <td align="center"><?=$detail['PREFIXPERTANGGUNGAN']."-".$detail['NOPERTANGGUNGAN']?></td>
                                            <td align="center"><?=$detail['NOPOLBARU']?></td>
                                            <td align="center"><?=$detail['NOSP']?></td>
                                            <td align="center"><?=$detail['NMPEMPOL']?></td>
                                            <td align="center"><?=$detail['PRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['NOAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["PREMI1"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP_APPROVAL"])), 2,",",".");?></td>
                                           <td align="right"><?=$detail['STATUS']?></td>
                                           <td align="right"><?=$detail['USERREKAM']?></td>
                                           <td align="right"></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="9" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                            <td colspan="3" align="center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? } else if($kddetail==4){?>
                                 <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Mulas</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Pempol</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailapproval as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["PREMI1"]; $jmlanp = $jmlanp+$detail["ANP"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['MULAS']?></td>
                                            <td><a href="<? echo base_url();?>prospek/follow-up?buildid=<?=$detail['BUILDNO']?>" data-container="body" data-placement="top"><?=$detail['PREFIXPERTANGGUNGAN']."-".$detail['NOPERTANGGUNGAN']?></a></td>
                                            <td align="center"><?=$detail['NOPOLBARU']?></td>
                                            <td align="center"><?=$detail['NMPEMPOL']?></td>
                                            <td align="center"><?=$detail['KDPRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['NOAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="center"><?=$detail['NAMAKTR']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["PREMI1"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP"])), 2,",",".");?></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="11" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? } else if($kddetail==5){?>
                                 <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Mulas</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Pempol</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailpelunasan as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["PREMI1"]; $jmlanp = $jmlanp+$detail["ANP"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['MULAS']?></td>
                                            <td><a href="<? echo base_url();?>prospek/follow-up?buildid=<?=$detail['BUILDNO']?>" data-container="body" data-placement="top"><?=$detail['PREFIXPERTANGGUNGAN']."-".$detail['NOPERTANGGUNGAN']?></a></td>
                                             <td align="center"><?=$detail['NOPOLBARU']?></td>
                                            <td align="center"><?=$detail['NMPEMPOL']?></td>
                                            <td align="center"><?=$detail['KDPRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['NOAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="center"><?=$detail['NAMAKTR']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["PREMI1"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP"])), 2,",",".");?></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="11" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? } else if($kddetail==6){?>
                                 <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Mulas</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Pempol</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailterkirim as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["PREMI1"]; $jmlanp = $jmlanp+$detail["ANP"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['MULAS']?></td>
                                            <td><a href="<? echo base_url();?>prospek/follow-up?buildid=<?=$detail['BUILDNO']?>" data-container="body" data-placement="top"><?=$detail['PREFIXPERTANGGUNGAN']."-".$detail['NOPERTANGGUNGAN']?></a></td>
                                             <td align="center"><?=$detail['NOPOLBARU']?></td>
                                            <td align="center"><?=$detail['NMPEMPOL']?></td>
                                            <td align="center"><?=$detail['KDPRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['NOAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="center"><?=$detail['NAMAKTR']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["PREMI1"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP"])), 2,",",".");?></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="11" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? } else if($kddetail==7){?>
                                 <table class="table table-bordered table-hover" style="font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; vertical-align:middle;">No</th>
                                            <th style="text-align:center; vertical-align:middle;">Mulas</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Lama</th>
                                            <th style="text-align:center; vertical-align:middle;">No Polis Baru</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Pempol</th>
                                            <th style="text-align:center; vertical-align:middle;">Produk</th>
                                            <th style="text-align:center; vertical-align:middle;">Cara bayar</th>
                                            <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Nama Agen</th>
                                            <th style="text-align:center; vertical-align:middle;">Jabatan</th>
                                            <th style="text-align:center; vertical-align:middle;">Kantor</th>
                                            <th style="text-align:center; vertical-align:middle;">Premi</th>
                                            <th style="text-align:center; vertical-align:middle;">APE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <? $no =0; $jmlpremi=0;$jmlanp=0; foreach($detailproposal as $detail){ $no++; $jmlpremi = $jmlpremi+$detail["PREMI1"]; $jmlanp = $jmlanp+$detail["ANP"]; ?>
                                        <tr>
                                            <td align="center"><?=$no;?></td>
                                            <td align="center"><?=$detail['MULAS']?></td>
                                            <td><a href="<? echo base_url();?>prospek/follow-up?buildid=<?=$detail['BUILDNO']?>" data-container="body" data-placement="top"><?=$detail['PREFIXPERTANGGUNGAN']."-".$detail['NOPERTANGGUNGAN']?></a></td>
                                             <td align="center"><?=$detail['NOPOLBARU']?></td>
                                            <td align="center"><?=$detail['NMPEMPOL']?></td>
                                            <td align="center"><?=$detail['KDPRODUK']?></td>
                                            <td align="center"><?=$detail['CARA_BAYAR']?></td>
                                            <td align="center"><?=$detail['NOAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAAGEN']?></td>
                                            <td align="center"><?=$detail['NAMAJABATAN']?></td>
                                            <td align="center"><?=$detail['NAMAKTR']?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["PREMI1"])), 2,",",".");?></td>
                                            <td align="right"><? echo number_format(str_replace(',','.',($detail["ANP"])), 2,",",".");?></td>
                                        </tr>
                                       <? } ?>
                                        <tr bgcolor="#90EE90">
                                            <td colspan="11" align="center"> <b>TOTAL</b> </td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlpremi)), 2,",",".");?> </b></td>
                                            <td align="right"><b> <? echo number_format(str_replace(',','.',($jmlanp)), 2,",",".");?> </b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <? } ?>
                        </div>
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
    