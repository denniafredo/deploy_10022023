<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/common.php";

 $DB=New Database($userid, $passwd, $DBName);	
 
 if($ganti){
    $ket= strtoupper($ket);
    $sql1="update $DBUser.tabel_file_kantor set tglkirim=to_date('$tglkirim','DD/MM/YYYY'),".
		      "keterangan='$ket' where ".
			 	  "kdkantor='$kdkantor' and nama_file='$namafile'";     
					$DB->parse($sql1);
	        $DB->execute();
					$DB->commit();
		echo "Sudah terupdate....<br> Refresh halaman daftar file kantor untuk melihat perubahannya. ";
 }
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/date.js"></script>
<font face="Verdana" size="2"><b>Update Tanggal Kirim File <? echo $namafile." Kantor ".$kdkantor; ?></b></font>
<hr size="1">
<? 
     $sql="select kdkantor,nama_file,to_char(tglkirim,'DD/MM/YYYY') lastkirim,".
		      "keterangan,penanggungjawab from ".
			    "$DBUser.tabel_file_kantor where kdkantor='$kdkantor' and nama_file='$namafile'";  
					$DB->parse($sql);
	        $DB->execute();
	        $arx=$DB->nextrow();
					$lastkirim=$arx["LASTKIRIM"];
					$ket=$arx["KETERANGAN"];
?>
<table border="0" cellspacing="0" width="100%" bgcolor="#D8E2FC">
  <tr>
   <td bgcolor="#D8E2FC">
   <table border="0" cellspacing="5" bgcolor="#D8E2FC">
   <form method="POST" name="agen" action="<? $PHP_SELF; ?>">
        <tr>
          <td bgcolor="#D8E2FC"><font face="Verdana" size="2">Tanggal Kirim</font></td>
          <td bgcolor="#D8E2FC"><input type="text" name="tglkirim" size="12" onblur="convert_date(tglkirim)" value="<? echo $lastkirim; ?>">
				</tr>
				<tr>
          <td bgcolor="#D8E2FC" align="left" valign="top"><font face="Verdana" size="2">Keterangan</font></td>
          <td bgcolor="#D8E2FC"><textarea name="ket" cols="30" rows="3"><? echo $ket; ?></textarea>
				</tr>
				<tr>
          <td bgcolor="#D8E2FC"><font face="Verdana" size="2"></font></td>
          <td>
					<input type="submit" name="ganti" value="GANTI">
					<input type="hidden" name="kdkantor" value="<? echo $kdkantor; ?>">
					<input type="hidden" name="namafile" value="<? echo $namafile; ?>">
          </td>
				</tr>
   </form>
	 </table>
   </td>
	</tr>
</table>
<hr size="1">
<? 
	echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
 ?>