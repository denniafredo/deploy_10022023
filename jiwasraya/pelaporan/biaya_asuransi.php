<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";
  include "../../includes/hari.php";

	$bln = (!$bl) ? $bln : '';
	$DB = new database($userid, $passwd, $DBName);
	$hari = new Hari();
	
	// variable hari libur nasional
	if ($th == 2015) 
		$holiday = array('01/01/2015','03/01/2015','19/02/2015','21/03/2015','03/04/2015','01/05/2015','14/05/2015','16/05/2015','02/06/2015','16/07/2015','17/07/2015','18/07/2015','20/07/2015','21/07/2015','17/08/2015','24/09/2015','14/10/2015','24/12/2015','25/12/2015');
	else if ($th == 2016) 
		$holiday = array('01/01/2016','08/02/2016','09/03/2016','25/03/2016','01/05/2016','05/05/2016','06/05/2016','22/05/2016','04/07/2016','05/07/2016','06/07/2016','07/07/2016','08/07/2016','17/08/2016','12/09/2016','02/10/2016','12/12/2016','25/12/2016','26/12/2016');
	else 
		$holiday = array();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Informasi Laporan Biaya Asuransi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<style type='text/css'>
	.tblborder tr.isi td {
		font-size: 11px;
	}
</style>
</head>
<?
if($act=="cetak"){
?>
<body onLoad="window.print();window.close()">
<? } else { ?>
<body>
<? 
}
?>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table width="1000">
  <tr>
    <td align="center" class="arial10blk"><b>INFORMASI BIAYA ASURANSI KANTOR <? echo $kantor; ?></td>
	</tr>
