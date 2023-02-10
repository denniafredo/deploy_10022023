<?php

$buildid = $_GET['buildid'];
$filepdf = $_GET['filepdf'];
$kodeprospek = $_GET['kodeprospek'];

$sql = 'select * from PRO_PEMPOL where build_id = '.$buildid;
$query = $this->db->query($sql);

$sql2 = 'select * from PRO_TERTANGGUNG where build_id = '.$buildid;
$query2 = $this->db->query($sql2);

$sql3 = 'select * from PRO_ASURANSI_POKOK where build_id = '.$buildid;
$query3 = $this->db->query($sql3);

$sql4 = 'select A.*,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI1) NAMA_ALOKASI1,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI2) NAMA_ALOKASI2  
		 from PRO_ALOKASI_DANA A 
		 where build_id = '.$buildid;
$query4 = $this->db->query($sql4);

$sql5X = 'SELECT B.JENIS,NAMA,DESKRIPSI,URUT,SU,B.BUILD_ID,B.NILAI PREMI,C.NILAI UA,nvl(pengakuan,0) pengakuan,
                C.NILAI * nvl(pengakuan,0) / 100 resiko_awal
            FROM PRO_REDAKSI A,pro_premi_th1 B, PRO_JUA C,PRO_PENGAKUAN_RESIKO d
            WHERE a.jenis = b.jenis
            and a.jenis = c.jenis
            and b.build_id = c.build_id
            and c.jenis = d.jenis(+)
            and b.build_id = '.$buildid.' 
            and b.nilai > 0
			AND c.nilai != 0
         order by urut';

$sql5 = "SELECT B.JENIS,a.NAMA,DESKRIPSI,URUT,SU,B.BUILD_ID,B.NILAI PREMI,C.NILAI UA,nvl(pengakuan,0) pengakuan,
                        nvl(CASE WHEN c.JENIS IN ('WAIVER_CI','WAIVER_TPD') THEN
                          (f.PREMI_BERKALA+f.TOPUP_BERKALA)*(SELECT TARIF FROM TARIF_PROMAPAN WHERE KD_TARIF = 'JRA_WP' AND MASA = 65-e.USIA_TH) * pengakuan / 100
                        ELSE
                          c.nilai*pengakuan/100 
                        END,0) resiko_awal
                    FROM PRO_REDAKSI A,pro_premi_th1 B, PRO_JUA C,PRO_PENGAKUAN_RESIKO d,PRO_TERTANGGUNG e, PRO_ASURANSI_POKOK f 
                    WHERE a.jenis = b.jenis
                    and a.jenis = c.jenis
                    and b.build_id = c.build_id
                    and b.build_id = f.build_id
                    and b.build_id = e.build_id
                    and c.jenis = d.jenis(+)
                    and b.build_id = '".$buildid."' 
                    and b.nilai > 0
                    AND c.nilai != 0
                 order by urut";


$query5 = $this->db->query($sql5);


$sql7 = 'select * from PRO_TOTAL_INVESTASI1 where build_id = '.$buildid;
$query7 = $this->db->query($sql7);

$sql8 = 'select * from PRO_TOTAL_INVESTASI2 where build_id = '.$buildid;
$query8 = $this->db->query($sql8);

$sql9 = 'select * from PRO_TOTAL_RINGKASAN where build_id = '.$buildid;
$query9 = $this->db->query($sql9);

$sql10 = 'select * from PRO_TOTAL_RINGKASAN where build_id = '.$buildid;
$query10 = $this->db->query($sql10);

$sql11 = "SELECT *
          FROM PRO_REDAKSI_PEMERIKSAAN
          WHERE JENIS_PEMERIKSAAN = (select PEMERIKSAAN from PRO_ASURANSI_POKOK where build_id = '$buildid') ";
$query11 = $this->db->query($sql11);

