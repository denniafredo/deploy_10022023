<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);	
 $DB1=New database($userid, $passwd, $DBName);	
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 
 
 
	
 

 
?>
<title>Jatuh Tempo Polis BPO</title>
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

<?
$sql = "SELECT   c.kdrayonpenagih,
           b.prefixpertanggungan,
           b.nopertanggungan,
           d.namaproduk,
           b.kdproduk,
           b.premi1,
           TO_CHAR (b.tglbpo, 'DD/MM/YYYY') tglbpo,
           b.userupdated,
           (select TO_CHAR (max(tglbooked), 'DD/MM/YYYY') 
           from $DBUser.tabel_300_historis_premi where prefixpertanggungan=b.prefixpertanggungan 
           and nopertanggungan=b.nopertanggungan and tglseatled is not null) lunasterakhir,
           (select sum(premitagihan) 
           from $DBUser.tabel_300_historis_premi where prefixpertanggungan=b.prefixpertanggungan 
           and nopertanggungan=b.nopertanggungan and tglseatled is null) tunggakan,           
           TO_CHAR (b.mulas, 'DD/MM/YYYY') mulas,
           (SELECT   namaklien1
              FROM   $DBUser.tabel_100_klien
             WHERE   noklien = b.nopemegangpolis)
              pemegangpolis,
              (SELECT   alamattagih01||' '||alamattagih02
              FROM   $DBUser.tabel_100_klien
             WHERE   noklien = b.nopemegangpolis) alamat,
             (SELECT   namakotamadya 
              FROM   $DBUser.tabel_100_klien x,$DBUser.TABEL_109_KOTAMADYA y 
             WHERE   x.kdkotamadyatagih=y.kdkotamadya and noklien = b.nopemegangpolis) namakota, 
           (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=b.kdcarabayar) carabayar
    FROM   $DBUser.tabel_200_pertanggungan b,
           $DBUser.tabel_500_penagih c,
           $DBUser.tabel_202_produk d
   WHERE   b.nopenagih = c.nopenagih
           AND b.kdstatusfile IN ('4')
           AND b.kdproduk = d.kdproduk
		   AND substr(b.kdproduk,1,2) not in ('JL')
           AND b.kdpertanggungan = '2'
           AND c.kdrayonpenagih = '$kantor'
           AND TO_CHAR (b.tglbpo, 'MM/YYYY') = '".substr($tglcari,3,7)."'
ORDER BY   c.kdrayonpenagih, b.mulas";	
	
  	//echo "<br />".$sql."<br />";
  	$DB1->parse($sql);
    $DB1->execute();	
	
	while($arr=$DB1->nextrow()){
 $sql = "SELECT to_char(TO_DATE ('".$tglexp."', 'DD/MM/YYYY'),'DD/MM/YYYY') sdtgl, ptg.prefixpertanggungan PREFIXPERTANGGUNGAN, ptg.nopertanggungan NOPERTANGGUNGAN, ptg.nopol,
       ptg.notertanggung,decode(ptg.indexawal,0,1,ptg.indexawal) indexawal, to_char(sysdate,'dd/mm/yyyy') tgl,
	   CASE
            WHEN (MONTHS_BETWEEN (TO_DATE ('$tglexp', 'DD/MM/YYYY'), MULAS) / 12) >=5
            THEN
               PREMI2
            ELSE
               PREMI1
         END
            PREMI,premi1,premi2,
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
           WHERE   kdvaluta = ptg.kdvaluta) valuta,decode(ptg.kdvaluta,'1','Rp. ','0','RpI. ','$') simval,
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
		 (SELECT substr(noaccount,6,11) FROM $DBUser.tabel_100_klien_account va WHERE va.prefixpertanggungan=ptg.prefixpertanggungan AND va.nopertanggungan=ptg.nopertanggungan AND va.kdbank='BNI') VBNI
  FROM $DBUser.tabel_200_pertanggungan ptg
 WHERE ptg.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' AND ptg.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";

		//echo $sql;

 $DB->parse($sql);
 $DB->execute();
 $row=$DB->nextrow();
?>



<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>
    <td width="100%" style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1"><table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td height="27" class="style5"><div align="left" class="style8"><b><span class="style10">PT ASURANSI JIWA IFG</br>
          <?=$KTR->namakantor.'</b></br>'.$KTR->alamat01.'</br>'.$KTR->alamat02.'</br>'.$KTR->phone01;?>
          </br>
          <b>www.ifg-life.co.id</b> </span></div></td>
        <td align="right" class="style5"><img src="./LogoJS1.png" width="220" height="150"\></td>
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
        <p><strong>Perihal : PEMBERITAHUAN KONDISI POLIS BPO </strong></p>
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
        <td class="style5">Mulai Jatuh tempo Premi tertunggak</td>
        <td class="style5">:</td>
        <td class="style5"><? echo $row["TERTUNGGAK"]; if ($cb=='B') { echo ' s/d '.$row["SDTGL"];} else {};?></td>
      </tr>      
    </table>
    <p align="justify" class="style5">Berdasarkan data tersebut di atas, saat ini Polis Bapak/Ibu dalam kondisi BPO (Bebas Premi 
	Otomatis), sehingga terhadap kondisi polis tersebut, kami hitung ulang berdasarkan data pelunasan premi yang ada. 
	Hasil perhitungan tersebut akan menimbulkan kondisi sebagai berikut :</p>
	<ol class="style5">
	<li align="justify">Polis yang belum mempunyai nilai tunai, menjadi batal tanpa suatu pembayaran.</li>
	<li align="justify">Penurunan Jumlah Uang Asuransi dan secara otomatis premi lanjutan tidak muncul tagihan kembali. Segala manfaat asuransi yang timbul akan dihitung berdasarkan uang asuransi yang telah diturunkan.</li>
	<li align="justify">Dalam hal pembayaran Premi telah dilakukan oleh Bapak/Ibu dan atau data Polis di atas tidak sesuai serta jika ada informasi lain yang ingin Bapak/Ibu ketahui, mohon untuk dapat menghubungi Kantor PT Asuransi Jiwa IFG terdekat atau Call Center Jiwasraya : (021) 1500151 atau email: customer_service@ifg-life.co.id, dengan melampirkan bukti pelunasan premi yang sah.</li>
	</ol>
    
    <p align="justify" class="style5">Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.</p>
    <br />
	<br />
	<p align="justify" class="style5">Hormat kami <br>
      PT ASURANSI JIWA IFG<br><br><br><br>
    </p>
       
	
    <p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
 <?php } ?>
<br/><br/>
</body>
</html>