<?  
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
 
  $DB = new Database($userid, $passwd, $DBName);
	$sqlb = "select to_char(add_months(last_day(sysdate),-1)+1,'DD/MM/YYYY') beginbill from dual";
			     $DB->parse($sqlb);
	         $DB->execute();			 
					 $asb=$DB->nextrow();
					 $beginbilling = $asb["BEGINBILL"];
					 
	$bulanbilling = substr($beginbilling,3,2);
	$tahunbilling = substr($beginbilling,6,4);
  switch ($bulanbilling)	{
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
 
	$sqla = "select to_char((last_day(sysdate) + 5),'DD/MM/YYYY') lastbill from dual";
			     $DB->parse($sqla);
	         $DB->execute();			 
					 $asa=$DB->nextrow();
					 $lastbilling = $asa["LASTBILL"];
					 
	$sqlb = "select to_char(trunc(sysdate,'MONTH')+4,'DD/MM/YYYY') akhirbill from dual";
				   $DB->parse($sqlb);
	         $DB->execute();			 
					 $asb=$DB->nextrow();
					 $akhirbilling = $asb["AKHIRBILL"];
					 	
	$sql = "select decode(sign(5 - to_number(to_char(sysdate,'dd'))),-1,(last_day(sysdate) + 5) - ".
	       "sysdate,5-to_number(to_char(sysdate,'dd'))) hitunghari from dual";
			     $DB->parse($sql);
	         $DB->execute();			 
					 $ass=$DB->nextrow();
					 $hithari = $ass["HITUNGHARI"];
	//$hithari=2;				 
	if($hithari<=5){
	   $akhirproses = $akhirbilling;
	} else {
	   $akhirproses = $lastbilling;
	}
	
	if($hithari==1){
	  $warningtext ="Batas waktu penyelesaian transaksi ".
		              "anda tinggal <b>1 hari sampai dengan ".
									"jam 23:59:59</b>, jika tidak transaksi akan dimasukkan ".
									"untuk transaksi periode berikutnya.";
	} else if ($hithari==0){
	  $warningtext = "Hari ini proses billing & booking.";
	} else {
	  $warningtext ="Segeralah selesaikan proses transaksi Anda ".
		              "untuk hari ini, jangan ditunda.<br>Lewat tangal <font color=red>$akhirproses</font> transaksi Anda akan diproses untuk periode berikutnya";
	}
	
	$query = "select to_char(sysdate,'DD/MM/YYYY  HH24:MI:SS') tanggal,".
	         "to_char(sysdate,'MMYYYY') thisperiode from dual";
			     $DB->parse($query);
	         $DB->execute();			 
					 $arr=$DB->nextrow();
					 $tgl = $arr["TANGGAL"];
					 $thisperiode = $arr["THISPERIODE"];
           //echo $thisperiode."<br>";
     $qry = "select a.kdkantor,a.namakantor,a.kdjeniskantor,b.proposalprod,".
		        "c.polisprod,c.totpremi,d.proposalprodm,".
		        "e.proposalprodn,f.kliennormal,g.agen,h.penagih ".
						"from $DBUser.tabel_001_kantor a, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprod ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'mmyyyy')='$thisperiode' and kdpertanggungan='1' ".
						"group by prefixpertanggungan ".
						"order by prefixpertanggungan ".
						") b, ".
						"(select s.kdrayonpenagih, count(r.kdpertanggungan) as polisprod,sum(r.premi1) AS totpremi ".
						"from  $DBUser.tabel_200_pertanggungan r,$DBUser.tabel_500_penagih s ".
						"where   to_char(r.mulas,'mmyyyy')='$thisperiode' and ".
						"r.nopenagih = s.nopenagih and r.kdpertanggungan='2' ".
						"group by s.kdrayonpenagih ".
						"order by s.kdrayonpenagih ".
						") c, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprodm ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'mmyyyy')='$thisperiode' and ".
						"kdpertanggungan='1' and kdstatusmedical='M' ".
						"group by prefixpertanggungan ".
						"order by prefixpertanggungan ".
						") d, ".
						"(select prefixpertanggungan, count(kdpertanggungan) as proposalprodn ".
						"from $DBUser.tabel_200_pertanggungan ".
						"where  to_char(mulas,'mmyyyy')='$thisperiode' and ".
						"kdpertanggungan='1' and kdstatusmedical='N' ".
						"group by prefixpertanggungan ".
						"order by prefixpertanggungan ".
						") e, ".
						"(select b.kdkantor,count(a.noklien) as kliennormal ".
						"from $DBUser.tabel_100_klien a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','mmyyyy') and ".
						"(last_day(to_date('$thisperiode','mmyyyy'))+5) and a.userrekam = b.userid ".
						"group by b.kdkantor order by b.kdkantor ".
						") f, ".
						"(select b.kdkantor, count(a.noagen) as agen ".
						"from $DBUser.tabel_400_agen a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','mmyyyy') and ".
						"(last_day(to_date('$thisperiode','mmyyyy'))+5) and a.userrekam = b.userid ".
						"group by b.kdkantor order by b.kdkantor ".
						") g, ".
						"(select b.kdkantor, count(a.nopenagih) as penagih ".
						"from $DBUser.tabel_500_penagih a, $DBUser.tabel_888_userid b ".
						"where a.tglrekam between to_date('$thisperiode','mmyyyy') and ".
						"(last_day(to_date('$thisperiode','mmyyyy'))+5) and a.userrekam = b.userid ".
						"group by b.kdkantor order by b.kdkantor ".
						") h ".
						"where ".
						"a.kdkantor = b.prefixpertanggungan(+) and ".
						"a.kdkantor = c.kdrayonpenagih(+) and ".
						"a.kdkantor = d.prefixpertanggungan(+) and ".
						"a.kdkantor = e.prefixpertanggungan(+) and ".
						"a.kdkantor = f.kdkantor(+) and ".
						"a.kdkantor = g.kdkantor(+) and ".
						"a.kdkantor = h.kdkantor(+) ".
						//"a.kdkantor = '$kantor' ".
						"order by a.kdkantor";
				 //echo "<br>".$qry."<br>";	
				 //die;
	       $DB->parse($qry);
	       $DB->execute();

function udebelon($data){
 return ($data=='') ? "-" : "<font color=blue>".$data."</font>";
}
?>
<!--<link href="../jws.css" rel="stylesheet" type="text/css">-->
<div align="center">
<table border="0" bgcolor="#fe8b85" cellspacing="1" cellpadding="3" width="110">
  <tr>
    <td width="100%" bgcolor="#ffffff">
<table border="0" cellspacing="3" cellpadding="6" width="100%">
  <tr>
    <td width="100%" bgcolor="#fe8b85" align="center">
<? 
    switch($hithari){
		 case "0" : $countdown = "HARI INI"; $ket="Billing & Booking"; break;
		 default : $countdown = $hithari; $ket="hari lagi !";
		}
				 echo "<font face=verdana size=10><b>".$countdown."  </b></font>";
?>
    </td>
  </tr>
</table>
    </td>
  </tr>
	<tr>
    <td width="100%" bgcolor="#ffffff" align="center">
		<table border="0" cellspacing="3" cellpadding="3" width="100%" >
  <tr>
    <td width="100%" bgcolor="#fe8b85" align="center">
        <font face=verdana size=2 color="black"><b><? echo $ket; ?></b></font>
    </td>
  </tr>
</table>
		
		</td>
	</tr>
</table>
<br>
<?
				 echo "<font face=verdana size=2><b>tanggal $akhirproses <br>akan dilakukan proses billing & booking !</b></font><br>";
 ?>
 <br>
<table border="0" width="590" bgcolor="#FF9933" cellspacing="1" cellpadding="3">
  <tr>
    <td width="100%" bgcolor="#FFFFFF">
      <p align="center"><font face="Verdana" size="2" color="blue"><b><? echo $warningtext; ?></b></font></td>
  </tr>
</table>
<br>
<? 
echo "<font face=verdana size=2><b>Transaksi Penjualan Polis NBPP Bulan $bln $tahunbilling<br>Tanggal $beginbilling s/d $lastbilling</b></font>";
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

   <td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">Jumlah Premi</font></td>

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
	 $propmed = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('propstatusmedical.php?kdkantor=$kdkantor&periode=$thisperiode&sttmed=M','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALPRODM"])."</a>";
	 $propnmed = ($ars["KDJENISKANTOR"] <> '2') ? '' : "<b><a href=\"#\" onclick=\"window.open('propstatusmedical.php?kdkantor=$kdkantor&periode=$thisperiode&sttmed=N','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPOSALPRODN"])."</a>";
	 $polis = ($ars["KDJENISKANTOR"] <> '2') ? '' :  "<b><a href=\"#\" onclick=\"window.open('detilprodpolis.php?kdkantor=$kdkantor&periode=$thisperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["POLISPROD"]);
	 $totpremi=$ars["TOTPREMI"];
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
    <td align="center"><font face="Verdana" size="1"><? echo number_format($totpremi,2,",","."); ?></a></font></td>
  </tr>
	<? 
	$totpremi1+=$totpremi;
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
     <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo number_format($totpremi1,2,",","."); ?></b></font></td>
  </tr>
</table>		

</div>
<link href="../jws.css" rel="stylesheet" type="text/css">
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<font face="Verdana" size="2"><a href="oldproduksi.php">Produksi Bulan Sebelumnya</a></font>&nbsp;&nbsp;&nbsp;&nbsp;
<font face="Verdana" size="2"><a href="../mnuutama.php">Kembali ke Menu Utama</a></font>


