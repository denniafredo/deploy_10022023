<div style="border: 1px solid #444; padding: 1px; margin-left:20px; margin-right:20px; background-color:#0070C0;color:#FFFFFF" class="row">
<h3 class="block" align="center">PROPOSAL</h3>
<h3 class="block" align="center">ASURANSI JIWA PERORANGAN</h3>
</div>
<br>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">  

<p style="font-style: italic; color: #FF0000; font-size: 14px; font-weight: bold">Perlindungan bagi Individu yang aktif!</p>                                              						                                                    						
                                                    						                                                    						<div class="col-md-12">

<h4 class="block">Calon Tertanggung</h4>
															
                                            <br>
                                            
        <div class="form-group">
          <label class="control-label col-md-4">Nama Calon Tertanggung <span class="required"> * </span> </label>
          <div class="col-md-6">
														<input style="background: yellow" type="text" class="form-control" name="namalengkapcalontertanggung" id="namalengkapcalontertanggung" placeholder="Nama Lengkap"/>
														<span class="help-block">
															 Masukkan Nama Lengkap Calon Tertanggung
														</span>
													</div>
		</div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-4">Jenis Kelamin <span class="required"> * </span></label>
                                                  <div class="col-md-3">
										  <select style="background: yellow" class="form-control select2me" name="jeniskelamincalontertanggung" id="jeniskelamincalontertanggung" onChange="">
												<option value="">Pilih Jenis Kelamin</option>
												<option value="Laki-Laki">Laki-Laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
		</div>
                                    <div class="form-group">
                                      <label class="control-label col-md-4">Tanggal Lahir<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input style="background: yellow" class="form-control form-control-inline input-xs date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" onChange=""/>
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


<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-16">
    <div class="form-group">
    <label class="control-label col-md-4">Uang Asuransi <span class="required"> * </span> </label>
    <div class="col-md-1">
        <div class="input-group">
            <input style="background: yellow" class="form-control" placeholder="Uang Asuransi" type="" name="uangasuransiaskred" id="uangasuransiaskred" onChange="" value="0"> 
          
        </div>
       
        
    </div>
    <div class="col-md-3">
		<span align="center" class="help-block" style="background: red; color: white;border: 1px solid;">
			<strong>Minimal Rp. 250.000.000,-</strong>
		</span>
    </div>
   
    </div>	
    
    <div class="form-group">
    	<label class="control-label col-md-4">Mulai Asuransi<span class="required"> * </span></label>
        <div class="col-md-6">
          <input style="background: yellow" class="form-control form-control-inline input-small date-picker" id="mulaiasuransi" name="mulaiasuransi" size="16" type="text" value="" placeholder="Mulai Asuransi" onChange=""/>
        </div>
    </div>			
  
             
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Premi <span class="required"> * </span> </label>
        <div class="col-md-3">
            <div class="input-group">
                <input style="background: yellow" class="form-control" placeholder="Premi" name="premiaskred" id="premiaskred" readonly> 
                
            </div>
        </div>
	</div> 
    
    <div class="form-group" >
        <label class="control-label col-md-4">Masa Asuransi
            <span class="required">
            
            </span>
        </label>
        
        <div class="col-md-3">
            <input style="background: yellow" class="form-control" placeholder="Masa Asuransi" type="number" name="masaasuransiaskred" id="masaasuransiaskred" value="1" >
       
        </div>
        <span class="help-block" >
        Tahun
        </span>
        
    </div> 
    
    <div class="form-group" style="visibility: hidden">
        <label class="control-label col-md-4">JUA Menurun Linear
            <span class="required">
            
            </span>
        </label>
        <div class="col-md-3">
            <input style="background: yellow" class="form-control" placeholder="JUA Menurun Linear" type="number" name="juamenurunlinearaskred" id="juamenurunlinearaskred"  >
       
        </div>
    </div>
                                                          
</div>
</div>

