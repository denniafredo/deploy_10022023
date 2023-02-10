<?
 include "../../includes/database.php";
 //include "../../includes/session.php";
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

<body>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="782" id="AutoNumber1">
  <tr>    
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
        <p>Perihal : <strong>PEMBERITAHUAN JATUH TEMPO PREMI </strong></p>
        <p class="style12">Nasabah Yang Terhormat, </p>
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
        <td class="style5">Nomor Host to Host</td>
        <td class="style5">:</td>
        <td class="style5"><?=$row["H2H"];?></td>
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
        </tr><? $newvaluta = $row["VALUTA"];
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
        <td class="style5"><?=$row["TGLMULAS"].substr($tglexp,2,8);?></td>
      </tr>
      <tr>
        <td class="style5">&nbsp;</td>
        <td class="style5">Jumlah Premi sebesar</td>
        <td class="style5">:</td>
        <td class="style5"><? if ($newvaluta == 'RUPIAH TANPA INDEKS' || $newvaluta =="DOLLAR AMERIKA SERIKAT"){		// add by salman 10/10/2012     ## dirubah oleh dedi(16/10/2013) untuk jenis dolar tidak dibagi index awal
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
							  }?></td>
      </tr>
    </table>
    <p align="justify" class="style5">Mohon untuk dapat melakukan pembayaran premi tersebut diatas setelah tanggal jatuh tempo. Untuk menjaga kesinambungan manfaat Polis <?=$row["ANDA"];?> agar pembayaran premi dilakukan tidak melebihi masa kelonggaran pembayaran premi (grace period) yaitu <?=$row["GP"]; ?> hari setelah tanggal jatuh tempo premi.</p>
	<p align="justify" class="style5">Keterlambatan pembayaran premi ataupun hal-hal lainnya yang menyebabkan premi tidak terbayarkan dan melewati masa kelonggaran pembayaran premi, akan menyebabkan manfaat polis terhenti dan polis menjadi <b><i>Lapse</i> (Batal)</b>.</p>
    <p align="justify" class="style5">Abaikan surat pemberitahuan jatuh tempo ini apabila Bapak sudah melakukan pembayaran premi tersebut.</p>
    <p align="justify" class="style5">Demikian pemberitahuan ini kami sampaikan, dan terima kasih atas kerjasama yang telah terjalin selama ini.</p>
    <p align="justify" class="style5">Hormat kami <br>
      PT ASURANSI JIWA IFG<br><br><br><br><br>
    </p>
    <table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
      <tr>
        <td><div align="justify"><span class="style7">Informasi lebih lanjut dapat menghubungi Kantor Cabang PT Asuransi Jiwa IFG terdekat atau Call Center PT Asuransi Jiwa IFG 021-1500151 atau email <u>customer_service@ifg-life.co.id</u> atau kunjungi www.ifg-life.co.id</span></div></td>
      </tr>
    </table>        
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
</body>
</html>