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
				JS Dwiguna (Proteksi menuju Keluarga Sejahtera) 
			</div>
		</div>
     </div>
	<hr/>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				<u>I. JAMINAN MANFAAT POKOK</u>
			</div>
					<li>Produk Asuransi JS Dwiguna memberikan manfaat berupa:</li>
					1. Sebesar 100 % x Uang Asuransi apabila Tertanggung masih hidup pada akhir Masa Asuransi, Titik C.									
				<br>
					2.	Sebesar 100 % Uang Asuransi apabila Tertanggung meninggal dunia dalam Masa Asuransi, titik B.		
                <br><br>	
            <div class="col-md-12" align="center">
                <div class="img-wrapper">
                <?php 
                    $image1 = base_url().'assets/img/jsdwiguna.jpg';
                ?>	
                <img src="<?= $image1 ?>" alt="" class="img-responsive">
                </div>	
            </div>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				<u>II. PENETAPAN BESARNYA PREMI POLIS JS DWIGUNA</u>
			</div>
				<li>
					 Nama Pemegang Polis : <?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					  Usia Tertanggung : <?= $hasil['usiacalontertanggung'];?> Tahun 
				</li>
                <li>
					 Masa Asuransi/Masa Kontrak : <?= $hasil['masaasuransi'];?>  Tahun
				</li>
                <li>
					 Jumlah Uang Asuransi Pokok : Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?> 
				</li>
                 <li>
					 Pembayaran Premi Sekaligus : Rp. <?= number_format($hasil['tabelpremisekaligus'],0,'.',',');?> 
				</li>
                <br>
                <li>
					 Premi Tahunan 5 Tahun Pertama : Rp. <?= number_format($hasil['tabelpremitahunan'] * 1.05,0,'.',',');?> 
				</li>
                <li>
					 Premi Tahunan 5 Tahun Berikutnya : Rp. <?= number_format($hasil['tabelpremitahunan'],0,'.',',');?> 
				</li>
                <li>
					 Premi Bulanan : Rp. <?= number_format($hasil['tabelpremibulanan'],0,'.',',');?> 
				</li>
                <li>
					 Premi Kuartalan : Rp. <?= number_format($hasil['tabelpremikuartalan'],0,'.',',');?> 
				</li>
                <li>
					 Premi Semesteran : Rp. <?= number_format($hasil['tabelpremisemesteran'],0,'.',',');?> 
				</li>
                <li>
					 Total Premi Rider : Rp. <?= number_format($hasil['totalpremiriderjsdwigunasum'],0,'.',',');?> 
				</li>
                <li>
					 Total Premi Tahunan : Rp. <?= number_format($hasil['totalpokokpremirider'],0,'.',',');?> 
				</li>
                <li>
					 Uang Asuransi yang diterima setelah selesai kontrak sebesar : <strong>Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?> </strong> 
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <!--div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				2. PENGHITUNGAN MANFAAT
			</div>
            <br>
            <div>
            <strong>Jika Premi dibayar sekaligus</strong>
            </div>
				<li>
					 Jumlah Uang yang akan diterima setelah selesai kontrak : Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?>
				</li>
				<li>
					  Jumlah setoran selama kontrak (n) : Rp. <?= number_format($hasil['tabelpremisekaligus'],0,'.',',');?>
				</li>
                <li>
					  Selisih : <strong style="border:groove">Rp. <?= number_format(($hasil['uangasuransipokok'] - $hasil['tabelpremisekaligus']),0,'.',',');?> </strong>
				</li>
                 <br>
            <div>
            <strong>Jika Premi dibayar tahunan</strong>
            </div>
				<li>
					 Jumlah Uang yang akan diterima setelah selesai kontrak : Rp. <?=  number_format($hasil['uangasuransipokok'],0,'.',',');?>
				</li>
				<li>
					  Jumlah setoran selama kontrak (n) : Rp. <?= number_format(($hasil['masaasuransi']) * ($hasil['tabelpremitahunan']),0,'.',',');?>
				</li>
                <li>
					  Selisih : <strong style="border:groove">Rp. <?= number_format(($hasil['uangasuransipokok']) - (($hasil['masaasuransi']) * ($hasil['tabelpremitahunan'])),0,'.',',');?> </strong>
				</li>
			</ul>
            <hr/>
		</div>
	</div!-->
    
    
    
    
    
    
     
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
<style type=”text/css”>
figure{
  width: 400px;
  height: 300px;
  overflow: hidden;
  position: relative;
  display: inline-block;
  vertical-align: top;
  border: 5px solid #fff;
  box-shadow: 0 0 5px #ddd;
  margin: 1em;
}

figcaption{
  position: absolute;
  left: 0; right: 0;
  top: 0; bottom: 0;
  text-align: center;
  font-weight: bold;
  width: 100%;
  height: 100%;
  display: table;
}

figcaption div{
  display: table-cell;
  vertical-align: middle;
  position: relative;
  top: 20px;
  opacity: 0;
  color: #2c3e50;
  text-transform: uppercase;
}

figcaption div:after{
  position: absolute;
  content: "";
  left: 0; right: 0;
  bottom: 40%;
  text-align: center;
  margin: auto;
  width: 0%;
  height: 2px;
  background: #2c3e50;
}

figure img{
  -webkit-transition: all 0.5s linear;
          transition: all 0.5s linear;
  -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
}

figure:hover figcaption{
 background: rgba(255,255,255,0.3);
}

figcaption:hover div{
  opacity: 1;
  top: 0;
}

figcaption:hover div:after{
  width: 50%;
}

figure:hover img{
  -webkit-transform: scale3d(1.2, 1.2, 1);
          transform: scale3d(1.2, 1.2, 1);
}
</style>