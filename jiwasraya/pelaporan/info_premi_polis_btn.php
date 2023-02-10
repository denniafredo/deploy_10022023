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
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Periode (Mulai Asuransi)</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="cariproposalkantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?

  echo "<hr size=1>";
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
								 
					$sql = " SELECT   a.prefixpertanggungan, ".
           "a.nopertanggungan, ".
           "a.nopol, ".
           "a.kdproduk,            ".
           "(select namaklien1||' '||namaklien2 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapempol, ".
           "a.usia_th, ".
           "a.kdproduk,            ".
		   "A.LAMAASURANSI_TH masaas,".
		   "DECODE(A.kdcarabayar,'X',1,A.LAMApembpremi_TH) masaprm,".
           "TO_CHAR (a.tglsendemail, 'DD/MM/YYYY') tglsendemail, ".
           "b.namaklien1, ".
           "b.gelar, ".
           "a.userupdated, ".
		   "(select TO_CHAR(tglseatled,'DD/MM/YYYY') from $DBUser.tabel_300_historis_premi where prefixpertanggungan=a.prefixpertanggungan
		   and nopertanggungan=a.nopertanggungan and tglseatled is not null and
		   tglbooked=(select max(tglbooked) from $DBUser.tabel_300_historis_premi 
		   where prefixpertanggungan=a.prefixpertanggungan
		   and nopertanggungan=a.nopertanggungan and tglseatled is not null)) lunas, ".
           "a.premi1, a.noagen||' - '||(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) noagen, ".
		   "a.nopenagih||' - '||(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopenagih) nopenagih, ".
		   "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) carabayar, ".
           "a.juamainproduk,kdcarabayar,            ".
           "TO_CHAR (a.mulas, 'DD/MM/YYYY') mulas, ".
           "TO_CHAR (a.expirasi, 'DD/MM/YYYY') expirasi, ".
           "(select noref from $DBUser.TABEL_UL_SPAJ_TEMP where nosp=a.nosp) noref, ".
           "(select namaref from  $DBUser.TABEL_UL_SPAJ_TEMP where nosp=a.nosp) namaref,            ".
		   "(select nilaikomisiagen from $DBUser.TABEL_412_NILAI_KOMISI_AGEN 
            where kdproduk=a.kdproduk
            and cara=decode(a.kdcarabayar,'X','X','B')
            and thnkomisi=1
            and kdkomisiagen=36
            and thnpertanggungan=0
            and usia=0)*premi1 fee1,
            (select nilaikomisiagen from $DBUser.TABEL_412_NILAI_KOMISI_AGEN 
            where kdproduk=a.kdproduk
            and cara=decode(a.kdcarabayar,'X','X','B')
            and thnkomisi=2
            and kdkomisiagen=36
            and thnpertanggungan=0
            and usia=0)*premi1 fee2,
            (select nilaikomisiagen from $DBUser.TABEL_412_NILAI_KOMISI_AGEN 
            where kdproduk=a.kdproduk
            and cara=decode(a.kdcarabayar,'X','X','B')
            and thnkomisi=3
            and kdkomisiagen=36
            and thnpertanggungan=0
            and usia=0)*premi1 fee3 ".
    "FROM   $DBUser.tabel_100_klien b, ".
           "$DBUser.tabel_200_pertanggungan a            ".
   "WHERE       a.notertanggung = b.noklien(+)            ".
           "AND a.kdpertanggungan = '2' ".
           "AND a.kdproduk LIKE '%BTN' ".
           "AND a.kdstatusfile = '1' ".
           "AND notertanggung IS NOT NULL and $periode ".								 
								 //"order by a.mulas desc";
								 "order by prefixpertanggungan,nopertanggungan";
					//echo $sql;
					$DB->parse($sql);
					$DB->execute();
					 echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis BTN periode $bln $vthn</b></font><br>";
					 echo "<table width=100% class=tblisi cellpadding=0 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Nomor</td>");							
							echo("<td align=center>Lunas per</td>");
							echo("<td align=center>Tertanggung</td>");
							echo("<td align=center>Pemegang Polis</td>");
							echo("<td align=center>Usia Tertanggung</td>");							
					        echo("<td align=center>Produk</font></b></td>");							
							echo("<td align=center>J U A</td>");							
							echo("<td align=center>Premi</td>");
							echo("<td align=center>Mulas</td>");
							echo("<td align=center>Expirasi</td>");
							echo("<td align=center>Masa Asr.</td>");
							echo("<td align=center>Lama Prm.</td>");
							echo("<td align=center>Cara Bayar</td>");
							echo("<td align=center>No Rek Auto Debet</td>");
							echo("<td align=center>Agen</td>");
							echo("<td align=center>Penagih</td>");
 							echo("<td align=center>Nama Referensi</td>");
							echo("<td align=center>Fee I</td>");
							echo("<td align=center>Fee II</td>");
							echo("<td align=center>Fee III</td>");
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
							echo("<td><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["LUNAS"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"]."</font></td>");
				  echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAPEMPOL"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["USIA_TH"]."</font></td>");							
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MASAAS"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MASAPRM"]."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["CARABAYAR"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["NOREKENINGDEBET"]."</font></td>");
				  echo("<td align=left><font face=\"Verdana\" size=\"1\">".$arr["NOAGEN"]."</font></td>");
				  echo("<td align=left><font face=\"Verdana\" size=\"1\">".$arr["NOPENAGIH"]."</font></td>");
				  echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["NAMAREF"]."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["FEE1"],2)."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["FEE2"],2)."</font></td>");
				  echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["FEE3"],2)."</font></td>");							
		
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
							 //echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"../proposal/ntrypropmtc.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$prefix\">UPDATE</a></font></td>");
              }}
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
					 echo "<a href=infoproposalkantor_all.php>.</a>";
?>