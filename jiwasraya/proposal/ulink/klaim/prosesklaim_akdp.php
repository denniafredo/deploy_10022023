<?
  	include "../../includes/common.php";
  	include "../../includes/session.php";
	include "../../includes/database.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";
	include "../../includes/duit.php";
	include "../../includes/tunggakan.php";
	include "../../includes/gadai.php";
	include "../../includes/kantor.php";
	include "../../includes/tgl.php";
	echo "<link href=\"../../includes/jws2005.css\" rel=\"stylesheet\" type=\"text/css\">";
	
	$DB=new database($userid, $passwd, $DBName);
	$PWK = New Kantor($userid,$passwd,$kantor);
	$KT  = New Kantor($userid,$passwd,$PWK->kdkantorinduk);	
	$prefix=strtoupper($prefix);
	$KP  = New KantorPusat($userid,$passwd);
	
	$DA=new database($userid, $passwd, $DBName);
	$PER=New Pertanggungan($userid,$passwd,$prefix,$noper);
	$kdproduk=$PER->produk;
	$TR = New Transaksi($userid,$passwd);

	$sql = "select kelompok,namaklaim from $DBUser.tabel_902_kode_klaim where kdklaim='$kdklaim'";
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$klp=$arr["KELOMPOK"];
	$namaklaim=	$arr["NAMAKLAIM"];
	
	$sql = "select status,otorisasibayar,to_char(tglpengajuan,'DD/MM/YYYY') tglpengajuan,".
			   "to_char(tglbooked,'DD/MM/YYYY') tglbooked from $DBUser.tabel_901_pengajuan_klaim ".
			 	 "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' and kdklaim='$kdklaim' and ".
				 "to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	$arr=$DB->nextrow();
	$tglpengajuan=$arr["TGLPENGAJUAN"];			
  	$tglbooked=$arr["TGLBOOKED"];			
  	$status=$arr["STATUS"];			
	$otorisasibayar=$arr["OTORISASIBAYAR"];		

		
