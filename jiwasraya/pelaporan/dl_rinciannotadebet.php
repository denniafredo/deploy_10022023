<? 
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	//include "../../includes/monthselector.php";
//	$kon=ocilogon("CKADM","CKADM","CKADM");
$DB=new database($userid, $passwd, $DBName);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rincian_nota_debet.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
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
<body>


	<?		
	
					switch (substr($periodenya,0,2))	{
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

 $vthn=substr($periodenya,2,4);
// echo $periodenya;
				//$CK->parse($qry);
				//$CK->execute();			
				//$hasil=$CK->affected();
				//echo $hasil;	

$per=substr($periodenya,2,4).substr($periodenya,4,2);
if ($per <= 201603) {$tabel="$DBUser.tabel_300_historis_premi";} else {$tabel="$DBUser.TABEL_300_NOTA_DEBET_TEMP";}

	echo "<div align=center>";
  				 echo "<font color=\"003399\" face=verdana size=2><b>RINCIAN NOTA DEBET  $kantor PERIODE ".strtoupper($blnn)." $vthn</b></font><br><br>";
					 echo "<table border=1 style='border-collapse:collapse' bordercolor=#333333>";
					 echo "<tr class=\"hijao\">";
					 echo "<td align=center><b>NO.</b></td>";
					 echo "<td align=center><b>NOMOR POLIS</b></td>";
					 echo "<td align=center><b>PEMEGANG POLIS</b></td>";
					 echo "<td align=center><b>CARA BAYAR</b></td>";
					 echo "<td align=center><b>TGL. BOOKED</b></td>";
					 echo "<td align=center><b>VALUTA</b></td>";
					 echo "<td align=center><b>PREMI</b></td>";
					 echo "<td align=center><b>KODE REKENING</b></td>";					   				
  				 echo "</tr>";
				 $sql="SELECT   a.prefixpertanggungan,
         a.nopertanggungan,
         d.namaklien1,
         (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=b.kdcarabayar) carabayar,
         TO_CHAR (a.tglbooked, 'dd/mm/yyyy') tglbooked,
         DECODE (a.kdvaluta, '1', 'RUPIAH', '3', 'ASING', 'INDEX') valuta,
         a.nilairp,
         a.kdrekeninglawan
  FROM   ".$tabel." a,
         $DBUser.tabel_200_pertanggungan b,
         $DBUser.tabel_500_penagih c,
         $DBUser.tabel_100_klien d
 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
         AND a.nopertanggungan = b.nopertanggungan
         AND b.nopenagih = c.nopenagih
         AND b.nopemegangpolis = d.noklien
         AND c.kdrayonpenagih = '$kantor'
		 AND a.kdkuitansi not in ('BP3')
         AND TO_CHAR (a.tglbooked, 'mmyyyy') = '$periodenya'";	
		 //echo $sql;
		 $DB->parse($sql);
		 $DB->execute();	
		 $i=1;	 
			while($arr=$DB->nextrow()){
			include "../../includes/belang.php";
			echo "<td align=center>$i.</td>";
			echo "<td align=center>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>";
			echo "<td align=left>".$arr["NAMAKLIEN1"]."</td>";
			echo "<td align=center>".$arr["CARABAYAR"]."</td>";
			echo "<td align=center>".$arr["TGLBOOKED"]."</td>";
			echo "<td align=center>".$arr["VALUTA"]."</td>";
			echo "<td align=right>".number_format($arr["NILAIRP"],2)."</td>";
			echo "<td align=center>".$arr["KDREKENINGLAWAN"]."</td>";			
			echo "</tr>";
			$i++;
			$totalpremi=$totalpremi+$arr["NILAIRP"];
			}
			echo "<tr>";
			echo "<td align=right colspan=6><strong>Total Premi</strong></td>";
			echo "<td align=right><strong>".number_format($totalpremi,2)."</strong></td>";
			echo "<td align=left>&nbsp;</td>";
			echo "</tr>";						 
           echo "</table>";					
					 echo "</div>";

 ?>

