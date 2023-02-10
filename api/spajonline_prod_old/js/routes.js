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
        templateUrl: 'templates/dataTertanggung13.html',
        controller: 'dataTertanggung13Ctrl'
      },
      'tab8': {
        templateUrl: 'templates/dataTertanggung13.html',
        controller: 'dataTertanggung13Ctrl'
      }
    }
  })
    .state('aplikasiSPAJOnline.sKKTertanggung', {
    url: '/page16',
    views: {
      'tab11': {
        templateUrl: 'templates/sKKTertanggung.html',
        controller: 'sKKTertanggungCtrl'
      }
    }
  })
  

  .state('aplikasiSPAJOnline.suratKeteranganKesehatan', {
    url: '/skk',
    views: {
      'tab11': {
        templateUrl: 'templates/suratKeteranganKesehatan.html',
        controller: 'suratKeteranganKesehatanCtrl'
      }
    }
  })
  
  .state('aplikasiSPAJOnline.dataPemegangPolis13', {
    url: '/basic_pempol1',
    views: {
      'tab8': {
        templateUrl: 'templates/dataPemegangPolis13.html',
        controller: 'dataPemegangPolis13Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline', {
    url: '/spaj_entry_list',
    templateUrl: 'templates/aplikasiSPAJOnline.html',
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
        templateUrl: 'templates/dataTertanggung23.html',
        controller: 'dataTertanggung23Ctrl'
      },
      'tab8': {
        templateUrl: 'templates/dataTertanggung23.html',
        controller: 'dataTertanggung23Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.dataPemegangPolis23', {
    url: '/basic_pempol2/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab8': {
        templateUrl: 'templates/dataPemegangPolis23.html',
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
        templateUrl: 'templates/dataTertanggung33.html',
        controller: 'dataTertanggung33Ctrl'
      },
      'tab8': {
        templateUrl: 'templates/dataTertanggung33.html',
        controller: 'dataTertanggung33Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.dataPemegangPolis33', {
    url: '/basic_pempol3/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab8': {
        templateUrl: 'templates/dataPemegangPolis33.html',
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
        templateUrl: 'templates/pekerjaanTertanggung.html',
        controller: 'pekerjaanTertanggungCtrl'
      },
      'tab8': {
        templateUrl: 'templates/pekerjaanTertanggung.html',
        controller: 'pekerjaanTertanggungCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.pekerjaanPemegangPolis', {
    url: '/pekerjaan_pempol1/:idagen/:spaj_guid/:token/:android_ver',
    views: {
      'tab8': {
        templateUrl: 'templates/pekerjaanPemegangPolis.html',
        controller: 'pekerjaanPemegangPolisCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.produkDanManfaat12', {
    url: '/produk_dan_benefit',
    views: {
      'tab12': {
        templateUrl: 'templates/produkDanManfaat12.html',
        controller: 'produkDanManfaat12Ctrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.produkDanManfaat22', {
    url: '/page24',
    views: {
      'tab12': {
        templateUrl: 'templates/produkDanManfaat22.html',
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
        templateUrl: 'templates/sKKTertanggungUtama.html',
        controller: 'sKKTertanggungUtamaCtrl'
      },
      'tab8': {
        templateUrl: 'templates/sKKTertanggungUtama.html',
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
        templateUrl: 'templates/sKKTertanggungTambahan.html',
        controller: 'sKKTertanggungTambahanCtrl'
      },
      'tab8': {
        templateUrl: 'templates/sKKTertanggungTambahan.html',
        controller: 'sKKTertanggungTambahanCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.lembarPersetujuan', {
    url: '/persetujuan',
    views: {
      'tab9': {
        templateUrl: 'templates/lembarPersetujuan.html',
        controller: 'lembarPersetujuanCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.tinjauUlangDanKirimDokumen', {
    url: '/tijau_ulang',
    views: {
      'tab5': {
        templateUrl: 'templates/tinjauUlangDanKirimDokumen.html',
        controller: 'tinjauUlangDanKirimDokumenCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.dokumenPendukungSPAJ', {
    url: '/dokumen_tambahan',
    views: {
      'tab10': {
        templateUrl: 'templates/dokumenPendukungSPAJ.html',
        controller: 'dokumenPendukungSPAJCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.tambahkanDokumenPenunjangSPAJ', {
    url: '/viewAddDokumen/:indexDokumen',
    views: {
      'tab10': {
        templateUrl: 'templates/tambahkanDokumenPenunjangSPAJ.html',
        controller: 'tambahkanDokumenPenunjangSPAJCtrl'
      }
    }
  })

   .state('aplikasiSPAJOnline.tambahPenerimaManfaat', {
    url: '/page25',
    views: {
      'tab12': {
        templateUrl: 'templates/tambahPenerimaManfaat.html',
        controller: 'tambahPenerimaManfaatCtrl'
      }
    }
  })

  .state('aplikasiSPAJOnline.editPenerimaManfaat', {
    url: '/page23/:indexPenerimaManfaat',
    views: {
      'tab12': {
        templateUrl: 'templates/editPenerimaManfaat.html',
        controller: 'editPenerimaManfaatCtrl'
      }
    }
  })

  .state('sPAJOnlineJiwasraya', {
    url: '/welcomepage/:idagen/:token/:android_ver/:spaj_guid/:new',
    templateUrl: 'templates/sPAJOnlineJiwasraya.html',
    controller: 'sPAJOnlineJiwasrayaCtrl'
  })
  
  .state('viewPrintSPAJ', {
    url: '/welcomepage/:idagen/:token/:android_ver/:spaj_guid/:new',
    templateUrl: 'templates/viewPrintSPAJ.html',
    controller: 'viewPrintSPAJCtrl'
  })

.state('daftarSPAJOnline', {
	url: '/spaj_entry_list/:idagen/:token/:android_ver/:spaj_guid/:new',
	templateUrl: 'templates/daftarSPAJOnline.html',
	controller: 'daftarSPAJOnlineCtrl'
})

$urlRouterProvider.otherwise('/spaj_entry_list')

  

});