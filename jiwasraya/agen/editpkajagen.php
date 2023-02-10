<?php
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  $DB = new database($userid, $passwd, $DBName);
  $DB2 = new database($DBUser, $DBPass, $DBName);
  $DB3 = new database($DBUser, $DBPass, $DBName);
  $conn = ocilogon($DBUser, $DBPass, $DBName);
  $conn1 = ocilogon($DBUser, $DBPass, $DBName);
  $conn2 = ocilogon($DBUser, $DBPass, $DBName);
?>
<html>
<head>
<title>PKAJ AGEN</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<font face="Verdana" size="2"><b>PKAJ AGEN</b></font>
<hr size="1">
<div align="center"><br>
<?
	if ($submit=="SUBMIT") {  
		 $sqlno="select max(nopkajagen) nopkajagen from $DBUser.tabel_400_pkaj_agen WHERE kdkantor = '$kantor'";
		 $DB->parse($sqlno);
		 $DB->execute();
		 $rowno=$DB->nextrow();
		 $nomer= $rowno["NOPKAJAGEN"]+1;
         $nomerx= $rowno["NOPKAJAGEN"];
		 
		 $sqlinsert="insert into $DBUser.HISTORY_LOG_PKAJ (ACTIVITY, USR, ID_USER, DOCUMENT_NO, DOCUMENT_TYPE, DATETIME, REMARK, STATUS)
		 VALUES ('CREATED DOCUMENT ePKAJ','$namusr','$noidagen',$nomer,'PDF',localtimestamp,'TESTINGxx','Created')";
		 $insertlogdoc= ociparse($conn, $sqlinsert);
		 ociexecute($insertlogdoc);
		 //$rowno=$DB->nextrow();

		 $sql ="SELECT TO_CHAR(a.tglpkajagen,'yyyy') tahunpkaj, b.kdjabatanagen kdjabatanagenlama
				FROM $DBUser.tabel_400_pkaj_agen a
				INNER JOIN $DBUser.tabel_417_histori_jabatan b ON a.noagen = b.noagen
					AND a.nopkajagen = b.nopkajagen
				WHERE a.kdkantor = '$kantor'
					AND a.noagen = '$noagn'
					AND tglpkajagen = (SELECT MAX(tglpkajagen) FROM $DBUser.tabel_400_pkaj_agen WHERE kdkantor = a.kdkantor AND noagen = a.noagen)";
		 $DB->parse($sql);
		 $DB->execute();
		 $rowthn=$DB->nextrow();
		 //echo $sqlthn;
		 //$nomer= $rowthn["NOPKAJAGEN"];
		 
		 if($rowthn["TAHUNPKAJ"]==substr($tglpkaj,6,4) && $rowthn['KDJABATANAGENLAMA'] != '17'){
		 echo "Sudah Ada...";
		 }
		 else {					 
		 $sql="insert into $DBUser.TABEL_400_PKAJ_AGEN (KDKANTOR,PREFIXAGEN ,  NOAGEN,  NOMORIDAGEN,  ALAMATAGEN,  ".
		 "NOTELPONAGEN,  NOPKAJAGEN, TGLPKAJAGEN,  TGLREKAM,  USERREKAM,  TGLUPDATED,  USERUPDATED,  ".
		 "SAKSI1,  JABATANSAKSI1, SAKSI2,  JABATANSAKSI2,NOAGENBM,NAMABM,JABATANBM,NIPBM,ALAMATKTR,TELPONKTR,FAXKTR,STATUS)".
		 "values('$kantor','$pfxagn','$noagn','$noidagen',  '$alamatagen',  '$telpagen',  NO_PKAJ_AGEN.NEXTVAL, ". 
		 "to_date('$tglpkaj','DD/MM/YYYY'), SYSDATE,  user,  SYSDATE,  user,  '$kasilog',  '$jablog',  ".
		 "'$kasiops',  '$jabops','$noagenbm','$namabm','$jabatanbm','$nipbm','$alamatktr','$phonektr','$faxktr','0')";
		//var_dump($DB);
		// echo $sql; die;
		//$DB->parse($sql);
		 $insertpkaj= ociparse($conn, $sql);
		 ociexecute($insertpkaj);
  }
	  
	if($DB->execute()){
	 $DB->commit();
	 //echo $sql;
	 $sqlupdate="update $DBUser.tabel_100_klien set NOID='$noidagen', ALAMATTETAP01='$alamatagen', TEMPATLAHIR='$tempatlhr', ".
	 "TGLLAHIR=to_date('$tglagen','DD/MM/YYYY'), PHONETETAP01='$telpagen' WHERE noklien = '$noagn'";
	 //ECHO $sqlupdate;
	 $DB->parse($sqlupdate);
     $DB->execute();
	 //echo substr($tglpkaj,6,4);	
	 //echo $rowthn["TAHUNPKAJ"];
	 echo "<br><font face=\"Verdana\" size=\"2\">Update Sukses ... <br><br></font>";
	 $noagen=$noagn;
	} else {
	 echo "<font face=\"Verdana\" size=\"2\" color=red><b>Update Gagal !<br>error code : $DB->errorcode<br>error message : $DB->errormessage<br>error string : $DB->errorstring</b></font><br><br>";
		$noagen=$noagn;
		//echo $sql;
	}
	} 
	
	$qry= "select namaklien1, tempatlahir, ALAMATTETAP01, NOID,PHONETETAP01,".
	"to_char(tgllahir,'DD/MM/YYYY') tgllahir,".
	"(SELECT ALAMAT02 FROM $DBUser.tabel_001_kantor WHERE kdkantor = '$kantor') AS kota,".
	"(SELECT ALAMAT01||' '||PROPINSI||' - '||KODEPOS FROM $DBUser.tabel_001_kantor WHERE kdkantor = '$kantor') AS alamatktr,".
	"(SELECT phone01 FROM $DBUser.tabel_001_kantor WHERE kdkantor = '$kantor') AS phonektr,".
	"(SELECT phone02 FROM $DBUser.tabel_001_kantor WHERE kdkantor = '$kantor') AS faxktr,".
	"(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '110') AS kabagops,".
	"(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '161') AS kasiops,".
	"(SELECT namajabatan FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '161') AS jabatankasiops,".
	"(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '130') AS kabagadlog, ".
	"(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '163') AS kasiadlog, ".
    "(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '160') AS wakapus, ".
	"(SELECT MAX(noagen) from $DBUser.tabel_400_agen where KDKANTOR='$kantor' AND KDSTATUSAGEN='01' AND 
