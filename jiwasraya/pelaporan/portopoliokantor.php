<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	$DBN = new Database($userid, $passwd, $DBName);
	//$DBN=new Database("JSADM","JSADM","JSDB10");	
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
	echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS KONVERSI KANTOR $kantor </b></a>";
  echo "<hr size=1>";
	
	//echo "<a class=verdana8blk href=\"updatepenagihkonversi.php?lihat=$lihat&start=1&end=200&page=1\">| Update data per halaman </a>";
	//echo "<a class=verdana8blk href=\"updatekonversisatuan.php\">| Update data per polis |</a>";
	//echo "<br>";
	echo "<div align=center>";
  
	$sqla = "select count(a.nopertanggungan) jml from $DBUser.tabel_200_pertanggungan a, ".
	        "$DBUser.tabel_500_penagih b ".
	        "where a.nopenagih=b.nopenagih and a.kdpertanggungan='2' ".
					"and b.kdrayonpenagih='$kantor' and a.kdstatusfile='1'";
		$DBN->parse($sqla);
		$DBN->execute();
		$ara=$DBN->nextrow();
		$jml = $ara["JML"];

		$perhal=40;
		$pg = ceil($jml / $perhal);

    include "../../includes/navigasipage.php";  
    /*
					$sql = "select s.*,x.namaklien1 as namapenagih,y.namaklien1 as namaagen,".
					       "d.namacarabayar ".
								 "from ".
								 "$DBUser.tabel_100_klien x,".
								 "$DBUser.tabel_100_klien y, ".
					       "(select floor((rownum-1)/40) + 1 k,".
                   "a.nopol,a.prefixpertanggungan,a.nopertanggungan,".
                   "a.notertanggung,a.juamainproduk,a.premi1,premi2,".
								   "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
								   "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,".
                   "to_char(a.mulas,'MM/YYYY') mulas,a.kdstatusfile,".
								   "decode(a.kdstatusfile,'1','AKTIF','2','NON-AKTIF','3','EKSPIRASI','4','BPO','5','TEBUS','7','DELETE','KLAIM') statusfile,".
                   "to_char(a.expirasi,'MM/YYYY') expirasi,".
                   "a.lamaasuransi_th,b.namaklien1 as namattg ".
                   "from ".
								   "$DBUser.tabel_100_klien b, ".
                   "$DBUser.tabel_200_pertanggungan a,".
								   "$DBUser.tabel_500_penagih c ".
								   "where ".
								   "c.kdrayonpenagih='$kantor' and ".
                   "a.notertanggung=b.noklien and ".
								   "a.kdpertanggungan='2' and ".
								   "a.nopenagih=c.nopenagih and a.kdstatusfile='1') s,".
								 "$DBUser.tabel_305_cara_bayar d ".
								 "where ".
								 "k='$get' and ".
								 "s.kdcarabayar=d.kdcarabayar and ".
								 "s.nopenagih=x.noklien(+) and ".
								 "s.noagen=y.noklien(+)";		 
					//echo "<br><br>".$sql."<br><br>";
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
                       "a.juamainproduk,a.premi1,premi2,indexawal,".
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
                       "a.nopenagih=c.nopenagih and a.kdstatusfile='1') s ".
            "where ".
                 "k='$get'";
					$DBN->parse($sql);
					$DBN->execute();
  						echo "<table width=1200 cellpadding=\"0\" cellspacing=\"0\">";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center class=\"verdana7blk\"><b>No</b></td>");
							//echo("<td align=center class=\"verdana7blk\"><b>Update</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No.Pol. Lama</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No.Pertanggn.</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Tertanggung</b></td>");
					    echo("<td align=center class=\"verdana7blk\"><b>Produk</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>CaBar</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Valuta</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Penagih</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Agen</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>J U A</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Premi 1</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Premi 2</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>IndexAwal</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Mulai</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Expirasi</b></td>");
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
						  echo("<td align=center class=\"verdana7blk\" >".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>");
		          echo("<td class=\"verdana7blk\">".$arr["NAMATTG"]."</td>");
					 		echo("<td class=\"verdana7blk\">".$arr["KDPRODUK"]."</td>");
							echo("<td class=\"verdana7blk\">".$carabayar."</td>");
		          echo("<td class=\"verdana7blk\">".$arr["NAMAVALUTA"]."</td>"); 
							echo("<td class=\"verdana7blk\">".$penagih."</td>"); 
							echo("<td class=\"verdana7blk\">".$arr["NAMAAGEN"]."</td>");      
							echo("<td align=right class=\"verdana7blk\">".number_format($arr["JUAMAINPRODUK"],2)."</td>");
		      		echo("<td align=right class=\"verdana7blk\">".number_format($arr["PREMI1"],2)."</td>");
							echo("<td align=right class=\"verdana7blk\">".number_format($arr["PREMI2"],2)."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["INDEXAWAL"]."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["MULAS"]."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["EXPIRASI"]."</td>");
							echo("<td align=center class=\"verdana7blk\">".$arr["STATUSFILE"]."</td>");
			
							echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";

					 //echo "<hr size=1>";
					 echo "<a class=verdana8blk href=\"index.php\">Menu Pelaporan</a>";
?>
&nbsp;&nbsp;&nbsp;<a class="verdana8blk" href="javascript:window.print();">Cetak</a>
</body>