<?  
	include "../../includes/database.php";  
	include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB=new Database($userid, $passwd, $DBName);	
	//$DB2=new Database($userid, $passwd, $DBName);

?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>PROPOSAL MASUK KANTOR <?echo $kantor;?></b></a>
	<hr size=1>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
		<table>
			<tr>  
				<td class="verdana10blk">Periode (Mulai Asuransi)</td>
				<td> <?  DateSelector("v"); ?>	</td>
				<td>
					<input type="submit" name="cariproposalkantor" value="CARI">
				</td>
		  	</tr>
			
		</table>
	</form>

	<hr size=1>
	<div align=center>

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

		/*
		$sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
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
				"order by prefixpertanggungan,nopertanggungan"; 
		*/

		if($kantor=="KP") { 
			$wherektr="";
		} else {
			$wherektr="and d.kdrayonpenagih='$kantor' ";
		}
									 
		$sql = "SELECT a.prefixpertanggungan, 
					a.nopertanggungan, 
					NVL(a.nopolbaru, a.prefixpertanggungan||a.nopertanggungan) nopolis, 
					a.kdproduk,
					a.kdstatusmedical,
					a.kdstatusemail,
					a.nopol,
					to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,
					b.namaklien1,
					b.gelar,
					a.userupdated,
					a.premi1,a.juamainproduk,
					to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,
					to_char(a.mulas,'DD/MM/YYYY') mulas, 
					c.kdacceptance,
					(select komisiagencb 
						from $DBUser.tabel_404_temp 
						where prefixpertanggungan=a.prefixpertanggungan 
							and nopertanggungan=a.nopertanggungan 
							and kdkomisiagen='01' 
							and thnkomisi='1'
					) nilaikomisi 
				from $DBUser.tabel_100_klien b, 
					$DBUser.tabel_200_pertanggungan a, 
					$DBUser.tabel_214_acceptance_dokumen c,
					$DBUser.tabel_500_penagih d
				where a.notertanggung=b.noklien
					and a.nopenagih=d.nopenagih 
					and c.nopertanggungan(+)=a.notertanggung 
					and c.prefixpertanggungan(+)=a.prefixpertanggungan
					and a.kdpertanggungan='1' 
					and a.kdstatusfile='1' 
					and notertanggung is not null 
					and ".$periode."
					".$wherektr."
				order by prefixpertanggungan,nopertanggungan";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();

		echo "<font color=\"003399\" face=verdana size=2><b>Daftar Proposal Kantor ".$kantor." periode $bln $vthn</b></font><br>";
		echo "<table width=100% class=tblisi cellpadding=0 cellspacing=0>";
			echo("<tr class=hijao>");
				echo("<td align=center>No</td>");
				echo("<td align=center>Nomor Polis</td>");
				echo("<td align=center>Tertanggung</td>");
				echo("<td align=center>Nopol</td>");
				echo("<td align=center>Produk</font></b></td>");
				echo("<td align=center>M</font></b></td>");
				echo("<td align=center>J U A</td>");
				echo("<td align=center>Mulas</td>");
				echo("<td align=center>Premi</td>");
				echo("<td align=center>Komisi</td>");
				echo("<td align=center>Last Update</td>");
				echo("<td align=center>Send Email</td>");
				echo("<td align=center>Update</td>");
			echo("</tr>");
		$i=1;
		while ($arr=$DB->nextrow()) {
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
			echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["NOPOLIS"]."</a></td>");
  			echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>");
			echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPOL"]."</font></td>");
	 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
			echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
  			echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
  			echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
			echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
			echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["NILAIKOMISI"],2)."</font></td>");
  			echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>");
			echo("<td><font face=\"Verdana\" size=\"1\">".$statusemail." ".$sendemail."</font></td>");
	
			//$sql_acceptance=" select kdacceptance from tabel_214_acceptance_dokumen ".
			//"where nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and prefixpertanggungan='$prefix' and kdacceptance='1' ";
			
			//$DB2->parse($sql_acceptance);
			//$DB2->execute();
			//$found=$DB2->nextrow();
						
			if ($sendemail || (isset($arr["KDACCEPTANCE"]) && $arr["KDACCEPTANCE"] == '1')) {
			 	echo("<td align=center></td>");
			} else { 
				if ($arr["KDSTATUSMEDICAL"]=='M') {
					echo("<td align=center></td>");
				} else{
				 	echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"../proposal/ntrypropmtc.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$prefix\">UPDATE</a></font></td>");
              	}
			}
			
			echo("</tr>");
						
			$i++;
		}

    	echo("</table>");
	?>
	</div>

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
				<b><font color="#FFFFFF" face="Verdana" size="1">Proposal</font></b>
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
					from $DBUser.tabel_200_pertanggungan a, 
						$DBUser.tabel_304_valuta b,
						$DBUser.tabel_214_acceptance_dokumen c,
						$DBUser.tabel_500_penagih d
					where a.nopenagih=d.nopenagih 
						and a.kdvaluta=b.kdvaluta 
						and c.nopertanggungan(+)=a.notertanggung 
						and c.prefixpertanggungan(+)=a.prefixpertanggungan
						and a.kdpertanggungan='1' 
						and a.kdstatusfile<>'7' 
						and notertanggung is not null 
						".$filterkantor."
						and ".$periode."
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

	<hr size=1>
	<a class=verdana10blk href="index.php">Menu Pelaporan</a>
	<a href=infoproposalkantor_all.php>.</a>