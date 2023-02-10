<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 
 $prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;
	
 $DB=new database($userid, $passwd, $DBName);

 
if ($submit) {
 $sql = "update $DBUser.tabel_200_pertanggungan set kdstatusfile='X', ".
 			  "userupdated=user,tglupdated=sysdate ".
 			  "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noper' ".
				"and kdstatusfile='1' and kdpertanggungan='1'";
// echo $sql;
 $DB->parse($sql);
 $DB->execute();
 				 
}
 
function Pilih()
{
?>
<title>Informasi Proposal</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F3000</font></td></tr>
</table>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<? 
}

function Show($nopertanggungan,$prefixpertanggungan)
{
//echo "<p align=\"center\">";
}
?>

<script language="javascript">
function Tampil(theForm)
{
  theForm.tJenis.value="I";
}
</script>
<form name="peliharaprop" action="peliharaprop" method="post">
<input type="hidden" name="tJenis">
<input type="hidden" name="noper" value="<?echo $nopertanggungan;?>">
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


<!------------ mulai query fungsi show -------------- -->
<? 

 $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);

echo "<p align=\"center\">";
echo "<font face=\"verdana\" size=\"3\"><b>NO. PROPOSAL : ".$prefixpertanggungan." - ".$nopertanggungan."</b></font>";
?>
<div align="center">
<table border="0" cellpadding="2" cellspacing="1" width="700" class="tblborder">
  <tr>
    <td width="100%" class="tblisi">
 
