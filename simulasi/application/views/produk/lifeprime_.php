<!-- Header ada di file header.php terpisah -->
<?php error_reporting(0); ?>
	<!-- BEGIN BODY -->
	<body class="page-header-fixed">
		<!--div class="clearfix"></div-->
	
		<!-- BEGIN CONTAINER -->
		<div class="">
	
			<!-- BEGIN CONTENT -->
			<div class="page-content-wrapper">
				<div class="page-content">
					<!-- BEGIN PAGE HEADER-->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PAGE TITLE & BREADCRUMB-->
							<h3 class="page-title" align="center">
								<img src="<?= base_url();?>assets/img/jspos.jpg"/> <small>Power on Sales</small>
							</h3>
					
						</div>
					</div>
					<!-- END PAGE HEADER-->
					
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue" id="form_wizard_1">
								<div class="portlet-title" align="center">
									<div class="caption">
										<i class="fa fa-reorder"></i> Simulasi Produk -
										<span class="step-title"><?=$produk['NAMAPRODUK']?></span>
									</div>
								</div>
								
								<div class="portlet-body form">
									<form action="<?=base_url("ultimate/save")?>" class="form-horizontal" id="form-ultimate" method="post">
										<input type="hidden" name="resikopekerjaan" id="pekerjaanlife" />
										<input type="hidden" name="resikopembagipekerjaan" id="pekerjaanpembagilife" />
										<input type="hidden" name="resikohobi" id="hobilife" />
										<input type="hidden" name="resikopembagihobi" id="hobipembagilife" />
										<input type="hidden" name="noagen" value="<?=$this->input->get('noagen')?>" />
										<input type="hidden" name="kdproduk" value="<?=$this->input->get('kdproduk')?>" />
										<input type="hidden" name="pemeriksaan" id="pemeriksaan" />
										<input type="hidden" name="medical" id="medical" />
										<input type="hidden" name="kdtarif" id="kdtarif" />
										<div class="form-wizard">
											<div class="form-body">
												<div class="box box-info">
													<!--Start Input Data Calon Pemegang Polis-->
													<div class="box-header with-border">
													  <h3 class="box-title">Data Diri Calon Pemegang Polis</h3>
													</div>
													<br />
													<div class="box-body">
														<div class="row">
															<!-- Kolom Kiri -->
															<div class="col-md-4">
																<!--Input Nama-->
																<div class="form-group">
																	<label class="control-label col-md-4">Nama Lengkap</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAKLIEN'];?></b></label>
																	<input type="hidden" name="namapemegangpolis" id="namapemegangpolis" value="<?=$prospek['NAMAKLIEN'];?>"/>
																</div>
																<!--Input Jenis Kelamin-->
																<div class="form-group">
																	<label class="control-label col-md-4">Jenis Kelamin</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAJENISKELAMIN'];?></b></label>
																	<input type="hidden" value="<?=$prospek['NAMAJENISKELAMIN'];?>"/>
																	<input type="hidden" id="kdjeniskelaminpemegangpolis" name="kdjeniskelaminpemegangpolis" value="<?=$prospek['KDJENISKELAMIN'];?>" />
																</div>
																<!--Input Tanggal Lahir-->
																<div class="form-group">
																	<label class="control-label col-md-4">Tanggal Lahir</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['TGLLAHIR'];?></b></label>
																	<input type="hidden" id="tanggallahirpemegangpolis" name="tanggallahirpemegangpolis" value="<?=$prospek['TGLLAHIR'];?>" />
																</div>	
																<!--Input Usia-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?="$prospek[USIA] Tahun"?></b></label>
																	<input type="hidden" id="usiapemegangpolistahun" value="<?="$prospek[USIA] Tahun"?>" />
																	<input type="hidden" name="usiapemegangpolis" id="usiapemegangpolis" value="<?=$prospek['USIA']?>" />
																</div>
															</div>
															<!-- Kolom Tengah -->
															<div class="col-md-4">
																<!--Input KTP-->
																<div class="form-group">
																	<label class="control-label col-md-4">No KTP</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NOID']?></b></label>
																	<input type="hidden" name="noktppemegangpolis" id="noktppemegangpolis" value="<?=$prospek['NOID'];?>" />
																</div>
																<!--Input Jenis Pekerjaan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Pekerjaan</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAPEKERJAAN']?></b></label>
																	<input type="hidden" value="<?=$prospek['NAMAPEKERJAAN'];?>"/>
																	<input type="hidden" name="kdpekerjaanpemegangpolis" id="kdpekerjaanpemegangpolis" value="<?=$prospek['KDPEKERJAAN'];?>" />
																</div>
																<!--Input Hobi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Hobi</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['NAMAHOBI']?></b></label>
																	<input type="hidden" value="<?=$prospek['NAMAHOBI'];?>"/>
																	<input type="hidden" name="kdhobipemegangpolis" id="kdhobipemegangpolis" value="<?=$prospek['KDHOBI'];?>" />
																</div>
																<!--Input nomor HP-->
																<div class="form-group">
																	<label class="control-label col-md-4">Telepon/HP</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b>
																		<?php if ($prospek['TELEPON'] && $prospek['HP']) { echo "$prospek[TELEPON]/$prospek[HP]"; }
																			else if ($prospek['TELEPON']) { echo $prospek['TELEPON']; }
																			else if ($prospek['HP']) { echo $prospek['HP']; }
																		?>
																		</b>
																	</label>
																	<input type="hidden" name="phonepemegangpolis" id="phonepemegangpolis" value="<?=$prospek['TELP'];?>"/>
																	<input type="hidden" name="handphonepemegangpolis" id="handphonepemegangpolis" value="<?=$prospek['HP'];?>"/>
																</div>
															</div>
															<!-- Kolom Kanan -->
															<div class="col-md-4">
																<!--Input Email-->
																<div class="form-group">
																	<label class="control-label col-md-4">Email</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=$prospek['EMAIL']?></b></label>
																	<input type="hidden" name="emailpemegangpolis" id="emailpemegangpolis" value="<?=$prospek['EMAIL'];?>"/>
																</div>
																<!--Input Provinsi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Provinsi</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=($provinsi ? $provinsi['message']['NAMAPROPINSI'] : null)?></b></label>
																	<input type="hidden" name="kdprovinsipemegangpolis" id="kdprovinsipemegangpolis" value="<?=$prospek['KDPROVINSI'];?>" />
																</div>
																<!--Input Kota-->
																<div class="form-group">
																	<label class="control-label col-md-4">Kota</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?=($kota ? $kota['message']['NAMAKOTAMADYA'] : null)?></b></label>
																	<input type="hidden" name="kdkotamadyapemegangpolis" id="kotapemegangpolis" value="<?=$prospek['KDKOTAMADYA'];?>"/>
																</div>
																<!--Input Alamat-->
																<div class="form-group">
																	<label class="control-label col-md-4">Alamat</label>
																	<label class="control-label col-md-8" style="text-align:left;">: <b><?="$prospek[ALAMAT]"?></b></label>
																	<input type="hidden" name="alamatpemegangpolis" id="alamatpemegangpolis" value="<?=$prospek['ALAMAT'];?>"/>
																</div>
															</div>
														</div>
													</div>
													<!-- End Input Data Calon Pemegang Polis -->
													
													<!--Start Input Data Calon Tertanggung-->
													<div class="box-header with-border">
														<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Data Diri Calon Tertanggung</h3>
													</div>
													</br>
													<div class="checkbox-list">
														<label>
															<label class="el-checkbox">
																<input type="checkbox" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onclick="cekCPPsamadenganCTT()" value="1" />
																<span class="el-checkbox-style"></span>&nbsp&nbsp
																<b>Tertanggung sama dengan Pemegang Polis</b>
															</label>
														</label>
													</div>
													<br />
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Nama-->
																<div class="form-group">
																	<label class="control-label col-md-4">Nama Lengkap<span class="required">*</span></label>
																	<div class="col-md-8">
																		<input type="text" class="form-control" name="namacalontertanggung" id="namacalontertanggung"/>
																	</div>
																</div>
																<!--Input Tanggal Lahir-->
																<div class="form-group">
																	<label class="control-label col-md-4">Tanggal Lahir<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input readonly class="form-control input-xs datepicker" style="padding-left:11px;" id="tanggallahircalontertanggung" name="tanggallahircalontertanggung" type="text" placeholder="dd-mm-yyyy">
																	</div>
																</div>
																<!--Input Jenis Kelamin-->
																<div class="form-group">
																	<label class="control-label col-md-4">Jenis Kelamin<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="kdjeniskelamincalontertanggung" id="kdjeniskelamincalontertanggung" >
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$jeniskelamin['error']) {
																				foreach($jeniskelamin['message'] as $i => $v) {
																					echo "<option value='$v[KDJENISKELAMIN]'>$v[NAMAJENISKELAMIN]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
																<!-- Input Usia-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" name="usiacalontertanggungtahun" id="usiacalontertanggungtahun" style="border:0px;" />
																		<input readonly type="text" class="form-control" name="usiacalontertanggung" id="usiacalontertanggung" style="display:none;" />
																	</div>
																</div>
															</div>

															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!-- Input No KTP-->
																<div class="form-group">
																	<label class="control-label col-md-4">No KTP<span class="required">*</span></label>
																	<div class="col-md-8">
																		<input type="text" class="form-control" name="noktpcalontertanggung" id="noktpcalontertanggung" required />
																	</div>
																</div>
																<!--Input Hubungan dengan Pemegang Polis-->
																<div class="form-group">
																	<label class="control-label col-md-4">Hubungan dgn Calon PemPol<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control " name="kdhubungan" id="hubungandenganpempol" >
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$hubungan['error']) {
																				foreach($hubungan['message'] as $i => $v) {
																					echo "<option value='$v[KDHUBUNGAN]'>$v[NAMAHUBUNGAN]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
																<!--Input Pekerjaan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Pekerjaan<span class="required">*</span></label>
																	<div class="col-md-8">
																		<select name="kdpekerjaancalontertanggung" id="kdpekerjaancalontertanggung" class="form-control">
																			<option value="">Silahkan Pilih</option>
																			<?php if (!$pekerjaan['error']) {
																				foreach($pekerjaan['message'] as $i => $v) {
																					echo "<option value='$v[KDPEKERJAAN]'>$v[NAMAPEKERJAAN]</option>";
																				}
																			} ?>
																		</select>
																	</div>
																</div>
																<!--Input Pekerjaan-->
																<div class="form-group">
																	<label class="control-label col-md-4">Hobi<span class="required">*</span></label>
																	<div class="col-md-8">
																		<select name="kdhobicalontertanggung" id="kdhobicalontertanggung" class="form-control">
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
													</div>
													<br />
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Lama Asuransi-->
																<div class="form-group">
																	<label class="control-label col-md-4">Masa Asuransi Sampai Usia</label>
																	<div class="col-md-4">
																		<input type="text" name="masaasuransi" value="99" style="display:none;">
																		<input type="text" class="form-control" value="99 Tahun" readonly style="border:0px;">
																	</div>
																</div>
																<!--Input Cara Bayar-->
																<div class="form-group">
																	<label class="control-label col-md-4">Cara Bayar<span class="required">*</span></label>
																	<div class="col-md-4">
																		<select class="form-control" name="kdcarabayar" >
																			<option value="X">Sekaligus</option>
																		</select>
																	</div>
																</div>
																<!--Input Usia Pensiun-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia Pensiun<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" name="usiapensiun" id="usiapensiun" placeholder="0" />
																	</div>
																</div>
																<!--Input Usia Produktif-->
																<div class="form-group">
																	<label class="control-label col-md-4">Usia Produktif</label>
																	<div class="col-md-4">
																		<input type="text" class="form-control" name="usiaproduktiftahun" id="usiaproduktiftahun" readonly style="border:0px;" />
																		<input type="hidden" class="form-control" name="usiaproduktif" id="usiaproduktif" readonly style="border:0px;" />
																	</div>
																</div>
																<!--Input Penghasilan Satu Tahun-->
																<div class="form-group">
																	<label class="control-label col-md-4">Penghasilan Satu Tahun<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" name="penghasilansatutahun" id="penghasilansatutahun" placeholder="0" />
																	</div>
																</div>
																<!-- Input Premi Dasar Sekaligus-->
																<div class="form-group">
																	<label class="control-label col-md-4">Total Premi Dibayar<span class="required">*</span></label>
																	<div class="col-md-4">
																		<input type="number" class="form-control" placeholder="0" name="totalpremi" id="totalpremi" />
																	</div>	
																</div>
															</div>

															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!-- Input Premi Dasar Berkala-->
																<div class="form-group">
																	<label class="control-label col-md-4">Premi Dasar Berkala</label>
																	<div class="col-md-4">
																		<input type="text" readonly class="form-control" name="premidasarrp" id="premidasarrp" placeholder="0" />
																		<input type="text" class="form-control" name="premidasar" id="premidasar" style="display:none;" />
																	</div>	
																</div>
																<!-- Input Top Up Berkala-->
																<div class="form-group">
																	<label class="control-label col-md-4">Top Up Berkala</label>
																	<div class="col-md-4">
																		<input type="text" readonly class="form-control" name="topupberkalarp" id="topupberkalarp" placeholder="0" />
																		<input type="text" class="form-control" name="topupberkala" id="topupberkala" style="display:none;" />
																	</div>	
																</div>
																<!-- Input Uang Asuransi -->
																<div class="form-group">
																	<label class="control-label col-md-4"><i><b>Uang Asuransi</b></i></label>
																	<div class="col-md-4">
																		<input type="text" readonly class="form-control" name="uangasuransirp" id="uangasuransirp" placeholder="0" />
																		<input type="text" class="form-control" name="uangasuransi" id="uangasuransi" style="display:none;">
																	</div>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Awal Calon Tertanggung</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikoawalproposalctt" placeholder="0" />
																		<input type="text" name="resikoawalproposalctt" style="display:none;" />
																	</div>
																</div>
																<!--Input Resiko Awal-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Awal Calon Pemegang Polis</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikoawalproposalcpp" placeholder="0" />
																		<input type="text" name="resikoawalproposalcpp" style="display:none;" value="0" />
																	</div>
																</div>
																<!--Input Resiko Finansial-->
																<div class="form-group">
																	<label class="control-label col-md-4"><b><i>Resiko Finansial</b></i><span class="required"></span></label>
																	<div class="col-md-4">
																		<input readonly type="text" class="form-control" id="resikofinansialcttrp" placeholder="0" style="border:0px;" />
																		<input type="text" id="resikofinansialctt" style="display:none;" value="0" />
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--End Input Data Pertanggungan-->
													
													<!--Start Input Data Alokasi Dana-->
													<div class="box-header with-border">
														<h3 class="box-title" style="border-top-style: solid;border-top-color: #3c8dbc;">Alokasi Dana</h3>
													</div>
													<br />
													<div class="box-body">
														<div class="row">
															<!--Kolom Kiri-->
															<div class="col-md-6">
																<!--Input Alokasi Dana 1-->
																<div class="form-group">
																	<label class="control-label col-md-4">Alokasi Dana Investasi<span class="required">*</span></label>
																	<div class="col-md-8">
																		<select class="form-control " name="alokasidana1" id="alokasidana1" >
																			<?php if (!$fund['error']) {
																				foreach($fund['message'] as $i => $v) {
																					$selected = $i == 0 ? 'selected' : '';
																					echo "<option value='$v[KDFUND]' $selected>$v[NAMAFUND]</option>";
																				}
																			} ?>
																		</select>
																		<?php if (!$fund['error']) {
																			foreach($fund['message'] as $i => $v) {
																				if ($i == 0) {
																					echo "<input type='hidden' name='investasirendah1' id='investasirendah1' value='$v[RENDAH]' />";
																					echo "<input type='hidden' name='investasisedang1' id='investasisedang1' value='$v[SEDANG]' />";
																					echo "<input type='hidden' name='investasitinggi1' id='investasitinggi1' value='$v[TINGGI]' />";
																				}
																			}
																		} ?>
																	</div>
																</div>
																<!--Input Alokasi Dana 2-->
																<div class="form-group">
																	<label class="control-label col-md-4"></label>
																	<div class="col-md-8">
																		<select class="form-control " name="alokasidana2" id="alokasidana2" >
																			<?php if (!$fund['error']) {
																				foreach($fund['message'] as $i => $v) {
																					$selected = $i == 1 ? 'selected' : '';
																					echo "<option value='$v[KDFUND]' $selected>$v[NAMAFUND]</option>";
																				}
																			} ?>
																			<?php if (!$fund['error']) {
																			foreach($fund['message'] as $i => $v) {
																				if ($i == 1) {
																					echo "<input type='hidden' name='investasirendah2' id='investasirendah2' value='$v[RENDAH]' />";
																					echo "<input type='hidden' name='investasisedang2' id='investasisedang2' value='$v[SEDANG]' />";
																					echo "<input type='hidden' name='investasitinggi2' id='investasitinggi2' value='$v[TINGGI]' />";
																				}
																			}
																		} ?>
																		</select>
																	</div>
																</div>
															</div>
															<!-- Kolom Kanan -->
															<div class="col-md-6">
																<!--Input Alokasi Dana 1-->
																<div class="form-group">
																	<div class="col-md-4">
																		<input class="form-control" type="text" name="persentasealokasidana1" id="persentasealokasidana1" value="95">
																	</div>
																</div>
																<div class="form-group">
																	<div class="col-md-4">
																		<input class="form-control" type="text" name="persentasealokasidana2" id="persentasealokasidana2" value="5">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--End Input Data Alokasi Dana Investasi-->
													
												</div>
												
												<div class="form-actions fluid">
													<div class="row">
														<div class="col-md-12 text-center">
															<a href="<?=str_replace("/simulasi/", "", base_url())."/prospek/proposal?id=".$this->input->get('noid')?>" class="btn btn-lg green button-kembali" onclick='$.LoadingOverlay("show");'>
																 Halaman Prospek <i class="m-icon-swapleft m-icon-white"></i>
															</a>
															<a href="javascript:;" class="btn btn-lg blue button-next" id="submitProposal" name="submitProposal">
																 Submit Proposal <i class="m-icon-swapright m-icon-white"></i>
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
				<?=C_COPYRIGHT?>
			</div>
			<div class="footer-tools">
				<span class="go-top">
					<i class="fa fa-angle-up"></i>
				</span>
			</div>
		</div>
		<!-- END FOOTER -->
		
	</body>
	<!-- END BODY -->
</html>