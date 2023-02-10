<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);
 $DBX=New database($userid, $passwd, $DBName);		
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 

if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}

 $query="select prefixpertanggungan, nopertanggungan,  TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
		 WHERE   a.nopenagih=p.nopenagih
				 --and a.nopenagih='$nopenagih'
				 AND p.KDRAYONPENAGIH='$kdkantor'
				 AND a.kdpertanggungan = '2'
				 AND a.kdstatusfile = '1'
				 AND a.kdcarabayar <> 'X'
				 AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3')
				 AND a.kdvaluta='$kdvaluta' ".$cara."
				 AND MOD (
					   MONTHS_BETWEEN (
						  TO_DATE ('".$tglcari."', 'YYYYMM'),
						  TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
					   ),
					   DECODE (a.kdcarabayar,
							   '1',
							   1,
							   'M',
							   1,
							   '2',
							   3,
							   'Q',
							   3,
							   '3',
							   6,
							   'H',
							   6,
							   '4',
							   12,
							   'A',
							   12,
							   'E',
							   12,
							   'J',
							   12)
					) = 0 
					AND NOT EXISTS (
					SELECT   'X'
					  FROM   $DBUser.TABEL_UL_BENEFIT_KLAIM
					 WHERE       PREFIXPERTANGGUNGAN = a.PREFIXPERTANGGUNGAN
							 AND NOPERTANGGUNGAN = a.NOPERTANGGUNGAN
							 AND TO_DATE ( '".$tglcari."'||TO_CHAR(SYSDATE, 'DD') , 'YYYYMMDD')
							 BETWEEN TGLMULAI AND TGLSELESAI)";
