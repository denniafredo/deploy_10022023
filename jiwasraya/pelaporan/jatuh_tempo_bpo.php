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
<title>Jatuh Tempo BPO</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<b><font size="3">JATUH TEMPO BPO</font></b>
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

$sql = "SELECT   X.*,TERTUNGGAK,substr (mulas, 1,3)||to_char(ADD_MONTHS(TO_DATE(TERTUNGGAK,'DD/MM/YYYY'),graceperiode),'mm/yyyy') BPO
  FROM   ( 
  SELECT   
                   nopol,
                   prefixpertanggungan,
                   nopertanggungan,
                   prefixpertanggungan || nopertanggungan nopolis,
                   (SELECT   namaklien1
                      FROM   $DBUser.tabel_100_klien
                     WHERE   noklien = a.nopemegangpolis)
                      pemegang_polis,
                   (SELECT   NVL(no_ponsel,phonetetap01)
                      FROM   $DBUser.tabel_100_klien
                     WHERE   noklien = a.nopemegangpolis)
                      phone,
				   (SELECT   phonetagih02
                      FROM   $DBUser.tabel_100_klien
                     WHERE   noklien = a.nopemegangpolis)
                      phonetagih,
                   (SELECT   kdrayonpenagih
                      FROM   $DBUser.tabel_500_penagih
                     WHERE   nopenagih = a.nopenagih)
                      rayonpenagihan,
                   kdproduk,
                   TO_CHAR (mulas, 'DD/MM/YYYY') MULAS,
                   (TO_CHAR (SYSDATE, 'mmyyyy') - TO_CHAR (mulas, 'mmyyyy'))
                      muless,
                   expirasi,
                   lamapembpremi_th,
                   juamainproduk,
                   premi1,
                   premi2,
                   (SELECT   NAMACARABAYAR
                      FROM   $DBUser.TABEL_305_CARA_BAYAR
                     WHERE   kdcarabayar = a.kdcarabayar)
                      kdcarabayar,
                   (SELECT   namavaluta
                      FROM   $DBUser.TABEL_304_VALUTA
                     WHERE   kdvaluta = a.kdvaluta)
                      valuta,
                   indexawal,
                   (SELECT   nilaibenefit
                      FROM   $DBUser.tabel_223_transaksi_produk
                     WHERE       prefixpertanggungan = a.prefixpertanggungan
                             AND nopertanggungan = a.nopertanggungan
                             AND kdbenefit = 'EXPPREMI'
                             AND nilaibenefit IS NOT NULL)
                      benefitexp,
                   (SELECT   MAX (tglbooked)
                      FROM   $DBUser.tabel_300_historis_premi hpl
                     WHERE   hpl.prefixpertanggungan = a.prefixpertanggungan
                             AND hpl.nopertanggungan = a.nopertanggungan
                             AND NOT (hpl.tglseatled IS NULL))
                      lunas_terakhir,
                   (SELECT   TO_CHAR (MAX (tglbooked), 'DD/MM/YYYY')
                      FROM   $DBUser.tabel_300_historis_premi hpl
                     WHERE   hpl.prefixpertanggungan = a.prefixpertanggungan
                             AND hpl.nopertanggungan = a.nopertanggungan
                             AND NOT (hpl.tglseatled IS NULL))
                      lunas,
                   (SELECT   TO_CHAR (MIN (tglbooked), 'DD/MM/YYYY')
                      FROM   $DBUser.tabel_300_historis_premi hp
                     WHERE   hp.prefixpertanggungan = a.prefixpertanggungan
                             AND hp.nopertanggungan = a.nopertanggungan
                             AND hp.tglseatled IS NULL)
                      tertunggak
            FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
           WHERE       a.nopenagih = p.nopenagih
                   AND a.kdpertanggungan = '2'
                   AND a.kdstatusfile = '1'
                   AND a.kdcarabayar <> 'X'
                   AND a.kdproduk <> 'ATP'
                   AND a.tglakhirpremi > SYSDATE                   
                   ) X, $DBUser.tabel_241_grace_periode z
 WHERE  X.KDPRODUK=Z.KDPRODUK AND TERTUNGGAK IS NOT NULL
 AND TO_CHAR(ADD_MONTHS(TO_DATE(TERTUNGGAK,'DD/MM/YYYY'),graceperiode),'YYYYMM')='".$tglcari."'";

			 //echo $sql."<br/><br/>";
?>
<a href="#" class="verdana8blu" onClick="NewWindow('download_xls_bpo.php?tglcari=<?=$tglcari;?>&year=<?=$year;?>&kdbank=<?=$kdbank;?>&kantornya=<?=$kantornya;?>','Downloadexcel',600,250,1);">Dowload ke Excel</a><br>
<b>JATUH TEMPO TUNGGAKAN</b>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td><b>No</b></td>
		<td><b>No. Polis</b></td>
		<td><b>Pemegang Polis</b></td>
        <td><b>Phone (1)</b></td>
        <td><b>Phone (2)</b></td>
		<td><b>Produk</b></td>
		<td><b>Lunas Per</b></td>
        <td><b>Premi</b></td>		
        <td><b>Cara</b></td>
        <td><b>Valuta</b></td>
        <td><b>Tunggakan</b></td>
        <td><b>BPO</b></td>
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
		<td><?=$row["NOPOLIS"];?></td>
		<td><?=$row["PEMEGANG_POLIS"]?></td>
        <td><?=$row["PHONE"];?></td>
        <td><?=$row["PHONETAGIH"];?></td>
		<td><?=$row["KDPRODUK"];?></td>
		<td><?=$row["LUNAS"];?></td>
        <td><?=number_format($premi,2,",",".");?>
        <td><?=$row["KDCARABAYAR"];?></td>
        <td><?=$row["VALUTA"];?></td>
        <td><?=$row["TERTUNGGAK"];?></td>
        <td><?=$row["BPO"];?></td>
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