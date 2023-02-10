angular.module('app.services', []).factory('simpleFormValidatorByType', [
    function() {
        var strTest = '';
        var status = false;
        var tryRegex = function(typeToTry, data, regexString) {
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
]).factory("$store", function($parse) {
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
        set: function(key, value) {
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
        get: function(key) {
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
        remove: function(key) {
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
        bind: function($scope, key, def) {
            def = def || '';
            if (!publicMethods.get(key)) {
                publicMethods.set(key, def);
            }
            $parse(key).assign($scope, publicMethods.get(key));
            $scope.$watch(key, function(val) {
                publicMethods.set(key, val);
            }, true);
            return publicMethods.get(key);
        }
    };
    return publicMethods;
}).factory('syncService', [

    function($interval) {
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
                clockTimer = $interval(function() {
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
    function() {
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
        var init_ttd = function(canvasId) {
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
        var takePictOf = function(inputElement, canvasId) {
            if (inputElement.files && inputElement.files[0]) {
                mimeImgUpload = inputElement.files[0].type;
                var reader = new FileReader();
                var blob = null;
                reader.onload = function(e) {
                    putImageToCanvas(e.target.result, canvasId);
                    blob += e.target.result;
                }
                reader.readAsDataURL(inputElement.files[0]);
            }
        }
        var getBinImage = function(canvasId, cnvType) {
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
            encode: function(str) {
                try {
                    str = btoa(str);
                } catch (e) {
                    str = btoa(baseIcon);
                }
                return str;
            },
            decode: function(str) {
                try {
                    str = atob(str);
                } catch (e) {
                    str = atob(baseIcon);
                }
                return str;
            }
        }
        var putImageDataToCanvas = function(canvasId, pictData) {
			var myWidth = 1280;
			var meCanvas = document.getElementById(canvasId);
			var i = new Image(); 
			i.crossOrigin = 'Anonymous';
			i.onload = function(){
				meCanvas.width = myWidth;
				meCanvas.height = myWidth * i.height / i.width;
				meCanvas.style.width = '500px';
				var ctxS = meCanvas.getContext("2d");
				ctxS.drawImage(i, 0, 0, meCanvas.width, meCanvas.height);
			};
			i.src = pictData;
        }
        var putImageToCanvas = function(pict, cnv) {
            var canvas = document.getElementById(cnv);
            canvas.width = 1280;
            canvas.height = 1280 * canvas.height / canvas.width;
            canvas.style.width = '500px';
            var ctx = canvas.getContext("2d");
            img = new Image();
            img.onload = function() {
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
        var genSpajGUID = function() {
            function S4() {
                return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
            }
            return (S4() + S4() + "-" + S4() + "-4" + S4().substr(0, 3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();
        }
        var setSpajElement = function(newObj) {
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
        var getSpajElement = function(pageId) {
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
        var getSpajGUID = function() {
            return storage.getItem('_CURRENT_SPAJ_GUID::');
        }
        var setSpajGUID = function(guid) {
            this.setUnsavedSpajGuid(guid);
            return storage.setItem("_CURRENT_SPAJ_GUID::", guid);
        }
        var getBuildId = function() {
            return storage.getItem('_CURRENT_SPAJ_BUILD::');
        }
        var setBuildId = function(guid) {
            this.setUnsavedSpajGuid(guid);
            return storage.setItem("_CURRENT_SPAJ_BUILD::", guid);
        }
        var addPenerimaManfaat = function(guid, pageId, dataNew) {
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
        var removePenerimaManfaat = function(guid, pageId, idxItem) {
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
        var updatePenerimaManfaat = function(guid, pageId, idxItem, dataNew) {
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
        var getPenerimaManfaat = function(guid, pageId, idxItem) {
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
        var getDokumen = function(guid, pageId, idxItem) {
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
        var addDokumen = function(guid, pageId, dataNew) {
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
        var delDokumen = function(guid, pageId, idxItem) {
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
        var updateDokumen = function(guid, pageId, idxItem, dataNew) {
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
        var getUnsavedSpajGuid = function() {
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
						detproduk = JSON.parse(storage.getItem('SPAJ::'+ret[i].spaj_guid+'::aplikasiSPAJOnline.produkDanManfaat12'));
						
						if (!detproduk) {
							detproduk = {'namaProduk':'-','premi':'-'}; 
						}
						
                        if (dets.idagen == getQueryParam('idagen')) {
                            rets.push({
                                'spaj_guid': dets.spaj_guid,
                                'namaLengkapTertanggung': dets.namaLengkapTertanggung,
                                'nomorKTPTertanggung': dets.nomorKTPTertanggung,
                                'build_id': dets.build_id,
								'namaProduk': detproduk.namaProduk,
								'premi': detproduk.premi,
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
        var setUnsavedSpajGuid = function(spaj_guid) {
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
        var delUnsavedSpajGuid = function(spaj_guid) {
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

        var setProspekListData = function(idagen, prospekData) {
            return storage.setItem("_PROSPEKDATA_LOCAL::" + idagen + "", angular.toJson(prospekData));
        }
        var getProspekListData = function(idagen) {
            var dt = storage.getItem('_PROSPEKDATA_LOCAL::' + idagen + "");
            return JSON.parse(dt);
        }

        var setProspekData = function(prospekData) {
            return storage.setItem("_SELECTED_PROSPEKDATA::", prospekData);
        }
        var getProspekData = function() {
            return storage.getItem('_SELECTED_PROSPEKDATA::');
        }
        var isInternetAvailable = function() {
            return storage.getItem('_HAS_INTERNET::');
        }
        var setInternetAvailability = function(status) {
            return storage.setItem('_HAS_INTERNET::', status);
        }

        var tabDisable = function(tabName) {
            element = document.getElementById(tabName);
            element.className = element
                .className
                .split(' ')
                .filter(function(name) {
                    return name !== 'disabledTab';
                })
                .concat('disabledTab')
                .join(' ');
            console.log(element.className)
        }
        var tabEnable = function(tabName) {
            element = document.getElementById(tabName);
            element.className = element
                .className
                .split(' ')
                .filter(function(name) {
                    return name !== 'disabledTab';
                })
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
            tabEnable: tabEnable,
            tabDisable: tabDisable,
        }
    }
]).factory('dataFactory', [
    function() {
        var jenisFunds = [{
            'id': '0',
            'label': '--Pilih--'
        }, {
            'id': '1',
            'label': 'IFG LINK PASAR UANG'
        }, {
            'id': '2',
            'label': 'IFG LINK PENDAPATAN TETAP'
        }, {
            'id': '3',
            'label': 'IFG LINK BERIMBANG'
        }, {
            'id': '4',
            'label': 'IFG LINK EKUITAS'
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
		var alasanWajibPajakLuarNegeris = [{
				'id': '0',
				'label': '--Pilih--'
			},
			{
				'id': 'TIDAK_TERBIT',
				'label': 'Negara tidak menerbitkan TIN'
			},
			{
				'id': 'TIDAK_DAPAT',
				'label': 'Pemegang Polis tidak bisa mendapatkan TIN'
			},
			{
				'id': 'TIDAK_WAJIB',
				'label': 'Negara yang bersangkutan tidak mewajibkan TIN untuk keperluan CRS'
			},
		];
		var hubungandenganpempols = [{
				'id': 'A',
				'label': 'Ayah'
			},
			{
				'id': 'U',
				'label': 'Ibu'
			},
			{
				'id': '1',
				'label': 'Anak'
			},
			{
				'id': 'I',
				'label': 'Istri'
			},
			{
				'id': 'S',
				'label': 'Suami'
			},
			{
				'id': '04',
				'label': 'Diri Sendiri'
			},
		];
		var jenisPenghasilan = [{
            'id': '0',
            'label': '--Pilih Jenis Pendapatan--'
        },{
            'id' : '1',
            'label': 'Gaji'
        },{
            'id' : '2',
            'label' : 'Penghasilan suami/Istri'
        },{
            'id' : '3',
            'label' : 'Hasil Investasi'
        },{
            'id' : '4',
            'label' : 'Bisnis Pribadi'
        },{
            'id' : '5',
            'label' : 'Bonus/Insetif/Komisi'
        },{
            'id' : '6',
            'label' : 'Penghasilan Orang Tua'
        },{
            'id' : '7',
            'label' : 'Pendapatan Lainnya'
        }];
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
            }
            /* , {
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
            			}*/
            , {
                'id': '1T',
                'label': 'ANAK TIRI'
            }, 
			// {
            //     'id': '2T',
            //     'label': 'ANAK TIRI YG DIBEASISWAKAN'
            // }, 
			{
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
            }, 
			// {
            //     'id': 'P',
            //     'label': 'KARYAWAN'
            // }
            /* , {
            				'id': 'W',
            				'label': 'SAUDARA PEREMPUAN'
            			}, {
            				'id': 'L',
            				'label': 'SAUDARA LAKI-LAKI'
            			} */
            {
                'id': 'B',
                'label': 'KAKAK KANDUNG'
            }, {
                'id': 'C',
                'label': 'ADIK KANDUNG'
            }
            /* , {
            				'id': 'X',
            				'label': 'DUMMY'
            			} */
            , {
                'id': 'D',
                'label': 'ANAK ANGKAT'
            }
            /* , {
            				'id': 'E',
            				'label': 'ADIK IPAR'
            			}, {
            				'id': 'F',
            				'label': 'BIBI'
            			} */
            , {
                'id': 'G',
                'label': 'CUCU'
            }
            /* , {
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
            			} */
            , {
                'id': 'Q',
                'label': 'ORANG TUA ANGKAT'
            }
            , 
			/*{
            				'id': 'R',
            				'label': 'PAMAN'
            			} 
            , */
			// {
            //     'id': 'T',
            //     'label': 'SAUDARA ANGKAT'
            // }, 
			{
                'id': '04',
                'label': 'DIRI TERTANGGUNG'
            }, 
			// {
            //     'id': 'G2',
            //     'label': 'CUCU YANG DIBEASISWAKAN'
            // }, 
			// {
            //     'id': 'K2',
            //     'label': 'KEPONAKAN YANG DIBEASISWAKAN'
            // }, 
			{
                'id': 'K1',
                'label': 'KEPONAKAN'
            }
            ,/* {
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
            			} */
            // , {
            //     'id': 'O2',
            //     'label': 'PEMEGANG POLIS'
            // }, 
			
			// {
            //     'id': 'A2',
            //     'label': 'ANAK YG DIBEASISWAKAN'
            // }, 
			// {
            //     'id': 'PP',
            //     'label': 'PEMILIK PERUSAHAAN'
            // }, 
			{
                'id': 'PM',
                'label': 'PIMPINAN PERUSAHAAN'
            }, {
                'id': 'UT',
                'label': 'IBU TIRI'
            }
            /* , {
            				'id': 'TI',
            				'label': 'TERTANGGUNG ISTRI'
            			}, {
            				'id': 'TS',
            				'label': 'TERTANGGUNG SUAMI'
            			} 
            , {
                'id': 'ZZ',
                'label': 'UNDEFINED'
            } */
        ];
        var tipedokumens = [
			{
				"id": "0",
				"id_sae": "0",
				"label": "--Pilih--"
			},
			{
				"id": "30",
				"id_sae": "KTP",
				"label": "KTP"
			},
			{
				"id": "9",
				"id_sae": "KK",
				"label": "KARTU KELUARGA"
			},
			{
				"id": "31",
				"id_sae": "AKTE BUKU NIKAH",
				"label": "AKTE NIKAH/ BUKU NIKAH"
			},
			{
				"id": "2",
				"id_sae": "AKTE LAHIR ANAK",
				"label": "AKTE KEL. ANAK"
			},
			{
				"id": "31",
				"id_sae": "SPESIMEN TTD",
				"label": "SPESIMEN TTD"
			},
			{
				"id": "32",
				"id_sae": "LAIN LAIN",
				"label": "FINANCIAL STATEMENT"
			},
			{
				"id": "33",
				"id_sae": "LAIN LAIN",
				"label": "ATTENDANCE PHYSICIANS STATEMENT (APS)"
			},
			{
				"id": "34",
				"id_sae": "LAIN LAIN",
				"label": "ATTENDANCE PHYSICIANS STATEMENT (APS) ANAK"
			},
			{
				"id": "34",
				"id_sae": "LAIN LAIN",
				"label": "KUESIONER KESEHATAN"
			},
			{
				"id": "34",
				"id_sae": "LAIN LAIN",
				"label": "KUESIONER PEKERJAAN"
			},
			{
				"id": "34",
				"id_sae": "LAIN LAIN",
				"label": "LEMBER PEMERIKSAAN KESEHATAN (LPK)"
			},
			{
				"id": "34",
				"id_sae": "LAIN LAIN",
				"label": "HASIL REKAM MEDIS"
			},
			{
				"id": "1",
				"id_sae": "LAIN LAIN",
				"label": "LAIN-LAIN"
			},
			/*{
				"id": "3",
				"id_sae": "BUKTI ENTRY PREMI I",
				"label": "BATCH"
			},
			{
				"id": "4",
				"id_sae": "BK",
				"label": "BERITA KEPUTUSAN"
			},
			{
				"id": "5",
				"id_sae": "BP3",
				"label": "BP3/ BPPS DAN ID"
			},
			{
				"id": "6",
				"id_sae": "BUKTI TRANSFER",
				"label": "BUKTI TRANSFER"
			},
			{
				"id": "7",
				"id_sae": "CP",
				"label": "CASHPLAN"
			},
			{
				"id": "8",
				"id_sae": "HASIL LABORATORIUM",
				"label": "HASIL PERIKSA LAB  MED"
			},
			{
				"id": "10",
				"id_sae": "KMS",
				"label": "KMS ANAK"
			},
			{
				"id": "11",
				"id_sae": "POLIS DUPLIKAT",
				"label": "KUMP DOC DUPLIKAT POLIS"
			},
			{
				"id": "12",
				"id_sae": "EXPIRASI",
				"label": "KUMP DOC EXPIRASI (JATUH TEMPO)"
			},
			{
				"id": "13",
				"id_sae": "BS BERKALA",
				"label": "KUMP DOC PEMB BS, ANUITAS BERKALA"
			},
			{
				"id": "14",
				"id_sae": "PEMULIHAN POLIS",
				"label": "KUMP DOC PEMULIHAN POLIS"
			},
			{
				"id": "15",
				"id_sae": "PERUBAHAN AHLI WARIS",
				"label": "KUMP DOC UBAH AHLI WARIS"
			},
			{
				"id": "16",
				"id_sae": "PERUBAHAN ALAMAT",
				"label": "KUMP. DOC UBAH  ALAMAT"
			},
			{
				"id": "17",
				"id_sae": "TEBUS",
				"label": "KUMPULAN DOC TEBUS"
			},
			{
				"id": "18",
				"id_sae": "KONVERSI",
				"label": "KUMPULAN DOC. KONVERSI"
			},
			{
				"id": "19",
				"id_sae": "TAHAPAN",
				"label": "KUMPULAN DOC. TAHAPAN"
			},
			{
				"id": "20",
				"id_sae": "GADAI",
				"label": "KUMPULAN DOKUMEN GADAI POLIS"
			},
			{
				"id": "21",
				"id_sae": "KLAIM",
				"label": "KUMPULAN DOKUMEN KLAIM MENINGGAL"
			},
			{
				"id": "22",
				"id_sae": "LAMPIRAN POLIS",
				"label": "LAMPIRAN POLIS"
			},
			{
				"id": "23",
				"id_sae": "LPK",
				"label": "LAP. PERIKSA KESEHATAN MEDICAL"
			},
			{
				"id": "24",
				"id_sae": "DESISI",
				"label": "NOTA DESISI  SPAJ  HO"
			},
			{
				"id": "25",
				"id_sae": "PROPOSAL SPAJ",
				"label": "PROPOSAL"
			},
			{
				"id": "26",
				"id_sae": "SKK ANAK",
				"label": "SKK ANAK KHUSUS JS  PRESTASI/SMART"
			},
			{
				"id": "27",
				"id_sae": "SPAJ",
				"label": "SPAJ/SKK"
			},
			{
				"id": "28",
				"id_sae": "SURAT KUASA",
				"label": "SURAT KUASA"
			},
			{
				"id": "29",
				"id_sae": "TANDA TERIMA POLIS",
				"label": "TANDA TERIMA POLIS"
			}*/
		];
        var bayarberikutnyas = [{
            "id": "0",
            "label": "--Pilih--"
        }, {
            "id": "autodebet",
            "label": "Auto Debet"
        }, {
            "id": "host2host",
            "label": "Host to Host"
        }, {
            "id": "virtualaccount",
            "label": "Virtual Account"
        }, {
            "id": "ccdebet",
            "label": "Credit Card"
        }];
        var jeniasuransis = [{
            "id": "0",
            "label": "--Pilih--",
            "gruprider": 0
        }, {
			"id": "APPSH",
            "label": "IFG Life Anuitas (SH)",
            "gruprider": 0,
            "ctrl_pdf": "jspromapannew"
        },{
            "id": "APP85",
            "label": "IFG Life Anuitas (85)",
            "gruprider": 0,
            "ctrl_pdf": "jspromapannew"
        },{
            "id": "APP75",
            "label": "IFG Life Anuitas (75)",
            "gruprider": 0,
            "ctrl_pdf": "jspromapannew"
        },{
            "id": "APP65",
            "label": "IFG Life Anuitas (65)",
            "gruprider": 0,
            "ctrl_pdf": "jspromapannew"
        },{
            "id": "JL4BLN",
            "label": "IFG Life Prime Protection",
            "gruprider": "3",
            "ctrl_pdf": "jspromapannew"
        }, {
            "id": "JL4XN",
            "label": "IFG Ultimate Protection",
            "gruprider": "3",
            "ctrl_pdf": "jsproidaman"
        }, {
			"id": "PAA",
			"label": "IFG Personal Accident Plan A",
			"gruprider": "3",
			"ctrl_pdf": "personalaccident"
		}, {
			"id": "PAB",
			"label": "IFG Personal Accident Plan B",
			"gruprider": "3",
			"ctrl_pdf": "personalaccident"
		}
         // {
        //     "id": "JSPNNN",
        //     "label": "JS PRESTASI",
        //     "gruprider": "3",
        //     "ctrl_pdf": "prestasi"
        // }, {
        //     "id": "JSSPOA",
        //     "label": "JS OPTIMA ASSURANCE",
        //     "gruprider": "3",
        //     "ctrl_pdf": "optima7"
        // }, {
        //     "id": "JSDMPPN",
        //     "label": "JS DMP (2019)",
        //     "gruprider": "3",
        //     "ctrl_pdf": "jsdmpplus"
        // }, {
        //     "id": "JSDMPPNK",
        //     "label": "JS DANA MULTI PROTEKSI PLUS",
        //     "gruprider": "3",
        //     "ctrl_pdf": "jsdmpplus"
        // }, 
        // {
        //     "id": "AJSAN",
        //     "label": "ASURANSI JS ANUITAS",
        //     "gruprider": "3",
        //     "ctrl_pdf": "ajsan"
        // }, 
        // {
        //     "id": "JL4BLN_",
        //     "label": "-",
        //     "gruprider": "3",
        //     "ctrl_pdf": "jspromapannew"
        // }, 
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
        // var carabayars = [{
        //     "id": "0",
        //     "label": "--Pilih--",
        //     "kdproduk": "0"
        // }, {
        //     "id": "A",
        //     "label": "TAHUNAN",
        //     "kdproduk": "JL4BG"
        // }, {
        //     "id": "H",
        //     "label": "SEMESTERAN",
        //     "kdproduk": "JL4BG"
        // }, {
        //     "id": "M",
        //     "label": "BULANAN",
        //     "kdproduk": "JL4BG"
        // }, {
        //     "id": "Q",
        //     "label": "KUARTALAN",
        //     "kdproduk": "JL4BG"
        // }, {
        //     "id": "X",
        //     "label": "SEKALIGUS",
        //     "kdproduk": "JL4XN"
        // }, {
        //     "id": "X",
        //     "label": "SEKALIGUS",
        //     "kdproduk": "JSSPOA"
        // }, {
        //     "id": "A",
        //     "label": "TAHUNAN",
        //     "kdproduk": "JL4BLN"
        // }, {
        //     "id": "M",
        //     "label": "BULANAN",
        //     "kdproduk": "JL4BLN"
        // }, {
        //     "id": "A",
        //     "label": "TAHUNAN",
        //     "kdproduk": "JL4BLN_"
        // }, {
        //     "id": "M",
        //     "label": "BULANAN",
        //     "kdproduk": "JL4BLN_"
        // }, {
        //     "id": "1",
        //     "label": "BULANAN",
        //     "kdproduk": "JSDMPPN"
        // }, {
        //     "id": "2",
        //     "label": "KUARTALAN",
        //     "kdproduk": "JSDMPPN"
        // }, {
        //     "id": "3",
        //     "label": "SEMESTERAN",
        //     "kdproduk": "JSDMPPN"
        // }, {
        //     "id": "4",
        //     "label": "TAHUNAN",
        //     "kdproduk": "JSDMPPN"
        // }, {
        //     "id": "1",
        //     "label": "BULANAN",
        //     "kdproduk": "JSDMPPNK"
        // }, {
        //     "id": "1",
        //     "label": "BULANAN",
        //     "kdproduk": "JSPNNN"
        // }, {
        //     "id": "2",
        //     "label": "KUARTALAN",
        //     "kdproduk": "JSPNNN"
        // }, {
        //     "id": "3",
        //     "label": "SEMESTERAN",
        //     "kdproduk": "JSPNNN"
        // }, {
        //     "id": "4",
        //     "label": "TAHUNAN",
        //     "kdproduk": "JSPNNN"
        // }, ];

		/** Perubahan Baru */
		var carabayars = [{
            "id": "0",
            "label": "--Pilih--",
            "kdproduk": "0"
        }, {
            "id": "A",
            "label": "TAHUNAN",
            "kdproduk": "JL4BG"
        }, {
            "id": "H",
            "label": "SEMESTERAN",
            "kdproduk": "JL4BG"
        }, {
            "id": "M",
            "label": "BULANAN",
            "kdproduk": "JL4BG"
        }, {
            "id": "Q",
            "label": "KUARTALAN",
            "kdproduk": "JL4BG"
        }, {
            "id": "X",
            "label": "SEKALIGUS",
            "kdproduk": "JL4XN"
        }, {
            "id": "A",
            "label": "TAHUNAN",
            "kdproduk": "JL4BLN"
        }, {
            "id": "M",
            "label": "BULANAN",
            "kdproduk": "JL4BLN"
        }, {
            "id": "K",
            "label": "KUARTALAN",
            "kdproduk": "JL4BLN"
        },{
            "id": "Q",
            "label": "KUARTALAN",
            "kdproduk": "JL4BLN"
        },{
            "id": "H",
            "label": "SEMESTERAN",
            "kdproduk": "JL4BLN"
        }, {
            "id": "1",
            "label": "BULANAN",
            "kdproduk": "JL4BLN"
        }, {
            "id": "4",
            "label": "TAHUNAN",
            "kdproduk": "JL4BLN"
        }, {
            "id": "2",
            "label": "KUARTALAN",
            "kdproduk": "JL4BLN"
        },{
            "id": "3",
            "label": "SEMESTERAN",
            "kdproduk": "JL4BLN"
        },{
            "id": "A",
            "label": "TAHUNAN",
            "kdproduk": "JL4BLN_"
        }, {
            "id": "M",
            "label": "BULANAN",
            "kdproduk": "JL4BLN_"
        },];

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
        var pekerjaans = [
			{
				"id": "1",
				"label": "Admin Keuangan",
				"kelas": "X"
			},
			{
				"id": "2",
				"label": "Administrasi & Manajer",
				"kelas": "X"
			},
			{
				"id": "3",
				"label": "Agen Asuransi",
				"kelas": "X"
			},
			{
				"id": "4",
				"label": "Agen Koran",
				"kelas": "X"
			},
			{
				"id": "5",
				"label": "Agen Properti",
				"kelas": "X"
			},
			{
				"id": "6",
				"label": "Ahli Geologi (Bertugas di Kantor Atau Tidak di Tempat Berbahaya)",
				"kelas": "X"
			},
			{
				"id": "7",
				"label": "Ahli Kaligrafi",
				"kelas": "X"
			},
			{
				"id": "8",
				"label": "Ahli Kecantikan",
				"kelas": "X"
			},
			{
				"id": "9",
				"label": "Ahli Kimia (Pengawas)",
				"kelas": "X"
			},
			{
				"id": "10",
				"label": "Ahli Obat Bius",
				"kelas": "X"
			},
			{
				"id": "11",
				"label": "Ahli Pembuat Tato",
				"kelas": "X"
			},
			{
				"id": "12",
				"label": "Ahli Perbaikan Sepatu",
				"kelas": "X"
			},
			{
				"id": "13",
				"label": "Ahli Psioterapi",
				"kelas": "X"
			},
			{
				"id": "14",
				"label": "Aktor",
				"kelas": "X"
			},
			{
				"id": "15",
				"label": "Aktris",
				"kelas": "X"
			},
			{
				"id": "16",
				"label": "Aktuaris",
				"kelas": "X"
			},
			{
				"id": "17",
				"label": "Akuntan",
				"kelas": "X"
			},
			{
				"id": "18",
				"label": "Analis Sistem",
				"kelas": "X"
			},
			{
				"id": "19",
				"label": "Arsitek",
				"kelas": "X"
			},
			{
				"id": "20",
				"label": "Asisten Coffee Shop",
				"kelas": "X"
			},
			{
				"id": "21",
				"label": "Asisten Dokter Hewan",
				"kelas": "X"
			},
			{
				"id": "22",
				"label": "Asisten Hukum",
				"kelas": "X"
			},
			{
				"id": "23",
				"label": "Asisten Laboratorium",
				"kelas": "X"
			},
			{
				"id": "24",
				"label": "Asisten Pengadilan",
				"kelas": "X"
			},
			{
				"id": "25",
				"label": "Asisten Pribadi",
				"kelas": "X"
			},
			{
				"id": "26",
				"label": "Asisten Toko",
				"kelas": "X"
			},
			{
				"id": "27",
				"label": "Atlet",
				"kelas": "X"
			},
			{
				"id": "28",
				"label": "Baby Sitter",
				"kelas": "X"
			},
			{
				"id": "29",
				"label": "Bankir",
				"kelas": "X"
			},
			{
				"id": "30",
				"label": "Bartender",
				"kelas": "X"
			},
			{
				"id": "31",
				"label": "Bartender Kapal Laut",
				"kelas": "X"
			},
			{
				"id": "32",
				"label": "Biarawati",
				"kelas": "X"
			},
			{
				"id": "33",
				"label": "Bidan",
				"kelas": "X"
			},
			{
				"id": "34",
				"label": "Biksu",
				"kelas": "X"
			},
			{
				"id": "35",
				"label": "Broker / Pialang",
				"kelas": "X"
			},
			{
				"id": "36",
				"label": "Broker Saham",
				"kelas": "X"
			},
			{
				"id": "37",
				"label": "Buruh Harian Lepas",
				"kelas": "X"
			},
			{
				"id": "38",
				"label": "Buruh Produksi",
				"kelas": "X"
			},
			{
				"id": "39",
				"label": "Buruh Tekstil",
				"kelas": "X"
			},
			{
				"id": "40",
				"label": "Ceo",
				"kelas": "X"
			},
			{
				"id": "41",
				"label": "Dealer (Karyawan)",
				"kelas": "X"
			},
			{
				"id": "42",
				"label": "Dekorator",
				"kelas": "X"
			},
			{
				"id": "43",
				"label": "Dekorator Papan Periklanan (Dalam Ruangan)",
				"kelas": "X"
			},
			{
				"id": "44",
				"label": "Dekorator Papan Periklanan (Luar Ruangan)",
				"kelas": "X"
			},
			{
				"id": "45",
				"label": "Dekorator Ruangan",
				"kelas": "X"
			},
			{
				"id": "46",
				"label": "Designer",
				"kelas": "X"
			},
			{
				"id": "47",
				"label": "Direktur",
				"kelas": "X"
			},
			{
				"id": "48",
				"label": "Direktur Executive",
				"kelas": "X"
			},
			{
				"id": "49",
				"label": "Dj",
				"kelas": "X"
			},
			{
				"id": "50",
				"label": "Dokter",
				"kelas": "X"
			},
			{
				"id": "51",
				"label": "Dokter Gigi",
				"kelas": "X"
			},
			{
				"id": "52",
				"label": "Dokter Hewan",
				"kelas": "X"
			},
			{
				"id": "53",
				"label": "Dokter Jiwa",
				"kelas": "X"
			},
			{
				"id": "54",
				"label": "Dokter Kandungan",
				"kelas": "X"
			},
			{
				"id": "55",
				"label": "Dokter (Tulang Belakang)",
				"kelas": "X"
			},
			{
				"id": "56",
				"label": "Dosen",
				"kelas": "X"
			},
			{
				"id": "57",
				"label": "Duta Besar",
				"kelas": "X"
			},
			{
				"id": "58",
				"label": "Editor Film",
				"kelas": "X"
			},
			{
				"id": "59",
				"label": "Editor Koran/Majalah",
				"kelas": "X"
			},
			{
				"id": "60",
				"label": "Fotografer",
				"kelas": "X"
			},
			{
				"id": "61",
				"label": "Fotografer Berita",
				"kelas": "X"
			},
			{
				"id": "62",
				"label": "Ginekolog / Dokter Ahli Penyakit Wanita",
				"kelas": "X"
			},
			{
				"id": "63",
				"label": "Golf Caddie",
				"kelas": "X"
			},
			{
				"id": "64",
				"label": "Guru",
				"kelas": "X"
			},
			{
				"id": "65",
				"label": "Guru (Lainnya)",
				"kelas": "X"
			},
			{
				"id": "66",
				"label": "Guru Musik (Sekolah)",
				"kelas": "X"
			},
			{
				"id": "67",
				"label": "Guru Musik (Umum)",
				"kelas": "X"
			},
			{
				"id": "68",
				"label": "Guru Piano",
				"kelas": "X"
			},
			{
				"id": "69",
				"label": "Guru Privat",
				"kelas": "X"
			},
			{
				"id": "70",
				"label": "Guru (Sekolah)",
				"kelas": "X"
			},
			{
				"id": "71",
				"label": "Guru Taman Kanak-Kanak",
				"kelas": "X"
			},
			{
				"id": "73",
				"label": "Hakim",
				"kelas": "X"
			},
			{
				"id": "74",
				"label": "Hansip",
				"kelas": "X"
			},
			{
				"id": "75",
				"label": "Ibu Rumah Tangga",
				"kelas": "X"
			},
			{
				"id": "76",
				"label": "Insinyur (Bertugas Di Kantor)",
				"kelas": "X"
			},
			{
				"id": "77",
				"label": "Insinyur Kapal Laut",
				"kelas": "X"
			},
			{
				"id": "78",
				"label": "Insinyur Perawatan Pesawat Udara",
				"kelas": "X"
			},
			{
				"id": "79",
				"label": "Insinyur Software Komputer",
				"kelas": "X"
			},
			{
				"id": "80",
				"label": "Insinyur (Tidak Bertugas Di Kantor)",
				"kelas": "X"
			},
			{
				"id": "81",
				"label": "Instruktur Aerobic",
				"kelas": "X"
			},
			{
				"id": "82",
				"label": "Instruktur Fitness Centre",
				"kelas": "X"
			},
			{
				"id": "83",
				"label": "Instruktur Ilmu Bela Diri",
				"kelas": "X"
			},
			{
				"id": "84",
				"label": "Instruktur Mengemudi",
				"kelas": "X"
			},
			{
				"id": "85",
				"label": "Instruktur Renang",
				"kelas": "X"
			},
			{
				"id": "86",
				"label": "Instruktur Tari",
				"kelas": "X"
			},
			{
				"id": "87",
				"label": "Joki Berkuda",
				"kelas": "X"
			},
			{
				"id": "88",
				"label": "Jurnalis",
				"kelas": "X"
			},
			{
				"id": "89",
				"label": "Juru Ketik",
				"kelas": "X"
			},
			{
				"id": "90",
				"label": "Juru Masak",
				"kelas": "X"
			},
			{
				"id": "91",
				"label": "Kapten Kapal",
				"kelas": "X"
			},
			{
				"id": "92",
				"label": "Kasir",
				"kelas": "X"
			},
			{
				"id": "93",
				"label": "Kasir Bank",
				"kelas": "X"
			},
			{
				"id": "94",
				"label": "Kepala Daerah",
				"kelas": "X"
			},
			{
				"id": "95",
				"label": "Kepala Kapal Laut",
				"kelas": "X"
			},
			{
				"id": "96",
				"label": "Kepala Kebun Binatang",
				"kelas": "X"
			},
			{
				"id": "97",
				"label": "Kepala Kelasi",
				"kelas": "X"
			},
			{
				"id": "98",
				"label": "Kepala Mandor",
				"kelas": "X"
			},
			{
				"id": "99",
				"label": "Kepala Penjara",
				"kelas": "X"
			},
			{
				"id": "100",
				"label": "Kepala Sekolah",
				"kelas": "X"
			},
			{
				"id": "101",
				"label": "Kepala Toko",
				"kelas": "X"
			},
			{
				"id": "102",
				"label": "Koki",
				"kelas": "X"
			},
			{
				"id": "103",
				"label": "Komposer",
				"kelas": "X"
			},
			{
				"id": "104",
				"label": "Konsultan Kesehatan",
				"kelas": "X"
			},
			{
				"id": "105",
				"label": "Konsultan Manajemen",
				"kelas": "X"
			},
			{
				"id": "106",
				"label": "Kontraktor",
				"kelas": "X"
			},
			{
				"id": "107",
				"label": "Koordinator Acara",
				"kelas": "X"
			},
			{
				"id": "108",
				"label": "Kurir",
				"kelas": "X"
			},
			{
				"id": "109",
				"label": "Mahasiswa / Pelajar",
				"kelas": "X"
			},
			{
				"id": "110",
				"label": "Management Trainee",
				"kelas": "X"
			},
			{
				"id": "111",
				"label": "Manager Administrasi",
				"kelas": "X"
			},
			{
				"id": "112",
				"label": "Manager Eksekutif",
				"kelas": "X"
			},
			{
				"id": "113",
				"label": "Manager Hotel",
				"kelas": "X"
			},
			{
				"id": "114",
				"label": "Manager Toko",
				"kelas": "X"
			},
			{
				"id": "115",
				"label": "Manajer Night Club",
				"kelas": "X"
			},
			{
				"id": "116",
				"label": "Manajer Periklanan",
				"kelas": "X"
			},
			{
				"id": "117",
				"label": "Mandor Konstruksi",
				"kelas": "X"
			},
			{
				"id": "118",
				"label": "Masinis",
				"kelas": "X"
			},
			{
				"id": "119",
				"label": "Mekanik",
				"kelas": "X"
			},
			{
				"id": "120",
				"label": "Mekanik Pesawat Udara",
				"kelas": "X"
			},
			{
				"id": "121",
				"label": "Mining - Blaster - Open Mining And Quarry",
				"kelas": "X"
			},
			{
				"id": "122",
				"label": "Mining - Blaster - Underground",
				"kelas": "X"
			},
			{
				"id": "123",
				"label": "Mining - On Surface",
				"kelas": "X"
			},
			{
				"id": "124",
				"label": "Mining - Underground",
				"kelas": "X"
			},
			{
				"id": "125",
				"label": "Model",
				"kelas": "X"
			},
			{
				"id": "126",
				"label": "Model Agency Manager",
				"kelas": "X"
			},
			{
				"id": "127",
				"label": "Musisi",
				"kelas": "X"
			},
			{
				"id": "128",
				"label": "Musisi Kapal Laut",
				"kelas": "X"
			},
			{
				"id": "129",
				"label": "Nelayan (Jarak Jauh 10-15 Hari)",
				"kelas": "X"
			},
			{
				"id": "130",
				"label": "Nelayan Kembali ke Daratan Tiap Hari)",
				"kelas": "X"
			},
			{
				"id": "131",
				"label": "Notaris",
				"kelas": "X"
			},
			{
				"id": "132",
				"label": "Ojek",
				"kelas": "X"
			},
			{
				"id": "133",
				"label": "Operator Mesin",
				"kelas": "X"
			},
			{
				"id": "134",
				"label": "Operator Produksi",
				"kelas": "X"
			},
			{
				"id": "135",
				"label": "Operator Telepon",
				"kelas": "X"
			},
			{
				"id": "136",
				"label": "Pandai Besi",
				"kelas": "X"
			},
			{
				"id": "137",
				"label": "Pedagang Grosir",
				"kelas": "X"
			},
			{
				"id": "138",
				"label": "Pedagang Kelontong/Sembako",
				"kelas": "X"
			},
			{
				"id": "139",
				"label": "Pedagang Online",
				"kelas": "X"
			},
			{
				"id": "140",
				"label": "Pedagang Sayur",
				"kelas": "X"
			},
			{
				"id": "141",
				"label": "Pegawai Administrasi",
				"kelas": "X"
			},
			{
				"id": "142",
				"label": "Pegawai Bagian Humas",
				"kelas": "X"
			},
			{
				"id": "143",
				"label": "Pegawai Pengiriman",
				"kelas": "X"
			},
			{
				"id": "144",
				"label": "Pekerja Aspal Jalan",
				"kelas": "X"
			},
			{
				"id": "145",
				"label": "Pekerja Galangan Kapal",
				"kelas": "X"
			},
			{
				"id": "146",
				"label": "Pekerja Gudang",
				"kelas": "X"
			},
			{
				"id": "147",
				"label": "Pekerja Kaca / Gelas",
				"kelas": "X"
			},
			{
				"id": "148",
				"label": "Pekerja Kesekretariatan",
				"kelas": "X"
			},
			{
				"id": "149",
				"label": "Pekerja Museum",
				"kelas": "X"
			},
			{
				"id": "150",
				"label": "Pekerja Pabrik",
				"kelas": "X"
			},
			{
				"id": "151",
				"label": "Pekerja Pabrik Kimia",
				"kelas": "X"
			},
			{
				"id": "152",
				"label": "Pekerja Pemakaman",
				"kelas": "X"
			},
			{
				"id": "153",
				"label": "Pekerja Perhutanan",
				"kelas": "X"
			},
			{
				"id": "154",
				"label": "Pekerja Perikanan",
				"kelas": "X"
			},
			{
				"id": "155",
				"label": "Pekerja Perkebunan Coklat",
				"kelas": "X"
			},
			{
				"id": "156",
				"label": "Pekerja Perkebunan Kelapa",
				"kelas": "X"
			},
			{
				"id": "157",
				"label": "Pekerja Perkebunan Kelapa Sawit",
				"kelas": "X"
			},
			{
				"id": "158",
				"label": "Pekerja Perkebunan Teh",
				"kelas": "X"
			},
			{
				"id": "159",
				"label": "Pekerja Pertanian",
				"kelas": "X"
			},
			{
				"id": "160",
				"label": "Pekerja Rel Kereta Api",
				"kelas": "X"
			},
			{
				"id": "161",
				"label": "Pekerja Sosial",
				"kelas": "X"
			},
			{
				"id": "162",
				"label": "Pekerja Transportasi",
				"kelas": "X"
			},
			{
				"id": "163",
				"label": "Pekerja Waduk",
				"kelas": "X"
			},
			{
				"id": "164",
				"label": "Pekerja Yang Bertugas Dalam Pewarnaan Pakaian",
				"kelas": "X"
			},
			{
				"id": "165",
				"label": "Pelajar",
				"kelas": "X"
			},
			{
				"id": "166",
				"label": "Pelatih Binatang (Jinak)",
				"kelas": "X"
			},
			{
				"id": "167",
				"label": "Pelatih Binatang (Liar)",
				"kelas": "X"
			},
			{
				"id": "168",
				"label": "Pelatih Olahraga",
				"kelas": "X"
			},
			{
				"id": "169",
				"label": "Pelayan",
				"kelas": "X"
			},
			{
				"id": "170",
				"label": "Pelayan Bar (Pria)",
				"kelas": "X"
			},
			{
				"id": "171",
				"label": "Pelayan Bar (Wanita)",
				"kelas": "X"
			},
			{
				"id": "172",
				"label": "Pelayan Restaurant (Pria)",
				"kelas": "X"
			},
			{
				"id": "173",
				"label": "Pelayan Restaurant (Wanita)",
				"kelas": "X"
			},
			{
				"id": "174",
				"label": "Pemahat",
				"kelas": "X"
			},
			{
				"id": "175",
				"label": "Pemahat Kayu",
				"kelas": "X"
			},
			{
				"id": "176",
				"label": "Pemain Rugby",
				"kelas": "X"
			},
			{
				"id": "177",
				"label": "Pemandu Lalu Lintas Udara",
				"kelas": "X"
			},
			{
				"id": "178",
				"label": "Pembantu Rumah Tangga",
				"kelas": "X"
			},
			{
				"id": "179",
				"label": "Pembasmi Hama",
				"kelas": "X"
			},
			{
				"id": "180",
				"label": "Pembeli / Karyawan Pengadaan",
				"kelas": "X"
			},
			{
				"id": "181",
				"label": "Pembersih Kaca (Ketinggian Lebih Dari 2 Lantai)",
				"kelas": "X"
			},
			{
				"id": "182",
				"label": "Pembersih Kaca (Ketinggian Maksimum 2 Lantai)",
				"kelas": "X"
			},
			{
				"id": "183",
				"label": "Pembuat Lemari",
				"kelas": "X"
			},
			{
				"id": "184",
				"label": "Pembuat Pakaian",
				"kelas": "X"
			},
			{
				"id": "185",
				"label": "Pembuat Perahu",
				"kelas": "X"
			},
			{
				"id": "186",
				"label": "Pembuat Perkakas",
				"kelas": "X"
			},
			{
				"id": "187",
				"label": "Pembuat Roti/ Kue",
				"kelas": "X"
			},
			{
				"id": "188",
				"label": "Pembuat Sepatu",
				"kelas": "X"
			},
			{
				"id": "189",
				"label": "Pemeriksa (Auditor)",
				"kelas": "X"
			},
			{
				"id": "190",
				"label": "Penaksir Tuntutan Kerugian, Biasanya Dalam Asuransi",
				"kelas": "X"
			},
			{
				"id": "191",
				"label": "Penanam Bunga",
				"kelas": "X"
			},
			{
				"id": "192",
				"label": "Penari (Freelance)",
				"kelas": "X"
			},
			{
				"id": "193",
				"label": "Penari Profesional",
				"kelas": "X"
			},
			{
				"id": "194",
				"label": "Penasehat",
				"kelas": "X"
			},
			{
				"id": "195",
				"label": "Penasehat Hukum",
				"kelas": "X"
			},
			{
				"id": "196",
				"label": "Penata Rambut",
				"kelas": "X"
			},
			{
				"id": "197",
				"label": "Penata Rias Artis",
				"kelas": "X"
			},
			{
				"id": "198",
				"label": "Pendaki Gunung",
				"kelas": "X"
			},
			{
				"id": "199",
				"label": "Pendakwah",
				"kelas": "X"
			},
			{
				"id": "200",
				"label": "Pendeta",
				"kelas": "X"
			},
			{
				"id": "201",
				"label": "Pendiri Beton",
				"kelas": "X"
			},
			{
				"id": "202",
				"label": "Penebang Pohon",
				"kelas": "X"
			},
			{
				"id": "203",
				"label": "Peneliti",
				"kelas": "X"
			},
			{
				"id": "204",
				"label": "Penerbit",
				"kelas": "X"
			},
			{
				"id": "205",
				"label": "Penerjemah",
				"kelas": "X"
			},
			{
				"id": "206",
				"label": "Pengacara",
				"kelas": "X"
			},
			{
				"id": "207",
				"label": "Penganalisa Pasar",
				"kelas": "X"
			},
			{
				"id": "208",
				"label": "Pengantar Barang Dengan Menggunakan Motor",
				"kelas": "X"
			},
			{
				"id": "209",
				"label": "Pengarang",
				"kelas": "X"
			},
			{
				"id": "210",
				"label": "Pengawal",
				"kelas": "X"
			},
			{
				"id": "211",
				"label": "Pengawal Pribadi",
				"kelas": "X"
			},
			{
				"id": "212",
				"label": "Pengeboran & Eksplorasi Lepas Pantai : Hanya Bagian Administrasi & Pencatatan",
				"kelas": "X"
			},
			{
				"id": "213",
				"label": "Pengeboran & Eksplorasi Lepas Pantai : Operator Terampil / Ahli (Tidak Menangani Pengeboman )",
				"kelas": "X"
			},
			{
				"id": "214",
				"label": "Pengrajin Berlian",
				"kelas": "X"
			},
			{
				"id": "215",
				"label": "Pengrajin Emas",
				"kelas": "X"
			},
			{
				"id": "216",
				"label": "Penguji Mengemudi",
				"kelas": "X"
			},
			{
				"id": "217",
				"label": "Pengurus Pemakaman",
				"kelas": "X"
			},
			{
				"id": "218",
				"label": "Pengurus Rumah Tangga",
				"kelas": "X"
			},
			{
				"id": "219",
				"label": "Penjaga Hutan",
				"kelas": "X"
			},
			{
				"id": "220",
				"label": "Penjaga Malam",
				"kelas": "X"
			},
			{
				"id": "221",
				"label": "Penjaga Pantai",
				"kelas": "X"
			},
			{
				"id": "222",
				"label": "Penjaga Taman",
				"kelas": "X"
			},
			{
				"id": "223",
				"label": "Penjaga Toko",
				"kelas": "X"
			},
			{
				"id": "224",
				"label": "Penjahit",
				"kelas": "X"
			},
			{
				"id": "225",
				"label": "Penjual Buah",
				"kelas": "X"
			},
			{
				"id": "226",
				"label": "Penjual Buku",
				"kelas": "X"
			},
			{
				"id": "227",
				"label": "Penjual Ikan",
				"kelas": "X"
			},
			{
				"id": "228",
				"label": "Penjual Mobil",
				"kelas": "X"
			},
			{
				"id": "229",
				"label": "Pensiunan (Tanpa Pekerjaan Lain)",
				"kelas": "X"
			},
			{
				"id": "230",
				"label": "Penulis",
				"kelas": "X"
			},
			{
				"id": "231",
				"label": "Penulis Tetap",
				"kelas": "X"
			},
			{
				"id": "232",
				"label": "Penyadap Getah",
				"kelas": "X"
			},
			{
				"id": "233",
				"label": "Penyanyi",
				"kelas": "X"
			},
			{
				"id": "234",
				"label": "Penyapu Jalan",
				"kelas": "X"
			},
			{
				"id": "235",
				"label": "Penyelam",
				"kelas": "X"
			},
			{
				"id": "236",
				"label": "Penyelam (Tentara Angkatan Laut)",
				"kelas": "X"
			},
			{
				"id": "237",
				"label": "Penyembelih",
				"kelas": "X"
			},
			{
				"id": "238",
				"label": "Penyembelih Hewan Ternak",
				"kelas": "X"
			},
			{
				"id": "239",
				"label": "Penyidik",
				"kelas": "X"
			},
			{
				"id": "240",
				"label": "Perakit Mobil/Pesawat",
				"kelas": "X"
			},
			{
				"id": "241",
				"label": "Perakit Peralatan Elektronik",
				"kelas": "X"
			},
			{
				"id": "242",
				"label": "Perancang (Gambar)",
				"kelas": "X"
			},
			{
				"id": "243",
				"label": "Perawat",
				"kelas": "X"
			},
			{
				"id": "244",
				"label": "Perawat Kuda",
				"kelas": "X"
			},
			{
				"id": "245",
				"label": "Perminyakan  - Pekerja Laboratorimum (Ahli Kimia)",
				"kelas": "X"
			},
			{
				"id": "246",
				"label": "Perminyakan - Departemen Lainnya - Insinyur",
				"kelas": "X"
			},
			{
				"id": "247",
				"label": "Personal Manajer",
				"kelas": "X"
			},
			{
				"id": "248",
				"label": "Petani",
				"kelas": "X"
			},
			{
				"id": "249",
				"label": "Peternak",
				"kelas": "X"
			},
			{
				"id": "250",
				"label": "Petugas Admin",
				"kelas": "X"
			},
			{
				"id": "251",
				"label": "Petugas Customer  Service",
				"kelas": "X"
			},
			{
				"id": "252",
				"label": "Petugas Dekorasi (Outdoor)",
				"kelas": "X"
			},
			{
				"id": "253",
				"label": "Petugas Farmasi",
				"kelas": "X"
			},
			{
				"id": "254",
				"label": "Petugas Imigrasi",
				"kelas": "X"
			},
			{
				"id": "255",
				"label": "Petugas Instalasi Kabel",
				"kelas": "X"
			},
			{
				"id": "256",
				"label": "Petugas Kapal",
				"kelas": "X"
			},
			{
				"id": "257",
				"label": "Petugas Katering (Administrasi )",
				"kelas": "X"
			},
			{
				"id": "258",
				"label": "Petugas Keamanan",
				"kelas": "X"
			},
			{
				"id": "259",
				"label": "Petugas Kereta Api",
				"kelas": "X"
			},
			{
				"id": "260",
				"label": "Petugas Konstruksi (Gedung/ Bangunan)",
				"kelas": "X"
			},
			{
				"id": "261",
				"label": "Petugas Konstruksi (Jalan Raya)",
				"kelas": "X"
			},
			{
				"id": "262",
				"label": "Petugas Lalu Lintas",
				"kelas": "X"
			},
			{
				"id": "263",
				"label": "Petugas Laundry",
				"kelas": "X"
			},
			{
				"id": "264",
				"label": "Petugas Lift",
				"kelas": "X"
			},
			{
				"id": "265",
				"label": "Petugas Listrik, Petugas Pencahayaan Papan Periklanan",
				"kelas": "X"
			},
			{
				"id": "266",
				"label": "Petugas Loket Bis",
				"kelas": "X"
			},
			{
				"id": "267",
				"label": "Petugas Optik",
				"kelas": "X"
			},
			{
				"id": "268",
				"label": "Petugas Otopsi",
				"kelas": "X"
			},
			{
				"id": "269",
				"label": "Petugas Pajak",
				"kelas": "X"
			},
			{
				"id": "270",
				"label": "Petugas Parkir",
				"kelas": "X"
			},
			{
				"id": "271",
				"label": "Petugas Pemadam Kebakaran",
				"kelas": "X"
			},
			{
				"id": "272",
				"label": "Petugas Pembelian",
				"kelas": "X"
			},
			{
				"id": "273",
				"label": "Petugas Pembersih",
				"kelas": "X"
			},
			{
				"id": "274",
				"label": "Petugas Pemroses Data",
				"kelas": "X"
			},
			{
				"id": "275",
				"label": "Petugas Penebang Pohon",
				"kelas": "X"
			},
			{
				"id": "276",
				"label": "Petugas Penukaran Uang",
				"kelas": "X"
			},
			{
				"id": "277",
				"label": "Petugas Perdagangan",
				"kelas": "X"
			},
			{
				"id": "278",
				"label": "Petugas Perpustakaan",
				"kelas": "X"
			},
			{
				"id": "279",
				"label": "Petugas Projector Cinema",
				"kelas": "X"
			},
			{
				"id": "280",
				"label": "Petugas Quaity Control",
				"kelas": "X"
			},
			{
				"id": "281",
				"label": "Petugas Survey",
				"kelas": "X"
			},
			{
				"id": "282",
				"label": "Petugas Survey Kualitas",
				"kelas": "X"
			},
			{
				"id": "283",
				"label": "Pilot ( Airline Terkenal)",
				"kelas": "X"
			},
			{
				"id": "284",
				"label": "Pilot (Penerbangan Perintis)",
				"kelas": "X"
			},
			{
				"id": "285",
				"label": "Polis Pamong Praja / Satpol Pp",
				"kelas": "X"
			},
			{
				"id": "286",
				"label": "Polisi",
				"kelas": "X"
			},
			{
				"id": "287",
				"label": "Polisi Dengan Pangkat Perwira Keatas",
				"kelas": "X"
			},
			{
				"id": "288",
				"label": "Porter",
				"kelas": "X"
			},
			{
				"id": "289",
				"label": "Pramugari ( Penerbangan Perintis)",
				"kelas": "X"
			},
			{
				"id": "290",
				"label": "Pramugari (Airlines Ternama)",
				"kelas": "X"
			},
			{
				"id": "291",
				"label": "Pramuniaga",
				"kelas": "X"
			},
			{
				"id": "292",
				"label": "Pramuniaga (Admin)",
				"kelas": "X"
			},
			{
				"id": "293",
				"label": "Presenter Televisi",
				"kelas": "X"
			},
			{
				"id": "294",
				"label": "Produser Film",
				"kelas": "X"
			},
			{
				"id": "295",
				"label": "Profesor",
				"kelas": "X"
			},
			{
				"id": "296",
				"label": "Programmer",
				"kelas": "X"
			},
			{
				"id": "297",
				"label": "Psikiater",
				"kelas": "X"
			},
			{
				"id": "298",
				"label": "Resepsionis",
				"kelas": "X"
			},
			{
				"id": "299",
				"label": "Sales",
				"kelas": "X"
			},
			{
				"id": "300",
				"label": "Sales Assistant",
				"kelas": "X"
			},
			{
				"id": "301",
				"label": "Sales Consultant",
				"kelas": "X"
			},
			{
				"id": "302",
				"label": "Sales Executive",
				"kelas": "X"
			},
			{
				"id": "303",
				"label": "Sales Manager",
				"kelas": "X"
			},
			{
				"id": "304",
				"label": "Sales Representative",
				"kelas": "X"
			},
			{
				"id": "305",
				"label": "Satpam Bank",
				"kelas": "X"
			},
			{
				"id": "306",
				"label": "Sekretaris",
				"kelas": "X"
			},
			{
				"id": "307",
				"label": "Senator / Anggota Dewan",
				"kelas": "X"
			},
			{
				"id": "308",
				"label": "Sin She",
				"kelas": "X"
			},
			{
				"id": "309",
				"label": "Staff It",
				"kelas": "X"
			},
			{
				"id": "310",
				"label": "Stenographer",
				"kelas": "X"
			},
			{
				"id": "311",
				"label": "Supir Ambulan",
				"kelas": "X"
			},
			{
				"id": "312",
				"label": "Supir Bulldozer",
				"kelas": "X"
			},
			{
				"id": "313",
				"label": "Supir Bus",
				"kelas": "X"
			},
			{
				"id": "314",
				"label": "Supir Excavator",
				"kelas": "X"
			},
			{
				"id": "315",
				"label": "Supir Fork Lift",
				"kelas": "X"
			},
			{
				"id": "316",
				"label": "Supir Mobil Derek",
				"kelas": "X"
			},
			{
				"id": "317",
				"label": "Supir Mrt",
				"kelas": "X"
			},
			{
				"id": "318",
				"label": "Supir Pribadi",
				"kelas": "X"
			},
			{
				"id": "319",
				"label": "Supir Taksi",
				"kelas": "X"
			},
			{
				"id": "320",
				"label": "Supir Truk",
				"kelas": "X"
			},
			{
				"id": "321",
				"label": "Supir Van Untuk Delivery",
				"kelas": "X"
			},
			{
				"id": "322",
				"label": "Suplier",
				"kelas": "X"
			},
			{
				"id": "323",
				"label": "Sutradara Film",
				"kelas": "X"
			},
			{
				"id": "324",
				"label": "Teknisi",
				"kelas": "X"
			},
			{
				"id": "325",
				"label": "Teknisi Bangunan Bangunan, Bahan Bakar Pembakaran, Kulkas, Pemanas, Mesin, Radio, Televisi, Ventilasi",
				"kelas": "X"
			},
			{
				"id": "326",
				"label": "Teknisi Kendaraan",
				"kelas": "X"
			},
			{
				"id": "327",
				"label": "Teknisi Komputer",
				"kelas": "X"
			},
			{
				"id": "328",
				"label": "Teknisi Peralatan Elketronik",
				"kelas": "X"
			},
			{
				"id": "329",
				"label": "Teknisi Pesawat Udara",
				"kelas": "X"
			},
			{
				"id": "330",
				"label": "Tentara Angkatan Darat Penjinak Bom",
				"kelas": "X"
			},
			{
				"id": "331",
				"label": "Tentara Angkatan Darat Penjinak Bom, Dengan Pangkat Perwira Keatas",
				"kelas": "X"
			},
			{
				"id": "332",
				"label": "Tentara Angkatan Darat Penyerang",
				"kelas": "X"
			},
			{
				"id": "333",
				"label": "Tentara Angkatan Darat Penyerang, Dengan Pangkat Perwira Keatas",
				"kelas": "X"
			},
			{
				"id": "334",
				"label": "Tentara Angkatan Udara Dengan Pangkat Perwira Keatas",
				"kelas": "X"
			},
			{
				"id": "335",
				"label": "Tentara Angkatan Udara Pilot Dan Crew Helikopter",
				"kelas": "X"
			},
			{
				"id": "336",
				"label": "Tentara Angkatan Udara Pilot Dan Crew Pesawat Tempur",
				"kelas": "X"
			},
			{
				"id": "337",
				"label": "Tentara Pilot Pesawat Tempur",
				"kelas": "X"
			},
			{
				"id": "338",
				"label": "Tentara Pilot Pesawat Transportasi",
				"kelas": "X"
			},
			{
				"id": "339",
				"label": "Terapis Gigi",
				"kelas": "X"
			},
			{
				"id": "340",
				"label": "Tni Bagian Administrasi",
				"kelas": "X"
			},
			{
				"id": "342",
				"label": "Tni Bagian Babinsa",
				"kelas": "X"
			},
			{
				"id": "343",
				"label": "Tour Guide",
				"kelas": "X"
			},
			{
				"id": "344",
				"label": "Tour Manager",
				"kelas": "X"
			},
			{
				"id": "345",
				"label": "Trainer Untuk Kuda Balap",
				"kelas": "X"
			},
			{
				"id": "346",
				"label": "Travel Agen",
				"kelas": "X"
			},
			{
				"id": "347",
				"label": "Tukang Bangunan (Konstruksi Umum & Industri Non-Berbahaya)",
				"kelas": "X"
			},
			{
				"id": "348",
				"label": "Tukang Cat  Semprot",
				"kelas": "X"
			},
			{
				"id": "349",
				"label": "Tukang Cat (Indoor)",
				"kelas": "X"
			},
			{
				"id": "350",
				"label": "Tukang Cuci",
				"kelas": "X"
			},
			{
				"id": "351",
				"label": "Tukang Cukur",
				"kelas": "X"
			},
			{
				"id": "352",
				"label": "Tukang Gergaji (Industri Kayu)",
				"kelas": "X"
			},
			{
				"id": "353",
				"label": "Tukang Kayu Untuk Konstruksi Bangunan",
				"kelas": "X"
			},
			{
				"id": "354",
				"label": "Tukang Kebun",
				"kelas": "X"
			},
			{
				"id": "355",
				"label": "Tukang Keramik",
				"kelas": "X"
			},
			{
				"id": "356",
				"label": "Tukang Las",
				"kelas": "X"
			},
			{
				"id": "357",
				"label": "Tukang Listrik",
				"kelas": "X"
			},
			{
				"id": "358",
				"label": "Tukang Pasang Ac",
				"kelas": "X"
			},
			{
				"id": "359",
				"label": "Tukang Pelapis Perabot Rumah",
				"kelas": "X"
			},
			{
				"id": "360",
				"label": "Tukang Pembuat Kunci",
				"kelas": "X"
			},
			{
				"id": "361",
				"label": "Tukang Pengangkat / Pengumpul Kayu",
				"kelas": "X"
			},
			{
				"id": "362",
				"label": "Tukang Pijat",
				"kelas": "X"
			},
			{
				"id": "363",
				"label": "Tukang Pipa",
				"kelas": "X"
			},
			{
				"id": "364",
				"label": "Tukang Pos",
				"kelas": "X"
			},
			{
				"id": "365",
				"label": "Tukang Pukul (Tanpa Senjata)",
				"kelas": "X"
			},
			{
				"id": "366",
				"label": "Tukang Sampah",
				"kelas": "X"
			},
			{
				"id": "367",
				"label": "Tukang Sapu",
				"kelas": "X"
			},
			{
				"id": "368",
				"label": "Tukang Sayur",
				"kelas": "X"
			},
			{
				"id": "369",
				"label": "Tukang Tenun",
				"kelas": "X"
			},
			{
				"id": "370",
				"label": "Wasit Olahraga",
				"kelas": "X"
			}
		];
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
            }
            /* , {
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



        var provinsis = [{
            "id": "0",
            "label": "-- pilih --",
            "kdprop": "0"
        }, {
            "id": "DIA",
            "label": "Aceh (NAD)",
            "id_jaim": "AC"
        }, {
            "id": "BLI",
            "label": "Bali",
            "id_jaim": "BA"
        }, {
            "id": "BKB",
            "label": "Kepulauan Bangka Belitung",
            "id_jaim": "BB"
        }, {
            "id": "BAN",
            "label": "Banten",
            "id_jaim": "BT"
        }, {
            "id": "BKL",
            "label": "Bengkulu",
            "id_jaim": "BE"
        }, {
            "id": "DIY",
            "label": "DI Yogyakarta",
            "id_jaim": "YO"
        }, {
            "id": "DKI",
            "label": "DKI Jakarta",
            "id_jaim": "JK"
        }, {
            "id": "SGR",
            "label": "Gorontalo",
            "id_jaim": "GO"
        }, {
            "id": "JMB",
            "label": "Jambi",
            "id_jaim": "JA"
        }, {
            "id": "JWB",
            "label": "Jawa Barat",
            "id_jaim": "JB"
        }, {
            "id": "JWH",
            "label": "Jawa Tengah",
            "id_jaim": "JT"
        }, {
            "id": "JWT",
            "label": "Jawa Timur",
            "id_jaim": "JI"
        }, {
            "id": "KLB",
            "label": "Kalimantan Barat",
            "id_jaim": "KB"
        }, {
            "id": "KLS",
            "label": "Kalimantan Selatan",
            "id_jaim": "KS"
        }, {
            "id": "KLH",
            "label": "Kalimantan Tengah",
            "id_jaim": "KT"
        }, {
            "id": "KLT",
            "label": "Kalimantan Timur",
            "id_jaim": "KI"
        }, {
            "id": "KLU",
            "label": "Kalimantan Utara",
            "id_jaim": "KU"
        }, {
            "id": "LPG",
            "label": "Lampung",
            "id_jaim": "LA"
        }, {
            "id": "MLK",
            "label": "Maluku",
            "id_jaim": "MA"
        }, {
            "id": "MLU",
            "label": "Maluku Utara",
            "id_jaim": "MU"
        }, {
            "id": "NTB",
            "label": "Nusa Tenggara Barat (NTB)",
            "id_jaim": "NB"
        }, {
            "id": "NTT",
            "label": "Nusa Tenggara Timur (NTT)",
            "id_jaim": "NT"
        }, {
            "id": "IRJ",
            "label": "Papua",
            "id_jaim": "PB"
        }, {
            "id": "IRB",
            "label": "Papua Barat",
            "id_jaim": "PB"
        }, {
            "id": "RIA",
            "label": "Riau",
            "id_jaim": "RI"
        }, {
            "id": "RIU",
            "label": "Kepulauan Riau",
            "id_jaim": "KR"
        }, {
            "id": "SLB",
            "label": "Sulawesi Barat",
            "id_jaim": "SR"
        }, {
            "id": "SLS",
            "label": "Sulawesi Selatan",
            "id_jaim": "SN"
        }, {
            "id": "SLH",
            "label": "Sulawesi Tengah",
            "id_jaim": "ST"
        }, {
            "id": "SLG",
            "label": "Sulawesi Tenggara",
            "id_jaim": "SG"
        }, {
            "id": "SLU",
            "label": "Sulawesi Utara",
            "id_jaim": "SA"
        }, {
            "id": "SMU",
            "label": "Sumatera Utara",
            "id_jaim": "SU"
        }, {
            "id": "SMS",
            "label": "Sumatra Selatan",
            "id_jaim": "SS"
        }, {
            "id": "SMB",
            "label": "Sumatra Barat",
            "id_jaim": "SB"
        }];


        var kabupatens = [{
				"id": "0",
				"label": "-- pilih --",
				"kdprop": "0"
			}, {
				"id": "ABA",
				"label": "Aceh Barat",
				"kdprop": "DIA"
			},
			{
				"id": "ACB",
				"label": "Aceh Besar",
				"kdprop": "DIA"
			},
			{
				"id": "ACL",
				"label": "Aceh Selatan",
				"kdprop": "DIA"
			},
			{
				"id": "ACS",
				"label": "Aceh Singkil",
				"kdprop": "DIA"
			},
			{
				"id": "ACT",
				"label": "Aceh Tamiang",
				"kdprop": "DIA"
			},
			{
				"id": "ATG",
				"label": "Aceh Tengah",
				"kdprop": "DIA"
			},
			{
				"id": "ACE",
				"label": "Aceh Tenggara",
				"kdprop": "DIA"
			},
			{
				"id": "ACM",
				"label": "Aceh Timur",
				"kdprop": "DIA"
			},
			{
				"id": "AUT",
				"label": "Aceh Utara",
				"kdprop": "DIA"
			},
			{
				"id": "AGM",
				"label": "Agam",
				"kdprop": "SMB"
			},
			{
				"id": "ALR",
				"label": "Alor",
				"kdprop": "NTT"
			},
			{
				"id": "AMB",
				"label": "Ambon",
				"kdprop": "MLK"
			},
			{
				"id": "ALP",
				"label": "Amlapura",
				"kdprop": "BLI"
			},
			{
				"id": "AMP",
				"label": "Ampah",
				"kdprop": "KLH"
			},
			{
				"id": "AMT",
				"label": "Amuntai",
				"kdprop": "KLS"
			},
			{
				"id": "ANK",
				"label": "Anakalang",
				"kdprop": "NTT"
			},
			{
				"id": "ADL",
				"label": "Andoolo",
				"kdprop": "SLG"
			},
			{
				"id": "AGR",
				"label": "Argamakmur",
				"kdprop": "BKL"
			},
			{
				"id": "ASH",
				"label": "Asahan",
				"kdprop": "SMU"
			},
			{
				"id": "ASR",
				"label": "Asera",
				"kdprop": "SLG"
			},
			{
				"id": "ATB",
				"label": "Atambua",
				"kdprop": "NTT"
			},
			{
				"id": "BAD",
				"label": "Badung",
				"kdprop": "BLI"
			},
			{
				"id": "BJW",
				"label": "Bajawa",
				"kdprop": "NTT"
			},
			{
				"id": "BLG",
				"label": "Balangan",
				"kdprop": "KLS"
			},
			{
				"id": "BPP",
				"label": "Balikpapan",
				"kdprop": "KLT"
			},
			{
				"id": "BNA",
				"label": "Banda Aceh",
				"kdprop": "DIA"
			},
			{
				"id": "BDJ",
				"label": "Bandar Jaya",
				"kdprop": "LPG"
			},
			{
				"id": "BDL",
				"label": "Bandarlampung",
				"kdprop": "LPG"
			},
			{
				"id": "BDG",
				"label": "Bandung",
				"kdprop": "JWB"
			},
			{
				"id": "BGI",
				"label": "Banggai",
				"kdprop": "SLH"
			},
			{
				"id": "BGK",
				"label": "Banggai Kepulauan",
				"kdprop": "SLH"
			},
			{
				"id": "BGT",
				"label": "Banggai Laut",
				"kdprop": "SLH"
			},
			{
				"id": "KBK",
				"label": "Bangka",
				"kdprop": "BKB"
			},
			{
				"id": "MTK",
				"label": "Bangka Barat",
				"kdprop": "BKB"
			},
			{
				"id": "SLT",
				"label": "Bangka Induk",
				"kdprop": "BKB"
			},
			{
				"id": "TBL",
				"label": "Bangka Selatan",
				"kdprop": "BKB"
			},
			{
				"id": "KOB",
				"label": "Bangka Tengah",
				"kdprop": "BKB"
			},
			{
				"id": "BKN",
				"label": "Bangkalan",
				"kdprop": "JWT"
			},
			{
				"id": "BKG",
				"label": "Bangkinang",
				"kdprop": "RIU"
			},
			{
				"id": "BGL",
				"label": "Bangli",
				"kdprop": "BLI"
			},
			{
				"id": "BJR",
				"label": "Banjar",
				"kdprop": "JWB"
			},
			{
				"id": "BJB",
				"label": "Banjarbaru",
				"kdprop": "KLS"
			},
			{
				"id": "BJM",
				"label": "Banjarmasin",
				"kdprop": "KLS"
			},
			{
				"id": "BJN",
				"label": "Banjarnegara",
				"kdprop": "JWH"
			},
			{
				"id": "BAN",
				"label": "Bantaeng",
				"kdprop": "SLS"
			},
			{
				"id": "BTL",
				"label": "Bantul",
				"kdprop": "DIY"
			},
			{
				"id": "BAS",
				"label": "Banyu Asin",
				"kdprop": "SMS"
			},
			{
				"id": "BNY",
				"label": "Banyumas",
				"kdprop": "JWH"
			},
			{
				"id": "BWG",
				"label": "Banyuwangi",
				"kdprop": "JWT"
			},
			{
				"id": "BRI",
				"label": "Barabai",
				"kdprop": "KLS"
			},
			{
				"id": "BAR",
				"label": "Barru",
				"kdprop": "SLS"
			},
			{
				"id": "BTM",
				"label": "Batam",
				"kdprop": "RIU"
			},
			{
				"id": "BTG",
				"label": "Batang",
				"kdprop": "JWH"
			},
			{
				"id": "BTH",
				"label": "Batang Hari",
				"kdprop": "JMB"
			},
			{
				"id": "BTU",
				"label": "Batu",
				"kdprop": "JWT"
			},
			{
				"id": "BTB",
				"label": "Batubara",
				"kdprop": "SMU"
			},
			{
				"id": "BTA",
				"label": "Baturaja",
				"kdprop": "SMS"
			},
			{
				"id": "BSK",
				"label": "Batusangkar",
				"kdprop": "SMB"
			},
			{
				"id": "BAU",
				"label": "Bau-Bau",
				"kdprop": "SLG"
			},
			{
				"id": "BKS",
				"label": "Bekasi",
				"kdprop": "JWB"
			},
			{
				"id": "TJN",
				"label": "Belitung",
				"kdprop": "BKB"
			},
			{
				"id": "MGR",
				"label": "Belitung Timur",
				"kdprop": "BKB"
			},
			{
				"id": "BLP",
				"label": "Belopa",
				"kdprop": "SLS"
			},
			{
				"id": "BLU",
				"label": "Belu",
				"kdprop": "NTT"
			},
			{
				"id": "BNR",
				"label": "Bener Meriah",
				"kdprop": "DIA"
			},
			{
				"id": "BKA",
				"label": "Bengkalis",
				"kdprop": "RIA"
			},
			{
				"id": "BKY",
				"label": "Bengkayang",
				"kdprop": "KLB"
			},
			{
				"id": "BKL",
				"label": "Bengkulu",
				"kdprop": "BKL"
			},
			{
				"id": "BLS",
				"label": "Bengkulu Selatan",
				"kdprop": "BKL"
			},
			{
				"id": "BK1",
				"label": "Bengkulu Tengah",
				"kdprop": "BKL"
			},
			{
				"id": "BKU",
				"label": "Bengkulu Utara",
				"kdprop": "BKL"
			},
			{
				"id": "BRD",
				"label": "Berandan",
				"kdprop": "SMU"
			},
			{
				"id": "BRU",
				"label": "Berau",
				"kdprop": "KLT"
			},
			{
				"id": "BIA",
				"label": "Biak",
				"kdprop": "IRJ"
			},
			{
				"id": "BMA",
				"label": "Bima",
				"kdprop": "NTB"
			},
			{
				"id": "BJI",
				"label": "Binjai",
				"kdprop": "SMU"
			},
			{
				"id": "BIT",
				"label": "Bintan",
				"kdprop": "RIU"
			},
			{
				"id": "BIN",
				"label": "Bintuhan",
				"kdprop": "BKL"
			},
			{
				"id": "BRE",
				"label": "Bireuen",
				"kdprop": "DIA"
			},
			{
				"id": "BTN",
				"label": "Bitung",
				"kdprop": "SLU"
			},
			{
				"id": "BLT",
				"label": "Blitar",
				"kdprop": "JWT"
			},
			{
				"id": "BLO",
				"label": "Blora",
				"kdprop": "JWH"
			},
			{
				"id": "BLM",
				"label": "Boalemo",
				"kdprop": "SGR"
			},
			{
				"id": "BOG",
				"label": "Bogor",
				"kdprop": "JWB"
			},
			{
				"id": "BNG",
				"label": "Bojonegoro",
				"kdprop": "JWT"
			},
			{
				"id": "BMD",
				"label": "Bolaang Mongondow",
				"kdprop": "SLU"
			},
			{
				"id": "BMS",
				"label": "Bolaang Mongondow Selatan",
				"kdprop": "SLU"
			},
			{
				"id": "BMT",
				"label": "Bolaang Mongondow Utara",
				"kdprop": "SLU"
			},
			{
				"id": "BBN",
				"label": "Bombana",
				"kdprop": "SLG"
			},
			{
				"id": "BOW",
				"label": "Bondowoso",
				"kdprop": "JWT"
			},
			{
				"id": "BON",
				"label": "Bone",
				"kdprop": "SLS"
			},
			{
				"id": "BBL",
				"label": "Bone Bolango",
				"kdprop": "SGR"
			},
			{
				"id": "BOT",
				"label": "Bontang",
				"kdprop": "KLT"
			},
			{
				"id": "BYL",
				"label": "Boyolali",
				"kdprop": "JWH"
			},
			{
				"id": "BBS",
				"label": "Brebes",
				"kdprop": "JWH"
			},
			{
				"id": "BKT",
				"label": "Bukittinggi",
				"kdprop": "SMB"
			},
			{
				"id": "BLA",
				"label": "Bula",
				"kdprop": "MLK"
			},
			{
				"id": "BLL",
				"label": "Buleleng",
				"kdprop": "BLI"
			},
			{
				"id": "BLK",
				"label": "Bulukumba",
				"kdprop": "SLS"
			},
			{
				"id": "BLN",
				"label": "Bulungan",
				"kdprop": "KLU"
			},
			{
				"id": "BGO",
				"label": "Bungo",
				"kdprop": "JMB"
			},
			{
				"id": "BNT",
				"label": "Buntok",
				"kdprop": "KLH"
			},
			{
				"id": "BUL",
				"label": "Buol",
				"kdprop": "SLH"
			},
			{
				"id": "BR ",
				"label": "Buru",
				"kdprop": "MLK"
			},
			{
				"id": "BTO",
				"label": "Buton",
				"kdprop": "SLG"
			},
			{
				"id": "BNU",
				"label": "Buton Utara",
				"kdprop": "SLG"
			},
			{
				"id": "CMI",
				"label": "Ciamis",
				"kdprop": "JWB"
			},
			{
				"id": "CJR",
				"label": "Cianjur",
				"kdprop": "JWB"
			},
			{
				"id": "CBI",
				"label": "Cibinong",
				"kdprop": "JWB"
			},
			{
				"id": "CKD",
				"label": "Cikande",
				"kdprop": "BAN"
			},
			{
				"id": "CKR",
				"label": "Cikarang",
				"kdprop": "JWB"
			},
			{
				"id": "CLP",
				"label": "Cilacap",
				"kdprop": "JWH"
			},
			{
				"id": "CLD",
				"label": "Ciledug",
				"kdprop": "BAN"
			},
			{
				"id": "CLG",
				"label": "Cilegon",
				"kdprop": "BAN"
			},
			{
				"id": "CMH",
				"label": "Cimahi",
				"kdprop": "JWB"
			},
			{
				"id": "CPT",
				"label": "Ciputat",
				"kdprop": "BAN"
			},
			{
				"id": "CBN",
				"label": "Cirebon",
				"kdprop": "JWB"
			},
			{
				"id": "CRP",
				"label": "Curup",
				"kdprop": "BKL"
			},
			{
				"id": "DAI",
				"label": "Dairi",
				"kdprop": "SMU"
			},
			{
				"id": "DSG",
				"label": "Deli Serdang",
				"kdprop": "SMU"
			},
			{
				"id": "DMK",
				"label": "Demak",
				"kdprop": "JWH"
			},
			{
				"id": "DPS",
				"label": "Denpasar",
				"kdprop": "BLI"
			},
			{
				"id": "DPK",
				"label": "Depok",
				"kdprop": "JWB"
			},
			{
				"id": "DLI",
				"label": "Dili",
				"kdprop": "TMT"
			},
			{
				"id": "DBO",
				"label": "Dobo",
				"kdprop": "MLK"
			},
			{
				"id": "DLS",
				"label": "Dolok Sanggul",
				"kdprop": "SMU"
			},
			{
				"id": "DPU",
				"label": "Dompu",
				"kdprop": "NTB"
			},
			{
				"id": "DON",
				"label": "Donggala",
				"kdprop": "SLH"
			},
			{
				"id": "DMI",
				"label": "Dumai",
				"kdprop": "RIA"
			},
			{
				"id": "DRI",
				"label": "Duri",
				"kdprop": "RIU"
			},
			{
				"id": "EML",
				"label": "Empat Lawang",
				"kdprop": "SMS"
			},
			{
				"id": "END",
				"label": "Ende",
				"kdprop": "NTT"
			},
			{
				"id": "ENR",
				"label": "Enrekang",
				"kdprop": "SLS"
			},
			{
				"id": "ERK",
				"label": "Ereke",
				"kdprop": "SLG"
			},
			{
				"id": "FFK",
				"label": "Fakfak",
				"kdprop": "IRJ"
			},
			{
				"id": "FLT",
				"label": "Flores Timur",
				"kdprop": "NTT"
			},
			{
				"id": "GRT",
				"label": "Garut",
				"kdprop": "JWB"
			},
			{
				"id": "GTG",
				"label": "Genteng",
				"kdprop": "JWT"
			},
			{
				"id": "GSR",
				"label": "Geser",
				"kdprop": "MLK"
			},
			{
				"id": "GIN",
				"label": "Gianyar",
				"kdprop": "BLI"
			},
			{
				"id": "GTL",
				"label": "Gorontalo",
				"kdprop": "SGR"
			},
			{
				"id": "GTU",
				"label": "Gorontalo Utara",
				"kdprop": "SGR"
			},
			{
				"id": "GWA",
				"label": "Gowa",
				"kdprop": "SLS"
			},
			{
				"id": "GRS",
				"label": "Gresik",
				"kdprop": "JWT"
			},
			{
				"id": "GRB",
				"label": "Grobogan",
				"kdprop": "JWH"
			},
			{
				"id": "WNR",
				"label": "Gunung Kidul",
				"kdprop": "DIY"
			},
			{
				"id": "GNM",
				"label": "Gunung Mas",
				"kdprop": "KLH"
			},
			{
				"id": "GST",
				"label": "Gunungsitoli",
				"kdprop": "SMU"
			},
			{
				"id": "HLB",
				"label": "Halmahera Barat",
				"kdprop": "MLU"
			},
			{
				"id": "HAL",
				"label": "Halmahera Tengah",
				"kdprop": "MLU"
			},
			{
				"id": "HLT",
				"label": "Halmahera Timur",
				"kdprop": "MLU"
			},
			{
				"id": "HLU",
				"label": "Halmahera Utara",
				"kdprop": "MLU"
			},
			{
				"id": "HDL",
				"label": "Handil",
				"kdprop": "KLT"
			},
			{
				"id": "HLS",
				"label": "Hulu Sungai Tengah",
				"kdprop": "KLS"
			},
			{
				"id": "HUM",
				"label": "Humbang Hasundutan",
				"kdprop": "SMU"
			},
			{
				"id": "IHI",
				"label": "Indragiri Hilir",
				"kdprop": "RIA"
			},
			{
				"id": "IHU",
				"label": "Indragiri Hulu",
				"kdprop": "RIA"
			},
			{
				"id": "IDM",
				"label": "Indramayu",
				"kdprop": "JWB"
			},
			{
				"id": "JKB",
				"label": "Jakarta Barat",
				"kdprop": "DKI"
			},
			{
				"id": "JKP",
				"label": "Jakarta Pusat",
				"kdprop": "DKI"
			},
			{
				"id": "JKS",
				"label": "Jakarta Selatan",
				"kdprop": "DKI"
			},
			{
				"id": "JKT",
				"label": "Jakarta Timur",
				"kdprop": "DKI"
			},
			{
				"id": "JKU",
				"label": "Jakarta Utara",
				"kdprop": "DKI"
			},
			{
				"id": "JMB",
				"label": "Jambi",
				"kdprop": "JMB"
			},
			{
				"id": "JAN",
				"label": "Jantho",
				"kdprop": "DIA"
			},
			{
				"id": "JPR",
				"label": "Jayapura",
				"kdprop": "IRJ"
			},
			{
				"id": "JBR",
				"label": "Jember",
				"kdprop": "JWT"
			},
			{
				"id": "JBN",
				"label": "Jembrana",
				"kdprop": "BLI"
			},
			{
				"id": "JNP",
				"label": "Jeneponto",
				"kdprop": "SLS"
			},
			{
				"id": "JPA",
				"label": "Jepara",
				"kdprop": "JWH"
			},
			{
				"id": "JBG",
				"label": "Jombang",
				"kdprop": "JWT"
			},
			{
				"id": "ABD",
				"label": "Kab. Aceh Barat Daya",
				"kdprop": "DIA"
			},
			{
				"id": "AJY",
				"label": "Kab. Aceh Jaya",
				"kdprop": "DIA"
			},
			{
				"id": "AST",
				"label": "Kab. Asmat",
				"kdprop": "IRJ"
			},
			{
				"id": "KBD",
				"label": "Kab. Bandung",
				"kdprop": "JWB"
			},
			{
				"id": "BDB",
				"label": "Kab. Bandung Barat",
				"kdprop": "JWB"
			},
			{
				"id": "KBL",
				"label": "Kab. Bangkalan",
				"kdprop": "JWH"
			},
			{
				"id": "KJR",
				"label": "Kab. Banjar",
				"kdprop": "KLS"
			},
			{
				"id": "KRK",
				"label": "Kab. Barito Kuala",
				"kdprop": "KLS"
			},
			{
				"id": "KBS",
				"label": "Kab. Barito Selatan",
				"kdprop": "KLH"
			},
			{
				"id": "KBT",
				"label": "Kab. Barito Timur",
				"kdprop": "KLH"
			},
			{
				"id": "KBU",
				"label": "Kab. Barito Utara",
				"kdprop": "KLH"
			},
			{
				"id": "BKK",
				"label": "Kab. Bekasi",
				"kdprop": "JWB"
			},
			{
				"id": "KBF",
				"label": "Kab. Biak Numfor",
				"kdprop": "IRJ"
			},
			{
				"id": "KLR",
				"label": "Kab. Blitar",
				"kdprop": "JWT"
			},
			{
				"id": "KBG",
				"label": "Kab. Bogor",
				"kdprop": "JWB"
			},
			{
				"id": "BMR",
				"label": "Kab. Bolaang Mongondow Timur",
				"kdprop": "SLU"
			},
			{
				"id": "BDO",
				"label": "Kab. Boven Digoel",
				"kdprop": "IRJ"
			},
			{
				"id": "MBS",
				"label": "Kab. Buru Selatan",
				"kdprop": "MLK"
			},
			{
				"id": "KBN",
				"label": "Kab. Buton Selatan",
				"kdprop": "SLG"
			},
			{
				"id": "KBH",
				"label": "Kab. Buton Tengah",
				"kdprop": "SLG"
			},
			{
				"id": "KCB",
				"label": "Kab. Cirebon",
				"kdprop": "JWB"
			},
			{
				"id": "KDY",
				"label": "Kab. Deiyai",
				"kdprop": "IRJ"
			},
			{
				"id": "DMS",
				"label": "Kab. Dharmasraya",
				"kdprop": "SMB"
			},
			{
				"id": "DGY",
				"label": "Kab. Dogiyai",
				"kdprop": "IRJ"
			},
			{
				"id": "AGL",
				"label": "Kab. Gayo Lues",
				"kdprop": "DIA"
			},
			{
				"id": "KGT",
				"label": "Kab. Gorontalo",
				"kdprop": "SGR"
			},
			{
				"id": "HAS",
				"label": "Kab. Halmahera Selatan",
				"kdprop": "MLU"
			},
			{
				"id": "HSS",
				"label": "Kab. Hulu Sungai Selatan",
				"kdprop": "KLS"
			},
			{
				"id": "HSU",
				"label": "Kab. Hulu Sungai Utara",
				"kdprop": "KLS"
			},
			{
				"id": "KIJ",
				"label": "Kab. Intan Jaya",
				"kdprop": "IRJ"
			},
			{
				"id": "JPY",
				"label": "Kab. Jayapura",
				"kdprop": "IRJ"
			},
			{
				"id": "KJW",
				"label": "Kab. Jayawijaya",
				"kdprop": "IRJ"
			},
			{
				"id": "KKM",
				"label": "Kab. Kaimana",
				"kdprop": "IRB"
			},
			{
				"id": "PUS",
				"label": "Kab. Kapuas",
				"kdprop": "KLH"
			},
			{
				"id": "KKH",
				"label": "Kab. Kapuas Hulu",
				"kdprop": "KLB"
			},
			{
				"id": "KKG",
				"label": "Kab. Katingan",
				"kdprop": "KLH"
			},
			{
				"id": "KKD",
				"label": "Kab. Kediri",
				"kdprop": "JWT"
			},
			{
				"id": "KER",
				"label": "Kab. Keerom",
				"kdprop": "IRJ"
			},
			{
				"id": "MKA",
				"label": "Kab. Kepulauan Aru",
				"kdprop": "MLK"
			},
			{
				"id": "KKS",
				"label": "Kab. Kepulauan Seribu",
				"kdprop": "DKI"
			},
			{
				"id": "KKK",
				"label": "Kab. Konawe Kepulauan",
				"kdprop": "SLG"
			},
			{
				"id": "KPA",
				"label": "Kab. Kupang",
				"kdprop": "NTT"
			},
			{
				"id": "LBU",
				"label": "Kab. Labuhanbatu Utara",
				"kdprop": "SMU"
			},
			{
				"id": "KLN",
				"label": "Kab. Lamandau",
				"kdprop": "KLH"
			},
			{
				"id": "KLJ",
				"label": "Kab. Lanny Jaya",
				"kdprop": "IRJ"
			},
			{
				"id": "50K",
				"label": "Kab. Lima Puluh Kota",
				"kdprop": "SMB"
			},
			{
				"id": "KMD",
				"label": "Kab. Madiun",
				"kdprop": "JWH"
			},
			{
				"id": "KMG",
				"label": "Kab. Magelang",
				"kdprop": "JWH"
			},
			{
				"id": "KMU",
				"label": "Kab. Mahakam Ulu",
				"kdprop": "KLT"
			},
			{
				"id": "MLA",
				"label": "Kab. Malaka",
				"kdprop": "NTT"
			},
			{
				"id": "KML",
				"label": "Kab. Malang",
				"kdprop": "JWH"
			},
			{
				"id": "MBD",
				"label": "Kab. Maluku Barat Daya",
				"kdprop": "MLK"
			},
			{
				"id": "MTB",
				"label": "Kab. Maluku Tenggara Barat",
				"kdprop": "MLK"
			},
			{
				"id": "MRT",
				"label": "Kab. Mamberamo Tengah",
				"kdprop": "IRJ"
			},
			{
				"id": "KMS",
				"label": "Kab. Manokwari Selatan",
				"kdprop": "IRB"
			},
			{
				"id": "MPI",
				"label": "Kab. Mappi",
				"kdprop": "IRJ"
			},
			{
				"id": "KMB",
				"label": "Kab. Maybrat",
				"kdprop": "IRB"
			},
			{
				"id": "MTG",
				"label": "Kab. Minahasa Tenggara",
				"kdprop": "SLU"
			},
			{
				"id": "KMK",
				"label": "Kab. Mojokerto",
				"kdprop": "JWT"
			},
			{
				"id": "MBT",
				"label": "Kab. Muna Barat",
				"kdprop": "SLG"
			},
			{
				"id": "KRU",
				"label": "Kab. Musi Rawas Utara",
				"kdprop": "SMS"
			},
			{
				"id": "NDG",
				"label": "Kab. Nduga",
				"kdprop": "IRJ"
			},
			{
				"id": "KUS",
				"label": "Kab. Ogan Komering Ulu Selatan",
				"kdprop": "SMS"
			},
			{
				"id": "KUT",
				"label": "Kab. Ogan Komering Ulu Timur",
				"kdprop": "SMS"
			},
			{
				"id": "KPM",
				"label": "Kab. Padang Pariaman",
				"kdprop": "SMB"
			},
			{
				"id": "KPW",
				"label": "Kab. Pahuwato",
				"kdprop": "SGR"
			},
			{
				"id": "PKJ",
				"label": "Kab. Pangkajene Kepulauan",
				"kdprop": "SLS"
			},
			{
				"id": "KPI",
				"label": "Kab. Paniai",
				"kdprop": "IRJ"
			},
			{
				"id": "KRN",
				"label": "Kab. Pasuruan",
				"kdprop": "JWT"
			},
			{
				"id": "PTI",
				"label": "Kab. Pati",
				"kdprop": "JWH"
			},
			{
				"id": "KPF",
				"label": "Kab. Pegunungan Arfak",
				"kdprop": "IRB"
			},
			{
				"id": "KPL",
				"label": "Kab. Pekalongan",
				"kdprop": "JWH"
			},
			{
				"id": "ALI",
				"label": "Kab. Penukal Abab Lematang Ilir",
				"kdprop": "SMS"
			},
			{
				"id": "PRB",
				"label": "Kab. Pesisir Barat",
				"kdprop": "LPG"
			},
			{
				"id": "APJ",
				"label": "Kab. Pidie Jaya",
				"kdprop": "DIA"
			},
			{
				"id": "KPB",
				"label": "Kab. Probolinggo",
				"kdprop": "JWH"
			},
			{
				"id": "PMT",
				"label": "Kab. Pulau Morotai",
				"kdprop": "MLU"
			},
			{
				"id": "PTA",
				"label": "Kab. Pulau Taliabu",
				"kdprop": "MLU"
			},
			{
				"id": "PCK",
				"label": "Kab. Puncak",
				"kdprop": "IRJ"
			},
			{
				"id": "PJY",
				"label": "Kab. Puncak Jaya",
				"kdprop": "IRJ"
			},
			{
				"id": "KRT",
				"label": "Kab. Raja Ampat",
				"kdprop": "IRB"
			},
			{
				"id": "SBU",
				"label": "Kab. Sabu Raijua",
				"kdprop": "NTT"
			},
			{
				"id": "KSM",
				"label": "Kab. Sarmi",
				"kdprop": "IRJ"
			},
			{
				"id": "KSG",
				"label": "Kab. Semarang",
				"kdprop": "JWH"
			},
			{
				"id": "MBB",
				"label": "Kab. Seram Bagian Barat",
				"kdprop": "MLK"
			},
			{
				"id": "KSR",
				"label": "Kab. Serang",
				"kdprop": "BAN"
			},
			{
				"id": "SRP",
				"label": "Kab. Sidenreng Rappang",
				"kdprop": "SLS"
			},
			{
				"id": "SJJ",
				"label": "Kab. Sijunjung",
				"kdprop": "SMB"
			},
			{
				"id": "SLS",
				"label": "Kab. Solok Selatan",
				"kdprop": "SMB"
			},
			{
				"id": "KRG",
				"label": "Kab. Sorong",
				"kdprop": "IRB"
			},
			{
				"id": "KSS",
				"label": "Kab. Sorong Selatan",
				"kdprop": "IRB"
			},
			{
				"id": "KSB",
				"label": "Kab. Sukabumi",
				"kdprop": "JWB"
			},
			{
				"id": "SBA",
				"label": "Kab. Sumba Barat",
				"kdprop": "NTT"
			},
			{
				"id": "SPO",
				"label": "Kab. Supiori",
				"kdprop": "IRJ"
			},
			{
				"id": "KTM",
				"label": "Kab. Tambrauw",
				"kdprop": "IRB"
			},
			{
				"id": "TDT",
				"label": "Kab. Tanah Datar",
				"kdprop": "SMB"
			},
			{
				"id": "KGG",
				"label": "Kab. Tangerang",
				"kdprop": "BAN"
			},
			{
				"id": "TGB",
				"label": "Kab. Tanjung Jabung Barat",
				"kdprop": "JMB"
			},
			{
				"id": "TGT",
				"label": "Kab. Tanjung Jabung Timur",
				"kdprop": "JMB"
			},
			{
				"id": "KTS",
				"label": "Kab. Tasikmalaya",
				"kdprop": "JWB"
			},
			{
				"id": "KGL",
				"label": "Kab. Tegal",
				"kdprop": "JWH"
			},
			{
				"id": "KTW",
				"label": "Kab. Teluk Wondama",
				"kdprop": "IRB"
			},
			{
				"id": "TTS",
				"label": "Kab. Timor Tengah Selatan",
				"kdprop": "NTT"
			},
			{
				"id": "TTU",
				"label": "Kab. Timor Tengah Utara",
				"kdprop": "NTT"
			},
			{
				"id": "KTK",
				"label": "Kab. Tolikara",
				"kdprop": "IRJ"
			},
			{
				"id": "TBB",
				"label": "Kab. Tulang Bawang Barat",
				"kdprop": "LPG"
			},
			{
				"id": "KWP",
				"label": "Kab. Waropen",
				"kdprop": "IRJ"
			},
			{
				"id": "YKM",
				"label": "Kab. Yahukimo",
				"kdprop": "IRJ"
			},
			{
				"id": "KYM",
				"label": "Kab. Yalimo",
				"kdprop": "IRJ"
			},
			{
				"id": "KBJ",
				"label": "Kabanjahe",
				"kdprop": "SMU"
			},
			{
				"id": "KBI",
				"label": "Kalabahi",
				"kdprop": "NTT"
			},
			{
				"id": "KLD",
				"label": "Kalianda",
				"kdprop": "LPG"
			},
			{
				"id": "KPR",
				"label": "Kampar",
				"kdprop": "RIA"
			},
			{
				"id": "KGN",
				"label": "Kandangan",
				"kdprop": "KLS"
			},
			{
				"id": "KRY",
				"label": "Karang Ayu",
				"kdprop": "JWH"
			},
			{
				"id": "KRA",
				"label": "Karanganyar",
				"kdprop": "JWH"
			},
			{
				"id": "KAN",
				"label": "Karangasem",
				"kdprop": "BLI"
			},
			{
				"id": "KWG",
				"label": "Karawang",
				"kdprop": "JWB"
			},
			{
				"id": "KRM",
				"label": "Karimun",
				"kdprop": "RIU"
			},
			{
				"id": "KAR",
				"label": "Karo",
				"kdprop": "SMU"
			},
			{
				"id": "KSP",
				"label": "Kasipute",
				"kdprop": "SLG"
			},
			{
				"id": "KS ",
				"label": "Kasongan",
				"kdprop": "KLH"
			},
			{
				"id": "KAU",
				"label": "Kaur",
				"kdprop": "BKL"
			},
			{
				"id": "KYU",
				"label": "Kayong Utara",
				"kdprop": "KLB"
			},
			{
				"id": "KAG",
				"label": "Kayuagung",
				"kdprop": "SMS"
			},
			{
				"id": "KBE",
				"label": "Kebumen",
				"kdprop": "JWH"
			},
			{
				"id": "KDR",
				"label": "Kediri",
				"kdprop": "JWT"
			},
			{
				"id": "KEF",
				"label": "Kefamenanu",
				"kdprop": "NTT"
			},
			{
				"id": "KDL",
				"label": "Kendal",
				"kdprop": "JWH"
			},
			{
				"id": "KDI",
				"label": "Kendari",
				"kdprop": "SLG"
			},
			{
				"id": "KST",
				"label": "Kep. Siau Tagulandang Biaro",
				"kdprop": "SLU"
			},
			{
				"id": "KPH",
				"label": "Kepahiang",
				"kdprop": "BKL"
			},
			{
				"id": "KPN",
				"label": "Kepanjen",
				"kdprop": "JWT"
			},
			{
				"id": "KAB",
				"label": "Kepulauan Anambas",
				"kdprop": "RIU"
			},
			{
				"id": "KMT",
				"label": "Kepulauan Mentawai",
				"kdprop": "SMB"
			},
			{
				"id": "KMR",
				"label": "Kepulauan Meranti",
				"kdprop": "RIA"
			},
			{
				"id": "KRI",
				"label": "Kepulauan Riau",
				"kdprop": "RIU"
			},
			{
				"id": "KSA",
				"label": "Kepulauan Sangihe",
				"kdprop": "SLU"
			},
			{
				"id": "KPS",
				"label": "Kepulauan Sula",
				"kdprop": "MLU"
			},
			{
				"id": "KTA",
				"label": "Kepulauan Talaud",
				"kdprop": "SLU"
			},
			{
				"id": "KPY",
				"label": "Kepulauan Yapen",
				"kdprop": "IRJ"
			},
			{
				"id": "KRC",
				"label": "Kerinci",
				"kdprop": "JMB"
			},
			{
				"id": "KTP",
				"label": "Ketapang",
				"kdprop": "KLB"
			},
			{
				"id": "KIS",
				"label": "Kisaran",
				"kdprop": "SMU"
			},
			{
				"id": "KLT",
				"label": "Klaten",
				"kdprop": "JWH"
			},
			{
				"id": "KLK",
				"label": "Klungkung",
				"kdprop": "BLI"
			},
			{
				"id": "KKA",
				"label": "Kolaka",
				"kdprop": "SLG"
			},
			{
				"id": "KKT",
				"label": "Kolaka Timur",
				"kdprop": "SLG"
			},
			{
				"id": "KKU",
				"label": "Kolaka Utara",
				"kdprop": "SLG"
			},
			{
				"id": "KNW",
				"label": "Konawe",
				"kdprop": "SLG"
			},
			{
				"id": "KNS",
				"label": "Konawe Selatan",
				"kdprop": "SLG"
			},
			{
				"id": "KNU",
				"label": "Konawe Utara",
				"kdprop": "SLG"
			},
			{
				"id": "KBA",
				"label": "Kota Bima",
				"kdprop": "NTB"
			},
			{
				"id": "MTR",
				"label": "Kota Mataram",
				"kdprop": "NTB"
			},
			{
				"id": "KSK",
				"label": "Kota Solok",
				"kdprop": "SMB"
			},
			{
				"id": "ASL",
				"label": "Kota Subulussalam",
				"kdprop": "DIA"
			},
			{
				"id": "KTT",
				"label": "Kota Ternate",
				"kdprop": "MLU"
			},
			{
				"id": "KWB",
				"label": "Kota Waringin Barat",
				"kdprop": "KLH"
			},
			{
				"id": "KWT",
				"label": "Kota Waringin Timur",
				"kdprop": "KLH"
			},
			{
				"id": "KTB",
				"label": "Kotabaru",
				"kdprop": "KLS"
			},
			{
				"id": "KBM",
				"label": "Kotabumi",
				"kdprop": "LPG"
			},
			{
				"id": "KTG",
				"label": "Kotamobagu",
				"kdprop": "SLU"
			},
			{
				"id": "KKP",
				"label": "Kuala Kapuas",
				"kdprop": "KLH"
			},
			{
				"id": "KKR",
				"label": "Kuala Kurun",
				"kdprop": "KLH"
			},
			{
				"id": "KTL",
				"label": "Kualatungkal",
				"kdprop": "JMB"
			},
			{
				"id": "KUA",
				"label": "Kuantan Singingi",
				"kdprop": "RIA"
			},
			{
				"id": "KBR",
				"label": "Kubu Raya",
				"kdprop": "KLB"
			},
			{
				"id": "KDS",
				"label": "Kudus",
				"kdprop": "JWH"
			},
			{
				"id": "WAT",
				"label": "Kulon Progo",
				"kdprop": "DIY"
			},
			{
				"id": "KNG",
				"label": "Kuningan",
				"kdprop": "JWB"
			},
			{
				"id": "KPG",
				"label": "Kupang",
				"kdprop": "NTT"
			},
			{
				"id": "KTN",
				"label": "Kutacane",
				"kdprop": "DIA"
			},
			{
				"id": "KUB",
				"label": "Kutai Barat",
				"kdprop": "KLT"
			},
			{
				"id": "KTI",
				"label": "Kutai Kertanegara",
				"kdprop": "KLT"
			},
			{
				"id": "KTR",
				"label": "Kutai Timur",
				"kdprop": "KLT"
			},
			{
				"id": "LBJ",
				"label": "Labuan Bajo",
				"kdprop": "NTT"
			},
			{
				"id": "LAB",
				"label": "Labuhan Batu",
				"kdprop": "SMU"
			},
			{
				"id": "LBB",
				"label": "Labuhan Batu Selatan",
				"kdprop": "SMU"
			},
			{
				"id": "LHT",
				"label": "Lahat",
				"kdprop": "SMS"
			},
			{
				"id": "LMG",
				"label": "Lamongan",
				"kdprop": "JWT"
			},
			{
				"id": "LBR",
				"label": "Lampung Barat",
				"kdprop": "LPG"
			},
			{
				"id": "LPS",
				"label": "Lampung Selatan",
				"kdprop": "LPG"
			},
			{
				"id": "LPT",
				"label": "Lampung Tengah",
				"kdprop": "LPG"
			},
			{
				"id": "LTP",
				"label": "Lampung Timur",
				"kdprop": "LPG"
			},
			{
				"id": "LPU",
				"label": "Lampung Utara",
				"kdprop": "LPG"
			},
			{
				"id": "LDK",
				"label": "Landak",
				"kdprop": "KLB"
			},
			{
				"id": "LGR",
				"label": "Langgur",
				"kdprop": "MLK"
			},
			{
				"id": "LKT",
				"label": "Langkat",
				"kdprop": "SMU"
			},
			{
				"id": "LGS",
				"label": "Langsa",
				"kdprop": "DIA"
			},
			{
				"id": "LRT",
				"label": "Larantuka",
				"kdprop": "NTT"
			},
			{
				"id": "LBK",
				"label": "Lebak",
				"kdprop": "BAN"
			},
			{
				"id": "LBN",
				"label": "Lebong",
				"kdprop": "BKL"
			},
			{
				"id": "LTA",
				"label": "Lembata",
				"kdprop": "NTT"
			},
			{
				"id": "LSM",
				"label": "Lhokseumawe",
				"kdprop": "DIA"
			},
			{
				"id": "LBT",
				"label": "Limboto",
				"kdprop": "SLU"
			},
			{
				"id": "LGA",
				"label": "Lingga",
				"kdprop": "RIU"
			},
			{
				"id": "LMB",
				"label": "Lombok Barat",
				"kdprop": "NTB"
			},
			{
				"id": "LOT",
				"label": "Lombok Tengah",
				"kdprop": "NTB"
			},
			{
				"id": "LMT",
				"label": "Lombok Timur",
				"kdprop": "NTB"
			},
			{
				"id": "LMU",
				"label": "Lombok Utara",
				"kdprop": "NTB"
			},
			{
				"id": "LLG",
				"label": "Lubuklinggau",
				"kdprop": "SMS"
			},
			{
				"id": "LBP",
				"label": "Lubukpakam",
				"kdprop": "SMU"
			},
			{
				"id": "LBS",
				"label": "Lubuksikaping",
				"kdprop": "SMB"
			},
			{
				"id": "LMJ",
				"label": "Lumajang",
				"kdprop": "JWT"
			},
			{
				"id": "LUW",
				"label": "Luwu",
				"kdprop": "SLS"
			},
			{
				"id": "LWT",
				"label": "Luwu Timur",
				"kdprop": "SLS"
			},
			{
				"id": "LWU",
				"label": "Luwu Utara",
				"kdprop": "SLS"
			},
			{
				"id": "LWK",
				"label": "Luwuk",
				"kdprop": "SLH"
			},
			{
				"id": "MDU",
				"label": "Madiun",
				"kdprop": "JWT"
			},
			{
				"id": "MGL",
				"label": "Magelang",
				"kdprop": "JWH"
			},
			{
				"id": "MGT",
				"label": "Magetan",
				"kdprop": "JWT"
			},
			{
				"id": "MJL",
				"label": "Majalengka",
				"kdprop": "JWB"
			},
			{
				"id": "MJN",
				"label": "Majenang",
				"kdprop": "JWH"
			},
			{
				"id": "MJE",
				"label": "Majene",
				"kdprop": "SLB"
			},
			{
				"id": "MAK",
				"label": "Makale",
				"kdprop": "SLS"
			},
			{
				"id": "MKS",
				"label": "Makassar",
				"kdprop": "SLS"
			},
			{
				"id": "MLG",
				"label": "Malang",
				"kdprop": "JWT"
			},
			{
				"id": "MLN",
				"label": "Malinau",
				"kdprop": "KLU"
			},
			{
				"id": "MTH",
				"label": "Maluku Tengah",
				"kdprop": "MLK"
			},
			{
				"id": "MTT",
				"label": "Maluku Tenggara",
				"kdprop": "MLK"
			},
			{
				"id": "MAL",
				"label": "Maluku Utara",
				"kdprop": "MLU"
			},
			{
				"id": "MMS",
				"label": "Mamasa",
				"kdprop": "SLB"
			},
			{
				"id": "MBR",
				"label": "Mamberamo Raya",
				"kdprop": "IRJ"
			},
			{
				"id": "MMJ",
				"label": "Mamuju",
				"kdprop": "SLB"
			},
			{
				"id": "MAJ",
				"label": "Mamuju Tengah",
				"kdprop": "SLB"
			},
			{
				"id": "MAM",
				"label": "Mamuju Utara",
				"kdprop": "SLB"
			},
			{
				"id": "MDO",
				"label": "Manado",
				"kdprop": "SLU"
			},
			{
				"id": "MNN",
				"label": "Mandailing Natal",
				"kdprop": "SMU"
			},
			{
				"id": "MND",
				"label": "Mandula",
				"kdprop": "SLH"
			},
			{
				"id": "MGI",
				"label": "Manggarai",
				"kdprop": "NTT"
			},
			{
				"id": "MGB",
				"label": "Manggarai Barat",
				"kdprop": "NTT"
			},
			{
				"id": "MGE",
				"label": "Manggarai Timur",
				"kdprop": "NTT"
			},
			{
				"id": "MNA",
				"label": "Manna",
				"kdprop": "BKL"
			},
			{
				"id": "MWR",
				"label": "Manokwari",
				"kdprop": "IRB"
			},
			{
				"id": "MRB",
				"label": "Marabahan",
				"kdprop": "KLS"
			},
			{
				"id": "MRS",
				"label": "Maros",
				"kdprop": "SLS"
			},
			{
				"id": "MTP",
				"label": "Martapura",
				"kdprop": "KLS"
			},
			{
				"id": "MSH",
				"label": "Masohi",
				"kdprop": "MLK"
			},
			{
				"id": "MME",
				"label": "Maumere",
				"kdprop": "NTT"
			},
			{
				"id": "MDN",
				"label": "Medan",
				"kdprop": "SMU"
			},
			{
				"id": "MLK",
				"label": "Melak",
				"kdprop": "KLT"
			},
			{
				"id": "MLW",
				"label": "Melawi",
				"kdprop": "KLB"
			},
			{
				"id": "MPW",
				"label": "Mempawah",
				"kdprop": "KLB"
			},
			{
				"id": "MRG",
				"label": "Merangin",
				"kdprop": "JMB"
			},
			{
				"id": "MRK",
				"label": "Merauke",
				"kdprop": "IRJ"
			},
			{
				"id": "MSJ",
				"label": "Mesuji",
				"kdprop": "LPG"
			},
			{
				"id": "MET",
				"label": "Metro",
				"kdprop": "LPG"
			},
			{
				"id": "MBO",
				"label": "Meulaboh",
				"kdprop": "DIA"
			},
			{
				"id": "MMK",
				"label": "Mimika",
				"kdprop": "IRJ"
			},
			{
				"id": "MNH",
				"label": "Minahasa",
				"kdprop": "SLU"
			},
			{
				"id": "MDK",
				"label": "Minahasa Induk",
				"kdprop": "SLU"
			},
			{
				"id": "MIS",
				"label": "Minahasa Selatan",
				"kdprop": "SLU"
			},
			{
				"id": "MIU",
				"label": "Minahasa Utara",
				"kdprop": "SLU"
			},
			{
				"id": "MJK",
				"label": "Mojokerto",
				"kdprop": "JWT"
			},
			{
				"id": "MOR",
				"label": "Morowali",
				"kdprop": "SLH"
			},
			{
				"id": "MRU",
				"label": "Morowali Utara",
				"kdprop": "SLH"
			},
			{
				"id": "MAN",
				"label": "Muara Aman",
				"kdprop": "BKL"
			},
			{
				"id": "MEN",
				"label": "Muaraenim",
				"kdprop": "SMS"
			},
			{
				"id": "MTW",
				"label": "Muarateweh",
				"kdprop": "KLH"
			},
			{
				"id": "MLB",
				"label": "Muaro Labuah",
				"kdprop": "SMB"
			},
			{
				"id": "MJI",
				"label": "Muarojambi",
				"kdprop": "JMB"
			},
			{
				"id": "MKM",
				"label": "Muko Muko",
				"kdprop": "BKL"
			},
			{
				"id": "MUN",
				"label": "Muna",
				"kdprop": "SLG"
			},
			{
				"id": "MRY",
				"label": "Murung Raya",
				"kdprop": "KLH"
			},
			{
				"id": "MBA",
				"label": "Musi Banyu Asin",
				"kdprop": "SMS"
			},
			{
				"id": "MUR",
				"label": "Musi Rawas",
				"kdprop": "SMS"
			},
			{
				"id": "NAB",
				"label": "Nabire",
				"kdprop": "IRJ"
			},
			{
				"id": "NGR",
				"label": "Nagan Raya",
				"kdprop": "DIA"
			},
			{
				"id": "NGK",
				"label": "Nagekeo",
				"kdprop": "NTT"
			},
			{
				"id": "NML",
				"label": "Namlea",
				"kdprop": "MLK"
			},
			{
				"id": "NMR",
				"label": "Namrole",
				"kdprop": "MLK"
			},
			{
				"id": "NTN",
				"label": "Natuna",
				"kdprop": "RIU"
			},
			{
				"id": "NGA",
				"label": "Negara, Bali",
				"kdprop": "BLI"
			},
			{
				"id": "NBG",
				"label": "Ngabang",
				"kdprop": "KLB"
			},
			{
				"id": "NGD",
				"label": "Ngada",
				"kdprop": "NTT"
			},
			{
				"id": "NGJ",
				"label": "Nganjuk",
				"kdprop": "JWT"
			},
			{
				"id": "NGW",
				"label": "Ngawi",
				"kdprop": "JWT"
			},
			{
				"id": "NIP",
				"label": "Nias",
				"kdprop": "SMU"
			},
			{
				"id": "NIB",
				"label": "Nias Barat",
				"kdprop": "SMU"
			},
			{
				"id": "NIS",
				"label": "Nias Selatan",
				"kdprop": "SMU"
			},
			{
				"id": "NIU",
				"label": "Nias Utara",
				"kdprop": "SMU"
			},
			{
				"id": "NNK",
				"label": "Nunukan",
				"kdprop": "KLU"
			},
			{
				"id": "OLI",
				"label": "Ogan Ilir",
				"kdprop": "SMS"
			},
			{
				"id": "OKI",
				"label": "Ogan Komering Ilir",
				"kdprop": "SMS"
			},
			{
				"id": "OKU",
				"label": "Ogan Komering Ulu",
				"kdprop": "SMS"
			},
			{
				"id": "OKS",
				"label": "Oku Selatan",
				"kdprop": "SMS"
			},
			{
				"id": "OKT",
				"label": "Oku Timur",
				"kdprop": "SMS"
			},
			{
				"id": "PCT",
				"label": "Pacitan",
				"kdprop": "JWT"
			},
			{
				"id": "PDA",
				"label": "Padang",
				"kdprop": "SMB"
			},
			{
				"id": "PLS",
				"label": "Padang Lawas",
				"kdprop": "SMU"
			},
			{
				"id": "PLU",
				"label": "Padang Lawas Utara",
				"kdprop": "SMU"
			},
			{
				"id": "PPJ",
				"label": "Padang Panjang",
				"kdprop": "SMB"
			},
			{
				"id": "PSP",
				"label": "Padangsidempuan",
				"kdprop": "SMU"
			},
			{
				"id": "PGA",
				"label": "Pagar Alam",
				"kdprop": "SMS"
			},
			{
				"id": "PNN",
				"label": "Painan",
				"kdprop": "SMB"
			},
			{
				"id": "PPB",
				"label": "Pakpak Barat",
				"kdprop": "SMU"
			},
			{
				"id": "PLK",
				"label": "Palangkaraya",
				"kdprop": "KLH"
			},
			{
				"id": "PLB",
				"label": "Palembang",
				"kdprop": "SMS"
			},
			{
				"id": "PAI",
				"label": "Pali",
				"kdprop": "SMS"
			},
			{
				"id": "PLP",
				"label": "Palopo",
				"kdprop": "SLS"
			},
			{
				"id": "PAL",
				"label": "Palu",
				"kdprop": "SLH"
			},
			{
				"id": "PMK",
				"label": "Pamekasan",
				"kdprop": "JWT"
			},
			{
				"id": "PNK",
				"label": "Panakukang",
				"kdprop": "SLS"
			},
			{
				"id": "PBT",
				"label": "Pancurbatu",
				"kdprop": "SMU"
			},
			{
				"id": "PDG",
				"label": "Pandeglang",
				"kdprop": "BAN"
			},
			{
				"id": "PDR",
				"label": "Pangandaran",
				"kdprop": "JWB"
			},
			{
				"id": "PBU",
				"label": "Pangkalanbun",
				"kdprop": "KLH"
			},
			{
				"id": "PKP",
				"label": "Pangkalpinang",
				"kdprop": "BKB"
			},
			{
				"id": "PAN",
				"label": "Pangkep",
				"kdprop": "SLS"
			},
			{
				"id": "PYB",
				"label": "Panyabungan",
				"kdprop": "SMU"
			},
			{
				"id": "PAR",
				"label": "Pare",
				"kdprop": "JWT"
			},
			{
				"id": "PRE",
				"label": "Parepare",
				"kdprop": "SLS"
			},
			{
				"id": "PMN",
				"label": "Pariaman",
				"kdprop": "SMB"
			},
			{
				"id": "PRM",
				"label": "Parigi Moutong",
				"kdprop": "SLH"
			},
			{
				"id": "PRG",
				"label": "Paringin",
				"kdprop": "KLS"
			},
			{
				"id": "PSM",
				"label": "Pasaman ",
				"kdprop": "SMB"
			},
			{
				"id": "PSB",
				"label": "Pasaman Barat",
				"kdprop": "SMB"
			},
			{
				"id": "PRR",
				"label": "Paser",
				"kdprop": "KLT"
			},
			{
				"id": "PSR",
				"label": "Pasuruan",
				"kdprop": "JWT"
			},
			{
				"id": "PYK",
				"label": "Payakumbuh",
				"kdprop": "SMB"
			},
			{
				"id": "PGB",
				"label": "Pegunungan Bintang",
				"kdprop": "IRJ"
			},
			{
				"id": "PKL",
				"label": "Pekalongan",
				"kdprop": "JWH"
			},
			{
				"id": "PKB",
				"label": "Pekanbaru",
				"kdprop": "RIA"
			},
			{
				"id": "PLI",
				"label": "Pelaihari",
				"kdprop": "KLS"
			},
			{
				"id": "PEL",
				"label": "Pelalawan",
				"kdprop": "RIA"
			},
			{
				"id": "PML",
				"label": "Pemalang",
				"kdprop": "JWH"
			},
			{
				"id": "PMS",
				"label": "Pematangsiantar",
				"kdprop": "SMU"
			},
			{
				"id": "PEN",
				"label": "Penajam Paser Utara",
				"kdprop": "KLT"
			},
			{
				"id": "PRW",
				"label": "Perawang",
				"kdprop": "RIU"
			},
			{
				"id": "PES",
				"label": "Pesawaran",
				"kdprop": "LPG"
			},
			{
				"id": "PSS",
				"label": "Pesisir Selatan",
				"kdprop": "SMB"
			},
			{
				"id": "PDI",
				"label": "Pidie",
				"kdprop": "DIA"
			},
			{
				"id": "PIN",
				"label": "Pinrang",
				"kdprop": "SLS"
			},
			{
				"id": "PNR",
				"label": "Pinrang",
				"kdprop": "SLS"
			},
			{
				"id": "PRU",
				"label": "Piru",
				"kdprop": "MLK"
			},
			{
				"id": "PHT",
				"label": "Pohuwato",
				"kdprop": "SGR"
			},
			{
				"id": "PLW",
				"label": "Polewali",
				"kdprop": "SLS"
			},
			{
				"id": "PLM",
				"label": "Polewali Mandar",
				"kdprop": "SLB"
			},
			{
				"id": "PLN",
				"label": "Polman",
				"kdprop": "SLB"
			},
			{
				"id": "PON",
				"label": "Ponorogo",
				"kdprop": "JWT"
			},
			{
				"id": "PTK",
				"label": "Pontianak",
				"kdprop": "KLB"
			},
			{
				"id": "PSO",
				"label": "Poso",
				"kdprop": "SLH"
			},
			{
				"id": "PBM",
				"label": "Prabumulih",
				"kdprop": "SMS"
			},
			{
				"id": "PYA",
				"label": "Praya",
				"kdprop": "NTB"
			},
			{
				"id": "PSW",
				"label": "Pringsewu",
				"kdprop": "LPG"
			},
			{
				"id": "PBL",
				"label": "Probolinggo",
				"kdprop": "JWT"
			},
			{
				"id": "PP ",
				"label": "Pulang Pisau",
				"kdprop": "KLH"
			},
			{
				"id": "PBG",
				"label": "Purbalingga",
				"kdprop": "JWH"
			},
			{
				"id": "PCH",
				"label": "Puruk Cahu",
				"kdprop": "KLH"
			},
			{
				"id": "PWK",
				"label": "Purwakarta",
				"kdprop": "JWB"
			},
			{
				"id": "PWD",
				"label": "Purwodadi",
				"kdprop": "JWH"
			},
			{
				"id": "PWT",
				"label": "Purwokerto",
				"kdprop": "JWH"
			},
			{
				"id": "PWU",
				"label": "Purwokerto Utara",
				"kdprop": "JWH"
			},
			{
				"id": "PWR",
				"label": "Purworejo",
				"kdprop": "JWH"
			},
			{
				"id": "PTS",
				"label": "Putussibau",
				"kdprop": "KLB"
			},
			{
				"id": "RHA",
				"label": "Raha",
				"kdprop": "SLG"
			},
			{
				"id": "RBS",
				"label": "Rajabasa",
				"kdprop": "LPG"
			},
			{
				"id": "RKB",
				"label": "Rangkasbitung",
				"kdprop": "BAN"
			},
			{
				"id": "RTA",
				"label": "Rantau",
				"kdprop": "KLS"
			},
			{
				"id": "RAP",
				"label": "Rantauparapat",
				"kdprop": "SMU"
			},
			{
				"id": "RJL",
				"label": "Rejang Lebong",
				"kdprop": "BKL"
			},
			{
				"id": "RBG",
				"label": "Rembang",
				"kdprop": "JWH"
			},
			{
				"id": "RGT",
				"label": "Rengat",
				"kdprop": "RIU"
			},
			{
				"id": "RIU",
				"label": "Riau",
				"kdprop": "RIA"
			},
			{
				"id": "RHI",
				"label": "Rokan Hilir",
				"kdprop": "RIA"
			},
			{
				"id": "RHU",
				"label": "Rokan Hulu",
				"kdprop": "RIA"
			},
			{
				"id": "RTD",
				"label": "Rote Ndao",
				"kdprop": "NTT"
			},
			{
				"id": "RTG",
				"label": "Ruteng",
				"kdprop": "NTT"
			},
			{
				"id": "SBN",
				"label": "Sabang",
				"kdprop": "DIA"
			},
			{
				"id": "SLG",
				"label": "Salatiga",
				"kdprop": "JWH"
			},
			{
				"id": "SMR",
				"label": "Samarinda",
				"kdprop": "KLT"
			},
			{
				"id": "SBS",
				"label": "Sambas",
				"kdprop": "KLB"
			},
			{
				"id": "SBJ",
				"label": "Samboja",
				"kdprop": "KLT"
			},
			{
				"id": "SN ",
				"label": "Samosir",
				"kdprop": "SMU"
			},
			{
				"id": "SPG",
				"label": "Sampang",
				"kdprop": "JWT"
			},
			{
				"id": "SPT",
				"label": "Sampit",
				"kdprop": "KLH"
			},
			{
				"id": "SAG",
				"label": "Sanggau",
				"kdprop": "KLB"
			},
			{
				"id": "SAH",
				"label": "Sangihe",
				"kdprop": "SLU"
			},
			{
				"id": "SRL",
				"label": "Sarolangun",
				"kdprop": "JMB"
			},
			{
				"id": "SMK",
				"label": "Saumlaki",
				"kdprop": "MLK"
			},
			{
				"id": "SWL",
				"label": "Sawahlunto",
				"kdprop": "SMB"
			},
			{
				"id": "SEB",
				"label": "Seba",
				"kdprop": "NTT"
			},
			{
				"id": "SKD",
				"label": "Sekadau",
				"kdprop": "KLB"
			},
			{
				"id": "SKY",
				"label": "Sekayu",
				"kdprop": "SMS"
			},
			{
				"id": "SKR",
				"label": "Sekura",
				"kdprop": "KLB"
			},
			{
				"id": "SLY",
				"label": "Selayar",
				"kdprop": "SLS"
			},
			{
				"id": "SEL",
				"label": "Selong",
				"kdprop": "NTB"
			},
			{
				"id": "SLM",
				"label": "Seluma",
				"kdprop": "BKL"
			},
			{
				"id": "SMG",
				"label": "Semarang",
				"kdprop": "JWH"
			},
			{
				"id": "SGT",
				"label": "Sengata",
				"kdprop": "KLT"
			},
			{
				"id": "SKG",
				"label": "Sengkang",
				"kdprop": "SLS"
			},
			{
				"id": "STN",
				"label": "Sentani",
				"kdprop": "IRJ"
			},
			{
				"id": "SRB",
				"label": "Seram Bagian Timur",
				"kdprop": "MLK"
			},
			{
				"id": "SRG",
				"label": "Serang",
				"kdprop": "BAN"
			},
			{
				"id": "SDB",
				"label": "Serdang Bedagai",
				"kdprop": "SMU"
			},
			{
				"id": "SRU",
				"label": "Serui",
				"kdprop": "IRJ"
			},
			{
				"id": "SRY",
				"label": "Seruyan",
				"kdprop": "KLH"
			},
			{
				"id": "SIA",
				"label": "Siak",
				"kdprop": "RIA"
			},
			{
				"id": "SBG",
				"label": "Sibolga",
				"kdprop": "SMU"
			},
			{
				"id": "SDG",
				"label": "Sidenreng",
				"kdprop": "SLS"
			},
			{
				"id": "SDK",
				"label": "Sidikalang",
				"kdprop": "SMU"
			},
			{
				"id": "SDA",
				"label": "Sidoarjo",
				"kdprop": "JWT"
			},
			{
				"id": "SDR",
				"label": "Sidrap",
				"kdprop": "SLS"
			},
			{
				"id": "SIG",
				"label": "Sigi",
				"kdprop": "SLH"
			},
			{
				"id": "SGI",
				"label": "Sigli",
				"kdprop": "DIA"
			},
			{
				"id": "SIK",
				"label": "Sikka",
				"kdprop": "NTT"
			},
			{
				"id": "SIM",
				"label": "Simalungun",
				"kdprop": "SMU"
			},
			{
				"id": "SML",
				"label": "Simeulue",
				"kdprop": "SMU"
			},
			{
				"id": "SGR",
				"label": "Singaraja",
				"kdprop": "BLI"
			},
			{
				"id": "SKW",
				"label": "Singkawang",
				"kdprop": "KLB"
			},
			{
				"id": "SKL",
				"label": "Singkil",
				"kdprop": "DIA"
			},
			{
				"id": "SIN",
				"label": "Sinjai",
				"kdprop": "SLS"
			},
			{
				"id": "STG",
				"label": "Sintang",
				"kdprop": "KLB"
			},
			{
				"id": "STO",
				"label": "Sitaro",
				"kdprop": "SLU"
			},
			{
				"id": "SIT",
				"label": "Situbondo",
				"kdprop": "JWT"
			},
			{
				"id": "SWA",
				"label": "Siwa",
				"kdprop": "SLS"
			},
			{
				"id": "SLW",
				"label": "Slawi",
				"kdprop": "JWH"
			},
			{
				"id": "SMN",
				"label": "Sleman",
				"kdprop": "DIY"
			},
			{
				"id": "SSU",
				"label": "Soasiu",
				"kdprop": "MLK"
			},
			{
				"id": "SOE",
				"label": "Soe",
				"kdprop": "NTT"
			},
			{
				"id": "SLK",
				"label": "Solok",
				"kdprop": "SMB"
			},
			{
				"id": "SPE",
				"label": "Soppeng",
				"kdprop": "SLS"
			},
			{
				"id": "SRK",
				"label": "Soroako",
				"kdprop": "SLS"
			},
			{
				"id": "SON",
				"label": "Sorong",
				"kdprop": "IRJ"
			},
			{
				"id": "SRA",
				"label": "Sragen",
				"kdprop": "JWH"
			},
			{
				"id": "STB",
				"label": "Stabat",
				"kdprop": "SMU"
			},
			{
				"id": "SUB",
				"label": "Subang",
				"kdprop": "JWB"
			},
			{
				"id": "SKB",
				"label": "Sukabumi",
				"kdprop": "JWB"
			},
			{
				"id": "SKM",
				"label": "Sukamara",
				"kdprop": "KLH"
			},
			{
				"id": "SKH",
				"label": "Sukoharjo",
				"kdprop": "JWH"
			},
			{
				"id": "SBD",
				"label": "Sumba Barat Daya",
				"kdprop": "NTT"
			},
			{
				"id": "SBT",
				"label": "Sumba Tengah",
				"kdprop": "NTT"
			},
			{
				"id": "SBM",
				"label": "Sumba Timur",
				"kdprop": "NTT"
			},
			{
				"id": "SBB",
				"label": "Sumbawa",
				"kdprop": "NTB"
			},
			{
				"id": "SBR",
				"label": "Sumbawa Barat",
				"kdprop": "NTB"
			},
			{
				"id": "SMB",
				"label": "Sumber",
				"kdprop": "JWB"
			},
			{
				"id": "SMD",
				"label": "Sumedang",
				"kdprop": "JWB"
			},
			{
				"id": "SMP",
				"label": "Sumenep",
				"kdprop": "JWT"
			},
			{
				"id": "SGP",
				"label": "Sungai Penuh",
				"kdprop": "JMB"
			},
			{
				"id": "SGL",
				"label": "Sunggal",
				"kdprop": "SMU"
			},
			{
				"id": "SGM",
				"label": "Sungguminasa",
				"kdprop": "SLS"
			},
			{
				"id": "SBY",
				"label": "Surabaya",
				"kdprop": "JWT"
			},
			{
				"id": "SRR",
				"label": "Surakarta",
				"kdprop": "JWH"
			},
			{
				"id": "TBG",
				"label": "Tabalong",
				"kdprop": "KLS"
			},
			{
				"id": "TBN",
				"label": "Tabanan",
				"kdprop": "BLI"
			},
			{
				"id": "THN",
				"label": "Tahuna",
				"kdprop": "SLU"
			},
			{
				"id": "TIS",
				"label": "Tais",
				"kdprop": "BKL"
			},
			{
				"id": "TKL",
				"label": "Takalar",
				"kdprop": "SLS"
			},
			{
				"id": "TKN",
				"label": "Takengon",
				"kdprop": "SMU"
			},
			{
				"id": "TKG",
				"label": "Takengon",
				"kdprop": "DIA"
			},
			{
				"id": "TML",
				"label": "Tamiang Layang",
				"kdprop": "KLH"
			},
			{
				"id": "TTD",
				"label": "Tana Tidung",
				"kdprop": "KLU"
			},
			{
				"id": "TNB",
				"label": "Tanah Bumbu",
				"kdprop": "KLS"
			},
			{
				"id": "TNG",
				"label": "Tanah Grogot",
				"kdprop": "KLT"
			},
			{
				"id": "PLH",
				"label": "Tanah Laut",
				"kdprop": "KLS"
			},
			{
				"id": "TNR",
				"label": "Tanatoraja",
				"kdprop": "SLS"
			},
			{
				"id": "TGR",
				"label": "Tangerang",
				"kdprop": "BAN"
			},
			{
				"id": "TSL",
				"label": "Tangerang Selatan",
				"kdprop": "BAN"
			},
			{
				"id": "TGM",
				"label": "Tanggamus",
				"kdprop": "LPG"
			},
			{
				"id": "TJB",
				"label": "Tanjab Barat",
				"kdprop": "JMB"
			},
			{
				"id": "TJT",
				"label": "Tanjab Timur",
				"kdprop": "JMB"
			},
			{
				"id": "TJG",
				"label": "Tanjung",
				"kdprop": "KLS"
			},
			{
				"id": "TJL",
				"label": "Tanjung Balai",
				"kdprop": "SMU"
			},
			{
				"id": "TBK",
				"label": "Tanjung Balai Karimun",
				"kdprop": "RIU"
			},
			{
				"id": "TKR",
				"label": "Tanjungkarang",
				"kdprop": "LPG"
			},
			{
				"id": "TPI",
				"label": "Tanjungpinang",
				"kdprop": "RIU"
			},
			{
				"id": "TJR",
				"label": "Tanjungredeb",
				"kdprop": "KLT"
			},
			{
				"id": "TJS",
				"label": "Tanjungselor",
				"kdprop": "KLT"
			},
			{
				"id": "TTN",
				"label": "Tapaktuan",
				"kdprop": "DIA"
			},
			{
				"id": "TPS",
				"label": "Tapanuli Selatan",
				"kdprop": "SMU"
			},
			{
				"id": "TP ",
				"label": "Tapanuli Tengah",
				"kdprop": "SMU"
			},
			{
				"id": "TPU",
				"label": "Tapanuli Utara",
				"kdprop": "SMU"
			},
			{
				"id": "TPN",
				"label": "Tapin",
				"kdprop": "KLS"
			},
			{
				"id": "TRK",
				"label": "Tarakan",
				"kdprop": "KLU"
			},
			{
				"id": "TRT",
				"label": "Tarutung",
				"kdprop": "SMU"
			},
			{
				"id": "TSM",
				"label": "Tasikmalaya",
				"kdprop": "JWB"
			},
			{
				"id": "TBT",
				"label": "Tebing Tinggi",
				"kdprop": "SMU"
			},
			{
				"id": "TBO",
				"label": "Tebo",
				"kdprop": "JMB"
			},
			{
				"id": "TGL",
				"label": "Tegal",
				"kdprop": "JWH"
			},
			{
				"id": "TLB",
				"label": "Teluk Bintuni",
				"kdprop": "IRB"
			},
			{
				"id": "TMG",
				"label": "Temanggung",
				"kdprop": "JWH"
			},
			{
				"id": "TBH",
				"label": "Tembilahan",
				"kdprop": "RIU"
			},
			{
				"id": "TGO",
				"label": "Tenggarong",
				"kdprop": "KLT"
			},
			{
				"id": "TNT",
				"label": "Ternate",
				"kdprop": "MLU"
			},
			{
				"id": "TUR",
				"label": "Tiakur",
				"kdprop": "MLK"
			},
			{
				"id": "TDK",
				"label": "Tidore Kepulauan",
				"kdprop": "MLU"
			},
			{
				"id": "TMK",
				"label": "Timika",
				"kdprop": "IRJ"
			},
			{
				"id": "TBS",
				"label": "Toba Samosir",
				"kdprop": "SMU"
			},
			{
				"id": "TUU",
				"label": "Tojo Una-Una",
				"kdprop": "SLH"
			},
			{
				"id": "TLT",
				"label": "Tolitoli",
				"kdprop": "SLH"
			},
			{
				"id": "TMH",
				"label": "Tomohon",
				"kdprop": "SLU"
			},
			{
				"id": "TDN",
				"label": "Tondano",
				"kdprop": "SLU"
			},
			{
				"id": "TNU",
				"label": "Toraja Utara",
				"kdprop": "SLS"
			},
			{
				"id": "TGK",
				"label": "Trenggalek",
				"kdprop": "JWT"
			},
			{
				"id": "TL ",
				"label": "Tual",
				"kdprop": "MLK"
			},
			{
				"id": "TUB",
				"label": "Tuban",
				"kdprop": "JWT"
			},
			{
				"id": "TBW",
				"label": "Tulang Bawang",
				"kdprop": "LPG"
			},
			{
				"id": "TLG",
				"label": "Tulungagung",
				"kdprop": "JWT"
			},
			{
				"id": "UJB",
				"label": "Ujung Berung",
				"kdprop": "JWB"
			},
			{
				"id": "UJP",
				"label": "Ujung Pandang",
				"kdprop": "SLS"
			},
			{
				"id": "UNH",
				"label": "Unaaha",
				"kdprop": "SLG"
			},
			{
				"id": "UNG",
				"label": "Ungaran",
				"kdprop": "JWH"
			},
			{
				"id": "WKB",
				"label": "Waikabubak",
				"kdprop": "NTT"
			},
			{
				"id": "WNP",
				"label": "Waingapu",
				"kdprop": "NTT"
			},
			{
				"id": "WJO",
				"label": "Wajo",
				"kdprop": "SLS"
			},
			{
				"id": "WKT",
				"label": "Wakatobi",
				"kdprop": "SLG"
			},
			{
				"id": "WMN",
				"label": "Wamena",
				"kdprop": "IRJ"
			},
			{
				"id": "WCI",
				"label": "Wanci",
				"kdprop": "SLG"
			},
			{
				"id": "WPN",
				"label": "Watampone",
				"kdprop": "SLS"
			},
			{
				"id": "WSP",
				"label": "Watansoppeng",
				"kdprop": "SLS"
			},
			{
				"id": "WKN",
				"label": "Way Kanan",
				"kdprop": "LPG"
			},
			{
				"id": "WTB",
				"label": "Weetabula",
				"kdprop": "NTT"
			},
			{
				"id": "WNG",
				"label": "Wonogiri",
				"kdprop": "JWH"
			},
			{
				"id": "WNB",
				"label": "Wonosobo",
				"kdprop": "JWH"
			},
			{
				"id": "WNL",
				"label": "Wundulako",
				"kdprop": "SLG"
			},
			{
				"id": "YOG",
				"label": "Yogyakarta",
				"kdprop": "DIY"
			}
		];


        var agamas = [{
            "id": "0",
            "label": "-- pilih --"
        }, {
            "id": "1",
            "label": "ISLAM"
        }, {
            "id": "2",
            "label": "PROTESTAN"
        }, {
            "id": "3",
            "label": "KATHOLIK"
        }, {
            "id": "4",
            "label": "HINDU"
        }, {
            "id": "5",
            "label": "BUDHA"
        }, {
            "id": "6",
            "label": "KONGHUTJU"
        }, {
            "id": "7",
            "label": "ALIRAN KEPERCAYAAN LAIN"
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


        var hobbys = [
			{
				"id": "1",
				"label": "Tinju"
			},
			{
				"id": "2",
				"label": "American Football"
			},
			{
				"id": "3",
				"label": "Badminton / Bulu Tangkis"
			},
			{
				"id": "4",
				"label": "Baseball"
			},
			{
				"id": "5",
				"label": "Bola Basket"
			},
			{
				"id": "6",
				"label": "Bowling"
			},
			{
				"id": "7",
				"label": "Panjat Tebing Dengan Peralatan Keamanan"
			},
			{
				"id": "8",
				"label": "Sepeda Kompetisi"
			},
			{
				"id": "9",
				"label": "Kriket"
			},
			{
				"id": "10",
				"label": "Bersepeda"
			},
			{
				"id": "11",
				"label": "Dansa"
			},
			{
				"id": "12",
				"label": "Akrobatik Lantai"
			},
			{
				"id": "13",
				"label": "Bola Sepak"
			},
			{
				"id": "14",
				"label": "Golf"
			},
			{
				"id": "15",
				"label": "Terjun Akrobatik (Hanya Pada Kolam Renang)"
			},
			{
				"id": "16",
				"label": "Lompat Tinggi"
			},
			{
				"id": "17",
				"label": "Hoki"
			},
			{
				"id": "18",
				"label": "Menunggang Kuda Ringan, Kursus Mengunggang Kuda (Instruktur, Murid)"
			},
			{
				"id": "19",
				"label": "Hoki Es"
			},
			{
				"id": "20",
				"label": "Bola Sepak Dalam Ruangan / Futsal"
			},
			{
				"id": "21",
				"label": "Hoki Dalam Ruangan"
			},
			{
				"id": "22",
				"label": "Jogging / Jalan Santai"
			},
			{
				"id": "23",
				"label": "Judo"
			},
			{
				"id": "24",
				"label": "Karate"
			},
			{
				"id": "25",
				"label": "Kendo"
			},
			{
				"id": "26",
				"label": "Lari Maraton"
			},
			{
				"id": "27",
				"label": "Bersepeda Gunung"
			},
			{
				"id": "28",
				"label": "Berkendara Quad-Bike"
			},
			{
				"id": "29",
				"label": "Arung Jeram"
			},
			{
				"id": "30",
				"label": "Liga Rugby"
			},
			{
				"id": "31",
				"label": "Berlari"
			},
			{
				"id": "32",
				"label": "Scuba/Snorkeling (0 Sampai 20 Meter)"
			},
			{
				"id": "33",
				"label": "Scuba/Snorkeling (21 Sampai 40 Meter)"
			},
			{
				"id": "34",
				"label": "Lompat Ski"
			},
			{
				"id": "35",
				"label": "Sepeda Salju (Skuter, Skidoo)"
			},
			{
				"id": "36",
				"label": "Tenis Dinding"
			},
			{
				"id": "37",
				"label": "Selancar Air"
			},
			{
				"id": "38",
				"label": "Berenang"
			},
			{
				"id": "39",
				"label": "Tenis Meja"
			},
			{
				"id": "40",
				"label": "Tenis Lapangan"
			},
			{
				"id": "41",
				"label": "Thai Boxing"
			},
			{
				"id": "42",
				"label": "Trampolin"
			},
			{
				"id": "43",
				"label": "Pendakian"
			},
			{
				"id": "44",
				"label": "Triathlon (Kobinasi Renang, Balap Sepeda, Dan Lari Secara Berurutan)"
			},
			{
				"id": "45",
				"label": "Bola Voli"
			},
			{
				"id": "46",
				"label": "Selancar Angin"
			},
			{
				"id": "47",
				"label": "Gulat"
			}
		];

        var jmlTertanggungTambahans = [{
            'id': '0',
            'label': 'Tidak Ada'
        }, {
            'id': '1',
            'label': '1 Orang'
        }, {
            'id': '2',
            'label': '2 orang'
        }, {
            'id': '3',
            'label': '3 orang'
        }, {
            'id': '4',
            'label': '4 orang'
        }];

        var objToArrays = function(_Object) {
            var _Array = new Array();
            for (var name in _Object) {
                _Array[name] = _Object[name];
            }
            return _Array;
        }

        var objToArray = function(obj) {
            return objToArrays(obj);
        }
        var getPctUnitlinkGuardians = function() {
            return pctUnitlinkGuardians;
        }
        var getJenisJsProteksiKeluargas = function() {
            return jenisJsProteksiKeluargas;
        }
        var getHobbys = function() {
            return hobbys;
        }
        var getjenisFunds = function() {
            return jenisFunds;
        }
        var getRangeGajis = function() {
            return rangeGajis;
        }
		var getAlasanWajibPajakLuarNegeris = function() {
			return alasanWajibPajakLuarNegeris;
		}
		var getHubunganDenganPempols = function() {
			return hubungandenganpempols;
		}
        var getHubunganKeluargas = function() {
            return hubungankeluargas;
        }
		var getJenisPendapatans = function() {
            return jenisPenghasilan;
        }
        var getTipeDokumens = function() {
            return tipedokumens;
        };
        var getBayarBerikutnyas = function() {
            return bayarberikutnyas;
        };
        var getJenisAsuransis = function() {
            return jeniasuransis;
        };
        var getCaraBayars = function() {
            return carabayars;
        };
        var getJenisPerusahaans = function() {
            return jenisperusahaans;
        };
        var getKelasPekerjaans = function() {
            return kelaspekerjaans;
        };
        var getPekerjaans = function() {
            return pekerjaans;
        };
        var getPangkats = function() {
            return pangkats;
        };
        var getStatusNikahs = function() {
            return statusnikahs;
        };
        var getPendidikans = function() {
            return pendidikans;
        };
        var getStatusTempatTinggals = function() {
            return statustinggals;
        };
        var getPovinsis = function() {
            return provinsis;
        };
        var getKabupatens = function() {
            return kabupatens;
        };
        var getGenders = function() {
            return genders;
        };
        var addProduct = function(newObj) {
            productList.push(newObj);
        };
        var getProducts = function() {
            return productList;
        };
        var getAgamas = function() {
            return agamas;
        };
        var getSpajGUID = function() {
            return getSpajGUID();
        };
        var getJmlTertanggungTambahan = function() {
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
			getHubunganDenganPempols: getHubunganDenganPempols,
            getHubunganKeluargas: getHubunganKeluargas,
			getJenisPendapatans: getJenisPendapatans,
            getRangeGajis: getRangeGajis,
			getAlasanWajibPajakLuarNegeris: getAlasanWajibPajakLuarNegeris,
            getjenisFunds: getjenisFunds,
            getJenisJsProteksiKeluargas: getJenisJsProteksiKeluargas,
            getPctUnitlinkGuardians: getPctUnitlinkGuardians,
            toArray: objToArray,
        };
    }
]).service('BlankService', [
    function() {}
]);