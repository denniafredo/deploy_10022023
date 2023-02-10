<?
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  include "../../includes/pertanggungan.php";	
	include "../../includes/duit.php";

  $DB = new Database($userid, $passwd, $DBName);
	$DC = new Database($userid, $passwd, $DBName);
  //echo $jnsusr.$modul;
?>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<? include "../../includes/hide.php";  ?>
<font face="Verdana" size="2"><b>PEMBERITAHUAN PROPOSAL MELALUI EMAIL</b><br>
Kantor : <?echo $kantor; ?>
<hr size="1">
<a class="verdana8blu">
<font color="red"><b>Perhatikan, Agar dibaca dengan seksama ! </b></font><br>
<ol type="1">
<li>Sekali proposal dikirim berarti Anda telah memeriksa dan menyetujui sesuai ketentuan
underwriting yang berlaku.</li>
<li>Setelah proposal dikirim maka terhadap data SPAJ dimaksud tidak dapat dikoreksi. </li>
<li>Untuk kasus terjadi kesalahan entry atau pengiriman, sejauh belum dilakukan akseptasi oleh Kepala Bagian
Pertanggungan RO, jika ingin dikoreksi, harus sepengetahuan Kepala Bagian Pertanggungan 
RO baru kemudian pengajuannya disampaikan kepada Divisi Pertanggungan Perorangan</li>
<li><b>Perhatikan Syarat agar portofolio bisa dikirim emailnya antara lain:<br></b>
Penagih TIDAK KOSONG, untuk Polis Non Medical, sudah dilunasi, untuk Polis Medical, Data Keterangan Kesehatan Sudah Lengkap

