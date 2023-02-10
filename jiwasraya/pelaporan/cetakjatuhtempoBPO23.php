<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);	
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 
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
	   TO_CHAR(mulas,'DD/MM/YYYY') MULAS,TO_CHAR(mulas,'DD') TGLMULAS,
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
       (SELECT namaklien1
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = ptg.nopemegangpolis) PEMPOL,
       (SELECT alamattagih01||' '||alamattagih02
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = ptg.nopemegangpolis) ALAMAT,
		(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = ptg.nopemegangpolis) anda,
		(SELECT namakotamadya
          FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
         WHERE kli.noklien = ptg.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
		 (select kdmapping from $DBUser.TABEL_001_KANTOR where kdkantor=prefixpertanggungan)||nopertanggungan h2h
  FROM $DBUser.tabel_200_pertanggungan ptg
 WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";

		//echo $sql;

 $DB->parse($sql);
 $DB->execute();
 $row=$DB->nextrow();
 
?>
<title>Jatuh Tempo Premi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
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
        <td height="27" class="style5"><img src="./LogoJS.png" width="210" height="150"\></td>
        <td class="style5"><div align="right" class="style8"><b><span class="style10">PT ASURANSI JIWA IFG</br>
              <?=$KTR->namakantor.'</b></br>'.$KTR->alamat01.'</br>'.$KTR->alamat02.'</br>'.$KTR->phone01;?>
              </br>
              <b>www.ifg-life.co.id</b>
          </span></div></td>
      </tr>
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
        <p><strong>Perihal : PEMBATALAN POLIS </strong></p>
        <p align="justify" class="style5">Pemegang Polis Yang Terhormat, </p>
    </div>
    <p align="justify" class="style5">Terima kasih atas kepercayaan <?=$row["ANDA"];?> kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi <?=$row["ANDA"];?> dan keluarga.</p>
    <p align="justify" class="style5">Berikut ini adalah data Polis <?=$row["ANDA"];?> :</p>
    
	<table  cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4">
		<tr style="border:1pt solid black;">			
			<td width="325" valign="top" >Nomor Polis</td>
			<td width="12" valign="top" >:</td>
			<td style="border-right:1pt solid black;" width="358" valign="top" > <?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?> / <?=$row["NOPOL"];?></td>
			<td width="325" valign="top" >Mulai Asuransi</td>
			<td width="12" valign="top" >:</td>
			<td width="12" valign="top" ><?=$row["MULAS"];?></td>
		</tr>
		<tr  style="border:1pt solid black;">				
			<td width="325" valign="top" >Nama Pemegang Polis</td>
			<td width="12" valign="top" >:</td>
			<td style="border-right:1pt solid black;" width="358" valign="top" > <?=$row["PEMPOL"];?></td>
			<td width="325" valign="top" >Jumlah Premi</td>
			<td width="12" valign="top" >:</td>
			<td width="12" valign="top" >
			<? if ($newvaluta == 'RUPIAH TANPA INDEKS' || $newvaluta =="DOLLAR AMERIKA SERIKAT"){		// add by salman 10/10/2012     ## dirubah oleh dedi(16/10/2013) untuk jenis dolar tidak dibagi index awal
								$sqlrider="select nilairp from $DBUser.tabel_300_historis_rider where prefixpertanggungan='$prefixpertanggungan' and ".
								"nopertanggungan='$nopertanggungan' and to_char(tglbooked,'mm/yyyy')='".substr($tglexp,3,7)."'";
								$DB->parse($sqlrider);
								$DB->execute();
								$arrrider=$DB->nextrow();
								$premirider=$arrrider["NILAIRP"];
								//Ket komen: tidak perlu ditambah dengan biaya rider lagi, 
								//karena biaya rider sudah termasuk di dalam premi itu sendiri
								//echo number_format($row["PREMI"]+$premirider,2,",",".");
								echo number_format($row["PREMI"],2,",",".");
							  }
							  else{
							  	echo number_format($row["PREMI"]/$row["INDEXAWAL"],2,",","."); // end add by salman 10/10/2012
							  }?>
			</td>
		</tr>
		<tr style="border:1pt solid black;">			
			<td width="325" valign="top" >Jenis Produk</td>
			<td width="12" valign="top" >:</td>
			<td style="border-right:1pt solid black;" width="358" valign="top" > <?=$row["PRODUK"];?></td>
			<td width="325" valign="top" >Cara Pembayaran Premi</td>
			<td width="12" valign="top" >:</td>
			<td width="12" valign="top" ><?=$row["CARA"];?></td>
		</tr>
		<tr style="border:1pt solid black;">			
			<td width="325" valign="top" >Valuta</td>
			<td width="12" valign="top" >:</td>
			<td style="border-right:1pt solid black;" width="358" valign="top" ><?=$row["VALUTA"];?></td>
			<td width="325" valign="top" >Premi Trakhir Yang Terlunasi</td>
			<td width="12" valign="top" >:</td>
			<td width="12" valign="top" ><?=$row["LUNAS"];?></td>
		</tr>
    </table>
    <p align="justify" class="style5">Sesuai  dengan  ketentuan dalam Syarat-syarat  Umum Polis  Asuransi  polis  nomor  <?=$row["NOPOL"];?> setelah
diperhitungkan  sisa  saldo  unit dikurangi  dengan  Biaya  Asuransi&Administrasi,  saldo  unit polis  dibawah
ketentuan  minimum  sehingga Status  Pertanggungannya menjadi  <b>tidak  aktif  (Batal)</b>.  Bersamaan  dengan  hal
tersebut  terhitung  sejak  DD/MM/YWY  polis  Nomor <?=$row["NOPOL"];?> dinyatakan  Batal  (tidak  dapat  dipulihkan)
dan PT.Asuransi Jiwa IFG terbebas  dari semua  kewajiban  yang  tercantum  didalam  Polis.</p>
		
    <p align="justify" class="style5"><span class="style5">Selanjutnya  pembayaran  sisa Saldo Unit  yang  masih  terdapat  pada  polis  setelah diperhitungkan  dengan
biaya-biaya  yang  menjadi  kewajiban  pemegang  polis  maka  sisa dana  (jika  ada)  akan kami  kirimkan  melalui
transfer  Bank ke rekening :</span>    </p>
    
	
	<p align="justify" class="style5">
	<table>
		<tr>
			<td width="40" valign="top"></td>
			<td width="200" valign="top">Nama Bank</td>
			<td width="12" valign="top" >:</td>
			<td width="325" valign="top">______________________________________________________</td>
		</tr>
		<tr>
			<td width="40" valign="top"></td>
			<td width="200" valign="top">Cabang</td>
			<td width="12" valign="top" >:</td>
			<td width="325" valign="top">__________________________ Kota : ______________________</td>
		</tr>
		<tr>
			<td width="40" valign="top"></td>
			<td width="200" valign="top">Nomor Rekening</td>
			<td width="12" valign="top" >:</td>
			<td width="325" valign="top">______________________________________________________</td>
		</tr>
		<tr>
			<td width="40" valign="top"></td>
			<td width="200" valign="top">Nama Pemilik Rekening</td>
			<td width="12" valign="top" >:</td>
			<td width="325" valign="top">______________________________________________________</td>
		</tr>
	</table>
	</p>
	
	<p align="justify" class="style5">	
	Kami informasikan pula untuk polis yang meiliki titipan dana yang jumlahnya kurang dari atau sama dengan Rp.10.000/USD 1, maka mengacu pada ketentuan batas minimum transfer melalui Bank, dengan sangat menyesal kami informasikan titipan dana tersebut tidak dapat kami kembalikan.
	</p>
	
	<p align="justify" class="style5">	
	Kami terus berupaya untuk memberikan pelayanan yang terbaik kepada Bapak/Ibu dan atas kerja sama yang terjalin selama ini kami ucapkan terima kasih.
	</p>
	
    <p align="justify" class="style5">Hormat kami <br>
      PT ASURANSI JIWA IFG<br>
    </p>
	
	<p align="justify" class="style5">DIVISI UNDERWRITING RETAIL & CORPORATE <br><br><br><br><br><br>
	
      <u>UMI RATIH</u><br>
	  KEPALA DIVISI
    </p>
	
    <table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7">Untuk informasi lebih lanjut tentang cara bayar premi melalui <em><strong>Auto Debet / Virtual Account</strong></em>, <em><strong>Pelayanan Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya</strong></em> dapat menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 1500151 atau email : customer_service@ifg-life.co.id.</span></div></td>
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
echo "<div class='page'><br /><br />";
//include "cetakinfocbx.php";
echo "</div>";
?>
<br/><br/>
</body>
</html>