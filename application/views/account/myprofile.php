<link href="<?=base_url()?>asset/plugin/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/profile.css" rel="stylesheet" type="text/css"/>

<div class="container">
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Modal title</h4>
				</div>
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
	
	<!-- BEGIN PAGE BREADCRUMB -->
	<ul class="page-breadcrumb breadcrumb">
		<li>
			<a href="<?=base_url()?>">Beranda</a><i class="fa fa-circle"></i>
		</li>
		<li>
			<a href="<?=base_url('account/myprofile')?>">Profil Saya</a>
			<i class="fa fa-circle"></i>
		</li>
		<li class="active">
			 Biodata
		</li>
	</ul>
	
	<!-- Tambahan untuk memunculkan jumlah polis yang jatuh tempo pembayaran per bulan yang berjalan - Teguh (21/11/2019) -->
	
		<div class="row">
	        <div class="col-md-12">
	        	<div class="box box-default">
	        		<div class="box-body">
	        			<div class="alert alert-dismissible">
	        				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        				<div class="col-md-12 dashboard-stat dashboard-stat-light red-intense">
	        					<div class="visual">
	        						<i class="fa fa-warning"></i>
	        					</div>
	        					<div class="details">
	        						<div class="number">
	        							<?php 
	        								foreach ($jmljatuhtempo as $i => $j) {
	        									echo $j['JML']." POLIS";
	        								}
	        							?>
	        							
	        						</div>
	        						<div class="desc">
	        							Total Polis Jatuh Tempo Pembayaran Bulan Ini.
	        						</div>
	        					</div>
	        				</div>
	              		</div>
	            	</div>
	          	</div>
	        </div>
    	</div>
	<!-- End tambahan - Teguh (21/11/2019) -->

	<?php if (!empty($agenkickof['USERNAME'])) { ?>
	    	
	<?php } ?>

	<!-- END PAGE BREADCRUMB -->
	<!-- BEGIN PAGE CONTENT INNER -->
	<div class="row margin-top-10">
		<div class="col-md-12">
			<!-- BEGIN PROFILE SIDEBAR -->
			<div class="profile-sidebar" style="width: 250px;">
				<!-- PORTLET MAIN -->
				<div class="portlet light profile-sidebar-portlet">
					<!--div class="blog-img blog-tag-data">
                                            <img src="<?=base_url()?>/asset/img/kickoff-youre-invited.jpg" alt="" class="img-responsive">
                                            <ul class="list-inline"></ul>
                                            <ul class="list-inline blog-tags">
                                                <li>
                                                    <i class="fa fa-tags"></i>
                                                    <a href="<?=base_url("asset/img/kickoff-youre-invited.jpg")?>" target="_blank">Undangan Kick Off </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <br><br-->
					
					<!-- SIDEBAR USERPIC -->
					<div class="profile-userpic">
						<img src="<?=base_url('asset/avatar/'.$this->session->AVATAR)?>" class="img-responsive" alt="">
					</div>
					<!-- END SIDEBAR USERPIC -->
					<!-- SIDEBAR USER TITLE -->
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							 <?=ucwords(strtolower($this->session->NAMALENGKAP))?>
						</div>
						<div class="profile-usertitle-job">
							 <?=$user['NAMAJABATANAGEN']?>
						</div>
					</div>
					<!-- END SIDEBAR USER TITLE -->
					<!-- SIDEBAR BUTTONS -->
					<!--div class="profile-userbuttons">
						<button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
						<button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
					</div-->
					<!-- END SIDEBAR BUTTONS -->
					<!-- SIDEBAR MENU -->
					<div class="profile-usermenu">
						<ul class="nav">
							<!--li>
								<a href="extra_profile.html">
								<i class="icon-home"></i>
								Ikhtisar </a>
							</li-->
							<li class="active">
								<a href="<?=base_url('account/myprofile')?>">
								<i class="icon-user"></i>
								Biodata </a>
							</li>
							<li>
								<a href="<?=base_url('account/ubah-password')?>">
								<i class="fa fa-key"></i>
								Ubah Sandi </a>
							</li>
							<!--li>
								<a href="extra_profile_help.html">
								<i class="icon-info"></i>
								Help </a>
							</li-->
						</ul>
					</div>
					<!-- END MENU -->
				</div>
				<!-- END PORTLET MAIN -->
				<!-- PORTLET MAIN -->
				<!--div class="portlet light">
					<!-- STAT -->
					<!--div class="row list-separated profile-stat">
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="uppercase profile-stat-title">
								 37
							</div>
							<div class="uppercase profile-stat-text">
								 Projects
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="uppercase profile-stat-title">
								 51
							</div>
							<div class="uppercase profile-stat-text">
								 Tasks
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="uppercase profile-stat-title">
								 61
							</div>
							<div class="uppercase profile-stat-text">
								 Uploads
							</div>
						</div>
					</div>
					<!-- END STAT -->
					<!--div>
						<h4 class="profile-desc-title">About Marcus Doe</h4>
						<span class="profile-desc-text"> Lorem ipsum dolor sit amet diam nonummy nibh dolore. </span>
						<div class="margin-top-20 profile-desc-link">
							<i class="fa fa-globe"></i>
							<a href="http://www.keenthemes.com">www.keenthemes.com</a>
						</div>
						<div class="margin-top-20 profile-desc-link">
							<i class="fa fa-twitter"></i>
							<a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
						</div>
						<div class="margin-top-20 profile-desc-link">
							<i class="fa fa-facebook"></i>
							<a href="http://www.facebook.com/keenthemes/">keenthemes</a>
						</div>
					</div>
				</div>
				<!-- END PORTLET MAIN -->
			</div>
			<!-- END BEGIN PROFILE SIDEBAR -->
			
			<!-- BEGIN PROFILE CONTENT -->
			<div class="profile-content">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light">
							<div class="portlet-title tabbable-line">
								<div class="caption caption-md">
									<i class="icon-globe theme-font hide"></i>
									<span class="caption-subject font-blue-madison bold uppercase">Biodata</span>
								</div>
								<ul class="nav nav-tabs">
									<li class="active">
										<a href="#tab_1_1" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Identitas"><i class="fa fa-info"></i></a>
									</li>
									<li>
										<a href="#tab_1_2" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Riwayat Keluarga"><i class="fa fa-users"></i></a>
									</li>
									<li>
										<a href="#tab_1_3" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Pendidikan Formal"><i class="fa fa-graduation-cap"></i></a>
									</li>
									<li>
										<a href="#tab_1_4" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Pendidikan Intern"><i class="fa fa-pencil-square"></i></a>
									</li>
									<li>
										<a href="#tab_1_5" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Pendidikan Extern"><i class="fa fa-edit"></i></a>
									</li>
									<li>
										<a href="#tab_1_6" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Pengalaman Kerja"><i class="fa fa-briefcase"></i></a>
									</li>
									<li>
										<a href="#tab_1_7" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Prestasi"><i class="fa fa-trophy"></i></a>
									</li>
									<li>
										<a href="#tab_1_8" data-toggle="tab" class="tooltips" data-placement="bottom" data-original-title="Riwayat Jabatan"><i class="fa fa-sitemap"></i></a>
									</li>
								</ul>
							</div>
							<div class="portlet-body">
								<div class="tab-content">
									<!-- IDENTITAS TAB -->
									<div class="tab-pane active" id="tab_1_1">
										<form role="form" action="#">
											<div class="form-group">
												<label class="control-label">No Agen</label>
												<input type="text" class="form-control" value="<?=$user['NOAGEN']?>" readonly/>
											</div>
											<div class="form-group">
												<label class="control-label">Nama Lengkap</label>
												<input type="text" class="form-control" value="<?=ucwords(strtolower($user['NAMAKLIEN1']))?>" readonly/>
											</div>
											<div class="form-group">
												<label class="control-label">Jabatan</label>
												<input type="text" class="form-control" value="<?=ucwords(strtolower($user['NAMAJABATANAGEN']))?>" readonly/>
											</div>
											<div class="form-group">
												<label class="control-label">Status</label>
												<input type="text" class="form-control" value="<?=ucwords(strtolower($user['NAMASTATUSAGEN']))?>" readonly/>
											</div>
											<div class="form-group">
												<label class="control-label">Tempat Lahir</label>
												<input type="text" class="form-control" value="<?=ucwords(strtolower($user['TEMPATLAHIR']))?>" readonly/>
											</div>
											<div class="form-group">
												<label class="control-label">No Lisensi</label>
												<input type="text" class="form-control" value="<?=$user['NOLISENSIAGEN']?>" readonly/>
											</div>
											<div class="form-group">
												<label class="control-label">Periode Lisensi</label>
												<input type="text" class="form-control" value="<?=$user['TGLMULAILISENSI']?> s/d <?=$user['TGLAKHIRLISENSI']?>" readonly/>
											</div>
										</form>
									</div>
									<!-- END IDENTITAS TAB -->
									
									<!-- RIWAYAT KELUARGA TAB --> 
									<div class="tab-pane" id="tab_1_2">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
											<thead>
											<tr>
												<th>#</th>
												<th>Nama</th>
												<th>Hubungan</th>
												<th>Tempat Lahir</th>
												<th>Tanggal Lahir</th>
											</tr>
											</thead>
											<tbody>
												<?php foreach ($keluarga as $i => $r) {
													echo "<tr>
														<td><span class='label label-sm label-success'>Approved</span></td>
														<td>".ucwords(strtolower($r['NAMA']))."</td>
														<td>".ucwords(strtolower($r['HUBUNGAN']))."</td>
														<td>".ucwords(strtolower($r['TEMPAT_LAHIR']))."</td>
														<td>".ucwords(strtolower($r['TGLLAHIR']))."</td>
													</tr>";
												} ?>
											</tbody>
											</table>
										</div>
									</div>
									<!-- END RIWAYAT KELUARGA TAB -->
									
									<!-- PENDIDIKAN FORMAT TAB -->
									<div class="tab-pane" id="tab_1_3">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
											<thead>
											<tr>
												<th>#</th>
												<th>Tanggal</th>
												<th>Jenis Pendidikan</th>
												<th>Keterangan</th>
											</tr>
											</thead>
											<tbody>
												<?php foreach ($formal as $i => $r) {
													echo "<tr>
														<td><span class='label label-sm label-success'>Approved</span></td>
														<td>".$r['TGLMULAI']."</td>
														<td>".ucwords(strtolower($r['NAMAJENISPENDIDIKAN']))."</td>
														<td>".ucwords(strtolower($r['KETERANGAN']))."</td>
													</tr>";
												} ?>
											</tbody>
											</table>
										</div>
									</div>
									<!-- END PENDIDIKAN FORMAL TAB -->
									
									<!-- PENDIDIKAN INTERN TAB -->
									<div class="tab-pane" id="tab_1_4">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
												<thead>
												<tr>
													<th>#</th>
													<th>Jenis</th>
													<th>Tempat</th>
													<th>Tanggal Mulai</th>
													<th>Tanggal Selesai</th>
													<th>Hasil</th>
												</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<!-- PENDIDIKAN INTERN TAB -->
									
									<!-- PENDIDIKAN EXTERN TAB -->
									<div class="tab-pane" id="tab_1_5">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
												<thead>
												<tr>
													<th>#</th>
													<th>Tanggal</th>
													<th>Jenis Pendidikan</th>
													<th>Keterangan</th>
												</tr>
												</thead>
												<tbody>
													<?php foreach ($extern as $i => $r) {
														echo "<tr>
															<td><span class='label label-sm label-success'>Approved</span></td>
															<td>".$r['TGLMULAI']."</td>
															<td>".ucwords(strtolower($r['NAMAJENISPENDIDIKAN']))."</td>
															<td>".ucwords(strtolower($r['KETERANGAN']))."</td>
														</tr>";
													} ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- PENDIDIKAN EXTERN TAB -->
									
									<!-- PENGALAMAN KERJA TAB -->
									<div class="tab-pane" id="tab_1_6">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
												<thead>
												<tr>
													<th>#</th>
													<th>Tanggal</th>
													<th>Perusahaan</th>
													<th>Keterangan</th>
												</tr>
												</thead>
												<tbody>
													<?php foreach ($pengalaman as $i => $r) {
														echo "<tr>
															<td><span class='label label-sm label-success'>Approved</span></td>
															<td>".$r['TGLMULAI']."</td>
															<td>".ucwords(strtolower($r['PERUSAHAAN']))."</td>
															<td>".ucwords(strtolower($r['KETERANGAN']))."</td>
														</tr>";
													} ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- PENGALAMAN KERJA TAB -->
									
									<!-- PRESTASI TAB -->
									<div class="tab-pane" id="tab_1_7">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
												<thead>
												<tr>
													<th>#</th>
													<th>Tanggal</th>
													<th>Uraian</th>
													<th>Keterangan</th>
												</tr>
												</thead>
												<tbody>
													<?php foreach ($prestasi as $i => $r) {
														echo "<tr>
															<td><span class='label label-sm label-success'>Approved</span></td>
															<td>".$r['TGLJASA']."</td>
															<td>".ucwords(strtolower($r['URAIAN']))."</td>
															<td>".ucwords(strtolower($r['KETERANGAN']))."</td>
														</tr>";
													} ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- PRESTASI TAB -->
									
									<!-- RIWAYAT JABATAN TAB -->
									<div class="tab-pane" id="tab_1_8">
										<div class="table-scrollable">
											<table class="table table-condensed table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Tanggal</th>
														<th>Jabatan</th>
														<th>Kelas</th>
														<th>Uraian</th>
														<th>Keterangan</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($riwayat as $i => $r) {
														echo "<tr>
															<td><span class='label label-sm label-success'>Approved</span></td>
															<td>".$r['TGLJABATAN']."</td>
															<td>".ucwords(strtolower($r['NAMAJABATANAGEN']))."</td>
															<td>".$r['NAMAKELASAGEN']."</td>
															<td>".$r['URAIAN']."</td>
															<td>".$r['KETERANGAN']."</td>
														</tr>";
													} ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- RIWAYAT JABATAN TAB -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END PROFILE CONTENT -->
		</div>
	</div>
	<!-- END PAGE CONTENT INNER -->
</div>
