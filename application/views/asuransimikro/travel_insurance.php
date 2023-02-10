<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Asuransi Mikro</a>
            <i class="fa fa-circle"></i>
        </li>
        <li class="active">
            <?=$this->template->title?>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="portlet light">
    	<div class="portlet-body">
	    <div class="row">
		<div class="col-md-12 news-page blog-page">
		    <div class="row">
			<div class="col-md-12 blog-tag-data text-center">
                            <?php
                            $img1 = base_url("asset/img/qrcodebadge.png");
                            $img2 = base_url("generate/qrcode/8?kode=https://solusi.jiwasraya.co.id/jstravelinsurance/?ref=$username");
                            $dstx = 140;
                            $dsty = 230;
                            $srcx = 10;
                            $srcy = 10;
                            $srcw = 385;
                            $srch = 385;
                            $pct = 100;
                            ?>
			    <img src="<?=base_url("generate/mergeimage?img1=$img1&img2=$img2&dstx=$dstx&dsty=$dsty&srcx=$srcx&srcy=$srcy&srcw=$srcw&srch=$srch&pct=$pct")?>" class="img-responsive center-block" alt="">
			    <br>
                            <a href="javascript:void(0);">https://solusi.jiwasraya.co.id/jstravelinsurance/?ref=<?=$username?></a>
                            <br>
			    <button class="margin-top-20 btn blue" type="button" onclick="window.open('https://solusi.jiwasraya.co.id/jstravelinsurance/?ref=<?=$username?>')">Beli <?=$this->template->title?></button>
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>