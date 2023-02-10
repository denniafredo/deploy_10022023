<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 $prefixpertanggungan = $kantor;

function Pilih() {
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<style>
.ade         { font-family: Arial; font-size: 8pt; color:#000000 ; margin-top: 0; 
               margin-bottom: 0 }
.ade3        { font-family: Arial; font-size: 8pt; color:#000000 ; margin-top: 0; 
               margin-bottom: 0  }
.ade2        { font-family: Arial; font-size: 8pt; font-weight:bold; color: #000000; margin-top: 0; 
               margin-bottom: 0 }
.ade1         { font-family: Arial; font-size: 8pt; font-style:italics; color: #000000; margin-top: 0; 
              margin-bottom: 0 }
</style>

<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F3000</font></td></tr>
</table>
<font face="Verdana" size="2"><b>Cari Nomor Polis</b></font>
<hr size=1>
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>
		<input type="text" name="nopertanggungan" size="12" maxlength="9" onblur="javascript:validasi(this.form.nopertanggungan)"></td>
		<td><a href="#" onclick="window.open('popproposal.php?nopertanggungan=%s','popuppage','scrollbars=yes,width=500,height=300,top=100,left=50');">
		<img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a></td>
    <td>&nbsp;<? echo "<input type=\"submit\" value=\"Submit\" name=\"insert\" onClick=\"Tampil(this.form)\">";?></td>
    <td width="200" height="21"></td>
  </tr>
</table>
</font>
<hr size=1>
<? 
}
function Show($nopertanggungan,$prefixpertanggungan) {
}
?>
<script language="javascript">
function Tampil(theForm) {
  theForm.tJenis.value="I"
}
</script>
<form name="peliharapolis" action="desisi1.php" method="post">
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
  $DB=New database($userid, $passwd, $DBName);	
	$today = date("F j, Y, g:i a");

	$sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantor='$kantor'";
	$DB->parse($sql);
	$DB->execute();
	$ass=$DB->nextrow();
	$namakantor=$ass["NAMAKANTOR"];

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
				 "(a.nopertanggungan='$nopertanggungan') and a.kdpertanggungan='1'";
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
		$almtpemegangpls1 = $arr["ALAMATTETAP01"];
		$almtpemegangpls2 = $arr["ALAMATTETAP02"];
		$almtpemegangpkdpos = $arr["KODEPOSTETAP"];
		$almtpemegangpphone = $arr["PHONETETAP01"];
		
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
  $DB->parse($query);
  $DB->execute();
  $arc=$DB->nextrow();
 $tglpembayaran = $arc["MAXSEATLED"];
?>
<?
/*/---------- mulai check row ---------------
	$total = OCIRowCount($xx);                                             
   if ($total== 0) { 
			echo "<font face=\"Verdana\" size=\"1\">Isi Nomor Polis </font>";   
			echo "<br>";
			}                                                            
   elseif ($total> 0)
      {
*///--------------------------------------------

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
	$DA=New database($userid, $passwd, $DBName);
	$sql = "select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.tgllahir, a.jeniskelamin ".
				 	 	   "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c ".
		 					 "where a.kdpekerjaan=b.kdpekerjaan and a.kdhobby=c.kdhobby and a.noklien='$notertanggung' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
		<td width="116" class="ade">Nama :</td>
    <td width="194" class="ade1"><? echo $ara["NAMAKLIEN1"].",".$ara["NAMAKLIEN2"]; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Tgl Lahir&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
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
	$sql="select namaproduk from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
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
	$sql="select namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta'";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
    <td width="105" class="ade1"><? echo $ara["NAMAVALUTA"]; ?></td>
    <td width="116" class="ade">Cara Bayar :</td>
