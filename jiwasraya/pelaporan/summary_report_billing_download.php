<? 

	  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
//	$kon=ocilogon("CKADM","CKADM","CKADM");
$DB=new database($userid, $passwd, $DBName);
//if((date("d")=="1" || date("d")=="2" || date("d")=="3") || ($userid=="DEDI" || $userid=="YUNITA_H" || $userid=="TITIN_EH" || $userid=="TATI_BC")){

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=summary_report_billing.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
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
	<!--table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Bulan Entry</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
  </tr>
	</form>
	</table-->
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

$periode = $_GET['periode'];
$act = $_GET['act'];
  echo "<hr size=1>";
	echo "<div align=center>";
  				 //echo "<font color=\"003399\" face=verdana size=2><b>RINCIAN NOTA DEBET  $kantor PERIODE ".strtoupper($blnn)." $vthn</b></font><br><br>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>SUMMARY REPORT BILLING</b></font><br><br>";
					 echo "<table border=1 style='border-collapse:collapse' bordercolor=#333333>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>NOMOR POLIS</b></td>";
					 echo "<td align=center><b>KODE RAYON</b></td>";
					 echo "<td align=center><b>PEMEGANG POLIS</b></td>";
					 echo "<td align=center><b>CARA BAYAR</b></td>";
					 
					 echo "<td align=center><b>MULAS</b></td>";
					 echo "<td align=center><b>TGLAKHIRPREMI</b></td>";
					 echo "<td align=center><b>KDPRODUK</b></td>";
					 echo "<td align=center><b>KDCABAR</b></td>";
					 
					 echo "<td align=center><b>TGL. BOOKED</b></td>";
					 echo "<td align=center><b>VALUTA</b></td>";
					 echo "<td align=center><b>PREMI</b></td>";
					 echo "<td align=center><b>PREMI RP</b></td>";
					 echo "<td align=center><b>PREMI RIDER</b></td>";
					 echo "<td align=center><b>PREMI RP + RIDER</b></td>";
					 
					 echo "<td align=center><b>POKOK TERBILING</b></td>";
					 echo "<td align=center><b>POKOK JUMLAH TERBILING</b></td>";
					 echo "<td align=center><b>POKOK USER_BILLING</b></td>";
					 echo "<td align=center><b>POKOK TGL_BILLING</b></td>";
					 
					 echo "<td align=center><b>RIDER TERBILING</b></td>";
					 echo "<td align=center><b>RIDER JUMLAH TERBILING</b></td>";
					 echo "<td align=center><b>RIDER USER_BILLING</b></td>";
					 echo "<td align=center><b>RIDER TGL_BILLING</b></td>";
					 
  				 echo "</tr>";
				 $sql="select PREFIXPERTANGGUNGAN,NOPERTANGGUNGAN,
							   (select namaklien1 
								from $DBUser.tabel_200_pertanggungan c,$DBUser.TABEL_100_KLIEN b 
								where c.NOPEMEGANGPOLIS = b.NOKLIEN 
								and c.prefixpertanggungan = a.prefixpertanggungan
								and c.nopertanggungan = a.nopertanggungan) namaklien1,
								PERIODE TGLBOOKED,			
								(select kdrayonpenagih 
                                from $DBUser.tabel_200_pertanggungan c,$DBUser.tabel_500_penagih f
                                where c.prefixpertanggungan = a.prefixpertanggungan
                                and c.nopertanggungan = a.nopertanggungan
                                and C.nopenagih = f.nopenagih) kdrayonpenagihan,								
							   (
							   (SELECT   NAMACARABAYAR
								FROM   $DBUser.tabel_200_pertanggungan c, $DBUser.tabel_305_cara_bayar f
							   WHERE       c.KDCARABAYAR = f.kdcarabayar
							   and  c.prefixpertanggungan = a.prefixpertanggungan
									   AND c.nopertanggungan = a.nopertanggungan)
							   )
								carabayar,
							   MULAS,TGLAKHIRPREMI,KDPRODUK,KDCABAS,TO_CHAR(PERIODE,'MM/YYYY') PERIODE_BOOKED, 
							   (SELECT NAMAVALUTA FROM $DBUser.TABEL_304_VALUTA WHERE KDVALUTA = A.KDVALUTA) VALUTA,
							   case when (sysdate-MULAS)/365 <= 5 then
                                    PREMI1
                               else
                                    PREMI2
                               end PREMITAGIHAN,
                               case when KDVALUTA = 1 then
                                    case when (sysdate-MULAS)/365 <= 5 then
                                        PREMI1
                                    else
                                        PREMI2
                                    end
                               WHEN KDVALUTA = 0 THEN
                                    case when (sysdate-MULAS)/365 <= 5 then
                                        PREMI1
                                    else
                                        PREMI2
                                    end *
                                    (SELECT     kurs 
                                    FROM      $DBUser.TABEL_999_KURS_TRANSAKSI 
                                    WHERE     kdvaluta = '0'
                                        AND    tglkursberlaku = (SELECT max(tglkursberlaku)
                                                        FROM  $DBUser.TABEL_999_KURS_TRANSAKSI 
                                                         WHERE kdvaluta = '0'
                                                             AND   tglkursberlaku <= sysdate))
                               WHEN KDVALUTA = 3 THEN
                                    case when (sysdate-MULAS)/365 <= 5 then
                                        PREMI1
                                    else
                                        PREMI2
                                    end *                                    
                                    (SELECT     kurs 
                                    FROM      $DBUser.TABEL_999_KURS_TRANSAKSI 
                                    WHERE     kdvaluta = '3'
                                        AND    tglkursberlaku = (SELECT max(tglkursberlaku)
                                                        FROM  $DBUser.TABEL_999_KURS_TRANSAKSI 
                                                         WHERE kdvaluta = '3'
                                                             AND   tglkursberlaku <= sysdate))                                          
                               END NILAIRP,
							   case when KDVALUTA = 1 then
                                    case when (sysdate-MULAS)/365 <= 5 then
                                        PREMI1
                                    else
                                        PREMI2
                                    end
                               WHEN KDVALUTA = 0 THEN
                                    case when (sysdate-MULAS)/365 <= 5 then
                                        PREMI1
                                    else
                                        PREMI2
                                    end *
                                    (SELECT     kurs 
                                    FROM      $DBUser.TABEL_999_KURS_TRANSAKSI 
                                    WHERE     kdvaluta = '0'
                                        AND    tglkursberlaku = (SELECT max(tglkursberlaku)
                                                        FROM  $DBUser.TABEL_999_KURS_TRANSAKSI 
                                                         WHERE kdvaluta = '0'
                                                             AND   tglkursberlaku <= sysdate))
                               WHEN KDVALUTA = 3 THEN
                                    case when (sysdate-MULAS)/365 <= 5 then
                                        PREMI1
                                    else
                                        PREMI2
                                    end *                                    
                                    (SELECT     kurs 
                                    FROM      $DBUser.TABEL_999_KURS_TRANSAKSI 
                                    WHERE     kdvaluta = '3'
                                        AND    tglkursberlaku = (SELECT max(tglkursberlaku)
                                                        FROM  $DBUser.TABEL_999_KURS_TRANSAKSI 
                                                         WHERE kdvaluta = '3'
                                                             AND   tglkursberlaku <= sysdate))                                          
                               END  +
							   PREMI_RIDER_POLIS NILAIRUPIAH,
							   PREMI1,PREMI2,PREMI_RIDER_POLIS,
							   TERBILLING,JML_TERBILLING,TGL_BILLING,USER_BILLING,TERBILLING_RIDER,JML_TERBILLING_RIDER,TGL_BILLING_RIDER,USER_BILLING_RIDER 
						from $DBUser.summary_report_status_billing A
						where TO_CHAR(PERIODE,'MM/YYYY') = '$periode' ";		 
		 //$tglrekam." AND BILLSTATUS='1'".	
		 //"AND TO_CHAR(a.tglrekam,'ddmmyyyy')='01".$periodenya."' $tglrekam";
		 //"AND BILLSTATUS='1'";	
		 if ($act=='SUKSES'){
			 $sql .= " and terbilling = '1' ";
		 }
		 //echo $sql;
		 //die;
		 $DB->parse($sql);
		 $DB->execute();	
		 $i=1;	 
			while($arr=$DB->nextrow()){
			include "../../includes/belang.php";
			echo "<td align=center>$i.</td>";
			echo "<td align=center>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>";
			echo "<td align=left>".$arr["KDRAYONPENAGIHAN"]."</td>";			
			echo "<td align=left>".$arr["NAMAKLIEN1"]."</td>";			
			echo "<td align=center>".$arr["CARABAYAR"]."</td>";
			
			echo "<td align=center>".$arr["MULAS"]."</td>";
			echo "<td align=center>".$arr["TGLAKHIRPREMI"]."</td>";
			echo "<td align=center>".$arr["KDPRODUK"]."</td>";
			echo "<td align=center>".$arr["KDCABAS"]."</td>";
			
			echo "<td align=center>".$arr["TGLBOOKED"]."</td>";
			echo "<td align=center>".$arr["VALUTA"]."</td>";
			echo "<td align=right>".number_format($arr["PREMITAGIHAN"],2,",",".")."</td>";
			echo "<td align=right>".number_format($arr["NILAIRP"],2,",",".")."</td>";
			echo "<td align=right>".number_format($arr["PREMI_RIDER_POLIS"],2,",",".")."</td>";
			echo "<td align=right>".number_format($arr["NILAIRUPIAH"],2,",",".")."</td>";
			
			echo "<td align=center>".$arr["TERBILLING"]."</td>";
			echo "<td align=center>".$arr["JML_TERBILLING"]."</td>";
			echo "<td align=center>".$arr["USER_BILLING"]."</td>";
			echo "<td align=center>".$arr["TGL_BILLING"]."</td>";
			
			echo "<td align=center>".$arr["TERBILLING_RIDER"]."</td>";
			echo "<td align=center>".$arr["JML_TERBILLING_RIDER"]."</td>";
			echo "<td align=center>".$arr["USER_BILLING_RIDER"]."</td>";
			echo "<td align=center>".$arr["TGL_BILLING_RIDER"]."</td>";
						
			echo "</tr>";
			$i++;
			$totalpremi=$totalpremi+$arr["NILAIRP"];
			$totalpremi_rp_rdr=$totalpremi_rp_rdr+$arr["NILAIRUPIAH"];
			}
			echo "<tr>";
			echo "<td align=right colspan=7><strong>Total Premi</strong></td>";
			echo "<td align=right><strong>".number_format($totalpremi,2)."</strong></td>";
			echo "<td align=right><strong>".number_format($totalpremi_rp_rdr,2)."</strong></td>";
			echo "<td align=left>&nbsp;</td>";
			echo "</tr>";						 
           echo "</table>";					
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"../submenu.php?mnuinduk=600\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>  |   ";

echo "<a href=# onclick=NewWindow('dl_rinciannotadebet.php?act=printY&periodenya=".$periodenya."&ktr=".$kantor."','',700,400,1)><font face=\"Verdana\" size=\"2\">Download Excel</font></a> ";
//}else{
//	echo "Menu Ini Hanya Dapat Diakses pada Tanggal 1,2,3 setiap bulannya";
//}
?>

