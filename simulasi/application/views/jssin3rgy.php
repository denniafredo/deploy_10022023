<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
<!--/span-->
	<div class="col-md-6">
                                                    											
		<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

                <h4 class="block">Calon Tertanggung</h4>
                                                                    
                <br>
                <div class="form-group">
                    <label class="control-label col-md-4">Keterangan Medis (Smoker) <span class="required"> * </span> </label>
                    <div class="col-md-6">
                        <select class="form-control select2me" name="calonpemegangpolisperokokjssinergy" id="calonpemegangpolisperokokjssinergy" onChange="">
                            <option value="">Pilih...</option>	
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                </div>
                                                    
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
                        <input type="checkbox" value="1" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onClick="checkedTertanggungSamaDenganPemegangPolis(this)"/> Tertanggung sama dengan Pemegang Polis 
                    </label>
                </div>    
                       
        	<br>									
			</div>
													<!--/span-->
   		 </div>
    </div>
</div>

<h3 class="block" align="center">Pertanggungan</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
						
    <div class="form-group">
    <label class="control-label col-md-4">Pilihan Paket Benefit <span class="required"> * </span></label>
        <div class="col-md-3">
            <select class="form-control select2me" name="pilihanpaketbenefit" id="pilihanpaketbenefit" onChange="">
                <option value="">Pilih Paket Benefit</option>
                <option value="Paket 1">Paket 1</option>
                <option value="Paket 2">Paket 2</option>
                <option value="Paket 3">Paket 3</option>
                <option value="Paket 4">Paket 4</option>
            </select>
        </div>
    </div>		
    <div class="form-group">
    	<label class="control-label col-md-4">Mulai Asuransi<span class="required"> * </span></label>
        <div class="col-md-6">
          <input class="form-control form-control-inline input-small date-picker" id="mulaiasuransi" name="mulaiasuransi" size="16" type="text" value="" placeholder="Mulai Asuransi" onChange=""/>
            <span class="help-block">
                 Masukkan Mulai Asuransi
            </span>
        </div>
    </div>
    <div class="form-group" >
        <label class="control-label col-md-4">Masa Asuransi
            <span class="required">
            
            </span>
        </label>
        
        <div class="col-md-3">
            <input class="form-control" placeholder="Masa Asuransi" type="number" name="masaasuransijssin3rgy" id="masaasuransijssin3rgy" value="10" readonly>
        
        </div>
        
        <span class="help-block">
        	Tahun
        </span>
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Cara Bayar Premi <span class="required"> * </span></label>
        <div class="col-md-3">
            <select class="form-control select2me" name="carabayarpremi" id="carabayarpremi" onChange="">
                <option value="">Cara Bayar Premi</option>
                <option value="Bulanan">1 (Bulanan)</option>
                <option value="Tahunan">2 (Tahunan)</option>
            </select>
        </div>
    </div>
            <div class="form-group">
            <label class="control-label col-md-4">Premi <span class="required"> * </span> </label>
            <div class="col-md-3">
                <div class="input-group">
                    <input class="form-control" placeholder="Premi" type="" name="premijsremaja" id="premijsremaja" onChange="" readonly> 
                    
                </div>
                
            </div>
                <span class="help-block" name="ketcarabayar" id="ketcarabayar">
                    
                </span>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Masa Pembayaran Premi
                    <span class="required">
                    
                    </span>
                </label>
                
                <div class="col-md-3">
                    <input class="form-control" placeholder="Masa Pembayaran Premi" type="number" name="masapembayaranpremi" id="masapembayaranpremi" value="5" readonly>
                
                </div>
                
                <span class="help-block">
                    Tahun
                </span>
                
                
            </div>
			</div>
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                            	Paket
                            </th>
                            <th>
                            	Santunan RI per hari
                            </th>
                            <th>
                             	Santunan ICU/ICCU per hari
                            </th>
                            <th>
                            	Uang Asuransi
                            </th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <tr>
                            <td>Paket 1</td>
                            <td>200000</td>
                            <td>400000</td>
                            <td>25000000</td>
                        </tr>
                        <tr>
                            <td>Paket 2</td>
                            <td>300000</td>
                            <td>600000</td>
                            <td>50000000</td>
                        </tr>
                        <tr>
                            <td>Paket 3</td>
                            <td>400000</td>
                            <td>800000</td>
                            <td>75000000</td>
                        </tr>
                        <tr>
                            <td>Paket 4</td>
                            <td>500000</td>
                            <td>1000000</td>
                            <td>100000000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
											
</div>

<br>

<h3 class="block" align="center">Pilihan Tambahan Manfaat (Rider)</h3>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-6">

