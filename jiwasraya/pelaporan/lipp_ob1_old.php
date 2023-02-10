<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	$kon=ocilogon($DBUser, $DBPass, $DBName);
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
								 $periode=" a.tglbooked=to_date('$thisperiode', 'MMYYYY')";
								 $periodesaldo=" a.tglbooked=add_months(to_date('$thisperiode', 'MMYYYY'),-1)";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode="tglbooked=to_date('$thisperiode', 'YYYY')";
					 $periodesaldo=" a.tglbooked=add_months(to_date('$thisperiode', 'YYYY'),-12)";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode="tglbooked=to_date('$thisperiode', 'MMYYYY')";
					 $periodesaldo=" a.tglbooked=add_months(to_date('$thisperiode', 'MMYYYY'),-1)";
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
					 echo "<table border=1 style='border-collapse:collapse' bordercolor=#333333>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center rowspan=2><b>NO.</b></td>";
					 echo "<td align=center rowspan=2><b>Uraian</b></td>";
					 echo "<td align=center rowspan=2 colspan=3><b>Valuta/CABAS</b></td>";
					 echo "<td align=center colspan=2><b>New Business</b></td>";
					 echo "<td align=center colspan=2><b>Old Business</b></td>";
					 echo "<td align=center colspan=2><b>OB + NB</b></td>";
  				 echo "</tr>";
				 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>Kwitansi</b></td>";
					 echo "<td align=center><b>Nilai</b></td>";
					 echo "<td align=center><b>Kwitansi</b></td>";
					 echo "<td align=center><b>Nilai</b></td>";
					 echo "<td align=center><b>Kwitansi</b></td>";
					 echo "<td align=center><b>Nilai</b></td>";					 
  				 echo "</tr>";
					 $i = 1;
					
		//Rekap Untuk Saldo Awal			
					$qrysaldo = "SELECT   'TOTAL',
           'VA' VALUTA,
           b.kdcabas,
           NVL (knb, 0) knb,
           NVL (nnb, 0) nnb,
           NVL (kob, 0) kob,
           NVL (nob, 0) nob,
           NVL (jmlkuitansi, 0) jmlkuitansi,
           NVL (jmlpremi, 0) jmlpremi
    FROM      $DBUser.VIEW_300_TOTAL_LIPP a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas
              AND KDKANTOR = '$kantor'
              AND a.valuta = 'VA'
              AND $periodesaldo
ORDER BY   b.kdcabas";	 
		   // echo $qrysaldo;		 
		//die;
				$querysaldo=ociparse($kon,$qrysaldo);
				ociexecute($querysaldo);				
				//echo ocirowcount($query);
				ocifetch($querysaldo);
				 echo "<tr><td class=verdana8blk rowspan=39>1.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=39><b>SALDO AWAL</b></td>";
				     echo "<td class=verdana8blk rowspan=13><b>A</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VA</b></td>";
					 while(ocifetch($querysaldo))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querysaldo,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
					     $saldo_knbva+=ociresult($querysaldo,"KNB");
						 $saldo_nnbva+=ociresult($querysaldo,"NNB");
						 $saldo_kobva+=ociresult($querysaldo,"KOB");
						 $saldo_nobva+=ociresult($querysaldo,"NOB");
						 $saldo_jmlkuiva+=ociresult($querysaldo,"JMLKUITANSI");
						 $saldo_jmlnilva+=ociresult($querysaldo,"JMLPREMI");
					 $i++;
					 }			
					
					//Valuta Rupiah Dengan Indeks
					 $qrysaldo2 = "SELECT   'TOTAL',
           'VRDI' VALUTA,
           b.kdcabas,
           NVL (knb, 0) knb,
           NVL (nnb, 0) nnb,
           NVL (kob, 0) kob,
           NVL (nob, 0) nob,
           NVL (jmlkuitansi, 0) jmlkuitansi,
           NVL (jmlpremi, 0) jmlpremi
    FROM      $DBUser.VIEW_300_TOTAL_LIPP a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas
              AND KDKANTOR = '$kantor'
              AND a.valuta = 'VRDI'
              AND $periodesaldo
