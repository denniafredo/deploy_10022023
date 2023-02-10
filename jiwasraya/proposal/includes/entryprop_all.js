function modelesswin(url,mwidth,mheight){
if (document.all&&window.print) //if ie5
eval('window.showModelessDialog(url,"","help:0;resizable:1;dialogWidth:'+mwidth+'px;dialogHeight:'+mheight+'px")')
else
eval('window.open(url,"","width='+mwidth+'px,height='+mheight+'px,resizable=1,scrollbars=1")')
}

var win= null;
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}

function Cari(theForm){
				 NewWindow('../proposal/cariklien1.php','caripage',650,400,1);
				
}

function Pempol(theForm){
var	 ttg1 = theForm.notertanggung.value;
			if (!ttg1==''){	 
				 NewWindow('../proposal/pempolpempre.php?n=1&c='+ttg1+'','page',600,400,1);
			}			
}	 

function ProdukValuta(theForm){
var  kp = theForm.kdproduk.value;	
var  usia = theForm.usia_th.value;	
var  masa = theForm.lamapembpremi_th.value;			 
var  cb = theForm.kdcarabayar.value;			 
			   NewWindow('../proposal/produkvaluta.php?kp='+kp+'&cb='+cb+'&masa='+masa+'&usia='+usia+'','pvpage',300,300,1);
}

function Pempre(theForm){
var ttg2 = theForm.notertanggung.value;
			if (!ttg2==''){	 
				 NewWindow('../proposal/pempolpempre.php?n=2&c='+ttg2+'','page',600,400,1);
			}
}
function usai(theForm){
var prd = theForm.kdproduk.value;
var ttgg = theForm.notertanggung.value;
var tglmulas = theForm.mulas.value;
 if ((ttgg=='')||(ttgg=='0000000000')){
  alert ('Masukkan Nomor Tertanggung');
 } else if (tglmulas=='') {	
 	alert ('Tanggal Mulai Asuransi Kosong.\n Mohon Diisi Terlebih Dahulu');
	theForm.mulas.focus();		
  return false;
 } else {		
			   NewWindow('../proposal/hitungusia1.php?prd='+prd+'&a='+tglmulas+'&c='+ttgg+'','popupusia',350,200,1)
  return true
 }
}

function HitungUsia(theForm){
	 var prd = theForm.kdproduk.value;
	 var cb = theForm.kdcarabayar.value;
	 var ttgg = theForm.notertanggung.value;
	 var tglmulas = theForm.mulas.value;
 if ((ttgg=='')||(ttgg=='0000000000')||(tglmulas=='')){
   return false
 } else {		
	 NewWindow('../proposal/hitungusia1.php?cb='+cb+'&prd='+prd+'&a='+tglmulas+'&c='+ttgg+'','popupusia',350,200,1)
   return true
 }
}

function IndexAwal(theForm){
		var	 val = theForm.kdvaluta.value;
		var	 tgl = theForm.tglbp3.value;
		 if (theForm.kdstatusmedical[1].checked) {
		  //alert ('Masukkan Tanggal BP3');
		  //theForm.tglbp3.focus();
		  NewWindow('../proposal/indexawal.php?val='+val+'&tgl='+tgl+'','popupindexawal',210,50,1)
		  return false;
		 } else {
		  NewWindow('../proposal/indexawal.php?val='+val+'&tgl='+tgl+'','popupindexawal',210,50,1)
		  return true;
		 }	
	   
}		

function tgl1(){
				 var now = new Date();
				 hari = now.getDate () ;hari= '0'+hari;
				 bulan = now.getMonth() +1;bulan= '0'+bulan;
 				 if (hari.length==3){
				 hari=hari.substr(1,2)
				 }
				 if (bulan.length==3){
				 bulan=bulan.substr(1,2)
				 }
				 tahun = now.getYear();
				 document.ntryprop.tglsp.value=hari+"/"+bulan+"/"+tahun;
}

function TanggalMulas(){
var tglsp = document.ntryprop.tglsp.value;
 temp = '01'+tglsp.substr(2);
 document.ntryprop.mulas.value=temp;
}

