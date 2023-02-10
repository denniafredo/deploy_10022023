<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	
	$DB=New Database($userid, $passwd, $DBName);
	?> 
	<link href="../jws.css" rel="stylesheet" type="text/css">
  <script language="javascript">
var win= null;
function NewWindow(mypage,myname,w,h,scroll){
  var winl = (screen.width-w)/2;
  var wint = (screen.height-h)/2;
  var settings  ='height='+h+',';
      settings +='width='+w+',';
      settings +='top='+wint+',';
      settings +='left='+winl+',';
      settings +='scrollbars='+scroll+',';
      settings +='resizable=yes';
  win=window.open(mypage,myname,settings);
  if(parseInt(navigator.appVersion) >= 4){win.window.focus();}
}
</script>
<?

echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<a class=verdana10blk><b>INFORMASI GADAI/TEBUS/PEMULIHAN KANTOR $kantor PER AGEN</b></a>";

#------------------------------------------------------------------------------------------
$sql ="select r.prefixagen,r.noagen,x.namaklien1,s.liungade,s1.liuntebus,s2.liunpulih ".
      "from ".
			"$DBUser.tabel_100_klien x,".
			"$DBUser.tabel_400_agen r,".
      "(select d.noagen,count(a.nopertanggungan) liungade from ".
         "$DBUser.tabel_200_pertanggungan c,".
				 "$DBUser.tabel_700_gadai a,".
         "$DBUser.tabel_999_kode_status b,". 
         "$DBUser.tabel_400_agen d ".
      "where a.prefixpertanggungan=c.prefixpertanggungan ". 
        "and a.nopertanggungan=c.nopertanggungan ".
        "and c.noagen=d.noagen ".
        "and d.prefixagen='$kantor' ".
        "and a.status=b.kdstatus ".
        "and b.jenisstatus='GADAI' ".
      "group by d.noagen) s,".
      "(select d1.noagen,count(a1.nopertanggungan) liuntebus from ".
         "$DBUser.tabel_200_pertanggungan c1,".
				 "$DBUser.tabel_700_tebus a1,".
         "$DBUser.tabel_999_kode_status b1,". 
         "$DBUser.tabel_400_agen d1 ".
      "where a1.prefixpertanggungan=c1.prefixpertanggungan ".
        "and a1.nopertanggungan=c1.nopertanggungan ".
        "and c1.noagen=d1.noagen ".
        "and d1.prefixagen='$kantor' ".
        "and a1.status=b1.kdstatus ".
        "and b1.jenisstatus='TEBUS' ".
      "group by d1.noagen) s1,".
      "(select d2.noagen,count(a2.nopertanggungan) liunpulih from ".
         "$DBUser.tabel_200_pertanggungan c2,".
				 "$DBUser.tabel_700_pulih a2,".
         "$DBUser.tabel_999_kode_status b2,". 
         "$DBUser.tabel_400_agen d2 ".
      "where a2.prefixpertanggungan=c2.prefixpertanggungan ". 
        "and a2.nopertanggungan=c2.nopertanggungan ".
        "and c2.noagen=d2.noagen ".
        "and d2.prefixagen='$kantor' ".
        "and a2.status=b2.kdstatus ".
        "and b2.jenisstatus='PULIH' ".
      "group by d2.noagen) s2 ".
    "where ".
    "r.noagen = s.noagen(+) and ".
    "r.noagen = s1.noagen(+) and ".
    "r.noagen = s2.noagen(+) and ".
    "r.noagen=x.noklien and ".
    "r.prefixagen ='$kantor' order by x.namaklien1";
						 
		$DB->parse($sql);
		$DB->execute();
  //echo  "<BR>".$sql;
	
	echo "<hr size=1>";
	echo "<div align=center>";
	echo "<a class=verdana10blk>Klik link pada kolom jumlah Gadai/Tebus/Pemulihan untuk melihat detail status pertanggungan</a><br><BR>";
					 
  				 echo "<table>";
					 echo "<tr bgcolor=#97b3b9>";
					 echo "<td class=verdana8blk align=center><b>NO.</b></td>";
					 echo "<td class=verdana8blk align=center><b>NO. AGEN</b></td>";
					 echo "<td class=verdana8blk align=center><b>NAMA</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. GADAI</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. TEBUS</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. PULIH</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomoragen=$arr["NOAGEN"];
					 $jmlgade = $arr["LIUNGADE"];
					 $jmltebus = $arr["LIUNTEBUS"];
					 $jmlpulih = $arr["LIUNPULIH"];
	           $jmlgde = ($jmlgade=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('statuspert_agen.php?jns=gadai&noagen=$nomoragen&vthn=$vthn','popuppage','850','300','yes')\"><b>$jmlgade</b></a>";
             $jmltbs = ($jmltebus=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('statuspert_agen.php?jns=tebus&noagen=$nomoragen&vthn=$vthn','popuppage','850','300','yes')\"><b>$jmltebus</b></a>";
						 $jmlplh = ($jmlpulih=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('statuspert_agen.php?jns=pulih&noagen=$nomoragen&vthn=$vthn','popuppage','850','300','yes')\"><b>$jmlpulih</b></a>";

					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]." ".$arr["GELAR"]."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmlgde."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmltbs."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmlplh."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Gadai/Tebus/Pemulihan untuk melihat detail status pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
?>