<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->

<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="javascript:;">Pengaturan</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="<?="$this->url/menu"?>">Menu</a>
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
                        <i class="fa icon-grid font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Urutkan Menu</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                        <div class="form-group col-md-5 col-sm-3">
                            <select class="form-control" name="r">
                                <option value="">Role Menu</option>
                                <?php foreach ($role as $i => $v) {
                                    if ($this->input->get('r') == $v['KDROLE']) {
                                        echo "<option value='$v[KDROLE]' selected>".ucwords(strtolower($v['NAMAROLE']))."</option>";
                                    }
                                    else {
                                        echo "<option value='$v[KDROLE]'>".ucwords(strtolower($v['NAMAROLE']))."</option>";
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-5 col-sm-3">
                            <select class="form-control" name="f">
                                <option value="">Parent Menu</option>
                                <?php foreach ($parent as $i => $v) {
                                    if ($this->input->get('f') == $v['KDMENU']) {
                                        echo "<option value='$v[KDMENU]' selected>".ucwords(strtolower($v['MENU']))."</option>";
                                    }
                                    else {
                                        echo "<option value='$v[KDMENU]'>".ucwords(strtolower($v['MENU']))."</option>";
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-sm-3">
                            <div class="btn-group btn-group-solid pull-right">
                                <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                                <a href="<?="$this->url/pribadi"?>" class="btn purple-wisteria tooltips" type="button" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_BACK?>"><i class="fa fa-undo"></i></a>
                            </div>
                        </div>
                    </form>

                    <div class="clearfix margin-bottom-10"></div>

                    <div class="table-scrollable">
                        <ol class="sortable" style="padding: 0px;">
                            <?php foreach ($menu as $i => $v) {
                                if ($v['KDKATEGORI'] == '1')
                                    echo "<li id='id_$v[KDMENU]' class='btn green-jungle btn-block btn-sm' style='text-align:left;'><i class='fa fa-sort'></i>$v[MENU]</li>";
                                else if ($v['KDKATEGORI'] == '2')
                                    echo "<li id='id_$v[KDMENU]' class='btn purple-plum btn-block btn-sm' style='text-align:left;'><i class='fa fa-sort'></i>$v[MENU]</li>";
                            } ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-sortable.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        $("ol.sortable").sortable();

        // ajax role for menu
        $("select[name='r']").change(function() {
            $.ajax({
                url: "<?="$this->url/ajax-role-menu"?>",
                type: "post",
                data: "id="+this.value,
                success: function (data) {
                    $("select[name='f']").empty();
                    $("select[name='f']").append('<option value="">Parent Menu</option>');
                    for (var i=0; i<data.length; i++) {
                        $("select[name='f']").append('<option value="' + data[i].KDMENU + '">' + data[i].MENU + '</option>');
                    }
                },
                dataType: "json",
            })
        });


        // ajax serialize sortable menu
        $(".sortable").sortable({
            update: function(event, ui) {
                var order = $(".sortable").sortable("serialize");

                $.ajax({
                    type: "POST",
                    url: "<?="$this->url/ajax-save-urutan-menu"?>",
                    data: order,
                    success: function(data) {
                        switch (data) {
                            case "<?=C_STATUS_SUKSES_SIMPAN?>":
                                toastr.success('Oo yeaah, data berhasil disimpan.');
                                break;
                            case "<?=C_STATUS_GAGAL_SIMPAN?>":
                                toastr.error('Oo tidaak, data gagal disimpan.');
                                break;
                        }
                    }
                })
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
    });
</script>
<!-- END JAVASCRIPTS -->