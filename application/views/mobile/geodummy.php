<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
    <head> 
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
        <title>Jiwasraya Check In</title> 

        <!--script src="js/gmap3.js"></script-->
    <!--script type="text/javascript" src="scripts/downloadxml.js"></script-->
    <style type="text/css">
    html, body { height: 100%; margin:0;padding:0;} 
        #map_canvas {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            position: absolute;
            left: 0;
            top: 0;
            z-index: 0;
        }

        #pac-input{
            position:relative;
            padding:6px;
			left:-20px;
			margin-top:12px;
            min-width:50px;
            width:50%;
        }
		
		.btn-file {
		  position: relative;
		  overflow: hidden;
		}
		.btn-file input[type=file] {
		  position: absolute;
		  top: 0;
		  right: 0;
		  min-width: 100%;
		  min-height: 100%;
		  font-size: 100px;
		  text-align: right;
		  filter: alpha(opacity=0);
		  opacity: 0;
		  background: red;
		  cursor: inherit;
		  display: block;
		}
		input[readonly] {
		  background-color: white !important;
		  cursor: text !important;
		}
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
	width:20px;
}
.fileUpload input.upload {
    position: relative;
	height:auto;
	width:25px;
    top: 0px;
    left: -10px;
    margin: 0;
    padding: 0;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
	display:inline;
}
.gotoMarker{
	color:navy;
	font-weight:bolder;
	cursor:crosshair;
	background-color:#DEDEFF;
}
    </style>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<script src="../../../asset/js/jquery-min.js"></script>
		<script type="text/javascript" src="../../../asset/js/gmaps-x.js"></script> 
        
		<script src="../../../asset/js/bootstrap.min.js"></script>
        <!--script src="js/gmaps.js"></script-->
        <script src="../../../asset/js/jquery.storageapi.min.js"></script>
        <!--script src="js/jquery.base64.min.js"></script-->
        <script src="../../../asset/js/xBase64.js"></script>
        <script src="../../../asset/js/jquery.jcanvas.min.js"></script>
        <script src="../../../asset/js/html2canvas.js"></script>
		
		
<script type="text/javascript">
    //<![CDATA[

    // global "map" variable
	
	var idAgen = "";
    
	var mapstatus = false;
	var gg = '';
    var myData = null;
	var imgEmbed = null;
	var ft = null;
    var map = null;
    var marker = null;
    var latlngstring = null;
    var latlngg = null;
    var markers = [];
    var storage = $.localStorage;
    var fdata = null;
    var internetState = null;
    var mapp = null;
    var lati = '';
    var longi = '';
    var myOptions = null;
	var dt = null;
	var mimeImgUpload = null;
	var checkinDate = null;
    var infowindow = new google.maps.InfoWindow({
        size: new google.maps.Size(150, 50)
    });
	var ada = false;
	var reversedGeoloc = null;
	var resGeo = null; 
	var addr = "";
	var xdata = null;
			var check_connectivity = {
			is_internet_connected: function() {
				return $.ajax({
					url: "http://jaim.jiwasraya.co.id/mobileapi/",
					dataType: 'text',
					cache: false
				});
			}
			,get_client_ip: function(){
				   return $.getJSON('http://jsonip.com/?callback=?', function(r){ 
						ip = r.ip;
				   });
			}			
			,get_reverse_geoloc: function(latlngstring){
				return $.ajax({
					url: 'http://maps.google.com/maps/api/geocode/json?address='+latlngstring+'&sensor=false',
					dataType: 'json',
					cache: false
				});
			}
		};

		var filenameupload = generateUUID();


		
		function getDate(){
			var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();
			var hh = d.getHours();
			var mm = d.getMinutes();
			var ss = d.getSeconds();

			var output = d.getFullYear() + '/' +
				((''+month).length<2 ? '0' : '') + month + '/' +
				((''+day).length<2 ? '0' : '') + day + ' ' 
				+ ((''+hh).length<2 ? '0' : '') + hh +':'
				+ ((''+mm).length<2 ? '0' : '') + mm +':'
				+ ((''+ss).length<2 ? '0' : '') + ss +'';
				
			
				checkinDate = output
		
		}
		
