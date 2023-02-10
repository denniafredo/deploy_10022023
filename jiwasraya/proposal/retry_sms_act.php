<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";	
  include "../../includes/duit.php";
  include "../../includes/koneksi.php";
  
  $DB = new database($userid, $passwd, $DBName); 
  $DSMS = new database($userid, $passwd, $DBName);
  	
if (!substr($REMOTE_ADDR,0,9)=='192.168.2' && $kantor!="KP") {
 echo "Hanya Untuk Administrator Dari Kantor Pusat, Dont' Try Me";
 die;
}
?>

<html>
<title>Kirim Ulang SMS</title>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<script LANGUAGE="JavaScript">
function submitForms() {
if ( (isProposal()))
if (confirm)
{ 
return true;
}
else
{
return false;      
}
else
return false;
}

function isProposal() {
 var prefix = document.propmtc01.prefixpertanggungan.value;
 var noper = document.propmtc01.nopertanggungan.value;
 var nopol = document.propmtc01.nopol.value;
 if (prefix == "" && noper == "" && nopol == "") {
   alert("Silakan isi Nomor Proposal / Polis atau Nomor Polis Lama!!")
	 document.propmtc01.nopertanggungan.focus();
	 return false;
 }
 return true;
}

</script>

<body topmargin="0" bgcolor="#b9e1f7">
<?php
$sms="SELECT   A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN NOPOLIS,A.PREFIXPERTANGGUNGAN,
				 NOACCOUNT,
				 (SELECT   MAX (NILAIRP)
					FROM   $DBUser.TABEL_300_HISTORIS_PREMI
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND KDKUITANSI = 'BP3')
				 + (SELECT   SUM (NILAI)
					  FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
					 WHERE       prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND JENIS = 'B')
					PREMI,
				 (SELECT   TO_CHAR (EXPIREDDATE, 'DD/MM/YYYY') EXPDATE
					FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND JENIS = 'B')
					EXPDATE,
				 (SELECT    nvl(no_ponsel,PHONETETAP02)
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOPEMEGANGPOLIS)
					PHONE,
					(select kdmapping from $DBUser.TABEL_001_KANTOR where kdkantor=c.prefixpertanggungan )||c.nopertanggungan h2h,
				 (SELECT   NAMAKLIEN1
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOPEMEGANGPOLIS)
					NAMA
		  FROM   $DBUser.TABEL_214_UNDERWRITING a,
				 $DBUser.TABEL_100_KLIEN_ACCOUNT b,
				 $DBUser.TABEL_200_PERTANGGUNGAN c
		 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
				 AND a.nopertanggungan = b.nopertanggungan
				 AND a.prefixpertanggungan = c.prefixpertanggungan
				 AND a.nopertanggungan = c.nopertanggungan
				 AND a.prefixpertanggungan = '".$prefixpertanggungan."'
				 AND a.nopertanggungan = '".$nopertanggungan."'
				 AND b.kdbank = 'BNI'";
	//	echo $sms;
		$DSMS->parse($sms);
		$DSMS->execute();
		$arsms=$DSMS->nextrow();
	
		$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", permohonan asuransi Anda DISETUJUI,Lakukan pemb premi melalui cara goo.gl/mH77Fq dg kode bayar ".
			 $arsms["H2H"]." Rp. ".$arsms["PREMI"].". Info 1500151";
			 
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONE"]."','".$msg."','TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
		
			 
		
	
if(mysql_query($mysqlins)){
  echo "SMS Ke Pemegang Polis Telah Terkirim";
  } 
?>
<hr size=1>
<font face="verdana" size="2"><a href="#" onClick="window.close()">Close</a></font>
</body>
</html>
