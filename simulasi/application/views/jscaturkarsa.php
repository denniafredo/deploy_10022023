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
          <label class="control-label col-md-4">Nama Anak Tertanggung</label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namaanaktertanggung" id="namaanaktertanggung" placeholder="Nama Anak Tertanggung"/>
														<span class="help-block">
															 Masukkan Nama Anak Tertanggung
														</span>
													</div>
		</div>
                                                    
						<div class="form-group">
	<label class="control-label col-md-4">Umur Anak<span class="required">
		 
	</span></label>
	
	<div class="col-md-6">
			<input class="form-control" placeholder="Umur Anak" type="number" name="umuranak" id="umuranak">
		
	</div>
    <span class="help-block">
			 Tahun (diisi 0 s/d 5)
	</span>
</div>
                        								
                                    <div class="form-group">
	<label class="control-label col-md-4">Masa Pembayaran Premi<span class="required">
		 
	</span></label>
	
	<div class="col-md-6">
			<input class="form-control" placeholder="Masa Pembayaran Premi" type="number" name="masaasuransi" id="masaasuransi" readonly>
		
	</div>
    <span class="help-block">
			 Tahun
	</span>
</div>
                                    <div class="form-group">
									  <label class="control-label col-md-4">Uang Asuransi <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Uang Asuransi Pokok" type="number" name="uangasuransipokok" id="uangasuransipokok" onChange="" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
                                      <label class="control-label col-md-4">Bulan Saat Mulai<span class="required"> * </span></label>
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
                                        <select class="form-control select2me" name="hcpjscaturkarsa" id="hcpjscaturkarsa" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjscaturkarsa" id="premihcpjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpjscaturkarsa" id="uangasuransihcpjscaturkarsa" onChange="" >
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
                                        <select class="form-control select2me" name="hcpbjscaturkarsa" id="hcpbjscaturkarsa" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpbjscaturkarsa" id="premihcpbjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpbjscaturkarsa" id="uangasuransihcpbjscaturkarsa" onChange="" disabled>
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
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjscaturkarsa1" id="totalpremiriderjscaturkarsa1" onChange="" readonly value="0">
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
											 Rawat Inap / hari
										</th>
                                        <th>
											ICU / haryyi 
										</th>
                                        <th>
											 Bedah / kasus
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
											 Pilihan : 1 atau 0
										</th>
                                        <th name="ketcarabayar2" id="ketcarabayar2">
											
										</th>
                                        <th>
											 UA
										</th>
									</tr>
								</thead>
									
								<tbody>
                                	<tr>
										<td>1.</td>
										<td>JS TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="tpdjscaturkarsa" id="tpdjscaturkarsa" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstpdjscaturkarsa" id="premijstpdjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstpdjscaturkarsa" id="uangasuransijstpdjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>2.</td>
										<td>JS WP</td>
                                        <td>
                                        <select class="form-control select2me" name="wpcaturkarsa" id="wpcaturkarsa" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premiwpjscaturkarsa" id="premiwpjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransiwpjscaturkarsa" id="uangasuransiwpjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                	<tr>
										<td>3.</td>
										<td>JS CI53</td>
                                        <td>
                                        <select class="form-control select2me" name="ci53jscaturkarsa" id="ci53jscaturkarsa" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premici53jscaturkarsa" id="premici53jscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransici53jscaturkarsa" id="uangasuransici53jscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>4.</td>
										<td>JS ADDB</td>
                                        <td>
                                        <select class="form-control select2me" name="addbjscaturkarsa" id="addbjscaturkarsa" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premiaddbjscaturkarsa" id="premiaddbjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransiaddbjscaturkarsa" id="uangasuransiaddbjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>5.</td>
										<td>JS SP-D</td>
                                        <td>
                                        <select class="form-control select2me" name="jsspdjscaturkarsa" id="jsspdjscaturkarsa" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsspdjscaturkarsa" id="premijsspdjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsspdjscaturkarsa" id="uangasuransijsspdjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>6.</td>
										<td>JS SP-TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jssptpdjscaturkarsa" id="jssptpdjscaturkarsa" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijssptpdjscaturkarsa" id="premijssptpdjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijssptpdjscaturkarsa" id="uangasuransijssptpdjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
                                    <tr>
										<td>7.</td>
										<td>JS TERM</td>
                                        <td>
                                        <select class="form-control select2me" name="jstermjscaturkarsa" id="jstermjscaturkarsa" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstermjscaturkarsa" id="premijstermjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstermjscaturkarsa" id="uangasuransijstermjscaturkarsa" onChange="" value="0" readonly>
                                        </td>
									</tr>
									
                                    <tr>
										<td></td>
										<td style="font-weight:bold">TOTAL</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjscaturkarsa2" id="totalpremiriderjscaturkarsa2" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                      </td>
									</tr>
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL PREMI RIDER</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjscaturkarsasum" id="totalpremiriderjscaturkarsasum" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                      </td>
									</tr>
								</tbody>
							</table>
                            <p><b>Syarat dan Ketentuan:</b><span style="color:#FF0000;margin-left:120px">*berdasarkan premi standar</span></p>
                            <p><span style="color:#FF0004">*</span>Jika ingin mengambil cash plan bedah maka harus mengambil cash plan murni dengan kelas yang sama.</p>
						</div>
