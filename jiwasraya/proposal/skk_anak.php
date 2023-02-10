<?
  include "../../includes/database.php"; 
	include "../../includes/klien.php";
  include "../../includes/session.php"; 
  $DB=New database($userid, $passwd, $DBName);	
	$DA=New database($userid, $passwd, $DBName);	
	
  $today = date("d F Y"); 
	$noklien = $klienno;
	$KL = New Klien ($userid,$passwd,$noklien);
	
		
if ($submit=='Simpan') {
	$sql="select kditem from $DBUser.tabel_999_item_kesehatan  where substr(kditem,0,1) > 4 order by kditem";
	$DB->parse($sql);
	$DB->execute();
	while ($arr=$DB->nextrow()) {
	  $var    = "_".$arr["KDITEM"];
		$kditem = $arr["KDITEM"];
		$isivar = $$var;
    $DC=New database($userid, $passwd, $DBName);
		if (strlen($arr["KDITEM"])==2) {
	    $qry="select kdstatus from $DBUser.tabel_119_ket_kesehatan ".
		   	   "where noklien='$klienno' and kditem='".$arr["KDITEM"]."' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
	  } else if (strlen($arr["KDITEM"])==3) {
	    $qry="select keterangan from $DBUser.tabel_119_ket_kesehatan ".
		   	   "where noklien='$klienno' and kditem='".$arr["KDITEM"]."' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi' ";
	  } else if (strlen($arr["KDITEM"])==4) {
	    $qry="select keterangan from $DBUser.tabel_119_ket_kesehatan ".
		   	   "where noklien='$klienno' and kditem='".$arr["KDITEM"]."' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi' ";
	  }
		//echo $qry."<br><br>";
		$DC->parse($qry);
		$DC->execute();
		if (!$has=$DC->nextrow()) {
		  /*
	    if (strlen($arr["KDITEM"])==1) {
		    $sqa="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan) ".
		   	     "values ('$klienno','$kditem',NULL,NULL)";
				
	    } else 
			*/
			if (strlen($arr["KDITEM"])==2) {
				if ($isivar=='Y') {
					$sqa ="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan,kdmutasi,tglmutasi) ".
							 "values ('$klienno','$kditem','$isivar',NULL,'21',to_date('$tglmutasi','DD/MM/YYYY'))";
				} else if ($isivar=='N') {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi' ";
				}
				//echo $sqa."<br><br>";
				
	    } else if (strlen($arr["KDITEM"])==3) {
				if ($isivar==NULL) {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi' ";
				} else {
					$sqa ="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan,kdmutasi,tglmutasi) ".
							 "values ('$klienno','$kditem',NULL,'$isivar','21',to_date('$tglmutasi','DD/MM/YYYY'))";
				}
				//echo $sqa."<br><br>";
		  
			} else if (strlen($arr["KDITEM"])==4) {
				if ($isivar==NULL) {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				} else {
					$sqa ="insert into $DBUser.tabel_119_ket_kesehatan (noklien,kditem,kdstatus,keterangan,kdmutasi,tglmutasi) ".
							 "values ('$klienno','$kditem',NULL,'$isivar','21',to_date('$tglmutasi','DD/MM/YYYY'))";
				}
				//echo $sqa."<br><br>";
		  }
			
	  } else {
	    if (strlen($arr["KDITEM"])==2) {
				if ($isivar=='Y') {
					$sqa ="update $DBUser.tabel_119_ket_kesehatan set kdstatus='$isivar' ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				} else if ($isivar=='N') {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				}
	    } else if (strlen($arr["KDITEM"])==3) {
				if ($isivar==NULL) {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				} else {
					$sqa ="update $DBUser.tabel_119_ket_kesehatan set keterangan='$isivar' ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				}
  		} else if (strlen($arr["KDITEM"])==4) {
				if ($isivar==NULL) {
					$sqa ="delete from $DBUser.tabel_119_ket_kesehatan ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				} else {
					$sqa ="update $DBUser.tabel_119_ket_kesehatan set keterangan='$isivar' ".
							 "where noklien='$klienno' and kditem='$kditem' and kdmutasi='21' and to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi'";
				}
  		}		 
		} 
		$DA->parse($sqa);
	  $DA->execute();
	 	$DA->commit();
		//echo $sqa;
	}
	
	
	 echo "<script language=\"JavaScript\" type=\"text/javascript\">";
	 echo "window.location.replace('skk_anak.php?klienno=".$klienno."&tglmutasi=".$tglmutasi."')";
	 //echo "window.location.replace('entryskkanak.php')";
   echo "</script>";
	
} else {	

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
		      "b.noklien='$klienno'";
					//"a.nopertanggungan='$noproposal'";
					//echo $sql;
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
<table align="center" border="0" width="700" cellpadding="1" cellspacing="2" class="tblhead">
  <tr>
    <td width="100%" class="tblisi">
      <table border="0" cellpadding="2" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber2">
        <tr>
          <td colspan="3" class="verdana10blk" ><B>ANAK YANG DIBEASISWAKAN</B></td>
			  </tr>
				<tr>
          <td class="verdana10blk">Nama</td>
          <td class="verdana10blk">:</td>
          <td class="verdana10blk"><?=$KL->nama; ?></td>
        </tr>
        <tr>
          <td class="verdana10blk">Jenis Kelamin</td>
          <td class="verdana10blk">:</td>
          <td class="verdana10blk"><?=$KL->namajk; ?></td>
        </tr>
        <tr>
          <td class="verdana10blk">Tempat dan tanggal lahir</td>
          <td class="verdana10blk">:</td>
          <td class="verdana10blk"><?=$KL->tempatlahir.", ".$KL->tgllahir; ?></td>
        </tr>
        <tr>
          <td class="verdana10blk">Berat badan, tinggi badan</td>
          <td class="verdana10blk">:</td>
          <td class="verdana10blk"><?=$KL->berat." kg, ".$KL->tinggi." cm"; ?> </td>
        </tr>
				<!--
        <tr>
          <td class="verdana10blk">Anak tertanggung ke</td>
          <td class="verdana10blk">:</td>
          <td class="verdana10blk"><input type="text" name="anakke" size="5" maxlength="2"></td>
        </tr>
				-->
      </table>

			<br>
      <!--
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
			-->
      <table border="0" width="100%" cellpadding="2" cellspacing="0">
			  <tr>
          <td colspan="2" class="hijao" align="center">FORMULIR ISIAN</td>
			  </tr>
				
				<tr>
					<!--<td width="5%" class="c" align="center">Kode</td>-->
					<td width="45%" class="c" align="center">Pertanyaan</td>
					<td width="50%" class="c" align="center">Jawaban</td>
				</tr>
      <?
      	//if ($KLIEN->jeniskelamin=='L') {
      	if ($jnskelamin=='L') {
        	$wanita = "and substr(a.kditem,0,1) in ('1','2','3') ";
      	} else {
        	$wanita = '';
      	}		 
				
 
				$sql = "select a.kditem, a.namaitem, b.kdstatus, b.keterangan ".
                "from ".
                "$DBUser.tabel_999_item_kesehatan a,".
                "(select ".
                  "kditem,noklien,kdstatus,keterangan,kdmutasi,tglmutasi ".
                "from ".
                  "$DBUser.tabel_119_ket_kesehatan  ".
                "where ".
                  "noklien='$klienno' and ".
                  "to_char(tglmutasi,'DD/MM/YYYY')='$tglmutasi') b ".
                "where ".
                  "a.kditem=b.kditem(+) and b.noklien(+)='$klienno' and ".
                  "substr(a.kditem,0,1) > 4 order by a.kditem";

      	$DB->parse ($sql);
      	$DB->execute();
				//echo $sql; 
      $i=1;
      while ($arr=$DB->nextrow()) {
      	include "../../includes/belang.php";	 
      	if (strlen($arr["KDITEM"])==1) {
      		$kelas="arial10bold";
      		$col=2;
      		$align="left";
      	  $input='';
      	} else if  (strlen($arr["KDITEM"])==2) {
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
      	} else if (strlen($arr["KDITEM"])==3) {
      		$kelas="arial10";
      		$col='';
      		$align="right";
					if($arr["KDITEM"]=="70A")
					{
					  $input="";
					}
					else
					{
      	    $input=": <input class=c type=\"text\" name=\"_".$arr["KDITEM"]."\" size=\"40\" maxlength=\"50\" onfocus=\"highlight(event)\" value=\"".$arr["KETERANGAN"]."\">";
      		}
				} else if (strlen($arr["KDITEM"])==4) {
      		$kelas="arial10";
      		$col='';
      		$align="right";
      	  $input= ($arr["KETERANGAN"]!="" ? "<input type=\"checkbox\" name=\"_".$arr["KDITEM"]."\" value=\"".$arr["NAMAITEM"]."\" checked> ".$arr["NAMAITEM"]."" : "<input type=\"checkbox\" name=\"_".$arr["KDITEM"]."\" value=\"".$arr["NAMAITEM"]."\"> ".$arr["NAMAITEM"]."");
      	} 
        //echo "<td width=\"5%\" class=\"$kelas\" align=\"$align\">".substr($arr["KDITEM"],-1)."&nbsp;&nbsp;</td>";
        if (strlen($arr["KDITEM"])==4) {
				 echo "<td width=\"45%\" class=\"$kelas\" colspan=\"$col\"></td>";
        }
				else
				{
				 echo "<td width=\"45%\" class=\"$kelas\" colspan=\"$col\">".$arr["NAMAITEM"]."</td>";
        }
				echo "<td width=\"50%\" class=\"$kelas\">".$input."</td>";
        echo "</tr>";
        $i++;
      }			
      ?>
			</table><p>&nbsp;</p>
    </td>
  </tr>
</table>
<table width="700" align="center" border="0">
  <tr>
    <td align="left" class="arial10"><a href="entryskkanak">Back</a></td>
	  <td align="right">
			<input type="hidden" name="noklien" value=<? echo $noklien; ?>>
			<input type="hidden" name="klienno" value=<? echo $klienno; ?>>
			<input type="hidden" name="tglmutasi" value=<? echo $tglmutasi; ?>>
			<input type="hidden" name="proposalno" value=<? echo $noproposal; ?>>
		  <input type="submit" name="submit" value="Simpan">
		</td>
  </tr>
	<tr>
	</tr>
</table>
</form>
</body>
</html>
<?}?>
