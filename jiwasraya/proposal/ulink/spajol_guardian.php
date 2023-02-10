<?php
	include "./includes/session.php";
	include "./includes/database.php";
	
	$DB=New database($userid, $passwd, $DBName);
	
	$formname=(!$a) ? "ntryprop" : $a;
	
	
	$sql = "SELECT kdkantor, namakantor FROM $DBUser.tabel_001_kantor WHERE kdjeniskantor='2' AND kdkantor = '$kantor' ORDER BY kdkantor";
	$DB->parse($sql);
	$DB->execute();
	$arrkantor = $DB->nextrow();
	
	$sql = "SELECT a.nospaj, b.namaklien1, c.prefixagen, c.noagen, d.namaklien1 namaagen
			FROM tabel_spaj_online@SPAJOL a
			INNER JOIN tabel_klien_spaj_online@SPAJOL b ON a.nospaj = b.nospaj
				AND b.statusklien IN (2,3)
			LEFT OUTER JOIN $DBUser.tabel_400_agen c ON a.kodeagen = c.noagen
			LEFT OUTER JOIN $DBUser.tabel_100_klien d ON a.kodeagen = d.noklien
			WHERE --c.kdkantor = '$kantor' AND
				LOWER(b.namaklien1) LIKE LOWER('%$nama%')
				AND a.nospaj NOT IN (SELECT nosp FROM $DBUser.tabel_200_pertanggungan WHERE SUBSTR(nosp, 0, 2) = 'ON')
			ORDER BY a.tanggalrekam desc";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arrspajol = $DB->result();
?>
<html>
<head>
	<title>SPAJ List</title>
	<link href="./includes/jws2005.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="./includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/jquery.min.js" ></script>
	<script type='text/javascript'>
		$(document).ready(function () {
			$("input[name='nama']").focus();
		});
	</script>
</head>
<body>
	<form id="porm" name="porm" method="get" action="<?echo $PHP_SELF;?>">
	<table width="100%" cellpadding="4" cellspacing="0" >
		<tr bgcolor="#f89aa4">
			<td>No SPAJ <font size=1>(min 3 karakter)</font>: &nbsp;
				<input type="text" name="nama" size="8" value="<?echo strtoupper($nama);?>">
				
				Rayon
				<select name=kdkantor class=select2>
					<option value="<?=$arrkantor['KDKANTOR']?>"><?="$arrkantor[KDKANTOR] - $arrkantor[NAMAKANTOR]"?></option>
				</select>
				<input type="hidden" name="a" value="<?echo $a;?>">
				<input type="hidden" name="b" value="<?echo $b;?>">
			</td>
		</tr>
	</table>
	
	<br>
	
	<table width="100%" style='border-top:1px solid #f89aa4;'>
		<tr>
			<td align='center'><b>DAFTAR SPAJ ONLINE AGEN KANTOR <?="$arrkantor[KDKANTOR] - $arrkantor[NAMAKANTOR]"?></b></td>
		</tr>
	</table>
	
	<table border="0" width="100%" cellpadding="2" cellspacing="1">
		<tr bgcolor="#f89aa4">
			<td align="center" width='100px'><b>No. SPAJ</b></td>
			<td align="center"><b>Nama CPP</b></td>
			<td align="center"><b>No. Agen</b></td>
		</tr>
		<?php foreach ($arrspajol as $i => $v) { ?>
		<tr>
			<td><a href="javascript:void(0);" onclick="javascript:window.opener.document.<?=$formname?>.nosp.value='<?=$v['NOSPAJ']?>'; javascript:window.opener.document.<?=$formname?>.noagen.value='<?=$v['NOAGEN']?>';window.opener.cekbentukdataklien('<?=$v['NOSPAJ']?>');window.close();"><?=$v['NOSPAJ']?></a></td>
			
			
			<td><?=$v['NAMAKLIEN1']?></td>
			<td><?="$v[PREFIXAGEN]-$v[NOAGEN]"?></td>
		</tr>
		<?php } ?>
	</table>
</body>