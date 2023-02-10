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
            + nvl((select premi from $DBUser.tabel_223_transaksi_produk where
            prefixpertanggungan = ptg.prefixpertanggungan
                   AND nopertanggungan = ptg.nopertanggungan
                   AND kdbenefit='BNFTOPUPSG'
            ),0)
			+ (SELECT nilai FROM $DBUser.TABEL_300_TAGIHAN_PERTAMA hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan and jenis='B')
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
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
		 (SELECT TO_CHAR (expireddate,'DD/MM/YYYY') FROM $DBUser.TABEL_300_TAGIHAN_PERTAMA hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan and jenis='P') batas,
		 (select kdmapping from $DBUser.TABEL_001_KANTOR where kdkantor=ptg.prefixpertanggungan )||ptg.nopertanggungan h2h
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
        <p><strong>Perihal : PEMBERITAHUAN TAGIHAN PREMI PERTAMA</strong></p>
        <p class="style11">Calon Pemegang Polis Yang Terhormat, </p>
    </div>
    <p align="justify" class="style5">Terima kasih atas kepercayaan <?=$row["ANDA"];?> kepada PT Asuransi Jiwa IFG dalam memberikan perlindungan asuransi bagi <?=$row["ANDA"];?> dan keluarga.</p>
    <p align="justify" class="style5">Berikut ini adalah data Polis <?=$row["ANDA"];?> :</p>
    <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td width="50" valign="top" class="style5">&nbsp;</td>
        <td width="325" valign="top" class="style5">Nomor Proposal</td>
        <td width="12" valign="top" class="style5">:</td>
        <td width="358" valign="top" class="style5"> <?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?> / <?=$row["NOPOL"];?></td>
        </tr>
      <tr>
        <td class="style5">&nbsp;</td>
        <td class="style5">Nama Calon Pemegang Polis</td>
        <td class="style5">:</td>
        <td class="style5"><?=$row["PEMPOL"];?></td>
        </tr>
      <tr>
        <td class="style5">&nbsp;</td>
        <td class="style5">No. Host To Host Mandiri / BRI</td>
        <td class="style5">:</td>
        <td class="style5"><?=$row["H2H"];?></td>
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
        <td class="style5">Jatuh tempo pembayaran Premi pada tanggal</td>
        <td class="style5">:</td>
        <td class="style5"><?=$row["BATAS"];?></td>
      </tr>
      <tr>
        <td class="style5">&nbsp;</td>
        <td class="style5">Jumlah Premi sebesar</td>
        <td class="style5">:</td>
        <td class="style5"><? if ($newvaluta == 'RUPIAH TANPA INDEKS' || $newvaluta =="DOLLAR AMERIKA SERIKAT"){		// add by salman 10/10/2012     ## dirubah oleh dedi(16/10/2013) untuk jenis dolar tidak dibagi index awal
								echo number_format($row["PREMI"],2,",",".");
							  }
							  else{
							  	echo number_format($row["PREMI"]/$row["INDEXAWAL"],2,",","."); // end add by salman 10/10/2012
							  }?></td>
      </tr>
    </table>
    <p align="justify" class="style5">Mohon untuk dapat melakukan pembayaran premi tersebut diatas selambat-lambatnya tanggal <?=$row["BATAS"];?>. Keterlambatan pembayaran premi akan menyebabkan  proposal asuransi menjadi <em><strong>Batal.</strong></em></p>
    <p align="justify" class="style5"><span class="style5">Dalam hal pembayaran Premi telah dilakukan oleh <?=$row["ANDA"];?> dan atau data Polis di atas tidak sesuai, dapat menghubungi PT Asuransi Jiwa IFG <?=$KTR->namakantor;?></span>    </p>
    <p align="justify" class="style5">Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang baik kami ucapkan terimakasih.</p>
    <p align="justify" class="style5">Hormat kami <br>
      PT ASURANSI JIWA IFG<br><br><br><br><br>
    </p>
    <table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7"><li>Ubah cara bayar premi Bapak/Ibu dari tunai menjadi Autodebit Rekening Tabungan Bank Mandiri/BNI, Autodebit Kartu Kredit jenis Visa/Master, Virtual Account BNI dan Host to Host Bank Mandiri/BRI/Bimasakti.</li>
          <li>Untuk informasi lebih lanjut silahkan menghubungi Call Center PT Asuransi Jiwa IFG di nomor (021) 500151 atau email : asuransi@ifg-life.co.id.</li>
        </span></div></td>
      </tr>
    </table>    
    <p align="justify" class="style2">* Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.<br>
    * Jika tagihan sudah dibayar mohon konfirmasi ini dapat diabaikan
    </p>    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>