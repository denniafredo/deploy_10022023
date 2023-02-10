angular.module('app.controllers', [])

 //////////// PAGE 1
.controller('dataTertanggung13Ctrl', 
	['$scope',
	'$state', 
	'$stateParams', 
	'dataFactory', 
	'spajProvider', 
	'$ionicPopup',
	'syncService',
	'$store', 
function ($scope,$state, $stateParams, dataFactory, spajProvider,$ionicPopup,syncService,$store) {
    $scope.data = null;
	$scope.pageId = 'aplikasiSPAJOnline.dataTertanggung13';
	$scope.genders = dataFactory.getGenders();
    $scope.agamas = dataFactory.getAgamas();
	$scope.spaj_guid = $stateParams.spaj_guid;
	
	//console.log($scope.spaj_guid);
	
	$scope.imgDokumenKtp = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAMAUExURQAAAAEBAQICAgMDAwQEBAUFBQYGBgcHBwkJCQoKCgwMDA0NDQ8PDxAQEBQUFBUVFRYWFhsbGxwcHB0dHSEhISMjIyUlJScnJygoKCsrKywsLC8vLzExMTIyMjMzMzc3Nzg4ODk5OTw8PD09PT4+PkBAQEJCQkZGRkdHR0hISElJSUtLS05OTlJSUlRUVFhYWFlZWVxcXGJiYmdnZ2lpaWpqanFxcXJycnZ2dnd3d3h4eHp6ent7e319fX5+fn9/f4CAgISEhIaGhouLi4yMjI2NjZCQkJKSkpSUlJeXl5ubm5+fn6Kioqqqqqurq62tra6urrCwsLOzs7S0tLa2tre3t7m5ubu7u7y8vL29vb+/v8DAwMLCwsbGxsnJycrKyszMzM3Nzc7Ozs/Pz9DQ0NPT09XV1dbW1tfX19nZ2dra2t/f3+Dg4OHh4eLi4uPj4+Tk5OXl5ebm5ujo6Ovr6+zs7O3t7e7u7u/v7/Dw8PHx8fLy8vPz8/b29vf39/j4+Pn5+fr6+vv7+/z8/P39/f7+/v///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACk7lOwAAAEAdFJOU////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////wBT9wclAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAAGHRFWHRTb2Z0d2FyZQBwYWludC5uZXQgNC4wLjb8jGPfAAADAUlEQVR4Xu2a+VsSURSGDwWSSxDZvltpqZXtVqa2WlnaYoVp2WIrqVFpi1Jq5vzbxDDfOBd4mAvMnSvP03l/knPOzPd64ZkNKL3KsAALsAALsAALsAALsAALsAALsECOQCqphTnEZXEEkuc3B0kLwU2dEwgVBG7Voq2F8HXErghcM8t1sUYNxOrNrB4EQ+BDZvV3D/82tDA/0pR5H8atZAhcINqvKd5kqY3otJUMgXai+2hq4SnRQSsZAq1ET9DTwhuiA1YyC7AAC1S3wOzUZPIP/lZLKQKzfXtqiAL1x+N/UVFICQIDUfOclaVlEjV1SAWWexCeZcMLlJUhFehDNIhMoK4KmcD7MJJtWtBQhUzgGHId4ugoQiLwNYRYh6NoZTmyrlIasQeJwABSBaLi8eAwiuUTwR4kApcwLhCYQ8/Ed4EujIvMomfiu0A3xkXEFXj5uFJGsAeJwG2ECjQsoKcGiUBiDWIdmtFShETA2IdYhzvoKEImMIzYFbYtoaMImYBxCsEg/Ax1VUgF5jO3Sg41gyiDV3EpvzBaBKmAsdjpfBBjwyjalHAc+IjRIsgFDGO8o8HcU2DLFfEQkEWPQGYVxoaGHn1axisB/wUSY3k8F4/ExomNUpIYLYK7wOgu/BsCoZPf0FWCq8C9tQjNZesM+ipwE/hch8R8OjCgAjeBnOthkaDCK1M3gcLzgE0/JhTgJhBBXCG9mFBAZQLdmDC62ypBXECPApVdkp3F1iYs4FFg8Gol2BekJh4FvMMCLOBRYHqqXBaxpY1HgdZAubzDljYeBco/EL3FljZVLRDFqhXSgwmf34KfP4qx8q1WCoXSyb+1dBPQAguwAAtUn0A70V30tDBK1GwlQ6CLqEnyWEclC4eIzljJEEiEiHY+KHgW4w+ph3szt7qvrWQIpG8GMuesYENEA+vN38oELiPYFkj3F3ss4Au1NxDrCKS/XNyR/02RT9RsPzeJUFHA5Pu0BmYQZpErsAqwAAuwAAuwAAuwAAuwAAuwAAv87wLp9D9ysle2TASfAwAAAABJRU5ErkJggg==';
	$scope.imgDokumenKtpChanged = false;
	$scope.tglLahirTertanggung = '';new Date('10/10/1990');
	
//INIT FORM 
	$scope.$on('$ionicView.enter', function() {
		$scope.init_data();

		if($scope.spaj_guid == 'new'){
			newGuid = spajProvider.genSpajGUID();
			spajProvider.setSpajGUID(newGuid);
			$scope.data.spaj_guid = newGuid;
		}

		$scope.init_display();
	});
	
	
	$scope.init_display = function(){
		return true;
	};
	
	$scope.init_data = function(){
		$scope.data = {
			'spaj_guid': (spajProvider.getSpajGUID()==null||spajProvider.getSpajGUID()=='')?spajProvider.genSpajGUID():spajProvider.getSpajGUID(),
			'isPageTertanggung1Accepted': false,
			'agamaTertanggung':	$scope.agamas[0].id,
			'jenkelTertanggung': $scope.genders[0].id,
			'namaLengkapTertanggung': '',
			'nomorKTPTertanggung':'',
			'tglLahirTertanggung':$scope.tglLahirTertanggung,
			'nomorNPWPTertanggung':'',
			'tglLahirPempol':'',
			'imageKTPTertanggung': null
		}
		
		$scope.imgDokumenKtpChanged = false;
		spajProvider.putImageTo('canvasKTP',$scope.imgDokumenKtp);
			if($scope.spaj_guid == 'new'){

					console.log(spajProvider.getSpajGUID())
					//$scope.init_data();
				
				} else if($scope.spaj_guid == '' && spajProvider.getSpajGUID() !=''){
					spajProvider.setSpajGUID(spajProvider.getSpajGUID());
					$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
						try{
							decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.data.imageKTPTertanggung));
						}catch(e){
							decodedImage = '';
						}
					spajProvider.putImageTo('canvasKTP',decodedImage);
					
					$scope.data.tglLahirTertanggung = new Date($scope.data.tglLahirTertanggung);
					
					$scope.imgDokumenKtp = decodedImage;
					$scope.imgDokumenKtpChanged = true;
					
				} else {

					spajProvider.setSpajGUID($scope.spaj_guid);
					
					$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
					
					var decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.data.imageKTPTertanggung));
					$scope.data.tglLahirTertanggung = new Date($scope.data.tglLahirTertanggung);

					if(spajProvider.putImageTo('canvasKTP',decodedImage)){
						$scope.imgDokumenKtpChanged = true;
					}
					
					$scope.imgDokumenKtp = decodedImage;
					$scope.imgDokumenKtpChanged = true;
				}
	}

	$scope.validateThisFormOnPageAccept = function(){
		//validate datanya
		$scope.messages = [];
		try{
			if($scope.data == null){
				$scope.messages.push({"message":"Data ERROR. Null data."});
			}
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. "+e}) ;
		}
		
		//validate nama, NOMOR KTP NPWP
		try{
			tryMe = $scope.data.namaLengkapTertanggung;
			if($scope.data.namaLengkapTertanggung == '' && !(tryMe.match(/^[a-z\d\-_\s]+$/i)) ){
				$scope.messages.push({'message':"Nama Tertanggung harus benar!"}) ;
			}
			tryMe = $scope.data.nomorKTPTertanggung;
			if($scope.data.nomorKTPTertanggung == '' && !(tryMe.match(/^\d+$/)) ){
				$scope.messages.push({'message':"Nomor KTP harus benar!"}) ;
			}
			tryMe = $scope.data.nomorNPWPTertanggung;
			if($scope.data.nomorNPWPTertanggung == '' && !(tryMe.match(/^\d+$/)) ){
				$scope.messages.push({'message':"Nomor KTP harus benar!"}) ;
			}
			tryMe = $scope.data.tglLahirTertanggung;
			//console.log($scope.data.tglLahirTertanggung);
			if('' == tryMe){
				$scope.messages.push({'message':"Masukkan tanggal lahir"});
			}			
			tryMe = $scope.data.jenkelTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Silahkan Pilih Jenis kelamin"});
			}			
			tryMe = $scope.data.agamaTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Silahkan Pilih Agama"});
			}
			
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. " + e}) ;
		}
		
		if(!$scope.imgDokumenKtpChanged){
			$scope.messages.push({'message':"Silahkan foto KTP Tertanggung"}) ;
		}
		
		
		
		
		if($scope.messages.length > 0){
			return $scope.messages;
		} 
		return false;
		
	}
	


	$scope.changeImage = function(){
		spajProvider.takePict(this,'canvasKTP');
		$scope.data.imageKTPTertanggung = spajProvider.getImageBase64('canvasKTP','jpg');
		
		$scope.imgDokumenKtpChanged = true;
		
		$scope.data.isPageTertanggung1Accepted = false;
	}
	
    $scope.saveDataSpaj = function(){
		
        $scope.data.imageKTPTertanggung = spajProvider.getImageBase64('canvasKTP','jpg');
		
		
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.dataTertanggung13',
                'data':$scope.data
        };
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
		
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung13'), true));
    }
	
	$scope.moveToNextPage = function(){
		
		
		if($scope.validateThisFormOnPageAccept()){
			
			$scope.showAlert('Validasi',spajProvider.alertMessagebuilder($scope.messages));
			
			$scope.data.isPageTertanggung1Accepted = false;
			return false;
		} else {
			if($scope.data.isPageTertanggung1Accepted){
				if(confirm('Langsung menuju ke halaman form isian tempat tinggal tertanggung?') ){
						$state.go('aplikasiSPAJOnline.dataTertanggung23',  
					{}, {reload: true, inherit: false});
				
				}else{
					return false;
				}
			}
		}
		
		

	}
   
   $scope.isPageAccepted = function(){
	   if(!$scope.data.isPageTertanggung1Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
	   }
   }
   

   
    $scope.showAlert = function(title,message) {
		var alertPopup = $ionicPopup.alert({
			title:title,
			template: message
		});
    
		alertPopup.then(function(res) {
			
		});
    };

	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

}])
 //////////// PAGE 1




 //////////// PAGE 2
.controller('dataTertanggung23Ctrl', [
			'$scope', 
			'$stateParams', 
			'dataFactory', 
			'spajProvider', 
			'$ionicPopup',
			'syncService',
			'$store',
			'$state',
 function ($scope, $stateParams, dataFactory, spajProvider,$ionicPopup,syncService,$store,$state) {
	$scope.pageId = 'aplikasiSPAJOnline.dataTertanggung23';
	$scope.messages = false;
	$scope.data = null;
	
	$scope.provinsis = dataFactory.getProvinsis();
    
	$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();
	
	
	//INIT FORM 
	$scope.$on('$ionicView.enter', function() {
		$scope.init_data();
		$scope.init_display();
	});
	
	$scope.init_display = function(){
		return true;
	};
	
	$scope.init_data = function(){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'provinsiKTPtertanggung':$scope.provinsis[0].id,
			'statusTinggalKTPtertanggung':$scope.statustempattinggals[0].id,
			'statusTinggalSurattertanggung':$scope.statustempattinggals[0].id,
			'provinsiSurattertanggung':$scope.provinsis[0].id,
			'alamatKTPtertanggung':'',
			'kabupatenKTPtertanggung':'',
			'kodeposKTPtertanggung':'',
			'isAlamatKTPtertanggungSama':false,
			'alamatSurattertanggung':'',
			'kabupatenSurattertanggung':'',
			'nomorHptertanggung':'',
			'nomorTelptertanggung':'',
			'kodeposSurattertanggung':'',
			'emailtertanggung':'',
			'isSetujuHPtertanggung':false,
			'isSetujuEmailtertanggung':false,
			'isPageTertanggung2Accepted':false
		}
		
		// get set data from localStorage
		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId) == null ){
			//$scope.init_data();
		} else {
			$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
		}
	}

	$scope.validateThisFormOnPageAccept = function(){
		//validate datanya
		$scope.messages = [];
		try{
			if($scope.data == null){
				$scope.messages.push({"message":"Data ERROR. Null data."});
			}
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. "+e}) ;
		}
		
		//validate nama, NOMOR KTP NPWP
		try{
			tryMe = $scope.data.statusTinggalKTPtertanggung;
			if($scope.data.statusTinggalKTPtertanggung == '0' ){
				$scope.messages.push({'message':"Silahkan pilih status tempat tinggal tertanggung!"}) ;
			}
			tryMe = $scope.data.alamatKTPtertanggung;
			if($scope.data.alamatKTPtertanggung == '' && !(tryMe.match(/^\d+$/)) ){
				$scope.messages.push({'message':"Alamat KTP Harus benar!"}) ;
			}
			tryMe = $scope.data.provinsiKTPtertanggung;
			if($scope.data.provinsiKTPtertanggung == '0'){
				$scope.messages.push({'message':"Provinsi harus dipilih!"}) ;
			}
			tryMe = $scope.data.kabupatenKTPtertanggung;
			if($scope.data.kabupatenKTPtertanggung == '' && !(tryMe.match(/^[a-z\d\-_\s]+$/i)) ){
				$scope.messages.push({'message':"Kabupaten harus benar!"}) ;
			}
			tryMe = $scope.data.kodeposKTPtertanggung;
			if($scope.data.alamatKTPtertanggung == '' && !(tryMe.match(/^\d+$/)) ){
				$scope.messages.push({'message':"Kodepos harus benar!"}) ;
			}
			tryMe = $scope.data.nomorHptertanggung;
			if($scope.data.nomorHptertanggung == '' && !(tryMe.match(/^\d+$/)) ){
				$scope.messages.push({'message':"Nomor HP harus benar!"}) ;
			}			
			tryMe = $scope.data.nomorTelptertanggung;
			if($scope.data.nomorTelptertanggung == '' && !(tryMe.match(/^\d+$/)) ){
				$scope.messages.push({'message':"Nomor Telepon harus benar!"}) ;
			}
			
			tryMe = $scope.data.emailtertanggung;
			if((typeof $scope.data.emailtertanggung == 'undefined') ) {
				$scope.messages.push({'message':"Email harus benar!"}) ;
			}

		}catch (e){
			$scope.messages.push({'message':"Data ERROR. "+e}) ;
		}
		
		if(!$scope.data.isAlamatKTPtertanggungSama){
			if($scope.data.statusTinggalSurattertanggung == '0') $scope.messages.push({'message':"Status tempat tinggal alamat surat harus dipilih!"}) ;
			if($scope.data.alamatSurattertanggung == '')$scope.messages.push({'message':"Alamat surat harus benar!"}) ;
			if($scope.data.provinsiSurattertanggung =='0')$scope.messages.push({'message':"Provinsi alamat surat harus benar!"}) ;
			if($scope.data.kabupatenSuratPempol == '')$scope.messages.push({'message':"Kabupaten alamat surat harus benar!"}) ;
			if($scope.data.kodeposSuratPempol =='')$scope.messages.push({'message':"Kode pus alamat surat harus benar!"}) ;
		}
		
		
		if($scope.messages.length > 0){
			return $scope.messages;
		} 
		return false;
		
	}
	

	$scope.alamatSamaDenganKTP = function(){
	
		var $alamaKTP = spajProvider.getSpajElement($scope.pageId);
        var $alamatSurat =  this.data;
		
        if($scope.data.isAlamatKTPtertanggungSama){
            $alamatSurat.statusTinggalSurattertanggung = $alamaKTP.data.statusTinggalKTPtertanggung;
            $alamatSurat.alamatSurattertanggung = $alamaKTP.data.alamatKTPtertanggung;
            $alamatSurat.provinsiSurattertanggung = $alamaKTP.data.provinsiKTPtertanggung;
            $alamatSurat.kabupatenSurattertanggung = $alamaKTP.data.kabupatenKTPtertanggung;
            $alamatSurat.kodeposSurattertanggung =$alamaKTP.data.kodeposKTPtertanggung;
        } else{
			$alamatSurat.statusTinggalSurattertanggung = $scope.statustempattinggals[0].id;
            $alamatSurat.alamatSurattertanggung = "";
            $alamatSurat.provinsiSurattertanggung = $scope.provinsis[0].id;
            $alamatSurat.kabupatenSurattertanggung = "";
            $alamatSurat.kodeposSurattertanggung ="";
		}
	}
	
	$scope.isPageAccepted = function(){
	   if(!$scope.data.isPageTertanggung2Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
	   }
   }
    $scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.dataTertanggung23',
                'data':$scope.data
        };
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
    }

	$scope.moveToNextPage = function(){
		
		if($scope.validateThisFormOnPageAccept()){
			$scope.data.isPageTertanggung2Accepted = false;
			
						$scope.showAlert('Validasi',spajProvider.alertMessagebuilder($scope.messages));

			return false;
		} else {
			if($scope.data.isPageTertanggung2Accepted){
				
				if(confirm('Langsung menuju ke halaman form isian data pendukung tertanggung?') ){
						$state.go('aplikasiSPAJOnline.dataTertanggung33',  
					{}, {reload: true, inherit: false});
				
				}else{
					return false;
				}
			}
		}
	}
     $scope.showAlert = function(title,message) {
       var alertPopup = $ionicPopup.alert({
         title:title,
         template: message
       });
    
       alertPopup.then(function(res) {
         //console.log('Thank you for not eating my delicious ice cream cone');
       });
    };
}])
/////////// PAGE 2

