<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <link href="<?=base_url("asset/images/favicon.ico")?>" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PT Asuransi Jiwa IFG Agency Information Management System.">
        <meta name="keywords" content="PT Asuransi Jiwa IFG, Agen PT Asuransi Jiwa IFG, PT Asuransi Jiwa IFG AIM">
        <meta name="author" content="IFG">
        <title>Login - PT Asuransi Jiwa IFG AIM</title>
        
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="<?=base_url("asset/midone/css/style.min.css")?>" />
        <!-- END: CSS Assets-->
    </head>
    
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="Midone Tailwind HTML Admin Template" class="w-12" src="<?=base_url("asset/midone/images/favicon.ico")?>">
                        <span class="text-white text-lg ml-3">
                            <span class="font-bold">A</span>gency
                            <span class="font-bold">I</span>nformation
                            <span class="font-bold">M</span>anagement
                            system
                        </span>
                    </a>
                    <div class="my-auto">
                        <img alt="Aplikasi Pendukung Agen Jiwasraya" class="-intro-x w-1/2 -mt-16" src="<?=base_url("asset/midone/images/illustration.svg")?>">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            Aplikasi Pendukung Agen
                            <br>
                            PT Asuransi Jiwa IFG
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white">Semua yang Anda butuhkan ada disini</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Masuk
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center"></div>
                        <div class="intro-x mt-8">
                            <form id="fMasuk" class="validate-form">
                                <input type="text" name="noagen" class="intro-x login__input input input--lg border border-gray-300 block required" placeholder="Nomor Agen" autocomplete="off" autofocus>
                                <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4 required" placeholder="Kata Sandi" autocomplete="off">
                            </form>
                        </div>
                        <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <form id="fOtentikasi" method="post" action="<?=base_url("account/signin-proses")?>">
                                    <input type="hidden" name="sessionid" />
                                    <input type="hidden" name="username" />
                                    <input id="remember-me" name="rememberme" type="checkbox" class="input border mr-2" checked="checked" value="1">
                                    <label class="cursor-pointer select-none" for="remember-me">Biarkan saya tetap masuk</label>
                                </form>
                            </div>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-lupa-password" class="font-bold ">Lupa Kata Sandi</a>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button id="btnMasuk" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Masuk</button>
                        </div>
                        <div class="intro-x mt-10 xl:mt-24 text-gray-700 text-center xl:text-left">
                            © 2021 PT Asuransi Jiwa IFG All Rights Reserved
                            <br>
                            <span class="text-theme-1 font-small text-xs">Served by <?=substr($_SERVER['SERVER_ADDR'],10)?></span>
                        </div>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        
        
        <div class="modal" id="modal-pesan">
            <div class="modal__content">
                <div class="p-5 text-center"> <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                    <div id="modal-pesan-text" class="text-3xl mt-5"></div>
                </div>
                <div class="px-5 pb-8 text-center"> <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Tutup</button> </div>
            </div>
        </div>
        
        <div class="modal" id="modal-lupa-password">
            <div class="modal__content">
                <form id="fKirim" class="validate-form" onsubmit="return false">
                    <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">Kirim Kata Sandi</h2>
                    </div>
                    <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                        <div class="col-span-12 sm:col-span-12">
                            <label>Nomor Agen</label>
                            <input name="noagen-lupa-password" type="text" class="input w-full border mt-2 flex-1 required" placeholder="Nomor Agen" autocomplete="off">
                        </div>
                        <div id="message-lupa-password" class="col-span-12 sm:col-span-12 hidden">
                            <div class="rounded-md flex items-center px-3 py-3 mb-2"> 
                                <i data-feather="info" class="w-5 h-5 mr-2"></i>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 py-3 text-right border-t border-gray-200">
                        <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                        <button id="btnKirim" type="button" class="button w-20 bg-theme-1 text-white">Send</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
        
        <!-- BEGIN: JS Assets-->
        <script src="<?=base_url("asset/midone/js/script.min.js")?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(document).ajaxSend(function() {
                    $("#overlay").fadeIn(300);　
                });
                
                $("#btnMasuk").click(function() {
                    otentikasi();
                });
                $("#fMasuk input").keypress(function(e) {
                    if (e.which == 13) {
                        otentikasi();
                    }
                });
                
                $("#btnKirim").click(function() {
                    lupaSandi();
                });
                $("#fKirim input").keypress(function(e) {
                    if (e.which == 13) {
                        lupaSandi();
                    }
                });
                
                function otentikasi() {
                    if ($("#fMasuk").valid()) {
                        noagen = $("input[name='noagen']").val();
                        password = $("input[name='password']").val();
                        
                        $.ajax({
                            type : 'get',
                            url: "<?=base_url(C_URL_API)?>/master/otentikasi/"+noagen+"/"+password,
                            data : '',
                            //crossDomain:true,
                            dataType: "json",
                            async :false,
                            success : function (data) {
                                if (data.error) {
                                    $("#modal-pesan-text").text(data.message);
                                    $("#modal-pesan").modal('show');
                                } else {
                                    $("input[name='sessionid']").val(data.message.sessionid);
                                    $("input[name='username']").val(noagen);
                                    $("#fOtentikasi").submit();
                                }
                            }
                        }).done(function() {
                            setTimeout(function(){
                                $("#overlay").fadeOut(300);
                            }, 200);
                        });
                    }
                }
                
                function lupaSandi() {
                    if ($("#fKirim").valid()) {
                        noagen = $("input[name='noagen-lupa-password']").val();

                        $.ajax({
                            type : 'get',
                            url: "<?=base_url(C_URL_API)?>/master/kirim-password/"+noagen,
                            data : '',
                            crossDomain:true,
                            dataType: "jsonp",
                            async :false,
                            beforeSend: function (xhr) {
                                $("#message-lupa-password").addClass('hidden');
                                $("#message-lupa-password div").removeClass('bg-theme-17 text-theme-11 bg-theme-18 text-theme-9');
                            }, 
                            success : function (data) {
                                if (data.error) {
                                    $("#message-lupa-password").removeClass('hidden');
                                    $("#message-lupa-password").addClass('bg-theme-17 text-theme-11');
                                    $("#message-lupa-password span").text(data.message);
                                } else {
                                    $("#message-lupa-password").removeClass('hidden');
                                    $("#message-lupa-password").addClass('bg-theme-18 text-theme-9');
                                    $("#message-lupa-password span").text(data.message);
                                }
                            }
                        }).done(function() {
                            setTimeout(function(){
                                $("#overlay").fadeOut(300);
                            }, 200);
                        });
                    }
                }
            });
        </script>
        <!-- END: JS Assets-->
    </body>
</html>