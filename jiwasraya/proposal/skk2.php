<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	//include "../../includes/pertanggungan.php"; 
	//include "../../includes/klien.php";
  $DB=New database($userid, $passwd, $DBName);	

	//$PER=New Pertanggungan($userid,$passwd,$kantor,$noproposal);
	//$KL=new Klien($userid,$passwd,$PER->notertanggung);
  $today = date("d F Y"); 
  
	if ($ambil) {
		// Insert skk spajol
		$sql = "INSERT INTO $DBUser.tabel_116_riwayat_keluarga(noklien, kdhubungan, jmlhidup, keadaankesehatan,
					jmlmeninggal, sebabmeninggal, tglmeninggal, lamasakit)
				SELECT DISTINCT c.notertanggung, a.kodehubungan, CASE WHEN a.hidup = 'Y' THEN 1 ELSE null END, 
					a.kondisikesehatan, CASE WHEN a.meninggal = 'Y' THEN 1 ELSE null END, a.sebabmeninggal,
					a.tglmeninggal, a.lamasakit
				FROM $DBUser.tabel_spaj_online_riwayat a
				INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
				INNER JOIN $DBUser.tabel_200_pertanggungan c ON b.nospaj = c.nosp
				LEFT OUTER JOIN $DBUser.tabel_218_kode_hubungan d ON a.kodehubungan = d.kdhubungan
				LEFT OUTER JOIN $DBUser.tabel_116_riwayat_keluarga e ON c.notertanggung = e.noklien
					AND a.kodehubungan = e.kdhubungan
				WHERE c.nopertanggungan = '$noproposal'
					AND e.noklien IS NULL";
		$DB->parse($sql);
		$DB->execute();
		
		$sql = "INSERT INTO $DBUser.tabel_117_umur_keluarga(noklien, kdhubungan, umurhidup1, umurhidup2, umurhidup3,
					umurhidup4, umurhidup5, umurhidup6, umurmati1, umurmati2, umurmati3, umurmati4, umurmati5, umurmati6)
				SELECT DISTINCT c.notertanggung, a.kodehubungan, 
					CASE WHEN hidup = 'Y' THEN a.usia END,
					CASE WHEN hidup = 'Y' THEN a.usia END,
					CASE WHEN hidup = 'Y' THEN a.usia END,
					CASE WHEN hidup = 'Y' THEN a.usia END,
					CASE WHEN hidup = 'Y' THEN a.usia END,
					CASE WHEN hidup = 'Y' THEN a.usia END,
					CASE WHEN meninggal = 'Y' THEN a.usia END,
					CASE WHEN meninggal = 'Y' THEN a.usia END,
					CASE WHEN meninggal = 'Y' THEN a.usia END,
					CASE WHEN meninggal = 'Y' THEN a.usia END,
					CASE WHEN meninggal = 'Y' THEN a.usia END,
					CASE WHEN meninggal = 'Y' THEN a.usia END
				FROM $DBUser.tabel_spaj_online_riwayat a
				INNER JOIN $DBUser.tabel_spaj_online_relasi b ON a.noklien = b.noklien
				INNER JOIN $DBUser.tabel_200_pertanggungan c ON b.nospaj = c.nosp
				LEFT OUTER JOIN $DBUser.tabel_218_kode_hubungan d ON a.kodehubungan = d.kdhubungan
				LEFT OUTER JOIN $DBUser.tabel_117_umur_keluarga e ON c.notertanggung = e.noklien
					AND a.kodehubungan = e.kdhubungan
				WHERE c.nopertanggungan = '$noproposal'
					AND e.noklien IS NULL";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		// End insert skk spajol
	}
  

