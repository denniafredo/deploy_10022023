<?php echo $_header; 
//phpinfo();

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Connection: close");
	
?>
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!--div class="clearfix">
</div-->
<!-- BEGIN CONTAINER -->
<div class="page-container">
	
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>js
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER ->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
							 THEME COLOR
						</span>
						<ul>
							<li class="color-black current color-default" data-style="default">
							</li>
							<li class="color-blue" data-style="blue">
							</li>
							<li class="color-brown" data-style="brown">
							</li>
							<li class="color-purple" data-style="purple">
							</li>
							<li class="color-grey" data-style="grey">
							</li>
							<li class="color-white color-light" data-style="light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
							 Layout
						</span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Header
						</span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar
						</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Sidebar Position
						</span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
							 Footer
						</span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title"  align="center">
					<img src="<?= base_url();?>assets/img/jspos.jpg"/> <small>Power on Sales</small>
					</h3>
					
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<?php
				$NoProspek =$this->input->get('kode_prospek');
				$DataAgen = $this->ModSimulasi->GetDataAgen($NoProspek);
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title" align="center">
							<div class="caption">
								<i class="fa fa-reorder"></i> Simulasi Produk -
								<span class="step-title">
									 Tahap 1 dari 3
								</span>
							</div>
							<div class="tools hidden-xs">
								<!--
                                <a href="javascript:;" class="collapse">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
                                -->
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form">
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li>
												<a href="#tab1" data-toggle="tab" class="step">
													<span class="number">
														 1
													</span>
													<span class="desc">
														<i class="fa fa-check"></i> Data Diri
													</span>
												</a>
											</li>
											<li>
												<a href="#tab2" data-toggle="tab" class="step">
													<span class="number">
														 2
													</span>
													<span class="desc">
														<i class="fa fa-check"></i> Pilih Produk
													</span>
												</a>
											</li>
											<li>
												<a href="#tab3" data-toggle="tab" class="step active">
													<span class="number">
														 3
													</span>
													<span class="desc">
														<i class="fa fa-check"></i> Simulasi
													</span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>
										<div class="tab-content">
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												You have some form errors. Please check below.
											</div>
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>
											<div class="tab-pane active" id="tab1">
												<h3 class="block">Data Diri</h3>
												<div class="form-group">
													<label class="control-label col-md-3">Nama Lengkap
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<input readonly type="text" class="form-control" name="namalengkap" id="namalengkap" value="<?= $DataAgen['NAMA']; ?>"/>
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Alamat
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<input readonly type="text" class="form-control" name="alamat" id="alamat"  value="<?= $DataAgen['ALAMAT']; ?>"/>
														
													</div>
													
													
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Kota
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<input readonly type="text" class="form-control" name="kota" id="kota"  value="<?= $DataAgen['KOTA']; ?>"/>
														<span class="help-block">
														</span>
													</div>
													
													
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Provinsi
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<select name="provinsi" class="form-control" id="provinsi">
															<option readonly value="">---Pilih Provinsi---</option>
															<?php 
																$KodeProvinsi = $DataAgen['KDPROVINSI'];
																$Provinsi = $this->ModSimulasi->GetDataProvinsi($KodeProvinsi);
															
																foreach($provinsis as $provinsi=>$key){
																
															?>
																<option readonly value="<?= $provinsi; ?>" <? if($DataAgen['KDPROVINSI']==$provinsi){?> selected="" <? }?>><?= $key; ?>
                                                                </option>
															<?php } ?>
														</select>
													</div>
													
													
												</div>
												<div class="form-group">
													<label class="control-label col-sm-3">Tanggal Lahir<span class="required">
														 *
													</span></label>
													
													<div class="col-md-4">
														<input readonly class="form-control form-control-inline input-small date-picker" id="tanggallahir" name="tanggallahir" size="16" type="text" value="<?= date("m/d/Y", strtotime($DataAgen['TGLLAHIR'])); ?>"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Jenis Kelamin
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<div class="radio-list">
															<label>
															<? 			
																if($DataAgen['JENISKELAMIN']=='M')
																{
															?> 
															<input readonly type="radio" name="gender" value="M" id="gender" data-title="Male" 
															checked='true' disabled />
															Pria 
															</label>
															<label>
															<?
																}
																else if($DataAgen['JENISKELAMIN']=='F')
																{
															?>
															<input readonly type="radio" name="gender" value="F" id="gender" data-title="Female"
															 checked='true' disabled />
															Wanita 
															</label>
															<?
																}
																else
																{
															?>
															<input readonly type="radio" name="gender" value="M" id="gender" data-title="Male" 
															checked='false' disabled />
															Pria 
															<input readonly type="radio" name="gender" value="F" id="gender" data-title="Female"
															 checked='false' disabled />
															Wanita 
															</label>
															<?
																}
															?>
														</div>
														<div id="form_gender_error">
														</div>
													</div>
												</div>
												
												<div class="form-group">
													<label class="control-label col-md-3">Jenis Pekerjaan
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<input readonly type="hidden" class="form-control" name="kdjnspekerjaanpemegangpolis" id="kdjnspekerjaanpemegangpolis" value="<?= $DataAgen['KDJENISPEKERJAAN']; ?>"/>
														<input readonly type="text" class="form-control" name="pekerjaanpemegangpolis" id="pekerjaanpemegangpolis" value="<?= $DataAgen['NAMAPEKERJAAN']; ?>"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Nomor Telepon / Handphone
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-2">
														<input readonly type="text" class="form-control" name="phone" id="phone" value="<?= strval($DataAgen['TELP']) ; ?>"/>
													</div>
                                                    <div class="col-md-1" align="center">
														<label class="control-label col-md-3">/
														</label>
													</div>
                                                    <div class="col-md-2">
														<input readonly type="text" class="form-control" name="handphone" id="handphone" value="<?= strval($DataAgen['HP']) ; ?>"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Email
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<input readonly type="text" class="form-control" name="email" id="email" value="<?= $DataAgen['EMAIL']; ?>"/>
													</div>
												</div>
												<!--div class="form-group">
													<label class="control-label col-md-3">Pekerjaan
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<input readonly type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?= $DataAgen['KDJENISPEKERJAAN']; ?>"/>
													</div>
												</div-->
												<input type="hidden" class="form-control" name="sessionid" id="sessionid" value="<?= $session_id; ?>"/>
												<input type="hidden" class="form-control" name="kodekantor" id="kodekantor" value="<?= $this->uri->segment(3); ?>"/>
												<input type="hidden" class="form-control" name="namaagen" id="namaagen" value="<?= $this->uri->segment(4); ?>"/>
												<input type="hidden" class="form-control" name="nomoragen" id="nomoragen" value="<?= $DataAgen['NOAGEN']; ?>"/>
												<input type="hidden" class="form-control" name="kodeprospek" id="kodeprospek" value="<?= $this->input->get('kode_prospek'); ?>"/>
											</div>
											<div class="tab-pane" id="tab2">
												<h3 class="block">Produk</h3>
												<div class="form-group">
													<label class="control-label col-md-3">Produk
													<span class="required">
														 *
													</span>
													</label>
													<div class="col-md-4">
														<select name="provinsi" class="form-control" id="productChange">
															<option value="">---Pilih Produk---</option>
															<?php 
																foreach($products as $product=>$key){
															?>
																<option value="<?= $product; ?>"><?= $key; ?></option>
															<?php } ?>
														</select>
														
														<span class="help-block">
															 Pilih Produk
														</span>
													</div>
													
													
												</div>
												<div id="ciudad">
													
													<?php echo $_content; ?>
													
												</div>
												<input type="hidden" class="form-control" name="idproduk" id="idproduk" />
												<input type="hidden" class="form-control" name="produkid" id="produkid" />
												<input type="hidden" class="form-control" name="namanasabah" id="namanasabah"/>
												<input type="hidden" class="form-control" name="alamatnasabah" id="alamatnasabah"/>
												<input type="hidden" class="form-control" name="kotanasabah" id="kotanasabah"/>
												<input type="hidden" class="form-control" name="provinsinasabah" id="provinsinasabah"/>
												<input type="hidden" class="form-control" name="lahirnasabah" id="lahirnasabah"/>
												<input type="hidden" class="form-control" name="gendernasabah" id="gendernasabah"/>
												<input type="hidden" class="form-control" name="telponnasabah" id="teleponnasabah"/>
												<input type="hidden" class="form-control" name="emailnasabah" id="emailnasabah"/>
												<input type="hidden" class="form-control" name="sessionnasabah" id="sessionnasabah"/>
												<input type="hidden" class="form-control" name="kdkantor" id="kdkantor"/>
												<input type="hidden" class="form-control" name="nmagen" id="nmagen"/>
												<input type="hidden" class="form-control" name="nmragen" id="nmragen"/>
												<input type="hidden" class="form-control" name="kdprospek" id="kdprospek"/>
											</div>
											<div class="tab-pane" id="tab3">
												<div id="hasil">
												<?php //echo $_hasil; ?>
                                                <p>Mohon Tunggu</p>
												</div>
											</div>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-offset-3 col-md-9">
													<?php 
													$str = str_replace("/simulasi/", "", base_url());
													
													?>
                                                    <a href="<?php echo $str;?>/prospek/proposal-pribadi?id=<?php echo $NoProspek; ?>" class="btn green button-kembali">
														 Halaman Prospek <i class="m-icon-swapleft m-icon-white"></i>
													</a>
                                                    <a href="javascript:;" class="btn default button-previous">
														<i class="m-icon-swapleft"></i> Kembali
													</a>
													<a href="javascript:;" class="btn blue button-next" id="berikutnya" name="berikutnya">
														 Tahapan Berikutnya <i class="m-icon-swapright m-icon-white"></i>
													</a>
                                                    <?php 
													$str = str_replace("/simulasi/", "", base_url());
													
													?>
													<a href="<?php echo $str;?>/prospek/proposal-pribadi?id=<?php echo $NoProspek; ?>" class="btn green button-submit">
														 Halaman Prospek <i class="m-icon-swapright m-icon-white"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
            	
		</div>
	</div>
	<!-- END CONTENT -->
