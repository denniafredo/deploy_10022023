<center><h1 style="color:#FF0000"></h1></center>

<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
                                                    <h4 class="block">Calon Pemegang Polis</h4>
														<div class="form-group">
  <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span> </label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="calonpemegangpolisperokok" id="calonpemegangpolisperokok" onChange="">
                                          <option value="Tidak">Tidak</option>
                                          		<option value="Ya">Ya</option>
												<option value="">Pilih...</option>	
											</select>
										</div>
									</div>
                                                        
													</div>
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

<h4 class="block">Calon Tertanggung</h4>
															
                                            <br>
                                            <div class="form-group">
                                              <label class="control-label col-md-4">Hubungan dgn PemPol <span class="required"> * </span></label>
                                              <div class="col-md-3">
										  <select class="form-control select2me" name="hubungandenganpempol" id="hubungandenganpempol" onChange="onHandleHubunganDenganPempol(this)">
												<option value="">[PILIH]</option>
												<option value="Suami/Istri">Suami/Istri</option>
<option value="Anak">Anak</option>
<option value="Lainnya">Lainnya</option>
											</select>
										</div>
		</div>
        <div class="form-group">
          <label class="control-label col-md-4">Nama Tertanggung <span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namalengkapcalontertanggung" id="namalengkapcalontertanggung" placeholder="Nama Lengkap"/>
														<span class="help-block">
															 Masukkan Nama Lengkap Anda
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
													  <input class="form-control form-control-inline input-medium date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" onChange="onChangeTanggalLahir(this)"/>
														<span class="help-block">
															 Masukkan Tanggal Lahir
														</span>
													</div>
		</div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span></label>
                                                  <div class="col-md-6">
										  <select class="form-control" name="calontertanggungperokok" id="calontertanggungperokok" onChange="">
                                          		<option value="Tidak">Tidak</option>
                                                						<option value="Ya">Ya</option>
												<option value="">Pilih...</option>
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

<h3 class="block" align="center">Asuransi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
						
                        <div class="form-group">
	<label class="control-label col-md-6">Asumsi Cuti Tahunan
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-6">
		<div class="input-group">
		  <input class="form-cntrol" placeholder="Asumsi Cuti Tahunan" type="number" name="asumsicutitahunan" id="asumsicutitahunan" onChange="HandleAsumsiCutiTahunan(this)" value="5">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>								<div class="form-group">
  <label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="carabayar" id="carabayar" onChange="onChangeCaraBayar(this)">
                                     <option value="Bulanan">Bulanan</option>     
                                     <option value="Kuartalan">Kuartalan</option>
                                     <option value="Semesteran">Semesteran</option>
                                     <option value="Tahunan">Tahunan</option>
                                     <option value="">[Pilih Cara Bayar]</option>
											</select>
										</div>
									</div>
                                    <div class="form-group">
									  <label class="control-label col-md-4">Uang Pertanggungan <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Uang Pertanggungan" type="number" name="uangpertanggungan" id="uangpertanggungan" onChange="onChangeUangPertanggungan(this)" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Minimal UA <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
		  <input class="form-control" placeholder="Minimal UA" type="number" name="minimalua" id="minimalua" onchange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Maksimal UA <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
		  <input class="form-control" placeholder="Maksimal UA" type="number" name="maksimalua" id="maksimalua" onchange="" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
  <label class="control-label col-md-4">Mata Uang <span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="matauang" id="matauang" onChange="">
                                                <option value="IDR">IDR</option>
											</select>
										</div>
									</div>
                                   <div class="form-group">
                                                  <label class="control-label col-md-4">Status Medical <span class="required"> * </span></label>
                                                  <div class="col-md-6">
										  <select class="form-control" name="statusmedical" id="statusmedical" onChange="">
                                          		<option value="Tidak">Tidak</option>
                                                						<option value="Ya">Ya</option>
												<option value="">Pilih...</option>
											</select>
										</div>
		</div>                     
													</div>
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">
															
                                            <br>
        <div class="form-group">
	<label class="control-label col-md-6">Premi Berkala
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-6">
		<div class="input-group">
			<input class="form-cntrol" placeholder="Premi Berkala" type="number" name="premiberkala" id="premiberkala" onchange="onChangePremiBerkala(this)" value="200000">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
                                                <div class="form-group">
                                                  <label class="control-label col-md-6">Top Up Berkala <span class="required"> * </span></label>
                                                  <div class="col-md-6">
		<div class="input-group">
			<input class="form-cntrol" placeholder="Top Up Berkala" type="number" name="topupberkala" id="topupberkala" onchange="onChangeTopUpBerkala(this)" value="100000">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
                                                  <label class="control-label col-md-6">Top Up Sekaligus <span class="required"> * </span></label>
                                                  <div class="col-md-6">
		<div class="input-group">
			<input class="form-cntrol" placeholder="Top Up Sekaligus" type="number" name="topupsekaligus" id="topupsekaligus" onchange="onChangeTopUpSekaligus(this)" value="0">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-6">Bea Materai
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-6">
		<div class="input-group">
			<input class="form-cntrol" placeholder="Bea Materai" type="number" name="beamaterai" id="beamaterai" onchange="onChangeBeaMaterai(this)" readonly value="0">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>                                   
<div class="form-group">
  <label class="control-label col-md-6">Total Premi yang dibayar <span class="required"> * </span></label>
  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Total Premi yang dibayar" type="number" name="totalpremiyangdibayar" id="totalpremiyangdibayar" onchange="" readonly value="300000">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
                       <br>									
</div>
													<!--/span-->
   		 </div>
    </div>
</div>

