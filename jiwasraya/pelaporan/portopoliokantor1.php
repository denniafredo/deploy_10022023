<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	$DBN=new Database("JSADM","JSADM","JSDB10");	
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
	echo "<a class=\"verdana10blk\">Klik </a><a class=verdana10blk href=\"updatepenagihkonversi?lihat=$lihat&start=1&end=200&page=1\">disini</a> <a class=\"verdana10blk\">untuk update data per halaman.</a>";
	echo "<div align=center>";

	$sqla = "select count(a.nopertanggungan) jml from $DBUser.tabel_200_pertanggungan a, ".
	        "$DBUser.tabel_500_penagih b ".
	        "where a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor'";
		$DBN->parse($sqla);
		$DBN->execute();
		$ara=$DBN->nextrow();
		$jml = $ara["JML"];
		echo "<br><a class=\"verdana10blk\"><b>JUMLAH POLIS : ".$jml."</b></a><br><BR>";
		echo "<a class=verdana10blk>Page : </a>";
		$perhal=200;
		$pg = ceil($jml / $perhal);
		//$pg = ceil($pg);
		for ($i = 1; $i <= $pg; $i++) {
		$awal = $perhal*($i-1)+1;
		$akhir = $perhal*$i;

		 if ($page==$i) {
		  print "<font type=Verdana color=#660099 size=3><b>$i</b></font> ";
     } else {
      print "<a class=verdana10blk href=\"portopoliokantor.php?lihat=$lihat&start=$awal&end=$akhir&page=$i\">".$i." </a>";
     } 
    }
	#-------------------------------------------------------------------------

					$sql = "select s.*,x.namaklien1 as namapenagih,y.namaklien1 as namaagen,".
					       "d.namacarabayar from ".
					       "(select rownum k,".
                 "a.nopol,a.prefixpertanggungan,a.nopertanggungan,".
                 "a.notertanggung,a.juamainproduk,a.premi1,premi2,".
								 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') namavaluta, ".
								 "a.kdcarabayar,a.kdproduk,a.nopenagih,a.noagen,".
                 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.kdstatusfile,".
								 "decode(a.kdstatusfile,'1','AKTIF','2','NON-AKTIF','3','EKSPIRASI','4','BPO','5','TEBUS','7','DELETE','KLAIM') statusfile,".
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
								 "k between $start and $end and ".
								 "s.kdcarabayar=d.kdcarabayar and ".
								 "s.nopenagih=x.noklien and ".
								 "s.noagen=y.noklien(+) ";		 
						 
					//echo $sql."<br>";
					
					$DBN->parse($sql);
					$DBN->execute();
						  echo "<font color=\"003399\" face=verdana size=2><br><br><b>Daftar Polis Kantor ".$kantor." Hasil Konversi</b></font><br><br>";
 	 					  echo "<table>";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pol. Lama</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Penagih</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Agen</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 2</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Masa As(TH)</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Update</b></font></td>");
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
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAVALUTA"]."</font></td>"); 
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAPENAGIH"]."</font></td>"); 
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAAGEN"]."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI2"],2)."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["LAMAASURANSI_TH"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["STATUSFILE"]."</font></td>");
							echo("<td align=center><input type=\"submit\" value=\"UPDATE\" name=\"update\" onclick=\"NewWindow(".

							"'updatekonversi.php?prefix=$prefix&noper=$noper&namattg=$namattg&noagen=$noagen&nopenagih=$nopenagih&kdstatusfile=$kdstatusfile&namapenagih=$namapenagih&namaagen=$namaagen&kdproduk=$kdproduk',".
							"'popkonversi','500','300','yes');return false;\" style=\"font-family: Verdana; font-size: 8pt\"></td>");
			
							echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
					 echo "<br><a class=verdana10blk>Page : </a>";
					 for ($i = 1; $i <= $pg; $i++) {
		       $awal = $perhal*($i-1)+1;
		       $akhir = $perhal*$i;
		       if ($page==$i) {
		        print "<font type=Verdana color=#660099 size=3><b>$i</b></font> ";
           } else {
             print "<a class=verdana10blk href=\"portopoliokantor?lihat=$lihat&start=$awal&end=$akhir&page=$i\">".$i." </a>";
           } 
           }
					 echo "</div>";
				
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
&nbsp;&nbsp;&nbsp;<a class="verdana10blk" href="javascript:window.print();">Cetak</a>
</body>