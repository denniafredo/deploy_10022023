<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";

$DB=new Database($userid, $passwd, $DBName);
$DA=new Database($userid, $passwd, $DBName);	
$sql = "select namaklien1 from $DBUser.tabel_100_klien where noklien='$np'";
	$DB->parse($sql);
  $DB->execute();
  $row=$DB->nextrow();	
	$namapenagih = $row["NAMAKLIEN1"];

$sql = "select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar='$cb'";
	$DB->parse($sql);
  $DB->execute();
  $rrr=$DB->nextrow();	
	$carabayar = $rrr["NAMACARABAYAR"];
//echo $bt; bt digunakan untuk menu informasi tagihan sesuai penagih
?>
<html>
<head>
<title>Detil Tagihan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>
<body>


<div align="center"><h3>DAFTAR SISA TAGIHAN PREMI</h3></div>
<table border="0" style="border-collapse: collapse" cellspacing="2" cellpadding="1">
	<tr>
		<td class=arial8>Nama Penagih</td>
		<td class=arial8>:</td>
		<td class=arial8><?=$row["NAMAKLIEN1"];?></td>
	</tr>
	<tr>
		<td class=arial8>Tanggal Proses</td>
		<td class=arial8>:</td>
		<td class=arial8><?=$tglproses;?></td>
	</tr>
	<tr>
		<td class=arial8>Cara Bayar</td>
		<td class=arial8>:</td>
		<td class=arial8><?=$carabayar;?></td>
	</tr>
</table>

				 
				  <table width="100%" border="0" cellpadding="1" cellspacing="1">
					 <tr class="hijao">
					  <td align="center" rowspan="2">No</td>
						<td align="center" colspan="2">Nomor Polis</td>
						<td align="center" rowspan="2">Pemegang Polis</td>
						<td align="center" rowspan="2">Kwt</td>
						<td align="center" rowspan="2">No.Rek.</td>
						<td align="center" rowspan="2">Penagih</td>
						<td align="center" rowspan="2">Booking</td>
						<td align="center" rowspan="2">Premi(Val)</td>
						<td align="center" rowspan="2">S</td>
					 </tr>
					 <tr class="hijao">
					  <td align="center">Lama</td>
					  <td align="center">Baru</td>
					 </tr>					 
					 <?
					 $i=1;
	 
					 $sql = "select ".
    					 				"b.prefixpertanggungan, b.nopertanggungan, d.kdcabas, b.nopenagih, y.nopol,b.premitagihan, b.kdkuitansi, to_char(b.tglbooked,'DD/MM/YYYY') tglbooked, ".
    					 				"decode (b.status,'1','LUNAS','0','BELUM','') status ,to_char(b.tglstatus,'DD/MM/YYYY') tglstatus, ".
    									"a.kdrekeninglawan,z.namaklien1 pempol, ".
											"decode(y.kdvaluta,'0',a.premitagihan/y.indexawal,a.premitagihan) as premi ".
									"from ".
    									"$DBUser.tabel_100_klien z, ".
    									"$DBUser.tabel_200_pertanggungan y, ".
    									"$DBUser.tabel_300_historis_premi a,".
    									"$DBUser.tabel_300_bontagihan b, ".
    									"$DBUser.tabel_202_produk d ".
									"where ".
    									"a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
    									"and a.tglbooked=b.tglbooked ".
    									"and b.prefixpertanggungan=y.prefixpertanggungan and b.nopertanggungan=y.nopertanggungan ".
    									"and y.nopemegangpolis=z.noklien(+) ".
    									"and b.nopenagih='$np' and b.kdvaluta='$val' ".
    									"and b.tglbooked<=trunc(sysdate) ".
    									"and decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4','J','J','J','J','E','E','E','E')='$cb' ".
    									"and b.kdkuitansi like '$kwt%' ".
    									"and to_char(b.tglproses,'DD/MM/YYYY')='$tglproses' ".
    									"and y.kdproduk=d.kdproduk ".
    									"and a.tglseatled is null ".
									"order by a.nopertanggungan,z.namaklien1,a.tglbooked ";
		
		 			 //echo $sql;
					 $DB->parse($sql);
					 $DB->execute();
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
						 //echo $arr["STATIS"]."|".$arf["STATIS"];
						}  
						 $status = (strlen($arr["STATIS"])==0 && !$bt) ? $arf["STATIS"] : $arr["STATIS"];	
						 $status = ($status=='B') ? "<font color=red>B</font>" : "<font color=green>S</font>";		 	 	
						include "../../includes/belang.php";	
					     print( "<td class=arial8 align=\"center\">$i</td>\n" );
  						 print( "<td class=arial8 align=\"left\">".$arr["NOPOL"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\"><a href=\"#\" onclick=\"window.open('../akunting/kartupremi1.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','height=600,width=800,left=100,top=100,scrollbars=yes')\">".$arr["PREFIXPERTANGGUNGAN"]." - ".$arr["NOPERTANGGUNGAN"]."</a></td>\n" );
  						 print( "<td class=arial8 align=\"left\">".$arr["PEMPOL"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["KDKUITANSI"]." / ".$arr["KDCABAS"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["KDREKENINGLAWAN"]."</td>\n" );
							 print( "<td class=arial8 align=\"center\">".$arr["NOPENAGIH"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["TGLBOOKED"]."</td>\n" );
  						 print( "<td class=arial8 align=\"right\">".number_format($arr["PREMI"],2)."</td>\n" );
  						 print( "<td align=\"center\" class=arial8>".$status."\n" );
  						 print( "</tr>\n" );
						$i++;
						$jml += $arr["PREMI"];
					}
					?>
					<tr>
 					<tr class="arial10blk">
					<td colspan="3">Jumlah</td>
					<td align="right" colspan="7"><? echo number_format($jml,2);?></td>
			 		<td></td>
					</tr> 
					
					</table>
 
<br />

<a href="#" onclick="window.print()">Print</a> | <a href="#" onclick="window.close()">Close</a>
</body>
</html>
