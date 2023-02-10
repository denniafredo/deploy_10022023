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
												<option value="bujang">Lajang</option>
											</select>
										</div>
		</div>
                                                
                                    <div class="checkbox-list" data-error-container="#form_2_services_error">
												<label>
												<input type="checkbox" value="1" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" /> Tertanggung sama dengan Pemegang Polis </label>
		</div>    
                       
                       <br>									
</div>
													<!--/span-->
   		 </div>
    </div>
    
    
</div>

<h3 class="block" align="center">Entri Data</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-12">
                        
                        			<div class="form-group">
                                      <label class="control-label col-md-4">Saat Mulai Asuransi<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransijsanuitas" name="saatmulaiasuransijsanuitas" size="16" type="text" value="" placeholder="Saat Mulai Program Anuitas" onChange=""/>
														
													</div>
		</div>					
                                    
        <div class="form-group">
                                                  <label class="control-label col-md-4">Pilihan Anuitasnya </label>
                                                  <div class="col-md-3">
										  <select class="form-control select2me" name="pilihananuitas" id="pilihananuitas" onChange="" >
												<option value="">Pilihan Anuitasnya</option>
<!--
												<option value="SEJAHTERA PRIMA">SEJAHTERA PRIMA</option>
												<option value="SEJAHTERA IDEAL">SEJAHTERA IDEAL</option>
-->
                                                <option value="IDEAL (SESUAI UU)">IDEAL (SESUAI UU)</option>
<!--                                                <option value="EKSEKUTIF PRIMA">EKSEKUTIF PRIMA</option>-->
                                                
											</select>
										</div>
		</div>
        
        <div class="form-group">
									  <label class="control-label col-md-4">Premi Sekaligus <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Premi Sekaligus" type="number" name="premisekaligusjsanuitas" id="premisekaligusjsanuitas" onChange="" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
                                    

													</div>
													<!--/span-->
													
</div>

<br>

<h3 class="block" align="center">Nilai Anuitas</h3>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-6">




</div>

<div class="col-md-12">

<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											 No.
										</th>
										<th>
											
										</th>
                                        <th>
											
										</th>
                                       
                                        <th>
											Kawin
										</th>
                                        <th>
											
										</th>
                                        <th>
											 Lajang
										</th>
									</tr>
								</thead>
									
								<tbody>

                                    <tr>
<!--										<td>3.</td>-->
										<td>Anuitas Ideal</td>
                                      	<td>Rp.</td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="aikawin" id="aikawin" onChange="" value="0" readonly>
                                        </td>
                                        <td>Rp.</td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="aibujang" id="aibujang" onChange="" value="0" readonly>
                                        </td>
									</tr>

                                    
								</tbody>
							</table>
                            
						</div>
</div>


</div>
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
					
					if (usiasekarang < 45)
					{
						alert('Usia minimal 45 tahun!');
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
					
					
					
				}	
	
		});
		
		$("#premisekaligusjsanuitas").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var statuskawin = $("#statuskawin").val();
			
			var tgllahir = document.getElementById("tanggallahircalontertangggung").value;
			
			var saatmulaiasuransijsanuitas = document.getElementById("saatmulaiasuransijsanuitas").value;
			
			var pilihananuitas = document.getElementById("pilihananuitas").value;
			
			var premisekaligusjsanuitas = $("#premisekaligusjsanuitas").val();

			$.ajax({
				type	: "POST",
				url		: "<?=base_url('anuitasnew2/hitungpremisekaligusanijsanuitas');?>",
				data	: "premisekaligusjsanuitas="+premisekaligusjsanuitas+"&saatmulaiasuransijsanuitas="+saatmulaiasuransijsanuitas+"&usiasekarang="+usiasekarang+"&statuskawin="+"kawin"+"&tgllahir="+tgllahir,
				success : function(data) {
					
					if (usiasekarang < 45)
					{
						$("#aikawin").val(0);
						$("#aibujang").val(0);
					}
					else
					{	
						$("#aikawin").val(data);
						$("#aibujang").val(Math.ceil(data*60/100));
					}
					
				}
			});
			
			
		});
		
		
		
		$("#tanggallahircalontertangggung").change(function() {
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			
			if (usiasekarang < 45)
			{
				alert('Usia minimal 45 tahun!');
				document.getElementById("tanggallahircalontertangggung").value = '';	
			}
			
		});
			
	   });
</script>