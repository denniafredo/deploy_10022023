<?  
	include "../../includes/database.php";  
	include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	include "../../includes/komisiagen.php";
	include "../../includes/pertanggungan.php";
	$DB=new Database($userid, $passwd, $DBName);	
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS KANTOR $kantor</b></a>";
	echo "<hr size=1>";
?>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
		<table>
			<tr>
				<td class="verdana10blk">Periode</td>
				<td> <?  DateSelector("v"); ?>	</td>
			</tr>
			<tr>
				<td class="verdana10blk">Jenis Filter</td>
				<td>
					<select name="jenis_filter" size="1">
						<option value="a.mulas" <?php echo($jenis_filter == 'a.mulas')?'selected' : '';?>>Mulai Asuransi</option>
						<option value="a.tglcetak" <?php echo($jenis_filter == 'a.tglcetak')?'selected' : '';?>>Cetak Polis</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="caripoliskantor" value="CARI"></td>
			</tr>
		</table>
	</form>

	<?
	if ($caripoliskantor){
  		echo "<hr size=1>";
		echo "<div align=center>";

		if($vbln==""){

			$thnsql = "SELECT to_char(sysdate,'MMYYYY') nowbln FROM dual";
			$DB->parse($thnsql);
			$DB->execute();
			$x=$DB->nextrow();
			$thisperiode=$x["NOWBLN"];
			$vthn=substr($thisperiode,-4);
			$bln=substr($thisperiode,0,2);
			//$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
			//$periode = "a.mulas = to_date('$thisperiode','MMYYYY')";
			$periode = "to_char($jenis_filter,'MMYYYY') = '$thisperiode'";
		} elseif($vbln=="all"){
			$thisperiode="$vthn";
			$periode="to_char($jenis_filter,'yyyy')='$thisperiode'";
			//$periode = "a.mulas = to_date('$thisperiode','YYYY')";
		} else {
			$bln = substr(("0".$vbln),-2);
			$thisperiode="$bln$vthn";
			//$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
			//$periode = "a.mulas = to_date('$thisperiode','MMYYYY')";
			$periode = "to_char($jenis_filter,'MMYYYY') = '$thisperiode'";
		}

		switch ($bln)	{
			case "01": $bln = "Januari"; break;
			case "02": $bln = "Pebruari"; break;
			case "03": $bln = "Maret"; break;
			case "04": $bln = "April"; break;
			case "05": $bln = "Mei"; break;
			case "06": $bln = "Juni"; break;
			case "07": $bln = "Juli"; break;
			case "08": $bln = "Agustus"; break;
			case "09": $bln = "September"; break;
			case "10": $bln = "Oktober"; break;
			case "11": $bln = "Nopember"; break;
			case "12": $bln = "Desember"; break;
        }
				
		if($kantor == 'KP'){
			$filterkantor = "";
		}else{
			$filterkantor = "AND c.kdrayonpenagih='".$kantor."'";
		}
 	?>
 		<font color="003399" face=verdana size=2><b>Daftar Polis Kantor <?=$kantor;?> Periode <?=$bln;?> <?=$vthn;?></b></font><br><br>
		<table>
			<tr class="hijao" align="center">
				<td><b>No</b></td>
				<td><b>Nomor Polis</b></td>
				<td><b>Tertanggung</b></td>
				<td><b>Pemegang Polis</b></td>
				<td><b>Produk</b></td>
				<td><b>Mulai</b></td>
				<td><b>Expirasi</b></td>
				<td><b>Med</b></td>
				<td><b>Cara Bayar</b></td>
				<td><b>JUA</b></td>
				<td><b>Premi</b></td>
				<td><b>Top Up Berkala</b></td>
				<td><b>Top Up Sekaligus</b></td>
				<td><b>No. Agen</b></td>
				<td><b>Status Polis</b></td>
				<td><b>Tgl Cetak</b></td>
				<td><b>Tgl Verifikasi</b></td>
				<td><b>Tgl Kirim</b></td>
				<td><b>Nomor Resi</b></td>
			</tr>
	<?php
		$sql = "SELECT a.prefixpertanggungan,
					a.nopertanggungan, 
					NVL(a.nopolbaru, a.prefixpertanggungan||a.nopertanggungan) nopolis, 
					a.kdproduk,
					a.noagen,
					a.kdstatusmedical,
					to_char(a.expirasi,'DD/MM/YYYY') expirasi,
					a.nobp3,
					to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,
					b.namaklien1,
					b.gelar,
					a.userupdated,
					to_char(a.tglrekam,'DD/MM/YYYY') tglrekam,
					a.indexawal,
					a.premi1,
					a.premi2, 
					a.premistd, 
					a.juamainproduk,
					to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,
					to_char(a.mulas,'DD/MM/YYYY') mulas,
					a.juamainproduk,
					decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta,
					d.namacarabayar,
					e.namastatusfile,
					/* Tambahan query untuk tracking cetak polis sentralisasi */
					to_char(a.tglcetak, 'DD/MM/YYYY') tglcetak,
					to_char(f.tglverifikasi, 'DD/MM/YYYY') tglverifikasi, 
					to_char(f.tglkirim, 'DD/MM/YYYY') tglkirim, 
					f.noresi, 
					/* selesai */
					(SELECT komisiagencb 
						FROM $DBUser.tabel_404_temp 
						WHERE prefixpertanggungan=a.prefixpertanggungan 
							AND nopertanggungan=a.nopertanggungan 
							AND thnkomisi='1' 
							AND kdkomisiagen='01'
					) komisiagen,
					(SELECT premi 
						FROM $DBUser.tabel_223_transaksi_produk 
						WHERE prefixpertanggungan = a.prefixpertanggungan 
							AND nopertanggungan = a.nopertanggungan 
							AND kdbenefit = 'BNFTOPUP'
					) topup_berkala,
                    (SELECT premi 
                    	FROM $DBUser.tabel_223_transaksi_produk 
                    	WHERE prefixpertanggungan = a.prefixpertanggungan 
                    		AND nopertanggungan = a.nopertanggungan 
                    		AND kdbenefit = 'BNFTOPUPSG'
                    ) topup_sekaligus
       			FROM $DBUser.tabel_200_pertanggungan a
				LEFT JOIN $DBUser.tabel_100_klien b ON a.notertanggung = b.noklien
				LEFT JOIN $DBUser.tabel_500_penagih c ON a.nopenagih = c.nopenagih 
				LEFT JOIN $DBUser.tabel_305_cara_bayar d ON a.kdcarabayar = d.kdcarabayar
				LEFT JOIN $DBUser.tabel_299_status_file e ON e.kdstatusfile = a.kdstatusfile
				LEFT JOIN $DBUser.tabel_214_verify_cetak_polis f ON f.prefixpertanggungan = a.prefixpertanggungan AND f.nopertanggungan = a.nopertanggungan
           		WHERE a.kdpertanggungan='2' 
           			AND a.notertanggung is not null
           			".$filterkantor."
					AND ".$periode."
				ORDER BY a.prefixpertanggungan,a.nopertanggungan";
		// echo $sql;
		//die;
		$DB->parse($sql);
		$DB->execute();

		$i=1;
		while ($arr=$DB->nextrow()) {
			/*
				$sendemail = $arr["TGLSENDEMAIL"];
				$nopertanggungan = $arr["NOPERTANGGUNGAN"];
				$prefix = $arr["PREFIXPERTANGGUNGAN"];
			    switch ($sendemail)
			    {
			       case "": $sendemail="<font color=red>BELUM</font>"; break;
			       default : $sendemail; break; 
			    }
			*/
			//$KAG=new KomisiAgen($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
			if($arr["NAMASTATUSFILE"]=="DELETE"){
			}else{
				include "../../includes/belang.php";	 
				echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
				// echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["NOPOLBARU"]."</font></td>");
				echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["NOPOLIS"]."</a></td>");

				echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
				$PER=new Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
				echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$PER->namapemegangpolis."</font></td>");
				echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
				
				// echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOBP3"]."</font></td>");
				
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
				echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");

				// echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAVALUTA"]."</font></td>");      
				echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
				echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMISTD"],2)."
					</font></td>");
				echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["TOPUP_BERKALA"],2)."</font></td>");
				echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["TOPUP_SEKALIGUS"],2)."</font></td>");
				// echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
				// echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI2"],2)."</font></td>");
				// echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["INDEXAWAL"],2)."</font></td>");
				// echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["KOMISIAGEN"],2)."</font></td>");
				echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["NOAGEN"]."</font></td>");
				echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["NAMASTATUSFILE"]."</font></td>");
				//Tambahan untuk menu tracking cetak polis sentralisasi
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLCETAK"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLVERIFIKASI"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLKIRIM"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["NORESI"]."</font></td>");
				//echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($KAG->jmlkomisiagen,2)."</font></td>");       
				//echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLREKAM"]."</font></td>");
				echo("</tr>");
							
				$i++; 
			}
		}				 
        echo("</table>");
		echo "</div>";