KDJABATANAGEN='06') AS noagenbm,".
	"(SELECT MAX(noagen) from $DBUser.tabel_400_agen where KDKANTOR='$kantor' AND KDSTATUSAGEN='01') AS noagen,".
     "(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '100') AS regman,  ".
	 "(SELECT namapejabat FROM $DBUser.tabel_002_pejabat WHERE kdkantor = '$kantor' AND kdorganisasi = '160') AS branchman  ".
	" from $DBUser.tabel_100_klien where noklien='$noagen'";
	// echo $qry;
	$DB->parse($qry);
	$DB->execute();
	$ass=$DB->nextrow();
	$namaagen=$ass["NAMAKLIEN1"];
	$tgllhr=$ass["TGLLAHIR"];
	$kota=$ass["KOTA"];
	$telp=$ass["PHONETETAP01"];
	
    $sql= "select to_char(sysdate,'DD/MM/YYYY') tglnow,noagen,prefixagen,kdpangkat,kdkelasagen,kdjenjangagen,nolisensiagen, (case when tglakhirlisensi < sysdate then 1 else 0 end) as statusexpiredlisensi,".
		  "(SELECT TRIM(regexp_replace(initcap(namajabatanagen), '([[:lower:]]| )')) FROM $DBUser.TABEL_413_JABATAN_AGEN WHERE kdjabatanagen=a.kdjabatanagen) nmjabatan, ".
		  "kdstatusagen,kdjabatanagen, (SELECT NAMAJABATANAGEN FROM $DBUser.TABEL_413_JABATAN_AGEN WHERE kdjabatanagen=a.kdjabatanagen) NAMAJABATANAGEN, NVL(statusorganik,0) statusorganik, ".
	      "kdareaoffice,kdunitproduksi,noskagen,to_char(tglskagen,'DD/MM/YYYY') tglskagen,norekening,namabank,tglrekam,userrekam, ".
		  "kddistribusi,npwp,nodplk,tglupdated,userupdated,kdkantor,bankcabang,NOLISENSIAGEN from $DBUser.tabel_400_agen a where noagen='$noagen' ";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arc=$DB->nextrow();

	$query ="SELECT * from tabel_400_penandatanganan_pkaj where kode_kantor = '".$arc["KDKANTOR"]."' and jabatan_agen = '".$arc["KDJABATANAGEN"]."'";
	//echo $query;
  	$penandatangan= ociparse($conn, $query);
 	ociexecute($penandatangan);
  	ocifetch($penandatangan); 
	//print_r($arc);
//echo $kantor;

