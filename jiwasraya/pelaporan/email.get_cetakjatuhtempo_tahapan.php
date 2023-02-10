<?
 include "../../includes/database.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $userid='JSADM';
 $passwd='JSADMOKE';
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
         AND tpro.kdbenefit IN ('BNFTHPPT', 'BNFTHPSD', 'BNFTHPSMA', 'BNFTHPSMP')
         AND to_char(expirasi,'dd/mm/yyyy')='$tglexp'
         AND tpro.kdbenefit=kdbnf.kdbenefit) namabenefit,
		 (SELECT   namakantor || ' ' || alamat01 || ' ' || alamat02
  FROM   $DBUser.tabel_001_kantor ktr,$DBUser.TABEL_500_penagih pngh
 WHERE       kdrayonpenagih = kdkantor
         AND nopenagih=ptg.nopenagih) namakantor
  FROM   $DBUser.tabel_200_pertanggungan ptg
 WHERE ptg.prefixpertanggungan = '$prefixpertanggungan' AND ptg.nopertanggungan = '$nopertanggungan'";

	//	echo $sql;

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
<body">
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>    
    <div align="justify">      
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
    </div>
    <p align="justify">Terimakasih atas kepercayaan Anda menjadi nasabah PT Asuransi Jiwa IFG.</p>
    <p align="justify">Terlampir kami sampaikan pemberitahuan <strong>jatuh tempo <?php echo substr($row["NAMABENEFIT"],10,strlen($row["NAMABENEFIT"])-10);?> polis nomor <?php echo $row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"].' / '.$row["NOPOL"];?></strong> dan <strong>Formulir pengajuan jatuh tempo</strong> polis Anda</p>
    <p align="justify">Hormat kami <br>
      PT ASURANSI JIWA IFG<br><br><br><br><br>
    </p>
    <p align="justify"><strong><u>Info Penting</u></strong> <br>
      <ol>		
		<li>Apabila membutuhkan informasi lebih lanjut berkaitan dengan surat pemberitahuan ini atau alamat korespondensi/email Anda berubah silahkan hubungi Call Center PT Asuransi Jiwa IFG <strong>021-1500151</strong> atau e-mail <strong>customer_service@ifg-life.co.id</strong>
		</li>
	  </ol>
    </p>       
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>