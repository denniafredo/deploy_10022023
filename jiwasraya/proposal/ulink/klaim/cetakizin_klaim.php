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
	
	$DB1=new database($userid, $passwd, $DBName);
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
	
	//$notasi = ($PERT->valuta=='3') ? "USD"  : "Rp. ";
	if ($PERT->valuta=='3') {$notasi="USD";}
	elseif ($PERT->valuta=='1') {$notasi="Rp. ";}
	else {$notasi=" ";}
	
	$usiapolis = $PERT->usiapolisth;
	$statusmedical = $PERT->medstat;
	$kdvaluta			= $PERT->valuta;
	
	$TR=new Transaksi($userid,$passwd);
	$kurs = ($PERT->valuta=='0') ? 1 : $TR->Kurs($PERT->valuta);
	
	$DU = New Duit($userid,$passwd);
	$kursstd   = $DU->Kurs($PERT->valuta);		
	$matreakta = $DU->MatreAktaGadai();
	
	$sqlnotasigadai="select DECODE(KDVALUTA,'1', 'Rp', '0','Rp','USD') kdvaluta from $DBUser.TABEL_700_GADAI WHERE PREFIXPERTANGGUNGAN='$prefix' AND NOPERTANGGUNGAN='$noper' AND STATUS='3'";
	//echo $sqlnotasigadai;
	$DB1->parse($sqlnotasigadai);
	$DB1->execute();
	$arrgdi=$DB1->nextrow();				
	$notasigadai= $arrgdi["KDVALUTA"];
	
  $sql = "SELECT 
        	A.PREFIXPERTANGGUNGAN,A.NOPERTANGGUNGAN,A.KDKLAIM,A.TGLPENGAJUAN,
        	A.TGLJATUHTEMPO,A.USERFO,A.TGLFO,A.USERPTG,
        	A.TGLPTG,A.USERADLOG,A.TGLADLOG,A.EMAILTO,
        	A.OTORISASIBAYAR,A.TGLOTORISASI,A.NOMORSIP,
        	A.TGLSIP,A.NILAIBENEFIT,A.TGLMENINGGAL,A.STATUS,A.TUNGGAKAN,
        	A.BNGTUNGGAKAN,A.SISAGADAI,A.USERREKAM,A.TGLREKAM,A.USERUPDATED,
        	A.TGLUPDATED,to_char(A.TGLHITUNG,'DD/MM/YYYY') as TGLHITUNG,
					to_char(A.TGLJATUHTEMPO,'DD/MM/YYYY') as TGLJATUHTEMPO,
					to_char(A.TGLADLOG,'DD/MM/YYYY') as TGLADLOG,
					A.TGLBOOKED,A.PAJAK,A.KURS,
        	A.PEMOHON,A.TRANSFER,A.TGLTRANSFER,NAB,
        	A.NOIZIN,A.NOURUT,A.GADAILAMA,A.BUNGAGADAILAMA,A.SISABUNGAGADAI,nvl(A.REFUND,0) REFUND,
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
	$kdklaim      	= $arr["KDKLAIM"];
	$kurstransaksi	= $arr["KURS"];
	$nilaibenefit 	= $arr["NILAIBENEFIT"];
	$nilairefund 	= $arr["REFUND"];
	$tunggakan 			= $arr["TUNGGAKAN"];
	$bungatunggakan = $arr["BNGTUNGGAKAN"];
	$namaklaim 			= $arr["NAMAKLAIM"];
	$gadailama 			= $arr["GADAILAMA"];
	$sisagadai 			= $arr["GADAILAMA"]+$arr["SISAGADAI"];
	$bungasisagadai = $arr["SISABUNGAGADAI"]=="" ? $arr["BUNGAGADAILAMA"] : $arr["SISABUNGAGADAI"];
	$noizin 	 			= $arr["NOIZIN"];
	$nab 			= $arr["NAB"];
		
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
	

					
    
		

			$tujuan = "Kepala Seksi Anggaran dan Pengendalian";
                //$kantorproses = strtoupper($KTR->namakantor);
				$kantorproses = "Divisi Keuangan dan Akuntansi";
				$pejabat	  = $KTR->kepala;
				$jabatan	= $KTR->jabatan;


		//echo $tujuan;
		//echo '<hr />kdvaluta : '.$kdvaluta.'<br />nilaibenefit : '.$nilaibenefit.'<br />statusmedical : '.$statusmedical.'<br />usiapolis : '.$usiapolis.'<br />';
		
		
		
		echo $tujuan;
		//echo "<br />".ucwords(strtolower($KTR->namakantor)); --> EDIT BY SALMAN 7/9/2011
		//echo "<br />".$KTR->namakantor;
		echo "<br />".$kantorproses;
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
		<td>Pembayaran <?=ucwords(strtolower($namaklaim));?> tanggal <?=toTglIndo($tgljatuhtempo);?> 
			  <?
    		if($PERT->valuta==0)
    	  {
				 echo "(nilai indeks / PH)";
				} 
				?>
		</td>
		<td><?=$notasi;?></td>
		<td align="right">
		<? 
		//echo "tes = ".$PERT->indexawal;
		if($PERT->valuta==3)
	  {
		  $nbenefit = number_format($nilaibenefit,2,",",".");
		} 
		elseif($PERT->valuta==0)
	  {
		 // $nbenefit = number_format($nilaibenefit/$PERT->indexawal,2,",",".");
		  $nbenefit = number_format($nilaibenefit,2,",",".");
		}
		else 
		{
		  $nbenefit = number_format(round($nilaibenefit),2,",",".");
		}
		echo $nbenefit;
		?>
		</td>
	</tr>
    <?
    if($nilairefund>0) {?>
    <tr>
		<td><br>
		Jumlah Refund</td>
        <td><br><?=$notasi;?></td>
		<td align="right"><br>
        <?=number_format($nilairefund,2,",",".");?></td>
	</tr>
	<? }
	?>
	<tr>
		<td colspan="3"><br>
		<u>Diperhitungkan sekaligus dengan:</u><br /><br /></td>
	</tr>
	<tr>
		<td>
			<ul>
				<li>Premi <?=ucwords(strtolower($PERT->namacarabayar));?> periode <?=toTglIndo($TGK->lastpay);?> s/d <?=toTglIndo($tglhitung);?> 
				<?
    		if($PERT->valuta==0)
    	  {
				 echo "(nilai indeks / PH)";
				} 
				?>
				</li>
			</ul>
		</td>
		<td>
		<?
		
		if($PERT->valuta==0)
	  {
		  //$tunggakan = $tunggakan*$kurstransaksi;
		}
		
		?> 
		<?=$notasi;?></td>
		<td align="right"><?=number_format($tunggakan,2,",",".");?></td>
	</tr>
	
	<tr>
		<td>
		<ul>
			<li>Pokok Pinjaman</li>
		</ul>
		</td>
		<td><?=$notasigadai;?></td>
		<td align="right"><?=number_format($sisagadai,2,",",".");?></td>
	</tr>
	<tr>
		<td>
		<ul>
			<li>Bunga pinjaman</li>
		</ul>
		</td>
		<td><?=$notasigadai;?></td>
		<td align="right"><?=number_format($bungasisagadai,2,",",".");?></td>
	</tr>
    <? if($nab=='x') {?>
    <tr>
		<td><ul>
			<li>Biaya Duplikat Polis</li>
		</ul></td>
        <td><?=$notasi;?></td>
		<td align="right"><?=number_format(50000,2,",",".");?></td>
	</tr>
    <tr>
		<td><ul>
			<li>Materai Duplikat Polis</li>
		</ul></td>
        <td><?=$notasi;?></td>
		<td align="right"><?=number_format(6000,2,",",".");?></td>
	</tr>
	<? }
	 
	if($PERT->kdcarabayar=='X' || $PERT->kdcarabayar=="J" || $PERT->kdcarabayar=='E')
	{
	  $premisekaligus=1;
	}
	else
	{
	  $premisekaligus=0;
	}
	
	if($premisekaligus=="1" && $t<=3 && substr($PERT->namaproduk,0,7)!="ANUITAS" && $PERT->namaproduk!="PRIMA INVESTASI EXECUTIVE" && $kdklaim!='MENINGGAL')
	{
	  //$pphmanfaat = $nilaibenefit-$tunggakan;
		$sql = "select sum(premitagihan) as totalbayarpremi from $DBUser.tabel_300_historis_premi ".
   			   "where tglseatled is not null and prefixpertanggungan='$prefix' and nopertanggungan='$noper'";
    $DB->parse($sql);
  	$DB->execute();
  	$tot=$DB->nextrow();
  	$totalbayarpremi = $tot["TOTALBAYARPREMI"];
		
		//if($nilaibenefit>$PERT->premi1)
		if($nilaibenefit>$totalbayarpremi)
		{
		$pphmanfaat = $nilaibenefit - $totalbayarpremi;
		$pphmanfaat = $pphmanfaat*0.20;
		}
		else
		{
		$pphmanfaat = 0;
		}
	?>
	<tr>
		<td>
		<ul>
			<li>Pph Manfaat Asuransi (20%)</li>
		</ul>
		</td>
		<td><?=$notasi;?> </td>
		<td align="right"><?=number_format($pphmanfaat,2,",",".");?></td>
	</tr>
	<?
	}
	else
	{
		$pphmanfaat = 0;
	}
	?>
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
		<b>KANTOR PUSAT</b><br />
		<?
		//ucwords(strtolower($kantorproses));  --> EDIT BY SALMAN 8/9/2011
		//echo $kantorproses; 
		?>
		
		<br /><br /><br /><br />
		
		<u><b>BUDDY NUGRAHA</b></u><br />
        KEPALA DIVISI
		<?//=$jabatan;?>
		</td>
  </tr>