<p align="justify">PETUNJUK :  Ketik : 1 , jika "YA" ketik : 0 , jika "TIDAK" Dan harap memilih plan yang diinginkan</p>

<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											 NO
										</th>
										<th>
											 JAMINAN TAMBAHAN
										</th>
                                        <th>
											 Pilihan : 1 atau 0
										</th>
                                        <th name="ketcarabayar" id="ketcarabayar">
											
										</th>
                                        <th>
											 PLAN
										</th>
									</tr>
								</thead>
									
								<tbody>
										<td>1</td>
										<td>JS HCP S</td>
                                        <td>
                                        <select class="form-control select2me" name="hcpjssinergy" id="hcpjssinergy" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjssinergy" id="premihcpjssinergy" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpjssinergy" id="uangasuransihcpjssinergy" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        </td>
									</tr>
									
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjssinergy1" id="totalpremiriderjssinergy1" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>
								</tbody>
							</table>
                            <br>
                            <table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											Manfaat Cash Plan 
										</th>
										<th>
											 Plan
										</th>
                                        <th>
											 R. Inap / hari
										</th>
                                        <th>
											ICU / hari 
										</th>
                                        
									</tr>
								</thead>
									
								<tbody>
                                	<tr>
										<td>Santunan Rawat Inap</td>
										<td>1</td>
                                        <td>100000</td>
										<td>200000</td>
                                        
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>2</td>
                                        <td>200000</td>
										<td>400000</td>
                                        
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>3</td>
                                        <td>300000</td>
										<td>600000</td>
                                        
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>4</td>
                                        <td>400000</td>
										<td>800000</td>
                                        
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>5</td>
                                        <td>500000</td>
										<td>1000000</td>
                                        
									</tr>
								</tbody>
							</table>
						</div>
</div>

<div class="col-md-6">

<p align="justify">PETUNJUK :  Ketik : 1 , jika "YA"      ketik : 0 , jika   "TIDAK"     Dan harap mengisi Uang Asuransi </p>

<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											 No.
										</th>
										<th>
											 Jaminan Tambahan
										</th>
                                        <th>
											 Pilihan : 1/0
										</th>
                                        <th name="ketcarabayar2" id="ketcarabayar2">
											
										</th>
                                        <th>
											 Uang Asuransi
										</th>
									</tr>
								</thead>
									
								<tbody>
                                    <tr>
										<td>1.</td>
										<td>JS ADDB</td>
                                        <td>
                                        <select class="form-control select2me" name="jsaddbjssinergy" id="jsaddbjssinergy" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsaddbjssinergy" id="premijsaddbjssinergy" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsaddbjssinergy" id="uangasuransijsaddbjssinergy" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
										<td>2.</td>
										<td>JS Term</td>
                                        <td>
                                        <select class="form-control select2me" name="termjssinergy" id="termjssinergy" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premitermjssinergy" id="premitermjssinergy" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransitermjssinergy" id="uangasuransitermjssinergy" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td></td>
										<td style="font-weight:bold">TOTAL</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjssinergy2" id="totalpremiriderjssinergy2" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL PREMI RIDER</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjssinergysum" id="totalpremiriderjssinergysum" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>
								</tbody>
							</table>
						</div>
</div>


</div>

<br>

