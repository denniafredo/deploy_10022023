<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
                                                    <div class="col-md-6">
                                                    <h4 class="block">Calon Pemegang Polis</h4>
														<div class="form-group">
  <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span> </label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="calonpemegangpolisperokokjl3" id="calonpemegangpolisperokokjl3" onChange="">
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
          <label class="control-label col-md-4">Nama Calon Tertanggung <span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namacalontertanggung" id="namacalontertanggung" placeholder="Nama Calon Tertanggung"/>
														
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
													  <input class="form-control form-control-inline input-small date-picker" id="tanggallahircalontertangggung" name="tanggallahircalontertangggung" size="16" type="text" value="" placeholder="Tanggal Lahir" onChange=""/>
														<span class="help-block">
															 Masukkan Tanggal Lahir
														</span>
													</div>
		</div>
        
        <div class="form-group">
                                                  <label class="control-label col-md-4">Apakah Perokok? <span class="required"> * </span></label>
                                                  <div class="col-md-6">
										  <select class="form-control" name="calontertanggungperokokjl3" id="calontertanggungperokokjl3" onChange="">
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
													<div class="col-md-12">						
<div class="form-group">
  <label class="control-label col-md-4">Jenis Produk <span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="jenisproduk" id="jenisproduk" onChange="">
                                     <option value="JS LINK EQUITY FUND">JS LINK EQUITY FUND</option>     
                                     <option value="JS LINK BALANCED FUND">JS LINK BALANCED FUND</option>
                                     <option value="JS LINK FIXED INCOME">JS LINK FIXED INCOME</option>
                                     <option value="">[Pilih Cara Bayar]</option>
											</select>
										</div>
									</div>                        								<div class="form-group">
  <label class="control-label col-md-4">Cara Bayar <span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="carabayar" id="carabayar" onChange="">
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
									  <label class="control-label col-md-4">Premi Sesuai Cara Bayar <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Premi Sesuai Cara Bayar" type="number" name="premisesuaicarabayar" id="premisesuaicarabayar" value="0" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">JUA TL1 + TL2 <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="JUA TL1 + TL2 " type="number" name="juatl1tl2" id="juatl1tl2" value="0"  readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
  <label class="control-label col-md-4">Masa Pemb. Premi Yg Dikehendaki <span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="masapemb" id="masapemb" onChange="">
<option value="">[Pilih Masa Pembayaran Premi]</option>
                                    
											</select>
										</div>
                                        <span class="help-block">
															 tahun
														</span>
									</div>
									<div class="form-group">
									  <label class="control-label col-md-4">Asumsi Nilai NAB<span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Asumsi Nilai NAB " type="number" name="asumsinilainab" id="asumsinilainab" value="0"  >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Top Up Berkala<span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Top Up Berkala" type="number" name="topupberkala" id="topupberkala" value="0" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Top Up Sekaligus<span class="required"> * </span> </label>
									  <div class="col-md-3">
		<div class="input-group">
			<input class="form-control" placeholder="Top Up Sekaligus" type="number" name="topupsekaligus" id="topupsekaligus" value="0"  >
			
		</div>
	</div>												 <label id="minimal">Minimal Rp.</label> 											
</div>
<div class="form-group">
  <label class="control-label col-md-4">selama </label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="masatopupsekaligus" id="masatopupsekaligus" onChange="">    
                                     <option value="">[Pilih Masa Pembayaran Top Up]</option>
											</select>
										</div>
                                        <span class="help-block">
															 tahun
														</span>
                                                     
									</div>
													</div>
													<!--/span-->
													
</div>

<br>
<!--
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													<div class="col-md-6">
													  <input class="form-control form-control-inline input-small date-picker" id="saatmulai" name="saatmulai" size="16" type="text" value="" placeholder="Saat Mulai Asuransi" onChange=""/>
														<span class="help-block">
															 Masukkan Saat Mulai Asuransi
														</span>
													</div>
													
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">
																<div class="checkbox-list" data-error-container="#form_2_services_error">
												<label>
												<input type="checkbox" value="1" name="denganbeasiswaunitlink" id="denganbeasiswa" onClick=""/> Dengan Beasiswa </label>
											</div>
                                            <br>
                                        <div class="col-md-6">   
                                        <label>Usia Anak 
										</label>
                                        </div>
										<div class="col-md-6">
											<input type="number" id="usiaanakunitlink" name="usiaanakunitlink" data-required="1" class="form-control" disabled onChange="HandleUsiaAnak()"/>
										</div>
                                        <span class="input-group-btn"><div class="col-md-6" style="display:inline">
                       <label >Tahun</label></div>
                       </span>
                       
                       <br>
                       <div class="row">
													<div class="col-md-5">
														<div class="form-group">
															<label class="control-label col-md-12">Ekspektasi Biaya Pendidikan</label>
													</div>
													</div>
													
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">SD</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="sdunitlink" id="sd" onchange="" disabled value="0" >
			
		</div>
	</div>
													
												</div>
                                                
                                                <div class="form-group">
															<label class="control-label col-md-3">SMP</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="smpunitlink" id="smp" onchange="" disabled value="0" >
			
		</div>
	</div>
												
												</div>
												<div class="form-group">
															<label class="control-label col-md-3">SMA</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="smaunitlink" id="sma" onchange="onHandleSMAValue()" disabled value="0" >
			
		</div>
	</div>
													
												</div>
                                                <div class="form-group">
															<label class="control-label col-md-3">PT</label>
															<div class="col-md-9">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="" type="number" name="ptunitlink" id="pt" onchange="" value="0" readonly>
			
		</div>
	</div>
													
												</div>
               			 </div>
        </div>
														
</div>
													
                    </div>
    </div>
</div-->
<br>

