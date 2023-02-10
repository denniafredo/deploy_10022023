<?php
		  include "../../includes/session.php";
		  include "../../includes/database.php";
			include "../../includes/common.php";

			
function Pilih()
{
	$DB=New Database($userid, $passwd, $DBName);
	$prefixpertanggungan = $kantor;
 
 	$sql= "select a.kdkantor,a.kdjeniskantor,a.kdkantorinduk,a.namakantor,".
	      "b.namajeniskantor from ".
        "$DBUser.tabel_001_kantor a,$DBUser.tabel_006_jeniskantor b ".
			  "where a.kdjeniskantor=b.kdjeniskantor and a.kdkantorinduk='$kdkantor'";
			
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	       $kdkantor = $arr["KDKANTOR"];
				 $namakantor = $arr["NAMAKANTOR"];
	echo "Kd Kantor   : ".$kdkantor."<br>";
	echo "Nama Kantor : ".$namakantor."<br>";
}

function Show($nopertanggungan,$prefixpertanggungan)
{
//echo "<p align=\"center\">";
}
?>

<script language="javascript">
function Tampil(theForm)
{
  theForm.tJenis.value="I"
}
</script>

<form name="peliharapolis" action="regionalofc.php" method=post>
<input type="hidden" name="tJenis" value>
<?
switch ($tJenis)
{
   case "":
          Pilih();
          break;
   case "I": 
	        Pilih();          
          Show($nopertanggungan,$prefixpertanggungan);
          break;
}
?>
</form>
<!------------ mulai query fungsi show -------------- -->
<? 
 $DB=New Database($userid, $passwd, $DBName);	
	 
 $sql = "select a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
         "a.nopemegangpolis, a.nopembayarpremi, a.nopenagih, a.noagen, ".
	       "a.expirasi, a.lamapembpremi_th, a.lamapembpremi_bl as periode_bulan, ".
				 "a.lamaasuransi_th, a.lamaasuransi_bl, a.notertanggung, a.kdproduk, a.kdvaluta,".
				 "a.juamainproduk, a.premi1, a.premi2, a.nosp, a.kdcarabayar, a.indexawal, ".
				 "a.tglnextbook, a.tgllastpayment, a.kdstatusmedical, b.namaproduk, b.keterangan, ".
				 "c.namacarabayar, pemegangpolis.alamattetap01, pemegangpolis.alamattetap02, ".
				 "pemegangpolis.kodepostetap, pemegangpolis.phonetetap01, ".
				 "pemegangpolis.namaklien1 as pemegangpolis, tertanggung.namaklien1 as tertanggung, ".
				 "pembayarpremi.namaklien1 as pembayarpremi ".
				 "from ".
				 "$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_202_produk b, $DBUser.tabel_305_cara_bayar c, ".
				 "$DBUser.tabel_100_klien pemegangpolis, $DBUser.tabel_100_klien tertanggung,  $DBUser.tabel_100_klien pembayarpremi ".
				 "where ".
				 "(b.kdproduk=a.kdproduk) and (a.notertanggung=tertanggung.noklien) and ".
				 "(a.nopembayarpremi=pembayarpremi.noklien) and ".
				 "(a.nopemegangpolis=pemegangpolis.noklien) and (a.kdcarabayar=c.kdcarabayar) and ".
				 "(a.prefixpertanggungan='$prefixpertanggungan') and ".
				 "(a.nopertanggungan='$nopertanggungan')";
				 	 
	//$DB->parse($sql);
	$xx = $DB->parse($sql);
	$DB->execute();
	$today = date("j-g-Y"); 
	
		$arr=$DB->nextrow();
		$nosp = $arr["NOSP"];
		$tglsp = $arr["TGLSP"];
		$notertanggung = $arr["NOTERTANGGUNG"];
		$kdproduk = $arr["KDPRODUK"];
		$usia_th = $arr["USIA_TH"];
		$mulas = $arr["MULAS"];
		$expirasi = $arr["EXPIRASI"];
		$lamaasuransi_th = $arr["LAMAASURANSI_TH"];
		$lamaasuransi_bl = $arr["LAMAASURANSI_BL"];
		$lamapembpremi_th = $arr["LAMAPEMBPREMI_TH"];
		$lamapembpremi_bl = $arr["PERIODE_BULAN"];
		$indexawal = $arr["INDEXAWAL"];
		$premi1 = $arr["PREMI1"];
		$premi2 = $arr["PREMI2"];
    $juamainproduk = $arr["JUAMAINPRODUK"];
		$kdstatusmedical = $arr["KDSTATUSMEDICAL"];
		$kdcarabayar = $arr["KDCARABAYAR"];
    $kdvaluta = $arr["KDVALUTA"];
    $pemegangpolis = $arr["PEMEGANGPOLIS"];
		$tertanggung = $arr["TERTANGGUNG"];
		$nopemegangpolis = $arr["NOPEMEGANGPOLIS"];
		$nopembayarpremi = $arr["NOPEMBAYARPREMI"];
		$pembayarpremi = $arr["PEMBAYARPREMI"];
		$nopenagih = $arr["NOPENAGIH"];
		$noagen = $arr["NOAGEN"];
		$jua = $arr["JUAMAINPRODUK"];
		
	/************ tgl lastpayment, nextbooked ***********/	
  $qry = "select a.tglnextbook, a.tgllastpayment, a.tglakhirpremi ".
         "from $DBUser.tabel_200_pertanggungan a ".
				 "where a.prefixpertanggungan='$prefixpertanggungan' and ".
				 "a.nopertanggungan='$nopertanggungan'";
		     $DB->parse($qry);
	       $DB->execute();
	       $ara=$DB->nextrow();
				 $tglnextbook = $ara["TGLNEXTBOOK"];
				 $tgllastpayment = $ara["TGLLASTPAYMENT"];
				 $tglakhirpremi = $ara["TGLAKHIRPREMI"];
				 
  $query = "select max(tglseatled) maxseatled ".
           "from $DBUser.tabel_300_historis_premi ".
				   "where prefixpertanggungan='$prefixpertanggungan' and ".
				   "nopertanggungan='$nopertanggungan'";
					 
				//	 select max(tglseatled) maxseatled from tabel_300_historis_premi where nopertanggungan
					 
		     $DB->parse($query);
	       $DB->execute();
	       $arc=$DB->nextrow();
				 $tglpembayaran = $arc["MAXSEATLED"];
 ?>
 
 <?
