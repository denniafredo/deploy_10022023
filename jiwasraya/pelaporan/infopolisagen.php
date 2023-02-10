<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/agen.class.php";
	include "../../includes/monthselector.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	//include "../../includes/komisiagen.php";
	
	$DB=new Database($userid, $passwd, $DBName);	
	$AGN=new Agen($userid,$passwd,$noagen);	

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS AGEN</B></font><br>";
	?>
	<title>Polis Agen</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>	
	<?
	if(!$AGN->noagen){
	 echo "<hr size=1>";
	 echo "<font color=red>Agen nomor <b>$noagen</b> bukan agen kantor $kantor</font>";
	} else {
	 echo "<hr size=1>";
  ?>
	<table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1" width="700">
  <tr>
    <td class=verdana9blk>Nomor Agen</td>
    <td class=verdana9blk>: <?=$AGN->prefixagen."-".$AGN->noagen; ?></td>
    <td class=verdana9blk>Jenjang</td>
    <td class=verdana9blk>: <?=$AGN->jenjangagen; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Nama </td>
    <td class=verdana9blk>: <?=$AGN->namaagen; ?></td>
    <td class=verdana9blk>Jabatan</td>
    <td class=verdana9blk>: <?=$AGN->jabatanagen; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Pangkat</td>
    <td class=verdana9blk>: <?=$AGN->pangkatagen; ?></td>
    <td class=verdana9blk>Area Office</td>
    <td class=verdana9blk>: <?=$AGN->areaoffice; ?></td>
  </tr>
  <tr>
    <td class=verdana9blk>Kelas</td>
    <td class=verdana9blk>: <?=$AGN->kelasagen; ?></td>
    <td class=verdana9blk>Status</td>
    <td class=verdana9blk>: <?=$AGN->statusagen; ?></td>
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
					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas, ".
								 
								 "(select komisiagencb from $DBUser.tabel_404_temp where prefixpertanggungan=a.prefixpertanggungan ".
								    "and nopertanggungan=a.nopertanggungan and thnkomisi='1' and ".
								    "kdkomisiagen='01') komisiagen ".
	               
								 "from $DBUser.tabel_200_pertanggungan a ".
			           "where ".
			           "a.noagen='$noagen' and a.kdpertanggungan='2' ".
								 "and notertanggung is not null and ".
								 $periode." ".
								 "order by a.prefixpertanggungan,a.nopertanggungan desc";
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
					 echo "<a class=verdana10blk><b>Daftar Polis Periode $bln $vthn</b></a><br><br>";
					 echo "<table>";
					    echo("<tr class=\"hijao\" >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.BP3</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 2</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Komisi CB</font></b></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Komisi Agen</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							//$KAG=new KomisiAgen($userid,$passwd,$prefix,$nopertanggungan);
							
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							
							include "../../includes/belang.php";	 
							$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namatertanggung."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$PER->produk."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$PER->nobp3."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$PER->expirasi."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namacarabayar."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namavaluta."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->jua,2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi1,2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi2,2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["KOMISIAGEN"],2)."</font></td>");
							//echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($KAG->jmlkomisiagen,2)."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namastatusfile."</font></td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
			 }
			echo "</div>";
			echo "<hr size=1>";
					 ?>
					 <a class=verdana10blk href="javascript:window.close();">CLOSE</a>