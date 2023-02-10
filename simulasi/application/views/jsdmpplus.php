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
       
        <!--div class="form-group">
        	<label class="control-label col-md-4">Hubungan dgn PemPol <span class="required"> * </span></label>
            <div class="col-md-3">
                <select class="form-control select2me" name="hubungandenganpempol" id="hubungandenganpempol" onChange="onHandleHubunganDenganPempol(this)">
                    <option value="">[Pilih Hubungan Dengan Pemegang Polis]</option>
                    <option value="Suami/Istri">Suami/Istri</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        </div-->                                        
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
	<label class="control-label col-md-3">Masa Asuransi<span class="required">
		 
	</span></label>
	
	<div class="col-md-3">
			<input class="form-control" placeholder="Masa Asuransi / Masa Kontrak" type="number" name="masaasuransi" id="masaasuransi">
		

	</div>
    <span class="help-block">
			 Tahun
	</span>
</div>
                                    <div class="form-group">
									  <label class="control-label col-md-4">Jumlah Uang Asuransi<span class="required"> * </span> </label>
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
													  <input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransi" name="saatmulaiasuransi" size="16" type="text" value="" placeholder="Saat Mulai" onChange=""/>
														<span class="help-block">
															 Masukkan Saat Mulai Asuransi
														</span>
													</div>
		</div>
        <div class="form-group">
        	<label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
            <div class="col-md-6">
                <select class="form-control select2me" name="carabayarjsdmpplus" id="carabayarjsdmpplus" onChange="">
                <option value="">[Pilih Cara Bayar]</option>
                <option value="Bulanan">Bulanan</option>   
                <option value="Tahunan">Tahunan</option>  
                </select>
            </div>
        </div>
											
	    <div class="form-group">
                                      <label class="control-label col-md-4">Premi 5 Tahun Pertama<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input class="form-control" id="tabelpremi5tahunpertama" name="tabelpremi5tahunpertama" size="16" type="text" value="" placeholder="Premi" onChange=""/>
														
													</div>
		</div>
											
												
		<div class="form-group">
                                      <label class="control-label col-md-4">Premi 6 Tahun dan Seterusnya<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input class="form-control" id="tabelpremisekaligus" name="tabelpremisekaligus" size="16" type="text" value="" placeholder="Premi" onChange=""/>
														
													</div>
		</div>
													</div>
													<!--/span-->
													
</div>

<!--

<br>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-12">

<div class="table-scrollable">
							
                            <br>
                            <table class="table table-striped table-hover">
								
									
								<thead>
                                	<tr>
										<td style="font-weight:bold;background-color:#9cc3e6" align="center">Investasi</td>
										
                                        <td style="background-color:#bcd6ee">Tingkat Bunga</td>
										<td style="background-color:#bcd6ee">:</td>
                                        <td style="background-color:#bcd6ee">4%</td>
                                        <td style="background-color:#bcd6ee">PER TAHUN</td>
									</tr>
                                    <tr>
										<td style="font-weight:bold;background-color:#9cc3e6" align="center">Lain</td>
										
                                        <td style="background-color:#bcd6ee">Pajak</td>
										<td style="background-color:#bcd6ee">:</td>
                                        <td style="background-color:#bcd6ee">20%</td>
                                        <td style="background-color:#bcd6ee"></td>
									</tr>
                                    <tr>
										<td style="font-weight:bold;background-color:#9cc3e6"></td>
										
                                        <td style="background-color:#bcd6ee">Bunga Netto</td>
										<td style="background-color:#bcd6ee">:</td>
                                        <td style="background-color:#bcd6ee">3%</td>
                                        <td style="background-color:#bcd6ee">PER TAHUN</td>
									</tr>
                                   
								</thead>
							</table>
						</div>
</div>




</div>


<br>
<h3 class="block" align="center">PILIHAN JAMINAN TAMBAHAN <span name="ketcarabayarjsdmpplus3" id="ketcarabayarjsdmpplus3"></span> (RIDER) </h3>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-6">

