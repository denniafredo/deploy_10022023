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
<title>Jatuh Tempo Premi</title>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<link href="../../includes/transaksi.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="20">
<b><font size="3">JATUH TEMPO PREMI I & MEMORIAL</font></b>
<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(5,"Future");?> 
        Valuta
		<select name="kdvaluta">
  			<?	
  			$sqa="select kdvaluta,namavaluta from $DBUser.tabel_304_valuta";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDVALUTA"]==$kdvaluta){ echo " selected"; } else {echo "";}
      					echo " value=".$arr["KDVALUTA"].">(".$arr["KDVALUTA"].") ".$arr["NAMAVALUTA"]."</option>";
  					}
				?>
				<!--<option value="2" <?=$vsel;?>>(2) DOLLAR GADAI RUPIAH</option>-->
  			</select>
            Cara Bayar
            <select name="carabayar">
            <option value="B" <? if ($carabayar=='B'){ echo "selected";} else {echo "";}?>>BULANAN</option>
            <option value="K" <? if ($carabayar=='K'){ echo "selected";} else {echo "";}?>>KUARTALAN</option>
            <option value="S" <? if ($carabayar=='S'){ echo "selected";} else {echo "";}?>>SEMETERAN</option>
            <option value="T" <? if ($carabayar=='T'){ echo "selected";} else {echo "";}?>>TAHUNAN</option>
            <option value="X" <? if ($carabayar=='X'){ echo "selected";} else {echo "";}?>>SEKALIGUS</option>
            </select>
            <!--Penagih
            <select name="nopenagih" onChange="GantiCari(document.cariwaktu)">
  <option value="">-- pilih --</option>
  <? /*
			$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kantor."' ".
      				 $pskg." ".
							 //"and nvl(a.penagihautodebet,'0')='0' ".
      				 " order by b.namaklien1";
			$DB->parse($sql);
      $DB->execute();
			while ($ro=$DB->nextrow())
  		{
			  echo "<option ";
  			if ($nopenagih==$ro["NOPENAGIH"]){ echo " selected"; }
  			echo " value=".$ro["NOPENAGIH"].">".$ro["NAMAKLIEN1"]."</option>";
			} */
			?>
</select>-->
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
elseif ($carabayar=='X') {$cara=" and a.kdcarabayar in ('X','E','J') ";}
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

$sql = "SELECT   nopol,a.prefixpertanggungan,a.nopertanggungan,
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
         kdproduk,
         TO_CHAR(mulas,'DD/MM/YYYY') MULAS,
         (to_char(sysdate,'mmyyyy')-to_char(mulas,'mmyyyy')) muless,
		 expirasi,
         lamapembpremi_th,
         juamainproduk,
         premi1,
         premi2,
         (SELECT   NAMACARABAYAR
            FROM   $DBUser.TABEL_305_CARA_BAYAR
           WHERE   kdcarabayar = a.kdcarabayar) kdcarabayar,
         (SELECT   namavaluta
            FROM   $DBUser.TABEL_304_VALUTA
           WHERE   kdvaluta = a.kdvaluta) valuta,
         indexawal,
         (SELECT   nilaibenefit
            FROM   $DBUser.tabel_223_transaksi_produk
           WHERE       prefixpertanggungan = a.prefixpertanggungan
                   AND nopertanggungan = a.nopertanggungan
                   AND kdbenefit = 'EXPPREMI'
                   AND nilaibenefit IS NOT NULL)
            benefitexp,
         TO_CHAR(TO_DATE ('".$tglcari."01', 'YYYYMMDD'),'DD/MM/YYYY') tglexp,
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=a.prefixpertanggungan AND hpl.nopertanggungan=a.nopertanggungan AND not(hpl.tglseatled is null)) lunas
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p, $DBUser.TABEL_300_TAGIHAN_PERTAMA c, $DBUser.TABEL_214_UNDERWRITING u
 WHERE  a.nopenagih=p.nopenagih and  
 		p.KDRAYONPENAGIH='$kantor'
		 AND a.kdpertanggungan = '1'
         AND a.kdstatusfile = '1'
		 AND c.jenis='P'
		 --AND SUBSTR(a.kdproduk,1,3) in ('JL4')
		 AND a.kdvaluta='$kdvaluta' ".$cara.
		 " AND a.prefixpertanggungan=c.prefixpertanggungan ".
		 "AND a.nopertanggungan=c.nopertanggungan ".
		 "AND a.prefixpertanggungan=u.prefixpertanggungan
      AND a.nopertanggungan=u.nopertanggungan
	  AND TO_CHAR(a.mulas, 'YYYYMM') = '$year$month'";

			 //echo $sql."<br/>";
?>
<b>JATUH TEMPO PREMI</b>
<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
	<tr bgcolor="#b1c8ed">
		<td><b>No</b></td>
		<td><b>No. Polis</b></td>
		<td><b>Pemegang Polis</b></td>
		<td><b>Produk</b></td>
		<td><b>Mulas</b></td>
        <td><b>Premi</b></td>		
		<td><b>Jt. Tempo</b></td>
        <td><b>Penagih</b></td>
        <!--<td><b>Lunas Per</b></td>-->
        <td><b>Cara</b></td>
        <td><b>Valuta</b></td>
		<td colspan="2"><b>Action</b></td>
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
        <td><?=$row["NAMAPENAGIH"];?></td>
        <!--<td><?=$row["LUNAS"];?></td>-->
        <td><?=$row["KDCARABAYAR"];?></td>
        <td><?=$row["VALUTA"];?></td>
        <td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempobp3.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">CETAK TAGIHAN I</a>";?></td>
        <td>
        <?="<a href=\"#\" onclick=\"NewWindow('../akunting/memo_klaim.php?prefix=".$row["PREFIXPERTANGGUNGAN"]."&noper=".$row["NOPERTANGGUNGAN"]."&tglgadai=".$arr["TGLHITUNG"]."&tglmohon=".$arr["TGLMOHON"]."','',750,300,1);\">CETAK MEMORIAL</a>";?>
        </td>
		
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