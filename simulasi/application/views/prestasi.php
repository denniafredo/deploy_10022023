<h3 class="block" align="center">Data Pribadi</h3>
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
													
													<!--/span-->
													<div class="col-md-12">
                                                    											
<div class="form-group" style="border: 1px solid #444; padding: 10px;">                                                      						<div class="col-md-12">

<h4 class="block">Pemegang Polis</h4>

        <!--div class="form-group">
        	<label class="control-label col-md-4">Hub Pempol dgn Tertanggung  <span class="required"> * </span></label>
                <div class="col-md-3">
                    <select class="form-control select2me" name="hubungandenganpempol" id="hubungandenganpempol" onChange="onHandleHubunganDenganPempol(this)">
                        <option value="">[PILIH]</option>
                        <option value="Y">Y</option>
                        <option value="N">N</option>RIDER
                    </select>
                    <span class="help-block">
                    	Suami/Istri (Y/N)
                    </span>
            </div>
        </div-->
															
                                            
        <div class="form-group">
          <label class="control-label col-md-4">Nama Tertanggung<span class="required"> * </span> </label>
          <div class="col-md-6">
														<input type="text" class="form-control" name="namalengkapcalontertanggung" id="namalengkapcalontertanggung" placeholder="Nama Tertanggung"/>
														
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

<br>

<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">


<div class="form-group">
	<label class="control-label col-md-3">Saat Mulai Asuransi
		<span class="required">
		 *
		</span>
	</label>
	
	<div class="col-md-3">
		<input class="form-control form-control-inline input-small date-picker" name="mulas" id="mulas" size="16" type="text" value="" onchange=""/>
		<!--input type="hidden" class="form-control" placeholder="Usia Ortu" type="text" name="usiaortu" id="usiaortu"-->
		
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Uang Asuransi<span class="required">
		 *
	</span></label>
	
	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Jumlah Uang Asuransi" type="text" name="uangasuransi" id="uangasuransi">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
		
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Masa Asuransi
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-4">
			<input class="form-control" placeholder="Masa Asuransi" type="text" name="usiaanak" id="usiaanak" maxlength="2" size="10"> 
			<span class="help-block">
				Tahun
			</span>
	</div>
</div>


<div class="form-group">
    <label class="control-label col-md-3">Cara Bayar <span class="required"> * </span></label>
    <div class="col-md-3">
        <select class="form-control select2me" name="carabayarjsprestasi" id="carabayarjsprestasi" onChange="">
        <option value="">[Pilih Cara Bayar]</option>
        <option value="Bulanan">Bulanan</option>     
        <!--option value="Kuartalan">Kuartalan</option-->
        <!--option value="Semesteran">Semesteran</option-->
        <option value="Tahunan">Tahunan</option>  
        </select>
    </div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Premi
		<span class="required">
		 *
		</span>
	</label>
	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Premi" type="text" name="tabelpremisekaligus" id="tabelpremisekaligus" readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>

	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Premi 5 Tahun Pertama
		<span class="required">
		 *
		</span>
	</label>
	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Premi 5 Tahun Pertama" type="text" name="tabelpremicicil5tahun" id="tabelpremicicil5tahun" readonly>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>

	</div>
</div>

</div>
</div>