ORDER BY   b.kdcabas";	 
		    //echo $qry;		 
		//die;
				$querysaldo2=ociparse($kon,$qrysaldo2);
				ociexecute($querysaldo2);				
				//echo ocirowcount($query);
				ocifetch($querysaldo2);	
				     echo "<td class=verdana8blk rowspan=13><b>A</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRDI</b></td>";
				while(ocifetch($querysaldo2))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querysaldo2,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo2,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo2,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo2,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo2,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo2,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo2,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
   						 $saldo_knbvrdi+=ociresult($querysaldo2,"KNB");
						 $saldo_nnbvrdi+=ociresult($querysaldo2,"NNB");
						 $saldo_kobvrdi+=ociresult($querysaldo2,"KOB");
						 $saldo_nobvrdi+=ociresult($querysaldo2,"NOB");
						 $saldo_jmlkuivrdi+=ociresult($querysaldo2,"JMLKUITANSI");
						 $saldo_jmlnilvrdi+=ociresult($querysaldo2,"JMLPREMI");
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qrysaldo3 = "SELECT   'TOTAL',
           'VRTI' VALUTA,
           b.kdcabas,
           NVL (knb, 0) knb,
           NVL (nnb, 0) nnb,
           NVL (kob, 0) kob,
           NVL (nob, 0) nob,
           NVL (jmlkuitansi, 0) jmlkuitansi,
           NVL (jmlpremi, 0) jmlpremi
    FROM      $DBUser.VIEW_300_TOTAL_LIPP a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas
              AND KDKANTOR = '$kantor'
              AND a.valuta = 'VRTI'
              AND $periodesaldo
