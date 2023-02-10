<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
                                                    <h4 class="block">Calon Pemegang Polis</h4>
														<div class="form-group">
  <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span> </label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="calonpemegangpolisperokok" id="calonpemegangpolisperokok" onChange="">
                                          <option value="Tidak">Tidak</option>
                                          		<option value="Ya">Ya</option>
												<option value="">Pilih...</option>	
											</select>
										</div>
									</div>
                                                        
													</div>
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

<h4 class="block">Calon Tertanggung</h4>
															
                                            <br>
        <div class="form-group">
          <label class="control-label col-md-4">Nama Tertanggung <span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namalengkapcalontertanggung" id="namalengkapcalontertanggung" placeholder="Nama Tertanggung"/>
														<span class="help-block">
															 Masukkan Nama Tertanggung
														</span>
													</div>
		</div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-4">Jenis Kelamin <span class="required"> * </span></label>
                                                  <div class="col-md-3">
										  <select class="form-control select2me" name="jeniskelamincalontertanggung" id="jeniskelamincalontertanggung" onChange="">
												<option value="">Pilih Jenis Kelamin</option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
		</div>
                                    <div class="form-group">
                                      <label class="control-label col-md-4">Tanggal Lahir<span class="required"> * </span></label>
                                      <div class="col-md-4">
													  <input class="form-control form-control-inline input-xs date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir"/>
														<span class="help-block">
															 Masukkan Tanggal Lahir
														</span>
													</div>
		</div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span></label>
                                                  <div class="col-md-6">
										  <select class="form-control" name="calontertanggungperokok" id="calontertanggungperokok" onChange="">
                                          		<option value="Tidak">Tidak</option>
                                                						<option value="Ya">Ya</option>
												<option value="">Pilih...</option>
											</select>
										</div>
		</div>
                                    <div class="checkbox-list" data-error-container="#form_2_services_error">
												<label>
												<input type="checkbox" value="1" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onClick="checkedTertanggungSamaDenganPemegangPolis(this)"/> Tertanggung sama dengan Pemegang Polis </label>
		</div>    
                       
                       <br>									
</div>
													<!--/span-->
   		 </div>
    </div>
</div>

<h3 class="block" align="center">Asuransi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
														<div class="form-group">
														  <label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
														  <div class="col-md-6">
										  <select class="form-control select2me" name="carabayar" id="carabayar" onChange="">
                                          <option value="Sekaligus">Sekaligus</option>
												<option value="">[PILIH CARA BAYAR]</option>
											</select>
										</div>
									</div>
                                    <div class="form-group">
									  <label class="control-label col-md-4">Uang Pertanggungan <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Uang Pertanggungan" type="number" name="uangpertanggungan" id="uangpertanggungan" onchange="" value="15000000" readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
  <label class="control-label col-md-4">Mata Uang <span class="required"> * </span> </label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="matauang" id="matauang" onChange="">
                                                <option value="IDR">IDR</option>
											</select>
										</div>
									</div>
                                                        
													</div>
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">
															
                                            <br>
        <div class="form-group">
	<label class="control-label col-md-6">Premi Single
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-6">
		<div class="input-group">
			<input class="form-control input-xs" placeholder="Premi Single" type="number" name="premisingle" id="premisingle" onchange="onChangePremiSingle(this)" value="12000000">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-6">Top Up Single <span class="required"> * </span></label>
                                                  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control input-xs" placeholder="Top Up Single" type="number" name="topupsingle" id="topupsingle" onchange="onChangeTopUpSingle(this)" value="0">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-6">Bea Materai
	</label>
	<div class="col-md-6">
		<div class="input-group">
			<input class="form-control input-xs" placeholder="Bea Materai" type="number" name="beamaterai" id="beamaterai" onchange="onChangeBeaMaterai(this)" value="0" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>                                   
<div class="form-group">
  <label class="control-label col-md-6">Total Premi yang dibayar <span class="required"> * </span></label>
  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control input-xs" placeholder="Total Premi yang dibayar" type="number" name="totalpremiyangdibayar" id="totalpremiyangdibayar" onchange="" readonly value="12000000">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>                                               
                                        
                       
                       <br>									
