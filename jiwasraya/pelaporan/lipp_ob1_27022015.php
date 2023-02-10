<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	$kon=ocilogon($userid,$passwd,"JSDB");
$CK=new database($userid, $passwd, $DBName);
	?>
<html>
<head>
<title>Untitled</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<!--<meta http-equiv="refresh" content="1000;url=http://192.168.2.23/jiwasraya/pelaporan/lipp_ob1.php" />  -->
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
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
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?		
	$uraian=array("SALDO AWAL","NOTA TAGIHAN PREMI BERKALA LANJUTAN","PEMBTAN TAGIHAN","RETOUR TAGIHAN","JUMLAH TAGIHAN","PELUNASAN","SALDO AKHIR");	
	
		      if($vbln==""){
							   $DB=new Database($userid, $passwd, $DBName);
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 $periode=" b.blnbooked=to_date('$thisperiode', 'MMYYYY')";
								 $periodesaldo=" b.blnbooked=add_months(to_date('$thisperiode', 'MMYYYY'),-1)";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode=" b.blnbooked=to_date('$thisperiode', 'YYYY')";
					 $periodesaldo=" b.blnbooked=add_months(to_date('$thisperiode', 'YYYY'),-12)";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode=" b.blnbooked=to_date('$thisperiode', 'MMYYYY')";
					 $periodesaldo=" b.blnbooked=add_months(to_date('$thisperiode', 'MMYYYY'),-1)";
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
$DB=new Database($userid, $passwd, $DBName);	

 
				//$CK->parse($qry);
				//$CK->execute();			
				//$hasil=$CK->affected();
				//echo $hasil;	
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>LAPORAN INKASO PERTANGGUNGAN PERORANGAN PREMI BERKALA LANJUTAN $kantor PERIODE ".strtoupper($blnn)." $vthn</b></font><br><br>";
					 ?>
                     <table border=1 style="border-collapse:collapse" bordercolor="#333333">
					 <tr class="hijao">
					 <td align=center><b>NO.</b></td>
					 <td align=center><b>Uraian</b></td>
					 <td align=center><b>Valuta/CABAS</b></td>
                     <td align=center><b>Rekening Premi</b></td>
					 <td align=center><b>Jumlah Kuitansi</b></td>
					 <td align=center><b>Jumlah Premi</b></td>
					 <td align=center><b>Jumlah Premi(Rp)</b></td>
  				 </tr>
				 
					
				<?	
		
				//Rekap Untuk Saldo Awal
				 echo "<tr bgcolor=#CC99FF><td class=verdana8blk rowspan=143>1.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=143><b>SALDO AWAL</b></td>";
				 echo "<td class=verdana8blk align=left></td>";				 								
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";	
				 echo "</tr>";			 
					$qrysaldo = "SELECT   a.cabval,
           a.kdrekeningpremi,
           NVL (SUM (jmlkwt), 0) jmlkwt,
           NVL (SUM (jmlpremi), 0) jmlpremi,
           NVL (SUM (jmlnilairp), 0) jmlrp
    FROM      $DBUser.tabel_203_valkuit a
           LEFT JOIN
              $DBUser.tabel_300_notadebet_sa b
           ON     a.kdrekening = b.kdrekeningpremi
              AND $periode
              AND b.kdkantor = '$kantor'
GROUP BY   a.cabval, a.kdrekeningpremi order by a.cabval";	 
		    //echo $qrysaldo;		 
		//die;
		$querysaldo=ociparse($kon,$qrysaldo);
				ociexecute($querysaldo);				
				//echo ocirowcount($query);
				ocifetch($querysaldo);
					$i=1;
					 while(ocifetch($querysaldo))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 //echo "<tr>";
					 echo "<td class=verdana8blk  align=left>".ociresult($querysaldo,"CABVAL")."</td>";
					 echo "<td class=verdana8blk  align=center>".ociresult($querysaldo,"KDREKENINGPREMI")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo,"JMLKWT")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"JMLPREMI"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"JMLRP"),2,",",".")."</td>";
  				 echo "</tr>";
				 if($i%12==0)
				 echo "<td colspan=5>&nbsp;</td>";
/*					     $saldo_knbva+=ociresult($querysaldo,"KNB");
						 $saldo_nnbva+=ociresult($querysaldo,"NNB");
						 $saldo_kobva+=ociresult($querysaldo,"KOB");
						 $saldo_nobva+=ociresult($querysaldo,"NOB");
						 $saldo_jmlkuiva+=ociresult($querysaldo,"JMLKUITANSI");
						 $saldo_jmlnilva+=ociresult($querysaldo,"JMLPREMI");
*/					 $i++;
					 }			

