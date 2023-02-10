<?  
    include "../../includes/database.php";  
	include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";

 	$DB=new Database($userid, $passwd, $DBName);	
	
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	
	<a class="verdana10blk\"><b>Pembayaran Klaim Parsial Cicilan</b></a><br />
	
	<hr size=1>
	
	<div align=center>
		<font color=\"003399\" face=verdana size=2><b>Daftar Polis Pembayaran Parsial Cicil</b></font><br>
		<table style=\"border-collapse:collapse;\" border=\"1\" width=100% class=tblisi cellpadding=2 cellspacing=0>
			<tr class=hijao>
				<td align=center>No</td>
				<td align=center>Kode Sip</td>
				<td align=center>No Polis</td>
				<td align=center>Tgl Proses HO</td>
				<td align=center>Klaim</td>
				<td align=center>Nilai Manfaat</td>
				<td align=center>Nilai Dicicil</td>
				<td align=center>Nilai Sisa</td>
				<td align=center>A.N</td>
				<td align=center>Bank</td>
				<td align=center>Cabang</td>
				<td align=center>No Rekening</td>
			</tr>
			<?php
			$sql = "SELECT a.kdmsip_orig kdmsip, b.prefixpertanggungan, b.nopertanggungan, b.kdsip, c.nilai, SUM(b.jumlah) bayar, 
						c.jumlah sisa, c.penerimasip, c.namabank, c.cabankbank, c.norekeningbank, TO_DATE(SUBSTR(a.kduniqgrup, 3, 8), 'yyyymmdd') tglprosesho,
						a.kduniqgrup
					FROM tabel_802_sip_installment@esip a
					INNER JOIN tabel_802_lampiran_sip_klaim@esip b ON a.kdmsip_installment = b.kdmsip
						AND b.rekening1 = '200000'
					INNER JOIN tabel_802_lampiran_sip_klaim@esip c ON a.kdmsip_orig = c.kdmsip
						AND b.rekening1 = c.rekening1
						AND a.kduniqgrup = c.kduniqgrup
					GROUP BY a.kdmsip_orig, b.prefixpertanggungan, b.nopertanggungan, b.kdsip, c.nilai, c.jumlah, c.penerimasip, 
						c.namabank, c.cabankbank, c.norekeningbank, a.kduniqgrup";
			$DB->parse($sql);
			$DB->execute();
			$i = 0;
			while ($arr=$DB->nextrow()) { ?>
			
				<tr bgcolor="<?=($i%2?"#ffffff":"#d5e7fd")?>">
					<td class="verdana8" align="center"><?=$i+1?></td>
					<td class="verdana8" align="left"><a href="javascript:void(0);" onclick="NewWindow('http://efinance.jiwasraya.co.id:8003/historis-bayar-cicilan.php?id=<?=$arr['KDMSIP']?>&id2=<?=$arr['KDUNIQGRUP']?>','',700,400,1)"><?=$arr['KDMSIP']?></a></td>
					<td class="verdana8" align="center"><?="$arr[PREFIXPERTANGGUNGAN]-$arr[NOPERTANGGUNGAN]"?></td>
					<td class="verdana8" align="center"><?=$arr['TGLPROSESHO']?></td>
					<td class="verdana8" align="center"><?=$arr['KDSIP']?></td>
					<td class="verdana8" align="right"><?=number_format($arr['NILAI'], 0, ',', '.')?></td>
					<td class="verdana8" align="right"><?=number_format($arr['BAYAR'], 0, ',', '.')?></td>
					<td class="verdana8" align="right"><?=number_format($arr['SISA'], 0, ',', '.')?></td>
					<td class="verdana8" align="left"><?=$arr['PENERIMASIP']?></td>
					<td class="verdana8" align="left"><?=$arr['NAMABANK']?></td>
					<td class="verdana8" align="left"><?=$arr['CABANKBANK']?></td>
					<td class="verdana8" align="left"><?=$arr['NOREKENINGBANK']?></td>
				</tr>
				
				<?php $i++;
			}
			?>
		</table>
	</div>