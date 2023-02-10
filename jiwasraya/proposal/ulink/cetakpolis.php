<?
  include "./includes/database.php"; 
  include "./includes/session.php"; 
	include "./includes/common.php";
  include "./includes/pertanggungan.php";	
	include "./includes/duit.php";

 $DB=New database($userid, $passwd, $DBName);
	$DC = New database($userid, $passwd, $DBName);;
  //echo $jnsusr.$modul;


/*--------------------------------------------------
Author : Iie Sumitra
Date   : 19 Jul 2013
Desc   : tambahan untuk cek jumlah dokumen ke SAE 
*/
define("HOSIE","MTkyLjE2OC4yLjY=");
define("USRIE", "cm9vdA==");
define("PWDIE","YWRtMW5kYXRhYmFzZXNtNFJU"); 
define("DBNIE","aml3YXNyYXlhX2RvY21hbmFnZXJkYg==");

/*
$connSae = mysql_connect(base64_decode(HOSIE), base64_decode(USRIE), base64_decode(PWDIE));
if (!$connSae) die ("Gagal Melakukan Koneksi ke SAE");
mysql_select_db(base64_decode(DBNIE),$connSae) or die ("Database Tidak Diketemukan di Server SAE");
*/
if (isset($ulang)) {
$sql="update $DBUser.tabel_200_pertanggungan set tglcetak=null where prefixpertanggungan=upper('".$_POST['pfx']."') and nopertanggungan='".$_POST['ptg']."'";
//echo $sql;
$DB->parse($sql);
$DB->execute();
}
if (isset($ulang1)) {
$sql="update $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN set kdcetaktterima=null, tglcetaktterima=null, usercetaktterima=null where prefixpertanggungan=upper('".$_POST['pfx1']."') and nopertanggungan='".$_POST['ptg1']."'";
//echo $sql;
$DB->parse($sql);
$DB->execute();
}

if($_POST['sbmt'] == '1')
{
	$cheklist = $_POST['cheklist'];
	//echo "<font face=\"Verdana\">Daftar kirim email yang sukses : </font><br><font face=\"Verdana\" size=1 color=blue><b>";
	$x=1;
	for($i=0; $i<sizeof($cheklist); $i++)
	{
		$NoPolis = $cheklist[$i];
		$sqlUpd = "INSERT INTO $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN (PREFIXPERTANGGUNGAN,
                                          NOPERTANGGUNGAN,
                                          KDACCEPTANCE,
                                          TGLACCEPTANCE,
                                          USERUPDATED)
				  VALUES   ('".substr(".$NoPolis.",1,2)."',
							'".substr(".$NoPolis.",3,9)."',
							1,
							sysdate,
							'$userid')";
		$DB->parse($sqlUpd);
		$DB->execute();
		//echo $DB->error;
		//echo $sqlUpd;
		//$conn = ocilogon($userid, $passwd, "JSDB");
  //$query="DELETE FROM $DBUser.SLIP_DUMMY where kdbatch='$batchs' and kdkantor='$kantor'";
  //$sql= ociparse($conn, $sqlUpd);
  //ociexecute($sql);
		//echo $x.". ".$NoPolis."<br>";
		$x++;
	}
	echo "</b></font><hr><br><br>";

}

/*------------------------------------end Of Iie Sumitra:19Jul2013--------------*/



?>
<link href="./jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js" ></script>
<? include "./includes/hide.php";  ?>
<font face="Verdana" size="2"><b>DAFTAR CETAK POLIS</b><br>
Kantor : <?echo $kantor; ?>


<!--
<li><b>Perhatikan Syarat agar portofolio bisa dikirim emailnya antara lain:<br></b>
Penagih TIDAK KOSONG, untuk Polis Non Medical, sudah dilunasi, untuk Polis Medical, Data Keterangan Kesehatan Sudah Lengkap -->

