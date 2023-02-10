<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	
	$DB=new Database($userid, $passwd, $DBName);		
	$DA=new Database($userid, $passwd, $DBName);		
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<a class=verdana10blk><b>INFORMASI PROPOSAL KANTOR $kantor PER AGEN</b></a>";	
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
					 

	$qry = "select r.prefixagen,r.noagen,x.namaklien1, ".
         "decode(r.kdstatusagen,'01','AKTIF','NON AKTIF') statusagen, ".
         "p.namapangkat,j.namajenjangagen,k.namakelasagen ".
         "from ".
				    "$DBUser.tabel_100_klien x, ".
            "$DBUser.tabel_400_agen r, ".
            "$DBUser.tabel_406_kode_pangkat_agen p, ".
            "$DBUser.tabel_407_kode_jenjang_agen j, ".
            "$DBUser.tabel_408_kode_kelas_agen k ".
         "where ".
            "r.noagen=x.noklien and ".
            "r.kdpangkat=p.kdpangkat and ".
            "r.kdjenjangagen=j.kdjenjangagen and ".
            "r.kdkelasagen=k.kdkelasagen and ".
            "r.prefixagen = '$kantor' ".
					"order by r.noagen";	
				//echo $qry;
				  $DB->parse($qry);
					$DB->execute();
					
  echo "<hr size=1>";
	echo "<div align=center>";
	//echo "<a class=verdana10blk>Klik link pada kolom jumlah Proposal untuk melihat detail pertanggungan</a><br><BR>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Proposal Agen Kantor ".$kantor." Periode $blnn $vthn</b></font><br><br>";
					 echo "<table>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>NO. AGEN</b></td>";
					 echo "<td align=center><b>NAMA</b></td>";
					 echo "<td align=center><b>JML. PROPOSAL</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomoragen=$arr["NOAGEN"];
					 $sql = "select count(*) liunprop from $DBUser.tabel_200_pertanggungan a ".
					 			  "where ".
									   "a.noagen='$nomoragen' and ".
										 "a.kdpertanggungan='1' and ".
										 "a.kdstatusfile='1' and ".
										 "a.notertanggung is not null and  ".
										 $periode;
					 //echo $sql;
					 $DA->parse($sql);
					 $DA->execute();
					 $ara=$DA->nextrow();				 
					 $jmlprop = $ara["LIUNPROP"];

	           $jmlproposal = ($jmlprop==0) ? '-' : "<a href=\"#\" onclick=\"NewWindow('infoproposalagen.php?noagen=$nomoragen&vbln=$bln&vthn=$vthn','popuppage','850','300','yes')\"><b>$jmlprop</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]." ".$arr["GELAR"]."</td>";
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
