function GantiJenisPemb() {
var kd = document.propmtc.kdpembayaran.value;
var windo = 'kasirentry'+kd+'.php';
var w = 'pelunasangadai.php?kdbayar='+kd+'';
var w1 = 'pelunasangadai1.php?kdbayar='+kd+'';
 if (kd.substring(0,1) == '1') {
  window.location.replace(w);
 } else if (kd.substring(0,1) == '2'){
  window.location.replace(w1);
 } else {
  window.location.replace(windo);
 }	
}

function CariPenagih(theForm) {
 	NewWindow('pnglist.php','',400,300,1)  
}

function CariAgen(theForm) {
 	//NewWindow('../proposal/agnlist.php?a=propmtc&b=noagen','',400,300,1)  
	NewWindow('agenlist.php','',400,300,1)  
}

function IsFormComplete(FormName){
var x       = 0
var FormOk  = true

while ((x < FormName.elements.length) && (FormOk))
   {
     if (FormName.elements[x].value == '')
     { 
        alert('Masukkan nilai  '+FormName.elements[x].name +' dan ulangi lagi.')
        FormName.elements[x].focus()
        FormOk = false 
     }
     x ++
   }
return FormOk
}

function BP(theForm) {
var bp=theForm.kdproduk.value;
//bp=bp.substring(3);
bp=3000;
theForm.biayapolis.value=bp;
}

/**/
function KartuPremi(theForm){
var polis=theForm.pertanggungan.value;
 if (!polis =='') { 
  var prefix=polis.substring(0,2);
	var noper=polis.substring(3);
	NewWindow('kartupremi1.php?prefix='+prefix+'&noper='+noper+'','kartupremi',700,600,1)
 }	
}

function KartuGadai(theForm){
var polis=theForm.pertanggungan.value;
 if (!polis =='') { 
  var prefix=polis.substring(0,2);
	var noper=polis.substring(3);
	NewWindow('kartugadai1.php?prefix='+prefix+'&noper='+noper+'','kartugadai',700,600,1)
 }	
}

