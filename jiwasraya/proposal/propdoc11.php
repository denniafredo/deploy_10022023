<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";
	
	$DB=new database($userid, $passwd, $DBName);
	$prefixpertanggungan=$kantor;
	
	$sql = "select a.kdvaluta,a.prefixpertanggungan ".
			   "from $DBUser.tabel_200_pertanggungan a ".
			 	 "where a.nopertanggungan='$nopertanggungan'";
	$DB->parse($sql);
	$DB->execute();
	$arr = $DB->nextrow();
	if ($arr["PREFIXPERTANGGUNGAN"]<>$kantor){
	  print ("<font face=Verdana size=3><b>Nomor Proposal ".$nopertanggungan." bukan dari kantor ".$kantor."</b></font><br>");
  	print( "Anda tidak berhak melakukan Update terhadap Proposal ini <br>" );
  	print( "<a href=\"#\" onclick=\"javascript:history.go(-1)\"><font size=\"2\" face=\"Verdana\">Back</font></a>\n" );
		die;
	} else {
	  $val=$arr["KDVALUTA"];
	}
	

  if($insert=="Insert") {
    $sql="insert into $DBUser.tabel_212_dok_cek_uw (prefixpertanggungan,nopertanggungan,kddokunderwriting,kdstatusunderwriting) ".
         "values ('$prefixpertanggungan','$nopertanggungan','$kddokunderwriting','$kdstatusunderwriting')";
	  $DB->parse($sql);
	  $DB->execute();
	} else if ($update=="Update"){
	  $sql="select kddokunderwriting,kdstatusunderwriting ".
	       "from $DBUser.tabel_212_dok_cek_uw ".
	       "where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan'";
	  $DB->parse($sql);
	  $DB->execute();
		$res = $DB->result();
		foreach ($res as $foo => $data) {
	    $kddokunderwriting=$data["KDDOKUNDERWRITING"];
			$newstatus = ${"kdstatus".$kddokunderwriting};
	    $sql="update $DBUser.tabel_212_dok_cek_uw ".
	         "set kdstatusunderwriting='$newstatus' ".
					 "where nopertanggungan='$nopertanggungan' and ".
					 "prefixpertanggungan='$prefixpertanggungan' and kddokunderwriting='$kddokunderwriting'";
		  $DB->parse($sql);
			$DB->execute();
    
		  //echo "<br>".$sql."<br>";
		}
	  $DB->commit();
		//-------------------------------- UPDATE STATUS EMAIL -------------------	
		  	     $query= "update $DBUser.tabel_200_pertanggungan set ".
	                   "kdstatusemail=NULL where prefixpertanggungan='$kantor' and nopertanggungan='$nopertanggungan'";
             $DB->parse($query);
             $DB->execute();
	           $DB->commit();
						 //echo $query;
		//-------------------------------- end update status email -------------------
		
	} else if ($delete=="Delete"){
	  $sql="select kddokunderwriting,kdstatusunderwriting ".
	       "from $DBUser.tabel_212_dok_cek_uw ".
	       "where nopertanggungan='$nopertanggungan' and prefixpertanggungan='$prefixpertanggungan'";
	  $DB->parse($sql);
	  $DB->execute();
		$res = $DB->result();
		foreach ($res as $foo => $data) {
	    $kddokunderwriting=$data["KDDOKUNDERWRITING"];
			if (${$kddokunderwriting} == "ON") {
		    $sql="delete from $DBUser.tabel_212_dok_cek_uw ".
	           "where nopertanggungan='$nopertanggungan' and ".
						 "prefixpertanggungan='$prefixpertanggungan' and kddokunderwriting='$kddokunderwriting'";
		    $DB->parse($sql);
			  $DB->execute();
		  }
    }
	  $DB->commit();
		//-------------------------------- UPDATE STATUS EMAIL -------------------	
		  	     $qry= "update $DBUser.tabel_200_pertanggungan set ".
	                 "kdstatusemail=NULL where prefixpertanggungan='$kantor' and nopertanggungan='$nopertanggungan'";
             $DB->parse($qry);
             $DB->execute();
	           $DB->commit();
		//-------------------------------- end update status email -------------------
	}
	$sql  = "select a.kddokunderwriting,a.kdstatusunderwriting,b.namadokunderwriting,nvl(a.ld,'0') ld ".
	        "from $DBUser.tabel_212_dok_cek_uw a, $DBUser.tabel_217_kode_dok_uw b ".
	        "where a.kddokunderwriting=b.kddokunderwriting and ".
					"a.nopertanggungan='$nopertanggungan' and a.prefixpertanggungan='$prefixpertanggungan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$dokuw=$DB->result();
	
	$sql="select kdstatusunderwriting,namastatusunderwriting from $DBUser.tabel_216_status_uw";
	$DB->parse($sql);
	$DB->execute();		
	$statuw=$DB->result();
	
	
