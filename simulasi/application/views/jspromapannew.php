<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
<body>

<form id="regForm" >
  
  <!-- One "tab" for each step in the form: -->
	<div class="tab">
	<h3>Pertanggungan</h3>
		<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
			<div class="form-group">
				<label class="control-label col-md-4">(Untuk Pemegang Polis) Apakah Pempol Perokok? <span class="required"> * </span></label>
				<div class="col-md-3">
				<select class="form-control " name="perokokpempol" id="perokokpempol" >
					<option value="T">Tidak</option>
					<option value="Y">Ya</option>
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
				<select class="form-control " name="jeniskelamincalontertanggung" id="jeniskelamincalontertanggung" >
				<option value="">Pilih Jenis Kelamin</option>
				<option value="L">Laki-Laki</option>
				<option value="P">Perempuan</option>
				</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Tanggal Lahir<span class="required"> * </span></label>
				<div class="col-md-6">
					<input class="form-control form-control-inline input-xs date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" />
					<span class="help-block">
						 Masukkan Tanggal Lahir
					</span>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-4">Hubungan dgn PemPol <span class="required"> * </span></label>
				<div class="col-md-3">
					<select class="form-control " name="hubungandenganpempol" id="hubungandenganpempol" onChange="onHandleHubunganDenganPempol(this)">
						<option value="">Lainnya</option>
						<option value="1">Suami/Istri</option>
						<option value="2">Anak</option>
						<option value="3">Diri Sendiri</option>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span></label>
				<div class="col-md-3">
				<select class="form-control " name="perokok" id="perokok" >
					<option value="T">Tidak</option>
					<option value="Y">Ya</option>
				</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-4">No. KTP<span class="required"> * </span></label>
				<div class="col-md-6">
					<input class="form-control" id="noktp" name="noktp" size="16" type="number" placeholder="No. KTP"/>
					<span class="help-block">
						 Masukkan No. KTP
					</span>
				</div>
			</div>

			<div class="checkbox-list" data-error-container="#form_2_services_error">
				<label>
				<input type="checkbox" value="1" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis"/> Tertanggung sama dengan Pemegang Polis </label>
			</div> 
		</div> 
	</div>
	<div class="tab">
	<h3>Asuransi</h3>
	<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
		<div class="col-md-12">

			<div class="form-group">
				<label class="control-label col-md-4">Tanggal Ilustrasi<span class="required"> * </span></label>
				<div class="col-md-3">
				<input class="form-control form-control-inline input-small date-picker" id="tanggalilustrasi" name="tanggalilustrasi" size="16" type="text" value="" placeholder="Tanggal Ilustrasi" />
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Asumsi Cuti Premi
					<span class="required">

					</span>
				</label>

				<div class="col-md-3">
					<input class="form-control" placeholder="Asumsi Cuti Premi" name="asumsicutipremi" id="asumsicutipremi" type="number" readonly>
				</div>

				<span class="help-block">
				 Tahun
				</span>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
				<div class="col-md-3">
					<select class="form-control " name="carabayarjspromapannew" id="carabayarjspromapannew" >
					<option value="1">Bulanan</option>  
					<option value="2">Tahunan</option>   
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Usia Produktif sampai dengan
					<span class="required">

					</span>
				</label>

				<div class="col-md-3">
					<input class="form-control" type="number" name="usiaproduktif" id="usiaproduktif" value="70"/>
				</div>

				<span class="help-block">
					Tahun
				</span>
			</div> 
			<div class="form-group">
				<label class="control-label col-md-4">Penghasilan Satu Tahun
					<span class="required">

					</span>
				</label>

				<div class="col-md-3">
					<input class="form-control" value="" type="number" name="penghasilansatutahun" id="penghasilansatutahun" />
				</div>
			</div>
			<div class="form-group" style="display: none">
				<label class="control-label col-md-4">Maksimal Uang Asuransi <span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
							<input class="form-control" placeholder="Maksimal Uang Asuransi" type="number" name="maksimaluangasuransi" id="maksimaluangasuransi" value="0" readonly/>
						</div>
					</div>
			</div>
			
			<div class="form-group" style="display: none">
				<label class="control-label col-md-4">Medical  <span class="required"> * </span></label>
				<div class="col-md-3">
				<select class="form-control " name="medical" id="medical" >
				<option value="T">Tidak</option>
				<option value="Y">Ya</option>
				</select>
				</div>
			</div>
			
			
			<div class="form-group">
				<label class="control-label col-md-4">Total Premi yang dibayar<span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
						<input class="form-control" placeholder="Total Premi yang dibayar" type="number" name="totalpremi" id="totalpremi" value="350000" >
						
						</div>
					</div>
					<span class="help-block" style="font-weight: bold">
				 		Total Premi 
					</span>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Premi Berkala <span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
						<input class="form-control" placeholder="Premi Berkala" type="number" name="premiberkala" id="premiberkala" value="245000" >
						
						</div>
					</div>
					<span class="help-block" style="font-weight: bold">
				 		Maksimal
					</span>
					<span class="help-block" id ="minimalpremiberkala" name="minimalpremiberkala">
				 		350.000 per Bulan	
					</span>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Top Up Berkala<span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
						<input class="form-control" placeholder="Top Up Berkala" type="number" name="topupberkala" id="topupberkala" value="105000" readonly>
						
						</div>
					</div>
					<span class="help-block" style="font-weight: bold">
				 		Minimal 
					</span>
					<span class="help-block" id ="minimaltopupberkala" name="minimaltopupberkala">
				 		150.000 per Bulan
					</span>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4">Top Up Sekaligus<span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
						<input class="form-control" placeholder="Top Up Sekaligus" type="number" name="topupsekaligus" id="topupsekaligus" value="0" >
							
						</div>
					</div>
					
			</div>
			
			<div class="form-group">
				<label class="control-label col-md-4">Uang Pertanggungan <span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
							<input class="form-control" placeholder="Uang Pertanggungan" type="number" name="uangpertanggungan" id="uangpertanggungan" value="150000000" >
						</div>
					</div>
					<span class="help-block" style="font-weight: bold; color: #FF0000" id="saranua" name="saranua">
				 		
					</span>
			</div>
			
			<div class="form-group" style="display: none">
				<label class="control-label col-md-4">Bea Materai<span class="required"> * </span> </label>
					<div class="col-md-3">
						<div class="input-group">
<!--							INI KATANYA BELUM JELAS PAKAI BEA MATERAI-->
							<input class="form-control" placeholder="Bea Materai" type="number" name="beamaterai" id="beamaterai" value="0" readonly>
						</div>
					</div>
			</div>
			
		</div>
													<!--/span-->												
	</div>
	</div>
	<div class="tab">
	<h3>Alokasi</h3>
	<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
		<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
		<thead>
			<tr role="row" class="heading">

				<th width="33%">
				Persentase Alokasi Dana Investasi (Dalam Persen)
				</th>
				<th width="33%">

				</th>
				<th width="33%">
				Maksimal 100%
				</th>

			</tr>
			<tr role="row" class="filter">
				<td>
					<p style="margin-top:5px">Alokasi Dana #1</p>
					<p style="margin-top:30px">Alokasi Dana #2</p>
				</td>
				<td>
				
				<div class="form-group">
					<div class="col-md-12">
						<select class="form-control " name="alokasidana1" id="alokasidana1" >
							<option value="">Pilih Alokasi Dana</option>
							<option value="1">JS LINK PASAR UANG</option>
							<option value="2">JS LINK PENDAPATAN TETAP</option>
							<option value="3" selected>JS LINK BERIMBANG</option>
							<option value="4">JS LINK EKUITAS</option>
<!--
							<option value="5">JS LINK GUARDIAN ASSURANCE 85</option>
							<option value="6">JS LINK GUARDIAN ASSURANCE 75</option>
-->
						</select>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-md-12">
						<select class="form-control " name="alokasidana2" id="alokasidana2" >
							<option value="">Pilih Alokasi Dana</option>
							<option value="1">JS LINK PASAR UANG</option>
							<option value="2">JS LINK PENDAPATAN TETAP</option>
							<option value="3">JS LINK BERIMBANG</option>
							<option value="4">JS LINK EKUITAS</option>
<!--
							<option value="5">JS LINK GUARDIAN ASSURANCE 85</option>
							<option value="6">JS LINK GUARDIAN ASSURANCE 75</option>
-->
						</select>
					</div>
				</div>
				</td>
				<td>
					<div class="form-group">
					<div class="col-md-12">
					<input class="form-control" placeholder="" type="number" name="persentasealokasidana1" id="persentasealokasidana1" onchange="onChangePersentaseAlokasiDana1(this)" value="100"> 
					</div>
					</div>
					<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
					
					<div class="form-group">
					<div class="col-md-12">
					<input class="form-control" placeholder="" type="number" name="persentasealokasidana2" id="persentasealokasidana2" onchange="onChangePersentaseAlokasiDana2(this)" >
					
					<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
					</div>
					</div>                    									
				</td>
			</tr>
		</thead>
		</table>
	</div>
	</div>
	<div class="tab">
	<h3>Pilihan Tambahan Manfaat (Rider)</h3>
		<div style="padding: 20px; margin-left:20px; margin-right:20px" class="row">
			<div class="col-md-4">	
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
									<th name="ketcarabayar" id="ketcarabayar" style="display: none">

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
									<select class="form-control " name="hcpjspromapannew" id="hcpjspromapannew"  >
										<option value="0">0</option>
										<option value="1">1</option>
									</select>
									</td>
									<td style="display: none">
									<input class="form-control" placeholder="" type="" name="premihcpjspromapannew" id="premihcpjspromapannew"  value="0" readonly>
									</td>
									<td>
									<select class="form-control " name="uangasuransihcpjspromapannew" id="uangasuransihcpjspromapannew"  disabled>
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
									<select class="form-control " name="hcpbjspromapannew" id="hcpbjspromapannew"  disabled>
										<option value="0">0</option>
										<option value="1">1</option>
									</select>
									</td>
									<td style="display: none">
									<input class="form-control" placeholder="" type="" name="premihcpbjspromapannew" id="premihcpbjspromapannew"  value="0" readonly>
									</td>
									<td>
									<select class="form-control " name="uangasuransihcpbjspromapannew" id="uangasuransihcpbjspromapannew"  disabled>
										<option value="0">0</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
									</td>
								</tr>
								<tr style="display: none">
									<td></td>
									<td style="font-weight:bold">TOTAL</td>
									<td></td>
									<td style="font-weight:bold">
									<input class="form-control" placeholder="" type="" name="totalpremiriderjspromapannew1" id="totalpremiriderjspromapannew1"  readonly value="0">
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
			
			<div class="col-md-8">

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
								<th style="display: none">
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
								<select class="form-control" name="jsaddbjspromapannew" id="jsaddbjspromapannew" >
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijsaddbjspromapannew" id="premijsaddbjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijsaddbjspromapannew" id="uangasuransijsaddbjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>2.</td>
								<td>JS TPD</td>
								<td>
								<select class="form-control " name="jstpdjspromapannew" id="jstpdjspromapannew" >
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijstpdjspromapannew" id="premijstpdjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijstpdjspromapannew" id="uangasuransijstpdjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>3.</td>
								<td>JS CI53</td>
								<td>
								<select class="form-control" name="ci53jspromapannew" id="ci53jspromapannew" >
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premici53jspromapannew" id="premici53jspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransici53jspromapannew" id="uangasuransici53jspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>4.</td>
								<td>JS Term Life</td>
								<td>
								<select class="form-control" name="termjspromapannew" id="termjspromapannew" >
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premitermjspromapannew" id="premitermjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransitermjspromapannew" id="uangasuransitermjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>5.</td>
								<td>JS Payor Benefit-Death</td>
								<td>
								<select class="form-control " name="jspbdjspromapannew" id="jspbdjspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijspbdjspromapannew" id="premijspbdjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijspbdjspromapannew" id="uangasuransijspbdjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>6.</td>
								<td>JS Payor Benefit-TPD</td>
								<td>
								<select class="form-control" name="jspbtpdjspromapannew" id="jspbtpdjspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijspbtpdjspromapannew" id="premijspbtpdjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijspbtpdjspromapannew" id="uangasuransijspbtpdjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>7.</td>
								<td>JS Spouse-Death</td>
								<td>
								<select class="form-control" name="jsspdjspromapannew" id="jsspdjspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijsspdjspromapannew" id="premijsspdjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijsspdjspromapannew" id="uangasuransijsspdjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>8.</td>
								<td>JS Spouse-TPD</td>
								<td>
								<select class="form-control" name="jssptpdjspromapannew" id="jssptpdjspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijssptpdjspromapannew" id="premijssptpdjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijssptpdjspromapannew" id="uangasuransijssptpdjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>9.</td>
								<td>JS Waiver Of Premium TPD</td>
								<td>
								<select class="form-control" name="jswptpdjspromapannew" id="jswptpdjspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijswptpdjspromapannew" id="premijswptpdjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijswptpdjspromapannew" id="uangasuransijswptpdjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>10.</td>
								<td>JS Waiver Of Premium CI</td>
								<td>
								<select class="form-control" name="jswpcijspromapannew" id="jswpcijspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijswpcijspromapannew" id="premijswpcijspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijswpcijspromapannew" id="uangasuransijswpcijspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr>
								<td>11.</td>
								<td>JS ADB</td>
								<td>
								<select class="form-control" name="jsadbjspromapannew" id="jsadbjspromapannew" disabled>
									<option value="0">0</option>
									<option value="1">1</option>
								</select>
								</td>
								<td style="display: none">
								<input class="form-control" placeholder="" type="" name="premijsadbjspromapannew" id="premijsadbjspromapannew"  value="0" readonly>
								</td>
								<td>
								<input class="form-control" placeholder="" type="" name="uangasuransijsadbjspromapannew" id="uangasuransijsadbjspromapannew"  value="0" disabled>
								</td>
							</tr>
							<tr style="display: none">
								<td></td>
								<td style="font-weight:bold">TOTAL PREMI RIDER</td>
								<td></td>
								<td style="font-weight:bold">
								<input class="form-control" placeholder="" type="" name="totalpremiriderjspromapannewsum" id="totalpremiriderjspromapannewsum"  readonly value="0">
								</td>
								<td>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
		</div>
	</div>

	
