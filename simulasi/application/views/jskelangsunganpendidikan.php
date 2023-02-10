<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

<h4 class="block">Calon Tertanggung</h4>
															
                                            <br>
                                            
        <div class="form-group">
          <label class="control-label col-md-4">Nama Calon Tertanggung <span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namalengkapcalontertanggung" id="namalengkapcalontertanggung" placeholder="Nama Lengkap"/>
														<span class="help-block">
															 Masukkan Nama Lengkap Calon Tertanggung
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
                                      <div class="col-md-6">
													  <input class="form-control form-control-inline input-xs date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" onChange=""/>
														<span class="help-block">
															 Masukkan Tanggal Lahir
														</span>
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
									  <label class="control-label col-md-4">SPP <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Jumlah SPP" name="spp" id="spp" onChange="" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Jumlah Risiko Awal <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
		  <input class="form-control" placeholder="Jumlah Risiko Awal" name="jumlahrisikoawaljskelangsunganpendidikan" id="jumlahrisikoawaljskelangsunganpendidikan" onchange="" readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Premi Sekaligus <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
		  <input class="form-control" placeholder="Premi Sekaligus" name="premisekaligusjskelangsunganpendidikan" id="premisekaligusjskelangsunganpendidikan" onchange="" readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-4">Masa Asuransi<span class="required">
		 *
	</span></label>
	
	<div class="col-md-4">
		<input class="form-control" placeholder="Masa Asuransi" type="number" name="masaasuransijskelangsunganpendidikan" id="masaasuransijskelangsunganpendidikan" onChange="" value="1">
		<span class="help-block">
			 Tahun
		</span>
        
        <span class="help-block" style="font-weight:bold;font-style:italic">
			 Minimal 1 Tahun dan maksimal 6 Tahun
		</span>
	</div>
</div>
        
        <div class="form-group">
  <label class="control-label col-md-4">Cara Bayar Premi<span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="carabayarpremijskelangsunganpendidikan" id="carabayarpremijskelangsunganpendidikan" onChange="onChangeCaraBayar(this)">
                                     <option value="">[Pilih Cara Bayar Premi]</option>
                                     <option value="Sekaligus">Sekaligus</option>     
											</select>
										</div>
									</div>
                                    
                                    <div class="form-group">
                                      <label class="control-label col-md-4">Saat Mulai Asuransi<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransi" name="saatmulaiasuransi" size="16" type="text" value="" placeholder="Saat Mulai Asuransi" onChange=""/>
													</div>
		</div>
													</div>
													<!--/span-->
													
</div>

<br>


<br>

<script>
jQuery(document).ready(function() {       
      // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
	   
		$("#tertanggungsamadenganpemegangpolis").click(function() {
		if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
					
					document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
					document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
					$('#tanggallahircalontertanggung').trigger('change');
					
					
				if (document.getElementById('gendernasabah').value == "M") {
				document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
				$('#jeniskelamincalontertanggung').trigger('change');
				}
				else if (document.getElementById('gendernasabah').value == "F") {
				document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
				$('#jeniskelamincalontertanggung').trigger('change');
				
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			//document.getElementById("minimalua").value = usiasekarang.value;
				}
					 
				} else {
					document.getElementById("namalengkapcalontertanggung").value = ""; 
					document.getElementById("tanggallahircalontertangggung").value = ""; 
					document.getElementById('jeniskelamincalontertanggung').value = "";
					$('#jeniskelamincalontertanggung').trigger('change');
					document.getElementById('carabayar').value = "";
					$('#carabayar').trigger('change');
				}	
	
		});
		
		$("#masaasuransijskelangsunganpendidikan").change(function() {
			var masaasuransijskelangsunganpendidikan = $("#masaasuransijskelangsunganpendidikan").val();
			
			var masaasuransi;
			
			if (masaasuransijskelangsunganpendidikan < 1)
			{	
				alert('Masa Asuransi Minimal 1 Tahun!');
				document.getElementById('masaasuransijskelangsunganpendidikan').value = 1;
			}
			else if (masaasuransijskelangsunganpendidikan > 6)
			{	
				alert('Masa Asuransi Maksimal 6 Tahun!');
				document.getElementById('masaasuransijskelangsunganpendidikan').value = 1;	
			}
			
			
			var spp = $("#spp").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if (masaasuransijskelangsunganpendidikan == 1)
			{
				masaasuransi = 1;
			}
			else if (masaasuransijskelangsunganpendidikan == 2)
			{
				masaasuransi = 2;	
			}
			else if (masaasuransijskelangsunganpendidikan == 3)
			{
				masaasuransi = 3;	
			}
			else if (masaasuransijskelangsunganpendidikan == 4)
			{
				masaasuransi = 4;	
			}
			else if (masaasuransijskelangsunganpendidikan == 5)
			{
				masaasuransi = 5;	
			}
			else if (masaasuransijskelangsunganpendidikan == 6)
			{
				masaasuransi = 6;	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jskelangsunganpendidikan/hitungjumlahrisikoawaljskelangsunganpendidikan');?>",
				data	: "spp="+spp+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#jumlahrisikoawaljskelangsunganpendidikan").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jskelangsunganpendidikan/hitungpremisekaligusjskelangsunganpendidikan');?>",
				data	: "spp="+spp+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premisekaligusjskelangsunganpendidikan").val(data);
				}
			});
			
		});	
		
		$("#spp").change(function() {
			var spp = $("#spp").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var masaasuransijskelangsunganpendidikan = $("#masaasuransijskelangsunganpendidikan").val();
			
			var masaasuransi;
			
			if (masaasuransijskelangsunganpendidikan == 1)
			{
				masaasuransi = 1;
			}
			else if (masaasuransijskelangsunganpendidikan == 2)
			{
				masaasuransi = 2;	
			}
			else if (masaasuransijskelangsunganpendidikan == 3)
			{
				masaasuransi = 3;	
			}
			else if (masaasuransijskelangsunganpendidikan == 4)
			{
				masaasuransi = 4;	
			}
			else if (masaasuransijskelangsunganpendidikan == 5)
			{
				masaasuransi = 5;	
			}
			else if (masaasuransijskelangsunganpendidikan == 6)
			{
				masaasuransi = 6;	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jskelangsunganpendidikan/hitungjumlahrisikoawaljskelangsunganpendidikan');?>",
				data	: "spp="+spp+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#jumlahrisikoawaljskelangsunganpendidikan").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jskelangsunganpendidikan/hitungpremisekaligusjskelangsunganpendidikan');?>",
				data	: "spp="+spp+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premisekaligusjskelangsunganpendidikan").val(data);
				}
			});
			
		});
		
	});
</script>
