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
<title>Jatuh Tempo Tahapan</title>
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
<b><font size="3">JATUH TEMPO TAHAPAN</font></b><br>


<form name="frm" action="<?=$PHP_SELF;?>" method="post">
<table border="1" style="border-collapse: collapse" width="100%" id="table2" cellpadding="4" bordercolor="#B3CFFF">
	<tr>
		<td bgcolor="#CEE7FF">Tanggal Proses <?=ShowFromDateNoDay(6,"Future");?> 
        
          Kantor
          <?
		  if ($kantor=='KP') {$ktrnya=" ";} else {$ktrnya=" and kdkantor='$kantor'";}
            echo "<select name='kdkantor'>";

  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".$ktrnya.
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
         decode(indexawal,0,1,indexawal) indexawal,
         c.nilaibenefit benefitexp,
         TO_CHAR (TO_DATE ('".$tglcari."01', 'YYYYMMDD'), 'DD/MM/YYYY') tglexp,         
         (SELECT   alamattagih01 || ' ' || alamattagih02
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = a.notertanggung)
            ALAMAT,
		 (SELECT   NVL(PHONETAGIH01,'') || ' / ' || NVL(NO_PONSEL,'')
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = a.notertanggung)
            TELP,	
         (SELECT   namakotamadya
            FROM   $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
           WHERE   kli.noklien = a.notertanggung
                   AND kdkotamadyatagih = kdkotamadya)
            KOTA
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p,$DBUser.tabel_223_transaksi_produk c
 WHERE       a.nopenagih = p.nopenagih
         AND p.KDRAYONPENAGIH = '$kdkantor'
         AND a.prefixpertanggungan=c.prefixpertanggungan
         AND a.nopertanggungan=c.nopertanggungan
         AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
         AND substr(c.kdbenefit,1,6)='BNFTHP'
		 AND NVL(c.nilaibenefit,0)>0
         AND TO_CHAR (c.expirasi, 'YYYYMM') = '".$tglcari."'
		 union
		 SELECT   nopol,
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
         decode(indexawal,0,1,indexawal) indexawal,
         c.nilaibenefit benefitexp,
         TO_CHAR (TO_DATE ('".$tglcari."01', 'YYYYMMDD'), 'DD/MM/YYYY') tglexp,         
         (SELECT   alamattagih01 || ' ' || alamattagih02
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = a.notertanggung)
            ALAMAT,
		 (SELECT   NVL(PHONETAGIH01,'') || ' / ' || NVL(NO_PONSEL,'')
            FROM   $DBUser.tabel_100_klien kli
           WHERE   kli.noklien = a.notertanggung)
            TELP,	
         (SELECT   namakotamadya
            FROM   $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
           WHERE   kli.noklien = a.notertanggung
                   AND kdkotamadyatagih = kdkotamadya)
            KOTA
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p,$DBUser.tabel_800_pembayaran_anuitas c
 WHERE       a.nopenagih = p.nopenagih
         AND p.KDRAYONPENAGIH = '$kdkantor'
         AND a.prefixpertanggungan=c.prefixpertanggungan
         AND a.nopertanggungan=c.nopertanggungan
         AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
		 AND c.kdproduk in ('DGI')
         AND substr(c.kdbenefit,1,6)='BNFTHP'
		 AND NVL(c.nilaibenefit,0)>0
         AND TO_CHAR (c.tglbooked, 'YYYYMM') = '".$tglcari."'
		 ";
         

			 //echo $sql."<br/>";
?><br>
<a class="myButton" href="#" onClick="window.open('./cetakjatuhtempotahapanall.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		CETAK JATUH TEMPO TAHAPAN</a>&nbsp;<a class="myButton" href="#" onClick="window.open('./jatuh_tempo_expirasi_dl.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		DOWNLOAD JATUH TEMPO TAHAPAN</a><br>
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
		<td><b>JUA</b></td>
        <td><b>Alamat</b></td>
        <td><b>Telp/HP</b></td>
        <td><b>Kota</b></td>
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
        <td><?=number_format($premi,2,",",".");?></td>
        <td><?=$row["TGLEXP"];?></td>
        <td><?=number_format($row["JUAMAINPRODUK"],2,",",".");?></td>
        <td><?=$row["ALAMAT"];?></td>
        <td><?=$row["TELP"];?></td>
        <td><?=$row["KOTA"];?></td>
        <td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempo_tahapan.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">cetak</a>";?></td>
        <!--<td><? //"<a href=\"javascript:NewWindow('../pelaporan/cetakinfocb.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">Info CB</a>";?>
        <!--<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf'>Info CB</a>-->
       <!-- </td>-->
		
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