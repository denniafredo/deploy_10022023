<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggunganjht.php";
 /*$DB=New database($userid, $passwd, $DBName);
  $DB1=New database($userid, $passwd, $DBName);
  $DB2=New database($userid, $passwd, $DBName);*/
  $DB=New Database("PLADM","PLADM","PLTEST");
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
		<input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
		<input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>">
		<a onClick="NewWindow('pilihpolis.php','name',800,300,1)"><img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a>
		</td>
    <td align="left"></td>
  </tr>
	<tr>
    <td class="verdana10blk" width="30%">Atau Nomor Polis Lama:
		<input type="text" name="nopol" class="c" size="11" maxlength="11" value="<?echo strtoupper($nopol);?>" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();">
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
  //echo $sql."<br>";
		 $DB->parse($sql);
	   $DB->execute();

//echo $mbah."|".$prefixpertanggungan.$nopertanggungan;
     //if (!$arx=$DB->nextrow() || $mbah) {
     if (!$arx=$DB->nextrow()) {
       $sql = "select a.kdpertanggungan from $DBUser.tabel_200_pertanggungan a ".
	            "where $nomor";
							
			 //echo $sql;				
       $DB->parse($sql);
	   	 $DB->execute();
	   	 $arx=$DB->nextrow();
			 
			 
			 			 
     	 if ($arx["KDPERTANGGUNGAN"]=='1') {
		     echo "<font face=Verdana color=red>Pertanggungan Masih Berupa Proposal ";
		 	 } elseif ($arx["KDPERTANGGUNGAN"]=='2') {
         $sql = "select b.kdrayonpenagih,a.userrekam from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b ".
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
		 $KLN=New Klien($userid,$passwd,$PER->notertanggung);
			//echo "INI YANG LAGI GW CARI ".$PER->namaproduk; 
		 		 
?>
<hr size=1>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" class="tblborder">
<tr>
<td> 

<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="tblhead">
    <td colspan="3" align="center" class="arial12whtb">
      <b>POLIS NO : <? echo $PER->no_polis." / ".$PER->no_polis_lama; ?></b>
    </td>
		<td class="arial12whtb">RAYON :  <? echo $PER->kd_kantor ?></td>
		
    
  </tr>
  
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">No Proposal</td>
    <td class="verdana8blk">:  <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->notertanggung; ?>','updclnt',800,200,1);"><? echo $PER->notertanggung; ?></a></td>
		<td class="verdana8blk">No Customer</td>
    <td class="verdana8blk">:  <? echo $PER->namatertanggung; ?></td>
  </tr>
	  <? 
	$qry="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,".
			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode (a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin, ".
			 "a.tinggibadan,a.beratbadan, decode (a.meritalstatus,'D','DUDA','J','JANDA','K','KAWIN','L','LAJANG') meritalstatus,".
			 "a.alamattagih01,a.alamattagih02,a.phonetagih01,a.phonetagih02,a.phonetetap01,a.phonetetap02,".
			 "a.alamattetap01,a.alamattetap02,d.namakotamadya,e.namapropinsi ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) ".
			 "and a.kdpropinsitagih=e.kdpropinsi(+) and a.kdkotamadyatagih=d.kdkotamadya(+) and a.noklien='$PER->notertanggung' ";
//echo $qry;
	$DB->parse($qry);
	$DB->execute();
	$arv=$DB->nextrow();
	?>
  <tr>
    <td class="verdana8blk">Tgl Mulai</td>
    <td class="verdana8blk">:  <? echo $arv["TGLLAHIR"]; ?></td>
    <td class="verdana8blk">Status Polis</td>
    <td class="verdana8blk">:  <? echo $arv["JENISKELAMIN"]; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Tertanggung</td>
    <td class="verdana8blk">:  <? echo $arv["NAMAPEKERJAAN"]; ?></td>
    <td class="verdana8blk">Pemegang Polis</td>
    <td class="verdana8blk">: <? echo $arv["NAMAHOBBY"]; ?></td>
  </tr>
	
	 <tr>
    <td class="verdana8blk">Pembayar Premi</td>
    <td class="verdana8blk">:  <? echo $KLN->tinggi; ?></td>
    <td class="verdana8blk">Sampai Usia</td>
    <td class="verdana8blk">:  <? echo $KLN->berat; ?> Tahun</td>
  </tr>
	 <tr>
    <td class="verdana8blk">No Agen</td>
    <td class="verdana8blk">:  <? echo $KLN->tinggi; ?></td>
    <td class="verdana8blk">Tgl Mulai</td>
    <td class="verdana8blk">:  <? echo $KLN->berat; ?></td>
  </tr>
   
	<tr>
    <td class="verdana8blk">Alamat Tetap</td>
    <td class="verdana8blk" colspan="3">:  <? echo $KLN->alamat; ?></td>
  </tr>	
  <tr>
    <td class="verdana8blk">Alamat Tagih</td>
    <td class="verdana8blk" colspan="3">:  <? echo $arv["ALAMATTAGIH01"]." ".$arv["ALAMATTAGIH02"]." ".$arv["NAMAKOTAMADYA"]." ".$arv["NAMAPROPINSI"]; ?></td>
  </tr>	
  <tr>
    <td class="verdana8blk">Phone Tagih</td>
    <td class="verdana8blk" colspan="3">:  <? echo $arv["PHONETAGIH01"]; ?><? echo $arv["PHONETAGIH02"]=='' ? "" : ", ".$arv["PHONETAGIH02"] ; ?>  
		Phone Tetap : <? echo $arv["PHONETETAP01"]; ?><? echo $arv["PHONETETAP02"]=='' ? "" : ", ".$arv["PHONETETAP02"] ; ?> </td>
  </tr>	
  <tr>
    <td class="verdana8blk">Nama Produk</td>
    <td class="verdana8blk">: Jaminan Hari Tua</td>    
  </tr>
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  
  <tr>
    <td class="verdana8blk">Faktor Perhitungan Pensiun</td>       
  </tr> 
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Faktor Dasar Pensiun</td>
    <td class="verdana8blk"></td>       
  </tr> 
  <tr>
    <td class="verdana8blk">Prosen BSX/tahun</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Prosen Pensiun Janda</td>
    <td class="verdana8blk"></td>    
  </tr> 
    <tr>
    <td class="verdana8blk">Prosen BSI/tahun</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Prosen Pensiun Yatim-Piatu</td>
    <td class="verdana8blk"></td>    
  </tr> 
    <tr>
    <td class="verdana8blk">Prosen CS/tahun</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Prosen Pensiun Yatim/Piatu</td>
    <td class="verdana8blk"></td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Prosentase Max</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Metode Perhitungan Eskalasi</td>
    <td class="verdana8blk"></td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Prosentase Min</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Prosen Eskalasi</td>
    <td class="verdana8blk"></td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Jml Anak Maksimum</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Usia Anak Maksimum</td>
    <td class="verdana8blk"></td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Masa Cacat Min.</td>
    <td class="verdana8blk"> Tahun</td>   
    <td class="verdana8blk">Masa Dipercepat Min.</td>
    <td class="verdana8blk"> Tahun</td>    
  </tr> 
  
  <tr>
    <td class="verdana8blk">Metode Perhitungan Tebus</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Cash Refund Anuity Orang Terakhir</td>
    <td class="verdana8blk"></td>    
  </tr>
  
  <tr>
    <td class="verdana8blk">Prosentase Kenaikan Gaji Asumsi</td>
    <td class="verdana8blk"></td>      
  </tr>
  <tr>
    <td class="verdana8blk">Faktor Benefit THT</td>
    <td class="verdana8blk"> x Gaji</td>   
    <td class="verdana8blk">Faktor Benefit EBK</td>
    <td class="verdana8blk"> x Gaji</td>    
  </tr>
  <tr>
    <td class="verdana8blk">JUA Benefit DWL</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">JUA Jaminan Lengkap</td>
    <td class="verdana8blk"></td>    
  </tr>
  <tr>
    <td class="verdana8blk">Pros Gaji Iuran Pasti</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Manfaat Target</td>
    <td class="verdana8blk"></td>    
  </tr>
  <tr>
    <td class="verdana8blk">Restitusi Premi Skg</td>
    <td class="verdana8blk"></td>          
  </tr>
  <tr>
    <td class="verdana8blk">Restitusi Premi Bertahap</td>
  <tr>
    <td class="verdana8blk">Tahap 1</td>   
    <td class="verdana8blk"></td>
    <td class="verdana8blk">Tahap 2</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Tahap 3</td>
    <td class="verdana8blk"></td>      
  </tr>
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  
  <tr>
    <td class="verdana8blk">Sharing Pembayaran</td>       
  </tr> 
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Masa Kerja BS</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Kontribusi Perusahaan</td>
    <td class="verdana8blk"></td>  
    <td class="verdana8blk">Kontribusi Pegawai</td>
    <td class="verdana8blk"></td>   
  </tr>
  <tr>
    <td class="verdana8blk">Masa Kerja CS</td>
    <td class="verdana8blk"></td>   
    <td class="verdana8blk">Kontribusi Perusahaan</td>
    <td class="verdana8blk"></td>  
    <td class="verdana8blk">Kontribusi Pegawai</td>
    <td class="verdana8blk"></td>   
  </tr>
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  
  <tr>
    <td class="verdana8blk">Faktor Pendanaan Saving Plan</td>       
  </tr> 
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Biaya Investasi</td>
    <td class="verdana8blk"> %</td>   
    <td class="verdana8blk">Biaya Dana Awal</td>
    <td class="verdana8blk"> %</td>    
  </tr>
  <tr>
    <td class="verdana8blk">Biaya Biaya Adm Tahun-1</td>
    <td class="verdana8blk"> %</td>   
    <td class="verdana8blk">Biaya Biaya Adm Lanjutan</td>
    <td class="verdana8blk"> %</td>    
  </tr>
  <tr>
    <td class="verdana8blk">Biaya Lain-lain</td>
    <td class="verdana8blk"> %</td>        
  </tr>
  <tr>
    <td class="verdana8blk">Tarif Asuransi Kematian</td>
    <td class="verdana8blk"> permil</td>   
    <td class="verdana8blk">Tarif Cacat Tetap Total</td>
    <td class="verdana8blk"> permil</td>    
  </tr>
  
	<tr>
    <td colspan="4" align="center">
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"CETAKAN POLIS\" onclick=\"NewWindow('../pelaporan/show_polis.php?prefix=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT\" onclick=\"NewWindow('showbenefit1.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
  	<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST PREMI\" onclick=\"NewWindow('../akunting/kartupremi1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
     <? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST RIDER\" onclick=\"NewWindow('../akunting/karturider1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST GADAI\" onclick=\"NewWindow('../akunting/kartugadai1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST MUTASI\" onclick=\"NewWindow('../polis/mutasi.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"STATUS MUTASI\" onclick=\"NewWindow('../polis/statusmutasipertanggungan.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
		<? $nottemp=true; ?>
		<? if($modul!="CCT"){ printf("<input type=\"button\" name=\"tariftebus\" value=\"NILAI TEBUS\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s&nottemp=%s','name','500','500','yes');return false\" style=\"font-size: 8pt\">",$PER->jua,$prefixpertanggungan,$nopertanggungan,$nottemp); } ?>		
		<? if($modul!="CCT"){ printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"KOMISI\" onclick=\"NewWindow('popupkom.php?prefixpertanggungan=%s&noproposal=%s&nopertanggungan=%s&noagen=%s','popupkomisi','500','350','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$nopertanggungan,$PER->namaagen); } ?>	

		<?
// Tambahan oleh Ari per 04/12/2007 untuk Produk JS-LiNk (JL0/JL1) / Astha Plus (ATP) / Dwiguna Idaman (DGI) 
			 if (substr($PER->produk,0,3)=='JL0'||substr($PER->produk,0,3)=='JL1'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANSAKSI JS-LINK\" onclick=\"NewWindow('../polis/mutasi_jslink.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } else if (substr($PER->produk,0,3)=='JL2'||substr($PER->produk,0,3)=='JL3'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANS. NEW JS-LINK\" onclick=\"NewWindow('../polis/mutasi_jslink2.php?noper=%s&prefix=%s','popupmutasi','950','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } else if (substr($PER->produk,0,3)=='ATP'||substr($PER->produk,0,3)=='DGI'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANSAKSI DPLK\" onclick=\"NewWindow('../polis/mutasi_atp.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } 
		?>
		<? $polisbaru_smart="$prefixpertanggungan-$nopertanggungan"; printf("<input type=\"button\" name=\"docpolis\" value=\"DOKUMEN\" onclick=\"NewWindow('http://192.168.2.6/smart/list.php?no_polis1=".base64_encode(base64_encode($polisbaru_smart))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">"); ?>
		<? printf("<input type=\"button\" name=\"histduplikat\" value=\"HIST CETAK POLIS\" onclick=\"NewWindow('hist_duplikat.php?pref=%s&noper=%s','name','600','300','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<?
		if ($PER->produk=='JSSPB1' || $PER->produk=='JSSPAB1'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT BULANAN\" onclick=\"NewWindow('showbenefitbln.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); 
			 }
		
		if ($PER->produk=="JSPS"||$PER->produk=="SC5S"||$PER->produk=="SC6S"||$PER->produk=="ST5S"||$PER->produk=="ST6S"){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANS. SAVING\" onclick=\"NewWindow('showbenefitsaving.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); 
			 }
		
		if ($kantor=='KP'){
		?>
        <input type="button" class="buton" onClick="<?="window.open('../../network/entry_notifikasi.php', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,fullscreen=yes');"?>;" value="PESAN" >
		<?
        } else {};
		?>
    
    
    </fieldset>
		</td>
  </tr>
</table>
   </td>
  </tr>
</table> 
<?
//echo "jnsuser = ".$jnsusr;

if($PER->jenis=="Polis"){
?>
 <br>
	<fieldset style="color: #4b889e; border:1 solid #9cc6dc; padding:5; font: 1.1em Verdana, sans-serif; width:650;"> 
  <legend class="verdana9blu"><b>Cetak</b></legend>
  	<!--<input type="button" class="buton" name="cetakbk" value="BERITA KEPUTUSAN" onclick="NewWindow('../polis/cetakanbk.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">-->
  	<input type="button" class="buton" name="cetakutk" value="UCAPAN TERIMA KASIH" onClick="NewWindow('../polis/ucapan_terimakasih.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
  	<!--<input type="button" class="buton" name="cetaktt" value="TANDA TERIMA" onclick="NewWindow('../polis/tanda_terima.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">-->
		<? 
		if (substr($PER->produk,0,3)=='JL2'||substr($PER->produk,0,3)=='JL3'){
			 		echo "<input type=\"button\"  class=\"buton\" name=\"tariftebus\" value=\"INFO CARA BAYAR\" onclick=\"NewWindow('../polis/info_virtual.php?noper=$nopertanggungan&prefix=$prefixpertanggungan','popupmutasi','950','350','yes');return false\" style=\"font-size: 8pt\">";
					};
					
		//===============KLAUSUL CASH PLAN
		$sqlcp = "select COUNT(*) ADA from $DBUser.tabel_223_transaksi_produk where  
                      substr(kdbenefit,1,3) in ('CPB','CPM','TER','CI','PA','CAC','WAI')
                      and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
					  //echo $sqlcp;
							$DB->parse($sqlcp);
      			  $DB->execute();
				  $arrcp=$DB->nextrow();
				  if ($arrcp["ADA"]>=1){
				  	
				  //printf("<input type=\"button\" name=\"tariftebus\" value=\"KLAUSA RIDER\" onclick=\"NewWindow('showbenefitcp.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 7pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk);
				  ?>
				  <input type="button" class="buton" name="cetakklausul"  value="KLAUSULA RIDER" onClick="NewWindow('./showbenefitcp.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',760,300,1)">
				  <?
				  }
		
		//================================
		if($PER->produk=="JSSP" || $PER->produk=="JSSK" || $PER->produk=="JSSPA" || $PER->produk=="JSSPB1" || $PER->produk=="JSSPAB1" || $PER->produk=="JSSPAN3" || $PER->produk=="JSSPAN6" || $PER->produk=="JSSPAN12" || $PER->produk=="JSSPAN24"){
		    
			if($PER->produk=="JSSPAN3" || $PER->produk=="JSSPAN24") {$ketkus='cetakketentuansp324.php';} else {$ketkus='cetakketentuansp.php';} 
			//echo $PER->produk.$ketkus;
		?>
		<input type="button" class="buton" name="cetakklausul"  value="KLAUSULA" onClick="NewWindow('../polis/cetakklausula.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
        <input type="button" class="buton" name="cetakklausulantar"  value="PENGANTAR KLAUSULA" onClick="NewWindow('../polis/cetakklausulapengantar.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
		<input type="button" class="buton" name="cetakketentuan" value="KETENTUAN KHUSUS" onClick="NewWindow('../polis/<?=$ketkus;?>?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
		<input type="button" class="buton" name="cetakkpenawaran"  value="PENAWARAN" onClick="NewWindow('../polis/cetakpenawaran.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',750,500,1)">
				<input type="button" class="buton" name="cetakrollover"  value="SETUJU ROLLOVER" onClick="NewWindow('../polis/cetaksetujurollover.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',750,500,1)">
  	<?
		}
		elseif ($PER->produk=="JSSP6" || $PER->produk=="JSSPA6"){
		?>
		<input type="button" class="buton" name="cetakklausul"  value="KLAUSULA" onClick="NewWindow('../polis/cetakklausula.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
		<input type="button" class="buton" name="cetakketentuan" value="KETENTUAN KHUSUS" onClick="NewWindow('../polis/cetakketentuansp6.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
		<input type="button" class="buton" name="cetakkpenawaran"  value="PENAWARAN" onClick="NewWindow('../polis/cetakpenawaran.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',750,500,1)">
				<input type="button" class="buton" name="cetakrollover"  value="SETUJU ROLLOVER" onClick="NewWindow('../polis/cetaksetujurollover.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',750,500,1)">
				<?
		}
		elseif($PER->produk=="DMP"){
		?>
<input type="button" class="buton" name="cetakklausul"  value="KLAUSULA" onClick="NewWindow('../polis/cetakklausula_dmp.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
		<?
		}
		elseif(substr($PER->produk,0,5)=="JSSHT" || (substr($PER->produk,0,2)=="AD")){
		?>
		
        <a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KLAUSUL_CACAD_TETAP.pdf'><font size="2" face="Verdana, Arial, Helvetica, sans-serif">CETAK KLAUSUL CACAD TETAP TOTAL</font></a>
		<?
		}
		?>
	</fieldset>
	<br><br>	
<? } else { ?>
<br>
	<fieldset style="color: #4b889e; border:1 solid #9cc6dc; padding:5; font: 1.1em Verdana, sans-serif; width:650;"> 
  <legend class="verdana9blu"><b>Cetak</b></legend>
  	<input type="button" class="buton" onClick="<?="window.open('skk_print.php?no_proposal=$nopertanggungan&ul=1', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,fullscreen=yes');"?>;" value="CETAK SKK" >
	</fieldset>
	<br><br>	
<? } ?>
</div>
<? 
} 

?>
<hr size="1">
<a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a>