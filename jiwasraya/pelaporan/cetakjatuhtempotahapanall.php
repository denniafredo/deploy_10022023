<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 include "../../includes/kantor.php";
 $DB=New database($userid, $passwd, $DBName);
 $DBX=New database($userid, $passwd, $DBName);		
 
 //$prefixpertanggungan="AC";
 //$nopertanggungan="001226250";
 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);
 $KLN=New Klien($userid,$passwd,$PER->nopemegangpolis);
 $KTR=New Kantor($userid,$passwd,$kantor);
 

if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}

 /*$query="select prefixpertanggungan, nopertanggungan,  TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
		 WHERE   a.nopenagih=p.nopenagih
				 AND p.KDRAYONPENAGIH='$kdkantor'
				 AND a.kdpertanggungan = '2'
				 AND a.kdstatusfile = '1'".				 
				 //"AND a.kdvaluta='$kdvaluta' ".
				 //.$cara."
				 "AND  TO_CHAR (expirasi, 'YYYYMM') ='".$tglcari."'";*/
				 
$query="select a.prefixpertanggungan, a.nopertanggungan,  TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp
		FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p,$DBUser.tabel_223_transaksi_produk c
 		WHERE  a.nopenagih = p.nopenagih
         AND p.KDRAYONPENAGIH = '$kdkantor'
         AND a.prefixpertanggungan=c.prefixpertanggungan
         AND a.nopertanggungan=c.nopertanggungan
         AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
         AND substr(c.kdbenefit,1,6)='BNFTHP'
		 AND NVL(c.nilaibenefit,0)>0
         AND TO_CHAR (c.expirasi, 'YYYYMM') = '".$tglcari."'";
//echo $query;
$DBX->parse($query);
$DBX->execute();				
while ($arr=$DBX->nextrow()) {			

	
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
			(SELECT  noaccount from $DBUser.TABEL_100_KLIEN_ACCOUNT where jenis='VA' and kdbank='BNI'
			  and prefixpertanggungan=ptg.prefixpertanggungan and nopertanggungan=ptg.nopertanggungan) virtual,
			(SELECT  kdmapping from $DBUser.TABEL_001_kantor where kdkantor=ptg.prefixpertanggungan) mapping,
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
			 (SELECT   to_char(expirasi,'dd/mm/yyyy')||namabenefit
  FROM   $DBUser.tabel_223_transaksi_produk tpro,$DBUser.TABEL_207_KODE_BENEFIT kdbnf
 WHERE       nopertanggungan = ptg.nopertanggungan
         AND prefixpertanggungan = ptg.prefixpertanggungan
         AND substr(tpro.kdbenefit,1,6) = ('BNFTHP') 
         AND TO_CHAR (expirasi, 'YYYYMM') = '".$tglcari."'
         AND tpro.kdbenefit=kdbnf.kdbenefit) namabenefit,
		 (SELECT   namakantor || ' ' || alamat01 || ' ' || alamat02
  FROM   $DBUser.tabel_001_kantor ktr,$DBUser.TABEL_500_penagih pngh
 WHERE       kdrayonpenagih = kdkantor
         AND nopenagih=ptg.nopenagih) namakantor,
			 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=ptg.prefixpertanggungan AND hpl.nopertanggungan=ptg.nopertanggungan AND not(hpl.tglseatled is null)) lunas
	  FROM $DBUser.tabel_200_pertanggungan ptg
	 WHERE ptg.prefixpertanggungan = '".$arr["PREFIXPERTANGGUNGAN"]."' AND ptg.nopertanggungan = '".$arr["NOPERTANGGUNGAN"]."'";
	
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
			<td height="27" class="style5">&nbsp;</td>
			<td class="style5"><div align="right"><?=ucwords(strtolower($KTR->kotamadya)).', '.$row["TGL"];?> </div></td>
		  </tr>
		</table>
		<div align="justify" class="style5">      
			<div align="justify" class="style5">
			  <div align="justify" class="style5">
			    <p>Kepada Yth.<br>
			      <?=$row["ANDA"];?>
			      .
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
			    <p>Berdasarkan catatan yang ada pada kami, jatuh tempo pembayaran benefit <?php echo substr($row["NAMABENEFIT"],10,strlen($row["NAMABENEFIT"])-10); ?> untuk polis nomor <?php echo $row["PREFIXPERTANGGUNGAN"];?>-<?php echo $row["NOPERTANGGUNGAN"];?> / <?php echo $row["NOPOL"];?> atas nama <?php echo $row["PEMPOL"];?> akan jatuh tempo pada tanggal <?php echo substr($row["NAMABENEFIT"],0,10); ?></p>
			    <p>Untuk itu kami mohon kehadiran Bapak/Ibu di PT. Asuransi Jiwa IFG <?php echo $row["NAMAKANTOR"]; ?>.</p>
		      </div>
              <p align="justify" class="style5">dengan membawa kelengkapan berupa :</p>
              <table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
                <tr>
                  <td width="13" valign="top" class="style5">1.</td>
                  <td width="360" valign="top" class="style5">Polis Asli</td>
                  <td width="11" valign="top" class="style5">&nbsp;</td>
                  <td width="359" valign="top" class="style5">&nbsp;</td>
                </tr>
                <tr>
                  <td class="style5">2.</td>
                  <td class="style5">Kuitansi pelunasan premi terakhir</td>
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
              <p align="justify" class="style5">&nbsp;</p>
              <p align="justify" class="style5">Hormat kami <br>
                PT ASURANSI JIWA IFG<br>
  <br>
  <br>
  <br>
  <br>
  <?php echo $KTR->kepala;?><br />
  <?php echo $KTR->jabatan;?> </p>
              <p>&nbsp;</p></div>
        <p>&nbsp;</p></div><p align="justify" class="style2">Dokumen ini tidak memerlukan tanda tangan karena dicetak secara komputerisasi.</p>    </td>
	  </tr>
	  <tr>
		<td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
	  </tr>
	</table>
<? 
echo "</div>";
};?>
<br/><br/>
</body>
</html>