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
		<div class="col-xs-5 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-7">
			<p align="center">
				 PT. ASURANSI JIWASRAYA (PERSERO)
			</p>
		</div>
	</div>
    &nbsp;
    <p align="center">
        ILUSTRASI PRODUK
    </p>
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px; border:solid; color: #FFFFFF ; background-color: #595959" align="center">
				<?= $hasil['jenisproduk'];?> 
			</div>
		</div>
     </div>
	<hr/>
	<div class="row">
		<div class="col-xs-6">
			<ul class="list-unstyled">
				<div>
					<strong> Nama Calon : </strong><?= $hasil['namalengkapcalontertanggung'];?>
				</div>
				<div>
					<strong> Usia : </strong> <?= $hasil['usiacalontertanggung'];?> <strong> Tahun</strong>
				</div>
				<div>
					<strong> Masa Pembayaran Premi : </strong> <?= $hasil['masaasuransi'];?> <strong> Tahun</strong>
				</div>
                <div>
					<strong> Premi Berkala : </strong> Rp. <?= number_format($hasil['uangasuransipokok'], 2, ',', '.');?> <strong> <?= $hasil['carabayarjsdwigunamenaik'];?></strong>
				</div>
                <div>
					<strong> Top Up : </strong> Rp. <?= number_format($hasil['topup'], 2, ',', '.');?> <strong> <?= $hasil['carabayartopup'];?></strong>
				</div>
                <div>
					 <strong> Uang Asuransi TL1 : </strong> Rp. <?= number_format($hasil['uatl1'], 2, ',', '.');?> 
				</div>
                <div>
					 <strong> Uang Asuransi TL2 : </strong> Rp. <?= number_format($hasil['uatl2'], 2, ',', '.');?> 
				</div>
			</ul>
		</div>
		<div class="col-xs-6">
			<div class="table-responsive">
				<table class="table table-striped table-hover" align="center">
					<thead align="center">
						<tr align="center">
							<th align="center">

							</th>
							<th align="center">
								 Asumsi tingkat hasil investasi
							</th>
							<th align="center">

							</th>
						</tr>
						<tr align="center">
							<th align="center">
								Rendah
							</th>
							<th align="center">
								Sedang
							</th>
							<th align="center">
								Tinggi
							</th>
						</tr>
					</thead>
					<tbody align="left">
						<tr align="left">	
							<td align="left"><?= $hasil['asumsi_min_investasi'];?> %</td>	
							<td align="left"><?= $hasil['asumsi_med_investasi'];?> %</td>	
							<td align="left"><?= $hasil['asumsi_max_investasi'];?> %</td>			
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
   <div class="row">
   <div class="col-xs-6">
			<strong><u>Premi Rider</u></strong>
			<ul class="list-unstyled">
				<li>
					Term Insurance : <strong style="border:solid"> Rp. <?= number_format($hasil['premitermjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					Personal Accident : <strong style="border:solid"> Rp. <?= number_format($hasil['premijsaddbjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					Total Permanent Disability : <strong style="border:solid"> Rp. <?= number_format($hasil['premijstpdjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					Critical Illness : <strong style="border:solid"> Rp. <?= number_format($hasil['premici53jsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					Waiver Premium : <strong style="border:solid"> Rp. <?= number_format($hasil['premiwpjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					Cash Plan : <strong style="border:solid"> Rp. <?= number_format($hasil['totalpremiriderjsdwigunamenaik1'], 2, ',', '.');?> </strong>
				</li>
				<div>
					Total Premi (Unit Link + Rider) : <strong style="border:solid"> Rp. <?= number_format($hasil['tabeltotalpremi'], 2, ',', '.');?> </strong>
				</div>
			</ul>
		</div>
		<div class="col-xs-6">
			<strong><u>Uang Pertanggungan Rider</u></strong>
			<ul class="list-unstyled">
				<li>
					<strong style="border:solid"> Rp. <?= number_format($hasil['uangasuransitermjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					<strong style="border:solid"> Rp. <?= number_format($hasil['uangasuransijsaddbjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					<strong style="border:solid"> Rp. <?= number_format($hasil['uangasuransijstpdjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					<strong style="border:solid"> Rp. <?= number_format($hasil['uangasuransici53jsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<li>
					<strong style="border:solid"> Rp. <?= number_format($hasil['uangasuransiwpjsdwigunamenaik'], 2, ',', '.');?> </strong>
				</li>
				<div>
				
				</div>
				<div>
				
				</div>
			</ul>
		</div>
   </div>
	<div class="row">
		<div class="col-xs-12">
			<strong><u>Manfaat Asuransi</u></strong>
			<ul class="list-unstyled">
				<div>
					<strong>1. Jaminan Meninggal Dunia </strong>
					<div align="justify">Jika tertanggung meninggal dunia dalam masa Asuransi, maka akan dibayarkan Uang Asuransi (TL1) Ditambah Nilai Akumulasi Dana (Jumlah Unit yg dimiliki x NAB) ditambah Uang Asuransi (TL2) ditambah Uang Asuransi Rider kematian yang dimiliki.</div>
				</div>
				<div>
					<strong>2. Expirasi </strong>
					<div align="justify">Jika Tertanggung hidup sampai dengan akhir masa asuransi, maka kepada Pemegang Polis akan dibayarkan sebesar Nilai Akumulasi (Jumlah Unit yang dimiliki X NAB).</div>
				</div>
			</ul>
		</div>
	</div>
    &nbsp;
    <div class="row">
		<div class="col-xs-12">
			<div class="well">
				<div style="font-weight:bold; font-size:16px" align="center">TABEL PERKEMBANGAN DANA INVESTASI (ilustrasi)</div>
			</div>
		</div>
	</div>
    &nbsp;
            
	<div class="row" align="center">
		<div class="col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-hover" align="center">
				<thead align="center">
				<tr align="center">
					<th align="center">
						 Akhir th
					</th>
					<th align="center">
						 Usia
					</th>
					<th align="center"> 
						 Premi 
					</th>
					<th align="center">
						 Top Up 
					</th>
					<th align="center">

					</th>
					<th align="center">
						 Santunan Kematian*
					</th>
					<th align="center">

					</th>
					<th align="center">

					</th>
					<th align="center">
						 Dana Investasi (Unit x NAB)
					</th>
					<th align="center">

					</th>
				</tr>
				<tr align="center">
					<th align="center">
						ke-
					</th>
					<th align="center">

					</th>
					<th align="center">

					</th>
					<th align="center">

					</th>
					<th align="center">
						 rendah 
					</th>
					<th align="center">
						 sedang 
					</th>
					<th align="center">
						 tinggi 
					</th>
					<th align="center">
						 rendah 
					</th>
					<th align="center">
						 sedang 
					</th>
					<th align="center">
						 tinggi 
					</th>
				</tr>
				</thead>
				<tbody align="left">
				<?php for($i=1;$i<= 20;$i++){
				?>
					<tr align="left">
						<?php
							if ($i <= $hasil['masaasuransi'])
							{
						?>
								<td><?php echo $i; ?></td>	
								<td><?= number_format($hasil['nilai'][$i]['usia'], 0, ',', '.'); ?></td>
								<td><?= number_format($hasil['nilai'][$i]['uangasuransipokokhasil'], 0, ',', '.'); ?></td>
								<td><?= number_format($hasil['nilai'][$i]['topuphasil'], 0, ',', '.'); ?></td>	
								<td><?= $hasil['nilai'][$i]['nabxjumlahunitrendah'];?></td>
								<td><?= $hasil['nilai'][$i]['nabxjumlahunitsedang'];?></td>	
								<td><?= $hasil['nilai'][$i]['nabxjumlahunittinggi'];?></td>	
											
<!--
							    <td><?= number_format(($hasil['nilai'][$i]['nabxjumlahunitrendah']), 0, ',', '.');?></td>
								<td><?= number_format(($hasil['nilai'][$i]['nabxjumlahunitsedang'] / 1000 + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
								<td><?= number_format(($hasil['nilai'][$i]['nabxjumlahunittinggi'] / 1000 + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
-->
						<?php
							}
							
						?>
								
					</tr>
				<?php 
				}
				?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
    
    &nbsp;
    
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px">
				HO - HEAD OFFICE JL. IR. H. JUANDA 34 JAKARTA PUSAT Telp. 021-3845031 Fax. 021-3808001
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