<p align="justify">PETUNJUK: Ketik: 1, jika "YA" ketik: 0, jika "TIDAK" Dan harap memilih plan yang diinginkan</p>

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
                                        <th name="ketcarabayarjsdmpplus" id="ketcarabayarjsdmpplus">
											
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
                                        <select class="form-control select2me" name="hcpjsdmpplus" id="hcpjsdmpplus" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjsdmpplus" id="premihcpjsdmpplus" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpjsdmpplus" id="uangasuransihcpjsdmpplus" onChange="" disabled>
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
                                        <select class="form-control select2me" name="hcpbjsdmpplus" id="hcpbjsdmpplus" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpbjsdmpplus" id="premihcpbjsdmpplus" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpbjsdmpplus" id="uangasuransihcpbjsdmpplus" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        </td>
                                        <td style="color:#FF0000">
                                        *
                                        </td>
									</tr>
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjsdmpplus1" id="totalpremiriderjsdmpplus1" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>
								</tbody>
							</table>
                            
                            <p align="justify"><b>Syarat dan Ketentuan:</b></p>
                            <p align="justify"><span style="color:#FF0000">/</span> Jika ingin mengambil cash plan bedah maka harus mengambil cash plan murni dengan kelas yang sama.</p>
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

<p align="justify">PETUNJUK: Ketik : 1, jika "YA" ketik : 0, jika "TIDAK" Dan harap mengisi Uang Asuransi</p>

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
                                        <th name="ketcarabayarjsdmpplus2" id="ketcarabayarjsdmpplus2">
											
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
                                        <select class="form-control select2me" name="jstpdjsdmpplus" id="jstpdjsdmpplus" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstpdjsdmpplus" id="premijstpdjsdmpplus" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstpdjsdmpplus" id="uangasuransijstpdjsdmpplus" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>2.</td>
										<td>JS WP</td>
                                        <td>
                                        <select class="form-control select2me" name="wpjsdmpplus" id="wpjsdmpplus" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premiwpjsdmpplus" id="premiwpjsdmpplus" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        
                                        </td>
										<td style="color:#FF0000">
                                        *
                                        </td>
									</tr>
									<tr>
										<td>3.</td>
										<td>JS CI53</td>
                                        <td>
                                        <select class="form-control select2me" name="ci53jsdmpplus" id="ci53jsdmpplus" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premici53jsdmpplus" id="premici53jsdmpplus" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransici53jsdmpplus" id="uangasuransici53jsdmpplus" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>4.</td>
										<td>JS ADDB</td>
                                        <td>
                                        <select class="form-control select2me" name="jsaddbjsdmpplus" id="jsaddbjsdmpplus" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsaddbjsdmpplus" id="premijsaddbjsdmpplus" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsaddbjsdmpplus" id="uangasuransijsaddbjsdmpplus" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
                                    <tr>
										<td>5.</td>
										<td>JS SP-D</td>
                                        <td>
                                        <select class="form-control select2me" name="jsspdjsdmpplus" id="jsspdjsdmpplus" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsspdjsdmpplus" id="premijsspdjsdmpplus" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        
                                        </td>
										<td style="color:#FF0000">
                                        *
                                        </td>
									</tr>
                                    <tr>
										<td>6.</td>
										<td>JS SP-TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jssptpdjsdmpplus" id="jssptpdjsdmpplus" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijssptpdjsdmpplus" id="premijssptpdjsdmpplus" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        
                                        </td>
										<td style="color:#FF0000">
                                        *
                                        </td>
									</tr>

                                    <tr>
										<td></td>
										<td style="font-weight:bold">TOTAL</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjsdmpplus2" id="totalpremiriderjsdmpplus2" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>

									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL PREMI RIDER</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjsdmpplussum" id="totalpremiriderjsdmpplussum" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
									</tr>
								</tbody>
							</table>
                            <p align="right" style="color:#FF0000">/ berdasarkan premi pokok tahunan</p>
						</div>
</div>


</div>


