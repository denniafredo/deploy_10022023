<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport"
         content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
      <title></title>
      <script src="lib/ionic/js/ionic.bundle.min.js"></script>
      <!--script src="https://code.ionicframework.com/1.3.3/js/ionic.bundle.min.js"></script-->
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/angular-input-masks/4.1.0/angular-input-masks-dependencies.min.js"></script-->
	<script src="js/angular-input-masks-dependencies.min.js"></script>
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/angular-input-masks/4.1.0/angular-input-masks.js"></script-->	  
	<script src="js/angular-input-masks.min.js"></script>	  
      <!--script src="lib\pdfmake\pdfmake.min.js"></script-->
      <!--script src="lib\pdfmake\vfs_fonts.js"></script--> 
      <!-- IF using Sass (run gulp sass first), then uncomment below and remove the CSS includes above
         <link href="css/ionic.app.css" rel="stylesheet">
         -->
      <link href="lib/ionic/css/ionic.css" rel="stylesheet">
      <!--link href="https://code.ionicframework.com/1.3.3/css/ionic.min.css" rel="stylesheet"-->
      <link href="lib/ionic/css/style.css" rel="stylesheet">
      <style type="text/css">
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
      <script src="js/app.js?<?=rand(10000,99999);?>"></script>
      <script src="js/controllers.js?<?=rand(10000,99999);?>"></script>
      <script src="js/routes.js?<?=rand(10000,99999);?>"></script>
      <script src="js/directives.js?<?=rand(10000,99999);?>"></script>
      <script src="js/signature_pad.js?<?=rand(10000,99999);?>"></script>
      <script src="js/doubleBackExit.directive.js?<?=rand(10000,99999);?>"></script>
      <script src="js/services.js?<?=rand(10000,99999);?>"></script>
      <script src="lib/ionicuirouter/ionicUIRouter.js?<?=rand(10000,99999);?>"></script>
      <script src="js/angular-messages.min.js?<?=rand(10000,99999);?>"></script>
      <script src="js/reportBuilderSvc.js?<?=rand(10000,99999);?>"></script>
      <script src="js/reportService.js?<?=rand(10000,99999);?>"></script>
   </head>
   <body ng-app="app" animation="slide-left-right-ios7">
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
            <ion-nav-view></ion-nav-view>
         </div>
      </div>
   </body>
</html>