?>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<table border="0" width="750" bgcolor="#C0C0C0" cellspacing="1" cellpadding="1">
<form method="POST" name="agen" action="editpkajagen.php">
<input type="hidden" name="noagn" size="8" value="<? echo $arc["NOAGEN"]; ?>">
<input type="hidden" name="pfxagn" size="8" value="<? echo $arc["PREFIXAGEN"]; ?>">
  <tr>
    <td width="100%" bgcolor="#4955BE">&nbsp;<font face="Arial" color="#FFFFFF"><b>AGEN : <? echo $namaagen; ?></b></font></td>
  </tr>
   <tr>
    <td width="100%" bgcolor="#FFFFFF">
      <table border="0" width="100%" cellspacing="2">
        <tr>
		   <td bgcolor="#D8E2FC"><font face="Arial" size="2">Tanggal PKAJ</font></td>
		   <td colspan="3" bgcolor="#D8E2FC"><input type="text" name="tglpkaj" size="8" value="<? echo $arc["TGLNOW"]; ?>"> <font face="Arial" size="2">DD/MM/YYYY</font> <span style="text-decoration:blink;color:#FF0000">(Tanggal ini adalah tanggal yang digunakan untuk penetapan PKAJ)</span></td>
		</tr>
		<tr>
			<td align="center" colspan="2" bgcolor="#4955BE"><font face="Arial" color="#FFFFFF">PERUSAHAAN</td>
			<td align="center" colspan="2" bgcolor="#4955BE"><font face="Arial" color="#FFFFFF">AGEN</td>
		</tr> 
		<tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Nama</font></td>
          <!-- <td bgcolor="#D8E2FC"><input type="text" name="namabm" size="25" value="<?=$arc["KDJABATANAGEN"]=="06"? "DE YONG ADRIAN": (substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ? $ass["REGMAN"]:$ass["KASIOPS"]);?>"></td> -->
          <td bgcolor="#D8E2FC"><input type="text" name="namabm" size="25" value="<? echo ociresult($penandatangan,"NAMA_TTD"); ?>" readonly></td>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Tgl. Lahir</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="tglagen" size="8" value="<? echo $tgllhr; ?>" readonly> <font face="Arial" size="2">DD/MM/YYYY</font></td>
        </tr>
		<tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">No. Agen</font></td>
          <td bgcolor="#D8E2FC"><!--input type="text" name="noagenbm" size="12" maxlength="10" value="<?=$arc["KDJABATANAGEN"]=="06"? "0": $ass["NOAGEN"];?>" readonly-->
				<input type="text" name="noagenbm" size="12" maxlength="10" value="" readonly placeholder="Kosongkan saja">
					<!--	<a href="#" onclick="window.open('popupclntagen.php','popuppage','scrollbars=yes,width=280,height=300,top=100,left=50')"><img src="../img/jswindow.gif" border="0" alt="cari daftar agen"></a> -->
					</td>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Tempat Lahir</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="tempatlhr" size="12"  value="<? echo $ass["TEMPATLAHIR"]; ?>" readonly></td>
        </tr>
        <tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">NIP</font></td>
         <!--  <td bgcolor="#D8E2FC"><input type="text" name="nipbm" size="12" maxlength="10" value="<?=$arc["KDJABATANAGEN"]=="06"? "18339932": "";?>" placeholder="Isi NIK"> -->
          <td bgcolor="#D8E2FC"><input type="text" name="nipbm" size="12" maxlength="10" value="<? echo ociresult($penandatangan,"NIK_TTD"); ?>" placeholder="Isi NIK" readonly>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Alamat</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="alamatagen" size="40" value="<? echo $ass["ALAMATTETAP01"]; ?>" readonly></td>
        </tr>
        <tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Jabatan</font></td>
          <!-- <td bgcolor="#D8E2FC"><input type="text" name="jabatanbm" size="20" value="<?=$arc["KDJABATANAGEN"]=="06"? "DIREKTUR PEMASARAN": ($kantor=="KM" || $kantor=="KN" ? "KEPALA PUSAT" : (substr($kantor,-1)=="A"? "KEPALA KANTOR WILAYAH":"$ass[JABATANKASIOPS]"));?>"></td> -->
          <td bgcolor="#D8E2FC"><input type="text" name="jabatanbm" size="20" value="<? echo ociresult($penandatangan,"JABATAN_TTD"); ?>" readonly></td>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Nomor ID</font></td>
          <!--<td bgcolor="#D8E2FC"><input type="text" name="namabank" size="20" value="<? //echo $arc["NAMABANK"]; ?>"></td>-->
		  <td bgcolor="#D8E2FC"><input type="text" name="noidagen" size="20" value="<? echo $ass["NOID"]; ?>" readonly></td>
        </tr>
        <tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Alamat Kantor</font></td>
         <!--  <td bgcolor="#D8E2FC"><input type="text" name="alamatktr" size="40" value="<?=$arc["KDJABATANAGEN"]=="06"? "JL. Ir. H. Juanda No. 34 Jakarta - 10120": $ass["ALAMATKTR"];?>"></td> -->
          <td bgcolor="#D8E2FC"><input type="text" name="alamatktr" size="40" value="<?= $ass["ALAMATKTR"] ?>" readonly></td>
					<td bgcolor="#D8E2FC"><font face="Arial" size="2">No. Telp.</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="telpagen" size="20" value="<? echo $ass["PHONETETAP01"]; ?>" readonly></td>
        </tr>
        <tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">No. Telp.</font></td>
         <!--  <td bgcolor="#D8E2FC"><input type="text" name="phonektr" size="30" value="<?=$arc["KDJABATANAGEN"]=="06"? "021-3845031": $ass["PHONEKTR"];?>"></td> -->
          <td bgcolor="#D8E2FC"><input type="text" name="phonektr" size="30" value="<?= $ass["PHONEKTR"] ?>" readonly></td>
		  <td bgcolor="#D8E2FC"><font face="Arial" size="2">No. Fax.</font></td>
          
          <td bgcolor="#D8E2FC"><font face="Arial" size="2"><input type="text" name="faxktr" size="30" value="<? echo $ass["FAXKTR"]; ?>" readonly></font></td>
        </tr>
				  
					<!--<tr><td bgcolor="#D8E2FC"><font face="Arial" size="2">Jabatan Lama</font></td>
		  <td bgcolor="#D8E2FC"><font face="Arial" size="2">
		  <input type="text" name="jablama" size="30" value="<? echo $arc["NAMAJABATANAGEN"]; ?>">
		  <input type="text" name="tgljablama" size="8" value="<? echo $ass["TGLSKAGEN"]; ?>"></font></td>
		  <td bgcolor="#D8E2FC"><font face="Arial" size="2">Jabatan Baru</font></td>
		  <td bgcolor="#D8E2FC"><font face="Arial" size="2">
		  <input type="text" name="jabbaru" size="30">
		  <input type="text" name="tgljabbaru" size="8"></font></td>
		  </font></td>
		</tr>-->
	<td bgcolor="#D8E2FC"><input type="hidden" name="kasilog" size="30" value="<?=$kantor=="KN" ? $ass['WAKAPUS'] : (substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ? $ass["KABAGADLOG"]:$ass["KASIADLOG"]); ?>"></td>
	<td bgcolor="#D8E2FC"><input type="hidden" name="kasiops" size="30" value="<?=substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ? $ass["KABAGOPS"]:$ass["WAKAPUS"]; ?>"></td>
	<td bgcolor="#D8E2FC"><input type="hidden" name="jablog" size="40" value="<?=$kantor=="KN" ? "WAKIL KEPALA PUSAT" : (substr($kantor,-1)=="A" || $kantor=="KM" ?  "KABAG ADM. & KEU.": "STAFF POLICY ADM, FINANCE & GENERAL AFFAIR"); ?>">
	<td bgcolor="#D8E2FC"><input type="hidden" name="jabops" size="40" value="<?=substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ?  "KABAG OPERASIONAL DAN PENJUALAN": "STAFF SALES SUPPORT"; ?>"></td>
	<!-- <tr>
			<td align="center" colspan="2" bgcolor="#4955BE"><font face="Arial" color="#FFFFFF">SAKSI I</td>
			<td align="center" colspan="2" bgcolor="#4955BE"><font face="Arial" color="#FFFFFF">SAKSI II</td>
		</tr> 
		 <tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Nama</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="kasilog" size="30" value="<?=$kantor=="KN" ? $ass['WAKAPUS'] : (substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ? $ass["KABAGADLOG"]:$ass["KASIADLOG"]); ?>"></td>
		   <td bgcolor="#D8E2FC"><font face="Arial" size="2">Nama</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="kasiops" size="30" value="<?=substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ? $ass["KABAGOPS"]:$ass["WAKAPUS"]; ?>"></td>
        </tr>
		 <tr>
          <td bgcolor="#D8E2FC"><font face="Arial" size="2">Jabatan</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="jablog" size="40" value="<?=$kantor=="KN" ? "WAKIL KEPALA PUSAT" : (substr($kantor,-1)=="A" || $kantor=="KM" ?  "KABAG ADM. & KEU.": "KASI KEUANGAN DAN UMUM"); ?>"></td>
          <td bgcolor="#D8E2FC"><input type="text" name="jablog" size="40" value="<?=$kantor=="KN" ? "WAKIL KEPALA PUSAT" : (substr($kantor,-1)=="A" || $kantor=="KM" ?  "KABAG ADM. & KEU.": "STAFF POLICY ADM, FINANCE & GENERAL AFFAIR"); ?>"></td>
		   <td bgcolor="#D8E2FC"><font face="Arial" size="2">Jabatan</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="jabops" size="40" value="<?=substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ?  "KABAG OPERASIONAL DAN PENJUALAN": "KASI OPERASIONAL DAN PENJUALAN"; ?>"></td>
          <td bgcolor="#D8E2FC"><input type="text" name="jabops" size="40" value="<?=substr($kantor,-1)=="A" || $kantor=="KM" || $kantor=="KN" ?  "KABAG OPERASIONAL DAN PENJUALAN": "STAFF SALES SUPPORT"; ?>"></td>
        </tr> -->
