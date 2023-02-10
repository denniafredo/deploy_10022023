<h3 class="block" align="center">Disajikan Untuk</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-6">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">
															
                                            <br>
                                            
        <div class="form-group">
          <label class="control-label col-md-4">Nama<span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namalengkapcalontertanggung" id="namalengkapcalontertanggung" placeholder="Nama Lengkap"/>
														<span class="help-block">
															 Masukkan Nama Lengkap
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
												<input type="checkbox" value="1" name="tertanggungsamadenganpemegangpolis" id="tertanggungsamadenganpemegangpolis" onClick="checkedTertanggungSamaDenganPemegangPolis(this)"/> sama dengan Pemegang Polis </label>
		</div>    
                       
                       <br>									
</div>
													<!--/span-->
   		 </div>
    </div>
</div>

<br>
<h3 class="block" align="center">Data Pertanggungan</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
    <div class="form-group">
    <label class="control-label col-md-4">Tertanggung <span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
            <p style="margin-top:5px">Ayah</p>
            <p style="margin-top:30px">Ibu</p>
            <p style="margin-top:30px">Anak1</p>
            <p style="margin-top:30px">Anak2</p>
            <p style="margin-top:30px">Anak3</p>
        </td>
        <td>
            <div class="form-group">
                <div class="col-md-12">
                <select class="form-control select2me" name="tertanggungayah" id="tertanggungayah" onChange="">
                <option value="0">0</option>
                <option value="1">1</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                <select class="form-control select2me" name="tertanggungibu" id="tertanggungibu" onChange="">
                <option value="0">0</option>
                <option value="1">1</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                <select class="form-control select2me" name="tertanggunganak1" id="tertanggunganak1" onChange="">
                <option value="0">0</option>
                <option value="1">1</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                <select class="form-control select2me" name="tertanggunganak2" id="tertanggunganak2" onChange="">
                <option value="0">0</option>
                <option value="1">1</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                <select class="form-control select2me" name="tertanggunganak3" id="tertanggunganak3" onChange="">
                <option value="0">0</option>
                <option value="1">1</option>
                </select>
                </div>
            </div>
            <span style="color:#FF0004">Pilih 1. iya dan 0. tidak</span>
        </td>
        </tr>
        
        </table>        
        </div> 
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Uang Asuransi Per Tertanggung<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-6">
            <div class="input-group">
            	<input class="form-control input-xs" placeholder="Uang Asuransi Per Tertanggung" type="" name="uangasuransipertahunjsproteksikeluarga" id="uangasuransipertahunjsproteksikeluarga" onchange="" value="">
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        
        </tr>
        
        </table>        
        </div> 
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Premi Tahunan<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-6">
            <div class="input-group">
            	<input readonly class="form-control input-xs" placeholder="Premi Tahunan" type="" name="premitahunanjsproteksikeluarga" id="premitahunanjsproteksikeluarga" onchange="" value="">
                
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        </tr>
        
        </table>        
        </div> 
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Premi Sekaligus<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-6">
            <div class="input-group">
            	<input readonly class="form-control input-xs" placeholder="Premi Sekaligus" type="" name="premisekaligusjsproteksikeluarga" id="premisekaligusjsproteksikeluarga" onchange="" value="">
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        <td>
        
        </td>
        </tr>
        
        </table>        
        </div> 
    </div>
	<div class="form-group" style="display:none">
    <label class="control-label col-md-4">JUA Minimal Per Tertanggung<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-6">
            <div class="input-group">
            	<input readonly class="form-control input-xs" placeholder="JUA Minimal Per Tertanggung" type="" name="juaminimalpertertanggung" id="juaminimalpertertanggung" onchange="" value="">
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        <td>
        
        </td>
        </tr>
        
        </table>        
        </div> 
    </div>
	<div class="form-group" style="display:none">
    <label class="control-label col-md-4">JUA Maksimum Per Tertanggung<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-6">
            <div class="input-group">
            	<input readonly class="form-control input-xs" placeholder="JUA Maksimum Per Tertanggung" type="" name="juamaksimumpertertanggung" id="juamaksimumpertertanggung" onchange="" value="">
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        <td>
        
        </td>
        </tr>
        
        </table>        
        </div> 
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Masa Asuransi<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-6">
            <div class="input-group">
            	<input  class="form-control input-xs" placeholder="Masa Asuransi" type="" name="masaasuransijsproteksikeluarga" id="masaasuransijsproteksikeluarga" onchange="" value="">
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        <td>
        <span>Tahun </span>
        </td>
        </tr>
        
        </table>        
        </div> 
    </div>
    <div class="form-group">
    <label class="control-label col-md-4">Mulai Asuransi<span class="required"> * </span> </label>
        <div class="col-md-6">
        <table class="table table-striped table-hover" id="datatable_ajax">
        
        <tr role="row" class="filter">
        <td>
        <div class="col-md-8">
            <div class="input-group">
            	<input class="form-control form-control-inline input-xs date-picker" id="mulaiasuransijsproteksikeluarga" name="mulaiasuransijsproteksikeluarga" type="text" value="" placeholder="Mulai Asuransi" onChange=""/>
            <!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
            </div>
        </div>
        </td>
        
        </tr>
        
        </table>        
        </div> 
    </div>
    <span>* Jumlah anak maksimal 3 orang</span>
    <br>
    <span>** Total Uang Asuransi maksimal Rp 150.000.000,- </span>
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
		
		$("#uangasuransipertahunjsproteksikeluarga").change(function() {		
			var uangasuransipertahunjsproteksikeluarga = $("#uangasuransipertahunjsproteksikeluarga").val();
			
			var tertanggungayah = $("#tertanggungayah").val();
			var tertanggungibu = $("#tertanggungibu").val();
			var tertanggunganak1 = $("#tertanggunganak1").val();
			var tertanggunganak2 = $("#tertanggunganak2").val();
			var tertanggunganak3 = $("#tertanggunganak3").val();
			
			var ayahibu = parseInt(tertanggungayah) + parseInt(tertanggungibu);
			var totalanak = parseInt(tertanggunganak1) + parseInt(tertanggunganak2) + parseInt(tertanggunganak3);
			var status;
			
			if (ayahibu == 2)
			{	
				status = 'K'+totalanak;
			}
			else
			{
				status = 'B'+totalanak;
			}
			
			var grandtotal = ayahibu + totalanak;
			var cekinput = grandtotal * uangasuransipertahunjsproteksikeluarga;
			
			
			
			/*
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungjuaminimalpertertanggung');?>",
				data	: "status="+status,
				success : function(data) {	
					$("#juaminimalpertertanggung").val(data);
					var juaminimalpertertanggung = data;
					if (uangasuransipertahunjsproteksikeluarga < document.getElementById('juaminimalpertertanggung').value)
					{
						alert('JUA Minimal Per Tertanggung adalah '+juaminimalpertertanggung);
						//document.getElementById('uangasuransipertahunjsproteksikeluarga').value = '';
					}
				}
			});

			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungjuamaksimumpertertanggung');?>",
				data	: "status="+status,
				success : function(data) {	
					$("#juamaksimumpertertanggung").val(data);
					var juamaksimumpertertanggung = data;
					if (uangasuransipertahunjsproteksikeluarga > document.getElementById('juamaksimumpertertanggung').value)
					{
						alert('JUA Maksimum Per Tertanggung adalah '+juamaksimumpertertanggung);
						//document.getElementById('uangasuransipertahunjsproteksikeluarga').value = '';
					}
					
				}
			});
			*/
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremitahunanjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					if (cekinput > 150000001)
					{	
						alert('TIDAK BISA');
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (cekinput < 10000000)
					{
						alert('TIDAK BISA');
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'B0') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 150000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'B1') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 75000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'B2') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 50000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'B3') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 35000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'K0') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 75000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'K1') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 50000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'K2') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 35000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (((status == 'K3') && (uangasuransipertahunjsproteksikeluarga < 10000000)) || ((status == 'B0') && (uangasuransipertahunjsproteksikeluarga > 30000000)))
					{
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else 
					{
						$("#premitahunanjsproteksikeluarga").val(data);
					}
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremisekaligusjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					if (cekinput > 150000001)
					{	
						alert('TIDAK BISA');
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else if (cekinput < 10000000)
					{
						alert('TIDAK BISA');
						document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
						document.getElementById('premitahunanjsproteksikeluarga').value = 0;
						document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
					}
					else 
					{
						$("#premisekaligusjsproteksikeluarga").val(data);
					}
				}
			});
			
		});
		
		$("#tertanggungayah").change(function() {
			var uangasuransipertahunjsproteksikeluarga = $("#uangasuransipertahunjsproteksikeluarga").val();
					
			var tertanggungayah = $("#tertanggungayah").val();
			var tertanggungibu = $("#tertanggungibu").val();
			var tertanggunganak1 = $("#tertanggunganak1").val();
			var tertanggunganak2 = $("#tertanggunganak2").val();
			var tertanggunganak3 = $("#tertanggunganak3").val();
			
			var ayahibu = parseInt(tertanggungayah) + parseInt(tertanggungibu);
			var totalanak = parseInt(tertanggunganak1) + parseInt(tertanggunganak2) + parseInt(tertanggunganak3);
			var status;
			
			var grandtotal = ayahibu + totalanak;
			var cekinput = grandtotal * uangasuransipertahunjsproteksikeluarga;
			
			if (cekinput > 150000001)
			{
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else if (cekinput < 10000000)
			{
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else 
			{
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = uangasuransipertahunjsproteksikeluarga;
			}
			
			if (ayahibu == 2)
			{	
				status = 'K'+totalanak; 
				//alert (status);	
			}
			else
			{	
				status = 'B'+totalanak; 
				//alert(status);	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremitahunanjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premitahunanjsproteksikeluarga").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremisekaligusjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premisekaligusjsproteksikeluarga").val(data);
				}
			});
			
		
		});
		
		$("#tertanggungibu").change(function() {		
			var uangasuransipertahunjsproteksikeluarga = $("#uangasuransipertahunjsproteksikeluarga").val();
			
			var tertanggungayah = $("#tertanggungayah").val();
			var tertanggungibu = $("#tertanggungibu").val();
			var tertanggunganak1 = $("#tertanggunganak1").val();
			var tertanggunganak2 = $("#tertanggunganak2").val();
			var tertanggunganak3 = $("#tertanggunganak3").val();
			
			var ayahibu = parseInt(tertanggungayah) + parseInt(tertanggungibu);
			var totalanak = parseInt(tertanggunganak1) + parseInt(tertanggunganak2) + parseInt(tertanggunganak3);
			var status;
			
			var grandtotal = ayahibu + totalanak;
			var cekinput = grandtotal * uangasuransipertahunjsproteksikeluarga;
			
			if (cekinput > 150000001)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else if (cekinput < 10000000)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else 
			{
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = uangasuransipertahunjsproteksikeluarga;
			}
			
			if (ayahibu == 2)
			{	
				status = 'K'+totalanak; 
				//alert (status);	
			}
			else
			{	
				status = 'B'+totalanak; 
				//alert(status);	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremitahunanjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premitahunanjsproteksikeluarga").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremisekaligusjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premisekaligusjsproteksikeluarga").val(data);
				}
			});
		
		});
		
		$("#tertanggunganak1").change(function() {		
			var uangasuransipertahunjsproteksikeluarga = $("#uangasuransipertahunjsproteksikeluarga").val();
			
			var tertanggungayah = $("#tertanggungayah").val();
			var tertanggungibu = $("#tertanggungibu").val();
			var tertanggunganak1 = $("#tertanggunganak1").val();
			var tertanggunganak2 = $("#tertanggunganak2").val();
			var tertanggunganak3 = $("#tertanggunganak3").val();
			
			var ayahibu = parseInt(tertanggungayah) + parseInt(tertanggungibu);
			var totalanak = parseInt(tertanggunganak1) + parseInt(tertanggunganak2) + parseInt(tertanggunganak3);
			var status;
			
			var grandtotal = ayahibu + totalanak;
			var cekinput = grandtotal * uangasuransipertahunjsproteksikeluarga;
			
			if (cekinput > 150000001)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else if (cekinput < 10000000)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else 
			{
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = uangasuransipertahunjsproteksikeluarga;
			}
			
			if (ayahibu == 2)
			{	
				status = 'K'+totalanak; 
				//alert (status);	
			}
			else
			{	
				status = 'B'+totalanak; 
				//alert(status);	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremitahunanjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premitahunanjsproteksikeluarga").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremisekaligusjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premisekaligusjsproteksikeluarga").val(data);
				}
			});
		
		});
		
		$("#tertanggunganak2").change(function() {		
			var uangasuransipertahunjsproteksikeluarga = $("#uangasuransipertahunjsproteksikeluarga").val();
			
			var tertanggungayah = $("#tertanggungayah").val();
			var tertanggungibu = $("#tertanggungibu").val();
			var tertanggunganak1 = $("#tertanggunganak1").val();
			var tertanggunganak2 = $("#tertanggunganak2").val();
			var tertanggunganak3 = $("#tertanggunganak3").val();
			
			var ayahibu = parseInt(tertanggungayah) + parseInt(tertanggungibu);
			var totalanak = parseInt(tertanggunganak1) + parseInt(tertanggunganak2) + parseInt(tertanggunganak3);
			var status;
			
			var grandtotal = ayahibu + totalanak;
			var cekinput = grandtotal * uangasuransipertahunjsproteksikeluarga;
			
			if (cekinput > 150000001)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else if (cekinput < 10000000)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else 
			{
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = uangasuransipertahunjsproteksikeluarga;
			}
			
			if (ayahibu == 2)
			{	
				status = 'K'+totalanak; 
				//alert (status);	
			}
			else
			{	
				status = 'B'+totalanak; 
				//alert(status);	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremitahunanjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premitahunanjsproteksikeluarga").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremisekaligusjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premisekaligusjsproteksikeluarga").val(data);
				}
			});
		
		});
		
		$("#tertanggunganak3").change(function() {	
			var uangasuransipertahunjsproteksikeluarga = $("#uangasuransipertahunjsproteksikeluarga").val();
			
			var tertanggungayah = $("#tertanggungayah").val();
			var tertanggungibu = $("#tertanggungibu").val();
			var tertanggunganak1 = $("#tertanggunganak1").val();
			var tertanggunganak2 = $("#tertanggunganak2").val();
			var tertanggunganak3 = $("#tertanggunganak3").val();
			
			var ayahibu = parseInt(tertanggungayah) + parseInt(tertanggungibu);
			var totalanak = parseInt(tertanggunganak1) + parseInt(tertanggunganak2) + parseInt(tertanggunganak3);
			var status;
			
			var grandtotal = ayahibu + totalanak;
			var cekinput = grandtotal * uangasuransipertahunjsproteksikeluarga;
			
			if (cekinput > 150000001)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else if (cekinput < 10000000)
			{	
				alert('TIDAK BISA');
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = 0;
				document.getElementById('premitahunanjsproteksikeluarga').value = 0;
				document.getElementById('premisekaligusjsproteksikeluarga').value = 0;
			}
			else 
			{
				document.getElementById('uangasuransipertahunjsproteksikeluarga').value = uangasuransipertahunjsproteksikeluarga;
			}
			
			if (ayahibu == 2)
			{	
				status = 'K'+totalanak; 
				//alert (status);	
			}
			else
			{	
				status = 'B'+totalanak; 
				//alert(status);	
			}
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremitahunanjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premitahunanjsproteksikeluarga").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsproteksikeluarga/hitungpremisekaligusjuapertertanggung');?>",
				data	: "status="+status+"&uangasuransipertahunjsproteksikeluarga="+uangasuransipertahunjsproteksikeluarga,
				success : function(data) {	
					$("#premisekaligusjsproteksikeluarga").val(data);
				}
			});
		
		});
	   
	   });
</script>