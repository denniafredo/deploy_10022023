<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

<h4 class="block">Calon Tertanggung</h4>

        <div class="form-group">
        <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span> </label>
            <div class="col-md-6">
                <select class="form-control select2me" name="calonpemegangpolisperokokjssiharta" id="calonpemegangpolisperokokjssiharta" onChange="">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
                <option value="">Pilih...</option>	
                </select>
            </div>
        </div>
															
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

<br>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-3">Masa Asuransi / Masa Kontrak<span class="required">
            
            </span>
            </label>
        
            <div class="col-md-3">
            <input class="form-control" placeholder="Masa Asuransi / Masa Kontrak" type="number" name="masaasuransi" id="masaasuransi">
            
            </div>
            <span class="help-block">
            Tahun
            </span>
        </div>
    
    
        <div class="form-group">
            <label class="control-label col-md-4">Saat Mulai Asuransi<span class="required"> * </span></label>
            <div class="col-md-6">
            	<input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransi" name="saatmulaiasuransi" size="16" type="text" value="" placeholder="Saat Mulai Asuransi" onChange=""/>
                <span class="help-block">
                Masukkan Saat Mulai Asuransi
                </span>
            </div>	
        </div>
    
    </div>
													<!--/span-->
													
</div>


<br>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-12">

<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											 CARA BAYAR
										</th>
										<th>
											 PREMI POKOK
										</th>
                                        <th>
											 UANG ASURANSI 
										</th>
                                        
                                        
									</tr>
								</thead>
									
								<tbody>
                               		<tr>
                                        <td>
                                            <select class="form-control select2me" name="carabayar" id="carabayar" onChange="onChangeCaraBayar(this)">
                                                <option value="">[Pilih Cara Bayar]</option>
                                                <option value="Bulanan">Bulanan</option>     
                                                <option value="Kuartalan">Kuartalan</option>
                                                <option value="Semesteran">Semesteran</option>
                                                <option value="Tahunan">Tahunan</option>
                                                <option value="Sekaligus">Sekaligus</option>     
                                            </select>
                                        </td>
                                        <td><input class="form-control" placeholder="Besar Premi" type="number" name="besarpremi" id="besarpremi" onChange="" value="0"></td>
                                        <td><input class="form-control" placeholder="Uang Asuransi" type="number" name="uangasuransi" id="uangasuransi" onchange="" disabled value="0"></td>
                                        
									</tr>
									
								</tbody>
							</table>
                        
                            
						</div>
</div>

</div>
<div style="margin-left:20px; margin-right:20px">
<div class="col-md-12">
<p align="justify"><span class="required">*</span> Untuk menambahkan rider, maka minimum premi plan pokok adalah <b>Bulanan</b>: Rp 300.000  <b>Kuartalan</b>: Rp 500.000 <b>Semesteran</b>: Rp 750.000 <b>Tahunan</b>: Rp 1.500.000 <b>Sekaligus</b>: Rp 12.000.000</p>
</div>
</div>

