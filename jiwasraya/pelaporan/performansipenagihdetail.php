<? 
	include "../../includes/database.php";	
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/pertanggungan.php";
	$DB=new Database($userid, $passwd, $DBName);
  
	$awal = !empty($awal) ? "01$awal" : $awal;
	$akhir = !empty($akhir) ? date("t", strtotime(substr($akhir, -4).'-'.substr($akhir, 0, 2).'-01')).$akhir : $akhir;
	$jenis = $_GET['premi'] == 'TOTAL' ? "a.PREMITAGIHAN PREMI," : "CASE WHEN SUBSTR(KDKUITANSI, 1, 2) = '$premi' THEN a.PREMITAGIHAN ELSE 0 END PREMI, ";
	//$filterbs = $kdsetor == "BS" ? " AND (REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', '') LIKE '$kdsetor%' OR a.BUKTISETOR LIKE '%/%')" : "AND REGEXP_REPLACE(a.BUKTISETOR, '[[:space:]]*', '') LIKE '$kdsetor%'";
	$filterbs = $kdsetor == "BS" ? " AND (a.BUKTISETOR LIKE '%BS' OR a.BUKTISETOR LIKE '%/%') " : " AND a.BUKTISETOR LIKE '%$kdsetor%'";
	
	$sql = "SELECT a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN, a.BUKTISETOR, a.TGLBAYAR,
				$jenis
				(SELECT KURS 
					FROM $DBUser.TABEL_999_KURS 
					WHERE TGLKURSBERLAKU = 
						(SELECT MAX(TGLKURSBERLAKU) 
						FROM $DBUser.TABEL_999_KURS 
						WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA)
						AND KDVALUTA = a.KDVALUTA) KURS, b.INDEXAWAL, a.KDVALUTA, 'P' JENIS
			FROM $DBUser.TABEL_300_HISTORIS_PREMI a
			INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
				AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
			WHERE a.PREFIXPERTANGGUNGAN LIKE '%$prefix%' 
				AND a.TGLBAYAR BETWEEN TO_DATE('$awal', 'ddmmyyyy') AND LAST_DAY(TO_DATE('$akhir', 'ddmmyyyy'))
				AND (a.BUKTISETOR IS NOT NULL OR a.TGLBAYAR IS NOT NULL)
				$filterbs
				
			UNION ALL
			
			SELECT a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN, a.BUKTISETOR, a.TGLBAYAR,
				$jenis
				(SELECT KURS 
					FROM $DBUser.TABEL_999_KURS 
					WHERE TGLKURSBERLAKU = 
						(SELECT MAX(TGLKURSBERLAKU) 
						FROM $DBUser.TABEL_999_KURS 
						WHERE TGLKURSBERLAKU <= a.TGLBAYAR AND KDVALUTA = a.KDVALUTA)
						AND KDVALUTA = a.KDVALUTA) KURS, b.INDEXAWAL, a.KDVALUTA, 'R' JENIS
			FROM $DBUser.TABEL_300_HISTORIS_RIDER a
			INNER JOIN $DBUser.TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN
				AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN
			INNER JOIN $DBUser.TABEL_300_HISTORIS_PREMI c ON a.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
				AND a.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN AND a.TGLBOOKED = c.TGLBOOKED 
                AND (c.BUKTISETOR IS NOT NULL OR c.TGLBAYAR IS NOT NULL)    
			WHERE a.PREFIXPERTANGGUNGAN LIKE '%$prefix%' 
				AND a.TGLBAYAR BETWEEN TO_DATE('$awal', 'ddmmyyyy') AND LAST_DAY(TO_DATE('$akhir', 'ddmmyyyy'))
				AND (a.BUKTISETOR IS NOT NULL OR a.TGLBAYAR IS NOT NULL)
				$filterbs
			ORDER BY PREFIXPERTANGGUNGAN, NOPERTANGGUNGAN, BUKTISETOR, TGLBAYAR, JENIS";
	//echo $sql; die;
	
	if ($export) {
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=downloaddetailpenagih.xls");
		
		$DB->parse($sql);
		$DB->execute(); ?>
		
		<table border='1'>
			<tr>
				<td align='center' valign='middle'>NO</td>
				<td align='center' valign='middle'>NO POLIS</td>
				<td align='center' valign='middle'>PREMI NB</td>
				<td align='center' valign='middle'>KURS</td>
				<td align='center' valign='middle'>PREMI NB X KURS</td>
				<td align='center' valign='middle'>BUKTI SETOR</td>
				<td align='center' valign='middle'>TGL BAYAR</td>
			</tr>
			
			<? $i = 1;
			while ($arr = $DB->nextrow()) { 
				if ($arr['PREMI'] > 0) { ?>
					<tr>
						<td align='center' valign='middle'><?=$i?></td>
						<td valign='middle'><?="$arr[PREFIXPERTANGGUNGAN]-$arr[NOPERTANGGUNGAN].$arr[JENIS]"?></td>
						<td align='right'><?=number_format(($arr['KDVALUTA'] == 0 ? $arr["PREMI"] / $arr['INDEXAWAL'] : $arr['PREMI']), 2)?></td>
						<td align='right'><?=number_format($arr['KURS'], 2)?></td>
						<td align='right'><?=number_format($arr["PREMI"] * $arr['KURS'], 2)?></td>
						<td align='right'><?=$arr['BUKTISETOR']?></td>
						<td align='right'><?=$arr['TGLBAYAR']?></td>
					</tr>
					<? $i++;
					$totpremi += $arr['PREMI'];
					$totpremixkurs += $arr["PREMI"] * $arr['KURS'];
					$totpreminbob += $arr['PREMIBP']+$arr['PREMINB']+$arr['PREMIOB'];
				} 
			}?>
			
			<tr>
				<td colspan='2' align='center' valign='middle'>TOTAL</td>
				<td align='right'><?=number_format($totpremi, 2)?></td>
				<td align='right'></td>
				<td align='right'><?=number_format($totpremixkurs, 2)?></td>
				<td colspan='2' align='right'></td>
			</tr>
		</table>
		<?
	}
	else { ?>
		<link href="../jws.css" rel="stylesheet" type="text/css">
		<a class="verdana10blk" style="float:left;margin-right:10px;"><b>DETAIL PERFORMANSI PENAGIH KANTOR <? echo $kantor; ?> PREMI <?=$premi?> </b></a>
		<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
			<input type="submit" name="export" value="EXPORT">
		</form>
		
		<?
		$DB->parse($sql);
		$DB->execute();
		?>
		
		<hr size="1">
		
		<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
		<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#335F93" width="100%" id="AutoNumber1">
			<tr>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">NO.</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">NO. POLIS</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">PREMI <?=($premi == 'BP' ? 'BP3' : $premi)?></td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">KURS</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">PREMI <?=($premi == 'BP' ? 'BP3' : $premi)?> X KURS</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">BUKTI SETOR</td>
				<td align="center" class="verdana7blk" bgcolor="#A0B6E7">TGL BAYAR</td>
			</tr>
			
			<? 
			$i=1;
			while($arr=$DB->nextrow()) {
				if ($arr['PREMI'] > 0) {
					$premi = $arr['KDVALUTA'] == 0 ? $arr["PREMI"] / $arr['INDEXAWAL'] : $arr['PREMI'];
					$kurs = $arr['KURS'];
					$prefix = $arr["PREFIXPERTANGGUNGAN"];
					$nopenagih = $arr["NOPERTANGGUNGAN"];
					$jenis = $arr['JENIS'];
					$buktisetor = $arr['BUKTISETOR'];
					$tglbayar = $arr['TGLBAYAR']; ?>
					
					<tr>
						<td class="verdana7blk" align="center" bgcolor="#D1EAF8"><?=$i?></td>
						<td class="verdana7blk" align="center" bgcolor="#D1EAF8"><?="$prefix-$nopenagih.$jenis"?></td>
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?=number_format($premi,2)?></td>
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?=number_format($kurs,2)?></td>
						<td class="verdana7blk" align="right" bgcolor="#D1EAF8"><?=number_format($premi*$kurs,2)?></td>
						<td class="verdana7blk" align="center" bgcolor="#D1EAF8"><?=$buktisetor?></td>
						<td class="verdana7blk" align="center" bgcolor="#D1EAF8"><?=$tglbayar?></td>
					</tr>
					
					<? 
					$i++;
					$total += $premi;
					$totalpk += $premi * $kurs;
				}
			} ?>
			
			<tr>
				<td colspan="2" class="verdana7blk" align="center" bgcolor="#A0B6E7"><b>TOTAL</b></td>
				<td class="verdana7blk" align="right" bgcolor="#A0B6E7"><?=number_format($total,2)?></td>
				<td class="verdana7blk" align="center" bgcolor="#A0B6E7"></td>
				<td class="verdana7blk" align="right" bgcolor="#A0B6E7"><?=number_format($totalpk,2)?></td>
				<td colspan="2" class="verdana7blk" align="center" bgcolor="#A0B6E7"></td>
			</tr>
		</table>
<? } ?>


