function AhliWaris(theForm){
var polis=theForm.pertanggungan.value;
 if (!polis =='') { 
  var prefix=polis.substring(0,2);
	var noper=polis.substring(3);
	window.open('ahliwaris.php?prefix='+prefix+'&noper='+noper+'','ahliwaris','width=400,height=300,top=100,left=50,scrollbars=yes')
 }	
}

function LoadPolis (theForm) {
prefix = theForm.prefixpertanggungan.value;
noper = theForm.nopertanggungan.value;
loadOK = true;
 if ( prefix == '' && loadOK) {
  alert('Masukkan Prefix Pertanggungan atau \nKlik Pilih Polis');
	theForm.prefixpertanggungan.focus();
	theForm.prefixpertanggungan.select();
	loadOK = false;
 }
 if ( ( noper == '' || noper=='000000000') && loadOK ) {
  alert('Masukkan Nomor Pertanggungan');
	theForm.prefixpertanggungan.focus();
	theForm.prefixpertanggungan.select();
	loadOK = false;
 }
 if (loadOK) {  
   OpenWin(prefix,noper);
 }
 return loadOK
}

function KartuPremi(theForm){
var polis=theForm.pertanggungan.value;
 if (!polis =='') { 
  var prefix=polis.substring(0,2);
	var noper=polis.substring(3);
	NewWindow('kartupremi1.php?prefix='+prefix+'&noper='+noper+'','kartupremi',700,600,1)
 }	
}


function OnSumbit(theForm) {
 if (theForm.pertanggungan.value=='') {
  alert('Nomor Polis Kosong, Masukkan Nomor Polis!')
	return false
 } else { 
	if (confirm('Sudah Benar ?')) {
	 return true
	} else {
	 return false
	}	
 }	
}

function AhliWaris(theForm){
var polis=theForm.pertanggungan.value;
 if (!polis =='') { 
  var prefix=polis.substring(0,2);
	var noper=polis.substring(3);
	NewWindow('ahliwaris.php?prefix='+prefix+'&noper='+noper+'','ahliwaris',400,300,1)
 }	
}

function Ganti(theForm) {
 var kdbayar=theForm.kdbayar.value;
 kode=kdbayar.substring(3);
 k2=kdbayar.substring(3,5);
 k=kdbayar.substring(0,1);
 //alert('k2='+k2+'; k='+k);
 //if (k=='G' ||k=='T') {
 /*
 if (k=='G') {
  window.location.replace('pembayarankeluar.php?kdbayar='+kdbayar+'');
 } else if (k=='S') {
  window.location.replace('pembayaransuspend.php?kdbayar='+kdbayar+'');
 } else if (k=='K') {
  window.location.replace('bayarkomisi.php?kdbayar='+kdbayar+'');
 } else {
  window.location.replace('bayar.php?kdklaim='+kode+'');
 }
 */
 if (k2=='GA' || k2=='TE') {
  window.location.replace('pembayarankeluar.php?kdbayar='+kdbayar+'');
 } else if (k2=='SU') {
  window.location.replace('pembayaransuspend.php?kdbayar='+kdbayar+'');
 } else if (k=='KO') {
  window.location.replace('bayarkomisi.php?kdbayar='+kdbayar+'');
 } else {
  window.location.replace('bayar.php?kdklaim='+kode+'');
 }
 
}