if ($submit=='Insert'){
	$kshidup=(strlen($kshidup)==0) ? 'NULL' : "'".strtoupper($kshidup)."'";
	$sebabmati=(strlen($sebabmati)==0) ? 'NULL' : "'".strtoupper($sebabmati)."'";
	$jmlhidup = (strlen($jmlhidup)==0) ? 'NULL'  : $jmlhidup;
	$jmlmati = (strlen($jmlmati)==0) ? 'NULL'  : $jmlmati;
	$thn = ($thn==''||strlen($thn)==0) ? 'NULL' : "to_date('01/01/$thn','DD/MM/YYYY')";
	
	$lamasakit=($lamasakit=='') ? 'NULL' : $lamasakit;
  $umurhidup1 = ($umurhidup1=='') ? 'NULL' : $umurhidup1;
  $umurhidup2 = ($umurhidup2=='') ? 'NULL' : $umurhidup2;
	$umurhidup3 = ($umurhidup3=='') ? 'NULL' : $umurhidup3;
	$umurhidup4 = ($umurhidup4=='') ? 'NULL' : $umurhidup4;
	$umurhidup5 = ($umurhidup5=='') ? 'NULL' : $umurhidup5;
	$umurhidup6 = ($umurhidup6=='') ? 'NULL' : $umurhidup6;
  $umurmati1 = ($umurmati1=='') ? 'NULL' : $umurmati1;
  $umurmati2 = ($umurmati2=='') ? 'NULL' : $umurmati2;
	$umurmati3 = ($umurmati3=='') ? 'NULL' : $umurmati3;
	$umurmati4 = ($umurmati4=='') ? 'NULL' : $umurmati4;
	$umurmati5 = ($umurmati5=='') ? 'NULL' : $umurmati5;
	$umurmati6 = ($umurmati6=='') ? 'NULL' : $umurmati6;
	
	$qry="insert into $DBUser.tabel_116_riwayat_keluarga(noklien,kdhubungan,jmlhidup, ".
	     "keadaankesehatan,jmlmeninggal,sebabmeninggal,tglmeninggal,lamasakit) ".
			 "values ('$klienno','$kdhubungan',$jmlhidup,$kshidup,$jmlmati,$sebabmati,$thn,$lamasakit)";
	//echo $qry."<br>";
	$DB->parse($qry);
	$DB->execute();
	$DB->commit();
	
  $qry="insert into $DBUser.tabel_117_umur_keluarga(noklien,kdhubungan,umurhidup1,umurhidup2,umurhidup3,".
	     "umurhidup4,umurhidup5,umurhidup6,umurmati1,umurmati2,umurmati3,umurmati4,umurmati5,umurmati6) ".
			 "values ('$klienno','$kdhubungan',$umurhidup1,$umurhidup2,$umurhidup3,$umurhidup4,$umurhidup5,".
			 "$umurhidup6,$umurmati1,$umurmati2,$umurmati3,$umurmati4,$umurmati5,$umurmati6)";
	//echo $qry."<br>";
	$DB->parse($qry);
	$DB->execute();
	$DB->commit();
	echo "<script language=\"JavaScript\" type=\"text/javascript\">";
  echo "</script>";
}

if (isset($addpengidap)){
  $sql = "delete $DBUser.tabel_116_penyakit_keturuan where noklien='$klienno'";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	if($adapenyakit=="Y"){
  $sql = "insert into $DBUser.tabel_116_penyakit_keturuan ".
			 	 			"(noklien,adapengidap,namapengidap,jenispenyakit,usia) ".
				 "values ".
				 		  "('$klienno','$adapenyakit','$namapengidap','$jenispenyakit','$usia')";
	$DB->parse($sql);
	$DB->execute();
	$DB->commit();
	}
}

//echo "<h1><font color=red>Maaf modul SKK ini masih dalam perbaikan.. mohon kembali sesaat lagi thx</font></h1>";
$sql="SELECT a.notertanggung,
			a.kdproduk, 
			b.namaklien1,
			decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk, 
			a.nopolbaru 
		 from $DBUser.tabel_200_pertanggungan a,
		 $DBUser.tabel_100_klien b 
     where b.noklien=a.notertanggung 
     	--and a.prefixpertanggungan='$kantor' 
     	and a.nopertanggungan='$noproposal'";
