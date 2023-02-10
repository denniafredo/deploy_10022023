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

            <!-- 404 Error Text -->
            <div class="text-center">
              <div class="error mx-auto" data-text="404">404</div>
              <p class="lead text-gray-800 mb-5">Page Not Found</p>
              <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
              <!-- <a href="<?= base_url(); ?>entri">&larr; Back to Dashboard</a> -->
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

  </body>