<h3 class="block" align="center">Rider</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-hover" id="datatable_ajax">
								<thead>
								<tr role="row" class="heading">
									
									<th width="33%">
										 Manfaat&nbsp;Tambahan
									</th>
									<th width="33%">
										 Jaminan Uang Asuransi
									</th>
									<th width="33%">
										 Premi Tambahan
									</th>
								</tr>
								<tr role="row" class="filter">
							
									<td>
												<p><input type="checkbox" class="group-checkable" id ="ci"onClick="">Perlindungan thd Penyakit Kritis (CI)</p>
                                                <p style="margin-top:12px"> 
                                                <input type="checkbox" class="group-checkable" id ="pa" onClick="">Personal Accident (PA), UA</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id ="wp" onClick="">Waiver Premium</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="ctt" onClick="">Cacat Tetap Total, UA</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="cpm" onClick="">Cash Plan Murni, Manfaat Harian</p>
                                                <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="cpb" onClick="">Cash Plan Bedah, Manfaat Bedah</p>
                                               <p style="margin-top:12px">
                                                <input type="checkbox" class="group-checkable" id="term" onClick="">Term, UA</p>                                               <td>
                                                <input type="number" class="form-control form-filter input-sm" name="juaci" id="juaci" disabled onChange="" value="0" >
                                                <input type="number" class="form-control form-filter input-sm" name="juapa" id="juapa" disabled style="margin-top:5px" onChange="" value="0" >
                                                <input type="number" class="form-control form-filter input-sm" name="juawp" id="juawp" style="margin-top:5px" disabled readonly value="0" >
                                                <input type="number" class="form-control form-filter input-sm" name="juactt" id="juactt" disabled style="margin-top:5px" onChange="" value="0" >

<div class="row" style="margin-top:5px">


<div class="col-md-3">																<select class="form-control select2me" name="dropdowncpm" id="dropdowncpm" disabled>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
                                    
											</select></div>															<div class="col-md-9">															<input type="number" class="form-control form-filter input-sm" name="juacpm" id="juacpm" disabled value="0" >														</div>
													<!--/span-->
												
                                        </div>
                                                <div class="row" style="margin-top:5px">


<div class="col-md-3">																<select class="form-control select2me" name="dropdowncpb" id="dropdowncpb" disabled>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
                                    
											</select></div>																<div class="col-md-9">															<input type="number" class="form-control form-filter input-sm" name="juacpb" id="juacpb" disabled value="0" > 														</div>

													<!--/span-->
												
                                        </div>
                                                <input type="number" class="form-control form-filter" name="juaterm" id="juaterm" disabled style="margin-top:5px" onChange="" value="0" >
                                                
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="premitambahanci" id="premitambahanci" disabled value="0" >
                                        <input type="text" class="form-control form-filter input-sm" name="premitambahanpa" id="premitambahanpa" disabled style="margin-top:5px" value="0" >
                                        <input type="text" class="form-control form-filter input-sm" name="premitambahanwp" id="premitambahanwp" disabled readonly style="margin-top:5px" value="0" >
                                        <input type="text" class="form-control form-filter input-sm" name="premitambahanctt" id="premitambahanctt" disabled style="margin-top:5px"value="0" >
                                        <input type="text" class="form-control form-filter input-sm" name="premitambahancpm" id="premitambahancpm" disabled style="margin-top:5px"value="0" >
                                        <input type="text" class="form-control form-filter input-sm" name="premitambahancpb" id="premitambahancpb" disabled style="margin-top:5px"value="0" >
                                        <input type="text" class="form-control form-filter input-sm" name="premitambahanterm" id="premitambahanterm" disabled style="margin-top:5px;height:34px" value="0" >
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
</table>
</div>
</div>
<br>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-12">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">
															
                                            <br>
                                            
        <div class="form-group">
          <label class="control-label col-md-4">Total Premi Sesuai Cara Bayar<span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="totalpremisesuaicarabayar" id="totalpremisesuaicarabayar" placeholder="Total Premi Sesuai Cara Bayar" readonly value="0" />
														
													</div>
                                                    
		</div>
        <div class="form-group">
          <label class="control-label col-md-4">Kesanggupan Membayar Premi (Lebih Besar dari Total Premi sesuai Cr Bayar) </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="kesanggupanbayar" id="kesanggupanbayar" placeholder="" value="0" />
														
													</div>
<span class="help-block">
															 * Kelipatan 100.000
														</span>                                       
		</div>                                        

                       <br>									
</div>
													<!--/span-->
   		 </div>
    </div>
