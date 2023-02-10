<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/monthselector.php";
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<a class=verdana10blk><b>INFORMASI POLIS KANTOR $kantor PER AGEN</b></a>";	
	echo "<hr size=1>";
	?>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>	
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Periode (Mulai Asuransi)</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td class="verdana10blk">Status Agen</td>
	<td>
		<select name="status">
			<option value="01">AKTIF</option>
			<option value="02">NON-AKTIF</option>
			<option value="00">--- ALL ---</option>
		</select>
	</td>	
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
								 $periode="to_char(mulas,'mmyyyy')='$thisperiode'";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode="to_char(mulas,'yyyy')='$thisperiode'";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode="to_char(mulas,'mmyyyy')='$thisperiode'";
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
					 
			if ($status=="01"){
				$kdstatusagen="and a.kdstatusagen='$status' ";
			}
			else if ($status=="02"){
				$kdstatusagen="and a.kdstatusagen='$status' ";
			}			
			else if ($status=="00"){
				$kdstatusagen="";
			}
			else{
				$kdstatusagen="and a.kdstatusagen='01' ";
			}
  /*
	$qry = "select r.prefixagen,r.noagen,x.namaklien1,s.liunpolis, ".
         "decode(r.kdstatusagen,'01','AKTIF','NON AKTIF') statusagen, ".
         "p.namapangkat,j.namajenjangagen,k.namakelasagen ".
         "from ".
				    "$DBUser.tabel_100_klien x,".
            "$DBUser.tabel_400_agen r,".
            "(select a.noagen,b.namaklien1,count(a.nopertanggungan) liunpolis ".
             "from ".
						     "$DBUser.tabel_100_klien b,".
                 "$DBUser.tabel_200_pertanggungan a ".      
             "where ".
                 "a.notertanggung=b.noklien(+) and ".
                 "a.kdpertanggungan='2' and ".
                 "notertanggung is not null and ".
								 "noagen is not null and ".
                 "$periode ".
             "group by a.noagen,b.namaklien1 ".
						 "having count(a.nopertanggungan)>=1) s,".  
            "$DBUser.tabel_406_kode_pangkat_agen p, ".
            "$DBUser.tabel_407_kode_jenjang_agen j, ".
            "$DBUser.tabel_408_kode_kelas_agen k ".
         "where ".
            "r.noagen=s.noagen(+) and ".
            "r.noagen=x.noklien and ".
            "r.kdpangkat=p.kdpangkat and ".
            "r.kdjenjangagen=j.kdjenjangagen and ".
            "r.kdkelasagen=k.kdkelasagen and ".
            "r.prefixagen = '$kantor'";
				  //echo $qry;
	*/
				$qry = "select ".
			         "prefixagen,".
			         "noagen,".
							 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".
							 "(select count(prefixpertanggungan) ".
							 "from ".
								    "$DBUser.tabel_200_pertanggungan ".
							 "where ".
								    "noagen=a.noagen and ".
										"kdpertanggungan='2' and ".
										"$periode) liunpolis ".
						   "from ".
							   "$DBUser.tabel_400_agen a ".
						   "where kdkantor='$kantor' ".$kdstatusagen." order  by namaagen";
					//echo $qry;	
				  $DB->parse($qry);
					$DB->execute();
					
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Agen Kantor ".$kantor." Periode $blnn $vthn</b></font><br><br>";
					 echo "<table>";
					 echo "<tr class=\"hijao\">";
					 echo "<td class=verdana8blk align=center><b>NO.</b></td>";
					 echo "<td class=verdana8blk align=center><b>NO. AGEN</b></td>";
					 echo "<td class=verdana8blk align=center><b>NAMA</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. POLIS</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomoragen=$arr["NOAGEN"];
					 $jmlpol = $arr["LIUNPOLIS"];

	           $jmlpolis = ($jmlpol=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('infopolisagen.php?noagen=$nomoragen&vbln=$bln&vthn=$vthn','popuppage','850','300','yes')\"><b>$jmlpol</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAAGEN"]."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmlpolis."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Polis untuk melihat detail pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
