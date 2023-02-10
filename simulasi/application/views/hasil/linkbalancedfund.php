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
		<div class="col-xs-6 invoice-logo-space">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
		<div class="col-xs-6">
			<p>
				 PT. ASURANSI JIWASRAYA (PERSERO)
			</p>
            <p>
				ILUSTRASI PRODUK
			</p>
		</div>
	</div>
    &nbsp;
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px">
				JS LINK BALANCED FUND
			</div>
		</div>
     </div>
	<hr/>
	<div class="row">
		<div class="col-xs-6">
			<ul class="list-unstyled">
				<li>
					 <strong> Nama Calon : </strong><?= $hasil['nama'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir / Usia Calon : </strong> <?= $hasil['tanggallahir'];?> / <?= $hasil['usia'];?> tahun 
				</li>
                <li>
					<strong> Top Up Berkala : </strong> Rp. <?= number_format($hasil['topupberkalaunitlink'], 2, ',', '.');?>
				</li>
                <li>
					<strong> Top Up Sekaligus : </strong> Rp. <?= number_format($hasil['topupsekaligusunitlink'], 2, ',', '.');?> selama <?= $hasil['selama'];?> tahun
				</li>
                <li>
					 <strong>Masa Pemb Premi :</strong> <?= $hasil['masapembpremi'];?> tahun
				</li>
                <li>
					 <strong>Tgl dibuat :</strong> <?= $hasil['tanggalproposal'];?> 
				</li>
                <li>
					 <strong>Jenis Produk :</strong> <?= $hasil['jenis_produk'];?> 
				</li>
                <li>
					 <strong>Cara Bayar Berkala :</strong> <?= $hasil['carabayar'];?> 
				</li>
                <li>
					 <strong> Nilai Aktiva Bersih (NAB) Awal : </strong> <?= number_format($hasil['asumsinab'], 2, ',', '.');?>
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
					<td></strong><?= $hasil['jenis_produk'];?></td>
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
				<th align="center">
					 Biaya Asuransi
				</th>
			</tr>
			</thead>
			<tbody>
            	<tr>
					<td>JS TL1</td>
					<td align="center">Usia Tertanggung 65 tahun</td>
					<td align="center"> <?= $hasil['juatl1'];?></td>
					<td align="center">-</td>
			  	</tr>
                <tr>
					<td>JS TL2</td>
					<td align="center">Usia Tertanggung 65 tahun</td>
					<td align="center"> <?= $hasil['juatl2'];?></td>
					<td align="center">-</td>
			  	</tr>
			  	<tr>
					<td>Produk Pokok TL (1+2)</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juatl'];?></td>
					<td align="center"> <?= $hasil['premisesuaicarabayar'];?></td>
			  	</tr>
                <tr>
					<td>Term</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juaterm'];?></td>
					<td align="center"> <?= $hasil['premitambahanterm'];?> **)</td>
			  	</tr>
                <tr>
					<td>Personal Accident</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juapa'];?></td>
					<td align="center"> <?= $hasil['premitambahanpa'];?> **)</td>
			  	</tr>
                <tr>
					<td>Critical Ilness</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juaci'];?></td>
					<td align="center"> <?= $hasil['premitambahanci'];?> **)</td>
			  	</tr>
                <tr>
					<td>Total Permanent Disability</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juactt'];?></td>
					<td align="center"> <?= $hasil['premitambahanctt'];?> **)</td>
			  	</tr>
                <tr>
					<td>Waiver Premium</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juawp'];?></td>
					<td align="center"> <?= $hasil['premitambahanwp'];?> **)</td>
			  	</tr>
                <tr>
					<td>Cash Plan</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juacpm'];?></td>
					<td align="center"> <?= $hasil['premitambahancpm'];?> **)</td>
			  	</tr>
                <tr>
					<td>Cash Plan Bedah</td>
					<td align="center">Usia Tertanggung <?= $hasil['jangkawaktuusia'];?> tahun</td>
					<td align="center"> <?= $hasil['juacpb'];?></td>
					<td align="center"> <?= $hasil['premitambahancpb'];?> **)</td>
			  	</tr>
			</tbody>
			</table>
			</div>
		</div>
   
        <div class="col-xs-12">
			<div class="well">
                **) Adalah Premi bulanan tahun pertama, dimana besar premi tahun berikutnya akan menyesuaikan kenaikan usia tertanggung.
			</div>
       </div>
	</div>
       		
                &nbsp;
    <div class="row">
            <div class="col-xs-12">
                <div class="well">
				<div style="font-weight:bold; font-size:16px" align="center">ILUSTRASI PLAN POKOK DAN PERKEMBANGAN DANA<br>JS LINK BALANCED FUND</br></div>
                <br>
                <div style="font-weight:bold; font-size:14px">Jumlah Premi <?= $hasil['carabayar'];?> : Rp. <?= $hasil['totalpremisesuaicarabayarunitlink'];?></div>
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
					 Manfaat Meninggal Dunia 
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
            	<?php for($i=1;$i<=$hasil['usiamax'];$i++){?>
			  	<tr>	
                    <td><?php echo $i; ?></td>
                    <td><?= $hasil['nilai'][$i]['usia']; ?></td>
                    <td><?= $hasil['nilai'][$i]['premiribuandisplay']; ?></td>
                    <td><?= $hasil['nilai'][$i]['topupribuandisplay']; ?></td>
                    <td></td>
                    <td><?= $hasil['nilai'][$i]['manfaatmeninggalduniarendah']; ?></td>
                    <td><?= $hasil['nilai'][$i]['manfaatmeninggalduniasedang']; ?></td>
                    <td><?= $hasil['nilai'][$i]['manfaatmeninggalduniatinggi']; ?></td>
                    <td><?= $hasil['nilai'][$i]['nabxjumlahunitrendah']; ?></td>
                    <td><?= $hasil['nilai'][$i]['nabxjumlahunitsedang']; ?></td>
                    <td><?= $hasil['nilai'][$i]['nabxjumlahunittinggi']; ?></td>
			  	</tr>
			<?php }?>
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