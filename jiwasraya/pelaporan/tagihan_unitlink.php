<?
include "../../includes/session.php";
include "../../includes/common.php";
include "../../includes/database.php";
include "../../includes/dropdown_date1.php";
include "../../includes/klien.php";
	include "../../includes/kantor.php";
	$DB=new database($userid, $passwd, $DBName);
	$DB1=new database($userid, $passwd, $DBName);
	$DB2=new database($userid, $passwd, $DBName);
	$KL=new Klien($userid,$passwd,$nopenagih);
	$KTR=new Kantor($userid,$passwd,$kantor);
?>

<html>

<head>
<title>Sisa Tagihan</title>
<style type="text/css">
<!-- 
body{
 font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 12px;
}

td{ font-family: tahoma,verdana,geneva,sans-serif;
 font-size: 11px;
} 


form{
padding:0px;
margin:0px;
}
input			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-width: .2em;border-width: .2em;color:333333;}
select			{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}
textarea		{font-family:tahoma,verdana,geneva,sans-serif; font-size: 11px; border-style: groove; border-width: .2em;}

a { 
  color:#259dc5;  
	text-decoration:none;
}

a:hover { 
	color:#cc6600;  
}

h4{
padding: 0 0 5px 0;
margin:0;
}

.jarak {
clear:both;
height:1px;
}
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript">
	 function GantiCari(theForm) {
			var bo=theForm.bo.value;
      window.location.replace('tagihan_unitlink.php?bo='+bo+'#awaledit');
   }
    function cariThnProses(theForm) {
			var bo=theForm.bo.value;
			var year=theForm.year.value;
      window.location.replace('tagihan_unitlink.php?bo='+bo+'&tahun='+year+'#awaledit');
   }
    function cariTglProses(theForm) {
			var bo=theForm.bo.value;
			var year=theForm.year.value;			
			var month=theForm.month.value;
      window.location.replace('tagihan_unitlink.php?bo='+bo+'&tahun='+year+'&bulan='+month+'#awaledit');
   }
</script>
</head>