if ($submit=='Submit') {
  $pertanggungan=$prefix."-".$noper;
  print( "<html>\n" );
  print( "<head>\n" );
  print( "<title>Pengajuan Klaim Tanggal ".$tanggal."</title>\n" );
  print( "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">\n" );
  print( "</head>" );
  print( "<body>" );
	print( "<div align=center>" );
		
			
	$pinjaman    = (!$pinjaman) ? '0.00' : $pinjaman;
	$premi4ac    = (!$premi4ac) ? '0.00' : $premi4ac;
	$bngpremi4ac = (!$bngpremi4ac) ? '0.00' : $bngpremi4ac;
	
				$sql = "select a.nilaibenefit,a.kdbenefit,a.status,b.namabenefit ".
							 "from $DBUser.tabel_905_benefit_klaim a,$DBUser.tabel_207_kode_benefit b ".
							 "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper'".
							 "and a.kdklaim='$kdklaim' and a.kdbenefit=b.kdbenefit and a.nilaibenefit <> 0 ".
							 "and to_char(a.tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
				//echo $sql;
				$DB->parse($sql);
				$DB->execute();
				while ($arr=$DB->nextrow()) {			
				  $nilaibnft += $$arr["KDBENEFIT"];
					//echo $$arr["KDBENEFIT"]." SENILAI ";
					$bnftdiklaim .= $arr["NAMABENEFIT"]." SENILAI ".number_format($arr["NILAIBENEFIT"],2)." atau ".number_format($$arr["KDBENEFIT"],2)." (Hitungan)\n";
				}
				$nilaibnft=($nilaibnft==''||is_null($nilaibnft)) ? 0 : $nilaibnft;
						
	$sql = "update $DBUser.tabel_901_pengajuan_klaim set ".
				"nilaibenefit=$nilaibnft,".
				"useradlog=user,".
			   	"tgladlog=sysdate,status='2' ".
				//"sisagadai=to_number('$pinjaman','999,999,999,999.99'),".
				//"tunggakan=to_number('$premi4ac','999,999,999,999.99'),".
				//"bngtunggakan=to_number('$bngpremi4ac','999,999,999,999.99') ".
 			"where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
				"and kdklaim='$kdklaim' ".
				"and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
	
	
   if ($klp != 'D') { //selain kelompok meninggal
	 		$mailtujuan=$KT->emailxlindo;
		    $emailpengirim=$PWK->emailxlindo;
			$kantortujuan = "KEPALA BAGIAN PERTANGGUNGAN ".$KT->namakantor;
		 
		 	$isin .= "Kepada Yth.\n".$kantortujuan."\ndi Tempat \n\n";
			$isin .= "Perihal : PEMBERITAHUAN\n";
			$isin .= $namaklaim."\n";
		    $isin .= "Berikut ini kami sampaikan bahwa polis berikut :\n\n";
	 	    $isin .= "No \tNomor Polis \tPemegang Polis\n";
        	$isin .= "-----------------------------------------------\n";
			 	$isin .= "1. \t".$pertanggungan." \t".$PER->namapemegangpolis."\n";
			 	$isin .= "-----------------------------------------------\n\n";
				$isin .= "Mengajukan ".$namaklaim." yang jatuh tempo $tglbooked, dengan Benefit \n"; 
				$isin .= $bnftdiklaim;
				$isin .= "Jumlah yang dibayarkan adalah sebesar Rp ".number_format($nilaibnft*$kurs,2)." (Kurs = ".number_format($kurs,2).")\n";			
				if($kdklaim=="CACAT")
				{
				$isin .= "Dengan perincian sebagai berikut.\n\n";
				  $sql = "select a.kd_cacat,a.nilaibenefit, ".
					   				"b.nama_cacat ".
					 				"from ".
										"$DBUser.tabel_905_historis_klaim_pa a, ".
										"$DBUser.tabel_906_pros_cacattetap b, ".
										"$DBUser.tabel_905_benefit_klaim c ".
									"where ".
									  "a.kd_cacat=b.kd_cacat and ".
									  "a.prefixpertanggungan='$prefix' and ".
										"a.nopertanggungan='$noper' and ".
										"a.kdklaim=c.kdklaim and ".
										"a.kdklaim='$kdklaim' and ".
										"a.tglpengajuan=c.tglpengajuan";
					 $DB->parse($sql);
    			 $DB->execute();
    			 $n=1;
    			 while ($arr=$DB->nextrow()) {
					 $isin .= $n.".\t".$arr["NAMA_CACAT"]."\t Rp.".number_format($arr["NILAIBENEFIT"],2,",",".")."\n";
					 $n++;
					 }
				}
				$isin .= "\nKami Telah Memproses Berkasnya dan Pembayaran Siap Dilakukan .\n\n";
			  	$isin .= "Demikian kami sampaikan dan atas \nperhatiannya kami ucapkan terima kasih.\n\n\n";
			  	$isin .= $PWK->kotamadya.", ".$now."\n\n";
		    	$isin .= $PWK->kepala."\n";
				$isin .= "-------------------------------\n";
			 	$isin .= "Kepala Perwakilan \n";
	  		
				mail($mailtujuan,"PEMBAYARAN ".$namaklaim." (".$pertanggungan.")",$isin,"From: $emailpengirim\nReply-To: $emailpengirim\nX-Mailer: PHP/" . phpversion());
	 
				/***********************************end kirim email****************************************/		
   				$sql = "update $DBUser.tabel_901_pengajuan_klaim set emailto='$mailtujuan' ".
					   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
						 "and kdklaim='$kdklaim' ".
						 "and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
				//echo $sql;
				$DB->parse($sql);
				$DB->execute();
	}	
	
	
	 $sql = "begin $DBUser.sip('$prefix','$noper','$kantor','$kdklaim',to_date('$tglpengajuan','DD/MM/YYYY'));end;";
   		//echo $sql;
	 $DB->parse($sql);
	 if ($DB->execute()) {
	 	$sql="select nomorsip from  $DBUser.tabel_901_pengajuan_klaim ".
 			   "where prefixpertanggungan='$prefix' and nopertanggungan='$noper' ".
				 "and kdklaim='$kdklaim' ".
				 "and to_char(tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
	  //echo $sql;
		$DB->parse($sql);
		$DB->execute();
		if ($ari=$DB->nextrow()) {	
			print( "<div align=left>" );
   		print( "<table width=600  bgcolor=#e1f1ff class=sans8>" );
   	 if ($klp != 'D') {
			 print( "	<tr>\n" );
   		 print( "    	<td width=\"100%\" colspan=\"2\" align=\"left\"><pre>$isin</td>\n" );
   		 print( "	</pre></tr>\n" );		 
		 	 print( "	<tr>\n" );
   		 print( "    	<td width=\"100%\" colspan=\"2\" align=\"center\"><hr size=1></td>\n" );
   		 print( "	</tr>\n" );	 
				 print( "	<tr class=arial8>\n" );
   		 print( "    	<td width=\"100%\" colspan=\"2\" align=\"center\">Mail Diatas Terkirim Ke <b>$mailtujuan.</td>\n" );
   		 print( "	</tr>\n" );	 
		 }	

   		 print( "	<tr class=arial8>\n" );
   		 print( "    	<td width=\"100%\" colspan=\"2\" align=\"center\">Nomor SIP :<b>".$ari["NOMORSIP"]."</td>\n" );
   		 print( "	</tr>\n" );
   		 print( "	<tr>\n" );
   		 print( "    	<td width=\"100%\" colspan=\"2\" align=\"center\"><input type=\"submit\" class=\"buton\" name=\"submit\" onclick=\"window.history.go(-1)\" value=\"Back\" ></td>\n" );
   		 print( "	</tr>\n" );
   		 print( "	<tr>\n" );
   		 print( "    	<td width=\"100%\" colspan=\"2\" align=\"center\"><font face=Verdana size=2 color=#3399cc><a href=\"#\" onclick=\"window.location.replace('../akunting/mnuacc.php')\">Menu Akunting</a></td>\n" );
   		 print( "	</tr>\n" );	
   		 print( "</table>	" );  
		}	
	}
						
} elseif ($status=='1' || $otorisasibayar=='1') {

	$sql="select to_char(sysdate,'HH:MI:SS') detiknow,to_char(sysdate,'DD/MM/YYYY') now from dual";
  $DB->parse($sql);
	$DB->execute();
	$w=$DB->nextrow();
	$tanggal = $w["NOW"];	
?>

<html>
<head>
<title>Pengajuan Klaim Tanggal </title>
<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js"></script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/date.js" ></script>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<script language="JavaScript" type="text/javascript">
<!--
function CekSetuju(theForm) {
   if (theForm.setuju.checked) {
	  theForm.submit.disabled=false
   } else {
    theForm.submit.disabled=true
	 }	
 }
//-->
</script>

</head>
<body onLoad="document.propmtc.submit.disabled=true">
<div align="center">
<form method="POST" name="propmtc" action="<? echo $PHP_SELF;?>">
<input type="hidden" name="kdklaim" value="<? echo $kdklaim ?>">
<input type="hidden" name="tglpengajuan" value="<? echo $tglpengajuan ?>">

<table border="0"  cellspacing="0" cellpadding="4" width="800" align="center">
   <tr bgcolor="#a4a4a4">
     <td><b>PERHITUNGAN NILAI KLAIM DAN CETAK SIP</b></td>
   </tr>
   <tr bgcolor="#f5e4d6">
    <td> 
  		 <table border="0" cellpadding="1" cellspacing="1">
  			<tr>
				<td>Tanggal Pengajuan</td>
				<td><input name="tglpengajuan" class="a" readonly value="<? echo $tglpengajuan; ?>"></td>
				</tr>
				<tr>
				<td>Klaim Yang Diajukan</td>
				<td><input name="kdklaim" class="a" readonly value="<? echo $kdklaim; ?>"></td>
				</tr>
  			<tr>
    		<td>Nomor Sertifikat</td>
    		<td>
  			  <input type="text" name="prefix" size="2" maxlength="2" class="a" readonly value="<? echo $prefix;?>">
  				-<input type="text" name="noper" size="10" class="a" onBlur="validasi9(this.form.noper)" readonly value="<? echo $noper;?>">
				</td>
				</tr>	
	   </table>	 
	  </td>
	 </tr>
	 
	 <tr>
    <td align="center" bgcolor="#d5f0ec">
				 <table width="100%" cellpadding="1" cellspacing="1" border="0">
				  <tr bgcolor="#f3e8c2">
					 <td align="center">No</td>
					 <td align="center">Jenis</td>
					 <td align="center">Valuta</td>
					 <td align="center">Nilai</td>
					</tr>	
  					<?
					if($kdklaim=="CACAT")
					{
					 $sql = "select a.kd_cacat,a.nilaibenefit, ".
					   				"b.nama_cacat ".
					 				"from ".
										"$DBUser.tabel_905_historis_klaim_pa a, ".
										"$DBUser.tabel_906_pros_cacattetap b, ".
										"$DBUser.tabel_905_benefit_klaim c ".
									"where ".
									  "a.kd_cacat=b.kd_cacat and ".
									  "a.prefixpertanggungan='$prefix' and ".
										"a.nopertanggungan='$noper' and ".
										"a.kdklaim=c.kdklaim and ".
										"a.kdklaim='$kdklaim' and ".
										"a.tglpengajuan=c.tglpengajuan";
					$DB->parse($sql);
    			 	$DB->execute();
    			 	$n=1;
    			 	while ($arr=$DB->nextrow()) {
					 echo "<tr>";
					 echo "<td align=center>$n.</td>";
					 echo "<td>".$arr["NAMA_CACAT"]."</td>";
					 echo "<td align=center>".($PER->valuta==1 ? "Rp" : "")."</td>";
					 echo "<td align=right>".number_format($arr["NILAIBENEFIT"],2,",",".")."</td>";
					 echo "<tr>";
					 $n++;
					 }
					}
					
  				$kurs=(!$kurs)? $TR->Kurs($PER->valuta) : $kurs;
  				$sql = "select a.nilaibenefit,a.kdbenefit,a.status,b.namabenefit ".
  							 "from $DBUser.tabel_905_benefit_klaim a,$DBUser.tabel_207_kode_benefit b ".
  							 "where a.prefixpertanggungan='$prefix' and a.nopertanggungan='$noper'".
  							 "and a.kdklaim='$kdklaim' and a.kdbenefit=b.kdbenefit and to_char(a.tglpengajuan,'DD/MM/YYYY')='$tglpengajuan'";
  				//echo $sql;
  				$DB->parse($sql);
  				$DB->execute();
  				$i=1;
  				while ($arr=$DB->nextrow()) {
  				$nilai= ($PER->valuta=='0') ? $arr["NILAIBENEFIT"]/$PER->indexawal : $arr["NILAIBENEFIT"];
  				$nilairp=$nilai*$kurs;
  				$kdbnft=$arr["KDBENEFIT"];
  				 echo "<tr bgcolor=#c0c0c0>";
    			 echo "<td align=\"center\">".
					 				"<input type=hidden name=nama$kdbnft value=".$arr["NAMABENEFIT"].">".
									"<input type=hidden name=$kdbnft value=".round($nilai,2).">".
									"<input type=hidden name=kdklaim value=\"".$kdklaim."\">".
									"</td>" ;
    			echo "<td align=\"left\">".($kdklaim=="CACAT" ? "Jumlah" : "$kdklaim")."</td>" ;
   			   	echo "<td align=\"center\">".$PER->notasi."</td>";
    			echo "<td align=\"right\">".number_format($nilairp,2,",",".")."</td>" ;
   			   	echo "</tr>";
  				 
  				 $i++;
  				}		
    			 print( "<input type=\"hidden\" name=\"kurs\" value=$kurs> " );
  				?>	
				</table>

		 </td>
		</tr>
		<tr bgcolor="#f0ebbd">
    	   <td align="left">Nama Penerima Manfaat <input type="text" name="penerima" size="30" maxlength="30" onFocus="highlight(event)" class="c" value="<? echo $PER->namapemegangpolis; ?>"><font color="red">Ganti Jika Ingin Lain</td>
		</tr>
		<tr bgcolor="#cff2b0">
    	   <td align="left">
				 <input type="checkbox" name="setuju" value="1" onClick="CekSetuju(document.propmtc)">Cek Untuk Melanjutkan Proses 
				 <input type="submit" name="submit" value="Submit">
				 </td>
		</tr>		
</table>

<table width="800">
  <tr>
    <td width="50%" align="left"><a href="../akunting/mnuacc.php">Menu Akunting</a></td>
		<td width="50%" align="right"></td>
	</tr>
</table>

</form>
</div>
</body>
</html>
<?  } else {

 ?>
<table width="800">
  <tr>
    <td width="50%" align="left"><font face="Verdana" size="2"><a href="../akunting/mnuacc.php">Menu Akunting</a></td>
		<td width="50%" align="right"><font face="Verdana" size="2"><b></td>
	</tr>
</table>
<? } ?>