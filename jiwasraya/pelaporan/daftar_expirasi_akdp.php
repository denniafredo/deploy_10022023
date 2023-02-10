<?
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";

$DB=new Database($userid, $passwd, $DBName);
$DBA=new Database($userid, $passwd, $DBName);
$DB1=new Database($userid, $passwd, $DBName);
	
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
				 <td align="center" colspan="2">JATUH TEMPO / ROLL OVER POLIS AKDP <?echo $kantor;?> BULAN <?echo $blnjatuh;?></td>
			</tr>

			<tr>
				 <td align="center" colspan="2">
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					 <tr class="hijao">
					  <td align="center">No</td>
						<td align="center">Nomor Polis</td>
						<td align="center" >Pemegang Polis</td>
						<td align="center">Jatuh Tempo</td>
						<td align="center">Akhir Premi</td>
						<td align="center">Produk</td>						
						<td align="center">Agen</td>
						<td align="center">Alamat Tagih</td>
						<td align="center">Telepon</td>												
						<td align="center">JUA</td>						
						<td align="center">RollOver</td>
					 </tr>
										 
<?
  	$i=1;
		

 	
 
	  $sql = "select a.prefixpertanggungan, a.nopertanggungan,  a.premi1,namaklien1,replace(NVL(NO_PONSEL, nvl(PHONETETAP02,nvl(PHONETETAP01,nvl(PHONETAGIH01,PHONETAGIH02)))),'-','') phone,
      alamattagih01||alamattagih02||', '||
      (select namakotamadya from $DBUser.TABEL_109_KOTAMADYA where kdkotamadya=d.kdkotamadyatagih)||', '||
      (select namapropinsi from $DBUser.TABEL_108_PROPINSI  where kdpropinsi=d.kdpropinsitagih)||' '||kodepostagih alamattagih
      , a.juamainproduk,a.kdproduk,
      (select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen)namaagen,      
      to_char(a.expirasi,'DD/MM/YYYY') expirasi
      ,to_char(a.tglakhirpremi,'DD/MM/YYYY') akhirpremi,nvl(kdcetakpolis,'0') kdcetakpolis,to_char(tglcetakpolis,'dd/mm/yyyy') tglcetakpolis,to_char(tglrollover,'dd/mm/yyyy')tglrollover,
	  (select count(*) from $DBUser.tabel_300_historis_premi where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and trunc(tglbooked)=trunc(tglrollover)) statusrollover
      from $DBUser.tabel_200_pertanggungan a,
      $DBUser.tabel_500_penagih b, $DBUser.tabel_305_cara_bayar h,$DBUser.tabel_100_klien d,
      $DBUser.polis_akdp_rollover e 
      where a.nopenagih=b.nopenagih 
      and b.kdrayonpenagih='$kantor'     
      and a.kdpertanggungan = '2'
      and a.kdstatusfile='1'
      and a.nopemegangpolis=d.noklien
      and substr(a.kdproduk,1,2) = 'PA'      
      and h.kdcarabayar=a.kdcarabayar
      and a.prefixpertanggungan=e.prefixpertanggungan
      and a.nopertanggungan=e.nopertanggungan  ";

					 //echo $sql;
					 $DB->parse($sql);
					 $DB->execute();
					 $jml=0;
					 while ($arr=$DB->nextrow()) {	
					 	$PER = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);		 			 	
						include "../../includes/belang.php";	
					     print( "<td class=arial8 align=\"center\">$i</td>\n" );
  						 
  						 print( "<td class=arial8 align=\"center\"><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$PER->label."</a></td>\n" );
  						 print( "<td class=verdana8 align=\"left\">".$PER->namapemegangpolis."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["EXPIRASI"]."</td>\n" );
							 print( "<td class=arial8 align=\"center\">".$arr["AKHIRPREMI"]."</td>\n" );
  						 print( "<td class=verdana8 align=\"left\">".$PER->produk."</td>\n" );							
  						 print( "<td class=verdana8 align=\"left\">(".$PER->noagen.") ".$PER->namaagen."</td>\n" );
  						 print( "<td class=arial8 align=\"left\">".$arr["ALAMATTAGIH"]."</td>\n" );
  						 print( "<td class=arial8 align=\"center\">".$arr["PHONE"]."</td>\n" );
  						 print( "<td class=arial8 align=\"right\">".number_format($arr["JUAMAINPRODUK"],2)."</td>\n" );  						 
						
						 if($arr["KDCETAKPOLIS"]=="0" && $arr["STATUSROLLOVER"]=="0"){
							 print( "<td align=\"center\" class=arial8>Dalam Proses Pelunasan\n" );
						 }elseif($arr["KDCETAKPOLIS"]=="0" && $arr["STATUSROLLOVER"]=="1"){
							 print( "<td align=\"center\" class=arial8><a href=\"#\" onclick=\"NewWindow('../proposal/ulink/test.cetak.sertifikat.akdp_rollover.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."&tglrollover=".$arr["TGLROLLOVER"]."','',800,500,1)\">Cetak Polis</a>\n" );
						 }elseif($arr["KDCETAKPOLIS"]=="1" && $arr["STATUSROLLOVER"]=="1"){
							 print( "<td align=\"center\" class=arial8><a href=\"#\" onclick=\"NewWindow('../proposal/peliharapolis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">Dicetak Tgl.".$arr["TGLCETAKPOLIS"]."</a>\n" );
						 }
  						 
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
