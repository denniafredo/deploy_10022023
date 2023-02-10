<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 $DB=New database($userid, $passwd, $DBName);	
 	
?>
<html>
<head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>

<font face="Verdana" size="2"><b>Informasi Polis</b></font>
<hr size=1>
<table border="0" width="100%" cellspacing="3" cellpadding="1" class="tblisi">
<form name="porm" method="post" action="<?echo $PHP_SELF;?>">
<input type="hidden" name="mbah" value="<?echo $mbah;?>">
  <tr>
    <td class="verdana10blk" width="30%">Nomor Polis Baru	:
		<input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onfocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
		<input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onblur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>">
		<a onclick="NewWindow('pilihpolis.php','name',800,300,1)"><img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a>
		</td>
    <td align="left"></td>
  </tr>
	<tr>
    <td class="verdana10blk" width="30%">Atau Nomor Polis Lama:
		<input type="text" name="nopol" class="c" size="11" maxlength="11" value="<?echo strtoupper($nopol);?>" onfocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();">
		<td align="left"><? echo "<input type=\"submit\" value=\"Submit\" name=\"insert\">";?></td>
  </tr>
	</form>
</table>
<? 

$prefixpertanggungan=strtoupper($prefixpertanggungan);	 
$nomor = (strlen($prefixpertanggungan)==0 && strlen($nopertanggungan)==0 && strlen($nopol)<>0) ? "a.nopol='$nopol' " : "a.nopertanggungan='$nopertanggungan' and a.prefixpertanggungan='$prefixpertanggungan' ";
 
 if (!$mbah) {
     $sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,b.nopenagih ".
				     "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
			       "where b.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' ".
						 "and ".$nomor.
				     "and a.nopenagih=b.nopenagih";
	} else {
     $sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,a.nopenagih ".
				     "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
						 "where a.kdpertanggungan='2' ".
						 "and ".$nomor ."".
						 "and a.nopenagih=b.nopenagih";
	}				 
     //echo $sql;
		 $DB->parse($sql);
	   $DB->execute();

//echo $mbah."|".$prefixpertanggungan.$nopertanggungan;
     //if (!$arx=$DB->nextrow() || $mbah) {
     if (!$arx=$DB->nextrow()) {
       $sql = "select kdpertanggungan from $DBUser.tabel_200_pertanggungan a ".
	            "where $nomor";
			 //echo $sql;				
       $DB->parse($sql);
	   	 $DB->execute();
	   	 $arx=$DB->nextrow();
			 
     	 if ($arx["KDPERTANGGUNGAN"]=='1') {
		     echo "<font face=Verdana color=red>Pertanggungan Masih Berupa Proposal ";
		 	 } elseif ($arx["KDPERTANGGUNGAN"]=='2') {
         $sql = "select b.kdrayonpenagih from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
	              "where $nomor".
								"and a.nopenagih=b.nopenagih ";
         $DB->parse($sql);
	    	 $DB->execute();
	    	 $arx=$DB->nextrow();
      	 if ($arx["KDRAYONPENAGIH"] <> $kantor) {
		       echo "<font face=Verdana color=red>Polis Bukan Dari Rayon $kantor tetapi rayon ".$arx["KDRAYONPENAGIH"]."";
		     } else {
		       echo "<font face=Verdana color=green>Pertanggungan Tidak Ada ";
				 }
		   } else {
			   if ($nopertanggungan||$nopol) {
				   //echo $sql."<br>";
		       echo "<font face=Verdana color=red>Pertanggungan Tidak Ada ";
		     }
			 }
		 				 
		 } else {	
		 
		 $ry = $arx["KDRAYONPENAGIH"];
     $prefixpertanggungan=(strlen($prefixpertanggungan)==0 || $prefixpertanggungan=='') ? $arx["PREFIXPERTANGGUNGAN"] : strtoupper($prefixpertanggungan);	 
     $nopertanggungan=(strlen($nopertanggungan)==0 || $nopertanggungan=='') ? $arx["NOPERTANGGUNGAN"] : $nopertanggungan;	 
     $PER=New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);