//---------- mulai check row ---------------
	$total = OCIRowCount($xx);                                             
   if ($total== 0) { 
			echo "<font face=\"Verdana\" size=\"1\">Isi Nomor Polis </font>";   
			echo "<br>";
			}                                                            
   elseif ($total> 0)
      {
//--------------------------------------------

echo "<p align=\"center\">";
echo "<font face=\"verdana\" size=\"3\"><b>NO. POLIS : ".$prefixpertanggungan." - ".$nopertanggungan."</b></font>";
?>
<div align="center">
<table border="2" cellpadding="2" width="700" bordercolor="#9999FF">
<tr>
<td width="100%" bordercolor="#FFFFFF"> 

<table border="0" width="100%">
  <tr>
    <td width="100%" bgcolor="#89A6C9">
 
<table border="0" cellpadding="0" cellspacing="1" width="100%">
  <tr>
    <td width="100%" colspan="4" bgcolor="#C0C0C0" align="center">
      <b>POLIS</b>
    </td>
  </tr>

  <tr>
    <td width="112"  class="ade">SP nomor&nbsp;&nbsp;&nbsp; :</td>
    <td width="105"  class="ade1"><? echo $nosp; ?></td>
    <td width="116" class="ade">Tanggal :</td>
    <td width="194" class="ade1"><? echo $tglsp; ?></td>
  </tr>
 <!-- <tr>
    <td width="527" colspan="4" bgcolor="#FFFFFF" class="ade3">
      <p align="right"><b>Tertanggung</b></td>
  </tr> -->
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td width="112"  class="ade">Tgl. Tagih&nbsp;&nbsp;&nbsp; :</td>
    <td width="105"  class="ade1"><? echo $tglnextbook; ?></td>
    <td width="116" class="ade">Tgl. Pembayaran :</td>
    <td width="194" class="ade1"><? echo $tglpembayaran; ?></td>
  </tr>
  <tr>
    <td width="112"  class="ade"></td>
    <td width="105"  class="ade1"></td>
    <td width="116" class="ade">Tgl. Akhir Premi :</td>
    <td width="194" class="ade1"><? echo $tglakhirpremi; ?></td>
  </tr>
 <!-- <tr>
    <td width="527" colspan="4" bgcolor="#FFFFFF" class="ade3">
      <p align="right"><b>Tertanggung</b></td>
  </tr> -->
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td width="112" class="ade">Klien nomor :</td>
    <td width="105" class="ade1"><? echo $notertanggung; ?></td>
    <?
	$DA=New Database($userid, $passwd, $DBName);
	$sql = "select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.tgllahir, a.jeniskelamin ".
				 	 	   "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c ".
		 					 "where a.kdpekerjaan=b.kdpekerjaan and a.kdhobby=c.kdhobby and a.noklien='$notertanggung' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
		?>
		<td width="116" class="ade">Nama :</td>
    <td width="194" class="ade1"><? echo $ara["NAMAKLIEN1"].",".$ara["NAMAKLIEN2"] ; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Tgl Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      :</td>
    <td width="105" class="ade1"><? echo $ara["TGLLAHIR"]; ?></td>
    <td width="116" class="ade">Jenis Kelamin :</td>
    <td width="194" class="ade1"><? echo $ara["JENISKELAMIN"]; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Pekerjaan&nbsp;&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo $ara["NAMAPEKERJAAN"]; ?></td>
    <td width="116" class="ade">Hobby :</td>
    <td width="194" class="ade1"><? echo $ara["NAMAHOBBY"]; ?></td>
  </tr>
 <!-- <tr>
    <td width="527" colspan="4" bgcolor="#C0C0C0" class="ade3">
      <p align="right"><b>Produk&nbsp;</b></td>
  </tr> -->
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td width="112" class="ade">K o d e&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo $kdproduk; ?></td>
    <td width="116" class="ade">Nama :</td>
  <?		

	$sql = "select namaproduk from tabel_202_produk where kdproduk='$kdproduk' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
  ?>
	  <td width="194" class="ade1"><? echo $ara["NAMAPRODUK"]; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Medical&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
    <td width="105" class="ade1"><? echo $kdstatusmedical; ?></td>
    <td width="116" class="ade">Tgl Mulai :</td>
    <td width="194" class="ade1"><? echo $mulas; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">U&nbsp; s&nbsp; i&nbsp; a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo $usia_th; ?>&nbsp;&nbsp;&nbsp; tahun</td>
    <td width="116" class="ade">Lama Asuransi :</td>
    <td width="194" class="ade1"><? echo $lamaasuransi_th; ?>&nbsp; tahun,&nbsp;&nbsp;<? echo $lamaasuransi_bl; ?>&nbsp;&nbsp;&nbsp; bulan</td>
  </tr>
  <tr>
    <td width="112" class="ade">Tgl Ekspirasi :</td>
    <td width="105" class="ade1"><? echo $expirasi; ?></td>
    <td width="116" class="ade">Lama Pem. Premi :</td>
    <td width="194" class="ade1"><? echo $lamapembpremi_th; ?>&nbsp; tahun,&nbsp;&nbsp;<? echo $lamapembpremi_bl; ?>&nbsp;&nbsp;&nbsp; bulan</td>
  </tr>
  <tr>
    <td width="112" class="ade">V a l u t a&nbsp;&nbsp;&nbsp;&nbsp; :</td>
	<?		
	$sql = "select namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
  ?>
    <td width="105" class="ade1"><? echo $ara["NAMAVALUTA"]; ?></td>
    <td width="116" class="ade">Cara Bayar :</td>
 	<?		
	$sql = "select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar='$kdcarabayar' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
  ?>
    <td width="194" class="ade1"><? echo $ara["NAMACARABAYAR"]; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Index Awal&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo $indexawal; ?></td>
    <td width="116" class="ade">Premi 1 : </td>
    <td width="194" class="ade1"><? echo number_format($premi1,2); ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">J U A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo number_format($juamainproduk,2); ?></td>
    <td width="116" class="ade">Premi 2 :</td>
    <td width="194" class="ade1"><? echo number_format($premi2,2); ?></td>
  </tr>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr> 
 <!-- <tr>
    <td width="112"  class="ade2" align="left" bgcolor="#D7EBFF">Jenis</td>
    <td width="105"  class="ade2" align="left" bgcolor="#D7EBFF">Nomor Klien</td>
    <td width="116"  class="ade2" align="left" bgcolor="#D7EBFF">Hubungan</td>
    <td width="194"  class="ade2" align="left" bgcolor="#D7EBFF">Nama</td>
  </tr> -->
  <tr>
    <td width="112"  class="ade">Pemegang Polis :</td>
    <td width="105"  class="ade1"><? echo $nopemegangpolis; ?></td>
   <!-- <td width="116"  class="ade1"><? echo $hubungan; ?></td> -->
    <td width="194"  class="ade1" colspan=2><? echo $pemegangpolis; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Pembayar Premi:</td>
    <td width="105" class="ade1"><? echo $nopembayarpremi; ?></td>
   <!-- <td width="116" class="ade1"><? echo $hubungan; ?></td> -->
    <td width="194" class="ade1" colspan=2><? echo $pembayarpremi; ?></td>
  </tr>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr> 	
	<tr>
      <td colspan="4">
  <? 
  $qry = "select ".
         "a.*, d.namaklien1, d.noklien, ".
				 "decode(a.notertanggung, a.noklien,'PEMEGANG POLIS', ".
				 "(select namahubungan from $DBUser.tabel_218_kode_hubungan c ".
				 "where b.kdhubungan=c.kdhubungan)) as hubungan ".
				 "from $DBUser.tabel_219_pemegang_polis_baw a, ".
				 "$DBUser.tabel_113_insurable b, $DBUser.tabel_100_klien d ".
				 "where a.notertanggung=b.notertanggung(+) and ".
				 "a.noklien=b.noklieninsurable(+) and ".
				 "a.noklien=d.noklien and ".
				 "a.kdinsurable='04' and ".
				 "a.prefixpertanggungan='$prefixpertanggungan' and ".
				 "a.nopertanggungan='$nopertanggungan'";
	
	$DB->parse($qry);
	$DB->execute();
	echo "<table width=\"100%\">";
		 echo "<tr>";
		 echo "<td bgcolor=\"#D7EBFF\"><font face=\"Verdana\" size=\"1\"><b>Ahli Waris</b></font></td>";
		 echo "<td bgcolor=\"#D7EBFF\"><font face=\"Verdana\" size=\"1\"><b>No. Klien</b></font></td>";
		 echo "<td bgcolor=\"#D7EBFF\"><font face=\"Verdana\" size=\"1\"><b>Hubungan</b></font></td>";
		 echo "<td bgcolor=\"#D7EBFF\"><font face=\"Verdana\" size=\"1\"><b>Nama</b></font></td>";
		 echo "</tr>";
						 
	
	while($ars=$DB->nextrow()){

	   $i = 0;
		 $i = $count + 1;
		 echo "<tr>";
		 echo "<td><font face=\"Verdana\" size=\"1\">";
		 echo "Ahli Waris ".$i.". ";
		 echo "</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">";
		 echo $ars["NOKLIEN"];
		 echo "</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">";
		 echo $ars["HUBUNGAN"];
		 echo "</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">";
		 echo $ars["NAMAKLIEN1"];
		 echo "</font></td>";
		 $count++;
		 	echo "</tr>";
		 }
  echo "</table>";							 
?>
     </td>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td width="112"  class="ade">Penagih :</td>
	<?	
	$sql = "select namaklien1,namaklien2,noklien from $DBUser.tabel_100_klien where noklien=$nopenagih ";

	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
  ?>
    <td width="105" class="ade1"><? echo $ara["NOKLIEN"]; ?></td>
    <td width="116" class="ade1"><? echo $ara["NAMAKLIEN1"]; ?></td>
    <td width="194" class="ade1"><? echo $ara["NAMAKLIEN2"]; ?></td>
  </tr>
  <tr>
  <?		

	$sql = "select namaklien1,namaklien2,noklien from $DBUser.tabel_100_klien where noklien=$noagen ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
  ?>
	  <td width="112" class="ade">Agen&nbsp;&nbsp;&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo $ara["NOKLIEN"]; ?></td>
    <td width="116" class="ade1"><? echo $ara["NAMAKLIEN1"]; ?></td>
    <td width="194" class="ade1"><? echo $ara["NAMAKLIEN2"]; ?></td>
  </tr>
  <tr>
   <? 
		  $sql = "select kdstatusfile,namastatusfile ".
			       "from $DBUser.tabel_299_status_file";	
			$DB->parse($sql);	
			$DB->execute();	  
		  $ara=$DB->nextrow();	
		  $DB->destruct();
  ?>	

    <td width="112" class="ade">Status&nbsp;&nbsp; :</td>
    <td width="105" class="ade1"><? echo $ara["NAMASTATUSFILE"]; ?></td>
    <td width="116" class="ade"></td>
    <td width="194" class="ade"></td>
  </tr>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
	<tr>
    <td colspan="4" align="center">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT\" onclick=\"javascript:window.open('showbenefit.php?nopertanggungan=%s&kdproduk=%s','popuptebus','width=760,height=400,top=50,left=50,scrollbars=yes');\">",$nopertanggungan,$kdproduk); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS PREMI\" onclick=\"javascript:window.open('historispremi.php?nopertanggungan=%s&kdproduk=%s','popuptebus','width=760,height=350,top=50,left=50,scrollbars=yes');\">",$nopertanggungan,$kdproduk); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"MUTASI\" onclick=\"javascript:window.open('historismutasi.php?nopertanggungan=%s&kdproduk=%s','popuptebus','width=760,height=350,top=50,left=50,scrollbars=yes');\">",$nopertanggungan,$kdproduk); ?>
	  <? printf("<input type=\"button\" name=\"tariftebus\" value=\"NILAI TEBUS\" onclick=\"javascript:window.open('tebus.php?jua=%s&pref=%s&noper=%s','popuptebus','width=400,height=500,top=50,left=50,scrollbars=yes');\">",$jua,$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"KOMISI\" onclick=\"javascript:window.open('popkomisi.php?nopertanggungan=%s&noagen=%s','popupkomisi','width=400,height=300,top=100,left=100');\">",$nopertanggungan,$noagen); ?>
		</td>
  </tr>
</table>

   </td>
  </tr>
</table> 
</td>
</tr>
</table>
</div>
<? } 
?>
<hr size="1">
<a href="../mnuutama.php"><font face="Verdana" size="2">Menu Utama</font></a>