<table border="0" cellpadding="0" cellspacing="1" width="100%" class="arial10">
  <tr>
    <td class="tblhead" colspan="6" align="center">PROPOSAL</td>
  </tr>
  <tr>
    <td class="verdana8blk">Direkam</td>
    <td class="verdana8blk">:  <? echo $PER->rekam; ?></td>
    <td class="verdana8blk">Update Terakhir</td>
		<td class="verdana8blk">:  <? echo $PER->update; ?></td>
  </tr>	
	 <tr>
    <td class="verdana8blk">Nomor SPAJ</td>
    <td class="verdana8blk">:  <? echo $PER->nosp; ?></td>
    <td class="verdana8blk">Tanggal SPAJ</td>
    <td class="verdana8blk">:  <? echo $PER->tglsp; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Nomor BP3</td>
    <td class="verdana8blk">:  <? echo $PER->nobp3; ?></td>
    <td class="verdana8blk">Tanggal BP3</td>
    <td class="verdana8blk">:  <? echo $PER->tglbp3; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Status</td>
    <td class="verdana8blk"><b>:  <? echo $PER->statusfile; ?></td>
    <td class="verdana8blk"></td>
    <td class="verdana8blk"></td>
  </tr>
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Klien nomor</td>
    <td class="verdana8blk">:  <? echo $PER->notertanggung; ?></td>
		<td class="verdana8blk">Nama</td>
    <td class="verdana8blk">:  <? echo $PER->namatertanggung; ?></td>
  </tr>
	  <? 
	$sql="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,f.namaagama,".
			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode(a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin,a.kdid||'-'||a.noid identitas, ".
			 "a.tinggibadan,a.beratbadan,alamattetap01,alamattetap02,d.namakotamadya,e.namapropinsi ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e,$DBUser.tabel_102_agama f ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) and a.kdagama=f.kdagama(+)".
			 "and a.kdpropinsitetap=e.kdpropinsi(+) and a.kdkotamadyatetap=d.kdkotamadya(+) and a.noklien='$PER->notertanggung' ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arv=$DB->nextrow();
	?>
  <tr>
    <td class="verdana8blk">Tgl Lahir</td>
    <td class="verdana8blk">:  <? echo $arv["TGLLAHIR"]; ?></td>
    <td class="verdana8blk">Jenis Kelamin</td>
    <td class="verdana8blk">:  <? echo $arv["JENISKELAMIN"]; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Pekerjaan</td>
    <td class="verdana8blk">:  <? echo $arv["NAMAPEKERJAAN"]; ?></td>
    <td class="verdana8blk">Hobby</td>
    <td class="verdana8blk">: <? echo $arv["NAMAHOBBY"]; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Alamat</td>
    <td class="verdana8blk" colspan="3">:  <? echo $arv["ALAMATTETAP01"]." ".$arv["ALAMATTETAP02"]." ".$arv["NAMAKOTAMADYA"]." ".$arv["NAMAPROPINSI"]; ?></td>
  </tr>	
  <tr>
    <td class="verdana8blk">Tinggi Badan</td>
    <td class="verdana8blk">:  <? echo $arv["TINGGIBADAN"]." cm"; ?></td>
    <td class="verdana8blk">Berat Badan</td>
    <td class="verdana8blk">: <? echo $arv["BERATBADAN"]." kg"; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Identitas</td>
    <td class="verdana8blk">:  <? echo $arv["IDENTITAS"]; ?></td>
    <td class="verdana8blk">Agama</td>
    <td class="verdana8blk">: <? echo $arv["NAMAAGAMA"]; ?></td>
  </tr>	
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Kode produk</td>
    <td class="verdana8blk">:  <? echo $PER->produk; ?></td>
    <td class="verdana8blk">Nama Produk</td>
	  <td class="verdana8blk">:  <? echo $PER->namaproduk; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Medical</td>
    <td class="verdana8blk">:  <? echo $PER->statusmedical; ?></td>
    <td class="verdana8blk">Tgl Mulai</td>
    <td class="verdana8blk">:  <? echo $PER->mulas; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Usia Masuk</td>
    <td class="verdana8blk">:  <? echo $PER->usia; ?> tahun, <? echo $PER->usia_bl; ?> bulan</td>
    <td class="verdana8blk">Lama Asuransi</td>
    <td class="verdana8blk">:  <? echo $PER->lamaasuransi; ?> th, <? echo $PER->lamaasuransi_bl; ?> bl</td>
  </tr>
  <tr>
    <td class="verdana8blk">Tgl Ekspirasi</td>
    <td class="verdana8blk">:  <? echo $PER->expirasi; ?></td>
    <td class="verdana8blk">Lama Pemb. Premi</td>
    <td class="verdana8blk">:  <? echo $PER->lamapremi; ?> th, <? echo $PER->lamapremi_bl;?> bl</td>
  </tr>
  <tr>
    <td class="verdana8blk"></td>
    <td class="verdana8blk"></td>
    <td class="verdana8blk">Akhir Pemb. Premi</td>
    <td class="verdana8blk">:  <? echo $PER->akhirpremi; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">V a l u t a</td>
    <td class="verdana8blk">:  <? echo $PER->namavaluta; ?></td>
    <td class="verdana8blk">Cara Bayar</td>
    <td class="verdana8blk">:  <? echo $PER->namacarabayar; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Index Awal</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->indexawal,2); ?></td>
    <td class="verdana8blk">Premi 5 Tahun I</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premi1,2); ?></td>
  </tr>

	<tr>
    <td class="verdana8blk">J U A</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->jua,2); ?></td>
    <td class="verdana8blk">Premi Stlh 5 Thn</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premi2,2); ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Gadai Otomatis</td>
    <td class="verdana8blk">:  <? $gpo = ($PER->gpo=='1') ? 'SETUJU' : 'TIDAK SETUJU';echo $gpo; ?></td>
    <td class="verdana8blk">Premi Standar</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premistandar,2); ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Email</td>
    <td class="verdana8blk">:  <? echo ($PER->kdstatusemail=='1') ? 'OK, tgl:'.$PER->tglsendemail : ''; ?></td>
    <td class="verdana8blk"></td>
    <td class="verdana8blk"></td>
  </tr>	
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr> 
  <tr>
    <td class="verdana8blk">Pemegang Polis</td>
    <td class="verdana8blk">:  <? echo $PER->namapemegangpolis; ?></td>
    <td class="verdana8blk">Penagih</td>
		<td class="verdana8blk">:  <? echo $PER->namapenagih; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Pembayar Premi</td>
    <td class="verdana8blk">:  <? echo $PER->namapembayarpremi; ?></td>
    <td class="verdana8blk">Agen</td>
		<td class="verdana8blk">:  <? echo $PER->namaagen; ?></td>
  </tr>

	<tr>
    <td class="verdana8blk">Ahli Waris / Beneficiary</td>
    <td colspan="3" class="verdana8blk">:</td>
  </tr> 	
	<tr>
    <td colspan="4">
		 <table align="center" width="95%" cellpadding="0" cellspacing="1" border="0" class="tblhead1">
		  <tr>
			<td>		
		 <table align="center" width="100%" cellpadding="0" cellspacing="1" border="0" class="tblisi">
		  <tr class="hijao">
			 <td align="center">No</td>
			 <td align="left">Nomor Klien</td>
			 <td align="left">Nama Klien</td>
			 <td align="left">Hubungan</td>
		  </tr>
	<? 
	$sql = "select a.notertanggung,a.nourut,a.kdinsurable,a.noklien,c.namahubungan ".
			   "from $DBUser.tabel_219_pemegang_polis_baw a, ".
				 "$DBUser.tabel_218_kode_hubungan c ".
				 "where a.kdinsurable=c.kdhubungan and a.prefixpertanggungan='$prefixpertanggungan' ".
				 "and a.nopertanggungan='$nopertanggungan' ".
				 "and a.notertanggung='".$PER->notertanggung."' ".
				 "order by a.nourut ";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		$i=1;
		while ($arr=$DB->nextrow()) {
  	  include "../../includes/belang.php";
			$KL=New Klien($userid,$passwd,$arr["NOKLIEN"]);
			if ($arr["KDINSURABLE"]=='04') {
			 $hub=($arr["NOKLIEN"]==$PER->notertanggung) ? "DIRI TERTANGGUNG" : "BELUM DIDEFINISIKAN";
			} else {
			 $hub = $arr["NAMAHUBUNGAN"];
			}
		   print( "<td class=\"verdana8blu\" align=\"center\">".$arr["NOURUT"]."</td>" );
  		 print( "<td class=\"verdana8blu\" align=\"center\">".$arr["NOKLIEN"]."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$KL->nama."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$hub."</td>" );
		   print( "</tr>" );
			
		  $i++;
		}		 
	?>	 </td>
			</tr>
		 </table>

	    	
		 </table>
     </td>
	<tr>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
	<tr>
    <td colspan="4" align="center">
		<? printf("<input type=\"button\" name=\"benefit\" value=\"Benefit\" onclick=\"NewWindow('showbenefit1.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popupbenefit',760,400,1);\">",$prefixpertanggungan,$nopertanggungan,$PER->produk); 
		   $nottemp=true;
			 printf("<input type=\"button\" name=\"tariftebus\" value=\"Nilai Tebus\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s&nottemp=%s','popuptebus',400,500,1);\">",$PER->jua,$prefixpertanggungan,$nopertanggungan,$nottemp); 
		   printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"Komisi\" onclick=\"NewWindow('popupkom.php?prefixpertanggungan=%s&noproposal=%s&nopertanggungan=%s&noagen=%s','popupkomisi',500,300,1);\">",$prefixpertanggungan,$nopertanggungan,$nopertanggungan,$PER->noagen); 
			 printf("<input type=\"button\" name=\"print\" value=\"Cetak\" onclick=\"NewWindow('printprop.php?mode=edit&prefixpertanggungan=%s&noproposal=%s','',800,600,1);\">",$prefixpertanggungan,$nopertanggungan); 
		  if ($drop) { 		
			 print("<input type=\"hidden\" name=\"nopertanggungan\" value=\"".$nopertanggungan."\">");
		   print("<input type=\"submit\" name=\"submit\" value=\"Drop\" onclick=\"return confirm('Apakah Anda Yakin?')\">"); 
		  }
		?>
		</td>
  </tr>
