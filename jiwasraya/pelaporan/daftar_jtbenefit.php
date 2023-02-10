<?php
	include "../../includes/session.php"; 
	include "../../includes/database.php"; 
	include "../../includes/month_selector.php";
	include "../../includes/fungsi.php";
	
	$DB=new database($userid, $passwd, $DBName);
	$DC=new database($userid, $passwd, $DBName);
	$DD=new database($userid, $passwd, $DBName);
	$DE=new database($userid, $passwd, $DBName);
	$DF=new database($userid, $passwd, $DBName);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Daftar Jatuh Tempo Benefit</title>
		<link href="../jws.css" rel="stylesheet" type="text/css">
		<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
	</head>
	
	<body>
		<a class="verdana10blk"><b>POSISI BENEFIT PP JAN - AGUS 2016</b></a>
		<hr size="1">
 
		<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#006699" id="AutoNumber1">
			<tr>
				<td width="15" align="center" bgcolor="#0066FF" class="verdana7blu" rowspan="2"><b>Nama Benefit</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu" colspan="12"><b>Bulan</b></td>
			</tr>
			<tr>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>1</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>2</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>3</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>4</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>5</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>6</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>7</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>8</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>9</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>10</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>11</b></td>
				<td align="center" bgcolor="#0066FF" class="verdana7blu"><b>12</b></td>
			</tr>
			
			<?php
			$sql = "SELECT a.kdstatus, 
						UPPER(NVL((SELECT namastatus FROM $DBUser.tabel_999_kode_status WHERE kdstatus = a.kdstatus AND jenisstatus = 'KLAIM'), 'Belum Diajukan')) namastatus, 
						SUM(CASE WHEN a.blnjatuhtempo = '1' THEN a.nilaibenefit END) bln1,
						SUM(CASE WHEN a.blnjatuhtempo = '2' THEN a.nilaibenefit END) bln2,
						SUM(CASE WHEN a.blnjatuhtempo = '3' THEN a.nilaibenefit END) bln3,
						SUM(CASE WHEN a.blnjatuhtempo = '4' THEN a.nilaibenefit END) bln4,
						SUM(CASE WHEN a.blnjatuhtempo = '5' THEN a.nilaibenefit END) bln5,
						SUM(CASE WHEN a.blnjatuhtempo = '6' THEN a.nilaibenefit END) bln6,
						SUM(CASE WHEN a.blnjatuhtempo = '7' THEN a.nilaibenefit END) bln7,
						SUM(CASE WHEN a.blnjatuhtempo = '8' THEN a.nilaibenefit END) bln8,
						SUM(CASE WHEN a.blnjatuhtempo = '9' THEN a.nilaibenefit END) bln9,
						SUM(CASE WHEN a.blnjatuhtempo = '10' THEN a.nilaibenefit END) bln10,
						SUM(CASE WHEN a.blnjatuhtempo = '11' THEN a.nilaibenefit END) bln11,
						SUM(CASE WHEN a.blnjatuhtempo = '12' THEN a.nilaibenefit END) bln12
					FROM $DBUser.tabel_proyeksi_vs_bias a 
					LEFT OUTER JOIN $DBUser.tabel_999_kode_status b ON a.kdstatus = b.kdstatus AND b.jenisstatus = 'KLAIM'
					GROUP BY a.kdstatus 
					ORDER BY a.kdstatus NULLS FIRST";
			$DB->parse($sql);
			$DB->execute();
			
			while ($r=$DB->nextrow()) { ?>
				<tr bgcolor="00CCFF">
					<td bgcolor="#00CCFF" class="verdana7blu"><b><?=$r['NAMASTATUS']?></b></td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=1','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN1'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=2','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN2'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=3','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN3'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=4','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN4'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=5','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN5'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=6','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN6'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=7','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN7'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=8','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN8'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=9','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN9'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=10','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN10'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=11','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN11'], 0, ",", ".")?>
						</a></b>
					</td>
					<td bgcolor="#00CCFF" class="verdana7blu" align="right">
						<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&bln=12','jtbenefit',1000,600,1);">
							<?=number_format($r['BLN12'], 0, ",", ".")?>
						</a></b>
					</td>
					
					<?php
					$status = strlen($r['KDSTATUS']) < 1 ? " a.kdstatus IS NULL " : " a.kdstatus = '$r[KDSTATUS]' ";
					$sql = "SELECT a.kdstatusfilerkap, 
								(SELECT namastatusfile FROM $DBUser.tabel_299_status_file WHERE kdstatusfile = a.kdstatusfilerkap) namastatusfile,
								SUM(CASE WHEN a.blnjatuhtempo = '1' THEN a.nilaibenefit END) bln1,
								SUM(CASE WHEN a.blnjatuhtempo = '2' THEN a.nilaibenefit END) bln2,
								SUM(CASE WHEN a.blnjatuhtempo = '3' THEN a.nilaibenefit END) bln3,
								SUM(CASE WHEN a.blnjatuhtempo = '4' THEN a.nilaibenefit END) bln4,
								SUM(CASE WHEN a.blnjatuhtempo = '5' THEN a.nilaibenefit END) bln5,
								SUM(CASE WHEN a.blnjatuhtempo = '6' THEN a.nilaibenefit END) bln6,
								SUM(CASE WHEN a.blnjatuhtempo = '7' THEN a.nilaibenefit END) bln7,
								SUM(CASE WHEN a.blnjatuhtempo = '8' THEN a.nilaibenefit END) bln8,
								SUM(CASE WHEN a.blnjatuhtempo = '9' THEN a.nilaibenefit END) bln9,
								SUM(CASE WHEN a.blnjatuhtempo = '10' THEN a.nilaibenefit END) bln10,
								SUM(CASE WHEN a.blnjatuhtempo = '11' THEN a.nilaibenefit END) bln11,
								SUM(CASE WHEN a.blnjatuhtempo = '12' THEN a.nilaibenefit END) bln12
							FROM $DBUser.tabel_proyeksi_vs_bias a
							WHERE $status
							GROUP BY a.kdstatusfilerkap
							ORDER BY a.kdstatusfilerkap";
					$DC->parse($sql);
					$DC->execute();
				
					while ($s=$DC->nextrow()) { ?>
						<tr bgcolor="9DE0EE">
							<td bgcolor="#9DE0EE" class="verdana7blu"><b>&nbsp;&nbsp;<?=$s['NAMASTATUSFILE']?> (RKAP)</b></td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=1','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN1'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=2','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN2'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=3','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN3'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=4','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN4'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=5','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN5'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=6','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN6'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=7','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN7'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=8','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN8'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=9','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN9'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=10','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN10'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=11','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN11'], 0, ",", ".")?>
								</a></b>
							</td>
							<td bgcolor="#9DE0EE" class="verdana7blu" align="right">
								<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&bln=12','jtbenefit',1000,600,1);">
									<?=number_format($s['BLN12'], 0, ",", ".")?>
								</a></b>
							</td>
							
							<?php
							$sql = "SELECT a.kdbenefit, 
										(SELECT namabenefit FROM $DBUser.tabel_207_kode_benefit WHERE kdbenefit = a.kdbenefit) namabenefit,
										SUM(CASE WHEN a.blnjatuhtempo = '1' THEN a.nilaibenefit END) bln1,
										SUM(CASE WHEN a.blnjatuhtempo = '2' THEN a.nilaibenefit END) bln2,
										SUM(CASE WHEN a.blnjatuhtempo = '3' THEN a.nilaibenefit END) bln3,
										SUM(CASE WHEN a.blnjatuhtempo = '4' THEN a.nilaibenefit END) bln4,
										SUM(CASE WHEN a.blnjatuhtempo = '5' THEN a.nilaibenefit END) bln5,
										SUM(CASE WHEN a.blnjatuhtempo = '6' THEN a.nilaibenefit END) bln6,
										SUM(CASE WHEN a.blnjatuhtempo = '7' THEN a.nilaibenefit END) bln7,
										SUM(CASE WHEN a.blnjatuhtempo = '8' THEN a.nilaibenefit END) bln8,
										SUM(CASE WHEN a.blnjatuhtempo = '9' THEN a.nilaibenefit END) bln9,
										SUM(CASE WHEN a.blnjatuhtempo = '10' THEN a.nilaibenefit END) bln10,
										SUM(CASE WHEN a.blnjatuhtempo = '11' THEN a.nilaibenefit END) bln11,
										SUM(CASE WHEN a.blnjatuhtempo = '12' THEN a.nilaibenefit END) bln12
									FROM $DBUser.tabel_proyeksi_vs_bias a
									WHERE $status AND a.kdstatusfilerkap = '$s[KDSTATUSFILERKAP]'
									GROUP BY a.kdbenefit
									ORDER BY namabenefit";
							$DD->parse($sql);
							$DD->execute();
							
							while ($t=$DD->nextrow()) { ?>
								<tr bgcolor="E1EFF7">
									<td bgcolor="#E1EFF7" class="verdana7blu" nowrap><b>&nbsp;&nbsp;&nbsp;&nbsp;<?=$t['NAMABENEFIT']?></b></td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=1','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN1'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=2','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN2'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=3','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN3'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=4','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN4'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=5','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN5'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=6','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN6'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=7','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN7'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=8','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN8'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=9','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN9'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=10','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN10'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=11','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN11'], 0, ",", ".")?>
										</a></b>
									</td>
									<td bgcolor="#E1EFF7" class="verdana7blu" align="right">
										<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&bln=12','jtbenefit',1000,600,1);">
											<?=number_format($t['BLN12'], 0, ",", ".")?>
										</a></b>
									</td>
									
									<?php
									$sql = "SELECT a.kdstatusfile,
												(SELECT namastatusfile FROM $DBUser.tabel_299_status_file WHERE kdstatusfile = a.kdstatusfile) namastatusfile,
												SUM(CASE WHEN a.blnjatuhtempo = '1' THEN a.nilaibenefit END) bln1,
												SUM(CASE WHEN a.blnjatuhtempo = '2' THEN a.nilaibenefit END) bln2,
												SUM(CASE WHEN a.blnjatuhtempo = '3' THEN a.nilaibenefit END) bln3,
												SUM(CASE WHEN a.blnjatuhtempo = '4' THEN a.nilaibenefit END) bln4,
												SUM(CASE WHEN a.blnjatuhtempo = '5' THEN a.nilaibenefit END) bln5,
												SUM(CASE WHEN a.blnjatuhtempo = '6' THEN a.nilaibenefit END) bln6,
												SUM(CASE WHEN a.blnjatuhtempo = '7' THEN a.nilaibenefit END) bln7,
												SUM(CASE WHEN a.blnjatuhtempo = '8' THEN a.nilaibenefit END) bln8,
												SUM(CASE WHEN a.blnjatuhtempo = '9' THEN a.nilaibenefit END) bln9,
												SUM(CASE WHEN a.blnjatuhtempo = '10' THEN a.nilaibenefit END) bln10,
												SUM(CASE WHEN a.blnjatuhtempo = '11' THEN a.nilaibenefit END) bln11,
												SUM(CASE WHEN a.blnjatuhtempo = '12' THEN a.nilaibenefit END) bln12
											FROM $DBUser.tabel_proyeksi_vs_bias a
											WHERE $status AND a.kdstatusfilerkap = '$s[KDSTATUSFILERKAP]' AND a.kdbenefit = '$t[KDBENEFIT]'
											GROUP BY a.kdstatusfile";
									$DE->parse($sql);
									$DE->execute();
							
									while ($u=$DE->nextrow()) { ?>
										<tr bgcolor="">
											<td bgcolor="" class="verdana7blu" nowrap><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$u['NAMASTATUSFILE']?></b></td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=1','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN1'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=2','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN2'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=3','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN3'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=4','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN4'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=5','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN5'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=6','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN6'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=7','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN7'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=8','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN8'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=9','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN9'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=10','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN10'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=11','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN11'], 0, ",", ".")?>
												</a></b>
											</td>
											<td bgcolor="" class="verdana7blu" align="right">
												<b><a href="javascript:void(0);" class="verdana7blu" onclick="NewWindow('daftar_jtbenefit_rinci.php?&kdstatus=<?=$r['KDSTATUS']?>&kdstatusfilerkap=<?=$s['KDSTATUSFILERKAP']?>&kdbenefit=<?=$t['KDBENEFIT']?>&kdstatusfile=<?=$u['KDSTATUSFILE']?>&bln=12','jtbenefit',1000,600,1);">
													<?=number_format($u['BLN12'], 0, ",", ".")?>
												</a></b>
											</td>
										</tr>
									<?php } ?>
								</tr>
							<?php } ?>
						</tr>
					<?php } ?>
				</tr>
			<?php } ?>
		</table>
	</body>
</html>