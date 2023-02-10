<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
$CK=new Database("CKADM","CKADM","CKADM");
	?>
<html>
<head>
<title>Untitled</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<? include "../../includes/hide.php";  ?>
<meta http-equiv="refresh" content="1000;url=http://192.168.2.23/jiwasraya/pelaporan/lipp_ob.php" />  
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
</head>
<body>
<table width="1000">
  <tr class="arial10blkb">
    <td width="100%" align="center">INFORMASI PENERIMAAN PREMI KANTOR <? echo $kantor; ?> PER PENAGIH</td>
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
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode=" a.tglbooked=to_date('$thisperiode', 'YYYY')";
          }else{
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             $periode=" a.tglbooked=to_date('$thisperiode', 'MMYYYY')";
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

 $qry = "    SELECT   'VA' VALUTA,
           KCOB,
           SUM (KWITOB) KOB,
           SUM (NILAIOB) NOB,
           SUM (KWITNB) KNB,
           SUM (NILAINB) NNB
    FROM   (SELECT   VALUTAOB,
                     kcob,
                     CASE KDKWT WHEN 'OB' THEN jmlhkuitansiob ELSE 0 END KWITOB,
                     CASE KDKWT WHEN 'OB' THEN pdob ELSE 0 END NILAIOB,
                     CASE KDKWT WHEN 'NB' THEN jmlhkuitansiob ELSE 0 END KWITNB,
                     CASE KDKWT WHEN 'NB' THEN pdob ELSE 0 END NILAINB
              FROM   (  SELECT   'NB' KDKWT,
                                 SUM (premidasar) pdob,
                                 SUM (premihitungan) phob,
                                 SUM (JMLPREMI) jmlhpremob,
                                 COUNT (JMLPREMI) jmlhkuitansiob,
                                 kdrayonpenagih AS krob,
                                 namakantor AS nkob,
                                 DECODE (kdvaluta,
                                         0,
                                         'VRDI',
                                         1,
                                         'VRTI',
                                         3,
                                         'VA')
                                    valutaob,
                                 namavaluta AS nvob,
                                 b.KDCABAS AS kcob,
                                 kdrekeningpremi AS krpob,
                                 kdrekeninglawan AS krlob,
                                 SUM (x) AS xob
                          FROM   (  SELECT   a.*,
                                             b.tglseatled,
                                             DECODE (b.tglseatled,
                                                     NULL, 0,
                                                     b.premitagihan)
                                                x
                                      FROM   kuitansi a,
                                             tabel_300_historis_premi@jlindo b
                                     WHERE   a.prefixpertanggungan =
                                                b.prefixpertanggungan
                                             AND a.nopertanggungan =
                                                   b.nopertanggungan
                                             AND a.tglbooked = b.tglbooked
                                             AND a.KDRAYONPENAGIH = 'AC'
                                             AND $periode
                                             AND a.nopenagih LIKE '%'
                                             AND a.kdkuitansi LIKE 'NB%'
                                             AND a.billstatus = '0'
                                  ORDER BY   a.tglbooked) a,
                                 tabel_203_cabas@jlindo b
                         WHERE   b.kdcabas = a.kdcabas(+)
                      GROUP BY   kdrayonpenagih,
                                 namakantor,
                                 kdvaluta,
                                 namavaluta,
                                 b.KDCABAS,
                                 kdrekeningpremi,
                                 kdrekeninglawan
                      UNION ALL
                        SELECT   'OB' KDKWT,
                                 SUM (premidasar) pdob,
                                 SUM (premihitungan) phob,
                                 SUM (JMLPREMI) jmlhpremob,
                                 COUNT (JMLPREMI) jmlhkuitansiob,
                                 kdrayonpenagih AS krob,
                                 namakantor AS nkob,
                                 DECODE (kdvaluta,
                                         0,
                                         'VRDI',
                                         1,
                                         'VRTI',
                                         3,
                                         'VA')
                                    valutaob,
                                 namavaluta AS nvob,
                                 b.KDCABAS AS kcob,
                                 kdrekeningpremi AS krpob,
                                 kdrekeninglawan AS krlob,
                                 SUM (x) AS xob
                          FROM   (  SELECT   a.*,
                                             b.tglseatled,
                                             DECODE (b.tglseatled,
                                                     NULL, 0,
                                                     b.premitagihan)
                                                x
                                      FROM   kuitansi a,
                                             tabel_300_historis_premi@jlindo b
                                     WHERE   a.prefixpertanggungan =
                                                b.prefixpertanggungan
                                             AND a.nopertanggungan =
                                                   b.nopertanggungan
                                             AND a.tglbooked = b.tglbooked
                                             AND a.KDRAYONPENAGIH = 'AC'
                                             AND $periode
                                             AND a.nopenagih LIKE '%'
                                             AND a.kdkuitansi LIKE 'OB%'
                                             AND a.billstatus = '0'
                                  ORDER BY   a.tglbooked) a,
                                 tabel_203_cabas@jlindo b
                         WHERE   b.kdcabas = a.kdcabas(+)
                      GROUP BY   kdrayonpenagih,
                                 namakantor,
                                 kdvaluta,
                                 namavaluta,
                                 b.KDCABAS,
                                 kdrekeningpremi,
                                 kdrekeninglawan))
   WHERE   VALUTAOB = 'VA' OR VALUTAOB IS NULL
GROUP BY   KCOB";	 
		   // echo $qry;		 
		//die;
				$CK->parse($qry);
				$CK->execute();			
				$hasil=$CK->affected();
				echo $hasil;	
  echo "<hr size=1>";
	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>LAPORAN INKASO PERTANGGUNGAN PERORANGAN PREMI BERKALA LANJUTAN AC </b></font><br><br>";
					 echo "<table>";
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
					 echo "<tr>";
					 echo "<td class=verdana8blk align=center rowspan=33>$i	</td>";
					 echo "<td class=verdana8blk align=center rowspan=33>NOTA TAGIHAN PREMI BERKALA LANJUTAN</td>";
					 echo "<td class=verdana8blk rowspan=11>A</td>";
					 echo "<td class=verdana8blk  align=right rowspan=11>VA</td>";
					 while($arr=$CK->nextrow())
					 {
						if ($i%2) {
					    echo "<tr>";
					    } else {
					    echo "<tr bgcolor=\"#e0e0e4\">";
						}
					 
					 //include "../../includes/belang.php";					 
					 echo "<td class=verdana8blk  align=right>".$arr["KCOB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["KNB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["NNB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["KOB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["NOB"]."</td>";					 
					 echo "<td class=verdana8blk  align=right></td>";
					 echo "<td class=verdana8blk  align=right></td>";
  				 echo "</tr>";
					 $i++;}								 
          
		   $qry = "    SELECT   'VRDI' VALUTA,
           KCOB,
           SUM (KWITOB) KOB,
           SUM (NILAIOB) NOB,
           SUM (KWITNB) KNB,
           SUM (NILAINB) NNB
    FROM   (SELECT   VALUTAOB,
                     kcob,
                     CASE KDKWT WHEN 'OB' THEN jmlhkuitansiob ELSE 0 END KWITOB,
                     CASE KDKWT WHEN 'OB' THEN pdob ELSE 0 END NILAIOB,
                     CASE KDKWT WHEN 'NB' THEN jmlhkuitansiob ELSE 0 END KWITNB,
                     CASE KDKWT WHEN 'NB' THEN pdob ELSE 0 END NILAINB
              FROM   (  SELECT   'NB' KDKWT,
                                 SUM (premidasar) pdob,
                                 SUM (premihitungan) phob,
                                 SUM (JMLPREMI) jmlhpremob,
                                 COUNT (JMLPREMI) jmlhkuitansiob,
                                 kdrayonpenagih AS krob,
                                 namakantor AS nkob,
                                 DECODE (kdvaluta,
                                         0,
                                         'VRDI',
                                         1,
                                         'VRTI',
                                         3,
                                         'VA')
                                    valutaob,
                                 namavaluta AS nvob,
                                 b.KDCABAS AS kcob,
                                 kdrekeningpremi AS krpob,
                                 kdrekeninglawan AS krlob,
                                 SUM (x) AS xob
                          FROM   (  SELECT   a.*,
                                             b.tglseatled,
                                             DECODE (b.tglseatled,
                                                     NULL, 0,
                                                     b.premitagihan)
                                                x
                                      FROM   kuitansi a,
                                             tabel_300_historis_premi@jlindo b
                                     WHERE   a.prefixpertanggungan =
                                                b.prefixpertanggungan
                                             AND a.nopertanggungan =
                                                   b.nopertanggungan
                                             AND a.tglbooked = b.tglbooked
                                             AND a.KDRAYONPENAGIH = 'AC'
                                             AND $periode
                                             AND a.nopenagih LIKE '%'
                                             AND a.kdkuitansi LIKE 'NB%'
                                             AND a.billstatus = '0'
                                  ORDER BY   a.tglbooked) a,
                                 tabel_203_cabas@jlindo b
                         WHERE   b.kdcabas = a.kdcabas(+)
                      GROUP BY   kdrayonpenagih,
                                 namakantor,
                                 kdvaluta,
                                 namavaluta,
                                 b.KDCABAS,
                                 kdrekeningpremi,
                                 kdrekeninglawan
                      UNION ALL
                        SELECT   'OB' KDKWT,
                                 SUM (premidasar) pdob,
                                 SUM (premihitungan) phob,
                                 SUM (JMLPREMI) jmlhpremob,
                                 COUNT (JMLPREMI) jmlhkuitansiob,
                                 kdrayonpenagih AS krob,
                                 namakantor AS nkob,
                                 DECODE (kdvaluta,
                                         0,
                                         'VRDI',
                                         1,
                                         'VRTI',
                                         3,
                                         'VA')
                                    valutaob,
                                 namavaluta AS nvob,
                                 b.KDCABAS AS kcob,
                                 kdrekeningpremi AS krpob,
                                 kdrekeninglawan AS krlob,
                                 SUM (x) AS xob
                          FROM   (  SELECT   a.*,
                                             b.tglseatled,
                                             DECODE (b.tglseatled,
                                                     NULL, 0,
                                                     b.premitagihan)
                                                x
                                      FROM   kuitansi a,
                                             tabel_300_historis_premi@jlindo b
                                     WHERE   a.prefixpertanggungan =
                                                b.prefixpertanggungan
                                             AND a.nopertanggungan =
                                                   b.nopertanggungan
                                             AND a.tglbooked = b.tglbooked
                                             AND a.KDRAYONPENAGIH = 'AC'
                                             AND $periode
                                             AND a.nopenagih LIKE '%'
                                             AND a.kdkuitansi LIKE 'OB%'
                                             AND a.billstatus = '0'
                                  ORDER BY   a.tglbooked) a,
                                 tabel_203_cabas@jlindo b
                         WHERE   b.kdcabas = a.kdcabas(+)
                      GROUP BY   kdrayonpenagih,
                                 namakantor,
                                 kdvaluta,
                                 namavaluta,
                                 b.KDCABAS,
                                 kdrekeningpremi,
                                 kdrekeninglawan))
   WHERE   VALUTAOB = 'VRDI' OR VALUTAOB IS NULL
GROUP BY   KCOB";	 
		   // echo $qry;		 
		//die;
				$CK->parse($qry);
				$CK->execute();	
		   $i = $i+1;
					
					 echo "<tr>";
					// echo "<td class=verdana8blk align=center rowspan=11>$i	</td>";
					//echo "<td class=verdana8blk align=center rowspan=11>NOTA TAGIHAN PREMI BERKALA LANJUTAN</td>";
					 echo "<td class=verdana8blk rowspan=11>A</td>";
					 echo "<td class=verdana8blk  align=right rowspan=11>VRDI</td>";
					 while($arr=$CK->nextrow())
					 {
						if ($i%2) {
					    echo "<tr>";
					    } else {
					    echo "<tr bgcolor=\"#e0e0e4\">";
						}
					 
					 //include "../../includes/belang.php";					 
					 echo "<td class=verdana8blk  align=right>".$arr["KCOB"]."</td>";					
					 echo "<td class=verdana8blk  align=right>".$arr["KNB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["NNB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["KOB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["NOB"]."</td>";
					 echo "<td class=verdana8blk  align=right></td>";
					 echo "<td class=verdana8blk  align=right></td>";
  				 echo "</tr>";
					 $i++;}	
				
		    $qry = "    SELECT   'VRTI' VALUTA,
           KCOB,
           SUM (KWITOB) KOB,
           SUM (NILAIOB) NOB,
           SUM (KWITNB) KNB,
           SUM (NILAINB) NNB
    FROM   (SELECT   VALUTAOB,
                     kcob,
                     CASE KDKWT WHEN 'OB' THEN jmlhkuitansiob ELSE 0 END KWITOB,
                     CASE KDKWT WHEN 'OB' THEN jmlhpremob ELSE 0 END NILAIOB,
                     CASE KDKWT WHEN 'NB' THEN jmlhkuitansiob ELSE 0 END KWITNB,
                     CASE KDKWT WHEN 'NB' THEN jmlhpremob ELSE 0 END NILAINB
              FROM   (  SELECT   'NB' KDKWT,
                                 DECODE (SUM (premidasar), NULL, 1) pdob,
                                 SUM (premihitungan) phob,
                                 SUM (JMLPREMI) jmlhpremob,
                                 COUNT (JMLPREMI) jmlhkuitansiob,
                                 kdrayonpenagih AS krob,
                                 namakantor AS nkob,
                                 DECODE (kdvaluta,
                                         0,
                                         'VRDI',
                                         1,
                                         'VRTI',
                                         3,
                                         'VA')
                                    valutaob,
                                 namavaluta AS nvob,
                                 b.KDCABAS AS kcob,
                                 kdrekeningpremi AS krpob,
                                 kdrekeninglawan AS krlob,
                                 SUM (x) AS xob
                          FROM   (  SELECT   a.*,
                                             b.tglseatled,
                                             DECODE (b.tglseatled,
                                                     NULL, 0,
                                                     b.premitagihan)
                                                x
                                      FROM   kuitansi a,
                                             tabel_300_historis_premi@jlindo b
                                     WHERE   a.prefixpertanggungan =
                                                b.prefixpertanggungan
                                             AND a.nopertanggungan =
                                                   b.nopertanggungan
                                             AND a.tglbooked = b.tglbooked
                                             AND a.KDRAYONPENAGIH = 'AC'
                                             AND $periode
                                             AND a.nopenagih LIKE '%'
                                             AND a.kdkuitansi LIKE 'NB%'
                                             AND a.billstatus = '0'
                                  ORDER BY   a.tglbooked) a,
                                 tabel_203_cabas@jlindo b
                         WHERE   b.kdcabas = a.kdcabas(+)
                      GROUP BY   kdrayonpenagih,
                                 namakantor,
                                 kdvaluta,
                                 namavaluta,
                                 b.KDCABAS,
                                 kdrekeningpremi,
                                 kdrekeninglawan
                      UNION ALL
                        SELECT   'OB' KDKWT,
                                 DECODE (SUM (premidasar), NULL, 1) pdob,
                                 SUM (premihitungan) phob,
                                 SUM (JMLPREMI) jmlhpremob,
                                 COUNT (JMLPREMI) jmlhkuitansiob,
                                 kdrayonpenagih AS krob,
                                 namakantor AS nkob,
                                 DECODE (kdvaluta,
                                         0,
                                         'VRDI',
                                         1,
                                         'VRTI',
                                         3,
                                         'VA')
                                    valutaob,
                                 namavaluta AS nvob,
                                 b.KDCABAS AS kcob,
                                 kdrekeningpremi AS krpob,
                                 kdrekeninglawan AS krlob,
                                 SUM (x) AS xob
                          FROM   (  SELECT   a.*,
                                             b.tglseatled,
                                             DECODE (b.tglseatled,
                                                     NULL, 0,
                                                     b.premitagihan)
                                                x
                                      FROM   kuitansi a,
                                             tabel_300_historis_premi@jlindo b
                                     WHERE   a.prefixpertanggungan =
                                                b.prefixpertanggungan
                                             AND a.nopertanggungan =
                                                   b.nopertanggungan
                                             AND a.tglbooked = b.tglbooked
                                             AND a.KDRAYONPENAGIH = 'AC'
                                             AND $periode
                                             AND a.nopenagih LIKE '%'
                                             AND a.kdkuitansi LIKE 'OB%'
                                             AND a.billstatus = '0'
                                  ORDER BY   a.tglbooked) a,
                                 tabel_203_cabas@jlindo b
                         WHERE   b.kdcabas = a.kdcabas(+)
                      GROUP BY   kdrayonpenagih,
                                 namakantor,
                                 kdvaluta,
                                 namavaluta,
                                 b.KDCABAS,
                                 kdrekeningpremi,
                                 kdrekeninglawan))
   WHERE   VALUTAOB = 'VRTI' OR VALUTAOB IS NULL
GROUP BY   KCOB";	 
		   // echo $qry;		 
		//die;
				$CK->parse($qry);
				$CK->execute();	
		   $i = $i+1;
					
					 echo "<tr>";
					// echo "<td class=verdana8blk align=center rowspan=11>$i	</td>";
					 //echo "<td class=verdana8blk align=center rowspan=11>NOTA TAGIHAN PREMI BERKALA LANJUTAN</td>";
					 echo "<td class=verdana8blk rowspan=11>A</td>";
					 echo "<td class=verdana8blk  align=right rowspan=11>VRTI</td>";
					 while($arr=$CK->nextrow())
					 {
						if ($i%2) {
					    echo "<tr>";
					    } else {
					    echo "<tr bgcolor=\"#e0e0e4\">";
						}
					 
					 //include "../../includes/belang.php";					 
					 echo "<td class=verdana8blk  align=right>".$arr["KCOB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["KNB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["NNB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["KOB"]."</td>";
					 echo "<td class=verdana8blk  align=right>".$arr["NOB"]."</td>";					 
					 echo "<td class=verdana8blk  align=right></td>";
					 echo "<td class=verdana8blk  align=right></td>";
  				 echo "</tr>";
					 $i++;}	
		   echo "</table>";					
					 echo "</div>";
	echo "<hr size=1>";
	echo "<a href=\"index.php\"><font face=\"Verdana\" size=\"2\">Menu Pelaporan</font></a>";
 ?>
