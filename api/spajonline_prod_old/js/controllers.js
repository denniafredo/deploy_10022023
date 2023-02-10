angular.module('app.controllers', ['ui.utils.masks'])
//////////// PAGE 1
.controller('dataTertanggung13Ctrl', ['$scope', '$state', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', 'syncService', '$store',
	function ($scope, $state, $stateParams, dataFactory, spajProvider, $ionicPopup, syncService, $store) {
		$scope.data = null;
		$scope.pageId = 'aplikasiSPAJOnline.dataTertanggung13';
		$scope.genders = dataFactory.getGenders();
		$scope.agamas = dataFactory.getAgamas();
		$scope.spaj_guid = $stateParams.spaj_guid;
		$scope.imgDokumenKtp = "data:image/png;base64,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";
		$scope.imgDokumenKtpChanged = false;
		$scope.tglLahirTertanggung = '';
		$scope.idagen = getQueryParam('idagen');
		$scope.token = getQueryParam('token');

		new Date('10/10/1990');
		//INIT FORM 
		$scope.$on('$ionicView.enter', function () {
			$scope.init_data();
			if ($scope.spaj_guid == 'new') {
				newGuid = spajProvider.genSpajGUID();
				spajProvider.setSpajGUID(newGuid);
				$scope.data.spaj_guid = newGuid;
				$scope.data.build_id = spajProvider.getBuildId();
			}
			$scope.init_display();
		});
		$scope.init_display = function () {
			return true;
		};
		prospek = false;
		try {
			$pros = JSON.parse(spajProvider.getProspekData());
			prospek = $pros.find(obj => {
				return obj.build_id === spajProvider.getBuildId()
			});
		} catch (e) {
			prospek = {
				'jeniskelamin': '0',
				'nama': '',
				'tgllahir': ''
			}
		}
		$scope.init_data = function () {
			if (prospek) {
				$scope.data = {
					'spaj_guid': (spajProvider.getSpajGUID() == null || spajProvider.getSpajGUID() == '') ? spajProvider.genSpajGUID() : spajProvider.getSpajGUID(),
					'isPageTertanggung1Accepted': false,
					'agamaTertanggung': $scope.agamas[0].id,
					'jenkelTertanggung': $scope.genders[prospek.jeniskelamin].id,
					'namaLengkapTertanggung': prospek.nama,
					'nomorKTPTertanggung': prospek.no_ktp_tertanggung,
					'tglLahirTertanggung': new Date(prospek.tgllahir),
					'nomorNPWPTertanggung': '',
					'tglLahirPempol': '',
					'imageKTPTertanggung': null,
					'idagen': $scope.idagen,
					'namaAgen': prospek.namaAgen
				}
			} else {
				$scope.data = {
					'spaj_guid': (spajProvider.getSpajGUID() == null || spajProvider.getSpajGUID() == '') ? spajProvider.genSpajGUID() : spajProvider.getSpajGUID(),
					'isPageTertanggung1Accepted': false,
					'agamaTertanggung': $scope.agamas[0].id,
					'jenkelTertanggung': $scope.genders[0].id,
					'namaLengkapTertanggung': '',
					'nomorKTPTertanggung': '',
					'tglLahirTertanggung': $scope.tglLahirTertanggung,
					'nomorNPWPTertanggung': '',
					'tglLahirPempol': '',
					'imageKTPTertanggung': null,
					'idagen': $scope.idagen,
					'namaAgen': prospek.namaAgen
				}
			}
			$scope.imgDokumenKtpChanged = false;
			spajProvider.putImageTo('canvasKTP', $scope.imgDokumenKtp);
			if ($scope.spaj_guid == 'new') {
				//console.log(spajProvider.getSpajGUID())
				//$scope.init_data();
			} else if ($scope.spaj_guid == '' && spajProvider.getSpajGUID() != '') {
				spajProvider.setSpajGUID(spajProvider.getSpajGUID());
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
				try {
					decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.data.imageKTPTertanggung));
				} catch (e) {
					decodedImage = '';
				}
				spajProvider.putImageTo('canvasKTP', decodedImage);
				$scope.data.tglLahirTertanggung = new Date($scope.data.tglLahirTertanggung);
				$scope.imgDokumenKtp = decodedImage;
				$scope.imgDokumenKtpChanged = true;
			} else {
				spajProvider.setSpajGUID($scope.spaj_guid);
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
				var decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.data.imageKTPTertanggung));
				$scope.data.tglLahirTertanggung = new Date($scope.data.tglLahirTertanggung);
				if (spajProvider.putImageTo('canvasKTP', decodedImage)) {
					$scope.imgDokumenKtpChanged = true;
				}
				$scope.imgDokumenKtp = decodedImage;
				$scope.imgDokumenKtpChanged = true;
			}
		}
		$scope.validateThisFormOnPageAccept = function () {
			//validate datanya
			$scope.messages = [];
			try {
				if ($scope.data == null) {
					$scope.messages.push({
						"message": "Data ERROR. Null data."
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			//validate nama, NOMOR KTP NPWP
			try {
				tryMe = $scope.data.namaLengkapTertanggung;
				if ($scope.data.namaLengkapTertanggung == '' && !(tryMe.match(/^[a-z\d\-_\s]+$/i))) {
					$scope.messages.push({
						'message': "Nama Tertanggung harus benar!"
					});
				}
				tryMe = $scope.data.nomorKTPTertanggung;
				if ($scope.data.nomorKTPTertanggung == '' && !(tryMe.match(/^\d+$/)) && $scope.data.nomorKTPTertanggung.length != 16) {
					$scope.messages.push({
						'message': "Nomor KTP harus benar! (16 digit)"
					});
				}
				tryMe = $scope.data.nomorNPWPTertanggung;
				if ($scope.data.nomorNPWPTertanggung == '' && !(tryMe.match(/^\d+$/))) {
					//$scope.messages.push({'message':"Nomor NPWP harus benar!"}) ;
				}
				tryMe = $scope.data.tglLahirTertanggung;
				//console.log($scope.data.tglLahirTertanggung);
				if ('' == tryMe) {
					$scope.messages.push({
						'message': "Masukkan tanggal lahir"
					});
				}
				tryMe = $scope.data.jenkelTertanggung;
				if ('0' == tryMe) {
					$scope.messages.push({
						'message': "Silahkan Pilih Jenis kelamin"
					});
				}
				tryMe = $scope.data.agamaTertanggung;
				if ('0' == tryMe) {
					$scope.messages.push({
						'message': "Silahkan Pilih Agama"
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			if (!$scope.imgDokumenKtpChanged) {
				$scope.messages.push({
					'message': "Silahkan foto KTP Tertanggung"
				});
			}
			if ($scope.messages.length > 0) {
				return $scope.messages;
			}
			return false;
		}
		$scope.changeImage = function () {
			spajProvider.takePict(this, 'canvasKTP');
			$scope.data.imageKTPTertanggung = spajProvider.getImageBase64('canvasKTP', 'jpg');
			$scope.imgDokumenKtpChanged = true;
			$scope.data.isPageTertanggung1Accepted = false;
		}
		$scope.saveDataSpaj = function () {
			$scope.data.imageKTPTertanggung = spajProvider.getImageBase64('canvasKTP', 'jpg');
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.dataTertanggung13',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung13'), true));
		}
		$scope.moveToNextPage = function () {
			if ($scope.validateThisFormOnPageAccept()) {
				$scope.showAlert('Validasi', spajProvider.alertMessagebuilder($scope.messages));
				$scope.data.isPageTertanggung1Accepted = false;
				return false;
			} else {
				if ($scope.data.isPageTertanggung1Accepted) {
					if (confirm('Langsung menuju ke halaman form isian tempat tinggal tertanggung?')) {
						$state.go('aplikasiSPAJOnline.dataTertanggung23', {}, {
							reload: true,
							inherit: false
						});
					} else {
						return false;
					}
				}
			}
		}
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPageTertanggung1Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {});
		};
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
	}
])
//////////// PAGE 1
//////////// PAGE 2
.controller('dataTertanggung23Ctrl', ['$scope', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', 'syncService', '$store', '$state',
	function ($scope, $stateParams, dataFactory, spajProvider, $ionicPopup, syncService, $store, $state) {
		$scope.pageId = 'aplikasiSPAJOnline.dataTertanggung23';
		$scope.messages = false;
		$scope.data = null;
		$scope.provinsis = dataFactory.getProvinsis();
		$scope.kabupatens = dataFactory.getKabupatens();
		$scope.kabupatens1 = dataFactory.getKabupatens();
		$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();
		//INIT FORM 
		prospek = false;
		try {
			$pros = JSON.parse(spajProvider.getProspekData());
			prospek = $pros.find(obj => {
				return obj.build_id === spajProvider.getBuildId()
			});
		} catch (e) {
			prospek = {
				'kdprovinsi': '0',
				'alamat': ''
			}
		}
		$scope.$on('$ionicView.enter', function () {
			$scope.init_data();
			//console.log(prospek);
			$scope.setKabupatensValues(prospek.kdpropinsi);
			$scope.init_display();
		});
		$scope.init_display = function () {
			return true;
		};
		$scope.init_data = function () {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'build_id': spajProvider.getBuildId(),
				'provinsiKTPtertanggung': prospek.kdpropinsi, //$scope.provinsis[0].id,
				'statusTinggalKTPtertanggung': $scope.statustempattinggals[0].id,
				'statusTinggalSurattertanggung': $scope.statustempattinggals[0].id,
				'provinsiSurattertanggung': $scope.provinsis[0].id,
				'alamatKTPtertanggung': prospek.alamat,
				'kabupatenKTPtertanggung': $scope.kabupatens[0].id,
				'kodeposKTPtertanggung': '',
				'isAlamatKTPtertanggungSama': false,
				'alamatSurattertanggung': '',
				'kabupatenSurattertanggung': '',
				'nomorHptertanggung': prospek.telp,
				'nomorTelptertanggung': prospek.telp,
				'kodeposSurattertanggung': '',
				'emailtertanggung': prospek.email,
				'isSetujuHPtertanggung': false,
				'isSetujuEmailtertanggung': false,
				'isPageTertanggung2Accepted': false
			}
			// get set data from localStorage
			if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId) == null) {
				//$scope.init_data();
			} else {
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
			}
		}
		$scope.validateThisFormOnPageAccept = function () {
			//validate datanya
			$scope.messages = [];
			try {
				if ($scope.data == null) {
					$scope.messages.push({
						"message": "Data ERROR. Null data."
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			//validate nama, NOMOR KTP NPWP
			try {
				tryMe = $scope.data.statusTinggalKTPtertanggung;
				if ($scope.data.statusTinggalKTPtertanggung == '0') {
					$scope.messages.push({
						'message': "Silahkan pilih status tempat tinggal tertanggung!"
					});
				}
				tryMe = $scope.data.alamatKTPtertanggung;
				if ($scope.data.alamatKTPtertanggung == '' && !(tryMe.match(/^\d+$/))) {
					$scope.messages.push({
						'message': "Alamat KTP Harus benar!"
					});
				}
				tryMe = $scope.data.provinsiKTPtertanggung;
				if ($scope.data.provinsiKTPtertanggung == '0') {
					$scope.messages.push({
						'message': "Provinsi harus dipilih!"
					});
				}
				tryMe = $scope.data.kabupatenKTPtertanggung;
				if ($scope.data.kabupatenKTPtertanggung == '' && !(tryMe.match(/^[a-z\d\-_\s]+$/i))) {
					$scope.messages.push({
						'message': "Kabupaten harus benar!"
					});
				}
				tryMe = $scope.data.kodeposKTPtertanggung;
				if ($scope.data.alamatKTPtertanggung == '' && !(tryMe.match(/^\d+$/))) {
					//$scope.messages.push({'message':"Kodepos harus benar!"}) ;
				}
				tryMe = $scope.data.nomorHptertanggung;
				if ($scope.data.nomorHptertanggung == '' && !(tryMe.match(/^\d+$/))) {
					$scope.messages.push({
						'message': "Nomor HP harus benar!"
					});
				}
				tryMe = $scope.data.nomorTelptertanggung;
				if ($scope.data.nomorTelptertanggung == '' && !(tryMe.match(/^\d+$/))) {
					$scope.messages.push({
						'message': "Nomor Telepon harus benar!"
					});
				}
				tryMe = $scope.data.emailtertanggung;
				if ((typeof $scope.data.emailtertanggung == '') || !(tryMe.match(/\S+@\S+\.\S+/))) {
					$scope.messages.push({
						'message': "Email harus benar!"
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			if (!$scope.data.isAlamatKTPtertanggungSama) {
				if ($scope.data.statusTinggalSurattertanggung == '0') $scope.messages.push({
					'message': "Status tempat tinggal alamat surat harus dipilih!"
				});
				if ($scope.data.alamatSurattertanggung == '') $scope.messages.push({
					'message': "Alamat surat harus benar!"
				});
				if ($scope.data.provinsiSurattertanggung == '0') $scope.messages.push({
					'message': "Provinsi alamat surat harus benar!"
				});
				if ($scope.data.kabupatenSuratPempol == '') $scope.messages.push({
					'message': "Kabupaten alamat surat harus benar!"
				});
				//if($scope.data.kodeposSuratPempol =='')$scope.messages.push({'message':"Kode pus alamat surat harus benar!"}) ;
			}
			if ($scope.messages.length > 0) {
				return $scope.messages;
			}
			return false;
		}
		$scope.setKabupatensValues1 = function (provs) {
			$scope.kabupatens1 = dataFactory.getKabupatens();
			kabs = $scope.kabupatens1.filter(obj => {
				return (obj.kdprop === '0' || obj.kdprop === provs)
			});
			$scope.kabupatens1 = kabs;
			$scope.data.kabupatenSurattertanggung = '0';
		}
		$scope.setKabupatensValues = function (provs) {
			$scope.kabupatens = dataFactory.getKabupatens();
			kabs = $scope.kabupatens.filter(obj => {
				return (obj.kdprop === '0' || obj.kdprop === provs)
			});
			$scope.kabupatens = kabs;
			$scope.data.kabupatenKTPtertanggung = '0';
		}
		$scope.alamatSamaDenganKTP = function () {
			var $alamaKTP = spajProvider.getSpajElement($scope.pageId);
			var $alamatSurat = this.data;
			if ($scope.data.isAlamatKTPtertanggungSama) {
				$alamatSurat.statusTinggalSurattertanggung = $alamaKTP.data.statusTinggalKTPtertanggung;
				$alamatSurat.alamatSurattertanggung = $alamaKTP.data.alamatKTPtertanggung;
				$alamatSurat.provinsiSurattertanggung = $alamaKTP.data.provinsiKTPtertanggung;
				$alamatSurat.kabupatenSurattertanggung = $alamaKTP.data.kabupatenKTPtertanggung;
				$alamatSurat.kodeposSurattertanggung = $alamaKTP.data.kodeposKTPtertanggung;
			} else {
				$alamatSurat.statusTinggalSurattertanggung = $scope.statustempattinggals[0].id;
				$alamatSurat.alamatSurattertanggung = "";
				$alamatSurat.provinsiSurattertanggung = $scope.provinsis[0].id;
				$alamatSurat.kabupatenSurattertanggung = "";
				$alamatSurat.kodeposSurattertanggung = "";
			}
		}
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPageTertanggung2Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.dataTertanggung23',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
		}
		$scope.moveToNextPage = function () {
			if ($scope.validateThisFormOnPageAccept()) {
				$scope.data.isPageTertanggung2Accepted = false;
				$scope.showAlert('Validasi', spajProvider.alertMessagebuilder($scope.messages));
				return false;
			} else {
				if ($scope.data.isPageTertanggung2Accepted) {
					if (confirm('Langsung menuju ke halaman form isian data pendukung tertanggung?')) {
						$state.go('aplikasiSPAJOnline.dataTertanggung33', {}, {
							reload: true,
							inherit: false
						});
					} else {
						return false;
					}
				}
			}
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
	}
])
/////////// PAGE 2
/////////// PAGE 3
.controller('dataTertanggung33Ctrl', ['$scope', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', 'syncService', '$store', '$state',
	function ($scope, $stateParams, dataFactory, spajProvider, $ionicPopup, syncService, $store, $state) {
		$scope.pageId = 'aplikasiSPAJOnline.dataTertanggung33';
		$scope.messages = false;
		$scope.provinsis = dataFactory.getProvinsis();
		$scope.genders = dataFactory.getGenders();
		$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();
		$scope.pendidikans = dataFactory.getPendidikans();
		$scope.statuss = dataFactory.getStatusNikahs();
		$scope.tglLahirTertanggungTambahan1 = new Date('10/10/1990');
		$scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
		//INIT FORM 
		$scope.$on('$ionicView.enter', function () {
			$scope.init_data();
			$scope.init_display();
		});
		$scope.init_display = function () {
			return true;
		};
		$scope.init_data = function () {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'provinsiSuratSaudaraTertanggung': $scope.provinsis[0].id,
				'statusPernikahanTertanggung': $scope.statuss[0].id,
				'pendidikanTertanggung': $scope.pendidikans[0].id,
				'jenisKelaminTertanggungTambahan1': $scope.genders[0].id,
				'hubunganTT1DenganTTU': $scope.hubunganKeluargas[0].id,
				'hubunganTT2DenganTTU': $scope.hubunganKeluargas[0].id,
				'hubunganTT3DenganTTU': $scope.hubunganKeluargas[0].id,
				'hubunganTT4DenganTTU': $scope.hubunganKeluargas[0].id,
				'tinggiBadanTertanggung': '',
				'noKtpTertanggungTambahan1': '',
				'beratBadanTertanggung': '',
				'ibuKandungTertanggung': '',
				'namaSaudaraTertanggung': '',
				'alamatSuratSaudaraTertanggung': '',
				'kabupatenSuratSaudaraTertanggung': '',
				'kodeposSuratSaudaraTertanggung': '',
				'isAdaTertanggungTambahan1': false,
				'tglLahirTertanggungTambahan1': $scope.tglLahirTertanggungTambahan1,
				'tempatLahirTertanggungTambahan1': '',
				'noTelpSaudaraTertanggung': '',
				'namaTertanggungTambahan1': '',
				'namaKantorTertanggungTambahan1': '',
				'alamatKantorTertanggungTambahan1': '',
				'tinggiBadanTertanggungTambahan1': '',
				'beratBadanTertanggungTambahan1': '',
				'isPageTertanggung3Accepted': false,
			}
			if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId) == null) {
				//$scope.init_data();
			} else {
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
				$scope.data.tglLahirTertanggungTambahan1 = new Date($scope.data.tglLahirTertanggungTambahan1);
			}
		}
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': $scope.pageId,
				'data': $scope.data
			};
			$scope.data.tglLahirTertanggungTambahan1 = new Date($scope.data.tglLahirTertanggungTambahan1);
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
			//console.log($scope.data);
		}
		$scope.moveToNextPage = function () {
			if ($scope.validateThisFormOnPageAccept()) {
				$scope.showAlert('Validasi', spajProvider.alertMessagebuilder($scope.messages));
				$scope.data.isPageTertanggung3Accepted = false;
				return false;
			} else {
				if ($scope.data.isPageTertanggung3Accepted) {
					if (confirm('Langsung menuju ke halaman form isian pekerjaan tertanggung?')) {
						$state.go('aplikasiSPAJOnline.pekerjaanTertanggung', {}, {
							reload: true,
							inherit: false
						});
					} else {
						return false;
					}
				}
			}
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId) == null) {
			$scope.init_data();
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
		}
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPageTertanggung3Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
		$scope.validateThisFormOnPageAccept = function () {
			//validate datanya
			$scope.messages = [];
			try {
				if ($scope.data == null) {
					$scope.messages.push({
						"message": "Data ERROR. Null data."
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			//validate nama, NOMOR KTP NPWP
			try {
				tryMe = $scope.data.tinggiBadanTertanggung;
				//console.log(typeof tryMe);
				if (($scope.data.tinggiBadanTertanggung == null)) {
					$scope.messages.push({
						'message': "Tinggi badan harus benar!"
					});
				}
				tryMe = $scope.data.beratBadanTertanggung;
				if ($scope.data.beratBadanTertanggung == null) {
					$scope.messages.push({
						'message': "Berat badan harus benar!"
					});
				}
				tryMe = $scope.data.ibuKandungTertanggung;
				if ($scope.data.ibuKandungTertanggung == '' && !(tryMe.match(/^[A-Za-z]+$/))) {
					$scope.messages.push({
						'message': "Nama ibu kandung harus benar!"
					});
				}
				tryMe = $scope.data.pendidikanTertanggung;
				if ('0' == tryMe) {
					$scope.messages.push({
						'message': "Silahkan pilih Pendidikan Terakhir"
					});
				}
				tryMe = $scope.data.statusPernikahanTertanggung;
				if ('0' == tryMe) {
					$scope.messages.push({
						'message': "Silahkan pilih Status Pernikahan"
					});
				}
				if ($scope.data.isAdaTertanggungTambahan1) {
					if ($scope.data.noKtpTertanggungTambahan1 == '') $scope.messages.push({
						'message': "Nomor KTP tertanggung tambahan harus benar!"
					});
					if ($scope.data.tglLahirTertanggungTambahan1 == '') $scope.messages.push({
						'message': "Tanggal lahir tertanggung tambahan harus benar!"
					});
					if ($scope.data.jenisKelaminTertanggungTambahan1 == '0') $scope.messages.push({
						'message': "Jenis Kelamin tertanggung tambahan harus benar!"
					});
					if ($scope.data.tempatLahirTertanggungTambahan1 == '') $scope.messages.push({
						'message': "Tempat lahir tertanggung tambahan harus benar!"
					});
					if ($scope.data.namaTertanggungTambahan1 == '') $scope.messages.push({
						'message': "Nama tertanggung tambahan harus benar!"
					});
					//if($scope.data.namaKantorTertanggungTambahan1 == '')$scope.messages.push({'message':"Nama Kantor tertanggung tambahan harus benar!"});
					//if($scope.data.alamatKantorTertanggungTambahan1 == '')$scope.messages.push({'message':"Alamat kantor tertanggung tambahan harus benar!"});
					if ($scope.data.tinggiBadanTertanggungTambahan1 == null) $scope.messages.push({
						'message': "Tinggi tertanggung tambahan harus benar!"
					});
					if ($scope.data.beratBadanTertanggungTambahan1 == null) $scope.messages.push({
						'message': "Berat Badan tertanggung tambahan harus benar!"
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			if ($scope.messages.length > 0) {
				return $scope.messages;
			}
			return false;
		}
	}
])
////////// PAGE 3
//////////
.controller('dataPemegangPolis13Ctrl', ['$state', '$scope', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', 'syncService', '$store',
	function ($state, $scope, $stateParams, dataFactory, spajProvider, $ionicPopup, syncService, $store) {
		$scope.genders = dataFactory.getGenders();
		$scope.agamas = dataFactory.getAgamas();
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		$scope.changeImage = function () {
			spajProvider.takePict(this, 'canvasKTPpempol');
			$scope.data.imageKTPpempol = spajProvider.getImageBase64('canvasKTPpempol', 'jpg');
		}
		$scope.saveDataSpaj = function () {
			$scope.data.imageKTPpempol = spajProvider.getImageBase64('canvasKTPpempol', 'jpg');
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.dataPemegangPolis13',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement(), true));
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis13') == null) {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'agamaPempol': $scope.agamas[0].id,
				'jenkelPempol': $scope.genders[0].id,
				'isKTPPempolAllAge': false,
				'isPagePempol1Accepted': false,
				'namaLengkapPempol': '',
				'nomorKTPPempol': '',
				'tglLahirPempol': '10/10/2016',
				'nomorNPWPPempol': '',
				'masaBerlakuKTPPempol': '',
				'imageKTPpempol': null,
				'isTertanggungPempol': false,
				'isPempolPembayarPremi': true
			}
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis13');
			decodedImage = null;
			try {
				decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.data.imageKTPpempol));
			} catch (e) {
				decodedImage = '';
			}
			$scope.data.tglLahirPempol = new Date($scope.data.tglLahirPempol);
			spajProvider.putImageTo('canvasKTPpempol', decodedImage);
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
		$scope.pempolAdalahTertanggung = function () {
			var $tertanggung = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung13');
			var $tertanggungPage2 = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung23');
			var $tertanggungPage3 = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung33');
			var $tertanggungPekerjaan = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.pekerjaanTertanggung');
			var $pempol = this.data;
			var $pgTertanggung2 = null;
			var $pgTertanggung3 = null;
			if ($scope.data.isTertanggungPempol && $tertanggung != null) {
				$pempol.namaLengkapPempol = $tertanggung.namaLengkapTertanggung;
				$pempol.nomorKTPPempol = $tertanggung.nomorKTPTertanggung;
				$pempol.nomorNPWPPempol = $tertanggung.nomorNPWPTertanggung;
				$pempol.jenkelPempol = $tertanggung.jenkelTertanggung;
				$pempol.agamaPempol = $tertanggung.agamaTertanggung;
				$pempol.imageKTPpempol = $tertanggung.imageKTPTertanggung;
				decodedImage = spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($pempol.imageKTPpempol));
				spajProvider.putImageTo('canvasKTPpempol', decodedImage);
				$pempol.isPagePempol1Accepted = false;
				$pempol.isTertanggungPempol = true;
				$pempol.tglLahirPempol = new Date($tertanggung.tglLahirTertanggung)
				//console.log($tertanggungPage2.tglLahirTertanggung);
				$pgTertanggung2 = {
					'spaj_guid': spajProvider.getSpajGUID(),
					'provinsiKTPPempol': $tertanggungPage2.provinsiKTPtertanggung,
					'provinsiSuratPempol': $tertanggungPage2.provinsiSurattertanggung,
					'statusTinggalKTPPempol': $tertanggungPage2.statusTinggalKTPtertanggung,
					'statusTinggalSuratPempol': $tertanggungPage2.statusTinggalSurattertanggung,
					'alamatKTPPempol': $tertanggungPage2.alamatKTPtertanggung,
					'tglLahirPempol': $scope.tglLahirPempol,
					'kabupatenKTPPempol': $tertanggungPage2.kabupatenKTPtertanggung,
					'kodeposKTPPempol': $tertanggungPage2.kodeposKTPtertanggung,
					'isAlamatKTPPempolSama': $tertanggungPage2.isAlamatKTPtertanggungSama,
					'alamatSuratPempol': $tertanggungPage2.alamatSurattertanggung,
					'kabupatenSuratPempol': $tertanggungPage2.kabupatenSurattertanggung,
					'kodeposSuratPempol': $tertanggungPage2.kodeposSurattertanggung,
					'nomorHpPempol': $tertanggungPage2.nomorHptertanggung,
					'nomorTelpPempol': $tertanggungPage2.nomorTelptertanggung,
					'emailPempol': $tertanggungPage2.emailtertanggung,
					'isSetujuHPPempol': $tertanggungPage2.isSetujuHPtertanggung,
					'isSetujuEmailPempol': $tertanggungPage2.isSetujuEmailtertanggung,
					'isPagePempol2Accepted': false
				}
				$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + 'aplikasiSPAJOnline.dataPemegangPolis23', $pgTertanggung2);
				$pgTertanggung3 = {
					'spaj_guid': spajProvider.getSpajGUID(),
					'provinsiSuratTakSerumahPempol': $tertanggungPage3.provinsiSuratSaudaraTertanggung,
					'statusNikahPempol': $tertanggungPage3.statusPernikahanTertanggung,
					'pendidikanPempol': $tertanggungPage3.pendidikanTertanggung,
					'tinggiBadanPempol': $tertanggungPage3.tinggiBadanTertanggung,
					'beratBadanPempol': $tertanggungPage3.beratBadanTertanggung,
					'namaIbuPempol': $tertanggungPage3.ibuKandungTertanggung,
					'namaSaudaraTakSerumahPempol': $tertanggungPage3.namaSaudaraTertanggung,
					'alamatSuratTakSerumahPempol': $tertanggungPage3.alamatSuratSaudaraTertanggung,
					'kabupatenTakSerumahPempol': $tertanggungPage3.kabupatenSuratSaudaraTertanggung,
					'kodeposSuratSaudaraTertanggung': $tertanggungPage3.kodeposSuratSaudaraTertanggung,
					'kodeposTakSerumahPempol': $tertanggungPage3.kodeposSuratSaudaraTertanggung,
					'noHPTakSerumah': $tertanggungPage3.hpSuratSaudaraTertanggung,
					'noTelTakSerumah': $tertanggungPage3.noTelpSaudaraTertanggung,
					'isPagePempol3Accepted': false,
					'isTertanggungPempol': true
				}
				$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + 'aplikasiSPAJOnline.dataPemegangPolis33', $pgTertanggung3);
				$pgPekerjaanPempol = {
					'spaj_guid': spajProvider.getSpajGUID(),
					'jenisPerusahaanPempol': $tertanggungPekerjaan.jenisPerusahaanTertanggung,
					'pekerjaanPempol': $tertanggungPekerjaan.pekerjaanTertanggung,
					'pangkatPempol': $tertanggungPekerjaan.pangkatTertanggung,
					'klasifikasiPekerjaanPempol': $tertanggungPekerjaan.klasifikasiPekerjaanTertanggung,
					'rangeGajiPempol': $tertanggungPekerjaan.rangeGajiTertanggung,
					'rangeGajiPempolJmlLainnya': $tertanggungPekerjaan.rangeGajiTertanggungJmlLainnya,
					'rangePendapatanPempol': $tertanggungPekerjaan.rangePendapatanTertanggung,
					'rangePendapatanPasangan': $tertanggungPekerjaan.rangePendapatanPasangan,
					'rangePendapatanPasanganLainnya': '',
					'rangeHasilInvestasi': $tertanggungPekerjaan.rangeHasilInvestasi,
					'rangeHasilInvestasiLainnya': '',
					'rangeBisnis': $tertanggungPekerjaan.rangeBisnis,
					'rangeBisnisLainnya': '',
					'rangeBonus': $tertanggungPekerjaan.rangeBonus,
					'paymentBankNameLainnya': '',
					'rangeBonusLainnya': '',
					'namaPerusahaanPempol': $tertanggungPekerjaan.namaPerusahaanTertanggung,
					'alamatPerusahaanPempol': $tertanggungPekerjaan.alamatPerusahaanTertanggung,
					'kodeposPerusahaanPempol': $tertanggungPekerjaan.kodeposPerusahaanTertanggung,
					'nomorTeleponPerusahaanPempol': $tertanggungPekerjaan.nomorTeleponPerusahaanTertanggung,
					'nomorEkstensiPerusahaanPempol': $tertanggungPekerjaan.nomorEkstensiPerusahaanTertanggung,
					'isPagePekerjaanPempol1Accepted': '',
					'pemilikWirausahaPempol': $tertanggungPekerjaan.pemilikWirausahaTertanggung,
					'bidangWirausahaPempol': $tertanggungPekerjaan.bidangWirausahaTertanggung,
					'namaWirausahaPempol': $tertanggungPekerjaan.namaWirausahaTertanggung,
					'alamatWirausahaPempol': $tertanggungPekerjaan.alamatWirausahaTertanggung
				}
				$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + 'aplikasiSPAJOnline.pekerjaanPemegangPolis', $pgPekerjaanPempol);
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
					'spaj_guid': spajProvider.getSpajGUID(),
					'provinsiKTPPempol': '0',
					'provinsiSuratPempol': '0',
					'statusTinggalKTPPempol': '0',
					'statusTinggalSuratPempol': '0',
					'tglLahirPempol': '',
					'alamatKTPPempol': '',
					'kabupatenKTPPempol': '',
					'kodeposKTPPempol': '',
					'isAlamatKTPPempolSama': false,
					'alamatSuratPempol': '',
					'kabupatenSuratPempol': '',
					'kodeposSuratPempol': '',
					'nomorHpPempol': '',
					'nomorTelpPempol': '',
					'emailPempol': '',
					'isSetujuHPPempol': false,
					'isSetujuEmailPempol': false,
					'isPagePempol2Accepted': false
				}
				$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + 'aplikasiSPAJOnline.dataPemegangPolis23', $pgTertanggung2);
				$pgTertanggung3 = {
					'spaj_guid': spajProvider.getSpajGUID(),
					'provinsiSuratTakSerumahPempol': '0',
					'statusNikahPempol': '0',
					'pendidikanPempol': '',
					'tinggiBadanPempol': '',
					'beratBadanPempol': '',
					'namaIbuPempol': '',
					'namaTakSerumahPempol': '',
					'alamatSuratTakSerumahPempol': '',
					'kabupatenTakSerumahPempol': '',
					'kodeposSuratSaudaraTertanggung': '',
					'kodeposTakSerumahPempol': '',
					'noHPTakSerumah': '',
					'noTelTakSerumah': '',
					'isPagePempol3Accepted': false,
					'isTertanggungPempol': false
				}
				$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + 'aplikasiSPAJOnline.dataPemegangPolis33', $pgTertanggung3);
				this.saveDataSpaj();
			}
		}
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPagePempol1Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
		$scope.moveToNextPage = function () {
			if ($scope.data.isPagePempol1Accepted) {
				if (confirm('Langsung menuju ke halaman isian form tempat tinggal Pemegang Polis?')) {
					$state.go('aplikasiSPAJOnline.dataPemegangPolis23', {}, {
						reload: true,
						inherit: false
					});
				} else {
					return false;
				}
			}
		}
	}
])
//////////
////////// 
.controller('dataPemegangPolis23Ctrl', ['$state', '$scope', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', 'syncService', '$store',
	function ($state, $scope, $stateParams, dataFactory, spajProvider, $ionicPopup, syncService, $store) {
		$scope.provinsis = dataFactory.getProvinsis();
		$scope.kabupatens = dataFactory.getKabupatens();
		$scope.kabupatens1 = dataFactory.getKabupatens();
		$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPagePempol2Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
		$scope.setKabupatensValues = function (provs) {
			$scope.kabupatens = dataFactory.getKabupatens();
			kabs = $scope.kabupatens.filter(obj => {
				return (obj.kdprop === '0' || obj.kdprop === provs)
			});
			$scope.kabupatens = kabs;
			$scope.data.kabupatenKTPPempol = '0';
		}
		$scope.setKabupatensValues1 = function (provs) {
			$scope.kabupatens1 = dataFactory.getKabupatens();
			kabs = $scope.kabupatens1.filter(obj => {
				return (obj.kdprop === '0' || obj.kdprop === provs)
			});
			$scope.kabupatens1 = kabs;
			$scope.data.kabupatenSuratPempol = '0';
			//console.log($scope.kabupatens1 );
		}
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.dataPemegangPolis23',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
		}
		$scope.moveToNextPage = function () {
			if ($scope.data.isPagePempol2Accepted) {
				if (confirm('Langsung menuju ke halaman isian form pendukung Pemegang Polis?')) {
					$state.go('aplikasiSPAJOnline.dataPemegangPolis33', {}, {
						reload: true,
						inherit: false
					});
				} else {
					return false;
				}
			}
		}
		prospek = false;
		try {
			$pros = JSON.parse(spajProvider.getProspekData());
			prospek = $pros.find(obj => {
				return obj.build_id === spajProvider.getBuildId()
			});
		} catch (e) {
			prospek = {
				'kdprovinsi': '0',
				'alamat': ''
			}
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis23') == null) {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'provinsiKTPPempol': $scope.provinsis[0].id,
				'kabupatenKTPPempol': $scope.kabupatens[0].id,
				'provinsiSuratPempol': $scope.provinsis[0].id,
				'statusTinggalKTPPempol': $scope.statustempattinggals[0].id,
				'statusTinggalSuratPempol': $scope.statustempattinggals[0].id,
				'alamatKTPPempol': '',
				'kodeposKTPPempol': '',
				'isAlamatKTPPempolSama': false,
				'alamatSuratPempol': '',
				'kabupatenSuratPempol': '',
				'kodeposSuratPempol': '',
				'nomorHpPempol': '',
				'nomorTelpPempol': '',
				'emailPempol': '',
				'isSetujuHPPempol': false,
				'isSetujuEmailPempol': false,
				'isPagePempol2Accepted': false
			}
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis23');
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
	}
])
//////////
//////////
.controller('dataPemegangPolis33Ctrl', ['$scope', '$state', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', '$ionicModal', 'syncService', '$store',
	function ($scope, $state, $stateParams, dataFactory, spajProvider, $ionicPopup, $ionicModal, syncService, $store) {
		$scope.provinsis = dataFactory.getProvinsis();
		$scope.statustempattinggals = dataFactory.getStatusTempatTinggals();
		$scope.pendidikans = dataFactory.getPendidikans();
		$scope.isTertanggungPempol = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis13').isTertanggungPempol;
		//console.log($scope.isTertanggungPempol);
		$scope.moveToNextPage = function () {
			if ($scope.data.isPagePempol3Accepted) {
				if (confirm('Langsung menuju ke halaman PERSETUJUAN eSPAJ?')) {
					$state.go('aplikasiSPAJOnline.lembarPersetujuan', {}, {
						reload: true,
						inherit: false
					});
				} else {
					return false;
				}
			}
		}
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPagePempol33Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
		$scope.statuss = dataFactory.getStatusNikahs();
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.dataPemegangPolis33',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataPemegangPolis33'), true));
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis33') == null) {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'provinsiSuratTakSerumahPempol': $scope.provinsis[0].id,
				'statusNikahPempol': $scope.statuss[0].id,
				'pendidikanPempol': $scope.pendidikans[0].id,
				'tinggiBadanPempol': '',
				'beratBadanPempol': '',
				'namaIbuPempol': '',
				'namaSaudaraTakSerumahPempol': '',
				'alamatSuratTakSerumahPempol': '',
				'kabupatenTakSerumahPempol': '',
				'kodeposSuratSaudaraTertanggung': '',
				'kodeposTakSerumahPempol': '',
				'noHPTakSerumah': '',
				'noTelTakSerumah': '',
				'isPagePempol3Accepted': false,
				'isTertanggungPempol': false,
			}
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataPemegangPolis33');
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
	}
])
//////////
//////////
.controller('pekerjaanTertanggungCtrl', ['$scope', '$state', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', '$store',
	function ($scope, $state, $stateParams, dataFactory, spajProvider, $ionicPopup, $store) {
		$scope.pekerjaans = dataFactory.getPekerjaans();
		$scope.pangkats = dataFactory.getPangkats();
		$scope.kelaspekerjaans = dataFactory.getKelasPekerjaans();
		$scope.jenisperusahaans = dataFactory.getJenisPerusahaans();
		$scope.rangegajitertanggungs = dataFactory.getRangeGajis();
		$scope.messages = false;
		$scope.pageId = 'aplikasiSPAJOnline.pekerjaanTertanggung';
		//INIT FORM 
		$scope.$on('$ionicView.enter', function () {
			$scope.init_data();
			$scope.init_display();
		});
		$scope.init_display = function () {
			return true;
		};
		prospek = false;
		try {
			$pros = JSON.parse(spajProvider.getProspekData());
			prospek = $pros.find(obj => {
				return obj.build_id === spajProvider.getBuildId()
			});
		} catch (e) {}
		$scope.init_data = function () {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'jenisPerusahaanTertanggung': $scope.jenisperusahaans[0].id,
				'pekerjaanTertanggung': $scope.pekerjaans[0].id,
				'pangkatTertanggung': $scope.pangkats[0].id,
				'klasifikasiPekerjaanTertanggung': '',
				'rangeGajiTertanggung': $scope.rangegajitertanggungs[1].id,
				'rangePendapatanTertanggung': $scope.rangegajitertanggungs[2].id,
				'rangePendapatanPasangan': $scope.rangegajitertanggungs[2].id,
				'rangeHasilInvestasi': $scope.rangegajitertanggungs[2].id,
				'rangeBisnis': $scope.rangegajitertanggungs[2].id,
				'rangeBonus': $scope.rangegajitertanggungs[2].id,
				'rangePendapatanTertanggung': $scope.rangegajitertanggungs[2].id,
				'sumberPendapatanLainnya': '',
				'namaPerusahaanTertanggung': '',
				'alamatPerusahaanTertanggung': '',
				'kodeposPerusahaanTertanggung': '',
				'nomorTeleponPerusahaanTertanggung': '',
				'nomorEkstensiPerusahaanTertanggung': '',
				'isPagePekerjaanTertanggung1Accepted': '',
				'pemilikWirausahaTertanggung': '',
				'bidangWirausahaTertanggung': '',
				'namaWirausahaTertanggung': '',
				'alamatWirausahaTertanggung': '',
				'rangePendapatanTertanggungLainnya': '',
				'rangeGajiTertanggungJmlLainnya': prospek.penghasilan
			}
			if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId) == null) {} else {
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
			}
		}
		$scope.validateThisFormOnPageAccept = function () {
			//validate datanya
			$scope.messages = [];
			try {
				if ($scope.data == null) {
					$scope.messages.push({
						"message": "Data ERROR. Null data."
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			//validate nama, NOMOR KTP NPWP
			try {
				tryMe = $scope.data.pekerjaanTertanggung;
				if ($scope.data.pekerjaanTertanggung == '0') {
					$scope.messages.push({
						'message': "Pekerjaan harus benar!"
					});
				}
				tryMe = $scope.data.pekerjaanTertanggung;
				if ('wirausaha' == tryMe) {
					//if(''==$scope.data.pemilikWirausahaTertanggung) $scope.messages.push({'message':"Kepemilikan usaha harus benar!"});
					//if(''==$scope.data.bidangWirausahaTertanggung)$scope.messages.push({'message':"Bidang wirausaha harus benar!"});
					//if(''==$scope.data.namaWirausahaTertanggung)$scope.messages.push({'message':"Nama wirausaha harus benar!"});
					//if(''==$scope.data.alamatWirausahaTertanggung)$scope.messages.push({'message':"Alamat wirausaha harus benar!"});
				}
				tryMe = $scope.data.pangkatTertanggung;
				if ($scope.data.pangkatTertanggung == '0') {
					//$scope.messages.push({'message':"Pangkat/jabatan/golongan harus benar!"}) ;
				}
				tryMe = $scope.data.rangeGajiTertanggung;
				if ($scope.data.rangeGajiTertanggung == '0') {
					//$scope.messages.push({'message':"Range Gaji harus benar!"}) ;
				}
				tryMe = $scope.data.rangePendapatanPasangan;
				if ('0' == tryMe) {
					//$scope.messages.push({'message':"Range pendapatan suami/istri harus benar!"});
				}
				tryMe = $scope.data.rangeHasilInvestasi;
				if ('0' == tryMe) {
					//$scope.messages.push({'message':"Range hasil investasi harus benar!"});
				}
				tryMe = $scope.data.rangeBisnis;
				if ('0' == tryMe) {
					//$scope.messages.push({'message':"Range hasil bisnis pribadi harus benar!"});
				}
				tryMe = $scope.data.rangePendapatanTertanggung;
				if ('0' == tryMe) {
					//$scope.messages.push({'message':"Range pendapatan lainnya harus benar!"});
				}
				if ('4' == tryMe) {
					//if($scope.data.rangePendapatanTertanggungLainnya=='') $scope.messages.push({'message':"Jumlah pendapatan lainnya harus benar!"});
					//if($scope.data.sumberPendapatanLainnya=='') $scope.messages.push({'message':"Sumber pendapatan lainnya harus benar!"});
				}
				tryMe = $scope.data.jenisPerusahaanTertanggung;
				if ('0' == tryMe) {
					//$scope.messages.push({'message':"Jenis perusahaan harus benar!"});
				}
				tryMe = $scope.data.jenisPerusahaanTertanggung;
				if ('0' == tryMe) {
					//$scope.messages.push({'message':"Jenis perusahaan harus benar!"});
				}
				tryMe = $scope.data.namaPerusahaanTertanggung;
				if ('' == tryMe) {
					//$scope.messages.push({'message':"Nama perusahaan harus benar!"});
				}
				tryMe = $scope.data.alamatPerusahaanTertanggung;
				if ('' == tryMe) {
					//$scope.messages.push({'message':"Alamat perusahaan harus benar!"});
				}
				tryMe = $scope.data.kodeposPerusahaanTertanggung;
				if ('' == tryMe) {
					//$scope.messages.push({'message':"Kodepos perusahaan harus benar!"});
				}
				tryMe = $scope.data.nomorTeleponPerusahaanTertanggung;
				if ('' == tryMe) {
					//$scope.messages.push({'message':"Nomor telpon perusahaan harus benar!"});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			if ($scope.messages.length > 0) {
				return $scope.messages;
			}
			return false;
		}
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': $scope.pageId,
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.pekerjaanTertanggung'), true));
		}
		$scope.getKelasPekerjaan = function (idpekerjaan) {
			var dtpek = null;
			for (i = 1; i < $scope.pekerjaans.length; i++) {
				if (idpekerjaan == $scope.pekerjaans[i].id) {
					dtpek = $scope.pekerjaans[i].kelas;
				}
			}
			$scope.data.klasifikasiPekerjaanTertanggung = dtpek;
			return dtpek;
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
		$scope.moveToNextPage = function () {
			if ($scope.validateThisFormOnPageAccept()) {
				$scope.showAlert('Validasi', spajProvider.alertMessagebuilder($scope.messages));
				$scope.data.isPagePekerjaanTertanggung1Accepted = false;
			} else {
				if ($scope.data.isPagePekerjaanTertanggung1Accepted) {
					if (confirm('Langsung menuju ke halaman form isian Produk dan Penerima Manfaat?')) {
						$state.go('aplikasiSPAJOnline.produkDanManfaat12', {}, {
							reload: true,
							inherit: false
						});
					} else {
						return false;
					}
				}
			}
		}
	}
])
//////////
//////////
.controller('pekerjaanPemegangPolisCtrl', ['$scope', '$stateParams', 'dataFactory', 'spajProvider', '$ionicPopup', '$store',
	function ($scope, $stateParams, dataFactory, spajProvider, $ionicPopup, $store) {
		$scope.pekerjaans = dataFactory.getPekerjaans();
		$scope.pangkats = dataFactory.getPangkats();
		$scope.kelaspekerjaans = dataFactory.getKelasPekerjaans();
		$scope.rangegajiPempols = dataFactory.getRangeGajis();
		$scope.jenisperusahaans = dataFactory.getJenisPerusahaans();
		$scope.getKelasPekerjaan = function (idpekerjaan) {
			var dtpek = null;
			for (i = 1; i < $scope.pekerjaans.length; i++) {
				if (idpekerjaan == $scope.pekerjaans[i].id) {
					dtpek = $scope.pekerjaans[i].kelas;
				}
			}
			$scope.data.klasifikasiPekerjaanPempol = dtpek;
			return dtpek;
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.pekerjaanPemegangPolis',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.pekerjaanPemegangPolis'), true));
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.pekerjaanPemegangPolis') == null) {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'jenisPerusahaanPempol': $scope.jenisperusahaans[0].id,
				'pekerjaanPempol': $scope.pekerjaans[0].id,
				'pangkatPempol': $scope.pangkats[0].id,
				'klasifikasiPekerjaanPempol': $scope.kelaspekerjaans[0].id,
				'rangeGajiPempol': $scope.rangegajiPempols[0].id,
				'rangePendapatanPempol': $scope.rangegajiPempols[0].id,
				'rangePendapatanPasangan': $scope.rangegajiPempols[0].id,
				'rangePendapatanPasanganLainnya': '',
				'rangeHasilInvestasi': $scope.rangegajiPempols[0].id,
				'rangeHasilInvestasiLainnya': '',
				'rangeGajiPempolJmlLainnya': '',
				'rangeBisnis': $scope.rangegajiPempols[0].id,
				'rangeBisnisLainnya': '',
				'rangeBonus': $scope.rangegajiPempols[0].id,
				'paymentBankNameLainnya': '',
				'rangeBonusLainnya': '',
				'namaPerusahaanPempol': '',
				'alamatPerusahaanPempol': '',
				'kodeposPerusahaanPempol': '',
				'nomorTeleponPerusahaanPempol': '',
				'nomorEkstensiPerusahaanPempol': '',
				'isPagePekerjaanPempol1Accepted': '',
				'pemilikWirausahaPempol': '',
				'bidangWirausahaPempol': '',
				'namaWirausahaPempol': '',
				'alamatWirausahaPempol': ''
			}
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.pekerjaanPemegangPolis');
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
	}
])
///////////////
///////////////////
.controller('produkDanManfaat12Ctrl', ['$state', '$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store', '$ionicPopup',
	function ($state, $scope, $stateParams, spajProvider, dataFactory, $store, $ionicPopup) {
		$scope.jenisAsuransis = dataFactory.getJenisAsuransis();
		$scope.caraBayars = dataFactory.getCaraBayars();
		$scope.isShowRider = false;
		$scope.bayarBerikutnyas = dataFactory.getBayarBerikutnyas();
		$scope.jenisJsProteksiKeluargas = dataFactory.getJenisJsProteksiKeluargas();
		$scope.pctUnitlinkGuardians = dataFactory.getPctUnitlinkGuardians();
		$scope.jenisFunds = dataFactory.getjenisFunds();
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
		$scope.$on('$ionicView.enter', function () {
			$scope.init_data();
			$scope.init_display();
		});
		prospek = false;
		try {
			$pros = JSON.parse(spajProvider.getProspekData());
			prospek = $pros.find(obj => {
				return obj.build_id === spajProvider.getBuildId()
			});
		} catch (e) {
			prospek = {
				'kdprovinsi': '0',
				'alamat': ''
			}
		}
		$scope.init_data = function () {
			console.log(prospek.kd_produk);
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'jenisAsuransi': prospek.kd_produk, //$scope.jenisAsuransis[0].id,
				'caraBayar': (prospek.kd_produk == 'JL4BLN' || prospek.kd_produk == 'JL4BLN_') ? "M" : (prospek.kd_produk == 'JSSPOA' || prospek.kd_produk == 'JL4XN')?'X':'1', //$scope.caraBayars[0].id,
				'bayarPremiSelanjutnya': $scope.bayarBerikutnyas[0].id,
				'pctUnitlinkGuardian': $scope.pctUnitlinkGuardians[0].id,
				'isTujuanProteksi': false,
				'isTujuanTabungan': false,
				'isTujuanPendidikan': false,
				'isTujuanInvestasi': false,
				'isTujuanPensiun': false,
				'isTujuanLainnya': false,
				'tujuanAsuransiLainnya': '',
				'jenisJsProteksiKeluarga': $scope.jenisJsProteksiKeluargas[0].id,
				'unitPasarUang': 0,
				'pendapatanTetap': 0,
				'berimbang': 0,
				'ekuitas': 0,
				'totalPersenUnitLink': 0,
				'isTermRider': false,
				'isADDB': false,
				'isTPD': false,
				'isCI53': false,
				'hospitalCP': false,
				'hcpTypeSelect': false,
				'isRiderLainnya': false,
				'isRiderLainnya': false,
				'namaRiderLainnya': '',
				'riderLainnyaPremi': '',
				'isPBD': false,
				'isPBC151': false,
				'isPBTPD': false,
				'isSPD': false,
				'isSPCI51': false,
				'isSPTBD': false,
				'isWPC151': false,
				'isWPTPD': false,
				'masaBayarPremi': (prospek.kd_produk == 'JL4BLN' || prospek.kd_produk == 'JL4BLN_' || prospek.kd_produk == 'JL4XN') ? "99" : "60",
				'premi': prospek.jumlah_premi,
				'uangAsuransi': prospek.jua,
				'jangkaWaktuAsuransi': (prospek.kd_produk == 'JL4BLN' || prospek.kd_produk == 'JL4BLN_' || prospek.kd_produk == 'JL4XN') ? "99" : "60", //data.jenisAsuransi == 'JL4BLN' || data.jenisAsuransi == 'JL4BLN_' || data.jenisAsuransi == 'JL4XN'
				'nomorRekening': '',
				'namaRekening': prospek.nama,
				'paymentBankName': '',
				'isPageProdukManfaat1Accepted': false,
				'premiBerkala': prospek.premi_berkala,
				'topupBerkala': prospek.topup_berkala,
				'topupSekaligus': prospek.topup_sekaligus,
				'alokasiDana': prospek.kode_alokasi //'0'
			}
			$scope.selectUnitInvestasi($scope.data.alokasiDana);
			if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId) == null) {} else {
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
				$scope.getRiderGroup($scope.data.jenisAsuransi);
			}
		}
		$scope.setCaraBayarValues = function (kdproduk) {
			console.log(kdproduk);
			$scope.caraBayars = dataFactory.getCaraBayars();
			cabay = $scope.caraBayars.filter(obj => {
				return (obj.kdproduk === '0' || obj.kdproduk === kdproduk)
			});
			$scope.caraBayars = cabay;
			$scope.data.caraBayars = kdproduk;
		}
		$scope.selectUnitInvestasi = function (x) {
			$scope.data.unitPasarUang = 0;
			$scope.data.pendapatanTetap = 0;
			$scope.data.berimbang = 0;
			$scope.data.ekuitas = 0;
			switch (x) {
			case '1':
				$scope.data.unitPasarUang = 100;
				break;
			case '2':
				$scope.data.pendapatanTetap = 100;
				break;
			case '3':
				$scope.data.berimbang = 100;
				break;
			case '4':
				$scope.data.ekuitas = 100;
				break;
			default:
				// code block
			}
			//$scope.data.alokasiDana = x;
			//console.log($scope.data);
		}
		$scope.init_display = function () {}
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': $scope.pageId,
				'data': $scope.data
			};
			//console.log($formdata);
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.produkDanManfaat12'), true));
		}
		$scope.caraBayarFix = function (jenisAsuransi) {
			if (jenisAsuransi == "GUARDIAN" || jenisAsuransi == "PROIDAMAN" || jenisAsuransi == "UNITLINK") {
				$scope.data.caraBayar = "sekaligus";
				$scope.data.masaBayarPremi = 'X';
			}
		}
		$scope.pctTahun = function (jenisGuardian) {
			$scope.data.masaBayarPremi = 'X';
			$scope.data.jangkaWaktuAsuransi = jenisGuardian.substr(jenisGuardian.length - 1)
		}
		$scope.riderGroup = 0;
		$scope.getRiderGroup = function (produkid) {
			for (i = 1; i < $scope.jenisAsuransis.length; i++) {
				if (produkid == $scope.jenisAsuransis[i].id) {
					$scope.riderGroup = $scope.jenisAsuransis[i].gruprider;
				}
			}
			this.setRiderDisplay($scope.riderGroup);
			//console.log('a');
			return $scope.riderGroup;
		}
		$scope.setRiderDisplay = function (riderGroup) {
			if (riderGroup > 0) {
				$scope.isShowRider = true;
			} else {
				$scope.isShowRider = false;
			}
			switch (riderGroup) {
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
		$scope.doCheck = function () {
			var ck = (1 * $scope.data.unitPasarUang) + (1 * $scope.data.pendapatanTetap) + (1 * $scope.data.berimbang) + (1 * $scope.data.ekuitas);
			if (ck > 100) {
				alert("Tidak boleh lebih dari 100%");
				return false;
			} else {
				$scope.data.totalPersenUnitLink = ck;
			}
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
		$scope.validateThisFormOnPageAccept = function () {
			//validate datanya
			$scope.messages = [];
			try {
				if ($scope.data == null) {
					$scope.messages.push({
						"message": "Data ERROR. Null data."
					});
				}
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			try {
				if (!($scope.data.isTujuanLainnya || $scope.data.isTujuanProteksi || $scope.data.isTujuanTabungan || $scope.data.isTujuanPendidikan || $scope.data.isTujuanInvestasi || $scope.data.isTujuanPensiun)) {
					$scope.messages.push({
						'message': "Tujuan berasuransi harus diisi!"
					});
				}
				if ($scope.data.isTujuanLainnya) {
					tryMe = $scope.data.tujuanAsuransiLainnya;
					if ('' == tryMe) $scope.messages.push({
						'message': " Tujuan lainnya harus diisi!"
					});
				}
				if ($scope.data.paymentBankName == 'LAINNYA') {
					tryMe = $scope.data.paymentBankNameLainnya;
					if ('' == tryMe) $scope.messages.push({
						'message': "Nama Bank lainnya harus diisi!"
					});
				}
				if ('0' == $scope.data.jenisAsuransi) $scope.messages.push({
					'message': "Produk asuransi harus benar!"
				});
				/*                     if ('0' == $scope.data.caraBayar) $scope.messages.push({
					                        'message': "Cara bayar harus benar!"
					                    });
					                    if ('' == $scope.data.masaBayarPremi) $scope.messages.push({
					                        'message': "Masa bayar premi harus benar!"
					                    }); */
				//if( (!parseInt($scope.data.premi) < 10000 && $scope.data.isPremi)
				//	|| (!parseInt($scope.data.uangAsuransi) < 10000 && $scope.data.isPremi) )
				//	$scope.messages.push({'message':"Jumlah Premi atau Uang Asuransi (Rp.) harus benar!"}) ;			
				if ('' == $scope.data.jangkaWaktuAsuransi) $scope.messages.push({
					'message': "Jangka waktu Asuransi harus benar!"
				});
				//if('' == $scope.data.nomorRekening)$scope.messages.push({'message':"Nomor rekening harus benar!"}) ;			
				//if('' == $scope.data.namaRekening)$scope.messages.push({'message':"Atas Nama Rekening harus benar!"}) ;			
			} catch (e) {
				$scope.messages.push({
					'message': "Data ERROR. " + e
				});
			}
			if ($scope.messages.length > 0) {
				return $scope.messages;
			}
			return false;
		}
		$scope.moveToNextPage = function () {
			if ($scope.validateThisFormOnPageAccept()) {
				$scope.showAlert('Validasi', spajProvider.alertMessagebuilder($scope.messages));
				$scope.data.isPageProdukManfaat1Accepted = false;
				return false;
			} else {
				if ($scope.data.isPageProdukManfaat1Accepted) {
					if (confirm('Langsung menuju ke halaman form isian penerima manfaat?')) {
						$state.go('aplikasiSPAJOnline.produkDanManfaat22', {}, {
							reload: true,
							inherit: false
						});
					} else {
						return false;
					}
				}
			}
		}
		$scope.isPageAccepted = function () {
			if (!$scope.data.isPageProdukManfaat1Accepted) {
				$scope.showAlert('Apakah data sudah benar?', 'Pastikan Anda yakin data sudah benar untuk melanjutkan kehalaman berikutnya.');
				return false;
			}
		}
	}
])
////////////
////////////
.controller('produkDanManfaat22Ctrl', ['$state', '$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store', '$ionicPopup',
	function ($state, $scope, $stateParams, spajProvider, dataFactory, $store, $ionicPopup) {
		$scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
		$scope.dataPenerimaManfaat = spajProvider.getPenerimaManfaat(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.tambahPenerimaManfaat', false);
		$scope.data = {
			'spaj_guid': spajProvider.getSpajGUID(),
		}
		$scope.editPenerimaManfaat = function (dat) {
			$state.go('aplikasiSPAJOnline.editPenerimaManfaat', {
				indexPenerimaManfaat: dat
			}, {
				reload: true,
				inherit: false
			});
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
			if ($scope.dataPenerimaManfaat == null) {
				//'add from data tertanggung'
				$scope.dataTertanggung13 = $scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + 'aplikasiSPAJOnline.dataTertanggung13');
				$scope.dataTertanggung33 = $scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + 'aplikasiSPAJOnline.dataTertanggung33');
				if ($scope.dataTertanggung33 == null) {
					$scope.dataTertanggung33 = {
						'statusPernikahanTertanggung': ''
					}
				}
				$scope.newPenerimaManfaat = {
					'namaPenerimaManfaat': $scope.dataTertanggung13.namaLengkapTertanggung,
					'tglLahirPenerimaManfaat': new Date($scope.dataTertanggung13.tglLahirTertanggung),
					'tempatLahirPenerima': $scope.dataTertanggung13.tempatLahirTertanggung,
					'penerimaManfaatHubungan': '04',
					'statusPenerimaManfaat': $scope.dataTertanggung33.statusPernikahanTertanggung,
					'jenkelPenerimaManfaat': $scope.dataTertanggung13.jenkelTertanggung
				};
				spajProvider.addPenerimaManfaat(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.tambahPenerimaManfaat', $scope.newPenerimaManfaat);
				$scope.dataPenerimaManfaat = spajProvider.getPenerimaManfaat(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.tambahPenerimaManfaat', false);
			}
		});
		$scope.moveToNextPage = function () {
			if ($scope.data.isPagePenerimaManfaatAccepted) {
				if (confirm('Langsung menuju ke halaman form isian SKK?')) {
					$state.go('aplikasiSPAJOnline.sKKTertanggung', {}, {
						reload: true,
						inherit: false
					});
				} else {
					return false;
				}
			}
		}
	}
])
/////////////
/////////////
.controller('sKKTertanggungUtamaCtrl', ['$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store',
	function ($scope, $stateParams, spajProvider, dataFactory, $store) {
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		var $temp = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung13');
		$scope.jenkelTertanggungUtama = $temp.jenkelTertanggung;
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.sKKTertanggungUtama',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.sKKTertanggungUtama'), true));
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.sKKTertanggungUtama') == null) {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'skkIsPenyakitKeturunan': false,
				'skkJenisPenyakitKeturunan': '',
				'skkIsRawatinap': false,
				'skkIsMerokok': false,
				'skkRokokBatangSehari': '',
				'skkIsNarkoba': false,
				'skkIsAlkohol': false,
				'jenkelTertanggung': '',
				'skkWanitaIsPapSmear': false,
				'skkWanitaIsHaidTerganggu': false,
				'skkWanitaIsHamil': false,
				'skkWanitaIsCesar': false,
				'skkWanitaIsKeguguran': false,
				'skkWanitaSulitLahir': false,
				'isSkkUtamaOk': false
			}
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.sKKTertanggungUtama');
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
	}
])
/////////////
/////////////
.controller('sKKTertanggungTambahanCtrl', ['$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store',
	function ($scope, $stateParams, spajProvider, dataFactory, $store) {
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		var $temp = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung13');
		$scope.jenkelTertanggungUtama = $temp.jenkelTertanggung;
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.sKKTertanggungTambahan',
				'data': $scope.data
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.sKKTertanggungUtama'), true));
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.sKKTertanggungTambahan') == null) {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'skkIsPenyakitKeturunan': false,
				'skkJenisPenyakitKeturunan': '',
				'skkIsRawatinap': false,
				'skkIsMerokok': false,
				'skkRokokBatangSehari': '',
				'skkIsNarkoba': false,
				'skkIsAlkohol': false,
				'jenkelTertanggung': '',
				'skkWanitaIsPapSmear': false,
				'skkWanitaIsHaidTerganggu': false,
				'skkWanitaIsHamil': false,
				'skkWanitaIsCesar': false,
				'skkWanitaIsKeguguran': false,
				'skkWanitaSulitLahir': false,
				'isSkkUtamaOk': false
			}
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.sKKTertanggungTambahan');
		}
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				//console.log('Thank you for not eating my delicious ice cream cone');
			});
		};
	}
])
/////////////
////////////
.controller('lembarPersetujuanCtrl', ['$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store', '$state',
	function ($scope, $stateParams, spajProvider, dataFactory, $store, $state) {
		$scope.isProdukKeluarga = false;
		$scope.isProdukAkdp = false;
		$scope.isProdukOther = false;
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.produkDanManfaat12') == null) {
			alert('Mohon lengkapi halaman Produk dan Manfaat!');
			return false;
		} else {
			$scope.produkDanManfaat12 = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.produkDanManfaat12');
			//console.log($scope.produkDanManfaat12);
			if ($scope.produkDanManfaat12.jenisAsuransi == "JSPROTEKSIKELUARGA") {
				$scope.isProdukKeluarga = true;
			} else if ($scope.produkDanManfaat12.jenisAsuransi == "AKDP") {
				$scope.isProdukAkdp = true;
			} else {
				$scope.isProdukOther = true;
			}
		}
		$scope.scroll = true;
		$scope.spaj_guid = spajProvider.getSpajGUID();
		$scope.data = {
			'isMenyetujuiKetentuan': false,
			'isPageDokumentAccepted': false,
			'isMenyetujuiKetentuan': false,
			'sign1': '',
			'sign2': '',
			'sign1enc': false,
			'sign2enc': false
		}
		$scope.moveToNextPage = function () {
			/*                 if ($scope.data.sign1 == '' || $scope.data.sign1 == '') {
				                    //-- blocked due UAT
									//alert('Mohon tandatangani persetujuan ini sebelum melanjutkan!');
				                    //$scope.data.isMengertiKetentuan = false;
				                   // $scope.data.isMenyetujuiKetentuan = false;
				                   // return false;
				                } else { */
			if (!$scope.data.sign1enc || !$scope.data.sign2enc) {
				//alert('Silahkan menandatangani terlebih dahulu.');
				//return false; COTIGENCY 1 allow NULL TTD
				
			}
			if ($scope.data.isMenyetujuiKetentuan) {
				if ($scope.data.isMengertiKetentuan) {
					if (confirm('Langsung menuju ke halaman form halaman DOKUMEN SPAJ?')) {
						$state.go('aplikasiSPAJOnline.dokumenPendukungSPAJ', '', {
							reload: true,
							inherit: false
						});
					} else {
						$scope.data.isMenyetujuiKetentuan = false;
						return false;
					}
				} else {
					alert('Mohon untuk menggeser tombol Mengerti Ketentuan');
					return false;
				}
			}
			// }
		}
		if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.lembarPersetujuan') == null) {
			$scope.data = {
				'spaj_guid': $scope.spaj_guid,
				'isMengertiKetentuan': false,
				'isMenyetujuiKetentuan': false,
				'sign1': '',
				'sign2': '',
				'sign1enc': '',
				'sign2enc': ''
			};
		} else {
			$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.lembarPersetujuan');
			$scope.data.sign1enc = btoa(spajProvider.ioBase64.encode($scope.data.sign1));
			$scope.data.sign2enc = btoa(spajProvider.ioBase64.encode($scope.data.sign2));
		}
		$scope.saveDataSpaj = function () {
			$scope.data.sign1enc = btoa(spajProvider.ioBase64.encode($scope.data.sign1));
			$scope.data.sign2enc = btoa(spajProvider.ioBase64.encode($scope.data.sign2));
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.lembarPersetujuan',
				'data': $scope.data
			};
			//console.log($formdata);
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
	}
])
////////////
/////////////
.controller('tinjauUlangDanKirimDokumenCtrl', ['$scope', '$state', '$stateParams', 'spajProvider', 'dataFactory', '$store', '$http', '$ionicLoading', '$ionicPopup', '$location', '$window', '$document',
	function ($scope, $state, $stateParams, spajProvider, dataFactory, $store, $http, $ionicLoading, $ionicPopup, $location, $window, $document) {
		$scope.spaj_guid = spajProvider.getSpajGUID();
		$scope.idagen = getQueryParam('idagen');
		$scope.token = getQueryParam('token');
		$scope.android_ver = getQueryParam('android_ver');
		$scope.device = getQueryParam('device');
		$scope.tanggal_submit = Math.round(+new Date() / 1000);
		$scope.proposal_build_id = spajProvider.getBuildId();
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
		$scope.isValidDataDokumen = false;
		$scope.messages = [];
		//INIT FORM 
		$scope.$on('$ionicView.enter', function () {
			$scope.init_data();
			$scope.init_display();
		});
		$scope.init_display = function () {
			return true;
		};
		$scope.data_retrive = function () {
			$scope.messages = [];
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//TERTANGGUNG
			$scope.sumberDataTertanggung1 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataTertanggung13');
			if ($scope.sumberDataTertanggung1 == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data identitas tertanggung.'
				})
			} else {
				bol1 = true;
			}
			try {
				$scope.imageKtpTertanggung = atob(atob($scope.sumberDataTertanggung1.imageKTPTertanggung))
			} catch (e) {
				$scope.messages.push({
					'message': 'Invalid Image KTP Tertanggung ' + e
				});
			}
			$scope.sumberDataTertanggung2 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataTertanggung23');
			if ($scope.sumberDataTertanggung2 == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data tempat tinggal tertanggung.'
				})
			} else {
				bol2 = true;
			};
			$scope.sumberDataTertanggung3 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataTertanggung33');
			if ($scope.sumberDataTertanggung3 == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data pendukung tertanggung.'
				})
			} else {
				bol3 = true;
			};
			if (bol1 && bol2 && bol3) $scope.isValidDataTertanggung = true;
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//generate envelope data tertanggung
			try {
				$scope.data_diri_tertanggung = angular.extend($scope.sumberDataTertanggung1, $scope.sumberDataTertanggung2, $scope.sumberDataTertanggung3)
				delete $scope.data_diri_tertanggung.spaj_guid;
			} catch (e) {
				console.log('Error merging Data tertangung' + e);
			}
			//console.log($scope.data_diri_tertanggung);
			//PEMPOL
			$scope.sumberDataPempol1 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataPemegangPolis13');
			if ($scope.sumberDataPempol1 == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data identitas pemegang polis.'
				});
			} else {
				bol1 = true;
			}
			try {
				$scope.imageKTPpempol = atob(atob($scope.sumberDataPempol1.imageKTPpempol))
			} catch (e) {
				$scope.messages.push({
					'message': 'Invalid Image KTP Pempo ' + e
				});
			}
			$scope.sumberDataPempol2 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataPemegangPolis23');
			if ($scope.sumberDataPempol2 == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data tempat tinggal pemegang polis.'
				})
			} else {
				bol2 = true;
			};
			$scope.sumberDataPempol3 = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.dataPemegangPolis33');
			if ($scope.sumberDataPempol3 == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data pendukung pemegang polis.'
				});
			} else {
				bol3 = true;
			}
			if (bol1 && bol2 && bol3) $scope.isValidDataPempol = true;
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//generate envelope data pempol
			try {
				$scope.data_diri_pemegang_polis = angular.extend($scope.sumberDataPempol1, $scope.sumberDataPempol2, $scope.sumberDataPempol3)
				delete $scope.data_diri_pemegang_polis.spaj_guid;
			} catch (e) {
				console.log('Error merging Data Pemegang Polis' + e);
			}
			//console.log($scope.data_diri_pemegang_polis);
			//PEKERJAAN
			$scope.pekerjaanTertanggung = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.pekerjaanTertanggung');
			if ($scope.pekerjaanTertanggung == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi data pekerjaan Tertanggung.'
				});
			} else {
				bol1 = true;
			}
			$scope.isValidDataPekerjaanTertanggung = bol1;
			$scope.pekerjaanPemegangPolis = $store.get('SPAJ::' + $scope.spaj_guid + '::aplikasiSPAJOnline.pekerjaanPemegangPolis');
			if ($scope.pekerjaanPemegangPolis == null) {
				if (!$scope.sumberDataPempol1.isTertanggungPempol) {
					$scope.messages.push({
						'message': 'Silakan lengkapi data pekerjaan pemegang polis.'
					});
				} else {
					bol2 = true;
					$scope.pekerjaanPemegangPolis = {
						'isTertanggungPempol': true
					};
				}
			} else {
				bol2 = true;
			}
			$scope.isValidDataPekerjaanPempol = bol2;
			//generate envelope PEKERJAAN
			try {
				$scope.data_pekerjaan_tertanggung = angular.extend($scope.pekerjaanTertanggung)
				$scope.data_pekerjaan_pempol = angular.extend($scope.pekerjaanPemegangPolis)
				delete $scope.data_pekerjaan_tertanggung.spaj_guid;
				delete $scope.data_pekerjaan_pempol.spaj_guid;
			} catch (e) {
				console.log('Error merging Data Pemegang Polis' + e);
			}
			//console.log($scope.data_pekerjaan_tertanggung);
			//console.log($scope.data_pekerjaan_pempol);
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//SKK
			$scope.data_skk_utama = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.sKKTertanggung');
			//console.log($scope.data_skk_utama);
			if ($scope.data_skk_utama == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi SKK tertanggung utama'
				});
			} else {
				bol1 = true;
			}
			$scope.isValidDataSKKTU = bol1;
			$scope.isValidDataSKKTT = bol1;
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//DOKUMEN N PRODUK
			$scope.data_dokumen = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dokumenPendukungSPAJ::dokumen_spaj');
			if ($scope.data_dokumen == null) {
				$scope.messages.push({
					'message': 'Tidak Ada dokumen lampiran.'
				});
			} else {
				bol1 = true;
			}
			$scope.data_produk = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.produkDanManfaat12');
			// console.log($scope.data_produk);
			if ($scope.data_produk == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi form produk.'
				});
			} else {
				bol1 = true;
			}
			$scope.isValidDataProdukManfaat = true;
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//PENERIMA MANFAAT
			$scope.data_penerima_manfaat = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.tambahPenerimaManfaat::penerima_manfaat');
			if ($scope.data_penerima_manfaat == null) $scope.messages.push({
				'message': 'Silakan lengkapi penerima manfaat.'
			});
			//DOKUMEN
			$scope.data_persetujuan = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.lembarPersetujuan');
			if ($scope.data_persetujuan == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi dokumen.'
				});
			} else {
				bol1 = true;
			}
			$scope.isValidDataDokumen = bol1;
			//PERSETUJUAN x
			$scope.data_persetujuan = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.lembarPersetujuan');
			if ($scope.data_persetujuan == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi tanda tanggan.'
				});
			} else {
				bol1 = true;
			}
			$scope.isValidDataPersetujuan = bol1;
			try {
				$scope.sign1image = $scope.data_persetujuan.sign1;
				$scope.sign2image = $scope.data_persetujuan.sign2;
			} catch (e) {
				$scope.messages.push({
					'message': 'Invalid Image Sign ' + e
				});
			}
			bol1 = false;
			bol2 = false;
			bol3 = false;
			//SKK TERTANGGUNGNYA
			$scope.skk_tertanggung = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.sKKTertanggung');
			if ($scope.skk_tertanggung == null) {
				$scope.messages.push({
					'message': 'Silakan lengkapi form SKK.'
				});
			} else {
				bol1 = true;
			}
		}
		$scope.init_data = function () {
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
		}
		$scope.moveToPersetujuan = function () {
			$state.go('aplikasiSPAJOnline.lembarPersetujuan', '', {
				reload: true,
				inherit: false
			});
		}
		$scope.moveToTertanggung = function () {
			$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1', '', {
				reload: true,
				inherit: false
			});
		}
		$scope.moveToTertanggungTambahan = function () {
			$state.go('aplikasiSPAJOnline.dataTertanggung33_tab1', '', {
				reload: true,
				inherit: false
			});
		}
		$scope.moveToSKK = function () {
			$state.go('aplikasiSPAJOnline.sKKTertanggung', {}, {
				reload: true,
				inherit: false
			});
		}
		$scope.moveToProduk = function () {
			$state.go('aplikasiSPAJOnline.produkDanManfaat12', '', {
				reload: true,
				inherit: false
			});
		}
		$scope.moveToPemegangPolis = function () {
			$state.go('aplikasiSPAJOnline.dataPemegangPolis13', '', {
				reload: true,
				inherit: false
			});
		}
		$scope.finalFormValidation = function () {
			//validate datanya
			return false;
		}
		$http2 = $http;
		$scope.envelope = null;
		$scope.submitToServer = function () {
			if (confirm('APAKAH ANDA INGIN MENGIRIM SPAJ INI?\n\nPastikan SPAJ telah diisi dengan benar dan ditandatangani Calon Nasabah.\n\nData yang telah terkirim tidak dapat di-edit kembali!')) {
				//bungkuss!!!
				$scope.envelope = {
					'id_agen': $scope.idagen,
					'spaj_guid': $scope.spaj_guid,
					'android_ver': $scope.android_ver,
					'device': $scope.device,
					'tanggal_submit': $scope.tanggal_submit,
					'proposal_build_id': $scope.proposal_build_id,
					'data_diri_tertanggung': $scope.data_diri_tertanggung,
					'data_diri_pemegang_polis': $scope.data_diri_pemegang_polis,
					'data_pekerjaan_pempol': $scope.data_pekerjaan_pempol,
					'data_pekerjaan_tertanggung': $scope.data_pekerjaan_tertanggung,
					'data_skk': $scope.skk_tertanggung,
					'data_penerima_manfaat': $scope.data_penerima_manfaat,
					'data_dokumen': $scope.data_dokumen,
					'data_produk': $scope.data_produk,
					'data_persetujuan': $scope.data_persetujuan,
				}
				if ($scope.messages.length == 0) {
					msisdn = $scope.data_diri_pemegang_polis.nomorHpPempol;
					//request OTP
					//$scope.genOtp(msisdn);
					
					// COTIGENCY PLAN 1 disable OTP direct submit
					//$scope.genOtp(msisdn);
					var link = 'https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/submitter.php?act=save_spaj' + '&idagen=' + $scope.idagen + '&token=' + $scope.token;
						$scope.hideSpinner();
						$scope.showSpinner("Mengirim SPAJ Online...");
						$http.post(link, "spaj_guid=" + $scope.spaj_guid + "&data=" + angular.toJson($scope.envelope), {
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
							}
						}).then(function (rets) {
							$scope.hideSpinner();
							console.log(rets.data);
							$scope.showAlert('Status Pengiriman SPAJ', rets.data.message, true)
						});

					//
				} else {
					alert('SPAJ tak dapat dikirim!\n\nPeriksa kembali checklist kelengkapan SPAJ!');
					return false;
				}
			}
		}
		$scope.response = '';
		$scope.genOtp = function (msisdn) {
			var otpLink = "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=gen_OTP&idagen=" + $scope.idagen + "&guid=" + $scope.spaj_guid + "&token=" + $scope.token + "&msisdn=" + msisdn;
			$scope.showSpinner('Mendapatkan OTP...');
			$http.post(otpLink, "spaj_guid=" + $scope.spaj_guid, {
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
				}
			}).then(function (res) {
				if (res.data.status) {
					do {
						otpnya = prompt(res.data.message + "\n\nSilahkan mengisi OTP yang berada dalam Inbox SMS HP terdaftar (6 Digit angka)", "");
						optValidation = "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=validate_OTP" + "&otp=" + otpnya + "&idagen=" + $scope.idagen + "&guid=" + $scope.spaj_guid + "&token=" + $scope.token;
						retSucc = false;
						$http.post(optValidation, "spaj_guid=" + $scope.spaj_guid, {
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
							}
						}).then(function (ret) {
							if (ret.data.status) {
								console.log(ret.data.status);
								retSucc = ret.data.status;
								do {
									otpnya = prompt(res.data.message + "\n\nSilahkan mengisi OTP yang berada dalam InboxSMS HP PEMEGANG POLIS terdaftar (6 Digit angka)", "");
									optValidation = "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=validate_OTP" + "&otp=" + otpnya + "&idagen=" + $scope.idagen + "&guid=" + $scope.spaj_guid + "&token=" + $scope.token;
									retSucc = false;
									$http.post(optValidation, "spaj_guid=" + $scope.spaj_guid, {
										headers: {
											'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
										}
									}).then(function (ret) {
										if (ret.data.status) {
											console.log(ret.data.status);
											//$scope.submit($scope.envelope);
											var link = 'https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/submitter.php?act=save_spaj' + '&idagen=' + $scope.idagen + '&token=' + $scope.token;
											$scope.hideSpinner();
											$scope.showSpinner("Mengirim SPAJ Online...");
											$http.post(link, "spaj_guid=" + $scope.spaj_guid + "&data=" + angular.toJson($scope.envelope), {
												headers: {
													'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
												}
											}).then(function (rets) {
												$scope.hideSpinner();
												console.log(rets.data);
												$scope.showAlert('Status Pengiriman SPAJ', rets.data.message, true)
											});
										} else {
											alert('Gagal OTP\n\nSilahkan tekan tombol F5 lalu silahkan coba melalui \nfitur edit eSPAJ yang belum terkirim.');
										}
									});
								} while (otpnya == "" || otpnya.length != 6);
							} else {
								do {
									otpnya = prompt(res.data.message + "\n\nSilahkan mengisi OTP yang berada dalam Inbox SMS HP PEMEGANG POLIS (6 Digit angka)", "");
									optValidation = "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=validate_OTP" + "&otp=" + otpnya + "&idagen=" + $scope.idagen + "&guid=" + $scope.spaj_guid + "&token=" + $scope.token;
									retSucc = false;
									$http.post(optValidation, "spaj_guid=" + $scope.spaj_guid, {
										headers: {
											'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
										}
									}).then(function (ret) {
										if (ret.data.status) {
											console.log(ret.data.status);
											//$scope.submit($scope.envelope);
											var link = 'https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/submitter.php?act=save_spaj' + '&idagen=' + $scope.idagen + '&token=' + $scope.token;
											$scope.hideSpinner();
											$scope.showSpinner("Mengirim SPAJ Online...");
											$http.post(link, "spaj_guid=" + $scope.spaj_guid + "&data=" + angular.toJson($scope.envelope), {
												headers: {
													'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
												}
											}).then(function (rets) {
												$scope.hideSpinner();
												console.log(rets.data);
												$scope.showAlert('Status Pengiriman SPAJ', rets.data.message, true)
											});
										} else {
											alert('Gagal OTP\n\nSilahkan tekan tombol F5 lalu silahkan coba melalui \nfitur edit eSPAJ yang belum terkirim.');
										}
									});
								} while (otpnya == "" || otpnya.length != 6);
							}
						});
					} while (otpnya == "" || otpnya.length != 6);
				}
			});
		}
		$scope.askOtp = function () {
			otpnya = "";
			do {
				otpnya = prompt(res.data.message + "\n\nSilahkan mengisi OTP yang berada dalam Inbox SMS HP terdaftar (6 Digit angka)", "");
			} while (otpnya == "" || otpnya.length != 6);
			return otpnya;
		}
		$scope.validateOtp = function (otpnya) {
			alert(otpnya);
		}
		$scope.submit = function (param) {};
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		$scope.showSpinner = function (msg) {
			$ionicLoading.show({
				template: msg
			})
		};
		$scope.hideSpinner = function () {
			$ionicLoading.hide()
		};
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {
				angular.element(document.querySelectorAll('#homeButton')).triggerHandler('click');
				spajProvider.delUnsavedSpajGuid($scope.spaj_guid);
			});
		};
	}
])
///////////
.controller('dokumenPendukungSPAJCtrl', ['$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store', '$ionicPopup', '$state',
	function ($scope, $stateParams, spajProvider, dataFactory, $store, $ionicPopup, $state) {
		$scope.daftarDokumen = false;
		$scope.daftarDokumens = [];
		$scope.data = {
			'isPageDocumentAccepted': false
		}
		$scope.moveToNextPage = function () {
			//console.log();
			if ($scope.data.isPageDocumentAccepted && ($scope.daftarDokumen != null) && $scope.daftarDokumen.length > 0) {
				if (confirm('Langsung menuju ke halaman form halaman SUBMIT ?')) {
					//angular.element(document.querySelectorAll('#dataTertanggung13-button2')).triggerHandler('click');
					$state.go('aplikasiSPAJOnline.tinjauUlangDanKirimDokumen', '', {
						reload: true,
						inherit: false
					});
				} else {
					$scope.data.isPageDocumentAccepted = false;
					return false;
				}
			} else {
				alert('Dokumen harus diisi');
			}
		}
		$scope.daftarDokumen = spajProvider.getDokumen(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.dokumenPendukungSPAJ', false);
		if ((typeof $scope.daftarDokumen == 'object') && ($scope.daftarDokumen != null)) {
			for (i = 0; i < $scope.daftarDokumen.length; i++) {
				$scope.daftarDokumens.push({
					'addKeteranganDokumen': $scope.daftarDokumen[i].addKeteranganDokumen,
					'addNamaDokumen': $scope.daftarDokumen[i].addNamaDokumen,
					'camDokumen': spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.daftarDokumen[i].camDokumen)),
					'selectTipeDokumen': $scope.daftarDokumen[i].selectTipeDokumen,
					'isPageDocumentAccepted': $scope.daftarDokumen[i].isPageDocumentAccepted
				})
			}
		}
		$scope.editDokumen = function (dat) {
			$state.go('aplikasiSPAJOnline.tambahkanDokumenPenunjangSPAJ', {
				indexDokumen: dat
			}, {
				reload: true,
				inherit: false
			});
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
	}
])
//etag: dokumen spaj
.controller('tambahkanDokumenPenunjangSPAJCtrl', ['$scope', '$stateParams', '$ionicPopup', 'dataFactory', 'spajProvider', '$store', '$state',
	function ($scope, $stateParams, $ionicPopup, dataFactory, spajProvider, $store, $state) {
		$scope.tipeDokumen = dataFactory.getTipeDokumens();
		$scope.indexDokumen = $state.params.indexDokumen;
		$scope.ngShow = true;
		if (typeof parseInt($scope.indexDokumen) && parseInt($scope.indexDokumen) > -1) {
			$scope.dataDokumen = spajProvider.getDokumen(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.dokumenPendukungSPAJ', $scope.indexDokumen);
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'addNamaDokumen': $scope.dataDokumen.addNamaDokumen,
				'addKeteranganDokumen': $scope.dataDokumen.addKeteranganDokumen,
				'selectTipeDokumen': $scope.dataDokumen.selectTipeDokumen,
				'camDokumen': spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.dataDokumen.camDokumen))
			}
			spajProvider.putImageTo('canvasDokumen', spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.dataDokumen.camDokumen)));
		} else {
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'addNamaDokumen': '',
				'addKeteranganDokumen': '',
				'selectTipeDokumen': $scope.tipeDokumen[0].id_sae,
				'camDokumen': ''
			}
			console.log('loaded 2');
			//spajProvider.putImageTo('canvasDokumen',spajProvider.ioBase64.decode(spajProvider.ioBase64.decode($scope.dataDokumen.camDokumen)));
		}
		$scope.delDokumen = function (indexDokumen) {
			if (confirm("yakin akan hapus dokumen ini>")) {
				spajProvider.delDokumen($scope.data.spaj_guid, 'aplikasiSPAJOnline.dokumenPendukungSPAJ', indexDokumen)
				$state.go('aplikasiSPAJOnline.dokumenPendukungSPAJ', {}, {
					reload: true,
					inherit: false,
					cache: false
				});
			} else {
				return false;
			}
		}
		$scope.saveDokumen = function () {
			if ($scope.data.addNamaDokumen == '') {
				alert('Nama Dokumen harus Diisi!');
				return false;
			} else {
				if (typeof parseInt($scope.indexDokumen) && parseInt($scope.indexDokumen) > -1) {
					this.updateDokumen($scope.indexDokumen);
				} else {
					this.saveDataSpaj();
				}
				$state.go('aplikasiSPAJOnline.dokumenPendukungSPAJ', {}, {
					reload: true,
					inherit: false,
					cache: false
				});
			}
		}
		$scope.saveDataSpaj = function () {
			$scope.data.camDokumen = spajProvider.getImageBase64('canvasDokumen', 'jpg');
			$scope.newDokumen = {
				'addNamaDokumen': $scope.data.addNamaDokumen,
				'addKeteranganDokumen': $scope.data.addKeteranganDokumen,
				'selectTipeDokumen': $scope.data.selectTipeDokumen,
				'camDokumen': $scope.data.camDokumen
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			spajProvider.addDokumen($scope.data.spaj_guid, 'aplikasiSPAJOnline.dokumenPendukungSPAJ', $scope.newDokumen);
		}
		$scope.updateDokumen = function (indexDokumen) {
			$scope.data.camDokumen = spajProvider.getImageBase64('canvasDokumen', 'jpg');
			$scope.saveChanges = {
				'addNamaDokumen': $scope.data.addNamaDokumen,
				'addKeteranganDokumen': $scope.data.addKeteranganDokumen,
				'selectTipeDokumen': $scope.data.selectTipeDokumen,
				'camDokumen': $scope.data.camDokumen
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			spajProvider.updateDokumen($scope.data.spaj_guid, 'aplikasiSPAJOnline.dokumenPendukungSPAJ', indexDokumen, $scope.saveChanges);
		}
		$scope.changeImage = function () {
			document.getElementById('tempImgDokumen').style.display = 'none';
			spajProvider.takePict(this, 'canvasDokumen');
			$scope.data.camDokumen = spajProvider.getImageBase64('canvasDokumen', 'jpg');
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
	}
]).controller('tambahPenerimaManfaatCtrl', ['$state', '$scope', '$stateParams', 'dataFactory', 'spajProvider', '$store', '$ionicPopup',
	function ($state, $scope, $stateParams, dataFactory, spajProvider, $store, $ionicPopup) {
		$scope.statuss = dataFactory.getStatusNikahs();
		$scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
		$scope.genders = dataFactory.getGenders();
		$scope.saveDataSpaj = function () {
			$scope.newPenerimaManfaat = {
				'namaPenerimaManfaat': $scope.data.namaPenerimaManfaat,
				'tglLahirPenerimaManfaat': $scope.data.tglLahirPenerimaManfaat,
				'tempatLahirPenerima': $scope.data.tempatLahirPenerima,
				'penerimaManfaatHubungan': $scope.data.penerimaManfaatHubungan,
				'statusPenerimaManfaat': $scope.data.statusPenerimaManfaat,
				'jenkelPenerimaManfaat': $scope.data.jenkelPenerimaManfaat
			};
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			spajProvider.addPenerimaManfaat($scope.data.spaj_guid, 'aplikasiSPAJOnline.tambahPenerimaManfaat', $scope.newPenerimaManfaat);
			/*
		
        $store.set('SPAJ::'+$scope.data.spaj_guid+'::'+$formdata.pageId,$scope.data); 
        spajProvider.setSpajElement($formdata);*/
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.tambahPenerimaManfaat'), true));
		}
		$scope.data = {
			'spaj_guid': spajProvider.getSpajGUID(),
			'penerimaManfaatHubungan': $scope.hubunganKeluargas[0].id,
			'statusPenerimaManfaat': $scope.statuss[0].id,
			'jenkelPenerimaManfaat': $scope.genders[0].id,
			'namaPenerimaManfaat': '',
			'tglLahirPenerimaManfaat': '',
			'tempatLahirPenerima': '',
		}
		$scope.savePenerimaManfaat = function () {
			if ($scope.data.namaPenerimaManfaat == '' || $scope.data.tglLahirPenerimaManfaat == '') {
				$scope.showAlert('Perhatian', 'Nama dan Tanggal lahir harus diisi.', true);
				return false;
			} else {
				this.saveDataSpaj();
				$state.go('aplikasiSPAJOnline.produkDanManfaat22', {}, {
					reload: true,
					inherit: false,
					cache: false
				});
			}
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		$scope.showAlert = function (title, message) {
			var alertPopup = $ionicPopup.alert({
				title: title,
				template: message
			});
			alertPopup.then(function (res) {});
		};
	}
]).controller('editPenerimaManfaatCtrl', ['$state', '$scope', '$stateParams', 'spajProvider', 'dataFactory', '$store', '$filter',
	function ($state, $scope, $stateParams, spajProvider, dataFactory, $store, $filter) {
		$scope.indexPenerimaManfaat = $state.params.indexPenerimaManfaat;
		//console.log(indexPenerimaManfaat);
		$scope.statuss = dataFactory.getStatusNikahs();
		$scope.hubunganKeluargas = dataFactory.getHubunganKeluargas();
		$scope.genders = dataFactory.getGenders();
		$scope.dataPenerimaManfaat = spajProvider.getPenerimaManfaat(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.tambahPenerimaManfaat', $scope.indexPenerimaManfaat);
		$scope.dataPenerimaManfaat.tglLahirPenerimaManfaat = new Date($scope.dataPenerimaManfaat.tglLahirPenerimaManfaat);
		$scope.data = {
			'spaj_guid': spajProvider.getSpajGUID(),
			'penerimaManfaatHubungan': $scope.dataPenerimaManfaat.penerimaManfaatHubungan,
			'statusPenerimaManfaat': $scope.dataPenerimaManfaat.statusPenerimaManfaat,
			'jenkelPenerimaManfaat': $scope.dataPenerimaManfaat.jenkelPenerimaManfaat,
			'namaPenerimaManfaat': $scope.dataPenerimaManfaat.namaPenerimaManfaat,
			'tglLahirPenerimaManfaat': $scope.dataPenerimaManfaat.tglLahirPenerimaManfaat,
			'tempatLahirPenerima': $scope.dataPenerimaManfaat.tempatLahirPenerima,
		}
		$scope.savePenerimaManfaat = function () {
			$scope.newPenerimaManfaat = {
				'namaPenerimaManfaat': $scope.data.namaPenerimaManfaat,
				'tglLahirPenerimaManfaat': $scope.data.tglLahirPenerimaManfaat,
				'tempatLahirPenerima': $scope.data.tempatLahirPenerima,
				'penerimaManfaatHubungan': $scope.data.penerimaManfaatHubungan,
				'statusPenerimaManfaat': $scope.data.statusPenerimaManfaat,
				'jenkelPenerimaManfaat': $scope.data.jenkelPenerimaManfaat
			};
			if (confirm('yakin akan mengupdate?')) {
				spajProvider.updatePenerimaManfaat(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.tambahPenerimaManfaat', $scope.indexPenerimaManfaat, $scope.newPenerimaManfaat);
				$state.go('aplikasiSPAJOnline.produkDanManfaat22', {}, {
					reload: true,
					inherit: false,
					cache: false
				});
			};
		}
		$scope.delPenerimaManfaat = function () {
			if (confirm('yakin akan menghapus?')) {
				spajProvider.removePenerimaManfaat(spajProvider.getSpajGUID(), 'aplikasiSPAJOnline.tambahPenerimaManfaat', $scope.indexPenerimaManfaat)
				$state.go('aplikasiSPAJOnline.produkDanManfaat22', {}, {
					reload: true,
					inherit: false,
					cache: false
				});
			};
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
	}
]).controller('sPAJOnlineJiwasrayaCtrl', ['$scope', '$state', 'spajProvider', '$stateParams', '$http',
	function ($scope, $state, spajProvider, $stateParams, $http) {
		//ui-sref="aplikasiSPAJOnline.dataTertanggung13_tab1({new: true,spaj_guid:null})"
		$scope.idagen = getQueryParam('idagen');
		$scope.token = getQueryParam('token');
		$scope.android_ver = getQueryParam('android_ver');
		$scope.device = getQueryParam('device');
		$scope.newBuildId = function () {
			$http({
				method: "GET",
				url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=get_build_id&idagen=" + $scope.idagen + "&token=" + $scope.token
			}).then(function mySucces(response) {
				spajProvider.setBuildId(null);
				spajProvider.setBuildId(response.data[0].BUILD_ID);
			})
		}
		$scope.newSpaj = function (spaj_guid) {
			spajProvider.setSpajGUID('new');
			$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1', {
				spaj_guid: 'new'
			}, {
				reload: true,
				inherit: false
			});
		}
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
	}
]).controller('viewPrintSPAJCtrl', ['$scope', '$state', 'spajProvider', '$stateParams', '$http', '$ionicLoading', '$ionicModal',
	function ($scope, $state, spajProvider, $stateParams, $http, $ionicLoading, $ionicModal) {
		$scope.idagen = getQueryParam('idagen');
		$scope.token = getQueryParam('token');
		$scope.android_ver = getQueryParam('android_ver');
		$scope.device = getQueryParam('device');
		$scope.$on('$ionicView.beforeEnter', function (event, viewData) {
			viewData.enableBack = true;
		});
		$scope.spaj_guid = null;
		//TABEL_SPAJ_ONLINE
		$http({
			method: "GET",
			url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/retriever.php?act=get_unprocessed&idagen=" + $scope.idagen + "&token=" + $scope.token
		}).then(function mySucces(response) {
			$tdata = [];
			if (response.data == null) {} else {
				for (i = 0; i < response.data.length; i++) {
					$tdata.push({
						'nama_pemegang_polis': response.data[i].nama_pemegang_polis,
						'nama_produk': response.data[i].nama_produk,
						'nama_tertanggung': response.data[i].nama_tertanggung,
						'premi': response.data[i].premi,
						'spaj_guid': response.data[i].spaj_guid,
						'tanggal_submit': spajProvider.convertDateFromUnixStamp(response.data[i].tanggal_submit)
					})
				}
			}
			$scope.dataUnprocessed = $tdata;
			$ionicLoading.hide();
		}, function myError(response) {
			$scope.dataUnprocessed = response.message;
			//
		}).withCredentials = true;;
		$tpl = null;
		$scope.modal = null;
		$scope.openModal = function ($spaj_guid) {
			$scope.spaj_guid = $spaj_guid;
			$urls = 'https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/view_detil_spaj.php?' + 'spaj_guid=' + $scope.spaj_guid + '&idagen=' + $scope.idagen + '&token=' + $scope.token + '&android_ver=23' + '&device=asus__ASUS_Z00A&app_version=1.0.641&act=view_detil_processed';
			$tpl = '<ion-modal-view style="top:0px;left:0px;position:absolute;width: 100%; height: 100%;">' + ' <ion-header-bar class="bar bar-header bar-positive"> ' + '<h1 class="title">View Data SPAJ ' + $scope.spaj_guid + '</h1> ' + '<button class="button button-clear button-primary" ' + 'ng-click="closeModal()">Close</button> </ion-header-bar> ' + '<ion-content class="padding"> <div class="list"> ' + '<button class="button button-full button-positive" id="maButton" ng-click="runReport(\'' + $scope.spaj_guid + '\')">Create</button>' + ' </div>' + '  <iframe id="pdfImage"  style="height:600px;width:100%;border:navy solid thin;" src="' + $urls + '"></iframe>  ' + '</ion-content> </ion-modal-view>';
			$scope.modal = $ionicModal.fromTemplate($tpl, {
				scope: $scope,
				animation: 'slide-in-up',
				focusFirstInput: true
			});
			$scope.modal.show($spaj_guid);
		};
		$scope.closeModal = function () {
			$scope.modal.hide();
		};
		//Cleanup the modal when we're done with it!
		$scope.$on('$destroy', function () {
			$scope.modal.remove();
		});
		// Execute action on hide modal
		$scope.$on('modal.hidden', function () {
			// Execute action
		});
		// Execute action on remove modal
		$scope.$on('modal.removed', function () {
			// Execute action
		});
		$scope.createContact = function (u) {
			$scope.contacts.push({
				name: u.firstName + ' ' + u.lastName
			});
			$scope.modal.hide();
		};
		//Function PDF
		$scope.runReport = _runReport;
		$scope.clearReport = _clearReport;
		_activate();

		function _activate() {
			//
			// ReportSvc Event Listeners: Progress/Done
			//    used to listen for async progress updates so loading text can change in 
			//    UI to be repsonsive because the report process can be 'lengthy' on 
			//    older devices (chk reportSvc for emitting events)
			//
			$scope.$on('ReportSvc::Progress', function (event, msg) {
				_showLoading(msg);
			});
			$scope.$on('ReportSvc::Done', function (event, err) {
				_hideLoading();
			});
		}

		function _runReport() {
			//if no cordova, then running in browser and need to use dataURL and iframe
			ReportSvc.runReportDataURL({}, {}).then(function (dataURL) {
				//set the iframe source to the dataURL created
				console.log('report run in browser using dataURL and iframe');
				document.getElementById('pdfImage').src = dataURL;
			});
			return true;
		}
		//reset the iframe to show the empty html page from app start
		function _clearReport() {
			document.getElementById('pdfImage').src = "empty.html";
		}

		function _showLoading(msg) {
			$ionicLoading.show({
				template: msg
			});
		}

		function _hideLoading() {
			$ionicLoading.hide();
		}
		//function PDF
		//function PDF
		//function PDF
		//function PDF
	}
]).controller('suratKeteranganKesehatanCtrl', ['$scope', '$stateParams',
	function ($scope, $stateParams) {}
]).controller('sKKTertanggungCtrl', ['$state', '$scope', '$stateParams', '$store', 'spajProvider', 'dataFactory',
	function ($state, $scope, $stateParams, $store, spajProvider, dataFactory) {
		$scope.hobbys = dataFactory.getHobbys();
		$scope.pageId = 'aplikasiSPAJOnline.sKKTertanggung';
		$scope.$on('$ionicView.beforeEnter', function () {
			$scope.init_data();
			$scope.init_display();
		});
		/** WARNING!!! Quirks mode HERE **/
		/** WARNING!!! Quirks mode HERE **/
		/** WARNING!!! Quirks mode HERE **/
		$scope.init_display = function () {
			if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.produkDanManfaat12') == null) {
				$scope.isProdukJsProteksiKeluarga = false;
				$scope.jenisProduk = false;
				$scope.jenisJsProteksiKeluarga = '';
				$scope.namaTertanggungUtama = '';
				$scope.namaTertanggungTambahan1 = '';
			} else {
				$scope.isProdukJsProteksiKeluarga = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.produkDanManfaat12').jenisAsuransi;
				$scope.jenisJsProteksiKeluarga = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.produkDanManfaat12').jenisJsProteksiKeluarga;
				$scope.jenisProduk = $scope.isProdukJsProteksiKeluarga;
				$scope.namaTertanggungUtama = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung13').namaLengkapTertanggung;
				$scope.namaTertanggungTambahan1 = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung33').namaTertanggungTambahan1;
				$scope.isProdukJsProteksiKeluarga = ('JSPROTEKSIKELUARGA' == $scope.isProdukJsProteksiKeluarga);
				//console.log($scope.jenisJsProteksiKeluarga)
				switch ($scope.jenisJsProteksiKeluarga) {
				case 'K0':
					$scope.data.isAdaTTU = true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = false;
					$scope.data.isAdaTT3 = false;
					$scope.data.isAdaTT4 = false;
					break;
				case 'K1':
					$scope.data.isAdaTTU = true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = true;
					$scope.data.isAdaTT3 = false;
					$scope.data.isAdaTT4 = false;
					break;
				case 'K2':
					$scope.data.isAdaTTU = true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = true;
					$scope.data.isAdaTT3 = true;
					$scope.data.isAdaTT4 = false;
					break;
				case 'K3':
					$scope.data.isAdaTTU = true;
					$scope.data.isAdaTT1 = true;
					$scope.data.isAdaTT2 = true;
					$scope.data.isAdaTT3 = true;
					$scope.data.isAdaTT4 = true;
					break;
				case 'B0':
					$scope.data.isAdaTTU = true;
					$scope.data.isAdaTT1 = false;
					$scope.data.isAdaTT2 = false;
					$scope.data.isAdaTT3 = false;
					$scope.data.isAdaTT4 = false;
					break;
				}
			}
			$scope.data_tertanggung3 = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung33');
			$scope.data_tertanggung1 = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::aplikasiSPAJOnline.dataTertanggung13');
			if ($scope.data_tertanggung3 != null || $scope.data_tertanggung1 != null) {
				if ($scope.data_tertanggung3.isAdaTertanggungTambahan1) $scope.isTertanggungTambahan = true;
				if ($scope.data_tertanggung3.jenisKelaminTertanggungTambahan1 == 'P' && $scope.data_tertanggung3.isAdaTertanggungTambahan1) $scope.isTT1Wanita = true;
				if ($scope.data_tertanggung1.jenkelTertanggung == 'P' && $scope.data_tertanggung1.namaLengkapTertanggung != '') $scope.isTTUWanita = true;
				if ($scope.data_tertanggung1.namaLengkapTertanggung != '' || $scope.data_tertanggung1.agamaTertanggung != '0') $scope.isHanya1tertanggung = true;;
				if ($scope.data_tertanggung1.namaLengkapTertanggung != '' || $scope.data_tertanggung1.agamaTertanggung != '0') $scope.isHanya1tertanggung = true;;
			} else {
				alert('Mohon lengkapi data Tertanggung atau Tertanggung tambahan!');
				$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1', {
					'spaj_guid': spaj_guid
				}, {
					reload: true,
					inherit: false
				});
				return false;
			}
		}
		$scope.saveDataSpaj = function () {
			var $formdata = {
				'pageId': 'aplikasiSPAJOnline.sKKTertanggung',
				'data': $scope.data
			};
			//		console.log($formdata);
			spajProvider.setSpajGUID($scope.data.spaj_guid);
			$scope.data.tglMeninggalAyah_TTU = new Date($scope.data.tglMeninggalAyah_TTU);
			$store.set('SPAJ::' + $scope.data.spaj_guid + '::' + $formdata.pageId, $scope.data);
			spajProvider.setSpajElement($formdata);
			//$scope.showAlert('Test Display',angular.toJson(spajProvider.getSpajElement('aplikasiSPAJOnline.dataTertanggung23'), true));
		}
		$scope.init_data = function () {
			$scope.isHanya1tertanggung = false;
			$scope.isTertanggungTambahan = false;
			$scope.isTTUWanita = false;
			$scope.isTT1Wanita = false;
			$scope.data = {
				'spaj_guid': spajProvider.getSpajGUID(),
				'isSkkTertanggungAccepted': false,
				'isPenyakitTurunan': false,
				'jenisPenyakit': false,
				'isPenyakitDiderita': false,
				'isAdaTTU': true,
				'isAdaTT1': false,
				'isAdaTT2': false,
				'isAdaTT3': false,
				'isAdaTT4': false,
				'isPenyakit1': false,
				'isPenyakit1_TTU': false,
				'isPenyakit1_TT1': false,
				'isPenyakit1_TT2': false,
				'isPenyakit1_TT3': false,
				'isPenyakit1_TT4': false,
				'isPenyakit2': false,
				'isPenyakit2_TTU': false,
				'isPenyakit2_TT1': false,
				'isPenyakit2_TT2': false,
				'isPenyakit2_TT3': false,
				'isPenyakit2_TT4': false,
				'isPenyakit3': false,
				'isPenyakit3_TTU': false,
				'isPenyakit3_TT1': false,
				'isPenyakit3_TT2': false,
				'isPenyakit3_TT3': false,
				'isPenyakit3_TT4': false,
				'isPenyakit4': false,
				'isPenyakit4_TTU': false,
				'isPenyakit4_TT1': false,
				'isPenyakit4_TT2': false,
				'isPenyakit4_TT3': false,
				'isPenyakit4_TT4': false,
				'isPenyakit5': false,
				'isPenyakit5_TTU': false,
				'isPenyakit5_TT1': false,
				'isPenyakit5_TT2': false,
				'isPenyakit5_TT3': false,
				'isPenyakit5_TT4': false,
				'isPenyakit6': false,
				'isPenyakit6_TTU': false,
				'isPenyakit6_TT1': false,
				'isPenyakit6_TT2': false,
				'isPenyakit6_TT3': false,
				'isPenyakit6_TT4': false,
				'isPenyakit7': false,
				'isPenyakit7_TTU': false,
				'isPenyakit7_TT1': false,
				'isPenyakit7_TT2': false,
				'isPenyakit7_TT3': false,
				'isPenyakit7_TT4': false,
				'isPenyakit5': false,
				'isPenyakit5_TTU': false,
				'isPenyakit5_TT1': false,
				'isPenyakit5_TT2': false,
				'isPenyakit5_TT3': false,
				'isPenyakit5_TT4': false,
				'isPenyakit6': false,
				'isPenyakit6_TTU': false,
				'isPenyakit6_TT1': false,
				'isPenyakit6_TT2': false,
				'isPenyakit6_TT3': false,
				'isPenyakit6_TT4': false,
				'isPenyakit7': false,
				'isPenyakit7_TTU': false,
				'isPenyakit7_TT1': false,
				'isPenyakit7_TT2': false,
				'isPenyakit7_TT3': false,
				'isPenyakit7_TT4': false,
				'isPenyakit8': false,
				'isPenyakit8_TTU': false,
				'isPenyakit8_TT1': false,
				'isPenyakit8_TT2': false,
				'isPenyakit8_TT3': false,
				'isPenyakit8_TT4': false,
				'isPenyakit9': false,
				'isPenyakit9_TTU': false,
				'isPenyakit9_TT1': false,
				'isPenyakit9_TT2': false,
				'isPenyakit9_TT3': false,
				'isPenyakit9_TT4': false,
				'isPenyakit10': false,
				'isPenyakit10_TTU': false,
				'isPenyakit10_TT1': false,
				'isPenyakit10_TT2': false,
				'isPenyakit10_TT3': false,
				'isPenyakit10_TT4': false,
				'isPenyakit11': false,
				'isPenyakit11_TTU': false,
				'isPenyakit11_TT1': false,
				'isPenyakit11_TT2': false,
				'isPenyakit11_TT3': false,
				'isPenyakit11_TT4': false,
				'isPenyakit12': false,
				'isPenyakit12_TTU': false,
				'isPenyakit12_TT1': false,
				'isPenyakit12_TT2': false,
				'isPenyakit12_TT3': false,
				'isPenyakit12_TT4': false,
				'isPenyakit13': false,
				'isPenyakit13_TTU': false,
				'isPenyakit13_TT1': false,
				'isPenyakit13_TT2': false,
				'isPenyakit13_TT3': false,
				'isPenyakit13_TT4': false,
				'isPenyakit14': false,
				'isPenyakit14_TTU': false,
				'isPenyakit14_TT1': false,
				'isPenyakit14_TT2': false,
				'isPenyakit14_TT3': false,
				'isPenyakit14_TT4': false,
				'isPenyakit15': false,
				'isPenyakit15_TTU': false,
				'isPenyakit15_TT1': false,
				'isPenyakit15_TT2': false,
				'isPenyakit15_TT3': false,
				'isPenyakit15_TT4': false,
				'isPenyakit16': false,
				'isPenyakit16_TTU': false,
				'isPenyakit16_TT1': false,
				'isPenyakit16_TT2': false,
				'isPenyakit16_TT3': false,
				'isPenyakit16_TT4': false,
				'isPenyakit17': false,
				'jenisPenyakitLainnya': '',
				'isMerokok_TTU': false,
				'isMerokok_TT1': false,
				'isMerokok_TT2': false,
				'isMerokok_TT3': false,
				'isMerokok_TT4': false,
				'rokokBatangTTU': '',
				'rokokBatangTT1': '',
				'rokokBatangTT2': '',
				'rokokBatangTT3': '',
				'rokokBatangTT4': '',
				'isObat_TTU': false,
				'isObat_TT1': false,
				'isObat_TT2': false,
				'isObat_TT3': false,
				'isObat_TT4': false,
				'isWanitaPAP_TTU': false,
				'isWanitaPAP_TT1': false,
				'isWanitaPAP_TT2': false,
				'isWanitaPAP_TT3': false,
				'isWanitaPAP_TT4': false,
				'isMensTerganggu_TTU': false,
				'isMensTerganggu_TT1': false,
				'isMensTerganggu_TT2': false,
				'isMensTerganggu_TT3': false,
				'isMensTerganggu_TT4': false,
				'isMensTerganggu_TTU': false,
				'isMensTerganggu_TT1': false,
				'isMensTerganggu_TT2': false,
				'isMensTerganggu_TT3': false,
				'isMensTerganggu_TT4': false,
				'isCesar_TTU': false,
				'isCesar_TT1': false,
				'isCesar_TT2': false,
				'isCesar_TT3': false,
				'isCesar_TT4': false,
				'isKeguguran_TTU': false,
				'isKeguguran_TT1': false,
				'isKeguguran_TT2': false,
				'isKeguguran_TT3': false,
				'isKeguguran_TT4': false,
				'isKesulitanHamil_TTU': false,
				'isKesulitanHamil_TT1': false,
				'isKesulitanHamil_TT2': false,
				'isKesulitanHamil_TT3': false,
				'isKesulitanHamil_TT4': false,
				/* INI SKK UMUM */
				'umurAyahTTU': '',
				//'isAyahHidup_TTU':'',
				//'isAyahHidupSehat_TTU':'',
				'isAyahDiabet_TTU': false,
				'isAyahHipertensi_TTU': false,
				'isAyahJantung_TTU': false,
				'isAyahTumor_TTU': false,
				'isAyahPenyakitKeturunan_TTU': false,
				'sebabMeninggalAyah_TTU': '',
				'lamaSakitAyah_TTU': '',
				'tglMeninggalAyah_TTU': '',
				'umurIbuTTU': '',
				'isIbuMeninggal_TTU': false,
				'isIbuDiabet_TTU': false,
				'isIbuHipertensi_TTU': false,
				'isIbuJantung_TTU': false,
				'isIbuTumor_TTU': false,
				'isIbuPenyakitKeturunan_TTU': false,
				'sebabMeninggalIbu_TTU': '',
				'lamaSakitIbu_TTU': '',
				'tglMeninggalIbu_TTU': '',
				'umurPasanganTTU': '',
				'isPasanganMeninggal_TTU': false,
				'isPasanganDiabet_TTU': false,
				'isPasanganHipertensi_TTU': false,
				'isPasanganJantung_TTU': false,
				'isPasanganTumor_TTU': false,
				'isPasanganPenyakitKeturunan_TTU': false,
				'sebabMeninggalPasangan_TTU': '',
				'lamaSakitPasangan_TTU': '',
				'tglMeninggalPasangan_TTU': '',
				'umurSaudaraLakiTTU': '',
				'isSaudaraLakiMeninggal_TTU': false,
				'isSaudaraLakiDiabet_TTU': false,
				'isSaudaraLakiHipertensi_TTU': false,
				'isSaudaraLakiJantung_TTU': false,
				'isSaudaraLakiTumor_TTU': false,
				'isSaudaraLakiPenyakitKeturunan_TTU': false,
				'lamaSakitSaudaraLaki_TTU': '',
				'sebabMeninggalSaudaraLaki_TTU': '',
				'tglMeninggalSaudaraLaki_TTU': '',
				'umurSaudaraPerempuanTTU': '',
				'isSaudaraPerempuanMeninggal_TTU': false,
				'isSaudaraPerempuanDiabet_TTU': false,
				'isSaudaraPerempuanHipertensi_TTU': false,
				'isSaudaraPerempuanJantung_TTU': false,
				'isSaudaraPerempuanTumor_TTU': false,
				'isSaudaraPerempuanPenyakitKeturunan_TTU': false,
				'sebabMeninggalSaudaraPerempuan_TTU': '',
				'lamaSakitSaudaraPerempuan_TTU': '',
				'tglMeninggalSaudaraPerempuan_TTU': '',
				'umurAnakTTU': '',
				'isAnakMeninggal_TTU': false,
				'isAnakDiabet_TTU': false,
				'isAnakHipertensi_TTU': false,
				'isAnakJantung_TTU': false,
				'isAnakTumor_TTU': false,
				'isAnakPenyakitKeturunan_TTU': false,
				'sebabMeninggalAnak_TTU': '',
				'lamaSakitAnak_TTU': '',
				'tglMeninggalAnak_TTU': '',
				'umurAyahTT1': '',
				'isAyahMeninggal_TT1': false,
				'isAyahDiabet_TT1': false,
				'isAyahHipertensi_TT1': false,
				'isAyahJantung_TT1': false,
				'isAyahTumor_TT1': false,
				'isAyahPenyakitKeturunan_TT1': false,
				'sebabMeninggalAyah_TT1': '',
				'lamaSakitAyah_TT1': '',
				'tglMeninggalAyah_TT1': '',
				'umurIbuTT1': '',
				'isIbuMeninggal_TT1': false,
				'isIbuDiabet_TT1': false,
				'isIbuHipertensi_TT1': false,
				'isIbuJantung_TT1': false,
				'isIbuTumor_TT1': false,
				'isIbuPenyakitKeturunan_TT1': false,
				'sebabMeninggalIbu_TT1': '',
				'lamaSakitIbu_TT1': '',
				'tglMeninggalIbu_TT1': '',
				'umurPasanganTT1': '',
				'isPasanganMeninggal_TT1': false,
				'isPasanganDiabet_TT1': false,
				'isPasanganHipertensi_TT1': false,
				'isPasanganJantung_TT1': false,
				'isPasanganTumor_TT1': false,
				'isPasanganPenyakitKeturunan_TT1': false,
				'sebabMeninggalPasangan_TT1': '',
				'lamaSakitPasangan_TT1': '',
				'tglMeninggalPasangan_TT1': '',
				'umurSaudaraLakiTT1': '',
				'isSaudaraLakiMeninggal_TT1': false,
				'isSaudaraLakiDiabet_TT1': false,
				'isSaudaraLakiHipertensi_TT1': false,
				'isSaudaraLakiJantung_TT1': false,
				'isSaudaraLakiTumor_TT1': false,
				'isSaudaraLakiPenyakitKeturunan_TT1': false,
				'lamaSakitSaudaraLaki_TT1': '',
				'sebabMeninggalSaudaraLaki_TT1': '',
				'tglMeninggalSaudaraLaki_TT1': '',
				'umurSaudaraPerempuanTT1': '',
				'isSaudaraPerempuanMeninggal_TT1': false,
				'isSaudaraPerempuanDiabet_TT1': false,
				'isSaudaraPerempuanHipertensi_TT1': false,
				'isSaudaraPerempuanJantung_TT1': false,
				'isSaudaraPerempuanTumor_TT1': false,
				'isSaudaraPerempuanPenyakitKeturunan_TT1': false,
				'sebabMeninggalSaudaraPerempuan_TT1': '',
				'lamaSakitSaudaraPerempuan_TT1': '',
				'tglMeninggalSaudaraPerempuan_TT1': '',
				'umurAnakTT1': '',
				'isAnakMeninggal_TT1': false,
				'isAnakDiabet_TT1': false,
				'isAnakHipertensi_TT1': false,
				'isAnakJantung_TT1': false,
				'isAnakTumor_TT1': false,
				'isAnakPenyakitKeturunan_TT1': false,
				'sebabMeninggalAnak_TT1': '',
				'lamaSakitAnak_TT1': '',
				'tglMeninggalAnak_TT1': '',
				'isSehatTTU': false,
				'isSehatTT1': false,
				'isGejalaTTU': false,
				'isGejalaTT1': false,
				'isPenyakitT01_TTU': false,
				'tglSakitT01_TTU': '',
				'namaDokterT01_TTU': '',
				'isPenyakitT01_TT1': false,
				'tglSakitT01_TT1': '',
				'namaDokterT01_TT1': '',
				'isPenyakitT02_TTU': false,
				'tglSakitT02_TTU': '',
				'namaDokterT02_TTU': '',
				'isPenyakitT02_TT1': false,
				'tglSakitT02_TT1': '',
				'namaDokterT02_TT1': '',
				'isPenyakitT03_TTU': false,
				'tglSakitT03_TTU': '',
				'namaDokterT03_TTU': '',
				'isPenyakitT03_TT1': false,
				'tglSakitT03_TT1': '',
				'namaDokterT03_TT1': '',
				'isPenyakitT04_TTU': false,
				'tglSakitT04_TTU': '',
				'namaDokterT04_TTU': '',
				'isPenyakitT04_TT1': false,
				'tglSakitT04_TT1': '',
				'namaDokterT04_TT1': '',
				'isPenyakitT05_TTU': false,
				'tglSakitT05_TTU': '',
				'namaDokterT05_TTU': '',
				'isPenyakitT05_TT1': false,
				'tglSakitT05_TT1': '',
				'namaDokterT05_TT1': '',
				'isPenyakitT06_TTU': false,
				'tglSakitT06_TTU': '',
				'namaDokterT06_TTU': '',
				'isPenyakitT06_TT1': false,
				'tglSakitT06_TT1': '',
				'namaDokterT06_TT1': '',
				'isPenyakitT07_TTU': false,
				'tglSakitT07_TTU': '',
				'namaDokterT07_TTU': '',
				'isPenyakitT07_TT1': false,
				'tglSakitT07_TT1': '',
				'namaDokterT07_TT1': '',
				'isPenyakitT08_TTU': false,
				'tglSakitT08_TTU': '',
				'namaDokterT08_TTU': '',
				'isPenyakitT08_TT1': false,
				'tglSakitT08_TT1': '',
				'namaDokterT08_TT1': '',
				'isPenyakitT09_TTU': false,
				'tglSakitT09_TTU': '',
				'namaDokterT09_TTU': '',
				'isPenyakitT09_TT1': false,
				'tglSakitT09_TT1': '',
				'namaDokterT09_TT1': '',
				'isPenyakitT10_TTU': false,
				'tglSakitT10_TTU': '',
				'namaDokterT10_TTU': '',
				'isPenyakitT10_TT1': false,
				'tglSakitT10_TT1': '',
				'namaDokterT10_TT1': '',
				'isPenyakitT11_TTU': false,
				'tglSakitT11_TTU': '',
				'namaDokterT11_TTU': '',
				'isPenyakitT11_TT1': false,
				'tglSakitT11_TT1': '',
				'namaDokterT11_TT1': '',
				'isPenyakitT12_TTU': false,
				'tglSakitT12_TTU': '',
				'namaDokterT12_TTU': '',
				'isPenyakitT12_TT1': false,
				'tglSakitT12_TT1': '',
				'namaDokterT12_TT1': '',
				'isPenyakitT13_TTU': false,
				'tglSakitT13_TTU': '',
				'namaDokterT13_TTU': '',
				'isPenyakitT13_TT1': false,
				'tglSakitT13_TT1': '',
				'namaDokterT13_TT1': '',
				'isPenyakitT14_TTU': false,
				'tglSakitT14_TTU': '',
				'namaDokterT14_TTU': '',
				'isPenyakitT14_TT1': false,
				'tglSakitT14_TT1': '',
				'namaDokterT14_TT1': '',
				'isPenyakitT15_TTU': false,
				'tglSakitT15_TTU': '',
				'namaDokterT15_TTU': '',
				'isPenyakitT15_TT1': false,
				'tglSakitT15_TT1': '',
				'namaDokterT15_TT1': '',
				'isPenyakitT16_TTU': false,
				'tglSakitT16_TTU': '',
				'namaDokterT16_TTU': '',
				'isPenyakitT16_TT1': false,
				'tglSakitT16_TT1': '',
				'namaDokterT16_TT1': '',
				'isPenyakitT17_TTU': false,
				'tglSakitT17_TTU': '',
				'namaDokterT17_TTU': '',
				'isPenyakitT17_TT1': false,
				'tglSakitT17_TT1': '',
				'namaDokterT17_TT1': '',
				'isPenyakitT18_TTU': false,
				'tglSakitT18_TTU': '',
				'namaDokterT18_TTU': '',
				'isPenyakitT18_TT1': false,
				'tglSakitT18_TT1': '',
				'namaDokterT18_TT1': '',
				'isPenyakitT19_TTU': false,
				'tglSakitT19_TTU': '',
				'namaDokterT19_TTU': '',
				'isPenyakitT19_TT1': false,
				'tglSakitT19_TT1': '',
				'namaDokterT19_TT1': '',
				'isPenyakitT20_TTU': false,
				'tglSakitT20_TTU': '',
				'namaDokterT20_TTU': '',
				'isPenyakitT20_TT1': false,
				'tglSakitT20_TT1': '',
				'namaDokterT20_TT1': ''
			}
			if ($store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId) == null) {} else {
				$scope.data = $store.get('SPAJ::' + spajProvider.getSpajGUID() + '::' + $scope.pageId);
			}
		}
		$scope.$on('$ionicView.enter', function () {})
		$scope.moveToNextPage = function () {
			if ($scope.data.isSkkTertanggungAccepted) {
				if (confirm('Langsung menuju ke halaman form isian data diri pemegang polis?')) {
					$state.go('aplikasiSPAJOnline.dataPemegangPolis13', {}, {
						reload: true,
						inherit: false
					});
				} else {
					return false;
				}
			}
		}
	}
]).controller('daftarSPAJOnlineCtrl', ['$scope', '$state', '$stateParams', 'spajProvider', 'dataFactory', '$ionicPopup', '$http', '$ionicLoading', '$location', '$store', '$ionicScrollDelegate',
	function ($scope, $state, $stateParams, spajProvider, dataFactory, $ionicPopup, $http, $ionicLoading, $location, $store, $ionicScrollDelegate) {
		$scope.idagen = getQueryParam('idagen');
		$scope.token = getQueryParam('token');
		$scope.android_ver = getQueryParam('android_ver');
		$scope.device = getQueryParam('device');
		$scope.deleteData = function () {
			if (confirm('Reset data. Akan menghapus data SPAJ baru yang belum Submit.')) {
				localStorage.clear();
				location.reload();
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
		$scope.editUnsavedSpaj = function (spaj_guid) {
			//route to dataTertanggung13
			$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1', {
				spaj_guid: spaj_guid
			}, {
				reload: true,
				inherit: false
			});
		}
		$scope.scrollTo = function (target) {
			$location.hash(target); //set the location hash
			var handle = $ionicScrollDelegate.$getByHandle('myPageDelegate');
			handle.anchorScroll(true); // 'true' for animation
			console.log(target);
		};
		$http({
			method: "GET",
			//url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/retriever.php?act=get_unprocessed&idagen=" + $scope.idagen + "&token=" + $scope.token
			url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=get_processed&idagen=" + $scope.idagen + "&token=" + $scope.token
		}).then(function mySucces(response) {
			$tdata = [];
			if (response.data == null) {}
			$scope.dataProcessed = response.data;
			$ionicLoading.hide();
		}, function myError(response) {
			$scope.dataProcessed = response.message;
			//
		}).withCredentials = true;
		$http({
			method: "GET",
			//url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/retriever.php?act=get_unprocessed&idagen=" + $scope.idagen + "&token=" + $scope.token
			url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=get_underwrite&idagen=" + $scope.idagen + "&token=" + $scope.token
		}).then(function mySucces(response) {
			$tdata = [];
			if (response.data == null) {}
			$scope.dataUnprocessedUnderwriting = response.data;
			$ionicLoading.hide();
		}, function myError(response) {
			$scope.dataUnprocessedUnderwriting = response.message;
			//
		}).withCredentials = true;
		//untuk mapping link ke controller cetakan PDF 
		ctrl_pdf = function (obj, param) {
			return obj.find(obj => {
				return obj.id === param
			})
		}
		/* 			$http({
			                method: "GET",
							url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=get_produk&idagen=" + $scope.idagen + "&token=" + $scope.token
			            }) */
		$http({
			method: "GET",
			//url: "https://jaim.jiwasraya.co.id/mobileapi/jsprosales2/?/api/get_prospek_list/" + $scope.idagen + ""
			url: "https://jaim.jiwasraya.co.id/mobileapi/spaj_bridge/get.php?act=get_prospek&idagen=" + $scope.idagen + "&token=" + $scope.token
		}).then(function mySucces(response) {
			if (response.data == null) {} else {
				$tdata = [];
				for (i = 0; i < response.data.length; i++) {
					$dt = response.data[i].TGLLAHIR.split('/');
					$tl = $dt[2] + '-' + $dt[1] + '-' + $dt[0];
					$tdata.push({
						'build_id': response.data[i].BUILD_ID,
						'no_prospek': response.data[i].NO_PROSPEK,
						'cara_bayar': response.data[i].CARA_BAYAR,
						'jumlah_premi': response.data[i].JUMLAH_PREMI,
						'premi_berkala': response.data[i].PREMI_BERKALA,
						'topup_berkala': response.data[i].TOPUP_BERKALA,
						'topup_sekaligus': response.data[i].TOPUP_SEKALIGUS,
						'jua': response.data[i].JUA,
						'tgl_rekam': response.data[i].TGL_REKAM,
						'id_produk': response.data[i].ID_PRODUK,
						'kd_produk': response.data[i].KD_PRODUK,
						//'controller_pdf': ctrl_pdf(dataFactory.getJenisAsuransis(),response.data[i].KD_PRODUK).ctrl_pdf,
						'file_pdf': response.data[i].FILE_PDF,
						'nama': response.data[i].NAMA,
						'alamat': response.data[i].ALAMAT,
						'kota': response.data[i].KOTA,
						'kdprovinsi': response.data[i].KDPROVINSI,
						'kdpropinsi': response.data[i].KDPROPINSI,
						'tgllahir': $tl,
						'email': response.data[i].EMAIL,
						'hp': response.data[i].HP,
						'no_ktp_tertanggung': response.data[i].NO_KTP,
						'telp': response.data[i].TELP,
						'jeniskelamin': (response.data[i].JENISKELAMIN == 'M') ? 1 : 2,
						'is_perokok': response.data[i].IS_PEROKOK,
						'kode_alokasi': response.data[i].NAMA_ALOKASI1,
						'penghasilan': response.data[i].PENGHASILAN,
						'namaAgen': response.data[i].NAMAAGEN
						,'ADB': response.data[i].ADB
						,'ADDB': response.data[i].ADDB
						,'CI': response.data[i].CI
						,'HCP_BEDAH': response.data[i].HCP_BEDAH
						,'HCP_MURNI': response.data[i].HCP_MURNI
						,'IS_ADB': (response.data[i].IS_ADB == '1')?true:false
						,'IS_ADDB': (response.data[i].IS_ADDB == '1')?true:false
						,'IS_CI': (response.data[i].IS_CI == '1')?true:false
						,'IS_HCP_BEDAH': (response.data[i].IS_HCP_BEDAH == '1')?true:false
						,'IS_HCP_MURNI': (response.data[i].IS_HCP_MURNI == '1')?true:false
						,'IS_PAYOR_DEATH': (response.data[i].IS_PAYOR_DEATH == '1')?true:false
						,'IS_PAYOR_TPD': (response.data[i].IS_PAYOR_TPD == '1')?true:false
						,'IS_SPOUSE_DEATH': (response.data[i].IS_SPOUSE_DEATH == '1')?true:false
						,'IS_SPOUSE_TPD': (response.data[i].IS_SPOUSE_TPD == '1')?true:false
						,'IS_TL': (response.data[i].IS_TL == '1')?true:false
						,'IS_TPD': (response.data[i].IS_TPD == '1')?true:false
						,'IS_WAIVER_CI': (response.data[i].IS_WAIVER_CI == '1')?true:false
						,'IS_WAIVER_TPD': (response.data[i].IS_WAIVER_TPD == '1')?true:false
						,'PAYOR_DEATH': response.data[i].PAYOR_DEATH
						,'PAYOR_TPD': response.data[i].PAYOR_TPD
						,'PLAFON_HCP_BEDAH': response.data[i].PLAFON_HCP_BEDAH
						,'PLAFON_HCP_MURNI': response.data[i].PLAFON_HCP_MURNI
						,'SPOUSE_DEATH': response.data[i].SPOUSE_DEATH
						,'SPOUSE_TPD': response.data[i].SPOUSE_TPD
						,'TL': response.data[i].TL
						,'TPD': response.data[i].TPD
						,'WAIVER_CI': response.data[i].WAIVER_CI
						,'WAIVER_TPD': response.data[i].WAIVER_TPD
					})
				}
			}
			$scope.dataProspek = $tdata;
			$ionicLoading.hide();
		}, function myError(response) {
			$scope.dataProspek = response.message;
		}).withCredentials = true;
		var this_guid = spajProvider.getSpajGUID();
		var temp = localStorage.getItem('SPAJ::' + this_guid + '::aplikasiSPAJOnline.dataTertanggung13');
		var tJson = JSON.parse(temp);
		$scope.dataUnsaved = {
			this_guid: tJson
		}
		$scope.deleteUnsavedSpaj = function (spaj_guid) {
			if (confirm('Apakah ingin menghapus dokumen SPAJ ini?')) {
				spajProvider.delUnsavedSpajGuid(spaj_guid);
				location.reload();
				return true;
			}
		}
		$scope.editSpaj = function (item) {
			//console.log(item);
			$location.path('/basic_tertanggung1');
		}
		$scope.doNewSPAJ = function () {
			$state.go('aplikasiSPAJOnline', {}, {
				reload: true,
				inherit: false
			});
		}
		$scope.newSpajProspek = function (build_id) {
			spajProvider.setSpajGUID('new');
			spajProvider.setBuildId(build_id);
			spajProvider.setProspekData(JSON.stringify($scope.dataProspek));
			$state.go('aplikasiSPAJOnline.dataTertanggung13_tab1', {
				spaj_guid: 'new'
			}, {
				reload: true,
				inherit: false
			});
		}
		/* 	$ionicLoading.show({
					content: '<ion-spinner></ion-spinner>',
					animation: 'fade-in',
					showBackdrop: true,
					maxWidth: 400,
					showDelay: 1
				}); */
	}
])