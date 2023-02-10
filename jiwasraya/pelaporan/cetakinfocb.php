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
	   (select NOACCOUNT from $DBUser.TABEL_100_KLIEN_ACCOUNT where  nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' and status='0' and jenis='VA' and kdbank='BNI') VA,
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
.style12 {
	font-family: Arial, Helvetica, sans-serif
}
.style13 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
-->
</style>
<body onLoad="alert('Untuk menghilangkan header dan footer, Klik File>Page Setup, Kosongkan kolom header dan footer!');">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>
    <td width="100%" style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1"><table width="100%" border="0" cellspacing="0" cellpadding="3">
       <tr>
        <td height="27" class="style5">&nbsp;</td>
        <td class="style5"></td>
      </tr>
      <tr>
        <td height="27" class="style5"><img src="./LogoJS.png" width="220" height="160"\></td>
        <td class="style5"><div align="right" class="style8"><b><span class="style10">PT ASURANSI JIWA IFG LIFE</br>
              <?=$KTR->namakantor.'</b></br>'.$KTR->alamat01.'</br>'.$KTR->alamat02.'</br>'.$KTR->phone01;?>
              </br>
              <b>www.jiwasraya.co.id</b>
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
          </font></p>
        <p class="style11">Pemegang Polis Yang Terhormat, </p>
    </div>
    <div align="justify">
      <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
        <tr>
          <td colspan="4" valign="top" class="style5"><p align="justify" class="style12">Bersama ini kami sampaikan  ucapan terima kasih atas kepercayaan yang telah diberikan kepada PT Asuransi  Jiwa IFG untuk mengelola Proteksi Asuransi Jiwa dan Perencanaan Keuangan  keluarga Pemegang Polis/Tertanggung.</p>
            <p align="justify" class="style12">Guna meningkatkan pelayanan  kepada Nasabah, kami menginformasikan bahwa pembayaran premi polis berkala  lanjutan mulai tanggal 01 Maret 2012&nbsp; dan  seterusnya juga dapat dilakukan melalui media perbankan. </p>
            <p align="justify" class="style12">Media perbankan yang sudah dapat dipergunakan untuk  pembayaran premi berkala lanjutan adalah sebagai berikut ; </p></td>
          </tr>
        <tr>
          <td width="24" valign="top" class="style13">1.</td>
            <td width="351" valign="top" class="style5"><strong>Auto Debet Bank Mandiri/BNI/BRI</strong></td>
            <td width="12" valign="top" class="style5">&nbsp;</td>
            <td width="358" valign="top" class="style5">&nbsp;</td>
          </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">Pembayaran melalui  Auto Debet rekening Bank Mandiri/BNI/BRI dapat dilakukan dengan mengisi Surat  Kuasa Pendebetan Rekening dan copy buku tabungan bank halaman 1 (satu),  formulir surat kuasa dapat diperoleh melalui Kantor PT Asuransi Jiwa IFG di wilayah Anda. </span></div></td>
          </tr>
        <tr>
          <td valign="top" class="style13">2.</td>
          <td valign="top" class="style5"><strong>Auto Debet seluruh Kartu Kredit </strong></td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">Pembayaran melalui  Auto Debet seluruh Kartu Kredit yang berlogo Visa/Master dapat dilakukan dengan  mengisi Surat Kuasa Pendebetan Kartu Kredit dan copy kartu kredit, formulir  surat kuasa dapat diperoleh&nbsp; melalui Kantor PT Asuransi Jiwa IFG di wilayah Anda.</span></div></td>
          </tr>
        <tr>
          <td valign="top" class="style13">3.</td>
          <td valign="top" class="style5"><strong>Virtual Account BNI </strong></td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">Nomor Virtual  Account BNI Anda adalah <strong><?=$row["VA"];?>, </strong>pembayaran melalui Virtual Account BNI dapat dilakukan melalui ;</span></div></td>
          </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5"><ul type="disc" class="style12">
            <li>Setoran       tunai di Teller BNI. </li>
            <li>ATM       (BNI / ATM Bersama). </li>
            <li>Transfer       antar Bank. </li>
            <li>Internet       Banking.</li>
          </ul>          </td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" valign="top" class="style5"><div align="justify"><span class="style12">Informasi lebih lanjut tentang cara bayar premi tersebut  diatas dapat menghubungi melalui Petugas Kami di Branch Office atau <strong>CALL CENTER JIWA IFG</strong> di nomor telepon <strong>(021) 1500151</strong>.</span></div></td>
          </tr>
      </table>
    </div>
    <p align="justify" class="style5">Hormat kami <br>
      PT ASURANSI JIWASRAYA (PERSERO)<br><br><br><br><br>
    </p>
    <table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7">Untuk informasi lebih lanjut tentang cara bayar premi melalui <em><strong>Auto Debet / Virtual Account</strong></em>, <em><strong>Pelayanan Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya</strong></em> dapat menghubungi Call Center Jiwasraya di nomor (021) 500151 atau email : customer_service@jiwasraya.co.id.</span></div></td>
      </tr>
    </table>    
    <p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>