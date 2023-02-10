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
            WHEN (MONTHS_BETWEEN (TO_DATE ('01/09/2016', 'DD/MM/YYYY'), MULAS) / 12) >=5
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
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND (hpl.tglseatled is null)) JATUH_TEMPO,
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
    <div align="justify"> 
	  	<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
		  <tr>
			<td width="50" valign="top" class="style5">Kepada Yth.</td>			
		  </tr>
		  <tr>
			<td width="50" valign="top" class="style5">Bapak/Ibu Pemegang Polis Asuransi PT Asuransi Jiwa IFG</td>			
		  </tr>		  
		  <tr>
			<td width="50" valign="top" class="style5">Di Tempat</td>			
		  </tr>		  
		</table>  		  		  	  
    </div>
    <p align="justify">Sehubungan dengan adanya pengiriman email kami sebelumnya terkait pemberitahuan Jatuh Tempo Pembayaran Premi, kami sampaikan hal-hal sebagai berikut :</p>
    <br>
    <br>
    <br>
      <ol>
		<li>Jika anda menerima email sebelum ini, yang seharusnya anda tidak menerima email tersebut, kami mohon maaf, email tersebut kami nyatakan tidak berlaku.
		</li>
		<li>Jika anda menerima email sebelum ini, tetapi isinya tidak sesuai dengan yang seharusnya, kami mohon maaf, email tersebut kami nyatakan tidak berlaku dan akan kami kirimkan email revisi terbaru.
		</li>		
	  </ol>
    </p>
	<br>
	<br>
	<br>
	<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
		  <tr>
			<td width="50" valign="top" class="style5">Hormat kami</td>			
		  </tr>
		  <tr>
			<td width="50" valign="top" class="style5">PT ASURANSI JIWA IFG</td>			
		  </tr>		  		  		 
		</table>  	
	
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
</body>
</html>