</div>

<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<!-- Begin page content -->
                <div class="container">
                    
                    <div class="row">
                        <div class="col-lg-6 col-sm-4 col-xs-12"> 
                        <h4 align="center" style="color:#FFFFFF">Terintegrasi Dengan</h4>
                        	<?php 
							$str = str_replace("/simulasi/", "", base_url());
							
							?>
                            <a href="<?php echo $str;?>" class="thumbnail">
                            <img height="250" width="250" src="<?= base_url();?>assets/img/jaim_logo.png" class="img-responsive img-rounded"/>
                            </a>
                        </div>
                        <div class="col-lg-6 col-sm-4 col-xs-12"> 
                        <h4 align="center" style="color:#FFFFFF">Dikembangkan Oleh</h4>
                            <a class="thumbnail">
                                <img height="250" width="250" src="<?= base_url();?>assets/img/logo_ti.png" class="img-responsive img-rounded"/>
                            </a>
                        </div>
                    </div>
                </div>
	<div class="footer-inner" align="center">
		 Copyright © 2019 Divisi Teknologi Informasi IFG Life - All Rights Reserved.
	<div class="footer-tools">
		<span class="go-top">
			<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?= base_url();?>assets/plugins/respond.min.js"></script>
<script src="<?= base_url();?>assets/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?= base_url();?>assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?= base_url();?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?= base_url();?>assets/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<!-- <script src="<?= base_url();?>assets/scripts/core/app.js"></script> -->

<!-- Untuk app.js tidak bisa diakses jadi dipindah directory - Teguh 09/12/2019 -->
<script type="text/javascript" src="<?= base_url();?>assets/jscore/app.js"></script>


<!-- <script type="text/javascript" src="<?= base_url();?>assets/scripts/core/app.js"></script> -->
<!--script src="<?= base_url();?>assets/scripts/custom/form-wizard.js"></script-->
<script type="text/javascript">
	var dataNasabah = {};
	var dataHitung = {};
	var dataReal = {};
	//var controller;
	
	var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //account
                    namalengkap: {
                        minlength: 2,
                        required: true
                    },
                    namaanak: {
                        minlength: 2,
                        required: true
                    },
                   
                    premisekaligusextraincome:{
                    	required:true,
                    	min:50000000,
                    	number:true,
						pattern: /^(\d+|\d+,\d{1,2})$/
                    },
                    premisekaligus7:{
                    	required:true,
                    	min:5000000,
                    	number:true
                    },
                     uangasuransi:{
                    	required:true,
                    	number:true
                    },
                    premisekaligus8:{
                    	required:true,
                    	min:50000000,
                    	number:true
                    },
                    usiaanak:{
                    	required:true,
                    	min:5,
                    	max:10,
                    	number:true
                    },
                    usiaortu:{
                    	required:true,
                    	min:18,
                    	max:60
                    	//number:true
                    },
                    medical:{
                    	required:true
                    },
                     premisekaligus9:{
                    	required:true,
                    	min:100000000,
                    	number:true
                    },
                    masaasuransi:{
                    	required:true
                    },
                     mulas:{
                    	required:true
                    },
                    password: {
                        minlength: 5,
                        required: true
                    },
                    rpassword: {
                        minlength: 5,
                        required: true,
                        equalTo: "#submit_form_password"
                    },
                    //profile
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    alamat: {
                        required: true
                    },
                    kota: {
                        required: true
                    },
                    tanggallahir: {
                        required: true,
                        date:true
                    },
                    city: {
                        required: true
                    },
                    phone: {
                        required: true,
                        number:true
                    },
                    country: {
                        required: true
                    },
                    provinsi: {
                        required: true
                    },
                    //payment
                    card_name: {
                        required: true
                    },
                    card_number: {
                        minlength: 16,
                        maxlength: 16,
                        required: true
                    },
                    card_cvc: {
                        digits: true,
                        required: true,
                        minlength: 3,
                        maxlength: 4
                    },
                    card_expiry_date: {
                        required: true
                    },
                    'payment[]': {
                        required: true,
                        minlength: 1
                    },
					
					//unitlink
					carabayar: {
                        required: true
                    },
					premisesuaicarabayar: {
                        required: true
                    },
					masapembpremi: {
                        required: true
                    },
					asumsinab: {
                        required: true
                    },
					selama: {
                        required: true
                    },
					usia: {
						required: true
					},
					
					//JS PRO IDAMAN
					namalengkapcalontertanggung: {
						required: true
					},
					jeniskelamincalontertanggung: {
						required: true
					},
					tanggallahircalontertangggung: {
						required: true
					},
					calontertanggungperokok: {
						required: true
					},
					carabayar:	{
						required: true
					},
					uangpertanggungan: {
						required: true
					},
					matauang: {
						required: true
					},
					premisingle: {
						required: true
					},
					totalpremiyangdibayar: {
						required: true
					},
					alokasidana1: {
						required: true
					},
					
					// JS SIHARTA
					besarpremi:	{
						required: true
					},
					uangasuransi:	{
						required: true
					},
					saatmulaiasuransi:	{
						required: true
					},
					
					// JS DWIGUNA
					uangasuransipokok:	{
						required: true
					},
					statusmedical:	{
						required: true
					},
					
					// JS ANUITAS
					pensiunditentukan:	{
						required: true
					},
					statuskawin:	{
						required: true
					},
					
					// JS ANUITAS NEW
					saatmulaiasuransijsanuitas:	{
						required: true
					},
					pilihananuitas:	{
						required: true
					},
					premisekaligusjsanuitas:	{
						required: true
					},
					
					
					//JL-3
					namacalontertanggung: {
						required: true
					},
					juatl1tl2: {
						required: true
					},
					masapemb: {
						required: true
					},
					asumsinilainab: {
						required: true
					},
					topupberkala: {
						required: true
					},
					topupsekaligus: {
						required: true
					},
					masatopupsekaligus: {
						required: true
					},
					totalpremisesuaicarabayar: {
						required: true
					},
					kesanggupanbayar: {
						required: true
					},
					
					//JS KELANGSUNGAN PENDIDIKAN
					spp: {
						required: true
					},
					masaasuransijskelangsunganpendidikan: {
						required: true
					},
					jumlahrisikoawaljskelangsunganpendidikan: {
						required: true
					},
					premisekaligusjskelangsunganpendidikan: {
						required: true
					},
					carabayarpremijskelangsunganpendidikan: {
						required: true
					},
					
					//JS PROTEKSI KELUARGA
					uangasuransipertahunjsproteksikeluarga: {
						required: true
					},
					premitahunanjsproteksikeluarga: {
						required: true
					},
					premisekaligusjsproteksikeluarga: {
						required: true
					},
					masaasuransijsproteksikeluarga: {
						required: true
					},
					mulaiasuransijsproteksikeluarga: {
						required: true
					},
					
					//JS SIN3RGY
					pilihanpaketbenefit: {
						required: true
					},
					mulaiasuransi: {
						required: true
					},
					masaasuransijssin3rgy: {
						required: true
					},
					carabayarpremi: {
						required: true
					},
					premijsremaja: {
						required: true
					},
					masapembayaranpremi: {
						required: true
					},
					
					
					//PAKET PROTEKSI UNTUK KELUARGA
					
					//AYAH
					namajsgajiterusanplatinum: {
						required: true
					},
					tanggallahirjsgajiterusanplatinum: {
						required: true
					},
					gajijsgajiterusanplatinum: {
						required: true
					},
					masasuransijsgajiterusanplatinum: {
						required: true
					},
					premijsgajiterusanplatinum: {
						required: true
					},
					
					//IBU
					namaibujssiharta: {
						required: true
					},
					usiajssiharta: {
						required: true
					},
					premibulananjssiharta: {
						required: true
					},
					
					//ANAK KE-1
					
					//ANAK KE-2
					
					//AKDP (ASURANSI KECELAKAAAN DIRI PERSEORANGAAN)
					uangasuransiakdp: {
						required: true
					},
					jenisplan: {
						required: true
					},
					masaasuransiakdp: {
						required: true
					},
					kelasrisiko: {
						required: true
					},
					premiakdp: {
						required: true
					},
					
					//ASKRED
					uangasuransiaskred: {
						required: true
					},
					premiaskred: {
						required: true
					},
					masaasuransiaskred: {
						required: true
					},
					
					
					//JS PNS 
					statusjspns: {
						required: true
					},
					pensiunperbulanjspns: {
						required: true
					},
					masapembayaranpremijspns: {
						required: true
					},
					carabayarpremijspns: {
						required: true
					},
					premijspns: {
						required: true
					},
					