<h3 class="block" align="center">Untuk Pengecekan</h3>
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
											 RIDER
										</th>
                                        <th>
											PREMI + RIDER 
										</th>
									</tr>
								</thead>
									
								<tbody>
                               		<tr>
										<td>Premi Bulanan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremibulanan" id="tabelpremibulanan" onchange="" readonly value="0"></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelriderbulanan" id="tabelriderbulanan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremibulanan" id="tabelriderpremibulanan" onchange="" readonly value="0"></td>
									</tr>
									<tr>
										<td>Premi Tahunan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremi5tahunpertama" id="tabelpremi5tahunpertama" onchange="" readonly value="0"></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelridertahunan" id="tabelridertahunan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremitahunan" id="tabelriderpremitahunan" onchange="" readonly value="0"></td>
									</tr>
                                    
                                    
								</tbody>
							</table>
                        
                            
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
		
		$("#tanggallahircalontertangggung").change(function() {
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			
			if (carabayarpremi == 'Bulanan')
			{
				var ketcarapremi = 'per Bulan';	
			}
			else if (carabayarpremi == 'Tahunan')
			{
				var ketcarapremi = 'per Tahun';	
			}
			
			var span = document.getElementById("ketcarabayar");
			span.textContent = ketcarapremi;
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+carabayarpremi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premijsremaja").val(data);
				}
			});
			
			if (usiasekarang > 55)
			{
				
						alert('Usia Maksimal 55 Tahun!');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');	
			}
			else if (usiasekarang < 20)
			{
				
						alert('Usia Minimal 20 Tahun!');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');	
			}
			
		});
		
		$("#pilihanpaketbenefit").change(function() {
			var pilihanpaketbenefit = $("#pilihanpaketbenefit").val();	
			var carabayarpremi = $("#carabayarpremi").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			
			if (carabayarpremi == 'Bulanan')
			{
				var ketcarapremi = 'per Bulan';	
			}
			else if (carabayarpremi == 'Tahunan')
			{
				var ketcarapremi = 'per Tahun';	
			}
			
			var span = document.getElementById("ketcarabayar");
			span.textContent = ketcarapremi;
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+carabayarpremi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premijsremaja").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+'Bulanan'+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#tabelpremibulanan").val(data);
					
					document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+'Tahunan'+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#tabelpremi5tahunpertama").val(data);

				}
			});
			
		});
		
		$("#carabayarpremi").change(function() {
			var carabayarpremi = $("#carabayarpremi").val();
			var pilihanpaketbenefit = $("#pilihanpaketbenefit").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);	
			
			if (carabayarpremi == 'Bulanan')
			{
				var ketcarapremi = 'per Bulan';	
			}
			else if (carabayarpremi == 'Tahunan')
			{
				var ketcarapremi = 'per Tahun';	
			}
			
			var span = document.getElementById("ketcarabayar");
			span.textContent = ketcarapremi;
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+carabayarpremi+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premijsremaja").val(data);

				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+'Bulanan'+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#tabelpremibulanan").val(data);
					
					document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jssin3rgy/hitungpremijssin3rgy');?>",
				data	: "pilihanpaketbenefit="+pilihanpaketbenefit+"&carabayarpremi="+'Tahunan'+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#tabelpremi5tahunpertama").val(data);

				}
			});
			
		});
		
		$("#calonpemegangpolisperokokjssinergy").change(function() {
			var calonpemegangpolisperokokjssinergy = document.getElementById("#calonpemegangpolisperokokjssinergy").value;
			var termjssinergy = document.getElementById("#termjssinergy").value;
			
			if (calonpemegangpolisperokokjssinergy == 'Ya')
			{	
				if (termjssinergy == 1)
				{
					document.getElementById("uangasuransitermjssinergy").disabled = false;
				}
				else
				{
					alert('Mohon Pilih Keterangan Medis Terlebih Dahulu Untuk Mengambil JS Term!');
					document.getElementById("termjssinergy").value = 0;	
					$('#termjssinergy').trigger('change');
				}
			}
			else if (calonpemegangpolisperokokjssinergy == 'Tidak')
			{
				if (termjssinergy == 1)
				{
					document.getElementById("uangasuransitermjssinergy").disabled = false;
				}
				else
				{
					alert('Mohon Pilih Keterangan Medis Terlebih Dahulu Untuk Mengambil JS Term!');
					document.getElementById("termjssinergy").value = 0;	
					$('#termjssinergy').trigger('change');
				}		
			}
			else
			{
				alert('Mohon Pilih Keterangan Medis Terlebih Dahulu Untuk Mengambil JS Term!');
				document.getElementById("termjssinergy").value = 0;	
				$('#termjssinergy').trigger('change');		
			}
			
		});
		
		
		$("#hcpjssinergy").change(function() {
			var hcpjssinergy = document.getElementById("hcpjssinergy").value;
			
			if (hcpjssinergy == '1')
			{
				$('#uangasuransihcpjssinergy').prop('disabled', false);
				//$('#hcpbjssinergy').prop('disabled', false);
			}
			else if (hcpjssinergy == '0')
			{
				$('#uangasuransihcpjssinergy').prop('disabled', true);
				//$('#hcpbjssinergy').prop('disabled', true);
				
				document.getElementById("uangasuransihcpjssinergy").value = 0;
				$('#uangasuransihcpjssinergy').trigger('change');
				
				document.getElementById("premihcpjssinergy").value = 0;
				$('#premihcpjssinergy').trigger('change');
				
				//document.getElementById("hcpbjssinergy").value = 0;
				//$('#hcpbjssinergy').trigger('change');
				
			}
			
		});
		
		$("#uangasuransihcpjssinergy").change(function() {
			var uangasuransihcpjssinergy = document.getElementById("uangasuransihcpjssinergy").value;
			
			var carabayarpremi = $("#carabayarpremi").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
						data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+'Bulanan',
						success : function(data) {
							$("#premihcpjssinergy").val(data);
							
							document.getElementById("tabelriderbulanan").value = data;
							
						}
					});
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
						data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+'Tahunan',
						success : function(data) {
							$("#premihcpjssinergy").val(data);
							
							document.getElementById("tabelridertahunan").value = data;
							
						}
					});
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
						data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+carabayarpremi,
						success : function(data) {
							$("#premihcpjssinergy").val(data);
							
							document.getElementById("totalpremiriderjssinergy1").value = Math.round(parseInt(document.getElementById("premihcpjssinergy").value)); 
							
							document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
							
//							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergysum").value));
//							
//							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjssinergysum").value);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});	

			
			/*		
			var hcpbjssinergy = document.getElementById("hcpbjssinergy").value;
			
			if (hcpbjssinergy == '1')
			{
				document.getElementById("uangasuransihcpbjssinergy").value = document.getElementById("uangasuransihcpjssinergy").value; 
				$('#uangasuransihcpbjssinergy').trigger('change');
			}
			else if (hcpbjssinergy == '0')
			{
				document.getElementById("uangasuransihcpbjssinergy").value = 0;
				$('#uangasuransihcpbjssinergy').trigger('change');
			}
			*/
			
			});
		

		$("#jsaddbjssinergy").change(function() {
			var jsaddbjssinergy = document.getElementById("jsaddbjssinergy").value;
			
			if (jsaddbjssinergy == '1')
			{
				document.getElementById("uangasuransijsaddbjssinergy").disabled = false;
			}
			else if (jsaddbjssinergy == '0')
			{
				document.getElementById("uangasuransijsaddbjssinergy").disabled = true;	
				document.getElementById("premijsaddbjssinergy").value = 0;
				document.getElementById("uangasuransijsaddbjssinergy").value = 0;	
			}
			
		});
		
	   	$("#uangasuransijsaddbjssinergy").change(function() {
			var uangasuransijsaddbjssinergy = document.getElementById("uangasuransijsaddbjssinergy").value;
			
			var pilihanpaketbenefit = document.getElementById("pilihanpaketbenefit").value;
			
			var uangasuransipokok = 0;
			
			if (pilihanpaketbenefit == 'Paket 1')
			{
				uangasuransipokok =	25000000;
			}
			else if (pilihanpaketbenefit == 'Paket 2')
			{
				uangasuransipokok = 50000000;
			}
			else if (pilihanpaketbenefit == 'Paket 3')
			{
				uangasuransipokok = 75000000;
			}
			else if (pilihanpaketbenefit == 'Paket 4')
			{
				uangasuransipokok = 100000000;
			}
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarpremi = $("#carabayarpremi").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
						data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+'Bulanan',
						success : function(data) {
							$("#premihcpjssinergy").val(data);
							
							document.getElementById("tabelriderbulanan").value = data;
							
						}
					});
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
						data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+'Tahunan',
						success : function(data) {
							$("#premihcpjssinergy").val(data);
							
							document.getElementById("tabelridertahunan").value = data;
							
						}
					});
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jssin3rgy/hitungjstpdsinergy');?>",
						data	: "uangasuransijstpdjssinergy="+uangasuransijsaddbjssinergy+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
						success : function(data) {
							$("#premijsaddbjssinergy").val(data);
							
							if (document.getElementById("premitermjssinergy").value == 'TIDAK BISA')
							{
								//document.getElementById("premitermjssinergy").value = 0;	
								
								document.getElementById("totalpremiriderjssinergy2").value = Math.round(parseInt(document.getElementById("premijsaddbjssinergy").value) + 0); 
							
								document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
	
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("tabelridertahunan").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value));
							
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelriderbulanan").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value));
								
								document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
								
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));	
							}
							else if (document.getElementById("premijsaddbjssinergy").value == 'TIDAK BISA')
							{
								//document.getElementById("premijsaddbjssinergy").value = 0;		
								
								document.getElementById("totalpremiriderjssinergy2").value = Math.round(0 + parseInt(document.getElementById("premitermjssinergy").value)); 
							
								document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
	
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("tabelridertahunan").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value));
							
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelriderbulanan").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value));
								
								document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
								
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							}
							else
							{
								document.getElementById("totalpremiriderjssinergy2").value = Math.round(parseInt(document.getElementById("premijsaddbjssinergy").value) + parseInt(document.getElementById("premitermjssinergy").value)); 
							
								document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
	
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("tabelridertahunan").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value));
							
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelriderbulanan").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value));
								
								document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
								
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));	
							}
						
						}
					});
			
		});	
		
		$("#termjssinergy").change(function() {
			var termjssinergy = document.getElementById("termjssinergy").value;
			
			var	calonpemegangpolisperokokjssinergy  = document.getElementById("calonpemegangpolisperokokjssinergy").value;
			
			if (termjssinergy == '1')
			{
				if (calonpemegangpolisperokokjssinergy == '')
				{
					alert('Mohon Pilih Keterangan Medis Terlebih Dahulu Untuk Mengambil JS Term!');
					document.getElementById("termjssinergy").value = 0;	
					$('#termjssinergy').trigger('change');	
				}
				else
				{
					document.getElementById("uangasuransitermjssinergy").disabled = false;	
				}
			}
			else if (termjssinergy == '0')
			{
				document.getElementById("uangasuransitermjssinergy").disabled = true;
				document.getElementById("premitermjssinergy").value = 0;
				document.getElementById("uangasuransitermjssinergy").value = 0;		
			}
			
		});
		
		
		
		$("#uangasuransitermjssinergy").change(function() {
			var uangasuransitermjssinergy = document.getElementById("uangasuransitermjssinergy").value;
			
			var pilihanpaketbenefit = document.getElementById("pilihanpaketbenefit").value;
			
			var uangasuransipokok = 0;
			
			if (pilihanpaketbenefit == 'Paket 1')
			{
				uangasuransipokok =	25000000;
			}
			else if (pilihanpaketbenefit == 'Paket 2')
			{
				uangasuransipokok = 50000000;
			}
			else if (pilihanpaketbenefit == 'Paket 3')
			{
				uangasuransipokok = 75000000;
			}
			else if (pilihanpaketbenefit == 'Paket 4')
			{
				uangasuransipokok = 100000000;
			}
			
			var calonpemegangpolisperokokjssinergy = document.getElementById("calonpemegangpolisperokokjssinergy").value;
			
			var carabayarpremi = $("#carabayarpremi").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
					if (calonpemegangpolisperokokjssinergy != '')
					{
						
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
							data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+'Bulanan',
							success : function(data) {
								$("#premihcpjssinergy").val(data);

								document.getElementById("tabelriderbulanan").value = data;

							}
						});

						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jssin3rgy/hitunghcpjssinergy');?>",
							data	: "uangasuransihcpjssinergy="+uangasuransihcpjssinergy+"&usiasekarang="+usiasekarang+"&carabayarpremi="+'Tahunan',
							success : function(data) {
								$("#premihcpjssinergy").val(data);

								document.getElementById("tabelridertahunan").value = data;

							}
						});
						
						$.ajax({
									type	: "POST",
									url		: "<?=base_url('jssin3rgy/hitungjstermsinergy');?>",
									data	: "uangasuransitermjssinergy="+uangasuransitermjssinergy+"&usiasekarang="+usiasekarang+"&calonpemegangpolisperokokjssinergy="+calonpemegangpolisperokokjssinergy,
									success : function(data) {
										$("#premitermjssinergy").val(data);
										
										if (document.getElementById("premitermjssinergy").value == 'TIDAK BISA')
										{
											//document.getElementById("premitermjssinergy").value = 0;
											
											document.getElementById("totalpremiriderjssinergy2").value = Math.round(parseInt(document.getElementById("premijsaddbjssinergy").value) + 0); 
										
											document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
											
											document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergysum").value));
											
											document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjssinergysum").value);
											
											document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
											
											document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));		
										}
										else if (document.getElementById("premijsaddbjssinergy").value == 'TIDAK BISA')
										{
											//document.getElementById("premijsaddbjssinergy").value = 0;		
											
											document.getElementById("totalpremiriderjssinergy2").value = Math.round(0 + parseInt(document.getElementById("premitermjssinergy").value)); 
										
											document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
											
											document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergysum").value));
											
											document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjssinergysum").value);
											
											document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
											
											document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
										}
										else
										{
											document.getElementById("totalpremiriderjssinergy2").value = Math.round(parseInt(document.getElementById("premijsaddbjssinergy").value) + parseInt(document.getElementById("premitermjssinergy").value)); 
										
											document.getElementById("totalpremiriderjssinergysum").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergy1").value) + parseInt(document.getElementById("totalpremiriderjssinergy2").value)); 
											
											document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjssinergysum").value));
											
											document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjssinergysum").value);
											
											document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
											
											document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));	
										}
										
									}
								});
						
						}
				else
				{
					alert('Mohon Pilih Keterangan Medis Terlebih Dahulu Untuk Mengambil JS Term!');
					document.getElementById("termjssinergy").value = 0;	
					$('#termjssinergy').trigger('change');	
		
				}
				
			});
		
	   });
</script>