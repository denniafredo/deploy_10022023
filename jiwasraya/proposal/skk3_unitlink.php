<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
	
  $DB=New database($userid, $passwd, $DBName);	
	$DA=New database($userid, $passwd, $DBName);	
 	$DC=New database($userid, $passwd, $DBName);
	$today = date("d F Y"); 

if ($submit=='Lanjut') {

	$bli="select kditem, namaitem from $DBUser.tabel_999_item_kesehatan ".
			 "where kelompok='U' and substr(kditem,0,2)='#2' and kditem<>'#2' ".
       "order by kditem";
	//echo $bli;
	$DB->parse($bli);
	$DB->execute();
  while ($arr=$DB->nextrow()) {
	  $kdstatus= "S_".$arr["KDITEM"];
		$ndokter = "N_".$arr["KDITEM"];
		$adokter = "A_".$arr["KDITEM"];
		$ppenyakit = "P_".$arr["KDITEM"];
		$tsakit 	 = "T_".$arr["KDITEM"];
		
		$kditem = $arr["KDITEM"];
		$kdstatussakit= $$kdstatus;  
		$namadokter   = $$ndokter;
		$alamatdokter = $$adokter;
		$namapenyakit = $$ppenyakit;
		$tglsakit 		= $$tsakit;
		
		$qry="select kdstatus, namadokter, alamatdokter from $DBUser.tabel_119_ket_kesehatan ".
	 	     "where noklien='$klienno' and kditem='".$arr["KDITEM"]."'";
		$DC->parse($qry);
		$DC->execute();

		if ($has=$DC->nextrow()) {
			if ($kdstatussakit=='Y') {
	      $sql="update $DBUser.tabel_119_ket_kesehatan ".
		         "set kdstatus='$kdstatussakit',namadokter='$namadokter',alamatdokter='$alamatdokter',keterangan='$namapenyakit', ".
						 "tglmutasi=to_date('$tglsakit','DD/MM/YYYY') ".
		 		     "where noklien='$klienno' and kditem='$kditem'";
			} else {
	      $tut="update $DBUser.tabel_119_ket_kesehatan ".
		         "set kdstatus='$kdstatussakit',namadokter=NULL,alamatdokter=NULL,keterangan=NULL,tglmutasi=NULL ".
		 		     "where noklien='$klienno' and kditem='$kditem'";
				$DA->parse($tut);
				$DA->execute();
				$DA->commit();

		  	$sql="delete from $DBUser.tabel_119_ket_kesehatan where noklien='$klienno' and kdstatus='N'";
			}
  	} else {
	    if ($kdstatussakit=='Y') {
	      $sql="insert into $DBUser.tabel_119_ket_kesehatan ".
		         "(noklien,kditem,kdstatus,namadokter,alamatdokter,keterangan,tglmutasi) ".
	 	         "values ('$klienno','$kditem','$kdstatussakit','$namadokter','$alamatdokter','$namapenyakit',to_date('$tglsakit','DD/MM/YYYY'))";
			}
	  }
	  //echo $sql."<br>";
	  $DA->parse($sql);
    $DA->execute();
 	  $DA->commit();
		
	}
  
	echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	echo "window.location.replace('skk4_unitlink.php?noproposal=".$proposalno."&tglmutasi=".$tglmutasi."&jnscari=".$jnscari."')";
  echo "</script>";		 
	
} 

$noproposal = isset($proposalno) ? $proposalno : $noproposal;

