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
    <div class="col-xs-5">
			<p>
				 <h4>PT. ASURANSI JIWASRAYA (PERSERO)</h4>
			</p>
            <p>
				Jl. Ir. H. Juanda No. 34 Jakarta - 10120
			</p>
		</div>
		<div class="col-xs-7 invoice-logo-space" align="right">
			<img src="<?php echo base_url(); ?>/assets/img/logo-js.png" alt=""/>
		</div>
	</div>
    &nbsp;
    <div class="row" align="center">
		<div class="col-xs-12">
			<div class="well" style="font-weight:bold;font-size:16px">
				JS Dana Multi Proteksi
			</div>
		</div>
     </div>
	<hr/>
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				A. DATA
			</div>
				<li>
					 Nama Calon Tertanggung : <strong><?= $hasil['namalengkapcalontertanggung'];?></strong>
				</li>
				<li>
					  Usia Calon : <strong><?= $hasil['usiacalontertanggung'];?></strong> Tahun 
				</li>
                <li>
					 Masa Asuransi : <strong><?= $hasil['masaasuransi'];?></strong> Tahun
				</li>
                <li>
					 Uang Asuransi : <strong>Rp. <?= number_format($hasil['uangasuransipokok'],0,'.',',');?></strong>
				</li>
                 <li>
					 Saat Mulai : <strong><?= $hasil['saatmulaiasuransi'];?></strong>
				</li>
               
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				B. MANFAAT ASURANSI
			</div>
            <br>
            <div>
            <strong style="color:#FF0000">1. Manfaat Akhir Masa Asuransi</strong>
            </div>
				<li>
					 Apabila Tertanggung hidup pada akhir masa asuransi, maka dibayarkan sebesar: <strong>Rp. <?= number_format(3 * $hasil['uangasuransipokok'],0,'.',',');?></strong>
				</li>
                 <br>
            <div>
            <strong style="color:#FF0000">2. Manfaat Santunan Meninggal Dunia</strong>
            </div>
				<li>
					 Apabila Tertanggung meninggal dunia dalam masa asuransi karena sebab apapun yang tidak dikecualikan dalam Syarat Umum Polis (SUP), maka akan dibayarkan sebesar 300% dari Uang Asuransi: <strong>Rp. <?= number_format(3 * $hasil['uangasuransipokok'],0,'.',',');?></strong>
				</li>
                <br>
            <!--div>
            <strong style="color:#FF0000">3. SANTUNAN KELUARGA</strong>
            </div>
				<li>
					 Jika tertanggung meninggal dunia dalam masa asuransi, maka ahli waris akan menerima santunan setiap bulan sebesar 1% Uang Asuransi yang dibayarkan bulan berikutnya sampai dengan akhir masa asuransi atau sebesar : <strong>Rp. <?= number_format((1/100) * $hasil['uangasuransipokok'],0,'.',',');?> /bulan</strong> 
				</li-->
			</ul>
            <hr/>
		</div>
	</div>
    <!--div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				C. JAMINAN TAMBAHAN (RIDER)
			</div>
            
            <table class="table table-striped table-hover">
                
                
                <tbody>
                    <?php
                    if ($hasil['premijsaddbjsdmpplus'] != 0)
                    {
					?>
                    <tr>
                        <td style="">JS ADDB</td>
                        <td>Apabila Tertanggung meninggal dunia atau cacat karena kecelakaan, maka akan dibayarkan 100% Uang Asuransi JS ADDB atau sesuai faktor untuk cacat tetap sebagian. Rp. <?= number_format($hasil['uangasuransijsaddbjsdmpplus'],0,'.',',');?><td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    }
					if ($hasil['premijstpdjsdmpplus'] != 0)
                    {
					?>
                    <tr>
                        <td style="">JS TPD</td>
                        <td>Apabila Tertanggung mengalami cacat tetap total karena sakit atau kecelakaan, maka akan dibayar 100% Uang Asuransi JS TPD. Rp. <?= number_format($hasil['uangasuransijstpdjsdmpplus'],0,'.',',');?><td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    }
					if ($hasil['premiwpjsdmpplus'] != 0)
                    {
					?>
                    <tr>
                        <td style="">JS Waiver Premium</td>
                        <td>Apabila Tertanggung mengalami cacat tetap total karena sakit atau kecelakaan, maka akan dibebaskan dari kewajiban membayar premi. Dan tetap akan menerima manfaat.<td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    }
					if ($hasil['premici53jsdmpplus'] != 0)
                    {
					?>
                    <tr>
                        <td style="">JS CI53</td>
                        <td>Apabila Tertanggung diDiagnosa untuk pertama kali mengalami  satu dari 53 Penyakit Kritis maka kepada tertanggung akan dibayarkan 100% Uang Asuransi JS CI53.<td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    }
					if ($hasil['premijsspdjsdmpplus'] != 0)
                    {
					?>
                    <tr>
                        <td style="">JS SP - Death</td>
                        <td>Apabila Pemegang Polis meninggal dunia, maka Tertanggung akan dibebaskan dari kewajiban pembayaran premi.<td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                    }
					if ($hasil['premijssptpdjsdmpplus'] != 0)
                    {
					?>
                    <tr>
                        <td style="">JS SP - TPD</td>
                        <td>Apabila Pemegang Polis meninggal dunia, maka Tertanggung akan dibebaskan dari kewajiban pembayaran premi.<td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
					}
                    if ($hasil['ri'] != '')
                    {
					?>
                    <tr>
                        <td style="">JS HCP</td>
                        <td>Apabila Tertanggung dirawat di Rumah Sakit maka akan dibayarkan santunan harian sesuai dengan plan yang dipilih. Rp. <?= number_format($hasil['ri'],0,'.',',');?><td>
                        <td><td>
                        <td><td>
                    </tr>
                    <?php
                    }
					if ($hasil['icu'] != '')
					{
					?>
                    <tr>
                        <td style=""></td>
                        <td>Apabila Tertanggung dirawat di ICU maka akan dibayarkan santunan harian sesuai dengan plan yang dipilih. Rp. <?= number_format($hasil['icu'],0,'.',',');?><td>
                        <td><td>
                        <td><td>
                    </tr>
                    <?php
                    }
					if ($hasil['bedah'] != '')
					{
					?>
                    <tr>
                        <td style=""></td>
                        <td>Apabila Tertanggung memerlukan tindakan pembedahan, maka akan dibayarkan santunan sesuai dengan plan yang dipilih. Rp. <?= number_format($hasil['bedah'],0,'.',',');?><td>
                        <td><td>
                        <td><td>
                    </tr>
                    <?php
                    }
					?>
                </tbody>
            </table>
		</div>
	</div-->
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <!--div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				D. PERHITUNGAN PREMI
			</div-->
           
			<div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				C. PEMBAYARAN PREMI
			</div>
            
            <table class="table table-striped table-hover">
                <thead>
                    <!--tr>
                        <th>
                            CARA BAYAR
                        </th>
                        <th>
                             PREMI POKOK
                        </th>
                    </tr-->
                </thead>
                    
                <tbody>
                    
					<tr style="">
                        <td style="">Premi <?=$hasil['carabayarjsdmpplus'];?> 5 Tahun Pertama</td>
                        <td>Rp. <?= number_format($hasil['tabelpremi5tahunpertama'],0,'.',',');?></td>
                    </tr>
                    <tr style="">
                        <td style="">Premi <?=$hasil['carabayarjsdmpplus'];?> 6 Tahun dan Seterusnya</td>
                        <td>Rp. <?= number_format($hasil['tabelpremisekaligus'],0,'.',',');?></td>
                    </tr>
                    <!--tr>
                        <td style="">Premi 5 thn Pertama</td>
                        <td><?= number_format($hasil['tabelpremi5tahunpertama'],0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td style="">Premi Semesteran</td>
                        <td><?= number_format($hasil['tabelpremisemesteran'],0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td style="">Premi Kuartalan</td>
                        <td><?= number_format($hasil['tabelpremikuartalan'],0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td style="">Premi Bulanan</td>
                        <td><?= number_format($hasil['tabelpremibulanan'],0,'.',',');?></td>
                    </tr-->
                </tbody>
            </table>
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