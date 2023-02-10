<?  
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
 
  $DB = new Database($userid, $passwd, $DBName);

	$query = "select to_char(sysdate,'DD/MM/YYYY  HH24:MI:SS') tanggal from dual";
			     $DB->parse($query);
	         $DB->execute();			 
					 $arr=$DB->nextrow();
					 $tgl = $arr["TANGGAL"];
				 
 	function DateSelector($inName, $useDate=0) 
  { 
        $monthName = array(1=> "Januari",  "Pebruari",  "Maret", 
            "April",  "Mei",  "Juni",  "Juli",  "Agustus", 
            "September",  "Oktober",  "Nopember",  "Desember"); 
        if($useDate == 0) 
        {  $useDate = Time(); } 
				
				print("<select name=".$inName."tglawal>\n"); 
	      for($currentDay=1; $currentDay<=31; $currentDay++) { 
		       print("<option value=\"$currentDay\""); 
		        if (intval(date("d", $useDate))==$currentDay) { 
			     print("selected"); 
		    } 
		       print(">$currentDay\n"); 
	      } 
	      print("</select>");
	
        print("<select name=" . $inName .  "blnawal>\n"); 
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
				echo " S/D "; 
				
				print("<select name=".$inName."tglakhir>\n"); 
	      for($currentDay=1; $currentDay<=31; $currentDay++) { 
		       print("<option value=\"$currentDay\""); 
		        if (intval(date("d", $useDate))==$currentDay) { 
			     print("selected"); 
		    } 
		       print(">$currentDay\n"); 
	      } 
	      print("</select>");
				
				print("<select name=" . $inName .  "blnakhir>\n"); 
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
        print("<select name=" . $inName .  "thn>\n"); 
        $startYear = date( "Y", $useDate); 
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
	$vtglawal="0".$vtglawal;
  $vtglakhir="0".$vtglakhir;
  $awaltgl = substr($vtglawal,-2);
  $akhirtgl = substr($vtglakhir,-2);
	
	$vblnawal="0".$vblnawal;
  $vblnakhir="0".$vblnakhir;
  $awalbln = substr($vblnawal,-2);
  $akhirbln = substr($vblnakhir,-2);
	
  if(!$vtglawal){
	   $awalperiode = "01012003";
		 $awaltgl ="01";
		 $bln1= "Januari";
		 $vthn="2003";
	   
		 $akhirtgl=substr($tgl,0,2);
		 //echo "akhir tgl :".$akhirtgl;
		 $akhirbln=substr($tgl,3,2);
		 $jamakhir = substr($tgl,-8);
		 $akhirperiode = $akhirtgl."".$akhirbln."".$vthn;
		 $pukul = "Pukul ".$jamakhir;
		 
		 			switch ($akhirbln)	{
		          case "01": $bln2 = "Januari"; break;
	            case "02": $bln2 = "Pebruari"; break;
	            case "03": $bln2 = "Maret"; break;
		          case "04": $bln2 = "April"; break;
		          case "05": $bln2 = "Mei"; break;
		          case "06": $bln2 = "Juni"; break;
		          case "07": $bln2 = "Juli"; break;
		          case "08": $bln2 = "Agustus"; break;
		          case "09": $bln2 = "September"; break;
		          case "10": $bln2 = "Oktober"; break;
		          case "11": $bln2 = "Nopember"; break;
		          case "12": $bln2 = "Desember"; break;
           }
		 
	} else {
	   $awalperiode=$awaltgl."".$awalbln."".$vthn;
     $akhirperiode=$akhirtgl."".$akhirbln."".$vthn;

						switch ($awalbln)	{
		          case "01": $bln1 = "Januari"; break;
	            case "02": $bln1 = "Pebruari"; break;
	            case "03": $bln1 = "Maret"; break;
		          case "04": $bln1 = "April"; break;
		          case "05": $bln1 = "Mei"; break;
		          case "06": $bln1 = "Juni"; break;
		          case "07": $bln1 = "Juli"; break;
		          case "08": $bln1 = "Agustus"; break;
		          case "09": $bln1 = "September"; break;
		          case "10": $bln1 = "Oktober"; break;
		          case "11": $bln1 = "Nopember"; break;
		          case "12": $bln1 = "Desember"; break;
           }
					 switch ($akhirbln)	{
		          case "01": $bln2 = "Januari"; break;
	            case "02": $bln2 = "Pebruari"; break;
	            case "03": $bln2 = "Maret"; break;
		          case "04": $bln2 = "April"; break;
		          case "05": $bln2 = "Mei"; break;
		          case "06": $bln2 = "Juni"; break;
		          case "07": $bln2 = "Juli"; break;
		          case "08": $bln2 = "Agustus"; break;
		          case "09": $bln2 = "September"; break;
		          case "10": $bln2 = "Oktober"; break;
		          case "11": $bln2 = "Nopember"; break;
		          case "12": $bln2 = "Desember"; break;
           }
			}
					 

	/*			 
  $qry = "select f.namakantor,f.kdkantor,f.kdjeniskantor,a.kliennormal,".
	       "c.polis,d.penagih,e.agen,g.proposal propnmed,h.proposal propmed ".
	       "from $DBUser.tabel_ujicoba_kliennormal a,".
				 "$DBUser.tabel_ujicoba_polis c,$DBUser.tabel_ujicoba_penagih d,".
				 "$DBUser.tabel_ujicoba_agen e,$DBUser.tabel_001_kantor f,".
				 "$DBUser.tabel_ujicoba_proposaln g,$DBUser.tabel_ujicoba_proposalm h  ". 
				 "where f.kdkantor = a.kdkantor(+) and ".
				 "f.kdkantor = c.kdkantor(+) and f.kdkantor = d.kdkantor(+) and ".
				 "f.kdkantor = g.kdkantor(+) and f.kdkantor = h.kdkantor(+) and ".
				 "f.kdkantor = e.kdkantor(+) order by f.kdkantor";
	*/		 
	
	$qry = "select f.namakantor,f.kdkantor,f.kdjeniskantor,a.kliennormal,".
	          "c.polis,c1.premi,c2.jua,d.penagih,e.agen,g.proposal propnmed,h.proposal propmed ".
	       "from ".
				     "(select y.kdkantor,count(x.noklien) as kliennormal ".
						 "from $DBUser.tabel_100_klien x,$DBUser.tabel_888_userid y ".
						 "where ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid group by y.kdkantor order by y.kdkantor) a,".

				     "(select y.kdkantor,count(x.kdpertanggungan) as polis ".
						 "from $DBUser.tabel_200_pertanggungan x, $DBUser.tabel_888_userid y ".
						 "where x.kdpertanggungan='2' and ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid group by y.kdkantor order by y.kdkantor) c,".
						 
						 "(select y.kdkantor,sum(x.premi1 * x.indexawal) as premi ".
						 "from $DBUser.tabel_200_pertanggungan x, $DBUser.tabel_888_userid y ".
						 "where x.kdpertanggungan='2' and ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid group by y.kdkantor order by y.kdkantor) c1,".
						 
						 "(select y.kdkantor,sum(x.juamainproduk * x.indexawal) as jua ".
						 "from $DBUser.tabel_200_pertanggungan x, $DBUser.tabel_888_userid y ".
						 "where x.kdpertanggungan='2' and ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid group by y.kdkantor order by y.kdkantor) c2,".
						 
						 "(select y.kdkantor,count(x.nopenagih) as penagih ".
						 "from $DBUser.tabel_500_penagih x, $DBUser.tabel_888_userid y ".
						 "where ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid group by y.kdkantor order by y.kdkantor) d,".
						 
						 "(select y.kdkantor,count(x.noagen) as agen ".
						 "from $DBUser.tabel_400_agen x, $DBUser.tabel_888_userid y ".
						 "where ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid group by y.kdkantor order by y.kdkantor) e,".
					 
					 "$DBUser.tabel_001_kantor f,".
					   "(select y.kdkantor,count(x.kdpertanggungan) as proposal ".
					   "from $DBUser.tabel_200_pertanggungan x, $DBUser.tabel_888_userid y ".
						 "where ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 "x.userrekam=y.userid and ".
             "x.kdpertanggungan='1' and ".
						 "x.kdstatusmedical='N' ".						 
						 "group by y.kdkantor order by y.kdkantor) g,".
					 
					   "(select y.kdkantor,count(x.kdpertanggungan) as proposal ".
					   "from $DBUser.tabel_200_pertanggungan x, $DBUser.tabel_888_userid y ".
						 "where ".
						 "(x.tglrekam between to_date('$awalperiode','DDMMYYYY') and to_date('$akhirperiode','DDMMYYYY')) and ".
						 //"x.tglrekam >= to_date('14/05/2002','DD/MM/YYYY') and ".
						 "x.userrekam=y.userid and ".
             "x.kdpertanggungan='1' and ".
						 "x.kdstatusmedical='M' ".						 
						 "group by y.kdkantor order by y.kdkantor) h ".
				 
				 "where f.kdkantor = a.kdkantor(+) and ".
				   "f.kdkantor = c.kdkantor(+) and ".
				   "f.kdkantor = c1.kdkantor(+) and ".
					 "f.kdkantor = c2.kdkantor(+) and ".
				   "f.kdkantor = d.kdkantor(+) and ".
				   "f.kdkantor = g.kdkantor(+) and ".
					 "f.kdkantor = h.kdkantor(+) and ".
				   "f.kdkantor = e.kdkantor(+) order by f.kdkantor";
      //echo $qry;
			
	       $DB->parse($qry);
	       $DB->execute();

function udebelon($data){
 return ($data=='') ? "<font color=red>Belum</font>" : "<font color=blue>".$data."</font>";
}
?>
<!--<link href="../jws.css" rel="stylesheet" type="text/css">-->
<font face="Verdana" size="2"><b>LAPORAN PERKEMBANGAN PRODUKSI MELALUI APLIKASI XL-iNdO PER KANTOR INKASO</b></font><br>
<hr size="1">	
 	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Periode</td>
	<td class="verdana10blk"> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="cariagen" value="CARI">
	</td>
  </tr>
	</form>
	</table>
<hr size="1">	
<div align="center">
<font face="Verdana" size="2"><b>Mulai Tanggal <? echo $awaltgl." ".$bln1." ".$vthn; ?> sampai dengan <? echo $akhirtgl." ".$bln2." ".$vthn." ".$pukul; ?> </b></font><br><br>
<table border="0" width="590" bgcolor="#FF9933" cellspacing="1" cellpadding="3">
  <tr>
    <td width="100%" bgcolor="#FFFFFF">
      <p align="center"><font face="Verdana" size="1">Untuk setiap masalah yang
      ditemukan anda dapat menghubungi&nbsp; melalui email di <a href="mailto:xlindo@jiwasraya.co.id"><font color="#0000FF">xlindo@jiwasraya.co.id</font></a>
      atau melalui Mirc (Forum Komunikasi User Jiwasraya) kepada setiap&nbsp;
      staf Divisi Pengolahan Data Head Office. </font></td>
  </tr>
</table>
<br>

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
		<td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">Premi</td>
		<td bgcolor="#91B7CC" rowspan="2" align="center"><font face="Verdana" size="1">JUA</td>
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
	 $propmed = ($ars["PROPMED"] =='') ? '' : "<b><a href=\"#\" onclick=\"window.open('detilpropinfomedical.php?kdkantor=$kdkantor&sttmed=M&awalperiode=$awalperiode&akhirperiode=$akhirperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPMED"]);
	 $propnmed = ($ars["PROPNMED"] =='') ? '' : "<b><a href=\"#\" onclick=\"window.open('detilpropinfomedical.php?kdkantor=$kdkantor&sttmed=N&awalperiode=$awalperiode&akhirperiode=$akhirperiode','updclnt','scrollbars=yes,width=800,height=400,top=100,left=100')\">".udebelon($ars["PROPNMED"]);
	 $polis = ($ars["POLIS"] =='') ? '' :  "<b><a href=\"#\" onclick=\"window.open('detilpolisjadi.php?kdkantor=$kdkantor&awalperiode=$awalperiode&akhirperiode=$akhirperiode','updclnt','scrollbars=yes,width=950,height=400,top=100,left=100')\">".udebelon($ars["POLIS"]);
   $kan = ($ars["KDJENISKANTOR"] <> '2') ? "<b>".$ars["NAMAKANTOR"] : "<a href=\"#\" onclick=\"window.open('detilinfopolis.php?kdkantor=$kdkantor&awalperiode=$awalperiode&akhirperiode=$akhirperiode','updclnt','scrollbars=yes,width=400,height=300,top=100,left=100');\">".$ars["NAMAKANTOR"]."</a>";
	 $premi = ($ars["PREMI"] =='') ? '-' :  udebelon(number_format($ars["PREMI"],2));
	 $jua = ($ars["JUA"] =='') ? '-' :  udebelon(number_format($ars["JUA"],2));
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
		<td align="right"><font face="Verdana" size="1"><? echo $premi; ?></a></font></td>
		<td align="right"><font face="Verdana" size="1"><? echo $jua; ?></a></font></td>
  </tr>
	<? 
	$i++;
	$jmlklien+=$ars["KLIENNORMAL"];
	$jmlagen+=$ars["AGEN"];
	$jmlpenagih+=$ars["PENAGIH"];
	$jmlproposal+=$ars["PROPOSAL"];
	$jmlpropmed+=$ars["PROPMED"];
	$jmlpropnmed+=$ars["PROPNMED"];
	$jmlpolis+=$ars["POLIS"];
	$jmlpremi+=$ars["PREMI"];
	$jmljua+=$ars["JUA"];
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
    <td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo $jmlpolis; ?></b></font></td>
		<td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo number_format($jmlpremi,2); ?></b></font></td>
		<td align="center" bgcolor="#91B7CC"><font face="Verdana" size="1"><b><? echo number_format($jmljua,2); ?></b></font></td>
  </tr>
