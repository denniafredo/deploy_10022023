<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";

$DB=new Database($userid, $passwd, $DBName);
$DA=new Database($userid, $passwd, $DBName);	
//echo $bt; bt digunakan untuk menu informasi tagihan sesuai penagih
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
				 <td align="center" colspan="2">DETIL TAGIHAN</td>
			</tr>
<?
 if (!$bt) {
?>  
			<tr class="tblhead">
				 <td align="center" colspan="2">Tanggal Proses : <? echo $tglproses;?></td>
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
						<td align="center" rowspan="2">Premi(Val)</td>
						<td align="center" rowspan="2">S</td>
					 </tr>
					 <tr class="hijao">
					  <td align="center">Lama</td>
					  <td align="center">Baru</td>
					 </tr>					 
					 <?
					 $i=1;
		if (!$bt) {			 
					 $sql = "select b.prefixpertanggungan, b.nopertanggungan, d.kdcabas, b.nopenagih, y.nopol,b.premitagihan, b.kdkuitansi, to_char(b.tglbooked,'DD/MM/YYYY') tglbooked, ".
					 				"decode (b.status,'1','LUNAS','0','BELUM','') status ,to_char(b.tglstatus,'DD/MM/YYYY') tglstatus, ".
									//"decode(a.tglseatled,NULL,'B','S') statis, ".
									"z.namaklien1 pempol ".
									"from $DBUser.tabel_100_klien z, ".
									"$DBUser.tabel_200_pertanggungan y, ".
									//"$DBUser.tabel_300_historis_premi a,".
									"$DBUser.tabel_300_bontagihan b, ".
									"$DBUser.tabel_202_produk d ".
									"where ".
									//"a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
									"b.prefixpertanggungan=y.prefixpertanggungan and b.nopertanggungan=y.nopertanggungan ".
									"and y.nopemegangpolis=z.noklien(+) ".
									"and b.nopenagih='$np' and b.kdvaluta='$val' ".
									"and b.tglbooked<=trunc(sysdate) ".
									"and decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4')='$cb' ".
									"and b.kdkuitansi like '$kwt%' ".
									"and to_char(b.tglproses,'DD/MM/YYYY')='$tglproses' ".
									"and y.kdproduk=d.kdproduk ".
									"order by b.prefixpertanggungan,b.nopertanggungan ";
		} else {
		  switch ($ctk) {
		    case '1' :
		      $sttctk = "and nvl(b.status,'0') <> '0' ";
					$lunas = (!$lns) ?  "and b.tglseatled is null " : "and b.tglseatled is not null " ;
					break;
		    case '0' :
		  	  $sttctk = "and nvl(b.status,'0') = '0' ";
					$lunas = (!$lns) ?  '' : "and b.tglseatled is not null " ;
					break;
		    default :
		  		$sttctk = "";
					$lunas = (!$lns) ?  '' : "and b.tglseatled is not null " ;
					break;
		  }	
		
		  
		  $np = ($np=='') ? '' : "and a.nopenagih='$np' ";
		
					 $sql = "select b.prefixpertanggungan, b.nopertanggungan,a.nopol,d.kdcabas,b.kdkuitansi, b.premitagihan, to_char(b.tglbooked,'DD/MM/YYYY') tglbooked, ".
					 				"b.status statis, to_char(b.tglstatus,'DD/MM/YYYY') tglstatus, ".
									"to_char(b.tglseatled,'DD/MM/YYYY') tglseatled,a.nopenagih, ".
									"z.namaklien1 pempol ".
									"from $DBUser.tabel_100_klien z, $DBUser.tabel_300_historis_premi b, ".
									"$DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih c, $DBUser.tabel_202_produk d ".
									"where a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
									"and a.nopemegangpolis=z.noklien ".
									"and a.kdvaluta='$val' and to_char(b.tglbooked,'MMYYYY')='$jt' ".
									"and a.kdproduk=d.kdproduk ".
									$lunas.
									$np.
									"and decode(a.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4')='$cb' ".
									"and b.kdkuitansi like '$kwt%' ".
									$sttctk.
									"and a.kdstatusfile='1' and a.kdpertanggungan='2' ".
									"and a.nopenagih = c.nopenagih and c.kdrayonpenagih = '$kantor' ";
									"order by b.prefixpertanggungan,b.nopertanggungan ";
		}
		
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
	<?
	if ($bt) {
	?>
		<td width="50%" class="arial10"><a href="#" onclick="window.print()">Print</a></td>
	<? } else { ?>
	  <td width="50%" class="arial10"><a href="#" onclick="NewWindow('../akunting/cetakbontagihan.php?detil=1&nopenagih=<?echo $np;?>&tglproses=<?echo $tglproses;?>&cb=<?echo $cb;?>&val=<?echo $val;?>&kwt=<?echo $kwt;?>','',600,400,1)"><img src="../img/print.gif" border="0"></a></td>
  <?}?>
  	<td width="50%" class="arial10" align="right"><a href="#" onclick="window.close()">Close</a></td>
	</tr>
</table>

</form>
</div>
</body>
</html>
