<?
  include "../../includes/session.php";
  include "../../includes/common.php";
	include "../../includes/database.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/kantor.php";
	include "../../includes/fungsi.php";
	include "../../includes/tgl.php";
	include "../../includes/duit.php";
	include "../../includes/tunggakan.php";
	
	$DB=new database($userid, $passwd, $DBName);
	$DA=new database($userid, $passwd, $DBName);
	$KTR = New Kantor($userid,$passwd,$kantor);
	$KTP = New KantorPusat($userid,$passwd);
	
	$PERT = New Pertanggungan($userid,$passwd,$prefix,$noper);
	$t 			= $PERT->lamaasuransi;
	$t2			= $PERT->lamaasuransi_bl;
	if($t==3 && $t2>0){
	 $t = 4;
	}
	
	$notasi = ($PERT->valuta=='3') ? "USD"  : "Rp. ";
	$usiapolis = $PERT->usiapolisth;
	$statusmedical = $PERT->medstat;
	$kdvaluta			= $PERT->valuta;
	
	$TR=new Transaksi($userid,$passwd);
	$kurs = ($PERT->valuta=='0') ? 1 : $TR->Kurs($PERT->valuta);
	
	$DU = New Duit($userid,$passwd);
	$kursstd   = $DU->Kurs($PERT->valuta);		
	$matreakta = $DU->MatreAktaGadai();
	
  	$sql = "SELECT 
        	A.PREFIXPERTANGGUNGAN,A.NOPERTANGGUNGAN,A.KDKLAIM,
        	A.TGLJATUHTEMPO,A.USERFO,A.TGLFO,A.USERPTG,
        	A.TGLPTG,A.USERADLOG,A.TGLADLOG,A.EMAILTO,
        	A.OTORISASIBAYAR,A.TGLOTORISASI,A.NOMORSIP,
        	A.TGLSIP,A.NILAIBENEFIT,A.TGLMENINGGAL,A.STATUS,A.TUNGGAKAN,
        	A.BNGTUNGGAKAN,A.SISAGADAI,A.USERREKAM,A.TGLREKAM,A.USERUPDATED,
        	A.TGLUPDATED,to_char(A.TGLHITUNG,'DD/MM/YYYY') as TGLHITUNG,
					to_char(A.TGLPENGAJUAN,'DD/MM/YYYY') as TGLPENGAJUAN,
					to_char(A.TGLJATUHTEMPO,'DD/MM/YYYY') as TGLJATUHTEMPO,
					to_char(A.TGLADLOG,'DD/MM/YYYY') as TGLADLOG,
					A.TGLBOOKED,A.PAJAK,A.KURS,
        	A.PEMOHON,A.TRANSFER,A.TGLTRANSFER,
        	A.NOIZIN,A.NOURUT,A.GADAILAMA,A.BUNGAGADAILAMA,A.SISABUNGAGADAI,
					(SELECT NAMAKLAIM FROM $DBUser.TABEL_902_KODE_KLAIM WHERE KDKLAIM=A.KDKLAIM) AS NAMAKLAIM    
				FROM $DBUser.TABEL_901_PENGAJUAN_KLAIM A
					WHERE A.PREFIXPERTANGGUNGAN='$prefix' AND A.NOPERTANGGUNGAN='$noper'  
					AND to_char(A.TGLPENGAJUAN,'DD/MM/YYYY')='$tglpengajuan' AND A.KDKLAIM='$kdklaim'";
	//echo $sql;				
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();			
	
	$tglhitung      = $arr["TGLHITUNG"];
	$tgljatuhtempo  = $arr["TGLJATUHTEMPO"];
	$tglpengajuan  = $arr["TGLPENGAJUAN"];
	$kdklaim      	= $arr["KDKLAIM"];
	$kurstransaksi	= $arr["KURS"];
	$nilaibenefit 	= $arr["NILAIBENEFIT"];
	$tunggakan 			= $arr["TUNGGAKAN"];
	$bungatunggakan = $arr["BNGTUNGGAKAN"];
	$namaklaim 			= $arr["NAMAKLAIM"];
	$gadailama 			= $arr["GADAILAMA"];
	$sisagadai 			= $arr["GADAILAMA"]+$arr["SISAGADAI"];
	$bungasisagadai = $arr["SISABUNGAGADAI"]=="" ? $arr["BUNGAGADAILAMA"] : $arr["SISABUNGAGADAI"];
	$noizin 	 			= $arr["NOIZIN"];
		
	$sql = "select $DBUser.polis.nilaibenefit('$prefix','$noper','".$arr["TGLHITUNG"]."') tebus from dual ";
	$DA->parse($sql);
	$DA->execute();
	$w=$DA->nextrow(); 
	

  	$sql = "select to_char(last_day(to_date('".$arr["TGLMOHON"]."','DD/MM/YYYY')),'DD') as lastday from dual";
    //echo $sql."<br />";
  			$DA->parse($sql);
    		$DA->execute();
    		$las=$DA->nextrow();
    		$jmlharibulan = $las["LASTDAY"];
  			$tglmohon = $arr["TGLMOHON"];
  			$sisahari			= substr($tglmohon,0,2);
  			$jmlhari 			= $jmlharibulan - $sisahari;
  			
  	$kt=$TR->Kurs($PERT->valuta,$tglmohon);
  	$ks=$DU->Kurs($PERT->valuta,$tglmohon);
  	$kurs= $TR->Kurs($PERT->valuta,$tglmohon); 
	
		$sql = "select bunga FROM $DBUser.tabel_999_bunga ".
 				 	 "WHERE kdbunga='01' AND kdvaluta=".$arr["KDVALUTA"]." AND tglberlaku=(select max(tglberlaku) from $DBUser.tabel_999_bunga where kdbunga='01' ".
					 "AND tglberlaku<=sysdate AND kdvaluta=".$arr["KDVALUTA"].")";
	  //echo $sql;
		$DA->parse($sql);
	  $DA->execute();
	  $arw=$DA->nextrow();
	  $bunga=$arw["BUNGA"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<title>Surat Ijin Klaim Polis Pertanggungan Perorangan</title>
<style type="text/css">
<!-- 
body{
 font-size: 14px;
} 

td{
 font-size: 14px;
} 
-->
</style>
</head>

<body><!-- onLoad="window.print();window.close()">-->
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<center>
<table border="0" cellpadding="0" cellspacing="0" width="88%">
  <tr>
    <td>Nomor</td>
    <td>: &nbsp;&nbsp;<?=$noizin;?></td>
		<td></td>
  </tr>
	<tr>
    <td>Tanggal</td>
    <td>: &nbsp;&nbsp;<?=toTglIndo($tglhitung);?></td>
		<td></td>
  </tr>
  <tr>
    <td valign="top"></td>
		<td></td>
		<td valign="top">
		Kepada : <br />
		<?
		$sql = "select batasmax from $DBUser.tabel_999_batasan_mutasi ".
							 	 "where kdmutasi='17' and kdvaluta='".$PERT->valuta."' ".
								 "and tglberlaku in ".
								 "(select max(tglberlaku) from $DBUser.tabel_999_batasan_mutasi ".
							 	 "where kdmutasi='17' and kdvaluta='".$PERT->valuta."')";
		$DB->parse($sql);
    	$DB->execute();
    	$arr = $DB->nextrow();
    	$batas = $arr["BATASMAX"]; 
    	//$nilaibenefit = 10000000000;
    	if ($nilaibenefit <= $batas)
		{	
		   					$tujuan = "Kepala Seksi Adm. &amp Logistik";
          					$kantorproses = $KTR->namakantor;
								$pejabat		 = $KTR->kepala;
								$jabatan		 = $KTR->jabatan;
		} elseif	($nilaibenefit > $batas)
		{ 
		  				  $tujuan = "Kepala Bagian Adm. &amp Keuangan";
								$kantorproses = $KTR->nama_ro;
								$pejabat		 = $KTR->rm;
								$jabatan		 = $KTR->jabatan_rm;
		} else {
		  		 			$tujuan = "DIVISI KAI"; 
					 			$kantorproses = "PT ASURANSI JIWA IFG HEAD OFFICE";
		}
		
		if($kdklaim=="MENINGGAL")
		{
		  $tujuan = "Kepala Seksi Adm. &amp Logistik";
			if($kdvaluta=="3")
			{
			   if(($nilaibenefit<= 3500 && $statusmedical=="N" && $usiapolis <= 3) || ($nilaibenefit<= 6500 && $statusmedical=="N" && $usiapolis > 3))
				 {
				    $kantorproses = $KTR->nama_ro;
						$pejabat		  = $KTR->rm;
						$jabatan		  = $KTR->jabatan_rm;
				 }
				 else
				 {
				   if($nilaibenefit >= 3501 && $nilaibenefit <= 6500  && $usiapolis <= 3)
					 {
  				    $kantorproses = $KTP->nama_ho;
  						$pejabat		  = $KTP->kadivpp;
  						$jabatan		  = "KEPALA DIVISI PERTANGGUNGAN PERORANGAN";
					 }
					 else
					 {
					 		$kantorproses = $KTP->nama_ho;
  						$pejabat		  = $KTP->nama_dirtang;
  						$jabatan		  = $KTP->jabatan_dirtang;
					 }
				 }
			}
			else
			{
			   if(($nilaibenefit<= 28000000 && $statusmedical=="N" && $usiapolis <= 3) || ($nilaibenefit<= 52000000 && $statusmedical=="N" && $usiapolis > 3))
				 {
				    $kantorproses = $KTR->nama_ro;
						$pejabat		  = $KTR->rm;
						$jabatan		  = $KTR->jabatan_rm;
				 }
				 else
				 {
				   if($nilaibenefit >= 28000001 && $nilaibenefit <= 52000000  && $usiapolis <= 3)
					 {
  				    $kantorproses = $KTP->nama_ho;
  						$pejabat		  = $KTP->kadivpp;
  						$jabatan		  = "KEPALA DIVISI PERTANGGUNGAN PERORANGAN";
					 }
					 else
					 {
					 		$kantorproses = $KTP->nama_ho;
  						$pejabat		  = $KTP->nama_dirtang;
  						$jabatan		  = $KTP->jabatan_dirtang;
					 }
				 }
			}
			
		}
		
		echo $tujuan;
		echo "<br />".ucwords(strtolower($KTR->namakantor));
		?>
		</td>
  </tr>
</table>
</center>

<br /><br /><br />
<p align="center">
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td nowrap><b><u>NOTA DESISI <?=$namaklaim;?> POLIS PERTANGGUNGAN PERORANGAN</u><br />
		No Polis : <?=$PERT->nopol;?> / <?=$prefix;?>-<?=$noper;?> Atas Nama <?=$PERT->namapemegangpolis;?>
</b></td>
  </tr>
</table>

</p>

<center>
<table border="0" style="border-collapse: collapse" id="table1" cellpadding="0" width="88%">
	<tr>
		<td>Pembayaran <?=ucwords(strtolower($namaklaim));?> tanggal <?=toTglIndo($tglpengajuan);?></td>
		<td></td>
		<td align="right"></td>
	</tr>
    <tr>
		<td height="20">&nbsp;</td>
		<td height="20">&nbsp;</td>
		<td height="20">&nbsp;</td>
	</tr>
	<?
	$sql = "select ".
				"a.kdbenefit,a.nilaibenefit,a.tglpengajuan,a.kd_cacat,b.namabenefit, ".
				"(select nama_cacat from $DBUser.tabel_906_pros_cacattetap where kd_cacat=a.kd_cacat) namacacat ".
			"from ".
				"$DBUser.tabel_905_historis_klaim_pa a, ".
				"$DBUser.tabel_207_kode_benefit b ".
			"where ".
				"a.kdbenefit=b.kdbenefit ".
				"and a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper'  ".
				"and to_char(a.tglpengajuan,'DD/MM/YYYY')='$tglpengajuan' and a.kdklaim='$kdklaim'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($arr=$DB->nextrow()) {
	?>
	<tr>
		<td>
		<?=$arr['NAMABENEFIT'];?> <?=$arr['NAMACACAT'];?>
		</td>
		<td><?=$notasi;?> </td>
		<td align="right"><?=number_format($arr['NILAIBENEFIT'],2,",",".");?></td>
	</tr>
	<?
	}
	?>
    <tr>
		<td height="20">&nbsp;</td>
		<td height="20">&nbsp;</td>
		<td height="20">&nbsp;</td>
	</tr>
    <tr>
		<td>JUMLAH TOTAL</td>
		<td><?=$notasi;?> </td>
		<td align="right">
        <? 
		 $nbenefit = number_format(round($nilaibenefit),2,",",".");
		echo $nbenefit;
		?>
        </td>
	</tr>
	<tr>
		<td height="20">&nbsp;</td>
		<td height="20">&nbsp;</td>
		<td height="20">&nbsp;</td>
	</tr>
</table>


<br /><br />
<table border="0" cellpadding="0" cellspacing="0" width="88%">
  <tr>
    <td valign="top" width="60%">
		</td>
    <td valign="top" width="40%" nowrap>
		<b>PT. ASURANSI JIWA IFG</b><br />
		<?=ucwords(strtolower($kantorproses)); ?><br /><br /><br /><br />
		
		<u><b>(<?=$pejabat; ?>)</b></u><br />
		<?=$jabatan;?>
		</td>
  </tr>

</table>
</center>
</body>
</html>