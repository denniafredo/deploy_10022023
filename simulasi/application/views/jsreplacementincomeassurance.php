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
									  <label class="control-label col-md-4">Gaji <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
			<input class="form-control" placeholder="Jumlah Gaji" type="" name="gaji" id="gaji" onChange="" >
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Jumlah Risiko Awal <span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
		  <input class="form-control" placeholder="Jumlah Risiko Awal" type="" name="jumlahrisikoawaljsgajiterusanplatinum" id="jumlahrisikoawaljsgajiterusanplatinum" onchange="" readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
									  <label class="control-label col-md-4">Premi<span class="required"> * </span> </label>
									  <div class="col-md-6">
		<div class="input-group">
		  <input class="form-control" placeholder="Premi 5 Tahun Pertama" name="premi5tahunpertama" id="premi5tahunpertama" onchange="" readonly>
          <span class="help-block" style="font-weight:bold;font-style:italic">
			 premi 5 tahun pertama
		</span>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
        <div class="input-group">
		  <input type="" class="form-control" placeholder="Premi Tahun Ke-6 Dan Seterusnya" name="premitahunke6danseterusnya" id="premitahunke6danseterusnya" onchange="" readonly>
          <span class="help-block" style="font-weight:bold;font-style:italic">
			 premi tahun ke-6 dan seterusnya
		</span>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-4">Masa Asuransi<span class="required">
		 *
	</span></label>
	
	<div class="col-md-6">
		<input name="masaasuransijsgajiterusan" id="masaasuransijsgajiterusan" size="16" type="number" value="1" onchange=""/>
		<input type="hidden" class="form-control" placeholder="Usia Ortu" type="text" name="usiaortu" id="usiaortu">
		<span class="help-block">
			 Tahun
		</span>
        
	</div>
</div>
        
        <div class="form-group">
  <label class="control-label col-md-4">Cara Bayar Premi<span class="required"> * </span></label>
  <div class="col-md-6">
										  <select class="form-control select2me" name="carabayarpremijsgajiterusan" id="carabayarpremijsgajiterusan" onChange="onChangeCaraBayar(this)">
                                     <option value="">[Pilih Cara Bayar Premi]</option>
                                     <option value="Bulanan">Bulanan</option>     
											</select>
										</div>
									</div>
                                    
                                    <div class="form-group">
                                      <label class="control-label col-md-4">Saat Mulai Asuransi<span class="required"> * </span></label>
                                      <div class="col-md-6">
													  <input class="form-control form-control-inline input-small date-picker" id="saatmulaiasuransijsgajiterusan" name="saatmulaiasuransijsgajiterusan" size="16" type="text" value="" placeholder="Saat Mulai Asuransi" onChange=""/>
													</div>
		</div>
													</div>
													<!--/span-->
													
</div>

<br>


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
		
		$("#masaasuransijsgajiterusan").change(function() {
			var masaasuransijsgajiterusan = $("#masaasuransijsgajiterusan").val();
			
			if (masaasuransijsgajiterusan < 1)
			{	
				alert('Masa Asuransi Minimal 1 Tahun!');
				document.getElementById('masaasuransijsgajiterusan').value = 1;
			}
			else if (masaasuransijsgajiterusan > 35)
			{	
				alert('Masa Asuransi Maksimal 35 Tahun!');
				document.getElementById('masaasuransijsgajiterusan').value = 1;	
			}
			
			var gaji = $("#gaji").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsgajiterusanplatinum/hitungjumlahrisikoawaljsgajiterusanplatinum');?>",
				data	: "gaji="+gaji+"&masaasuransijsgajiterusan="+masaasuransijsgajiterusan+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#jumlahrisikoawaljsgajiterusanplatinum").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsgajiterusanplatinum/hitungpremitahunke6danseterusnyajsgajiterusanplatinum');?>",
				data	: "gaji="+gaji+"&masaasuransijsgajiterusan="+masaasuransijsgajiterusan+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premitahunke6danseterusnya").val(data);
				}
			});
			
			var premitahunke6danseterusnya = $("#premitahunke6danseterusnya").val();
			
			
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsgajiterusanplatinum/hitungpremi5tahunpertamajsgajiterusanplatinum');?>",
					data	: "gaji="+gaji+"&masaasuransijsgajiterusan="+masaasuransijsgajiterusan+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#premi5tahunpertama").val(data);
					}
				});
			
			
		});
		
		$("#gaji").change(function() {
			var masaasuransijsgajiterusan = $("#masaasuransijsgajiterusan").val();
					
			var gaji = $("#gaji").val();	
			
			var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
			var now = Date.now("MM-dd-yyyy");
			var sls =((now - birthday) / 31557600000);
			var usiasekarang = Math.floor(sls);
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsgajiterusanplatinum/hitungjumlahrisikoawaljsgajiterusanplatinum');?>",
				data	: "gaji="+gaji+"&masaasuransijsgajiterusan="+masaasuransijsgajiterusan+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#jumlahrisikoawaljsgajiterusanplatinum").val(data);
				}
			});
			
			$.ajax({
				type	: "POST",
				url		: "<?=base_url('jsgajiterusanplatinum/hitungpremitahunke6danseterusnyajsgajiterusanplatinum');?>",
				data	: "gaji="+gaji+"&masaasuransijsgajiterusan="+masaasuransijsgajiterusan+"&usiasekarang="+usiasekarang,
				success : function(data) {
					$("#premitahunke6danseterusnya").val(data);
				}
			});
			
			var premitahunke6danseterusnya = $("#premitahunke6danseterusnya").val();
			
			
				$.ajax({
					type	: "POST",
					url		: "<?=base_url('jsgajiterusanplatinum/hitungpremi5tahunpertamajsgajiterusanplatinum');?>",
					data	: "gaji="+gaji+"&masaasuransijsgajiterusan="+masaasuransijsgajiterusan+"&usiasekarang="+usiasekarang,
					success : function(data) {
						$("#premi5tahunpertama").val(data);
					}
				});
			
			
		});
		
	   });
</script>
<script>
jQuery(document).ready(function() {       
      // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
	   
	
		
</script>