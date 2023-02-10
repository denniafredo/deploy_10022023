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

<font face="Verdana" size="2"><b>Informasi Polis Program Manfaat Karyawan</b></font>
<hr size=1>
<table border="0" width="100%" cellspacing="3" cellpadding="1" class="tblisi">
<form name="porm" method="post" action="<?echo $PHP_SELF;?>">
<input type="hidden" name="mbah" value="<?echo $mbah;?>">
  <tr>
    <td class="verdana10blk" width="21%">Nomor Polis Baru	:
		<input type="text" name="no_polis" class="c" size="10" maxlength="10" onBlur="validasi10x(this.form.no_polis)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $no_polis;?>">
		<a href="#" onClick="NewWindow('pilihpolisjht.php','name',800,300,1)"><img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a>		
		</td>
    <td width="79%" align="left"><? echo "<input type=\"submit\" value=\"Submit\" name=\"cek_pol\">";?></td>
  </tr>
	<!--tr>
    <td class="verdana10blk" width="30%">Atau Nomor Polis Lama:
		<input type="text" name="nopol" class="c" size="11" maxlength="11" value="<?echo strtoupper($nopol);?>" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();">
		<td align="left"></td>
  </tr-->
	</form>
</table>
<? 

     if ($cek_pol) {
		 $sql="SELECT NO_POLIS,
					 NO_PROPOSAL,
					 (SELECT   NO_POLIS_LAMA
						FROM   polis
					   WHERE   no_polis = a.no_polis)
						NO_POLIS_LAMA,
					 TGL_MULAI,
					 KD_FREKUENSI_BAYAR,
					 KD_VALUTA,
					 PEMEGANG_POLIS,
					 TERTANGGUNG,
					 NO_AGEN,
					 NO_PENAGIH,
					 KD_KANTOR,
					 NO_CUSTOMER,
					 (SELECT ALAMAT1 FROM CUSTOMER WHERE NO_CUSTOMER = A.NO_CUSTOMER) ALAMAT,
					 (SELECT NO_TELP1 FROM CUSTOMER WHERE NO_CUSTOMER = A.NO_CUSTOMER) NO_TELP,
					 PEMBAYAR_PREMI,
					 METODE_BAYAR,
					 NVL(KONTRIB_PRS,0) KONTRIB_PRS,
					 NVL(KONTRIB_KLIEN,0) KONTRIB_KLIEN,         
					 PROSEN_BSX,
					 PROSEN_BSI,
					 PROSEN_CS,
					 PROSEN_MAX,
					 PROSEN_MIN,
					 PROS_PJD,
					 PROS_PYT,
					 FAKTOR_DP,
					 PROS_PYP,
					 METODE_BAYAR_BS,
					 NVL(KONTRIB_PRS_BS,0) KONTRIB_PRS_BS,
					 NVL(KONTRIB_KLIEN_BS,0) KONTRIB_KLIEN_BS,
					 KD_FREKUENSI_BAYAR_BS,
					 KD_FREKUENSI_BAYAR_BSX,
					 METODE_BAYAR_BSX,
					 KONTRIB_PRS_BSX,
					 KONTRIB_KLIEN_BSX,
					 NVL(PROS_ESK,0) PROS_ESK,
					 JUMLAH_ANAK,
					 USA_MAX,
					 CASE KD_HITUNG_TEBUS
					 WHEN '0' THEN
					 	'Standar'
					 ELSE
					 	'Prosentase'	
					 END KD_HITUNG_TEBUS,
					 FAKTOR_EBK,
					 DWL,
					 case nvl(KD_HITUNG_ESK,0)
					 when '1' then
					 	'Dengan Eskalasi'
					 else
					 	'Tanpa Eskalasi'
					 end KD_HITUNG_ESK,
					 CASE CRAUU
					 WHEN '1' THEN
					 	'Ya'
					 else
					 	'Tidak'	
					 END CRAUU,
					 MIN_DPC,
					 MIN_CACAT,
					 SU,
					 NVL(PROS_KENAIKAN_GAJI,0) PROS_KENAIKAN_GAJI,
					 NVL(FAKTOR_THT,0) FAKTOR_THT,
					 NVL(JUA_DWL,0) JUA_DWL,
					 NVL(JAMINAN_LENGKAP,0) JAMINAN_LENGKAP,
					 KET_ESKALASI,
					 NVL(RESTITUSI_PREMI,0) RESTITUSI_PREMI,
					 NVL(RESTITUSI_PREMI1,0) RESTITUSI_PREMI1,
					 NVL(RESTITUSI_PREMI2,0) RESTITUSI_PREMI2,
					 NVL(RESTITUSI_PREMI3,0) RESTITUSI_PREMI3,
					 NVL(BIAYA_INVESTASI,0) BIAYA_INVESTASI,
					 NVL(BIAYA_DANA_AWAL,0) BIAYA_DANA_AWAL,
					 NVL(BIAYA_LANJUTAN,0) BIAYA_LANJUTAN,
					 NVL(BIAYA_ASURANSI_KEMATIAN,0) BIAYA_ASURANSI_KEMATIAN,
					 NVL(BIAYA_CACAT_TETAP_TOTAL,0) BIAYA_CACAT_TETAP_TOTAL,
					 NVL(BIAYA_LAIN_LAIN,0) BIAYA_LAIN_LAIN,
					 ALTERNATIF_PEMBAYARAN,
					 TGL_ESKALASI,
					 MASA_VAL,
					 NVL(PROS_IURAN,0) PROS_IURAN,
					 CASE IS_MANFAAT_TARGET 
					 WHEN '1' THEN
					 	'Ya'
					 Else
					 	'Tidak'
					 END IS_MANFAAT_TARGET,
					 NVL(BIAYA_ADM_THN1,0) BIAYA_ADM_THN1,
					 METODE_HIT_PASIF
			  FROM   pladm.proposal a
			 WHERE   no_polis = '$no_polis'";	
		//echo $sql;	
		$DB->parse($sql);
		$DB->execute();
		$arr=$DB->nextrow();		 			 			      	 	 				 		 	
?>
<hr size=1>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" class="tblborder">
<tr>
<td> 

<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="tblhead">
    <td colspan="3" align="center" class="arial12whtb">
      <b>POLIS NO : <? $nopollama = $arr['NO_POLIS_LAMA']; echo $arr['NO_POLIS']." / ".$nopollama; ?></b>
    </td>
		<td class="arial12whtb">RAYON :  <? echo $arr['KD_KANTOR']; ?></td>
		
    
  </tr>
  
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">No Proposal</td>
    <td class="verdana8blk">:  <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->notertanggung; ?>','updclnt',800,200,1);"><? echo $arr['NO_PROPOSAL']; ?></a></td>
		<td class="verdana8blk">No Customer</td>
    <td class="verdana8blk">:  <? echo $arr['NO_CUSTOMER']; ?></td>
  </tr>	 
  <tr>
    <td class="verdana8blk">Tgl Mulai</td>
    <td class="verdana8blk">:  <? echo $arr['TGL_MULAI']; ?></td>
    <td class="verdana8blk">Status Polis</td>
    <td class="verdana8blk">:  <?  ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Tertanggung</td>
    <td class="verdana8blk">:  <? echo $arr['TERTANGGUNG']; ?></td>
    <td class="verdana8blk">Pemegang Polis</td>
    <td class="verdana8blk">: <? $pempol = $arr['PEMEGANG_POLIS']; echo pempol; ?></td>
  </tr>
	
	 <tr>
    <td class="verdana8blk">Pembayar Premi</td>
    <td class="verdana8blk">:  <? echo $arr['PEMBAYAR_PREMI']; ?></td>
    <td class="verdana8blk">Sampai Usia</td>
    <td class="verdana8blk">:  <? echo $arr['SU']; ?> Tahun</td>
  </tr>
	 <tr>
    <td class="verdana8blk">No Agen</td>
    <td class="verdana8blk">:  <? echo $arr['NO_AGEN']; ?></td>
    <td class="verdana8blk">Tgl Mulai</td>
    <td class="verdana8blk">:  <? echo $KLN->berat; ?></td>
  </tr>
   
	<tr>
    <td class="verdana8blk">Alamat Tetap</td>
    <td class="verdana8blk" colspan="3">:  <? echo $arr['ALAMAT']; ?></td>
  </tr>	
  <tr>
    <td class="verdana8blk">Alamat Tagih</td>
    <td class="verdana8blk" colspan="3">:  <? echo $arr['ALAMAT']; ?></td>
  </tr>	
  <tr>
    <td class="verdana8blk">Phone Tagih</td>
    <td class="verdana8blk" colspan="3">:  <? echo $arr['NO_TELP']; ?>  
		Phone Tetap : <? echo $arr['NO_TELP']; ?></td>
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
    <td class="verdana8blk">: <? echo $arr['FAKTOR_DP']; ?></td>       
  </tr> 
  <tr>
    <td class="verdana8blk">Prosen BSX/tahun</td>
    <td class="verdana8blk">: <? echo $arr['PROSEN_BSX']; ?> %</td>   
    <td class="verdana8blk">Prosen Pensiun Janda</td>
    <td class="verdana8blk">: <? echo $arr['PROS_PJD']; ?> %</td>    
  </tr> 
    <tr>
    <td class="verdana8blk">Prosen BSI/tahun</td>
    <td class="verdana8blk">: <? echo $arr['PROSEN_BSI']; ?> %</td>   
    <td class="verdana8blk">Prosen Pensiun Yatim-Piatu</td>
    <td class="verdana8blk">: <? echo $arr['PROS_PYT']; ?> %</td>    
  </tr> 
    <tr>
    <td class="verdana8blk">Prosen CS/tahun</td>
    <td class="verdana8blk">: <? echo $arr['PROSEN_CS']; ?> %</td>   
    <td class="verdana8blk">Prosen Pensiun Yatim/Piatu</td>
    <td class="verdana8blk">: <? echo $arr['PROS_PYP']; ?> %</td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Prosentase Max</td>
    <td class="verdana8blk">: <? echo $arr['PROSEN_MAX']; ?> %</td>   
    <td class="verdana8blk">Metode Perhitungan Eskalasi</td>
    <td class="verdana8blk">: <? echo $arr['KD_HITUNG_ESK']; ?></td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Prosentase Min</td>
    <td class="verdana8blk">: <? echo $arr['PROSEN_MIN']; ?> %</td>   
    <td class="verdana8blk">Prosen Eskalasi</td>
    <td class="verdana8blk">: <? echo $arr['PROS_ESK']; ?> %</td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Jml Anak Maksimum</td>
    <td class="verdana8blk">: <? echo $arr['JUMLAH_ANAK']; ?> Anak</td>   
    <td class="verdana8blk">Usia Anak Maksimum</td>
    <td class="verdana8blk">: <? echo $arr['USA_MAX']; ?> Tahun</td>    
  </tr> 
  <tr>
    <td class="verdana8blk">Masa Cacat Min.</td>
    <td class="verdana8blk">: <? echo $arr['MIN_CACAT']; ?> Tahun</td>   
    <td class="verdana8blk">Masa Dipercepat Min.</td>
    <td class="verdana8blk">: <? echo $arr['MIN_DPC']; ?> Tahun</td>    
  </tr> 
  
  <tr>
    <td class="verdana8blk">Metode Perhitungan Tebus</td>
    <td class="verdana8blk">: <? echo $arr['KD_HITUNG_TEBUS']; ?></td>   
    <td class="verdana8blk">Cash Refund Anuity Orang Terakhir</td>
    <td class="verdana8blk">: <? echo $arr['CRAUU']; ?></td>    
  </tr>
  
  <tr>
    <td class="verdana8blk">Prosentase Kenaikan Gaji Asumsi</td>
    <td class="verdana8blk">: <? echo $arr['PROS_KENAIKAN_GAJI']; ?> %</td>      
  </tr>
  <tr>
    <td class="verdana8blk">Faktor Benefit THT</td>
    <td class="verdana8blk"> : <? echo $arr['FAKTOR_THT']; ?> x Gaji</td>   
    <td class="verdana8blk">Faktor Benefit EBK</td>
    <td class="verdana8blk"> : <? echo $arr['MIN_CACAT']; ?> x Gaji</td>    
  </tr>
  <tr>
    <td class="verdana8blk">JUA Benefit DWL</td>
    <td class="verdana8blk">: <? echo $arr['JUA_DWL']; ?></td>
    <td class="verdana8blk">JUA Jaminan Lengkap</td>
    <td class="verdana8blk">: <? echo $arr['PROS_KENAIKAN_GAJI']; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Pros Gaji Iuran Pasti</td>
    <td class="verdana8blk">: <? echo $arr['PROS_IURAN']; ?> %</td>   
    <td class="verdana8blk">Manfaat Target</td>
    <td class="verdana8blk">: <? echo $arr['IS_MANFAAT_TARGET']; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Restitusi Premi Skg</td>
    <td class="verdana8blk">: <? echo $arr['RESTITUSI_PREMI']; ?></td>          
  </tr>
  <tr>
    <td class="verdana8blk">Restitusi Premi Bertahap</td>
  <tr>
    <td class="verdana8blk">Tahap 1</td>   
    <td class="verdana8blk">: <? echo $arr['RESTITUSI_PREMI1']; ?></td>
    <td class="verdana8blk">Tahap 2</td>
    <td class="verdana8blk">: <? echo $arr['RESTITUSI_PREMI2']; ?></td>
   </tr>
   <tr>    
    <td class="verdana8blk">Tahap 3</td>
    <td class="verdana8blk">: <? echo $arr['RESTITUSI_PREMI3']; ?></td>      
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
  </tr>
  <tr>    
    <td class="verdana8blk">Kontribusi Perusahaan</td>
    <td class="verdana8blk">: <? echo $arr['RESTITUSI_PREMI']; ?> %</td>  
    <td class="verdana8blk">Kontribusi Pegawai</td>
    <td class="verdana8blk">: <? echo $arr['KONTRIB_KLIEN_BS']; ?> %</td>   
  </tr>
  <tr>
    <td class="verdana8blk">Masa Kerja CS</td>
  </tr>
  <tr>   
    <td class="verdana8blk">Kontribusi Perusahaan</td>
    <td class="verdana8blk">: <? echo $arr['KONTRIB_PRS']; ?> %</td>  
    <td class="verdana8blk">Kontribusi Pegawai</td>
    <td class="verdana8blk">: <? echo $arr['KONTRIB_KLIEN']; ?> %</td>   
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
    <td class="verdana8blk">: <? echo $arr['BIAYA_INVESTASI']; ?> %</td>   
    <td class="verdana8blk">Biaya Dana Awal</td>
    <td class="verdana8blk">: <? echo $arr['BIAYA_DANA_AWAL']; ?> %</td>    
  </tr>
  <tr>
    <td class="verdana8blk">Biaya Biaya Adm Tahun-1</td>
    <td class="verdana8blk">: <? echo $arr['BIAYA_ADM_THN1']; ?> %</td>   
    <td class="verdana8blk">Biaya Biaya Adm Lanjutan</td>
    <td class="verdana8blk">: <? echo $arr['BIAYA_LANJUTAN']; ?> %</td>    
  </tr>
  <tr>
    <td class="verdana8blk">Biaya Lain-lain</td>
    <td class="verdana8blk">: <? echo $arr['BIAYA_LAIN_LAIN']; ?> %</td>        
  </tr>
  <tr>
    <td class="verdana8blk">Tarif Asuransi Kematian</td>
    <td class="verdana8blk">: <? echo $arr['BIAYA_ASURANSI_KEMATIAN']; ?> permil</td>   
    <td class="verdana8blk">Tarif Cacat Tetap Total</td>
    <td class="verdana8blk">: <? echo $arr['PROS_KENAIKAN_GAJI']; ?> permil</td>    
  </tr>
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
	<tr>
    <td colspan="4" align="center">		
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"PESERTA AKTIF\" onclick=\"NewWindow('pesertaaktifjht.php?no_polis=%s&no_polis_lama=%s&pempol=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$no_polis,$nopollama,$pempol); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"PESERTA PASIF\" onclick=\"NewWindow('pesertapasifjht.php?no_polis=%s&no_polis_lama=%s&pempol=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$no_polis,$nopollama,$pempol); ?>
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS TAGIHAN\" onclick=\"NewWindow('historis_tagihanjht.php?no_polis=%s&no_polis_lama=%s&pempol=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$no_polis,$nopollama,$pempol); ?>
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS PELUNASAN\" onclick=\"NewWindow('historis_pelunasanjht.php?no_polis=%s&no_polis_lama=%s&pempol=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$no_polis,$nopollama,$pempol); ?>
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS PREMI SEKALIGUS CICIL\" onclick=\"NewWindow('historis_bsciciljht.php?no_polis=%s&no_polis_lama=%s&pempol=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$no_polis,$nopollama,$pempol); ?>

		</td>
  </tr>
</table>
   </td>
  </tr>
</table> 
<? 
} 

?>
<hr size="1">
<a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a>