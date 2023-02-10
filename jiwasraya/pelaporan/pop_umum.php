<? 
  //include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";
	include "../../includes/pertanggungan.php";
	 $DBA = new Database($suid_GLLINK,$spass_GLLINK,$sdb_GLLINK);
	 $DBB = new Database($suid_GLLINK08,$spass_GLLINK08,$sdb_GLLINK08);
	
?>

<html>
<head>
<title>Detail Polis Pertanggungan Perorangan</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<div align="center">
DETAIL TRANSAKSI

	<?
	$i=1;
  $DB = new Database($userid, $passwd, $DBName);

// Kondisi Kantor
	if ($_GET["wherektr"]==''){
		 $wherektr="";
	}
	else if (substr($_GET["wherektr"],1,1)=='Z'){
		 $wherektr="prefixpertanggungan like '".substr($wherektr,0,1)."%' and ";	
	}
	else{
		 $wherektr="prefixpertanggungan='".$wherektr."' and ";	
	}

// Kondisi Valuta
	if ($_GET["wherevaluta"]==''){
		 $wherevaluta="";	
	}
	else{
		 $wherevaluta="kdvaluta=".$wherevaluta." and ";		
	}

// Kondisi Produk
	if ($_GET["whereproduk"]==''){
		 $whereproduk="";
	}
	else{
		 $whereproduk="kdproduk like '".$whereproduk."%' and ";	
	}
	
// Kondisi Kode Pertanggungan
	if ($_GET["wherepertanggungan"]==''){
		 $wherepertanggungan="kdpertanggungan='2' and ";
	}
	else{
		 $wherepertanggungan="";
	}

// Kondisi Field Tanggal yang akan dibuatkan perbandingan
	if ($_GET["fieldtgl"]==''){
		 $fieldtgl="mulas";
	}
			
  // Periode Tgl Dari s/d Tgl Sampai
  /*$sqa = "select * ".
         "from $DBUser.tabel_200_pertanggungan ".
  			 "where ".$wherektr.$wherevaluta.$whereproduk.$wherepertanggungan.
  			 "to_char(".$fieldtgl.",'YYYYMMDD')>='".$_GET["tglDariCari"]."' and to_char(".$fieldtgl.",'YYYYMMDD')<='".$_GET["tglSampaiCari"]."'";*/
	if ($posted=='all') {
				$whereposted="";
			}
			else if ($posted=='Y') {
				$whereposted="posted='Y' and ";
				//$post="Y";
			}
			else if ($posted=='N') {
				$whereposted="posted='N' and ";
				//$post="N";
			}
			
	if ($ktr==''){
			 		$wherektr="";
			 		$wherektr1="";
					$kdktr="";
					
					$namakantor="SELURUH KANTOR PT ASURANSI JIWA IFG";
			 }
			 elseif (substr($ktr,1,1)!='Z'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".$ktr."' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();					 
    		  while ($arr=$DB->nextrow()) {
								$namakantor=$arr["NAMAKANTOR"];
    			}					
			 		$wherektr="prefixpertanggungan='".$ktr."' and ";
			 		$wherektr1="kdkantor='".$ktr."' and ";
					$kdktr=$ktr;
  		 }
			 elseif (substr($ktr,1,1)=='Z'){
        	$sqa = "select k.kdkantor,k.namakantor ".
        	       "from $DBUser.tabel_001_kantor k ".
								 "where k.kdkantor='".substr($ktr,0,1)."A' ".
        				 "order by k.kdkantor";
    		  $DB->parse($sqa);
    			$DB->execute();					 
    		      			}
	
	//echo $wherektr1;
	//echo $whereposted;
