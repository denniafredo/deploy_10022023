<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	
	$DB=new Database($userid, $passwd, $DBName);	
  
	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS PENAGIH</B></font><br>";
	?>
	<title>Info Polis Per Penagih</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>	
	
<?
	$qry = "select a.prefixpenagih,a.nopenagih,".
	       "decode(a.kdstatuspenagih,'01','TARGET TERCAPAI','02','TARGET TIDAK TERCAPAI','03','AKTIF','NON AKTIF') statuspenagih,".
	       "b.namaklien1,c.namapangkatpenagih,d.namakelaspenagih,e.namajenjangpenagih,".
				 "f.namajabatanpenagih,g.namarayonpenagih ".
				 "from $DBUser.tabel_100_klien b,$DBUser.tabel_500_penagih a,$DBUser.tabel_505_kode_pangkat_penagih c,".
				 "$DBUser.tabel_506_kode_kelas_penagih d,$DBUser.tabel_507_kode_jenjang_penagih e,".
				 "$DBUser.tabel_512_jabatan_penagih f,$DBUser.tabel_502_rayon_penagih g ".
				 "where ".
				 "a.nopenagih=b.noklien and a.kdpangkatpenagih=c.kdpangkatpenagih and ".
				 "a.kdkelaspenagih=d.kdkelaspenagih and a.kdjenjangpenagih=e.kdjenjangpenagih and ".
				 "a.kdjabatanpenagih=f.kdjabatanpenagih(+) and a.kdrayonpenagih=g.kdrayonpenagih and ".
				 "a.nopenagih='$nopenagih' and a.kdrayonpenagih='$kantor'";

				 $DB->parse($qry);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $namapenagih=$ars["NAMAKLIEN1"];	
				 $pangkatpenagih=$ars["NAMAPANGKATPENAGIH"];
  if(!$namapenagih){
	 echo "<hr size=1>";
	 echo "<font color=red>Penagih nomor $nopenagih bukan penagih kantor $kantor</font>";
	} else {
	echo "<hr size=1>";
  ?>
	<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="700">
  <tr>
    <td class=verdana8blk>Nomor Penagih</td>
    <td class=verdana8blk>: <? echo $ars["NOPENAGIH"]; ?></td>
    <td class=verdana8blk>Jenjang</td>
    <td class=verdana8blk>: <? echo $ars["NAMAJENJANGPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class=verdana8blk>Nama </td>
    <td class=verdana8blk>: <? echo $ars["NAMAKLIEN1"]; ?></td>
    <td class=verdana8blk>Jabatan</td>
    <td class=verdana8blk>: <? echo $ars["NAMAJABATANPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class=verdana8blk>Pangkat</td>
    <td class=verdana8blk>: <? echo $ars["NAMAPANGKATPENAGIH"]; ?></td>
    <td class=verdana8blk>Rayon Penagih</td>
    <td class=verdana8blk>: <? echo $ars["NAMARAYONPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class=verdana8blk>Kelas</td>
    <td class=verdana8blk>: <? echo $ars["NAMAKELASPENAGIH"]; ?></td>
    <td class=verdana8blk>Status</td>
    <td class=verdana8blk>: <? echo $ars["STATUSPENAGIH"]; ?></td>
  </tr>
</table>

	<?
	echo "<hr size=1>";
  if($vbln==""){
	  $thisperiode="$vthn";
		$periode="to_char(b.tglseatled,'yyyy')='$thisperiode'";
  }else{
		$bln = substr(("0".$vbln),-2);
	  $thisperiode="$bln$vthn";
		$periode="to_char(b.tglseatled,'mmyyyy')='$thisperiode'";
  }
	echo "<div align=center>";

					$sql = "select ".
                    "a.nopenagih,a.mulas,a.kdstatusmedical,a.kdproduk,".
										"decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi,".
                    "a.prefixpertanggungan,a.nopertanggungan,a.kdvaluta,a.kdcarabayar,".
                    "b.nilairp jmlrupiah,b.premitagihan,b.tglbooked,b.tglseatled ".
                  "from ".
                    "$DBUser.tabel_300_historis_premi b,".
                    //"$DBUser.tabel_100_klien d,".
                    "$DBUser.tabel_200_pertanggungan a,".
                    "$DBUser.tabel_500_penagih c  ".
                  "where ".
                    "a.prefixpertanggungan=b.prefixpertanggungan and ".
                    "a.nopertanggungan=b.nopertanggungan and ".
                    "a.nopenagih=c.nopenagih and ".
                    //"a.notertanggung=d.noklien and ".
                    "c.kdrayonpenagih='$kantor' and ".
                    "a.nopenagih='$nopenagih' and ".
                    $periode." ". 
                  "order by jmlrupiah desc";		 
					
					$DB->parse($sql);
					$DB->execute();
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
					 echo "<a class=verdana10blk><b>Daftar Polis Periode $bln $vthn</b></a><br><br>";
					 		echo "<table>";
					    echo("<tr class=\"hijao\">");
							echo("<td align=center><b>No</b></td>");
							echo("<td align=center><b>No.Pert.</b></td>");
							echo("<td align=center><b>Tertanggung</b></td>");
					    echo("<td align=center><b>Produk</b></td>");
							echo("<td align=center><b>Mulai</b></td>");
							echo("<td align=center><b>Expirasi</b></td>");
							echo("<td align=center><b>Stt.Med</b></td>");
							echo("<td align=center><b>Cara Bayar</b></td>");
							echo("<td align=center><b>Val</b></td>");
							echo("<td align=center><b>J U A</b></td>");
							echo("<td align=center><b>Premi 1</b></td>");
							echo("<td align=center><b>Premi 2</b></td>");
							echo("<td align=center><b>Status</b></td>");
							echo("</tr>");					 
							$i=1;
					 while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="BELUM"; break;
							 default : $sendemail; break; 
							}
							
							include "../../includes/belang.php";$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
              echo("<td class=verdana8blk>".$i."</td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td class=verdana8blk>".$PER->namatertanggung."</td>");
					 		echo("<td class=verdana8blk>".$arr["KDPRODUK"]."</td>");
							echo("<td class=verdana8blk align=center>".$arr["MULAS"]."</td>");
							echo("<td class=verdana8blk align=center>".$PER->expirasi."</td>");
							echo("<td class=verdana8blk align=center>".$arr["KDSTATUSMEDICAL"]."</td>");
		          echo("<td class=verdana8blk>".$PER->namacarabayar."</td>");
		          echo("<td class=verdana8blk>".$arr["NOTASI"]."</td>");      
							echo("<td class=verdana8blk align=right>".number_format($PER->jua,2)."</td>");
		      		echo("<td class=verdana8blk align=right>".number_format($PER->premi1,2)."</td>");
							echo("<td class=verdana8blk align=right>".number_format($PER->premi2,2)."</td>");
							echo("<td class=verdana8blk>".$PER->namastatusfile."</td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
				}
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"#\" onclick=\"NewWindow('cetakinfopolispenagih.php?nopenagih=".$ars["NOPENAGIH"]."&vbln=$vbln&vthn=$vthn','popuppage','1000','300','yes')\">CETAK</a>";
					 ?>
					 &nbsp;&nbsp;&nbsp;<a class=verdana10blk href="javascript:window.close();">CLOSE</a>