<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB=new Database($userid, $passwd, $DBName);	
 	$DBA=new database($userid, $passwd, $DBName);
	
?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>DAFTAR PROPOSAL MASUK (LOG PROSES ALL)</b></a>
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
//								 "AND NOT(KDPRODUK LIKE 'JL2%' OR KDPRODUK LIKE 'JL3%' OR KDPRODUK IN ('JSSP','JSSPA','JSSK')) ".
								 "ORDER BY KDPRODUK";
    $DB->parse($sqa);
    $DB->execute();
		print ("<select name=\"produk\">\n");
		print ("<option value=\"ALL\">--ALL--</option>\n");
		print ("<option value=\"JL3\">JL3* - ALL NEW JS-LINK</option>\n");
		print ("<option value=\"JL2\">JL2* - ALL NEW JS-LINK</option>\n");
		print ("<option value=\"JSS\">JSS* - ALL JS SAVING PLAN</option>\n");
    while ($arr=$DB->nextrow()) {
			$kdprd=$arr["KDPRODUK"];
			$nmprd=$arr["NAMAPRODUK"];
      print("<option value=\"$kdprd\">$kdprd - $nmprd</option>\n");
    }
		print ("</select>\n");
?>	
	</td>
	<td class="verdana10blk">Periode (Mulai Asuransi)</td>
	<td> <? isset($vbln) ? DateSelectorX("v", mktime(0, 0, 0, $vbln, 1, $vthn)) : DateSelectorX("v"); ?>	</td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?

if ($cariproposalkantor){	
	 if ($produk=="JL2"){
	 		$kategoriproduk="and substr(a.kdproduk,1,3)='JL2' ";
			$nmproduk="ALL NEW JS-LINK (JL2)";
	 }
	 elseif ($produk=="JL3"){
	 		$kategoriproduk="and substr(a.kdproduk,1,3)='JL3' ";
			$nmproduk="ALL NEW JS-LINK (JL3)";
	 }
	 elseif ($produk=="JSS"){
	 		$kategoriproduk="and a.kdproduk in ('JSSP','JSSPA','JSSK') ";	 				
			$nmproduk="ALL JS SAVING PLAN (JSSP, JSSPA, JSSK)";
	 }
	 elseif ($produk=="ALL"){
	 		$kategoriproduk=" ";	 				
			$nmproduk="SELURUH PRODUK";
	 }
	 else{
	 		$kategoriproduk="and a.kdproduk='".$produk."' ";	 					 			
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
					$periode="to_char(a.mulas,'ddmmyyyy')='$thisperiode'";
				}else{				
					$bln = substr(("0".$vbln),-2);
					$thisperiode="$bln$vthn";
					$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
				}
			}else if ($vtgl==""){
				$DB=new Database($userid,$passwd,$DBName);
				$thnsql = "select to_char(sysdate,'DDMMYYYY') nowtgl from dual";
				$DB->parse($thnsql);
				$DB->execute();
				$x=$DB->nextrow();
				$thisperiode=$x["NOWTGL"];
				$periode="to_char(a.mulas,'ddmmyyyy')='$thisperiode'";
			}else if($vbln=="all"){
		   		$thisperiode="$vthn";
			 	$periode="to_char(a.mulas,'yyyy')='$thisperiode'";
          	}else if($vbln==""){
				$DB=new Database($userid,$passwd,$DBName);
				$thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
				$DB->parse($thnsql);
				$DB->execute();
				$x=$DB->nextrow();
				$thisperiode=$x["NOWBLN"];
				$vthn=substr($thisperiode,-4);
				$bln=substr($thisperiode,0,2);
				$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
			}else{
				$tgl = substr(("0".$vtgl),-2);
				$bln = substr(("0".$vbln),-2);
				$thisperiode="$tgl$bln$vthn";
				$periode="to_char(a.mulas,'ddmmyyyy')='$thisperiode'";
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
				  $sql = "select (SELECT namaklien1 FROM $DBUser.tabel_100_klien kli WHERE kli.noklien=a.nopemegangpolis) as PEMPOL , ".
				  		   "a.prefixpertanggungan,a.nopertanggungan,a.kdproduk, a.usia_th,".
					       "a.kdstatusmedical,a.kdstatusemail,a.nopol,a.nopolswitch,".
						   "(SELECT   to_char(tglunderwriting,'dd/mm/yyyy')
							   FROM   $DBUser.TABEL_214_UNDERWRITING
							  WHERE   prefixpertanggungan = a.prefixpertanggungan
									  AND nopertanggungan = a.nopertanggungan) tglapp, ".
										   "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,".
								 "a.userupdated, c.userupdated as USERAKSEP, to_char(c.tglacceptance,'DD/MM/YYYY') as TGLAKSEP, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY HH:MI:SS') tglupdated,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas, ".
								 "to_char(a.tglkonversi,'DD/MM/YYYY') konversi, ".
								 "(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=a.kdcarabayar) carabayar,".
								 "(select premi from $DBUser.tabel_223_transaksi_produk ".
								 "where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
								 "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
								 "where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit='TERM') UATERM, ".
								 "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
								 "where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit='CI') UACI, ".
								 "to_char(a.tgltransfer,'DD/MM/YYYY') tgltransfer, a.jmltransfer ".
	               "from $DBUser.tabel_100_klien b, $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_214_acceptance_dokumen c ".
			           "where a.notertanggung=b.noklien(+) ".
			           //"and a.prefixpertanggungan='$kantor' ".
					   			"and a.prefixpertanggungan=c.prefixpertanggungan(+) and a.nopertanggungan=c.nopertanggungan(+) ".
								 "and a.kdpertanggungan in ('1','2') ".
								 "and a.kdstatusfile='1' ".
								 $kategoriproduk.
								 "and a.notertanggung is not null and $periode ".
								 //"order by a.mulas desc";
								 "order by a.prefixpertanggungan,a.nopertanggungan";
					//echo $sql;
