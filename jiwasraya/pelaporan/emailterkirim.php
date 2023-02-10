<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
	
//-------------------------------------- edit ----------------------------------
	if ($update=="Update") {
		$sql="select nopertanggungan from $DBUser.tabel_200_pertanggungan ".
				 "where prefixpertanggungan='$kantor' ".
				 "AND a.nopenagih is not null ".
				 "AND a.premi1 != '0' ".
				 "AND a.kdstatusmedical = 'N' ".
				 "AND a.kdpertanggungan = '1' ";
	  $DB->parse($sql);
	  $DB->execute();
		$res = $DB->result();
		foreach ($res as $foo=>$data) {
	    if (${$data["NOPERTANGGUNGAN"]}=="ON") {
		    $nopert=$data["NOPERTANGGUNGAN"];
		    $sql="update $DBUser.tabel_200_pertanggungan set kdstatusemail='',tglsendemail='' ".
  					 "where nopertanggungan='$nopert'";
		    $DB->parse($sql);
			  $DB->execute();
			}
		}
		$DB->commit();
		header("location:http://$HTTP_HOST/$KAMP/pelaporan/lapcabang.php");
	}
?>
<body>
<link href="../jws.css" rel="stylesheet" type="text/css">
<!----------------------------- start date selector --------------------------->
<?
function DateSelector($inName, $useDate=0) { 
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	if ($useDate==0) { 
		$useDate=Time(); 
	} 
	//make day selector 
	print("<select name=".$inName."tgl>\n"); 
	echo "<option value=\"all\">-</option>";
	for ($currentDay=1; $currentDay<=31; $currentDay++) { 
		print("<option value=\"$currentDay\""); 
		if (intval(date("d", $useDate))==$currentDay) { 
			print(" selected"); 
		} 
		print(">$currentDay\n"); 
	} 
	print("</select>");  
	// make month selector 
	print("<select name=".$inName."bln>\n");
	for ($currentMonth=1; $currentMonth<=12; $currentMonth++) { 
		print("<option value=\""); 
		print(intval($currentMonth)); 
		print("\""); 
		if (intval(date("m", $useDate))==$currentMonth) { 
			print(" selected");
		} 
		print(">".$monthName[$currentMonth]."\n"); 
	} 
	print("</select>"); 
	// make year selector 
	print("<select name=".$inName."th>\n"); 
	$startYear=date("Y", $useDate); 
	for ($currentYear=$startYear-3; $currentYear<=$startYear+5;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
} 
switch ($vbln) {
   case "1":  $vbulan = "JAN"; break;
   case "2":  $vbulan = "FEB"; break;
   case "3":  $vbulan = "MAR"; break;
   case "4":  $vbulan = "APR"; break;
   case "5":  $vbulan = "MAY"; break;
   case "6":  $vbulan = "JUN"; break;
   case "7":  $vbulan = "JUL"; break;
   case "8":  $vbulan = "AUG"; break;
   case "9":  $vbulan = "SEP"; break;					
   case "10": $vbulan = "OCT"; break;
   case "11": $vbulan = "NOV"; break;
   case "12": $vbulan = "DEC"; break;										
}
?> 
<font face="Verdana" size="2"><b>Cek Pengiriman Email/Proposal Sudah Menjadi Polis (Kantor : <? echo $kantor; ?>)</b></font><br>
<form name="date" action="<? PHP_SEFT ?>"> 
<font face="Verdana" size="2">Pilih Tanggal :  <?php DateSelector("v"); ?></font> 
<input type="submit" value="CARI" name="cari">
<input type="hidden" value="1" name="on">
</form> 
<!------------------------------ End date selector ----------------------------->
<?
$vtahun = substr($vth,-2);
$tanggal = "0".$vtgl;
$tglnow = substr($tanggal,-2);
//echo $vtgl;	 
if($vtgl=="all"){
	  $tglsearch="%$vbulan-$vtahun";
}else{
	  $tglsearch="$tglnow-$vbulan-$vtahun";
}
	
$rya ="select tglsendemail from $DBUser.tabel_200_pertanggungan ".
		  "where tglsendemail like '$tglsearch' and prefixpertanggungan='$kantor'";	
//echo $vbln;//$rya;					  
$DB->parse($rya);
$DB->execute();
$ary=$DB->nextrow();
$tglsendemail=$ary["TGLSENDEMAIL"];
if (!$tglsendemail) { 
	if ($on!=1) {
  	print "<font color=\"red\" face=\"Verdana\" size=\"2\"></font>";  
	} else {
		echo "<br>";
		echo "<font color=\"red\" face=\"Verdana\" size=\"2\">Tidak ada email terkirim tanggal $vtgl-$vbulan-$vtahun</font>";  
		echo "<br>";
	}		
} else {		
echo "<form method=\"POST\" name=\"editstatusemail\" action=\"emailterkirim.php\">";
echo "<hr size=1>";
echo "<div align=\"center\">";
echo "<font color=\"black\" face=\"Verdana\" size=\"2\"><b>Email Terkirim Tanggal $vtgl-$vbulan-$vtahun</b></font>";

//------------------------------------- non medical ----------------------------
	$sql="select distinct a.prefixpertanggungan,a.kdstatusmedical,".
	     "a.nopertanggungan,decode(a.kdpertanggungan,'1','PROPOSAL','2','POLIS') kdpertanggungan,".
			 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) pmgpol,".
			 "to_char(a.tglsendemail,'DD/MM/YYYY  HH24:MI:SS') tglsendemail,".
			 "to_char(a.tglkonversi,'DD/MM/YYYY  HH24:MI:SS') tglkonversi,".
			 "f.kdacceptance,to_char(f.tglacceptance,'DD/MM/YYYY  HH24:MI:SS') tglacceptance ".
			 "from ".
			 "$DBUser.tabel_200_pertanggungan a,".
			 "$DBUser.tabel_214_acceptance_dokumen f ".
			 "where ".
			 "a.nopertanggungan=f.nopertanggungan(+) and ".
			 "a.premi1!='0' and a.prefixpertanggungan='$kantor' and a.kdstatusmedical='N' ".
			 "and tglsendemail like '$tglsearch'";	
	//echo "<br><br>".$sql."<br><br>";
	$DB->parse($sql);
	$DB->execute();
	$today=date("F j, Y, g:i a"); 
	echo "<table border=\"0\" bgcolor=\"#C0C0C0\" cellpadding=\"2\" cellspacing=\"1\">";   
	echo "<tr>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>No</b></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>Pemegang Polis</b></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>Kd. Status Medical</b></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>Tgl. Kirim Email</b></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>Status Pertanggungan</b></td>";
	echo "<td bgcolor=\"#6699FF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><b>Status Akseptasi</b></font></td>";
	echo "</tr>";          
	$i=1;
	while ($arx=$DB->nextrow()) {
	  $prefix = $arx["PREFIXPERTANGGUNGAN"];
		$nopertanggungan = $arx["NOPERTANGGUNGAN"];
		$kdpertanggungan = $arx["KDPERTANGGUNGAN"];
		$kdacceptance = $arx["KDACCEPTANCE"];
		switch ($kdpertanggungan){
			case "PROPOSAL": $kdpertanggungan = "<font color=\"#cc6633\">PROPOSAL</FONT>"; break;
			case "POLIS": $kdpertanggungan = "<font color=\"#ff0000\"><B><a href=\"#\" onclick=\"window.open('../polis/polis.php?noper=$nopertanggungan&prefix=$prefix','popuppage','scrollbars=yes,width=700,height=400,top=100,left=100');\">POLIS</a></B></FONT>"; break;
		}
		switch ($kdstatusemail){
			case "1": $cek = "<input type=\"checkbox\" name=".$nopertanggungan." value=\"ON\" disabled>"; break;
			case "0": $cek = "<input type=\"checkbox\" name=".$nopertanggungan." value=\"ON\">"; break;
		}
		switch ($kdacceptance){
			case "1": $accept = "<font color=\"blue\" face=\"Verdana\" size=\"1\">Sudah</font>"; break;
			case "": $accept = "<font color=\"red\" face=\"Verdana\" size=\"1\">Belum</font>"; break;
		}
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\"><font color=\"#535353\" face=\"Verdana\" size=\"1\">".$i."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font color=\"#535353\" face=\"Verdana\" size=\"1\">".$arx["PREFIXPERTANGGUNGAN"]."-".$arx["NOPERTANGGUNGAN"]."</td>";
		echo "<td bgcolor=\"#FFFFFF\"><font color=\"#535353\" face=\"Verdana\" size=\"1\">".$arx["PMGPOL"]."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font color=\"blue\" face=\"Verdana\" size=\"1\">".$arx["KDSTATUSMEDICAL"]."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arx["TGLSENDEMAIL"]." WIB</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$kdpertanggungan."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$accept." ".$arx["TGLKONVERSI"]."</font></td>";
		echo "</tr>";
		$i++;
	}
			
//------------------------------------ Medical ---------------------------------	
	
	$sqlx ="select a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,a.kdstatusmedical,".
				"decode(a.kdpertanggungan,'1','PROPOSAL','2','POLIS') kdpertanggungan,".
				"to_char(a.tglsendemail,'DD/MM/YYYY HH24:MI:SS') tglsendemail,".
				"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) pmgpol,".
				"to_char(a.tglkonversi,'DD/MM/YYYY  HH24:MI:SS') tglkonversi,".
			  "f.kdacceptance ,to_char(f.tglacceptance,'DD/MM/YYYY  HH24:MI:SS') tglacceptance ".
				"from ".
				"$DBUser.tabel_200_pertanggungan a, ".
				"$DBUser.tabel_214_acceptance_dokumen f ".
				"where ".
				"(select count(*) from $DBUser.tabel_212_dok_cek_uw b where kdstatusunderwriting='0' ".
				"and a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan)=0 ".
				"and a.prefixpertanggungan='$kantor' ".
				"and a.kdstatusemail is not null and ".
				"a.nopertanggungan=f.nopertanggungan(+) and ".
				"a.kdstatusmedical='M' ".
				"and tglsendemail like '$tglsearch'";
	
	$DB->parse($sqlx);
	$DB->execute();
	//$i=1;
	while ($arx=$DB->nextrow()) {
		$nopertanggungan = $arx["NOPERTANGGUNGAN"];
		$kdpertanggungan = $arx["KDPERTANGGUNGAN"];
		$kdacceptance = $arx["KDACCEPTANCE"];
		switch ($kdpertanggungan){
			case "PROPOSAL": $kdpertanggungan = "<font color=\"#cc6633\">PROPOSAL</FONT>"; break;
			case "POLIS": $kdpertanggungan = "<font color=\"#ff0000\"><B><a href=\"#\" onclick=\"window.open('../polis/polis.php?noper=$nopertanggungan&prefix=$prefix','popuppage','scrollbars=yes,width=700,height=400,top=100,left=100');\">POLIS</a></B></FONT>"; break;
		}
		switch ($kdstatusemail){
			case "1": $cek = "<input type=\"checkbox\" name=".$nopertanggungan." value=\"ON\" disabled>"; break;
			case "0": $cek = "<input type=\"checkbox\" name=".$nopertanggungan." value=\"ON\">"; break;
		}
		switch ($kdacceptance){
			case "1": $accept = "<font color=\"blue\" face=\"Verdana\" size=\"1\">Sudah</font>"; break;
			case "": $accept = "<font color=\"red\" face=\"Verdana\" size=\"1\">Belum</font>"; break;
		}
		echo "<tr>";
		echo "<td bgcolor=\"#FFFFFF\"><font color=\"#535353\" face=\"Verdana\" size=\"1\">".$i."</td>";
		echo("<td bgcolor=\"#FFFFFF\"align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arx["PREFIXPERTANGGUNGAN"]."&noper=".$arx["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arx["PREFIXPERTANGGUNGAN"]."-".$arx["NOPERTANGGUNGAN"]."</a></td>");
		echo "<td bgcolor=\"#FFFFFF\"><font color=\"#535353\" face=\"Verdana\" size=\"1\">".$arx["PMGPOL"]."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font color=\"green\" face=\"Verdana\" size=\"1\">".$arx["KDSTATUSMEDICAL"]."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arx["TGLSENDEMAIL"]." WIB</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$kdpertanggungan."</td>";
		echo "<td align=\"center\" bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$accept." ".$arx["TGLKONVERSI"]."</font></td>";
		echo "</tr>";
		$i++;
	}
echo "</table>";
echo "</form>";	
}
?>
</div>
<hr size=1>
<font face="verdana" size="2"><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></font>
</body>