<?  
    include "../../includes/database.php";  
    /* edit by fendy untuk tidak menampilkan di menu jaim 01/10/2015 */
    if ($_GET['dari_jaim'] == 'betul') {
	   $userid="jsadm";
	   $passwd="jsadmoke";
    }
	else {
	   include "../../includes/session.php";  
	} 
    /* akhir dari edit by fendy */
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
		
	$DB=new Database($userid, $passwd, $DBName);	
	//$DB2=new Database($userid, $passwd, $DBName);

	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<a class="verdana10blk\"><b>KONTES "REWARD 156" (Katagori Premi)</b></a><br />
    <?php
	if ($_GET['dari_jaim'] == 'betul') {
		echo "<a class=verdana10blk href=\"info156.php?dari_jaim=betul\">Katagori Polis klik disini</a>";
	}
	else {
		echo "<a class=verdana10blk href=\"info156.php\">Katagori Polis klik disini</a>";
	} 
    /* akhir dari edit by fendy */
	?>
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
					
					
					 
					$sql = "SELECT   (SELECT   namakantor
            FROM   $DBUser.TABEL_001_KANTOR
           WHERE   kdkantor = x.kdkantor)
            kantor,
         (SELECT   namaareaoffice
            FROM   $DBUser.TABEL_410_AREA_OFFICE
           WHERE   kdkantor = x.kdkantor AND kdareaoffice = x.kdareaoffice)
            area,
         polis,
         premi
  FROM   (  SELECT                                                 
                  b  .kdkantor,
                     b.kdareaoffice,                       
                     COUNT ( * ) polis,
                     SUM (premi1) premi
              FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.TABEL_400_AGEN b
             WHERE  mulas between to_date('01/10/2015', 'dd/mm/yyyy') and to_date('31/12/2015', 'dd/mm/yyyy')
                     AND kdpertanggungan = '2'
                     AND kdstatusfile IN ('1')
                     AND kdcarabayar IN ('X', 'E', 'J')
                     AND premi1 >= 50000000
                     AND a.noagen = b.noagen
                     AND kdjabatanagen IN ('00', '05', '09', '02')
          GROUP BY                                                  
                  b  .kdkantor, b.kdareaoffice            
          ORDER BY   SUM (premi1) DESC, COUNT(*) DESC) x";       // Permintaan Ica 1 Oktober 2014 Oleh Dedi
						 //echo "ORDER BY   prefixpertanggungan, nopertanggungan) order by tglpengajuan desc";
					
					//echo $sql;
					$DB->parse($sql);
					$DB->execute();
					 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Kontes Reward 156 Katagori Premi</b></font><br>";
					 echo "<table style=\"border-collapse:collapse;\" border=\"1\" width=100% class=tblisi cellpadding=2 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Kantor Cabang</td>");
							echo("<td align=center>Kantor Area</td>");
							//echo("<td align=center>Kantor Unit</td>");
							echo("<td align=center>Polis</td>");
							echo("<td align=center>Premi</td>");
 							//echo("<td align=center>Update</td>");
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
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KANTOR"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["AREA"]."</font></td>");
				  //echo("<td><font face=\"Verdana\" size=\"1\">".$arr["UNIT"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["POLIS"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI"],2)."</font></td>");
		          
		
		//$sql_acceptance=" select kdacceptance from tabel_214_acceptance_dokumen ".
		//"where nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and prefixpertanggungan='$prefix' and kdacceptance='1' ";
		
		//$DB2->parse($sql_acceptance);
		//$DB2->execute();
		//$found=$DB2->nextrow();
							
							$jpolis=$jpolis+$arr["POLIS"];
					 		$jpremi=$jpremi+$arr["PREMI"];
							echo("</tr>");
							
					 $i++;
					 }		
			
			echo("<tr><td colspan=3><font face=\"Verdana\" size=\"1\">TOTAL</font></td>
		   <td align=right><font face=\"Verdana\" size=\"1\">".number_format($jpolis,2)."</font></td>");
		    echo "<td align=right><font face=\"Verdana\" size=\"1\">".number_format($jpremi,2)."</font></td>".
		   "</tr>";				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 
					 /* edit by fendy untuk tidak menampilkan di menu jaim 01/10/2015 */
					 if ($_GET['dari_jaim'] != 'betul') {
						echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
					 }
					 /* akhir dari edit by fendy */
?>