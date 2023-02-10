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

	<a class="verdana10blk\"><b>DAFTAR MONITORING POLIS SYAWAL 2016 <?echo $kantor;?></b></a>
	<hr size=1>
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

 
	echo "<div align=center>";
	       
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
						  $filterkantor=" where kdrayonpenagihan='$kantor'  ";
					 }		 
					$sql = "SELECT   A.*,
									 (SELECT   NAMASTATUSFILE
										FROM   $DBUser.TABEL_200_PERTANGGUNGAN B, $DBUser.TABEL_299_STATUS_FILE C
									   WHERE       B.KDSTATUSFILE = C.KDSTATUSFILE
											   AND PREFIXPERTANGGUNGAN = A.PREFIXPERTANGGUNGAN
											   AND NOPERTANGGUNGAN = A.NOPERTANGGUNGAN)
										STATUSPOLIS
							  FROM   $DBUser.TABEL_404_REWARD_SYAWAL A ".$filterkantor;       
					
					//echo $sql;
					$DB->parse($sql);
					$DB->execute();
					 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Kantor ".$kantor."</b></font><br>";
					 echo "<table style=\"border-collapse:collapse;\" border=\"1\" width=100% class=tblisi cellpadding=2 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Nomor</td>");
							echo("<td align=center>No Agen</td>");
							echo("<td align=center>Nama Agen</td>");
					    	echo("<td align=center>Produk</font></b></td>");
							echo("<td align=center>Komisi</font></b></td>");
							echo("<td align=center>Premi</td>");
							echo("<td align=center>Status</td>");
							
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
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOAGEN"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAAGEN"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["KOMISIAGENRP"],2)."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["STATUSPOLIS"]."</font></td>");
			      
							
							
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>