// echo $sql;
$DB->parse($sql);
$DB->execute();
$ttg=$DB->nextrow();
$nomorttg=$ttg["NOTERTANGGUNG"];
$jslink = substr($ttg["KDPRODUK"],0,3);
//echo $sql;
?>
<html>
<head>
<title>Data Keluarga</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

form{
padding:0px;
margin:0px;
}
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

h4{
padding: 0 0 5px 0;
margin:0;
}

.jarak {
clear:both;
height:1px;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>
<div align="center">
<form name="skk2" method="post" action="skk2.php">
<input type="hidden" name="noproposal" value=<? echo $noproposal; ?>>
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
          <td width="30%" class="verdana10blkb" align="left"><?=$ttg["NAMAKLIEN1"]; ?></td>
          <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>
        <tr>
          <td width="16%" colspan="2" class="arial10">Jenis Kelamin</td>
					<td width="1%"class="arial10" align="center">:</td>
          <td width="30%"class="verdana10blkb" align="left"><?=$ttg["NAMAJK"]; ?></td>
         <td width="53%" colspan="3" class="verdana8" align="center"></td>
        </tr>				
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">R I W A Y A T&nbsp;&nbsp;&nbsp;&nbsp;K E L U A R G A</td>
        </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Pilih Hubungan Keluarga, Masukkan Jumlah Yang masih hidup serta meninggal</td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
			<table border="0" width="100%" cellpadding="0" cellspacing="1" class="tblisi">
        <tr class="hijao">
          <td align="right" rowspan="2" ><b>No</td>
          <td align="center" colspan="2" rowspan="2" ><b>KELUARGA</td>
					<td align="center" colspan="4" ><b>MASIH HIDUP</td>
				  <td align="right" rowspan="2" >|</td>
        	<td align="center" colspan="7" ><b>SUDAH MENINGGAL</td>
			  </tr>
				<tr class="hijao">
					<td align="center">JML</td>
					<td align="left">KESEHATAN</td>
					<td align="center" colspan="2">UMUR</td>
					<td align="center">JML</td>
					<td align="center" colspan="2">UMUR</td>
			  	<td align="left">SEBAB</td>
					<td align="center">TAHUN</td>
					<td align="center">LAMA SAKIT</td>
					<td align="center">HAPUS</td>
        </tr>
<!------------------------------ diulang berdasarkan jumlah klien insurable ----------------------------------------->		
        <?
        	$sql="select ".
									"to_char(a.tglmeninggal,'DD/MM/YYYY') mati,a.sebabmeninggal,a.kdhubungan,b.namahubungan,a.jmlhidup,a.jmlmeninggal, ".
        			 		"a.keadaankesehatan,a.lamasakit,c.umurhidup1,c.umurhidup2,c.umurhidup3,c.umurhidup4,c.umurhidup5,c.umurhidup6, ".
        			 		"c.umurmati1,c.umurmati2,c.umurmati3,c.umurmati4,c.umurmati5,c.umurmati6 ".
        			 "from ".
							 		"$DBUser.tabel_116_riwayat_keluarga a,".
									"$DBUser.tabel_218_kode_hubungan b,".
									"$DBUser.tabel_117_umur_keluarga c ".
        			 "where ".
							 		"a.noklien='$nomorttg' ".
									"and a.kdhubungan=b.kdhubungan and a.noklien=c.noklien ".
									"and a.kdhubungan=c.kdhubungan";
          	// echo $sql;
        	$DB->parse($sql);
        	$DB->execute();
        	$i=1;
        	while ($arz=$DB->nextrow()) {
        	$seda=substr($arz["MATI"],-4);
        	$hari =($arz["LAMASAKIT"]==0) ? '' : $arz["LAMASAKIT"]." hari";
            include "../../includes/belang.php";
        		echo "<td align=\"center\" class=\"arial10\">".$i.".</td>";
        		echo "<td align=\"left\" class=\"arial10\">".$arz["NAMAHUBUNGAN"]."</td>";
        		echo "<td align=\"center\" ></td>";
        		echo "<td align=\"center\" class=\"arial10blue\">".$arz["JMLHIDUP"]."</td>";
        		echo "<td align=\"left\" class=\"arial10\">".$arz["KEADAANKESEHATAN"]."</td>";
        		echo "<td align=\"center\" colspan=\"2\" class=\"arial10\">".$arz["UMURHIDUP1"]." ".$arz["UMURHIDUP2"]." ".$arz["UMURHIDUP3"]." ".$arz["UMURHIDUP4"]." ".$arz["UMURHIDUP5"]." ".$arz["UMURHIDUP6"]."</td>";
        		echo "<td align=\"center\" ></td>";
        		echo "<td align=\"center\" class=\"arial10blue\">".$arz["JMLMENINGGAL"]."</td>";
        		echo "<td align=\"center\" colspan=\"2\" class=\"arial10\">".$arz["UMURMATI1"]." ".$arz["UMURMATI2"]." ".$arz["UMURMATI3"]." ".$arz["UMURMATI4"]." ".$arz["UMURMATI5"]." ".$arz["UMURMATI6"]."</td>";
        		echo "<td align=\"left\" class=\"arial10\">".$arz["SEBABMENINGGAL"]."</td>";
        		echo "<td align=\"center\" class=\"arial10\">$seda</td>";
        		echo "<td align=\"center\" class=\"arial10\">".$hari."</td>";
        		echo "<td align=\"center\" class=\"arial10\"><b><a href=# onclick=\"NewWindow('hapusriwayat.php?p=$noproposal&noklien=$nomorttg&hub=".$arz["KDHUBUNGAN"]."','hapus',650,400,1)\">X</a></td>";
        		echo "</tr>";
        		$i++;
        	}
        ?>
        <tr>
					<td align="center" class="arial10"></td>
          <td align="center">
						<select class="c" name="kdhubungan" onFocus="highlight(event)">
            <?
            	$sql="select kdhubungan,namahubungan from $DBUser.tabel_218_kode_hubungan ".
            			 "where kdhubungan in ('I','S','1','A','U','W','L') ";
            			 "order by namahubungan";
              $DB->parse($sql);
            	$DB->execute();			 
            	while ($res=$DB->nextrow()) {		
            	  echo "<option value=\"".$res["KDHUBUNGAN"]."\">".$res["NAMAHUBUNGAN"]."</option>";
            	}
            ?>
					  </select></td>
					<td align="center" >.</td>
					<td align="center"><input type="text" class="c" name="jmlhidup" size="2" maxlength="1" onFocus="highlight(event)"></td>
					<td align="center"><input type="text" class="c" name="kshidup" onFocus="highlight(event)"></td>
					<td align="right">
						<input type="text" class="c" name="umurhidup1" size="2" maxlength="2" onFocus="highlight(event)">
					  <input type="text" class="c" name="umurhidup2" size="2" maxlength="2" onFocus="highlight(event)"><br>
					  <input type="text" class="c" name="umurhidup3" size="2" maxlength="2" onFocus="highlight(event)">
					</td>
					<td align="left">
					  <input type="text" class="c" name="umurhidup4" size="2" maxlength="2" onFocus="highlight(event)"><br>
					  <input type="text" class="c" name="umurhidup5" size="2" maxlength="2" onFocus="highlight(event)">
					  <input type="text" class="c" name="umurhidup6" size="2" maxlength="2" onFocus="highlight(event)">
					</td>
					<td align="center" >.</td>
					<td align="right"><input class="c" name="jmlmati" size="2" maxlength="1" onFocus="highlight(event)"></td>
					<td align="right">
						<input type="text" class="c" name="umurmati1" size="2" maxlength="2" onFocus="highlight(event)">
					  <input type="text" class="c" name="umurmati2" size="2" maxlength="2" onFocus="highlight(event)"><br>
					  <input type="text" class="c" name="umurmati3" size="2" maxlength="2" onFocus="highlight(event)">
					</td>
					<td align="left">
					  <input type="text" class="c" name="umurmati4" size="2" maxlength="2" onFocus="highlight(event)"><br>
					  <input type="text" class="c" name="umurmati5" size="2" maxlength="2" onFocus="highlight(event)">
					  <input type="text" class="c" name="umurmati6" size="2" maxlength="2" onFocus="highlight(event)"></td>
          <td align="center"><input type="textarea" class="c" name="sebabmati" size="20" onFocus="highlight(event)"></td>
          <td align="center">
						<select class="c" name="thn" onFocus="highlight(event)">
            <?
            	$sql ="select to_char(sysdate,'DD/MM/YYYY') tglmati from dual ";
            	$DB->parse($sql);
            	$DB->execute();
            	$arr=$DB->nextrow();
            	$tglmati=substr($arr["TGLMATI"],-4);
            	echo "<option selected></option>";
            	for ($i=1900; $i<=$tglmati; $i++) {
            		echo "<option value=\"$i\">$i</option>";
            	}		
            ?>
					 	</select>
					</td>
          <td align="center"><input type="text" class="c" name="lamasakit" size="3" maxlength="3" onFocus="highlight(event)"> <font size="1">hari</font></td>
					<td align="center">
						<input type="hidden" name="klienno" value=<? echo $nomorttg; ?>>			
						<input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
						<input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
						<input type="hidden" name="jnscari" value=<?=$jnscari;?>>
						<input type="submit" name="submit" value="Insert"></td>
        </tr>
				
 		</table>
		<? 
		if($jslink == "JL2" || $jslink == "JL3"){
		 $sql = "select adapengidap,namapengidap,jenispenyakit,usia from ".
		 				"$DBUser.tabel_116_penyakit_keturuan where noklien='$nomorttg'";
		 //echo $sql;
	   $DB->parse($sql);
		 $DB->execute();
     $row=$DB->nextrow();
    ?>
		<table border="0" width="100%" cellpadding="0" cellspacing="1">
    <tr valign="top">
      <td>a.</td>
		  <td>Apakah ada diantara ayah, ibu atau saudara kandung (hidup atau meninggal) 
          yang pernah menderita Diabetes, sakit jantung, tekanan darah tinggi, stroke, 
          sakit ginjal, kelainan mental, Hepatitis, kanker atau penyakit keturunan 
          lainnya?<br>
          <input type="radio" value="Y" name="adapenyakit" <?=($row["ADAPENGIDAP"]=="Y" ? "checked" : "");?> >Ya&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="radio" value="T" name="adapenyakit" <?=($row["ADAPENGIDAP"]=="T" ? "checked" : "");?> >Tidak
		</tr>
		<tr>
		  <td valign="top">b.</td>
			<td>Jika ya, mohon dijelaskan :<br />
				  <table border="0">
          	<tr>
          		<td>Siapa</td>
          		<td>Jenis Penyakit</td>
          		<td>Usia</td>
          	</tr>
          	<tr>
          		<td><input type="text" name="namapengidap" size="40" value="<?=$row["NAMAPENGIDAP"];?>"></td>
          		<td><input type="text" name="jenispenyakit" size="40" value="<?=$row["JENISPENYAKIT"];?>"></td>
          		<td><input type="text" name="usia" size="10" value="<?=$row["USIA"];?>"></td>
							<td><input type="submit" name="addpengidap" value="SUBMIT"></td>
          	</tr>
          </table>
	  </td>	
		</tr>
  </table>
	<? } ?>
					
</table>
<table width="100%" border="0">
  <tr>
    <td align="center" colspan="2">
		  <input type="reset" name="Reset" value="Reset" onClick="return confirm('Data Dibatalkan?')">&nbsp;&nbsp;
		  <input type="submit" name="ambil" value="Ambil data dari ESPAJ" style="font-weight:bold;">
    </td>
	</tr>
  <tr>
	  <td align="left"><a href="#" onClick="window.history.go(-1)">Back</a></td>
<? echo "<td align=\"right\" class=\"arial10\"><a href=\"skk3a.php?noproposal=$noproposal&noklien=$nomorttg&tglmutasi=$tglmutasi&jnscari=".$jnscari."\">Next</a></td>";?>
	</tr>
</table>
</form>
</div>

</body>
</html>