/////////// PAGE 3
.controller('dataTertanggung33Ctrl', [
		'$scope', 
		'$stateParams', 
		'dataFactory', 
		'spajProvider', 
		'$ionicPopup',
		'syncService', 
		'$store',
		'$state',
function ($scope, $stateParams, dataFactory, spajProvider,$ionicPopup,syncService,$store,$state) {
	$scope.pageId = 'aplikasiSPAJOnline.dataTertanggung33';
	$scope.messages = false;
	
$scope.provinsis = dataFactory.getProvinsis();
    	$scope.genders = dataFactory.getGenders();
$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();
			
$scope.pendidikans = dataFactory.getPendidikans();
    
$scope.statuss = dataFactory.getStatusNikahs();  
$scope.tglLahirTertanggungTambahan1 = new Date('10/10/1990');

//INIT FORM 
	$scope.$on('$ionicView.enter', function() {
		$scope.init_data();
		$scope.init_display();
	});
	
		$scope.init_display = function(){
		return true;
	};
	
	$scope.init_data = function(){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'provinsiSuratSaudaraTertanggung':$scope.provinsis[0].id,
			'statusPernikahanTertanggung':$scope.statuss[0].id,
			'pendidikanTertanggung':$scope.pendidikans[0].id,
			'jenisKelaminTertanggungTambahan1':$scope.genders[0].id,
			'tinggiBadanTertanggung':'',
			'noKtpTertanggungTambahan1':'',
			'beratBadanTertanggung':'',
			'ibuKandungTertanggung':'',
			'namaSaudaraTertanggung':'',
			'alamatSuratSaudaraTertanggung':'',
			'kabupatenSuratSaudaraTertanggung':'',
			'kodeposSuratSaudaraTertanggung':'',
			'isAdaTertanggungTambahan1':false,
			'tglLahirTertanggungTambahan1':$scope.tglLahirTertanggungTambahan1,
			'tempatLahirTertanggungTambahan1':'',
			'noTelpSaudaraTertanggung':'',
			'namaTertanggungTambahan1':'',
			'namaKantorTertanggungTambahan1':'',
			'alamatKantorTertanggungTambahan1':'',
			'tinggiBadanTertanggungTambahan1':'',
			'beratBadanTertanggungTambahan1':'',
			'isPageTertanggung3Accepted':false,
		}
		
		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId) == null ){
			//$scope.init_data();
		} else {
			$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
			$scope.data.tglLahirTertanggungTambahan1 = new Date($scope.data.tglLahirTertanggungTambahan1);
		}
		
	}
	

    $scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':$scope.pageId,
                'data':$scope.data
        };
		$scope.data.tglLahirTertanggungTambahan1 = new Date($scope.data.tglLahirTertanggungTambahan1);
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
		
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
		
		//console.log($scope.data);
    }
    	$scope.moveToNextPage = function(){
			if($scope.validateThisFormOnPageAccept()){
				
				$scope.showAlert('Validasi',spajProvider.alertMessagebuilder($scope.messages));
				
				$scope.data.isPageTertanggung3Accepted = false;
				return false;
			} else {
				if($scope.data.isPageTertanggung3Accepted){
					if(confirm('Langsung menuju ke halaman form isian pekerjaan tertanggung?') ){
							$state.go('aplikasiSPAJOnline.pekerjaanTertanggung',  
						{}, {reload: true, inherit: false});
					
					}else{
						return false;
					}
				}
			}


	}
	
	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId) == null ){
		$scope.init_data();
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
	}

    $scope.isPageAccepted = function(){
	   if(!$scope.data.isPageTertanggung3Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
	   }
   }
    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };
	
	
	$scope.validateThisFormOnPageAccept = function(){
		//validate datanya
		$scope.messages = [];
		try{
			if($scope.data == null){
				$scope.messages.push({"message":"Data ERROR. Null data."});
			}
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. "+e}) ;
		}
		
		//validate nama, NOMOR KTP NPWP
		try{
			tryMe = $scope.data.tinggiBadanTertanggung;
			//console.log(typeof tryMe);
			
			if(( $scope.data.tinggiBadanTertanggung == null)  ){
				$scope.messages.push({'message':"Tinggi badan harus benar!"}) ;
			}
			tryMe = $scope.data.beratBadanTertanggung;
			if($scope.data.beratBadanTertanggung == null ){
				$scope.messages.push({'message':"Berat badan harus benar!"}) ;
			}
			tryMe = $scope.data.ibuKandungTertanggung;
			if($scope.data.ibuKandungTertanggung == '' && !(tryMe.match(/^[A-Za-z]+$/)) ){
				$scope.messages.push({'message':"Nama ibu kandung harus benar!"}) ;
			}
			tryMe = $scope.data.pendidikanTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Silahkan pilih Pendidikan Terakhir"});
			}			
			tryMe = $scope.data.statusPernikahanTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Silahkan pilih Status Pernikahan"});
			}
			
			if($scope.data.isAdaTertanggungTambahan1){
				if($scope.data.noKtpTertanggungTambahan1 == '')$scope.messages.push({'message':"Nomor KTP tertanggung tambahan harus benar!"});
				if($scope.data.tglLahirTertanggungTambahan1 == '')$scope.messages.push({'message':"Tanggal lahir tertanggung tambahan harus benar!"});
				if($scope.data.jenisKelaminTertanggungTambahan1 == '0')$scope.messages.push({'message':"Jenis Kelamin tertanggung tambahan harus benar!"});
				if($scope.data.tempatLahirTertanggungTambahan1 == '')$scope.messages.push({'message':"Tempat lahir tertanggung tambahan harus benar!"});
				if($scope.data.namaTertanggungTambahan1 == '')$scope.messages.push({'message':"Nama tertanggung tambahan harus benar!"});
				if($scope.data.namaKantorTertanggungTambahan1 == '')$scope.messages.push({'message':"Nama Kantor tertanggung tambahan harus benar!"});
				if($scope.data.alamatKantorTertanggungTambahan1 == '')$scope.messages.push({'message':"Alamat kantor tertanggung tambahan harus benar!"});
				if($scope.data.tinggiBadanTertanggungTambahan1 == null)$scope.messages.push({'message':"Tinggi tertanggung tambahan harus benar!"});
				if($scope.data.beratBadanTertanggungTambahan1 == null)$scope.messages.push({'message':"Berat Badan tertanggung tambahan harus benar!"});
			}
			
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. " + e}) ;
		}
		
		if($scope.messages.length > 0){
			return $scope.messages;
		} 
		return false;
		
	}
	


}])
////////// PAGE 3
 

 
.controller('dataPemegangPolis13Ctrl', [
	'$state',
	'$scope',
	'$stateParams',
	'dataFactory', 
	'spajProvider', 
	'$ionicPopup',
	'syncService',
	'$store', 
function ($state,$scope, $stateParams, dataFactory, spajProvider,$ionicPopup,syncService,$store) {
    $scope.genders = dataFactory.getGenders();
    $scope.agamas = dataFactory.getAgamas();
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});


	
	$scope.changeImage = function(){
		spajProvider.takePict(this,'canvasKTPpempol');
		$scope.data.imageKTPpempol = spajProvider.getImageBase64('canvasKTPpempol','jpg');
	}



    $scope.saveDataSpaj = function(){
		$scope.data.imageKTPpempol = spajProvider.getImageBase64('canvasKTPpempol','jpg');
		
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.dataPemegangPolis13',
                'data':$scope.data
        };
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement(), true));
    }

	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis13') == null ){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'agamaPempol':$scope.agamas[0].id,
			'jenkelPempol':$scope.genders[0].id,
			'isKTPPempolAllAge': false,
			'isPagePempol1Accepted': false,
			'namaLengkapPempol': '',
			'nomorKTPPempol':'',
			'tglLahirPempol':'10/10/2016',
			'nomorNPWPPempol':'',
			'masaBerlakuKTPPempol':'',
			'imageKTPpempol':null,
			'isTertanggungPempol':false
		}
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis13');
		
			decodedImage = null;
		
			try{
				decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.data.imageKTPpempol));
			}catch(e){
				decodedImage = '';
			}
			$scope.data.tglLahirPempol = new Date($scope.data.tglLahirPempol);

			spajProvider.putImageTo('canvasKTPpempol',decodedImage);
	}
    
    $scope.showAlert = function(title,message) {
       var alertPopup = $ionicPopup.alert({
         title:title,
         template: message
       });
    
       alertPopup.then(function(res) {
         //console.log('Thank you for not eating my delicious ice cream cone');
       });
    };
	
	$scope.pempolAdalahTertanggung = function(){
		var $tertanggung = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung13');
		var $tertanggungPage2 = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung23');
		var $tertanggungPage3 = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung33');
        var $pempol =  this.data;
		
		var $pgTertanggung2 = null;
		var $pgTertanggung3 = null;
		 
        if($scope.data.isTertanggungPempol){
            
			$pempol.namaLengkapPempol = $tertanggung.namaLengkapTertanggung;
            $pempol.nomorKTPPempol = $tertanggung.nomorKTPTertanggung;
            $pempol.nomorNPWPPempol = $tertanggung.nomorNPWPTertanggung;
            $pempol.jenkelPempol = $tertanggung.jenkelTertanggung;
            $pempol.agamaPempol = $tertanggung.agamaTertanggung;
            $pempol.imageKTPpempol = $tertanggung.imageKTPTertanggung;
			
			decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($pempol.imageKTPpempol));

			spajProvider.putImageTo('canvasKTPpempol',decodedImage);
			$pempol.isPagePempol1Accepted = false;
			
			$pempol.isTertanggungPempol = true;

			$pempol.tglLahirPempol = new Date($tertanggung.tglLahirTertanggung)
			
			//console.log($tertanggungPage2.tglLahirTertanggung);
			
			$pgTertanggung2 = {
				'spaj_guid':spajProvider.getSpajGUID(),
				'provinsiKTPPempol':$tertanggungPage2.provinsiKTPtertanggung,
				'provinsiSuratPempol':$tertanggungPage2.provinsiSurattertanggung,
				'statusTinggalKTPPempol':$tertanggungPage2.statusTinggalKTPtertanggung,
				'statusTinggalSuratPempol':$tertanggungPage2.statusTinggalSurattertanggung,
				
				'alamatKTPPempol':$tertanggungPage2.alamatKTPtertanggung,
				'tglLahirPempol':$scope.tglLahirPempol,
				'kabupatenKTPPempol':$tertanggungPage2.kabupatenKTPtertanggung,
				'kodeposKTPPempol':$tertanggungPage2.kodeposKTPtertanggung,
				'isAlamatKTPPempolSama':$tertanggungPage2.isAlamatKTPtertanggungSama,
				'alamatSuratPempol':$tertanggungPage2.alamatSurattertanggung,
				'kabupatenSuratPempol':$tertanggungPage2.kabupatenSurattertanggung,
				'kodeposSuratPempol':$tertanggungPage2.kodeposSurattertanggung,
				'nomorHpPempol':$tertanggungPage2.nomorHptertanggung,
				'nomorTelpPempol':$tertanggungPage2.nomorTelptertanggung,
				'emailPempol':$tertanggungPage2.emailtertanggung,
				'isSetujuHPPempol':$tertanggungPage2.isSetujuHPtertanggung,
				'isSetujuEmailPempol':$tertanggungPage2.isSetujuEmailtertanggung,
				'isPagePempol2Accepted':$tertanggungPage2.isPageTertanggung2Accepted
			}
			$store.set('SPAJ::'+$scope.data.spaj_guid+'::'+'aplikasiSPAJOnline.dataPemegangPolis23',$pgTertanggung2); 
			
			$pgTertanggung3 = {
				'spaj_guid':spajProvider.getSpajGUID(),
				'provinsiSuratTakSerumahPempol':$tertanggungPage3.provinsiSuratSaudaraTertanggung,
				'statusNikahPempol':$tertanggungPage3.statusPernikahanTertanggung,
				'pendidikanPempol':$tertanggungPage3.pendidikanTertanggung,
				'tinggiBadanPempol':$tertanggungPage3.tinggiBadanTertanggung,
				'beratBadanPempol':$tertanggungPage3.beratBadanTertanggung,
				'namaIbuPempol':$tertanggungPage3.ibuKandungTertanggung,
				'namaSaudaraTakSerumahPempol':$tertanggungPage3.namaSaudaraTertanggung,
				'alamatSuratTakSerumahPempol':$tertanggungPage3.alamatSuratSaudaraTertanggung,
				'kabupatenTakSerumahPempol':$tertanggungPage3.kabupatenSuratSaudaraTertanggung,
				'kodeposSuratSaudaraTertanggung':$tertanggungPage3.kodeposSuratSaudaraTertanggung,
				'kodeposTakSerumahPempol':$tertanggungPage3.kodeposSuratSaudaraTertanggung,
				'noHPTakSerumah':$tertanggungPage3.hpSuratSaudaraTertanggung,
				'noTelTakSerumah':$tertanggungPage3.noTelpSaudaraTertanggung,
				'isPagePempol3Accepted':false,
				'isTertanggungPempol':true
			}
			$store.set('SPAJ::'+$scope.data.spaj_guid+'::'+'aplikasiSPAJOnline.dataPemegangPolis33',$pgTertanggung3); 

			this.saveDataSpaj();
			
        } else {
			
			$pempol.namaLengkapPempol = '';
			$pempol.tglLahirPempol = '';
            $pempol.nomorKTPPempol = '';
            $pempol.nomorNPWPPempol = '';
            $pempol.jenkelPempol = '';
            $pempol.agamaPempol = '';
            $pempol.imageKTPpempol = '';
            $pempol.isPagePempol1Accepted = false;
			$pempol.isTertanggungPempol = false;
			
			$pgTertanggung2 = {
				'spaj_guid':spajProvider.getSpajGUID(),
				'provinsiKTPPempol':'0',
				'provinsiSuratPempol':'0',
				'statusTinggalKTPPempol':'0',
				'statusTinggalSuratPempol':'0',
				'tglLahirPempol':'',
				'alamatKTPPempol':'',
				'kabupatenKTPPempol':'',
				'kodeposKTPPempol':'',
				'isAlamatKTPPempolSama':false,
				'alamatSuratPempol':'',
				'kabupatenSuratPempol':'',
				'kodeposSuratPempol':'',
				'nomorHpPempol':'',
				'nomorTelpPempol':'',
				'emailPempol':'',
				'isSetujuHPPempol':false,
				'isSetujuEmailPempol':false,
				'isPagePempol2Accepted':false
			}
			$store.set('SPAJ::'+$scope.data.spaj_guid+'::'+'aplikasiSPAJOnline.dataPemegangPolis23',$pgTertanggung2); 
			
			$pgTertanggung3 = {
				'spaj_guid':spajProvider.getSpajGUID(),
				'provinsiSuratTakSerumahPempol':'0',
				'statusNikahPempol':'0',
				'pendidikanPempol':'',
				'tinggiBadanPempol':'',
				'beratBadanPempol':'',
				'namaIbuPempol':'',
				'namaTakSerumahPempol':'',
				'alamatSuratTakSerumahPempol':'',
				'kabupatenTakSerumahPempol':'',
				'kodeposSuratSaudaraTertanggung':'',
				'kodeposTakSerumahPempol':'',
				'noHPTakSerumah':'',
				'noTelTakSerumah':'',
				'isPagePempol3Accepted':false,
				'isTertanggungPempol':false
			}
			$store.set('SPAJ::'+$scope.data.spaj_guid+'::'+'aplikasiSPAJOnline.dataPemegangPolis33',$pgTertanggung3);
			
			
			this.saveDataSpaj();
		}
    }

	
	   $scope.isPageAccepted = function(){
	   if(!$scope.data.isPagePempol1Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
	   }
   }
   
   
   $scope.moveToNextPage = function(){
	   	if($scope.data.isPagePempol1Accepted){
			if(confirm('Langsung menuju ke halaman isian form tempat tinggal Pemegang Polis?') ){
					$state.go('aplikasiSPAJOnline.dataPemegangPolis23',  
				{}, {reload: true, inherit: false});
			
			}else{
				return false;
			}
		}}
   
}])
      
   
.controller('dataPemegangPolis23Ctrl', ['$state','$scope', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup','syncService','$store',
 function ($state,$scope, $stateParams, dataFactory, spajProvider,$ionicPopup,syncService,$store) {
    $scope.provinsis = dataFactory.getProvinsis();

	$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();

	
	$scope.isPageAccepted = function(){
	   if(!$scope.data.isPagePempol2Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
	}}
	
    $scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.dataPemegangPolis23',
                'data':$scope.data
        };
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
    }


   $scope.moveToNextPage = function(){
	   	if($scope.data.isPagePempol2Accepted){
			if(confirm('Langsung menuju ke halaman isian form pendukung Pemegang Polis?') ){
					$state.go('aplikasiSPAJOnline.dataPemegangPolis33',  
				{}, {reload: true, inherit: false});
			
			}else{
				return false;
			}
		}}


	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis23') == null ){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'provinsiKTPPempol':$scope.provinsis[0].id,
			'provinsiSuratPempol':$scope.provinsis[0].id,
			'statusTinggalKTPPempol':$scope.statustempattinggals[0].id,
			'statusTinggalSuratPempol':$scope.statustempattinggals[0].id,
			
			'alamatKTPPempol':'',
			'kabupatenKTPPempol':'',
			'kodeposKTPPempol':'',
			'isAlamatKTPPempolSama':false,
			'alamatSuratPempol':'',
			'kabupatenSuratPempol':'',
			'kodeposSuratPempol':'',
			'nomorHpPempol':'',
			'nomorTelpPempol':'',
			'emailPempol':'',
			'isSetujuHPPempol':false,
			'isSetujuEmailPempol':false,
			'isPagePempol2Accepted':false
		}
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis23');
	}

    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };
}


])
   
 
.controller('dataPemegangPolis33Ctrl', [
	'$scope','$state',
	'$stateParams',
	'dataFactory', 
	'spajProvider', 
	'$ionicPopup',
	'$ionicModal',
	'syncService',
	'$store',
	
function ($scope, $state,$stateParams, dataFactory, spajProvider,$ionicPopup,$ionicModal,syncService,$store) {
$scope.provinsis = dataFactory.getProvinsis();
    
$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();

$scope.pendidikans = dataFactory.getPendidikans();
    
$scope.isTertanggungPempol = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis13').isTertanggungPempol;	
	
	//console.log($scope.isTertanggungPempol);
	
	   $scope.moveToNextPage = function(){
	   	if($scope.data.isPagePempol3Accepted){
			if(confirm('Langsung menuju ke halaman isian form Dokumen?') ){
					$state.go('aplikasiSPAJOnline.dokumenPendukungSPAJ',  
				{}, {reload: true, inherit: false});
			
			}else{
				return false;
			}
		}}
	
		$scope.isPageAccepted = function(){
	   if(!$scope.data.isPagePempol33Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
		}
	}
	
$scope.statuss = dataFactory.getStatusNikahs();  

	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
	
    $scope.saveDataSpaj = function(){

			var $formdata = {
					'pageId':'aplikasiSPAJOnline.dataPemegangPolis33',
					'data':$scope.data
			};
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataPemegangPolis33'), true));
    }
	
	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis33') == null ){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'provinsiSuratTakSerumahPempol':$scope.provinsis[0].id,
			'statusNikahPempol':$scope.statuss[0].id,
			'pendidikanPempol':$scope.pendidikans[0].id,
			'tinggiBadanPempol':'',
			'beratBadanPempol':'',
			'namaIbuPempol':'',
			'namaSaudaraTakSerumahPempol':'',
			'alamatSuratTakSerumahPempol':'',
			'kabupatenTakSerumahPempol':'',
			'kodeposSuratSaudaraTertanggung':'',
			'kodeposTakSerumahPempol':'',
			'noHPTakSerumah':'',
			'noTelTakSerumah':'',
			'isPagePempol3Accepted':false,
			'isTertanggungPempol':false,
		}
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataPemegangPolis33');
	}

    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };

}])
  
  
.controller('pekerjaanTertanggungCtrl', [
	'$scope',
	'$state',
	'$stateParams',
	'dataFactory', 
	'spajProvider', 
	'$ionicPopup',
	'$store',
function ($scope,$state, $stateParams, dataFactory, spajProvider,$ionicPopup,$store) {
    $scope.pekerjaans = dataFactory.getPekerjaans();
    $scope.pangkats = dataFactory.getPangkats();
    $scope.kelaspekerjaans = dataFactory.getKelasPekerjaans();
    $scope.jenisperusahaans = dataFactory.getJenisPerusahaans();
	$scope.rangegajitertanggungs = dataFactory.getRangeGajis();
	$scope.messages = false;
	$scope.pageId = 'aplikasiSPAJOnline.pekerjaanTertanggung';
	//INIT FORM 
	$scope.$on('$ionicView.enter', function() {
		$scope.init_data();
		$scope.init_display();
	});
	
	
	$scope.init_display = function(){
		return true;
	};
$scope.init_data = function(){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'jenisPerusahaanTertanggung':$scope.jenisperusahaans[0].id,
			'pekerjaanTertanggung':$scope.pekerjaans[0].id,
			'pangkatTertanggung':$scope.pangkats[0].id,
			'klasifikasiPekerjaanTertanggung':'',
			'rangeGajiTertanggung':$scope.rangegajitertanggungs[5].id,
			'rangePendapatanTertanggung':$scope.rangegajitertanggungs[5].id,
			'rangePendapatanPasangan':$scope.rangegajitertanggungs[5].id,
			'rangeHasilInvestasi':$scope.rangegajitertanggungs[5].id,
			'rangeBisnis':$scope.rangegajitertanggungs[5].id,
			'rangeBonus':$scope.rangegajitertanggungs[5].id,
			'rangePendapatanTertanggung':$scope.rangegajitertanggungs[5].id,
			'sumberPendapatanLainnya':'',
			'namaPerusahaanTertanggung':'',
			'alamatPerusahaanTertanggung':'',
			'kodeposPerusahaanTertanggung':'',
			'nomorTeleponPerusahaanTertanggung':'',
			'nomorEkstensiPerusahaanTertanggung':'',
			'isPagePekerjaanTertanggung1Accepted':'',
			'pemilikWirausahaTertanggung':'',
			'bidangWirausahaTertanggung':'',
			'namaWirausahaTertanggung':'',
			'alamatWirausahaTertanggung':'',
			'rangePendapatanTertanggungLainnya':''
		}
		
		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId) == null ){

		} else {
			$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
		}
}
  	
