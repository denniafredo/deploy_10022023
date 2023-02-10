<?php
	include "./includes/session.php";
	include "./includes/database.php";
  
	$DB=New database($userid, $passwd, $DBName);
		
	$formname=(!$a) ? "ntryprop" : $a;	
	$fieldname=(!$b) ? "nosp" : $b;	
?>	
<html><title>SPAJ List</title>
	<link type="text/css" rel="stylesheet" href="./includes/jws2005.css">
	<script type="text/javascript" language="javascript" src="./includes/highlight.js"></script>
	<script type="text/javascript" language="javascript">
	<!--
	function OnSumbit(theForm) {
		var a = theForm.nama.value;
		if (a.length < 3) {
			if (confirm('Masukkan 3 Hurup Pertama Yang Ingin Dicari\nKlik OK Untuk Semuanya')) {
				theForm.nama.value='ALL';
				return true;
			} else {
				theForm.nama.focus();
				return false;
			}
		} else {
			return true;
		}
	}
	//-->
	</script>
	<body>
		<form name="porm" method="post" action="<?echo $PHP_SELF;?>" onsubmit="return OnSumbit(document.porm)">
		<table width="100%" cellpadding="4" cellspacing="0" >
		<tr bgcolor="#f89aa4">
			<td>
				Nama Agen <font size=1>(min 3 karakter)</font>: &nbsp;
				<input type="text" name="nama" size="8" value="<?echo strtoupper($nama);?>">
				<?php if($kdkantor==""){$kdkantor=$kantor;}
				$sqa="select kdkantor, namakantor from $DBUser.tabel_001_kantor where status='1' order by kdkantor";
				$DB->parse($sqa);
				$DB->execute();	
				
				echo "Rayon <select name='kdkantor' class='select2'>";
				while ($arr=$DB->nextrow()) {
					if($kdkantor==$arr["KDKANTOR"]) {
						$pilih = "selected";
					} else {
						$pilih = "";
					}
					
					if($arr["KDKANTOR"]==$kantor) {
						$kls = "class=sudah";
					} else {
						$kls = "class=belum";
					}
					echo "<option value=".$arr["KDKANTOR"]." $pilih $kls>".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
				}
				echo "</select>"; ?>
				
				<!--<input type="submit" name="submit" value="Cari" class="buton"> di hide dulu-->
				<input type="hidden" name="a" value="<?echo $a;?>">
				<input type="hidden" name="b" value="<?echo $b;?>">
			</td>
		</tr>
		</table>
	
		<br>
		
		<? if($kdkantor!=$kantor) {
			echo "<font color=#5286c5><img border=0 src=./img/warning.png align=left hspace=5 vspace=5>Perhatian!<br>".
				 "Agen dibawah bukan dari rayon Anda ($kantor). Silakan pilih dengan hati-hati, ".
				 "yakinkan nomor dan nama agen pilihan Anda benar.<br><br></font>";
		} ?>
		
		<b>Daftar Agen Kantor <?=$kdkantor;?> (Status AKTIF)</b><br>
		<? if (!$nama) {
			//$dannama = 'kampret';
		} elseif ($nama=='ALL') {
			$dannama = '';
			$dannama2 = '';
		} else { 
			$dannama = "and UPPER(namapempol) like '%".strtoupper($nama)."%'"; 
			$dannama2 = "AND UPPER(c.namaklien1) like '%".strtoupper($nama)."%'";
		}
		$ad = ($o==1) ?  'desc' : 'asc';
		$f = (!$f) ? '2' : $f;
		
		// Query SPAJOL
		$sql2= "UNION ALL 
				SELECT a.nospaj, a.buildid, TO_CHAR(a.tanggalrekam, 'dd/mm/yyyy'), a.kodeagen, 
				CASE WHEN SUBSTR(f.jenisasuransi, '0', '2') != 'JL' THEN c.namaklien1 ELSE c.namaklien1 || ' (LINK)' END, 
					TO_CHAR(a.tanggalrekam, 'dd-MON-yyyy'), '1', a.tanggalrekam, 1 spajol
				FROM $DBUser.tabel_spaj_online a
				LEFT OUTER JOIN $DBUser.tabel_spaj_online_relasi b ON a.nospaj = b.nospaj
					/*AND b.statusklien IN (2, 3)*/
					AND b.relasi = '04'
				LEFT OUTER JOIN $DBUser.tabel_spaj_online_klien c ON b.noklien = c.noklien
				LEFT OUTER JOIN $DBUser.tabel_400_agen d ON a.kodeagen = d.noagen
				LEFT OUTER JOIN $DBUser.tabel_100_klien e ON a.kodeagen = e.noklien
				LEFT OUTER JOIN $DBUser.tabel_spaj_online_produksi f ON a.nospaj = f.nospaj
				WHERE d.kdkantor = '$kdkantor'
					$dannama2
					AND a.status = '2'
					AND a.tanggalrekam BETWEEN TO_DATE('0101'||TO_CHAR(ADD_MONTHS(sysdate,-12),'yyyy')||' 000000', 'ddmmyyyy hh24miss') AND TO_DATE('3112'||TO_CHAR(sysdate,'yyyy')||' 235959', 'ddmmyyyy hh24miss')";
	
		$sql = "SELECT nosp, null buildid, TO_CHAR(tglsp, 'dd-MON-yyyy') tglsp, noagen, namapempol, TO_CHAR(tglrekam, 'dd-MON-yyyy') tglrekam, 
					dokumenlengkap, tglrekam tglorder, 0 spajol
				FROM $DBUser.tabel_ul_spaj_temp a
				WHERE kdkantor = '".$kdkantor."' 
					AND (cif IS NULL OR cif <> 'SPAJOL')
					AND tglrekam BETWEEN TO_DATE('0101'||TO_CHAR(ADD_MONTHS(sysdate,-12),'yyyy'), 'ddmmyyyy') AND  TO_DATE ('01/01/2021', 'dd/mm/yyyy') 
				$dannama
				$sql2
				order by tglorder DESC NULLS LAST";

		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		?>
		<table border="0" width="100%" cellpadding="2" cellspacing="1">
		<tr bgcolor="#f89aa4">
			<?
			$o = (int)!((boolean)$o);
		
			//echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o&kdkantor=$kdkantor\"><b>Nomor</b></a></td>" ;
			echo "<td align=\"center\"><b>No. ESPAJ</b></td>";
			echo "<td align=\"center\"><b>Build ID</b></td>";
			echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o&kdkantor=$kdkantor\"><b>Nama</b></a></td>" ;
			
			echo "<td align=\"center\"><b>No. Agen</b></td>";
				//echo "<td align=\"center\"><b>Kode Jabatan</b></td>";
				//echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=3&o=$o&kdkantor=$kdkantor\"><b>Area Office</b></a></td>";
			echo "<td align='center'><b>Dokumen</b></td>";
			echo "<td align='center'><b>Tgl Entry</b></td>";
			?>
		</tr>
		<?
		$i=0;
	
		while($arr=$DB->nextrow()) {
			if($arr["KDPANGKAT"]=="PN") $pn="<b><u>EX PENAGIH</u></b>";
			//include "./includes/belang.php"; 
			echo "<tr bgcolor=".($i%2 ? "#d3d3d3" : "#97c8e1").">";
			if($arr["TALTUP"]=="0"){
				$taltup="javascript:window.opener.document.".$formname.".taltup.checked.value='0'";
				//$taltupc="window.opener.document.getElementById('taltupn').checked=true";
				$taltupc="window.opener.document.getElementById('taltup').checked=false";
			} else {
				$taltup="javascript:window.opener.document.".$formname.".taltup.checked.value='1'";
				//$taltupc="window.opener.document.getElementById('taltupy').checked=true";
				$taltupc="window.opener.document.getElementById('taltup').checked=true";
			}
			if ($arr['DOKUMENLENGKAP'] == '0') { // Jika dokumen lengkap
				$a = "<td align='center'>$arr[NOSP]</td>";
			} else if ($arr['SPAJOL'] == '0') { // Jika sumber dari entrian spaj konvensional
				$a = "<td align=center>
					<a href=\"#\" onclick=\"javascript:window.opener.document.".$formname.".nosp.value='".$arr["NOSP"]."';javascript:window.opener.document.".$formname.".noagen.value='".$arr["NOAGEN"]."';javascript:window.opener.document.".$formname.".taltup.value='".$arr["TALTUP"]."';".$taltupc.";window.close();\" >".$arr["NOSP"]."</a>
					</td>";
			} else if ($arr['SPAJOL']) { // Jika sumber dari SPAJOL
				$a = "<td align='center'>
					<a href='javascript:void(0);' onclick=\"javascript:window.opener.document.".$formname.".nosp.value='".$arr["NOSP"]."';javascript:window.opener.document.".$formname.".noagen.value='".$arr["NOAGEN"]."';javascript:window.opener.getdataespaj('$arr[NOSP]');window.close();\">$arr[NOSP]</a>
					</td>";
			}

			$a .= "<td align=center>".$arr["BUILDID"]."</td>".
				"<td align=left>".$arr["NAMAPEMPOL"]."</td>".
			// "<td>".$arr["NAMAPEMPOL"]." $pn</td>".
			"<td align=center>".$arr["NOAGEN"]."</td>";
			// "<td align=center>".$arr["KDJABATANAGEN"]."</td>".
			//	"<td>".$arr["NAMAAREAOFFICE"]."</td>".
			
			if ($arr['DOKUMENLENGKAP'] == '0') {
				$a .= "<td align='center' style='color:red;'><b>Tidak Lengkap</b></td>";
			} else {
				$a .= "<td align='center'>Lengkap</td>";
			}
			
			$a .= "<td nowrap>$arr[TGLREKAM]</td>
			</tr>";
			
			echo($a);
			
			$pn="";
			$i++;
		}?>
		</table>

	</body>
</html>