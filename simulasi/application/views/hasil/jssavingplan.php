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
				JS Saving Plan
			</div>
		</div>
     </div>
	<hr/>
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				PEMEGANG POLIS/TERTANGGUNG
			</div>
				<li>
					 Nama : <?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					 Tanggal Lahir : <?= $hasil['tanggallahircalontertangggung'];?> 
				</li>
				<li>
					 Usia : <?= $hasil['usiacalontertanggung'];?> Tahun 
				</li   
			</ul>
            <hr/>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
			<div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				PERTANGGUNGAN
			</div>
				<li>
					 Premi Sekaligus : Rp. <?= number_format($hasil['premisekaligus'],0,'.',',');?> 
				</li>
				<li>
					 Saat Mulai : <?= $hasil['saatmulaiasuransi'];?>
				</li>
				<li>
					 Masa Asuransi : <?= $hasil['masaasuransi'];?>  Tahun
				</li>
			</ul>
			<hr/>
		</div>
	</div>
   
	<div class="row">
		<div class="col-md-12">

			<div class="table-scrollable">
				<table class="table table-striped table-hover">
					<thead>
						<div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
							BUNGA INVESTASI PRODUK JS SAVING PLAN
						</div>
					</thead>

					<tbody>
						<tr>
							<td>Tahun Ke-:</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
						</tr>
						<tr>
							<td>Bunga Investasi:</td>
							<td>5.00%</td>
							<td>4.50%</td>
							<td>4.50%</td>
							<td>4.50%</td>
							<td>4.50%</td>
						</tr>
					</tbody>
				</table>
				<p>*) Bunga Investasi tahun ke-2 dst merupakan asumsi.</p>

				<br>
				<br>

				<table class="table table-striped table-hover">
					<thead>
						<div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
							PENGEMBANGAN DANA PRODUK JS SAVING PLAN
						</div>
					</thead>
					<thead>
						<tr>
							<th>
								Akhir Tahun ke-
							</th>
							<th >
								 Nilai Tunai
							</th>
							<th >
								 Manfaat Meninggal Dunia
							</th>
							<th >
								Total Manfaat 
							</th>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>1</td>
							<td><?= number_format($hasil['nilaitunai1'],0,'.',',');?> </td>
							<td><?= number_format($hasil['manfaatmeninggaldunia1'],0,'.',',');?> </td>
							<td><?= number_format($hasil['totalmanfaat1'],0,'.',',');?> </td>
						</tr>
						<tr>
							<td>2</td>
							<td><?= number_format($hasil['nilaitunai2'],0,'.',',');?> </td>
							<td><?= number_format($hasil['manfaatmeninggaldunia2'],0,'.',',');?> </td>
							<td><?= number_format($hasil['totalmanfaat2'],0,'.',',');?> </td>
						</tr>
						<tr>
							<td>3</td>
							<td><?= number_format($hasil['nilaitunai3'],0,'.',',');?> </td>
							<td><?= number_format($hasil['manfaatmeninggaldunia3'],0,'.',',');?> </td>
							<td><?= number_format($hasil['totalmanfaat3'],0,'.',',');?> </td>
						</tr>
						<tr>
							<td>4</td>
							<td><?= number_format($hasil['nilaitunai4'],0,'.',',');?> </td>
							<td><?= number_format($hasil['manfaatmeninggaldunia4'],0,'.',',');?> </td>
							<td><?= number_format($hasil['totalmanfaat4'],0,'.',',');?> </td>
						</tr>
						<tr>
							<td>5</td>
							<td><?= number_format($hasil['nilaitunai5'],0,'.',',');?> </td>
							<td><?= number_format($hasil['manfaatmeninggaldunia5'],0,'.',',');?> </td>
							<td><?= number_format($hasil['totalmanfaat5'],0,'.',',');?> </td>
						</tr>
					</tbody>
				</table>
				<p>Risiko Awal adalah sebesar Akumulasi Uang Pertanggungan dari seluruh Polis yang dimiliki Tertanggung.</p>

			</div>
		</div>

	</div>
    
    <br>

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