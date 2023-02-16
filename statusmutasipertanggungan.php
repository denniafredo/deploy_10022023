<? 
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/klien.php";
	$DB=New database($userid, $passwd, $DBName);
	$DBX=New database($userid, $passwd, $DBName);
	$PER=new Pertanggungan($userid,$passwd,$prefix,$noper);
	$KLN=New Klien($userid,$passwd,$PER->notertanggung);

		$sqlDocument = "SELECT * FROM JAIM_302_DOKUMEN@jaim WHERE BUILDID ='{$PER->nopol}' AND NOID = '{$KLN->noid}' AND JENIS_DOKUMEN_ID = '5'";
		
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
    <td align="center">STATUS</td>
  </tr>
	<?
	$sql="select ".
					"to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,".
					"a.keteranganmutasi,a.userupdated,b.namamutasi,a.kdmutasi ".
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
    echo "<td class=arial8 >".$his["KETERANGANMUTASI"]."</td>";
	 echo "<td class=arial8 >";
	 if($his["KDMUTASI"]=='18'){
	 $tabel="$DBUser.tabel_901_pengajuan_klaim";
	 $kdklaim="and kdklaim=substr('".$his["KETERANGANMUTASI"]."',7,(instr('".substr($his["KETERANGANMUTASI"],6)."',' ')-1))";
	 }elseif($his["KDMUTASI"]=='15'){
	 $tabel="$DBUser.tabel_700_pulih";
	 $kdklaim="";
	 }elseif($his["KDMUTASI"]=='11'){
	 $tabel="$DBUser.tabel_700_tebus";
	 $kdklaim="";
	 }elseif($his["KDMUTASI"]=='17'){
	 $tabel="$DBUser.tabel_700_gadai";
	 $kdklaim="";
	 }
	 
	 $sqql="select namastatus from $tabel a,$DBUser.tabel_999_kode_status where to_char(tglpengajuan,'dd/mm/yyyy')='".$his["TGLMUTASI"]."' and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' and status=kdstatus and jenisstatus='KLAIM' $kdklaim";	
	 //echo $sqql;
	  
	 $DBX->parse($sqql);
	 $DBX->execute();
	 $arrr=$DBX->nextrow();
	 if($arrr["NAMASTATUS"]==""){
	 echo "Mutasi Selesai";
	 }else{
	 echo $arrr["NAMASTATUS"];
	 }
	 
	 echo "</td>";
    echo "</tr>";
		$i++;
	}
	
  $sql="select ".
           "a.prefixpertanggungan,a.nopertanggungan,a.kdmutasi,to_char(a.tglmutasi,'DD/MM/YYYY') tglmutasi,".
           "a.kdvaluta,a.kdcarabayar,".
           "(select namamutasi from $DBUser.tabel_601_kode_mutasi where kdmutasi=a.kdmutasi) as namamutasi,".
           "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar ".
        "from ". 
           "$DBUser.tabel_603_mutasi_pert a ".
        "where ".
           "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper'";
		   //echo $sql;
  $DB->parse($sql);
  $DB->execute();
	$i=1;
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
<br>
<br>
 <? echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; ?>
</body>
</html>
