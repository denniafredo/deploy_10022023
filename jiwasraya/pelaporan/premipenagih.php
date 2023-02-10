<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";

	?>
<html>
<head>
<title>Untitled</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<table width="1000">
  <tr class="arial10blkb">
    <td width="100%" align="center">INFORMASI PENERIMAAN PREMI KANTOR <? echo $kantor; ?> PER PENAGIH</td>
	</tr>
</table>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Bulan Entry</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?		
		      if($vbln==""){
							   $DB=new Database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode="to_char(b.tglseatled,'mmyyyy')='$thisperiode'";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode="to_char(b.tglseatled,'yyyy')='$thisperiode'";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode="to_char(b.tglseatled,'mmyyyy')='$thisperiode'";
          }
					switch ($bln)	{
		          case "01": $blnn = "Januari"; break;
	            case "02": $blnn = "Pebruari"; break;
	            case "03": $blnn = "Maret"; break;
		          case "04": $blnn = "April"; break;
		          case "05": $blnn = "Mei"; break;
		          case "06": $blnn = "Juni"; break;
		          case "07": $blnn = "Juli"; break;
		          case "08": $blnn = "Agustus"; break;
		          case "09": $blnn = "September"; break;
		          case "10": $blnn = "Oktober"; break;
		          case "11": $blnn = "Nopember"; break;
		          case "12": $blnn = "Desember"; break;
           }
					 
$DB=new Database($userid, $passwd, $DBName);	

 $qry = "select ".
          "c.prefixpenagih,c.nopenagih,d.namaklien1,".
          "count(a.nopertanggungan) liunpolis,".
          "sum(b.nilairp) jmlrupiah ".
        "from ".
          "$DBUser.tabel_300_historis_premi b,".
          "$DBUser.tabel_100_klien d,".
          "$DBUser.tabel_200_pertanggungan a,".
          "$DBUser.tabel_500_penagih c  ".
        "where ".
          "a.prefixpertanggungan=b.prefixpertanggungan and ".
          "a.nopertanggungan=b.nopertanggungan and ".
          "a.nopenagih=c.nopenagih and ".
          "a.nopenagih=d.noklien and ".
					"c.kdstatuspenagih!='04' and ".
          "c.kdrayonpenagih='$kantor' and ".
					"$periode ".
        "group by c.prefixpenagih,c.nopenagih,d.namaklien1 ".
        "order by jmlrupiah desc";	 
		    //echo $qry;		 
				$DB->parse($qry);
				$DB->execute();
					
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>Jumlah Polis dan Premi Penagih Kantor ".$kantor." Bulan $blnn $vthn</b></font><br><br>";
					 echo "<table>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>NO. PENAGIH</b></td>";
					 echo "<td align=center><b>NAMA</b></td>";
					 echo "<td align=center><b>JML. POLIS</b></td>";
					 echo "<td align=center><b>JML. RUPIAH</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomorpenagih=$arr["NOPENAGIH"];
					 $jmlpol = $arr["LIUNPOLIS"];

	           $jmlpolis = ($jmlpol=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('infopremipenagih.php?nopenagih=$nomorpenagih&vbln=$bln&vthn=$vthn','popuppage','1000','300','yes')\"><b>$jmlpol</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXPENAGIH"]."-".$arr["NOPENAGIH"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$jmlpolis."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format($arr["JMLRUPIAH"],2)."</td>";
  				 echo "</tr>";
					 $i++;
					 $jmltotalpolis+=$jmlpol;
					 $jmltotalrupiah+=$arr["JMLRUPIAH"];
					 }			
					 echo "<tr>";
					 echo "<td colspan=3 class=verdana8blk align=right>Jumlah</td><td class=verdana8blk align=right><b>$jmltotalpolis</b></td><td class=verdana8blk align=right>".number_format($jmltotalrupiah,2)."</td>";	 
					 echo "</tr>";
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Polis untuk melihat detail pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
