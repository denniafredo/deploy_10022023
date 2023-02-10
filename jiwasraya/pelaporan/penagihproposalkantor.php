<? 
  include "../../includes/database.php";  
  include "../../includes/session.php"; 
	include "../../includes/common.php"; 
	include "../../includes/monthselector.php";
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<a class=verdana10blk><b>INFORMASI PROPOSAL KANTOR $kantor PER PENAGIH</b></a>";	
	echo "<hr size=1>";
	?>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

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
	
$qry="select r.prefixpenagih,r.nopenagih,x.namaklien1,s.liunprop ".
     "from ". 
		    "$DBUser.tabel_100_klien x, ".
        "$DBUser.tabel_500_penagih r,".     
        "(select a.nopenagih,count(a.nopertanggungan) liunprop ".
        "from ".
             "$DBUser.tabel_200_pertanggungan a,".
             "$DBUser.tabel_500_penagih b ".
             "where ".
                 "a.nopenagih=b.nopenagih and ".
                 "kdpertanggungan='1' and ".
								 "kdstatusfile='1' and ".
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
  				 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Proposal Penagih Kantor ".$kantor." Periode $blnn $vthn</b></font><br><br>";
					 echo "<table>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>NO. PENAGIH</b></td>";
					 echo "<td align=center><b>NAMA</b></td>";
					 echo "<td align=center><b>JML. PROPOSAL</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomorpenagih=$arr["NOPENAGIH"];
					 $jmlprop = $arr["LIUNPROP"];

	           $jmlproposal = ($jmlprop=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('infoproposalpenagih.php?nopenagih=$nomorpenagih&vbln=$bln&vthn=$vthn','popuppage','850','300','yes')\"><b>$jmlprop</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXPENAGIH"]."-".$arr["NOPENAGIH"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmlproposal."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Proposal untuk melihat detail pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
