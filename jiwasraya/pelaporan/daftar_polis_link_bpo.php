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
<title>Daftar Polis BPO</title>
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
<b><font size="3">Daftar Polis BPO</font></b><br>


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
			Produk
			<select name="kdproduk">
			
			<option value="JL3" <? if ($kprod=='JL3'){ echo "selected";} else {echo "";}?>>JL3</option>
			<option value="JL4" <? if ($kprod=='JL4'){ echo "selected";} else {echo "";}?>>JL4</option>
			</select>
			
			Kriteria BPO
			<select name="kriteriaBPO">
			<option value="BPO" <? if ($krite=='BPO'){ echo "selected";} else {echo "";}?>>Status BPO Baru</option>
			<option value="BPO2" <? if ($krite=='BPO2'){ echo "selected";} else {echo "";}?>>BPO >= 2 tahun</option>
			<option value="BPO3" <? if ($krite=='BPO3'){ echo "selected";} else {echo "";}?>>BPO >= 3 tahun</option>
			</select>
			
  <? 

			?>
</select>
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
if ($submit)
{
	//set kd produk
	if($_POST["kdproduk"]== 'JL3') { $kdProduk = "'JL2','JL3'";}
	elseif($_POST["kdproduk"] == 'JL4') { $kdProduk = "'JL4'"; }
	
	$krite = $_POST["kriteriaBPO"];
	
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
			 (select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) agenpenutup,
		   (select no_ponsel from $DBUser.tabel_100_klien where noklien=a.noagen) tlpagenpenutup,
			 to_date(A.TGLBPO,'yyyy/mm/dd') TGLBPO,
			 to_date(sysdate,'yyyy/mm/dd') TGLSEKARANG
	  FROM   $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih p
	 WHERE   a.nopenagih=p.nopenagih
			 --and a.nopenagih='$nopenagih'
			 AND p.KDRAYONPENAGIH='$kdkantor'
			 AND a.kdpertanggungan = '2'
			 AND a.kdstatusfile = '4'
			 AND a.kdcarabayar <> 'X'
			 AND SUBSTR(a.kdproduk,1,3) in (" .$kdProduk. ")
			 AND a.kdvaluta='$kdvaluta' ".$cara;
			
	?><br>
	
	<? //echo $krite ." ". $sql; ?>
	
	<a class="myButton" href="#" onClick="window.open('./cetakjatuhtempoall.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
			CETAK JATUH TEMPO PREMI</a>&nbsp;<a class="myButton" href="#" onClick="window.open('./jatuh_tempo_premi_link_dl.php?tglcari=<?=$tglcari;?>&kdvaluta=<?=$kdvaluta;?>&carabayar=<?=$carabayar;?>&kdkantor=<?=$kdkantor;?>&prefix=<?=$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];?>','','width=800,height=600,top=100,left=100,scrollbars=yes');">
			DOWNLOAD JATUH TEMPO PREMI</a><br>
	<b>Daftar Polis BPO</b>
	<table border="0" cellspacing="1" style="border-collapse: collapse" width="100%" id="table1" cellpadding="4" bordercolor="#B3CFFF">
		<tr bgcolor="#b1c8ed">
			<td><b>No</b></td>
			<td><b>No. Polis</b></td>
			<td><b>Pemegang Polis</b></td>
			<td><b>Produk</b></td>
			<td><b>Mulas</b></td>
			<td><b>Premi</b></td>		
			<td><b>Jt. Tempo</b></td>
			<td bgcolor="#89acd8" align="center">Agen Penutup</td>
	<td bgcolor="#89acd8" align="center">Tlp. Agen Penutup</td>
			<td><b>Alamat</b></td>
			<td><b>Kota</b></td>
			<td colspan="2"><b>Action</b></td>
		</tr>
		<?
		$DB->parse($sql);
		$DB->execute();
		
		$i=1;
		while ($row=$DB->nextrow()) 
		{
			echo ($i%2)? "<tr>" : "<tr bgcolor=#e4e4e4>";	
			
			if($krite == "BPO")
			{
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
					<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA"><?=$row["AGENPENUTUP"];?></td>
	<td style="border-left-width: 1; border-right-width: 1; border-top: 1px solid #D8E1FA; border-bottom: 1px solid #D8E1FA" align="center"><?=$row["TLPAGENPENUTUP"];?></td>
					<td><?=$row["ALAMAT"];?></td>
					<td><?=$row["KOTA"];?></td>
					<td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempoBPO.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">cetak</a>";?></td>
					<td><? ?>
					<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf'>Info CB</a>
					</td>
					
				</tr>
				<?
			}
			elseif($krite == "BPO2")
			{
				//cari jarak antara tgl sekarang dan tgl BPO				
				$date1=date($row["TGLSEKARANG"]);
				$date2=date($row["TGLBPO"]);
				
				$date_diff=strtotime($date2)-strtotime($date1);
				
				if ($date_diff >= 2)
				{
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
						<td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempoBPO23.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">cetak</a>";?></td>
						<td><? ?>
						<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf'>Info CB</a>
						</td>
						
					</tr>
					<?
				}
			}
			elseif($krite == "BPO3")
			{
				//cari jarak antara tgl sekarang dan tgl BPO			
				$date1=date($row["TGLSEKARANG"]);
				$date2=date($row["TGLBPO"]);
				
				$date_diff=strtotime($date2)-strtotime($date1);
				
				if ($date_diff >= 3)
				{
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
						<td><?="<a href=\"javascript:NewWindow('../pelaporan/cetakjatuhtempoBPO23.php?prefixpertanggungan=".$row["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$row["NOPERTANGGUNGAN"]."&tglexp=".$row["TGLEXP"]."','polisinfo',815,600,'yes');\">cetak</a>";?></td>
						<td><? ?>
						<a href='http://192.168.2.23/jiwasraya/file/download/dl.php?act=dl&file=KONFIRMASI_CB.pdf'>Info CB</a>
						</td>
						
					</tr>
					<?
				}
			}
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