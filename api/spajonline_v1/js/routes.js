angular.module('app.routes', ['ionicUIRouter'])

.config(function($stateProvider, $urlRouterProvider,$ionicConfigProvider) {
 $ionicConfigProvider.tabs.position('top'); //bottom
 $ionicConfigProvider.platform.android.scrolling.jsScrolling(true);
$ionicConfigProvider.views.maxCache(60);

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    
  

      /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='aplikasiSPAJOnline.dataTertanggung13'
      2) Using $state.go programatically:
        $state.go('aplikasiSPAJOnline.dataTertanggung13');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /spaj_entry_list/tab1/basic_tertanggung1
      /spaj_entry_list/tab8/basic_tertanggung1
  */
  .state('aplikasiSPAJOnline.dataTertanggung13', {
    url: '/basic_tertanggung1/:spaj_guid',
    views: {
      'tab1': {
        templateUrl: 'templates/dataTertanggung13.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataTertanggung13Ctrl'
      },
      'tab8': {
        templateUrl: 'templates/dataTertanggung13.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataTertanggung13Ctrl'
      }
    }
  })
    .state('aplikasiSPAJOnline.sKKTertanggung', {
    url: '/page16',
    views: {
      'tab11': {
        templateUrl: 'templates/sKKTertanggung.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'sKKTertanggungCtrl'
      }
    }
  })
  

  .state('aplikasiSPAJOnline.suratKeteranganKesehatan', {
    url: '/skk',
    views: {
      'tab11': {
        templateUrl: 'templates/suratKeteranganKesehatan.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'suratKeteranganKesehatanCtrl'
      }
    }
  })
  
  .state('aplikasiSPAJOnline.dataPemegangPolis13', {
    url: '/basic_pempol1',
    views: {
      'tab8': {
        templateUrl: 'templates/dataPemegangPolis13.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataPemegangPolis13Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline', {
    url: '/spaj_entry_list',
    templateUrl: 'templates/aplikasiSPAJOnline.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
	controller: 'aplikasiSPAJOnlineCtrl',
    abstract:true
  })

  /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='aplikasiSPAJOnline.dataTertanggung23'
      2) Using $state.go programatically:
        $state.go('aplikasiSPAJOnline.dataTertanggung23');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /spaj_entry_list/tab1/basic_tertanggung2/:idagen/:spaj_guid/:token/:android_ver
      /spaj_entry_list/tab8/basic_tertanggung2/:idagen/:spaj_guid/:token/:android_ver
  */
  .state('aplikasiSPAJOnline.dataTertanggung23', {
    url: '/basic_tertanggung2/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab1': {
        templateUrl: 'templates/dataTertanggung23.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataTertanggung23Ctrl'
      },
      'tab8': {
        templateUrl: 'templates/dataTertanggung23.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataTertanggung23Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.dataPemegangPolis23', {
    url: '/basic_pempol2/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab8': {
        templateUrl: 'templates/dataPemegangPolis23.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataPemegangPolis23Ctrl'
      }
    }
  })

  /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='aplikasiSPAJOnline.dataTertanggung33'
      2) Using $state.go programatically:
        $state.go('aplikasiSPAJOnline.dataTertanggung33');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /spaj_entry_list/tab1/basic_tertanggung3/:idagen/:spaj_guid/:token/:android_ver
      /spaj_entry_list/tab8/basic_tertanggung3/:idagen/:spaj_guid/:token/:android_ver
  */
  .state('aplikasiSPAJOnline.dataTertanggung33', {
    url: '/basic_tertanggung3/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab1': {
        templateUrl: 'templates/dataTertanggung33.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataTertanggung33Ctrl'
      },
      'tab8': {
        templateUrl: 'templates/dataTertanggung33.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataTertanggung33Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.dataPemegangPolis33', {
    url: '/basic_pempol3/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab8': {
        templateUrl: 'templates/dataPemegangPolis33.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dataPemegangPolis33Ctrl'
      }
    }
  })

  /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='aplikasiSPAJOnline.pekerjaanTertanggung'
      2) Using $state.go programatically:
        $state.go('aplikasiSPAJOnline.pekerjaanTertanggung');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /spaj_entry_list/tab1/pekerjaan_tertanggung1/:idagen/:spaj_guid/:token/:android_ver
      /spaj_entry_list/tab8/pekerjaan_tertanggung1/:idagen/:spaj_guid/:token/:android_ver
  */
  .state('aplikasiSPAJOnline.pekerjaanTertanggung', {
    url: '/pekerjaan_tertanggung1/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab1': {
        templateUrl: 'templates/pekerjaanTertanggung.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'pekerjaanTertanggungCtrl'
      },
      'tab8': {
        templateUrl: 'templates/pekerjaanTertanggung.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'pekerjaanTertanggungCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.pekerjaanPemegangPolis', {
    url: '/pekerjaan_pempol1/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab8': {
        templateUrl: 'templates/pekerjaanPemegangPolis.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'pekerjaanPemegangPolisCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.produkDanManfaat12', {
    url: '/produk_dan_benefit',
    views: {
      'tab12': {
        templateUrl: 'templates/produkDanManfaat12.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'produkDanManfaat12Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.produkDanManfaat22', {
    url: '/page24',
    views: {
      'tab12': {
        templateUrl: 'templates/produkDanManfaat22.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'produkDanManfaat22Ctrl'
      }
    }
  })

  /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='aplikasiSPAJOnline.sKKTertanggungUtama'
      2) Using $state.go programatically:
        $state.go('aplikasiSPAJOnline.sKKTertanggungUtama');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /spaj_entry_list/tab1/skk_combined
      /spaj_entry_list/tab8/skk_combined
  */
  .state('aplikasiSPAJOnline.sKKTertanggungUtama', {
    url: '/skk_combined',
    views: {
      'tab1': {
        templateUrl: 'templates/sKKTertanggungUtama.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'sKKTertanggungUtamaCtrl'
      },
      'tab8': {
        templateUrl: 'templates/sKKTertanggungUtama.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'sKKTertanggungUtamaCtrl'
      }
    }
  })

  /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='aplikasiSPAJOnline.sKKTertanggungTambahan'
      2) Using $state.go programatically:
        $state.go('aplikasiSPAJOnline.sKKTertanggungTambahan');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /spaj_entry_list/tab1/page26
      /spaj_entry_list/tab8/page26
  */
  .state('aplikasiSPAJOnline.sKKTertanggungTambahan', {
    url: '/page26',
    views: {
      'tab1': {
        templateUrl: 'templates/sKKTertanggungTambahan.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'sKKTertanggungTambahanCtrl'
      },
      'tab8': {
        templateUrl: 'templates/sKKTertanggungTambahan.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'sKKTertanggungTambahanCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.lembarPersetujuan', {
    url: '/persetujuan',
    views: {
      'tab9': {
        templateUrl: 'templates/lembarPersetujuan.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'lembarPersetujuanCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.tinjauUlangDanKirimDokumen', {
    url: '/tijau_ulang',
    views: {
      'tab5': {
        templateUrl: 'templates/tinjauUlangDanKirimDokumen.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'tinjauUlangDanKirimDokumenCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.dokumenPendukungSPAJ', {
    url: '/dokumen_tambahan',
    views: {
      'tab10': {
        templateUrl: 'templates/dokumenPendukungSPAJ.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'dokumenPendukungSPAJCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.tambahkanDokumenPenunjangSPAJ', {
    url: '/viewAddDokumen/:indexDokumen',
    views: {
      'tab10': {
        templateUrl: 'templates/tambahkanDokumenPenunjangSPAJ.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'tambahkanDokumenPenunjangSPAJCtrl'
      }
    }
  })

   .state('aplikasiSPAJOnline.tambahPenerimaManfaat', {
    url: '/page25',
    views: {
      'tab12': {
        templateUrl: 'templates/tambahPenerimaManfaat.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'tambahPenerimaManfaatCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.editPenerimaManfaat', {
    url: '/page23/:indexPenerimaManfaat',
    views: {
      'tab12': {
        templateUrl: 'templates/editPenerimaManfaat.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
        controller: 'editPenerimaManfaatCtrl'
      }
    }
  })

/*   .state('sPAJOnlineJiwasraya', {
    url: '/welcomepage/:idagen/:token/:android_ver/:spaj_guid/:new',
    templateUrl: 'templates/sPAJOnlineJiwasraya.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
    controller: 'sPAJOnlineJiwasrayaCtrl'
  })
  
  .state('viewPrintSPAJ', {
    url: '/welcomepage/:idagen/:token/:android_ver/:spaj_guid/:new',
    templateUrl: 'templates/viewPrintSPAJ.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
    controller: 'viewPrintSPAJCtrl'
  })
 */
.state('daftarSPAJOnline', {
	url: '/spaj_entry_list/:idagen/:token/:android_ver/:spaj_guid/:new',
	templateUrl: 'templates/daftarSPAJOnline.html?seed='+Math.floor(1000 + Math.random() * 9000).toString(),
	controller: 'daftarSPAJOnlineCtrl'
})

$urlRouterProvider.otherwise('/spaj_entry_list')

  

});