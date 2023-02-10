<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-12">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

<h4 class="block">Calon Tertanggung</h4>
															
                                            <br>
        <div class="form-group">
        	<label class="control-label col-md-4">Hubungan dgn PemPol <span class="required"> * </span></label>
            <div class="col-md-3">
                <select class="form-control select2me" name="hubungandenganpempol" id="hubungandenganpempol" onChange="onHandleHubunganDenganPempol(this)">
                    <option value="">[Pilih Hubungan Dengan Pemegang Polis]</option>
                    <option value="Suami/Istri">Suami/Istri</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Keterangan Medis (Smoker) <span class="required"> * </span> </label>
            <div class="col-md-6">
                <select class="form-control select2me" name="calonpemegangpolisperokokjsdwiguna" id="calonpemegangpolisperokokjsdwiguna" onChange="">
                    <option value="">Pilih...</option>	
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>usia
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
						
        <div class="form-group" style="display:none">
            <label class="control-label col-md-4">Cara Bayar Premi <span class="required"> * </span></label>
            <div class="col-md-3">
                <select class="form-control select2me" name="carabayarpremijsdwiguna" id="carabayarpremijsdwiguna" onChange="">
                    <option value="">Cara Bayar Premi</option>
                    <option value="Tahunan">Tahunan</option>
                    <option value="Sekaligus">Sekaligus</option>
                </select>
            </div>
        </div>                								
        <div class="form-group">
            <label class="control-label col-md-3">Masa Asuransi / Masa Kontrak<span class="required">
            
            </span></label>
            
            <div class="col-md-3">
            <input class="form-control" placeholder="Masa Asuransi / Masa Kontrak" type="number" name="masaasuransi" id="masaasuransi">
            
            </div>
            <span class="help-block">
            Tahun
            </span>
        </div>
                                    <div class="form-group">
									  <label class="control-label col-md-4">Uang Asuransi Pokok <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Uang Asuransi Pokok" type="number" name="uangasuransipokok" id="uangasuransipokok" onChange="" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>

													</div>
													<!--/span-->
													
</div>

<br>

<h3 id="keteranganrider" name="keteranganrider" class="block" align="center">Pilihan Tambahan Manfaat (Rider)</h3>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row" id="riderjsdwiguna" name="riderjsdwiguna">
<div class="col-md-6">

<p align="justify">PETUNJUK: Ketik: 1, jika "YA" ketik: 0, jika "TIDAK" Dan harap mengisi Uang Asuransi kecuali untuk JS Hospital Cash Plan</p>

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
                                        <th>
											Premi
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
                                        <select class="form-control select2me" name="jsaddbjsdwiguna" id="jsaddbjsdwiguna" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsaddbjsdwiguna" id="premijsaddbjsdwiguna" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsaddbjsdwiguna" id="uangasuransijsaddbjsdwiguna" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>2.</td>
										<td>JS TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jstpdjsdwiguna" id="jstpdjsdwiguna" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstpdjsdwiguna" id="premijstpdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstpdjsdwiguna" id="uangasuransijstpdjsdwiguna" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
										<td>3.</td>
										<td>JS Waiver TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jswaivertpdjsdwiguna" id="jswaivertpdjsdwiguna" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijswaivertpdjsdwiguna" id="premijswaivertpdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijswaivertpdjsdwiguna" id="uangasuransijswaivertpdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>4.</td>
										<td>JS CI53</td>
                                        <td>
                                        <select class="form-control select2me" name="jsci53jsdwiguna" id="jsci53jsdwiguna" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsci53jsdwiguna" id="premijsci53jsdwiguna" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsci53jsdwiguna" id="uangasuransijsci53jsdwiguna" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>5.</td>
										<td>JS Term</td>
                                        <td>
                                        <select class="form-control select2me" name="jstermjsdwiguna" id="jstermjsdwiguna" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstermjsdwiguna" id="premijstermjsdwiguna" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstermjsdwiguna" id="uangasuransijstermjsdwiguna" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>6.</td>
										<td>JS SP-D</td>
                                        <td>
                                        <select class="form-control select2me" name="jsspdjsdwiguna" id="jsspdjsdwiguna" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsspdjsdwiguna" id="premijsspdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsspdjsdwiguna" id="uangasuransijsspdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>7.</td>
										<td>JS SP-TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jssptpdjsdwiguna" id="jssptpdjsdwiguna" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijssptpdjsdwiguna" id="premijssptpdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijssptpdjsdwiguna" id="uangasuransijssptpdjsdwiguna" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL PREMI RIDER</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjsdwigunasum" id="totalpremiriderjsdwigunasum" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>
								</tbody>
							</table>
						</div>
