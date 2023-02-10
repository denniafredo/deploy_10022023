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
    <div class="col-xs-5" align="justify">
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
				JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman) 
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
					 <strong> Hubungan dengan Pemegang Polis : </strong><?= $hasil['hubungandenganpempol'];?>
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
					 <strong> Premi Berkala	: </strong><?= number_format($hasil['premiberkala'],0,'.',',');?>
				</li>
                <li>
					 <strong> Top Up Berkala 	: </strong><?= number_format($hasil['topupberkala'],0,'.',',');?>
				</li>
                <li>
					 <strong> Top Up Sekaligus 	: </strong><?= number_format($hasil['topupsekaligus'],0,'.',',');?>
				</li>
                <hr>
                <li>
					 <strong> Total Premi yang dibayar	: </strong><?= number_format($hasil['totalpremiyangdibayar'],0,'.',',');?> <div style="font-style:italic; float:right">Jiwasraya berhak melakukan pemeriksaan medis bagi SPAJ non medical secara acak.</div> 
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
					<td align="justify"> <?= $hasil['alokasidana1'];?></td>
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
					<td align="justify"> <?= $hasil['alokasidana2'];?></td>
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
                    <td align="center" style="font-weight:bold; font-size:14px">SAMPAI USIA TERTANGGUNG</td>
					<td align="center" style="font-weight:bold; font-size:14px">UANG ASURANSI</td>
                    <td align="center" style="font-weight:bold; font-size:14px">BIAYA ASURANSI PER BULAN</td>
			  	</tr>
                <tr>
					<td align="center"> Asuransi Dasar</td>			
                    <td align="center"> 99</td>
					<td align="center"> <?= number_format($hasil['uangpertanggungan'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanad'],0,'.',',');?></td>
			  	</tr>
                <tr>
                <?
					if (($hasil['juaaddb'] != "") && ($hasil['biayaasuransiperbulanjsaddb'] != ""))
		{
				?>
					<td align="center"> JS ADDB</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juaaddb'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjsaddb'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juaci53'] != "") && ($hasil['biayaasuransiperbulanjsci53'] != ""))
		{				
				?>
					<td align="center"> JS CI 53</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juaci53'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjsci53'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juahcp'] != "") && ($hasil['biayaasuransiperbulanjshcp'] != ""))
		{				
				?>
					<td align="center"> JS HCP</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juahcp'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjshcp'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juahcpbedah'] != "") && ($hasil['biayaasuransiperbulanjshcpbedah'] != ""))
			{			
				?>
					<td align="center"> JS HCP Bedah</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juahcpbedah'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjshcpbedah'],0,'.',',');?></td>				
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juatpd'] != "") && ($hasil['biayaasuransiperbulanjstpd'] != ""))
		{		
				?>
					<td align="center"> JS TPD</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juatpd'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjstpd'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                 <?
					if (($hasil['juatermlife'] != "") && ($hasil['biayaasuransiperbulantl'] != ""))
		{
				?>
					<td align="center"> JS Term Life</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juatermlife'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulantl'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juapayorbenefitdeath'] != "") && ($hasil['biayaasuransiperbulanjspbd'] != ""))
		{
				?>
					<td align="center"> JS Payor Benefit Death</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juapayorbenefitdeath'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjspbtpd'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juapayorbenefittpd'] != "") && ($hasil['biayaasuransiperbulanjspbtpd'] != ""))
		{
				?>
					<td align="center"> JS Payor Benefit TPD</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juapayorbenefittpd'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjspbtpd'],0,'.',',');?></td>
               	<?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juaspousepayordeath'] != "") && ($hasil['biayaasuransiperbulanjsspd'] != ""))
		{
				?>
					<td align="center"> JS Spouse Payor Death</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juaspousepayordeath'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjsspd'],0,'.',',');?></td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juaspousepayortpd'] != "") && ($hasil['biayaasuransiperbulanjssptpd'] != ""))
		{
				?>
					<td align="center"> JS Spouse Payor TPD</td>			
                    <td align="center"> 65</td>
					<td align="center"> <?= number_format($hasil['juaspousepayortpd'],0,'.',',');?></td>
                    <td align="center"> <?= number_format($hasil['biayaasuransiperbulanjssptpd'],0,'.',',');?></td>
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
					
				</th>
				<th>
					 ILUSTRASI INI BUKAN SEBUAH KONTRAK ASURANSI 
				</th>
			</tr>
			</thead>
			<tbody>
            	<tr>
					<td align="justify"> JS PRO MAPAN </td>
                    <td align="justify"> Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah sebesar Nilai investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit, karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi JS PRO MAPAN ditambah Saldo Dana Investasi.</td>
			  	</tr>
                <tr>
                <?
					if (($hasil['juaaddb'] != "") && ($hasil['biayaasuransiperbulanjsaddb'] != ""))
		{
				?>
					<td align="justify"> JS ADDB </td>
                    <td align="justify"> Apabila Tertanggung meninggal dunia / cacat karena kecelakaan dan Usia Tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Accident Death and Dismemberment Benefit.</td>
                <?
		}
				?>
			  	</tr>
                <tr>
                <?
					if (($hasil['juatpd'] != "") && ($hasil['biayaasuransiperbulanjstpd'] != ""))
		{
				?>
					<td align="justify"> JS TPD </td>
                    <td align="justify"> Apabila Tertanggung mengalami Total Permanent Disability dan Usia Tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Total Permanent Disability Benefit.</td>
                <?
		}
				?>   
			  	</tr>
                <tr>
                <?
					if (($hasil['juahcp'] != "") && ($hasil['biayaasuransiperbulanjshcp'] != ""))
		{
				?>
					<td align="justify"> JS HCP </td>
                    <td align="justify"> Memberikan santunan harian Rawat Inap, ICU, Pembedahan setelah JS Hospital Cash Plan berlangsung 90 hari atau lebih dan Usia Tertanggung tidak lebih dari 65 dengan minimum 2 x 24 jam dan maksimum 180 hari dalam satu tahun.</td>
                <?
		}
				?> 
			  	</tr>
                <tr>
                <?
					if (($hasil['juaci53'] != "") && ($hasil['biayaasuransiperbulanjsci53'] != ""))
		{
				?>
					<td align="justify"> JS CI 53 </td>
                    <td align="justify"> Apabila Tertanggung didiagnosa untuk pertama kali mengalami salah satu dari 53 jenis penyakit kritis, maka akan dibayarkan manfaat JS CI 53.</td>
                <?
		}
				?> 
			  	</tr>
                <tr>
                <?
					if (($hasil['juatermlife'] != "") && ($hasil['biayaasuransiperbulantl'] != ""))
		{
				?>
					<td align="justify"> JS TERM </td>
                    <td align="justify"> Apabila Tertanggung meninggal dunia karena Sakit atau kecelakaan usia tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Term Rider.</td>
                <?
		}
				?> 
			  	</tr>
                <tr>
                <?
					if (($hasil['juapayorbenefitdeath'] != "") && ($hasil['biayaasuransiperbulanjspbd'] != ""))
		{
				?>
					<td align="justify"> JS PAYOR BENEFIT - DEATH </td>
                    <td align="justify"> Apabila Pemegang Polis meninggal dunia baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada pengganti Pemegang Polis.</td>
                <?
		}
				?> 
			  	</tr>
                <tr>
                 <?
					if (($hasil['juapayorbenefittpd'] != "") && ($hasil['biayaasuransiperbulanjspbtpd'] != ""))
		{
				?>
					<td align="justify"> JS PAYOR BENEFIT - TPD </td>
                    <td align="justify"> Apabila Pemegang Polis menderita Cacat Tetap Total (TPD) baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada Pemegang Polis.</td>
                <?
		}
				?> 
			  	</tr>
                <tr>
                <?
					if (($hasil['juaspousepayordeath'] != "") && ($hasil['biayaasuransiperbulanjsspd'] != ""))
		{
				?>
					<td align="justify"> JS SPOUSE PAYOR - DEATH </td>
                    <td align="justify"> Apabila Pemegang Polis meninggal dunia baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada Tertanggung.</td>
                <?
		}
				?> 
			  	</tr>
                <tr>
                <?
					if (($hasil['juaspousepayortpd'] != "") && ($hasil['biayaasuransiperbulanjssptpd'] != ""))
		{
				?>
					<td align="justify"> JS SPOUSE PAYOR - TPD </td>
                    <td align="justify"> Apabila Pemegang Polis menderita Cacat Tetap Total baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada Tertanggung.</td>
                <?
		}
				?> 
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