//					break;
					$DB->parse($sql);
					$DB->execute();
					 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Proposal $nmproduk periode $bln $vthn</b></font><br>";
					 echo "<table width=100%  border='1' style='border-collapse: collapse' cellpadding=2 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Nomor</td>");
							echo("<td align=center>Nomor Lama</td>");
							echo("<td align=center>Tertanggung</td>");
							echo("<td align=center>Pemegang Polis</td>");
							echo("<td align=center>Usia Tertanggung</td>");
						//	echo("<td align=center>Nopol</td>");
					    	echo("<td align=center>Produk</font></b></td>");
							//echo("<td align=center>M</font></b></td>");
							echo("<td align=center>J U A</td>");
							echo("<td align=center>U A TERM</td>");
							echo("<td align=center>U A CI</td>");
							echo("<td align=center>Premi</td>");
							echo("<td align=center>TopUp</td>");
							echo("<td align=center>Mulas</td>");
							echo("<td align=center>Medical</td>");
							echo("<td align=center>Tgl Approve</td>");
							echo("<td align=center>Cara Bayar</td>");
							echo("<td align=center>Last Update</td>");
							echo("<td align=center>Tgl Transfer</td>");
							echo("<td align=center>Tgl Konversi</td>");
							echo("<td align=center>Send Email</td>");
							echo("<td align=center>Tgl Acceptance</td>");
							echo("<td align=center>User Acceptance</td>");
 						//	echo("<td align=center>Update</td>");
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
							echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
							$no_switch = $arr["NOPOLSWITCH"];
							$prefswi = substr($no_switch, 0, 2);
							$noperswi = substr($no_switch, -9);
							//echo $no_switch.$prefswi.$noperswi."<br>";
							echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$noperswi&prefix=$prefswi','updclnt',800,height=600,1);\">".$no_switch."</a></td>");
				  //echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPOLSWITCH"]."</font></td>"); EDIT BY SALMAN, SCRIPT DIATAS TAMBAHANNYA. 13/08/2012

		          //echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>"); EDIT BY 3ch0, 24/10/2013
				  $noklien=$arr["NOKLIEN"];
				  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../pelaporan/listpolisnamamirip.php?noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["NAMAKLIEN1"]."</a></td>");

				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["PEMPOL"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["USIA_TH"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
						//	echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2,",",".")."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["UATERM"],2,",",".")."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["UACI"],2,",",".")."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2,",",".")."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["TOPUP"],2,",",".")."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLAPP"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["CARABAYAR"]."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLTRANSFER"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KONVERSI"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLAKSEP"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$sendemail."</font></td>");//"./*$statusemail*/." 
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["USERAKSEP"]."</font></td>");
							if ($sendemail) {
							// echo("<td align=center></td>");
							} else { 
							// echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"../proposal/ntrypropmtc.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$prefix\">UPDATE</a></font></td>");
              }
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
}
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>