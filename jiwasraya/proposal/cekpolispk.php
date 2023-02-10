<?
	include "../../includes/database.php";
	include "../../includes/session.php";
 	include "../../includes/klien.php";
	$DB=New Database("PKADM","PK412M","GLINDO");
?>

<html>
<head>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
</head>

<font face="Verdana" size="3"><b><center>Informasi Polis Pertanggungan Kumpulan</center></b></font>
<hr size=1>
<table border="0" width="100%" cellspacing="3" cellpadding="1" class="tblisi">
<form name="porm" method="post" action="<?echo $PHP_SELF;?>">
<input type="hidden" name="mbah" value="<?echo $mbah;?>">
	<tr>
		<td class="verdana10blk" width="30%">Nomor Polis Baru	:
	<input type="text" name="no_polis" class="c" size="10" maxlength="10" onBlur="validasi10x(this.form.no_polis)"  onfocus="highlight(event);document.porm.nopol.value=''"  value="<?echo $no_polis;?>">
	<a onClick="NewWindow('pilihpolispk.php','name',800,300,1)"><img src="../img/jswindow.gif" border="0" alt="cari nomor polis"></a>		</td>
	  	<td align="left"><? echo "<input type=\"submit\" value=\"Submit\" name=\"cek_pol\">";?></td>
	</tr>
</form>
</table>

