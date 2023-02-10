<!--
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
	<div class="form-group">
		<label class="control-label col-md-4">Pilihan Produk <span class="required"> * </span> </label>
		<div class="col-md-6">
		<select class="form-control " name="pilihanproduk" id="pilihanproduk" >
			<option value="1">JS SAVING PLAN 3 BULAN</option>
			<option value="2">JS SAVING PLAN 6 BULAN</option>
		</select>
		</div>
	</div>
</div>
-->

<br>

<h3 class="block" align="center">PEMEGANG POLIS/TERTANGGUNG</h3>
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
					<label class="control-label col-md-4">Tanggal Lahir<span class="required"> * </span></label>
					<div class="col-md-6">
					<input class="form-control form-control-inline input-xs date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" onChange=""/>
					<span class="help-block">
					 Masukkan Tanggal Lahir
					</span>
					</div>
				</div>
                                               
                <div class="form-group">
					<label class="control-label col-md-4">Usia<span class="required"> * </span></label>
					<div class="col-md-6">
					<input id="usiacalontertanggung" name="usiacalontertanggung" size="16" type="text" value="" placeholder="Usia Calon Tertanggung" readonly/>
					</div>
					
					<span class="help-block">
					Tahun
					</span>
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

<h3 class="block" align="center">PERTANGGUNGAN</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
	<div class="col-md-6">
						
                        								

		<div class="form-group">
			<label class="control-label col-md-4">Premi Sekaligus <span class="required"> * </span> </label>
			<div class="col-md-6">
			<div class="input-group">
			<input class="form-control" placeholder="Premi Sekaligus" type="number" name="premisekaligus" id="premisekaligus" size="16"/>
			<span class="help-block" style="color: #FF0000">
			Premi Minimal Rp 50.000.000,-
			</span>
			</div>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-4">Saat Mulai Asuransi<span class="required"> * </span></label>
			<div class="col-md-6">
			<input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransi" name="saatmulaiasuransi" size="16" type="text" value="" placeholder="Saat Mulai Asuransi"/>
			<span class="help-block">
			Masukkan Saat Mulai Asuransi
			</span>
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-md-4">Masa Asuransi<span class="required"> * </span></label>

			<div class="col-md-6">
			<input class="form-control" placeholder="Masa Asuransi" type="number" name="masaasuransi" id="masaasuransi" value="5" readonly>

			</div>
			<span class="help-block">
			Tahun
			</span>
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
										
										<td> BUNGA INVESTASI PRODUK JS SAVING PLAN</td>
										
									</tr>
								</thead>

								<tbody>
									<tr>
										<td>Tahun Ke-:</td>
										<td>1</td>
										<td>2</td>
										<td>3</td>
										<td>4</td>
										<td>5</td>
									</tr>
									<tr>
										<td>Bunga Investasi:</td>
										<td>5.00%</td>
										<td>4.50%</td>
										<td>4.50%</td>
										<td>4.50%</td>
										<td>4.50%</td>
									</tr>
								</tbody>
							</table>
							<p>*) Bunga Investasi tahun ke-2 dst merupakan asumsi.</p>
							
							<br>
							<br>

							<table class="table table-striped table-hover">
								<thead>
									<tr>
										
										<td><b>PENGEMBANGAN DANA PRODUK JS SAVING PLAN</b></td>
										
									</tr>
								</thead>
								<thead>
									<tr>
										<th id="akhirbulanke" name="akhirbulanke" >
											Akhir Tahun ke- 
										</th>
										<th >
											 Nilai Tunai
										</th>
                                        <th >
											 Manfaat Meninggal Dunia
										</th>
                                        <th >
											Total Manfaat 
										</th>
									</tr>
								</thead>
									
								<tbody>
									<tr>
										<td>1</td>
										<td><input class="form-control" placeholder="" type="number" name="nilaitunai1" id="nilaitunai1" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="manfaatmeninggaldunia1" id="manfaatmeninggaldunia1" onchange="" readonly ></td>
										<td><input class="form-control" placeholder="" type="number" name="totalmanfaat1" id="totalmanfaat1" onchange="" readonly ></td>
									</tr>
                                    <tr>
										<td>2</td>
										<td><input class="form-control" placeholder="" type="number" name="nilaitunai2" id="nilaitunai2" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="manfaatmeninggaldunia2" id="manfaatmeninggaldunia2" onchange="" readonly ></td>
										<td><input class="form-control" placeholder="" type="number" name="totalmanfaat2" id="totalmanfaat2" onchange="" readonly ></td>
									</tr>
                                    <tr>
										<td>3</td>
										<td><input class="form-control" placeholder="" type="number" name="nilaitunai3" id="nilaitunai3" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="manfaatmeninggaldunia3" id="manfaatmeninggaldunia3" onchange="" readonly ></td>
										<td><input class="form-control" placeholder="" type="number" name="totalmanfaat3" id="totalmanfaat3" onchange="" readonly ></td>
									</tr>
                                    <tr>
										<td>4</td>
										<td><input class="form-control" placeholder="" type="number" name="nilaitunai4" id="nilaitunai4" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="manfaatmeninggaldunia4" id="manfaatmeninggaldunia4" onchange="" readonly ></td>
										<td><input class="form-control" placeholder="" type="number" name="totalmanfaat4" id="totalmanfaat4" onchange="" readonly ></td>
									</tr>
									<tr>
										<td>5</td>
										<td><input class="form-control" placeholder="" type="number" name="nilaitunai5" id="nilaitunai5" onchange="" readonly></td>
                                        <td><input class="form-control" placeholder="" type="number" name="manfaatmeninggaldunia5" id="manfaatmeninggaldunia5" onchange="" readonly ></td>
										<td><input class="form-control" placeholder="" type="number" name="totalmanfaat5" id="totalmanfaat5" onchange="" readonly ></td>
									</tr>
								</tbody>
							</table>
                        	<p>Risiko Awal adalah sebesar Akumulasi Uang Pertanggungan dari seluruh Polis yang dimiliki Tertanggung.</p>
                            
						</div>