</div>


</div>

<br>
<h3 class="block" align="center">Untuk Pengecekan</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-12">

        <div class="form-group">
        <label class="control-label col-md-3">Beasiswa yang diterima <span class="required"> * </span> </label>
            <div class="col-md-6">
                <div class="input-group">
                <input class="form-control" placeholder="" type="number" name="tabelbeasiswayangditerima" id="tabelbeasiswayangditerima" onchange="" disabled>
                <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
                </div>
            </div>
            <span class="help-block" style="color:#FF0000">
            / Bulan
            </span>
        </div>

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
										<td><input class="form-control" placeholder="" type="" name="tabelpremisekaligus" id="tabelpremisekaligus" onchange="" disabled value="0"></td>
                                        <td><input class="form-control" placeholder="" type="" name="tabelridersekaligus" id="tabelridersekaligus" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiridersekaligus" id="tabelpremiridersekaligus" onchange="" disabled value="0"></td>
									</tr>
                                    <tr style="display:none">
										<td>Premi Cicil 10 Tahun (Tahun2 Berikutnya)</td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremicicil10tahuntahun2berikutnya" id="tabelpremicicil10tahuntahun2berikutnya" onchange="" disabled value="0"></td>
                                        <td><input class="form-control" placeholder="" type="" name="tabelridercicil10tahuntahun2berikutnya" id="tabelridercicil10tahuntahun2berikutnya" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiridercicil10tahuntahuntahun2berikutnya" id="tabelpremiridercicil10tahuntahuntahun2berikutnya" onchange="" disabled value="0"></td>
									</tr>
									<tr>
										<td>Premi Tahunan </td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremitahunan" id="tabelpremitahunan" onchange="" disabled value="0"></td>
                                        <td><input class="form-control" placeholder="" type="" name="tabelridertahunan" id="tabelridertahunan" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiridertahunan" id="tabelpremiridertahunan" onchange="" disabled value="0"></td>
									</tr>
                                    <tr style="display:none">
										<td>Premi Tahunan (Tahun2 Berikutnya)</td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremitahunantahun2berikutnya" id="tabelpremitahunantahun2berikutnya" onchange="" disabled value="0"></td>
                                        <td><input class="form-control" placeholder="" type="" name="tabelridertahunantahun2berikutnya" id="tabelridertahunantahun2berikutnya" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiridertahunantahun2berikutnya" id="tabelpremiridertahunantahun2berikutnya" onchange="" disabled value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Semesteran </td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremisemesteran" id="tabelpremisemesteran" onchange="" disabled value="0"></td>
                                        <td><input class="form-control" placeholder="" type="" name="tabelridersemesteran" id="tabelridersemesteran" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiridersemesteran" id="tabelpremiridersemesteran" onchange="" disabled value="0"></td>
									</tr>
                                    <tr>
										<td>Premi Kwartalan </td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremikwartalan" id="tabelpremikwartalan" onchange="" disabled value="0"></td>
                                       <td><input class="form-control" placeholder="" type="" name="tabelriderkuartalan" id="tabelriderkuartalan" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiriderkuartalan" id="tabelpremiriderkuartalan" onchange="" disabled value="0"></td>
								                                    <tr>
										<td>Premi Bulanan </td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremibulanan" id="tabelpremibulanan" onchange="" disabled value="0"></td>
                                        <td><input class="form-control" placeholder="" type="" name="tabelriderbulanan" id="tabelriderbulanan" onchange="" disabled value="0"></td>
										<td><input class="form-control" placeholder="" type="" name="tabelpremiriderbulanan" id="tabelpremiriderbulanan" onchange="" disabled value="0"></td>
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
		
		$("#umuranak").change(function() {
			var umuranak = 	$("#umuranak").val();
			var masaasuransi = 	$("#masaasuransi").val();
			
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			
			if ((umuranak < 0) || (umuranak > 5))
			{
				alert('Umur Anak Antara 0-5 Tahun!');	
				$("#umuranak").val("");
				$('#umuranak').trigger('change');
				
				$("#masaasuransi").val("");
				$('#masaasuransi').trigger('change');	
			}
			else
			{	
			
				document.getElementById('masaasuransi').value = 18 - umuranak;
				
				
			}
		});
		
		$("#uangasuransipokok").change(function() {
		
		var masaasuransi = 	$("#masaasuransi").val();
			
			var uangasuransipokok = $("#uangasuransipokok").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
				
		$.ajax({
						type	: "POST",
						url		: "<?=base_url('jscaturkarsa/hitungbeasiswayangditerimajscaturkarsa');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelbeasiswayangditerima").val(data);
						}
					});
					
		$.ajax({
						type	: "POST",
						url		: "<?=base_url('jscaturkarsa/hitungpremisekaligusjscaturkarsa');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremisekaligus").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jscaturkarsa/hitungpremitahunanjscaturkarsa');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremitahunan").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jscaturkarsa/hitungpremisemesteranjscaturkarsa');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremisemesteran").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jscaturkarsa/hitungpremikwartalanjscaturkarsa');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremikwartalan").val(data);
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jscaturkarsa/hitungpremibulananjscaturkarsa');?>",
						data	: "uangasuransipokok="+uangasuransipokok+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#tabelpremibulanan").val(data);
						}
					});
		
		});
		
	   });
</script>