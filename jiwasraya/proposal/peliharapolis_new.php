<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/klien.php";
 include "../../includes/pertanggungan.php";
 $DB=New database($userid, $passwd, $DBName);
  $DB1=New database($userid, $passwd, $DBName);
  $DB2=New database($userid, $passwd, $DBName);
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

if($prefixpertanggungan){
	$prefixpertanggungan = $_GET[pref_p];
	$nopertanggungan = $_GET[noper_p];
}

$prefixpertanggungan = $_GET[pref_p];
$nopertanggungan = $_GET[noper_p];


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
      <b>POLIS NO : <? echo $PER->label." / ".$PER->nopol; ?></b>
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
    <td class="verdana8blk"><b>:  <? echo "<font color=red>".$PER->statusfile."</font>"; ?>

<!-- Tambahan oleh Ari 22/12/2010 - Status 'TERGADAI'-->
		<? 
		$sql = "select prefixpertanggungan,nopertanggungan ".
					 "from $DBUser.tabel_700_gadai where prefixpertanggungan='".$prefixpertanggungan."' and nopertanggungan='".$nopertanggungan."' ".
					 "and status in ('3','4')";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		$gdi=$DB->nextrow();
		$nopolgadai = $gdi["NOPERTANGGUNGAN"]; 
		if($nopolgadai!="")
		{
//		  echo "<font color=#0000d9> - (Tergadai)</font>";
		  echo "<font color=black> - (TERGADAI)</font>";
		}
		?>
