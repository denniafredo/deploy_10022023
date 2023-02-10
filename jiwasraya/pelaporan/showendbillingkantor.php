<?  
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
 
  $DB = new database($userid, $passwd, $DBName);
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

		 $qry = "select a.kdkantor,a.namakantor,a.kdjeniskantor,b.proposalprod, ".
		        "c.polisprod,".
						"d.proposalprodm,".
		        "e.proposalprodn,".
						//"f.kliennormal,".
						//"g.agen,".
						//"h.penagih,".
						"i.proposaltolak,".
						"j.proposaltunda ".
						"from $DBUser.tabel_001_kantor a,".
						"(select v.prefixpertanggungan, count(v.kdpertanggungan) as proposalprod ".
						"from $DBUser.tabel_200_pertanggungan v ".
						"where  to_char(v.mulas,'mmyyyy')='$thisperiode' ".
						"and v.kdpertanggungan='1' ".
						"and v.kdstatusfile='1' ".
						"and v.prefixpertanggungan='$kantor' ".
						"group by v.prefixpertanggungan ".
						") b, ".
						"(select s.kdrayonpenagih, count(r.kdpertanggungan) as polisprod ".
						"from  $DBUser.tabel_200_pertanggungan r,$DBUser.tabel_500_penagih s ".
						"where   to_char(r.mulas,'mmyyyy')='$thisperiode' and ".
						"r.nopenagih(+)= s.nopenagih and r.kdpertanggungan='2' and ".
						"s.kdrayonpenagih='$kantor' ".
						"group by s.kdrayonpenagih ".
						") c,".
						"(select v1.prefixpertanggungan, count(v1.kdpertanggungan) as proposalprodm ".
						"from $DBUser.tabel_200_pertanggungan v1 ".
						"where  to_char(v1.mulas,'mmyyyy')='$thisperiode' and ".
						"v1.kdpertanggungan='1' and ".
						"v1.kdstatusfile='1' and ".
						"v1.kdstatusmedical='M' and ".
						"v1.prefixpertanggungan='$kantor' ".
						"group by v1.prefixpertanggungan ".
						") d,".
						"(select v2.prefixpertanggungan, count(v2.kdpertanggungan) as proposalprodn ".
						"from $DBUser.tabel_200_pertanggungan v2 ".
						"where  to_char(v2.mulas,'mmyyyy')='$thisperiode' and ".
						"v2.kdpertanggungan='1' and ".
						"v2.kdstatusfile='1' and ".
						"v2.kdstatusmedical='N' and ".
						"v2.prefixpertanggungan='$kantor' ".
						"group by v2.prefixpertanggungan ".
						") e,".

						"(select v.prefixpertanggungan, count(v.kdpertanggungan) as proposaltolak,".
						"t.kdacceptance ".
						"from $DBUser.tabel_200_pertanggungan v,$DBUser.tabel_214_acceptance_dokumen t ".
						"where  to_char(v.mulas,'mmyyyy')='$thisperiode' ".
						"and v.kdpertanggungan='1' and v.prefixpertanggungan='$kantor' and ".
            "v.nopertanggungan=t.nopertanggungan(+) and t.kdacceptance='3' ".
						"group by v.prefixpertanggungan,t.kdacceptance ".
						") i,".
						"(select v.prefixpertanggungan, count(v.kdpertanggungan) as proposaltunda,".
						"t.kdacceptance ".
						"from $DBUser.tabel_200_pertanggungan v,$DBUser.tabel_214_acceptance_dokumen t ".
						"where  to_char(v.mulas,'mmyyyy')='$thisperiode' ".
						"and v.kdpertanggungan='1' and v.prefixpertanggungan='$kantor' and ".
            "v.nopertanggungan=t.nopertanggungan(+) and t.kdacceptance='2' ".
						"group by v.prefixpertanggungan,t.kdacceptance ".
						") j ".
						"where ".
						"a.kdkantor='$kantor' and ".
						"a.kdkantor=d.prefixpertanggungan(+) and ".
						"a.kdkantor=c.kdrayonpenagih(+) and ".
						"a.kdkantor=e.prefixpertanggungan(+) and ".		
						"a.kdkantor=i.prefixpertanggungan(+) and ".	
						"a.kdkantor=j.prefixpertanggungan(+) and ".		
						"a.kdkantor='$kantor'";					
				 //echo "<br>".$qry."<br>";	
	       $DB->parse($qry);
	       $DB->execute();

function udebelon($data){
 return ($data=='') ? "-" : "<font color=blue>".$data."</font>";
}
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
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
<table border="0" width="400" bgcolor="#FF9933" cellspacing="1" cellpadding="3">
  <tr>
    <td width="100%" bgcolor="#FFFFFF" class="verdana9blu" align="center"><b>
			<? 
			
			echo "tanggal $akhirproses <br>".
				   "akan dilakukan proses billing & booking !<br>";				
			echo $warningtext; 
			
			?>
			
			</b></td>
  </tr>
</table>
<br>
<? 
echo "<a class=verdana9blu><b>Transaksi Penjualan Polis</b></a> <a class=verdana9blu href=\"showendbilling.php\"><b>NBPP</b></a> <a class=verdana9blu><b>Bulan $bln $tahunbilling<br>Tanggal $beginbilling s/d $lastbilling kantor $kantor</b></a>";
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
    <td bgcolor="#B3DCEA" class="verdana9blk">
    <p align="center"><b>Transaksi Produk</b></td>
    <td bgcolor="#B3DCEA" class="verdana9blk">
    <p align="center"><b>Jumlah</b></td>
  </tr>
	<!--
  <tr>
    <td class="verdana9blk">Jumlah Klien Normal </td>
    <td class="verdana9blk"><? echo $kliennormal; ?></td>
  </tr>
  <tr>
    <td class="verdana9blk">Agen</td>
    <td class="verdana9blk"><? echo $agen; ?></td>
  </tr>
  <tr>
    <td class="verdana9blk">Penagih</td>
    <td class="verdana9blk"><? echo $penagih; ?></td>
  </tr>
  -->
  <tr>
    <td class="verdana9blk">Proposal Medical</td>
    <td class="verdana9blk"><? echo $propmed; ?></td>
  </tr>
  <tr>
    <td class="verdana9blk">Proposal Non Medical</td>
    <td class="verdana9blk"><? echo $propnmed; ?></td>
  </tr>
	<tr>
    <td class="verdana9blk">Proposal Ditolak</td>
    <td class="verdana9blk"><? echo $proptolak; ?></td>
  </tr>
	<tr>
    <td class="verdana9blk">Proposal Ditunda</td>
    <td class="verdana9blk"><? echo $proptunda; ?></td>
  </tr>
  <tr>
    <td class="verdana9blk">Polis</td>
    <td class="verdana9blk"><? echo $polis; ?></td>
  </tr>
</table>

</div>

<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<font face="Verdana" size="2"><a href="oldproduksi.php">Produksi Bulan Sebelumnya</a></font>&nbsp;&nbsp;&nbsp;&nbsp;
<font face="Verdana" size="2"><a href="../mnuutama.php">Kembali ke Menu Utama</a></font>


