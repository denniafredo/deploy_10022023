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
				JS Catur Karsa (Program Beasiswa 5 tahun)
			</div>
		</div>
     </div>
	<hr/>
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            	<strong>
				<li>
					 Nama : <?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					  Usia Tertanggung : <?= $hasil['usiacalontertanggung'];?> Tahun 
				</li>
                <li>
					 Nama Anak Tertanggung : <?= $hasil['namaanaktertanggung'];?>
				</li>
				<li>
					  Umur Anak Tertanggung : <?= $hasil['umuranak'];?> Tahun 
				</li>
                <li>
					 Masa Pembayaran Premi : <?= $hasil['masaasuransi'];?>  Tahun
				</li>
                <li>
					 Bea Siswa setiap Bulan : Rp. <?= number_format($hasil['tabelbeasiswayangditerima'],0,'.',',');?> 
				</li>
                <li>
					 Uang Asuransi : Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?> 
				</li>
                 <li>
					 Saat Mulai Asuransi : <?= $hasil['saatmulaiasuransi'];?>
				</li>
               	</strong>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#000000">
				Manfaat Asuransi:
			</div>
            <br>
            <div>
            <strong>1. Pembayaran Sekaligus Sebesar</strong>
            </div>
            <div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
			<tr>
				
				<th>
					 
				</th>
			</tr>
			</thead>
			<tbody>
            	<tr>
					<td align="center" style="font-weight:bold; font-size:14px">Manfaat Asuransi</td>
					<td align="center" style="font-weight:bold; font-size:14px">Diterima pada tanggal</td>
                    <td align="center" style="font-weight:bold; font-size:14px">Tahapan Usia Anak</td>
			  	</tr>
                <tr>
					<td align="center"> Rp. <?= number_format(0.1 * $hasil['uangasuransipokok'],0,'.',',');?> </td>
					<td align="center"> <?=$hasil['saatanakberusia6th'];?></td>
                    <td align="center"> (saat anak berusia 6th)</td>
			  	</tr>
                <tr>
					<td align="center"> Rp. <?= number_format(0.2 * $hasil['uangasuransipokok'],0,'.',',');?> </td>
					<td align="center"> <?=$hasil['saatanakberusia12th'];?></td>
                    <td align="center"> (saat anak berusia 12th)</td>
			  	</tr>
                <tr>
					<td align="center"> Rp. <?= number_format(0.3 * $hasil['uangasuransipokok'],0,'.',',');?> </td>
					<td align="center"> <?=$hasil['saatanakberusia15th'];?></td>
                    <td align="center"> (saat anak berusia 15th)</td>
			  	</tr>
                <tr>
					<td align="center"> Rp. <?= number_format(0.5 * $hasil['uangasuransipokok'],0,'.',',');?> </td>
					<td align="center"> <?=$hasil['saatanakberusia18th'];?></td>
                    <td align="center"> (saat anak berusia 18th)</td>
			  	</tr>
			</tbody>
			</table>
            </div>
                 <br>
            <div>
            <strong>2. Pembayaran Berkala Sebesar</strong>
            </div>
				<li>
					 <strong>Rp. <?=  number_format($hasil['tabelbeasiswayangditerima'],0,'.',',');?></strong> setiap bulan <strong><?=$hasil['saatpembayaranberkala'];?></strong> selama 5 tahun.
				</li>
                <br>
            <div>
            <strong>3. Pembayaran Sekaligus Sebesar</strong>
            </div>
				<li>
					 <strong>Rp. <?=  number_format($hasil['uangasuransipokok'],0,'.',',');?></strong> kepada ahli waris jika tertanggung meninggal dunia sebelum akhir pembayaran premi tanggal <strong><?=$hasil['saatanakberusia18th'];?></strong>.
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#000000">
				Perhitungan Premi
			</div>
            <br>
            <div>
            </div>
				<li>
					 <strong>Premi Sekaligus : Rp. <?=  number_format($hasil['tabelpremisekaligus'],0,'.',',');?></strong>
				</li>
                <li>
					 <strong>Premi Tahunan : Rp. <?=  number_format($hasil['tabelpremitahunan'],0,'.',',');?></strong>
				</li>
                <li>
					 Premi Semesteran : Rp. <?=  number_format($hasil['tabelpremisemesteran'],0,'.',',');?>
				</li>
                <li>
					 Premi Kwartalan : Rp. <?=  number_format($hasil['tabelpremikwartalan'],0,'.',',');?>
				</li>
                <li>
					 Premi Bulanan : Rp. <?=  number_format($hasil['tabelpremibulanan'],0,'.',',');?>
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