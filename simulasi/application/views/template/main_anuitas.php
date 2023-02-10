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
			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title"  align="center">
					<img src="<?= base_url();?>assets/img/jspos.jpg"/> <small>Jiwasraya Power on Sales</small>
					</h3>
					
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<?php
				$NoProspek =$this->input->get('kode_prospek');
				$DataAgen = $this->ModSimulasi->GetDataAgen_new($NoProspek);
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title" align="center">
							<div class="caption">
								<i class="fa fa-reorder"></i> Simulasi Produk -
								<span class="step-title">
									 Asuransi JS ANUITAS
								</span>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form">
								<div class="form-wizard">
									<div class="form-body">
										<div class="box box-info">
											<!--Start Input Data Calon Pemegang Polis-->
								            <div class="box-header with-border">
								              <h3 class="box-title">Data Diri Calon Pemegang Polis</h3>
								            </div></br>
									        <div class="box-body">
									          	<div class="row">
									          		<!--Kolom Kiri-->
									            	<div class="col-md-5">
									            		<!--Input Nama-->
											            <div class="form-group">
															<label class="control-label col-md-4">Nama Lengkap
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="namapemegangpolis" id="namapemegangpolis" value="<?= $DataAgen['NAMA']; ?>"/>
																
															</div>
											            </div>
											            <!-- Input tanggal lahir -->
											            <div class="form-group">
															<label class="control-label col-sm-4">Tanggal Lahir (mm/dd/yyyy)<span class="required">
															 *
															</span></label>
															
															<div class="col-md-4">
																<input readonly class="form-control form-control-inline input-small date-picker" id="tanggallahirpemegangpolis" name="tanggallahirpemegangpolis" size="16" type="text" value="<?= date("m/d/Y", strtotime($DataAgen['TGLLAHIR'])); ?>"/>
															</div>
											            </div>
														<!-- Input tanggal lahir -->
											            <div class="form-group">
															<label class="control-label col-md-4">Usia
															<span class="required">
																 *
															</span>
															</label>
															<div class="box-body">
																<div class="row">
																	<div class="col-xs-2">
																		<input readonly type="text" class="form-control" name="usiapemegangpolis_th" id="usiapemegangpolis_th"/>
																	</div>
																	<label class="control-label col-xs-1">Tahun</label>
																	<div class="col-xs-2">
																		<input readonly type="text" class="form-control" name="usiapemegangpolis_bl" id="usiapemegangpolis_bl"/>
																	</div>
																	<label class="control-label col-xs-1">Bulan</label>
																</div>
															</div>
														</div>

														<!-- Input jenis kelamin -->
														<div class="form-group">
															<label class="control-label col-md-4">Jenis Kelamin
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<select class="form-control " name="jeniskelaminpemegangpolis" id="jeniskelaminpemegangpolis" disabled>
																	<? 			
																		if($DataAgen['JENISKELAMIN']=='M')
																		{
																	?> 
																		<option value="M" selected="true">Laki-Laki</option>
																		<option value="F">Perempuan</option>
																	<?
																		}
																		else
																		{
																	?>
																		<option value="M">Laki-Laki</option>
																		<option value="F" selected="true">Perempuan</option>
																	<?php 
																		} 
																	?>
																</select>
															</div>
														</div>
														<!-- Input nomor HP -->
														<div class="form-group">
															<label class="control-label col-md-4">Nomor Telp / HP
															<span class="required">
																 *
															</span>
															</label>

															<div class="box-body">
																<div class="row">
												                	<div class="col-xs-3">
												                  		<input readonly type="text" class="form-control" name="phonepemegangpolis" id="phonepemegangpolis" value="<?= strval($DataAgen['TELP']) ; ?>"/>
												                	</div>
												                	<label class="control-label col-xs-1"> / </label>
													                <div class="col-xs-3">
													                  <input readonly type="text" class="form-control" name="handphonepemegangpolis" id="handphonepemegangpolis" value="<?= strval($DataAgen['HP']) ; ?>"/>
													                </div>
													                
												              	</div>
												            </div>	
														</div>
														<!-- Input email -->
														<div class="form-group">
															<label class="control-label col-md-4">Email
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="emailpemegangpolis" id="emailpemegangpolis" value="<?= $DataAgen['EMAIL']; ?>"/>
															</div>
														</div>
									            	</div>

										            <!-- Kolom Kanan -->
										            <div class="col-md-5">
										              	<div class="form-group">
															<label class="control-label col-md-4">Alamat
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-8">
																<input readonly type="text" class="form-control" name="alamatpemegangpolis" id="alamatpemegangpolis"  value="<?= $DataAgen['ALAMAT']; ?>"/>
																
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">Kota
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="kotapemegangpolis" id="kotapemegangpolis"  value="<?= $DataAgen['KOTA']; ?>"/>
																<span class="help-block">
																</span>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">Provinsi
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<select readonly name="provinsipemegangpolis" class="form-control" id="provinsipemegangpolis">
																	<option value="">---Pilih Provinsi---</option>
																	<?php 
																		$KodeProvinsi = $DataAgen['KDPROVINSI'];
																		$Provinsi = $this->ModSimulasi->GetDataProvinsi($KodeProvinsi);
																	
																		foreach($provinsis as $provinsi=>$key){
																		
																	?>
																		<option value="<?= $provinsi; ?>" <? if($DataAgen['KDPROVINSI']==$provinsi){?> selected="" <? }?>><?= $key; ?>
		                                                                </option>
																	<?php } ?>
																</select>
															</div>
														</div>
														
														<div class="form-group">
															<label class="control-label col-md-4">Jenis Pekerjaan
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<input readonly type="hidden" class="form-control" name="kdjnspekerjaanpemegangpolis" id="kdjnspekerjaanpemegangpolis" value="<?= $DataAgen['KDJENISPEKERJAAN']; ?>"/>
																<input readonly type="text" class="form-control" name="pekerjaanpemegangpolis" id="pekerjaanpemegangpolis" value="<?= $DataAgen['NAMAPEKERJAAN']; ?>"/>
															</div>
														</div>

														<div class="form-group" hidden>
															<label class="control-label col-md-4">Status Perokok? <span class="required"> * </span></label>
															<div class="col-md-4">
																<select class="form-control " name="perokokpemegangpolis" id="perokokpemegangpolis" >
																	<option value="">Pilih Status Merokok</option>
																	<option value="T" selected>Tidak</option>
																	<option value="Y">Ya</option>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">No KTP
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-8">
																<input readonly type="text" class="form-control" name="noktppemegangpolis" id="noktppemegangpolis" value="<?= $DataAgen['NO_KTP']; ?>" required />
																
															</div>
											            </div>

											            <div class="form-group">
															<label class="control-label col-md-4">Status Pernikahan? <span class="required"> * </span></label>
															<div class="col-md-4">
																<select class="form-control " name="kawinpemegangpolis" id="kawinpemegangpolis" >
																	<option value="">Pilih Status Pernikahan</option>
																	<option value="K">Kawin</option>
																	<option value="B">Lajang/Bujang</option>
																</select>
															</div>
														</div>

														<input type="hidden" class="form-control" name="sessionid" id="sessionid" value="<?= $session_id; ?>"/>
														<input type="hidden" class="form-control" name="kodekantor" id="kodekantor" value="<?= $this->uri->segment(3); ?>"/>
														<input type="hidden" class="form-control" name="namaagen" id="namaagen" value="<?= $this->uri->segment(4); ?>"/>
														<input type="hidden" class="form-control" name="nomoragen" id="nomoragen" value="<?= $DataAgen['NOAGEN']; ?>"/>
														<input type="hidden" class="form-control" name="kodeprospek" id="kodeprospek" value="<?= $this->input->get('kode_prospek'); ?>"/>

										            </div>
									        	</div>
									        </div>
									        <!-- End Input Data Calon Pemegang Polis -->
											
											<!--Start Input Data Calon Tertanggung-->
											<div class="box-header with-border">
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Data Diri Calon Tertanggung</h3>
								            </div></br>
									        <div class="checkbox-list" data-error-container="#form_2_services_error">
												<label>
													<label class="el-checkbox">
														<input type="checkbox" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onclick="cekCPPsamadenganCTT()" />
														<span class="el-checkbox-style"></span>&nbsp&nbsp
														<b>Tertanggung sama dengan Pemegang Polis</b>
													</label>

												</label>
											</div> </br>
									        <div class="box-body">
									          	<div class="row">
									          		<!--Kolom Kiri-->
									            	<div class="col-md-5">
									            		<!--Input Nama-->
											            <div class="form-group">
															<label class="control-label col-md-4">Nama Lengkap
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<input type="text" class="form-control" name="namacalontertanggung" id="namacalontertanggung"/>
																
															</div>
											            </div>
											            <!-- Input tanggal lahir -->
											            <div class="form-group">
															<label class="control-label col-md-4">Tanggal Lahir (mm/dd/yyyy)<span class="required"> * </span></label>
															<div class="col-md-4">
																<input class="form-control form-control-inline input-xs datepicker" id="tanggallahircalontertanggung" name="tanggallahircalontertanggung" size="16" type="text" placeholder="Tanggal Lahir">
															</div>
											            </div>
											            <!-- Input jenis kelamin -->
														<div class="form-group">
															<label class="control-label col-md-4">Jenis Kelamin <span class="required"> * </span></label>
															<div class="col-md-4">
															<select class="form-control " name="jeniskelamincalontertanggung" id="jeniskelamincalontertanggung" >
															<option value="">Pilih Jenis Kelamin</option>
															<option value="M">Laki-Laki</option>
															<option value="F">Perempuan</option>
															</select>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">Usia
															<span class="required">
																 *
															</span>
															</label>
															<div class="box-body">
																<div class="row">
																	<div class="col-xs-2">
																		<input readonly type="text" class="form-control" name="usiacalontertanggung_th" id="usiacalontertanggung_th"/>
																	</div>
																	<label class="control-label col-xs-1">Tahun</label>
																	<div class="col-xs-2">
																		<input readonly type="text" class="form-control" name="usiacalontertanggung_bl" id="usiacalontertanggung_bl"/>
																	</div>
																	<label class="control-label col-xs-1">Bulan</label>
																</div>
															</div>
											            </div>

									            	</div>

										            <!-- Kolom Kanan -->
										            <div class="col-md-5">
										              	<!-- Input Hubungan dengan Pemegang Polis -->
														<div class="form-group">
															<label class="control-label col-md-4">Hubungan dgn PemPol <span class="required"> * </span></label>
															<div class="col-md-4">
																<select class="form-control " name="hubungandenganpempol" id="hubungandenganpempol" >
																	<option value="">Silahkan Pilih</option>
																	<option value="1">Suami/Istri</option>
																	<option value="2">Orang Tua/Anak</option>
																	<option value="3">Diri Sendiri</option>
																</select>
															</div>
														</div>
														
														<div class="form-group" hidden>
															<label class="control-label col-md-4">Status Perokok? <span class="required"> * </span></label>
															<div class="col-md-4">
															<select class="form-control " name="perokokcalontertanggung" id="perokokcalontertanggung" >
																<option value="">Pilih Status Merokok</option>
																<option value="T" selected>Tidak</option>
																<option value="Y">Ya</option>
															</select>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">Jenis Pekerjaan
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<select name="kdjnspekerjaancalontertanggung" id="kdjnspekerjaancalontertanggung" class="form-control" onchange="getEkstraPremi()">
														 			<option value="">Silahkan Pilih</option>
																	<?php foreach($pekerjaans as $i => $v) {
																		echo "<option value='$v[KDJENISPEKERJAAN]'>$v[NAMAPEKERJAAN]</option>";
																	} ?>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">No KTP
															<span class="required">
																 
															</span>
															</label>
															<div class="col-md-8">
																<input type="text" class="form-control" name="noktpcalontertanggung" id="noktpcalontertanggung" required />
															</div>
											            </div>

											            <div class="form-group">
															<label class="control-label col-md-4">Status Pernikahan? <span class="required"> * </span></label>
															<div class="col-md-4">
																<select class="form-control " name="kawincalontertanggung" id="kawincalontertanggung" >
																	<option value="">Pilih Status Pernikahan</option>
																	<option value="K">Kawin</option>
																	<option value="B">Lajang/Bujang</option>
																</select>
															</div>
														</div>
										            </div>
									        	</div>
									        </div>
											<!--End Input Data Calon Tertanggung-->
											
											<!--Start Input Data Pertanggungan-->
											<div class="box-header with-border">
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Data Pertanggungan</h3>
								            </div></br>
									        <div class="box-body">
									          	<div class="row">
									          		<!--Kolom Kiri-->
									            	<div class="col-md-5">
											            <!-- Input Cara Bayar-->
														<div class="form-group">
															<label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
															<div class="col-md-4">
																<select class="form-control " name="carabayarjspromapannew" id="carabayarjspromapannew" >
																	<option value="X">Sekaligus</option>
																</select>
															</div>
														</div>
														<!-- Input Usia Produktif-->
														<div class="form-group">
															<label class="control-label col-md-4">Usia Produktif sampai dengan
																<span class="required"></span>
															</label>
															<div class="col-md-4">
																<input class="form-control" type="number" name="usiaproduktif" id="usiaproduktif" value="70"/>
															</div>
															<span class="help-block">
																Tahun
															</span>
														</div> 
														<!-- Input Penghasilan Satu Tahun-->
														<div class="form-group">
															<label class="control-label col-md-4">Penghasilan Satu Tahun</label>
															<div class="col-md-4">
																<input type="text" class="form-control" value="0" type="number" name="penghasilansatutahun" id="penghasilansatutahun" />
															</div>
														</div>
									            	</div>

										            <!-- Kolom Kanan -->
										            <div class="col-md-5">										              	
														<!-- Input Premi Dasar -->
														<div class="form-group">
															<label class="control-label col-md-4">Premi Sekaligus <span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Premi Sekaligus" type="number" name="premidasar" id="premidasar" value="0" onchange="getAllTarif()">
																	
																</div>
															</div>
														</div>
														<!-- Input Nilai Uang Asuransi-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Manfaat Pensiun</i></b></label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" type="text" name="manfaat_pensiun" id="manfaat_pensiun" readonly>
																</div>
															</div>	
														</div>
										            </div>
									        	</div>
									        </div>
											<!--End Input Data Pertanggungan-->

								        	<!--Start Biaya Asuransi-->
											<div class="box-header with-border">
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Manfaat Asuransi</h3>
								            </div>
									        <div class="box-body">
									          	<div class="row">
									            	<div class="col-md-12">
									            		<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
															<table class="table table-striped table-hover xxxtab">
																<thead>
																	<tr>
																		<!-- <th>Number</th> -->
																		<th width="30%" style="text-align: center;">Nama Manfaat</th>
																		<th width="8%" style="text-align: center;">Y/N</th>
																		<th style="text-align: center;">Pensiun Hari Tua (PHT)</th>
																		<th style="text-align: center;">Pensiun Janda Duda (PJD)</th>
																		<th style="text-align: center;">Pensiun Yatim Piatu (PYT)</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<!-- <td>1</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp  JS Anuitas</td>
																		<td align="center">
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" name="" id="" checked disabled>
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="manfaat_pht" id="manfaat_pht"  value="0" disabled>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="manfaat_pjd" id="manfaat_pjd"  value="0" disabled>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="manfaat_pyt" id="manfaat_pyt"  value="0" disabled>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
									            	</div>
									    		</div>
								        	</div>
											<!--End Biaya Asuransi-->
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
													<a href="javascript:;" class="btn blue button-next" id="submitProposal" name="submitProposal">
														 Submit Proposal <i class="m-icon-swapright m-icon-white"></i>
													</a>
													<?php 
														$str = str_replace("/simulasi/", "", base_url());
													
													?>
													</a>
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
				 Copyright © 2019 Divisi Teknologi Informasi Jiwasraya - All Rights Reserved.
			</div>
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

		<!-- Untuk app.js tidak bisa diakses jadi dipindah directory - Teguh 09/12/2019 -->
		<script type="text/javascript" src="<?= base_url();?>assets/jscore/app.js"></script>

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
		<!-- END JAVASCRIPTS -->
		<script>
			$('.datepicker').datepicker();
		
			var today = new Date();
			var birthday = new Date(document.getElementById("tanggallahirpemegangpolis").value);
			if (today.getMonth() < birthday.getMonth()) {
				var year = 1;
				var month = -12;
				if(today.getDate() < birthday.getDate()){
					var month = -11;
				}
			}else if((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
				var year = 1;
				var month = 1;
			}else{
				var year = 0;
				var month = 0;
			}
			var usiacalonpemegangpolis = today.getFullYear() - birthday.getFullYear() - year;
			var usiacalonpemegangpolis_bl = today.getMonth() - birthday.getMonth() - month;
			document.getElementById("usiapemegangpolis_th").value = Math.floor(usiacalonpemegangpolis);
			document.getElementById("usiapemegangpolis_bl").value = Math.floor(usiacalonpemegangpolis_bl);

			if(Math.floor(usiacalonpemegangpolis) < 17 || Math.floor(usiacalonpemegangpolis) > 70){
				alert("Calon Pemegang Polis Minimal berusia 17 tahun dan Maksimal berusia 70 tahun");
				document.getElementById("usiapemegangpolis_th").value = "";
			}

			//Menghitung usia calon tertanggung
			$('#tanggallahircalontertanggung').on('change', function() {
				var hariini = new Date();
				var birthday_ctt = new Date(document.getElementById("tanggallahircalontertanggung").value);
				if (hariini.getMonth() < birthday_ctt.getMonth()) {
					var tahun = 1;
				}else if ((hariini.getMonth() == birthday_ctt.getMonth()) && hariini.getDate() < birthday_ctt.getDate()) {
					var tahun = 1;
				}else{
					var tahun=0;
				}
				var age = hariini.getFullYear() - birthday_ctt.getFullYear() - tahun;
				document.getElementById("usiacalontertanggung_th").value = Math.floor(age);
				
				if(age < 45){
					alert("Usia calon tertanggung minimal adalah 45 tahun.");
					document.getElementById("tanggallahircalontertanggung").value = "";
				}
			});

			function cekCPPsamadenganCTT() {
				var checkBox = document.getElementById("tertanggungsamadenganpemegangpolis");
				var kodeprospek = document.getElementById("kodeprospek");
				var kawinpempol = document.getElementById("kawinpemegangpolis").value;
				if(kawinpempol == ""){
					alert("Status pernikahan calon pemegang polis harap diisi terlebih dahulu.");
				}else{
					if (checkBox.checked == true){
						var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaanpemegangpolis").value;

						var usiasekarangctt = document.getElementById("usiapemegangpolis_th").value;
						if(usiasekarangctt > 64){
							$('#namacalontertanggung').prop('disabled', false);
							$('#tanggallahircalontertanggung').prop('disabled', false);
							$('#jeniskelamincalontertanggung').prop('disabled', false);
							$('#hubungandenganpempol').prop('disabled', false);
							$('#perokokcalontertanggung').prop('disabled', false);
							$('#kdjnspekerjaancalontertanggung').prop('disabled', false);
							$('#noktpcalontertanggung').prop('disabled', false);
							$('#kawincalontertanggung').prop('disabled', false);
							alert("Calon Tertanggung Maksimal berusia 64 tahun.");
							document.getElementById("tertanggungsamadenganpemegangpolis").checked = false;
							exit();
						}else{
							$('#namacalontertanggung').prop('disabled', true);
							$('#tanggallahircalontertanggung').prop('disabled', true);
							$('#jeniskelamincalontertanggung').prop('disabled', true);
							$('#hubungandenganpempol').prop('disabled', true);
							$('#perokokcalontertanggung').prop('disabled', true);
							$('#kdjnspekerjaancalontertanggung').prop('disabled', true);
							$('#noktpcalontertanggung').prop('disabled', true);
							$('#kawincalontertanggung').prop('disabled', true);
						}

						document.getElementById("namacalontertanggung").value = document.getElementById("namapemegangpolis").value;
						document.getElementById("tanggallahircalontertanggung").value = document.getElementById("tanggallahirpemegangpolis").value;
						document.getElementById("jeniskelamincalontertanggung").value = document.getElementById("jeniskelaminpemegangpolis").value;
						document.getElementById("usiacalontertanggung_th").value = document.getElementById("usiapemegangpolis_th").value;
						document.getElementById("usiacalontertanggung_bl").value = document.getElementById("usiapemegangpolis_bl").value;
						document.getElementById("hubungandenganpempol").value = 3;
						document.getElementById("perokokcalontertanggung").value = document.getElementById("perokokpemegangpolis").value;
						document.getElementById("kdjnspekerjaancalontertanggung").value = document.getElementById("kdjnspekerjaanpemegangpolis").value;
						document.getElementById("noktpcalontertanggung").value = document.getElementById("noktppemegangpolis").value;
						document.getElementById("kawincalontertanggung").value = document.getElementById("kawinpemegangpolis").value;
						//document.getElementById("pekerjaancalontertanggung").value = document.getElementById("pekerjaanpemegangpolis").value;

					}else {
						$('#namacalontertanggung').prop('disabled', false);
						$('#tanggallahircalontertanggung').prop('disabled', false);
						$('#jeniskelamincalontertanggung').prop('disabled', false);
						$('#hubungandenganpempol').prop('disabled', false);
						$('#perokokcalontertanggung').prop('disabled', false);
						$('#kdjnspekerjaancalontertanggung').prop('disabled', false);
						$('#noktpcalontertanggung').prop('disabled', false);
						$('#kawincalontertanggung').prop('disabled', false);
			
						//document.getElementById("ekstrapremilifectt").value ="";
						document.getElementById("namacalontertanggung").value = "";
						document.getElementById("tanggallahircalontertanggung").value = "";
						document.getElementById("jeniskelamincalontertanggung").value = "";
						document.getElementById("usiacalontertanggung_th").value = "";
						document.getElementById("usiacalontertanggung_bl").value = "";
						document.getElementById("hubungandenganpempol").value = 0;
						document.getElementById("kdjnspekerjaancalontertanggung").value = "";
						document.getElementById("noktpcalontertanggung").value ="";
						document.getElementById("kawincalontertanggung").value ="";
				  	};
				};

			};

			//function getHubungandgPempol
			$('#hubungandenganpempol').on('change', function() {
				var statushubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var usiasekarangcpp = document.getElementById("usiapemegangpolis_th").value;
				var usiasekarangctt = document.getElementById("usiacalontertanggung_th").value;

				if (statushubungandenganpempol == 1){
					var jeniskelamincpp = document.getElementById("jeniskelaminpemegangpolis").value;
					var jeniskelaminctt = document.getElementById("jeniskelamincalontertanggung").value;
					if(jeniskelaminctt == jeniskelamincpp){
						alert("Untuk hubungan suami/istri jenis kelamin calon pemegang polis dan calon tertanggung harus berbeda!");
						document.getElementById("hubungandenganpempol").value='';
						exit();
					}else{

					}
				}else if(statushubungandenganpempol == 3){
					$('#namacalontertanggung').prop('disabled', true);
					$('#tanggallahircalontertanggung').prop('disabled', true);
					$('#jeniskelamincalontertanggung').prop('disabled', true);
					$('#hubungandenganpempol').prop('disabled', true);
					$('#perokokcalontertanggung').prop('disabled', true);
					$('#kdjnspekerjaancalontertanggung').prop('disabled', true);
					$('#kawincalontertanggung').prop('disabled', true);
					$('#noktpcalontertanggung').prop('disabled', true);

					document.getElementById("tertanggungsamadenganpemegangpolis").checked = true;
					document.getElementById("namacalontertanggung").value = document.getElementById("namapemegangpolis").value;
					document.getElementById("tanggallahircalontertanggung").value = document.getElementById("tanggallahirpemegangpolis").value;
					document.getElementById("jeniskelamincalontertanggung").value = document.getElementById("jeniskelaminpemegangpolis").value;
					document.getElementById("usiacalontertanggung_th").value = document.getElementById("usiapemegangpolis_th").value;
					document.getElementById("usiacalontertanggung_bl").value = document.getElementById("usiapemegangpolis_bl").value;
					document.getElementById("hubungandenganpempol").value = 3;
					document.getElementById("perokokcalontertanggung").value = document.getElementById("perokokpemegangpolis").value;
					document.getElementById("kdjnspekerjaancalontertanggung").value = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					document.getElementById("noktpcalontertanggung").value = document.getElementById("noktppemegangpolis").value;
					document.getElementById("kawincalontertanggung").value = document.getElementById("kawinpemegangpolis").value;
				}
			});


			/**** FUNGSI UNTUK MENCARI NILAI PHT (PENSIUN HARI TUA), PJD & PYT ****/
			function getAllTarif(){
				$.LoadingOverlay("show");
				var usiasekarangctt_th = $("#usiacalontertanggung_th").val();
				var usiasekarangctt_bl = $("#usiacalontertanggung_bl").val();
				var kawincalontertanggung = document.getElementById("kawincalontertanggung").value;
				var premi = document.getElementById("premidasar").value;
				if(premi < 50000000){
					$.LoadingOverlay("hide");
					alert('Minimal Premi adalah sebesar Rp. 50.000.000,- (Lima puluh juta rupiah)');
					document.getElementById("premidasar").value ="";
					exit();
				}

				var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				var jeniskelaminctt = document.getElementById("jeniskelamincalontertanggung").value;
				var kawinpempol = document.getElementById("kawinpemegangpolis").value;
				
				if( kdjenispekerjaanctt=="" ||  hubungandenganpempol=="" || jeniskelaminctt=="" || premi==0 || kawinpempol == "" || kawincalontertanggung == "")
				{
					$.LoadingOverlay("hide");
					alert('Silahkan melengkapi data diri calon tertanggung atau data Pertanggungan terlebih dahulu!');
					document.getElementById("premidasar").value ="";
					exit();
				}				

                                console.log("usiacalontertanggung_th="+usiasekarangctt_th+"&usiacalontertanggung_bl="+usiasekarangctt_bl+"&statuskawin="+kawincalontertanggung);

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsanuitas_new/cgetTarifAll');?>",
					data	: "usiacalontertanggung_th="+usiasekarangctt_th+"&usiacalontertanggung_bl="+usiasekarangctt_bl+"&statuskawin="+kawincalontertanggung,
					success : function(msg) {
						var a = JSON.parse(msg);
						var tarif = a.TARIF;
						console.log("Tarif : "+tarif);

						var pht = premi / tarif.replace(",", ".") * 100;
						var pjd = 0.6 * pht;
						var pyt = 0.6 * pht;

						$('#manfaat_pensiun').val(Math.round(pht));
						$('#manfaat_pht').val(Math.round(pht));
						$('#manfaat_pjd').val(Math.round(pjd));
						$('#manfaat_pyt').val(Math.round(pyt));
						
						$.LoadingOverlay("hide");
					}
				});

			};
			/**** END MENCARI NILAI PHT, PJD & PYT ****/
			
			$('#submitProposal').on('click', function() {
				$.LoadingOverlay("show");
				var usia_cpp_th = document.getElementById("usiapemegangpolis_th").value;
				var usia_cpp_bl = document.getElementById("usiapemegangpolis_bl").value;
				var usia_ctt_th = document.getElementById("usiacalontertanggung_th").value;
				var usia_ctt_bl = document.getElementById("usiacalontertanggung_bl").value;
				var premi = document.getElementById("premidasar").value;
				var manfaat_pensiun = document.getElementById("manfaat_pensiun").value;

				if(usia_cpp_th < 17){
					$.LoadingOverlay("hide");
					alert("Usia calon pemegang polis minimal adalah 17 tahun.");
					exit();
				}else{
					if(usia_ctt_th < 45){
						$.LoadingOverlay("hide");
						alert("Usia calon tertanggung minimal adalah 45 tahun.");
						exit();
					}else{
						if(premi == "" || premi < 50000000){
							$.LoadingOverlay("hide");
							alert("Premi tidak boleh kosong dan minimal adalah Rp. 50.000.000,- (Lima puluh juta rupiah)");
							exit();
						}
						else{
							if(manfaat_pensiun == ""){
								$.LoadingOverlay("hide");
								alert("Manfaat asuransi tidak boleh kosong.");
								exit();
							}else{

							}
						}
					}
				}

				// if(usia_cpp_th < 17 || usia_ctt_th < 45 || premi == "" || premi < 50000000 || manfaat_pensiun == ""){
				// 	$.LoadingOverlay("hide");
				// 	alert("Usia calon tertanggung minimal 45 tahun");
				// 	exit();
				// }

				/* Data Calon Pemegang Polis */
				var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var namalengkap_cpp = document.getElementById("namapemegangpolis").value;
				var jeniskelamin_cpp = document.getElementById("jeniskelaminpemegangpolis").value;
				var tanggallahir_cpp = document.getElementById("tanggallahirpemegangpolis").value;
				var perokok_cpp = document.getElementById("perokokpemegangpolis").value;
				var phone_cpp = document.getElementById("phonepemegangpolis").value;
				var email_cpp = document.getElementById("emailpemegangpolis").value;
				var handphone_cpp = document.getElementById("handphonepemegangpolis").value;
				var kdjnspekerjaan_cpp = document.getElementById("kdjnspekerjaanpemegangpolis").value;
				var noktp_cpp = document.getElementById("noktppemegangpolis").value;
				var maritalstatus_cpp = document.getElementById("kawinpemegangpolis").value; 

				/* Data Calon Tertanggung */
				var namalengkap_ctt = document.getElementById("namacalontertanggung").value;
				var jeniskelamin_ctt = document.getElementById("jeniskelamincalontertanggung").value;
				var tanggallahir_ctt = document.getElementById("tanggallahircalontertanggung").value;
				var perokok_ctt = document.getElementById("perokokcalontertanggung").value;0
				var noktp_ctt = document.getElementById("noktpcalontertanggung").value;
				var kdjnspekerjaan_ctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				var maritalstatus_ctt = document.getElementById("kawincalontertanggung").value; 
				//console.log("hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&kdjnspekerjaanpempol="+kdjnspekerjaanpempol+"&noktpcpp="+noktpcpp);

				//Simpan Data Calon Pemegang Polis
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsanuitas_new/insertProPempol');?>",
					data	: "hubungandenganpempol="+hubungandenganpempol+"&namalengkap_cpp="+namalengkap_cpp+"&jeniskelamin_cpp="+jeniskelamin_cpp+"&tanggallahir_cpp="+tanggallahir_cpp+"&perokok_cpp="+perokok_cpp+"&usia_cpp_th="+usia_cpp_th+"&usia_cpp_bl="+usia_cpp_bl+"&phone_cpp="+phone_cpp+"&email_cpp="+email_cpp+"&handphone_cpp="+handphone_cpp+"&noktp_cpp="+noktp_cpp+"&kdjnspekerjaan_cpp="+kdjnspekerjaan_cpp+"&maritalstatus_cpp="+maritalstatus_cpp,
					success : function(msg) {

					}
				});

				//Simpan Data Calon Tertanggung
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsanuitas_new/insertProTertanggung');?>",
					data	: "hubungandenganpempol="+hubungandenganpempol+"&namalengkap_ctt="+namalengkap_ctt+"&jeniskelamin_ctt="+jeniskelamin_ctt+"&tanggallahir_ctt="+tanggallahir_ctt+"&perokok_ctt="+perokok_ctt+"&usia_ctt_th="+usia_ctt_th+"&usia_ctt_bl="+usia_ctt_bl+"&phone_cpp="+phone_cpp+"&email_cpp="+email_cpp+"&handphone_cpp="+handphone_cpp+"&noktp_ctt="+noktp_ctt+"&kdjnspekerjaan_ctt="+kdjnspekerjaan_ctt+"&maritalstatus_ctt="+maritalstatus_ctt,
					success : function(msg) {
						var filepdf = 'SIMULASI-'+document.getElementById("namacalontertanggung").value.toUpperCase()+'-'+msg;
						var kodeprospek =document.getElementById("kodeprospek").value;

						alert("Proposal Berhasil Disimpan!");
						window.location.href= "<?=base_url('jsanuitas_new/hasil')?>?buildid="+<?=$this->session->userdata('build_id');?>;
						$.LoadingOverlay("hide");
					}
				});

				//Simpan Data JAIM_300_HITUNG
				var kodeprospek =document.getElementById("kodeprospek").value;
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsanuitas_new/insertDataPDF');?>",
					data	: "&manfaat_pensiun="+manfaat_pensiun+"&premi="+premi+"&kodeprospek="+kodeprospek+"&namalengkap_ctt="+namalengkap_ctt,
					success : function(msg) {
	
					}
				});

			});
			
		</script>
	</body>
	<!-- END BODY -->
</html>