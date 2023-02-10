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
<font face="Verdana" size="2"><b>Desisi Asuransi Jiwa Medical</b></font>
<hr size=1>
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
	  <td><font face="Verdana" size="2">Cari Nomor Proposal</font></td>
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
function Tampil(theForm) {theForm.tJenis.value="I"}
</script>
<form name="peliharapolis" action="desisimedical1.php" method=post>
<input type="hidden" name="tJenis" value>
<?
switch ($tJenis) {
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
		$namaproduk = $arr["NAMAPRODUK"];
		$lunasi = substr($arr["MULAS"],3,3);
	switch ($lunasi) {
	      case 'JAN' :
		    $bulanlunas = "Januari";
		    case 'FEB' :
		    $bulanlunas = "Pebruari";
			  case 'MAR' :
		    $bulanlunas = "Maret";
		    case 'APR' :
		    $bulanlunas = "April";
			  case 'MAY' :
		    $bulanlunas = "Mei";
				case 'JUN' :
		    $bulanlunas = "Juni";
				case 'JUL' :
		    $bulanlunas = "Juli";
			  case 'AUG' :
		    $bulanlunas = "Agustus";
			  case 'SEP' :
		    $bulanlunas = "September";
				case 'OCT' :
		    $bulanlunas = "Oktober";
				case 'NOV' :
		    $bulanlunas = "Nopember";
				case 'DEC' :
		    $bulanlunas = "Desember";
			  break;
	}
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
*/

echo "<p align=\"center\">";
echo "<font face=\"verdana\" size=\"3\"><b>NO. POLIS : ".$prefixpertanggungan." - ".$nopertanggungan."</b></font>";
?>
<div align="center">
<!------------------------------ mulai desisi ---------------------------------------->
<form name="sendmail" action="sendmaildesisi1.php" method=post>
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
                <td width="44%" colspan="2"><font face="Verdana" size="2" color="#606060">Untuk
                  Branch&nbsp; Office</font></td>
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
	$tertanggung = $ara["NAMAKLIEN1"];
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
                  <p align="right"><b><font face="Verdana" size="2" color="#606060">DITERIMA STANDARD PER</font></b></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="44%" colspan="2"><font face="Verdana" size="2" color="#606060">Dengan ketentuan</font></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">a)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Macam Polis</font></td>
								  <?	
	                  $sql = "select namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta' ";
	                  $DA->parse($sql);
	                  $DA->execute();
	                  $ara=$DA->nextrow();
										$macampolis = $ara["NAMAVALUTA"];
	                  $DA->destruct();
                  ?>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $macampolis; ?></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">b)</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Macam Asuransi</font></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $namaproduk; ?></font></td>
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
	$carabayar = $ara["NAMACARABAYAR"];
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
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $almtpemegangpls1." ".$almtpemegangpls2."-".$almtpemegangpkdpos;?><br>&nbsp;&nbsp;<? echo "Telp.".$almtpemegangplsphone;?>
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
                <td width="56%"><font face="Verdana" size="2" color="#606060">: <? echo $alamatpenagih1." ".$alamatpenagih2." ".$kdpospenagih; ?><br>&nbsp;&nbsp;Telp. <? echo $telppenagih; ?>
								</font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"></td>
                <td width="40%" valign="top" align="left"></td>
                <td width="56%"><font face="Verdana" size="2" color="#606060"></font></td>
              </tr>
              <tr>
                <td width="4%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">4.</font></td>
                <td width="40%" valign="top" align="left"><font face="Verdana" size="2" color="#606060">Besar bunga keterlambatan pembayaran premi (jika ada)</font></td>
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
                        premi tersebut di atas berlaku apabila dilunasi pada bulan <? echo $bulanlunas; ?></font></td>
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
                  <p><font face="Verdana" size="2" color="#606060"><br><? echo $pejabat;?><br>Kepala Divisi</font></td>
              </tr>
              <tr>
                <td width="4%"></td>
                <td width="40%"></td>
                <td width="56%"></td>
              </tr>
              <tr>
                <td width="100%" colspan="3"><font face="Verdana" size="2" color="#606060">Tembusan  :<br>
                  1. B.A.P. Head Office; Divisi Pertanggungan Perorangan<br>
                  2. B.A.P. <? echo $namakantor; ?> ; Bagian Pertanggungan<br>
                  3. Pemeriksa <? echo $namakantor; ?> ; untuk ditindak lanjuti<br>
                  4. Arsip </font></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>
<table border="0" width="100%">
  <tr>
    <td width="100%">
		<input type="hidden" name="kantor" value="<? echo $namakantor; ?>">
		<input type="hidden" name="nospaj" value="<? echo $nosp; ?>">
		<input type="hidden" name="tglspaj" value="<? echo $tglsp; ?>">
		<input type="hidden" name="pemegangpolis" value="<? echo $pemegangpolis; ?>">
		<input type="hidden" name="tertanggung" value="<? echo $tertanggung; ?>">
		<input type="hidden" name="macampolis" value="<? echo $macampolis; ?>">
		<input type="hidden" name="macamasuransi" value="<? echo $namaproduk; ?>">
		<input type="hidden" name="jua" value="<? echo number_format($juamainproduk,2); ?>">
		<input type="hidden" name="lamaasuransi_th" value="<? echo $lamaasuransi_th; ?>">
		<input type="hidden" name="lamaasuransi_bl" value="<? echo $lamaasuransi_bl; ?>">
		<input type="hidden" name="lamapembpremi_th" value="<? echo $lamapembpremi_th; ?>">
		<input type="hidden" name="lamapembpremi_bl" value="<? echo $lamapembpremi_bl; ?>">
		<input type="hidden" name="carabayar" value="<? echo $carabayar; ?>">
		<input type="hidden" name="premi1" value="<? echo number_format($premi1,2); ?>">
		<input type="hidden" name="premi2" value="<? echo number_format($premi2,2); ?>">
		<input type="hidden" name="indexdasar" value="<? echo $indexawal; ?>">
	  <input type="hidden" name="almtpemegangpls1" value="<? echo $almtpemegangpls1; ?>">
		<input type="hidden" name="almtpemegangpls2" value="<? echo $almtpemegangpls2; ?>">
		<input type="hidden" name="almtpemegangpkdpos" value="<? echo $almtpemegangpkdpos; ?>">
		<input type="hidden" name="almtpemegangplsphone" value="<? echo $almtpemegangplsphone; ?>">
		<input type="hidden" name="alamatpenagih1" value="<? echo $alamatpenagih1; ?>">
		<input type="hidden" name="alamatpenagih2" value="<? echo $alamatpenagih2; ?>">
		<input type="hidden" name="kdpospenagih" value="<? echo $kdpospenagih; ?>">
		<input type="hidden" name="telppenagih" value="<? echo $telppenagih; ?>">
		<input type="hidden" name="bungapremi" value="<? echo $bungapremi; ?>">
		<input type="hidden" name="bulanlunas" value="<? echo $bulanlunas; ?>">
		<input type="hidden" name="today" value="<? echo $today; ?>">
		<input type="hidden" name="pejabat" value="<? echo $pejabat; ?>">
    <p align="center"><input type="submit" value="Kirim" name="desisi1"></td>
  </tr>
</table>
</form>
<!------------------------------ akhir desisi ---------------------------------------->
<hr size="1">
<a href="../mnuutama.php"><font face="Verdana" size="2">Menu Utama</font></a>