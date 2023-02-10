<div style="border: 1px solid #444; padding: 1px; margin-left:20px; margin-right:20px; background-color:#0070C0;color:#FFFFFF" class="row">
<h3 class="block" align="center">Entri Data Peserta</h3>
</div>
<br>
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


<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-16">
    <div class="form-group">
    <label class="control-label col-md-4">Uang Asuransi <span class="required"> * </span> </label>
    <div class="col-md-3">
        <div class="input-group">
            <input class="form-control" placeholder="Uang Asuransi" type="" name="uangasuransiakdp" id="uangasuransiakdp" onChange="" value="0"> 
        <span class="help-block" style="border: 1px solid #444;">
        	<strong>MAKSIMAL Rp. 300.000.000,-</strong>
        </span>  
        </div>
        
    </div>
   
    </div>				
    <div class="form-group">
    <label class="control-label col-md-4">Jenis Plan <span class="required"> * </span></label>
        <div class="col-md-3">
            <select class="form-control select2me" name="jenisplan" id="jenisplan" onChange="">
                <option value="">Pilih Jenis Plan</option>
                <option value="Plan A">1</option>
                <option value="Plan B">2</option>
            </select>
            <span class="help-block" style="border: 1px solid #444; background-color:#1F4E79; color:#FFFFFF">
                 <strong>1. Plan A</strong>
            </span>
            <span class="help-block" style="border: 1px solid #444; background-color:#1F4E79; color:#FFFFFF">
                 <strong>2. Plan B</strong>
            </span>
        </div>
    </div>		
    <div class="form-group">
    	<label class="control-label col-md-4">Mulai Asuransi<span class="required"> * </span></label>
        <div class="col-md-6">
          <input class="form-control form-control-inline input-small date-picker" id="mulaiasuransi" name="mulaiasuransi" size="16" type="text" value="" placeholder="Mulai Asuransi" onChange=""/>
        </div>
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Kelas Risiko <span class="required"> * </span></label>
        <div class="col-md-3">
            <select class="form-control select2me" name="kelasrisiko" id="kelasrisiko" onChange="">
                <option value="">Pilih Kelas Risiko</option>
                <option value="Kelas I">1</option>
                <option value="Kelas II">2</option>
                <option value="Kelas III">3</option>
                <option value="Kelas IV">4</option>
            </select>
            <span class="help-block" style="border: 1px solid #444; background-color:#1F4E79; color:#FFFFFF">
                 <strong>1. Kelas I</strong>
            </span>
            <span class="help-block" style="border: 1px solid #444; background-color:#1F4E79; color:#FFFFFF">
                 <strong>2. Kelas II</strong>
            </span>
            <span class="help-block" style="border: 1px solid #444; background-color:#1F4E79; color:#FFFFFF">
                 <strong>3. Kelas III</strong>
            </span><span class="help-block" style="border: 1px solid #444; background-color:#1F4E79; color:#FFFFFF">
                 <strong>4. Kelas IV</strong>
            </span>
        </div>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-4">Masa Asuransi
            <span class="required">
            
            </span>
        </label>
        
        <div class="col-md-3">
            <input class="form-control" placeholder="Masa Asuransi" type="number" name="masaasuransiakdp" id="masaasuransiakdp" value="1" >
         <span class="help-block" style="border: 1px solid #444; ">
        Tahun
        </span>
        </div>
        
        
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Premi <span class="required"> * </span> </label>
        <div class="col-md-3">
            <div class="input-group">
                <input class="form-control" placeholder="Premi" type="" name="premiakdp" id="premiakdp" onChange="" readonly> 
                
            </div>
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
		
		$("#jenisplan").change(function() {
			var jenisplan = $("#jenisplan").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var tarifplan;
			var uangasuransiakdp = $("#uangasuransiakdp").val();
			var kelasrisiko = $("#kelasrisiko").val();
			var uangasuransi = uangasuransiakdp/1000000;
			
			if (jenisplan == 'Plan A')
			{
				//alert('Tarif 2316');
				tarifplan = 2316;
			}
			else if (jenisplan == 'Plan B')
			{
				//alert('Tarif 4080');
				tarifplan = 4080;	
			}
			
			if (kelasrisiko == 'Kelas I')
			{
				//alert('Tarif 2316');
				extrapremi = 0/100;
			}
			else if (kelasrisiko == 'Kelas II')
			{
				//alert('Tarif 4080');
				extrapremi = 20/100;
			}
			else if (kelasrisiko == 'Kelas III')
			{
				//alert('Tarif 4080');
				extrapremi = 40/100;	
			}
			else if (kelasrisiko == 'Kelas IV')
			{
				//alert('Tarif 4080');
				extrapremi = 65/100;	
			}
			
			if (uangasuransiakdp > 300000000)
			{
				alert('Uang Asuransi Maksimal 300000000!');
				document.getElementById("uangasuransiakdp").value = 0;
				$('#uangasuransiakdp').trigger('change');
			}
			else if (uangasuransiakdp < 0)
			{
				alert('Uang Asuransi tidak boleh kurang dari 0!');
				document.getElementById("uangasuransiakdp").value = 0;
				$('#uangasuransiakdp').trigger('change');
			}
			else
			{
				document.getElementById("premiakdp").value = Math.round(((1+extrapremi)*tarifplan)*uangasuransi);	
			}
			
		});
		
		$("#kelasrisiko").change(function() {
			var jenisplan = $("#jenisplan").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var tarifplan;
			var extrapremi;
			var uangasuransiakdp = $("#uangasuransiakdp").val();
			var kelasrisiko = $("#kelasrisiko").val();
			var uangasuransi = uangasuransiakdp/1000000;
			
			if (jenisplan == 'Plan A')
			{
				//alert('Tarif 2316');
				tarifplan = 2316;
			}
			else if (jenisplan == 'Plan B')
			{
				//alert('Tarif 4080');
				tarifplan = 4080;	
			}
			
			if (kelasrisiko == 'Kelas I')
			{
				//alert('Tarif 2316');
				extrapremi = 0/100;
			}
			else if (kelasrisiko == 'Kelas II')
			{
				//alert('Tarif 4080');
				extrapremi = 20/100;
			}
			else if (kelasrisiko == 'Kelas III')
			{
				//alert('Tarif 4080');
				extrapremi = 40/100;	
			}
			else if (kelasrisiko == 'Kelas IV')
			{
				//alert('Tarif 4080');
				extrapremi = 65/100;	
			}
			
			if (uangasuransiakdp > 300000000)
			{
				alert('Uang Asuransi Maksimal 300000000!');
				document.getElementById("uangasuransiakdp").value = 0;
				$('#uangasuransiakdp').trigger('change');
			}
			else if (uangasuransiakdp < 0)
			{
				alert('Uang Asuransi tidak boleh kurang dari 0!');
				document.getElementById("uangasuransiakdp").value = 0;
				$('#uangasuransiakdp').trigger('change');
			}
			else
			{
				document.getElementById("premiakdp").value = Math.round(((1+extrapremi)*tarifplan)*uangasuransi);	
			}
			
		});
		
		$("#uangasuransiakdp").change(function() {
			var jenisplan = $("#jenisplan").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var tarifplan;
			var extrapremi;
			var uangasuransiakdp = $("#uangasuransiakdp").val();
			var kelasrisiko = $("#kelasrisiko").val();
			var uangasuransi = uangasuransiakdp/1000000;
			
			if (jenisplan == 'Plan A')
			{
				//alert('Tarif 2316');
				tarifplan = 2316;
			}
			else if (jenisplan == 'Plan B')
			{
				//alert('Tarif 4080');
				tarifplan = 4080;	
			}
			
			if (kelasrisiko == 'Kelas I')
			{
				//alert('Tarif 2316');
				extrapremi = 0/100;
			}
			else if (kelasrisiko == 'Kelas II')
			{
				//alert('Tarif 4080');
				extrapremi = 20/100;
			}
			else if (kelasrisiko == 'Kelas III')
			{
				//alert('Tarif 4080');
				extrapremi = 40/100;	
			}
			else if (kelasrisiko == 'Kelas IV')
			{
				//alert('Tarif 4080');
				extrapremi = 65/100;	
			}
			
			if (uangasuransiakdp > 300000000)
			{
				alert('Uang Asuransi Maksimal 300000000!');
				document.getElementById("uangasuransiakdp").value = 0;
				$('#uangasuransiakdp').trigger('change');
			}
			else if (uangasuransiakdp < 0)
			{
				alert('Uang Asuransi tidak boleh kurang dari 0!');
				document.getElementById("uangasuransiakdp").value = 0;
				$('#uangasuransiakdp').trigger('change');
			}
			else
			{
				document.getElementById("premiakdp").value = Math.round(((1+extrapremi)*tarifplan)*uangasuransi);	
			}
			
		});

	});
</script>

													