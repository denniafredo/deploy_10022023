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
			<div class="well" style="font-weight:bold;font-size:16px" align="center">
				<?= $hasil['jenisproduk'];?>
			</div>
		</div>
     </div>
	<hr/>
	<div class="row">
		<div class="col-xs-6">
			<ul class="list-unstyled">
				<li>
					 <strong> Nama Calon : </strong><?= $hasil['namacalontertanggung'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir / Usia Calon : </strong> <?= $hasil['tanggallahircalontertangggung'];?> / <?= $hasil['usiacalontertanggung'];?> tahun 
				</li>
                <li>
					<strong> Top Up Berkala : </strong> Rp. <?= number_format($hasil['topupberkala'], 2, ',', '.');?>
				</li>
                <li>
					<strong> Top Up Sekaligus : </strong> Rp. <?= number_format($hasil['topupsekaligus'], 2, ',', '.');?> selama <?= $hasil['masatopupsekaligus'];?> tahun
				</li>
                <li>
					 <strong>Masa Pemb Premi :</strong> <?= $hasil['masapemb'];?> tahun
				</li>
                <li>
					 <strong>Tgl dibuat :</strong> <?= $hasil['saatmulai'];?> 
				</li>
                <li>
					 <strong>Jenis Produk :</strong> <?= $hasil['jenisproduk'];?> 
				</li>
                <li>
					 <strong>Cara Bayar Berkala :</strong> <?= $hasil['carabayar'];?> 
				</li>
                <li>
					 <strong> Nilai Aktiva Bersih (NAB) Awal : </strong> <?= number_format($hasil['asumsinilainab'], 2, ',', '.');?>
				</li>
			</ul>
		</div>
		<div class="col-xs-6">
        <h4>&nbsp;</h4>
        
		<div class="row">
        <div class="col-xs-12">
			<div class="well">
        Asumsi tingkat hasil investasi yang digunakan adalah sebagai berikut
            </div>
         </div>
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>
					 Dana Investasi
				</th>
				<th>
					 Rendah
				</th>
				<th>
					 Sedang
				</th>
				<th>
					 Tinggi
				</th>
			</tr>
			</thead>
			<tbody>		  	
			  	<tr>
					<td></strong><?= $hasil['jenisproduk'];?></td>
					<td><?= $hasil['asumsi_inv_min'];?>%</td>
					<td><?= $hasil['asumsi_inv_med'];?>%</td>
					<td><?= $hasil['asumsi_inv_max'];?>%</td>
			  	</tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
		</div>
	</div>
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>
					 Manfaat Asuransi
				</th>
				<th align="center">
					 Jangka Waktu (sampai dengan)
				</th>
				<th align="center">
					 Uang Asuransi
				</th>
                <?php if ($hasil['carabayar'] != "Single")
				{ 
				?> 
				<th align="center">
					 Biaya Asuransi
				</th>
                <?php 
				}
				?>
			</tr>
			</thead>
			<tbody>
            	<?php if ($hasil['carabayar'] == "Single")
				{ 
				?> 
            	<tr>
					<td>JS TL1</td>
					<td align="center">Usia Tertanggung 65 tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juatl1'], 2, ',', '.');?></td>
					<td align="center">Rp.</td>
			  	</tr>
                <tr>
					<td>JS TL2</td>
					<td align="center">Usia Tertanggung 65 tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juatl2'], 2, ',', '.');?></td>
					<td align="center">Rp.</td>
			  	</tr>
                <?php 
				}
				else
				{
				?>
			  	<tr>
					<td>Produk Pokok TL (1+2)</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juatl1tl2'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premisesuaicarabayar'], 2, ',', '.');?></td>
			  	</tr>
                <tr>
					<td>Term</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juaterm'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahanterm'], 2, ',', '.');?> **)</td>
			  	</tr>
                <tr>
					<td>Personal Accident</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juapa'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahanpa'], 2, ',', '.');?> **)</td>
			  	</tr>
                <tr>
					<td>Critical Ilness</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juaci'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahanci'], 2, ',', '.');?> **)</td>
			  	</tr>
                <tr>
					<td>Total Permanent Disability</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juactt'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahanctt'], 2, ',', '.');?> **)</td>
			  	</tr>
                <tr>
					<td>Waiver Premium</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juawp'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahanwp'], 2, ',', '.');?> **)</td>
			  	</tr>
                <tr>
					<td>Cash Plan</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juacpm'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahancpm'], 2, ',', '.');?> **)</td>
			  	</tr>
                <tr>
					<td>Cash Plan Bedah</td>
					<td align="center">Usia Tertanggung <?= $hasil['usiacalontertanggung'] + $hasil['masapemb']?> tahun</td>
					<td align="center">Rp. <?= number_format($hasil['juacpb'], 2, ',', '.');?></td>
					<td align="center">Rp. <?= number_format($hasil['premitambahancpb'], 2, ',', '.');?> **)</td>
			  	</tr>
                <?php 
				}
				?>
			</tbody>
			</table>
			</div>
		</div>
   
        <div class="col-xs-12">
			<div class="well">
                **) Adalah Premi <?= strtolower($hasil['carabayar']);?> tahun pertama, dimana besar premi tahun berikutnya akan menyesuaikan kenaikan usia tertanggung.
			</div>
       </div>
	</div>
       		
                &nbsp;
    <div class="row">
            <div class="col-xs-12">
                <div class="well">
				<div style="font-weight:bold; font-size:16px" align="center">ILUSTRASI PLAN POKOK DAN PERKEMBANGAN DANA<br><?= $hasil['jenisproduk'];?></br></div>
                <br>
                <div style="font-weight:bold; font-size:14px">Jumlah Premi <?= $hasil['carabayar'];?> : Rp. <?= number_format($hasil['totalpremisesuaicarabayar'], 2, ',', '.');?></div>
				</div>
    		</div>
	</div>
            
                <div class="row" align="center">
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
					 Premi (Ribuan)
				</th>
				<th>
					 Top-Up (Ribuan)
				</th>
				<th>
					 Dana Pendidikan (Ribuan)
				</th>
                <th>
					
				</th>
                <th>
					 Manfaat Meninggal Dunia *)
				</th>
                <th>
					 
				</th>
                <th>
					 
				</th>
                <th>
					 (NAB x Jumlah Unit)
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
					
				</th>
                <th>
					 Rendah (Ribuan)
				</th>
                <th>
					 Sedang (Ribuan)
				</th>
                <th>
					 Tinggi (Ribuan)
				</th>
                <th>
					 Rendah (Ribuan)
				</th>
                <th>
					 Sedang (Ribuan)
				</th>
                <th>
					 Tinggi (Ribuan)
				</th>
			</tr>
			</thead>
			<tbody>
            	<?php for($i=1;$i<= 20;$i++){
				?>
			  	<tr>	
                    <td><?php echo $i; ?></td>
                    <td><?= $hasil['nilai'][$i]['usia']; ?></td>	
                    <td><?=  number_format($hasil['nilai'][$i]['premiribuandisplay'], 0, ',', '.'); ?></td>
                    <td><?= number_format($hasil['nilai'][$i]['topupribuandisplay'], 0, ',', '.'); ?></td>
                    <td><?= $hasil['nilai'][$i]['']; ?></td>			
                    <td><?= number_format(($hasil['nilai'][$i]['nabxjumlahunitrendah'] / 1000 + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
                    <td><?= number_format(($hasil['nilai'][$i]['nabxjumlahunitsedang'] / 1000 + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
                    <td><?= number_format(($hasil['nilai'][$i]['nabxjumlahunittinggi'] / 1000 + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
                    <td><?= number_format($hasil['nilai'][$i]['nabxjumlahunitrendah'] / 1000, 0, ',', '.');?></td>
                    <td><?= number_format($hasil['nilai'][$i]['nabxjumlahunitsedang'] / 1000, 0, ',', '.');?></td>
                    <td><?= number_format($hasil['nilai'][$i]['nabxjumlahunittinggi'] / 1000, 0, ',', '.');?></td>
			  	</tr>
			<?php 
			}
			?>
			</tbody>
            <tbody style="font-weight:bold">
            	<?php for($i=35;$i<= 35;$i++){
				?>
			  	<tr>	
                    <td><?php echo $i; ?></td>
                    <td><?= $hasil['nilai'][$i]['usia']; ?></td>	
                    <td><?=  number_format($hasil['nilai'][$i]['premiribuandisplay'], 0, ',', '.'); ?></td>
                    <td><?= number_format($hasil['nilai'][$i]['topupribuandisplay'], 0, ',', '.'); ?></td>
                    <td><?= $hasil['nilai'][$i]['']; ?></td>			
                    <td><?= number_format(((($hasil['nilai'][20]['nabxjumlahunitrendah'] / 1000) * pow((1+$hasil['asumsi_inv_min'] / 100), 15)) + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
                    <td><?= number_format(((($hasil['nilai'][20]['nabxjumlahunitsedang'] / 1000) * pow((1+$hasil['asumsi_inv_med'] / 100), 15)) + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
                    <td><?= number_format(((($hasil['nilai'][20]['nabxjumlahunittinggi'] / 1000) * pow((1+$hasil['asumsi_inv_max'] / 100), 15)) + $hasil['juatl1tl2'] / 1000), 0, ',', '.');?></td>
                    <td><?= number_format(((($hasil['nilai'][20]['nabxjumlahunitrendah'] / 1000) * pow((1+$hasil['asumsi_inv_min'] / 100), 15))), 0, ',', '.');?></td>
                    <td><?= number_format(((($hasil['nilai'][20]['nabxjumlahunitsedang'] / 1000) * pow((1+$hasil['asumsi_inv_med'] / 100), 15))), 0, ',', '.');?></td>
                    <td><?= number_format(((($hasil['nilai'][20]['nabxjumlahunittinggi'] / 1000) * pow((1+$hasil['asumsi_inv_max'] / 100), 15))), 0, ',', '.');?></td>
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