<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";

$DB=new Database($userid, $passwd, $DBName);
$DBA=new Database($userid, $passwd, $DBName);
	
?>
<html>
<head>
<title>Detil Jatuh Tempo Klaim</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

</head>
<body>
<div align="center">
<table border="0" class="tblborder" cellspacing="1" cellpadding="1" width="100%" align="center">
			<tr class="tblhead">
				 <td align="center" colspan="2">DETIL JATUH TEMPO KLAIM KANTOR <?echo $kantor;?> BULAN <?echo $blnjatuh;?></td>
			</tr>

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center" rowspan="2">No</td>
						<td align="center" colspan="2">Nomor Polis</td>
						<td align="center" rowspan="2">Pemegang Polis</td>
						<td align="center" rowspan="2">Jatuh Tempo</td>
						<td align="center" rowspan="2">Akhir Premi</td>
						<td align="center" rowspan="2">Produk</td>
						<td align="center" rowspan="2">Penagih</td>
						<td align="center" rowspan="2">Agen</td>
						<td align="center" rowspan="2">Alamat Tagih</td>
						<td align="center" rowspan="2">Telepon</td>
						<td align="center" rowspan="2">Benefit</td>
						<td align="center" rowspan="2">Nilai Benefit</td>
						<td align="center" rowspan="2">JUA</td>
						<td align="center" rowspan="2">Index Awal</td>
						<td align="center" rowspan="2">Cara Bayar</td>
						<td align="center" rowspan="2">S</td>
					 </tr>
					 <tr class="hijao">
					  <td align="center" width="10%">Lama</td>
						<td align="center" width="10%">Baru</td>
					 </tr>					 
