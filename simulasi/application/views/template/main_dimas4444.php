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
									 Asuransi JS PROMAPAN
								</span>
							</div>
						</div>
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form">
								<div class="form-wizard">
									<div class="form-body">
										<div class="box box-info">
											
											<!--Start Input Data untuk Perhitungan Uang Asuransi Nantinya di Hidden-->
											<div class="box-header with-border">
								              <h3 class="box-title" style="border-bottom-style: solid;border-bottom-color: #3c8dbc;">Data Untuk Perhitungan Uang Asuransi (Hidden)</h3>
								            </div></br>
									        <div class="box-body">
									          	<div class="row">
									          		<!--Kolom Kiri-->
									            	<div class="col-md-5">
									            		<!--Alokasi Premi-->
											            <div class="form-group">
															<label class="control-label col-md-4">Alokasi Premi</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="rumusalokasipremi" id="rumusalokasipremi" value="49.50"/>
															</div>
											            </div>
											            <!--COA-->
											            <div class="form-group">
															<label class="control-label col-md-4">COA</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="rumuscoa" id="rumuscoa" placeholder="27500" />
															</div>
											            </div>
											            <!--Asumsi Dana di Invest-->
											            <div class="form-group">
															<label class="control-label col-md-4">Asumsi Dana di Invest</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="rumusasumsidanainvest" id="rumusasumsidanainvest" value="5" />
															</div>
											            </div>
											            <!--Sisa Dana COI dan COR-->
											            <div class="form-group">
															<label class="control-label col-md-4">Sisa Dana COI dan COR</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="rumussisadanacoicor" id="rumussisadanacoicor" placeholder="Dihitung Otomatis" />
															</div>
											            </div>
											            <!--Sisa Biaya (COI + ADB)/(COI+COR)-->
											            <div class="form-group">
															<label class="control-label col-md-4">Sisa Biaya (COI + ADB)/(COI+COR)</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="rumussisabiayacoicor" id="rumussisabiayacoicor" value="30" />
															</div>
											            </div>
									            	</div>

									            	<!--Kolom Kanan-->
													<div class="col-md-5">
									            		<!--Alokasi Premi-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ektra Premi Life CPP</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremilifecpp" id="ekstrapremilifecpp" value="<?= $DataAgen['LIFEEXTRA']; ?>" />
															</div>
											            </div>
											            <!--COA-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ekstra Premi ADB / ADDB CPP</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremipacpp" id="ekstrapremipacpp" value="<?= $DataAgen['PAEXTRA']; ?>" />
															</div>
											            </div>
											            <!--Asumsi Dana di Invest-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ekstra Premi TPD CPP</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremitpdcpp" id="ekstrapremitpdcpp" value="<?= $DataAgen['TPDEXTRA']; ?>" />
															</div>
											            </div>
											            <div class="form-group">
															<label class="control-label col-md-4">Ektra Premi Life CTT</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremilifectt" id="ekstrapremilifectt" />
															</div>
											            </div>
											            <!--COA-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ekstra Premi ADB / ADDB CTT</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremipactt" id="ekstrapremipactt" />
															</div>
											            </div>
											            <!--Asumsi Dana di Invest-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ekstra Premi TPD CTT</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremitpdctt" id="ekstrapremitpdctt" />
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
																<select name="provinsipemegangpolis" class="form-control" id="provinsipemegangpolis">
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
															<label class="control-label col-md-4">Pekerjaan
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
																	<option value="T">Tidak</option>
																	<option value="Y">Ya</option>
																</select>
															</div>
														</div>

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
													<input type="checkbox" value="1" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onclick="cekCPPsamadenganCTT()" /> <b>Tertanggung sama dengan Pemegang Polis</b>
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
																<input class="form-control form-control-inline input-xs datepicker" id="tanggallahircalontertanggung" name="tanggallahircalontertanggung" size="16" type="text" placeholder="Tanggal Lahir" onkeyup="hitUsiaCTT();"/>
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
																<option value="T">Tidak</option>
																<option value="Y">Ya</option>
															</select>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">Pekerjaan
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<select name="kdjnspekerjaancalontertanggung" id="kdjnspekerjaancalontertanggung" class="form-control" onclick="getEkstraPremi()">
                                                        			<option value="">Silahkan Pilih</option>
                                                        			<?php foreach($pekerjaans as $i => $v) {
		                                                           		echo "<option value='$v[KDJENISPEKERJAAN]'>$v[NAMAPEKERJAAN]</option>";
		                                                        	} ?>
                                                        		</select>
																<!--input readonly type="hidden" class="form-control" name="kdjnspekerjaancalontertanggung" id="kdjnspekerjaancalontertanggung" />
																<input readonly type="text" class="form-control" name="pekerjaancalontertanggung" id="pekerjaancalontertanggung" /-->
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-4">No KTP
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-8">
																<input type="text" class="form-control" name="noktpcalontertanggung" id="noktpcalontertanggung"/>
																
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
											            <div class="form-group">
															<label class="control-label col-md-4">Mulai Asuransi<span class="required"> * </span></label>
															<div class="col-md-4">
																<input class="form-control form-control-inline input-xs datepicker" id="tanggalmulaiasuransi" name="tanggalmulaiasuransi" size="16" type="text" value="" placeholder="Tanggal Ilustrasi" />
															</div>
														</div>
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
																<option value="1">Bulanan</option>  
																<option value="2">Tahunan</option>   
																</select>
															</div>
														</div>
														<!-- Input Usia Produktif-->
														<div class="form-group">
															<label class="control-label col-md-4">Usia Produktif sampai dengan
																<span class="required">

																</span>
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

																</span>
															</label>

															<div class="col-md-4">
																<input type="text" class="form-control" value="" type="number" name="penghasilansatutahun" id="penghasilansatutahun" />
															</div>
														</div>
														<!-- Input Resiko Awal-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Resiko Awal Calon Tertanggung</b></i>
																<span class="required">

																</span>
															</label>

															<div class="col-md-4">
																<input type="text" class="form-control" value="" type="number" name="resikoawalproposal" id="resikoawalproposal" />
															</div>
														</div>
									            	</div>

										            <!-- Kolom Kanan -->
										            <div class="col-md-5">
										              	<!-- Input Total Premi -->
														<div class="form-group">
															<label class="control-label col-md-4">Total Premi yang dibayar<span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																<input class="form-control" placeholder="Total Premi yang dibayar" type="number" name="totalpremi" id="totalpremi" value="0" onchange ="getAllTarif()">
																	
																</div>
															</div>
														</div>
														<!-- Input Premi Dasar -->
														<div class="form-group">
															<label class="control-label col-md-4">Premi Dasar Berkala <span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Premi Berkala" type="number" name="premiberkala" id="premiberkala" value="0" readonly >
																	
																</div>
															</div>
														</div>
														<!-- Input Top Up Berkala-->
														<div class="form-group">
															<label class="control-label col-md-4">Top Up Berkala<span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Top Up Berkala" type="number" name="topupberkala" id="topupberkala" value="0" readonly>
																	
																</div>
															</div>
														</div>
														<!-- Input Top Up Sekaligus-->
														<div class="form-group">
															<label class="control-label col-md-4">Top Up Sekaligus<span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" placeholder="Top Up Sekaligus" type="number" name="topupsekaligus" id="topupsekaligus" value="0" >
																		
																</div>
															</div>	
														</div>
														<!-- Input Nilai Uang Asuransi-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Uang Asuransi</i></b><span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																	<input class="form-control" type="number" name="uangasuransi" id="uangasuransi" readonly>
																</div>
															</div>	
														</div>
										            </div>
									        	</div>
									        </div>
											<!--End Input Data Pertanggungan-->

											<!--Start Input Data Alokasi Dana Investasi-->
											<div class="box-header with-border">
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Alokasi Dana Investasi</h3>
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
																		<td>
																			<p style="margin-top:5px"><i>Fund Allocation</i></p>
																		</td>
																		<td>
																			<div class="form-group">
																				<div class="col-md-12">
																					<select class="form-control " name="alokasidana1" id="alokasidana1" >
																						<option value="">Pilih Alokasi Dana</option>
																						<option value="1">JS LINK PASAR UANG</option>
																						<option value="2">JS LINK PENDAPATAN TETAP</option>
																						<option value="3" selected>JS LINK BERIMBANG</option>
																						<option value="4">JS LINK EKUITAS</option>
																					</select>
																						<input type="hidden" name="alokasidana2" id="alokasidana2" value="" >
																				</div>
																			</div>
																		</td>
																		<td>
																			<div class="form-group">
																				<div class="col-md-12">
																					<input class="form-control" placeholder="" type="number" name="persentasealokasidana1" id="persentasealokasidana1" readonly  value="100">
																					<input type="hidden" name="persentasealokasidana2" id="persentasealokasidana2" value="0" >
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
								              	<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Biaya Asuransi</h3>
								            </div>
									        <div class="box-body">
									          	<div class="row">
									            	<div class="col-md-10">
									            		<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
															<table class="table table-striped table-hover xxxtab">
																<thead>
																	<tr>
																		<th>No</th>
																		<th width="30%" style="text-align: center;">Nama Asuransi</th>
																		<th width="8%">Rider Optional</th>
																		<th>Sampai Usia Tertanggung</th>
																		<th style="text-align: center;">Uang Asuransi</th>
																		<th>Biaya Asuransi Per Bulan</th>
																		<th style="text-align: center;">Tarif</th>
																	</tr>
																</thead>
																<tbody>
																	<!-- Biaya Asuransi : Uang Asuransi Dasar -->
																	<tr>
																		<td>1</td>
																		<td>Asuransi Dasar</td>
																		<td>
																			<select class="form-control" name="jsuangasuransidasar" id="jsuangasuransidasar">
																				<option value="1">1</option>
																			</select>
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
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransidasar" id="tarifuangasuransidasar"  value="0" disabled>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Accidental Death Benefit (JS ADB) -->
																	<tr>
																		<td>2</td>
																		<td>JS Accidental Death Benefit (JS ADB)</td>
																		<td>
																			<select class="form-control" name="jsadb" id="jsadb">
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsadb" id="uangasuransijsadb"  value="0" disabled>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsadb" id="biayauangasuransijsadb"  value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijsadb" id="tarifuangasuransijsadb"  value="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Critical Illness 53 (JS CI 53) -->
																	<tr>
																		<td>3</td>
																		<td>JS Critical Illness 53 (JS CI 53)</td>
																		<td>
																			<select class="form-control" name="jsci53" id="jsci53">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsci53" id="uangasuransijsci53" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsci53" id="biayauangasuransijsci53"  placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijsci53" id="tarifuangasuransijsci53"  placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Waiver of Premium for Critical Illnes 51 (JS WP CI 51) -->
																	<tr>
																		<td>4</td>
																		<td>JS Waiver of Premium for Critical Illnes 51 (JS WP CI 51)</td>
																		<td>
																			<select class="form-control" name="jswpci51" id="jswpci51">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijswpci51" id="uangasuransijswpci51" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijswpci51" id="biayauangasuransijswpci51"  placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijswpci51" id="tarifuangasuransijswpci51"  placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Waiver of Premium for Critical Illnes 51(JS WP CI 51) -->
																	<tr>
																		<td>5</td>
																		<td>JS Term Rider (JS TR)</td>
																		<td>
																			<select class="form-control" name="jstr" id="jstr">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijstr" id="uangasuransijstr" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijstr" id="biayauangasuransijstr"  placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijstr" id="tarifuangasuransijstr"  placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Hospital Cash Plan (JS HCP) -->
																	<tr>
																		<td>6</td>
																		<td>JS Hospital Cash Plan (JS HCP)</td>
																		<td>
																			<select class="form-control" name="jshcp" id="jshcp" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																				<option value="4">4</option>
																				<option value="5">5</option>
																				<option value="6">6</option>
																				<option value="7">7</option>
																				<option value="8">8</option>
																				<option value="9">9</option>
																				<option value="10">10</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijshcp" id="uangasuransijshcp" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijshcp" id="biayauangasuransijshcp"  placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijshcp" id="tarifuangasuransijshcp"  placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Total Permanent Disability (JS TPD) -->
																	<tr>
																		<td>7</td>
																		<td>JS Total Permanent Disability (JS TPD)</td>
																		<td>
																			<select class="form-control" name="jstpd" id="jstpd">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijstpd" id="uangasuransijstpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijstpd" id="biayauangasuransijstpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijstpd" id="tarifuangasuransijstpd" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Waiver of Premium Total Permanent Disability (JS WP-TPD) -->
																	<tr>
																		<td>8</td>
																		<td>JS Waiver of Premium Total Permanent Disability (JS WP-TPD)</td>
																		<td>
																			<select class="form-control" name="jswptpd" id="jswptpd">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijswptpd" id="uangasuransijswptpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijswptpd" id="biayauangasuransijswptpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijswptpd" id="tarifuangasuransijswptpd" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Accidental Death & Dismemberment Benefit (ADDB) -->
																	<tr>
																		<td>9</td>
																		<td>JS Accidental Death & Dismemberment Benefit (ADDB)</td>
																		<td>
																			<select class="form-control" name="jsaddb" id="jsaddb">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsaddb" id="uangasuransijsaddb" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsaddb" id="biayauangasuransijsaddb" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijsaddb" id="tarifuangasuransijsaddb" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Payor Benefit Death (JS PB-D) -->
																	<tr>
																		<td>10</td>
																		<td>JS Payor Benefit Death (JS PB-D)</td>
																		<td>
																			<select class="form-control" name="jspbd" id="jspbd">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="25" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijspbd" id="uangasuransijspbd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijspbd" id="biayauangasuransijspbd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijspbd" id="tarifuangasuransijspbd" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Payor Benefit Critical Illness (JS PB-CI) -->
																	<tr>
																		<td>11</td>
																		<td>JS Payor Benefit Critical Illness (JS PB-CI)</td>
																		<td>
																			<select class="form-control" name="jspbci" id="jspbci">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="25" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijspbci" id="uangasuransijspbci" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijspbci" id="biayauangasuransijspbci" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijspbci" id="tarifuangasuransijspbci" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Payor Benefit Total Permanent Disability (JS PB-TPD) -->
																	<tr>
																		<td>12</td>
																		<td>JS Payor Benefit Total Permanent Disability (JS PB-TPD)</td>
																		<td>
																			<select class="form-control" name="jspbtpd" id="jspbtpd">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="25" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijspbtpd" id="uangasuransijspbtpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijspbtpd" id="biayauangasuransijspbtpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijspbtpd" id="tarifuangasuransijspbtpd" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Spouse Payor Death Benefit (JS SP-D) -->
																	<tr>
																		<td>13</td>
																		<td>JS Spouse Payor Death Benefit (JS SP-D)</td>
																		<td>
																			<select class="form-control" name="jsspd" id="jsspd">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="60" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsspd" id="uangasuransijsspd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsspd" id="biayauangasuransijsspd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijsspd" id="tarifuangasuransijsspd" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Spouse Payor Critical Illness (JS SP-CI) -->
																	<tr>
																		<td>14</td>
																		<td>JS Spouse Payor Critical Illness (JS SP-CI)</td>
																		<td>
																			<select class="form-control" name="jsspci" id="jsspci">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="60" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsspci" id="uangasuransijsspci" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsspci" id="biayauangasuransijsspci" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijsspci" id="tarifuangasuransijsspci" placeholder="0" readonly>
																		</td>
																	</tr>
																	<!-- Biaya Asuransi : JS Spouse Payor Total Permanent Disability  (JS SP-TPD) -->
																	<tr>
																		<td>15</td>
																		<td>JS Spouse Payor Total Permanent Disability  (JS SP-TPD)</td>
																		<td>
																			<select class="form-control" name="jssptpd" id="jssptpd">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="60" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijssptpd" id="uangasuransijssptpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijssptpd" id="biayauangasuransijssptpd" placeholder="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="tarifuangasuransijssptpd" id="tarifuangasuransijssptpd" placeholder="0" readonly>
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
													<a href="javascript:;" class="btn blue button-next" id="berikutnya" name="berikutnya">
														 Submit Proposal <i class="m-icon-swapright m-icon-white"></i>
													</a>
													<a href="javascript:;" class="btn blue button-next" id="test" name="test">
														 Test <i class="m-icon-swapright m-icon-white"></i>
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
				 Copyright © 2019 Divisi Teknologi Informasi Jiwasraya<!--a href="http://www.jiwasraya.co.id">PT. Asuransi Jiwasraya (Persero)</a--> All Rights Reserved.
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
		<script src="<?= base_url();?>assets/scripts/core/app.js"></script>
		<!--script src="<?= base_url();?>assets/scripts/custom/form-wizard.js"></script-->

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

			//Menghitung tanggal lahir calon pemegang polis
			var birthdaycpp = +new Date(document.getElementById("tanggallahirpemegangpolis").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthdaycpp) / 31557600000);
			document.getElementById("usiapemegangpolis").value = Math.floor(sls);
			//alert(usiasekarangcpp);

			//Menghitung usia calon tertanggung
			window.onload=function(){
	            $('#tanggallahircalontertanggung').on('change', function() {
	                var dob = new Date(this.value);
	                var today = new Date();
	                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	                $('#usiacalontertanggung').val(age);
	            });
        	};

        	function cekCPPsamadenganCTT() {
			  	var checkBox = document.getElementById("tertanggungsamadenganpemegangpolis");
			  	if (checkBox.checked == true){
					
					var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					//console.log(kdjenispekerjaanctt);
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew_2019/cgetEkstraPremi');?>",
						data	: "kdjenispekerjaanctt="+kdjenispekerjaanctt,
						success : function(msg) {
							var b = JSON.parse(msg);
							var nilaiekstrapremilife = b.LIFEEXTRA;
							var nilaiekstrapremipa = b.PAEXTRA;
							var nilaiekstrapremitpd = b.TPDEXTRA;
							$('#ekstrapremilifectt').val(nilaiekstrapremilife);
							$('#ekstrapremipactt').val(nilaiekstrapremipa);
							$('#ekstrapremitpdctt').val(nilaiekstrapremitpd);
							$('#namacalontertanggung').prop('disabled', true);
							$('#tanggallahircalontertanggung').prop('disabled', true);
							$('#jeniskelamincalontertanggung').prop('disabled', true);
							$('#hubungandenganpempol').prop('disabled', true);
							$('#perokokcalontertanggung').prop('disabled', true);
							$('#kdjnspekerjaancalontertanggung').prop('disabled', true);
							$('#jswpci51').prop('disabled', false);
							$('#jswptpd').prop('disabled', false);
							$('#jspbd').prop('disabled', true);
							$('#jspbci').prop('disabled', true);
							$('#jspbtpd').prop('disabled', true);
							$('#jsspd').prop('disabled', true);
							$('#jsspci').prop('disabled', true);
							$('#jssptpd').prop('disabled', true);
						}
					});

					document.getElementById("namacalontertanggung").value = document.getElementById("namapemegangpolis").value;
					document.getElementById("tanggallahircalontertanggung").value = document.getElementById("tanggallahirpemegangpolis").value;
					document.getElementById("jeniskelamincalontertanggung").value = document.getElementById("jeniskelaminpemegangpolis").value;
					document.getElementById("usiacalontertanggung").value = document.getElementById("usiapemegangpolis").value;
					document.getElementById("hubungandenganpempol").value = 3;
					document.getElementById("perokokcalontertanggung").value = document.getElementById("perokokpemegangpolis").value;
					document.getElementById("kdjnspekerjaancalontertanggung").value = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					document.getElementById("pekerjaancalontertanggung").value = document.getElementById("pekerjaanpemegangpolis").value;



			  	} else {
			  		$('#namacalontertanggung').prop('disabled', false);
			  		$('#tanggallahircalontertanggung').prop('disabled', false);
					$('#jeniskelamincalontertanggung').prop('disabled', false);
					$('#hubungandenganpempol').prop('disabled', false);
					$('#perokokcalontertanggung').prop('disabled', false);
					$('#kdjnspekerjaancalontertanggung').prop('disabled', false);
			  		$('#jspbd').prop('disabled', false);
					$('#jspbci').prop('disabled', false);
					$('#jspbtpd').prop('disabled', false);
					$('#jsspd').prop('disabled', false);
					$('#jsspci').prop('disabled', false);
					$('#jssptpd').prop('disabled', false);
		
					document.getElementById("ekstrapremilifectt").value ="";
					document.getElementById("ekstrapremipactt").value ="";
					document.getElementById("ekstrapremitpdctt").value ="";
				 	document.getElementById("namacalontertanggung").value = "";
					document.getElementById("tanggallahircalontertanggung").value = "";
					document.getElementById("jeniskelamincalontertanggung").value = "";
					document.getElementById("usiacalontertanggung").value = "";
					document.getElementById("hubungandenganpempol").value = 0;
					document.getElementById("perokokcalontertanggung").value = "T";
					document.getElementById("kdjnspekerjaancalontertanggung").value = "";
					document.getElementById("pekerjaancalontertanggung").value ="";
			  	};
			};

			//function getHubungandgPempol
			$('#hubungandenganpempol').on('change', function() {
				var statushubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				if (statushubungandenganpempol == 1){
					$('#jswpci51').prop('disabled', true);
					$('#jswptpd').prop('disabled', true);
					$('#jspbd').prop('disabled', true);
					$('#jspbci').prop('disabled', true);
					$('#jspbtpd').prop('disabled', true);
					$('#jsspd').prop('disabled', false);
					$('#jsspci').prop('disabled', false);
					$('#jssptpd').prop('disabled', false);
				}else if (statushubungandenganpempol == 2){
					$('#jswpci51').prop('disabled', true);
					$('#jswptpd').prop('disabled', true);
					$('#jspbd').prop('disabled', false);
					$('#jspbci').prop('disabled', false);
					$('#jspbtpd').prop('disabled', false);
					$('#jsspd').prop('disabled', true);
					$('#jsspci').prop('disabled', true);
					$('#jssptpd').prop('disabled', true);
				}
			});


			function getEkstraPremi(){
				var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/cgetEkstraPremi');?>",
					data	: "kdjenispekerjaanctt="+kdjenispekerjaanctt,
					success : function(msg) {
						var b = JSON.parse(msg);
						var nilaiekstrapremilife = b.LIFEEXTRA;
						var nilaiekstrapremipa = b.PAEXTRA;
						var nilaiekstrapremitpd = b.TPDEXTRA;
						$('#ekstrapremilifectt').val(nilaiekstrapremilife);
						$('#ekstrapremipactt').val(nilaiekstrapremipa);
						$('#ekstrapremitpdctt').val(nilaiekstrapremitpd);
					}
				});
			};

			function getAllTarif(){
				var usiasekarangctt = $("#usiacalontertanggung").val();
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/cgetTarifAll');?>",
					data	: "usiacalontertanggung="+usiasekarangctt,
					success : function(msg) {
						var a = JSON.parse(msg);
						var perokokcalontertanggung = document.getElementById("perokokcalontertanggung").value;
						if (perokokcalontertanggung=='T') {
							var tariftermlife = a.TERMLIFE_NONSMOKER;
							var tariftermrider = a.TERMRIDER_NONSMOKER;
						}else{
							var tariftermlife = a.TERMLIFE_SMOKER;
							var tariftermrider = a.TERMRIDER_SMOKER;
						}

						//Untuk Menentukan Tarif HCP berdasarkan jenis kelamin dan tipe HCP yang diambil
						var pilihanhcp = document.getElementById("jshcp").value;
						var jeniskelaminctt = document.getElementById("jeniskelamincalontertanggung").value;
						if(pilihanhcp == 1 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_100;
						}else if(pilihanhcp == 2 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_200;
						}else if(pilihanhcp == 3 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_300;
						}else if(pilihanhcp == 4 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_400;
						}else if(pilihanhcp == 5 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_500;
						}else if(pilihanhcp == 6 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_600;
						}else if(pilihanhcp == 7 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_700;
						}else if(pilihanhcp == 8 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_800;
						}else if(pilihanhcp == 9 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_900;
						}else if(pilihanhcp == 10 && jeniskelaminctt == 'M'){
							var tarifriderjshcp = a.HCP_L_1000;
						}else if(pilihanhcp == 1 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_100;
						}else if(pilihanhcp == 2 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_200;
						}else if(pilihanhcp == 3 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_300;
						}else if(pilihanhcp == 4 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_400;
						}else if(pilihanhcp == 5 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_500;
						}else if(pilihanhcp == 6 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_600;
						}else if(pilihanhcp == 7 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_700;
						}else if(pilihanhcp == 8 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_800;
						}else if(pilihanhcp == 9 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_900;
						}else if(pilihanhcp == 10 && jeniskelaminctt == 'F'){
							var tarifriderjshcp = a.HCP_P_1000;
						}else if(pilihanhcp == 0){
							var tarifriderjshcp = "0,0";
						}
						//console.log(tarifriderjshcp);

						var tarifriderjsadb = a.ADB;
						var tarifriderjsci53 = a.CI53;
						var tarifriderjswpci51 = a.WPCI;
						var tarifriderjstpd = a.TPD;
						var tarifriderjswptpd = a.WPTPD;
						var tarifriderjsaddb = a.ADDB;
						var tarifriderjspbd = a.PBDEATH;
						var tarifriderjspbci = a.PBCI;
						var tarifriderjspbtpd = a.PBTPD;
						var tarifriderjsspd = a.SPDEATH;
						var tarifriderjsspci = a.SPCI;
						var tarifriderjssptpd = a.SPTPD;

						//Fungsi untuk mengubah tarif (koma ke titik) dan membagi menjadi 12
						var tariftermlife_ = (tariftermlife.replace(",", ".")) / 12;
						var tariftermrider_ = (tariftermrider.replace(",", ".")) / 12;
						var tarifriderjshcp_ = tarifriderjshcp.replace(",", ".");
						var tarifriderjsadb_ = tarifriderjsadb.replace(",", ".") / 12;  
						var tarifriderjsci53_ = tarifriderjsci53.replace(",", ".") / 12;
						var tarifriderjswpci51_ = tarifriderjswpci51.replace(",", ".") / 12;
						var tarifriderjstpd_ = tarifriderjstpd.replace(",", ".") / 12;
						var tarifriderjswptpd_ = tarifriderjswptpd.replace(",", ".") / 12;
						var tarifriderjsaddb_ = tarifriderjsaddb.replace(",", ".") / 12;
						var tarifriderjspbd_ = tarifriderjspbd.replace(",", ".") / 12;
						var tarifriderjspbci_ = tarifriderjspbci.replace(",", ".") / 12;
						var tarifriderjspbtpd_ = tarifriderjspbtpd.replace(",", ".") / 12;
						var tarifriderjsspd_ = tarifriderjsspd.replace(",", ".") / 12;
						var tarifriderjsspci_ = tarifriderjsspci.replace(",", ".") / 12;
						var tarifriderjssptpd_ = tarifriderjssptpd.replace(",", ".") / 12;
						//console.log(tarifriderjshcp_);

						$('#tarifuangasuransidasar').val(tariftermlife_);
						$('#tarifuangasuransijstr').val(tariftermrider_);
						$('#tarifuangasuransijshcp').val(tarifriderjshcp_);
						$('#tarifuangasuransijsadb').val(tarifriderjsadb_);
						$('#tarifuangasuransijsci53').val(tarifriderjsci53_);
						$('#tarifuangasuransijswpci51').val(tarifriderjswpci51_);
						$('#tarifuangasuransijstpd').val(tarifriderjstpd_);
						$('#tarifuangasuransijswptpd').val(tarifriderjswptpd_);
						$('#tarifuangasuransijsaddb').val(tarifriderjsaddb_);
						$('#tarifuangasuransijspbd').val(tarifriderjspbd_);
						$('#tarifuangasuransijspbci').val(tarifriderjspbci_);
						$('#tarifuangasuransijspbtpd').val(tarifriderjspbtpd_);
						$('#tarifuangasuransijsspd').val(tarifriderjsspd_);
						$('#tarifuangasuransijsspci').val(tarifriderjsspci_);
						$('#tarifuangasuransijssptpd').val(tarifriderjssptpd_);
						
						//***Mendahulukan untuk menghitung rider rider yang tidak memperhitungkan Uang Asuransi***//

						//Menghitung Biaya Asuransi Rider JS HCP per Bulan
						var uangasuransijshcp = Math.round(pilihanhcp * 100000);
						var biayaasuransijshcp = (tarifriderjshcp_ / 12);
						//console.log("biayasuransiHCP"+biayaasuransijshcp);
						$('#uangasuransijshcp').val(uangasuransijshcp);
						$('#biayauangasuransijshcp').val(Math.round(biayaasuransijshcp));
						
						//Memanggil nilai-nilai untuk perhitungan JUA
						var hasilhitungsisadanacoicor = document.getElementById("rumussisadanacoicor").value;
						var totalpremi = document.getElementById("totalpremi").value;

						//Menghitung Biaya Asuransi Rider JS WP-CI51 per Bulan
						var pilihanwpci51 = document.getElementById("jswpci51").value;
						var uangasuransijswpci51 = Math.round(pilihanwpci51 * totalpremi * 12);
						var biayaasuransijswpci51 = Math.round(uangasuransijswpci51 * tarifriderjswpci51_ / 100);
						$('#uangasuransijswpci51').val(uangasuransijswpci51);
						$('#biayauangasuransijswpci51').val(biayaasuransijswpci51);

						//Menghitung Biaya Asuransi Rider JS WP-TPD per Bulan
						var pilihanwptpd = document.getElementById("jswptpd").value;
						var uangasuransijswptpd = Math.round(pilihanwptpd * totalpremi * 12);
						var biayaasuransijswptpd = Math.round(uangasuransijswptpd * tarifriderjswptpd_ / 100);
						$('#uangasuransijswptpd').val(uangasuransijswptpd);
						$('#biayauangasuransijswptpd').val(biayaasuransijswptpd);

						//Menghitung JUA
						var jumlahnilaitarif = tariftermlife_ + tarifriderjsadb_ ;
						var hasilhitungjua = Math.round(((hasilhitungsisadanacoicor / 100 * totalpremi) - (biayaasuransijshcp + biayaasuransijswpci51 + biayaasuransijswptpd))  * 1000 / jumlahnilaitarif);
						$('#uangasuransi').val(hasilhitungjua);
						$('#uangasuransidasar').val(hasilhitungjua);

						//Menghitung Biaya Asuransi Dasar per Bulan
						var biayaasuransidasar = Math.round(hasilhitungjua * tariftermlife_ / 1000);
						$('#biayauangasuransidasar').val(biayaasuransidasar);

						//Menghitung Biaya Asuransi Rider JS-ADB per Bulan
						var pilihanjsadb = document.getElementById("jsadb").value;
						var uangasuransijsadb = Math.round(pilihanjsadb * hasilhitungjua);
						var biayaasuransijsadb = Math.round(uangasuransijsadb * tarifriderjsadb_ / 1000);
						$('#uangasuransijsadb').val(uangasuransijsadb);
						$('#biayauangasuransijsadb').val(biayaasuransijsadb);

						
					}
				});

			};

			// $('#test').on('click', function() {
			// 	var datatest = '{  "kdProduk" : "JL4BLN",  "jenisBenefit" : "R",  "show" : "Y",  "induk" : "",  "dataSPAJVOCollection" : [{"kdAcord":"313","value":"I"},{"kdAcord":"319","value":8000000},{"kdAcord":"318","value":"JL4BLN"},{"kdAcord":"317"},{"kdAcord":"316","value":"3000000"},{"kdAcord":"315","value":"5000000"},{"kdAcord":"314","value":"150000000"},{"kdAcord":"312","value":"60"},{"kdAcord":"311","value":"2019-09-20"},{"kdAcord":"310","value":"72"},{"kdAcord":"307","value":"A"},{"kdAcord":"306","value":"27"},{"kdAcord":"305","value":"1"}]}';
			// 	//console.log(kdprodukrider);	
			// 	$.ajax({
			// 		type	: "POST",
			// 		url		: "<?=base_url('jspromapannew_2019/test');?>",
			// 		data	: "datatest="+datatest,
			// 		dataType : 'json',
			// 		success : function(msg) {
			// 			console.log(msg);	
			// 		},
			// 		error: function (xhr, ajaxOptions, thrownError) {
			// 	        console.log(xhr.status);
			// 	        console.log(thrownError);
			// 	      }
			// 	});
			// });
			
			$('#totalpremi').on('change', function() {
				var totalpremi = document.getElementById("totalpremi").value;
				var hasilpremiberkala = 0.7 * totalpremi;
				var hasiltopupberkala = 0.3 * totalpremi;

				//Fungsi untuk menghitung rumus berapa persen nilai COA (27.500) terhadap premi
				var hitungrumuscoa = 27500/totalpremi*100;

				//Fungsi untuk menghitung rumus berapa persen sisa dana COi dan COR
				var alokasipremi = document.getElementById("rumusalokasipremi").value;
				var asumsidanainvest = document.getElementById("rumusasumsidanainvest").value;
				var hasilhitungsisadanacoicor = alokasipremi - asumsidanainvest - hitungrumuscoa;

				$('#rumuscoa').val(hitungrumuscoa);
				$('#rumussisadanacoicor').val(hasilhitungsisadanacoicor);
				$('#premiberkala').val(hasilpremiberkala);
				$('#topupberkala').val(hasiltopupberkala);
			});
			
		</script>
	</body>
	<!-- END BODY -->
</html>