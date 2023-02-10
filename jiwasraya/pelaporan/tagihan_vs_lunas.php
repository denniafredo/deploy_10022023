<?
	include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
  include "../../includes/dropdown_date.php";
 

	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);

?>
<html>

<head>
<title>Tagihan Pelunasan</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<b><font size="3">TAGIHAN VS PELUNASAN</font></b>
<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(5,"Future");?> 
            <input type="submit" name="submit" value="GO" class="but">
            <? //echo $sqa;?>
            </td>
	</tr>
</table>
<?
if ($carabayar=='B') {$cara=" and a.kdcarabayar in ('1','M') ";}
elseif ($carabayar=='K') {$cara=" and a.kdcarabayar in ('2','Q') ";}
elseif ($carabayar=='S') {$cara=" and a.kdcarabayar in ('3','H') ";}
elseif ($carabayar=='T') {$cara=" and a.kdcarabayar in ('4','A') ";}
elseif ($carabayar=='E') {$cara=" and a.kdcarabayar in ('E') ";}
elseif ($carabayar=='J') {$cara=" and a.kdcarabayar in ('J') ";}
?>
</form>
<?
if ($submit){
//$conn=ocilogon("JSADM","JSADMABC","GLABC"); 
//echo $day;
if(!isset($month))
{
//  $tglcari = date('Ymd');
  $tglcari = date('Ym');
}
else
{
  $tglcari = $year.$month;
}

$sql="select c.kdrayonpenagih,TO_CHAR(TGLBOOKED,'MMYYYY') BOOKED, a.kdvaluta,a.kdrekeningpremi,COUNT (nilairp) jmlkwt,
                          SUM (nilairp)
                          + sum(NVL((SELECT SUM(PREMITAGIHAN) FROM $DBUser.TABEL_300_HISTORIS_RIDER 
                          WHERE prefixpertanggungan = a.prefixpertanggungan         
                          AND nopertanggungan = a.nopertanggungan                   
                          AND tglbooked=a.tglbooked),0))                            
                           jmlnilairp,
                           sum(NVL((SELECT count(nopertanggungan) FROM $DBUser.TABEL_300_HISTORIS_PREMI 
                          WHERE prefixpertanggungan = a.prefixpertanggungan         
                          AND nopertanggungan = a.nopertanggungan                   
                          AND tglbooked=a.tglbooked
                          and tglseatled is not null),0)) kwt,
                           sum(NVL((SELECT SUM(nilairp) FROM $DBUser.TABEL_300_HISTORIS_PREMI 
                          WHERE prefixpertanggungan = a.prefixpertanggungan         
                          AND nopertanggungan = a.nopertanggungan                   
                          AND tglbooked=a.tglbooked
                          and tglseatled is not null),0)) lunas
                            FROM   $DBUser.tabel_300_historis_premi a,
                          $DBUser.tabel_200_pertanggungan b,
                          $DBUser.tabel_500_penagih c
                  WHERE       a.prefixpertanggungan = b.prefixpertanggungan
                          AND a.nopertanggungan = b.nopertanggungan
                          AND b.nopenagih = c.nopenagih
                          AND SUBSTR (a.kdkuitansi, 1, 2) IN ('NB', 'OB')
                          AND TO_CHAR (a.tglbooked, 'yyyymm') = '".$tglcari."'
               GROUP BY   c.kdrayonpenagih,
                          a.kdrekeningpremi,
                          a.kdrekeninglawan,
                          a.kdvaluta,
						  TO_CHAR(TGLBOOKED,'MMYYYY'),
                          SUBSTR (a.kdkuitansi, 1, 2)
                          order by c.kdrayonpenagih";


			 //echo $sql."<br/><br/>";
			 //die;
?>
<!--<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>-->

<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
    	<td align="center" rowspan="2"><b>No</b></td>
		<td align="center" rowspan="2"><b>Kantor</b></td>
		<td align="center" rowspan="2"><b>Valuta</b></td>
        <td align="center" rowspan="2"><b>Bulan</b></td>
        <td align="center" rowspan="2"><b>Rek. Premi</b></td>
        <td align="center" colspan="2"><b>Tagihan</b></td>
		<td align="center" colspan="2"><b>Pelunasan</b></td>
        <td align="center" colspan="2"><b>Sisa</b></td>
    </tr>
    <tr bgcolor="#b1c8ed">
        <td align="center"><b>Kuit.</b></td>
		<td align="center"><b>premi</b></td>
		<td align="center"><b>Kuit</b></td>
        <td align="center"><b>Premi</b></td>		
        <td align="center"><b>Kuit</b></td>
        <td align="center"><b>Premi</b></td>
	</tr>
	<?
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";
	if($kdvaluta=='1' || $kdvaluta=='3')
	$indexawal=1;
	else
	$indexawal=$row["INDEXAWAL"];
	if($row["MULESS"]<=5)  //membedakan antara premi1 dan premi2
	$premi=$row["PREMI1"]/1;	
	else
	$premi=$row["PREMI2"]/1;
	?>
		<td><?=$i;?></td>
		<td><?=$row["KDRAYONPENAGIH"];?></td>
		<td><?=$row["KDVALUTA"]?></td>
        <td><?=$row["BOOKED"];?></td>
        <td><?=$row["KDREKENINGPREMI"];?></td>
		<td><?=$row["JMLKWT"];?></td>
        <td><?=number_format($row["JMLNILAIRP"],2,",",".");?>
        <td><?=$row["KWT"];?></td>
        <td><?=number_format($row["LUNAS"],2,",",".");?>
        <td><?=$row["JMLKWT"]-$row["KWT"];?></td>
        <td><?=number_format($row["JMLNILAIRP"]-$row["LUNAS"],2,",",".");?>
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>
<br />


</form>
<?
}
?>
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>