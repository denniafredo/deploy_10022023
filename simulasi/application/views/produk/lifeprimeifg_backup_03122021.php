<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!--div class="clearfix">
	</div-->
	<!-- BEGIN CONTAINER -->
<div class="">
	
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
				//$NoProspek =$this->input->get('kode_prospek');
				//$DataAgen = $this->ModSimulasi->GetDataAgen_new($NoProspek);
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						<div class="portlet-title" align="center">
							<div class="caption">
								<i class="fa fa-reorder"></i> Simulasi Produk -
								<span class="step-title">
									 Asuransi IFG Life Prime Protection (IFG Group)
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
																<input readonly type="text" class="form-control" name="rumusasumsidanainvest" id="rumusasumsidanainvest" placeholder="Dihitung Otomatis">
																<input readonly type="hidden" class="form-control" name="rumusasumsidanainvest1" id="rumusasumsidanainvest1">
																<input readonly type="hidden" class="form-control" name="rumusasumsidanainvest2" id="rumusasumsidanainvest2">
																<input readonly type="hidden" class="form-control" name="rumusasumsidanainvest3" id="rumusasumsidanainvest3">
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
																<input readonly type="text" class="form-control" name="rumussisabiayacoicor" id="rumussisabiayacoicor" value="20" />
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
																<input readonly type="text" class="form-control" name="ekstrapremilifehobicpp" id="ekstrapremilifehobicpp" />
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
																<input readonly type="text" class="form-control" name="ekstrapremilifehobictt" id="ekstrapremilifehobictt" />
															</div>
											            </div>
											            <!--COA-->
											            <div class="form-group">
															<label class="control-label col-md-4">Ekstra Premi ADB / ADDB CTT</label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="ekstrapremipactt" id="ekstrapremipactt" />
																<input readonly type="text" class="form-control" name="ekstrapremipahobictt" id="ekstrapremipahobictt" />
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
															<div class="col-md-4">
																<input readonly type="text" class="form-control" name="noktppemegangpolis" id="noktppemegangpolis" value="<?= $DataAgen['NO_KTP']; ?>" required />
																
															</div>
											            </div>
														
														<div class="form-group">
															<label class="control-label col-md-4">Hobi
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<input readonly type="hidden" class="form-control" name="kdhobipemegangpolis" id="kdhobipemegangpolis" value="<?= $DataAgen['KDHOBI']; ?>"/>
																<input readonly type="text" class="form-control" name="hobipemegangpolis" id="hobipemegangpolis" value="<?= $DataAgen['NAMAHOBI']; ?>"/>
															</div>
														</div>

														<input type="hidden" class="form-control" name="kodekantor" id="kodekantor" value="<?= $this->uri->segment(3); ?>"/>
														<input type="hidden" class="form-control" name="namaagen" id="namaagen" value="<?= $this->uri->segment(4); ?>"/>
														<input type="hidden" class="form-control" name="nomoragen" id="nomoragen" value="<?= $DataAgen['NOAGEN']; ?>"/>
														<input type="hidden" class="form-control" name="kodeprospek" id="kodeprospek" value="<?= $noprospek; ?>"/>

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
															<div class="col-md-4">
																<input type="text" class="form-control" name="noktpcalontertanggung" id="noktpcalontertanggung" required />
															</div>
											            </div>
														
														<div class="form-group">
															<label class="control-label col-md-4">Hobi
															<span class="required">
																 *
															</span>
															</label>
															<div class="col-md-4">
																<select name="kdhobicalontertanggung" id="kdhobicalontertanggung" class="form-control" onchange="getEkstraPremi()">
														 			<option value="">Silahkan Pilih</option>
																	<?php if (!$hobi['error']) {
																		foreach($hobi['message'] as $i => $v) {
																			echo "<option value='$v[KDHOBI]'>$v[NAMAHOBI]</option>";
																		}
																	} ?>
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
																<option value="1">Bulanan</option>  																
																<option value="3">Kuartalan</option>
																<option value="4">Semesteran</option>
																<option value="2">Tahunan</option>
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
														<!--Input Resiko Finansial-->
														<div class="form-group">
															<label class="control-label col-md-4"><b><i>Resiko Finansial</b></i><span class="required"></span></label>
															<div class="col-md-4">
																<input readonly type="text" class="form-control" id="resikofinansialctt" placeholder="0" style="border:0px;" />
															</div>
														</div>
									            	</div>

										            <!-- Kolom Kanan -->
										            <div class="col-md-5">
										              	<!-- Input Total Premi -->
														<div class="form-group">
															<label class="control-label col-md-4">Total Premi yang dibayar <sup class="premiSubStandard hide">(a)</sup><span class="required"> * </span> </label>
															<div class="col-md-4">
																<div class="input-group">
																<input class="form-control" placeholder="Total Premi yang dibayar" type="number" name="totalpremi" id="totalpremi" value="0" onblur="getAllTarif()">
																	
																</div>
															</div>
															<label class="control-label col-md-4 premiSubStandard hide" style="text-align:left;">
																<b><i><sup>(a)</sup>Premi Substandard</b></i>
															</label>
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
															
														<!-- Periode Top Up Sekaligus-->
														<div class="form-group">
															<label class="control-label col-md-4">Periode Top Up Sekaligus<span class="required"> * </span> </label>
																<div class="col-md-4">
																	<div class="input-group">
																		<input class="form-control" placeholder="Periode Top Up Sekaligus" type="number" name="periodetopupsekaligus" id="periodetopupsekaligus" value="1" >
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
																		
																		
																			<input hidden class="form-control" type="hidden" name="tarifresikoawaldanspouse" id="tarifresikoawaldanspouse"  placeholder="0" disabled>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Waiver of Premium for Critical Illnes 51 (IFG WP CI 51) -->
																	<tr id="barisjswpci51">
																		<!-- <td>4</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Waiver of Premium Critical Illness 51 (IFG WP CI 51)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jswpci51" id="jswpci51" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jswpci51" id="pil_jswpci51" unchecked onclick="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijswpci51" id="uangasuransijswpci51" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijswpci51" id="biayauangasuransijswpci51"  value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijswpci51" id="tarifuangasuransijswpci51"  placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijswpci51" id="resikoawaluangasuransijswpci51"  placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Waiver of Premium Total Permanent Disability (IFG WP-TPD) -->
																	<tr id="barisjswptpd">
																		<!-- <td>8</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Waiver of Premium Total Permanent Dissability (IFG WP-TPD)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jswptpd" id="jswptpd" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jswptpd" id="pil_jswptpd" unchecked onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijswptpd" id="uangasuransijswptpd" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijswptpd" id="biayauangasuransijswptpd" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijswptpd" id="tarifuangasuransijswptpd" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijswptpd" id="resikoawaluangasuransijswptpd" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Accidental Death Benefit (IFG ADB) -->
																	<tr>
																		<!-- <td>2</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Accident Death Benefit (IFG ADB)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jsadb" id="jsadb" onclick="getAllTarif()">
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" name="pil_jsadb" id="pil_jsadb" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
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
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijsadb" id="tarifuangasuransijsadb"  value="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijsadb" id="resikoawaluangasuransijsadb"  value="0" value="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Critical Illness 53 (IFG CI 53) -->
																	<tr id="barisjsci53">
																		<!-- <td>3</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Critical Illness 53 (IFG CI 53)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jsci53" id="jsci53" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jsci53" id="pil_jsci53" unchecked onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsci53" id="uangasuransijsci53" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsci53" id="biayauangasuransijsci53"  value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijsci53" id="tarifuangasuransijsci53"  placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijsci53" id="resikoawaluangasuransijsci53"  placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="tarifresikoawalpayor" id="tarifresikoawalpayor"  placeholder="0" disabled>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Term Rider (IFG TR) -->
																	<tr id="barisjstr">
																		<!-- <td>5</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Term Rider (IFG TR)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jstr" id="jstr" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jstr" id="pil_jstr" unchecked onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijstr" id="uangasuransijstr" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijstr" id="biayauangasuransijstr"  value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijstr" id="tarifuangasuransijstr"  placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijstr" id="resikoawaluangasuransijstr"  placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Hospital Cash Plan (IFG HCP) -->
																	<tr id="barisjshcp">
																		<!-- <td>6</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Hospital Cash Plan (IFG HCP)</td>
																		<td>
																			<select class="form-control" name="jshcp" id="jshcp" onchange="getAllTarif()">
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
																			<input class="form-control" type="text" name="uangasuransijshcp" id="uangasuransijshcp" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijshcp" id="biayauangasuransijshcp"  value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijshcp" id="tarifuangasuransijshcp"  placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijshcp" id="resikoawaluangasuransijshcp"  value="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Total Permanent Disability (IFG TPD) -->
																	<tr id="barisjstpd">
																		<!-- <td>7</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Total Permanent Dissability (IFG TPD)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jstpd" id="jstpd" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jstpd" id="pil_jstpd" unchecked onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijstpd" id="uangasuransijstpd" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijstpd" id="biayauangasuransijstpd" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijstpd" id="tarifuangasuransijstpd" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijstpd" id="resikoawaluangasuransijstpd" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Accidental Death & Dismemberment Benefit (ADDB) -->
																	<tr id="barisjsaddb">
																		<!-- <td>9</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Accidental Death Dissmemberment Benefit (ADDB)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jsaddb" id="jsaddb" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																				<option value="2">2</option>
																				<option value="3">3</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jsaddb" id="pil_jsaddb" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" value="65" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsaddb" id="uangasuransijsaddb" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsaddb" id="biayauangasuransijsaddb" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijsaddb" id="tarifuangasuransijsaddb" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijsaddb" id="resikoawaluangasuransijsaddb" value="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Payor Benefit Death (IFG PB-D) -->
																	<tr id="barisjspbd">
																		<!-- <td>10</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Payor Death Benefit (IFG PB-D)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jspbd" id="jspbd" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jspbd" id="pil_jspbd" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="maxmasaasuransipayord" id="maxmasaasuransipayord" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijspbd" id="uangasuransijspbd" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijspbd" id="biayauangasuransijspbd" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijspbd" id="tarifuangasuransijspbd" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijspbd" id="resikoawaluangasuransijspbd" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Payor Benefit Critical Illness (IFG PB-CI) -->
																	<tr id="barisjspbci">
																		<!-- <td>11</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Payor Benefit Critical Illness (IFG PB-CI)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jspbci" id="jspbci" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jspbci" id="pil_jspbci" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="maxmasaasuransipayorci" id="maxmasaasuransipayorci" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijspbci" id="uangasuransijspbci" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijspbci" id="biayauangasuransijspbci" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijspbci" id="tarifuangasuransijspbci" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijspbci" id="resikoawaluangasuransijspbci" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Payor Benefit Total Permanent Disability (IFG PB-TPD) -->
																	<tr id="barisjspbtpd">
																		<!-- <td>12</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Payor Benefit Total Permanent Dissability (IFG PB-TPD)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jspbtpd" id="jspbtpd" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jspbtpd" id="pil_jspbtpd" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="maxmasaasuransipayortpd" id="maxmasaasuransipayortpd" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijspbtpd" id="uangasuransijspbtpd" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijspbtpd" id="biayauangasuransijspbtpd" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijspbtpd" id="tarifuangasuransijspbtpd" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijspbtpd" id="resikoawaluangasuransijspbtpd" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Spouse Payor Death Benefit (IFG SP-D) -->
																	<tr id="barisjsspd">
																		<!-- <td>13</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Spouse Payor Death Benefit (IFG SP-D)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jsspd" id="jsspd" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jsspd" id="pil_jsspd" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="maxmasaasuransispousepayor" id="maxmasaasuransispousepayor" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsspd" id="uangasuransijsspd" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsspd" id="biayauangasuransijsspd" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijsspd" id="tarifuangasuransijsspd" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikowaluangasuransijsspd" id="resikoawaluangasuransijsspd" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Spouse Payor Critical Illness (IFG SP-CI) -->
																	<tr id="barisjsspci">
																		<!-- <td>14</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Spouse Payor Critical Illness (IFG SP-CI)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jsspci" id="jsspci" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jsspci" id="pil_jsspci" onchange="getAllTarif()">
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="maxmasaasuransispousepayorci" id="maxmasaasuransispousepayorci" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijsspci" id="uangasuransijsspci" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijsspci" id="biayauangasuransijsspci" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijsspci" id="tarifuangasuransijsspci" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijsspci" id="resikoawaluangasuransijsspci" placeholder="0" readonly>
																		
																	</tr>
																	<!-- Biaya Asuransi : IFG Spouse Payor Total Permanent Disability  (IFG SP-TPD) -->
																	<tr id="barisjssptpd">
																		<!-- <td>15</td> -->
																		<td><i class="fa fa-fw fa-arrow-circle-right"></i>&nbsp&nbsp IFG Spouse Payor Total Permanent Dissability  (IFG SP-TPD)</td>
																		<td align="center">
																			<!-- <select class="form-control" name="jssptpd" id="jssptpd" onclick="getAllTarif()">
																				<option value="0">0</option>
																				<option value="1">1</option>
																			</select> -->
																			<label class="el-checkbox el-checkbox-lg">
																				<input type="checkbox" type="checkbox" name="pil_jssptpd" id="pil_jssptpd" onchange="getAllTarif()" hi>
																				<span class="el-checkbox-style"></span>
																			</label>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="maxmasaasuransispousepayortpd" id="maxmasaasuransispousepayortpd" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="uangasuransijssptpd" id="uangasuransijssptpd" value="0" readonly>
																		</td>
																		<td>
																			<input class="form-control" type="text" name="biayauangasuransijssptpd" id="biayauangasuransijssptpd" value="0" readonly>
																		</td>
																		
																			<input class="form-control" type="hidden" name="tarifuangasuransijssptpd" id="tarifuangasuransijssptpd" placeholder="0" readonly>
																		
																			<input class="form-control" type="hidden" name="resikoawaluangasuransijssptpd" id="resikoawaluangasuransijssptpd" placeholder="0" readonly>
																		
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
											<div class="col-md-12 text-center">
												
                                                    <a href="<?=str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=".$this->input->get('noid')?>" class="btn btn-lg green button-kembali">
														 Halaman Prospek <i class="m-icon-swapleft m-icon-white"></i>
													</a>
													<a href="javascript:;" class="btn btn-lg blue button-next" id="submitProposal" name="submitProposal">
														 Submit Proposal <i class="m-icon-swapright m-icon-white"></i>
													</a>
												
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
				 <?=C_COPYRIGHT?>
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

			//Menghitung tanggal lahir calon pemegang polis
			// var birthdaycpp = +new Date(document.getElementById("tanggallahirpemegangpolis").value);
			// var now = Date.now("MM-dd-yyyy");
			// var sls =((now - birthdaycpp) / 31557600000);
			// var usiacalonpemegangpolis = Math.floor(sls);
			// document.getElementById("usiapemegangpolis").value = Math.floor(sls);

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

			/*Fungsi tambahan untuk mencegah perbedaan karena agen back saat sudah submit - Teguh 03/12/2019*/
			var usiasekarangctt = document.getElementById("usiacalontertanggung").value;
			console.log("Usia Calon Tertanggung : "+usiasekarangctt);
			if(usiasekarangctt == ''){
				//console.log("USIA CALON TERTANGGUNG MASUK KOSONG");				
			}else{
				$.ajax({
					type	: "POST",					
					url		: "<?=base_url('jspromapannew_2019/cgetAsumsiDanaInvest');?>",
					data	: "usiacalontertanggung="+usiasekarangctt,
					success : function(msg) {
						var adi = JSON.parse(msg);
						var asumsidanainvest1 = adi.RANGE1;
						var asumsidanainvest2 = adi.RANGE2;
						var asumsidanainvest3 = adi.RANGE3;
						$('#rumusasumsidanainvest1').val(asumsidanainvest1.replace(",", "."));
						$('#rumusasumsidanainvest2').val(asumsidanainvest2.replace(",", "."));
						$('#rumusasumsidanainvest3').val(asumsidanainvest3.replace(",", "."));
					}
				});
			}
			/*End Tambahan - 03/12/2019 */
			
			// Menghitung resiko finansial
			$('#penghasilansatutahun').blur(function() {
				var usia = $('#usiaproduktif').val() - $('#usiacalontertanggung').val();
				
				$('#resikofinansialctt').val(usia * $(this).val());
			});


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

				var usiasekarangctt = Math.floor(age);
				$.ajax({
					type	: "POST",					
					url		: "<?=base_url('jspromapannew_2019/cgetAsumsiDanaInvest');?>",
					data	: "usiacalontertanggung="+usiasekarangctt,
					success : function(msg) {
						var adi = JSON.parse(msg);
						var asumsidanainvest1 = adi.RANGE1;
						var asumsidanainvest2 = adi.RANGE2;
						var asumsidanainvest3 = adi.RANGE3;
												
						$('#rumusasumsidanainvest1').val(asumsidanainvest1.replace(",", "."));
						$('#rumusasumsidanainvest2').val(asumsidanainvest2.replace(",", "."));
						$('#rumusasumsidanainvest3').val(asumsidanainvest3.replace(",", "."));
					}
				});
			});

			window.onload=function(){
				//Mencari Tarif untuk Rider SPOUSE dan PAYOR
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/cgetTarifSpousePayor');?>",
					data	: "usiacalonpemegangpolis="+usiacalonpemegangpolis,
					success : function(msg) {
						var c = JSON.parse(msg);
						var tarifriderjspbd = c.PBDEATH;
						var tarifriderjspbci = c.PBCI;
						var tarifriderjspbtpd = c.PBTPD;
						var tarifriderjsspd = c.SPDEATH;
						var tarifriderjsspci = c.SPCI;
						var tarifriderjssptpd = c.SPTPD;
						
						$.ajax({
							type	: "GET",
							dataType: "json",
							async	: false,
							url		: "<?=C_URL_API.'/master/hobi/'.$DataAgen['KDHOBI'];?>",
							success : function(data) { console.log(data);
								if (!data.error) {
									$('#ekstrapremilifehobicpp').val(data.message.LIFE);
								}
							}
						});

						//Cek Nilai Ektra Premi Karena RESIKO PEKERJAAN
						var nilaiekstrapremilife_cpp = document.getElementById("ekstrapremilifecpp").value;
						var nilaiekstrapremitpd_cpp = document.getElementById("ekstrapremitpdcpp").value;
						var nilaiekstrapremihobilife_cpp = $('#ekstrapremilifehobicpp').val();

						//console.log("NILAI EXTRA PREMI LIFE CPP:"+nilaiekstrapremilife_cpp);
						//console.log("NILAI EXTRA PREMI TPD CPP:"+nilaiekstrapremitpd_cpp);
						//console.log("hobi cpp :"+nilaiekstrapremihobilife_cpp);

						if(nilaiekstrapremilife_cpp == 'REFER'){
							var tarifriderjspbd_ = 0;
							var tarifriderjsspd_ = 0;
						}else if(nilaiekstrapremilife_cpp == 'DECLINE'){
							var tarifriderjspbd_ = 0;
							var tarifriderjsspd_ = 0;
							$('#pil_jspbtpd').prop('disabled', true);
							$('#pil_jssptpd').prop('disabled', true);
						}else{
							//var tarifriderjspbd_ = ((nilaiekstrapremilife_cpp * 1) + (tarifriderjspbd.replace(",", ".")) * 1) / 12;
							var tarifriderjsspd_ = (((nilaiekstrapremilife_cpp*1)/10) + ((nilaiekstrapremihobilife_cpp*1)/10) + (tarifriderjsspd.replace(",", ".")) * 1) / 12;
							var tarifriderjspbd_ = (((nilaiekstrapremilife_cpp*1)/10) + ((nilaiekstrapremihobilife_cpp*1)/10) + (tarifriderjspbd.replace(",", ".")) * 1) / 12;
							
							//var tarifriderjspbd_ = (1 + (nilaiekstrapremilife_cpp / 1000)) * tarifriderjspbd.replace(",", ".") / 12;
							// var tarifriderjsspd_ = (1 + (nilaiekstrapremilife_cpp / 1000)) * tarifriderjsspd.replace(",", ".") / 12;
						}

						if(nilaiekstrapremitpd_cpp == 'REFER'){
							var tarifriderjspbtpd_ = 0;
							var tarifriderjssptpd_ = 0;
						}else if(nilaiekstrapremitpd_cpp == 'DECLINE'){
							var tarifriderjspbtpd_ = 0;
							var tarifriderjssptpd_ = 0;
							$('#pil_jspbtpd').prop('disabled', true);
							$('#pil_jssptpd').prop('disabled', true);
						}else{
							var tarifriderjspbtpd_ = (1 + (nilaiekstrapremitpd_cpp / 100)) * tarifriderjspbtpd.replace(",", ".") / 12;
							var tarifriderjssptpd_ = (1 + (nilaiekstrapremitpd_cpp / 100)) * tarifriderjssptpd.replace(",", ".") / 12;
						}

						var tarifriderjspbci_ = tarifriderjspbci.replace(",", ".") / 12;
						var tarifriderjsspci_ = tarifriderjsspci.replace(",", ".") / 12;
						
						$('#tarifuangasuransijspbd').val(tarifriderjspbd_);
						$('#tarifuangasuransijspbci').val(tarifriderjspbci_);
						$('#tarifuangasuransijspbtpd').val(tarifriderjspbtpd_);
						$('#tarifuangasuransijsspd').val(tarifriderjsspd_);
						$('#tarifuangasuransijsspci').val(tarifriderjsspci_);
						$('#tarifuangasuransijssptpd').val(tarifriderjssptpd_);
					}
				});
			};

			function cekCPPsamadenganCTT() {
				var checkBox = document.getElementById("tertanggungsamadenganpemegangpolis");
				var kodeprospek = document.getElementById("kodeprospek");
				//console.log(kodeprospek);
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
							
							if(nilaiekstrapremipa == 'DECLINE'){
								$('#pil_jsadb').prop('disabled', true);
								$('#pil_jsaddb').prop('disabled', true);
							}
							if(nilaiekstrapremitpd == 'DECLINE'){
								$('#pil_jswptpd').prop('disabled', true);
								$('#pil_jstpd').prop('disabled', true);
							}else{
								$('#pil_jswptpd').prop('disabled', false);
							}

							$('#pil_jswpci51').prop('disabled', false);
							
							$('#barisjspbd').prop('hidden', true);
							$('#barisjspbci').prop('hidden', true);
							$('#barisjspbtpd').prop('hidden', true);
							$('#barisjsspd').prop('hidden', true);
							$('#barisjsspci').prop('hidden', true);
							$('#barisjssptpd').prop('hidden', true);

							$('#pil_jspbd').prop('disabled', true);
							$('#pil_jspbci').prop('disabled', true);
							$('#pil_jspbtpd').prop('disabled', true);
							$('#pil_jsspd').prop('disabled', true);
							$('#pil_jsspci').prop('disabled', true);
							$('#pil_jssptpd').prop('disabled', true);

						}
					});
					
					var kdhobicalontertanggung = $('#kdhobipemegangpolis').val();
					
					$.ajax({
						type	: "GET",
						dataType: "json",
						url		: "<?=C_URL_API.'/master/hobi/';?>"+kdhobicalontertanggung,
						success : function(data) {
							if (!data.error) {
								$('#ekstrapremilifehobictt').val(data.message.LIFE);
								$('#ekstrapremipahobictt').val(data.message.PA);
							}
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
						$('#kdhobicalontertanggung').prop('disabled', true);
						$('#noktpcalontertanggung').prop('disabled', true);

						$.ajax({
							type	: "POST",					
							url		: "<?=base_url('jspromapannew_2019/cgetAsumsiDanaInvest');?>",
							data	: "usiacalontertanggung="+usiasekarangctt,
							success : function(msg) {
								var adi = JSON.parse(msg);
								var asumsidanainvest1 = adi.RANGE1;
								var asumsidanainvest2 = adi.RANGE2;
								var asumsidanainvest3 = adi.RANGE3;
														
								$('#rumusasumsidanainvest1').val(asumsidanainvest1.replace(",", "."));
								$('#rumusasumsidanainvest2').val(asumsidanainvest2.replace(",", "."));
								$('#rumusasumsidanainvest3').val(asumsidanainvest3.replace(",", "."));
							}
						});
					}
					var kdnpert = (65 - parseInt(usiasekarangctt));
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew_2019/cgetResikoAwal');?>",
						data	: "kdnpert="+kdnpert,
						success : function(msg) {
							var d = JSON.parse(msg);
							var tarifresikoawal = d.TARIF;
							var tarifresikoawal_ = tarifresikoawal.replace(",", ".");
							$('#tarifresikoawaldanspouse').val(tarifresikoawal_);
							$('#tarifresikoawalpayor').val(0);
						}
					});

					document.getElementById("namacalontertanggung").value = document.getElementById("namapemegangpolis").value;
					document.getElementById("tanggallahircalontertanggung").value = document.getElementById("tanggallahirpemegangpolis").value;
					document.getElementById("jeniskelamincalontertanggung").value = document.getElementById("jeniskelaminpemegangpolis").value;
					document.getElementById("usiacalontertanggung").value = document.getElementById("usiapemegangpolis").value;
					document.getElementById("hubungandenganpempol").value = 3;
					document.getElementById("perokokcalontertanggung").value = document.getElementById("perokokpemegangpolis").value;
					document.getElementById("kdjnspekerjaancalontertanggung").value = document.getElementById("kdjnspekerjaanpemegangpolis").value;
					$('#kdhobicalontertanggung').val($('#kdhobipemegangpolis').val());
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
					$('#kdhobicalontertanggung').prop('disabled', false);
					
					$('#barisjspbd').prop('hidden', false);
					$('#barisjspbci').prop('hidden', false);
					$('#barisjspbtpd').prop('hidden', false);
					$('#barisjsspd').prop('hidden', false);
					$('#barisjsspci').prop('hidden', false);
					$('#barisjssptpd').prop('hidden', false);

					$('#pil_jspbd').prop('disabled', false);
					$('#pil_jspbci').prop('disabled', false);
					$('#pil_jspbtpd').prop('disabled', false);
					$('#pil_jsspd').prop('disabled', false);
					$('#pil_jsspci').prop('disabled', false);
					$('#pil_jssptpd').prop('disabled', false);
		
					document.getElementById("ekstrapremilifectt").value ="";
					document.getElementById("ekstrapremipactt").value ="";
					document.getElementById("ekstrapremitpdctt").value ="";
					document.getElementById("namacalontertanggung").value = "";
					document.getElementById("tanggallahircalontertanggung").value = "";
					document.getElementById("jeniskelamincalontertanggung").value = "";
					document.getElementById("usiacalontertanggung").value = "";
					document.getElementById("hubungandenganpempol").value = 0;
					//document.getElementById("perokokcalontertanggung").value = "";
					document.getElementById("kdjnspekerjaancalontertanggung").value = "";
					document.getElementById("kdhobicalontertanggung").value ="";
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
					$('#barisjswpci51').prop('hidden', true);
					$('#barisjswptpd').prop('hidden', true);
					$('#barisjspbd').prop('hidden', true);
					$('#barisjspbci').prop('hidden', true);
					$('#barisjspbtpd').prop('hidden', true);
					$('#barisjsspd').prop('hidden', false);
					$('#barisjsspci').prop('hidden', false);
					$('#barisjssptpd').prop('hidden', false);

					$('#pil_jswpci51').prop('disabled', true);
					$('#pil_jswptpd').prop('disabled', true);
					$('#pil_jspbd').prop('disabled', true);
					$('#pil_jspbci').prop('disabled', true);
					$('#pil_jspbtpd').prop('disabled', true);
					$('#pil_jsspd').prop('disabled', false);
					$('#pil_jsspci').prop('disabled', false);
					//$('#jssptpd').prop('disabled', false);
					var nilaiekstrapremitpd_cpp = document.getElementById("ekstrapremitpdcpp").value;
					if(nilaiekstrapremitpd_cpp == 'DECLINE'){
						$('#pil_jssptpd').prop('disabled', true);
					}else{
						$('#pil_jssptpd').prop('disabled', false);
					}

					//Fungsi Untuk Mencari Tarif Resiko Awal
					var kdnpert = (65 - parseInt(usiasekarangctt));
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew_2019/cgetResikoAwal');?>",
						data	: "kdnpert="+kdnpert,
						success : function(msg) {
							var x = JSON.parse(msg);
							var tarifresikoawal = x.TARIF;
							var tarifresikoawal_ = tarifresikoawal.replace(",", ".");
							$('#tarifresikoawaldanspouse').val(tarifresikoawal_);
							$('#tarifresikoawalpayor').val(0);
						}
					});
				}else if (statushubungandenganpempol == 2){
					$('#barisjswpci51').prop('hidden', true);
					$('#barisjswptpd').prop('hidden', true);
					$('#barisjsspd').prop('hidden', true);
					$('#barisjsspci').prop('hidden', true);
					$('#barisjssptpd').prop('hidden', true);
					$('#barisjspbd').prop('hidden', false);
					$('#barisjspbci').prop('hidden', false);
					$('#barisjspbtpd').prop('hidden', false);

					if(usiasekarangctt > 24){
						$('#pil_jspbd').prop('disabled', true);
						$('#pil_jspbci').prop('disabled', true);
						$('#pil_jspbtpd').prop('disabled', true);
					}else{
						$('#pil_jspbd').prop('disabled', false);
						$('#pil_jspbci').prop('disabled', false);

						var nilaiekstrapremitpd_cpp = document.getElementById("ekstrapremitpdcpp").value;
						if(nilaiekstrapremitpd_cpp == 'DECLINE'){
							$('#pil_jspbtpd').prop('disabled', true);
						}else{
							$('#pil_jspbtpd').prop('disabled', false);
						}
					}
					$('#pil_jswpci51').prop('disabled', true);
					$('#pil_jswptpd').prop('disabled', true);
					$('#pil_jsspd').prop('disabled', true);
					$('#pil_jsspci').prop('disabled', true);
					$('#pil_jssptpd').prop('disabled', true);

					//Fungsi Untuk Mencari Tarif Resiko Awal
					var kdnpert = (25 - parseInt(usiasekarangctt));
					//console.log(kdnpert);
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew_2019/cgetResikoAwal');?>",
						data	: "kdnpert="+kdnpert,
						success : function(msg) {
							var y = JSON.parse(msg);
							var tarifresikoawal = y.TARIF;
							//console.log("TARIF RESIKO AWAL PAYOR :"+tarifresikoawal);
							var tarifresikoawal_ = tarifresikoawal.replace(",", ".");
							$('#tarifresikoawalpayor').val(tarifresikoawal_);
							$('#tarifresikoawaldanspouse').val(0);
						}
					});
				}else if(statushubungandenganpempol == 3){
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
							
							if(nilaiekstrapremipa == 'DECLINE'){
								$('#pil_jsadb').prop('disabled', true);
								$('#pil_jsaddb').prop('disabled', true);
							}
							if(nilaiekstrapremitpd == 'DECLINE'){
								$('#pil_jswptpd').prop('disabled', true);
								$('#pil_jstpd').prop('disabled', true);
							}else{
								$('#pil_jswptpd').prop('disabled', false);
							}

							$('#namacalontertanggung').prop('disabled', true);
							$('#tanggallahircalontertanggung').prop('disabled', true);
							$('#jeniskelamincalontertanggung').prop('disabled', true);
							$('#hubungandenganpempol').prop('disabled', true);
							$('#perokokcalontertanggung').prop('disabled', true);
							$('#kdjnspekerjaancalontertanggung').prop('disabled', true);
							$('#pil_jswpci51').prop('disabled', false);
							
							$('#barisjspbd').prop('hidden', true);
							$('#barisjspbci').prop('hidden', true);
							$('#barisjspbtpd').prop('hidden', true);
							$('#barisjsspd').prop('hidden', true);
							$('#barisjsspci').prop('hidden', true);
							$('#barisjssptpd').prop('hidden', true);

							$('#pil_jspbd').prop('disabled', true);
							$('#pil_jspbci').prop('disabled', true);
							$('#pil_jspbtpd').prop('disabled', true);
							$('#pil_jsspd').prop('disabled', true);
							$('#pil_jsspci').prop('disabled', true);
							$('#pil_jssptpd').prop('disabled', true);

						}
					});
					
					var kdhobicalontertanggung = $('#kdhobipemegangpolis').val();
					
					$.ajax({
						type	: "GET",
						dataType: "json",
						url		: "<?=C_URL_API.'/master/hobi/';?>"+kdhobicalontertanggung,
						success : function(data) {
							if (!data.error) {
								$('#ekstrapremilifehobictt').val(data.message.LIFE);
								$('#ekstrapremipahobictt').val(data.message.PA);
							}
						}
					});

					//Fungsi Untuk Mencari Tarif Resiko Awal
					var usiasekarangctt = document.getElementById("usiapemegangpolis").value;
					var kdnpert = (65 - parseInt(usiasekarangctt));
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew_2019/cgetResikoAwal');?>",
						data	: "kdnpert="+kdnpert,
						success : function(msg) {
							var d = JSON.parse(msg);
							var tarifresikoawal = d.TARIF;
							var tarifresikoawal_ = tarifresikoawal.replace(",", ".");
							$('#tarifresikoawaldanspouse').val(tarifresikoawal_);
							$('#tarifresikoawalpayor').val(0);
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
					//document.getElementById("pekerjaancalontertanggung").value = document.getElementById("pekerjaanpemegangpolis").value;
					document.getElementById("noktpcalontertanggung").value = document.getElementById("noktppemegangpolis").value;
					
				}
				var maxmasaasuransispouse = ((65 - parseInt(usiasekarangcpp)) + parseInt(usiasekarangctt));
				$('#maxmasaasuransispousepayor').val(maxmasaasuransispouse);
				$('#maxmasaasuransispousepayorci').val(maxmasaasuransispouse);
				$('#maxmasaasuransispousepayortpd').val(maxmasaasuransispouse);

				var maxmasaasuransipayor = parseInt(usiasekarangctt) + Math.min((25-parseInt(usiasekarangctt)), (65-parseInt(usiasekarangcpp)));
				$('#maxmasaasuransipayord').val(maxmasaasuransipayor);
				$('#maxmasaasuransipayorci').val(maxmasaasuransipayor);
				$('#maxmasaasuransipayortpd').val(maxmasaasuransipayor);
			});


			function getEkstraPremi(){

				var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				var kdhobicalontertanggung = $('#kdhobicalontertanggung').val();
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/cgetEkstraPremi');?>",
					data	: "kdjenispekerjaanctt="+kdjenispekerjaanctt,
					success : function(msg) {
						var z = JSON.parse(msg);
						var nilaiekstrapremilife = z.LIFEEXTRA;
						var nilaiekstrapremipa = z.PAEXTRA;
						var nilaiekstrapremitpd = z.TPDEXTRA;
						$('#ekstrapremilifectt').val(nilaiekstrapremilife);
						$('#ekstrapremipactt').val(nilaiekstrapremipa);
						$('#ekstrapremitpdctt').val(nilaiekstrapremitpd);

						if(nilaiekstrapremilife == 'REFER'){
							alert("Risiko pekerjaan akan dinilai lebih lanjut, silahkan mengisi kuesioner.");
							document.getElementById("kdjnspekerjaancalontertanggung").value="";
							document.getElementById("uangasuransi").value=0;
							$('#ketuangasuransi').prop('hidden', false);
						}

						if(nilaiekstrapremipa == 'DECLINE'){
							$('#pil_jsadb').prop('disabled', true);
							$('#pil_jsaddb').prop('disabled', true);
						}
						if(nilaiekstrapremitpd == 'DECLINE'){
							$('#pil_jswptpd').prop('disabled', true);
							$('#pil_jstpd').prop('disabled', true);
							$('#pil_jspbtpd').prop('disabled', true);
							$('#pil_jssptpd').prop('disabled', true);
						}
					}
				});
				
				if (kdhobicalontertanggung) {
					$.ajax({
						type	: "GET",
						dataType: "json",
						url		: "<?=C_URL_API.'/master/hobi/';?>"+kdhobicalontertanggung,
						success : function(data) {
							if (!data.error) {
								$('#ekstrapremilifehobictt').val(data.message.LIFE);
								$('#ekstrapremipahobictt').val(data.message.PA);
							}
						}
					});
				}
			};	

			/*** FUNGSI UNTUK MENGHITUNG JUA ***/
			function getAllTarif(){
				$.LoadingOverlay("show");
				$('#ketuangasuransi').prop('hidden', true);
				var usiasekarangctt = $("#usiacalontertanggung").val();
				var usiasekarangcpp = $("#usiapemegangpolis").val();				
				var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
				var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
				var kdhobictt = $("#kdhobicalontertanggung").val();
				var jeniskelaminctt = document.getElementById("jeniskelamincalontertanggung").value;
				var perokokcalontertanggung = document.getElementById("perokokcalontertanggung").value;
				var premi = document.getElementById("totalpremi").value;
				if( kdjenispekerjaanctt=="" || kdhobictt=="" || hubungandenganpempol=="" || jeniskelaminctt=="" || perokokcalontertanggung =="" || premi==0)
				{
					$.LoadingOverlay("hide");
					alert('Silahkan melengkapi data calon tertanggung atau nilai premi terlebih dahulu!');
					//location.reload(true);
					document.getElementById("totalpremi").value ="";
					exit();
				}				
				
				// Tampilkan informasi premi substandard
				if (parseInt($('#ekstrapremilifectt').val())+parseInt($('#ekstrapremipactt').val())+parseInt($('#ekstrapremitpdctt').val())+parseInt($('#ekstrapremilifehobictt').val())+parseInt($('#ekstrapremipahobictt').val()) > 0) {
					$(".premiSubStandard").removeClass('hide');
				} else {
					$(".premiSubStandard").addClass('hide');
				}

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/cgetTarifAll');?>",
					data	: "usiacalontertanggung="+usiasekarangctt,
					success : function(msg) {
						var a = JSON.parse(msg);
						
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

						//Cek Nilai Ektra Premi Karena RESIKO PEKERJAAN & HOBI
						var nilaiekstrapremilife_ctt = document.getElementById("ekstrapremilifectt").value;
						var nilaiekstrapremilifehobi_ctt = $('#ekstrapremilifehobictt').val();
						var nilaiekstrapremipa_ctt = document.getElementById("ekstrapremipactt").value;
						var nilaiekstrapremipahobi_ctt = $('#ekstrapremipahobictt').val();
						var nilaiekstrapremitpd_ctt = document.getElementById("ekstrapremitpdctt").value;

						//Cek Nilai Tarif Resiko Awal
						var tarifresikoawaldanspouse = document.getElementById("tarifresikoawaldanspouse").value;
						var tarifresikoawalpayor = document.getElementById("tarifresikoawalpayor").value;

						var tarifriderjsadb = a.ADB;
						var tarifriderjsci53 = a.CI53;
						var tarifriderjswpci51 = a.WPCI;
						var tarifriderjstpd = a.TPD;
						var tarifriderjswptpd = a.WPTPD;
						var tarifriderjsaddb = a.ADDB;


						//Fungsi untuk mengubah tarif (koma ke titik) dan membagi menjadi 12
						if(nilaiekstrapremilife_ctt == 'REFER'){
							var tariftermlife_ = 0;
						}else { 
							var tariftermlife_ = ((nilaiekstrapremilife_ctt * 1) + (nilaiekstrapremilifehobi_ctt * 1) + (tariftermlife.replace(/,/g,'.')) * 1) / 12;
							// var tariftermlife_ = (1 + (nilaiekstrapremilife_ctt / 1000)) * (tariftermlife.replace(",", ".")) / 12;
						}

						//PILIHAN RIDER JS ADB
						var checkBox_jsadb = document.getElementById("pil_jsadb");
						if (checkBox_jsadb.checked == true){
							if(nilaiekstrapremipa_ctt == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jsadb").checked = false;
								var pilihanjsadb = 0;
								var tarifriderjsadb_ = 0;
							}else{
								var pilihanjsadb = 1;
								var tarifriderjsadb_ = (((1 + (nilaiekstrapremipa_ctt / 100)) * tarifriderjsadb.replace(",", ".")) + (nilaiekstrapremipahobi_ctt*1)) / 12;
							}
						}else{
							var pilihanjsadb = 0;
							var tarifriderjsadb_ = 0;
						}

						//PILIHAN RIDER JS ADDB
						var checkBox_jsaddb = document.getElementById("pil_jsaddb");
						if (checkBox_jsaddb.checked == true){
							if(nilaiekstrapremipa_ctt == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jsaddb").checked = false;
								var pilihanjsaddb = 0;
								var tarifriderjsaddb_ = 0;
							}else{
								var pilihanjsaddb = 1;
								var tarifriderjsaddb_ = (((1 + (nilaiekstrapremipa_ctt / 100)) * tarifriderjsaddb.replace(",", ".")) + (nilaiekstrapremipahobi_ctt*1)) / 12;
							}
						}else{
							var pilihanjsaddb = 0;
							var tarifriderjsaddb_ = 0;
						}

						//PILIHAN RIDER JS CI-53
						var checkBox_jsci53 = document.getElementById("pil_jsci53");
						if (checkBox_jsci53.checked == true){
							var pilihanjsci53 = 1;
						}else{
							var pilihanjsci53 = 0;
						}
						var tarifriderjsci53_ = tarifriderjsci53.replace(",", ".") / 12;

						//PILIHAN RIDER JS TPD
						var checkBox_jstpd = document.getElementById("pil_jstpd");
						if (checkBox_jstpd.checked == true){
							if(nilaiekstrapremitpd_ctt == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jstpd").checked = false;
								var pilihanjstpd = 0;
								var tarifriderjstpd_ = 0;
							}else{
								var pilihanjstpd = 1;
								var tarifriderjstpd_ =  (1 + (nilaiekstrapremitpd_ctt / 100)) * tarifriderjstpd.replace(",", ".") / 12;
							}
						}else{
							var pilihanjstpd = 0;
							var tarifriderjstpd_=0;
						}

						//PILIHAN RIDER JS TR (TERM RIDER)
						var checkBox_jstr = document.getElementById("pil_jstr");
						if (checkBox_jstr.checked == true){
							if(nilaiekstrapremilife_ctt == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jstr").checked = false;
								var pilihanjstr = 0;
								var tariftermrider_ = 0;
							}else{
								var pilihanjstr = 1;
								var tariftermrider_ = ((nilaiekstrapremilife_ctt * 1) + (nilaiekstrapremilifehobi_ctt * 1) + (tariftermrider.replace(",", ".")) * 1) / 12;
								// var tariftermrider_ = (1 + (nilaiekstrapremilife_ctt / 1000)) * (tariftermrider.replace(",", ".")) / 12;
							}
						}else{
							var pilihanjstr = 0;
							var tariftermrider_ = 0;
						}

						//PILIHAN RIDER JS WP-CI51
						var checkBox_jswpci51 = document.getElementById("pil_jswpci51");
						if (checkBox_jswpci51.checked == true){
							var pilihanwpci51 = 1;
						}else{
							var pilihanwpci51 = 0;
						}
						var tarifriderjswpci51_ = tarifriderjswpci51.replace(",", ".") / 12;
						
						//PILIHAN RIDER JS WP-WPTPD
						var checkBox_jswptpd = document.getElementById("pil_jswptpd");
						if (checkBox_jswptpd.checked == true){
							if(nilaiekstrapremitpd_ctt == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jswptpd").checked = false;
								var pilihanwptpd = 0;
								var tarifriderjswptpd_ = 0;
							}else{
								var pilihanwptpd = 1;
								var tarifriderjswptpd_ = (1 + (nilaiekstrapremitpd_ctt / 100)) * tarifriderjswptpd.replace(",", ".") / 12;
							}
						}else{
							var pilihanwptpd = 0;
							var tarifriderjswptpd_ = 0;
						}
						
						//PILIHAN RIDER JS HCP
						var tarifriderjshcp_ = tarifriderjshcp.replace(",", ".");

						$('#tarifuangasuransidasar').val(tariftermlife_);
						$('#tarifuangasuransijstr').val(tariftermrider_);
						$('#tarifuangasuransijshcp').val(tarifriderjshcp_);
						$('#tarifuangasuransijsadb').val(tarifriderjsadb_);
						$('#tarifuangasuransijsci53').val(tarifriderjsci53_);
						$('#tarifuangasuransijswpci51').val(tarifriderjswpci51_);
						$('#tarifuangasuransijstpd').val(tarifriderjstpd_);
						$('#tarifuangasuransijswptpd').val(tarifriderjswptpd_);
						$('#tarifuangasuransijsaddb').val(tarifriderjsaddb_);
						
						//***Mendahulukan untuk menghitung rider rider yang tidak memperhitungkan Uang Asuransi***//

						//Menghitung Biaya Asuransi Rider JS HCP per Bulan
						var uangasuransijshcp = pilihanhcp * 100000;
						var biayaasuransijshcp = tarifriderjshcp_ / 12;
						
						$('#uangasuransijshcp').val(Math.round(uangasuransijshcp));
						$('#biayauangasuransijshcp').val(Math.round(biayaasuransijshcp));
						
						//Memanggil nilai-nilai untuk perhitungan JUA						
						var carabayarpremi = document.getElementById("carabayarjspromapannew").value;
						if (carabayarpremi == 1){
							var totalpremi = document.getElementById("totalpremi").value;
						}else if(carabayarpremi == 3){ //Cara Bayar Kurtalan
							var totalpremitahunan = document.getElementById("totalpremi").value;
							var totalpremi = totalpremitahunan / 3;
						}else if(carabayarpremi == 4){ //Cara Bayar Semesteran
							var totalpremitahunan = document.getElementById("totalpremi").value;
							var totalpremi = totalpremitahunan / 6;
						}else{ //Cara Bayar Tahunan
							var totalpremitahunan = document.getElementById("totalpremi").value;
							var totalpremi = totalpremitahunan / 12;
						}

						//Fungsi untuk menghitung rumus berapa persen sisa dana COI dan COR											
						var alokasipremi = document.getElementById("rumusalokasipremi").value;
						if(totalpremi < 500000){
							var asumsidanainvest = document.getElementById("rumusasumsidanainvest1").value;
						}else if(totalpremi >= 500000 && totalpremi < 1000000){
							var asumsidanainvest = document.getElementById("rumusasumsidanainvest2").value;
						}else{
							var asumsidanainvest = document.getElementById("rumusasumsidanainvest3").value;
						}						
						var hitungrumuscoa = 27500/totalpremi*100;
						var hasilhitungsisadanacoicor = alokasipremi - asumsidanainvest - hitungrumuscoa;												
						var hasilhitungsisabiayacoicor = document.getElementById("rumussisabiayacoicor").value;
						console.log("Asumsi Dana Invest = "+asumsidanainvest);
						$('#rumuscoa').val(hitungrumuscoa);
						$('#rumusasumsidanainvest').val(asumsidanainvest);						
						$('#rumussisadanacoicor').val(hasilhitungsisadanacoicor);

						//End tambahan untuk menentukan nilai asumsi dana investasi - Teguh 30/10/2019
						
						var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
						var RAjswpci51 = totalpremi * 12 * tarifresikoawaldanspouse / 1000;
						var RAjswptpd = totalpremi * 12 * tarifresikoawaldanspouse / 1000;
						var ra_wp = (Math.max(RAjswpci51, RAjswptpd));
						//console.log("RA WP: "+ra_wp);
						if(kdjenispekerjaanctt ==169 || kdjenispekerjaanctt ==306 || kdjenispekerjaanctt ==351){
							if (ra_wp > 200000000){
								alert("Tidak dapat mengambil rider Weiver karena resiko terlalu besar! ");

								var pilihanwpci51 = 0;
								var uangasuransijswpci51 = 0;
								var biayaasuransijswpci51 = 0;
								var resikoawaluangasuransijswpci51 = 0;
								$('#pil_jswpci51').prop('disabled', true);

								var pilihanwptpd = 0;
								var uangasuransijswptpd = 0;
								var biayaasuransijswptpd = 0;
								var resikoawaluangasuransijswptpd = 0;
								$('#pil_jswptpd').prop('disabled', true);
							}else{
								//Menghitung Biaya Asuransi Rider JS WP-CI51 per Bulan
								var uangasuransijswpci51 = pilihanwpci51 * totalpremi * 12;
								var biayaasuransijswpci51 = uangasuransijswpci51 * tarifriderjswpci51_ / 100;
								var resikoawaluangasuransijswpci51 = uangasuransijswpci51 * tarifresikoawaldanspouse / 1000;

								//Menghitung Biaya Asuransi Rider JS WP-TPD per Bulan
								var uangasuransijswptpd = pilihanwptpd * totalpremi * 12;
								var biayaasuransijswptpd = uangasuransijswptpd * tarifriderjswptpd_ / 100;
								var resikoawaluangasuransijswptpd = uangasuransijswptpd * tarifresikoawaldanspouse / 1000;
							}
						}else{
							//Menghitung Biaya Asuransi Rider JS WP-CI51 per Bulan
							var uangasuransijswpci51 = pilihanwpci51 * totalpremi * 12;
							var biayaasuransijswpci51 = uangasuransijswpci51 * tarifriderjswpci51_ / 100;
							var resikoawaluangasuransijswpci51 = uangasuransijswpci51 * tarifresikoawaldanspouse / 1000;

							//Menghitung Biaya Asuransi Rider JS WP-TPD per Bulan
							var uangasuransijswptpd = pilihanwptpd * totalpremi * 12;
							var biayaasuransijswptpd = uangasuransijswptpd * tarifriderjswptpd_ / 100;
							var resikoawaluangasuransijswptpd = uangasuransijswptpd * tarifresikoawaldanspouse / 1000;
						}
						//Menampilkan UA, BIAYA DAN RESIKO AWAL JS WP-CI51
						$('#uangasuransijswpci51').val(Math.round(uangasuransijswpci51));
						$('#biayauangasuransijswpci51').val(Math.round(biayaasuransijswpci51));
						$('#resikoawaluangasuransijswpci51').val(Math.round(resikoawaluangasuransijswpci51));

						//Menampilkan UA, BIAYA DAN RESIKO AWAL JS WP-TPD
						$('#uangasuransijswptpd').val(Math.round(uangasuransijswptpd));
						$('#biayauangasuransijswptpd').val(Math.round(biayaasuransijswptpd));
						$('#resikoawaluangasuransijswptpd').val(Math.round(resikoawaluangasuransijswptpd));

						//Menghitung Biaya Asuransi Rider JS PB-D per Bulan
						var kdjenispekerjaancpp = document.getElementById("kdjnspekerjaanpemegangpolis").value;
						var RAjspb = totalpremi * 12 * tarifresikoawalpayor / 1000;
						var RAjssp = totalpremi * 12 * tarifresikoawaldanspouse / 1000;
						var ra_pbsp = (Math.max(RAjspb, RAjssp));
						if(kdjenispekerjaancpp ==169 || kdjenispekerjaancpp ==306 || kdjenispekerjaanctt ==351){
							if(ra_pbsp > 500000000){
								alert("Tidak dapat mengambil rider Payor atau Spouse karena resiko terlalu besar! ");
								$('#pil_jspbd').prop('disabled', true);
								$('#pil_jspbci').prop('disabled', true);
								$('#pil_jspbtpd').prop('disabled', true);
								$('#pil_jsspd').prop('disabled', true);
								$('#pil_jsspci').prop('disabled', true);
								$('#pil_jssptpd').prop('disabled', true);
								var pilihanpbd = 0;
								var pilihanpbci = 0;
								var pilihanpbtpd = 0;
								var pilihanspd = 0;
								var pilihanspci = 0;
								var pilihansptpd = 0;
							}else{
								var checkBox_jspbd = document.getElementById("pil_jspbd");
								if (checkBox_jspbd.checked == true){
									var pilihanpbd = 1;
								}else{
									var pilihanpbd = 0;
								}

								var checkBox_jspbci = document.getElementById("pil_jspbci");
								if (checkBox_jspbci.checked == true){
									var pilihanpbci = 1;
								}else{
									var pilihanpbci = 0;
								}

								var checkBox_jspbtpd = document.getElementById("pil_jspbtpd");
								if (checkBox_jspbtpd.checked == true){
									var pilihanpbtpd = 1;
								}else{
									var pilihanpbtpd = 0;
								}

								var checkBox_jsspd = document.getElementById("pil_jsspd");
								if (checkBox_jsspd.checked == true){
									var pilihanspd = 1;
								}else{
									var pilihanspd = 0;
								}

								var checkBox_jsspci = document.getElementById("pil_jsspci");
								if (checkBox_jsspci.checked == true){
									var pilihanspci = 1;
								}else{
									var pilihanspci = 0;
								}

								var checkBox_jssptpd = document.getElementById("pil_jssptpd");
								if (checkBox_jssptpd.checked == true){
									var pilihansptpd = 1;
								}else{
									var pilihansptpd = 0;
								}
							}
						}else{
							var checkBox_jspbd = document.getElementById("pil_jspbd");
							if (checkBox_jspbd.checked == true){
								var pilihanpbd = 1;
							}else{
								var pilihanpbd = 0;
							}

							var checkBox_jspbci = document.getElementById("pil_jspbci");
							if (checkBox_jspbci.checked == true){
								var pilihanpbci = 1;
							}else{
								var pilihanpbci = 0;
							}

							var checkBox_jspbtpd = document.getElementById("pil_jspbtpd");
							if (checkBox_jspbtpd.checked == true){
								var pilihanpbtpd = 1;
							}else{
								var pilihanpbtpd = 0;
							}

							var checkBox_jsspd = document.getElementById("pil_jsspd");
							if (checkBox_jsspd.checked == true){
								var pilihanspd = 1;
							}else{
								var pilihanspd = 0;
							}

							var checkBox_jsspci = document.getElementById("pil_jsspci");
							if (checkBox_jsspci.checked == true){
								var pilihanspci = 1;
							}else{
								var pilihanspci = 0;
							}

							var checkBox_jssptpd = document.getElementById("pil_jssptpd");
							if (checkBox_jssptpd.checked == true){
								var pilihansptpd = 1;
							}else{
								var pilihansptpd = 0;
							}
						}

						//Cek Nilai Ektra Premi Karena RESIKO PEKERJAAN
						var nilaiekstrapremilife_cpp = document.getElementById("ekstrapremilifecpp").value;
						var nilaiekstrapremitpd_cpp = document.getElementById("ekstrapremitpdcpp").value;

						//Menghitung Biaya Asuransi Rider JS PB-D per Bulan
						var tarifriderjspbd_ = document.getElementById("tarifuangasuransijspbd").value;
						if(pilihanpbd == 1){
							if(nilaiekstrapremilife_cpp == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jspbd").checked=false;
								var uangasuransijspbd =	0;
							}else{
								var uangasuransijspbd = pilihanpbd * totalpremi * 12;
							}
						}else{
							var uangasuransijspbd =	0;
						}					
						var biayaasuransijspbd = uangasuransijspbd * tarifriderjspbd_ / 100;
						var resikoawaluangasuransijspbd = uangasuransijspbd * tarifresikoawalpayor / 1000;
						$('#uangasuransijspbd').val(Math.round(uangasuransijspbd));
						$('#biayauangasuransijspbd').val(Math.round(biayaasuransijspbd));
						$('#resikoawaluangasuransijspbd').val(Math.round(resikoawaluangasuransijspbd));

						//Menghitung Biaya Asuransi Rider JS PB-CI per Bulan
						var tarifriderjspbci_ = document.getElementById("tarifuangasuransijspbci").value;
						if(pilihanpbci == 1){
							if(tarifriderjspbci_ == 0){
								alert("Untuk pengambilan rider berikut tidak diperkenankan.");
								document.getElementById("pil_jspbci").checked=false;
								var uangasuransijspbci = 0;
							}else{
								var uangasuransijspbci = pilihanpbci * totalpremi * 12;
							}
						}else{
							var uangasuransijspbci = 0;
						}
						var biayaasuransijspbci = uangasuransijspbci * tarifriderjspbci_ / 100;
						var resikoawaluangasuransijspbci = uangasuransijspbci * tarifresikoawalpayor / 1000;
						$('#uangasuransijspbci').val(Math.round(uangasuransijspbci));
						$('#biayauangasuransijspbci').val(Math.round(biayaasuransijspbci));
						$('#resikoawaluangasuransijspbci').val(Math.round(resikoawaluangasuransijspbci));

						//Menghitung Biaya Asuransi Rider JS PB-TPD per Bulan
						var tarifriderjspbtpd_ = document.getElementById("tarifuangasuransijspbtpd").value;
						if(pilihanpbtpd == 1){
							if(nilaiekstrapremitpd_cpp == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jspbtpd").checked=false;
								var uangasuransijspbtpd = 0;
							}else{
								var uangasuransijspbtpd = pilihanpbtpd * totalpremi * 12;
							}
						}else{
							var uangasuransijspbtpd = 0;
						}
						var biayaasuransijspbtpd = uangasuransijspbtpd * tarifriderjspbtpd_ / 100;
						var resikoawaluangasuransijspbtpd = uangasuransijspbtpd * tarifresikoawalpayor / 1000;
						$('#uangasuransijspbtpd').val(Math.round(uangasuransijspbtpd));
						$('#biayauangasuransijspbtpd').val(Math.round(biayaasuransijspbtpd));
						$('#resikoawaluangasuransijspbtpd').val(Math.round(resikoawaluangasuransijspbtpd));

						//Menghitung Biaya Asuransi Rider JS SP-D per Bulan
						var tarifriderjsspd_ = document.getElementById("tarifuangasuransijsspd").value;
						if(pilihanspd == 1){
							if(nilaiekstrapremilife_cpp == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jsspd").checked=false;
								var uangasuransijsspd =	0;
							}else{
								var uangasuransijsspd = pilihanspd * totalpremi * 12;
							}
						}else{
							var uangasuransijsspd =	0;
						}
						var biayaasuransijsspd = uangasuransijsspd * tarifriderjsspd_ / 100;
						var resikoawaluangasuransijsspd = uangasuransijsspd * tarifresikoawaldanspouse / 1000;
						$('#uangasuransijsspd').val(Math.round(uangasuransijsspd));
						$('#biayauangasuransijsspd').val(Math.round(biayaasuransijsspd));
						$('#resikoawaluangasuransijsspd').val(Math.round(resikoawaluangasuransijsspd));

						//Menghitung Biaya Asuransi Rider JS SP-CI per Bulan
						var tarifriderjsspci_ = document.getElementById("tarifuangasuransijsspci").value;
						if(pilihanspci == 1){
							if(tarifriderjspbci_ == 0){
								alert("Untuk pengambilan rider berikut tidak diperkenankan.");
								document.getElementById("pil_jsspci").checked=false;
								var uangasuransijsspci = 0;
							}else{
								var uangasuransijsspci = pilihanspci * totalpremi * 12;
							}
						}else{
							var uangasuransijsspci = 0;
						}
						var biayaasuransijsspci = uangasuransijsspci * tarifriderjsspci_ / 100;
						var resikoawaluangasuransijsspci = uangasuransijsspci * tarifresikoawaldanspouse / 1000;
						$('#uangasuransijsspci').val(Math.round(uangasuransijsspci));
						$('#biayauangasuransijsspci').val(Math.round(biayaasuransijsspci));
						$('#resikoawaluangasuransijsspci').val(Math.round(resikoawaluangasuransijsspci));

						//Menghitung Biaya Asuransi Rider JS SP-TPD per Bulan
						var tarifriderjssptpd_ = document.getElementById("tarifuangasuransijssptpd").value;
						if(pilihansptpd == 1){
							if(nilaiekstrapremitpd_cpp == 'REFER'){
								alert("Untuk pengambilan rider berikut harap mengisi kuesioner.");
								$('#exampleModal').modal('show');
								document.getElementById("pil_jssptpd").checked=false;
								var uangasuransijssptpd = 0;
							}else{
								var uangasuransijssptpd = pilihansptpd * totalpremi * 12;
							}
						}else{
							var uangasuransijssptpd = 0;
						}
						var biayaasuransijssptpd = uangasuransijssptpd * tarifriderjssptpd_ / 100;
						var resikoawaluangasuransijssptpd = uangasuransijssptpd * tarifresikoawaldanspouse / 1000;
						$('#uangasuransijssptpd').val(Math.round(uangasuransijssptpd));
						$('#biayauangasuransijssptpd').val(Math.round(biayaasuransijssptpd));
						$('#resikoawaluangasuransijssptpd').val(Math.round(resikoawaluangasuransijssptpd));

						//Menghitung JUA
						var jumlahnilaitarif = tariftermlife_ + (tarifriderjsadb_ * pilihanjsadb) + (tarifriderjsci53_ * pilihanjsci53) + (tariftermrider_ * pilihanjstr) + (tarifriderjstpd_ * pilihanjstpd) + (tarifriderjsaddb_ * pilihanjsaddb) ;
						var jumlahnilaibiaya = biayaasuransijshcp + biayaasuransijswpci51 + biayaasuransijswptpd + biayaasuransijspbd + biayaasuransijspbci + biayaasuransijspbtpd + biayaasuransijsspd + biayaasuransijsspci + biayaasuransijssptpd;
						var ceknilairiderbenefitpasti = (1 - (hasilhitungsisabiayacoicor / 100)) * (totalpremi * hasilhitungsisadanacoicor / 100);
						// console.log("Jumlah Tarif : "+jumlahnilaitarif);
						// console.log("Jumlah Biaya : "+jumlahnilaibiaya);
						// console.log("Nilai : "+ceknilairiderbenefitpasti);
						var nilaia = (tariftermlife_ + (tarifriderjsadb_ * pilihanjsadb)) / jumlahnilaitarif;
						var nilaib =(hasilhitungsisabiayacoicor/100) / (1 - (jumlahnilaibiaya / (totalpremi * hasilhitungsisadanacoicor / 100)));
						// console.log("nilai atas : "+nilaia);
						// console.log("nilai bawah :"+nilaib);
						if (jumlahnilaibiaya > ceknilairiderbenefitpasti){
							alert("RIDER HCP & WP TERLALU BESAR");
							
							var jumlahnilaibiaya = 0 + 0 + 0 + biayaasuransijspbd + biayaasuransijspbci + biayaasuransijspbtpd + biayaasuransijsspd + biayaasuransijsspci + biayaasuransijssptpd;
							var ua_normal = Math.floor((((hasilhitungsisadanacoicor / 100 * totalpremi) - (jumlahnilaibiaya))  * 1000 / jumlahnilaitarif) / 1000000);
							var hasilhitungjua = ua_normal * 1000000;

							document.getElementById("jshcp").value=0;
							document.getElementById("uangasuransijshcp").value=0;
							document.getElementById("biayauangasuransijshcp").value=0;
							document.getElementById("pil_jswpci51").checked = false;
							document.getElementById("uangasuransijswpci51").value=0;
							document.getElementById("biayauangasuransijswpci51").value=0;
							document.getElementById("pil_jswptpd").checked = false;
							document.getElementById("uangasuransijswptpd").value=0;
							document.getElementById("biayauangasuransijswptpd").value=0;
							$('#uangasuransi').val(hasilhitungjua);
							$('#uangasuransidasar').val(hasilhitungjua);
						}else{
							if(nilaia < nilaib){
								alert("DANA KURANG !");
								var hasilhitungjua = 0;
								$('#uangasuransi').val(hasilhitungjua);
								$('#uangasuransidasar').val(hasilhitungjua);
								
							}else{								
								var ua_down = Math.floor((((hasilhitungsisadanacoicor / 100 * totalpremi) - (jumlahnilaibiaya))  * 1000 / jumlahnilaitarif) / 1000000);
								var ua_new = ua_down * 1000000;
								var a = Math.max(resikoawaluangasuransijswpci51, resikoawaluangasuransijswptpd);
								var bb = ( 1 + (parseInt(pilihanjsci53)/2) + (parseInt(pilihanjstr)) + (parseInt(pilihanjstpd)/2) );

								var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
								var totalresikoawalctt_new = ua_new + (pilihanjsci53 * ua_new / 2) + (pilihanjstr * ua_new) + (pilihanjstpd * ua_new / 2) + (Math.max(resikoawaluangasuransijswptpd, resikoawaluangasuransijswpci51));
								//console.log("Resiko Awal Tertanggung = "+totalresikoawalctt_new);

								//PENAMBAHAN UNTUK TOTAL RESIKO TIDAK BOLEH LEBIH DARI 10 MILIAR
								if(totalresikoawalctt_new > 10000000000){
									var hasilhitungjua = Math.floor(((10000000000 - a) / bb)/1000000) * 1000000;
								}else{
									if(kdjenispekerjaanctt ==169 || kdjenispekerjaanctt ==306 || kdjenispekerjaanctt ==351){
										if (totalresikoawalctt_new > 500000000){
											var hasilhitungjua = Math.floor(((500000000 - a) / bb)/1000000) * 1000000;
										}else{
											var hasilhitungjua = ua_new;
										}
									}else{
										var hasilhitungjua = ua_new;
									}
								}

								//var ua_normal = (((hasilhitungsisadanacoicor / 100 * totalpremi) - (jumlahnilaibiaya))  * 1000 / jumlahnilaitarif);
								//console.log("UA Sebelum Pembulatan :"+ua_normal);

								$('#uangasuransi').val(Math.round(hasilhitungjua));
								$('#uangasuransidasar').val(Math.round(hasilhitungjua));
								$('#resikoawaluangasuransidasar').val(Math.round(hasilhitungjua));
							}
						}

						//Menghitung Biaya Asuransi Dasar per Bulan
						var biayaasuransidasar = (hasilhitungjua * tariftermlife_ / 1000);
						$('#biayauangasuransidasar').val(Math.round(biayaasuransidasar));

						if(usiasekarangctt < 17){
							$('#pil_jsadb').prop('disabled', true);
							$('#pil_jsci53').prop('disabled', true);
							$('#pil_jsaddb').prop('disabled', true);
							$('#pil_jstr').prop('disabled', true);
							$('#pil_jstpd').prop('disabled', true);
							$('#jshcp').prop('disabled', true);
						}else{
							if(nilaiekstrapremilife_ctt == 'DECLINE'){
								$('#pil_jstr').prop('disabled', true);
							}else{
								$('#pil_jstr').prop('disabled', false);
							}
							if(nilaiekstrapremipa_ctt == 'DECLINE'){
								$('#pil_jsadb').prop('disabled', true);
								$('#pil_jsaddb').prop('disabled', true);
							}else{
								$('#pil_jsadb').prop('disabled', false);
								$('#pil_jsaddb').prop('disabled', false);
							}
							if(nilaiekstrapremitpd_ctt == 'DECLINE'){
								$('#pil_jstpd').prop('disabled', true);
							}else{
								$('#pil_jstpd').prop('disabled', false);
							}							
							$('#pil_jsci53').prop('disabled', false);
							$('#jshcp').prop('disabled', false);
						}

						if(usiasekarangcpp > 64){
							$('#pil_jsspd').prop('disabled', true);
							$('#pil_jsspci').prop('disabled', true);
							$('#pil_jssptpd').prop('disabled', true);

							$('#pil_jspbd').prop('disabled', true);
							$('#pil_jspbci').prop('disabled', true);
							$('#pil_jspbtpd').prop('disabled', true);
						}

						//Menghitung Biaya Asuransi Rider JS-ADB per Bulan
						var uangasuransijsadb_ = (pilihanjsadb * hasilhitungjua);
						if(uangasuransijsadb_ > 1500000000){
							var uangasuransijsadb = 1500000000;
						}else{
							var uangasuransijsadb = (pilihanjsadb * hasilhitungjua);
						}
						var biayaasuransijsadb = (uangasuransijsadb * tarifriderjsadb_ / 1000);
						if(tarifriderjsadb_ == 0){
							var uangasuransijsadb =	0;
						}else{
						}
						
						$('#uangasuransijsadb').val(Math.round(uangasuransijsadb));
						$('#biayauangasuransijsadb').val(Math.round(biayaasuransijsadb));

						//Menghitung Biaya Asuransi Rider JS-CI 53 per Bulan
						var uangasuransijsci53_ = (pilihanjsci53 * hasilhitungjua);
						if (uangasuransijsci53_ > 1500000000){
							var uangasuransijsci53 = 1500000000;
						}else{
							var uangasuransijsci53 = (pilihanjsci53 * hasilhitungjua);
						}
						var resikoawaluangasuransijsci53 = uangasuransijsci53 / 2;
						var biayaasuransijsci53 = (uangasuransijsci53 * tarifriderjsci53_ / 1000);
						$('#uangasuransijsci53').val(Math.round(uangasuransijsci53));
						$('#biayauangasuransijsci53').val(Math.round(biayaasuransijsci53));
						$('#resikoawaluangasuransijsci53').val(Math.round(resikoawaluangasuransijsci53));

						//Menghitung Biaya Asuransi Rider JS TERM RIDER per Bulan
						var uangasuransijstr_ = (pilihanjstr * hasilhitungjua);
						if (uangasuransijstr_ > 1500000000){
							var uangasuransijstr = 1500000000;
						}else{
							var uangasuransijstr = (pilihanjstr * hasilhitungjua);
						}
						var resikoawaluangasuransijstr = uangasuransijstr;
						var biayaasuransijstr = (uangasuransijstr * tariftermrider_ / 1000);
						$('#uangasuransijstr').val(Math.round(uangasuransijstr));
						$('#biayauangasuransijstr').val(Math.round(biayaasuransijstr));
						$('#resikoawaluangasuransijstr').val(Math.round(resikoawaluangasuransijstr));

						//Menghitung Biaya Asuransi Rider JS TPD per Bulan
						var uangasuransijstpd_ = (pilihanjstpd * hasilhitungjua);
						if (uangasuransijstpd_ > 1500000000){
							var uangasuransijstpd = 1500000000;
						}else{
							var uangasuransijstpd = (pilihanjstpd * hasilhitungjua);
						}
						var resikoawaluangasuransijstpd = uangasuransijstpd / 2;
						var biayaasuransijstpd = (uangasuransijstpd * tarifriderjstpd_ / 1000);
						$('#uangasuransijstpd').val(Math.round(uangasuransijstpd));
						$('#biayauangasuransijstpd').val(Math.round(biayaasuransijstpd));
						$('#resikoawaluangasuransijstpd').val(Math.round(resikoawaluangasuransijstpd));

						//Menghitung Biaya Asuransi Rider JS ADDB per Bulan
						var uangasuransijsaddb_ = (pilihanjsaddb * hasilhitungjua);
						if (uangasuransijsaddb_ > 1500000000){
							var uangasuransijsaddb = 1500000000;
						}else{
							var uangasuransijsaddb = (pilihanjsaddb * hasilhitungjua);
						}
						var biayaasuransijsaddb = (uangasuransijsaddb * tarifriderjsaddb_ / 1000);
						$('#uangasuransijsaddb').val(Math.round(uangasuransijsaddb));
						$('#biayauangasuransijsaddb').val(Math.round(biayaasuransijsaddb));
						
						//Menghitung Total Resiko Calon Pemegang Polis
						var kdjenispekerjaanctt = document.getElementById("kdjnspekerjaancalontertanggung").value;
						var totalresikoawalctt = hasilhitungjua + resikoawaluangasuransijsci53 + resikoawaluangasuransijstr + resikoawaluangasuransijstpd + (Math.max(resikoawaluangasuransijswptpd, resikoawaluangasuransijswpci51));
						//console.log("TR-CTT :"+totalresikoawalctt);
						var totalresikoawalcpp = Math.max(resikoawaluangasuransijspbd, resikoawaluangasuransijspbci, resikoawaluangasuransijspbtpd, resikoawaluangasuransijsspd, resikoawaluangasuransijsspci, resikoawaluangasuransijssptpd);

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
						
						// Jika resiko finansial lebih kecil dari resiko awal maka keluar
						if (totalresikoawalctt > $('#resikofinansialctt').val()) {
							alert('Resiko Awal Anda melebihi Resiko Finansial!');
							$('#totalpremi, #premiberkala, #topupberkala').val('');
						}
						
						// Jika pelajar & ibu RT resiko melebihi 500 juta maka keluar
						if (($('#kdjnspekerjaancalontertanggung').val() == '165' || $('#kdjnspekerjaancalontertanggung').val() == '75' || $('#kdjnspekerjaancalontertanggung').val() == '109') && totalresikoawalctt > 500000000) {
							alert('Maksimum Akumulasi Risiko sebesar Rp500.000.000,00 (lima ratus juta rupiah)!');
							$('#totalpremi, #premiberkala, #topupberkala, #resikoawalproposalctt').val('');
						}
						
						$.LoadingOverlay("hide");
					}
				});

			};

			$('#topupsekaligus').on('change', function() {
				var topupsekaligus = document.getElementById("topupsekaligus").value;
				if(topupsekaligus < 1000000){
					alert("Minimal Topup Sekaligus adalah satu juta (Rp 1.000.000,-)");
					document.getElementById("topupsekaligus").value = "";
				}
			});
			
			$('#totalpremi').on('change', function() {
				//var totalpremi = document.getElementById("totalpremi").value;
				var carabayarpremi = document.getElementById("carabayarjspromapannew").value;
				if (carabayarpremi == 1){
					var totalpremi = document.getElementById("totalpremi").value;
					if(totalpremi<350000){
						alert("Minimal Premi per Bulan Rp 350.000,-");
						document.getElementById("totalpremi").value ="";
					}else{
						//var hasilpremiberkala = 0.7 * totalpremi;
						//var hasiltopupberkala = 0.3 * totalpremi;
						var hasilpremiberkala = 1 * totalpremi;
						var hasiltopupberkala = 0 * totalpremi;
					}
				}else if (carabayarpremi == 3){ //Cara bayar Kuartalan
					var totalpremitahunan = document.getElementById("totalpremi").value;
					var totalpremi = totalpremitahunan / 3;
					if(totalpremi<350000){
						alert("Minimal Premi per Bulan Rp 350.000,-");
						document.getElementById("totalpremi").value ="";
					}else{
						//var hasilpremiberkala = 0.7 * totalpremitahunan;
						//var hasiltopupberkala = 0.3 * totalpremitahunan;
						var hasilpremiberkala = 1 * totalpremitahunan;
						var hasiltopupberkala = 0 * totalpremitahunan;
					}
				}else if(carabayarpremi == 4){ //Cara Bayar Semesteran
					var totalpremitahunan = document.getElementById("totalpremi").value;
					var totalpremi = totalpremitahunan / 6;
					if(totalpremi<350000){
						alert("Minimal Premi per Bulan Rp 350.000,-");
						document.getElementById("totalpremi").value ="";
					}else{
						//var hasilpremiberkala = 0.7 * totalpremitahunan;
						//var hasiltopupberkala = 0.3 * totalpremitahunan;
						var hasilpremiberkala = 1 * totalpremitahunan;
						var hasiltopupberkala = 0 * totalpremitahunan;
					}
				}else{
					var totalpremitahunan = document.getElementById("totalpremi").value;
					var totalpremi = totalpremitahunan / 12;
					if(totalpremi<350000){
						alert("Minimal Premi per Bulan Rp 350.000,-");
						document.getElementById("totalpremi").value ="";
					}else{
						//var hasilpremiberkala = 0.7 * totalpremitahunan;
						//var hasiltopupberkala = 0.3 * totalpremitahunan;
						var hasilpremiberkala = 1 * totalpremitahunan;
						var hasiltopupberkala = 0 * totalpremitahunan;
					}
				}

				//Fungsi untuk menghitung rumus berapa persen nilai COA (27.500) terhadap premi
				// var hitungrumuscoa = 27500/totalpremi*100;

				// //Fungsi untuk menghitung rumus berapa persen sisa dana COi dan COR
				// var alokasipremi = document.getElementById("rumusalokasipremi").value;
				// var asumsidanainvest = document.getElementById("rumusasumsidanainvest").value;
				// var hasilhitungsisadanacoicor = alokasipremi - asumsidanainvest - hitungrumuscoa;

				// $('#rumuscoa').val(hitungrumuscoa);
				// $('#rumussisadanacoicor').val(hasilhitungsisadanacoicor);
				$('#premiberkala').val(Math.round(hasilpremiberkala));
				$('#topupberkala').val(Math.round(hasiltopupberkala));
				
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
				var UA = document.getElementById("uangasuransi").value;
				var pilihanalokasi1 = document.getElementById("alokasidana1").value;
				var pilihanalokasi2 = document.getElementById("alokasidana2").value;
				var nilfund1 = document.getElementById("persentasealokasidana1").value;
				var nilfund2 = document.getElementById("persentasealokasidana2").value;
				var jmlfund = (nilfund1*1) + (nilfund2*1);
				console.log("TOTAL NILAI FUND : "+jmlfund);
				if(UA==0 || pilihanalokasi1=="" || jmlfund != 100 || pilihanalokasi1 == pilihanalokasi2){
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
				var kdhobipemegangpolis = $("#kdhobipemegangpolis").val();

				var perokok = document.getElementById("perokokcalontertanggung").value;
				var namalengkapcalontertanggung = document.getElementById("namacalontertanggung").value;
				var tanggallahircalontertanggung = document.getElementById("tanggallahircalontertanggung").value;
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var noktp = document.getElementById("noktpcalontertanggung").value;
				var kdjnspekerjaancalontertanggung = document.getElementById("kdjnspekerjaancalontertanggung").value;
				var kdhobicalontertanggung = $('#kdhobicalontertanggung').val();
				//console.log("hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&kdjnspekerjaanpempol="+kdjnspekerjaanpempol+"&noktpcpp="+noktpcpp);

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/insertProPempol');?>",
					data	: "hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&kdjnspekerjaanpempol="+kdjnspekerjaanpempol+"&noktpcpp="+noktpcpp+"&kdhobicalonpempol="+kdhobipemegangpolis,
					success : function(msg) {

					}
				});

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/insertProTertanggung');?>",
					data	: "hubungandenganpempol="+hubungandenganpempol+"&perokok="+perokok+"&namalengkapcalontertanggung="+namalengkapcalontertanggung+"&tanggallahircalontertanggung="+tanggallahircalontertanggung+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&noktp="+noktp+"&kdjnspekerjaancalontertanggung="+kdjnspekerjaancalontertanggung+"&kdhobicalontertanggung="+kdhobicalontertanggung,
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
				var premiberkala = Math.round(document.getElementById("premiberkala").value);
				var topupberkala = document.getElementById("topupberkala").value;
				var topupsekaligus = document.getElementById("topupsekaligus").value;
				var totalpremi = document.getElementById("totalpremi").value;
				var resikoawalproposalctt = document.getElementById("resikoawalproposalctt").value;
				var periodetopupsekaligus = document.getElementById("periodetopupsekaligus").value;
				var pemeriksaan = document.getElementById("pemeriksaan").value;
				var medical = document.getElementById("medical").value;

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/insertProAsuransiPokok');?>",
					data	: "asumsicutipremi="+asumsicutipremi+"&carabayarjspromapannew="+carabayarjspromapannew+"&usiaproduktif="+usiaproduktif+"&penghasilansatutahun="+penghasilansatutahun+"&maksimaluangasuransi="+maksimaluangasuransi+"&uangpertanggungan="+uangpertanggungan+"&premiberkala="+premiberkala+"&topupberkala="+topupberkala+"&topupsekaligus="+topupsekaligus+"&totalpremi="+totalpremi+"&resikoawalproposalctt="+resikoawalproposalctt+"&periodetopupsekaligus="+periodetopupsekaligus+"&pemeriksaan="+pemeriksaan+"&medical="+medical,
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
					url		: "<?=base_url('jspromapannew_2019/insertProAlokasiDana');?>",
					data	: "alokasidana1="+alokasidana1+"&persentasealokasidana1="+persentasealokasidana1+"&alokasidana2="+alokasidana2+"&persentasealokasidana2="+persentasealokasidana2+"&carabayarjspromapannew="+carabayarjspromapannew+"&totalpremi="+totalpremi+"&usiasekarang="+usiasekarang,
					success : function(msg) {

					}
				});

				var is_uadasar = 1;
				var uadasar = document.getElementById("uangasuransidasar").value;
				var biaya_uadasar = document.getElementById("biayauangasuransidasar").value;
				//var is_adb = document.getElementById("jsadb").value;
				var checkBox_jsadb = document.getElementById("pil_jsadb");
				if (checkBox_jsadb.checked == true){
					var is_adb = 1;
				}else{
					var is_adb = 0;
				}
				var adb = document.getElementById("uangasuransijsadb").value;
				var biaya_adb = document.getElementById("biayauangasuransijsadb").value;
				//var is_ci53 = document.getElementById("jsci53").value;
				var checkBox_jsci53 = document.getElementById("pil_jsci53");
				if (checkBox_jsci53.checked == true){
					var is_ci53 = 1;
				}else{
					var is_ci53 = 0;
				}
				var ci53 = document.getElementById("uangasuransijsci53").value;
				var biaya_ci53 = document.getElementById("biayauangasuransijsci53").value;
				//var is_wpci51= document.getElementById("jswpci51").value;
				var checkBox_jswpci51 = document.getElementById("pil_jswpci51");
				if (checkBox_jswpci51.checked == true){
					var is_wpci51 = 1;
				}else{
					var is_wpci51 = 0;
				}
				var wpci51= document.getElementById("uangasuransijswpci51").value;
				var biaya_wpci51= document.getElementById("biayauangasuransijswpci51").value;
				//var is_tr= document.getElementById("jstr").value;
				var checkBox_jstr = document.getElementById("pil_jstr");
				if (checkBox_jstr.checked == true){
					var is_tr = 1;
				}else{
					var is_tr = 0;
				}
				var tr= document.getElementById("uangasuransijstr").value;
				var biaya_tr= document.getElementById("biayauangasuransijstr").value;
				var is_hcp= document.getElementById("jshcp").value;
				var hcp= document.getElementById("uangasuransijshcp").value;
				var biaya_hcp= document.getElementById("biayauangasuransijshcp").value;
				//var is_tpd= document.getElementById("jstpd").value;
				var checkBox_jstpd = document.getElementById("pil_jstpd");
				if (checkBox_jstpd.checked == true){
					var is_tpd = 1;
				}else{
					var is_tpd = 0;
				}
				var tpd= document.getElementById("uangasuransijstpd").value;
				var biaya_tpd= document.getElementById("biayauangasuransijstpd").value;
				//var is_wptpd= document.getElementById("jswptpd").value;
				var checkBox_jswptpd = document.getElementById("pil_jswptpd");
				if (checkBox_jswptpd.checked == true){
					var is_wptpd = 1;
				}else{
					var is_wptpd = 0;
				}
				var wptpd= document.getElementById("uangasuransijswptpd").value;
				var biaya_wptpd= document.getElementById("biayauangasuransijswptpd").value;
				//var is_addb= document.getElementById("jsaddb").value;
				var checkBox_jsaddb = document.getElementById("pil_jsaddb");
				if (checkBox_jsaddb.checked == true){
					var is_addb = 1;
				}else{
					var is_addb = 0;
				}
				var addb= document.getElementById("uangasuransijsaddb").value;
				var biaya_addb= document.getElementById("biayauangasuransijsaddb").value;
				//var is_pbd= document.getElementById("jspbd").value;
				var checkBox_jspbd = document.getElementById("pil_jspbd");
				if (checkBox_jspbd.checked == true){
					var is_pbd = 1;
				}else{
					var is_pbd = 0;
				}
				var pbd= document.getElementById("uangasuransijspbd").value;
				var biaya_pbd= document.getElementById("biayauangasuransijspbd").value;
				//var is_pbci= document.getElementById("jspbci").value;
				var checkBox_jspbci = document.getElementById("pil_jspbci");
				if (checkBox_jspbci.checked == true){
					var is_pbci = 1;
				}else{
					var is_pbci = 0;
				}
				var pbci= document.getElementById("uangasuransijspbci").value;
				var biaya_pbci= document.getElementById("biayauangasuransijspbci").value;
				//var is_pbtpd= document.getElementById("jspbtpd").value;
				var checkBox_jspbtpd = document.getElementById("pil_jspbtpd");
				if (checkBox_jspbtpd.checked == true){
					var is_pbtpd = 1;
				}else{
					var is_pbtpd = 0;
				}
				var pbtpd= document.getElementById("uangasuransijspbtpd").value;
				var biaya_pbtpd= document.getElementById("biayauangasuransijspbtpd").value;
				//var is_spd= document.getElementById("jsspd").value;
				var checkBox_jsspd = document.getElementById("pil_jsspd");
				if (checkBox_jsspd.checked == true){
					var is_spd = 1;
				}else{
					var is_spd = 0;
				}
				var spd= document.getElementById("uangasuransijsspd").value;
				var biaya_spd= document.getElementById("biayauangasuransijsspd").value;
				//var is_spci= document.getElementById("jsspci").value;
				var checkBox_jsspci = document.getElementById("pil_jsspci");
				if (checkBox_jsspci.checked == true){
					var is_spci = 1;
				}else{
					var is_spci = 0;
				}
				var spci= document.getElementById("uangasuransijsspci").value;
				var biaya_spci= document.getElementById("biayauangasuransijsspci").value;
				//var is_sptpd= document.getElementById("jssptpd").value;
				var checkBox_jssptpd = document.getElementById("pil_jssptpd");
				if (checkBox_jssptpd.checked == true){
					var is_sptpd = 1;
				}else{
					var is_sptpd = 0;
				}
				var sptpd= document.getElementById("uangasuransijssptpd").value;
				var biaya_sptpd= document.getElementById("biayauangasuransijssptpd").value;
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/insertProDataRider');?>",
					data	: "is_uadasar="+is_uadasar+"&uadasar="+uadasar+"&biaya_uadasar="+biaya_uadasar+"&is_adb="+is_adb+"&adb="+adb+"&biaya_adb="+biaya_adb+"&is_ci53="+is_ci53+"&ci53="+ci53+"&biaya_ci53="+biaya_ci53+"&is_wpci51="+is_wpci51+"&wpci51="+wpci51+"&biaya_wpci51="+biaya_wpci51+"&is_tr="+is_tr+"&tr="+tr+"&biaya_tr="+biaya_tr+"&is_hcp="+is_hcp+"&hcp="+hcp+"&biaya_hcp="+biaya_hcp+"&is_tpd="+is_tpd+"&tpd="+tpd+"&biaya_tpd="+biaya_tpd+"&is_wptpd="+is_wptpd+"&wptpd="+wptpd+"&biaya_wptpd="+biaya_wptpd+"&is_addb="+is_addb+"&addb="+addb+"&biaya_addb="+biaya_addb+"&is_pbd="+is_pbd+"&pbd="+pbd+"&biaya_pbd="+biaya_pbd+"&is_pbci="+is_pbci+"&pbci="+pbci+"&biaya_pbci="+biaya_pbci+"&is_pbtpd="+is_pbtpd+"&pbtpd="+pbtpd+"&biaya_pbtpd="+biaya_pbtpd+"&is_spd="+is_spd+"&spd="+spd+"&biaya_spd="+biaya_spd+"&is_spci="+is_spci+"&spci="+spci+"&biaya_spci="+biaya_spci+"&is_sptpd="+is_sptpd+"&sptpd="+sptpd+"&biaya_sptpd="+biaya_sptpd,
					success : function(msg) {				
						//alert(msg);						 		
						var filepdf = 'SIMULASI-'+document.getElementById("namacalontertanggung").value.toUpperCase()+'-'+msg;						
						var kodeprospek =document.getElementById("kodeprospek").value;
						
						alert("Proposal Berhasil Disimpan!");
						window.location.href= "<?=base_url('jspromapannew_2019/hasilifg')?>?buildid="+<?=$this->session->userdata('build_id');?>+'&filepdf='+filepdf+'&kodeprospek='+kodeprospek; 
						$.LoadingOverlay("hide");
 
					}
				});

				var kodeprospek =document.getElementById("kodeprospek").value;
				//console.log("carabayarjspromapannew="+carabayarjspromapannew+"&uangpertanggungan="+uangpertanggungan+"&totalpremi="+totalpremi+"&kodeprospek="+kodeprospek+"&namalengkapcalontertanggung="+namalengkapcalontertanggung);

				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew_2019/insertDataPDFIFG');?>",
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