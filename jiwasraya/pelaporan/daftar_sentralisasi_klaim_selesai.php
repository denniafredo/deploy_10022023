<?
  	include "../../includes/database.php";
  	include "../../includes/session.php";
	$DB=new database($userid, $passwd, $DBName);
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
		<td><?=DateSelector("d"); ?></td>
	</tr> 
	<tr>
    	<td>Jenis Bank</td>
		<td>:</td>
		<td>
			<select name="jnsbank" onFocus="highlight(event)" class="c">
				<option value="all">Seluruh Kantor</option>
				<?php
				$sql = "SELECT kdbank, namabank 
						FROM $DBUser.tabel_399_nick_bank 
						WHERE kdstatus = '1' 
						ORDER BY kdbank";
				$DB->parse($sql);
				$DB->execute();
				while ($ro=$DB->nextrow()) {
					echo "<option ";
					if ($ro["KDBANK"]==$jnsbank) { 
						echo " selected"; 
					}
					echo " value=\"".$ro["KDBANK"]."\">".$ro["NAMABANK"]."</option>";
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left"><input name="cari" value="Periksa Status" type="submit">
		</td>
	</tr>
</form>
</table>


<?php

if(isset($_GET['tglcari'])) {
	$tglcari = $tglcari;
} else {
  	$tglcari = ((strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
		((strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
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
if($tglcari!=date("d/m/Y")) {
	$bulancari = $year.$month;
	if($month=="all") {
		//$filterbulan = "and to_char(a.tglpengajuan,'YYYY')='".$year."' ";
		$filterbulan = "and to_char(a.tglrekam,'YYYY')='".$year."' ";
	} else {
		//$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
		//$filterbulan = "and to_char(a.tglrekam,'YYYYMMDD')='".$year.$month.$currentDay."' ";
		//$filterbulan = "and a.tglrekam between to_date (to_char(trunc(to_date('".$tglcari."','dd/mm/yyyy')-1),'dd/mm/yyyy')||' 12:00:00','dd/mm/yyyy hh24:mi:ss') and 
		//				to_date (to_char(trunc(to_date('".$tglcari."','dd/mm/yyyy')),'dd/mm/yyyy')||' 11:59:59','dd/mm/yyyy hh24:mi:ss')";
		//$kduniqgrup="K|".substr($tglcari,6,4).substr($tglcari,3,2).substr($tglcari,0,2);
		$kduniqgrup=substr($tglcari,6,4).substr($tglcari,3,2).substr($tglcari,0,2);
		$filterbulanklaim = "and SUBSTR(a.kduniqgrup, 3) ='$kduniqgrup' ";
	}
} else {
	$month=date("m");
	$year=date("Y");
	$currentDay=date("d");
	$bulancari = $year.$month.$currentDay;
	//$filterbulan = "and to_char(a.tglpengajuan,'YYYYMM')='".$year.$month."' ";
	//$filterbulan = "and to_char(a.tglrekam,'YYYYMMDD')='".$year.$month.$currentDay."' ";
	//$filterbulan = "and a.tglrekam between to_date (to_char(trunc(sysdate-1),'dd/mm/yyyy')||' 12:00:00','dd/mm/yyyy hh24:mi:ss') and to_date (to_char(trunc(sysdate),'dd/mm/yyyy')||' 10:59:59','dd/mm/yyyy hh24:mi:ss') ";		
	//$kduniqgrup="K|".$bulancari;
	$kduniqgrup=$bulancari;
	$filterbulanklaim = "and SUBSTR(a.kduniqgrup, 3) ='$kduniqgrup' ";
}
?>
	

	<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#7dc2d9">
					<td height="20" rowspan="2">No</td>
					<td rowspan="2">No.Polis</td>					
					<td rowspan="2">Nama Klaim</td>
					<td rowspan="2">Tgl.Pengajuan</td>
					<td rowspan="2">Tgl.Jatuh Tempo</td>
					<td colspan="3" bgcolor="#C2CAED" align="center"><strong>Nilai Sesuai Desisi</strong></td>					
					<td colspan="5" bgcolor="#99FFFF" align="center"><strong>Nilai Manfaat Rupiah</strong></td>                    
					<td rowspan="2">Rek. Tujuan</td>
					<td rowspan="2">A.N</td>
					<td rowspan="2">Bank</td>					
					<td rowspan="2">Status</td>
                    <td rowspan="2">Valuta</td>					
                    <td rowspan="2">Bukti Bayar</td>					
				</tr>
				<tr>
					<td bgcolor="#C2CAED">Nilai Manfaat</td>
                    <td bgcolor="#C2CAED">Dana Valuasi</td>	
					<td bgcolor="#C2CAED">Tunggakan </td>				
					<!--td bgcolor="#C2CAED">Sisa Gadai (Rp) </td>
					<td bgcolor="#C2CAED">Sisa Bunga Gadai (Rp) </td>					
					<td bgcolor="#C2CAED">Refund Premi (Rp) </td>
					<td bgcolor="#C2CAED">Premi Repeat Bisnis (Rp) </td>
					<td bgcolor="#C2CAED">Index Awal</td>
                    <td bgcolor="#C2CAED">Kurs Transaksi</td-->
					<td bgcolor="#99FFFF">Nilai Manfaat</td>
                    <!--td bgcolor="#99FFFF">Selisih Kurs Benefit</td-->     
					<td bgcolor="#99FFFF">Dana Valuasi</td>
					<td bgcolor="#99FFFF">Tunggakan </td>                  
					<!--td bgcolor="#99FFFF">Bunga Tunggakan Rupiah (Rp) </td>
					<td bgcolor="#99FFFF">Selisih Kurs Bunga Tunggakan (Rp) </td>      
					<td bgcolor="#99FFFF">Sisa Gadai (Rp) </td>
					<td bgcolor="#99FFFF">Sisa Bunga Gadai (Rp) </td>					
					<td bgcolor="#99FFFF">Refund Premi (Rp) </td>
					<td bgcolor="#99FFFF">Premi Repeat Bisnis (Rp) </td-->
                    <td bgcolor="#99FFFF">Selisih Kas Bank (Rp) </td>
                    <td bgcolor="#99FFFF">Nilai Di Bayar (Rp) </td>
				</tr>				
<?
/*if($jenisklaim=="MANFAATHIDUP"){
	//$filterklaim="and a.kdklaim in ('EXPIRASI','TAHAPAN','BEASISWA','ANUITAS','EXPIRASIRB')";
	$filterklaim="a.kdklaim in (select namaklaim from $DBUser.tabel_902_jenis_klaim where jenisklaim='$jenisklaim')";
}elseif($jenisklaim=="MENINGGAL"){
	//$filterklaim="and (a.kdklaim in (select namaklaim from $DBUser.tabel_902_jenis_klaim where jenisklaim='$jenisklaim') OR a.kdklaim IN ('OTHERS')) ";
	$filterklaim="a.kdklaim in (select namaklaim from $DBUser.tabel_902_jenis_klaim where jenisklaim='$jenisklaim')";
}elseif($jenisklaim=="TEBUS"){
	//$filterklaim="and a.kdklaim in ('TEBUS')";
	$filterklaim="a.kdklaim in (select namaklaim from $DBUser.tabel_902_jenis_klaim where jenisklaim='$jenisklaim')";
}*/
//$filterklaim="and a.kdklaim in (select namaklaim from $DBUser.tabel_902_jenis_klaim where jenisklaim='$jenisklaim')";

if($jnsbank=="LAINNYA") {
	$carijnsbank="and REGEXP_REPLACE(replace(upper(a.namabank),'BANK ',''),'[^A-Z]+', '') not in (SELECT kdbank FROM $DBUser.tabel_399_nick_bank WHERE kdstatus = 1 AND gabung = 0) ";
} else {
	$carijnsbank="and REGEXP_REPLACE(replace(upper(a.namabank),'BANK ',''),'[^A-Z]+', '')='$jnsbank' ";
}

if($jnsbank=="HOST-TO-HOST") {
	 $sql = "select z.* from (select ".
  					"a.prefixpertanggungan,a.nopertanggungan,a.nomorsip,".					
 						"(SELECT KDMATAUANG FROM $DBUser.TABEL_304_VALUTA WHERE kdvaluta=d.kdvaluta) valuta,".
						//"nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0)nilaibenefit,".
						//"(select nilaibenefit-sum(jmlnilairp) from $DBUser.TABEL_901_REPEAT_BUSSINESS where prefixpertanggunganold=a.prefixpertanggungan and nopertanggunganold=a.nopertanggungan group by prefixpertanggunganold,nopertanggunganold) nilaibenefit,".
						"jmlnilairp as nilaibenefit,".
						"a.kdklaim,b.namaklaim,a.kdkantorproses,".
						"to_char(a.tglrekam,'DD/MM/YYYY hh24:mi:ss') tgl_pengajuan, ".
     				"a.status,a.userfo,to_char(a.tglfo,'DD/MM/YYYY') tglfo,a.userptg,to_char(a.tglhitung,'DD/MM/YYYY') tglhitung,".
						"to_char(a.tglptg,'DD/MM/YYYY') tglptg,".
    				"a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, ".
    				"a.useradlog,to_char(a.tgladlog,'DD/MM/YYYY') tgladlog,c.namastatus,".
					"(select kdmapping||substr(a.noproposal,3,9) from $DBUser.tabel_001_kantor where kdkantor=substr(a.noproposal,1,2)) norekeningbank,".
					"(select namaklien1 from $DBUser.tabel_100_klien x,$DBUser.tabel_200_pertanggungan y where y.nopemegangpolis=x.noklien and (y.prefixpertanggungan||y.nopertanggungan)=a.noproposal) penerimasip,".					
					"'H2H MANDIRI' namabank,'IFGLIFE' cabangbank, ".					
					//"nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0) biayapolisbaru,".
					"jmlnilairp as biayapolisbaru,".
					"0 tunggakan,0 bngtunggakan,0 sisabungagadai,0 sisagadai,0 refund  ".
 				"from ".
						"$DBUser.tabel_900_klaim_pusat a,".
						"$DBUser.tabel_902_kode_klaim b,".
						"$DBUser.tabel_999_kode_status c, ".
						"$DBUser.tabel_200_pertanggungan d, ".
						"$DBUser.tabel_500_penagih e, ".
						"$DBUser.TABEL_901_REPEAT_BUSSINESS f ".
				"where ".
				    "a.prefixpertanggungan=d.prefixpertanggungan and a.nopertanggungan=d.nopertanggungan ".
					"AND a.prefixpertanggungan=f.prefixpertanggunganold ".
					"AND a.nopertanggungan=f.nopertanggunganold ".
						"and d.nopenagih=e.nopenagih ".
						//"and e.kdrayonpenagih='$kantor' ".
						"and a.kdklaim=b.kdklaim ".
						"and nvl(a.status,'0')=c.kdstatus ".
						/*untuk pilot project digunakan pembayaran klaim dengan valuta rupiah */
						"and d.kdvaluta='$kdvaluta' ".						
						"and nvl(a.klaimgroup,'0') IN ('0','1','X','2') ".
						"and c.jenisstatus='KLAIM' ".
						"and a.metodebayar='TRANSFER' ".
						"and a.kdklaim  in ('EXPIRASI','EXPIRASIRB') ".
						//$carijnsbank.
						$filterbulanklaim.
						$filterklaim.
						//"AND ((a.kdkantorproses is null AND e.kdrayonpenagih = '$kantor') OR a.kdkantorproses='$kantor') ".
				"order by a.tglpengajuan) z where nilaibenefit<>0";
} else {
	 $sql = "select ".
  					"a.prefixpertanggungan,a.nopertanggungan,a.nomorsip,".
 						"decode(a.kdklaim,'TEBUS',a.nilaibenefit,a.nilaibenefit) nilaibenefitvaluta,a.kdklaim,b.namaklaim,a.kdkantorproses,".
						"to_char(a.tglrekam,'DD/MM/YYYY hh24:mi:ss') tgl_pengajuan, to_char(a.tgljatuhtempo,'dd/mm/yyyy') tgljatuhtempo, a.kurs,d.indexawal, ".
     				"a.status,a.userfo,to_char(a.tglfo,'DD/MM/YYYY') tglfo,a.userptg,to_char(a.tglhitung,'DD/MM/YYYY') tglhitung,".
						"to_char(a.tglptg,'DD/MM/YYYY') tglptg,".
    				"a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated, ".
    				"a.useradlog,to_char(a.tgladlog,'DD/MM/YYYY') tgladlog,c.namastatus,a.penerimasip,a.norekeningbank,a.namabank,a.cabangbank, ".
					"(SELECT KDMATAUANG FROM $DBUser.TABEL_304_VALUTA WHERE kdvaluta=d.kdvaluta) valuta,".					
					//"decode(a.nopertanggungan,'001892490',189423499,(nvl((nvl(decode(d.kdvaluta,'1',1,(select kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglpengajuan,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',decode(a.kdklaim,'TEBUS',round(a.nilaibenefit,2),round(a.nilaibenefit/d.indexawal,2)),a.nilaibenefit)),0)))nilaibenefit,".
					//"decode(a.nopertanggungan,'001892490',189423499,(nvl((nvl(decode(d.kdvaluta,'1',1,(select a.kurs-kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglpengajuan,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',decode(a.kdklaim,'TEBUS',round(a.nilaibenefit,2),round(a.nilaibenefit/d.indexawal,2)),a.nilaibenefit)),0)))selisihkursnilaibenefit,".
					"decode(a.nopertanggungan,'001892490',189423499,(nvl((nvl(decode(DECODE(a.kdklaim, 'GADAI', 1, d.kdvaluta),'1',1,(select kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglsip,'month') and kdvaluta=d.kdvaluta)),1)*decode(DECODE(a.kdklaim, 'GADAI', 1, d.kdvaluta),'0',round(a.nilaibenefit/d.indexawal,2),a.nilaibenefit)),0)))nilaibenefit,".
					"decode(a.nopertanggungan,'001892490',189423499,(nvl((nvl(decode(d.kdvaluta,'1',1,(select a.kurs-kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglsip,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',round(a.nilaibenefit/d.indexawal,2),a.nilaibenefit)*DECODE(a.kdklaim,'GADAI',0,1)),0)))selisihkursnilaibenefit,".
					//"nvl(decode(d.kdvaluta,'0',((a.tunggakan/d.indexawal)*a.kurs),'3',(a.tunggakan*a.kurs),a.tunggakan),0)tunggakan,".
					"nvl(a.tunggakan,0)tunggakan,".
					"nvl(nvl(decode(d.kdvaluta,'1',1,(select kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglsip,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',(round(a.tunggakan/d.indexawal,2)),'3',(a.tunggakan),a.tunggakan),0)tunggakanrp,".
					"nvl(nvl(decode(d.kdvaluta,'1',1,(select kurs-a.kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglsip,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',(round(a.tunggakan/d.indexawal,2)),'3',(a.tunggakan),a.tunggakan),0)selisihkurstunggakan,".
					"nvl(decode(d.kdvaluta,'0',((a.bngtunggakan/d.indexawal)*a.kurs),'3',(a.bngtunggakan*a.kurs),a.bngtunggakan),0)bngtunggakan,".
					"nvl(nvl(decode(d.kdvaluta,'1',1,(select kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglsip,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',(round(a.bngtunggakan/d.indexawal,2)),'3',(a.bngtunggakan),a.bngtunggakan),0)bngtunggakanrp,".
					"nvl(nvl(decode(d.kdvaluta,'1',1,(select kurs-a.kurs from $DBUser.tabel_999_kurs where trunc(tglkursberlaku,'month')=trunc(tglsip,'month') and kdvaluta=d.kdvaluta)),1)*decode(d.kdvaluta,'0',(round(a.bngtunggakan/d.indexawal,2)),'3',(a.bngtunggakan),a.bngtunggakan),0)selisihbngtunggakan,".
					//untuk Gadai dianggap sudah rupiah
					"nvl(decode(DECODE(a.kdklaim, 'GADAI', 1, d.kdvaluta),'1',(a.nilaibenefit-nvl(a.tunggakan,0)-nvl(a.bngtunggakan,0)-nvl(a.sisagadai,0)-nvl(a.sisabungagadai,0)+nvl(a.refund,0)),'0',(round((a.nilaibenefit-nvl(a.tunggakan,0)-nvl(a.bngtunggakan,0)+nvl(a.refund,0))/d.indexawal,2)*a.kurs)-nvl(a.sisagadai,0)-nvl(a.sisabungagadai,0),'3',((a.nilaibenefit-nvl(a.tunggakan,0)-nvl(a.bngtunggakan,0)+nvl(a.refund,0))*a.kurs)-nvl(decode(d.kdvaluta,'3',(a.sisagadai*a.kurs),a.sisagadai),0)-nvl(decode(d.kdvaluta,'3',(a.sisabungagadai*a.kurs),a.sisabungagadai),0)),0)nilaidibayar,".
					//"nvl(decode(d.kdvaluta,'1',(nilaibenefit-nvl(tunggakan,0)-nvl(bngtunggakan,0)),'0',(decode(a.kdklaim,'TEBUS',(nilaibenefit-nvl(tunggakan,0)-nvl(bngtunggakan,0)),(nilaibenefit-nvl(tunggakan,0)-nvl(bngtunggakan,0))/d.indexawal)*kurs),'3',((nilaibenefit-nvl(tunggakan,0)-nvl(bngtunggakan,0))*kurs)),0)nilaidibayar,".
					//"nvl((select sum(nilai) from $DBUser.tabel_300_tagihan_pertama where (prefixpertanggungan||nopertanggungan) in (a.noproposal)),0) biayapolisbaru,".					
					"nvl((select sum(jmlnilairp) from $DBUser.tabel_901_repeat_bussiness where (prefixpertanggungan || nopertanggungan) IN (a.noproposal)), 0) biayapolisbaru, ".
					"nvl(decode(d.kdvaluta,'3',(a.sisabungagadai*a.kurs),a.sisabungagadai),0)sisabungagadai,".
					//"nvl(a.sisabungagadai,0)sisabungagadai,".
					"nvl(decode(d.kdvaluta,'3',(a.sisagadai*a.kurs),a.sisagadai),0)sisagadai,a.metodekurs,".
					//"nvl(a.sisagadai,0)sisagadai,".
					//akhir perhitungan gadai
					"nvl(decode(d.kdvaluta,'0',((a.refund/d.indexawal)*a.kurs),'3',(a.refund*a.kurs),a.refund),0)refund, NVL(a.valuasidana,0) valuasidana,  ".
					"(SELECT MAX(kdmsip) FROM tabel_802_upl_bayar_sip_klaim@esip WHERE prefixpertanggungan = a.prefixpertanggungan AND nopertanggungan = a.nopertanggungan AND nomorsip = a.nomorsip) kdmsip ".
 				"from ".
						"$DBUser.tabel_900_klaim_pusat a,".
						"$DBUser.tabel_902_kode_klaim b,".
						"$DBUser.tabel_999_kode_status c, ".
						"$DBUser.tabel_200_pertanggungan d, ".
						"$DBUser.tabel_500_penagih e ".						
				"where ".
				    "a.prefixpertanggungan=d.prefixpertanggungan and a.nopertanggungan=d.nopertanggungan ".
						"and d.nopenagih=e.nopenagih ".
						//"and e.kdrayonpenagih='$kantor' ".
						"and a.kdklaim=b.kdklaim ".
						"and nvl(a.status,'0')=c.kdstatus ".				
						"and nvl(a.klaimgroup,'0') IN ('0','1','X','2') ".
						"and c.jenisstatus in ('KLAIM') ".
						"and a.metodebayar='TRANSFER' ".
						$carijnsbank.
						$filterbulanklaim.
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
	 echo "<td>$arr[TGLJATUHTEMPO]</td>";
	 echo "<td align=right>".number_format($arr["NILAIBENEFITVALUTA"],2,",",".")."</td>";	
	 echo "<td align=right>".number_format($arr["VALUASIDANA"],2,",",".")."</td>"; 
	 echo "<td align=right>".number_format($arr["TUNGGAKAN"],2,",",".")."</td>";	 
	 /*echo "<td align=right>".number_format($arr["SISAGADAI"]*-1,2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["SISABUNGAGADAI"]*-1,2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["REFUND"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr[""],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["INDEXAWAL"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["KURS"],2,",",".")."</td>";*/
	 echo "<td align=right>".number_format($arr["NILAIBENEFIT"],2,",",".")."</td>";
 	 //echo "<td align=right>".number_format($arr["SELISIHKURSNILAIBENEFIT"],2,",",".")."</td>";
	 echo "<td align=right>".number_format($arr["VALUASIDANA"],2,",",".")."</td>";	
	 echo "<td align=right>(".number_format($arr["TUNGGAKANRP"]*-1,2,",",".").")</td>";	  
	 /*echo "<td align=right>(".number_format($arr["BNGTUNGGAKANRP"]*-1,2,",",".").")</td>";	 
	 echo "<td align=right>(".number_format($arr["SELISIHKURSBNGTUNGGAKAN"],2,",",".").")</td>";	 
	 echo "<td align=right>(".number_format($arr["SISAGADAI"]*-1,2,",",".").")</td>";
	 echo "<td align=right>(".number_format($arr["SISABUNGAGADAI"]*-1,2,",",".").")</td>";
	 echo "<td align=right>".number_format($arr["REFUND"],2,",",".")."</td>";
	 
	 echo "<td align=right>".number_format($arr["BIAYAPOLISBARU"],2,",",".")."</td>";*/
	 if($jnsbank=="HOST-TO-HOST"){
		 echo "<td align=right>".number_format(round($arr["NILAIDIBAYAR"]),2,",",".")."</td>";
		 echo "<td align=right>".number_format(round($arr["BIAYAPOLISBARU"]),2,",",".")."</td>";
		 
	 }else{
		 echo "<td align=right>".number_format(round($arr["NILAIDIBAYAR"]+$arr['VALUASIDANA'])-$arr["NILAIDIBAYAR"]-$arr['VALUASIDANA'],2,",",".")."</td>";
		 echo "<td align=right>".number_format(round($arr["NILAIDIBAYAR"]-$arr["BIAYAPOLISBARU"]+$arr['VALUASIDANA']),2,",",".")."</td>";
	 }
	 echo "<td>".$arr["NOREKENINGBANK"]."</td>";
	 echo "<td>".$arr["PENERIMASIP"]."</td>";
	 echo "<td>".$arr["NAMABANK"]." ".$arr["CABANGBANK"]."</td>";
	 echo "<td>(".$arr["STATUS"].") ".$ketkantor."</td>";
	 echo "<td>".$arr["VALUTA"]."</td>";	
	 if ($arr['KDMSIP'])
	 	echo "<td><a href=# onclick=NewWindow('../polis/daftar_klaim_harian_ho_bukti.php?kdmsip=$arr[KDMSIP]','',700,400,1)>Cetak</a></td>";
	 else
	 	echo "<td>&nbsp;</td>";
   echo "</tr>";
   $i++; 
   $jmlvaluasidana+=$arr['VALUASIDANA'];
   $jmlhbenefit+=$arr["NILAIBENEFIT"];
   $jmlhselisihkursbenefit+=$arr["SELISIHKURSNILAIBENEFIT"];   
   $jmlhtunggakanrp+=$arr["TUNGGAKANRP"];
   $jmlhselisihkurstunggakan+=$arr["SELISIHKURSTUNGGAKAN"];
   $jmlhbngtunggakanrp+=$arr["BNGTUNGGAKANRP"];
   $jmlhselisihkursbngtunggakan+=$arr["SELISIHKURSBNGTUNGGAKAN"];
   $jmlhgadai+=$arr["SISAGADAI"];
   $jmlhbnggadai+=$arr["SISABUNGAGADAI"];
   $jmlhrefund+=$arr["REFUND"];
   $premirepeatbisnis+=$arr["BIAYAPOLISBARU"];
   //$jmlhdibayar+=$arr["NILAIDIBAYAR"]; //untuk jumlah dibayar langsung di rounded agar pada jumlah dibawah bisa konsisten
   $jmlhdibayar+=round($arr["NILAIDIBAYAR"]+$arr['VALUASIDANA']);   
   $jmlhselisihkasbank+=(round($arr["NILAIDIBAYAR"]+$arr['VALUASIDANA'])-$arr["NILAIDIBAYAR"]-$arr['VALUASIDANA']);
	}		
	?>
	<tr bgcolor="#7dc2d9">
					<td colspan="4">TOTAL</td>					
					<td align="right">&nbsp; </td>                    
					<td align="right">&nbsp; </td>
                    <td align="right">&nbsp;</td>	
					<td align="right">&nbsp; </td>
					<!--td align="right">&nbsp; </td>
					<td align="right">&nbsp; </td>
					<td align="right">&nbsp; </td>
					<td align="right">&nbsp; </td>
					<td align="right">&nbsp; </td-->
					<td align="right"><strong><?=number_format($jmlhbenefit,2,",",".");?></strong></td>
					<!--td align="right"><strong><?=number_format($jmlhselisihkursbenefit,2,",",".");?></strong></td-->	                                        
					<td align="right"><strong><?=number_format($jmlvaluasidana,2,",",".");?></strong> </td>				
                    <td align="right"><strong>(<?=number_format($jmlhtunggakanrp,2,",",".");?>)</strong>  </td>
					<!--td align="right"><strong>(<?=number_format($jmlhbngtunggakanrp,2,",",".");?>)</strong></td>
                    <td align="right"><strong>(<?=number_format($jmlhselisihkursbngtunggakan,2,",",".");?>)</strong></td>
					<td align="right"><strong>(<?=number_format($jmlhgadai,2,",",".");?>)</strong></td>
					<td align="right"><strong>(<?=number_format($jmlhbnggadai,2,",",".");?>)</strong></td>					
					<!--td align="right">&nbsp; </td-->  
                    <!--td align="right"><strong><?=number_format($jmlhrefund,2,",",".");?></strong></td>					                    
					<td align="right"><strong><?=number_format($premirepeatbisnis,2,",",".");?></strong></td-->
					<td align="right"><strong>
					<?
						if($jnsbank=="HOST-TO-HOST"){
							echo number_format(round($jmlhdibayar),2,",",".");
						}else{
							//echo number_format(round($jmlhdibayar)-$jmlhdibayar,2,",",".");		 //penyesuaian selisih kas bank agar bisa konsisten					
							echo number_format($jmlhselisihkasbank,2,",",".");							
						}
					?>
					</strong></td>
                    <td align="right"><strong>
					<?
						if($jnsbank=="HOST-TO-HOST"){
							echo number_format(round($premirepeatbisnis),2,",",".");
						}else{
							//echo number_format(round($jmlhdibayar)-$premirepeatbisnis,2,",",".");
							echo number_format($jmlhdibayar-$premirepeatbisnis,2,",",".");
						}
					?></strong></td>
                    
					<td colspan="6"></td>                    				
	</tr>			
</table>			

<hr size="1">

<a href="../submenu.php?mnuinduk=400">Menu Pemeliharaan Polis</a>

</body>
</html>