//Rekap untuk Nota Tagihan
				
				 echo "<tr bgcolor=#FFCCFF><td class=verdana8blk rowspan=143>2.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=143><b>NOTA TAGIHAN</b></td>";
				 echo "<td class=verdana8blk align=left></td>";				 								
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";	
					$qrynotadebet = "SELECT   a.cabval,
           a.kdrekeningpremi,
           NVL (SUM (jmlkwt), 0) jmlkwt,
           NVL (SUM (jmlpremi), 0) jmlpremi,
           NVL (SUM (jmlnilairp), 0) jmlrp
    FROM      $DBUser.tabel_203_valkuit a
           LEFT JOIN
              $DBUser.tabel_300_notadebet b
           ON     a.kdrekening = b.kdrekeningpremi
              AND $periode
              AND b.kdkantor = '$kantor'
GROUP BY   a.cabval, a.kdrekeningpremi order by a.cabval";	 
		   // echo $qrynotadebet;		 
		//die;
		$querynotadebet=ociparse($kon,$qrynotadebet);
				ociexecute($querynotadebet);				
				//echo ocirowcount($query);
				ocifetch($querynotadebet);
					$i=1;
					 while(ocifetch($querynotadebet))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 //echo "<tr>";
					 echo "<td class=verdana8blk  align=left>".ociresult($querynotadebet,"CABVAL")."</td>";
					 echo "<td class=verdana8blk  align=center>".ociresult($querynotadebet,"KDREKENINGPREMI")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynotadebet,"JMLKWT")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynotadebet,"JMLPREMI"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynotadebet,"JMLRP"),2,",",".")."</td>";
  				 echo "</tr>";
				 if($i%12==0)
				 echo "<td colspan=5>&nbsp;</td>";
/*					     $saldo_knbva+=ociresult($querysaldo,"KNB");
						 $saldo_nnbva+=ociresult($querysaldo,"NNB");
						 $saldo_kobva+=ociresult($querysaldo,"KOB");
						 $saldo_nobva+=ociresult($querysaldo,"NOB");
						 $saldo_jmlkuiva+=ociresult($querysaldo,"JMLKUITANSI");
						 $saldo_jmlnilva+=ociresult($querysaldo,"JMLPREMI");
*/					 $i++;
					 }			

//Rekap untuk Nota Koreksi
				 echo "<tr bgcolor=#00FFCC><td class=verdana8blk rowspan=143>3.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=143><b>NOTA KOREKSI</b></td>";
				 echo "<td class=verdana8blk align=left></td>";				 								
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";	
				 echo "</tr>";			 
					$qrysaldo = "SELECT   a.cabval,
           a.kdrekeningpremi,
           NVL (SUM (jmlkwt), 0) jmlkwt,
           NVL (SUM (jmlpremi), 0) jmlpremi,
           NVL (SUM (jmlnilairp), 0) jmlrp
    FROM      $DBUser.tabel_203_valkuit a
           LEFT JOIN
              $DBUser.tabel_300_notadebet_bpo b
           ON     a.kdrekening = b.kdrekeningpremi
              AND $periode
              AND b.kdkantor = '$kantor'
GROUP BY   a.cabval, a.kdrekeningpremi order by a.cabval";	 
		    //echo $qrysaldo;		 
		//die;
		$querysaldo=ociparse($kon,$qrysaldo);
				ociexecute($querysaldo);				
				//echo ocirowcount($query);
				ocifetch($querysaldo);
					$i=1;
					 while(ocifetch($querysaldo))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 //echo "<tr>";
					 echo "<td class=verdana8blk  align=left>".ociresult($querysaldo,"CABVAL")."</td>";
					 echo "<td class=verdana8blk  align=center>".ociresult($querysaldo,"KDREKENINGPREMI")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo,"JMLKWT")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"JMLPREMI"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"JMLRP"),2,",",".")."</td>";
  				 echo "</tr>";
				 if($i%12==0)
				 echo "<td colspan=5>&nbsp;</td>";
/*					     $saldo_knbva+=ociresult($querysaldo,"KNB");
						 $saldo_nnbva+=ociresult($querysaldo,"NNB");
						 $saldo_kobva+=ociresult($querysaldo,"KOB");
						 $saldo_nobva+=ociresult($querysaldo,"NOB");
						 $saldo_jmlkuiva+=ociresult($querysaldo,"JMLKUITANSI");
						 $saldo_jmlnilva+=ociresult($querysaldo,"JMLPREMI");
*/					 $i++;
					 }			