</div>

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
                                        <th style="display:none">
											 
										</th>
                                        <th>
											 
										</th>
                                        <th>
											 
										</th>
                                        <th>
											PLAN 
										</th>
                                        
                                        
									</tr>
								</thead>
									
								<tbody>
										<td>1</td>
										<td>JS Cash Plan</td>
                                        <td>
                                        <select class="form-control select2me" name="hcpjsdwiguna" id="hcpjsdwiguna" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjsdwiguna2" id="premihcpjsdwiguna2" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjsdwiguna" id="premihcpjsdwiguna" onChange="" value="0" style="display:none">
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpjsdwiguna" id="uangasuransihcpjsdwiguna" onChange="" disabled>
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
										<td>JS Cash Plan Bedah</td>
                                        <td>
                                        <select class="form-control select2me" name="hcpbjsdwiguna" id="hcpbjsdwiguna" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpbjsdwiguna2" id="premihcpbjsdwiguna2" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="premihcpbjsdwiguna" id="premihcpbjsdwiguna" onChange="" value="0" style="display:none">
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpbjsdwiguna" id="uangasuransihcpbjsdwiguna" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        </td>
									</tr>
									
								</tbody>
							</table>
                            <br>
                            <table class="table table-striped table-hover">
								<thead>
									<tr>
                                    	<th>
											Manfaat 
										</th>
										<th>
											JS Hospital Cash Plan
										</th>
										<th>
											JS Hospital Cash Plan Bedah
										</th>
                                        
									</tr>
								</thead>
									
								<tbody>
                                	<tr>
										<td>1</td>
                                        <td>Rp. 100.000,-/hari</td>
										<td>Rp. 1.000.000,-/hari</td>
									</tr>
                                    <tr>
										<td>2</td>
                                        <td>Rp. 200.000,-/hari</td>
										<td>Rp. 2.000.000,-/hari</td>
									</tr>
                                    <tr>
										<td>3</td>
                                        <td>Rp. 300.000,-/hari</td>
										<td>Rp. 3.000.000,-/hari</td>
									</tr>
                                    <tr>
										<td>4</td>
                                        <td>Rp. 400.000,-/hari</td>
										<td>Rp. 4.000.000,-/hari</td>
									</tr>
                                    <tr>
										<td>5</td>
                                        <td>Rp. 500.000,-/hari</td>
										<td>Rp. 5.000.000,-/hari</td>
									</tr>
								</tbody>
							</table>
						</div>
                        
                        
                        <p style="color:#FF0000" align="justify">Syarat dan Ketentuan: </p>
                        <p align="justify"><li style="color:#FF0000">Jika ingin mengambil Cash Plan Bedah maka harus mengambil Cash Plan Murni dengan kelas yang sama.</li></p>
                        <p align="justify"><li style="color:#FF0000">Untuk menambahkan rider, maka minimum premi plan pokok adalah Bulanan: Rp. 300.000,- Kuartalan: Rp. 500.000,- Semesteran: Rp. 750.000,- Tahunan: Rp. 1.500.000,- Sekaligus: Rp. 12.000.000,- </li></p>
                        <p align="justify"><li style="color:#FF0000">Minimal Uang Asuransi Rider adalah Rp. 5.000.000,- dan maksimal 200% Uang Asuransi Pokok. </li></p>
</div>
	

</div>


<br>

