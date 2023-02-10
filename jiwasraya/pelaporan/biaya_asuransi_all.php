<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
  include "../../includes/tgl.php";

	$bln = (!$bl) ? $bln : '';
  $DB = new database($userid, $passwd, $DBName);
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
</head>
<body>
<div align="center">
<form method="POST" name="ntryclnthub" action="<? echo $PHP_SELF;?>">
<table width="1000">
  <tr>
    <td align="center" class="arial10blk"><b>INFORMASI BIAYA ASURANSI KANTOR <? echo $kantor; ?></td>
	</tr>
  </table>
<table width="50%" cellpadding="0" cellspacing="0">
 <tr>
    <td align="left" class="arial10" width="45%">Bulan Pembayaran</td>
		<td width="5%">:</td>
		<td width="50%">
		 <select name="bl" onfocus="highlight(event)" class="c">
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
		<select name="th" onfocus="highlight(event)" class="c">
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
			
			?>
		 </select>
		 
		 <input name="cari" value="Submit" type="submit">
		</td>
	</tr> 
	
	<tr>
		<td colspan="3" width="100%" align="left">
		
		</td>
	</tr>
	
</table>
<hr size="1">
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
    <td class="tblhead" align="center"><b>DAFTAR <? echo strtoupper($bar["NAMAPEMBAYARAN"]);?> RAYON PENAGIHAN <? echo $kantor; ?></td>
	</tr>
	<tr>
    <td class="tblisi" align="center">
		  <table  width="100%" border="0" cellspacing="1" cellpadding="1">
			 <tr class="hijao">
			  <td align="center">No</td>
			  <td align="center">Nomor Polis</td>
				<td align="center">Pemegang Polis</td>
				<td align="center">Macas</td>
				<td align="center">Mulas</td>
			  <td align="center">JUA</td>
				<td align="center">Valuta</td>
			  <td align="center">Besar Faedah (Rp)</td>
				<td align="center">Kurs/Indeks Std</td>
			  <td align="center">Kurs/Indeks Byr</td>
				<td align="center">Indeks Dasar</td>
			  <td align="center">No.SIP</td>
			  <td align="center">Tgl.SIP</td>
			  <td align="center">Tgl.Hitung</td>
				<td align="center">Vouchr</td>
				<td align="center">User</td>
				<td align="center">Jns.Bayar</td>
				<td align="center">Cara Bayar</td>
				<td align="center">Besar Premi</td>
				<td align="center">Agen Penutup</td>
			 </tr>
        <?
        $bl = (strlen($bl)==1) ? "0".$bl : $bl;
        $kam = ($bl=='13') ? '' : "to_char(a.tglseatled,'YYYYMM')='".$th.$bl."' and ";
        
        $sql = "select ".
        		   "a.prefixpertanggungan,a.nopertanggungan, ".
        			 "a.nilaipembayaran,a.kursstandar,a.kurstransaksi,a.nomorsip,".
        			 "to_char(a.tglsip,'DD/MM/YYYY') as tglsip,to_char(a.tglhitung,'DD/MM/YYYY') as tglhitung,a.novoucher,a.userrekam, ".
							 "b.jenispembayaran, ".
							 "(select kurs from $DBUser.tabel_999_kurs where tglkursberlaku=".
      	       "(select max(tglkursberlaku) from $DBUser.tabel_999_kurs ".
      	     	 "where tglkursberlaku<=a.tglhitung and kdvaluta='0') ".
      	     	 "and kdvaluta='0' ) indeksdasar ".
							 "from $DBUser.tabel_800_pembayaran_keluar a,".
							 "$DBUser.tabel_801_temp b where ".
        			 $kam.
							 "a.kdpembayaran=b.kdpembayaran and ".
        			 //"a.kdpembayaran='$jns' and ".
							 "a.kdkantor='$kantor'";
        			 
        $DB->parse($sql);
        $DB->execute();
        //echo $sql;
        
        $i=1;
        while ($arr=$DB->nextrow()) {
        $PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
        $jmlpembayaran = $arr["NILAIPEMBAYARAN"];
				include "../../includes/belang.php"; 
          echo "<td class=verdana8blu align=\"center\" width=3%>$i</td>";
          echo "<td class=verdana8blu align=\"left\" nowrap><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
          echo "<td class=verdana8blu>".$PER->namapemegangpolis."</td>";
					echo "<td class=verdana8blu>".$PER->produk."</td>";
					echo "<td class=verdana8blu>".$PER->mulas."</td>";
        	echo "<td class=verdana8blu align=\"right\">".number_format($PER->jua,2,",",".")."</td>";
          echo "<td class=verdana8blu nowrap>".$PER->namavaluta."</td>";
          echo "<td class=verdana8blu align=\"right\">".number_format($arr["NILAIPEMBAYARAN"],2,",",".")."</td>";
          echo "<td class=verdana8blu align=\"right\">".number_format($arr["KURSSTANDAR"],2,",",".")."</td>";
          echo "<td class=verdana8blu align=\"right\">".number_format($arr["KURSTRANSAKSI"],2,",",".")."</td>";
          echo "<td class=verdana8blu align=\"right\">".($PER->valuta==0 ? number_format($PER->indexawal,2,",",".") : "-")."</td>";
          echo "<td class=verdana8blu align=\"center\">".$arr["NOMORSIP"]."</td>";
          echo "<td class=verdana8blu align=\"left\">".$arr["TGLSIP"]."</td>";
        	echo "<td class=verdana8blu align=\"left\">".$arr["TGLHITUNG"]."</td>";
        	echo "<td class=verdana8blu align=\"left\">".$arr["NOVOUCHER"]."</td>";
        	echo "<td class=verdana8blu>".$arr["USERREKAM"]."</td>";
          echo "<td class=verdana8blu>".$arr["JENISPEMBAYARAN"]."</td>";
					echo "<td class=verdana8blu nowrap>".$PER->namacarabayar."</td>";
					echo "<td class=verdana8blu nowrap align=\"right\">".number_format($PER->premi1,2,",",".")."</td>";
					echo "<td class=verdana8blu nowrap>".$PER->namaagen."</td>";
					echo "</tr>";
         $i++;
				 $totalpembayaran += $jmlpembayaran;
        }			 
        ?>
				<tr bgcolor="#ffffff">
				  <td colspan="7" align="center" class="verdana8blk">Jumlah</td>
					<td class="verdana8blk"><?=number_format($totalpembayaran,2,",",".");?></td>
					<td colspan="9" class="verdana8blk"></td>
				</tr>		  
			</table>
    </td>
   </tr>
</table>
<hr size="1">
<table width="1000">
  <tr>
    <td width="100%" align="left"><a href="index.php"><font face="Verdana" size="2">Manajemen Informasi</font></a></td>
	</tr>
</table>

</td>
</tr>

</div>

</body>
</html>