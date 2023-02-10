<?
	include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
	//include "../../includes/rolekasir.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
  include "../../includes/dropdown_date.php";
 

	$DB=new database($DBUser, $DBPass, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
	
// Connects to the XE service (i.e. database) on the "localhost" machine
/*
$conn = oci_connect($DBUser, $DBPass, $DBName);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, "SELECT * FROM DW_PP.RPT_TUNGGAKAN_PP_042016@dw_pp WHERE KDRAYONPENAGIH='AC'");
oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
    // Use the uppercase column names for the associative array indices
    echo $row[0] . " and " . $row['PREFIXPERTANGGUNGAN']   . " are the same<br>\n";
    echo $row[1] . " and " . $row['NOPERTANGGUNGAN'] . " are the same<br>\n";
}

oci_free_statement($stid);
oci_close($conn);
*/
?>


<html>

<head>
<title>Daftar Tunggakan Premi</title>
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
<b><font size="3">JATUH TEMPO PREMI</font></b><br>


<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(5,"Future");?> 
        
            Kantor
            <?
            echo "<select name='kdkantor'>";

  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' and kdkantor='$kantor'".
  			     		 "order by kdkantor";
  					$DB->parse($sqa);
  					$DB->execute();	
  					while ($arr=$DB->nextrow()) {
  					  echo "<option ";
      					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
      					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
  					}
  			
				
 			echo "</select>";
            ?>
            <!--Penagih
            <select name="nopenagih" onChange="GantiCari(document.cariwaktu)">
  <option value="">-- pilih --</option>
  <? 
			/*$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
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
  $tglcari = $month.$year;
}

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
			KDREKENINGLAWAN FROM DW_PP.RPT_TUNGGAKAN_PP_".$tglcari."@dw_pp WHERE KDRAYONPENAGIH='$kdkantor' order by nopertanggungan, TGLBOOKED";
//                  TO_DATE ('".$tglcari."', 'YYYYMM'),
//                  ";

			 //echo $sql."<br/>";
?><br>
<a class="myButton" href="#" onClick="window.open('./jatuh_tempo_tagihan_dl.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		DOWNLOAD TUNGGAKAN PREMI</a><br>
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
}
?>
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>