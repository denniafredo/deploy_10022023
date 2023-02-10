<?php
	include "../../includes/common.php";
	include "../includes/database.php";
	include "../includes/session.php";
	
	$DB = new Database($userid,$passwd,$DBName);
	
	$sqluser = "SELECT KDCHANNEL, NAMACHANNEL, KETERANGAN, NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE WHERE KDCHANNEL = '".$kdchannel."'";
	$DB->parse($sqluser);
	$DB->execute();
	$arru=$DB->nextrow();			
?>

<html>
	<head>
		<title>Lampiran Slip Setoran Premi PP</title>
		
		<style type="text/css">
		<!-- 
			body{font-size: 12px;} 
			td{font-size: 12px;}
		-->
		</style>
	</head>
	<body>
		<div align="center">
			<table border="0" style="border-collapse: collapse" width="90%" id="table2" cellpadding="2" cellspacing="2">
				<tr>
					<td width="25%"><b>LAMPIRAN SLIP CHANNEL</b></td>
					<td><b><?=$arru["KETERANGAN"];?></b></td>
				</tr>
				<tr>
					<td><b>TANGGAL</b></td>
					<td>
						<b>
						<?php 
							$tahunnya = substr($tglakhir,0,4);
							$bulnanya = substr($tglakhir,4,2);
							$tanggalnya = substr($tglakhir,-2);
					
							echo $tanggalnya."/".$bulnanya."/".$tahunnya;
						?>
						</b>
					</td>
				</tr>
			</table>

			<br />

			<table border="0" style="border-collapse: collapse" width="90%" id="table2" cellpadding="8" cellspacing="8">
				<tr>
					<td align="center" style="border: 1px solid #000000" width="3%"><b>NO</b></td>
					<td align="center" style="border: 1px solid #000000"><b>NOMOR POLIS</b></td>
					<td align="center" style="border: 1px solid #000000" width="20%"><b>KODE AKUN</b></td>
					<td align="center" style="border: 1px solid #000000" width="20%"><b>PREMI</b></td>
				</tr>
				<?php
				$sql = "SELECT b.nama, 
							a.akun, 
								SUM(
									CASE 
										WHEN SUBSTR(a.akun,1,3) = '123' 
										THEN 0 ELSE a.debet 
									END
								) debet, 
								--SUM(a.kredit) kredit, 
								(SUM(a.kredit) - SUM(a.debet)) kredit,
								TO_CHAR(a.tgl_trans, 'dd-mm-yyyy') tgl_trans, 
								SUBSTR(a.ket, 1, 15)ket
						FROM tabel_802_trvouc@gllink a
						INNER JOIN tabel_802_kodeakun@gllink b ON a.akun = b.akun
						WHERE kdkantor = 'KP'
							AND notrans = (SELECT NOMORBD FROM $DBUser.TABEL_802_SLIP_TEMPLATE WHERE KDCHANNEL = '".$kdchannel."')
							--AND TO_DATE(kdtrans, 'yyyymmdd') BETWEEN TO_DATE('$tglawal','yyyymmdd') AND TO_DATE('$tglakhir','yyyymmdd')
							AND kdtrans BETWEEN '$tglawal' AND '$tglakhir'
							AND SUBSTR (a.akun, 1, 1) <> '3'
							AND SUBSTR (a.akun, 1, 3) <> '148'
							--AND a.kdtabel != '88'
						GROUP BY b.nama, a.akun, a.tgl_trans, SUBSTR(a.ket,1,15)
						ORDER BY SUBSTR(a.ket,1,15)";
				// echo $sql;
				$DB->parse($sql);
				$DB->execute();
				$i=1;
				$kredit = 0;
				while ($arr=$DB->nextrow()) { ?>
					<tr>
						<td align="center" style="border-left:1px solid #000000"><?=$i;?></td>
						<td style="border-left:1px solid #000000"><?php echo substr($arr['KET'], 0, 15);?></td>
						<td align="center" style="border-left:1px solid #000000"><?=$arr["AKUN"];?></td>
						<td align="right" style="border-left:1px solid #000000;border-right:1px solid #000000"><?=number_format($arr["KREDIT"],2,',','.');?></td>
					</tr>
					<?php $i++;
					$kredit += $arr['KREDIT'];
				} ?>
				<tr>
					<td align="center" colspan="3" style="border: 1px solid #000000">TOTAL</td>
					<td style="border: 1px solid #000000" align="right"><?=number_format($kredit,2,',','.');?></td>            
				</tr>
			</table>

			</br></br>
			<table border="1" style="border-collapse: collapse; margin-right: 10%;" align="right" width="20%" id="table2" cellpadding="2" cellspacing="2">
				<tr>
					<td colspan="3" style="text-align: center; font-size: 8px;">Kotak Paraf</td>
				</tr>
				<tr height="20px">
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</div>
	</body>
</html>