<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=base_url()?>asset/css/news.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/pricing-table.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/plugin/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>asset/css/portfolio.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<div class="container">
    <!-- BEGIN PAGE BREADCRUMB -->
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <?=$this->template->title?>
        </li>
    </ul>
    <!-- END PAGE BREADCRUMB -->

    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="row margin-top-10">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12 news-page">
							<div class="row">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-text-o font-green-sharp"></i>
                                            <span class="caption-subject font-green-sharp bold uppercase">List Akun Jaim</span>
                                        </div>
                                    </div>
									<div class="portlet-body">
                                       <table id="tabel-data" class="display" style="width:100%">
											<thead>
												<tr>
													<th>No</th>
													<th>Username</th>
													<th>Nama Agen</th>
													<th>Password</th>
													<th>Jabatan</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											 <?php $no = 1; 
											 foreach ($list as $list_account => $data) { ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= $data['USERNAME'];?></td>
												<td><?= $data['NAMAKLIEN1'];?></td>
												<td><?= "*****";?></td>
												<td><?= $data['NAMAROLE'];?></td>
												<td>
												<button class="btn btn-success mt-3 btn-sm" onclick="resetpassword(<?=$no;?>)"  id='reset_<?=$no;?>'>Reset Password</button>
												<input type='hidden' id='iduser_<?=$no;?>' value='<?=$data['IDUSER'];?>'/>
												<input type='hidden' id='username_<?=$no;?>' value='<?=$data['USERNAME'];?>'/>
												</td>
											</tr>
											<?php } ?>
											</tbody>
										</table>
									</div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?=base_url()?>asset/plugin/jquery-mixitup/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asset/plugin/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.js"></script>


<script>
	//data table
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
	
	function resetpassword(no){
	let iduser = document.getElementById('iduser_'+no).value;
	let username = document.getElementById('username_'+no).value;
	//swall
	Swal.fire({
		  title: 'Apakah Kamu Yakin?',
		  text: "Ingin Melakukan Reset Password",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes'
		}).then((result) => {
		  if (result.isConfirmed) {
			Swal.fire(
			  'Saved',
			  'Reset Password Telah Berhasil',
			  'success'
			)
			setTimeout(function () {
                window.location.href = "resetpassword/" + iduser + '/' + username;
            }, 1000);  
		  }
		})
	}
</script>