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
 
 
?>
<title>Laporan Akumulasi Dana Kepesertaan pada Program THT (produk pendanaan saving plan)</title>
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
        <!--img src="email/ucapan_tahun_baru_2017.jpg" width="420" height="380">      <br-->
        <p>Yth. Bpk/Ibu Peserta Program Tabungan Hari Tua (THT)<br>
		Pupuk Kalimantan Timur<br>
		di -&nbsp;Bontang</p>
		<br>
		<br>
		<p>Dengan Hormat,</p>
		<p>Bersama ini kami sertakan Laporan Akumulasi Dana Kepesertaan Bapak/Ibu pada Program THT (produk pendanaan saving plan) posisi per 31 Desember 2017.</p>
		<p>&nbsp;</p>
		<p>Demikian kami sampaikan, atas kepercayaan dan perhatiannya kami ucapkan terima kasih.</p>      
    </div>           
  </tr>
  <tr>
    <td style="border-left-color: #111111; border-left-width: 1; border-right-color: #111111; border-right-width: 1">&nbsp;</td>
  </tr>
</table>
<br/><br/>
</body>
</html>