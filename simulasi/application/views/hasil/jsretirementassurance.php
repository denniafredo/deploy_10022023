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
				JS Retirement Assurance
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
					 <strong> Cara Bayar	: </strong><?= $hasil['carabayar'];?>
				</li>
                <li>
					 <strong> Besar Premi	: </strong><?= number_format($hasil['besarpremi'],0,'.',',');?>
				</li>
                <li>
					 <strong> Uang Asuransi : </strong><?= number_format($hasil['uangasuransi'],0,'.',',');?>
				</li>
                <li>
					 <strong> Saat Mulai Asuransi	: </strong><?= $hasil['saatmulaiasuransi'];?>
				</li>
                
               <br>
               <div class="row" align="center">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
            <tr>
				<th>
					 Akhir Tahun
				</th>
				<th>
					 Akumulasi Premi
				</th>
				<th>
					 Nilai Tunai Akhir Tahun
				</th>
				<th>
					 Uang Asuransi
				</th>
                <th>
					
				</th>
                <th>
					 Total dari Manfaat Meninggal Dunia * 
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
					 
				</th>
				<th>
					
				</th>
				<th>
					Bukan Karena Kecelakaan
				</th>
                <th>
					 
				</th>
                <th>
					 Karena Kecelakaan
				</th>
               
			</tr>
			</thead>
			<tbody>
            	<?php foreach($jsretirementassurance as $i => $v){?>
			  	<tr>	
                    <td><?=($i+1); ?></td>
                    <?php	if ($hasil['carabayar'] == "Sekaligus")
					{
					?>
					<td><?= number_format($hasil['akumulasipremi'],0,'.',',')?></td>	
					<?php 
					}
					else if ($hasil['carabayar'] != "Sekaligus")
					{
					?>
                    <td><?= number_format(($i+1) * $hasil['akumulasipremi'],0,'.',',')?></td>
                    <?php 
					} 
					?>
                    <td><?= number_format(($v['NILAITUNAIAKHIRTAHUN'] * $pengali),0,'.',',')?></td>
                    <td><?= number_format(($v['JUAMENINGGALBIASA'] * $pengali),0,'.',',')  ?></td>
                   
                    <td><?= number_format(($v['NILAITUNAIAKHIRTAHUN'] * $pengali) + ($v['JUAMENINGGALBIASA'] * $pengali),0,'.',',')  ?></td>
                    <td align="center">|</td>
                    <td><?= number_format(($v['JUAMENINGGALBIASA'] * $pengali) + ($v['NILAITUNAIAKHIRTAHUN'] * $pengali) + ($v['JUAMENINGGALBIASA'] * $pengali),0,'.',',')  ?></td>
			  	</tr>
			<?php }?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
    
    <br>
    <div style="font-size:14px">
    * : Adalah total manfaat yang diberikan yang  sudah memasukan manfaat  nilai tunai.
    </div>
    <br>
    <div style="font-size:14px">
    <div style="font-weight:bold">Tambahan Manfaat Yang disediakan:	</div>					
		a)	100% Uang Asuransi apabila Tertanggung mengalami Cacat Tetap Total karena Kecelakaan.<br>
		b)	Apabila Tertanggung mengalami Cacat Tetap Sebagian karena Kecelakaan akan dibayarkan sebesar persentase tertentu dari Uang Asuransi.<br>
		c)	Manfaat Rawat Inap karena Kecelakaan akan dibayarkan sebesar maksimal 10% dari Uang Asuransi.
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