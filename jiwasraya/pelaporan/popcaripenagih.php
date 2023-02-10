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
	   window.location.replace('popcaripenagih.php?nama='+a+'')
	  }
  }
  </script>
	<?
	
	echo("<body topmargin=\"0\">");
  echo " <table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"2\" color=\"#0033CC\">F1315</font></td></tr>";
  echo "</table>";
  echo "<B><font face=Verdana size=2>DAFTAR PREMIUM KOLEKTOR KANTOR $kantor</font></B>";
	?>
  <table width="100%">
  <form method="post" name="klien" action="<? $PHP_SELF; ?>">
	<tr class=vercyan>
	 <td class=ver8ungu align="center">Cari Nama Penagih <input type="text" name="namaklien" size="20" class="a" onblur="Cari(document.klien);"></td>
	</tr>
  </form>	
  </table>
	<?
	echo("<form method=post action=$PHP_SELF>");
	printf("<font face=Verdana size=2><a href=popcaripenagih.php?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popcaripenagih.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=popcaripenagih.php?id=all>All</a></font>&nbsp;");
	echo "<br><br>";
		  if ($nama) {
	    $nama=strtoupper($nama);
					 $sql ="select a.nopenagih,a.kdjenjangpenagih,a.kdpangkatpenagih,a.kdkelaspenagih,b.namaklien1,b.gelar from ".
						     "$DBUser.tabel_500_penagih a,$DBUser.tabel_100_klien b where a.nopenagih=b.noklien and ".
								 "b.namaklien1 like '%$nama%' and a.kdrayonpenagih='$kantor' order by b.namaklien1";
	    } else if ($id=='all'){
            $sql="select a.nopenagih,a.kdjenjangpenagih,a.kdpangkatpenagih,a.kdkelaspenagih,b.namaklien1,b.gelar from ".
						     "$DBUser.tabel_500_penagih a,$DBUser.tabel_100_klien b where a.nopenagih=b.noklien ".
								 "and a.kdrayonpenagih='$kantor' order by b.namaklien1";
			} else {
					 if ($id!=''){ 	
					 $id=$id."%";
					 $sql ="select a.nopenagih,a.kdjenjangpenagih,a.kdpangkatpenagih,a.kdkelaspenagih,b.namaklien1,b.gelar from ".
						     "$DBUser.tabel_500_penagih a,$DBUser.tabel_100_klien b where a.nopenagih=b.noklien and ".
								 "b.namaklien1 like '$id' and a.kdrayonpenagih='$kantor' order by b.namaklien1";
					 }
			}
					 $DB->parse($sql);
					 $DB->execute();
					 
					 while($arr=$DB->nextrow()) 
					 {
					 $i = 0;
					 $i = $count + 1;
					    printf("<font face=\"Verdana\" size=\"1\">$i. <a href=\"#\" onclick=\"javascript:window.opener.document.agen.nopenagih.value='%s';window.close();\" >%s</a>   %s      </font><br>",$arr["NOPENAGIH"],$arr["NOPENAGIH"],$arr["NAMAKLIEN1"],$arr["GELAR"]);
  				 $count++;
					 }				 

	echo "<br>";
	printf("<font face=Verdana size=2><a href=popcaripenagih.php?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popcaripenagih.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=popcaripenagih.php?id=all>All</a></font>&nbsp;");
	echo("</form></html>");
?>