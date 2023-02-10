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
            <option value="S" <? if ($carabayar=='S'){ echo "selected";} else {echo "";}?>>SEMESTERAN</option>
            <option value="T" <? if ($carabayar=='T'){ echo "selected";} else {echo "";}?>>TAHUNAN</option>
            <option value="E" <? if ($carabayar=='E'){ echo "selected";} else {echo "";}?>>SEKALIGUS CICIL 5 KALI</option>
            <option value="J" <? if ($carabayar=='J'){ echo "selected";} else {echo "";}?>>SEKALIGUS CICIL 10 KALI</option>
            </select>
            Kantor
            <?
            echo "<select name='kdkantor'>";

  			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' and kdkantor='$kantor' ".
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

$sql = "SELECT   nopol,prefixpertanggungan,nopertanggungan,
         prefixpertanggungan || nopertanggungan nopolis,
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
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=a.prefixpertanggungan AND hpl.nopertanggungan=a.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
       (SELECT alamattagih01||' '||alamattagih02
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = a.notertanggung) ALAMAT,
		(SELECT namakotamadya
          FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
         WHERE kli.noklien = a.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		 TO_CHAR(a.TGLAKHIRPREMI,'DD/MM/YYYY') TGLAKHIRPREMI
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
 WHERE   a.nopenagih=p.nopenagih
 	     --and a.nopenagih='$nopenagih'
         AND p.KDRAYONPENAGIH='$kdkantor'
		 AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
         AND a.kdcarabayar <> 'X'
		 and a.TGLAKHIRPREMI >= TO_DATE ('".$tglcari."', 'YYYYMM')
		 --AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')
		 AND a.kdvaluta='$kdvaluta' ".$cara."
         AND MOD (
               MONTHS_BETWEEN (
                  TO_DATE ('".$tglcari."', 'YYYYMM'),
                  TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
               ),
               DECODE (a.kdcarabayar,
                       '1',
                       1,
                       'M',
                       1,
                       '2',
                       3,
                       'Q',
                       3,
                       '3',
                       6,
                       'H',
                       6,
                       '4',
                       12,
                       'A',
                       12,
                       'E',
                       12,
                       'J',
                       12)
            ) = 0";

			 //echo $sql."<br/>";

$sqlx = "SELECT   nopol,prefixpertanggungan,nopertanggungan,
         prefixpertanggungan || nopertanggungan nopolis,
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
		 (SELECT TO_CHAR(MAX (tglbooked),'DD/MM/YYYY') FROM $DBUser.tabel_300_historis_premi hpl WHERE hpl.prefixpertanggungan=a.prefixpertanggungan AND hpl.nopertanggungan=a.nopertanggungan AND not(hpl.tglseatled is null)) lunas,
       (SELECT alamattagih01||' '||alamattagih02
          FROM $DBUser.tabel_100_klien kli
         WHERE kli.noklien = a.notertanggung) ALAMAT,
		(SELECT namakotamadya
          FROM $DBUser.tabel_100_klien kli, $DBUser.TABEL_109_KOTAMADYA ktm
         WHERE kli.noklien = a.notertanggung and kdkotamadyatagih=kdkotamadya) KOTA,
		 TO_CHAR(a.TGLAKHIRPREMI,'DD/MM/YYYY') TGLAKHIRPREMI
  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
 WHERE   a.nopenagih=p.nopenagih
 	     --and a.nopenagih='$nopenagih'
         /*AND p.KDRAYONPENAGIH='$kdkantor'*/
		 AND a.kdpertanggungan = '2'
         AND a.kdstatusfile = '1'
         AND a.kdcarabayar <> 'X'
		 and a.TGLAKHIRPREMI >= TO_DATE ('".$tglcari."', 'YYYYMM')
		 AND SUBSTR(a.kdproduk,1,3) in ('JL2','JL3','JL4')
		 /*AND a.kdvaluta='$kdvaluta' ".$cara."*/
         AND MOD (
               MONTHS_BETWEEN (
                  TO_DATE ('".$tglcari."', 'YYYYMM'),
                  TO_DATE (TO_CHAR ( (a.mulas), 'MM/YYYY'), 'MM/YYYY')
               ),
               DECODE (a.kdcarabayar,
                       '1',
                       1,
                       'M',
                       1,
                       '2',
                       3,
                       'Q',
                       3,
                       '3',
                       6,
                       'H',
                       6,
                       '4',
                       12,
                       'A',
                       12,
                       'E',
                       12,
                       'J',
                       12)
            ) = 0";
							 
							 
if ($kantor == 'KP'){
	$sql = $sqlx;
}
			 
?><br>
<a class="myButton" href="#" onClick="window.open('./cetakjatuhtempoall_new.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		CETAK JATUH TEMPO PREMI</a>&nbsp;<a class="myButton" href="#" onClick="window.open('./jatuh_tempo_premi_link_dl.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
		DOWNLOAD JATUH TEMPO PREMI</a><button class="myButton" id="btnCetak" name="btnCetak">
		CETAK JATUH TEMPO PREMI SEBAGIAN</button>
		<button class="myButton" id="btnInfoCB" name="btnInfoCB">
		INFO CB</button>
		<br>
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
        <td><b>Lunas Per</b></td>
		<td><b>Akhir Bayar</b></td>
        <td><b>Alamat</b></td>
        <td><b>Kota</b></td>    
        <td><b>Cetak (*)</b></td>       
		<!--td colspan="2"><b>Action</b></td-->
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
        <td><?=$row["LUNAS"];?></td>
		<td><?=$row["TGLAKHIRPREMI"];?></td>
        <td><?=$row["ALAMAT"];?></td>
        <td><?=$row["KOTA"];?></td>
        <td><input type="checkbox" id="cetak" name="cetak" value="<?=$row["NOPOLIS"]?><?=$tglcari?>"></td>
        

        <!--td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempo_newest.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglcari=".$tglcari."&link=Y','polisinfo',815,600,'yes');\">cetak</a>";?></td-->
        <td><? //"<a href=\"javascript:NewWindow('../pelaporan/cetakinfocb.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">Info CB</a>";?>
        <!--a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf'>Info CB</a-->
        </td>
		
	</tr>
	<? 
	$i++;

	}
	?>
	
</table>

<p align="justify">
<b>(*) Untuk mendownload PDF, ceklist data yang ingin di download kemudian klik tombol CETAK JATUH TEMPO PREMI SEBAGIAN</b>
</p>

<br />


</form>
<?
}
?>
<a href="../mnupenagihan.php"><font face="Verdana" size="2">Menu Penagihan</a>
</body>
</html>


<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
<script type="text/javascript">
	
	$(document).ready(function() {
		
        $("#btnCetak").click(function(){
			
            var prefixpertanggungan = [];
			var nopertanggungan = [];
			var tglcari = [];
            $.each($("input[name='cetak']:checked"), function(){            
				prefixpertanggungan.push($(this).val().substring(0,2));
				nopertanggungan.push($(this).val().substring(2,11));
				tglcari.push($(this).val().substring(11,17));
				
            });
			
			for (i=0; i< nopertanggungan.length; i++)
			{	
				
				window.open('http://192.168.2.23/jiwasraya/pelaporan/cetakjatuhtempo_newest.php?prefixpertanggungan='+prefixpertanggungan[i]+'&nopertanggungan='+nopertanggungan[i]+'&tglcari='+tglcari[i]+'&link=Y','_blank');
				
				
			}
			
        });
			
		$("#btnInfoCB").click(function(){

			window.open('http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf');

		});
			
    });
	
	
</script>