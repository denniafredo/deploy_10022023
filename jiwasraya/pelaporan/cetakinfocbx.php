<?
 /*
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);	
 */
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 /*
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 */
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
 
 
	 switch (substr($row['TGL'], 3, 2))	{
			case "01": $bln = "Januari"; break;
		  case "02": $bln = "Pebruari"; break;
		  case "03": $bln = "Maret"; break;
			case "04": $bln = "April"; break;
			case "05": $bln = "Mei"; break;
			case "06": $bln = "Juni"; break;
			case "07": $bln = "Juli"; break;
			case "08": $bln = "Agustus"; break;
			case "09": $bln = "September"; break;
			case "10": $bln = "Oktober"; break;
			case "11": $bln = "Nopember"; break;
			case "12": $bln = "Desember"; break;
	}
	
	$tgl = substr($row['TGL'], 0, 2).' '.$bln.' '.substr($row['TGL'], 6, 4);
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
        <td height="27" class="style5"><img src="./LogoJS.png" width="210" height="150"\></td>
        <td class="style5"><div align="right" class="style8"><b><span class="style10">PT ASURANSI JIWA IFG</br>
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
        <td class="style5"><div align="right"><?=ucwords(strtolower($KTR->kotamadya)).', '.$tgl;?> </div></td>
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
        <p class="style12">Pemegang Polis Yang Terhormat, </p>
    </div>
    <div align="justify">
      <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
        <tr>
          <td colspan="4" valign="top" class="style5">
			<p align="justify" class="style12">Dalam rangka meningkatkan pelayanan kepada Nasabah, sejak tanggal 1 Maret 2012 PT Asuransi Jiwa IFG tidak menerima pembayaran tunai melalui petugas lapangan, pembayaran premi saat ini dapat dilakukan melalui :</p>
		  </td>
        </tr>
        <tr>
          <td width="24" valign="top" class="style13">1.</td>
          <td colspan="3" valign="top" class="style5"><strong>Auto Debet</strong></td>
        </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">a.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Auto Debet Tabungan Bank Mandiri/BNI/BRI<br>Pembayaran melalui Auto Debet tabungan Bank Mandiri/BNI/BRI dapat dilakukan dengan mengisi Surat Kuasa Pendebetan Rekening, foto copy buku tabungan Bank halaman 1 (satu), fotocopy KTP. Formulir surat kuasa dapat diperoleh melalui Kantor PT Asuransi Jiwa IFG di wilayah Anda atau download di <u>www.ifg-life.co.id</u> menu formulir dan dokumen.</span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">a.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Auto Debet Kartu Kredit<br>Pembayaran melalui Auto Debet Kartu Kredit berlogo Visa/Master dapat dilakukan dengan mengisi Surat Kuasa Pendebetan Kartu Kredit, foto copy kartu kredit, foto copy KTP.<br>Formulir surat kuasa dapat diperoleh melalui Kantor PT Asuransi Jiwa IFG di wilayah Anda atau download di <u>www.ifg-life.co.id</u> menu formulir dan dokumen.</span></div></td>
        </tr>
		<tr>
          <td width="24" valign="top" class="style13">2.</td>
          <td colspan="3" valign="top" class="style5"><strong>Virtual Account BNI</strong></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">Nomor Virtual Account BNI Anda adalah <strong><?=$row["VA"];?></strong>, pembayaran melalui Virtual Account BNI dapat dilakukan mellaui Setoran tunai di Teller BNI, ATM (BNI / ATM Bersama) dan Internet Banking</span></div></td>
        </tr>
		<tr>
          <td width="24" valign="top" class="style13">3.</td>
          <td colspan="3" valign="top" class="style5"><strong>Host to Host</strong></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">Pembayaran menggunakan Host to Host dapat dilakukan melalui :</span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">a.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Bank Mandiri
			<ul style="margin:3px 0 0 16px;">
				<li style="margin-bottom:3px;">Setoran tunai di Teller Bank Mandiri</li>
				<li style="margin-bottom:3px;">ATM Mandiri</li>
				<li style="margin-bottom:0px;">Internet Banking Bank Mandiri</li>
			</ul>
		  </span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">b.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Bank Rakyat Indonesia (BRI)
			<ul style="margin:3px 0 0 16px;">
				<li style="margin-bottom:3px;">Setoran tunai di Teller BRI</li>
				<li style="margin-bottom:0px;">ATM BRI</li>
			</ul>
		  </span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">c.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Bank Negara Indonesia (BNI)
			<ul style="margin:3px 0 0 16px;">
				<li style="margin-bottom:0px;">ATM BNI</li>
			</ul>
		  </span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">d.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Pos Indonesia</span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">e.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Seluruh Jaringan Indomaret</span></div></td>
        </tr>
		<tr>
          <td valign="top" class="style5">&nbsp;</td>
		  <td valign="top" class="style5">f.</td>
          <td valign="top" class="style5"><div align="justify"><span class="style12">Jaringan Payment Point FastPay</span></div></td>
        </tr>
		<?php if ($_GET['link'] != 'Y') { ?>
		<tr>
          <td width="24" valign="top" class="style13">4.</td>
          <td colspan="3" valign="top" class="style5"><strong>Kantor Cabang PT Asuransi Jiwa IFG di seluruh Indonesia</strong></td>
        </tr>
		<?php } ?>
        <!--tr>
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
          <td valign="top" class="style5">
          &nbsp;&nbsp&nbsp;&nbsp;- Setoran tunai di Teller BNI.<br>
          &nbsp;&nbsp&nbsp;&nbsp;- ATM (BNI / ATM Bersama).<br>
          &nbsp;&nbsp&nbsp;&nbsp;- Transfer antar Bank.Internet Banking.</td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="style13">4.</td>
          <td valign="top" class="style5"><strong>Host to Host</strong></td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify">Pembayaran menggunakan nomor host to host dapat dilakukan melalui ;</div></td>
        </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">a. Bank Mandiri</span></div></td>
          </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">
            &nbsp;&nbsp&nbsp;&nbsp;- Setoran       tunai di Teller Bank Mandiri<br>
            &nbsp;&nbsp&nbsp;&nbsp;- ATM       Mandiri.<br>
            &nbsp;&nbsp&nbsp;&nbsp;- Internet       Banking Bank Mandiri.
          </td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
          
        </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">b. Bank Rakyat Indonesia (BRI)</span></div></td>
          </tr>
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">
          &nbsp;&nbsp&nbsp;&nbsp;- Setoran tunai di Teller BRI <br>
          &nbsp;&nbsp&nbsp;&nbsp;- ATM BRI. </td>
          <td valign="top" class="style5">&nbsp;</td>
          <td valign="top" class="style5">&nbsp;</td>
          
        </tr>
        
        <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">c. Jaringan Payment Point FastPay</span></div></td>
          </tr>
          <tr>
          <td valign="top" class="style5">&nbsp;</td>
          <td colspan="3" valign="top" class="style5"><div align="justify"><span class="style12">d. Seluruh Jaringan Indomaret</span></div></td>
          </tr>
        <tr>
          <td colspan="4" valign="top" class="style5"><div align="justify"><span class="style12">Informasi lebih lanjut tentang cara bayar premi tersebut  diatas dapat menghubungi melalui Petugas Kami di Branch Office atau <strong>CALL CENTER PT ASURANSI JIWA IFG</strong> di nomor telepon <strong>(021) 1500151</strong>.</span></div></td>
          </tr-->
      </table>
    </div>
    <!--p align="justify" class="style5">Hormat kami <br>
      PT ASURANSI JIWA IFG<br><br><br><br><br>
    </p-->
	<br>
    <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7" style="font-size:14px;">Informasi lebih lanjut dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG 021-1500151 atau email <u>customer_service@jiwasraya.co.id</u> atau kunjungi www.ifg-life.co.id</span></div></td>
      </tr>
    </table>    
    <!--p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p-->    </td>
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>