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
				ASURANSI JIWA PERORANGAN
			</div>
		</div>
     </div>
	<hr/>
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
				<div class="well" style="font-weight:bold;font-size:14px;">
					DATA PERTANGGUNGAN
				</div>
				<li>
				 	Tertanggung : <?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
				 	Uang Asuransi : Rp. <?= number_format($hasil['uangasuransiaskred'],0,'.',',');?> 
				</li>
				<li>
				 	Mulai Asuransi : <?= $hasil['mulaiasuransi'];?>   
				</li>
				<li>
				 	Premi: Rp. <?= number_format($hasil['premiaskred'],0,'.',',');?> 
				</li>
				<li>
				 	Masa Asuransi : <?= $hasil['masaasuransiaskred'];?> Tahun
				</li>

			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div>
            <strong>Manfaat Asuransi</strong>
            </div>
				<li>
					 Apabila terjadi risiko meninggal dunia terhadap Tertanggung, maka akan dibayarkan 100% Uang Asuransi  Jiwa yang menurun linear setiap bulan. Contoh Tertanggung meninggal dunia di bulan ke-10, maka besarnya Uang Asuransi yang dibayarkan untuk melunasi kredit adalah Rp. <?=number_format(((10/100)*$hasil['juamenurunlinearaskred']),0,'.',',');?>.
				</li>
			</ul>
            <hr/>
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