<script>
jQuery(document).ready(function() {       
      // initiate layout and plugins
		App.init();
		ComponentsPickers.init();
	    
		$("#tertanggungsamadenganpemegangpolis").click(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var uangasuransiaskred = $("#uangasuransiaskred").val();
			var masaasuransiaskred = $("#masaasuransiaskred").val();
			
			if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {

					document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
					document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
					$('#tanggallahircalontertanggung').trigger('change');


					if (document.getElementById('gendernasabah').value == "M") 
					{
						document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
						$('#jeniskelamincalontertanggung').trigger('change');

						if (uangasuransiaskred < 250000000)
						{
							//window.setTimeout('alert("Uang Asuransi Minimal 250000000!");window.close();', 5000);
							document.getElementById("uangasuransiaskred").value = 0;
							$('#uangasuransiaskred').trigger('change');
						}
						else if (uangasuransiaskred < 0)
						{
							//window.setTimeout('alert("Uang Asuransi tidak boleh kurang dari 0!");window.close();', 5000);
							document.getElementById("uangasuransiaskred").value = 0;
							$('#uangasuransiaskred').trigger('change');
						}
						else
						{
								$.ajax({
									type	: "POST",
									url		: "<?=base_url('askred/hitungtarifaskred');?>",
									data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
									success : function(data) {

										//alert(data);
										$("#premiaskred").val(data);
									}
								});	
							
								$.ajax({
									type	: "POST",
									url		: "<?=base_url('askred/hitungjuamenurunlinearaskred');?>",
									data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
									success : function(data) {

										//alert(data);
										$("#juamenurunlinearaskred").val(data);
									}
								});
						}
					}
					else if (document.getElementById('gendernasabah').value == "F") 
					{
						document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
						$('#jeniskelamincalontertanggung').trigger('change');
						
						if (uangasuransiaskred < 250000000)
						{
							//window.setTimeout('alert("Uang Asuransi Minimal 250000000!");window.close();', 5000);
							document.getElementById("uangasuransiaskred").value = 0;
							$('#uangasuransiaskred').trigger('change');
						}
						else if (uangasuransiaskred < 0)
						{
							//window.setTimeout('alert("Uang Asuransi tidak boleh kurang dari 0!");window.close();', 5000);
							document.getElementById("uangasuransiaskred").value = 0;
							$('#uangasuransiaskred').trigger('change');
						}
						else
						{
								$.ajax({
									type	: "POST",
									url		: "<?=base_url('askred/hitungtarifaskred');?>",
									data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
									success : function(data) {

										//alert(data);
										$("#premiaskred").val(data);
									}
								});	
							
								$.ajax({
									type	: "POST",
									url		: "<?=base_url('askred/hitungjuamenurunlinearaskred');?>",
									data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
									success : function(data) {

										//alert(data);
										$("#juamenurunlinearaskred").val(data);
									}
								});
						}

					}

			} 
			else 
			{
				document.getElementById("namalengkapcalontertanggung").value = ""; 
				document.getElementById("tanggallahircalontertangggung").value = ""; 
				document.getElementById('jeniskelamincalontertanggung').value = "";
				$('#jeniskelamincalontertanggung').trigger('change');
				document.getElementById('carabayar').value = "";
				$('#carabayar').trigger('change');

				if (uangasuransiaskred < 250000000)
				{
					//window.setTimeout('alert("Uang Asuransi Minimal 250000000!");window.close();', 5000);
					document.getElementById("uangasuransiaskred").value = 0;
					$('#uangasuransiaskred').trigger('change');
				}
				else if (uangasuransiaskred < 0)
				{
					//window.setTimeout('alert("Uang Asuransi tidak boleh kurang dari 0!");window.close();', 5000);
					document.getElementById("uangasuransiaskred").value = 0;
					$('#uangasuransiaskred').trigger('change');
				}
				else
				{
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('askred/hitungtarifaskred');?>",
							data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
							success : function(data) {

								//alert(data);
								$("#premiaskred").val(data);
							}
						});	
					
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('askred/hitungjuamenurunlinearaskred');?>",
							data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
							success : function(data) {

								//alert(data);
								$("#juamenurunlinearaskred").val(data);
							}
						});
				}
			}	
	
		});
	
		$("#tanggallahircalontertangggung").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var uangasuransiaskred = $("#uangasuransiaskred").val();
			var masaasuransiaskred = $("#masaasuransiaskred").val();
			
			if (uangasuransiaskred < 250000000)
			{
				//window.setTimeout('alert("Uang Asuransi Minimal 250000000!");window.close();', 5000);
				document.getElementById("uangasuransiaskred").value = 0;
				$('#uangasuransiaskred').trigger('change');
			}
			else if (uangasuransiaskred < 0)
			{
				//window.setTimeout('alert("Uang Asuransi tidak boleh kurang dari 0!");window.close();', 5000);
				document.getElementById("uangasuransiaskred").value = 0;
				$('#uangasuransiaskred').trigger('change');
			}
			else
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('askred/hitungtarifaskred');?>",
						data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
						success : function(data) {
							
							//alert(data);
							$("#premiaskred").val(data);
						}
					});	
				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('askred/hitungjuamenurunlinearaskred');?>",
						data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
						success : function(data) {
							
							//alert(data);
							$("#juamenurunlinearaskred").val(data);
						}
					});
			}
			
		});
	
		
		$("#uangasuransiaskred").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var uangasuransiaskred = $("#uangasuransiaskred").val();
			var masaasuransiaskred = $("#masaasuransiaskred").val();
			
			if (uangasuransiaskred < 250000000)
			{
				//window.setTimeout('alert("Uang Asuransi Minimal 250000000!");window.close();', 5000);
				document.getElementById("uangasuransiaskred").value = 0;
				$('#uangasuransiaskred').trigger('change');
			}
			else if (uangasuransiaskred < 0)
			{
				//window.setTimeout('alert("Uang Asuransi tidak boleh kurang dari 0!");window.close();', 5000);
				document.getElementById("uangasuransiaskred").value = 0;
				$('#uangasuransiaskred').trigger('change');
			}
			else
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('askred/hitungtarifaskred');?>",
						data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
						success : function(data) {
							
							//alert(data);
							$("#premiaskred").val(data);
						}
					});
				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('askred/hitungjuamenurunlinearaskred');?>",
						data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
						success : function(data) {
							
							//alert(data);
							$("#juamenurunlinearaskred").val(data);
						}
					});
			}
			
		});
	
		$("#masaasuransiaskred").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var uangasuransiaskred = $("#uangasuransiaskred").val();
			var masaasuransiaskred = $("#masaasuransiaskred").val();
			
			if (uangasuransiaskred < 250000000)
			{
				//window.setTimeout('alert("Uang Asuransi Minimal 250000000!");window.close();', 5000);
				document.getElementById("uangasuransiaskred").value = 0;
				$('#uangasuransiaskred').trigger('change');
			}
			else if (uangasuransiaskred < 0)
			{
				//window.setTimeout('alert("Uang Asuransi tidak boleh kurang dari 0!");window.close();', 5000);
				document.getElementById("uangasuransiaskred").value = 0;
				$('#uangasuransiaskred').trigger('change');
			}
			else
			{
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('askred/hitungtarifaskred');?>",
						data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
						success : function(data) {
							
							//alert(data);
							$("#premiaskred").val(data);
						}
					});	
				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('askred/hitungjuamenurunlinearaskred');?>",
						data	: "uangasuransiaskred="+uangasuransiaskred+"&masaasuransiaskred="+masaasuransiaskred+"&usiasekarang="+usiasekarang,
						success : function(data) {
							
							//alert(data);
							$("#juamenurunlinearaskred").val(data);
						}
					});
			}
			
		});

	});
</script>

													