$scope.validateThisFormOnPageAccept = function(){
		//validate datanya
		$scope.messages = [];
		try{
			if($scope.data == null){
				$scope.messages.push({"message":"Data ERROR. Null data."});
			}
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. "+e}) ;
		}
		
		//validate nama, NOMOR KTP NPWP
		try{
			tryMe = $scope.data.pekerjaanTertanggung;
			if($scope.data.pekerjaanTertanggung == '0'){
				$scope.messages.push({'message':"Pekerjaan harus benar!"}) ;
			}
			tryMe = $scope.data.pekerjaanTertanggung;
			if('wirausaha' == tryMe){
				if(''==$scope.data.pemilikWirausahaTertanggung) $scope.messages.push({'message':"Kepemilikan usaha harus benar!"});
				if(''==$scope.data.bidangWirausahaTertanggung)$scope.messages.push({'message':"Bidang wirausaha harus benar!"});
				if(''==$scope.data.namaWirausahaTertanggung)$scope.messages.push({'message':"Nama wirausaha harus benar!"});
				if(''==$scope.data.alamatWirausahaTertanggung)$scope.messages.push({'message':"Alamat wirausaha harus benar!"});
			}

			tryMe = $scope.data.pangkatTertanggung;
			if($scope.data.pangkatTertanggung == '0' ){
				$scope.messages.push({'message':"Pangkat/jabatan/golongan harus benar!"}) ;
			}
			tryMe = $scope.data.rangeGajiTertanggung;
			if($scope.data.rangeGajiTertanggung == '0'){
				$scope.messages.push({'message':"Range Gaji harus benar!"}) ;
			}
			tryMe = $scope.data.rangePendapatanPasangan;
			if('0' == tryMe){
				$scope.messages.push({'message':"Range pendapatan suami/istri harus benar!"});
			}			
			tryMe = $scope.data.rangeHasilInvestasi;
			if('0' == tryMe){
				$scope.messages.push({'message':"Range hasil investasi harus benar!"});
			}		
			tryMe = $scope.data.rangeBisnis;
			if('0' == tryMe){
				$scope.messages.push({'message':"Range hasil bisnis pribadi harus benar!"});
			}
			tryMe = $scope.data.rangePendapatanTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Range pendapatan lainnya harus benar!"});
			}
			
			if('4' == tryMe){
				if($scope.data.rangePendapatanTertanggungLainnya=='') $scope.messages.push({'message':"Jumlah pendapatan lainnya harus benar!"});
				if($scope.data.sumberPendapatanLainnya=='') $scope.messages.push({'message':"Sumber pendapatan lainnya harus benar!"});
			}
			tryMe = $scope.data.jenisPerusahaanTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Jenis perusahaan harus benar!"});
			}			
			tryMe = $scope.data.jenisPerusahaanTertanggung;
			if('0' == tryMe){
				$scope.messages.push({'message':"Jenis perusahaan harus benar!"});
			}
			tryMe = $scope.data.namaPerusahaanTertanggung;
			if('' == tryMe){
				$scope.messages.push({'message':"Nama perusahaan harus benar!"});
			}			
			tryMe = $scope.data.alamatPerusahaanTertanggung;
			if('' == tryMe){
				$scope.messages.push({'message':"Alamat perusahaan harus benar!"});
			}			
			tryMe = $scope.data.kodeposPerusahaanTertanggung;
			if('' == tryMe){
				$scope.messages.push({'message':"Kodepos perusahaan harus benar!"});
			}			
			tryMe = $scope.data.nomorTeleponPerusahaanTertanggung;
			if('' == tryMe){
				$scope.messages.push({'message':"Nomor telpon perusahaan harus benar!"});
			}			

		}catch (e){
			$scope.messages.push({'message':"Data ERROR. " + e}) ;
		}

		
		
		
		if($scope.messages.length > 0){
			return $scope.messages;
		} 
		return false;
		
	}
	


	
    $scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':$scope.pageId,
                'data':$scope.data
        };
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.pekerjaanTertanggung'), true));
    }
	
	$scope.getKelasPekerjaan = function (idpekerjaan){
		var dtpek = null;
		for(i=1;i<$scope.pekerjaans.length;i++){
			if(idpekerjaan == $scope.pekerjaans[i].id){
				dtpek = $scope.pekerjaans[i].kelas;
			}
		}
		$scope.data.klasifikasiPekerjaanTertanggung = dtpek;
		return dtpek;
	}
	


    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };

	$scope.moveToNextPage = function(){
		
		if($scope.validateThisFormOnPageAccept()){
			
			$scope.showAlert('Validasi',spajProvider.alertMessagebuilder($scope.messages));
			
			$scope.data.isPagePekerjaanTertanggung1Accepted = false;

		} else {
			if($scope.data.isPagePekerjaanTertanggung1Accepted){
				if(confirm('Langsung menuju ke halaman form isian Produk dan Penerima Manfaat?') ){
						$state.go('aplikasiSPAJOnline.produkDanManfaat12',  
					{}, {reload: true, inherit: false});
				
				}else{
					return false;
				}
			}
		}

	}

    

    
}])
   
.controller('pekerjaanPemegangPolisCtrl', [
	'$scope', 
	'$stateParams', 
	'dataFactory',
	'spajProvider',
	'$ionicPopup',
	'$store', 
function ($scope, $stateParams, dataFactory,spajProvider,$ionicPopup,$store) {
    $scope.pekerjaans = dataFactory.getPekerjaans();
    $scope.pangkats = dataFactory.getPangkats();
    $scope.kelaspekerjaans = dataFactory.getKelasPekerjaans();
	$scope.rangegajiPempols = dataFactory.getRangeGajis();
    $scope.jenisperusahaans = dataFactory.getJenisPerusahaans();
	
	
		$scope.getKelasPekerjaan = function (idpekerjaan){
			
		var dtpek = null;
		for(i=1;i<$scope.pekerjaans.length;i++){
			if(idpekerjaan == $scope.pekerjaans[i].id){
				dtpek = $scope.pekerjaans[i].kelas;
			}
		}
		$scope.data.klasifikasiPekerjaanPempol = dtpek;

		return dtpek;
	}
	
	
    	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
	
    $scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.pekerjaanPemegangPolis',
                'data':$scope.data
        };
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.pekerjaanPemegangPolis'), true));
    }
	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.pekerjaanPemegangPolis') == null ){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'jenisPerusahaanPempol':$scope.jenisperusahaans[0].id,
			'pekerjaanPempol':$scope.pekerjaans[0].id,
			'pangkatPempol':$scope.pangkats[0].id,
			'klasifikasiPekerjaanPempol':$scope.kelaspekerjaans[0].id,
			'rangeGajiPempol':$scope.rangegajiPempols[0].id,
			'rangePendapatanPempol':$scope.rangegajiPempols[0].id,
			'rangePendapatanPasangan':$scope.rangegajiPempols[0].id,
			'rangePendapatanPasanganLainnya':'',
			'rangeHasilInvestasi':$scope.rangegajiPempols[0].id,
			'rangeHasilInvestasiLainnya':'',
			'rangeGajiPempolJmlLainnya':'',
			'rangeBisnis':$scope.rangegajiPempols[0].id,
			'rangeBisnisLainnya':'',
			'rangeBonus':$scope.rangegajiPempols[0].id,
			'paymentBankNameLainnya':'',
			'rangeBonusLainnya':'',
			'namaPerusahaanPempol':'',
			'alamatPerusahaanPempol':'',
			'kodeposPerusahaanPempol':'',
			'nomorTeleponPerusahaanPempol':'',
			'nomorEkstensiPerusahaanPempol':'',
			'isPagePekerjaanPempol1Accepted':'',
			'pemilikWirausahaPempol':'',
			'bidangWirausahaPempol':'',
			'namaWirausahaPempol':'',
			'alamatWirausahaPempol':''
		}
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.pekerjaanPemegangPolis');
	}

    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };
}])
   
