<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);	

	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<body>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>TOP 20 AGENT KANTOR <?echo $kantor;?></b></a>
	<hr size=1>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
		
	<td class="verdana10blk"><b>Agent of the </b></td>
	<td> 
	<select name="gettop" class="c">
	  <option value="Day">Day</option>
		<option value="Month">Month</option>
		<option value="Year">Year</option>
	</select>
	</td>

	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?

  echo "<hr size=1>";
	echo "<div align=center>";
				  $DB=new Database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'DDMMYYYY') tgl from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $per=$x["TGL"];
							   $tgl=substr($per,0,2);
								 $bln=substr($per,2,2);
								 $thn=substr($per,-4);
				  if($gettop=="Year")
					{
					  $top=$thn;
					  $periode="to_char(a.mulas,'YYYY')='$top'";
					} elseif ($gettop=="Month")
					{
					  $top=$bln."".$thn;
					  $periode="to_char(a.mulas,'MMYYYY')='$top'";
					} else {
					  $top=$tgl."".$bln."".$thn;
					  $periode="to_char(a.mulas,'DDMMYYYY')='$top'";
					}				 
					/*
					$sql = "select ".
               	  	 "prefixagen,".
										 "noagen,".
										 "kdkantor,".
                		 "namaklien1,".
										 "jmlpolis ".
								 "from ".
									 "(select ".
               	  	 "b.prefixagen,".
										 "b.noagen,".
										 "b.kdkantor,".
                		 "c.namaklien1,".
										 "count(a.nopertanggungan) as jmlpolis ".
								    "from ".
								 		 "$DBUser.tabel_200_pertanggungan a,".
										 "$DBUser.tabel_400_agen b,".
                		 "$DBUser.tabel_100_klien c ".
								    "where ".
								     "a.noagen=b.noagen and ".
										 "a.kdpertanggungan='2' and ".
                		 "a.noagen=c.noklien and ".
										 "b.kdkantor='$kantor' and ".
										 "$periode ".
								    "group by ".
								 		 "b.noagen,b.prefixagen,b.kdkantor,c.namaklien1 ".
								    "order by nvl(jmlpolis, 0) desc) ".
                 "where rownum < 21 ";
						*/
								 
					$sql = "select ".
               	  	 "prefixagen,".
										 "noagen,".
										 "kdkantor,".
                		 "namaklien1,".
										 "jmlpolis, ".
										 "agenrank ".
								 "from ".
									 "(select ".
               	  	 "b.prefixagen,".
										 "b.noagen,".
										 "b.kdkantor,".
                		 "c.namaklien1,".
										 "count(a.nopertanggungan) as jmlpolis, ".
										 "RANK() OVER ". 
          					    "(ORDER BY count(a.nopertanggungan) Desc NULLS LAST) AS agenrank ".
								    "from ".
								 		 "$DBUser.tabel_200_pertanggungan a,".
										 "$DBUser.tabel_400_agen b,".
                		 "$DBUser.tabel_100_klien c ".
								    "where ".
								     "a.noagen=b.noagen and ".
										 "a.kdpertanggungan='2' and ".
                		 "a.noagen=c.noklien and ".
										 "b.kdkantor='$kantor' and ".
										 "$periode ".
								    "group by ".
								 		 "b.noagen,b.prefixagen,b.kdkantor,c.namaklien1 ".
										"ORDER BY count(a.nopertanggungan) Desc NULLS LAST) ". 
										"WHERE agenrank < 21";
								 //echo $sql;
					$DB->parse($sql);
					$DB->execute();
					 echo "<font color=\"003399\" face=verdana size=2><b>Agents of the $gettop Kantor ".$kantor."</b></font><br>";
					 echo "<table class=tblisi cellpadding=1 cellspacing=2>";
					    echo("<tr class=hijao>");
							echo("<td align=center>Rank</td>");
							echo("<td align=center>Jml. Polis</font></b></td>");
							echo("<td align=center>Nomor </td>");
							echo("<td align=center>Nama Agen</td>");	    
							echo("</tr>");						 
							$i=1;
							while ($arr=$DB->nextrow()) {
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$arr["AGENRANK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"NewWindow('detiltopagent.php?noagen=".$arr["NOAGEN"]."&vtgl=$tgl&vbln=$bln&vthn=$thn&gettop=$gettop','popuppage','1000','300','yes')\"><b>".$arr["JMLPOLIS"]."</b></a></font></td>");
							echo("<td align=center><font face=Verdana size=1>".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</td>");
 						  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>");
		        	echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 //echo "<a class=verdana10blk href=\"mainmenu.php\">Main Menu</a>";
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>
</body>