<!-- Tambahan oleh Ari 22/12/2010 - Status 'TERGADAI' -->
	 
	<?
	if($PER->nopolswitch==""){
	$sqlcekswitch="select isswitching from $DBUser.tabel_700_tebus where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
	$DB1->parse($sqlcekswitch);
	$DB1->execute();
	$isswitch=$DB1->nextrow();
	$statusswitch=$isswitch["ISSWITCHING"];
	if($statusswitch==""){
	}else{
	$cekpolis="select nopertanggungan,prefixpertanggungan from $DBUser.tabel_200_pertanggungan where nopolswitch='".$prefixpertanggungan.$nopertanggungan."'";
	$DB2->parse($cekpolis);
	$DB2->execute();
	$pol=$DB2->nextrow();
	$pref=$pol["PREFIXPERTANGGUNGAN"];
	$nopert=$pol["NOPERTANGGUNGAN"];
	echo " Switching Menjadi <a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$pref."&noper=".$nopert."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$pref.$nopert."</a>";
	}
	}
	else{
	$pra=substr($PER->nopolswitch,0,2);
	$pro=substr($PER->nopolswitch,2,9);
	echo "Switching dari : <a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$pra."&noper=".$pro."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$PER->nopolswitch."</a>";
	}
	?></td>
 		<? 
		$sqlt ="select nomorsip from $DBUser.tabel_700_tebus ".
				   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
		       $DB->parse($sqlt);
	    	   $DB->execute();
	    	   $sip=$DB->nextrow();
		       $nosip=$sip["NOMORSIP"];
		if($PER->statusfile=="TEBUS"){			 
			$t="SIP";
			$s=" ".$nosip;
		}
		if($nosip==''){
		  $t="Keterangan";
		  $s=" ".$PER->keterangan;
		}
		?>
    <td class="verdana8blk"><?=$t;?></td>
    <td class="verdana8blk">: <?=$s;?></td>
  </tr>
  <tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Klien nomor</td>
    <td class="verdana8blk">:  <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->notertanggung; ?>','updclnt',800,200,1);"><? echo $PER->notertanggung; ?></a></td>
		<td class="verdana8blk">Nama</td>
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
    <td class="verdana8blk">Tgl Lahir</td>
    <td class="verdana8blk">:  <? echo $arv["TGLLAHIR"]; ?></td>
    <td class="verdana8blk">Jenis Kelamin / Marital Status</td>
    <td class="verdana8blk">:  <? echo $arv["JENISKELAMIN"]; ?> / <? echo $arv["MERITALSTATUS"]; ?> </td>
  </tr>
  <tr>
    <td class="verdana8blk">Pekerjaan</td>
    <td class="verdana8blk">:  <? echo $arv["NAMAPEKERJAAN"]; ?></td>
    <td class="verdana8blk">Hobby</td>
    <td class="verdana8blk">: <? echo $arv["NAMAHOBBY"]; ?></td>
  </tr>
	
	 <tr>
    <td class="verdana8blk">Tinggi Badan</td>
    <td class="verdana8blk">:  <? echo $KLN->tinggi; ?> cm</td>
    <td class="verdana8blk">Berat Badan</td>
    <td class="verdana8blk">:  <? echo $KLN->berat; ?> kg</td>
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
    <td class="verdana8blk">:  <? echo $PER->tglcetak; ?></td>
  </tr>		
  <tr>
    <td class="verdana8blk">Bayar Terakhir</td>
    <td class="verdana8blk">:  <? echo $PER->tgllastpayment; ?></td>
    <td class="verdana8blk">Booking Berikutnya</td>
    <td class="verdana8blk">:  <? echo $PER->tglnextbook; ?></td>
  </tr>	
	
	<tr>
    <td class="verdana8blk">Auto Debet</td>
    <td class="verdana8blk">:  <?=$PER->autodebet; ?> 
		<? 
		if($PER->autodebet=="Ya")
		{
		 echo "Rekening ".$PER->namabank." No. ".$PER->norekeningdebet;
		}
		?>
		</td>
		<td class="verdana8blk">Premi Top-up Berkala</td>
    <td class="verdana8blk">:  
		<?
							$sql = "select kdbenefit,premi from $DBUser.tabel_223_transaksi_produk where  
                      kdbenefit in ('BNFTOPUP','BNFTOPUPSG')
                      and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
							$DB->parse($sql);
      			  $DB->execute();
							while($top=$DB->nextrow())
							{
							  if($top["KDBENEFIT"]=="BNFTOPUP")
								{
								  $ptopupbk = $top["PREMI"];
								} else {
								  $ptopupsg = $top["PREMI"];
								}
							}
		echo number_format($ptopupbk,2);
		?>
		
		</td>
		
  </tr>	
	
	<? 
	if($PER->namavaluta=="RUPIAH INDEX"){
	?>
	<tr>
    <td class="verdana8blk">Premi I Hitungan</td>
    <td class="verdana8blk">:  <? echo number_format(($PER->premi1/$PER->indexawal),2); ?></td>
    <td class="verdana8blk">Premi II Hitungan</td>
    <td class="verdana8blk">:  <? echo number_format(($PER->premi2/$PER->indexawal),2); ?></td>
  </tr>
	<? 
	} else {}
	?>	
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr> 
  <tr>
    <td class="verdana8blk">Pemegang Polis</td>
    <td class="verdana8blk">:   <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->nopemegangpolis; ?>','updclnt',800,200,1);"><? echo $PER->namapemegangpolis; ?></a></td>
    <td class="verdana8blk">Penagih</td>
		<td class="verdana8blk">:  <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->nopenagih; ?>','updclnt',800,200,1);"><? echo $PER->namapenagih; ?></a></td>
  </tr>
  <tr>
    <td class="verdana8blk">Pembayar Premi</td>
    <td class="verdana8blk">:  <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->nopembayarpremi; ?>','updclnt',800,200,1);"><? echo $PER->namapembayarpremi; ?></a></td>
    <td class="verdana8blk">Agen</td>
		<td class="verdana8blk">:  <a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->noagen; ?>','updclnt',800,200,1);"><? echo $PER->namaagen; ?></a></td>
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
  		 print( "<td class=\"verdana8blu\" align=\"center\"><a href=\"#\" onclick=\"NewWindow('infoklien.php?noklien=".$arr["NOKLIEN"]."','updclnt',800,200,1);\">".$arr["NOKLIEN"]."</a></td>" );
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
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"CETAKAN POLIS NEW\" onclick=\"window.open('../pelaporan/iie.cetak.polis.php?prefix=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','width=960,height=560,location=no, scrollbars=yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT\" onclick=\"NewWindow('showbenefit1.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
  	<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST PREMI\" onclick=\"NewWindow('../akunting/kartupremi1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST GADAI\" onclick=\"NewWindow('../akunting/kartugadai1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST MUTASI\" onclick=\"NewWindow('../polis/mutasi.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"STATUS MUTASI\" onclick=\"NewWindow('../polis/statusmutasipertanggungan.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
		<? $nottemp=true; ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"NILAI TEBUS\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s&nottemp=%s','name','500','500','yes');return false\" style=\"font-size: 8pt\">",$PER->jua,$prefixpertanggungan,$nopertanggungan,$nottemp); ?>		
		<? printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"KOMISI\" onclick=\"NewWindow('popupkom.php?prefixpertanggungan=%s&noproposal=%s&nopertanggungan=%s&noagen=%s','popupkomisi','500','350','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$nopertanggungan,$PER->namaagen); ?>		

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
		<? $polisbaru_smart="$prefixpertanggungan-$nopertanggungan"; printf("<input type=\"button\" name=\"docpolis\" value=\"DOKUMEN\" onclick=\"NewWindow('http://192.168.2.82/smart_ifglife/list.php?no_polis1=".base64_encode(base64_encode($polisbaru_smart))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">"); ?>
		<? printf("<input type=\"button\" name=\"histduplikat\" value=\"HIST CETAK POLIS\" onclick=\"NewWindow('hist_duplikat.php?pref=%s&noper=%s','name','600','300','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<?
		if ($PER->produk=='JSSPB1' || $PER->produk=='JSSPAB1'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT BULANAN\" onclick=\"NewWindow('showbenefitbln.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); 
			 }
		
		if ($PER->produk=="JSPS"||$PER->produk=="SC5S"||$PER->produk=="SC6S"||$PER->produk=="ST5S"||$PER->produk=="ST6S"){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANS. SAVING\" onclick=\"NewWindow('showbenefitsaving.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); 
			 }
		?>
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
		//===============KLAUSUL CASH PLAN
		$sqlcp = "select COUNT(*) ADA from $DBUser.tabel_223_transaksi_produk where  
                      substr(kdbenefit,1,3) in ('CPB','CPM','TER','CI','PA','CAC')
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