<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
 
  $DB = new Database($userid, $passwd, $DBName);
	?>
	<style type="text/css">
<!-- 
td {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<?
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=verdana10blu><b>REKAPITULASI MACAM ASURANSI PERTANGGUNGAN PERORANGAN</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
        print("<select name=" . $inName .  "bln>\n"); 
				print ("<option value=0>--- SEMUA ---</option>");
        for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) 
        { 
            switch($currentMonth)
            {
              case '1' : $namabulan ="JANUARI"; break ;
              case '2' : $namabulan ="FEBRUARI"; break ;
              case '3' : $namabulan ="MARET"; break ;
              case '4' : $namabulan ="APRIL"; break ;
              case '5' : $namabulan ="MEI"; break ;
              case '6' : $namabulan ="JUNI"; break ;
              case '7' : $namabulan ="JULI"; break ;
              case '8' : $namabulan ="AGUSTUS"; break ;
              case '9' : $namabulan ="SEPTEMBER"; break ;
              case '10' : $namabulan ="OKTOBER"; break ;
              case '11' : $namabulan ="NOVEMBER"; break ;
              case '12' : $namabulan ="DESEMBER"; break ;
            }
						
            print("<option value=\"$currentMonth\""); 
            if(date( "n", $useDate)==$currentMonth) 
            { 
                print(" selected"); 
            } 					
            print(">$namabulan\n"); 						
        } 
        print("</select>"); 

				
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 15; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
			//	print ("<option value=ALL>*</option>");
        print("</select>"); 

} 
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Produk</td>";
echo "      <td>";
echo "          <select size=1 name=kdproduk>";
echo "               <option value=\"pilih\">-- P I L I H --</option>";
//                $sqa="select kdproduk,namaproduk from $DBUser.tabel_202_produk where nvl(status,0)<>'X' order by kdproduk";
                $sqa="select kdproduk,namaproduk from $DBUser.tabel_202_produk order by kdproduk";
          		  $DB->parse($sqa);
          			$DB->execute();					 
          		  while ($arr=$DB->nextrow()) {
          			 if ($arr["KDPRODUK"]==$kdproduk) {
          			  print( "<option selected value=".$arr["KDPRODUK"].">".$arr["KDPRODUK"]." - ".$arr["NAMAPRODUK"]."</option>" );
          		   } else { 
          				print( "<option value=".$arr["KDPRODUK"].">".$arr["KDPRODUK"]." - ".$arr["NAMAPRODUK"]."</option>" );
          		   }
          			}
echo "          </select>";
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
               DateSelector("v");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
