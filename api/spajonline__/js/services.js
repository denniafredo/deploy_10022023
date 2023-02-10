angular.module('app.services', [])
.factory('simpleFormValidatorByType', [function(){
	var strTest = '';
	var status = false;
	
	var tryRegex = function(typeToTry,data,regexString){
		if(typeToTry == (typeof data )){
			
			if(!((typeof data == 'string') && data.match('$/^[a-z\d\-_\s]+$/i') ) ){
				
			}
			
			
			return true;
		}else{
			return 'Type mismatch! '+ typeof data;
		}
	}
	
	return {
		tryRegex : tryRegex
	}
	
}])
.factory("$store",function($parse){
	/**http://jsfiddle.net/agrublev/QjVq3/
	 * Global Vars
	 */
	var storage = (typeof window.localStorage === 'undefined') ? undefined : window.localStorage,
		supported = !(typeof storage == 'undefined' || typeof window.JSON == 'undefined');

	var privateMethods = {
		/**
		 * Pass any type of a string from the localStorage to be parsed so it returns a usable version (like an Object)
		 * @param res - a string that will be parsed for type
		 * @returns {*} - whatever the real type of stored value was
		 */
		parseValue: function(res) {
			var val;
			try {
				val = JSON.parse(res);
				if (typeof val == 'undefined'){
					val = res;
				}
				if (val == 'true'){
					val = true;
				}
				if (val == 'false'){
					val = false;
				}
				if (parseFloat(val) == val && !angular.isObject(val) ){
					val = parseFloat(val);
				}
			} catch(e){
				val = res;
			}
			return val;
		}
	};
	var publicMethods = {
		/**
		 * Set - let's you set a new localStorage key pair set
		 * @param key - a string that will be used as the accessor for the pair
		 * @param value - the value of the localStorage item
		 * @returns {*} - will return whatever it is you've stored in the local storage
		 */
		set: function(key,value){
			if (!supported){
				try {
					$.cookie(key, value);
					return value;
				} catch(e){
					console.log('Local Storage not supported, make sure you have the $.cookie supported.');
				}
			}
			var saver = JSON.stringify(value);
			 storage.setItem(key, saver);
			return privateMethods.parseValue(saver);
		},
		/**
		 * Get - let's you get the value of any pair you've stored
		 * @param key - the string that you set as accessor for the pair
		 * @returns {*} - Object,String,Float,Boolean depending on what you stored
		 */
		get: function(key){
			if (!supported){
				try {
					return privateMethods.parseValue($.cookie(key));
				} catch(e){
					return null;
				}
			}
			var item = storage.getItem(key);
			return privateMethods.parseValue(item);
		},
		/**
		 * Remove - let's you nuke a value from localStorage
		 * @param key - the accessor value
		 * @returns {boolean} - if everything went as planned
		 */
		remove: function(key) {
			if (!supported){
				try {
					$.cookie(key, null);
					return true;
				} catch(e){
					return false;
				}
			}
			storage.removeItem(key);
			return true;
		},
		/**
	         * Bind - let's you directly bind a localStorage value to a $scope variable
	         * @param $scope - the current scope you want the variable available in
	         * @param key - the name of the variable you are binding
	         * @param def - the default value (OPTIONAL)
	         * @returns {*} - returns whatever the stored value is
	         */
	        bind: function ($scope, key, def) {
	            def = def || '';
	            if (!publicMethods.get(key)) {
	                publicMethods.set(key, def);
	            }
	            $parse(key).assign($scope, publicMethods.get(key));
	            $scope.$watch(key, function (val) {
	                publicMethods.set(key, val);
	            }, true);
	            return publicMethods.get(key);
	        }
	};
	return publicMethods;
})
.factory('syncService',[
function($interval){
  'use strict';
  var service = {
    clock: addClock,
    cancelClock: removeClock
  };
  
  var clockElts = [];
  var clockTimer = null;
  var cpt = 0;
  
  function addClock(fn){
    var elt = {
      id: cpt++,
      fn: fn
    };
    clockElts.push(elt);
    if(clockElts.length === 1){ startClock(); }
    return elt.id;
  }
  function removeClock(id){
    for(var i in clockElts){
      if(clockElts[i].id === id){
        clockElts.splice(i, 1);
      }
    }
    if(clockElts.length === 0){ stopClock(); }
  }
  function startClock(){
    if(clockTimer === null){
      clockTimer = $interval(function(){
        for(var i in clockElts){
          clockElts[i].fn();
        }
      }, 1000);
    }
  }
  function stopClock(){
    if(clockTimer !== null){
      $interval.cancel(clockTimer);
      clockTimer = null;
    }
  }
  
  return service;
} ])
.factory('spajProvider', [function(){
    var spajElement = [];
    var spajGUID = 'null';
	var storage = (typeof window.localStorage === 'undefined') ? undefined : window.localStorage,
		supported = !(typeof storage == 'undefined' || typeof window.JSON == 'undefined');
	
	var baseIcon = "data:image/png;base64,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";
	
	
	function convertDateFromUnixStamp(unixts){
		  var a = new Date(unixts * 1000);
		  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		  var year = a.getFullYear();
		  var month = months[a.getMonth()];
		  var date = a.getDate();
		  var hour = a.getHours();
		  var min = a.getMinutes();
		  var sec = a.getSeconds();
		  var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
		  return time;
	}
	
	function alertMessagebuilder(msg){
	   out = '';
	   console.log(msg);
	   if(msg && (msg.length > 0)){
		   out = '<div style="align:left;color:maroon;"><ul >';
		   for(i=0;i < msg.length;i++){
			   out += '<li>'+msg[i].message+'</li>';;
		   }
		   out += '</ul></div>'
	   } else {
		   return false;
	   }
	   
	   return out;
   }
	
    function touchstartListener(e){
            e.preventDefault();e.stopPropagation();
			
            cx = e.changedTouches[0].pageX - canvasOffsetX;
            cy = e.changedTouches[0].pageY - canvasOffsetY;

            paint = true;
            addClick(cx, cy);
            redraw();
    }
        
	function touchmoveListener(e){
		e.preventDefault();e.stopPropagation();
		cx = e.changedTouches[0].pageX - canvasOffsetX;
		cy = e.changedTouches[0].pageY - canvasOffsetY;
		
		if(paint){
			addClick(cx, cy, true);
			redraw();
		}
	}
	
	function touchendListener(e){
		e.preventDefault();e.stopPropagation();
		clickX = [];
		clickY = [];
		clickDrag = [];
		
		paint = false;
	}
		
	var init_ttd = function(canvasId){
		
		var myCanvas = canvasId;
			myCanvas.width = 600;
			myCanvas.height = 600;
			
			myCanvas.style.width  = '300px';
			myCanvas.style.height = '300px';

            context = myCanvas.getContext("2d");
            
            context.scale(2, 2);
            
            canvasOffsetX = myCanvas.getBoundingClientRect().left;
            canvasOffsetY = myCanvas.getBoundingClientRect().top;
            
            context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
            context.strokeStyle = "#0a0a0a";
            context.lineJoin = "round";
            context.lineWidth = 5;
            
            myCanvas.addEventListener('touchstart', touchstartListener, false);
            myCanvas.addEventListener('touchmove', touchmoveListener, false);
            myCanvas.addEventListener('touchend', touchendListener, false);

			
            //clearCanvas();
	}

	var takePictOf = function(inputElement,canvasId){
		if (inputElement.files && inputElement.files[0]) {
			mimeImgUpload = inputElement.files[0].type;
			var reader = new FileReader();
			var blob = null;
			reader.onload = function (e) {
				putImageToCanvas(e.target.result,canvasId);
				blob += e.target.result;
			}
			reader.readAsDataURL(inputElement.files[0]);

		}
	}
	
	var getBinImage = function(canvasId,cnvType){
		var canvas = document.getElementById(canvasId);
		var dataUrl = null;
		if(cnvType != '' && cnvType == 'jpg'){
			cnvType = "image/jpeg";
		}else if(cnvType == 'jpg'){
			cnvType = 'image/png';
		}
		
		dataUrl = canvas.toDataURL(cnvType, 0.6);
		//console.log(myBase64.encode(myBase64.encode(dataUrl)));
		return myBase64.encode(myBase64.encode(dataUrl));
	}
	
	var myBase64 = {
		encode: function(str){
			try{
				str = btoa(str);
			}catch(e){
				str = btoa(baseIcon);
			}
			
			return str;
		},
		decode: function(str){
			try{
				str = atob(str);
			}catch(e){
				str = atob(baseIcon);
			}
			return str;
		}
	}
	
	var putImageDataToCanvas = function(canvasId, pictData){
		var meCanvas = document.getElementById(canvasId);
			meCanvas.width = 500;
			meCanvas.height = 400;
		var ctxS = meCanvas.getContext("2d");
		
		var image = new Image();
		image.crossOrigin = 'Anonymous';
		var dataURL;
		image.onload = function() {
			ctxS.drawImage(image, 0, 0,500,400);
		};
		
		image.src = pictData;
		
		//console.log(image.src);
	}
	
	var putImageToCanvas = function(pict,cnv){

			var canvas = document.getElementById(cnv);
				canvas.width = 500;
				canvas.height = 400;
				canvas.style.width  = '500px';
			var ctx = canvas.getContext("2d");

			img = new Image();
			img.onload = function () {

				canvas.height = canvas.width * (img.height / img.width);
				var oc = document.createElement('canvas'),
				octx = oc.getContext('2d');
				oc.width = img.width * 0.7;
				oc.height = img.height * 0.7;
				
				octx.drawImage(img, 0, 0, oc.width* 0.7, oc.height* 0.7);
				octx.drawImage(oc, 0, 0, oc.width , oc.height );

				ctx.drawImage(oc, 0, 0, oc.width * 0.7, oc.height * 0.7,
				0, 0, canvas.width, canvas.height);
			}
			img.src = pict;
		}
	
    var genSpajGUID = function() {
            function S4() {
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1); 
            }
      return (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();
    }

    var setSpajElement = function(newObj) {
        if(spajElement.length < 1) {
            spajElement.push(newObj)
        }else{
            for (var key in spajElement) {
                if(spajElement[key].pageId == newObj.pageId){
                    spajElement[key].data = newObj.data;
                }
            }
        }
    };

    var getSpajElement = function(pageId){
        if(spajElement.length <1 && pageId !== '') {
            return false;
        }else{
            for (var key in spajElement) {
                if(spajElement[key].pageId == pageId){
                    //spajElement[key].data = newObj.data;
                    return spajElement[key];
                }
            }
        }
    };
    
    var getSpajGUID = function(){
		return storage.getItem('_CURRENT_SPAJ_GUID::');
    }
    
    var setSpajGUID = function(guid){
		this.setUnsavedSpajGuid(guid);
		return storage.setItem("_CURRENT_SPAJ_GUID::",guid);
    }
    
	var addPenerimaManfaat = function(guid,pageId,dataNew){
		var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat');
		if(trydata != null){
			var isold = JSON.parse(trydata);
			var newdata = null;
			
			if(typeof isold == 'object'){
				var tempData = [];
				for ( var index=0; index<isold.length; index++ ) {
					tempData.push(isold[index]);
				}
				tempData.push(dataNew);
				isold = tempData;
			}
			
			storage.setItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat',angular.toJson(isold));
			return true;
		} else {
			
			storage.setItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat',angular.toJson([dataNew]));
			return true;
		}
	}
	
	var removePenerimaManfaat = function(guid,pageId,idxItem){
		if((typeof idxItem == 'boolean') && (idxItem==false)){ //if unspecified index return all
			
			return false;
		} else if( (typeof idxItem == 'string' && (parseInt(idxItem) > -1)) ) {//return only specified idxItem
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat');
			var isold = JSON.parse(trydata);
			
			if(isold.splice(idxItem,1)){
				
				storage.setItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat',angular.toJson(isold));
				
				return true;
			}
			return false;
			
		}
	}	
	
	var updatePenerimaManfaat = function(guid,pageId,idxItem,dataNew){
		if((typeof idxItem == 'boolean') && (idxItem==false)){ //if unspecified index return all
			
			return false;
		} else if( (typeof idxItem == 'string' && (parseInt(idxItem) > -1)) ) {//return only specified idxItem
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat');
			var isold = JSON.parse(trydata);
			
			if(delete isold[idxItem]){
				
				isold[idxItem] = dataNew;
				
				storage.setItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat',angular.toJson(isold));
				
				return true;
			}
			return false;
			
		}
	}
	
	var getPenerimaManfaat = function(guid,pageId,idxItem){

		if((typeof idxItem == 'boolean') && (idxItem==false)){ //if unspecified index return all
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat');
			var isold = JSON.parse(trydata);
			
			return isold;
		} else if( (typeof idxItem == 'string' && (parseInt(idxItem) > -1)) ) {//return only specified idxItem
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::penerima_manfaat');
			var isold = JSON.parse(trydata);
			return isold[idxItem];
		}
	}
	
	
	var getDokumen = function(guid,pageId,idxItem){
		if((typeof idxItem == 'boolean') && (idxItem==false)){ //if unspecified index return all
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj');
			var isold = JSON.parse(trydata);
			
			return isold;
		} else if( (typeof idxItem == 'string' && (parseInt(idxItem) > -1)) ) {//return only specified idxItem
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj');
			var isold = JSON.parse(trydata);
			return isold[idxItem];
		}
	}
	
	var addDokumen = function(guid,pageId,dataNew){
		var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj');
		if(trydata != null){
			var isold = JSON.parse(trydata);
			var newdata = null;
			
			if(typeof isold == 'object'){
				var tempData = [];
				for ( var index=0; index<isold.length; index++ ) {
					tempData.push(isold[index]);
				}
				tempData.push(dataNew);
				isold = tempData;
			}
			
			storage.setItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj',angular.toJson(isold));
			return true;
		} else {
			
			storage.setItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj',angular.toJson([dataNew]));
			return true;
		}
	}
	
	var delDokumen = function(guid,pageId,idxItem){
		if((typeof idxItem == 'boolean') && (idxItem==false)){ //if unspecified index return all
			
			return false;
		} else if( (typeof idxItem == 'string' && (parseInt(idxItem) > -1)) ) {//return only specified idxItem
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj');
			var isold = JSON.parse(trydata);
			
			if(isold.splice(idxItem,1)){
				
				storage.setItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj',angular.toJson(isold));
				
				return true;
			}
			return false;
			
		}
	}
	
	var updateDokumen = function(guid,pageId,idxItem,dataNew){
		if((typeof idxItem == 'boolean') && (idxItem==false)){ 
			
			return false;
		} else if( (typeof idxItem == 'string' && (parseInt(idxItem) > -1)) ) {//return only specified idxItem
			var trydata = storage.getItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj');
			var isold = JSON.parse(trydata);
			
			if(delete isold[idxItem]){
				
				isold[idxItem] = dataNew;
				
				storage.setItem('SPAJ::'+guid+'::'+pageId+'::dokumen_spaj',angular.toJson(isold));
				
				return true;
			}
			return false;
			
		}
	}
	
	var getUnsavedSpajGuid = function(){
		var data = storage.getItem('SPAJ::_STATUS_UNSAVED');
		var ret = null;
		var rets = [];
		try{
			ret = JSON.parse(data);
			
			for (var i = 0; i < ret.length ; i++) {
				
				try{
					var detil = storage.getItem('SPAJ::'+ret[i].spaj_guid+'::aplikasiSPAJOnline.dataTertanggung13');
					dets = JSON.parse(detil);				
					
					//detilproduk = storage.getItem('SPAJ::'+ret[i].spaj_guid+'::aplikasiSPAJOnline.produkDanManfaat12');
					//detproduk = JSON.parse(detilproduk);

						rets.push({
							'spaj_guid':dets.spaj_guid,
							'namaLengkapTertanggung':dets.namaLengkapTertanggung,
							'nomorKTPTertanggung':dets.nomorKTPTertanggung,
							//'produk':(detproduk.jenisAsuransi===null)?'':detproduk.jenisAsuransi,
							//'premi':(detproduk.premi===null)?'':detproduk.premi
						})
				} catch (e){
					//console.log(typeof (detproduk.jenisAsuransi !== null))
					console.log(e);
				}
				

			}
		}catch(e){
			console.log(e);
		}

		return  rets;
	}
	
	var setUnsavedSpajGuid = function(spaj_guid){
		var key = storage.getItem('SPAJ::_STATUS_UNSAVED');
		var dt = JSON.parse(key);
		
		var ret = null;
	
		if(key != null){
			var found = false;
			for (var i = 0; i < dt.length && !found; i++) {
			  if (dt[i].spaj_guid === spaj_guid) {
				found = true;
			  }
			}
		}
		//
		if(!found){
			
			if(spaj_guid != 'new' && dt == null){
				dt = [{'spaj_guid':spaj_guid}];
				storage.setItem('SPAJ::_STATUS_UNSAVED',angular.toJson(dt));
			}else if(spaj_guid != 'new' && dt != null){
				
				dt.push({'spaj_guid':spaj_guid});
				storage.setItem('SPAJ::_STATUS_UNSAVED',angular.toJson(dt));
			}

		}

		return  ret;
	}
	
	var delUnsavedSpajGuid = function(spaj_guid){
		var key = storage.getItem('SPAJ::_STATUS_UNSAVED');
		var dt = null;
		var ds = [];
		try{
			dt = JSON.parse(key);
			if(dt  != null){
				for(i=0;i<dt.length;i++){
					if(dt[i].spaj_guid != spaj_guid){
						ds.push({'spaj_guid':dt[i].spaj_guid});
					}
				}
			}
			
			storage.setItem('SPAJ::_STATUS_UNSAVED',angular.toJson(ds));
			
			//remove all saved item from local storage
			var ls = localStorage;
			
			ps = [];

			for (var keyi in ls) {
				console.log('spaj:'+spaj_guid)
			   console.log(keyi+'||'+keyi.indexOf('SPAJ::'+spaj_guid))
			}
			
		}catch(e){
			console.log(e);
		}
	}
	
    return {
        convertDateFromUnixStamp: convertDateFromUnixStamp,
        alertMessagebuilder: alertMessagebuilder,
        setSpajElement: setSpajElement,
        getSpajElement: getSpajElement,
        genSpajGUID: genSpajGUID,
        getSpajGUID: getSpajGUID,
        setSpajGUID: setSpajGUID,
		addPenerimaManfaat: addPenerimaManfaat,
		removePenerimaManfaat: removePenerimaManfaat,
		getPenerimaManfaat: getPenerimaManfaat,
		updatePenerimaManfaat: updatePenerimaManfaat,
		updateDokumen: updateDokumen,
		getDokumen: getDokumen,
		delDokumen: delDokumen,
		addDokumen: addDokumen,
		delUnsavedSpajGuid: delUnsavedSpajGuid,
		getUnsavedSpajGuid: getUnsavedSpajGuid,
		setUnsavedSpajGuid: setUnsavedSpajGuid,
		takePict: takePictOf,
		putToCanvas: putImageToCanvas,
		putImageTo: putImageDataToCanvas,
		initTtd: init_ttd,
		getImageBase64:getBinImage,
		ioBase64: myBase64,
    }	
}])