.controller('produkDanManfaat12Ctrl', [
	'$state', 
	'$scope', 
	'$stateParams', 
	'spajProvider',
	'dataFactory',
	'$store', 
	'$ionicPopup', 
function ($state,$scope, $stateParams,spajProvider,dataFactory,$store,$ionicPopup) {
    $scope.jenisAsuransis = dataFactory.getJenisAsuransis();
    
    $scope.caraBayars = dataFactory.getCaraBayars();
    $scope.isShowRider = false;
    $scope.bayarBerikutnyas = dataFactory.getBayarBerikutnyas();
    $scope.jenisJsProteksiKeluargas = dataFactory.getJenisJsProteksiKeluargas();
	
	$scope.isShowTermRider = false;
	$scope.isShowADDB = false;
	$scope.isShowTPD = false;
	$scope.isShowCI53 = false;
	$scope.isShowhospitalCP = false;
	$scope.isShowPBD = false;
	$scope.isShowPBC151 = false;
	$scope.isShowPBTPD = false;
	$scope.isShowSPD = false;
	$scope.isShowSPCI51 = false;
	$scope.isShowSPTBD = false;
	$scope.isShowWPC151 = false;
	$scope.isShowWPTPD = false;
	$scope.isRiderLainnya = false;
					
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
	
	$scope.pageId = 'aplikasiSPAJOnline.produkDanManfaat12';

	//INIT FORM 
	$scope.$on('$ionicView.enter', function() {
		$scope.init_data();

		$scope.init_display();
	});
	$scope.init_data = function(){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'jenisAsuransi':$scope.jenisAsuransis[0].id,
			'caraBayar':$scope.caraBayars[0].id,
			'bayarPremiSelanjutnya':$scope.bayarBerikutnyas[0].id,
			'isTujuanProteksi':false,
			'isTujuanTabungan':false,
			'isTujuanPendidikan':false,
			'isTujuanInvestasi':false,
			'isTujuanPensiun':false,
			'isTujuanLainnya':false,
			'tujuanAsuransiLainnya':'',
			'jenisJsProteksiKeluarga':$scope.jenisJsProteksiKeluargas[0].id,
			'unitPasarUang':25,
			'pendapatanTetap':25,
			'berimbang':25,
			'ekuitas':25,
			'totalPersenUnitLink':100,
			'isTermRider':false,
			'isADDB':false,
			'isTPD':false,
			'isCI53':false,
			'hospitalCP':false,
			'hcpTypeSelect':false,
			'isRiderLainnya':false,
			'isRiderLainnya':false,
			'namaRiderLainnya':'',
			'riderLainnyaPremi':'',
			'isPBD':false,
			'isPBC151':false,
			'isPBTPD':false,
			'isSPD':false,
			'isSPCI51':false,
			'isSPTBD':false,
			'isWPC151':false,
			'isWPTPD':false,
			'masaBayarPremi':'',
			'premi':'',
			'uangAsuransi':'',
			'jangkaWaktuAsuransi':'',
			'nomorRekening':'',
			'namaRekening':'',
			'paymentBankName':'',
			'isPageProdukManfaat1Accepted':false
		}
	
		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId) == null ){
			
		} else {
			$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
			$scope.getRiderGroup($scope.data.jenisAsuransi);
		}
	
	}
	
		
	$scope.init_display = function(){
		
	}

	$scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':$scope.pageId,
                'data':$scope.data
        };
		//console.log($formdata);
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.produkDanManfaat12'), true));
    }

	$scope.riderGroup = 0;
	
	$scope.getRiderGroup = function(produkid){
		for(i=1;i<$scope.jenisAsuransis.length;i++){
			if(produkid == $scope.jenisAsuransis[i].id){
				$scope.riderGroup = $scope.jenisAsuransis[i].gruprider;
			}
		}
		
		this.setRiderDisplay($scope.riderGroup);
		
		return  $scope.riderGroup;
	}
	
	$scope.setRiderDisplay = function(riderGroup){
		//console.log(riderGroup);
	if(riderGroup > 0){
		$scope.isShowRider = true;
	} else{
		$scope.isShowRider = false;
	}
	switch(riderGroup){
		case 1: //JS Prestasi
						$scope.isShowTermRider = false;
						$scope.isShowADDB = false;

						$scope.isShowPBD = false;
						$scope.isShowPBC151 = false;
						$scope.isShowPBTPD = false;
						$scope.isShowSPD = false;
						$scope.isShowSPCI51 = false;
						$scope.isShowSPTBD = false;
						$scope.isShowWPC151 = false;
						$scope.isShowWPTPD = false;
						$scope.isRiderLainnya = false;
		
			$scope.isShowhospitalCP = true;
			$scope.isShowTPD = true;
			$scope.isShowCI53 = true;
			
			
			
			break;
		case 2: //JS Prestasi SMART
									$scope.isShowTermRider = false;
						$scope.isShowADDB = false;
						$scope.isShowTPD = false;
						$scope.isShowCI53 = false;
						$scope.isShowhospitalCP = false;
						$scope.isShowPBD = false;
						$scope.isShowPBC151 = false;
						$scope.isShowPBTPD = false;
						$scope.isShowSPD = false;
						$scope.isShowSPCI51 = false;
						$scope.isShowSPTBD = false;
						$scope.isShowWPC151 = false;
						$scope.isShowWPTPD = false;
						$scope.isRiderLainnya = false;
						
			$scope.isShowCI53 = true;
			break;			
			
		case 3: //JS Beasiswa Catur Karsa Beasiswa Trikarsa Tri Pralaya JS Link Fixed Income Fun JS Link Equity Fund JS Link Balanced Fund JS Dwiguna JS Dwiguna Menaik
						$scope.isShowTermRider = false;
						$scope.isShowADDB = false;
						$scope.isShowTPD = false;
						$scope.isShowCI53 = false;
						$scope.isShowhospitalCP = false;
						$scope.isShowPBD = false;
						$scope.isShowPBC151 = false;
						$scope.isShowPBTPD = false;
						$scope.isShowSPD = false;
						$scope.isShowSPCI51 = false;
						$scope.isShowSPTBD = false;
						$scope.isShowWPC151 = false;
						$scope.isShowWPTPD = false;
						$scope.isRiderLainnya = false;
		
		
		$scope.isShowhospitalCP = true;
		$scope.isShowTermRider = true;
		$scope.isShowADDB = true;
		$scope.isShowTPD = true;
		$scope.isShowWPTPD = true;
		$scope.isShowSPD = true;
		$scope.isShowSPTBD = true;
		$scope.isShowCI53 = true;

			break;			
			case 4: //JS Beasiswa Catur Karsa Beasiswa Trikarsa Tri Pralaya JS Link Fixed Income Fun JS Link Equity Fund JS Link Balanced Fund JS Dwiguna JS Dwiguna Menaik
						$scope.isShowTermRider = true;
						$scope.isShowADDB = false;
						$scope.isShowTPD = false;
						$scope.isShowCI53 = true;
						$scope.isShowhospitalCP = true;
						$scope.isShowPBD = false;
						$scope.isShowPBC151 = false;
						$scope.isShowPBTPD = false;
						$scope.isShowSPD = false;
						$scope.isShowSPCI51 = false;
						$scope.isShowSPTBD = false;
						$scope.isShowWPC151 = false;
						$scope.isShowWPTPD = false;
						$scope.isRiderLainnya = false;
			break;				
			case 5: //JS Beasiswa Catur Karsa Beasiswa Trikarsa Tri Pralaya JS Link Fixed Income Fun JS Link Equity Fund JS Link Balanced Fund JS Dwiguna JS Dwiguna Menaik
						$scope.isShowTermRider = false;
						$scope.isShowADDB = false;
						$scope.isShowTPD = false;
						$scope.isShowCI53 = false;
						$scope.isShowhospitalCP = false;
						$scope.isShowPBD = false;
						$scope.isShowPBC151 = false;
						$scope.isShowPBTPD = false;
						$scope.isShowSPD = false;
						$scope.isShowSPCI51 = false;
						$scope.isShowSPTBD = false;
						$scope.isShowWPC151 = false;
						$scope.isShowWPTPD = false;
						$scope.isRiderLainnya = false;
		
		
				$scope.isShowhospitalCP = true;
				$scope.isShowTermRider = false;
				$scope.isShowADDB = true;
				$scope.isShowTPD = true;
				$scope.isShowWPTPD = true;
				$scope.isShowSPD = true;
				$scope.isShowSPTBD = true;
				$scope.isShowCI53 = true;
			break;				
			case 6: //JS Beasiswa Catur Karsa Beasiswa Trikarsa Tri Pralaya JS Link Fixed Income Fun JS Link Equity Fund JS Link Balanced Fund JS Dwiguna JS Dwiguna Menaik
						
						$scope.isShowTermRider = false;
						$scope.isShowADDB = false;
						$scope.isShowTPD = false;
						$scope.isShowCI53 = false;
						$scope.isShowhospitalCP = false;
						$scope.isShowPBD = false;
						$scope.isShowPBC151 = false;
						$scope.isShowPBTPD = false;
						$scope.isShowSPD = false;
						$scope.isShowSPCI51 = false;
						$scope.isShowSPTBD = false;
						$scope.isShowWPC151 = false;
						$scope.isShowWPTPD = false;
						$scope.isRiderLainnya = false;
		
		
					$scope.isShowhospitalCP = true;
					$scope.isShowTermRider = true;
					$scope.isShowADDB = true;
					$scope.isShowTPD = true;
					$scope.isShowCI53 = true;
						
			break;
		default:
		
				$scope.isShowTermRider = false;
				$scope.isShowADDB = false;
				$scope.isShowTPD = false;
				$scope.isShowCI53 = false;
				$scope.isShowhospitalCP = false;
				$scope.isShowPBD = false;
				$scope.isShowPBC151 = false;
				$scope.isShowPBTPD = false;
				$scope.isShowSPD = false;
				$scope.isShowSPCI51 = false;
				$scope.isShowSPTBD = false;
				$scope.isShowWPC151 = false;
				$scope.isShowWPTPD = false;
				$scope.isRiderLainnya = false;
				
				break;
		
	}
	}
	
	$scope.doCheck = function(){
		var ck = (1*$scope.data.unitPasarUang)+(1*$scope.data.pendapatanTetap)+(1*$scope.data.berimbang)+(1*$scope.data.ekuitas);

		if(ck > 100){
			alert("Tidak boleh lebih dari 100%");
			return false;
		}else{
			$scope.data.totalPersenUnitLink = ck;
		}
	}
	


    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };
	
	$scope.validateThisFormOnPageAccept = function(){
		//validate datanya
		$scope.messages = [];
		try{
			if($scope.data == null){
				$scope.messages.push({"message":"Data ERROR. Null data."});
			}
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. "+e}) ;
		}
		

		try{
			
			if(!($scope.data.isTujuanLainnya || $scope.data.isTujuanProteksi || $scope.data.isTujuanTabungan || $scope.data.isTujuanPendidikan || $scope.data.isTujuanInvestasi ||$scope.data.isTujuanPensiun)){
				$scope.messages.push({'message':"Tujuan berasuransi harus diisi!"}) ;
			}
			if($scope.data.isTujuanLainnya){
				tryMe = $scope.data.tujuanAsuransiLainnya;
				if(''==tryMe)$scope.messages.push({'message':" Tujuan lainnya harus diisi!"}) ;
			}	

			
			if($scope.data.paymentBankName == 'LAINNYA'){
				tryMe = $scope.data.paymentBankNameLainnya;
				if(''==tryMe)$scope.messages.push({'message':"Nama Bank lainnya harus diisi!"}) ;
			}
			if('0' == $scope.data.jenisAsuransi)$scope.messages.push({'message':"Produk asuransi harus benar!"}) ;			
			if('0' == $scope.data.caraBayar)$scope.messages.push({'message':"Cara bayar harus benar!"}) ;			
			if('' == $scope.data.masaBayarPremi)$scope.messages.push({'message':"Masa bayar premi harus benar!"}) ;			
			if('' == $scope.data.premi)$scope.messages.push({'message':"Jumlah Premi(Rp.) harus benar!"}) ;			
			if('' == $scope.data.uangAsuransi)$scope.messages.push({'message':"Uang asuransi (Rp.) harus benar!"}) ;			
			if('' == $scope.data.jangkaWaktuAsuransi)$scope.messages.push({'message':"Jangka waktu Asuransi harus benar!"}) ;			
			if('' == $scope.data.nomorRekening)$scope.messages.push({'message':"Nomor rekening harus benar!"}) ;			
			if('' == $scope.data.namaRekening)$scope.messages.push({'message':"Atas Nama Rekening harus benar!"}) ;			


			
		}catch (e){
			$scope.messages.push({'message':"Data ERROR. " + e}) ;
		}

		if($scope.messages.length > 0){
			return $scope.messages;
		} 
		return false;
		
	}
	
	
	$scope.moveToNextPage = function(){
		if($scope.validateThisFormOnPageAccept()){
			$scope.showAlert('Validasi',spajProvider.alertMessagebuilder($scope.messages));
			$scope.data.isPageProdukManfaat1Accepted = false;
			return false;
		} else {
			if($scope.data.isPageProdukManfaat1Accepted){
				if(confirm('Langsung menuju ke halaman form isian penerima manfaat?') ){
					$state.go('aplikasiSPAJOnline.produkDanManfaat22',{}, {reload: true, inherit: false});
				}else{
					return false;
				}
			}
		}

	}
	
	$scope.isPageAccepted = function(){
	   if(!$scope.data.isPageProdukManfaat1Accepted){
		  $scope.showAlert('Apakah data sudah benar?','Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
		   return false;
	}}

}])
   
.controller('produkDanManfaat22Ctrl', [
	'$state',
	'$scope',
	'$stateParams',
	'spajProvider',
	'dataFactory',
	'$store', 
	'$ionicPopup',
function ($state,$scope, $stateParams, spajProvider,dataFactory,$store,$ionicPopup) {
	
	
	$scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
	$scope.dataPenerimaManfaat = spajProvider.getPenerimaManfaat(spajProvider.getSpajGUID(),'aplikasiSPAJOnline.tambahPenerimaManfaat',false);

	$scope.data = {
		'spaj_guid':spajProvider.getSpajGUID(),
	}
	
	$scope.editPenerimaManfaat = function(dat){
		$state.go('aplikasiSPAJOnline.editPenerimaManfaat',  
			{indexPenerimaManfaat:dat}, {reload: true, inherit: false});
	}

	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
		
		if($scope.dataPenerimaManfaat == null){
			//'add from data tertanggung'
			
			$scope.dataTertanggung13 = $scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+'aplikasiSPAJOnline.dataTertanggung13');
			$scope.dataTertanggung33 = $scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+'aplikasiSPAJOnline.dataTertanggung33');
			if($scope.dataTertanggung33 == null){
				$scope.dataTertanggung33 = {
					'statusPernikahanTertanggung':''
				}
			}
			
			
			$scope.newPenerimaManfaat = {
				'namaPenerimaManfaat':$scope.dataTertanggung13.namaLengkapTertanggung,
				'tglLahirPenerimaManfaat':new Date($scope.dataTertanggung13.tglLahirTertanggung),
				'tempatLahirPenerima':$scope.dataTertanggung13.tempatLahirTertanggung,
				'penerimaManfaatHubungan':'sendiri',
				'statusPenerimaManfaat':$scope.dataTertanggung33.statusPernikahanTertanggung,
				'jenkelPenerimaManfaat': $scope.dataTertanggung13.jenkelTertanggung
			};

			spajProvider.addPenerimaManfaat(spajProvider.getSpajGUID(),'aplikasiSPAJOnline.tambahPenerimaManfaat',$scope.newPenerimaManfaat);
			$scope.dataPenerimaManfaat = spajProvider.getPenerimaManfaat(spajProvider.getSpajGUID(),'aplikasiSPAJOnline.tambahPenerimaManfaat',false);
		}
	});
	
	$scope.moveToNextPage = function(){
		if($scope.data.isPagePenerimaManfaatAccepted){
			if(confirm('Langsung menuju ke halaman form isian SKK?') ){
					$state.go('aplikasiSPAJOnline.sKKTertanggung',{}, {reload: true, inherit: false});
			
			}else{
				return false;
			}
		}


	}

}])
   
.controller('sKKTertanggungUtamaCtrl', [
	'$scope', 
	'$stateParams', 
	'spajProvider',
	'dataFactory',
	'$store',
function ($scope, $stateParams, spajProvider,dataFactory,$store) {
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

	var $temp = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung13');
	
	$scope.jenkelTertanggungUtama = $temp.jenkelTertanggung;
	
	$scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.sKKTertanggungUtama',
                'data':$scope.data
        };
		
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.sKKTertanggungUtama'), true));
    }
	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.sKKTertanggungUtama') == null ){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'skkIsPenyakitKeturunan':false,
			'skkJenisPenyakitKeturunan':'',
			'skkIsRawatinap':false,
			'skkIsMerokok':false,
			'skkRokokBatangSehari':'',
			'skkIsNarkoba':false,
			'skkIsAlkohol':false,
			'jenkelTertanggung':'',
			'skkWanitaIsPapSmear':false,
			'skkWanitaIsHaidTerganggu':false,
			'skkWanitaIsHamil':false,
			'skkWanitaIsCesar':false,
			'skkWanitaIsKeguguran':false,
			'skkWanitaSulitLahir':false,
			'isSkkUtamaOk':false
		}
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.sKKTertanggungUtama');
	}

    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };

}])
   
.controller('sKKTertanggungTambahanCtrl', [
	'$scope', 
	'$stateParams', 
	'spajProvider',
	'dataFactory',
	'$store',
function ($scope, $stateParams, spajProvider,dataFactory,$store) {
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

	var $temp = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung13');
	
	$scope.jenkelTertanggungUtama = $temp.jenkelTertanggung;
	
	$scope.saveDataSpaj = function(){
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.sKKTertanggungTambahan',
                'data':$scope.data
        };
		
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.sKKTertanggungUtama'), true));
    }
	if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.sKKTertanggungTambahan') == null ){
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'skkIsPenyakitKeturunan':false,
			'skkJenisPenyakitKeturunan':'',
			'skkIsRawatinap':false,
			'skkIsMerokok':false,
			'skkRokokBatangSehari':'',
			'skkIsNarkoba':false,
			'skkIsAlkohol':false,
			'jenkelTertanggung':'',
			'skkWanitaIsPapSmear':false,
			'skkWanitaIsHaidTerganggu':false,
			'skkWanitaIsHamil':false,
			'skkWanitaIsCesar':false,
			'skkWanitaIsKeguguran':false,
			'skkWanitaSulitLahir':false,
			'isSkkUtamaOk':false
		}
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.sKKTertanggungTambahan');
	}

    $scope.showAlert = function(title,message) {
    var alertPopup = $ionicPopup.alert({
            title:title,
            template: message
        });
        
        alertPopup.then(function(res) {
        //console.log('Thank you for not eating my delicious ice cream cone');
        });
    };

}])
   
.controller('lembarPersetujuanCtrl', [
	'$scope', 
	'$stateParams', 
	'spajProvider',
	'dataFactory',
	'$store',
	'$state',
function ($scope, $stateParams, spajProvider, dataFactory,$store,$state) {
	$scope.scroll = true;
	$scope.spaj_guid = spajProvider.getSpajGUID();
	
			$scope.data = {
			'isMenyetujuiKetentuan':false
		}
	$scope.moveToNextPage = function(){
		

		
		if($scope.data.isMenyetujuiKetentuan){
			if(confirm('Langsung menuju ke halaman form halaman Submit SPAJ?') ){
					$state.go('aplikasiSPAJOnline.tinjauUlangDanKirimDokumen', '', {reload: true, inherit: false});
			}else{
				return false;
			}
		}


	}
	
	
		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.lembarPersetujuan') == null ){
		$scope.data = {
			'spaj_guid':$scope.spaj_guid,
			'isMengertiKetentuan': false,
			'isMenyetujuiKetentuan': false,
			'sign1': '',
			'sign2': '',
		};
	} else {
		$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.lembarPersetujuan');
	}
	
	$scope.saveDataSpaj = function(){
		
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.lembarPersetujuan',
                'data':$scope.data
        };
		
		//console.log($formdata);
		
		spajProvider.setSpajGUID($scope.data.spaj_guid);
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        
    }
	
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
}])
   