<?
  	$i=1;
		if (!$blm) {
		 $a = '';
		 $b = '';
		} elseif ($blm=='y') {
		 $a = "and nvl(c.status,'0') in ('0','7') ";
		 $b = "and e.tglseatled is null and nvl(e.status,'0') in ('0','7') ";
		} else {
		 $a = "and nvl(c.status,'0') = '8' ";
		 $b = "and e.tglseatled is not null and nvl(e.status,'0') = '1' ";
		}

 $noaa = (!$noagen) ? '' : "and a.noagen='$noagen' ";
 $noah = (!$noagen) ? '' : "and h.noagen='$noagen' ";
 $nopa = (!$nopenagih) ? '' :  "and a.nopenagih='$nopenagih' ";
 $noph = (!$nopenagih) ? '' : "and h.nopenagih='$nopenagih' ";
 		
 $a = $a.$noaa.$nopa;
 $b = $b.$noah.$noph;		
 
	  $sql = "select ".
				 	 		"a.prefixpertanggungan, a.nopertanggungan, d.namabenefit, c.nilaibenefit, a.juamainproduk,a.indexawal,c.status,".
				      "to_char(c.expirasi,'DD/MM/YYYY') jt,".
							"to_char(a.tglakhirpremi,'DD/MM/YYYY') akhirpremi, ".
							"h.namacarabayar ".
				   "from ".
					 		"$DBUser.tabel_223_transaksi_produk c,".
							"$DBUser.tabel_200_pertanggungan a,  ".
					 		"$DBUser.tabel_500_penagih b, ".
							"$DBUser.tabel_305_cara_bayar h, ".
							"$DBUser.tabel_207_kode_benefit d ".
				 	 "where ".
					 		"a.nopenagih=b.nopenagih and b.kdrayonpenagih='$kantor' and ".
					 		"a.kdpertanggungan = '2' and a.kdstatusfile='1' ".
							//"and nvl(c.status,'0') in ('0','7') ". 
					 		$a.
  					 	"and a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan ".
							"and substr(a.kdproduk,1,2) <> 'PA' ".
  					  "and c.kdbenefit=d.kdbenefit ".
							"and h.kdcarabayar=a.kdcarabayar ".
  					  "and d.kdkelompokbenefit='$klp' ".
  					  "and to_char(c.expirasi,'MMYYYY')='$blnjatuh' ".
					  "and rownum <= $rec ".
					  "union ".					 
					 "select ".
					    "e.prefixpertanggungan,e.nopertanggungan ,f.namabenefit,e.nilaibenefit, h.juamainproduk,h.indexawal,e.status, ".
				   		"to_char(e.tgljatuhtempo,'DD/MM/YYYY') jt, ".
							"to_char(h.tglakhirpremi,'DD/MM/YYYY') akhirpremi, ".
							"'BULANAN' ".
					 "from ".
					    "$DBUser.tabel_200_pertanggungan h,".
							"$DBUser.tabel_242_benefit_anuitas e, ".
					 		"$DBUser.tabel_500_penagih i, ".
							"$DBUser.tabel_207_kode_benefit f ".
					 "where h.nopenagih=i.nopenagih and i.kdrayonpenagih='$kantor' and ".
					    "h.kdpertanggungan = '2' and h.kdstatusfile='1' ".
							//"and nvl(e.status,'0') in ('0','7') ". 
					 		$b.
					 		"and  e.kdbenefit=f.kdbenefit ".
					 		"and h.prefixpertanggungan=e.prefixpertanggungan and h.nopertanggungan=e.nopertanggungan ".
							"and substr(h.kdproduk,1,2) <> 'PA' ".
					 		"and to_char(e.tgljatuhtempo,'MMYYYY')='$blnjatuh' ".
					 		"and f.kdkelompokbenefit='$klp' ".
							"and rownum <= $rec ".
					 "order by prefixpertanggungan, nopertanggungan ";

					 //echo $sql;
					 $DB->parse($sql);
					 $DB->execute();
					 $jml=0;
					 while ($arr=$DB->nextrow()) {	
					 	$PER = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);		 			 	
						include "../../includes/belang.php";	
					     print( "<td class=arial8 align=\"center\">$i</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$PER->nopol."</td>\n" );
  						 print( "<td class=arial8 align=\"center\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$PER->label."</a></td>\n" );
  						 print( "<td class=verdana8 align=\"left\">".$PER->namapemegangpolis."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["JT"]."</td>\n" );
							 print( "<td class=arial8 align=\"center\">".$arr["AKHIRPREMI"]."</td>\n" );
  						 print( "<td class=verdana8 align=\"left\">".$PER->produk."</td>\n" );
							 print( "<td class=verdana8 align=\"left\">(".$PER->nopenagih.") ".$PER->namapenagih."</td>\n" );
  						 print( "<td class=verdana8 align=\"left\">(".$PER->noagen.") ".$PER->namaagen."</td>\n" );

							 $sqa="SELECT * FROM tabel_100_klien WHERE noklien='".$PER->nopemegangpolis."'";
    					 $DBA->parse($sqa);
    					 $DBA->execute();
							 $ara=$DBA->nextrow();
  						 print( "<td class=arial8 align=\"center\">".$ara["ALAMATTAGIH01"]." ".$ara["ALAMATTAGIH02"]." ".$ara["KDPROPINSITAGIH"]."-".$ara["KODEPOSTAGIH"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$ara["PHONETAGIH01"]."/".$ara["PHONETAGIH02"]."</td>\n" );
								
  						 print( "<td align=\"left\" class=arial7>".$arr["NAMABENEFIT"]."\n" );
  						 print( "<td class=arial8 align=\"right\">".number_format($arr["NILAIBENEFIT"],2)."</td>\n" );
  						 print( "<td class=arial8 align=\"right\">".number_format($arr["JUAMAINPRODUK"],2)."</td>\n" );
  						 print( "<td class=arial8 align=\"right\">".number_format($arr["INDEXAWAL"],2)."</td>\n" );
  						 print( "<td class=arial8 align=\"right\">".$arr["NAMACARABAYAR"]."</td>\n" );
  						 print( "<td align=\"right\" class=arial7>".$arr["STATUS"]."\n" );
  						 print( "</tr>\n" );
						$i++;
					}
					?>
				
					</table>
				 </td>	 
			 </tr>
			 
<?
 if (!$bt) {
?>  
			
 			<tr class="arial8wht" colspan="2">
				 <td align="left" >Klik Nomor Polis untuk melihat Detail Polis </td>
			</tr>
<?
 }
?>  



			
			
</table>	 
<table width="100%">
  <tr>
    <td width="50%" class="arial10" align="left"><a href="#" onClick="window.print()">Print</a></td>
		<td width="50%" class="arial10" align="right"><a href="#" onClick="window.close()">Close</a></td>
	</tr>
</table>

</form>
</div>
</body>
</html>
