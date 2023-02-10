<? 
	include "../../includes/database.php";	
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/pertanggungan.php";
	$DB=new Database($userid, $passwd, $DBName);
	$vblnawal="0".$vblnawal;
	$vblnakhir="0".$vblnakhir;
	$awalbln = substr($vblnawal,-2);
	$akhirbln = substr($vblnakhir,-2);
	$awalperiode=$awalbln."".$vthn;
	$akhirperiode=$akhirbln."".$vthn;
	$awal = !empty($awalperiode) ? "01$awalperiode" : $awalperiode;
	$akhir = !empty($akhirperiode) ? date("t", strtotime("$vthn-$akhirbln-01")).$akhirperiode : $akhirperiode;
	$kantor = $kantor == "KP" ? null : $kantor;

	/*$sql 	 = "SELECT KODESETOR, BUKTISETOR, SUM(BP) PREMIBP, SUM(NB) PREMINB, SUM(OB) PREMIOB
				FROM ( 
					SELECT CASE WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 2) = 'BS' OR a.BUKTISETOR LIKE '%/%' THEN 'BS'
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'VBN' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 7) = 'MANDIRI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 7)
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 4, 7) = 'MANDIRI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 4, 7)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 6) = 'BNI CC' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 6)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BNI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BRI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 10) = 'BPD KALBAR' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 10)
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 9) = 'BPDKALBAR' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 9)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BTN' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3)
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BCN' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BMRI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BIMA' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BBNI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8)
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BBRI' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8)
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.PPOS' THEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8)
                        ELSE REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', '') END AS KODESETOR,
                        CASE WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 2) = 'BS' OR a.BUKTISETOR LIKE '%/%' THEN 'KASIR PERUSAHAAN' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'VBN' THEN 'VIRTUAL ACCOUNT BNI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 7) = 'MANDIRI' THEN 'AUTO DEBET MANDIRI' 
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 4, 7) = 'MANDIRI' THEN 'AUTO DEBET MANDIRI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 6) = 'BNI CC' THEN 'AUTO DEBET CREDIT CARD BNI'
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BNI' THEN 'AUTO DEBET BNI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BRI' THEN 'AUTO DEBET BRI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 10) = 'BPD KALBAR' THEN 'AUTO DEBET BPD KALBAR' 
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 9) = 'BPDKALBAR' THEN 'AUTO DEBET BPD KALBAR' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BTN' THEN 'AUTO DEBET BTN' 
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 3) = 'BCN' THEN 'BANK CIMB NIAGA' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BMRI' THEN 'H2H MANDIRI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BIMA' THEN 'H2H BIMASAKTI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BBNI' THEN 'H2H BNI' 
                        WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.BBRI' THEN 'H2H BRI' 
						WHEN SUBSTR(REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', ''), 1, 8) = 'H2H.PPOS' THEN 'H2H POS' 
                        ELSE REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', '') END AS BUKTISETOR, 
                        CASE WHEN SUBSTR(KDKUITANSI, 1, 2) = 'BP' 
                            THEN DECODE(a.KDVALUTA, 0, a.PREMITAGIHAN / b.INDEXAWAL, a.PREMITAGIHAN) * (SELECT KURS 
                                FROM $DBUser.TABEL_999_KURS 
                                WHERE TGLKURSBERLAKU = 
                                    (SELECT MAX(TGLKURSBERLAKU) 
                                    FROM $DBUser.TABEL_999_KURS 
                                    WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA) 
                                AND KDVALUTA = a.KDVALUTA) ELSE 0 
                        END BP,
                        CASE WHEN SUBSTR(KDKUITANSI, 1, 2) = 'NB' 
                            THEN 
                                (DECODE(a.KDVALUTA, 0, a.PREMITAGIHAN / b.INDEXAWAL, a.PREMITAGIHAN) * (SELECT KURS 
                                FROM $DBUser.TABEL_999_KURS 
                                WHERE TGLKURSBERLAKU = 
                                    (SELECT MAX(TGLKURSBERLAKU) 
                                    FROM $DBUser.TABEL_999_KURS 
                                    WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA) 
                                AND KDVALUTA = a.KDVALUTA))
                                +
                                (DECODE(c.KDVALUTA, 0, NVL(c.PREMITAGIHAN, 0) / b.INDEXAWAL, NVL(c.PREMITAGIHAN, 0)) * (SELECT KURS 
                                FROM $DBUser.TABEL_999_KURS 
                                WHERE TGLKURSBERLAKU = 
                                    (SELECT MAX(TGLKURSBERLAKU) 
                                    FROM $DBUser.TABEL_999_KURS 
                                    WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA) 
                                AND KDVALUTA = a.KDVALUTA))
                                ELSE 0 
                        END NB,
                        CASE WHEN SUBSTR(KDKUITANSI, 1, 2) = 'OB' 
                            THEN 
                                (DECODE(a.KDVALUTA, 0, a.PREMITAGIHAN / b.INDEXAWAL, a.PREMITAGIHAN) * (SELECT KURS 
                                FROM $DBUser.TABEL_999_KURS 
                                WHERE TGLKURSBERLAKU = 
                                    (SELECT MAX(TGLKURSBERLAKU) 
                                    FROM $DBUser.TABEL_999_KURS 
                                    WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA) 
                                AND KDVALUTA = a.KDVALUTA))
                                +
                                (DECODE(c.KDVALUTA, 0, NVL(c.PREMITAGIHAN, 0) / b.INDEXAWAL, NVL(c.PREMITAGIHAN, 0)) * (SELECT KURS 
                                FROM $DBUser.TABEL_999_KURS 
                                WHERE TGLKURSBERLAKU = 
                                    (SELECT MAX(TGLKURSBERLAKU) 
                                    FROM $DBUser.TABEL_999_KURS 
                                    WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA) 
                                AND KDVALUTA = a.KDVALUTA))
                                ELSE 0 
                        END OB
                    FROM $DBUser.TABEL_300_HISTORIS_PREMI a 
                    INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
                        AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
                    LEFT OUTER JOIN $DBUser.TABEL_300_HISTORIS_RIDER c ON a.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
                        AND a.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN AND a.TGLBOOKED = c.TGLBOOKED 
                        AND (c.BUKTISETOR IS NOT NULL OR c.TGLBAYAR IS NOT NULL)
                    WHERE a.PREFIXPERTANGGUNGAN LIKE '%$kantor%' 
                        AND a.TGLBAYAR BETWEEN TO_DATE('$awal', 'ddmmyyyy') AND LAST_DAY(TO_DATE('$akhir', 'ddmmyyyy'))
                        AND (a.BUKTISETOR IS NOT NULL OR a.TGLBAYAR IS NOT NULL) 
				) 
				GROUP BY KODESETOR, BUKTISETOR 
				ORDER BY BUKTISETOR DESC";*/
				
	$sql 	 = "SELECT KODESETOR, BUKTISETOR, SUM(BP) PREMIBP, SUM(NB) PREMINB, SUM(OB) PREMIOB
				FROM ( 
					SELECT 
						CASE WHEN a.BUKTISETOR LIKE 'BS%' THEN 'BS'
							WHEN a.BUKTISETOR LIKE '%/%' THEN 'BS'
							WHEN a.BUKTISETOR LIKE 'VBN%' THEN 'VBN'
							WHEN a.BUKTISETOR LIKE '%MANDIRI%' THEN 'MANDIRI'
							WHEN a.BUKTISETOR LIKE 'BNI CC%' THEN 'BNI CC'
							WHEN a.BUKTISETOR LIKE 'BNI%' THEN 'BNI'
							WHEN a.BUKTISETOR LIKE 'BRI%' THEN 'BRI'
							WHEN a.BUKTISETOR LIKE 'BPD KALBAR%' THEN 'BPD KALBAR'
							WHEN a.BUKTISETOR LIKE 'BPDKALBAR%' THEN 'BPD KALBAR'
							WHEN a.BUKTISETOR LIKE 'BTN%' THEN 'BTN'
							WHEN a.BUKTISETOR LIKE 'BCN%' THEN 'BCN'
							WHEN a.BUKTISETOR LIKE '%H2H.BMRI%' THEN 'H2H.BMRI'
							WHEN a.BUKTISETOR LIKE 'H2H.BIMA%' THEN 'H2H.BIMA'
							WHEN a.BUKTISETOR LIKE 'H2H.BBNI%' THEN 'H2H.BBNI'
							WHEN a.BUKTISETOR LIKE 'H2H.BBRI%' THEN 'H2H.BBRI'
							WHEN a.BUKTISETOR LIKE 'H2H.PPOS%' THEN 'H2H.PPOS'
							ELSE a.BUKTISETOR 
						END KODESETOR,
						CASE WHEN a.BUKTISETOR LIKE 'BS%' THEN 'KASIR PERUSAHAAN'
							WHEN a.BUKTISETOR LIKE '%/%' THEN 'KASIR PERUSAHAAN'
							WHEN a.BUKTISETOR LIKE 'VBN%' THEN 'VIRTUAL ACCOUNT BNI'
							WHEN a.BUKTISETOR LIKE '%MANDIRI%' THEN 'AUTO DEBET MANDIRI'
							WHEN a.BUKTISETOR LIKE 'BNI CC%' THEN 'AUTO DEBET CREDIT CARD BNI'
							WHEN a.BUKTISETOR LIKE 'BNI%' THEN 'AUTO DEBET BNI'
							WHEN a.BUKTISETOR LIKE 'BRI%' THEN 'AUTO DEBET BRI'
							WHEN a.BUKTISETOR LIKE 'BPD KALBAR%' THEN 'AUTO DEBET BPD KALBAR'
							WHEN a.BUKTISETOR LIKE 'BPDKALBAR%' THEN 'AUTO DEBET BPD KALBAR'
							WHEN a.BUKTISETOR LIKE 'BTN%' THEN 'AUTO DEBET BTN'
							WHEN a.BUKTISETOR LIKE 'BCN%' THEN 'BANK CIMB NIAGA'
							WHEN a.BUKTISETOR LIKE '%H2H.BMRI%' THEN 'H2H MANDIRI'
							WHEN a.BUKTISETOR LIKE 'H2H.BIMA%' THEN 'H2H BIMASAKTI'
							WHEN a.BUKTISETOR LIKE 'H2H.BBNI%' THEN 'H2H BNI'
							WHEN a.BUKTISETOR LIKE 'H2H.BBRI%' THEN 'H2H BRI'
							WHEN a.BUKTISETOR LIKE 'H2H.PPOS%' THEN 'H2H POS'
							ELSE a.BUKTISETOR 
						END BUKTISETOR, 
						CASE WHEN KDKUITANSI LIKE 'BP%' THEN 
							CASE WHEN a.KDVALUTA = 0 THEN a.PREMITAGIHAN / b.INDEXAWAL * d.KURS
								WHEN a.KDVALUTA = 3 THEN a.PREMITAGIHAN * d.KURS
								ELSE a.PREMITAGIHAN
							END
							ELSE 0
						END BP,
						CASE WHEN KDKUITANSI LIKE 'NB%' THEN
							CASE WHEN a.KDVALUTA = 0 THEN a.PREMITAGIHAN / b.INDEXAWAL * d.KURS
								WHEN a.KDVALUTA = 3 THEN a.PREMITAGIHAN * d.KURS
								ELSE a.PREMITAGIHAN
							END
							+
							CASE WHEN c.KDVALUTA = 0 THEN CASE WHEN c.PREMITAGIHAN IS NULL THEN 0 ELSE c.PREMITAGIHAN END / b.INDEXAWAL * d.KURS
								WHEN c.KDVALUTA = 3 THEN CASE WHEN c.PREMITAGIHAN IS NULL THEN 0 ELSE c.PREMITAGIHAN END * d.KURS
								ELSE CASE WHEN c.PREMITAGIHAN IS NULL THEN 0 ELSE c.PREMITAGIHAN END
							END
							ELSE 0 
						END NB,
						CASE WHEN KDKUITANSI LIKE 'OB%' THEN
							CASE WHEN a.KDVALUTA = 0 THEN a.PREMITAGIHAN / b.INDEXAWAL * d.KURS
								WHEN a.KDVALUTA = 3 THEN a.PREMITAGIHAN * d.KURS
								ELSE a.PREMITAGIHAN
							END
							+
							CASE WHEN c.KDVALUTA = 0 THEN CASE WHEN c.PREMITAGIHAN IS NULL THEN 0 ELSE c.PREMITAGIHAN END  / b.INDEXAWAL * d.KURS
								WHEN c.KDVALUTA = 3 THEN CASE WHEN c.PREMITAGIHAN IS NULL THEN 0 ELSE c.PREMITAGIHAN END * d.KURS
								ELSE CASE WHEN c.PREMITAGIHAN IS NULL THEN 0 ELSE c.PREMITAGIHAN END
							END
							ELSE 0
						END OB
                    FROM $DBUser.TABEL_300_HISTORIS_PREMI a 
                    INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
                        AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
                    LEFT OUTER JOIN $DBUser.TABEL_300_HISTORIS_RIDER c ON a.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
                        AND a.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN AND a.TGLBOOKED = c.TGLBOOKED 
                        AND (c.BUKTISETOR IS NOT NULL OR c.TGLBAYAR IS NOT NULL)
					LEFT OUTER JOIN $DBUser.TABEL_999_KURS d ON a.TGLBAYAR = d.TGLKURSBERLAKU AND a.KDVALUTA = d.KDVALUTA
                    WHERE a.PREFIXPERTANGGUNGAN LIKE '%$kantor%' 
                        AND a.TGLBAYAR BETWEEN TO_DATE('$awal', 'ddmmyyyy') AND LAST_DAY(TO_DATE('$akhir', 'ddmmyyyy'))
                        AND (a.BUKTISETOR IS NOT NULL OR a.TGLBAYAR IS NOT NULL) 
				) 
				GROUP BY KODESETOR, BUKTISETOR 
				ORDER BY BUKTISETOR DESC";
	
	//echo $sql;
	if ($export) {
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=downloadpenagih.xls");
		
		$DB->parse($sql);
		$DB->execute(); ?>
		
		<table border='1'>
			<tr>
				<td rowspan='2' align='center' valign='middle'>NO</td>
				<td rowspan='2' align='center' valign='middle'>JENIS PEMBAYARAN</td>
				<td colspan='4' align='center' valign='middle'>PREMI</td>
			</tr>
				<td align='center' valign='middle'>BP3</td>
				<td align='center' valign='middle'>NB</td>
				<td align='center' valign='middle'>OB</td>
				<td align='center' valign='middle'>TOTAL</td>
			</tr>
			
			<? $i = 1;
			while ($arr = $DB->nextrow()) { 
				if ($arr['PREMIBP'] > 0 || $arr['PREMINB'] > 0 || $arr['PREMIOB'] > 0) { ?>
					<tr>
						<td align='center' valign='middle'><?=$i?></td>
						<td valign='middle'><?=$arr['BUKTISETOR']?></td>
						<td align='right'><?=number_format($arr['PREMIBP'], 2)?></td>
						<td align='right'><?=number_format($arr['PREMINB'], 2)?></td>
						<td align='right'><?=number_format($arr['PREMIOB'], 2)?></td>
						<td align='right'><?=number_format($arr['PREMIBP']+$arr['PREMINB']+$arr['PREMIOB'], 2)?></td>
					</tr>
					<? $i++;
					$totpremibp += $arr['PREMIBP'];
					$totpreminb += $arr['PREMINB'];
					$totpremiob += $arr['PREMIOB'];
					$totpreminbob += $arr['PREMIBP']+$arr['PREMINB']+$arr['PREMIOB'];
				}
			} ?>
			
			<tr>
				<td colspan='2' align='center' valign='middle'>TOTAL</td>
				<td align='right'><?=number_format($totpremibp, 2)?></td>
				<td align='right'><?=number_format($totpreminb, 2)?></td>
				<td align='right'><?=number_format($totpremiob, 2)?></td>
				<td align='right'><?=number_format($totpreminbob, 2)?></td>
			</tr>
		</table>
	<? }
	else {
		
		function DateSelector($inName, $useDate=0) { 
			$monthName = array(1=> "Januari",  "Pebruari",  "Maret", "April",  "Mei",  "Juni",  "Juli",  "Agustus", "September",  "Oktober",  "Nopember",  "Desember");
			
			if($useDate == 0) {  
				$useDate = Time();
			} 
			
			print("<select name=" . $inName .  "blnawal>\n"); 
			for($currentMonth = 1; $currentMonth <= 12; $currentMonth++) { 
				print("<option value=\""); 
				print(intval($currentMonth)); 
				print("\""); 
				if(($currentMonth == $_POST['vblnawal'] && !empty($_POST['vblnawal'])) || (intval(date('m', $useDate)) == $currentMonth && empty($_POST['vblnawal']))) { 
					print(" selected"); 
				}
				print(">" . $monthName[$currentMonth] .  "\n"); 
			} 
			print("</select>");
			echo " S/D "; 
			print("<select name=" . $inName .  "blnakhir>\n"); 
			for($currentMonth = 1; $currentMonth <= 12; $currentMonth++) { 
				print("<option value=\""); 
				print(intval($currentMonth)); 
				print("\""); 
				if(($currentMonth == $_POST['vblnakhir'] && !empty($_POST['vblnakhir'])) || (intval(date('m', $useDate)) == $currentMonth && empty($_POST['vblnakhir']))) { 
					print(" selected"); 
				} 
				print(">" . $monthName[$currentMonth] .  "\n"); 
			} 
			print("</select>"); 
			
			print("<select name=" . $inName .  "thn>\n"); 
			$startYear = date( "Y", $useDate); 
			for($currentYear = $startYear - 10; $currentYear <= $startYear+5;$currentYear++) { 
				print("<option value=\"$currentYear\""); 
				if(($currentYear == $_POST['vthn'] && !empty($_POST['vthn'])) || (date( "Y", $useDate)==$currentYear && empty($_POST['vthn']))) { 
					print(" selected");
				} 
				print(">$currentYear\n"); 
			} 
			print("</select>"); 
		} 
		
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
		} ?>
		
		<link href="../jws.css" rel="stylesheet" type="text/css">
		<a class="verdana10blk"><b>PERFORMANSI PENAGIH KANTOR <? echo $kantor; ?> </b></a>
		
		<hr size="1">
		
		<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
			<table>
				<tr>  
					<td class="verdana10blk">Periode</td>
					<td class="verdana10blk"> <?  DateSelector("v"); ?>	</td>
					<td>
						<input type="submit" name="cariagen" value="CARI">
						<input type="submit" name="export" value="EXPORT">
					</td>
				</tr>
			</table>
		</form>
		
		<? if($cariagen){
			$DB->parse($sql);
			$DB->execute();
		?>
		
		<hr size="1">
		
		<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
		<a class="verdana10blk"><b>Periode <? echo $bln1 ?> s/d <? echo $bln2 ?> Tahun <? echo $vthn; ?></b></a>
		
		<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#335F93" width="100%" id="AutoNumber1">
			<tr>
				<td rowspan="2" align="center" class="verdana7blk" bgcolor="#A0B6E7">NO.</td>
				<td rowspan="2" align="center" class="verdana7blk" bgcolor="#A0B6E7">JENIS PEMBAYARAN</td>
				<td colspan="4" align="center" class="verdana7blk" bgcolor="#A0B6E7">PREMI</td>
			</tr>
			<tr>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">BP3</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">NB</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">OB</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">TOTAL</td>
			</tr>
			
			<? 
			$i=1;
			while($arr=$DB->nextrow()) {
				if ($arr['PREMIBP'] > 0 || $arr['PREMINB'] > 0 || $arr['PREMIOB'] > 0) {
					$kdsetor = $arr['KODESETOR'];
					$jenispembayaran = $arr["BUKTISETOR"];
					$premibp = $arr["PREMIBP"];
					$preminb = $arr["PREMINB"];
					$premiob = $arr["PREMIOB"];
					$jua = $arr["JUA"];
					$preminbob = $premibp + $preminb + $premiob; ?>
					
					<tr>
						<td class="verdana7blk" align="center" bgcolor="#D1EAF8"><? echo $i; ?></td>
						<td class="verdana7blk" bgcolor="#D1EAF8"><?="$jenispembayaran"?></td>
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?="<a href='#' onclick=\"NewWindow('performansipenagihdetail.php?prefix=$kantor&nopenagih=$nopenagih&awal=$awalperiode&akhir=$akhirperiode&kdsetor=$kdsetor&premi=BP','popuptebus','760','400','yes');return false\">".number_format($premibp,2)."</a>"?></td>
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?="<a href='#' onclick=\"NewWindow('performansipenagihdetail.php?prefix=$kantor&nopenagih=$nopenagih&awal=$awalperiode&akhir=$akhirperiode&kdsetor=$kdsetor&premi=NB','popuptebus','760','400','yes');return false\">".number_format($preminb,2)."</a>"?></td>
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?="<a href='#' onclick=\"NewWindow('performansipenagihdetail.php?prefix=$kantor&nopenagih=$nopenagih&awal=$awalperiode&akhir=$akhirperiode&kdsetor=$kdsetor&premi=OB','popuptebus','760','400','yes');return false\">".number_format($premiob,2)."</a>"?></td>  
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?="<a href='#' onclick=\"NewWindow('performansipenagihdetail.php?prefix=$kantor&nopenagih=$nopenagih&awal=$awalperiode&akhir=$akhirperiode&kdsetor=$kdsetor&premi=TOTAL','popuptebus','760','400','yes');return false\">".number_format($preminbob,2)."</a>"?></td>
					</tr>
					<? 
					
					$totpremibp += $premibp;
					$totpreminb += $preminb;
					$totpremiob += $premiob;
					$totpreminbob += $preminbob;
					$i++;
				}
			} ?>
			
			<tr>
				<td colspan="2" align="center" class="verdana7blk" bgcolor="#A0B6E7">TOTAL</td>
				<td align="right" class="verdana7blk" bgcolor="#A0B6E7"><?=number_format($totpremibp, 2)?></td>
				<td align="right" class="verdana7blk" bgcolor="#A0B6E7"><?=number_format($totpreminb, 2)?></td>
				<td align="right" class="verdana7blk" bgcolor="#A0B6E7"><?=number_format($totpremiob, 2)?></td>
				<td align="right" class="verdana7blk" bgcolor="#A0B6E7"><?=number_format($totpreminbob, 2)?></td>
			</tr>
		</table>
		
	<? } else {} ?>
	
	<hr size="1">
	
	<a class="verdana10blk" href="../mnupenagihan">Menu Penagihan</a>
<?php } ?>