<!--script>
    jQuery(document).ready(function() {       
       // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
    });   
    function calculate_sale_price(input)
	{
	    premi = document.getElementById('premisekaligus');
	    alokasi = document.getElementById('alokasiproteksi');
	    uangasuransi = document.getElementById('uangasuransi');
	    var proteksi= (premi.value != '' && premi.value>=50000000) ? premi.value * 0.07 : 0;
	    var jua = (premi.value != '' && premi.value>=50000000) ? (premi.value * 130)/100: 0;
	    alokasi.value = proteksi.toFixed(2);
	    uangasuransi.value = jua.toFixed(2);
	    
	}
	function hitungtahun(input)
	{
	    mulas = document.getElementById('tanggallahircalontertangggung');
	    lahir = document.getElementById('lahirnasabah');
	    usiaortu = document.getElementById('usiaortu');
	    
	    var tahunMulas = mulas.value;
	    var tahunLahir = lahir.value;
	    
		var date1 = tahunMulas.substr(-4);
		var date2 = tahunLahir.substr(-4);
		
		/*var year1 = date1[2];
		var year2 = date2[2];*/
		
		var tahun = date1-date2;
	    
	    //var umur= bunga.value * (1-(pajak.value/100));
	    usiaortu.value = tahun;
	    
	}
	
	$("#ci53jsprestasi").change(function() {
		var ci53jsprestasi = document.getElementById("ci53jsprestasi").value;
		
		if (ci53jsprestasi == 0)
		{
			alert('0');
		}
		else if (ci53jsprestasi == 1)
		{
			alert('1');	
		}
	});
	
	$("#tpdjsprestasi").change(function() {
		var tpdjsprestasi = document.getElementById("tpdjsprestasi").value;
		
		if (tpdjsprestasi == 0)
		{
			alert('0');
		}
		else if (tpdjsprestasi == 1)
		{
			alert('1');	
		}
	});
	
	$("#spdjsprestasi").change(function() {
		var spdjsprestasi = document.getElementById("spdjsprestasi").value;
		
		if (spdjsprestasi == 0)
		{
			alert('0');
		}
		else if (spdjsprestasi == 1)
		{
			alert('1');	
		}
	});
	
	$("#sptpdjsprestasi").change(function() {
		var sptpdjsprestasi = document.getElementById("sptpdjsprestasi").value;
		
		if (sptpdjsprestasi == 0)
		{
			alert('0');
		}
		else if (sptpdjsprestasi == 1)
		{
			alert('1');	
		}
	});
	
	$("#cpjsprestasi").change(function() {
		var cpjsprestasi = document.getElementById("cpjsprestasi").value;
			
		if (cpjsprestasi == '1')
		{
			$('#uangasuransicpbjsprestasi').prop('disabled', false);
			$('#cpbjsprestasi').prop('disabled', false);
		}
		else if (cpjsprestasi == '0')
		{
			$('#uangasuransicpbjsprestasi').prop('disabled', true);
			$('#cpbjsprestasi').prop('disabled', true);

			document.getElementById("uangasuransicpjsprestasi").value = 0;
			$('#uangasuransicpjsprestasi').trigger('change');

			document.getElementById("cpbjsprestasi").value = 0;
			$('#cpbcpbjsprestasi').trigger('change');

		}
	});
	
	$("#cpbjsprestasi").change(function() {
		var cpbjsprestasi = document.getElementById("cpbjsprestasi").value;
			
		if (hcpbjsdwigunamenaik == '1')
		{
			document.getElementById("uangasuransicpbjsprestasi").value = document.getElementById("uangasuransicpjsprestasi").value; 
			$('#uangasuransicpbjsprestasi').trigger('change');
		}
		else if (hcpbjsdwigunamenaik == '0') 
		{
			document.getElementById("uangasuransicpbjsprestasi").value = 0;
			$('#uangasuransicpbjsprestasi').trigger('change');
		}
	});
	
	$("#uangasuransicpjsprestasi").change(function() {
		var uangasuransicpjsprestasi = document.getElementById("uangasuransicpjsprestasi").value;
			
		var jeniskelamincalontertanggung = document.getElementById("jeniskelamincalontertanggung").value;

		var carabayarjsprestasi = $("#carabayarjsprestasi").val();

		var birthday = +new Date(document.getElementById("lahirnasabah").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		$.ajax({
					type	: "POST",
					url		: "<?=base_url('prestasi/hitungcpjsprestasi');?>",
					data	: "uangasuransicpjsprestasi="+uangasuransicpjsprestasi+"&usiasekarang="+usiasekarang+"&jeniskelamincalontertanggung="+jeniskelamincalontertanggung+"&carabayarjsprestasi="+carabayarjsprestasi,
					success : function(data) {
						$("#premicpjsprestasi").val(data);

					}
				});	

		var hcpbjsprestasi= document.getElementById("hcpbjsprestasi").value;

		if (hcpbjsprestasi == '1')
		{
			document.getElementById("uangasuransihcpbjsprestasi").value = document.getElementById("uangasuransihcpjsprestasi").value; 
			$('#uangasuransihcpbjsprestasi').trigger('change');
		}
		else if (hcpbjsprestasi == '0')
		{
			document.getElementById("uangasuransihcpbjsprestasi").value = 0;
			$('#uangasuransihcpbjsprestasi').trigger('change');
		}
	});
	
	$("#uangasuransicpbjsprestasi").change(function() {
		var uangasuransicpbjsprestasi = document.getElementById("uangasuransicpbjsprestasi").value;
		
		if (uangasuransicpbjsprestasi == 0)
		{
			alert('0');
		}
		else if (uangasuransicpbjsprestasi == 1)
		{
			alert('1');	
		}
		else if (uangasuransicpbjsprestasi == 2)
		{
			alert('2');	
		}
		else if (uangasuransicpbjsprestasi == 3)
		{
			alert('3');	
		}
		else if (uangasuransicpbjsprestasi == 4)
		{
			alert('4');	
		}
		else if (uangasuransicpbjsprestasi == 5)
		{
			alert('5');	
		}
	});
	
</script-->
<!--script type="text/javascript">
			
			$(function(){
				// Set up the number formatting.
				
				$('#number_container').slideDown('fast');
				
				$('#premisekaligus').on('change',function(){
					console.log('Change event.');
					var val = $('#premisekaligus').val();
					$('#the_number').text( val !== '' ? val : '(empty)' );
				});
				
				//$('#premisekaligus').number( true, 0 );
				//$('#uangasuransi').number( true, 0 );
				//$('.limitnumber').number( true, 0 );
				
				// Get the value of the number for the demo.
				$('#get_number').on('click',function(){
					
					var val = $('#premisekaligus').val();
					
					$('#the_number').text( val !== '' ? val : '(empty)' );
				});
				
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
				
				$("#hubungandenganpempol").change(function() {
					var hubungandenganpempol = $("#hubungandenganpempol").val();	
					
					if (hubungandenganpempol == 'Y')
					{
						document.getElementById("jsspdjsprestasi").disabled = false;
						document.getElementById("jssptpdjsprestasi").disabled = false;
					}
					else if (hubungandenganpempol == 'N')
					{
						document.getElementById("jsspdjsprestasi").disabled = true;
						document.getElementById("jssptpdjsprestasi").disabled = true;
					}
					else
					{
						document.getElementById("jsspdjsprestasi").disabled = true;
						document.getElementById("jssptpdjsprestasi").disabled = true;
					}
				});
				
				$("#usiaanak").change(function() {
					
					var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
				
					var usiaanak = $("#usiaanak").val();
					var masaasuransi = parseInt(usiaanak)+5;

					

					var uangasuransi = $("#uangasuransi").val();
					
					var jenistarif;
					
					var medical = $("#medical").val();
					
					//sekaligus
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+2,
						success : function(data) {
							
							$("#tabelpremisekaligus").val(data);
						}
					});
						
					//cicil 10 tahun (5 Tahun Pertama)				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+5,
						success : function(data) {
							
							$("#tabelpremicicil10tahun").val(data);
						}
					});
					
					//cicil 10 tahun (Tahun2 Berikutnya)				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+6,
						success : function(data) {
							
							$("#tabelpremicicil10tahuntahun2berikutnya").val(data);
						}
					});
					
					//premi cicil 5 tahun
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremicicil5tahunjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremicicil5tahun").val(data);
						}
					});
					
					//premi tahunan 5 tahun pertama
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremitahunanjsprestasi5tahunpertama');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremitahunantahun2berikutnya").val(data);
						}
					});
					
					//premi tahunan tahun2 berikutnya
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremitahunanjsprestasitahun2berikutnya');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremitahunan").val(data);
						}
					});
					
					//premi semesteran
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisemesteranjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremisemesteran").val(data);
						}
					});
					
					//premi kuartalan
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremikuartalanjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremikuartalan").val(data);
						}
					});
					
					//premi bulanan
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremibulananjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremibulanan").val(data);
						}
					});
					
				});
				
				$("#uangasuransi").change(function() {
					
					var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
				
					var usiaanak = $("#usiaanak").val();
					var masaasuransi = parseInt(usiaanak)+5;
					var uangasuransi = $("#uangasuransi").val();
					
					var jenistarif;
					
					var medical = $("#medical").val();
				
					//sekaligus
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+2,
						success : function(data) {
							
							$("#tabelpremisekaligus").val(data);
						}
					});
					
					//cicil 10 tahun (5 Tahun Pertama)				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+5,
						success : function(data) {
							
							$("#tabelpremicicil10tahun").val(data);
						}
					});
					
					//cicil 10 tahun (Tahun2 Berikutnya)				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+6,
						success : function(data) {
							
							$("#tabelpremicicil10tahuntahun2berikutnya").val(data);
						}
					});
					
					//premi cicil 5 tahun
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremicicil5tahunjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremicicil5tahun").val(data);
						}
					});
					
					//premi tahunan 5 tahun pertama
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremitahunanjsprestasi5tahunpertama');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremitahunantahun2berikutnya").val(data);
						}
					});
					
					//premi tahunan tahun2 berikutnya
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremitahunanjsprestasitahun2berikutnya');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremitahunan").val(data);
						}
					});
					
					//premi semesteran
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisemesteranjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremisemesteran").val(data);
						}
					});
					
					//premi kuartalan
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremikuartalanjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremikuartalan").val(data);
						}
					});
					
					//premi bulanan
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremibulananjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremibulanan").val(data);
						}
					});
				});
				
				$("#medical").change(function() {
					
					var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
					var now = Date.now("MM-dd-yyyy");
					var sls =((now - birthday) / 31557600000);
					var usiasekarang = Math.floor(sls);
				
					var usiaanak = $("#usiaanak").val();
					var masaasuransi = parseInt(usiaanak)+5;
					var uangasuransi = $("#uangasuransi").val();
					
					var jenistarif;
					
					var medical = $("#medical").val();
				
					//sekaligus
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+2,
						success : function(data) {
							
							$("#tabelpremisekaligus").val(data);
						}
					});
					
					//cicil 10 tahun (5 Tahun Pertama)				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+5,
						success : function(data) {
							
							$("#tabelpremicicil10tahun").val(data);
						}
					});
					
					//cicil 10 tahun (Tahun2 Berikutnya)				
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisekaligusjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&jenistarif="+6,
						success : function(data) {
							
							$("#tabelpremicicil10tahuntahun2berikutnya").val(data);
						}
					});
					
					//premi cicil 5 tahun
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremicicil5tahunjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremicicil5tahun").val(data);
						}
					});
					
					//premi tahunan 5 tahun pertama
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremitahunanjsprestasi5tahunpertama');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremitahunantahun2berikutnya").val(data);
						}
					});
					
					//premi tahunan tahun2 berikutnya
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremitahunanjsprestasitahun2berikutnya');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremitahunan").val(data);
						}
					});
					
					//premi semesteran
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremisemesteranjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremisemesteran").val(data);
						}
					});
					
					//premi kuartalan
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremikuartalanjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremikuartalan").val(data);
						}
					});
					
					//premi bulanan
					$.ajax({
						type	: "POST",
						url		: "<?=base_url('prestasi/hitungpremibulananjsprestasi');?>",
						data	: "uangasuransi="+uangasuransi+"&masaasuransi="+masaasuransi+"&usiasekarang="+usiasekarang+"&medical="+medical,
						success : function(data) {
							
							$("#tabelpremibulanan").val(data);
						}
					});
				});
			});