<br>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-12">
<h5 class="block" style="color:#FF0000">Untuk Pengecekan:</h5>
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
										<td><input class="form-control" placeholder="" type="number" name="tabelpremisekaligus" id="tabelpremisekaligus" onchange="" value="0" readonly></td>
                                        
									</tr>

									<tr>
										<td>Premi 5 thn Pertama</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremi5tahunpertama" id="tabelpremi5tahunpertama" onchange="" value="0" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelrider5tahunpertama" id="tabelrider5tahunpertama" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremi5tahunpertama" id="tabelriderpremi5tahunpertama" onchange="" readonly value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Semesteran</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremisemesteran" id="tabelpremisemesteran" onchange="" value="0" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelridersemesteran" id="tabelridersemesteran" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremisemesteran" id="tabelriderpremisemesteran" onchange="" readonly value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Kuartalan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremikuartalan" id="tabelpremikuartalan" onchange="" value="0" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelriderkuartalan" id="tabelriderkuartalan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremikuartalan" id="tabelriderpremikuartalan" onchange="" readonly value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Bulanan</td>
										<td><input class="form-control" placeholder="" type="number" name="tabelpremibulanan" id="tabelpremibulanan" onchange="" value="0" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="tabelriderbulanan" id="tabelriderbulanan" onchange="" readonly value="0"></td>
										<td><input class="form-control" placeholder="" type="number" name="tabelriderpremibulanan" id="tabelriderpremibulanan" onchange="" readonly value="0"></td>
									</tr>
								</tbody>
							</table>
                        	
                            
						</div>
</div>

