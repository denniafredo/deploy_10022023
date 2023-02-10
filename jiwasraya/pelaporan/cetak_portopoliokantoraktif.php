<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=daftar_portofolio_perkantor.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");

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
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<body bgcolor=#cee0ff>";
	//echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS KONVERSI AKTIF KANTOR $kantor </b></a>";
	?>
	<div align="center">
  INFORMASI POLIS KONVERSI <b>AKTIF</b> KANTOR <b><?=$kantor;?></b> AREA OFFICE
			<? 
			$sql="select kdareaoffice,namaareaoffice from $DBUser.tabel_410_area_office ".
					 "where kdkantor='$kantor' and kdareaoffice='$kdao'";
			
			$DBN->parse($sql);
			$DBN->execute();			
			$ao=$DBN->nextrow();
      echo $ao["NAMAAREAOFFICE"];		
			
			?>
			
			          </div>
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
		
#------------------------------ START NAVIGASI ---------------------------------
 
#------------------------------ END NAVIGASI ---------------------------------
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
											 "$DBUser.tabel_400_agen b,".
											 "$DBUser.tabel_500_penagih c ".
								 "where ".
								       "c.kdrayonpenagih='$kantor' and ".
											 "a.kdpertanggungan='2' and ".
                       "a.nopenagih=c.nopenagih and ".
											 "a.noagen=b.noagen(+) and ".
											 $filter.
											 $perao.
											 "a.kdstatusfile='1') s ";
					//echo $sql;
					$DBN->parse($sql);
					$DBN->execute();
  						echo "<table cellpadding=\"2\" cellspacing=\"1\">";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center class=\"verdana7blk\"><b>No</b></td>");
							//echo("<td align=center class=\"verdana7blk\"><b>Update</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No.Pol. Lama</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>No.Pertanggn.</b></td>");
							echo("<td align=center class=\"verdana7blk\"><b>Tertanggung</b></td>");
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
?>
</body>