<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/custom-bootbox-modal.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
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
            <a href="<?="$this->url/pribadi"?>">Prospek Saya</a>
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
                        <i class="fa icon-user font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Proposal <?=$prospek['NAMA']?></span>

                    </div>
                </div>
                <div class="portlet-body">
					<form action="<?="$this->url/pribadi"?>" method="get" />
						<div class="form-group">
							<div class="input-group">
								<select name="produk" class="form-control">
									<option value="">Pilih Produk</option>
									<?php foreach($produk as $i => $v) {
										echo "<option value='$v[KDPRODUK]'>$v[NAMAPRODUK]</option>";
									} ?>
								</select>
								<span class="input-group-btn">
									<a href="<?="$this->url/pribadi"?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
									<a href="<?="$this->url/proposal-pribadi?id=$prospek[NOPROSPEK]"?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
									<a href="javascript:void(0);" id="btnProposal" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="Buat Proposal"><i class="fa fa-plus"></i></a>
								</span>
							</div>
						</div>
                    </form>
					
                    <!--div class="btn-group btn-group-solid pull-right">

                        <a href="<?=base_url("simulasi/simulasi_new?kode_prospek=$prospek[NOPROSPEK]")?>" class="btn red-flamingo" type="button" data-container="body" data-placement="top"><i class="fa fa-plus-square"></i> PROPOSAL <b>IFG LIFE PRIME PROTECTION</b> BARU SILAHKAN KLIK DISINI!</a>

                        <a href="<?="$this->url/pribadi"?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                        <a href="<?=base_url("simulasi?kode_prospek=$prospek[NOPROSPEK]")?>" class="btn yellow-casablanca tooltips" data-container="body" data-placement="top" data-original-title="Buat Proposal"><i class="fa fa-plus"></i></a>
                    </div-->

                    <div class="clearfix margin-bottom-10"></div>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Proposal</th>
                                <th style="text-align:center; vertical-align:middle;">Produk</th>
                                <th style="text-align:center; vertical-align:middle;">Cara Bayar</th>
                                <th style="text-align:center; vertical-align:middle;">JUA</th>
                                <th style="text-align:center; vertical-align:middle;">Premi</th>
                                <th style="text-align:center; vertical-align:middle;">Status</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl Rekam</th>
                                <th style="text-align:center; vertical-align:middle;">Opsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($proposal as $i => $v) { ?>
                                <tr>
                                    <td align="center"><?=$i+1?></td>
                                    <td align="center"><?=$v['NOPROPOSAL']?></td>
                                    <td><?=$v['NAMA_PRODUK']?></td>
                                    <td><?=$v['CARA_BAYAR']?></td>
                                    <td align="right"><?=$v['JUA']?></td>
                                    <td align="right"><?=number_format(trim(str_replace(",", ".", $v['JUMLAH_PREMI'])), 0, ",", ".")?></td>
                                    <td align="center"><?=$v['NAMASTATUS']?></td>
                                    <td align="center"><?=$v['TGLREKAM']?></td>
                                    <td class="text-center" width="95">
                                        <a href="<?="$this->url/follow-up-proposal?r=$prospek[NOPROSPEK]&id=$v[NOPROPOSAL]"?>" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="Follow Up"><i class="fa fa-search-plus btn-xs-tbl"></i></a>
                                        <a href="#" onClick="openWin('<?=base_url("simulasi/cetak?bid=$v[NOPROPOSAL]");?>')" class="btn btn-xs blue tooltips" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_VIEW?>"><i class="fa fa-file-pdf-o btn-xs-tbl"></i></a>
                                        <?php if ($v['KDSTATUS'] < 3) { ?>
                                        <a class="btn btn-xs red-flamingo tooltips btn-delete" data-value="<?=$v['NOPROPOSAL']?>" style="margin:0px;" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_DELETE?>"><i class="fa fa-trash-o btn-xs-tbl"></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="<?=base_url()?>asset/plugin/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        $("input[name='s']").focus();

        $('.btn-delete').click(function () {
            var noproposal = $(this).attr('data-value');
            bootbox.confirm({
                size: 'small',
                message: 'Yakin hapus data?',
                callback: function (result) {
                    if (result)
                        window.location.href = "<?="$this->url/delete-proposal-pribadi?id="?>" + noproposal;
                }
            });
        });
		
		$('#btnProposal').click(function() {
			var kdproduk = $("select[name='produk'] option:selected").val();
			
			if (kdproduk) {
				window.location.href = '<?=base_url("simulasi/produk?id=")?>'+ kdproduk + '<?="&noprospek=$prospek[NOPROSPEK]"?>';
			} else {
				bootbox.alert("Anda belum memilih produk!");
			}
		});

        /*===== toastr notification =====*/
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "showMethod": "fadeIn"
        };

        if ("<?=$status?>" == "<?=C_STATUS_SUKSES_SIMPAN?>")
            toastr.success('Oo yeaah, data berhasil disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_SIMPAN?>")
            toastr.error('Oo tidaak, data gagal disimpan.');
        else if ("<?=$status?>" == "<?=C_STATUS_SUKSES_HAPUS?>")
            toastr.success('Oo yeaah, data berhasil dihapus.');
        else if ("<?=$status?>" == "<?=C_STATUS_GAGAL_HAPUS?>")
            toastr.error('Oo tidaak, data gagal dihapus.');
        /*===== end of toastr notification =====*/
    });
	
	function popitup(url) {
		newwindow=window.open(url,'name','height=768,width=1366, menubar=no, scrollbars=no, resizable=yes, copyhistory=no,');
		if (window.focus) {newwindow.focus()}
		return false;
	}
	
	function openWin(url, reload = false) {
        var w  = window.screen.availWidth * 90 / 100, h = window.screen.availHeight * 60 / 100;
        var l  = (screen.width/2)-(w/2), t = (screen.height/2)-(h/2);
        window.open(url, "popup", "width="+w+", height="+h+", directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no, scrollbars=yes, left="+l+", top="+t);

        if (reload)
            location.reload();
    }
</script>