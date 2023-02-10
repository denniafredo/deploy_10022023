<div style="border: 1px solid #444; padding: 1px; margin-left:20px; margin-right:20px; background-color:#0070C0;color:#FFFFFF" class="row">
<h3 class="block" align="center">PROPOSAL</h3>
<h3 class="block" align="center">JS PENSIUN NYAMAN SEJAHTERA</h3>
</div>
<br>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-12">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">  
                                           						                                                    						
                                                    						                                                    						<div class="col-md-12">

<div style="border: 1px solid #444; padding: 1px; background-color:#0070C0;color:#FFFFFF" class="row">
<h3 class="block" align="center">DATA CALON TERTANGGUNG</h3>
</div>
															
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
                                               
													<div class="form-group">
														<label class="control-label col-md-4">Status <span class="required"> * </span></label>
														<div class="col-md-3">
															<select style="background: yellow" class="form-control select2me" name="statusjspns" id="statusjspns" onChange="">
																<option value="Kawin">Kawin</option>
																<option value="Bujang">Bujang</option>
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


<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">

<div class="col-md-12">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">  
                                           						                                                    						
                                                    						                                                    						<div class="col-md-12">

<div style="border: 1px solid #444; padding: 1px; background-color:#0070C0;color:#FFFFFF" class="row">
<h3 class="block" align="center">DATA PERTANGGUNGAN</h3>
</div>

<br>