<!--
<font color="red"><b>Catatan :</b></font><br>
Bentuk pengiriman data proposal yang dilakukan dengan benar, minimal pada tanggal 5 setiap 
bulan, <b>Kolom Transaksi Produk</b> untuk <b>Poposal Medical</b> dan <b>Non Medical</b> 
pada </a><a class="verdana8blu" href="showendbillingkantor.php">halaman Produksi Bulanan</a> 
<a class="verdana8blu">harus kosong.
</a> -->
<br><br>
<form name="xxx" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
<? if ($userid=='CETAK') {} else {?>
<input type="text" size="5" name="pfx" /><input type="text" size="25" name="ptg" /><input type="submit" name="ulang" value="CETAK ULANG POLIS" /><br>
<input type="text" size="5" name="pfx1" /><input type="text" size="25" name="ptg1" /><input type="submit" name="ulang1" value="CETAK ULANG PENGANTAR" />
<? }?><br/>
<a href="./cetaktt.php" >MENU CETAK TANDA TERIMA POLIS</a>&nbsp;<a href="./tercetak.php" >POLIS TERCETAK</a>
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">

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
		<!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>DOK.SAE</b></font></td> -->
		<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>ACTION</b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
  </tr>
	<?
  //------------------------------------------------------ Non Medical ------------------