</div>

</div>

<script>
jQuery(document).ready(function() {       
		// initiate layout and plugins
		App.init();
		ComponentsPickers.init();
	
//		var pilihanproduk = document.getElementById("pilihanproduk").value;
//		var akhirbulanke = document.getElementById("akhirbulanke");
//
//		if (pilihanproduk == 1)
//		{
//			akhirbulanke.textContent = "Akhir 3 Bulan ke-";
//
//		}
//		else if (pilihanproduk == 2)
//		{
//			akhirbulanke.textContent = "Akhir 6 Bulan ke-";		
//
//		}
	    
		$("#tertanggungsamadenganpemegangpolis").click(function() {
		if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
			
				
			
				document.getElementById("usiacalontertanggung").value = usiasekarang;
					
				document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
				document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
				$('#tanggallahircalontertanggung').trigger('change');
			
				var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
			
				document.getElementById("usiacalontertanggung").value = parseInt(usiasekarang);
					
					
				if (document.getElementById('gendernasabah').value == "M") {
				document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
				$('#jeniskelamincalontertanggung').trigger('change');
				}
				else if (document.getElementById('gendernasabah').value == "F") {
				document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
				$('#jeniskelamincalontertanggung').trigger('change');
				

			//document.getElementById("minimalua").value = usiasekarang.value;
				}
					 
				} else {
					document.getElementById("namalengkapcalontertanggung").value = ""; 
					document.getElementById("tanggallahircalontertangggung").value = ""; 
					document.getElementById('jeniskelamincalontertanggung').value = "";
					$('#jeniskelamincalontertanggung').trigger('change');
					document.getElementById('carabayar').value = "";
					$('#carabayar').trigger('change');
					
					document.getElementById("usiacalontertanggung").value = "";
				}	
	
		});
		
		$("#tanggallahircalontertangggung").change(function() {
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			document.getElementById("usiacalontertanggung").value = parseInt(usiasekarang);
			
		});
	
//		$("#pilihanproduk").change(function() {
//			var pilihanproduk = document.getElementById("pilihanproduk").value;
//			var akhirbulanke = document.getElementById("akhirbulanke");
//			
//			if (pilihanproduk == 1)
//			{
//				akhirbulanke.textContent = "Akhir 3 Bulan ke-";
//					
//			}
//			else if (pilihanproduk == 2)
//			{
//				akhirbulanke.textContent = "Akhir 6 Bulan ke-";		
//				
//			}
//			
//		});
	
		$("#premisekaligus").change(function() {
			var premisekaligus = document.getElementById("premisekaligus").value;
			
			
			var manfaatmeninggaldunia1 = document.getElementById("manfaatmeninggaldunia1").value;
			var manfaatmeninggaldunia2 = document.getElementById("manfaatmeninggaldunia2").value;
			var manfaatmeninggaldunia3 = document.getElementById("manfaatmeninggaldunia3").value;
			var manfaatmeninggaldunia4 = document.getElementById("manfaatmeninggaldunia4").value;
			var manfaatmeninggaldunia5 = document.getElementById("manfaatmeninggaldunia5").value;
			
			if (premisekaligus < 50000000)
			{	
				alert('Premi Sekaligus Minimal Rp. 50.000.000 !')
				document.getElementById("premisekaligus").value = 50000000;
					
			}
			else
			{
				document.getElementById("nilaitunai1").value = parseInt(document.getElementById("premisekaligus").value * (1+(5/100)));
				document.getElementById("nilaitunai2").value = parseInt(document.getElementById("nilaitunai1").value * (1+(4.5/100)));
				document.getElementById("nilaitunai3").value = parseInt(document.getElementById("nilaitunai2").value * (1+(4.5/100)));
				document.getElementById("nilaitunai4").value = parseInt(document.getElementById("nilaitunai3").value * (1+(4.5/100)));
				document.getElementById("nilaitunai5").value = parseInt(document.getElementById("nilaitunai4").value * (1+(4.5/100)));
				
				document.getElementById("manfaatmeninggaldunia1").value = parseInt(0.25 * document.getElementById("premisekaligus").value);
				document.getElementById("manfaatmeninggaldunia2").value = parseInt(0.25 * document.getElementById("premisekaligus").value);
				document.getElementById("manfaatmeninggaldunia3").value = parseInt(0.25 * document.getElementById("premisekaligus").value);
				document.getElementById("manfaatmeninggaldunia4").value = parseInt(0.25 * document.getElementById("premisekaligus").value);
				document.getElementById("manfaatmeninggaldunia5").value = parseInt(0.25 * document.getElementById("premisekaligus").value);
				
				document.getElementById("totalmanfaat1").value = parseInt(document.getElementById("nilaitunai1").value) + parseInt(document.getElementById("manfaatmeninggaldunia1").value);
				document.getElementById("totalmanfaat2").value = parseInt(document.getElementById("nilaitunai2").value) + parseInt(document.getElementById("manfaatmeninggaldunia2").value);
				document.getElementById("totalmanfaat3").value = parseInt(document.getElementById("nilaitunai3").value) + parseInt(document.getElementById("manfaatmeninggaldunia3").value);
				document.getElementById("totalmanfaat4").value = parseInt(document.getElementById("nilaitunai4").value) + parseInt(document.getElementById("manfaatmeninggaldunia4").value);
				document.getElementById("totalmanfaat5").value = parseInt(document.getElementById("nilaitunai5").value) + parseInt(document.getElementById("manfaatmeninggaldunia5").value);
			}
			
		});
		
		
		
});
</script>