if($thn<=2008){
if ($nourut=='A.1.') {
	$kdrekening=
			"('031000',
			'032000',
			'033000',
			'034000',
			'035000',
			'038000',
			'104000',
			'104001',
			'104002',
			'105001',
			'105003',
			'600000',
			'601000',
			'602000',
			'603000',
			'604000',
			'606000',
			'607000',
			'609000',
			'610000',
			'611000',
			'612000',
			'613000',
			'620000',
			'620001',
			'621000',
			'622000',
			'629000',
			'660000',
			'670000',
			'670001',
			'671000',
			'672000',
			'673000',
			'674000',
			'674001',
			'675000',
			'676000',
			'677000',
			'679000','104000', '104001','104002','105000','105001','105002')";}	
			else{
			$kdrekening=
			"('030000',
			'031000',
			'032000',
			'033000',
			'034000',
			'035000',
			'036000',
			'037000',
			'038000',
			'041000',
			'042000',
			'043000',
			'044000',
			'045000',
			'046000',
			'047000',
			'048000')";}	
	 
	
	//echo $_GET["nourut"].'</br>';
	//echo $nourut;
	//echo $kdrekening;		 
			 
	$sqa = "select a.kdkantor KDKANTOR, a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$whereposted." ".$wherektr1."substr(notrans,0,1) in ('B','K','M','L') and a.akun=b.akun and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
  //echo $sqa;
  $DBB->parse($sqa);
  $DBB->execute();
}
else{	
	if ($nourut=='A.1.') {
	$kdrekening=
			"('621604000',
			'622101000',
			'622102000',
			'622105000',
			'622201000',
			'622202000',
			'622203000',
			'622204000',
			'622205000',
			'622206000',
			'622207000',
			'622208000',
			'622209000',
			'622210000',
			'622211000',
			'622212000',
			'622301000',
			'622302000',
			'622303000',
			'622401000',
			'622402000',
			'622403000',
			'622404000',
			'623100000',
			'622104000',
			'622501000',
			'622502000',
			'622503000',
			'622505000',
			'131120000',
			'131210000',
			'131311000',
			'131321000',
			'131411000',
			'131421000',
			'142160000',
			'142180000',
			'145100000',
			'145200000',
			'145300000',
			'145100000','145200000','145300000','142150000','142160000','142170000')";}	
			else{
			$kdrekening=
			"('131110000',
			'131120000',
			'131210000',
			'131421000',
			'131411000',
			'131321000',
			'131500000',
			'131322000',
			'131311000',
			'132100000',
			'132200000',
			'132600000',
			'132700000',
			'132400000',
			'132800000',
			'132500000',
			'132300000')";}		 
	
	//echo $_GET["nourut"].'</br>';
	//echo $nourut;
	//echo $kdrekening;		 
			 
	$sqa = "select a.kdkantor KDKANTOR,a.akun AKUN, debet, kredit,NAMA, notrans, ket, to_char(to_date(kdtrans,'YYYYMMDD'),'DD/MM/YYYY') KDTRANS ".
			   "from $DBUser.tabel_802_trvouc a, $DBUser.tabel_802_kodeakun b ".
					 "where ".$whereposted." ".$wherektr1."substr(notrans,0,1) in ('B','K','M','L') and a.akun=b.akun and kdtrans>='".$tglDariCari."' and kdtrans<='".$tglSampaiCari."' and ".
					 $whereposted." a.akun in ".$kdrekening;
  //echo $sqa;
  $DBA->parse($sqa);
  $DBA->execute();
}  
  $polisvrdi1=0;
  $polisvrti1=0;
  $polisva1=0;
  $juavrdi1=0;
  $juavrti1=0;
  $juava1=0;
  $premivrdi1=0;
  $premivrti1=0;
  $premiva1=0;
?>
				  <table width="100%" border="0" cellpadding="1" cellspacing="1" class="tblisi">
					  <tr class='arial10' >
					  <td align="center" >No.</td>
					  <td align="center" >Kantor</td>
					  <td align="center" >Akun</td>
						<td align="center" >Keterangan</td>
						<td align="center">Debet</td>
						<td align="center" >Kredit</td>
						<td align="center" >Tanggal</td>
						<td align="center" >No. Trans</td>
						<td align="center" >Keterangan</td>
					 </tr>
<? 
if($thn<=2008){ 
  $dbase=$DBB;} 
  else {  	
  $dbase=$DBA;
}
//echo "while($arr=$DBA->nextrow()){";
while($arr=$dbase->nextrow()){
echo "<tr class='arial10' bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDKANTOR"];?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["AKUN"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NAMA"];?></td>
	<td align="right" style="border-right-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["DEBET"],2,',','.');?></td>
	<td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($arr["KREDIT"],2,',','.');?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KDTRANS"];?></td>
	<td align="center" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["NOTRANS"];?></td>
	<td align="left" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$arr["KET"];?></td>
	
<? echo "</tr>";
		$i++;
		$tdebet += $arr["DEBET"];
		$tkredit += $arr["KREDIT"];
  }
?>
	<tr class="arial10"><td colspan="4"></td><td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($tdebet,2,',','.');?></td><td align="right" style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=number_format($tkredit,2,',','.');?></td></tr>				 
	</table>
		 
<!--
<table width="100%">
	<tr>
    <td width="50%" class="arial10" align="left"><a href="#" onclick="window.print()">Print</a></td>
		<td width="50%" class="arial10" align="right"><a href="#" onclick="window.close()">Close</a></td>
	</tr>
</table>
-->

</div>
<br>
<? 
	 echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; 
?>
</body>
</html>