function expir () {
				 var cicil = document.ntryprop.kdcarabayar.value;
  			 var lamath = "";
				 var lamabl = "";
				 var a = "";
				switch (cicil){
				 case 'E':{
				  lamath=5;
					lamabl=0;
				 }
				 break;
				 case 'X':{
				  lamath=0;
					lamabl=0;
				 }
				 break;
				 case 'J':{
				  lamath=10;
					lamabl=0;				 
				 }
				 break;
				 default:{				  				 				 
				 lamath = document.ntryprop.lamapembpremi_th.value;
				 lamabl = document.ntryprop.lamapembpremi_bl.value;
				 }
				} 
				 if (lamabl=='') {
				 lamabl=lamabl+0
				 }
				 if (lamath=='') {
				 lamath=lamath+0
				 }
				 a= document.ntryprop.mulas.value;
				 mulashr = ""+a.charAt(0)+a.charAt(1)+""; 
				 mulasbl = ""+a.charAt(3)+a.charAt(4)+""; 
				 mulasth = ""+a.charAt(6)+a.charAt(7)+a.charAt(8)+a.charAt(9)+""; 
				 mulasbl = eval(mulasbl) 
				 mulasth = eval(mulasth)
				 lamabl = eval(lamabl)
				 lamath = eval(lamath)
				 
				 bulan = (mulasbl + lamabl); tahun = (lamath + mulasth);
	
				 if (bulan < 13){
				 		tahun = lamath + mulasth;
					}
				 else {
				 		tahun = lamath + mulasth;	
				 			do {
				 			tahun+=1 ;				
							bulan = bulan - 12;}
							while (bulan > 12);
					}
					if (tahun<0){tahun = 0; }
					
					document.ntryprop.akhirpremi.value=mulashr+"/"+bulan+"/"+tahun;
					
}					


function expirass () {

  			 var lamath = "";
				 var lamabl = "";
				 var a = "";
				 lamath = document.ntryprop.lamaasuransi_th.value;
				 lamabl = document.ntryprop.lamaasuransi_bl.value;
				 if (lamabl=='') {
				 lamabl=lamabl+0
				 }
				 if (lamath=='') {
				 lamath=lamath+0
				 }
				 a= document.ntryprop.mulas.value;

				 mulashr = ""+a.charAt(0)+a.charAt(1)+""; 
				 mulasbl = ""+a.charAt(3)+a.charAt(4)+""; 
				 mulasth = ""+a.charAt(6)+a.charAt(7)+a.charAt(8)+a.charAt(9)+""; 
				 mulasbl = eval(mulasbl) 
				 mulasth = eval(mulasth)
				 lamabl = eval(lamabl)
				 lamath = eval(lamath)
				 
				 bulan = (mulasbl + lamabl); tahun = (lamath + mulasth);
	
				 if (bulan < 13){
				 		tahun = lamath + mulasth;
					}
				 else {
				 		tahun = lamath + mulasth;	
				 			do {
				 			tahun+=1 ;				
							bulan = bulan - 12;}
							while (bulan > 12);
					}
					if (tahun<0){tahun = 0; }
					document.ntryprop.expirasi.value=mulashr+"/"+bulan+"/"+tahun;
}