.controller('tinjauUlangDanKirimDokumenCtrl', [
	'$scope'
	,'$state'
	,'$stateParams'
	,'spajProvider'
	,'dataFactory'
	,'$store'
	,'$http'
	,'$ionicLoading'
	,'$ionicPopup'
	,'$location'
	,'$window'
	,'$document'
	,   
function ($scope,$state, $stateParams, spajProvider,dataFactory,$store,$http,$ionicLoading,$ionicPopup,$location,$window,$document) {
			$scope.spaj_guid = spajProvider.getSpajGUID();
			$scope.idagen = getQueryParam('idagen');
			$scope.token = getQueryParam('token');
			$scope.android_ver = getQueryParam('android_ver');
			$scope.device = getQueryParam('device');
			$scope.tanggal_submit = Math.round(+new Date()/1000);
			$scope.proposal_build_id = 'SPAJ_ONLINE_v1';
			
			$scope.imageKtpTertanggung = null;
			$scope.imageKTPpempol = null;
			
			$scope.sign1image = null;
			$scope.sign2image = null;
			
			
			$scope.isValidDataTertanggung = false;
			$scope.isValidDataTertanggungTambahan = false;
			$scope.isValidDataPempol = false;
			$scope.isValidDataProdukManfaat = false;
			$scope.isValidDataPekerjaanTertanggung = false;
			$scope.isValidDataPekerjaanPempol = false;
			$scope.isValidDataSKKTU = false;
			$scope.isValidDataSKKTT = false;
			$scope.isValidDataPersetujuan = false;
			
			$scope.messages = [];
			
			//INIT FORM 
			$scope.$on('$ionicView.enter', function() {
				$scope.init_data();
				$scope.init_display();
			});

			$scope.init_display = function(){
				return true;
			};

			$scope.data_retrive = function(){
			
				$scope.messages = [];
				
				bol1 = false;
				bol2 = false;
				bol3 = false;
				//TERTANGGUNG
				$scope.sumberDataTertanggung1 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataTertanggung13');
					if($scope.sumberDataTertanggung1 == null) {
							$scope.messages.push({'message':'Silakan lengkapi data identitas tertanggung.'})
						}else{
							bol1 = true;
						}
				try{
					$scope.imageKtpTertanggung = atob(atob($scope.sumberDataTertanggung1.imageKTPTertanggung))
				} catch (e) {
					$scope.messages.push({'message':'Invalid Image KTP Tertanggung '+e});
				}

				$scope.sumberDataTertanggung2 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataTertanggung23');
				if($scope.sumberDataTertanggung2 == null) 
					{	
						$scope.messages.push({'message':'Silakan lengkapi data tempat tinggal tertanggung.'})
					} else {
						bol2 = true;
					};

				$scope.sumberDataTertanggung3 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataTertanggung33');
				if($scope.sumberDataTertanggung3 == null) {
						$scope.messages.push({'message':'Silakan lengkapi data pendukung tertanggung.'})
					} else {
						bol3 = true;
					};

				if(bol1 && bol2 && bol3)  $scope.isValidDataTertanggung = true;
				
				bol1 = false;
				bol2 = false;
				bol3 = false;
				
				
				//PEMPOL
				$scope.sumberDataPempol1 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataPemegangPolis13');
				if($scope.sumberDataPempol1 == null) {
					$scope.messages.push({'message':'Silakan lengkapi data identitas pemegang polis.'});
				}else{
					bol1= true;
				}
				try{
					$scope.imageKTPpempol = atob(atob($scope.sumberDataPempol1.imageKTPpempol))
				} catch (e){
					$scope.messages.push({'message':'Invalid Image KTP Pempo '+e});
				}
				$scope.sumberDataPempol2 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataPemegangPolis23');
				if($scope.sumberDataPempol2 == null) {
					$scope.messages.push({'message':'Silakan lengkapi data tempat tinggal pemegang polis.'})				
				}else{
					bol2= true;
				};

				$scope.sumberDataPempol3 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataPemegangPolis33');
				if($scope.sumberDataPempol3 == null){
					$scope.messages.push({'message':'Silakan lengkapi data pendukung pemegang polis.'});				
				}else{
					bol3= true;
				}
				
				if(bol1 && bol2 && bol3)  $scope.isValidDataPempol = true;
				bol1 = false;
				bol2 = false;
				bol3 = false;
				
				
				
				//PEKERJAAN
				$scope.pekerjaanTertanggung = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.pekerjaanTertanggung');
				if($scope.pekerjaanTertanggung == null) {
					$scope.messages.push({'message':'Silakan lengkapi data pekerjaan Tertanggung.'});
				}else{
					bol1 = true;
				}
				$scope.isValidDataPekerjaanTertanggung = bol1;
				
				$scope.pekerjaanPemegangPolis = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.pekerjaanPemegangPolis');
				
				if($scope.pekerjaanPemegangPolis == null) {
					if(!$scope.sumberDataPempol1.isTertanggungPempol){
						$scope.messages.push({'message':'Silakan lengkapi data pekerjaan pemegang polis.'});
					}else{
						bol2 = true;
					}
				}else{
					bol2 = true;
				}
				$scope.isValidDataPekerjaanPempol = bol2;
				
				
				
				bol1 = false;
				bol2 = false;
				bol3 = false;
				
				//SKK
				$scope.data_skk_utama = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.sKKTertanggung');
				//console.log($scope.data_skk_utama);
				
				if($scope.data_skk_utama == null) {
					$scope.messages.push({'message':'Silakan lengkapi SKK tertanggung utama'});
				}
					else
				{
					bol1 = true;
				}
				$scope.isValidDataSKKTU = bol1;
				$scope.isValidDataSKKTT = bol1;
				bol1 = false;
				bol2 = false;
				bol3 = false;
				
				
				//DOKUMEN N PRODUK
				$scope.data_dokumen = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dokumenPendukungSPAJ::dokumen_spaj');
				if($scope.data_dokumen == null){
					$scope.messages.push({'message':'Tidak Ada dokumen lampiran.'});
				}else{
					bol1 = true;
				} 

				$scope.data_produk = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.produkDanManfaat12');
				if($scope.data_produk == null){
					 $scope.messages.push({'message':'Silakan lengkapi form produk.'});
				}else{
					bol1 = true;
				
				}
				$scope.isValidDataProdukManfaat = true;
				bol1 = false;
				bol2 = false;
				bol3 = false;
				
				
				
				//PENERIMA MANFAAT
				$scope.data_penerima_manfaat = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.tambahPenerimaManfaat::penerima_manfaat');
				if($scope.data_penerima_manfaat == null) $scope.messages.push({'message':'Silakan lengkapi penerima manfaat.'});

				
				//PERSETUJUAN x
				$scope.data_persetujuan =  $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.lembarPersetujuan');
				if($scope.data_persetujuan == null){
					$scope.messages.push({'message':'Silakan lengkapi tanda tanggan.'});
				}else{
					bol1 = true;
				}
				$scope.isValidDataPersetujuan = bol1;
				
				try{
					$scope.sign1image = $scope.data_persetujuan.sign1;
					$scope.sign2image = $scope.data_persetujuan.sign2;
				} catch (e){
					$scope.messages.push({'message':'Invalid Image Sign '+e});
				}
			}
				
			$scope.init_data = function(){
				$scope.data_diri_tertanggung = '';
				$scope.data_diri_pemegang_polis = [];
				$scope.data_pekerjaan_pempol = '';
				$scope.data_pekerjaan_tertanggung = '';
				$scope.data_skk = []; //skk_tertanggung_utama {} //skk_tertanggung_tambahan []
				$scope.data_penerima_manfaat = '';
				$scope.data_dokumen = '';
				$scope.data_produk = '';
				$scope.data_persetujuan = '';
		
				$scope.data_retrive();
				
				console.log($scope.messages);

			}

			$scope.moveToPersetujuan = function(){
				$state.go('aplikasiSPAJOnline.lembarPersetujuan',  
					'', {reload: true, inherit: false});
			}			
			
			$scope.moveToTertanggung = function(){
				$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1',  
					'', {reload: true, inherit: false});
			}
			$scope.moveToTertanggungTambahan = function(){
				$state.go('aplikasiSPAJOnline.dataTertanggung33_tab1',  
					'', {reload: true, inherit: false});
			}
			$scope.moveToSKK = function(){
					$state.go('aplikasiSPAJOnline.sKKTertanggung',  
					{}, {reload: true, inherit: false});
			}			
			$scope.moveToProduk = function(){
				$state.go('aplikasiSPAJOnline.produkDanManfaat12',  
					'', {reload: true, inherit: false});
			}			
			$scope.moveToPemegangPolis = function(){
				$state.go('aplikasiSPAJOnline.dataPemegangPolis13',  
					'', {reload: true, inherit: false});
			}
			
	$scope.finalFormValidation = function(){
				//validate datanya
				$scope.messages = [];
				try{
					if($scope.data == null){
						$scope.messages.push({"message":"Data ERROR. Null data."});
					}
				}catch (e){
					$scope.messages.push({'message':"Data ERROR. "+e}) ;
				}

				try{
					tryMe = $scope.data.namaLengkapTertanggung;
					if($scope.data.namaLengkapTertanggung == '' && !(tryMe.match(/^[a-z\d\-_\s]+$/i)) ){
						$scope.messages.push({'message':"Nama Tertanggung harus benar!"}) ;
					}
					
				}catch (e){
					$scope.messages.push({'message':"Data ERROR. " + e}) ;
				}
				
				if(!$scope.imgDokumenKtpChanged){
					$scope.messages.push({'message':"Silahkan foto KTP Tertanggung"}) ;
				}

				if($scope.messages.length > 0){
					return $scope.messages;
				} 
				return false;
			}
			 
			 if((typeof  $scope.pekerjaanPemegangPolis == 'object') && ($scope.pekerjaanPemegangPolis == null)){
				$scope.pekerjaanPemegangPolis = {
						'jenisPerusahaanPempol': '',
						'pekerjaanPempol':'',
						'pangkatPempol':'',
						'klasifikasiPekerjaanPempol': '',
						'rangeGajiPempol': '',
						'rangePendapatanPempol':'',
						'rangePendapatanPasanganPempol': '',
						'namaPerusahaanPempol': '',
						'alamatPerusahaanPempol': '',
						'kodeposPerusahaanPempol': '',
						'nomorTeleponPerusahaanPempol':'',
						'nomorEkstensiPerusahaanPempol':'',
						'isPagePekerjaanPempol1Accepted':'',
						'pemilikWirausahaPempol':'',
						'bidangWirausahaPempol':'',
						'namaWirausahaPempol':'',
						'alamatWirausahaPempol':''
				}
			 }			 
			 
			 $scope.data_skk_tambahan = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.sKKTertanggungTambahan');
			 if((typeof  $scope.data_skk_tambahan == 'object') && ($scope.data_skk_tambahan == null)){
				$scope.data_skk_tambahan = { 		
						'skkIsPenyakitKeturunan':false,
						'skkJenisPenyakitKeturunan':'',
						'skkIsRawatinap':false,
						'skkIsMerokok':false,
						'skkRokokBatangSehari':'',
						'skkIsNarkoba':false,
						'skkIsAlkohol':false,
						'jenkelTertanggung':'',
						'skkWanitaIsPapSmear':false,
						'skkWanitaIsHaidTerganggu':false,
						'skkWanitaIsHamil':false,
						'skkWanitaIsCesar':false,
						'skkWanitaIsKeguguran':false,
						'skkWanitaSulitLahir':false,
						'isSkkUtamaOk':false
				}
			 }
			 


			 				try{
					$scope.data_diri_tertanggung = {
						"namaLengkapTertanggung": $scope.sumberDataTertanggung1.namaLengkapTertanggung,
						"nomorKTPTertanggung":  $scope.sumberDataTertanggung1.nomorKTPTertanggung,
						"tglLahirTertanggung":  $scope.sumberDataTertanggung1.tglLahirTertanggung,
						"nomorNPWPTertanggung":  $scope.sumberDataTertanggung1.nomorNPWPTertanggung,
						"jenkelTertanggung":  $scope.sumberDataTertanggung1.jenkelTertanggung,
						"agamaTertanggung":  $scope.sumberDataTertanggung1.agamaTertanggung,
						"imageKTPTertanggung":   $scope.sumberDataTertanggung1.imageKTPTertanggung,
						"isPageTertanggung1Accepted":  $scope.sumberDataTertanggung1.isPageTertanggung1Accepted,

						"statusTinggalKTPtertanggung": $scope.sumberDataTertanggung2.statusTinggalKTPtertanggung,
						"alamatKTPtertanggung": $scope.sumberDataTertanggung2.alamatKTPtertanggung,
						"provinsiKTPtertanggung": $scope.sumberDataTertanggung2.provinsiKTPtertanggung,
						"kabupatenKTPtertanggung":$scope.sumberDataTertanggung2.kabupatenKTPtertanggung,
						"kodeposKTPtertanggung": $scope.sumberDataTertanggung2.kodeposKTPtertanggung,
						"isAlamatKTPtertanggungSama": $scope.sumberDataTertanggung2.isAlamatKTPtertanggungSama,
						"statusTinggalSurattertanggung": $scope.sumberDataTertanggung2.statusTinggalSurattertanggung,
						"alamatSurattertanggung": $scope.sumberDataTertanggung2.alamatSurattertanggung,
						"provinsiSurattertanggung": $scope.sumberDataTertanggung2.provinsiSurattertanggung,
						"kabupatenSurattertanggung": $scope.sumberDataTertanggung2.kabupatenSurattertanggung,
						"kodeposSurattertanggung":  $scope.sumberDataTertanggung2.kodeposSurattertanggung,
						"nomorHptertanggung": $scope.sumberDataTertanggung2.nomorHptertanggung,
						"nomorTelptertanggung": $scope.sumberDataTertanggung2.nomorTelptertanggung,
						"emailtertanggung": $scope.sumberDataTertanggung2.emailtertanggung,
						"isSetujuHPtertanggung": $scope.sumberDataTertanggung2.isSetujuHPtertanggung,
						"isSetujuEmailtertanggung": $scope.sumberDataTertanggung2.isSetujuEmailtertanggung,
						"isPageTertanggung2Accepted": $scope.sumberDataTertanggung2.isPageTertanggung2Accepted,

						"tinggiBadanTertanggung": $scope.sumberDataTertanggung3.tinggiBadanTertanggung,
						"beratBadanTertanggung": $scope.sumberDataTertanggung3.beratBadanTertanggung,
						"ibuKandungTertanggung": $scope.sumberDataTertanggung3.ibuKandungTertanggung,
						"pendidikanTertanggung": $scope.sumberDataTertanggung3.pendidikanTertanggung,
						"statusPernikahanTertanggung": $scope.sumberDataTertanggung3.statusPernikahanTertanggung,
						"namaSaudaraTertanggung": $scope.sumberDataTertanggung3.namaSaudaraTertanggung,
						"alamatSuratSaudaraTertanggung": $scope.sumberDataTertanggung3.alamatSuratSaudaraTertanggung,
						"provinsiSuratSaudaraTertanggung": $scope.sumberDataTertanggung3.provinsiSuratSaudaraTertanggung,
						"kabupatenSuratSaudaraTertanggung": $scope.sumberDataTertanggung3.kabupatenSuratSaudaraTertanggung,
						"kodeposSuratSaudaraTertanggung": $scope.sumberDataTertanggung3.kodeposSuratSaudaraTertanggung,
						"hpSuratSaudaraTertanggung": $scope.sumberDataTertanggung3.hpSuratSaudaraTertanggung,
						"noTelpSaudaraTertanggung": $scope.sumberDataTertanggung3.noTelpSaudaraTertanggung,
						"isPageTertanggung3Accepted": $scope.sumberDataTertanggung3.isPageTertanggung3Accepted,
					}
					
					$scope.data_diri_pemegang_polis = {
						'agamaPempol':$scope.sumberDataPempol1.agamaPempol,
						'jenkelPempol':$scope.sumberDataPempol1.jenkelPempol,
						'isKTPPempolAllAge':$scope.sumberDataPempol1.isKTPPempolAllAge,
						"tglLahirPempol":  $scope.sumberDataTertanggung1.tglLahirPempol,
						'isPagePempol1Accepted':$scope.sumberDataPempol1.isPagePempol1Accepted,
						'namaLengkapPempol':$scope.sumberDataPempol1.namaLengkapPempol,
						'nomorKTPPempol':$scope.sumberDataPempol1.nomorKTPPempol,
						'nomorNPWPPempol':$scope.sumberDataPempol1.nomorNPWPPempol,
						'masaBerlakuKTPPempol':$scope.sumberDataPempol1.masaBerlakuKTPPempol,
						'imageKTPpempol':$scope.sumberDataPempol1imageKTPpempol,
						'isTertanggungPempol':$scope.sumberDataPempol1.isTertanggungPempol,

						'provinsiKTPPempol':$scope.sumberDataPempol2.provinsiKTPPempol,
						'provinsiSuratPempol':$scope.sumberDataPempol2.provinsiSuratPempol,
						'statusTinggalKTPPempol':$scope.sumberDataPempol2.statusTinggalKTPPempol,
						'statusTinggalSuratPempol':$scope.sumberDataPempol2.statusTinggalSuratPempol,
						'alamatKTPPempol':$scope.sumberDataPempol2.alamatKTPPempol,
						'kabupatenKTPPempol':$scope.sumberDataPempol2.kabupatenKTPPempol,
						'kodeposKTPPempol':$scope.sumberDataPempol2.kodeposKTPPempol,
						'isAlamatKTPPempolSama':$scope.sumberDataPempol2.isAlamatKTPPempolSama,
						'alamatSuratPempol':$scope.sumberDataPempol2.alamatSuratPempol,
						'kabupatenSuratPempol':$scope.sumberDataPempol2.kabupatenSuratPempol,
						'kodeposSuratPempol':$scope.sumberDataPempol2.kodeposSuratPempol,
						'nomorHpPempol':$scope.sumberDataPempol2.nomorHpPempol,
						'nomorTelpPempol':$scope.sumberDataPempol2.nomorTelpPempol,
						'emailPempol':$scope.sumberDataPempol2.emailPempol,
						'isSetujuHPPempol':$scope.sumberDataPempol2.isSetujuHPPempol,
						'isSetujuEmailPempol':$scope.sumberDataPempol2.isSetujuEmailPempol,
						'isPagePempol2Accepted':$scope.sumberDataPempol2.isPagePempol2Accepted,

						'provinsiSuratTakSerumahPempol':$scope.sumberDataPempol3.provinsiSuratTakSerumahPempol,
						'statusNikahPempol':$scope.sumberDataPempol3.statusNikahPempol,
						'pendidikanPempol':$scope.sumberDataPempol3.pendidikanPempol,
						'tinggiBadanPempol':$scope.sumberDataPempol3.tinggiBadanPempol,
						'beratBadanPempol':$scope.sumberDataPempol3.beratBadanPempol,
						'namaIbuPempol':$scope.sumberDataPempol3.namaIbuPempol,
						'namaSaudaraTakSerumahPempol':$scope.sumberDataPempol3.namaSaudaraTakSerumahPempol,
						'alamatSuratTakSerumahPempol':$scope.sumberDataPempol3.alamatSuratTakSerumahPempol,
						'kabupatenTakSerumahPempol':$scope.sumberDataPempol3.kabupatenTakSerumahPempol,
						'kodeposSuratSaudaraTertanggung':$scope.sumberDataPempol3.kodeposSuratSaudaraTertanggung,
						'kodeposTakSerumahPempol':$scope.sumberDataPempol3.kodeposTakSerumahPempol,
						'noHPTakSerumah':$scope.sumberDataPempol3.noHPTakSerumah,
						'noTelTakSerumah':$scope.sumberDataPempol3.noTelTakSerumah,
						'isPagePempol3Accepted':$scope.sumberDataPempol3.isPagePempol3Accepted,
						'isTertanggungPempol':$scope.sumberDataPempol3.isTertanggungPempol,
					}
				
				
					$scope.data_pekerjaan_tertanggung = {
							'jenisPerusahaanTertanggung': (typeof $scope.pekerjaanTertanggung.jenisPerusahaanTertanggung == null)?'':$scope.pekerjaanTertanggung.jenisPerusahaanTertanggung,
							'pekerjaanTertanggung':(typeof $scope.pekerjaanTertanggung.pekerjaanTertanggung == null)?'':$scope.pekerjaanTertanggung.pekerjaanTertanggung,
							'pangkatTertanggung':(typeof $scope.pekerjaanTertanggung.pangkatTertanggung == null)?'':$scope.pekerjaanTertanggung.pangkatTertanggung,
							'klasifikasiPekerjaanTertanggung':(typeof $scope.pekerjaanTertanggung.klasifikasiPekerjaanTertanggung == null)?'':$scope.pekerjaanTertanggung.klasifikasiPekerjaanTertanggung,
							'rangeGajiTertanggung':(typeof $scope.pekerjaanTertanggung.rangeGajiTertanggung == null)?'':$scope.pekerjaanTertanggung.rangeGajiTertanggung,
							'rangePendapatanTertanggung':(typeof $scope.pekerjaanTertanggung.rangePendapatanTertanggung == null)?'':$scope.pekerjaanTertanggung.rangePendapatanTertanggung,
							'rangePendapatanPasangan':(typeof $scope.pekerjaanTertanggung.rangePendapatanPasangan == null)?'':$scope.pekerjaanTertanggung.rangePendapatanPasangan,
							'namaPerusahaanTertanggung':(typeof $scope.pekerjaanTertanggung.namaPerusahaanTertanggung == null)?'':$scope.pekerjaanTertanggung.namaPerusahaanTertanggung,
							'alamatPerusahaanTertanggung':(typeof $scope.pekerjaanTertanggung.alamatPerusahaanTertanggung == null)?'':$scope.pekerjaanTertanggung.alamatPerusahaanTertanggung,
							'kodeposPerusahaanTertanggung':(typeof $scope.pekerjaanTertanggung.kodeposPerusahaanTertanggung == null)?'':$scope.pekerjaanTertanggung.kodeposPerusahaanTertanggung,
							'nomorTeleponPerusahaanTertanggung':(typeof $scope.pekerjaanTertanggung.nomorTeleponPerusahaanTertanggung == null)?'':$scope.pekerjaanTertanggung.nomorTeleponPerusahaanTertanggung,
							'nomorEkstensiPerusahaanTertanggung':(typeof $scope.pekerjaanTertanggung.nomorEkstensiPerusahaanTertanggung == null)?'':$scope.pekerjaanTertanggung.nomorEkstensiPerusahaanTertanggung,
							'isPagePekerjaanTertanggung1Accepted':(typeof $scope.pekerjaanTertanggung.isPagePekerjaanTertanggung1Accepted == null)?'':$scope.pekerjaanTertanggung.isPagePekerjaanTertanggung1Accepted,
							'pemilikWirausahaTertanggung':(typeof $scope.pekerjaanTertanggung.pemilikWirausahaTertanggung == null)?'':$scope.pekerjaanTertanggung.pemilikWirausahaTertanggung,
							'bidangWirausahaTertanggung':(typeof $scope.pekerjaanTertanggung.pemilikWirausahaTertanggung == null)?'':$scope.pekerjaanTertanggung.pemilikWirausahaTertanggung,
							'namaWirausahaTertanggung':(typeof $scope.pekerjaanTertanggung.namaWirausahaTertanggung == null)?'':$scope.pekerjaanTertanggung.namaWirausahaTertanggung,
							'alamatWirausahaTertanggung':(typeof $scope.pekerjaanTertanggung.alamatWirausahaTertanggung == null)?'':$scope.pekerjaanTertanggung.alamatWirausahaTertanggung
					}				
					
					
					$scope.data_pekerjaan_pempol = {
						'jenisPerusahaanPempol': (typeof $scope.pekerjaanPemegangPolis.jenisPerusahaanPempol== null)?'':$scope.pekerjaanPemegangPolis.jenisPerusahaanPempol,
						'pekerjaanPempol': (typeof $scope.pekerjaanPemegangPolis.pekerjaanPempol== null)?'':$scope.pekerjaanPemegangPolis.pekerjaanPempol,
						'pangkatPempol': (typeof $scope.pekerjaanPemegangPolis.pangkatPempol== null)?'':$scope.pekerjaanPemegangPolis.pangkatPempol,
						'klasifikasiPekerjaanPempol': (typeof $scope.pekerjaanPemegangPolis.klasifikasiPekerjaanPempol== null)?'':$scope.pekerjaanPemegangPolis.klasifikasiPekerjaanPempol,
						'rangeGajiPempol': (typeof $scope.pekerjaanPemegangPolis.rangeGajiPempol== null)?'':$scope.pekerjaanPemegangPolis.rangeGajiPempol,
						'rangePendapatanPempol': (typeof $scope.pekerjaanPemegangPolis.rangePendapatanPempol== null)?'':$scope.pekerjaanPemegangPolis.rangePendapatanPempol,
						'rangePendapatanPasanganPempol': (typeof $scope.pekerjaanPemegangPolis.rangePendapatanPasanganPempol== null)?'':$scope.pekerjaanPemegangPolis.rangePendapatanPasanganPempol,
						'namaPerusahaanPempol': (typeof $scope.pekerjaanPemegangPolis.namaPerusahaanPempol== null)?'':$scope.pekerjaanPemegangPolis.namaPerusahaanPempol,
						'alamatPerusahaanPempol': (typeof $scope.pekerjaanPemegangPolis.alamatPerusahaanPempol== null)?'':$scope.pekerjaanPemegangPolis.alamatPerusahaanPempol,
						'kodeposPerusahaanPempol': (typeof $scope.pekerjaanPemegangPolis.kodeposPerusahaanPempol== null)?'':$scope.pekerjaanPemegangPolis.kodeposPerusahaanPempol,
						'nomorTeleponPerusahaanPempol': (typeof $scope.pekerjaanPemegangPolis.nomorTeleponPerusahaanPempol== null)?'':$scope.pekerjaanPemegangPolis.nomorTeleponPerusahaanPempol,
						'nomorEkstensiPerusahaanPempol': (typeof $scope.pekerjaanPemegangPolis.nomorEkstensiPerusahaanPempol== null)?'':$scope.pekerjaanPemegangPolis.nomorEkstensiPerusahaanPempol,
						'isPagePekerjaanPempol1Accepted': (typeof $scope.pekerjaanPemegangPolis.isPagePekerjaanPempol1Accepted== null)?'':$scope.pekerjaanPemegangPolis.isPagePekerjaanPempol1Accepted,
						'pemilikWirausahaPempol':(typeof $scope.pekerjaanTertanggung.pemilikWirausahaPempol == null)?'':$scope.pekerjaanTertanggung.pemilikWirausahaPempol,
						'bidangWirausahaPempol':(typeof $scope.pekerjaanTertanggung.bidangWirausahaPempol == null)?'':$scope.pekerjaanTertanggung.bidangWirausahaPempol,
						'namaWirausahaPempol':(typeof $scope.pekerjaanTertanggung.namaWirausahaPempol == null)?'':$scope.pekerjaanTertanggung.namaWirausahaPempol,
						'alamatWirausahaPempol':(typeof $scope.pekerjaanTertanggung.alamatWirausahaPempol == null)?'':$scope.pekerjaanTertanggung.alamatWirausahaPempol
					}
				
					$scope.data_skk = [
					{'skk_tertanggung_utama':{
								'skkIsPenyakitKeturunan': $scope.data_skk_utama.skkIsPenyakitKeturunan,
								'skkJenisPenyakitKeturunan':$scope.data_skk_utama.skkJenisPenyakitKeturunan,
								'skkIsRawatinap':$scope.data_skk_utama.skkIsRawatinap,
								'skkIsMerokok':$scope.data_skk_utama.skkIsMerokok,
								'skkRokokBatangSehari':$scope.data_skk_utama.skkRokokBatangSehari,
								'skkIsNarkoba':$scope.data_skk_utama.skkIsNarkoba,
								'skkIsAlkohol':$scope.data_skk_utama.skkIsAlkohol,
								'jenkelTertanggung':$scope.data_skk_utama.jenkelTertanggung,
								'skkWanitaIsPapSmear':$scope.data_skk_utama.skkWanitaIsPapSmear,
								'skkWanitaIsHaidTerganggu':$scope.data_skk_utama.skkWanitaIsHaidTerganggu,
								'skkWanitaIsHamil':$scope.data_skk_utama.skkWanitaIsHamil,
								'skkWanitaIsCesar':$scope.data_skk_utama.skkWanitaIsCesar,
								'skkWanitaIsKeguguran':$scope.data_skk_utama.skkWanitaIsKeguguran,
								'skkWanitaSulitLahir':$scope.data_skk_utama.skkWanitaSulitLahir,
								'isSkkUtamaOk':$scope.data_skk_utama.isSkkUtamaOk
							}
							,'skk_tertanggung_tambahan':{
								'skkIsPenyakitKeturunan':$scope.data_skk_tambahan.skkIsPenyakitKeturunan,
								'skkJenisPenyakitKeturunan':$scope.data_skk_tambahan.skkJenisPenyakitKeturunan,
								'skkIsRawatinap':$scope.data_skk_tambahan.skkIsRawatinap,
								'skkIsMerokok':$scope.data_skk_tambahan.skkIsMerokok,
								'skkRokokBatangSehari':$scope.data_skk_tambahan.skkRokokBatangSehari,
								'skkIsNarkoba':$scope.data_skk_tambahan.skkIsNarkoba,
								'skkIsAlkohol':$scope.data_skk_tambahan.skkIsAlkohol,
								'jenkelTertanggung':$scope.data_skk_tambahan.jenkelTertanggung,
								'skkWanitaIsPapSmear':$scope.data_skk_tambahan.skkWanitaIsPapSmear,
								'skkWanitaIsHaidTerganggu':$scope.data_skk_tambahan.skkWanitaIsHaidTerganggu,
								'skkWanitaIsHamil':$scope.data_skk_tambahan.skkWanitaIsHamil,
								'skkWanitaIsCesar':$scope.data_skk_tambahan.skkWanitaIsCesar,
								'skkWanitaIsKeguguran':$scope.data_skk_tambahan.skkWanitaIsKeguguran,
								'skkWanitaSulitLahir':$scope.data_skk_tambahan.skkWanitaSulitLahir,
								'isSkkTambahanOk':$scope.data_skk_tambahan.isSkkTambahanOk
						}
					 }
					]

				}catch(e){
					alert('Terdapat data yang kurang lengkap!\n\n'+e);
					return false;
				}
			 
			 
			 $scope.envelope = null;
			 
	$scope.submitToServer = function(){
		if(confirm('APAKAH ANDA INGIN MENGIRIM SPAJ INI?\n\nPastikan SPAJ telah diisi dengan benar dan ditandatangani Calon Nasabah.\n\nData yang telah terkirim tidak dapat di-edit kembali!')){

				//bungkuss!!!
				
				$scope.envelope = {
					'id_agen': $scope.idagen,
					'spaj_guid':$scope.spaj_guid,
					'android_ver':$scope.android_ver,
					'device':$scope.device,
					'tanggal_submit':$scope.tanggal_submit,
					'proposal_build_id':$scope.proposal_build_id,
					'data_diri_tertanggung':$scope.data_diri_tertanggung,
					'data_diri_pemegang_polis':$scope.data_diri_pemegang_polis,
					'data_pekerjaan_pempol':$scope.data_pekerjaan_pempol,
					'data_pekerjaan_tertanggung':$scope.data_pekerjaan_tertanggung,
					'data_skk':$scope.data_skk,
					'data_penerima_manfaat':$scope.data_penerima_manfaat,
					'data_dokumen':$scope.data_dokumen,
					'data_produk':$scope.data_produk,
					'data_persetujuan':$scope.data_persetujuan,
				}
			
				$scope.submit($scope.envelope);
			}

	}
	
	$scope.response = '';
	
	$scope.submit = function(param){
		var link = 'http://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/submitter.php?act=save_spaj&idagen=0000001416&token=855f1ef1';
		$scope.showSpinner();
		
		$http.post(link, 
			"spaj_guid=" + $scope.spaj_guid +
			"&data="+angular.toJson(param)
		,{
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded; charset=UTF-8'
			}
		}).then(function (res){
			$scope.hideSpinner();
			console.log(res.data);
			$scope.showAlert('Status Pengiriman SPAJ',res.data.message, true)
		});
	};

	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
	  $scope.showSpinner = function() {
    $ionicLoading.show({
      template: 'Mengirim data SPAJ...'
    })
  };
  
    $scope.hideSpinner = function(){
    $ionicLoading.hide()
  };
  
  
  	$scope.showAlert = function(title,message) {
		var alertPopup = $ionicPopup.alert({
			title:title,
			template: message
		});

		alertPopup.then(function(res) {

			angular.element(document.querySelectorAll('#homeButton')).triggerHandler('click');
			spajProvider.delUnsavedSpajGuid($scope.spaj_guid);
		});
    };
}])
   
