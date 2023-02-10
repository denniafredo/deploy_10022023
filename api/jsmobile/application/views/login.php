<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?php echo $title;?></title>

		<!-- Custom fonts for this template-->
		<link href="<?php echo base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="<?php echo base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
	</head>

	<body class="bg-gradient-primary d-flex align-items-center min-vh-100">
		<div class="container">
			<!-- Outer Row -->
			<div class="row justify-content-center">
				<div class="col-xl-10 col-lg-12 col-md-9">
					<div class="card o-hidden border-0 shadow-lg my-5">
						<div class="card-body p-0">
							<!-- Nested Row within Card Body -->
							<div class="row">
								<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
								<div class="col-lg-6">
									<div class="p-5">
										<div class="text-center">
											<h1 class="h4 text-gray-900 mb-4">Welcome SOE!</h1>
										</div>
										<form class="user" id="form_login" name="form_login">
											<div class="form-group">
												<input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username...">
											</div>
											<div class="form-group">
												<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
											</div>
											<div class="form-group">
												<div class="custom-control custom-checkbox small">
													<input type="checkbox" class="custom-control-input" id="customCheck">
													<label class="custom-control-label" for="customCheck">Remember Me</label>
												</div>
											</div>
											<tr>
												<td colspan=2 align=center>
													<input class="btn btn-primary btn-user btn-block" id="btnLogin" type=button value="Login" onClick="Login()">
												</td>
											</tr>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript-->
		<script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Core plugin JavaScript-->
		<script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

		<!-- Custom scripts for all pages-->
		<script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

		<!-- Login-->
		<script type="text/javascript">
			document.onkeydown=function(evt){
		        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
		        if(keyCode == 13)
		        {
		            //your function call here
		            Login();
		        }
		    }

			function Login(){
				if( document.form_login.username.value == "" ){
	                alert( "Mohon isi Username anda!" );
	                document.form_login.username.focus() ;
	                return false;
	            }else if( document.form_login.password.value == "" ){
	                alert( "Mohon isi Password anda!" );
	                document.form_login.password.focus() ;
	                return false;
	            }

		        var arraypost = {};
		            arraypost['username']	= $("#username").val();
		            arraypost['password']	= $("#password").val();

				//Ubah tulisan pada button saat click login
				$('#btnLogin').attr('value','Silahkan tunggu . . .');

				//Gunakan jquery AJAX
				$.ajax({ 
		            url : "<?= base_url(); ?>" +"index.php/C_soeNotifikasiCustom/validation",
		            type: "POST",
		            data: arraypost,
		            success: function(data)
		            { 	      	
		              	if(data == 'sukses'){
							window.location.href = "<?= base_url(); ?>entri";            		
		              	}else{
		              		alert('Login Gagal, periksa kembali username dan password Anda!'); 
			                location.reload(); 
		              	}
		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                console.log('error ' + errorThrown);
		                console.log(XMLHttpRequest);
		                console.log(textStatus);
		                console.log(errorThrown);
		            }
		        });
			}
		</script>
	</body>

</html>
