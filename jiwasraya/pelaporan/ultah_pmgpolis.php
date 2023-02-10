<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	$DB=new database($userid, $passwd, $DBName);	
	function DateSelector($inName, $useDate=0) 
  { 
        $monthName = array(1=> "Januari",  "Pebruari",  "Maret", 
            "April",  "Mei",  "Juni",  "Juli",  "Agustus", 
            "September",  "Oktober",  "Nopember",  "Desember"); 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
				
				//make day selector 
      	print("<select name=".$inName."tgl>\n"); 
      	echo "<option value=\"all\">-</option>";
      	for ($currentDay=1; $currentDay<=31; $currentDay++) { 
      		print("<option value=\"$currentDay\""); 
      		if (intval(date("d", $useDate))==$currentDay) { 
      			print(" selected"); 
      		} 
      		print(">$currentDay\n"); 
      	} 
      	print("</select>");  
	
        // make month selector 
        print("<select name=" . $inName .  "bln>\n"); 
        for($currentMonth = 1; $currentMonth <= 12; $currentMonth++) 
        { 
            print("<option value=\""); 
            print(intval($currentMonth)); 
            print("\""); 
            if(intval(date( "m", $useDate))==$currentMonth) 
            { 
                print(" selected"); 
            } 
            print(">" . $monthName[$currentMonth] .  "\n"); 
        } 
        print("</select>"); 
  } 
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>INFORMASI ULANG TAHUN PEMEGANG POLIS KANTOR <?echo $kantor;?></b></a>
	<hr size=1>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Bulan Ulang Tahun</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?
  echo "<hr size=1>";

				  if($vbln==""){
							   $DB=new database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'DDMM') bln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
								 $tgl=substr($x["BLN"],0,2);
		             $bul=substr($x["BLN"],-2);
		      }else{
		             $bul     = substr(("0".$vbln),-2);
								 $tanggal = "0".$vtgl;
								 $tgl     = substr($tanggal,-2);
	        }
					switch ($bul)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
					
					if($vtgl=="all")
					{
					  $vartgl = "to_char(c.tgllahir,'MM')='$bul' ";
						$title  = "Bulan $bln";
					}
					else
					{
					  $vartgl = "to_char(c.tgllahir,'DDMM')='$tgl$bul' ";
						$title  = "Tanggal $tgl $bln";
					} 		 
					$sql = "select ".
                     "a.prefixpertanggungan,a.nopertanggungan,a.nopemegangpolis,".
                     "c.namaklien1,to_char(c.tgllahir,'DD/MM/YYYY') tgllahir,".
                     "to_char(sysdate,'YYYY') - to_char(c.tgllahir,'YYYY') as usia ".
                  "from ".
                     "$DBUser.tabel_100_klien c,".
                     "$DBUser.tabel_200_pertanggungan a,".
                     "$DBUser.tabel_500_penagih b ".
                  "where ".
                     "a.nopenagih=b.nopenagih and ".
                     "a.nopemegangpolis=c.noklien and ".
                     "b.kdrayonpenagih='$kantor' and ".
                     "a.kdpertanggungan='2' and ".
                     "a.kdstatusfile='1' and ".
                     //"to_char(c.tgllahir,'MM')='$bul' ".
										 $vartgl." ".
									"order by tgllahir ";
          //echo $sql;
					$DB->parse($sql);
					$DB->execute();
					
					 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Pemegang Polis yang Ulang Tahun $title Kantor ".$kantor."</b></font><br>";
					 echo "<br>";
					 echo "<table cellpadding=1 cellspacing=1>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>No Polis</td>");
							echo("<td align=center>Nama Pemegang Polis</td>");
							echo("<td align=center>Tgl Lahir</td>");
					    echo("<td align=center>Usia (Tahun)</font></b></td>");
							echo("</tr>");						 
							$i=1;
							while ($arr=$DB->nextrow()) {
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
							echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?noper=".$arr["NOPERTANGGUNGAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."','updclnt',800,height=600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLLAHIR"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["USIA"]."</font></td>");
		        	echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>