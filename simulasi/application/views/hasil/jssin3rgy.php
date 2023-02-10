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
				Ilustrasi ini bukan merupakan kontrak asuransi, namun hanya ilustrasi. Manfaat sebenarnya tercantum dalam polis.
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
				JS SIN3RGY
			</div>
		</div>
     </div>
	<hr/>
    </div>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-size:14px">
                Produk ASURANSI JS SIN3RGY disiapkan untuk anda dengan jaminan yang lengkap dengan hanya membayar satu premi mendapatkan <strong>tiga manfaat pasti</strong> meliputi :
			</div>
				<li>
				1. Santunan proteksi Rawat Inap (*) bagi Tertanggung selama 5 Tahun, karena sakit (**) atau kecelakaan. Maksimal setiap tahun adalah selama 90 hari.
				</li>
                <li>
				2. Santunan proteksi santunan duka sebesar 100% Uang Asuransi selama Masa Asuransi 10 Tahun, apabila Tertanggung meninggal dunia karena sakit (**)
atau kecelakaan.
				</li>
				<li>
				3. Santunan Pembayaran 100% Uang Asuransi apabila Tertanggung hidup sampai dengan akhir kontrak asuransi 10 (sepuluh) tahun.
				</li>
                <div class="well" style="font-size:14px">
                Keunggulan lain dari produk ini pembayaran premi hanya 5 (lima) tahun dengan masa kontrak asuransi 10 (sepuluh) tahun.
                </div>
			</ul>
		</div>
		
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px">
				DATA CALON TERTANGGUNG
			</div>
				<li>
					  Nama : <?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					  Tanggal Lahir/Usia :  <?= $hasil['tanggallahircalontertangggung'];?> / <?= $hasil['usiacalontertanggung'];?> Tahun 
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
                <div class="well" style="font-weight:bold;font-size:14px">
                    DATA PERTANGGUNGAN
                </div>
				<li>
						Paket Benefit : <?= $hasil['paketbenefit'];?>
				</li>
                <li>
						Mulai Asuransi : <?= $hasil['mulaiasuransijssin3rgy'];?>
				</li>
                <li>
						Masa Asuransi : <?= $hasil['masaasuransijssin3rgy'];?> Tahun
				</li>
                <li>
						Cara Bayar Premi : <strong><?= $hasil['carabayarpremi'];?></strong>
				</li>
                <li>
					 	Masa Pembayaran Premi : <?= $hasil['masapembayaranpremi'];?> Tahun
				</li>
                <li>
					 	Premi Pokok :  <strong>Rp. <?= number_format($hasil['premijsremaja'],0,'.',',');?> <?= $hasil['carabayarpremi'];?></strong>
				</li>
                <li>
                		<?php
							if ($hasil['carabayarpremi'] == 'Bulanan')
							{
						?> 
					 		Total Premi :  <strong>Rp. <?= number_format($hasil['tabelriderpremibulanan'],0,'.',',');?> <?= $hasil['carabayarpremi'];?></strong>
						<?php
							}
							else if ($hasil['carabayarpremi'] == 'Tahunan')
							{
						?>			
							Total Premi :  <strong>Rp. <?= number_format($hasil['tabelriderpremitahunan'],0,'.',',');?> <?= $hasil['carabayarpremi'];?></strong>
                        <?php
							}
                        ?>
						
                </li>
               <br>
               <div class="row" align="center">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
            <tr align="center">
				<th>
					 
				</th>
				<th>
					 
				</th>
				<th>
					 SANTUNAN
				</th>
				<th>
					 PREMI
				</th>
			</tr>
			<tr align="center">
				<th>
					 PAKET
				</th>
                <th>
					 UANG ASURANSI
				</th>
                <th>
					 RAWAT INAP DI RS/HARI
				</th>
                <th>
					 RAWAT INAP DI ICU/HARI
				</th>
                 <th>
					 BULANAN
				</th>
                <th>
					 TAHUNAN
				</th>
               
			</tr>
			</thead>
			<tbody>
			  	<tr align="center">	
                    <td><?= $hasil['paketbenefit'];?></td>
                   	<td><?= number_format($hasil['uangasuransi'],0,'.',',');?></td>
                    <td><?= number_format($hasil['ri'],0,'.',',');?></td>
                    <td><?= number_format($hasil['icu'],0,'.',',');?></td>
                    <td><?= number_format($hasil['premibulanan'],0,'.',',');?></td>
                    <td><?= number_format($hasil['premitahunan'],0,'.',',');?></td>
			  	</tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
    
    <br>
        <div class="well" style="font-weight:bold;font-size:14px">
        	A. MANFAAT DASAR:
        </div>
        <li>
            1. Apabila dalam masa pembayaran premi Tertanggung menjalani Rawat Inap (*) di Rumah Sakit, maka akan mendapatkan santunan Rawat Inap (*) perhari sebesar<strong> Rp. <?= number_format($hasil['ri'],0,'.',',');?></strong>. Pembayaran santunan Rawat Inap (*) dalam setahun maksimal 90 hari.
        </li>
        <li>
            2. Apabila dalam masa pembayaran premi Tertanggung menjalani Rawat ICU di Rumah Sakit, maka akan mendapatkan manfaat Rawat ICU perhari sebesar<strong> Rp. <?= number_format($hasil['icu'],0,'.',',');?></strong>, dan dalam satu tahun maksimum Rawat Inap (*) selama 10 hari.
        </li>
        <li>
            3. Apabila Tertanggung Meninggal Dunia dalam masa asuransi karena sebab apapun, maka dibayarkan manfaat asuransi kepada Ahliwaris sebesar <strong> Rp. <?= number_format($hasil['uangasuransi'],0,'.',',');?></strong> dan pertanggungan menjadi berakhir.
        </li>
        <li>
            4. Apabila Tertanggung hidup sampai akhir masa asuransi, maka akan dibayarkan manfaat asuransi sebesar <strong> Rp. <?= number_format($hasil['uangasuransi'],0,'.',',');?></strong>. 
        </li>
    <br>
    	<?php 
			if (($hasil['premihcpjssinergy']!=0)||($hasil['premijsaddbjssinergy']!=0)||($hasil['premitermjssinergy']!=0))
			{
		?>
    	<div class="well" style="font-weight:bold;font-size:14px">
        	B. MANFAAT RIDER:
        </div>
        <li>
        	<?php
            	if ($hasil['premitermjssinergy']!=0)				
				{
			?>
            * Apabila Tertangggung meninggal dunia atau cacat, maka akan dibayarkan (*)<strong> Rp. <?= number_format($hasil['uangasuransi'],0,'.',',');?></strong> untuk cacat sebagian sesuai tabel manfaat.
        	<?php
				}
			?>
        </li>
        <li>
        	<?php
            	if ($hasil['premijsaddbjssinergy']!=0)				
				{
			?>
            * Apabila Tertanggung meninggal dunia baik karena sakit atau kecelakaan, maka akan dibayarkan 100% Uang Asuransi JS ADDB sebesar<strong> Rp. <?= number_format($hasil['uangasuransi'],0,'.',',');?></strong>.
        	<?php
				}
			?>
        </li>
        <li>
        	<?php
            	if ($hasil['premihcpjssinergy']!=0)				
				{
			?>
            * Apabila Tertanggung sakit dan dirawat di rumah Sakit, maka akan dibayarkan tambahan santunan<strong> Rp. <?= number_format($hasil['ririder'],0,'.',',');?>/hari</strong> atau dirawat di ICU dengan santunan<strong> Rp. <?= number_format($hasil['icurider'],0,'.',',');?>/hari</strong>.
       		<?php
				}
			?>
        </li>
        <?php 
			}
		?>
    <div style="font-size:14px" align="justify">
    
    <br>					
	<p>(*) Minimum Rawat Inap adalah 2 x 24 jam.</p>	
    <p>(**) Penyakit-penyakit yang tidak dikecualikan pada Polis.</p>
    
    </div>
                <hr>
                
			</ul>
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