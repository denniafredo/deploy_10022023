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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Notifikasi</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>To</th>
                        <th>Tittle</th>
                        <th>Message</th>
                        <th>Tipe</th>
                        <th style="width: 13%;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; //variabel no untuk nomor urutnya. ?>
                      <?php foreach($list_notifSoe as $data) { ?>                                                   
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?php echo $data->FULLNAME;?></td>
                          <td><?php echo $data->TITLE;?></td>
                          <td><?php echo substr($data->MESSAGE, 0, 20);?> . . .</td>
                          <td><?php echo $data->TYPE;?></td>
                          <td class="btn-group">
                            <a href = "#" title="Klik untuk detail notifikasi!" class="btn btn-info btn-icon-split btn-sm" id="detail" onClick="detailNotif(<?php echo $data->NOTIFICATION_ID; ?>);">
                              <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                              </span>
                              <span class="text">Detail</span>
                            </a> 
                            <a href = "#" title="Klik untuk push notifikasi!" class="btn btn-primary btn-icon-split btn-sm" id="detail" onClick="pushNotif(<?php echo $data->NOTIFICATION_ID; ?>);" style="pointer-events: <?php echo $data->BUTTON; ?>;">
                              <span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                              </span>
                              <span class="text">Push</span>
                            </a> 
                            <a href = "#" title="Klik untuk delete notifikasi!" class="btn btn-danger btn-icon-split btn-sm" id="detail" onClick="deleteNotif(<?php echo $data->NOTIFICATION_ID; ?>);">
                              <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                              </span>
                              <span class="text">Delete</span>
                            </a> 
                          </td>
                        </tr>
                        <?php $no++; // ini sama saja dengan $no = $no + 1. ?>
                      <?php } ?>  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Detail Modal-->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="">
                    <div class="p-5">
                      <form class="user">
                        <div class="form-group row">
                          <div class="col-sm-12 mb-3 mb-sm-0">
                            <div class="dropdown mb-0">
                            <div class="small mb-1">Pilih Penerima Notifikasi:</div>
                              <input name="penerima" type="text" placeholder="" class="btn btn-light dropdown-toggle col-sm-12 mb-3 mb-sm-0" disabled="disabled">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-12 mb-3 mb-sm-0">
                            <div class="dropdown mb-0">
                            <div class="small mb-1">Tipe Notifikasi:</div>
                              <input name="tipe" type="text" placeholder="" class="btn btn-light dropdown-toggle col-sm-12 mb-3 mb-sm-0" disabled="disabled">
                            </div>
                          </div>
                        </div>
                        <div class="small mb-1">Judul Notifikasi:</div>
                        <div class="form-group">
                          <input name="modalTittleInput" type="text" class="btn btn-light dropdown-toggle col-sm-12 mb-3 mb-sm-0" placeholder="Judul" disabled="disabled">
                        </div>
                        <div class="small mb-1">Pesan Notifikasi:</div>
                        <div class="form-group">
                          <textarea name="modalMessageInput" class="btn btn-light col-sm-12 mb-3 mb-sm-0" style="min-height: 150px; text-align: justify;" disabled="disabled"></textarea>
                        </div>
                        <div class="small mb-1">Konten Notifikasi:</div>
                        <div class="form-group">
                          <textarea name="modalContentInput" class="btn btn-light col-sm-12 mb-3 mb-sm-0" style="min-height: 150px; text-align: justify;" disabled="disabled"></textarea>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Detail Modal-->

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

    <!-- Detail Notif -->
    <script type="text/javascript">
      function detailNotif(id){
        $.ajax({ 
            url : "<?php echo site_url('index.php/C_soeNotifikasiCustom/soenotifDetail/')?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            { 
              console.log(data);
                jQuery.each(data, function(index, item) {
                    //now you can access properties using dot notation
                    $('[name="penerima"]').val(item[0]["FULLNAME"]);
                    $('[name="tipe"]').val(item[0]["TYPE"]);
                    $('[name="modalTittleInput"]').val(item[0]["TITLE"]);
                    $('[name="modalMessageInput"]').val(item[0]["MESSAGE"]);
                    $('[name="modalContentInput"]').val(item[0]["CONTENT"]);
                });
    
                $('#detailModal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail Notifikasi'); // Set title to Bootstrap modal title    
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
      
      function pushNotif(id){
        if (confirm("Apakah anda yakin push notifikasi ini!")) {
          $.ajax({ 
              url : "<?php echo site_url('index.php/C_soeNotifikasiCustom/pushDetail/')?>" + id,
              type: "GET",
              dataType: "JSON",
              success: function(data)
              { 
                console.log(data);
                alert('Sukses push notifikasi');
                location.reload(); 
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('error ' + errorThrown);
                  console.log(XMLHttpRequest);
                  console.log(textStatus);
                  console.log(errorThrown);
              }
          });
        }else{
          txt = "Anda melakukan cancel push notifikasi!";
          alert(txt);
        }
      }
      
      function deleteNotif(id){
        if (confirm("Apakah anda yakin delete notifikasi ini!")) {
          $.ajax({ 
              url : "<?php echo site_url('index.php/C_soeNotifikasiCustom/deleteDetail/')?>" + id,
              type: "GET",
              dataType: "JSON",
              success: function(data)
              { 
                console.log(data);
                alert('Sukses delete notifikasi');
                location.reload(); 
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  console.log('error ' + errorThrown);
                  console.log(XMLHttpRequest);
                  console.log(textStatus);
                  console.log(errorThrown);
              }
          });
        }else{
          txt = "Anda melakukan cancel delete notifikasi!";
          alert(txt);
        }
      }
    </script>
  </body>

</html>
 