</table>


<br /><br />

<table border="0" cellpadding="0" cellspacing="0" width="88%">
  <? 
	//tampil jika polis valuta index
	if($PERT->valuta==0)
	{
	?>
	<tr>
    <td>Khusus polis indeks</td>
		<td width="60%"></td>
  </tr>
	<tr>
    <td>Indeks Dasar (Awal)</td>
		<td>= <?=$notasi;?><?=number_format($PERT->indexawal,2,",",".");?></td>
  </tr>
	<tr>
    <td>JUA Awal</td>
		<td>= <?=$notasi;?> <?=number_format($PERT->jua,2,",",".");?></td>
  </tr>
  <? 
	}
	
    if($kdklaim=='SDB' || $kdklaim=='STPD' || $kdklaim=='PDB' || $kdklaim=='PTPD')
	{
	$sql = "select TO_CHAR(ADD_MONTHS(TGLSELESAI,DECODE(KDCARABAYAR,'A',12,'H',6,'M',1,'Q',3)),'DD/MM/YYYY') TGLSD,(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=a.kdcarabayar) carabayar ,to_char(tglmulai,'dd/mm/yyyy') tglmulai, to_char(tglselesai,'dd/mm/yyyy') tglsampai,kdcarabayar, totalbenefit,nilaibenefit, sisabenefit from $DBUser.TABEL_UL_BENEFIT_KLAIM a ".
   			   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND KDKLAIM='$kdklaim'";
    $DB->parse($sql);
  	$DB->execute();
  	$ben=$DB->nextrow();
	?>
	<tr>
    <td>Catatan :</td>
		<td width="60%"></td>
  </tr>
	<tr>
    <td colspan="2"><li>
      <div align="justify">Pembayaran klaim 
        <?=$namaklaim;?> 
        secara 
        <?=$ben["CARABAYAR"];?>
        , Sebesar Rp.
        <?=number_format($ben["NILAIBENEFIT"],2,',','.');?> 
        mulai  
        <?=$ben["TGLMULAI"];?> 
        s/d 
        <?=$ben["TGLSAMPAI"];?> 
        dengan total sebesar Rp.
        <?=number_format($ben["TOTALBENEFIT"],2,',','.');?> 
        atau akumulasi premi maksimal sebesar Rp.500.000.000,00</div>
    </li>
    <li>
      <div align="justify">Selisih Rp.500.000.000,00 - Rp.
        <?=number_format($ben["TOTALBENEFIT"],2,',','.');?> 
        = Rp.
        <?=number_format($ben["SISABENEFIT"],2,',','.');?> 
        dibayarkan sebagai Top Up Sekaligus pada bulan <?=$ben["TGLSD"];?></div>
    </li>
    <li>
      <div align="justify">Pemegang Polis / Ahliwaris diharuskan membayar premi lanjutan kembali pada <?=$ben["TGLSD"];?> s/d <?=$PERT->expirasi;?></div>
    </li>
    <li>
      <div align="justify">Jika tidak membayar premi lanjutan, maka mengakibatkan polis menjadi batal (lapse)</div>
    </li>
    </td>
  </tr>
  
  <? 
	}
	?>
	<tr>
    <td>&nbsp;&nbsp; </td>
		<td width="60%"></td>
  </tr>
	
</table>

</center>

</body>

</html>
</body>
</html>
