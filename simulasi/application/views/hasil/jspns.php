<?php
/*echo '<pre>';
print_r($data);
echo '</pre>';
 * 
 
echo '<pre>';
print_r($hasil);
echo '</pre>';*/

error_reporting(0);
?>
<!-- BEGIN PAGE CONTENT-->
<div class="">
	<div class="row" align="center">
		<div class="col-xs-12">
			<div class="well">
				<address>
				Illustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi
				<address>
			</div>
		</div>
     </div>
	<div class="row invoice-logo">
    <div class="col-xs-5">
			<p>
				 <h4>PT. ASURANSI JIWASRAYA (PERSERO)</h4>
			</p>
            <p>
				Jl. Ir. H. Juanda No. 34 Jakarta - 10120
			</p>
		</div>
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
    &nbsp;
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px">
				JS PENSIUN NYAMAN SEJAHTERA
			</div>
		</div>
     </div>
	<hr/>

	<div class="row" align="justify">
		<div class="col-xs-12">
			<div class="well">
			PT. Asuransi Jiwasraya (Persero) mempersembahkan Produk Asuransi Jiwa yang dirancang khusus untuk Pemegang Polis yang ingin mempersiapkan dana untuk masa pensiun. Produk ini memberikan manfaat setiap bulan baik kepada Tertanggung maupun kepada ahliwaris yang sah.
			</div>
		</div>
	</div>
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div style="border: 1px solid #444; padding: 1px; margin-left: 1px; margin-right: 1px" class="row">
			<h3 class="block" align="center">PERHITUNGAN MANFAAT PRODUK</h3>
			</div>
			<br>
				<li>
					<strong>Nama Calon Peserta : <?= $hasil['namalengkapcalontertanggung'];?></strong>
				</li>
				<li>
					<strong>Tanggal Lahir : <?= $hasil['tanggallahircalontertangggung'];?></strong>
				</li>
				<li>
					<strong>Cara Bayar : <?= $hasil['labelcarabayarjspns'];?></strong>
				</li>
				<li>
					<strong>Usia Peserta : <?= $hasil['usiacalonpemegangpolis'];?> Tahun</strong>
				</li>
				<li>
					<strong>Masa Asuransi : <?= $hasil['masapembayaranpremijspns']+10;?> Tahun</strong>
				</li>
				<li>
					<strong>Premi : Rp. <?= number_format($hasil['premijspns'],0,'.',',');?> </strong> 
				</li>
				<li>
					 <strong>Manfaat Pensiun Setiap Bulan : Rp. <?= number_format($hasil['pensiunperbulanjspns'],0,'.',',');?></strong>
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well">
				<strong><u>MANFAAT YANG DIPEROLEH :</u></strong>
			</div>
            <br>
            <div align="justify">
           	1. Apabila Tertanggung hidup sampai akhir pembayaran premi, maka akan dibayarkan manfaat berkala bulanan Pensiun Hari Tua (PHT) sebesar 100 % (seratus persen) Uang Asuransi selama hidup Tertanggung dalam jangka waktu 10 tahun <strong>Rp. <?= number_format($hasil['pensiunperbulanjspns'],0,'.',',');?></strong>.
            </div>
            <div align="justify">
           	2. Apabila Tertanggung Meninggal Dunia setelah masa pembayaran Premi, maka dibayarkan Manfaat Pensiun Janda/Duda kepada Janda/Duda setiap bulan sebesar 60% (enam puluh persen) Uang Asuransi sampai akhir masa pembayaran Pensiun Hari Tua <strong> <?php 
			if ($hasil['statusjspns'] == 'Kawin')	
			{
				echo 'Rp. ';
				echo number_format($hasil['pensiunperbulanjspns']*(60/100),0,'.',',');
			}
			else
			{
				echo 'Tidak ada Manfaat PJD';	
			}
			?></strong>.
            </div>
            <div align="justify">
           	3. Apabila Tertanggung Meninggal Dunia setelah masa pembayaran Premi, maka akan dibayarkan Santunan Duka sebesar 6 (enam) kali Pensiun Hari Tua kepada Penerima Manfaat asuransi <strong>Rp. <?= number_format($hasil['pensiunperbulanjspns']*6,0,'.',',');?></strong>. 
            </div>
            <div align="justify">
           	4. Apabila Tertanggung meninggal dunia pada masa pembayaran premi, maka ahli waris akan menerima mana yang lebih besar antara pembayaran pengembalian premi sebesar 100% (seratus persen) akumulasi premi yang telah dibayarkan dengan Nilai Tebus. 
            </div>
            <div align="justify">
           	5. Setelah Masa Asuransi berakhir tidak ada pembayaran manfaat apapun. 
            </div>
            <div align="justify">
           	6. Saat mulai dan berakhirnya pembayaran serta besarnya Manfaat Asuransi adalah sebagaimana yang tercantum dalam Polis. 
            </div>
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
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->