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
 
 $sql = "SELECT   ptg.prefixpertanggungan PREFIXPERTANGGUNGAN,
         ptg.nopertanggungan NOPERTANGGUNGAN,
         ptg.nopol,
         ptg.notertanggung,
         DECODE (ptg.indexawal, 0, 1, ptg.indexawal) indexawal,
         TO_CHAR (SYSDATE, 'dd/mm/yyyy') tgl,         
         TO_CHAR (mulas, 'DD/MM/YYYY') MULAS,
		 TO_CHAR (EXPIRASI, 'DD/MM/YYYY') EXPIRASI,
         (SELECT   GRACEPERIODE * 30
            FROM   $DBUser.TABEL_241_GRACE_PERIODE
           WHERE   kdproduk = ptg.kdproduk)
            gp,
         (SELECT   NAMACARABAYAR
            FROM   $DBUser.TABEL_305_CARA_BAYAR
           WHERE   kdcarabayar = ptg.kdcarabayar)
            CARA,
         (SELECT   NAMAVALUTA
            FROM   $DBUser.TABEL_304_VALUTA
           WHERE   kdvaluta = ptg.kdvaluta)
            valuta,
         (SELECT   namaproduk
            FROM   $DBUser.TABEL_202_PRODUK
           WHERE   kdproduk = ptg.kdproduk)
            produk,
         (SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = ptg.nopemegangpolis)
            PEMPOL,
         (SELECT   alamattagih01 || ' ' || alamattagih02
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = ptg.notertanggung)
            ALAMAT,
         (SELECT   DECODE (jeniskelamin,
                           'P', 'Ibu',
                           'L', 'Bapak',
                           'Bapak/Ibu')
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = ptg.nopemegangpolis)
            anda,
         (SELECT   namakotamadya
            FROM   $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
           WHERE   kli.noklien = ptg.notertanggung
                   AND kdkotamadyatagih = kdkotamadya)
            KOTA,
            (SELECT   to_char(expirasi,'dd/mm/yyyy')||namabenefit
  FROM   $DBUser.tabel_223_transaksi_produk tpro,$DBUser.TABEL_207_KODE_BENEFIT kdbnf
 WHERE       nopertanggungan = ptg.nopertanggungan
         AND prefixpertanggungan = ptg.prefixpertanggungan
         AND tpro.kdbenefit IN ('EXPPREMI')
         AND to_char(expirasi,'dd/mm/yyyy')='$tglexp'
         AND tpro.kdbenefit=kdbnf.kdbenefit) namabenefit,
		 (SELECT   namakantor || ' ' || alamat01 || ' ' || alamat02
  FROM   $DBUser.tabel_001_kantor ktr,$DBUser.TABEL_500_penagih pngh
 WHERE       kdrayonpenagih = kdkantor
         AND nopenagih=ptg.nopenagih) namakantor
  FROM   $DBUser.tabel_200_pertanggungan ptg
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
<body onLoad="alert('Untuk menghilangkan header dan footer, Klik File>Page Setup, Kosongkan kolom header dan footer!');">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>
    <td width="100%" style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1"><table width="100%" border="0" cellspacing="0" cellpadding="3">
       <tr>
        <td height="27" class="style5">&nbsp;</td>
        <td class="style5"></td>
      </tr>
      <tr>
        <td height="27" class="style5"><img src="./LogoJS.png"  width="210" height="150"\></td>
        <td class="style5"><div align="right" class="style8"><b><span class="style10">PT ASURANSI JIWA IFG</br>
              <?=$KTR->namakantor.'</b></br>'.$KTR->alamat01.'</br>'.$KTR->alamat02.' '.$KTR->kodepos.'</br>'.$KTR->phone01;?>
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
          </font></p>
        <p>Dengan Hormat, </p>
        <table width="100%" border="0" class="style5">
          <tr>
            <td width="13%" valign="top">Perihal</td>
            <td width="1%">:</td>
            <td width="86%"><strong>PEMBERITAHUAN JATUH TEMPO <?php echo substr($row["NAMABENEFIT"],10,strlen($row["NAMABENEFIT"])-10); ?> POLIS NO : <?php echo $row["PREFIXPERTANGGUNGAN"];?>-<?php echo $row["NOPERTANGGUNGAN"];?> / <?php echo $row["NOPOL"];?></strong></td>
          </tr>
          <tr>
            <td>Atas Nama</td>
            <td>:</td>
            <td><strong><?php echo $row["PEMPOL"]; ?></strong></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <!--p>Berdasarkan catatan yang ada pada kami, jatuh tempo pembayaran benefit <?php echo substr($row["NAMABENEFIT"],10,strlen($row["NAMABENEFIT"])-10); ?> untuk polis nomor <?php echo $row["PREFIXPERTANGGUNGAN"];?>-<?php echo $row["NOPERTANGGUNGAN"];?> / <?php echo $row["NOPOL"];?> atas nama <?php echo $row["PEMPOL"];?> akan jatuh tempo pada tanggal <?php echo $tglexp; ?>.</p-->
        <p>Berdasarkan catatan yang ada pada kami, jatuh tempo pembayaran benefit <?php echo substr($row["NAMABENEFIT"],10,strlen($row["NAMABENEFIT"])-10); ?> untuk polis nomor <?php echo $row["PREFIXPERTANGGUNGAN"];?>-<?php echo $row["NOPERTANGGUNGAN"];?> / <?php echo $row["NOPOL"];?> atas nama <?php echo $row["PEMPOL"];?> akan jatuh tempo pada tanggal <?php echo $row["EXPIRASI"];?>.</p>
        <div align="justify" class="style5">
          <p>Untuk itu kami mohon kehadiran Bapak/Ibu di PT. Asuransi Jiwa IFG <?php echo $row["NAMAKANTOR"]; ?>.</p>
        </div>
        <p align="justify" class="style5">dengan membawa kelengkapan berupa :</p>
        <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table3" cellpadding="4" bordercolor="#B3CFFF">
          <tr>
            <td width="13" valign="top" class="style5">1.</td>
            <td width="360" valign="top" class="style5">Polis Asli</td>
            <td width="11" valign="top" class="style5">&nbsp;</td>
            <td width="359" valign="top" class="style5">&nbsp;</td>
          </tr>
          <tr>
            <td class="style5">2.</td>
            <td class="style5">Bukti Pembayaran Premi terakhir</td>
            <td class="style5">&nbsp;</td>
            <td class="style5">&nbsp;</td>
          </tr>
          <tr>
            <td class="style5">3.</td>
            <td class="style5">Copy Identitas (KTP, SIM)</td>
            <td class="style5">&nbsp;</td>
            <td class="style5">&nbsp;</td>
          </tr>
          <? $newvaluta = $row["VALUTA"];// add by salman 10/10/2012
				?>
        </table>
        <p align="justify" class="style5">Demikian kami sampaikan, atas perhatian dan kepercayaan yang diberikan kepada PT. Asuransi Jiwa IFG selama ini kami ucapkan terima kasih.</p>
        <p>&nbsp;</p>
    </div>
    <p align="justify" class="style5">Hormat kami <br>
PT ASURANSI JIWA IFG<br>
<? echo $KTR->namakantor;?>
<br>
<br>
<br>
<br>
<?php //echo $KTR->kepala;?><br />
<?php //echo $KTR->jabatan;?> </p>
    <!--<table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7">Untuk informasi lebih lanjut tentang cara bayar premi melalui <em><strong>Auto Debet / Virtual Account</strong></em>, <em><strong>Pelayanan Klaim, Produk Asuransi JS-Link dan Produk Asuransi lainnya</strong></em> dapat menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 500151 atau email : customer_service@ifg-life.co.id.</span></div></td>
      </tr>
    </table> -->   
    <p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>