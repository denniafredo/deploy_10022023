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
<meta http-equiv="refresh" content="1000;url=http://192.168.2.23/jiwasraya/pelaporan/lipp_ob1.php" />  
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body onLoad="window.print();window.close()">
<table width="1000">
  <tr class="arial10blkb">
    <td width="100%" align="center">&nbsp;</td>
	</tr>
</table>

	<?		

$DB=new Database($userid, $passwd, $DBName);	
$periode="tglbooked=to_date('$thisperiode', 'MMYYYY')";
$bln=substr($thisperiode,0,2);
$thn=substr($thisperiode,2,4);
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
 
				//$CK->parse($qry);
				//$CK->execute();			
				//$hasil=$CK->affected();
				//echo $hasil;	
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>LAPORAN INKASO PERTANGGUNGAN PERORANGAN PREMI BERKALA LANJUTAN $kantor PERIODE ".strtoupper($blnn)." $thn</b></font><br><br>";
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
		    //echo $qry;		 
		//die;
				$query=ociparse($kon,$qry);
				ociexecute($query);				
				//echo ocirowcount($query);
				ocifetch($query);
				 echo "<tr><td class=verdana8blk rowspan=36>$i	</td>";
				 echo "<td class=verdana8blk align=left rowspan=36><b>NOTA TAGIHAN PREMI BERKALA</b></td>";
				     echo "<td class=verdana8blk rowspan=12><b>A</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VA</b></td>";
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
				     echo "<td class=verdana8blk rowspan=12><b>A</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRDI</b></td>";
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
					 echo "<td class=verdana8blk rowspan=12><b>A</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRTI</b></td>";
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
				 echo "<tr><td class=verdana8blk rowspan=36>2	</td>";
				 echo "<td class=verdana8blk align=left rowspan=36><b>NOTA DEBET SUSULAN</b></td>";
				     echo "<td class=verdana8blk rowspan=12><b>B</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VA</b></td>";
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
				     echo "<td class=verdana8blk rowspan=12><b>B</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRDI</b></td>";
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
					 echo "<td class=verdana8blk rowspan=12><b>B</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRTI</b></td>";
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
				 echo "<tr><td class=verdana8blk rowspan=36>3	</td>";
				 echo "<td class=verdana8blk align=left rowspan=36><b>PELUNASAN</b></td>";
				     echo "<td class=verdana8blk rowspan=12><b>C</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VA</b></td>";
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
				     echo "<td class=verdana8blk rowspan=12><b>C</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRDI</b></td>";
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
					 echo "<td class=verdana8blk rowspan=12><b>C</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRTI</b></td>";
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
					
		//Total LIPP (Nota Tagihan + Notadebet Susulan - Pelunasan)			
						$qrytotal = "select 'TOTAL',valuta,kdcabas,sum(knb)-sum(lknb) as knb,sum(nnb)-sum(lnnb) as nnb,sum(kob)-sum(lkob) as kob,
sum(nob)-sum(lnob) as nob,sum(jmlkuitansi)-sum(ljmlkuitansi) as jmlkuitansi,sum(jmlpremi)-sum(ljmlpremi) as jmlpremi
from
(SELECT 'NOTA TAGIHAN PREMI BERKALA LANJUTAN' GRUP,           
           'VA' valuta,
           b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI,
           0 lknb,0 lnnb,0 lkob,0 lnob,0 LJMLKUITANSI,0 LJMLPREMI
    FROM      $DBUser.tabel_300_lipp a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
              and a.kdgroup='6'
union
SELECT 'NOTA TAGIHAN PREMI BERKALA SUSULAN' GRUP,           
           'VA' valuta,
           b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI,
           0,0,0,0,0,0
    FROM      $DBUser.tabel_300_lipp_susulan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
              and a.kdgroup='6'              
union             
SELECT 'PELUNASAN TAGIHAN PREMI' GRUP,           
           'VA' valuta,
           b.KDCABAS,0,0,0,0,0,0,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI                      
    FROM      $DBUser.tabel_300_lipp_pelunasan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VA'
              and a.kdgroup='6' ) group by valuta,kdcabas order by kdcabas";	 
		    //echo $qrylunas;		 
		//die;
				$querytotal=ociparse($kon,$qrytotal);
				ociexecute($querytotal);				
				//echo ocirowcount($query);
				ocifetch($querytotal);
				 echo "<tr><td class=verdana8blk rowspan=36>4	</td>";
				 echo "<td class=verdana8blk align=left rowspan=36><b>TOTAL </b></td>";
				     echo "<td class=verdana8blk rowspan=12><b>D</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VA</b></td>";
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
					 $qrylunas2 = "select 'TOTAL',valuta,kdcabas,sum(knb)-sum(lknb) as knb,sum(nnb)-sum(lnnb) as nnb,sum(kob)-sum(lkob) as kob,
