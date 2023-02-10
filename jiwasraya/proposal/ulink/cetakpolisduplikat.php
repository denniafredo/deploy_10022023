<?php	
	include "../../includes/database.php";
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "./includes/monthselector.php";

	$DB=New database($userid, $passwd, $DBName);
	$sql = "SELECT TO_CHAR(SYSDATE, 'mm') BLN, TO_CHAR(SYSDATE, 'yyyy') THN FROM DUAL";
	$DB->parse($sql);
	$DB->execute();
	$row = $DB->nextrow();
	switch($row['BLN']) {
		case 1: $bln = 'Januari'; break;
		case 2: $bln = 'Februari'; break;
		case 3: $bln = 'Maret'; break;
		case 4: $bln = 'April'; break;
		case 5: $bln = 'Mei'; break;
		case 6: $bln = 'Juni'; break;
		case 7: $bln = 'Juli'; break;
		case 8: $bln = 'Agustus'; break;
		case 9: $bln = 'September'; break;
		case 10: $bln = 'Oktober'; break;
		case 11: $bln = 'November'; break;
		case 12: $bln = 'Desember'; break;
	}

	function sorturl($host, $kamp, $sort) {
		return "<a href='http://$host/$kamp/proposal/ulink/cetakpolisduplikat.php?t=$_GET[t]&p=$_GET[p]&q=$_GET[q]&r=$sort'>
			<img src='sort.png' width='12' style='solid #000; margin-bottom: -3px;' />
		</a>";
	}
?>

<link href="../jws.css" rel="stylesheet" type="text/css" xmlns="http://www.w3.org/1999/html">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<style type="text/css">
	table tr.detail td {
		font-family:verdana;
		font-size: 9px;
	}
	table tr.odd {
		background-color: #fff;
	}
</style>

<a class="verdana10blk\"><b>DAFTAR PROSES POLIS DUPLIKAT <?echo $kantor;?></b></a>
<hr size=1>

<?php
	$i = 1;
	$filtertahun = empty($_GET['t']) ? "AND TO_CHAR(c.tglmutasi, 'yyyy') = TO_CHAR(sysdate, 'yyyy')" : ($_GET['t'] != 'all' ? "AND TO_CHAR(c.tglmutasi, 'yyyy') = '$_GET[t]'" : "AND c.tglmutasi BETWEEN TO_DATE('01/01/2011','dd/mm/yyyy') AND TRUNC(sysdate)");
	$filterrayon = $kantor == 'KP' ? null : "AND KDRAYONPENAGIH = '$kantor'";
	$filterp = empty($_GET['p']) ? null : " AND LOWER($_GET[p]) LIKE '%".strtolower($_GET['q'])."%'";
	$orderby = empty($_GET['r']) ? null : "ORDER BY $_GET[r] DESC NULLS LAST";

	$sql = "SELECT a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN, a.KDPRODUK, a.KDSTATUSMEDICAL,
				a.KDSTATUSEMAIL, a.NOPOL, TO_CHAR(c.TGLMUTASI, 'dd/mm/yyyy') TGLPENGAJUAN,
				TO_CHAR(e.TGLMUTASI, 'dd/mm/yyyy') TGLPENGAJUANWIL,
				b.NAMAKLIEN1, b.GELAR, a.USERUPDATED, a.PREMI1, a.JUAMAINPRODUK,
				TO_CHAR(a.TGLUPDATED, 'dd/mm/yyyy') TGLUPDATED,
				TO_CHAR(a.MULAS, 'dd/mm/yyyy') MULAS,
				(SELECT TO_CHAR(MIN(TGLMUTASI), 'dd/mm/yyyy')
				 FROM $DBUser.TABEL_600_HISTORIS_MUTASI_PERT
				 WHERE KDMUTASI = 28
					AND PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
					AND NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
					AND substr(keteranganmutasi, -10) = to_char(c.tglmutasi, 'dd/mm/yyyy')) TGLCETAK,
				TO_CHAR(a.TGLCETAK, 'dd/mm/yyyy') TGLCETAK2, d.KDRAYONPENAGIH,
				(SELECT MIN(TGLMUTASI)
				 FROM $DBUser.TABEL_600_HISTORIS_MUTASI_PERT
				 WHERE KDMUTASI = 28
					AND PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
					AND NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
					AND substr(keteranganmutasi, -10) = to_char(c.tglmutasi, 'dd/mm/yyyy')) TGLCETAK_
			FROM $DBUser.TABEL_200_PERTANGGUNGAN a
			LEFT OUTER JOIN $DBUser.TABEL_100_KLIEN b ON a.NOTERTANGGUNG = b.NOKLIEN
			INNER JOIN $DBUser.TABEL_603_MUTASI_PERT c ON a.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
				AND a.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
			INNER JOIN $DBUser.TABEL_500_PENAGIH d ON a.NOPENAGIH = d.NOPENAGIH
			LEFT OUTER JOIN $DBUser.TABEL_600_HISTORIS_MUTASI_PERT e ON a.PREFIXPERTANGGUNGAN = e.PREFIXPERTANGGUNGAN
                AND a.NOPERTANGGUNGAN = e.NOPERTANGGUNGAN AND TO_CHAR(c.tglmutasi, 'dd/mm/yyyy hh24:mi:ss') = SUBSTR(e.keteranganmutasi, -19)
                AND e.KDMUTASI = '41'
			WHERE NOTERTANGGUNG IS NOT NULL
				$filtertahun
				$filterrayon
				$filterp
				AND c.KDMUTASI = 41
			$orderby";
//echo $sql;
	$DB->parse($sql);
	$DB->execute();
?>