</div>
													<!--/span-->
   		 </div>
    </div>
</div>

<h3 class="block" align="center">Alokasi Dana</h3>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								<thead>
								<tr role="row" class="heading">
									
									<th width="33%">
										 Persentase Alokasi Dana Investasi
									</th>
									<th width="33%">
										 
									</th>
									<th width="33%">
										 
									</th>
								</tr>
								<tr role="row" class="filter">
							
									<td>
												<p style="margin-top:5px">Alokasi Dana #1</p>
                                                <p style="margin-top:30px"> 
                                                Alokasi Dana #2</p>
                                               <td>
                                                <div class="form-group">
                                                  <div class="col-md-12">
										  <select class="form-control select2me" name="alokasidana1" id="alokasidana1" onChange="">
												<option value="">Pilih Alokasi Dana</option>
												<option value="JS LINK PASAR UANG">JS LINK PASAR UANG</option>
												<option value="JS LINK PENDAPATAN TETAP">JS LINK PENDAPATAN TETAP</option>
                                                <option value="JS LINK BERIMBANG">JS LINK BERIMBANG</option>
                                                <option value="JS LINK EKUITAS">JS LINK EKUITAS</option>
											</select>
										</div>
		</div>
                                                <div class="form-group">
                                                  <div class="col-md-12">
										  <select class="form-control select2me" name="alokasidana2" id="alokasidana2" onChange="">
												<option value="">Pilih Alokasi Dana</option>
												<option value="JS LINK PASAR UANG">JS LINK PASAR UANG</option>
												<option value="JS LINK PENDAPATAN TETAP">JS LINK PENDAPATAN TETAP</option>
                                                <option value="JS LINK BERIMBANG">JS LINK BERIMBANG</option>
                                                <option value="JS LINK EKUITAS">JS LINK EKUITAS</option>
											</select>
										</div>
		</div>
									</td>
									<td>
										<div class="input-group" style="margin-top:4px">
		= <input class="form-cntrol" placeholder="" type="number" name="persentasealokasidana1" id="persentasealokasidana1" onchange="onChangePersentaseAlokasiDana1(this)" value="100"> %
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
                                        <div class="input-group" style="margin-top:20px">
		= <input class="form-cntrol" placeholder="" type="number" name="persentasealokasidana2" id="persentasealokasidana2" onchange="onChangePersentaseAlokasiDana2(this)" value="0"> %
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>                     									</td>
								</tr>
								</thead>
</table>	
</div>						
<div align="left">
* Jika hanya  1 (satu) alokasi dana, maka yang diisi hanya satu alokasi
</div>
<br>



