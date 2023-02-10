<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-12">
                                                    											
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
													  <input class="form-control form-control-inline input-small date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" onChange=""/>
														<span class="help-block">
															 Masukkan Tanggal Lahir
														</span>
													</div>
		</div>
        <div class="form-group">
                                                  <label class="control-label col-md-4">Status Kawin <span class="required"> * </span></label>
                                                  <div class="col-md-3">
										  <select class="form-control select2me" name="statuskawin" id="statuskawin" onChange="">
												<option value="">Pilih Status Kawin</option>
												<option value="kawin">Kawin</option>
												<option value="bujang">Bujang</option>
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
                                      <label class="control-label col-md-4">Mulai Program Anuitas<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransi" name="saatmulaiasuransi" size="16" type="text" value="" placeholder="Saat Mulai Program Anuitas" onChange=""/>
														<span class="help-block">
															 Saat Mulai Program Anuitas
														</span>
													</div>
		</div>					
                                    <div class="form-group">
                                                  <label class="control-label col-md-4">Pensiun Ditentukan <span class="required"> * </span></label>
                                                  <div class="col-md-3">
										  <select class="form-control select2me" name="pensiunditentukan" id="pensiunditentukan" onChange="">
												<option value="">Pensiun Ditentukan</option>
												<option value="Ya">Ya</option>
												<option value="Tidak">Tidak</option>
											</select>
										</div>
		</div>
        <div class="form-group">
                                                  <label class="control-label col-md-4">Pilihan Anuitasnya </label>
                                                  <div class="col-md-3">
										  <select class="form-control select2me" name="pilihananuitas" id="pilihananuitas" onChange="" disabled>
												<option value="">Pilihan Anuitasnya</option>
												<option value="SEJAHTERA PRIMA">SEJAHTERA PRIMA</option>
												<option value="SEJAHTERA IDEAL">SEJAHTERA IDEAL</option>
                                                <option value="IDEAL (SESUAI UU)">IDEAL (SESUAI UU)</option>
                                                <option value="EKSEKUTIF PRIMA">EKSEKUTIF PRIMA</option>
                                                
											</select>
										</div>
		</div>
        <div class="form-group">
									  <label class="control-label col-md-4">Pensiun Bulanan  </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Pensiun Bulanan" type="number" name="pensiunbulanan" id="pensiunbulanan" onChange=""  disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
        <div class="form-group">
									  <label class="control-label col-md-4">Premi Sekaligus <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Premi Sekaligus" type="number" name="uangasuransipokok" id="uangasuransipokok" onChange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
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
					
					document.getElementById('namalengkapcalontertanggung').disabled = true;
					document.getElementById('jeniskelamincalontertanggung').disabled = true;
					document.getElementById('tanggallahircalontertangggung').disabled = true;
				
					document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
					
					var birthday = +new Date(document.getElementById("lahirnasabah").value);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					if (usiasekarang < 20)
					{
						alert('Usia minimal 20 tahun!');
						document.getElementById("tanggallahircalontertangggung").value = '';	
					}
					else
					{
						document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
						$('#tanggallahircalontertanggung').trigger('change');
					}
					
					if (document.getElementById('gendernasabah').value == "M") {
					document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
					$('#jeniskelamincalontertanggung').trigger('change');
					}
					else if (document.getElementById('gendernasabah').value == "F") {
					document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
					$('#jeniskelamincalontertanggung').trigger('change');
					
					

					//document.getElementById("minimalua").value = usiasekarang.value;
				}
				
					 
				} 
				else {
					document.getElementById("namalengkapcalontertanggung").value = ""; 
					document.getElementById("tanggallahircalontertangggung").value = ""; 
					document.getElementById('jeniskelamincalontertanggung').value = "";
					
					document.getElementById('namalengkapcalontertanggung').disabled = false;
					document.getElementById('jeniskelamincalontertanggung').disabled = false;
					document.getElementById('tanggallahircalontertangggung').disabled = false;
					
					$('#jeniskelamincalontertanggung').trigger('change');
					document.getElementById('carabayar').value = "";
					$('#carabayar').trigger('change');
					
					
				}	
	
		});
		
		$("#pensiunbulanan").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var saatmulaiasuransi = +new Date(document.getElementById("saatmulaiasuransi").value);
			var pensiunbulanan = document.getElementById("pensiunbulanan").value;
			
			var statuskawin = $("#statuskawin").val();
			
			if ( document.getElementById("pilihananuitas").value == "SEJAHTERA PRIMA")
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsanuitas/hitungpremisekaligusaspjsanuitas');?>",
						data	: "pensiunbulanan="+pensiunbulanan+"&saatmulaiasuransi="+saatmulaiasuransi+"&usiasekarang="+usiasekarang+"&birthday="+birthday,
						success : function(data) {
							$("#uangasuransipokok").val(data);
						}
					});
			}
			else if ( document.getElementById("pilihananuitas").value == "SEJAHTERA IDEAL")
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsanuitas/hitungpremisekaligusasijsanuitas');?>",
						data	: "pensiunbulanan="+pensiunbulanan+"&saatmulaiasuransi="+saatmulaiasuransi+"&usiasekarang="+usiasekarang+"&birthday="+birthday,
						success : function(data) {
							$("#uangasuransipokok").val(data);
						}
					});
			}
			else if ( document.getElementById("pilihananuitas").value == "IDEAL (SESUAI UU)")
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsanuitas/hitungpremisekaligusanijsanuitas');?>",
						data	: "pensiunbulanan="+pensiunbulanan+"&saatmulaiasuransi="+saatmulaiasuransi+"&usiasekarang="+usiasekarang+"&birthday="+birthday,
						success : function(data) {
							$("#uangasuransipokok").val(data);
						}
					});
			}
			else if ( document.getElementById("pilihananuitas").value == "EKSEKUTIF PRIMA")
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsanuitas/hitungpremisekaligusaepjsanuitas');?>",
						data	: "pensiunbulanan="+pensiunbulanan+"&saatmulaiasuransi="+saatmulaiasuransi+"&usiasekarang="+usiasekarang+"&birthday="+birthday+"&statuskawin="+statuskawin,
						success : function(data) {
							$("#uangasuransipokok").val(data);
						}
					});
			}
			else
			{
				alert('Mohon Tentukan Pilihan Anuitasnya!');
				document.getElementById("pensiunanbulanan").value == "";
				document.getElementById("uangasuransipokok").value == "";
			}
		});
		
		$("#pensiunditentukan").change(function() {
			
			if (document.getElementById('pensiunditentukan').value == 'Ya')
			{
				document.getElementById('pilihananuitas').disabled = false;
				document.getElementById('pensiunbulanan').disabled = false;
				document.getElementById('pensiunbulanan').value = "";
				document.getElementById('uangasuransipokok').value = "";
				document.getElementById('uangasuransipokok').disabled = true;
				
			}
			else if (document.getElementById('pensiunditentukan').value == 'Tidak')
			{
				document.getElementById('pilihananuitas').disabled = true;
				document.getElementById('pensiunbulanan').disabled = true;
				document.getElementById('pilihananuitas').value = "";
				$('#pilihananuitas').trigger('change');
				document.getElementById('pensiunbulanan').value = "";
				document.getElementById('uangasuransipokok').disabled = false;
			}
			else
			{
			document.getElementById('pilihananuitas').disabled = true;
				document.getElementById('pensiunbulanan').disabled = true;
				document.getElementById('pilihananuitas').value = "";
				$('#pilihananuitas').trigger('change');
				document.getElementById('pensiunbulanan').value = "";
				document.getElementById('uangasuransipokok').value = "";
				document.getElementById('uangasuransipokok').disabled = true;	
			}
		});
		
		$("#tanggallahircalontertangggung").change(function() {
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			
			if (usiasekarang < 20)
			{
				alert('Usia minimal 20 tahun!');
				document.getElementById("tanggallahircalontertangggung").value = '';	
			}
			else
			{
			
			}
			
		});
			
	   });
</script>