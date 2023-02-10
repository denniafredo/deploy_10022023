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
echo "<a class=verdana10blk><b>INFORMASI POLIS BPO KANTOR $kantor PER AGEN</b></a>";

#------------------------------------------------------------------------------------------
$sql ="select r.prefixagen,r.noagen,x.namaklien1,s.liunbpo ".
      "from ".
			"$DBUser.tabel_100_klien x,".
			"$DBUser.tabel_400_agen r,".
			"(select c.noagen,count(a.nopertanggungan) liunbpo from ".
			  "$DBUser.tabel_100_klien b,".
        "$DBUser.tabel_200_pertanggungan a, ".
        "$DBUser.tabel_400_agen c,".
        "$DBUser.tabel_305_cara_bayar d ".
      "where a.notertanggung=b.noklien(+) ".
        "and a.noagen=c.noagen ".
        "and a.kdcarabayar=d.kdcarabayar(+) ".
        "and c.prefixagen='$kantor' ".
        "and a.kdpertanggungan='2' ".
        "and notertanggung is not null ".
        "and a.kdstatusfile='4' ".
        "group by c.noagen) s ".
    "where ".
    "r.noagen = s.noagen(+) and ".
    "r.noagen=x.noklien and ".
    "r.prefixagen ='$kantor' order by x.namaklien1";
						 
		$DB->parse($sql);
		$DB->execute();
  //echo  "<BR>".$sql;
	
	echo "<hr size=1>";
	echo "<div align=center>";
	echo "<a class=verdana10blk>Klik link pada kolom jumlah polis BPO untuk melihat detail status pertanggungan</a><br><BR>";
					 
  				 echo "<table>";
					 echo "<tr bgcolor=#97b3b9>";
					 echo "<td class=verdana8blk align=center><b>NO.</b></td>";
					 echo "<td class=verdana8blk align=center><b>NO. AGEN</b></td>";
					 echo "<td class=verdana8blk align=center><b>NAMA</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. POLIS BPO</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomoragen=$arr["NOAGEN"];
					 $prefixagen=$arr["PREFIXAGEN"];
					 $jmlbpo = $arr["LIUNBPO"];
					 $namaagen=$arr["NAMAKLIEN1"];
	           $jmlpolisbpo = ($jmlbpo=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('detilbpo_agen.php?prefixagen=$prefixagen&noagen=$nomoragen&namaagen=$namaagen','popuppage','850','300','yes')\"><b>$jmlbpo</b></a>";

					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]." ".$arr["GELAR"]."</td>";
					 echo "<td class=verdana8blk  align=center>".$jmlpolisbpo."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah polis BPO untuk melihat detail status pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
?>