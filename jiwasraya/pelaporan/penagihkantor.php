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
 function DateSelector($inName, $useDate=0) 
 { 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
        // make year selector 
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
				echo "<option value=\"ALL\">ALL</option>";
        for($currentYear = $startYear - 15; $currentYear <= $startYear+1;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
        } 
        print("</select>"); 
  } 
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<a class=verdana10blk><b>INFORMASI KONDITE POLIS $jnspolis KANTOR $kantor PER PENAGIH</b></a>";

echo "<hr size=1>";
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Pilih Tahun Mulai Asuransi</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("v");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=hidden name=jnspolis value=$jnspolis>";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
#-------------------------------------------------------------------------------------------
	if($vthn==""){
		$DB=new Database($userid, $passwd, $DBName);
	  $thnsql = "select to_char(sysdate,'YYYY') nowthn from dual";
		$DB->parse($thnsql);
	  $DB->execute();
		$x=$DB->nextrow();
		$defaultthn=$x["NOWTHN"];
		$vthn=$defaultthn;
		$periode="and to_char(d.mulas,'YYYY')='$vthn'";
	}else	if($vthn=="ALL"){
		$periode="";
  }else{
		$periode="and to_char(d.mulas,'YYYY')='$vthn'";
  }
	
	if($jnspolis=="OB"){
	  $mat=">=";
	} else {
	  $mat="<";
	}
#------------------------------------------------------------------------------------------	 
	$sql = "select x.namaklien1,y.kdrayonpenagih,y.nopenagih,s.liune ".
	       "from ".
				    "$DBUser.tabel_100_klien x,".
						"$DBUser.tabel_500_penagih y,".
						"(select count(c.nopertanggungan) as liune,	d.nopenagih ".
						"from $DBUser.tabel_300_historis_premi c,".
						     "$DBUser.tabel_200_pertanggungan d,".
								 "$DBUser.tabel_500_penagih f ".
						"where c.prefixpertanggungan=d.prefixpertanggungan ".
						     "and c.nopertanggungan=d.nopertanggungan ".
								 "and d.nopenagih=f.nopenagih ".
								 "and f.kdrayonpenagih='$kantor' ".
								 "$periode ".
								 "and MONTHS_BETWEEN(c.tglbooked,d.mulas) $mat 12 ".
								 "and c.tglbooked=(SELECT MAX(tglbooked) ".
								     "FROM $DBUser.tabel_300_historis_premi g ".
										 "WHERE g.prefixpertanggungan=d.prefixpertanggungan ".
										 "AND g.nopertanggungan=d.nopertanggungan ".
										 "AND g.kdkuitansi <> 'BP3') group by d.nopenagih) s ".
				 "where y.nopenagih = s.nopenagih(+) ".
				     "and y.nopenagih=x.noklien ".
						 "and y.kdstatuspenagih!='04' ".
						 "and y.kdrayonpenagih ='$kantor' order by x.namaklien1";
				 $DB->parse($sql);
				 $DB->execute();
  //echo  "<BR>".$sql;
	
	echo "<hr size=1>";
	echo "<div align=center>";
  echo "<B><font face=Verdana size=2>Jumlah Polis $jnspolis Penagih Kantor $kantor Periode $vthn</font></B>";
					 echo "<table>";
					 echo "<tr bgcolor=#97b3b9>";
					 echo "<td class=verdana8blk align=center><b>NO.</b></td>";
					 echo "<td class=verdana8blk align=center><b>NO. PENAGIH</b></td>";
					 echo "<td class=verdana8blk align=center><b>NAMA</b></td>";
					 echo "<td class=verdana8blk align=center><b>JML.POLIS $jnspolis</b></td>";
  				 echo "</tr>";
					 $i = 1;
					 while($arr=$DB->nextrow()) 
					 {
					 $nomorpenagih=$arr["NOPENAGIH"];
					 $jml = $arr["LIUNE"];
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk>$i</td>";
					 echo "<td class=verdana8blk align=center>".$arr["KDRAYONPENAGIH"]."-".$arr["NOPENAGIH"]."</td>";
					 echo "<td class=verdana8blk>".$arr["NAMAKLIEN1"]." ".$arr["GELAR"]."</td>";
					 echo "<td class=verdana8blk  align=center>";
	            $jmlpolis = ($jml=="") ? '-' : "<a href=\"#\" onclick=\"NewWindow('popkonditepolispenagih.php?jnspolis=$jnspolis&nopenagih=$nomorpenagih&vthn=$vthn','popuppage','900','300','yes')\"><b>$jml</b></a>";
              //$jmlpolis = ($jml=="") ? '-' : "<a href=popkonditepolispenagih.php?jnspolis=$jnspolis&nopenagih=$nomorpenagih&vthn=$vthn target=_new><b>$jml</b></a>";
							echo $jmlpolis;
	
					 echo "</td>";
  				 echo "</tr>";
					 $i++;
					 }				 
           echo "</table>";
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
?>