ORDER BY   b.kdcabas";	 
		   // echo $qry;		 
		//die;
				$querysaldo3=ociparse($kon,$qrysaldo3);
				ociexecute($querysaldo3);				
				//echo ocirowcount($query);
				ocifetch($querysaldo3);	
					 echo "<td class=verdana8blk rowspan=13><b>A</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRTI</b></td>";
					while(ocifetch($querysaldo3))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					  echo "<td class=verdana8blk  align=center>".ociresult($querysaldo3,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo3,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo3,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo3,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo3,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querysaldo3,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querysaldo3,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $saldo_knbvrti+=ociresult($querysaldo3,"KNB");
						 $saldo_nnbvrti+=ociresult($querysaldo3,"NNB");
						 $saldo_kobvrti+=ociresult($querysaldo3,"KOB");
						 $saldo_nobvrti+=ociresult($querysaldo3,"NOB");
						 $saldo_jmlkuivrti+=ociresult($querysaldo3,"JMLKUITANSI");
						 $saldo_jmlnilvrti+=ociresult($querysaldo3,"JMLPREMI");
					 $i++;}			
					
				
		
		
		//Rekap Untuk Nota Debet			
					$qry = "SELECT 'NOTA TAGIHAN PREMI BERKALA LANJUTAN' GRUP,           
           'VA' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
             and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$query=ociparse($kon,$qry);
				ociexecute($query);				
				//echo ocirowcount($query);
				ocifetch($query);
				 echo "<tr><td class=verdana8blk rowspan=39>2.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=39><b>NOTA TAGIHAN PREMI BERKALA</b></td>";
				     echo "<td class=verdana8blk rowspan=13><b>B</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VA</b></td>";
					 while(ocifetch($query))
					 {						 
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($query,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
					     $nd_knbva+=ociresult($query,"KNB");
						 $nd_nnbva+=ociresult($query,"NNB");
						 $nd_kobva+=ociresult($query,"KOB");
						 $nd_nobva+=ociresult($query,"NOB");
						 $nd_jmlkuiva+=ociresult($query,"JMLKUITANSI");
						 $nd_jmlnilva+=ociresult($query,"JMLPREMI");
					 $i++;
					 }			
					
					//Valuta Rupiah Dengan Indeks
					 $qry2 = "SELECT 'NOTA TAGIHAN PREMI BERKALA LANJUTAN' GRUP,           
           'VRDI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		    //echo $qry;		 
		//die;
				$query2=ociparse($kon,$qry2);
				ociexecute($query2);				
				//echo ocirowcount($query);
				ocifetch($query2);	
				     echo "<td class=verdana8blk rowspan=13><b>B</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRDI</b></td>";
				while(ocifetch($query2))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($query2,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query2,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query2,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query2,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query2,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query2,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query2,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
   						 $nd_knbvrdi+=ociresult($query2,"KNB");
						 $nd_nnbvrdi+=ociresult($query2,"NNB");
						 $nd_kobvrdi+=ociresult($query2,"KOB");
						 $nd_nobvrdi+=ociresult($query2,"NOB");
						 $nd_jmlkuivrdi+=ociresult($query2,"JMLKUITANSI");
						 $nd_jmlnilvrdi+=ociresult($query2,"JMLPREMI");
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qry3 = "SELECT 'NOTA TAGIHAN PREMI BERKALA LANJUTAN' GRUP,           
           'VRTI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$query3=ociparse($kon,$qry3);
				ociexecute($query3);				
				//echo ocirowcount($query);
				ocifetch($query3);	
					 echo "<td class=verdana8blk rowspan=13><b>B</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRTI</b></td>";
					while(ocifetch($query3))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					  echo "<td class=verdana8blk  align=center>".ociresult($query3,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query3,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query3,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query3,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query3,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($query3,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($query3,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $nd_knbvrti+=ociresult($query3,"KNB");
						 $nd_nnbvrti+=ociresult($query3,"NNB");
						 $nd_kobvrti+=ociresult($query3,"KOB");
						 $nd_nobvrti+=ociresult($query3,"NOB");
						 $nd_jmlkuivrti+=ociresult($query3,"JMLKUITANSI");
						 $nd_jmlnilvrti+=ociresult($query3,"JMLPREMI");
					 $i++;}			
					
					
					
				// Nota Koreksi Notadebet Susulan
					$qrynbs = "SELECT 'PELUNASAN' GRUP,           
           'VA' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_susulan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
             and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		    //echo $qrylunas;		 
		//die;
				$querynbs=ociparse($kon,$qrynbs);
				ociexecute($querynbs);				
				//echo ocirowcount($query);
				ocifetch($querynbs);
				 echo "<tr><td class=verdana8blk rowspan=39>3.</td>";
				 echo "<td class=verdana8blk align=left rowspan=39><b>NOTA DEBET SUSULAN</b></td>";
				     echo "<td class=verdana8blk rowspan=13><b>C</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VA</b></td>";
					 while(ocifetch($querynbs))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querynbs,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $nds_knbva+=ociresult($querynbs,"KNB");
						 $nds_nnbva+=ociresult($querynbs,"NNB");
						 $nds_kobva+=ociresult($querynbs,"KOB");
						 $nds_nobva+=ociresult($querynbs,"NOB");
						 $nds_jmlkuiva+=ociresult($querynbs,"JMLKUITANSI");
						 $nds_jmlnilva+=ociresult($querynbs,"JMLPREMI");				 
					 $i++;}			
					
					//Valuta Rupiah Dengan Indeks
					 $qrynbs2 = "SELECT 'PELUNASAN' GRUP,           
           'VRDI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_susulan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		  //  echo $qry;		 
		//die;
				$querynbs2=ociparse($kon,$qrynbs2);
				ociexecute($querynbs2);				
				//echo ocirowcount($query);
				ocifetch($querynbs2);	
				     echo "<td class=verdana8blk rowspan=13><b>C</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRDI</b></td>";
				while(ocifetch($querynbs2))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querynbs2,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs2,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs2,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs2,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs2,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs2,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs2,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $nds_knbvrdi+=ociresult($querynbs2,"KNB");
						 $nds_nnbvrdi+=ociresult($querynbs2,"NNB");
						 $nds_kobvrdi+=ociresult($querynbs2,"KOB");
						 $nds_nobvrdi+=ociresult($querynbs2,"NOB");
						 $nds_jmlkuivrdi+=ociresult($querynbs2,"JMLKUITANSI");
						 $nds_jmlnilvrdi+=ociresult($querynbs2,"JMLPREMI");							 
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qrynbs3 = "SELECT 'PELUNASAN' GRUP,           
           'VRTI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_susulan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$querynbs3=ociparse($kon,$qrynbs3);
				ociexecute($querynbs3);				
				//echo ocirowcount($query);
				ocifetch($querynbs3);	
					 echo "<td class=verdana8blk rowspan=13><b>C</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRTI</b></td>";
					while(ocifetch($querynbs3))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					  echo "<td class=verdana8blk  align=center>".ociresult($querynbs3,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs3,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs3,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs3,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs3,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querynbs3,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querynbs3,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $nds_knbvrti+=ociresult($querynbs3,"KNB");
						 $nds_nnbvrti+=ociresult($querynbs3,"NNB");
						 $nds_kobvrti+=ociresult($querynbs3,"KOB");
						 $nds_nobvrti+=ociresult($querynbs3,"NOB");
						 $nds_jmlkuivrti+=ociresult($querynbs3,"JMLKUITANSI");
						 $nds_jmlnilvrti+=ociresult($querynbs3,"JMLPREMI");					 
					 $i++;}							
				

				//Rekap LIPP Pelunasan premi
					$qrylunas = "SELECT 'PELUNASAN' GRUP,           
           'VA' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_pelunasan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
             and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		  //  echo $qrylunas;		 
		//die;
				$querylunas=ociparse($kon,$qrylunas);
				ociexecute($querylunas);				
				//echo ocirowcount($query);
				ocifetch($querylunas);
				 echo "<tr><td class=verdana8blk rowspan=39>4.</td>";
				 echo "<td class=verdana8blk align=left rowspan=39><b>PELUNASAN</b></td>";
				     echo "<td class=verdana8blk rowspan=13><b>D</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VA</b></td>";
					 while(ocifetch($querylunas))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querylunas,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $lunas_knbva+=ociresult($querylunas,"KNB");
						 $lunas_nnbva+=ociresult($querylunas,"NNB");
						 $lunas_kobva+=ociresult($querylunas,"KOB");
						 $lunas_nobva+=ociresult($querylunas,"NOB");
						 $lunas_jmlkuiva+=ociresult($querylunas,"JMLKUITANSI");
						 $lunas_jmlnilva+=ociresult($querylunas,"JMLPREMI");							 
					 $i++;}			
					
					//Valuta Rupiah Dengan Indeks
					 $qrylunas2 = "SELECT 'PELUNASAN' GRUP,           
           'VRDI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_pelunasan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$querylunas2=ociparse($kon,$qrylunas2);
				ociexecute($querylunas2);				
				//echo ocirowcount($query);
				ocifetch($querylunas2);	
				     echo "<td class=verdana8blk rowspan=13><b>D</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRDI</b></td>";
				while(ocifetch($querylunas2))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querylunas2,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas2,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas2,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas2,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas2,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas2,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas2,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $lunas_knbvrdi+=ociresult($querylunas2,"KNB");
						 $lunas_nnbvrdi+=ociresult($querylunas2,"NNB");
						 $lunas_kobvrdi+=ociresult($querylunas2,"KOB");
						 $lunas_nobvrdi+=ociresult($querylunas2,"NOB");
						 $lunas_jmlkuivrdi+=ociresult($querylunas2,"JMLKUITANSI");
						 $lunas_jmlnilvrdi+=ociresult($querylunas2,"JMLPREMI");							 
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qrylunas3 = "SELECT 'PELUNASAN' GRUP,           
           'VRTI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_pelunasan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$querylunas3=ociparse($kon,$qrylunas3);
				ociexecute($querylunas3);				
				//echo ocirowcount($query);
				ocifetch($querylunas3);	
					 echo "<td class=verdana8blk rowspan=13><b>D</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRTI</b></td>";
					while(ocifetch($querylunas3))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					  echo "<td class=verdana8blk  align=center>".ociresult($querylunas3,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas3,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas3,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas3,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas3,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querylunas3,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querylunas3,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $lunas_knbvrti+=ociresult($querylunas3,"KNB");
						 $lunas_nnbvrti+=ociresult($querylunas3,"NNB");
						 $lunas_kobvrti+=ociresult($querylunas3,"KOB");
						 $lunas_nobvrti+=ociresult($querylunas3,"NOB");
						 $lunas_jmlkuivrti+=ociresult($querylunas3,"JMLKUITANSI");
						 $lunas_jmlnilvrti+=ociresult($querylunas3,"JMLPREMI");							 

					 $i++;}							
		
		
		//Rekap LIPP Koreksi karena proses BPO
					$qrybpo = "SELECT 'KOREKSI BPO' GRUP,           
           'VA' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_koreksi_bpo a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
             and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		  //  echo $qrylunas;		 
		//die;
				$querybpo=ociparse($kon,$qrybpo);
				ociexecute($querybpo);				
				//echo ocirowcount($query);
				ocifetch($querybpo);
				 echo "<tr><td class=verdana8blk rowspan=39>5.</td>";
				 echo "<td class=verdana8blk align=left rowspan=39><b>KOREKSI BPO</b></td>";
				     echo "<td class=verdana8blk rowspan=13><b>E</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VA</b></td>";
					 while(ocifetch($querybpo))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querybpo,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $bpo_knbva+=ociresult($querybpo,"KNB");
						 $bpo_nnbva+=ociresult($querybpo,"NNB");
						 $bpo_kobva+=ociresult($querybpo,"KOB");
						 $bpo_nobva+=ociresult($querybpo,"NOB");
						 $bpo_jmlkuiva+=ociresult($querybpo,"JMLKUITANSI");
						 $bpo_jmlnilva+=ociresult($querybpo,"JMLPREMI");							 
					 $i++;}			
					
					//Valuta Rupiah Dengan Indeks
					 $qrybpo2 = "SELECT 'KOREKSI BPO' GRUP,           
           'VRDI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_koreksi_bpo a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$querybpo2=ociparse($kon,$qrybpo2);
				ociexecute($querybpo2);				
				//echo ocirowcount($query);
				ocifetch($querybpo2);	
				     echo "<td class=verdana8blk rowspan=13><b>E</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRDI</b></td>";
				while(ocifetch($querybpo2))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querybpo2,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo2,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo2,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo2,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo2,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo2,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo2,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $bpo_knbvrdi+=ociresult($querybpo2,"KNB");
						 $bpo_nnbvrdi+=ociresult($querybpo2,"NNB");
						 $bpo_kobvrdi+=ociresult($querybpo2,"KOB");
						 $bpo_nobvrdi+=ociresult($querybpo2,"NOB");
						 $bpo_jmlkuivrdi+=ociresult($querybpo2,"JMLKUITANSI");
						 $bpo_jmlnilvrdi+=ociresult($querybpo2,"JMLPREMI");							 
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qrybpo3 = "SELECT 'KOREKSI BPO' GRUP,           
           'VRTI' valuta,
		   b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI
    FROM      $DBUser.tabel_300_lipp_koreksi_bpo a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
			  and a.kdgroup='6'
ORDER BY    b.kdcabas asc";	 
		   // echo $qry;		 
		//die;
				$querybpo3=ociparse($kon,$qrybpo3);
				ociexecute($querybpo3);				
				//echo ocirowcount($query);
				ocifetch($querybpo3);	
					 echo "<td class=verdana8blk rowspan=13><b>E</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRTI</b></td>";
					while(ocifetch($querybpo3))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					  echo "<td class=verdana8blk  align=center>".ociresult($querybpo3,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo3,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo3,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo3,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo3,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querybpo3,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querybpo3,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
						 $bpo_knbvrti+=ociresult($querybpo3,"KNB");
						 $bpo_nnbvrti+=ociresult($querybpo3,"NNB");
						 $bpo_kobvrti+=ociresult($querybpo3,"KOB");
						 $bpo_nobvrti+=ociresult($querybpo3,"NOB");
						 $bpo_jmlkuivrti+=ociresult($querybpo3,"JMLKUITANSI");
						 $bpo_jmlnilvrti+=ociresult($querybpo3,"JMLPREMI");							 

					 $i++;}	
		
					
		//Total LIPP (Nota Tagihan + Notadebet Susulan - Pelunasan)			
						$qrytotal = "SELECT   'TOTAL',
           'VA' VALUTA,
           b.kdcabas,
           NVL (knb, 0) knb,
           NVL (nnb, 0) nnb,
           NVL (kob, 0) kob,
           NVL (nob, 0) nob,
           NVL (jmlkuitansi, 0) jmlkuitansi,
           NVL (jmlpremi, 0) jmlpremi
    FROM      $DBUser.VIEW_300_TOTAL_LIPP a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas
              AND KDKANTOR = '$kantor'
              AND a.valuta = 'VA'
              AND $periode
ORDER BY   b.kdcabas";	 
		   // echo $qrytotal;		 
		//die;
				$querytotal=ociparse($kon,$qrytotal);
				ociexecute($querytotal);				
				//echo ocirowcount($query);
				ocifetch($querytotal);
				 echo "<tr><td class=verdana8blk rowspan=39>6.	</td>";
				 echo "<td class=verdana8blk align=left rowspan=39><b>TOTAL </b></td>";
				     echo "<td class=verdana8blk rowspan=13><b>F</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VA</b></td>";
					 while(ocifetch($querytotal))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querytotal,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
					 $i++;}			
					
					//Valuta Rupiah Dengan Indeks
					 $qrytotal2 = "SELECT   'TOTAL',
           'VRDI' VALUTA,
           b.kdcabas,
           NVL (knb, 0) knb,
           NVL (nnb, 0) nnb,
           NVL (kob, 0) kob,
           NVL (nob, 0) nob,
           NVL (jmlkuitansi, 0) jmlkuitansi,
           NVL (jmlpremi, 0) jmlpremi
    FROM      $DBUser.VIEW_300_TOTAL_LIPP a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas
              AND KDKANTOR = '$kantor'
              AND a.valuta = 'VRDI'
              AND $periode