?>
<hr size=1>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" class="tblborder">
<tr>
<td> 

<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="tblhead">
    <td colspan="3" align="center" class="arial12whtb">
      <b>POLIS NO : <? echo $PER->label." / ".$PER->nopol;; ?></b>
    </td>
		<td class="arial12whtb">RAYON :  <? echo $ry ?></td>
    
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
	$qry="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,".
			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode (a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin, ".
			 "a.tinggibadan,a.beratbadan,alamattetap01,alamattetap02,d.namakotamadya,e.namapropinsi ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) ".
			 "and a.kdpropinsitetap=e.kdpropinsi(+) and a.kdkotamadyatetap=d.kdkotamadya(+) and a.noklien='$PER->notertanggung' ";
	//echo $sql;
	$DB->parse($qry);
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
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Nama Produk</td>
    <td class="verdana8blk" colspan="3">:  <b><? echo $PER->produk."</b> ".$PER->namaproduk; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Status Medical</td>
    <td class="verdana8blk">:  <? echo $PER->statusmedical; ?></td>
    <td class="verdana8blk">Mulai Asuransi</td>
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
    <td class="verdana8blk">:  <? echo $PER->indexawal; ?></td>
    <td class="verdana8blk">Premi 5 th</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premi1,2); ?></td>
  </tr>

	<tr>
    <td class="verdana8blk">J U A</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->jua,2); ?></td>
    <td class="verdana8blk">Premi Stlh 5 Th</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premi2,2); ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Gadai Otomatis</td>
    <td class="verdana8blk">:  <? $gpo = ($PER->gpo=='0') ? 'SETUJU' : 'TIDAK SETUJU';echo $gpo; ?></td>
    <td class="verdana8blk">Premi Standar</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premistandar,2); ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Email</td>
    <td class="verdana8blk">:  <? echo ($PER->kdstatusemail=='1') ? 'OK, tgl:'.$PER->tglsendemail : ''; ?></td>
    <td class="verdana8blk">Resiko</td>
    <td class="verdana8blk">:  <?echo number_format($PER->premi2,2); ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Konversi</td>
    <td class="verdana8blk">:  <? echo $PER->tglkonversi; ?></td>
    <td class="verdana8blk">Polis Dicetak</td>
    <td class="verdana8blk">:  <? echo $PER->tglkonversi; ?></td>
  </tr>		
  <tr>
    <td class="verdana8blk">Bayar Terakhir</td>
    <td class="verdana8blk">:  <? echo $PER->tgllastpayment; ?></td>
    <td class="verdana8blk">Booking Berikutnya</td>
    <td class="verdana8blk">:  <? echo $PER->tglnextbook; ?></td>
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
	?>	
			 </table>
     </td>    	
		 </table>
     </td>
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
	<tr>
    <td colspan="4" align="center">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"CETAKAN POLIS\" onclick=\"NewWindow('../pelaporan/show_polis.php?prefix=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT\" onclick=\"NewWindow('showbenefit1.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
  	<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS PREMI\" onclick=\"NewWindow('../akunting/kartupremi1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS GADAI\" onclick=\"NewWindow('../akunting/kartugadai1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"MUTASI\" onclick=\"NewWindow('../polis/mutasi.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
		<? $nottemp=true; ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"NILAI TEBUS\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s&nottemp=%s','name','400','400','yes');return false\" style=\"font-size: 8pt\">",$PER->jua,$prefixpertanggungan,$nopertanggungan,$nottemp); ?>
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"KOMISI\" onclick=\"NewWindow('popupkom.php?prefixpertanggungan=%s&noproposal=%s&nopertanggungan=%s&noagen=%s','popupkomisi','500','350','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$nopertanggungan,$PER->namaagen); ?>
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
<a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a>