//					JS SAVING PLAN
					pilihanproduk: {
						required: true
					},
					usiacalontertanggung: {
						required: true
					},
					premisekaligus: {
						required: true
					},
					nilaitunai1: {
						required: true
					},
					nilaitunai2: {
						required: true
					},
					nilaitunai3: {
						required: true
					},
					nilaitunai4: {
						required: true
					},
					nilaitunai5: {
						required: true
					},
					
					manfaatmeninggaldunia1: {
						required: true
					},
					manfaatmeninggaldunia2: {
						required: true
					},
					manfaatmeninggaldunia3: {
						required: true
					},
					manfaatmeninggaldunia4: {
						required: true
					},
					manfaatmeninggaldunia5: {
						required: true
					},
					
					totalmanfaat1: {
						required: true
					},
					totalmanfaat2: {
						required: true
					},
					totalmanfaat3: {
						required: true
					},
					totalmanfaat4: {
						required: true
					},
					totalmanfaat5: {
						required: true
					},
					
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.format("Please select at least one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function() {
                $('#tab3 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment') {
                        var payment = [];
                        $('[name="payment[]"]').each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }
            
            var displayNasabah = function(){
            	$('#tab2 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment') {
                        var payment = [];
                        $('[name="payment[]"]').each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }
            
            var copyNasabah = function(){
            	
            	
            	var formData = {  
                        nama: $('#namalengkap').val(),  
                        alamat: $('#alamat').val(),  
                        kota: $('#kota').val(),  
                        provinsi: $('#provinsi option:selected').val(),  
                        email: $('#email').val(), 
                        telp: $('#phone').val(), 
                        tgl_lahir: $('#tanggallahir').val(), 
                        jenis_kel: $('#gender:checked').val(), 
                        sessionid: $('#sessionid').val(),
						namaagen: $('#namaagen').val(),
						nomoragen: $('#nomoragen').val(),
						kodekantor: $('#kodekantor').val(),
						kodeprospek: $('#kodeprospek').val()
                         
                    };  
                
                //alert(formData['nama']);
                
                namanasabah = document.getElementById('namanasabah');
                namanasabah.value = formData['nama'];
                
                alamatnasabah = document.getElementById('alamatnasabah');
                alamatnasabah.value = formData['alamat'];  
                
                kotanasabah = document.getElementById('kotanasabah');
                kotanasabah.value = formData['kota'];
                
                provinsinasabah = document.getElementById('provinsinasabah');
                provinsinasabah.value = formData['provinsi'];
                
                emailnasabah = document.getElementById('emailnasabah');
                emailnasabah.value = formData['email'];
                
                teleponnasabah = document.getElementById('teleponnasabah');
                teleponnasabah.value = formData['telp'];
                
                lahirnasabah = document.getElementById('lahirnasabah');
                lahirnasabah.value = formData['tgl_lahir'];
                
                gendernasabah = document.getElementById('gendernasabah');
                gendernasabah.value = formData['jenis_kel'];
                
                sessionnasabah = document.getElementById('sessionnasabah');
                sessionnasabah.value = formData['sessionid'];   
				
				kdkantor = document.getElementById('kdkantor');
                kdkantor.value = formData['kodekantor']; 
				
				nmagen = document.getElementById('nmagen');
                nmagen.value = formData['namaagen']; 
				
				nmragen = document.getElementById('nmragen');
                nmragen.value = formData['nomoragen']; 
				
				kdprospek = document.getElementById('kdprospek');
                kdprospek.value = formData['kodeprospek']; 
            }
            
            var dataAsuransi = function(){
            	var controller = $('#produkid').val();
            	//alert(controller);
            	if(controller=='optima7' || controller=='optima8' || controller=='optima9'){
            		 var formHitung = {  
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
					 
                        premisekaligus: $('#premisekaligus').val(),  
                        masaasuransi: $('#masaasuransi option:selected').val(),  
                        mulas: $('#mulas').val(), 
                        proteksi: $('#alokasiproteksi').val(), 
                        uangasuransi: $('#uangasuransi').val(),
                        nomeragen: $('#nomeragen').val(),
                        namaagen: $('#namaagen').val(),
                        bunganett: $('#bunganett').val(),
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						kodeprospek: $('#kdprospek').val(),
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                    }; 
               }
			   else if(controller=='prestasi'){
               	 var formHitung = {  
				 
					hubungandenganpempol: $('#hubungandenganpempol').val(),
					namalengkapcalontertanggung: $('#namalengkapcalontertanggung').val(),
					jeniskelamincalontertanggung: $('#jeniskelamincalontertanggung').val(),
					tanggallahircalontertangggung: $('#tanggallahircalontertangggung').val(),
					tertanggungsamadenganpemegangpolis: $('#tertanggungsamadenganpemegangpolis').val(),
				 
               		namaanak: $('#namaanak').val(),
               		usiaanak: $('#usiaanak').val(),
               		
               		medical: $('#medical').val(),
               		mulas: $('#mulas').val(),
               		uangasuransi: $('#uangasuransi').val(),
               		nomeragen: $('#nomeragen').val(),
                    namaagen: $('#namaagen').val(),
                    modul : controller,
                    idproduk : $('#idproduk').val(),
					kodeprospek: $('#kdprospek').val(),
					 
					carabayarjsprestasi: $('#carabayarjsprestasi').val(),
					
					tabelpremisekaligus: $('#tabelpremisekaligus').val(),
					tabelpremicicil5tahun: $('#tabelpremicicil5tahun').val(),
					tabelpremicicil10tahun: $('#tabelpremicicil10tahun').val(),
					tabelpremicicil10tahuntahun2berikutnya: $('#tabelpremicicil10tahuntahun2berikutnya').val(),
					tabelpremitahunan: $('#tabelpremitahunan').val(),
					tabelpremitahunantahun2berikutnya: $('#tabelpremitahunantahun2berikutnya').val(),
					tabelpremisemesteran: $('#tabelpremisemesteran').val(),
					tabelpremikuartalan: $('#tabelpremikuartalan').val(),
					tabelpremibulanan: $('#tabelpremibulanan').val(),

                    ajax:1  
                  };
               }
			   else if(controller=='extraincome'){
               		var formHitung = {  
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
                        premisekaligus: $('#premisekaligus').val(),  
                        mulas: $('#mulas').val(), 
                        nomeragen: $('#nomeragen').val(),
                        namaagen: $('#namaagen').val(),
                        bunganett: $('#bunganett').val(),
                        bungatabungan: $('#bungatabungan').val(),
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						kodeprospek: $('#kdprospek').val(),
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                    }; 
               }
			   else if(controller=='linkequityfund'){
            		var formHitung = {   
                        saatmulaiunitlink: $('#saatmulaiunitlink').val(), 
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						topupberkalaunitlink : $('#topupberkalaunitlink').val(),
						topupsekaligusunitlink : $('#topupsekaligusunitlink').val(),
						masapembpremi : $('#masapembpremi').val(),
						dibuatunitlink : $('#dibuatunitlink').val(),
						idproduk : $('#idproduk').val(),
						carabayar : $('#carabayar').val(),
						asumsinab : $('#asumsinab').val(),
						juatl : $('#juatl').val(),
						juaterm : $('#juaterm').val(),
						juapa : $('#juapa').val(),
						juaci : $('#juapa').val(),
						juactt : $('#juactt').val(),
						juawp : $('#juawp').val(),
						juacpm : $('#juacpm').val(),
						juacpb : $('#juacpb').val(),
			
						totalpremisesuaicarabayarunitlink : $('#totalpremisesuaicarabayarunitlink').val(),
						premitambahanterm : $('#premitambahanterm').val(),
						premitambahanpa : $('#premitambahanpa').val(),
						premitambahanci : $('#premitambahanci').val(),
						premitambahanctt : $('#premitambahanctt').val(),
						premitambahanwp : $('#premitambahanwp').val(),
						premitambahancpm : $('#premitambahancpm').val(),
						premitambahancpb : $('#premitambahancpb').val(),
						
						namaagen : $('#namaagen').val(),
						nomeragen : $('#nomeragen').val(),
						
						selama : $('#selama').val(),
						
						premisesuaicarabayar : $('#premisesuaicarabayar').val(),
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='linkbalancedfund'){
            		var formHitung = {   
                        saatmulaiunitlink: $('#saatmulaiunitlink').val(), 
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						topupberkalaunitlink : $('#topupberkalaunitlink').val(),
						topupsekaligusunitlink : $('#topupsekaligusunitlink').val(),
						masapembpremi : $('#masapembpremi').val(),
						dibuatunitlink : $('#dibuatunitlink').val(),
						idproduk : $('#idproduk').val(),
						carabayar : $('#carabayar').val(),
						asumsinab : $('#asumsinab').val(),
						juatl : $('#juatl').val(),
						juaterm : $('#juaterm').val(),
						juapa : $('#juapa').val(),
						juaci : $('#juapa').val(),
						juactt : $('#juactt').val(),
						juawp : $('#juawp').val(),
						juacpm : $('#juacpm').val(),
						juacpb : $('#juacpb').val(),
			
						totalpremisesuaicarabayarunitlink : $('#totalpremisesuaicarabayarunitlink').val(),
						premitambahanterm : $('#premitambahanterm').val(),
						premitambahanpa : $('#premitambahanpa').val(),
						premitambahanci : $('#premitambahanci').val(),
						premitambahanctt : $('#premitambahanctt').val(),
						premitambahanwp : $('#premitambahanwp').val(),
						premitambahancpm : $('#premitambahancpm').val(),
						premitambahancpb : $('#premitambahancpb').val(),
						
						namaagen : $('#namaagen').val(),
						nomeragen : $('#nomeragen').val(),
						
						selama : $('#selama').val(),
						
						premisesuaicarabayar : $('#premisesuaicarabayar').val(),
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='linkfixedincome'){
            		var formHitung = {   
                        saatmulaiunitlink: $('#saatmulaiunitlink').val(), 
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						topupberkalaunitlink : $('#topupberkalaunitlink').val(),
						topupsekaligusunitlink : $('#topupsekaligusunitlink').val(),
						masapembpremi : $('#masapembpremi').val(),
						dibuatunitlink : $('#dibuatunitlink').val(),
						idproduk : $('#idproduk').val(),
						carabayar : $('#carabayar').val(),
						asumsinab : $('#asumsinab').val(),
						juatl : $('#juatl').val(),
						juaterm : $('#juaterm').val(),
						juapa : $('#juapa').val(),
						juaci : $('#juapa').val(),
						juactt : $('#juactt').val(),
						juawp : $('#juawp').val(),
						juacpm : $('#juacpm').val(),
						juacpb : $('#juacpb').val(),
			
						totalpremisesuaicarabayarunitlink : $('#totalpremisesuaicarabayarunitlink').val(),
						premitambahanterm : $('#premitambahanterm').val(),
						premitambahanpa : $('#premitambahanpa').val(),
						premitambahanci : $('#premitambahanci').val(),
						premitambahanctt : $('#premitambahanctt').val(),
						premitambahanwp : $('#premitambahanwp').val(),
						premitambahancpm : $('#premitambahancpm').val(),
						premitambahancpb : $('#premitambahancpb').val(),
						
						namaagen : $('#namaagen').val(),
						nomeragen : $('#nomeragen').val(),
						
						selama : $('#selama').val(),
						
						premisesuaicarabayar : $('#premisesuaicarabayar').val(),
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='jssiharta'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						besarpremi : $('#besarpremi').val(),
						uangasuransi : $('#uangasuransi').val(),
						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
						
						carabayar : $('#carabayar').val(),
					
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						
						uangasuransitermjssiharta: $('#uangasuransitermjssiharta').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
				else if(controller=='jsretirementassurance'){
					var formHitung = {   
						modul : controller,
						idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),

						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),

						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						besarpremi : $('#besarpremi').val(),
						uangasuransi : $('#uangasuransi').val(),
						saatmulaiasuransi : $('#saatmulaiasuransi').val(),

						carabayar : $('#carabayar').val(),

						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),

						uangasuransitermjssiharta: $('#uangasuransitermjssiharta').val(),
						//kantorcabang : $('#kantorcabang').val(),

						ajax:1  
						//sessionid: $('#sessionid').val(), 
					};   
				}
			    else if(controller=='jsanuitas'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						uangasuransipokok : $('#uangasuransipokok').val(),
						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
					
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
						statuskawin: $('#statuskawin').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   /*
			   else if(controller=='jsplanannuityassurance'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),						
						
						statuskawin: $('#statuskawin').val(),

						saatmulaiasuransijsanuitas : $('#saatmulaiasuransijsanuitas').val(),
						pilihananuitas : $('#pilihananuitas').val(),
						premisekaligusjsanuitas : $('#premisekaligusjsanuitas').val(),
						
						aspkawin : $('#aspkawin').val(),
						aspbujang : $('#aspbujang').val(),
						
						asikawin : $('#asikawin').val(),
						asibujang : $('#asibujang').val(),

						aikawin : $('#aikawin').val(),
						aibujang : $('#aibujang').val(),
						
						aepkawin : $('#aepkawin').val(),
						aepbujang : $('#aepbujang').val(),
					
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   */
			   
			   else if(controller=='anuitasnew'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),						
						
						statuskawin: $('#statuskawin').val(),

						saatmulaiasuransijsanuitas : $('#saatmulaiasuransijsanuitas').val(),
						pilihananuitas : $('#pilihananuitas').val(),
						premisekaligusjsanuitas : $('#premisekaligusjsanuitas').val(),
						
						aspkawin : $('#aspkawin').val(),
						aspbujang : $('#aspbujang').val(),
						
						asikawin : $('#asikawin').val(),
						asibujang : $('#asibujang').val(),

						aikawin : $('#aikawin').val(),
						aibujang : $('#aibujang').val(),
						
						aepkawin : $('#aepkawin').val(),
						aepbujang : $('#aepbujang').val(),
					
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   
			   
			   
			   /*----------JS ANUITAS NEW 2 -------*/
			   /*
			   else if(controller=='anuitasnew2'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),						
						
						statuskawin: $('#statuskawin').val(),

						saatmulaiasuransijsanuitas : $('#saatmulaiasuransijsanuitas').val(),
						pilihananuitas : $('#pilihananuitas').val(),
						premisekaligusjsanuitas : $('#premisekaligusjsanuitas').val(),
						
						aikawin : $('#aikawin').val(),
						aibujang : $('#aibujang').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   */
			   /*---------END JS ANUITAS NEW 2 --------*/
			   
			   
			   else if(controller=='jsdwiguna'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						masaasuransi : $('#masaasuransi').val(),						
						uangasuransipokok : $('#uangasuransipokok').val(),

						statusmedical : $('#statusmedical').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
						tabelpremisekaligus : $('#tabelpremisekaligus').val(),
						tabelpremitahunan : $('#tabelpremitahunan').val(),
						tabelpremibulanan : $('#tabelpremibulanan').val(),
						tabelpremikuartalan : $('#tabelpremikuartalan').val(),
						tabelpremisemesteran : $('#tabelpremisemesteran').val(),
						kodeprospek: $('#kdprospek').val(),
						
						//RIDER
						jsaddbjsdwiguna : $('#jsaddbjsdwiguna').val(),
						premijsaddbjsdwiguna : $('#premijsaddbjsdwiguna').val(),
						uangasuransijsaddbjsdwiguna : $('#uangasuransijsaddbjsdwiguna').val(),
						
						jstpdjsdwiguna : $('#jstpdjsdwiguna').val(),
						premijstpdjsdwiguna : $('#premijstpdjsdwiguna').val(),
						uangasuransijstpdjsdwiguna : $('#uangasuransijstpdjsdwiguna').val(),
						
						jswaivertpdjsdwiguna : $('#jswaivertpdjsdwiguna').val(),
						premijswaivertpdjsdwiguna : $('#premijswaivertpdjsdwiguna').val(),
						uangasuransijswaivertpdjsdwiguna : $('#uangasuransijswaivertpdjsdwiguna').val(),
						
						jsci53jsdwiguna : $('#jsci53jsdwiguna').val(),
						premijsci53jsdwiguna : $('#premijsci53jsdwiguna').val(),
						uangasuransijsci53jsdwiguna : $('#uangasuransijsci53jsdwiguna').val(),
						
						jstermjsdwiguna : $('#jstermjsdwiguna').val(),
						premijstermjsdwiguna : $('#premijstermjsdwiguna').val(),
						uangasuransijstermjsdwiguna : $('#uangasuransijstermjsdwiguna').val(),
						
						jsspdjsdwiguna : $('#jsspdjsdwiguna').val(),
						premijsspdjsdwiguna : $('#premijsspdjsdwiguna').val(),
						uangasuransijsspdjsdwiguna : $('#uangasuransijsspdjsdwiguna').val(),
						
						jssptpdjsdwiguna : $('#jssptpdjsdwiguna').val(),
						premijssptpdjsdwiguna : $('#premijssptpdjsdwiguna').val(),
						uangasuransijssptpdjsdwiguna : $('#uangasuransijssptpdjsdwiguna').val(),
						
						hcpjsdwiguna : $('#hcpjsdwiguna').val(),
						premihcpjsdwiguna : $('#premihcpjsdwiguna').val(),
						uangasuransihcpjsdwiguna : $('#uangasuransihcpjsdwiguna').val(),
						
						hcpbjsdwiguna : $('#hcpbjsdwiguna').val(),
						premihcpbjsdwiguna : $('#premihcpbjsdwiguna').val(),
						uangasuransihcpbjsdwiguna : $('#uangasuransihcpbjsdwiguna').val(),
						
						totalpremiriderjsdwigunasum : $('#totalpremiriderjsdwigunasum').val(),
						
						totalpokokpremirider : $('#totalpokokpremirider').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   else if(controller=='jssin3rgy'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						
						pilihanpaketbenefit : $('#pilihanpaketbenefit').val(),
						mulaiasuransi : $('#mulaiasuransi').val(),
						masaasuransijssin3rgy : $('#masaasuransijssin3rgy').val(),
						carabayarpremi : $('#carabayarpremi').val(),
						premijsremaja : $('#premijsremaja').val(),
						masapembayaranpremi : $('#masapembayaranpremi').val(),
						
						//kantorcabang : $('#kantorcabang').val(),
						kodeprospek: $('#kdprospek').val(),
						
						//RIDER
						
						hcpjssinergy: $('#hcpjssinergy').val(),
						premihcpjssinergy: $('#premihcpjssinergy').val(),
						uangasuransihcpjssinergy: $('#uangasuransihcpjssinergy').val(),
						totalpremiriderjssinergy1: $('#totalpremiriderjssinergy1').val(),
						
						jsaddbjssinergy: $('#jsaddbjssinergy').val(),
						premijsaddbjssinergy: $('#premijsaddbjssinergy').val(),
						uangasuransijsaddbjssinergy: $('#uangasuransijsaddbjssinergy').val(),
						
						termjssinergy: $('#termjssinergy').val(),
						premitermjssinergy: $('#premitermjssinergy').val(),
						uangasuransitermjssinergy: $('#uangasuransitermjssinergy').val(),
						
						totalpremiriderjssinergy2: $('#totalpremiriderjssinergy2').val(),
						totalpremiriderjssinergysum: $('#totalpremiriderjssinergysum').val(),
						
						tabelpremibulanan: $('#tabelpremibulanan').val(),
						tabelriderbulanan: $('#tabelriderbulanan').val(),
						tabelriderpremibulanan: $('#tabelriderpremibulanan').val(),
						
						tabelpremi5tahunpertama: $('#tabelpremi5tahunpertama').val(),
						tabelridertahunan: $('#tabelridertahunan').val(),
						tabelriderpremitahunan: $('#tabelriderpremitahunan').val(),
									
                        ajax:1  
                        //sessionid: $('#sessionid').val(),  
	                };   
               }
			   else if(controller=='jsdwigunamenaik'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						masaasuransi : $('#masaasuransi').val(),						
						uangasuransipokok : $('#uangasuransipokok').val(),

						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
						tabelpremi5tahunpertama : $('#tabelpremi5tahunpertama').val(),
						tabelpremi5tahunberikutnya : $('#tabelpremi5tahunberikutnya').val(),
						tabelpremisekaligus : $('#tabelpremisekaligus').val(),
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   else if(controller=='jscaturkarsa'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						masaasuransi : $('#masaasuransi').val(),						
						uangasuransipokok : $('#uangasuransipokok').val(),

						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
						
						namaanaktertanggung : $('#namaanaktertanggung').val(),
						umuranak : $('#umuranak').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						
						tabelbeasiswayangditerima :$('#tabelbeasiswayangditerima').val(),
						tabelpremisekaligus : $('#tabelpremisekaligus').val(),
						tabelpremitahunan : $('#tabelpremitahunan').val(),
						tabelpremisemesteran : $('#tabelpremisemesteran').val(),
						tabelpremikwartalan : $('#tabelpremikwartalan').val(),
						tabelpremibulanan : $('#tabelpremibulanan').val(),
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   else if(controller=='jsdmpplus'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						carabayarjsdmpplus : $('#carabayarjsdmpplus').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						masaasuransi : $('#masaasuransi').val(),						
						uangasuransipokok : $('#uangasuransipokok').val(),

						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
						uangasuransihcpjsdmpplus : $('#uangasuransihcpjsdmpplus').val(),
						uangasuransihcpbjsdmpplus : $('#uangasuransihcpbjsdmpplus').val(),
						
						uangasuransihcpjsdmpplus : $('#uangasuransihcpjsdmpplus').val(),
						uangasuransijsaddbjsdmpplus : $('#uangasuransijsaddbjsdmpplus').val(),
						uangasuransici53jsdmpplus : $('#uangasuransici53jsdmpplus').val(),
						
						premijstpdjsdmpplus : $('#premijstpdjsdmpplus').val(),
						premiwpjsdmpplus : $('#premiwpjsdmpplus').val(),
						premici53jsdmpplus : $('#premici53jsdmpplus').val(),
						premijsaddbjsdmpplus : $('#premijsaddbjsdmpplus').val(),
						premijsspdjsdmpplus : $('#premijsspdjsdmpplus').val(),
						premijssptpdjsdmpplus : $('#premijssptpdjsdmpplus').val(),
						
						tabelpremisekaligus : $('#tabelpremisekaligus').val(),
						tabelpremi5tahunpertama : $('#tabelpremi5tahunpertama').val(),
						tabelpremisemesteran : $('#tabelpremisemesteran').val(),
						tabelpremikuartalan : $('#tabelpremikuartalan').val(),
						tabelpremibulanan : $('#tabelpremibulanan').val(),
						
						tabelrider5tahunpertama : $('#tabelrider5tahunpertama').val(),
						tabelridersemesteran : $('#tabelridersemesteran').val(),
						tabelriderkuartalan : $('#tabelriderkuartalan').val(),
						tabelriderbulanan : $('#tabelriderbulanan').val(),
						
						tabelriderpremi5tahunpertama : $('#tabelriderpremi5tahunpertama').val(),
						tabelriderpremisemesteran : $('#tabelriderpremisemesteran').val(),
						tabelriderpremikuartalan : $('#tabelriderpremikuartalan').val(),
						tabelriderpremibulanan : $('#tabelriderpremibulanan').val(),
						
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   else if(controller=='jsgajiterusanplatinum'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						gaji : $('#gaji').val(),						
						jumlahrisikoawaljsgajiterusanplatinum : $('#jumlahrisikoawaljsgajiterusanplatinum').val(),

						premi5tahunpertama : $('#premi5tahunpertama').val(),
						premitahunke6danseterusnya : $('#premitahunke6danseterusnya').val(),
						
						masaasuransijsgajiterusan : $('#masaasuransijsgajiterusan').val(),
						carabayarpremijsgajiterusan : $('#carabayarpremijsgajiterusan').val(),
						
						saatmulaiasuransijsgajiterusan : $('#saatmulaiasuransijsgajiterusan').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
				else if(controller=='jsreplacementincomeassurance'){
					var formHitung = {   
						modul : controller,
						idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),

						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),

						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						gaji : $('#gaji').val(),						
						jumlahrisikoawaljsgajiterusanplatinum : $('#jumlahrisikoawaljsgajiterusanplatinum').val(),

						premi5tahunpertama : $('#premi5tahunpertama').val(),
						premitahunke6danseterusnya : $('#premitahunke6danseterusnya').val(),

						masaasuransijsgajiterusan : $('#masaasuransijsgajiterusan').val(),
						carabayarpremijsgajiterusan : $('#carabayarpremijsgajiterusan').val(),

						saatmulaiasuransijsgajiterusan : $('#saatmulaiasuransijsgajiterusan').val(),

						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						kodeprospek: $('#kdprospek').val(),

						ajax:1  
						//sessionid: $('#sessionid').val(), 
					};   
				}
			   else if(controller=='jskelangsunganpendidikan'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						
						spp : $('#spp').val(),						
						jumlahrisikoawaljskelangsunganpendidikan : $('#jumlahrisikoawaljskelangsunganpendidikan').val(),
						premisekaligusjskelangsunganpendidikan : $('#premisekaligusjskelangsunganpendidikan').val(),
						masaasuransijskelangsunganpendidikan : $('#masaasuransijskelangsunganpendidikan').val(),
						carabayarpremijskelangsunganpendidikan : $('#carabayarpremijskelangsunganpendidikan').val(),
						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						kodeprospek: $('#kdprospek').val(),
									
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   /*else if(controller=='paketproteksiuntukkeluarga'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						namajsgajiterusanplatinum : $('#namajsgajiterusanplatinum').val(),
						gajijsgajiterusanplatinum : $('#gajijsgajiterusanplatinum').val(),
						premijsgajiterusanplatinum : $('#premijsgajiterusanplatinum').val(),
						
						premibulananjssiharta : $('#premibulananjssiharta').val(),
						
						jumlahuangasuransianakke1jssiharta : $('#jumlahuangasuransianakke1jssiharta').val(),
						premianakke1jsprestasi : $('#premianakke1jsprestasi').val(),
						
						jumlahuangasuransianakke2jssiharta : $('#jumlahuangasuransianakke2jssiharta').val(),
						premianakke2jsprestasi : $('#premianakke2jsprestasi').val(),
						
						totalpremikeluarga : $('#totalpremikeluarga').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						//kantorcabang : $('#kantorcabang').val(),
						kodeprospek: $('#kdprospek').val(),
									
                        ajax:1  
                        //sessionid: $('#sessionid').val(),  
	                };   
               }*/
			   else if(controller=='jsproteksikeluarga'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						
						tertanggungayah : $('#tertanggungayah').val(),
						tertanggungibu : $('#tertanggungibu').val(),
						tertanggunganak1 : $('#tertanggunganak1').val(),
						tertanggunganak2 : $('#tertanggunganak2').val(),
						tertanggunganak3 : $('#tertanggunganak3').val(),
						
						uangasuransipertahunjsproteksikeluarga : $('#uangasuransipertahunjsproteksikeluarga').val(),
						premitahunanjsproteksikeluarga : $('#premitahunanjsproteksikeluarga').val(),
						premisekaligusjsproteksikeluarga : $('#premisekaligusjsproteksikeluarga').val(),
						masaasuransijsproteksikeluarga : $('#masaasuransijsproteksikeluarga').val(),
						mulaiasuransijsproteksikeluarga : $('#mulaiasuransijsproteksikeluarga').val(),
						
						
						//kantorcabang : $('#kantorcabang').val(),
						kodeprospek: $('#kdprospek').val(),
									
                        ajax:1  
                        //sessionid: $('#sessionid').val(),  
	                };   
               }
			   
			   else if(controller=='jspromapan'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						hubungandenganpempol : $('#hubungandenganpempol').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						calontertanggungperokok: $('#calontertanggungperokok').val(),
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						asumsicutitahunan : $('#asumsicutitahunan').val(),
						carabayar : $('#carabayar').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						minimalua : $('#minimalua').val(),
						maksimalua : $('#maksimalua').val(),
						matauang : $('#matauang').val(),
						statusmedical : $('#statusmedical').val(),
						
						premiberkala : $('#premiberkala').val(),
						topupberkala : $('#topupberkala').val(),
						topupsekaligus : $('#topupsekaligus').val(),
						beamaterai : $('#beamaterai').val(),
						totalpremiyangdibayar : $('#totalpremiyangdibayar').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						juaaddb : $('#juaaddb').val(),
						juawp : $('#juawp').val(),
						juatpd : $('#juatpd').val(),
						juahcp : $('#juahcp').val(),
						juahcpbedah : $('#juahcpbedah').val(),
						juaci53 : $('#juaci53').val(),
						juatermlife : $('#juatermlife').val(),
						juapayorbenefitdeath : $('#juapayorbenefitdeath').val(),
						juapayorbenefittpd : $('#juapayorbenefittpd').val(),
						juaspousepayordeath : $('#juaspousepayordeath').val(),
						juaspousepayortpd : $('#juaspousepayortpd').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   
				
			   // JS PRO MAPAN NEW
			   else if(controller=='jspromapannew'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						hubungandenganpempol : $('#hubungandenganpempol').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						perokok: $('#perokok').val(),
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						tanggalilustrasi : $('#tanggalilustrasi').val(),
						asumsicutipremi : $('#asumsicutipremi').val(),
						carabayarjspromapannew : $('#carabayarjspromapannew').val(),
						usiaproduktif : $('#usiaproduktif').val(),
						penghasilansatutahun : $('#penghasilansatutahun').val(),
						maksimaluangasuransi : $('#maksimaluangasuransi').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						premiberkala : $('#premiberkala').val(),
						topupberkala : $('#topupberkala').val(),
						topupsekaligus : $('#topupsekaligus').val(),
						beamaterai : $('#beamaterai').val(),
						totalpremi : $('#totalpremi').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						hcpjspromapannew : $('#hcpjspromapannew').val(),
						premihcpjspromapannew : $('#premihcpjspromapannew').val(),
						uangasuransihcpjspromapannew : $('#uangasuransihcpjspromapannew').val(),
						
						hcpbjspromapannew : $('#hcpbjspromapannew').val(),
						premihcpbjspromapannew : $('#premihcpbjspromapannew').val(),
						uangasuransihcpbjspromapannew : $('#uangasuransihcpbjspromapannew').val(),
						
						totalpremiriderjspromapannew1 : $('#totalpremiriderjspromapannew1').val(),
						
						jsaddbjspromapannew : $('#jsaddbjspromapannew').val(),
						premijsaddbjspromapannew : $('#premijsaddbjspromapannew').val(),
						uangasuransijsaddbjspromapannew : $('#uangasuransijsaddbjspromapannew').val(),
						
						jstpdjspromapannew : $('#jstpdjspromapannew').val(),
						premijstpdjspromapannew : $('#premijstpdjspromapannew').val(),
						uangasuransijstpdjspromapannew : $('#uangasuransijstpdjspromapannew').val(),
						
						ci53jspromapannew : $('#ci53jspromapannew').val(),
						premici53jspromapannew : $('#premici53jspromapannew').val(),
						uangasuransici53jspromapannew : $('#uangasuransici53jspromapannew').val(),
						
						termjspromapannew : $('#termjspromapannew').val(),
						premitermjspromapannew : $('#premitermjspromapannew').val(),
						uangasuransitermjspromapannew : $('#uangasuransitermjspromapannew').val(),
						
						jspbdjspromapannew : $('#jspbdjspromapannew').val(),
						premijspbdjspromapannew : $('#premijspbdjspromapannew').val(),
						uangasuransijspbdjspromapannew : $('#uangasuransijspbdjspromapannew').val(),
						
						jspbtpdjspromapannew : $('#jspbtpdjspromapannew').val(),
						premijspbtpdjspromapannew : $('#premijspbtpdjspromapannew').val(),
						uangasuransijspbtpdjspromapannew : $('#uangasuransijspbtpdjspromapannew').val(),
						
						jsspdjspromapannew : $('#jsspdjspromapannew').val(),
						premijsspdjspromapannew : $('#premijsspdjspromapannew').val(),
						uangasuransijsspdjspromapannew : $('#uangasuransijsspdjspromapannew').val(),
						
						jssptpdjspromapannew : $('#jssptpdjspromapannew').val(),
						premijssptpdjspromapannew : $('#premijssptpdjspromapannew').val(),
						uangasuransijssptpdjspromapannew : $('#uangasuransijssptpdjspromapannew').val(),
						
						jswptpdjspromapannew : $('#jswptpdjspromapannew').val(),
						premijswptpdjspromapannew : $('#premijswptpdjspromapannew').val(),
						uangasuransijswptpdjspromapannew : $('#uangasuransijswptpdjspromapannew').val(),
						
						jswpcijspromapannew : $('#jswpcijspromapannew').val(),
						premijswpcijspromapannew : $('#premijswpcijspromapannew').val(),
						uangasuransijswpcijspromapannew : $('#uangasuransijswpcijspromapannew').val(),
						
						totalpremiriderjspromapannewsum : $('#totalpremiriderjspromapannewsum').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='jspromapankakehanberubah'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						hubungandenganpempol : $('#hubungandenganpempol').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						perokok: $('#perokok').val(),
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						tanggalilustrasi : $('#tanggalilustrasi').val(),
						asumsicutipremi : $('#asumsicutipremi').val(),
						carabayarjspromapannew : $('#carabayarjspromapannew').val(),
						usiaproduktif : $('#usiaproduktif').val(),
						penghasilansatutahun : $('#penghasilansatutahun').val(),
						maksimaluangasuransi : $('#maksimaluangasuransi').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						premiberkala : $('#premiberkala').val(),
						topupberkala : $('#topupberkala').val(),
						topupsekaligus : $('#topupsekaligus').val(),
						beamaterai : $('#beamaterai').val(),
						totalpremi : $('#totalpremi').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						hcpjspromapannew : $('#hcpjspromapannew').val(),
						premihcpjspromapannew : $('#premihcpjspromapannew').val(),
						uangasuransihcpjspromapannew : $('#uangasuransihcpjspromapannew').val(),
						
						hcpbjspromapannew : $('#hcpbjspromapannew').val(),
						premihcpbjspromapannew : $('#premihcpbjspromapannew').val(),
						uangasuransihcpbjspromapannew : $('#uangasuransihcpbjspromapannew').val(),
						
						totalpremiriderjspromapannew1 : $('#totalpremiriderjspromapannew1').val(),
						
						jsaddbjspromapannew : $('#jsaddbjspromapannew').val(),
						premijsaddbjspromapannew : $('#premijsaddbjspromapannew').val(),
						uangasuransijsaddbjspromapannew : $('#uangasuransijsaddbjspromapannew').val(),
						
						jstpdjspromapannew : $('#jstpdjspromapannew').val(),
						premijstpdjspromapannew : $('#premijstpdjspromapannew').val(),
						uangasuransijstpdjspromapannew : $('#uangasuransijstpdjspromapannew').val(),
						
						ci53jspromapannew : $('#ci53jspromapannew').val(),
						premici53jspromapannew : $('#premici53jspromapannew').val(),
						uangasuransici53jspromapannew : $('#uangasuransici53jspromapannew').val(),
						
						termjspromapannew : $('#termjspromapannew').val(),
						premitermjspromapannew : $('#premitermjspromapannew').val(),
						uangasuransitermjspromapannew : $('#uangasuransitermjspromapannew').val(),
						
						jspbdjspromapannew : $('#jspbdjspromapannew').val(),
						premijspbdjspromapannew : $('#premijspbdjspromapannew').val(),
						uangasuransijspbdjspromapannew : $('#uangasuransijspbdjspromapannew').val(),
						
						jspbtpdjspromapannew : $('#jspbtpdjspromapannew').val(),
						premijspbtpdjspromapannew : $('#premijspbtpdjspromapannew').val(),
						uangasuransijspbtpdjspromapannew : $('#uangasuransijspbtpdjspromapannew').val(),
						
						jsspdjspromapannew : $('#jsspdjspromapannew').val(),
						premijsspdjspromapannew : $('#premijsspdjspromapannew').val(),
						uangasuransijsspdjspromapannew : $('#uangasuransijsspdjspromapannew').val(),
						
						jssptpdjspromapannew : $('#jssptpdjspromapannew').val(),
						premijssptpdjspromapannew : $('#premijssptpdjspromapannew').val(),
						uangasuransijssptpdjspromapannew : $('#uangasuransijssptpdjspromapannew').val(),
						
						jswptpdjspromapannew : $('#jswptpdjspromapannew').val(),
						premijswptpdjspromapannew : $('#premijswptpdjspromapannew').val(),
						uangasuransijswptpdjspromapannew : $('#uangasuransijswptpdjspromapannew').val(),
						
						jswpcijspromapannew : $('#jswpcijspromapannew').val(),
						premijswpcijspromapannew : $('#premijswpcijspromapannew').val(),
						uangasuransijswpcijspromapannew : $('#uangasuransijswpcijspromapannew').val(),
						
						totalpremiriderjspromapannewsum : $('#totalpremiriderjspromapannewsum').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
				
				
			   else if(controller=='jspromapannew2'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						hubungandenganpempol : $('#hubungandenganpempol').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						perokok: $('#perokok').val(),
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						tanggalilustrasi : $('#tanggalilustrasi').val(),
						asumsicutipremi : $('#asumsicutipremi').val(),
						carabayarjspromapannew : $('#carabayarjspromapannew').val(),
						usiaproduktif : $('#usiaproduktif').val(),
						penghasilansatutahun : $('#penghasilansatutahun').val(),
						maksimaluangasuransi : $('#maksimaluangasuransi').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						premiberkala : $('#premiberkala').val(),
						topupberkala : $('#topupberkala').val(),
						topupsekaligus : $('#topupsekaligus').val(),
						beamaterai : $('#beamaterai').val(),
						totalpremi : $('#totalpremi').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						hcpjspromapannew : $('#hcpjspromapannew').val(),
						premihcpjspromapannew : $('#premihcpjspromapannew').val(),
						uangasuransihcpjspromapannew : $('#uangasuransihcpjspromapannew').val(),
						
						hcpbjspromapannew : $('#hcpbjspromapannew').val(),
						premihcpbjspromapannew : $('#premihcpbjspromapannew').val(),
						uangasuransihcpbjspromapannew : $('#uangasuransihcpbjspromapannew').val(),
						
						totalpremiriderjspromapannew1 : $('#totalpremiriderjspromapannew1').val(),
						
						jsaddbjspromapannew : $('#jsaddbjspromapannew').val(),
						premijsaddbjspromapannew : $('#premijsaddbjspromapannew').val(),
						uangasuransijsaddbjspromapannew : $('#uangasuransijsaddbjspromapannew').val(),
						
						jstpdjspromapannew : $('#jstpdjspromapannew').val(),
						premijstpdjspromapannew : $('#premijstpdjspromapannew').val(),
						uangasuransijstpdjspromapannew : $('#uangasuransijstpdjspromapannew').val(),
						
						ci53jspromapannew : $('#ci53jspromapannew').val(),
						premici53jspromapannew : $('#premici53jspromapannew').val(),
						uangasuransici53jspromapannew : $('#uangasuransici53jspromapannew').val(),
						
						termjspromapannew : $('#termjspromapannew').val(),
						premitermjspromapannew : $('#premitermjspromapannew').val(),
						uangasuransitermjspromapannew : $('#uangasuransitermjspromapannew').val(),
						
						jspbdjspromapannew : $('#jspbdjspromapannew').val(),
						premijspbdjspromapannew : $('#premijspbdjspromapannew').val(),
						uangasuransijspbdjspromapannew : $('#uangasuransijspbdjspromapannew').val(),
						
						jspbtpdjspromapannew : $('#jspbtpdjspromapannew').val(),
						premijspbtpdjspromapannew : $('#premijspbtpdjspromapannew').val(),
						uangasuransijspbtpdjspromapannew : $('#uangasuransijspbtpdjspromapannew').val(),
						
						jsspdjspromapannew : $('#jsspdjspromapannew').val(),
						premijsspdjspromapannew : $('#premijsspdjspromapannew').val(),
						uangasuransijsspdjspromapannew : $('#uangasuransijsspdjspromapannew').val(),
						
						jssptpdjspromapannew : $('#jssptpdjspromapannew').val(),
						premijssptpdjspromapannew : $('#premijssptpdjspromapannew').val(),
						uangasuransijssptpdjspromapannew : $('#uangasuransijssptpdjspromapannew').val(),
						
						jswptpdjspromapannew : $('#jswptpdjspromapannew').val(),
						premijswptpdjspromapannew : $('#premijswptpdjspromapannew').val(),
						uangasuransijswptpdjspromapannew : $('#uangasuransijswptpdjspromapannew').val(),
						
						jswpcijspromapannew : $('#jswpcijspromapannew').val(),
						premijswpcijspromapannew : $('#premijswpcijspromapannew').val(),
						uangasuransijswpcijspromapannew : $('#uangasuransijswpcijspromapannew').val(),
						
						totalpremiriderjspromapannewsum : $('#totalpremiriderjspromapannewsum').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   
				
				
			   // JS SAVING PLAN
			   else if(controller=='jssavingplan'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						pilihanproduk : $('#pilihanproduk').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						usiacalontertanggung : $('#usiacalontertanggung').val(),
						
						premisekaligus : $('#premisekaligus').val(),
						saatmulaiasuransi : $('#saatmulaiasuransi').val(),
						masaasuransi : $('#masaasuransi').val(),
						
						nilaitunai1 : $('#nilaitunai1').val(),
						nilaitunai2 : $('#nilaitunai2').val(),
						nilaitunai3 : $('#nilaitunai3').val(),
						nilaitunai4 : $('#nilaitunai4').val(),
						nilaitunai5 : $('#nilaitunai5').val(),
						
						manfaatmeninggaldunia1 : $('#manfaatmeninggaldunia1').val(),
						manfaatmeninggaldunia2 : $('#manfaatmeninggaldunia2').val(),
						manfaatmeninggaldunia3 : $('#manfaatmeninggaldunia3').val(),
						manfaatmeninggaldunia4 : $('#manfaatmeninggaldunia4').val(),
						manfaatmeninggaldunia5 : $('#manfaatmeninggaldunia5').val(),
						
						totalmanfaat1 : $('#totalmanfaat1').val(),
						totalmanfaat2 : $('#totalmanfaat2').val(),
						totalmanfaat3 : $('#totalmanfaat3').val(),
						totalmanfaat4 : $('#totalmanfaat4').val(),
						totalmanfaat5 : $('#totalmanfaat5').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   
			
			   // JS PRO MAPAN NEW RUSH E
			   else if(controller=='jspromapannew_rush_e'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						hubungandenganpempol : $('#hubungandenganpempol').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						perokok: $('#perokok').val(),
						tertanggungsamadenganpemegangpolis : $('tertanggungsamadenganpemegangpolis').val(),
						
						tanggalilustrasi : $('#tanggalilustrasi').val(),
						asumsicutipremi : $('#asumsicutipremi').val(),
						carabayarjspromapannew : $('#carabayarjspromapannew').val(),
						usiaproduktif : $('#usiaproduktif').val(),
						penghasilansatutahun : $('#penghasilansatutahun').val(),
						maksimaluangasuransi : $('#maksimaluangasuransi').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						premiberkala : $('#premiberkala').val(),
						topupberkala : $('#topupberkala').val(),
						topupsekaligus : $('#topupsekaligus').val(),
						beamaterai : $('#beamaterai').val(),
						totalpremi : $('#totalpremi').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						hcpjspromapannew : $('#hcpjspromapannew').val(),
						premihcpjspromapannew : $('#premihcpjspromapannew').val(),
						uangasuransihcpjspromapannew : $('#uangasuransihcpjspromapannew').val(),
						
						hcpbjspromapannew : $('#hcpbjspromapannew').val(),
						premihcpbjspromapannew : $('#premihcpbjspromapannew').val(),
						uangasuransihcpbjspromapannew : $('#uangasuransihcpbjspromapannew').val(),
						
						totalpremiriderjspromapannew1 : $('#totalpremiriderjspromapannew1').val(),
						
						jsaddbjspromapannew : $('#jsaddbjspromapannew').val(),
						premijsaddbjspromapannew : $('#premijsaddbjspromapannew').val(),
						uangasuransijsaddbjspromapannew : $('#uangasuransijsaddbjspromapannew').val(),
						
						jstpdjspromapannew : $('#jstpdjspromapannew').val(),
						premijstpdjspromapannew : $('#premijstpdjspromapannew').val(),
						uangasuransijstpdjspromapannew : $('#uangasuransijstpdjspromapannew').val(),
						
						ci53jspromapannew : $('#ci53jspromapannew').val(),
						premici53jspromapannew : $('#premici53jspromapannew').val(),
						uangasuransici53jspromapannew : $('#uangasuransici53jspromapannew').val(),
						
						termjspromapannew : $('#termjspromapannew').val(),
						premitermjspromapannew : $('#premitermjspromapannew').val(),
						uangasuransitermjspromapannew : $('#uangasuransitermjspromapannew').val(),
						
						jspbdjspromapannew : $('#jspbdjspromapannew').val(),
						premijspbdjspromapannew : $('#premijspbdjspromapannew').val(),
						uangasuransijspbdjspromapannew : $('#uangasuransijspbdjspromapannew').val(),
						
						jspbtpdjspromapannew : $('#jspbtpdjspromapannew').val(),
						premijspbtpdjspromapannew : $('#premijspbtpdjspromapannew').val(),
						uangasuransijspbtpdjspromapannew : $('#uangasuransijspbtpdjspromapannew').val(),
						
						jsspdjspromapannew : $('#jsspdjspromapannew').val(),
						premijsspdjspromapannew : $('#premijsspdjspromapannew').val(),
						uangasuransijsspdjspromapannew : $('#uangasuransijsspdjspromapannew').val(),
						
						jssptpdjspromapannew : $('#jssptpdjspromapannew').val(),
						premijssptpdjspromapannew : $('#premijssptpdjspromapannew').val(),
						uangasuransijssptpdjspromapannew : $('#uangasuransijssptpdjspromapannew').val(),
						
						jswptpdjspromapannew : $('#jswptpdjspromapannew').val(),
						premijswptpdjspromapannew : $('#premijswptpdjspromapannew').val(),
						uangasuransijswptpdjspromapannew : $('#uangasuransijswptpdjspromapannew').val(),
						
						jswpcijspromapannew : $('#jswpcijspromapannew').val(),
						premijswpcijspromapannew : $('#premijswpcijspromapannew').val(),
						uangasuransijswpcijspromapannew : $('#uangasuransijswpcijspromapannew').val(),
						
						totalpremiriderjspromapannewsum : $('#totalpremiriderjspromapannewsum').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
				
			   else if(controller=='jsproidaman'){
            		var formHitung = {   
                        saatmulaiunitlink: $('#saatmulaiunitlink').val(), 
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
								
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						calontertanggungperokok : $('#calontertanggungperokok').val(),
						totalpremiyangdibayar : $('#totalpremiyangdibayar').val(),
						
						carabayar : $('#carabayar').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						matauang : $('#matauang').val(),
						premisingle : $('#premisingle').val(),
						topupsingle : $('#topupsingle').val(),
						beamaterai : $('#beamaterai').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						hcpjspromapannew : $('#hcpjspromapannew').val(),
						premihcpjspromapannew : $('#premihcpjspromapannew').val(),
						uangasuransihcpjspromapannew : $('#uangasuransihcpjspromapannew').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='jsguardian'){
            		var formHitung = {   
                        saatmulaiunitlink: $('#saatmulaiunitlink').val(), 
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
								
						calonpemegangpolisperokok : $('#calonpemegangpolisperokok').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						calontertanggungperokok : $('#calontertanggungperokok').val(),
						totalpremiyangdibayar : $('#totalpremiyangdibayar').val(),
						
						carabayar : $('#carabayar').val(),
						uangpertanggungan : $('#uangpertanggungan').val(),
						matauang : $('#matauang').val(),
						premisingle : $('#premisingle').val(),
						topupsingle : $('#topupsingle').val(),
						beamaterai : $('#beamaterai').val(),
						
						alokasidana1 : $('#alokasidana1').val(),
						persentasealokasidana1 : $('#persentasealokasidana1').val(),
						alokasidana2 : $('#alokasidana2').val(),
						persentasealokasidana2 : $('#persentasealokasidana2').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='akdp'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						
						uangasuransiakdp : $('#uangasuransiakdp').val(),
						jenisplan : $('#jenisplan').val(),
						mulaiasuransi : $('#mulaiasuransi').val(),
						kelasrisiko : $('#kelasrisiko').val(),
						masaasuransiakdp : $('#masaasuransiakdp').val(),
						premiakdp : $('#premiakdp').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						
						
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
			   else if(controller=='askred'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						
						uangasuransiaskred : $('#uangasuransiaskred').val(),
						mulaiasuransi : $('#mulaiasuransi').val(),
						premiaskred : $('#premiaskred').val(),
						masaasuransiaskred : $('#masaasuransiaskred').val(),
						juamenurunlinearaskred : $('#juamenurunlinearaskred').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
	
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }	
			   else if(controller=='jspns'){
            		var formHitung = {   
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						usia : $('#usia').val(),
						
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						
						statusjspns : $('#statusjspns').val(),
						pensiunperbulanjspns : $('#pensiunperbulanjspns').val(),
						mulaiasuransi : $('#mulaiasuransi').val(),
						carabayarpremijspns : $('#carabayarpremijspns').val(),
						labelcarabayarjspns : $('#labelcarabayarjspns').val(),
						masapembayaranpremijspns : $('#masapembayaranpremijspns').val(),
						premijspns : $('#premijspns').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						
						
						kodeprospek: $('#kdprospek').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                };   
               }
               else if(controller=='jl3'){
            		var formHitung = {   
                        
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						
						namacalontertanggung : $('#namacalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						
						jenisproduk : $('#jenisproduk').val(),
						carabayar : $('#carabayar').val(),
						premisesuaicarabayar : $('#premisesuaicarabayar').val(),
						juatl1tl2 : $('#juatl1tl2').val(),
						masapemb : $('#masapemb').val(),
						asumsinilainab : $('#asumsinilainab').val(),
						topupberkala : $('#topupberkala').val(),
						topupsekaligus : $('#topupsekaligus').val(),
						masatopupsekaligus : $('#masatopupsekaligus').val(),
						saatmulai : $('#saatmulai').val(),
						
						juatl1tl2 : $('#juatl1tl2').val(),
						juaterm : $('#juaterm').val(),
						juapa : $('#juapa').val(),
						juaci : $('#juaci').val(),
						juactt : $('#juactt').val(),
						juawp : $('#juawp').val(),
						juacpm : $('#juacpm').val(),
						juacpb : $('#juacpb').val(),
			
						premitambahanterm : $('#premitambahanterm').val(),
						premitambahanpa : $('#premitambahanpa').val(),
						premitambahanci : $('#premitambahanci').val(),
						premitambahanctt : $('#premitambahanctt').val(),
						premitambahanwp : $('#premitambahanwp').val(),
						premitambahancpm : $('#premitambahancpm').val(),
						premitambahancpb : $('#premitambahancpb').val(),
						
						totalpremisesuaicarabayar : $('#totalpremisesuaicarabayar').val(),
						kesanggupanbayar : $('#kesanggupanbayar').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   else if(controller=='jl3new'){
            		var formHitung = {   
                        
                        modul : controller,
                        idproduk : $('#idproduk').val(),
						
						hubungandenganpempol : $('#hubungandenganpempol').val(),
						calonpemegangpolisperokokjsdwigunamenaik : $('#calonpemegangpolisperokokjsdwigunamenaik').val(),
						namalengkapcalontertanggung : $('#namalengkapcalontertanggung').val(),
						jeniskelamincalontertanggung : $('#jeniskelamincalontertanggung').val(),
						tanggallahircalontertangggung : $('#tanggallahircalontertangggung').val(),
						tertanggungsamadenganpemegangpolis : $('#tertanggungsamadenganpemegangpolis').val(),
						
						masaasuransi : $('#masaasuransi').val(),
						uangasuransipokok : $('#uangasuransipokok').val(),
						topup : $('#topup').val(),
						carabayartopup : $('#carabayartopup').val(),
						uatl1 : $('#uatl1').val(),
						uatl2 : $('#uatl2').val(),
						carabayarjsdwigunamenaik : $('#carabayarjsdwigunamenaik').val(),
						jenisproduk : $('#jenisproduk').val(),
						nabawal : $('#nabawal').val(),
						
						hcpjsdwigunamenaik : $('#hcpjsdwigunamenaik').val(),
						premihcpjsdwigunamenaik : $('#premihcpjsdwigunamenaik').val(),
						uangasuransihcpjsdwigunamenaik : $('#uangasuransihcpjsdwigunamenaik').val(),
						
						hcpbjsdwigunamenaik : $('#hcpbjsdwigunamenaik').val(),
						premihcpbjsdwigunamenaik : $('#premihcpbjsdwigunamenaik').val(),
						uangasuransihcpbjsdwigunamenaik : $('#uangasuransihcpbjsdwigunamenaik').val(),
						
						totalpremiriderjsdwigunamenaik1 : $('#totalpremiriderjsdwigunamenaik1').val(),
						
						termjsdwigunamenaik : $('#termjsdwigunamenaik').val(),
						premitermjsdwigunamenaik : $('#premitermjsdwigunamenaik').val(),
						uangasuransitermjsdwigunamenaik : $('#uangasuransitermjsdwigunamenaik').val(),
						
						jsaddbjsdwigunamenaik : $('#jsaddbjsdwigunamenaik').val(),
						premijsaddbjsdwigunamenaik : $('#premijsaddbjsdwigunamenaik').val(),
						uangasuransijsaddbjsdwigunamenaik : $('#uangasuransijsaddbjsdwigunamenaik').val(),
						
						jstpdjsdwigunamenaik : $('#jstpdjsdwigunamenaik').val(),
						premijstpdjsdwigunamenaik : $('#premijstpdjsdwigunamenaik').val(),
						uangasuransijstpdjsdwigunamenaik : $('#uangasuransijstpdjsdwigunamenaik').val(),
						
						ci53jsdwigunamenaik : $('#ci53jsdwigunamenaik').val(),
						premici53jsdwigunamenaik : $('#premici53jsdwigunamenaik').val(),
						uangasuransici53jsdwigunamenaik : $('#uangasuransici53jsdwigunamenaik').val(),
						
						wpjsdwigunamenaik : $('#wpjsdwigunamenaik').val(),
						premiwpjsdwigunamenaik : $('#premiwpjsdwigunamenaik').val(),
						uangasuransiwpjsdwigunamenaik : $('#uangasuransiwpjsdwigunamenaik').val(),
						
						jsspdjsdwigunamenaik : $('#jsspdjsdwigunamenaik').val(),
						premijsspdjsdwigunamenaik : $('#premijsspdjsdwigunamenaik').val(),
						uangasuransijsspdjsdwigunamenaik : $('#uangasuransijsspdjsdwigunamenaik').val(),
						
						jssptpdjsdwigunamenaik : $('#jssptpdjsdwigunamenaik').val(),
						premijssptpdjsdwigunamenaik : $('#premijssptpdjsdwigunamenaik').val(),
						uangasuransijssptpdjsdwigunamenaik : $('#uangasuransijssptpdjsdwigunamenaik').val(),
						
						totalpremiriderjsdwigunamenaik2 : $('#totalpremiriderjsdwigunamenaik2').val(),
						
						tabelpremipokok : $('#tabelpremipokok').val(),
						tabeltopup : $('#tabeltopup').val(),
						tabelrider : $('#tabelrider').val(),
						tabeltotalpremi : $('#tabeltotalpremi').val(),
						
						nomeragen : $('#nmragen').val(),
						namaagen : $('#nmagen').val(),
						kodekantor : $('#kdkantor').val(),
						kodeprospek: $('#kdprospek').val(),
						//namaagen : $('#namaagen').val(),
						//kantorcabang : $('#kantorcabang').val(),
						
                        ajax:1  
                        //sessionid: $('#sessionid').val(), 
	                }; 
               }
			   
			   dataHitung = formHitung;
			   
           	}
            
            var insertNasabah = function(){
            	//var dataNasabah;
            	//delete dataReal['namanasabah'];
            	
            	dataAsuransi();
            	 var formData = {  
                        namanasabah: $('#namanasabah').val(),  
                        alamatnasabah: $('#alamatnasabah').val(),  
                        kotanasabah: $('#kotanasabah').val(),  
                        provinsinasabah: $('#provinsinasabah').val(),  
                        emailnasabah: $('#emailnasabah').val(), 
                        teleponasabah: $('#teleponnasabah').val(), 
                        lahirnasabah: $('#lahirnasabah').val(), 
                        gendernasabah: $('#gendernasabah').val(), 
                        sessionnasabah: $('#sessionnasabah').val(), 
                        ajax: 1
                    };  
                    
                    /*dataNasabah.push(formData);
                    console.log(dataNasabah);*/
                    //alert(dataNasabah);
                    dataReal = $.extend(formData, dataHitung);
                    //dataReal['namanasabah'] = null;
                    //console.log(dataReal);
					var proses = dataReal['modul'];
                    //dataNasabah = formData;
                    //alert(dataReal);
                    $.ajax({
				        url: "<?php echo base_url();?>"+proses+"/hitung",
				       	type: "POST",
				       	//dataType: "json",
				        data: dataReal,
				        success: function(msg)
				       {
				            console.log(dataReal);
				           	$('#hasil').load("<?php echo base_url();?>"+proses+"/hasil");
				           //alert(formData);
				       //    dataNasabah = formData;
				        }
				    })
				    
				     
                    
                   //alert(proses);

                  
                  //request.abort();  
            }
            	
            	//alert(dataNasabah);

            

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Tahap ' + (index + 1) + ' dari ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
					$('#form_wizard_1').find('.button-kembali').show();
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
					$('#form_wizard_1').find('.button-kembali').hide();
                    $('#form_wizard_1').find('.button-previous').show();
                }
                
                if (current == 2) {
                	
                	copyNasabah();
                	//nasabahAwal();
                	//hitungAsuransi();
                    //$('#form_wizard_1').find('.button-previous').hide();
                    //displayNasabah();
                    
                } 

                if (current >= total) {
                	
                	//dataAsuransi();
                	
                	insertNasabah();
                	//alert(dataReal['sessionnasabah']);
                	//hitungAsuransi();
                	//$('#form_wizard_1').find('.button-previous').hide();
					$('#form_wizard_1').find('.button-previous').hide();
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }
            
            

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                //alert('Finished! Hope you like it :)');
                window.location='<?= base_url();?>';
            }).hide();
        }

    };

}();
</script>
<script src="<?= base_url();?>assets/scripts/custom/components-pickers.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery.number.js"></script>

<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/loadingoverlay.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/simple.money.format.js"></script>


<!--rere-->


<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">

jQuery(document).ready(function() {       
   // initiate layout and plugins
   App.init();
   FormWizard.init();
   
   
	$("#tanggallahir").change(function() {
			var tanggallahir = $("#tanggallahir").val();
			
			var birthday = +new Date(tanggallahir);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ( usiasekarang > 64)
			{
				alert('Usia maksimal Pemegang Polis adalah : 64 Tahun yang Anda masukkan Usia : '+usiasekarang+' Tahun');
				$("#tanggallahir").val("");
			}
		});
	
});

</script>
<script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           App.init();
           ComponentsPickers.init();
        });   
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#productChange').change(function () {

            var product = $(this).val(); // <-- change this line
            	var value = product.split("|");

	            var id = value[0].trim();
	            var controller = value[1].trim();
	            var url = value[2].trim();

	            produk = document.getElementById('produkid');
	            idproduk = document.getElementById('idproduk');
				produk.value = controller;
				idproduk.value = id;

				if(controller != undefined && controller != '') {
					//alert('<?php echo site_url('simulasi'); ?>/' + controller);
					$('#ciudad').load('<?php echo site_url('simulasi'); ?>/' + controller);  
				} else if (url != undefined) { 
					window.location.href = '<?=base_url("")?>'+url+'?kode_prospek='+'<?=$NoProspek?>';
				} else{
					$('#ciudad').html('');
				}
				
            //alert(controller);
            /*console.log(selDpto);
			*/
			console.log(controller);

        });
    });
</script>
<script type="text/javascript">
			
	$(function(){
	// Set up the number formatting.
	
	$('#number_container').slideDown('fast');
	
	$('#batasnomer').on('change',function(){
		console.log('Change event.');
		var val = $('#batasnomer').val();
		$('#the_number').text( val !== '' ? val : '(empty)' );
	});
	
	$('#batasnomer').number( true, 2 );
	
	// Get the value of the number for the demo.
	$('#get_number').on('click',function(){
		
		var val = $('#batasnomer').val();
		
		$('#the_number').text( val !== '' ? val : '(empty)' );
	});
});
</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>