<?
/*header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=virtual_account.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");*/
include "../../includes/session.php";
include "../../includes/common.php";
include "../../includes/database.php";
include "../../includes/klien.php";
include "../../includes/pertanggungan.php";
include "../../includes/dropdown_date.php";
 

	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);

?>
<html>

<head>
<title>Jatuh Tempo Premi</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
.myButton {
        
        -moz-box-shadow: -7px -5px 13px -3px #1564ad;
        -webkit-box-shadow: -7px -5px 13px -3px #1564ad;
        box-shadow: -7px -5px 13px -3px #1564ad;
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5));
        background:-moz-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-webkit-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-o-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:-ms-linear-gradient(top, #79bbff 5%, #378de5 100%);
        background:linear-gradient(to bottom, #79bbff 5%, #378de5 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5',GradientType=0);
        
        background-color:#79bbff;
        
        -moz-border-radius:9px;
        -webkit-border-radius:9px;
        border-radius:9px;
        
        border:1px solid #337bc4;
        
        display:inline-block;
        color:#ffffff;
        font-family:Times New Roman;
        font-size:15px;
        font-weight:bold;
        padding:5px 15px;
        text-decoration:none;
        
        text-shadow:-5px 3px 11px #528ecc;
        
    }
    .myButton:hover {
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff));
        background:-moz-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-webkit-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-o-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:-ms-linear-gradient(top, #378de5 5%, #79bbff 100%);
        background:linear-gradient(to bottom, #378de5 5%, #79bbff 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff',GradientType=0);
        
        background-color:#378de5;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }
</style>
<body topmargin="20">

<form name="frm" action="<?=$PHP_SELF;?>" method="post">

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
//if ($submit){
//$conn=ocilogon("JSADM","JSADMABC","GLABC"); 
//echo $day;
if(!isset($month))
{
  $tglcari=$tglcari;
//  $tglcari = date('Ymd');
 // $tglcari = date('Ym');
}
else
{
  $tglcari = $year.$month;
}

$sql = "SELECT   nopol,
         a.prefixpertanggungan,
         a.nopertanggungan,
         a.prefixpertanggungan || a.nopertanggungan nopolis,
         (SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopemegangpolis)
            pemegang_polis,
         (SELECT   namaklien1
            FROM   $DBUser.tabel_100_klien
           WHERE   noklien = a.nopenagih)
            namapenagih,
         (SELECT   kdrayonpenagih
            FROM   $DBUser.tabel_500_penagih
           WHERE   nopenagih = a.nopenagih)
            rayonpenagihan,
         a.kdproduk,
         TO_CHAR (mulas, 'DD/MM/YYYY') MULAS,
         (TO_CHAR (SYSDATE, 'mmyyyy') - TO_CHAR (mulas, 'mmyyyy')) muless,
         a.expirasi,
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
         c.nilaibenefit benefitexp,
         TO_CHAR (TO_DATE ('".$tglcari."01', 'YYYYMMDD'), 'DD/MM/YYYY') tglexp,         
         (SELECT   alamattagih01 || ' ' || alamattagih02
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = a.notertanggung)
            ALAMAT,
         (SELECT   namakotamadya
            FROM   $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
           WHERE   kli.noklien = a.notertanggung
                   AND kdkotamadyatagih = kdkotamadya)
            KOTA
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p,$DBUser.tabel_223_transaksi_produk c
 WHERE       a.nopenagih = p.nopenagih
         AND p.KDRAYONPENAGIH = 'AC'
         AND a.prefixpertanggungan=c.prefixpertanggungan
         AND a.nopertanggungan=c.nopertanggungan
         AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
         AND substr(c.kdbenefit,1,6)='BNFTHP'
         AND TO_CHAR (c.expirasi, 'YYYYMM') = '".$tglcari."'";
         

//			 echo $sql."<br/>";
	//		 die;
?><br>

<b>JATUH TEMPO TAHAPAN</b>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td><b>No</b></td>
		<td><b>No. Polis</b></td>
		<td><b>Pemegang Polis</b></td>
		<td><b>Produk</b></td>
		<td><b>Mulas</b></td>
        <td><b>Premi</b></td>		
		<td><b>Jt. Tempo</b></td>
        <td><b>Alamat</b></td>
        <td><b>Kota</b></td>
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
	$premi=$row["PREMI1"]/$indexawal;	
	else
	$premi=$row["PREMI2"]/$indexawal;	
	?>
		<td><?=$i;?></td>
		<td><?=$row["NOPOLIS"];?></td>
		<td><?=$row["PEMEGANG_POLIS"]?></td>
		<td><?=$row["KDPRODUK"];?></td>
		<td><?=$row["MULAS"];?></td>
        <!--<td><?=number_format($row["PREMI1"],2,",",".");?></td>-->
        <td><?=number_format($premi,2,",",".");?>
        <td><?=$row["TGLEXP"];?></td>
        <td><?=$row["ALAMAT"];?></td>
        <td><?=$row["KOTA"];?></td>
        
		
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>
<br />


</form>
<?
//}
?>

</body>
</html>