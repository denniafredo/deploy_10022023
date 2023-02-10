<?  

  
  include "../../includes/session.php"; 
  include "../../includes/starttimer.php"; 
  include "../../includes/database.php"; 
	include "../../includes/common.php";
	include "../../includes/fungsi.php";
	include "../../includes/oradb.class.php";

  $DB = new Database($userid, $passwd, $DBName);
	//$DBUL=New database($userid, $passwd, $DBName);
  $DBX = new Database($userid, $passwd, $DBName);
	//$DBX=new database($userid, $passwd, $DBName);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=gadai.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");	

	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Virtual Account</title>
</head>
<style type="text/css">
<!-- 
body, td, select, input {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
<b>DAFTAR POLIS GADAI VS NILAI TUNAI<BR /> 
Per <?=date("m/Y");?> </b><br>

<table border="0" cellpadding="2" cellspacing="1" style="border-collapse: collapse" bordercolor="#CCCCCC" width="100%" id="AutoNumber1">
  <tr>
    <td bgcolor="#89acd8" align="center">No.</td>
    <td bgcolor="#89acd8" align="center">BO</td>
	<td bgcolor="#89acd8" align="center">No. Polis</td>
    <td bgcolor="#89acd8" align="center">Tgl. Gadai</td>
    <td bgcolor="#89acd8" align="center">Pokok</td>
	<td bgcolor="#89acd8" align="center">Bunga</td>
	<td bgcolor="#89acd8" align="center">Total</td>
    <td bgcolor="#89acd8" align="center">Nilai Tunai</td>
  </tr>
  <? 
	$sql = "SELECT   *
  FROM   (SELECT   KDRAYONPENAGIH,a.prefixpertanggungan,
                   a.nopertanggungan,
                   TO_CHAR(a.tglgadai,'DD/MM/YYYY') tglgadai,
                   (saldopinjaman - angsuranpokok) pokok,
                   bunga,
                   NVL ( (saldopinjaman - angsuranpokok), 0) + NVL (bunga, 0)
                      total,
                   DECODE (
                      kdstatusfile,
                      '1',
                      $DBUser.tebusaktif (a.prefixpertanggungan,
                                  a.nopertanggungan,
                                  TO_CHAR (SYSDATE, 'MMYYYY')),
                      $DBUser.tebusnonaktif (a.prefixpertanggungan,
                                     a.nopertanggungan,
                                     TO_CHAR (SYSDATE, 'MMYYYY'))
                   )
                      ntebus
            FROM   $DBUser.TABEL_700_GADAI a,
                   $DBUser.TABEL_200_PERTANGGUNGAN b,
                   $DBUser.TABEL_701_PELUNASAN_GADAI c,
                   $DBUser.TABEL_500_PENAGIH d
           WHERE       a.prefixpertanggungan = b.prefixpertanggungan
                   AND a.nopertanggungan = b.nopertanggungan
                   AND a.prefixpertanggungan = c.prefixpertanggungan
                   AND a.nopertanggungan = c.nopertanggungan
                   AND b.nopenagih=d.nopenagih
                   AND a.status = '3'
                   AND d.kdrayonpenagih='$kantor'
                   AND kdstatusfile IN ('1', '4', 'L')
                   AND (c.tglbooked, c.periodebayar) =
                         (SELECT   MAX (tglbooked), MAX (periodebayar)
                            FROM   $DBUser.TABEL_701_PELUNASAN_GADAI
                           WHERE   prefixpertanggungan =
                                      a.prefixpertanggungan
                                   AND nopertanggungan = a.nopertanggungan
                                   AND tglgadai = a.tglgadai)) WHERE TOTAL<NTEBUS";
  	//echo "<br />".$sql."<br />";
  	$DB->parse($sql);
    $DB->execute();				
		$i = 1;
   	while ($arr=$DB->nextrow()) {
  	echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
  	?>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$i;?></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["KDRAYONPENAGIH"];?> </td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center">
		<a href="#" onClick="window.open('../polis/polis.php?prefix=<?=$arr["PREFIXPERTANGGUNGAN"];?>&noper=<?=$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?></a></td>
    <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$arr["TGLGADAI"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right" ><?=number_format($arr["POKOK"],2,",",".");?></td>
		<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["BUNGA"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["TOTAL"],2,",",".");?></td>
        <td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="right"><?=number_format($arr["NTEBUS"],2,",",".");?></td>
  </tr>
	<? 
	$i++;
	$jmltotal += $arr["PREMI"];
	}
	?>

</table>