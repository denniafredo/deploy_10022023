<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=new database($userid, $passwd, $DBName);
	$DBG=new Database("ESIP","ESIPOK","GLABC");
	$prefix=strtoupper($prefix);
	$bln = (!$bl) ? $bln : '';
	
	
	function DateSelector($inName, $useDate=0) 
  { 
          if($useDate == 0) 
          { 
              $useDate = Time(); 
          } 
  				$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
          print("<select name=" . $inName .  "tgl>\n"); 

					/*echo "<option value=05>05</option>";
					echo "<option value=15>15</option>";
					echo "<option value=25>25</option>";*/
          //for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          //{ 
		  /*		$currentDay=05;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 
			  $currentDay=15;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 	
			  $currentDay=25;
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 							
          //} 

          print("</select>"); */
		  for($currentDay = 1; $currentDay<= 31;$currentDay++) 
          { 
              print("<option value=\"$currentDay\""); 
  						if($selected==$currentDay) 
              { 
                  print(" selected"); 
              } 					
              print(">$currentDay\n"); 						
          } 
          print("</select>"); 

  
     // Bulan	
  		$selected	= (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);			
          print("<select name=" . $inName .  "bln>\n"); 
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
  						if($selected==$currentMonth) 
              { 
                  print(" selected"); 
              } 					
              print(">$namabulan\n"); 						
          } 
          print("</select>"); 
  
  		// Tahun				
  		$selected	= (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
          print("<select name=" . $inName .  "thn>\n"); 
          $startYear = date( "Y", $useDate); 
          for($currentYear = 2003; $currentYear <= $startYear+0;$currentYear++) 
          { 
              print("<option value=\"$currentYear\""); 
              if($selected==$currentYear) 
              { 
                  print(" selected"); 
              } 
              print(">$currentYear\n"); 
  						
          } 
  				print("</select>"); 
  }
?>
<html>
<title>Daftar Klaim Harian</title>
<head>

<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script LANGUAGE="JavaScript">
function Polis(theForm){
var p=theForm.prefix.value;
var n=theForm.noper.value;
 if (!n =='') { 
  NewWindow('polis.php?prefix='+p+'&noper='+n+'','kartupremi',700,600,1)
 }	
}
</script>
<? include "../../includes/hide.php";  ?>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

-->
</style>
</head>
<body>
<h4>Daftar Klaim Sentralisasi Selesai</h4>

