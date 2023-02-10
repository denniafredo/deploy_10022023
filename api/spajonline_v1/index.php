<?php
//db check
//include('../mobileapi/spaj_bridge/class/oci.helper.php');
?>
<img src="img/loading.gif" style="position:relative;float:right;padding-right:45%;" id="preloader" />
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport"
         content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
		<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
      <title></title>
	  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<script src="lib/ionic/js/ionic.bundle.min.js"></script>
		<!--script src="https://code.ionicframework.com/1.3.3/js/ionic.bundle.min.js"></script-->
		<script src="lib/ionic/js/angular-input-masks-dependencies.min.js"></script>
		<!--script src="https://cdnjs.cloudflare.com/ajax/libs/angular-input-masks/4.1.0/angular-input-masks-dependencies.min.js"></script-->
		<script src="lib/ionic/js/angular-input-masks.js"></script>	  
		<script src="lib/ionic/js/ion-datetime-picker.min.js"></script>	  
		<script src="js/ng-pattern-restrict.min.js"></script>	  
		<!--script src="https://cdnjs.cloudflare.com/ajax/libs/angular-input-masks/4.1.0/angular-input-masks.js"></script-->	  
		<!--script src="lib\pdfmake\pdfmake.min.js"></script-->
		<!--script src="lib\pdfmake\vfs_fonts.js"></script--> 
		<!-- IF using Sass (run gulp sass first), then uncomment below and remove the CSS includes above
		<link href="css/ionic.app.css" rel="stylesheet">
		-->
		<!--link href="lib/ionic/css/ionic.css" rel="stylesheet"-->
		<!--link href="https://code.ionicframework.com/1.3.3/css/ionic.min.css" rel="stylesheet"-->
		<link href="lib/ionic/css/ionic.min.css" rel="stylesheet">
		<link href="lib/ionic/css/ion-datetime-picker.min.css" rel="stylesheet">
		<link href="lib/ionic/css/style.css" rel="stylesheet">

      <style type="text/css">
		BODY { 

		-moz-transform-origin: center;
		} 
		.platform-ios .manual-ios-statusbar-padding{
		padding-top:20px;
		}
		.manual-remove-top-padding{
		padding-top:0px; 
		}
		.manual-remove-top-padding .scroll{
		padding-top:0px !important;
		}
		ion-list.manual-list-fullwidth div.list, .list.card.manual-card-fullwidth {
		margin-left:-10px;
		margin-right:-10px;
		}
		ion-list.manual-list-fullwidth div.list > .item, .list.card.manual-card-fullwidth > .item {
		border-radius:0px;
		border-left:0px;
		border-right: 0px;
		}
      </style>
      <script src="js/app.js"></script>
      <script src="js/controllers.js?<?=time()?>"></script>
      <script src="js/routes.js"></script>
      <script src="js/directives.js?<?=time()?>"></script>
      <script src="js/signature_pad.js"></script>
      <script src="js/doubleBackExit.directive.js"></script>
      <script src="js/services.min.js?<?=time()?>"></script>
      <script src="lib/ionicuirouter/ionicUIRouter.js"></script>
      <script src="js/angular-messages.min.js"></script>
   </head>
   <body ng-app="app" animation="slide-left-right-ios7" onLoad="">
      <div>
         <div>
            <ion-nav-bar class="bar-positive">
               <ion-nav-back-button></ion-nav-back-button>
               <ion-nav-buttons side="secondary">
                  <a class="button button-balanced  icon-right ion-android-person"
                     ui-sref="daftarSPAJOnline" id="homeButton">
                  <b>&nbsp;&nbsp;&nbsp; My SPAJ &nbsp;&nbsp;&nbsp;</b>
                  </a>
               </ion-nav-buttons>
            </ion-nav-bar>
            <ion-nav-view>asfda</ion-nav-view>
         </div>
      </div>
	  <script type="text/javascript">
    window.onbeforeunload = function() {
        //return false;
    }
</script>

   </body>
</html>