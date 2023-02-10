<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 $DB=New database($userid, $passwd, $DBName);
  $DB1=New database($userid, $passwd, $DBName);
  $DB2=New database($userid, $passwd, $DBName);
?>
<html>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<body>
<div align="center" class="style1">B I O D A T A</div>
<table  border="0" width="100%" cellspacing="1" cellpadding="1" class="tblisi"> 
 <? 
	$qry="SELECT a.namaklien1, 
          a.namaklien2, 
          b.namapekerjaan, 
          c.namahobby, 
          a.gelar,
          to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, 
          decode (a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin,
          a.tinggibadan,
          a.beratbadan,
          decode (a.meritalstatus,'D','DUDA','J','JANDA','K','KAWIN','L','LAJANG') meritalstatus,
          a.alamattagih01,
          a.alamattagih02,
          a.phonetagih01,
          a.phonetagih02,
          a.phonetetap01,
          a.phonetetap02,
          f.namaagama,
          a.alamattetap01,
          a.alamattetap02,
          d.namakotamadya,
          e.namapropinsi,
          a.emailtetap
        FROM $DBUser.tabel_100_klien a
          LEFT JOIN $DBUser.tabel_105_pekerjaan b ON a.kdpekerjaan=b.kdpekerjaan
          LEFT JOIN $DBUser.tabel_114_hobby c ON a.kdhobby=c.kdhobby
          LEFT JOIN $DBUser.tabel_109_kotamadya d ON a.kdkotamadyatagih=d.kdkotamadya
          LEFT JOIN $DBUser.tabel_108_propinsi e ON a.kdpropinsitagih=e.kdpropinsi
          LEFT JOIN $DBUser.tabel_102_agama f ON a.kdagama = f.kdagama
		 	 WHERE a.noklien='$noklien' ";
//echo $qry;
	$DB->parse($qry);
	$DB->execute();
	$arv=$DB->nextrow();
	?>
<tr>
    <td class="verdana8blk">Klien nomor</td>
    <td class="verdana8blk">:  <?=$noklien; ?></td>
	<td class="verdana8blk">Nama</td>
    <td class="verdana8blk">:  
    <?=$arv["NAMAKLIEN1"]; ?></td>
  </tr>
	 
  <tr>
    <td class="verdana8blk">Tgl Lahir</td>
    <td class="verdana8blk">:  
    <?=$arv["TGLLAHIR"]; ?></td>
    <td class="verdana8blk">Jenis Kelamin / Marital Status</td>
    <td class="verdana8blk">:   
      <?=$arv["JENISKELAMIN"]; ?>
    /  
    <?=$arv["MERITALSTATUS"]; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Pekerjaan</td>
    <td class="verdana8blk">:  
    <?=$arv["NAMAPEKERJAAN"]; ?></td>
    <td class="verdana8blk">Hobby</td>
    <td class="verdana8blk">: 
    <?=$arv["NAMAHOBBY"]; ?></td>
  </tr>
	
	 <tr>
    <td class="verdana8blk">Tinggi Badan</td>
    <td class="verdana8blk">:   
      <?=$arv["TINGGIBADAN"]; ?>
      cm</td>
    <td class="verdana8blk">Berat Badan</td>
    <td class="verdana8blk">:   
      <?=$arv["BERATBADAN"]; ?>
      kg</td>
  </tr>
	
	<tr>
    <td class="verdana8blk">Alamat Tetap</td>
    <td class="verdana8blk"><p>:  
        <?=$arv["ALAMATTETAP1"]; ?>
    Kode pos 
    <?=$arv["KODEPOSTETAP"]; ?></p>
      </td>
    <td class="verdana8blk">Pendapatan</td>
    <td class="verdana8blk">: 
      <?=$arv["PENDAPATAN"]; ?></td>
    <blockquote>&nbsp;</blockquote>
  </tr>	
  <tr>
    <td class="verdana8blk"> Phone Tetap </td>
    <td class="verdana8blk">: <?=$arv["PHONETETAP01"]; ?></td>
    <td class="verdana8blk">Email Tetap</td>
    <td class="verdana8blk">: 
      <?=$arv["EMAILTETAP"]; ?></td>
    <blockquote>&nbsp;</blockquote>
  </tr>	
  <tr>
    <td class="verdana8blk">Agama</td>
    <td class="verdana8blk" colspan="3">: 
    <?=$arv["NAMAAGAMA"]; ?></td>
  </tr>
  </table>
</body>
</html>