$sql="select ". 
          "a.notertanggung, ".
					"b.namaklien1,".
					"decode(b.jeniskelamin,'L','Laki-laki','Perempuan') namajk ".
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
?>
<html>
<head>
<title>Data Kesehatan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
</head>
<body>
<form name="skk3a" method="post" action="<?=$PHP_SELF;?>">
<input type="hidden" name="klienno" value=<? echo $noklien; ?>>
<table align="center" border="0" width="100%" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td colspan="2" class="arial10">Nomor Proposal</td>
					<td class="arial10" align="center">:</td>
          <td class="verdana10blkb"><?echo $kantor." - ".$noproposal;?></td><br>
				  <td colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar,</td>
				</tr>
        <tr>
					<td colspan="2" class="arial10">Tanggal Entry</td>
					<td class="arial10" align="center">:</td>
          <td class="verdana10blkb"><?echo $today;?></td>
        	<td colspan="3" class="verdana8" align="center">Pilih status yang sesuai pada kolom keterangan.</td>
				</tr>
        <tr>
					<td colspan="2" class="arial10">Tertanggung</td>
					<td class="arial10" align="center">:</td>
          <td class="verdana10blkb" align="left"><?=$namaklien;?></td>
          <td colspan="3" class="verdana8" align="center"></td>
        </tr>
        <tr>
          <td colspan="2" class="arial10">Jenis Kelamin</td>
					<td class="arial10" align="center">:</td>
          <td class="verdana10blkb" align="left"><?=$ttg["NAMAJK"];?></td>
         <td colspan="3" class="verdana8" align="center"></td>
        </tr>				
      </table>
      <table border="0" width="100%">
        <tr>
          <td width="100%" class="hijao" align="center">R I W A Y A T&nbsp;&nbsp;&nbsp;&nbsp;K E S E H A T A N&nbsp;&nbsp;&nbsp;&nbsp;T E R T A N G G U N G (2)</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8">
					<? 
					$sql = "select namaitem from $DBUser.tabel_999_item_kesehatan a where  kditem='#2' ";
      		$DB->parse ($sql);
      	  $DB->execute();
				  $arr=$DB->nextrow();
					echo $arr["NAMAITEM"];
					?>
					</td>
        </tr>				
      </table>
      <table border="0" width="100%" cellpadding="2" cellspacing="0">
        <tr class="hijao">
					<td>Kode</td>
					<td>Nama Penyakit</td>
					<td></td>
					<td>Keterangan</td>
					<td>Nama Penyakit</td>
					<td>Tgl. Sakit</td>
					<td>Nama Dokter</td>
					<td>Alamat Dokter</td>
				</tr>
        <?
				$sql="select ".
								"a.kditem, a.namaitem, b.kdstatus, b.keterangan,b.namadokter,b.alamatdokter,".
								"to_char(b.tglmutasi,'DD/MM/YYYY') as tglsakit ".
      		 	 "from ".
						 		"$DBUser.tabel_999_item_kesehatan a, ".
								"$DBUser.tabel_119_ket_kesehatan b ".
      			 "where ".
						    "a.kelompok='U' and a.kditem=b.kditem(+) and b.noklien(+)='$noklien' ".
								"and substr(a.kditem,0,2)='#2' ".
								"and a.kditem<>'#2' ".
      		 	 "order by a.kditem";
      	  $DB->parse ($sql);
      	  $DB->execute();
				  //echo $sql; 
          $i=1;
          while ($arr=$DB->nextrow()) {
        	  include "../../includes/belang.php";	 
        	  $fnamapenyakit="<input class=c type=\"text\" name=\"P_".$arr["KDITEM"]."\" size=\"20\" onfocus=\"highlight(event)\" value=\"".$arr["KETERANGAN"]."\">";
        	  $ftglsakit="<input class=c type=\"text\" name=\"T_".$arr["KDITEM"]."\" size=\"10\" onfocus=\"highlight(event)\" value=\"".$arr["TGLSAKIT"]."\">";
        	  $fnamadokter="<input class=c type=\"text\" name=\"N_".$arr["KDITEM"]."\" size=\"20\" onfocus=\"highlight(event)\" value=\"".$arr["NAMADOKTER"]."\">";
        	  $falamatdokter="<input class=c type=\"text\" name=\"A_".$arr["KDITEM"]."\" size=\"20\" onfocus=\"highlight(event)\" value=\"".$arr["ALAMATDOKTER"]."\">";
        		if ($arr["KDSTATUS"]=='Y') {
              $input="<input type=\"radio\" value=\"Y\" checked name=\"S_".$arr["KDITEM"]."\">Ya &nbsp;&nbsp;&nbsp;&nbsp;".
        		    	   "<input type=\"radio\" value=\"N\" name=\"S_".$arr["KDITEM"]."\">Tidak";				
          	} else {
              $input="<input type=\"radio\" value=\"Y\" name=\"S_".$arr["KDITEM"]."\">Ya &nbsp;&nbsp;&nbsp;&nbsp;".
        			       "<input type=\"radio\" value=\"N\" checked name=\"S_".$arr["KDITEM"]."\">Tidak";				
        	  }
        		echo "<td class=\"arial10\" align=\"center\" valign=top>".substr($arr["KDITEM"],2,1).".</td>";
        		echo "<td class=\"arial10\" align=\"left\">".$arr["NAMAITEM"]."</td>";
        		echo "<td class=\"arial8\" align=\"right\">:</td>";
        		echo "<td class=\"arial8ab\" align=\"center\" nowrap>".$input."</td>";
        		echo "<td class=\"arial8ab\" align=\"left\">".$fnamapenyakit."</td>";
						echo "<td class=\"arial8ab\" align=\"left\">".$ftglsakit."</td>";
						echo "<td class=\"arial8ab\" align=\"left\">".$fnamadokter."</td>";
        		echo "<td class=\"arial8ab\" align=\"left\">".$falamatdokter."</td>";
        		echo "</tr>";
        	  $i++;
          }			
        ?>
			</table>
			<p>&nbsp;</p>
    </td>
  </tr>
</table>
<table border="0" width="100%" align="center">
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