</script-->


<script>
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
				document.getElementById('carabayarjsprestasi').value = "";
				$('#carabayarjsprestasi').trigger('change');
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

	$("#usiaanak").change(function() {
		var usiaanak = $("#usiaanak").val();	
		if ((usiaanak < 5) || (usiaanak > 10))
		{
			alert('Masa asuransi antara 5 - 10 tahun!');	
			document.getElementById('usiaanak').value = 5;
			alert.stop();
		}
	});
	
	$("#carabayarjsprestasi").change(function() {
		var usiaanak = $("#usiaanak").val();	
		var uangasuransi = $("#uangasuransi").val();	

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		var carabayarjsprestasi = document.getElementById("carabayarjsprestasi").value;

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('prestasi/hitungpremi');?>",
			data	: "uangasuransi="+uangasuransi+"&usiaanak="+usiaanak+"&usiasekarang="+usiasekarang+"&carabayarjsprestasi="+carabayarjsprestasi,
			success : function(data) {
				if (carabayarjsprestasi == 'Bulanan')
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
				else if (carabayarjsprestasi == 'Tahunan')
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
			url		: "<?=base_url('prestasi/hitungpremi5tahunpertama');?>",
			data	: "uangasuransi="+uangasuransi+"&usiaanak="+usiaanak+"&usiasekarang="+usiasekarang+"&carabayarjsprestasi="+carabayarjsprestasi,
			success : function(data) {
				$("#tabelpremicicil5tahun").val(data);
			}
		});

	});
	
	$("#usiaanak").change(function() {
		var usiaanak = $("#usiaanak").val();	
		var uangasuransi = $("#uangasuransi").val();	

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		var carabayarjsprestasi = document.getElementById("carabayarjsprestasi").value;

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('prestasi/hitungpremi');?>",
			data	: "uangasuransi="+uangasuransi+"&usiaanak="+usiaanak+"&usiasekarang="+usiasekarang+"&carabayarjsprestasi="+carabayarjsprestasi,
			success : function(data) {
				if (carabayarjsprestasi == 'Bulanan')
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
				else if (carabayarjsprestasi == 'Tahunan')
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
			url		: "<?=base_url('prestasi/hitungpremi5tahunpertama');?>",
			data	: "uangasuransi="+uangasuransi+"&usiaanak="+usiaanak+"&usiasekarang="+usiasekarang+"&carabayarjsprestasi="+carabayarjsprestasi,
			success : function(data) {
				$("#tabelpremicicil5tahun").val(data);
			}
		});

	});
	
	$("#uangasuransi").change(function() {
		var usiaanak = $("#usiaanak").val();	
		var uangasuransi = $("#uangasuransi").val();	

		var birthday = +new Date(document.getElementById("tanggallahircalontertangggung").value);
		var now = Date.now("MM-dd-yyyy");
		var sls =((now - birthday) / 31557600000);
		var usiasekarang = Math.floor(sls);

		var carabayarjsprestasi = document.getElementById("carabayarjsprestasi").value;

		$.ajax({
			type	: "POST",
			url		: "<?=base_url('prestasi/hitungpremi');?>",
			data	: "uangasuransi="+uangasuransi+"&usiaanak="+usiaanak+"&usiasekarang="+usiasekarang+"&carabayarjsprestasi="+carabayarjsprestasi,
			success : function(data) {
				if (carabayarjsprestasi == 'Bulanan')
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
				else if (carabayarjsprestasi == 'Tahunan')
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
			url		: "<?=base_url('prestasi/hitungpremi5tahunpertama');?>",
			data	: "uangasuransi="+uangasuransi+"&usiaanak="+usiaanak+"&usiasekarang="+usiasekarang+"&carabayarjsprestasi="+carabayarjsprestasi,
			success : function(data) {
				$("#tabelpremicicil5tahun").val(data);
			}
		});

	});
</script>