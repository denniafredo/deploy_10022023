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
 
 $sql = "SELECT /*to_char(TO_DATE (SYSDATE, 'DD/MM/YYYY'),'DD/MM/YYYY') sdtgl, edit by salman 04/11/2015, karena akan dijadikan tanggal billing terakhir*/
		         (select to_char(max(tglbooked),'DD/MM/YYYY') from $DBUser.tabel_300_historis_premi where prefixpertanggungan = ptg.prefixpertanggungan and nopertanggungan = ptg.nopertanggungan and tglseatled is null and tglbooked < sysdate) sdtgl,
 to_char(TO_DATE ('".$tglexp."', 'DD/MM/YYYY'),'DD/MM/YYYY') sdtglX, ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, ptg.nopertanggungan NOPERTANGGUNGAN, ptg.nopol,
       ptg.notertanggung,decode(ptg.indexawal,0,1,null,1,ptg.indexawal) indexawal, to_char(sysdate,'dd')||' '||initcap($DBUser.bulan_kata(to_char(sysdate,'mm')))||' '||to_char(sysdate,'yyyy') tgl,
	   CASE
            WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
            THEN
               PREMI2
            ELSE
               PREMI1
         END
            PREMIXX,
			(select SUM(PREMITAGIHAN) from $DBUser.tabel_300_historis_premi where prefixpertanggungan = ptg.prefixpertanggungan and nopertanggungan = ptg.nopertanggungan and tglseatled is null and TRUNC(tglbooked,'MONTH') <= to_date('$tglexp','dd/mm/yyyy')) PREMI,
	   TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
	   (SELECT   TO_char(ADD_MONTHS(TO_DATE ((SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null), 'DD/MM/YYYY'),GRACEPERIODE),'DD/MM/YYYY') 
            FROM   $DBUser.TABEL_241_GRACE_PERIODE 
           WHERE   kdproduk = ptg.kdproduk) sdtglplus,
	   (SELECT   TO_char(ADD_MONTHS(TO_DATE ((SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null), 'DD/MM/YYYY'),GRACEPERIODE)-1,'DD/MM/YYYY') 
            FROM   $DBUser.TABEL_241_GRACE_PERIODE 
           WHERE   kdproduk = ptg.kdproduk) sdtglak,
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
         WHERE kli.noklien = ptg.notertanggung) ALAMAT,
		(SELECT decode(jeniskelamin,'P','Ibu','L','Bapak','Bapak/Ibu')
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = ptg.nopemegangpolis) anda,
		(SELECT namakotamadya
          FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
         WHERE kli.noklien = ptg.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
		 (SELECT TO_CHAR(min(tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hp WHERE hp.prefixpertanggungan=ptg.prefixpertanggungan AND hp.nopertanggungan=ptg.nopertanggungan AND hp.tglseatled is null) tertunggak,
		 (SELECT   kdmapping FROM   $DBUser.tabel_001_kantor WHERE  kdkantor = ptg.prefixpertanggungan)|| ptg.nopertanggungan noh2h,
		 (SELECT substr(max(noaccount),6,11) FROM $DBUser.tabel_100_klien_account va WHERE va.prefixpertanggungan=ptg.prefixpertanggungan AND va.nopertanggungan=ptg.nopertanggungan AND va.kdbank='BNI' and jenis='VA') VBNI
  FROM $DBUser.tabel_200_pertanggungan ptg
 WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";

 
		//echo 'cb '.$cb;
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
<body onLoad="alert('Untuk menghilangkan header dan footer, Klik File>Page Setup, Kosongkan kolom header dan footer!');">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>
    <td width="100%" style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td height="27" class="style5"><img src="./LogoJS.png" width="220" height="160"\></td>
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
        <p><strong>Perihal : PEMBERITAHUAN TUNGGAKAN PREMI </strong></p>
        <p class="style5">Pemegang Polis Yang Terhormat, </p>
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
        <td width="50" valign="top" class="style5">&nbsp;</td>
        <td width="325" valign="top" class="style5">Nomor Host to Host</td>
        <td width="12" valign="top" class="style5">:</td>
        <!--td width="358" valign="top" class="style5"> <?=$row["VBNI"];?></td-->
        <td width="358" valign="top" class="style5"> <?=$row["NOH2H"];?></td>
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
        </tr>
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
        <td class="style5">Jatuh tempo Premi yang belum dilunasi</td>
        <td class="style5">:</td>
        <td class="style5">
		<? //echo $row["TERTUNGGAK"]; if ($cb=='B') { echo ' s/d '.$row["SDTGL"];} else {};
			// edit by salman 04/11/2015 karena cara bayar A jadi tidak muncul SDTGL nya
		?>
		<? echo $row["TERTUNGGAK"]; if ($cb=='X') {} elseif ($row["TERTUNGGAK"]==$row["SDTGL"]) {} else { echo ' s/d '.$row["SDTGL"];};?>
		</td>
      </tr>
      <tr>
        <td class="style5">&nbsp;</td>
        <td class="style5">Jumlah Premi tertunggak sebesar</td>
        <td class="style5">:</td>
		<? if ($row["VALUTA"]=='DOLLAR AMERIKA SERIKAT'){ ?> <!-- update by salman 09/11/2012 -->
        	<td class="style5"><?=number_format(($row["PREMI"]),2,",",".");?></td>
		<? } else if ($row["VALUTA"]=='RUPIAH TANPA INDEKS'){ ?> <!-- update by salman 09/11/2012 -->
        	<td class="style5"><?=number_format(($row["PREMI"]),2,",",".");?></td>
		<? }
		else {?>
			<td class="style5"><?=number_format(($row["PREMI"]*$t)/$row["INDEXAWAL"],2,",",".");?></td>
		<? }?> <!-- update by salman 09/11/2012 -->
      </tr>
      <tr>
        <td class="style5">&nbsp;</td>
        <td class="style5">Batas waktu pembayaran premi</td>
        <td class="style5">:</td>
        <td class="style5"><?=$row["SDTGLAK"];?></td>
      </tr>
    </table>
    <p align="justify" class="style5">Untuk tetap menjaga Manfaat Asuransi sesuai ketentuan dalam Syarat-syarat Umum Polis Asuransi diharapkan 
      <?=$row["ANDA"];?>
      untuk melakukan pembayaran premi sampai dengan batas waktu yang ditetapkan.</p>
    <p align="justify" class="style5">Dalam hal pembayaran premi belum dilunasi sampai dengan batas waktu yang telah ditentukan, maka kondisi Polis menjadi Lapse (Batal) per <?=$row["SDTGLPLUS"];?></p>
    <p align="justify" class="style5">Abaikan surat pemberitahuan tunggakan ini apabila <?=$row["ANDA"];?> sudah melakukan pembayaran premi tersebut.</p>
	
    <!--p align="justify" class="style5"><span class="style5">Jika pembayaran Premi telah dilakukan oleh 
      <?=$row["ANDA"];?> 
      dan atau data Polis di atas tidak sesuai, dapat menghubungi PT Asuransi Jiwa IFG 
      <?=$KTR->namakantor;?>
    </span> </p-->
    <p align="justify" class="style5">Demikian pemberitahuan ini kami sampaikan dan terima kasih atas kerjasama yang telah terjalin selama ini.</p>
    <p align="justify" class="style5">Hormat kami,<br>
      PT ASURANSI JIWA IFG<br><br><br><br><br>
    </p>
    <!--table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7">Untuk informasi lebih lanjut tentang cara bayar premi melalui <em><strong>Auto Debet / Virtual Account</strong></em>, <em><strong>Pelayanan Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya</strong></em> dapat menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 500151 atau email : customer_service@ifg-life.co.id.</span></div></td>
      </tr>
    </table-->    
	<table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7">Informasi lebih lanjut  dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG, Call Center 021-1500151, email customer_service@ifg-life.co.id atau kunjungi www.ifg-life.co.id</span></div></td>
      </tr>
    </table>    
    <p align="justify" class="style2">*Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>