<div class="col-md-16">
    <div class="form-group">
    <label class="control-label col-md-4">Pensiun Perbulan <span class="required"> * </span> </label>
    <div class="col-md-1">
        <div class="input-group">
            <input style="background: yellow" class="form-control" placeholder="Pensiun Perbulan" type="" name="pensiunperbulanjspns" id="pensiunperbulanjspns" onChange="" value="0"> 
          
        </div>
       
        
    </div>

   
    </div>	
    
    <div class="form-group">
    	<label class="control-label col-md-4">Saat Mulai Asuransi<span class="required"> * </span></label>
        <div class="col-md-6">
          <input style="background: yellow" class="form-control form-control-inline input-small date-picker" id="mulaiasuransi" name="mulaiasuransi" size="16" type="text" value="" placeholder="Saat Mulai Asuransi" onChange=""/>
        </div>
    </div>	
    
    <div class="form-group" >
        <label class="control-label col-md-4">Masa Pembayaran Premi
            <span class="required">
            
            </span>
        </label>
        
        <div class="col-md-3">
            <input style="background: yellow" class="form-control" placeholder="Masa Pembayaran Premi" type="number" name="masapembayaranpremijspns" id="masapembayaranpremijspns">
       
        </div>
        <span class="help-block" style="font-weight: bold">
        TAHUN
        </span>
        
    </div>
    
    <div class="form-group">
		<label class="control-label col-md-4">Cara Bayar Premi <span class="required"> * </span></label>
		<div class="col-md-3">
			<select style="background: yellow" class="form-control select2me" name="carabayarpremijspns" id="carabayarpremijspns" onChange="">
				<option value="">[Pilih Cara Bayar]</option>
				<option value="Bulanan">Bulanan</option>
				<option value="Kuartalan">Kuartalan</option>
				<option value="Semesteran">Semesteran</option>
				<option value="Tahunan">Tahunan</option>
				<option value="Sekaligus">Sekaligus</option>
			</select>
		</div>
	</div>	
   
    <div class="form-group">
    <label class="control-label col-md-4">Premi <span class="required"> * </span> </label>
        <div class="col-md-3">
            <div class="input-group">
                <input style="background: yellow" class="form-control" placeholder="Premi" name="premijspns" id="premijspns" readonly> 
                
            </div>
        </div>
        <span class="help-block" style="font-weight: bold" id="labelcarabayarjspns" name="labelcarabayarjspns">
        
        </span>
	</div> 		
  
             
    </div>
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
	
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var pensiunperbulanjspns = $("#pensiunperbulanjspns").val();
			var masapembayaranpremijspns = $("#masapembayaranpremijspns").val();
			var statusjspns = $("#statusjspns").val().toUpperCase();
			var carabayarpremijspns = $("#carabayarpremijspns").val().toUpperCase();
			
			var maxmasapembpremi = parseInt(usiasekarang) + parseInt(masapembayaranpremijspns);
						
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspns/hitungtarifjspns');?>",
				data	: "pensiunperbulanjspns="+pensiunperbulanjspns+"&masapembayaranpremijspns="+masapembayaranpremijspns+
					      "&usiasekarang="+usiasekarang+"&statusjspns="+statusjspns+"&carabayarpremijspns="+carabayarpremijspns,
				success : function(data) {
					
					if (usiasekarang > 55)
					{	
						alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
						document.getElementById("premijspns").value = '';
						document.getElementById("masapembayaranpremijspns").value = '';
					}
					else if (usiasekarang < 55)
					{	
						if (maxmasapembpremi > 55)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else if (usiasekarang = 55)
					{	
						if (maxmasapembpremi > 56)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else
					{
						$("#premijspns").val(data);
					}
				}
			});
				
			if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {

					document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
					document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
					$('#tanggallahircalontertanggung').trigger('change');


					if (document.getElementById('gendernasabah').value == "M") 
					{
						document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
						$('#jeniskelamincalontertanggung').trigger('change');

						
					}
					else if (document.getElementById('gendernasabah').value == "F") 
					{
						document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
						$('#jeniskelamincalontertanggung').trigger('change');
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

			}	
	
		});
	
		$("#tanggallahircalontertangggung").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var pensiunperbulanjspns = $("#pensiunperbulanjspns").val();
			var masapembayaranpremijspns = $("#masapembayaranpremijspns").val();
			var statusjspns = $("#statusjspns").val().toUpperCase();
			var carabayarpremijspns = $("#carabayarpremijspns").val().toUpperCase();
			
			var maxmasapembpremi = parseInt(usiasekarang) + parseInt(masapembayaranpremijspns);
			
			//alert(pensiunperbulanjspns);
						
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspns/hitungtarifjspns');?>",
				data	: "pensiunperbulanjspns="+pensiunperbulanjspns+"&masapembayaranpremijspns="+masapembayaranpremijspns+
					      "&usiasekarang="+usiasekarang+"&statusjspns="+statusjspns+"&carabayarpremijspns="+carabayarpremijspns,
				success : function(data) {

					if (usiasekarang > 55)
					{	
						alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
						document.getElementById("premijspns").value = '';
						document.getElementById("masapembayaranpremijspns").value = '';
					}
					else if (usiasekarang < 55)
					{	
						if (maxmasapembpremi > 55)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else if (usiasekarang = 55)
					{	
						if (maxmasapembpremi > 56)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else
					{
						$("#premijspns").val(data);
					}
				}
			});
			
			
		});
	
		
		$("#pensiunperbulanjspns").change(function() {
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var pensiunperbulanjspns = $("#pensiunperbulanjspns").val();
			var masapembayaranpremijspns = $("#masapembayaranpremijspns").val();
			var statusjspns = $("#statusjspns").val().toUpperCase();
			var carabayarpremijspns = $("#carabayarpremijspns").val().toUpperCase();
			
			var maxmasapembpremi = parseInt(usiasekarang) + parseInt(masapembayaranpremijspns);
			
			//alert(pensiunperbulanjspns);
						
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspns/hitungtarifjspns');?>",
				data	: "pensiunperbulanjspns="+pensiunperbulanjspns+"&masapembayaranpremijspns="+masapembayaranpremijspns+
					      "&usiasekarang="+usiasekarang+"&statusjspns="+statusjspns+"&carabayarpremijspns="+carabayarpremijspns,
				success : function(data) {

					if (usiasekarang > 55)
					{	
						alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
						document.getElementById("premijspns").value = '';
						document.getElementById("masapembayaranpremijspns").value = '';
					}
					else if (usiasekarang < 55)
					{	
						if (maxmasapembpremi > 55)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else if (usiasekarang = 55)
					{	
						if (maxmasapembpremi > 56)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else
					{
						$("#premijspns").val(data);
					}
				}
			});	
			
			
		});
	
		$("#masapembayaranpremijspns").change(function() {

			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var pensiunperbulanjspns = $("#pensiunperbulanjspns").val();
			var masapembayaranpremijspns = $("#masapembayaranpremijspns").val();
			var statusjspns = $("#statusjspns").val().toUpperCase();
			var carabayarpremijspns = $("#carabayarpremijspns").val().toUpperCase();
			
			var maxmasapembpremi = parseInt(usiasekarang) + parseInt(masapembayaranpremijspns);

			//alert(pensiunperbulanjspns);
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspns/hitungtarifjspns');?>",
				data	: "pensiunperbulanjspns="+pensiunperbulanjspns+"&masapembayaranpremijspns="+masapembayaranpremijspns+
						  "&usiasekarang="+usiasekarang+"&statusjspns="+statusjspns+"&carabayarpremijspns="+carabayarpremijspns,
				success : function(data) {

					if (usiasekarang > 55)
					{	
						alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
						document.getElementById("premijspns").value = '';
						document.getElementById("masapembayaranpremijspns").value = '';
					}
					else if (usiasekarang < 55)
					{	
						if (maxmasapembpremi > 55)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else if (usiasekarang = 55)
					{	
						if (maxmasapembpremi > 56)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else
					{
						$("#premijspns").val(data);
					}
				}
			});	


		});
	
		$("#carabayarpremijspns").change(function() {

			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var pensiunperbulanjspns = $("#pensiunperbulanjspns").val();
			var masapembayaranpremijspns = $("#masapembayaranpremijspns").val();
			var statusjspns = $("#statusjspns").val().toUpperCase();
			var carabayarpremijspns = $("#carabayarpremijspns").val().toUpperCase();
			
			var maxmasapembpremi = parseInt(usiasekarang) + parseInt(masapembayaranpremijspns);
			
			document.getElementById('labelcarabayarjspns').innerHTML = carabayarpremijspns;
			
//			var res = carabayarpremijspns.substring(0, 5);
//			
//			if (carabayarpremijspns == 'TAHUNAN')
//			{
//				document.getElementById('labelcarabayarjspns').innerHTML = 'PER '+res;
//			}
//			else if (carabayarpremijspns == 'SEKALIGUS')
//			{
//				document.getElementById('labelcarabayarjspns').innerHTML = carabayarpremijspns;	
//			}

			//alert(pensiunperbulanjspns);

			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspns/hitungtarifjspns');?>",
				data	: "pensiunperbulanjspns="+pensiunperbulanjspns+"&masapembayaranpremijspns="+masapembayaranpremijspns+
						  "&usiasekarang="+usiasekarang+"&statusjspns="+statusjspns+"&carabayarpremijspns="+carabayarpremijspns,
				success : function(data) {

					if (usiasekarang > 55)
					{	
						alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
						document.getElementById("premijspns").value = '';
						document.getElementById("masapembayaranpremijspns").value = '';
					}
					else if (usiasekarang < 55)
					{	
						if (maxmasapembpremi > 55)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else if (usiasekarang = 55)
					{	
						if (maxmasapembpremi > 56)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else
					{
						$("#premijspns").val(data);
					}
				}
			});	


		});
	
		$("#statusjspns").change(function() {

			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			var pensiunperbulanjspns = $("#pensiunperbulanjspns").val();
			var masapembayaranpremijspns = $("#masapembayaranpremijspns").val();
			var statusjspns = $("#statusjspns").val().toUpperCase();
			var carabayarpremijspns = $("#carabayarpremijspns").val().toUpperCase();
			
			var maxmasapembpremi = parseInt(usiasekarang) + parseInt(masapembayaranpremijspns);
			

				$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspns/hitungtarifjspns');?>",
				data	: "pensiunperbulanjspns="+pensiunperbulanjspns+"&masapembayaranpremijspns="+masapembayaranpremijspns+
						  "&usiasekarang="+usiasekarang+"&statusjspns="+statusjspns+"&carabayarpremijspns="+carabayarpremijspns,
				success : function(data) {

					if (usiasekarang > 55)
					{	
						alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
						document.getElementById("premijspns").value = '';
						document.getElementById("masapembayaranpremijspns").value = '';
					}
					else if (usiasekarang < 55)
					{	
						if (maxmasapembpremi > 55)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else if (usiasekarang = 55)
					{	
						if (maxmasapembpremi > 56)
						{
							alert('TIDAK BISA, TURUNKAN MASA PEMBAYARAN PREMI');
							document.getElementById("premijspns").value = '';
							document.getElementById("masapembayaranpremijspns").value = '';
						}
						else
						{
							$("#premijspns").val(data);
						}
					}
					else
					{
						$("#premijspns").val(data);
					}
					
				}
			});	


		}); 
		
		
	});
</script>

													