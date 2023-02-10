<!-- BEGIN PAGE CONTENT-->
	<div class="row invoice-logo">
		<div class="col-xs-6 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-6" align="justify">
			<h3>
				 Proposal Asuransi JS Prestasi Pendidikan
			</h3>
		</div>
	</div>
	<hr/>
    <h4>Data Pertanggungan</h4>
	<div class="row">
		<div class="col-xs-6" align="justify">
			<ul class="list-unstyled">
				<li>
					 <strong>Nama Calon Tertanggung : </strong><?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					 <strong>Jenis Kelamin : </strong><?= $hasil['jeniskelamincalontertanggung'];?>
				</li>
				<!--li>
					 <strong>Anak Yang Dibeasiswakan : </strong><?= $hasil['namaanak'];?> 
				</li-->
				<li>
					 <strong>Masa Asuransi: </strong><?= $hasil['usiaanak'];?> tahun 
				</li>
				<li>
					<strong>Uang Asuransi : </strong> Rp. <?= number_format($hasil['uangasuransi'], 2, ',', '.');?>
				</li>
			</ul>
		</div>
		<div class="col-xs-6" align="justify">
			
			<ul class="list-unstyled">
				<li>
					 <strong>Usia Calon Tertanggung :</strong> <?= $hasil['usiacalontertanggung'];?> Tahun
				</li>
				
				<!--li>
					 <strong>Usia Anak :</strong> <?= $hasil['usiaanak'];?> tahun
				</li-->
				<!--li>
					 <strong>Jenis Pertanggungan : </strong><?= ($hasil['medical'] == 'N') ? 'Non Medical':'Medical';?> 
				</li-->
				<li>
					<strong>Mulai Asuransi :</strong> <?= $hasil['mulas'];?> 
				</li>
				<li>
					 <strong>Cara Bayar : </strong><?= $hasil['carabayarjsprestasi'];?>
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="portlet box green">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i>Manfaat Asuransi
					</div>
				</div>
				<div class="portlet-body util-btn-margin-bottom-5">
						<p><strong>1. Pembayaran Manfaat Tahapan</strong></p>
							<div class="table-scrollable">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>
												 Keterangan
											</th>
											<th>
												 Tahun
											</th>
											<!--th>
												 Perhitungan
											</th-->
											<th >
												 Manfaat
											</th>
											
										</tr>
									</thead>
<!--
										<tr>
                                        <td>Masuk SD</td>
                                        <?php 
											header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
											header("Cache-Control: post-check=0, pre-check=0", false);
											header("Pragma: no-cache");
											header("Connection: close");
											
											error_reporting(0);
									
										if($hasil['masaasuransi'] < 14)
										{ 
										?>
                                        
											<td>-</td>
											<td>-</td>
											<td>-</td>
                                         <?php
										 }
										 else
										 {
										 ?>
											<td>10% x Rp. <?= number_format(round($hasil['sd']['asuransi']), 2, ',', '.');?><sup>*</sup></td>
											<td>Rp. <?= number_format(round($hasil['sd']['beasiswa']), 2, ',', '.');?></td>
											<td><?= $hasil['sd']['tahun']; ?></td>
                                         <?php 
										 }
										 ?>
										</tr>
