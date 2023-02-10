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
        	A.PEMOHON,A.TRANSFER,A.TGLTRANSFER,NAB, A.KDKANTORPROSES,
        	A.NOIZIN,A.NOURUT,A.GADAILAMA,A.BUNGAGADAILAMA,A.SISABUNGAGADAI,nvl(A.REFUND,0) REFUND,
					(SELECT NAMAKLAIM FROM $DBUser.TABEL_902_KODE_KLAIM WHERE KDKLAIM=A.KDKLAIM) AS NAMAKLAIM   
				FROM $DBUser.TABEL_901_PENGAJUAN_KLAIM A
					WHERE A.PREFIXPERTANGGUNGAN='$prefix' AND A.NOPERTANGGUNGAN='$noper'  
					AND to_char(A.TGLPENGAJUAN,'DD/MM/YYYY')='$tglpengajuan' AND A.KDKLAIM='$kdklaim'";
//	echo $sql;				
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
	$kdkantorproses = $arr["KDKANTORPROSES"];

    $KTR = New Kantor($userid,$passwd,$kdkantorproses);
		
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
	

					
    
		
		//echo $kdklaim;
//		 if ($kdklaim = 'SDB' || $kdklaim ='STPD' || $kdklaim ='PDB' || $kdklaim ='PTPD')
//		{	
//		   		$tujuan = "BAGIAN INKASO </BR> DIVISI KAI"; 
//				$kantorproses = "HEAD OFFICE";
//				//echo $kdklaim;
//		} else {
	if($noper=="001916448"){
		$tujuan = "Kepala Bagian Akuntansi Keuangan";
                $kantorproses = "KANTOR PUSAT";
				$pejabat	  = $KTR->kepala;
				$jabatan	= $KTR->jabatan;
	}else{
			$tujuan = "Kepala Seksi Adm. &amp Logistik";
                $kantorproses = strtoupper($KTR->namakantor);
				$pejabat	  = $KTR->kepala;
				$jabatan	= $KTR->jabatan;
	}
		  		 			
//		}
		
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
	$sql = "select TO_CHAR(ADD_MONTHS(TGLSELESAI,DECODE(KDCARABAYAR,'A',12,'H',6,'M',1,'Q',3)),'DD/MM/YYYY') TGLSD,(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=a.kdcarabayar) carabayar ,to_char(tglmulai,'dd/mm/yyyy') tglmulai, to_char(tglselesai,'dd/mm/yyyy') tglsampai,kdcarabayar, totalbenefit,nilaibenefit, sisabenefit, (select to_char(expirasi,'dd/mm/yyyy') from $DBUser.tabel_223_transaksi_produk
	where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit=a.kdbenefit) exp from $DBUser.TABEL_UL_BENEFIT_KLAIM a ".
   			   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' AND KDKLAIM='".$_GET['kdklaim']."' order by tglrekam desc";
    //ECHO $sql;
    $DB->parse($sql);
  	$DB->execute();
  	$ben=$DB->nextrow();
	?>

	<tr>
    <td colspan="2"><li>
      <div align="justify">Pembayaran 
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
        (akumulasi pembebasan premi maksimal sebesar Rp.500.000.000,00)</div>
    </li>
    <? 
	//echo $ben["EXP"].$ben["TGLSAMPAI"];
	if ($ben["EXP"]>=$ben["TGLSAMPAI"]) { } else { ?>
    <!--li>
      <div align="justify">Selisih Rp.500.000.000,00 - Rp.
        <?=number_format($ben["TOTALBENEFIT"],2,',','.');?> 
        = Rp.
        <?=number_format($ben["SISABENEFIT"],2,',','.');?> 
        dibayarkan sebagai Top Up Sekaligus pada bulan <?=$ben["TGLSD"];?></div>
    </li-->
    <? } ?>
    <!--li>
      <div align="justify">Pemegang Polis / Ahliwaris diharuskan membayar premi lanjutan kembali pada <?=$ben["TGLSD"];?> s/ <?=$PERT->expirasi;?></div>
    </li-->
    <li>
      <div align="justify">Pemegang Polis / Ahliwaris dapat melanjutkan membayar premi lanjutan pada <?=$ben["TGLSD"];?> s.d <?=$PERT->expirasi;?></div>
    </li>
    <!--li>
      <div align="justify">Jika tidak membayar premi lanjutan, maka mengakibatkan polis menjadi batal (lapse)</div>
    </li-->
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
<br /><br />
<table border="0" cellpadding="0" cellspacing="0" width="88%">
  <tr>
    <td valign="top" width="60%">
		</td>
    <td valign="top" width="40%" nowrap>
		<b>PT. ASURANSI JIWA IFG</b><br />
		<b>HEAD OFFICE</b><br />
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

</center>

</body>

</html>
</body>
</html>
