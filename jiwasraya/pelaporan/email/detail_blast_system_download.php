<? 
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date_year.php";
 	
 	header("Content-type: application/vnd-ms-excel");
  	header("Content-Disposition: attachment; filename=report_detail_blast_system.xls");

 	$userid="jsadm";
	$passwd="jsadmoke";
	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
?>
<html>
	<head>
		<title>Management Blast</title>
		<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
		<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
		<style type="text/css">
		<!-- 
			body{
				font-family: tahoma,verdana,geneva,sans-serif;
				font-size: 22px;
			}
			td{
				font-family: tahoma,verdana,geneva,sans-serif;
				font-size: 13px;
			}
			input     {font-family:tahoma,verdana,geneva,sans-serif; font-size: 12px; width:150px; border-width: .2em;border-width: .2em;color:333333; border-radius:3px;padding:3px 12px;}
			select      {font-family:tahoma,verdana,geneva,sans-serif; font-size: 12px; border-style: groove; border-width: .2em;}
			textarea    {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
			a { color:#259dc5; text-decoration:none;}
			a:hover {
				color: orange;
			}
		-->
		</style>
	</head>

	<body topmargin="20">
		<h4>DETAIL EMAIL BLAST</h4>
		<table border="0" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4">
			<?php
				$sql = "SELECT a.*,
						TO_CHAR(a.TGL_EVENT, 'MM')BULAN, 
						TO_CHAR(a.TGL_EVENT, 'YYYY')TAHUN 
						FROM $DBUser.EMAIL_BLAST_EVENT_TESTING a WHERE a.ID_BLAST=".$_GET['idblast'];
				$DB->parse($sql);
				$DB->execute();
				while ($row=$DB->nextrow()) {
					$jenisblast = $row['JENIS_BLAST'];
			?>

			<tr>
				<td width="10%">ID BLAST </td>
				<td>: <?=$row['ID_BLAST']?></td>
			</tr>
			<tr>
				<td>JENIS BLAST </td>
				<td>: <?=$row['JENIS_BLAST']?></td>
			</tr>
			<tr>
				<td>NAMA EVENT</td>
				<td>: <?=$row['NAMA_EVENT']?></td>
			</tr>
			<tr>
				<td>TANGGAL EVENT</td>
				<td>: <?=$row['TGL_EVENT']?></td>
				<?php
					$bulan = $row['BULAN'];
					$tahun = $row['TAHUN'];
				?>
			</tr>
		</table></br>
			<?
				}
			?>
		<table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#877F85">
			<tr bgcolor="#b1c8ed" align="center">
				<td>NO</td>
				<td>NOMOR POLIS</td>
				<td>RAYON PENAGIH</td>
				<td>EMAIL TAGIH</td>
				<td>EMAIL TETAP</td>
				<td>NOMOR HP.</td>
				<td>DOC</td>
				<td>STATUS KIRIM EMAIL TAGIH</td>
				<td>TGL. KIRIM EMAIL TAGIH</td>
				<td>STATUS KIRIM EMAIL TETAP</td>
				<td>TGL. KIRIM EMAIL TETAP</td>
				<td>STATUS KIRIM SMS</td>
				<td>TGL. KIRIM SMS</td>
				<td>STATUS CETAK SURAT</td>
				<td>TGL CETAK SURAT</td>
			</tr>
		<?php
			// $sql = "SELECT * FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = ".$_GET['idblast']." ORDER BY ID_AUDIENCE ASC";
			$sql = "SELECT 
						A.*, 
						(
							SELECT Y.KDRAYONPENAGIH 
							FROM $DBUser.TABEL_200_PERTANGGUNGAN X,
								$DBUser.TABEL_500_PENAGIH Y
							WHERE X.NOPENAGIH = Y.NOPENAGIH
							AND X.PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
							AND X.NOPERTANGGUNGAN = A.NOPERTANGGUNGAN
						)RAYON_PENAGIH
					FROM $DBUser.PENERIMA_EMAIL_BLAST A 
					WHERE A.ID_BLAST = ".$_GET['idblast']." 
					ORDER BY A.ID_AUDIENCE ASC";
			// echo $sql;
			$DB->parse($sql);
			$DB->execute();
			$i=1;
			while ($row=$DB->nextrow()) {
		?>
			<tr align="center">
				<td><?=$i;?></td>
				<td><?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?></td>
				<td><?=$row["RAYON_PENAGIH"];?></td>
				<td><?=$row["EMAIL"];?></td>
				<td><?=$row["EMAIL2"];?></td>
				<td><?=$row["NO_HP"];?></td>
				<td><?=$row["FILE_PDF"];?></td>
				<?php
					if($row["STATUS"] == ''){
						echo "<td>-</td><td>-</td>";
					}else{
						echo "<td>Done</td><td>".$row["TGL_KIRIM"]."</td>";
					}

					if($row["STATUS2"] == ''){
						echo "<td>-</td><td>-</td>";
					}else{
						echo "<td>Done</td><td>".$row["TGL_KIRIM2"]."</td>";
					}

					if($row["TGL_KIRIM_SMS"] == ''){
						echo "<td>-</td><td>-</td>";
					}else{
						echo "<td>Done</td><td>".$row["TGL_KIRIM_SMS"]."</td>";
					}

					if($row["TGL_CETAK_SURAT"] == ''){
						echo "<td>-</td><td>-</td>";
					}else{
						echo "<td>Done</td><td>".$row["TGL_CETAK_SURAT"]."</td>";
					}
				?>
			</tr>
		<?php
			$i++;
			}
		?>
		</table>
	</body>
</html>
