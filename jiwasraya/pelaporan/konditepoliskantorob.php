<?
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/common.php";
	include "../../includes/pertanggungan.php";	
	include "../../includes/klien.php";	
#--------------------------------------------------------------------------------------------
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
        for($currentYear = $startYear - 10; $currentYear <= $startYear+5;$currentYear++) 
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
echo "<a class=verdana10blk><b>INFORMASI KONDITE POLIS OB KANTOR $kantor</b></a>";

echo "<hr size=1>";
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Pilih Tahun Mulai Asuransi</td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("v");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
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
	
	$DB=new Database($userid, $passwd, $DBName);
		 $sql = "select c.prefixpertanggungan,".
		                "c.nopertanggungan,".
										"c.kdkuitansi,".
										"d.nopenagih,".
										"d.mulas,".
										"f.kdrayonpenagih ".
						"from $DBUser.tabel_300_historis_premi c,".
						        "$DBUser.tabel_200_pertanggungan d,".
										"$DBUser.tabel_500_penagih f ".
						"where c.prefixpertanggungan=d.prefixpertanggungan ".
						        "and c.nopertanggungan=d.nopertanggungan ".
										"and d.nopenagih=f.nopenagih ".
										"and f.kdrayonpenagih='$kantor' ".												 						 
										"$periode ".
										"and MONTHS_BETWEEN(c.tglbooked,d.mulas) >= 12 ".
										"and c.tglbooked=(SELECT MAX(tglbooked) ".
										     "FROM $DBUser.tabel_300_historis_premi g ".
												 "WHERE g.prefixpertanggungan=d.prefixpertanggungan ".
												 "AND g.nopertanggungan=d.nopertanggungan ".
												 "AND g.kdkuitansi <> 'BP3') order by f.kdrayonpenagih, d.mulas";

//										"and f.kdrayonpenagih='$kantor' ".												 						 

	   $DB->parse($sql);
	   $DB->execute();
     //echo "<br><br>".$sql."<br><br>";
    
		 echo "<hr size=1>";
		 echo "<div align=\"center\">";
		 echo "<a class=verdana10blk><b>DAFTAR POLIS TAHUN $vthn</b></font>";

		 $i = 0;			  
		 echo "<table>";
		 echo "<tr bgcolor=#97b3b9>";
		 echo "<td class=verdana8blk><b>No.</b></td>";
		 echo "<td class=verdana8blk><b>Pertanggungan</b></td>";
		 echo "<td class=verdana8blk><b>Nama Tertanggung</b></td>";
		 echo "<td class=verdana8blk><b>Nama Produk</b></td>";
     echo "<td class=verdana8blk align=center><b>Tgl. Mulas</b></td>";
		 echo "<td class=verdana8blk><b>Expirasi</b></td>";
		 echo "<td class=verdana8blk><b>Stt.Med</font></b></td>";
		 echo "<td class=verdana8blk><b>Cara Bayar</b></td>";
		 echo "<td class=verdana8blk><b>Valuta</b></td>";
		 echo "<td class=verdana8blk><b>Bayar Terakhir</b></td>";
		 echo "<td class=verdana8blk><b>J U A</b></td>";
		 echo "<td class=verdana8blk><b>Premi 1</b></td>";
		 echo "<td class=verdana8blk><b>Premi 2</b></td>";
		 echo "<td class=verdana8blk><b>Status</b></td>";	 
		 echo "</tr>";

		 while($arr=$DB->nextrow()) {
		 $PER = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	   $i = 0;
		 $i = $count + 1;
		 $prefix = $arr["PREFIXPERTANGGUNGAN"];
		 $nopert = $arr["NOPERTANGGUNGAN"];
		 $namatertanggung = $arr["NAMAKLIEN"];
	
		 include ("../../includes/belang.php");

		 echo "<td class=verdana8blk>".$i."</td>";
		 echo "<td class=verdana8blk><a href=\"#\" onclick=\"NewWindow('../akunting/kartupremi1.php?prefix=$prefix&noper=$nopert','popuppage','700','300','yes');return true;\">".$prefix."-".$nopert."</a></td>";		 
	   echo "<td class=verdana8blk>".$PER->namatertanggung."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->namaproduk."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->mulas."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->expirasi."</td>";
		 echo "<td class=verdana8blk align=center>".$PER->medstat."</td>";
		 echo "<td class=verdana8blk>".$PER->namacarabayar."</td>";
		 echo "<td class=verdana8blk>".$PER->namavaluta."</td>";    
		 echo "<td class=verdana8blk>".$PER->tgllastpayment."</td>";  
		 echo "<td class=verdana8blk align=right>".number_format($PER->jua,2)."</td>";
		 echo "<td class=verdana8blk align=right>".number_format($PER->premi1,2)."</td>";
		 echo "<td class=verdana8blk align=right>".number_format($PER->premi2,2)."</td>";
		 echo "<td class=verdana8blk>".$PER->namastatusfile."</td>";	 
		 echo "</tr>";
		 $count++;
		 }
 
echo "</table>";		 
echo "<br>Klik Nomor Pertanggungan untuk melihat pelunasan premi<br>";
echo "</div>";		 
echo "<hr size=1>";
echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
