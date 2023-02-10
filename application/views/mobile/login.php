<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>JAIM | Login Form</title>
    <link rel="shortcut icon" href="<?=base_url()?>asset/img/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <!--link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/-->
    <link href="<?=base_url()?>asset/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/plugin/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/plugin/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?=base_url()?>asset/plugin/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->

    <!-- BEGIN THEME STYLES -->
    <link href="<?=base_url()?>asset/css/components-rounded.min.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="<?=base_url()?>asset/css/themes/default.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>asset/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->

    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="#">
        <!--img src="<?=base_url()?>asset/img/logo-big.png" alt=""/--><span class="logo-default">JAiM</span>
        <br>Jiwasraya Agency Information Management
    </a>
</div>
<!-- END LOGO -->

<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->

<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="<?="$this->url/login_proses"?>" method="post">
        <h3 class="form-title">Masuk ke akun Anda</h3>
        <div class="alert alert-danger <?=$tampilkan?>">
            <button class="close" data-close="alert"></button>
            <span><?=$pesan?></span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" autofocus/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Kata Sandi</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Kata Sandi" name="password"/>
            </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"/> Biarkan saya tetap masuk </label>
            <button type="submit" class="btn blue pull-right">
                Masuk <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
        <div class="forget-password">
            <h4>Lupa Kata Sandi ?</h4>
            <p>
                klik <a href="javascript:;" id="forget-password">
                    disini </a>
                untuk mereset kata sandi anda.
            </p>
        </div>
        <!--div class="create-account">
            <p>
                Belum memiliki akun ?&nbsp; <a href="javascript:;" id="register-btn">
                Registrasi </a>
            </p>
        </div-->
    </form>
    <!-- END LOGIN FORM -->

    <!-- BEGIN FORGOT PASSWORD FORM -->
    <div class="forget-form">
        <h3>Lupa Kata Sandi ?</h3>
        <p>
            Masukkan alamat no agen & email yang telah didaftarkan untuk reset kata sandi.
        </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="No Agen" name="noagenreset"/>
            </div>
        </div>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="emailreset"/>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn">
                <i class="m-icon-swapleft"></i> Kembali
            </button>

            <button type="button" id="btn-reset" class="btn blue pull-right">
                Reset Password <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </div>
    <!-- END FORGOT PASSWORD FORM -->

    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="../index.html" method="post">
        <h3>Registrasi</h3>
        <p>
            Daftarkan email anda untuk reset password
        </p>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email"/>
            </div>
        </div>

        <p>
            Silakan isi informasi akun di bawah ini
        </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="No Agen" name="username"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Kata Sandi" name="password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Ulangi Kata Sandi" name="rpassword"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="tnc"/> Saya sudah membaca dan menyetujui
                <a href="#"> Syarat dan Ketentuan</a>, serta
                <a href="#">Kebijakan Privasi</a>
            </label>
            <div id="register_tnc_error">
            </div>
        </div>
        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn">
                <i class="m-icon-swapleft"></i> Kembali </button>
            <button type="submit" id="register-submit-btn" class="btn blue pull-right">
                Bergabung <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->

<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2015 &copy; JAiM - Divisi TI & Keagenan.
</div>
<!-- END COPYRIGHT -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?=base_url()?>asset/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=base_url()?>asset/plugin/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/plugin/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/select2/select2.min.js"></script>
<script src="<?=base_url()?>asset/plugin/bootstrap-toastr/toastr.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=base_url()?>asset/js/metronic.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/layout.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/demo.js" type="text/javascript"></script>
<script src="<?=base_url()?>asset/js/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
        // init background slide images
        /*$.backstretch([
                "../asset/bg/1.jpg"
                //"../asset/bg/2.jpg",
                //"../asset/bg/3.jpg",
                //"../asset/bg/4.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
        );*/

        /*===== toastr notification =====*/
        toastr.options = {
            "closeButton": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "0",
            "hideDuration": "0",
            "timeOut": "0",
            "showMethod": "fadeIn"
        };
        /*===== end of toastr notification =====*/

        // ajax kirim email password
        $("#btn-reset").click(function() {
            $("#btn-reset").hide();
            var noagen = $("input[name='noagenreset']").val();
            var email = $("input[name='emailreset']").val();

            $.ajax({
                url: "<?="$this->account_url/ajax-sent-password"?>",
                type: "post",
                data: "id="+noagen+"&email="+email,
                success: function (data) {
                    if (data == "<?=C_STATUS_GAGAL_RESET_NOAGEN?>")
                        toastr.error('Oo tidaak, no agen tidak ditemukan di JLINDO');
                    else if (data == "<?=C_STATUS_GAGAL_RESET_EMAIL?>")
                        toastr.error('Oo tidaak, email tidak ditemukan atau belum terdaftar di JLINDO');
                    else if (data == "<?=C_STATUS_GAGAL_KIRIM?>")
                        toastr.error('Oo tidaak, password gagal dikirim ke email');
                    else if (data == "<?=C_STATUS_SUKSES_KIRIM?>")
                        toastr.success('Oo yeaah, password berhasil dikirim, silahkan cek inbox & spam email anda.');
                    else if (data == "<?=C_STATUS_GAGAL_EMAIL_SANDI_KOSONG?>")
                        toastr.error('Oo tidaak, no agen atau email tidak boleh kosong.');

                    $("#btn-reset").show();
                }
            })
        });
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>