<!--	BUTTON-->
	<div style="overflow:auto;">
		<div style="float:right;">
		  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
		  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
		  <button type="button" id="submitBtn" name="submitBtn">Submit</button>
		</div>
	</div>
	<!-- Circles which indicates the steps of the form: -->
<!--
	<div style="text-align:center;margin-top:40px;">
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
		<span class="step"></span>
	</div>
-->
</form>

<script>
	
var birthday = +new Date(document.getElementById("tanggallahir").value);
var now = Date.now("MM-dd-yyyy");
var sls =((now - birthday) / 31557600000);
var usiasekarang = Math.floor(sls);

//JIKA USIA MASUK PEMEGANG POLIS KURANG DARI 17 TAHUN
if (usiasekarang < 17)
{
	alert('Usia sekarang : '+usiasekarang+' Usia Minimal Pemegang Polis Harus 17 Tahun!');
	$('#nextBtn').prop('disabled', true);
}
else
{
	$('#nextBtn').prop('disabled', false);
}
	
	
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab
	
function onChangePersentaseAlokasiDana1(input){
	if (document.getElementById("persentasealokasidana1").value > 100)
	{
		alert('Jumlah persen tidak boleh melebihi 100%');
		document.getElementById("persentasealokasidana1").value = parseInt(100);	
	}
//	else if (document.getElementById("persentasealokasidana1").value < 5)
//	{
//		alert('Jumlah alokasi dana tidak boleh kurang dari 5%');
//		document.getElementById("persentasealokasidana1").value = parseInt(5);	
//	}
	else if ((((document.getElementById("persentasealokasidana1").value) % 5) != 0))
	{
		alert('Jumlah alokasi dana harus kelipatan 5%');
		document.getElementById("persentasealokasidana1").value = parseInt(5);
	}
	/*else if (document.getElementById("persentasealokasidana1").value != ((document.getElementById("persentasealokasidana1").value) % 5))
	{
		alert('Jumlah alokasi dana harus kelipatan 5%');
		document.getElementById("persentasealokasidana1").value = parseInt(5);	
	}*/

	if (document.getElementById("persentasealokasidana1").value == "")
	{
	document.getElementById("persentasealokasidana1").value = parseInt(5);
	document.getElementById("persentasealokasidana2").value = parseInt(100 - document.getElementById("persentasealokasidana1").value);	
	}
	else
	{	
	document.getElementById("persentasealokasidana2").value = parseInt(100 - document.getElementById("persentasealokasidana1").value);
	}
}

function onChangePersentaseAlokasiDana2(input){
	if (document.getElementById("persentasealokasidana2").value > 100)
	{
		alert('Jumlah persen tidak boleh melebihi 100%');
		document.getElementById("persentasealokasidana2").value = parseInt(100);	
	}
//	else if (document.getElementById("persentasealokasidana2").value < 5)
//	{
//		alert('Jumlah alokasi dana tidak boleh kurang dari 5%');
//		document.getElementById("persentasealokasidana2").value = parseInt(5);	
//	}
	else if ((((document.getElementById("persentasealokasidana2").value) % 5) != 0))
	{
		alert('Jumlah alokasi dana harus kelipatan 5%');
		document.getElementById("persentasealokasidana2").value = parseInt(5);
	}
	/*else if (document.getElementById("persentasealokasidana2").value != ((document.getElementById("persentasealokasidana2").value) % 5))
	{
		alert('Jumlah alokasi dana harus kelipatan 5%');
		document.getElementById("persentasealokasidana2").value = parseInt(5);	
	}*/

	if (document.getElementById("persentasealokasidana2").value == "")
	{
	document.getElementById("persentasealokasidana2").value = parseInt(0);	
	document.getElementById("persentasealokasidana1").value = parseInt(100 - document.getElementById("persentasealokasidana2").value);
	}
	else
	{	
	document.getElementById("persentasealokasidana1").value = parseInt(100 - document.getElementById("persentasealokasidana2").value);
	}
}

function showTab(n) {
  // This function will display the specified tab of the form...
		
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
	  	
	  	document.getElementById("berikutnya").style.display = "none";
	  	document.getElementById("submitBtn").style.display = "none";
	 
  }
  else if (n == 1) {
	  
//	   PEMPOL
	    var namalengkap = document.getElementById("namalengkap").value;
	  	var tanggallahir = document.getElementById("tanggallahir").value;
	    var gender = document.getElementById("gendernasabah").value;
	  
	    if (gender == 'M')
		{
			gender = 'L';
		}
	  	else if (gender == 'F')
		{
			gender = 'P';
		}
	  
		var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
		var perokok =	document.getElementById("perokok").value;
	    var perokokpempol =	document.getElementById("perokokpempol").value;
		var namalengkapcalontertanggung = document.getElementById("namalengkapcalontertanggung").value;
		var tanggallahircalontertangggung = document.getElementById("tanggallahircalontertangggung").value;
		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
	    var email = document.getElementById("email").value;
	    var handphone = document.getElementById("handphone").value;
	    var phone = document.getElementById("phone").value;
	    var noktp = document.getElementById("noktp").value;
	  
	  	var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
	  
	  
	  	var asumsicutipremi =	(99-usiasekarang);
	  	document.getElementById("asumsicutipremi").value = asumsicutipremi;
	  
//	    alert(noktp);

		if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapannew/insertProTertanggung');?>",
				data	: "hubungandenganpempol="+hubungandenganpempol+"&perokok="+perokok+"&namalengkapcalontertanggung="+namalengkapcalontertanggung+"&tanggallahircalontertangggung="+tanggallahircalontertangggung+"&jeniskelamincalontertanggung="+gender+"&tertanggungsamadenganpemegangpolis="+tertanggungsamadenganpemegangpolis+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&noktp="+noktp,
				success : function(msg) {

//					alert(msg);

					//console.log(data);

				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapannew/insertProPempol');?>",
				data	: "hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&tertanggungsamadenganpemegangpolis="+tertanggungsamadenganpemegangpolis+"&email="+email+"&handphone="+handphone+"&phone="+phone,
				success : function(msg) {

//					alert(msg);

					//console.log(data);

				}
			});
		}
		else
		{
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapannew/insertProPempol');?>",
				data	: "hubungandenganpempol="+hubungandenganpempol+"&perokokpempol="+perokokpempol+"&namalengkap="+namalengkap+"&tanggallahir="+tanggallahir+"&gender="+gender+"&tertanggungsamadenganpemegangpolis="+tertanggungsamadenganpemegangpolis+"&email="+email+"&handphone="+handphone+"&phone="+phone,
				success : function(msg) {

//					alert(msg);

					//console.log(data);

				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapannew/insertProTertanggung');?>",
				data	: "hubungandenganpempol="+hubungandenganpempol+"&perokok="+perokok+"&namalengkapcalontertanggung="+namalengkapcalontertanggung+"&tanggallahircalontertangggung="+tanggallahircalontertangggung+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&tertanggungsamadenganpemegangpolis="+tertanggungsamadenganpemegangpolis+"&email="+email+"&handphone="+handphone+"&phone="+phone+"&noktp="+noktp,
				success : function(msg) {

//					alert(msg);

					//console.log(data);

				}
			});
		}
	  	document.getElementById("submitBtn").style.display = "none";
	  	document.getElementById("nextBtn").style.display = "inline";
