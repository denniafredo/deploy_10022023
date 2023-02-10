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
		<h4>SMS AKTIVASI NOMOR VIRTUAL ACCOUNT (VA) POLIS TERGADAI</h4>
		<form name="prosessms" method="post" action="#">
			<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
				<tr bgcolor="#b1c8ed" align="center">
					<td width="2%"><b>No</b></td>
					<td width="10%"><b>NOMOR POLIS</b></td>
					<td width="10%"><b>EMAIL</b></td>
					<td width="7%"><b>NO. HP</b></td>
					<td width="50%"><b>PESAN</b></td>
					<td><b>KDVALUTA</b></td>
					<td><b>SISA PINJAMAN</b></td>
					<td><b>TANGGAL</b></td>
					<td width="4%"><b>CHECK<input type="checkbox" name="xx" onClick="Cekbok(this.form.xx.checked);" /></b></td>
				</tr>
				<?
					$sql="SELECT 
							a.prefixpertanggungan, 
							a.nopertanggungan,
							e.namaklien1,
							a.kdvaluta,
							'0' as STATUS,
							'VA' as JENIS,
							'BNI' as KDBANK,
							'BNI PUSAT' as CABANGBANK,
							NULL TGLEXPIRASI,
							'98855085'||substr(a.nopertanggungan, 2, 8) as noaccount,
							'55085' as CID,
							g.kdkantor||'-'||e.namaklien1 as keterangan,
							NVL(e.NO_PONSEL, nvl(e.PHONETETAP02,nvl(e.PHONETAGIH02,nvl(e.PHONETETAP01,e.PHONETAGIH02)))) PHONE,
							NVL(e.EMAILTAGIH,e.EMAILTETAP) EMAIL,
							'Kepada Yth. Nasabah Gadai Polis '|| a.prefixpertanggungan ||'-'||a.nopertanggungan ||  ', Untuk pelunasan gadai sekarang dapat menggunakan nomor Virtual Account (VA) '|| '98855085'||substr(a.nopertanggungan, 2, 8) ||'. Info 021-1500151' AS MESSAGE,
							SYSDATE AS TGLREKAM,
							'' EXPIREDDATE,
							'J' KDSMS,
							(SELECT JENISSMS FROM $DBUser.TABEL_200_KODE_SMS WHERE KDSMS = 'J') JENISSMS,
							TO_CHAR(SYSDATE, 'DD/MM/YYYY') TGL,
							'MSCM' DIVISI,
							C.NOPOL AS NOMORPOLIS,
							CASE
								WHEN a.kurs > 1 THEN ((f.saldopinjaman + NVL(f.kapitalisasi, 0) + NVL(f.bunga, 0) - NVL(f.angsuranpokok, 0)) * (select kurs from $DBUser.tabel_999_kurs_transaksi where kdvaluta='3' and tglkursberlaku = (select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi where kdvaluta='3'))) 
								WHEN a.kurs = 1 THEN (f.saldopinjaman + NVL(f.kapitalisasi, 0) + NVL(f.bunga, 0) - NVL(f.angsuranpokok, 0))
								WHEN a.kurs is Null THEN (f.saldopinjaman + NVL(f.kapitalisasi, 0) + NVL(f.bunga, 0) - NVL(f.angsuranpokok, 0))
							END AS AMOUNT,
							CASE
								WHEN a.kurs > 1 THEN ((f.saldopinjaman + NVL(f.kapitalisasi, 0) - NVL(f.angsuranpokok, 0)) * (select kurs from $DBUser.tabel_999_kurs_transaksi where kdvaluta='3' and tglkursberlaku = (select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi where kdvaluta='3'))) 
								WHEN a.kurs = 1 THEN (f.saldopinjaman + NVL(f.kapitalisasi, 0) - NVL(f.angsuranpokok, 0))
								WHEN a.kurs is Null THEN (f.saldopinjaman + NVL(f.kapitalisasi, 0) - NVL(f.angsuranpokok, 0))
							END AS AMOUNTPOKOK,
							CASE
								WHEN a.kurs > 1 THEN ((NVL(f.bunga, 0)) * (select kurs from $DBUser.tabel_999_kurs_transaksi where kdvaluta='3' and tglkursberlaku = (select max(tglkursberlaku) from $DBUser.tabel_999_kurs_transaksi where kdvaluta='3'))) 
								WHEN a.kurs = 1 THEN (NVL(f.bunga, 0))
								WHEN a.kurs is Null THEN (NVL(f.bunga, 0))
							END AS AMOUNTBUNGA,
							CASE
								WHEN (select count(nopertanggungan) from $DBUser.tabel_700_gadai_account where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) < 1 THEN '2' 
								WHEN (select status from $DBUser.tabel_700_gadai_account where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) = 1 THEN '1'
								WHEN (select status from $DBUser.tabel_700_gadai_account where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan = a.nopertanggungan) = 0 THEN '0'
							END AS STATUSVA,
							to_char(a.tglrekam,'DD/MM/YYYY') tglmohon, 
							to_char(a.tglotorisasi,'DD/MM/YYYY') tglotorisasi,
							b.namastatus, 
							a.status as statusgadai
						FROM $DBUser.tabel_200_pertanggungan c, 
							$DBUser.tabel_700_gadai a, 
							$DBUser.tabel_500_penagih d, 
							$DBUser.tabel_999_kode_status b, 
							$DBUser.tabel_100_klien e,
							$DBUser.tabel_701_pelunasan_gadai f,
							$DBUser.tabel_001_kantor g
						WHERE 
							a.prefixpertanggungan=c.prefixpertanggungan 
							and a.nopertanggungan=c.nopertanggungan and c.nopenagih=d.nopenagih 
							and a.prefixpertanggungan = g.kdkantor
							and d.kdrayonpenagih in ( SELECT kdkantor FROM $DBUser.TABEL_001_KANTOR START WITH KDKANTOR = 'KP' CONNECT BY PRIOR KDKANTOR = KDKANTORINDUK ) 
							and a.status=b.kdstatus and c.nopemegangpolis = e.noklien
							and a.prefixpertanggungan=f.prefixpertanggungan and a.nopertanggungan=f.nopertanggungan
							and a.tglgadai = (select max(tglgadai) from $DBUser.tabel_700_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and status='3' group by nopertanggungan)
							and a.tglgadai = f.tglgadai
							and b.jenisstatus='GADAI'
							and a.status = '3'
							and c.kdstatusfile = '1'
							and f.tglrekam = (SELECT max(tglrekam) from $DBUser.tabel_701_pelunasan_gadai where prefixpertanggungan = a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and tglgadai=a.tglgadai group by nopertanggungan)
						order by a.prefixpertanggungan,a.nopertanggungan asc";
					//echo $sql;
					$DB->parse($sql);
					$DB->execute();
					$i=1;
					while ($row=$DB->nextrow()) {
						//if ($row["PHONE"]=='' ||$row["PHONE"]=='0' || $row["PHONE"]=='*' || $row["PHONE"]=='-'){

						//}else{
							echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
				?>
							<td align="center"><?=$i;?></td>
							<td align="center"><?=$row["PREFIXPERTANGGUNGAN"];?>-<?=$row["NOPERTANGGUNGAN"];?></td>
							<td><?=$row["EMAIL"];?></td>
							<td><?=$row["PHONE"];?></td>
							<td><?=$row["MESSAGE"];?></td>
							<td align="center"><?=$row["KDVALUTA"];?></td>
							<td align="center"><?=number_format($row["AMOUNT"],2,',','.');?></td>
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
					//}
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