/*
AND (select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran h ".
    						 "where  a.prefixpertanggungan = h.prefixpertanggungan ".
    						 "AND a.nopertanggungan = h.nopertanggungan ".
								 "and h.kdpembayaran in ('001','002','005') ) >= 0
*/


	$sql= "select ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,".
    				"a.lamaasuransi_th,a.premi1,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0),0) nilaipembayaran ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
    				"a.kdstatusemail='1' ".
					"AND substr(a.kdproduk,1,3) in ('JL4') ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				//"AND a.prefixpertanggungan = '$kantor' ".
    				"AND a.kdstatusmedical IN  ('N','M') ".
    				"AND a.kdpertanggungan = '2' ".
					"AND a.tglcetak is null ".
    				"AND a.kdstatusfile in ('1','4') ".
					" and exists (select 'x' from $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ".
    				"ORDER BY a.mulas";
		//echo $sql;		
	$DB->parse($sql);
	$DB->execute();

	while($arr=$DB->nextrow()){
	
	//echo $arr["KDSTATUSMEDICAL"];
	   $i = 0;
		 $i = $count + 1;
  
	switch ($arr["KDSTATUSMEDICAL"]) {
	   case 'N' :  $statusmedical = "<font color=blue><b>N</b></font>"; break;
	   case 'M' :  $statusmedical = "<font color=red><b>M</b></font>"; break;
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
		  
	//$total = $nilairp + $biayapolis + $materai;
	$total = $nilairp;
	$grandtotal = $total - $suspend;
	
	$juarp = ($PERT->valuta=='0') ? $PERT->jua  : $PERT->jua * $TR->Kurs($PERT->valuta,$tglbp3);
	
	#----------------------------[ END CEK PELUNASAN PREMI ]----------------------------
	
	 ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('./polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namapemegangpolis;?><?// echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namatertanggung;?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical;?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
    <!-- <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"> --> <? 
	
    $numrowsDocSae = 0;

/*ga jadi karena berat loading nya : 23 jul 2013/ iie*/
	/*
	  $query = "select DISTINCT a.type_id from t_dokumen a where a.type_id in ('SPAJ','PROPOSAL SPAJ','BP3','BUKTI TRANSFER') AND  a.no_polis = '".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."'";
	$result = mysql_query($query);
	$numrowsDocSae = mysql_num_rows($result);
	 
	 echo $numrowsDocSae;
	 
	 */
	 ?><!--</font></td> -->
		<? 
			
				$cebox = "<input type=\"checkbox\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">"; 
			
			 // jika ada kekurangan premi
			 /*if(round($arr["NILAIPEMBAYARAN"],2)>=round($total,2)){
			 	  $catatan = $cebox;
			 } else {
			    $catatan = "<font color=red>BP3 KURANG </font>";
			 }*/
			 
			 if(round($arr["NILAIPEMBAYARAN"]*1,2) < round($total*1,2)){
			 	$catatanx = "<font color=red>BP3 KURANG/BLM BAYAR </font>";  
				//echo 'kampret';
			 } else {
			    $catatanx = $cebox;
				//echo 'kampret ok';
			 }
			 //echo $nilairp;
			 // echo $PERT->premi1; 
			 //echo $TR->Kurs($PERT->valuta,$tglbp3);
			 //echo $PERT->valuta;
			 //echo $tglbp3;
			 
			 
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
			 
		$sqltt = "select decode(tglcetaktterima,null,'OK', tglcetaktterima) TT ".
	   		 	 "from $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN ".
	  		 	 "where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' ";
	 //echo $sqltt;
	 $DC->parse($sqltt);
	 $DC->execute();
	 $artt=$DC->nextrow();
	 if($artt["TT"]=='OK') {
	 	//$tandaterima="<font face=\"Verdana\" size=\"1\"><a href=# onclick=\"NewWindow('../../polis/tanda_terima.php?prefixpertanggungan=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">T.TERIMA</a></font>";
	 } else{ $tandaterima="";}
		
		
		$nextpage="test.cetak.polis.link2.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&nopertanggungan=".$arr["NOPERTANGGUNGAN"]."";
		
		
			// echo "<td bgcolor=\"#FFFFFF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><a href=# onclick=\"window.location.replace('".$nextpage."')\">LANJUT</a></font></td>";	
	    //echo "<td bgcolor=\"#FFFFFF\" align=\"center\"><font face=\"Verdana\" size=\"1\"><a href=# onclick=\"NewWindow('".$nextpage."','',800,500,1)\">CETAK</a></font></td>"; 
		echo "<td bgcolor=\"#FFFFFF\" align=\"center\">".$tandaterima."<font face=\"Verdana\" size=\"1\">&nbsp;<a href='".$nextpage."'\">CETAK</a></font></td>"; 
		?>
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
					      //"(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                 //"where kdstatusunderwriting='0' ".
                // "and a.prefixpertanggungan=b.prefixpertanggungan ".
                // "and a.nopertanggungan=b.nopertanggungan)=0 ".
                " a.prefixpertanggungan='$kantor' and a.kdstatusemail ='1' ".
      					"and a.nopenagih is not null ".
      					"and a.kdpertanggungan='2' ".
                "and a.kdstatusfile in ('1','4') ".
				"and a.kdproduk like 'JL4%' ".
				//"and a.tglcetak is null ".
				//"AND substr(a.kdproduk,1,3) in ('JL4') ".
      					//"and a.kdstatusmedical='M' ".
						"and exists (select 'x' from $DBUser.TABEL_214_ACCEPTANCE_DOKUMEN
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
  //echo $sql;
  //die;
	$DB->parse($sqlxx);
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
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('./polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namapemegangpolis;?></font></td>
    <td width="10%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$PERT->namatertanggung;?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; ?></font></td>
		<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
    <!--<td width="4%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"> --> <?
	

	/*ga jadi karena berat loading nya : 23 jul 2013/ iie*/
	/*
	 $query = "select DISTINCT a.type_id from t_dokumen a where a.type_id in ('SPAJ','PROPOSAL SPAJ','BP3','BUKTI TRANSFER') AND  a.no_polis = '".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."'";
	$result = mysql_query($query);
	$numrowsDocSae = mysql_num_rows($result);
	 
	 //echo number_format($arr["NILAIPEMBAYARAN"],2); 
	 echo $numrowsDocSae; 
	 */
	 
	 
	 ?><!--</font></td> -->
		<?php
		

		
				$cebox = "<input type=\"checkbox\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">"; 
			


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
	  <td class="verdana10blk"></td>
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
		<input type="hidden" value="1" name="sbmt">
	 <!-- <input type="submit" value="Akseptasi" name="sendemail">
		
		<font face="Verdana" size="1" color="red">
		<b>Proses kirim email ke HO untuk proposal Medical dan proses underwriting untuk proposal Non medical 
	  </b>
		</font>
		<input type="submit" value="Proses" name="sendemail">
		-->
		</td>
	</tr>
	
</table>
<a href="./cetaktt.php" >MENU CETAK TANDA TERIMA POLIS</a> &nbsp;<a href="./tercetak.php" >POLIS TERCETAK</a>
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

//mysql_close($connSae);
//}


 ?>
<tr>
<td><font face="verdana" size="2"><a href="../mnuptgbaru.php">Menu Pertanggungan Baru</a></font></td>
<td><!--<font face="verdana" size="2"><a href="emailterkirim.php">&nbsp;&nbsp;&nbsp;&nbsp;Check Pengiriman Email</a>--></font></td>
</tr>
</table>

</form>