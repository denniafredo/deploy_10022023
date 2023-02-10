<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB=new Database($userid, $passwd, $DBName);	
 	$DBA=new database($userid, $passwd, $DBName);
	$DBX=new Database($userid, $passwd, $DBName);
	
?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>DOWNLOAD PROPOSAL/POLIS PERLUASAN JSSAVING PLAN (JSSPAN)</b></a>
	<hr size=1>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Nama Produk</td>
	<td> 
<?
	  $sqa="SELECT KDPRODUK, NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK ".
								 "WHERE ".
								 "STATUS IS NULL ".
								 "AND KDPRODUK LIKE 'JSSPAN%' ".
								 "ORDER BY KDPRODUK";
    $DB->parse($sqa);
    $DB->execute();
		print ("<select name=\"produk\">\n");
		print ("<option value=\"JSSPAN\">JSSPAN* - ALL NEW JS-SAVING PLAN</option>\n");
    while ($arr=$DB->nextrow()) {
			$kdprd=$arr["KDPRODUK"];
			$nmprd=$arr["NAMAPRODUK"];
      print("<option value=\"$kdprd\">$kdprd - $nmprd</option>\n");
    }
		print ("</select>\n");
?>	
	</td>
	<td class="verdana10blk">Periode (Tgl Akseptasi)</td>
	<td> <? isset($vbln) ? DateSelectorX("v", mktime(0, 0, 0, $vbln, 1, $vthn)) : DateSelectorX("v"); ?>	</td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?

