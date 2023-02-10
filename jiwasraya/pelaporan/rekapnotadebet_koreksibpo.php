<? 

	  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";	
//	$kon=ocilogon("CKADM","CKADM","CKADM");
$DB=new database($userid, $passwd, $DBName);
//if((date("d")=="1" || date("d")=="2" || date("d")=="3") || ($userid=="BAGUS" || $userid=="DEDI" || $userid=="YUNITA_H"|| $userid=="TATI_BC")){
//if((date("Y-m-d")==date("Y-m-t")) || ($userid=="DEDI" || $userid=="YUNITA_H" || $userid=="TITIN_EH")){
	?>
<html>
<head>
<title>Untitled</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<!--<meta http-equiv="refresh" content="1000;url=http://192.168.2.23/jiwasraya/pelaporan/lipp_ob1.php" />-->  
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 

input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

-->
</style>
</head>
<body>
<table width="1000">
  <tr class="arial10blkb">
    <td width="100%" align="center">&nbsp;</td>
	</tr>
</table>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Bulan Entry</td>
	<td> <?  DateSelector("v"); ?>	<select name="kdkuitansi">
    <option value="NB">NB</option>
    <option value="OB">OB</option>
    </select></td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?		
	//$uraian=array("SALDO AWAL","NOTA TAGIHAN PREMI BERKALA LANJUTAN","PEMBTAN TAGIHAN","RETOUR TAGIHAN","JUMLAH TAGIHAN","PELUNASAN","SALDO AKHIR");	
	
		      if($vbln==""){
							   $DB=new database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode=" a.tglbooked=to_date('$thisperiode', 'MMYYYY')";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode=" tglbooked=to_date('$thisperiode', 'YYYY')";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode=" tglbooked=to_date('$thisperiode', 'MMYYYY')";
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
$DB=new database($userid, $passwd, $DBName);	

 $periodenya=$bln.$vthn;
 //echo $periodenya;
				//$CK->parse($qry);
				//$CK->execute();			
				//$hasil=$CK->affected();
				//echo $hasil;	
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>KOREKSI NOTA DEBET  KANTOR $kantor PERIODE ".strtoupper($blnn)." $vthn KUITANSI $kdkuitansi</b></font><br><br>";
					 echo "<table border=1 style='border-collapse:collapse' bordercolor=#333333>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>CABAS/REKENING</b></td>";
					 echo "<td align=center><b>VALUTA</b></td>";
					 echo "<td align=center><b>JUMLAH KWT</b></td>";
					 echo "<td align=center><b>JUMLAH PREMI</b></td>";
					 echo "<td align=center><b>KURS</b></td>";
					 echo "<td align=center><b>PREMI HITUNGAN</b></td>";
  				 echo "</tr>";
				/* $sql="SELECT   a.prefixpertanggungan,
         a.nopertanggungan,
         d.namaklien1,
         (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=b.kdcarabayar) carabayar,
         TO_CHAR (a.tglbooked, 'dd/mm/yyyy') tglbooked,
         DECODE (a.kdvaluta, '1', 'RUPIAH', '3', 'ASING', 'INDEX') valuta,
         a.nilairp,
         a.kdrekeninglawan
  FROM   $DBUser.tabel_300_historis_premi a,
         $DBUser.tabel_200_pertanggungan b,
         $DBUser.tabel_500_penagih c,
         $DBUser.tabel_100_klien d
 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
         AND a.nopertanggungan = b.nopertanggungan
         AND b.nopenagih = c.nopenagih
         AND b.nopemegangpolis = d.noklien
         AND c.kdrayonpenagih = '$kantor'
		 AND a.kdkuitansi not in ('BP3')
         AND TO_CHAR (a.tglbooked, 'mmyyyy') = '$periodenya'";	*/
		 $sqlkurs="select kurs,kdvaluta from $DBUser.tabel_999_kurs where to_char(tglkursberlaku,'mmyyyy')='$periodenya'";
		 $DB->parse($sqlkurs);
		 $DB->execute();
		 while($arrkurs=$DB->nextrow())
		 {
			 if($arrkurs["KDVALUTA"]=="0")
			 $kursindex=$arrkurs["KURS"];
			 else
			 $kursdolar=$arrkurs["KURS"];
		 }
		 
		 if($kdkuitansi!=""){
			 /*$sql="select a.kdvaluta,decode(a.kdvaluta,'1','RUPIAH','0','INDEX','3','DOLLAR') valuta,a.kdrekeningpremi,a.kdrekeninglawan,count(nilairp) jmlkwt,sum(nilairp) jmlnilairp,
(select nvl(kdcabas,'LL5') from $DBUser.TABEL_802_JURNAL_TEMPLATE where akun=a.kdrekeningpremi) cabas,  
sum(decode(a.kdvaluta,'0',a.premitagihan/b.indexawal,'1',a.premitagihan,'3',a.premitagihan)) jmlpremi
 FROM   $DBUser.tabel_300_historis_premi a,
         $DBUser.tabel_200_pertanggungan b,
         $DBUser.tabel_500_penagih c        
 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
         AND a.nopertanggungan = b.nopertanggungan
         AND b.nopenagih = c.nopenagih    
         AND c.kdrayonpenagih = '$kantor'
         AND substr(a.kdkuitansi,1,2) = '$kdkuitansi'
         AND TO_CHAR (a.tglbooked, 'mmyyyy') = '$periodenya' ". 
         //"AND a.kdvaluta='0' ".
         "group by a.kdrekeningpremi,a.kdrekeninglawan,a.kdvaluta";*/
		 
		 $sql="select * from $DBUser.TABEL_300_NOTADEBET_BPO where kdkantor = '$kantor'
         AND substr(kdkuitansi,1,2) = '$kdkuitansi'
         AND TO_CHAR (blnbooked, 'mmyyyy') = '$periodenya' and statusbilling='KOREKSIBPO'";
		 //echo $sql;
		 $DB->parse($sql);
		 $DB->execute();	
		 $i=1;	 
		 }
			while($arr=$DB->nextrow()){
			include "../../includes/belang.php";
			echo "<td align=center>$i.</td>";
			echo "<td align=center>";
			if($arr["CABAS"]=="")
			echo "LL5";
			else
			echo $arr["CABAS"];
			echo " / ".$arr["KDREKENINGPREMI"]." / ".$arr["KDREKENINGLAWAN"]."</td>";
			echo "<td align=center>".$arr["VALUTA"]."</td>";
			echo "<td align=right>".$arr["JMLKWT"]."</td>";
			echo "<td align=right>".number_format($arr["JMLPREMI"],2)."</td>";
			echo "<td align=right>";
			if($arr["KDVALUTA"]=="3"){
				 $kursnya=$kursdolar;
			}elseif($arr["KDVALUTA"]=="0"){
				 $kursnya=$kursindex;
			}else{
				 $kursnya=1;
			}
			echo number_format($kursnya,2)."</td>";
			echo "<td align=right>".number_format( $arr["JMLPREMI"] *$kursnya,2)."</td>";
			echo "</tr>";
			$i++;
			$totalpremi=$totalpremi+$arr["JMLNILAIRP"];
			}
			echo "<tr>";
			echo "<td align=right colspan=6><strong>Total Premi</strong></td>";
			echo "<td align=right><strong>".number_format($totalpremi,2)."</strong></td>";			
			echo "</tr>";						 
           echo "</table>";					
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>  |   ";

echo "<a href=# onclick=NewWindow('dl_notadebet.php?act=printY&periodenya=".$periodenya."&ktr=".$kantor."','',700,400,1)><font face=\"Verdana\" size=\"2\">Download Excel</font></a> ";
//}else{
//	echo "Menu Ini Hanya Dapat Diakses pada Tanggal 1,2,3 setiap bulannya";
//}
?>

