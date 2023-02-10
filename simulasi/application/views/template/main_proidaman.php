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
					<img src="<?= base_url();?>assets/img/jspos.jpg"/> <small>Power on Sales</small>
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
									 Asuransi IFG ULTIMATE PROTECTION
								</span>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form">
								<div class="form-wizard">
									<div class="form-body">
										<div class="box box-info">
											
											<!--Start Input Data untuk Perhitungan Uang Asuransi Nantinya di Hidden-->
											<div class="box-header with-border" hidden>
								              <h3 class="box-title" style="border-bottom-style: solid;border-bottom-color: #3c8dbc;">Data Untuk Perhitungan Uang Asuransi (Hidden)</h3>
								            </div></br>
									        <div class="box-body" hidden>
									          	<div class="row">
									            	<!--Kolom Kanan-->
													<div class="col-md-5">
									            		<!--Alokasi Premi-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ektra Premi Life CPP</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremilifecpp" id="ekstrapremilifecpp" value="<?= $DataAgen['LIFEEXTRA']; ?>" />
															</div>
											            </div>
											            <div class="form-group">
															<label class="control-label col-md-4">Ektra Premi Life CTT</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremilifectt" id="ekstrapremilifectt" />
															</div>
											            </div>
									            	</div>
									        	</div>
									        </div>
											<!--End Input Data untuk Perhitungan Uang Asuransi-->

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
															<label class="control-label col-sm-4">Tanggal Lahir<span class="required">
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
															<div class="col-md-3">
																<input readonly type="text" class="form-control" name="usiapemegangpolis" id="usiapemegangpolis"/>
															</div>
															<label class="control-label col-md-1">Tahun</label>
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

														<div class="form-group">
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
															<label class="control-label col-md-4">Tanggal Lahir<span class="required"> * </span></label>
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
															<div class="col-md-3">
																<input readonly type="text" class="form-control" name="usiacalontertanggung" id="usiacalontertanggung"/>
															</div>
															<label class="control-label col-md-1">Tahun</label>
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
														
														<div class="form-group">
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
									            		<!--Input Data Mulai Asuransi-->
											            <!-- <div class="form-group">
															<label class="control-label col-md-4">Tanggal Pembuatan<span class="required"> * </span></label>
															<div class="col-md-4">
																<input class="form-control form-control-inline input-xs datepicker" id="tanggalmulaiasuransi" name="tanggalmulaiasuransi" size="16" type="text" disabled />
															</div>
														</div> -->
											            <!-- Input Lama Asuransi -->
											            <div class="form-group">
															<label class="control-label col-md-4">Masa Asuransi SU
																<span class="required">
																	*
																</span>
															</label>
															<div class="col-md-4">
																<input type="text" class="form-control" name="masaasuransi" id="masaasuransi" type="number" value="99" readonly>
															</div>
															<span class="help-block"> Tahun	</span>
														</div>
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
															<label class="control-label col-md-4">Penghasilan Satu Tahun
																<span class="required">
																	*
																</span>
															</label>
															<div class="col-md-4">
																<input type="text" class="form-control" value="0" type="number" name="penghasilansatutahun" id="penghasilansatutahun" />
															</div>
														</div>
														<!-- Input Resiko Awal-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Resiko Awal Calon Tertanggung</b></i>
																<span class="required"></span>
															</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="resikoawalproposalctt" id="resikoawalproposalctt" />
															</div>
														</div>
														<!-- Input Resiko Awal-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Resiko Awal Calon Pemegang Polis</b></i>
																<span class="required">

																</span>
															</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" value="" type="number" name="resikoawalproposalcpp" id="resikoawalproposalcpp" />
															</div>
														</div>
									            	</div>

										            <!-- Kolom Kanan -->
										            <div class="col-md-5">										              	
														<!-- Input Premi Dasar -->
														<div class="form-group">
															<label class="control-label col-md-4">Premi Dasar Sekaligus <span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Premi Sekaligus" type="number" name="premidasar" id="premidasar" value="0" onchange="getAllTarif()">
																	
																</div>
															</div>
														</div>
														<!-- Input Top Up Sekaligus-->
														<div class="form-group">
															<label class="control-label col-md-4">Top Up Sekaligus<span class="required">  </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Top Up Sekaligus" type="number" name="topupsekaligus" id="topupsekaligus" value="0" >
																		
																</div>
															</div>	
														</div>
															
														<!-- Periode Top Up Sekaligus-->
														<div class="form-group">
															<label class="control-label col-md-4">Periode Top Up Sekaligus<span class="required">  </span> </label>
																<div class="col-md-4">
																	<div class="input-group">
																		<input class="form-control" placeholder="Periode Top Up Sekaligus" type="number" name="periodetopupsekaligus" id="periodetopupsekaligus" value="1" >
																	</div>
																</div>
														</div>
														<!-- Input Total Premi -->
														<div class="form-group">
															<label class="control-label col-md-4">Total Premi yang dibayar<span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																<input class="form-control" placeholder="Total Premi yang dibayar" type="number" name="totalpremi" id="totalpremi" value="0" readonly>
																	
																</div>
															</div>
														</div>
														<!-- Input Nilai Uang Asuransi-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Uang Asuransi</i></b></label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" type="text" name="uangasuransi" id="uangasuransi" readonly>
																</div>
															</div>	
														</div>

														<div class="form-group" id="ketuangasuransi" hidden>
															<label class="control-label col-md-4"></label>
															<div class="col-md-8">
																<div class="input-group">
																	<b><i>Risiko pekerjaan akan dinilai lebih lanjut, silahkan mengisi kuesioner</i></b>
																</div>
															</div>	
														</div>

														<!-- Testing untuk download kuesioner -->
														<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog" role="document">
																<div class="modal-content" style="height: 230px">
																	<div class="modal-header">
																		<h5 class="modal-title" id="exampleModalLabel">Download Kuesioner</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<div class="col-md-8 col-sm-6"><i class="fa fa-fw fa-download"></i>
																			<a target="_blank" href="<?= base_url();?>assets/kuesioner/KUISIONER_PEKERJAAN_TNI_OR_POLISI.pdf">Download Kuesioner Pekerjaan TNI/Polisi</a>
																		</div>
																		<div class="col-md-12 col-sm-6"><i class="fa fa-fw fa-download"></i>
																			<a target="_blank" href="<?= base_url();?>assets/kuesioner/KUISIONER_PENDAKI_GUNUNG_OR_TEBING.pdf">Download Kuesioner Pendaki Gunung/Tebing</a>
																		</div>
																		<div class="col-md-12 col-sm-6"><i class="fa fa-fw fa-download"></i>
																			<a target="_blank" href="<?= base_url();?>assets/kuesioner/KUISIONER_MENYELAM.pdf">Download Kuesioner Menyelam</a>
																		</div>
																		<div class="col-md-12 col-sm-6"><i class="fa fa-fw fa-download"></i>
																			<a target="_blank" href="<?= base_url();?>assets/kuesioner/KUISIONER_PEKERJA_PERTAMBANGAN_OR_PENGRAJIN_BERLIAN.pdf">Download Kuesioner Pekerja Pertambangan/Pengrajin Berlian</a>
																		</div>
																		<div class="col-md-12 col-sm-6"><i class="fa fa-fw fa-download"></i>
																			<a target="_blank" href="<?= base_url();?>assets/kuesioner/KUISIONER_AKTRIS_OR_AKTOR.pdf">Download Kuesioner Aktris/Aktor</a>
																		</div>
																		<div class="col-md-12 col-sm-6"><i class="fa fa-fw fa-download"></i>
																			<a target="_blank" href="<?= base_url();?>assets/kuesioner/KUISIONER_PEKERJA_DIPERUSAHAAN_OR_PABRIK_KIMIA.pdf">Download Kuesioner Pekerja Diperusahaan Pabrik Kimia</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<!-- End download kuesioner -->

														<input class="form-control" type="hidden" name="pemeriksaan" id="pemeriksaan" readonly>
														<input class="form-control" type="hidden" name="medical" id="medical" readonly>
										            </div>
									        	</div>
									        </div>
											<!--End Input Data Pertanggungan-->

											<!--Start Input Data Alokasi Dana Investasi-->
											<div class="box-header with-border">
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Fund Allocation</h3>
								            </div>
									        <div class="box-body">
									          	<div class="row">
									            	<div class="col-md-8">
									            		<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
															<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
																<thead>
																	<tr role="row" class="heading">
																		<th width="33%">Investment Fund Allocation</th>
																		<th width="33%"></th>
																		<th width="33%"></th>
																	</tr>
																	<tr role="row" class="filter">
																		<td rowspan="2">
																			<p style="margin-top:40px"><i>Fund Allocation</i></p>
																		</td>
																		<td>
																			<div class="form-group">
																				<div class="col-md-12">
																					<select class="form-control " name="alokasidana1" id="alokasidana1" >
																						<!-- <option value="">Pilih Alokasi Dana</option> -->
																						<option value="1">IFG LINK PASAR UANG</option>
																						<option value="2">IFG LINK PENDAPATAN TETAP</option>
																						<option value="3" selected>IFG LINK BERIMBANG</option>
																						<option value="4">IFG LINK EKUITAS</option>
																					</select>																				
																				</div>
																			</div>
																		</td>
																		<td>
																			<div class="form-group">
																				<div class="col-md-12">
																					<input class="form-control" placeholder="" type="number" name="persentasealokasidana1" id="persentasealokasidana1" value="95">
																				</div>
																			</div>
																		</td>
																	</tr>
																	<tr role="row" class="filter">
																		
																		<td>
																			<div class="form-group">
																				<div class="col-md-12">
																					<select class="form-control " name="alokasidana2" id="alokasidana2" >
																						<option value="">Pilih Alokasi Dana</option>
																						<option value="1" selected>IFG LINK PASAR UANG</option>
																						<option value="2">IFG LINK PENDAPATAN TETAP</option>
																						<option value="3">IFG LINK BERIMBANG</option>
																						<option value="4">IFG LINK EKUITAS</option>
																					</select>
																				</div>
																			</div>
																		</td>
																		<td>
																			<div class="form-group">
																				<div class="col-md-12">
																					<input class="form-control" placeholder="" type="number" name="persentasealokasidana2" id="persentasealokasidana2" value="5">
																				</div>
																			</div>
																		</td>
																	</tr>
																</thead>
															</table>
														</div>
									            	</div>
									    		</div>
								        	</div>
								        	<!--End Input Data Alokasi Dana Investasi-->

								        	<!--Start Biaya Asuransi-->
											<div class="box-header with-border">
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Pilihan Asuransi Tambahan</h3>
								            </div>
									        <div class="box-body">
									          	<div class="row">
									            	<div class="col-md-12">
									            		<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
															<table class="table table-striped table-hover xxxtab">
																<thead>
																	<tr>
																		<!-- <th>Number</th> -->
																		<th width="30%" style="text-align: center;">Nama Asuransi</th>
																		<th width="8%" style="text-align: center;">Y/N</th>
																		<th style="text-align: center;">Sampai Usia Tertanggung</th>
																		<th style="text-align: center;">Uang Asuransi</th>
																		<th style="text-align: center;">Biaya Asuransi Per Bulan</th>
																		<!--th style="text-align: center;">Tarif</th>
																		<th style="text-align: center;">Resiko Awal</th-->
																	</tr>
																</thead>
																<tbody>
																	<!-- Biaya Asuransi : Uang Asuransi Dasar -->
																	<tr>
																		<!-- <td>1</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp  Asuransi Dasar</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jsuangasuransidasar" id="jsuangasuransidasar">
																				<option value="1">1</option>
																			</select> -->

																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" name="pil_jsuangasuransidasar" id="pil_jsuangasuransidasar" checked disabled>
																				<span class="el-checkbox-style"></span>
																			</label>

																		</td>
																		<td>
																			<input class="form-control" type="text" value="99" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransidasar" id="uangasuransidasar"  value="0" disabled>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransidasar" id="biayauangasuransidasar"  value="0" disabled>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransidasar" id="tarifuangasuransidasar"  value="0" disabled>
																		
																			<input hidden class="form-control" type="hidden" name="resikoawaluangasuransidasar" id="resikoawaluangasuransidasar"  placeholder="0" disabled>
																		
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
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<!-- <script src="<?= base_url();?>assets/scripts/core/app.js"></script> -->
		<!--script src="<?= base_url();?>assets/scripts/custom/form-wizard.js"></script-->

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
			}else if ((today.getMonth() == birthday.getMonth()) && today.getDate() < birthday.getDate()) {
				var year = 1;
			}else{
				var year=0;
			}
			var usiacalonpemegangpolis = today.getFullYear() - birthday.getFullYear() - year;
			document.getElementById("usiapemegangpolis").value = Math.floor(usiacalonpemegangpolis);

			if(Math.floor(usiacalonpemegangpolis) < 17 || Math.floor(usiacalonpemegangpolis) > 70){
				alert("Calon Pemegang Polis Minimal berusia 17 tahun dan Maksimal berusia 70 tahun");
				document.getElementById("usiapemegangpolis").value = "";
			}
			//console.log("usia : ");

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
				document.getElementById("usiacalontertanggung").value = Math.floor(age);
				
				var bulan = ((hariini-birthday_ctt) / (365.7 * 24 * 60 * 60 * 1000));
				if(bulan < 0.5 || age > 64){
					alert("Calon Tertanggung Minimal berusia 6 bulan dan Maksimal berusia 64 tahun");
					document.getElementById("tanggallahircalontertanggung").value = "";
				}
			});

			function cekCPPsamadenganCTT() {
				var checkBox = document.getElementById("tertanggungsamadenganpemegangpolis");
				var kodeprospek = document.getElementById("kodeprospek");
				//console.log(kodeprospek);
				if (checkBox.checked == true){
					var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					//console.log(kdjenispekerjaanctt);
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsproidaman_new/cgetEkstraPremi');?>",
						data	: "kdjenispekerjaanctt="+kdjenispekerjaanctt,
						success : function(msg) {
							var b = JSON.parse(msg);
							var nilaiekstrapremilife = b.LIFEEXTRA;
							$('#ekstrapremilifectt').val(nilaiekstrapremilife);
							
						}
					});

					//Fungsi Untuk Mencari Tarif Resiko Awal
					var usiasekarangctt = document.getElementById("usiapemegangpolis").value;
					if(usiasekarangctt > 64){
						$('#namacalontertanggung').prop('disabled', false);
						$('#tanggallahircalontertanggung').prop('disabled', false);
						$('#jeniskelamincalontertanggung').prop('disabled', false);
						$('#hubungandenganpempol').prop('disabled', false);
						$('#perokokcalontertanggung').prop('disabled', false);
						$('#kdjnspekerjaancalontertanggung').prop('disabled', false);
						$('#noktpcalontertanggung').prop('disabled', false);
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

					}

					document.getElementById("namacalontertanggung").value = document.getElementById("namapemegangpolis").value;
					document.getElementById("tanggallahircalontertanggung").value = document.getElementById("tanggallahirpemegangpolis").value;
					document.getElementById("jeniskelamincalontertanggung").value = document.getElementById("jeniskelaminpemegangpolis").value;
					document.getElementById("usiacalontertanggung").value = document.getElementById("usiapemegangpolis").value;
					document.getElementById("hubungandenganpempol").value = 3;
					document.getElementById("perokokcalontertanggung").value = document.getElementById("perokokpemegangpolis").value;
					document.getElementById("kdjnspekerjaancalontertanggung").value = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					document.getElementById("noktpcalontertanggung").value = document.getElementById("noktppemegangpolis").value;
					//document.getElementById("pekerjaancalontertanggung").value = document.getElementById("pekerjaanpemegangpolis").value;

				}else {
					$('#namacalontertanggung').prop('disabled', false);
					$('#tanggallahircalontertanggung').prop('disabled', false);
					$('#jeniskelamincalontertanggung').prop('disabled', false);
					$('#hubungandenganpempol').prop('disabled', false);
					$('#perokokcalontertanggung').prop('disabled', false);
					$('#kdjnspekerjaancalontertanggung').prop('disabled', false);
					$('#noktpcalontertanggung').prop('disabled', false);
		
					document.getElementById("ekstrapremilifectt").value ="";
					document.getElementById("namacalontertanggung").value = "";
					document.getElementById("tanggallahircalontertanggung").value = "";
					document.getElementById("jeniskelamincalontertanggung").value = "";
					document.getElementById("usiacalontertanggung").value = "";
					document.getElementById("hubungandenganpempol").value = 0;
					document.getElementById("kdjnspekerjaancalontertanggung").value = "";
					document.getElementById("noktpcalontertanggung").value ="";
			  	};
			};

			//function getHubungandgPempol
			$('#hubungandenganpempol').on('change', function() {
				var statushubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var usiasekarangcpp = document.getElementById("usiapemegangpolis").value;
				var usiasekarangctt = document.getElementById("usiacalontertanggung").value;

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
					var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					//console.log(kdjenispekerjaanctt);
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsproidaman_new/cgetEkstraPremi');?>",
						data	: "kdjenispekerjaanctt="+kdjenispekerjaanctt,
						success : function(msg) {
							var b = JSON.parse(msg);
							var nilaiekstrapremilife = b.LIFEEXTRA;
							$('#ekstrapremilifectt').val(nilaiekstrapremilife);

							$('#namacalontertanggung').prop('disabled', true);
							$('#tanggallahircalontertanggung').prop('disabled', true);
							$('#jeniskelamincalontertanggung').prop('disabled', true);
							$('#hubungandenganpempol').prop('disabled', true);
							$('#perokokcalontertanggung').prop('disabled', true);
							$('#kdjnspekerjaancalontertanggung').prop('disabled', true);
						}
					});

					document.getElementById("tertanggungsamadenganpemegangpolis").checked = true;
					document.getElementById("namacalontertanggung").value = document.getElementById("namapemegangpolis").value;
					document.getElementById("tanggallahircalontertanggung").value = document.getElementById("tanggallahirpemegangpolis").value;
					document.getElementById("jeniskelamincalontertanggung").value = document.getElementById("jeniskelaminpemegangpolis").value;
					document.getElementById("usiacalontertanggung").value = document.getElementById("usiapemegangpolis").value;
					document.getElementById("hubungandenganpempol").value = 3;
					document.getElementById("perokokcalontertanggung").value = document.getElementById("perokokpemegangpolis").value;
					document.getElementById("kdjnspekerjaancalontertanggung").value = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					document.getElementById("noktpcalontertanggung").value = document.getElementById("noktppemegangpolis").value;
				}
			});

			function getEkstraPremi(){
				var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/cgetEkstraPremi');?>",
					data	: "kdjenispekerjaanctt="+kdjenispekerjaanctt,
					success : function(msg) {
						var z = JSON.parse(msg);
						var nilaiekstrapremilife = z.LIFEEXTRA;
						$('#ekstrapremilifectt').val(nilaiekstrapremilife);

						if(nilaiekstrapremilife == 'REFER'){
							alert("Risiko pekerjaan akan dinilai lebih lanjut, silahkan mengisi kuesioner.");
							document.getElementById("kdjnspekerjaancalontertanggung").value="";
							document.getElementById("uangasuransi").value=0;
							$('#ketuangasuransi').prop('hidden', false);
						}
					}
				});
			};

			/**** FUNGSI UNTUK MENGHITUNG UANG ASURANSI (JUA) DAN BIAYA ASURANSI ****/
			function getAllTarif(){
				$.LoadingOverlay("show");
				$('#ketuangasuransi').prop('hidden', true);
				var usiasekarangctt = $("#usiacalontertanggung").val();
				var usiasekarangcpp = $("#usiapemegangpolis").val();				
				var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				var jeniskelaminctt = document.getElementById("jeniskelamincalontertanggung").value;
				var perokokcalontertanggung = document.getElementById("perokokcalontertanggung").value;
				var premi = document.getElementById("premidasar").value;

				/** FUNGSI untuk menghitung besar ACTIVE INCOME CALON TERTANGGUNG **/
				var penghasilan 	= document.getElementById("penghasilansatutahun").value;
				var usiaproduktif 	= document.getElementById("usiaproduktif").value;
				var activeincome 	= (usiaproduktif - usiasekarangctt) * penghasilan;
				/** END - FUNGSI untuk menghitung besar ACTIVE INCOME CALON TERTANGGUNG **/

				if( kdjenispekerjaanctt=="" ||  hubungandenganpempol=="" || jeniskelaminctt=="" || perokokcalontertanggung =="" || premi==0 || penghasilan=="")
				{
					$.LoadingOverlay("hide");
					alert('Silahkan melengkapi data diri calon tertanggung atau data Pertanggungan terlebih dahulu!');
					document.getElementById("premidasar").value ="";
					exit();
				}				

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/cgetTarifAll');?>",
					data	: "usiacalontertanggung="+usiasekarangctt,
					success : function(msg) {
						var a = JSON.parse(msg);
						
						if (perokokcalontertanggung=='T') {
							var tariftermlife = a.TERMLIFE_NONSMOKER;
						}else{
							var tariftermlife = a.TERMLIFE_SMOKER;
						}
						
						//Cek Nilai Ektra Premi Karena RESIKO PEKERJAAN
						var nilaiekstrapremilife_ctt = document.getElementById("ekstrapremilifectt").value;
						
						//Fungsi untuk mengubah tarif (koma ke titik) dan membagi menjadi 12
						if(nilaiekstrapremilife_ctt == 'REFER'){
							var tariftermlife_ = 0;
						}else{
							var tariftermlife_ = (1 + (nilaiekstrapremilife_ctt / 1000)) * (tariftermlife.replace(",", ".")) / 12;
						}

						//Memanggil nilai-nilai untuk perhitungan JUA
						if(premi < 12000000){
							var hasilhitungjua = 0;
							var totalresikoawalctt = 0;
						}else{
							var hasilhitungjua = 1.25 * premi;
							var totalresikoawalctt = hasilhitungjua;
						}
						var totalresikoawalcpp = 0;

						$('#uangasuransi').val(Math.round(hasilhitungjua));
						$('#uangasuransidasar').val(Math.round(hasilhitungjua));
						$('#resikoawaluangasuransidasar').val(Math.round(hasilhitungjua));	

						//Menghitung Biaya Asuransi Dasar per Bulan
						var biayaasuransidasar = (hasilhitungjua * tariftermlife_ / 1000);
						$('#biayauangasuransidasar').val(Math.round(biayaasuransidasar));
						
						if(usiasekarangctt <= 5){
							if(totalresikoawalctt <= 1500000000){
								var pemeriksaan = '';
								var medical = '';
							}else{
								var pemeriksaan = 'LPK';
								var medical = 'M';
							}							
						}else if(usiasekarangctt >= 6 && usiasekarangctt <= 14){
							if(totalresikoawalctt <= 1500000000){
								var pemeriksaan = '';
								var medical = '';
							}else{
								var pemeriksaan = 'A';
								var medical = 'M';
							}							
						}else if(usiasekarangctt >= 15 && usiasekarangctt <= 16){
							if(totalresikoawalctt <= 1500000000){
								var pemeriksaan = '';
								var medical = '';
							}else{
								var pemeriksaan = 'B';
								var medical = 'M';
							}							
						}else if(usiasekarangctt == 17){
							if(totalresikoawalctt <= 1500000000){
								var pemeriksaan = '';
								var medical = '';
							}else if(totalresikoawalctt >= 1500000001 && totalresikoawalctt <= 2000000000){
								var pemeriksaan = 'B';
								var medical = 'M';
							}else if(totalresikoawalctt >= 2000000001 && totalresikoawalctt <= 4000000000){
								var pemeriksaan = 'D';
								var medical = 'M';
							}else{
								var pemeriksaan = 'E';
								var medical = 'M';
							}							
						}else if(usiasekarangctt >= 18 && usiasekarangctt <= 45){
							if(totalresikoawalctt <= 2000000000){
								var pemeriksaan = '';
								var medical = '';
							}else if(totalresikoawalctt >= 2000000001 && totalresikoawalctt <= 4000000000){
								var pemeriksaan = 'D';
								var medical = 'M';
							}else{
								var pemeriksaan = 'E';
								var medical = 'M';
							}
						}else if(usiasekarangctt >= 46 && usiasekarangctt <= 50){
							if(totalresikoawalctt <= 1000000000){
								var pemeriksaan = '';
								var medical = '';
							}else if(totalresikoawalctt >= 1000000001 && totalresikoawalctt <= 2000000000){
								var pemeriksaan = 'C';
								var medical = 'M';
							}else{
								var pemeriksaan = 'E';
								var medical = 'M';
							}
						}else if(usiasekarangctt >= 51 && usiasekarangctt <= 55){
							if(totalresikoawalctt <= 800000000){
								var pemeriksaan = '';
								var medical = '';
							}else if(totalresikoawalctt >= 800000001 && totalresikoawalctt <= 1000000000){
								var pemeriksaan = 'A';
								var medical = 'M';
							}else if(totalresikoawalctt >= 1000000001 && totalresikoawalctt <= 2000000000){
								var pemeriksaan = 'C';
								var medical = 'M';
							}else{
								var pemeriksaan = 'E';
								var medical = 'M';
							}
						}else if(usiasekarangctt >= 56 && usiasekarangctt <= 60){
							if(totalresikoawalctt <= 650000000){
								var pemeriksaan = '';
								var medical = '';
							}else if(totalresikoawalctt >= 650000001 && totalresikoawalctt <= 1000000000){
								var pemeriksaan = 'B';
								var medical = 'M';
							}else if(totalresikoawalctt >= 1000000001 && totalresikoawalctt <= 2000000000){
								var pemeriksaan = 'D';
								var medical = 'M';
							}else{
								var pemeriksaan = 'E';
								var medical = 'M';
							}
						}else{
							if(totalresikoawalctt <= 650000000){
								var pemeriksaan = '';
								var medical = '';
							}else if(totalresikoawalctt >= 650000001 && totalresikoawalctt <= 1000000000){
								var pemeriksaan = 'C';
								var medical = 'M';
							}else if(totalresikoawalctt >= 1000000001 && totalresikoawalctt <= 2000000000){
								var pemeriksaan = 'D';
								var medical = 'M';
							}else{
								var pemeriksaan = 'E';
								var medical = 'M';
							}
						}

						$('#pemeriksaan').val(pemeriksaan);
						$('#medical').val(medical);
						//console.log("Jenis Pemeriksaan CTT : "+pemeriksaan);

						$('#resikoawalproposalctt').val(Math.round(totalresikoawalctt));
						$('#resikoawalproposalcpp').val(Math.round(totalresikoawalcpp));
						$.LoadingOverlay("hide");
					}
				});

			};

			$('#topupsekaligus').on('change', function() {
				var topupsekaligus = document.getElementById("topupsekaligus").value;
				var premidasar = document.getElementById("premidasar").value;
				if(topupsekaligus < 1000000){
					alert("Minimal Topup Sekaligus adalah satu juta (Rp 1.000.000,-)");
					document.getElementById("topupsekaligus").value = "";
				}
				var totalpremi = (premidasar*1)+(topupsekaligus*1);
				$('#totalpremi').val(Math.round(totalpremi));
			});
			
			$('#premidasar').on('change', function() {
				var premidasar = document.getElementById("premidasar").value;
				var topupsekaligus = document.getElementById("topupsekaligus").value;
				if(premidasar<12000000){
					alert("Minimal Premi sebesar Rp 12.000.000,-");
					document.getElementById("premidasar").value ="";
					exit();
				}else{
					var totalpremi = (premidasar*1)+(topupsekaligus*1);
				}
				$('#totalpremi').val(Math.round(totalpremi));	
			});

			$('#persentasealokasidana1').on('change', function() {
				var nilfund1 = document.getElementById("persentasealokasidana1").value;
				var nilfund2 = document.getElementById("persentasealokasidana2").value;
				var sisa = nilfund1%5;
				//console.log("Sisa : "+sisa);
				if(sisa != 0 || nilfund1 > 100 || nilfund2>100){
					alert("Nilai Alokasi Fund harus kelipatan 5 dan tidak boleh lebih dari 100!");
					document.getElementById("persentasealokasidana1").value = 0;
					document.getElementById("persentasealokasidana2").value = 0;
				}else{
					if(nilfund1 == 100){
						$('#alokasidana2').prop('disabled', true);
						$('#persentasealokasidana2').prop('disabled', true);
						document.getElementById("alokasidana2").value = '';
						document.getElementById("persentasealokasidana2").value = 0;
					}else{
						document.getElementById("alokasidana2").value = '2';
						$('#alokasidana2').prop('disabled', false);
						$('#persentasealokasidana2').prop('disabled', false);
						document.getElementById("persentasealokasidana2").value = 100-nilfund1;
					}
				}
			});
			$('#persentasealokasidana2').on('change', function() {
				var nilfund1 = document.getElementById("persentasealokasidana1").value;
				var nilfund2 = document.getElementById("persentasealokasidana2").value;
				var sisa = nilfund2%5;
				console.log("Sisa : "+sisa);
				if(sisa != 0 || nilfund1 > 100 || nilfund2>100){
					alert("Nilai Alokasi Fund harus kelipatan 5 dan tidak boleh lebih dari 100!");
					document.getElementById("persentasealokasidana1").value = 0;
					document.getElementById("persentasealokasidana2").value = 0;
				}else{
					document.getElementById("persentasealokasidana1").value = 100-nilfund2;
				}
			});

			
			$('#submitProposal').on('click', function() {

				$.LoadingOverlay("show");
				var usiapp = document.getElementById("usiapemegangpolis").value;
				var UA = document.getElementById("uangasuransi").value;
				var pilihanalokasi1 = document.getElementById("alokasidana1").value;
				var pilihanalokasi2 = document.getElementById("alokasidana2").value;
				var nilfund1 = document.getElementById("persentasealokasidana1").value;
				var nilfund2 = document.getElementById("persentasealokasidana2").value;
				var premi = document.getElementById("premidasar").value;
				var jmlfund = (nilfund1*1) + (nilfund2*1);
				console.log("TOTAL NILAI FUND : "+jmlfund);
				if(usiapp < 17 || usiapp > 70 || UA==0 || pilihanalokasi1=="" || jmlfund != 100 || pilihanalokasi1 == pilihanalokasi2 || premi ==""){
					$.LoadingOverlay("hide");
					alert("Nilai uang asuransi atau pilihan investasi masih kosong/tidak boleh sama atau jumlah nilai fund kurang dari 100!");
					exit();
				}

				var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var perokokpempol = document.getElementById("perokokpemegangpolis").value;
				var namalengkap = document.getElementById("namapemegangpolis").value;
				var tanggallahir = document.getElementById("tanggallahirpemegangpolis").value;
				var gender = document.getElementById("jeniskelaminpemegangpolis").value;
				var email = document.getElementById("emailpemegangpolis").value;
				var handphone = document.getElementById("handphonepemegangpolis").value;
				var phone = document.getElementById("phonepemegangpolis").value;
				var kdjnspekerjaanpempol = document.getElementById("kdjnspekerjaanpemegangpolis").value;
				var noktpcpp = document.getElementById("noktppemegangpolis").value;

				var perokok = document.getElementById("perokokcalontertanggung").value;
				var namalengkapcalontertanggung = document.getElementById("namacalontertanggung").value;
				var tanggallahircalontertanggung = document.getElementById("tanggallahircalontertanggung").value;
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var noktp = document.getElementById("noktpcalontertanggung").value;
				var kdjnspekerjaancalontertanggung = document.getElementById("kdjnspekerjaancalontertanggung").value;
				//console.log("hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&kdjnspekerjaanpempol="+kdjnspekerjaanpempol+"&noktpcpp="+noktpcpp);

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/insertProPempol');?>",
					data	: "hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&kdjnspekerjaanpempol="+kdjnspekerjaanpempol+"&noktpcpp="+noktpcpp,
					success : function(msg) {

					}
				});

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/insertProTertanggung');?>",
					data	: "hubungandenganpempol="+hubungandenganpempol+"&perokok="+perokok+"&namalengkapcalontertanggung="+namalengkapcalontertanggung+"&tanggallahircalontertanggung="+tanggallahircalontertanggung+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&noktp="+noktp+"&kdjnspekerjaancalontertanggung="+kdjnspekerjaancalontertanggung,
					success : function(msg) {

					}
				});

				var tanggalilustrasi = new Date();
				var asumsicutipremi = Math.round(document.getElementById("masaasuransi").value - document.getElementById("usiacalontertanggung").value);
				var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;
				var usiaproduktif = document.getElementById("usiaproduktif").value;
				var penghasilansatutahun = document.getElementById("penghasilansatutahun").value;
				var maksimaluangasuransi = usiaproduktif * penghasilansatutahun;
				var uangpertanggungan = document.getElementById("uangasuransi").value;
				var premidasar = Math.round(document.getElementById("premidasar").value);
				var topupsekaligus = document.getElementById("topupsekaligus").value;
				var totalpremi = document.getElementById("totalpremi").value;
				var resikoawalproposalctt = document.getElementById("resikoawalproposalctt").value;
				var periodetopupsekaligus = document.getElementById("periodetopupsekaligus").value;
				var pemeriksaan = document.getElementById("pemeriksaan").value;
				var medical = document.getElementById("medical").value;

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/insertProAsuransiPokok');?>",
					data	: "asumsicutipremi="+asumsicutipremi+"&carabayarjspromapannew="+carabayarjspromapannew+"&usiaproduktif="+usiaproduktif+"&penghasilansatutahun="+penghasilansatutahun+"&maksimaluangasuransi="+maksimaluangasuransi+"&uangpertanggungan="+uangpertanggungan+"&premidasar="+premidasar+"&topupsekaligus="+topupsekaligus+"&totalpremi="+totalpremi+"&resikoawalproposalctt="+resikoawalproposalctt+"&periodetopupsekaligus="+periodetopupsekaligus+"&pemeriksaan="+pemeriksaan+"&medical="+medical,
					success : function(msg) {

					}
				});

				var alokasidana1 = document.getElementById("alokasidana1").value;
				var persentasealokasidana1 = document.getElementById("persentasealokasidana1").value;
				var alokasidana2 = document.getElementById("alokasidana2").value;
				var persentasealokasidana2 = document.getElementById("persentasealokasidana2").value;
				var usiasekarang = document.getElementById("usiacalontertanggung").value;
				//console.log("alokasidana1="+alokasidana1+"&persentasealokasidana1="+persentasealokasidana1+"&carabayarjspromapannew="+carabayarjspromapannew+"&totalpremi="+totalpremi+"&usiasekarang="+usiasekarang);
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/insertProAlokasiDana');?>",
					data	: "alokasidana1="+alokasidana1+"&persentasealokasidana1="+persentasealokasidana1+"&alokasidana2="+alokasidana2+"&persentasealokasidana2="+persentasealokasidana2+"&carabayarjspromapannew="+carabayarjspromapannew+"&totalpremi="+totalpremi+"&usiasekarang="+usiasekarang,
					success : function(msg) {

					}
				});

				var is_uadasar = 1;
				var uadasar = document.getElementById("uangasuransidasar").value;
				var biaya_uadasar = document.getElementById("biayauangasuransidasar").value;
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/insertProDataRider');?>",
					data	: "is_uadasar="+is_uadasar+"&uadasar="+uadasar+"&biaya_uadasar="+biaya_uadasar,
					success : function(msg) {				
						//alert(msg);						 		
						var filepdf = 'SIMULASI-SMART_PROMAPAN-'+document.getElementById("namacalontertanggung").value.toUpperCase()+'-'+msg;
						var kodeprospek =document.getElementById("kodeprospek").value;
						
						alert("Proposal Berhasil Disimpan!");
						window.location.href= "<?=base_url('jsproidaman_new/hasil')?>?buildid="+<?=$this->session->userdata('build_id');?>+'&filepdf='+filepdf+'&kodeprospek='+kodeprospek; 
						$.LoadingOverlay("hide");
 
					}
				});

				var kodeprospek =document.getElementById("kodeprospek").value;

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsproidaman_new/insertDataPDF');?>",
					data	: "carabayarjspromapannew="+carabayarjspromapannew+"&uangpertanggungan="+uangpertanggungan+"&totalpremi="+totalpremi+"&kodeprospek="+kodeprospek+"&namalengkapcalontertanggung="+namalengkapcalontertanggung,
					success : function(msg) {	
						//alert(msg);
					}
				});

			});
			
		</script>
	</body>
	<!-- END BODY -->
</html>