<? 
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/common.php";
 function DateSelector($inName, $useDate=0) 
 { 
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
        for($currentYear = $startYear - 3; $currentYear <= $startYear+5;$currentYear++) 
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
echo "<a class=\"verdana9blk\"><b>Produksi NBPP Tahunan</b></a>";
echo "<hr size=1>";
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Pilih Tahun Produksi</td>";
echo "      <td class=\"verdana9blk\">: ";
               DateSelector("v");
echo "      </td>";
echo "      <td class=\"verdana9blk\"> ";
echo "        <input type=submit name=cari value=CARI>";               
echo "      </td>";
echo "    </tr>";
echo "  </form>";
echo "  </table>";
$bln = substr(("0".$vbln),-2);
$thisperiode="$vthn";
if(!$thisperiode){} else {
echo "<hr size=1>";
#------------------------------
  switch ($bln)	{
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
  $DB=new Database($userid, $passwd, $DBName);
	$sqla = "select to_char((last_day(sysdate) + 5),'DD/MM/YYYY') lastbill from dual";
			     $DB->parse($sqla);
	         $DB->execute();			 
					 $asa=$DB->nextrow();
					 $lastbilling = $asa["LASTBILL"];

	   $qry = "select a.kdkantor,a.namakantor,a.kdjeniskantor,".
		        "b.proposalprod,c.polisprod,d.proposalprodm,".
		        "e.proposalprodn,f.kliennormal,g.agen,h.penagih ".
						"from $DBUser.tabel_001_kantor a, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprod ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'yyyy')='$thisperiode' and kdpertanggungan='1' ".
						"and prefixpertanggungan='$kantor' ".
						"group by prefixpertanggungan ".
						") b, ".
						"(select s.kdrayonpenagih, count(r.kdpertanggungan) as polisprod ".
						"from  $DBUser.tabel_200_pertanggungan r,$DBUser.tabel_500_penagih s ".
						"where   to_char(r.mulas,'yyyy')='$thisperiode' and ".
						"r.nopenagih = s.nopenagih and r.kdpertanggungan='2' ".
						"and s.kdrayonpenagih='$kantor' ".
						"group by s.kdrayonpenagih ".
						") c, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprodm ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'yyyy')='$thisperiode' and ".
						"kdpertanggungan='1' and kdstatusmedical='M' ".
						"and prefixpertanggungan='$kantor' ".
						"group by prefixpertanggungan ".
						") d, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprodn ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'yyyy')='$thisperiode' and ".
						"kdpertanggungan='1' and kdstatusmedical='N' ".
						"and prefixpertanggungan='$kantor' ".
						"group by prefixpertanggungan ".
						") e, ".
						"(select b.kdkantor,count(a.noklien) as kliennormal ".
						"from $DBUser.tabel_100_klien a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','yyyy') and ".
						"(last_day(to_date('$thisperiode','yyyy'))+5) and a.userrekam = b.userid ".
						"and b.kdkantor='$kantor' ".
						"group by b.kdkantor".
						") f, ".
						"(select b.kdkantor, count(a.noagen) as agen ".
						"from $DBUser.tabel_400_agen a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','yyyy') and ".
						"(last_day(to_date('$thisperiode','yyyy'))+5) and a.userrekam = b.userid ".
						"and b.kdkantor='$kantor' ".
						"group by b.kdkantor".
						") g, ".
						"(select b.kdkantor, count(a.nopenagih) as penagih ".
						"from $DBUser.tabel_500_penagih a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','yyyy') and ".
						"(last_day(to_date('$thisperiode','yyyy'))+5) and a.userrekam = b.userid ".
						"and b.kdkantor='$kantor' ".
						"group by b.kdkantor".
						") h ".
						"where ".
						"a.kdkantor = b.prefixpertanggungan(+) and ".
						"a.kdkantor = c.kdrayonpenagih(+) and ".
						"a.kdkantor = d.prefixpertanggungan(+) and ".
						"a.kdkantor = e.prefixpertanggungan(+) and ".
						"a.kdkantor = f.kdkantor(+) and ".
						"a.kdkantor = g.kdkantor(+) and ".
						"a.kdkantor = h.kdkantor(+) and a.kdkantor='$kantor'";
				 //echo "<br>".$qry."<br>";	
	       $DB->parse($qry);
	       $DB->execute();

function udebelon($data){
 return ($data=='') ? "-" : "<font color=blue>".$data."</font>";
}
?>
<!--<link href="../jws.css" rel="stylesheet" type="text/css">-->
<div align="center">
<? 
echo "<font face=verdana size=2><b>Transaksi Penjualan Polis NBPP Tahun $vthn</b><br><br>";//Tanggal $beginbilling s/d $lastbilling</b></font>";
 ?>
<table border="0" bgcolor="#FFFFFF" cellspacing="1" cellpadding="2">
  <tr>
    <td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">No.</font></td>
    <td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">Kode Kantor</font></td>
    <td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">Nama Kantor</font></td>
    <td bgcolor="#91B7CC" colspan="3" align="center"><font face="Verdana" size="1">Jumlah Klien Di-entry</font></td>
    <td bgcolor="#91B7CC" colspan="2" align="center"><font face="Verdana" size="1">Proposal</td>
    <td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">Penyelesaian <br>
      Proposal/Polis<br>
      oleh Regional</font></td>
  </tr>
  <tr>
    <td bgcolor="#91B7CC" align="center"><font face="Verdana" size="1">Normal</font></td>
    <td bgcolor="#91B7CC" align="center"><font face="Verdana" size="1">Agen</font></td>
    <td bgcolor="#91B7CC" align="center"><font face="Verdana" size="1">Penagih</font></td>

		<td bgcolor="#91B7CC" align="center" width="29"><font face="Verdana" size="1">M</font></td>
    <td bgcolor="#91B7CC" align="center" width="30"><font face="Verdana" size="1">N</font></td>

  </tr>
	<?	
	$i = 1;			

	while($ars=$DB->nextrow()){
	 include "../../includes/belang.php"; 
	 $kdkantor = $ars["KDKANTOR"];	
	 $userrekam = $ars["USERREKAM"];	
	 $kliennormal = ($ars["KDJENISKANTOR"] <> '2') ? '' : udebelon($ars["KLIENNORMAL"]);
	 $agen = ($ars["KDJENISKANTOR"] <> '2') ? '' : udebelon($ars["AGEN"]);
	 $penagih = ($ars["KDJENISKANTOR"] <> '2') ? '' : udebelon($ars["PENAGIH"]);
	 $propmed = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('detilprodmedical.php?kdkantor=$kdkantor&periodeth=$thisperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALPRODM"])."</a>";
	 $propnmed = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('detilprodnonmedical.php?kdkantor=$kdkantor&periodeth=$thisperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALPRODN"])."</a>";
	 $polis = ($ars["KDJENISKANTOR"] <> '2') ? '' :  "<b><a href=\"#\" onclick=\"window.open('detilprodpolis.php?kdkantor=$kdkantor&periodeth=$thisperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["POLISPROD"]);
   $kan = ($ars["KDJENISKANTOR"] <> '2') ? "<b>".$ars["NAMAKANTOR"] : "<a href=\"#\" onclick=\"window.open('detilinfopolis.php?kdkantor=$kdkantor&periode=$thisperiode','updclnt','scrollbars=yes,width=400,height=300,top=100,left=100');\">".$ars["NAMAKANTOR"]."</a>";
	
	?>
    <td align="center"><font face="Verdana" size="1"><? echo $i; ?></font></td>
    <td align="center"><font face="Verdana" size="1"><? echo $kdkantor; ?></font></td>
    <td align="left"><font face="Verdana" size="1"><? echo $kan; ?></font></td>
    <td align="center"><font face="Verdana" size="1"><? echo $kliennormal; ?></font></td>
    <td align="center"><font face="Verdana" size="1"><? echo $agen; ?></font></td>
    <td align="center"><font face="Verdana" size="1"><? echo $penagih; ?></font></td>
    <td align="center"><font face="Verdana" size="1"><? echo $propmed; ?></a></font></td>
		<td align="center"><font face="Verdana" size="1"><? echo $propnmed; ?></a></font></td>
    <td align="center"><font face="Verdana" size="1"><? echo $polis; ?></a></font></td>
  </tr>
	<? 
	$i++;
	$jmlklien+=$ars["KLIENNORMAL"];
	$jmlagen+=$ars["AGEN"];
	$jmlpenagih+=$ars["PENAGIH"];
	$jmlproposal+=$ars["PROPOSAL"];
	$jmlpropmed+=$ars["PROPOSALPRODM"];
	$jmlpropnmed+=$ars["PROPOSALPRODN"];
	$jmlpolis+=$ars["POLISPROD"];
	} 
	//echo "Jml Klien :".$jmlklien;
	?>
	<tr>
	  <td align="center" colspan="3" bgcolor="#91B7CC"><font face="Verdana" size="1"><b>Jumlah</b></font></td>
    <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlklien; ?></b></font></td>
    <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlagen; ?></b></font></td>
    <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlpenagih; ?></b></font></td>
    <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlpropmed;?>	</b></font></td>
		<td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlpropnmed;?>	</b></font></td>
    <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlpolis ?></b></font></td>
  </tr>
</table>		
</div>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? } ?>
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<!--<font face="Verdana" size="2"><a href="showendbilling.php">Back</a></font>-->


