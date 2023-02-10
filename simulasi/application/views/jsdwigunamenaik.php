<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-6">
                                                    											
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
        <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span> </label>
            <div class="col-md-6">
                <select class="form-control select2me" name="calonpemegangpolisperokokjsdwigunamenaik" id="calonpemegangpolisperokokjsdwigunamenaik" onChange="">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
                <option value="">Pilih...</option>	
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
									  <label class="control-label col-md-4">J.U.A <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Uang Asuransi Pokok" type="number" name="uangasuransipokok" id="uangasuransipokok" onChange="" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
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
        <div class="form-group">
        	<label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
            <div class="col-md-6">
                <select class="form-control select2me" name="carabayarjsdwigunamenaik" id="carabayarjsdwigunamenaik" onChange="">
                <option value="">[Pilih Cara Bayar]</option>
                <option value="Bulanan">Bulanan</option>     
                <option value="Kuartalan">Kuartalan</option>
                <option value="Semesteran">Semesteran</option>
                <option value="Tahunan">Tahunan</option>
                <option value="Sekaligus">Sekaligus</option>     
                </select>
            </div>
        </div>
													</div>
													<!--/span-->
													
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
										<td>JS Cash Plan</td>
                                        <td>
                                        <select class="form-control select2me" name="hcpjsdwigunamenaik" id="hcpjsdwigunamenaik" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjsdwigunamenaik" id="premihcpjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpjsdwigunamenaik" id="uangasuransihcpjsdwigunamenaik" onChange="" disabled>
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
                                        <select class="form-control select2me" name="hcpbjsdwigunamenaik" id="hcpbjsdwigunamenaik" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpbjsdwigunamenaik" id="premihcpbjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpbjsdwigunamenaik" id="uangasuransihcpbjsdwigunamenaik" onChange="" disabled>
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
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjsdwigunamenaik1" id="totalpremiriderjsdwigunamenaik1" onChange="" readonly value="0">
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
                                        <th>
											 Bedah / hari
										</th>
									</tr>
								</thead>
									
								<tbody>
                                	<tr>
										<td>Santunan Rawat Inap</td>
										<td>1</td>
                                        <td>100000</td>
										<td>200000</td>
                                        <td>1000000</td>
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>2</td>
                                        <td>200000</td>
										<td>400000</td>
                                        <td>2000000</td>
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>3</td>
                                        <td>300000</td>
										<td>600000</td>
                                        <td>3000000</td>
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>4</td>
                                        <td>400000</td>
										<td>800000</td>
                                        <td>4000000</td>
									</tr>
                                    <tr>
										<td style="font-weight:bold"></td>
										<td>5</td>
                                        <td>500000</td>
										<td>1000000</td>
                                        <td>5000000</td>
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
										<td>JS TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jstpdjsdwigunamenaik" id="jstpdjsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstpdjsdwigunamenaik" id="premijstpdjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstpdjsdwigunamenaik" id="uangasuransijstpdjsdwigunamenaik" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>2.</td>
										<td>JS WP</td>
                                        <td>
                                        <select class="form-control select2me" name="wpjsdwigunamenaik" id="wpjsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premiwpjsdwigunamenaik" id="premiwpjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
										
									</tr>
									<tr>
										<td>3.</td>
										<td>JS CI53</td>
                                        <td>
                                        <select class="form-control select2me" name="ci53jsdwigunamenaik" id="ci53jsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premici53jsdwigunamenaik" id="premici53jsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransici53jsdwigunamenaik" id="uangasuransici53jsdwigunamenaik" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>4.</td>
										<td>JS ADDB</td>
                                        <td>
                                        <select class="form-control select2me" name="jsaddbjsdwigunamenaik" id="jsaddbjsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsaddbjsdwigunamenaik" id="premijsaddbjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsaddbjsdwigunamenaik" id="uangasuransijsaddbjsdwigunamenaik" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
                                    <tr>
										<td>5.</td>
										<td>JS SP-D</td>
                                        <td>
                                        <select class="form-control select2me" name="jsspdjsdwigunamenaik" id="jsspdjsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsspdjsdwigunamenaik" id="premijsspdjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
										
									</tr>
                                    <tr>
										<td>6.</td>
										<td>JS SP-TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jssptpdjsdwigunamenaik" id="jssptpdjsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijssptpdjsdwigunamenaik" id="premijssptpdjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
									</tr>
									<tr>
										<td>7.</td>
										<td>JS Term</td>
                                        <td>
                                        <select class="form-control select2me" name="termjsdwigunamenaik" id="termjsdwigunamenaik" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premitermjsdwigunamenaik" id="premitermjsdwigunamenaik" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransitermjsdwigunamenaik" id="uangasuransitermjsdwigunamenaik" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL PREMI RIDER</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjsdwigunamenaiksum" id="totalpremiriderjsdwigunamenaiksum" onChange="" readonly value="0">
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
										<td>Premi Sekaligus</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremisekaligus" id="tabelpremisekaligus" onchange="" readonly></td>
                                        
									</tr>
									<tr>
										<td>Premi Tahunan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremi5tahunpertama" id="tabelpremi5tahunpertama" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelridertahunan" id="tabelridertahunan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremitahunan" id="tabelriderpremitahunan" onchange="" readonly value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Semesteran</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremi5tahunberikutnya" id="tabelpremi5tahunberikutnya" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelridersemesteran" id="tabelridersemesteran" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremisemesteran" id="tabelriderpremisemesteran" onchange="" readonly value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Kuartalan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremikuartalan" id="tabelpremikuartalan" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelriderkuartalan" id="tabelriderkuartalan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremikuartalan" id="tabelriderpremikuartalan" onchange="" readonly value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Bulanan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremibulanan" id="tabelpremibulanan" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelriderbulanan" id="tabelriderbulanan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremibulanan" id="tabelriderpremibulanan" onchange="" readonly value="0"></td>
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
			
			if (usiasekarang > 60)
			{
				
						alert('Usia Maksimal 60 Tahun!');
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
		
		$("#masaasuransi").change(function() {
			var masaasuransi = $("#masaasuransi").val();	
			if ((masaasuransi < 5) || (masaasuransi > 20))
			{
				alert('Masa asuransi antara 5 - 20 tahun!');	
				document.getElementById('masaasuransi').value = 5;
				alert.stop();
			}
		});
		
		$("#uangasuransipokok").change(function() {
			var masaasuransi = $("#masaasuransi").val();	
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungpremisekaligusdwigunamenaik');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremisekaligus").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungpremi5tahunpertamadwigunamenaik');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremi5tahunpertama").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungpremi5tahunberikutnyadwigunamenaik');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremi5tahunberikutnya").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungpremikuartalan');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremikuartalan").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungpremibulanan');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremibulanan").val(data);
						}
					});
		});
		
		$("#carabayarjsdwigunamenaik").change(function() {
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			var span = document.getElementById("ketcarabayar");
			var span2 = document.getElementById("ketcarabayar2");
		
			if (carabayarjsdwigunamenaik == "Bulanan")
			{	
				span.textContent = "Bulanan";
				span2.textContent = "Bulanan";	
			}
			else if (carabayarjsdwigunamenaik == "Kuartalan")
			{	
				
				span.textContent = "Kuartalan";	
				span2.textContent = "Kuartalan";	
			}
			else if (carabayarjsdwigunamenaik == "Semesteran")
			{	
				
				span.textContent = "Semesteran";	
				span2.textContent = "Semesteran";	
			}
			else if (carabayarjsdwigunamenaik == "Tahunan")
			{	
				
				span.textContent = "Tahunan";
				span2.textContent = "Tahunan";	
			}
			else if (carabayarjsdwigunamenaik == "Sekaligus")
			{	
				
				span.textContent = "Sekaligus";	
				span2.textContent = "Sekaligus";
			}
		});
		
		$("#hcpjsdwigunamenaik").change(function() {
			var hcpjsdwigunamenaik = document.getElementById("hcpjsdwigunamenaik").value;
			
			if (hcpjsdwigunamenaik == '1')
			{
				$('#uangasuransihcpjsdwigunamenaik').prop('disabled', false);
				$('#hcpbjsdwigunamenaik').prop('disabled', false);
			}
			else if (hcpjsdwigunamenaik == '0')
			{
				$('#uangasuransihcpjsdwigunamenaik').prop('disabled', true);
				$('#hcpbjsdwigunamenaik').prop('disabled', true);
				
				document.getElementById("uangasuransihcpjsdwigunamenaik").value = 0;
				$('#uangasuransihcpjsdwigunamenaik').trigger('change');
				
				document.getElementById("hcpbjsdwigunamenaik").value = 0;
				$('#hcpbjsdwigunamenaik').trigger('change');
				
			}
			
		});
		
		$("#hcpbjsdwigunamenaik").change(function() {
			var hcpbjsdwigunamenaik = document.getElementById("hcpbjsdwigunamenaik").value;
			
			if (hcpbjsdwigunamenaik == '1')
			{
				document.getElementById("uangasuransihcpbjsdwigunamenaik").value = document.getElementById("uangasuransihcpjsdwigunamenaik").value; 
				$('#uangasuransihcpbjsdwigunamenaik').trigger('change');
			}
			else if (hcpbjsdwigunamenaik == '0')
			{
				document.getElementById("uangasuransihcpbjsdwigunamenaik").value = 0;
				$('#uangasuransihcpbjsdwigunamenaik').trigger('change');
			}
			
		});
		
		
		
		$("#uangasuransihcpjsdwigunamenaik").change(function() {
			var uangasuransihcpjsdwigunamenaik = document.getElementById("uangasuransihcpjsdwigunamenaik").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungjshcpdwigunamenaik');?>",
						data	: "uangasuransihcpjsdwigunamenaik="+uangasuransihcpjsdwigunamenaik+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
						success : function(data) {
							$("#premihcpjsdwigunamenaik").val(data);
							
							document.getElementById("totalpremiriderjsdwigunamenaik1").value = Math.round(parseInt(document.getElementById("premihcpjsdwigunamenaik").value) + parseInt(document.getElementById("premihcpbjsdwigunamenaik").value)); 
							
							document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
							
							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});	
					
			var hcpbjsdwigunamenaik = document.getElementById("hcpbjsdwigunamenaik").value;
			
			if (hcpbjsdwigunamenaik == '1')
			{
				document.getElementById("uangasuransihcpbjsdwigunamenaik").value = document.getElementById("uangasuransihcpjsdwigunamenaik").value; 
				$('#uangasuransihcpbjsdwigunamenaik').trigger('change');
			}
			else if (hcpbjsdwigunamenaik == '0')
			{
				document.getElementById("uangasuransihcpbjsdwigunamenaik").value = 0;
				$('#uangasuransihcpbjsdwigunamenaik').trigger('change');
			}
			
			
			
		});
		
		$("#uangasuransihcpbjsdwigunamenaik").change(function() {
			var uangasuransihcpbjsdwigunamenaik = document.getElementById("uangasuransihcpbjsdwigunamenaik").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungjshcpbdwigunamenaik');?>",
						data	: "uangasuransihcpbjsdwigunamenaik="+uangasuransihcpbjsdwigunamenaik+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
						success : function(data) {
							$("#premihcpbjsdwigunamenaik").val(data);
							
							document.getElementById("totalpremiriderjsdwigunamenaik1").value = Math.round(parseInt(document.getElementById("premihcpjsdwigunamenaik").value) + parseInt(document.getElementById("premihcpbjsdwigunamenaik").value)); 
							
							document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
							
							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});	
			
		});
		
		$("#jstpdjsdwigunamenaik").change(function() {
			var jstpdjsdwigunamenaik = document.getElementById("jstpdjsdwigunamenaik").value;
			
			if (jstpdjsdwigunamenaik == '1')
			{
				document.getElementById("uangasuransijstpdjsdwigunamenaik").disabled = false;	
			}
			else if (jstpdjsdwigunamenaik == '0')
			{
				document.getElementById("uangasuransijstpdjsdwigunamenaik").disabled = true;
				document.getElementById("premijstpdjsdwigunamenaik").value = 0;	
				document.getElementById("uangasuransijstpdjsdwigunamenaik").value = 0;		
			}
			
		});
		
		$("#wpjsdwigunamenaik").change(function() {
			var wpjsdwigunamenaik = document.getElementById("wpjsdwigunamenaik").value;
			
			if (wpjsdwigunamenaik == '1')
			{
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
				var masaasuransi = document.getElementById("masaasuransi").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
				
				var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdwigunamenaik/hitungjswpdwigunamenaik');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
							success : function(data) {
								$("#premiwpjsdwigunamenaik").val(data);
								
								document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
								
								document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
								
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								
							}
						});				
			}
			else if (wpjsdwigunamenaik == '0')
			{
					
				document.getElementById("premiwpjsdwigunamenaik").value = 0;	
				document.getElementById("uangasuransiwpjsdwigunamenaik").value = 0;	
			}
			
		});
		
		$("#ci53jsdwigunamenaik").change(function() {
			var ci53jsdwigunamenaik = document.getElementById("ci53jsdwigunamenaik").value;
			
			if (ci53jsdwigunamenaik == '1')
			{
				document.getElementById("uangasuransici53jsdwigunamenaik").disabled = false;
			}
			else if (ci53jsdwigunamenaik == '0')
			{
				document.getElementById("uangasuransici53jsdwigunamenaik").disabled = true;
				document.getElementById("premici53jsdwigunamenaik").value = 0;
				document.getElementById("uangasuransici53jsdwigunamenaik").value = 0;	
			}
			
		});
		
		$("#jsaddbjsdwigunamenaik").change(function() {
			var jsaddbjsdwigunamenaik = document.getElementById("jsaddbjsdwigunamenaik").value;
			
			if (jsaddbjsdwigunamenaik == '1')
			{
				document.getElementById("uangasuransijsaddbjsdwigunamenaik").disabled = false;
			}
			else if (jsaddbjsdwigunamenaik == '0')
			{
				document.getElementById("uangasuransijsaddbjsdwigunamenaik").disabled = true;	
				document.getElementById("premijsaddbjsdwigunamenaik").value = 0;
				document.getElementById("uangasuransijsaddbjsdwigunamenaik").value = 0;	
			}
			
		});
		
		$("#jsspdjsdwigunamenaik").change(function() {
			var jsspdjsdwigunamenaik = document.getElementById("jsspdjsdwigunamenaik").value;
			
			if (jsspdjsdwigunamenaik == '1')
			{
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
				var masaasuransi = document.getElementById("masaasuransi").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
				
				var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdwigunamenaik/hitungjsspddwigunamenaik');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
							success : function(data) {
								$("#premijsspdjsdwigunamenaik").val(data);
								
								document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
								
								document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
								
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							}
						});	
			}
			else if (jsspdjsdwigunamenaik == '0')
			{
				
				document.getElementById("premijsspdjsdwigunamenaik").value = 0;	
				document.getElementById("uangasuransijsspdjsdwigunamenaik").value = 0;	
			}
			
		});
		
		$("#jssptpdjsdwigunamenaik").change(function() {
			var jssptpdjsdwigunamenaik = document.getElementById("jssptpdjsdwigunamenaik").value;
			
			if (jssptpdjsdwigunamenaik == '1')
			{
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
				var masaasuransi = document.getElementById("masaasuransi").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
				
				var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdwigunamenaik/hitungjssptpddwigunamenaik');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
							success : function(data) {
								$("#premijssptpdjsdwigunamenaik").val(data);
								
								document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
								
								document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
								
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							}
						});		
			}
			else if (jssptpdjsdwigunamenaik == '0')
			{
				
				document.getElementById("premijssptpdjsdwigunamenaik").value = 0;	
				document.getElementById("uangasuransijssptpdjsdwigunamenaik").value = 0;	
			}
			
		});
		
		$("#termjsdwigunamenaik").change(function() {
			var termjsdwigunamenaik = document.getElementById("termjsdwigunamenaik").value;
			
			if (termjsdwigunamenaik == '1')
			{
				document.getElementById("uangasuransitermjsdwigunamenaik").disabled = false;	
			}
			else if (termjsdwigunamenaik == '0')
			{
				document.getElementById("uangasuransitermjsdwigunamenaik").disabled = true;
				document.getElementById("premitermjsdwigunamenaik").value = 0;
				document.getElementById("uangasuransitermjsdwigunamenaik").value = 0;		
			}
			
		});
		
		$("#uangasuransijstpdjsdwigunamenaik").change(function() {
			var uangasuransijstpdjsdwigunamenaik = document.getElementById("uangasuransijstpdjsdwigunamenaik").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungjstpddwigunamenaik');?>",
						data	: "uangasuransijstpdjsdwigunamenaik="+uangasuransijstpdjsdwigunamenaik+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
						success : function(data) {
							$("#premijstpdjsdwigunamenaik").val(data);
							
							document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
								
								document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
								
								document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});
			
		});
		
		$("#uangasuransici53jsdwigunamenaik").change(function() {
			var uangasuransici53jsdwigunamenaik = document.getElementById("uangasuransici53jsdwigunamenaik").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungjsci53dwigunamenaik');?>",
						data	: "uangasuransici53jsdwigunamenaik="+uangasuransici53jsdwigunamenaik+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
						success : function(data) {
							$("#premici53jsdwigunamenaik").val(data);
							
							document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
							
							document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
							
							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});

		});	
		
		$("#uangasuransijsaddbjsdwigunamenaik").change(function() {
			var uangasuransijsaddbjsdwigunamenaik = document.getElementById("uangasuransijsaddbjsdwigunamenaik").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungjsaddbdwigunamenaik');?>",
						data	: "uangasuransijsaddbjsdwigunamenaik="+uangasuransijsaddbjsdwigunamenaik+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik,
						success : function(data) {
							$("#premijsaddbjsdwigunamenaik").val(data);
							
							document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
							
							document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 

							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});
			
		});	
		
		
		$("#uangasuransitermjsdwigunamenaik").change(function() {
			var uangasuransitermjsdwigunamenaik = document.getElementById("uangasuransitermjsdwigunamenaik").value;
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			var calonpemegangpolisperokokjsdwigunamenaik = document.getElementById("calonpemegangpolisperokokjsdwigunamenaik").value;
			
			var carabayarjsdwigunamenaik = $("#carabayarjsdwigunamenaik").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdwigunamenaik/hitungjstermdwigunamenaik');?>",
						data	: "uangasuransitermjsdwigunamenaik="+uangasuransitermjsdwigunamenaik+"&usiasekarang="+usiasekarang+"&calonpemegangpolisperokokjsdwigunamenaik="+calonpemegangpolisperokokjsdwigunamenaik+"&carabayarjsdwigunamenaik="+carabayarjsdwigunamenaik+"&uangasuransipokok="+uangasuransipokok,
						success : function(data) {
							$("#premitermjsdwigunamenaik").val(data);
							
							document.getElementById("totalpremiriderjsdwigunamenaik2").value = Math.round(parseInt(document.getElementById("premijstpdjsdwigunamenaik").value) + parseInt(document.getElementById("premiwpjsdwigunamenaik").value) + parseInt(document.getElementById("premici53jsdwigunamenaik").value) + parseInt(document.getElementById("premijsaddbjsdwigunamenaik").value) + parseInt(document.getElementById("premijsspdjsdwigunamenaik").value) + parseInt(document.getElementById("premijssptpdjsdwigunamenaik").value) + parseInt(document.getElementById("premitermjsdwigunamenaik").value)); 
							
							document.getElementById("totalpremiriderjsdwigunamenaiksum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaik1").value) + parseInt(document.getElementById("totalpremiriderjsdwigunamenaik2").value)); 
							
							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value));
							
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.52));
							
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.27));
							
							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjsdwigunamenaiksum").value*0.095);
							
							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});

			
		});
		
	   });
</script>