</table>
</form>
   </td>
  </tr>
</table> 
<br>

<?
	//--------------------------------- start email tujuan kantor pusat	------------------	
		
			$sql    = "select count(nopertanggungan) pembayaran from ".
								"$DBUser.tabel_300_historis_premi ".
								"where prefixpertanggungan='$prefixpertanggungan' and ".
								"nopertanggungan='$nopertanggungan' and kdkuitansi='BP3'";
			//echo $sql;
			$DB->parse($sql);
	    $DB->execute();
	    $sst=$DB->nextrow();
	    $bayar = ($sst["PEMBAYARAN"]==0||is_null($sst["PEMBAYARAN"])) ? '' : 'BP3';  
			
			$cekru = "select status,tambahanusia from ".
							 "$DBUser.tabel_215_rate_up where nopertanggungan='$nopertanggungan'";
			$DB->parse($cekru);
	    $DB->execute();
	    $ru=$DB->nextrow();
	    $rateup = $ru["STATUS"];
			//echo "Rate Up : ".$rateup;
			
			$cekprestd = "select kdbenefit,premi ".
								 	 		"from $DBUser.tabel_223_transaksi_produk ". 
									 "where ".
									    "kdbenefit='RATEUP' and ".
											//"(premi is null or premi='0') and ".
											"prefixpertanggungan='$prefixpertanggungan' and ".
											"nopertanggungan='$nopertanggungan'"; 
			//echo $cekprestd;
			$DB->parse($cekprestd);
	    $DB->execute();
	    $std=$DB->nextrow();
	    $prestd = $std["KDBENEFIT"];
			$premistd = $std["PREMI"];
			
			if(!$prestd){
					$rt="0";
	    } elseif($premistd=="0"){
					$rt="0";		
	    } elseif($premistd==""){
					$rt="0";		
			}else{
					$rt="1";
	    }
			//echo "<br><br>Premi standar : ".$prestd." premi : ".$premistd;
			
	 $statusmed = $PER->medstat;                                             
	 if ($statusmed == "M") { 
	   echo "<form name=\"xxx\">";		
		 printf("<input type=\"button\" name=\"sendemail\" value=\"Sendmail Setuju Medical\" onclick=\"javascript:NewWindow('konfirmpremi.php?nopertanggungan=%s&kdstatusmedical=%s&prefixpertanggungan=%s&namatertanggung=%s','popupkomisi',400,300,1);\">",$nopertanggungan,$kdstatusmedical,$prefixpertanggungan,$PER->namatertanggung); 
		 echo "<input type=\"hidden\" name=\"rateup\" value=\"$rateup\">";
		 echo "<input type=\"hidden\" name=\"prestd\" value=\"$rt\">";
		  printf("<input type=\"button\" name=\"sendbp3\" value=\"Sendmail Lunas BP3\" onclick=\"javascript:NewWindow('emailbayarbp3.php?nopertanggungan=%s&kdstatusmedical=%s','popupkomisi',400,300,1);\">",$nopertanggungan,$kdstatusmedical); 
	   echo "<input type=\"hidden\" name=\"bp3\" value=\"$bayar\">";
		 echo "</form>";
    
	if($rt=="1"){
	   echo "<font face=verdana size=2>Proposal Medical Sub Standard</font>";
	}else{
	   echo "<font face=verdana size=2>Proposal Medical Standard</font>";
	}
?>
</div>
<script language="javascript">
 function checkifempty(){
  if (document.xxx.bp3.value=='')
   document.xxx.sendbp3.disabled=true
  else 
   document.xxx.sendbp3.disabled=false
  }

 if (document.all)
 setInterval("checkifempty()",100)
 /*
 function checkrateup(){
  if (document.xxx.rateup.value=='')
   document.xxx.sendemail.disabled=false
  else
   document.xxx.sendemail.disabled=true
  }

 if (document.all)
  setInterval("checkrateup()",100)
 */
 function checkprestd(){
  if (document.xxx.prestd.value=='1')
   document.xxx.sendemail.disabled=false
  else
   document.xxx.sendemail.disabled=true
  }

 if (document.all)
  setInterval("checkprestd()",100)
 
</script>

<?}
include "footer.php";
  //else if (document.xxx.prestd.value=='')
  ///document.xxx.sendemail.disabled=false
?>