<? 
	if(!isset($mode)){
	?>
<body topmargin="10">
<? 
} else {
 ?>
 <body><!-- onload="window.print();window.close()">-->
<? 
}
 ?>
 
      <? 
			if($kdgroup=="all")
			{
			?>
      <h4>DAFTAR TAGIHAN PREMI PENAGIH</h4>
			<? 
			}
			else
			{
			?>
      <h4>DAFTAR BON KUITANSI PREMI PER PENAGIH</h4>
			<? 
			}
			 ?>
			 
	<? 
	if(!isset($mode)){
	?>
			 
	<form action="<?=$PHP_SELF;?>" name="cariwaktu" method="post">
<table>			
<tr>
<td>			
			Kantor</td>
<td>
<? 
if($kantor=="KP" && $bo!=""){
				$rayon=$bo;
				}else{
				$rayon=$kantor;
				}
				
$sqls	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih 
			 		   from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a where a.nopenagih=b.noklien and
					   a.kdstatuspenagih='03' and a.kdrayonpenagih='".$rayon."' and namaklien1 like '%UNITLINK%'";
				//echo $sqls."<>";	   
			$DB1->parse($sqls);
      $DB1->execute();
	  //echo $bo;
			$arrr=$DB1->nextrow();
			$penagih=$arrr["NOPENAGIH"];
 			//echo $penagih2;
echo "<input type=hidden name=penagih value=".$penagih.">";
if($kantor=="KP"){
?>
<select name="bo" onChange="GantiCari(document.cariwaktu)">
  <option value="">-- pilih --</option>
  <? 	
			
			$sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' order by kdkantor ASC";
			/*$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kantor."' ".
      				 $pskg." ".
							 //"and nvl(a.penagihautodebet,'0')='0' ".
      				 " order by b.namaklien1";*/
			$DB->parse($sql);
      $DB->execute();
	  //echo $bo;
			while ($bc=$DB->nextrow())
  		{
			  
  			if ($bo==$bc["KDKANTOR"]){ 
			echo "<option value=".$bc["KDKANTOR"]." selected>".$bc["KDKANTOR"]." - ".$bc["NAMAKANTOR"]."</option>";
			}
  			echo "<option value=".$bc["KDKANTOR"].">".$bc["KDKANTOR"]." - ".$bc["NAMAKANTOR"]."</option>";
			}
			?>
</select>
<? }else{ 
$sql="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdkantor='$kantor'";
			$DB->parse($sql);
      $DB->execute();
	  $bo=$DB->nextrow();
	  echo "<input type=hidden name=bo value=".$kantor.">";
	  echo $bo["NAMAKANTOR"];
}
?></td>

<td>			
			Group Tagihan</td>
<td>
			<select name="kdgroup">
			<option value="all">-- All --</option>
			<? 
			$sql	= "select distinct nvl(tagihan,0) as tagihan from $DBUser.tabel_200_pertanggungan ".
							"where nopenagih='".$nopenagih."' ";
			$DB->parse($sql);
      $DB->execute();
			while ($rot=$DB->nextrow())
  		{
			  $dijit = strlen($rot["TAGIHAN"]);
			  $namatagihan = $rot["TAGIHAN"]=="0" ? "*" : $rot["TAGIHAN"];
			  echo "<option ";
  			if ($kdgroup==$rot["TAGIHAN"]){ echo " selected"; }
  			echo " value=".$rot["TAGIHAN"].">".$namatagihan."</option>";
			}
			?>
			</select></td>

<td>			
			Jenis Kuitansi</td>
<td>
			<select name="kdkuitansi">
			<? 
			if($kdkuitansi=="NB"){
			  $vnb = "selected";
			} elseif($kdkuitansi=="OB") {
			  $vob = "selected";
			}
			?>
			<option value="all">--All--</option>
			<option value="NB" <?=$vnb;?>>NB</option>
			<option value="OB" <?=$vob;?>>OB</option>
			</select></td>
<tr>

<td>
			Jenis Valuta</td>
<td>
			<select name="kdvaluta">
			<? 
			if($kdvaluta=="0"){
			  $v0 = "selected";
			} elseif($kdvaluta=="1") {
			  $v1 = "selected";
			} elseif($kdvaluta=="3") {
			  $v3 = "selected";
			}
			?>
			<option value="all">--All--</option>
			<option value="0" <?=$v0;?>>Rupiah Dengan Index (RPI)</option>
			<option value="1" <?=$v1;?>>Rupiah Tanpa Index (RP)</option>
			<option value="3" <?=$v3;?>>Dollar Amerika (USD)</option>
			</select></td>

<td>			
			Status</td>
<td>
			<select name="kdstatus">
			<? 
			if($kdstatus=="S"){
			  $vs = "selected";
			} elseif($kdstatus=="B") {
			  $vb = "selected";
			}
			?>
			<option value="all">--All--</option>
			<option value="S" <?=$vs;?>>Lunas</option>
			<option value="B" <?=$vb;?>>Belum Lunas</option>
			</select></td>

<td>			
			Proses Tgl.</td>
<td>			 
			<? ShowFromDate(10,"Past",$bulan,$tahun,$day);
			
			if($tahun!="" && $bulan != ""){
			//$sqlcari="select to_char(tglproses,'DD') tanggal from $DBUser.tabel_300_bontagihan where nopenagih='$nopenagih' and tglproses=to_date('$tahun','yyyy') and tglproses=to_date('$bulan','mm') group by tglproses";
			$sqlcari="select to_char(tglproses,'DD') tanggal from $DBUser.tabel_300_bontagihan where nopenagih='$penagih' and TO_CHAR(tglproses,'MMYYYY')='$bulan$tahun' group by tglproses";
			
			$DB->parse($sqlcari);
			$DB->execute();
			echo "<select name=day class=pilih9>";
			while($arrtgl=$DB->nextrow()){
			echo "<option>".$arrtgl["TANGGAL"];
			}
			echo "</select>";
			}
			 ?></td>
<input type="hidden" name="tahun" value="<?=$tahun; ?>"><input type="hidden" name="bulan" value="<?=$bulan; ?>">
<td>
			<input type="submit" name="cari" value="SUBMIT"/></td>
</tr>
</table>

</form>
		  <hr size="1">
<? 
}
else 
{
?>
<b>
		  Nama Penagih : <?=$KL->nama;?>; 
			Group Tagihan : <?=$kdgroup;?>; 
			Jenis Kuitansi : <?=$kdkuitansi;?>; 
			Jenis Valuta : <?=$kdvaluta;?>; 
			Status : <?=$kdstatus;?>;
			Tgl. Proses : <?=substr($tglprocess,-2)."/".substr($tglprocess,4,2)."/".substr($tglprocess,0,4);?>	
</b>
<div class="jarak"></div>
<? 
}
?>
		