<?		
	$sql="select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar='$kdcarabayar' ";
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
  $i=1;
	while($ars=$DB->nextrow()){
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
		$i++;
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
	$sql = "select namaklien1,namaklien2,noklien, from $DBUser.tabel_100_klien where noklien=$nopenagih ";
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
<!------------------------------ mulai desisi ---------------------------------------->
<table border="0" width="700">
  <tr>
    <td width="100%"><font face="Verdana" size="2"><b>DESISI 1</b></font></td>
  </tr>
  <tr>
    <td width="100%"></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0" width="100%" bgcolor="#006699" cellspacing="1" cellpadding="10">
        <tr>
          <td width="100%" bgcolor="#FFFFFF">
            <p align="center"><b><font face="Arial Black" size="4" color="#000080">PT ASURANSI
            JIWA IFG</font></b></p>
            <p><font face="Verdana" size="2"><b>DESISI ASURANSI JIWA MEDICAL</b></font></p>
            <table border="0" width="100%">
              <tr>
                <td width="44%" colspan="2"><font face="Verdana" size="2" color="#606060">Untuk Branch&nbsp; Office</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $namakantor; ?></font></td>
              </tr>
              <tr>
                <td width="4%"><font face="Verdana" size="2" color="#606060">1.</font></td>
                <td width="40%"><font face="Verdana" size="2" color="#606060">Nomor S.P.A.J</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $nosp; ?></font></td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%"><font face="Verdana" size="2" color="#606060">Tanggal</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $tglsp; ?></font></td>
              </tr>
              <tr>
                <td width="4%"><font face="Verdana" size="2" color="#606060">2.</font></td>
                <td width="40%"><font face="Verdana" size="2" color="#606060">Nama Pemegang Polis</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $pemegangpolis; ?></font></td>
              </tr>
              <tr>
                <td width="4%"><font face="Verdana" size="2" color="#606060">3.</font></td>
                <td width="40%"><font face="Verdana" size="2" color="#606060">Nama Tertanggung</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: 
<?
	$DA=New database($userid, $passwd, $DBName);
	$sql = "select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.tgllahir, a.jeniskelamin ".
	 	 	   "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c ".
				 "where a.kdpekerjaan=b.kdpekerjaan and a.kdhobby=c.kdhobby and a.noklien='$notertanggung' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
								<? echo $ara["NAMAKLIEN1"]; ?></font></td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%"></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%">
                  <p align="right"><b><font face="Verdana" size="2" color="#606060">DITERIMA
                  STANDARD PER</font></b></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="44%" colspan="2"><font face="Verdana" size="2" color="#606060">Dengan
                  ketentuan</font></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">a)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Macam
                  Polis</font></td>
<?	
	$sql = "select namaproduk,keterangan from $DBUser.tabel_202_produk where kdproduk='$kdproduk' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $ara["NAMAPRODUK"]; ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">b)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Macam Asuransi</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $ara["KETERANGAN"]; ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">c)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Jumlah Uang Asuransi</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo number_format($juamainproduk,2); ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">d)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Lama Asuransi</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $lamaasuransi_th." TAHUN ".$lamaasuransi_bl." BULAN";?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">e)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Lama Pembayaran Premi</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $lamapembpremi_th." TAHUN ".$lamapembpremi_bl." BULAN";?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">f)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Cara Pembayaran Premi</font></td>
<?		
	$sql = "select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar='$kdcarabayar' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
							  <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $ara["NAMACARABAYAR"]; ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">g)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Premi Standard Tahunan</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo number_format($premi1,2); ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">h)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Premi</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo number_format($premi2,2); ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">i)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Indeks Dasar</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $indexawal; ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">j)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Alamat Rumah Pemegang Polis</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $almtpemegangpls1." ".$almtpemegangpls2."-".$almtpemegangpkdpos;?><BR>
								&nbsp;&nbsp;<? echo "Telp.".$almtpemegangplsphone;?>
								</font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">k)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Alamat Penagihan Premi</font></td>
<?	
	$sql = "select namaklien1,namaklien2,noklien,alamattetap01,alamattetap02,phonetetap01 ".
	       "from $DBUser.tabel_100_klien where noklien=$nopenagih ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
	$alamatpenagih1 = $ara["ALAMATTETAP01"];
	$alamatpenagih2 = $ara["ALAMATTETAP02"];
	$kdpospenagih = $ara["KODEPOSTETAP0"];
	$telppenagih = $ara["PHONETETAP01"];
?>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $alamatpenagih1." ".$alamatpenagih2." ".$kdpospenagih; ?>
								    <br>&nbsp;&nbsp;Telp. <? echo $telppenagih; ?>
								</font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"></td>
                <td width="40%" valign="top" align="left"></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060"></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">4.</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Besar
                  bunga keterlambatan pembayaran premi (jika ada)</font></td>
                <td width="56%">: <? echo $bungapremi; ?></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">5.</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Keterangan</font></td>
                <td width="56%">
                  <table border="0" width="100%">
                    <tr>
                      <td width="7%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">a)</font></td>
                      <td width="93%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Besar
                        premi tersebut di atas berlaku apabila dilunasi pada
                        bulan <? echo $bulanlunas; ?></font></td>
                    </tr>
                    <tr>
                      <td width="7%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">b)</font></td>
                      <td width="93%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Premi
                        BP3 + Biaya Polis + Materai agar dilunasi dan
                        disetorkan ke Kas Perusahaan, segera dilaporkan ke
                        <? echo $namakantor;?> supaya polis dapat diterbitkan. </font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%"></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%"></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">Jakarta, <? echo $today;?><br>
                  DIVISI PERTANGGUNGAN PERORANGAN</font>
                  <p><font face="Verdana" size="2" color="#606060"><br>
                  <? echo $pejabat;?><br>Kepala Divisi</font></td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%"></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="100%" colspan="3"><font face="Verdana" size="2" color="#606060">Tembusan :<br>
                  1. B.A.P. Head Office; Divisi Pertanggungan Perorangan<br>
                  2. B.A.P. <? echo $namakantor; ?>; Bagian Pertanggungan<br>
                  3. Pemeriksa <? echo $namakantor; ?>; untuk ditindak lanjuti<br>
                  4. Arsip </font></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<table border="0" width="100%">
  <tr>
    <td width="100%">
      <p align="center"><input type="submit" value="Kirim" name="B1"></td>
  </tr>
</table>
<!------------------------------ akhir desisi ---------------------------------------->
<hr size="1">
<a href="../mnuutama.php"><font face="Verdana" size="2">Menu Utama</font></a>