<?  
	include "../../includes/database.php";  
	include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB=new Database($userid, $passwd, $DBName);	
	//$DB2=new Database($userid, $passwd, $DBName);

	if($_POST['save_tglbayar']){
		$sql = "UPDATE $DBUser.TABEL_999_DUPLIKAT SET TGLBAYAR = TO_DATE('".$_POST['tglbayar_']."', 'DD/MM/YY'), NILAIBAYAR = '".$_POST['nilaibayar']."', TGLUPDATED = sysdate, USERUPDATED = '$userid'
				WHERE PREFIXPERTANGGUNGAN = '".$_POST['prefix']."'
					AND NOPERTANGGUNGAN = '".$_POST['noper']."'
					AND TO_CHAR(TGLMUTASI, 'DD/MM/YYYY') = '".$_POST['tglmut']."'
					AND KDSTATUS = '1'
				";
		// echo $sql."</br>";
		// die();
		$DB->parse($sql);
		$DB->execute();
		echo "Update tanggal pembayaran berhasil. </br>";

	}

?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>DAFTAR PROSES POLIS DUPLIKAT <?echo $kantor;?></b></a>
	<hr size=1>
		<div align=center>
		<!--<table>
		<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
		<tr>  
		<td class="verdana10blk">Periode (Mulai Asuransi)</td>
		<td> <?  DateSelector("v"); ?>	</td>
		<td>
		<input type="submit" name="cariproposalkantor" value="CARI">
		</td>
	  	</tr>
		</form>
		</table>-->


			<?
				if($vbln==""){
					$DB=new Database($userid,$passwd,$DBName);
					$thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
					$DB->parse($thnsql);
					$DB->execute();
					$x=$DB->nextrow();
					$thisperiode=$x["NOWBLN"];
					$vthn=substr($thisperiode,-4);
					$bln=substr($thisperiode,0,2);
					$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
				}else if($vbln=="all"){
					$thisperiode="$vthn";
					$periode="to_char(a.mulas,'yyyy')='$thisperiode'";
				}else{
					$bln = substr(("0".$vbln),-2);
					$thisperiode="$bln$vthn";
					$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
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
				/*		  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
				"a.kdstatusmedical,a.kdstatusemail,a.nopol,".
				"to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,".
				"a.userupdated, ".
				"a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
				"to_char(a.mulas,'DD/MM/YYYY') mulas ".
				"from $DBUser.tabel_100_klien b, $DBUser.tabel_200_pertanggungan a ".
				"where a.notertanggung=b.noklien(+) ".
				"and a.prefixpertanggungan='$kantor' ".
				"and a.kdpertanggungan='1' ".
				"and a.kdstatusfile='1' ".
				"and notertanggung is not null and $periode ".
				//"order by a.mulas desc";
				"order by prefixpertanggungan,nopertanggungan"; */
						
						
				if($kantor=='KP'){ //
					$filterkantor=" ";
				} else {
					$filterkantor=" AND kdrayonpenagih='$kantor'  ";
				}
			?>

			<font color="003399" face=verdana size=2><b>Daftar Proposal Kantor <?=$kantor;?> periode <?php echo $bln.' '.$vthn;?></b></font><br>
				<table style="border-collapse:collapse;" border="1" width=100% class=tblisi cellpadding=2 cellspacing=0>
					<tr class=hijao>
						<td align=center>No</td>
						<td align=center>Nomor</td>
						<td align=center>Tertanggung</td>
						<td align=center>Nopol</td>
						<td align=center>Produk</font></b></td>
						<td align=center>M</font></b></td>
						<td align=center>J U A</td>
						<td align=center>Mulas</td>
						<td align=center>Premi</td>
						<td align=center>Tgl. Pengajuan KC</td>
						<td align=center>Tgl. Pengiriman KW</td>
						<td align=center>Tgl. Cetak Duplikat</td>
						<td align=center>Tujuan Duplikat</td>
						<td align=center>Tgl. Pembayaran</td>
						<td align=center>Nilai Pembayaran</td>
			<?
				if($kantor == 'KP'){
					echo "</tr>";
				}else{
					echo "<td align=center>Action</td>
						</tr>";
				}
			
					/*$sql = "select * from (SELECT   a.prefixpertanggungan,
								   a.nopertanggungan,
								   a.kdproduk,
								   a.kdstatusmedical,
								   a.kdstatusemail,
								   a.nopol,
								   TO_CHAR (c.tglmutasi, 'DD/MM/YYYY') tglpengajuan,
								   b.namaklien1,
								   b.gelar,
								   a.userupdated,
								   a.premi1,
								   a.juamainproduk,
								   TO_CHAR (a.tglupdated, 'DD/MM/YYYY') tglupdated,
								   TO_CHAR (a.mulas, 'DD/MM/YYYY') mulas,
								   (SELECT  TO_CHAR (min(tglmutasi), 'DD/MM/YYYY') FROM $DBUser.TABEL_600_HISTORIS_MUTASI_PERT WHERE KDMUTASI=28 
						AND PREFIXPERTANGGUNGAN=c.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN=c.NOPERTANGGUNGAN) tglcetak
							FROM   $DBUser.tabel_100_klien b,
								   $DBUser.tabel_200_pertanggungan a,
								   $DBUser.tabel_603_mutasi_pert c,
								   $DBUser.tabel_500_penagih d
						   WHERE   a.nopenagih=d.nopenagih
	                               ".$filterkantor."  
								   AND a.notertanggung = b.noklien(+)
								   AND notertanggung IS NOT NULL
								   AND TO_CHAR (c.tglmutasi, 'yyyy') >= '2011'
								   AND c.nopertanggungan = a.nopertanggungan
								   AND c.prefixpertanggungan = a.prefixpertanggungan
								   AND c.kdmutasi=41 ORDER BY   c.tglmutasi,prefixpertanggungan, nopertanggungan)";*/

				$sql = "SELECT a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN, a.KDPRODUK, a.KDSTATUSMEDICAL,
							a.KDSTATUSEMAIL, a.NOPOL, TO_CHAR(c.TGLMUTASI, 'dd/mm/yyyy') TGLPENGAJUAN,
							TO_CHAR(e.TGLMUTASI, 'dd/mm/yyyy') TGLPENGAJUANWIL,
							b.NAMAKLIEN1, b.GELAR, a.USERUPDATED, a.PREMI1, a.JUAMAINPRODUK,
							TO_CHAR(a.TGLUPDATED, 'dd/mm/yyyy') TGLUPDATED,
							TO_CHAR(a.MULAS, 'dd/mm/yyyy') MULAS,
							(SELECT TO_CHAR(MIN(TGLMUTASI), 'dd/mm/yyyy')
							 FROM $DBUser.TABEL_600_HISTORIS_MUTASI_PERT
							 WHERE KDMUTASI = 28
								AND PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
								AND NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
								AND substr(keteranganmutasi, -10) = to_char(c.tglmutasi, 'dd/mm/yyyy')) TGLCETAK,
							TO_CHAR(a.TGLCETAK, 'dd/mm/yyyy') TGLCETAK2,
							(SELECT TUJUAN FROM $DBUser.TABEL_999_DUPLIKAT WHERE PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN AND TGLMUTASI = TO_DATE(C.TGLMUTASI, 'DD/MM/YY') AND KDSTATUS = '1') TUJUAN,
							(SELECT TO_CHAR(TGLMUTASI, 'DD/MM/YYYY') FROM $DBUser.TABEL_999_DUPLIKAT WHERE PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN AND TGLMUTASI = TO_DATE(C.TGLMUTASI, 'DD/MM/YY') AND KDSTATUS = '1') TGLMUT,
							(SELECT TO_CHAR(TGLBAYAR, 'DD/MM/YYYY') FROM $DBUser.TABEL_999_DUPLIKAT WHERE PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN AND TGLMUTASI = TO_DATE(C.TGLMUTASI, 'DD/MM/YY') AND KDSTATUS = '1') TGLBAYAR,
							(SELECT NILAIBAYAR FROM $DBUser.TABEL_999_DUPLIKAT WHERE PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN AND TGLMUTASI = TO_DATE(C.TGLMUTASI, 'DD/MM/YY') AND KDSTATUS = '1') NILAIBAYAR
						FROM $DBUser.TABEL_200_PERTANGGUNGAN a
						LEFT OUTER JOIN $DBUser.TABEL_100_KLIEN b ON a.NOTERTANGGUNG = b.NOKLIEN
						INNER JOIN $DBUser.TABEL_603_MUTASI_PERT c ON a.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN
							AND a.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN
						INNER JOIN $DBUser.TABEL_500_PENAGIH d ON a.NOPENAGIH = d.NOPENAGIH
						LEFT OUTER JOIN $DBUser.TABEL_600_HISTORIS_MUTASI_PERT e ON a.PREFIXPERTANGGUNGAN = e.PREFIXPERTANGGUNGAN
							AND a.NOPERTANGGUNGAN = e.NOPERTANGGUNGAN AND TO_CHAR(c.tglmutasi, 'dd/mm/yyyy hh24:mi:ss') = SUBSTR(e.keteranganmutasi, -19)
							AND e.KDMUTASI = '41'
						WHERE NOTERTANGGUNG IS NOT NULL
							$filterkantor
							AND TO_CHAR(c.TGLMUTASI, 'yyyy') >= '2011'
							AND c.KDMUTASI = 41
							AND a.KDSTATUSFILE != '7' 
						ORDER BY c.TGLMUTASI DESC, a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN";
						
				//echo $sql;
				$DB->parse($sql);
				$DB->execute();
						 	 
				$i=1;
				while ($arr=$DB->nextrow()) {
					
					echo "<form name='porm2' method='post' action='".$PHP_SELF."'>";

					$sendemail = $arr["TGLSENDEMAIL"];
					$statusemail = $arr["KDSTATUSEMAIL"];
					$nopertanggungan = $arr["NOPERTANGGUNGAN"];
					$prefix = $arr["PREFIXPERTANGGUNGAN"];
					/*
					switch ($sendemail)
					{
						case "": $sendemail="<font color=red>BELUM</font>"; break;
						default : $sendemail; break; 
					}
					*/
					switch ($statusemail)
					{
						case "": $statusemail="<font color=red>BELUM</font>"; break;
						default : $statusemail="<font color=black>SUDAH</font>"; break; 
					}
								
					include "../../includes/belang.php";	 

					echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
					echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
					echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>");
					echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPOL"]."</font></td>");
					echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
					echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
					echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
					echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
					echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
					echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLPENGAJUAN"]."</font></td>");
					echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLPENGAJUANWIL"]."</font></td>");
					echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLCETAK"]."</font></td>");
					echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TUJUAN"]."</font></td>");

					echo "
							<input type='hidden' name='prefix' value='".$arr['PREFIXPERTANGGUNGAN']."'>
							<input type='hidden' name='noper' value='".$arr['NOPERTANGGUNGAN']."'>
							<input type='hidden' name='tglmut' value='".$arr['TGLMUT']."'>

						";
					if($arr["TGLBAYAR"] === NULL && $kantor != 'KP'){
						echo "
								<td align=center>
									<input type='text' name='tglbayar_' size='11'>
									
								</td>
								<td align=center>
									<input type='text' name='nilaibayar' size='8'>
								</td>
								<td align=center>
									<input type='submit' value=' save ' name='save_tglbayar'>
								</td>
							";
					}else{
						echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLBAYAR"]."</font></td>");
						if($arr["NILAIBAYAR"] === NULL){
							echo("<td align=center><font face=\"Verdana\" size=\"1\"></font></td>");
						}else{
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".number_format($arr["NILAIBAYAR"],2)."</font></td>");	
						}
						
					}
		
					echo("</tr>");
					echo "</form>";
					$i++;

					//$sql_acceptance=" select kdacceptance from tabel_214_acceptance_dokumen ".
					//"where nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and prefixpertanggungan='$prefix' and kdacceptance='1' ";

					//$DB2->parse($sql_acceptance);
					//$DB2->execute();
					//$found=$DB2->nextrow();			
				}
	?>
			</table>
		</div>
	<hr size=1>
	<a class=verdana10blk href="index.php">Menu Pelaporan</a>