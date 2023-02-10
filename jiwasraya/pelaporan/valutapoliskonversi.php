<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
  echo "<a class=verdana10blk><b>INFORMASI POLIS AKTIF KANTOR $kantor PER VALUTA</b></a>";	
	echo "<hr size=1>";
	?>
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
  $DB = new Database($userid, $passwd, $DBName);		
  $qry= "select decode(a.kdvaluta,'0','RUPIAH INDEKS','1','RUPIAH','US DOLLAR') nmvaluta,".
	      "a.kdvaluta,count(a.kdvaluta) as liunpolis from ".
        "$DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b ".
				"where a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' and ".
		    "a.kdpertanggungan='2' and kdstatusfile='1' group by kdvaluta";
  $DB->parse($qry);
	$DB->execute();
					
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Kantor ".$kantor." Per Valuta</b></font><br><br>";
					 echo "<table width=300>";
					 echo "<tr bgcolor=#97b3b9>";
					 echo "<td class=verdana8blk align=center><b>NAMA VALUTA</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML. POLIS</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $jmlpol = $arr["LIUNPOLIS"];
					 $kdval = $arr["KDVALUTA"];

	           $jmlproposal = ($jmlpol=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('portopoliokantorvaluta.php?valuta=$kdval','popuppage','1000','400','yes')\"><b>$jmlpol</b></a>";
  
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>".$arr["NMVALUTA"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$jmlproposal."</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "<a class=verdana10blk><br>Klik link pada kolom jumlah Polis untuk melihat detail pertanggungan</a>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
