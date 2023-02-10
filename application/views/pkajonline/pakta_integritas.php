<?php 
function hari_ini(){
	$hari = date ("D");
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
 
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
}
?>
<? for($i=0;$i<26;$i++){ ?>
<tr>
	<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
	</td>
</tr>
<? } ?>
<!-- akhir line code untuk enter next page -->
<tr>
	<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
	</td>
</tr>
<tr style="height: 7.5pt">
	<td width="615" colspan="11" valign="top" style="width: 461.4pt; height: 7.5pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" align="center" style="text-align: center"><b>
	<span lang="IN" style="font-family: Arial,sans-serif">PAKTA INTEGRITAS</span></b></td>
</tr>
<tr>
	<td width="615" colspan="11" valign="top" style="width: 461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt; margin-right: -5.4pt; margin-top: 0in; margin-bottom: .0001pt">
	<span lang="IN" style="font-family: Arial,sans-serif">Saya yang tersebut di bawah ini selaku <?= $agenName; ?> PT. Asuransi Jiwa IFG, menyatakan berkomitmen untuk:</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">1.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">Melaksanakan tugas dan kewajiban secara jujur, profesional serta memegang teguh prinsip-prinsip <i>Good Corporate Governance</i> (GCG) yang meliputi <i>Transparency, Accountability, Responsibility, Independency</i> dan <i>Fairness</i> demi kemajuan Perusahaan.</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">2.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">Tidak akan melakukan Korupsi, Kolusi dan Nepotisme (KKN) serta tidak akan memberi dan/atau menerima sesuatu dalam bentuk apapun berupa suap baik secara langsung maupun tidak langsung.</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">3.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Tidak akan menyalahgunakan kewenangan jabatan, baik secara langsung maupun tidak langsung untuk kepentingan pribadi, kelompok maupun golongan  tertentu.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">4.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Menjaga nama baik, martabat dan kehormatan Perusahaan serta menghindarkan diri dari perbuatan tercela.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">5.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Mematuhi dan tunduk pada ketentuan sebagaimana diatur dalam Perjanjian Keagenan, termasuk dalam melaksanakan seluruh hak dan kewajibanya.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">6.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Tidak melakukan aktivitas penjualan dengan cara melakukan <i>Churning</i> dan <i>Twisting</i>  yang akan mengakibatkan kerugian terhadap Perusahaan dan Nasabah.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">7.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Dalam melakukan Aktivitas penjualan tidak menerima titipan premi/produksi atau menitipkan premi/Produksi dari/kepada siapapun yang mempunyai kepentingan sehingga mengakibatkan kerugian bagi Perusahaan maupun orang lain dan apabila dikemudian hari diketahui adanya aktivitas titipan premi/produksi atau menitipkan premi/Produksi tersebut maka bersedia ditindak berupa pemberhentian tidak hormat dari Perusahaan.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">8.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Tidak menerima pembayaran premi dari Nasabah baik itu premi pertama maupun premi lanjutan dan apabila dikemudian hari diketahui menerima pembayaran premi dari Nasabah ,bersedia ditindak berupa pemberhentian tidak hormat dari Perusahaan.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">9.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Selalu melaksanakan tugas dengan penuh tanggung jawab, semangat kerja yang tinggi, berbagi ilmu (<i>sharing knowlegde</i>) serta siap membantu rekan ataupun unit kerja lain demi kemajuan Perusahaan.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">10.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Menjaga kerahasiaan semua data, informasi dan dokumen Perusahaan yang bersifat <i>confidential</i> kepada pihak-pihak yang tidak berkepentingan.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">11.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Tidak akan memberi/membuat janji kepada siapa pun juga yang terkait dengan jabatan dan kedudukan di Perusahaan dimana pemberian serta janji tersebut bertentangan dengan ketentuan Perusahaan.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">12.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Tidak akan menerima/meminta/memaksa seseorang untuk memberikan hadiah, upeti atau gratifikasi apapun yang patut diduga terkait dengan jabatan yang diemban dan dapat mempengaruhi kewajiban serta integritas dalam pelaksanaan tugas.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">13.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Tidak memberikan janji atau komitmen baik yang bersifat material seperti berupa <i>cash back, kick back, fee</i>, pengembalian komisi dan sebagainya maupun imaterial seperti kedudukan, jabatan, posisi dan lain sebagainya terutama kepada nasabah atau calon nasabah yang tidak sesuai dengan ketentuan/norma yang berlaku di Perusahaan.
	</span></td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif">14.</span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Mematuhi segala ketentuan yang berlaku di Perusahaan.
	</span></td>
</tr>
<tr height="0">
	<td width="29" style="border: medium none">&nbsp;</td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif"></span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Demikian pernyataan ini saya tandatangani dengan penuh kesadaran, tanggung jawab  serta tidak ada paksaan dari pihak manapun. Apabila saya melanggar Pakta Integritas ini, saya bersedia dikenakan sanksi sesuai dengan peraturan yang berlaku.
	</span></td>
</tr>
<tr height="0">
	<td width="29" style="border: medium none">&nbsp;</td>
</tr>
<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif"></span></td>
	<td width="432"  colspan="12" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	Semoga Tuhan Yang Maha Esa senantiasa memberikan perlindungan kepada kita semua untuk melaksanakan pakta integritas ini.
	</span></td>
</tr>

<tr>
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif"></span></td>
	<td width="432"  colspan="4" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
	<span lang="IN" style="font-family: Arial,sans-serif">
	<?= hari_ini();?>, <?php echo tgl_indo(date("d-m-Y"));?>
	</span></td>
</tr>

<!-- <tr>
	<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
	</td>
</tr>

<tr>
	<td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt">
		<span lang="IN" style="font-family: Arial,sans-serif">&nbsp;</span></p>
	</td>
</tr> -->

<tr>
	<!-- <td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif"></span></td> -->
	<!-- <td width="432"  colspan="10" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"> -->
	<td valign="top" style="width: 15px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<p class="MsoNormal" style="text-align: justify">
	<span style="font-family: Arial,sans-serif"></span></td>
	<td width="432"  colspan="4" valign="top" style="width:  461.4pt; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in">
	<!-- <td colspan="10" valign="top" style="width: 538px; padding-left: 5.4pt; padding-right: 5.4pt; padding-top: 0in; padding-bottom: 0in"> -->
	<?php foreach($pkaj as $i => $row) { 
		if($row["STATUS"] == 0){echo "<br /><br /><br /><br /><br />";}else{
	?>
		<p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"><strong>&nbsp;</strong><img src="https://chart.googleapis.com/chart?chs=130x130&cht=qr&chl=<?=$row["QRAGEN"];?>&choe=UTF-8&chld=H|0" /></p>
		<br/>
		<?php } ?>
		<?=$row["NAMAKLIEN1"];?>
		<br/>
	<?}?>
	<!-- <p class="MsoNormal" style="text-align: justify; margin-left: -5.4pt"> -->
	<span lang="IN" style="font-family: Arial,sans-serif">
	<?= $agenName; ?>
	</span></td>
</tr>


