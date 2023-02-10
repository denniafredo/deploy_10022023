<?php

$buildid = $_GET['buildid'];
$sql = 'select * from PRO_PEMPOL where build_id = '.$buildid;
$query = $this->db->query($sql);

$sql2 = 'select * from PRO_TERTANGGUNG where build_id = '.$buildid;
$query2 = $this->db->query($sql2);

$sql3 = 'select * from PRO_ASURANSI_POKOK where build_id = '.$buildid;
$query3 = $this->db->query($sql3);

$sql4 = 'select * from PRO_ALOKASI_DANA where build_id = '.$buildid;
$query4 = $this->db->query($sql4);

$sql7 = 'select * from PRO_TOTAL_INVESTASI1 where build_id = '.$buildid;
$query7 = $this->db->query($sql7);

$sql8 = 'select * from PRO_TOTAL_INVESTASI2 where build_id = '.$buildid;
$query8 = $this->db->query($sql8);

$sql9 = 'select * from PRO_TOTAL_RINGKASAN where build_id = '.$buildid;
$query9 = $this->db->query($sql9);

$sql10 = 'select * from PRO_TOTAL_RINGKASAN where build_id = '.$buildid;
$query10 = $this->db->query($sql10);

error_reporting(0);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<!-- BEGIN PAGE CONTENT-->
<div class="" id="Testis">
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
		</div>
		Jl. Ir. H. Juanda No. 34 Jakarta - 10120
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
	&nbsp;
	<div class="row" align="center">
		<div class="col-xs-12">
			<input id="buildid" name="buildid" value="<?=$_GET['buildid'] ?>" style="display: none"></input>
			<div class="well" style="font-weight:bold;font-size:16px">
				JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)
			</div>
		</div>
	 </div>
	<hr/>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
			<?php
				foreach ($query->result_array() as $row)
				{	
			?>
			<div class="well" style="font-weight:bold;font-size:14px">
				CALON PEMEGANG POLIS
			</div>
				<li>
					 <strong>Nama Pemegang Polis 				: </strong> <?=$row['NAMA'];?>
				</li>
				<li>
					 <strong>Tanggal Lahir 						: </strong> <?=date('d/m/Y',$row2['TGL_LAHIR']);?> 
				</li>
				<li>
					 <strong>Jenis Kelamin 						: </strong> <?=$row['JENIS_KELAMIN'];?> 
				</li>
				<li>
					 <strong>Status Perokok 					: </strong> <?=$row['IS_PEROKOK'];?> 
				</li>
			</ul>
			<?php
				}
			?>
		</div>

	</div>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
			<?php
				foreach ($query2->result_array() as $row2)
				{	
			?>
			<div class="well" style="font-weight:bold;font-size:14px">
				CALON TERTANGGUNG
			</div>
				<li>
					 <strong> Nama Tertanggung 					: </strong> <?=$row2['NAMA'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir 					: </strong> <?=date('d/m/Y',$row2['TGL_LAHIR']);?> 
				</li>
				<li>
					 <strong> Hubungan dengan Pemegang Polis 	: </strong> <?=$row2['HUBUNGAN'];?>
				</li>
				<li>
					 <strong>Jenis Kelamin 						: </strong> <?=$row2['JENIS_KELAMIN'];?> 
				</li>
				<li>
					 <strong>Status Perokok 					: </strong> <?=$row2['IS_PEROKOK'];?> 
				</li>
			</ul>
			<?php
				}
			?>
			<hr/>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php
				foreach ($query3->result_array() as $row3)
				{	
			?>
			<ul class="list-unstyled">
				<li>
					 <strong> Cara Bayar						: </strong><?=$row3['CARA_BAYAR'];?>
				</li>
				<li>
					 <strong> Uang Pertanggungan				: </strong>Rp. <?= number_format($row3['UA'],0,'.',',');?>
				</li>
				<li>
					 <strong> Premi Berkala						: </strong>Rp. <?= number_format($row3['PREMI_BERKALA'],0,'.',',');?>
				</li>
				<li>
					 <strong> Top Up Berkala 					: </strong>Rp. <?= number_format($row3['TOPUP_BERKALA'],0,'.',',');?>
				</li>
				<li>
					 <strong> Top Up Sekaligus 					: </strong>Rp. <?= number_format($row3['TOPUP_SEKALIGUS'],0,'.',',');?>
				</li>
			</ul>
			<?php
				}
			?>
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
			<?php
				foreach ($query4->result_array() as $row4)
				{	
			?>
			<tbody style="font-size:12px">
				<tr>
					<?
					if (($row4['NAMA_ALOKASI1'] != "") && ($row4['ALOKASI1'] != "") && ($row4['ALOKASI1'] != 0))
					{
					?>
						<td align="justify"> <?= $row4['NAMA_ALOKASI1'];?></td>
						<td align="justify"> <?= $row4['ALOKASI1'];?> %</td>
					<?
					}
					?>
					</tr>
					<tr>
					<?
					if (($row4['NAMA_ALOKASI2'] != "") && ($row4['ALOKASI2'] != "") && ($row4['ALOKASI2'] != 0))
					{
					?>
						<td align="justify"> <?= $row4['NAMA_ALOKASI2'];?></td>
						<td align="justify"> <?= $row4['ALOKASI2'];?> %</td>
					<?
					}
					?>
				</tr>
			</tbody>
			<?php
				}
			?>
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
				<?php
				foreach ($query3->result_array() as $row3)
					{	
				?>
					<td align="center"> <?= number_format($row3['UA'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php

				$sql5 = 'select * from PRO_TOTAL_BIAYA_ALL where build_id = '.$buildid;
				$query5 = $this->db->query($sql5);

				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['TL_POKOK'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>

					<td align="center"> JS ADDB</td>			
					<td align="center"> 65</td>
				<?php

				$sql6 = 'select * from PRO_DATA_RIDER where build_id = '.$buildid;
				$query6 = $this->db->query($sql6);

				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['ADDB'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['ADDB'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS CI 53</td>			
					<td align="center"> 65</td>
				<?php
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['CI'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['CI'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS HCP</td>			
					<td align="center"> 65</td>
				<?php	
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['PLAFON_HCP_MURNI'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['HCP_MURNI'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS HCP Bedah</td>			
					<td align="center"> 65</td>
				<?php	
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['PLAFON_HCP_BEDAH'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['HCP_BEDAH'],0,'.',',');?></td>	
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS TPD</td>			
					<td align="center"> 65</td>
				<?php
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['TPD'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['TPD'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS Term Life</td>			
					<td align="center"> 65</td>
				<?php	
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['TL'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['TL_RIDER'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS Payor Benefit Death</td>			
					<td align="center"> 65</td>
				<?php
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['PAYOR_DEATH'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['PAYOR_DEATH'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS Payor Benefit TPD</td>			
					<td align="center"> 65</td>
				<?php
				foreach ($query6->result_array() as $row6)
					{	
				?>
					<td align="center"> <?= number_format($row6['PAYOR_TPD'],0,'.',',');?></td>
				<?php
					}
				?>
				<?php	
				foreach ($query5->result_array() as $row5)
					{	
				?>
					<td align="center"> <?= number_format($row5['PAYOR_TPD'],0,'.',',');?></td>
				<?php
					}
				?>
				</tr>
				<tr>
					<td align="center"> JS Spouse Payor Death</td>			
					<td align="center"> 65</td>
					<?php
					foreach ($query6->result_array() as $row6)
						{	
					?>
						<td align="center"> <?= number_format($row6['SPOUSE_DEATH'],0,'.',',');?></td>
					<?php
						}
					?>
					<?php	
					foreach ($query5->result_array() as $row5)
						{	
					?>
						<td align="center"> <?= number_format($row5['SPOUSE_DEATH'],0,'.',',');?></td>
					<?php
						}
					?>
				</tr>
				<tr>
					<td align="center"> JS Spouse Payor TPD</td>			
					<td align="center"> 65</td>
					<?php
					foreach ($query6->result_array() as $row6)
						{	
					?>
						<td align="center"> <?= number_format($row6['SPOUSE_TPD'],0,'.',',');?></td>
					<?php
						}
					?>
					<?php	
					foreach ($query5->result_array() as $row5)
						{	
					?>
						<td align="center"> <?= number_format($row5['SPOUSE_TPD'],0,'.',',');?></td>
					<?php
						}
					?>
				</tr>
				<tr>
					<td align="center"> JS Waiver Of Premium TPD</td>			
					<td align="center"> 65</td>
					<?php
					foreach ($query6->result_array() as $row6)
						{	
					?>
						<td align="center"> <?= number_format($row6['WAIVER_TPD'],0,'.',',');?></td>
					<?php
						}
					?>
					<?php	
					foreach ($query5->result_array() as $row5)
						{	
					?>
						<td align="center"> <?= number_format($row5['WAIVER_TPD'],0,'.',',');?></td>
					<?php
						}
					?>
				</tr>
				<tr>
					<td align="center"> JS Waiver Of Premium CI</td>			
					<td align="center"> 65</td>
					<?php
					foreach ($query6->result_array() as $row6)
						{	
					?>
						<td align="center"> <?= number_format($row6['WAIVER_CI'],0,'.',',');?></td>
					<?php
						}
					?>
					<?php	
					foreach ($query5->result_array() as $row5)
						{	
					?>
						<td align="center"> <?= number_format($row5['WAIVER_CI'],0,'.',',');?></td>
					<?php
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
			<br>
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

					<td align="justify"> JS ADDB </td>
					<td align="justify"> Apabila Tertanggung meninggal dunia / cacat karena kecelakaan dan Usia Tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Accident Death and Dismemberment Benefit.</td>

				</tr>
				<tr>

					<td align="justify"> JS TPD </td>
					<td align="justify"> Apabila Tertanggung mengalami Total Permanent Disability dan Usia Tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Total Permanent Disability Benefit.</td>

				</tr>
				<tr>

					<td align="justify"> JS HCP </td>
					<td align="justify"> Memberikan santunan harian Rawat Inap, ICU, Pembedahan setelah JS Hospital Cash Plan berlangsung 90 hari atau lebih dan Usia Tertanggung tidak lebih dari 65 dengan minimum 2 x 24 jam dan maksimum 180 hari dalam satu tahun.</td>

				</tr>
				<tr>

					<td align="justify"> JS CI 53 </td>
					<td align="justify"> Apabila Tertanggung didiagnosa untuk pertama kali mengalami salah satu dari 53 jenis penyakit kritis, maka akan dibayarkan manfaat JS CI 53.</td>

				</tr>
				<tr>

					<td align="justify"> JS TERM </td>
					<td align="justify"> Apabila Tertanggung meninggal dunia karena Sakit atau kecelakaan usia tertanggung tidak lebih dari 65 Tahun, maka akan dibayarkan Uang Asuransi JS Term Rider.</td>

				</tr>
				<tr>

					<td align="justify"> JS PAYOR BENEFIT - DEATH </td>
					<td align="justify"> Apabila Pemegang Polis meninggal dunia baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada pengganti Pemegang Polis.</td>

				</tr>
				<tr>

					<td align="justify"> JS PAYOR BENEFIT - TPD </td>
					<td align="justify"> Apabila Pemegang Polis menderita Cacat Tetap Total (TPD) baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada Pemegang Polis.</td>

				</tr>
				<tr>

					<td align="justify"> JS SPOUSE PAYOR - DEATH </td>
					<td align="justify"> Apabila Pemegang Polis meninggal dunia baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada Tertanggung.</td>

				</tr>
				<tr>

					<td align="justify"> JS SPOUSE PAYOR - TPD </td>
					<td align="justify"> Apabila Pemegang Polis menderita Cacat Tetap Total baik karena sakit maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi berkala akan diberikan kepada Tertanggung.</td>

				</tr>
				<tr>
					<td align="justify"> JS Waiver of Premium CI </td>
					<td align="justify"> Apabila pasangan Tertanggung didiagnosa pertama kali dalam hidup menderita salah satu dari 53 Penyakit Kritis sesuai dengan Daftar Penyakit Kritis dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi dasar berkala akan diberikan kepada Pemegang Polis.</td>
				</tr>
				<tr>
					<td align="justify"> JS Waiver of Premium TPD </td>
					<td align="justify"> Apabila  Tertanggung menderita Cacat tetap Total baik karena maupun karena kecelakaan dalam masa perjanjian asuransi, maka manfaat pembebasan pembayaran premi dasar berkala akan diberikan kepada Pemegang Polis.</td>
				</tr>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>

<div class="" id="Testis2">
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
		</div>
		Jl. Ir. H. Juanda No. 34 Jakarta - 10120
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
	&nbsp;
	<div class="row" align="center">
		<div class="col-xs-12">
			<input id="buildid" name="buildid" value="<?=$_GET['buildid'] ?>" style="display: none"></input>
			<div class="well" style="font-weight:bold;font-size:16px">
				JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)
			</div>
		</div>
	 </div>
	<div class="well">
	
	<table style="width:100%">
		<?php
			foreach ($query4->result_array() as $row4)
			{	
		?>
		<thead>
			<tr>
				<td></td>
				<td></td>
				<?
				if (($row4['NAMA_ALOKASI1'] != "") && ($row4['ALOKASI1'] != "") && ($row4['ALOKASI1'] != 0))
				{
				?>
					<td><?= $row4['NAMA_ALOKASI1'];?></td>
				<?
				}
				?>
				<td></td>
				<td></td>
				<td>MANFAAT INVESTASI</td>
				<td></td>
				<td></td>
				<td>MANFAAT MENINGGAL DUNIA</td>
				<td></td>
			</tr>
		</thead>
		<?php
			}
		?>
		<tbody>
		  <tr>
			<td>TAHUN</td>
			<td>USIA</td>
			<td>PREMI</td>
			<td>TOPUP</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
		  </tr>
		 
		  <?php
			foreach ($query7->result_array() as $row7)
				{	
			?>
		 <tr>
			<td><?= (number_format($row7['TAHUN'],0,',','.'));?></td>
			<td><?= (number_format($row7['USIA_TT'],0,',','.'));?></td>
			<td><?= (number_format($row7['PREMI'],0,',','.'));?></td>
			<td><?= (number_format($row7['TOPUPB'],0,',','.'));?></td>
			<td><?= (number_format($row7['INVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row7['INVMED'],0,',','.'));?></td>
			<td><?= (number_format($row7['INVHIGH'],0,',','.'));?></td>
			<td><?= (number_format($row7['JUAINVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row7['JUAINVMED'],0,',','.'));?></td>
			<td><?= (number_format($row7['JUAINVHIGH'],0,',','.'));?></td>
		 </tr>
			<?php
				}
			?>
		</tbody>
	</table>
	
	
	</div>
	<hr/>
	

	
	
</div>	
		
<div class="" id="Testis3">
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
		</div>
		Jl. Ir. H. Juanda No. 34 Jakarta - 10120
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
	&nbsp;
	<div class="row" align="center">
		<div class="col-xs-12">
			<input id="buildid" name="buildid" value="<?=$_GET['buildid'] ?>" style="display: none"></input>
			<div class="well" style="font-weight:bold;font-size:16px">
				JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)
			</div>
		</div>
	 </div>
	<div class="well">
	
	<table style="width:100%">
		<?php
			foreach ($query4->result_array() as $row4)
			{	
		?>
		<thead>
			<tr>
				<td></td>
				<td></td>
				<?
				if (($row4['NAMA_ALOKASI2'] != "") && ($row4['ALOKASI2'] != "") && ($row4['ALOKASI2'] != 0))
				{
				?>
					<td><?= $row4['NAMA_ALOKASI2'];?></td>
				<?
				}
				?>
				<td></td>
				<td></td>
				<td>MANFAAT INVESTASI</td>
				<td></td>
				<td></td>
				<td>MANFAAT MENINGGAL DUNIA</td>
				<td></td>
			</tr>
		</thead>
		<?php
			}
		?>
		<tbody>
		  <tr>
			<td>TAHUN</td>
			<td>USIA</td>
			<td>PREMI</td>
			<td>TOPUP</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
		  </tr>
		 
		  <?php
			foreach ($query8->result_array() as $row8)
				{	
			?>
		 <tr>
			<td><?= (number_format($row8['TAHUN'],0,',','.'));?></td>
			<td><?= (number_format($row8['USIA_TT'],0,',','.'));?></td>
			<td><?= (number_format($row8['PREMI'],0,',','.'));?></td>
			<td><?= (number_format($row8['TOPUPB'],0,',','.'));?></td>
			<td><?= (number_format($row8['INVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row8['INVMED'],0,',','.'));?></td>
			<td><?= (number_format($row8['INVHIGH'],0,',','.'));?></td>
			<td><?= (number_format($row8['JUAINVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row8['JUAINVMED'],0,',','.'));?></td>
			<td><?= (number_format($row8['JUAINVHIGH'],0,',','.'));?></td>
		 </tr>
			<?php
				}
			?>
		</tbody>
	</table>
	
	
	</div>
	<hr/>
	

	
	
</div>
		
<div class="" id="Testis4">
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
		</div>
		Jl. Ir. H. Juanda No. 34 Jakarta - 10120
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
	&nbsp;
	<div class="row" align="center">
		<div class="col-xs-12">
			<input id="buildid" name="buildid" value="<?=$_GET['buildid'] ?>" style="display: none"></input>
			<div class="well" style="font-weight:bold;font-size:16px">
				JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)
			</div>
		</div>
	 </div>
	<div class="well">
	
	<table style="width:100%">
		
		<thead>
			<tr>
				<td></td>
				<td></td>
				<td>RINGKASAN</td>
				<td></td>
				<td></td>
				<td>MANFAAT INVESTASI</td>
				<td></td>
				<td></td>
				<td>MANFAAT MENINGGAL DUNIA</td>
				<td></td>
			</tr>
		</thead>
		
		<tbody>
		  <tr>
			<td>TAHUN</td>
			<td>USIA</td>
			<td>PREMI</td>
			<td>TOPUP</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
		  </tr>
		 
		  <?php
			foreach ($query9->result_array() as $row9)
				{	
			?>
		 <tr>
			<td><?= (number_format($row9['TAHUN'],0,',','.'));?></td>
			<td><?= (number_format($row9['USIA_TT'],0,',','.'));?></td>
			<td><?= (number_format($row9['PREMI'],0,',','.'));?></td>
			<td><?= (number_format($row9['TOPUPB'],0,',','.'));?></td>
			<td><?= (number_format($row9['INVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row9['INVMED'],0,',','.'));?></td>
			<td><?= (number_format($row9['INVHIGH'],0,',','.'));?></td>
			<td><?= (number_format($row9['JUAINVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row9['JUAINVMED'],0,',','.'));?></td>
			<td><?= (number_format($row9['JUAINVHIGH'],0,',','.'));?></td>
		 </tr>
			<?php
				}
			?>
		</tbody>
	</table>
	
	
	</div>
	<hr/>
	

	
	
</div>
		
<div class="" id="Testis5">
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
		</div>
		Jl. Ir. H. Juanda No. 34 Jakarta - 10120
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
	&nbsp;
	<div class="row" align="center">
		<div class="col-xs-12">
			<input id="buildid" name="buildid" value="<?=$_GET['buildid'] ?>" style="display: none"></input>
			<div class="well" style="font-weight:bold;font-size:16px">
				JS PROMAPAN (Jiwasraya Proteksi Masa Depan Aman)
			</div>
		</div>
	 </div>
	<div class="well">
	
	<table style="width:100%">
		
		<thead>
			<tr>
				<td></td>
				<td></td>
				<td>KOMPARASI RINGKASAN</td>
				<td></td>
				<td></td>
				<td>MANFAAT INVESTASI</td>
				<td></td>
				<td></td>
				<td>MANFAAT MENINGGAL DUNIA</td>
				<td></td>
			</tr>
		</thead>
		
		<tbody>
		  <tr>
			<td>TAHUN</td>
			<td>USIA</td>
			<td>PREMI</td>
			<td>TOPUP</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
			<td>RENDAH</td>
			<td>SEDANG</td>
			<td>TINGGI</td>
		  </tr>
		 
		  <?php
			foreach ($query10->result_array() as $row10)
				{	
			?>
		 <tr>
			<td><?= (number_format($row10['TAHUN'],0,',','.'));?></td>
			<td><?= (number_format($row10['USIA_TT'],0,',','.'));?></td>
			<td><?= (number_format($row10['PREMI'],0,',','.'));?></td>
			<td><?= (number_format($row10['TOPUPB'],0,',','.'));?></td>
			<td><?= (number_format($row10['INVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row10['INVMED'],0,',','.'));?></td>
			<td><?= (number_format($row10['INVHIGH'],0,',','.'));?></td>
			<td><?= (number_format($row10['JUAINVLOW'],0,',','.'));?></td>
			<td><?= (number_format($row10['JUAINVMED'],0,',','.'));?></td>
			<td><?= (number_format($row10['JUAINVHIGH'],0,',','.'));?></td>
		 </tr>
			<?php
				}
			?>
		</tbody>
	</table>
	
	
	</div>
	<hr/>
	

	
	
</div>
			
<div class="row">
	<div class="col-md-12">
		<div class="col-md-offset-3 col-md-9">
			<button type="button" id="cetakPdf" name="cetakPdf" onClick="CetakPDF()">
<!--					<a target="_blank" href="<?= base_url().'files/pdf/'.$hasil['filepdf'].'.pdf'; ?>" class="btn green button-submit">-->
				 Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	</div>
</div>

</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->

<script>

function CetakPDF(){
	
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById('Testis').innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
	
//	var buildid= document.getElementById("buildid").value;
//	
////	alert(buildid);
//	
////	alert('<?=base_url('jspromapannew/CetakPDF');?>');
//	
//	$.ajax({
//		type	: "POST",
//		url		: "<?=base_url('jspromapannew/CetakPDF');?>",
//		data	: "buildid="+buildid,
//		success : function(msg) {
//
////			alert(msg);
//			
//		}
//	});	
	
}

</script>