<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	
	$DBN = new Database($userid, $passwd, $DBName);
	
	if($kdao!="")
	{
	  $perao="b.kdareaoffice='$kdao' and ";
	}
	
	if($kdpremijua!="")
	{
	  $filter = "decode(a.kdvaluta,'3',a.$kdpremijua * a.indexawal,a.$kdpremijua) $kdtanda $nilaijuapremi and ";
							//"(a.$kdpremijua*a.indexawal) $kdtanda $nilaijuapremi ".
							//"and indexawal <> 0 and ";
	}
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
	//echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS KONVERSI AKTIF KANTOR $kantor </b></a>";
	?>
	<table>
	  <form action="<?=$PHP_SELF;?>" name="clntmtc" method="post">
		<tr>
		  <td class="verdana10blk"><?=$kdao?>INFORMASI POLIS KONVERSI <b>AKTIF</b> KANTOR <b><?=$kantor;?></b></td>
		  <td class="verdana10blk">AREA OFFICE</td>
			<td>
			<select name="kdao" class="select1">
			<option value="">-SEMUA AREA OFFICE-</option>
			<? 
			$sql="select kdareaoffice,namaareaoffice from $DBUser.tabel_410_area_office ".
					 "where kdkantor='$kantor' order by namaareaoffice";
			$DBN->parse($sql);
			$DBN->execute();
			while ($ao=$DBN->nextrow()) {
			 if($kdao==substr($ao["KDAREAOFFICE"],0,2))
			 {
			   echo "<option value=".$ao["KDAREAOFFICE"]." selected>".$ao["NAMAAREAOFFICE"]."</option>";
			 }
			 else
			 {
			   echo "<option value=".$ao["KDAREAOFFICE"].">".$ao["NAMAAREAOFFICE"]."</option>";
			 }
			}
			?>
			</select>
			</td>
			
			<td>
			<? 
			if($kdpremijua=="premi1")
			{
			  $n1 = "selected";
			} elseif($kdpremijua=="juamainproduk") {
			  $n2 = "selected";
			}
			?>
			<select name="kdpremijua" class="select1">
  			<option value="">- PREMI/JUA -</option>
  			<option value="premi1" <?=$n1;?>>PREMI</option>
  			<option value="juamainproduk" <?=$n2;?>>JUA</option>
			</select>
			</td>
			<td>
			<? 
			if($kdtanda==">")
			{
			  $p1 = "selected";
			} elseif($kdtanda=="<") {
			  $p2 = "selected";
			}
			?>
			<select name="kdtanda" class="select1">
  			<option value=">" <?=$p1;?>>></option>
  			<option value="<" <?=$p2;?>><</option>
			</select>
			
			<input type="text" name="nilaijuapremi" size="15" value="<?=$nilaijuapremi;?>">
			</td>
			
			<td class="verdana10blk"><input type="submit" value="GO" name="submit" /></td>
		</tr>
	</table>
	<?
  echo "<hr size=1>";
	//echo "<a class=verdana8blk href=\"updateaktif.php?lihat=$lihat&start=1&end=200&page=1\">Klik disini untuk update data per halaman</a>";
	echo "<div align=center>";
  
	$sqla = "select count(a.nopertanggungan) jml from ".
  				  "$DBUser.tabel_200_pertanggungan a, ".
  	        "$DBUser.tabel_500_penagih c, ".
						"$DBUser.tabel_400_agen b ".
	        "where ".
						"a.nopenagih=c.nopenagih and c.kdrayonpenagih='$kantor' and ".
					  "a.noagen=b.noagen(+) and ".
						//"b.kdareaoffice='$kdao' and ".
						$filter.
						$perao." ".
						"a.kdpertanggungan='2' and a.kdstatusfile='1'";
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
  var halcari= document.clntmtc.carihal.value;
	var getao  = document.clntmtc.bawaao.value;
	var vpremi = document.clntmtc.kdpremijua.value;
	var vtanda = document.clntmtc.kdtanda.value;
	var vnil   = document.clntmtc.nilaijuapremi.value;
	
	var xxx = parseInt(document.clntmtc.carihal.value);
	  nextpg = xxx + 10;
		if((xxx < 11)||(halcari =='')) {
		  window.location.replace('?action=list&maju=ok&lastpg=11&get='+halcari+'&kdao='+getao+'&kdpremijua='+vpremi+'&kdtanda='+vtanda+'&nilaijuapremi='+vnil+'');
    }else {
		  window.location.replace('?action=list&maju=ok&lastpg='+nextpg+'&get='+halcari+'&kdao='+getao+'&kdpremijua='+vpremi+'&kdtanda='+vtanda+'&nilaijuapremi='+vnil+'');
		}
	}