<? 
if ($cek_pol) 
{
	$sql="SELECT NOKONTRAK,KONTRAKLAMA,KDKANTOR,NOCUSTOMER,TGLKONTRAK,
			CASE KDKONTRAK WHEN '0' THEN 'NONDEFINITIF' WHEN '1' THEN 'DEFINITIF' ELSE 'BATAL' END KDKONTRAK,
			NAMATERTANGGUNG,NAMAPEMEGANGPOLIS,
			(SELECT NAMACARABAYAR FROM CARA_BAYAR WHERE KDCARABAYAR=a.KDCARABAYAR)CARABAYAR,
			(SELECT NAMAVALUTA FROM VALUTA WHERE KDVALUTA=a.KDVALUTA)VALUTA,
			NOAGEN,
			CASE METODEMASA WHEN '0' THEN 'MASA TETAP' WHEN '1' THEN 'SAMPAI USIA' ELSE 'GIVEN' END METODEMASA,
			(SELECT NAMAPRODUK FROM PRODUK WHERE KDPRODUK=a.KDPRODUK)PRODUK
		  FROM   pkadm.kontrak a
		  WHERE   nokontrak = '$no_polis'";	
	//echo $sql;	
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();		 			 			      	 	 				 		 	
?>

<hr size=1>
<div align="center">
<table border="0" cellpadding="1" cellspacing="1" class="tblborder">
	<tr>
		<td>
			<table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
				<tr class="tblhead">
    				<td colspan="4" align="center" class="arial12whtb">
      					<b>POLIS NO : <? echo $arr['NOKONTRAK']." / ".$arr['KONTRAKLAMA']; ?></b>    				</td>
					<td class="arial12whtb" colspan="2">RAYON :  <? echo $arr['KDKANTOR']; ?></td>
 				</tr>
   				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk">No Kontrak</td>
				    <td class="verdana8blk">:  </td>
					<td class="verdana8blk">
	<a href="#" onClick="NewWindow('infoklien.php?noklien=<?=$PER->notertanggung; ?>','updclnt',800,200,1);"><? echo $arr['NOKONTRAK']; ?></a></td>
					<td class="verdana8blk">No Customer</td>
    				<td class="verdana8blk">:</td>
					<td class="verdana8blk"><? echo $arr['NOCUSTOMER']; ?></td>
  				</tr>	 
  				<tr>
    				<td class="verdana8blk">Tgl Mulai</td>
    				<td class="verdana8blk">: </td>
					<td class="verdana8blk"> <? echo $arr['TGLKONTRAK']; ?></td>
    				<td class="verdana8blk">Status Polis</td>
    				<td class="verdana8blk">: </td>
					<td class="verdana8blk"> <? echo $arr['KDKONTRAK']; ?></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk">Tertanggung</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMATERTANGGUNG']; ?></td>
    				<td class="verdana8blk">Pemegang Polis</td>
    				<td class="verdana8blk">: </td>
					<td class="verdana8blk"><? echo $arr['NAMAPEMEGANGPOLIS']; ?></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk">Cara Bayar</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['CARABAYAR']; ?></td>
    				<td class="verdana8blk">Valuta</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['VALUTA']; ?></td>
  				</tr>
	 			<tr>
    				<td class="verdana8blk">Metode Masa</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['METODEMASA']; ?></td>
    				<td class="verdana8blk">No Agen</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NOAGEN']; ?></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk">Nama Produk</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['PRODUK']; ?></td>    
  				</tr>
  				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr> 
  				<tr>
    				<td class="verdana8blk" colspan="6"><b>BENEFIT</b></td>       
  				</tr> 
  				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
<?
	$sql="SELECT (SELECT NAMABENEFIT FROM BENEFIT WHERE KDBENEFIT=a.KDBENEFIT)NAMABENEFIT
		  FROM   pkadm.produk_benefit a, kontrak b
	 	  WHERE   b.nokontrak = '$no_polis' and a.kdproduk=b.kdproduk";	
	//echo $sql;	
	$DB->parse($sql);
	$DB->execute();
	while ($arr=$DB->nextrow()) {		 			 			      	 	 				 		 	
 ?>
  				<tr>
    				<td class="verdana8blk" colspan="6"><? echo $arr['NAMABENEFIT']; ?></td>       
 	 			</tr>
<? } ?> 
			 	<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk" colspan="6"><b>TARIF</b></td>       
  				</tr> 
  				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
<?
	$sql="SELECT KDTARIFPREMI,(SELECT NAMATARIF FROM KODE_TARIF WHERE KDTARIF=a.KDTARIFPREMI)NAMATARIFPREMI,
	  		 KDTARIFTEBUS,(SELECT NAMATARIF FROM KODE_TARIF WHERE KDTARIF=a.KDTARIFTEBUS)NAMATARIFTEBUS,
			 KDTARIFKOMISI,(SELECT NAMATARIF FROM KODE_TARIF WHERE KDTARIF=a.KDTARIFKOMISI)NAMATARIFKOMISI
		 FROM   pkadm.kontrak_tarif a
		 WHERE   a.nokontrak = '$no_polis' ";	
//	echo $sql;	
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();		 			 			      	 	 				 		 	
?>
 				<tr>
    				<td class="verdana8blk">Kd Tarif Premi</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['KDTARIFPREMI']; ?></td>    
    				<td class="verdana8blk">Nama Tarif Premi </td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMATARIFPREMI']; ?></td>    
  				</tr>
  				<tr>
    				<td class="verdana8blk">Kd Tarif Tebus</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['KDTARIFTEBUS']; ?></td>    
    				<td class="verdana8blk">Nama Tarif Tebus </td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMATARIFTEBUS']; ?></td>    
  				</tr>
  				<tr>
    				<td class="verdana8blk">Kd Tarif Komisi</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['KDTARIFKOMISI']; ?></td>    
    				<td class="verdana8blk">Nama Tarif Komisi </td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMATARIFKOMISI']; ?></td>    
  				</tr>
  				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk" colspan="6"><b>BASIS</b></td>       
  				</tr> 
  				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
<?
	$sql="SELECT KDBASISPREMI,(SELECT NAMABASIS FROM BASIS WHERE KDBASIS=a.KDBASISPREMI)NAMABASISPREMI,
	   		 KDBASISTEBUS,(SELECT NAMABASIS FROM BASIS WHERE KDBASIS=a.KDBASISTEBUS)NAMABASISTEBUS,
			 KDBASISKOMISI,(SELECT NAMABASIS FROM BASIS WHERE KDBASIS=a.KDBASISKOMISI)NAMABASISKOMISI
		  FROM   pkadm.kontrak_basis a
		  WHERE   a.nokontrak = '$no_polis' ";	
	//echo $sql;	
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();		 			 			      	 	 				 		 	
?>
  				<tr>
    				<td class="verdana8blk">Kd Basis Premi</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['KDBASISPREMI']; ?></td>    
    				<td class="verdana8blk">Nama Basis Premi </td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMABASISPREMI']; ?></td>    
  				</tr>
		  		<tr>
    				<td class="verdana8blk">Kd Basis Tebus</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['KDBASISTEBUS']; ?></td>    
    				<td class="verdana8blk">Nama Basis Tebus </td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMABASISTEBUS']; ?></td>    
  				</tr>
  				<tr>
    				<td class="verdana8blk">Kd Basis Komisi</td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['KDBASISKOMISI']; ?></td>    
    				<td class="verdana8blk">Nama Basis Komisi </td>
    				<td class="verdana8blk">:  </td>
					<td class="verdana8blk"><? echo $arr['NAMABASISKOMISI']; ?></td>    
  				</tr>
    			<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
  				<tr>
    				<td class="verdana8blk" colspan="6"><b>PESERTA</b></td>       
  				</tr> 
    			<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
				<tr>
				<?
					$sql="select count(b.nopeserta) peserta
						  from pkadm.kontrak_peserta a, peserta b
						  where a.nokontrak='$no_polis' 
		   					and a.nuke='001' and a.nopeserta=b.nopeserta";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
    				<td class="verdana8blk">Jumlah Peserta</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk" colspan="4">
					<a href="#" onclick="NewWindow('cekpolispkpeserta.php?nokontrak=<?=$no_polis;?>','',780,400,1)">
		  <?=$arr["PESERTA"]."</a>";?></td>
				</tr>
				<?
					$sql="select sum(a.nilaipremi)premi,sum(nilaibenefit)jua
						  from pkadm.benefit_peserta a
						  where a.nokontrak='$no_polis' and jenisbenefit in ('1','B')";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
				<tr>
    				<td class="verdana8blk">JUA</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['JUA'], 2, ',', '.') ?></td>
    				<td class="verdana8blk">Premi</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['PREMI'], 2, ',', '.') ?></td>
				</tr>
    			<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
				<tr>
				<?
					$sql="select count(b.nopeserta) peserta
						  from pkadm.kontrak_peserta a, peserta b
						  where a.nokontrak='$no_polis' 
		   					and a.nuke='001' and a.nopeserta=b.nopeserta and b.status='1'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
    				<td class="verdana8blk">Jumlah Peserta Aktif</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk" colspan="4">
					<a href="#" onclick="NewWindow('cekpolispkpesertaaktif.php?nokontrak=<?=$no_polis;?>','',780,400,1)">
		  <?=$arr["PESERTA"]."</a>";?></td>
				</tr>
				<?
					$sql="select sum(a.nilaipremi)premi,sum(nilaibenefit)jua
						  from pkadm.benefit_peserta a, peserta b
						  where a.nokontrak='$no_polis' and jenisbenefit in ('1','B') 
						  	and a.nopeserta=b.nopeserta and b.status='1'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
				<tr>
    				<td class="verdana8blk">JUA</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['JUA'], 2, ',', '.') ?></td>
    				<td class="verdana8blk">Premi</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['PREMI'], 2, ',', '.') ?></td>
				</tr>
				<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
				<tr>
				<?
					$sql="select count(b.nopeserta) peserta
						  from pkadm.kontrak_peserta a, peserta b
						  where a.nokontrak='$no_polis' 
		   					and a.nuke='001' and a.nopeserta=b.nopeserta and b.status='2'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
    				<td class="verdana8blk">Jumlah Peserta Klaim</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk" colspan="4">
					<a href="#" onclick="NewWindow('cekpolispkpesertaklaim.php?nokontrak=<?=$no_polis;?>','',780,400,1)">
		  <?=$arr["PESERTA"]."</a>";?></td>
				</tr>
				<?
					$sql="select sum(a.nilaipremi)premi,sum(nilaibenefit)jua
						  from pkadm.benefit_peserta a, peserta b
						  where a.nokontrak='$no_polis' and jenisbenefit in ('1','B') 
						  	and a.nopeserta=b.nopeserta and b.status='2'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
				<tr>
    				<td class="verdana8blk">JUA</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['JUA'], 2, ',', '.') ?></td>
    				<td class="verdana8blk">Premi</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['PREMI'], 2, ',', '.') ?></td>
				</tr>
    			<tr>
    				<td colspan="6"><hr size="1"></td>
  				</tr>
				<tr>
				<?
					$sql="select count(b.nopeserta) peserta
						  from pkadm.kontrak_peserta a, peserta b
						  where a.nokontrak='$no_polis' 
		   					and a.nuke='001' and a.nopeserta=b.nopeserta and nvl(b.status,0)='0'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
    				<td class="verdana8blk">Jumlah Peserta Non Aktif</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk" colspan="4">
					<a href="#" onclick="NewWindow('cekpolispkpesertanonaktif.php?nokontrak=<?=$no_polis;?>','',780,400,1)">
		  <?=$arr["PESERTA"]."</a>";?></td>
				</tr>
				<?
					$sql="select sum(a.nilaipremi)premi,sum(nilaibenefit)jua
						  from pkadm.benefit_peserta a, peserta b
						  where a.nokontrak='$no_polis' and jenisbenefit in ('1','B') 
						  	and a.nopeserta=b.nopeserta and nvl(b.status,0)='0'";
					$DB->parse($sql);
					$DB->execute();
					$arr=$DB->nextrow();
				?>
				<tr>
    				<td class="verdana8blk">JUA</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['JUA'], 2, ',', '.') ?></td>
    				<td class="verdana8blk">Premi</td>
    				<td class="verdana8blk">:</td>
    				<td class="verdana8blk"><? echo number_format($arr['PREMI'], 2, ',', '.') ?></td>
				</tr>
			</table>
   		</td>
  	</tr>
</table> 
</div>
<? 
} 

?>
<hr size="1">
<a href="../pelaporan/index.php"><font face="Verdana" size="2">Menu Manajemen Informasi</font></a>