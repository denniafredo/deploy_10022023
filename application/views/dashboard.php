<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/css/news.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/pricing-table.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/portfolio.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?= base_url("asset/countdown/css/jquery.countdown.css") ?>"> 
<!-- END PAGE LEVEL STYLES -->
<style>
	#contoh {
	  border-radius: 10px;
	  background: #BADA55;
	  margin:5px;
	 
	}
	#contoh2 {
	  border-radius: 10px;
	  background: #fcdb56;
	  margin:5px;
	}

	.scroll_pos{
	    height: 300px;
	    overflow: scroll;
	}


	#demo {
	  text-align: center;
	  font-size: 30px;
	  margin-top: 0px;
	  background-color: green;
	  color: white;
	}

	.strike {
        display: block;
        text-align: center;
        overflow: hidden;
        white-space: nowrap; 
        background-color: green;
    }

    .strike > span {
        position: relative;
        display: inline-block;
        
    }
	
    .strike > span:before,
    .strike > span:after {
        content: "";
        position: absolute;
        top: 50%;
        width: 9999px;
        height: 3px;
        background: white;
        
    }

    .strike > span:before {
        right: 100%;
        margin-right: 15px;
    }

    .strike > span:after {
        left: 100%;
        margin-left: 15px;
    }
</style>