.controller('dokumenPendukungSPAJCtrl', [
	'$scope',
	'$stateParams', 
	'spajProvider',
	'dataFactory',
	'$store',
	'$ionicPopup',
	'$state',
function ($scope, $stateParams, spajProvider,dataFactory,$store,$ionicPopup,$state) {
$scope.daftarDokumen = false;
$scope.daftarDokumens = [];
		$scope.data = {
			'isPageDocumentAccepted':false
		}
	$scope.moveToNextPage = function(){
		

		
		if($scope.data.isPageDocumentAccepted){
			if(confirm('Langsung menuju ke halaman form halaman Persetujuan?') ){
			//angular.element(document.querySelectorAll('#dataTertanggung13-button2')).triggerHandler('click');
					$state.go('aplikasiSPAJOnline.lembarPersetujuan',  
					'', {reload: true, inherit: false});
			}else{
				return false;
			}
		}


	}
	
	
	$scope.daftarDokumen = 	spajProvider.getDokumen(
		spajProvider.getSpajGUID(),
		'aplikasiSPAJOnline.dokumenPendukungSPAJ',
		false);
		
	if((typeof $scope.daftarDokumen == 'object') && ($scope.daftarDokumen != null)){
		for(i=0;i < $scope.daftarDokumen.length; i++){
			$scope.daftarDokumens.push({
				'addKeteranganDokumen':$scope.daftarDokumen[i].addKeteranganDokumen,
				'addNamaDokumen':$scope.daftarDokumen[i].addNamaDokumen,
				'camDokumen':spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.daftarDokumen[i].camDokumen)),
				'selectTipeDokumen':$scope.daftarDokumen[i].selectTipeDokumen,
				'isPageDocumentAccepted':$scope.daftarDokumen[i].isPageDocumentAccepted
			})
		}
	}


	
	$scope.editDokumen =  function(dat){
		$state.go('aplikasiSPAJOnline.tambahkanDokumenPenunjangSPAJ',  
			{indexDokumen:dat}, {reload: true, inherit: false});
	}


	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
}])
   //etag: dokumen spaj
