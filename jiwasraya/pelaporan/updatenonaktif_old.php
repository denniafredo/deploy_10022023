<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	$DB = new Database($userid, $passwd, $DBName);
	//$DB=new Database("JSADM","JSADM","JSDB10");	
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<body bgcolor=#b0ecf2>";
	
if ($update=="Update"){
  
  echo "<a class=verdana10blk><B>UPDATE PERTANGGUNGAN</B></a>";
  echo "<hr size=1>";
	    /*
			$sql = "select s.*,x.namaklien1 as namapenagih,y.namaklien1 as namaagen,".
					       "d.namacarabayar from ".
					       "(select floor((rownum-1)/40) + 1 k,".
                 "a.nopol,a.prefixpertanggungan,a.nopertanggungan,".
                 "a.notertanggung,a.juamainproduk,a.premi1,premi2,".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
								 "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,".
                 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.kdstatusfile,".
                 "to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
                 "a.lamaasuransi_th,b.namaklien1 as namattg ".
                 "from ".
                 "$DBUser.tabel_200_pertanggungan a,".
                 "$DBUser.tabel_100_klien b, ".
								 "$DBUser.tabel_500_penagih c ".
								 "where ".
								 "c.kdrayonpenagih='$kantor' and ".
                 "a.notertanggung=b.noklien and ".
								 "a.kdpertanggungan='2' and ".
								 "a.nopenagih=c.nopenagih) s,".
								 "$DBUser.tabel_305_cara_bayar d,".
								 "$DBUser.tabel_100_klien x,".
								 "$DBUser.tabel_100_klien y ".
								 "where ".
								 "k='$get' and ".
								 //"k between $start and $end and ".
								 "s.kdcarabayar=d.kdcarabayar and ".
								 "s.nopenagih=x.noklien and ".
								 "s.noagen=y.noklien(+) order by s.nopertanggungan";	
						*/
		 $sql="select ".
					       "s.*,".
								 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.nopenagih) as namapenagih,".
                 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.noagen) as namaagen,".
                 "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=s.kdcarabayar) as namacarabayar, ".
                 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.notertanggung) as namattg ".
           "from ".
                 "(select floor((rownum-1)/40) + 1 k,".
                       "a.nopol,a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,".
                       "a.juamainproduk,a.premi1,premi2,".
                       "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
                       "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,to_char(a.mulas,'MM/YYYY') mulas,".
                       "a.kdstatusfile,".
                       "decode(a.kdstatusfile,'1','AKTIF','2','NON-AKTIF','3','EKSPIRASI','4','BPO','5','TEBUS','7','DELETE','KLAIM') statusfile,".
                       "to_char(a.expirasi,'MM/YYYY') expirasi,a.lamaasuransi_th ".
                 "from ".
								       "$DBUser.tabel_200_pertanggungan a,".
											 "$DBUser.tabel_500_penagih c ".
								 "where ".
								       "c.kdrayonpenagih='$kantor' and ".
											 "a.kdpertanggungan='2' and ".
                       "a.nopenagih=c.nopenagih and a.kdstatusfile!='1') s ".
            "where ".
                 "k='$get'";	 
	$DB->parse($sql);
	$DB->execute();
	$res = $DB->result();
	$i=1;
					    echo "<table>";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Kd.Produk</font></b></td>");
						  echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Penagih</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Agen</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</b></font></td>");
							echo("</tr>");
							
	foreach ($res as $foo => $data) {
  
	  $kdprod[$i]="kdprodukbaru".$i;
	  $kdp = $$kdprod[$i];
		$noagen[$i]="noagenbaru".$i;
	  $noa = $$noagen[$i];
		$nopenagih[$i]="nopenagihbaru".$i;
	  $nop = $$nopenagih[$i];
		$kdstt[$i]="kdstatus".$i;
	  $stt = $$kdstt[$i];
		
		$namaagen[$i]="namaagenbaru".$i;
	  $nma = $$namaagen[$i];
		$namapenagih[$i]="namapenagihbaru".$i;
	  $nmp = $$namapenagih[$i];
		
    if (${$data["NOPERTANGGUNGAN"]} == "ON") {
			$noptg = $data["NOPERTANGGUNGAN"];
			$namattg = $data["NAMAKLIEN1"];
	    $sql="update $DBUser.tabel_200_pertanggungan ".
			     "set kdproduk='$kdp',nopenagih='$nop',noagen='$noa',kdstatusfile='$stt', ".
					 "tglupdated=sysdate,userupdated='$userid' ".
 					 "where nopertanggungan='$noptg'";
					 
					 echo $sql."<br><br>";
			$DB->parse($sql);
		  $DB->execute();
			$DB->commit();
			
			switch($stt){
			  case "1" : $nmstt="AKTIF"; break;
				case "2" : $nmstt="NON-AKTIF"; break;
				case "3" : $nmstt="EKSPIRASI"; break;
				case "4" : $nmstt="BPO"; break;
				case "5" : $nmstt="TEBUS"; break;
				case "6" : $nmstt="KLAIM"; break;
				case "7" : $nmstt="DELETE"; break;
			}
			
			        include "../../includes/belang.php";
							echo("<td align=center class=verdana8blk>$i</td>");
							echo("<td align=center class=verdana8blk>$noptg</td>");
							echo("<td align=center class=verdana8blk>$kdp</td>");
							echo("<td align=center class=verdana8blk>$nmp</td>");
							echo("<td align=center class=verdana8blk>$nma</td>");
							echo("<td align=center class=verdana8blk>$nmstt</td>");
							echo("</tr>");
	  }
		$i++;	
  }
	            echo "</table>";
							echo "<br>";
		          echo "<a class=verdana10blk>Update ... sukses !</a>";
} else {
?>
	<script language="javascript">
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
	echo "<a class=\"verdana10blk\"><b>UPDATE POLIS KONVERSI NON AKTIF KANTOR $kantor </b></a>";
  echo "<hr size=1>";
	echo "<div align=center>";

	$DBN = new Database($userid, $passwd, $DBName);
  //$DBN=new Database("JSADM","JSADM","JSDB10");	
	$sqla = "select count(a.nopertanggungan) jml from $DBUser.tabel_200_pertanggungan a, ".
	        "$DBUser.tabel_500_penagih b ".
	        "where a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' ".
					"and a.kdstatusfile!='1'";
		$DBN->parse($sqla);
		$DBN->execute();
		$ara=$DBN->nextrow();
		$jml = $ara["JML"];
		$perhal=40;
		$pg = ceil($jml / $perhal);
#------------------------------ START NAVIGASI ---------------------------------
?>
<script language="javascript">
 	function CariNama() {
  var halcari=document.clntmtc.carihal.value;
	var xxx = parseInt(document.clntmtc.carihal.value);
	  nextpg = xxx + 10;
		if((xxx < 11)||(halcari =='')) {
		  window.location.replace('updatepenagihkonversi.php?action=list&maju=ok&lastpg=11&get='+halcari+'');
    }else {
		  window.location.replace('updatepenagihkonversi.php?action=list&maju=ok&lastpg='+nextpg+'&get='+halcari+'');
		}
	}
</script>
<table>
 <form name="clntmtc" method="POST">
 <tr>
 <td>
<? 

if($maju){
$total_pages = $total_pages + $lastpg;
$starthal = $total_pages - 10;
$xx=$lastpg + 10;
$linkm = $xx - 10;
} else 
if($mundur){
$total_pages = $lastpg - 20;
$starthal = $total_pages - 10;
$xx=$lastpg - 10;
$linkp = $starthal -10;
} else {
$total_pages = 11;
$starthal = 1;
$lastpg = 21;
$xx=$lastpg + 10;
}
#------------------------------------ PREV -------------------------------------
if(!$get){
 $get=1;
}

if(!$linkp){
$linkp = $starthal - 10;
}

if($get<11){
 $urlp = $PHP_SELF; 
} else {
 $urlp = $PHP_SELF . "?action=list&mundur=ok&lastpg=$xx&get=$linkp&users=$users"; 
}

if ($starthal==1){
print("<a class=verdana10blk><b>Prev</b> |</a>"); 
} else {
  print("<a class=verdana10blk href=\"$urlp\" title=\"Previous Results\"><b>Prev</b></a> |&nbsp;"); 
}
#-------------------------------------------------------------------------------
for ($i = $starthal; $i < $total_pages; $i++) { 
if ($mundur){
   $a = $xx + 10;
   $url = $PHP_SELF . "?action=list&mundur=ok&lastpg=$a&get=$i&users=$users"; 
} else {
   $a = $total_pages;
   $url = $PHP_SELF . "?action=list&maju=ok&lastpg=$a&get=$i&users=$users"; 
}
	if ($get==$i) {
	  	  print "<font type=Verdana color=#3825e2 size=3><b>&nbsp;$i&nbsp;</b> ";
  } else { 
        print(" <a class=verdana10blk href=\"$url\" title=\"Go to page $i\">&nbsp;$i&nbsp;</a> "); 
  }
}
#------------------------------------ NEXT -------------------------------
if(!$linkm){
$linkm = $starthal + 10;
}
$stop = $xx - 10;
//echo $stop."<br>";
$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm&users=$users";
if($stop > $pg){ 
  print("&nbsp;| <a class=verdana10blk><b>Next</b></a> "); 
} else {
  print("&nbsp;| <a class=verdana10blk href=\"$urln\" title=\"Next Results\"><b>Next</b></a> ");
}

if($pg < 2){
 $hal = "page";
} else {
 $hal = "pages";
}
echo "<a class=verdana10blk> &nbsp;&nbsp;Total ".$pg." ".$hal.", ".$jml." polis</a>";
#-------------------------------------------------------------------------------
 ?>
</td>
<td class=verdana10blk>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td class=verdana10blk>
Jump to page
</td>
<td>
 <input type="text" name="carihal" size="5" maxlength="5" onfocus="highlight(event)" onblur="CariNama();">
</td>
</tr>
 </form>
</table>
<?
#------------------------------------- END NAV ---------------------------	
  //include "../../includes/navigasipage.php";
	      /*
					$sql = "select s.*,x.namaklien1 as namapenagih,y.namaklien1 as namaagen,".
					       "d.namacarabayar from ".
					       "(select floor((rownum-1)/40) + 1 k,".
                 "a.nopol,a.prefixpertanggungan,a.nopertanggungan,".
                 "a.notertanggung,a.juamainproduk,a.premi1,premi2,".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
								 "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,".
                 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.kdstatusfile,".
                 "to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
                 "a.lamaasuransi_th,b.namaklien1 as namattg ".
                 "from ".
                 "$DBUser.tabel_200_pertanggungan a,".
                 "$DBUser.tabel_100_klien b, ".
								 "$DBUser.tabel_500_penagih c ".
								 "where ".
								 "c.kdrayonpenagih='$kantor' and ".
                 "a.notertanggung=b.noklien and ".
								 "a.nopenagih=c.nopenagih) s,".
								 "$DBUser.tabel_305_cara_bayar d,".
								 "$DBUser.tabel_100_klien x,".
								 "$DBUser.tabel_100_klien y ".
								 "where ".
								 "k='$get' and ".
								 //"k between $start and $end and ".
								 "s.kdcarabayar=d.kdcarabayar and ".
								 "s.nopenagih=x.noklien and ".
								 "s.noagen=y.noklien(+) order by s.nopertanggungan";		 
					*/
			$sql="select ".
					       "s.*,".
								 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.nopenagih) as namapenagih,".
                 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.noagen) as namaagen,".
                 "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=s.kdcarabayar) as namacarabayar, ".
                 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.notertanggung) as namattg ".
           "from ".
                 "(select floor((rownum-1)/40) + 1 k,".
                       "a.nopol,a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,".
                       "a.juamainproduk,a.premi1,premi2,".
                       "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
                       "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,to_char(a.mulas,'MM/YYYY') mulas,".
                       "a.kdstatusfile,".
                       "decode(a.kdstatusfile,'1','AKTIF','2','NON-AKTIF','3','EKSPIRASI','4','BPO','5','TEBUS','7','DELETE','KLAIM') statusfile,".
                       "to_char(a.expirasi,'MM/YYYY') expirasi,a.lamaasuransi_th ".
                 "from ".
								       "$DBUser.tabel_200_pertanggungan a,".
											 "$DBUser.tabel_500_penagih c ".
								 "where ".
								       "c.kdrayonpenagih='$kantor' and ".
											 "a.kdpertanggungan='2' and ".
                       "a.nopenagih=c.nopenagih and a.kdstatusfile!='1') s ".
            "where ".
                 "k='$get' order by namattg";	
								 
					$DBN->parse($sql);
					$DBN->execute();
							echo "<br><a class=\"verdana10blk\">Beri tandai (check) baris yang ingin di-update!</a>";
							echo "<table>";
							echo "<form name=\"updatekonversi\" method=\"POST\" action=$PHP_SELF?lihat=$lihat&start=$awal&end=$akhir&page=$i>";
					    echo "<tr>";
							echo "<td class=\"verdana9blk\" colspan=15>Halaman : ".$get."</td>";
							echo "</tr>";
							echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pol. Lama</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertanggn.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
						  echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Penagih</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Agen</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Check</b></font></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DBN->nextrow()) {
							$noper = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							$noagen = $arr["NOAGEN"];
							$nopenagih = $arr["NOPENAGIH"];
							$namapenagih= $arr["NAMAPENAGIH"];
							$namaagen= $arr["NAMAAGEN"];
							$kdstatusfile = $arr["KDSTATUSFILE"];
							$namattg=$arr["NAMATTG"];
							$kdproduk = $arr["KDPRODUK"];
							$namattg = ereg_replace("'","~",$namattg);
							$namapenagih = ereg_replace("'","~",$namapenagih);
							$namaagen = ereg_replace("'","~",$namaagen);
													
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPOL"]."</font></td>");
						  echo("<td align=center><font face=Verdana size=1>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMATTG"]."</font></td>");
					 		echo "<td><input type=text name=kdprodukbaru".$i." size=3 value=\"".$arr["KDPRODUK"]."\" readonly style=\"font-family: Verdana; font-size: 8pt\">";
              if($kdproduk=="XXX"){        
												echo "<a href=\"#\" onclick=\"window.open('produkkonversiall.php?n=$i','popuppage','scrollbars=yes,width=420,height=300,top=100,left=100');\"><img src=\"../img/jswindow.gif\" alt=\"Daftar Produk\" name=\"getproduk\" border=\"0\">";
							} else {}
							echo "</td>";
							echo("<td><input type=text name=nopenagihbaru".$i." size=10 value=\"".$arr["NOPENAGIH"]."\" readonly style=\"font-family: Verdana; font-size: 8pt\">".
							          "<input type=text name=namapenagihbaru".$i." size=23 value=\"".$arr["NAMAPENAGIH"]."\" readonly style=\"font-family: Verdana; font-size: 8pt\">".
												"<a href=\"#\" onclick=\"window.open('penagihkonversiall.php?n=$i','popuppage','scrollbars=yes,width=420,height=300,top=100,left=100');\"><img src=\"../img/jswindow.gif\" alt=\"Daftar Penagih\" border=\"0\"></a>".
												"</td>"); 
							echo("<td><input type=text name=noagenbaru".$i." size=10 value=\"".$arr["NOAGEN"]."\" readonly style=\"font-family: Verdana; font-size: 8pt\">".
							          "<input type=text name=namaagenbaru".$i." size=23 value=\"".$arr["NAMAAGEN"]."\" readonly style=\"font-family: Verdana; font-size: 8pt\">".
												"<a href=\"#\" onclick=\"window.open('agenkonversiall.php?n=$i','popuppage','scrollbars=yes,width=420,height=300,top=100,left=100');\"><img src=\"../img/jswindow.gif\" alt=\"Daftar Agen\" border=\"0\"></a>".
												"</td>"); 
								echo "<td align=center>";
								
							  $DB = new Database($userid, $passwd, $DBName);	
								$sql  = "select kdstatusfile,namastatusfile ".
	                      "from $DBUser.tabel_299_status_file";
	              $DB->parse($sql);
	              $DB->execute();
							  echo " <select size=1 name=kdstatus".$i." class=buton onfocus=\"highlight(event)\">";
			          while ($arx=$DB->nextrow()) {
				        if ($arx["KDSTATUSFILE"]==$kdstatusfile) {
		                 echo "<option value=".$arx["KDSTATUSFILE"]." selected>".$arx["NAMASTATUSFILE"]."</option>";
				        } else {
		                 echo "<option value=".$arx["KDSTATUSFILE"].">".$arx["NAMASTATUSFILE"]."</option>";
					      }
				        } 
								echo "</select>";
							echo "<td class=\"arial10\" align=\"center\"><input type=\"checkbox\" name=".$noper." value=\"ON\"></td>";
							echo "</td>";
							echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
					 echo "<input type=\"hidden\" name=\"noper\" value=$noper>";
					 echo "<input type=\"submit\" name=\"update\" value=\"Update\">";
					 echo "<input type=\"hidden\" name=\"get\" value=\"$get\">";
					 echo "</form>";

					 echo "</div>";
}
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
&nbsp;&nbsp;&nbsp;<a class="verdana10blk" href="portopoliokantornonaktif.php?lihat=$lihat&start=1&end=200&page=1">Halaman Data Konversi</a>
<!--&nbsp;&nbsp;&nbsp;<a class="verdana10blk" href="updatepenagihkonversi?lihat=$lihat&start=1&end=200&page=1">Halaman Update</a>-->
</body>