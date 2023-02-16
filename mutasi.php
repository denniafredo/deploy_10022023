<? 
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/klien.php";
	
	$DB=New database($userid, $passwd, $DBName);
	$PER=new Pertanggungan($userid,$passwd,$prefix,$noper);
	
	$PER=new Pertanggungan($userid,$passwd,$prefix,$noper);
	$KLN=New Klien($userid,$passwd,$PER->notertanggung);
	
	$sqlForBuild = "SELECT * FROM TABEL_SPAJ_ONLINE WHERE NOSPAJ ='{$PER->nosp}'";
	$DB->parse($sqlForBuild);
	$DB->execute();
	$buildId = $DB->nextrow();
	
	$sqlDocument = "SELECT * FROM JAIM_302_DOKUMEN@jaim WHERE BUILDID ='{$buildId['BUILDID']}' AND NOID = '{$KLN->noid}' AND JENIS_DOKUMEN_ID = '5'";
		
	$DB->parse($sqlDocument);
	$DB->execute();
	$doc = $DB->nextrow();

?>
<html>
<head>
<title>Historis Mutasi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<font face="Verdana" size="2">
Historis Mutasi Polis <b> <? echo ($PER->nopolbaru?$PER->nopolbaru:$prefix."-".$noper) ?></b><br><br>
<b>MUTASI PERTANGGUNGAN</b>
<table border="0" width="100%" cellspacing="1" cellpadding="0">
  <tr class="hijao">
    <td align="center">NO</td>
    <td align="center">TGL.MUTASI</td>
		<td align="center">TGL MOHON</td>
		<td align="center">TGL REKAM</td>
		<td align="center">USER UPDATE</td>
    <td align="center">JENIS MUTASI</td>
    <td align="center">KETERANGAN</td>
  </tr>
	<?
	$sql="select ".
					"to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,".
					"a.keteranganmutasi,a.userupdated,b.namamutasi, a.kdstatus ".
					//"to_char(c.tglmohon,'DD/MM/YYYY') tglmohon,to_char(c.tglrekam,'DD/MM/YYYY HH:MM:SS') tglrekam ".
			 "from ".
			 		"$DBUser.tabel_600_historis_mutasi_pert a,".
					"$DBUser.tabel_601_kode_mutasi b ".
					//"$DBUser.tabel_700_tebus c ".
  	   "where ".

  			 "a.kdmutasi=b.kdmutasi and a.prefixpertanggungan='$prefix' and ".
				 //"a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan and ".
  			 "a.nopertanggungan='$noper' order by a.tglmutasi desc"; 
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();
	$i=1;
	while($his=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$i."</td>";
    echo "<td class=arial8 align=\"center\">".$his["TGLMUTASI"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his["TGLMOHON"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his["TGLREKAM"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his["USERUPDATED"]."</td>";
    echo "<td class=arial8 align=\"left\">".$his["NAMAMUTASI"]."</td>";
	
	$href = '';
	if($his['KDSTATUS'] == 1){
		$link = str_replace('/opt/bitnami/apps/jaim_ifglife/htdocs', '', $doc['META_FILES']);
		$href = " | <a href='http://10.170.64.152{$doc['META_FILES']}' target='_blank'><strong>Check this File!</strong></a>"; 
	}
    
    echo "<td class=arial8 >".$his["KETERANGANMUTASI"]."{$href}</td>";
    echo "</tr>";
		$i++;
	}
	
  $sql="select ".
           "a.prefixpertanggungan,a.nopertanggungan,a.kdmutasi,to_char(a.tglmutasi,'DD/MM/YYYY HH24:MI:SS') tglmutasi,".
           "a.kdvaluta,a.kdcarabayar,".
           "(select namamutasi from $DBUser.tabel_601_kode_mutasi where kdmutasi=a.kdmutasi) as namamutasi,".
           "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar ".
        "from ". 
           "$DBUser.tabel_603_mutasi_pert a ".
        "where ".
           "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
		"order by a.tglmutasi";
		//echo $sql;
  $DB->parse($sql);
  $DB->execute();
	//$i=1;
	while($hist=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$i."</td>";
    echo "<td class=arial8 align=\"center\">".$hist["TGLMUTASI"]."</td>";
		echo "<td class=arial8 align=\"center\">".$hist["TGLMOHON"]."</td>";
		echo "<td class=arial8 align=\"center\">".$hist["TGLREKAM"]."</td>";
		echo "<td class=arial8 align=\"center\">".$hist["USERUPDATED"]."</td>";
    echo "<td class=arial8 align=\"left\">".$hist["NAMAMUTASI"]."</td>";
    echo "<td class=arial8 >".$hist["NAMACARABAYAR"]."</td>";
    echo "</tr>";
		$i++;
	} 
 ?>
</table>
<hr>
<B>MUTASI DILUAR APLIKASI</B>
<BR><BR>
<b>MUTASI STATUS PERTANGGUNGAN</b><BR>
<table border="0" width="100%" cellspacing="1" cellpadding="0">
  <tr class="hijao">
    <td align="center">NO</td>
    <td align="center">TGL. MUTASI</td>
		<td align="center">STATUS LAMA</td>
		<td align="center">STATUS BARU</td>
    <td align="center">USER UPDATED</td>
    <td align="center">KETERANGAN</td>
  </tr>
<? 
	$sql1="select to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.keterangan,".
			  "a.userupdated, ".
				"(select nomorsip from $DBUser.tabel_800_pembayaran_keluar where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and to_char(tglseatled,'DDMMYYYY')=to_char(a.tglmutasi,'DDMMYYYY')) as nosip, ".
				"(select to_char(tglsip,'DD/MM/YYYY') from $DBUser.tabel_800_pembayaran_keluar where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and to_char(tglseatled,'DDMMYYYY')=to_char(a.tglmutasi,'DDMMYYYY')) as tglsip, ".
				"(select namastatusfile from $DBUser.tabel_299_status_file where kdstatusfile=a.statuslama) statuslama, ".
			  "(select namastatusfile from $DBUser.tabel_299_status_file where kdstatusfile=a.statusbaru) statusbaru ".
			  "from $DBUser.polis_history_status a ".
  	    "where a.prefixpertanggungan='$prefix' ".
			  "and a.nopertanggungan='$noper' order by a.tglmutasi desc"; 
	//echo $sql1;
	$DB->parse($sql1);
  $DB->execute();
	$j=1;
	while($his1=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$j."</td>";
    echo "<td class=arial8 align=\"center\">".$his1["TGLMUTASI"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his1["STATUSLAMA"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his1["STATUSBARU"]."</td>";
    echo "<td class=arial8 align=\"left\">".$his1["USERUPDATED"]."</td>";
    echo "<td class=arial8 >".$his1["KETERANGAN"]." ".($his1["NOSIP"]!="" ? "SIP No. ".$his1["NOSIP"]." Tgl. ".$his1["TGLSIP"]." " : "")."</td>";
    echo "</tr>";
		$j++;
	}
 ?>
 </table>
<br>
<b>MUTASI JUA</b><BR>
<table border="0" width="100%" cellspacing="1" cellpadding="0">
  <tr class="hijao">
    <td align="center">NO</td>
    <td align="center">TGL. MUTASI</td>
		<td align="center">JUA LAMA</td>
		<td align="center">JUA BARU</td>
    <td align="center">USER UPDATED</td>
    <td align="center">KETERANGAN</td>
  </tr>
<? 
	$sql2="select to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.keterangan,".
			  "a.userupdated,a.jualama,a.juabaru ".
				"from $DBUser.polis_history_jua a ".
  	    "where a.prefixpertanggungan='$prefix' ".
			  "and a.nopertanggungan='$noper' order by a.tglmutasi desc"; 
				//echo $sql2;
	$DB->parse($sql2);
  $DB->execute();
	$k=1;
	while($his2=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$k."</td>";
    echo "<td class=arial8 align=\"center\">".$his2["TGLMUTASI"]."</td>";
		echo "<td class=arial8 align=\"center\">".number_format($his2["JUALAMA"],2)."</td>";
		echo "<td class=arial8 align=\"center\">".number_format($his2["JUABARU"],2)."</td>";
    echo "<td class=arial8 align=\"left\">".$his2["USERUPDATED"]."</td>";
    echo "<td class=arial8 >".$his2["KETERANGAN"]."</td>";
    echo "</tr>";
		$k++;
	}
 ?>
 </table>
 <br>
<b>MUTASI PREMI</b><BR>
<table border="0" width="100%" cellspacing="1" cellpadding="0">
  <tr class="hijao">
    <td align="center">NO</td>
    <td align="center">TGL. MUTASI</td>
		<td align="center">PREMI1 LAMA</td>
		<td align="center">PREMI1 BARU</td>
		<td align="center">PREMI2 LAMA</td>
		<td align="center">PREMI2 BARU</td>
    <td align="center">USER UPDATED</td>
    <td align="center">KETERANGAN</td>
  </tr>
	<? 
	$sql3="select to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.keterangan,".
			  "a.userupdated,a.premi1lama,a.premi1baru,a.premi2lama,a.premi2baru ".
				"from $DBUser.polis_history_premi a ".
  	    "where a.prefixpertanggungan='$prefix' ".
			  "and a.nopertanggungan='$noper' order by a.tglmutasi desc"; 
	//echo $sql3;
	$DB->parse($sql3);
  $DB->execute();
	$l=1;
	while($his3=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$l."</td>";
    echo "<td class=arial8 align=\"center\">".$his3["TGLMUTASI"]."</td>";
		echo "<td class=arial8 align=\"center\">".number_format($his3["PREMI1LAMA"],2)."</td>";
		echo "<td class=arial8 align=\"center\">".number_format($his3["PREMI1BARU"],2)."</td>";
		echo "<td class=arial8 align=\"center\">".number_format($his3["PREMI2LAMA"],2)."</td>";
		echo "<td class=arial8 align=\"center\">".number_format($his3["PREMI2BARU"],2)."</td>";
    echo "<td class=arial8 align=\"left\">".$his3["USERUPDATED"]."</td>";
    echo "<td class=arial8 >".$his3["KETERANGAN"]."</td>";
    echo "</tr>";
		$l++;
	}
 ?>
 </table>
 <BR>
 <b>MUTASI TERTANGGUNG</b><BR>
<table border="0" width="100%" cellspacing="1" cellpadding="0">
  <tr class="hijao">
    <td align="center">NO</td>
    <td align="center">TGL. MUTASI</td>
		<td align="center">TERTANGGUNG LAMA</td>
		<td align="center">TERTANGGUNG BARU</td>
    <td align="center">USER UPDATED</td>
    <td align="center">KETERANGAN</td>
  </tr>
<? 
	$sql4="select to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.keterangan,".
			  "a.userupdated, ".
				"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggunglama) tertanggunglama, ".
			  "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggungbaru) tertanggungbaru ".
			  "from $DBUser.polis_history_tertanggung a ".
  	    "where a.prefixpertanggungan='$prefix' ".
			  "and a.nopertanggungan='$noper' order by a.tglmutasi desc"; 
	//echo $sql4;
	$DB->parse($sql4);
  $DB->execute();
	$j=1;
	while($his1=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$j."</td>";
    echo "<td class=arial8 align=\"center\">".$his1["TGLMUTASI"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his1["TERTANGGUNGLAMA"]."</td>";
		echo "<td class=arial8 align=\"center\">".$his1["TERTANGGUNGBARU"]."</td>";
    echo "<td class=arial8 align=\"left\">".$his1["USERUPDATED"]."</td>";
    echo "<td class=arial8 >".$his1["KETERANGAN"]."</td>";
    echo "</tr>";
		$j++;
	}
 ?>
 </table>
  <BR>
 <b>PERUBAHAN KLIEN</b><BR>
<table border="0" width="100%" cellspacing="1" cellpadding="0">
  <tr class="hijao">
    <td align="center">NO</td>
    <td align="center">TGL. MUTASI</td>
    <td align="center">NAMA KLIEN</td>
    <td align="center">KETERANGAN</td>
		<td align="center">USER</td>
  </tr>
	<? 
	$sql5="select to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,a.keterangan,".
			  "a.userrekam, ".
				"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noklien) namaklien ".
			  "from $DBUser.tabel_100_history_klien a ".
  	    "where a.prefixpertanggungan='$prefix' ".
			  "and a.nopertanggungan='$noper' order by a.tglmutasi desc"; 
	//echo $sql5;
	$DB->parse($sql5);
  $DB->execute();
	$k=1;
	while($his2=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td class=arial8 align=\"right\">".$k."</td>";
    echo "<td class=arial8 align=\"center\">".$his2["TGLMUTASI"]."</td>";
		echo "<td class=arial8>".$his2["NAMAKLIEN"]."</td>";
		echo "<td class=arial8>".$his2["KETERANGAN"]."</td>";
    echo "<td class=arial8>".$his2["USERREKAM"]."</td>";
    echo "</tr>";
		$k++;
	}
 ?>
 </table>
 <br><br>
 <? echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; ?>
</body>
</html>
