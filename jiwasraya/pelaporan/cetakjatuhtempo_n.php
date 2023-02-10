<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);
 $DBX=New database($userid, $passwd, $DBName);
 $DBP=New database($userid, $passwd, $DBName);		
 
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

 $query="select prefixpertanggungan, nopertanggungan,  TO_CHAR(mulas, 'DD') tmulas, TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
		 WHERE   a.nopenagih=p.nopenagih
				 --AND p.KDRAYONPENAGIH='$kdkantor'
				 AND a.kdpertanggungan = '2'
				 AND a.kdstatusfile = '1'
				 AND a.kdcarabayar <> 'X'
				 AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')
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
					) = 0  and a.PREFIXPERTANGGUNGAN = '$prefixpertanggungan'
							 AND a.NOPERTANGGUNGAN = '$nopertanggungan'
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

	
	 $sql = "SELECT ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, ptg.nopertanggungan NOPERTANGGUNGAN, ptg.nopol,norekeningdebet,
	 		case
				when (SELECT   (NAMAKLIEN1)
				FROM   $DBUser.TABEL_100_KLIEN
			   WHERE   noklien = ptg.nopenagih) like '%AUTODEBET%' then substr(norekeningdebet,1,3)||'******'||substr(norekeningdebet,-3)
			end rek,
		   ptg.notertanggung,decode(ptg.indexawal,0,1,ptg.indexawal) indexawal, to_char(sysdate,'dd/mm/yyyy') tgl,
		   TO_CHAR(add_months(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD'),1)-1,'DD/MM/YYYY') tglexp1,
		   TO_CHAR(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD')+(SELECT   GRACEPERIODE*30
				FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			   WHERE   kdproduk = ptg.kdproduk),'DD/MM/YYYY') tglexp,
			TO_CHAR(TO_DATE ('".$tglcari.$arr["TMULAS"]."', 'YYYYMMDD')+(SELECT   GRACEPERIODE*30
				FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			   WHERE   kdproduk = ptg.kdproduk)+1,'DD/MM/YYYY') tglbpo,
		   CASE
				WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
				THEN
				   PREMI2
				ELSE
				   PREMI1
			 END
				PREMI,
		   TO_CHAR(mulas,'DD/MM/YYYY') MULAS,to_char(sysdate,'dd/mm/yyyy') cetak,
		   (select SUM(PREMITAGIHAN) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=ptg.prefixpertanggungan and nopertanggungan=ptg.nopertanggungan and tglseatled is null) PREMITAGIHAN,
		   (SELECT   GRACEPERIODE*30
				FROM   $DBUser.TABEL_241_GRACE_PERIODE 
			   WHERE   kdproduk = ptg.kdproduk) gp,
		   (SELECT   (NAMAKLIEN1)
				FROM   $DBUser.TABEL_100_KLIEN
			   WHERE   noklien = ptg.nopenagih) PENAGIH,
		   (SELECT   NAMACARABAYAR
				FROM   $DBUser.TABEL_305_CARA_BAYAR
			   WHERE   kdcarabayar = ptg.kdcarabayar) CARA,
		   (SELECT   NAMAVALUTA
				FROM   $DBUser.TABEL_304_VALUTA
			   WHERE   kdvaluta = ptg.kdvaluta) valuta,
		   (SELECT   namaproduk
				FROM   $DBUser.TABEL_202_PRODUK 
			   WHERE   kdproduk = ptg.kdproduk) produk,
			(SELECT  max(noaccount) from $DBUser.TABEL_100_KLIEN_ACCOUNT where jenis='VA' and kdbank='BNI'
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
	-->
	</style>
    <style> 
	@page { size 8.5in 11in; margin: 2cm } 
	div.page { page-break-after: always } 
.style18 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; }
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
			
			<p class="style5">Dengan hormat, </p>
		</div>
		<p align="justify" class="style5">Terima kasih atas kepercayaan <?=$row["ANDA"];?> kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi <?=$row["ANDA"];?> dan keluarga.</p>
		<p align="justify" class="style5">Berikut kami informasikan data rincian Polis 
		  <?=$row["ANDA"];?> :</p>
        <table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#A0A0A4">
		  <tr>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Nomor Polis</b><br/><i>Policy Number</i></div></td>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Lunas Terakhir</b><br/><i>Last Payment Date</i></div></td>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Tagihan Baru (Rp)</b><br/><i>New Balance</i></div></td>
			<td width="104" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Tanggal Cetak</b><br/><i>Statement Date</i></div></td>
            <td width="195" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Batas Waktu Pembayaran</b><br/>
              <i>Due Date</i></div></td>
		  </tr>
           <tr>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?><? if ($row["PREFIXPERTANGGUNGAN"].$row["NOPERTANGGUNGAN"]==$row["NOPOL"]) {} else { echo '/ '.$row["NOPOL"];};?></div></td>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><?=$row["LUNAS"];?></div></td>
            <td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><?=number_format($row["PREMITAGIHAN"],2,",",".");?></div></td>
            <td width="104" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><?=$row["CETAK"];?></div></td>
            <td width="195" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><?=$row["TGLEXP"];?></div></td>
		  </tr>
           <tr>
             <td colspan="5" valign="top" bordercolor="#A0A0A4">&nbsp;</td>
           </tr>
          <tr>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Tanggal Tagihan</b><br/>
			    <i>Billing Date</i></div></td>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Keterangan</b><br/>
			    <i>Description</i></div></td>
			<td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Jumlah (Rp)</b><br/>
			    <i>Amounts</i></div></td>
			<td colspan="2" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Informasi Pembayaran</b><br/>
			  <i>Payment Information</i></div></td>
          </tr>
          <tr>
			<td colspan="3" rowspan="4" valign="top" bordercolor="#A0A0A4">
            <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#A0A0A4">
            <?
			$queryhp="select to_char(tglbooked,'dd/mm/yyyy') booked, to_char(tglbooked,'mm/yyyy') blnbooked, PREMITAGIHAN from $DBUser.tabel_300_historis_premi where prefixpertanggungan='".$row["PREFIXPERTANGGUNGAN"]."' and nopertanggungan= '".$row["NOPERTANGGUNGAN"]."' and tglseatled is null";
            $DBP->parse($queryhp);
			$DBP->execute();	
			//echo $queryhp;	
			$totalpremi=0;		
			while ($hp=$DBP->nextrow()) {	
			$totalpremi+=$hp["PREMITAGIHAN"];
			?>
             
            <tr><td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><?=$hp["BOOKED"];?></div></td>
            <td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18">premi bulan <?=$hp["BLNBOOKED"];?></div></td>
            <td width="149" valign="top" bordercolor="#A0A0A4"><div align="right" class="style18"><?=number_format($hp["PREMITAGIHAN"],2,",",".");?></div></td></tr>
            <?
            }
			
			?>
            <tr><td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"></div></td>
            <td width="149" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>TOTAL TAGIHAN</b></div></td>
            <td width="149" valign="top" bordercolor="#A0A0A4"><div align="right" class="style18"><b><?=number_format($totalpremi,2,",",".");?></b></div></td></tr>
              </table>
              
              
            </td>
			<td width="104" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18">
              <div align="left">Cara Pembayaran<br/>
                Rek. Pendebetan<br/>
              Nomor Host-to-Host</div>
            </div></td>
            <td width="195" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><div align="left"><?=$row["PENAGIH"];?><br/>
                <?=$row["REK"];?><br/>
                <?=$row["MAPPING"].$row["NOPERTANGGUNGAN"];?></div></div></td>
		  </tr>
          <tr>
			<td colspan="2" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18"><b>Informasi Pembayaran</b><br/>
			  <i>Payment Information</i></div></td>
          </tr>
          <tr>
			<td colspan="2" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18">
			  <div align="justify">Bagi Nasabah dengan cara bayar Autodebet, akan dilakukan pendebetan secara otomatis setiap bulannya.<br/>
              Jadwal pendebetan mengikuti ketetapan sebagai berikut : <br/>
              1. Mandiri : Tgl 5, 15, 25<br/>
              2. BNI : Tgl 7, 17, 27<br/>
              3. BRI : Tgl 9, 19, 29<br/>
              4. Credit Card : Tgl 23<br/>
              5. BTN : Tgl 3, 13, 23 (*)<br/>
              6. BPD Kalbar : Tgl 6, 16, 26 (*)<br/><br/>
              Jika tanggal pendebetan jatuh pada hari libur, pendebetan akan dilakukan pada hari kerja berikutnya.<br/><br/>
              <b>*Syarat dan ketentuan berlaku              </div>
			</div></td>
          </tr>  
         </table>
         
         <p align="justify" class="style5">Untuk tetap menjaga Manfaat Asuransi sesuai ketentuan dalam Syarat-syarat Umum Polis Asuransi diharapkan <?=$row["ANDA"];?> untuk melakukan pembayaran premi sampai dengan batas waktu yang ditetapkan. Dalam hal pembayaran premi belum dilunasi sampai dengan batas waktu yang telah ditentukan, maka kondisi polis menjadi  <em><strong>Lapse/Batal </strong></em>per <strong> 
		 <?=$row["TGLBPO"];?>.
         </strong></p>
		 <p align="justify" class="style5"><span class="style5">Dalam hal pembayaran Premi telah dilakukan oleh <?=$row["ANDA"];?> dan atau data Polis di atas tidak sesuai, serta jika ada informasi lain yang ingin 
		   <?=$row["ANDA"];?>
	     ketahui, mohon untuk dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau email : customer_service@ifg-life.co.id, dengan melampirkan bukti pelunasan premi yang sah.</span></p>
		 <p align="justify" class="style5">Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.</p>
		<p align="justify" class="style5">Hormat kami <br>
		  PT ASURANSI JIWA IFG<br>
		</p>
	<table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#A0A0A4">
    	  <tr>
			<td colspan="3" valign="top" bordercolor="#A0A0A4" bgcolor="#A0A0A4"><div align="center" class="style18"><b>Info dan Promo Penting!</b></div></td>
        </tr>
		  <tr>
			<td width="248" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18">
			  <div align="justify">Gunakanlah kemudahan pembayaran tagihan premi melalui channel Host-to-Host Bank BNI, BRI, Mandiri, Kantor Pos, Indomaret, Alfamart dan Bimasakti<br/>Info : http://goo.gl/mH77Fq</div>
			</div></td>
			<td width="248" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18">
			  <div align="justify">Program PT Asuransi Jiwa IFG Terbang ke Inggris adalah program yang akan memberikan reward kepada Pemegang Polis PT Asuransi Jiwa IFG untuk Tour di Kota London serta menonton pertandingan Manchester City di Etihad Stadium secara gratis</div>
			</div></td>
			<td width="248" valign="top" bordercolor="#A0A0A4"><div align="center" class="style18">
			  <div align="justify">Dapatkan official merchandise PT Asuransi Jiwa IFG branding Manchester City FC melalui PT Asuransi Jiwa IFG Super Poin periode 2016/2017 degan sistem pengumpulan Poin dari setiap pembelian polis PT Asuransi Jiwa IFG<br/>
			    Info : https://ifg-life.co.id/poin/</div>
			</div></td>

		  </tr>
     </table>         
		
		
<? 
echo "</div>";
};?>
<br/><br/>
</body>
</html>