//		document.getElementById("prevBtn").style.display = "inline";  
  }
  else if (n == 2) {
	  
	  	var birthday = +new Date(document.getElementById("tanggallahir").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
	  
		var tanggalilustrasi = document.getElementById("tanggalilustrasi").value;
		var asumsicutipremi =	(99-usiasekarang);
//	  	document.getElementById("asumsicutipremi").value = asumsicutipremi;
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;
		var usiaproduktif = document.getElementById("usiaproduktif").value;
		var penghasilansatutahun = document.getElementById("penghasilansatutahun").value;
		var maksimaluangasuransi = document.getElementById("maksimaluangasuransi").value;
		var uangpertanggungan =	document.getElementById("uangpertanggungan").value;
		var premiberkala = document.getElementById("premiberkala").value;
		var topupberkala = document.getElementById("topupberkala").value;
		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
	  	var topupsekaligus = document.getElementById("topupsekaligus").value;
	  	var totalpremi = document.getElementById("totalpremi").value;
	    var beamaterai = document.getElementById("beamaterai").value;
	    var medical = document.getElementById("medical").value;
	  
	  	
	  
		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/insertProAsuransiPokok');?>",
			data	: "tanggalilustrasi="+tanggalilustrasi+"&asumsicutipremi="+asumsicutipremi+"&carabayarjspromapannew="+carabayarjspromapannew+"&usiaproduktif="+usiaproduktif+"&penghasilansatutahun="+penghasilansatutahun+"&maksimaluangasuransi="+maksimaluangasuransi+"&uangpertanggungan="+uangpertanggungan+"&premiberkala="+premiberkala+"&topupberkala="+topupberkala+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&topupsekaligus="+topupsekaligus+"&totalpremi="+totalpremi+"&beamaterai="+beamaterai+"&medical="+medical,
			success : function(msg) {

//				alert(msg);

				//console.log(data);

			}
		});
	  	document.getElementById("submitBtn").style.display = "none";
	  	document.getElementById("nextBtn").style.display = "inline";
		document.getElementById("prevBtn").style.display = "inline";
  }
  else if (n == 3) {
	  
		var alokasidana1 =	document.getElementById("alokasidana1").value;
		var alokasidana2 = document.getElementById("alokasidana2").value;
		var persentasealokasidana1 = document.getElementById("persentasealokasidana1").value;
		var persentasealokasidana2 = document.getElementById("persentasealokasidana2").value;
	  
	  	var birthday = +new Date(document.getElementById("tanggallahir").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
	  
	  	if ((usiasekarang > 17) && (usiasekarang < 40))
		{	
			if (document.getElementById("jsadbjspromapannew").disabled == true)
			{
				document.getElementById("jsadbjspromapannew").value = 0;
				$('#jsadbjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jsadbjspromapannew").value = 1;
				$('#jsadbjspromapannew').trigger('change');
			}
			
			if (document.getElementById("ci53jspromapannew").disabled == true)
			{
				document.getElementById("ci53jspromapannew").value = 0;
				$('#ci53jspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("ci53jspromapannew").value = 1;
				$('#ci53jspromapannew').trigger('change');
			}
			
			if (document.getElementById("jswpcijspromapannew").disabled == true)
			{
				document.getElementById("jswpcijspromapannew").value = 0;
				$('#jswpcijspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jswpcijspromapannew").value = 1;
				$('#jswpcijspromapannew').trigger('change');
			}
			
			if (document.getElementById("jswptpdjspromapannew").disabled == true)
			{
				document.getElementById("jswptpdjspromapannew").value = 0;
				$('#jswptpdjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jswptpdjspromapannew").value = 1;
				$('#jswptpdjspromapannew').trigger('change');
			}
			
		}
		else if ((usiasekarang > 41) && (usiasekarang < 49))
		{
			
			if (document.getElementById("jsadbjspromapannew").disabled == true)
			{
				document.getElementById("jsadbjspromapannew").value = 0;
				$('#jsadbjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jsadbjspromapannew").value = 1;
				$('#jsadbjspromapannew').trigger('change');
			}
			
			if (document.getElementById("jsadbjspromapannew").disabled == true)
			{
				document.getElementById("jstpdjspromapannew").value = 0;
				$('#jstpdjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jstpdjspromapannew").value = 1;
				$('#jstpdjspromapannew').trigger('change');
			}
			
			if (document.getElementById("jswpcijspromapannew").disabled == true)
			{
				document.getElementById("jswpcijspromapannew").value = 0;
				$('#jswpcijspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jswpcijspromapannew").value = 1;
				$('#jswpcijspromapannew').trigger('change');
			}
			
			if (document.getElementById("jswptpdjspromapannew").disabled == true)
			{
				document.getElementById("jswptpdjspromapannew").value = 0;
				$('#jswptpdjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jswptpdjspromapannew").value = 1;
				$('#jswptpdjspromapannew').trigger('change');
			}
		}
		else if ((usiasekarang > 50) && (usiasekarang < 64))
		{
			if (document.getElementById("jstpdjspromapannew").disabled == true)
			{
				document.getElementById("jstpdjspromapannew").value = 0;
				$('#jstpdjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jstpdjspromapannew").value = 1;
				$('#jstpdjspromapannew').trigger('change');
			}
			
			if (document.getElementById("jswpcijspromapannew").disabled == true)
			{
				document.getElementById("jswpcijspromapannew").value = 0;
				$('#jswpcijspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jswpcijspromapannew").value = 1;
				$('#jswpcijspromapannew').trigger('change');
			}
			
			if (document.getElementById("jswptpdjspromapannew").disabled == true)
			{
				document.getElementById("jswptpdjspromapannew").value = 0;
				$('#jswptpdjspromapannew').trigger('change');
			}
			else
			{	
				document.getElementById("jswptpdjspromapannew").value = 1;
				$('#jswptpdjspromapannew').trigger('change');
			}
			
		}
//		else 
//		{
//			document.getElementById("jstpdjspromapannew").value = 0;
//			$('#jstpdjspromapannew').trigger('change');
//			document.getElementById("jswpcijspromapannew").value = 0;
//			$('#jswpcijspromapannew').trigger('change');
//			document.getElementById("jswptpdjspromapannew").value = 0;	
//			$('#jswptpdjspromapannew').trigger('change');
//			document.getElementById("jsaddbjspromapannew").value = 0;
//			$('#jsaddbjspromapannew').trigger('change');
//			document.getElementById("ci53jspromapannew").value = 0;	
//			$('#ci53jspromapannew').trigger('change');
//		}
	  
	    $.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/insertProAlokasiDana');?>",
			data	: "alokasidana1="+alokasidana1+"&alokasidana2="+alokasidana2+"&persentasealokasidana1="+persentasealokasidana1+"&persentasealokasidana2="+persentasealokasidana2,
			success : function(msg) {

//				alert(msg);

				//console.log(data);

			}
		});
	  	document.getElementById("submitBtn").style.display = "inline";
	  	document.getElementById("nextBtn").style.display = "inline";
		document.getElementById("prevBtn").style.display = "inline";
	  
  } else {
	  
	  
	  document.getElementById("prevBtn").style.display = "inline";
	  
  }
  
  if (n == (x.length - 1)) {
	  document.getElementById("submitBtn").style.display = "inline";
	  document.getElementById("nextBtn").style.display = "none";
  } else {
	  document.getElementById("nextBtn").innerHTML = "Next";
	  document.getElementById("prevBtn").style.display = "inline";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
	
//  alert('indeks '+n);
	
//  console.log('indeks ke '+n);
	
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:

  if (n == 1 && !validateForm()) return false;
  
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
  var hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
  var perokok =	document.getElementById("perokok").value;

//  console.log(jeniskelamincalontertanggung+" "+hubungandenganpempol+" "+perokok);
  
//   A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if ((y[i].value == "" && hubungandenganpempol == "") || (y[i].value == "" && perokok == "")  || (y[i].value == "" && jeniskelamincalontertanggung == "")) {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }	
	
//  console.log(valid);
  // If the valid status is true, mark the step as finished and valid: 
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
	
jQuery(document).ready(function() {       
  // initiate layout and plugins
	App.init();
	ComponentsPickers.init();
	
	var tdate = new Date();
	var dd = tdate.getDate(); //yields day
	var MM = tdate.getMonth(); //yields month
	var yyyy = tdate.getFullYear(); //yields year
	
	
	if (dd < 10)
	{
		var currentDate= '0'+dd + "/" +'0'+( MM+1) + "/" + yyyy;	
	}
	else 
	{
		var currentDate= dd + "/" +'0'+( MM+1) + "/" + yyyy;
	}
	
	
	document.getElementById("tanggallahircalontertangggung").value = currentDate;
	document.getElementById("tanggalilustrasi").value = currentDate;

	$("#tertanggungsamadenganpemegangpolis").click(function() {
	if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
	
//		$('#jswptpdjspromapannew').prop('disabled', false);
//		$('#jswpcijspromapannew ').prop('disabled', false);

		document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
		document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
		document.getElementById("hubungandenganpempol").value = 3; 
		$('#tanggallahircalontertanggung').trigger('change');

		if (document.getElementById('gendernasabah').value == "M") {
			document.getElementById("jeniskelamincalontertanggung").value = "L";
			$('#jeniskelamincalontertanggung').trigger('change');
		}
		else if (document.getElementById('gendernasabah').value == "F") {
			document.getElementById("jeniskelamincalontertanggung").value="P";
			$('#jeniskelamincalontertanggung').trigger('change');

			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);

			//document.getElementById("minimalua").value = usiasekarang.value;
		}
		
		$('#namalengkapcalontertanggung').prop('disabled', true);
		$('#tanggallahircalontertangggung').prop('disabled', true);
		$('#jeniskelamincalontertanggung').prop('disabled', true);
		$('#hubungandenganpempol').prop('disabled', true);
		
		$('#hcpjspromapannew').prop('disabled', false);
		$('#hcpbjspromapannew').prop('disabled', false);
		$('#jsaddbjspromapannew').prop('disabled', false);	
		$('#jstpdjspromapannew').prop('disabled', false);

		$('#ci53jspromapannew').prop('disabled', false);
		$('#termjspromapannew').prop('disabled', false);
		$('#jspbdjspromapannew').prop('disabled', false);	
		$('#jspbtpdjspromapannew').prop('disabled', false);

		$('#jsspdjspromapannew').prop('disabled', true);
		$('#jssptpdjspromapannew').prop('disabled', true);
		$('#jswptpdjspromapannew').prop('disabled', false);	
		$('#jswpcijspromapannew').prop('disabled', false);
		$('#jsadbjspromapannew').prop('disabled', false );
		
	}
	else
	{
		
//		document.getElementById("jswptpdjspromapannew").value = 0;
//		$('#jswptpdjspromapannew').trigger('change');
//
//		document.getElementById("jswpcijspromapannew").value = 0;
//		$('#jswpcijspromapannew').trigger('change');
//
//		$('#jswptpdjspromapannew').prop('disabled', true);
//		$('#jswpcijspromapannew').prop('disabled', true);
		
		$('#namalengkapcalontertanggung').prop('disabled', false);
		$('#tanggallahircalontertangggung').prop('disabled', false);
		$('#jeniskelamincalontertanggung').prop('disabled', false);
		$('#hubungandenganpempol').prop('disabled', false);
		document.getElementById("namalengkapcalontertanggung").value = ""; 
		document.getElementById("tanggallahircalontertangggung").value = ""; 
		document.getElementById('jeniskelamincalontertanggung').value = "";
		document.getElementById('hubungandenganpempol').value = "";
		$('#jeniskelamincalontertanggung').trigger('change');
		document.getElementById('carabayar').value = " ";
		$('#carabayar').trigger('change');
		
		hubungandenganpempol = document.getElementById('hubungandenganpempol').value;
		
		if (hubungandenganpempol=='1')
		{
			$('#hcpjspromapannew').prop('disabled', false);
			$('#hcpbjspromapannew').prop('disabled', false);
			$('#jsaddbjspromapannew').prop('disabled', false);	
			$('#jstpdjspromapannew').prop('disabled', false);
			
			$('#ci53jspromapannew').prop('disabled', false);
			$('#termjspromapannew').prop('disabled', false);
			$('#jspbdjspromapannew').prop('disabled', false);	
			$('#jspbtpdjspromapannew').prop('disabled', false);
			
			$('#jsspdjspromapannew').prop('disabled', false);
			$('#jssptpdjspromapannew').prop('disabled', false);
			$('#jswptpdjspromapannew').prop('disabled', true);	
			$('#jswpcijspromapannew').prop('disabled', true );	
			$('#jsadbjspromapannew').prop('disabled', true );
			
			$('#nextBtn').prop('disabled', false);	
		}
		else if (hubungandenganpempol=='2')
		{
			$('#hcpjspromapannew').prop('disabled', false);
			$('#hcpbjspromapannew').prop('disabled', false);
			$('#jsaddbjspromapannew').prop('disabled', false);	
			$('#jstpdjspromapannew').prop('disabled', false);
			
			$('#ci53jspromapannew').prop('disabled', false);
			$('#termjspromapannew').prop('disabled', false);
			$('#jspbdjspromapannew').prop('disabled', false);	
			$('#jspbtpdjspromapannew').prop('disabled', false);
			
			$('#jsspdjspromapannew').prop('disabled', false);
			$('#jssptpdjspromapannew').prop('disabled', false);
			$('#jswptpdjspromapannew').prop('disabled', true);	
			$('#jswpcijspromapannew').prop('disabled', true );
			$('#jsadbjspromapannew').prop('disabled', true );
			
			
			$('#nextBtn').prop('disabled', false);
		}
		
	}


	});

	$("#tanggallahircalontertangggung").change(function() {
		var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
//		alert(usiasekarang);
		
		var hubungandenganpempol =  document.getElementById("hubungandenganpempol").value;
		
		var getBirthdayDate = new Date(tanggallahircalontertangggung).getDate(); 
		var getBirthdayMonth = new Date(tanggallahircalontertangggung).getMonth()+1; 
		var getBirthdayFullYear = new Date(tanggallahircalontertangggung).getFullYear();
		
		var getNowDate = new Date().getDate(); 
		var getNowMonth = new Date().getMonth(); 
		var getNowFullYear = new Date().getFullYear(); 
		
		var m = ((getNowFullYear - getBirthdayFullYear) * 12) - getBirthdayMonth + getNowMonth;
	
//		USIA MAKSIMAL 64 TAHUN
		if (usiasekarang > 64)
		{
			alert('Usia Maksimal 64 Tahun!');
			$("#tanggallahircalontertangggung").val("");
			$('#tanggallahircalontertangggung').trigger('change');
			$('#nextBtn').prop('disabled', false);
		}
		else if ((hubungandenganpempol=='1')&&((usiasekarang > 64)||(usiasekarang < 17)))
		{
			alert('Usia sekarang : '+usiasekarang+' Usia Minimal 17 Tahun atau Kurang dari 64 Tahun!');
			$('#nextBtn').prop('disabled', true);
		}
		else if ((hubungandenganpempol=='2')&&(m < 6))
		{
			alert('Usia sekarang : '+usiasekarang+' bulan, Usia Minimal Anak Wajib 6 Bulan');
			$('#nextBtn').prop('disabled', true);
		}
//		JIKA USIA ANAK 6 BULAN / 16 TAHUN
//		else if ((hubungandenganpempol=='2')&&((m > 6)||(usiasekarang < 16)))
//		{
//			alert('Wajib Mencantumkan Akta Kelahiran!');
//			$('#nextBtn').prop('disabled', false);
//		}
//		JIKA KURANG DARI 17 TAHUN TIDAK BISA MENGAMBIL RIDER
		else if (usiasekarang < 17)
		{
			$('#hcpjspromapannew').prop('disabled', true);
			$('#hcpbjspromapannew').prop('disabled', true);
			$('#jsaddbjspromapannew').prop('disabled', true);	
			$('#jstpdjspromapannew').prop('disabled', true);
			
			$('#ci53jspromapannew').prop('disabled', true);
			$('#termjspromapannew').prop('disabled', true);
			$('#jspbdjspromapannew').prop('disabled', true);	
			$('#jspbtpdjspromapannew').prop('disabled', true);
			
			$('#jsspdjspromapannew').prop('disabled', true);
			$('#jssptpdjspromapannew').prop('disabled', true);
			$('#jswptpdjspromapannew').prop('disabled', true);	
			$('#jswpcijspromapannew').prop('disabled', true);	
			
		}
//		else if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
//	
//		$('#jswptpdjspromapannew').prop('disabled', false);
//		$('#jswpcijspromapannew ').prop('disabled', false);
//
//		document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
//		document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
//		document.getElementById("hubungandenganpempol").value = 3; 
//		$('#tanggallahircalontertanggung').trigger('change');
//
//		if (document.getElementById('gendernasabah').value == "M") {
//			document.getElementById("jeniskelamincalontertanggung").value = "L";
//			$('#jeniskelamincalontertanggung').trigger('change');
//		}
//		else if (document.getElementById('gendernasabah').value == "F") {
//			document.getElementById("jeniskelamincalontertanggung").value="P";
//			$('#jeniskelamincalontertanggung').trigger('change');
//
//			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
//			var now = Date.now("MM-dd-yyyy");
//			var sls =((now - birthday) / 31557600000);
//			var usiasekarang = Math.floor(sls);
//
//			//document.getElementById("minimalua").value = usiasekarang.value;
//		}
//		
//		$('#namalengkapcalontertanggung').prop('disabled', true);
//		$('#tanggallahircalontertangggung').prop('disabled', true);
//		$('#jeniskelamincalontertanggung').prop('disabled', true);
//		$('#hubungandenganpempol').prop('disabled', true);
//		
//		$('#hcpjspromapannew').prop('disabled', false);
//		$('#hcpbjspromapannew').prop('disabled', false);
//		$('#jsaddbjspromapannew').prop('disabled', false);	
//		$('#jstpdjspromapannew').prop('disabled', false);
//
//		$('#ci53jspromapannew').prop('disabled', false);
//		$('#termjspromapannew').prop('disabled', false);
//		$('#jspbdjspromapannew').prop('disabled', false);	
//		$('#jspbtpdjspromapannew').prop('disabled', false);
//
//		$('#jsspdjspromapannew').prop('disabled', true);
//		$('#jssptpdjspromapannew').prop('disabled', true);
//		$('#jswptpdjspromapannew').prop('disabled', false);	
//		$('#jswpcijspromapannew').prop('disabled', false);
//		
//	}
//	else
//	{
//		
//		document.getElementById("jswptpdjspromapannew").value = 0;
//		$('#jswptpdjspromapannew').trigger('change');
//
//		document.getElementById("jswpcijspromapannew").value = 0;
//		$('#jswpcijspromapannew').trigger('change');
//
//		$('#jswptpdjspromapannew').prop('disabled', true);
//		$('#jswpcijspromapannew').prop('disabled', true);
//		
//		$('#namalengkapcalontertanggung').prop('disabled', false);
//		$('#tanggallahircalontertangggung').prop('disabled', false);
//		$('#jeniskelamincalontertanggung').prop('disabled', false);
//		$('#hubungandenganpempol').prop('disabled', false);
//		document.getElementById("namalengkapcalontertanggung").value = ""; 
//		document.getElementById("tanggallahircalontertangggung").value = ""; 
//		document.getElementById('jeniskelamincalontertanggung').value = "";
//		document.getElementById('hubungandenganpempol').value = "";
//		$('#jeniskelamincalontertanggung').trigger('change');
//		document.getElementById('carabayar').value = " ";
//		$('#carabayar').trigger('change');
//		
//		if (hubungandenganpempol=='1')
//		{
//			$('#hcpjspromapannew').prop('disabled', false);
//			$('#hcpbjspromapannew').prop('disabled', false);
//			$('#jsaddbjspromapannew').prop('disabled', false);	
//			$('#jstpdjspromapannew').prop('disabled', false);
//			
//			$('#ci53jspromapannew').prop('disabled', false);
//			$('#termjspromapannew').prop('disabled', false);
//			$('#jspbdjspromapannew').prop('disabled', false);	
//			$('#jspbtpdjspromapannew').prop('disabled', false);
//			
//			$('#jsspdjspromapannew').prop('disabled', false);
//			$('#jssptpdjspromapannew').prop('disabled', false);
//			$('#jswptpdjspromapannew').prop('disabled', true);	
//			$('#jswpcijspromapannew').prop('disabled', true );	
//			
//			$('#nextBtn').prop('disabled', false);	
//		}
//		else if (hubungandenganpempol=='2')
//		{
//			$('#hcpjspromapannew').prop('disabled', false);
//			$('#hcpbjspromapannew').prop('disabled', false);
//			$('#jsaddbjspromapannew').prop('disabled', false);	
//			$('#jstpdjspromapannew').prop('disabled', false);
//			
//			$('#ci53jspromapannew').prop('disabled', false);
//			$('#termjspromapannew').prop('disabled', false);
//			$('#jspbdjspromapannew').prop('disabled', false);	
//			$('#jspbtpdjspromapannew').prop('disabled', false);
//			
//			$('#jsspdjspromapannew').prop('disabled', false);
//			$('#jssptpdjspromapannew').prop('disabled', false);
//			$('#jswptpdjspromapannew').prop('disabled', true);	
//			$('#jswpcijspromapannew').prop('disabled', true );
//			
//			
//			$('#nextBtn').prop('disabled', false);
//		}
//		
//	}
		
		
//		

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
	
//	JUA MINIMAL 7500000
	$("#uangpertanggungan").change(function() {
		var uangpertanggungan = parseInt(document.getElementById("uangpertanggungan").value);	
		
		var maksimaluangasuransi = parseInt(document.getElementById("maksimaluangasuransi").value);	
		
		var hubungandenganpempol = parseInt(document.getElementById("hubungandenganpempol").value);	
		
		var premiberkala = parseInt(document.getElementById("premiberkala").value);
		
		var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value
		
		
//		if ((maksimaluangasuransi != 0) || (maksimaluangasuransi != ''))
//		{	
		if (carabayarjspromapannew == '1')
		{
			if (uangpertanggungan < (5 * premiberkala * 12))
			{
				
				alert('Premi Minimal 5 x Premi Dasar satu tahun!');
				
				document.getElementById("uangpertanggungan").value = 5 * premiberkala * 12;
				$('#uangpertanggungan').trigger('change');
				
				if (uangpertanggungan < 7500000)
				{
					alert('Premi Minimal 7500000!');
					
					document.getElementById("uangpertanggungan").value = 7500000;
					$('#uangpertanggungan').trigger('change');
				}
				
			}
			else if (uangpertanggungan > maksimaluangasuransi)
			{
				alert('Melebihi Batas Maksimal Uang Asuransi!');
				document.getElementById("uangpertanggungan").value = document.getElementById("maksimaluangasuransi").value;
			}
			else if (uangpertanggungan > 10000000000)
			{
				alert('Maksimal Uang Asuransi 10000000000!');	
			}
			
//			else if ((uangpertanggungan > 500000000) && ((hubungandenganpempol == '1') || (hubungandenganpempol == '2')))
//			{
//				alert('JUA Maksimal 500000000!');
//				document.getElementById("uangpertanggungan").value = 7500000;
////				document.getElementById("maksimaluangasuransi").value = 0;
////				$('#maksimaluangasuransi').trigger('change');
////				document.getElementById("penghasilansatutahun").value = 0;
////				$('#penghasilansatutahun').trigger('change');
		}
		else if (carabayarjspromapannew == '2')
		{
			if (uangpertanggungan < (5 * premiberkala))
			{
				
				alert('Premi Minimal 5 x Premi Dasar satu tahun!');
				
				document.getElementById("uangpertanggungan").value = 5 * premiberkala;
				$('#uangpertanggungan').trigger('change');
				
				if (uangpertanggungan < 7500000)
				{
					alert('Premi Minimal 7500000!');
					
					document.getElementById("uangpertanggungan").value = 7500000;
					$('#uangpertanggungan').trigger('change');
				}
				
			}
			else if (uangpertanggungan > maksimaluangasuransi)
			{
				alert('Melebihi Batas Maksimal Uang Asuransi!');
				document.getElementById("uangpertanggungan").value = document.getElementById("maksimaluangasuransi").value;
			}
			else if (uangpertanggungan > 10000000000)
			{
				alert('Maksimal Uang Asuransi 10000000000!');	
			}
			
//			else if ((uangpertanggungan > 500000000) && ((hubungandenganpempol == '1') || (hubungandenganpempol == '2')))
//			{
//				alert('JUA Maksimal 500000000!');
//				document.getElementById("uangpertanggungan").value = 7500000;
////				document.getElementById("maksimaluangasuransi").value = 0;
////				$('#maksimaluangasuransi').trigger('change');
////				document.getElementById("penghasilansatutahun").value = 0;
////				$('#penghasilansatutahun').trigger('change');
		}
//
//			}
//		}
	});
	
	$("#noktp").change(function() {
		var noktp = document.getElementById("noktp").value;	
		
		if(noktp.length < 16)
		{
			alert('Masukkan No. KTP yang benar (16 Digit)!');
			document.getElementById("noktp").value = '';
		}
		else if(noktp.length > 16)
		{
			alert('Masukkan No. KTP yang benar (16 Digit)!');
			document.getElementById("noktp").value = '';
		}
	});
	
	$("#asumsicutipremi").change(function() {
		var asumsicutipremi = document.getElementById("asumsicutipremi").value;	
		
		var tanggallahircalontertangggung = $("#tanggallahir").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
		var maxasumsicutipremi = (99-usiasekarang);
		
		if(asumsicutipremi > maxasumsicutipremi)
		{
			alert('Asumsi Cuti Premi tidak boleh lebih dari '+maxasumsicutipremi+' tahun!');
			document.getElementById("asumsicutipremi").value = maxasumsicutipremi;
		}
		else if(asumsicutipremi < 5)
		{
			alert('Asumsi Cuti Premi minimal 5 tahun');
			document.getElementById("asumsicutipremi").value = 5;
		}
	});

	$("#usiaproduktif").change(function() {
		var usiaproduktif = parseInt(document.getElementById("usiaproduktif").value);
		var penghasilansatutahun = parseInt(document.getElementById("penghasilansatutahun").value);

		var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
		var hubungandenganpempol =  document.getElementById("hubungandenganpempol").value;

		if (usiaproduktif < usiasekarang)
		{
//			alert('Usia Produktif tidak boleh lebih kecil dari usia sekarang!');
//			document.getElementById("usiaproduktif").value = 0;
			
			var maksimaluangasuransi = ((parseInt(usiasekarang)) * parseInt(penghasilansatutahun));
		}
		else
		{
			var maksimaluangasuransi = ((parseInt(usiaproduktif) - parseInt(usiasekarang)) * parseInt(penghasilansatutahun));
		}
		
		var uangpertanggungan = document.getElementById("uangpertanggungan").value;

		if (parseInt(usiaproduktif) > parseInt(usiasekarang))
		{
			if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
			
				document.getElementById("maksimaluangasuransi").value = maksimaluangasuransi;
			
			}
			else
			{
				if(maksimaluangasuransi > 500000000)
				{
					alert('Maksimal Uang Asuransi 500000000!');
					document.getElementById("maksimaluangasuransi").value = 500000000;
			
				}
				else
				{
					document.getElementById("maksimaluangasuransi").value = maksimaluangasuransi;	
				}
				
			}
		}
//		else if ((uangpertanggungan > 500000000) && ((hubungandenganpempol == '1') || (hubungandenganpempol == '2')))
//		{
//			alert('JUA Maksimal 500000000!');
//			document.getElementById("uangpertanggungan").value = 7500000;
////			document.getElementById("maksimaluangasuransi").value = 0;
////			$('#maksimaluangasuransi').trigger('change');
////			document.getElementById("penghasilansatutahun").value = 0;
////			$('#penghasilansatutahun').trigger('change');
//
//		}
		if (usiaproduktif > 70)
		{
			alert('Usia Produktif maksimal 70 Tahun!');
			document.getElementById("usiaproduktif").value = 70;
			$('#usiaproduktif').trigger('change');
		}

	});

	$("#penghasilansatutahun").change(function() {
		var usiaproduktif = parseInt(document.getElementById("usiaproduktif").value);
		var penghasilansatutahun = parseInt(document.getElementById("penghasilansatutahun").value);

		var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
		
		if (usiaproduktif < usiasekarang)
		{
//			alert('Usia Produktif tidak boleh lebih kecil dari usia sekarang!');
//			document.getElementById("usiaproduktif").value = 0;
			
			var maksimaluangasuransi = ((parseInt(usiasekarang)) * parseInt(penghasilansatutahun));
		}
		else
		{
			var maksimaluangasuransi = ((parseInt(usiaproduktif) - parseInt(usiasekarang)) * parseInt(penghasilansatutahun));
		}

		if (parseInt(usiaproduktif) > parseInt(usiasekarang))
		{
			if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
			
				document.getElementById("maksimaluangasuransi").value = maksimaluangasuransi;
			
			}
			else
			{
				if(maksimaluangasuransi > 500000000)
				{
					alert('Maksimal Uang Asuransi 500000000!');
					document.getElementById("maksimaluangasuransi").value = 500000000;
			
				}
				else
				{
					document.getElementById("maksimaluangasuransi").value = maksimaluangasuransi;	
				}
				
			}
		}
//		else if ((uangpertanggungan > 500000000) && ((hubungandenganpempol == '1') || (hubungandenganpempol == '2')))
//		{
//			alert('JUA Maksimal 500000000!');
//			document.getElementById("uangpertanggungan").value = 7500000;
////				document.getElementById("maksimaluangasuransi").value = 0;
////				$('#maksimaluangasuransi').trigger('change');
////				document.getElementById("penghasilansatutahun").value = 0;
////				$('#penghasilansatutahun').trigger('change');
//
//		}
		if (usiaproduktif > 70)
		{
			alert('Usia Produktif maksimal 60 Tahun!');
			document.getElementById("usiaproduktif").value = 70;
			$('#usiaproduktif').trigger('change');
		}

	});
	
	$("#totalpremi").change(function() {

		var totalpremi =  parseInt(document.getElementById("totalpremi").value);
		
		var premiberkala =  parseInt(document.getElementById("premiberkala").value);   
		var topupberkala =  parseInt(totalpremi * 30/100);
		var topupsekaligus = parseInt(document.getElementById("topupsekaligus").value);
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;
		
		var hubungandenganpempol =  document.getElementById("hubungandenganpempol").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;
		
		var uangpertanggungan = document.getElementById("uangpertanggungan").value;
		
		var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/hitungsaranua');?>",
			data	: "totalpremi="+totalpremi+"&usiasekarang="+usiasekarang+"&carabayarjspromapannew="+carabayarjspromapannew,
			success : function(data) {
//				$("#premihcpjspromapannew").val(data);
				
//				alert(data);
				
//				document.getElementById("saranua").innerHTML = "UA yang dianjurkan: Rp. "+data;
				document.getElementById("uangpertanggungan").value = parseInt(data);
				
//				if ((usiasekarang > 17) && (usiasekarang > 40))
//				{
//					document.getElementById("jsaddbjspromapannew").value = 1;
//					$('#jsaddbjspromapannew').trigger('change');
//					document.getElementById("ci53jspromapannew").value = 1;	
//					$('#ci53jspromapannew').trigger('change');
//					document.getElementById("jswpcijspromapannew").value = 1;
//					$('#jswpcijspromapannew').trigger('change');
//					document.getElementById("jswptpdjspromapannew").value = 1;
//					$('#jswptpdjspromapannew').trigger('change');
//				}
//				else if ((usiasekarang > 41) && (usiasekarang < 49))
//				{
//					document.getElementById("jsaddbjspromapannew").value = 1;
//					$('#jsaddbjspromapannew').trigger('change');
//					document.getElementById("jstpdjspromapannew").value = 1;	
//					$('#jstpdjspromapannew').trigger('change');
//					document.getElementById("jswpcijspromapannew").value = 1;
//					$('#jswpcijspromapannew').trigger('change');
//					document.getElementById("jswptpdjspromapannew").value = 1;
//					$('#jswptpdjspromapannew').trigger('change');
//				}
//				else if ((usiasekarang > 50) && (usiasekarang < 64))
//				{
//					document.getElementById("jstpdjspromapannew").value = 1;
//					$('#jstpdjspromapannew').trigger('change');
//					document.getElementById("jswpcijspromapannew").value = 1;
//					$('#jswpcijspromapannew').trigger('change');
//					document.getElementById("jswptpdjspromapannew").value = 1;	
//					$('#jswptpdjspromapannew').trigger('change');
//				}
//				else 
//				{
//					document.getElementById("jstpdjspromapannew").value = 0;
//					$('#jstpdjspromapannew').trigger('change');
//					document.getElementById("jswpcijspromapannew").value = 0;
//					$('#jswpcijspromapannew').trigger('change');
//					document.getElementById("jswptpdjspromapannew").value = 0;	
//					$('#jswptpdjspromapannew').trigger('change');
//					document.getElementById("jsaddbjspromapannew").value = 0;
//					$('#jsaddbjspromapannew').trigger('change');
//					document.getElementById("ci53jspromapannew").value = 0;	
//					$('#ci53jspromapannew').trigger('change');
//				}
				
			}
		});
//		
		if (carabayarjspromapannew == '1')
		{
//			if (premiberkala > parseInt(70/100 * document.getElementById("totalpremi").value))
//			{	
//				alert('Premi Berkala maksimal '+(70/100 * document.getElementById("totalpremi").value));
//				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
////				$('#totalpremi').trigger('change');
//				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
//				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
////				$('#premiberkala').trigger('change');
//			}
//			if (topupberkala < 30/100 * document.getElementById("totalpremi").value)
//			{
//				alert('Top Up Berkala minimal '+(30/100 * document.getElementById("totalpremi").value));
//				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
////				$('#totalpremi').trigger('change');
//				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
//				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
////				$('#topupberkala').trigger('change');
//			}
			if (premiberkala < 245000)
			{	
				alert('Premi Berkala minimal 245000!');
				document.getElementById("premiberkala").value = 245000;
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
//				$('#premiberkala').trigger('change');
			}
			if (totalpremi < 350000)
			{
				alert('Total Premi minimal 350000');
				document.getElementById("totalpremi").value = 350000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
			}
			else
			{
				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
				
				document.getElementById("minimalpremiberkala").textContent = 70/100 * document.getElementById("totalpremi").value+" per Bulan";
				document.getElementById("minimaltopupberkala").textContent = 30/100 * document.getElementById("totalpremi").value+" per Bulan";
//				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}		
		}
		else if (carabayarjspromapannew == '2')
		{
//			if (premiberkala > (70/100 * document.getElementById("totalpremi").value))
//			{	
//				alert('Premi Berkala maksimal '+(70/100 * document.getElementById("totalpremi").value));
//				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
////				$('#totalpremi').trigger('change');
//				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
//				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
////				$('#premiberkala').trigger('change');
//			}
//			if (topupberkala < 30/100 * document.getElementById("totalpremi").value)
//			{
//				alert('Top Up Berkala minimal '+(30/100 * document.getElementById("totalpremi").value));
//				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
////				$('#totalpremi').trigger('change');
//				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
//				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
////				$('#topupberkala').trigger('change');
//			}
			if (premiberkala < 2940000)
			{	
				alert('Premi Berkala minimal 2940000!');
				document.getElementById("premiberkala").value = 2940000;
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
//				$('#premiberkala').trigger('change');
			}
			if (totalpremi < 4200000)
			{
				alert('Total Premi minimal 4200000');
				document.getElementById("totalpremi").value = 4200000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = parseInt(70/100 * document.getElementById("totalpremi").value);
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
			}
			else
			{
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
				document.getElementById("premiberkala").value = parseInt(70/100 * document.getElementById("totalpremi").value);
				
				document.getElementById("minimalpremiberkala").textContent = 70/100 * document.getElementById("totalpremi").value+" per Tahun";
				document.getElementById("minimaltopupberkala").textContent = 30/100 * document.getElementById("totalpremi").value+" per Tahun";
//				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}	
		}
	
//		document.getElementById("totalpremi").value = ((totalpremi - document.getElementById("premiberkala").value) / 30/100);
	});

	$("#premiberkala").change(function() {
		
		var totalpremi =  parseInt(document.getElementById("totalpremi").value);
		var premiberkala =  parseInt(document.getElementById("premiberkala").value);   
		var topupberkala =  parseInt(totalpremi * 30/100);
		var topupsekaligus = parseInt(document.getElementById("topupsekaligus").value);
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;
//		
		if (carabayarjspromapannew == '1')
		{
			if (premiberkala < 245000)
			{	
				alert('Premi Berkala minimal 245000!');
				document.getElementById("premiberkala").value = 245000;
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
//				$('#premiberkala').trigger('change');
			}
			if (premiberkala > (70/100 * document.getElementById("totalpremi").value))
			{	
				alert('Premi Berkala maksimal '+(70/100 * document.getElementById("totalpremi").value));
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = parseInt(70/100 * document.getElementById("totalpremi").value);
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
//				$('#premiberkala').trigger('change');
			}
			if (topupberkala < (30/100 * document.getElementById("totalpremi").value))
			{
				alert('Top Up Berkala minimal '+(30/100 * document.getElementById("totalpremi").value));
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
				document.getElementById("premiberkala").value = parseInt(70/100 * document.getElementById("totalpremi").value);
//				$('#topupberkala').trigger('change');
			}
			if (totalpremi < 350000)
			{
				alert('Total Premi minimal 350000');
				document.getElementById("totalpremi").value = 350000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = parseInt(70/100 * document.getElementById("totalpremi").value);
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
			}
			else
			{
				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value);
//				document.getElementById("totalpremi").value = (30/100 * document.getElementById("totalpremi").value);
//				alert(document.getElementById("topupberkala").value);
				
				document.getElementById("minimalpremiberkala").textContent = 70/100 * document.getElementById("totalpremi").value+" per Bulan";
				document.getElementById("minimaltopupberkala").textContent = 30/100 * document.getElementById("totalpremi").value+" per Bulan";
//				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}		
		}
		else if (carabayarjspromapannew == '2')
		{
			if (premiberkala < 2940000)
			{	
				alert('Premi Berkala minimal 2940000!');
				document.getElementById("premiberkala").value = 2940000;
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = parseInt(30/100 * document.getElementById("totalpremi").value);
//				$('#premiberkala').trigger('change');
			}
			if (premiberkala > (70/100 * document.getElementById("totalpremi").value))
			{	
				alert('Premi Berkala maksimal '+(70/100 * document.getElementById("totalpremi").value));
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
//				$('#premiberkala').trigger('change');
			}
			if (topupberkala < 30/100 * document.getElementById("totalpremi").value)
			{
				alert('Top Up Berkala minimal '+(30/100 * document.getElementById("totalpremi").value));
				document.getElementById("totalpremi").value = ((70/100 * document.getElementById("totalpremi").value)+(30/100 * document.getElementById("totalpremi").value));
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
//				$('#topupberkala').trigger('change');
			}
			if (totalpremi < 4200000)
			{
				alert('Total Premi minimal 4200000');
				document.getElementById("totalpremi").value = 4200000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = (70/100 * document.getElementById("totalpremi").value);
				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
			}
			else
			{
				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value);
//				document.getElementById("topupberkala").value = (30/100 * document.getElementById("totalpremi").value);
				
				document.getElementById("minimalpremiberkala").textContent = 70/100 * document.getElementById("totalpremi").value+" per Tahun";
				document.getElementById("minimaltopupberkala").textContent = 30/100 * document.getElementById("totalpremi").value+" per Tahun";
//				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}	
		}
		
	});

	$("#topupberkala").change(function() {
//		var totalpremi =  parseInt(document.getElementById("totalpremi").value);
//		var premiberkala =  parseInt(document.getElementById("premiberkala").value);   
//		var topupberkala =  parseInt(totalpremi * 30/100);
//		var topupsekaligus = parseInt(document.getElementById("topupsekaligus").value);
//		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;	
//		
//		if (carabayarjspromapannew == '1')
//		{
//			if (premiberkala < 350000)
//			{	
//				alert('Premi Berkala minimal 350000!');
//				document.getElementById("totalpremi").value = 500000;
////				$('#totalpremi').trigger('change');
//				document.getElementById("premiberkala").value = 350000;
////				$('#premiberkala').trigger('change');
//				document.getElementById("topupberkala").value = (parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value));
//				
//			}
//			if (topupberkala < 150000)
//			{
//				alert('Top Up Berkala minimal 150000!');
//				document.getElementById("totalpremi").value = 500000;
////				$('#totalpremi').trigger('change');
//				document.getElementById("topupberkala").value = 150000;
//				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
////				$('#topupberkala').trigger('change');
//			}
//			if (totalpremi < 500000)
//			{
//				alert('Total Premi minimal 500000!');
//				document.getElementById("totalpremi").value = 500000;
////				$('#totalpremi').trigger('change');
//				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//				document.getElementById("topupberkala").value = (parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value));
//			}
//			else
//			{
//				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//				document.getElementById("totalpremi").value = parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value) + parseInt(document.getElementById("topupsekaligus").value);
//			}		
//		}
//		else if (carabayarjspromapannew == '2')
//		{
//			if (premiberkala < 4200000)
//			{	
//				alert('Premi Berkala minimal 4200000!');
//				document.getElementById("totalpremi").value = 6000000;
////				$('#totalpremi').trigger('change');
//				document.getElementById("premiberkala").value = 4200000;
//				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//			}
//			if (topupberkala < 1800000)
//			{
//				alert('Top Berkala minimal 1800000!');
//				document.getElementById("totalpremi").value = 6000000;
////				$('#totalpremi').trigger('change');
//				document.getElementById("topupberkala").value = 1800000;
//				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//			}
//			if (totalpremi < 6000000)
//			{
//				alert('Total Premi minimal 6000000!');
//				document.getElementById("totalpremi").value = 6000000;
////				$('#totalpremi').trigger('change');
//				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//			}
//			else
//			{
//				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//				document.getElementById("totalpremi").value = parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value) + parseInt(document.getElementById("topupsekaligus").value);
//			}	
//		}
	});

	$("#topupsekaligus").change(function() {
//		var totalpremi =  parseInt(document.getElementById("totalpremi").value);
		var premiberkala =  parseInt(document.getElementById("premiberkala").value);   
		var topupberkala =  parseInt(totalpremi * 30/100);
		var topupsekaligus = parseInt(document.getElementById("topupsekaligus").value);
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;	
		
		if (carabayarjspromapannew == '1')
		{
			if (premiberkala < 245000)
			{	
				alert('Premi Berkala minimal 245000!');
				document.getElementById("totalpremi").value = 350000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = 245000;
//				$('#premiberkala').trigger('change');
				document.getElementById("topupberkala").value = (parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value));
				
			}
			if (topupberkala < 105000)
			{
				alert('Top Up Berkala minimal 105000!');
				document.getElementById("totalpremi").value = 350000;
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = 105000;
				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
//				$('#topupberkala').trigger('change');
			}
			if (totalpremi < 350000)
			{
				alert('Total Premi minimal 350000!');
				document.getElementById("totalpremi").value = 350000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
				document.getElementById("topupberkala").value = (parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value));
			}
			else
			{
				document.getElementById("totalpremi").value = parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value) + parseInt(document.getElementById("topupsekaligus").value);
			}		
		}
		else if (carabayarjspromapannew == '2')
		{
			if (premiberkala < 2940000)
			{	
				alert('Premi Berkala minimal 2940000!');
				document.getElementById("totalpremi").value = 4200000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = 2940000;
				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}
			if (topupberkala < 1260000)
			{
				alert('Top Berkala minimal 1260000!');
				document.getElementById("totalpremi").value = 4200000;
//				$('#totalpremi').trigger('change');
				document.getElementById("topupberkala").value = 1260000;
				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}
			if (totalpremi < 4200000)
			{
				alert('Total Premi minimal 4200000!');
				document.getElementById("totalpremi").value = 4200000;
//				$('#totalpremi').trigger('change');
				document.getElementById("premiberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("topupberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
				document.getElementById("topupberkala").value = parseInt(document.getElementById("totalpremi").value) - parseInt(document.getElementById("premiberkala").value) - parseInt(document.getElementById("topupsekaligus").value);
			}
			else
			{
				document.getElementById("totalpremi").value = parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value) + parseInt(document.getElementById("topupsekaligus").value);
			}	
		}

	});


	$("#carabayarjspromapannew").change(function() {

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();
		var minimalpremiberkala = document.getElementById("minimalpremiberkala");
		var minimaltopupberkala = document.getElementById("minimaltopupberkala");
		if (carabayarjspromapannew == '1')
		{	
			
			minimalpremiberkala.textContent = "245.000 per Bulan";
			minimaltopupberkala.textContent = "105.000 per Bulan";
			var premiberkala = 245000;
			var topupberkala = 105000;
			var topupsekaligus = document.getElementById("topupsekaligus").value;
			
			document.getElementById("premiberkala").value = premiberkala;
			document.getElementById("topupberkala").value = topupberkala;
//			$('#premiberkala').trigger('change');
//			$('#topupberkala').trigger('change');
			
			document.getElementById("totalpremi").value = parseInt(premiberkala)+parseInt(topupberkala)+parseInt(topupsekaligus);
		}
		else if (carabayarjspromapannew == '2')
		{
			minimalpremiberkala.textContent = "2.940.000 per Tahun";
			minimaltopupberkala.textContent = "1.260.000 per Tahun";
			var premiberkala = 2940000;
			var topupberkala = 1260000;	
			var topupsekaligus = document.getElementById("topupsekaligus").value;
			
			document.getElementById("premiberkala").value = premiberkala;
			document.getElementById("topupberkala").value = topupberkala;
//			$('#premiberkala').trigger('change');
//			$('#topupberkala').trigger('change');
			
			document.getElementById("totalpremi").value = parseInt(premiberkala)+parseInt(topupberkala)+parseInt(topupsekaligus);
		}

		
	});
	
	$("#hcpjspromapannew").change(function() {
		var hcpjspromapannew = document.getElementById("hcpjspromapannew").value;

		if (hcpjspromapannew == '1')
		{
			$('#uangasuransihcpjspromapannew').prop('disabled', false);
			$('#hcpbjspromapannew').prop('disabled', false);
		}
		else if (hcpjspromapannew == '0')
		{
			$('#uangasuransihcpjspromapannew').prop('disabled', true);
			$('#hcpbjspromapannew').prop('disabled', true);

			document.getElementById("uangasuransihcpjspromapannew").value = 0;
			$('#uangasuransihcpjspromapannew').trigger('change');

			document.getElementById("hcpbjspromapannew").value = 0;
			$('#hcpbjspromapannew').trigger('change');

		}

	});

	$("#hcpbjspromapannew").change(function() {
		var hcpbjspromapannew = document.getElementById("hcpbjspromapannew").value;

		if (hcpbjspromapannew == '1')
		{
			document.getElementById("uangasuransihcpbjspromapannew").value = document.getElementById("uangasuransihcpjspromapannew").value; 
			$('#uangasuransihcpbjspromapannew').trigger('change');
		}
		else if (hcpbjspromapannew == '0')
		{
			document.getElementById("uangasuransihcpbjspromapannew").value = 0;
			$('#uangasuransihcpbjspromapannew').trigger('change');
		}

	});

	$("#jspbdjspromapannew").change(function() {
		var jspbdjspromapannew = document.getElementById("jspbdjspromapannew").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();

		if (jspbdjspromapannew == '1')
		{
			if (carabayarjspromapannew == "Bulanan")
			{	
				document.getElementById("uangasuransijspbdjspromapannew").value = document.getElementById("premiberkala").value * 12;		
			}
			else if (carabayarjspromapannew == "Kuartalan")
			{	
				document.getElementById("uangasuransijspbdjspromapannew").value = document.getElementById("premiberkala").value * 4;
			}
			else if (carabayarjspromapannew == "Semesteran")
			{	
				document.getElementById("uangasuransijspbdjspromapannew").value = document.getElementById("premiberkala").value * 2;
			}
			else if (carabayarjspromapannew == "Tahunan")
			{	
				document.getElementById("uangasuransijspbdjspromapannew").value = document.getElementById("premiberkala").value * 1;
			}
			else if (carabayarjspromapannew == "Sekaligus")
			{	
				document.getElementById("uangasuransijspbdjspromapannew").value = document.getElementById("premiberkala").value * 1;
			}
		}
		else if (jspbdjspromapannew == '0')
		{
			document.getElementById("uangasuransijspbdjspromapannew").value = 0;
			$('#uangasuransijspbdjspromapannew').trigger('change');	
		}

	});

	$("#jspbtpdjspromapannew").change(function() {
		var jspbtpdjspromapannew = document.getElementById("jspbtpdjspromapannew").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();

		if (jspbtpdjspromapannew == '1')
		{
			if (carabayarjspromapannew == "Bulanan")
			{	
				document.getElementById("uangasuransijspbtpdjspromapannew").value = document.getElementById("premiberkala").value * 12;		
			}   
			else if (carabayarjspromapannew == "Kuartalan")
			{	
				document.getElementById("uangasuransijspbtpdjspromapannew").value = document.getElementById("premiberkala").value * 4;
			}
			else if (carabayarjspromapannew == "Semesteran")
			{	
				document.getElementById("uangasuransijspbtpdjspromapannew").value = document.getElementById("premiberkala").value * 2;
			}
			else if (carabayarjspromapannew == "Tahunan")
			{	
				document.getElementById("uangasuransijspbtpdjspromapannew").value = document.getElementById("premiberkala").value * 1;
			}
			else if (carabayarjspromapannew == "Sekaligus")
			{	
				document.getElementById("uangasuransijspbtpdjspromapannew").value = document.getElementById("premiberkala").value * 1;
			}
		}
		else if (jspbtpdjspromapannew == '0')
		{
			document.getElementById("uangasuransijspbtpdjspromapannew").value = 0;
			$('#uangasuransijspbtpdjspromapannew').trigger('change');
		}

	});


	$("#uangasuransihcpjspromapannew").change(function() {
		
		var uangasuransihcpjspromapannew = document.getElementById("uangasuransihcpjspromapannew").value;

		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/hitungjshcppromapannew');?>",
			data	: "uangasuransihcpjspromapannew="+uangasuransihcpjspromapannew+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
			success : function(data) {
				$("#premihcpjspromapannew").val(data);
				
//				alert(data);

			}
		});	

//		var hcpbjspromapannew = document.getElementById("hcpbjspromapannew").value;
//
//		if (hcpbjspromapannew == '1')
//		{
//			document.getElementById("uangasuransihcpbjspromapannew").value = document.getElementById("uangasuransihcpjspromapannew").value; 
//			$('#uangasuransihcpbjspromapannew').trigger('change');
//		}
//		else if (hcpbjspromapannew == '0')
//		{
//			document.getElementById("uangasuransihcpbjspromapannew").value = 0;
//			$('#uangasuransihcpbjspromapannew').trigger('change');
//		}

	});

	$("#uangasuransihcpbjspromapannew").change(function() {
		var uangasuransihcpbjspromapannew = document.getElementById("uangasuransihcpbjspromapannew").value;

		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/hitungjshcpbpromapannew');?>",
			data	: "uangasuransihcpbjspromapannew="+uangasuransihcpbjspromapannew+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
			success : function(data) {
				$("#premihcpbjspromapannew").val(data);

			}
		});	

	});

	$("#jstpdjspromapannew").change(function() {
		var jstpdjspromapannew = document.getElementById("jstpdjspromapannew").value;

		if (jstpdjspromapannew == '1')
		{
			document.getElementById("uangasuransijstpdjspromapannew").disabled = false;	
			document.getElementById("uangasuransijstpdjspromapannew").value = document.getElementById("uangpertanggungan").value;
			
			if ((document.getElementById("uangasuransijstpdjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijstpdjspromapannew").value > 1500000000))
			{
				alert('JUA JS TPD Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransijstpdjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransijstpdjspromapannew").value < 0)
			{
				alert('JUA JS TPD Minimal 0');
				document.getElementById("uangasuransijstpdjspromapannew").value = 0;	
			}
		}
		else if (jstpdjspromapannew == '0')
		{
			document.getElementById("uangasuransijstpdjspromapannew").disabled = true;
			document.getElementById("premijstpdjspromapannew").value = 0;	
			document.getElementById("uangasuransijstpdjspromapannew").value = 0;		
		}
		

	});

	$("#wpjspromapannew").change(function() {
		var wpjspromapannew = document.getElementById("wpjspromapannew").value;

		if (wpjspromapannew == '1')
		{

			var masaasuransi = document.getElementById("masaasuransi").value;

			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			var carabayarjspromapannew = $("#carabayarjspromapannew").val();

			var birthday = +new Date(document.getElementById("lahirnasabah").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);

			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapannew/hitungjswppromapannew');?>",
				data	: "usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&carabayarjspromapannew="+carabayarjspromapannew,
				success : function(data) {
					$("#premiwpjspromapannew").val(data);

					document.getElementById("totalpremiriderjspromapannew2").value = Math.round(parseInt(document.getElementById("premijstpdjspromapannew").value) + parseInt(document.getElementById("premiwpjspromapannew").value) + parseInt(document.getElementById("premici53jspromapannew").value) + parseInt(document.getElementById("premijsaddbjspromapannew").value) + parseInt(document.getElementById("premijsspdjspromapannew").value) + parseInt(document.getElementById("premijssptpdjspromapannew").value) + parseInt(document.getElementById("premitermjspromapannew").value)); 

					document.getElementById("totalpremiriderjspromapannewsum").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannew1").value) + parseInt(document.getElementById("totalpremiriderjspromapannew2").value)); 

					document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value));

					document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value*0.52));

					document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value*0.27));

					document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjspromapannewsum").value*0.095);

					document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
					document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));

					document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));

					document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));

				}
			});				
		}
		else if (wpjspromapannew == '0')
		{
			document.getElementById("premiwpjspromapannew").value = 0;	
			document.getElementById("uangasuransiwpjspromapannew").value = 0;	
		}

	});

	$("#ci53jspromapannew").change(function() {
		var ci53jspromapannew = document.getElementById("ci53jspromapannew").value;

		if (ci53jspromapannew == '1')
		{
			document.getElementById("uangasuransici53jspromapannew").disabled = false;
			document.getElementById("uangasuransici53jspromapannew").value = document.getElementById("uangpertanggungan").value;
			
			if ((document.getElementById("uangasuransici53jspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransici53jspromapannew").value > 1500000000))
			{
				alert('JUA CI 53 Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransici53jspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransici53jspromapannew").value < 0)
			{
				alert('JUA CI 53 Minimal 0');
				document.getElementById("uangasuransici53jspromapannew").value = 0;	
			}
		}
		else if (ci53jspromapannew == '0')
		{
			document.getElementById("uangasuransici53jspromapannew").disabled = true;
			document.getElementById("premici53jspromapannew").value = 0;
			document.getElementById("uangasuransici53jspromapannew").value = 0;	
		}
		

	});

	$("#jsaddbjspromapannew").change(function() {
		var jsaddbjspromapannew = document.getElementById("jsaddbjspromapannew").value;

		if (jsaddbjspromapannew == '1')
		{
			document.getElementById("uangasuransijsaddbjspromapannew").value = document.getElementById("uangpertanggungan").value;
			document.getElementById("uangasuransijsaddbjspromapannew").disabled = false;
			
			if ((document.getElementById("uangasuransijsaddbjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijsaddbjspromapannew").value > 500000000))
			{
				alert('JUA JS ADDB Maksimal 3 kali UA atau 500000000!');
				document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransijsaddbjspromapannew").value < 0)
			{
				alert('JUA JS ADDB Minimal 0');
				document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
			}
		}
		else if (jsaddbjspromapannew == '0')
		{
			document.getElementById("uangasuransijsaddbjspromapannew").disabled = true;	
			document.getElementById("premijsaddbjspromapannew").value = 0;
			document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
		}
		

	});
	
	$("#jspbdjspromapannew").change(function() {
		var jspbdjspromapannew = document.getElementById("jspbdjspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;

		if (jspbdjspromapannew == '1')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', false);
			
			if (carabayarjspromapannew == '1')
			{
				if ((document.getElementById("uangasuransijspbdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijspbdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));
				}
				else
				{
					document.getElementById("uangasuransijspbdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));	
				}

			}
			else if (carabayarjspromapannew == '2')
			{
				if ((document.getElementById("uangasuransijspbdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijspbdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));	
				}
				else
				{
					document.getElementById("uangasuransijspbdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));
				}

			}
			
		}
		else if (jspbdjspromapannew == '0')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijspbdjspromapannew").value = 0;
			document.getElementById("uangasuransijspbdjspromapannew").value = 0;	
		}
		else
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijspbdjspromapannew").value = 0;
			document.getElementById("uangasuransijspbdjspromapannew").value = 0;		
		}

	});
	
	$("#jspbtpdjspromapannew").change(function() {
		var jspbtpdjspromapannew = document.getElementById("jspbtpdjspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;

		if (jspbtpdjspromapannew == '1')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', false);
			
			if (carabayarjspromapannew == '1')
			{
				if ((document.getElementById("uangasuransijspbtpdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijspbtpdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));
				}
				else
				{
					document.getElementById("uangasuransijspbtpdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));	
				}

			}
			else if (carabayarjspromapannew == '2')
			{
				if ((document.getElementById("uangasuransijspbtpdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijspbtpdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));	
				}
				else
				{
					document.getElementById("uangasuransijspbtpdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));
				}

			}
			
		}
		else if (jspbtpdjspromapannew == '0')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijspbtpdjspromapannew").value = 0;
			document.getElementById("uangasuransijspbtpdjspromapannew").value = 0;	
		}
		else
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijspbtpdjspromapannew").value = 0;
			document.getElementById("uangasuransijspbtpdjspromapannew").value = 0;		
		}

	});
	
	$("#jsspdjspromapannew").change(function() {
		var jsspdjspromapannew = document.getElementById("jsspdjspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;

		if (jsspdjspromapannew == '1')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', false);
			
			if (carabayarjspromapannew == '1')
			{
				if ((document.getElementById("uangasuransijsspdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijsspdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));
				}
				else
				{
					document.getElementById("uangasuransijsspdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));	
				}

			}
			else if (carabayarjspromapannew == '2')
			{
				if ((document.getElementById("uangasuransijsspdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijsspdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));	
				}
				else
				{
					document.getElementById("uangasuransijsspdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));
				}

			}
			
		}
		else if (jsspdjspromapannew == '0')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijsspdjspromapannew").value = 0;
			document.getElementById("uangasuransijsspdjspromapannew").value = 0;	
		}
		else
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijsspdjspromapannew").value = 0;
			document.getElementById("uangasuransijsspdjspromapannew").value = 0;		
		}
		
	});
	
	$("#jssptpdjspromapannew").change(function() {
		var jssptpdjspromapannew = document.getElementById("jssptpdjspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;

		if (jssptpdjspromapannew == '1')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', false);
			
			if (carabayarjspromapannew == '1')
			{
				if ((document.getElementById("uangasuransijssptpdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijssptpdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));
				}
				else
				{
					document.getElementById("uangasuransijssptpdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value));	
				}

			}
			else if (carabayarjspromapannew == '2')
			{
				if ((document.getElementById("uangasuransijssptpdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijssptpdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));	
				}
				else
				{
					document.getElementById("uangasuransijssptpdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value));
				}

			}
			
		}
		else if (jssptpdjspromapannew == '0')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijssptpdjspromapannew").value = 0;
			document.getElementById("uangasuransijssptpdjspromapannew").value = 0;	
		}
		else
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijssptpdjspromapannew").value = 0;
			document.getElementById("uangasuransijssptpdjspromapannew").value = 0;		
		}

	});
	
	
	$("#jswptpdjspromapannew").change(function() {
		var jswptpdjspromapannew = document.getElementById("jswptpdjspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;

		if (jswptpdjspromapannew == '1')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', false);
			
			if (carabayarjspromapannew == '1')
			{
				if ((document.getElementById("uangasuransijswptpdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijswptpdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));
				}
				else
				{
					document.getElementById("uangasuransijswptpdjspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));	
				}

			}
			else if (carabayarjspromapannew == '2')
			{
				if ((document.getElementById("uangasuransijswptpdjspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijswptpdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));	
				}
				else
				{
					document.getElementById("uangasuransijswptpdjspromapannew").value = (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));
				}

			}
			
		}
		else if (jswptpdjspromapannew == '0')
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijswptpdjspromapannew").value = 0;
			document.getElementById("uangasuransijswptpdjspromapannew").value = 0;	
		}
		else
		{
//			$('#uangasuransijswptpdjspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijswptpdjspromapannew").value = 0;
			document.getElementById("uangasuransijswptpdjspromapannew").value = 0;		
		}

	});
	
	$("#jswpcijspromapannew").change(function() {
		var jswpcijspromapannew = document.getElementById("jswpcijspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;

		if (jswpcijspromapannew == '1')
		{
//			$('#uangasuransijswpcijspromapannew').prop('disabled', false);
			
			if (carabayarjspromapannew == '1')
			{
				if ((document.getElementById("uangasuransijswpcijspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijswpcijspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));
				}
				else
				{
					document.getElementById("uangasuransijswpcijspromapannew").value = 12 * (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));	
				}

			}
			else if (carabayarjspromapannew == '2')
			{
				if ((document.getElementById("uangasuransijswpcijspromapannew").value > 1500000000))
				{
					alert('Maksimal 1500000000!');
					document.getElementById("uangasuransijswpcijspromapannew").value = (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));	
				}
				else
				{
					document.getElementById("uangasuransijswpcijspromapannew").value = (parseInt(document.getElementById("premiberkala").value) + parseInt(document.getElementById("topupberkala").value));	
				}

			}
			
		}
		else if (jswpcijspromapannew == '0')
		{
//			$('#uangasuransijswpcijspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijswpcijspromapannew").value = 0;
			document.getElementById("uangasuransijswpcijspromapannew").value = 0;	
		}
		else
		{
//			$('#uangasuransijswpcijspromapannew').prop('disabled', true);
			
//			document.getElementById("uangasuransijswptpdjspromapannew").disabled = true;	
			document.getElementById("premijswpcijspromapannew").value = 0;
			document.getElementById("uangasuransijswpcijspromapannew").value = 0;		
		}

	});
	
	$("#jsadbjspromapannew").change(function() {
		var jsadbjspromapannew = document.getElementById("jsadbjspromapannew").value;

		if (jsadbjspromapannew == '1')
		{
			document.getElementById("uangasuransijsadbjspromapannew").value = document.getElementById("uangpertanggungan").value;
			document.getElementById("uangasuransijsadbjspromapannew").disabled = false;
			
			if ((document.getElementById("uangasuransijsadbjspromapannew").value > (2*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijsadbjspromapannew").value > 500000000))
			{
				alert('JUA JS ADB Maksimal 2 kali UA atau 500000000!');
				document.getElementById("uangasuransijsadbjspromapannew").value = 20/100*document.getElementById("uangpertanggungan").value;	
			}
			else if (document.getElementById("uangasuransijsadbjspromapannew").value < 20/100*document.getElementById("uangpertanggungan").value)
			{
				alert('JUA JS ADB Minimal 20% x uang Asuransi Dasar');
				document.getElementById("uangasuransijsadbjspromapannew").value = 20/100*document.getElementById("uangpertanggungan").value;	
			}
		}
		else if (jsadbjspromapannew == '0')
		{
			document.getElementById("uangasuransijsadbjspromapannew").disabled = true;	
			document.getElementById("premijsadbjspromapannew").value = 0;
			document.getElementById("uangasuransijsadbjspromapannew").value = 0;	
		}
		

	});

	$("#jsspdjspromapannew").change(function() {
		var jsspdjspromapannew = document.getElementById("jsspdjspromapannew").value;

		if (jsspdjspromapannew == '1')
		{
			var masaasuransi = document.getElementById("masaasuransi").value;

			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			var carabayarjspromapannew = $("#carabayarjspromapannew").val();

			var birthday = +new Date(document.getElementById("lahirnasabah").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);

			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew/hitungjsspdpromapannew');?>",
						data	: "usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
						success : function(data) {
							$("#premijsspdjspromapannew").val(data);

							document.getElementById("totalpremiriderjspromapannew2").value = Math.round(parseInt(document.getElementById("premijstpdjspromapannew").value) + parseInt(document.getElementById("premiwpjspromapannew").value) + parseInt(document.getElementById("premici53jspromapannew").value) + parseInt(document.getElementById("premijsaddbjspromapannew").value) + parseInt(document.getElementById("premijsspdjspromapannew").value) + parseInt(document.getElementById("premijssptpdjspromapannew").value) + parseInt(document.getElementById("premitermjspromapannew").value)); 

							document.getElementById("totalpremiriderjspromapannewsum").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannew1").value) + parseInt(document.getElementById("totalpremiriderjspromapannew2").value)); 

							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value));

							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value*0.52));

							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value*0.27));

							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjspromapannewsum").value*0.095);

							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));

							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));

							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});	
		}
		else if (jsspdjspromapannew == '0')
		{

			document.getElementById("premijsspdjspromapannew").value = 0;	
			document.getElementById("uangasuransijsspdjspromapannew").value = 0;	
		}

	});

	$("#jssptpdjspromapannew").change(function() {
		var jssptpdjspromapannew = document.getElementById("jssptpdjspromapannew").value;

		if (jssptpdjspromapannew == '1')
		{

			var masaasuransi = document.getElementById("masaasuransi").value;

			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			var carabayarjspromapannew = $("#carabayarjspromapannew").val();

			var birthday = +new Date(document.getElementById("lahirnasabah").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);

			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapannew/hitungjssptpdpromapannew');?>",
						data	: "usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
						success : function(data) {
							$("#premijssptpdjspromapannew").val(data);

							document.getElementById("totalpremiriderjspromapannew2").value = Math.round(parseInt(document.getElementById("premijstpdjspromapannew").value) + parseInt(document.getElementById("premiwpjspromapannew").value) + parseInt(document.getElementById("premici53jspromapannew").value) + parseInt(document.getElementById("premijsaddbjspromapannew").value) + parseInt(document.getElementById("premijsspdjspromapannew").value) + parseInt(document.getElementById("premijssptpdjspromapannew").value) + parseInt(document.getElementById("premitermjspromapannew").value)); 

							document.getElementById("totalpremiriderjspromapannewsum").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannew1").value) + parseInt(document.getElementById("totalpremiriderjspromapannew2").value)); 

							document.getElementById("tabelridertahunan").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value));

							document.getElementById("tabelridersemesteran").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value*0.52));

							document.getElementById("tabelriderkuartalan").value = Math.round(parseInt(document.getElementById("totalpremiriderjspromapannewsum").value*0.27));

							document.getElementById("tabelriderbulanan").value = Math.round(document.getElementById("totalpremiriderjspromapannewsum").value*0.095);

							document.getElementById("tabelriderpremitahunan").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunpertama").value) + parseInt(document.getElementById("tabelridertahunan").value));
							document.getElementById("tabelriderpremisemesteran").value = Math.round(parseInt(document.getElementById("tabelpremi5tahunberikutnya").value) + parseInt(document.getElementById("tabelridersemesteran").value));

							document.getElementById("tabelriderpremikuartalan").value = Math.round(parseInt(document.getElementById("tabelpremikuartalan").value) + parseInt(document.getElementById("tabelriderkuartalan").value));

							document.getElementById("tabelriderpremibulanan").value = Math.round(parseInt(document.getElementById("tabelpremibulanan").value) + parseInt(document.getElementById("tabelriderbulanan").value));
						}
					});		
		}
		else if (jssptpdjspromapannew == '0')
		{

			document.getElementById("premijssptpdjspromapannew").value = 0;	
			document.getElementById("uangasuransijssptpdjspromapannew").value = 0;	
		}

	});

	$("#termjspromapannew").change(function() {
		var termjspromapannew = document.getElementById("termjspromapannew").value;

		if (termjspromapannew == '1')
		{
			document.getElementById("uangasuransitermjspromapannew").disabled = false;	
			document.getElementById("uangasuransitermjspromapannew").value = document.getElementById("uangpertanggungan").value;	
			
			if ((document.getElementById("uangasuransitermjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransitermjspromapannew").value > 1500000000))
			{
				alert('JUA JS Term Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransitermjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransitermjspromapannew").value < 0)
			{
				alert('JUA JS Term Minimal 0');
				document.getElementById("uangasuransitermjspromapannew").value = 0;	
			}
		}
		else if (termjspromapannew == '0')
		{
			document.getElementById("uangasuransitermjspromapannew").disabled = true;
			document.getElementById("premitermjspromapannew").value = 0;
			document.getElementById("uangasuransitermjspromapannew").value = 0;		
		}
		

	});

	$("#uangasuransijstpdjspromapannew").change(function() {
		var uangasuransijstpdjspromapannew = document.getElementById("uangasuransijstpdjspromapannew").value;

		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();
		
		var maksimaluatpd = 3 * document.getElementById("uangpertanggungan").value;
		
		if (carabayarjspromapannew == '1')
		{
			if ((document.getElementById("uangasuransijstpdjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijstpdjspromapannew").value > 1500000000))
			{
				alert('JUA TPD Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransijstpdjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransijstpdjspromapannew").value < 0)
			{
				alert('JUA TPD Minimal 0');
				document.getElementById("uangasuransijstpdjspromapannew").value = 0;	
			}
			
		}
		else if (carabayarjspromapannew == '2')
		{
			if ((document.getElementById("uangasuransijstpdjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijstpdjspromapannew").value > 1500000000))
			{
				alert('JUA JS TPD Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransijstpdjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransijstpdjspromapannew").value < 0)
			{
				alert('JUA JS TPD Minimal 0');
				document.getElementById("uangasuransijstpdjspromapannew").value = 0;	
			}
			
		}

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);


		$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew/hitungjstpdpromapannew');?>",
					data	: "uangasuransijstpdjspromapannew="+uangasuransijstpdjspromapannew+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
					success : function(data) {
						$("#premijstpdjspromapannew").val(data);

	//							alert(data);

					}
				});

	});

	$("#uangasuransici53jspromapannew").change(function() {
		var uangasuransici53jspromapannew = document.getElementById("uangasuransici53jspromapannew").value;

		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
		
		var carabayarjspromapannew = $("#carabayarjspromapannew").val();
		
		var maksimaluaci = 3 * document.getElementById("uangpertanggungan").value;
		
		if (carabayarjspromapannew == '1')
		{
			if ((document.getElementById("uangasuransici53jspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransici53jspromapannew").value > 1500000000))
			{
				alert('JUA CI 53 Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransici53jspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransici53jspromapannew").value < 0)
			{
				alert('JUA CI 53 Minimal 0');
				document.getElementById("uangasuransici53jspromapannew").value = 0;	
			}
			
		}
		else if (carabayarjspromapannew == '2')
		{
			if ((document.getElementById("uangasuransici53jspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransici53jspromapannew").value > 1500000000))
			{
				alert('JUA CI 53 Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransici53jspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransici53jspromapannew").value < 0)
			{
				alert('JUA CI 53 Minimal 0');
				document.getElementById("uangasuransici53jspromapannew").value = 0;	
			}
			
		}

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew/hitungjsci53promapannew');?>",
					data	: "uangasuransici53jspromapannew="+uangasuransici53jspromapannew+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
					success : function(data) {
						$("#premici53jspromapannew").val(data);

					}
				});

	});	

	$("#uangasuransijsaddbjspromapannew").change(function() {
		var uangasuransijsaddbjspromapannew = document.getElementById("uangasuransijsaddbjspromapannew").value;

		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();
		
		var maksimaluaaddb = 3 * document.getElementById("uangpertanggungan").value;
		
		if (carabayarjspromapannew == '1')
		{
			
			if ((document.getElementById("uangasuransijsaddbjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijsaddbjspromapannew").value > 1500000000))
			{
				alert('JUA JS ADDB Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransijsaddbjspromapannew").value < 0)
			{
				alert('JUA JS ADDB Minimal 0');
				document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
			}
			
		}
		else if (carabayarjspromapannew == '2')
		{
			if ((document.getElementById("uangasuransijsaddbjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijsaddbjspromapannew").value > 1500000000))
			{
				alert('JUA JS ADDB Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransijsaddbjspromapannew").value < 0)
			{
				alert('JUA JS ADDB Minimal 0');
				document.getElementById("uangasuransijsaddbjspromapannew").value = 0;	
			}
		}

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		$.ajax({
					type	: "POST",
					url		: "<?=base_url('jspromapannew/hitungjsaddbpromapannew');?>",
					data	: "uangasuransijsaddbjspromapannew="+uangasuransijsaddbjspromapannew+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapannew="+carabayarjspromapannew,
					success : function(data) {
						$("#premijsaddbjspromapannew").val(data);

					}
				});

	});	
	
	$("#uangasuransijsadbjspromapannew").change(function() {
		var uangasuransijsadbjspromapannew = document.getElementById("uangasuransijsadbjspromapannew").value;

		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();
		
		var maksimaluaaddb = 2 * document.getElementById("uangpertanggungan").value;
		
		if (carabayarjspromapannew == '1')
		{
			
			if ((document.getElementById("uangasuransijsadbjspromapannew").value > (2*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijsadbjspromapannew").value > 1500000000))
			{
				alert('JUA JS ADB Maksimal 2 kali UA atau 1500000000!');
				document.getElementById("uangasuransijsadbjspromapannew").value = 20/100*document.getElementById("uangpertanggungan").value;	
			}
			else if (document.getElementById("uangasuransijsadbjspromapannew").value < 20/100*document.getElementById("uangpertanggungan").value)
			{
				alert('JUA JS ADB Minimal 20% x uang Asuransi Dasar');
				document.getElementById("uangasuransijsadbjspromapannew").value = 20/100*document.getElementById("uangpertanggungan").value;	
			}
			
		}
		else if (carabayarjspromapannew == '2')
		{
			if ((document.getElementById("uangasuransijsadbjspromapannew").value > (2*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransijsadbjspromapannew").value > 1500000000))
			{
				alert('JUA JS ADB Maksimal 2 kali UA atau 1500000000!');
				document.getElementById("uangasuransijsadbjspromapannew").value = 20/100*document.getElementById("uangpertanggungan").value;	
			}
			else if (document.getElementById("uangasuransijsadbjspromapannew").value < 20/100*document.getElementById("uangpertanggungan").value)
			{
				alert('JUA JS ADB Minimal 20% x uang Asuransi Dasar');
				document.getElementById("uangasuransijsadbjspromapannew").value = 20/100*document.getElementById("uangpertanggungan").value;	
			}
		}

		

	});	


	$("#uangasuransitermjspromapannew").change(function() {

		var uangasuransitermjspromapannew = document.getElementById("uangasuransitermjspromapannew").value;

		var perokok = document.getElementById("perokok").value;

		var carabayarjspromapannew = $("#carabayarjspromapannew").val();
		
		if (carabayarjspromapannew == '1')
		{
			if ((document.getElementById("uangasuransitermjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransitermjspromapannew").value > 1500000000))
			{
				alert('JUA JS Term Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransitermjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransitermjspromapannew").value < 0)
			{
				alert('JUA JS Term Minimal 0');
				document.getElementById("uangasuransitermjspromapannew").value = 0;	
			}
			
		}
		else if (carabayarjspromapannew == '2')
		{
			if ((document.getElementById("uangasuransitermjspromapannew").value > (3*document.getElementById("uangpertanggungan").value)) || (document.getElementById("uangasuransitermjspromapannew").value > 1500000000))
			{
				alert('JUA JS Term Maksimal 3 kali UA atau 1500000000!');
				document.getElementById("uangasuransitermjspromapannew").value = 0;	
			}
			else if (document.getElementById("uangasuransitermjspromapannew").value < 0)
			{
				alert('JUA JS Term Minimal 0');
				document.getElementById("uangasuransitermjspromapannew").value = 0;	
			}
			
		}

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/hitungjstermpromapannew');?>",
			data	: "uangasuransitermjspromapannew="+uangasuransitermjspromapannew+"&usiasekarang="+usiasekarang+"&perokok="+perokok+"&carabayarjspromapannew="+carabayarjspromapannew,
			success : function(data) {
				$("#premitermjspromapannew").val(data);

			}
		});


	});
	
	$("#hubungandenganpempol").change(function() {

		var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
		var birthday = +new Date(tanggallahircalontertangggung);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);
		
//		alert(usiasekarang);
		
		var hubungandenganpempol =  document.getElementById("hubungandenganpempol").value;
		
		var getBirthdayDate = new Date(tanggallahircalontertangggung).getDate(); 
		var getBirthdayMonth = new Date(tanggallahircalontertangggung).getMonth()+1; 
		var getBirthdayFullYear = new Date(tanggallahircalontertangggung).getFullYear();
		
		var getNowDate = new Date().getDate(); 
		var getNowMonth = new Date().getMonth(); 
		var getNowFullYear = new Date().getFullYear(); 
		
		var m = ((getNowFullYear - getBirthdayFullYear) * 12) - getBirthdayMonth + getNowMonth;
	
//		USIA MAKSIMAL 64 TAHUN
		if (usiasekarang > 64)
		{
			alert('Usia Maksimal 64 Tahun!');
			$("#tanggallahircalontertangggung").val("");
			$('#tanggallahircalontertangggung').trigger('change');
			$('#nextBtn').prop('disabled', false);
		}
		else if ((hubungandenganpempol=='1')&&((usiasekarang > 64)||(usiasekarang < 17)))
		{
			alert('Usia sekarang : '+usiasekarang+' Usia Minimal 17 Tahun atau Kurang dari 64 Tahun!');
			$('#nextBtn').prop('disabled', true);
		}
		else if ((hubungandenganpempol=='2')&&(m < 6))
		{
			alert('Usia sekarang : '+usiasekarang+' bulan, Usia Minimal Anak Wajib 6 Bulan');
			$('#nextBtn').prop('disabled', true);
		}
		else if ((document.getElementById('tertanggungsamadenganpemegangpolis').checked == false))
		{

			hubungandenganpempol = document.getElementById('hubungandenganpempol').value;

			if (hubungandenganpempol=='1')
			{
				$('#hcpjspromapannew').prop('disabled', false);
				$('#hcpbjspromapannew').prop('disabled', false);
				$('#jsaddbjspromapannew').prop('disabled', false);	
				$('#jstpdjspromapannew').prop('disabled', false);

				$('#ci53jspromapannew').prop('disabled', false);
				$('#termjspromapannew').prop('disabled', false);
				$('#jspbdjspromapannew').prop('disabled', true);	
				$('#jspbtpdjspromapannew').prop('disabled', true);

				$('#jsspdjspromapannew').prop('disabled', false);
				$('#jssptpdjspromapannew').prop('disabled', false);
				$('#jswptpdjspromapannew').prop('disabled', true);	
				$('#jswpcijspromapannew').prop('disabled', true );
				$('#jsadbjspromapannew').prop('disabled', true );

				$('#nextBtn').prop('disabled', false);	
			}
			else if (hubungandenganpempol=='2')
			{
				$('#hcpjspromapannew').prop('disabled', false);
				$('#hcpbjspromapannew').prop('disabled', false);
				$('#jsaddbjspromapannew').prop('disabled', false);	
				$('#jstpdjspromapannew').prop('disabled', false);

				$('#ci53jspromapannew').prop('disabled', false);
				$('#termjspromapannew').prop('disabled', false);
				$('#jspbdjspromapannew').prop('disabled', false);	
				$('#jspbtpdjspromapannew').prop('disabled', false);

				$('#jsspdjspromapannew').prop('disabled', true);
				$('#jssptpdjspromapannew').prop('disabled', true);
				$('#jswptpdjspromapannew').prop('disabled', true);	
				$('#jswpcijspromapannew').prop('disabled', true );
				$('#jsadbjspromapannew').prop('disabled', true );


				$('#nextBtn').prop('disabled', false);
			}

		}
		
//		alert(document.getElementById('tertanggungsamadenganpemegangpolis').checked);

	});
	
	$("#alokasidana1").change(function() {

		var alokasidana1 =  document.getElementById("alokasidana1").value;
		var alokasidana2 =  document.getElementById("alokasidana2").value;
		
		if (alokasidana1 == '5')
		{
			$('#persentasealokasidana1').prop('disabled', true);	
			$('#persentasealokasidana2').prop('disabled', true);
			$('#alokasidana2').prop('disabled', true);
			
			
			
			document.getElementById("persentasealokasidana1").value = 100;
			document.getElementById("persentasealokasidana2").value = 0;
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
		}
		else if (alokasidana1 == '6')
		{
			$('#persentasealokasidana1').prop('disabled', true);	
			$('#persentasealokasidana2').prop('disabled', true);
			$('#alokasidana2').prop('disabled', true);	
			
			
			
			document.getElementById("persentasealokasidana1").value = 100;
			document.getElementById("persentasealokasidana2").value = 0;
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
		}
		else if (alokasidana1 == alokasidana2)
		{
//			alert('Alokasi Dana tidak boleh sama!');
			
			document.getElementById("alokasidana1").value = "";
			document.getElementById("alokasidana2").value = "";
			
			document.getElementById("persentasealokasidana1").value = 0;
			document.getElementById("persentasealokasidana2").value = 0;
			
			$('#alokasidana1').trigger('change');
			$('#alokasidana2').trigger('change');
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
		}
		else
		{
			$('#persentasealokasidana1').prop('disabled', false);	
			$('#persentasealokasidana2').prop('disabled', false);
			$('#alokasidana2').prop('disabled', false);	
			
			document.getElementById("persentasealokasidana1").value = 0;
			document.getElementById("persentasealokasidana2").value = 0;
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
			
		}
			
//		

	});
	
	$("#alokasidana2").change(function() {

		var alokasidana1 =  document.getElementById("alokasidana1").value;
		var alokasidana2 =  document.getElementById("alokasidana2").value;
		
		if (alokasidana2 == '5')
		{
			$('#persentasealokasidana1').prop('disabled', true);	
			$('#persentasealokasidana2').prop('disabled', true);
			$('#alokasidana1').prop('disabled', true);
			
			document.getElementById("persentasealokasidana1").value = 0;
			document.getElementById("persentasealokasidana2").value = 100;
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
		}
		else if (alokasidana2 == '6')
		{
			$('#persentasealokasidana1').prop('disabled', true);	
			$('#persentasealokasidana2').prop('disabled', true);
			$('#alokasidana1').prop('disabled', true);	
			
			
			document.getElementById("persentasealokasidana1").value = 0;
			document.getElementById("persentasealokasidana2").value = 100;
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
		}
		else if (alokasidana1 == alokasidana2)
		{
//			alert('Alokasi Dana tidak boleh sama!');
			
			document.getElementById("alokasidana1").value = "";
			document.getElementById("alokasidana2").value = "";
			
			document.getElementById("persentasealokasidana1").value = 0;
			document.getElementById("persentasealokasidana2").value = 0;
			
			$('#alokasidana1').trigger('change');
			$('#alokasidana2').trigger('change');
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
		}
		else
		{
			$('#persentasealokasidana1').prop('disabled', false);	
			$('#persentasealokasidana2').prop('disabled', false);
			$('#alokasidana1').prop('disabled', false);	
			
			document.getElementById("persentasealokasidana1").value = 0;
			document.getElementById("persentasealokasidana2").value = 0;
			
			$('#persentasealokasidana1').trigger('change');
			$('#persentasealokasidana2').trigger('change');
			
		}
			
//		

	});

	
	$("#submitBtn").click(function() {
		
//		alert('BERHASIL!');
	
		var jsaddbjspromapannew =	document.getElementById("jsaddbjspromapannew").value;
		var uangasuransijsaddbjspromapannew = document.getElementById("uangasuransijsaddbjspromapannew").value;

		var jstpdjspromapannew = document.getElementById("jstpdjspromapannew").value;
		var uangasuransijstpdjspromapannew = document.getElementById("uangasuransijstpdjspromapannew").value;

		var hcpjspromapannew =	document.getElementById("hcpjspromapannew").value;
		var premihcpjspromapannew = document.getElementById("premihcpjspromapannew").value;
		var uangasuransihcpjspromapannew =	document.getElementById("uangasuransihcpjspromapannew").value*100000;

		var hcpbjspromapannew = document.getElementById("hcpbjspromapannew").value;
		var premihcpbjspromapannew = document.getElementById("premihcpbjspromapannew").value;
		var uangasuransihcpbjspromapannew =	document.getElementById("uangasuransihcpbjspromapannew").value*1000000;

		var ci53jspromapannew = document.getElementById("ci53jspromapannew").value;
		var uangasuransici53jspromapannew = document.getElementById("uangasuransici53jspromapannew").value;

		var termjspromapannew = document.getElementById("termjspromapannew").value;
		var uangasuransitermjspromapannew = document.getElementById("uangasuransitermjspromapannew").value; 

		var jspbdjspromapannew = document.getElementById("jspbdjspromapannew").value;
		var uangasuransijspbdjspromapannew = document.getElementById("uangasuransijspbdjspromapannew").value;

		var jspbtpdjspromapannew = document.getElementById("jspbtpdjspromapannew").value;
		var uangasuransijspbtpdjspromapannew = document.getElementById("uangasuransijspbtpdjspromapannew").value;

		var jsspdjspromapannew = document.getElementById("jsspdjspromapannew").value;
		var uangasuransijsspdjspromapannew = document.getElementById("uangasuransijsspdjspromapannew").value;

		var jswptpdjspromapannew = document.getElementById("jswptpdjspromapannew").value;
		var uangasuransijswptpdjspromapannew = document.getElementById("uangasuransijswptpdjspromapannew").value;

		var jswpcijspromapannew = document.getElementById("jswpcijspromapannew").value;
		var uangasuransijswpcijspromapannew = document.getElementById("uangasuransijswpcijspromapannew").value;
		
		var jsadbjspromapannew = document.getElementById("jsadbjspromapannew").value;
		var uangasuransijsadbjspromapannew = document.getElementById("uangasuransijsadbjspromapannew").value;

		var jssptpdjspromapannew = document.getElementById("jssptpdjspromapannew").value;
		var uangasuransijssptpdjspromapannew = document.getElementById("uangasuransijssptpdjspromapannew").value;
		
		var carabayarjspromapannew = document.getElementById("carabayarjspromapannew").value;
		var uangpertanggungan = document.getElementById("uangpertanggungan").value;
		var kodeprospek = document.getElementById("kodeprospek").value;
		var namalengkapcalontertanggung = document.getElementById("namalengkapcalontertanggung").value;
//		var modul = document.getElementById("modul").value;
//		var id_produk = document.getElementById("id_produk").value;
		var sessionnasabah = document.getElementById("sessionnasabah").value;
		
		var totalpremi = document.getElementById("totalpremi").value;
		
		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/insertDataPDF');?>",
			data	: "jsaddbjspromapannew="+jsaddbjspromapannew+"&uangasuransijsaddbjspromapannew="+uangasuransijsaddbjspromapannew+"&jstpdjspromapannew="+jstpdjspromapannew+"&uangasuransijstpdjspromapannew="+uangasuransijstpdjspromapannew+"&hcpjspromapannew="+hcpjspromapannew+"&premihcpjspromapannew="+premihcpjspromapannew+"&hcpbjspromapannew="+hcpbjspromapannew+"&premihcpbjspromapannew="+premihcpbjspromapannew+"&uangasuransihcpjspromapannew="+uangasuransihcpjspromapannew+"&uangasuransihcpbjspromapannew="+uangasuransihcpbjspromapannew+"&ci53jspromapannew="+ci53jspromapannew+"&uangasuransici53jspromapannew="+uangasuransici53jspromapannew+"&termjspromapannew="+termjspromapannew+"&uangasuransitermjspromapannew="+uangasuransitermjspromapannew+"&jspbdjspromapannew="+jspbdjspromapannew+"&uangasuransijspbdjspromapannew="+uangasuransijspbdjspromapannew+"&jspbtpdjspromapannew="+jspbtpdjspromapannew+"&uangasuransijspbtpdjspromapannew="+uangasuransijspbtpdjspromapannew+"&jsspdjspromapannew="+jsspdjspromapannew+"&uangasuransijsspdjspromapannew="+uangasuransijsspdjspromapannew+"&jswptpdjspromapannew="+jswptpdjspromapannew+"&uangasuransijswptpdjspromapannew="+uangasuransijswptpdjspromapannew+"&jswpcijspromapannew="+jswpcijspromapannew+"&uangasuransijswpcijspromapannew="+uangasuransijswpcijspromapannew+"&jssptpdjspromapannew="+jssptpdjspromapannew+"&uangasuransijssptpdjspromapannew="+uangasuransijssptpdjspromapannew+"&carabayarjspromapannew="+carabayarjspromapannew+"&uangpertanggungan="+uangpertanggungan+"&kodeprospek="+kodeprospek+"&namalengkapcalontertanggung="+namalengkapcalontertanggung+"&sessionnasabah="+sessionnasabah+"&totalpremi="+totalpremi+"&jsadbjspromapannew="+jsadbjspromapannew+"&uangasuransijsadbjspromapannew="+uangasuransijsadbjspromapannew,
			success : function(msg) {
				
//					alert(msg);
			}
		});
		
		

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('jspromapannew/insertProDataRider');?>",
			data	: "jsaddbjspromapannew="+jsaddbjspromapannew+"&uangasuransijsaddbjspromapannew="+uangasuransijsaddbjspromapannew+"&jstpdjspromapannew="+jstpdjspromapannew+"&uangasuransijstpdjspromapannew="+uangasuransijstpdjspromapannew+"&hcpjspromapannew="+hcpjspromapannew+"&premihcpjspromapannew="+premihcpjspromapannew+"&hcpbjspromapannew="+hcpbjspromapannew+"&premihcpbjspromapannew="+premihcpbjspromapannew+"&uangasuransihcpjspromapannew="+uangasuransihcpjspromapannew+"&uangasuransihcpbjspromapannew="+uangasuransihcpbjspromapannew+"&ci53jspromapannew="+ci53jspromapannew+"&uangasuransici53jspromapannew="+uangasuransici53jspromapannew+"&termjspromapannew="+termjspromapannew+"&uangasuransitermjspromapannew="+uangasuransitermjspromapannew+"&jspbdjspromapannew="+jspbdjspromapannew+"&uangasuransijspbdjspromapannew="+uangasuransijspbdjspromapannew+"&jspbtpdjspromapannew="+jspbtpdjspromapannew+"&uangasuransijspbtpdjspromapannew="+uangasuransijspbtpdjspromapannew+"&jsspdjspromapannew="+jsspdjspromapannew+"&uangasuransijsspdjspromapannew="+uangasuransijsspdjspromapannew+"&jswptpdjspromapannew="+jswptpdjspromapannew+"&uangasuransijswptpdjspromapannew="+uangasuransijswptpdjspromapannew+"&jswpcijspromapannew="+jswpcijspromapannew+"&uangasuransijswpcijspromapannew="+uangasuransijswpcijspromapannew+"&jssptpdjspromapannew="+jssptpdjspromapannew+"&uangasuransijssptpdjspromapannew="+uangasuransijssptpdjspromapannew+"&carabayarjspromapannew="+carabayarjspromapannew+"&uangpertanggungan="+uangpertanggungan+"&kodeprospek="+kodeprospek+"&namalengkapcalontertanggung="+namalengkapcalontertanggung+"&sessionnasabah="+sessionnasabah+"&jsadbjspromapannew="+jsadbjspromapannew+"&uangasuransijsadbjspromapannew="+uangasuransijsadbjspromapannew,
			success : function(msg) {
				
			var filepdf = 'SIMULASI-'+document.getElementById("namalengkapcalontertanggung").value.toUpperCase()+'-'+msg;	
				
			var kodeprospek =document.getElementById("kodeprospek").value;	
//				alert(filepdf);
				
//				window.location.href= "<?=base_url('jspromapannew/hasil')?>"; 
				
//				alert("<?=base_url('jspromapannew/hasil')?>"+"?buildid="+msg);
				
				window.location.href= "<?=base_url('jspromapannew/hasil')?>?buildid="+msg+'&filepdf='+filepdf+'&kodeprospek='+kodeprospek;   
				
//				window.location.href= " https://jaim.jiwasraya.co.id/simulasi/jspromapannew/hasil?buildid="+msg;  
			   
				//console.log(data);
				
//				window.location.href= "<?=base_url('jspromapannew/CetakPDF')?>"+"?buildid="+msg; 

			}
		});	
	
		

	});	

	


});
	
</script>

</body>
</html>
