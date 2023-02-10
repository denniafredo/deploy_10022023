<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	
	$DB=New Database($userid, $passwd, $DBName);
  	
  echo("<title>Daftar Agen</title>");
	?> 
	<link href="../jws.css" rel="stylesheet" type="text/css">
  <script language="JavaScript" type="text/javascript">
  function Cari(theForm) {
	var a=theForm.namaklien.value
	  if (!a=='') {
	   window.location.replace('popcariagen.php?nama='+a+'')
	  }
  }
  </script>
	<?
	echo("<body topmargin=\"0\">");
  echo " <table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"2\" color=\"#0033CC\">F1315</font></td></tr>";
  echo "</table>";
  echo "<B><font face=Verdana size=2>DAFTAR AGEN KANTOR $kantor</font></B>";
	?>
  <table width="100%">
  <form method="post" name="klien" action="<? $PHP_SELF; ?>">
	<tr class=vercyan>
	 <td class=ver8ungu align="center">Cari Nama Agen <input type="text" name="namaklien" size="20" class="a" onblur="Cari(document.klien);"></td>
	</tr>
  </form>	
  </table>
	
	<?
	echo("<form method=post action=$PHP_SELF>");
	printf("<font face=Verdana size=2><a href=popcariagen.php?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popcariagen.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=popcariagen.php?id=all>All</a></font>&nbsp;");
	echo "<br><br>";
	    if ($nama) {
	    $nama=strtoupper($nama);
					  $sql="select a.prefixagen,a.noagen,a.kdjenjangagen,a.kdpangkat,a.kdkelasagen,b.namaklien1,b.gelar from ".
						     "$DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b where a.noagen=b.noklien and ".
								 "b.namaklien1 like '%$nama%' and a.prefixagen='$kantor' ".
								 "order by b.namaklien1";
	    } else if ($id=='all'){
            $sql="select a.prefixagen,a.noagen,a.kdjenjangagen,a.kdpangkat,a.kdkelasagen,b.namaklien1,b.gelar from ".
						     "$DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b where a.noagen=b.noklien ".
								 "and a.prefixagen='$kantor' order by b.namaklien1";
			} else {
					 if ($id!=''){ 	
					 $id=$id."%";
					  $sql="select a.prefixagen,a.noagen,a.kdjenjangagen,a.kdpangkat,a.kdkelasagen,b.namaklien1,b.gelar from ".
						     "$DBUser.tabel_400_agen a,$DBUser.tabel_100_klien b where a.noagen=b.noklien and b.namaklien1 like '$id' ".
								 "and a.prefixagen='$kantor' order by b.namaklien1";
					 }
			}
					 $DB->parse($sql);
					 $DB->execute();
					 echo "<table>";
					 while($arr=$DB->nextrow()) 
					 {
					 $i = 0;
					 $i = $count + 1;
					 echo "<tr>";
					    printf("<td class=verdana8blk><a href=\"#\" onclick=\"javascript:window.opener.document.agen.noagen.value='%s';window.close();\" >%s %s</a></td><td class=verdana8blk>  %s</td>",$arr["NOAGEN"],$arr["PREFIXAGEN"],$arr["NOAGEN"],$arr["NAMAKLIEN1"],$arr["GELAR"]);
  				 echo "</tr>";
					 $count++;
					 }				 
           echo "</table>";
	echo "<br>";
	printf("<font face=Verdana size=2><a href=popcariagen.php?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popcariagen.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=popcariagen.php?id=all>All</a></font>&nbsp;");
	echo("</form></html>");
?>