//Rekap Untuk Pelunasan
				 echo "<tr bgcolor=#FFFF99><td class=verdana8blk rowspan=143>4.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=143><b>PELUNASAN</b></td>";
				 echo "<td class=verdana8blk align=left></td>";				 								
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";	
				 echo "</tr>";			 
					$qrylunas = "SELECT   a.cabval,
           a.kdrekeningpremi,
           NVL (SUM (jmlkwt), 0) jmlkwt,
           NVL (SUM (jmlpremi), 0) jmlpremi,
           NVL (SUM (jmlnilairp), 0) jmlrp
    FROM      $DBUser.tabel_203_valkuit a
           LEFT JOIN
              $DBUser.tabel_300_notadebet_pelunasan b
           ON     a.kdrekening = b.kdrekeningpremi
              AND $periode
              AND b.kdkantor = '$kantor'
GROUP BY   a.cabval, a.kdrekeningpremi order by a.cabval";	 
		    //echo $qrylunas;		 
		//die;
		$querylunas=ociparse($kon,$qrylunas);
				ociexecute($querylunas);				
				//echo ocirowcount($query);
				ocifetch($querylunas);
					$i=1;
					 while(ocifetch($querylunas))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 //echo "<tr>";
					 echo "<td class=verdana8blk  align=left>".ociresult($querylunas,"CABVAL")."</td>";
					 echo "<td class=verdana8blk  align=center>".ociresult($querylunas,"KDREKENINGPREMI")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas,"JMLKWT")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas,"JMLPREMI"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas,"JMLRP"),2,",",".")."</td>";
  				 echo "</tr>";
				 if($i%12==0)
				 echo "<td colspan=5>&nbsp;</td>";
/*					     $saldo_knbva+=ociresult($querysaldo,"KNB");
						 $saldo_nnbva+=ociresult($querysaldo,"NNB");
						 $saldo_kobva+=ociresult($querysaldo,"KOB");
						 $saldo_nobva+=ociresult($querysaldo,"NOB");
						 $saldo_jmlkuiva+=ociresult($querysaldo,"JMLKUITANSI");
						 $saldo_jmlnilva+=ociresult($querysaldo,"JMLPREMI");
*/					 $i++;
					 }			

//Rekap Untuk Saldo Akhir
				 echo "<tr bgcolor=#CCCCCC><td class=verdana8blk rowspan=143>5.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=143><b>SALDO AKHIR</b></td>";
				 echo "<td class=verdana8blk align=left></td>";				 								
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";
				 echo "<td class=verdana8blk align=left></td>";	
				 echo "</tr>";			 
					$qrytotal = "SELECT   a.cabval,
           a.kdrekeningpremi,
           NVL (SUM (jmlkwt), 0) jmlkwt,
           NVL (SUM (jmlpremi), 0) jmlpremi,
           NVL (SUM (jmlrp), 0) jmlrp
    FROM      $DBUser.tabel_203_valkuit a
           LEFT JOIN
              $DBUser.VIEW_300_TOTAL_LIPP_1 b
           ON     a.kdrekeningpremi = b.kdrekeningpremi
              AND $periode
              AND b.kdkantor = '$kantor'
GROUP BY   a.cabval, a.kdrekeningpremi order by a.cabval";	 
		   // echo $qrytotal;		 
		//die;
		$querytotal=ociparse($kon,$qrytotal);
				ociexecute($querytotal);				
				//echo ocirowcount($query);
				ocifetch($querytotal);
					$i=1;
					 while(ocifetch($querytotal))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 //echo "<tr>";
					 echo "<td class=verdana8blk  align=left>".ociresult($querytotal,"CABVAL")."</td>";
					 echo "<td class=verdana8blk  align=center>".ociresult($querytotal,"KDREKENINGPREMI")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal,"JMLKWT")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal,"JMLPREMI"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal,"JMLRP"),2,",",".")."</td>";
  				 echo "</tr>";
				 if($i%12==0)
				 echo "<td colspan=5>&nbsp;</td>";
/*					     $saldo_knbva+=ociresult($querysaldo,"KNB");
						 $saldo_nnbva+=ociresult($querysaldo,"NNB");
						 $saldo_kobva+=ociresult($querysaldo,"KOB");
						 $saldo_nobva+=ociresult($querysaldo,"NOB");
						 $saldo_jmlkuiva+=ociresult($querysaldo,"JMLKUITANSI");
						 $saldo_jmlnilva+=ociresult($querysaldo,"JMLPREMI");
*/					 $i++;
					 }			


			?>		
</table>
</div>
<hr size="1">
	<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Pelaporan</font></a> | 
	<a href="#" onClick="NewWindow('lipp_cetak.php?kantor=<?=$kantor;?>&thisperiode=<?=$thisperiode;?>&mode=print','','width=600,height=600,top=500,left=400,scrollbars=yes');"><font face="Verdana" size="2">Cetak</font></a>