sum(nob)-sum(lnob) as nob,sum(jmlkuitansi)-sum(ljmlkuitansi) as jmlkuitansi,sum(jmlpremi)-sum(ljmlpremi) as jmlpremi
from
(SELECT 'NOTA TAGIHAN PREMI BERKALA LANJUTAN' GRUP,           
           'VRDI' valuta,
           b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI,
           0 lknb,0 lnnb,0 lkob,0 lnob,0 LJMLKUITANSI,0 LJMLPREMI
    FROM      $DBUser.tabel_300_lipp a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
              and a.kdgroup='6'
union
SELECT 'NOTA TAGIHAN PREMI BERKALA SUSULAN' GRUP,           
           'VRDI' valuta,
           b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI,
           0,0,0,0,0,0
    FROM      $DBUser.tabel_300_lipp_susulan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
              and a.kdgroup='6'              
union             
SELECT 'PELUNASAN TAGIHAN PREMI' GRUP,           
           'VRDI' valuta,
           b.KDCABAS,0,0,0,0,0,0,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI                      
    FROM      $DBUser.tabel_300_lipp_pelunasan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRDI'
              and a.kdgroup='6' ) group by valuta,kdcabas order by kdcabas";
		   // echo $qry;		 
		//die;
				$querylunas2=ociparse($kon,$qrylunas2);
				ociexecute($querylunas2);				
				//echo ocirowcount($query);
				ocifetch($querylunas2);	
				     echo "<td class=verdana8blk rowspan=12><b>D</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRDI</b></td>";
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
					 $i++;}			
				//Valuta Rupiah Tanpa Indeks	
					$qrylunas3 = "select 'TOTAL',valuta,kdcabas,sum(knb)-sum(lknb) as knb,sum(nnb)-sum(lnnb) as nnb,sum(kob)-sum(lkob) as kob,
sum(nob)-sum(lnob) as nob,sum(jmlkuitansi)-sum(ljmlkuitansi) as jmlkuitansi,sum(jmlpremi)-sum(ljmlpremi) as jmlpremi
from
(SELECT 'NOTA TAGIHAN PREMI BERKALA LANJUTAN' GRUP,           
           'VRTI' valuta,
           b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI,
           0 lknb,0 lnnb,0 lkob,0 lnob,0 LJMLKUITANSI,0 LJMLPREMI
    FROM      $DBUser.tabel_300_lipp a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
              and a.kdgroup='6'
union
SELECT 'NOTA TAGIHAN PREMI BERKALA SUSULAN' GRUP,           
           'VRTI' valuta,
           b.KDCABAS,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI,
           0,0,0,0,0,0
    FROM      $DBUser.tabel_300_lipp_susulan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
              and a.kdgroup='6'              
union             
SELECT 'PELUNASAN TAGIHAN PREMI' GRUP,           
           'VRTI' valuta,
           b.KDCABAS,0,0,0,0,0,0,
           NVL (KNB, 0) knb,
           NVL (NNB, 0) nnb,
           NVL (KOB, 0) kob,
           NVL (NOB, 0) nob,
           (NVL (KNB, 0) + NVL (KOB, 0)) JMLKUITANSI,
           (NVL (NNB, 0) + NVL (NOB, 0)) JMLPREMI                      
    FROM      $DBUser.tabel_300_lipp_pelunasan a
           RIGHT JOIN
              TABEL_203_CABAS_LIPP@jlindo b
           ON     b.kdcabas = a.kdcabas              
              and $periode
              AND kdkantor = '$kantor'
              and a.kdvaluta='VRTI'
              and a.kdgroup='6' ) group by valuta,kdcabas order by kdcabas"; 
		   // echo $qry;		 
		//die;
				$querylunas3=ociparse($kon,$qrylunas3);
				ociexecute($querylunas3);				
				//echo ocirowcount($query);
				ocifetch($querylunas3);	
					 echo "<td class=verdana8blk rowspan=12><b>D</b></td>";
					 echo "<td class=verdana8blk  align=center rowspan=12><b>VRTI</b></td>";
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
					 $i++;}							
					
					
           echo "</table>";					
					 echo "</div>";
	echo "<hr size=1>";
	
 ?>