.factory('dataFactory', [function(){
	var rangeGajis = [
	        {'id':'0','label':'--Pilih--'},
            {'id':'under10','label':'Kurang dari Rp. 10 juta'},
            {'id':'10sd50','label':'Rp. 10 juta s/d Rp. 50 juta'},
            {'id':'50sd100','label':'Rp. 50 juta s/d Rp. 100 juta '},
            {'id':'othersum','label':'Jumlah lainnya'},
            {'id':'0','label':'Tidak Ada'},
	];

    var hubungankeluargas = [
            {'id':'0','label':'--Pilih--'},
            //{'id':'dirisendiri','label':'Diri Sendiri'},
            //{'id':'suami','label':'Suami'},
            //{'id':'istri','label':'Istri'},
            //{'id':'anak1','label':'Anak Pertama'},
            //{'id':'anak2','label':'Anak Kedua'},
            //{'id':'anak3','label':'Anak Ketiga'},
           // {'id':'anak4','label':'Anak Keempat'},
			{'id':'AT','label':'AYAH TIRI'},
			{'id':'T1','label':'SAUDARA'},
			{'id':'TA','label':'TERTANGGUNG ANAK 1'},
			{'id':'TB','label':'TERTANGGUNG ANAK 2'},
			{'id':'TC','label':'TERTANGGUNG ANAK 3'},
			{'id':'1T','label':'ANAK TIRI'},
			{'id':'2T','label':'ANAK TIRI YG DIBEASISWAKAN'},
			{'id':'I','label':'ISTRI'},
			{'id':'S','label':'SUAMI'},
			{'id':'1','label':'ANAK'},
			{'id':'A','label':'AYAH'},
			{'id':'U','label':'IBU'},
			{'id':'K','label':'KAKEK'},
			{'id':'N','label':'NENEK'},
			{'id':'P','label':'KARYAWAN'},
			{'id':'W','label':'SAUDARA PEREMPUAN'},
			{'id':'L','label':'SAUDARA LAKI-LAKI'},
			{'id':'B','label':'KAKAK KANDUNG'},
			{'id':'C','label':'ADIK KANDUNG'},
			{'id':'X','label':'DUMMY'},
			{'id':'D','label':'ANAK ANGKAT'},
			{'id':'E','label':'ADIK IPAR'},
			{'id':'F','label':'BIBI'},
			{'id':'G','label':'CUCU'},
			{'id':'H','label':'DEBITUR'},
			{'id':'V','label':'KAKAK IPAR'},
			{'id':'J','label':'MERTUA'},
			{'id':'M','label':'MERTUA?'},
			{'id':'Q','label':'ORANG TUA ANGKAT'},
			{'id':'R','label':'PAMAN'},
			{'id':'T','label':'SAUDARA ANGKAT'},
			{'id':'04','label':'DIRI TERTANGGUNG'},
			{'id':'G2','label':'CUCU YANG DIBEASISWAKAN'},
			{'id':'K2','label':'KEPONAKAN YANG DIBEASISWAKAN'},
			{'id':'K1','label':'KEPONAKAN'},
			{'id':'M1','label':'MENANTU'},
			{'id':'T2','label':'SAUDARA YANG DIBEASISWAKAN'},
			{'id':'KS','label':'KAKAK SEPUPU'},
			{'id':'AS','label':'ADIK SEPUPU'},
			{'id':'O2','label':'PEMEGANG POLIS'},
			{'id':'A2','label':'ANAK YG DIBEASISWAKAN'},
			{'id':'PP','label':'PEMILIK PERUSAHAAN'},
			{'id':'PM','label':'PIMPINAN PERUSAHAAN'},
			{'id':'UT','label':'IBU TIRI'},
			{'id':'TI','label':'TERTANGGUNG ISTRI'},
			{'id':'TS','label':'TERTANGGUNG SUAMI'}
        ];

    var tipedokumens = [
		 {'id':'0','label':'--Pilih--'},
		 {'id':'1','label':'Dokumen Kesehatan'},
		 {'id':'2','label':'Dokumen Domisili'},
		 {'id':'3','label':'Dokumen Lainnya'},
		 {'id':'4','label':'Dokumen Foto / Gambar'},
		 {'id':'5','label':'Dokumen Bank'},
    ];
    
    var bayarberikutnyas = [
        {"id":"0","label":"--Pilih--"},
        {"id":"autodebet","label":"Auto Debet"},
        {"id":"host2host","label":"Host to Host"},
        {"id":"virtualaccount","label":"Virtual Account"},
        {"id":"ccdebet","label":"Credit Card"}
    ];  
    
    var jeniasuransis =  [
		{"id":"0","label":"--Pilih--","gruprider":0},
		{
			"id": "AI0",
			"label": "ANUITAS IDEAL",
			"gruprider": "0"
		},
		{
			"id": "AI0B",
			"label": "ANUITAS IDEAL (BUJANG)",
			"gruprider": "0"
		},
		{
			"id": "AKM",
			"label": "ASURANSI JIWA KREDIT",
			"gruprider": "0"
		},
		{
			"id": "ASI",
			"label": "ANUITAS SEJAHTERA IDEAL",
			"gruprider": "0"
		},
		{
			"id": "ASIB",
			"label": "ANUITAS SEJAHTERA IDEAL (BUJANG)",
			"gruprider": "0"
		},
		{
			"id": "ASP", 
			"label": "ANUITAS SEJAHTERA PRIMA",
			"gruprider": "0"
		},
		{
			"id": "ASPB",
			"label": "ANUITAS SEJAHTERA PRIMA (BUJANG)",
			"gruprider": "0"
		},
		{
			"id": "JL3BBB",
			"label": "JS LINK BALANCED FUND",
			"gruprider": "3"
		},
		{
			"id": "JL3BBE",
			"label": "JS LINK EQUITY FUND",
			"gruprider": "3"
		},
		{
			"id": "JL4B",
			"label": "JS PROMAPAN",
			"gruprider": "0"
		},
		{
			"id": "JL4X",
			"label": "JS PROIDAMAN",
			"gruprider": "0"
		},
		{
			"id": "JSAA",
			"label": "JS PLAN ANNUITY ASSURANCE (BACASSURANCE)",
			"gruprider": "0"
		},
		{
			"id": "JSAEP",
			"label": "JS ANUITAS EKSEKUTIF PRIMA",
			"gruprider": "0"
		},
		{
			"id": "JSDG0",
			"label": "JS DWIGUNA",
			"gruprider": "3"
		},
		{
			"id": "JSDM0",
			"label": "JS DWIGUNA MENAIK",
			"gruprider": "3"
		},
		{
			"id": "JSDMPP",
			"label": "JS DANA MULTI PROTEKSI PLUS",
			"gruprider": "5"
		},
		{
			"id": "JSGTP",
			"label": "JS GAJI TERUSAN PLATINUM",
			"gruprider": "6"
		},
		{
			"id": "JSHAA",
			"label": "JS HERITAGE ANNUITY ASSURANCE",
			"gruprider": "0"
		},
		{
			"id": "JSIAA",
			"label": "JS INDEX ANNUITY ASSURANCE (BANCASSURANCE)",
			"gruprider": "0"
		},
		{
			"id": "JSIPA",
			"label": "JS INDEX PLAN ASSURANCE",
			"gruprider": "0"
		},
		{
			"id": "JSPNBTN",
			"label": "JS PRESTASI (BANCASSURANCE)",
			"gruprider": "2"
		},
		{
			"id": "JSPNN",
			"label": "JS PRESTASI",
			"gruprider": "2"
		},
		{
			"id": "JSPNSB",
			"label": "JS PENSIUN NYAMAN SEJAHTERA (BUJANG)",
			"gruprider": "0"
		},
		{
			"id": "JSPNSK",
			"label": "JS PENSIUN NYAMAN SEJAHTERA (KAWIN)",
			"gruprider": "0"
		},
		{
			"id": "JSR1",
			"label": "ASURANSI JS SINERGY PAKET 1",
			"gruprider": "0"
		},
		{
			"id": "JSR2",
			"label": "ASURANSI JS SINERGY PAKET 3",
			"gruprider": "0"
		},
		{
			"id": "JSR3",
			"label": "ASURANSI JS SINERGY PAKET 4",
			"gruprider": "0"
		},
		{
			"id": "JSR4",
			"label": "ASURANSI JS SINERGY PAKET 1",
			"gruprider": "0"
		},
		{
			"id": "JSRIA",
			"label": "JS REPLACEMENT INCOME ASSURANCE (BANCASSURANCE)",
			"gruprider": "0"
		},
		{
			"id": "JSRPAB",
			"label": "JS RETIREMENT PLAN ASSURANCE (BULANAN)",
			"gruprider": "0"
		},
		{
			"id": "JSRPAK",
			"label": "JS RETIREMENT PLAN ASSURANCE (KUARTALAN)",
			"gruprider": "0"
		},
		{
			"id": "JSRPAS",
			"label": "JS RETIREMENT PLAN ASSURANCE (SEMESTERAN)",
			"gruprider": "0"
		},
		{
			"id": "JSRPAT",
			"label": "JS RETIREMENT PLAN ASSURANCE (TAHUNAN)",
			"gruprider": "0"
		},
		{
			"id": "JSRPAX",
			"label": "JS RETIREMENT PLAN ASSURANCE (SEKALIGUS)",
			"gruprider": "0"
		},
		{
			"id": "JSSHTB",
			"label": "JS SIHARTA BULANAN",
			"gruprider": "4"
		},
		{
			"id": "JSSHTBBTN",
			"label": "JS SIHARTA BULANAN (BANCASSURANCE)",
			"gruprider": "4"
		},
		{
			"id": "JSSHTK",
			"label": "JS SIHARTA KUARTALAN",
			"gruprider": "4"
		},
		{
			"id": "JSSHTKBTN",
			"label": "JS SIHARTA KUARTALAN (BANCASSURANCE)",
			"gruprider": "4"
		},
		{
			"id": "JSSHTS",
			"label": "JS SIHARTA SEMESTERAN",
			"gruprider": "4"
		},
		{
			"id": "JSSHTSBTN",
			"label": "JS SIHARTA SEMESTERAN (BANCASSURANCE)",
			"gruprider": "4"
		},
		{
			"id": "JSSHTT",
			"label": "JS SIHARTA TAHUNAN",
			"gruprider": "4"
		},
		{
			"id": "JSSHTTBTN",
			"label": "JS SIHARTA TAHUNAN (BANCASSURANCE)",
			"gruprider": "4"
		},
		{
			"id": "JSSHTX",
			"label": "JS SIHARTA SEKALIGUS",
			"gruprider": "4"
		},
		{
			"id": "JSSHTXBTN",
			"label": "JS SIHARTA SEKALIGUS (BANCASSURANCE)",
			"gruprider": "4"
		},
		{
			"id": "JSSIA",
			"label": "JS SAVING INCOME ASSURANCE (BANCASSURANCE)",
			"gruprider": "0"
		},
		{
			"id": "JSSPD1",
			"label": "JS PLAN DOLLAR",
			"gruprider": "0"
		},
		{
			"id": "JSSPO7A",
			"label": "JS PLAN OPTIMA7",
			"gruprider": "0"
		},
		{
			"id": "JSSPO8",
			"label": "JS PLAN OPTIMA8",
			"gruprider": "0"
		},
		{
			"id": "P30N",
			"label": "TRI PRALAYA",
			"gruprider": "3"
		},
		{
			"id": "PAA",
			"label": "PERSONAL ACCIDENT PLAN A",
			"gruprider": "0"
		},
		{
			"id": "PAB",
			"label": "PERSONAL ACCIDENT PLAN B",
			"gruprider": "0"
		},
		{
			"id": "SC5N",
			"label": "BEASISWA CATUR KARSA 5 TAHUN",
			"gruprider": "3"
		}
	];
	 
	var pctUnitlinkGuardians = [
		{"id":"0","label":"--Pilih--"},
		{"id":"JL4XGIH1","label":"JS UL Guardian 85 - 1 thn"},
		{"id":"JL4XGIH2","label":"JS UL Guardian 85 - 2 thn"},
		{"id":"JL4XGIH3","label":"JS UL Guardian 85 - 3 thn"},
		{"id":"JL4XGIH4","label":"JS UL Guardian 85 - 4 thn"},
		{"id":"JL4XGIH5","label":"JS UL Guardian 85 - 5 thn"},
		{"id":"JL4XGIG1","label":"JS UL Guardian 75 - 1 thn"},
		{"id":"JL4XGIG2","label":"JS UL Guardian 75 - 2 thn"},
		{"id":"JL4XGIG3","label":"JS UL Guardian 75 - 3 thn"},
		{"id":"JL4XGIG4","label":"JS UL Guardian 75 - 4 thn"},
		{"id":"JL4XGIG5","label":"JS UL Guardian 75 - 5 thn"}
	];
    
	
	var jenisJsProteksiKeluargas = [
			{"id":"0","label":"--Pilih--"},
			{"id":"K0","label":"K0 - Suami dan Istri"},
			{"id":"K1","label":"K1 - Suami, Istri dan 1 Anak"},
			{"id":"K2","label":"K2 - Suami, Istri dan 2 Anak"},
			{"id":"K3","label":"K3 - Suami, Istri dan 3 Anak"},
			{"id":"B0","label":"B0 - Bujang"},
			{"id":"B1","label":"B1 - Janda/duda dan 1 Anak"},
			{"id":"B2","label":"B2 - Janda/duda dan 2 Anak"},
			{"id":"B3","label":"B3 - Janda/duda dan 3 Anak"}
		];
	
    var carabayars = [
        {"id":"0","label":"--Pilih--"},
        {"id":"sekaligus","label":"Sekaligus"},
        {"id":"bulanan","label":"Bulanan"},
        {"id":"semesteran","label":"Semesteran"},
        {"id":"triwulan","label":"Triwulanan"},
        {"id":"kwartal","label":"Kwartal"},
        {"id":"tahunan","label":"Tahunan"},
    ];  
    
    var jenisperusahaans =  [
            {"id":"0","label":"--Pilih--"},
            {"id":"swasta","label":"Swasta"},
            {"id":"bumnd","label":"BUMN/BUMD"},
            {"id":"pns","label":"PNS"},
            {"id":"tni","label":"TNI"},
            {"id":"polri","label":"POLRI"},
            {"id":"instansipemerintah","label":"Inst. Pemerintah"},
            {"id":"lainnya","label":"Lainnya"}
        ];
    
    var kelaspekerjaans =  [
            {"id":"0","label":"--Pilih--"},
            {"id":"kelas1","label":"Kelas I"},
            {"id":"kelas2","label":"Kelas II"},
            {"id":"kelas3","label":"Kelas III"},
            {"id":"kelas4","label":"Kelas IV"}
        ];
    
    var pangkats = [
            {"id":"0","label":"--Pilih--"},
            {"id":"staff","label":"Staff/Administrasi"},
            {"id":"supervisor","label":"Supervisor"},
            {"id":"manajer","label":"Manajer"},
            {"id":"kepalaseksi","label":"Kepala Seksi"},
            {"id":"kepalabagian","label":"Kepala Bagian"},
            {"id":"kepaladivisi","label":"Kepala Divisi"},
            {"id":"kepaladepartemen","label":"Kepala Departemen"},
            {"id":"pimpinan","label":"Pimpinan"},
            {"id":"lainnya","label":"Lainnya"},
        ];
    
	
	
    var pekerjaans = [
			{"id":"","label":"--Pilih--"},
			{"id":"ACA","label":"PENGACARA",'kelas':'I'},
			{"id":"AGN","label":"AGEN",'kelas':'II'},
			{"id":"AKT","label":"AKTUARIS",'kelas':'I'},
			{"id":"ANA","label":"ANALIS/APOTEKER",'kelas':'I'},
			{"id":"ARS","label":"ARSITEK",'kelas':'I'},
			{"id":"ART","label":"ARTIS",'kelas':'II'},
			{"id":"BNK","label":"BANKIR",'kelas':'I'},
			{"id":"BPT","label":"BUPATI",'kelas':'I'},
			{"id":"BRH","label":"BURUH",'kelas':'III'},
			{"id":"BRW","label":"BIARAWAN / BIARAWATI",'kelas':'I'},
			{"id":"DOK","label":"DOKTER UMUM",'kelas':'I'},
			{"id":"DPR","label":"ANGGOTA DPR / DPRD",'kelas':'I'},
			{"id":"DRH","label":"DOKTER HEWAN",'kelas':'I'},
			{"id":"DSN","label":"DOSEN",'kelas':'I'},
			{"id":"GBR","label":"GUBERNUR",'kelas':'I'},
			{"id":"GRU","label":"GURU",'kelas':'I'},
			{"id":"IBR","label":"Ibu Rumah Tangga",'kelas':'I'},
			{"id":"IKA","label":"AHLI KIMIA",'kelas':'III'},
			{"id":"IRT","label":"IBU RUMAH TANGGA",'kelas':'I'},
			{"id":"KES","label":"Kesehatan",'kelas':'II'},
			{"id":"LKE","label":"Lembaga Keuangan",'kelas':'I'},
			{"id":"LNK","label":"Lembaga Non Keuangan / Pabrikasi",'kelas':'II'},
			{"id":"LSM","label":"Yayasan/LSM",'kelas':'I'},
			{"id":"MED","label":"PARAMEDIS",'kelas':'II'},
			{"id":"MHS","label":"MAHASISWA",'kelas':'I'},
			{"id":"NLY","label":"NELAYAN",'kelas':'I'},
			{"id":"NOT","label":"NOTARIS",'kelas':'I'},
			{"id":"PBD","label":"PEGAWAI BUMD",'kelas':'I'},
			{"id":"PBU","label":"PEGAWAI BUMN",'kelas':'I'},
			{"id":"PDG","label":"PEDAGANG",'kelas':'II'},
			{"id":"PEN","label":"PENSIUNAN",'kelas':'I'},
			{"id":"PFM","label":"SUTRADARA",'kelas':'II'},
			{"id":"PGH","label":"PENGUSAHA",'kelas':'I'},
			{"id":"PLJ","label":"PELAJAR",'kelas':'I'},
			{"id":"PMA","label":"Pelajar/Mahasiswa",'kelas':'I'},
			{"id":"PNB","label":"PENERBANG",'kelas':'III'},
			{"id":"PND","label":"PENDETA",'kelas':'I'},
			{"id":"PNG","label":"PENAGIH",'kelas':'II'},
			{"id":"PNN","label":"Pensiunan",'kelas':'I'},
			{"id":"PNS","label":"PEGAWAI NEGERI SIPIL",'kelas':'I'},
			{"id":"PPM","label":"Pejabat Pemerintah & MPR/DPR/DPRD",'kelas':'I'},
			{"id":"PPP","label":"Pengurus Parpol",'kelas':'I'},
			{"id":"PRA","label":"PRAMUGARI",'kelas':'III'},
			{"id":"PRG","label":"KOMPUTER PROGRAMMER",'kelas':'I'},
			{"id":"PRM","label":"PEGAWAI SWASTA ASING",'kelas':'I'},
			{"id":"PRO","label":"Profesional",'kelas':'I'},
			{"id":"PSN","label":"PEGAWAI SWASTA NASIONAL",'kelas':'I'},
			{"id":"SAN","label":"KOMPUTER SISTEM ANALIS",'kelas':'I'},
			{"id":"SAT","label":"SATPAM",'kelas':'IV'},
			{"id":"SPL","label":"DOKTER SPESIALIS",'kelas':'I'},
			{"id":"SPR","label":"SOPIR",'kelas':'II'},
			{"id":"SWA","label":"Swasta",'kelas':'I'},
			{"id":"TAN","label":"PETANI",'kelas':'II'},
			{"id":"TAU","label":"TEKNISI AUTOMOTIF",'kelas':'II'},
			{"id":"TKE","label":"TEKNISI ELEKTRONIK",'kelas':'II'},
			{"id":"TNI","label":"TNI / POLRI",'kelas':'IV'},
			{"id":"TPT","label":"TEKNISI PESAWAT TERBANG",'kelas':'II'},
			{"id":"ULM","label":"ULAMA",'kelas':'I'},
			{"id":"WBP","label":"WAKIL BUPATI",'kelas':'I'},
			{"id":"WIR","label":"WIRASWASTA",'kelas':'I'},
			
            {"id":"otherpekerjaan","label":"Lainnya",'kelas':'-'}
        ];  
    
var statusnikahs = [
        {"id":"","label":"--Pilih--"},
        {"id":"L","label":"Lajang"},
        {"id":"K","label":"Menikah"},
        {"id":"J","label":"Janda"},
        {"id":"D","label":"Duda"},
		{"id":"B","label":"Menikah 1 Anak"},
		{"id":"C","label":"Menikah 2 Anak"},
		{"id":"E","label":"Menikah 3 Anak"},
		{"id":"F","label":"Menikah 4 Anak"},
		{"id":"G","label":"Menikah 5 Anak"},
		{"id":"I","label":"Lajang 1 Anak"},
		{"id":"M","label":"Lajang 2 Anak"},
		{"id":"N","label":"Lajang 3 Anak"},
		{"id":"O","label":"Lajang 4 Anak"},
		{"id":"P","label":"Lajang 5 Anak"}
]; 
    
    var pendidikans = [
            {"id":"0","label":"--Pilih--"},
            {"id":"SD","label":"SD"},
            {"id":"SMP","label":"SMP"},
            {"id":"SMA","label":"SMA / Sederajat"},
            {"id":"D1","label":"D1/D3"},
            {"id":"S1","label":"S1"},
            {"id":"S2","label":"S2"},
            {"id":"S3","label":"S3"}
        ];
    
    var statustinggals = [
            {"label":"--Pilih--",'id':'0'},
            {"label":"Milik Sendiri",'id':'1'},
            {"label":"Sewa",'id':'2'}
        ];
    
    var provinsis = [
			{"label":"--Pilih--","id":"0"},
			{"label":"Aceh","id":"1921"},
			{"label":"Bali","id":"1901"},
			{"label":"Banten","id":"1903"},
			{"label":"Bengkulu","id":"1904"},
			{"label":"Gorontalo","id":"1907"},
			{"label":"Jakarta","id":"1906"},
			{"label":"Jambi","id":"1909"},
			{"label":"Jawa Barat","id":"1910"},
			{"label":"Jawa Tengah","id":"1911"},
			{"label":"Jawa Timur","id":"1912"},
			{"label":"Kalimantan Barat","id":"1913"},
			{"label":"Kalimantan Selatan","id":"1914"},
			{"label":"Kalimantan Tengah","id":"1915"},
			{"label":"Kalimantan Timur","id":"1916"},
			{"label":"Kalimantan Utara","id":"1921"},
			{"label":"Kepulauan Bangka Belitung","id":"1902"},
			{"label":"Kepulauan Riau","id":"1917"},
			{"label":"Lampung","id":"1918"},
			{"label":"Maluku","id":"1919"},
			{"label":"Maluku Utara","id":"1920"},
			{"label":"Nusa Tenggara Barat","id":"1922"},
			{"label":"Nusa Tenggara Timur","id":"1923"},
			{"label":"Papua","id":"1924"},
			{"label":"Papua Barat","id":"1908"},
			{"label":"Riau","id":"1925"},
			{"label":"Sulawesi Barat","id":"1926"},
			{"label":"Sulawesi Selatan","id":"1927"},
			{"label":"Sulawesi Tengah","id":"1928"},
			{"label":"Sulawesi Tenggara","id":"1929"},
			{"label":"Sulawesi Utara","id":"1930"},
			{"label":"Sumatera Barat","id":"1932"},
			{"label":"Sumatera Selatan","id":"1933"},
			{"label":"Sumatera Utara","id":"1931"},
			{"label":"Daerah Istimewa Yogyakarta","id":"1905"}
		];
			
    var agamas = [
            {'id':'0','label':'--Pilih--'},
            {'id':'1','label':'Islam'},
            {'id':'3','label':'Kristen Katholik'},
            {'id':'2','label':'Kristen Protestan'},
            {'id':'4','label':'Hindu'},
            {'id':'5','label':'Budha'},
            {'id':'6','label':'Konghutju'},
            {'id':'7','label':'Aliran Kepercayaan'}
        ];
    
    var genders = [
        {'id':'0','label':'--Pilih--'},
        {'id':'L','idsent':'L','label':'Laki-laki'},
        {'id':'P','idsent':'P','label':'Perempuan'}
    ];
	
	var hobbys = [
        {"id":"","label":"--Pilih--"},
        {"id":"ABS","label":"ANGAKATAN BERSENJATA"},
        {"id":"AKR","label":"AKROBAT"},
        {"id":"ARJ","label":"ARUNG JERAM"},
        {"id":"AUT","label":"AUTOMOTIF"},
        {"id":"BAD","label":"BADMINTON"},
        {"id":"BAS","label":"BASKET"},
        {"id":"BED","label":"BELA DIRI"},
        {"id":"BER","label":"BERENANG"},
        {"id":"BLY","label":"BERLAYAR"},
        {"id":"BMB","label":"BALAP MOBIL"},
        {"id":"BMO","label":"BALAP MOTOR"},
        {"id":"BSE","label":"BALAP SEPEDA"},
        {"id":"CAP","label":"CAVING DAN POTHOLING"},
        {"id":"CLI","label":"MENDAKI/ROCK CLIMBING"},
        {"id":"GAN","label":"GANTOLE"},
        {"id":"GOL","label":"GOLF"},
        {"id":"HOC","label":"HOCKEY"},
        {"id":"JLN","label":"JALAN-JALAN"},
        {"id":"KEL","label":"KELAUTAN"},
        {"id":"KOL","label":"KOLEKSI"},
        {"id":"KSL","label":"KESENIAN LAINNYA"},
        {"id":"LAI","label":"LAIN-LAIN"},
        {"id":"LUK","label":"LUKIS/GAMBAR"},
        {"id":"MAR","label":"MARATON"},
        {"id":"MBC","label":"MEMBACA"},
        {"id":"MCR","label":"MICROLIGHTING"},
        {"id":"MEN","label":"MENARI"},
        {"id":"MGB","label":"MINYAK GAS DAN BUMI"},
        {"id":"NLY","label":"NELAYAN"},
        {"id":"NYA","label":"MENYANYI"},
        {"id":"NYL","label":"MENYELAM"},
        {"id":"OLP","label":"OLAH RAGA PETUALANGAN"},
        {"id":"ORA","label":"OLAHRAGA AIR"},
        {"id":"PAY","label":"TERJUN PAYUNG"},
        {"id":"PIK","label":"PIKNIK"},
        {"id":"PJT","label":"PANJAT TEBING"},
        {"id":"PNB","label":"PENERBANGAN"},
        {"id":"PRL","label":"PARALAYANG"},
        {"id":"PSI","label":"PENCAK SILAT"},
        {"id":"PTB","label":"PERTAMBANGAN"},
        {"id":"SEL","label":"SELANCAR"},
        {"id":"SEP","label":"SEPAK BOLA"},
        {"id":"SKI","label":"SKI AIR"},
        {"id":"TEN","label":"TENIS"},
        {"id":"TER","label":"TERJUN AIR"},
        {"id":"TIN","label":"TINJU"},
        {"id":"VOL","label":"VOLLY"},
        {"id":"otherhobby","label":"LAINNYA"}
	];
	
	var getPctUnitlinkGuardians = function (){
		return pctUnitlinkGuardians;
	}	
	
	var getJenisJsProteksiKeluargas = function (){
		return jenisJsProteksiKeluargas;
	}	
	
	var getHobbys = function (){
		return hobbys;
	}
	
	var getRangeGajis = function (){
		return rangeGajis;
	}
    
    var getHubunganKeluargas = function(){
        return hubungankeluargas;
    }
    
    var getTipeDokumens = function(){
        return tipedokumens;
    };
    
    var getBayarBerikutnyas = function(){
        return bayarberikutnyas;
    };
    
    var getJenisAsuransis = function(){
        return jeniasuransis;
    };
    
    var getCaraBayars = function(){
        return carabayars;
    };
    
    var getJenisPerusahaans = function(){
        return jenisperusahaans;
    };
    var getKelasPekerjaans = function(){
        return kelaspekerjaans;
    };
    
    var getPekerjaans = function(){
        return pekerjaans;
    };
    
    var getPangkats = function(){
        return pangkats;
    };
    
    var getStatusNikahs = function(){
        return statusnikahs;
    };
    var getPendidikans = function(){
        return pendidikans;
    };
    var getStatusTempatTinggals = function(){
        return statustinggals;
    };
    
    var getPovinsis = function(){
        return provinsis;
    };

    var getGenders = function(){
        return genders;
    };

    var addProduct = function(newObj) {
      productList.push(newObj);
    };

    var getProducts = function(){
      return productList;
    };
    var getAgamas = function(){
      return agamas;
    };
    
    var getSpajGUID = function(){
        return getSpajGUID();
    };

    return {
        addProduct: addProduct,
        getHobbys: getHobbys,
        getProducts: getProducts,
        getGenders: getGenders,
        getAgamas: getAgamas,
        getProvinsis: getPovinsis,
        getStatusTempatTinggals: getStatusTempatTinggals,
        getPendidikans: getPendidikans,
        getStatusNikahs: getStatusNikahs,
        getPekerjaans: getPekerjaans,
        getPangkats: getPangkats,
        getKelasPekerjaans: getKelasPekerjaans,
        getJenisPerusahaans: getJenisPerusahaans,
        getCaraBayars: getCaraBayars,
        getJenisAsuransis: getJenisAsuransis,
        getBayarBerikutnyas: getBayarBerikutnyas,
        getTipeDokumens: getTipeDokumens,
        getHubunganKeluargas: getHubunganKeluargas,
        getRangeGajis: getRangeGajis,
        getJenisJsProteksiKeluargas: getJenisJsProteksiKeluargas,
		getPctUnitlinkGuardians:getPctUnitlinkGuardians
    };
}])

.service('BlankService', [function(){

}]);
