<script type="text/javascript" src="<?= base_url();?>assets/plugins/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/plugins/loadingoverlay.min.js"></script>
<script type="text/javascript">
	function Popitup(url) {
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
	
	function Back(noid) {
		$.LoadingOverlay("show");
		
		window.location.href = '<?=str_replace("simulasi/","",base_url("prospek/proposal?id="));?>'+noid;
	}
</script>

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
				 <h4>PT. ASURANSI JIWA IFG LIFE</h4>
			</p>
		</div>
		Graha CIMB Niaga Lt. 21, Jl. Jend. Sudirman Kav 58 Jakarta - 12190
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
	&nbsp;
	<div class="row" align="center">
		<div class="col-xs-12">
			<input id="buildid" name="buildid" value="<?=$_GET['buildid'] ?>" style="display: none"></input>
			<div class="well" style="font-weight:bold;font-size:16px">
				<?=strtoupper(strtolower($pos['NAMAPRODUK']))?>
			</div>
		</div>
	 </div>
	<hr/>
	<div class="row">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:18px">
				CALON PEMEGANG POLIS
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" width="100%">			
					<tbody>
						<tr>
							<td align="justify" style="font-size:18px" width="20%">Nama Pemegang Polis </td>
							<td align="center" style="font-size:18px" width="10px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCPP']]['NAMAKLIEN'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Tanggal Lahir </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCPP']]['TGLLAHIR'];?></td>
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Jenis Kelamin </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCPP']]['NAMAJENISKELAMIN'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Pekerjaan </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCPP']]['NAMAPEKERJAAN'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Hobi </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCPP']]['NAMAHOBI'];?></td>						
						</tr>
					<tbody>
				</table>
			</div>						
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:18px">
				CALON TERTANGGUNG
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" width="100%">			
					<tbody>
						<tr>
							<td align="justify" style="font-size:18px" width="20%">Nama Tertanggung </td>
							<td align="center" style="font-size:18px" width="10px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCTT']]['NAMAKLIEN'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Tanggal Lahir </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCTT']]['TGLLAHIR'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Jenis Kelamin </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCTT']]['NAMAJENISKELAMIN'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Pekerjaan </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCTT']]['NAMAPEKERJAAN'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Hobi </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?=$pos[$pos['NOCTT']]['NAMAHOBI'];?></td>						
						</tr>
					<tbody>
				</table>
			</div>					
		</div>
	</div>			
	<hr>
	<div class="row">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:18px">
				DATA PERTANGGUNGAN
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" width="100%">			
					<tbody>
						<tr>
							<td align="justify" style="font-size:18px" width="20%">Cara Bayar </td>
							<td align="center" style="font-size:18px" width="10px">:</td>
							<td align="left" style="font-size:18px"><?=$pos['NAMACARABAYAR'];?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Uang Pertanggungan </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?= number_format($pos['JUA'],0,',','.');?></td>						
						</tr>
						<tr>
							<td align="justify" style="font-size:18px">Premi </td>
							<td align="center" style="font-size:18px">:</td>
							<td align="left" style="font-size:18px"><?= number_format($pos['PREMI'],0,',','.');?></td>						
						</tr>					
					<tbody>
				</table>
			</div>					
		</div>
	</div>
</div>

<br><br><br><hr>
			
<div class="row">
	<div class="col-md-12">
		<span style="margin-left:2em">
			<a href='javascript:void(0);' onClick="Popitup('<?=base_url("cetak?buildid=$pos[BUILDID]")?>')">
			 Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
			</a>
		</span>
			
		<br><br>
		<span style="margin-left:2em">
			<a href="javascript:void(0)" onclick="Back('<?=$pos['NOID']?>');" />
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