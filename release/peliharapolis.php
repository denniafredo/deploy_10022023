<?
 	include "../../includes/database.php";
 	include "../../includes/session.php";
 	include "../../includes/klien.php";
 	include "../../includes/pertanggungan.php";
	include "../includes/listaccount_legacy.php";
 	$DB=New database($userid, $passwd, $DBName);
  	$DB1=New database($userid, $passwd, $DBName);
  	$DB2=New database($userid, $passwd, $DBName);
  	$DBE=New database($userid, $passwd, $DBName);
  	$user_view = in_array($modul, array('ALL', 'ITC', 'CAL', 'CUS', 'CDC'));
  	$user_cc = in_array($modul, array('ALL', 'ITC', 'CAL', 'CUS', 'REP', 'CDC'));
  	$user_covernote = in_array($modul, array('ALL', 'ITC', 'REP', 'POS', 'DMS', 'UND', 'KLM'));
	$usersaelegacy = in_array($_SESSION['userid'], $list);
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
    <td class="verdana10blk" width="300">Nomor Polis Baru</td>
	<td width="10">:</td>
	<td>
		<?php 
			$sql = "SELECT prefixpertanggungan,nopertanggungan,nopolbaru 
					FROM $DBUser.tabel_200_pertanggungan WHERE nopolbaru = '$nopolbaru' OR (prefixpertanggungan = '$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan')";
			$DB->parse($sql);
			$DB->execute();
			$r = $DB->nextrow();
			$prefixpertanggungan = $r['PREFIXPERTANGGUNGAN'];
			$nopertanggungan = $r['NOPERTANGGUNGAN'];
			$nopolbaru = $r['NOPOLBARU'];
		?>
		<input type="text" name="nopolbaru" class="c" size="20" maxlength="15" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();" value="<?=$nopolbaru?>">
		<!--input type="text" name="prefixpertanggungan" class="c" size="2" maxlength="2" onFocus="highlight(event);document.porm.nopol.value=''" value="<?echo strtoupper($prefixpertanggungan);?>" onChange="javascript:this.value=this.value.toUpperCase();">
		<input type="text" name="nopertanggungan" class="c" size="9" maxlength="9" onBlur="validasi(this.form.nopertanggungan)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $nopertanggungan;?>"-->
		<a onClick="NewWindow('pilihpolis.php','name',800,300,1)"><img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a>
	</td>
  </tr>
  <tr>
    <td class="verdana10blk">Atau Nomor Polis Lama</td>
	<td>:</td>
	<td>
		<input type="text" name="nopol" class="c" size="11" maxlength="11" value="<?echo strtoupper($nopol);?>" onFocus="highlight(event);" onChange="javascript:this.value=this.value.toUpperCase();">
		<i style="font-size:13px">Contoh : (XX999999999)</i>
	</td>
  </tr>
  <tr>
	<td colspan="2"></td>
	<td><? echo "<input type=\"submit\" value=\"Submit\" name=\"insert\">";?></td>
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
       $sql = "select a.kdpertanggungan,a.kdstatusfile from $DBUser.tabel_200_pertanggungan a ".
	            "where $nomor";
							
			 //echo $sql;				
		$DB->parse($sql);
	   	$DB->execute();
		$arx=$DB->nextrow();
			 
			 
			 			 
     	 if ($arx["KDPERTANGGUNGAN"]=='1' && $kdkantor='KP') {
		     echo "<font face=Verdana color=red>Pertanggungan Masih Berupa Proposal ";		 	 
       } elseif ($arx["KDPERTANGGUNGAN"]=='2' && ($arx["KDSTATUSFILE"]=='1' || $arx["KDSTATUSFILE"]=='4')) {
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
		 $PP=New Klien($userid,$passwd,$PER->nopemegangpolis);
			//echo "INI YANG LAGI GW CARI ".$PER->namaproduk; 
//if ($PER->statusfile!="AKTIF") {
//		 	   echo $PER->statusfile."<font face=Verdana color=red>Status Polis saat ini tidak dalam keadaan aktif";
 //         die;		 		 
//}

//if ($userid == 'NURSYS' || $userid == 'AMONG' || $userid =='WITA_KP' || $userid =='BAGUS') {} else {
//echo $PER->expirasi;
$tglhariini=date('Ymd');
$sqlaa="select to_char(add_months(to_date('".$PER->expirasi."','dd/mm/yyyy'),36),'yyyymmdd') akhirexp from dual";
$DB->parse($sqlaa);
$DB->execute();
$arrexp=$DB->nextrow();
$tglexp=$arrexp["AKHIREXP"];
//echo $tglexp;
//echo "<br>".$tglhariini;
if (($kantor=="KP") || ($kantor=="KN")) {} else {
	if ($PER->produk =='JSSPBTN') {
		echo "<font face=Verdana color=red>Confidential Data</font>";
			        die;}
}

if ($kantor=="KP" || substr($kantoruser,1,1)=="A") {} else {
	
  if (($PER->statusfile =="DELETE" || $PER->statusfile =="NON-AKTIF" || $PER->statusfile =="BATAL" || $PER->statusfile =="EKSPIRASI" || $PER->statusfile =="TEBUS")) {
				   if($PER->statusfile =="EKSPIRASI" && $tglhariini<$tglexp){
              //echo "Available";
           }elseif($PER->statusfile =="TEBUS"){
                 $sql="select to_char(add_months(tglmohon,12),'yyyymmdd') akhir from $DBUser.tabel_700_tebus ".
                      "where prefixpertanggungan='".$prefix."' and nopertanggungan='".$noper."'";
                 $DB->parse($sql);
                 $DB->execute();
                 $arrteb=$DB->nextrow();
                 $exp=$arrteb["AKHIR"];
                 if($tglhariini<$tglexp){
                 }     
           }else{
              echo "<font face=Verdana color=red>Status Polis saat ini ".$PER->statusfile;
			        die;
           }
        		 		 
	}
}


$sql="select kdkantorinduk,kdrayonpenagih, premi1*
         CASE
            WHEN kdvaluta = 1
            THEN
               1
            WHEN kdvaluta = 3
            THEN
               (SELECT   x.kurs
                  FROM   $DBUser.tabel_999_kurs_transaksi x
                 WHERE   x.kdvaluta = a.kdvaluta
                         AND x.tglkursberlaku =
                               (SELECT   MAX (c.tglkursberlaku)
                                  FROM   $DBUser.tabel_999_kurs_transaksi c
                                 WHERE   c.kdvaluta = x.kdvaluta
                                         AND c.tglkursberlaku <= SYSDATE))
            WHEN kdvaluta = 0
            THEN
               (SELECT   x.kurs
                  FROM   $DBUser.tabel_999_kurs_transaksi x
                 WHERE   x.kdvaluta = a.kdvaluta
                         AND x.tglkursberlaku =
                               (SELECT   MAX (c.tglkursberlaku)
                                  FROM   $DBUser.tabel_999_kurs_transaksi c
                                 WHERE   c.kdvaluta = x.kdvaluta
                                         AND c.tglkursberlaku <= SYSDATE))
               / a.indexawal
         END preminya,
(select decode(COUNT(*),0,'X','Y')
from $DBUser.tabel_888_userid
where JABATAN IN (
select jabatan from $DBUser.UID_NON_CONFIDENTIAL
)
and userid = '$userid') boleh,
			(SELECT keterangan FROM $DBUser.rpt_prefix_noper_restru WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan AND keterangan LIKE 'STATUS.MIGRASI.POLIS%') statusmigrasi
				from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b, $DBUser.TABEL_001_KANTOR c ".
	            "where a.nopenagih=b.nopenagih and kdrayonpenagih=c.kdkantor and $nomor";
			//echo $sql;
			 $DB->parse($sql);
             $DB->execute();
             $arrprem=$DB->nextrow();
			 //echo	$arrprem["BOLEH"];		
             if ($arrprem["PREMINYA"]>=10000000000) {
				 /*if (($kantor=="KP") || ($kantor==$arrprem["KDRAYONPENAGIH"]) || ($kantor==$arrprem["KDKANTORINDUK"])) {			 	
					if ($arrprem["BOLEH"]=="Y"){}
					else {echo "<font face=Verdana color=red>Confidential Data</font>";
					die;}
				 }
					else {echo "<font face=Verdana color=red>Confidential Data</font>";
					die;}*/
				if ($kantor != "KP") {
					echo "<font face=Verdana color=red>Confidential Data</font>";
				}
			 } else {}	
?>
<hr size=1>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" class="tblborder">
<tr>
<td> 

<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="tblhead">
    <td colspan="3" align="center" class="arial12whtb">
      <b>POLIS NO : 
		<? echo /*$PER->label." / ".$PER->nopol*/$PER->nopolbaru." / ".$PER->nopol; ?>
	  </b>
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
    <td class="verdana8blk">Diapprove</td>
    <td class="verdana8blk">:  <? echo $PER->approve; ?></td>
    <td class="verdana8blk">Diakseptasi</td>
		<td class="verdana8blk">:  <? echo $PER->akseptasi; ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Nomor SPAJ </td>
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
		<?php 
			if ($arrprem['STATUSMIGRASI'] == 'STATUS.MIGRASI.POLIS.RED') {
				$statusmigrasipolis = "red";
				$textmigrasipolis = "RED";
			} else if ($arrprem['STATUSMIGRASI'] == 'STATUS.MIGRASI.POLIS.AMBER') {
				$statusmigrasipolis = "orange";
				$textmigrasipolis = "AMBER";
			} else if ($arrprem['STATUSMIGRASI'] == 'STATUS.MIGRASI.POLIS.GREEN') {
				$statusmigrasipolis = "green";
				$textmigrasipolis = "GREEN";
			}
		?>
		<span style="background:<?=$statusmigrasipolis?>;margin-left:5px;padding:1px 8px;border-radius:50%;" title="<?=$textmigrasipolis?>"></span>

<!-- Tambahan oleh Ari 22/12/2010 - Status 'TERGADAI'-->
		<? 
		$sql = "select prefixpertanggungan,nopertanggungan ".
					 "from $DBUser.tabel_700_gadai where prefixpertanggungan='".$prefixpertanggungan."' and nopertanggungan='".$nopertanggungan."' ".
					 "and status in ('3','4') and tglgadai=(select max(tglgadai) from $DBUser.tabel_700_gadai where prefixpertanggungan='".$prefixpertanggungan."' and nopertanggungan='".$nopertanggungan."')";
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
	?>
	</td>
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
    <td class="verdana8blk">Build ID</td>
    <td class="verdana8blk">: 
    	<?php
    		$sql_b = "SELECT B.BUILDID
						FROM $DBUser.TABEL_200_PERTANGGUNGAN A
						LEFT JOIN $DBUser.TABEL_SPAJ_ONLINE B ON A.NOSP = B.NOSPAJ
							WHERE A.PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
							    AND A.NOPERTANGGUNGAN = '".$nopertanggungan."'
					";
			$DB->parse($sql_b);
			$DB->execute();
			$arr_b=$DB->nextrow();
		    echo $arr_b["BUILDID"];
    	?>
    </td>
    <td class="verdana8blk">Lock Mutasi</td>
    <td class="verdana8blk">: <?="($PER->lockmutasi) $PER->namalockmutasi"?></td>
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
			 "a.alamattetap01,a.alamattetap02,d.namakotamadya,e.namapropinsi,NVL(a.NO_PONSEL,a.PHONETETAP02) nohp, a.EMAILTAGIH ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) ".
			 "and a.kdpropinsitagih=e.kdpropinsi(+) and a.kdkotamadyatagih=d.kdkotamadya(+) and a.noklien='$PER->nopemegangpolis' ";
//echo $qry;
	$DB->parse($qry);
	$DB->execute();
	$arv=$DB->nextrow();
	   
	$qry="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,".
			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode (a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin, ".
			 "a.tinggibadan,a.beratbadan, decode (a.meritalstatus,'D','DUDA','J','JANDA','K','KAWIN','L','LAJANG') meritalstatus,".
			 "a.alamattagih01,a.alamattagih02,a.phonetagih01,a.phonetagih02,a.phonetetap01,a.phonetetap02,".
			 "a.alamattetap01,a.alamattetap02,d.namakotamadya,e.namapropinsi,NVL(a.NO_PONSEL,a.PHONETETAP02) nohp, a.EMAILTAGIH ".
			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e ".
		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) ".
			 "and a.kdpropinsitagih=e.kdpropinsi(+) and a.kdkotamadyatagih=d.kdkotamadya(+) and a.noklien='$PER->notertanggung' ";
			 //"and a.kdpropinsitagih=e.kdpropinsi(+) and a.kdkotamadyatagih=d.kdkotamadya(+) and a.noklien='$PER->nopemegangpolis' ";
//echo $qry;
	$DB->parse($qry);
	$DB->execute();
	$arttg=$DB->nextrow();
	?>
  <tr>
    <td class="verdana8blk">Tgl Lahir</td>
    <td class="verdana8blk">:  <? echo $arttg["TGLLAHIR"]; ?></td>
    <td class="verdana8blk">Jenis Kelamin / Marital Status</td>
    <td class="verdana8blk">:  <? echo $arttg["JENISKELAMIN"]; ?> / <? echo $arttg["MERITALSTATUS"]; ?> </td>
  </tr>
  <tr>
    <td class="verdana8blk">Pekerjaan</td>
    <td class="verdana8blk">:  <? echo $arttg["NAMAPEKERJAAN"]; ?></td>
    <td class="verdana8blk">Hobby</td>
    <td class="verdana8blk">: <? echo $arttg["NAMAHOBBY"]; ?></td>
  </tr>

  	<tr>
	  	<td class="verdana8blk"><b>Ekstra</b></td>
	    <td class="verdana8blk">:  
			<?php
				$sql_extra = "SELECT 
								C.LIFEEXTRA,
    							C.PAEXTRA,
    							C.TPDEXTRA
							FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
							    $DBUser.TABEL_SPAJ_ONLINE B,
							    JAIM.PRO_EXTRA_RESIKO@JAIM C
							WHERE A.NOSP = B.NOSPAJ
							    AND C.BUILD_ID = B.BUILDID
							    AND A.PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
							    AND A.NOPERTANGGUNGAN = '".$nopertanggungan."'
							    AND C.STATUS = 'CTT'
							    AND C.TGLREKAM = (SELECT MAX(TGLREKAM) FROM JAIM.PRO_EXTRA_RESIKO@JAIM WHERE BUILD_ID = B.BUILDID AND STATUS = 'CTT')";
				$DBE->parse($sql_extra);
				$DBE->execute();
				$arrext=$DBE->nextrow();
				if($arrext["LIFEEXTRA"] == ''){
					$sql_extra = "SELECT 
									(SELECT Y.LIFEEXTRA 
								    FROM JAIM.PRO_TERTANGGUNG@JAIM X,
								    	JAIM.JAIM_400_JENIS_PEKERJAAN@JAIM Y
								    WHERE X.KDJNSPEKERJAAN = Y.KDJENISPEKERJAAN 
								        AND X.BUILD_ID = B.BUILDID
								    )LIFEEXTRA,
								    (SELECT Y.PAEXTRA 
								    FROM JAIM.PRO_TERTANGGUNG@JAIM X,
								    	JAIM.JAIM_400_JENIS_PEKERJAAN@JAIM Y
								    WHERE X.KDJNSPEKERJAAN = Y.KDJENISPEKERJAAN 
								        AND X.BUILD_ID = B.BUILDID
								    )PAEXTRA,
								    (SELECT Y.TPDEXTRA 
								    FROM JAIM.PRO_TERTANGGUNG@JAIM X,
								    	JAIM.JAIM_400_JENIS_PEKERJAAN@JAIM Y
								    WHERE X.KDJNSPEKERJAAN = Y.KDJENISPEKERJAAN 
								        AND X.BUILD_ID = B.BUILDID
								    )TPDEXTRA
							FROM $DBUser.TABEL_200_PERTANGGUNGAN A,
							    $DBUser.TABEL_SPAJ_ONLINE B
							WHERE A.NOSP = B.NOSPAJ
							    AND A.PREFIXPERTANGGUNGAN = '".$prefixpertanggungan."'
							    AND A.NOPERTANGGUNGAN = '".$nopertanggungan."'
							    ";
					$DBE->parse($sql_extra);
					$DBE->execute();
					$arrext_=$DBE->nextrow();
					echo "Life : ".$arrext_["LIFEEXTRA"]." /permil, ";
					echo "PA : ".$arrext_["PAEXTRA"].", ";
					echo "TPD : ".$arrext_["TPDEXTRA"]."%";
				}else{
					echo "Life : ".$arrext["LIFEEXTRA"]." /permil, ";
					echo "PA : ".$arrext["PAEXTRA"].", ";
					echo "TPD : ".$arrext["TPDEXTRA"]."%";
				}
			?>
	    </td>
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
    <td class="verdana8blk" colspan="3">:  <? echo $arv["ALAMATTAGIH01"]/*." ".$arv["ALAMATTAGIH02"]." ".$arv["NAMAKOTAMADYA"]." ".$arv["NAMAPROPINSI"]*/; ?></td>
  </tr>	
  <tr>
    <td class="verdana8blk">Phone Tagih</td>
    <td class="verdana8blk">:  <? echo $arv["PHONETAGIH01"]; ?><? echo $arv["PHONETAGIH02"]=='' ? "" : ", ".$arv["PHONETAGIH02"] ; ?>  
		Phone Tetap : <? echo $arv["PHONETETAP01"]; ?><? echo $arv["PHONETETAP02"]=='' ? "" : ", ".$arv["PHONETETAP02"] ; ?> </td>
		<td class="verdana8blk"><b>No. Handphone Korespondensi</b></td>
    <td class="verdana8blk"><b> :  <? echo $arv["NOHP"]; ?></b></td>
  </tr>	
	<tr>
    <td colspan="4"><hr size="1"></td>
  </tr>
  <tr>
    <td class="verdana8blk">Nama Produk</td>
    <td class="verdana8blk">:  <b><? echo $PER->produk."</b> ".$PER->namaproduk; ?></td>
    <? 
	//$sq2="select kdmapping from $DBUser.tabel_001_kantor where kdkantor='".$prefixpertanggungan."'";
	$sq2="SELECT noaccount FROM $DBUser.tabel_100_klien_account WHERE prefixpertanggungan = '$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan' AND jenis = 'HH' AND kdbank = 'BMRI'";
	//echo $sqo;
	$DB2->parse($sq2);
	$DB2->execute();
	$arrh2h=$DB2->nextrow(); 
	//$noh2h=$arrh2h["KDMAPPING"].$nopertanggungan;    
	$noh2h=$arrh2h['NOACCOUNT'];
	 ?>
     <td class="verdana8blk">Nomor Host to Host</td>
    <td class="verdana8blk">:  
    <b><?=$noh2h; ?></b></td>
  </tr>
  <tr>
    <td class="verdana8blk"></td>
    <td class="verdana8blk"></td>
    <? 
	$sqo="select * from $DBUser.TABEL_100_KLIEN_ACCOUNT where  nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' and status='0' and jenis='VA' and kdbank='BNI'";
	//echo $sqo;
	$DB2->parse($sqo);
	$DB2->execute();
	$avc=$DB2->nextrow(); 
	     if($avc["NOACCOUNT"]==""){
		 echo "<td class=verdana8blk>&nbsp;</td>";
		 }else{ 
		 $arrketva = explode('-', $avc['KETERANGAN']);
		 $ketva = $arrketva[0].'-IFGLIFE-'.$arrketva[1];
		 ?>
		
     <td class="verdana8blk">Virtual Account <b>PREMI</b> BNI</td><? } ?>
    <td class="verdana8blk">:  
    <b><?="$avc[NOACCOUNT] <br>&nbsp;&nbsp;$ketva";?></b></td>
  </tr>
  <tr>
    <td class="verdana8blk"></td>
    <td class="verdana8blk"></td>
    <? 
	$sqo="select * from $DBUser.TABEL_100_KLIEN_ACCOUNT where  nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' and status='0' and jenis='VA' and kdbank='BCN'";
	//echo $sqo;
	$DB2->parse($sqo);
	$DB2->execute();
	$avc=$DB2->nextrow(); 
	     if($avc["NOACCOUNT"]==""){
		 echo "<td class=verdana8blk>&nbsp;</td>";
		 }else{ ?>
		
     <td class="verdana8blk">Virtual Account CIMB</td><? } ?>
    <td class="verdana8blk">:  
    <b><?=$avc["NOACCOUNT"]; ?></b></td>
  </tr>
	<!-- Tambahan untuk memunculkan nomor VIRTUAL ACCOUNT GADAI BNI - TEGUH 03/12/2019 -->
	<? 
		$sqo="SELECT * FROM $DBUser.TABEL_700_GADAI_ACCOUNT WHERE nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan' and status='0' and jenis='VA' and kdbank='BNI'";
		//echo $sqo;
		$DB2->parse($sqo);
		$DB2->execute();
		$avc=$DB2->nextrow(); 
		if($avc["NOACCOUNT"]==""){
			echo "";
		}else{ ?>
			<tr>
				<td class='verdana8blk'></td>
				<td class='verdana8blk'></td>
				<td class='verdana8blk'>Virtual Account <b>GADAI</b> BNI</td>
				<td class="verdana8blk">:  
					<b><?=$avc["NOACCOUNT"]; ?></b>
				</td>
			</tr>
	<? } ?>
	<!-- END Tambahan - TEGUH 03/12/2019 -->

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
    <td class="verdana8blk"><!--Taltup--></td>
    <td class="verdana8blk"><!--:  <? echo $PER->taltup; ?>--></td>
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
<?php if ($PER->kdstatusfile=='4'){ ?>
	<tr>
    <td class="verdana8blk">JUA BPO</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->juabpo,2); ?></td>
    <td class="verdana8blk">BPO Per</td>
    <td class="verdana8blk">:  <? echo $PER->tglbpo; ?></td>
  </tr>
<?php } ?>  
  <tr>
    <td class="verdana8blk">Gadai Otomatis</td>
    <td class="verdana8blk">:  <? $gpo = ($PER->gpo=='0') ? 'SETUJU' : 'TIDAK SETUJU';echo $gpo; ?></td>
    <td class="verdana8blk">Premi Standar</td>
    <td class="verdana8blk">:  <? echo $PER->notasi." ".number_format($PER->premistandar,2); ?></td>
  </tr>
  <tr>
    <td class="verdana8blk">Email</td>
    <td class="verdana8blk">:  <? /*echo ($PER->kdstatusemail=='1') ? 'OK, tgl:'.$PER->tglsendemail : '';*/ echo $arv["EMAILTAGIH"];?></td>
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
                      and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'"; //echo $sql;
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
  <tr>
    <td class="verdana8blk">Credit Card Expired</td>
    <td class="verdana8blk">:  <?=$PER->ccexpirasi; ?> 
		
		</td>
		<td class="verdana8blk"></td>
    <td class="verdana8blk">  
		
		
		</td>
		
  </tr>	
  <tr>
    <td class="verdana8blk">Media Korespondensi</td>
    <td class="verdana8blk">:  <?=$PP->tujuankorespondensi; ?> 
		
		</td>
		<td class="verdana8blk"></td>
    <td class="verdana8blk">  
		
		
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
	<td class="verdana8blk">Email Ahli Waris</td>
    <td class="verdana8blk">: <?=$PER->emailahliwaris;?></td>
	<td class="verdana8blk">No Referral</td>
	<td class="verdana8blk">: <?=$PER->noreferral?></td>
  </tr>
  <? if(substr($PER->produk,0,3)=="JL4"){ ?>
  <tr>
    <td class="verdana8blk">Porsi Fund</td>
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
			 <td align="C">Jenis Fund</td>
			 <td align="left">Nama Fund</td>
             <td align="left">Porsi Fund</td>			 
		  </tr>
	<? 
	$sql = "select b.kdfund,b.namafund,a.porsi ||'%' porsi from $DBUser.tabel_ul_opsi_fund a,$DBUser.tabel_ul_kode_fund b where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' and 
a.kdfund=b.kdfund";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		$i=1;
		while ($arr=$DB->nextrow()) {
  	include "../../includes/belang.php";
		   print( "<td class=\"verdana8blu\" align=\"center\">".$i."</td>" );
  		 print( "<td class=\"verdana8blu\" align=\"center\">".$arr["KDFUND"]."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$arr["NAMAFUND"]."</td>" );
			 print( "<td class=\"verdana8blu\" align=\"left\">".$arr["PORSI"]."</td>" );			 
			 
		   print( "</tr>" );
			
		  $i++;
		}		 
	?>	
			 </table>
     </td>    	
		 </table>
     </td>
	<tr>
    <? } ?>
	<tr>
    <td class="verdana8blk">Ahli Waris / Beneficiary</td>
    <td colspan="3" class="verdana8blk">: <?=$PER->namaahliwaris;?></td>
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
				 "AND (SELECT NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN WHERE NOKLIEN = a.NOKLIEN) <> 'DUMMY' ".
				 "order by a.nourut ";
//		echo $sql;
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
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT\" onclick=\"NewWindow('showbenefit1.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
  	<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST PREMI\" onclick=\"NewWindow('../akunting/kartupremi1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
	<? if($kantor=="KP") printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST TITIPAN PREMI\" onclick=\"NewWindow('../pelaporan/histpremititipan.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
     <? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST RIDER\" onclick=\"NewWindow('../akunting/karturider1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? //printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST GADAI\" onclick=\"NewWindow('../akunting/kartugadai1.php?prefix=%s&noper=%s','popuptebus','800','600','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<? printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST MUTASI\" onclick=\"NewWindow('../polis/mutasi.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
        <? printf("<input type=\"button\" name=\"tariftebus\" value=\"STATUS MUTASI\" onclick=\"NewWindow('../polis/statusmutasipertanggungan.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan); ?>
		<? $nottemp=true; ?>
		<? if($modul!="CCT"){ printf("<input type=\"button\" name=\"tariftebus\" value=\"NILAI TEBUS\" onclick=\"NewWindow('tebus.php?jua=%s&pref=%s&noper=%s&nottemp=%s','name','500','500','yes');return false\" style=\"font-size: 8pt\">",$PER->jua,$prefixpertanggungan,$nopertanggungan,$nottemp); } ?>		
		<? if($modul!="CCT"){ printf("<input type=\"button\" name=\"propmtc14komisi\" value=\"KOMISI\" onclick=\"NewWindow('popupkom.php?prefixpertanggungan=%s&noproposal=%s&nopertanggungan=%s&noagen=%s','popupkomisi','500','350','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$nopertanggungan,$PER->namaagen); } ?>	

		<?
// Tambahan oleh Ari per 04/12/2007 untuk Produk JS-LiNk (JL0/JL1) / Astha Plus (ATP) / Dwiguna Idaman (DGI) 
			 if (substr($PER->produk,0,3)=='JL0'||substr($PER->produk,0,3)=='JL1'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANSAKSI JS-LINK\" onclick=\"NewWindow('../polis/mutasi_jslink.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } 
			 // else if (substr($PER->produk,0,3)=='JL2'||substr($PER->produk,0,3)=='JL3'){
			 // 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANS. NEW JS-LINK\" onclick=\"NewWindow('../polis/mutasi_jslink2.php?noper=%s&prefix=%s','popupmutasi','950','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 // } 
			 else if (substr($PER->produk,0,3)=='JL4'||substr($PER->produk,0,3)=='JL2'||substr($PER->produk,0,3)=='JL3'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANS. NEW JS-LINK\" onclick=\"NewWindow('../polis/mutasi_jslink3.php?noper=%s&prefix=%s','popupmutasi','950','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
					printf("<input type=\"button\" name=\"tariftebus\" value=\"HISTORIS BIAYA COICORCOA\" onclick=\"NewWindow('../polis/mutasi_coicorcoa.php?noper=%s&prefix=%s','popupmutasi','950','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } else if (substr($PER->produk,0,3)=='ATP'||substr($PER->produk,0,3)=='DGI'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANSAKSI DPLK\" onclick=\"NewWindow('../polis/mutasi_atp.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } else if ($PER->produk=='JSTAMPAN'||$PER->produk=='JSTAMPANX'||$PER->produk=='JSMANTAP'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST TRANSAKSI\" onclick=\"NewWindow('../restru/pelayanan/historis_mutasi_transaksi.php?noper=%s&prefix=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$nopertanggungan,$prefixpertanggungan);
			 } 

		
			if ($user_view) {

				// printf("<input type=\"button\" name=\"tariftebus\" value=\"PESAN\" onclick=\"NewWindow('../customercare/pesan/entrypesan.php?nopolis=%s','popupmutasi','850','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan.$nopertanggungan);
			}

			printf("<input type=\"button\" name=\"tariftebus\" value=\"INFO REK\" onclick=\"NewWindow('../klaim/updaterekening.php?nopolis=%s','popupmutasi','760','350','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan.$nopertanggungan);

			if ($user_cc) {
				
				
				printf("<input type=\"button\" name=\"tariftebus\" value=\"LAYANAN\" onclick=\"NewWindow('../customercare/layanan/entrylayanan.php?nopolis=%s','popupmutasi','850','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan.$nopertanggungan);
			}

			printf("<input type=\"button\" name=\"tariftebus\" value=\"HIST KUNJ\" onclick=\"NewWindow('../customercare/historis_layanan_kunjungan.php?nopolis=%s','popupmutasi','850','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan.$nopertanggungan);
		
			 
		?>
		<? $polisbaru_smart="$prefixpertanggungan-$nopertanggungan"; printf("<input type=\"button\" name=\"docpolis\" value=\"DOKUMEN\" onclick=\"NewWindow('https://sae-aws.ifg-life.id/smart_ifglife/list.php?no_polis1=".base64_encode(base64_encode($polisbaru_smart))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">"); ?>");
			}
			echo "&nbsp";
			
			printf("<input type=\"button\" name=\"docList\" value=\"DOKUMEN PERNYATAAN\" onclick=\"NewWindow('documentpernyataan.php?no_polis=".base64_encode(base64_encode(@$PER->nopolbaru ? $PER->nopolbaru : $PER->nopol))."&nopertanggungan=".base64_encode(base64_encode($nopertanggungan))."&prefix=".base64_encode(base64_encode($prefixpertanggungan))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">");	
			printf("<input type=\"button\" name=\"docpolis\" value=\"WELCOMING CALL\" onclick=\"NewWindow('welcomingcall.php?no_polis=".base64_encode(base64_encode(@$PER->nopolbaru ? $PER->nopolbaru : $PER->nopol))."&nopertanggungan=".base64_encode(base64_encode($nopertanggungan))."&prefix=".base64_encode(base64_encode($prefixpertanggungan))."','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">");			
		?>
		<? /*printf("<input type=\"button\" name=\"docpolis\" value=\"DOK. KLAIM HO\" onclick=\"NewWindow('popupdok.php?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan','popupkomisi','700','400','yes');return false\" style=\"font-size: 8pt\">");*/ ?>
		<? printf("<input type=\"button\" name=\"histduplikat\" value=\"HIST CETAK POLIS\" onclick=\"NewWindow('hist_duplikat.php?pref=%s&noper=%s','name','600','300','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan); ?>
		<?
		if ($PER->produk=='JSSPB1' || $PER->produk=='JSSPAB1'){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"BENEFIT BULANAN\" onclick=\"NewWindow('showbenefitbln.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); 
			 }
		
		if ($PER->produk=="JSPS"||$PER->produk=="SC5S"||$PER->produk=="SC6S"||$PER->produk=="ST5S"||$PER->produk=="ST6S"||$PER->produk=="JSPSN"){
			 		printf("<input type=\"button\" name=\"tariftebus\" value=\"TRANS. SAVING\" onclick=\"NewWindow('showbenefitsaving.php?prefixpertanggungan=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); 
			 }
		
		
        printf("<input type=\"button\" name=\"histuw\" value=\"HIST UW\" onclick=\"NewWindow('showhistunderwriting.php?prefixpertanggungan=%s&nopertanggungan=%s','popupbenefit',1200,400,1);\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan);
        echo "&nbsp";
        printf("<input type=\"button\" name=\"histpem\" value=\"HIST PEMULIHAN\" onclick=\"NewWindow('showhistpulih.php?prefixpertanggungan=%s&nopertanggungan=%s','popupbenefit',1200,400,1);\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan);
		
		/*$sql = "SELECT b.kdmsip, b.kduniqgrup
				FROM $DBUser.tabel_900_klaim_pusat a
				INNER JOIN tabel_802_lampiran_sip_klaim@esip b ON a.prefixpertanggungan = b.prefixpertanggungan
					AND a.nopertanggungan = b.nopertanggungan
					AND a.nomorsip = b.nomorsip
					AND a.kduniqgrup || a.prefixpertanggungan || a.nopertanggungan = b.kduniqgrup
				INNER JOIN tabel_802_sip_installment@esip c ON b.kdmsip = c.kdmsip_orig
				WHERE a.status != 3
					AND a.prefixpertanggungan = '$prefixpertanggungan'
					AND a.nopertanggungan = '$nopertanggungan'
				GROUP BY b.kdmsip, b.kduniqgrup";
		$DB->parse($sql);
		$DB->execute();
		$arrcil=$DB->nextrow();
		printf(" <input type='button' name='histcicil' value='HIST CICIL' style='font-size:8pt;' onclick=\"NewWindow('http://efinance.ifg-life.co.id:8003/historis-bayar-cicilan.php?id=$arrcil[KDMSIP]&id2=$arrcil[KDUNIQGRUP]','popupbenefit',1200,400,1)\" />");*/
		
		printf("&nbsp;<input type=\"button\" name=\"histuw\" value=\"HIST KLAIM\" onclick=\"NewWindow('../klaim/historisklaim.php?prefix=%s&noper=%s','popupbenefit',1300,400,1);\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan);
		printf("&nbsp;<input type=\"button\" name=\"histuw\" value=\"HIST PENGKINIAN\" onclick=\"NewWindow('../polis/historispengkinian.php?prefix=%s&noper=%s','popupbenefit',1300,400,1);\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan);
		printf("&nbsp;<input type=\"button\" name=\"histuw\" value=\"HIST ISSUE\" onclick=\"NewWindow('../restru/issue_polis/log_issue_polis.php?prefix=%s&noper=%s','popupbenefit',1300,400,1);\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan);
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
	if($PER->kdvaluta=="3"){
		$sql="select tglkursberlaku,kurs from  TABEL_999_KURS_TRANSAKSI  where ".
		     "tglkursberlaku=(select max(tglkursberlaku) from  TABEL_999_KURS_TRANSAKSI  where kdvaluta='3')";
		$DB->parse($sql);
		$DB->execute();
		$arrkurs=$DB->nextrow();
		$kursberlaku=$arrkurs["KURS"];
		$preminya=$PER->premi1 * $kursberlaku;
	}else{
		$preminya=$PER->premi1;
	}
	if (((($PER->kdcarabayar=="1" || $PER->kdcarabayar=="2" ||  $PER->kdcarabayar=="3" ||  $PER->kdcarabayar=="4" ||  $PER->kdcarabayar=="A" ||  $PER->kdcarabayar=="B" || $PER->kdcarabayar=="H" || $PER->kdcarabayar=="M" || $PER->kdcarabayar=="Q") || $preminya>150000) && $PER->kdstatusfile=='1') ||((($PER->kdcarabayar=="X" || $PER->kdcarabayar=="J" || $PER->kdcarabayar=="E") || $preminya>50000000) && $PER->kdstatusfile=='1')){
		?>
		<!--input type="button" class="buton" name="cetakpenawaranproduk"  value="PENAWARAN PRODUK" onClick="NewWindow('../polis/cetakpenawaranproduk.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)"-->
		
				<?
		}
?>
 <br>
	<fieldset style="color: #4b889e; border:1 solid #9cc6dc; padding:5; font: 1.1em Verdana, sans-serif; width:650;"> 
  <legend class="verdana9blu"><b>Cetak</b></legend>
	<? printf("<input type=\"button\" name=\"tariftebus\" value=\"CETAKAN POLIS\" onclick=\"NewWindow('../pelaporan/show_polis.php?prefix=%s&nopertanggungan=%s&kdproduk=%s','popuptebus','760','400','yes');return false\" style=\"font-size: 8pt\">",$prefixpertanggungan,$nopertanggungan,$kdproduk); ?>
  	<!--<input type="button" class="buton" name="cetakbk" value="BERITA KEPUTUSAN" onclick="NewWindow('../polis/cetakanbk.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">-->
	<?php
	if ($kantor=='KN'){
	?>	
		<input type="button" class="buton" name="cetakutk" value="UCAPAN TERIMA KASIH" onClick="NewWindow('../polis/ucapan_terimakasih_kn.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
  	<?php
	} else {
	?>	
		<input type="button" class="buton" name="cetakutk" value="UCAPAN TERIMA KASIH" onClick="NewWindow('../polis/ucapan_terimakasih.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
	<?php
	}
	?>	
	<!--<input type="button" class="buton" name="cetaktt" value="TANDA TERIMA" onclick="NewWindow('../polis/tanda_terima.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">-->
    <?
    // Jika produk adalah JL4 dan mengambil rider Hospital Care
    $sqlhc = "SELECT count(kdbenefit) ada 
              FROM $DBUser.tabel_223_transaksi_produk 
              WHERE prefixpertanggungan = '$prefixpertanggungan' AND nopertanggungan = '$nopertanggungan'
                  AND kdbenefit IN ('JSHCA','JSHCB', 'JSHCC', 'JSHCD','JSHCE')";
    $DB->parse($sqlhc);
    $DB->execute();
    $arrhc = $DB->nextrow();
    if (substr($PER->produk,0,3)=='JL4' && $arrhc['ADA'] >= 1) {
        echo "<input type='button' class='buton' name='cetakklausul'  value='KLAUSULA' onClick=\"NewWindow('../polis/cetakklausula.php?prefixpertanggungan=$prefixpertanggungan&nopertanggungan=$nopertanggungan','',650,500,1)\">";
    }


		if (substr($PER->produk,0,3)=='JL2'||substr($PER->produk,0,3)=='JL3'){
			 		echo "<input type=\"button\"  class=\"buton\" name=\"tariftebus\" value=\"INFO CARA BAYAR\" onclick=\"NewWindow('../polis/info_virtual.php?noper=$nopertanggungan&prefix=$prefixpertanggungan','popupmutasi','950','350','yes');return false\" style='font-size: 8pt'>";
					};
					
		//===============KLAUSUL CASH PLAN
		$sqlcp = "select COUNT(*) ADA from $DBUser.tabel_223_transaksi_produk where  
                      substr(kdbenefit,1,3) in ('CPB','CPM','TER','CI','CI5','PA','CAC','WAI','JMN','BNF','TI')
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
		<!--input type="button" class="buton" name="cetakketentuan" value="KETENTUAN KHUSUS" onClick="NewWindow('../polis/<?=$ketkus;?>?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)"-->
		<input type="button" class="buton" name="cetakkpenawaran"  value="PENAWARAN" onClick="NewWindow('../polis/cetakpenawaran.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',750,500,1)">
				<input type="button" class="buton" name="cetakrollover"  value="SETUJU ROLLOVER" onClick="NewWindow('../polis/cetaksetujurollover.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',750,500,1)">
  	<?
		}
		elseif ($PER->produk=="JSSP6" || $PER->produk=="JSSPA6" || $PER->produk=="JSSP5"){
		?>
		<input type="button" class="buton" name="cetakklausul"  value="KLAUSULA" onClick="NewWindow('../polis/cetakklausula.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)">
		<!--input type="button" class="buton" name="cetakketentuan" value="KETENTUAN KHUSUS" onClick="NewWindow('../polis/cetakketentuansp6.php?prefixpertanggungan=<?echo $prefixpertanggungan;?>&nopertanggungan=<?echo $nopertanggungan;?>','',650,500,1)"-->
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

		if ($user_covernote) {
			/* Menu untuk cetak Dokumen Lampiran Polis Migrasi - Teguh 14/01/2022 */		
			$sql_migrasi = "SELECT COUNT(*) ADA 
					FROM $DBUser.TABLE_201_POLIS_RESTRU_REKAP   
					WHERE prefixpertanggungan='$prefixpertanggungan' 
						AND nopertanggungan='$nopertanggungan'";
			//echo $sql_migrasi;
			$DB->parse($sql_migrasi);
			$DB->execute();
			$arr_migrasi = $DB->nextrow();
			if ($arr_migrasi["ADA"]>=1){
				echo "<input type=\"button\" class=\"buton\" name=\"cetakcovernote\" value=\"LAMPIRAN POLIS (MIGRASI)\" onClick=\"NewWindow('../restru/covernote/cetak_covernotepolis.php?prefix=".$prefixpertanggungan."&noper=".$nopertanggungan."','',650,500,1)\">";
			}
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
