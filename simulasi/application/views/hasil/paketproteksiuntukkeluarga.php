<!-- BEGIN PAGE CONTENT-->
	<div class="row invoice-logo">
		<div class="col-xs-6 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-6" align="justify">
			<h3>
				 Proposal Paket Proteksi Untuk Keluarga
			</h3>
		</div>
	</div>
	<hr/>
    <h4>Data Pertanggungan</h4>
	<div class="row">
		<div class="col-xs-6" align="justify">
			<ul class="list-unstyled">
				<strong>Disajikan untuk Bapak/Ibu : </strong><?= $hasil['namajsgajiterusanplatinum'];?>
                
                <br><br>
                <div class="table-responsive">
                  <table class="table">
                      <thead>
                        <tr>
                          <th></th>
                          <th>RINCIAN PREMI</th>
                          <th>PRODUK</th>
                          <th>PREMI</th>
                          <th>UANG ASURANSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"></th>
                          <td style="font-weight:bold">Tertanggung Ayah</td>
                          <td>JS GTP</td>
                          <td>Rp. <?= number_format($hasil['premijsgajiterusanplatinum'], 2, ',', '.');?></td>
                          <td>Rp. <?= number_format($hasil['gajijsgajiterusanplatinum'], 2, ',', '.');?></td>
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td style="font-weight:bold">Tertanggung Ibu</td>
                          <td>JS SIHARTA</td>
                          <td>Rp. <?= number_format($hasil['premibulananjssiharta'], 2, ',', '.');?></td>
                          <td>Rp. <?= number_format($hasil['premibulananjssiharta'] * 25, 2, ',', '.');?></td>
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td style="font-weight:bold">Tertanggung Anak Ke-1</td>
                          <td>JS PRESTASI</td>
                          <td>Rp. <?= number_format($hasil['premianakke1jsprestasi'], 2, ',', '.');?></td>
                          <td>Rp. <?= number_format($hasil['jumlahuangasuransianakke1jssiharta'], 2, ',', '.');?></td>
                        </tr>
                        <tr>
                          <th scope="row"></th>
                          <td style="font-weight:bold">Tertanggung Anak Ke-2</td>
                          <td>JS PRESTASI</td>
                          <td>Rp. <?= number_format($hasil['premianakke2jsprestasi'], 2, ',', '.');?></td>
                          <td>Rp. <?= number_format($hasil['jumlahuangasuransianakke2jssiharta'], 2, ',', '.');?></td>
                        </tr>
                        <tr>
                          <th ></th>
                          <td></td>
                          <td style="font-weight:bold">TOTAL</td>
                          <td>Rp. <?= number_format($hasil['totalpremikeluarga'], 2, ',', '.');?></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
			</ul>
		</div>
		
	</div>
	<div class="row">
		<div class="col-xs-12">
			
			<div class="portlet box blue">
				<div align="justify" class="portlet-body util-btn-margin-bottom-5">
						<p align="justify"><strong>Manfaat Produk</strong></p>			
						<p align="justify"><strong>A. JS Gaji Terusan Platinum</strong> </p>
						<p align="justify">Produk Asuransi Jiwa yang memberikan jaminan keuangan keluarga apabila Ayah sebagai pencari nafkah mengalami risiko meninggal dunia diusia aktif bekerja.</p> 
								
						<p align="justify"><strong>B. JS Gaji Terusan Platinum</strong> </p>
						<p align="justify">Produk Asuransi Jiwa yang memberikan perlindungan keuangan keluarga, apabila terjadi risiko meninggal dunia karena sakit atau kecelakaan terhadap Ibu selama masa asuransi.</p>
                        
                        <p align="justify"><strong>C. JS Prestasi</strong> </p>
						<p align="justify">Produk Asuransi Pendidikan yang menjamin biaya pendidikan putera-puteri Tertanggung mulai dari SD sampai Perguruan Tinggi, walaupun terjadi risiko meninggal dunia atau cacat tetap total karena sakit atau kecelakaan terhadap Tertanggung.</p> 
                        
                        <p align="justify"><strong>D. JS Prestasi</strong> </p>
						<p align="justify">Produk Asuransi Pendidikan yang menjamin biaya pendidikan putera-puteri Tertanggung mulai dari SD sampai Perguruan Tinggi, walaupun terjadi risiko meninggal dunia atau cacat tetap total karena sakit atau kecelakaan terhadap Tertanggung.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="well" align="justify">
				<address>
				Saya mengerti bahwa Ilustrasi ini bukan merupakan kontrak asuransi, namun hanya ilustrasi. Manfaat sebenarnya tercantum dalam Polis
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