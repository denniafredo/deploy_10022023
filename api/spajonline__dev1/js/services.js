angular.module('app.services', []).factory('simpleFormValidatorByType', [
	function () {
		var strTest = '';
		var status = false;
		var tryRegex = function (typeToTry, data, regexString) {
			if (typeToTry == (typeof data)) {
				if (!((typeof data == 'string') && data.match('$/^[a-z\d\-_\s]+$/i'))) {}
				return true;
			} else {
				return 'Type mismatch! ' + typeof data;
			}
		}
		return {
			tryRegex: tryRegex
		}
	}
]).factory("$store", function ($parse) {
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
		parseValue: function (res) {
			var val;
			try {
				val = JSON.parse(res);
				if (typeof val == 'undefined') {
					val = res;
				}
				if (val == 'true') {
					val = true;
				}
				if (val == 'false') {
					val = false;
				}
				if (parseFloat(val) == val && !angular.isObject(val)) {
					val = parseFloat(val);
				}
			} catch (e) {
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
		set: function (key, value) {
			if (!supported) {
				try {
					$.cookie(key, value);
					return value;
				} catch (e) {
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
		get: function (key) {
			if (!supported) {
				try {
					return privateMethods.parseValue($.cookie(key));
				} catch (e) {
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
		remove: function (key) {
			if (!supported) {
				try {
					$.cookie(key, null);
					return true;
				} catch (e) {
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
}).factory('syncService', [

	function ($interval) {
		'use strict';
		var service = {
			clock: addClock,
			cancelClock: removeClock
		};
		var clockElts = [];
		var clockTimer = null;
		var cpt = 0;

		function addClock(fn) {
			var elt = {
				id: cpt++,
				fn: fn
			};
			clockElts.push(elt);
			if (clockElts.length === 1) {
				startClock();
			}
			return elt.id;
		}

		function removeClock(id) {
			for (var i in clockElts) {
				if (clockElts[i].id === id) {
					clockElts.splice(i, 1);
				}
			}
			if (clockElts.length === 0) {
				stopClock();
			}
		}

		function startClock() {
			if (clockTimer === null) {
				clockTimer = $interval(function () {
					for (var i in clockElts) {
						clockElts[i].fn();
					}
				}, 1000);
			}
		}

		function stopClock() {
			if (clockTimer !== null) {
				$interval.cancel(clockTimer);
				clockTimer = null;
			}
		}
		return service;
	}
]).factory('spajProvider', [
	function () {
		var spajElement = [];
		var spajGUID = 'null';
		var storage = (typeof window.localStorage === 'undefined') ? undefined : window.localStorage,
			supported = !(typeof storage == 'undefined' || typeof window.JSON == 'undefined');
		var baseIcon = "data:image/png;base64,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";

		function convertDateFromUnixStamp(unixts) {
			var a = new Date(unixts * 1000);
			var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			var year = a.getFullYear();
			var month = months[a.getMonth()];
			var date = a.getDate();
			var hour = a.getHours();
			var min = a.getMinutes();
			var sec = a.getSeconds();
			var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec;
			return time;
		}

		function alertMessagebuilder(msg) {
			out = '';
			if (msg && (msg.length > 0)) {
				out = '<div style="align:left;color:maroon;"><ul >';
				for (i = 0; i < msg.length; i++) {
					out += '<li>' + msg[i].message + '</li>';;
				}
				out += '</ul></div>'
			} else {
				return false;
			}
			return out;
		}

		function touchstartListener(e) {
			e.preventDefault();
			e.stopPropagation();
			cx = e.changedTouches[0].pageX - canvasOffsetX;
			cy = e.changedTouches[0].pageY - canvasOffsetY;
			paint = true;
			addClick(cx, cy);
			redraw();
		}

		function touchmoveListener(e) {
			e.preventDefault();
			e.stopPropagation();
			cx = e.changedTouches[0].pageX - canvasOffsetX;
			cy = e.changedTouches[0].pageY - canvasOffsetY;
			if (paint) {
				addClick(cx, cy, true);
				redraw();
			}
		}

		function touchendListener(e) {
			e.preventDefault();
			e.stopPropagation();
			clickX = [];
			clickY = [];
			clickDrag = [];
			paint = false;
		}
		var init_ttd = function (canvasId) {
			var myCanvas = canvasId;
			myCanvas.width = 600;
			myCanvas.height = 600;
			myCanvas.style.width = '300px';
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
		var takePictOf = function (inputElement, canvasId) {
			if (inputElement.files && inputElement.files[0]) {
				mimeImgUpload = inputElement.files[0].type;
				var reader = new FileReader();
				var blob = null;
				reader.onload = function (e) {
					putImageToCanvas(e.target.result, canvasId);
					blob += e.target.result;
				}
				reader.readAsDataURL(inputElement.files[0]);
			}
		}
		var getBinImage = function (canvasId, cnvType) {
			var canvas = document.getElementById(canvasId);
			var dataUrl = null;
			if (cnvType != '' && cnvType == 'jpg') {
				cnvType = "image/jpeg";
			} else if (cnvType == 'jpg') {
				cnvType = 'image/png';
			}
			dataUrl = canvas.toDataURL(cnvType, 0.6);
			//console.log(myBase64.encode(myBase64.encode(dataUrl)));
			return myBase64.encode(myBase64.encode(dataUrl));
		}
		var myBase64 = {
			encode: function (str) {
				try {
					str = btoa(str);
				} catch (e) {
					str = btoa(baseIcon);
				}
				return str;
			},
			decode: function (str) {
				try {
					str = atob(str);
				} catch (e) {
					str = atob(baseIcon);
				}
				return str;
			}
		}
		var putImageDataToCanvas = function (canvasId, pictData) {
			var meCanvas = document.getElementById(canvasId);
			meCanvas.width = 500;
			meCanvas.height = 400;
			var ctxS = meCanvas.getContext("2d");
			var image = new Image();
			image.crossOrigin = 'Anonymous';
			var dataURL;
			image.onload = function () {
				ctxS.drawImage(image, 0, 0, 500, 400);
			};
			image.src = pictData;
			//console.log(image.src);
		}
		var putImageToCanvas = function (pict, cnv) {
			var canvas = document.getElementById(cnv);
			canvas.width = 500;
			canvas.height = 400;
			canvas.style.width = '500px';
			var ctx = canvas.getContext("2d");
			img = new Image();
			img.onload = function () {
				canvas.height = canvas.width * (img.height / img.width);
				var oc = document.createElement('canvas'),
					octx = oc.getContext('2d');
				oc.width = img.width * 0.7;
				oc.height = img.height * 0.7;
				octx.drawImage(img, 0, 0, oc.width * 0.7, oc.height * 0.7);
				octx.drawImage(oc, 0, 0, oc.width, oc.height);
				ctx.drawImage(oc, 0, 0, oc.width * 0.7, oc.height * 0.7, 0, 0, canvas.width, canvas.height);
				//fill image timestamp
				ctx.font = "15pt Calibri";
				tsImage = convertDateFromUnixStamp(Math.round(+new Date() / 1000));
				ctx.strokeStyle = 'black';
				ctx.fillStyle = "#fafa00";
				ctx.lineWidth = 2;
				ctx.strokeText(tsImage, canvas.width - 200, canvas.height - 25);
				ctx.fillText(tsImage, canvas.width - 200, canvas.height - 25);
			}
			img.src = pict;
		}
		var genSpajGUID = function () {
			function S4() {
				return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
			}
			return (S4() + S4() + "-" + S4() + "-4" + S4().substr(0, 3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();
		}
		var setSpajElement = function (newObj) {
			if (spajElement.length < 1) {
				spajElement.push(newObj)
			} else {
				for (var key in spajElement) {
					if (spajElement[key].pageId == newObj.pageId) {
						spajElement[key].data = newObj.data;
					}
				}
			}
		};
		var getSpajElement = function (pageId) {
			if (spajElement.length < 1 && pageId !== '') {
				return false;
			} else {
				for (var key in spajElement) {
					if (spajElement[key].pageId == pageId) {
						//spajElement[key].data = newObj.data;
						return spajElement[key];
					}
				}
			}
		};
		var getSpajGUID = function () {
			return storage.getItem('_CURRENT_SPAJ_GUID::');
		}
		var setSpajGUID = function (guid) {
			this.setUnsavedSpajGuid(guid);
			return storage.setItem("_CURRENT_SPAJ_GUID::", guid);
		}
		var getBuildId = function () {
			return storage.getItem('_CURRENT_SPAJ_BUILD::');
		}
		var setBuildId = function (guid) {
			this.setUnsavedSpajGuid(guid);
			return storage.setItem("_CURRENT_SPAJ_BUILD::", guid);
		}
		var addPenerimaManfaat = function (guid, pageId, dataNew) {
			var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat');
			if (trydata != null) {
				var isold = JSON.parse(trydata);
				var newdata = null;
				if (typeof isold == 'object') {
					var tempData = [];
					for (var index = 0; index < isold.length; index++) {
						tempData.push(isold[index]);
					}
					tempData.push(dataNew);
					isold = tempData;
				}
				storage.setItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat', angular.toJson(isold));
				return true;
			} else {
				storage.setItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat', angular.toJson([dataNew]));
				return true;
			}
		}
		var removePenerimaManfaat = function (guid, pageId, idxItem) {
			if ((typeof idxItem == 'boolean') && (idxItem == false)) { //if unspecified index return all
				return false;
			} else if ((typeof idxItem == 'string' && (parseInt(idxItem) > -1))) { //return only specified idxItem
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat');
				var isold = JSON.parse(trydata);
				if (isold.splice(idxItem, 1)) {
					storage.setItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat', angular.toJson(isold));
					return true;
				}
				return false;
			}
		}
		var updatePenerimaManfaat = function (guid, pageId, idxItem, dataNew) {
			if ((typeof idxItem == 'boolean') && (idxItem == false)) { //if unspecified index return all
				return false;
			} else if ((typeof idxItem == 'string' && (parseInt(idxItem) > -1))) { //return only specified idxItem
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat');
				var isold = JSON.parse(trydata);
				if (delete isold[idxItem]) {
					isold[idxItem] = dataNew;
					storage.setItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat', angular.toJson(isold));
					return true;
				}
				return false;
			}
		}
		var getPenerimaManfaat = function (guid, pageId, idxItem) {
			if ((typeof idxItem == 'boolean') && (idxItem == false)) { //if unspecified index return all
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat');
				var isold = JSON.parse(trydata);
				return isold;
			} else if ((typeof idxItem == 'string' && (parseInt(idxItem) > -1))) { //return only specified idxItem
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::penerima_manfaat');
				var isold = JSON.parse(trydata);
				return isold[idxItem];
			}
		}
		var getDokumen = function (guid, pageId, idxItem) {
			if ((typeof idxItem == 'boolean') && (idxItem == false)) { //if unspecified index return all
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj');
				var isold = JSON.parse(trydata);
				return isold;
			} else if ((typeof idxItem == 'string' && (parseInt(idxItem) > -1))) { //return only specified idxItem
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj');
				var isold = JSON.parse(trydata);
				return isold[idxItem];
			}
		}
		var addDokumen = function (guid, pageId, dataNew) {
			var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj');
			if (trydata != null) {
				var isold = JSON.parse(trydata);
				var newdata = null;
				if (typeof isold == 'object') {
					var tempData = [];
					for (var index = 0; index < isold.length; index++) {
						tempData.push(isold[index]);
					}
					tempData.push(dataNew);
					isold = tempData;
				}
				storage.setItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj', angular.toJson(isold));
				return true;
			} else {
				storage.setItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj', angular.toJson([dataNew]));
				return true;
			}
		}
		var delDokumen = function (guid, pageId, idxItem) {
			if ((typeof idxItem == 'boolean') && (idxItem == false)) { //if unspecified index return all
				return false;
			} else if ((typeof idxItem == 'string' && (parseInt(idxItem) > -1))) { //return only specified idxItem
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj');
				var isold = JSON.parse(trydata);
				if (isold.splice(idxItem, 1)) {
					storage.setItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj', angular.toJson(isold));
					return true;
				}
				return false;
			}
		}
		var updateDokumen = function (guid, pageId, idxItem, dataNew) {
			if ((typeof idxItem == 'boolean') && (idxItem == false)) {
				return false;
			} else if ((typeof idxItem == 'string' && (parseInt(idxItem) > -1))) { //return only specified idxItem
				var trydata = storage.getItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj');
				var isold = JSON.parse(trydata);
				if (delete isold[idxItem]) {
					isold[idxItem] = dataNew;
					storage.setItem('SPAJ::' + guid + '::' + pageId + '::dokumen_spaj', angular.toJson(isold));
					return true;
				}
				return false;
			}
		}
		var getUnsavedSpajGuid = function () {
			var data = storage.getItem('SPAJ::_STATUS_UNSAVED');
			var ret = null;
			var rets = [];
			try {
				ret = JSON.parse(data);
				for (var i = 0; i < ret.length; i++) {
					try {
						var detil = storage.getItem('SPAJ::' + ret[i].spaj_guid + '::aplikasiSPAJOnline.dataTertanggung13');
						dets = JSON.parse(detil);
						//console.log(dets);
						//detilproduk = storage.getItem('SPAJ::'+ret[i].spaj_guid+'::aplikasiSPAJOnline.produkDanManfaat12');
						//detproduk = JSON.parse(detilproduk);
						if(dets.idagen == getQueryParam('idagen')){
							rets.push({
								'spaj_guid': dets.spaj_guid,
								'namaLengkapTertanggung': dets.namaLengkapTertanggung,
								'nomorKTPTertanggung': dets.nomorKTPTertanggung,
								'build_id': dets.build_id,
								'controller_pdf': 'jspromapannew',
							});
						}
					} catch (e) {
					//	console.log(e);
					}
				}
			} catch (e) {
				//console.log(e);
			}
			return rets;
		}
		var setUnsavedSpajGuid = function (spaj_guid) {
			var key = storage.getItem('SPAJ::_STATUS_UNSAVED');
			var dt = JSON.parse(key);
			var ret = null;
			if (key != null) {
				var found = false;
				for (var i = 0; i < dt.length && !found; i++) {
					if (dt[i].spaj_guid === spaj_guid) {
						found = true;
					}
				}
			}
			//
			if (!found) {
				if (spaj_guid != 'new' && dt == null) {
					dt = [{
						'spaj_guid': spaj_guid
					}];
					storage.setItem('SPAJ::_STATUS_UNSAVED', angular.toJson(dt));
				} else if (spaj_guid != 'new' && dt != null) {
					dt.push({
						'spaj_guid': spaj_guid
					});
					storage.setItem('SPAJ::_STATUS_UNSAVED', angular.toJson(dt));
				}
			}
			return ret;
		}
		var delUnsavedSpajGuid = function (spaj_guid) {
			var key = storage.getItem('SPAJ::_STATUS_UNSAVED');
			var dt = null;
			var ds = [];
			try {
				dt = JSON.parse(key);
				if (dt != null) {
					for (i = 0; i < dt.length; i++) {
						if (dt[i].spaj_guid != spaj_guid) {
							ds.push({
								'spaj_guid': dt[i].spaj_guid
							});
						}
					}
				}
				storage.setItem('SPAJ::_STATUS_UNSAVED', angular.toJson(ds));
				//remove all saved item from local storage
				var ls = localStorage;
				ps = [];
				for (var keyi in ls) {
					console.log('spaj:' + spaj_guid)
					console.log(keyi + '||' + keyi.indexOf('SPAJ::' + spaj_guid))
				}
			} catch (e) {
				console.log(e);
			}
		}
		
		var setProspekListData = function (idagen,prospekData) {
			return storage.setItem("_PROSPEKDATA_LOCAL::"+idagen+"", angular.toJson(prospekData));
		}
		var getProspekListData = function (idagen) {
			var dt =storage.getItem('_PROSPEKDATA_LOCAL::'+idagen+"");
			return JSON.parse(dt);
		}
		
		var setProspekData = function (prospekData) {
			return storage.setItem("_SELECTED_PROSPEKDATA::", prospekData);
		}
		var getProspekData = function () {
			return storage.getItem('_SELECTED_PROSPEKDATA::');
		}		
		var isInternetAvailable = function () {
			return storage.getItem('_HAS_INTERNET::');
		}		
		var setInternetAvailability = function (status) {
			return storage.setItem('_HAS_INTERNET::',status);
		}
		
		var tabDisable = function(tabName){
				element = document.getElementById(tabName);
			    element.className = element
					.className
					.split(' ')
					.filter(function (name) { return name !== 'disabledTab'; })
					.concat('disabledTab')
					.join(' ');
					console.log(element.className)
		}
		var tabEnable = function(tabName){
				element = document.getElementById(tabName);
				element.className = element
					.className
					.split(' ')
					.filter(function (name) { return name !== 'disabledTab'; })
					.join(' ');
					console.log(element.className)
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
			getImageBase64: getBinImage,
			ioBase64: myBase64,
			getBuildId: getBuildId,
			setBuildId: setBuildId,
			getProspekData: getProspekData,
			setProspekData: setProspekData,
			setProspekListData: setProspekListData,
			getProspekListData: getProspekListData,
			setInternetAvailability: setInternetAvailability,
			isInternetAvailable: isInternetAvailable,
			tabEnable:tabEnable,
			tabDisable:tabDisable,
		}
	}
]).factory('dataFactory', [
	function () {
		var jenisFunds = [{
			'id': '0',
			'label': '--Pilih--'
		}, {
			'id': '1',
			'label': 'JS LINK PASAR UANG'
		}, {
			'id': '2',
			'label': 'JS LINK PENDAPATAN TETAP'
		}, {
			'id': '3',
			'label': 'JS LINK BERIMBANG'
		}, {
			'id': '4',
			'label': 'JS LINK EKUITAS'
		}, ];
		var rangeGajis = [{
				'id': '0',
				'label': '--Pilih--'
			},
			// {'id':'under10','label':'Kurang dari Rp. 10 juta'},
			{
				'id': '10sd50',
				'label': 'ADA'
			},
			// {'id':'50sd100','label':'Rp. 50 juta s/d Rp. 100 juta '},
			// {'id':'othersum','label':'Jumlah lainnya'},
			{
				'id': '0',
				'label': 'Tidak Ada'
			},
		];
		var hubungankeluargas = [{
				'id': '0',
				'label': '--Pilih--'
			},
			//{'id':'dirisendiri','label':'Diri Sendiri'},
			//{'id':'suami','label':'Suami'},
			//{'id':'istri','label':'Istri'},
			//{'id':'anak1','label':'Anak Pertama'},
			//{'id':'anak2','label':'Anak Kedua'},
			//{'id':'anak3','label':'Anak Ketiga'},
			// {'id':'anak4','label':'Anak Keempat'},
			{
				'id': 'AT',
				'label': 'AYAH TIRI'
			}, {
				'id': 'T1',
				'label': 'SAUDARA'
			}, {
				'id': 'TA',
				'label': 'TERTANGGUNG ANAK 1'
			}, {
				'id': 'TB',
				'label': 'TERTANGGUNG ANAK 2'
			}, {
				'id': 'TC',
				'label': 'TERTANGGUNG ANAK 3'
			}, {
				'id': '1T',
				'label': 'ANAK TIRI'
			}, {
				'id': '2T',
				'label': 'ANAK TIRI YG DIBEASISWAKAN'
			}, {
				'id': 'I',
				'label': 'ISTRI'
			}, {
				'id': 'S',
				'label': 'SUAMI'
			}, {
				'id': '1',
				'label': 'ANAK'
			}, {
				'id': 'A',
				'label': 'AYAH'
			}, {
				'id': 'U',
				'label': 'IBU'
			}, {
				'id': 'K',
				'label': 'KAKEK'
			}, {
				'id': 'N',
				'label': 'NENEK'
			}, {
				'id': 'P',
				'label': 'KARYAWAN'
			}, {
				'id': 'W',
				'label': 'SAUDARA PEREMPUAN'
			}, {
				'id': 'L',
				'label': 'SAUDARA LAKI-LAKI'
			}, {
				'id': 'B',
				'label': 'KAKAK KANDUNG'
			}, {
				'id': 'C',
				'label': 'ADIK KANDUNG'
			}, {
				'id': 'X',
				'label': 'DUMMY'
			}, {
				'id': 'D',
				'label': 'ANAK ANGKAT'
			}, {
				'id': 'E',
				'label': 'ADIK IPAR'
			}, {
				'id': 'F',
				'label': 'BIBI'
			}, {
				'id': 'G',
				'label': 'CUCU'
			}, {
				'id': 'H',
				'label': 'DEBITUR'
			}, {
				'id': 'V',
				'label': 'KAKAK IPAR'
			}, {
				'id': 'J',
				'label': 'MERTUA'
			}, {
				'id': 'M',
				'label': 'MERTUA?'
			}, {
				'id': 'Q',
				'label': 'ORANG TUA ANGKAT'
			}, {
				'id': 'R',
				'label': 'PAMAN'
			}, {
				'id': 'T',
				'label': 'SAUDARA ANGKAT'
			}, {
				'id': '04',
				'label': 'DIRI TERTANGGUNG'
			}, {
				'id': 'G2',
				'label': 'CUCU YANG DIBEASISWAKAN'
			}, {
				'id': 'K2',
				'label': 'KEPONAKAN YANG DIBEASISWAKAN'
			}, {
				'id': 'K1',
				'label': 'KEPONAKAN'
			}, {
				'id': 'M1',
				'label': 'MENANTU'
			}, {
				'id': 'T2',
				'label': 'SAUDARA YANG DIBEASISWAKAN'
			}, {
				'id': 'KS',
				'label': 'KAKAK SEPUPU'
			}, {
				'id': 'AS',
				'label': 'ADIK SEPUPU'
			}, {
				'id': 'O2',
				'label': 'PEMEGANG POLIS'
			}, {
				'id': 'A2',
				'label': 'ANAK YG DIBEASISWAKAN'
			}, {
				'id': 'PP',
				'label': 'PEMILIK PERUSAHAAN'
			}, {
				'id': 'PM',
				'label': 'PIMPINAN PERUSAHAAN'
			}, {
				'id': 'UT',
				'label': 'IBU TIRI'
			}, {
				'id': 'TI',
				'label': 'TERTANGGUNG ISTRI'
			}, {
				'id': 'TS',
				'label': 'TERTANGGUNG SUAMI'
			}, {
				'id': 'ZZ',
				'label': 'UNDEFINED'
			}
		];
		var tipedokumens = [{
			'id': '0',
			'id_sae': '0',
			'label': '--Pilih--'
		}, {
			'id': '1',
			'id_sae': 'LAIN LAIN',
			'label': 'LAIN-LAIN'
		}, {
			'id': '30',
			'id_sae': 'KTP',
			'label': 'KTP'
		}, {
			'id': '9',
			'id_sae': 'KK',
			'label': 'KARTU KELUARGA'
		}, {
			'id': '2',
			'id_sae': 'AKTE LAHIR ANAK',
			'label': 'AKTE KEL. ANAK'
		}, {
			'id': '3',
			'id_sae': 'BUKTI ENTRY PREMI I',
			'label': 'BATCH'
		}, {
			'id': '4',
			'id_sae': 'BK',
			'label': 'BERITA KEPUTUSAN'
		}, {
			'id': '5',
			'id_sae': 'BP3',
			'label': 'BP3/ BPPS DAN ID'
		}, {
			'id': '6',
			'id_sae': 'BUKTI TRANSFER',
			'label': 'BUKTI TRANSFER'
		}, {
			'id': '7',
			'id_sae': 'CP',
			'label': 'CASHPLAN'
		}, {
			'id': '8',
			'id_sae': 'HASIL LABORATORIUM',
			'label': 'HASIL PERIKSA LAB  MED'
		}, {
			'id': '10',
			'id_sae': 'KMS',
			'label': 'KMS ANAK'
		}, {
			'id': '11',
			'id_sae': 'POLIS DUPLIKAT',
			'label': 'KUMP DOC DUPLIKAT POLIS'
		}, {
			'id': '12',
			'id_sae': 'EXPIRASI',
			'label': 'KUMP DOC EXPIRASI (JATUH TEMPO)'
		}, {
			'id': '13',
			'id_sae': 'BS BERKALA',
			'label': 'KUMP DOC PEMB BS, ANUITAS BERKALA'
		}, {
			'id': '14',
			'id_sae': 'PEMULIHAN POLIS',
			'label': 'KUMP DOC PEMULIHAN POLIS'
		}, {
			'id': '15',
			'id_sae': 'PERUBAHAN AHLI WARIS',
			'label': 'KUMP DOC UBAH AHLI WARIS'
		}, {
			'id': '16',
			'id_sae': 'PERUBAHAN ALAMAT',
			'label': 'KUMP. DOC UBAH  ALAMAT'
		}, {
			'id': '17',
			'id_sae': 'TEBUS',
			'label': 'KUMPULAN DOC TEBUS'
		}, {
			'id': '18',
			'id_sae': 'KONVERSI',
			'label': 'KUMPULAN DOC. KONVERSI'
		}, {
			'id': '19',
			'id_sae': 'TAHAPAN',
			'label': 'KUMPULAN DOC. TAHAPAN'
		}, {
			'id': '20',
			'id_sae': 'GADAI',
			'label': 'KUMPULAN DOKUMEN GADAI POLIS'
		}, {
			'id': '21',
			'id_sae': 'KLAIM',
			'label': 'KUMPULAN DOKUMEN KLAIM MENINGGAL'
		}, {
			'id': '22',
			'id_sae': 'LAMPIRAN POLIS',
			'label': 'LAMPIRAN POLIS'
		}, {
			'id': '23',
			'id_sae': 'LPK',
			'label': 'LAP. PERIKSA KESEHATAN MEDICAL'
		}, {
			'id': '24',
			'id_sae': 'DESISI',
			'label': 'NOTA DESISI  SPAJ  HO'
		}, {
			'id': '25',
			'id_sae': 'PROPOSAL SPAJ',
			'label': 'PROPOSAL'
		}, {
			'id': '26',
			'id_sae': 'SKK ANAK',
			'label': 'SKK ANAK KHUSUS JS  PRESTASI/SMART'
		}, {
			'id': '27',
			'id_sae': 'SPAJ',
			'label': 'SPAJ/SKK'
		}, {
			'id': '28',
			'id_sae': 'SURAT KUASA',
			'label': 'SURAT KUASA'
		}, {
			'id': '29',
			'id_sae': 'TANDA TERIMA POLIS',
			'label': 'TANDA TERIMA POLIS'
		}, ];
		var bayarberikutnyas = [
		{"id": "0","label": "--Pilih--"}
		, {"id": "autodebet","label": "Auto Debet"}
		, {"id": "host2host","label": "Host to Host"}
		, {"id": "virtualaccount","label": "Virtual Account"}
		, {"id": "ccdebet","label": "Credit Card"}
		];
		var jeniasuransis = [
		  {"id": "0","label": "--Pilih--","gruprider": 0}
		, {"id": "JL4BLN","label": "JS PROMAPAN 2019","gruprider": "3","ctrl_pdf": "jspromapannew"}
		, {"id": "JL4XN","label": "JS PRO IDAMAN","gruprider": "3","ctrl_pdf": "jsproidaman"}
		, {"id": "JSPNNN","label": "JS PRESTASI","gruprider": "3","ctrl_pdf": "prestasi"}
		, {"id": "JSSPOA","label": "JS OPTIMA ASSURANCE","gruprider": "3","ctrl_pdf": "optima7"}
		, {"id": "JSDMPPN","label": "JS DMP PLUS","gruprider": "3","ctrl_pdf": "jsdmpplus"}
		, {"id": "JL4BLN_","label": "-","gruprider": "3","ctrl_pdf": "jspromapannew"}, 
		];
		var pctUnitlinkGuardians = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "JL4XGIH1",
			"label": "JS UL Guardian 85 - 1 thn"
		}, {
			"id": "JL4XGIH2",
			"label": "JS UL Guardian 85 - 2 thn"
		}, {
			"id": "JL4XGIH3",
			"label": "JS UL Guardian 85 - 3 thn"
		}, {
			"id": "JL4XGIH4",
			"label": "JS UL Guardian 85 - 4 thn"
		}, {
			"id": "JL4XGIH5",
			"label": "JS UL Guardian 85 - 5 thn"
		}, {
			"id": "JL4XGIG1",
			"label": "JS UL Guardian 75 - 1 thn"
		}, {
			"id": "JL4XGIG2",
			"label": "JS UL Guardian 75 - 2 thn"
		}, {
			"id": "JL4XGIG3",
			"label": "JS UL Guardian 75 - 3 thn"
		}, {
			"id": "JL4XGIG4",
			"label": "JS UL Guardian 75 - 4 thn"
		}, {
			"id": "JL4XGIG5",
			"label": "JS UL Guardian 75 - 5 thn"
		}];
		var jenisJsProteksiKeluargas = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "K0",
			"label": "K0 - Suami dan Istri"
		}, {
			"id": "K1",
			"label": "K1 - Suami, Istri dan 1 Anak"
		}, {
			"id": "K2",
			"label": "K2 - Suami, Istri dan 2 Anak"
		}, {
			"id": "K3",
			"label": "K3 - Suami, Istri dan 3 Anak"
		}, {
			"id": "B0",
			"label": "B0 - Bujang"
		}, {
			"id": "B1",
			"label": "B1 - Janda/duda dan 1 Anak"
		}, {
			"id": "B2",
			"label": "B2 - Janda/duda dan 2 Anak"
		}, {
			"id": "B3",
			"label": "B3 - Janda/duda dan 3 Anak"
		}];
		var carabayars = [{
			"id": "0",			"label": "--Pilih--",			"kdproduk": "0"
		}, {
			"id": "A",			"label": "TAHUNAN",			"kdproduk": "JL4BG"
		}, {
			"id": "H",			"label": "SEMESTERAN",			"kdproduk": "JL4BG"
		}, {
			"id": "M",			"label": "BULANAN",			"kdproduk": "JL4BG"
		}, {
			"id": "Q",			"label": "KUARTALAN",			"kdproduk": "JL4BG"
		}, {
			"id": "X",			"label": "SEKALIGUS",			"kdproduk": "JL4XN"
		}, {
			"id": "X",			"label": "SEKALIGUS",			"kdproduk": "JSSPOA"
		}, {
			"id": "A",			"label": "TAHUNAN",			"kdproduk": "JL4BLN"
		}, {
			"id": "M",			"label": "BULANAN",			"kdproduk": "JL4BLN"
		}, {
			"id": "A",			"label": "TAHUNAN",			"kdproduk": "JL4BLN_"
		}, {
			"id": "M",			"label": "BULANAN",			"kdproduk": "JL4BLN_"
		}, {
			"id": "1",			"label": "BULANAN",			"kdproduk": "JSDMPPN"
		}, {
			"id": "2",			"label": "KUARTALAN",			"kdproduk": "JSDMPPN"
		}, {
			"id": "3",			"label": "SEMESTERAN",			"kdproduk": "JSDMPPN"
		}, {
			"id": "4",			"label": "TAHUNAN",			"kdproduk": "JSDMPPN"
		}, {
			"id": "1",			"label": "BULANAN",			"kdproduk": "JSDMPPNK"
		}, {
			"id": "1",			"label": "BULANAN",			"kdproduk": "JSPNNN"
		}, {
			"id": "2",			"label": "KUARTALAN",			"kdproduk": "JSPNNN"
		}, {
			"id": "3",			"label": "SEMESTERAN",			"kdproduk": "JSPNNN"
		}, {
			"id": "4",			"label": "TAHUNAN",			"kdproduk": "JSPNNN"
		}, ];
		
		
		var jenisperusahaans = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "swasta",
			"label": "Swasta"
		}, {
			"id": "bumnd",
			"label": "BUMN/BUMD"
		}, {
			"id": "pns",
			"label": "PNS"
		}, {
			"id": "tni",
			"label": "TNI"
		}, {
			"id": "polri",
			"label": "POLRI"
		}, {
			"id": "instansipemerintah",
			"label": "Inst. Pemerintah"
		}, {
			"id": "lainnya",
			"label": "Lainnya"
		}];
		var kelaspekerjaans = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "kelas1",
			"label": "Kelas I"
		}, {
			"id": "kelas2",
			"label": "Kelas II"
		}, {
			"id": "kelas3",
			"label": "Kelas III"
		}, {
			"id": "kelas4",
			"label": "Kelas IV"
		}];
		var pangkats = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "staff",
			"label": "Staff/Administrasi"
		}, {
			"id": "supervisor",
			"label": "Supervisor"
		}, {
			"id": "manajer",
			"label": "Manajer"
		}, {
			"id": "kepalaseksi",
			"label": "Kepala Seksi"
		}, {
			"id": "kepalabagian",
			"label": "Kepala Bagian"
		}, {
			"id": "kepaladivisi",
			"label": "Kepala Divisi"
		}, {
			"id": "kepaladepartemen",
			"label": "Kepala Departemen"
		}, {
			"id": "pimpinan",
			"label": "Pimpinan"
		}, {
			"id": "lainnya",
			"label": "Lainnya"
		}, ];
		var pekerjaans = [{
			"id": "",
			"label": "--Pilih--"
		}, {
			"id": "ACA",
			"label": "PENGACARA",
			'kelas': 'I'
		}, {
			"id": "AGN",
			"label": "AGEN",
			'kelas': 'II'
		}, {
			"id": "AKT",
			"label": "AKTUARIS",
			'kelas': 'I'
		}, {
			"id": "ANA",
			"label": "ANALIS/APOTEKER",
			'kelas': 'I'
		}, {
			"id": "ARS",
			"label": "ARSITEK",
			'kelas': 'I'
		}, {
			"id": "ART",
			"label": "ARTIS",
			'kelas': 'II'
		}, {
			"id": "BNK",
			"label": "BANKIR",
			'kelas': 'I'
		}, {
			"id": "BPT",
			"label": "BUPATI",
			'kelas': 'I'
		}, {
			"id": "BRH",
			"label": "BURUH",
			'kelas': 'III'
		}, {
			"id": "BRW",
			"label": "BIARAWAN / BIARAWATI",
			'kelas': 'I'
		}, {
			"id": "DOK",
			"label": "DOKTER UMUM",
			'kelas': 'I'
		}, {
			"id": "DPR",
			"label": "ANGGOTA DPR / DPRD",
			'kelas': 'I'
		}, {
			"id": "DRH",
			"label": "DOKTER HEWAN",
			'kelas': 'I'
		}, {
			"id": "DSN",
			"label": "DOSEN",
			'kelas': 'I'
		}, {
			"id": "GBR",
			"label": "GUBERNUR",
			'kelas': 'I'
		}, {
			"id": "GRU",
			"label": "GURU",
			'kelas': 'I'
		}, {
			"id": "IBR",
			"label": "Ibu Rumah Tangga",
			'kelas': 'I'
		}, {
			"id": "IKA",
			"label": "AHLI KIMIA",
			'kelas': 'III'
		}, {
			"id": "IRT",
			"label": "IBU RUMAH TANGGA",
			'kelas': 'I'
		}, {
			"id": "KES",
			"label": "Kesehatan",
			'kelas': 'II'
		}, {
			"id": "LKE",
			"label": "Lembaga Keuangan",
			'kelas': 'I'
		}, {
			"id": "LNK",
			"label": "Lembaga Non Keuangan / Pabrikasi",
			'kelas': 'II'
		}, {
			"id": "LSM",
			"label": "Yayasan/LSM",
			'kelas': 'I'
		}, {
			"id": "MED",
			"label": "PARAMEDIS",
			'kelas': 'II'
		}, {
			"id": "MHS",
			"label": "MAHASISWA",
			'kelas': 'I'
		}, {
			"id": "NLY",
			"label": "NELAYAN",
			'kelas': 'I'
		}, {
			"id": "NOT",
			"label": "NOTARIS",
			'kelas': 'I'
		}, {
			"id": "PBD",
			"label": "PEGAWAI BUMD",
			'kelas': 'I'
		}, {
			"id": "PBU",
			"label": "PEGAWAI BUMN",
			'kelas': 'I'
		}, {
			"id": "PDG",
			"label": "PEDAGANG",
			'kelas': 'II'
		}, {
			"id": "PEN",
			"label": "PENSIUNAN",
			'kelas': 'I'
		}, {
			"id": "PFM",
			"label": "SUTRADARA",
			'kelas': 'II'
		}, {
			"id": "PGH",
			"label": "PENGUSAHA",
			'kelas': 'I'
		}, {
			"id": "PLJ",
			"label": "PELAJAR",
			'kelas': 'I'
		}, {
			"id": "PMA",
			"label": "Pelajar/Mahasiswa",
			'kelas': 'I'
		}, {
			"id": "PNB",
			"label": "PENERBANG",
			'kelas': 'III'
		}, {
			"id": "PND",
			"label": "PENDETA",
			'kelas': 'I'
		}, {
			"id": "PNG",
			"label": "PENAGIH",
			'kelas': 'II'
		}, {
			"id": "PNN",
			"label": "Pensiunan",
			'kelas': 'I'
		}, {
			"id": "PNS",
			"label": "PEGAWAI NEGERI SIPIL",
			'kelas': 'I'
		}, {
			"id": "PPM",
			"label": "Pejabat Pemerintah & MPR/DPR/DPRD",
			'kelas': 'I'
		}, {
			"id": "PPP",
			"label": "Pengurus Parpol",
			'kelas': 'I'
		}, {
			"id": "PRA",
			"label": "PRAMUGARI",
			'kelas': 'III'
		}, {
			"id": "PRG",
			"label": "KOMPUTER PROGRAMMER",
			'kelas': 'I'
		}, {
			"id": "PRM",
			"label": "PEGAWAI SWASTA ASING",
			'kelas': 'I'
		}, {
			"id": "PRO",
			"label": "Profesional",
			'kelas': 'I'
		}, {
			"id": "PSN",
			"label": "PEGAWAI SWASTA NASIONAL",
			'kelas': 'I'
		}, {
			"id": "SAN",
			"label": "KOMPUTER SISTEM ANALIS",
			'kelas': 'I'
		}, {
			"id": "SAT",
			"label": "SATPAM",
			'kelas': 'IV'
		}, {
			"id": "SPL",
			"label": "DOKTER SPESIALIS",
			'kelas': 'I'
		}, {
			"id": "SPR",
			"label": "SOPIR",
			'kelas': 'II'
		}, {
			"id": "SWA",
			"label": "Swasta",
			'kelas': 'I'
		}, {
			"id": "TAN",
			"label": "PETANI",
			'kelas': 'II'
		}, {
			"id": "TAU",
			"label": "TEKNISI AUTOMOTIF",
			'kelas': 'II'
		}, {
			"id": "TKE",
			"label": "TEKNISI ELEKTRONIK",
			'kelas': 'II'
		}, {
			"id": "TNI",
			"label": "TNI / POLRI",
			'kelas': 'IV'
		}, {
			"id": "TPT",
			"label": "TEKNISI PESAWAT TERBANG",
			'kelas': 'II'
		}, {
			"id": "ULM",
			"label": "ULAMA",
			'kelas': 'I'
		}, {
			"id": "WBP",
			"label": "WAKIL BUPATI",
			'kelas': 'I'
		}, {
			"id": "WIR",
			"label": "WIRASWASTA",
			'kelas': 'I'
		}, {
			"id": "otherpekerjaan",
			"label": "Lainnya",
			'kelas': '-'
		}];
		var statusnikahs = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "L",
			"label": "Lajang"
		}, {
			"id": "K",
			"label": "Menikah"
		}, {
			"id": "J",
			"label": "Janda"
		}, {
			"id": "D",
			"label": "Duda"
		}, {
			"id": "A",
			"label": "K/0 Menikah"
		}, {
			"id": "B",
			"label": "K/1 Menikah 1 Anak"
		}, {
			"id": "C",
			"label": "K/2 Menikah 2 Anak"
		}, {
			"id": "E",
			"label": "K/3 Menikah 3 Anak"
		}, {
			"id": "F",
			"label": "K/4 Menikah 4 Anak"
		}, {
			"id": "G",
			"label": "K/5 Menikah 5 Anak"
		}, {
			"id": "I",
			"label": "B/1 Lajang 1 Anak"
		}, {
			"id": "M",
			"label": "B/2 Lajang 2 Anak"
		}, {
			"id": "N",
			"label": "B/3 Lajang 3 Anak"
		}, {
			"id": "O",
			"label": "B/4 Lajang 4 Anak"
		}, {
			"id": "P",
			"label": "B/5 Lajang 5 Anak"
		}];
		var pendidikans = [{
			"id": "0",
			"label": "--Pilih--"
		}, {
			"id": "SD",
			"label": "SD"
		}, {
			"id": "SMP",
			"label": "SMP"
		}, {
			"id": "SMA",
			"label": "SMA / Sederajat"
		}, {
			"id": "D1",
			"label": "D1/D3"
		}, {
			"id": "S1",
			"label": "S1"
		}, {
			"id": "S2",
			"label": "S2"
		}, {
			"id": "S3",
			"label": "S3"
		}];
		var statustinggals = [{
			"label": "--Pilih--",
			'id': '0'
		}, {
			"label": "Milik Sendiri",
			'id': '1'
		}, {
			"label": "Sewa",
			'id': '2'
		}, {
			"label": "Lainnya",
			'id': '3'
		}];
		var provinsis = [{
			"label": "--Pilih--",
			"id": "0",
			"id_jaim": "0"
		}, {
			"label": "BANTEN",
			"id": "BAN",
			"id_jaim": "BT"
		}, {
			"label": "BANGKA BELITUNG",
			"id": "BKB",
			"id_jaim": "BB"
		}, {
			"label": "BENGKULU",
			"id": "BKL",
			"id_jaim": "BE"
		}, {
			"label": "BALI",
			"id": "BLI",
			"id_jaim": "BA"
		}, {
			"label": "ACEH",
			"id": "DIA",
			"id_jaim": "AC"
		}, {
			"label": "DAERAH ISTIMEWA YOGYAKARTA",
			"id": "DIY",
			"id_jaim": "YO"
		}, {
			"label": "DAERAH KHUSUS IBUKOTA JAKARTA",
			"id": "DKI",
			"id_jaim": "JK"
		}, {
			"label": "PAPUA BARAT",
			"id": "IRB",
			"id_jaim": "PB"
		}, {
			"label": "PAPUA",
			"id": "IRJ",
			"id_jaim": "PA"
		}, {
			"label": "JAMBI",
			"id": "JMB",
			"id_jaim": "JA"
		}, {
			"label": "JAWA BARAT",
			"id": "JWB",
			"id_jaim": "JB"
		}, {
			"label": "JAWA TENGAH",
			"id": "JWH",
			"id_jaim": "JT"
		}, {
			"label": "JAWA TIMUR",
			"id": "JWT",
			"id_jaim": "JI"
		}, {
			"label": "KALIMANTAN BARAT",
			"id": "KLB",
			"id_jaim": "KB"
		}, {
			"label": "KALIMANTAN TENGAH",
			"id": "KLH",
			"id_jaim": "KT"
		}, {
			"label": "KALIMANTAN SELATAN",
			"id": "KLS",
			"id_jaim": "KS"
		}, {
			"label": "KALIMANTAN TIMUR",
			"id": "KLT",
			"id_jaim": "KI"
		}, {
			"label": "KALIMANTAN UTARA",
			"id": "KLU",
			"id_jaim": "KU"
		}, {
			"label": "LAMPUNG",
			"id": "LPG",
			"id_jaim": "LA"
		}, {
			"label": "MALUKU",
			"id": "MLK",
			"id_jaim": "MA"
		}, {
			"label": "MALUKU UTARA",
			"id": "MLU",
			"id_jaim": "MU"
		}, {
			"label": "NUSA TENGGARA BARAT",
			"id": "NTB",
			"id_jaim": "NB"
		}, {
			"label": "NUSA TENGGARA TIMUR",
			"id": "NTT",
			"id_jaim": "NT"
		}, {
			"label": "RIAU",
			"id": "RIA",
			"id_jaim": "RI"
		}, {
			"label": "KEP. RIAU",
			"id": "RIU",
			"id_jaim": "KR"
		}, {
			"label": "GORONTALO",
			"id": "SGR",
			"id_jaim": "GO"
		}, {
			"label": "SULAWESI BARAT",
			"id": "SLB",
			"id_jaim": "SR"
		}, {
			"label": "SULAWESI TENGGARA",
			"id": "SLG",
			"id_jaim": "SG"
		}, {
			"label": "SULAWESI TENGAH",
			"id": "SLH",
			"id_jaim": "ST"
		}, {
			"label": "SULAWESI SELATAN",
			"id": "SLS",
			"id_jaim": "SN"
		}, {
			"label": "SULAWESI UTARA",
			"id": "SLU",
			"id_jaim": "SA"
		}, {
			"label": "SUMATRA BARAT",
			"id": "SMB",
			"id_jaim": "SB"
		}, {
			"label": "SUMATRA SELATAN",
			"id": "SMS",
			"id_jaim": "SS"
		}, {
			"label": "SUMATERA UTARA",
			"id": "SMU",
			"id_jaim": "SU"
		}, {
			"label": "TIMOR TIMUR",
			"id": "TMT",
			"id_jaim": "BA"
		}];
		var kabupatens = [{
			"label": "--Pilih--",
			"id": "0",
			"kdprop": "0"
		}, {
			"label": "TANGERANG",
			"id": "TGR",
			"kdprop": "BAN"
		}, {
			"label": "CIKANDE",
			"id": "CKD",
			"kdprop": "BAN"
		}, {
			"label": "LEBAK",
			"id": "LBK",
			"kdprop": "BAN"
		}, {
			"label": "CILEDUG",
			"id": "CLD",
			"kdprop": "BAN"
		}, {
			"label": "SERANG",
			"id": "SRG",
			"kdprop": "BAN"
		}, {
			"label": "RANGKASBITUNG",
			"id": "RKB",
			"kdprop": "BAN"
		}, {
			"label": "PANDEGLANG",
			"id": "PDG",
			"kdprop": "BAN"
		}, {
			"label": "CILEGON",
			"id": "CLG",
			"kdprop": "BAN"
		}, {
			"label": "CIPUTAT",
			"id": "CPT",
			"kdprop": "BAN"
		}, {
			"label": "TANGERANG SELATAN",
			"id": "TSL",
			"kdprop": "BAN"
		}, {
			"label": "BANGKA",
			"id": "KBK",
			"kdprop": "BKB"
		}, {
			"label": "PANGKALPINANG",
			"id": "PKP",
			"kdprop": "BKB"
		}, {
			"label": "BANGKA BARAT",
			"id": "MTK",
			"kdprop": "BKB"
		}, {
			"label": "BELITUNG TIMUR",
			"id": "MGR",
			"kdprop": "BKB"
		}, {
			"label": "BANGKA INDUK",
			"id": "SLT",
			"kdprop": "BKB"
		}, {
			"label": "BANGKA SELATAN",
			"id": "TBL",
			"kdprop": "BKB"
		}, {
			"label": "PANGKALPINANG",
			"id": "PKA",
			"kdprop": "BKB"
		}, {
			"label": "BELITUNG",
			"id": "TJN",
			"kdprop": "BKB"
		}, {
			"label": "BANGKA TENGAH",
			"id": "KOB",
			"kdprop": "BKB"
		}, {
			"label": "CURUP",
			"id": "CRP",
			"kdprop": "BKL"
		}, {
			"label": "BENGKULU",
			"id": "BKL",
			"kdprop": "BKL"
		}, {
			"label": "ARGAMAKMUR",
			"id": "AGR",
			"kdprop": "BKL"
		}, {
			"label": "BENGKULU TENGAH",
			"id": "BK1",
			"kdprop": "BKL"
		}, {
			"label": "MUARA AMAN",
			"id": "MAN",
			"kdprop": "BKL"
		}, {
			"label": "TAIS",
			"id": "TIS",
			"kdprop": "BKL"
		}, {
			"label": "BINTUHAN",
			"id": "BIN",
			"kdprop": "BKL"
		}, {
			"label": "MUKO MUKO",
			"id": "MKM",
			"kdprop": "BKL"
		}, {
			"label": "LEBONG",
			"id": "LBN",
			"kdprop": "BKL"
		}, {
			"label": "KEPAHIANG",
			"id": "KPH",
			"kdprop": "BKL"
		}, {
			"label": "BENGKULU SELATAN",
			"id": "BLS",
			"kdprop": "BKL"
		}, {
			"label": "KAUR",
			"id": "KAU",
			"kdprop": "BKL"
		}, {
			"label": "SELUMA",
			"id": "SLM",
			"kdprop": "BKL"
		}, {
			"label": "BENGKULU UTARA",
			"id": "BKU",
			"kdprop": "BKL"
		}, {
			"label": "REJANG LEBONG",
			"id": "RJL",
			"kdprop": "BKL"
		}, {
			"label": "MANNA",
			"id": "MNA",
			"kdprop": "BKL"
		}, {
			"label": "BULELENG",
			"id": "BLL",
			"kdprop": "BLI"
		}, {
			"label": "BADUNG",
			"id": "BAD",
			"kdprop": "BLI"
		}, {
			"label": "DENPASAR",
			"id": "DPS",
			"kdprop": "BLI"
		}, {
			"label": "SINGARAJA",
			"id": "SGR",
			"kdprop": "BLI"
		}, {
			"label": "JEMBRANA",
			"id": "JBN",
			"kdprop": "BLI"
		}, {
			"label": "KLUNGKUNG",
			"id": "KLK",
			"kdprop": "BLI"
		}, {
			"label": "NEGARA, BALI",
			"id": "NGA",
			"kdprop": "BLI"
		}, {
			"label": "AMLAPURA",
			"id": "ALP",
			"kdprop": "BLI"
		}, {
			"label": "GIANYAR",
			"id": "GIN",
			"kdprop": "BLI"
		}, {
			"label": "KARANGASEM",
			"id": "KAN",
			"kdprop": "BLI"
		}, {
			"label": "BANGLI",
			"id": "BGL",
			"kdprop": "BLI"
		}, {
			"label": "TABANAN",
			"id": "TBN",
			"kdprop": "BLI"
		}, {
			"label": "PIDIE",
			"id": "PDI",
			"kdprop": "DIA"
		}, {
			"label": "ACEH UTARA",
			"id": "AUT",
			"kdprop": "DIA"
		}, {
			"label": "KOTA SUBULUSSALAM",
			"id": "ASL",
			"kdprop": "DIA"
		}, {
			"label": "KABUPATEN PIDIE JAYA",
			"id": "APJ",
			"kdprop": "DIA"
		}, {
			"label": "KABUPATEN GAYO LUES",
			"id": "AGL",
			"kdprop": "DIA"
		}, {
			"label": "KABUPATEN ACEH JAYA",
			"id": "AJY",
			"kdprop": "DIA"
		}, {
			"label": "ACEH TENGGARA",
			"id": "ACE",
			"kdprop": "DIA"
		}, {
			"label": "ACEH TIMUR",
			"id": "ACM",
			"kdprop": "DIA"
		}, {
			"label": "TAKENGON",
			"id": "TKG",
			"kdprop": "DIA"
		}, {
			"label": "NAGAN RAYA",
			"id": "NAR",
			"kdprop": "DIA"
		}, {
			"label": "ACEH SINGKIL",
			"id": "ACS",
			"kdprop": "DIA"
		}, {
			"label": "SINGKIL",
			"id": "SKL",
			"kdprop": "DIA"
		}, {
			"label": "SABANG",
			"id": "SBN",
			"kdprop": "DIA"
		}, {
			"label": "BIREUEN",
			"id": "BRE",
			"kdprop": "DIA"
		}, {
			"label": "ACEH TAMIANG",
			"id": "ACT",
			"kdprop": "DIA"
		}, {
			"label": "ACEH BESAR",
			"id": "ACB",
			"kdprop": "DIA"
		}, {
			"label": "KABUPATEN ACEH BARAT DAYA",
			"id": "ABD",
			"kdprop": "DIA"
		}, {
			"label": "ACEH SELATAN",
			"id": "ACL",
			"kdprop": "DIA"
		}, {
			"label": "BENER MERIAH",
			"id": "BNR",
			"kdprop": "DIA"
		}, {
			"label": "ACEH BARAT",
			"id": "ABA",
			"kdprop": "DIA"
		}, {
			"label": "NAGAN RAYA",
			"id": "NGR",
			"kdprop": "DIA"
		}, {
			"label": "ACEH TENGAH",
			"id": "ATG",
			"kdprop": "DIA"
		}, {
			"label": "SIGLI",
			"id": "SGI",
			"kdprop": "DIA"
		}, {
			"label": "TAPAKTUAN",
			"id": "TTN",
			"kdprop": "DIA"
		}, {
			"label": "BANDA ACEH",
			"id": "BNA",
			"kdprop": "DIA"
		}, {
			"label": "JANTHO",
			"id": "JAN",
			"kdprop": "DIA"
		}, {
			"label": "KUTACANE",
			"id": "KTN",
			"kdprop": "DIA"
		}, {
			"label": "LANGSA",
			"id": "LGS",
			"kdprop": "DIA"
		}, {
			"label": "LHOKSEUMAWE",
			"id": "LSM",
			"kdprop": "DIA"
		}, {
			"label": "MEULABOH",
			"id": "MBO",
			"kdprop": "DIA"
		}, {
			"label": "KULON PROGO",
			"id": "WAT",
			"kdprop": "DIY"
		}, {
			"label": "BANTUL",
			"id": "BTL",
			"kdprop": "DIY"
		}, {
			"label": "SLEMAN",
			"id": "SMN",
			"kdprop": "DIY"
		}, {
			"label": "GUNUNG KIDUL",
			"id": "WNR",
			"kdprop": "DIY"
		}, {
			"label": "YOGYAKARTA",
			"id": "YOG",
			"kdprop": "DIY"
		}, {
			"label": "JAKARTA UTARA",
			"id": "DKU",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA PUSAT",
			"id": "JKP",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA BARAT",
			"id": "JKB",
			"kdprop": "DKI"
		}, {
			"label": "KAB. KEPULAUAN SERIBU",
			"id": "KKS",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA TIMUR",
			"id": "JKT",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA UTARA",
			"id": "JKU",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA SELATAN",
			"id": "JKS",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA PUSAT",
			"id": "DKP",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA SELATAN",
			"id": "DKS",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA BARAT",
			"id": "DKB",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA TIMUR",
			"id": "DKT",
			"kdprop": "DKI"
		}, {
			"label": "JAKARTA",
			"id": "JKK",
			"kdprop": "DKI"
		}, {
			"label": "MANOKWARI",
			"id": "MWR",
			"kdprop": "IRB"
		}, {
			"label": "TELUK BINTUNI",
			"id": "TLB",
			"kdprop": "IRB"
		}, {
			"label": "SORONG",
			"id": "SON",
			"kdprop": "IRJ"
		}, {
			"label": "SERUI",
			"id": "SRU",
			"kdprop": "IRJ"
		}, {
			"label": "WAMENA",
			"id": "WMN",
			"kdprop": "IRJ"
		}, {
			"label": "MERAUKE",
			"id": "MRK",
			"kdprop": "IRJ"
		}, {
			"label": "NABIRE",
			"id": "NAB",
			"kdprop": "IRJ"
		}, {
			"label": "JAYAPURA",
			"id": "JPR",
			"kdprop": "IRJ"
		}, {
			"label": "BIAK",
			"id": "BIA",
			"kdprop": "IRJ"
		}, {
			"label": "FAKFAK",
			"id": "FFK",
			"kdprop": "IRJ"
		}, {
			"label": "JAYAPURA",
			"id": "JPY",
			"kdprop": "IRJ"
		}, {
			"label": "TIMIKA",
			"id": "TMK",
			"kdprop": "IRJ"
		}, {
			"label": "SENTANI",
			"id": "STN",
			"kdprop": "IRJ"
		}, {
			"label": "MIMIKA",
			"id": "MMK",
			"kdprop": "IRJ"
		}, {
			"label": "KAB. SARMI",
			"id": "KSM",
			"kdprop": "IRJ"
		}, {
			"label": "KAB. MAPPI",
			"id": "MPI",
			"kdprop": "IRJ"
		}, {
			"label": "PEGUNUNGAN BINTANG",
			"id": "PGB",
			"kdprop": "IRJ"
		}, {
			"label": "KAB. PUNCAK JAYA",
			"id": "PJY",
			"kdprop": "IRJ"
		}, {
			"label": "KEPULAUAN YAPEN",
			"id": "KPY",
			"kdprop": "IRJ"
		}, {
			"label": "KAB. YAHUKIMO",
			"id": "YKM",
			"kdprop": "IRJ"
		}, {
			"label": "JAMBI",
			"id": "JMB",
			"kdprop": "JMB"
		}, {
			"label": "KUALATUNGKAL",
			"id": "KTL",
			"kdprop": "JMB"
		}, {
			"label": "BUNGO",
			"id": "BGO",
			"kdprop": "JMB"
		}, {
			"label": "BATANG HARI",
			"id": "BTH",
			"kdprop": "JMB"
		}, {
			"label": "SAROLANGUN",
			"id": "SRL",
			"kdprop": "JMB"
		}, {
			"label": "MERANGIN",
			"id": "MRG",
			"kdprop": "JMB"
		}, {
			"label": "TEBO",
			"id": "TBO",
			"kdprop": "JMB"
		}, {
			"label": "TANJAB BARAT",
			"id": "TJB",
			"kdprop": "JMB"
		}, {
			"label": "TANJAB TIMUR",
			"id": "TJT",
			"kdprop": "JMB"
		}, {
			"label": "SUNGAI PENUH",
			"id": "SGP",
			"kdprop": "JMB"
		}, {
			"label": "KERINCI",
			"id": "KRC",
			"kdprop": "JMB"
		}, {
			"label": "MUAROJAMBI",
			"id": "MJI",
			"kdprop": "JMB"
		}, {
			"label": "DEPOK",
			"id": "DPK",
			"kdprop": "JWB"
		}, {
			"label": "GARUT",
			"id": "GRT",
			"kdprop": "JWB"
		}, {
			"label": "INDRAMAYU",
			"id": "IDM",
			"kdprop": "JWB"
		}, {
			"label": "KUNINGAN",
			"id": "KNG",
			"kdprop": "JWB"
		}, {
			"label": "KARAWANG",
			"id": "KWG",
			"kdprop": "JWB"
		}, {
			"label": "MAJALENGKA",
			"id": "MJL",
			"kdprop": "JWB"
		}, {
			"label": "BANJAR",
			"id": "BJR",
			"kdprop": "JWB"
		}, {
			"label": "PANGANDARAN",
			"id": "PDR",
			"kdprop": "JWB"
		}, {
			"label": "BANDUNG BARAT",
			"id": "BDB",
			"kdprop": "JWB"
		}, {
			"label": "BEKASI",
			"id": "BKK",
			"kdprop": "JWB"
		}, {
			"label": "PURWAKARTA",
			"id": "PWK",
			"kdprop": "JWB"
		}, {
			"label": "SUKABUMI",
			"id": "SKB",
			"kdprop": "JWB"
		}, {
			"label": "SUMBER",
			"id": "SMB",
			"kdprop": "JWB"
		}, {
			"label": "SUMEDANG",
			"id": "SMD",
			"kdprop": "JWB"
		}, {
			"label": "SUBANG",
			"id": "SUB",
			"kdprop": "JWB"
		}, {
			"label": "TASIKMALAYA",
			"id": "TSM",
			"kdprop": "JWB"
		}, {
			"label": "UJUNG BERUNG",
			"id": "UJB",
			"kdprop": "JWB"
		}, {
			"label": "BANDUNG",
			"id": "BDG",
			"kdprop": "JWB"
		}, {
			"label": "BEKASI",
			"id": "BKS",
			"kdprop": "JWB"
		}, {
			"label": "BOGOR",
			"id": "BOG",
			"kdprop": "JWB"
		}, {
			"label": "CIBINONG",
			"id": "CBI",
			"kdprop": "JWB"
		}, {
			"label": "CIREBON",
			"id": "CBN",
			"kdprop": "JWB"
		}, {
			"label": "CIANJUR",
			"id": "CJR",
			"kdprop": "JWB"
		}, {
			"label": "CIKARANG",
			"id": "CKR",
			"kdprop": "JWB"
		}, {
			"label": "CIMAHI",
			"id": "CMH",
			"kdprop": "JWB"
		}, {
			"label": "CIAMIS",
			"id": "CMI",
			"kdprop": "JWB"
		}, {
			"label": "KENDAL",
			"id": "KDL",
			"kdprop": "JWH"
		}, {
			"label": "KUDUS",
			"id": "KDS",
			"kdprop": "JWH"
		}, {
			"label": "KLATEN",
			"id": "KLT",
			"kdprop": "JWH"
		}, {
			"label": "KARANGANYAR",
			"id": "KRA",
			"kdprop": "JWH"
		}, {
			"label": "KARANG AYU",
			"id": "KRY",
			"kdprop": "JWH"
		}, {
			"label": "MAGELANG",
			"id": "MGL",
			"kdprop": "JWH"
		}, {
			"label": "MAJENANG",
			"id": "MJN",
			"kdprop": "JWH"
		}, {
			"label": "SALATIGA",
			"id": "SLG",
			"kdprop": "JWH"
		}, {
			"label": "KEBUMEN",
			"id": "KBE",
			"kdprop": "JWH"
		}, {
			"label": "JEPARA",
			"id": "JPA",
			"kdprop": "JWH"
		}, {
			"label": "SURAKARTA",
			"id": "SRR",
			"kdprop": "JWH"
		}, {
			"label": "PURWOKERTO UTARA",
			"id": "PWU",
			"kdprop": "JWH"
		}, {
			"label": "GROBOGAN",
			"id": "GRB",
			"kdprop": "JWH"
		}, {
			"label": "BANYUMAS",
			"id": "BNY",
			"kdprop": "JWH"
		}, {
			"label": "PATI",
			"id": "PTI",
			"kdprop": "JWH"
		}, {
			"label": "PURWODADI",
			"id": "PWD",
			"kdprop": "JWH"
		}, {
			"label": "PURWOREJO",
			"id": "PWR",
			"kdprop": "JWH"
		}, {
			"label": "PURWOKERTO",
			"id": "PWT",
			"kdprop": "JWH"
		}, {
			"label": "REMBANG",
			"id": "RBG",
			"kdprop": "JWH"
		}, {
			"label": "SUKOHARJO",
			"id": "SKH",
			"kdprop": "JWH"
		}, {
			"label": "SLAWI",
			"id": "SLW",
			"kdprop": "JWH"
		}, {
			"label": "SEMARANG",
			"id": "SMG",
			"kdprop": "JWH"
		}, {
			"label": "SRAGEN",
			"id": "SRA",
			"kdprop": "JWH"
		}, {
			"label": "TEGAL",
			"id": "TGL",
			"kdprop": "JWH"
		}, {
			"label": "TEMANGGUNG",
			"id": "TMG",
			"kdprop": "JWH"
		}, {
			"label": "UNGARAN",
			"id": "UNG",
			"kdprop": "JWH"
		}, {
			"label": "WONOSOBO",
			"id": "WNB",
			"kdprop": "JWH"
		}, {
			"label": "WONOGIRI",
			"id": "WNG",
			"kdprop": "JWH"
		}, {
			"label": "PURBALINGGA",
			"id": "PBG",
			"kdprop": "JWH"
		}, {
			"label": "PEKALONGAN",
			"id": "PKL",
			"kdprop": "JWH"
		}, {
			"label": "PEMALANG",
			"id": "PML",
			"kdprop": "JWH"
		}, {
			"label": "BREBES",
			"id": "BBS",
			"kdprop": "JWH"
		}, {
			"label": "BANJARNEGARA",
			"id": "BJN",
			"kdprop": "JWH"
		}, {
			"label": "BLORA",
			"id": "BLO",
			"kdprop": "JWH"
		}, {
			"label": "BATANG",
			"id": "BTG",
			"kdprop": "JWH"
		}, {
			"label": "BOYOLALI",
			"id": "BYL",
			"kdprop": "JWH"
		}, {
			"label": "CILACAP",
			"id": "CLP",
			"kdprop": "JWH"
		}, {
			"label": "DEMAK",
			"id": "DMK",
			"kdprop": "JWH"
		}, {
			"label": "GRESIK",
			"id": "GRS",
			"kdprop": "JWT"
		}, {
			"label": "GENTENG",
			"id": "GTG",
			"kdprop": "JWT"
		}, {
			"label": "JOMBANG",
			"id": "JBG",
			"kdprop": "JWT"
		}, {
			"label": "JEMBER",
			"id": "JBR",
			"kdprop": "JWT"
		}, {
			"label": "KEDIRI",
			"id": "KDR",
			"kdprop": "JWT"
		}, {
			"label": "KEPANJEN",
			"id": "KPN",
			"kdprop": "JWT"
		}, {
			"label": "LAMONGAN",
			"id": "LMG",
			"kdprop": "JWT"
		}, {
			"label": "LUMAJANG",
			"id": "LMJ",
			"kdprop": "JWT"
		}, {
			"label": "MADIUN",
			"id": "MDU",
			"kdprop": "JWT"
		}, {
			"label": "MAGETAN",
			"id": "MGT",
			"kdprop": "JWT"
		}, {
			"label": "MOJOKERTO",
			"id": "MJK",
			"kdprop": "JWT"
		}, {
			"label": "MALANG",
			"id": "MLG",
			"kdprop": "JWT"
		}, {
			"label": "TUBAN",
			"id": "TUB",
			"kdprop": "JWT"
		}, {
			"label": "PARE",
			"id": "PAR",
			"kdprop": "JWT"
		}, {
			"label": "SURABAYA",
			"id": "SBY",
			"kdprop": "JWT"
		}, {
			"label": "BOJONEGORO",
			"id": "BNG",
			"kdprop": "JWT"
		}, {
			"label": "SITUBONDO",
			"id": "SIT",
			"kdprop": "JWT"
		}, {
			"label": "PONOROGO",
			"id": "PON",
			"kdprop": "JWT"
		}, {
			"label": "PASURUAN",
			"id": "PSR",
			"kdprop": "JWT"
		}, {
			"label": "SIDOARJO",
			"id": "SDA",
			"kdprop": "JWT"
		}, {
			"label": "SUMENEP",
			"id": "SMP",
			"kdprop": "JWT"
		}, {
			"label": "SAMPANG",
			"id": "SPG",
			"kdprop": "JWT"
		}, {
			"label": "TRENGGALEK",
			"id": "TGK",
			"kdprop": "JWT"
		}, {
			"label": "TULUNGAGUNG",
			"id": "TLG",
			"kdprop": "JWT"
		}, {
			"label": "NGANJUK",
			"id": "NGJ",
			"kdprop": "JWT"
		}, {
			"label": "NGAWI",
			"id": "NGW",
			"kdprop": "JWT"
		}, {
			"label": "PROBOLINGGO",
			"id": "PBL",
			"kdprop": "JWT"
		}, {
			"label": "PACITAN",
			"id": "PCT",
			"kdprop": "JWT"
		}, {
			"label": "PAMEKASAN",
			"id": "PMK",
			"kdprop": "JWT"
		}, {
			"label": "BANGKALAN",
			"id": "BKN",
			"kdprop": "JWT"
		}, {
			"label": "BLITAR",
			"id": "BLT",
			"kdprop": "JWT"
		}, {
			"label": "BONDOWOSO",
			"id": "BOW",
			"kdprop": "JWT"
		}, {
			"label": "BATU",
			"id": "BTU",
			"kdprop": "JWT"
		}, {
			"label": "BANYUWANGI",
			"id": "BWG",
			"kdprop": "JWT"
		}, {
			"label": "KAYONG UTARA",
			"id": "KYU",
			"kdprop": "KLB"
		}, {
			"label": "KABUPATEN KAPUAS HULU",
			"id": "KKH",
			"kdprop": "KLB"
		}, {
			"label": "PONTIANAK",
			"id": "PTK",
			"kdprop": "KLB"
		}, {
			"label": "PUTUSSIBAU",
			"id": "PTS",
			"kdprop": "KLB"
		}, {
			"label": "SANGGAU",
			"id": "SAG",
			"kdprop": "KLB"
		}, {
			"label": "SAMBAS",
			"id": "SBS",
			"kdprop": "KLB"
		}, {
			"label": "SEKURA",
			"id": "SKR",
			"kdprop": "KLB"
		}, {
			"label": "SINGKAWANG",
			"id": "SKW",
			"kdprop": "KLB"
		}, {
			"label": "SINTANG",
			"id": "STG",
			"kdprop": "KLB"
		}, {
			"label": "MEMPAWAH",
			"id": "MPW",
			"kdprop": "KLB"
		}, {
			"label": "KETAPANG",
			"id": "KTP",
			"kdprop": "KLB"
		}, {
			"label": "BENGKAYANG",
			"id": "BKY",
			"kdprop": "KLB"
		}, {
			"label": "MELAWI",
			"id": "MLW",
			"kdprop": "KLB"
		}, {
			"label": "SEKADAU",
			"id": "SKD",
			"kdprop": "KLB"
		}, {
			"label": "NGABANG",
			"id": "NBG",
			"kdprop": "KLB"
		}, {
			"label": "LANDAK",
			"id": "LDK",
			"kdprop": "KLB"
		}, {
			"label": "KUBU RAYA",
			"id": "KBR",
			"kdprop": "KLB"
		}, {
			"label": "AMPAH",
			"id": "AMP",
			"kdprop": "KLH"
		}, {
			"label": "PANGKALANBUN",
			"id": "PBU",
			"kdprop": "KLH"
		}, {
			"label": "MUARATEWEH",
			"id": "MTW",
			"kdprop": "KLH"
		}, {
			"label": "KABUPATEN KAPUAS",
			"id": "PUS",
			"kdprop": "KLH"
		}, {
			"label": "SERUYAN",
			"id": "SRY",
			"kdprop": "KLH"
		}, {
			"label": "SAMPIT",
			"id": "SPT",
			"kdprop": "KLH"
		}, {
			"label": "KOTA WARINGIN BARAT",
			"id": "KWB",
			"kdprop": "KLH"
		}, {
			"label": "GUNUNG MAS",
			"id": "GNM",
			"kdprop": "KLH"
		}, {
			"label": "KUALA KURUN",
			"id": "KKR",
			"kdprop": "KLH"
		}, {
			"label": "PULANG PISAU",
			"id": "PP",
			"kdprop": "KLH"
		}, {
			"label": "KOTA WARINGIN TIMUR",
			"id": "KWT",
			"kdprop": "KLH"
		}, {
			"label": "PURUK CAHU",
			"id": "PCH",
			"kdprop": "KLH"
		}, {
			"label": "BUNTOK",
			"id": "BNT",
			"kdprop": "KLH"
		}, {
			"label": "MURUNG RAYA",
			"id": "MRY",
			"kdprop": "KLH"
		}, {
			"label": "KASONGAN",
			"id": "KS",
			"kdprop": "KLH"
		}, {
			"label": "TAMIANG LAYANG",
			"id": "TML",
			"kdprop": "KLH"
		}, {
			"label": "SUKAMARA",
			"id": "SKM",
			"kdprop": "KLH"
		}, {
			"label": "KUALA KAPUAS",
			"id": "KKP",
			"kdprop": "KLH"
		}, {
			"label": "PALANGKARAYA",
			"id": "PLK",
			"kdprop": "KLH"
		}, {
			"label": "TANJUNG",
			"id": "TJG",
			"kdprop": "KLS"
		}, {
			"label": "TANAH LAUT",
			"id": "PLH",
			"kdprop": "KLS"
		}, {
			"label": "AMUNTAI",
			"id": "AMT",
			"kdprop": "KLS"
		}, {
			"label": "BANJARBARU",
			"id": "BJB",
			"kdprop": "KLS"
		}, {
			"label": "BANJARMASIN",
			"id": "BJM",
			"kdprop": "KLS"
		}, {
			"label": "MARABAHAN",
			"id": "MRB",
			"kdprop": "KLS"
		}, {
			"label": "TABALONG",
			"id": "TBG",
			"kdprop": "KLS"
		}, {
			"label": "BARABAI",
			"id": "BRI",
			"kdprop": "KLS"
		}, {
			"label": "PARINGIN",
			"id": "PRG",
			"kdprop": "KLS"
		}, {
			"label": "KOTABARU",
			"id": "KTB",
			"kdprop": "KLS"
		}, {
			"label": "KANDANGAN",
			"id": "KGN",
			"kdprop": "KLS"
		}, {
			"label": "RANTAU",
			"id": "RTA",
			"kdprop": "KLS"
		}, {
			"label": "PELAIHARI",
			"id": "PLI",
			"kdprop": "KLS"
		}, {
			"label": "TAPIN",
			"id": "TPN",
			"kdprop": "KLS"
		}, {
			"label": "TANAH BUMBU",
			"id": "TNB",
			"kdprop": "KLS"
		}, {
			"label": "BALANGAN",
			"id": "BLG",
			"kdprop": "KLS"
		}, {
			"label": "MARTAPURA",
			"id": "MTP",
			"kdprop": "KLS"
		}, {
			"label": "HULU SUNGAI TENGAH",
			"id": "HLS",
			"kdprop": "KLS"
		}, {
			"label": "KUTAI BARAT",
			"id": "KUB",
			"kdprop": "KLT"
		}, {
			"label": "BONTANG",
			"id": "BOT",
			"kdprop": "KLT"
		}, {
			"label": "PENAJAM PASER UTARA",
			"id": "PEN",
			"kdprop": "KLT"
		}, {
			"label": "BERAU",
			"id": "BRU",
			"kdprop": "KLT"
		}, {
			"label": "BALIKPAPAN",
			"id": "BPP",
			"kdprop": "KLT"
		}, {
			"label": "TANAH GROGOT",
			"id": "TNG",
			"kdprop": "KLT"
		}, {
			"label": "TANJUNGSELOR",
			"id": "TJS",
			"kdprop": "KLT"
		}, {
			"label": "TANJUNGREDEB",
			"id": "TJR",
			"kdprop": "KLT"
		}, {
			"label": "TENGGARONG",
			"id": "TGO",
			"kdprop": "KLT"
		}, {
			"label": "SAMARINDA",
			"id": "SMR",
			"kdprop": "KLT"
		}, {
			"label": "SENGATA",
			"id": "SGT",
			"kdprop": "KLT"
		}, {
			"label": "HANDIL",
			"id": "HDL",
			"kdprop": "KLT"
		}, {
			"label": "MELAK",
			"id": "MLK",
			"kdprop": "KLT"
		}, {
			"label": "PASER",
			"id": "PRR",
			"kdprop": "KLT"
		}, {
			"label": "KAB. MAHAKAM ULU",
			"id": "KMU",
			"kdprop": "KLT"
		}, {
			"label": "KUTAI TIMUR",
			"id": "KTR",
			"kdprop": "KLT"
		}, {
			"label": "KUTAI KERTANEGARA",
			"id": "KTI",
			"kdprop": "KLT"
		}, {
			"label": "SAMBOJA",
			"id": "SBJ",
			"kdprop": "KLT"
		}, {
			"label": "NUNUKAN",
			"id": "NNK",
			"kdprop": "KLU"
		}, {
			"label": "BULUNGAN",
			"id": "BLN",
			"kdprop": "KLU"
		}, {
			"label": "TANA TIDUNG",
			"id": "TTD",
			"kdprop": "KLU"
		}, {
			"label": "TARAKAN",
			"id": "TRK",
			"kdprop": "KLU"
		}, {
			"label": "MALINAU",
			"id": "MLN",
			"kdprop": "KLU"
		}, {
			"label": "PESAWARAN",
			"id": "PES",
			"kdprop": "LPG"
		}, {
			"label": "MESUJI",
			"id": "MSJ",
			"kdprop": "LPG"
		}, {
			"label": "RAJABASA",
			"id": "RBS",
			"kdprop": "LPG"
		}, {
			"label": "TANJUNGKARANG",
			"id": "TKR",
			"kdprop": "LPG"
		}, {
			"label": "BANDAR JAYA",
			"id": "BDJ",
			"kdprop": "LPG"
		}, {
			"label": "BANDARLAMPUNG",
			"id": "BDL",
			"kdprop": "LPG"
		}, {
			"label": "KOTABUMI",
			"id": "KBM",
			"kdprop": "LPG"
		}, {
			"label": "KALIANDA",
			"id": "KLD",
			"kdprop": "LPG"
		}, {
			"label": "METRO",
			"id": "MET",
			"kdprop": "LPG"
		}, {
			"label": "WAY KANAN",
			"id": "WKN",
			"kdprop": "LPG"
		}, {
			"label": "LAMPUNG TIMUR",
			"id": "LTP",
			"kdprop": "LPG"
		}, {
			"label": "TANGGAMUS",
			"id": "TGM",
			"kdprop": "LPG"
		}, {
			"label": "TULANG BAWANG",
			"id": "TBW",
			"kdprop": "LPG"
		}, {
			"label": "LAMPUNG BARAT",
			"id": "LBR",
			"kdprop": "LPG"
		}, {
			"label": "LAMPUNG TENGAH",
			"id": "LPT",
			"kdprop": "LPG"
		}, {
			"label": "LAMPUNG UTARA",
			"id": "LPU",
			"kdprop": "LPG"
		}, {
			"label": "LAMPUNG SELATAN",
			"id": "LPS",
			"kdprop": "LPG"
		}, {
			"label": "PRINGSEWU",
			"id": "PSW",
			"kdprop": "LPG"
		}, {
			"label": "SERAM BAGIAN TIMUR",
			"id": "SRB",
			"kdprop": "MLK"
		}, {
			"label": "BURU",
			"id": "BR",
			"kdprop": "MLK"
		}, {
			"label": "TIAKUR",
			"id": "TUR",
			"kdprop": "MLK"
		}, {
			"label": "SAUMLAKI",
			"id": "SMK",
			"kdprop": "MLK"
		}, {
			"label": "NAMROLE",
			"id": "NMR",
			"kdprop": "MLK"
		}, {
			"label": "NAMLEA",
			"id": "NML",
			"kdprop": "MLK"
		}, {
			"label": "LANGGUR",
			"id": "LGR",
			"kdprop": "MLK"
		}, {
			"label": "BULA",
			"id": "BLA",
			"kdprop": "MLK"
		}, {
			"label": "DOBO",
			"id": "DBO",
			"kdprop": "MLK"
		}, {
			"label": "KAB. SERAM BAGIAN BARAT",
			"id": "MBB",
			"kdprop": "MLK"
		}, {
			"label": "TUAL",
			"id": "TL",
			"kdprop": "MLK"
		}, {
			"label": "MALUKU TENGAH",
			"id": "MTH",
			"kdprop": "MLK"
		}, {
			"label": "MALUKU TENGGARA",
			"id": "MTT",
			"kdprop": "MLK"
		}, {
			"label": "SOASIU",
			"id": "SSU",
			"kdprop": "MLK"
		}, {
			"label": "MASOHI",
			"id": "MSH",
			"kdprop": "MLK"
		}, {
			"label": "AMBON",
			"id": "AMB",
			"kdprop": "MLK"
		}, {
			"label": "PIRU",
			"id": "PRU",
			"kdprop": "MLK"
		}, {
			"label": "GESER",
			"id": "GSR",
			"kdprop": "MLK"
		}, {
			"label": "KAB. BURU SELATAN",
			"id": "MBS",
			"kdprop": "MLK"
		}, {
			"label": "KAB. KEPULAUAN ARU",
			"id": "MKA",
			"kdprop": "MLK"
		}, {
			"label": "KAB. MALUKU BARAT DAYA",
			"id": "MBD",
			"kdprop": "MLK"
		}, {
			"label": "KAB. MALUKU TENGGARA BARAT",
			"id": "MTB",
			"kdprop": "MLK"
		}, {
			"label": "TIDORE KEPULAUAN",
			"id": "TDK",
			"kdprop": "MLU"
		}, {
			"label": "HALMAHERA BARAT",
			"id": "HLB",
			"kdprop": "MLU"
		}, {
			"label": "HALMAHERA TENGAH",
			"id": "HAL",
			"kdprop": "MLU"
		}, {
			"label": "KOTA TERNATE",
			"id": "KTT",
			"kdprop": "MLU"
		}, {
			"label": "KEPULAUAN SULA",
			"id": "KPS",
			"kdprop": "MLU"
		}, {
			"label": "HALMAHERA UTARA",
			"id": "HLU",
			"kdprop": "MLU"
		}, {
			"label": "HALMAHERA TIMUR",
			"id": "HLT",
			"kdprop": "MLU"
		}, {
			"label": "TERNATE",
			"id": "TNT",
			"kdprop": "MLU"
		}, {
			"label": "MALUKU UTARA",
			"id": "MAL",
			"kdprop": "MLU"
		}, {
			"label": "SELONG",
			"id": "SEL",
			"kdprop": "NTB"
		}, {
			"label": "SUMBAWA",
			"id": "SBB",
			"kdprop": "NTB"
		}, {
			"label": "LOMBOK TENGAH",
			"id": "LOT",
			"kdprop": "NTB"
		}, {
			"label": "PRAYA",
			"id": "PYA",
			"kdprop": "NTB"
		}, {
			"label": "DOMPU",
			"id": "DPU",
			"kdprop": "NTB"
		}, {
			"label": "SUMBAWA BARAT",
			"id": "SBR",
			"kdprop": "NTB"
		}, {
			"label": "KOTA BIMA",
			"id": "KBA",
			"kdprop": "NTB"
		}, {
			"label": "LOMBOK BARAT",
			"id": "LMB",
			"kdprop": "NTB"
		}, {
			"label": "LOMBOK UTARA",
			"id": "LMU",
			"kdprop": "NTB"
		}, {
			"label": "KOTA MATARAM",
			"id": "MTR",
			"kdprop": "NTB"
		}, {
			"label": "LOMBOK TIMUR",
			"id": "LMT",
			"kdprop": "NTB"
		}, {
			"label": "BIMA",
			"id": "BMA",
			"kdprop": "NTB"
		}, {
			"label": "ATAMBUA",
			"id": "ATB",
			"kdprop": "NTT"
		}, {
			"label": "BAJAWA",
			"id": "BJW",
			"kdprop": "NTT"
		}, {
			"label": "ENDE",
			"id": "END",
			"kdprop": "NTT"
		}, {
			"label": "KALABAHI",
			"id": "KBI",
			"kdprop": "NTT"
		}, {
			"label": "KEFAMENANU",
			"id": "KEF",
			"kdprop": "NTT"
		}, {
			"label": "LARANTUKA",
			"id": "LRT",
			"kdprop": "NTT"
		}, {
			"label": "MAUMERE",
			"id": "MME",
			"kdprop": "NTT"
		}, {
			"label": "WAIKABUBAK",
			"id": "WKB",
			"kdprop": "NTT"
		}, {
			"label": "ROTE NDAO",
			"id": "RTD",
			"kdprop": "NTT"
		}, {
			"label": "KUPANG",
			"id": "KPG",
			"kdprop": "NTT"
		}, {
			"label": "SUMBA BARAT DAYA",
			"id": "SBD",
			"kdprop": "NTT"
		}, {
			"label": "MANGGARAI TIMUR",
			"id": "MGE",
			"kdprop": "NTT"
		}, {
			"label": "ALOR",
			"id": "ALR",
			"kdprop": "NTT"
		}, {
			"label": "NGADA",
			"id": "NGD",
			"kdprop": "NTT"
		}, {
			"label": "FLORES TIMUR",
			"id": "FLT",
			"kdprop": "NTT"
		}, {
			"label": "LEMBATA",
			"id": "LTA",
			"kdprop": "NTT"
		}, {
			"label": "BELU",
			"id": "BLU",
			"kdprop": "NTT"
		}, {
			"label": "WAINGAPU",
			"id": "WNP",
			"kdprop": "NTT"
		}, {
			"label": "SOE",
			"id": "SOE",
			"kdprop": "NTT"
		}, {
			"label": "RUTENG",
			"id": "RTG",
			"kdprop": "NTT"
		}, {
			"label": "WEETABULA",
			"id": "WTB",
			"kdprop": "NTT"
		}, {
			"label": "LABUAN BAJO",
			"id": "LBJ",
			"kdprop": "NTT"
		}, {
			"label": "MANGGARAI BARAT",
			"id": "MGB",
			"kdprop": "NTT"
		}, {
			"label": "SIKKA",
			"id": "SIK",
			"kdprop": "NTT"
		}, {
			"label": "KABUPATEN SABU RAIJUA",
			"id": "SBU",
			"kdprop": "NTT"
		}, {
			"label": "NAGEKEO",
			"id": "NGK",
			"kdprop": "NTT"
		}, {
			"label": "SUMBA TENGAH",
			"id": "SBT",
			"kdprop": "NTT"
		}, {
			"label": "ANAKALANG",
			"id": "ANK",
			"kdprop": "NTT"
		}, {
			"label": "KABUPATEN MALAKA",
			"id": "MLA",
			"kdprop": "NTT"
		}, {
			"label": "SEBA",
			"id": "SEB",
			"kdprop": "NTT"
		}, {
			"label": "ROKAN HILIR",
			"id": "RHI",
			"kdprop": "RIA"
		}, {
			"label": "KUANTAN SINGINGI",
			"id": "KUA",
			"kdprop": "RIA"
		}, {
			"label": "PEKANBARU",
			"id": "PKB",
			"kdprop": "RIA"
		}, {
			"label": "DUMAI",
			"id": "DMI",
			"kdprop": "RIA"
		}, {
			"label": "INDRAGIRI HILIR",
			"id": "IHI",
			"kdprop": "RIA"
		}, {
			"label": "BENGKALIS",
			"id": "BKA",
			"kdprop": "RIA"
		}, {
			"label": "INDRAGIRI HULU",
			"id": "IHU",
			"kdprop": "RIA"
		}, {
			"label": "KAMPAR",
			"id": "KPR",
			"kdprop": "RIA"
		}, {
			"label": "ROKAN HULU",
			"id": "RHU",
			"kdprop": "RIA"
		}, {
			"label": "SIAK",
			"id": "SIA",
			"kdprop": "RIA"
		}, {
			"label": "PELALAWAN",
			"id": "PEL",
			"kdprop": "RIA"
		}, {
			"label": "RIAU",
			"id": "RIU",
			"kdprop": "RIA"
		}, {
			"label": "KEPULAUAN MERANTI",
			"id": "KMR",
			"kdprop": "RIA"
		}, {
			"label": "BINTAN",
			"id": "BIT",
			"kdprop": "RIU"
		}, {
			"label": "KEPULAUAN ANAMBAS",
			"id": "KAB",
			"kdprop": "RIU"
		}, {
			"label": "NATUNA",
			"id": "NTN",
			"kdprop": "RIU"
		}, {
			"label": "KEPULAUAN RIAU",
			"id": "KRI",
			"kdprop": "RIU"
		}, {
			"label": "DURI",
			"id": "DRI",
			"kdprop": "RIU"
		}, {
			"label": "PERAWANG",
			"id": "PRW",
			"kdprop": "RIU"
		}, {
			"label": "KARIMUN",
			"id": "KRM",
			"kdprop": "RIU"
		}, {
			"label": "TEMBILAHAN",
			"id": "TBH",
			"kdprop": "RIU"
		}, {
			"label": "TANJUNG BALAI KARIMUN",
			"id": "TBK",
			"kdprop": "RIU"
		}, {
			"label": "TANJUNGPINANG",
			"id": "TPI",
			"kdprop": "RIU"
		}, {
			"label": "BATAM",
			"id": "BTM",
			"kdprop": "RIU"
		}, {
			"label": "BANGKINANG",
			"id": "BKG",
			"kdprop": "RIU"
		}, {
			"label": "LINGGA",
			"id": "LGA",
			"kdprop": "RIU"
		}, {
			"label": "RENGAT",
			"id": "RGT",
			"kdprop": "RIU"
		}, {
			"label": "GORONTALO",
			"id": "GTL",
			"kdprop": "SGR"
		}, {
			"label": "POHUWATO",
			"id": "PHT",
			"kdprop": "SGR"
		}, {
			"label": "BONE BOLANGO",
			"id": "BBL",
			"kdprop": "SGR"
		}, {
			"label": "BOALEMO",
			"id": "BLM",
			"kdprop": "SGR"
		}, {
			"label": "GORONTALO UTARA",
			"id": "GTU",
			"kdprop": "SGR"
		}, {
			"label": "MAMASA",
			"id": "MMS",
			"kdprop": "SLB"
		}, {
			"label": "MAJENE",
			"id": "MJE",
			"kdprop": "SLB"
		}, {
			"label": "MAMUJU",
			"id": "MMJ",
			"kdprop": "SLB"
		}, {
			"label": "MAMUJU UTARA",
			"id": "MAM",
			"kdprop": "SLB"
		}, {
			"label": "POLEWALI MANDAR",
			"id": "PLM",
			"kdprop": "SLB"
		}, {
			"label": "MAMUJU",
			"id": "MAJ",
			"kdprop": "SLB"
		}, {
			"label": "POLMAN",
			"id": "PLN",
			"kdprop": "SLB"
		}, {
			"label": "UNAAHA",
			"id": "UNH",
			"kdprop": "SLG"
		}, {
			"label": "WUNDULAKO",
			"id": "WNL",
			"kdprop": "SLG"
		}, {
			"label": "BUTON UTARA",
			"id": "BNU",
			"kdprop": "SLG"
		}, {
			"label": "EREKE",
			"id": "ERK",
			"kdprop": "SLG"
		}, {
			"label": "WAKATOBI",
			"id": "WKT",
			"kdprop": "SLG"
		}, {
			"label": "KONAWE UTARA",
			"id": "KNU",
			"kdprop": "SLG"
		}, {
			"label": "ASERA",
			"id": "ASR",
			"kdprop": "SLG"
		}, {
			"label": "KONAWE",
			"id": "KNW",
			"kdprop": "SLG"
		}, {
			"label": "MUNA",
			"id": "MUN",
			"kdprop": "SLG"
		}, {
			"label": "ANDOOLO",
			"id": "ADL",
			"kdprop": "SLG"
		}, {
			"label": "BOMBANA",
			"id": "BBN",
			"kdprop": "SLG"
		}, {
			"label": "KOLAKA TIMUR",
			"id": "KKT",
			"kdprop": "SLG"
		}, {
			"label": "KONAWE SELATAN",
			"id": "KNS",
			"kdprop": "SLG"
		}, {
			"label": "KENDARI",
			"id": "KDI",
			"kdprop": "SLG"
		}, {
			"label": "KOLAKA",
			"id": "KKA",
			"kdprop": "SLG"
		}, {
			"label": "BUTON",
			"id": "BTO",
			"kdprop": "SLG"
		}, {
			"label": "BAU-BAU",
			"id": "BAU",
			"kdprop": "SLG"
		}, {
			"label": "WANCI",
			"id": "WCI",
			"kdprop": "SLG"
		}, {
			"label": "RAHA",
			"id": "RHA",
			"kdprop": "SLG"
		}, {
			"label": "KOLAKA UTARA",
			"id": "KKU",
			"kdprop": "SLG"
		}, {
			"label": "KASIPUTE",
			"id": "KSP",
			"kdprop": "SLG"
		}, {
			"label": "SIGI",
			"id": "SIG",
			"kdprop": "SLH"
		}, {
			"label": "BANGGAI LAUT",
			"id": "BGT",
			"kdprop": "SLH"
		}, {
			"label": "LUWUK",
			"id": "LWK",
			"kdprop": "SLH"
		}, {
			"label": "BANGGAI",
			"id": "BGI",
			"kdprop": "SLH"
		}, {
			"label": "BANGGAI KEPULAUAN",
			"id": "BGK",
			"kdprop": "SLH"
		}, {
			"label": "BUOL",
			"id": "BUL",
			"kdprop": "SLH"
		}, {
			"label": "DONGGALA",
			"id": "DON",
			"kdprop": "SLH"
		}, {
			"label": "MOROWALI",
			"id": "MOR",
			"kdprop": "SLH"
		}, {
			"label": "PARIGI MOUTONG",
			"id": "PRM",
			"kdprop": "SLH"
		}, {
			"label": "TOJO UNA-UNA",
			"id": "TUU",
			"kdprop": "SLH"
		}, {
			"label": "MOROWALI UTARA",
			"id": "MRU",
			"kdprop": "SLH"
		}, {
			"label": "MANDULA",
			"id": "MND",
			"kdprop": "SLH"
		}, {
			"label": "POSO",
			"id": "PSO",
			"kdprop": "SLH"
		}, {
			"label": "TOLITOLI",
			"id": "TLT",
			"kdprop": "SLH"
		}, {
			"label": "PALU",
			"id": "PAL",
			"kdprop": "SLH"
		}, {
			"label": "PAREPARE",
			"id": "PRE",
			"kdprop": "SLS"
		}, {
			"label": "MAROS",
			"id": "MRS",
			"kdprop": "SLS"
		}, {
			"label": "LUWU TIMUR",
			"id": "LWT",
			"kdprop": "SLS"
		}, {
			"label": "BELOPA",
			"id": "BLP",
			"kdprop": "SLS"
		}, {
			"label": "LUWU UTARA",
			"id": "LWU",
			"kdprop": "SLS"
		}, {
			"label": "WATANSOPPENG",
			"id": "WSP",
			"kdprop": "SLS"
		}, {
			"label": "WATAMPONE",
			"id": "WPN",
			"kdprop": "SLS"
		}, {
			"label": "UJUNG PANDANG",
			"id": "UJP",
			"kdprop": "SLS"
		}, {
			"label": "TAKALAR",
			"id": "TKL",
			"kdprop": "SLS"
		}, {
			"label": "SOROAKO",
			"id": "SRK",
			"kdprop": "SLS"
		}, {
			"label": "SENGKANG",
			"id": "SKG",
			"kdprop": "SLS"
		}, {
			"label": "SINJAI",
			"id": "SIN",
			"kdprop": "SLS"
		}, {
			"label": "SUNGGUMINASA",
			"id": "SGM",
			"kdprop": "SLS"
		}, {
			"label": "SIDENRENG",
			"id": "SDG",
			"kdprop": "SLS"
		}, {
			"label": "BONE",
			"id": "BON",
			"kdprop": "SLS"
		}, {
			"label": "SELAYAR",
			"id": "SLY",
			"kdprop": "SLS"
		}, {
			"label": "WAJO",
			"id": "WJO",
			"kdprop": "SLS"
		}, {
			"label": "SIWA",
			"id": "SWA",
			"kdprop": "SLS"
		}, {
			"label": "GOWA",
			"id": "GWA",
			"kdprop": "SLS"
		}, {
			"label": "PANGKEP",
			"id": "PAN",
			"kdprop": "SLS"
		}, {
			"label": "BANTAENG",
			"id": "BAN",
			"kdprop": "SLS"
		}, {
			"label": "TANATORAJA",
			"id": "TNR",
			"kdprop": "SLS"
		}, {
			"label": "SIDRAP",
			"id": "SDR",
			"kdprop": "SLS"
		}, {
			"label": "LUWU",
			"id": "LUW",
			"kdprop": "SLS"
		}, {
			"label": "TORAJA UTARA",
			"id": "TNU",
			"kdprop": "SLS"
		}, {
			"label": "PINRANG",
			"id": "PIN",
			"kdprop": "SLS"
		}, {
			"label": "PALOPO",
			"id": "PLP",
			"kdprop": "SLS"
		}, {
			"label": "POLEWALI",
			"id": "PLW",
			"kdprop": "SLS"
		}, {
			"label": "PANAKUKANG",
			"id": "PNK",
			"kdprop": "SLS"
		}, {
			"label": "PINRANG",
			"id": "PNR",
			"kdprop": "SLS"
		}, {
			"label": "MAKASSAR",
			"id": "MKS",
			"kdprop": "SLS"
		}, {
			"label": "BARRU",
			"id": "BAR",
			"kdprop": "SLS"
		}, {
			"label": "BULUKUMBA",
			"id": "BLK",
			"kdprop": "SLS"
		}, {
			"label": "ENREKANG",
			"id": "ENR",
			"kdprop": "SLS"
		}, {
			"label": "JENEPONTO",
			"id": "JNP",
			"kdprop": "SLS"
		}, {
			"label": "MAKALE",
			"id": "MAK",
			"kdprop": "SLS"
		}, {
			"label": "SOPPENG",
			"id": "SPE",
			"kdprop": "SLS"
		}, {
			"label": "TONDANO",
			"id": "TDN",
			"kdprop": "SLU"
		}, {
			"label": "TOMOHON",
			"id": "TMH",
			"kdprop": "SLU"
		}, {
			"label": "MINAHASA INDUK",
			"id": "MDK",
			"kdprop": "SLU"
		}, {
			"label": "SITARO",
			"id": "STO",
			"kdprop": "SLU"
		}, {
			"label": "BITUNG",
			"id": "BTN",
			"kdprop": "SLU"
		}, {
			"label": "MANADO",
			"id": "MDO",
			"kdprop": "SLU"
		}, {
			"label": "TAHUNA",
			"id": "THN",
			"kdprop": "SLU"
		}, {
			"label": "LIMBOTO",
			"id": "LBT",
			"kdprop": "SLU"
		}, {
			"label": "KOTAMOBAGU",
			"id": "KTG",
			"kdprop": "SLU"
		}, {
			"label": "BOLAANG MONGONDOW UTARA",
			"id": "BMT",
			"kdprop": "SLU"
		}, {
			"label": "KEPULAUAN TALAUD",
			"id": "KTA",
			"kdprop": "SLU"
		}, {
			"label": "KEPULAUAN SANGIHE",
			"id": "KSA",
			"kdprop": "SLU"
		}, {
			"label": "MINAHASA SELATAN",
			"id": "MIS",
			"kdprop": "SLU"
		}, {
			"label": "MINAHASA UTARA",
			"id": "MIU",
			"kdprop": "SLU"
		}, {
			"label": "SANGIHE",
			"id": "SAH",
			"kdprop": "SLU"
		}, {
			"label": "BOLAANG MONGONDOW SELATAN",
			"id": "BMS",
			"kdprop": "SLU"
		}, {
			"label": "BOLAANG MONGONDOW",
			"id": "BMD",
			"kdprop": "SLU"
		}, {
			"label": "MINAHASA",
			"id": "MNH",
			"kdprop": "SLU"
		}, {
			"label": "PASAMAN ",
			"id": "PSM",
			"kdprop": "SMB"
		}, {
			"label": "PADANG",
			"id": "PDA",
			"kdprop": "SMB"
		}, {
			"label": "LUBUKSIKAPING",
			"id": "LBS",
			"kdprop": "SMB"
		}, {
			"label": "BATUSANGKAR",
			"id": "BSK",
			"kdprop": "SMB"
		}, {
			"label": "BUKITTINGGI",
			"id": "BKT",
			"kdprop": "SMB"
		}, {
			"label": "PAINAN",
			"id": "PNN",
			"kdprop": "SMB"
		}, {
			"label": "PARIAMAN",
			"id": "PMN",
			"kdprop": "SMB"
		}, {
			"label": "KEPULAUAN MENTAWAI",
			"id": "KMT",
			"kdprop": "SMB"
		}, {
			"label": "KAB. DHARMASRAYA",
			"id": "DMS",
			"kdprop": "SMB"
		}, {
			"label": "PESISIR SELATAN",
			"id": "PSS",
			"kdprop": "SMB"
		}, {
			"label": "KAB. SIJUNJUNG",
			"id": "SJJ",
			"kdprop": "SMB"
		}, {
			"label": "KAB. PADANG PARIAMAN",
			"id": "KPM",
			"kdprop": "SMB"
		}, {
			"label": "PASAMAN BARAT",
			"id": "PSB",
			"kdprop": "SMB"
		}, {
			"label": "KAB.TANAH DATAR",
			"id": "TDT",
			"kdprop": "SMB"
		}, {
			"label": "KAB. LIMA PULUH KOTA",
			"id": "50K",
			"kdprop": "SMB"
		}, {
			"label": "MUARO LABUAH",
			"id": "MLB",
			"kdprop": "SMB"
		}, {
			"label": "AGAM",
			"id": "AGM",
			"kdprop": "SMB"
		}, {
			"label": "SAWAHLUNTO",
			"id": "SWL",
			"kdprop": "SMB"
		}, {
			"label": "SOLOK",
			"id": "SLK",
			"kdprop": "SMB"
		}, {
			"label": "PADANG PANJANG",
			"id": "PPJ",
			"kdprop": "SMB"
		}, {
			"label": "PAYAKUMBUH",
			"id": "PYK",
			"kdprop": "SMB"
		}, {
			"label": "EMPAT LAWANG",
			"id": "EML",
			"kdprop": "SMS"
		}, {
			"label": "OKU TIMUR",
			"id": "OKT",
			"kdprop": "SMS"
		}, {
			"label": "PALEMBANG",
			"id": "PLB",
			"kdprop": "SMS"
		}, {
			"label": "PAGARALAM",
			"id": "PGA",
			"kdprop": "SMS"
		}, {
			"label": "PRABUMULIH",
			"id": "PBM",
			"kdprop": "SMS"
		}, {
			"label": "BATURAJA",
			"id": "BTA",
			"kdprop": "SMS"
		}, {
			"label": "OKU SELATAN",
			"id": "OKS",
			"kdprop": "SMS"
		}, {
			"label": "MUSI BANYU ASIN",
			"id": "MBA",
			"kdprop": "SMS"
		}, {
			"label": "OGAN ILIR",
			"id": "OLI",
			"kdprop": "SMS"
		}, {
			"label": "BANYU ASIN",
			"id": "BAS",
			"kdprop": "SMS"
		}, {
			"label": "OGAN KOMERING ILIR",
			"id": "OKI",
			"kdprop": "SMS"
		}, {
			"label": "PALI",
			"id": "PAI",
			"kdprop": "SMS"
		}, {
			"label": "LUBUKLINGGAU",
			"id": "LLG",
			"kdprop": "SMS"
		}, {
			"label": "SEKAYU",
			"id": "SKY",
			"kdprop": "SMS"
		}, {
			"label": "LAHAT",
			"id": "LHT",
			"kdprop": "SMS"
		}, {
			"label": "MUARAENIM",
			"id": "MEN",
			"kdprop": "SMS"
		}, {
			"label": "OGAN KOMERING ULU",
			"id": "OKU",
			"kdprop": "SMS"
		}, {
			"label": "MUSI RAWAS",
			"id": "MUR",
			"kdprop": "SMS"
		}, {
			"label": "KAYUAGUNG",
			"id": "KAG",
			"kdprop": "SMS"
		}, {
			"label": "HUMBANG HASUNDUTAN",
			"id": "HUM",
			"kdprop": "SMU"
		}, {
			"label": "DOLOK SANGGUL",
			"id": "DLS",
			"kdprop": "SMU"
		}, {
			"label": "BATUBARA",
			"id": "BTB",
			"kdprop": "SMU"
		}, {
			"label": "SERDANG BEDAGAI",
			"id": "SDB",
			"kdprop": "SMU"
		}, {
			"label": "PANYABUNGAN",
			"id": "PYB",
			"kdprop": "SMU"
		}, {
			"label": "TOBA SAMOSIR",
			"id": "BAL",
			"kdprop": "SMU"
		}, {
			"label": "PADANGSIDEMPUAN",
			"id": "PSP",
			"kdprop": "SMU"
		}, {
			"label": "RANTAUPARAPAT",
			"id": "RAP",
			"kdprop": "SMU"
		}, {
			"label": "SIBOLGA",
			"id": "SBG",
			"kdprop": "SMU"
		}, {
			"label": "SIDIKALANG",
			"id": "SDK",
			"kdprop": "SMU"
		}, {
			"label": "SUNGGAL",
			"id": "SGL",
			"kdprop": "SMU"
		}, {
			"label": "STABAT",
			"id": "STB",
			"kdprop": "SMU"
		}, {
			"label": "TEBING TINGGI",
			"id": "TBT",
			"kdprop": "SMU"
		}, {
			"label": "TARUTUNG",
			"id": "TRT",
			"kdprop": "SMU"
		}, {
			"label": "DELI SERDANG",
			"id": "DSG",
			"kdprop": "SMU"
		}, {
			"label": "LANGKAT",
			"id": "LKT",
			"kdprop": "SMU"
		}, {
			"label": "PAKPAK BARAT",
			"id": "PPB",
			"kdprop": "SMU"
		}, {
			"label": "DAIRI",
			"id": "DAI",
			"kdprop": "SMU"
		}, {
			"label": "PANCURBATU",
			"id": "PBT",
			"kdprop": "SMU"
		}, {
			"label": "TAPANULI UTARA",
			"id": "TPU",
			"kdprop": "SMU"
		}, {
			"label": "TOBA SAMOSIR",
			"id": "TBS",
			"kdprop": "SMU"
		}, {
			"label": "SAMOSIR",
			"id": "SN",
			"kdprop": "SMU"
		}, {
			"label": "TAPANULI TENGAH",
			"id": "TP",
			"kdprop": "SMU"
		}, {
			"label": "SIMALUNGUN",
			"id": "SIM",
			"kdprop": "SMU"
		}, {
			"label": "LABUHAN BATU",
			"id": "LAB",
			"kdprop": "SMU"
		}, {
			"label": "TAPANULI SELATAN",
			"id": "TPS",
			"kdprop": "SMU"
		}, {
			"label": "PADANG LAWAS",
			"id": "PLS",
			"kdprop": "SMU"
		}, {
			"label": "PADANG LAWAS UTARA",
			"id": "PLU",
			"kdprop": "SMU"
		}, {
			"label": "MANDAILING NATAL",
			"id": "MNN",
			"kdprop": "SMU"
		}, {
			"label": "NIAS",
			"id": "NIP",
			"kdprop": "SMU"
		}, {
			"label": "NIAS UTARA",
			"id": "NIU",
			"kdprop": "SMU"
		}, {
			"label": "NIAS SELATAN",
			"id": "NIS",
			"kdprop": "SMU"
		}, {
			"label": "NIAS BARAT",
			"id": "NIB",
			"kdprop": "SMU"
		}, {
			"label": "KARO",
			"id": "KAR",
			"kdprop": "SMU"
		}, {
			"label": "PEMATANGSIANTAR",
			"id": "PMS",
			"kdprop": "SMU"
		}, {
			"label": "BINJAI",
			"id": "BJI",
			"kdprop": "SMU"
		}, {
			"label": "BERANDAN",
			"id": "BRD",
			"kdprop": "SMU"
		}, {
			"label": "GUNUNGSITOLI",
			"id": "GST",
			"kdprop": "SMU"
		}, {
			"label": "KABANJAHE",
			"id": "KBJ",
			"kdprop": "SMU"
		}, {
			"label": "KISARAN",
			"id": "KIS",
			"kdprop": "SMU"
		}, {
			"label": "LUBUKPAKAM",
			"id": "LBP",
			"kdprop": "SMU"
		}, {
			"label": "MEDAN",
			"id": "MDN",
			"kdprop": "SMU"
		}, {
			"label": "SIMEULUE",
			"id": "SML",
			"kdprop": "SMU"
		}, {
			"label": "TAKENGON",
			"id": "TKN",
			"kdprop": "SMU"
		}, {
			"label": "LABUHAN BATU SELATAN",
			"id": "LBB",
			"kdprop": "SMU"
		}, {
			"label": "ASAHAN",
			"id": "ASH",
			"kdprop": "SMU"
		}, {
			"label": "DILI",
			"id": "DLI",
			"kdprop": "TMT"
		}];
		var agamas = [{
			'id': '0',
			'label': '--Pilih--'
		}, {
			'id': '1',
			'label': 'ISLAM'
		}, {
			'id': '3',
			'label': 'KRISTEN KATHOLIK'
		}, {
			'id': '2',
			'label': 'KRISTEN PROTESTAN'
		}, {
			'id': '4',
			'label': 'HINDU'
		}, {
			'id': '5',
			'label': 'BUDHA'
		}, {
			'id': '6',
			'label': 'KONGHUTJU'
		}, {
			'id': '7',
			'label': 'ALIRAN KEPERCAYAAN'
		}];
		var genders = [{
			'id': '0',
			'label': '--Pilih--'
		}, {
			'id': 'L',
			'idsent': 'L',
			'label': 'Laki-laki'
		}, {
			'id': 'P',
			'idsent': 'P',
			'label': 'Perempuan'
		}];
		var hobbys = [{
			"id": "",
			"label": "--Pilih--"
		}, {
			"id": "ABS",
			"label": "ANGAKATAN BERSENJATA"
		}, {
			"id": "AKR",
			"label": "AKROBAT"
		}, {
			"id": "ARJ",
			"label": "ARUNG JERAM"
		}, {
			"id": "AUT",
			"label": "AUTOMOTIF"
		}, {
			"id": "BAD",
			"label": "BADMINTON"
		}, {
			"id": "BAS",
			"label": "BASKET"
		}, {
			"id": "BED",
			"label": "BELA DIRI"
		}, {
			"id": "BER",
			"label": "BERENANG"
		}, {
			"id": "BLY",
			"label": "BERLAYAR"
		}, {
			"id": "BMB",
			"label": "BALAP MOBIL"
		}, {
			"id": "BMO",
			"label": "BALAP MOTOR"
		}, {
			"id": "BSE",
			"label": "BALAP SEPEDA"
		}, {
			"id": "CAP",
			"label": "CAVING DAN POTHOLING"
		}, {
			"id": "CLI",
			"label": "MENDAKI/ROCK CLIMBING"
		}, {
			"id": "GAN",
			"label": "GANTOLE"
		}, {
			"id": "GOL",
			"label": "GOLF"
		}, {
			"id": "HOC",
			"label": "HOCKEY"
		}, {
			"id": "JLN",
			"label": "JALAN-JALAN"
		}, {
			"id": "KEL",
			"label": "KELAUTAN"
		}, {
			"id": "KOL",
			"label": "KOLEKSI"
		}, {
			"id": "KSL",
			"label": "KESENIAN LAINNYA"
		}, {
			"id": "LAI",
			"label": "LAIN-LAIN"
		}, {
			"id": "LUK",
			"label": "LUKIS/GAMBAR"
		}, {
			"id": "MAR",
			"label": "MARATON"
		}, {
			"id": "MBC",
			"label": "MEMBACA"
		}, {
			"id": "MCR",
			"label": "MICROLIGHTING"
		}, {
			"id": "MEN",
			"label": "MENARI"
		}, {
			"id": "MGB",
			"label": "MINYAK GAS DAN BUMI"
		}, {
			"id": "NLY",
			"label": "NELAYAN"
		}, {
			"id": "NYA",
			"label": "MENYANYI"
		}, {
			"id": "NYL",
			"label": "MENYELAM"
		}, {
			"id": "OLP",
			"label": "OLAH RAGA PETUALANGAN"
		}, {
			"id": "ORA",
			"label": "OLAHRAGA AIR"
		}, {
			"id": "PAY",
			"label": "TERJUN PAYUNG"
		}, {
			"id": "PIK",
			"label": "PIKNIK"
		}, {
			"id": "PJT",
			"label": "PANJAT TEBING"
		}, {
			"id": "PNB",
			"label": "PENERBANGAN"
		}, {
			"id": "PRL",
			"label": "PARALAYANG"
		}, {
			"id": "PSI",
			"label": "PENCAK SILAT"
		}, {
			"id": "PTB",
			"label": "PERTAMBANGAN"
		}, {
			"id": "SEL",
			"label": "SELANCAR"
		}, {
			"id": "SEP",
			"label": "SEPAK BOLA"
		}, {
			"id": "SKI",
			"label": "SKI AIR"
		}, {
			"id": "TEN",
			"label": "TENIS"
		}, {
			"id": "TER",
			"label": "TERJUN AIR"
		}, {
			"id": "TIN",
			"label": "TINJU"
		}, {
			"id": "VOL",
			"label": "VOLLY"
		}, {
			"id": "otherhobby",
			"label": "LAINNYA"
		}];
		
		var jmlTertanggungTambahans = [ 
			{'id': '0',	'label': 'Tidak Ada'}
			,{	'id': '1',	'label': '1 Orang'}
			, {	'id': '2',	'label': '2 orang'}
			, {	'id': '3',	'label': '3 orang'}
			, {'id': '4','label': '4 orang'	}];
			
		var objToArrays = function (_Object){
			var _Array = new Array();
			for(var name in _Object){
			_Array[name] = _Object[name];
			}
			return _Array;
		}
		
		var objToArray = function (obj) {
			return objToArrays(obj);
		}
		var getPctUnitlinkGuardians = function () {
			return pctUnitlinkGuardians;
		}
		var getJenisJsProteksiKeluargas = function () {
			return jenisJsProteksiKeluargas;
		}
		var getHobbys = function () {
			return hobbys;
		}
		var getjenisFunds = function () {
			return jenisFunds;
		}
		var getRangeGajis = function () {
			return rangeGajis;
		}
		var getHubunganKeluargas = function () {
			return hubungankeluargas;
		}
		var getTipeDokumens = function () {
			return tipedokumens;
		};
		var getBayarBerikutnyas = function () {
			return bayarberikutnyas;
		};
		var getJenisAsuransis = function () {
			return jeniasuransis;
		};
		var getCaraBayars = function () {
			return carabayars;
		};
		var getJenisPerusahaans = function () {
			return jenisperusahaans;
		};
		var getKelasPekerjaans = function () {
			return kelaspekerjaans;
		};
		var getPekerjaans = function () {
			return pekerjaans;
		};
		var getPangkats = function () {
			return pangkats;
		};
		var getStatusNikahs = function () {
			return statusnikahs;
		};
		var getPendidikans = function () {
			return pendidikans;
		};
		var getStatusTempatTinggals = function () {
			return statustinggals;
		};
		var getPovinsis = function () {
			return provinsis;
		};
		var getKabupatens = function () {
			return kabupatens;
		};
		var getGenders = function () {
			return genders;
		};
		var addProduct = function (newObj) {
			productList.push(newObj);
		};
		var getProducts = function () {
			return productList;
		};
		var getAgamas = function () {
			return agamas;
		};
		var getSpajGUID = function () {
			return getSpajGUID();
		};
		var getJmlTertanggungTambahan = function () {
			return jmlTertanggungTambahans;
		};
		return {
			getJmlTertanggungTambahan: getJmlTertanggungTambahan,
			addProduct: addProduct,
			getHobbys: getHobbys,
			getProducts: getProducts,
			getGenders: getGenders,
			getAgamas: getAgamas,
			getProvinsis: getPovinsis,
			getKabupatens: getKabupatens,
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
			getjenisFunds: getjenisFunds,
			getJenisJsProteksiKeluargas: getJenisJsProteksiKeluargas,
			getPctUnitlinkGuardians: getPctUnitlinkGuardians,
			toArray: objToArray,
		};
	}
]).service('BlankService', [
	function () {}
]);