ORDER BY   b.kdcabas";
		   // echo $qrytotal2;		 
		//die;
				$querytotal2=ociparse($kon,$qrytotal2);
				ociexecute($querytotal2);				
				//echo ocirowcount($query);
				ocifetch($querytotal2);	
				     echo "<td class=verdana8blk rowspan=13><b>F</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRDI</b></td>";
				while(ocifetch($querytotal2))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					 echo "<td class=verdana8blk  align=center>".ociresult($querytotal2,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal2,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal2,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal2,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal2,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal2,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal2,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qrytotal3 = "SELECT   'TOTAL',
           'VRTI' VALUTA,
           b.kdcabas,
           NVL (knb, 0) knb,
           NVL (nnb, 0) nnb,
           NVL (kob, 0) kob,
           NVL (nob, 0) nob,
           NVL (jmlkuitansi, 0) jmlkuitansi,
           NVL (jmlpremi, 0) jmlpremi
    FROM      $DBUser.VIEW_300_TOTAL_LIPP a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP b
           ON     b.kdcabas = a.kdcabas
              AND KDKANTOR = '$kantor'
              AND a.valuta = 'VRTI'
              AND $periode
ORDER BY   b.kdcabas"; 
		  //  echo $qrytotal3;		 
		//die;
				$querytotal3=ociparse($kon,$qrytotal3);
				ociexecute($querytotal3);				
				//echo ocirowcount($query);
				ocifetch($querytotal3);	
					 echo "<td class=verdana8blk rowspan=13><b>F</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=13><b>VRTI</b></td>";
					while(ocifetch($querytotal3))
					 {
					 //echo ocirowcount($query);
					 include "../../includes/belang.php";
					  echo "<td class=verdana8blk  align=center>".ociresult($querytotal3,"KDCABAS")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal3,"KNB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal3,"NNB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal3,"KOB")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal3,"NOB"),2,",",".")."</td>";
					 echo "<td class=verdana8blk  align=right>".ociresult($querytotal3,"JMLKUITANSI")."</td>";
					 echo "<td class=verdana8blk  align=right>".number_format(ociresult($querytotal3,"JMLPREMI"),2,",",".")."</td>";
  				 echo "</tr>";
					 $i++;}							
					
					
					
           echo "</table>";					
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a> | 
	<a href=\"#\" onClick=\"NewWindow('lipp_cetak.php?kantor=".$kantor."&thisperiode=".$thisperiode."&mode=print','','width=600,height=600,top=500,left=400,scrollbars=yes');\"><font face=\"Verdana\" size=\"2\">Cetak</font></a>";
 ?>