<h3 class="block" align="center">Pengecekan Hasil Entri Data</h3>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
	<div class="col-md-6">		
        <div class="form-group" id="formpremisekaligus">
            <label class="control-label col-md-4">Premi Sekaligus <span class="required"> * </span> </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input class="form-control" placeholder="" type="number" name="tabelpremisekaligus" id="tabelpremisekaligus" onchange="" disabled>
                        <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
                    </div>
                </div>
            </div>
        <div class="form-group" id="formpremitahunan">
            <label class="control-label col-md-4">Premi Tahunan <span class="required"> * </span> </label>
                <div class="col-md-6">
                    <div class="input-group">
                    <input class="form-control" placeholder="" type="number" name="tabelpremitahunan" id="tabelpremitahunan" onchange="" disabled>
                    <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
                    </div>
                </div>
        </div>
        <div class="form-group" id="formpremibulanan">
        	<label class="control-label col-md-4">Premi Bulanan <span class="required"> * </span> </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input class="form-control" placeholder="" type="number" name="tabelpremibulanan" id="tabelpremibulanan" onchange="" disabled>
                    <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
                </div>
            </div>
        </div>
        <div class="form-group" id="formpremikuartalan">
        	<label class="control-label col-md-4">Premi Kuartalan <span class="required"> * </span> </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input class="form-control" placeholder="" type="number" name="tabelpremikuartalan" id="tabelpremikuartalan" onchange="" disabled>
                    <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
                </div>
            </div>
        </div>
        <div class="form-group" id="formpremisemesteran">
        	<label class="control-label col-md-4">Premi Semesteran <span class="required"> * </span> </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input class="form-control" placeholder="" type="number" name="tabelpremisemesteran" id="tabelpremisemesteran" onchange="" disabled>
                    <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Total Premi (Pokok+Rider)<span class="required"> * </span> </label>
            <div class="col-md-6">
                <div class="input-group">
                	<input class="form-control" placeholder="" type="number" name="totalpokokpremirider" id="totalpokokpremirider" onchange="" disabled>
                </div>
            </div>
        </div>
	</div>
													<!--/span-->
													
