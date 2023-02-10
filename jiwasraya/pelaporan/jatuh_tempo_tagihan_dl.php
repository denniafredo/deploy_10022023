<?
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=tagihan.xls" );
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
header("Pragma: public");
include "../../includes/session.php";
include "../../includes/common.php";
include "../../includes/database.php";
include "../../includes/klien.php";
include "../../includes/pertanggungan.php";
include "../../includes/dropdown_date.php";
 

	$DB=new database($DBUser, $DBPass, $DBName);
	$DB1=new database($userid, $passwd, $DBName);

?>
<html>

<head>
<title>Jatuh Tempo Premi</title>

</head>

<body topmargin="20">

<form name="frm" action="<?=$PHP_SELF;?>" method="post">

</form>
<?
//if ($submit){
//$conn=ocilogon("JSADM","JSADMABC","GLABC"); 
//echo $day;


$sql = "SELECT PREFIXPERTANGGUNGAN,
			NOPERTANGGUNGAN,
			KDKUITANSI,
			BUKTISETOR,
			TGLSEATLED,
			TO_CHAR(TGLBOOKED,'DD/MM/YYYY') TGLBOOKED,
			ROUND(NILAIRP,2) NILAIRP,
			ROUND(PREMI1,2) PREMI1,
			ROUND(PREMI2,2) PREMI2,
			KDVALUTA,
			NOPENAGIH,
			ROUND(INDEXAWAL,2) INDEXAWAL,
			ROUND(PREMITAGIHAN,2) PREMITAGIHAN,
			KDRAYONPENAGIH,
			PENAGIH,
			ROUND(KURS_INDEX,2) KURS_INDEX,
			ROUND(KURS_DOLAR,2) KURS_DOLAR,
			KDPRODUK,
			NAMAPRODUK,
			KDCARABAYAR,
			NAMACARABAYAR,
			KDSTATUSFILE,
			KDREKENINGPREMI,
			KDREKENINGLAWAN FROM DW_PP.RPT_TUNGGAKAN_PP_".$tglcari."@dw_pp WHERE KDRAYONPENAGIH='$kdkantor'";

			// echo $sql."<br/>";
?><br>

<b>JATUH TEMPO PREMI</b>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td><b>NO.</b></td>
        <td><b>NOPERTANGGUNGAN</b></td>
        <td><b>KD KUITANSI</b></td>
        <td><b>BUKTI SETOR</b></td>
        <td><b>TGL SEATLED</b></td>
        <td><b>TGL BOOKED</b></td>
        <td><b>NILAI RP</b></td>
        <td><b>PREMI1</b></td>
        <td><b>PREMI2</b></td>
        <td><b>KD VALUTA</b></td>
        <td><b>NOPENAGIH</b></td>
        <td><b>INDEXAWAL</b></td>
        <td><b>PREMI TAGIHAN</b></td>
        <td><b>KANTOR</b></td>
        <td><b>PENAGIH</b></td>
        <td><b>KURS INDEX</b></td>
        <td><b>KURS DOLAR</b></td>
        <td><b>KD PRODUK</b></td>
        <td><b>NAMAP RODUK</b></td>
        <td><b>KD CARA BAYAR</b></td>
        <td><b>NAMA CARABAYAR</b></td>
        <td><b>STATUS</b></td>
        <td><b>KD REKENING PREMI</b></td>
        <td><b>KD REKENING LAWAN</b></td>
	</tr>
	<?
	$DB->parse($sql);
    $DB->execute();
	$i=1;
	while ($row=$DB->nextrow()) {
	echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";	

	?>
		<td><?=$i;?></td>
		<td><?=$row["PREFIXPERTANGGUNGAN"].'-'.$row["NOPERTANGGUNGAN"];?></td>
        <td><?=$row["KDKUITANSI"];?></td>
        <td><?=$row["BUKTISETOR"];?></td>
        <td><?=$row["TGLSEATLED"];?></td>
        <td><?=$row["TGLBOOKED"];?></td>
        <td><?=$row["NILAIRP"];?></td>
        <td><?=$row["PREMI1"];?></td>
        <td><?=$row["PREMI2"];?></td>
        <td><?=$row["KDVALUTA"];?></td>
        <td><?=$row["NOPENAGIH"];?></td>
        <td><?=$row["INDEXAWAL"];?></td>
        <td><?=$row["PREMITAGIHAN"];?></td>
        <td><?=$row["KDRAYONPENAGIH"];?></td>
        <td><?=$row["PENAGIH"];?></td>
        <td><?=$row["KURS_INDEX"];?></td>
        <td><?=$row["KURS_DOLAR"];?></td>
        <td><?=$row["KDPRODUK"];?></td>
        <td><?=$row["NAMAPRODUK"];?></td>
        <td><?=$row["KDCARABAYAR"];?></td>
        <td><?=$row["NAMACARABAYAR"];?></td>
        <td><?=$row["KDSTATUSFILE"];?></td>
        <td><?=$row["KDREKENINGPREMI"];?></td>
        <td><?=$row["KDREKENINGLAWAN"];?></td>
        
		
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