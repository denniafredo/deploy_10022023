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

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  </head>

  <body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <!-- Sidebar -->    
          <!-- include your header view here -->
          <?php $this->load->view('fragment/sidebar'); ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
            <!-- include your header view here -->
            <?php $this->load->view('fragment/topbar'); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Entri Notifikasi</h6>
            </div>
            <div class="card-body">
              <!-- <div class="card o-hidden border-0 shadow-lg my-5"> -->
                <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row">
                    <div class="col-lg-7">
                      <div class="p-5">
                        <div class="text-center">
                          <h1 class="h4 text-gray-900 mb-4">Buat Notifikasi</h1>
                        </div>
                        <form class="user" id="form_entri" name="form_entri">
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <div class="dropdown mb-0">
                              <div class="small mb-1">Pilih Penerima Notifikasi:</div>
                                <select id="list_klien" name="list_klien" class="btn btn-light dropdown-toggle col-sm-12 mb-3 mb-sm-0">
                                    <option value="" >Semua</option>
                                    <?php foreach($list_klien as $data) { ?>                                                          
                                        <option value="<?php echo $data->NO_KLIEN;?>" class="dropdown-item"><?php echo $data->FULLNAME;?></option>
                                    <?php } ?>  
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                              <div class="dropdown mb-0">
                              <div class="small mb-1">Tipe Notifikasi:</div>
                                <select id="list_type" name="list_type" class="btn btn-light dropdown-toggle col-sm-12 mb-3 mb-sm-0">
                                    <option value="NEWS" >News</option>
                                    <option value="PROMO" >Promo</option>
                                    <option value="INFO" >Info</option>
                                    <option value="PAYMENT" >Payment</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="small mb-1">Isi Notifikasi:</div>
                          <div class="form-group row col-sm-6 mb-3">
                            <input type="text" class="form-control form-control-user" id="tittleInput" placeholder="Judul" maxlength="150">
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="messageInput" placeholder="Pesan" maxlength="400">
                          </div>
                          <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="contentInput" placeholder="Konten" maxlength="4000">
                          </div>
                          <a href="#" class="btn btn-info btn-user btn-block" onClick="insertNotif()">
                            Submit
                          </a>
                        </form>
                      </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                  </div>
                </div>
              <!-- </div> -->
            </div>
          </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->      
          <!-- include your footer view here -->
          <?php $this->load->view('fragment/footer'); ?>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
      <!-- include your logout modal view here -->
      <?php $this->load->view('fragment/logoutModal'); ?>
    <!-- End of Logout Modal-->

    <!-- Javascript Include -->
      <!-- include your logout modal view here -->
      <?php $this->load->view('fragment/javascriptInclude'); ?>
    <!-- End of Javascript Include -->

    <!-- Insert Notif-->
    <script type="text/javascript">
      document.onkeydown=function(evt){
          var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
          if(keyCode == 13)
          {
              //your function call here
              insertNotif();
          }
      }
      
      function insertNotif(){
        if( document.form_entri.tittleInput.value == "" ){
            alert( "Mohon kolom judul diisi terlebih dahulu!" );
            document.form_entri.tittleInput.focus() ;
            return false;
        }else if( document.form_entri.messageInput.value == "" ){
            alert( "Mohon kolom pesan diisi terlebih dahulu!" );
            document.form_entri.messageInput.focus() ;
            return false;
        }else if( document.form_entri.contentInput.value == "" ){
            alert( "Mohon kolom konten diisi terlebih dahulu!" );
            document.form_entri.contentInput.focus() ;
            return false;
        }

        var txt;        
        var arraypost = {};
            arraypost['list_klien']     = $("#list_klien").val();
            arraypost['list_type']      = $("#list_type").val();
            arraypost['tittleInput']    = $("#tittleInput").val();
            arraypost['messageInput']   = $("#messageInput").val();
            arraypost['contentInput']   = $("#contentInput").val();

        //Ubah tulisan pada button saat click login
        $('#btnLogin').attr('value','Silahkan tunggu . . .');

        if (confirm("Apakah anda setuju menginputkan data ini!")) {
          // Gunakan jquery AJAX
          $.ajax({
            method: "POST",
            url: "<?= base_url(); ?>" +"index.php/C_soeNotifikasiCustom/notifInsert",
            cache: false,
            data: arraypost,
            success: function(msg){
                alert(msg);
                location.reload();  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert('error ' + errorThrown);
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            }
          });
        }else{
          txt = "Anda melakukan cancel konfirmasi!";
          alert(txt);
        }
      }
    </script>

  </body>
