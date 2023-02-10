<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/css/news.css" rel="stylesheet" type="text/css"/>
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
    <div class="row margin-top-10">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET -->
            <div class="portlet light">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12 news-page blog-page">
                            <div class="row">
                                <div class="col-md-12 blog-tag-data">
                                    <h3 style="margin-top:0">Agen of the Month <?=ucwords(strtolower($aotm['BULAN']))?></h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                        <div class="col-md-6 blog-tag-data-inner">
                                            <ul class="list-inline">
                                                <li>
                                                    <i class="fa fa-calendar"></i>
                                                    <a href="javascript:;">
                                                        <?=$aotm['TGLREKAMID']?> </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="news-item-page">
                                        <p>
                                            <img src="<?=base_url("asset/aotm/$aotm[GAMBAR]")?>" class="img-responsive pull-right" alt=""><?=$aotm['NARASI']?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF BEGIN SAMPLE TABLE PORTLET -->
        </div>
    </div>
</div>