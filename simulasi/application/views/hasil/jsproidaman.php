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
				JS PROIDAMAN (Jiwasraya Proteksi Investasi Dana Aman) 
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
					 <strong> Tanggal Lahir : </strong> <?= $hasil['tanggallahircalonpemegangpolis'];?> / <?= $hasil['usiacalonpemegangpolis'];?> Tahun 
				</li>
                <li>
					 <strong>Jenis Kelamin :</strong> <?= $hasil['jeniskelaminpemegangpolis'];?> 
				</li>
                <li>
					 <strong>Status Perokok :</strong> <?= $hasil['calonpemegangpolisperokok'];?> 
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
                <li>
					 <strong>Status Perokok :</strong> <?= $hasil['calontertanggungperokok'];?> 
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
					 <strong> Uang Pertanggungan	: </strong><?= number_format($hasil['uangpertanggungan'],0,'.',',');?>
				</li>
                <li>
					 <strong>Mata Uang	: </strong><?= $hasil['matauang'];?>
				</li> 
                <li>
					 <strong> Premi Single	: </strong><?= number_format($hasil['premisingle'],0,'.',',');?>
				</li>
                <li>
					 <strong> Top Up Single 	: </strong><?= number_format($hasil['topupsingle'],0,'.',',');?>
				</li>
                <hr>
                <li>
					 <strong> Total Premi dibayar	: </strong><?= number_format($hasil['totalpremiyangdibayar'],0,'.',',');?>
				</li>
			</ul>
		</div>
		
	</div>
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="table-responsive">
			<table class="table table-striped table-hover">
			<thead>
			<tr>
				<th>
					 ALOKASI DANA INVESTASI (%)
				</th>
				<th>
					 
				</th>
			</tr>
			</thead>
			<tbody style="font-size:12px">
            	<tr>
                <?
                if (($hasil['nama_produk1'] != "") && ($hasil['persentasealokasidana1'] != "") && ($hasil['persentasealokasidana1'] != 0))
		{
				?>
					<td align="justify"> <?= $hasil['nama_produk1'];?></td>
					<td align="justify"> <?= $hasil['persentasealokasidana1'];?> %</td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
                if (($hasil['nama_produk2'] != "") && ($hasil['persentasealokasidana2'] != "") && ($hasil['persentasealokasidana2'] != 0))
		{
				?>
					<td align="justify"> <?= $hasil['nama_produk2'];?></td>
					<td align="justify"> <?= $hasil['persentasealokasidana2'];?> %</td>
				<?
    }
                ?>
			  	</tr>
			</tbody>
			</table>
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
					 BIAYA ASURANSI
				</th>
				<th>
					 
				</th>
			</tr>
			</thead>
			<tbody>
            	<tr>
					<td align="center" style="font-weight:bold; font-size:14px">NAMA ASURANSI</td>
					<td align="center" style="font-weight:bold; font-size:14px">UANG ASURANSI</td>
                    <td align="center" style="font-weight:bold; font-size:14px">BIAYA ASURANSI</td>
			  	</tr>
                <tr>
					<td align="center"> Asuransi Dasar</td>
					<td align="center"> <?= number_format($hasil['uangpertanggungan'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaAsuransi'],0,'.',',');?></td>
			  	</tr>
			</tbody>
			</table>
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
					
				</th>
				<th>
					 ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI 
				</th>
			</tr>
			</thead>
			<tbody>
            	<tr>
					<td align="justify"> JS PROIDAMAN </td>
                    <td align="justify"> Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah besar Nilai investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit, karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi JS PROIDAMAN ditambah Saldo Dana Investasi.</td>
			  	</tr>
			</tbody>
			</table>
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