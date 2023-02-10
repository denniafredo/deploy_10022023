<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	$DB=new Database($userid, $passwd, $DBName);	

	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<body>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>TOP COLLECTOR KANTOR <?echo $kantor;?></b></a>
	<hr size=1>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk"><b>Collectors of the </b></td>
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
					//echo $periode;
					 
           $sql = "select ".
					 						"a.nopenagih,b.prefixpenagih,".
											"b.kdrayonpenagih,".
											"c.namaklien1,".
											"count(a.nopertanggungan) as jmlpolis ".
									"from ".
											"$DBUser.tabel_200_pertanggungan a,".
											"$DBUser.tabel_500_penagih b,".
											"$DBUser.tabel_100_klien c ".
									"where ".
											"a.nopenagih=b.nopenagih and ".
											"a.kdpertanggungan='2' and ".
											"a.nopenagih=c.noklien and ".
											"b.kdrayonpenagih='$kantor' and ".
											//"$getkantor and ".
											"$periode ".
								  "group by ".
											"a.nopenagih,b.kdrayonpenagih,c.namaklien1,b.prefixpenagih ".
									"order by jmlpolis desc";
								 //echo $sql;
					$DB->parse($sql);
					$DB->execute();
					 echo "<font color=\"003399\" face=verdana size=2><b>Collectors of the $gettop Kantor ".$kantor."</b></font><br>";
					 echo "<table width=600 class=tblisi cellpadding=1 cellspacing=2>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Nomor Penagih</td>");
							echo("<td align=center>Nama</td>");
							echo("<td align=center>Kantor</td>");
					    echo("<td align=center>Jml. Polis</font></b></td>");
							echo("</tr>");						 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							
							include "../../includes/belang.php";	 
							
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
							echo("<td align=center><font face=Verdana size=1>".$arr["PREFIXPENAGIH"]."-".$arr["NOPENAGIH"]."</td>");
 						  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDRAYONPENAGIH"]."</font></td>");
					 		echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"NewWindow('detiltopcollector.php?noklien=".$arr["NOPENAGIH"]."&vtgl=$tgl&vbln=$bln&vthn=$thn&gettop=$gettop','popuppage','1000','300','yes')\"><b>".$arr["JMLPOLIS"]."</b></a></font></td>");
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
?>
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>
</body>