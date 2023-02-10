<?php 
header("content-type: application/x-javascript"); 
include('../oci.helper.php');
$db = new OracleConnection($oracle_config);
?>
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
			return false;
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
			}/* , {
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
			}*/,  {
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
			}/* , {
				'id': 'W',
				'label': 'SAUDARA PEREMPUAN'
			}, {
				'id': 'L',
				'label': 'SAUDARA LAKI-LAKI'
			} */, {
				'id': 'B',
				'label': 'KAKAK KANDUNG'
			}, {
				'id': 'C',
				'label': 'ADIK KANDUNG'
			}/* , {
				'id': 'X',
				'label': 'DUMMY'
			} */, {
				'id': 'D',
				'label': 'ANAK ANGKAT'
			}/* , {
				'id': 'E',
				'label': 'ADIK IPAR'
			}, {
				'id': 'F',
				'label': 'BIBI'
			} */, {
				'id': 'G',
				'label': 'CUCU'
			}/* , {
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
			} */, {
				'id': 'Q',
				'label': 'ORANG TUA ANGKAT'
			}/* , {
				'id': 'R',
				'label': 'PAMAN'
			} */, {
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
			}/* , {
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
			} */, {
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
			}/* , {
				'id': 'TI',
				'label': 'TERTANGGUNG ISTRI'
			}, {
				'id': 'TS',
				'label': 'TERTANGGUNG SUAMI'
			} */, {
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
		, {"id": "JSDMPPN","label": "JS DMP (2019)","gruprider": "3","ctrl_pdf": "jsdmpplus"}
		, {"id": "JSDMPPNK","label": "JS DANA MULTI PROTEKSI PLUS","gruprider": "3","ctrl_pdf": "jsdmpplus"} 
		, {"id": "AJSAN","label": "ASURANSI JS ANUITAS","gruprider": "3","ctrl_pdf": "ajsan"} 
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
		}
		];
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
			"label": "Kawin"
		}, {
			"id": "J",
			"label": "Janda"
		}, {
			"id": "D",
			"label": "Duda"
		}/* , {
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
		} */
		];
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
		
		
	<?php $sql=" select KDPROPINSI, upper(NAMAPROVINSI)NAMAPROVINSI, KDPROVINSI from VW_PROPINSI_JAIM order by namapropinsi asc ";
			$dt = null;
			$dt = $db->query_array($sql); 
			$dx = false;
			$dx[] = array(
				'id'	=>'0'
				,'label'=>'-- pilih --'
				,'kdprop'=>'0'
			);
			if(count($dt) > 0){
				foreach($dt as $dy=>$it){
					$dx[] = array(
						'id'	=> $it['KDPROPINSI']
						,'label'=> $it['NAMAPROVINSI']
						,'id_jaim'=> $it['KDPROVINSI']
					);
				}
			}
?>

		var provinsis = <?=json_encode($dx)?>;

		<?php $sql="select KDKOTAMADYA, NAMAKOTAMADYA, KDPROPINSI from TABEL_109_KOTAMADYA order by NAMAKOTAMADYA asc";
			$dt = $db->query_array($sql); 
			$dx = false;
			$dx[] = array(
				'id'	=>'0'
				,'label'=>'-- pilih --'
				,'kdprop'=>'0'
			);
			if(count($dt) > 0){
				foreach($dt as $dy=>$it){
					$dx[] = array(
						'id'	=> $it['KDKOTAMADYA']
						,'label'=> $it['NAMAKOTAMADYA']
						,'kdprop'=> $it['KDPROPINSI']
					);
				}
			}
			?>
		
		var kabupatens = <?=json_encode($dx)?>;
		
		<?php $sql="select KDAGAMA, NAMAAGAMA from TABEL_102_AGAMA order by KDAGAMA asc";
			$dt = $db->query_array($sql); 
			$dx = false;
			$dx[] = array(
				'id'	=>'0'
				,'label'=>'-- pilih --'
			);
			if(count($dt) > 0){
				foreach($dt as $dy=>$it){
					$dx[] = array(
						'id'	=> $it['KDAGAMA']
						,'label'=> $it['NAMAAGAMA']
					);
				}
			}?>
		
		var agamas = <?=json_encode($dx)?>;
		
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
		
		<?php $sql="select KDHOBBY, NAMAHOBBY from TABEL_114_HOBBY order by NAMAHOBBY asc";
			$dt = $db->query_array($sql); 
			$dx = false;
			$dx[] = array(
				'id'	=>''
				,'label'=>'-- pilih --'
			);
			if(count($dt) > 0){
				foreach($dt as $dy=>$it){
					$dx[] = array(
						'id'	=> $it['KDHOBBY']
						,'label'=> $it['NAMAHOBBY']
					);
				}
			}?>
		
		var hobbys = <?=json_encode($dx)?>;
		
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