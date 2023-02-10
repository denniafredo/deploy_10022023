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
    
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
				DATA PERTANGGUNGAN
			</div>
            <li>
            	Tertanggung : <?= $hasil['namalengkapcalontertanggung'];?>
            </li>
            <li>
             	Uang Asuransi : Rp. <?= number_format($hasil['uangasuransiakdp'],0,'.',',');?> 
            </li>
            <li>
            	Jenis Plan : <?= $hasil['jenisplan'];?> 
            </li>
            <li>
           		Mulai Asuransi : <?= $hasil['mulaiasuransi'];?>  
            </li>
            <li>
            	Kelas Risiko : <?= $hasil['kelasrisiko'];?>  
            </li>
            <li>
            	Premi : Rp. <?= number_format($hasil['premiakdp'],0,'.',',');?> 
            </li>
            <li>
           		Masa Asuransi : <?= $hasil['masaasuransiakdp'];?>  Tahun
            </li>
                <br>
                <div class="well" style="font-weight:bold;font-size:14px;color:#0200FF">
                	Manfaat Asuransi
                </div>
                <?php 
					if ($hasil['jenisplan'] == 'Plan A')
					{
				?>
                <strong>PLAN A</strong>
                <li>
                a. Apabila terjadi risiko meninggal dunia karena kecelakaan terhadap Tertanggung, maka akan dibayarkan 100% Uang Asuransi  Kecelakaan Diri Perorangan sebesar <strong> Rp. <?= number_format($hasil['uangasuransiakdp'],0,'.',',');?>.</strong>
                </li>
                <li>
                b. Apabila terjadi risiko cacad tetap total atau sebagian karena kecelakaan, maka kepada Tertanggung akan dibayarkan maksimal sebesar 250% Uang Asuransi Kecelakaan Diri Perorangan. 
                </li>
                <?php 
					}
					else if ($hasil['jenisplan'] == 'Plan B')
					{
				?>
                <strong>PLAN B</strong>
                <li>
                a. Apabila terjadi risiko meninggal karena kecelakaan dunia terhadap Tertanggung, maka akan dibayarkan 100% Uang Asuransi  Kecelakaan Diri Perorangan sebesar <strong>Rp. <?= number_format($hasil['uangasuransiakdp'],0,'.',',');?>.</strong>
                </li>
                <li>
                b. Apabila terjadi risiko cacad tetap total atau sebagian karena kecelakaan, maka kepada Tertanggung akan dibayarkan maksimal sebesar 250% Uang Asuransi Kecelakaan Diri Perorangan Tabel Terlampir.
                </li>
                <li>
                c. Apabila Tertanggung menjalani Rawat Inap di Rumah Sakit akibat kecelakaan, maka akan dibayarkan sesuai dengan kuitansi atau maksimal 40% Uang Asuransi Kecelakaan Diri Perorangan untuk setiap kasus kecelakaan.
                </li>
			</ul>
            <hr/>
		</div>
	</div>
    <div class="row">
		<div class="col-xs-12">
			<ul class="list-unstyled">
            <br>
                <table style="width:100%" align="center">
                    <tr>
                        <th align="left"><strong>1.  Rawat Inap di Rumah Sakit</strong></th>
                    </tr>
                    <tr>
                        <td><li>* Per Kecelakaan maksimal (Maksimal 2 x Kecelakaan/tahun)</li></td>
                        <td><strong>40%</str ong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*40/100,0,'.',',');?> </td>
                    </tr>
                    <tr>
                        <th align="left"><strong>2.  Cacad Tetap seluruhnya</strong></th>
                    </tr>
                    <tr>
                        <td><li>* Jaminan Atas Resiko</li></td>
                        <td><strong>250%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*250/100,0,'.',',');?> </td>
                    </tr>
                     <tr>
                          <th align="left"><strong>3.  Cacad tetap Sebagian</strong></th>
                    </tr>
                    <tr>
                        <td><li>* Lengan kanan mulai dari pundak kebawah</li></td>
                        <td><strong>70%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*70/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Lengan kiri mulai dari pundak kebawah</li></td>
                        <td><strong>56%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*56/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Lengan kanan mulai dari siku/atas siku kebawah</li></td>
                        <td><strong>65%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*65/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Lengan kiri mulai dari siku/atas siku kebawah</li></td>
                        <td><strong>52%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*52/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Tangan kanan mulai pergelangan/atas pergelangan kebawah</li></td>
                        <td><strong>60%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*60/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Tangan kiri mulai pergelangan/atas pergelangan kebawah</li></td>
                        <td><strong>50%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*50/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Sebelah kaki dari pinggul kebawah</li></td>
                        <td><strong>50%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*50/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Kedua belah kaki dari mata kaki kebawah</li></td>
                        <td><strong>35%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*35/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Penglihatan sebelah mata</li></td>
                        <td><strong>50%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*50/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Pendengaran kedua belah telinga</li></td>
                        <td><strong>50%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*50/100,0,'.',',');?></td>
                    </tr>
                     <tr>
                        <td><li>* Pendengaran sebelah telinga</li></td>
                        <td><strong>15%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*15/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Ibu jari tangan kanan</li></td>
                        <td><strong>25%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*25/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Ibu jari tangan kiri</li></td>
                        <td><strong>20%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*20/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Jari telunjuk kanan</li></td>
                        <td><strong>25%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*25/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Jari telunjuk kiri</li></td>
                        <td><strong>12%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*12/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Salah satu jari selain ibu jari dan jari telunjuk tangan kanan</li></td>
                        <td><strong>5%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*5/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Salah satu jari selain ibu jari dan jari telunjuk tangan kiri</li></td>
                        <td><strong>4%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*4/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Salah satu ibu jari kaki</li></td>
                        <td><strong>4%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*4/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Salah satu jari selain ibu jari kaki</li></td>
                        <td><strong>3%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*3/100,0,'.',',');?></td>
                    </tr>
                    <tr>
                        <td><li>* Maksimal Cacad Tetap Sebagian</li></td>
                        <td><strong>250%</strong></td>
                        <td>Rp. <?= number_format($hasil['uangasuransiakdp']*250/100,0,'.',',');?></td>
                    </tr>
                </table>
       
			</ul>
            <hr/>
		</div>
	</div>
			<?php 
            }
            ?>
    
    
    
    
    
     
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
<style type=”text/css”>
figure{
  width: 400px;
  height: 300px;
  overflow: hidden;
  position: relative;
  display: inline-block;
  vertical-align: top;
  border: 5px solid #fff;
  box-shadow: 0 0 5px #ddd;
  margin: 1em;
}

figcaption{
  position: absolute;
  left: 0; right: 0;
  top: 0; bottom: 0;
  text-align: center;
  font-weight: bold;
  width: 100%;
  height: 100%;
  display: table;
}

figcaption div{
  display: table-cell;
  vertical-align: middle;
  position: relative;
  top: 20px;
  opacity: 0;
  color: #2c3e50;
  text-transform: uppercase;
}

figcaption div:after{
  position: absolute;
  content: "";
  left: 0; right: 0;
  bottom: 40%;
  text-align: center;
  margin: auto;
  width: 0%;
  height: 2px;
  background: #2c3e50;
}

figure img{
  -webkit-transition: all 0.5s linear;
          transition: all 0.5s linear;
  -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
}

figure:hover figcaption{
 background: rgba(255,255,255,0.3);
}

figcaption:hover div{
  opacity: 1;
  top: 0;
}

figcaption:hover div:after{
  width: 50%;
}

figure:hover img{
  -webkit-transform: scale3d(1.2, 1.2, 1);
          transform: scale3d(1.2, 1.2, 1);
}
</style>