</div>

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
					
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
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
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			if (usiasekarang > 60)
			{
				
						alert('Usia Maksimal 60 Tahun!');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');	
			}
			else if (usiasekarang < 17)
			{
				
						alert('Usia Minimal 17 Tahun!');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');	
			}
			
		});
		
		$("#masaasuransi").change(function() {
			var msasuransi = $("#masaasuransi").val();	
			if (msasuransi > 35)
			{
				alert('Masa asuransi maksimal 35 tahun!');	
				document.getElementById('masaasuransi').value = 0;
				alert.stop();
			}
			else if (msasuransi < 0)
			{
				alert('Masa asuransi tidak boleh kurang dari batas minimal!');
				document.getElementById('masaasuransi').value = 0;
				alert.stop();	
			}
			else
			{
				var uangasuransipokok = $("#uangasuransipokok").val();	
				
				var masaasuransi = parseInt($("#masaasuransi").val());
				
				var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				if ((usiasekarang <= 20) && (usiasekarang >= 17))
				{
					usiasekarang = 20;
				}
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdwiguna/hitungpremisekaligusdwiguna');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
							success : function(data) {
								$("#tabelpremisekaligus").val(data);
								
								document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
								document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
							}
						});
						
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdwiguna/hitungpremitahunandwiguna');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
							success : function(data) {
								$("#tabelpremitahunan").val(data);
								
								document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
								document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
							}
						});
						
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsdwiguna/hitungpremibulanandwiguna');?>",
					data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#tabelpremibulanan").val(data);
						
						document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
						document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
					}
				});
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsdwiguna/hitungpremikuartalandwiguna');?>",
					data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#tabelpremikuartalan").val(data);
						
						document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
						document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
					}
				});
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsdwiguna/hitungpremisemesterandwiguna');?>",
					data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#tabelpremisemesteran").val(data);
						
						document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
						document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
					}
				});
					
			}
		});
		
		$("#uangasuransipokok").change(function() {
			var masaasuransi = parseInt($("#masaasuransi").val());	
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungpremisekaligusdwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremisekaligus").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});
					
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungpremitahunandwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremitahunan").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});
					
			$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsdwiguna/hitungpremibulanandwiguna');?>",
					data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#tabelpremibulanan").val(data);
						
						document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
						document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
					}
				});
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsdwiguna/hitungpremikuartalandwiguna');?>",
					data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#tabelpremikuartalan").val(data);
						
						document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
						document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
					}
				});
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsdwiguna/hitungpremisemesterandwiguna');?>",
					data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#tabelpremisemesteran").val(data);
						
						document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
						document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
					}
				});
					
			
		});
		
		$("#calonpemegangpolisperokokjsdwiguna").change(function() {
			var calonpemegangpolisperokokjsdwiguna = document.getElementById("calonpemegangpolisperokokjsdwiguna").value;
			
			var uangasuransijstermjsdwiguna = document.getElementById("uangasuransijstermjsdwiguna").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
				if (calonpemegangpolisperokokjsdwiguna!="")
				{
					$.ajax({
								type	: "POST",
								url		: "<?=base_url('jsdwiguna/hitungjstermdwiguna');?>",
								data	: "uangasuransijstermjsdwiguna="+uangasuransijstermjsdwiguna+"&usiasekarang="+usiasekarang+"&calonpemegangpolisperokokjsdwiguna="+calonpemegangpolisperokokjsdwiguna,
								success : function(data) {
									$("#premijstermjsdwiguna").val(data);
									
									document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
									document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
								}
							});
				}
		});
		
		$("#hubungandenganpempol").change(function() {
			var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
			
			if (hubungandenganpempol == "Suami/Istri")
			{
				document.getElementById("jsspdjsdwiguna").disabled = false;
				document.getElementById("jssptpdjsdwiguna").disabled = false;	
			}
			else
			{
				document.getElementById("jsspdjsdwiguna").disabled = true;
				document.getElementById("jssptpdjsdwiguna").disabled = true;	
				
				document.getElementById("uangasuransijsspdjsdwiguna").disabled = true;
				document.getElementById("premijsspdjsdwiguna").value = 0;	
				document.getElementById("uangasuransijsspdjsdwiguna").value = 0;
				
				document.getElementById("uangasuransijssptpdjsdwiguna").disabled = true;
				document.getElementById("premijssptpdjsdwiguna").value = 0;	
				document.getElementById("uangasuransijssptpdjsdwiguna").value = 0;
			}
		
		});
		
				
		//RIDER
		
		$("#jsaddbjsdwiguna").change(function() {
			var jsaddbjsdwiguna = document.getElementById("jsaddbjsdwiguna").value;
			
			if (jsaddbjsdwiguna == '1')
			{
				document.getElementById("uangasuransijsaddbjsdwiguna").disabled = false;
			}
			else if (jsaddbjsdwiguna == '0')
			{
				document.getElementById("uangasuransijsaddbjsdwiguna").disabled = true;	
				document.getElementById("premijsaddbjsdwiguna").value = 0;
				document.getElementById("uangasuransijsaddbjsdwiguna").value = 0;	
				
				document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
				document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
			}
			
		});
		
		$("#uangasuransijsaddbjsdwiguna").change(function() {
			var uangasuransijsaddbjsdwiguna = document.getElementById("uangasuransijsaddbjsdwiguna").value;
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			if ((uangasuransijsaddbjsdwiguna > (3*uangasuransipokok)) || (uangasuransijsaddbjsdwiguna > 500000000))
			{
				alert('Uang Asuransi  JS ADDB Melebihi batas maksimum!');	
				document.getElementById("uangasuransijsaddbjsdwiguna").value = uangasuransipokok;
			}
			else if (uangasuransijsaddbjsdwiguna < uangasuransipokok)
			{
				alert('Uang Asuransi JS ADDB tidak boleh kurang dari UA Dasar!');
				document.getElementById("uangasuransijsaddbjsdwiguna").value = uangasuransipokok;
			}
			else
			{
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjsaddbdwiguna');?>",
						data	: "uangasuransijsaddbjsdwiguna="+uangasuransijsaddbjsdwiguna+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
						success : function(data) {
							$("#premijsaddbjsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});
			}
		});	
		
		$("#jstpdjsdwiguna").change(function() {
			var jstpdjsdwiguna = document.getElementById("jstpdjsdwiguna").value;
			
			if (jstpdjsdwiguna == '1')
			{
				document.getElementById("uangasuransijstpdjsdwiguna").disabled = false;	
			}
			else if (jstpdjsdwiguna == '0')
			{
				document.getElementById("uangasuransijstpdjsdwiguna").disabled = true;
				document.getElementById("premijstpdjsdwiguna").value = 0;	
				document.getElementById("uangasuransijstpdjsdwiguna").value = 0;		
			}
			
		});
		
		$("#uangasuransijstpdjsdwiguna").change(function() {
			var uangasuransijstpdjsdwiguna = document.getElementById("uangasuransijstpdjsdwiguna").value;
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			if ((uangasuransijstpdjsdwiguna > (3*uangasuransipokok)) || (uangasuransijstpdjsdwiguna > 1500000000))
			{
				alert('Uang Asuransi  JS TPD Melebihi batas maksimum!');	
				document.getElementById("uangasuransijstpdjsdwiguna").value = uangasuransipokok;
			}
			else if (uangasuransijstpdjsdwiguna < uangasuransipokok)
			{
				alert('Uang Asuransi JS TPD tidak boleh kurang dari UA Dasar!');
				document.getElementById("uangasuransijstpdjsdwiguna").value = uangasuransipokok;
			}
			else
			{
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjstpddwiguna');?>",
						data	: "uangasuransijstpdjsdwiguna="+uangasuransijstpdjsdwiguna+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
						success : function(data) {
							$("#premijstpdjsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});
			}
		});
		
		$("#jswaivertpdjsdwiguna").change(function() {
			var jswaivertpdjsdwiguna = document.getElementById("jswaivertpdjsdwiguna").value;
			
			var masaasuransi = parseInt($("#masaasuransi").val());
			
			var jeniskelamincalontertanggung =	document.getElementById("jeniskelamincalontertanggung").value;
			
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			if (jswaivertpdjsdwiguna == '1')
			{
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungpremitahunandwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#uangasuransijswaivertpdjsdwiguna").val(data);

						}
					});	

				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjswaivertpdjsdwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi,
						success : function(data) {
							$("#premijswaivertpdjsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});		
			}
			else if (jswaivertpdjsdwiguna == '0')
			{
				//document.getElementById("uangasuransijswaivertpdjsdwiguna").disabled = true;
				document.getElementById("premijswaivertpdjsdwiguna").value = 0;	
				document.getElementById("uangasuransijswaivertpdjsdwiguna").value = 0;
				
				document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)); 		
				document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
			}
			
		});
		
		$("#jsci53jsdwiguna").change(function() {
			var jsci53jsdwiguna = document.getElementById("jsci53jsdwiguna").value;
			
			if (jsci53jsdwiguna == '1')
			{
				document.getElementById("uangasuransijsci53jsdwiguna").disabled = false;
			}
			else if (jsci53jsdwiguna == '0')
			{
				document.getElementById("uangasuransijsci53jsdwiguna").disabled = true;
				document.getElementById("premijsci53jsdwiguna").value = 0;
				document.getElementById("uangasuransijsci53jsdwiguna").value = 0;	
				
				document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)); 
				document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
			}
			
		});
		
		$("#uangasuransijsci53jsdwiguna").change(function() {
			var uangasuransijsci53jsdwiguna = document.getElementById("uangasuransijsci53jsdwiguna").value;
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			
			if ((uangasuransijsci53jsdwiguna > (3*uangasuransipokok)) || (uangasuransijsci53jsdwiguna > 1500000000))
			{
				alert('Uang Asuransi  JS CI53 Melebihi batas maksimum!');	
				document.getElementById("uangasuransijsci53jsdwiguna").value = uangasuransipokok;
			}
			else if (uangasuransijsci53jsdwiguna < uangasuransipokok)
			{
				alert('Uang Asuransi JS CI53 tidak boleh kurang dari UA Dasar!');
				document.getElementById("uangasuransijsci53jsdwiguna").value = uangasuransipokok;
			}
			else
			{
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjsci53dwiguna');?>",
						data	: "uangasuransijsci53jsdwiguna="+uangasuransijsci53jsdwiguna+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung,
						success : function(data) {
							$("#premijsci53jsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});
					
			}
			
		});
		
		$("#jstermjsdwiguna").change(function() {
			var jstermjsdwiguna = document.getElementById("jstermjsdwiguna").value;
			
			var calonpemegangpolisperokokjsdwiguna = document.getElementById("calonpemegangpolisperokokjsdwiguna").value;
			
			if (jstermjsdwiguna == '1')
			{
				if (calonpemegangpolisperokokjsdwiguna == '')
				{
					alert('Keterangan Medis tidak boleh kosong!');	
					$('#jstermjsdwiguna').val(0).trigger('change');
					//document.getElementById("uangasuransijstermjsdwiguna").disabled = true;	
					
				}
				else
				{
					document.getElementById("uangasuransijstermjsdwiguna").disabled = false;	
				}
			}
			else if (jstermjsdwiguna == '0')
			{
				document.getElementById("uangasuransijstermjsdwiguna").disabled = true;
				document.getElementById("premijstermjsdwiguna").value = 0;
				document.getElementById("uangasuransijstermjsdwiguna").value = 0;	
				
				document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)); 	
				document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
			}
			
		});
		
		$("#uangasuransijstermjsdwiguna").change(function() {
			var uangasuransijstermjsdwiguna = document.getElementById("uangasuransijstermjsdwiguna").value;
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			var calonpemegangpolisperokokjsdwiguna = document.getElementById("calonpemegangpolisperokokjsdwiguna").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			if ((uangasuransijstermjsdwiguna > (3*uangasuransipokok)) || (uangasuransijstermjsdwiguna > 1500000000))
			{
				alert('Uang Asuransi  JS TERM Melebihi batas maksimum!');	
				document.getElementById("uangasuransijstermjsdwiguna").value = uangasuransipokok;
			}
			else if (uangasuransijstermjsdwiguna < uangasuransipokok)
			{
				alert('Uang Asuransi JS TERM tidak boleh kurang dari UA Dasar!');
				document.getElementById("uangasuransijstermjsdwiguna").value = uangasuransipokok;
			}
			else
			{
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjstermdwiguna');?>",
						data	: "uangasuransijstermjsdwiguna="+uangasuransijstermjsdwiguna+"&usiasekarang="+usiasekarang+"&calonpemegangpolisperokokjsdwiguna="+calonpemegangpolisperokokjsdwiguna,
						success : function(data) {
							$("#premijstermjsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});
					
			}
						
		});
		
		$("#jsspdjsdwiguna").change(function() {
			var jsspdjsdwiguna = document.getElementById("jsspdjsdwiguna").value;
			
			var masaasuransi = parseInt($("#masaasuransi").val());
			
			var jeniskelamincalontertanggung =	document.getElementById("jeniskelamincalontertanggung").value;
			
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if ((usiasekarang <= 20) && (usiasekarang >= 17))
			{
				usiasekarang = 20;
			}
			
			var birthday = +new Date(document.getElementById("lahirnasabah").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usianasabah = Math.floor(sls);
			
			if ((usianasabah <= 20) && (usianasabah >= 17))
			{
				usianasabah = 20;
			}
			
			//alert(usiasekarang2);
			
			if (jsspdjsdwiguna == '1')
			{
				
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungpremitahunandwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#uangasuransijsspdjsdwiguna").val(data);

						}
					});	

				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjsspdjsdwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&usianasabah="+usianasabah,
						success : function(data) {
							$("#premijsspdjsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});	
			}
			else if (jsspdjsdwiguna == '0')
			{
				//document.getElementById("uangasuransijsspdjsdwiguna").disabled = true;
				document.getElementById("premijsspdjsdwiguna").value = 0;
				document.getElementById("uangasuransijsspdjsdwiguna").value = 0;	
				
				document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)); 	
				document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
			}
			
		});
		
		
		$("#jssptpdjsdwiguna").change(function() {
			var jssptpdjsdwiguna = document.getElementById("jssptpdjsdwiguna").value;
			
			var masaasuransi = parseInt($("#masaasuransi").val());	
			
			var jeniskelamincalontertanggung =	document.getElementById("jeniskelamincalontertanggung").value;
			
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			if (jssptpdjsdwiguna == '1')
			{
				//document.getElementById("uangasuransijsspdjsdwiguna").disabled = false;
				
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungpremitahunandwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#uangasuransijssptpdjsdwiguna").val(data);
							
							//document.getElementById("premijssptpdjsdwiguna").value = document.getElementById("uangasuransijssptpdjsdwiguna").value * 2;
						}
					});	
					
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjssptpdjsdwiguna');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi,
						success : function(data) {
							$("#premijssptpdjsdwiguna").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
						}
					});	
			}
			else if (jssptpdjsdwiguna == '0')
			{
				//document.getElementById("uangasuransijssptpdjsdwiguna").disabled = true;
				document.getElementById("premijssptpdjsdwiguna").value = 0;
				document.getElementById("uangasuransijssptpdjsdwiguna").value = 0;		
				
				document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)); 
				document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
			}
			
		});
		
		
		
		$("#hcpjsdwiguna").change(function() {
			var hcpjsdwiguna = document.getElementById("hcpjsdwiguna").value;
			
			if (hcpjsdwiguna == '1')
			{
				$('#uangasuransihcpjsdwiguna').prop('disabled', false);
				$('#hcpbjsdwiguna').prop('disabled', false);
			}
			else if (hcpjsdwiguna == '0')
			{
				$('#uangasuransihcpjsdwiguna').prop('disabled', true);
				$('#hcpbjsdwiguna').prop('disabled', true);
				
				document.getElementById("uangasuransihcpjsdwiguna").value = 0;
				$('#uangasuransihcpjsdwiguna').trigger('change');
				
				document.getElementById("hcpbjsdwiguna").value = 0;
				$('#hcpbjsdwiguna').trigger('change');
				
			}
			
		});
		
		$("#uangasuransihcpjsdwiguna").change(function() {
			var uangasuransihcpjsdwiguna = document.getElementById("uangasuransihcpjsdwiguna").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
				
			var hcpbjsdwiguna = document.getElementById("hcpbjsdwiguna").value;
			
			if (hcpbjsdwiguna == '1')
			{
				document.getElementById("uangasuransihcpbjsdwiguna").value = document.getElementById("uangasuransihcpjsdwiguna").value; 
				$('#uangasuransihcpbjsdwiguna').trigger('change');
				document.getElementById("premihcpjsdwiguna").value = uangasuransihcpjsdwiguna * 100000;
				
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjshcpdwiguna');?>",
						data	: "uangasuransihcpjsdwiguna="+uangasuransihcpjsdwiguna+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwiguna="+'Tahunan',
						success : function(data) {
							$("#premihcpjsdwiguna2").val(data);
								
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));	
						}
					});	
			}
			else if (hcpbjsdwiguna == '0')
			{
				document.getElementById("uangasuransihcpbjsdwiguna").value = 0;
				$('#uangasuransihcpbjsdwiguna').trigger('change');
				document.getElementById("premihcpjsdwiguna").value = uangasuransihcpjsdwiguna * 100000;
				
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwiguna/hitungjshcpdwiguna');?>",
						data	: "uangasuransihcpjsdwiguna="+uangasuransihcpjsdwiguna+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwiguna="+'Tahunan',
						success : function(data) {
							$("#premihcpjsdwiguna2").val(data);
							
							document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
							document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));	
						}
					});	
			}
			
			
			
		});
		
		$("#hcpbjsdwiguna").change(function() {
			var hcpbjsdwiguna = document.getElementById("hcpbjsdwiguna").value;
			
			if (hcpbjsdwiguna == '1')
			{
				document.getElementById("uangasuransihcpbjsdwiguna").value = document.getElementById("uangasuransihcpjsdwiguna").value; 
				$('#uangasuransihcpbjsdwiguna').trigger('change');
			}
			else if (hcpbjsdwiguna == '0')
			{
				document.getElementById("uangasuransihcpbjsdwiguna").value = 0;
				$('#uangasuransihcpbjsdwiguna').trigger('change');
			}
			
		});
		
		$("#uangasuransihcpbjsdwiguna").change(function() {
			var uangasuransihcpbjsdwiguna = document.getElementById("uangasuransihcpbjsdwiguna").value;
			
			document.getElementById("premihcpbjsdwiguna").value = uangasuransihcpbjsdwiguna * 1000000;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsdwiguna/hitungjshcpbdwiguna');?>",
				data	: "uangasuransihcpbjsdwiguna="+uangasuransihcpbjsdwiguna+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwiguna="+'Tahunan',
				success : function(data) {
					$("#premihcpbjsdwiguna2").val(data);
					
					document.getElementById("totalpremiriderjsdwigunasum").value = Math.round(parseInt(document.getElementById("premijsaddbjsdwiguna").value) + parseInt(document.getElementById("premijstpdjsdwiguna").value) + parseInt(document.getElementById("premijswaivertpdjsdwiguna").value) + parseInt(document.getElementById("premijsci53jsdwiguna").value) + parseInt(document.getElementById("premijstermjsdwiguna").value) + parseInt(document.getElementById("premijsspdjsdwiguna").value) + parseInt(document.getElementById("premijssptpdjsdwiguna").value)+ parseInt(document.getElementById("premihcpjsdwiguna2").value)+ parseInt(document.getElementById("premihcpbjsdwiguna2").value)); 
					document.getElementById("totalpokokpremirider").value = Math.round(parseInt(document.getElementById("tabelpremitahunan").value) + parseInt(document.getElementById("totalpremiriderjsdwigunasum").value));
				}
			});	

		});
		
		/*
		$("#carabayarpremijsdwiguna").change(function() {
			var carabayarpremijsdwiguna = document.getElementById("carabayarpremijsdwiguna").value;
			
			if (carabayarpremijsdwiguna == 'Tahunan')
			{
				document.getElementById("keteranganrider").style.display = "";
				document.getElementById("riderjsdwiguna").style.display = "";			
			}
			else if (carabayarpremijsdwiguna == 'Sekaligus')
			{
				document.getElementById("keteranganrider").style.display = "none";
				document.getElementById("riderjsdwiguna").style.display = "none";	
				
				document.getElementById("jsaddbjsdwiguna").value = "0";
				$('#jsaddbjsdwiguna').trigger('change');	
				document.getElementById("jstpdjsdwiguna").value = "0";
				$('#jstpdjsdwiguna').trigger('change');	
				document.getElementById("jswaivertpdjsdwiguna").value = "0";
				$('#jswaivertpdjsdwiguna').trigger('change');
				document.getElementById("jsci53jsdwiguna").value = "0";
				$('#jsci53jsdwiguna').trigger('change');
				document.getElementById("jstermjsdwiguna").value = "0";
				$('#jstermjsdwiguna').trigger('change');
				document.getElementById("jsspdjsdwiguna").value = "0";
				$('#jsspdjsdwiguna').trigger('change');	
				document.getElementById("jssptpdjsdwiguna").value = "0";
				$('#jssptpdjsdwiguna').trigger('change');
				
				document.getElementById("hcpjsdwiguna").value = "0";
				$('#hcpjsdwiguna').trigger('change');
				document.getElementById("hcpbjsdwiguna").value = "0";
				$('#hcpbjsdwiguna').trigger('change');
				
			}

		});
	   */
	   
});
</script>