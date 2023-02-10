<?
  include "../../includes/session.php";
  include "../../includes/database.php";
  include "../../includes/kantor.php";
	include "../../includes/fungsi.php";
	$DB=new database($userid, $passwd, $DBName);
	$KT=new Kantor($userid,$passwd,$kdkantor);
	
?>
<html>
<title>Realisasi Premi BO</title>
<head>
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
<?	
$year = isset($year) ? $year : date("Y");
if(!isset($month))
{
$month  = "01";
$month2 = date('m');
}
?>

<h4>REALISASI PREMI <?=$nbob;?> <?=$KT->namakantor;?> <br />
Bulan <?=namaBulan($month)." s.d ".namaBulan($month2)." ".$year;?>
</h4>
 		<table border="0" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#ffdeb3">
					<td height="20">No</td>
					<td>No. Polis</td>
					<td>Mulas</td>
					<td>Tgl Booked</td>
					<td>Tgl Seatled</td>
					<td>Realisasi Premi</td>
					
				</tr>				
         <?
				 if($nbob=="OB")
				 {
				  $qrynbob = "and substr(y.kdkuitansi,1,2)='OB'";
					$fieldtarget = "target_ob";
				 }
				 else
				 {
				  $qrynbob = "and substr(y.kdkuitansi,1,2) in ('BP','NB')";
					$fieldtarget = "target_nb";
				 }
				 
				 $sql = "SELECT y.prefixpertanggungan,y.nopertanggungan,
				 								to_char(w.mulas,'DD/MM/YYYY') mulas,
												to_char(y.tglbooked,'DD/MM/YYYY') tglbooked,
												to_char(y.tglseatled,'DD/MM/YYYY') tglseatled,
                      y.nilairp,y.premitagihan,y.kdvaluta 
                            FROM 
                                $DBUser.tabel_300_historis_premi y,
                                $DBUser.tabel_200_pertanggungan w,
                                $DBUser.tabel_500_penagih z
                           WHERE w.prefixpertanggungan = y.prefixpertanggungan
                             AND w.nopertanggungan = y.nopertanggungan
                             and w.nopenagih=z.nopenagih 
                             AND y.tglseatled IS NOT NULL
                             AND w.kdpertanggungan = '2'
                             AND TO_CHAR (y.tglbooked, 'YYYYMM') between '$year$month' and '$year$month2'
                             $qrynbob
                             and z.kdrayonpenagih='$kdkantor'
                            order by y.prefixpertanggungan,y.nopertanggungan,y.tglbooked";
					//echo $sql;
        	$DB->parse($sql);
        	$DB->execute();
        	$i=1;
        	while ($arr=$DB->nextrow()) {
        	 echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
        	 echo "<td>$i</td>";
           echo "<td><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
        	 echo "<td>".$arr["MULAS"]."</td>";
					 echo "<td>".$arr["TGLBOOKED"]."</td>";
					 echo "<td>".$arr["TGLSEATLED"]."</td>";
        	 echo "<td align=right>".number_format($arr["NILAIRP"],2,",",".")."</td>";
           echo "</tr>";
           $i++; 
					 $jmlrelaisasi += $arr["NILAIRP"];
        	}		
        ?>				
				<tr bgcolor="#dddddd">
				  <td height="20" colspan="4"></td>
					<td height="20">Jumlah </td>
					<td align="right"><?=number_format($jmlrelaisasi,2,",",".");?></td>
					
				</tr>
        </table>			

</body>
</html>
