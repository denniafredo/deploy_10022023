<?php
	$buildid = $_GET['buildid'];
	$filepdf = $_GET['filepdf'];
	$kodeprospek = $_GET['kodeprospek'];

	$sql = "select A.*,
				(SELECT NAMAPEKERJAAN FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) NAMA_PEKERJAAN_CPP,
				(SELECT LIFEEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRALIFE_CPP,
				(SELECT PAEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRAPA_CPP,
				(SELECT TPDEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRATPD_CPP	
			from PRO_PEMPOL A 
			where build_id = '".$buildid."'";
	$query = $this->db->query($sql);

	$sql2 = "select B.*, 
				(SELECT NAMAPEKERJAAN FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= B.KDJNSPEKERJAAN) NAMA_PEKERJAAN_CTT,
				(SELECT LIFEEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= B.KDJNSPEKERJAAN) EKSTRALIFE_CTT,
				(SELECT PAEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= B.KDJNSPEKERJAAN) EKSTRAPA_CTT,
				(SELECT TPDEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= B.KDJNSPEKERJAAN) EKSTRATPD_CTT	
			from PRO_TERTANGGUNG B
			where build_id = '".$buildid."'";
	$query2 = $this->db->query($sql2);

	foreach ($query2->result_array() as $rows){
		$usiactt		= $rows['USIA_TH'];
		$usiawpdanspuse = min(65, (65-$usiactt));
		$usiapayor 		= max(0, (25-$usiactt));
	}

	$sqlrawpsp = "SELECT * FROM JAIM_400_RESIKO_AWAL WHERE npert = '$usiawpdanspuse'";
	$queryrawpsp = $this->db->query($sqlrawpsp);
	foreach ($queryrawpsp->result_array() as $rows){
		$tarifwpdanspuse = str_replace(',', '.', $rows['TARIF']);
	}

	if($usiapayor==0){
		$tarifpayor = 0;
	}else{
		$sqlrapb = 'SELECT * FROM JAIM_400_RESIKO_AWAL WHERE npert = '.$usiapayor;
		$queryrapb = $this->db->query($sqlrapb);
		foreach ($queryrapb->result_array() as $rows){
			$tarifpayor = str_replace(',', '.', $rows['TARIF']);
		}	
	}

	$sql3 = "select * from PRO_ASURANSI_POKOK where build_id = '".$buildid."'";
	$query3 = $this->db->query($sql3);

	$sql4 = "SELECT
				BUILD_ID,
				NAMA_ALOKASI1 AS JENIS_ALOKASI,
				(SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1) NAMA_ALOKASI1,
				ALOKASI1,
				(SELECT LOWPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1) BUNGA_RENDAH1,
				(SELECT MEDIUMPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1) BUNGA_SEDANG1,
				(SELECT HIGHPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1) BUNGA_TINGGI1,
				NAMA_ALOKASI2 AS JENIS_ALOKASI2,
				(SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2) NAMA_ALOKASI2,
				ALOKASI2,
				(SELECT LOWPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2) BUNGA_RENDAH2,
				(SELECT MEDIUMPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2) BUNGA_SEDANG2,
				(SELECT HIGHPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2) BUNGA_TINGGI2
			FROM PRO_ALOKASI_DANA_NEW A 
			WHERE a.BUILD_ID = '".$buildid."'";
	$query4 = $this->db->query($sql4);

	$sql5 = "select * from JAIM.PRO_DATA_RIDER_NEW where build_id = '".$buildid."'";
	$query5 = $this->db->query($sql5);

	$sql6 = "SELECT B.JENIS,NAMA,DESKRIPSI,URUT,SU,B.BUILD_ID,B.NILAI UA
            FROM PRO_REDAKSI A, PRO_JUA B
            WHERE a.jenis = b.jenis
            and b.build_id = '".$buildid."' 
            and b.nilai > 0
         order by urut";
    $query6 = $this->db->query($sql6);

	$sql11 = "SELECT *
	          FROM PRO_REDAKSI_PEMERIKSAAN
	          WHERE JENIS_PEMERIKSAAN = (select PEMERIKSAAN from PRO_ASURANSI_POKOK where build_id = '$buildid') ";
	$query11 = $this->db->query($sql11);

	//UNTUK MENGHAPUS DATA ILUSTRASI INVESTASI JIKA SEBELUMNYA ADA
	$sqlcek = "SELECT * FROM JAIM.PRO_TOTAL_INVESTASI1 WHERE build_id= '$buildid' ";
	$querycek = $this->db->query($sqlcek);
	$jml_row = $querycek->num_rows;
	if($jml_row == 0){
		
	}else{
		$sqldel = "DELETE FROM JAIM.PRO_TOTAL_INVESTASI1 WHERE build_id= '$buildid' ";
		$querydel = $this->db->query($sqldel);
	}

	//UNTUK MENGHAPUS DATA PRO JUA NEW JIKA SEBELUMNYA ADA
	$sqlcekprojua = "SELECT * FROM JAIM.PRO_JUA_NEW WHERE build_id= '$buildid' ";
	$querycekprojua = $this->db->query($sqlcekprojua);
	$jml_row_pro_jua = $querycekprojua->num_rows;
	if($jml_row_pro_jua == 0){

	}else{
		$sqldelprojua = "DELETE FROM JAIM.PRO_JUA_NEW WHERE build_id= '$buildid' ";
		$querydelprojua = $this->db->query($sqldelprojua);
	}

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
				 <h4>PT. ASURANSI JIWA IFG</h4>
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
				IFG ULTIMATE PROTECTION
			</div>
		</div>
	 </div>
	<hr/>
	<div class="row">
		<div class="col-xs-12">			
			<?php
				foreach ($query->result_array() as $row)
				{
					$usia_cpp = $row['USIA_TH'];
					$jeniskelamincpp = $row['JENIS_KELAMIN'];
					$nilaiekstrapremilife_cpp = $row['EKSTRALIFE_CPP'];
					$nilaiekstrapremipa_cpp = $row['EKSTRAPA_CPP'];
					$nilaiekstrapremitpd_cpp = $row['EKSTRATPD_CPP'];
					if($nilaiekstrapremilife_cpp !=0){
						$tandaextrapremi_life_cpp = '*';
					}else{
						$tandaextrapremi_life_cpp = '';
					}
					if($nilaiekstrapremipa_cpp !=0){
						$tandaextrapremi_pa_cpp = '*';
					}else{
						$tandaextrapremi_pa_cpp = '';
					}
					if($nilaiekstrapremitpd_cpp !=0){
						$tandaextrapremi_tpd_cpp = '*';
					}else{
						$tandaextrapremi_tpd_cpp = '';
					}
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
							<td align="left" style="font-size:18px"><?=($row['JENIS_KELAMIN'] == 'M' ? 'Laki-Laki' : 'Perempuan');?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Status Perokok </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=($row['IS_PEROKOK'] == 'T' ? 'Tidak' : 'Ya');?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Jenis Pekerjaan </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=ucwords(strtolower($row['NAMA_PEKERJAAN_CPP']));?></td>						
						</tr>
					<tbody>
				</table>
			</div>			
			<?php
				}

				/* Fungsi untuk menyimpan extra resiko CPP - Teguh 24/03/2020 */
				$sqli_cpp= "INSERT INTO JAIM.PRO_EXTRA_RESIKO
									(BUILD_ID, STATUS, LIFEEXTRA, PAEXTRA, TPDEXTRA, TGLREKAM)
								VALUES
									('$buildid', 'CPP', '$nilaiekstrapremilife_cpp', '$nilaiekstrapremipa_cpp', '$nilaiekstrapremitpd_cpp', SYSDATE)";
				$queryinsert = $this->db->query($sqli_cpp);
				/* End */
			?>							
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<?php
				foreach ($query2->result_array() as $row)
				{
					$usia_ctt = $row['USIA_TH'];
					$jeniskelaminctt = $row['JENIS_KELAMIN'];
					$perokokcalontertanggung = $row['IS_PEROKOK'];
					$nilaiekstrapremilife_ctt = $row['EKSTRALIFE_CTT'];
					if($nilaiekstrapremilife_ctt !=0){
						$tandaextrapremi_life = '*';
					}else{
						$tandaextrapremi_life = '';
					}
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
							<td align="left" style="font-size:18px"><?=($row['JENIS_KELAMIN'] == 'M' ? 'Laki-Laki' : 'Perempuan');?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Status Perokok </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=($row['IS_PEROKOK'] == 'T' ? 'Tidak' : 'Ya');?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Jenis Pekerjaan </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=ucwords(strtolower($row['NAMA_PEKERJAAN_CTT']));?></td>						
						</tr>
					<tbody>
				</table>
			</div>			
			<?php
				}

				/* Fungsi untuk menyimpan extra resiko CTT - Teguh 24/03/2020 */
				$sqli_ctt= "INSERT INTO JAIM.PRO_EXTRA_RESIKO
									(BUILD_ID, STATUS, LIFEEXTRA, TGLREKAM)
								VALUES
									('$buildid', 'CTT', '$nilaiekstrapremilife_ctt', SYSDATE)";
				$queryinsert = $this->db->query($sqli_ctt);
				/* End */
			?>							
		</div>
	</div>			
	<hr>
	<div class="row">
		<div class="col-xs-12">			
			<?php
				foreach ($query3->result_array() as $row)
				{
					$total_premi	= $row['PREMI_BERKALA'];
					$premi_dasar_input    = $row['PREMI_BERKALA'];
					$carabayar 		= $row['CARA_BAYAR'];
					$topup_sekaligus= $row['TOPUP_SEKALIGUS'];
					$periode_topup_sekaligus = $row['PERIODE_TOPUP'];
					$makstopup		= $usia_ctt + $periode_topup_sekaligus;
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
								$row['CARA_BAYAR'] = 'Sekaligus';
								$pembagi = 12;
							?>					
							<td align="left" style="font-size:18px" width="60px">&nbsp;&nbsp;<?=$row['CARA_BAYAR'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Uang Pertanggungan </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['UA'],0,',','.');?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Premi Dasar </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px">&nbsp;&nbsp;<?= number_format($row['PREMI_BERKALA'],0,',','.');?></td>						
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
							//Alokasi Jenis Fund Pertama
							$alokasi1 		= str_replace(',','.',$row['ALOKASI1']);
							$bunga_rendah	= str_replace(',','.',$row['BUNGA_RENDAH1']);
							$bunga_sedang	= str_replace(',','.',$row['BUNGA_SEDANG1']);
							$bunga_tinggi	= str_replace(',','.',$row['BUNGA_TINGGI1']);
							//Alokasi Jenis Fund Kedua
							$alokasi2 		= str_replace(',','.',$row['ALOKASI2']);
							$bunga_rendah2	= str_replace(',','.',$row['BUNGA_RENDAH2']);
							$bunga_sedang2	= str_replace(',','.',$row['BUNGA_SEDANG2']);
							$bunga_tinggi2	= str_replace(',','.',$row['BUNGA_TINGGI2']);
						?>		
							<?php
								if ($row['NAMA_ALOKASI1'] != '')
								{	
							?>
							<tr>
								<td align="justify" style="font-size:18px" width="50px"><?=$row['NAMA_ALOKASI1'];?></td>
								<td align="center" style="font-size:18px" width="1px">:</td>
								<td align="left" style="font-size:18px" width="30px">
									<?php echo str_replace(',','.',$row['ALOKASI1'])*100;?>%
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
									<?php echo str_replace(',','.',$row['ALOKASI2'])*100;?>%
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
							$ua_dasar	= $row['UADASAR'];

							if($row['IS_UADASAR']==1){
								echo "<tr>
										<td>Asuransi Dasar ".$tandaextrapremi_life."</td>
										<td align='center'>99</td>
										<td align='right'>".number_format($row['UADASAR'],0,',','.')."</td>
										<td align='right'>".number_format($row['BIAYA_UADASAR'],0,',','.')."</td>
										<td align='center'>100%</td>
										<td align='right'>".number_format($row['UADASAR'],0,',','.')."</td>
									</tr>";
								// $sqlinsertdasar = "
								// 			INSERT ALL
								// 				INTO JAIM.PRO_JUA_NEW (BUILD_ID, KDPRODUK, KDBENEFIT, PREMI, NILAIBENEFIT, KDJENISBENEFIT)
							 // 					VALUES ('$buildid', 'JL4BLN', 'DEATHMA', $premi_dasar_input, ".$row['UADASAR'].", 'W')
							 // 					INTO JAIM.PRO_JUA_NEW (BUILD_ID, KDPRODUK, KDBENEFIT, PREMI, NILAIBENEFIT, KDJENISBENEFIT)
							 // 					VALUES ('$buildid', 'JL4BLN', 'COSADMJL', '', '', 'W')
							 // 					INTO JAIM.PRO_JUA_NEW (BUILD_ID, KDPRODUK, KDBENEFIT, PREMI, NILAIBENEFIT, KDJENISBENEFIT)
							 // 					VALUES ('$buildid', 'JL4BLN', 'COA', '', '', 'I')
							 // 					INTO JAIM.PRO_JUA_NEW (BUILD_ID, KDPRODUK, KDBENEFIT, PREMI, NILAIBENEFIT, KDJENISBENEFIT)
							 // 					VALUES ('$buildid', 'JL4BLN', 'COI', '', '', 'I')
							 // 					INTO JAIM.PRO_JUA_NEW (BUILD_ID, KDPRODUK, KDBENEFIT, PREMI, NILAIBENEFIT, KDJENISBENEFIT)
							 // 					VALUES ('$buildid', 'JL4BLN', 'BNFTOPUP', $premi_topup_input, '', 'T')
							 // 				SELECT * FROM DUAL";
								// $queryinsertdasar = $this->db->query($sqlinsertdasar);
							}
							

							$total_ua = $row['UADASAR'];
							$total_ra = $row['UADASAR'];
							$total_ra_pp = 0;
						?>	

						<?php
						}
						?>
						<tr>
							<td align='center' colspan="2" style="background-color: yellow"><b>TOTAL RESIKO AWAL CALON TERTANGGUNG</b></td>
							<td align='right' rowspan="2"><?php echo number_format($total_ua,0,',','.');?></td>
							<td align='right' rowspan="2"><?php echo number_format($total_biaya_new,0,',','.');?></td>
							<td align='center' rowspan="2"></td>
							<td align='right' style="background-color: yellow"><b><?php echo number_format($total_ra,0,',','.');?></b></td>
						</tr>
						<tr>
							<td align='center' colspan="2" style="background-color: orange"><b>TOTAL RESIKO AWAL CALON PEMEGANG POLIS</b></td>
							<td align='right' style="background-color: orange"><b><?php echo number_format($total_ra_pp,0,',','.');?></b></td>
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
<!--							<td align="center" style="font-size:18px;font-weight:bold; " width="30px">ID</td>-->
								<td align="center" style="font-size:18px;font-weight:bold; " width="30px">PEMERIKSAAN</td>								
							</tr>
						
							<tr>
								<?php
									foreach ($query11->result_array() as $row)
								{	
								?>	
	<!--							<td align="center" style="font-size:18px" width="30px"><?=$row['ID'];?></td>-->
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
											echo "<i>HbsAg*) Langsung dilakukan pemeriksaan HbeAg apabila hasil HbsAg adalah positif</i>";
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
							foreach ($query6->result_array() as $row)
								{
									echo "<tr>
											<td width='20%' align='justify'>".$row['NAMA']."</td>
											<td align='justify'>
												Apabila Tertanggung mencapai usia 99 Tahun, manfaat yang dibayarkan adalah besar Nilai Investasi (Jumlah Unit x NAB). Apabila Tertanggung meninggal dunia dalam masa perjanjian Asuransi baik karena sakit atau karena kecelakaan, maka kepada ahli waris atau yang ditunjuk dibayarkan Uang Asuransi IFG ULTIMATE PROTECTION ditambah Saldo Dana Investasi.
											</td>
										</tr>";
								}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<br><br><br><hr>
		<table class="table table-responsive-sm table-bordered">
                          <!-- <tr>
                            <th>Tahun Ke</th>
                            <th>Usia CTT</th>
                            <th>Usia CPP</th>
                            <th>Bulan Ke</th>
                            <th>Akuisisi Premi Dasar</th>
							<th>Akuisisi Top Up X</th>	
                            <th>Alokasi Premi Dasar</th>
                            <th>Alokasi Topup X</th>
                            <th>Akumulasi</th>
                            <th>COA</th>
                            <th>COI</th>
                            <th>TOTAL BIAYA</th>
                            <th>
                            	Investasi - Rendah 01
                            	</br><?php echo $bunga_rendah;?>
                            </th>
                            <th>
                            	Investasi - Sedang 01
                            	</br><?php echo $bunga_sedang;?>
                            </th>
                            <th>
                            	Investasi - Tinggi 01
                            	</br><?php echo $bunga_tinggi;?>
                            </th>
                            <th>
                            	Investasi - Rendah 02
                            	</br><?php echo $bunga_rendah2;?>
                            </th>
                            <th>
                            	Investasi - Sedang 02
                            	</br><?php echo $bunga_sedang2;?>
                            </th>
                            <th>
                            	Investasi - Tinggi 02
                            	</br><?php echo $bunga_tinggi2;?>
                            </th>
                            <th>Investasi - Rendah</th>
                            <th>Investasi - Sedang</th>
                            <th>Investasi - Tinggi</th>
                            <th>Meninggal - Rendah</th>
                            <th>Meninggal - Sedang</th>
                            <th>Meninggal - Tinggi</th>
                          </tr-->
		<!-- Fungsi Untuk Menghitung Ilustasi -->
			<?php
				$coa = 27500;
				$usia= $usia_ctt;
				$premi_dasar=$premi_dasar_input;
				//$topup_dasar=$premi_topup_input;
				$tahun_ke = 1;
 
				while($usia <= 99) {

					$sqltarif = "select * from JAIM.JAIM_300_TARIF_PROIDAMAN where usia = '$usia'";
					$querytarif = $this->db->query($sqltarif);
					foreach ($querytarif->result_array() as $tarif){
						// Mencari tarif untuk UA DASAR dan RIDER TERM
						if($perokokcalontertanggung == 'T'){
							$tariftermlife = str_replace(',', '.', $tarif['TERMLIFE_NONSMOKER']);
						}else{
							$tariftermlife = str_replace(',', '.', $tarif['TERMLIFE_SMOKER']);
						}
					}

					for ($y = 1; $y <= 12; $y++) {
						$biaya_coa 		= $coa;
						// $biaya_dasar	= $ua_dasar * $tariftermlife / 12 / 1000 * (1 + ($nilaiekstrapremilife_ctt/1000));
						$biaya_dasar	= $ua_dasar * ($nilaiekstrapremilife_ctt + $tariftermlife) / 12 / 1000;
						$total_biaya	= $biaya_coa + $biaya_dasar;

						if($y==12){
							$background = "style='background-color: yellow'";
							if($usia < $makstopup){
								$topup_x= $topup_sekaligus;
							}else{
								$topup_x = 0;
							}

							if($tahun_ke == 1){
								$premi_dasar_input = $premi_dasar;
							}else{
								$premi_dasar_input = 0;
							}
						}else{
							$topup_x = 0;
							$background = "";

						}

						if($y==1){
							if($usia < $makstopup){
								$akuisisi_topup_x = 0.05*$topup_sekaligus;
								$alokasi_topup_x = 0.95*$topup_sekaligus;
							}else{
								$akuisisi_topup_x = 0;
								$alokasi_topup_x = 0;
							}
						}else{
							$akuisisi_topup_x = 0;
							$alokasi_topup_x = 0;
						}

						if($tahun_ke == 1 && $y==1){
							$akuisisi_premi_dasar = 0.05*$premi_dasar;
							$alokasi_premi_dasar = 0.95*$premi_dasar;
						}else{
							$akuisisi_premi_dasar = 0;
							$alokasi_premi_dasar = 0;
						}

						$biaya_dasar	= $ua_dasar * $tariftermlife / 12 / 1000 * (1 + ($nilaiekstrapremilife_ctt/1000));
						$total_biaya	= $biaya_coa + $biaya_dasar;

						$alokasi_total = $alokasi_premi_dasar + $alokasi_topup_x;
						if($tahun_ke == 1 && $y==1){
							$akumulasi = 0;
							$akumulasi_total = $akumulasi + $alokasi_total;
							$akumulasi = $akumulasi_total;

							$investasi_rendah = (($alokasi_total - $total_biaya) * (pow((1+$bunga_rendah),(1/12))) * $alokasi1) + (($alokasi_total - $total_biaya) * (pow((1+$bunga_rendah2),(1/12))) * $alokasi2);
							$investasi_sedang = (($alokasi_total - $total_biaya) * (pow((1+$bunga_sedang),(1/12))) * $alokasi1) + (($alokasi_total - $total_biaya) * (pow((1+$bunga_sedang2),(1/12))) * $alokasi2);
							$investasi_tinggi = (($alokasi_total - $total_biaya) * (pow((1+$bunga_tinggi),(1/12))) * $alokasi1) + (($alokasi_total - $total_biaya) * (pow((1+$bunga_tinggi2),(1/12))) * $alokasi2);
							$hasil_invetasi_rendah_old = $investasi_rendah;
							$hasil_invetasi_sedang_old = $investasi_sedang;
							$hasil_invetasi_tinggi_old = $investasi_tinggi;
							
							//Pengecekan ilustrasi SAJA
							$investasi_rendah01 = ($alokasi_total - $total_biaya) * $alokasi1 * (pow((1+$bunga_rendah),(1/12)));
							$investasi_sedang01 = ($alokasi_total - $total_biaya) * $alokasi1 * (pow((1+$bunga_sedang),(1/12)));
							$investasi_tinggi01 = ($alokasi_total - $total_biaya) * $alokasi1 * (pow((1+$bunga_tinggi),(1/12)));
							$investasi_rendah02 = ($alokasi_total - $total_biaya) * $alokasi2 * (pow((1+$bunga_rendah2),(1/12)));
							$investasi_sedang02 = ($alokasi_total - $total_biaya) * $alokasi2 * (pow((1+$bunga_sedang2),(1/12)));
							$investasi_tinggi02 = ($alokasi_total - $total_biaya) * $alokasi2 * (pow((1+$bunga_tinggi2),(1/12)));

							$hasil_invetasi_rendah_old01 = $investasi_rendah01;
							$hasil_invetasi_sedang_old01 = $investasi_sedang01;
							$hasil_invetasi_tinggi_old01 = $investasi_tinggi01;
							$hasil_invetasi_rendah_old02 = $investasi_rendah02;
							$hasil_invetasi_sedang_old02 = $investasi_sedang02;
							$hasil_invetasi_tinggi_old02 = $investasi_tinggi02;
							//End Pengecekan

							if($investasi_rendah < 0){
								$meninggal_rendah = 0;
							}else{
								$meninggal_rendah = $ua_dasar + $investasi_rendah;	
							}
							if($investasi_sedang < 0){
								$meninggal_sedang =0;
							}else{
								$meninggal_sedang = $ua_dasar + $investasi_sedang;
							}
							if($investasi_tinggi < 0){
								$meninggal_tinggi = 0;
							}else{
								$meninggal_tinggi = $ua_dasar + $investasi_tinggi;
							}
						}else{
							$akumulasi_total = $akumulasi + $alokasi_total;
							$akumulasi = $akumulasi_total;

							$investasi_rendah = ($hasil_invetasi_rendah_old01 + (($alokasi_total-$total_biaya) * $alokasi1)) * (pow((1+$bunga_rendah),(1/12))) + ($hasil_invetasi_rendah_old02 + (($alokasi_total-$total_biaya) * $alokasi2)) * (pow((1+$bunga_rendah2),(1/12)));
							$investasi_sedang = ($hasil_invetasi_sedang_old01 + (($alokasi_total-$total_biaya) * $alokasi1)) * (pow((1+$bunga_sedang),(1/12))) + ($hasil_invetasi_sedang_old02 + (($alokasi_total-$total_biaya) * $alokasi2)) * (pow((1+$bunga_sedang2),(1/12)));
							$investasi_tinggi = ($hasil_invetasi_tinggi_old01 + (($alokasi_total-$total_biaya) * $alokasi1)) * (pow((1+$bunga_tinggi),(1/12))) + ($hasil_invetasi_tinggi_old02 + (($alokasi_total-$total_biaya) * $alokasi2)) * (pow((1+$bunga_tinggi2),(1/12)));

							$hasil_invetasi_rendah_old = $investasi_rendah;
							$hasil_invetasi_sedang_old = $investasi_sedang;
							$hasil_invetasi_tinggi_old = $investasi_tinggi;

							//Pengecekan ilustrasi SAJA
							$investasi_rendah01 = ($hasil_invetasi_rendah_old01 + (($alokasi_total-$total_biaya) * $alokasi1)) * (pow((1+$bunga_rendah),(1/12)));
							$investasi_sedang01 = ($hasil_invetasi_sedang_old01 + (($alokasi_total-$total_biaya) * $alokasi1)) * (pow((1+$bunga_sedang),(1/12)));
							$investasi_tinggi01 = ($hasil_invetasi_tinggi_old01 + (($alokasi_total-$total_biaya) * $alokasi1)) * (pow((1+$bunga_tinggi),(1/12)));
							$investasi_rendah02 = ($hasil_invetasi_rendah_old02 + (($alokasi_total-$total_biaya) * $alokasi2)) * (pow((1+$bunga_rendah2),(1/12)));
							$investasi_sedang02 = ($hasil_invetasi_sedang_old02 + (($alokasi_total-$total_biaya) * $alokasi2)) * (pow((1+$bunga_sedang2),(1/12)));
							$investasi_tinggi02 = ($hasil_invetasi_tinggi_old02 + (($alokasi_total-$total_biaya) * $alokasi2)) * (pow((1+$bunga_tinggi2),(1/12)));

							$hasil_invetasi_rendah_old01 = $investasi_rendah01;
							$hasil_invetasi_sedang_old01 = $investasi_sedang01;
							$hasil_invetasi_tinggi_old01 = $investasi_tinggi01;
							$hasil_invetasi_rendah_old02 = $investasi_rendah02;
							$hasil_invetasi_sedang_old02 = $investasi_sedang02;
							$hasil_invetasi_tinggi_old02 = $investasi_tinggi02;
							//End Pengecekan

							if($investasi_rendah < 0){
								$meninggal_rendah = 0;
							}else{
								$meninggal_rendah = $ua_dasar + $investasi_rendah;	
							}
							if($investasi_sedang < 0){
								$meninggal_sedang =0;
							}else{
								$meninggal_sedang = $ua_dasar + $investasi_sedang;
							}
							if($investasi_tinggi < 0){
								$meninggal_tinggi = 0;
							}else{
								$meninggal_tinggi = $ua_dasar + $investasi_tinggi;
							}
						}

						// echo "<tr ".$background.">";
						// 			echo "<td>$tahun_ke</td> ";
						// 			echo "<td>$usia</td>";
						// 			echo "<td>$usia_cpp</td>";
						// 			echo "<td>$y</td>";    
						// 			echo "<td> $akuisisi_premi_dasar </td>";
						// 			echo "<td> $akuisisi_topup_x </td>";
						// 			echo "<td> $alokasi_premi_dasar </td>";
						// 			echo "<td> $alokasi_topup_x </td>";
						// 			echo "<td> $akumulasi_total </td>";
						// 			echo "<td> $biaya_coa</td>";
						// 			echo "<td> ".round($biaya_dasar)."</td>";
						// 			echo "<td> ".round($total_biaya)." </td>";

						// 			echo "<td> ".($investasi_rendah01) ."</td>";
						// 			echo "<td> ".($investasi_sedang01)." </td>";
						// 			echo "<td> ".($investasi_tinggi01)." </td>";
						// 			echo "<td> ".($investasi_rendah02) ."</td>";
						// 			echo "<td> ".($investasi_sedang02)." </td>";
						// 			echo "<td> ".($investasi_tinggi02)." </td>";

						// 			echo "<td> ".round($investasi_rendah) ."</td>";
						// 			echo "<td> ".round($investasi_sedang)." </td>";
						// 			echo "<td> ".round($investasi_tinggi)." </td>";
						// 			echo "<td> ".round($meninggal_rendah) ."</td>";
						// 			echo "<td> ".round($meninggal_sedang)." </td>";
						// 			echo "<td> ".round($meninggal_tinggi)." </td>";
						// 		  echo "</tr>";
						if($y==12){
							$premi_dasar_insert = $premi_dasar_input/1000;
							$topup_sekaligus_insert = $topup_x/1000;
							$invlow 	= $investasi_rendah/1000;
							$invmed 	= $investasi_sedang/1000;
							$invhigh 	= $investasi_tinggi/1000;
							$juainvlow 	= $meninggal_rendah/1000;
							$juainvmed 	= $meninggal_sedang/1000;
							$juainvhigh = $meninggal_tinggi/1000;
							$sqlinsert = "insert into JAIM.PRO_TOTAL_INVESTASI1
											(BUILD_ID, TAHUN, PREMI, TOPUPX, INVLOW, INVMED, INVHIGH, JUAINVLOW, JUAINVMED, JUAINVHIGH, USIA_TT)
							 				Values
							 				('$buildid', $tahun_ke, $premi_dasar_insert, $topup_sekaligus_insert, $invlow, $invmed, $invhigh, $juainvlow, $juainvmed, $juainvhigh, $usia) ";
							//echo $sqlinsert; echo "</br>";
							$queryinsert = $this->db->query($sqlinsert);
						}else{

						}
								  
					}
					$usia++;
					$usia_cpp++;
					$tahun_ke++;
				} 
			?>
			
	<div class="row">
		<div class="col-md-12">
			<span style="margin-left:2em">
				<a href='#' onClick="popitup('<?=base_url('jsproidaman_new/CetakPDF?build_id='.$buildid.'&filepdf='.$filepdf.'&kodeprospek='.$kodeprospek);?>')">
				 Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
				</a>
			</span>
				
			<br><br>
			<span style="margin-left:2em">
				<a href="<?=str_replace('simulasi/', '', base_url("prospek/proposal?id=$prospek[NO_KTP]"));?>" />
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
	

}

</script>