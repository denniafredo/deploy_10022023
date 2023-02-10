<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	
  $DB=New database($userid, $passwd, $DBName);	
	$DA=New database($userid, $passwd, $DBName);	
 	$DC=New database($userid, $passwd, $DBName);
	$today = date("d F Y"); 

if ($submit=='Lanjut') {
	$bli="select kodepenyakit, namapenyakit from $DBUser.tabel_999_jenis_penyakit ".
	     "order by kodepenyakit";
	$DB->parse($bli);
	$DB->execute();
  while ($arr=$DB->nextrow()) {
	  $kdstatus= "S_".$arr["KODEPENYAKIT"];
		$ndokter = "N_".$arr["KODEPENYAKIT"];
		$adokter = "A_".$arr["KODEPENYAKIT"];
		$ppenyakit = "P_".$arr["KODEPENYAKIT"];
		$kodepenyakit =$arr["KODEPENYAKIT"];
		$kdstatussakit=$$kdstatus;  
		$namadokter   =$$ndokter;
		$alamatdokter =$$adokter;
		$namapenyakitlain = $$ppenyakit;
		
		$qry="select kdstatussakit, namadokter, alamatdokter from $DBUser.tabel_118_klien_penyakit ".
	 	     "where noklien='$klienno' and kodepenyakit='".$arr["KODEPENYAKIT"]."'";
		$DC->parse($qry);
		$DC->execute();

		if ($has=$DC->nextrow()) {
			if ($kdstatussakit=='Y') {
	      $sql="update $DBUser.tabel_118_klien_penyakit ".
		         "set kdstatussakit='$kdstatussakit',namadokter='$namadokter',alamatdokter='$alamatdokter',namapenyakitlain='$namapenyakitlain' ".
		 		     "where noklien='$klienno' and kodepenyakit='$kodepenyakit'";
			} else {
	      $tut="update $DBUser.tabel_118_klien_penyakit ".
		         "set kdstatussakit='$kdstatussakit',namadokter=NULL,alamatdokter=NULL,namapenyakitlain=NULL ".
		 		     "where noklien='$klienno' and kodepenyakit='$kodepenyakit'";
				$DA->parse($tut);
				$DA->execute();
				$DA->commit();

		  	$sql="delete from $DBUser.tabel_118_klien_penyakit ".
						 "where noklien='$klienno' and kdstatussakit='N'";
			}
  	} else {
	    if ($kdstatussakit=='Y') {
	      $sql="insert into $DBUser.tabel_118_klien_penyakit ".
		         "(noklien,kodepenyakit,kdstatussakit,namadokter,alamatdokter,namapenyakitlain) ".
	 	         "values ('$klienno','$kodepenyakit','$kdstatussakit','$namadokter','$alamatdokter','$namapenyakitlain')";
			}
	  }
	  //echo $sqa."<br>";
	  $DA->parse($sql);
    $DA->execute();
 	  $DA->commit();
	}

	 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	 echo "window.location.replace('skk3b.php?noproposal=".$proposalno."&tglmutasi=".$tglmutasi."&jnscari=".$jnscari."')";
   echo "</script>";		 
} else {

$sql="select ". 
          "a.notertanggung, ".
					"b.namaklien1,".
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
//echo $sql;
?>
<html>
<head>
<title>Data Kesehatan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<form name="skk3a" method="post" action="skk3a.php">
<input type="hidden" name="klienno" value=<? echo $noklien; ?>>
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
          <td width="100%" class="hijao" align="center">R I W A Y A T&nbsp;&nbsp;&nbsp;&nbsp;K E S E H A T A N&nbsp;&nbsp;&nbsp;&nbsp;T E R T A N G G U N G</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Pilih Jenis Penyakit Yang Pernah Diderita, Masukkan Nama dan Alamat Dokter Yang Merawatnya</td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
      <table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr class="hijao">
					<td width="6%"  align="center" >Kode</td>
					<td width="21%"  align="left" >Nama Penyakit</td>
					<td width="1%"  align="right" ></td>
					<td width="18%"  align="center" >Keterangan</td>
					<td width="25%"  align="left" >Nama Dokter</td>
					<td width="29%"  align="left" >Alamat Dokter</td>
				</tr>
        <?
        	$sql="select a.kodepenyakit, a.namapenyakit, b.kdstatussakit, b.namadokter, b.alamatdokter,b.namapenyakitlain ".
        			 "from $DBUser.tabel_999_jenis_penyakit a, $DBUser.tabel_118_klien_penyakit b ".
        			 "where a.kodepenyakit=b.kodepenyakit(+) and b.noklien(+)='$noklien' ".
        			 "order by a.kodepenyakit";
          $DB->parse ($sql);
          $DB->execute();
          $i=1;
          while ($arr=$DB->nextrow()) {
        	  include "../../includes/belang.php";	 
        	  $namadokter="<input class=c type=\"text\" name=\"N_".$arr["KODEPENYAKIT"]."\" size=\"23\" maxlength=\"50\" onfocus=\"highlight(event)\" value=\"".$arr["NAMADOKTER"]."\">";
        	  $alamatdokter="<input class=c type=\"text\" name=\"A_".$arr["KODEPENYAKIT"]."\" size=\"27\" maxlength=\"50\" onfocus=\"highlight(event)\" value=\"".$arr["ALAMATDOKTER"]."\">";
        		if ($arr["KDSTATUSSAKIT"]=='Y') {
              $input="<input type=\"radio\" value=\"Y\" checked name=\"S_".$arr["KODEPENYAKIT"]."\">Ya &nbsp;&nbsp;&nbsp;&nbsp;".
        		    	   "<input type=\"radio\" value=\"N\" name=\"S_".$arr["KODEPENYAKIT"]."\">Tidak";				
          	} else {
              $input="<input type=\"radio\" value=\"Y\" name=\"S_".$arr["KODEPENYAKIT"]."\">Ya &nbsp;&nbsp;&nbsp;&nbsp;".
        			       "<input type=\"radio\" value=\"N\" checked name=\"S_".$arr["KODEPENYAKIT"]."\">Tidak";				
        	  }
        		echo "<td width=\"6%\" class=\"arial10\" align=\"center\" valign=top>".$arr["KODEPENYAKIT"].".</td>";
        		echo "<td width=\"21%\" class=\"arial10\" align=\"left\">".$arr["NAMAPENYAKIT"]." ".($arr["KODEPENYAKIT"]==99 ? "<input type=text size=20 name=P_".$arr["KODEPENYAKIT"]." value=\"".$arr["NAMAPENYAKITLAIN"]."\">" : "")."</td>";
        		echo "<td width=\"1%\" class=\"arial8\" align=\"right\">:</td>";
        		echo "<td width=\"18%\" class=\"arial8ab\" align=\"center\">".$input."</td>";
        		echo "<td width=\"25%\" class=\"arial8ab\" align=\"left\">".$namadokter."</td>";
        		echo "<td width=\"29%\" class=\"arial8ab\" align=\"left\">".$alamatdokter."</td>";
        		echo "</tr>";
        	  $i++;
          }			
        ?>
			</table><p>&nbsp;</p>
    </td>
  </tr>
</table>
<table border="0" width="700" align="center">
  <tr>
    <td align="left" class="arial10"><a href="skk2.php?noproposal=<? echo $noproposal; ?>">Back</a></td>
	  <td colspan="2" align="right">
      <input type="hidden" name="klienno" value=<? echo $noklien; ?>>
			<input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
			<input type="hidden" name="tglmutasi" value=<?=$tglmutasi;?>>
			<input type="hidden" name="jnscari" value=<?=$jnscari;?>>
		  <input type="submit" name="submit" value="Lanjut">
		</td>
  </tr>
	</table>
</form>

</body>
</html>
<?}?>
