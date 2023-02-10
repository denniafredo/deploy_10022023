<? 
	set_time_limit(10000001);
	include "../../includes/session.php"; 
	include "../../includes/database.php"; 
	include "../../includes/month_selector.php";
	include "../../includes/fungsi.php";
	include "../../includes/koneksi.php";

	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
	if ($approve) {
		$box=$checkanuitas;
		$box_count=count($box);	
		if (($box_count)<1){
			//echo "No Data Updated !";
		}
		else{				
	    	foreach ($box as $dear) {
				$ket = explode('!',$dear);					
																
				$mysqlins="INSERT INTO smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) 
							VALUES('".$ket[0]."','".$ket[1]."','".$ket[4]."','".$ket[5]."','".$ket[6]."','".$ket[7]."')";
				//echo $mysqlins."<br>";
				if(mysql_query($mysqlins)){
					$sqlselect=" INSERT INTO $DBUser.tabel_200_sms (PHONE, MESSAGE, TGLREKAM, EXPIREDDATE, KDSMS, STATUS, TGLBOOKED, KDKANTOR, DIVISI, NOMORPOLIS)
								VALUES('".$ket[0]."','".$ket[1]."',sysdate, '' ,'".$ket[2]."', '1',TO_DATE('".$ket[3]."', 'DD/MM/YYYY'), '".$ket[5]."', '".$ket[6]."', '".$ket[7]."')";
					echo $sqlselect."<br>";	
					$DB1->parse($sqlselect);
					$DB1->execute();
				}
			}					
		} 
?>

<?
	echo $box_count." sms berhasil terkirim...<br>";
	print( "<script language=\"JavaScript\" type=\"text/javascript\">\n" );
	print( "<!--\n" );										  
	print( "window.close();" );
	print( "//-->\n" );
	print( "</script>\n" );
	}else{
		
	
?>
<script language="JavaScript"> 
	function Cekbok(doc){ 
		if (doc == true)
		{
			checkedAll('prosessms', true);
		}
		else
		{
			checkedAll('prosessms', false);
		}
	} 
</script>
<script>
	function checkedAll (id, checked) {
		var el = document.getElementById(id);
		for (var i = 0; i < el.elements.length; i++) {
			el.elements[i].checked = checked;
		}
	}
</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>	
	<title>Daftar SMS Pengkinian Data Nasabah Anuitas</title>
	<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<body topmargin="10">
		<h4>SMS PENGKINIAN DATA NASABAH POLIS ANUITAS</h4>
		<form name="prosessms" method="post" action="#">
			<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
				<tr bgcolor="#b1c8ed" align="center">
					<td width="2%"><b>No</b></td>
					<td width="10%"><b>NO. HP</b></td>
					<td width="50%"><b>PESAN</b></td>
					<td><b>JENIS ANUITAS</b></td>
					<td width="10%"><b>NOMOR POLIS</b></td>
					<td><b>TANGGAL</b></td>
					<td width="4%"><b>CHECK<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></b></td>
				</tr>
				<?
					$sql="SELECT NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETAGIH02,nvl(PHONETETAP01,PHONETAGIH02)))) PHONE,
							'Kepada Yth. Pemegang Polis Anuitas, Saatnya konfirmasi ulang polis anda : Segera Update Alamat Rumah&HP terkini anda ke Jiwasraya terdekat. Info 021-1500151' AS MESSAGE,
							SYSDATE AS TGLREKAM,
							'' EXPIREDDATE,
							'A' KDSMS,
							(SELECT JENISSMS FROM $DBUser.TABEL_200_KODE_SMS WHERE KDSMS = 'A') JENISSMS,
							TO_CHAR(SYSDATE, 'DD/MM/YYYY') TGL,
							'MSCM' DIVISI,
							d.KDRAYONPENAGIH AS KDKANTOR,
							a.NOPOL AS NOMORPOLIS,
							a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN,  a.KDPRODUK, b.NAMAPRODUK, a.MULAS, a.EXPIRASI, a.KDVALUTA, a.KDSTATUSFILE, c.NAMAKLIEN1, NVL(c.EMAILTETAP, c.EMAILTAGIH) EMAIL
						FROM $DBUser.TABEL_200_PERTANGGUNGAN a,
							$DBUser.TABEL_202_PRODUK b,
							$DBUser.TABEL_100_KLIEN c,
							$DBUser.TABEL_500_PENAGIH d
						WHERE a.nopertanggungan IS NOT NULL
							 AND a.KDPRODUK IN ('AI0N', 'AEP3', 'AEP1', 'AEP2', 'AI0BNI', 'ASIBNI', 'ASPBNI', 'AEP', 'AIP', 'AI0', 'ASI', 'ASP', 'AI0B', 'ASIB', 'ASPB', 'AI0NB')
							AND a.KDPRODUK = b.KDPRODUK
							AND a.NOPEMEGANGPOLIS = c.NOKLIEN
							AND a.NOPENAGIH = d.NOPENAGIH
							--AND b.NAMAPRODUK LIKE 'ANUITAS%'
							--AND a.NOPERTANGGUNGAN = '002365598'
							AND a.KDSTATUSFILE IN ('1', '6', '8', '9')
						ORDER BY a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN ASC ";
					//echo $sql;
					$DB->parse($sql);
					$DB->execute();
					$i=1;
					while ($row=$DB->nextrow()) {
						if ($row["PHONE"]=='' ||$row["PHONE"]=='0' || $row["PHONE"]=='*' || $row["PHONE"]=='-'){

						}else{
							echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
				?>
							<td align="center"><?=$i;?></td>
							<td><?=$row["PHONE"];?></td>
							<td><?=$row["MESSAGE"];?></td>
							<td align="center"><?=$row["NAMAPRODUK"];?></td>
							<td align="center"><?=$row["NOMORPOLIS"];?></td>
							<td align="center"><?=$row["TGL"];?></td>
							<td align="center">
						<?
							if($row["PHONE"]=='' ||$row["PHONE"]=='0'){
						?>
								N/A
						<?
							}
							else
							{
						?>
								<input type="checkbox" name="checkanuitas[]" value="<?=$row["PHONE"]."!".$row["MESSAGE"]."!".$row["KDSMS"]."!".$row["TGL"]."!".$row["JENISSMS"]."!".$row["KDKANTOR"]."!".$row["DIVISI"]."!".$row["NOMORPOLIS"]; ?>">
						<?
							}
						?>
							</td>
						</tr>
				<? 
						$i++;
					}
						}
						
				?>
				<tr>
					<td colspan="4"></td>
					<td colspan="4" align="right">
						<input name="approve" type="submit" value="Kirim sms" />
					</td>
				</tr>
			</table>
		</form>
		<hr size="1" color="#c0c0c0">
	<? }
		include "footer.php"; ?>
	</body>
</html>