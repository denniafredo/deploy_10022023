<?
  include "../../includes/database.php"; 
	include "../../includes/session.php"; 
	include "../../includes/klien.php";
	$DB=New database($userid, $passwd, $DBName);	
	$prefixpertanggungan = (!$prefixpertanggungan) ? $kantor : $prefixpertanggungan;

	
if ($j) {
 $t200="$DBUser.tabel_200_temp";
 $t219="$DBUser.tabel_219_temp";
 $t223="$DBUser.tabel_223_temp";
 
} else {
 $t200="$DBUser.tabel_200_pertanggungan";
 $t219="$DBUser.tabel_219_pemegang_polis_baw";
 $t223="$DBUser.tabel_223_transaksi_produk";
}	
?>
<html>
<head>
<title>Print Poposal</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="window.print();window.close()">
<div align="left">
<table border="0" cellpadding="2" width="600" cellspacing="2">
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="1" cellspacing="1" class="sans8">
				<tr>
					<td width="100%" colspan="6"  align="center">
<?
 if ($mode=='edit') {
  print( "					<b>DOKUMEN PROPOSAL NOMOR ".$prefixpertanggungan."-".$noproposal."</b><br>\n" );
  print( "					Ini Adalah Dokumen Proposal Yang Sebenarnya\n" );
 } else {
  print( "					<b>DOKUMEN KONFIRMASI PROPOSAL (NOMOR AKAN DIBERIKAN SETELAH SUBMIT BERHASIL)</b><br>\n" );
  print( "					Ini Bukan Dokumen Proposal Yang Sebenarnya, hanya konfirmasi sebelum Submit\n" );
  print( "					Dokumen Proposal Yang Sebenarnya dapat dicetak dari Menu Pemeliharaan SPAJ\n" );
 }