?>
	<br />
	<font face="Verdana" size="2"><b>SUMMARY</b></font>
	<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse;" bordercolor="#C0C0C0" id="AutoNumber1">
		<tr>
			<td width="20%" rowspan="2" align="center" bgcolor="#569BD3">
				<b><font color="#FFFFFF" face="Verdana" size="1">Valuta</font></b>
			</td>
			<td width="80%" colspan="4" align="center" bgcolor="#569BD3">
				<b><font color="#FFFFFF" face="Verdana" size="1">Jumlah</font></b>
			</td>
		</tr>
		<tr>
			<td width="20%" align="center" bgcolor="#569BD3">
				<b><font color="#FFFFFF" face="Verdana" size="1">Polis</font></b>
			</td>
			<td width="20%" align="center" bgcolor="#569BD3">
				<b><font color="#FFFFFF" face="Verdana" size="1">Premi1</font></b>
			</td>
			<td width="20%" align="center" bgcolor="#569BD3">
				<b><font color="#FFFFFF" face="Verdana" size="1">Premi2</font></b>
			</td>
			<td width="20%" align="center" bgcolor="#569BD3">
				<b><font color="#FFFFFF" face="Verdana" size="1">JUA</font></b>
			</td>
		</tr>
		<?
			$sql = "SELECT b.namavaluta,
						a.kdvaluta,count(a.nopertanggungan) as jpolis,
						sum(a.premi1) as jpremi1, sum(a.premi2) as jpremi2,
						sum(a.juamainproduk) as jjua 
					FROM $DBUser.tabel_200_pertanggungan a, 
						$DBUser.tabel_304_valuta b,
						$DBUser.tabel_500_penagih c 
					WHERE a.nopenagih=c.nopenagih 
						AND a.kdvaluta=b.kdvaluta 
						".$filterkantor."
						AND a.kdpertanggungan='2' 
						AND a.kdstatusfile<>'7' 
						AND notertanggung is not null 
						AND $periode 
					group by a.kdvaluta,b.namavaluta";
			// echo $sql;			 
			$DB->parse($sql);
			$DB->execute();
			while ($arr=$DB->nextrow()) {
					   
				echo "<tr>";
					echo " <td><font face=Verdana size=1><b>".$arr["NAMAVALUTA"]."</b></td>";
					echo " <td align=right><font face=Verdana size=1>".$arr["JPOLIS"]."</td>";
					echo " <td align=right><font face=Verdana size=1>".number_format($arr["JPREMI1"],2,",",".")."</td>";
					echo " <td align=right><font face=Verdana size=1>".number_format($arr["JPREMI2"],2,",",".")."</td>";
					echo " <td align=right><font face=Verdana size=1>".number_format($arr["JJUA"],2,",",".")."</td>";
				echo "</tr>";

			}
		?>
	</table>
<?
	}					 
?>
	<hr size=1>
	<a class=verdana10blk href="index.php">Menu Pelaporan</a>
	<a href=infoproposalkantor_all.php>.</a>