-->
										<!--tr>
                                        <td>Tahapan I</td>
                                        <?php if($hasil['usiaanak'] < 8)
										{ 
										?>
                                        
											<td>-</td>
											<td>-</td>
											<td>-</td>
                                         <?php
										 }
										 else
										 {
										 ?>
											<td>20% x UA Awal x (1,05)^n-6<sup>*</sup></td>
											<td >Rp. <?= number_format(round($hasil['smp']['beasiswa']), 2, ',', '.');?></td>
											<td><?= $hasil['smp']['tahun']; ?></td>
                                         <?php 
										 }
										 ?>
										</tr-->
										
										<!--tr>
											<td>Tahapan II</td>
											<td>30% x UA Awal x (1,05)^n-3<sup>*</sup></td>
											<td>Rp. <?= number_format(round($hasil['sma']['beasiswa']), 2, ',', '.');?></td>
											<td><?= $hasil['sma']['tahun']; ?></td>
										</tr>
										<tr>
											<td>Tahapan III</td>
											<td>50% x UA Awal x (1,05)^n<sup>*</sup></td>
											<td>Rp. <?= number_format(round($hasil['kuliah']['beasiswa']), 2, ',', '.');?></td>
											<td><?= $hasil['kuliah']['tahun']; ?></td>
										</tr-->
										
										<tr>
											<td>Tahapan I</td>
											<td><?= $hasil['sma']['tahun']; ?></td>
											<td>Rp. <?= number_format($hasil['uangasuransi']*0.4, 2, ',', '.');?></td>
										</tr>
										<tr>
											<td>Tahapan II</td>
											<td><?= $hasil['kuliah']['tahun']; ?></td>
											<td>Rp. <?= number_format($hasil['uangasuransi']*0.6, 2, ',', '.');?></td>
										</tr>
									<tbody>
										
									</tbody>
								</table>
							</div>
							
							<!--p align="justify"><strong>Keterangan :</strong></p>
							<p align="justify"><strong>* :</strong> Uang asuransi menaik sebesar 5% tiap tahun </p>
							<p align="justify"><strong>n :</strong> Masa pembayaran asuransi maksimal(18 tahun)</p-->
							
							<p align="justify">Pembayaran manfaat Tahapan dibayarkan pada saat Ulang Tahun Polis dan setelah premi LUNAS.</p>
							
							<p><strong>2. Santunan Meninggal Dunia</strong></p>
							<p align="justify">Jika Tertanggung Meninggal Dunia pada masa Asuransi maka kepada Ahli Waris dibayarkan Santunan Meninggal Dunia sebesar 100% Uang Asuransi.</p>
				</div>
				<!--div class="portlet-body util-btn-margin-bottom-5">
						<p align="justify"><strong>Pembayaran Berkala Bulanan selama 5 Tahun</strong></p>
						<p align="justify">2% x Rp. <?= number_format($hasil['beasiswaberkala'] * $hasil['uangasuransi'], 2, ',', '.');?> : <strong>Rp. <?= number_format($hasil['beasiswaberkala'] * $hasil['uangasuransi'] * 0.02, 2, ',', '.');?></strong></p>
						<p align="justify"><strong>Pembayaran Bea Siswa Secara Sekaligus</strong></p>
						<p align="justify">Uang Asuransi : <strong>Rp. <?= number_format($hasil['beasiswaberkala'] * $hasil['uangasuransi'], 2, ',', '.');?></strong></p>
				</div-->
			</div>
			<!--div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-plus-square"></i>Santunan
					</div>
				</div>
				<div align="justify" class="portlet-body util-btn-margin-bottom-5">
						<p align="justify"><strong>Pembayaran santunan jika tertanggung meninggal selama masa asuransi (16 tahun)</strong></p>			
						<p align="justify" style=""><strong>Pembayaran Secara Sekaligus sebesar :</strong> </p>
						<p align="justify">100 % x Uang Asuransi* -> Jika tertanggung meninggal bukan karena kecelakaan</p>
						<p align="justify">200 % x Uang Asuransi* -> Jika tertanggung meninggal karena kecelakaan</p>
						<p align="justify"><strong>Keterangan :</strong></p>
						<p align="justify"><strong>t :</strong> Masa pertanggungan</p>
					<ul>
						<li>Tertanggung dibebaskan dari kewajiban membayar premi apabila tertanggung mengalami Cacat Tetap Total dan Manfaat tahapan yang belum diterima/dibayarkan tetap akan diberikan</li>
						<li>Apabila "Anak yang dibeasiswakan " meninggal dunia, maka kepada ahli waris akan dibebaskan dari kewajiban membayar premi dan seluruh premi standard yang telah dibayar akan dikembalikan</li>
					</ul>
				</div>
			</div-->
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-money"></i>B. Pembayaran Premi
					</div>
				</div>
				<div class="portlet-body util-btn-margin-bottom-5">
						<p>Premi <?= $hasil['carabayarjsprestasi'];?> 5 tahun pertama 			: Rp. <?= number_format($hasil['tabelpremicicil5tahun'], 2, ',', '.');?></p>
						<p>Premi <?= $hasil['carabayarjsprestasi'];?> setelah tahun pertama 	: Rp. <?= number_format($hasil['tabelpremisekaligus'], 2, ',', '.');?></p>
				</div>
				<!--div class="portlet-body util-btn-margin-bottom-5">
						<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											 Cara Bayar
										</th>
										<th>
											 Premi
										</th>
									</tr>
								</thead>
									
								<tbody>
									<tr style="display: none">
										<td>Sekaligus</td>
										<td>Rp. <?= number_format($hasil['tabelpremisekaligus'], 2, ',', '.');?></td>
									</tr>
									<tr>
										<td>Tahunan</td>
										<?php 
											//if($hasil['medical'] == 'N')
											//{
                                        ?>
										<td>Rp. <?= number_format($hasil['tabelpremitahunan'], 2, ',', '.');?> <span class="required">***</span></td>
										<?php
											//}
											//else
											//{
                                        ?>
									</tr>
									<tr>
										
										<?php
                                       		 //}
                                        ?>
									</tr>
									<tr>
										<td>Bulanan</td>
										<td>Rp. <?= number_format($hasil['tabelpremibulanan'], 2, ',', '.');?></td>
									</tr>
                                    <tr>
										<td>Semesteran</td>
										<td>Rp. <?= number_format($hasil['tabelpremisemesteran'], 2, ',', '.');?></td>
									</tr>
                                    <tr>
										<td>Kuartalan</td>
										<td>Rp. <?= number_format($hasil['tabelpremikuartalan'], 2, ',', '.');?></td>
									</tr>
									<tr style="display: none">
										<td>Per 5 Tahun</td>
										<?php 
											//if($hasil['medical'] == 'N')
                                        	//{
                                        ?>
										<td>Rp. <?= number_format($hasil['tabelpremicicil5tahun'], 2, ',', '.');?></td>
										<?php
											//}
											//else
											//{
                                        ?>
                                         
										<?php 
                                       		 //}
                                        ?>
									</tr>
									<tr style="display: none">
										<td>Per 10 Tahun</td>
											
											<td>Rp. <?= number_format($hasil['tabelpremicicil10tahun'], 2, ',', '.');?>
											
									</tr>
									<tr style="display: none">
										<td></td>
											<td>Rp. <?= number_format($hasil['tabelpremicicil10tahuntahun2berikutnya'], 2, ',', '.');?><span class="required">***</span></td>
                                            
									</tr>
								</tbody>
							</table>
						</div>
						<p align="justify"><strong>Keterangan :</strong></p>
							<p align="justify"><strong>* :</strong> Uang asuransi naik 5% setiap tahun selama masa asuransi</p>
							<p align="justify"><strong>** :</strong> 5 tahun pertama</p>
							<p align="justify"><strong>*** :</strong> tahun berikutnya</p>
				</div-->
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="well" align="justify">
				<address>
				Illustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi
				<address>
			</div>
		</div>
	
	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-offset-3 col-md-9">
					<a target="_blank" href="<?= base_url().'files/pdf/'.$hasil['filepdf'].'.pdf'; ?>" class="btn green button-submit">
						 Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
		</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->