?>
					<hr size="1">
					</td>
				</tr>
				<tr>
					<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="1" cellspacing="1" class="sans8">
							<tr>
              <?
               $sql = "select juamainproduk,premistd,nosp,to_char(tglsp,'DD/MM/YYYY') tglsp,nobp3,to_char(tglbp3,'DD/MM/YYYY') tglbp3,".
               			  "kdstatusmedical,to_char(mulas,'DD/MM/YYYY') mulas,to_char(expirasi,'DD/MM/YYYY') expirasi,".
              				"to_char(tglakhirpremi,'DD/MM/YYYY') akhirpremi,indexawal,premi1,premi2,kdvaluta,a.kdcarabayar,".
              				"usia_th,usia_bl,lamapembpremi_th,lamapembpremi_bl,lamaasuransi_th,lamaasuransi_bl,".
              				"decode (a.gadaiotomatis,'1','SETUJU','TIDAK SETUJU') gpo, a.kdproduk,decode(a.taltup,'1','YA','TIDAK') taltup, ".
											"a.autodebet,a.norekeningdebet,".
              				"notertanggung,nopemegangpolis,nopembayarpremi,noagen,nopenagih,b.namacarabayar ".
              				"from ".$t200." a,$DBUser.tabel_305_cara_bayar b ".
              				"where a.prefixpertanggungan='$prefixpertanggungan' ".
              				"and a.nopertanggungan='$noproposal' and a.kdcarabayar=b.kdcarabayar";
               //echo $sql;
               $DB->parse($sql);
               $DB->execute();
               $arr=$DB->nextrow();		
               
               $nosp=$arr["NOSP"];
               $tglsp=$arr["TGLSP"];
               $nobp3=$arr["NOBP3"];
               $tglbp3=$arr["TGLBP3"]; 
               $kdproduk=$arr["KDPRODUK"];
               $kdvaluta=$arr["KDVALUTA"];
               $kdcarabayar=$arr["KDCARABAYAR"];	
               $noagen=$arr["NOAGEN"];	
               $nopenagih=$arr["NOPENAGIH"];
               $pempolno=$arr["NOPEMEGANGPOLIS"];
               $pempreno=$arr["NOPEMBAYARPREMI"];
               $ttg=$arr["NOTERTANGGUNG"];
               $premistd=$arr["PREMISTD"];
               $kdstatusmedical=$arr["KDSTATUSMEDICAL"];
               $mulas=$arr["MULAS"];
               $usia=$arr["USIA_TH"]." th, ".$arr["USIA_BL"]." bl";
               $lamaasuransi=$arr["LAMAASURANSI_TH"]." th, ".$arr["LAMAASURANSI_BL"]." bl.";
               $lamapembpremi=$arr["LAMAPEMBPREMI_TH"]." th, ".$arr["LAMAPEMBPREMI_BL"]." bl.";
               $gpo =$arr["GPO"];
               $indexawal = $arr["INDEXAWAL"];
               $expirasi = $arr["EXPIRASI"];
               $akhirpremi = $arr["AKHIRPREMI"];
			   $taltup = $arr["TALTUP"];
               $p1 = ($arr["PREMI1"]==0) ? $p1 : $arr["PREMI1"];
               $p2 = ($arr["PREMI2"]==0) ? $p2 : $arr["PREMI2"];
               $jua = ($arr["JUAMAINPRODUK"]==0) ? $jua : $arr["JUAMAINPRODUK"];
							 
							 $autodebet = $arr["AUTODEBET"];
							 $norekening =  $arr["NOREKENINGDEBET"];
               ?>							
								<td width="18%" >SPAJ no/tgl</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $nosp; ?>&nbsp;,&nbsp;<? echo $tglsp; ?></td>
								<td width="18%" >BP3 no/tgl</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $nobp3; ?>&nbsp;,&nbsp;<? echo $tglbp3; ?></td>
							</tr>
						</table>
					</td>
				</tr>	
				<tr>
					<td width="100%" colspan="6"><b>Tertanggung</td>
				</tr>
				<tr>
					<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="1" cellspacing="1" class="sans8">
							<tr>
								<td width="18%" >Klien nomor</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ttg; ?></td>
                <?
                	$sql="select namavaluta from $DBUser.tabel_304_valuta where kdvaluta='$kdvaluta' ";
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$namavaluta=$ara["NAMAVALUTA"];
                	
                	$sql="select namacarabayar,kdjeniscb,faktorkomisi from $DBUser.tabel_305_cara_bayar where kdcarabayar='$kdcarabayar' ";
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$faktorkomisi=$ara["FAKTORKOMISI"];
                	$kdjeniscb=$ara["KDJENISCB"];
                	$namacarabayar=$ara["NAMACARABAYAR"];
                	 
                	$sql="select a.namaklien1, a.namaklien2, b.namapekerjaan, c.namahobby, a.gelar,f.namaagama,".
                			 "to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, decode(a.jeniskelamin,'P','PEREMPUAN','L','LAKI-LAKI') jeniskelamin,a.kdid||'-'||a.noid identitas, ".
                			 "a.tinggibadan,a.beratbadan,alamattetap01,alamattetap02,a.phonetetap01,a.phonetagih01,d.namakotamadya,e.namapropinsi,decode(a.meritalstatus,'L','LAJANG','K','KAWIN','J','JANDA','D','DUDA') merital ".
                			 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan b, $DBUser.tabel_114_hobby c, ".
                			 "$DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi e,$DBUser.tabel_102_agama f ".
                		 	 "where a.kdpekerjaan=b.kdpekerjaan(+) and a.kdhobby=c.kdhobby(+) and a.kdagama=f.kdagama(+) ".
                			 "and a.kdpropinsitetap=e.kdpropinsi(+) and a.kdkotamadyatetap=d.kdkotamadya(+) and a.noklien='$ttg' ";
                	//echo $sql;		
                	$DB->parse($sql);
                	$DB->execute();
                	$ara=$DB->nextrow();
                	$nama = (!strlen($ara["GELAR"]==0)) ? $ara["NAMAKLIEN1"].",".$ara["GELAR"] : $ara["NAMAKLIEN1"];
                	
                	$sql="select namaproduk,skg from $DBUser.tabel_202_produk where kdproduk='$kdproduk'";
                	//echo $sql;
                	$DB->parse($sql);
                	$DB->execute();
                	$arr=$DB->nextrow();	
                	$namaproduk = $arr["NAMAPRODUK"];
                	$kprod=$arr["SKG"];
                		
                	$sql = "select 'x' x from ".$t223." ".
                			   "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$noproposal' and kdbenefit='JAMLKP'";
                	//echo $sql;
                	$DB->parse($sql);
                	$DB->execute();
                	$arr=$DB->nextrow();
                	$namaproduk = ($arr["X"]=='x') ? $namaproduk." <font color=red>LENGKAP" : $namaproduk;
                		$status=($mode=='edit') ? 'PROPOSAL AKTIF' : 'PROPOSAL BELUM AKTIF';
                ?>
								<td width="18%" >Nama</td>
								<td width="2%" >:</td>
								<td width="30%" ><?	echo $nama ;?>
			 					</td>
							</tr>
							<tr>
								<td width="18%" >Tgl Lahir</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["TGLLAHIR"]; ?></td>
								<td width="18%" >Jenis Kelamin</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["JENISKELAMIN"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Alamat</td>
								<td width="2%" >:</td>							
								<td  colspan="4"><? echo $ara["ALAMATTETAP01"]." ".$ara["ALAMATTETAP02"]; ?></td>
							</tr>	
							<tr>
								<td width="18%"></td>
								<td width="2%"></td>							
								<td colspan="4"><? echo $ara["NAMAKOTAMADYA"]." ".$ara["NAMAPROPINSI"]; ?></td>
							</tr>							
							<tr>
								<td width="18%" >Pekerjaan</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NAMAPEKERJAAN"]; ?></td>
								<td width="18%" >Hobby</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NAMAHOBBY"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Tinggi Badan</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["TINGGIBADAN"]; ?> &nbsp;&nbsp;&nbsp;cm</td>
								<td width="18%" >Berat Badan</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["BERATBADAN"]; ?>&nbsp;&nbsp;&nbsp;kg</td>
							</tr>							
								<td width="18%" >Identitas</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["IDENTITAS"]; ?></td>
								<td width="18%" >Agama</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["NAMAAGAMA"]; ?></td>
							</tr>
							<tr>
								<td width="18%" >Status Pernikahan</td>
								<td width="2%" >:</td>							
								<td  colspan="4"><? echo $ara["MERITAL"]; ?></td>
							</tr>
							</tr>							
								<td width="18%" >Telepon Tetap</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["PHONETETAP01"]; ?></td>
								<td width="18%" >Telepon Tagih</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $ara["PHONETAGIH01"]; ?></td>
							</tr>	
						</table>
					</td>
				</tr>
				<tr>
					<td width="100%" colspan="6"><b>Ketentuan Polis</td>
				</tr>
				<tr>
				  <td width="100%" align="center" colspan="6">
					  <table width="95%" border="0" cellpadding="1" cellspacing="1" class="sans8">	
						  <tr>
							  <td width="18%" >Kode Produk</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $kdproduk; ?></td>
								<td width="18%" >Nama Produk</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $namaproduk; ?></td>
							</tr>
							<tr>
								<td width="18%" >Medical</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $kdstatusmedical; ?></td>
								<td width="18%" >Tgl Mulai</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $mulas; ?></td>
							</tr>
							<tr>
								<td width="18%" >Usia</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $usia;?></td>
								<td width="18%" >Lama Asuransi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $lamaasuransi;?></td>
							</tr>
							<tr>
								<td width="18%" >Tgl Ekspirasi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $expirasi; ?></td>
								<td width="18%" >Gadai Otomatis</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $gpo; ?>	</td>
							</tr>
							<tr>
								<td width="18%" >Akhir Premi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $akhirpremi; ?></td>
								<td width="18%" >Lama Premi</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $lamapembpremi;?></td>
							</tr>
							<tr>
								<td width="18%" >V a l u t a</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $namavaluta; ?></td>
								<td width="18%" >Cara Bayar</td>
								<td width="2%" >:</td>
							  <td width="30%" ><? echo $namacarabayar; ?></td>
							</tr>
							<tr>
								<td width="18%" >Index  Awal</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($indexawal,2); ?></td>
								<td width="18%" >Premi 5 th I</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($p1,2); ?></td>
							</tr>
							<tr>
								<td width="18%" >J U A</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($jua,2); ?></td>
								<td width="18%" >Premi >5 tahun</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($p2,2); ?></td>
							</tr>
							<tr>
								<td width="18%" >Premi Standar</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($premistd,2); ?></td>
								<td width="18%" >Status</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $status; ?></td>
							</tr>				
							<tr>
								<td width="18%" >Auto Debet</td>
								<td width="2%" >:</td>
								<td width="30%" ><?=($autodebet==1)? "YA" : "TIDAK";?> </td>
								<td width="18%" >No. Rekening Debet</td>
								<td width="2%" >:</td>
								<td width="30%" >
								<? 
								if($autodebet==1)
								{
								echo $norekening;
								}
								else {
								echo "-";
								}
								?>
								</td>
							</tr>		
							<tr>
								<td width="18%" >Taltup</td>
								<td width="2%" >:</td>
								<td width="30%" ><?=$taltup;?> </td>
								<td width="18%" >&nbsp;</td>
								<td width="2%" >&nbsp;</td>
								<td width="30%" >&nbsp;</td>
							</tr>
							<?
// Tambahan oleh Ari per 21/07/2008 khusus untuk JL2%
		if (substr($kdproduk,0,3)=='JL2'){
		
		    if($nopertanggungan=="")
				{
				   $nopertanggungan = $noproposal;
					 $tabelselect 		= "$DBUser.tabel_223_transaksi_produk";
				}
				else
				{
				   $tabelselect 		= "$DBUser.tabel_223_temp";
				}
							$sql = "select kdbenefit,premi from $tabelselect where  
                      kdbenefit in ('BNFTOPUP','BNFTOPUPSG')
                      and prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan'";
							//echo $sql;
							$DB->parse($sql);
      			  $DB->execute();
							while($top=$DB->nextrow())
							{
							  if($top["KDBENEFIT"]=="BNFTOPUP")
								{
								  $ptopupbk = $top["PREMI"];
								} else {
								  $ptopupsg = $top["PREMI"];
								}
							}
							?>
							<tr>
								<td width="18%" >Premi Top-up Berkala</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo number_format($ptopupbk,2); ?></td>
								<td width="18%" ></td>
								<td width="2%" ></td>
								<td width="30%" ></td>
							</tr>			
<?
		}
?>
						</table>
					</td>
				</tr>	

				<tr>
				  <td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="1" cellspacing="1" class="sans8">	
							<tr>
							<td colspan="3" width="30%" align="left">Nama Benefit</td>
								<td width="17%" align="center">Benefit</td>
								<td width="15%"  align="center">Jatuh Tempo</td>
								<td width="20%" align="right">Premi (th)</td>
							</tr>
<?
	$sql="select a.namabenefit,b.premi,b.nilaibenefit,b.kdjenisbenefit,to_char(b.expirasi,'DD/MM/YYYY') expirasi ".
			 "from ".$t223." b, $DBUser.tabel_207_kode_benefit a ".
			 "where a.kdbenefit=b.kdbenefit and ".
			 "b.prefixpertanggungan='$prefixpertanggungan' and b.nopertanggungan='$noproposal' ".
			 "and b.kdjenisbenefit <> 'T'";
	//echo $sql;		 
	$DB->parse($sql);
	$DB->execute();
	while ($ara=$DB->nextrow()) {
	  $jmlpremi+=$ara["PREMI"];
		$jmlbenefit+=$ara["NILAIBENEFIT"];
		$nb=$ara["NILAIBENEFIT"]!=0 ? number_format($ara["NILAIBENEFIT"],2):' ';
		$np=$ara["PREMI"]!=0 ? number_format($ara["PREMI"],2):' ';	
		echo "<tr>";
		echo "<td colspan=3>   ".$ara["NAMABENEFIT"]."</td>";
		echo "<td width=\"18%\" align=\"right\">".$nb."</td>";
		echo "<td  align=\"center\">".$ara["EXPIRASI"]."</td>";
		echo "<td width=\"30%\" align=\"right\">".$np."</td>";
		echo "</tr>";
	}

?>
				 		</table>
					</td>
			 	</tr>
		 	 	<tr>
			 		<td width="100%" colspan="6"><b>Pemegang Polis, Pembayar Premi, Beneficiary</td>
				</tr>
			 	<tr>
			 		<td width="100%" align="center" colspan="6">
						<table width="100%" border="0" cellpadding="1" cellspacing="1" class="sans8">	
						 	<tr>
						 		<td width="22%" align="center">Jenis</td>
								<td width="2%"></td>
								<td width="12%" align="center"> No Klien</td>
								<td width="30%" align="center">Hubungan</td>
								<td width="2%"></td>
								<td width="30%" align="center">Nama</td>
							</tr>
<?
 function getnama($db,$noklieninsurable,&$nama){
	$sql = "select namaklien1,gelar ".
			 	 "from $DBUser.tabel_100_klien  ".
				 "where noklien='$noklieninsurable' ";
	//echo $sql;
	$db->parse($sql);
	$db->execute();
	$ari=$db->nextrow();
	$nama=(strlen($ari["GELAR"])==0) ? $ari["NAMAKLIEN1"]: $ari["NAMAKLIEN1"].",".$ari["GELAR"] ;
 }
	
 function gethub($db,$noklieninsurable,$ttg,&$hub){
	$sql = "select c.kdhubungan,b.namahubungan ".
			 	 "from $DBUser.tabel_113_insurable c, $DBUser.tabel_218_kode_hubungan b ".
				 "where c.kdhubungan=b.kdhubungan and c.notertanggung='$ttg' and c.noklieninsurable='$noklieninsurable' ";
				 
	//echo $sql;
	$db->parse($sql);
	$db->execute();
	$arq=$db->nextrow();
	$hub=$arq["NAMAHUBUNGAN"];
	
	if (is_null($hub) && ($ttg==$noklieninsurable)){
		 $hub="Tertanggung";
	}
 }
 	
	getnama($DB,$pempolno,$nama);
	gethub($DB,$pempolno,$ttg,$hub);
?>
			 				<tr>
			 					<td>Pemegang Polis</td>
								<td>:</td>
								<td><? echo $pempolno; ?></td>
								<td><? echo $hub; ?></td>
								<td></td>
								<td><? echo $nama; ?></td>
							</tr>
<?
	getnama($DB,$pempreno,$nama);
	gethub($DB,$pempreno,$ttg,$hub);
?>

			 				<tr>
			 					<td>Pembayar Premi</td>
								<td>:</td>
								<td><? echo $pempreno; ?></td>
								<td><? echo $hub; ?></td>
								<td></td>
								<td><? echo $nama; ?></td>
							</tr>
<? 
$sql = "select a.nourut, a.noklien, b.namahubungan ".
		   "from ".$t219." a, $DBUser.tabel_218_kode_hubungan b ".
			 "where a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$noproposal' ".
			 "and a.notertanggung='$ttg' and a.kdinsurable=b.kdhubungan order by a.nourut";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$i=1;
	while ($ara=$DB->nextrow()) {
  	getnama($DB,$ara["NOKLIEN"],$nama);
		gethub($DB,$ara["NOKLIEN"],$ttg,$hub);
		echo "<tr>";
  	echo "<td>Ahli Waris ".$ara["NOURUT"]."</td>";
		echo "<td>:</td>";
  	echo "<td>".$ara["NOKLIEN"]."</td>";
  	echo "<td>".$ara["NAMAHUBUNGAN"]."</td>";
		echo "<td></td>";
  	echo "<td>".$nama."</td>";
  	echo "</tr>";
		$i++;
  }	

?>
			 			</table>
					</td>
			 	</tr>
		 	 	<tr>
			 		<td width="100%" colspan="6"><b>Penutup</td>
  			</tr>
			 	<tr>
			 		<td width="100%" align="center" colspan="6">
						<table width="95%" border="0" cellpadding="1" cellspacing="1" class="sans8">	
							<tr>
				 				<td width="18%" align="center">Jenis</td>
								<td width="2%"></td>
								<td width="30%" align="center"> Nomor Klien</td>
								<td width="50%" align="center">Nama</td>
							</tr>  
				 			<tr>
				 				<td width="18%">Penagih</td>
								<td width="2%">:</td>
<?	
	getnama($DB,$nopenagih,$nama);
?>
								<td width="30%" ><? echo $nopenagih; ?></td>
								<td width="50%" ><? echo $nama; ?></td>
							</tr>
			 				<tr>
<?		
	getnama($DB,$noagen,$nama);

?>
								<td width="18%" >Agen</td>
								<td width="2%" >:</td>
								<td width="30%" ><? echo $noagen; ?></td>
								<td width="50%" ><? echo $nama; ?></td>
  						</tr>
			 				<tr>

			 			</table>
					</td>
		 		</tr>
				<tr>
			 		<td width="100%" align="center" colspan="6">
<?
	$sql="select a.thnkomisi,a.komisiagen,b.namakomisiagen,b.kdkomisiagen, ".
	     "decode(b.kdkomisiagen,'02',0,a.komisiagen) ko, ".
			 "decode(b.kdkomisiagen,'02',b.namakomisiagen,b.namakomisiagen||' TAHUN '||a.thnkomisi) nk, ".
	     //"decode(b.kdkomisiagen,'02',a.komisiagen,decode('$kprod','1',a.komisiagen,decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen*$faktorkomisi) ) ) k ".  
			 "decode(b.kdkomisiagen,'02',a.komisiagen,decode('$kprod','1',decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen),decode('$kdjeniscb','B',a.komisiagen/$faktorkomisi,'X',a.komisiagen*$faktorkomisi) ) ) k ".  
			 "from $DBUser.tabel_404_temp a, $DBUser.tabel_402_kode_komisi_agen b ".
			 "where a.kdkomisiagen=b.kdkomisiagen and ".
			 "a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$noproposal' ".
			 "order by b.namakomisiagen desc";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
?>
	<table cellspacing="1" cellpadding="1" border="0" width="90%" class="sans8">	
  <tr align="center">
  <td rowspan="2" >Tahun</td>
  <td rowspan="2">Nama Komisi</td>
  <td colspan="2">K o m i s i</td>
  </tr>
  <tr align="center">
  <td>Dalam Tahun</td>
  <td>Sesuai Cara Bayar</td>
  </tr>
<?
	$jmlkomisi=0;
	$i=0;
  while($arr=$DB->nextrow()) {
	  include "../../includes/belang.php";
		$ko = $arr["KO"];
		$k  = $arr["K"];
		$ko =  ($kdjeniscb=='X') ? $k : $ko;
	  $add = ($arr["KDKOMISIAGEN"]=='02') ? $k : $ko;
 		
		$ko = ($ko==0) ? '' : number_format($ko,2);
		$k = ($k==0) ? '' : number_format($k,2);
		echo "<td align=\"center\">".$arr["THNKOMISI"]."</font></td>";
		echo "<td align=\"left\">".$arr["NK"]."</font></td>";
	  echo "<td align=\"right\">".$ko."</font></td>";
		echo "<td align=\"right\">".$k."</font></td>";
	  echo "</tr>";
		$i++;
		$jmlkomisi += $add;
	}
  echo "<tr>";
  echo "<td colspan=\"2\" >Jumlah Total Komisi</td>";
  echo "<td align=\"right\" >".number_format($jmlkomisi,2)."</td>";
  echo "<td></td></tr>";
	echo "</table>";	
?>	
					 </td>		
				 </tr>
		 	</table>
		</td>
	</tr>
</table>
</form>
</tr>
</table>

</div>
</body>
</html>	