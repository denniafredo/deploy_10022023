<!-- BEGIN PAGE CONTENT-->
	<div class="row invoice-logo">
		<div class="col-xs-6 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-6" align="justify">
			<h3>
				 Proposal JS Gaji Terusan Platinum
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
					 <strong>Usia : <?= $hasil['usiacalontertanggung'];?> Tahun</strong>
				</li>
				<li>
					 <strong>Gaji : </strong> Rp. <?= number_format($hasil['gaji'], 2, ',', '.');?>				  
				</li>
				<li>
<!--					<strong>Premi  : </strong><p style="font-style:italic">Rp. <?= number_format($hasil['premi5tahunpertama'], 2, ',', '.');?> <strong>premi 5 Tahun Pertama </strong></p>-->
                                              <p p style="font-style:italic">Rp. <?= number_format($hasil['premitahunke6danseterusnya'], 2, ',', '.');?> <!--strong>premi tahun ke-6 dan seterusnya </strong--></p>
				</li>
                <li>
					 <strong>Resiko Awal : </strong>Rp. <?= number_format($hasil['jumlahrisikoawaljsgajiterusanplatinum'], 2, ',', '.');?>
				</li>
                <li>
					 <strong>Masa Asuransi : </strong><?= $hasil['masaasuransijsgajiterusan'];?> Tahun
				</li>
                <li>
					 <strong>Cara Bayar Premi : </strong><?= $hasil['carabayarpremijsgajiterusan'];?>
				</li>
                <li>
					 <strong>Mulai Asuransi : </strong><?= $hasil['saatmulaiasuransijsgajiterusan'];?>
				</li>
			</ul>
		</div>
		
	</div>
	<div class="row">
		<div class="col-xs-12">
			
			<div class="portlet box blue">
				<div align="justify" class="portlet-body util-btn-margin-bottom-5">
						<p align="justify"><strong>Manfaat Asuransi</strong></p>			
						<p align="justify"><strong>a. Manfaat Ekspirasi</strong> </p>
						<p align="justify">Apabila Tertanggung hidup sampai akhir Masa Asuransi, maka Jiwasraya akan mengembalikan 100% yang telah dibayarkan, sebesar <span>Rp. <?= number_format(12 * $hasil['premitahunke6danseterusnya'] * $hasil['masaasuransijsgajiterusan'], 2, ',', '.');?></span></p> 
						
						<p align="justify"><strong>b.  Meninggal Dunia Asumsi Meninggal di akhir tahun ke- <?= $hasil['masaasuransijsgajiterusan'];?></strong></p>
						<p align="justify">Apabila Tertanggung meninggal dunia dalam masa asuransi, maka kepada ahliwaris akan dibayarkan: <span></span></p> 
					<ul>
						<li>Pengembalian 100% Premi yang telah dibayarkan <span>Rp. <?= number_format(12 * $hasil['premitahunke6danseterusnya'] * ($hasil['masaasuransijsgajiterusan'] - 3), 2, ',', '.');?></li>
						<li>Pembayaran Gaji Bulanan sebesar <span>Rp. <?= number_format($hasil['gaji'], 2, ',', '.');?> setiap bulan mulai bulan berikutnya setelah Tertanggung meninggal dunia sampai berakhirnya Masa Asuransi.</li>
					</ul>
                    	<p align="justify"><strong>c. Batal Dalam masa Asuransi</strong> </p>
						<p align="justify"> Pemegang Polis dapat melakukan penarikan Nilai Tebus Polis setelah Masa Asuransi berjalan lebih dari 1 Tahun.</p> 
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