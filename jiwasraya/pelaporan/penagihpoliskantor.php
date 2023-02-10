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
    <td width="100%" align="center">INFORMASI POLIS KANTOR <? echo $kantor; ?> PER PENAGIH</td>
	</tr>
</table>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Periode (Mulai Asuransi)</td>
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
								 $periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode="to_char(a.mulas,'yyyy')='$thisperiode'";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
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
	
$qry="select r.prefixpenagih,r.nopenagih,x.namaklien1,s.liunpolis ".
     "from ". 
		    "$DBUser.tabel_100_klien x,".
        "$DBUser.tabel_500_penagih r,".     
        "(select a.nopenagih,count(a.nopertanggungan) liunpolis ".
        "from ".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b ".
             "where ".
                 "a.nopenagih=b.nopenagih and ".
                 "kdpertanggungan='2' and ".
                 "b.kdrayonpenagih='$kantor' and ".
								 "$periode ".
             "group by a.nopenagih) s ".
     "where ".
     "r.nopenagih=s.nopenagih(+) and ".
     "r.nopenagih=x.noklien and ".
		 "r.kdstatuspenagih!='04' and ".
     "r.kdrayonpenagih='$kantor' order by x.namaklien1";
	 
				  $DB->parse($qry);
					$DB->execute();
					
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Penagih Kantor ".$kantor." Periode $blnn $vthn</b></font><br><br>";
					 echo "<table>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>NO. PENAGIH</b></td>";
					 echo "<td align=center><b>NAMA</b></td>";
					 echo "<td align=center><b>JML. POLIS</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomorpenagih=$arr["NOPENAGIH"];
					 $jmlpol = $arr["LIUNPOLIS"];

	           $jmlproposal = ($jmlpol=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('infopolispenagih.php?nopenagih=$nomorpenagih&vbln=$bln&vthn=$vthn','popuppage','1000','300','yes')\"><b>$jmlpol</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXPENAGIH"]."-".$arr["NOPENAGIH"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmlproposal."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Polis untuk melihat detail pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
