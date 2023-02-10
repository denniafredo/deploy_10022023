<?
  include "../../includes/session.php";
  include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/formula44.php";

	//echo $prefix;

	$prefix= (!$prefixpertanggungan) ? $prefix : $prefixpertanggungan;
	$noper = (!$nopertanggungan) ? $noper : $nopertanggungan;
	$DB=new database($userid, $passwd, $DBName);
	$PER=New Pertanggungan($userid,$passwd,$prefix,$noper);

	$FM=new Formula($userid,$passwd,$prefix,$noper);
  
	
/*premi dalam tabel adalah premi dalam tahun*/


	$sql="select c.skg,a.noagen,a.kdproduk,b.kdjeniscb,a.kdcarabayar,b.namacarabayar,b.faktorkomisi,".
			 "decode(a.kdvaluta,'0','Rp Index','1','Rupiah','US Dollar') valuta, ".
			 "decode(c.skg,'1','1','0') kprod ".
			 "from $DBUser.tabel_200_temp a,$DBUser.tabel_305_cara_bayar b,$DBUser.tabel_202_produk c ".
	     "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and ".
			 "a.kdcarabayar=b.kdcarabayar and a.kdproduk=c.kdproduk";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$s=$DB->nextrow();
	$cabayar=$s["KDCARABAYAR"];
	$kdproduk=$s["KDPRODUK"];
	$noagen=$s["NOAGEN"];
	$cabar=$s["NAMACARABAYAR"];
	$faktorkomisi=$s["FAKTORKOMISI"];
	$valuta=$s["VALUTA"];
	$kdjeniscb=$s["KDJENISCB"];
	$kprod=$s["KPROD"];
	$skg=$s["SKG"];
	$show=0;



if (is_null($cabayar) || $cabayar==''){
	$sql="select c.skg,a.noagen,b.kdjeniscb,a.kdcarabayar,b.namacarabayar,b.faktorkomisi,".
	     "decode(a.kdvaluta,'0','Rp Index','1','Rupiah','US Dollar') valuta, ".
			 "decode(c.skg,'1','1','0') kprod ".
			 "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar b ,$DBUser.tabel_202_produk c ".
	     "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and ".
			 "a.kdcarabayar=b.kdcarabayar and a.kdproduk=c.kdproduk";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$x=$DB->nextrow();
	$cabayar=$x["KDCARABAYAR"];
	$noagen=$x["NOAGEN"];
	$cabar=$x["NAMACARABAYAR"];
	$faktorkomisi=$x["FAKTORKOMISI"];
	$valuta=$x["VALUTA"];
	$kdjeniscb=$x["KDJENISCB"];
	$kprod=$x["KPROD"];
	$skg=$x["SKG"];
	$show=1;
}


/**************************************************ATTENTION*****************************************/
/* Komisi sekaligus beberapa produk kampret tidak dikalikan 1,14
/* kprod = 1 artinya anuitas dimana faktor pengali 1.14 untuk sekaligusnya dioverride, untuk yang berkala tetap
//"decode(b.kdkomisiagen,'02',a.komisiagen,decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',decode('$skg','1',a.komisiagen,a.komisiagen*$faktorkomisi),a.komisiagen*$faktorkomisi) ) k ".
/**************************************************ATTENTION*****************************************/
 
 $KL=New Klien ($userid,$passwd,$noagen);
 
 if((substr($PER->produk,0,3)=="JL2"||substr($PER->produk,0,3)=="JL3") && $PER->jenis=="Polis"){
   $filterkdkomisi = "and b.kdkomisiagen in('01','10','31','32','29') ";
 } else {
   $filterkdkomisi = "and b.kdkomisiagen not in('04','30')";
 }
	$sql="select ".
					 "a.thnkomisi,a.komisiagen,b.namakomisiagen,b.kdkomisiagen, ".
    	     "decode(b.kdkomisiagen,'02',0,a.komisiagen) ko, ".
    			 "decode(b.kdkomisiagen,'02',b.namakomisiagen,b.namakomisiagen||' TAHUN '||a.thnkomisi) nk, ".
    	     "decode(b.kdkomisiagen,'02',a.komisiagen,decode('$kprod','1',decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen),decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen*$faktorkomisi) ) ) k, ".
    			 "a.komisiagencb  ".
			 "from ".
			     "$DBUser.tabel_404_temp a, ".
					 "$DBUser.tabel_402_kode_komisi_agen b ".
			 "where ".
    			 "a.kdkomisiagen=b.kdkomisiagen and ".
    			 "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper' ".
					 $filterkdkomisi.
			 "order by b.namakomisiagen desc,a.thnkomisi";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
