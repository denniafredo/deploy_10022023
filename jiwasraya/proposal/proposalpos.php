<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	
	$DB = New database($DBUser, $DBPass, $DBName);
	$jmlhariexp = 17;
	
	// Build id agen yang ingin ditampilkan diluar kondisi yang ada saat ini hanya dalam 1 hari
	$listbuildid = (date('dmY') == '19022019') ? "'1901292391'" : "null";			
?>

<html>
	<head>
		<link href="../../includes/jws2005.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
		<script type="text/javascript">
			function sentProp(bid, nm, almt, hp, prm, tu, ip) {
				window.opener.document.spaj.buildid.value=bid;
				window.opener.document.spaj.nama.value=nm;
				window.opener.document.spaj.alamat.value=almt;
				window.opener.document.spaj.hp.value=hp;
				window.opener.document.spaj.premi.value=prm;
				window.opener.document.spaj.topup.value=tu;
				window.opener.document.spaj.idproduk.value=ip;
				window.opener.changedokumen();
				window.close();
			}
			function test(data) {
				alert(data);
			}
		</script>
		
		<title>Agen List</title>
	</head>
	<body>
		<b>Daftar Proposal POS Online Kantor <?=$kantor;?><br />
		*Batas penarikan proposal pos 14 hari, jika lewat akan hilang dari daftar<br />
		*Pastikan data benar, jika sudah ditarik dan disimpan akan hilang dari daftar
		</b><br>

		<table border="0" width="100%" cellpadding="2" cellspacing="1">
			<tr bgcolor="#f89aa4">
				<td>No</td>
				<td>Build ID</td>
				<td>Nama</td>
				<td>HP</td>
				<td>Produk</td>
				<td>Cara Bayar</td>
				<td>Premi</td>
				<td>Top Up</td>
				<td>Tgl Rekam</td>
			</tr>
			
			<?php 
			$sql = "SELECT c.build_id, a.nama, hp, TRIM(alamat) || ', ' || TRIM(kota) || ', ' || TRIM(namaprovinsi) alamat, 
						d.nama_produk, c.cara_bayar, NVL(c.jumlah_premi, 0) jumlah_premi, NVL(c.top_up, 0) top_up, 
						to_char(MAX(tgl_rekam), 'dd/mm/yyyy') tgl_rekam, MAX(tgl_rekam) tgl_order, c.id_produk
					FROM jaim_201_prospek@JAIM a
					LEFT OUTER JOIN jaim_001_provinsi@JAIM b ON a.kdprovinsi = b.kdprovinsi
					LEFT OUTER JOIN jaim_300_hitung@JAIM c ON a.noprospek = c.no_prospek
					LEFT OUTER JOIN jaim_300_produk@JAIM d ON c.id_produk = d.id_produk
					WHERE (tgl_rekam + $jmlhariexp >= sysdate
						AND noagen = '$id'
						AND flag_spaj = '0')
						OR c.build_id IN ($listbuildid)
					GROUP BY c.build_id, a.nama, hp, alamat, kota, namaprovinsi, d.nama_produk, c.cara_bayar, c.jumlah_premi, c.top_up, c.id_produk
					ORDER BY tgl_order DESC";
			$DB->parse($sql);
			$DB->execute();
			//echo $sql;
			$i=0;
			while($arr=$DB->nextrow()) {
				$bgcolor = $i%2 ? "#d3d3d3" : "#97c8e1";
				$param = "'$arr[BUILD_ID]', '$arr[NAMA]', '".trim(preg_replace('/\s\s+/', ' ', $arr['ALAMAT']))."', '$arr[HP]', '$arr[JUMLAH_PREMI]', '$arr[TOP_UP]', '$arr[ID_PRODUK]'";
				?>
				<tr bgcolor="<?=$bgcolor?>">
					<td align='center'><?=$i+1?></td>
					<td><a href="javascript:void(0);" onclick="sentProp(<?=$param?>)"><?=$arr['BUILD_ID']?></a></td>
					<td><?=$arr['NAMA']?></td>
					<td><?=$arr['HP']?></td>
					<td><?=$arr['NAMA_PRODUK']?></td>
					<td><?=$arr['CARA_BAYAR']?></td>
					<td align='right'><?=number_format($arr['JUMLAH_PREMI'], 0, ',', '.')?></td>
					<td align='right'><?=number_format($arr['TOP_UP'], 0, ',', '.')?></td>
					<td><?=$arr['TGL_REKAM']?></td>
				</tr>
				<?php $i++;
			}
		?>
	</body>
</html>