<script>
    jQuery(document).ready(function() {       
       // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
	   
	   $("#tanggallahircalontertangggung").change(function() {
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ( usiasekarang > 64)
			{
				alert('Usia maksimal Tertanggung adalah : 64 Tahun yang Anda masukan Usia :'+usiasekarang+' Tahun');
				$("#tanggallahircalontertangggung").val("");
				
			}
		});
    });  
	
	function checkedTertanggungSamaDenganPemegangPolis(input){
	$("#tertanggungsamadenganpemegangpolis").click(function() {
				
				if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
					document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
					document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
					document.getElementById("calontertanggungperokok").value = document.getElementById("calonpemegangpolisperokok").value;
					
				if (document.getElementById('gendernasabah').value == "M") {
				document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
				$('#jeniskelamincalontertanggung').trigger('change');
				}
				else if (document.getElementById('gendernasabah').value == "F") {
				document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
				$('#jeniskelamincalontertanggung').trigger('change');
				}
					 
				} else {
					document.getElementById("namalengkapcalontertanggung").value = ""; 
					document.getElementById("tanggallahircalontertangggung").value = ""; 
					document.getElementById("calontertanggungperokok").value = ""; 
					document.getElementById('jeniskelamincalontertanggung').value = "";
					$('#jeniskelamincalontertanggung').trigger('change');
				}
			});
	}
	
	function onChangePremiSingle(input){
		
		if (document.getElementById("premisingle").value < parseInt(12000000)) 
		{
			alert('Premi minimum untuk JS Pro Idaman adalah sebesar Rp. 12,000,000.00,-');
			document.getElementById("premisingle").value = parseInt(12000000);
		}
		else
			{
					document.getElementById("uangpertanggungan").value = parseInt(document.getElementById("premisingle").value * 125/100); 
					
					if (document.getElementById("topupsingle").value == "")
					{
					document.getElementById("totalpremiyangdibayar").value = parseInt(0);	
					}
					else if (document.getElementById("beamaterai").value == "")
					{
					document.getElementById("beamaterai").value = parseInt(0);	
					}
					
					document.getElementById("totalpremiyangdibayar").value = parseInt(document.getElementById("premisingle").value) + parseInt(document.getElementById("topupsingle").value) + parseInt(document.getElementById("beamaterai").value); 
			}
		}
		
		function onChangeTopUpSingle(input){
		
		if (((document.getElementById("topupsingle").value) < parseInt(1000000)) &&  ((document.getElementById("topupsingle").value) > parseInt(0)))
		{
			alert('Top Up minimum untuk JS Pro Idaman adalah sebesar Rp. 1,000,000.00,-');	
			document.getElementById("topupsingle").value = parseInt(0);
		}
		else
		{
		if (document.getElementById("topupsingle").value == "")
					{
					document.getElementById("totalpremiyangdibayar").value = parseInt(0);	
					}
					else if (document.getElementById("beamaterai").value == "")
					{
					document.getElementById("beamaterai").value = parseInt(0);	
					}
					
					document.getElementById("totalpremiyangdibayar").value = parseInt(document.getElementById("premisingle").value) + parseInt(document.getElementById("topupsingle").value) + parseInt(document.getElementById("beamaterai").value); 
		}
		}
		
		function onChangeBeaMaterai(input){
		
		if (document.getElementById("topupsingle").value == "")
					{
					document.getElementById("totalpremiyangdibayar").value = parseInt(0);	
					}
					else if (document.getElementById("beamaterai").value == "")
					{
					document.getElementById("beamaterai").value = parseInt(0);	
					}
					
					document.getElementById("totalpremiyangdibayar").value = parseInt(document.getElementById("premisingle").value) + parseInt(document.getElementById("topupsingle").value) + parseInt(document.getElementById("beamaterai").value); 
		}
		
		function onChangePersentaseAlokasiDana1(input){
		if (document.getElementById("persentasealokasidana1").value > 100)
		{
			alert('Jumlah persen tidak boleh melebihi 100%');
			document.getElementById("persentasealokasidana1").value = parseInt(100);	
		}
		else if (document.getElementById("persentasealokasidana1").value < 5)
		{
			alert('Jumlah persen tidak boleh kurang dari 5%');
			document.getElementById("persentasealokasidana1").value = parseInt(5);	
		}
		
		if (document.getElementById("persentasealokasidana1").value == "")
		{
		document.getElementById("persentasealokasidana1").value = parseInt(5);
		document.getElementById("persentasealokasidana2").value = parseInt(100 - document.getElementById("persentasealokasidana1").value);	
		}
		else
		{	
		document.getElementById("persentasealokasidana2").value = parseInt(100 - document.getElementById("persentasealokasidana1").value);
		}
	}
	
	function onChangePersentaseAlokasiDana2(input){
		if (document.getElementById("persentasealokasidana2").value > 100)
		{
			alert('Jumlah persen tidak boleh melebihi 100%');
			document.getElementById("persentasealokasidana2").value = parseInt(100);	
		}
		else if (document.getElementById("persentasealokasidana2").value < 5)
		{
			alert('Jumlah persen tidak boleh kurang dari 5%');
			document.getElementById("persentasealokasidana2").value = parseInt(5);	
		}
			
		if (document.getElementById("persentasealokasidana2").value == "")
		{
		document.getElementById("persentasealokasidana2").value = parseInt(0);	
		document.getElementById("persentasealokasidana1").value = parseInt(100 - document.getElementById("persentasealokasidana2").value);
		}
		else
		{	
		document.getElementById("persentasealokasidana1").value = parseInt(100 - document.getElementById("persentasealokasidana2").value);
		}
	}
		
</script>