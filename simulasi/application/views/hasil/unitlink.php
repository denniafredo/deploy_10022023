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
				JS Dwiguna Menaik
			</div>
		</div>
     </div>
	<hr/>
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				A. DATA
			</div>
				<li>
					 Nama Calon Tertanggung : <?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					  Usia Calon : <?= $hasil['usiacalontertanggung'];?> Tahun 
				</li>
                <li>
					 Masa Asuransi : <?= $hasil['masaasuransi'];?>  Tahun
				</li>
                <li>
					 Uang Asuransi : Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?> 
				</li>
                 <li>
					 Saat Mulai : <?= $hasil['saatmulaiasuransi'];?>
				</li>
               
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				B. BENEFIT
			</div>
            <br>
            <div>
            <strong>1. KENAIKAN UANG ASURANSI SECARA PASTI</strong>
            </div>
				<li>
					 Pembayaran Uang Asuransi sekaligus dilakukan pada tanggal <?= $hasil['saatpembayaranmanfaat'];?> sebesar Rp. <?= number_format(((1+(10*$hasil['masaasuransi'])/100)*$hasil['uangasuransipokok']),0,'.',',');?> , jika Tertanggung masih hidup.
				</li>
                 <br>
            <div>
            <strong>2. PROTEKSI KESEJAHTERAAN KELUARGA MENINGKAT</strong>
            </div>
				<li>
					 Apabila Tertanggung Meninggal Dunia sebelum tanggal <?= $hasil['saatpembayaranmanfaat'];?> dibayarkan Rp. <?=  number_format($hasil['uangasuransipokok'],0,'.',',');?> ditambah kenaikan 10% Uang Asuransi setiap tahun, atau sebesar Rp. <?=  number_format(((10/100)*$hasil['uangasuransipokok']),0,'.',',');?> dikalikan Usia Pertanggungan.
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				C. PERHITUNGAN PREMI
			</div>
            <br>
            <div>
            </div>
				<li>
					 1. Sebesar --> Rp. <?=  number_format($hasil['tabelpremi5tahunpertama'],0,'.',',');?> [Premi Tahunan untuk 5/lima tahun pertama].
				</li>
                <li>
					 2. Sebesar --> Rp. <?=  number_format($hasil['tabelpremi5tahunberikutnya'],0,'.',',');?> [Premi Semesteran].
				</li>
                <li>
					 3. Sebesar --> Rp.<?=  number_format($hasil['tabelpremisekaligus'],0,'.',',');?> [Apabila Premi dibayar SEKALIGUS].
				</li>
                <br>
                <br>	
                <div class="col-md-12" align="left">
                    <div class="img-wrapper">
						<?php 
                        $image1 = base_url().'assets/img/jsdwigunamenaik.jpg';
                        ?>	
                        <img src="<?= $image1 ?>" alt="" class="img-responsive">	
                    </div>
                </div>	
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