<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";	
	$DB=new Database($userid, $passwd, $DBName);	
  
	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR PROPOSAL AGEN KANTOR $kantor</B></font><br>";
	?>
	<title>Proposal Agen</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

<?
	$qry = "select a.prefixagen,a.noagen,decode(a.kdstatusagen,'01','AKTIF','NON AKTIF') statusagen,".
	       "b.namaklien1,c.namapangkat,d.namakelasagen,e.namajenjangagen,f.namajabatanagen,g.namaunitproduksi ".
				 "from $DBUser.tabel_100_klien b,$DBUser.tabel_400_agen a,$DBUser.tabel_406_kode_pangkat_agen c,".
				 "$DBUser.tabel_408_kode_kelas_agen d,$DBUser.tabel_407_kode_jenjang_agen e,".
				 "$DBUser.tabel_413_jabatan_agen f,$DBUser.tabel_410_kode_unit_produksi g ".
				 "where ".
				 "a.noagen=b.noklien(+) and a.kdpangkat=c.kdpangkat(+) and a.kdkelasagen=d.kdkelasagen(+) and ".
				 "a.kdjenjangagen=e.kdjenjangagen(+) and a.kdjabatanagen=f.kdjabatanagen(+) and ".
				 "a.kdunitproduksi=g.kdunitproduksi(+) and ".
				 "a.noagen='$noagen' and a.prefixagen='$kantor'";
				 //echo $qry;
				 $DB->parse($qry);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $namaagen=$ars["NAMAKLIEN1"];	
				 $pangkatagen=$ars["NAMAPANGKAT"];
  if(!$namaagen){
	 echo "<font color=red>Agen nomor <b>$noagen</b> bukan agen kantor $kantor</font>";
	} else {
	echo "<hr size=1>";
  ?>
	<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="700">
  <tr>
    <td class=verdana9blk>Nomor Agen</td>
    <td class=verdana9blk>: <? echo $ars["PREFIXAGEN"]." - ".$ars["NOAGEN"]; ?></td>
    <td class=verdana9blk>Jenjang</td>
    <td class=verdana9blk>: <? echo $ars["NAMAJENJANGAGEN"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Nama </td>
    <td class=verdana9blk>: <? echo $ars["NAMAKLIEN1"]; ?></td>
    <td class=verdana9blk>Jabatan</td>
    <td class=verdana9blk>: <? echo $ars["NAMAJABATANAGEN"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Pangkat</td>
    <td class=verdana9blk>: <? echo $ars["NAMAPANGKAT"]; ?></td>
    <td class=verdana9blk>Unit Produksi</td>
    <td class=verdana9blk>: <? echo $ars["NAMAUNITPRODUKSI"]; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Kelas</td>
    <td class=verdana9blk>: <? echo $ars["NAMAKELASAGEN"]; ?></td>
    <td class=verdana9blk>Status</td>
    <td class=verdana9blk>: <? echo $ars["STATUSAGEN"]; ?></td>
  </tr>
</table>

	<?
	echo "<hr size=1>";
	if($vbln==""){
  //if($vbln=="all"){
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
			           "and a.noagen='$noagen' and a.kdpertanggungan='1' ".
								 "and notertanggung is not null and $periode ".
								 "order by a.nopertanggungan desc";
					//echo $sql;			 
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
					 echo "<table width=100% class=tblisi cellpadding=0 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Nomor</td>");
							echo("<td align=center>Tertanggung</td>");
					    echo("<td align=center>Produk</font></b></td>");
							echo("<td align=center>M</font></b></td>");
							echo("<td align=center>J U A</td>");
							echo("<td align=center>Mulas</td>");
							echo("<td align=center>Premi</td>");
							echo("<td align=center>Last Update</td>");
							echo("<td align=center>Send Email</td>");
 							echo("<td align=center>Update</td>");
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
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
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
