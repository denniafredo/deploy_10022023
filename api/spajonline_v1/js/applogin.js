angular.module('starter', ['ionic'])
    .run(function($ionicPlatform) {
        $ionicPlatform.ready(function() {
            if (window.cordova && window.cordova.plugins.Keyboard) {
                // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                // for form inputs)
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                // Don't remove this line unless you know what you are doing. It stops the viewport
                // from snapping when text inputs are focused. Ionic handles this internally for
                // a much nicer keyboard experience.
                cordova.plugins.Keyboard.disableScroll(true);
            }
            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
        });
    })
    .config(function($stateProvider, $urlRouterProvider) {
        $stateProvider
            .state('menu', {
                url: "/menu",
                templateUrl: "menu.html",
                controller: 'AppCtrl'
            })
            .state('home', {
                url: '/home/:user',
                templateUrl: 'home.html',
                controller: "homeCtrl"

            })
            .state('login', {
                url: '/login',
                templateUrl: 'login.html',
                controller: 'LoginCtrl'
            })
            .state('newaccount', {
                url: '/newaccount',
                templateUrl: 'newaccount.html',
                controller: 'newAccountCtrl'
            });
        $urlRouterProvider.otherwise('/login');
    })
    .controller('LoginCtrl', function($scope, $state,$http,$ionicPopup,$ionicLoading) {
		$scope.username = '';
		$scope.password = '';
		$scope._Network_state = true;
		$scope.android_ver = getQueryParam('android_ver');
		
		$scope.showAlert = function(title,sub,template,buttontype) {
			$ionicPopup.alert({
				title:title,
				subTitle: sub,
				cssClass: 'popup-dark',
				scope: $scope,
				template: template,
				okType: buttontype
			});
		};
		
		$scope.jsPrompt = function(text){
			var vv = prompt(text, "");
			if (vv != null) {
				alert(vv);
				return vv;
			}
			return false;
		}

		if(localStorage.getItem('loggedin') != null){
			
			data = JSON.parse(localStorage.getItem('loggedin'));
			
			console.log(data);
			
			$scope.showAlert('Login otomatis','','','button-balanced');
			
			urlOk = "index.html?idagen="+data.USERNAME+"&token="+data.MOBILETOKEN+"&android_ver="+$scope.android_ver+"#/spaj_entry_list/";
			window.open(encodeURI(urlOk), '_self', 'location=no');
			
			
		}else{
			console.log('Please login!!!');
		}
		

		$scope._Check_Network_state  = function () {
			// Show a different icon based on offline/online
			if (navigator.onLine) { // true|false
				$scope._Network_state = true;
			} else {
				$scope._Network_state = false;
			}
			return $scope._Network_state;
		}
		
		window.addEventListener('online', $scope._Check_Network_state);
		window.addEventListener('offline', $scope._Check_Network_state);

        $scope.login = function() {
			try{
				let url =  "https://192.168.1.10:7780/mobileapi/spaj_bridge/get.php?act=login_espaj&idagen="+this.user.username;
				var send = this.user;
				 var headers = new Headers();
				 headers.append('Access-Control-Allow-Origin' , '*');
				 headers.append('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT');
				 //let options = new RequestOptions({headers:headers});
	  			
				$ionicLoading.show({
					content: 'Loading',
					animation: 'fade-in',
					showBackdrop: true,
					maxWidth: 200,
					showDelay: 500
				});
	  
				$scope._Check_Network_state();
	  
				if(!$scope._Check_Network_state()){
					$scope.showAlert('Kendala Koneksi'
						,''
						,'Device anda Offline<br />agar dapat login mohon periksa kembali koneksi internet Anda.'
						,'button-assertive');
					$ionicLoading.hide();
					return false;
				}
	  
				$http({
					method: 'POST',url: url,data: send,headers:headers
				}).then(function (res) {

					if(res.data.status === true){
						urlOk = "index.html?idagen="+res.data.USERNAME+"&token="+res.data.MOBILETOKEN+"&android_ver="+$scope.android_ver+"#/spaj_entry_list/";

						window.open(encodeURI(urlOk), '_self', 'location=no');
						$ionicLoading.hide();
						
						localStorage.setItem('loggedin',JSON.stringify(res.data));
					}else{
						$ionicLoading.hide();
						$scope.showAlert('Login Gagal','Periksa kembali user/password Anda','','button-assertive');
						localStorage.removeItem('loggedin');
					}
					
				});
			}catch(e){
				$ionicLoading.hide();
				$scope.showAlert('Validasi','Username/Password harus diisi','','button-assertive');
			}
        };

		//https://jaim.jiwasraya.co.id/account/signin

        $scope.registerMe = function() {
            //alert("dfdf");
            $state.go('newaccount');
        }
    })
    .controller("homeCtrl", function($stateParams, $scope) {
        $scope.name = $stateParams.user;
        //alert("stateparameters "+$scope.name);
    })
    .controller("newAccountCtrl", function($scope, $state, $rootScope) {

        $scope.firstname = '';
        $scope.email = '';
        $scope.newpassword = '';
        $scope.confirmpassword = '';

        $rootScope.goBack = function() {
            $state.go('login');
        }
        $scope.CreateAccount = function() {
            if (this.nuser.newpassword == this.nuser.confirmpassword && this.nuser.firstname != '' && this.nuser.email != '')
                // alert(this.user.username + ' ' + this.user.password);
                alert("Account created");
            else if (this.nuser.newpassword != this.nuser.confirmpassword)
                alert("Passwords do not match. Try Again");
            /* $location.path("/home" ); */

            else {
                alert("Incorrect details.");

            }
        };
    })