<?php
	include "../../includes/session.php"; 
	include "../../includes/database.php"; 
	
	$DB=new database($userid, $passwd, $DBName);
	$DBU=new database($userid, $passwd, $DBName);

	$sql = "SELECT a.file_pdf, 
				TO_CHAR(b.TGL_EVENT, 'MM')BULAN, 
				TO_CHAR(b.TGL_EVENT, 'YYYY')TAHUN
			FROM $DBUser.PENERIMA_EMAIL_BLAST a,
				$DBUser.EMAIL_BLAST_EVENT_TESTING b
			WHERE a.id_blast = b.id_blast
				AND a.ID_BLAST = $id_blast 
				AND a.ID_AUDIENCE =$id_audience";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$file_pdf = $arr["FILE_PDF"];
	$tahun = $arr["TAHUN"];
	$filename = "email/pdf_bpo/$tahun/$file_pdf";

	$sqlu = "UPDATE $DBUser.PENERIMA_EMAIL_BLAST 
			SET tgl_cetak_surat = sysdate, usercetak = '$userid'
			WHERE ID_BLAST = $id_blast 
				AND ID_AUDIENCE =$id_audience";
	$DBU->parse($sqlu);
	$DBU->execute();
?>

<!DOCTYPE html>
<html>
	<body>
		<embed src = "<?=$filename;?>" type = "application / pdf" width="100%" height = "1200px" />
	</body>
</html>