<script>
jQuery(document).ready(function() {       
      // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
	   
	   $("#saatmulaiasuransi").datepicker("setDate", new Date());
	   
	   $("#carabayar").change(function() {
			var carabayar = $("#carabayar").val();
			var besarpremi = $("#besarpremi").val();
			var uangasuransi = $("#uangasuransi").val();
			
			if (carabayar == "Bulanan")
			{
				document.getElementById('besarpremi').value = 200000;	
				faktorpengali = 25;
				document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
			}
			else if (carabayar == "Kuartalan")
			{
				document.getElementById('besarpremi').value = 600000;	
				faktorpengali = 10;
				document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
			}
			else if (carabayar == "Semesteran")
			{
				document.getElementById('besarpremi').value = 1200000;	
				faktorpengali = 5;
				document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
			}
			else if (carabayar == "Tahunan")
			{
				document.getElementById('besarpremi').value = 2400000;	
				faktorpengali = 2.5;
				document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
			}
			else if (carabayar == "Sekaligus")
			{
				document.getElementById('besarpremi').value = 5000000;	
				document.getElementById('uangasuransi').value = document.getElementById('besarpremi').value;
			}
			
		});
		
		 $("#besarpremi").change(function() {
			var besarpremi = $("#besarpremi").val();
			var carabayar = $("#carabayar").val();
			var uangasuransi = $("#uangasuransi").val();
			
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var premiberkala = $("#premiberkala").val();
			var carabayar = $("#carabayar").val();	
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if (carabayar == "Bulanan")
			{	
				minimalpremi = 200000;
				if (besarpremi < minimalpremi)
				{
					alert('Minimal Premi Rp. '+minimalpremi);
				document.getElementById('besarpremi').value = minimalpremi;					
				}
				else
				{
					faktorpengali = 25;
					document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
				}
			}
			else if (carabayar == "Kuartalan")
			{	
				minimalpremi = 600000;
				if (besarpremi < minimalpremi)
				{
					alert('Minimal Premi Rp. '+minimalpremi);
				document.getElementById('besarpremi').value = minimalpremi;					
				}
				else
				{
					faktorpengali = 10;
					document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
				}
			}
			else if (carabayar == "Semesteran")
			{	
				minimalpremi =  1200000;
				if (besarpremi < minimalpremi)
				{
					alert('Minimal Premi Rp. '+minimalpremi);
				document.getElementById('besarpremi').value = minimalpremi;					
				}
				else
				{
					faktorpengali = 5;
					document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
				}
			}
			else if (carabayar == "Tahunan")
			{
				minimalpremi = 2400000;
				if (besarpremi < minimalpremi)
				{
					alert('Minimal Premi Rp. '+minimalpremi);
				document.getElementById('besarpremi').value = minimalpremi;					
				}
				else
				{
					faktorpengali = 2.5;
					document.getElementById('uangasuransi').value = faktorpengali * document.getElementById('besarpremi').value;
				}
			}
			else if (carabayar == "Sekaligus")
			{	
				minimalpremi = 5000000;
				if (besarpremi < minimalpremi)
				{
					alert('Minimal Premi Rp. '+minimalpremi);
				document.getElementById('besarpremi').value = minimalpremi;					
				}
				else
				{
					document.getElementById('uangasuransi').value = document.getElementById('besarpremi').value;
				}
			}
			
			var ci53jssiharta = document.getElementById("ci53jssiharta").value;
						
			if (ci53jssiharta == 0)
			{
				document.getElementById("uangasuransici53jssiharta").value = 0;
				document.getElementById("premici53jssiharta").value = 0;
			}
			else if (ci53jssiharta == 1)
			{
				document.getElementById("uangasuransici53jssiharta").value = $("#uangasuransi").val();
			}
			
			var uangasuransici53jssiharta = $("#uangasuransici53jssiharta").val();
			var jeniskelamincalontertanggung= $("#jeniskelamincalontertanggung").val();
						
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssiharta/hitungpremici53jssiharta');?>",
				data	: "uangasuransici53jssiharta="+uangasuransici53jssiharta+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
				success : function(data) {
					$("#premici53jssiharta").val(data);
					
				}
			});
			
		});
		
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
		
		$("#tanggallahircalontertangggung").change(function() {
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if (usiasekarang > 60)
			{
				
						alert('Usia Maksimal 60 Tahun!');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');	
			}
			else if (usiasekarang < 19)
			{

				
						alert('Usia Minimal 19 Tahun!');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');	
			}
			
		});
		
		$("#ci53jssiharta").change(function() {
			var ci53jssiharta = document.getElementById("ci53jssiharta").value;
						
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var premiberkala = $("#premiberkala").val();
			var carabayar = $("#carabayar").val();	
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if (ci53jssiharta == 0)
			{
				document.getElementById("uangasuransici53jssiharta").value = 0;
				document.getElementById("premici53jssiharta").value = 0;
			}
			else if (ci53jssiharta == 1)
			{
				document.getElementById("uangasuransici53jssiharta").value = $("#uangasuransi").val();
			}
			
			var uangasuransici53jssiharta = $("#uangasuransici53jssiharta").val();
			var jeniskelamincalontertanggung= $("#jeniskelamincalontertanggung").val();
						
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssiharta/hitungpremici53jssiharta');?>",
				data	: "uangasuransici53jssiharta="+uangasuransici53jssiharta+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
				success : function(data) {
					if (carabayar == "Bulanan")
					{
						data = Math.round(data * 0.095);	
					}
					else if (carabayar == "Kuartalan")
					{
						data = Math.round(data * 0.27);	
					}
					else if (carabayar == "Semesteran")
					{
						data = Math.round(data * 0.52);	
					}
					else if (carabayar == "Tahunan")
					{
						data = Math.round(data);	
					}
					else if (carabayar == "Sekaligus")
					{
						data = Math.round(data * 0);	
					}
					
					$("#premici53jssiharta").val(data);
					
				}
			});
			
		});
		
		$("#termjssiharta").change(function() {
			var termjssiharta = document.getElementById("termjssiharta").value;
			
			if (termjssiharta == 0)
			{
				document.getElementById("premitermjssiharta").value = 0;
				document.getElementById("uangasuransitermjssiharta").value = 0;
				$('#uangasuransitermjssiharta').prop('disabled', true);
			}
			else if (termjssiharta == 1)
			{
				$('#uangasuransitermjssiharta').prop('disabled', false);	
			}
		});
		
		$("#uangasuransitermjssiharta").change(function() {
			
			var uangasuransi = $("#uangasuransi").val();
			
			var uangasuransitermjssiharta = $("#uangasuransitermjssiharta").val();
			
			var calonpemegangpolisperokokjssiharta = $("#calonpemegangpolisperokokjssiharta").val();
			
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var premiberkala = $("#premiberkala").val();
			var carabayar = $("#carabayar").val();	
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssiharta/hitungpremitermjssiharta');?>",
				data	: "uangasuransitermjssiharta="+uangasuransitermjssiharta+"&usiasekarang="+usiasekarang+"&calonpemegangpolisperokokjssiharta="+calonpemegangpolisperokokjssiharta+"&uangasuransi="+uangasuransi,
				success : function(data) {
					if (carabayar == "Bulanan")
					{
						data = Math.round(data * 0.095);	
					}
					else if (carabayar == "Kuartalan")
					{
						data = Math.round(data * 0.27);	
					}
					else if (carabayar == "Semesteran")
					{
						data = Math.round(data * 0.52);	
					}
					else if (carabayar == "Tahunan")
					{
						data = Math.round(data);	
					}
					else if (carabayar == "Sekaligus")
					{
						data = Math.round(data * 0);	
					}
					
					$("#premitermjssiharta").val(data);
					
										
					
				}
			});
				
		});
		
		$("#hcpjssiharta").change(function() {
			var hcpjssiharta = document.getElementById("hcpjssiharta").value;
			var hcpbjssiharta = document.getElementById("hcpbjssiharta").value;
			
			if (hcpjssiharta == 0)
			{
				$('#uangasuransihcpjssiharta').prop('disabled', true);
				document.getElementById("premihcpjssiharta").value = 0;
				document.getElementById("uangasuransihcpjssiharta").value = 0;
				$('#uangasuransihcpjssiharta').trigger('change');
				$('#uangasuransihcpbjssiharta').prop('disabled', true);
				document.getElementById("premihcpbjssiharta").value = 0;
				document.getElementById("uangasuransihcpbjssiharta").value = 0;
				$('#uangasuransihcpbjssiharta').trigger('change');
				document.getElementById("hcpbjssiharta").value = 0;
				$('#hcpbjssiharta').prop('disabled', true);
				$('#hcpbjssiharta').trigger('change');
			}
			else if (hcpjssiharta == 1)
			{
				$('#uangasuransihcpjssiharta').prop('disabled', false);
				//$('#uangasuransihcpbjssiharta').prop('disabled', false);
				$('#hcpbjssiharta').prop('disabled', false);
				
				
			}
			
		});
		
		
		$("#hcpbjssiharta").change(function() {
			var hcpbjssiharta = document.getElementById("hcpbjssiharta").value;
			
			if (hcpbjssiharta == 0)
			{
				$('#uangasuransihcpbjssiharta').prop('disabled', true);
				document.getElementById("premihcpbjssiharta").value = 0;
				document.getElementById("uangasuransihcpbjssiharta").value = 0;
				$('#uangasuransihcpbjssiharta').trigger('change');
			}
			else if (hcpbjssiharta == 1)
			{
				//$('#uangasuransihcpbjssiharta').prop('disabled', false);	
				document.getElementById("uangasuransihcpbjssiharta").value = $("#uangasuransihcpjssiharta").val();
				$('#uangasuransihcpbjssiharta').trigger('change');
			}
		});
		
		
		$("#uangasuransihcpjssiharta").change(function() {
			var uangasuransihcpjssiharta = document.getElementById("uangasuransihcpjssiharta").value;
			
			var jeniskelamincalontertanggung= $("#jeniskelamincalontertanggung").val();
			
			var carabayar = $("#carabayar").val();	
			
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var plafon;
			
			if (uangasuransihcpjssiharta == 0)
			{
				plafon = 0;	
			}
			else if (uangasuransihcpjssiharta == 1)
			{
				plafon = 1;	
			}
			else if (uangasuransihcpjssiharta == 2)
			{
				plafon = 2;
			}
			else if (uangasuransihcpjssiharta == 3)
			{
				plafon = 3;
			}
			else if (uangasuransihcpjssiharta == 4)
			{
				plafon = 4;	
			}
			else if (uangasuransihcpjssiharta == 5)
			{
				plafon = 5;	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssiharta/hitungpremijshcp');?>",
				data	: "uangasuransihcpjssiharta="+uangasuransihcpjssiharta+"&usiasekarang="+usiasekarang+"&plafon="+plafon+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
				success : function(data) {
					if (carabayar == "Bulanan")
					{
						data = Math.round(data * 0.095);	
					}
					else if (carabayar == "Kuartalan")
					{
						data = Math.round(data * 0.27);	
					}
					else if (carabayar == "Semesteran")
					{
						data = Math.round(data * 0.52);	
					}
					else if (carabayar == "Tahunan")
					{
						data = Math.round(data);	
					}
					else if (carabayar == "Sekaligus")
					{
						data = Math.round(data * 0);	
					}
					
					$("#premihcpjssiharta").val(data);
					
				}
			});
		});
		
		$("#uangasuransihcpbjssiharta").change(function() {
			var uangasuransihcpbjssiharta = document.getElementById("uangasuransihcpbjssiharta").value;
			
			var jeniskelamincalontertanggung= $("#jeniskelamincalontertanggung").val();
			
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var plafon;
			
			var carabayar = $("#carabayar").val();	
			
			if (uangasuransihcpbjssiharta == 0)
			{

				plafon = 0;		
			}
			else if (uangasuransihcpbjssiharta == 1)
			{
				plafon = 1;
					
			}
			else if (uangasuransihcpbjssiharta == 2)
			{
				plafon = 2;	
			}
			else if (uangasuransihcpbjssiharta == 3)
			{
				plafon = 3;	
			}
			else if (uangasuransihcpbjssiharta == 4)
			{
				plafon = 4;
			}
			else if (uangasuransihcpbjssiharta == 5)
			{
				plafon = 5;	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssiharta/hitungpremijshcpb');?>",
				data	: "uangasuransihcpbjssiharta="+uangasuransihcpbjssiharta+"&usiasekarang="+usiasekarang+"&plafon="+plafon+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
				success : function(data) {
					if (carabayar == "Bulanan")
					{
						data = Math.round(data * 0.095);	
					}
					else if (carabayar == "Kuartalan")
					{
						data = Math.round(data * 0.27);	
					}
					else if (carabayar == "Semesteran")
					{
						data = Math.round(data * 0.52);	
					}
					else if (carabayar == "Tahunan")
					{
						data = Math.round(data);	
					}
					else if (carabayar == "Sekaligus")
					{
						data = Math.round(data * 0);	
					}
					
					$("#premihcpbjssiharta").val(data);
					
				}
			});
		});
		
		$("#jeniskelamincalontertanggung").change(function() {
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			if (jeniskelamincalontertanggung == 'Perempuan')
			{
				$('#hcpjssiharta').prop('disabled', false);
				//$('#hcpbjssiharta').prop('disabled', false);
				//$('#uangasuransihcpjssiharta').prop('disabled', false);
				//$('#uangasuransihcpbjssiharta').prop('disabled', false);
			}
			else if (jeniskelamincalontertanggung == 'Laki-Laki')
			{
				$('#hcpjssiharta').prop('disabled', true);
				//$('#hcpbjssiharta').prop('disabled', true);
				//$('#uangasuransihcpjssiharta').prop('disabled', true);
				//$('#uangasuransihcpbjssiharta').prop('disabled', true);
			}
			
		});
	   
	   });
</script>