.controller('tambahkanDokumenPenunjangSPAJCtrl', [
	'$scope',
	'$stateParams',
	'$ionicPopup', 
	'dataFactory',
	'spajProvider',
	'$store',
	'$state',
function ($scope, $stateParams, $ionicPopup,dataFactory, spajProvider,$store,$state) {
	$scope.tipeDokumen = dataFactory.getTipeDokumens();
	$scope.indexDokumen = $state.params.indexDokumen;
	$scope.ngShow = true;
	
	if(typeof parseInt($scope.indexDokumen) && parseInt($scope.indexDokumen) > -1){
		$scope.dataDokumen = spajProvider.getDokumen(spajProvider.getSpajGUID()
			,'aplikasiSPAJOnline.dokumenPendukungSPAJ',$scope.indexDokumen);
			
			$scope.data = {
				'spaj_guid':spajProvider.getSpajGUID(),
				'addNamaDokumen': $scope.dataDokumen.addNamaDokumen,
				'addKeteranganDokumen':$scope.dataDokumen.addKeteranganDokumen,
				'selectTipeDokumen':$scope.dataDokumen.selectTipeDokumen,
				'camDokumen':spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.dataDokumen.camDokumen))
			}
			
			spajProvider.putImageTo('canvasDokumen',spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.dataDokumen.camDokumen)));
			
	} else {
		$scope.data = {
			'spaj_guid':spajProvider.getSpajGUID(),
			'addNamaDokumen':'',
			'addKeteranganDokumen':'',
			'selectTipeDokumen':$scope.tipeDokumen[0].id,
			'camDokumen':''
		}
		console.log('loaded 2');
		//spajProvider.putImageTo('canvasDokumen',spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.dataDokumen.camDokumen)));
	}
	
	$scope.delDokumen = function(indexDokumen){
		if(confirm("yakin akan hapus dokumen ini>")){
			spajProvider.delDokumen($scope.data.spaj_guid,'aplikasiSPAJOnline.dokumenPendukungSPAJ',indexDokumen)
			$state.go('aplikasiSPAJOnline.dokumenPendukungSPAJ',  {}, {reload: true, inherit: false, cache:false});
		} else {
			return false;
		}
	}

	$scope.saveDokumen = function(){
		if($scope.data.addNamaDokumen == '' ){
			alert('Nama Dokumen harus Diisi!');
			return false;
		} else {
			if(typeof parseInt($scope.indexDokumen) && parseInt($scope.indexDokumen) > -1){
				this.updateDokumen($scope.indexDokumen);
			} else {
				this.saveDataSpaj();
			}
			
			$state.go('aplikasiSPAJOnline.dokumenPendukungSPAJ',  {}, {reload: true, inherit: false, cache:false});
		}
	}

	$scope.saveDataSpaj = function(){
		$scope.data.camDokumen = spajProvider.getImageBase64('canvasDokumen','jpg');
		
		$scope.newDokumen = {
			'addNamaDokumen':$scope.data.addNamaDokumen,
			'addKeteranganDokumen':$scope.data.addKeteranganDokumen,
			'selectTipeDokumen':$scope.data.selectTipeDokumen,
			'camDokumen':$scope.data.camDokumen
		};
		
		spajProvider.setSpajGUID($scope.data.spaj_guid);
		spajProvider.addDokumen($scope.data.spaj_guid,'aplikasiSPAJOnline.dokumenPendukungSPAJ',$scope.newDokumen);
	}
	
	$scope.updateDokumen = function(indexDokumen){
		$scope.data.camDokumen = spajProvider.getImageBase64('canvasDokumen','jpg');
		
		$scope.saveChanges = {
			'addNamaDokumen':$scope.data.addNamaDokumen,
			'addKeteranganDokumen':$scope.data.addKeteranganDokumen,
			'selectTipeDokumen':$scope.data.selectTipeDokumen,
			'camDokumen':$scope.data.camDokumen
		};
		
		spajProvider.setSpajGUID($scope.data.spaj_guid);
		spajProvider.updateDokumen($scope.data.spaj_guid,'aplikasiSPAJOnline.dokumenPendukungSPAJ',indexDokumen,$scope.saveChanges);
	} 

	
	$scope.changeImage = function(){
		document.getElementById('tempImgDokumen').style.display = 'none';
		spajProvider.takePict(this,'canvasDokumen');
		$scope.data.camDokumen = spajProvider.getImageBase64('canvasDokumen','jpg');
		
	}

		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

}])
   
.controller('tambahPenerimaManfaatCtrl', [
	'$state',
	'$scope', 
	'$stateParams', 
	'dataFactory', 
	'spajProvider',
	'$store',
	'$ionicPopup',
function ($state,$scope, $stateParams, dataFactory,spajProvider,$store,$ionicPopup) {
    $scope.statuss = dataFactory.getStatusNikahs();  
    $scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
    $scope.genders = dataFactory.getGenders();
    
	
	$scope.saveDataSpaj = function(){
		$scope.newPenerimaManfaat = {
			'namaPenerimaManfaat':$scope.data.namaPenerimaManfaat,
			'tglLahirPenerimaManfaat':$scope.data.tglLahirPenerimaManfaat,
			'tempatLahirPenerima':$scope.data.tempatLahirPenerima,
			'penerimaManfaatHubungan':$scope.data.penerimaManfaatHubungan,
			'statusPenerimaManfaat':$scope.data.statusPenerimaManfaat,
			'jenkelPenerimaManfaat': $scope.data.jenkelPenerimaManfaat
		};
		
		spajProvider.setSpajGUID($scope.data.spaj_guid);
		spajProvider.addPenerimaManfaat($scope.data.spaj_guid,'aplikasiSPAJOnline.tambahPenerimaManfaat',$scope.newPenerimaManfaat);
		
		
		/*
		
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);*/
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.tambahPenerimaManfaat'), true));
    }

    $scope.data = {
		'spaj_guid':spajProvider.getSpajGUID(),
		'penerimaManfaatHubungan':$scope.hubunganKeluargas[0].id,
		'statusPenerimaManfaat':$scope.statuss[0].id,
		'jenkelPenerimaManfaat': $scope.genders[0].id,
		'namaPenerimaManfaat':'',
		'tglLahirPenerimaManfaat':'',
		'tempatLahirPenerima':'',
    }
	

	
$scope.savePenerimaManfaat = function(){
		if($scope.data.namaPenerimaManfaat == '' || $scope.data.tglLahirPenerimaManfaat == '' ){
			$scope.showAlert('Perhatian','Nama dan Tanggal lahir harus diisi.', true);
			return false;
			
		} else{
			this.saveDataSpaj();
			
			$state.go('aplikasiSPAJOnline.produkDanManfaat22',  {}, {reload: true, inherit: false, cache:false});
		}
		
	}
	
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});
	
	$scope.showAlert = function(title,message) {
		var alertPopup = $ionicPopup.alert({
			title:title,
			template: message
		});
    
		alertPopup.then(function(res) {
			
		});
    };
}])
   
.controller('editPenerimaManfaatCtrl', [
	'$state',
	'$scope', 
	'$stateParams',
	'spajProvider',
	'dataFactory',
	'$store', 
	'$filter', 
function ($state,$scope, $stateParams,spajProvider,dataFactory,$store,$filter) {
	$scope.indexPenerimaManfaat = $state.params.indexPenerimaManfaat;
	
	//console.log(indexPenerimaManfaat);
	$scope.statuss = dataFactory.getStatusNikahs();  
    $scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
    $scope.genders = dataFactory.getGenders();
	
	$scope.dataPenerimaManfaat = spajProvider.getPenerimaManfaat(spajProvider.getSpajGUID()
		,'aplikasiSPAJOnline.tambahPenerimaManfaat',$scope.indexPenerimaManfaat);
		
		$scope.dataPenerimaManfaat.tglLahirPenerimaManfaat = new Date($scope.dataPenerimaManfaat.tglLahirPenerimaManfaat);
		
	$scope.data = {
		'spaj_guid':spajProvider.getSpajGUID(),
		'penerimaManfaatHubungan':$scope.dataPenerimaManfaat.penerimaManfaatHubungan,
		'statusPenerimaManfaat':$scope.dataPenerimaManfaat.statusPenerimaManfaat,
		'jenkelPenerimaManfaat': $scope.dataPenerimaManfaat.jenkelPenerimaManfaat,
		'namaPenerimaManfaat':$scope.dataPenerimaManfaat.namaPenerimaManfaat,
		'tglLahirPenerimaManfaat':$scope.dataPenerimaManfaat.tglLahirPenerimaManfaat,
		'tempatLahirPenerima':$scope.dataPenerimaManfaat.tempatLahirPenerima,
    }

	$scope.savePenerimaManfaat = function(){
		
		$scope.newPenerimaManfaat = {
			'namaPenerimaManfaat':$scope.data.namaPenerimaManfaat,
			'tglLahirPenerimaManfaat':$scope.data.tglLahirPenerimaManfaat,
			'tempatLahirPenerima':$scope.data.tempatLahirPenerima,
			'penerimaManfaatHubungan':$scope.data.penerimaManfaatHubungan,
			'statusPenerimaManfaat':$scope.data.statusPenerimaManfaat,
			'jenkelPenerimaManfaat': $scope.data.jenkelPenerimaManfaat
		};

		if(confirm('yakin akan mengupdate?')){
			spajProvider.updatePenerimaManfaat(spajProvider.getSpajGUID()
					,'aplikasiSPAJOnline.tambahPenerimaManfaat'
					,$scope.indexPenerimaManfaat
					,$scope.newPenerimaManfaat);
			$state.go('aplikasiSPAJOnline.produkDanManfaat22',  {}, {reload: true, inherit: false, cache:false});
		};
	}	
	
	$scope.delPenerimaManfaat = function(){
		if(confirm('yakin akan menghapus?')){
			spajProvider.removePenerimaManfaat(spajProvider.getSpajGUID(),'aplikasiSPAJOnline.tambahPenerimaManfaat',$scope.indexPenerimaManfaat)
			$state.go('aplikasiSPAJOnline.produkDanManfaat22',  {}, {reload: true, inherit: false, cache:false});
		};
	}
	
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

}])
   