<? 
if(isset($cari))
{
?>			
			<table border="1" style="border-collapse: collapse" width="100%" bordercolor="#666666" width="100%" cellspacing="1" cellpadding="2">
				<tr bgcolor="#7dc2d9">
					<td height="20">No</td>
					<td>No.Polis</td>
					<td>No.Lama</td>
					<td>Pemegang Polis</td>
					<td>Cara Bayar</td>
					<td>Tgl.Booked</td>
					<td>Val.</td>
					<td>Premi</td>
					<td>Tgl.Seatled</td>
					<td>Tgl.Bayar</td>
					<td>Kd.Rek.</td>
					<td>Group Tag.</td>
				</tr>				
			<?
			if(isset($_POST['month']) || isset($tglprocess))
			{
			
			if(!isset($tglprocess))
			{
			$tglprocess = $_POST['year'].$_POST['month'].$_POST['day'];
      }
			$filtertgl = "and to_char(a.tglproses,'YYYYMMDD')='".$tglprocess."' ";

  			if($kdgroup=="all")
  			{
  			  $filtergrp = "";
  			}
  			else
  			{
  			  $filtergrp = "and nvl(b.tagihan,0)='$kdgroup' ";
  			}
				
				if($kdkuitansi=="all")
  			{
  			  $filterkdk = "";
  			}
  			else
  			{
  			  $filterkdk = "and a.kdkuitansi='$kdkuitansi' ";
  			}
				
				if($kdstatus=="all")
  			{
  			  $filterstt = "";
  			}
  			else
  			{
				  if($kdstatus=="S")
					{
  			  $filterstt = "and c.tglseatled is not null ";
					}
					else
					{
					$filterstt = "and c.tglseatled is null ";
					}
  			}
				
 			if($kdvaluta=="all")
  			{
  			  $filtervaluta = "";
  			}
  			else
  			{
  			  $filtervaluta = "and b.kdvaluta='$kdvaluta' ";
  			}
				
			
					   
				
  		$sql =	"SELECT  a.prefixpertanggungan, 
                  a.nopertanggungan,b.tagihan, 
                  b.nopol,b.kdvaluta,
                  (SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = b.nopemegangpolis) AS pemegangpolis,
                  (SELECT namacarabayar FROM $DBUser.tabel_305_cara_bayar WHERE kdcarabayar = b.kdcarabayar) AS carabayar,
                  decode(b.kdvaluta,'0','RPI','1','RP','3','USD','NONE') as notasi,
									(((TO_CHAR (a.tglbooked, 'YYYY')-1)-TO_CHAR (b.mulas, 'YYYY'))*12)+(TO_CHAR (a.tglbooked, 'MM')+12-TO_CHAR (b.mulas, 'MM')) selisih,
                  TO_CHAR (a.tglbooked, 'MM/YYYY') tglbooked,
									decode(b.kdvaluta,'0',a.premitagihan/decode(b.indexawal,0,1,b.indexawal),a.premitagihan) as premitagihan,
                  TO_CHAR (c.tglseatled, 'DD/MM/YYYY') tglseatled,
                  TO_CHAR (c.tglbayar, 'DD/MM/YYYY') tglbayar,
									TO_CHAR (c.tglbayar, 'YYYYMM') blnbayar,
									TO_CHAR (a.tglproses, 'YYYYMM') blnproses,
                  b.indexawal, 
                  a.kdrekeninglawan AS kdrekeninglawan,
				  c.kdrekeningpremi AS kdrekening,
                  decode(a.status,'0','B','1','S','?') as status,
                  b.nopenagih  
              FROM     
							    $DBUser.tabel_300_historis_premi c,
                  $DBUser.tabel_300_bontagihan a,
                  $DBUser.tabel_200_pertanggungan b 
              WHERE     a.prefixpertanggungan = c.prefixpertanggungan AND 
                  a.nopertanggungan = c.nopertanggungan and 
                  to_char(a.tglbooked,'MMYYYY') = to_char(c.tglbooked,'MMYYYY') and  
                  a.prefixpertanggungan = b.prefixpertanggungan AND 
                  a.nopertanggungan = b.nopertanggungan AND 				  
                  a.nopenagih='$penagih' and 				
				  a.tglbooked <= TRUNC (SYSDATE) 
                  					$filtertgl 
									$filtergrp 
									$filterkdk 
									$filterstt
									$filtervaluta
              ORDER BY b.kdvaluta,b.kdcarabayar,a.prefixpertanggungan,a.nopertanggungan";
			//echo $sql; //
		  
			$DB->parse($sql);
      $DB->execute();
      $i=1;
			$jrpiob = 0;
			$jrpinb = 0;
			$jrpob  = 0;
			$jrpnb  = 0;
			$jusdob  = 0;
			$jusdnb  = 0;
			while ($arr=$DB->nextrow())
  		{
			   if($arr["KDVALUTA"]=="0")
				 {
				  
				   $premirpi = round($arr["PREMITAGIHAN"],2);
					 $jmlpremirpi += $premirpi;
					 if($arr["SELISIH"]<12)
					 {
					   $premirpinb = round($arr["PREMITAGIHAN"],2);
  					 $jmlpremirpinb += $premirpinb;
						 $jrpinb ++;
					 }
					 else
					 {
  					 $premirpiob = round($arr["PREMITAGIHAN"],2);
  					 $jmlpremirpiob += $premirpiob;
						 $jrpiob ++;
					 }
					 
				 }
				 elseif($arr["KDVALUTA"]=="1")
				 {
				   $premirp = round($arr["PREMITAGIHAN"],2);
					 $jmlpremirp += $premirp;

					 if($arr["SELISIH"]<12)
					 {
					   $premirpnb = round($arr["PREMITAGIHAN"],2);
  					 $jmlpremirpnb += $premirpnb;
						 $jrpnb ++;
					 }
					 else
					 {
  					 $premirpob = round($arr["PREMITAGIHAN"],2);
  					 $jmlpremirpob += $premirpob;
						 $jrpob ++;
					 }
					 
				 }
				 elseif($arr["KDVALUTA"]=="3")
				 {
				   $premiusd = round($arr["PREMITAGIHAN"],2);
					 $jmlpremiusd += $premiusd;

					 if($arr["SELISIH"]<12)
					 {
					   $premiusdnb = round($arr["PREMITAGIHAN"],2);
  					 $jmlpremiusdnb += $premiusdnb;
						 $jusdnb ++;
					 }
					 else
					 {
  					 $premiusdob = round($arr["PREMITAGIHAN"],2);
  					 $jmlpremiusdob += $premiusdob;
						 $jusdob ++;
					 }

				 }
				 
			   echo "<tr bgcolor=#".($i % 2 ? "ffffff" : "d5e7fd").">";
      	 echo "<td>$i</td>";
         echo "<td><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>";
      	 echo "<td>".$arr["NOPOL"]."</td>";
      	 echo "<td>".$arr["PEMEGANGPOLIS"]."</td>";
				 echo "<td>".$arr["CARABAYAR"]."</td>";
				 echo "<td>".$arr["TGLBOOKED"]."</td>";
				 echo "<td>".$arr["NOTASI"]."</td>";
      	 echo "<td align=right>".number_format($arr["PREMITAGIHAN"],2,",",".")."</td>";
				 echo "<td>".$arr["TGLSEATLED"]."</td>";
				 echo "<td>".$arr["TGLBAYAR"]."</td>";
				 echo "<td>".$arr["KDREKENINGLAWAN"]."</td>";
      	 echo "<td>".$arr["TAGIHAN"]."</td>";
         //echo "<td>".($arr["TGLSEATLED"]=="" ? "<font color=#ee0000>B</font>" : "S")."</td>";
         echo "</tr>";
         $i++; 
				 
      }		
			
			}
      ?>				
			  <tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah Indeks OB</td>
					<td align="right"><?=$jrpiob;?></td>
					<td align="right"><?=number_format($jmlpremirpiob,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>		
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah Indeks NB</td>
					<td align="right"><?=$jrpinb;?></td>
					<td align="right"><?=number_format($jmlpremirpinb,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>		
				
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah OB</td>
					<td align="right"><?=$jrpob;?></td>
					<td align="right"><?=number_format($jmlpremirpob,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>	
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah NB</td>
					<td align="right"><?=$jrpnb;?></td>
					<td align="right"><?=number_format($jmlpremirpnb,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>	
				
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Dolar OB</td>
					<td align="right"><?=$jusdob;?></td>
					<td align="right"><?=number_format($jmlpremiusdob,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>			
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Dolar NB</td>
					<td align="right"><?=$jusdnb;?></td>
					<td align="right"><?=number_format($jmlpremiusdnb,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>				
      </table>			
			<? 
			if(isset($mode)){
			?>
			<br />
			<table border="0" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2">
              <tr>
							  <td colpan="3"><?=$KTR->kotamadya;?>, <?=date("d-m-Y"); ;?></td>
							</tr>
							<tr>
							  <td width="33%">Dibuat oleh,<p>&nbsp;</p>
                <p>( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ) <br>
                Pegawai Adm. Oprs.</td>
                <td width="33%">Pemeriksa,<p>&nbsp;</p>
                <p>(<?=$KTR->kasieopr;?>)<br>
                Kasi Operasional</td>
                
                <td width="34%">Yang menerima,<p>&nbsp;</p>
                <p>(<?=$KL->nama;?>)<br>
                Penagih</td>
              </tr>
            </table>
			<? 
			}
			?>
					
			<? 
			if(!isset($mode)){
			?>
  			<hr size="1">
        <?="<a href=# onclick=\"NewWindow('tagihan_unitlink.php?mode=print&cari=1&tglprocess=".$tglprocess."&nopenagih=".$nopenagih."&kdgroup=".$kdgroup."&kdstatus=".$kdstatus."&kdkuitansi=".$kdkuitansi."&kdvaluta=".$kdvaluta."','',900,500,1)\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak</a>";?>
  			<?//="<a href=# onclick=\"NewWindow('tagihan_unitlink_cetak.php?tglprocess=".$tglprocess."&nopenagih=".$nopenagih."&kdgroup=".$kdgroup."&kdstatus=".$kdstatus."&kdkuitansi=".$kdkuitansi."','',900,500,1)\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak</a>";?>
  			 | 
			<? 
			}
			?>
			
<? 
}
?>
<? 
			if(!isset($mode)){
			?>
			<a href="../mnupenagihan.php">Menu Sistem Penagihan</a>
			<? } ?>		
</body>
</html>