$PER = New Pertanggungan($userid,$passwd,$prefixpertanggungan,$nopertanggungan);	
?>
<html>
<head>
<title>PT Asuransi Jiwa IFG Private Network</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript" type="text/javascript">
</script>
</head>
<body topmargin="0">
<div align="center">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1510</font></td></tr>
</table>
<table border="0" width="800" cellspacing="1" cellpadding="1" class="tblhead">
<tr><td align="center" colspan="4" class="arial12whtb">DOKUMEN PEMERIKSAAN KESEHATAN</td></tr>
<form method="POST" name="propdoc10" action=<? PHP_SELF; ?>>
<tr>
<td align="center" colspan="4" class="tblisi">
<table border="0" width="100%" cellspacing="1" cellpadding="1" class="arial10">
 <tr>
  <td width="20%">No. Proposal</td>
	<td >: <? echo $PER->label; ?></td>
	<td colspan="2" align="right"><b>EDIT</td>
 </tr>
 <tr>
  <td>Pemegang Polis</td>
	<td width="30%">: <? echo $PER->namapemegangpolis; ?></td>
  <td width="20%">Usia</td>
	<td width="30%">: <? echo $PER->usia; ?> tahun, <? echo $PER->usia_bl; ?> bulan</td>
 </tr>
 <tr>
  <td>JUA</td>
	<td>: <? echo $PER->notasi." ".number_format($PER->jua,2); ?>&nbsp;</td>	
  <td>Batas Medical</td>
	<td>: 
	<? 
	$sql="select resikoawal from $DBUser.tabel_226_batas_resiko ".
			 "where ".$PER->usia." >= batasbawah and  ".$PER->usia." <= batasatas ";
	//echo $sql."<br>";
	$DB->parse($sql);
	$DB->execute();
	$res=$DB->nextrow();
	$batasresiko=$res["RESIKOAWAL"];
	echo number_format($batasresiko,2); 
	?>
	</td>	
 </tr>
 <tr>
  <td>Medical Status</td>
	<td>: <?echo $PER->medstat;?></td>	
  <td>Resiko Saat Ini (Rp)</td>
	<td>: <? echo number_format($PER->risk,2); ?></td>	
 </tr>
