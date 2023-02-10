<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	$DB=new Database($userid, $passwd, $DBName);	
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript">
<!--
var win= null;
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
</script>
<?
  $bln="0".$vbln;
	$bulan=substr($bln,-2);
	
	switch ($bulan) {
	case "01":  $bul="Januari"; break;
	case "02":  $bul="Februari"; break;
	case "03":  $bul="Maret"; break;
	case "04":  $bul="April"; break;
	case "05":  $bul="Mei"; break;
	case "06":  $bul="Juni"; break;
	case "07":  $bul="Juli"; break;
	case "08":  $bul="Agustus"; break;
	case "09":  $bul="September"; break;
	case "10":  $bul="Oktober"; break;
	case "11":  $bul="November"; break;
	case "12":  $bul="Desember"; break;
  }

  $kdproses="$bulan$vthn";

	echo "<font color=\"003399\" face=verdana size=2><b>ABSEN PENGIRIMAN FILE DATA KONVERSI</b></font><br>";
  echo "<hr size=1>";
	echo "<table>";
  echo "<form name=date action=$PHP_SELF>";
	echo "<tr><td class=verdana10blk>Pilih Bulan Proses</td><td>";
	echo DateSelector("v");
	echo "<input type=\"submit\" value=\"Cari\" name=\"cari\">";
	echo "</td></tr>";
	echo "</form>";
	echo "</table>";

	if(!$vbln){
	} else {
	echo "<hr size=1>";
	echo "<div align=center>";
	
				  $sql = "select decode(substr(a.nama_file,1,1),'H',1,'R',2,'B',3) urutfile,".
					       "a.kdkantor,a.nama_file,to_char(a.tglkirim,'DD/MM/YYYY') tglkirim,".
								 "a.penanggungjawab,a.keterangan,b.namakantor ".
					       "from $DBUser.tabel_file_kantor a,$DBUser.tabel_001_kantor b ".
								 "where a.kdkantor=b.kdkantor and a.kdproses='$kdproses' ".
								 "order by a.kdkantor,urutfile,a.nama_file";
								 
					$DB->parse($sql);
					$DB->execute();
					echo "<a class=verdana10blk><b>Proses $bul $vthn</b></a>";
					 echo "<table>";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center class=verdana8blk><b>NO.</b></td>");
							echo("<td align=center class=verdana8blk><b>KD.KTR</b></td>");
							echo("<td align=center class=verdana8blk><b>NAMA KANTOR</b></td>");
							echo("<td align=center class=verdana8blk><b>NAMA FILE</b></td>");
					    echo("<td align=center class=verdana8blk><b>TGL. KIRIM</b></td>");
							echo("<td align=center class=verdana8blk><b>PENANGGUNG JAWAB</b></td>");
							echo("<td align=center class=verdana8blk><b>KETERANGAN</b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$kdkantor = $arr["KDKANTOR"];
							$namafile = $arr["NAMA_FILE"];
							$tglkirim = $arr["TGLKIRIM"];
							$penanggungjawab = $arr["PENANGGUNGJAWAB"];
							$keterangan = $arr["KETERANGAN"];
							$namakantor = $arr["NAMAKANTOR"];
							$kantorfile=substr($namafile,0,1);
							//$KTR = New Kantor ($userid,$passwd,$arr["KDKANTOR"]);
              
							switch ($kantorfile)
							{
							 case "B": $file="<font color=green><b>$namafile</b></font>"; break;
							 case "H": $file="<font color=blue><b>$namafile</b></font>"; break;
							 case "R": $file="<font color=#880000><b>$namafile</b></font>"; break;
							 default : $file="$namafile"; break; 
							}
							switch ($tglkirim)
							{
							 case "": $tglkirim="<font color=red>BELUM</font>";$keterangan="<font color=red>PERHATIAN!</font> SEGERA KIRIM"; break;
							 default : $tglkirim; $keterangan; break; 
							}
							
							include "../../includes/belang.php";	 
							echo "<td align=center class=verdana7blk>".$i."</td>";
							echo "<td align=center class=verdana7blk>".$kdkantor."</td>";
							echo "<td class=verdana7blk>".$namakantor."</td>";
		          echo "<td align=center class=verdana7blk><a href=\"#\" onclick=\"NewWindow('authsendfile.php?kdkantor=$kdkantor&namafile=$namafile','popuppage','420','300','yes')\">".$file."</a></td>";
					 		echo "<td align=center class=verdana7blk>".$tglkirim."</td>";
							echo "<td class=verdana7blk>".$penanggungjawab."</td>";
							echo "<td class=verdana7blk>".$keterangan."</td>";
							echo "</tr>";
							
					 $i++;
					 }				 
           echo "</table>";
					 $sql = "select count(*) jml,count(tglkirim) tglok from ".
					        "$DBUser.tabel_file_kantor where kdproses='$kdproses'";
  				 $DB->parse($sql);
					 $DB->execute();
					 $xx=$DB->nextrow();
					 $jmlfile =$xx["JML"];
					 $filekirim = $xx["TGLOK"];
					 $filekosong= $jmlfile - $filekirim;
					 echo "<br>";
					 echo "<a class=verdana10blk>Total File : <b>".$jmlfile."</b> Sudah Terkirim : <b>".$filekirim."</b> Belum Kirim : <b>".$filekosong."</b></a>";
					 echo "</div>";
					 }
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>