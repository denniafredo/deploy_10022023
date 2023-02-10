<?  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/klien.php";
	//include "../../includes/pertanggungan.php";	
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
	echo "<a class=verdana10blu><b>JUMLAH POLIS KLIEN</b></a>";
	echo "<hr size=1>";
#---------------------------------------------- start navigasi -----------------
function DateSelector($inName, $useDate=0) 
{ 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 5; $currentYear <= $startYear+0;$currentYear++) 
        { 
            print("<option value=\"$currentYear\""); 
            if(date( "Y", $useDate)==$currentYear) 
            { 
                print(" selected"); 
            } 
            print(">$currentYear\n"); 
						
        } 
				//print ("<option value=ALL>*</option>");
        print("</select>"); 
} 
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Produk</td>";
echo "      <td>";
echo "          <select size=1 name=kdproduk>";
echo "               <option value=\"pilih\">-- P I L I H --</option>";
                $sqa= "select kdproduk,namaproduk from $DBUser.tabel_202_produk ".
										  "where nvl(status,0)<>'X' ".
											//"and kdproduk like 'JSSPO%' ".
											"order by kdproduk";
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
} else if($cari){
  echo "DAFTAR PRODUK $kdproduk TAHUN $vthn";
	?>
	<table border="1" style="border-collapse: collapse" id="table1" cellpadding="4">
	<tr>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Polis</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Tertg</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Pemeg.Pol</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Pby.Premi</font></td>
		<!--<td bgcolor="#3366CC"><font color="#FFFFFF">Nama Tertanggung</font></td>-->
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Klien Ins</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jml.Polis Insrb</font></td>
	</tr>
	<? 
	/*
	$sql = "SELECT DISTINCT ".
			 	 				"a.prefixpertanggungan, a.nopertanggungan, a.kdproduk,".
                "a.notertanggung, a.nopemegangpolis, a.nopembayarpremi,".
                "b.noklien AS noklientertanggung,".
				"(SELECT COUNT (1) ".
                  "FROM $DBUser.tabel_200_pertanggungan ".
                  "WHERE notertanggung = a.notertanggung) AS jmlpolispemegangpolis,".
				"(SELECT COUNT (1) ".
                  "FROM $DBUser.tabel_200_pertanggungan ".
                  "WHERE nopemegangpolis = a.nopemegangpolis) AS jmlpolispemegangpolis,".
				"(SELECT COUNT (1) ".
                  "FROM $DBUser.tabel_200_pertanggungan ".
                  "WHERE nopembayarpremi = a.nopembayarpremi) AS jmlpolispembayarpremi,".
        "(SELECT COUNT (1) ".
                  "FROM $DBUser.tabel_200_pertanggungan ".
                  "WHERE notertanggung = b.noklien) AS jmlpolisklientertanggung ".
          "FROM $DBUser.tabel_219_pemegang_polis_baw b,".
                "$DBUser.tabel_200_pertanggungan a ".
          "WHERE a.notertanggung = b.notertanggung ".
            "AND a.kdproduk = '$kdproduk' ".
            "AND TO_CHAR (a.mulas, 'YYYY') = '$vthn' ".
       "ORDER BY a.prefixpertanggungan, a.nopertanggungan";
*/

	$sql = "select ".
          	   "distinct ".
          	   "a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
          	   "a.notertanggung,a.nopemegangpolis,a.nopembayarpremi,".
          	   "b.noklien as noklientertanggung,".
          	   "(select count(1) from $DBUser.tabel_200_pertanggungan ".
							 "where notertanggung=b.noklien) as jmlpolisklientertanggung ".
          "from ".
          	 "$DBUser.tabel_219_pemegang_polis_baw b, ".
						 "$DBUser.tabel_200_pertanggungan a ".
          "where ".
              "a.notertanggung=b.notertanggung ".
              "and a.kdproduk='$kdproduk' ".
              "and to_char(a.mulas,'YYYY')='$vthn'  ".
          "order by a.prefixpertanggungan,a.nopertanggungan";
				
	//echo $sql;
	$DB->parse($sql);
  $DB->execute();			
	$i=1;		 
  while ($arr=$DB->nextrow()) {
	
	if($arr["JMLPOLISKLIENTERTANGGUNG"]<>0)
	{
	echo ($i%2)? "<tr bgcolor=#dceff5>" : "<tr>";
	//$KLN = new Klien($userid,$passwd,$arr["NOTERTANGGUNG"]);
	//$KLN2 = new Klien($userid,$passwd,$arr["NOKLIENTERTANGGUNG"]);
	?>
		<td>
  		<?
			if($prevnopol<>$arr["NOPERTANGGUNGAN"])
			{
  		echo $arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];
			}
  		?>
		</td>
		<td><?
		  if($prevnotertanggung<>$arr["NOTERTANGGUNG"]) {
		   echo "<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOTERTANGGUNG"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">".$arr["NOTERTANGGUNG"]."</a>"; }
			 ?></td>
		<td><?
		  if($prevnopmgpolis<>$arr["NOPEMEGANGPOLIS"]){
			 echo "<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOPEMEGANGPOLIS"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">".$arr["NOPEMEGANGPOLIS"]."</a>";}?></td>
		<td><?
		  if($prevnopmypremi<>$arr["NOPEMBAYARPREMI"]) {
			 echo "<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOPEMBAYARPREMI"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">".$arr["NOPEMBAYARPREMI"]."</a>";}
			?></td>
		<?
		/*
		 if($prevnamattg<>$KLN->nama){
		   echo $KLN->nama;}
			 */?>
		<td><?=$arr["NOKLIENTERTANGGUNG"];?></td>
		
		<td align="right"><?="<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOKLIENTERTANGGUNG"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">";?><?=$arr["JMLPOLISKLIENTERTANGGUNG"];?></a></td>
	</tr>
	<? 
	$prevnopol 				 = $arr["NOPERTANGGUNGAN"];
	$prevnotertanggung = $arr["NOTERTANGGUNG"];
	$prevnopmgpolis		 = $arr["NOPEMEGANGPOLIS"];
	$prevnopmypremi		 = $arr["NOPEMBAYARPREMI"];
	$prevnamattg			 = $KLN->nama;
	}
	}
	?>

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