?>
<html>
<head><title>Hitung Komisi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0">
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1431</font></td></tr>
</table>
	<font face="Verdana" size="2"><b>Komisi Agen Penutup <?echo ($noproposal==$nopertanggungan) ? "Proposal Nomor "./*$prefixpertanggungan."-".$nopertanggungan*/$PER->nopolbaru : '';?></b> </font>
  <hr size=1>
	<table cellspacing="0" cellpadding="1" width="100%" class="tblisi">
	<tr>
	  <td class="verdana8blk"><? if ($show) { echo "No. Polis"; }?></td>
	  <td class="verdana8blk"><? if ($show) { echo ":"; }?></td>
	  <td class="verdana8blk"><? if ($show) { echo ($PER->nopolbaru?$PER->nopolbaru:$prefix." - ".$noper); }?></td>

	</tr>
	<tr>
	  <td class="verdana8blk">Agen</td>
	  <td class="verdana8blk">:</td>
	  <td class="verdana8blk"><? echo $KL->nama; ?></td>
	</tr>
	<tr>
	  <td class="verdana8blk">Valuta</td>
	  <td class="verdana8blk">:</td>
	  <td class="verdana8blk"><? echo strtoupper($valuta); ?></td>
	</tr>
	<tr>
	  <td class="verdana8blk">Cara bayar</td>
	  <td class="verdana8blk">:</td>
	  <td class="verdana8blk"><? echo $cabar; ?></td>
	</tr>
	</table>
  <hr size=1>

	<table cellspacing="0" cellpadding="1" width="100%" class="tblisi">
  <tr class="tblhead" align="center">
  <td rowspan="2" >Tahun</td>
  <td  rowspan="2">Nama Komisi</td>
  <td colspan="2">K o m i s i</td>
  </tr>
  <tr class="tblhead1" align="center">
  <td>Dalam Tahun</td>
  <td align="right">Sesuai Cara Bayar</td>
  </tr>
<?
	$jmlkomisi=0;
	$i=0;
  //echo $kprod; //ini untuk CB sekaligus dan skg=1
	while($arr=$DB->nextrow()) {
	 //echo $arr["KOMISIAGEN"]."|".$arr["KOMISIAGENCB"]."|".$arr["K"];
	 if ($arr["K"]==0) {
	 } else {
		include "../../includes/belang.php";
		$ko = $arr["KO"];
		$k  = $arr["K"];
		$ko =  (($kdjeniscb=='X')) ? $k : $ko;
	  $add = ($arr["KDKOMISIAGEN"]=='02') ? $k : $ko;
 		$astar = (round($ko) <> round($arr["KOMISIAGEN"]) ) ? '<font color=red>*</font>' : '';
		$aster = (round($k) <> round($arr["KOMISIAGENCB"]) ) ? '*' : '';
//Revision by Ari on August 1st, 2006
		$ko = ($ko==0) ? '' : number_format((substr($kdproduk,0,5)=='JSSPO' && substr($kdproduk,0,5)!='JSSPD') ? round($ko,-3) : $ko,2);
		$k = ($k==0) ? '' : number_format((substr($kdproduk,0,5)=='JSSPO' && substr($kdproduk,0,5)!='JSSPD') ? round($k,-3) : $k,2);
//		$ko = ($ko==0) ? '' : number_format((substr($kdproduk,0,4)=='JSSP') ? round($ko,-3) : $ko,2);
//		$k = ($k==0) ? '' : number_format((substr($kdproduk,0,4)=='JSSP') ? round($k,-3) : $k,2);
		echo "<td align=\"center\" class=verdana8>".$arr["THNKOMISI"]."</font></td>";
		echo "<td class=verdana8>".$arr["NK"]."".$astar.$aster."</font></td>";
	  echo "<td align=\"right\" class=verdana8>".$ko."</font></td>";
		echo "<td align=\"right\" class=verdana8>".$k."</font></td>";
	  echo "</tr>";
		$i++;
		$jmlkomisi += (substr($kdproduk,0,5)=='JSSPO') ? round($add, -3) : $add;
	 }
	}
  echo "<tr class=tblhead>";
  echo "<td colspan=\"2\" align=right>Jumlah Total Komisi</td>";
  echo "<td align=\"right\" >".number_format($jmlkomisi,2)."</td>";
  echo "<td></td></tr>";
	echo "</table></div>";
?>
  <hr size=1>
	<table width="100%\">
	<tr class="arial10">
	<td><a href="#" onClick="javascript:window.print();">Print</a></td>
	<td align="right"><a href="#" onClick="javascript:window.close();">Close</a></td>
	</tr>
	</table>

</body>
</html>