//echo $sql10;
//error_reporting(0);
?>
<style>
table, td, th {
    border: 1px solid black;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th {
    height: 50px;
}
</style>
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
			<?php
				foreach ($query->result_array() as $row)
				{	
			?>
			<div class="well" style="font-weight:bold;font-size:18px">
				CALON PEMEGANG POLIS
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">			
						<tbody>
							<tr>
								<td align="justify" style="font-size:18px" width="180px">Nama Pemegang Polis </td>
								<td align="center" style="font-size:18px" width="10px">:</td>
								<td align="left" style="font-size:18px" width="60px"><?=$row['NAMA'];?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Tanggal Lahir </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px"><?=date('d/m/Y',strtotime($row['TGL_LAHIR']));?></td>
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Jenis Kelamin </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px"><?=($row['JENIS_KELAMIN'] == 'L' ? 'Laki-Laki' : 'Perempuan');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Status Perokok </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px"><?=($row['IS_PEROKOK'] == 'T' ? 'Tidak' : 'Ya');?></td>						
							</tr>
						<tbody>
					</table>
				</div>			
			<?php
				}
			?>							
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<?php
				foreach ($query2->result_array() as $row)
				{	
			?>
			<div class="well" style="font-weight:bold;font-size:18px">
				CALON TERTANGGUNG
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">			
						<tbody>
							<tr>
								<td align="justify" style="font-size:18px" width="180px">Nama Tertanggung </td>
								<td align="center" style="font-size:18px" width="10px">:</td>
								<td align="left" style="font-size:18px" width="60px"><?=$row['NAMA'];?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Tanggal Lahir </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px"><?=date('d/m/Y',strtotime($row['TGL_LAHIR']));?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Jenis Kelamin </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px"><?=($row['JENIS_KELAMIN'] == 'L' ? 'Laki-Laki' : 'Perempuan');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Status Perokok </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px"><?=($row['IS_PEROKOK'] == 'T' ? 'Tidak' : 'Ya');?></td>						
							</tr>
						<tbody>
					</table>
				</div>			
			<?php
				}
			?>							
		</div>
	</div>			
	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<?php
				foreach ($query3->result_array() as $row)
				{	
			?>
			<div class="well" style="font-weight:bold;font-size:18px">
				DATA PERTANGGUNGAN
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">			
						<tbody>
							<tr>
								<td align="justify" style="font-size:18px" width="180px">Cara Bayar </td>
								<td align="center" style="font-size:18px" width="10px">:</td>
								<?php 
									if($row['CARA_BAYAR']=='1')
									{
										$row['CARA_BAYAR'] = 'Bulanan';	
									}
									else if ($row['CARA_BAYAR']=='2')
									{
										$row['CARA_BAYAR'] = 'Tahunan';	
									}
								?>
								
								<td align="left" style="font-size:18px" width="60px">&nbsp;&nbsp;<?=$row['CARA_BAYAR'];?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Uang Pertanggungan </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['UA'],0,',','.');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Premi Berkala </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['PREMI_BERKALA'],0,',','.');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Top Up Berkala </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['TOPUP_BERKALA'],0,',','.');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Top Up Sekaligus </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['TOPUP_SEKALIGUS'],0,',','.');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Total Premi yang dibayar </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['PREMI_BERKALA']+$row['TOPUP_BERKALA']+$row['TOPUP_SEKALIGUS'],0,',','.');?></td>						
							</tr>
							<tr>
								<td align="justify" style="font-size:18px">Medical </td>
								<td align="center" style="font-size:18px">:</td>
								<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= ($row['PEMERIKSAAN'] == '' ? 'Tidak' : 'Ya') ;?></td>						
							</tr>							
						<tbody>
					</table>
				</div>			
			<?php
				}
			?>							
		</div>
	</div>
	
	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<div class="well" style="font-weight:bold;font-size:18px">
				ALOKASI DANA INVESTASI (%)
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">			
						<tbody>
						<?php
						foreach ($query4->result_array() as $row)
						{	
						?>		
								<?php
									if ($row['NAMA_ALOKASI1'] != '')
									{	
								?>
							<tr>
								<td align="justify" style="font-size:18px" width="50px"><?=$row['NAMA_ALOKASI1'];?></td>
								<td align="center" style="font-size:18px" width="1px">:</td>
								<td align="left" style="font-size:18px" width="30px">
								<?php if ($row['ALOKASI1']<1) {
									echo str_replace(',','',$row['ALOKASI1'])*10;
								}
								else
								{
									echo str_replace(',','',$row['ALOKASI1'])*100;
								}
								?>%
								</td>						
							</tr>
								<?php
									}
								?>	
								<?php
									if ($row['NAMA_ALOKASI2'] != '')
									{	
								?>	
							<tr>
								<td align="justify" style="font-size:18px" width="50px"><?=$row['NAMA_ALOKASI2'];?></td>
								<td align="center" style="font-size:18px" width="1px">:</td>
								<td align="left" style="font-size:18px" width="50px">
								<?php if ($row['ALOKASI2']<1) {
									echo str_replace(',','',$row['ALOKASI2'])*10;
								}
								else
								{
									echo str_replace(',','',$row['ALOKASI2'])*100;
								}
								?>%
								</td>						
							</tr>	
								<?php
									}
								?>	
						<?php
						}
						?>	
					</tbody>
				</table>
			</div>	
		</div>
	</div>	

	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<div class="well" style="font-weight:bold;font-size:18px">
				BIAYA ASURANSI
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">			
						<tbody>
							<tr>
								<td align="center" style="font-size:18px;font-weight:bold; " width="280px">NAMA ASURANSI</td>
								<td align="center" style="font-size:18px;font-weight:bold; " width="280px">SAMPAI USIA TERTANGGUNG</td>
								<td align="center" style="font-size:18px;font-weight:bold; " width="280px">UANG ASURANSI</td>
								<td align="center" style="font-size:18px;font-weight:bold; " width="280px">BIAYA ASURANSI PER BULAN</td>
								<td align="center" style="font-size:18px;font-weight:bold; " width="280px">PENGAKUAN RESIKO AWAL</td>
								<td align="center" style="font-size:18px;font-weight:bold; " width="280px">RESIKO AWAL</td>
							</tr>
						<?php
						foreach ($query5->result_array() as $row)
						{
							if ($row['UA'] != 0)
							{
						?>	
							<tr>
								<td align="justify" style="font-size:18px" width="180px"><?=$row['NAMA'];?></td>
								<td align="center" style="font-size:18px"><?=$row['SU'];?></td>
								<td align="right" style="font-size:18px"><?= number_format($row['UA'],0,',','.');?>&nbsp;&nbsp;</td>						
								<td align="right" style="font-size:18px"><?= number_format($row['PREMI'],0,',','.');?>&nbsp;&nbsp;</td>						
								<td align="right" style="font-size:18px"><?= number_format($row['PENGAKUAN'],0,',','.');?>%&nbsp;&nbsp;</td>						
								<td align="right" style="font-size:18px"><?= number_format($row['RESIKO_AWAL'],0,',','.');?>&nbsp;&nbsp;</td>						
							</tr>	
						<?php
							}
							$totalUA += $row['UA'];
							$totalPREMI += $row['PREMI'];
							$totalPENGAKUAN += $row['PENGAKUAN'];
							$totalRESIKO_AWAL+= $row['RESIKO_AWAL'];
						}
						?>		
							<tr style="font-weight: bold">
								<td align="center" style="font-size:18px" width="180px" colspan='2'>TOTAL</td>								
								<td align="right" style="font-size:18px"><?= number_format($totalUA,0,',','.');?>&nbsp;&nbsp;</td>						
								<td align="right" style="font-size:18px"><?= number_format($totalPREMI,0,',','.');?>&nbsp;&nbsp;</td>						
								<td align="right" style="font-size:18px"></td>						
								<td align="right" style="font-size:18px"><?= number_format($totalRESIKO_AWAL,0,',','.');?>&nbsp;&nbsp;</td>						
							</tr>	
					</tbody>
				</table>
			</div>	
		</div>
	</div>	
	
	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<div class="well" style="font-weight:bold;font-size:18px">
				DATA PEMERIKSAAN MEDICAL
			</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">			
						<tbody>
							<tr>