function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}
    // A function to create the marker and set up the event window function 
    function createMarker(latlng, name, html) {
        var contentString = html;
		var image = 'images/gmap_pin.png';
        marker = new google.maps.Marker({
            position: latlng,
            map: map,
			icon: image,
            zIndex: Math.round(latlng.lat() * -100000) << 5
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(contentString);
            infowindow.open(map, marker);
        });
        google.maps.event.trigger(marker, 'click');
		
		$('#nm').val(addr);
		
        return marker;
    }

    function getQueryParam(param) {
        location.search.substr(1)
            .split("&")
            .some(function(item) { // returns first occurence and stops
                return item.split("=")[0] == param && (param = item.split("=")[1])
            })
        return param
    }

	var timer = 5000;
	
	var asyncPost = function asyncPostHandler(){
		hasInternet();
		if(internetState){
			$.each(storage.keys(), function(key, val) {
				try {
					if(val.match(/CHECKIN::/i) != null){
						ft = storage.get(val);
						xdata = XBase64.decode(ft);
						xdata = JSON.parse(xdata);
						//detect if is new data to be upload
						if(xdata.status=="new"){ //upload if new and update status  if sucseed
							datatosend = JSON.stringify(xdata);
							if(sendData(datatosend,filenameupload)){
								xdata.status = "uploaded"
							}
							savePlace(val,xdata); //overwrite data with status uploaded
							showSavedPlaces();
						}
					}
				}
				catch (err){
						console.log(err);
				}
			});
		}
		setTimeout(asyncPost,  timer);
	}
	setTimeout(asyncPost,  100);

	function sendData(datax,filename){
			
	}
		
		
    function hasInternet() {
		check_connectivity.is_internet_connected().done(function() {
			//console.log('OK: internet');
				internetState = true;
			})
		.fail(function(jqXHR, textStatus, errorThrown) {
				console.log('ERR: no internet');
				internetState = false;
		});
    }


    function mapMarker(map) {
        google.maps.event.addListener(map, 'click', function() {
            infowindow.close();
        });

        google.maps.event.addListener(map, 'click', function(event) {
				if (marker) {
					marker.setMap(null);
					marker = null;
				}
				latlngstring = parseFloat(event.latLng.lat()).toFixed(4);
				latlngstring += ',' + parseFloat(event.latLng.lng()).toFixed(4);
				$("#coord").val(latlngstring);
				
			check_connectivity.get_reverse_geoloc(latlngstring).done(
			 function(dt) {
					resGeo = dt.results[0];
					
					$('#nm').val(resGeo.formatted_address);
					$('#pac-input').val(resGeo.formatted_address);
					$('textarea').val('');
				}
			);
			try{
				addr = resGeo.formatted_address;
				 marker = createMarker(event.latLng, "name", "<b>Lokasi</b><br>" + latlngstring);
			}catch(e){
				addr = "";
			}
		});
    }
	
	function generateUUID() {
			var d = new Date().getTime();
			if(window.performance && typeof window.performance.now === "function"){
				d += performance.now();; //use high-precision timer if available
			}
			var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
				var r = (d + Math.random()*16)%16 | 0;
				d = Math.floor(d/16);
				return (c=='x' ? r : (r&0x3|0x8)).toString(16);
			});
			return uuid;
		};
		
	var type = (function(global) {
		var cache = {};
		return function(obj) {
			var key;
			return obj === null ? 'null' // null
				: obj === global ? 'global' // window in browser or global in nodejs
				: (key = typeof obj) !== 'object' ? key // basic: string, boolean, number, undefined, function
				: obj.nodeType ? 'object' // DOM element
				: cache[key = ({}).toString.call(obj)] // cached. date, regexp, error, object, array, math
				|| (cache[key] = key.slice(8, -1).toLowerCase()); // get XXXX from [object XXXX], and cache it
		};
	}(this));

	function init_map(myOptions){
	        map = new google.maps.Map(
            document.getElementById("map_canvas"),
            myOptions);
			
			mapMarker(map);

        // Create the search box and link it to the UI element.
        $('#pac-input').show();


	}
	
    function initialize(myOptions) {
		if(internetState == false){
			alert('Maaf. Gadget anda tidak terkoneksi internet.');
			history.go(-1)
			return false;
		}
                // create the map

		init_map(myOptions);

		        var input = /** @type {HTMLInputElement} */ (
            document.getElementById('pac-input'));
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		
		        var searchBox = new google.maps.places.SearchBox(
            /** @type {HTMLInputElement} */
            (input));
        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);



        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();

            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }

            // For each place, get the icon, place name, and location.
            //http://stackoverflow.com/questions/21412111/how-to-add-a-googlemap-search-box-to-my-customized-map
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            var place = null;
            var viewport = null;
            for (var i = 0; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                var marker = new google.maps.Marker({
                    map: map,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location
                });
                viewport = place.geometry.viewport;
                markers.push(marker);

                bounds.extend(place.geometry.location);
            }
            map.setCenter(bounds.getCenter());
        });
        

    }
    //https://github.com/julien-maurel/jQuery-Storage-API
    function createStorageElement() {
        return storage.set('checkindata', true)
    }

    function savePlace(key, data) {
			dtf = JSON.stringify(data);
			storage.set(key,XBase64.encode(dtf));
			clearCanvas('canvasPreview');
    }   
	
	function removePlace(key) {
			storage.remove(key);
			showSavedPlaces();
			return true;
    }

    function showSavedPlaces() {
        var str = "";
		var t = 0;
		
		var kyearray = storage.keys();
		
        $.each(kyearray, function(key, val) {
		(t%2==0)?bgRow = 'background-color:#f0f0ff;':bgRow = 'background-color:white;';
            ft = storage.get(val);
			try{
				if(dr = XBase64.decode(ft)){
					myData = JSON.parse(dr);
				} else {
					myData = ft;
				}

			var imgStatus = null;
			if(type(myData) == 'object'){
				if ((val.match(/CHECKIN::/i) != null)) 
				{
					if(myData.status == 'new'){
						imgStatus = "src='images/uploading.gif'";
					} else {
						imgStatus = "src='images/success.png'";
					}
				
					 val = val.replace('CHECKIN::','');
					 lnd = myData.lat+','+ myData.lng;
					 strBase = XBase64.decode(myData.pict);
					 
					str += '<tr style="'+bgRow+'"><td width="20px" style="text-align:center;"><img style="width:80px;" src="'+strBase+'"/>'
					+ '<img ' + imgStatus + '  style="width:16px;height:16px;" />'
					+'</td> <td valign="center"><b>' 
						+ myData.address + '</b><br /><img src="images/globe_pin.png" style="width:16px;height:16px;"/> <span class="gotoMarker" onClick="javascript:gotoMark(\''+ lnd +'\',map,\''+myData.address+'\',\'' + strBase + '\')">' 
						+ lnd + '</span> '
						+'<br /><img src="images/icon-calendar.png" style="width:16px;height:16px;"/> <span class="gotoMarker" > '+ myData.checkinDate
						+'</span></td>' 
						+ '<td valign="center">'
						+ '<button type="button" id="delo" style="position:relative;top:20px;" '
						+'class="removeRow btn btn-default">'
						+'	<input type="hidden" value="'+myData.filenameupload+'" class="rowValue" />'
						+'<span class="glyphicon glyphicon-remove" aria-hidden="true" style="top:3px;color:maroon;position:relative;"></span>'
						+'</button>'
						+ '</td>'
					str += '</tr>'
				
					ada = true;
					
				} else {
					ada = false;
				}
			}

			} catch (err){
				
			}
		t++;
        })
		 $('#myPlacesRow').html('');
		if(ada){
			
			$('#myPlacesRow').append(str);
		}else{
			str = '<tr><td>Tidak ada data checkin.<td></tr>';
			$('#myPlacesRow').append(str);
		}
       
        

    }

	function clearCanvas(canvasId){
		var canvas = document.getElementById(canvasId);
		var context = canvas.getContext("2d");
			context.clearRect(0, 0, canvas.width, canvas.height);
	}
	
	function putImageOnCanvas(pict,cnv){
		$('#'+cnv).show();
		var canvas = document.getElementById(cnv);
		var ctx = canvas.getContext("2d");
		
			canvas.width = 600;
			canvas.height = 800;
			
			canvas.style.width  = '300';

		img = new Image();
		img.onload = function () {

			canvas.height = canvas.width * (img.height / img.width);

			/// step 1
			var oc = document.createElement('canvas'),
				octx = oc.getContext('2d');
			oc.width = img.width * 0.7;
			oc.height = img.height * 0.7;
			octx.drawImage(img, 0, 0, oc.width, oc.height);

			/// step 2
			octx.drawImage(oc, 0, 0, oc.width * 0.7, oc.height * 0.7);

			ctx.drawImage(oc, 0, 0, oc.width * 0.7, oc.height * 0.7, 0, 0, canvas.width, canvas.height);
		}
		img.src = pict;
	}

    function theState() {
        if (ada==false) {
            //$('#myPlaces').hide();
			$('#btd').hide();
        } else {
            //$('#myPlaces').show();
            $('#btd').show();
        }
        $('#nm').val('');
        return true;
    }
	

	
	function readURL(input) {
        if (input.files && input.files[0]) {
		mimeImgUpload = input.files[0].type;
            var reader = new FileReader();
            reader.onload = function (e) {
				putImageOnCanvas(e.target.result,'canvasPreview');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

	function actRemoveRow(id){
		if(confirm('Yakin akan menghapus data '+id+'?\n\n\n*)Data Anda akan masih tersimpan sebagai historikal di sistem keagenan (JAiM)')){
			 removePlace('CHECKIN::'+id);
		}
	}
	
	function gotoMark(str,map,strNm,imgStr){
		
		var image = 'images/gmap_pin.png';
		var infowindow = new google.maps.InfoWindow({
			content: '<img style="width:40px;height:25px;" src="'+imgStr+'"/><br /><strong>'+strNm+'</strong>'
			,maxWidth: 200
		});
		
		setMapOnAll(map);
		
		result = str.split(',');
		map.setCenter(new google.maps.LatLng(result[0], result[1]));
		
		var markerx = new google.maps.Marker({
			position: new google.maps.LatLng(result[0], result[1]),
			map: map,
			icon: image,
			animation: google.maps.Animation.DROP,
			title: strNm,
			infowindow
		  });

		  infowindow.open(map,markerx);
		  delayclose(markerx);
		$('#nm').val(strNm);
		
		map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
		map.setZoom(13);
		mapstatus = false;
		$('#contentModal').modal('hide');
	}
	
	function delayclose(marker){
		var bclose = function(){
			marker.infowindow.close();
		}
		setTimeout(bclose,  6000);
	}
	
	function setMapOnAll(map) {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	  }
	}

			
		  function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

    $(document).ready(function() {

		if(storage.get('IDAGEN') != '' && storage.get('IDAGEN')!='idagen' && isNumeric(storage.get('IDAGEN'))){
				idAgen = storage.get('IDAGEN');
		}else{
			alert('Autentikasi gagal!');
			window.location.href = "index.html";
			//return false;
		}
	
		$('#addPlace').click(function() {
				var cnv = $('#canvasPreview');
				
					if(cnv.is(":visible") ){
						imgEmbed = cnv.getCanvasImage('jpeg',0.7);
					} else {
						imgEmbed = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAYEBQYFBAYGBQYHBwYICh"
						+"AKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhY"
						+"aKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wAARCAEsASwDASIAAhEBA"
						+"xEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMU"
						+"EGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZ"
						+"naGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4"
						+"+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFB"
						+"AQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERU"
						+"ZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsP"
						+"ExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD6koooqrkhRRRRcAoooouAUUUUX"
						+"AKKKKLgFFFFFwCiiii4BRRRRcAoooouAUUUUXAKaacaa1AEMvSsrUeYzWpN0rMvBlaaJZxmqxsSa5e7ibzDXdX0QOa"
						+"5+9thyQK6aczlqQOdxg809TT7iFg/SoeQea6EznasWFNOqJWqQGmIWigUtACUUtFACUUtFACV1Ol/8eaVyxrqdL/48"
						+"0rOpsaU9z0uiiiuA9EKKKKACiiigAoppdR1NRvcxL1cCna4rolLAd6QyKO9Z09/CP8AloKpS6nEOjitFSbM3VSN3zV"
						+"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"
					}
				
					var name = $('#nm').val();
					var latln = $('#coord').val();

					if (name == "") {
						alert('Anda harus mengisi nama tempat');
						return false;
					}

					if (latlngstring != null) {
						//do add
						result = latlngstring.split(',');
						filenameupload = generateUUID();
						dt = {	'idagen':idAgen
								,'filenameupload':filenameupload
								,'address':name
								,'lat':result[0]
								,'lng':result[1]
								,'status': 'new'
								,'dataType': 'CHECKIN'
								,'checkinDate': checkinDate
								,'notes': $('textarea').val()
								,'pict':XBase64.encode(imgEmbed)
								,'mime': mimeImgUpload
							};
							
							//console.log(dt);
							
						var key = 'CHECKIN::'+filenameupload;
						
						if (storage.isEmpty('checkindata')) {
							createStorageElement();

							savePlace(key, dt);
							theState();
							showSavedPlaces();

						} else {

							savePlace(key, dt);
							theState();
							showSavedPlaces();

						}
						
						$("#canvasPreview").hide();
						$('#contentModal').modal('show');

					} else {
						alert("Anda belum memilih lokasi");
					}
					
					$('#contentFormCheckin').modal('hide');
				});

	getDate();
	
		$(document).on("click",'.removeRow', function(){
			id = $(this).find('input').val();
			//console.log(id);
			actRemoveRow(id);
		});

		$('#btMyCheckin').on('click',function(e){
			$('#contentModal').modal('show');
			e.preventDefault();
		});
		
		$("#addPhoto").change(function(){
		imgEmbed = null;
			readURL(this);
			
		});
		
        myOptions = {
            zoom: 14,
            center: new google.maps.LatLng(-6.1814, 106.8271),
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            navigationControl: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        initialize(myOptions);

        showSavedPlaces();

        theState()

        $('#delStorage').click(function() {
            if (confirm('Yakin akan menghapus semua data check in?\n\n\n*)Data checkin Anda masih akan tersimpan di sistem keagenan (JAiM)')) {
				dkey = storage.keys();
				
				$.each(dkey, function(key, val) {
					try {
						if(val.match(/CHECKIN::/i) != null){
							storage.remove(val);
						}
					}
					catch (err){
							console.log(err);
					}
				});

				ada = false;
                theState();
                showSavedPlaces();

            } else {
				return false;
			}
        });

		
		$('#btnCheckin').click(function(){
			$('#contentFormCheckin').modal('show');
		})


        $('#myLocation').click(function() {
			$('#pac-input').val('');
			$('#nm').val('');
			mapstatus = true;
			image = 'images/gmap_pin.png';
			var myloc = new google.maps.Marker({
				clickable: false,
				icon: image,
				shadow: null,
				zIndex: 999,
				map: map
			});

			if (navigator.geolocation) navigator.geolocation.getCurrentPosition(function(pos) {
				var me = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
				myloc.setPosition(me);
				map.setCenter(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
				map.setZoom(16);
				latlngstring = pos.coords.latitude+','+ pos.coords.longitude;
				$('textarea').val('');
			}, function(error) {
			
			});
			
			check_connectivity.get_reverse_geoloc(latlngstring).done(
				function(dt) {
					resGeo = dt.results[0];
					$('#nm').val(resGeo.formatted_address);
					$('#pac-input').val(resGeo.formatted_address);
				}
			);
        });
    });

    //]]>
</script>

      </head> 
    <body style="" onload="" bgcolor="#436EB3" style="background-color:#436EB3;"> 
        <div class="container" style="background-color:#436EB3;padding:0;">

            <!--div class="info">
                <h2 class="bg-primary">JS Check Me In</h2>
            </div-->
            
            <div class="col-md-16 content" style="background-color:#436EB3">
                <table class="table table-striped" style="background-color:#436EB3">
                    <thead>
                        <th><div style="text-align:right;">
						
						<button id="btMyCheckin" class="btn btn-default"  
							style="position:relative;"   >
						
							<span class="glyphicon glyphicon-list" style="color:#436EB3" aria-hidden="true"></span> 
								<b style="color:#436EB3" >DAFTAR CHECKIN</b> 
						</button>
							<button type="button" id="myLocation" style="color:#436EB3" class="btn btn-default"  
							style="position:relative;"  >
								<span class="glyphicon glyphicon-screenshot" style="color:#436EB3" aria-hidden="true"></span> 
								<b style="color:#436EB3" >LOKASI KU</b> 
							</button>
							</div>
						</th>
                    </thead>
                    <tbody>
                        <tr> 
                            <td style="padding:0;"> 
                                <div id="map_canvas" style="padding:0;margin:0;width:99%;min-width: 300px;
									min-height: 455px;height:100%;max-height:1000px;
									margin: 0;
									padding: 0;position: relative;">
                                </div> 
                            </td> 
                        </tr> 
                        <tr>
                            <td style="text-align:center;">
								<button id="btnCheckin"  class="btn btn-default">
									<span class="glyphicon glyphicon-flag" style="font-weight:bolder;color:#436EB3;
									font-size:1.4em;" aria-hidden="true"></span>
									<span style="color:#436EB3font-weight:bolder;font-family:arial;font-size:1em;">
									CHECK IN
									</span>
								</button><br>
								<span style="color:white;font-weight:bolder;font-family:arial;font-size:.9em;">
									<sub>*) Tap pada peta untuk mendapatkan alamat</sub>
								</span>
                            </td>
                        </tr>                
                    </tbody>
                </table>
            </div>  
			<input type="text"  id="pac-input" style="display: none" placeholder="Cari lokasi" />
        <!-- you can use tables or divs for the overall layout --> 
		
		
		
     
        <noscript><p><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
          However, it seems JavaScript is either disabled or not supported by your browser. 
          To view Google Maps, enable JavaScript by changing your browser options, and then 
          try again.</p>
        </noscript> 

		<div id="contentFormCheckin"  style="padding:6px;" class="modal fade" role="dialog">	
			<div class="modal-dialog"  style="padding:6px;">
					<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Check in</h4>
				  </div><form id="myform" enctype='multipart/form-data' style="display:inline;" >
					<div class="modal-body" style="">	
						
							<input  id="nm" class="form-control" 
							style="width:100%;display:inline;z-index:99999;" placeholder="Nama Tempat" />
							<input type="hidden" id="coord" /><br />Notes:<br />
								<textarea class="form-control" name="notes"></textarea>
							<br /><center>
					<canvas style="display:none;padding-top:8px;width:300px;" id="canvasPreview"></canvas>
					</center>
					</div>
					
					<div class="modal-footer" style="background:white;padding:6px;">
						
						<div class="fileUpload btn btn-primary" style="display:inline;width:20px;height:24px;" >
								<span class="glyphicon glyphicon-camera" aria-hidden="true" style="position:relative;left:15px;"></span>
								<input style="" type="file" class="upload" accept="image/*" id="addPhoto"/>
						</div>
						<button class="btn " style="display:inline;" type="button" id="addPlace" 
							placeholder="Tambahkan" >
							<span style="color:teal;font-size:1.2em;" class="glyphicon glyphicon-upload" 
								aria-hidden="true"> <span style="font-family:arial;position:relative;left:-10px;">KIRIM</span>
							</span>
						</button>   
					</div></form>	
				</div>
			</div>
		</div>		
		
		<div id="contentModal"  style="padding:6px;" class="modal fade" role="dialog">	
			<div class="modal-dialog"  style="padding:6px;">
					<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Daftar Checkin</h4>
				  </div>
					<div class="modal-body" style="padding:0px;">	
						<div style="width:100%;max-height:400px;overflow-y:auto;overflow-x:none">
							<table class="table" id="myPlaces">
								<tbody style="max-height:400px;" id="myPlacesRow">
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="modal-footer" style="background:white;padding:6px;">
							<button id="delStorage" class="btn btn-default" style="font-weight:bolder;">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> 
										
							</button>								

						<button type="button"  class="btn btn-info dismiss-close" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>
     
	 
	 </div>
	 
	 
      </body> 
    </html> 
