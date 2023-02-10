<? 
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/common.php";
 include ('../includes/monthselector.php');
echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<a class=\"verdana9blk\"><b>Produksi NBPP</b></a>";
echo "<hr size=1>";
echo "  <table>";
echo "  <form name=produksi method=post action=$PHP_SELF>";
echo "    <tr>";
echo "      <td class=\"verdana9blk\">Pilih Bulan Produksi</td>";
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
$thisperiode="$bln$vthn";
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
					 	
	$query = "select to_char(sysdate,'DD/MM/YYYY  HH24:MI:SS') tanggal,".
	         "to_char(sysdate,'MMYYYY') thisperiode from dual";
			     $DB->parse($query);
	         $DB->execute();			 
					 $arr=$DB->nextrow();
					 $tgl = $arr["TANGGAL"];

     $qry = "select a.kdkantor,a.namakantor,a.kdjeniskantor,b.proposalprod,".
		        "c.polisprod,".
						"d.proposalprodm,".
		        "e.proposalprodn,".
						"f.kliennormal,".
						"g.agen,".
						"h.penagih,".
						"i.proposaltolak,".
						"j.proposaltunda ".
						"from $DBUser.tabel_001_kantor a, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprod ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'mmyyyy')='$thisperiode' and kdpertanggungan='1' ".
						"and prefixpertanggungan='$kantor' ".
						"group by prefixpertanggungan ".
						") b, ".
						"(select s.kdrayonpenagih, count(r.kdpertanggungan) as polisprod ".
						"from  $DBUser.tabel_200_pertanggungan r,$DBUser.tabel_500_penagih s ".
						"where   to_char(r.mulas,'mmyyyy')='$thisperiode' and ".
						"r.nopenagih = s.nopenagih and r.kdpertanggungan='2' ".
						"and s.kdrayonpenagih='$kantor' ".
						"group by s.kdrayonpenagih ".
						") c, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprodm ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'mmyyyy')='$thisperiode' and ".
						"kdpertanggungan='1' and kdstatusmedical='M' ".
						"and prefixpertanggungan='$kantor' ".
						"group by prefixpertanggungan ".
						") d, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprodn ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'mmyyyy')='$thisperiode' and ".
						"kdpertanggungan='1' and kdstatusmedical='N' ".
            "and prefixpertanggungan='$kantor' ".
						"group by prefixpertanggungan ".
						") e, ".
						"(select b.kdkantor,count(a.noklien) as kliennormal ".
						"from $DBUser.tabel_100_klien a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','mmyyyy') and ".
						"(last_day(to_date('$thisperiode','mmyyyy'))+5) and a.userrekam = b.userid ".
						"and b.kdkantor='$kantor' ".
						"group by b.kdkantor ".
						") f, ".
						"(select b.kdkantor, count(a.noagen) as agen ".
						"from $DBUser.tabel_400_agen a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','mmyyyy') and ".
						"(last_day(to_date('$thisperiode','mmyyyy'))+5) and a.userrekam = b.userid ".
						"and b.kdkantor='$kantor' ".
						"group by b.kdkantor ".
						") g, ".
						"(select b.kdkantor, count(a.nopenagih) as penagih ".
						"from $DBUser.tabel_500_penagih a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','mmyyyy') and ".
						"(last_day(to_date('$thisperiode','mmyyyy'))+5) and a.userrekam = b.userid ".
						"and b.kdkantor='$kantor' ".
						"group by b.kdkantor ".
						") h,".
						"(select v.prefixpertanggungan, count(v.kdpertanggungan) as proposaltolak,".
						"t.kdacceptance ".
						"from $DBUser.tabel_200_pertanggungan v,$DBUser.tabel_214_acceptance_dokumen t ".
						"where  to_char(v.mulas,'mmyyyy')='$thisperiode' ".
						"and v.kdpertanggungan='1' and v.prefixpertanggungan='$kantor' and ".
            "v.nopertanggungan=t.nopertanggungan(+) and t.kdacceptance='3' ".
						"group by v.prefixpertanggungan,t.kdacceptance ".
						") i, ".
						"(select v.prefixpertanggungan, count(v.kdpertanggungan) as proposaltunda,".
						"t.kdacceptance ".
						"from $DBUser.tabel_200_pertanggungan v,$DBUser.tabel_214_acceptance_dokumen t ".
						"where  to_char(v.mulas,'mmyyyy')='$thisperiode' ".
						"and v.kdpertanggungan='1' and v.prefixpertanggungan='$kantor' and ".
            "v.nopertanggungan=t.nopertanggungan(+) and t.kdacceptance='2' ".
						"group by v.prefixpertanggungan,t.kdacceptance ".
						") j ".
						"where ".
						"a.kdkantor = b.prefixpertanggungan(+) and ".
						"a.kdkantor = c.kdrayonpenagih(+) and ".
						"a.kdkantor = d.prefixpertanggungan(+) and ".
						"a.kdkantor = e.prefixpertanggungan(+) and ".
						"a.kdkantor = i.prefixpertanggungan(+) and ".
						"a.kdkantor = j.prefixpertanggungan(+) and ".
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
echo "<font face=verdana size=2><b>Transaksi Penjualan Polis NBPP Bulan $bln $vthn</b><br><br>";//Tanggal $beginbilling s/d $lastbilling</b></font>";
	while($ars=$DB->nextrow()){
	 $kdkantor = $ars["KDKANTOR"];	
	 $userrekam = $ars["USERREKAM"];	
	 $kliennormal = ($ars["KDJENISKANTOR"] <> '2') ? '' : udebelon($ars["KLIENNORMAL"]);
	 $agen = ($ars["KDJENISKANTOR"] <> '2') ? '' : udebelon($ars["AGEN"]);
	 $penagih = ($ars["KDJENISKANTOR"] <> '2') ? '' : udebelon($ars["PENAGIH"]);
	 $propmed = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('propstatusmedical.php?kdkantor=$kdkantor&periode=$thisperiode&sttmed=M','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALPRODM"])."</a>";
	 $propnmed = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('propstatusmedical.php?kdkantor=$kdkantor&periode=$thisperiode&sttmed=N','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALPRODN"])."</a>";
	 $proptolak = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('propstatusaccept.php?kdkantor=$kdkantor&periode=$thisperiode&sttacc=tolak','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALTOLAK"])."</a>";
	 $proptunda = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('propstatusaccept.php?kdkantor=$kdkantor&periode=$thisperiode&sttacc=tunda','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALTUNDA"])."</a>";
	 $polis = ($ars["KDJENISKANTOR"] <> '2') ? '' :  "<b><a href=\"#\" onclick=\"window.open('detilprodpolis.php?kdkantor=$kdkantor&periode=$thisperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["POLISPROD"]);
   $kan = ($ars["KDJENISKANTOR"] <> '2') ? "<b>".$ars["NAMAKANTOR"] : "<a href=\"#\" onclick=\"window.open('detilinfopolis.php?kdkantor=$kdkantor&periode=$thisperiode','updclnt','scrollbars=yes,width=400,height=300,top=100,left=100');\">".$ars["NAMAKANTOR"]."</a>";
}
?>
<table border="1" cellpadding="3" cellspacing="4" style="border-collapse: collapse" bordercolor="#C0C0C0" width="400" id="AutoNumber1">
  <tr>
    <td bgcolor="#B3DCEA" class="verdana10blk">
    <p align="center"><b>Transaksi Produk</b></td>
    <td bgcolor="#B3DCEA" class="verdana10blk">
    <p align="center"><b>Jumlah</b></td>
  </tr>
  <tr>
    <td class="verdana10blk">Jumlah Klien Normal </td>
    <td class="verdana10blk"><? echo $kliennormal; ?></td>
  </tr>
  <tr>
    <td class="verdana10blk">Agen</td>
    <td class="verdana10blk"><? echo $agen; ?></td>
  </tr>
  <tr>
    <td class="verdana10blk">Penagih</td>
    <td class="verdana10blk"><? echo $penagih; ?></td>
  </tr>
  <tr>
    <td class="verdana10blk">Proposal Medical</td>
    <td class="verdana10blk"><? echo $propmed; ?></td>
  </tr>
  <tr>
    <td class="verdana10blk">Proposal Non Medical</td>
    <td class="verdana10blk"><? echo $propnmed; ?></td>
  </tr>
	<tr>
    <td class="verdana10blk">Proposal Ditolak</td>
    <td class="verdana10blk"><? echo $proptolak; ?></td>
  </tr>
	<tr>
    <td class="verdana10blk">Proposal Ditunda</td>
    <td class="verdana10blk"><? echo $proptunda; ?></td>
  </tr>
  <tr>
    <td class="verdana10blk">Polis</td>
    <td class="verdana10blk"><? echo $polis; ?></td>
  </tr>
</table>

</div>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? } ?>
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<!--<font face="Verdana" size="2"><a href="showendbilling.php">Back</a></font>-->


