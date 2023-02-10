<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";

$DB=new Database($userid, $passwd, $DBName);
$DA=new Database($userid, $passwd, $DBName);	
					 if(!$np){
    			 				$nomorpenagih="";
									$ambilpenagih="";
 					 } else {
    			 	 			$nomorpenagih="Penagih $namaklien1";
									$ambilpenagih="and b.nopenagih='$np'";
  				 }
 
					 $ktrdepan=substr($kdkantor,0,1);
        	 $ktrblk=substr($kdkantor,-1);
 					 if($ktrblk=="A"){
				   			  $judulkantor="$kdkantor REGIONAL OFFICE";
				  				$pasangkantor="and a.kdrayonpenagih like '$ktrdepan%' ";
									$pasangpenagih="";
				   } else if($ktrblk=="P") {
				   	 			$judulkantor="HEAD OFFICE";
				  				$pasangkantor="";
									$pasangpenagih="";
					 } else {  
				   	 			$judulkantor="$kdkantor BRANCH OFFICE";
				  				$pasangkantor="and a.kdrayonpenagih='$kdkantor' ";
				  				$pasangpenagih=$ambilpenagih;
				   }
					 
					 switch ($bln)	{
		          case "01": $blnn = "Januari"; break;
	            case "02": $blnn = "Pebruari"; break;
	            case "03": $blnn = "Maret"; break;
		          case "04": $blnn = "April"; break;
		          case "05": $blnn = "Mei"; break;
		          case "06": $blnn = "Juni"; break;
		          case "07": $blnn = "Juli"; break;
		          case "08": $blnn = "Agustus"; break;
		          case "09": $blnn = "September"; break;
		          case "10": $blnn = "Oktober"; break;
		          case "11": $blnn = "Nopember"; break;
		          case "12": $blnn = "Desember"; break;
           }
?>
<html>
<head>
<title>Detil Tagihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>
<div align="center">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
			<tr class="tblhead">
				 <td align="center" colspan="2">DETIL TAGIHAN <? echo $namapenagih." ".$judulkantor; ?></td>
			</tr>
<?
 if (!$bt) {
?>  
			<tr class="tblhead">
				 <td align="center" colspan="2">Bulan : <? echo $blnn." ".$thn;?></td>
			</tr>
<?
 }
?>  

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center" rowspan="2">No</td>
						<td align="center" colspan="2">Nomor Polis</td>
						<td align="center" rowspan="2">Pemegang Polis</td>
						<td align="center" rowspan="2">Kwt</td>
						<td align="center" rowspan="2">Penagih</td>
						<td align="center" rowspan="2">Booking</td>
						<td align="center" rowspan="2">Premi (Valuta)</td>
						<td align="center" rowspan="2">S</td>
					 </tr>
					 <tr class="hijao">
					  <td align="center">Lama</td>
					  <td align="center">Baru</td>
					 </tr>					 
					 <?
					 $sql = "select ".
					 							"b.prefixpertanggungan, b.nopertanggungan, b.nopenagih, ".
												"y.nopol,b.premitagihan, b.kdkuitansi, to_char(b.tglbooked,'DD/MM/YYYY') tglbooked, ".
					 							"decode (b.status,'1','LUNAS','0','BELUM','') status ,to_char(b.tglstatus,'DD/MM/YYYY') tglstatus, ".
												"z.namaklien1 pempol ".
									"from ".
												"$DBUser.tabel_100_klien z, ".
												"$DBUser.tabel_200_pertanggungan y, ".
												"$DBUser.tabel_300_bontagihan b, ".
												"$DBUser.tabel_500_penagih a ".
									"where ".
												"b.prefixpertanggungan=y.prefixpertanggungan and ".
												"b.nopertanggungan=y.nopertanggungan ".
												"and y.nopemegangpolis=z.noklien(+) ".
												"and a.nopenagih=b.nopenagih ".
												"$pasangkantor ".
												"$pasangpenagih and b.kdvaluta='$val' ".
												"and b.tglbooked<=trunc(sysdate) ".
												"and decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4')='$cb' ".
												"and b.kdkuitansi like '$kwt%' ".
												"and to_char(b.tglbooked,'MMYYYY')='$tglproses' ".
									"order by b.prefixpertanggungan,b.nopertanggungan ";
		       //echo $ctk.$sql;
					 $DB->parse($sql);
					 $DB->execute();
					 
					 $i=1;
					 $jml=0;
					 while ($arr=$DB->nextrow()) {	
					  if (!$bt) {
					 	 $sqa = "select decode(a.tglseatled,NULL,'B','S') statis ".
								    "from $DBUser.tabel_300_historis_premi a ".
									  "where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and ".
									  "nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and to_char(a.tglbooked,'DD/MM/YYYY')='".$arr["TGLBOOKED"]."'";		 		
						 $DA->parse($sqa);
						 $DA->execute();
						 $arf=$DA->nextrow();
						}  
						 $status = (strlen($arr["STATIS"])==0 && !$bt) ? $arf["STATIS"] : $arr["STATIS"];			 	 	
						include "../../includes/belang.php";	
					     print( "<td class=arial8 align=\"center\">$i</td>\n" );
  						 print( "<td class=arial8 align=\"left\">".$arr["NOPOL"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\"><a href=\"#\" onclick=\"window.open('../akunting/kartupremi1.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','height=600,width=800,left=100,top=100,scrollbars=yes')\">".$arr["PREFIXPERTANGGUNGAN"]." - ".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
  						 print( "<td class=arial8 align=\"left\">".$arr["PEMPOL"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["KDKUITANSI"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["NOPENAGIH"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["TGLBOOKED"]."</td>\n" );
  						 print( "<td class=arial8 align=\"right\">".number_format($arr["PREMITAGIHAN"],2)."</td>\n" );
  						 print( "<td align=\"center\" class=arial8>".$status."\n" );
  						 print( "</tr>\n" );
						$i++;
						$jml += $arr["PREMITAGIHAN"];
					}
					?>
					<tr>
 					<tr class="arial10blk">
					<td colspan="2">Jumlah</td>
					<td align="right" colspan="7"><? echo number_format($jml,2);?></td>
			 		<td></td>
					</tr> 
					</table>
				 </td>	 
			 </tr>
			 
<?
 if (!$bt) {
?>
 			<tr class="arial8wht" colspan="2">
				 <td align="left" >Klik Nomor Polis untuk melihat Kartu Premi
				 <br>LUNAS berarti dilunasi melalui pelunasan premi polis satuan</td>
			</tr>
<?
 }
?>  

</table>	 
<table width="100%">
  <tr>
  	<td width="50%" class="arial10"><a href="#" onclick="window.print()">Print</a></td>
  	<td width="50%" class="arial10" align="right"><a href="#" onclick="window.close()">Close</a></td>
	</tr>
</table>

</form>
</div>
</body>
</html>
