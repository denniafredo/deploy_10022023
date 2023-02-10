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
				Illustrasi ini hanya merupakan pendekatan/proyeksi dari jumlah dana yang diinvestasikan dan bukan merupakan bagian dari kontrak asuransi
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
				PROGRAM JS PROTEKSI KELUARGA
			</div>
		</div>
     </div>
	<hr/>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
				<li>
					 <strong> Disajikan untuk Bapak/Ibu : </strong><?= $hasil['namalengkapcalontertanggung'];?>
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
            <div class="row" align="center">
                <div class="col-xs-12">
                    <div class="well" style="font-weight:bold;font-size:12px">
                    DATA PERTANGGUNGAN
                    </div>
                </div>
            </div>
			<ul class="list-unstyled">
                    <div class="row" align="center">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                            <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                            <th>
                                 Tertanggung
                            </th>
                            <th>
                                 Jumlah
                            </th>
                            <th>
                                 Uang Tertanggung					
                            
                            </th>
                            
                            </tr>
                            </thead>
                            <tbody>
                            <tr>	
                                <td>Tertanggung Ayah</td>
                                
                                <td><?= $hasil['jumlahtertanggungayah'];?></td>
                            
                            
                                <td><?= number_format($hasil['uangtertanggungayah'], 2, ',', '.');?></td>
                            </tr>
                            <tr>	
                                <td>Tertanggung Ibu</td>
                                
                                <td><?= $hasil['jumlahtertanggungibu'];?></td>
                            
                            
                                <td><?= number_format($hasil['uangtertanggungibu'], 2, ',', '.');?></td>
                            </tr>
                            <tr>	
                                <td>Tertanggung Anak1</td>
                                
                                <td><?= $hasil['jumlahtertanggunganak1'];?></td>
                            
                            
                                <td><?= number_format($hasil['uangtertanggunganak1'], 2, ',', '.');?></td>
                            </tr>
                            <tr>	
                                <td>Tertanggung Anak2</td>
                                
                                <td><?= $hasil['jumlahtertanggunganak2'];?></td>
                            
                            
                                <td><?= number_format($hasil['uangtertanggunganak2'], 2, ',', '.');?></td>
                            </tr>
                            <tr>	
                                <td>Tertanggung Anak3</td>
                                
                                <td><?= $hasil['jumlahtertanggunganak3'];?></td>
                            
                            
                                <td><?= number_format($hasil['uangtertanggunganak3'], 2, ',', '.');?></td>
                            </tr>
                            <tr>	
                                <td align="center" style="font-weight:bold">Total JUA</td>
                                
                                <td></td>
                            
                            
                                <td><strong><?= number_format($hasil['totaljuatertanggung'], 2, ',', '.');?></strong></td>
                            </tr>
                            </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                <hr>
                
			</ul>
		</div>
		
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
				<li>
					 <strong> Premi Tahunan : <?= number_format($hasil['premitahunanjsproteksikeluarga'], 2, ',', '.');?></strong>
				</li>
                <li>
					 <strong> Premi Sekaligus : <?= number_format($hasil['premisekaligusjsproteksikeluarga'], 2, ',', '.');?></strong>
				</li>
                <li>
					 Masa Asuransi : <?= $hasil['masaasuransijsproteksikeluarga'];?> Tahun
				</li>
                <li>
					 Mulai Asuransi : <?= $hasil['mulaiasuransijsproteksikeluarga'];?>
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row" align="center">
        <div class="col-xs-12">
            <div class="well" style="font-weight:bold;font-size:12px">
            MANFAAT ASURANSI
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
				<li>
                    Apabila anggota keluarga meninggal dunia karena sakit atau kecelakaan selama Masa Asuransi, maka akan dibayarkan 100% Jumlah Uang Asuransi
                    JS Proteksi Keluarga.
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row" align="center">
        <div class="col-xs-12">
            <div class="well" style="font-weight:bold;font-size:12px">
            ILUSTRASI MANFAAT
            </div>
        </div>
    </div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
				<li>
                    Apabila terjadi risiko Meninggal Dunia terhadap salah seorang Tertanggung pada Masa Asuransi, maka Jiwasraya akan membayarkan sebesar Uang Asuransi <strong>Rp. <?= number_format($hasil['uangasuransipertahunjsproteksikeluarga'], 2, ',', '.');?></strong> kepada Penerima Manfaat.
				</li>
			</ul>
            <hr/>
		</div>
	</div>
    
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