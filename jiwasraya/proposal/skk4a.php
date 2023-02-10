<?
	include "../../includes/database.php"; 
	//include "../../includes/klien.php";
	include "../../includes/pertanggungan.php"; 
	include "../../includes/session.php"; 
	$DB=New database($userid, $passwd, $DBName);	
	$DA=New database($userid, $passwd, $DBName);	
	$today = date("d F Y"); 
	$PER=New Pertanggungan($userid,$passwd,$kantor,$noproposal);
	$kelompok = substr($PER->produk, 0, 2) == 'JL' ? 'U' : 'T';
	//$noklien=$PER->notertanggung;
	
if ($submit=='Lanjut') {
	$sql = "DELETE FROM $DBUser.tabel_119_ket_kesehatan WHERE noklien = '$klienno'";
	$DB->parse($sql);
	$DB->execute();
	
	$DB->parse($psql);
	$DB->execute();
	foreach ($DB->result() as $i => $v) {
		$kdstatus = (strlen($v['KDITEM'])== 2 && $kelompok == 'T') || (strlen($v['KDITEM'])== 3 && $kelompok == 'U') ? ${"_".$v['KDITEM']} : '';
		$keterangan = (strlen($v['KDITEM'])== 3 && $kelompok == 'T') || (strlen($v['KDITEM'])== 4 && $kelompok == 'U') ? ${"_".$v['KDITEM']} : '';
		$sql = "INSERT INTO $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan)
				VALUES ('$klienno', '$v[KDITEM]', '$kdstatus', '$keterangan')";
		$DB->parse($sql);
		$DB->execute();
	}
	
	echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	echo "window.location.replace('skk4b.php?noproposal=".$proposalno."&tglmutasi=".$tglmutasi."&jnscari=".$jnscari."')";
	echo "</script>";
} else {	

$sql="select ". 
          "a.notertanggung, ".
					"b.namaklien1,".
					"b.jeniskelamin,".
					"decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk, a.nopolbaru ".
		 "from ".
		      "$DBUser.tabel_200_pertanggungan a,".
					"$DBUser.tabel_100_klien b ".
     "where ".
		      "b.noklien=a.notertanggung and ". 
		      "a.prefixpertanggungan='$kantor' and a.nopertanggungan='$noproposal'";
$DB->parse($sql);
$DB->execute();
$ttg=$DB->nextrow();
$noklien=$ttg["NOTERTANGGUNG"];
$namaklien=$ttg["NAMAKLIEN1"];
$jnskelamin=$ttg["JENISKELAMIN"];
?>
<html>
<head>
<title>Data Kesehatan Lanjutan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<div align="center">
<form name="formisianskk" action="<? echo $PHP_SELF; ?>" method="post">
<input type="hidden" name="klienno" value="<? echo $noklien; ?>">
<input type="hidden" name="noproposal" value="<? echo $noproposal; ?>">
<table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td width="16%" colspan="2" class="arial10">Nomor Proposal</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><!--?echo $kantor." - ".$noproposal;?--><?=$ttg['NOPOLBARU']?></td><br>
				  <td width="53%" colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tanggal Entry</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb"><?echo $today;?></td>
        	<td width="53%" colspan="3" class="verdana8" align="center">Beri Tanda V Pada Kolom Yang Sesuai.</td>
				</tr>
        <tr>
					<td width="16%" colspan="2" class="arial10">Tertanggung</td>
					<td width="1%" class="arial10" align="center">:</td>
          <td width="30%" class="verdana10blkb" align="left">
					<?	
					 echo $namaklien;
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $PER->notertanggung." - ".$KLIEN->nama; 
					?></td>
          <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>
        <tr>
          <td width="16%" colspan="2" class="arial10">Jenis Kelamin</td>
					<td width="1%"class="arial10" align="center">:</td>
          <td width="30%"class="verdana10blkb" align="left">
					<?	
					 echo $ttg["NAMAJK"];
					  //$KLIEN=New Klien ($userid,$passwd,$PER->notertanggung);echo $KLIEN->namajk; 
					?></td>
         <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>							
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">F O R M U L I R&nbsp;&nbsp;&nbsp;&nbsp;I S I A N</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Terakhir, Isilah Formulir Isian Kesehatan dengan Jujur.</td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
      <table border="0" width="100%" cellpadding="0" cellspacing="1">
				<tr>
					<td width="5%" class="c" align="center">Kode</td>
					<td width="45%" class="c" align="center">Pertanyaan</td>
					<td width="50%" class="c" align="center">Jawaban</td>
				</tr>
      <?
      	//if ($KLIEN->jeniskelamin=='L') {
      	/*if ($jnskelamin=='L') {
        	$wanita = "and substr(a.kditem,'0','1') in ('1','2','3') ";
      	} else {
        	$wanita = '';
      	}		 
      	$sql="select a.kditem, a.namaitem, b.kdstatus, b.keterangan ".
      		 	 "from $DBUser.tabel_999_item_kesehatan a, $DBUser.tabel_119_ket_kesehatan b ".
      			 "where a.kelompok='T' and a.kditem=b.kditem(+) and b.noklien(+)='$noklien' and TO_NUMBER(substr(a.kditem,0,1)) < 5 ".
      		 	 $wanita.
      		 	 "order by a.kditem";*/
		$sql = "SELECT a.kditem, a.namaitem, b.kdstatus, b.keterangan
				FROM $DBUser.tabel_999_item_kesehatan a
				LEFT OUTER JOIN $DBUser.tabel_119_ket_kesehatan b ON a.kditem = b.kditem
					AND b.noklien = '$noklien'
				WHERE a.kelompok = '$kelompok'
					".($kelompok == 'T' ? "AND SUBSTR(a.kditem, 0, 1) IN ".($jnskelamin=='L'?"('0','1','2','3')":"('0', '1', '2', '3', '4', '5')")." ORDER BY TO_NUMBER(SUBSTR(a.kditem, 0, 1)), kditem" : 
					($jnskelamin == 'L' ? "AND a.kditem NOT LIKE '*9%'" : ''));
		//echo $sql;
      	$DB->parse ($sql);
      	$DB->execute();
		echo "<textarea name='psql' style='display:none;'>$sql</textarea>";
		
		$i=1;
		while ($arr=$DB->nextrow()) { 
			include "../../includes/belang.php";
			if ((strlen($arr["KDITEM"])==1 && $kelompok == 'T') || (strlen($arr['KDITEM'])==2 && $kelompok == 'U')) {
				$kelas="arial10bold";
				$col=2;
				$align="left";
				$input='';
			} else if  ((strlen($arr["KDITEM"])==2 && $kelompok == 'T') || (strlen($arr['KDITEM'])=='3' && $kelompok == 'U')) {
				$kelas="arial10";
				$col='';
				$align="center";
				if ($arr["KDSTATUS"]=='Y') {
					$input=": <input type=\"radio\" value=\"Y\" checked name=\"_".$arr["KDITEM"]."\">Ya &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
      	 				   "<input type=\"radio\" value=\"N\" name=\"_".$arr["KDITEM"]."\">Tidak";				
				} else {
					$input=": <input type=\"radio\" value=\"Y\" name=\"_".$arr["KDITEM"]."\">Ya &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
      	 				   "<input type=\"radio\" value=\"N\" checked name=\"_".$arr["KDITEM"]."\">Tidak";				
				}					 	 
			} else if ((strlen($arr["KDITEM"])==3 && $kelompok == 'T') || (strlen($arr['KDITEM']) && $kelompok == 'U')) {
				$kelas="arial10";
				$col='';
				$align="right";
				$input=": <input class=c type=\"text\" name=\"_".$arr["KDITEM"]."\" size=\"40\" maxlength=\"50\" onfocus=\"highlight(event)\" value=\"".$arr["KETERANGAN"]."\">";
			} 
			echo "<td width='5%' class='$kelas' align='$align'>".substr($arr["KDITEM"],-1)."&nbsp;&nbsp;<input type='hidden' name='kditem[]' value='$arr[KDITEM]' /></td>";
			echo "<td width='45%' class='$kelas' colspan='$col'>".$arr["NAMAITEM"]."</td>";
			echo "<td width=\"50%\" class=\"$kelas\">".$input."</td>";
			echo "</tr>";
			$i++;
		} ?>
			</table><p>&nbsp;</p>
    </td>
  </tr>
</table>
<table width="700" align="center" border="0">
  <tr>
    <td align="left" class="arial10"><a href="#" onClick="window.history.go(-1)">Back</a></td>
	  <td align="right">
			<input type="hidden" name="noklien" value=<? echo $noklien; ?>>
			<input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
			<input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
			<input type="hidden" name="jnscari" value=<?=$jnscari;?>>
		  <input type="submit" name="submit" value="Lanjut">
		</td>
  </tr>
	<tr>
	</tr>
</table>
</form>

</body>
</html>
<?}?>
