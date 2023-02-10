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
    <div class="col-xs-6">
			<p>
				 <h3>PT. ASURANSI JIWASRAYA (PERSERO)</h3>
			</p>
            <p>
				Jl. Ir. H. Juanda No. 34 Jakarta - 10120
			</p>
		</div>
		<div class="col-xs-6 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
    &nbsp;
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px">
				ILUSTRASI MANFAAT PROGRAM ANUITAS PERTANGGUNGAN PERORANGAN
			</div>
		</div>
     </div>
	<hr/>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px">
				CALON PEMEGANG POLIS
			</div>
				<li>
					 <strong> Nama Pemegang Polis : </strong><?= $hasil['nama'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir : </strong> <?= $hasil['tgl_lahir'];?> / <?= $hasil['usianasabah'];?> Tahun 
				</li>
                <li>
					 <strong>Jenis Kelamin :</strong> <?= $hasil['jenis_kel'];?> 
				</li>
			</ul>
		</div>
		
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px">
				CALON TERTANGGUNG
			</div>
				<li>
					 <strong> Nama Tertanggung : </strong><?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir : </strong> <?= $hasil['tanggallahircalontertangggung'];?> / <?= $hasil['usiacalontertanggung'];?> Tahun  
				</li>
                <li>
					 <strong>Jenis Kelamin :</strong> <?= $hasil['jeniskelamincalontertanggung'];?> 
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
                <li>
					 <strong> Mulai program Anuitas	: </strong><?= $hasil['saatmulaiasuransi'];?>
				</li>
                 <li>
					 <strong> Premi Sekaligus : </strong> Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?>
				</li>
               <br>
               <div class="row" align="center">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
            <tr>
				<th>
					 NO
				</th>
				<th>
					 LUAS JAMINAN MANFAAT ANUITAS
				</th>
                <th>
					
				</th>
                <th>
					 JENIS DAN MANFAAT ANUITAS						

				</th>
                
                <th>
					 
				</th>
               
               
			</tr>
			<tr>
				<th>
					
				</th>
				<th>
					
				</th>
				<th>
					SEJAHTERA PRIMA	
				</th>
                <th>
					SEJAHTERA IDEAL 
				</th>
                <th>
					IDEAL (SESUAI UU)	
				</th>
               
			</tr>
			</thead>
			<tbody>
			  	<tr>	
                    <td>1.</td>
                    
					<td><strong>ANUITAS BULANAN SELAMA HIDUP UNTUK  :</strong></td>	
                    <td></td>
                
                    <td></td>
                    <td></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li>PESERTA</li></td>	
                    <td>Rp. <?= number_format($hasil['pesertasejahteraprima'],0,'.',',')?></td>
                
                    <td>Rp. <?=number_format($hasil['pesertasejahteraideal'],0,'.',',')?></td>
                     <td>Rp. <?= number_format($hasil['pesertaideal'],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li>JANDA / DUDA</li></td>	
                    <td>Rp. <?= number_format($hasil['jandadudaanaksejahteraprima'],0,'.',',')?></td>
                
                    <td>Rp. <?= number_format($hasil['jandadudaanaksejahteraideal'],0,'.',',')?></td>
                     <td>Rp. <?= number_format($hasil['jandadudaanakideal'],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li>ANAK-ANAK</li></td>	
                    <td>Rp. <?= number_format($hasil['jandadudaanaksejahteraprima'],0,'.',',')?></td>
                     <td>Rp. <?= number_format($hasil['jandadudaanaksejahteraideal'],0,'.',',')?></td>
                     <td>Rp. <?= number_format($hasil['jandadudaanakideal'],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td>(s/d Usia 25 Tahun /Bekerja/Menikah)</td>	
                    <td></td>
                
                    <td></td>
                    <td></td>
			  	</tr>
                <tr>	
                    <td>2.</td>
                    
					<td><strong>SANTUNAN DUKA UNTUK  :</strong></td>	
                    <td></td>
                
                    <td></td>
                    <td></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li> JANDA / DUDA  ( 12 X PENSIUN PESERTA)</li></td>	
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li>ANAK-ANAK    ( 12 X PENSIUN JANDA/DUDA)</li></td>	
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li> ISTRI / SUAMI PESERTA MENDAHULUI PESERTA</li></td>	
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td>3.</td>
                    
					<td><strong> PENGEMBALIAN PREMI SEKALIGUS :</strong></td>	
                    <td></td>
                
                    <td></td>
                    <td></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li>Peserta Hidup pada Usia 65 Tahun atau</li></td>	
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                	<td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li>Peserta Meninggal Dunia sebelum atau sesudah Usia 65 Tahun</li></td>	
                    <td>Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td>4.</td>
                    
					<td><strong> PENGEMBALIAN PREMI SEKALIGUS :</strong></td>	
                    <td></td>
                
                    <td></td>
                    <td></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li> Dikurangi manfaat Pensiun  Peserta  yang  telah  diterima  pada  saat Peserta Meninggal Dunia, ( Contoh : tahun Ke-5  )</li></td>	
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil['uangasuransipokok'] - ($hasil['pesertasejahteraideal'] * 60),0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td><li> Dikurangi Manfaat Pensiun Peserta dan Manfaat Janda/Duda serta Anak-Anak yang telah diterima, apabila seluruh ahli waris gugur,  ( Contoh : tahun Ke-3  )
</li></td>	
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td>Rp. <?= number_format($hasil[''],0,'.',',')?></td>
                    <td></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td> ~ Yang telah diterima oleh PESERTA (Lama Pem.Pensiun 3Th)
</td>	
                    <td></td>
                
                    <td></td>
                    <td>Rp. <?= number_format($hasil['pesertaideal'] * 36,0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td> ~ Yang telah diterima oleh JANDA/DUDA (Lama Pem.3 Th)
</td>	
                    <td></td>
                
                    <td></td>
                    <td>Rp. <?= number_format($hasil['jandadudaanakideal'] * 36,0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td> ~ Yang telah diterima oleh YATIM-PIATU (Lama Pem. 3Th)
</td>	
                    <td></td>
                
                    <td></td>
                    <td>Rp. <?= number_format($hasil['jandadudaanakideal'] * 36,0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td> Total Pembayaran

</td>	
                    <td></td>
                
                    <td></td>
                    <td>Rp. <?= number_format(($hasil['pesertaideal'] * 36) + ($hasil['jandadudaanakideal'] * 36 * 2),0,'.',',')?></td>
			  	</tr>
                <tr>	
                    <td></td>
                    
					<td> Jumlah Yang Dikembalikan

</td>	
                    <td></td>
                
                    <td></td>
                    <td>Rp. <?= number_format($hasil['uangasuransipokok'] - (($hasil['pesertaideal'] * 36) + ($hasil['jandadudaanakideal'] * 36 * 2)),0,'.',',')?></td>
			  	</tr>
			</tbody>
			</table>
			</div>
		</div>
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