</div>
<script>
jQuery(document).ready(function() {       
       // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
	   $("#saatmulai").datepicker("setDate", new Date());
	   
	  $("#tertanggungsamadenganpemegangpolis").click(function() {	
				
				if (document.getElementById('tertanggungsamadenganpemegangpolis').checked) {
					
				document.getElementById("namacalontertanggung").value = document.getElementById("namanasabah").value; 
				document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
				$('#tanggallahircalontertanggung').trigger('change');
				document.getElementById("calontertanggungperokokjl3").value = document.getElementById("calonpemegangpolisperokokjl3").value;
					
				if (document.getElementById('gendernasabah').value == "M") {
				document.getElementById("jeniskelamincalontertanggung").value = "Laki-Laki";
$('#jeniskelamincalontertanggung').trigger('change');
				
}
				else if (document.getElementById('gendernasabah').value == "F") {
				document.getElementById("jeniskelamincalontertanggung").value="Perempuan";
				$('#jeniskelamincalontertanggung').trigger('change');
				

				//document.getElementById("minimalua").value = usiasekarang.value;
				}
				
			var carabayar = $("#carabayar").val();
			
			var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
			var birthday = +new Date(tanggallahircalontertangggung);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			
				if (usiasekarang > 60)
				{
					alert('Untuk usia > 60 tahun maka carabayar harus sekaligus.');	
					
					document.getElementById('carabayar').value = "Sekaligus";	
					$('#carabayar').trigger('change');			
					document.getElementById('premisesuaicarabayar').value = 12000000;
					faktorpengali = ((125+10) / 100);
					document.getElementById('juatl1tl2').value = Math.round(faktorpengali * document.getElementById('premisesuaicarabayar').value);
					document.getElementById('carabayar').disabled = true;
					
					$.ajax({
					type	: "POST",
					url		: "<?=base_url('jl3/masapembpremi');?>",
					data	: "usiasekarang="+usiasekarang,
					success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 1 ; $i <= 1 ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
					},
					complete: function(){
					}
					
					});
					$.ajax({
					type	: "POST",
					url		: "<?=base_url('jl3/masatopupsekaligus');?>",
					data	: "usiasekarang="+usiasekarang,
					success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
					},
					complete: function(){
					}
					
					});
				}
				else if (usiasekarang < 17)
				{
					alert('Usia minimal 17 tahun!');
					
					document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
				$('#tanggallahircalontertanggung').trigger('change');
				}
				else 
				{
					document.getElementById('carabayar').disabled = false;	
					
					if (carabayar == "Bulanan")
					{	
					document.getElementById('premisesuaicarabayar').value = 300000;
					faktorpengali = 30;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
					else if (carabayar == "Kuartalan")
					{	
					document.getElementById('premisesuaicarabayar').value = 500000;
					faktorpengali = 18;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					
					}
					else if (carabayar == "Semesteran")
					{	
					document.getElementById('premisesuaicarabayar').value = 750000;
					faktorpengali = 12;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
					else if (carabayar == "Tahunan")
					{	
					document.getElementById('premisesuaicarabayar').value = 1500000;
					faktorpengali = 6;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
					else if (carabayar == "Sekaligus")
					{	
					document.getElementById('premisesuaicarabayar').value = 12000000;
					faktorpengali = ((125+10) / 100);
					document.getElementById('juatl1tl2').value = Math.round(faktorpengali * document.getElementById('premisesuaicarabayar').value);
					}
					
					$.ajax({
					type	: "POST",
					url		: "<?=base_url('jl3/masapembpremi');?>",
					data	: "usiasekarang="+usiasekarang,
					success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 5 ; $i < 66- data ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
					},
					complete: function(){
					}
					
					});
					$.ajax({
					type	: "POST",
					url		: "<?=base_url('jl3/masatopupsekaligus');?>",
					data	: "usiasekarang="+usiasekarang,
					success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
					},
					complete: function(){
					}
					
					});
				}
				 
				} 
				
				else {

					document.getElementById("namacalontertanggung").value = ""; 
					document.getElementById("tanggallahircalontertangggung").value = ""; 
					document.getElementById('jeniskelamincalontertanggung').value = "";
					$('#jeniskelamincalontertanggung').trigger('change');
					document.getElementById("premisesuaicarabayar").value = 0; 
					document.getElementById("juatl1tl2").value = 0; 
					$("#masapemb").empty();
					$i = "["+"Pilih Masa Pembayaran Premi"+"]";
					$("#masapemb").append('<option value="">'+$i+'</option>');
					$('#masapemb').trigger('change');
					$("#masatopupsekaligus").empty();
					$j = "["+"Pilih Masa Pembayaran Top Up Sekaligus"+"]";
					$("#masatopupsekaligus").append('<option value="">'+$j+'</option>');
					$('#masatopupsekaligus').trigger('change');
					document.getElementById('carabayar').disabled = false;	
					document.getElementById('carabayar').value = "";	
					$('#carabayar').trigger('change');
					document.getElementById("asumsinilainab").value = 0; 
					document.getElementById("topupberkala").value = 0; 
					document.getElementById("topupsekaligus").value = 0; 
					document.getElementById("calontertanggungperokokjl3").value = ""; 
				}
				
			
			});
			
			  $("#tanggallahircalontertangggung").change(function() {	
				var carabayar = $("#carabayar").val();
				
				var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
				var birthday = +new Date(tanggallahircalontertangggung);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
			
			if (usiasekarang > 60)
			{
				alert('Untuk usia > 60 tahun maka carabayar harus sekaligus.');	
				
				document.getElementById('carabayar').value = "Sekaligus";	
				$('#carabayar').trigger('change');			
				document.getElementById('premisesuaicarabayar').value = 12000000;
				faktorpengali = ((125+10) / 100);
				document.getElementById('juatl1tl2').value = Math.round(faktorpengali * document.getElementById('premisesuaicarabayar').value);
				document.getElementById('carabayar').disabled = true;
				
				$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
				$("#masapemb").empty();
				//$.each(data, function(i, item)
				//{
				for ($i = 1 ; $i <= 1 ; $i++)
				{
				$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
				$('#masapemb').trigger('change');
				}
					
				//});
				},
				complete: function(){
				}
				
				});
				$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
				$("#masatopupsekaligus").empty();
				//$.each(data, function(i, item)
				//{
					for ($i = 1 ; $i < 66- data ; $i++)
					{
					
					$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masatopupsekaligus').trigger('change');
					}
					
				//});
				},
				complete: function(){
				}
				
				});
			}
			else if (usiasekarang < 17)
			{
				alert('Usia minimal 17 tahun!');
				
				document.getElementById("tanggallahircalontertangggung").value = document.getElementById("lahirnasabah").value; 
			$('#tanggallahircalontertanggung').trigger('change');
			}
			else
			{
				$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 5 ; $i < 66- data ; $i++)
						{
						$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
						
						}
						
					//});
				},
				complete: function(){
				}
				
				});
				$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						
						}
						
					//});
				},
				complete: function(){
				}
				
				});
			}
			 
			});
			
			$("#carabayar").change(function() {	
				var carabayar = $("#carabayar").val();
				
				var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
				var birthday = +new Date(tanggallahircalontertangggung);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				if (carabayar == "Bulanan")
				{	
					document.getElementById('premisesuaicarabayar').value = 300000;
					faktorpengali = 30;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					document.getElementById('topupberkala').disabled = false;	
					document.getElementById('topupberkala').value = 0;
					$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 5 ; $i < 66- data ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
				},
				complete: function(){
				}
				
			});
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
				},
				complete: function(){
				}
				
			});
				}
				else if (carabayar == "Kuartalan")
				{	
					document.getElementById('premisesuaicarabayar').value = 500000;
					faktorpengali = 18;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					document.getElementById('topupberkala').disabled = false;	
					document.getElementById('topupberkala').value = 0;
					
					$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 5 ; $i < 66- data ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
				},
				complete: function(){
				}
				
			});
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
				},
				complete: function(){
				}
				
			});
				}
				else if (carabayar == "Semesteran")
				{	
					document.getElementById('premisesuaicarabayar').value = 750000;
					faktorpengali = 12;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					document.getElementById('topupberkala').disabled = false;	
					document.getElementById('topupberkala').value = 0;
					$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 5 ; $i < 66- data ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
				},
				complete: function(){
				}
				
			});
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
				},
				complete: function(){
				}
				
			});
				}
				else if (carabayar == "Tahunan")
				{	
					document.getElementById('premisesuaicarabayar').value = 1500000;
					faktorpengali = 6;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					document.getElementById('topupberkala').disabled = false;	
					document.getElementById('topupberkala').value = 0;
					$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 5 ; $i < 66- data ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
				},
				complete: function(){
				}
				
			});
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
				},
				complete: function(){
				}
				
			});
				}
				else if (carabayar == "Sekaligus")
				{	
					document.getElementById('premisesuaicarabayar').value = 12000000;
					faktorpengali = ((125+10) / 100);
					document.getElementById('juatl1tl2').value = Math.round(faktorpengali * document.getElementById('premisesuaicarabayar').value);
					document.getElementById('topupberkala').disabled = true;	
					document.getElementById('topupberkala').value = 0;
					$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masapembpremi');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masapemb").empty();
					//$.each(data, function(i, item)
					//{
					for ($i = 1 ; $i <= 1 ; $i++)
					{
					$("#masapemb").append('<option value="'+$i+'">'+$i+'</option>');
					$('#masapemb').trigger('change');
					}
						
					//});
				},
				complete: function(){
				}
				
			});
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jl3/masatopupsekaligus');?>",
				data	: "usiasekarang="+usiasekarang,
				success : function(data) {
					$("#masatopupsekaligus").empty();
					//$.each(data, function(i, item)
					//{
						for ($i = 1 ; $i < 66- data ; $i++)
						{
						$("#masatopupsekaligus").append('<option value="'+$i+'">'+$i+'</option>');
						$('#masatopupsekaligus').trigger('change');
						}
						
					//});
				},
				complete: function(){
				}
				
			});
				}
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				
				$('#totalpremisesuaicarabayar').trigger('change');
				
			});
			
			$("#topupberkala").change(function() {	
			
				var topupberkala = document.getElementById('topupberkala').value;
				
				if ((topupberkala > 0)  && (topupberkala < 1000))
				{	
					document.getElementById('topupberkala').value = 1000;
				}
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
			
			});
			
			$("#premisesuaicarabayar").change(function() {	
				var carabayar = $("#carabayar").val();
				var faktorpengali;
				var minimalpremi;
				if (carabayar == "Bulanan")
				{	
					minimalpremi = 300000;
					if (document.getElementById('premisesuaicarabayar').value < minimalpremi)
					{
						alert('Minimal Premi '+minimalpremi);				
						
						document.getElementById('premisesuaicarabayar').value = minimalpremi;
					}
					else
					{
					faktorpengali = 30;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
				}
				else if (carabayar == "Kuartalan")
				{
					minimalpremi = 500000;
					if (document.getElementById('premisesuaicarabayar').value < minimalpremi)
					{
						alert('Minimal Premi '+minimalpremi);				
						
						document.getElementById('premisesuaicarabayar').value = minimalpremi;
					}
					else
					{
					faktorpengali = 18;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
					
				}
				else if (carabayar == "Semesteran")
				{	
					minimalpremi = 750000;
					if (document.getElementById('premisesuaicarabayar').value < minimalpremi)
					{
						alert('Minimal Premi '+minimalpremi);				
						
						document.getElementById('premisesuaicarabayar').value = minimalpremi;
					}
					else
					{
					faktorpengali = 12;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
				}
				else if (carabayar == "Tahunan")
				{	
					minimalpremi = 1500000;
					if (document.getElementById('premisesuaicarabayar').value < minimalpremi)
					{
						alert('Minimal Premi '+minimalpremi);				
						
						document.getElementById('premisesuaicarabayar').value = minimalpremi;
					}
					else
					{
					faktorpengali = 6;
					document.getElementById('juatl1tl2').value = faktorpengali * document.getElementById('premisesuaicarabayar').value;
					}
				}
				else if (carabayar == "Sekaligus")
				{	
					minimalpremi = 12000000;
					if (document.getElementById('premisesuaicarabayar').value < minimalpremi)
					{
						alert('Minimal Premi '+minimalpremi);				
						
						document.getElementById('premisesuaicarabayar').value = minimalpremi;
					}
					else
					{
					faktorpengali = ((125+10) / 100);
					document.getElementById('juatl1tl2').value = Math.round(faktorpengali * document.getElementById('premisesuaicarabayar').value);
					}
				}

				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				
				$('#totalpremisesuaicarabayar').trigger('change');
				
			});
			
			$("#asumsinilainab").change(function() {
			var asumsinilainab = $("#asumsinilainab").val();
			document.getElementById('minimal').innerHTML = "Minimal Rp. "+(asumsinilainab * 1000);
			var topupsekaligus = $("#topupsekaligus").val();
			if (topupsekaligus > 0)
			{
				if ((document.getElementById('topupsekaligus').value) < (1000 * asumsinilainab))			
				{
					alert('Minimal Top Up Sekaligus '+(1000 * asumsinilainab));
					
					document.getElementById('topupsekaligus').value	= (1000 * asumsinilainab);
				}
			}
			});	
			
			$("#topupsekaligus").change(function() {
			var asumsinilainab = $("#asumsinilainab").val();
			var topupsekaligus = $("#topupsekaligus").val();
			if (topupsekaligus > 0)
			{
				if ((document.getElementById('topupsekaligus').value) < (1000 * asumsinilainab))			
				{
					alert('Minimal Top Up Sekaligus '+(1000 * asumsinilainab));
					
					document.getElementById('topupsekaligus').value	= (1000 * asumsinilainab);
				}
			}
			});	
			
			 $('#denganbeasiswa').click(function () {
				if ($(this).prop('checked')) {  
				document.getElementById('usiaanakunitlink').disabled = false;       
				document.getElementById('sd').disabled = false;
				document.getElementById('smp').disabled = false;
				document.getElementById('sma').disabled = false;
				}
				else {
						document.getElementById('usiaanakunitlink').disabled = true;       
				document.getElementById('sd').disabled = true;
				document.getElementById('smp').disabled = true;
				document.getElementById('sma').disabled = true;
				
				document.getElementById('usiaanakunitlink').value = 0;       
				document.getElementById('sd').value = 0;
				document.getElementById('smp').value = 0;
				document.getElementById('sma').value = 0;
				document.getElementById('pt').value = 0;
				}
			});	
			
			//USIA ANAK
			
			 $("#usiaanakunitlink").change(function() {	
			 	var usiaanak = document.getElementById('usiaanakunitlink').value;
				var batasusiaanak = 13;
				
				if ((usiaanak < 0) || (usiaanak > batasusiaanak))
				{
					alert ('Isi Usia Anak antara 0 sampai  '+batasusiaanak+' tahun!');
					
					document.getElementById('usiaanakunitlink').value = 0;	
				}
			});	 
			
			$('#sma').change(function () {
				
				document.getElementById('pt').value = 2* document.getElementById('sma').value;
				
			});	
			
			// RIDER
			$('#ci').click(function () {
				if ($(this).prop('checked')) {  
				document.getElementById('juaci').disabled = false; 
				
				//document.getElementById('juaci').value = 5000000;
				
				
					
				var masapemb = $("#masapemb").val();
				
				var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
				var birthday = +new Date(tanggallahircalontertangggung);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				
				var carabayar = $("#carabayar").val();	
				
				var premisesuaicarabayar = $("#premisesuaicarabayar").val();	
				
				if (carabayar == "Bulanan")
				{
					faktorcb = 95/1000;
					document.getElementById('juaci').value = 25 * premisesuaicarabayar;
					var juaci =$("#juaci").val();
				}
				else if (carabayar == "Kuartalan")
				{
					faktorcb = 27/100;
					document.getElementById('juaci').value = 15 * premisesuaicarabayar;
					var juaci =$("#juaci").val();
				}
				else if (carabayar == "Semesteran")
				{
					faktorcb = 52/100;
					document.getElementById('juaci').value = 10 * premisesuaicarabayar;
					var juaci =$("#juaci").val();
				}
				else if (carabayar == "Tahunan")
				{
					faktorcb = 1;
					document.getElementById('juaci').value = 5 * premisesuaicarabayar;
					var juaci =$("#juaci").val();
				}
				else if (carabayar == "Sekaligus")
				{
					faktorcb = 1;
					document.getElementById('juaci').value = 1 * premisesuaicarabayar;
					var juaci =$("#juaci").val();
				}
					
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jl3/hitungpremitambahanCI');?>",
					data	: "juaci="+juaci+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#premitambahanci").val(data);
						document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
						
					}
				});    
				  
				}
				else {
				document.getElementById('juaci').disabled = true;       
				document.getElementById('premitambahanci').disabled = true;

				document.getElementById('juaci').value = 0;       
				document.getElementById('premitambahanci').value = 0;    
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				   
				}
				
				
			});	
			
			$('#juaci').change(function () {
				if ($('#ci').prop('checked')) {  
					document.getElementById('juaci').disabled = false; 
					
					var juaci =$("#juaci").val();
						
					var masapemb = $("#masapemb").val();
					
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					var carabayar = $("#carabayar").val();	
				
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						var premisesuaicarabayarmin = 25 * premisesuaicarabayar;	
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Kuartalan")
					{
						var premisesuaicarabayarmin = 15 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Semesteran")
					{
						var premisesuaicarabayarmin = 10 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Tahunan")
					{
						var premisesuaicarabayarmin = 5 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Sekaligus")
					{
						var premisesuaicarabayarmin = 1 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					
					if (juaci < premisesuaicarabayarmin)
					{
						alert('JUA Minimal '+premisesuaicarabayarmin+'!');	
						
						document.getElementById('juaci').value = premisesuaicarabayarmin;
					}
					else if ((juaci > premisesuaicarabayarmax) || (juaci > 500000000))
					{
						alert('JUA Maksimal 3 kali TL1 atau Maksimal 500000000!');	
						
						document.getElementById('juaci').value = premisesuaicarabayarmin;
					}
					else
					{
					
						if (carabayar == "Bulanan")
						{
							faktorcb = 95/1000;
						}
						else if (carabayar == "Kuartalan")
						{
							faktorcb = 27/100;
						}
						else if (carabayar == "Semesteran")
						{
							faktorcb = 52/100;
						}
						else if (carabayar == "Tahunan")
						{
							faktorcb = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							faktorcb = 1;
						}
							
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jl3/hitungpremitambahanCI');?>",
							data	: "juaci="+juaci+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
							success : function(data) {
								$("#premitambahanci").val(data);
								
								document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
								
							}
						});  
					
					}
					  
					}
					else {
							document.getElementById('juaci').disabled = true;       
					document.getElementById('premitambahanci').disabled = true;
	
					document.getElementById('juaci').value = 0;       
					document.getElementById('premitambahanci').value = 0;   
					
					document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
					    
					}	
			});	
			
			$('#pa').click(function () {
				if ($(this).prop('checked')) {  
				
					document.getElementById('juapa').disabled = false;
					
					document.getElementById('juapa').value = 5000000;
				
					var juapa = $("#juapa").val();
					
					var masapemb = $("#masapemb").val();
					
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 95/1000;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 27/100;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 52/100;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jl3/hitungpremitambahanPA');?>",
						data	: "juapa="+juapa+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
						success : function(data) {
							$("#premitambahanpa").val(data);
							document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
							
						}
					});       
				}
				else {
						document.getElementById('juapa').disabled = true;       
				document.getElementById('premitambahanpa').disabled = true;

				document.getElementById('juapa').value = 0;       
				document.getElementById('premitambahanpa').value = 0;   
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				    
				}
			});	
			
			$('#juapa').change(function () {
			if ($('#pa').prop('checked')) {  
				
					document.getElementById('juapa').disabled = false;
						
					var juapa = $("#juapa").val();
					
					var masapemb = $("#masapemb").val();
					
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					
					var carabayar = $("#carabayar").val();	
					
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						var premisesuaicarabayarmin = 25 * premisesuaicarabayar;	
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Kuartalan")
					{
						var premisesuaicarabayarmin = 15 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Semesteran")
					{
						var premisesuaicarabayarmin = 10 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Tahunan")
					{
						var premisesuaicarabayarmin = 5 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Sekaligus")
					{
						var premisesuaicarabayarmin = 1 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					
					if (juapa < premisesuaicarabayarmin)
					{
						alert('JUA Minimal '+premisesuaicarabayarmin+'!');	
						
						document.getElementById('juapa').value = premisesuaicarabayarmin;
					}
					else if ((juapa > premisesuaicarabayarmax) || (juapa > 500000000))
					{
						alert('JUA Maksimal 3 kali TL1 atau Maksimal 500000000!');	
						
						document.getElementById('juapa').value = premisesuaicarabayarmin;
					}
					else
					{
					
						if (carabayar == "Bulanan")
						{
							faktorcb = 95/1000;
						}
						else if (carabayar == "Kuartalan")
						{
							faktorcb = 27/100;
						}
						else if (carabayar == "Semesteran")
						{
							faktorcb = 52/100;
						}
						else if (carabayar == "Tahunan")
						{
							faktorcb = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							faktorcb = 1;
						}
							
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jl3/hitungpremitambahanPA');?>",
							data	: "juapa="+juapa+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
							success : function(data) {
								$("#premitambahanpa").val(data);
								
								document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
								
							}
						}); 
					}
				}
				else {
						document.getElementById('juapa').disabled = true;       
				document.getElementById('premitambahanpa').disabled = true;

				document.getElementById('juapa').value = 0;       
				document.getElementById('premitambahanpa').value = 0;  
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				     
				}	
			});
			
			$('#wp').click(function () {
				if ($(this).prop('checked')) {  
				document.getElementById('juawp').disabled = false;   

				var carabayar = $("#carabayar").val();	
				var premisesuaicarabayar = $("#premisesuaicarabayar").val();
				var masapembpremi = $("#masapemb").val();	
				var kali;
				
				var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
				var birthday = +new Date(tanggallahircalontertangggung);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
				
				if (carabayar == "Bulanan")
				{
					kali = 12;
				
				}
				else if (carabayar == "Kuartalan")
				{
					kali = 4;
					
				}
				else if (carabayar == "Semesteran")
				{
					kali = 2;
			
				}
				else if (carabayar == "Tahunan")
				{
					kali = 1;
				
				}
				else if (carabayar == "Sekaligus")
				{
					kali = 0;
					
				}
				
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jl3/hitungjuaWP');?>",
					data	: "premisesuaicarabayar="+premisesuaicarabayar+"&masapembpremi="+masapembpremi+"&kali="+kali,
					success : function(data) {
					$("#juawp").val(data);
					
					var juawp = $("#juawp").val();
					
					var masapembpremi = $("#masapembpremi").val();
					var usia = $("#usia").val();
					
					var carabayar = $("#carabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 95/1000;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 27/100;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 52/100;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
					
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jl3/hitungpremitambahanWP');?>",
						data	: "juawp="+juawp+"&masapembpremi="+masapembpremi+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
						success : function(data) {
						$("#premitambahanwp").val(data);
						
						document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
						
						}
					
					});	
					
					}
				
				});
					
				}
				else {
				document.getElementById('juawp').disabled = true;       
				document.getElementById('premitambahanwp').disabled = true;

				document.getElementById('juawp').value = 0;       
				document.getElementById('premitambahanwp').value = 0;   
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				    
				}
			});	
			
			
			$('#ctt').click(function () {
				if ($(this).prop('checked')) {  
					
					document.getElementById('juactt').disabled = false; 
					//document.getElementById('juactt').value = 5000000;  
				
					//var juactt = $("#juactt").val();
					
					var masapemb = $("#masapemb").val();
					
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					var carabayar = $("#carabayar").val();	
					
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 95/1000;
						document.getElementById('juactt').value = 25 * premisesuaicarabayar;
						var juactt =$("#juactt").val();
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 27/100;
						document.getElementById('juactt').value = 15 * premisesuaicarabayar;
						var juactt =$("#juactt").val();
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 52/100;
						document.getElementById('juactt').value = 10 * premisesuaicarabayar;
						var juactt =$("#juactt").val();
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
						document.getElementById('juactt').value = 5 * premisesuaicarabayar;
						var juactt =$("#juactt").val();
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
						document.getElementById('juactt').value = 1 * premisesuaicarabayar;
						var juactt =$("#juactt").val();
					}
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jl3/hitungpremitambahanCTT');?>",
						data	: "juactt="+juactt+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
						success : function(data) {
						parseInt($("#premitambahanctt").val(data)*1000);
						
						document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
						
						}
					});
				     
				}
				else {
						document.getElementById('juactt').disabled = true;       
				document.getElementById('premitambahanctt').disabled = true;

				document.getElementById('juactt').value = 0;       
				document.getElementById('premitambahanctt').value = 0;  
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				     
				}
			});	
			
			$('#juactt').change(function () {
				if ($('#ctt').prop('checked')) {  
						
						document.getElementById('juactt').disabled = false; 
						
						var juactt = $("#juactt").val();
						
						var masapemb = $("#masapemb").val();
						
						var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
						var birthday = +new Date(tanggallahircalontertangggung);
						var now = Date.now("MM-dd-yyyy");
						var sls =((now - birthday) / 31557600000);
						var usiasekarang = Math.floor(sls);
						
						var carabayar = $("#carabayar").val();	
					
						var premisesuaicarabayar = $("#premisesuaicarabayar").val();	
						
						if (carabayar == "Bulanan")
						{
							var premisesuaicarabayarmin = 25 * premisesuaicarabayar;	
							var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
						}
						else if (carabayar == "Kuartalan")
						{
							var premisesuaicarabayarmin = 15 * premisesuaicarabayar;
							var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
						}
						else if (carabayar == "Semesteran")
						{
							var premisesuaicarabayarmin = 10 * premisesuaicarabayar;
							var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
						}
						else if (carabayar == "Tahunan")
						{
							var premisesuaicarabayarmin = 5 * premisesuaicarabayar;
							var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
						}
						else if (carabayar == "Sekaligus")
						{
							var premisesuaicarabayarmin = 1 * premisesuaicarabayar;
							var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
						}	
						
						if (juactt < premisesuaicarabayarmin)
						{
							alert('JUA Minimal '+premisesuaicarabayarmin+'!');	
							
							document.getElementById('juactt').value = premisesuaicarabayarmin;
						}
						else if ((juactt > premisesuaicarabayarmax) || (juactt > 500000000))
						{
							alert('JUA Maksimal 3 kali TL1 atau Maksimal 500000000!');	
							
							document.getElementById('juactt').value = premisesuaicarabayarmin;
						}
						else
						{
						
							if (carabayar == "Bulanan")
							{
								faktorcb = 95/1000;
							}
							else if (carabayar == "Kuartalan")
							{
								faktorcb = 27/100;
							}
							else if (carabayar == "Semesteran")
							{
								faktorcb = 52/100;
							}
							else if (carabayar == "Tahunan")
							{
								faktorcb = 1;
							}
							else if (carabayar == "Sekaligus")
							{
								faktorcb = 1;
							}
								
							$.ajax({
								type	: "POST",
								url		: "<?=base_url('jl3/hitungpremitambahanCTT');?>",
								data	: "juactt="+juactt+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
								success : function(data) {
								$("#premitambahanctt").val(data);
								
								document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
								
								}
							});
						}
					}
					else {
					document.getElementById('juactt').disabled = true;       
					document.getElementById('premitambahanctt').disabled = true;
	
					document.getElementById('juactt').value = 0;       
					document.getElementById('premitambahanctt').value = 0;    
					
					document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
					   
					}	
			});	
			
			$('#cpm').click(function () {
				if ($(this).prop('checked')) {  
					document.getElementById('dropdowncpm').disabled = false;  
					
					document.getElementById('juacpm').value = document.getElementById('dropdowncpm').value * 100000;
					
					var kodetarif;
					
					var gendernasabah = $("#gendernasabah").val();	
					
					if (gendernasabah == "M")
					{
						kodetarif = "CPML";	
					}
					else if (gendernasabah == "F")
					{
						kodetarif = "CPMP";
					}
				   
				   	var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
				   
				   	var usia;
					
				   	if (usia < 20)
					{
						usia = 20;	
					}
					else
					{
						usia = usiasekarang;
					}
					
					var masacpm =$("#dropdowncpm").val();
					
					var carabayar = $("#carabayar").val();	
					
					var faktorcb;
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 95/1000;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 27/100;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 52/100;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
					
				   	$.ajax({
						type	: "POST",
						url		: "<?=base_url('jl3/hitungpremitambahanCPM');?>",
						data	: "masacpm="+masacpm+"&usia="+usia+"&faktorcb="+faktorcb+"&kodetarif="+kodetarif,
						success : function(data) {
							$("#premitambahancpm").val(data);
							
							document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
							
						}
					});
				}
				else {
					document.getElementById('dropdowncpm').disabled = true;       
					document.getElementById('premitambahancpm').disabled = true;
					
					document.getElementById('dropdowncpm').value = 1;  
					$('#dropdowncpm').trigger('change');
					document.getElementById('juacpm').value = 0;         
					document.getElementById('premitambahancpm').value = 0;  
					
					document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);

				}
			});	
			
			$('#dropdowncpm').change(function () {			
				var kodetarif;
						
				var gendernasabah = $("#gendernasabah").val();
				
				var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
				var birthday = +new Date(tanggallahircalontertangggung);
				var now = Date.now("MM-dd-yyyy");
				var sls =((now - birthday) / 31557600000);
				var usiasekarang = Math.floor(sls);
			   
				var usia;
				
				var masacpm =$("#dropdowncpm").val();
					
				var carabayar = $("#carabayar").val();	
				
				var faktorcb;
				
				
				if ($('#cpm').prop('checked')) { 
					document.getElementById('juacpm').value = document.getElementById('dropdowncpm').value * 100000;
					

					if (gendernasabah == "M")
					{
						kodetarif = "CPML";	
					}
					else if (gendernasabah == "F")
					{
						kodetarif = "CPMP";
					}
				   

				   	if (usia < 20)
					{
						usia = 20;	
					}
					else
					{
						usia = usiasekarang;
					}
					

					if (carabayar == "Bulanan")
					{
						faktorcb = 95/1000;
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 27/100;
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 52/100;
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
					}
					
				   	$.ajax({
						type	: "POST",
						url		: "<?=base_url('jl3/hitungpremitambahanCPM');?>",
						data	: "masacpm="+masacpm+"&usia="+usia+"&faktorcb="+faktorcb+"&kodetarif="+kodetarif,
						success : function(data) {
							$("#premitambahancpm").val(data);
							
							document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
							
						}
					});
					
					if ($('#cpb').prop('checked')) 
					{
						document.getElementById('dropdowncpb').value = document.getElementById('dropdowncpm').value;
						$('#dropdowncpb').trigger('change');
						
						document.getElementById('juacpb').value = document.getElementById('dropdowncpb').value * 100000;
						
						var masacpb =$("#dropdowncpb").val();
						
						if (gendernasabah == "M")
						{
							kodetarif = "CPBL";	
						}
						else if (gendernasabah == "F")
						{
							kodetarif = "CPBP";
						}
						
						
						if (usia < 20)
						{
							usia = 20;	
						}
						else
						{
							usia = usiasekarang;
						}
						
						
						if (carabayar == "Bulanan")
						{
							faktorcb = 95/1000;
						}
						else if (carabayar == "Kuartalan")
						{
							faktorcb = 27/100;
						}
						else if (carabayar == "Semesteran")
						{
							faktorcb = 52/100;
						}
						else if (carabayar == "Tahunan")
						{
							faktorcb = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							faktorcb = 1;
						}
						
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jl3/hitungpremitambahanCPB');?>",
							data	: "masacpb="+masacpb+"&usia="+usia+"&faktorcb="+faktorcb+"&kodetarif="+kodetarif,
							success : function(data) {
							$("#premitambahancpb").val(data);
							
							document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
							
							}
						});
						
					}
				
				}
				
				
			
			});	
			
			$('#cpb').click(function () {
				if (document.getElementById('cpm').checked == true) { 
					if ($(this).prop('checked')) {   					
						document.getElementById('dropdowncpb').value =document.getElementById('dropdowncpm').value;
						$('#dropdowncpb').trigger('change');
						
						document.getElementById('juacpb').value = document.getElementById('dropdowncpb').value * 1000000;
						
						var kodetarif;
						
						var gendernasabah = $("#gendernasabah").val();	
						
						if (gendernasabah == "M")
						{
							kodetarif = "CPBL";	
						}
						else if (gendernasabah == "F")
						{
							kodetarif = "CPBP";
						}
					   
						var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
						var birthday = +new Date(tanggallahircalontertangggung);
						var now = Date.now("MM-dd-yyyy");
						var sls =((now - birthday) / 31557600000);
						var usiasekarang = Math.floor(sls);
					   
						var usia;
						
						if (usia < 20)
						{
							usia = 20;	
						}
						else
						{
							usia = usiasekarang;
						}
						
						var masacpb =$("#dropdowncpb").val();
						
						var carabayar = $("#carabayar").val();	
						
						var faktorcb;
						
						if (carabayar == "Bulanan")
						{
							faktorcb = 95/1000;
						}
						else if (carabayar == "Kuartalan")
						{
							faktorcb = 27/100;
						}
						else if (carabayar == "Semesteran")
						{
							faktorcb = 52/100;
						}
						else if (carabayar == "Tahunan")
						{
							faktorcb = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							faktorcb = 1;
						}
						
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jl3/hitungpremitambahanCPB');?>",
							data	: "masacpb="+masacpb+"&usia="+usia+"&faktorcb="+faktorcb+"&kodetarif="+kodetarif,
							success : function(data) {
								$("#premitambahancpb").val(data);
								
								document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
								
							}
						});       
					}
					else {
							document.getElementById('dropdowncpb').disabled = true;       
					document.getElementById('premitambahancpb').disabled = true;
	
					document.getElementById('dropdowncpb').value = 1;   
					$('#dropdowncpb').trigger('change');
					document.getElementById('juacpb').value = 0;         
					document.getElementById('premitambahancpb').value = 0; 
					
					document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
					      
					}
				}
				else if (document.getElementById('cpm').checked == false)
				{
					alert('Anda Harus Mengambil Cash Plan Murni Terlebih Dahulu!');
					$('#cpb').click();
				}
			});	
			
			$('#term').click(function () {
				if ($(this).prop('checked')) {  
					document.getElementById('juaterm').disabled = false;  
					
					//document.getElementById('juaterm').value = 5000000; 
					
					//var juaterm = $("#juaterm").val();
					
					var masapemb = $("#masapemb").val();
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					var carabayar = $("#carabayar").val();
					
					var calontertanggungperokokjl3 = $("#calontertanggungperokokjl3").val();
						
					if (calontertanggungperokokjl3 == 'Ya')
					{
						var statusperokok = "SMOKER";	
					}
					else if (calontertanggungperokokjl3 == 'Tidak')
					{
						var statusperokok = "NONSMOKER";		
					}
					
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();
					
					if (carabayar == "Bulanan")
					{
						faktorcb = 95/1000;
						document.getElementById('juaterm').value = 25 * premisesuaicarabayar;
						var juaterm =$("#juaterm").val();
					}
					else if (carabayar == "Kuartalan")
					{
						faktorcb = 27/100;
						document.getElementById('juaterm').value = 15 * premisesuaicarabayar;
						var juaterm =$("#juaterm").val();
					}
					else if (carabayar == "Semesteran")
					{
						faktorcb = 52/100;
						document.getElementById('juaterm').value = 10 * premisesuaicarabayar;
						var juaterm =$("#juaterm").val();
					}
					else if (carabayar == "Tahunan")
					{
						faktorcb = 1;
						document.getElementById('juaterm').value = 5 * premisesuaicarabayar;
						var juaterm =$("#juaterm").val();
					}
					else if (carabayar == "Sekaligus")
					{
						faktorcb = 1;
						document.getElementById('juaterm').value = 1 * premisesuaicarabayar;
						var juaterm =$("#juaterm").val();
					}
					
						
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('jl3/hitungpremitambahanTERM');?>",
						data	: "juaterm="+juaterm+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang+"&statusperokok="+statusperokok,
						success : function(data) {
							$("#premitambahanterm").val(data);
							
							document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
							
						}
					});     
				}
				else {
						document.getElementById('juaterm').disabled = true;       
				document.getElementById('premitambahanterm').disabled = true;

				document.getElementById('juaterm').value = 0;       
				document.getElementById('premitambahanterm').value = 0;    
				
				document.getElementById('totalpremisesuaicarabayar').value = parseInt(document.getElementById('premisesuaicarabayar').value) + parseInt(document.getElementById('topupberkala').value) + parseInt(document.getElementById('premitambahanci').value) + parseInt(document.getElementById('premitambahanpa').value) + parseInt(document.getElementById('premitambahanwp').value) + parseInt(document.getElementById('premitambahanctt').value) + parseInt(document.getElementById('premitambahancpm').value) + parseInt(document.getElementById('premitambahancpb').value) + parseInt(document.getElementById('premitambahanterm').value);
				   
				}
			});	
			
			$('#juaterm').change(function () {
				if ($('#term').prop('checked')) {  
					document.getElementById('juaterm').disabled = false;  
										
					var juaterm = $("#juaterm").val();
					
					var masapemb = $("#masapemb").val();
					var tanggallahircalontertangggung = $("#tanggallahircalontertangggung").val();		
					var birthday = +new Date(tanggallahircalontertangggung);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
					
					var carabayar = $("#carabayar").val();	
					
					var premisesuaicarabayar = $("#premisesuaicarabayar").val();	
					
					if (carabayar == "Bulanan")
					{
						var premisesuaicarabayarmin = 25 * premisesuaicarabayar;	
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Kuartalan")
					{
						var premisesuaicarabayarmin = 15 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Semesteran")
					{
						var premisesuaicarabayarmin = 10 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Tahunan")
					{
						var premisesuaicarabayarmin = 5 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}
					else if (carabayar == "Sekaligus")
					{
						var premisesuaicarabayarmin = 1 * premisesuaicarabayar;
						var premisesuaicarabayarmax = 3 * premisesuaicarabayarmin;
					}	
					
					if (juaterm < premisesuaicarabayarmin)
					{
						alert('JUA Minimal '+premisesuaicarabayarmin+'!');	
						
						document.getElementById('juaterm').value = premisesuaicarabayarmin;
					}
					else if ((juaterm > premisesuaicarabayarmax) || (juaterm > 500000000))
					{
						alert('JUA Maksimal 3 kali TL1 atau Maksimal 500000000!');	
						
						document.getElementById('juaterm').value = premisesuaicarabayarmin;
					}
					else
					{
					
						if (carabayar == "Bulanan")
						{
							faktorcb = 95/1000;
						}
						else if (carabayar == "Kuartalan")
						{
							faktorcb = 27/100;
						}
						else if (carabayar == "Semesteran")
						{
							faktorcb = 52/100;
						}
						else if (carabayar == "Tahunan")
						{
							faktorcb = 1;
						}
						else if (carabayar == "Sekaligus")
						{
							faktorcb = 1;
						}
							
						$.ajax({
							type	: "POST",
							url		: "<?=base_url('jl3/hitungpremitambahanTERM');?>",
							data	: "juaterm="+juaterm+"&masapemb="+masapemb+"&faktorcb="+faktorcb+"&usiasekarang="+usiasekarang,
							success : function(data) {
								$("#premitambahanterm").val(data);
							}
						});  
					}
				}
				else {
						document.getElementById('juaterm').disabled = true;       
				document.getElementById('premitambahanterm').disabled = true;

				document.getElementById('juaterm').value = 0;       
				document.getElementById('premitambahanterm').value = 0;       
				}	
			});	
			
			$('#kesanggupanbayar').change(function () {	
				var kesanggupanbayar = parseInt($("#kesanggupanbayar").val());
				var totalpremisesuaicarabayar = parseInt($("#totalpremisesuaicarabayar").val());
								
				if (kesanggupanbayar <totalpremisesuaicarabayar)
				{
					document.getElementById('kesanggupanbayar').value = document.getElementById('kesanggupanbayar').value * 1000;		
				}
				else if (kesanggupanbayar > totalpremisesuaicarabayar)
				{
					document.getElementById('kesanggupanbayar').value = document.getElementById('totalpremisesuaicarabayar').value;		
				}
			});
});
</script>