</table>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#E5E5E5" align="center">
    	<? // cek ANP berkala minimal 6 juta
    		$sql = " SELECT  NVL(SUM(
                                        CASE 
                                            WHEN B.KDCARABAYAR IN ('1','M') THEN premi1 * 12
                                            WHEN B.KDCARABAYAR IN ('2','Q') THEN premi1 * 4
                                            WHEN B.KDCARABAYAR IN ('3','H') THEN premi1 * 2
                                            ELSE premi1
                                        END
                                    ),0) AS PREMI,
                    	   COUNT(B.NOPERTANGGUNGAN) AS TOTPOLIS
                    FROM $DBUser.TABEL_400_AGEN A, $DBUser.TABEL_200_PERTANGGUNGAN B
                    WHERE A.NOAGEN = '$noagen'
                          AND B.NOAGEN = A.NOAGEN
                          --AND TO_CHAR (B.MULAS, 'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                          AND A.KDSTATUSAGEN = '01'
                          AND B.KDSTATUSFILE NOT IN ('7') and B.KDPERTANGGUNGAN ='2'
                          --AND B.KDCARABAYAR NOT IN ('X','E','J')
                          AND A.NOLISENSIAGEN IS NOT NULL
    			   ";
    		$DB3->parse($sql);
			$DB3->execute();
			$anp=$DB3->nextrow();

			if($arc["KDJABATANAGEN"] == '09' && (empty($arc["NOLISENSIAGEN"]) || $arc["STATUSEXPIREDLISENSI"] == 1) ){
		?>
				<input type="submit" value="SUBMIT" name="submit" disabled> <br>
				<!-- <font color="red"> Maaf tidak bisa melakukan submit PKAJ karena total ANP produksi agen tidak mencapai target. <br> (ANP agen = <?echo number_format(str_replace(',','.',$anp["PREMI"]), 0,",",".");?>) </font> -->
				<font color="red"> Maaf tidak bisa melakukan submit PKAJ karena agen belum memiliki lisensi/lisensi expired. </font>
		<?
			}else{
    	?>
		  <input type="submit" value="SUBMIT" name="submit"> <br>
		  <font color="black"> Produksi polis = <?=$anp["TOTPOLIS"]?> dan lisensi agen <? if(empty($arc["NOLISENSIAGEN"])){ echo "tidak ada";}else{ echo "ada";} ?>. </font>
		<? } ?>
		  <? //echo "<input type=\"button\" name=\"tariftebus\" value=\"CETAK KARTU\" onclick=\"NewWindow('konfirmgelar.php?noagen=$noagen','cetak','690','280','yes');return true;\">"; ?>
		  <input type="hidden" name="mode" value="update">
		</td>
  </tr>
</table></br>
<?php if ($arc['KDJABATANAGEN'] == '09') { ?>
<input type="button" value="CETAK SP<?=$arc['NMJABATAN']?>" name="ctkspcma" onClick="window.open('<?="../agen/cetak_spcma.php?noagen=$noagen"?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
</br></br>
<?php } ?>

<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="650" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" colspan="9" align="center">HISTORIS PKAJ</td>
  </tr>
  <tr>
    <td rowspan="2" bgcolor="#89acd8" align="center">NO. AGEN</td>
    <td rowspan="2" bgcolor="#89acd8" align="center">TGL. PKAJ</td>
	<td colspan="7" bgcolor="#89acd8" align="center">CETAK</td>
  </tr>
   <tr>
	<td bgcolor="#89acd8" align="center">PKAJ</td>
	<td bgcolor="#89acd8" align="center">SPA</td>
	<td bgcolor="#89acd8" align="center">Kode Etik</td>
    <td bgcolor="#89acd8" align="center">PI</td>
    <td bgcolor="#89acd8" align="center">SKK</td>
	<td bgcolor="#89acd8" align="center">STATUS</td>
	<td bgcolor="#89acd8" align="center">AUDIT TRAIL EPKAJ</td>
  </tr>
<?
// $sqlpkaj="SELECT a.noagen, a.nopkajagen, TO_CHAR(a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
//               TO_CHAR(tglpkajagen, 'mmyyyy') tglpkaj, a.kdkantor, b.kdjabatanagen
//           FROM $DBUser.tabel_400_pkaj_agen a
//           LEFT OUTER JOIN $DBUser.tabel_417_histori_jabatan b ON a.nopkajagen = b.nopkajagen
//               AND (b.noagen, b.nopkajagen, b.tglpenetapan) IN ( 
//                   SELECT noagen, nopkajagen, MAX(tglpenetapan)
//                   FROM $DBUser.tabel_417_histori_jabatan
//                   WHERE noagen = '$noagen'
//                   GROUP BY noagen, nopkajagen
//               )
//           WHERE a.noagen = '$noagen'";

$sqlpkaj = "SELECT  a.NOAGEN,
                    a.NOPKAJAGEN,
                    TO_CHAR (a.TGLPKAJAGEN, 'dd/mm/yyyy') AS TGLPKAJAGEN,
                    TO_CHAR (a.TGLPKAJAGEN, 'mmyyyy') AS TGLPKAJ,
                    TO_CHAR (a.TGLPKAJAGEN, 'yyyy') AS THNPKAJ,
                    a.KDKANTOR,
                   (select KDJABATANAGEN FROM $DBUser.tabel_400_agen where noagen = a.noagen ) KDJABATANAGEN,
					CASE a.STATUS WHEN '0' THEN 'PENDING' WHEN '1' THEN 'DONE' END STATUS,
					case
						WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') >= TO_DATE('18042022','DDMMYYYY') THEN 1
						WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') < TO_DATE('18042022','DDMMYYYY') THEN 2
					end periode,
					case 
						when to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from $DBUser.tabel_400_pkaj_agen where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') >= TO_DATE('18042022','DDMMYYYY') THEN 1
						wHEN to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from $DBUser.tabel_400_pkaj_agen where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') < TO_DATE('18042022','DDMMYYYY') THEN 2
					END	TGLSUBMIT,
					a.USERREKAM
                    FROM         $DBUser.tabel_400_pkaj_agen a
                    LEFT OUTER JOIN $DBUser.tabel_417_histori_jabatan b ON a.NOPKAJAGEN = b.NOPKAJAGEN
                        AND (b.NOAGEN, b.NOPKAJAGEN, b.TGLPENETAPAN) IN
                                (  SELECT   NOAGEN, NOPKAJAGEN, MAX (TGLJABATAN)
                                        FROM   $DBUser.tabel_417_histori_jabatan
                                    WHERE   NOAGEN = '$noagen'
                                    GROUP BY   NOAGEN, NOPKAJAGEN)
                    WHERE   a.NOAGEN = '$noagen'
			ORDER BY a.tglpkajagen DESC";
//echo $sqlpkaj;
$DB2->parse($sqlpkaj);
$DB2->execute();
// echo $sqlpkaj;
// var_dump($DB2);
$i = 1;
    $kodeJabatanAgen=array('32','33','34','35','36','37','38');
    while ($arx=$DB2->nextrow()) {

		if($arx['TGLSUBMIT'] == '1' || $arx['PERIODE'] == '1') {
			if ($arx['USERREKAM'] == 'MIGRASI' || $arx['KDJABATANAGEN'] == '26') {
				$urlpkaj = "cetak_epkaj_migrasi_2022.php";
				$kantorpkaj = "KP";
				$pkaj = "PKAJ";			
			} else if ($arx['KDJABATANAGEN'] == '29') {
				$urlpkaj = "cetak_epkaj_lpa.php";
				$kantorpkaj = "LPA";
				$pkaj = "IFGL";	
			} else if ($arx['KDJABATANAGEN'] == '31') {
				$urlpkaj = "cetak_epkaj_ws2023.php";
				$kantorpkaj = "WST";
				$pkaj = "IFGL";	
			} else if (in_array($arx['KDJABATANAGEN'], $kodeJabatanAgen)) {
                $urlpkaj = "cetak_epkaj_bas2023.php";
				$kantorpkaj = "BAS";
				$pkaj = "IFGL";	
            } else {
				$urlpkaj = "cetak_epkaj_2022.php";
				$kantorpkaj = "KP";
				$pkaj = "PKAJ";
			}
		} else {
			if ($arx['USERREKAM'] == 'MIGRASI' || $arx['KDJABATANAGEN'] == '26') {
				$urlpkaj = "cetak_epkaj_migrasi.php";
				$kantorpkaj = "KP";
				$pkaj = "PKAJ";			
			} else if ($arx['KDJABATANAGEN'] == '29') {
				$urlpkaj = "cetak_epkaj_lpa.php";
				$kantorpkaj = "LPA";
				$pkaj = "IFGL";	
			} else if ($arx['KDJABATANAGEN'] == '31') {
				$urlpkaj = "cetak_epkaj_ws2023.php";
				$kantorpkaj = "WST";
				$pkaj = "IFGL";	
			} else if (in_array($arx['KDJABATANAGEN'], $kodeJabatanAgen)) {
                $urlpkaj = "cetak_epkaj_bas2023.php";
				$kantorpkaj = "BAS";
				$pkaj = "IFGL";	
            } else {
				$urlpkaj = "cetak_epkaj.php";
				$kantorpkaj = "KP";
				$pkaj = "PKAJ";
			}
		}
			
			
			/*if ($arx['USERREKAM'] == 'MIGRASI' || $arx['KDJABATANAGEN'] == '26') {
				$urlpkaj = "cetak_epkaj_migrasi_2022.php";
				$kantorpkaj = "KP";
				$pkaj = "PKAJ";			
			} else if ($arx['KDJABATANAGEN'] == '29') {
				$urlpkaj = "cetak_epkaj_lpa.php";
				$kantorpkaj = "LPA";
				$pkaj = "IFGL";	
			}else{
				if($arx['TGLSUBMIT'] == '1' || $arx['PERIODE'] == '1'){
					$urlpkaj = "cetak_epkaj_2022.php";
				}
				else
				{
					$urlpkaj = "cetak_epkaj.php";
				}
				$kantorpkaj = "KP";
				$pkaj = "PKAJ";
			}*/

        // echo $arx["KDJABATANAGEN"];
        echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
        ?>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
		        <font face="Arial" size="2"><?=$arx["NOAGEN"];?></font>
            </td>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <font face="Arial" size="2"><?=$arx["TGLPKAJAGEN"];?></font>
            </td>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <a href="#" onClick="window.open('../agen/<?=$urlpkaj;?>?noagen=<?=$arx["NOAGEN"];?>&tglcari=<?=$titletglcari;?>&namaagen=<?=$arx["NAMAAGEN"];?>&tglpkaj=<?=$arx["TGLPKAJAGEN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
					<font face="Arial" size="2"><?=$arx["NOPKAJAGEN"].'/'.$pkaj.'-'.$kantorpkaj.'-'.$arx["TGLPKAJ"]?></font>
				</a>
            </td>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <a href="#" onClick="window.open('../agen/penetapan_agnlist.php?nopkaj=<?=$arx["NOPKAJAGEN"];?>&noagen=<?=$arx["NOAGEN"];?>&kt=<?=$kota;?>&namaagn=<?=$namaagen;?>&tglpkaj=<?=$arx["TGLPKAJAGEN"];?>','','width=400,height=400,top=100,left=100,scrollbars=yes');">
                    <font face="Arial" size="2">Lamp.1</font>
                </a>
            </td>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <!--a href="#" onClick="window.open('../agen/cetak_pkaj_lamp2.php?nopkaj=<?=$arx["NOPKAJAGEN"].'/PKAJ-'.$arx["KDKANTOR"].'-'.$arx["TGLPKAJ"];?>&noagen=<?=$arx["NOAGEN"];?>&kt=<?=$kota;?>&namaagn=<?=$namaagen;?>&tglpkaj=<?=$arx["TGLPKAJAGEN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');"-->
                <a href="#" onClick="window.open('../agen/dokumen/kodeetik.pdf','','width=800,height=600,top=100,left=100,scrollbars=yes');">
                    <font face="Arial" size="2">Lamp.2</font>
                </a>
            </td>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <a href="#" onClick="window.open('../agen/cetak_pakta_integritas.php?nama=<?=base64_encode($namaagen)?>&noagen=<?=$arx["NOAGEN"];?>&tglpkaj=<?=$arx["TGLPKAJAGEN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
                    <font face="Arial" size="2">Lamp.3</font>
                </a>
            </td>
            <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <a href="#" onClick="window.open('../agen/cetak_surat_keterangan_kerja.php?no=<?=base64_encode($noagen)?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
                    <font face="Arial" size="2">Lamp.4</font>
                </a>
            </td>
			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
                <a href="#" onClick="window.open('../agen/cetak_surat_keterangan_kerja.php?no=<?=base64_encode($noagen)?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
                    <font face="Arial" size="2"><?=$arx["STATUS"];?></font>
                </a>
            </td>
			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
				<form action="<?=$PHP_SELF;?>" method="post">    
					<input type="hidden" name="no_pkaj" value="<?=$arx["NOPKAJAGEN"];?>">
					<input type="hidden" name="noagen" value="<?=$noagen;?>">
					<input type="submit" name="submit" value="View">
				</form>
            </td>
        <?
        echo "</tr>";
	    $i++;
    }
?>
</table>
<br/>
<table border="1" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="650" id="AutoNumber1">
  <tr>
    <td bgcolor="#ff9999" colspan="6" align="center">HISTORIS PENGAJUAN SPA DITOLAK</td>
  </tr>
  <tr>
  	<td bgcolor="#e6e6ff" align="center">NO</td>
    <td bgcolor="#e6e6ff" align="center">NO. AGEN</td>
    <td bgcolor="#e6e6ff" align="center">TGL. PENETAPAN</td>
    <td bgcolor="#e6e6ff" align="center">JENIS MUTASI</td>
	<td bgcolor="#e6e6ff" align="center">ALASAN PENOLAKAN</td>
	<td bgcolor="#e6e6ff" align="center">STATUS</td>
  </tr>
  <?
	$no = "?no=" . $nomerx;
  	$sql = " SELECT * FROM $DBUser.TABEL_417_HISTORI_JABATAN WHERE NOAGEN = '$noagen' AND STATUS_APPROVAL = '3'
  			";
  	$listdecline=ociparse($conn, $sql);
    ociexecute($listdecline);
    $i=1;
    while (($row = oci_fetch_array($listdecline, OCI_BOTH)) != false) {
  ?>
  		<tr>
  			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><font face="Arial" size="2"><?=$i;?></font></td>
  			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><font face="Arial" size="2"><?=$row["NOAGEN"];?></font></td>
  			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><font face="Arial" size="2"><?=$row["TGLJABATAN"];?></font></td>
  			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><font face="Arial" size="2"><?=$row["URAIAN"];?></font></td>
  			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><font face="Arial" size="2"><?=ucwords(strtolower($row["ALASAN_PENOLAKAN_SPA"]));?></font></td>
  			<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><font face="Arial" size="2">SPA TIDAK DISETUJUI</font></td>
  		</tr>
  <?
	$i++;}
	
	$noPkajquery = "and DOCUMENT_NO = ''";
	if (!empty($_POST['no_pkaj'])) {
		$no_pkaj = $_POST['no_pkaj'];
		$noPkajquery = "and DOCUMENT_NO = " . "'$no_pkaj'";
	}
  ?>
</table>

</br>
	<?
	// DOCUMENT CREATED
	$createdForHeader = "SELECT *
	FROM ( select a.*, TO_CHAR(DATETIME, 'YYYY-MM-DD HH24:mi') AS DATEFORMAT, max(DATETIME) over () as max_created
			 from $DBUser.HISTORY_LOG_PKAJ a WHERE LOWER(ACTIVITY) LIKE '%created%' $noPkajquery
				  )
   	WHERE DATETIME = max_created";

	$documentCreatedForHeader = ociparse($conn, $createdForHeader);
	ociexecute($documentCreatedForHeader);
	// END DOCUMENT CREATED

	// DOCUMENT CREATED
	$created = "SELECT *
	FROM ( select a.*, TO_CHAR(DATETIME, 'YYYY-MM-DD HH24:mi') AS DATEFORMAT, max(DATETIME) over () as max_created
			 from $DBUser.HISTORY_LOG_PKAJ a WHERE LOWER(ACTIVITY) LIKE '%created%' $noPkajquery
				  )
   	WHERE DATETIME = max_created";

	$documentCreated = ociparse($conn, $created);
	ociexecute($documentCreated);
	// END DOCUMENT CREATED

	// DOCUMENT VIEWED
	$viewed = "SELECT *
	FROM ( select a.*, TO_CHAR(DATETIME, 'YYYY-MM-DD HH24:mi') AS DATEFORMAT, max(DATETIME) over () as max_created
			 from $DBUser.HISTORY_LOG_PKAJ a WHERE LOWER(ACTIVITY) LIKE '%viewed%' $noPkajquery
				  )
   	WHERE DATETIME = max_created";

	$documentViewed = ociparse($conn, $viewed);
	ociexecute($documentViewed);
	// END DOCUMENT VIEWED

	// DOCUMENT OTP
	$otp = "SELECT *
	FROM ( select a.*, TO_CHAR(DATETIME, 'YYYY-MM-DD HH24:mi') AS DATEFORMAT, max(DATETIME) over () as max_created
			 from $DBUser.HISTORY_LOG_PKAJ a WHERE LOWER(ACTIVITY) LIKE '%otp%' $noPkajquery
				  )
   	WHERE DATETIME = max_created";

	$documentOTP = ociparse($conn, $otp);
	ociexecute($documentOTP);
	// END DOCUMENT OTP

	// DOCUMENT SIGNED
	$signed = "SELECT *
	FROM ( select a.*, TO_CHAR(DATETIME, 'YYYY-MM-DD HH24:mi') AS DATEFORMAT, max(DATETIME) over () as max_created
			 from $DBUser.HISTORY_LOG_PKAJ a WHERE LOWER(ACTIVITY) LIKE '%signed%' $noPkajquery
				  ) ORDER BY DATETIME ASC";

	$documentSigned = ociparse($conn, $signed);
	ociexecute($documentSigned);
	// END DOCUMENT SIGNED

	// DOCUMENT AGREEMENT
	$agreement = "SELECT *
	FROM ( select a.*, TO_CHAR(DATETIME, 'YYYY-MM-DD HH24:mi') AS DATEFORMAT, max(DATETIME) over () as max_created
			 from $DBUser.HISTORY_LOG_PKAJ a WHERE LOWER(ACTIVITY) LIKE '%agreement%' $noPkajquery
				  )";

	$documentAgreement = ociparse($conn, $agreement);
	ociexecute($documentAgreement);
	// END DOCUMENT SIGNED
	
  ?>
<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="650" id="AutoNumber1">
	<tr>
		<td><label><span><b>"DOKUMEN PENANDATANGANAN EPKAJ <?= $no_pkaj ?>" - HISTORY</b></span></label></td>
	</tr> 
	<tr>
		<td><br></td>
	</tr>
	<tr bgcolor="#CBC8C7">
  		<?php while (oci_fetch($documentCreatedForHeader)) { ?>
		<td align="left">Created date : <?= oci_result($documentCreatedForHeader, 'DATEFORMAT'); ?></td>
		<td></td>
	</tr>
	<tr bgcolor="#CBC8C7">
		<td align="left">by : <?= oci_result($documentCreatedForHeader, 'ID_USER') . " - " . oci_result($documentCreatedForHeader, 'USR'); ?></td>
		<td></td>
	</tr>
	<tr bgcolor="#CBC8C7">
		<td align="left">Status : <?= oci_result($documentCreatedForHeader, 'STATUS'); ?><td>
	</tr>
	<tr bgcolor="#CBC8C7">
		<td align="left">Document no. : <?= $no_pkaj?></td>
		<td><a href="editpkajagen_export.php?no=<?= $no_pkaj?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Export to PDF</a></td>	
		<?php } ?>
	</tr>
	<tr>
		<td><br></td>
	</tr>
  
  	<tr>
  		<td bgcolor="white" align="left" >
			<!-- DOCUMENT CREATED -->
			<?php while (oci_fetch($documentCreated)) { ?>
				<i class="fa fa-file-pdf-o"></i> 
				<?= oci_result($documentCreated, 'ACTIVITY') . " by " . oci_result($documentCreated, 'ID_USER') . " - " . oci_result($documentCreated, 'USR'); ?> </br> <?= oci_result($documentCreated, 'DATEFORMAT'); ?>
				<br> <hr> <br>
			<?php } ?>
			<!-- END DOCUMENT CREATED -->
			

			<!-- DOCUMENT CREATED -->
			<?php while (oci_fetch($documentViewed)) { 
				$docviewed = oci_result($documentViewed, 'ACTIVITY') . " by " . oci_result($documentViewed, 'ID_USER') . " - " . oci_result($documentViewed, 'USR');
			?>
				<i class="fa fa-eye"></i>
				<?= $docviewed; ?> </br> <?= oci_result($documentViewed, 'DATEFORMAT'); ?>
				<br> <hr> <br>
			<?php } ?>
			<!-- END DOCUMENT CREATED -->
			

			<!-- DOCUMENT OTP -->
			<?php while (oci_fetch($documentOTP)) { ?>
				<i class="fa fa-envelope-open"></i>
				<?= oci_result($documentOTP, 'ACTIVITY'); ?> code sent to <?= oci_result($documentOTP, 'ID_USER') . " - " . oci_result($documentOTP, 'USR'); ?> via SMS </br> <?= oci_result($documentOTP, 'DATEFORMAT'); ?>
				<br> <hr> <br>
			<?php } ?>
			<!-- END DOCUMENT OTP -->

			<!-- DOCUMENT SIGNED -->
			<?php 
				$i=1;
    			while (($row = oci_fetch_array($documentSigned, OCI_BOTH)) != false) { 
				if ($i==3) {
					break;
				}
			?>
				<i class="fa fa-pencil"></i>
				<?= $row["ACTIVITY"]; ?> by <?= oci_result($documentOTP, 'ID_USER') . " - " . $row["USR"]; ?>  </br> <?= $row["DATEFORMAT"]; ?>
				<br> <hr> <br>
			<?php $i++; } ?>
			<!-- END DOCUMENT SIGNED -->
			

			<!-- DOCUMENT AGREEMENT -->
			<?php while (oci_fetch($documentAgreement)) { 
				if ($i==2) {
					break;
				}	
			?>
				<i class="fa fa-check-circle-o"></i>
				<?= oci_result($documentAgreement, 'ACTIVITY'); ?> </br> <?= oci_result($documentAgreement, 'DATEFORMAT'); ?>
				<br> <hr> <br>
			<?php $i++; } ?>
			<!-- END DOCUMENT AGREEMENT -->
		</td>
	</tr>
</table>

</form>


<br>
<hr size="1">
</div>
<font face="Verdana" size="2"><a href="../mnukeagenan.php">Menu Keagenan</a> |</font>
<font face="Verdana" size="2"><a href="./biodataagen_d3d1.php?noagen=<?=$noagen;?>">Biodata Agen</a></font>
<!--<a href="javascript:history.back();"><font face="Verdana" size="2">Back</font></a>-->
<script language="JavaScript" type="text/javascript">
<!--
var win= null;
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
</script>

</body>

</html>