echo "<hr size=1>";
#--------------------------------------------------- end navigasi --------------
if($masa=="pilih"){
  echo "<font color=red>Pilih Masa Produksi..</font><br><br>";
} else if($cari&&$kdproduk!='pilih'){
			 if ($vbln==0){
  		 		echo "DAFTAR PRODUK $kdproduk TAHUN $vthn";
  		 }
			 else{
            switch($vbln)
            {
              case '1' : $namabulan ="JANUARI"; break ;
              case '2' : $namabulan ="FEBRUARI"; break ;
              case '3' : $namabulan ="MARET"; break ;
              case '4' : $namabulan ="APRIL"; break ;
              case '5' : $namabulan ="MEI"; break ;
              case '6' : $namabulan ="JUNI"; break ;
              case '7' : $namabulan ="JULI"; break ;
              case '8' : $namabulan ="AGUSTUS"; break ;
              case '9' : $namabulan ="SEPTEMBER"; break ;
              case '10' : $namabulan ="OKTOBER"; break ;
              case '11' : $namabulan ="NOVEMBER"; break ;
              case '12' : $namabulan ="DESEMBER"; break ;
            }
			 
			 		echo "DAFTAR PRODUK $kdproduk PERIODE $namabulan $vthn";
			 }					
			 if ($vbln==0){
			 		$periode="and to_char(a.mulas,'YYYY')='$vthn' "; 
			 }
			 else{
			 		$periode="and to_char(a.mulas,'YYYYMM')='$vthn".substr("00".$vbln,-2)."' "; 			 
			 }
	?>
	<table border="1" style="border-collapse: collapse" id="table1" cellpadding="4">
	<tr>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Kode</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Nama Kantor</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah Polis</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah Premi</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jumlah JUA</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Komisi BP3</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Komisi Penutupan I</font></td>
	</tr>
	<? 
	$sql = "select k.namakantor,k.kdkantor,s.jml,s.kdproduk,s.namaproduk,s.jmlpremi1,s.jua,s.kdrayonpenagih, s.komisibp3, s.komisi1 ".
	       "from $DBUser.tabel_001_kantor k,".

	        "(select ".
            "a.kdproduk,".
            "(select namaproduk from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) as namaproduk,".
            "b.kdrayonpenagih, ".
						"count(a.nopertanggungan) as jml, ".
						"SUM (decode(a.kdvaluta,'3',a.premi1 * a.indexawal,a.premi1)) AS jmlpremi1,".
            "SUM (decode(a.kdvaluta,'3',a.premi2 * a.indexawal,a.premi2)) AS jmlpremi2,".
            "SUM (decode(a.kdvaluta,'3',a.juamainproduk * a.indexawal,a.juamainproduk)) AS jua, ".
						"sum((select sum(komisiagen) as komisibp3 from $DBUser.tabel_404_temp where ".
                    "kdkomisiagen='02' and thnkomisi = 1 ".
                    "and prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
                    "group by prefixpertanggungan,nopertanggungan)) ".
                    "komisibp3, ".
                   
                   "sum((select sum(komisiagen) as komisi1 from $DBUser.tabel_404_temp where ".
                    "kdkomisiagen in('03','01') and thnkomisi = 1 and ".
                    "prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan ".
                    "group by prefixpertanggungan,nopertanggungan)) ".
                   "komisi1 ".
				  "from ".
							"$DBUser.tabel_200_pertanggungan a,".
          		"$DBUser.tabel_500_penagih b ".
          "where ".
              "a.nopenagih=b.nopenagih ".
              $periode. 
              "and a.kdpertanggungan='2' ".
							"and a.kdstatusfile='1' ".
              "and a.kdproduk='$kdproduk' ".
					"group by a.kdproduk,b.kdrayonpenagih ".
					"order by b.kdrayonpenagih,a.kdproduk) s ".
				 "where ".
				   "k.kdjeniskantor='1' and k.status = '1' ".
				   " and k.kdkantor=s.kdrayonpenagih order by k.kdkantor";
  //echo $sql;
  //die;
	$DB->parse($sql);
  $DB->execute();			
	$i=1;		 
  while ($arr=$DB->nextrow()) {
	echo ($i%2)? "<tr bgcolor=#dceff5>" : "<tr>";
	?>
		<td><?=$i;?></td>
		<td><?=$arr["KDKANTOR"];?></td>
		<td><?=$arr["NAMAKANTOR"];?></td>
		<td align="right"><?="<a href=\"#\" onclick=\"NewWindow('portopolioperproduk.php?kdkantor=".$arr["KDRAYONPENAGIH"]."&kdproduk=$kdproduk&vbln=$vbln&vthn=$vthn','popuppage','1000','300','yes')\">";?><?=number_format($arr["JML"],0,",",".");?></a></td>
	  <td align="right"><?=number_format($arr["JMLPREMI1"],2,",",".");?></td>
		<td align="right"><?=number_format($arr["JUA"],2,",",".");?></td>
		<td align="right"><?=number_format($arr["KOMISIBP3"],2,",",".");?></td>
		<td align="right"><?=number_format($arr["KOMISI1"],2,",",".");?></td>
	</tr>
	<? 
	$i++;
	$jml +=$arr["JML"];
	$jmlpremi +=$arr["JMLPREMI1"];
	$jmljua +=$arr["JUA"];
	$jmlkomisibp3 +=$arr["KOMISIBP3"];
	$jmlkomisi1 +=$arr["KOMISI1"];
	}
	?>
	<tr bgcolor="#a9d8e7">
		<td colspan=3>JUMLAH</td>
		<td align="right"><?=number_format($jml,0,",",".");?></td>
		<td align="right"><?=number_format($jmlpremi,2,",",".");?></td>
		<td align="right"><?=number_format($jmljua,2,",",".");?></td>
		<td align="right"><?=number_format($jmlkomisibp3,2,",",".");?></td>
		<td align="right"><?=number_format($jmlkomisi1,2,",",".");?></td>
	</tr>
</table>
	<?
}
?>	
<br />
<hr size="1">

<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<? 
  include "../../includes/endtimer.php"; 
 ?>