</ol>
<font color="red"><b>Catatan :</b></font><br>
Bentuk pengiriman data proposal yang dilakukan dengan benar, minimal pada tanggal 5 setiap 
bulan, <b>Kolom Transaksi Produk</b> untuk <b>Poposal Medical</b> dan <b>Non Medical</b> 
pada </a><a class="verdana8blu" href="showendbillingkantor.php">halaman Produksi Bulanan</a> 
<a class="verdana8blu">harus kosong.
</a>
<br><br>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="sendmailprop.php">
  <tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.
      POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="2" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JML UANG ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MAC ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MED</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NILAI PEMBAYARAN</b></font></td>
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CHECK</b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
  </tr>
	<?
  //------------------------------------------------------ Non Medical ------------------

	$sql= "select ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,".
    				"a.lamaasuransi_th,a.premi1,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"(select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0) nilaipembayaran ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
    				"a.kdstatusemail is null ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				"AND a.prefixpertanggungan = '$kantor' ".
    				"AND a.kdstatusmedical = 'N' ".
    				"AND a.kdpertanggungan = '1' ".
    				"AND a.kdstatusfile = '1' ".
    				"AND (select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran h ".
    						 "where  a.prefixpertanggungan = h.prefixpertanggungan ".
    						 "AND a.nopertanggungan = h.nopertanggungan ".
								 "and h.kdpembayaran in ('001','002','005') ) > 0";
		//echo $sql;
	$DB->parse($sql);
	$DB->execute();

	while($arr=$DB->nextrow()){
	   $i = 0;
		 $i = $count + 1;
  
	switch ($arr["KDSTATUSMEDICAL"]) {
	   case 'N' :  $statusmedical = "<font color=blue><b>N</b></font>"; break;
	}
	$premi = $arr["PREMI1"];
	$biayapolis = $arr["BIAYAPOLIS"];
	$biayamaterai = $arr["BIAYAMATERAI"];
	$jumlahbayar = $premi + $biayapolis + $biayamaterai;
	$nopertn = $arr["NOPERTANGGUNGAN"];
	
	#----------------------------[ START CEK PELUNASAN PREMI ]----------------------------
	
	 $PERT = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	 $DU   = New Duit ($userid,$passwd);
	 $TR   = New Transaksi ($userid,$passwd);
	 $sqlx = "select sum(nilaipembayaran) totalbayar,sum(premi) premisb,".
	 			   "sum(biayamaterai) sumbm,sum(biayapolis) sumbp ".
	   		 	 "from $DBUser.tabel_800_pembayaran ".
	  		 	 "where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' ".
	  			 "and  kdpembayaran in ('002','005','001')";
	 //echo $sqlx;
	 $DC->parse($sqlx);
	 $DC->execute();
	 $arx=$DC->nextrow();
	
	#*******************************premi**********************************
	
	$suspend=$arx["TOTALBAYAR"];
	$sumbm=$arx["SUMBM"];
	$sumbp=$arx["SUMBP"];
	$premisb=$arx["PREMISB"];
	$premi = $PERT->premi1-$premisb; //kekurangan premi
	
	$tglbp3 = ($PERT->tglbp3=='') ? $PERT->sysdate : $PERT->tglbp3;
	$kursbayar = $TR->Kurs($PERT->valuta,$tglbp3);
	$nilairp = ($PERT->valuta=='0') ? $PERT->premi1  : $PERT->premi1 * $TR->Kurs($PERT->valuta,$tglbp3);
//	echo "Ari ".$nilairp." - ".$PERT->premi1." - ".$TR->Kurs($PERT->valuta,$tglbp3);
	
	$biayapolis = $DU->BeaPolis($PERT->produk,$PERT->sysdate);
	
	$materai= $DU->MatreAktaPolis() + $DU->Matre($nilairp);
		  
	$total = $nilairp + $biayapolis + $materai;
	$grandtotal = $total - $suspend;
	
	$juarp = ($PERT->valuta=='0') ? $PERT->jua  : $PERT->jua * $TR->Kurs($PERT->valuta,$tglbp3);
	
	#----------------------------[ END CEK PELUNASAN PREMI ]----------------------------
	
	 ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namapemegangpolis;?><?// echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namatertanggung;?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["NILAIPEMBAYARAN"],2); ?></font></td>
		<? 
			 $cebox = ($arr["NILAIPEMBAYARAN"]==0) ? '' : "<input type=\"checkbox\" name=".$arr["NOPERTANGGUNGAN"]." value=\"ON\">"; 
			 // jika ada kekurangan premi
			 if(round($arr["NILAIPEMBAYARAN"],2)>=round($total,2)){
			 	  $catatan = $cebox;
			 } else {
			    $catatan = "<font color=red>BP3 KURANG </font>";
			 }
			 
			 //echo $nilairp;
			 // echo $PERT->premi1; 
			 //echo $TR->Kurs($PERT->valuta,$tglbp3);
			 //echo $PERT->valuta;
			 //echo $tglbp3;
			 
			 if($nilairp >= 100000 || substr($PERT->produk,0,2)=="PA"){ //
			 	  $catatan = $cebox;
			 } else {
			    $catatan = "<font color=red>Premi < Rp.100.000,-</font>";
			 }
			 // jika jua kurang dari jua minimal produk
			 // permintaan sesuai kerjasama
		   
			 if($modul=="ALL"||$modul=='ITC'){
			      $catatan = $cebox;
       } else {
    			 if($arr["JUAMINIMAL"]!=""){
      			 if($juarp>=$arr["JUAMINIMAL"]){
      			    $catatan = $cebox;
      			 } else {
      			    $catatan = "<font color=red>* JUA < Rp.".number_format($arr["JUAMINIMAL"],0).".-</font>";
      			 }
    			 }
			 }
			 
			 
		?>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $catatan; ?></font></td>
</tr>
	<? 
	$count++;
	} 
	