<div style="width:100%;text-align:center;color:#003399;font-family:verdana;font-size:13px;font-weight:bold;margin-bottom:8px;">
Daftar Pengajuan Polis Duplikat Kantor Pusat
<!--Daftar Proposal Kantor <?=$kantor?> Periode <?="$bln $row[THN]"?>-->
</div>

<table style="border-collapse:collapse;" border="0" width=100% cellpadding=2 cellspacing=0>
	<tr>
		<td width="100">Pencarian</td>
		<td>
			<form name="sendmail" action="<?=$PHP_SELF?>" method="get" style="margin:0px;padding:0px;">
				:&nbsp;
				<select name="t">
					<option value="all" <?=$_GET['t'] == 'all' ? 'selected' : ''?>>-- Semua --</option>
					<?php
						for ($i=date('Y');2011<=$i;$i--) {
							$selected = $i == $_GET['t'] || (empty($_GET['t']) && $i == date('Y')) ? 'selected' : '';
							echo "<option value='$i' $selected>$i</option>";
						}
					?>
				</select>
				<select name="p">
					<option value="">-- Silahkan Pilih --</option>
					<option value="a.nopol" <?=$_GET['p']=='a.nopol'?'selected':null?>>Nopol</option>
					<option value="a.prefixpertanggungan||a.nopertanggungan" <?=$_GET['p']=='a.prefixpertanggungan||a.nopertanggungan'?'selected':null?>>Nomor</option>
					<option value="b.namaklien1" <?=$_GET['p']=='b.namaklien1'?'selected':null?>>Tertanggung</option>
					<option value="a.kdproduk" <?=$_GET['p']=='a.kdproduk'?'selected':null?>>Produk</option>
				</select>
				<input type="text" name="q" value="<?=$_GET['q']?>" autocomplete="off" placeholder="Data yang ingin dicari" />
				<input type="submit" value="Cari">
				<input type="button" onclick="location.href='http://<?="$HTTP_HOST/$KAMP"?>/proposal/ulink/cetakpolisduplikat.php'" value="Reset"></button>
			</form>
		</td>
	</tr>
</table>

<br>
			
<table style="border-collapse:collapse;" border="1" width=100% class=tblisi cellpadding=2 cellspacing=0>
	<tr class='hijao'>
		<td align=center>No</td>
		<td align=center>Nomor <?=sorturl($HTTP_HOST, $KAMP, 'a.prefixpertanggungan desc nulls last,a.nopertanggungan')?></td>
		<td align=center>Tertanggung <?=sorturl($HTTP_HOST, $KAMP, 'b.namaklien1')?></td>
		<td align=center>Nopol <?=sorturl($HTTP_HOST, $KAMP, 'a.nopol')?></td>
		<td align=center>Produk <?=sorturl($HTTP_HOST, $KAMP, 'a.kdproduk')?></td>
		<td align=center>M</td>
		<td align=center>J U A <?=sorturl($HTTP_HOST, $KAMP, 'a.juamainproduk')?></td>
		<td align=center>Mulas <?=sorturl($HTTP_HOST, $KAMP, 'a.mulas')?></td>
		<td align=center>Premi <?=sorturl($HTTP_HOST, $KAMP, 'a.premi1')?></td>
		<td align=center>Tgl Ajuan KC <?=sorturl($HTTP_HOST, $KAMP, 'c.tglmutasi')?></td>
		<td align=center>Tgl Kirim KW <?=sorturl($HTTP_HOST, $KAMP, 'e.tglmutasi')?></td>
		<td align=center>Tgl Cetak Dup <?=sorturl($HTTP_HOST, $KAMP, 'tglcetak_')?></td>
		<td align=center>Cetak</td>
	</tr>
	<?php 
	$i = 1;
	while ($arr=$DB->nextrow()) { $odd = $i%2==0? ' odd' : ''; ?>
		<tr class='detail<?=$odd?>'>
			<td align='center'><?=$i?></td>
			<td align=center>
				<a href="#" onclick="window.open('../../polis/polis.php?j=1&noper=<?="$arr[NOPERTANGGUNGAN]&prefix=$arr[PREFIXPERTANGGUNGAN]"?>','targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600');return false;">
					<?="$arr[PREFIXPERTANGGUNGAN]$arr[NOPERTANGGUNGAN]"?>
				</a>
			</td>
			<td><?=$arr["NAMAKLIEN1"]?></td>
			<td><?=$arr["NOPOL"]?></td>
			<td align=center><?=$arr["KDPRODUK"]?></td>
			<td align=center><?=$arr["KDSTATUSMEDICAL"]?></td>
			<td align=right><?=number_format($arr["JUAMAINPRODUK"],2,',','.')?></td>
			<td align=center><?=$arr["MULAS"]?></td>
			<td align=right><?=number_format($arr["PREMI1"],2,',','.')?></td>
			<td align=center><?=$arr["TGLPENGAJUAN"]?></td>
			<td align=center><?=$arr["TGLPENGAJUANWIL"]?></td>
			<td align=center><?=$arr["TGLCETAK"]?></td>
			<td align=center>
				<?php 
				if (empty($arr['TGLCETAK2'])) {
					echo "<a href='test.cetak.polis.duplikat_.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."'\">CETAK</a>";
				}
				else {
					echo $arr["TGLCETAK2"];
				}
				echo "&nbsp;<a href='test.cetak.polis.duplikat_bu.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."'\">TINJAU</a>";
				?>
			</td>
		</tr>
	<?php $i++; } ?>
</table>

<hr size=1>
<a class=verdana10blk href="../../submenu.php?mnuinduk=B01">Menu Admin Kantor Pusat</a>