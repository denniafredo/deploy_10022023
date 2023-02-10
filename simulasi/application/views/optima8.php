<div class="form-group">
	<label class="control-label col-md-3">Jumlah Premi Sekaligus
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-4">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Premi Sekaligus" type="text" name="premisekaligus8" id="premisekaligus" onchange="">
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
		<span class="help-block">
			Masukkan Jumlah Premi
		</span>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Masa Asuransi
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-4">
			<select class="form-control" name="masaasuransi" id="masaasuransi">
				<option value="">---Pilih Masa Asuransi---</option>
				<option value="4">4 Tahun</option>
				<option value="5">5 Tahun</option>
			</select>
		<span class="help-block">
			Masukkan Lama Asuransi
		</span>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Mulai Asuransi<span class="required">
		 *
	</span></label>
	
	<div class="col-md-3">
		<input class="form-control form-control-inline input-small date-picker" name="mulas" id="mulas" size="16" type="text" value=""/>
		<span class="help-block">
			 Masukkan Tanggal Mulai Asuransi
		</span>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Jumlah Uang Asuransi<span class="required">
		 *
	</span></label>
	
	<div class="col-md-3">
		<div class="input-group">
			<span class="input-group-addon">
				<i>Rp.</i>
			</span>
			<input class="form-control" placeholder="Jumlah Uang Asuransi" type="text" name="uangasuransi" id="uangasuransi" disabled>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
		<span class="help-block">
			 Alokasi Proteksi
		</span>
	</div>
</div>
<div class="form-group" hidden="true">
	<label class="control-label col-md-3">Nomor Financial Consultant<span class="required">
		 
	</span></label>
	
	<div class="col-md-3">
			<input class="form-control" placeholder="Nomer Agen" type="text" name="nomeragen" id="nomeragen">
		<span class="help-block">
			 Masukkan nomer agen, kosongkan bila tidak ada.
		</span>
	</div>
</div>
<div class="form-group" hidden="true">
	<label class="control-label col-md-3">Nama Financial Consultant<span class="required">
		 
	</span></label>
	
	<div class="col-md-3">
			<input class="form-control" placeholder="Nama Agen" type="text" name="namaagen" id="namaagen">
		<span class="help-block">
			 Masukkan nama agen, kosongkan bila tidak ada.
		</span>
	</div>
</div>
<hr></hr>
<h3>Perbandingan Deposito Bank</h3>
<div class="form-group">
	<label class="control-label col-md-3">Bunga Per Tahun
	<span class="required">
		 *
	</span>
	</label>
	<div class="col-md-4">
		<div class="input-group">
			
			<input class="form-control" placeholder="Bunga Deposito" type="text" name="bungadeposito" id="bungadeposito" onchange="hitungbunga(this);" value="6.5">
			<span class="input-group-addon">
				<i>%</i>
			</span>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Pajak
	</label>
	<div class="col-md-4">
		<div class="input-group">
			
			<input class="form-control" placeholder="Pajak" type="text" name="pajak" id="pajak" onchange="hitungbunga(this);" value="20">
			<span class="input-group-addon">
				<i>%</i>
			</span>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3">Bunga Netto
	</label>
	<div class="col-md-4">
		<div class="input-group">
			
			<input class="form-control" placeholder="Pajak" type="text" name="bunganett" id="bunganett" value="5.2">
			<span class="input-group-addon">
				<i>%</i>
			</span>
			<!--input class="form-control" placeholder="" type="hidden" name="minpremi" value="<?= $details->min_premi; ?>"-->
		</div>
	</div>
</div>
<script>
    jQuery(document).ready(function() {       
       // initiate layout and plugins
       App.init();
       ComponentsPickers.init();
    });   
    function calculate_sale_price(input)
	{
	    //premi = document.getElementById('premisekaligus');
	   // alokasi = document.getElementById('alokasiproteksi');
	    uangasuransi = document.getElementById('uangasuransi');
		
		//var nilai = premi.value;
		//var premisekaligus = nilai.replace(",", ""); 
		var val = $('#premisekaligus').val();
		
		//alert(val);
		
	    //var proteksi= (premi.value != '' && premi.value>=5000000) ? premi.value * 0.07 : 0;
	    //var jua = (val.value != '' && val=5000000) ? (val.value * 130)/100: 0;
		//alert(val);
	   // alokasi.value = proteksi.toFixed(2);
	    //uangasuransi.value = (val * 130)/100;
		
		var asuransi = (val !=='' && val >= 50000000) ? (val * 130)/100:'(empty)';
	    $('#uangasuransi').val(val);
	}
	function hitungbunga(input)
	{
	    bunga = document.getElementById('bungadeposito');
	    pajak = document.getElementById('pajak');
	    bunganett = document.getElementById('bunganett');
	    var netto= bunga.value * (1-(pajak.value/100));
	    bunganett.value = netto.toFixed(2);
	    
	}
</script>
<script type="text/javascript">
			
			$(function(){
				// Set up the number formatting.
				
				$('#number_container').slideDown('fast');
				
				$('#premisekaligus').on('change',function(){
					console.log('Change event.');
					var val = $('#premisekaligus').val();
					$('#the_number').text( val !== '' ? val : '(empty)' );
				});
				
				$('#premisekaligus').number( true, 0 );
				$('#uangasuransi').number( true, 0 );
				//$('.limitnumber').number( true, 2 );
				
				// Get the value of the number for the demo.
				$('#get_number').on('click',function(){
					
					var val = $('#premisekaligus').val();
					
					$('#the_number').text( val !== '' ? val : '(empty)' );
				});
			});
		</script>
		
<script type="text/javascript">
$( "#premisekaligus" ).keyup(function() {
	//var val = $('#premisekaligus').val();
		var val = $('#premisekaligus').val();
					
		$('#the_number').text( val !== '' ? val : '(empty)' );
		//alert(val);
		//alert(val);
	    //var proteksi= (premi.value != '' && premi.value>=5000000) ? premi.value * 0.07 : 0;
	    //var jua = (val.value != '' && val=5000000) ? (val.value * 130)/100: 0;
		//alert(val);
	   // alokasi.value = proteksi.toFixed(2);
	    //uangasuransi.value = (val * 130)/100;
		
		var asuransi = (val !=='' && val >= 50000000) ? (val * 130)/100:'(empty)';
	    $('#uangasuransi').val(asuransi);
// Check input( $( this ).val() ) for validity here
});
</script>