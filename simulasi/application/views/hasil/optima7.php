<?php
/*echo '<pre>';
print_r($data);
echo '</pre>';
 * 
 
echo '<pre>';
print_r($hasil);
echo '</pre>';*/
?>
<!-- BEGIN PAGE CONTENT-->
<div class="">
	<div class="row invoice-logo">
		<div class="col-xs-6 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-6" align="justify">
			<h3>
				Proposal JS Optima Assurance
			</h3>
		</div>
	</div>
	<hr/>
    <h4>Data Pertanggungan</h4>
	<div class="row">
		<div class="col-xs-6" align="justify">
			
			<ul class="list-unstyled">
				<li>
					 <strong> Nama : </strong><?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					 <strong> Usia : </strong><?= $hasil['usiaawal'];?> tahun 
				</li>
				<li>
					<strong> Uang Asuransi : </strong> Rp. <?= number_format($hasil['uangasuransi'], 2, ',', '.');?>
				</li>
				<li>
					 <strong> Premi Sekaligus : </strong> Rp. <?= number_format($hasil['premisekaligus'], 2, ',', '.');?> 
				</li>
			</ul>
		</div>
		<div class="col-xs-6" align="justify">

			<ul class="list-unstyled">
				<li>
					 <strong>Masa Asuransi :</strong> <?= $hasil['masaasuransi'];?> tahun
				</li>
				<li>
					 <strong>Tanggal Mulai Asuransi:</strong> <?= $hasil['mulas'];?>
				</li>
				<li>
					<strong>Bunga JS Optima Assurance :</strong> 7% Per Tahun (Nett) - Compound Majemuk
				</li>
				<li>
					<strong>Bunga Deposito Bank :</strong> <?= $hasil['bunganett']; ?>% Per Tahun (Nett)
				</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>
					 Akhir Tahun Ke-
				</th>
				<th>
					 Usia
				</th>
				<th>
					 Manfaat Meninggal Dunia
				</th>
				<th>
					 Nilai Tunai
				</th>
				<th>
					 Deposito Bank Nett (Pokok + Bunga)
				</th>
			</tr>
			</thead>
			<tbody>
		  	<?php for($i=0;$i<=$hasil['masaasuransi'];$i++){?>
			  	<tr>
					<td><?= $hasil['nilai'][$i]['tahun']; ?></td>
					<td><?= $hasil['nilai'][$i]['usia']; ?></td>
					<td><strong>Rp. <?= number_format($hasil['nilai'][$i]['manfaat'], 0, ',', '.');?></strong></td>
					<td><strong>Rp. <?= number_format($hasil['nilai'][$i]['nilaitunai'], 0, ',', '.');?></strong></td>					
					<?php 
						if ($i>0)
						{
					?>
					<td>Rp. <?= number_format($hasil['nilai'][$i]['totaldeposito'], 0, ',', '.');?></td>
                    <?php 
						}
						else
						{
					?>
                    <td>Rp. <?= number_format('0', 0, ',', '.');?></td>
                    <?php 
						}
					?>
			  	</tr>
			<?php }?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="well" align="justify">
				<address>
				Illustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi
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
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->