</script>
<table>

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
 $urlp = $PHP_SELF . "?action=list&mundur=ok&lastpg=$xx&get=$linkp&users=$users&kdao=$kdao"; 
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
   $url = $PHP_SELF . "?action=list&mundur=ok&lastpg=$a&get=$i&users=$users&kdao=$kdao&kdpremijua=$kdpremijua&kdtanda=$kdtanda&nilaijuapremi=$nilaijuapremi"; 
} else {
   $a = $total_pages;
   $url = $PHP_SELF . "?action=list&maju=ok&lastpg=$a&get=$i&users=$users&kdao=$kdao&kdpremijua=$kdpremijua&kdtanda=$kdtanda&nilaijuapremi=$nilaijuapremi"; 
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
$urln = $PHP_SELF . "?action=list&maju=ok&lastpg=$xx&get=$linkm&users=$users&kdao=$kdao&kdpremijua=$kdpremijua&kdtanda=$kdtanda&nilaijuapremi=$nilaijuapremi";
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
 <input type="hidden" name="bawaao" value="<?=$kdao;?>">
 <input type="text" name="carihal" size="5" maxlength="5" onfocus="highlight(event)" onblur="CariNama();">
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
                       "a.nopol,a.prefixpertanggungan,a.nopertanggungan,a.notertanggung, d.alamattetap01,
               d.alamattetap02,
               d.phonetetap01,
               d.phonetetap02,".
                       "a.juamainproduk,a.premi1,premi2,".
                       "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
                       "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,to_char(a.mulas,'MM/YYYY') mulas,".
                       "a.kdstatusfile,".
                       "decode(a.kdstatusfile,'1','AKTIF','2','NON-AKTIF','3','EKSPIRASI','4','BPO','5','TEBUS','7','DELETE','KLAIM') statusfile,".
                       "to_char(a.expirasi,'MM/YYYY') expirasi,a.lamaasuransi_th ".
                 "from ".
								       "$DBUser.tabel_200_pertanggungan a,".
											 "$DBUser.tabel_400_agen b,".
											 "$DBUser.tabel_500_penagih c, ".
												"$DBUser.tabel_100_klien d ".
								 "where ".
								       "c.kdrayonpenagih='$kantor' and ".
											"a.notertanggung = d.noklien and ".
											 "a.kdpertanggungan='2' and ".
                       "a.nopenagih=c.nopenagih and ".
											 "a.noagen=b.noagen(+) and ".
											 $filter.
											 $perao.
											 "a.kdstatusfile='1') s ".
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
							echo("<td align=center class=\"verdana7blk\"><b>Alamat Tetap 1</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Alamat Tetap 2</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No Telp 1</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No Telp 2</b></td>");	
					    echo("<td align=center class=\"verdana7blk\"><b>Produk</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>CaBar</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Val</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Penagih</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Agen</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>J U A</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Premi 1</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Premi 2</b></td>");
							//echo("<td align=center class=\"verdana7blk\"><b>Masa As(TH)</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Mulai</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Expirasi</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Alamat Penagihan</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Status</b></td>");
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
							$carabayar = $arr["NAMACARABAYAR"];
							$carabayar = substr($carabayar,0,3);
						  $nmpenagih = substr($namapenagih,8,8);
							$namattg = ereg_replace("'","~",$namattg);
							$namapenagih = ereg_replace("'","~",$namapenagih);
							$namaagen = ereg_replace("'","~",$namaagen);
							
						  $KL=New Klien ($userid,$passwd,$arr["NOTERTANGGUNG"]);
						  
							if ($nmpenagih == "TERMINAL") {
							   $penagih = "TERMINAL";				
							} else {
							   $penagih = $namapenagih;
							}
												
							include "../../includes/belang.php";	 
              echo("<td class=\"verdana7blk\">".$i."</td>");
              //echo("<td class=\"verdana7blk\" align=center><input type=\"submit\" value=\"UPDATE\" name=\"update\" onclick=\"NewWindow(".
							//"'updatekonversi.php?prefix=$prefix&noper=$noper&namattg=$namattg&noagen=$noagen&nopenagih=$nopenagih&kdstatusfile=$kdstatusfile&namapenagih=$namapenagih&namaagen=$namaagen&kdproduk=$kdproduk',".
							//"'popkonversi','500','300','yes');return false;\" style=\"font-family: Verdana; font-size: 6pt\"></td>");
	
							echo("<td class=\"verdana7blk\">".$arr["NOPOL"]."</td>");
						  echo("<td align=center class=\"verdana7blk\" ><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td class=\"verdana7blk\">".$arr["NAMATTG"]."</td>");
								
								
							echo("<td class=\"verdana7blk\">".$arr["ALAMATTETAP01"]."</td>"); 
							echo("<td class=\"verdana7blk\">".$arr["ALAMATTETAP01"]."</td>"); 
							echo("<td class=\"verdana7blk\">".$arr["PHONETETAP01"]."</td>"); 
							echo("<td class=\"verdana7blk\">".$arr["PHONETETAP02"]."</td>"); 
								
								
					 		echo("<td class=\"verdana7blk\">".$arr["KDPRODUK"]."</td>");
							echo("<td class=\"verdana7blk\">".$carabayar."</td>");
		          echo("<td class=\"verdana7blk\">".$arr["NAMAVALUTA"]."</td>"); 
							echo("<td class=\"verdana7blk\">".$penagih."</td>"); 
							echo("<td class=\"verdana7blk\">".$arr["NAMAAGEN"]."</td>");  
							echo("<td align=right class=\"verdana7blk\">".number_format($arr["JUAMAINPRODUK"],2)."</td>");
		      		echo("<td align=right class=\"verdana7blk\">".number_format($arr["PREMI1"],2)."</td>");
							echo("<td align=right class=\"verdana7blk\">".number_format($arr["PREMI2"],2)."</td>");
							//echo("<td align=center class=\"verdana7blk\">".$arr["LAMAASURANSI_TH"]."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["MULAS"]."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["EXPIRASI"]."</td>");
							echo("<td class=\"verdana7blk\">".$KL->alamattagih."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["STATUSFILE"]."</td>");
							echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";

					 //echo "<hr size=1>";
					 echo "<a class=verdana8blk href=\"index.php\">Menu Pelaporan</a>";
?>
&nbsp;&nbsp;&nbsp;<a class="verdana8blk" href="javascript:window.print();">Cetak</a> | <a class="verdana8blk" href="#" onClick="NewWindow('cetak_portopoliokantoraktif.php?kdpremijua=<?=$kdpremijua; ?>&kdtanda=<?=$kdtanda; ?>&nilaijuapremi<?=$nilaijuapremi; ?>&kdao=<?=$kdao; ?>','cetak',800,250,1);">Download</a>
</body>