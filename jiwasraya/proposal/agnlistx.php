<?php
	// modified by fendy 14/12/2018
	
	include "../../includes/session.php";
	include "../../includes/database.php";
	$DB=New database($userid, $passwd, $DBName);
	$DS = New database($DBUser, $DBPass, $DBName);
	
	$formname=(!$a) ? "ntryprop" : $a;
	$fieldname=(!$b) ? "noagen" : $b;
	$jmlhariexp = 14;
	$tahunberlaku = '2019';
	
	
	// Berlaku di halaman SPAJ - SURAT KONFIRMASI 
	// [SITUASIONAL] Agen yang ingin ditampilkan diluar kondisi yang ada saat ini hanya dalam 1 hari
	$listagen = date('dmY') == '19022019' ? "'0000070235'" : "null";
?>

<html>
<head>
	<title>Agen List</title>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<link href="../../includes/jws2005.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript">
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
		function gantiKantor(theForm) {
			var kdkantor=theForm.kdkantor.value;
			window.location.replace('agnlistx.php?a=<?=$a?>&fromjaim=<?=$fromjaim?>&kdkantor='+kdkantor+'#awaledit');
		}
		//-->
	</script>
</head>
<body>
	<form name="porm" method="get" action="<?echo $PHP_SELF;?>" onsubmit="return OnSumbit(document.porm)">
	<input type='hidden' name='a' value='<?=$a?>' />
	<input type='hidden' name='fromjaim' value='<?=$fromjaim?>' />
	<table width="100%" cellpadding="4" cellspacing="0" >
		<tr bgcolor="#f89aa4">
			<td>
				Nama Agen <font size=1>(min 3 karakter)</font>:
				<input type="text" name="nama" size="8" value="<?echo strtoupper($nama);?>">
				Rayon <select name='kdkantor' class='select2' onChange="gantiKantor(document.porm)">
				<?php
				$kdkantor = empty($kdkantor) ? $kantor : $kdkantor;
				$sql = "select kdkantor, namakantor
						from $DBUser.tabel_001_kantor 
						where kdjeniskantor='2' 
						order by kdkantor";
				//echo $sql;
				$DB->parse($sql);
				$DB->execute();
				while ($arr=$DB->nextrow()) {
					$selected = $kdkantor == $arr['KDKANTOR'] ? 'selected' : '';
					$class = $kdkantor == $arr['KDKANTOR'] ? 'sudah' : 'belum';
					
					echo "<option value='$arr[KDKANTOR]' class='$class' $selected>$arr[KDKANTOR] - ".substr($arr['NAMAKANTOR'],0,-14)." BO</option>";
				}
				?>
				</select>
				
				<!--<input type="submit" name="submit" value="Cari" class="buton"> di hide dulu-->
				<input type="hidden" name="a" value="<?echo $a;?>">
				<input type="hidden" name="b" value="<?echo $b;?>">
			</td>
		</tr>
	</table>
	
	<br>
	<?php
	if($kdkantor != $kantor) {
		echo "<font color='#5286c5'><img border='0' src='../img/warning.png' align='left' hspace='5' vspace='5'>Perhatian!<br>".
			"Agen dibawah bukan dari rayon Anda ($kantor). Silakan pilih dengan hati-hati, ".
			"yakinkan nomor dan nama agen pilihan Anda benar.<br><br></font>";
	}

	/*===== Jika data yang ingin ditampilkan bukan berasal dari jaim =====*/
	if (!$fromjaim) { ?>
		<b>Daftar Agen Kantor <?= $kdkantor; ?> (Status AKTIF)</b><br>
	<? } else {
		$sql = "SELECT TO_CHAR(sysdate - $jmlhariexp, 'dd/mm/yyyy') tglberlaku, TO_CHAR(sysdate, 'dd/mm/yyyy') tglskrg FROM DUAL";
		$DB->parse($sql);
		$DB->execute();
		$r=$DB->nextrow();
		echo "<b>Daftar Agen Kantor $kdkantor yang membuat proposal jaim mulai tanggal $r[TGLBERLAKU] s/d $r[TGLSKRG]</b><br>";
		echo "<span style='border:1px solid #FF0000;background-color:#FF0000;margin-bottom:6px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <font style='color:#FF0000;'>Masa berlaku PKAJ agen kurang dari 30 hari, pilih agen tidak dapat diproses, segera lakukan perpanjangan!</font><br>";
		echo "<span style='border:1px solid #FFF578;background-color:#FFF578;margin-bottom:6px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <font style='color:#000;'>No Lisensi kosong / Tanggal Lisensi telah berakhir, silahkan lakukan perpanjangan lisensi!</font><br>";
	}
	
	if (!$nama) {
		//$dannama = 'kampret';
	} elseif ($nama == 'ALL') {
		$dannama = '';
	} else { 
		$dannama = "and b.namaklien1 like '".strtoupper($nama)."%'"; 
	}
	$ad = ($o==1) ?  'desc' : 'asc';
	$f = (!$f) ? '2' : $f;
	$wherejaim = $fromjaim ? " AND noagen IN (
		SELECT noagen
        FROM jaim_201_prospek@JAIM a
        INNER JOIN jaim_300_hitung@JAIM b ON a.noprospek = b.no_prospek
        WHERE tgl_rekam + $jmlhariexp >= sysdate
            AND flag_spaj = '0'
        GROUP BY noagen
    ) " : null;
	
	$sql = "SELECT a.prefixagen, a.noagen, b.namaklien1, a.kdjabatanagen, a.kdpangkat, c.namaareaoffice, a.kdkantor, b.no_ponsel,
				(SELECT CASE WHEN FLOOR(ADD_MONTHS(MAX(tglpkajagen), 24) - sysdate) > 0 THEN FLOOR(ADD_MONTHS(MAX(tglpkajagen), 24) - sysdate) ELSE 0 END 
				 FROM $DBUser.tabel_400_pkaj_agen 
				 WHERE noagen = a.noagen
				) sisapkaj,
				CASE WHEN a.NOLISENSIAGEN IS NOT NULL AND a.TGLAKHIRLISENSI > sysdate THEN 1 ELSE 0 END lisensi /*===== ditambah oleh fendy 08072019 =====*/
			FROM $DBUser.tabel_400_agen a
			INNER JOIN $DBUser.tabel_100_klien b ON a.noagen = b.noklien
			LEFT OUTER JOIN $DBUser.tabel_410_area_office c ON a.kdkantor = c.kdkantor
				AND a.kdareaoffice = c.kdareaoffice
			WHERE a.kdstatusagen != '02'
				AND a.noagen IN ($listagen)
				/*AND (a.NOLISENSIAGEN IS NOT NULL AND a.TGLAKHIRLISENSI > sysdate)*/ /*====== ditambah oleh ruchi 04072019 ======*/

			UNION

			SELECT a.prefixagen, a.noagen, b.namaklien1, a.kdjabatanagen, a.kdpangkat, c.namaareaoffice, a.kdkantor, b.no_ponsel,
				(SELECT CASE WHEN FLOOR(ADD_MONTHS(MAX(tglpkajagen), 24) - sysdate) > 0 THEN FLOOR(ADD_MONTHS(MAX(tglpkajagen), 24) - sysdate) ELSE 0 END 
				 FROM $DBUser.tabel_400_pkaj_agen 
				 WHERE noagen = a.noagen
				) sisapkaj,
				CASE WHEN a.NOLISENSIAGEN IS NOT NULL AND a.TGLAKHIRLISENSI > sysdate THEN 1 ELSE 0 END lisensi /*===== ditambah oleh fendy 08072019 =====*/
			FROM $DBUser.tabel_400_agen a
			INNER JOIN $DBUser.tabel_100_klien b ON a.noagen = b.noklien
			LEFT OUTER JOIN $DBUser.tabel_410_area_office c ON a.kdkantor = c.kdkantor
				AND a.kdareaoffice = c.kdareaoffice
			WHERE a.kdstatusagen = '01'
				/*AND (a.NOLISENSIAGEN IS NOT NULL AND a.TGLAKHIRLISENSI > sysdate)*/ /*====== ditambah oleh ruchi 04072019 ======*/
				AND ((a.kdjabatanagen != '08' AND a.kdkantor = '$kdkantor') OR a.kdjabatanagen = '16') /*====== dirubah oleh dedi 14012016 ======*/
				$dannama
				$wherejaim
			ORDER BY $f $ad";
	//echo $sql;
	$DS->parse($sql);
	$DS->execute();
	?>
	
	<table border="0" width="100%" cellpadding="2" cellspacing="1" style="padding-top:4px;">
		<tr bgcolor="#f89aa4">
			<?php
			$o = (int)!((boolean)$o);
			echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=1&o=$o&kdkantor=$kdkantor\"><b>Nomor</b></a></td>" ;
			echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=2&o=$o&kdkantor=$kdkantor\"><b>Nama</b></a></td>" ;
			echo "<td align=\"center\"><b>Kode Kantor</b></td>";
			echo "<td align=\"center\"><b>Kode Jabatan</b></td>";
			echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=3&o=$o&kdkantor=$kdkantor\"><b>Area Office</b></a></td>";
			echo "<td align=\"center\"><a href=\"$PHP_SELF?a=$a&b=$b&nama=$nama&f=3&o=$o&kdkantor=$kdkantor\"><b>Handphone</b></a></td>";
			?>
		</tr>
		
		<?php
		$i=0;
		while($arr=$DS->nextrow()) {
			#----------------------------[ START NO HP ]----------------------------
			if(($arr["NO_PONSEL"])== '') {
				$nohp = "<font color=red><a href=\"#\" onclick=\"NewWindow('./updateponsel.php?noklien=".$arr["NOAGEN"]."','',800,500,1)\">UPDATE NO. HP</a></font>";  
				//echo 'kampret';
			} else {
				$nohp = $arr["NO_PONSEL"];
				//echo 'kampret ok';
			}
			#----------------------------[ END NO HP ]----------------------------
			
			if($arr["KDPANGKAT"]=="PN") $pn="<b><u>EX PENAGIH</u></b>";
			//include "../../includes/belang.php";
			echo "<tr bgcolor=".($arr['SISAPKAJ'] <= 30 ? "#FF0000" : ($arr['LISENSI'] == '0' ? "#FFF578" : ($i%2 ? "#d3d3d3" : "#97c8e1"))).">";
			if(substr($arr["NAMAAREAOFFICE"],0,31)=="UKA KHUSUS ANGGANA ANGGIH PRIMA") {
				if (($arr['SISAPKAJ'] > 30 || date('Y') == $tahunberlaku) && $arr['LISENSI'] == '1')
					echo "<td align=center><a href=\"#\" style='color:#12537E' onclick=\"javascript:window.opener.document.".$formname.".".$fieldname.".value='".$arr["NOAGEN"]."';window.opener.document.".$formname.".nikuseraap.value='".$arr["NOAGEN"]."';window.opener.document.".$formname.".useraap.value='".$arr["NAMAKLIEN1"]."';window.close();\" >".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</a></td>";
				else
					echo "<td align=center>$arr[NOAGEN]</td>";
				echo "<td>".$arr["NAMAKLIEN1"]." $pn</td>";
				echo "<td align=center>".$arr["KDKANTOR"]."</td>";
				echo "<td align=center>".$arr["KDJABATANAGEN"]."</td>";
				echo "<td>".$arr["NAMAAREAOFFICE"]."</td>";
				echo "<td>".$nohp."</td>";
			} else{
				if (($arr['SISAPKAJ'] > 30 || date('Y') == $tahunberlaku) && $arr['LISENSI'] == '1')
					//echo $arr["NOAGEN"];
					echo "<td align=center><a href=\"#\" onclick=\"javascript:window.opener.document.".$formname.".".$fieldname.".value='".$arr["NOAGEN"]."';window.close();\" >".$arr["PREFIXAGEN"]."-".$arr["NOAGEN"]."</a></td>";
				else
					echo "<td align=center>$arr[NOAGEN]</td>";
				echo "<td>".$arr["NAMAKLIEN1"]." $pn</td>";
				echo "<td align=center>".$arr["KDKANTOR"]."</td>";
				echo "<td align=center>".$arr["KDJABATANAGEN"]."</td>";
				echo "<td>".$arr["NAMAAREAOFFICE"]."</td>";
				echo "<td>".$nohp."</td>";
			}
			echo "</tr>";
			$pn="";
			$i++;
		}
		?>
	</table>

</body>
</html>