//-------------------------------------------------- start medical --------------------------------
	$sql  = "select ".
      				  "a.prefixpertanggungan,a.nopertanggungan,".
      	        "a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.lamaasuransi_th,".
								"a.premi1,a.kdstatusmedical,a.juamainproduk,".
      					"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    						"decode(a.kdvaluta,'0','RpI','1','Rp ','3','US$') notasi ".//, ".
					"from ".
								"$DBUser.tabel_200_pertanggungan a ".
          "where ".
					      "(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                 "where kdstatusunderwriting='0' ".
                 "and a.prefixpertanggungan=b.prefixpertanggungan ".
                 "and a.nopertanggungan=b.nopertanggungan)=0 ".
                "and a.prefixpertanggungan='$kantor' and a.kdstatusemail is null ".
      					"and a.nopenagih is not null ".
      					"and a.kdpertanggungan='1' ".
                "and a.kdstatusfile = '1' ".
      					"and a.kdstatusmedical='M'";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();

	while($arr=$DB->nextrow()){
	$PERT = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	$TR   = New Transaksi ($userid,$passwd);
	$tglbp3 = ($PERT->tglbp3=='') ? $PERT->sysdate : $PERT->tglbp3;
	$nilairp = ($PERT->valuta=='0') ? $PERT->premi1  : $PERT->premi1 * $TR->Kurs($PERT->valuta,$tglbp3);
	$juarp = ($PERT->valuta=='0') ? $PERT->jua  : $PERT->jua * $TR->Kurs($PERT->valuta,$tglbp3);
	
	   $i = 0;
		 $i = $count + 1;
  
	switch ($arr["KDSTATUSMEDICAL"]) {
	   case 'M' : $statusmedical = "<font color=green><b>M</b></font>"; break;
	}
	$nopertm = $arr["NOPERTANGGUNGAN"];
	 ?>
  <tr>
    <td width="5%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namapemegangpolis;?></font></td>
    <td width="10%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namatertanggung;?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; ?></font></td>
		<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
    <td width="4%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["NILAIPEMBAYARAN"],2); ?></font></td>
		<?php
		$cebox = "<input type=\"checkbox\" name=".$arr["NOPERTANGGUNGAN"]." value=\"ON\">"; 
			 //jika premi kurang dr rp.100.000,-
			 if($nilairp >= 100000 || substr($PERT->produk,0,2)=="PA"){ //
			 	  $catatan = $cebox;
			 } else {
			    $catatan = "<font color=red>Premi < Rp.100.000,- </font>";
			 }
			 // jika jua kurang dari jua minimal produk
			 if($modul=="ALL"||$modul=='ITC'){
			      $catatan = $cebox;
       } else {
			    if($arr["JUAMINIMAL"]!=""){
      			 if($juarp>=$arr["JUAMINIMAL"]){
      			    $catatan = $cebox;
      			 } else {
      			    $catatan = "<font color=red>JUA < Rp.".number_format($arr["JUAMINIMAL"],0).".-</font>";
      			 }
    			 } else {
    			   $catatan = $cebox;
    			 }
			 }
		?>
    <td width="4%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?echo $catatan;?></font></td>
  </tr>
	<? 
	$count++;
	} ?>
	<!--------------------------------- end medical ----------------->
</table>

<table border="0" width="100%" cellspacing="1" cellpadding="2">
  <tr>
	  <td class="verdana10blk"><font color="red">*</font> Ijin KP</td>
    <td align="right">
		<input type="hidden" value="<? echo $statusmedical; ?>" name="cek"> 
		<? 
		 if ($nopertm == "") {
		 } else {
		 ?>
		<input type="hidden" value="M" name="medical"> 
		<? 
		 } 
		 if ($nopertn == "") {
		 } else {
		 ?>
		<input type="hidden" value="N" name="nonmedical">
		<? } ?>
	  <input type="submit" value="Kirim Email" name="sendemail">
		<!--
		<font face="Verdana" size="1" color="red">
		<b>Proses kirim email ke HO untuk proposal Medical dan proses underwriting untuk proposal Non medical 
	  </b>
		</font>
		<input type="submit" value="Proses" name="sendemail">
		-->
		</td>
	</tr>
	</form>
</table>

<script language="javascript">
function checkifempty(){
if (document.xxx.cek.value=='')
document.xxx.sendemail.disabled=true
else
document.xxx.sendemail.disabled=false
}
if (document.all)
setInterval("checkifempty()",100)
</script>
<hr size="1">
<table>
<? 
//}
 ?>
<tr>
<td><font face="verdana" size="2"><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></font></td>
<td><font face="verdana" size="2"><a href="emailterkirim.php">&nbsp;&nbsp;&nbsp;&nbsp;Check Pengiriman Email</a></font></td>
</tr>
</table>