if ($cariproposalkantor){	
	 if ($produk=="JSSPAN"){
	 		$kategoriproduk="and substr(ptg.kdproduk,1,6)='JSSPAN' ";
			$nmproduk="ALL NEW JS-SAVING PLAN (JSSPAN)";
	 }
	 else{
	 		$kategoriproduk="and ptg.kdproduk='".$produk."' ";	 					 			
  	  $sqa="SELECT KDPRODUK, NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK ".
  								 "WHERE ".
  								 "KDPRODUK ='".$produk."'";
      $DB->parse($sqa);
      $DB->execute();
			$x=$DB->nextrow();
			$nmproduk=$x["NAMAPRODUK"];
	 }

  echo "<hr size=1>";
	echo "<div align=center>";
        if($useDate == 0) 
        { 
            $useDate = Time(); 
        } 

			if($vtgl=="0"){
				if ($vbln==""){
					$DB=new Database($userid,$passwd,$DBName);
					$thnsql = "select to_char(sysdate,'DDMMYYYY') nowtgl from dual";
					$DB->parse($thnsql);
					$DB->execute();
					$x=$DB->nextrow();
					$thisperiode=$x["NOWTGL"];
					$periode="to_char(acp.tglacceptance,'ddmmyyyy')='$thisperiode'";
				}else{				
					$bln = substr(("0".$vbln),-2);
					$thisperiode="$bln$vthn";
					$periode="to_char(acp.tglacceptance,'mmyyyy')='$thisperiode'";
				}
			}else if ($vtgl==""){
				$DB=new Database($userid,$passwd,$DBName);
				$thnsql = "select to_char(sysdate,'DDMMYYYY') nowtgl from dual";
				$DB->parse($thnsql);
				$DB->execute();
				$x=$DB->nextrow();
				$thisperiode=$x["NOWTGL"];
				$periode="to_char(acp.tglacceptance,'ddmmyyyy')='$thisperiode'";
			}else if($vbln=="all"){
		   		$thisperiode="$vthn";
			 	$periode="to_char(acp.tglacceptance,'yyyy')='$thisperiode'";
          	}else if($vbln==""){
				$DB=new Database($userid,$passwd,$DBName);
				$thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
				$DB->parse($thnsql);
				$DB->execute();
				$x=$DB->nextrow();
				$thisperiode=$x["NOWBLN"];
				$vthn=substr($thisperiode,-4);
				$bln=substr($thisperiode,0,2);
				$periode="to_char(acp.tglacceptance,'mmyyyy')='$thisperiode'";
			}else{
				$tgl = substr(("0".$vtgl),-2);
				$bln = substr(("0".$vbln),-2);
				$thisperiode="$tgl$bln$vthn";
				$periode="to_char(acp.tglacceptance,'ddmmyyyy')='$thisperiode'";
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
			  $sqlx = "SELECT ".
						"      PTG.PREFIXPERTANGGUNGAN, ".
						"      PTG.NOPERTANGGUNGAN, ".
						"      PTG.NOPOL, ".
						"      PTG.NOTERTANGGUNG, ".
						"      (SELECT KLI.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOTERTANGGUNG) AS NAMATERTANGGUNG, ".
						"      (SELECT TO_CHAR(KLI.TGLLAHIR,'YYYYMMDD') FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOTERTANGGUNG) AS TGLLAHIRTERTANGGUNG, ".
						"      PTG.NOPEMEGANGPOLIS, ".
						"      (SELECT KLI.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOPEMEGANGPOLIS) AS NAMAPEMEGANGPOLIS, ".
						"      (SELECT TO_CHAR(KLI.TGLLAHIR,'YYYYMMDD') FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOPEMEGANGPOLIS) AS TGLLAHIRPEMEGANGPOLIS, ".
						"      (SELECT KLI.ALAMATTETAP01 FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOPEMEGANGPOLIS) AS ALAMAT01PEMEGANGPOLIS, ".
						"      (SELECT KLI.ALAMATTETAP02 FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOPEMEGANGPOLIS) AS ALAMAT02PEMEGANGPOLIS, ".
						"      PTG.NOPEMBAYARPREMI, ".
						"      (SELECT KLI.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOPEMBAYARPREMI) AS NAMAPEMBAYARPREMI, ".
						"      PTG.KDPRODUK, ".
						"      PTG.KDSTATUSMEDICAL, ".
						"      (SELECT PRD.NAMAPRODUK FROM $DBUser.TABEL_202_PRODUK PRD WHERE PRD.KDPRODUK=PTG.KDPRODUK) AS NAMAPRODUK, ".
						"      (SELECT PRD.KDCABAS FROM $DBUser.TABEL_202_PRODUK PRD WHERE PRD.KDPRODUK=PTG.KDPRODUK) AS CABAS, ".
						"      (SELECT PNG.KDRAYONPENAGIH FROM $DBUser.TABEL_500_PENAGIH PNG WHERE PNG.NOPENAGIH=PTG.NOPENAGIH) AS RAYONPENAGIHAN, ".
						"      PTG.KDCARABAYAR, ".
						"      (SELECT CBA.NAMACARABAYAR FROM $DBUser.TABEL_305_CARA_BAYAR CBA WHERE CBA.KDCARABAYAR=PTG.KDCARABAYAR) AS NAMACARABAYAR, ".
						"      PTG.KDVALUTA, ".
						"      (SELECT VAL.NAMAVALUTA FROM $DBUser.TABEL_304_VALUTA VAL WHERE VAL.KDVALUTA=PTG.KDVALUTA) AS NAMAVALUTA, ".   
//						"      TO_CHAR(PTG.MULAS,'YYYYMMDD') AS MULAS, ".
						"      TO_CHAR(PTG.MULAS,'YYYYMMDD') AS MULAS, ".
						"      PTG.USIA_TH, ".
						"      PTG.USIA_BL, ".
						"      TO_CHAR(PTG.EXPIRASI,'YYYYMMDD') AS EXP, ".
//						"      TO_CHAR(PTG.EXPIRASI,'DD/MM/YYYY') AS EXP, ".
						"      PTG.LAMAASURANSI_TH, ".
						"      PTG.LAMAASURANSI_BL, ".
						"      TO_CHAR(PTG.TGLAKHIRPREMI,'YYYYMMDD') AS AKHIRPREMI, ".
//						"      TO_CHAR(PTG.TGLAKHIRPREMI,'DD/MM/YYYY') AS AKHIRPREMI, ".
						"      PTG.LAMAPEMBPREMI_TH, ".
						"      PTG.LAMAPEMBPREMI_BL, ".
						"      PTG.INDEXAWAL, ".
						"      PTG.PREMI1, ".
						"      PTG.PREMI2, ".
						"      PTG.JUAMAINPRODUK, ".
						"      PTG.NOAGEN, ".
						"      (SELECT KLI.NAMAKLIEN1 FROM $DBUser.TABEL_100_KLIEN KLI WHERE KLI.NOKLIEN=PTG.NOAGEN) AS NAMAAGEN, ".
						"      (SELECT SF.NAMASTATUSFILE FROM $DBUser.TABEL_299_STATUS_FILE SF WHERE SF.KDSTATUSFILE=PTG.KDSTATUSFILE) AS STATUSPOLIS, ".
						"      PTG.KDSTATUSFILE, ".
						"      PTG.KDPERTANGGUNGAN, ".
						"      TO_CHAR(PTG.TGLREKAM,'YYYYMMDD HH24:MI:SS') AS TGLREKAM, ".
//						"      TO_CHAR(PTG.TGLREKAM,'DD/MM/YYYY HH24:MI:SS') AS TGLREKAM, ".
						"      PTG.USERREKAM, ".
						"	   TO_CHAR(PTG.TGLTRANSFER,'YYYYMMDD') AS TGLTRANSFER, ".
//						"	   TO_CHAR(PTG.TGLTRANSFER,'DD/MM/YYYY') AS TGLTRANSFER, ".
						"      PTG.JMLTRANSFER, ".
						"      TO_CHAR(ACP.TGLACCEPTANCE,'YYYYMMDD HH24:MI:SS') AS TGLACCEPTANCE, ".
//						"      TO_CHAR(ACP.TGLACCEPTANCE,'DD/MM/YYYY HH24:MI:SS') AS TGLACCEPTANCE, ".
						"      ACP.USERUPDATED ".
						"FROM $DBUser.TABEL_200_PERTANGGUNGAN PTG, $DBUser.TABEL_500_PENAGIH RYN, $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN ACP ".  
						"WHERE ".
						"      RYN.NOPENAGIH=PTG.NOPENAGIH ".
						"      AND PTG.PREFIXPERTANGGUNGAN = ACP.PREFIXPERTANGGUNGAN(+) ".
						"      AND PTG.NOPERTANGGUNGAN = ACP.NOPERTANGGUNGAN(+) ".
						"      AND PTG.KDSTATUSFILE = '1' ".
						$kategoriproduk.
						"	   AND ".$periode." ".
						"ORDER BY TO_CHAR(ACP.TGLACCEPTANCE,'YYYYMMDD HH24:MI:SS')";
						 
//					echo $sqlx;
//					break;
					$DBX->parse($sqlx);
					$DBX->execute();
					
					 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Proposal/Polis $nmproduk periode $bln $vthn</b></font><br>";
					 echo "<table width=100% class=tblisi cellpadding=0 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>PrefixPertanggungan</td>");
							echo("<td align=center>NomorPertanggungan</td>");
						echo("<td align=center>Nopol</td>");
							echo("<td align=center>NoTertanggung</td>");
							echo("<td align=center>NamaTertanggung</td>");
							echo("<td align=center>TglLahir Tertanggung</td>");
							echo("<td align=center>NoPemegangPolis</td>");
							echo("<td align=center>NamaPemegangPolis</td>");
							echo("<td align=center>TglLahir PemegangPolis</td>");
					    echo("<td align=center>Alamat01PemegangPolis</font></b></td>");
					    echo("<td align=center>Alamat02PemegangPolis</font></b></td>");
							echo("<td align=center>NoPembayarPremi</td>");
							echo("<td align=center>NamaPembayarPremi</td>");
					    echo("<td align=center>KodeProduk</font></b></td>");
					    echo("<td align=center>NamaProduk</font></b></td>");
							echo("<td align=center>StatusMedical</font></b></td>");
							echo("<td align=center>Cabas</td>");
							echo("<td align=center>RayonPenagihan</td>");
					    echo("<td align=center>KodeCaraBayar</font></b></td>");
					    echo("<td align=center>NamaCaraBayar</font></b></td>");
					    echo("<td align=center>KodeValuta</font></b></td>");
					    echo("<td align=center>NamaValuta</font></b></td>");
							echo("<td align=center>Mulas</td>");
							echo("<td align=center>Usia_TH</td>");
							echo("<td align=center>Usia_BL</td>");
							echo("<td align=center>Exp</td>");
							echo("<td align=center>LamaAsuransi_TH</td>");
							echo("<td align=center>LamaAsuransi_BL</td>");
							echo("<td align=center>AkhirPremi</td>");
							echo("<td align=center>LamaPembPremi_TH</td>");
							echo("<td align=center>LamaPembPremi_BL</td>");
							echo("<td align=center>IndexAwal</td>");
							echo("<td align=center>Premi1</td>");
							echo("<td align=center>Premi2</td>");
							echo("<td align=center>J U A</td>");
							echo("<td align=center>KodeAgen</td>");
							echo("<td align=center>NamaAgen</td>");
							echo("<td align=center>KodeStatusPolis</td>");
							echo("<td align=center>StatusPolis</td>");
							echo("<td align=center>KodePertanggungan (1=Proposal,2=Polis)</td>");							
							echo("<td align=center>Tgl Rekam</td>");
							echo("<td align=center>User Rekam</td>");
							echo("<td align=center>Tgl Transfer</td>");
							echo("<td align=center>Jumlah Transfer</td>");
							echo("<td align=center>Tgl Acceptance</td>");
							echo("<td align=center>User Acceptance</td>");
							echo("</tr>");						 							
							$i=1;
							while ($arx=$DBX->nextrow()) {
//							$sendemail = $arx["TGLSENDEMAIL"];
//							$statusemail = $arx["KDSTATUSEMAIL"];
							$nopertanggungan = $arx["NOPERTANGGUNGAN"];
							$prefix = $arx["PREFIXPERTANGGUNGAN"];
							/*
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							switch ($statusemail)
							{
							 case "": $statusemail="<font color=red>BELUM</font>"; break;
							 default : $statusemail="<font color=black>SUDAH</font>"; break; 
							}
							*/
							
							include "../../includes/belang.php";	 
							
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arx["PREFIXPERTANGGUNGAN"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NOPERTANGGUNGAN"]."</font></td>");
							echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arx["NOPOL"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NOTERTANGGUNG"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NAMATERTANGGUNG"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arx["TGLLAHIRTERTANGGUNG"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NOPEMEGANGPOLIS"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NAMAPEMEGANGPOLIS"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["TGLLAHIRPEMEGANGPOLIS"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["ALAMAT01PEMEGANGPOLIS"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["ALAMAT02PEMEGANGPOLIS"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NOPEMBAYARPREMI"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NAMAPEMBAYARPREMI"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["KDPRODUK"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NAMAPRODUK"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["KDSTATUSMEDICAL"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["CABAS"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["RAYONPENAGIHAN"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["KDCARABAYAR"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NAMACARABAYAR"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["KDVALUTA"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["NAMAVALUTA"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["MULAS"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["USIA_TH"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["USIA_BL"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["EXP"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["LAMAASURANSI_TH"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["LAMAASURANSI_BL"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["AKHIRPREMI"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["LAMAPEMBPREMI_TH"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["LAMAPEMBPREMI_BL"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arx["INDEXAWAL"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arx["PREMI1"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arx["PREMI2"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arx["JUAMAINPRODUK"]."</font></td>");
/*
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arx["INDEXAWAL"],2,",",".")."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arx["PREMI1"],2,",",".")."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arx["PREMI2"],2,",",".")."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arx["JUAMAINPRODUK"],2,",",".")."</font></td>");
*/
									          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["NOAGEN"]."</font></td>");
									          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["NAMAAGEN"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["KDSTATUSFILE"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["STATUSPOLIS"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arx["KDPERTANGGUNGAN"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["TGLREKAM"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["USERREKAM"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["TGLTRANSFER"]."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["JMLTRANSFER"]."</font></td>");
//				echo("<td align=center><font face=\"Verdana\" size=\"1\">".number_format($arx["JMLTRANSFER"],2,",",".")."</font></td>");
				echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["TGLACCEPTANCE"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["USERUPDATED"]."</font></td>");

//							if ($sendemail) {
							// echo("<td align=center></td>");
//							} else { 
							// echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"../proposal/ntrypropmtc.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$prefix\">UPDATE</a></font></td>");
//              }
							echo("</tr>");						
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
}
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
					 echo " | ";
					 echo "<a class=verdana10blk href=\"http://192.168.2.23/network/uploadEarlyBird/uploadEarlyBird.php\">Upload Data EarlyBird</a>";
					 
?>