</table>
</td>
</tr>
</table>
<br>
<table border="0" width="800" cellspacing="1" cellpadding="1" class="tblisi">
  <tr class="hijao">
	<td align="center">No.</th>
	<td align="center">Kode Dokumen</th>
	<td align="center">Nama Dokumen</th>
	<td align="center">Status</th>
	<td align="center">Cek</th>
	</tr>
	<? 
	  $i = 1;
		foreach ($dokuw as $foo => $val) {
			
			$kddokunderwriting = $val["KDDOKUNDERWRITING"];
			$namadokunderwriting = $val["NAMADOKUNDERWRITING"];
			$kdstatusunderwriting = $val["KDSTATUSUNDERWRITING"];
			include "../../includes/belang.php";
			echo("<td align=\"center\" class=\"arial10\">$i</td>");
			echo("<td align=\"center\" class=\"arial10\"> ".$kddokunderwriting."</td>"); 
			echo("<td align=\"left\" class=\"arial10\"><b>".$namadokunderwriting."</td>"); 
		  echo("<td align=\"center\" ><select size=1 name=kdstatus".$kddokunderwriting." class=buton onfocus=\"highlight(event)\">");
		  
			foreach($statuw as $coo => $data) {
        $kdstatusuw = $data["KDSTATUSUNDERWRITING"];
	      $namastatusuw = $data["NAMASTATUSUNDERWRITING"];
	  	  if ($kdstatusunderwriting==$data["KDSTATUSUNDERWRITING"]) {
				 if ($kdstatusunderwriting) {
			    echo("<option value=$kdstatusuw selected class=sudah>$namastatusuw");
				 } else {
				  echo("<option value=$kdstatusuw selected class=belum>$namastatusuw");
				 }	
				} else {
			    echo("<option value=$kdstatusuw>$namastatusuw");
				}	
		  }
			echo("</select></td>"); 
			
			$cebox = ($val["LD"]=='0') ? "<input type=\"checkbox\" name=".$val["KDDOKUNDERWRITING"]." value=\"ON\" title=\"check untuk delete\">" :'<font color=red size=3><b>*';  
			echo("<td align=\"center\">$cebox</td>");
			echo("</tr>");
			$i++;
			
		}
		
		
		if ($i > 1 && $i < 9) {
		 echo("<tr class=arial8>");
		 echo("<td align=\"center\" >$i</td>");
		 echo("<td align=\"center\" ><input type=text name=kddokunderwriting size=3 readonly class=a></td>"); 
		 echo("<td align=\"left\" ><input type=text name=namadokunderwriting size=50 readonly maxlength=50 class=a></td>"); 
		 echo("<td align=\"center\" ><select size=1 name=kdstatusunderwriting class=c onfocus=\"highlight(event)\">");
		 foreach($statuw as $coo => $data) {
		  $kdstatusunderwriting = $data["KDSTATUSUNDERWRITING"];
		  $namastatusunderwriting = $data["NAMASTATUSUNDERWRITING"];
			echo("<option value=$kdstatusunderwriting>$namastatusunderwriting");
		 }
		 echo("</select>"); 
		 echo("</td>"); 
		 echo("<td align=\"center\" ><a href=\"#\" onclick=\"NewWindow('popupdoc.php','popuppage','280','300','yes');return true;\"><img src=\"../img/add.gif\" border=\"0\" alt=\"klik untuk pilih dokumen\"></a></td>");
		 echo("</tr>");
		} elseif ($i==1) {
		
  ?>
	<tr class="verdana10redb"><td colspan="6">TIDAK MEMERLUKAN PEMERIKSAAN DOKUMEN</td></tr>
	<?} else {}?>  
 <tr>
  <td colspan="6" class="arial8"><font color=red size=3><b>*</b></font><font size=2 color=blue> adalah Dokumen yang wajib diisi karena resiko yang dimiliki, Jika ada dokumen lain yang diperlukan dapat diInsert
	</td>
 </tr>
</table>
<br>
<hr size=1>
<table cellpadding="1" cellspacing="1" width="100%">
  <tr class="arial10">
    <td width="25%"><a href="#" onclick="javascript:history.back();">Back</a></td>
		<td width="25%"><a href="../mnuptgbaru.php">Menu Pertanggungan</a></td>
  <td align="right" >
 <? if ($i==1 || $i==9) {
  print( "<input type=\"submit\" name=\"update\" value=\"Update\">\n" );
  print( "<input type=\"submit\" name=\"delete\" value=\"Delete\">" );

  } else {
 ?>			
	  <input type="hidden" name="nopertanggungan" value="<? echo $nopertanggungan; ?>">
    <input type="submit" name="insert" value="Insert">
    <input type="submit" name="update" value="Update">
    <input type="submit" name="delete" value="Delete">
	<? } ?>
	
	</td>
</tr>
</table>
</form>
</body>
</html>
