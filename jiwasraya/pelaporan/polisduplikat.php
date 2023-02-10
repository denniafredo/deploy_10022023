<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);	
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<?

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS DUPLIKAT KANTOR : ".$kantor."</b></font><br>";
  echo "<hr size=1>";
	echo "<div align=center>";

					$sql = "select prefixpertanggungan,nopertanggungan,nopol ".
							 	 "from $DBUser.tabel_200_pertanggungan ".
								 "where rowid in (".
                    "select rowid from $DBUser.tabel_200_pertanggungan ".
                    "where nopenagih IN (SELECT nopenagih ".
                    			"FROM $DBUser.tabel_500_penagih  ".
                    			"WHERE kdrayonpenagih='$kantor') ".
                    	"AND nopol is not null and kdstatusfile='1' ".
										  "and to_number(substr(nopol,-9,9)) > 999 ".
                    "group by rowid,nopol ".
                    "minus ".
                    "select max(rowid) from $DBUser.tabel_200_pertanggungan ".
                    "where nopenagih IN (SELECT nopenagih ".
                    			"FROM $DBUser.tabel_500_penagih  ".
                    			"WHERE kdrayonpenagih='$kantor') ".
                    	"AND nopol is not null and kdstatusfile='1' ".
											"and to_number(substr(nopol,-9,9)) > 999 ".
                    "group by nopol)";
										
					$DB->parse($sql);
					$DB->execute();
					 echo "<table cellpadding=2 cellspacing=1 width=300>";
					    echo("<tr bgcolor=#b7d9e6>");
							echo("<td align=center class=verdana9blk>No</td>");
							echo("<td align=center class=verdana9blk>Nomor Polis</td>");
							echo("<td align=center class=verdana9blk>Update</td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$nopolis = $arr["NOPOL"];
							
							include "../../includes/belang.php";	 
							
              echo("<td align=center class=verdana9blk>".$i."</td>");
						  echo("<td align=center class=verdana9blk><a href=\"#\"  class=verdana9blk onclick=\"NewWindow('detilpolisduplikat.php?nopolis=$nopolis','updclnt',1000,height=300,1);\">".$arr["NOPOL"]."</a></td>");
		          echo("<td align=center class=verdana9blk><a href=\"#\"  class=verdana9blk onclick=\"NewWindow('detilpolisduplikat.php?nopolis=$nopolis','updclnt',1000,height=300,1);\">UPDATE</a></td>");
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
