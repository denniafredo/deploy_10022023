<?php
	// reformat & modified by fendy 17/12/2018
	include "../../includes/session.php";
	include "../../includes/database.php";
	
	/*if((date("d")!="04" ||date("d")!="14" || date("d")!="24" || date("d")!="26") && $kantor!="KP"){
		echo "<blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Divisi ARC </blink>";
		die;
	}*/
	
	$str = (date("d"));
	//$exclude_list = array("04","14","24");
	$exclude_list = array("04","14","24");
	$tglprosesSAM = '';
	$exclude_wae = array(0000072931,0000072929,0000072930,0000072942,0000072936,0000072937,0000072934,0000072938,0000073139,0000072957,0000072958,0000072959,0000072960,0000073120,0000073360,0000072961,0000072925,0000072927,0000072924,0000073138,0000072926,0000072928,0000072916,0000072915,0000072917,0000073136,0000072918,0000072919,0000073284,0000072975,0000072974,0000072948,0000073145,0000072976,0000072950,0000072951,0000072949,0000072954,0000072952,0000072953,0000072955,0000073142,0000073356,0000072956,0000072970,0000072971,0000072972,0000072973,0000072977,0000073140,0000073358,0000072946,0000072947,0000072945,0000073144,0000072920,0000073137,0000072921,0000072923,0000072922,0000072940,0000072941,0000072939,0000072933,0000072964,0000072969,0000072963,0000072962,0000073143,0000073359,0000072965,0000072966,0000072967,0000072968,0000073141,0000072943,0000072944,0000072932,0000072935);
	//if(!in_array($str, $exclude_list) && ($kantor!="LG" || $kantor!="EH" || $kantor!="BC")) { 
	/*if(!in_array($str, $exclude_list) && ($kantor!="KP")){
		echo "<blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Hubungi Divisi ARC </blink>";
		die;
	}*/

	$DB = new Database($userid,$passwd,$DBName);
	$DB1 = new Database($userid,$passwd,$DBName);
	//echo $DBName;
	// $conn = ocilogon($userid,$passwd,$DBName);
	$conn = ocilogon('nadm','ifg#dbs#nadm#2020',$DBName);
	$conn2 = ocilogon('nadm','ifg#dbs#nadm#2020',$DBName);
	
	function DateSelector($inName, $useDate=0) { 
		if($useDate == 0) { 
			$useDate = Time(); 
		} 
		
		$selected	= (isset($_POST[$inName.'tgl']) && $_POST[$inName.'tgl']!='') ? $_POST[$inName.'tgl'] : date( "j", $useDate);
		
		// Tanggal
		print("<select name=" . $inName .  "tgl>\n"); 
		/*echo "<option value=05>05</option>";
		echo "<option value=15>15</option>";
		echo "<option value=25>25</option>";*/
		//for($currentDay = 1; $currentDay<= 31;$currentDay++) { 
		$currentDay=04;
		print("<option value=\"$currentDay\""); 
		if($selected==$currentDay) { 
			print(" selected"); 
		}
		print(">$currentDay</option>"); 
		
		$currentDay=14;
		print("<option value=\"$currentDay\""); 
		if($selected==$currentDay) { 
			print(" selected"); 
		}
		print(">$currentDay</option>");
		
		$currentDay=24;
		print("<option value=\"$currentDay\""); 
		if($selected==$currentDay) { 
			print(" selected"); 
		}
		print(">$currentDay</option>");
		//}
		print("</select>"); 
		
		// Bulan	
  		$selected = (isset($_POST[$inName.'bln']) && $_POST[$inName.'bln']!='') ? $_POST[$inName.'bln'] : date( "n", $useDate);
		print("<select name=" . $inName .  "bln>\n"); 
		for($currentMonth = 1; $currentMonth <= 12;$currentMonth++) { 
			switch($currentMonth) {
				case '1' : $namabulan ="JANUARI"; break;
                case '2' : $namabulan ="FEBRUARI"; break;
                case '3' : $namabulan ="MARET"; break;
                case '4' : $namabulan ="APRIL"; break;
                case '5' : $namabulan ="MEI"; break;
                case '6' : $namabulan ="JUNI"; break;
                case '7' : $namabulan ="JULI"; break;
                case '8' : $namabulan ="AGUSTUS"; break;
                case '9' : $namabulan ="SEPTEMBER"; break;
                case '10' : $namabulan ="OKTOBER"; break;
                case '11' : $namabulan ="NOVEMBER"; break;
                case '12' : $namabulan ="DESEMBER"; break;
			}
			
			print("<option value=\"$currentMonth\""); 
			if($selected==$currentMonth) { 
				print(" selected"); 
			}
			
			print(">$namabulan</option>");
		} 
		print("</select>"); 
  
  		// Tahun				
  		$selected = (isset($_POST[$inName.'thn']) && $_POST[$inName.'thn']!='') ? $_POST[$inName.'thn'] : date( "Y", $useDate);			
		print("<select name=" . $inName .  "thn>\n"); 
		$startYear = date( "Y", $useDate); 
		for($currentYear = 2003; $currentYear <= $startYear+1;$currentYear++) { 
			print("<option value=\"$currentYear\""); 
			if($selected==$currentYear) { 
				print(" selected"); 
			} 
			print(">$currentYear\n"); 
		} 
		print("</select>"); 
	} 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Daftar Komisi (Sentralisasi - KP)</title>
	<style type="text/css">
	<!-- 
	body { font-family: tahoma,verdana,geneva,sans-serif; font-size: 12px; } 
	td { font-family: tahoma,verdana,geneva,sans-serif; font-size: 11px; } 
	input {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; padding:1px; } 
	select {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em; } 
	textarea {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em; } 
	a { color:#259dc5; text-decoration:none; } 
	a:hover { color:#cc6600; } 
	#filterbox{ border: solid 1px #c0c0c0; padding : 5px; width:100%; margin : 0 0 10px 0; } 
	form{ margin : 0; padding : 0; } 
	--> 
	</style> 
	<script language="JavaScript" type="text/javascript" src="../includes/window.js"></script>
	<script language="JavaScript"> 
		function Cekbok(doc) { 
			if (doc == true) {
				checkedAll('getpremi', true);
			} else {
				checkedAll('getpremi', false);
			}
		} 
		function checkedAll (id, checked) {
			var el = document.getElementById(id);
			for (var i = 0; i < el.elements.length; i++) {
			  el.elements[i].checked = checked;
			}
		}
	</script> 
</head> 
	
<?php if($act=="print") { ?> 
<body onLoad="window.print();window.close()"> 
<?php } else { ?> 
<body topmargin="10">
	<? //include "./menu.php"; ?>
	<form name="getpremi" id="getpremi" action="<?=$PHP_SELF;?>" method="post">
	<div id="filterbox">
		<table>
			<tr>
				<td>Tanggal Mutasi <?=DateSelector("d"); ?></td>
				<td>Kantor 
				<?
					$kntrsql = "Select kdkantor, namakantor from $DBUser.tabel_001_kantor where status = '1' and kdkantor <> 'KN' order by kdkantor ";
					//echo $kntrsql;
					$sql_ktr= ociparse($conn, $kntrsql);
					oci_execute($sql_ktr);
					print("<select name='kantorpilihan'>");
					while (($row = oci_fetch_array($sql_ktr, OCI_BOTH)) != false) {
						$dipilih = "";
						if($kantorpilihan == $row[0]){$dipilih = "selected";}
				?>
						<option value="<?=$row[0]?>" <?=$dipilih;?>> <?php echo $row[0]."-".$row[1];?> </option>; 
				<?	
					}
					print("</select>"); 
				?>
				</td>
				<td colspan="2"><input type="submit" name="submit" value="Cari"></td>
			</tr>
		</table>
	</div>
	<?php }
	
	if(isset($_GET['tglcari'])) {
		$tglcari = $tglcari;
	} else {
		$tglcari = ((strlen($_POST['dtgl'])==1) ? '0'.$_POST['dtgl'] : $_POST['dtgl'] ) ."/".
			( (strlen($_POST['dbln'])==1) ? '0'.$_POST['dbln'] : $_POST['dbln'] ) ."/".
			$_POST['dthn'];
	}
	$tgldef .= (strlen(date('d'))==1) ? '0'.date('d') : date('d');
	$tgldef .= "/";
	$tgldef .= (strlen(date('m'))==1) ? '0'.date('m') : date('m');
	$tgldef .= "/";
	$tgldef .= date('Y');
	
	if(!isset($_POST['dtgl'])) {
		if(isset($_GET['tglcari'])) {
			$tglcari = $tglcari;
		} else {
			$tglcari = $tgldef;
		}
	}
	
	if($_POST['dtgl']=="all" || substr($_GET['tglcari'],0,3)=="all") {
		$filtercari = "and to_char(a.tglmutasi,'MM/YYYY')='".substr($tglcari,-7)."' ";
		$titletglcari = "BULAN ".substr($tglcari,-7);
	} else {
		$filtercari = "and to_char(a.tglmutasi,'DD/MM/YYYY')='$tglcari' ";
		$titletglcari = $tglcari;
	}
	?>
	
	<b>DAFTAR VALIDASI KOMISI AGEN (Sentralisasi KP)<BR /> 
	TANGGAL <?=$titletglcari ;?></b>
	
	<?php if ($_POST['check']) {
		$box=$_POST['box1']; //as a normal var
		$box_count=count($box); // count how many values in array
		if (($box_count)<1) {
			//echo "No Data Updated !";
		} else {
			foreach ($box as $dear) {
				// var_dump(substr($dear,41,10));die;
				/*$sqa="update $DBUser.tabel_404_komisi_agen set kdauthorisasi='1',tglupdated=sysdate,userupdated='".$userid.
					"' WHERE kdauthorisasi is null and nopertanggungan=substr('$dear',0,9) and kdkomisiagen=substr('$dear',10,2) and  (to_char(tglproses,'DD/MM/YYYY')='$titletglcari')";*/
				//echo $dear;
				if(substr($dear,0,4) == 'LIFE') {
					$value = explode(',',$dear);
					$sqa="update $DBUser.tabel_404_pendapatan_lain_agen set kdauthorisasi='2',tglupdated=sysdate,userupdated='".$userid.
					"' WHERE noagen = '$value[5]' and kdkomisiagen = '$value[2]' and to_char(tglproses,'DD/MM/YYYY') ='$value[3]' and nokontrak = '$value[1]' and to_char(tgllunas,'DD/MM/YYYY') ='$value[4]' ";
					//echo $sqa;die;
					$DB->parse($sqa);
					  $DB->execute();	
				} else {
				$sqa="update $DBUser.tabel_404_komisi_agen set kdauthorisasi='1',tglupdated=sysdate,userupdated='".$userid.
				"' WHERE kdauthorisasi is null and noagen = substr('$dear',32,10) and  nopertanggungan=substr('$dear',0,9) and kdkomisiagen=substr('$dear',10,2) and  (to_char(tglproses,'DD/MM/YYYY')='".substr($dear,11,10)."')  and  (to_char(tglbooked,'DD/MM/YYYY')='".substr($dear,21,10)."')";
				//echo $sqa;die;
				$DB->parse($sqa);
      			$DB->execute();	
				}
				
				//echo $sqa;	
				//echo substr($dear,21,10);
			}
		}
	}
	
	if ($_POST['uncheck']) {
		$box=$_POST['box1']; //as a normal var
		$box_count=count($box); // count how many values in array
		if (($box_count)<1) {
			//echo "No Data Updated !";
		} else { 
			foreach ($box as $dear) {
				if(substr($dear,0,4) == 'LIFE') {
					$value = explode(',',$dear);
					$sqa="update $DBUser.tabel_404_pendapatan_lain_agen set kdauthorisasi='2',tglupdated=sysdate,userupdated='".$userid.
					"' WHERE noagen = '$value[5]' and kdkomisiagen = '$value[2]' and to_char(tglproses,'DD/MM/YYYY') ='$value[3]' and nokontrak = '$value[1]' and to_char(tgllunas,'DD/MM/YYYY') ='$value[4]' ";
					//echo $sqa;die;
					$DB->parse($sqa);
					  $DB->execute();	
				} else {
				$sqa="update $DBUser.tabel_404_komisi_agen set kdauthorisasi=null,tglupdated=sysdate,userupdated='".$userid.
					"' WHERE kdauthorisasi='1' and noagen = substr('$dear',32,10) and nopertanggungan=substr('$dear',0,9) and kdkomisiagen=substr('$dear',10,2) and  (to_char(tglbooked,'DD/MM/YYYY')='".substr($dear,21,10)."') and  (to_char(tglproses,'DD/MM/YYYY')='".substr($dear,11,10)."')";
				//echo $sqa;die;
				$DB->parse($sqa);
				$DB->execute();	
				}
				//echo $sqa;
				//echo substr($dear,21,10);	
			}
		}
	}
	
	if ($_POST['proses']) {
		//$sqp="declare x varchar(10); begin x:=$DBUser.billingx.rekap_komisi('$kantor','".substr($titletglcari,3,2).substr($titletglcari,6,4)."','".substr($titletglcari,0,2)."','".$userid."'); commit; end;";
		$box=$_POST['box1']; //as a normal var
		$box_count=count($box); // count how many values in array
		if (($box_count)<1) {
			//echo "No Data Updated !";
		} else {
			foreach ($box as $dear) {
				//echo substr($dear,11,10). ' '. substr($dear,11,2). ' '.substr($dear,14,2).' '. substr($dear,17,4); die;
				$sqa="begin $DBUser.KOMISI_REKAP('$kantorpilihan','".substr($dear,14,2). substr($dear,17,4)."','". substr($dear,11,2)."','".$userid."'); end;";
				//echo $sqa;die;
				$DB->parse($sqa);
				$DB->execute();	
			}
		}

		
		
	} ?>
	
	<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" id="AutoNumber1">
		<tr>
			<td bgcolor="#89acd8" align="center">No.</td>
			<td bgcolor="#89acd8" align="center">BO</td>
			<td bgcolor="#89acd8" align="center">No. Polis</td>
			<td bgcolor="#89acd8" align="center">No. Agen</td>
			<td bgcolor="#89acd8" align="center">Rek. Bank</td>
			<td bgcolor="#89acd8" align="center">Komisi</td>
			<td bgcolor="#89acd8" align="center">Cara </br>Bayar</td>
			<td bgcolor="#89acd8" align="center">Tahun </br>Komisi</td>
			<td bgcolor="#89acd8" align="center">Komisi. (Rp)</td>
			<td bgcolor="#89acd8" align="center">Tgl. Periode</td>
			<td bgcolor="#89acd8" align="center">Tgl. Booked</td>
			<!--<td bgcolor="#89acd8" align="center">Tgl. Mulas</td>
			<td bgcolor="#89acd8" align="center">Polis Switching</td>
			<td bgcolor="#89acd8" align="center">User</td>-->
			<td bgcolor="#89acd8" align="center">Check<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></td>
		</tr>
		<?php
		//echo $tglcari;
		$sql = "SELECT tglbooked, tglupdated, STATUS_JOIN_TEAM, tglproses, a.prefixpertanggungan, a.nopertanggungan, a.noagen, a.komisiagenrp,
					a.kdkomisiagen, kdauthorisasi, valuta, thnkomisi, kdjeniscb, transfer, tgltransfer, komthn1, komthn2, komthn3, namabank,
					kombp3, namakomisiagen, bankagen, stspolis, namaagen, statuslisensi,statuslisensiagenkomisi, statusorganik,kdjabatanagen,
					CASE WHEN FLOOR(ADD_MONTHS(tglpkajagen, 24) - sysdate) > 0 THEN FLOOR(ADD_MONTHS(tglpkajagen, 24) - sysdate) ELSE 0 END sisapkaj
				FROM (
					SELECT NVL(STATUS_JOIN_TEAM, 0) AS STATUS_JOIN_TEAM, TO_CHAR(a.tglbooked, 'DD/MM/YYYY') tglbooked, TO_CHAR(a.tglupdated,'DD/MM/YYYY') tglupdated, 
						TO_CHAR(a.tglproses,'DD/MM/YYYY') tglproses, a.prefixpertanggungan, a.nopertanggungan, a.noagen, a.komisiagenrp, 
						a.kdkomisiagen, kdauthorisasi, (select kdmatauang from $DBUser.tabel_304_valuta where kdvaluta=a.kdvaluta) valuta, 
						thnkomisi, kdjeniscb, transfer, to_char(a.tglproses,'DD/MM/YYYY') tgltransfer,
						DECODE(a.thnkomisi,1,a.komisiagenrp) komthn1,
						DECODE(a.thnkomisi,2,a.komisiagenrp) komthn2,
						DECODE(a.thnkomisi,3,a.komisiagenrp) komthn3,b.namabank, 
						DECODE(a.kdkomisiagen,'02',a.komisiagenrp) kombp3, 
						(SELECT namakomisiagen FROM $DBUser.tabel_402_kode_komisi_agen WHERE kdkomisiagen = a.kdkomisiagen) AS namakomisiagen, 
						(SELECT norekening||' / '||namabank  FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen) AS bankagen,
						(SELECT kdpertanggungan FROM $DBUser.tabel_200_pertanggungan WHERE nopertanggungan = a.nopertanggungan and prefixpertanggungan=a.prefixpertanggungan) AS stspolis,
						(SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = a.noagen) AS namaagen,
						(SELECT CASE
									WHEN KDSTATUSAGEN = 2 THEN 0 
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE) OR KDSTATUSAGEN = 1 THEN 1 
									ELSE 0 
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = c.noagen
						) AS statuslisensi,
						(SELECT CASE
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE) THEN 1
									ELSE 0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen
						) AS statuslisensiagenkomisi,
						b.statusorganik,b.kdjabatanagen
					FROM $DBUser.tabel_404_komisi_agen a, $DBUser.tabel_400_agen b, $DBUser.tabel_200_pertanggungan c 
					WHERE ( a.noagen = b.noagen ) 
						AND a.prefixpertanggungan=c.prefixpertanggungan 
						AND a.nopertanggungan=c.nopertanggungan 
						AND b.kdstatusagen = '01' 
						AND c.kdproduk not in ('JL4BA') 
						AND (a.kdrayonpenagihan = '$kantorpilihan')
						AND (to_char(a.tglproses,'dd/mm/yyyy') = '$tglcari'
						AND (kdkomisiagen NOT IN ('10','88','E1'))
						AND NVL(komisiagenrp,0) > 0 )
						

					UNION
					/*untuk LIFE saver*/
					SELECT NVL(STATUS_JOIN_TEAM, 0) AS STATUS_JOIN_TEAM, TO_CHAR(a.tgllunas, 'DD/MM/YYYY') tglbooked, TO_CHAR(a.tglupdated,'DD/MM/YYYY') tglupdated, 
						TO_CHAR(a.tglproses,'DD/MM/YYYY') tglproses, 'LIFE' as prefixpertanggungan, a.nokontrak, a.noagen,  nilaipendapatan as komisiagenrp, 
						a.kdkomisiagen, KDAUTHORISASI, '' as valuta, 
						1 as thnkomisi, 'LS' as kdjeniscb, transfer, to_char(a.tglproses,'DD/MM/YYYY') tgltransfer,
						1 as komthn1,
						2 as komthn2,
						3 as komthn3,
						b.namabank, 
						null kombp3, 
						(SELECT namakomisiagen FROM $DBUser.tabel_402_kode_komisi_agen WHERE kdkomisiagen = a.kdkomisiagen) AS namakomisiagen, 
						(SELECT norekening||' / '||namabank  FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen) AS bankagen,
						'2' AS stspolis,
						(SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = a.noagen) AS namaagen,
						(SELECT CASE
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE)  OR KDSTATUSAGEN = 2 THEN 1
									ELSE 0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen
						) AS statuslisensi,
						(SELECT CASE
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE) THEN 1
									ELSE 0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen
						) AS statuslisensiagenkomisi,
						b.statusorganik,b.kdjabatanagen
					FROM $DBUser.tabel_404_pendapatan_lain_agen a, $DBUser.tabel_400_agen b
					WHERE ( a.noagen = b.noagen ) 
						AND b.kdstatusagen = '01'  
						AND (a.kdkantor = '$kantorpilihan')
						AND (to_char(a.tglproses,'dd/mm/yyyy') = '$tglcari'
						AND (kdkomisiagen IN ('L1'))
						AND NVL(nilaipendapatan,0) > 0 )

					union

					SELECT NVL(STATUS_JOIN_TEAM, 0) AS STATUS_JOIN_TEAM, TO_CHAR(a.tgllunas, 'DD/MM/YYYY') tglbooked, TO_CHAR(a.tglupdated,'DD/MM/YYYY') tglupdated, 
						TO_CHAR(a.tglproses,'DD/MM/YYYY') tglproses, 'LIFE' as prefixpertanggungan, a.nokontrak, a.noagen,  nilaipendapatan as komisiagenrp, 
						a.kdkomisiagen, KDAUTHORISASI, '' as valuta, 
						1 as thnkomisi, 'LS' as kdjeniscb, transfer, to_char(a.tglproses,'DD/MM/YYYY') tgltransfer,
						1 as komthn1,
						2 as komthn2,
						3 as komthn3,
						b.namabank, 
						null kombp3, 
						(SELECT namakomisiagen FROM $DBUser.tabel_402_kode_komisi_agen WHERE kdkomisiagen = a.kdkomisiagen) AS namakomisiagen, 
						(SELECT norekening||' / '||namabank  FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen) AS bankagen,
						'2' AS stspolis,
						(SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = a.noagen) AS namaagen,
						(SELECT CASE
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE)  OR KDSTATUSAGEN = 2 THEN 1
									ELSE 0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen
						) AS statuslisensi,
						(SELECT CASE
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE) THEN 1
									ELSE 0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen
						) AS statuslisensiagenkomisi,
						b.statusorganik,b.kdjabatanagen
					FROM $DBUser.tabel_404_pendapatan_lain_agen a, $DBUser.tabel_400_agen b
					WHERE ( a.noagen = b.noagen ) 
						AND b.kdstatusagen = '01'  
						AND (a.kdkantor = '$kantorpilihan')
						AND nvl(a.KDAUTHORISASI,0) < '2'  
						AND (to_char(a.tglproses,'mmyyyy') < '". substr($tglcari,3,2).substr($tglcari,6,7)."'
						AND (kdkomisiagen IN ('L1'))
						AND NVL(nilaipendapatan,0) > 0 )

					UNION
					
					SELECT NVL(STATUS_JOIN_TEAM, 0) AS STATUS_JOIN_TEAM , TO_CHAR(a.tglbooked, 'DD/MM/YYYY') tglbooked, TO_CHAR(a.tglupdated,'DD/MM/YYYY') tglupdated, 
						TO_CHAR(a.tglproses,'DD/MM/YYYY') tglproses, a.prefixpertanggungan, a.nopertanggungan, a.noagen, a.komisiagenrp, 
						a.kdkomisiagen, kdauthorisasi, (select kdmatauang from $DBUser.tabel_304_valuta where kdvaluta=a.kdvaluta) valuta, 
						thnkomisi, kdjeniscb, transfer, to_char(a.tgltransfer,'DD/MM/YYYY') tgltransfer,
						DECODE(a.thnkomisi,1,a.komisiagenrp) komthn1,
						DECODE(a.thnkomisi,2,a.komisiagenrp) komthn2,
						DECODE(a.thnkomisi,3,a.komisiagenrp) komthn3,b.namabank,
						DECODE(a.kdkomisiagen,'02',a.komisiagenrp) kombp3, 
						(SELECT namakomisiagen FROM $DBUser.tabel_402_kode_komisi_agen WHERE kdkomisiagen = a.kdkomisiagen) AS namakomisiagen, 
						(SELECT norekening||' / '||namabank FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen) AS bankagen,
						(SELECT kdpertanggungan FROM $DBUser.tabel_200_pertanggungan WHERE nopertanggungan = a.nopertanggungan and prefixpertanggungan=a.prefixpertanggungan) AS stspolis,
						(SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = a.noagen) AS namaagen,
						(SELECT CASE
								WHEN KDSTATUSAGEN = 2 THEN 0
								WHEN    (    NOLISENSIAGEN IS NOT NULL
										AND TGLAKHIRLISENSI >= SYSDATE)
									OR KDSTATUSAGEN = 1
								THEN
									1
								ELSE
									0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = c.noagen
						) AS statuslisensi,
						(SELECT CASE
									WHEN (NOLISENSIAGEN IS NOT NULL AND TGLAKHIRLISENSI >= SYSDATE) THEN 1
									ELSE 0
								END
						 FROM $DBUser.tabel_400_agen WHERE noagen = a.noagen
						) AS statuslisensiagenkomisi,
						b.statusorganik,b.kdjabatanagen
					FROM $DBUser.tabel_404_komisi_agen a, $DBUser.tabel_400_agen b, $DBUser.tabel_200_pertanggungan c 
					WHERE ( a.noagen = b.noagen ) 
						AND a.prefixpertanggungan=c.prefixpertanggungan 
						AND a.nopertanggungan=c.nopertanggungan 
						AND b.kdstatusagen = '01'
						AND c.kdproduk not in ('JL4BA') 
						AND (a.kdrayonpenagihan = '$kantorpilihan')
						AND to_char(a.tglproses,'mmyyyy') < '". substr($tglcari,3,2).substr($tglcari,6,7)."'
						AND (kdkomisiagen NOT IN ('10','88','36','E1'))
						AND NVL(komisiagenrp,0) >0
						AND nvl(a.KDAUTHORISASI,0) < '2'  
						
				) a 
				LEFT OUTER JOIN (
					SELECT noagen, MAX(tglpkajagen) tglpkajagen
					FROM $DBUser.tabel_400_pkaj_agen
					GROUP BY noagen
				) b ON a.noagen = b.noagen
				ORDER BY bankagen, a.noagen DESC";
		// echo $sql;//die;
		// echo "<br />".$sql."<br />";
		$DB->parse($sql);
		$DB->execute();				
		$i = 1;
		while ($arr=$DB->nextrow()) {
			$jmltoatgen[$i]=$arr["NOAGEN"];
			if ($arr["NOAGEN"]!=$jmltoatgen[($i-1)] && $i>1) { ?>
				<tr bgcolor="#f5d79c">
					<td align="right" colspan="9"><b>SUB TOTAL</b></td>
					<td align="right"><b><?=number_format($jmltotal,2,",",".");?></b></td>
					<td></td><td></td>
				</tr>
				<?php $jmltotal=0;
			}
			$style = '';

			if($arr['TGLPROSES'] != $arr['TGLUPDATED']){
				$style .= "<tr bgcolor=#'F8F8FF'>";
			}else{
				$style .= "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
			}
			echo $style; ?>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDRAYONPENAGIH"];?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
					<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
					<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a>
				</td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA">
					<a href="#" onClick="window.open('../agen/editagen.php?noagen=<?=$arr["NOAGEN"];?>&noper=<?=$arr["NAMAAGEN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
					<?=$arr["NOAGEN"]."-".$arr["NAMAAGEN"];?></a>
				</td>
				<!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOAGEN"].'-'.$arr["NAMAAGEN"];?></td>-->
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["BANKAGEN"];?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMAKOMISIAGEN"];?></td>
				<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDJENISCB"];?></td>
				<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["THNKOMISI"];?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["KOMISIAGENRP"],2,",",".");?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLPROSES"];?><?//=$arr["TGLUPDATED"];?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLBOOKED"];?></td>
				<!--<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?//=$arr["MULAS"];?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?//=$arr["NOPOLSWITCH"];?></td>
				<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?//=$arr["USERMUTASI"];?></td>-->
				<?php if ($arr["STSPOLIS"]==2) {
					if ($arr["NAMABANK"]<>'BRI') {
						echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>Non BRI</td>";
					} else {
						if ($arr["KDAUTHORISASI"]==1) {
							if($arr['PREFIXPERTANGGUNGAN'] == 'LIFE'){
								echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>".
								"<input type='checkbox' name='box1[]' value=".$arr['PREFIXPERTANGGUNGAN'].','.$arr["NOPERTANGGUNGAN"].','.$arr["KDKOMISIAGEN"].','.$arr["TGLPROSES"].','.$arr["TGLBOOKED"].','.$arr["NOAGEN"].">Approved</td>";
							} else {
							echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>".
								"<input type='checkbox' name='box1[]' value=".$arr["NOPERTANGGUNGAN"].$arr["KDKOMISIAGEN"].$arr["TGLPROSES"].$arr["TGLBOOKED"].$arr["NOAGEN"].">Approved</td>";
							}
						} elseif ($arr["KDAUTHORISASI"]==4) {
							echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>Locked</td>";
						} elseif ($arr["KDAUTHORISASI"]==2) {
							if ($arr["TRANSFER"]!=1) {
								echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>Processed On ".$arr["TGLUPDATED"]."</td>";
							} else {
								echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>Transfered On ".$arr["TGLTRANSFER"]."</td>";
							}
						} elseif( in_array($arr["NOAGEN"], $exclude_wae) ){
							echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><font color='red'>Jabatan agen WAE tidak mendapat komisi.</font></td>";
						} elseif( ($arr["STATUSLISENSI"] == 0 || $arr["STATUSLISENSIAGENKOMISI"] == 0) AND ($arr["STATUSORGANIK"] != 2 AND $arr["KDJABATANAGEN"] != 19 ) ){
							echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><font color='red'>Status lisensi agen penutup / agen penerima komisi tidak aktif atau expired.</font></td>";
						} else {
							// echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><input type='checkbox' name='box1[]' value=".$arr["NOPERTANGGUNGAN"].$arr["KDKOMISIAGEN"].$arr["TGLPROSES"].$arr["TGLBOOKED"].$arr["NOAGEN"]."></td>";
							//Ini yang dicopy untuk perubahan jointeam
							if($arr['PREFIXPERTANGGUNGAN'] == 'LIFE'){
								echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><input type='checkbox' name='box1[]' value=".$arr['PREFIXPERTANGGUNGAN'].','.$arr["NOPERTANGGUNGAN"].','.$arr["KDKOMISIAGEN"].','.$arr["TGLPROSES"].','.$arr["TGLBOOKED"].','.$arr["NOAGEN"]."></td>";
							} else {
								echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'><input type='checkbox' name='box1[]' value=".$arr["NOPERTANGGUNGAN"].$arr["KDKOMISIAGEN"].$arr["TGLPROSES"].$arr["TGLBOOKED"].$arr["NOAGEN"]."></td>";
							}
							//sampe sini yang dicopy untuk perubahan jointeam
						}
					}
				} else {
					echo "<td align='center' style='border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA'>Proposal</td>";
				}; ?>
				<td style="background-color:#ffffff;" nowrap>
					<?php if ($arr['SISAPKAJ'] <= 30) { ?>
						<span style="color:#FF0000"> </span>
					<?php } ?>
					<?php
					 if ($arr["KDKOMISIAGEN"] == 'D4' || $arr["KDKOMISIAGEN"] == 'D5' || $arr["KDKOMISIAGEN"] == 'D6' || $arr["KDKOMISIAGEN"] == 'D7' || $arr["KDKOMISIAGEN"] == 'D8' ) { 
					if ($arr['STATUS_JOIN_TEAM'] == '0' || $arr['STATUS_JOIN_TEAM'] == '' ) { ?>
					<span style="color:#FF0000">Status Agen Belum Join Team</span>
					<?php } } ?>
				</td>
			</tr>
			
			<?php
			$jmltotal += $arr["KOMISIAGENRP"];
			$jmltotalall += $arr["KOMISIAGENRP"];
			$agn=$arr["NOAGEN"];
			$i++;
		} ?>
		
		<tr bgcolor="#f5d79c">
			<td align="right" colspan="9"><b>SUB TOTAL<?=$cabas;?></b></td>
			<td align="right"><b><?=number_format($jmltotal,2,",",".");?></b></td>
			<td align="center"><? //echo "<input type='submit' name='check' value='Approve!'>";?></td>
			<td align="center"><? //echo "<input type='submit' name='check' value='Approve!'>";?></td>
		</tr>
		<tr bgcolor="#f5d79c">
			<td align="right" colspan="9"><b>TOTAL </b></td>
			<td align="right"><b><?=number_format($jmltotalall,2,",",".");?></b></td>
			<td align="center"></td><td align="center"></td>
		</tr>
		
		<?php
		if(!in_array($str, $exclude_list) && ($kantor!="KP") ) {
			echo "<tr>"."<td colspan='10'><blink>Proses Komisi Tidak Bisa bisa dilakukan pada hari ini karena sedang ada proses pembayaran dikantor pusat!! <br> Info Lebih Lanjut silahkan Hubungi Divisi ARC </blink></td>"."</tr>";
		} else { ?>	
			<tr>
				<td bgcolor="#FF9900" align="center" colspan="10"><? echo "<input type='submit' name='proses' value='PROSES!'>";?></td>
				<td bgcolor="#FF9900" align="right"><? echo "<input type='submit' name='check' value='Approve!'>";?></td>
				<td bgcolor="#FF9900" align="left"><? echo "<input type='submit' name='uncheck' value='UnApprove!'>";?></td>
			</tr>
		<?php } ?>
	</table>
	</form>
	
	<?php if($act=="print"){
		
	} else {
		echo "<hr size=1>";
		echo "<a href='../mnukeagenan.php'><font face='Verdana' size='2'>Menu Keagenan</font></a> | ";
		echo "<a href='./pendapatanagen.php'><font face='Verdana' size='2'>Remunerasi Agen</font></a> | ";
		echo "<a href='./daftar_rekap_komisi.php'><font face='Verdana' size='2'>Rekap Komisi</font></a> | ";
		//echo "<a href=# onclick=NewWindow('daftar_komisi_byagen.php?act=printx&tglcari=".$tglcari."&jamawal=".$jamawal."&menitawal=".$menitawal."&jamakhir=".$jamakhir."&menitakhir=".$menitakhir."','',1000,400,1)>Rekap per Agen</a>";
	} ?>
</body>
</html>