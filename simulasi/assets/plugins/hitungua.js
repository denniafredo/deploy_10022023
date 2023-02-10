(function($) {
$( "#premisekaligus" ).change(function() {
	var val = $('#premisekaligus').val();
		
		//alert(val);
		
	    //var proteksi= (premi.value != '' && premi.value>=5000000) ? premi.value * 0.07 : 0;
	    //var jua = (val.value != '' && val=5000000) ? (val.value * 130)/100: 0;
		//alert(val);
	   // alokasi.value = proteksi.toFixed(2);
	    //uangasuransi.value = (val * 130)/100;
		
		var asuransi = (val !=='' && val >= 5000000) ? (val * 130)/100:'(empty)';
	    $('#uangasuransi').val(asuransi);
// Check input( $( this ).val() ) for validity here
});
}(jQuery));