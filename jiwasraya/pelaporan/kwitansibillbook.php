<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB = new Database($userid, $passwd, $DBName);
  echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<body bgcolor=#b0ecf2>";
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
	echo "<a class=\"verdana10blk\"><b>DAFTAR STATUS CETAK KWITANSI KANTOR $kantor </b></a>";
  echo "<hr size=1>";

  ?>
	<table>
	<form name="porm" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Billing & Booking bulan</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td><font face="Verdana" size="2">Nomor Penagih</font></td>
  <td><input type="text" class="a" name="nopenagih" size="10" maxlength="10" readonly>
						<a href="#" onclick="NewWindow('../proposal/pnglist.php?a=porm','popuppage','420','300','yes')"><img src="../img/jswindow.gif" border="0" alt="cari daftar agen"></a>		</td>
  <td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<hr size=1>
	<?
	/*
					if($vbln==""){
							   $DB=new Database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
					//}else if($vbln=="all"){
	        //       $thisperiode="$vthn";
		      //       $periode="to_char(a.mulas,'yyyy')='$thisperiode'";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
          }			
		*/
					$bln = substr(("0".$vbln),-2);
	        $thisperiode="$bln$vthn";
		      $periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
								 
					switch ($bln)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
					 
				if(!$nopenagih){
				    $getnopenagih ="";
				} else {
				    $getnopenagih ="a.nopenagih='$nopenagih' and ";
						$sqlz="select namaklien1 from $DBUser.tabel_100_klien where noklien='$nopenagih'";
						$DB->parse($sqlz);
		        $DB->execute();
						$arz=$DB->nextrow();
						$namapenagih=$arz["NAMAKLIEN1"];
						$penagih="Panagih $namapenagih";
				}
	echo "<div align=center>";
	$DBN = new Database($userid, $passwd, $DBName);
	$sqla="select ".
						"count(a.prefixpertanggungan) jml ".   
       "from ".
				 	"$DBUser.tabel_100_klien b,". 
         	"$DBUser.tabel_300_historis_premi c,".
	 				"$DBUser.tabel_200_pertanggungan a,".  
          "$DBUser.tabel_500_penagih e,".
	 				"$DBUser.tabel_001_kantor i ".
       "where ".
					"(a.nopenagih=e.nopenagih) and ".
	 				"(a.nopemegangpolis=b.noklien(+)) and ".
	 				"(a.prefixpertanggungan=c.prefixpertanggungan ) and ".
   	 			"(e.kdrayonpenagih in (select kdkantor from $DBUser.tabel_001_kantor start with kdkantor='$kantor' connect by prior kdkantor=kdkantorinduk)) AND  ".
   	 			"(a.nopertanggungan=c.nopertanggungan ) and ".
	 				"(c.tglseatled is NULL) and ".
	 				"(c.billstatus is NULL) and ".
	 				"(e.kdrayonpenagih=i.kdkantor) and ".
	 				"(SUBSTR(c.kdkuitansi,1,2)='OB') and ".
	 				"(c.tglbooked =to_date('$thisperiode','MMYYYY')) and ".
	 				"a.kdpertanggungan='2' and ".
	 				"c.status IN ('0','1') and ".
					"$getnopenagih ".
					"e.kdrayonpenagih='$kantor' ";	
		//echo $sqla;
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
		  window.location.replace('kwitansibillbook.php?action=list&maju=ok&lastpg=11&get='+halcari+'&thisperiode=$thisperiode&nopenagih=$nopenagih&vbln=$vbln&vthn=$vthn');
    }else {
		  window.location.replace('kwitansibillbook.php?action=list&maju=ok&lastpg='+nextpg+'&get='+halcari+'&thisperiode=$thisperiode&nopenagih=$nopenagih&vbln=$vbln&vthn=$vthn');
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
 $urlp = $PHP_SELF . "?action=list&mundur=ok&lastpg=$xx&get=$linkp&users=$users&thisperiode=$thisperiode&nopenagih=$nopenagih&vbln=$vbln&vthn=$vthn"; 
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
   $url = $PHP_SELF . "?action=list&mundur=ok&lastpg=$a&get=$i&users=$users&thisperiode=$thisperiode&nopenagih=$nopenagih&vbln=$vbln&vthn=$vthn"; 
} else {
   $a = $total_pages;
   $url = $PHP_SELF . "?action=list&maju=ok&lastpg=$a&get=$i&users=$users&thisperiode=$thisperiode&nopenagih=$nopenagih&vbln=$vbln&vthn=$vthn"; 
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
$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm&users=$users&thisperiode=$thisperiode&nopenagih=$nopenagih&vbln=$vbln&vthn=$vthn";
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
 $sql = "select s.* from (".
   			"select ".
	        "floor((rownum-1)/40) + 1 k,".
					"(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar,".   
					"a.prefixpertanggungan,".   
         	"a.notertanggung,".
	 				"a.nopol,".   
					"a.nopertanggungan,".   
         	"a.kdproduk,".
         	"a.mulas,".
         	"a.expirasi,".   
         	"a.kdvaluta,". 
          "(select namavaluta from $DBUser.tabel_304_valuta where kdvaluta=a.kdvaluta) namavaluta,".   
          "a.juamainproduk,".   
          "a.premi1,". 
          "decode(a.kdcarabayar,'M','1','Q','2','H','3','A','4',a.kdcarabayar) kdcarabayar,".   
          "a.indexawal,".
         	"a.premi2,".
         	"a.nopenagih,".  
					"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopenagih) namapenagih,".
         	"a.kdstatusfile,".   
         	"a.noagen,".
          "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".   
          "a.kdstatusmedical,".
         	"b.namaklien1 namapemegangpolis,".
         	"e.kdrayonpenagih,".
					"(select notasi from $DBUser.tabel_304_valuta ".
			   	 "where a.kdvaluta=$DBUser.tabel_304_valuta.kdvaluta) as notasi,".
					"to_char(c.tglcetak,'DD/MM/YYYY') tglcetak,".
					"a.tagihan,".
					"c.status ".
       "from ".
				 	"$DBUser.tabel_100_klien b,". 
         	"$DBUser.tabel_300_historis_premi c,".
	 				"$DBUser.tabel_200_pertanggungan a,".  
          "$DBUser.tabel_500_penagih e,".
	 				"$DBUser.tabel_001_kantor i ".
       "where ".
					"(a.nopenagih=e.nopenagih) and ".
	 				"(a.nopemegangpolis=b.noklien(+)) and ".
	 				"(a.prefixpertanggungan=c.prefixpertanggungan ) and ".
   	 			"(e.kdrayonpenagih in (select kdkantor from $DBUser.tabel_001_kantor start with kdkantor='$kantor' connect by prior kdkantor=kdkantorinduk)) AND  ".
   	 			"(a.nopertanggungan=c.nopertanggungan ) and ".
	 				"(c.tglseatled is NULL) and ".
	 				"(c.billstatus is NULL) and ".
	 				"(e.kdrayonpenagih=i.kdkantor) and ".
	 				"(SUBSTR(c.kdkuitansi,1,2)='OB') and ".
	 				"(c.tglbooked =to_date('$thisperiode','MMYYYY')) and ".
	 				"a.kdpertanggungan='2' and ".
	 				"c.status IN ('0','1') and ".
					"$getnopenagih ".
					"e.kdrayonpenagih='$kantor' ".
       "order by namapenagih ".
		   ") s ".
	     "where k='$get'";
			 
			    //echo $sql;
					$DB->parse($sql);
					$DB->execute();
				
							echo "<br><a class=\"verdana10blk\"><b>Billing Booking Bulan $bln $vthn Kantor $kantor $penagih</b></a>";
							echo "<table>";
					    echo "<tr>";
							echo "<td class=\"verdana9blk\" colspan=15>Halaman : ".$get."</td>";
							echo "</tr>";
							echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pol. Lama</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertanggn.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Pemegang Polis</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>JUA</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</font></b></td>");
						  echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Penagih</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl Cetak Kwi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</b></font></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
								$sttcetak=$arr["STATUS"];
								if($sttcetak=="1"){
								  $sttcetak="SUDAH";
							  } else {
								  $sttcetak="BELUM";
								}
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPOL"]."</font></td>");
						  echo("<td align=center><font face=Verdana size=1>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAPEMEGANGPOLIS"]."</font></td>");
					 		echo "<td class=verdana7blk>".$arr["KDPRODUK"]."</td>";
							echo "<td class=verdana7blk>".$arr["NOTASI"]."</td>";
							echo "<td class=verdana7blk align=right>".number_format($arr["JUAMAINPRODUK"],2)."</td>";
							echo "<td class=verdana7blk align=right>".number_format($arr["PREMI1"],2)."</td>";
							echo "<td class=verdana7blk>".$arr["NAMACARABAYAR"]."</td>";
							echo("<td class=verdana7blk>".$arr["NAMAPENAGIH"]."</td>"); 
							echo "<td align=center class=verdana7blk>".$arr["TGLCETAK"]."</td>";
							echo "<td class=verdana7blk align=\"center\">".$sttcetak."</td>";
							echo "</td>";
							echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";

					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Sistem Informasi</a>";
?>
&nbsp;&nbsp;&nbsp;
</body>