<table cellpadding="1" cellspacing="2">
<form action="<? $PHP_SELF; ?>" method="post" name="memreg">
 <tr>
    <td align="left">Tanggal Proses HO</td>
		<td>:</td>
		<td>
		 <?=DateSelector("d"); ?> 
		</td>
	</tr> 

  <!--tr>
    <td>Jenis Klaim</td>
		<td>:</td>
		<td>
		 <!--select name="jns" onFocus="highlight(event)" class="c">
		 <?
		  $sql = "select kdklaim,namaklaim,kelompok from $DBUser.tabel_902_kode_klaim ".
					 	// "where kdklaim <> 'CASHPLAN' and kelompok is not null order by kelompok";
						 "where kdklaim in ('EXPIRASI','TAHAPAN','BEASISWA','ANUITAS') and kelompok is not null order by kelompok";
		  $DB->parse($sql);
    	$DB->execute();
    	while ($ro=$DB->nextrow()) {
			   echo "<option ";
  				if ($ro["KDKLAIM"]==$jns){ echo " selected"; }
  				echo " value=\"".$ro["KDKLAIM"]."\">".str_replace("KLAIM","",$ro["NAMAKLAIM"])."</option>";
			}
			$jnsselect = $jns=="ALL" ? "selected" : "";
		 ?>
		  <option value="ALL" <?=$jnsselect?>>--ALL--</option>
		 </select>
		</td>
	</tr-->
	<tr>
    <td>Jenis Bank</td>
		<td>:</td>
		<td>
		 <select name="jnsbank" onFocus="highlight(event)" class="c">
		 <?
		  $sql = "select namabank from $DBUser.tabel_399_nick_bank where kdbank in ('BRI','BNI','MDR','DLL','H2H') order by  'BRI','BNI','MDR','DLL'";
		  $DB->parse($sql);
    	$DB->execute();
    	while ($ro=$DB->nextrow()) {
			   echo "<option ";
  				if ($ro["NAMABANK"]==$jnsbank){ echo " selected"; }
  				echo " value=\"".$ro["NAMABANK"]."\">".$ro["NAMABANK"]."</option>";
			}
			$jnsselect = $jnsbank=="ALL" ? "selected" : "";
		 ?>
		  <!--option value="ALL" <?=$jnsselect?>>--ALL--</option-->
		 </select>
		</td>
	</tr>
	<? if($kantor=="KP"){ ?><tr>
		<td>Pilih Kantor</td>
		<td>:</td>
		<td>
		<select name="kdkantor" size="1">
  <option value="all">SELURUH KANTOR</option>
    <? 
  $conn=ocilogon($userid,$passwd,"JSDB");  
  $sqlktr1="select kdkantor,namakantor from tabel_001_kantor where kdkantorinduk like '%A' order by kdkantor ASC";
  $sqlktr=ociparse($conn,$sqlktr1);
  ociexecute($sqlktr);
  while(ocifetch($sqlktr)){
  //$DB->parse($sqlktr);
  //$DB->execute();				
   //	while ($arrktr=$DB->nextrow()) {
   if(ociresult($sqlktr,"KDKANTOR")==$kantor1)
   {
	echo "<option value=".ociresult($sqlktr,"KDKANTOR")." selected>".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
	else
	{
	echo "<option value=".ociresult($sqlktr,"KDKANTOR").">".ociresult($sqlktr,"KDKANTOR")." - ".ociresult($sqlktr,"NAMAKANTOR")."</option>";
	}
   }
  ?>
  </select>
		</td>
	</tr>
  <? } ?>
	<tr>
		<td colspan="3" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
	</form>
</table>
<?
if(isset($_POST["proses"])){
		$sqlsip="begin $DBUser.sip_klaim_pusat('".$_POST["kduniq"]."','".$_POST["jnsbank"]."'); end;";
		echo $sqlsip;
		
	/*	$sqlinsertsip="insert into $DBUser.TABEL_900_KLAIM_PUSAT_SIP 
SELECT   g.NOMORSIP,g.kdsip,G.TGLSIP,user,sysdate,g.keterangan,g.kurs,g.nilai,g.jumlah,g.nourut,g.rekening1,g.rekening2,g.dk,a.kduniqgrup
    FROM   $DBUser.tabel_900_klaim_pusat a,
           $DBUser.tabel_902_kode_klaim b,
           $DBUser.tabel_901_pengajuan_klaim f,
           $DBUser.tabel_900_sip g,
		   $DBUser.tabel_200_pertanggungan h
   WHERE   
           a.kdklaim = f.kdklaim
           AND a.tglpengajuan = f.tglpengajuan
           AND a.prefixpertanggungan = f.prefixpertanggungan
           AND a.nopertanggungan = f.nopertanggungan
			AND a.prefixpertanggungan = h.prefixpertanggungan
           AND a.nopertanggungan = h.nopertanggungan            
           and g.nomorsip=f.nomorsip
		   AND g.nomorsip=a.nomorsip 
           AND a.kdklaim = b.kdklaim
           AND a.kduniqgrup='".$_POST["kduniq"]."'  
		   AND h.kdvaluta='1'	
           AND g.nourut<>0 and g.jumlah<>0 ";
		$sqludpate="update $DBUser.tabel_900_klaim_pusat set statusbayarho='2' where kduniqgrup='".$_POST["kduniq"]."'";
		$sqlisertsip="insert into $DBUser.tabel_900_sip_klaim_ (kduniqgrup,userid,status,tglrekam) values ('".$_POST["kduniq"]."',user,'1',sysdate)";
		$DB->parse($sqlinsertsip);
		$DB->execute();
		$DB->parse($sqludpate);
		$DB->execute();
		$DB->parse($sqlisertsip);
		$DB->execute();
		echo $sqlinsertsip.";<br>".$sqludpate.";<br>".$sqlisertsip;
		
		
		//untuk selanjutnya disambung dengan query cetaksip di kantor pusat dengan query
		
		$sqlsip="select kdsip,keterangan,kurs,sum(nilai),sum(jumlah),rekening1 ".
		"from TABEL_900_KLAIM_PUSAT_SIP where kduniqgrup='K|20161117' ".
		"group by kdsip,keterangan,rekening1,kurs,nourut ".
		"order by nourut"; */
		$DB->parse($sqlsip);
		$DB->execute();
		
	}
if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	} else {
  	$tglcari	=	 ( (strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
  					( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
  					$_POST['dthn'];
	}
	$tgldef .= (strlen(date('d'))==1) ? '0'.date('d') : date('d');
	$tgldef .= "/";
	$tgldef .= (strlen(date('m'))==1) ? '0'.date('m') : date('m');
	$tgldef .= "/";
	$tgldef .= date('Y');

	if(!isset($_POST['dtgl'])){
	 if(isset($_GET['tglcari'])){
	  $tglcari = $tglcari;
	 } else {
	  $tglcari = $tgldef;
	 }
	}
//echo $tglcari;
  if($tglcari!=date("d/m/Y"))
	{
	  $bulancari = $year.$month;
		if($month=="all")
		{
		   //$filterbulan = "and to_char(a.tglpengajuan,'YYYY')='".$year."' ";
			 $filterbulan = "and to_char(a.tglrekam,'YYYY')='".$year."' ";
		}
		else
		{
		   //$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
		   //$filterbulan = "and to_char(a.tglrekam,'YYYYMMDD')='".$year.$month.$currentDay."' ";
		   //$filterbulan = "and a.tglrekam between to_date (to_char(trunc(to_date('".$tglcari."','dd/mm/yyyy')-1),'dd/mm/yyyy')||' 12:00:00','dd/mm/yyyy hh24:mi:ss') and 
			//				to_date (to_char(trunc(to_date('".$tglcari."','dd/mm/yyyy')),'dd/mm/yyyy')||' 11:59:59','dd/mm/yyyy hh24:mi:ss')";
			$kduniqgrup="K|".substr($tglcari,6,4).substr($tglcari,3,2).substr($tglcari,0,2);
			$filterbulanklaim = "and a.kduniqgrup ='$kduniqgrup' ";
		}
	}
	else
	{
	  $month=date("m");
		$year=date("Y");
		$currentDay=date("d");
	  $bulancari = $year.$month.$currentDay;
		//$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
		//$filterbulan = "and to_char(a.tglrekam,'YYYYMMDD')='".$year.$month.$currentDay."' ";
		//$filterbulan = "and a.tglrekam between to_date (to_char(trunc(sysdate-1),'dd/mm/yyyy')||' 12:00:00','dd/mm/yyyy hh24:mi:ss') and to_date (to_char(trunc(sysdate),'dd/mm/yyyy')||' 10:59:59','dd/mm/yyyy hh24:mi:ss') ";		
		$kduniqgrup="K|".$bulancari;
		$filterbulanklaim = "and a.kduniqgrup ='$kduniqgrup' ";
	}
	
  if($jns=="ALL" || !isset($jns))
	{
	  $filterklaim = "and a.kdklaim in ('EXPIRASI','TAHAPAN','BEASISWA','ANUITAS') ";
	}
	else
	{
	  $filterklaim = "and a.kdklaim='".$jns."' ";
	}
	
	if($kdkantor=="ALL" || $kantor=="KP")
	{
	  $filterkantor = " ";
	}
	else
	{
	  $filterkantor = "and e.kdrayonpenagih='$kantor' ";
	}
?>
	

<hr size="1">

			<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#7dc2d9">
					<td height="20">No</td>
					<td>No.Polis</td>
					<td>Nama Klaim</td>
					<td>Tgl.Pengajuan</td>										
					<td>Nilai Benefit</td>
					<td>Tunggakan </td>
					<td>Bunga Tunggakan</td>
					<td>Sisa Gadai</td>
					<td>Sisa Bunga Gadai</td>					
					<td>Refund Premi</td>
					<td>Premi Repeat Bisnis</td>
					<td>Rek. Tujuan</td>
					<td>A.N </td>
					<td>Bank</td>
					<td>Cetak SIP</td>					
					<td>Bukti Bayar</td>
                    <td>Valuta</td>					
				</tr>				
<?
if($jnsbank=="LAINNYA")
	$carijnsbank="and REGEXP_REPLACE(replace(upper(a.namabank),'BANK ',''),'[^A-Z]+', '') not in ('BRI','BNI','MANDIRI') ";
else
	$carijnsbank="and REGEXP_REPLACE(replace(upper(a.namabank),'BANK ',''),'[^A-Z]+', '')='$jnsbank' ";	

 if($jnsbank=="HOST-TO-HOST"){
	 //echo $jnsbank;
	 $sql = "select z.* from (select ".
  					"a.prefixpertanggungan,a.nopertanggungan,a.nomorsip,".					
 						"(SELECT KDMATAUANG FROM $DBUser.TABEL_304_VALUTA WHERE kdvaluta=d.kdvaluta) valuta,nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0)nilaibenefit,".
						"a.kdklaim,b.namaklaim,a.kdkantorproses,".
						"to_char(a.tglrekam,'DD/MM/YYYY hh24:mi:ss') tgl_pengajuan, ".
     				"a.status,a.userfo,to_char(a.tglfo,'DD/MM/YYYY') tglfo,a.userptg,to_char(a.tglhitung,'DD/MM/YYYY') tglhitung,".
						"to_char(a.tglptg,'DD/MM/YYYY') tglptg,".
    				"a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, ".
    				"a.useradlog,to_char(a.tgladlog,'DD/MM/YYYY') tgladlog,c.namastatus,".
					"(select kdmapping||substr(a.noproposal,3,9) from $DBUser.tabel_001_kantor where kdkantor=substr(a.noproposal,1,2)) norekeningbank,".
					"(select namaklien1 from $DBUser.tabel_100_klien x,$DBUser.tabel_200_pertanggungan y where y.nopemegangpolis=x.noklien and (y.prefixpertanggungan||y.nopertanggungan)=a.noproposal) penerimasip,".					
					"'H2H MANDIRI' namabank,'IFGLIFE' cabangbank, ".					
					"nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0) biayapolisbaru,".
					"0 tunggakan,0 bngtunggakan,0 sisabungagadai,0 sisagadai,0 refund  ".
 				"from ".
						"$DBUser.tabel_900_klaim_pusat a,".
						"$DBUser.tabel_902_kode_klaim b,".
						"$DBUser.tabel_999_kode_status c, ".
						"$DBUser.tabel_200_pertanggungan d, ".
						"$DBUser.tabel_500_penagih e ".
				"where ".
				    "a.prefixpertanggungan=d.prefixpertanggungan and a.nopertanggungan=d.nopertanggungan ".
						"and d.nopenagih=e.nopenagih ".
						/*untuk pilot project pembayaran berlaku untuk Anuitas,Expirasi,tahapan dan beasiswa berkala */
						$filterkantor.
						//"and e.kdrayonpenagih='$kantor' ".
						"and a.kdklaim=b.kdklaim ".
						"and nvl(a.status,'0')=c.kdstatus ".
						/*untuk pilot project digunakan pembayaran klaim dengan valuta rupiah */
						//"and d.kdvaluta='1' ".						
						"and nvl(a.klaimgroup,'0') IN ('0','X','2') ".
						"and c.jenisstatus in ('KLAIM','TEBUS') ".
						"and a.metodebayar='TRANSFER' ".
						//$carijnsbank.
						$filterbulanklaim.
						//$filterklaim.
						//"AND ((a.kdkantorproses is null AND e.kdrayonpenagih = '$kantor') OR a.kdkantorproses='$kantor') ".
				"order by a.tglpengajuan) z where nilaibenefit<>0";
 }else{
	 $sql = "select ".
  					"a.prefixpertanggungan,a.nopertanggungan,a.nomorsip,".
					"nvl(a.nilaibenefit,0)-nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0)nilaibenefit,".
 						"a.kdklaim,b.namaklaim,a.kdkantorproses,".
						"to_char(a.tglrekam,'DD/MM/YYYY hh24:mi:ss') tgl_pengajuan,klaimgroup, ".
     				"a.status,a.userfo,to_char(a.tglfo,'DD/MM/YYYY') tglfo,a.userptg,to_char(a.tglhitung,'DD/MM/YYYY') tglhitung,".
					"nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0) premibaru,".
						"to_char(a.tglptg,'DD/MM/YYYY') tglptg,".
						"to_char(a.tglpengajuan,'DD/MM/YYYY') tglpengajuan,".
    				"a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, ".
    				"a.useradlog,to_char(a.tgladlog,'DD/MM/YYYY') tgladlog,c.namastatus,a.penerimasip,a.norekeningbank,a.namabank,a.cabangbank, ".
					"(SELECT KDMATAUANG FROM $DBUser.TABEL_304_VALUTA WHERE kdvaluta=d.kdvaluta) valuta,".
					//"nvl(a.nilaibenefit,0)nilaibenefit,".
					"nvl(a.tunggakan,0)tunggakan,nvl(a.bngtunggakan,0)bngtunggakan,nvl(a.sisabungagadai,0)sisabungagadai,nvl(a.sisagadai,0)sisagadai,nvl(a.refund,0)refund  ".
 				"from ".
						"$DBUser.tabel_900_klaim_pusat a,".
						"$DBUser.tabel_902_kode_klaim b,".
						"$DBUser.tabel_999_kode_status c, ".
						"$DBUser.tabel_200_pertanggungan d, ".
						"$DBUser.tabel_500_penagih e ".
				"where ".
				    "a.prefixpertanggungan=d.prefixpertanggungan and a.nopertanggungan=d.nopertanggungan ".
						"and d.nopenagih=e.nopenagih ".
						/*untuk pilot project pembayaran berlaku untuk Anuitas,Expirasi,tahapan dan beasiswa berkala */
						//$filterkantor.
						//"and e.kdrayonpenagih='$kantor' ".
						"and a.kdklaim=b.kdklaim ".
						//"and a.statusbayarho='2' ".
						"and nvl(a.status,'0')=c.kdstatus ".
						/*untuk pilot project digunakan pembayaran klaim dengan valuta rupiah */
						//"and d.kdvaluta='1' ".		
						//"and e.kdrayonpenagih='$kantor' ".	
						$filterkantor.
						"and nvl(a.klaimgroup,'0') IN ('0','X','2') ".
						"and c.jenisstatus in ('KLAIM','TEBUS ') ".
						"and a.metodebayar='TRANSFER' ".
						$carijnsbank.
						$filterbulanklaim.
						//$filterklaim.
						//"AND ((a.kdkantorproses is null AND e.kdrayonpenagih = '$kantor') OR a.kdkantorproses='$kantor') ".
				"order by a.tglpengajuan";
 }
//echo $sql;
  //echo $year.$month.$currentDay;
  //die;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {

	 switch ($arr["STATUS"]) {
	  case '0':
		 if ($arr["KDKLAIM"]=='MENINGGAL') {
		  if (is_null($arr["NILAIBENEFIT"])||$arr["NILAIBENEFIT"]==0) { //bawa ke FE
		   $nextpage="pengajuanklaimFE.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"];
			 $lanjut = "<a href=# onclick=\"window.location.replace('".$nextpage."')\">Lanjut</a>";		 
		  } else {
			 $lanjut = "TUNGGU DESISI";
		  }
		 } else {
		   $nextpage="pengajuanklaimFE.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"];
			 $nextpage2="pengajuanklaim_anuitas.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"];
			 //$nextpage="pengajuanklaimFE.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
			 if ($arr["KDKLAIM"]=='ANUITAS' || $arr["KDKLAIM"]=='BEASISWA') {
			  $lanjut = "<a href=# onclick=\"window.location.replace('".$nextpage2."')\">Lanjut</a>";		 
			 } else {
			  $lanjut = "<a href=# onclick=\"window.location.replace('".$nextpage."')\">Lanjut</a>";		 
		   }
		 }
		 $user=$arr["USERFO"];
		 $tgluser=$arr["TGLFO"];
		break; 
		
		case '1':
		 $nextpage="pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
		 $user=$arr["USERPTG"];
		 $tgluser=$arr["TGLPTG"];
		 //$lanjut = "HITUNG NILAI KLAIM DI KASIR";
		 $lanjut = "<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>";	
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('pengajuanklaimFF.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&otorisasibayar=1')\">TERBITKAN NOTA DESISI</a>";
 
		break;
		
		case '2':
		 $nextpage="../akunting/bayar.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
		 $user=$arr["USERADLOG"];
		 $tgluser=$arr["TGLADLOG"];
		 //$lanjut = "Dilanjutkan Kasir [<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>]";	 
		 $lanjut = "<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>";	 
		break;		

		case '3':
		 $lanjut = "SELESAI";		 
		 $user=$arr["USERUPDATED"];
		 $tgluser=$arr["TGLUPDATED"];
		break;		
		/*
		case '4':
		 $nextpage="pengajuanklaimFF.php?prefix=$prefix&noper=$noper&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGLPENGAJUAN"];
		 $user=$arr["USERPTG"];
		 $tgluser=$arr["TGLPTG"];
		 //$lanjut = "HITUNG NILAI KLAIM DI KASIR";
		 $lanjut = "<a href=# onclick=NewWindow('../polis/cetakizin_klaim.php?&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."','',700,400,1)>Cetak Nota Desisi</a>";	
		 //$lanjut = "<a href=\"#\" onclick=\"window.location.replace('pengajuanklaimFF.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."&kdklaim=".$arr["KDKLAIM"]."&tglpengajuan=".$arr["TGL_PENGAJUAN"]."&otorisasibayar=1')\">TERBITKAN NOTA DESISI</a>";
 		 break;
		 */
	 }
	 
	 if($kantor!=$arr["KDKANTORPROSES"] && $arr["KDKANTORPROSES"]!="")
	 {
	   $ketkantor = "<b>(Diajukan di kantor ".$arr["KDKANTORPROSES"].")</b>";
	 }
	 else
	 {
	   $ketkantor = "";
	 }
	 
	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
	 echo "<td>$i</td>";
   echo "<td><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
	 echo "<td>".str_replace("KLAIM","",$arr["NAMAKLAIM"])."</td>";
	 echo "<td>".$arr["TGL_PENGAJUAN"]."</td>";	 
	 echo "<td align=right>".number_format($arr["NILAIBENEFIT"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["TUNGGAKAN"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["BNGTUNGGAKAN"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["SISAGADAI"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["SISABUNGAGADAI"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["REFUND"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["PREMIBARU"],2,",",".")."</td>";
	 echo "<td>".$arr["NOREKENINGBANK"]."</td>";
	 echo "<td>".$arr["PENERIMASIP"]."</td>";
	 echo "<td>".$arr["NAMABANK"]." ".$arr["CABANGBANK"]."</td>";
	 echo "<td>";
	 //if($userid=="DEDI"){
		if($arr["KLAIMGROUP"]=="2"){
			echo "<a href=# onclick=NewWindow('../polis/klaim_anuitas_kolektif_cetaksipnihil.php?kdsip=".$arr["KDKLAIM"]."&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLPENGAJUAN"]."','',700,400,1)>CETAK SIP</a>";
		}else{
			echo "<a href=# onclick=NewWindow('../akunting/cetaksip_klaim_nihil.php?kdsip=".$arr["KDKLAIM"]."&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLPENGAJUAN"]."','',700,400,1)>CETAK SIP</a>";
		}
	 //}else{
		// echo "<a href=# onclick=NewWindow('../akunting/cetaksip_klaim_nihil.php?kdsip=".$arr["KDKLAIM"]."&pertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."&nomorsip=".$arr["NOMORSIP"]."&tglsip=".$arr["TGLSIP"]."&tglpengajuan=".$arr["TGLPENGAJUAN"]."','',700,400,1)>CETAK SIP</a>";
	 //}
	 echo "</td>";
	 $sqlbayar="select a.kdmsip,a.namafile
			from esip.TABEL_802_BAYAR_KLAIM_HO a,esip.tabel_802_upl_bayar_sip_klaim b
			where a.kdmsip=b.kdmsip and b.kduniqgrup='$kduniqgrup".$arr["PREFIXPERTANGGUNGAN"].$arr["NOPERTANGGUNGAN"]."'";
	// echo $sqlbayar;
	 $DBG->parse($sqlbayar);
	 $DBG->execute();
	 $arrkduniq=$DBG->nextrow();
	 $buktibayar=$arrkduniq["NAMAFILE"];
	 if($buktibayar=="")
		 echo "<td>N/A</td>";
	 else
		 echo "<td><a href=# onclick=NewWindow('http://192.168.4.29:8003/files/file/document/".$buktibayar."','',700,400,1)>Cetak</a></td>";
	 echo "<td>".$arr["VALUTA"]."</td>";	
   echo "</tr>";
   $i++; 
   $jmlhbenefit+=$arr["NILAIBENEFIT"];
   $jmlhtunggakan+=$arr["TUNGGAKAN"];
   $jmlhbngtunggakan+=$arr["BNGTUNGGAKAN"];
   $jmlhgadai+=$arr["SISAGADAI"];
   $jmlhbnggadai+=$arr["SISABUNGAGADAI"];
   $jmlhrefund+=$arr["REFUND"];
   $jmlhpremibaru+=$arr["PREMIBARU"];
	}		
	?>
	<tr bgcolor="#7dc2d9">
					<td colspan="4">TOTAL</td>					
					<td align="right"><?=number_format($jmlhbenefit,2,",",".");?></td>
					<td align="right"><?=number_format($jmlhtunggakan,2,",",".");?> </td>
					<td align="right"><?=number_format($jmlhbngtunggakan,2,",",".");?></td>
					<td align="right"><?=number_format($jmlhgadai,2,",",".");?></td>
					<td align="right"><?=number_format($jmlhbnggadai,2,",",".");?></td>					
					<td align="right"><?=number_format($jmlhrefund,2,",",".");?></td>
					<td align="right"><?=number_format($jmlhpremibaru,2,",",".");?></td>
					<td colspan="6"></td>                    				
	</tr>
	<?
	$sql="select count(*) jumlah from $DBUser.tabel_900_sip_klaim_ where kduniqgrup='".$kduniqgrup."' and bank='$jnsbank'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arrcont=$DB->nextrow();
	$count=$arrcont["JUMLAH"];
	if($count>0){
		echo "<td bgcolor=#FF9900 align=center colspan=17>&nbsp;";
		//echo "<a href=# onclick=NewWindow('daftar_klaim_harian_ho_cetak.php?act=printY&kduniqgrup=".$kduniqgrup."&bank=".$jnsbank."','',700,400,1)>Cetak</a>";
		echo "</td>";
		
	}else{
		echo "<td bgcolor=#FF9900 align=center colspan=17>&nbsp;</td>";	
	}
	
	
	?>				
</table>			
<hr size="1">

<a href="../submenu.php?mnuinduk=400">Menu Pemeliharaan Polis</a>

</body>
</html>

