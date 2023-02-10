<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	
	$DBN = new Database($userid, $passwd, $DBName);	
	echo "<title>DAFTAR POLIS PER PENAGIH</title>";
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
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<body bgcolor=#cee0ff>";
	echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS KONVERSI AKTIF KANTOR $kantor </b></a>";
  echo "<hr size=1>";
	echo "<div align=center>";
  
	$sqla = "select count(a.nopertanggungan) jml from $DBUser.tabel_200_pertanggungan a, ".
	        "$DBUser.tabel_500_penagih b ".
	        "where a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' and ".
					"a.kdpertanggungan='2' and a.kdstatusfile='1' and b.nopenagih='$nopenagih'";
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
	var nopenagih=document.clntmtc.nopng.value;
	var xxx = parseInt(document.clntmtc.carihal.value);
	  nextpg = xxx + 10;
		if((xxx < 11)||(halcari =='')) {
		  window.location.replace('portopoliokantorpenagih.php?action=list&maju=ok&lastpg=11&get='+halcari+'&nopenagih='+nopenagih+'');
    }else {
		  window.location.replace('portopoliokantorpenagih.php?action=list&maju=ok&lastpg='+nextpg+'&get='+halcari+'&nopenagih='+nopenagih+'');
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
#------------------------------------ PREV -------------------------------
if(!$get){
 $get=1;
}

if(!$linkp){
$linkp = $starthal - 10;
}

if($get<11){
 $urlp = $PHP_SELF; 
} else {
 $urlp = $PHP_SELF . "?action=list&mundur=ok&lastpg=$xx&get=$linkp&users=$users&nopenagih=$nopenagih"; 
}

if ($starthal==1){
print("<a class=verdana10blk><b>Prev</b> |</a>"); 
} else {
print("<a class=verdana10blk href=\"$urlp\" title=\"Previous Results\"><b>Prev</b></a> |&nbsp;"); 
}
#-------------------------------------------------------------------------
for ($i = $starthal; $i < $total_pages; $i++) { 
if ($mundur){
   $a = $xx + 10;
   $url = $PHP_SELF . "?action=list&mundur=ok&lastpg=$a&get=$i&users=$users&nopenagih=$nopenagih"; 
} else {
   $a = $total_pages;
   $url = $PHP_SELF . "?action=list&maju=ok&lastpg=$a&get=$i&users=$users&nopenagih=$nopenagih"; 
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
$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm&users=$users&nopenagih=$nopenagih";
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

 ?>
</td>
<td class=verdana10blk>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td class=verdana10blk>
Jump to page
</td>
<td>
 <input type="text" name="carihal" size="5" maxlength="5" onfocus="highlight(event)" onblur="CariNama();">
 <input type="hidden" name="nopng" value="<? echo $nopenagih; ?>">
</td>
<td class=verdana10blk>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<? echo "Halaman : ".$get; ?>
</td>
</tr>
 </form>
</table>
<? 
#------------------------------ END NAVIGASI ---------------------------------
			$sql="select ".
					       "s.*,".
								 
								 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.nopenagih) as namapenagih,".
                 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.noagen) as namaagen,".
                 "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=s.kdcarabayar) as namacarabayar, ".
                 "(select namaklien1 from $DBUser.tabel_100_klien where noklien= s.notertanggung) as namattg ".
           "from ".
                 "(select floor((rownum-1)/40) + 1 k,".
                       "a.nopol,a.prefixpertanggungan,a.nopertanggungan,a.notertanggung,a.indexawal,".
                       "a.juamainproduk,a.premi1,premi2,".
                       "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
                       "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,to_char(a.mulas,'MM/YYYY') mulas,".
                       "a.kdstatusfile,".
                       "decode(a.kdstatusfile,'1','AKTIF','2','NON-AKTIF','3','EKSPIRASI','4','BPO','5','TEBUS','7','DELETE','KLAIM') statusfile,".
                       "to_char(a.expirasi,'MM/YYYY') expirasi,a.lamaasuransi_th, ".
											 "(SELECT TO_CHAR(MAX(tglbooked),'DD/MM/YYYY') FROM ".
	  									 "$DBUser.TABEL_300_HISTORIS_PREMI WHERE tglseatled IS NOT NULL AND ".
	  									 "prefixpertanggungan=a.prefixpertanggungan AND nopertanggungan=a.nopertanggungan) lunasterakhir ".
											 /*
											 "(select to_char(tglbooked,'DD/MM/YYYY') from $DBUser.tabel_300_historis_premi where tglseatled in ".
                        "(select max(tglseatled) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
                        ") and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) lunasterakhir ".
								 				*/
                 "from ".
								       "$DBUser.tabel_200_pertanggungan a,".
											 "$DBUser.tabel_500_penagih c ".
								 "where ".
								       "c.kdrayonpenagih='$kantor' and ".
											 "a.kdpertanggungan='2' and ".
											 "a.nopenagih='$nopenagih' and ".
                       "a.nopenagih=c.nopenagih and a.kdstatusfile='1') s ".
            "where ".
                 "k='$get'";
								 //echo $sql;
					$DBN->parse($sql);
					$DBN->execute();
  						echo "<table width=1200 cellpadding=\"2\" cellspacing=\"1\">";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center class=\"verdana7blk\"><b>No</b></td>");
							//echo("<td align=center class=\"verdana7blk\"><b>Update</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No.Pol. Lama</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No.Pertanggn.</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Tertanggung</b></td>");
					    echo("<td align=center class=\"verdana7blk\"><b>Produk</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>CaBar</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Penagih</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Agen</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Index Awal</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>J U A</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Premi 1</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Premi 2</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Mulai</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Expirasi</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Alamat Penagihan</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Bayar Terakhir</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Status</b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DBN->nextrow()) {
							$indexawal=$arr["INDEXAWAL"];
							$noper = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							$noagen = $arr["NOAGEN"];
							$nopenagih = $arr["NOPENAGIH"];
							$namapenagih= $arr["NAMAPENAGIH"];
							$namaagen= $arr["NAMAAGEN"];
							$kdstatusfile = $arr["KDSTATUSFILE"];
							$namattg=$arr["NAMATTG"];
							$kdproduk = $arr["KDPRODUK"];
							$carabayar = $arr["NAMACARABAYAR"];
							$kdcarabayar = $arr["KDCARABAYAR"];
							$KL=New Klien ($userid,$passwd,$arr["NOTERTANGGUNG"]);
							//$carabayar = substr($carabayar,0,3);
						  $nmpenagih = substr($namapenagih,8,8);
							$namattg = ereg_replace("'","~",$namattg);
							$namapenagih = ereg_replace("'","~",$namapenagih);
							$namaagen = ereg_replace("'","~",$namaagen);
						  
						  if ($nmpenagih == "TERMINAL") {
							   $penagih = "TERMINAL";				
							} else {
							   $penagih = $namapenagih;
							}
												
							include "../../includes/belang.php";	 
              echo("<td class=\"verdana7blk\" valign=top>".$i."</td>");
              //echo("<td class=\"verdana7blk\" align=center><input type=\"submit\" value=\"UPDATE\" name=\"update\" onclick=\"NewWindow(".
							//"'updatekonversi.php?prefix=$prefix&noper=$noper&namattg=$namattg&noagen=$noagen&nopenagih=$nopenagih&kdstatusfile=$kdstatusfile&namapenagih=$namapenagih&namaagen=$namaagen&kdproduk=$kdproduk',".
							//"'popkonversi','500','300','yes');return false;\" style=\"font-family: Verdana; font-size: 6pt\"></td>");
	
							echo("<td class=\"verdana7blk\" valign=top>".$arr["NOPOL"]."</td>");
						  echo("<td align=center class=\"verdana7blk\"  valign=top><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td class=\"verdana7blk\" valign=top>".$arr["NAMATTG"]."</td>");
					 		echo("<td class=\"verdana7blk\" valign=top>".$arr["KDPRODUK"]."</td>");
							echo("<td class=\"verdana7blk\" valign=top>".$carabayar."</td>");
							echo("<td class=\"verdana7blk\" valign=top>".$penagih."</td>"); 
							echo("<td class=\"verdana7blk\" valign=top>".$arr["NAMAAGEN"]."</td>"); 
							echo("<td class=\"verdana7blk\" valign=top>".number_format($arr["INDEXAWAL"],2)."</td>");      
							echo("<td align=right class=\"verdana7blk\" valign=top>".number_format($arr["JUAMAINPRODUK"],2)."</td>");
		      		echo("<td align=right class=\"verdana7blk\" valign=top>".number_format($arr["PREMI1"],2)."</td>");
							echo("<td align=right class=\"verdana7blk\" valign=top>".number_format($arr["PREMI2"],2)."</td>");
							echo("<td align=center class=\"verdana7blk\" valign=top>".$arr["MULAS"]."</td>");
							echo("<td align=center class=\"verdana7blk\" valign=top>".$arr["EXPIRASI"]."</td>");
							echo("<td class=\"verdana7blk\" valign=top>".$KL->alamattagih."</td>");
							echo("<td align=center class=\"verdana7blk\" valign=top>".$arr["LUNASTERAKHIR"]."</td>");		
							echo("<td align=center class=\"verdana7blk\" valign=top>".$arr["STATUSFILE"]."</td>");		
							echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
?>
<a class="verdana8blk" href="javascript:window.close();">Close</a>
&nbsp;&nbsp;&nbsp;<a class="verdana8blk" href="javascript:window.print();">Cetak</a>
</body>