<?php 
	$kodeJabatanAgen=array('29','31','32','33','34','35','36','37','38'); 
	if (in_array($this->session->KDJABATANAGEN, $kodeJabatanAgen) || in_array($this->session->KDROLE, $kodeJabatanAgen)) { ?>
    <div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
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
                    <div class="row">
                        <div class="col-md-12 news-page">
							<div class="row">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-text-o font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Beranda AIMS</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                            <div class="au-card m-b-30">
												<div class="au-card-inner">
													<h3 ondragstart="return false;" class="title-2 m-b-40">Monitoring Production (Year To Date)</h3>
														<div id="contoh" class="col-lg-3 ">
															<center>
															   <b><p id="penawarantahun" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of SPAJ/Penawaran</p>
															 </center>
														</div>
														<div id="contoh2" class="col-lg-3 ">
															<center>
															  <b><p id="pelunasantahun" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of Pelunasan/SPAJ</p>
														  </center>
														</div>
													<canvas id="tahun"></canvas>
												</div>
											</div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                            <div class="au-card m-b-30">
												<div class="au-card-inner">
													<h3 ondragstart="return false;" class="title-2 m-b-40">Monitoring Production (Month To Date)</h3>
													<div id="contoh" class="col-lg-3 ">
															<center>
															   <b><p id="penawaranbulan" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of SPAJ/Penawaran</p>
														  </center>
													</div>
													<div id="contoh2" class="col-lg-3">
															<center>
															  <b><p id="pelunasanbulan" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of Pelunasan/SPAJ</p>
														  </center>
													</div>
													<canvas id="bulan"></canvas>
												</div>
											</div>
                                        </div>
									</div>
                            </div>
                        </div>
                         <div class="col-md-12 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title tabbable-line">
                                    <div class="caption caption-md">
                                        <i class="icon-globe theme-font hide"></i>
                                        <span class="caption-subject theme-font bold uppercase">Notifikasi</span>
                                    </div>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab">Sistem</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body">
                                    <!--BEGIN TABS-->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1_1">
                                            <div class="scroller" style="height: 100px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                <ul class="feeds">
                                                    <?php foreach ($popimages as $i => $r) { ?>
                                                        <li>
                                                            <div class="col1">
                                                                <div class="cont">
                                                                    <div class="cont-col1">
                                                                        <div class="label label-sm label-info">
                                                                            <i class="fa fa-bullhorn"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cont-col2">
                                                                        <div class="desc">
                                                                            <a href="javascript:void(0);" onclick="changePopImage('<?=$r['JUDUL']?>','<?=base_url("asset/popimages/$r[GAMBAR]")?>','<?=$r['DESKRIPSI']?>')">
                                                                                <?=$r['JUDUL'];?>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col2">
                                                                <div class="date"><?= $r['TGLAKHIR'] ?></div>
                                                            </div>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END TABS-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else if($this->session->KDROLE == 5 || $this->session->KDROLE == 6 ) {?>
<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
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
                    <div class="row">
                        <div class="col-md-12 news-page">
							<div class="row">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-text-o font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Beranda AIMS</span>
                                        </div>
                                    </div>
									<div class="portlet-body">
                                       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                            <div class="au-card m-b-30">
												<div class="au-card-inner">
													<h3 ondragstart="return false;" class="title-2 m-b-40">Statistik Pengguna AIMS Perhari</h3>
													<canvas id="statistikhari"></canvas>
												</div>
											</div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                            <div class="au-card m-b-30">
												<div class="au-card-inner">
													<h3 ondragstart="return false;" class="title-2 m-b-40">Statistik Pengguna AIMS Pertahun</h3>
													<canvas id="statistiktotal"></canvas>
												</div>
											</div>
                                        </div>
									</div>
                                    <div class="actions" style="padding-left: 15px;">
                                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                <input type="radio" name="options" class="toggle" id="option2">Tahun <?=date('Y')?></label>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light red-intense" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-briefcase fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($total_polis_super, 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Polis
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green-jungle" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-money fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($total_ape_super, 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total APE (Tanpa Topup Sekaligus)
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-money fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($total_fyp_super[0]["TOTAL_FYP_SUPER"], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total FYP (Termasuk Polis Migrasi)
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light yellow-lemon" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-group fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($jumlah_rekrut_super['JMLREKRUT'], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Rekrut
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green-turquoise" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-group fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($total_agen_aktif['TOTAL_AGEN_AKTIF'], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Man Power
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-top-10">
                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Portofolio</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option2">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row list-separated margin-bottom-30">
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Aktif
                                                    </div>
                                                    <div class="uppercase font-hg theme-font">
                                                        <?=number_format($total_polis_aktif_super['TOTAL_POLIS'], 0, ",", ".");?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Lapse
                                                    </div>
                                                    <div class="uppercase font-hg font-red-flamingo">
                                                        <?=number_format($nasabah_lapse_super['JUMLAH_DATA'], 0, ",", ".");?>
                                                        <!-- <a href="" id="nasabah_lapse" class="font-red" data-toggle="modal" data-target="#modal_daftar_nasabah_lapse"><?=number_format($nasabah_lapse_super['JUMLAH_DATA'], 0, ",", ".");?></a> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Ekspirasi
                                                    </div>
                                                    <div class="uppercase font-hg font-purple">
                                                        <?=number_format($total_polis_expirasi_super['TOTAL_POLIS'], 0, ",", ".");?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Tebus
                                                    </div>
                                                    <div class="uppercase font-hg font-blue-sharp">
                                                        <?=number_format($total_polis_tebus_super['TOTAL_POLIS'], 0, ",", ".");?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                                <div class="col-md-6">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-money font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Info NAB</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option2">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="text-align:center;">Kode Fund</th>
                                                        <th style="text-align:center;">Berlaku</th>
                                                        <th style="text-align:center;">Nilai</th>
                                                        <th style="text-align:center;">Total Unit</th>
                                                        <th style="text-align:center;">Total Investasi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- <?php foreach ($kurstransaksi as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                            <td />
                                                            <td />
                                                        </tr>
                                                    <?php } ?> -->
                                                    <!-- <tr>
                                                        <th colspan="3">Nilai Aktiva Bersih</th>
                                                    </tr>
                                                    <?php if ($kursjsfixed) { ?>
                                                    <tr>
                                                        <td><?=$kursjsfixed['VALUTA']?></td>
                                                        <td align="center"><?=$kursjsfixed['TGLBERLAKU']?></td>
                                                        <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $kursjsfixed['KURS']), 2, ",", ".")?></span></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <th colspan="3">NAB Jual</th>
                                                    </tr>
                                                    <?php if ($kursnabjual) { foreach ($kursnabjual as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    <tr>
                                                        <th colspan="3">NAB Beli</th>
                                                    </tr>
                                                    <?php if ($kursnabbeli) { foreach ($kursnabbeli as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                        </tr>
                                                    <?php } } ?> -->
                                                    <!-- <tr>
                                                        <th colspan="3">NAB</th>
                                                    </tr>  -->
                                                    <?php foreach ($kursnabnew as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['TOTAL_UNIT']), 2, ",", ".")?></span></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['TOTAL_INVESTASI']), 2, ",", ".")?></span></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                            <!-- END ROW 1 -->
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 APE</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top APE
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($topape_super) > 0) {
                                                                    echo number_format(str_replace(",", ".", $topape_super[0]['TOTAL_PREMI']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>Rank</th>
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Kantor</th>
                                                        <th>Total Premi</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($topape_super as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$i+1?></td>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td><?=substr($r['NAMAKANTOR'], 20)?></td>
                                                                <td  align="left"><?=number_format(str_replace(",", ".", $r['TOTAL_PREMI']), 0, ",", ".")?></td>
                                                                
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 Rekrut</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                            <div id="sparkline_bar"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top Rekrut
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toprekrut_super) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toprekrut_super[0]['JMLREKRUT']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Premi Rekrut
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toprekrut_super) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toprekrut_super[0]['JMLPREMIREKR']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>Rank</th>
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Kantor</th>
                                                        <th>Rekrut</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($toprekrut_super as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$i+1?></td>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td><?=substr($r['NAMAKANTOR'], 20)?></td>
                                                                <td><?=number_format(str_replace(",", ".", $r['JMLREKRUT']), 0, ",", ".")?></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 Polis</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top Polis
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toppolis_super) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toppolis_super[0]['JMLPOLIS']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>Rank</th>
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Kantor</th>
                                                        <th>Premi</th>
                                                        <th>Polis</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($toppolis_super as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$i+1?></td>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td><?=substr($r['NAMAKANTOR'], 20)?></td>
                                                                <td align="right"><?=number_format(str_replace(",", ".", $r['JMLPREMI']), 0, ",", ".")?></td>
                                                                <td align="right"><?=number_format(str_replace(",", ".", $r['JMLPOLIS']), 0, ",", ".")?></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
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
                    <div class="row">
                        <div class="col-md-12 news-page">
							<div class="row">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                    <!-- <p id="demo"></p> -->
                                    <div class="strike">
                                        <span id="demo"></span>
                                    </div>
                                        <div class="caption">
                                            <i class="fa fa-file-text-o font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">Beranda AIMS</span>
                                        </div>
                                    </div>
									<div class="portlet-body">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                            <div class="au-card m-b-30">
												<div class="au-card-inner">
													<h3 ondragstart="return false;" class="title-2 m-b-40">Monitoring Production (Year To Date)</h3>
														<div id="contoh" class="col-lg-3 ">
															<center>
															   <b><p id="penawarantahun" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of SPAJ/Penawaran</p>
															 </center>
														</div>
														<div id="contoh2" class="col-lg-3 ">
															<center>
															  <b><p id="pelunasantahun" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of Pelunasan/SPAJ</p>
														  </center>
														</div>
													<canvas id="tahun"></canvas>
												</div>
											</div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-10">
                                            <div class="au-card m-b-30">
												<div class="au-card-inner">
													<h3 ondragstart="return false;" class="title-2 m-b-40">Monitoring Production (Month To Date)</h3>
													<div id="contoh" class="col-lg-3 ">
															<center>
															   <b><p id="penawaranbulan" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of SPAJ/Penawaran</p>
														  </center>
													</div>
													<div id="contoh2" class="col-lg-3">
															<center>
															  <b><p id="pelunasanbulan" style="font-size:16px;"></p></b>
															  <p  style="font-size:12px;">Accuracy of Pelunasan/SPAJ</p>
														  </center>
													</div>
													<canvas id="bulan"></canvas>
												</div>
											</div>
                                        </div>
									</div>
                                   <!--  <div class="portlet-body">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
                                            <a class="dashboard-stat dashboard-stat-light blue-madison" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-briefcase fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($polpremkom['JMLPOLIS'], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Polis non PA
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light red-intense" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format(str_replace(',','.',$polpremkom['JMLPREMI']), 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Premi non PA
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green-haze" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-group fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format(str_replace(',','.',$polpremkom['JMLKOMISI']), 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Remunerasi
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div> -->
                                    <div class="actions" style="padding-left: 15px;">
                                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                                            <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                <input type="radio" name="options" class="toggle" id="option2">Tahun <?=date('Y')?></label>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light red-intense" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-briefcase fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($jumlah_polis, 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Polis
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green-haze" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-group fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($polpremkom['JMLKOMISI'], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Rerata Komisi per Bln
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green-jungle" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-money fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($total_APE, 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total APE (Tanpa Topup Sekaligus)
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-money fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($total_fyp["TOTAL_FYP"], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total FYP (Termasuk Polis Migrasi)
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light yellow-lemon" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-group fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($jumlah_rekrut['JMLREKRUT'], 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Rekrut
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <a class="dashboard-stat dashboard-stat-light green-turquoise" href="javascript:;">
                                                <div class="visual">
                                                    <i class="fa fa-group fa-icon-medium"></i>
                                                </div>
                                                <div class="details">
                                                    <div class="number">
                                                        <?=number_format($jumlah_agen_aktif, 0, ",", ".");?>
                                                    </div>
                                                    <div class="desc">
                                                        Total Man Power
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space20"></div>

                            <div class="row margin-top-10">
                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Portofolio</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option2">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row list-separated margin-bottom-30">
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Aktif
                                                    </div>
                                                    <div class="uppercase font-hg theme-font">
                                                        <?=number_format($jumlah_polis_aktif, 0, ",", ".");?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Lapse
                                                    </div>
                                                    <div class="uppercase font-hg font-red-flamingo">
                                                        <a href="" id="nasabah_lapse" class="font-red" data-toggle="modal" data-target="#modal_daftar_nasabah_lapse"><?=number_format($nasabah_lapse['JUMLAH_DATA'], 0, ",", ".");?></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Ekspirasi
                                                    </div>
                                                    <div class="uppercase font-hg font-purple">
                                                        <?=number_format($polpremkom['JMLPOLISEXPIRASI'], 0, ",", ".");?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-6">
                                                    <div class="font-grey-mint font-sm">
                                                        Tebus
                                                    </div>
                                                    <div class="uppercase font-hg font-blue-sharp">
                                                        <?=number_format($polpremkom['JMLPOLISTEBUS'], 0, ",", ".");?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div id="sales_statistics" class="portlet-body-morris-fit morris-chart" style="height:260px;">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                        <tr class="uppercase">
                                                            <th>No Polis</th>
                                                            <th>Pemegang Polis</th>
                                                            <th>Mulas</th>
                                                            <th>Produk</th>
                                                        </tr>
                                                    </thead>
                                                    <?php foreach ($polis as $i => $r) {
                                                        $color = null;
                                                        if (!in_array($r['KDPRODUK'], array('PAA','PAB'))) {
                                                            if (in_array($r['KDSTATUSFILE'],array('4','L')))
                                                                $color = "font-red-flamingo";
                                                            else if (in_array($r['KDSTATUSFILE'],array('3','9')))
                                                                $color = "font-purple";
                                                            else if (in_array($r['KDSTATUSFILE'],array('5')))
                                                                $color = "font-blue-sharp";
                                                        } ?>
                                                        <tr>
                                                            <td class="<?=$color?>"><?="$r[PREFIXPERTANGGUNGAN]$r[NOPERTANGGUNGAN]"?></td>
                                                            <td class="<?=$color?>"><?=ucwords(strtolower($r['NAMAKLIEN1']))?></td>
                                                            <td class="<?=$color?>"><?=$r['MULAS']?></td>
                                                            <td class="<?=$color?>"><?=$r['KDPRODUK']?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Notifikasi</span>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_1_1" data-toggle="tab">Sistem</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="portlet-body">
                                            <!--BEGIN TABS-->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1_1">
                                                    <div class="scroller" style="height: 100px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                        <ul class="feeds">
                                                            <?php if ($agen['KDJABATANAGEN'] == '09') { ?>
                                                            <li>
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-danger">
                                                                                <i class="fa fa-warning"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                <a href="/asset/learning/ebook/kodeetik.pdf" target="_blank">Unduh kode etik</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"><?=date('d/m/Y')?></div>
                                                                </div>
                                                            </li>
                                                            <?php } ?>
                                                            <!-- <li>
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-danger">
                                                                                <i class="fa fa-warning"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                <?php if ($agen['SISAPKAJ'] <= 30) {
                                                                                    echo "PKAJ anda akan berakhir dalam $agen[SISAPKAJ] hari, hubungi Seksi Operasional untuk perpanjangan atau SPAJ anda tidak dapat diproses dan Anda akan dinonaktifkan secara otomatis!";
                                                                                } else { 
                                                                                    echo "PKAJ anda akan berakhir dalam $agen[SISAPKAJ] hari";
                                                                                } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"><?=date('d/m/Y')?></div>
                                                                </div>
                                                            </li> -->
                                                            <?php if ($spaj_pending['JUMLAH_DATA'] != 0) { ?>
                                                            <li>
                                                                <div class="col1">
                                                                    <div class="cont">
                                                                        <div class="cont-col1">
                                                                            <div class="label label-sm label-warning">
                                                                                <i class="fa fa-paste"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="cont-col2">
                                                                            <div class="desc">
                                                                                
                                                                                    <?= "Anda memiliki <a href='#' id='spaj_pending' data-toggle='modal' data-target='#modal_daftar_spaj_pending'><b>" .$spaj_pending['JUMLAH_DATA']. "</b></a> proposal yang terpending."; ?>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col2">
                                                                    <div class="date"><?=date('d/m/Y')?></div>
                                                                </div>
                                                            </li>
                                                            <?php }  ?>
                                                            <?php foreach ($popimages as $i => $r) { ?>
                                                                <li>
                                                                    <div class="col1">
                                                                        <div class="cont">
                                                                            <div class="cont-col1">
                                                                                <div class="label label-sm label-info">
                                                                                    <i class="fa fa-bullhorn"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cont-col2">
                                                                                <div class="desc">
                                                                                    <a href="javascript:void(0);" onclick="changePopImage('<?=$r['JUDUL']?>','<?=base_url("asset/popimages/$r[GAMBAR]")?>','<?=$r['DESKRIPSI']?>')">
                                                                                        <?=$r['JUDUL'];?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col2">
                                                                        <div class="date"><?= $r['TGLAKHIR'] ?></div>
                                                                    </div>
                                                                </li>
                                                            <?php }
                                                            foreach ($notif as $i => $r) {
                                                                if ((strpos($r['NOTIFIKASI'], 'nasabah') !== false &&
                                                                    ($ultah > 0 || $jtbenefit > 0 || $jtpremi > 0)) ||
                                                                    strpos($r['NOTIFIKASI'], 'nasabah') === false) { ?>
                                                                    <li>
                                                                        <div class="col1">
                                                                            <div class="cont">
                                                                                <div class="cont-col1">
                                                                                    <?= $r['ICON'] ?>
                                                                                </div>
                                                                                <div class="cont-col2">
                                                                                    <div class="desc">
                                                                                        <?php eval("\$str = \"$r[NOTIFIKASI]\";"); echo $str; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col2">
                                                                            <div class="date"><?= $r['TGLREKAM'] ?></div>
                                                                        </div>
                                                                    </li>
                                                                <?php }
                                                            } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--END TABS-->
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                            </div>

                            <div class="space20"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Begin: life time stats -->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Status POS</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="tabbable-line">
                                                <div class="table-scrollable table-scrollable-borderless scroll_pos">
                                                    <table class="table table-hover table-light">
                                                        <thead>
                                                        <tr class="uppercase">
                                                            <th>No Proposal</th>
                                                            <th>Produk</th>
															<th>No Agen</th>
                                                            <th>Nama Agen</th>
                                                            <th>Kantor</th>
                                                            <th>Premi</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($track as $i => $r) {
                                                            if ($i < 5) { ?>
                                                                <tr>
                                                                    <td><?=$r['NOPROPOSAL']?></td>
                                                                    <td><?=$r['NAMA_PRODUK']?></td>
																	<td><?=$r['NOAGEN']?></td>
                                                                    <td><?=$r['NAMAKLIEN1']?></td>
                                                                    <td><?=$r['NAMAKANTOR']?></td>
                                                                    <td align="right"><?=number_format(str_replace(",", ".", $r['JUMLAH_PREMI']), 2, ",", ".")?></td>
                                                                    <td align="left"><?=$r['NAMASTATUS']?></td>
                                                                </tr>
                                                            <?php }
                                                        } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: life time stats -->
                                </div>
                                <!-- Created Ismi, Hide terlebih dahulu :> -->
                                <!-- <div class="col-md-6 col-sm-12">
                                    BEGIN PORTLET
                                    <div class="portlet light tasks-widget">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Poin Tur (Belum termasuk JL3)<br>
                                                    <font style="font-size:7px;">
                                                        *Jumlah poin tour ini merupakan perhitungan sementara dan bukan hasil akhir perhitungan. Hasil akhir perhitungan mengacu pada Nota Penetapan yang diterbitkan Divisi Keagenan.
                                                    </font>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="stat-number">
                                                        <div class="number">
                                                            <?php if ($pointur)
                                                                echo "Dalam Pengembangan"; //echo number_format(str_replace(",", ".", $pointur['JMLPOIN']), 2, ",", ".");
                                                            else
                                                                echo 0;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="task-content">
                                                <div class="scroller" style="height: 282px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                                    START TASK LIST
                                                    <ul class="task-list">
                                                        <?php $status = 0;
                                                        foreach ($tour as $i => $v) {
                                                            if (!empty($pointur) && str_replace(",", ".", $pointur['JMLPOIN']) >= str_replace(",", ".", $v['JMLPOINMIN']) && str_replace(",", ".", $pointur['JMLPOIN']) <= str_replace(",", ".", $v['JMLPOINMAX'])) { ?>
                                                                <li>
                                                                    <div class="task-checkbox">
                                                                        <input type="checkbox" checked disabled/>
                                                                    </div>
                                                                    <div class="task-title">
                                                                        <span class="task-title-sp"><?="$v[JUDUL] $v[SINOPSIS]"?> </span>
                                                                        <span class="label label-sm label-success">Tercapai</span>
                                                                    </div>
                                                                </li>
                                                                <?php $status++;
                                                            }

                                                        }
                                                        if ($status == 0) { ?>
                                                            <li>
                                                                <div class="task-checkbox">
                                                                    <input type="checkbox" disabled/>
                                                                </div>
                                                                <div class="task-title">
                                                                    <span class="task-title-sp"><?=$tour[count($tour)-1]['JUDUL']." ".$tour[count($tour)-1]['SINOPSIS']?> </span>
                                                                    <span class="label label-sm label-danger">Tertunda</span>
                                                                </div>
                                                            </li>
                                                        <?php } ?>
                                                        <li>
                                                            <?php
                                                            if ($agen['YEAREXPLS'] >= 0) {
                                                                $checked = null;
                                                                $label = "label-danger";
                                                                $ket = "Kadaluarsa";
                                                            } else {
                                                                $checked = "checked";
                                                                $label = "label-success";
                                                                $ket = "Aktif";
                                                                $status++;
                                                            }
                                                            ?>
                                                            <div class="task-checkbox">
                                                                <input type="checkbox" <?=$checked?> disabled/>
                                                            </div>
                                                            <div class="task-title">
                                                                <span class="task-title-sp">Lisensi No <?=$agen['NOLISENSIAGEN']?></span>
                                                                <span class="label label-sm <?=$label?>"><?=$ket?></span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <?php
                                                            if ($agen['YEAREXPPKAJ'] >= 2) {
                                                                $checked = null;
                                                                $label = "label-danger";
                                                                $ket = "Kadaluarsa";
                                                            } else {
                                                                $checked = "checked";
                                                                $label = "label-success";
                                                                $ket = "Aktif";
                                                                $status++;
                                                            }
                                                            ?>
                                                            <div class="task-checkbox">
                                                                <input type="checkbox" <?=$checked?> disabled/>
                                                            </div>
                                                            <div class="task-title">
                                                                <span class="task-title-sp">PKAJ</span>
                                                                <span class="label label-sm <?=$label?>"><?=$ket?></span>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <?php if ($polpremkom['JMLPOLIS'] >= 24) $status++; ?>
                                                            <div class="task-checkbox">
                                                                <input type="checkbox" <?=$polpremkom['JMLPOLIS']>=24?'checked':null;?> disabled/>
                                                            </div>
                                                            <div class="task-title">
                                                                <span class="task-title-sp">Minimal 24 Polis di Tahun non PA & Askred <?=date('Y')?> </span>
                                                                <span class="label label-sm <?=$polpremkom['JMLPOLIS']>=24?'label-success':'label-danger';?>"><?=$polpremkom['JMLPOLIS']>=24?'Tercapai':'Tidak Tercapai';?></span>
                                                            </div>
                                                        </li>
                                                        <li class="last-line">
                                                            <div class="task-title">
                                                                <span class="task-title-sp">Status poin tur</span>
                                                                <span class="label label-sm <?=$status==4?'label-success':'label-danger'?>"><?=$status==4?'Aktif':'Tertunda'?> </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    END START TASK LIST
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    END PORTLET
                                </div> 
                            </div>-->

                            <div class="space20"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-money font-green-sharp"></i>
                                                <span class="caption-subject font-green-sharp bold uppercase">Info NAB</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="text-align:center;">Kode Fund</th>
                                                        <th style="text-align:center;">Berlaku</th>
                                                        <th style="text-align:center;">Nilai</th>
                                                        <th style="text-align:center;">Total Unit</th>
                                                        <th style="text-align:center;">Total Investasi</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- <?php foreach ($kurstransaksi as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                            <td />
                                                            <td />
                                                        </tr>
                                                    <?php } ?> -->
                                                    <!-- <tr>
                                                        <th colspan="3">Nilai Aktiva Bersih</th>
                                                    </tr>
                                                    <?php if ($kursjsfixed) { ?>
                                                    <tr>
                                                        <td><?=$kursjsfixed['VALUTA']?></td>
                                                        <td align="center"><?=$kursjsfixed['TGLBERLAKU']?></td>
                                                        <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $kursjsfixed['KURS']), 2, ",", ".")?></span></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <th colspan="3">NAB Jual</th>
                                                    </tr>
                                                    <?php if ($kursnabjual) { foreach ($kursnabjual as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    <tr>
                                                        <th colspan="3">NAB Beli</th>
                                                    </tr>
                                                    <?php if ($kursnabbeli) { foreach ($kursnabbeli as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                        </tr>
                                                    <?php } } ?> -->
                                                    <!-- <tr>
                                                        <th colspan="3">NAB</th>
                                                    </tr>  -->
                                                    <?php foreach ($kursnabnew as $i => $v) { ?>
                                                        <tr>
                                                            <td><?=$v['VALUTA']?></td>
                                                            <td align="center"><?=$v['TGLBERLAKU']?></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['KURS']), 2, ",", ".")?></span></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['TOTAL_UNIT']), 2, ",", ".")?></span></td>
                                                            <td align="right"><span class="label label-sm label-success"><?=number_format(str_replace(",", ".", $v['TOTAL_INVESTASI']), 2, ",", ".")?></span></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                                <!-- DI Hide Dulu -->
                                <!--
                                <div class="col-md-6 col-sm-12">
                                    BEGIN PORTLET
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 Premi</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-left">
                                                        <div class="stat-chart">
                                                            do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break
                                                            <div id="sparkline_bar"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Premi
                                                            </div>
                                                            <div class="number">
                                                                <? if (count($toppremi) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toppremi[0]['JMLPREMI']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Polis
                                                            </div>
                                                            <div class="number">
                                                                <? if (count($toppremi) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toppremi[0]['JMLPOLIS']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Premi</th>
                                                        <th>Polis</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($toppremi as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td align="right"><?=number_format(str_replace(",", ".", $r['JMLPREMI']), 0, ",", ".")?></td>
                                                                <td align="right"><?=number_format(str_replace(",", ".", $r['JMLPOLIS']), 0, ",", ".")?></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    END PORTLET
                                </div> -->
                                <!-- END DI Hide Dulu -->
                            </div> 
                                  <!-- CREATED ISMI -->
                            <div class="row">
                            <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 APE</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top APE
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($topape) > 0) {
                                                                    echo number_format(str_replace(",", ".", $topape[0]['TOTAL_PREMI']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>Rank</th>
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Kantor</th>
                                                        <th>Total Premi</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($topape as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$i+1?></td>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td><?=substr($r['NAMAKANTOR'], 20)?></td>
                                                                <td><?=number_format(str_replace(",", ".", $r['TOTAL_PREMI']), 0, ",", ".")?></td>
                                                                
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 Rekrut</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                            <div id="sparkline_bar"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top Rekrut
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toprekrut) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toprekrut[0]['JMLREKRUT']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Premi Rekrut
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toprekrut) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toprekrut[0]['JMLPREMIREKR']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>Rank</th>
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Kantor</th>
                                                        <th>Rekrut</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($toprekrut as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$i+1?></td>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td><?=substr($r['NAMAKANTOR'], 20)?></td>
                                                                <td><?=number_format(str_replace(",", ".", $r['JMLREKRUT']), 0, ",", ".")?></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <!-- BEGIN PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption caption-md">
                                                <i class="icon-bar-chart theme-font hide"></i>
                                                <span class="caption-subject theme-font bold uppercase">Top 5 Polis</span>
                                            </div>
                                            <div class="actions">
                                                <div class="btn-group btn-group-devided" data-toggle="buttons">
                                                    <label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
                                                        <input type="radio" name="options" class="toggle" id="option1">Tahun <?=date('Y')?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row number-stats margin-bottom-30">
                                                <!-- <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-left">
                                                        <div class="stat-chart">
                                                            do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break
                                                            <div id="sparkline_bar"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top Premi
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toppolis) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toppolis[0]['JMLPREMI']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <div class="stat-right">
                                                        <div class="stat-chart">
                                                            <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                            <div id="sparkline_bar2"></div>
                                                        </div>
                                                        <div class="stat-number">
                                                            <div class="title">
                                                                Top Polis
                                                            </div>
                                                            <div class="number">
                                                                <?php if (count($toppolis) > 0) {
                                                                    echo number_format(str_replace(",", ".", $toppolis[0]['JMLPOLIS']), 0, ",", ".");
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-scrollable table-scrollable-borderless">
                                                <table class="table table-hover table-light">
                                                    <thead>
                                                    <tr class="uppercase">
                                                        <th>Rank</th>
                                                        <th>No Agen</th>
                                                        <th>Agen</th>
                                                        <th>Kantor</th>
                                                        <th>Premi</th>
                                                        <th>Polis</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($toppolis as $i => $r) {
                                                        if ($i < 5) { ?>
                                                            <tr>
                                                                <td><?=$i+1?></td>
                                                                <td><?=$r['NOAGEN']?></td>
                                                                <td><?=$r['NAMAKLIEN1']?></td>
                                                                <td><?=substr($r['NAMAKANTOR'], 20)?></td>
                                                                <td><?=number_format(str_replace(",", ".", $r['JMLPREMI']), 0, ",", ".")?></td>
                                                                <td><?=number_format(str_replace(",", ".", $r['JMLPOLIS']), 0, ",", ".")?></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET-->
                                </div>
                                <!-- END CREATED -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!--- edit rizal, 16-01-2023. noted : untuk kondisi pop image Agen LPA, Agency, & ALL -->
<?php if (($popimage)) { ?>  
    <a id="btnmodal" data-toggle="modal" class="hidden" href="#modal"></a>
    <div id="modal" class="modal fade modal-scroll" tabindex="-1" data-replace="true">
        <div class="modal-dialog">
    		<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title"><?=$popimage['JUDUL']?></h4>
				</div>
				<div class="modal-body">
					<img alt="" src="<?=base_url("asset/popimages/$popimage[GAMBAR]")?>" class="img-responsive" >
				</div>
				<div class="modal-footer" style="text-align:center;">
					<?=$popimage['DESKRIPSI']?>
				</div>
    		</div>
        </div>
    </div>

<?php } ?>


<!-- List Modal -->

<!-- Modal Show Data Nasabah Lapse -->
<div class="modal fade" id="modal_daftar_nasabah_lapse" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Data Nasabah Lapse</h4>
        </div>
      <div class="modal-body">
      <div class="table-responsive">
        <table class="table table-hover" id="tabel_nasabah_lapse">
            <thead>
                <tr>
                    <th class="text-center" width="5%">NO</th>
                    <th class="text-center" width="20%">NO POLIS</th>
                    <th class="text-center" width="10%">NAMA PEMPOL</th>
                    <th class="text-center" width="10%">PRODUK</th>
                    <th class="text-center" width="15%">NO TELP/HP</th>
                    <th class="text-center" width="10%">PREMI</th>
                    <th class="text-center" width="10%">NAMA AGEN</th>
                    <th class="text-center" width="20%">KANTOR REP</th>
                </tr>
            </thead>
           <tbody id="data_nasabah_lapse">

           </tbody>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Data SPAJ Yang Pending -->
<div class="modal fade" id="modal_daftar_spaj_pending" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Data Proposal Pending</h4>
        </div>
      <div class="modal-body">
      <div class="table-responsive">
        <table class="table table-hover" id="tabel_proposal_pending">
            <thead>
                <tr>
                    <th style="text-align:center" width="5%">NO</th>
                    <th style="text-align:center" width="10%">NO PROPOSAL</th>
                    <th style="text-align:center" width="15%">NO POLIS</th>
                    <th style="text-align:center" width="10%">NAMA PEMPOL</th>
                    <th style="text-align:center" width="10%">PRODUK</th>
                    <th style="text-align:center" width="10%">NO TELP/HP</th>
                    <th style="text-align:center" width="5%">PREMI</th>
                    <th style="text-align:center" width="10%">NAMA AGEN</th>
                    <th style="text-align:center" width="10%">KANTOR REP</th>
                    <th style="text-align:center" width="15%">KETERANGAN</th>
                </tr>
           </thead>
           <tbody id="data_spaj_pending">

           </tbody>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="tgl_akhir_lisensi" value="<?php echo strtotime($cd['TGLAKHIRLISENSI']) ?>">
<input type="hidden" id="tgl_setelah_kurang" value="<?php echo strtotime($cd['TGLSETELAHKURANG']) ?>">


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-mixitup/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- load high chart -->
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

<script src="<?= base_url("asset/highcharts/accessibility.js");?>"></script>
<script src="<?= base_url("asset/highcharts/export-data.js");?>"></script>
<script src="<?= base_url("asset/highcharts/exporting.js");?>"></script>
<script src="<?= base_url("asset/highcharts/highcharts.js");?>"></script>
<script src="<?= base_url("asset/highcharts/series-label.js");?>"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript" src="<?= base_url("asset/countdown/js/jquery.plugin.js") ?>"></script> 
<script type="text/javascript" src="<?= base_url("asset/countdown/js/jquery.countdown.js") ?>"></script>

<?php if(in_array($this->session->KDROLE, $kodeJabatanAgen) || $this->session->KDROLE == '1') {?>
<script>
    jQuery(document).ready(function() {
        $("#myCarousel").carousel({
            interval: 5000
        });

        $('.mix-grid').mixitup();
        $( "#btnmodal" ).trigger( "click" );
    });

    function changePopImage(judul, gambar, deskripsi) {
        $(".modal-title").text(judul);
        $(".modal-body img").attr('src', gambar);
        $(".modal-footer").text(deskripsi);
        $( "#btnmodal" ).trigger( "click" );
    }
</script>
<?php } ?>
<script>
    (function($) {
	'use strict';
	$.countdown.regionalOptions.id = {
		labels: ['Tahun','Bulan','Minggu','Hari','jam','menit','detik'],
		labels1: ['Tahun','Bulan','Minggu','Hari','jam','menit','detik'],
		compactLabels: ['Tahun','Bulan','Minggu','Hari'],
		whichLabels: null,
		digits: ['0','1','2','3','4','5','6','7','8','9'],
		timeSeparator: ':',
		isRTL: false
	};
	$.countdown.setDefaults($.countdown.regionalOptions.id);
})(jQuery);
</script>

<!-- Untuk Countdown Lisensi-->
<script>
    var tgl_akhir_lisensi = $('#tgl_akhir_lisensi').val()
    var tgl_setelah_kurang = $('#tgl_setelah_kurang').val()
    //var reminder = $('#remider_tiga_bulan').val()
    var countdown = tgl_akhir_lisensi * 1000
    var now = new Date().getTime()
    var distance = countdown - now
    var test = distance / 1000

    $('#demo').countdown({until: +test, format: 'YOWD', compact: true, layout: 'Lisensi berakhir dalam {yn} {yl} {on} {ol} {wn} {wl} {dn} {dl}'});

    var countdown2 = tgl_setelah_kurang * 1000
    var now2 = new Date().getTime()
    var distance2 = countdown2 - now2
    var test2 = distance2 / 1000

    if(test2 < 0){
        $("#demo").css("background-color", "red")
        $(".strike").css("background-color", "red")

        if( test >= test){
            $("#demo").css("background-color", "red")
            $(".strike").css("background-color", "red")
        }
    }
</script>

<script>

    $(document).ready(function(){

    // $('#tabel_nasabah_lapse').DataTable()
    // $('#tabel_proposal_pending').DataTable()

    $("#nasabah_lapse").click(function(){
    
        $.ajax({
        url     : "<?= base_url('Dashboard/getNasabahLapse')?>",
        type    : "GET",
        success : function(result){

            var data_nasabah_lapse = JSON.parse(result)

            var no = 1
            var html = ''

            $.each(data_nasabah_lapse, function(key,value){

                var NOPOLLAMA = data_nasabah_lapse[key].NOPOLLAMA
                var NOPOLBARU = data_nasabah_lapse[key].NOPOLBARU
                var NAMAPEMPOL = data_nasabah_lapse[key].NAMA_PEMEGANG_POLIS
                var NAMAAGEN = data_nasabah_lapse[key].NAMA_AGEN
                var NAMAKANTOR = data_nasabah_lapse[key].NAMA_KANTOR
                var PREMI = data_nasabah_lapse[key].PREMI1
                var NO_TELP_PEMPOL = data_nasabah_lapse[key].NO_TELP_PEMPOL
                var NO_HP_PEMPOL = data_nasabah_lapse[key].NO_HP_PEMPOL
                var NAMAPRODUK = data_nasabah_lapse[key].NAMAPRODUK
                // var TGL_JATUH_TEMPO = data_nasabah_lapse[key].TGL_JATUH_TEMPO
               

                html += `<tr>
                            <td class="text-center" width="5%">${no++}</td>
                            <td class="text-center" width="20%">${NOPOLLAMA} <br> & <br> ${NOPOLBARU}</td>
                            <td class="text-center" width="10%">${NAMAPEMPOL}</td>
                            <td class="text-center" width="10%">${NAMAPRODUK}</td>
                            <td class="text-center" width="15%">${NO_TELP_PEMPOL} <br> & <br> ${NO_HP_PEMPOL}</td>
                            <td class="text-center" width="10%">${PREMI}</td>
                            <td class="text-center" width="10%">${NAMAAGEN}</td>
                            <td class="text-justify"width="20%">${NAMAKANTOR}</td>
                        </tr>`

            })

                $('#data_nasabah_lapse').html(html)
            }
        })
    })

    $("#spaj_pending").click(function(){
        
        $.ajax({
        url     : "<?= base_url('Dashboard/getSpajPending')?>",
        type    : "GET",
        success : function(result){

            

            var data_spaj_pending = JSON.parse(result)

            var no = 1
            var html = ''

            $.each(data_spaj_pending, function(key,value){

                var NOPOLLAMA = data_spaj_pending[key].NOPOLLAMA
                var NOPOLBARU = data_spaj_pending[key].NOPOLBARU
                var NOMOR_PROPOSAL = data_spaj_pending[key].NO_PROPOSAL
                var NAMAPEMPOL = data_spaj_pending[key].NAMA_PEMEGANG_POLIS
                var NAMAAGEN = data_spaj_pending[key].NAMA_AGEN
                var NAMAKANTOR = data_spaj_pending[key].NAMA_KANTOR
                var PREMI = data_spaj_pending[key].JUMLAH_PREMI
                var NO_TELP_PEMPOL = data_spaj_pending[key].NO_TELP_PEMPOL
                var NO_HP_PEMPOL = data_spaj_pending[key].NO_HP_PEMPOL
                var NAMAPRODUK = data_spaj_pending[key].NAMAPRODUK
                // var TGL_JATUH_TEMPO = data_spaj_pending[key].TGL_JATUH_TEMPO
                var KETERANGAN = data_spaj_pending[key].KETERANGAN
                
                var NOMOR_POLIS = NOPOLLAMA == null && NOPOLBARU == null ? "Data Tidak Ada" : NOPOLLAMA +' <br> & <br> '+ NOPOLBARU

                html += `<tr>
                            <td class="text-center"  width="5%">${no++}</td>
                            <td class="text-center"  width="10%">${NOMOR_PROPOSAL}</td>
                            <td class="text-center"  width="15%">${NOMOR_POLIS}</td>
                            <td class="text-center"  width="10%">${NAMAPEMPOL}</td>
                            <td class="text-center"  width="10%">${NAMAPRODUK}</td>
                            <td class="text-center"  width="10%">${NO_TELP_PEMPOL}</td>
                            <td class="text-center"  width="5%">${PREMI}</td>
                            <td class="text-center"  width="10%">${NAMAAGEN}</td>
                            <td class="text-justify" width="10%">${NAMAKANTOR}</td>
                            <td class="text-justify" width="15%">${KETERANGAN}</td>
                        </tr>`

            })

                $('#data_spaj_pending').html(html)
            }
        })
    })

})
    // jQuery(document).ready(function() {
    //     $("#myCarousel").carousel({
    //         interval: 5000
    //     });

    //     $('.mix-grid').mixitup();
    //     $( "#btnmodal" ).trigger( "click" );
    // });

    // function changePopImage(judul, gambar, deskripsi) {
    //     $(".modal-title").text(judul);
    //     $(".modal-body img").attr('src', gambar);
    //     $(".modal-footer").text(deskripsi);
    //     $( "#btnmodal" ).trigger( "click" );
    // }
</script>

<!-- Untuk Pemanggilan Chart Monitoring Production -->
<script>
var tahun = document.getElementById("tahun").getContext('2d');
var chartTahun = new Chart(tahun, {
    type: 'horizontalBar',
        data: {
          datasets: [
            {
              label: "Chart",
              borderColor: "rgba(116, 185, 255,1.0)",
              borderWidth: "0",
              backgroundColor: "rgba(116, 185, 255,1.0)"
            }
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins",
                min: 0

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
});

$(function(){
    $.get("<?= base_url('dashboard/getChartTahun') ?>",
        function (data) {
            var data_penawaran = [];
    		var data_spaj = [];
    		var data_proposal = [];
    		var data_approval = [];
    		var data_pelunasan = [];
    		var data_polis = [];
    		var data_terkirim = [];
            //var data_label = [];
           var obj = JSON.parse(data);
           $.each(obj, function(test,item) {
             data_penawaran.push(item.JML_PENAWARAN);
    		 data_spaj.push(item.JML_SPAJ);
    		 data_proposal.push(item.JML_PROPOSAL);
    		 data_approval.push(item.JML_APPROVAL);
    		 data_pelunasan.push(item.JML_PELUNASAN);
    		 data_polis.push(item.JML_PELUNASAN);
    		 data_terkirim.push(item.JML_TERKIRIM);
             //data_label.push(item.jobcat);
           });
            chartTahun.data.labels = ['Penawaran','SPAJ','Proposal','Approval','Pelunasan','Polis','Polis Terkirim'];
            chartTahun.data.datasets[0].data = [data_penawaran[0],data_spaj[0],data_proposal[0],data_approval[0],data_pelunasan[0],data_polis[0],data_terkirim[0]];

            chartTahun.update();

    		var penawarantahun = (data_spaj[0]/data_penawaran[0])*100;
    		var pelunasantahun = (data_pelunasan[0]/data_spaj[0])*100;
    		
    		if(isNaN(penawarantahun)) {
    			penawarantahun = 0;
    		}
    		if(isNaN(pelunasantahun)) {
    			pelunasantahun = 0;
    		}
    		$('#penawarantahun').text(penawarantahun.toFixed(2) + '%');
    		$('#pelunasantahun').text(pelunasantahun.toFixed(2) + '%');
    	

    });
});


var bulan = document.getElementById("bulan").getContext('2d');
var chartBulan = new Chart(bulan, {
    type: 'horizontalBar',
        data: {
          datasets: [
            {
              label: "Chart",
              borderColor: "rgba(7, 242, 70)",
              borderWidth: "0",
              backgroundColor: "rgba(7, 242, 70)"
            }
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins",
                min: 0

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
});

$(function(){
$.get("<?= base_url('dashboard/getChartBulan') ?>",
    function (data) {
       var data_penawaran = [];
		var data_spaj = [];
		var data_proposal = [];
		var data_approval = [];
		var data_pelunasan = [];
		var data_polis = [];
		var data_terkirim = [];
        //var data_label = [];
       var obj = JSON.parse(data);
       $.each(obj, function(test,item) {
         data_penawaran.push(item.JML_PENAWARAN);
		 data_spaj.push(item.JML_SPAJ);
		 data_proposal.push(item.JML_PROPOSAL);
		 data_approval.push(item.JML_APPROVAL);
		 data_pelunasan.push(item.JML_PELUNASAN);
		 data_polis.push(item.JML_PELUNASAN);
		 data_terkirim.push(item.JML_TERKIRIM);
         //data_label.push(item.jobcat);
       });
        chartBulan .data.labels = ['Penawaran','SPAJ','Proposal','Approval','Pelunasan','Polis','Polis Terkirim'];
        chartBulan .data.datasets[0].data = [data_penawaran[0],data_spaj[0],data_proposal[0],data_approval[0],data_pelunasan[0],data_polis[0],data_terkirim[0]];

        chartBulan.update();

		var penawaranbulan = (data_spaj[0]/data_penawaran[0])*100;
		var pelunasanbulan = (data_pelunasan[0]/data_spaj[0])*100;
		if(isNaN(pelunasanbulan)) {
			penawaranbulan = 0;
		}
		if(isNaN(pelunasanbulan)) {
			pelunasanbulan = 0;
		}
		$('#penawaranbulan').text(penawaranbulan.toFixed(2) + '%');
		$('#pelunasanbulan').text(pelunasanbulan.toFixed(2) + '%');

});
});


</script>
<!-- END JAVASCRIPTS MONITORING -->

<!-- STATISTIK LOG -->
<script>
var statistikhari = document.getElementById("statistikhari").getContext('2d');
var chartstatistikhari = new Chart(statistikhari, {
    type: 'horizontalBar',
        data: {
          datasets: [
            {
              label: "Chart",
              borderColor: "rgba(116, 185, 255,1.0)",
              borderWidth: "0",
              backgroundColor: "rgba(116, 185, 255,1.0)"
            }
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins",
                min: 0

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
});

$(function(){
$.get("<?= base_url('dashboard/getstatistikDay') ?>",
    function (data) {
        var data_logLogin= [];
		var data_logSpaj = [];
		var data_logPos = [];
       var obj = JSON.parse(data);
       $.each(obj, function(test,item) {
		   
         data_logLogin = item.TOTAL_LOGIN;
		 data_logSpaj = item.TOTAL_SPAJ;
		 data_logpos = item.TOTAL_POS;
       });
        chartstatistikhari .data.labels = ['Login AIM','SPAJ','POS'];
        chartstatistikhari .data.datasets[0].data = [data_logLogin,data_logSpaj,data_logpos];

        chartstatistikhari.update();
	

});
});


var statistiktotal = document.getElementById("statistiktotal").getContext('2d');
var chartstatistiktotal = new Chart(statistiktotal, {
    type: 'horizontalBar',
        data: {
          datasets: [
            {
              label: "Chart",
              borderColor: "rgba(7, 242, 70)",
              borderWidth: "0",
              backgroundColor: "rgba(7, 242, 70)"
            }
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins",
                min: 0

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
});

$(function(){
$.get("<?= base_url('dashboard/getstatistikTotal') ?>",
    function (data) {
		var data_logLogin= [];
		var data_logSpaj = [];
		var data_logPos = [];
       var obj = JSON.parse(data);
       $.each(obj, function(test,item) {
        data_logLogin = item.TOTAL_LOGIN;
		 data_logSpaj = item.TOTAL_SPAJ;
		 data_logpos = item.TOTAL_POS;
       });
        chartstatistiktotal .data.labels = ['Login AIM','SPAJ','POS'];
        chartstatistiktotal .data.datasets[0].data = [data_logLogin,data_logSpaj,data_logpos];

        chartstatistiktotal.update();

});
});


</script>
<!-- END STATISTIK LOG -->

<?php 
//$this->output->enable_profiler(TRUE);
?>