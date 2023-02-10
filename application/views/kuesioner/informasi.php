<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/error.css"/>
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li class="active">
            Informasi
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="row">
        <div class="col-md-12 page-404">
            <div class="number">
                <?=($status == C_STATUS_SUKSES_SIMPAN ? 'O, Yea' : 'O, Noo')?>
            </div>
            <div class="details">
                <h3><?=($status == C_STATUS_SUKSES_SIMPAN ? 'Data berhasil disimpan' : 'Data gagal disimpan')?></h3>
                <p>
                    <?=($status == C_STATUS_SUKSES_SIMPAN ?
                        "Semoga masukan dan saran yang Anda berikan,<br>dapat membangun JAiM lebih baik lagi.<br>".
                        "Kembali ke halaman <a href='".base_url()."'>beranda</a>"
                    :
                        "Maaf data tidak berhasil disimpan,<br>".
                        "Silahkan coba kembali<br>Klik <a href='$this->url/index/$this->idgroup'>disini</a> untuk mengulang kuesioner"
                    )?>
                </p>
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
<!-- BEGIN PAGE CONTENT -->