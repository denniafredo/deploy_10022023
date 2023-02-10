<?php
	include "../../includes/session.php";
	include "../../includes/database.php";
	$DB = New database($userid, $passwd, $DBName);

	if ($lanjut) {
		$sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = NULL, keterangan = NULL
				WHERE nopertanggungan = '$lanjut'";
		$DB->parse($sql);
	    $DB->execute();

	    // Tambahan untuk mencatat di historis underwriting - Teguh (08/11/2019)
	    $sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
	              VALUES ('$prefixpertanggungannew', '$lanjut', 'Lanjut',  '-', '-', '-', sysdate, '$userid')";
	    $DB->parse($sqlip);
	    $DB->execute();
	    // End Tambahan - Teguh (08/11/2019)
	}
?>

<html>
<head>
    <link type="text/css" href="./jws.css" rel="stylesheet" />
    <link type="text/css" href="../jquery/demos.css" rel="stylesheet" />
	<style type='text/css'>
	body {
		font-family:verdana;
		font-size:12px;
	}
	</style>
    <script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
    <title>Tunda Proposal <?="$prefixpertanggungan-$nopertanggungan"?></title>
</head>

<body>
    <font face="Verdana" size="2"><b>DAFTAR PENDING APPROVAL PROPOSAL</b></font><br>
	Kantor : <?echo $kantor; ?>
	
	<br><br>
	<form name="xxx" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
	<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
	<tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="4" align="center"><p align="center"><font face="Verdana" size="1"><b>NAMA / HANDPHONE</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JML UANG ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MAC ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MED</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CARA BAYAR</b></font></td>
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOP UP</b></font></td>
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA TERM</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA CI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>KETERANGAN</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>Opsi</b></font></td>
   </tr>
   <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>HP PEMPOL</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
   </tr>
   <?php
	$sql = "select a.suspend, a.keterangan, 
				a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk, a.nopemegangpolis, 
				a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.usia_th,
				a.lamaasuransi_th,a.premi1,
				(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,
				decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, 
				NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g 
					where a.prefixpertanggungan = g.prefixpertanggungan 
						and a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') 
					having sum(nilaipembayaran) > 0),0) nilaipembayaran, 
				(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, 
				(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, 
				(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, 
				(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt, 
				(select nilaibenefit from $DBUser.tabel_223_transaksi_produk 
					where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
						and kdbenefit='TERM') UATERM, 
				(select nilaibenefit from $DBUser.tabel_223_transaksi_produk 
					where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
						and substr(kdbenefit,1,2)='CI') UACI, 
				to_char(a.tglupdated,'DD/MM/YYYY HH:MI:SS') tglupdated, 
				(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=a.kdcarabayar) carabayar 
			from $DBUser.tabel_200_pertanggungan a 
			where a.kdstatusemail='1' 
				AND substr(a.kdproduk,1,3) not in ('JL4') 
				AND a.nopenagih is not null 
				AND a.premi1 != '0' 
				AND a.kdstatusmedical in ('M','N') 
				AND a.kdpertanggungan = '1' 
				AND a.kdstatusfile = '1' 
				AND a.prefixpertanggungan = '$kantor'
				AND NOT EXISTS (select 'x' from $DBUser.TABEL_214_UNDERWRITING
					where prefixpertanggungan=a.prefixpertanggungan 
						and nopertanggungan=a.nopertanggungan ) 
				AND NOT EXISTS (SELECT 'x' FROM $DBUser.TABEL_300_HISTORIS_PREMI 
					WHERE prefixpertanggungan = a.prefixpertanggungan
						AND nopertanggungan = a.nopertanggungan
						and kdkuitansi='BP3' and tglseatled is not null) 
				AND a.suspend = '1'
				
				UNION ALL
				
			select a.suspend, a.keterangan, 
				a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,a.nopemegangpolis,
				a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,usia_th,
				a.lamaasuransi_th,a.premi1,
				(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,
				decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, 
				NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g 
					where  a.prefixpertanggungan = g.prefixpertanggungan 
						and a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') 
					having sum(nilaipembayaran) > 0),0) nilaipembayaran, 
				(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup,
				(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, 
				(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, 
				(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt, 
				NULL,
				(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK 
					WHERE prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan 
						and substr(kdbenefit,1,2)='CI') UACI, 
				to_char(a.tglupdated,'DD/MM/YYYY HH:MI:SS') tglupdated, 
				(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar = a.KDCARABAYAR) cara_bayar 
			from $DBUser.tabel_200_pertanggungan a 
			where a.kdstatusemail='1' 
				AND substr(a.kdproduk,1,3) in ('JL4') 
				AND a.nopenagih is not null 
				AND a.premi1 != '0' 
				AND a.kdstatusmedical in ('N','M') 
				AND a.kdpertanggungan = '1' 
				AND a.kdstatusfile = '1' 
				AND a.prefixpertanggungan = '$kantor'
				AND NOT EXISTS (select 'x' from $DBUser.TABEL_214_UNDERWRITING
					where prefixpertanggungan=a.prefixpertanggungan 
						and nopertanggungan=a.nopertanggungan ) 
				AND NOT EXISTS (SELECT 'x' FROM $DBUser.TABEL_300_HISTORIS_PREMI 
					WHERE prefixpertanggungan = a.prefixpertanggungan
						AND nopertanggungan = a.nopertanggungan
						and kdkuitansi='BP3' and tglseatled is not null)
				AND a.suspend = '1'
			ORDER BY prefixpertanggungan, nopertanggungan ";
			//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	while($arr=$DB->nextrow()){
		$i = 0;
		$i = $count + 1;
		switch ($arr["KDSTATUSMEDICAL"]) {
			case 'N' :  $statusmedical = "<font color=blue><b>N</b></font>"; break;
			case 'M' :  $statusmedical = "<font color=red><b>M</b></font>"; break;
		}
		?>
		<tr>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
			<td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?><?// echo $arr["PMGPOL"]; ?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$nohp;?></font></td>
			<td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATT"];?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["USIA_TH"];?></font></td>
			<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; $grandtotal;?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["CARABAYAR"];?></font></td>
			<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
			<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["TOPUP"],2); ?></font></td>
			<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["UATERM"],2); ?></font></td>
			<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["UACI"],2); ?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KETERANGAN"];?></font></td>
			<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1">
				<?php if ($arr['SUSPEND']) { ?>
					<input type="hidden" name="lanjut" value="<?=$arr['NOPERTANGGUNGAN'];?>" />
					
					<!-- Tambahan untuk mencatat di historis underwriting - Teguh (08/11/2019) -->
					<input type="hidden" name="nopertanggungannew" value="<?=$arr['NOPERTANGGUNGAN'];?>" />
					<input type="hidden" name="prefixpertanggungannew" value="<?=$arr['PREFIXPERTANGGUNGAN'];?>" />
					<!-- End Tambahan - Teguh (08/11/2019) -->

					<input type="button" name="kirim" onclick="window.location.href='?lanjut=<?=$arr['NOPERTANGGUNGAN']?>&prefixpertanggungannew=<?=$arr['PREFIXPERTANGGUNGAN']?>';" value="Lanjut" style="padding:0px;margin:0px;" />
					<!--button type="submit" name="lanjut" value="<?=$arr['NOPERTANGGUNGAN'];?>" style="padding:0px;margin:0px;">
						<font face="Verdana" size="1">Lanjut</font>
					</button-->
				<?php } ?>
			</font></td>
		</tr>
		<?php
		$count++;
	}
	?>
   </table>
   </form>
   
   <hr size="1" />
   <font face="verdana" size="2"><a href="akseptasi_underwriting.php">Back</a></font>
</body>
</html>