function MaxJuaPremi() {
  var vproduk	 =document.ntryprop.kdproduk.value;
	var vjuapremi=document.ntryprop.premijua.value;
	var kdvaluta = document.ntryprop.kdvaluta.value;
	var kdcabar = document.ntryprop.kdcarabayar.value;
	
	var vnilai=document.ntryprop.nilai.value;
		  window.open('../proposal/cekmaxjuapremi.php?juapremi='+vjuapremi+'&kdproduk='+vproduk+'&nilai='+vnilai+'&kdvaluta='+kdvaluta+'&kdcarabayar='+kdcabar+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
}

function CekAwalMulas() {
  var vproduk	= document.ntryprop.kdproduk.value;
	var vtglsp = document.ntryprop.tglsp.value;
	var vmulas = document.ntryprop.mulas.value;
		  window.open('../proposal/cektglmulas.php?kdproduk='+vproduk+'&tglsp='+vtglsp+'&mulas='+vmulas+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
}

function JuaPremi() {

			a = document.ntryprop.premijua.value
			cb = document.ntryprop.kdcarabayar.value
			b = document.ntryprop.nilai.value
			
			var vproduk	 =document.ntryprop.kdproduk.value;
			vproduk=vproduk.substr(0,4);
			
			   if (!cb=='X') {
              if (a == "jua"){
                  isi =  "Premi 5 Tahun Pertama ";
									isi = isi + ":&nbsp;&nbsp;&nbsp;";
									isi = isi + "<input type=\"text\" size=\"13\" name=\"premi1\" maxlength=\"13\" readonly class=\"a\">" ;
                  isi = isi + "<input type='hidden' name='juamainproduk' value="+b+">";
									document.ntryprop.buton.disabled=true;
									document.ntryprop.buton.value = "Hitung Premi";
									document.ntryprop.submit.disabled=true;
									document.ntryprop.buton.title = "Hitung Premi";
									document.ntryprop.cekpolis.disabled=false;
									document.ntryprop.cekpolis.focus();
							}  else {
		  					 	isi =  "J U A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									isi = isi + ":&nbsp;&nbsp;&nbsp;";
									isi = isi + "<input type=\"text\" size=\"13\" name=\"juamainproduk\" maxlength=\"13\" readonly  class=\"a\">" ;
								 	isi = isi + "<input type='hidden' name='premi1' value="+b+">";
									document.ntryprop.buton.disabled=false;
									document.ntryprop.submit.disabled=true;
									document.ntryprop.cekpolis.disabled=true;
                 	document.ntryprop.buton.value = "Hitung JUA";
									document.ntryprop.buton.title = "Hitung JUA";
		  				}
				 } else {
              if (a == "jua"){
                  isi =  "Premi 5 Tahun Pertama ";
									isi = isi + ":&nbsp;&nbsp;&nbsp;";
									isi = isi + "<input type=\"text\" size=\"13\" name=\"premi1\" maxlength=\"13\" readonly class=\"a\">" ;
                  isi = isi + "<input type='hidden' name='juamainproduk' value="+b+">";
									document.ntryprop.buton.disabled=true;
									document.ntryprop.buton.value = "Hitung Premi";
									document.ntryprop.submit.disabled=true;
									document.ntryprop.buton.title = "Hitung Premi";
									document.ntryprop.cekpolis.disabled=false;
									document.ntryprop.cekpolis.focus();
							}  else {
		  					 	isi =  "J U A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									isi = isi + ":&nbsp;&nbsp;&nbsp;";
									isi = isi + "<input type=\"text\" size=\"13\" name=\"juamainproduk\" maxlength=\"13\" readonly  class=\"a\">" ;
								 	isi = isi + "<input type='hidden' name='premi1' value="+b+">";
									document.ntryprop.submit.disabled=true;
									//document.ntryprop.cekpolis.disabled=false;
                 	//document.ntryprop.buton.disabled=false;
									//document.ntryprop.buton.value = "Hitung JUA";
									//document.ntryprop.buton.title = "Hitung JUA";
								  
									// untuk produk JSHF ditambahkan tanggal 28 maret 07 atas permintaan pak Ari 
								  if(vproduk=='JSHF')
				 					{
									document.ntryprop.cekpolis.disabled=false;
									document.ntryprop.premijua.value='jua';
									document.ntryprop.nilai.value='5000000';
									document.ntryprop.buton.disabled=true;
									document.ntryprop.buton.value = "Hitung JUA";
									document.ntryprop.buton.title = "Hitung JUA";
									}
									else
									{
									document.ntryprop.cekpolis.disabled=true;
									document.ntryprop.buton.disabled=false;
                 	document.ntryprop.buton.value = "Hitung JUA";
									document.ntryprop.buton.title = "Hitung JUA";
		  						}
								 
								 vara = document.ntryprop.vara.value;
 								 if (!vara == 1 ) {
  							   document.ntryprop.vara.value=0;
 								 }	
									
							}		
				 }			  			
							if (document.layers) {
            	document.layers.kam.document.write(isi);
            	document.layers.kam.document.close();
         			}  else {
              	 if (document.all) {
                 kam.innerHTML = isi;
              	 }
         			}
}

function HitungJUA () {
 
 nopertanggungan = document.ntryprop.nopertanggungan.value;
 noproposal = document.ntryprop.noproposal.value;
 kdproduk = document.ntryprop.kdproduk.value;
 notertanggung = document.ntryprop.notertanggung.value;
 nosp = document.ntryprop.nosp.value;
 nokln = document.ntryprop.notertanggung.value;

 if (document.ntryprop.kdstatusmedical[0].checked==true){ 
   kdstatusmedical='M';
 } else { 
   kdstatusmedical='N'; 
 }	 

 tglsp = document.ntryprop.tglsp.value;
 mulas = document.ntryprop.mulas.value;
 usia_th = document.ntryprop.usia_th.value;
 usia_bl = document.ntryprop.usia_bl.value;
 nobp3 = document.ntryprop.nobp3.value;
 tglbp3 = document.ntryprop.tglbp3.value;
 lamaasuransi_th = document.ntryprop.lamaasuransi_th.value;
 lamaasuransi_bl = document.ntryprop.lamaasuransi_bl.value;
 expirasi = document.ntryprop.expirasi.value;
 akhirpremi = document.ntryprop.akhirpremi.value;
 lamapembpremi_th = document.ntryprop.lamapembpremi_th.value;
 lamapembpremi_bl = document.ntryprop.lamapembpremi_bl.value;
 kdvaluta = document.ntryprop.kdvaluta.value;
 kdcarabayar = document.ntryprop.kdcarabayar.value;
 indexawal = document.ntryprop.indexawal.value;
 nopenagih = document.ntryprop.nopenagih.value;
 noagen = document.ntryprop.noagen.value ;
 pempolno = document.ntryprop.pempolno.value;
 premijua = document.ntryprop.premijua.value;
 pempreno = document.ntryprop.pempreno.value;
 juamainproduk = document.ntryprop.juamainproduk.value;
 premi1 = document.ntryprop.premi1.value;
 vara = document.ntryprop.vara.value;
 risk = document.ntryprop.risk.value;
 kdper = document.ntryprop.kdper.value;
 prefixpertanggungan = document.ntryprop.prefixpertanggungan.value;
 
 if (document.ntryprop.bpo.checked==true ) {
  bpo = '1'; 
 } else { 
  bpo = '0';
 }
 if (nobp3=='') {
   nobp3='NULL';
 }
 if (tglbp3=='') {
   tglbp3='NULL';
 }
//hitung benefit
 NewWindow('../proposal/hitungpremijua.php?prefixpertanggungan='+prefixpertanggungan+'&kdper='+kdper+'&bpo='+bpo+'&vara='+vara+'&kdproduk='+kdproduk+'&nopertanggungan='+nopertanggungan+'&noproposal='+noproposal+'&kdstatusmedical='+kdstatusmedical+'&akhirpremi='+akhirpremi+
											'&nobp3='+nobp3+'&tglbp3='+tglbp3+'&notertanggung='+notertanggung+'&nosp='+nosp+'&tglsp='+tglsp+'&mulas='+mulas+'&premijua='+premijua+
											'&usia_bl='+usia_bl+'&usia_th='+usia_th+'&lamaasuransi_th='+lamaasuransi_th+'&lamasuransi_bl='+lamaasuransi_bl+'&expirasi='+expirasi+
											'&lamapembpremi_th='+lamapembpremi_th+'&lamapembpremi_bl='+lamapembpremi_bl+'&kdvaluta='+kdvaluta+'&kdcarabayar='+kdcarabayar+
											'&indexawal='+indexawal+'&nopenagih='+nopenagih+'&noagen='+noagen+'&premi1='+premi1+
											'&nopemegangpolis='+pempolno+'&nopembayarpremi='+pempreno+'&juamainproduk='+juamainproduk+'&risk='+risk+													
				 							'','popupHPJ',800,400,1);

document.ntryprop.buton.disabled = true;

}


function Beneficiari() {
	var	a = document.ntryprop.notertanggung.value;
  var b = Number(document.ntryprop.demit.value);
	document.ntryprop.demit.value = b+1;
	

	
	for (x=0; x<document.ntryprop.length; x++) {
	 if (document.ntryprop.elements[x].type=="text") {
	  if (document.ntryprop.elements[x].name=="no1") {
	  } else {
		 i=b+1;
		 if (i>8){i-=8}
		}
	 }
	}
	var as = Number(i);
	document.ntryprop.maxdemit.value = as;
	
					 isi =  " <tr> ";
					 isi = isi + "<td width=\"3%\"> ";
				   isi = isi + "<input class=\"buton\" type=\"button\" value=\"   "+i+"   \" ";
					 isi = isi + "onclick=\"NewWindow(\'../proposal/insurable.php?n="+i+"&c="+a+"\',\'popuppage\',600,400,1);\" ";
					 isi = isi + "onmouseover=\"window.status=\'Klik untuk menambah data beneficiary\'\" onmouseout=\"window.status=\'\'\"></td>";
					 isi = isi + "<td ><input type=\"text\" name=\"no"+i+"\" maxlength=\"1\" size=\"1\" readonly class=\"a\"></td>";
					 isi = isi + "<td ><input type=\"text\" name=\"nama"+i+"\" size=\"40\" readonly class=\"a\"></td>";
					 isi = isi + "<td ><input type=\"text\" name=\"klienno"+i+"\" maxlength=\"10\" size=\"10\" readonly class=\"a\"></td>";
					 isi = isi + "<td ><input type=\"text\" name=\"hubungan"+i+"\" size=\"30\" readonly class=\"a\"></td>";
					 isi = isi + "</tr>";
			
        if (document.layers) {
           document.layers.pret1.document.write(isi);
           document.layers.pret2.document.write(isi);
           document.layers.pret3.document.write(isi);
           document.layers.pret4.document.write(isi);
           document.layers.pret5.document.write(isi);
           document.layers.pret6.document.write(isi);
           document.layers.pret7.document.write(isi);
           document.layers.pret8.document.write(isi);
           document.layers.pret1.document.close();
         	 document.layers.pret2.document.close();
           document.layers.pret3.document.close();
         	 document.layers.pret4.document.close();
         	 document.layers.pret5.document.close();
         	 document.layers.pret6.document.close();
         	 document.layers.pret7.document.close();
         	 document.layers.pret8.document.close();
			 }
         else {
				 //alert(i)
             if (document.all) {
						 		if (i==1){
						 		pret1.innerHTML = isi;
              	 }
						 		if (i==2){
						 		pret2.innerHTML = isi;
              	 }
						 		if (i==3){
						 		pret3.innerHTML = isi;
              	 }
						 		if (i==4){
						 		pret4.innerHTML = isi;
              	 }
						 		if (i==5){
						 		pret5.innerHTML = isi;
              	 }
						 		if (i==6){
						 		pret6.innerHTML = isi;
              	 }
						 		if (i==7){
						 		pret7.innerHTML = isi;
              	 }
						 		if (i==8){
						 		pret8.innerHTML = isi;
              	 }

							}
         } 
	}	

function BeneficiariDel() {
	var isi = '';		
	var c = Number(document.ntryprop.demit.value);	
	c=c-1;
	if (c>8 && c>0){c-=8}
	document.ntryprop.demit.value = Number(Math.abs(c));
	i=c+1;
	       if (document.layers) {
           document.layers.pret1.document.write(isi);
           document.layers.pret2.document.write(isi);
           document.layers.pret3.document.write(isi);
           document.layers.pret4.document.write(isi);
           document.layers.pret5.document.write(isi);
           document.layers.pret6.document.write(isi);
           document.layers.pret7.document.write(isi);
           document.layers.pret8.document.write(isi);
           document.layers.pret1.document.close();
         	 document.layers.pret2.document.close();
           document.layers.pret3.document.close();
         	 document.layers.pret4.document.close();
         	 document.layers.pret5.document.close();
         	 document.layers.pret6.document.close();
         	 document.layers.pret7.document.close();
         	 document.layers.pret8.document.close();
			 }
         else {
				 //alert(i)
             if (document.all) {
						 		if (i==1){
						 		pret1.innerHTML = isi;
              	 }
						 		if (i==2){
						 		pret2.innerHTML = isi;
              	 }
						 		if (i==3){
						 		pret3.innerHTML = isi;
              	 }
						 		if (i==4){
						 		pret4.innerHTML = isi;
              	 }
						 		if (i==5){
						 		pret5.innerHTML = isi;
              	 }
						 		if (i==6){
						 		pret6.innerHTML = isi;
              	 }
						 		if (i==7){
						 		pret7.innerHTML = isi;
              	 }
						 		if (i==8){
						 		pret8.innerHTML = isi;
              	 }

							}
         } 
	}	
function AmbilNilai (theform){
if (document.all || document.getElementById) {
	 for (i = 0; i < theform.length; i++) {
			 tempobj = new Array();
		 	 tompobj = new Array();
			 tempobj[i] = theform.elements[i].value;
			 tompobj[i] = theform.elements[i].name;
			 //alert(tompobj[i]+" | "+tempobj[i]);
		}
} 
}
function Klear(theForm) {
var a = theForm.maxdemit.value;
    for (b=1; b<=a; b++) {
		 theForm.kurang.click()
		}

 for (i=0; i<theForm.length; i++){
  if (theForm.elements[i].type=='text') {
	 if (theForm.elements[i].name=='tglbp3'||theForm.elements[i].name=='tglsp'||theForm.elements[i].name=='noagen') {
	 } else {
	  theForm.elements[i].value = '';
		theForm.demit.value = 0;
		theForm.maxdemit.value = 0;
	 } 
	}
 } 
}

function IsFormComplete(FormName)
{
var x       = 0
var FormOk  = true

while ((x < document.ntryprop.elements.length) && (FormOk))
   {
     if (document.ntryprop.elements[x].value == '')
     { 
        alert('Masukkan nilai  '+document.ntryprop.elements[x].name +' dan ulangi lagi.')
        document.ntryprop.elements[x].focus()
        FormOk = false 
     }
     x ++
   }
return FormOk
}

function placeFocus() {
if (document.forms.length > 0) {
var field = document.forms[0];
for (i = 0; i < field.length; i++) {
if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
document.forms[0].elements[i].focus();
break;
         }

      }
   }
}

function disableForm(theform) {
if (document.all || document.getElementById) {
for (i = 0; i < theform.length; i++) {
var tempobj = theform.elements[i];
if (tempobj.type.toLowerCase() == "submit" || tempobj.type.toLowerCase() == "reset")

tempobj.disabled = true;
}
setTimeout('alert("Form Segera Diproses. Mohon Tunggu.")', 5000);
return true;
}
else {
alert("Form Diproses.");
return false;
   }
}

function hitunglamas() {
var ul = document.ntryprop.usia_lpp.value;
var lp = document.ntryprop.lamapembpremi_th.value;
switch (ul){
			 case 'U' : {
	 		 			document.ntryprop.lamaasuransi_th.value = document.ntryprop.lamapembpremi_th.value;
						
			 } break;
			 case 'L' : { 
	 		 			document.ntryprop.lamaasuransi_th.value = eval(document.ntryprop.pariabel.value) + eval(document.ntryprop.lamapembpremi_th.value);
			 } break;		
			 case 'X' : { 
	 		 			document.ntryprop.lamaasuransi_th.value = eval(document.ntryprop.pariabel.value)-eval(document.ntryprop.usia_th.value);
			 } break;		
			 
}

}

function cek_masapremi() {
  var upper = (document.ntryprop.lama_max.value=='') ? 0 : eval(document.ntryprop.lama_max.value);
  var ul = document.ntryprop.usia_lpp.value;
  var usia = eval(document.ntryprop.usia_th.value);
  var varia = eval(document.ntryprop.pariabel.value);
  var mp = varia - usia;
  var lower = (document.ntryprop.lama_min.value=='') ? mp : eval(document.ntryprop.lama_min.value);
  var lamapremi = eval(document.ntryprop.lamapembpremi_th.value);
 	var lamapremi_def = eval(document.ntryprop.lamapembpremi_th_default.value);
	
	var vproduk	 =document.ntryprop.kdproduk.value;
	var vproduk2	 =document.ntryprop.kdproduk.value;
	
	vproduk=vproduk.substr(0,2);
	vproduk2=vproduk2.substr(0,5);

	// ditutup oleh kadek tgl 13 jan 2006 berdasarkan nota intern 12 jan 2006
	/*
	if(vproduk=='AD' || vproduk=='HT')
	{
	  if(lamapremi!=lamapremi_def)
		{
			document.ntryprop.lamapembpremi_th.focus();
			alert("Lama premi untuk produk Artha Dana dan Siharta tidak boleh berubah");
			return false
		}
	}
	*/
	var tglsp = document.ntryprop.tglsp.value;
	vtglsppot = tglsp.substr(0,2);
	vblnsppot = tglsp.substr(3,2);

	if((vproduk2=='JSSPO' && lamapremi> 5) || (vproduk2=='JSSPO' && lamapremi< 4))
	{
		  document.ntryprop.lamapembpremi_th.focus();
  		alert('Perhatian ! \n Produk JSSPO* hanya ada usia 4 dan 5');
  		return false
	}
	
	// request by Ari faisal tanggal 5 Feb 2007
	/*
	
	if(vproduk2=='JSSPO')// && lamapremi=='5')
	{
	    //alert('lama premi = '+lamapremi+'')
		
			if(lamapremi=='5')
    	{
    	   document.ntryprop.lamapembpremi_th.focus();
  			 alert('Perhatian ! \n Lama premi 5 untuk produk JSSPO* sudah ditutup diatas tanggal 10 Feb 2007');
  			 return false
      }
			else 
    	{
    	   alert('Perhatian! \n Produk JSSPO* untuk masa premi 4 tahun akan ditutup mulai tanggal 9 April 2007');
    	}
			
	}
	
	
	var nm=document.ntryprop.kdstatusmedical[1].value;
	
	if (!(document.ntryprop.lamapembpremi_th=='')) {

	 		if ((varia ==''||ul=='')){
			  alert ("Setup Produk ini belum Lengkap, Hubungi Team XL-iNDO");
			  return false
			} else {

				if (!(lamapremi <= upper && lamapremi >= lower || lamapremi <= mp)) {
	 			 alert ('Lama Pembayaran Premi diluar batas ('+upper+' - '+lower+').\nMasukkan Lama Pembayaran Premi yang sesuai');
				 document.ntryprop.lamapembpremi_th.value='';
				 document.ntryprop.lamapembpremi_th.focus();
				 return false
				} else {
				
			 				
				 expir();hitunglamas();expirass()
				 if((usia+lamapremi)>60 && vproduk!='HT' &&  vproduk!='AD' && vproduk2!='JSSPO' && nm!='M')
				 {
				  expir();hitunglamas();expirass()
				 
				  var tb=confirm("Jumlah X dan N diatas 60.\n Setuju untuk masuk Medical ? ");
          if (tb==true){
            document.ntryprop.kdstatusmedical[0].checked=true;
						document.ntryprop.tglbp3.focus();
          }
					else
					{
					  document.ntryprop.lamapembpremi_th.value='';
					  document.ntryprop.lamapembpremi_th.focus();
					}
					return true
				 }
				}

			}
  } else {
   return false
  }	
 
 */
  
 
} 

function PopPenagih(){
skg = document.ntryprop.kdcarabayar.value;
 if (skg=='X') {
  NewWindow('pnglist.php?skg=1','popuppage',600,400,1);
 } else {
  NewWindow('pnglist.php','popuppage',600,400,1);
 }
}

//cek tinggi berat add 2111
function CekTB(){
var noklien = document.ntryprop.notertanggung.value;
				if ((eval(noklien) == 0)||(noklien=='')) {
				 alert("Masukkan nomor klien yang benar");			
				 document.ntryprop.notertanggung.focus();
				 return false
				} else {
					NewWindow('../proposal/cektinggiberat.php?noklien='+noklien+'','popupCekTB',200,100,1);			
				 return true
				}
}

function CekUsiaCabar(){
   var noklien = document.ntryprop.notertanggung.value;
	 var usiapert = document.ntryprop.usia_th.value;
	 var cbr = document.ntryprop.kdcarabayar.value;
	 
			if ((eval(noklien) == 0)||(noklien=='')) {
				 alert("Masukkan nomor klien yang benar");			
				 document.ntryprop.notertanggung.focus();
				 return false
			} else {
				 //alert("ini test");
					NewWindow('../proposal/cekprodukusia.php?noklien='+noklien+'&cbr='+cbr+'&usiapert='+usiapert+'','popupCekTB',200,100,1);			
				 return true
			}
}

function nottgOK() {
var nottg = document.ntryprop.notertanggung.value;
if ( nottg == "0000000000"){
	 
	 alert ("Masukkan Nomor Klien yang Benar");
	 document.ntryprop.notertanggung.value='';
	 document.ntryprop.cari.focus();
	 
}
}
function CekPolis () {
var indexawal = document.ntryprop.indexawal.value;
var nottg = document.ntryprop.notertanggung.value;
var jua = document.ntryprop.juamainproduk.value;
var nopertanggungan = document.ntryprop.nopertanggungan.value;
var juapremi = document.ntryprop.premijua.value;
var vara = document.ntryprop.vara.value;
var mulas = document.ntryprop.mulas.value;
var usia = document.ntryprop.usia_th.value;
var usiabl = document.ntryprop.usia_bl.value;
var kdproduk = document.ntryprop.kdproduk.value;
var masa = document.ntryprop.lamapembpremi_th.value;
var kdvaluta = document.ntryprop.kdvaluta.value;
var mode = document.ntryprop.mode.value;
var cb = document.ntryprop.kdcarabayar.value;
var p1 = document.ntryprop.premi1.value;
var idexawl=0;
 if (kdvaluta=='0'||kdvaluta=='1'){
  indexawl=1;
 } else {
  indexawl=indexawal;
 } 
 if (document.ntryprop.kdstatusmedical[0].checked==true){ 
  kdstatusmedical='M';
 } else { 
  kdstatusmedical='N'; 
 }	
 if (nottg==''){ 
  alert ("Masukkan Nomor Tertanggung");
  return false;
 } else {  
  NewWindow('../proposal/listpolis.php?mulas='+mulas+'&p1='+p1+'&cb='+cb+'&indexawal='+indexawl+'&kdstatusmedical='+kdstatusmedical+'&usia='+usia+'&usiabl='+usiabl+'&kdproduk='+kdproduk+'&masa='+masa+'&kdvaluta='+kdvaluta+'&mode='+mode+'&vara='+vara+'&tertanggung='+nottg+'&jua='+jua+'&noper='+nopertanggungan+'&premijua='+juapremi+'','popupCekPolis',900,400,1);
  return true; 
 }
}

function OnSumbit(theForm) {
 var d = theForm.demit.value;
 if (theForm.noagen.value=='') {
  alert('Agen Tidak Boleh Kosong!!')
	return false;
 } else if (theForm.nopenagih.value=='') {
  alert('Penagih Tidak Boleh Kosong!!')
	return false;
 } else {
  if (theForm.indexawal.value=='') {
   alert('Index Awal/Kurs Tidak Boleh Kosong!!\nKlik OK Maka Index Awal Sesuai Saat Ini')
	 theForm.kdvaluta.focus();
   return false;  
	} else { 
	 if ( d <= 0) {
    alert(d+'Ahli Waris Tidak Boleh Kosong!!')
	  return false;
   } else {
	  if (theForm.klienno1.value=='') {
     alert('Ahli Waris '+d+' Tidak Boleh Kosong!!')
	   return false;
	  } else {
	   return true;
	  }	
	 }
	}  
 }	
}
