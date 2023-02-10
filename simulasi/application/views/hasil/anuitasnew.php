<?php
/*echo '<pre>';
print_r($data);
echo '</pre>';
 * 
 
echo '<pre>';
print_r($hasil);
echo '</pre>';*/

error_reporting(0);
?>
<!-- BEGIN PAGE CONTENT-->
<div class="">
	<div class="row" align="center">
		<div class="col-xs-12">
			<div class="well">
				<address>
				Ilustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi
				<address>
			</div>
		</div>
     </div>
	<div class="row invoice-logo">
    <div class="col-xs-6">
			<p>
				 <h3>PT. ASURANSI JIWASRAYA (PERSERO)</h3>
			</p>
            <p>
				Jl. Ir. H. Juanda No. 34 Jakarta - 10120
			</p>
		</div>
		<div class="col-xs-6 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
    &nbsp;
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px">
				ILUSTRASI MANFAAT PROGRAM ANUITAS PERTANGGUNGAN PERORANGAN
			</div>
		</div>
     </div>
	<hr/>
	<div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px">
				CALON PEMEGANG POLIS
			</div>
				<li>
					 <strong> Nama Pemegang Polis : </strong><?= $hasil['nama'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir : </strong> <?= $hasil['tgl_lahir'];?> / <?= $hasil['usianasabah'];?> Tahun 
				</li>
                <li>
					 <strong>Jenis Kelamin :</strong> <?= $hasil['jenis_kel'];?> 
				</li>
			</ul>
		</div>
		
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px">
				CALON TERTANGGUNG
			</div>
				<li>
					 <strong> Nama Tertanggung : </strong><?= $hasil['namalengkapcalontertanggung'];?>
				</li>
				<li>
					 <strong> Tanggal Lahir : </strong> <?= $hasil['tanggallahircalontertangggung'];?> / <?= $hasil['usiacalontertanggung'];?> Tahun  
				</li>
                <li>
					 <strong>Jenis Kelamin :</strong> <?= $hasil['jeniskelamin'];?> 
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
                <li>
					 <strong> Mulai program Anuitas	: </strong><?= $hasil['saatmulaiasuransi'];?>
				</li>
                 <li>
					 <strong> Premi Sekaligus : </strong> Rp. <?= number_format($hasil['premisekaligusjsanuitas'],0,'.',',');?>
				</li>
               <br>
               <div class="row" align="center">
		
	</div>
                <hr>
                
			</ul>
		</div>
		
	</div>
    
<div style="border: 5px solid #444; padding: 20px; margin-left:20px; margin-right:20px" class="row">
<div class="col-md-6">




</div>

<h3 class="block" align="center">Nilai Anuitas</h3>

<div class="col-md-12">

<div class="table-scrollable">
							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>
											 No.
										</th>
										<th>
											
										</th>
                                        <th>
											
										</th>
                                       
                                        <th>
											PHT
										</th>
                                        <th>
											
										</th>
                                        <th>
											PJD/PYT
										</th>
									</tr>
								</thead>
									
								<tbody>
									
                                    <tr>
										<td>1.</td>
										<td>JS ANUITAS</td>
                                      	<td>Rp.</td>
										<td>
                                        <input class="form-control" placeholder="" type="" name="aikawin" id="aikawin" onChange="" value="<?= number_format($hasil['aikawin'],0,'.',',');?>" readonly>
                                        </td>
                                        <td>Rp.</td>
                                        <td>
                                        <input class="form-control" placeholder="" type="" name="aibujang" id="aibujang" onChange="" value="<?= number_format($hasil['aibujang'],0,'.',',');?>" readonly>
                                        </td>
									</tr>
									
                                    
								</tbody>
							</table>
                            
						</div>
</div>


</div>
    
 <br>  
 <br>  
     
	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-offset-3 col-md-9">
					<a target="_blank" href="<?= base_url().'files/pdf/'.$hasil['filepdf'].'.pdf'; ?>" class="btn green button-submit">
						 Cetak PDF <i class="m-icon-swapright m-icon-white"></i>
					</a>
				</div>
			</div>
		</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<!-- END CONTENT -->