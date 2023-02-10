<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 $prefixpertanggungan = $kantor;
// $nopertanggungan = "000000033";
 ?>
 <link href="../jws.css" rel="stylesheet" type="text/css">
 <style>
<!--
.ade         { font-family: Arial; font-size: 8pt; color:#000000 ; margin-top: 0; 
               margin-bottom: 0 }
.ade3        { font-family: Arial; font-size: 8pt; color:#000000 ; margin-top: 0; 
               margin-bottom: 0  }
.ade2        { font-family: Arial; font-size: 8pt; font-weight:bold; color: #000000; margin-top: 0; 
               margin-bottom: 0 }
.ade1         { font-family: Arial; font-size: 8pt; font-style:italics; color: #000000; margin-top: 0; 
              margin-bottom: 0 }
-->
</style>
<?
function Pilih() {
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<table border="0" width="100%">
  <tr>
    <td width="100%" bgcolor="#C0C0C0">
      <p align="center"><font face="Verdana" size="2"><b>PROPOSAL MEDICAL SUDAH BAYAR BP3</b></font></td>
  </tr>
  <tr>
    <td width="100%">
      <table border="0">
        <tr>
          <td><font face="Verdana" size="2">NO. PROPOSAL</font></td>
          <td><font face="Verdana" size="2"><input type="text" name="nopertanggungan" size="10" maxlength="9" onblur="javascript:validasi(this.form.nopertanggungan)">&nbsp;&nbsp;
            <? printf("<a href=\"#\" onclick=\"window.open('poppropmedical.php?nopertanggungan=%s','popuppage','scrollbars=yes,width=600,height=300,top=100,left=50');\"><img src=\"../img/jswindow.gif\" border=\"0\" alt=\"cari nomor proposal\"></a>","%"); ?>
					</font>
					<? echo "<input type=\"submit\" value=\"Cek Proposal\" name=\"cek\" onClick=\"Tampil(this.form)\">";?>
					</td>
        </tr>
    <!--    <tr>
          <td><font face="Verdana" size="2">Tertanggung&nbsp;&nbsp;&nbsp;&nbsp; </font></td>
          <td><font face="Verdana" size="2"><input type="text" name="namatertanggung" size="25">&nbsp;&nbsp;
  	      <? echo "<input type=\"submit\" value=\"Cek Polis\" name=\"cek\" onClick=\"Tampil(this.form)\">";?></td>
          </td>
        </tr> -->
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%">
      <hr size="1" color="#D4D4D4">
    </td>
  </tr>
</table>
<? 
}
function Show($prefixpertanggungan,$nopertanggungan) {
// echo $nopertanggungan;
// echo "<input type=\"text\" value=$nopertanggungan>";
}
?>
<script language="javascript">
function Tampil(theForm)
{
  theForm.tJenis.value="I"
}
</script>
<form name="propmtc01" action="<? PHP_SELF ?>" method=post>
<input type="hidden" name="tJenis" value="<?echo $nopertanggungan;?>">
<?
switch ($tJenis) {
   case "":
          Pilih();
          break;
   case "I": 
	        Pilih();          
          Show($prefixpertanggungan,$nopertanggungan,$namatertanggung);
          break;
}
?>
</form>
<!--------------------------------------- start content ---------------------------------->
<? 
 $DB=New database($userid, $passwd, $DBName);	 
 $sqlz = "select a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
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
				 "(a.nopertanggungan='$nopertanggungan')";// and a.kdpertanggungan='2'";
				 	 
	$cek = $DB->parse($sqlz);
	$DB->execute();
	$rrr=$DB->nextrow();
	$total = OCIRowCount($cek);                                             
  if ($total== 0) { 
			echo "<font face=\"Verdana\" size=\"1\">Isi Nomor Polis </font>";   
			//echo "<br>";
	} elseif ($total> 0) {	
	 ?>
<div align="center">
<table border="0" width="450">
  <tr>
    <td width="100%">
      <table border="1" width="100%" bgcolor="#FFFFFF" cellspacing="1" bordercolor="#3366CC">
        <tr>
          <td width="100%" bgcolor="#fffff0">
            <p align="center">
<!----------------  start bagian info polis ----------------->						
<?
 $sql="select a.prefixpertanggungan, a.tglsp, a.mulas, a.usia_th, a.nopertanggungan, ".
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
				 "(a.nopertanggungan='$nopertanggungan')";// and a.kdpertanggungan='2'";
				 	 
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
				 
  $query="select max(tglseatled) maxseatled ".
         "from $DBUser.tabel_300_historis_premi ".
				 "where prefixpertanggungan='$prefixpertanggungan' and ".
				 "nopertanggungan='$nopertanggungan'";
				//	 select max(tglseatled) maxseatled from tabel_300_historis_premi where nopertanggungan
		     $DB->parse($query);
	       $DB->execute();
	       $arc=$DB->nextrow();
				 $tglpembayaran = $arc["MAXSEATLED"];
//---------- mulai check row ---------------
echo "<p align=\"center\">";
echo "<font face=\"verdana\" size=\"3\"><b>NO. PROPOSAL : ".$prefixpertanggungan." - ".$nopertanggungan."</b></font>";
?>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form name="proposalok" action="emailbayarbp3.php">
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td width="112"  class="ade">SP nomor</td>
    <td width="105"  class="ade1"><? echo $nosp; ?></td>
    <td width="116" class="ade">Tanggal</td>
    <td width="194" class="ade1"><? echo $tglsp; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Klien nomor</td>
    <td width="105" class="ade1"><? echo $notertanggung; ?></td>
<?
	$DA=New database($userid, $passwd, $DBName);
	$sql="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.tgllahir, a.jeniskelamin ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan and a.kdhobby=c.kdhobby and a.noklien='$notertanggung' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
		<td width="116" class="ade">Nama</td>
    <td width="194" class="ade1"><? echo $ara["NAMAKLIEN1"].",".$ara["NAMAKLIEN2"]; ?></td>
  </tr>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td width="112" class="ade">Kode</td>
    <td width="105" class="ade1"><? echo $kdproduk; ?></td>
    <td width="116" class="ade">Nama</td>
<?		
	$sql="select namaproduk from tabel_202_produk where kdproduk='$kdproduk' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
	  <td width="194" class="ade1"><? echo $ara["NAMAPRODUK"]; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Medical</td>
    <td width="105" class="ade1"><? echo $kdstatusmedical; ?></td>
    <td width="116" class="ade">Tgl Mulai</td>
    <td width="194" class="ade1"><? echo $mulas; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Usia</td>
    <td width="105" class="ade1"><? echo $usia_th; ?>&nbsp;&nbsp;&nbsp; tahun</td>
    <td width="116" class="ade">Lama Asuransi</td>
    <td width="194" class="ade1"><? echo $lamaasuransi_th; ?>&nbsp; tahun,&nbsp;&nbsp;<? echo $lamaasuransi_bl; ?>&nbsp;&nbsp;&nbsp; bulan</td>
  </tr>
  <tr>
    <td width="112" class="ade">Tgl Ekspirasi</td>
    <td width="105" class="ade1"><? echo $expirasi; ?></td>
    <td width="116" class="ade">Lama Pem. Premi</td>
    <td width="194" class="ade1"><? echo $lamapembpremi_th; ?>&nbsp; tahun,&nbsp;&nbsp;<? echo $lamapembpremi_bl; ?>&nbsp;&nbsp;&nbsp; bulan</td>
  </tr>
  <tr>
    <td width="112" class="ade">Valuta</td>
<?		
	$sql = "select namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta' ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
    <td width="105" class="ade1"><? echo $ara["NAMAVALUTA"]; ?></td>
    <td width="116" class="ade">Cara Bayar</td>
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
    <td width="112" class="ade">Index Awal</td>
    <td width="105" class="ade1"><? echo $indexawal; ?></td>
    <td width="116" class="ade">Premi 1</td>
    <td width="194" class="ade1"><? echo number_format($premi1,2); ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">JUA</td>
    <td width="105" class="ade1"><? echo number_format($juamainproduk,2); ?></td>
    <td width="116" class="ade">Premi 2</td>
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
    <td width="112"  class="ade">Pemegang Polis</td>
    <td width="105"  class="ade1"><? echo $nopemegangpolis; ?></td>
   <!-- <td width="116"  class="ade1"><? echo $hubungan; ?></td> -->
    <td width="194"  class="ade1" colspan=2><? echo $pemegangpolis; ?></td>
  </tr>
  <tr>
    <td width="112" class="ade">Pembayar Premi</td>
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
  $qry="select a.*,d.namaklien1,d.noklien,decode(a.notertanggung, a.noklien,'PEMEGANG POLIS', ".
			 "(select namahubungan from $DBUser.tabel_218_kode_hubungan c ".
			 "where b.kdhubungan=c.kdhubungan)) as hubungan ".
			 "from $DBUser.tabel_219_pemegang_polis_baw a, ".
			 "$DBUser.tabel_113_insurable b, $DBUser.tabel_100_klien d ".
			 "where a.notertanggung=b.notertanggung(+) and a.noklien=b.noklieninsurable(+) and ".
			 "a.noklien=d.noklien and a.kdinsurable='04' and ".
			 "a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'";
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
    <td class="ade">Penagih</td>
<?	
	$sql = "select namaklien1,namaklien2,noklien from $DBUser.tabel_100_klien where noklien=$nopenagih ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
    <td class="ade1"><? echo $ara["NOKLIEN"]; ?></td>
    <td class="ade1"><? echo $ara["NAMAKLIEN1"]; ?></td>
    <td class="ade1"><? echo $ara["NAMAKLIEN2"]; ?></td>
  </tr>
  <tr>
<?		
	$sql = "select namaklien1,namaklien2,noklien from $DBUser.tabel_100_klien where noklien=$noagen ";
	$DA->parse($sql);
	$DA->execute();
	$ara=$DA->nextrow();
	$DA->destruct();
?>
	  <td class="ade">Agen</td>
    <td class="ade1"><? echo $ara["NOKLIEN"]; ?></td>
    <td class="ade1"><? echo $ara["NAMAKLIEN1"]; ?></td>
    <td class="ade1"><? echo $ara["NAMAKLIEN2"]; ?></td>
  </tr>
  <tr>
<? 
		  $sql = "select kdstatusfile,namastatusfile from $DBUser.tabel_299_status_file";	
			$DB->parse($sql);	
			$DB->execute();	  
		  $ara=$DB->nextrow();	
		  $DB->destruct();
?>	

    <td width="112" class="ade">Status</td>
    <td width="105" class="ade1"><? echo $ara["NAMASTATUSFILE"]; ?></td>
    <td width="116" class="ade"></td>
    <td width="194" class="ade"></td>
  </tr>
</table>
</div>
<!----------------  end bagian info polis ----------------->							
						</td>
        </tr>
      </table>
    </td>
  </tr>
 <tr>
    <td width="100%">
    </td>
  </tr>
</table>
    <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
		<input type="submit" value="KIRIM EMAIL" name="send">
</div>
</form>
<hr size="1">
<? } ?>
<!--------------------------------------- end content --------------------------------->