-->

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
					document.getElementById('carabayarjsdmpplus').value = "";
					$('#carabayarjsdmpplus').trigger('change');
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
			if ((masaasuransi < 5) || (masaasuransi > 10))
			{
				alert('Masa asuransi antara 5 - 10 tahun!');	
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
			
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsdmpplus/hitungpremi');?>",
				data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&carabayarjsdmpplus="+carabayarjsdmpplus,
				success : function(data) {
					
					if (carabayarjsdmpplus == 'Bulanan')
					{
						if (data < 300000)
						{
							alert('Premi Bulanan minimal 300000!');
							document.getElementById("tabelpremisekaligus").value = 'TIDAK BISA';
							$('#tabelpremisekaligus').trigger('change');
						}
						else
						{
							$("#tabelpremisekaligus").val(data);	
						}
					}
					else if (carabayarjsdmpplus == 'Tahunan')
					{
						if (data < 3600000)
						{
							alert('Premi Tahunan minimal 3600000!');
							document.getElementById("tabelpremisekaligus").value = 'TIDAK BISA';
							$('#tabelpremisekaligus').trigger('change');
						}	
						else
						{
							$("#tabelpremisekaligus").val(data);	
						}
					}
							
					
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsdmpplus/hitungpremi5tahunpertama');?>",
				data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&carabayarjsdmpplus="+carabayarjsdmpplus,
				success : function(data) {
					
					$("#tabelpremi5tahunpertama").val(data);
				}
			});
			
			/*
			var masaasuransi = $("#masaasuransi").val();	
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitungpremi5tahunpertamadmpplus');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremi5tahunpertama").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitungpremisemesterandmpplus');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremisemesteran").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitungpremikuartalandmpplus');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremikuartalan").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitungpremibulanandmpplus');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremibulanan").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitungpremisekaligusdmpplus');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremisekaligus").val(data);
						}
					});
					
					$("#tabelpremibayar5tahunsaja").val("Tidak Bisa");
					$("#tabelpremibayar10tahunsaja").val("Tidak Bisa");
					
					if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
					{
						document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
						document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
						document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
						document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
					
						document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
						document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
						document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
					}
					else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
					{
						document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
						document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
						document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
						document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
					
						document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
						document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
						document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
					}
					else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
					{
						document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
						document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
						document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
						document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
					
						document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
						document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
						document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
					}
					else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
					{
						document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
						document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
						document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
						document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
					
						document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
						document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
						document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
					}
					else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
					{
						document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
						document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
						document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
						document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
					
						document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
						document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
						document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
					}
			*/
			
		});
	
		$("#carabayarjsdmpplus").change(function() {
			var masaasuransi = $("#masaasuransi").val();	
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsdmpplus/hitungpremi');?>",
				data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&carabayarjsdmpplus="+carabayarjsdmpplus,
				success : function(data) {
					if (carabayarjsdmpplus == 'Bulanan')
					{
						if (data < 300000)
						{
							alert('Premi Bulanan minimal 300000!');
							document.getElementById("tabelpremisekaligus").value = 'TIDAK BISA';
							$('#tabelpremisekaligus').trigger('change');
						}
						else
						{
							$("#tabelpremisekaligus").val(data);	
						}
					}
					else if (carabayarjsdmpplus == 'Tahunan')
					{
						if (data < 3600000)
						{
							alert('Premi Tahunan minimal 3600000!');
							document.getElementById("tabelpremisekaligus").value = 'TIDAK BISA';
							$('#tabelpremisekaligus').trigger('change');
						}	
						else
						{
							$("#tabelpremisekaligus").val(data);	
						}
					}
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsdmpplus/hitungpremi5tahunpertama');?>",
				data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&carabayarjsdmpplus="+carabayarjsdmpplus,
				success : function(data) {
					$("#tabelpremi5tahunpertama").val(data);
				}
			});
			
		});
		
		/*
	
		$("#carabayarjsdmpplus").change(function() {
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value.toUpperCase();
			$('#ketcarabayarjsdmpplus').html(carabayarjsdmpplus); 
			$('#ketcarabayarjsdmpplus2').html(carabayarjsdmpplus);
			$('#ketcarabayarjsdmpplus3').html(carabayarjsdmpplus); 
			
			if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
			{
				document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
				document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
				document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
				document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
			
				document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
				document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
				document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
			}
			else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
			{
				document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
				document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
				document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
				document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
			
				document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
				document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
				document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
			}
			else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
			{
				document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
				document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
				document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
				document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
			
				document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
				document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
				document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
			}
			else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
			{
				document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
				document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
				document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
				document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
			
				document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
				document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
				document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
			}
			else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
			{
				document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
				document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
				document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
				document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
			
				document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
				document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
				document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
				document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
			}
		});
		
		*/
		
		
		//RIDER
		
		$("#hcpjsdmpplus").change(function() {
			var hcpjsdmpplus = document.getElementById("hcpjsdmpplus").value;
			
			if (hcpjsdmpplus == '1')
			{
				$('#uangasuransihcpjsdmpplus').prop('disabled', false);
				$('#hcpbjsdmpplus').prop('disabled', false);
			}
			else if (hcpjsdmpplus == '0')
			{
				$('#uangasuransihcpjsdmpplus').prop('disabled', true);
				$('#hcpbjsdmpplus').prop('disabled', true);
				
				document.getElementById("uangasuransihcpjsdmpplus").value = 0;
				$('#uangasuransihcpjsdmpplus').trigger('change');
				
				document.getElementById("hcpbjsdmpplus").value = 0;
				$('#hcpbjsdmpplus').trigger('change');
				
			}
			
		});
		
		$("#uangasuransihcpjsdmpplus").change(function() {
			var uangasuransihcpjsdmpplus = document.getElementById("uangasuransihcpjsdmpplus").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
				
			var hcpbjsdmpplus = document.getElementById("hcpbjsdmpplus").value;
			
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
			
			if (hcpbjsdmpplus == '1')
			{
				document.getElementById("uangasuransihcpbjsdmpplus").value = document.getElementById("uangasuransihcpjsdmpplus").value; 
				$('#uangasuransihcpbjsdmpplus').trigger('change');
				
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitunghcpjsdmpplus');?>",
						data	: "uangasuransihcpjsdmpplus="+uangasuransihcpjsdmpplus+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus,
						success : function(data) {
							$("#premihcpjsdmpplus").val(data);
								
							document.getElementById("totalpremiriderjsdmpplus1").value = Math.round(parseInt(document.getElementById("premihcpjsdmpplus").value) + parseInt(document.getElementById("premihcpbjsdmpplus").value));
							document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));

							if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
						}
					});	
			}
			else if (hcpbjsdmpplus == '0')
			{
				document.getElementById("uangasuransihcpbjsdmpplus").value = 0;
				$('#uangasuransihcpbjsdmpplus').trigger('change');
				
				$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitunghcpjsdmpplus');?>",
						data	: "uangasuransihcpjsdmpplus="+uangasuransihcpjsdmpplus+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus,
						success : function(data) {
							$("#premihcpjsdmpplus").val(data);
							
							document.getElementById("totalpremiriderjsdmpplus1").value = Math.round(parseInt(document.getElementById("premihcpjsdmpplus").value) + parseInt(document.getElementById("premihcpbjsdmpplus").value));
							document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
							
							if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
						}
					});	
			}
			
			
			
		});
		
		
		$("#hcpbjsdmpplus").change(function() {
			var hcpbjsdmpplus = document.getElementById("hcpbjsdmpplus").value;
			
			if (hcpbjsdmpplus == '1')
			{
				document.getElementById("uangasuransihcpbjsdmpplus").value = document.getElementById("uangasuransihcpjsdmpplus").value; 
				$('#uangasuransihcpbjsdmpplus').trigger('change');
			}
			else if (hcpbjsdmpplus == '0')
			{
				document.getElementById("uangasuransihcpbjsdmpplus").value = 0;
				$('#uangasuransihcpbjsdmpplus').trigger('change');
			}
			
		});
		
		$("#uangasuransihcpbjsdmpplus").change(function() {
			var uangasuransihcpbjsdmpplus = document.getElementById("uangasuransihcpbjsdmpplus").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitunghcpbjsdmpplus');?>",
						data	: "uangasuransihcpbjsdmpplus="+uangasuransihcpbjsdmpplus+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus,
						success : function(data) {
							$("#premihcpbjsdmpplus").val(data);
							
							document.getElementById("totalpremiriderjsdmpplus1").value = Math.round(parseInt(document.getElementById("premihcpjsdmpplus").value) + parseInt(document.getElementById("premihcpbjsdmpplus").value));
							document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
							
							if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
							else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
							{
								document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
								document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
								document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
								document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
							
								document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
								document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
								document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
								document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
							}
						}
					});	

		});
		
		$("#jstpdjsdmpplus").change(function() {
			var jstpdjsdmpplus = document.getElementById("jstpdjsdmpplus").value;
			
			if (jstpdjsdmpplus == '1')
			{
				document.getElementById("uangasuransijstpdjsdmpplus").disabled = false;	
				
			}
			else if (jstpdjsdmpplus == '0')
			{
				document.getElementById("uangasuransijstpdjsdmpplus").disabled = true;
				document.getElementById("premijstpdjsdmpplus").value = 0;	
				document.getElementById("uangasuransijstpdjsdmpplus").value = 0;	
				
				if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
				}
				else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
				}
				document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));	
				document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
				
				if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
			}
			
		});
		
		$("#uangasuransijstpdjsdmpplus").change(function() {
			var uangasuransijstpdjsdmpplus = document.getElementById("uangasuransijstpdjsdmpplus").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jsdmpplus/hitungtpdjsdmpplus');?>",
						data	: "uangasuransijstpdjsdmpplus="+uangasuransijstpdjsdmpplus+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus+"&uangasuransipokok="+uangasuransipokok,
						success : function(data) {
							
							if (data == 'tidak bisa')
							{
								$("#premijstpdjsdmpplus").val(0);
								document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(0) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
								document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
								if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
							}
							else
							{
								$("#premijstpdjsdmpplus").val(data);
								document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
								document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));	
								if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
							}
						}
					});
			
		});
		
		$("#ci53jsdmpplus").change(function() {
			var ci53jsdmpplus = document.getElementById("ci53jsdmpplus").value;
			
			if (ci53jsdmpplus == '1')
			{
				document.getElementById("uangasuransici53jsdmpplus").disabled = true;
				
				var uangasuransici53jsdmpplus = document.getElementById("uangasuransici53jsdmpplus").value;
				
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
				document.getElementById("uangasuransici53jsdmpplus").value = document.getElementById("uangasuransipokok").value;
			
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				
				var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
				
				var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdmpplus/hitungci53jsdmpplus');?>",
							data	: "uangasuransici53jsdmpplus="+document.getElementById("uangasuransici53jsdmpplus").value+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus,
							success : function(data) {
								$("#premici53jsdmpplus").val(data);
								
								if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
								}
								else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
								}
								document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
								document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
								if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
							}
						});
			}
			else if (ci53jsdmpplus == '0')
			{
				document.getElementById("uangasuransici53jsdmpplus").disabled = true;
				document.getElementById("premici53jsdmpplus").value = 0;
				document.getElementById("uangasuransici53jsdmpplus").value = 0;	
				
				if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
				}
				else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
				}
				document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
				document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
				if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
			}
			
		});
		
		$("#jsaddbjsdmpplus").change(function() {
			var jsaddbjsdmpplus = document.getElementById("jsaddbjsdmpplus").value;
			
			if (jsaddbjsdmpplus == '1')
			{
				document.getElementById("uangasuransijsaddbjsdmpplus").disabled = false;
			}
			else if (jsaddbjsdmpplus == '0')
			{
				document.getElementById("uangasuransijsaddbjsdmpplus").disabled = true;
				document.getElementById("premijsaddbjsdmpplus").value = 0;
				document.getElementById("uangasuransijsaddbjsdmpplus").value = 0;	
				
				if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
				}
				else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
				}
				document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
				document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
				if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
			}
			
		});
		
		$("#uangasuransijsaddbjsdmpplus").change(function() {
			var uangasuransijsaddbjsdmpplus = document.getElementById("uangasuransijsaddbjsdmpplus").value;
			
			var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjsdmpplus = document.getElementById("carabayarjsdmpplus").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsdmpplus/hitungaddbjsdmpplus');?>",
				data	: "uangasuransijsaddbjsdmpplus="+uangasuransijsaddbjsdmpplus+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&uangasuransipokok="+uangasuransipokok+"&carabayarjsdmpplus="+carabayarjsdmpplus,
				success : function(data) {
					
					if (data == 'tidak bisa')
					{
						$("#premijsaddbjsdmpplus").val(0);
						document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(0) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
						document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
						if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
					}
					else
					{
						$("#premijsaddbjsdmpplus").val(data);
						document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
						document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
						if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
						else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
						{
							document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
							document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
						
							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
							document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
						}
					}
				}
			});
			
		});
		
		$("#wpjsdmpplus").change(function() {
			var wpjsdmpplus = document.getElementById("wpjsdmpplus").value;
			
			if (wpjsdmpplus == '1')
			{
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
				var masaasuransi = document.getElementById("masaasuransi").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjsdmpplus = $("#carabayarjsdmpplus").val();
				
				var birthday = +new Date(document.getElementById("lahirnasabah").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdmpplus/hitungwpjsdmpplus');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&carabayarjsdmpplus="+carabayarjsdmpplus,
							success : function(data) {
								$("#premiwpjsdmpplus").val(data);
								if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
								}
								else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
								}
								document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
								document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
								if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
							}
						});				
			}
			else if (wpjsdmpplus == '0')
			{
				document.getElementById("premiwpjsdmpplus").value = 0;
				if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
				}
				else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
				}
				document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
				document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
				
				if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
			}
			
		});
		
		$("#jsspdjsdmpplus").change(function() {
			var jsspdjsdmpplus = document.getElementById("jsspdjsdmpplus").value;
			
			if (jsspdjsdmpplus == '1')
			{
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
				var masaasuransi = document.getElementById("masaasuransi").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjsdmpplus = $("#carabayarjsdmpplus").val();
				
				var birthday = +new Date(document.getElementById("lahirnasabah").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdmpplus/hitungspdjsdmpplus');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus,
							success : function(data) {
								$("#premijsspdjsdmpplus").val(data);
								
								if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
								}
								else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
								}
								document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
								document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
								
								if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
							}
						});	
			}
			else if (jsspdjsdmpplus == '0')
			{
				document.getElementById("premijsspdjsdmpplus").value = 0;
				if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
				}
				else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
				}
				document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
				document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
				
				if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
			}
			
		});
		
		$("#jssptpdjsdmpplus").change(function() {
			var jssptpdjsdmpplus = document.getElementById("jssptpdjsdmpplus").value;
			
			if (jssptpdjsdmpplus == '1')
			{
				var uangasuransipokok = document.getElementById("uangasuransipokok").value;
			
				var masaasuransi = document.getElementById("masaasuransi").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjsdmpplus = $("#carabayarjsdmpplus").val();
				
				var birthday = +new Date(document.getElementById("lahirnasabah").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jsdmpplus/hitungsptpdjsdmpplus');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsdmpplus="+carabayarjsdmpplus,
							success : function(data) {
								$("#premijssptpdjsdmpplus").val(data);
								
								if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
								}
								else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
								{
									document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
								}
								document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));
								document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
								
								if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
								else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
								{
									document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
									document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
									document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
									document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
								
									document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
									document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
									document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
									document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
								}
							}
						});		
			}
			else if (jssptpdjsdmpplus == '0')
			{
				document.getElementById("premijssptpdjsdmpplus").value = 0;
				if (document.getElementById("premijssptpdjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijssptpdjsdmpplus").value = parseInt(0);
				}
				else if (document.getElementById("premijsaddbjsdmpplus").value == 'tidak bisa')
				{
					document.getElementById("premijsaddbjsdmpplus").value = parseInt(0);	
				}
				document.getElementById("totalpremiriderjsdmpplus2").value = Math.round(parseInt(document.getElementById("premijstpdjsdmpplus").value) + parseInt(document.getElementById("premiwpjsdmpplus").value) + parseInt(document.getElementById("premici53jsdmpplus").value) + parseInt(document.getElementById("premijsaddbjsdmpplus").value) + parseInt(document.getElementById("premijsspdjsdmpplus").value) + parseInt(document.getElementById("premijssptpdjsdmpplus").value));		
				document.getElementById("totalpremiriderjsdmpplussum").value = Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplus1").value)+parseInt(document.getElementById("totalpremiriderjsdmpplus2").value));
			
				if (document.getElementById("carabayarjsdmpplus").value  == "Bulanan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.095);
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);		
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Kuartalan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.27);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Semesteran")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value) / 0.52);		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Sekaligus")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
				else if (document.getElementById("carabayarjsdmpplus").value  == "Tahunan")
				{
					document.getElementById("tabelrider5tahunpertama").value = 	Math.round(parseInt(document.getElementById("totalpremiriderjsdmpplussum").value));		
					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.52);
					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.27);
					document.getElementById("tabelriderbulanan").value = Math.round(parseInt(document.getElementById("tabelrider5tahunpertama").value) * 0.095);	
				
					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremisemesteran").value) + parseInt(document.getElementById("tabelridersemesteran").value));
					document.getElementById("tabelriderpremi5tahunpertama").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelrider5tahunpertama").value));
				}
			}
			
		});
		
		$("#hubungandenganpempol").change(function() {
			var hubungandenganpempol = $("#hubungandenganpempol").val();	
			
			if (hubungandenganpempol == 'Suami/Istri')
			{
				document.getElementById("jsspdjsdmpplus").disabled = false;
				document.getElementById("jssptpdjsdmpplus").disabled = false;
			}
			else if (hubungandenganpempol == 'Lainnya')
			{
				document.getElementById("jsspdjsdmpplus").disabled = true;
				document.getElementById("jssptpdjsdmpplus").disabled = true;
			}
			else
			{
				document.getElementById("jsspdjsdmpplus").disabled = true;
				document.getElementById("jssptpdjsdmpplus").disabled = true;
			}
		});
	   
	});
	   
	   
</script>