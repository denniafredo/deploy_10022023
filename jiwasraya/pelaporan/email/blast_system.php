<? 
	include "../../includes/session.php";
	include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/dropdown_date_year.php";
 	
 	$userid="jsadm";
	$passwd="jsadmoke";
	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);

	if ($create) {
	 	$sql = "BEGIN $DBUser.GEN_BLAST_ALL ( '".$_POST['jenis_blast']."', '".$_POST['periode']."' );END;";
	 	$DB->parse($sql);
	 	$DB->execute();
	 	//echo $sql;
	}
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
			select      {font-family:tahoma,verdana,geneva,sans-serif; font-size: 12px; width:150px; border-style: groove; border-width: .2em;}
			textarea    {font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
			a { color:#259dc5; text-decoration:none;}
			a:hover {
				color: orange;
			}
		-->
		</style>
	</head>

	<body topmargin="20">
		<h4>MANAGEMENT EMAIL BLAST</h4>
		<form name="frm" action="<?=$PHP_SELF;?>" method="post">
			<table border="0" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4">
				<tr>
					<td width="7%">Periode </td>
					<td>
						<input type="text" name="periode" size="7"> (MM/YYYY)
					</td>
				</tr>
				<tr>
					<td>Jenis Blast </td>
					<td>
						<select name='jenis_blast'>
							<option value="">-- Silahkan Pilih --</option>
							<option value="AKTIVASI_VA_GADAI">AKTIVASI_VA_GADAI</option>
							<option value="PEMBERITAHUAN_POSISI_GADAI">PEMBERITAHUAN_POSISI_GADAI</option>
							<option value="PEMBERITAHUAN_POLIS_BPO">PEMBERITAHUAN_POLIS_BPO</option>
<!-- 							<option value="UCAPAN_IDUL_FITRI">UCAPAN_IDUL_FITRI_NASABAH</option>
							<option value="UCAPAN_IDUL_FITRI_AGEN">UCAPAN_IDUL_FITRI_AGEN</option> -->
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input name="create" value="Create Event" type="submit"></td>
				</tr>
			</table>
		</form>

		<table border="1" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#877F85">
			<tr bgcolor="#b1c8ed" align="center">
				<td>NO</td>
				<td>ID</td>
				<td>JENIS</td>
				<td width="20%">NAMA EVENT</td>
				<td>TGL EVENT</td>
				<td>ACTION</td>
				<td>JUMLAH POLIS</td>
				<td>EMAIL BLAST</td>
				<td>SMS BLAST</td>
				<td>SURAT</td>
			</tr>
		<?php
			$sql = "SELECT * FROM $DBUser.EMAIL_BLAST_EVENT_TESTING ORDER BY ID_BLAST";
			$DB->parse($sql);
			$DB->execute();
			$i=1;
			while ($row=$DB->nextrow()) {
		?>
			<tr align="center">
				<td><?=$i;?></td>
				<td><?=$row["ID_BLAST"];?></td>
				<td><?=$row["JENIS_BLAST"];?></td>
				<td align="left"><?=$row["NAMA_EVENT"];?></td>
				<td><?=$row["TGL_EVENT"];?></td>
				<td style="padding-left:20px">
					<?php
						if($row["JENIS_BLAST"] == 'PEMBERITAHUAN_POSISI_GADAI'){
					?>
							<a href="function_gen_pdf_pemberitahuan_gadai.php?cetak=0&idblast=<?=$row["ID_BLAST"];?>" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Generate PDF</a></br></br>
						<?php
							if($row["KDGENERATE"] == '1'){
						?>
								<a href="email.gen_kirim_pemberitahuan_gadai.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/email.png align=absmiddle border="0"> Kirim Email</a></br></br>
								<a href="sms.gen_kirim_pemberitahuan_gadai.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/sms.png align=absmiddle border="0"> Kirim SMS</a></br></br>
						<?php		
							}else{
						?>
								<a href="#"><img src=../../img/email.png align=absmiddle border="0"> Kirim Email</a></br></br>
								<a href="#"><img src=../../img/sms.png align=absmiddle border="0"> Kirim SMS</a></br></br>
						<?php
							}
						?>
							<a href="detail_blast_system.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/doc.png align=absmiddle border=0> Detail</a></br></br>
							<a href="email.gen_kirim_pemberitahuan_gadai.php?delete=1&idblast=<?=$row["ID_BLAST"];?>" onClick="alert('Apakah data akan dihapus?')"><img src=../../img/delete.png align=absmiddle border=0> Delete</a></br>
					<?php
						}
						else if($row["JENIS_BLAST"] == 'AKTIVASI_VA_GADAI'){
					?>
							<a href="#" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Generate PDF</a></br></br>
							<a href="email.gen_kirim_aktivasi_va_gadai.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/email.png align=absmiddle border="0"> Kirim Email</a></br></br>
							<a href="sms_aktivasi_va_gadai.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/sms.png align=absmiddle border="0"> Kirim SMS</a></br></br>
							<a href="detail_blast_system.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/doc.png align=absmiddle border=0> Detail</a></br></br>
							<a href="email.gen_kirim_aktivasi_va_gadai.php?delete=1&idblast=<?=$row["ID_BLAST"];?>" onClick="alert('Apakah data akan dihapus?')"><img src=../../img/delete.png align=absmiddle border=0> Delete</a></br>
					<?php
						}else if($row["JENIS_BLAST"] == 'PEMBERITAHUAN_POLIS_BPO'){
					?>
							<a href="function_gen_pdf_pemberitahuan_bpo.php?cetak=0&idblast=<?=$row["ID_BLAST"];?>" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Generate PDF</a></br></br>
						<?php
							if($row["KDGENERATE"] == '1'){
						?>
								<a href="email.gen_kirim_pemberitahuan_bpo.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/email.png align=absmiddle border="0"> Kirim Email</a></br></br>
								<a href="sms.gen_kirim_pemberitahuan_bpo.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/sms.png align=absmiddle border="0"> Kirim SMS</a></br></br>
						<?php		
							}else{
						?>
								<a href="#"><img src=../../img/email.png align=absmiddle border="0"> Kirim Email</a></br></br>
								<a href="#"><img src=../../img/sms.png align=absmiddle border="0"> Kirim SMS</a></br></br>
						<?php
							}
						?>
							<a href="detail_blast_system.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/doc.png align=absmiddle border=0> Detail</a></br></br>
							<a href="email.gen_kirim_pemberitahuan_bpo.php?delete=1&idblast=<?=$row["ID_BLAST"];?>" onClick="alert('Apakah data akan dihapus?')"><img src=../../img/delete.png align=absmiddle border=0> Delete</a></br>
					<?php
						}else if($row["JENIS_BLAST"] == 'UCAPAN_IDUL_FITRI' || $row["JENIS_BLAST"] == 'UCAPAN_IDUL_FITRI_AGEN'){
					?>
							<!-- <a href="#" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Generate PDF</a></br></br> -->
							<a href="email.gen_kirim_ucapan_idul_fitri.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/email.png align=absmiddle border="0"> Kirim Email</a></br></br>
							<!-- <a href="sms_aktivasi_va_gadai.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/sms.png align=absmiddle border="0"> Kirim SMS</a></br></br> -->
							<!-- <a href="detail_blast_system.php?idblast=<?=$row["ID_BLAST"];?>"><img src=../../img/doc.png align=absmiddle border=0> Detail</a></br></br> -->
							<a href="email.gen_kirim_aktivasi_va_gadai.php?delete=1&idblast=<?=$row["ID_BLAST"];?>" onClick="alert('Apakah data akan dihapus?')"><img src=../../img/delete.png align=absmiddle border=0> Delete</a></br>
					<?php
						}
					?>
				</td>
				<td>
					<?php
						$sqlc = "SELECT ID_BLAST,
									(SELECT COUNT(*) FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = a.ID_BLAST)JML,
									(SELECT COUNT(*) FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = a.ID_BLAST AND STATUS = '1')EMAIL_TERKIRIM,
									(SELECT COUNT(*) FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = a.ID_BLAST AND STATUS IS NULL)EMAIL_GAGALTERKIRIM,
									(SELECT COUNT(*) FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = a.ID_BLAST AND STATUS IS NULL AND TGL_KIRIM_SMS IS NOT NULL)SMS_TERKIRIM,
									(SELECT COUNT(*) FROM $DBUser.PENERIMA_EMAIL_BLAST WHERE ID_BLAST = a.ID_BLAST AND STATUS IS NULL AND TGL_KIRIM_SMS IS NULL)SMS_GAGALTERKIRIM
								FROM $DBUser.PENERIMA_EMAIL_BLAST a 
								WHERE a.ID_BLAST = '".$row["ID_BLAST"]."'
								GROUP BY ID_BLAST ";
						$DB1->parse($sqlc);
						$DB1->execute();
						while ($rowc=$DB1->nextrow()) {
							echo $rowc["JML"];
						
					?>
				</td>
				<td>
					<img src=../../img/success.png align=absmiddle border="0"> Terkirim : <?=$rowc["EMAIL_TERKIRIM"]?></br></br>
					<img src=../../img/error.png align=absmiddle border="0"> Gagal Kirim : <?=$rowc["EMAIL_GAGALTERKIRIM"]?></br>
				</td>
				<td>
					<img src=../../img/success.png align=absmiddle border="0"> Terkirim : <?=$rowc["SMS_TERKIRIM"]?></br></br>
					<img src=../../img/error.png align=absmiddle border="0"> Gagal Kirim : <?=$rowc["SMS_GAGALTERKIRIM"]?></br>
				</td>
					<?php
						}
					?>
				<td>
					<?php
						if($row["JENIS_BLAST"] == 'PEMBERITAHUAN_POSISI_GADAI'){
					?>
							<a href="function_gen_pdf_pemberitahuan_gadai.php?cetak=1&idblast=<?=$row["ID_BLAST"];?>" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Cetak Surat
					<?php		
						}else if($row["JENIS_BLAST"] == 'AKTIVASI_VA_GADAI'){
					?>	
							<a href="function_gen_pdf_pemberitahuan_gadai.php?cetak=1&idblast=<?=$row["ID_BLAST"];?>" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Cetak Surat</a>
					<?php		
						}else if($row["JENIS_BLAST"] == 'PEMBERITAHUAN_POLIS_BPO'){
					?>
							<a href="function_gen_pdf_pemberitahuan_bpo.php?cetak=1&idblast=<?=$row["ID_BLAST"];?>" target="_blank"><img src=../../img/cetak.gif align=absmiddle border=0> Cetak Surat</a>
					<?php		
						}
					?>
					
				</td>
			</tr>
		<?php
			$i++;
			}
		?>
		</table>
	</body>
</html>