<h3 class="block" align="center">Alokasi Dana</h3>
<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								<thead>
								<tr role="row" class="heading">
									
									<th width="33%">
										 Persentase Alokasi Dana Investasi
									</th>
									<th width="33%">
										 
									</th>
									<th width="33%">
										 
									</th>
								</tr>
								<tr role="row" class="filter">
							
									<td>
												<p style="margin-top:5px">Alokasi Dana #1</p>
                                                <p style="margin-top:30px"> 
                                                Alokasi Dana #2</p>
                                               <td>
                                                <div class="form-group">
                                                  <div class="col-md-12">
										  <select class="form-control select2me" name="alokasidana1" id="alokasidana1" onChange="">
												<option value="">Pilih Alokasi Dana</option>
												<option value="JS LINK PASAR UANG">JS LINK PASAR UANG</option>
												<option value="JS LINK PENDAPATAN TETAP">JS LINK PENDAPATAN TETAP</option>
                                                <option value="JS LINK BERIMBANG">JS LINK BERIMBANG</option>
                                                <option value="JS LINK EKUITAS">JS LINK EKUITAS</option>
											</select>
										</div>
		</div>
                                                <div class="form-group">
                                                  <div class="col-md-12">
										  <select class="form-control select2me" name="alokasidana2" id="alokasidana2" onChange="">
												<option value="">Pilih Alokasi Dana</option>
												<option value="JS LINK PASAR UANG">JS LINK PASAR UANG</option>
												<option value="JS LINK PENDAPATAN TETAP">JS LINK PENDAPATAN TETAP</option>
                                                <option value="JS LINK BERIMBANG">JS LINK BERIMBANG</option>
                                                <option value="JS LINK EKUITAS">JS LINK EKUITAS</option>
											</select>
										</div>
		</div>
									</td>
									<td>
										<div class="input-group" style="margin-top:4px">
		= <input class="form-cntrol" placeholder="" type="number" name="persentasealokasidana1" id="persentasealokasidana1" onchange="onChangePersentaseAlokasiDana1(this)" value="100"> %
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
                                        <div class="input-group" style="margin-top:20px">
		= <input class="form-cntrol" placeholder="" type="number" name="persentasealokasidana2" id="persentasealokasidana2" onchange="onChangePersentaseAlokasiDana2(this)" value="0"> %
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>                     									</td>
								</tr>
								</thead>
</table>							
<div align="left">
* Jika hanya  1 (satu) alokasi dana, maka yang diisi hanya satu alokasi
</div>
<br>
<h3 class="block" align="center">Rider</h3>
<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								<thead>
								<tr role="row" class="filter">
							
									<td>
                                                <p style="margin-top:12px"> 
                                                <input type="checkbox" class="group-checkable" id ="addb" onClick="checkedRider(this)">JS ADDB</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="tpd" onClick="checkedRider(this)">JS TPD</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="hcp" onClick="checkedRider(this)">JS HCP</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="hcpbedah" onClick="checkedRider(this)">JS HCP Bedah *)</p>
                                               <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="ci53" onClick="checkedRider(this)">JS CI 53</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="termlife" onClick="checkedRider(this)">JS Term Life</p>
                                                <p style="margin-top:17px">
                                                <input type="checkbox" class="group-checkable" id="payorbenefitdeath" onClick="checkedRider(this)" >JS Payor Benefit - Death</p>
                                                <p style="margin-top:17px">
                                                <input type="checkbox" class="group-checkable" id="payorbenefittpd" onClick="checkedRider(this)" >JS Payor Benefit - TPD</p>   
                                                <p style="margin-top:17px">
                                                <input type="checkbox" class="group-checkable" id="spousepayordeath" onClick="checkedRider(this)" >JS Spouse Payor - Death</p>    
                                                <p style="margin-top:17px">
                                                <input type="checkbox" class="group-checkable" id="spousepayortpd" onClick="checkedRider(this)" >JS Spouse Payor - TPD</p>
                                                  <p style="margin-top:12px"> 
                                                <input type="checkbox" class="group-checkable" id ="wp" onClick="checkedRider(this)">Waiver Premium</p>                                          <td>
                                                
                                                <input type="number" class="form-control form-filter input-sm" name="juaaddb" id="juaaddb" disabled style="margin-top:5px" onChange="onChangeJUAADDB()">
                                                <input type="number" class="form-control form-filter input-sm" name="juatpd" id="juatpd" disabled style="margin-top:5px" onChange="onChangeJUATPD()">

<div class="row" style="margin-top:5px">


<div class="col-md-3">																<input type="number" class="form-control form-filter input-sm" name="dropdownhcp" id="dropdownhcp" disabled onChange="onChangeHCP()">
</div>															<div class="col-md-9">															<input type="number" class="form-control form-filter input-sm" name="juahcp" id="juahcp" disabled>														</div>
													<!--/span-->
												
                                        </div>
                                                <div class="row" style="margin-top:5px">


<div class="col-md-3">																<input type="number" class="form-control form-filter input-sm" name="dropdownhcpbedah" id="dropdownhcpbedah" disabled onClick="">
</div>															<div class="col-md-9">															<input type="number" class="form-control form-filter input-sm" name="juahcpbedah" id="juahcpbedah" disabled> 														</div>

													<!--/span-->
												
                                        </div>
                                                <input type="number" class="form-control form-filter" name="juaci53" id="juaci53" disabled style="margin-top:5px" onChange="onChangeJUACI53()">
                                                <input type="number" class="form-control form-filter" name="juatermlife" id="juatermlife" disabled style="margin-top:5px" onChange="onChangeJUATermLife()">

<input type="number" class="form-control form-filter" name="juapayorbenefitdeath" id="juapayorbenefitdeath" disabled style="margin-top:5px">

<input type="number" class="form-control form-filter" name="juapayorbenefittpd" id="juapayorbenefittpd" disabled style="margin-top:5px">    

<input type="number" class="form-control form-filter" name="juaspousepayordeath" id="juaspousepayordeath" disabled style="margin-top:5px">

<input type="number" class="form-control form-filter" name="juaspousepayortpd" id="juaspousepayortpd" disabled style="margin-top:5px">    
 
<div class="row" style="margin-top:5px">
    <div class="col-md-3">																
    	<input type="number" class="form-control form-filter input-sm" name="juawp" id="juawp" readonly onChange="onChangeWP()">
    </div>															
    <div class="col-md-9">															
   		<input type="number" class="form-control form-filter input-sm" name="premitambahanwp" id="premitambahanwp" readonly>														
    </div>  