<!--								<td align="center" style="font-size:18px;font-weight:bold; " width="30px">ID</td>-->
								<td align="center" style="font-size:18px;font-weight:bold; " width="30px">PEMERIKSAAN</td>								
							</tr>
						
							<tr>
								<?php
							foreach ($query11->result_array() as $row)
							{	
							?>	
<!--								<td align="center" style="font-size:18px" width="30px"><?=$row['ID'];?></td>-->
								<td style="font-size:18px" align="justify">
								<?php
								echo $row['REDAKSI'];
								if ($row['SUBID'] <> ''){
									$sqlsub = "SELECT *
											  FROM PRO_SUB_REDAKSI_PEMERIKSAAN 
											  WHERE ID = '".$row['ID']."' ";
									$querysub = $this->db->query($sqlsub);
									echo '<ol>';
									foreach ($querysub->result_array() as $rowx)
									{
										echo '<li>'.$rowx['REDAKSI'].'</li>';
									}
									echo '</ol>';
								}
								?>
								</td>								
							</tr>	
						<?php								
						}
						?>									
					</tbody>
				</table>
			</div>	
		</div>
	</div>
	
	<hr>
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
					 KETERANGAN MANFAAT ASURANSI 
				</th>
			</tr>
			</thead>
			<tbody>
				<?php
				foreach ($query5->result_array() as $row)
				{	
				?>	
					<tr>
						<td align="justify" valign="top" style="font-size:18px" width="180px"><?=$row['NAMA'];?></td>
						<td align="justify" valign="top" style="font-size:18px"><?=$row['DESKRIPSI'];?></td>						
					</tr>	
				<?php						
				}
				?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<br>
<br>
<br><hr>

			
<div class="row">
	<div class="col-md-12">
			<span style="margin-left:2em">
			<a href="#" onClick="popitup('<?=base_url('jspromapankakehanberubah/CetakPDF?build_id='.$buildid.'&filepdf='.$filepdf.'&kodeprospek='.$kodeprospek);?>')">
			<!--					<a target="_blank" href="<?= base_url().'files/pdf/'.$hasil['filepdf'].'.pdf'; ?>" class="btn green button-submit">-->
				 Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
			</a>
			</span>
			
			<br>
			<br>
			<span style="margin-left:2em">
				<a href="https://jaim.jiwasraya.co.id/prospek/proposal-pribadi?id=<?=$kodeprospek;?>" />
			<!--					<a target="_blank" href="<?= base_url().'files/pdf/'.$hasil['filepdf'].'.pdf'; ?>" class="btn green button-submit">-->
					 Buat Proposal Kembali  <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</span>
	</div>
</div>

</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->

<script>


function popitup(url) {
	newwindow=window.open(url,'name','height=850,width=1200, menubar=no, scrollbars=no, resizable=yes, copyhistory=no,');
	if (window.focus) {newwindow.focus()}
	return false;
}


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