</table>		
<? 
/*
$sqlx = "select sysdate from dual";
		$DB->parse($sqlx);
	  $DB->execute();
		$arx=$DB->nextrow();
	  $jani=$arx["SYSDATE"];
		$jani=substr($jani,0,6);
				
$sqlz = "select count(distinct users) jml,count(distinct ip) ipunik from $DBUser.usersonline where ".
        "tgl like '$jani%' ".
				"and timestamp is not null and users is not null and status is null ";
  $DB->parse($sqlz);
	$DB->execute();
  $arz=$DB->nextrow();
	$usersonline=$arz["JML"];
	$ipunik=$arz["IPUNIK"];
	echo "<a class=\"verdana10blk\">Status : </a><a class=\"verdana10blk\" href=\"userslogin.php\">".$usersonline."</a><a class=\"verdana10blk\"> Users dari $ipunik Unique IP sedang online. Check <a class=\"verdana10blk\" href=\"userslogin.php\">di sini</a>!</a>";
*/
 ?>
</div>
<link href="../jws.css" rel="stylesheet" type="text/css">
<hr size="1">
<a href="index.php"><font face="Verdana" size="2">Menu Pelaporan</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="infopolisbyproduk.php"><font face="Verdana" size="2">Jumlah Polis Berdasarkan Produk</font></a>

