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
	$sql="select substr(nobuktibank,21) namafile from $DBUser.tabel_800_pembayaran_keluar where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and nobuktibank is not null";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
?>
<html>
<head><title>Dokumen</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0">
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1431</font></td></tr>
</table>
	<font face="Verdana" size="2"><b>Daftar Dokumen<?echo ($noproposal==$nopertanggungan) ? "Proposal Nomor ".$prefixpertanggungan."-".$nopertanggungan : '';?></b> </font>
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
  <td>No.</td>
  <td align="left">Dokumen</td></tr>
  
<?
	
  //echo $kprod; //ini untuk CB sekaligus dan skg=1
  $no=1;
	while($arr=$DB->nextrow()) {
		echo "<tr><td class=verdana8 align=center>".$no."</td>";
		echo "<td class=verdana8><a href=http://192.168.4.29:8003/files/file/document/".$arr["NAMAFILE"].">".$arr["NAMAFILE"]."</a></td></tr>";
		$no++;
	}
  
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
