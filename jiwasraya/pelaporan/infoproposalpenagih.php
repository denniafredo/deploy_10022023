<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include ('../includes/monthselector.php');
	$DB=new Database($userid, $passwd, $DBName);	

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR PROPOSAL PENAGIH</B></font><br>";
	?>
	<title>Proposal Penagih</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<?
		$qry = "select a.prefixpenagih,a.nopenagih,".
	       "decode(a.kdstatuspenagih,'01','TARGET TERCAPAI','02','TARGET TIDAK TERCAPAI','03','AKTIF','NON AKTIF') statuspenagih,".
	       "b.namaklien1,c.namapangkatpenagih,d.namakelaspenagih,e.namajenjangpenagih,".
				 "f.namajabatanpenagih,g.namarayonpenagih ".
				 "from $DBUser.tabel_500_penagih a,$DBUser.tabel_100_klien b,$DBUser.tabel_505_kode_pangkat_penagih c,".
				 "$DBUser.tabel_506_kode_kelas_penagih d,$DBUser.tabel_507_kode_jenjang_penagih e,".
				 "$DBUser.tabel_512_jabatan_penagih f,$DBUser.tabel_502_rayon_penagih g ".
				 "where ".
				 "a.nopenagih=b.noklien(+) and a.kdpangkatpenagih=c.kdpangkatpenagih(+) and ".
				 "a.kdkelaspenagih=d.kdkelaspenagih(+) and a.kdjenjangpenagih=e.kdjenjangpenagih(+) and ".
				 "a.kdjabatanpenagih=f.kdjabatanpenagih(+) and a.kdrayonpenagih=g.kdrayonpenagih(+) and ".
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
    <td class=verdana9blk>Nomor Agen</td>
    <td class=verdana9blk>: <? echo $ars["PREFIXPENAGIH"]." - ".$ars["NOPENAGIH"]; ?></td>
    <td class=verdana9blk>Jenjang</td>
    <td class=verdana9blk>: <? echo $ars["NAMAJENJANGPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Nama </td>
    <td class=verdana9blk>: <? echo $ars["NAMAKLIEN1"]; ?></td>
    <td class=verdana9blk>Jabatan</td>
    <td class=verdana9blk>: <? echo $ars["NAMAJABATANPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Pangkat</td>
    <td class=verdana9blk>: <? echo $ars["NAMAPANGKATPENAGIH"]; ?></td>
    <td class=verdana9blk>Rayon Penagih</td>
    <td class=verdana9blk>: <? echo $ars["NAMARAYONPENAGIH"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Kelas</td>
    <td class=verdana9blk>: <? echo $ars["NAMAKELASPENAGIH"]; ?></td>
    <td class=verdana9blk>Status</td>
    <td class=verdana9blk>: <? echo $ars["STATUSPENAGIH"]; ?></td>
  </tr>
</table>

	<?
	echo "<hr size=1>";
  if($vbln==""){
	  $thisperiode="$vthn";
		$periode="to_char(a.mulas,'yyyy')='$thisperiode'";
  }else{
		$bln = substr(("0".$vbln),-2);
	  $thisperiode="$bln$vthn";
		$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
  }
	echo "<div align=center>";
	
				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       "a.kdstatusmedical,".
					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b ".
			           "where a.notertanggung=b.noklien(+) ".
			           "and a.nopenagih='$nopenagih' and a.kdpertanggungan='1' ".
								 "and notertanggung is not null and $periode ".
								 "order by a.nopertanggungan desc";
								 
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
					 echo "<a class=verdana10blk><b>Daftar Proposal Periode $bln $vthn</b></a><br><br>";
					 echo "<table>";
					    echo("<tr class=\"hijao\">");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai Ass</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Last Update</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Send Email</font></b></td>");
 							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Update</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							
							include "../../includes/belang.php";	 
							
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt','scrollbars=yes,width=700,height=400,top=100,left=100');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$sendemail."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"../proposal/ntrypropmtc.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$prefix\">UPDATE</a></font></td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
    			}
					 echo "</div>";
					 echo "<hr size=1>";
					 ?>
					 <a class=verdana10blk href="javascript:window.close();">CLOSE</a>