</table>
<?
if($act!="cetak"){
?>
<table width="50%" cellpadding="0" cellspacing="0">
 <tr>
    <td align="left" class="arial10" width="45%">Bulan Pembayaran</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="bl" onFocus="highlight(event)" class="c">
		  <?
			$bulan = array(1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember','SEMUA');
			for ($i=1; $i<=13; $i++) {
			   if ($i==$bl || $bulan[$i]==$bln) {
				  print( "<option value=$i selected>".$bulan[$i]."</option>" );
				 } else {
				  print( "<option value=$i>".$bulan[$i]."</option>" );
				 }	
			}
			?>
		 </select>
		<select name="th" onFocus="highlight(event)" class="c">
		  <?
			$th=(!$th) ? substr($tanggal,-4) : $th;
			$awalth = 2000;
			for ($i=$awalth; $i<=substr($tanggal,-4); $i++) {
			  if ($i==$th) {
				  print( "<option value=$i selected>$i</option>" );
				} else {
				  print( "<option value=$i>$i</option>" );
				}	
			}
			print( "<option value=$i>$i</option>" );
			?>
		 </select>
		</td>
	</tr> 
	<?
	  //var_dump($bulan);
			$jnsval = array(1=>'gadai','tebus','pulih','klaim');
			$jnslab = array(1=>'Pinjaman Polis','Penebusan Polis','Pemulihan Pertanggungan','Klaim Asuransi');
	?>
  <tr>
    <td align="left" class="arial10" width="45%">Jenis Pembayaran</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="jns" onFocus="highlight(event)" class="c">
		 		<?
				$sql = "select kdpembayaran,namapembayaran,jenispembayaran from $DBUser.tabel_801_temp ".
							 "order by namapembayaran ";
				//echo $sql;
				$DB->parse($sql);
				$DB->execute();
				while ($arr=$DB->nextrow()) {
				  if ($arr["KDPEMBAYARAN"]==$jns) {
				   print( "<option value=\"".$arr["KDPEMBAYARAN"]."\" selected>".$arr["NAMAPEMBAYARAN"]."</option>" );
				 	} else {
				   print( "<option value=\"".$arr["KDPEMBAYARAN"]."\">".$arr["NAMAPEMBAYARAN"]."</option>" );
				  }
				}	
				?>
		 </select>
		</td>
	</tr>
	<tr>
		<td colspan="3" width="100%" align="left">
		<input name="cari" value="Submit" type="submit">
		</td>
	</tr>
	
</table>
<hr size="1">
<?
} //end cetakan
?>
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="1000" align="center">
  <tr>
	  <? 
		$judul=($jns=="gadai") ? "pinjaman polis" : $jns;
		$sql = "select namapembayaran,jenispembayaran from $DBUser.tabel_801_temp where ".
				 	 "kdpembayaran='$jns'";
		$DB->parse($sql);
    $DB->execute();
		$bar=$DB->nextrow();
		?>
    <td class="tblhead" align="center"><b>DAFTAR <? echo strtoupper($bar["NAMAPEMBAYARAN"]);?> RAYON PENAGIHAN <? echo $kantor; ?> BULAN <?=$bl."/".$th; ?></td>
	</tr>
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="1" cellpadding="1">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor Polis</td>
				<td align="center">Pemegang Polis</td>
				<td align="center">Tertanggung</td>
			  <td align="center">JUA</td>
			  <td align="center">Nilai Pembyrn</td>
			  <td align="center">Valuta Polis</td>
			  <td align="center">Kurs</td>
				<td align="center">Macam Asuransi</td>
			  <td align="center">Rekening</td>
			  <td align="center">No.SIP</td>
			  <td align="center">Tgl.SIP</td>
			  <td align="center">Tgl.Hitung</td>
			  <td align="center">Tgl.Pengajuan</td>
			  <td align="center">Tgl.Desisi</td>
				<td align="center">Vouchr</td>
				<td align="center">User</td>
				<td align="center">Jns.Bayar</td>
				<td align="center">Durasi</td>
			 </tr>
        <?
        $bl = (strlen($bl)==1) ? "0".$bl : $bl;
        //$kam = ($bl=='13') ? '' : " AND TO_CHAR(a.tglseatled, 'mmyyyy') = '".$bl.$th."' ";  TO_CHAR(a., 'dd/mm/yyyy')
        $kam = ($bl=='13') ? " AND TO_CHAR(a.tglsip, 'yyyy') = '".$th."' " : " AND TO_CHAR(a.tglseatled, 'mmyyyy') = '".$bl.$th."' ";
        
        /*$sql = "select ".
          		   "a.prefixpertanggungan,a.nopertanggungan,d.kdvaluta,c.kdmatauang,d.kdproduk,c.namavaluta,c.notasi, ".
          			 "a.nilaipembayaran,a.kurstransaksi,a.nomorsip,".
          			 "to_char(a.tglsip,'DD/MM/YYYY') as tglsip,to_char(a.tglhitung,'DD/MM/YYYY') as tglhitung,a.novoucher,a.userrekam, ".
  					 "b.jenispembayaran, ".
  					 "(select nilai from $DBUser.tabel_900_sip where nourut='1' and nomorsip=a.nomorsip) nilaibayar, ".
					 "(select to_char(tglptg,'dd/mm/yyyy') from $DBUser.TABEL_901_PENGAJUAN_KLAIM where nomorsip=a.nomorsip) tgldesisi, ".
          			 "(select to_char(tglpengajuan,'dd/mm/yyyy') from $DBUser.TABEL_901_PENGAJUAN_KLAIM where nomorsip=a.nomorsip) tglpengajuan ".
        			 "from ".
  							 "$DBUser.tabel_800_pembayaran_keluar a,".
  							 "$DBUser.tabel_200_pertanggungan d,".
  							 "$DBUser.tabel_304_valuta c,".
  							 "$DBUser.tabel_801_temp b ".
							 "where ".
          			 $kam.
  							 "d.kdvaluta=c.kdvaluta and d.prefixpertanggungan=a.prefixpertanggungan and d.nopertanggungan=a.nopertanggungan and a.kdpembayaran=b.kdpembayaran and ".
          			 "a.kdpembayaran='$jns' and a.kdkantor='$kantor'";*/
		$sql = "SELECT a.prefixpertanggungan, a.nopertanggungan, b.kdvaluta, c.kdmatauang, b.kdproduk, c.namavaluta,
					c.notasi, a.nilaipembayaran, a.kurstransaksi, a.nomorsip, TO_CHAR(a.tglsip, 'dd/mm/yyyy') tglsip,
					TO_CHAR(a.tglhitung, 'dd/mm/yyyy') tglhitung, a.novoucher,e.rekening1, a.userrekam, d.jenispembayaran, 
					/*e.nilai nilaibayar*/ a.nilaipembayaran nilaibayar,
					/*TO_CHAR(f.tglptg, 'dd/mm/yyyy') tgldesisi, --> change by salman 23/08/2016 --> kalau tebus tidak muncul*/
					TO_CHAR (nvl(f.tglptg,(select TGLotorisasi from $DBUser.tabel_700_tebus where prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan)), 'dd/mm/yyyy') tgldesisi,
					/*TO_CHAR(f.tglpengajuan, 'dd/mm/yyyy') tglpengajuan --> change by salman 23/08/2016 --> kalau tebus tidak muncul*/
					TO_CHAR (nvl(f.tglpengajuan,(select TGLMOHON from $DBUser.tabel_700_tebus where prefixpertanggungan = b.prefixpertanggungan AND nopertanggungan = b.nopertanggungan)), 'dd/mm/yyyy') tglpengajuan
				FROM $DBUser.tabel_800_pembayaran_keluar a
				INNER JOIN $DBUser.tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
					AND a.nopertanggungan = b.nopertanggungan
				INNER JOIN $DBUser.tabel_304_valuta c ON b.kdvaluta = c.kdvaluta
				INNER JOIN $DBUser.tabel_801_temp d ON a.kdpembayaran = d.kdpembayaran
				LEFT OUTER JOIN $DBUser.tabel_900_sip e ON a.nomorsip = e.nomorsip
				LEFT OUTER JOIN $DBUser.tabel_901_pengajuan_klaim f ON a.nomorsip = f.nomorsip 
					AND a.prefixpertanggungan = f.prefixpertanggungan AND a.nopertanggungan = f.nopertanggungan
				WHERE e.nourut = '1'
					$kam
					AND a.kdpembayaran = '$jns'
					AND a.kdkantor = '$kantor'";
        			 
        $DB->parse($sql);
        $DB->execute();
        //echo $sql;
        
        $i=1;
				$val0 = 0;
				$val1 = 0;
				$val3 = 0;
				
        while ($arr=$DB->nextrow()) {
			$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
			$jmlpembayaran = $arr["NILAIPEMBAYARAN"];
			//$nilaibayar = $arr["KDVALUTA"]=="3" ? round($arr["NILAIBAYAR"],2) : round($arr["NILAIBAYAR"],0);
			$nilaibayar = $arr["KURSTRANSAKSI"]>1 ? round($arr["NILAIBAYAR"],2) : round($arr["NILAIBAYAR"],0);
			$durasi = $hari->getWorkingDays($arr['TGLPENGAJUAN'], $arr['TGLSIP'], $holiday);
			$totalkurangdari14hari += $durasi < 14 ? 1 : 0;

			include "../../includes/belang.php";
			echo "<tr class='isi'>";
			echo "<td class=verdana8blu align=\"center\" width=3%>$i</td>";
			echo "<td class=verdana8blu align=\"left\" nowrap><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
			echo "<td class=verdana8blu>".$PER->namapemegangpolis."</td>";
			echo "<td class=verdana8blu>".$PER->namatertanggung."</td>";
			echo "<td class=verdana8blu align=\"right\">".number_format($PER->jua,2,",",".")."</td>";
			echo "<td class=verdana8blu align=\"right\">".number_format($nilaibayar,2,",",".")."</td>";
			echo "<td class=verdana8blu align=\"center\">".$arr["KDMATAUANG"]."</td>";
			echo "<td class=verdana8blu align=\"right\">".number_format($arr["KURSTRANSAKSI"],2,",",".")."</td>";
			//echo "<td class=verdana8blu align=\"center\">".$PER->macas."</td>";
			echo "<td class=verdana8blu align=\"center\">".$arr["KDPRODUK"]."</td>";
			echo "<td class=verdana8blu align=\"center\">".$arr["REKENING1"]."</td>";
			echo "<td class=verdana8blu align=\"center\">".$arr["NOMORSIP"]."</td>";
			echo "<td class=verdana8blu align=\"left\">".$arr["TGLSIP"]."</td>";
			echo "<td class=verdana8blu align=\"left\">".$arr["TGLHITUNG"]."</td>";
			echo "<td class=verdana8blu align=\"left\">".$arr["TGLPENGAJUAN"]."</td>";
			echo "<td class=verdana8blu align=\"left\">".$arr["TGLDESISI"]."</td>";
			echo "<td class=verdana8blu align=\"left\">".$arr["NOVOUCHER"]."</td>";
			echo "<td class=verdana8blu>".$arr["USERREKAM"]."</td>";
			echo "<td class=verdana8blu>".$arr["JENISPEMBAYARAN"]."</td>";
			echo "<td class=verdana8blu align='center' nowrap>$durasi hr</td>";
			echo "</tr>";
         	$i++;
				 
			if($PER->kdvaluta=="0") {
				$jua0 += $PER->jua;
				$totalpembayaran0 += $nilaibayar;
				$val0 ++;
			} elseif ($PER->kdvaluta=="1") {
				$jua1 += $PER->jua;
				$totalpembayaran1 += $nilaibayar;
				$val1 ++;
			} elseif ($PER->kdvaluta=="3") {
				$jua3 += $PER->jua;
				$totalpembayaran3 += $nilaibayar;
				$val3 ++;
			}

			$totalpembayaran += $jmlpembayaran;
        }			 
        ?>
				<tr bgcolor="#ffffff">
				  <td colspan="2" class="verdana8blk">Jumlah VRTI</td>
					<td class="verdana8blk" align="right"><?=$val1;?></td>
					<td class="verdana8blk" align="right"><?=number_format($jua1,2,",",".");?></td>
					<td class="verdana8blk" align="right"><?=number_format($totalpembayaran1,2,",",".");?></td>
					<td colspan="14"></td>
				</tr>		
				<tr bgcolor="#ffffff">
				  <td colspan="2" class="verdana8blk">Jumlah VRDI</td>
					<td class="verdana8blk" align="right"><?=$val0;?></td>
					<td class="verdana8blk" align="right"><?=number_format($jua0,2,",",".");?></td>
					<td class="verdana8blk" align="right"><?=number_format($totalpembayaran0,2,",",".");?></td>
					<td colspan="14"></td>
				</tr>		
				<tr bgcolor="#ffffff">
				  <td colspan="2" class="verdana8blk">Jumlah VA</td>
					<td class="verdana8blk" align="right"><?=$val3;?></td>
					<td class="verdana8blk" align="right"><?=number_format($jua3,2,",",".");?></td>
					<td class="verdana8blk" align="right"><?=number_format($totalpembayaran3,2,",",".");?></td>
					<td colspan="14"></td>
				</tr>
			  	<tr bgcolor="#ffffff">
					<td colspan="2" class="verdana8blk">Prosentase Pencapaian SLA</td>
					<td class="verdana8blk" align="right"><?=($totalkurangdari14hari > 0 ?$totalkurangdari14hari/($i-1)*100 : '')?>%</td>
				</tr>
			</table>
    </td>
   </tr>
</table>
<? 
if($act!="cetak"){
?>
<hr size="1">
<table width="1000">
  <tr>
    <td width="100%" align="left">
		<font face="Verdana" size="2"><?="<a href=# onclick=\"NewWindow('biaya_asuransi.php?act=cetak&jns=".$jns."&bl=".$bl."&th=".$th."','',900,500,1)\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak</a>";?>
		 | <a href="index.php">Manajemen Informasi</a></font></td>
	</tr>
</table>
<? } ?>
</td>
</tr>

</div>

</body>
</html>