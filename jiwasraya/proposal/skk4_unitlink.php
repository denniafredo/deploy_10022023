<?
  include "../../includes/session.php"; 
  include "../../includes/database.php"; 
  $DB=New database($userid, $passwd, $DBName);	
	$DA=New database($userid, $passwd, $DBName);	
  $today = date("d F Y"); 

if ($submit=='Lanjut') {
	$sql="select kditem from $DBUser.tabel_999_item_kesehatan order by kditem";
	$DB->parse($sql);
	$DB->execute();
	while ($arr=$DB->nextrow()) {
	  $var    = "_".$arr["KDITEM"];
		$kditem = $arr["KDITEM"];
		$isivar = $$var;
    $DC=New database($userid, $passwd, $DBName);
		if (strlen($arr["KDITEM"])==3) {
	    $qry="select kdstatus from $DBUser.tabel_119_ket_kesehatan ".
		   	   "where noklien='$klienno' and kditem='".$arr["KDITEM"]."' ";
	  } else if (strlen($arr["KDITEM"])==4) {
	    $qry="select keterangan from $DBUser.tabel_119_ket_kesehatan ".
		   	   "where noklien='$klienno' and kditem='".$arr["KDITEM"]."' ";
	  }
		$DC->parse($qry);
		$DC->execute();
		if (!$has=$DC->nextrow()) {
	    if (strlen($arr["KDITEM"])==2) {
			
			  $sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				$DA->parse($sqa);
	  		$DA->execute();
					 
		    $sqa="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan) ".
		   	     "values ('$klienno','$kditem',NULL,NULL)";
	    } else if (strlen($arr["KDITEM"])==3) {
				if ($isivar=='Y') {
					$sqa ="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan) ".
							 "values ('$klienno','$kditem','$isivar',NULL)";
				} else if ($isivar=='N') {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				}
	    } else if (strlen($arr["KDITEM"])==4) {
				if ($isivar==NULL) {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				} else {
					$sqa ="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan) ".
							 "values ('$klienno','$kditem',NULL,'$isivar')";
				}
		  }
	  } else {
	    if (strlen($arr["KDITEM"])==3) {
				if ($isivar=='Y') {
					$sqa ="update $DBUser.tabel_119_ket_kesehatan set kdstatus='$isivar' ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				} else if ($isivar=='N') {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				}
	    } else if (strlen($arr["KDITEM"])==4) {
				if ($isivar==NULL) {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				} else {
					$sqa ="update $DBUser.tabel_119_ket_kesehatan set keterangan='$isivar' ".
							 "where noklien='$klienno' and kditem='$kditem' ";
				}
  		}			 
		} 
		$DA->parse($sqa);
	  $DA->execute();
	 	$DA->commit();
	}
	 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	 echo "window.location.replace('skk4b_unitlink.php?noproposal=".$proposalno."&tglmutasi=".$tglmutasi."&jnscari=".$jnscari."')";
   echo "</script>";
}
//else 
//{	

$noproposal = isset($proposalno) ? $proposalno : $noproposal;
$sql="select ". 
          "a.notertanggung, ".
					"b.namaklien1,".
					"b.jeniskelamin,".
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
<table align="center" border="0" width="80%" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" width="100%"  cellpadding="0" cellspacing="0">
        <tr>
				  <td colspan="2" class="arial10">Nomor Proposal</td>
					<td class="arial10" align="center">:</td>
          <td class="verdana10blkb"><?echo $kantor." - ".$noproposal;?></td><br>
				  <td colspan="3" class="verdana8" align="center">Isian Dijawab Dengan Lengkap dan Benar</td>
				</tr>
        <tr>
					<td colspan="2" class="arial10">Tanggal Entry</td>
					<td class="arial10" align="center">:</td>
          <td class="verdana10blkb"><?echo $today;?></td>
        	<td colspan="3" class="verdana8" align="center"></td>
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
          <td width="100%" class="hijao" align="center">RIWAYAT KESEHATAN TERTANGGUNG (3)</td>
			  </tr>
        <tr>
          <td width="100%" class="verdana8" align="center">Isilah Formulir Isian Kesehatan dengan Jujur.</td>
        </tr>				
        <tr>
          <td><hr size="1"></td>
        </tr>
      </table>
      <table border="0" width="100%" cellpadding="0" cellspacing="1">
				<tr>
					<td class="c" align="center">Kode</td>
					<td class="c" align="center">Pertanyaan</td>
					<td class="c" align="center">Jawaban</td>
				</tr>
      <?
      	//if ($KLIEN->jeniskelamin=='L') {
				/*
      	if ($jnskelamin=='L') {
        	$wanita = "and substr(a.kditem,0,1) in ('1','2','3') ";
      	} else {
        	$wanita = '';
      	}		 
      	$sql="select a.kditem, a.namaitem, b.kdstatus, b.keterangan ".
      		 	 "from $DBUser.tabel_999_item_kesehatan a, $DBUser.tabel_119_ket_kesehatan b ".
      			 "where a.kelompok='T' and a.kditem=b.kditem(+) and b.noklien(+)='$noklien' and substr(a.kditem,0,1) < 5 ".
      		 	 $wanita.
      		 	 "order by a.kditem";
				*/
				$sql="select a.kditem, a.namaitem, b.kdstatus, b.keterangan ".
      		 	 "from $DBUser.tabel_999_item_kesehatan a, $DBUser.tabel_119_ket_kesehatan b ".
      			 "where a.kelompok='U' and a.kditem=b.kditem(+) and b.noklien(+)='$noklien' ".
						 "and substr(a.kditem,2,1) > '2' ".
      		 	 "order by a.kditem";
      	$DB->parse ($sql);
      	$DB->execute();
				//echo $sql; 
      $i=1;
      while ($arr=$DB->nextrow()) {
      	include "../../includes/belang.php";	 
      	if (strlen($arr["KDITEM"])==2) {
      		$kelas="arial10bold";
      		$col=2;
      		$align="center";
      	  $input='';
      	} else if  (strlen($arr["KDITEM"])==3) {
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
      	} else if (strlen($arr["KDITEM"])==4) {
      		$kelas="arial10";
      		$col='';
      		$align="right";
      	  $input=": <input class=c type=\"text\" name=\"_".$arr["KDITEM"]."\" size=\"40\" maxlength=\"50\" onfocus=\"highlight(event)\" value=\"".$arr["KETERANGAN"]."\">";
      	} 
				if(substr($arr["KDITEM"],0,2)=="*9")
				{
				  $nomor = "10";
				} else {
				  $nomor = substr($arr["KDITEM"],-1);
				}
        echo "<td class=\"$kelas\" valign=top align=\"$align\">".(strlen($arr["KDITEM"])==2 ? "".$nomor."" : "")."&nbsp;&nbsp;</td>";
        echo "<td class=\"$kelas\" colspan=\"$col\">".(strlen($arr["KDITEM"])==4 ? "".substr($arr["KDITEM"],-1).".&nbsp;&nbsp;" : "")."".$arr["NAMAITEM"]."</td>";
        echo "<td class=\"$kelas\">".$input."</td>";
        echo "</tr>";
        $i++;
      }			
      ?>
			</table><p>&nbsp;</p>
    </td>
  </tr>
</table>
<table width="100%" align="center" border="0">
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
<?//}?>
