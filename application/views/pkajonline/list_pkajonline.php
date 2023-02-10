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
                        <span class="caption-subject font-green-sharp bold uppercase">Perjanjian Kerja Asuransi Jiwa</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <form>
                    <!-- <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="s" class="form-control" placeholder="Pencarian..." autocomplete="off" value="<?=$this->input->get('s')?>">
                            <span class="input-group-btn">
                                <button class="btn blue tooltips" type="submit" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_SEARCH?>"><i class="fa fa-search"></i></button>
                                <a href="<?=current_url()?>" class="btn grey-cascade tooltips" data-container="body" data-placement="top" data-original-title="<?=C_BUTTON_REFRESH?>"><i class="fa fa-refresh"></i></a>
                            </span>
                        </div>
                    </div> -->
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover" style="font-size: 12px;">
                            <thead>
                            <tr>
                                <th style="text-align:center; vertical-align:middle;">No</th>
                                <th style="text-align:center; vertical-align:middle;">No Agen</th>
                                <th style="text-align:center; vertical-align:middle;">Tgl. PKAJ</th>
                                <th style="text-align:center; vertical-align:middle;">PKAJ</th>
                                <th style="text-align:center; vertical-align:middle;">TT Digital</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($pkaj as $i => $v) { ?>
                                <tr>
                                    <input type="hidden" value="<?=$v['NOPKAJAGEN']?>" id="epkaj" name="epkaj">
                                    <td align="center"><?=$v['NO']?></td>
                                    <td align="center"><?=$v['NOAGEN']?></td>
                                    <td align="center"><?=$v['TGLPKAJAGEN']?></td>
                                    <td align="center">
										<?php if ($v['STATUS'] == '1') { ?>
											<a href="<?="$this->url/cetak_pkajonline?noagen=$v[NOAGEN]&nopkaj=".rawurlencode(strtolower($v['NOPKAJAGEN']))."&tglpkaj=".$v['TGLPKAJAGEN']?>" data-toggle="pkajol" title="Klik untuk melihat tanda tangan digital!">
										<?php } 
											echo $v['NOPKAJAGEN'].'/'."PKAJ".'-KP-'.substr($v['TGLPKAJ'],0,2).substr($v['TGLPKAJ'],-2); 
										if ($v['STATUS'] == '1') { ?>
											</a>
										<?php } ?>
                                    </td>
                                    <td class="text-center" width="95">
										<?php if ($v['STATUS'] == '0') { ?>
										<a href="<?="$this->url/term_pkajonline?noagen=$v[NOAGEN]&nopkaj=".rawurlencode(strtolower($v['NOPKAJAGEN']))."&tglpkaj=".$v['TGLPKAJAGEN']."&name=" . $this->session->NAMALENGKAP . "&iduser=" . $this->session->IDUSER?>" data-toggle="ttd" title="Klik untuk tanda tangan digital!">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
										<?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center">
                        <?=$this->pagination->create_links();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 /*/look for all elements input with name="myProduct" instead of ById
 var productsList = document.getElementsByName('epkaj');
 //you got 1 submit button / product
 var submitButtonsList = document.getElementsByName('submitBtn');
 for (var i = 0; i < productsList.length; i++) {

     console.log("Value of productsList  = " + productsList[i].value);
     if (productsList[i].value > 1) {
         submitButtonsList[i].disabled = true;
         console.log('Dont Disable');
     } else {
         submitButtonsList[i].disabled = false;
         console.log('Disable');
     }
 }


$(document).ready(function(){
    //$('[data-toggle="tooltip"]').ttd();   
});


$(document).ready(function(){
    //$('[data-toggle="tooltip"]').pkajol();   
});*/
</script>