</div>                                                 
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
</table>
<br>

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
                                        <select class="form-control select2me" name="hcpjspromapan" id="hcpjspromapan" onChange="" >
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpjspromapan" id="premihcpjspromapan" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpjspromapan" id="uangasuransihcpjspromapan" onChange="" disabled>
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
                                        <select class="form-control select2me" name="hcpbjspromapan" id="hcpbjspromapan" onChange="" disabled>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premihcpbjspromapan" id="premihcpbjspromapan" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <select class="form-control select2me" name="uangasuransihcpbjspromapan" id="uangasuransihcpbjspromapan" onChange="" disabled>
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
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjspromapan1" id="totalpremiriderjspromapan1" onChange="" readonly value="0">
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
                                        <select class="form-control select2me" name="jstpdjspromapan" id="jstpdjspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijstpdjspromapan" id="premijstpdjspromapan" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijstpdjspromapan" id="uangasuransijstpdjspromapan" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>2.</td>
										<td>JS WP</td>
                                        <td>
                                        <select class="form-control select2me" name="wpjspromapan" id="wpjspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premiwpjspromapan" id="premiwpjspromapan" onChange="" value="0" readonly>
                                        </td>
										
									</tr>
									<tr>
										<td>3.</td>
										<td>JS CI53</td>
                                        <td>
                                        <select class="form-control select2me" name="ci53jspromapan" id="ci53jspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premici53jspromapan" id="premici53jspromapan" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransici53jspromapan" id="uangasuransici53jspromapan" onChange="" value="0" disabled>
                                        </td>
									</tr>
                                    <tr>
										<td>4.</td>
										<td>JS ADDB</td>
                                        <td>
                                        <select class="form-control select2me" name="jsaddbjspromapan" id="jsaddbjspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsaddbjspromapan" id="premijsaddbjspromapan" onChange="" value="0" readonly>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransijsaddbjspromapan" id="uangasuransijsaddbjspromapan" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
                                    <tr>
										<td>5.</td>
										<td>JS SP-D</td>
                                        <td>
                                        <select class="form-control select2me" name="jsspdjspromapan" id="jsspdjspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijsspdjspromapan" id="premijsspdjspromapan" onChange="" value="0" readonly>
                                        </td>
										
									</tr>
                                    <tr>
										<td>6.</td>
										<td>JS SP-TPD</td>
                                        <td>
                                        <select class="form-control select2me" name="jssptpdjspromapan" id="jssptpdjspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premijssptpdjspromapan" id="premijssptpdjspromapan" onChange="" value="0" readonly>
                                        </td>
									</tr>
									<tr>
										<td>7.</td>
										<td>JS Term</td>
                                        <td>
                                        <select class="form-control select2me" name="termjspromapan" id="termjspromapan" onChange="">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                        </select>
                                        </td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="premitermjspromapan" id="premitermjspromapan" onChange="" value="0" readonly>
                                        </td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="uangasuransitermjspromapan" id="uangasuransitermjspromapan" onChange="" value="0" disabled>
                                        </td>
									</tr>
									<tr>
										<td></td>
										<td style="font-weight:bold">TOTAL PREMI RIDER</td>
                                        <td></td>
										<td style="font-weight:bold">
                                        <input class="form-control" placeholder="" type="" name="totalpremiriderjspromapansum" id="totalpremiriderjspromapansum" onChange="" readonly value="0">
                                        </td>
                                        <td>
                                                                                </td>
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
	   
	   $("#hubungandenganpempol").change(function() {
		var hubungandenganpempol = $("#hubungandenganpempol").val(); 
		 
		if (hubungandenganpempol == "Suami/Istri")
		{	
			if (document.getElementById('payorbenefitdeath').checked) {
				$('#payorbenefitdeath').click();
			}
			if (document.getElementById('payorbenefittpd').checked) {
				$('#payorbenefittpd').click();	
			}
		}
		else if (hubungandenganpempol == "Anak")
		{	
			if (document.getElementById('spousepayordeath').checked) {
				$('#spousepayordeath').click();	
			}
			if (document.getElementById('spousepayortpd').checked) {
				$('#spousepayortpd').click();
			}
		}
		else
		{	
			if (document.getElementById('payorbenefitdeath').checked) {
				$('#payorbenefitdeath').click();
			}
			if (document.getElementById('payorbenefittpd').checked) {
				$('#payorbenefittpd').click();	
			}
			if (document.getElementById('spousepayordeath').checked) {
				$('#spousepayordeath').click();	
			}
			if (document.getElementById('spousepayortpd').checked) {
				$('#spousepayortpd').click();
			}	
		}
		   
		});
	   
	    $("#tanggallahircalontertangggung").change(function() {
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
					var premiberkala = $("#premiberkala").val();
					var carabayar = $("#carabayar").val();	
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					if (carabayar == "Bulanan")
					{
						faktorpengali = 12;
						premisesuaicarabayar = faktorpengali * premiberkala; 
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 

					}
					else if (carabayar == "Kuartalan")
					{
						faktorpengali = 4;
						premisesuaicarabayar = faktorpengali * premiberkala;
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
					}
					else if (carabayar == "Semesteran")
					{
						faktorpengali = 2;
						premisesuaicarabayar = faktorpengali * premiberkala;
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
					}
					else if (carabayar == "Tahunan")
					{
						faktorpengali = 1;
						premisesuaicarabayar = faktorpengali * premiberkala;
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitungminimalUA');?>",
						data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#minimalua").val(data);
							document.getElementById('uangpertanggungan').value = document.getElementById('minimalua').value;
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitungmaksimalUA');?>",
						data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#maksimalua").val(data);
						}
					});
				});
	   
	   $("#premiberkala").change(function() {
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
					var premiberkala = $("#premiberkala").val();
					var carabayar = $("#carabayar").val();	
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
							
					if (carabayar == "Bulanan")
					{
						faktorpengali = 12;
						premisesuaicarabayar = faktorpengali * premiberkala; 
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
						if (premiberkala < 200000)
						{
							alert('Premi tidak boleh kurang dari minimum Cara bayar yang dipilih. Premi minimum untuk '+carabayar+' adalah sebesar Rp. 200,000.00,-');	
							document.getElementById('premiberkala').value = 200000;
						}
					}
					else if (carabayar == "Kuartalan")
					{
						faktorpengali = 4;
						premisesuaicarabayar = faktorpengali * premiberkala;
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
						if (premiberkala < 400000)
						{
							alert('Premi tidak boleh kurang dari minimum Cara bayar yang dipilih. Premi minimum untuk '+carabayar+' adalah sebesar Rp. 400,000.00,-');	
							document.getElementById('premiberkala').value = 400000;	
						}
					}
					else if (carabayar == "Semesteran")
					{
						faktorpengali = 2;
						premisesuaicarabayar = faktorpengali * premiberkala;
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
						if (premiberkala < 900000)
						{
							alert('Premi tidak boleh kurang dari minimum Cara bayar yang dipilih. Premi minimum untuk '+carabayar+' adalah sebesar Rp. 900,000.00,-');		
							document.getElementById('premiberkala').value = 900000;
						}
					}
					else if (carabayar == "Tahunan")
					{
						faktorpengali = 1;
						premisesuaicarabayar = faktorpengali * premiberkala;
						
						document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
						
						if (premiberkala < 1400000)
						{
							alert('Premi tidak boleh kurang dari minimum Cara bayar yang dipilih. Premi minimum untuk '+carabayar+' adalah sebesar Rp. 1.400,000.00,-');		
							document.getElementById('premiberkala').value = 1400000;
						}
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitungminimalUA');?>",
						data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#minimalua").val(data);
							document.getElementById('uangpertanggungan').value = document.getElementById('minimalua').value;
						}
					});
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitungmaksimalUA');?>",
						data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#maksimalua").val(data);
						}
					});
				});
				
				
		 $("#topupberkala").change(function() {
			
				document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value);
					
				});
				
		 $("#topupsekaligus").change(function() {
			
				document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value);
					
				});
		
		$("#carabayar").change(function() {
			var carabayar = $("#carabayar").val();
			var premiberkala = $("#premiberkala").val();
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
				if (carabayar == "Bulanan")
				{	
					document.getElementById('premiberkala').value = 200000;
					faktorpengali = 12;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value; 
					document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value); 
				}
				else if (carabayar == "Kuartalan")
				{	
					document.getElementById('premiberkala').value = 400000;
					faktorpengali = 4;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value;
					document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value);
				}
				else if (carabayar == "Semesteran")
				{	
					document.getElementById('premiberkala').value = 900000;
					faktorpengali = 2;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value;
					document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value);
				}
				else if (carabayar == "Tahunan")
				{	
					document.getElementById('premiberkala').value = 1400000;
					faktorpengali = 1;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value;
					document.getElementById('totalpremiyangdibayar').value = parseInt(document.getElementById('premiberkala').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('topupsekaligus').value);
				}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapan/hitungminimalUA');?>",
				data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#minimalua").val(data);
					document.getElementById('uangpertanggungan').value = document.getElementById('minimalua').value;
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapan/hitungmaksimalUA');?>",
				data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#maksimalua").val(data);
				}
			});

		});

	   $("#tanggallahircalontertangggung").change(function() {
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();
			
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			hubungandenganpempol = document.getElementById("hubungandenganpempol").value;
			
			if (hubungandenganpempol != "")
			{
				if (( usiasekarang < 1) || ( usiasekarang > 64))
				{	
						
						alert('Untuk hubungan Pemegang Polis dengan Tertanggung ('+hubungandenganpempol+'), Usia minimal dan maksimal Tertanggung untuk Rider: 6 bulan s.d. 64 Tahun, -');
						$("#tanggallahircalontertangggung").val("");
						$('#tanggallahircalontertangggung').trigger('change');
						document.getElementById("addb").disabled = true;
						document.getElementById("tpd").disabled = true;			
						document.getElementById("hcp").disabled = true;
						document.getElementById("hcpbedah").disabled = true;
						document.getElementById("ci53").disabled = true;
						document.getElementById("termlife").disabled = true;
						document.getElementById("payorbenefitdeath").disabled = true;
						document.getElementById("payorbenefittpd").disabled = true;
						document.getElementById("spousepayordeath").disabled = true;
						document.getElementById("spousepayortpd").disabled = true;
				}
				else 
				{
					document.getElementById("addb").disabled = false;	
					document.getElementById("tpd").disabled = false;			
					document.getElementById("hcp").disabled = false;
					document.getElementById("hcpbedah").disabled = false;
					document.getElementById("ci53").disabled = false;
					document.getElementById("termlife").disabled = false;
					document.getElementById("payorbenefitdeath").disabled = false;
					document.getElementById("payorbenefittpd").disabled = false;
					document.getElementById("spousepayordeath").disabled = false;
					document.getElementById("spousepayortpd").disabled = false;
				}	
	  		 }
			 else
			 {
			 	/*alert('Pilih Hubungan dengan Pemegang Polis terlebih dahulu!'); 
				$("#tanggallahircalontertangggung").val("");*/
			 }
		});
	   
    });  
	
	function checkedTertanggungSamaDenganPemegangPolis(input){
	$("#tertanggungsamadenganpemegangpolis").click(function() {	
				
				if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
					document.getElementById("hubungandenganpempol").value = "Lainnya";
					$('#hubungandenganpempol').trigger('change');
					
					document.getElementById("namalengkapcalontertanggung").value = document.getElementById("namanasabah").value; 
					document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
					$('#tanggallahircalontertanggung').trigger('change');
					document.getElementById("calontertanggungperokok").value = document.getElementById("calonpemegangpolisperokok").value;
					
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
					document.getElementById("hubungandenganpempol").value = ""; 
					$('#hubungandenganpempol').trigger('change');
					document.getElementById("namalengkapcalontertanggung").value = ""; 
					document.getElementById("tanggallahircalontertangggung").value = ""; 
					document.getElementById("calontertanggungperokok").value = ""; 
					document.getElementById('jeniskelamincalontertanggung').value = "";
					$('#jeniskelamincalontertanggung').trigger('change');
					document.getElementById('uangpertanggungan').value = "";
					document.getElementById('minimalua').value = "";
					document.getElementById('maksimalua').value = "";
				}
				
			var carabayar = $("#carabayar").val();
			var premiberkala = $("#premiberkala").val();
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
				if (carabayar == "Bulanan")
				{	
					document.getElementById('premiberkala').value = 200000;
					faktorpengali = 12;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value; 
				}
				else if (carabayar == "Kuartalan")
				{	
					document.getElementById('premiberkala').value = 400000;
					faktorpengali = 4;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value;
					
				}
				else if (carabayar == "Semesteran")
				{	
					document.getElementById('premiberkala').value = 900000;
					faktorpengali = 2;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value;
				}
				else if (carabayar == "Tahunan")
				{	
					document.getElementById('premiberkala').value = 1400000;
					faktorpengali = 1;
					premisesuaicarabayar = faktorpengali * document.getElementById('premiberkala').value;
				}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapan/hitungminimalUA');?>",
				data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#minimalua").val(data);
					document.getElementById('uangpertanggungan').value = document.getElementById('minimalua').value;
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jspromapan/hitungmaksimalUA');?>",
				data	: "premisesuaicarabayar="+premisesuaicarabayar+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#maksimalua").val(data);
				}
			});
				
			});
	}
	
	function onChangePremiBerkala(input){
		/*var premiberkala = document.getElementById("premiberkala").value; 	
		var carabayar = document.getElementById("carabayar").value; 
		
		var minimalpremiberkala;	
		
		if (carabayar == "Bulanan")
		{
			minimalpremiberkala = 200000;  	
		}
		else if (carabayar == "Kuartalan")
		{
			minimalpremiberkala = 400000;  	
		}
		else if (carabayar == "Semesteran")
		{
			minimalpremiberkala = 900000;  
		}
		else if (carabayar == "Tahunan")
		{
			minimalpremiberkala = 1400000; 
		}
	
		if (premiberkala != "")
		{

			if (premiberkala < minimalpremiberkala)
			{
				alert('Premi tidak boleh kurang dari minimum Cara bayar yang dipilih. Premi minimum untuk '+carabayar+' adalah sebesar Rp. ' + minimalpremiberkala);	
				
				document.getElementById("premiberkala").value = minimalpremiberkala;
			}		
		}*/
	}
	
	function onChangeTopUpBerkala(input){
			
		topupberkala = document.getElementById("topupberkala").value;
		carabayar = document.getElementById("carabayar").value;
		
		if (topupberkala < 100000)
		{	
			 
			alert('Top Up tidak boleh kurang dari minimum Cara bayar yang dipilih. Top Up minimum untuk'+ carabayar +'adalah sebesar Rp. 100,000.00,-');	
			document.getElementById("topupberkala").value = 100000;
		}
		else
		{
		
		}
	}
	
	function onChangeTopUpSekaligus(input){
		
		if ((document.getElementById("topupsekaligus").value < 0) || (document.getElementById("topupsekaligus").value < 1000000) && (document.getElementById("topupsekaligus").value != 0)) 
		{
			alert('TopUp sekaligus minimum untuk JS Pro Mapan adalah sebesar Rp. 1,000,000.00,- dan kelipatannya');
			document.getElementById("topupsekaligus").value = 0;
		}		
			
	}
	
	function onChangeBeaMaterai(input){
		
	
	}
	
	function onChangePersentaseAlokasiDana1(input){
		if (document.getElementById("persentasealokasidana1").value > 100)
		{
			alert('Jumlah persen tidak boleh melebihi 100%');
			document.getElementById("persentasealokasidana1").value = parseInt(100);	
		}
		else if (document.getElementById("persentasealokasidana1").value < 5)
		{
			alert('Jumlah alokasi dana tidak boleh kurang dari 5%');
			document.getElementById("persentasealokasidana1").value = parseInt(5);	
		}
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
		else if (document.getElementById("persentasealokasidana2").value < 5)
		{
			alert('Jumlah alokasi dana tidak boleh kurang dari 5%');
			document.getElementById("persentasealokasidana2").value = parseInt(5);	
		}
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
	
	function onChangeJUAADDB(input){
		
	juaaddb = document.getElementById("juaaddb").value;
	uangpertanggungan = document.getElementById("uangpertanggungan").value;
	
		if (juaaddb < uangpertanggungan)
		{
			alert ('UA Rider JS ADDB minimum 100% UA plan pokok');
			document.getElementById("juaaddb").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}
		else if ((juaaddb > (3 * uangpertanggungan)) || (juaaddb > 500000000))
		{
			alert ('UA Rider JS ADDB maksimal 3 kali Uang Pertanggungan atau 500000000');
			document.getElementById("juaaddb").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}
	
	}
	
	function onChangeJUATPD(input){
	
	juatpd = document.getElementById("juatpd").value;
	uangpertanggungan = document.getElementById("uangpertanggungan").value;
	
		if (juatpd < uangpertanggungan)
		{
			alert ('UA Rider JS TPD minimum 100% UA plan pokok');
			document.getElementById("juatpd").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}	
		else if ((juatpd > (3 * uangpertanggungan)) || (juatpd > 500000000))
		{
			alert ('UA Rider JS TPD maksimal 3 kali Uang Pertanggungan atau 500000000');
			document.getElementById("juatpd").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}
	
	}
	
	function onChangeJUACI53(input){
	
		juaci53 = document.getElementById("juaci53").value;
	uangpertanggungan = document.getElementById("uangpertanggungan").value;
	
		if (juaci53 < uangpertanggungan)
		{
			alert ('UA Rider JS CI53 minimum 100% UA plan pokok');
			document.getElementById("juaci53").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}	
		else if ((juaci53 > (3 * uangpertanggungan)) || (juaci53 > 500000000))
		{
			alert ('UA Rider JS CI53 tidak boleh melebihi 100 persen UA plan pokok');
			document.getElementById("juaci53").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}	
	
	}
	
	function onChangeJUATermLife(input){
		
		juatermlife = document.getElementById("juatermlife").value;
	uangpertanggungan = document.getElementById("uangpertanggungan").value;
	
		if (juatermlife < uangpertanggungan)
		{
			alert ('UA Rider JS TermLife minimum 100% UA plan pokok');
			document.getElementById("juatermlife").value = parseInt(document.getElementById("uangpertanggungan").value);	
		}	
	
	}
	
	function onChangeJUASpousePayorDeath(input){
		
	
	}
	
	function onChangeJUAPayorBenefitTPD(input){
		
	
	}
	
	function onChangeCaraBayar(input){
		
		/*
		var carabayar = $("#carabayar").val();	
		var premiberkala = $("#premiberkala").val();	
					
		if (carabayar == "Bulanan")
		{
			document.getElementById("premiberkala").value = 200000;  	
			kali = 12;	
		}
		else if (carabayar == "Kuartalan")
		{
			document.getElementById("premiberkala").value = 400000;  	
			kali = 4;
		}
		else if (carabayar == "Semesteran")
		{
			document.getElementById("premiberkala").value = 900000;  
			kali = 2;
		}
		else if (carabayar == "Tahunan")
		{
			document.getElementById("premiberkala").value = 1400000; 
			kali = 10; 
		}
		*/

	}
	
	function checkedRider(input){
		
		$("#addb").click(function() {
			if (document.getElementById('addb').checked) {
				document.getElementById("juaaddb").disabled = false;
					document.getElementById("juaaddb").value = parseInt(document.getElementById("uangpertanggungan").value);
			}
			else {
				document.getElementById("juaaddb").disabled = true;
				document.getElementById("juaaddb").value = "";
			}
		});
		
		$("#tpd").click(function() {
			if (document.getElementById('tpd').checked) {
				document.getElementById("juatpd").disabled = false;
				document.getElementById("juatpd").value = parseInt(document.getElementById("uangpertanggungan").value);
			}
			else {
				document.getElementById("juatpd").disabled = true;
				document.getElementById("juatpd").value = "";
			}
		});
		
		$("#hcp").click(function() {
			if (document.getElementById('hcp').checked) {
				document.getElementById("dropdownhcp").disabled = false;
				document.getElementById("dropdownhcp").value = 1;
				
				var dropdownhcp = document.getElementById('dropdownhcp');

		switch(dropdownhcp.value)
		{
			case '1':
				juahcp.value = 100000;
				break;	
			case '2':
				juahcp.value = 200000;
				break;
			case '3':
				juahcp.value = 300000;
				break;
			case '4':
				juahcp.value = 400000;
				break;
			case '5':
				juahcp.value = 500000;
				break;
		}	
			}
			else {
						document.getElementById("dropdownhcp").disabled = true;
						document.getElementById("dropdownhcp").value = "";		
						document.getElementById("juahcp").value = "";	
						document.getElementById("dropdownhcpbedah").value = "";		
						document.getElementById("dropdownhcpbedah").disabled = true;
						document.getElementById("juahcpbedah").value = "";		
						
						if (document.getElementById('hcpbedah').checked == true)
					{
						$('#hcpbedah').click();
					}
			
				}
		});
		
		$("#hcpbedah").click(function() {
			if (document.getElementById('hcpbedah').checked) {
			if (document.getElementById('hcp').checked == true){
				
				var dropdownhcp = document.getElementById('dropdownhcp');
				var dropdownhcpbedah = document.getElementById('dropdownhcpbedah');
		var juahcp = document.getElementById('juahcp');	
		var juahcpbedah = document.getElementById('juahcpbedah');	
		
		dropdownhcpbedah.value = dropdownhcp.value;
		juahcpbedah.value = juahcp.value * 10;
		
		}
				else
				{
					alert('Anda Harus Mengambil JS HCP Terlebih Dahulu!');
			$('#hcpbedah').click();
			alert.stop();	
				}
			}
			else {
				document.getElementById("dropdownhcpbedah").value = "";
				document.getElementById("juahcpbedah").value = "";	
			}
		});
		
		
		$("#ci53").click(function() {
			if (document.getElementById('ci53').checked) {
				document.getElementById("juaci53").disabled = false;
				document.getElementById("juaci53").value = parseInt(document.getElementById("uangpertanggungan").value);
			}
			else {
				document.getElementById("juaci53").disabled = true;
				document.getElementById("juaci53").value = "";
			}
		});
		
		$("#termlife").click(function() {
			if (document.getElementById('termlife').checked) {
				document.getElementById("juatermlife").disabled = false;
				document.getElementById("juatermlife").value = parseInt(document.getElementById("uangpertanggungan").value);
			}
			else {
				document.getElementById("juatermlife").disabled = true;
				document.getElementById("juatermlife").value = "";
			}
		});
		
		$("#payorbenefitdeath").click(function() {
			if (document.getElementById("hubungandenganpempol").value == "Anak")
			{
				if (document.getElementById('payorbenefitdeath').checked) {
					document.getElementById("juapayorbenefitdeath").value = parseInt(document.getElementById("minimalua").value / 10);
				}
				else {
					document.getElementById("juapayorbenefitdeath").value = "";
				}
			}
			else
			{
				alert('Hubungan dengan Pemegang Polis harus sama dengan Anak untuk dapat mengambil Rider ini!');							
				document.getElementById('payorbenefitdeath').click();
				document.getElementById('juapayorbenefitdeath').value = "";
				alert.stop();
			}
		});
		
		$("#payorbenefittpd").click(function() {
			if (document.getElementById("hubungandenganpempol").value == "Anak")
			{
				if (document.getElementById('payorbenefittpd').checked) {
					document.getElementById("juapayorbenefittpd").value = parseInt(document.getElementById("minimalua").value / 10);
				}
				else {
					document.getElementById("juapayorbenefittpd").value = "";
				}
			}
			else
			{
				alert('Hubungan dengan Pemegang Polis harus sama dengan Anak untuk dapat mengambil Rider ini!');							
				document.getElementById('payorbenefittpd').click();
				document.getElementById('juapayorbenefittpd').value = "";
				alert.stop();
			}
		});
		
		$("#spousepayordeath").click(function() {
			if (document.getElementById("hubungandenganpempol").value == "Suami/Istri")
			{
				if (document.getElementById('spousepayordeath').checked) {
					document.getElementById("juaspousepayordeath").value = parseInt(document.getElementById("minimalua").value / 10);
				}
				else {
					document.getElementById("juaspousepayordeath").value = "";
				}
			}
			else
			{
				alert('Hubungan dengan Pemegang Polis harus sama dengan Suami/Istri untuk dapat mengambil Rider ini!');							
				document.getElementById('spousepayordeath').click();
				document.getElementById('juaspousepayordeath').value = "";
				alert.stop();
			}
		});
		
		$("#spousepayortpd").click(function() {
			if (document.getElementById("hubungandenganpempol").value == "Suami/Istri")
			{
				if (document.getElementById('spousepayortpd').checked) {
					document.getElementById("juaspousepayortpd").value = parseInt(document.getElementById("minimalua").value / 10);
				}
				else {
					document.getElementById("juaspousepayortpd").value = "";
				}
			}
			else
			{
				alert('Hubungan dengan Pemegang Polis harus sama dengan Suami/Istri untuk dapat mengambil Rider ini!');							
				document.getElementById('spousepayortpd').click();
				document.getElementById('juaspousepayortpd').value = "";
				alert.stop();
			}
		});
		
		$("#wp").click(function() {
			if (document.getElementById('wp').checked) {
				//document.getElementById("juawp").disabled = false;
					
			}
			else {
				//document.getElementById("juawp").disabled = true;
				//document.getElementById("juawp").value = "";
			}
		});
		
	}
	
	function HandleAsumsiCutiTahunan(input){
		
		asumsicutitahunan = document.getElementById('asumsicutitahunan').value 
		
		if (asumsicutitahunan < 3)
		{
			alert('Cuti Tahunan harus lebih dari 2 Tahun');	
			document.getElementById("asumsicutitahunan").value = 15;
		}
		else if (asumsicutitahunan > 99)
		{
			alert('Maksimum Cuti Tahunan sampai dengan 99 Tahun');	
			document.getElementById("asumsicutitahunan").value = 15;
		}
		
	}
	
	function onHandleHubunganDenganPempol(input){
		
		if (document.getElementById("hubungandenganpempol").value == "Suami/Istri")
		{
			document.getElementById("spousepayordeath").disabled = false;	
			document.getElementById("spousepayortpd").disabled = false;	
			document.getElementById("payorbenefitdeath").disabled = true;	
			document.getElementById("payorbenefittpd").disabled = true;	
		}
		else if (document.getElementById("hubungandenganpempol").value == "Anak")
		{
			document.getElementById("payorbenefitdeath").disabled = false;	
			document.getElementById("payorbenefittpd").disabled = false;
			document.getElementById("spousepayordeath").disabled = true;	
			document.getElementById("spousepayortpd").disabled = true;	
		}
		else
		{
			document.getElementById("spousepayordeath").disabled = true;	
			document.getElementById("spousepayortpd").disabled = true;	
			document.getElementById("payorbenefitdeath").disabled = true;	
			document.getElementById("payorbenefittpd").disabled = true;		
		}
	}
	
	function onChangeHCP(input){
		var dropdownhcp = document.getElementById('dropdownhcp');
		var juahcp = document.getElementById('juahcp');
		var dropdownhcpbedah = document.getElementById('dropdownhcpbedah');
		var juahcpbedah = document.getElementById('juahcpbedah');
		
		switch(dropdownhcp.value)
		{
			case '1':
				juahcp.value = 100000;
				break;	
			case '2':
				juahcp.value = 200000;
				break;
			case '3':
				juahcp.value = 300000;
				break;
			case '4':
				juahcp.value = 400000;
				break;
			case '5':
				juahcp.value = 500000;
				break;
		}	
		
		if (dropdownhcp.value < 1)
		{
			alert('Masukkan antara 1 - 5');
			dropdownhcp.value = 1;
			juahcp.value = 100000;
		} 
		else if (dropdownhcp.value > 5)
		{
			alert('Masukkan antara 1 - 5');
			dropdownhcp.value = 1;
			juahcp.value = 100000;
		}
		
		if (document.getElementById('hcpbedah').checked == true)
		{
			dropdownhcpbedah.value = dropdownhcp.value;
			juahcpbedah.value = juahcp.value * 10;
		}
		else 
		{
			dropdownhcpbedah.value = "";
			juahcpbedah.value = "";		
		}
		
	}
	
	function onChangeTanggalLahir(input){
		
		var tanggallahircalontertangggung = document.getElementById('tanggallahircalontertangggung');
		var minimalua = document.getElementById('minimalua');
		var uangpertanggungan = document.getElementById('uangpertanggungan');
		
		if (tanggallahircalontertangggung.length != 0)
		{	
					
		}
		else
		{	
		  alert('Masukkan Tanggal Lahir Terlebih Dahulu!');
		}
		
		
	}
	
	function onChangeUangPertanggungan(input){
		
		var minimalua = document.getElementById('minimalua');
		var maksimalua = document.getElementById('maksimalua');
		var uangpertanggungan = document.getElementById('uangpertanggungan');
		var statusmedical = document.getElementById('statusmedical');
		
		if (minimalua.value != "")
		{
			if ((parseInt(uangpertanggungan.value) < minimalua.value) && (uangpertanggungan.value != 0))
			{
				alert('Uang Asuransi tidak boleh di bawah Minimal UA');
				uangpertanggungan.value = minimalua.value;	
			}		
		}
		if (maksimalua.value != "")
		{
			if ((parseInt(uangpertanggungan.value) > maksimalua.value) && (uangpertanggungan.value != 0))
			{
				alert('Uang Asuransi melebihi batas rekomendasi maksimal Status medical akan secara otomatis di set menjadi : Ya');
				document.getElementById("statusmedical").value = "Ya";
				$('#statusmedical').trigger('change');
			}		
		}
		
	}
	
	$("#hcpjspromapan").change(function() {
		var hcpjspromapan = document.getElementById("hcpjspromapan").value;
		
		if (hcpjspromapan == '1')
		{
			$('#uangasuransihcpjspromapan').prop('disabled', false);
			$('#hcpbjspromapan').prop('disabled', false);
		}
		else if (hcpjspromapan == '0')
		{
			$('#uangasuransihcpjspromapan').prop('disabled', true);
			$('#hcpbjspromapan').prop('disabled', true);
			
			document.getElementById("uangasuransihcpjspromapan").value = 0;
			$('#uangasuransihcpjspromapan').trigger('change');
			
			document.getElementById("hcpbjspromapan").value = 0;
			$('#hcpbjspromapan').trigger('change');
			
		}
	
	});
	
	$("#hcpbjspromapan").change(function() {
		var hcpbjspromapan = document.getElementById("hcpbjspromapan").value;
		
		if (hcpbjspromapan == '1')
		{
			document.getElementById("uangasuransihcpbjspromapan").value = document.getElementById("uangasuransihcpjspromapan").value; 
			$('#uangasuransihcpbjspromapan').trigger('change');
		}
		else if (hcpbjspromapan == '0')
		{
			document.getElementById("uangasuransihcpbjspromapan").value = 0;
			$('#uangasuransihcpbjspromapan').trigger('change');
		}
	
	});
	
	$("#uangasuransihcpjspromapan").change(function() {
			
			//TIDAK DIGUNAKAN (KOSONG)
			var uangasuransihcpjspromapan = document.getElementById("uangasuransihcpjspromapan").value;
			
			// YANG BENAR
			var uahcpjspromapan = document.getElementById("uangasuransihcpjspromapan").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjspromapan = document.getElementById("carabayar").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitungjshcpjspromapan');?>",
						data	: "uangasuransihcpjspromapan"+uangasuransihcpjspromapan+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapan="+carabayarjspromapan+"&uahcpjspromapan="+uahcpjspromapan,
						success : function(data) {
							$("#premihcpjspromapan").val(data);
							
							document.getElementById("totalpremiriderjspromapan1").value = Math.round(parseInt(document.getElementById("premihcpjspromapan").value) + parseInt(document.getElementById("premihcpbjspromapan").value));
							
						}
					});	
					
			var hcpbjspromapan = document.getElementById("hcpbjspromapan").value;
			
			if (hcpbjspromapan == '1')
			{
				document.getElementById("uangasuransihcpbjspromapan").value = document.getElementById("uangasuransihcpjspromapan").value; 
				$('#uangasuransihcpbjspromapan').trigger('change');
			}
			else if (hcpbjspromapan == '0')
			{
				document.getElementById("uangasuransihcpbjspromapan").value = 0;
				$('#uangasuransihcpbjspromapan').trigger('change');
			}
			
			
			
		});
		
		$("#uangasuransihcpbjspromapan").change(function() {
			//TIDAK DIGUNAKAN (KOSONG)
			var uangasuransihcpbjspromapan = document.getElementById("uangasuransihcpbjspromapan").value;
			
			// YANG BENAR
			var uahcpbjspromapan = document.getElementById("uangasuransihcpbjspromapan").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjspromapan = document.getElementById("carabayar").value;
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitunghcpbjspromapan');?>",
						data	: "uangasuransihcpbjspromapan="+uangasuransihcpbjspromapan+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapan="+carabayarjspromapan+"&uahcpbjspromapan="+uahcpbjspromapan,
						success : function(data) {
							$("#premihcpbjspromapan").val(data);
							
							document.getElementById("totalpremiriderjspromapan1").value = Math.round(parseInt(document.getElementById("premihcpjspromapan").value) + parseInt(document.getElementById("premihcpbjspromapan").value));
						}
					});	
			
		});
		
		$("#jstpdjspromapan").change(function() {
			var jstpdjspromapan = document.getElementById("jstpdjspromapan").value;
			
			if (jstpdjspromapan == '1')
			{
				document.getElementById("uangasuransijstpdjspromapan").disabled = false;	
			}
			else if (jstpdjspromapan == '0')
			{
				document.getElementById("uangasuransijstpdjspromapan").disabled = true;
				document.getElementById("premijstpdjspromapan").value = 0;	
				document.getElementById("uangasuransijstpdjspromapan").value = 0;		
			}
			
		});
		
		$("#uangasuransijstpdjspromapan").change(function() {
			var uangasuransijstpdjspromapan = document.getElementById("uangasuransijstpdjspromapan").value;
			
			var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
			
			var carabayarjspromapan = $("#carabayar").val();
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
						type	: "POST",
						url		: "<?=base_url('jspromapan/hitungjstpdjspromapan');?>",
						data	: "uangasuransijstpdjspromapan="+uangasuransijstpdjspromapan+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjspromapan="+carabayarjspromapan,
						success : function(data) {
							$("#premijstpdjspromapan").val(data);
							
						}
					});
			
		});
		
		
		$("#wpjspromapan").change(function() {
			var wpjspromapan = document.getElementById("wpjspromapan").value;
			
			if (wpjspromapan == '1')
			{
				var uangasuransipokok = document.getElementById("uangpertanggungan").value;
				
				var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;
				var carabayarjspromapan = $("#carabayar").val();
				
				var birthday = +new Date(document.getElementById("lahirnasabah").value);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				var masaasuransi = usiasekarang-5;
				
				$.ajax({
							type	: "POST",
							url		: "<?=base_url('jspromapan/hitungjswpjspromapan');?>",
							data	: "uangasuransipokok="+uangasuransipokok+"&usiasekarang="+usiasekarang+"&masaasuransi="+masaasuransi+"&carabayarjspromapan="+carabayarjspromapan,
							success : function(data) {
								$("#premiwpjspromapan").val(data);
								
							}
						});				
			}
			else if (wpjspromapan == '0')
			{	
				document.getElementById("premiwpjspromapan").value = 0;	
				document.getElementById("uangasuransiwpjspromapan").value = 0;	
			}
			
		});
	
</script>

