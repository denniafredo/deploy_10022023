<?  
  include "../includes/database.php"; 
  include "../includes/session.php"; 
  //echo $modul."SSASADS";
 if($modul=="CTK"){
	  header("Location: mainmenu.php");
 }
		//include "includes/whoisonline.php";
		/* $hostname  = "localhost"; 
		$username	 = "root"; 
		$password	 = "bulunpekpepitu"; 
		$dbname		 = "jwslanun";

		@mysql_connect($hostname, $username, $password) or die("Couldn't connect to server"); 
		@mysql_select_db($dbname) or die("Unable to select database"); 

		*/
	$DB = new Database($userid,$passwd,$sdb);
	$sqlb = "select to_char(add_months(last_day(sysdate),-1)+1,'DD/MM/YYYY') beginbill from dual";
		$DB->parse($sqlb);
		$DB->execute();			 
		$asb=$DB->nextrow();
		$beginbilling = $asb["BEGINBILL"];
					 
	$bulanbilling = substr($beginbilling,3,2);
	$tahunbilling = substr($beginbilling,6,4);
  switch ($bulanbilling)	{
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
 
	$sqla = "select to_char((last_day(sysdate) + 5),'DD/MM/YYYY') lastbill from dual";
			     $DB->parse($sqla);
	         $DB->execute();			 
					 $asa=$DB->nextrow();
					 $lastbilling = $asa["LASTBILL"];
					 
	$sqlb = "select to_char(trunc(sysdate,'MONTH')+4,'DD/MM/YYYY') akhirbill from dual";
				   $DB->parse($sqlb);
	         $DB->execute();			 
					 $asb=$DB->nextrow();
					 $akhirbilling = $asb["AKHIRBILL"];
					 	
	$sql = "select decode(sign(5 - to_number(to_char(sysdate,'dd'))),-1,(last_day(sysdate) + 5) - ".
	       "sysdate,5-to_number(to_char(sysdate,'dd'))) hitunghari from dual";
			     $DB->parse($sql);
	         $DB->execute();			 
					 $ass=$DB->nextrow();
					 $hithari = $ass["HITUNGHARI"];
			 
	if($hithari<=5){
	   $akhirproses = $akhirbilling;
	} else {
	   $akhirproses = $lastbilling;
	}
	
	if($hithari==1){
	  $warningtext ="Batas waktu penyelesaian transaksi ".
		              "anda tinggal <b>1 hari sampai dengan ".
									"jam 23:59:59</b>, jika tidak transaksi akan dimasukkan ".
									"untuk transaksi periode berikutnya.";
	} else if ($hithari==0){
	  $warningtext = "Hari ini proses billing & booking.";
	} else {
	  $warningtext ="Segeralah selesaikan proses transaksi Anda ".
		              "untuk hari ini, jangan ditunda.<br>Lewat tangal <font color=red>$akhirproses</font> transaksi Anda akan diproses untuk periode berikutnya";
	}

?>
<script language="JavaScript" type="text/javascript">
  function buka()
	{
	  //NewWindow('../network/whatnew.php','popuppage',600,400,1);
	 	 // window.open('../network/whatnew.php','caripage','width=400,height=300,top=100,left=100,scrollbars=yes');
		  
		  window.open('../network/warnClaim.php','caripage1','width=400,height=300,top=100,left=700,scrollbars=yes');

		//window.open('../network/whatnew.php','toolbar=no, width=350, height=400, status=no,scrollbars=yes, resize=yes, menubar=yes'); 
	}

	function rekapWelcomingCall () {
		window.open('../jiwasraya/pelaporan/rekapWelcomingCall.php','myWindow','width=400,height=300,top=100,right=700,scrollbars=yes')
	}


</script>

<link href="jws.css" rel="stylesheet" type="text/css">

<? 
$tglisi = date("d/m/Y");
  	$sql = "select * from pengumuman ".
  				 "where date_format(tanggal,'%d/%m/%Y') = '$tglisi' ".
  				 "order by id desc";
  	//echo $sql;
  	//$res = mysql_query ($sql);
  	//$ada = mysql_num_rows($res);
	//  if($ada > 0)
	//	{
  		?>
      <body onLoad="buka();rekapWelcomingCall();"> 
  		<? 
	//	}
	//	else
	//	{
		  ?>
      <body onload="buka();rekapWelcomingCall();"> 
<!--			<body>--> 
			<?
		//}
		?>
	

<div align="center">

<table border="0">
<tr>
<td>

<table border="0" bgcolor="#78bdd8" cellspacing="1" cellpadding="3" width="110">
  <tr>
    <td width="100%" bgcolor="#ffffff">
<table border="0" cellspacing="3" cellpadding="6" width="100%">
  <tr>
    <td width="100%" bgcolor="#fe8b85" align="center">
<? 
    switch($hithari){
		 case "0" : $countdown = "HARI INI"; $ket="Billing & Booking"; $tglket="$akhirproses"; break;
		 default : $countdown = $hithari; $ket="hari lagi !";
		}
				 echo "<font face=verdana size=10><b>".$countdown."  </b></font>";
		if($hithari==0) {
				 echo "<font face=verdana size=2><b>".$tglket."  </b></font>";
		}
?>
    </td>
	 
  </tr>
</table>
    </td>
  </tr>
	<tr>
    <td width="100%" bgcolor="#ffffff" align="center">
		<table border="0" cellspacing="3" cellpadding="3" width="100%" >
  <tr>
    <td width="100%" bgcolor="#fe8b85" align="center">
        <font face=verdana size=2 color="black"><b><? echo $ket; ?></b></font>
    </td>
  </tr>
   </table>
		
		</td>
	</tr>
</table>

</td>
<td>
<!--#FF9933-->
<? 
if($hithari==0) {

} else {
 ?>
<table border="0" width="400" bgcolor="#78bdd8" cellspacing="1" cellpadding="3">
  <tr>
    <td width="100%" bgcolor="#FFFFFF" class="verdana9blu" align="center">
		<b>
			<? 
			echo "Tanggal <font color=red>$akhirproses</font> <br>".
				   "akan dilakukan proses billing & booking !<br>";				
			echo $warningtext; 
      ?>
			<br><br>
			<a class="verdana10blu" href="pelaporan/showendbillingkantor.php"><b>Melihat Transaksi Produksi Anda Bulan ini</b></a>
			</b>
		</td>
  </tr>
</table>
<? 
}
 ?>

</td>
</tr>
</table>
<br>
<font face="verdana" size="2" color="red"><a href="mainmenu.php"><b>KLIK DISINI UNTUK KE MENU UTAMA</b></a></font><BR><BR>
<table border="0" style="border-collapse: collapse" bordercolor="#111111" width="600" id="AutoNumber1" cellpadding="2">
  <tr>
    <td width="100%" class="verdana9blu" align="center"><b>PENGUMUMAN!</b></td>
  </tr>
  <tr>
   <!--<td width="100%" class="verdana10" align="center"><font color=red><b>PERWAKILAN HARAP MEMBERSIHKAN DATA AGEN YANG DUPLIKAT (<a href="./polis/delagenpen.php">Klik Disini</a>)</b></td> -->
   <td width="100%" class="verdana10" align="center"><font color=red><b>CEK POLIS DUPLIKAT KANTOR ANDA !(<a href="./pelaporan/polisduplikat.php">Klik Disini</a>) <img src="img/new.gif"></b></td>
  </tr>	
  <tr><td width="100%" class="verdana10" align="center"><font color=red><b>CEK DAFTAR JATUH TEMPO KLAIM BERKALA ANDA !(<a href="./polis/klaim_anuitas_kolektif_new.php">Klik Disini</a>) <img src="img/new.gif"></b></td>
  </tr>
  <tr>
    <td width="100%" class="verdana8blu">
		
		<lh>Sehubungan banyaknya keluhan dalam 
    melakukan pelunasan premi lanjutan, disampaikan beberapa hal sebagai berikut :</lh>
		<ol type="1">
      <li>Pelunasan premi NB dan OB lanjutan untuk bulan berikutnya baru dapat dilakukan 
			    setelah proses billing & booking untuk bulan tersebut dilalui.</li>
      <li>Karena banyaknya data konversi yang belum masuk/diterima oleh HO 
      sehingga kemungkinan tidak dilakukan billing & booking atas data-data tersebut.</li>
      <li>Pada prinsipnya proses billing booking diantaranya adalah menyediakan 
      adanya tagihan (tanggal booking) yang harus dilunasi, dengan demikian tanpa billing booking dan 
      tidak ada data tagihan maka pertanggungan tidak dapat dilunasi.</li>
			<li>Untuk melihat apakah suatu pertanggungan dapat dilunasi atau sudah 
      dilunasi untuk jatuh tempo yang diinginkan dapat dilihat/dipastikan melalui menu 
      Manajemen Informasi, Melihat Polis Satuan/Kondite Polis Satuan.</li>
			<li>Jika pada butir 4 tersebut di atas dilaksanakan, perhatikan apakah 
      pertanggungan memiliki tanggal booked. Tanggal Seatled kosong artinya pertanggungan belum 
      dilunasi (maka pertanggungan ini baru dapat dientry pelunasannya). Tanggal seatled 
      terisi artinya pertanggungan telah dilunasi.</li>
      <li>Kondisi tersebut di atas terpenuhi maka terhadap suatu pertanggungan 
      baru dapat dilakukan pelunasannya.</li>
    </ol>
    </td>
  </tr>
</table>
</div>
</body>