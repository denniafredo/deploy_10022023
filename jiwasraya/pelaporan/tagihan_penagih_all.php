<?
	include "../../includes/session.php";
  include "../../includes/common.php";
  include "../../includes/database.php";
	include "../../includes/dropdown_date.php";
	
	$DB=new database($userid, $passwd, $DBName);
	
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

td{
 font-family: tahoma,verdana,geneva,sans-serif;
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

-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
<script language="JavaScript">
	 function GantiCari1(theForm) {
			var np=theForm.nopenagih.value;
			var kt=theForm.kdkantor.value;
      window.location.replace('tagihan_penagih_all.php?nopenagih='+np+'&kdkantor='+kt+'#awaledit');
   }
</script>
<script language="JavaScript">
	 function GantiCari(theForm) {
			var np=theForm.nopenagih.value;
			var kt=theForm.kdkantor.value;
      window.location.replace('tagihan_penagih_all.php?nopenagih='+np+'&kdkantor='+kt+'#awaledit');
   }
</script>
</head>
<body topmargin="10">
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
			<form action="<?=$PHP_SELF;?>" name="cariwaktu" method="post">
			Kantor : 
			<select name="kdkantor" onchange="GantiCari1(document.cariwaktu)">
			<option value="">-- pilih kantor --</option>
			<?
			$sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor='2' ".
			     		 "order by kdkantor";
					$DB->parse($sqa);
					$DB->execute();	
					while ($arr=$DB->nextrow()) {
					  echo "<option ";
    					if ($arr["KDKANTOR"]==$kdkantor){ echo " selected"; }
    					echo " value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>";
					}
			?>
			</select>
			<br />
			Penagih
			<select name="nopenagih" onchange="GantiCari(document.cariwaktu)">
			<option value="">-- pilih --</option>
			<? 
			$pskg = ($skg=='1') ? "and a.penagihskg='1' " : "and nvl(a.penagihskg,'0')='0' ";
			$sql	= "select a.nopenagih, b.namaklien1,a.prefixpenagih,b.gelar,a.kdrayonpenagih ".
      			 	"from  $DBUser.tabel_100_klien b, $DBUser.tabel_500_penagih a ".
      	     	"where a.nopenagih=b.noklien and a.kdstatuspenagih='03' and a.kdrayonpenagih='".$kdkantor."' ".
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
			}
			?>
			</select>		
			
			Group Tagihan 
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
			</select>		
			
			Jenis Kuitansi 
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
			</select>		
			
			Status 
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
			</select>		
			
			Proses Tgl. <? ShowFromDate(10,"Past"); ?>
			<input type="submit" name="cari" value="SUBMIT" />
			</form>
		  <hr size="1">
			
<? 
if(isset($cari))
{
?>			
			<table border="0" width="100%" cellspacing="1" cellpadding="2">
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
					<td>Status</td>
				</tr>				
			<?
			if(isset($_POST['month']))
			{
			$tglprocess = $_POST['year'].$_POST['month'].$_POST['day'];
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
				
				
			
  		$sql =	"SELECT  a.prefixpertanggungan, 
                  a.nopertanggungan,b.tagihan, 
                  b.nopol,b.kdvaluta,
                  (SELECT namaklien1 FROM $DBUser.tabel_100_klien WHERE noklien = b.nopemegangpolis) AS pemegangpolis,
                  (SELECT namacarabayar FROM $DBUser.tabel_305_cara_bayar WHERE kdcarabayar = b.kdcarabayar) AS carabayar,
                  decode(b.kdvaluta,'0','RPI','1','RP','3','USD','NONE') as notasi,
                  TO_CHAR (a.tglbooked, 'MM/YYYY') tglbooked,
									decode(b.kdvaluta,'0',a.premitagihan/b.indexawal,a.premitagihan) as premitagihan,
                  TO_CHAR (c.tglseatled, 'DD/MM/YYYY') tglseatled,
                  TO_CHAR (c.tglbayar, 'DD/MM/YYYY') tglbayar,
                  b.indexawal, 
                  a.kdrekeninglawan AS kdrekening,
                  decode(a.status,'0','B','1','S','?') as status,
                  b.nopenagih  
              FROM     
							    $DBUser.tabel_300_historis_premi c,
                  $DBUser.tabel_300_bontagihan a,
                  $DBUser.tabel_200_pertanggungan b 
              WHERE     a.prefixpertanggungan = c.prefixpertanggungan AND 
                  a.nopertanggungan = c.nopertanggungan and 
                  a.tglbooked=c.tglbooked and  
                  a.prefixpertanggungan = b.prefixpertanggungan AND 
                  a.nopertanggungan = b.nopertanggungan AND 
                  a.nopenagih = '$nopenagih' AND 
                  a.tglbooked <= TRUNC (SYSDATE) 
                  $filtertgl 
									$filtergrp 
									$filterkdk 
									$filterstt 
              ORDER BY b.kdvaluta,b.kdcarabayar";
			//echo $sql;
		  
			$DB->parse($sql);
      $DB->execute();
      $i=1;
			$jrpi = 0;
			$jrp  = 0;
			$jusd  = 0;
			while ($arr=$DB->nextrow())
  		{
			   if($arr["KDVALUTA"]=="0")
				 {
				   $premirpi = round($arr["PREMITAGIHAN"],2);
					 $jmlpremirpi += $premirpi;
					 $jrpi ++;
				 }
				 elseif($arr["KDVALUTA"]=="1")
				 {
				   $premirp = round($arr["PREMITAGIHAN"],2);
					 $jmlpremirp += $premirp;
					 $jrp ++;
				 }
				 elseif($arr["KDVALUTA"]=="3")
				 {
				   $premiusd = round($arr["PREMITAGIHAN"],2);
					 $jmlpremiusd += $premiusd;
					 $jusd ++;
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
				 echo "<td>".$arr["KDREKENING"]."</td>";
      	 echo "<td>".($arr["TGLSEATLED"]=="" ? "<font color=#ee0000>B</font>" : "S")."</td>";
         echo "</tr>";
         $i++; 
				 
      }		
			
			}
      ?>				
			  <tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah Indeks</td>
					<td align="right"><?=$jrpi;?></td>
					<td align="right"><?=number_format($jmlpremirpi,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>		
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Rupiah</td>
					<td align="right"><?=$jrp;?></td>
					<td align="right"><?=number_format($jmlpremirp,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>	
				<tr bgcolor="#dedede">
					<td height="20" colspan="6" align="right">Jumlah Dolar</td>
					<td align="right"><?=$jusd;?></td>
					<td align="right"><?=number_format($jmlpremiusd,2,",",".");?></td>
					<td colspan="4"></td>
				</tr>				
      </table>			
			
			<hr size="1">
      <?//="<a href=# onclick=\"NewWindow('tagihan_penagih_cetak.php?tglprocess=".$tglprocess."&nopenagih=".$nopenagih."&kdgroup=".$kdgroup."&kdkuitansi=".$kdkuitansi."','',900,500,1)\"><img src=../img/cetak.gif align=absmiddle border=0> Cetak</a>";?>
			 
<? 
}
?>

						
</body>
</html>