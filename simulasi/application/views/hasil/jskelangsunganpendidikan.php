<!-- BEGIN PAGE CONTENT-->
	<div class="row invoice-logo">
		<div class="col-xs-6 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-6" align="justify">
			<h3>
				 Proposal JS Kelangsungan Pendidikan
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
					 <strong>SPP : </strong> <?= number_format($hasil['spp'], 2, ',', '.');?>
				</li>
				<li>
					<strong>Premi Sekaligus : </strong> <?= $hasil['premisekaligusjskelangsunganpendidikan'];?>
				</li>
                <li>
					 <strong>Masa Asuransi : </strong><?= $hasil['masaasuransijskelangsunganpendidikan'];?> Tahun
				</li>
                <li>
					 <strong>Cara Bayar Premi : </strong><?= $hasil['carabayarpremijskelangsunganpendidikan'];?>
				</li>
                <li>
					 <strong>Mulai Asuransi : </strong><?= $hasil['saatmulaiasuransi'];?>
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
						<p align="justify">Apabila Tertanggung hidup sampai akhir Masa Asuransi, maka Jiwasraya akan mengembalikan 100% yang telah dibayarkan. <span><?= $hasil['premisekaligusjskelangsunganpendidikan'];?></span></p> 
						
						<p align="justify"><strong>b. Meninggal Dunia</strong></p>
						<p align="justify">Apabila Tertanggung meninggal dunia dalam masa asuransi, maka kepada ahliwaris akan dibayarkan: <span><?= $hasil[''];?></span></p> 
					<ul>
						<li>Pengembalian 100% Premi yang telah dibayarkan <span><?= $hasil['premisekaligusjskelangsunganpendidikan'];?></li>
						<li>Pembayaran SPP setiap Semester sebesar <span><?= $hasil['spp'];?> sampai dengan berakhirnya Masa Asuransi.</li>
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