.controller('sPAJOnlineJiwasrayaCtrl', ['$scope', '$state','spajProvider','$stateParams', 
function ($scope,$state,spajProvider, $stateParams) {
	
	//ui-sref="aplikasiSPAJOnline.dataTertanggung13_tab1({new: true,spaj_guid:null})"
	
	$scope.newSpaj = function(spaj_guid){
		//route to dataTertanggung13

		spajProvider.setSpajGUID('new');
		$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1',{spaj_guid:'new'}, {reload: true, inherit: false});
	}
	
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

}])
.controller('suratKeteranganKesehatanCtrl', ['$scope', '$stateParams', 
function ($scope, $stateParams) {


}])

  .controller('sKKTertanggungCtrl', [
	'$state',
	'$scope', 
	'$stateParams', 
	'$store', 
	'spajProvider', 
	'dataFactory', 
function ($state,$scope, $stateParams,$store,spajProvider,dataFactory) {
	$scope.pageId = 'aplikasiSPAJOnline.sKKTertanggung';
		$scope.$on('$ionicView.beforeEnter', function() {
				$scope.init_data();
				$scope.init_display();
		});
		
		/** WARNING!!! Quirks mode HERE **/
		/** WARNING!!! Quirks mode HERE **/
		/** WARNING!!! Quirks mode HERE **/
	
	$scope.init_display = function(){
		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.produkDanManfaat12') == null){
			$scope.isProdukJsProteksiKeluarga = false;
			$scope.jenisProduk = false;
			$scope.jenisJsProteksiKeluarga = '';
			$scope.namaTertanggungUtama = '';
			$scope.namaTertanggungTambahan1 = '';
		} else {
			$scope.isProdukJsProteksiKeluarga = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.produkDanManfaat12').jenisAsuransi;
			$scope.jenisJsProteksiKeluarga = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.produkDanManfaat12').jenisJsProteksiKeluarga;
			$scope.jenisProduk = $scope.isProdukJsProteksiKeluarga;
			
			$scope.namaTertanggungUtama =		$store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung13').namaLengkapTertanggung;
			$scope.namaTertanggungTambahan1 =	$store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung33').namaTertanggungTambahan1;

			$scope.isProdukJsProteksiKeluarga = ('JSPROTEKSIKELUARGA' == $scope.isProdukJsProteksiKeluarga);
			//console.log($scope.jenisJsProteksiKeluarga)
			switch($scope.jenisJsProteksiKeluarga){
				case 'K0': 
					$scope.data.isAdaTTU =true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = false;
					$scope.data.isAdaTT3 = false;
					$scope.data.isAdaTT4 = false;
				break;				
				case 'K1': 
					$scope.data.isAdaTTU =true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = true;
					$scope.data.isAdaTT3 = false;
					$scope.data.isAdaTT4 = false;
				break;				
				case 'K2': 
					$scope.data.isAdaTTU =true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = true;
					$scope.data.isAdaTT3 = true;
					$scope.data.isAdaTT4 = false;
				break;
				case 'K3': 
					$scope.data.isAdaTTU =true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = true;
					$scope.data.isAdaTT3 = true;
					$scope.data.isAdaTT4 = true;
				break;				
				case 'B0': 
					$scope.data.isAdaTTU =true;
					$scope.data.isAdaTT1 = false;
					$scope.data.isAdaTT2 = false;
					$scope.data.isAdaTT3 = false;
					$scope.data.isAdaTT4 = false;
				break;
			}
		
			
		}
		
		
		$scope.data_tertanggung3 = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung33');
		$scope.data_tertanggung1 = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::aplikasiSPAJOnline.dataTertanggung13');
		
		if($scope.data_tertanggung3 != null || $scope.data_tertanggung1 !=null){
			
			if($scope.data_tertanggung3.isAdaTertanggungTambahan1) $scope.isTertanggungTambahan = true;
			if($scope.data_tertanggung3.jenisKelaminTertanggungTambahan1 == 'perempuan' && $scope.data_tertanggung3.isAdaTertanggungTambahan1) $scope.isTT1Wanita = true;

			if($scope.data_tertanggung1.jenkelTertanggung == 'perempuan' && $scope.data_tertanggung1.namaLengkapTertanggung!='') $scope.isTTUWanita = true;
			if($scope.data_tertanggung1.namaLengkapTertanggung!='' || $scope.data_tertanggung1.agamaTertanggung!='0') $scope.isHanya1tertanggung = true;;
			if($scope.data_tertanggung1.namaLengkapTertanggung!='' || $scope.data_tertanggung1.agamaTertanggung!='0') $scope.isHanya1tertanggung = true;;

		} else {
			alert('Mohon lengkapi data Tertanggung atau Tertanggung tambahan!');
			
			$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1',{'spaj_guid':spaj_guid}, {reload: true, inherit: false});
			return false;
			
		}
	}    
	
	$scope.saveDataSpaj = function(){
		
        var $formdata = {
                'pageId':'aplikasiSPAJOnline.sKKTertanggung',
                'data':$scope.data
        };
		console.log($formdata);
		spajProvider.setSpajGUID($scope.data.spaj_guid);
		$scope.data.tglMeninggalAyah_TTU = new Date($scope.data.tglMeninggalAyah_TTU);
		
		
		
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);
        //$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
    }
	
	$scope.init_data = function(){
		$scope.isHanya1tertanggung = false;
		$scope.isTertanggungTambahan = false;
		$scope.isTTUWanita = false;
		$scope.isTT1Wanita = false;

		$scope.data={
			'spaj_guid':spajProvider.getSpajGUID(),
			'isSkkTertanggungAccepted':false,
			'isPenyakitTurunan':false,
			'jenisPenyakit':false,
			'isPenyakitDiderita':false,
			
			'isAdaTTU' :true,
			'isAdaTT1' : false,
			'isAdaTT2' : false,
			'isAdaTT3' : false,
			'isAdaTT4' : false,

			'isPenyakit1':false,
			'isPenyakit1_TTU':false,
			'isPenyakit1_TT1':false,
			'isPenyakit1_TT2':false,
			'isPenyakit1_TT3':false,
			'isPenyakit1_TT4':false,

			'isPenyakit2':false,
			'isPenyakit2_TTU':false,
			'isPenyakit2_TT1':false,
			'isPenyakit2_TT2':false,
			'isPenyakit2_TT3':false,
			'isPenyakit2_TT4':false,

			'isPenyakit3':false,
			'isPenyakit3_TTU':false,
			'isPenyakit3_TT1':false,
			'isPenyakit3_TT2':false,
			'isPenyakit3_TT3':false,
			'isPenyakit3_TT4':false,

			'isPenyakit4':false,
			'isPenyakit4_TTU':false,
			'isPenyakit4_TT1':false,
			'isPenyakit4_TT2':false,
			'isPenyakit4_TT3':false,
			'isPenyakit4_TT4':false,

			'isPenyakit5':false,
			'isPenyakit5_TTU':false,
			'isPenyakit5_TT1':false,
			'isPenyakit5_TT2':false,
			'isPenyakit5_TT3':false,
			'isPenyakit5_TT4':false,

			'isPenyakit6':false,
			'isPenyakit6_TTU':false,
			'isPenyakit6_TT1':false,
			'isPenyakit6_TT2':false,
			'isPenyakit6_TT3':false,
			'isPenyakit6_TT4':false,

			'isPenyakit7':false,
			'isPenyakit7_TTU':false,
			'isPenyakit7_TT1':false,
			'isPenyakit7_TT2':false,
			'isPenyakit7_TT3':false,
			'isPenyakit7_TT4':false,

			'isPenyakit5':false,
			'isPenyakit5_TTU':false,
			'isPenyakit5_TT1':false,
			'isPenyakit5_TT2':false,
			'isPenyakit5_TT3':false,
			'isPenyakit5_TT4':false,

			'isPenyakit6':false,
			'isPenyakit6_TTU':false,
			'isPenyakit6_TT1':false,
			'isPenyakit6_TT2':false,
			'isPenyakit6_TT3':false,
			'isPenyakit6_TT4':false,

			'isPenyakit7':false,
			'isPenyakit7_TTU':false,
			'isPenyakit7_TT1':false,
			'isPenyakit7_TT2':false,
			'isPenyakit7_TT3':false,
			'isPenyakit7_TT4':false,

			'isPenyakit8':false,
			'isPenyakit8_TTU':false,
			'isPenyakit8_TT1':false,
			'isPenyakit8_TT2':false,
			'isPenyakit8_TT3':false,
			'isPenyakit8_TT4':false,

			'isPenyakit9':false,
			'isPenyakit9_TTU':false,
			'isPenyakit9_TT1':false,
			'isPenyakit9_TT2':false,
			'isPenyakit9_TT3':false,
			'isPenyakit9_TT4':false,

			'isPenyakit10':false,
			'isPenyakit10_TTU':false,
			'isPenyakit10_TT1':false,
			'isPenyakit10_TT2':false,
			'isPenyakit10_TT3':false,
			'isPenyakit10_TT4':false,

			'isPenyakit11':false,
			'isPenyakit11_TTU':false,
			'isPenyakit11_TT1':false,
			'isPenyakit11_TT2':false,
			'isPenyakit11_TT3':false,
			'isPenyakit11_TT4':false,

			'isPenyakit12':false,
			'isPenyakit12_TTU':false,
			'isPenyakit12_TT1':false,
			'isPenyakit12_TT2':false,
			'isPenyakit12_TT3':false,
			'isPenyakit12_TT4':false,

			'isPenyakit13':false,
			'isPenyakit13_TTU':false,
			'isPenyakit13_TT1':false,
			'isPenyakit13_TT2':false,
			'isPenyakit13_TT3':false,
			'isPenyakit13_TT4':false,

			'isPenyakit14':false,
			'isPenyakit14_TTU':false,
			'isPenyakit14_TT1':false,
			'isPenyakit14_TT2':false,
			'isPenyakit14_TT3':false,
			'isPenyakit14_TT4':false,

			'isPenyakit15':false,
			'isPenyakit15_TTU':false,
			'isPenyakit15_TT1':false,
			'isPenyakit15_TT2':false,
			'isPenyakit15_TT3':false,
			'isPenyakit15_TT4':false,

			'isPenyakit16':false,
			'isPenyakit16_TTU':false,
			'isPenyakit16_TT1':false,
			'isPenyakit16_TT2':false,
			'isPenyakit16_TT3':false,
			'isPenyakit16_TT4':false,
			'isPenyakit17':false,
			'jenisPenyakitLainnya':'',
			
			'isMerokok_TTU':false,
			'isMerokok_TT1':false,
			'isMerokok_TT2':false,
			'isMerokok_TT3':false,
			'isMerokok_TT4':false,
			
			'rokokBatangTTU':'',
			'rokokBatangTT1':'',
			'rokokBatangTT2':'',
			'rokokBatangTT3':'',
			'rokokBatangTT4':'',
			
			'isObat_TTU':false,
			'isObat_TT1':false,
			'isObat_TT2':false,
			'isObat_TT3':false,
			'isObat_TT4':false,
			
			
			'isWanitaPAP_TTU':false,
			'isWanitaPAP_TT1':false,
			'isWanitaPAP_TT2':false,
			'isWanitaPAP_TT3':false,
			'isWanitaPAP_TT4':false,
			
			
			'isMensTerganggu_TTU':false,
			'isMensTerganggu_TT1':false,
			'isMensTerganggu_TT2':false,
			'isMensTerganggu_TT3':false,
			'isMensTerganggu_TT4':false,
			
			
			'isMensTerganggu_TTU':false,
			'isMensTerganggu_TT1':false,
			'isMensTerganggu_TT2':false,
			'isMensTerganggu_TT3':false,
			'isMensTerganggu_TT4':false,
			
			
			'isCesar_TTU':false,
			'isCesar_TT1':false,
			'isCesar_TT2':false,
			'isCesar_TT3':false,
			'isCesar_TT4':false,
			
			
			'isKeguguran_TTU':false,
			'isKeguguran_TT1':false,
			'isKeguguran_TT2':false,
			'isKeguguran_TT3':false,
			'isKeguguran_TT4':false,
			
			
			'isKesulitanHamil_TTU':false,
			'isKesulitanHamil_TT1':false,
			'isKesulitanHamil_TT2':false,
			'isKesulitanHamil_TT3':false,
			'isKesulitanHamil_TT4':false,
			
			/* INI SKK UMUM */
			'umurAyahTTU':'',
			//'isAyahHidup_TTU':'',
			//'isAyahHidupSehat_TTU':'',
			'isAyahDiabet_TTU':false,
			'isAyahHipertensi_TTU':false,
			'isAyahJantung_TTU':false,
			'isAyahTumor_TTU':false,
			'isAyahPenyakitKeturunan_TTU':false,
			'sebabMeninggalAyah_TTU':'',
			'lamaSakitAyah_TTU':'',
			'tglMeninggalAyah_TTU':'',
			
			
			'umurIbuTTU':'',
			'isIbuMeninggal_TTU':false,
			'isIbuDiabet_TTU':false,
			'isIbuHipertensi_TTU':false,
			'isIbuJantung_TTU':false,
			'isIbuTumor_TTU':false,
			'isIbuPenyakitKeturunan_TTU':false,
			'sebabMeninggalIbu_TTU':'',
			'lamaSakitIbu_TTU':'',
			'tglMeninggalIbu_TTU':'',
			
			'umurPasanganTTU':'',
			'isPasanganMeninggal_TTU':false,
			'isPasanganDiabet_TTU':false,
			'isPasanganHipertensi_TTU':false,
			'isPasanganJantung_TTU':false,
			'isPasanganTumor_TTU':false,
			'isPasanganPenyakitKeturunan_TTU':false,
			'sebabMeninggalPasangan_TTU':'',
			'lamaSakitPasangan_TTU':'',
			'tglMeninggalPasangan_TTU':'',
			
			
			'umurSaudaraLakiTTU':'',
			'isSaudaraLakiMeninggal_TTU':false,
			'isSaudaraLakiDiabet_TTU':false,
			'isSaudaraLakiHipertensi_TTU':false,
			'isSaudaraLakiJantung_TTU':false,
			'isSaudaraLakiTumor_TTU':false,
			'isSaudaraLakiPenyakitKeturunan_TTU':false,
			'lamaSakitSaudaraLaki_TTU':'',
			'sebabMeninggalSaudaraLaki_TTU':'',
			'tglMeninggalSaudaraLaki_TTU':'',
			
			
			'umurSaudaraPerempuanTTU':'',
			'isSaudaraPerempuanMeninggal_TTU':false,
			'isSaudaraPerempuanDiabet_TTU':false,
			'isSaudaraPerempuanHipertensi_TTU':false,
			'isSaudaraPerempuanJantung_TTU':false,
			'isSaudaraPerempuanTumor_TTU':false,
			'isSaudaraPerempuanPenyakitKeturunan_TTU':false,
			'sebabMeninggalSaudaraPerempuan_TTU':'',
			'lamaSakitSaudaraPerempuan_TTU':'',
			'tglMeninggalSaudaraPerempuan_TTU':'',
			
			
			'umurAnakTTU':'',
			'isAnakMeninggal_TTU':false,
			'isAnakDiabet_TTU':false,
			'isAnakHipertensi_TTU':false,
			'isAnakJantung_TTU':false,
			'isAnakTumor_TTU':false,
			'isAnakPenyakitKeturunan_TTU':false,
			'sebabMeninggalAnak_TTU':'',
			'lamaSakitAnak_TTU':'',
			'tglMeninggalAnak_TTU':'',		
			
			'umurAyahTT1':'',
			'isAyahMeninggal_TT1':false,
			'isAyahDiabet_TT1':false,
			'isAyahHipertensi_TT1':false,
			'isAyahJantung_TT1':false,
			'isAyahTumor_TT1':false,
			'isAyahPenyakitKeturunan_TT1':false,
			'sebabMeninggalAyah_TT1':'',
			'lamaSakitAyah_TT1':'',
			'tglMeninggalAyah_TT1':'',
			
			
			'umurIbuTT1':'',
			'isIbuMeninggal_TT1':false,
			'isIbuDiabet_TT1':false,
			'isIbuHipertensi_TT1':false,
			'isIbuJantung_TT1':false,
			'isIbuTumor_TT1':false,
			'isIbuPenyakitKeturunan_TT1':false,
			'sebabMeninggalIbu_TT1':'',
			'lamaSakitIbu_TT1':'',
			'tglMeninggalIbu_TT1':'',
			
			'umurPasanganTT1':'',
			'isPasanganMeninggal_TT1':false,
			'isPasanganDiabet_TT1':false,
			'isPasanganHipertensi_TT1':false,
			'isPasanganJantung_TT1':false,
			'isPasanganTumor_TT1':false,
			'isPasanganPenyakitKeturunan_TT1':false,
			'sebabMeninggalPasangan_TT1':'',
			'lamaSakitPasangan_TT1':'',
			'tglMeninggalPasangan_TT1':'',
			
			
			'umurSaudaraLakiTT1':'',
			'isSaudaraLakiMeninggal_TT1':false,
			'isSaudaraLakiDiabet_TT1':false,
			'isSaudaraLakiHipertensi_TT1':false,
			'isSaudaraLakiJantung_TT1':false,
			'isSaudaraLakiTumor_TT1':false,
			'isSaudaraLakiPenyakitKeturunan_TT1':false,
			'lamaSakitSaudaraLaki_TT1':'',
			'sebabMeninggalSaudaraLaki_TT1':'',
			'tglMeninggalSaudaraLaki_TT1':'',
			
			
			'umurSaudaraPerempuanTT1':'',
			'isSaudaraPerempuanMeninggal_TT1':false,
			'isSaudaraPerempuanDiabet_TT1':false,
			'isSaudaraPerempuanHipertensi_TT1':false,
			'isSaudaraPerempuanJantung_TT1':false,
			'isSaudaraPerempuanTumor_TT1':false,
			'isSaudaraPerempuanPenyakitKeturunan_TT1':false,
			'sebabMeninggalSaudaraPerempuan_TT1':'',
			'lamaSakitSaudaraPerempuan_TT1':'',
			'tglMeninggalSaudaraPerempuan_TT1':'',
			
			
			'umurAnakTT1':'',
			'isAnakMeninggal_TT1':false,
			'isAnakDiabet_TT1':false,
			'isAnakHipertensi_TT1':false,
			'isAnakJantung_TT1':false,
			'isAnakTumor_TT1':false,
			'isAnakPenyakitKeturunan_TT1':false,
			'sebabMeninggalAnak_TT1':'',
			'lamaSakitAnak_TT1':'',
			'tglMeninggalAnak_TT1':'',
			
			
			'isSehatTTU':false,
			'isSehatTT1':false,
			'isGejalaTTU':false,
			'isGejalaTT1':false,
			
			'isPenyakitT01_TTU':false,
			'tglSakitT01_TTU':false,
			'namaDokterT01_TTU':false,
			'isPenyakitT01_TT1':false,
			'tglSakitT01_TT1':false,
			'namaDokterT01_TT1':false,
			
			
			
			'isPenyakitT02_TTU':false,
			'tglSakitT02_TTU':false,
			'namaDokterT02_TTU':false,
			'isPenyakitT02_TT1':false,
			'tglSakitT02_TT1':false,
			'namaDokterT02_TT1':false,
			
			
			'isPenyakitT03_TTU':false,
			'tglSakitT03_TTU':false,
			'namaDokterT03_TTU':false,
			'isPenyakitT03_TT1':false,
			'tglSakitT03_TT1':false,
			'namaDokterT03_TT1':false,
			
			
			
			
			'isPenyakitT04_TTU':false,
			'tglSakitT04_TTU':false,
			'namaDokterT04_TTU':false,
			'isPenyakitT04_TT1':false,
			'tglSakitT04_TT1':false,
			'namaDokterT04_TT1':false,
			
			
			
			'isPenyakitT05_TTU':false,
			'tglSakitT05_TTU':false,
			'namaDokterT05_TTU':false,
			'isPenyakitT05_TT1':false,
			'tglSakitT05_TT1':false,
			'namaDokterT05_TT1':false,
			
			
			'isPenyakitT06_TTU':false,
			'tglSakitT06_TTU':false,
			'namaDokterT06_TTU':false,
			'isPenyakitT06_TT1':false,
			'tglSakitT06_TT1':false,
			'namaDokterT06_TT1':false,
			
			
			
			'isPenyakitT07_TTU':false,
			'tglSakitT07_TTU':false,
			'namaDokterT07_TTU':false,
			'isPenyakitT07_TT1':false,
			'tglSakitT07_TT1':false,
			'namaDokterT07_TT1':false,
			
			
			
			'isPenyakitT08_TTU':false,
			'tglSakitT08_TTU':false,
			'namaDokterT08_TTU':false,
			'isPenyakitT08_TT1':false,
			'tglSakitT08_TT1':false,
			'namaDokterT08_TT1':false,
			
			
			
			
			'isPenyakitT09_TTU':false,
			'tglSakitT09_TTU':false,
			'namaDokterT09_TTU':false,
			'isPenyakitT09_TT1':false,
			'tglSakitT09_TT1':false,
			'namaDokterT09_TT1':false,
			
			
				
			
			'isPenyakitT10_TTU':false,
			'tglSakitT10_TTU':false,
			'namaDokterT10_TTU':false,
			'isPenyakitT10_TT1':false,
			'tglSakitT10_TT1':false,
			'namaDokterT10_TT1':false,
			
			
			
			'isPenyakitT11_TTU':false,
			'tglSakitT11_TTU':false,
			'namaDokterT11_TTU':false,
			'isPenyakitT11_TT1':false,
			'tglSakitT11_TT1':false,
			'namaDokterT11_TT1':false,
			
			
			
			
			'isPenyakitT12_TTU':false,
			'tglSakitT12_TTU':false,
			'namaDokterT12_TTU':false,
			'isPenyakitT12_TT1':false,
			'tglSakitT12_TT1':false,
			'namaDokterT12_TT1':false,
			
			
			
			
			'isPenyakitT13_TTU':false,
			'tglSakitT13_TTU':false,
			'namaDokterT13_TTU':false,
			'isPenyakitT13_TT1':false,
			'tglSakitT13_TT1':false,
			'namaDokterT13_TT1':false,
			
			
			'isPenyakitT14_TTU':false,
			'tglSakitT14_TTU':false,
			'namaDokterT14_TTU':false,
			'isPenyakitT14_TT1':false,
			'tglSakitT14_TT1':false,
			'namaDokterT14_TT1':false,
			
			
			'isPenyakitT15_TTU':false,
			'tglSakitT15_TTU':false,
			'namaDokterT15_TTU':false,
			'isPenyakitT15_TT1':false,
			'tglSakitT15_TT1':false,
			'namaDokterT15_TT1':false,
			
			'isPenyakitT16_TTU':false,
			'tglSakitT16_TTU':false,
			'namaDokterT16_TTU':false,
			'isPenyakitT16_TT1':false,
			'tglSakitT16_TT1':false,
			'namaDokterT16_TT1':false,
			
			'isPenyakitT17_TTU':false,
			'tglSakitT17_TTU':false,
			'namaDokterT17_TTU':false,
			'isPenyakitT17_TT1':false,
			'tglSakitT17_TT1':false,
			'namaDokterT17_TT1':false,
			
			
			'isPenyakitT18_TTU':false,
			'tglSakitT18_TTU':false,
			'namaDokterT18_TTU':false,
			'isPenyakitT18_TT1':false,
			'tglSakitT18_TT1':false,
			'namaDokterT18_TT1':false,
			
			
			'isPenyakitT19_TTU':false,
			'tglSakitT19_TTU':false,
			'namaDokterT19_TTU':false,
			'isPenyakitT19_TT1':false,
			'tglSakitT19_TT1':false,
			'namaDokterT19_TT1':false,
			
			'isPenyakitT20_TTU':false,
			'tglSakitT20_TTU':false,
			'namaDokterT20_TTU':false,
			'isPenyakitT20_TT1':false,
			'tglSakitT20_TT1':false,
			'namaDokterT20_TT1':false
		}

		if($store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId) == null ){

		} else {
			$scope.data = $store.get('SPAJ::'+spajProvider.getSpajGUID()+'::'+$scope.pageId);
		}
		
		
		
	}
	
	

					
	$scope.$on('$ionicView.enter', function() {

	})
	
	
	


	
	
	
	$scope.moveToNextPage = function(){
		if($scope.data.isSkkTertanggungAccepted){
			if(confirm('Langsung menuju ke halaman form isian data diri pemegang polis?') ){
					$state.go('aplikasiSPAJOnline.dataPemegangPolis13',  
				{}, {reload: true, inherit: false});
			}else{
				return false;
			}
		}


	}

}])


.controller('daftarSPAJOnlineCtrl', [
		'$scope',
		'$state',
		'$stateParams', 
		'spajProvider',
		'dataFactory',
		'$ionicPopup',
		'$http',
		'$ionicLoading', 
		'$location',
		'$store', 
function ($scope,$state,$stateParams,spajProvider,dataFactory,$ionicPopup,$http,$ionicLoading,$location,$store) {
	
	$scope.idagen = getQueryParam('idagen');
	$scope.token = getQueryParam('token');
	$scope.android_ver = getQueryParam('android_ver');
	$scope.device = getQueryParam('device');
	
	$scope.deleteData = function(){
		if(confirm('DEBUG clear data... akan menghapus data SPAJ yang belum terkirim.')){
			localStorage.clear();
			console.log('RESET!!!');
		}
		
		return false;
		
	}
	
	$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
		viewData.enableBack = true;
	});

	$scope.unsavedList = spajProvider.getUnsavedSpajGuid();

	$scope.dataUnprocessedUnderwriting = null;
	$scope.dataUnprocessedDitolak = null;
	$scope.dataUnprocessed = null;
	
	$scope.editUnsavedSpaj = function(spaj_guid){
		//route to dataTertanggung13
		$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1',{spaj_guid:spaj_guid}, {reload: true, inherit: false});
	}
	
	$http({
        method : "GET",
        url : "http://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/retriever.php?act=get_unprocessed&idagen="+$scope.idagen+"&token="+$scope.token
    }).then(function mySucces(response) {
        $scope.dataUnprocessed = response.data;
		$ionicLoading.hide();
    }, function myError(response) {
        $scope.dataUnprocessed = response.message;
    });
	
	
	var this_guid = spajProvider.getSpajGUID();
	
	var temp = localStorage.getItem('SPAJ::'+this_guid+'::aplikasiSPAJOnline.dataTertanggung13');
	
	var tJson = JSON.parse(temp);
	
	$scope.dataUnsaved = {
		this_guid:tJson
	}
	
	
	$scope.deleteUnsavedSpaj = function(spaj_guid){
		if(confirm('Apakah ingin menghapus dokumen SPAJ ini?')){
			spajProvider.delUnsavedSpajGuid(spaj_guid);
			return true;
		}
		
	}
	
	$scope.editSpaj = function(item){
		//console.log(item);
		 $location.path( '/basic_tertanggung1');
	}
	
	$scope.doNewSPAJ = function(){
		$state.go('aplikasiSPAJOnline',{}, {reload: true, inherit: false});
	}

	$ionicLoading.show({
		content: '<ion-spinner></ion-spinner>',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 400,
		showDelay: 1
	});

}])
 