//echo $query;
$DBX->parse($query);
$DBX->execute();				
while ($arr=$DBX->nextrow()) {			

	
	 $sql = "SELECT ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, ptg.nopertanggungan NOPERTANGGUNGAN, ptg.nopol,
		   ptg.notertanggung,decode(ptg.indexawal,0,1,ptg.indexawal) indexawal, to_char(sysdate,'dd/mm/yyyy') tgl,
		   CASE
				WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
				THEN
				   PREMI2
				ELSE
				   PREMI1
			 END
				PREMI,
		   TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
		   (SELECT   GRACEPERIODE*30
				FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			   WHERE   kdproduk = ptg.kdproduk) gp,
		   (SELECT   NAMACARABAYAR
				FROM   $DBUser.TABEL_305_CARA_BAYAR
			   WHERE   kdcarabayar = ptg.kdcarabayar) CARA,
		   (SELECT   NAMAVALUTA
				FROM   $DBUser.TABEL_304_VALUTA
			   WHERE   kdvaluta = ptg.kdvaluta) valuta,
		   (SELECT   namaproduk
				FROM   $DBUser.TABEL_202_PRODUK 
			   WHERE   kdproduk = ptg.kdproduk) produk,
			(SELECT  noaccount from $DBUser.TABEL_100_KLIEN_ACCOUNT where jenis='VA' and kdbank='BNI'
			  and prefixpertanggungan=ptg.prefixpertanggungan and nopertanggungan=ptg.nopertanggungan) virtual,
			(SELECT  kdmapping from $DBUser.TABEL_001_kantor where kdkantor=ptg.prefixpertanggungan) mapping,
			(SELECT namaklien1
			  FROM $DBUser.tabel_100_klien kli
			 WHERE kli.noklien = ptg.nopemegangpolis) PEMPOL,
		   (SELECT alamattagih01||' '||alamattagih02
			  FROM $DBUser.tabel_100_klien kli
			 WHERE kli.noklien = ptg.notertanggung) ALAMAT,
			(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
			  FROM $DBUser.tabel_100_klien kli
			 WHERE kli.noklien = ptg.nopemegangpolis) anda,
			(SELECT namakotamadya
			  FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
			 WHERE kli.noklien = ptg.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
			 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas
	  FROM $DBUser.tabel_200_pertanggungan ptg
	 WHERE ptg.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' AND ptg.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";
	
			//echo $sql;
	
	 $DB->parse($sql);
	 $DB->execute();
	 $row=$DB->nextrow();
	 
	?>
	<title>Jatuh Tempo Premi</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<!--POLIS NO. : <?//=$row["PREFIXPERTANGGUNGAN"];?>-<?//=$row["NOPERTANGGUNGAN"];?>-->
	<!--<body onLoad="window.print();window.close()">-->
	<style type="text/css">
	<!--
	.style2 {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 9px;
	}
	.style5 {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
	}
	.style7 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
	.style8 {font-size: 9px}
	.style10 {font-family: Arial}
	.style11 {font-size: 12px}
	-->
	</style>
    <style> 
	@page { size 8.5in 11in; margin: 2cm } 
	div.page { page-break-after: always } 
	</style>
	
    <? echo "<div class='page'><br /><br />";?>
    
    <body onLoad="alert('Untuk menghilangkan header dan footer, Klik File>Page Setup, Kosongkan kolom header dan footer!');">
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
	  <tr>
		<td width="100%" style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1"><table width="100%" border="0" cellspacing="0" cellpadding="3">
		   <tr>
			<td height="27" class="style5">&nbsp;</td>
			<td class="style5"></td>
		  </tr>
		  
		  <tr>
			<td height="27" class="style5">&nbsp;</td>
			<td class="style5"><div align="right"><?=ucwords(strtolower($KTR->kotamadya)).', '.$row["TGL"];?> </div></td>
		  </tr>
		</table>
		<div align="justify" class="style5">      
			<p>Kepada Yth.<br>
			  <?=$row["ANDA"];?>. 
			  <?=$row["PEMPOL"];?>
			  <br> 
			  <?=$row["ALAMAT"];?>
			  <br>
			  <?=$row["KOTA"];?>
			  <br>
			  <br>
			  <br>
			  </font> </p>
			<p><strong>Perihal : PEMBERITAHUAN JATUH TEMPO PEMBAYARAN PREMI </strong></p>
			<p class="style11">Pemegang Polis Yang Terhormat, </p>
		</div>
		<p align="justify" class="style5">Terima kasih atas kepercayaan <?=$row["ANDA"];?> kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi <?=$row["ANDA"];?> dan keluarga.</p>
		<p align="justify" class="style5">Berikut ini adalah data Polis <?=$row["ANDA"];?> :</p>
		<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
		  <tr>
			<td width="50" valign="top" class="style5">&nbsp;</td>
			<td width="325" valign="top" class="style5">Nomor Polis</td>
			<td width="12" valign="top" class="style5">:</td>
			<td width="358" valign="top" class="style5"> <?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?> / <?=$row["NOPOL"];?></td>
			</tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Nama Pemegang Polis</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["PEMPOL"];?></td>
			</tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Jenis Produk</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["PRODUK"];?></td>
			</tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Valuta</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["VALUTA"];?></td>
			</tr><? $newvaluta = $row["VALUTA"];// add by salman 10/10/2012
					?>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Mulai Asuransi</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["MULAS"];?></td>
		  </tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Cara Pembayaran Premi</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["CARA"];?></td>
			</tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Premi terakhir yang sudah dilunasi per</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["LUNAS"];?></td>
		  </tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Jatuh tempo pembayaran Premi pada tanggal</td>
			<td class="style5">:</td>
			<td class="style5"><?=$arr["TGLEXP"];?></td>
		  </tr>
		  <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Jumlah Premi sebesar</td>
			<td class="style5">:</td>
			<td class="style5"><? if ($newvaluta == 'RUPIAH TANPA INDEKS'){		// add by salman 10/10/2012						
									echo number_format($row["PREMI"],2,",",".");
								  }
								  else{
									echo number_format($row["PREMI"]/$row["INDEXAWAL"],2,",","."); // end add by salman 10/10/2012
								  }?></td>
		  </tr>
           <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Nomor Virtual Account</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["VIRTUAL"];?></td>
		  </tr>
           <tr>
			<td class="style5">&nbsp;</td>
			<td class="style5">Nomor Host to Host</td>
			<td class="style5">:</td>
			<td class="style5"><?=$row["MAPPING"].$row["NOPERTANGGUNGAN"];?></td>
		  </tr>
		</table>
		<p align="justify" class="style5">Mohon untuk dapat melakukan pembayaran premi tersebut diatas sebelum masa leluasa pembayaran (grace period) <strong>yaitu 
			<?=$row["GP"];?>
		  hari </strong>setelah tanggal jatuh tempo premi, hal ini untuk menjaga kesinambungan manfaat Polis <?=$row["ANDA"];?>. Keterlambatan pembayaran premi ataupun hal-hal lainnya yang menyebabkan premi tidak terbayarkan dan melewati masa leluasa pembayaran, akan menyebabkan manfaat polis terhenti dan polis menjadi <em><strong>Lapse/Batal.</strong></em></p>
		<p align="justify" class="style5"><span class="style5">Dalam hal pembayaran Premi telah dilakukan oleh <?=$row["ANDA"];?> dan atau data Polis di atas tidak sesuai, dapat menghubungi PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau email : asuransi@ifg-life.co.id.</span>    </p>
		<p align="justify" class="style5">Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.</p>
		<p align="justify" class="style5">Hormat kami <br>
		  PT ASURANSI JIWA IFG<br><br><br><br><br>
		</p>
		<table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
		  <tr>
			<td><div align="justify"><span class="style7">Untuk informasi lebih lanjut tentang cara bayar premi melalui <em><strong>Auto Debet / Virtual Account</strong></em>, <em><strong>Pelayanan Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya</strong></em> dapat menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau email : asuransi@ifg-life.co.id.</span></div></td>
		  </tr>
		</table>    
		<p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
	  </tr>
	  <tr>
		<td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
	  </tr>
	</table>
<? 
echo "</div>";
};?>
<br/><br/>
</body>
</html>