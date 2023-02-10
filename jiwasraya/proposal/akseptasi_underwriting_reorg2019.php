<?php
//DEMO MODE
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";	
  include "../../includes/duit.php";
  include "../../includes/koneksi.php";
  //error_reporting(E_ALL); 
  //ini_set('display_errors', 1);
/* 
  $connstring = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.2.17)(PORT = 1521))
        (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = DIKLAT)))";
  $userid = 'DIKLAT3';
  $passwd = 'DIKLAT';
  
  $DB = new Database($userid,$passwd,$connstring);
  $DC = new Database($userid,$passwd,$connstring); 
  $DSMS = new Database($userid,$passwd,$connstring); */
  
  $DB = new database($userid, $passwd, $DBName);
  $DC = new database($userid, $passwd, $DBName);
  $DL = new database($DBUser, $DBPass, $DBName);
  $DSMS = new database($userid, $passwd, $DBName);
  //echo $jnsusr.$modul;
/* 			$api_host = 'https://ecollection.jiwasraya.co.id:4433/';
			$url = $api_host."api_bni_va/get.php?act=get_trxid";
			$p = shell_exec('curl -k '.$url);
			
			$trxid = FALSE;
			if($trx = json_decode($p,true)){
				if($trx['status']){
					$trxid = $trx['trxid'];
				}
			}
			echo $trxid; */

/*--------------------------------------------------
Author : Iie Sumitra
Date   : 19 Jul 2013
Desc   : tambahan untuk cek jumlah dokumen ke SAE 
*/
define("HOSIE","MTkyLjE2OC4yLjY=");
define("USRIE", "cm9vdA==");
define("PWDIE","YWRtMW5kYXRhYmFzZXNtNFJU"); 
define("DBNIE","aml3YXNyYXlhX2RvY21hbmFnZXJkYg==");


//$connSae = mysql_connect(base64_decode(HOSIE), base64_decode(USRIE), base64_decode(PWDIE));
//if (!$connSae) die ("Gagal Melakukan Koneksi ke SAE");
//mysql_select_db(base64_decode(DBNIE),$connSae) or die ("Database Tidak Diketemukan di Server SAE");

if(isset($_POST['rijek']))
{
	$cheklist = $_POST['cheklist'];
	//echo "<font face=\"Verdana\">Daftar kirim email yang sukses : </font><br><font face=\"Verdana\" size=1 color=blue><b>";
	$x=1;
	for($i=0; $i<sizeof($cheklist); $i++)
	{
		$NoPolis = $cheklist[$i];
		$sqlrjk = "UPDATE $DBUser.TABEL_200_pertanggungan set kdstatusemail=null
				   where prefixpertanggungan='".substr(".$NoPolis.",1,2)."' and nopertanggungan='".substr(".$NoPolis.",3,9)."'";
		$DB->parse($sqlrjk);
		$DB->execute();
		//echo $sqlrjk;
		//echo 'reject';
		//echo $x.". ".$NoPolis."<br>";
		$x++;
	}
	echo "</b></font><hr><br><br>";

}

if(isset($_POST['unapprove']))
{
	$cheklist = $_POST['cheklist'];
	//echo "<font face=\"Verdana\">Daftar kirim email yang sukses : </font><br><font face=\"Verdana\" size=1 color=blue><b>";
	$x=1;
	for($i=0; $i<sizeof($cheklist); $i++)
	{
		$NoPolis = $cheklist[$i];
		$sqlrjk = "begin $DBUser.unapprove_proposal('".substr(".$NoPolis.",1,2)."','".substr(".$NoPolis.",3,9)."');end;";
		$DB->parse($sqlrjk);
		$DB->execute();
		//echo $sqlrjk;
		//echo 'reject';
		//echo $x.". ".$NoPolis."<br>";
		$x++;
	}
	echo "</b></font><hr><br><br>";

}

if(isset($_POST['sendemail']) && $kantor="KP"){
//if($_POST['sbmt'] == '1'){
	$cheklist = $_POST['cheklist'];
	//echo "<font face=\"Verdana\">Daftar kirim email yang sukses : </font><br><font face=\"Verdana\" size=1 color=blue><b>";
	$x=1;
	for($i=0; $i<sizeof($cheklist); $i++)
	{
		$NoPolis = $cheklist[$i];
		$sqlUpd = "INSERT INTO $DBUser.TABEL_214_UNDERWRITING (PREFIXPERTANGGUNGAN,
                                          NOPERTANGGUNGAN,
                                          KDUNDERWRITING,
                                          TGLUNDERWRITING,
                                          USERUPDATED)
				  VALUES   ('".substr(".$NoPolis.",1,2)."',
							'".substr(".$NoPolis.",3,9)."',
							1,
							sysdate,
							'$userid')";
        echo $sqlUpd;
		$DB->parse($sqlUpd);
		$DB->execute(); 

        //Update Suspend & Keterangan
        $sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = NULL, keterangan = NULL 
                WHERE prefixpertanggungan = '".substr(".$NoPolis.",1,2)."'
                    AND nopertanggungan = '".substr(".$NoPolis.",3,9)."'";
        $DB->parse($sql);
        $DB->execute();

		//================SMS SENDING================
		$sms="SELECT   A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN NOPOLIS,A.PREFIXPERTANGGUNGAN,A.NOPERTANGGUNGAN,
				 NOACCOUNT,
				 (SELECT   MAX (NVL(NILAIRP,PREMITAGIHAN))
					FROM   $DBUser.TABEL_300_HISTORIS_PREMI
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND KDKUITANSI = 'BP3')
				 + (SELECT   SUM (NILAI)
					  FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
					 WHERE       prefixpertanggungan = b.prefixpertanggungan
							 AND nopertanggungan = b.nopertanggungan
							 AND JENIS = 'B')".
				"+ NVL((SELECT   SUM (PREMI)
                      FROM   $DBUser.TABEL_223_transaksi_produk
                     WHERE       prefixpertanggungan = b.prefixpertanggungan
                             AND nopertanggungan = b.nopertanggungan
                             AND KDBENEFIT = 'BNFTOPUPSG'),0)".	
         " PREMI,
				 (SELECT   TO_CHAR (EXPIREDDATE, 'DD/MM/YYYY') EXPDATE
					FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND JENIS = 'B')
					EXPDATE,
					
					(SELECT   TO_CHAR (EXPIREDDATE, 'yyyy-mm-dd') EXPDATE
					FROM   $DBUser.TABEL_300_TAGIHAN_PERTAMA
				   WHERE       prefixpertanggungan = b.prefixpertanggungan
						   AND nopertanggungan = b.nopertanggungan
						   AND JENIS = 'B')
					EXPDATE2,
					
				 REGEXP_REPLACE((SELECT   NVL(NO_PONSEL, PHONETETAP02)
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOPEMEGANGPOLIS),'[^0-9]+', '')
					PHONE,
				 REGEXP_REPLACE((SELECT   NVL(NO_PONSEL, PHONETETAP01)
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOAGEN),'[^0-9]+', '')
					PHONEAGEN,
				 (SELECT   NAMAKLIEN1
					FROM   $DBUser.TABEL_100_KLIEN
				   WHERE   NOKLIEN = NOPEMEGANGPOLIS)
					NAMA,c.kdproduk,
					(select kdmapping from $DBUser.TABEL_001_KANTOR where kdkantor=c.prefixpertanggungan )||c.nopertanggungan h2h
		  FROM   $DBUser.TABEL_214_UNDERWRITING a,
				 $DBUser.TABEL_100_KLIEN_ACCOUNT b,
				 $DBUser.TABEL_200_PERTANGGUNGAN c
		 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
				 AND a.nopertanggungan = b.nopertanggungan
				 AND a.prefixpertanggungan = c.prefixpertanggungan
				 AND a.nopertanggungan = c.nopertanggungan
				 AND a.prefixpertanggungan = '".substr(".$NoPolis.",1,2)."'
				 AND a.nopertanggungan = '".substr(".$NoPolis.",3,9)."'
				 AND b.kdbank = 'BNI'
				 AND c.KDPRODUK NOT IN ('JSPBTN','JSSHTBBTN','JSSHTBU','JSPNBTN',
										'JSSHTKBTN',
										'JSSHTSBTN',
										'JSSHTTBTN',
										'JSSHTXBTN','JSSPHANA')";
		//echo $sms;
		$DSMS->parse($sms);
		$DSMS->execute();
		$arsms=$DSMS->nextrow();
		
		//Berdasarkan Email Pak Ari Faisal A. Pada tanggal 04/11/2014
    //$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", harap lakukan pembayaran premi via Host To Host Mandiri&BRI ".
			// $arsms["H2H"]." sebesar ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"]." Utk info hub 021-500151";
    if($arsms["KDPRODUK"]!="JSSPD1"){ // khusus untuk JS Plan Dollar tidak ada SMS karena Premi BP3 Sudah dibayar ke BO masing2 : Dedi 05/11/2014
	if(substr($arsms["KDPRODUK"],-3)!="BTN"){	
    
		$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", permohonan asuransi Anda DISETUJUI,Lakukan pemb premi melalui cara bit.ly/bayarpremi dg kode bayar ".
			 $arsms["H2H"]." Rp. ".$arsms["PREMI"].". Info 1500151";	 
		//===================SMS AGEN================
		$msgagn="Harap infokan CPP a/n ".$arsms["NAMA"]." utk membayar premi melalui cara berikut bit.ly/bayarpremi dg kode bayar ".$arsms["H2H"].", sebesar Rp ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"];
			 
	
	
		//echo $msg;
		
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONE"]."','".$msg."')";
		//$arsms["PHONE"] = "628170097605";
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONE"]."','".$msg."','TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
		 //echo $mysqlins;
		mysql_query($mysqlins);
		
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONEAGEN"]."','".$msgagn."')";
		$mysqlinsagn="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONEAGEN"]."','".$msgagn."','TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
		 //echo $mysqlins;
		mysql_query($mysqlinsagn);

		// ===================== CREATE VA BNI (PROD) ===========================//
		// ===================== CREATE VA BNI (PROD) ===========================//
			//curl inquiry ke 1.26 ecollection VA
			
			$api_host = 'http://192.168.1.26/ecollect/';
			$file = '/var/www/jiwasraya/proposal/logs_bp3_va/debugsql.'.date('Ymd').'.txt';
			
			$url = $api_host."api_bni_va/get.php?act=get_trxid";
			$p = shell_exec('curl -k '.$url);
			
			$trxid = FALSE;
			if($trx = json_decode($p,true)){
				if($trx['status']){
					$trxid = $trx['trxid'];
				}
			}

			$url = $api_host."api_bni_va/get.php?act=get_va\&nopolis=".$arsms['PREFIXPERTANGGUNGAN'].$arsms['NOPERTANGGUNGAN'];

			$noaccount = FALSE;
			$client_id = FALSE;
			
			$p = shell_exec('curl ' . $url);
			
			//file_put_contents($file, 'curl ' . $url.'||'. $p.PHP_EOL, FILE_APPEND | LOCK_EX);
			
			if($va = json_decode($p,true)){
				if($va['status']){
					$noaccount = $va['no_va'];
					$client_id = $va['client_id'];
				}
			} 

			//file_put_contents($file, $url.'||'.$noaccount.'||'.$client_id.PHP_EOL, FILE_APPEND | LOCK_EX);
			
			$p_host = $api_host."api_bni_va/inquiry.php";
			
			$thepost = FALSE;
 
			$api_url = 'prod';//'dev'
			
			$arsms['NOACCOUNT'] = $noaccount;//'988'.$client_id. substr($arsms['NOPERTANGGUNGAN'], -8);
			$arsms['KETERANGAN'] = 'PAY'.@date('dmy')."-BP3-".$arsms['NOPERTANGGUNGAN'].'-'.$arsms["NAMA"];
			$arsms['URUTAN'] = 0;
			$nmklien = "(".date('m/y').") ".$arsms["NAMA"];
			$nmklien = $arsms["NAMA"];
			if($trxid > 0){
				$thepost['$data'][] = array(
					'type' => 'createbilling', 
					'trx_id' =>$trxid , 
					'client_id' =>$client_id , 
					'trx_amount' =>@ceil($arsms["PREMI"]),
					'billing_type' => 'c',
					'customer_name' => $nmklien,
					'customer_email' => '',  
					'customer_phone' => $arsms["PHONE"],
					'virtual_account' => $arsms['NOACCOUNT'],//@$dts['NOACCOUNT'],
					'datetime_expired' => $arsms["EXPDATE2"].' 23:59:59',
					'description' => $arsms['KETERANGAN'],
					'api_url' => $api_url
				); 
			}
 
			$t = get_content_http_batch($p_host, $thepost,FALSE);
			
			
			
			$sql_ins = FALSE;
			$dat = json_decode($t,TRUE);

			file_put_contents($file, json_encode($thepost).'||'.$t.'||'.$noaccount.'||'.$client_id.PHP_EOL, FILE_APPEND | LOCK_EX);
			if(is_array($dat) && count($dat) > 0){
				
				if(isset($dat['status']) ){
					//VA Active?
				} else if(isset($dat['virtual_account'])){
					$sql_ins = " insert into TABEL_315_PELUNASAN_VA_ECOLL  (
							USERREKAM	,TGLBOOK	,BLNBOOK	,THNBOOK,TGLREKAM ,TGLEXPIRASI ,STATUS 
							,PREFIXPERTANGGUNGAN ,NOPERTANGGUNGAN ,PAYMENTSTATUS ,PAYMENTDATE
							,NOHP ,NOACCOUNT ,NAMAKLIEN ,KETERANGAN 
							,KDBANK ,JENIS ,CABANGBANK ,AMOUNT,AMOUNTPREMI,AMOUNTRIDER
							,TRXID,URUTAN,TGLBOOKED
						) values (
							'"."ECOL".$userid."','".date('d')."','".date('m')."','".date('Y')."',sysdate,add_months(sysdate, +1),'".'0'."',
							'".$arsms['PREFIXPERTANGGUNGAN']."','".$arsms['NOPERTANGGUNGAN']."','".'0'."','".''."',
							'".$arsms['PHONE']."','".$arsms['NOACCOUNT']."','".$nmklien."','".$arsms['KETERANGAN']."',
							'".'BNI'."','".'VA'."','".'BNI PUSAT'."',".ceil($arsms['PREMI']).",0,0
							,".$trxid.",".$arsms['URUTAN'].",trunc(sysdate)
						) ";

					
						$DL->parse($sql_ins); 
						$DL->execute();
						$DL->commit();

						 echo ' -> Nomor VA BNI untuk polis '.$arsms['PREFIXPERTANGGUNGAN'].$arsms['NOPERTANGGUNGAN'].': '.$arsms['NOACCOUNT'] . ' berhasil terbentuk!<br />'.PHP_EOL;
						}
						
						//file_put_contents($file, $sql_ins.PHP_EOL, FILE_APPEND | LOCK_EX);

			} else {
				echo ' Nomor VA gagal terbentuk!<br />';
			}

			
			//echo $sql_ins;

		// ===================== CREATE VA BNI (DEV) ===========================//
		// ===================== CREATE VA BNI (DEV) ===========================//
		
		
		}
	}
		//===========================================
		//================SMS SENDING================
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
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<? include "../../includes/hide.php";  ?>
<font face="Verdana" size="2"><b>DAFTAR APPROVAL PROPOSAL</b><sup>VA</sup><br>
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
<table border="0" width="100%" bgcolor="#DFDFBF" cellspacing="1" cellpadding="2">
<form name="xxx" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
  <tr>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO.
      POLIS</b></font></td>
    <td bgcolor="#C2CAED" colspan="4" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA / HANDPHONE</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JML UANG ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MAC ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MED</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CARA BAYAR</b></font></td>
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOP UP</b></font></td>
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA TERM</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA CI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>LAST UPDATED</b></font></td>
<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b><? if($kantor=="KP") echo "CHECK"; else echo "STATUS"; ?></b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>HP PEMPOL</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
  </tr>
	<?
  //------------------------------------------------------ Non Medical ------------------
/*
AND (select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran h ".
    						 "where  a.prefixpertanggungan = h.prefixpertanggungan ".
    						 "AND a.nopertanggungan = h.nopertanggungan ".
								 "and h.kdpembayaran in ('001','002','005') ) >= 0
*/

if($kantor=='KP') {
	$sql= "select a.suspend, a.keterangan,a.kdstatusemail, ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk, a.nopemegangpolis, ".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.usia_th,".
    				"a.lamaasuransi_th,a.premi1,".
					"(select count(*) from $DBUser.TABEL_214_UNDERWRITING where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) approved,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0),0) nilaipembayaran, ".
					 "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					 "(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt, ".
					 "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
					 "where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit='TERM') UATERM, ".
					 "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
					"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and substr(kdbenefit,1,2)='CI') UACI, ".
					"to_char(a.tglupdated,'DD/MM/YYYY HH:MI:SS') tglupdated, ".
					"(select namacarabayar from $DBUser.TABEL_305_CARA_BAYAR where kdcarabayar=a.kdcarabayar) carabayar ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
    				"a.kdstatusemail='1' ".
					"AND substr(a.kdproduk,1,3) not in ('JL4') ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				"AND a.kdstatusmedical in ('M','N') ".
    				"AND a.kdpertanggungan = '1' ".
    				"AND a.kdstatusfile = '1' ".
					" and not exists (select 'x' from $DBUser.TABEL_214_UNDERWRITING
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ".
				 "AND NOT EXISTS
                 (SELECT   'x'
                    FROM   $DBUser.TABEL_300_HISTORIS_PREMI 
                   WHERE   prefixpertanggungan = a.prefixpertanggungan
                           AND nopertanggungan = a.nopertanggungan
                           and kdkuitansi='BP3' and tglseatled is not null) ".
    				"ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
 /*else {
		$sql= "select a.suspend, a.keterangan, ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk, a.nopemegangpolis, ".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.usia_th,".
    				"a.lamaasuransi_th,a.premi1,".
					"(select count(*) from $DBUser.TABEL_214_UNDERWRITING where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) approved,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0),0) nilaipembayaran, ".
					 "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					  "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
					 "where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit='TERM') UATERM, ".
					 "(select nilaibenefit from $DBUser.tabel_223_transaksi_produk ".
					"where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and substr(kdbenefit,1,2)='CI') UACI, ".
					 "(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
					"substr(a.kdproduk,1,3) not in ('JL4') ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				"AND a.prefixpertanggungan = '$kantor' ".
    				"AND a.kdstatusmedical in ('N','M') ".
    				"AND a.kdpertanggungan = '1' ".
    				"AND a.kdstatusfile = '1' ".
					 /*" and not exists (select 'x' from $DBUser.TABEL_214_UNDERWRITING
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ".
				"AND (NOT EXISTS
                 (SELECT   'x'
                    FROM   $DBUser.TABEL_800_PEMBAYARAN 
                   WHERE   prefixpertanggungan = a.prefixpertanggungan
                           AND nopertanggungan = a.nopertanggungan               
                           and kdpembayaran='001')or (a.kdproduk='JSSPD1' or a.kdproduk='JSSHTBBTN'))".    
    				"ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
			}*/
		//echo $sql;
	$DB->parse($sql);
	$DB->execute();

	while($arr=$DB->nextrow()){
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
	
	#----------------------------[ START NO HP ]----------------------------
	//if(($arr["PONSEL"])== ''){
	if(strlen($arr["PONSEL"])<9){
			 	$nohp = "<font color=red><a href=\"#\" onclick=\"NewWindow('./updateponsel.php?noklien=".$arr["NOPEMEGANGPOLIS"]."','',800,500,1)\">UPDATE NO. HP</a></font>";  
				//echo 'kampret';
			 } else {
			    $nohp = $arr["PONSEL"];
				//echo 'kampret ok';
			 }
	#----------------------------[ END NO HP ]----------------------------
	 ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?><?// echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$nohp;?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATT"];?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["USIA_TH"];?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; $grandtotal;?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["CARABAYAR"];?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["TOPUP"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["UATERM"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["UACI"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["TGLUPDATED"];?></font></td>
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
			
             		if($arr["KDSTATUSEMAIL"]=="1" && $kantor!="KP"){
						$cebox="Email Sudah Terkirim";
					}elseif($arr["KDSTATUSEMAIL"]=="1" && $kantor=="KP"){
						$cebox = "<input type=\"checkbox\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">";
					}else{
					    $cebox = "<input type=\"checkbox\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">";
					}
			
			 // jika ada kekurangan premi
			 /*if(round($arr["NILAIPEMBAYARAN"],2)>=round($total,2)){
			 	  $catatan = $cebox;
			 } else {
			    $catatan = "<font color=red>BP3 KURANG </font>";
			 }*/
			 
			 //if(($arr["PONSEL"])== ''){
			 if(strlen($arr["PONSEL"])<9){
			 	$catatanx = "<font color=red>LENGKAPI NO. HP !</font>";  
				//echo 'kampret';
			 } else if($arr['SUSPEND']) {
				 
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
			 
			 
		?>
    <td bgcolor="#FFFFFF" align="center" valign="center">
        <font face="Verdana" size="1"><? if($arr["APPROVED"]=="0" && $kantor=="KP" ){ echo $catatanx; }else{ echo "Email sudah dikirim ke Kantor Pusat	"; } ?></font>
		<?php if (!$arr['SUSPEND'] && 
			(
				($kantor != 'KP' && $arr['KDSTATUSMEDICAL'] == 'N') || 
				($kantor == 'KP' && $arr['KDSTATUSMEDICAL'] == 'M')
			)
		) { ?>
			<input type="button" value="Pending" onclick="NewWindow('akseptasi_pending_reorg2019.php?<?="prefixpertanggungan=$arr[PREFIXPERTANGGUNGAN]&nopertanggungan=$arr[NOPERTANGGUNGAN]";?>','popuppage','620','500','yes')" style="padding:2px;margin:0px;font-size:12px;font-face:verdana;" />
		<?php } else {
			echo "<font face='Verdana' size='1'>$arr[KETERANGAN]</font>";
		} ?>
    </td>
</tr>
	<? 
	$count++;
	} 
	}
//-------------------------------------------------- start medical --------------------------------
if($kantor=="KP"){
	$filterkantor=" ";
}else{
	$filterkantor="and a.prefixpertanggungan='$kantor' ";
}
	$sql  = "select ".
      				  "a.prefixpertanggungan,a.nopertanggungan,a.kdstatusemail,".
      	        "a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.lamaasuransi_th,usia_th,".
								"a.premi1,a.kdstatusmedical,a.juamainproduk,".
      					"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    						"decode(a.kdvaluta,'0','RpI','1','Rp ','3','US$') notasi, ".//, ".
					 "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "(select NO_PONSEL from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) PONSEL, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt ".
					"from ".
								"$DBUser.tabel_200_pertanggungan a ".
          "where ".
					      "(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                 "where kdstatusunderwriting='0' ".
                 "and a.prefixpertanggungan=b.prefixpertanggungan ".
                 "and a.nopertanggungan=b.nopertanggungan)=0 ".$filterkantor.
      					//"and a.kdstatusemail ='1' ".
						"and a.nopenagih is not null ".
      					"and a.kdpertanggungan='1' ".
                "and a.kdstatusfile = '1' ".
				"AND substr(a.kdproduk,1,3) not in ('JL3','JL4') ".
      					/*"and a.kdstatusmedical='XM' and not exists (select 'x' from $DBUser.TABEL_214_UNDERWRITING
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ".*/
				 "ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
  //echo $sql;
	$DB->parse($sql);
	$DB->execute();

	while($arr=$DB->nextrow()){
	//echo 'x'.$arr["PREFIXPERTANGGUNGAN"];
	$PERT = New Pertanggungan($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
	$TR   = New Transaksi ($userid,$passwd);
	$tglbp3 = ($PERT->tglbp3=='') ? $PERT->sysdate : $PERT->tglbp3;
	$nilairp = ($PERT->valuta=='0') ? $PERT->premi1  : $PERT->premi1 * $TR->Kurs($PERT->valuta,$tglbp3);
	$juarp = ($PERT->valuta=='0') ? $PERT->jua  : $PERT->jua * $TR->Kurs($PERT->valuta,$tglbp3);
	
	   $i = 0;
		 $i = $count + 1;
  
	switch ($arr["KDSTATUSMEDICAL"]) {
	   case 'M' : $statusmedical = "<font color=green><b>M</b></font>"; break;
	   case 'N' : $statusmedical = "<font color=green><b>N</b></font>"; break;
	}
	$nopertm = $arr["NOPERTANGGUNGAN"];
	 ?>
  <tr>
    <td width="5%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?></font></td>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["PONSEL"];?></font></td>
    <td width="10%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATT"];?></font></td>
	 <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["USIA_TH"];?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],2); ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; ?></font></td>
	<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["CARABAYAR"];?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["TOPUP"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["UATERM"],2); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["UACI"],2); ?></font></td>
	<td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["TGLUPDATED"];?></font></td>
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
		

		if($arr["KDSTATUSEMAIL"]=="1")
			$cebox="Email Sudah Terkirim";
			else
				$cebox = "<input type=\"checkbox\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">"; 
			


			 //jika premi kurang dr rp.100.000,-
			 if($nilairp >= 100000 && $kantor=="KP"){ //
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
    <td width="4%" bgcolor="#FFFFFF" align="center">
        <font face="Verdana" size="1"><?echo $catatan;?></font>
    </td>
  </tr>
	<? 
	$count++;
	} ?>
	<!--------------------------------- end medical ----------------->
</table>

<table border="0" width="100%" cellspacing="1" cellpadding="2">
  <tr>
	  <td class="verdana10blk">
		<?php //if ($kantor != 'KP') { ?>
		<input type="button" value="Proposal Pending" onclick="javascript:location.href='akseptasi_underwriting_pending.php'" />
		<?php //} ?>
	  </td>
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
	  
      <?
	  if($kantor=='KP') 
	  {
		  echo "<input type=\"submit\" value=\"Approve\" name=\"sendemail\">";
		  echo "<input type=\"submit\" value=\"Reject\" name=\"rijek\"> ";
		  echo "<input type=\"submit\" value=\"UnApprove\" name=\"unapprove\">";
	  }
	  ?>
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
//document.xxx.sendemail.disabled=true
else
//document.xxx.sendemail.disabled=false
}
if (document.all)
setInterval("checkifempty()",100)
</script>
<hr size="1">
<table>
<? 

//mysql_close($connSae);
//}

/// Function inquiry ke BNI VA API IP:1.26 
function get_content_http_batch($url, $post=FALSE,$isCreate=FALSE){
	$result = FALSE;
	$str = FALSE;
	if(isset($post['$data'])){
		foreach($post['$data'] as $pst=>$pt){
			$psst['$data'] = $pt;
			$str[] = 'curl -k -H "Accept: application/json" -H "Content-Type:application/json" -X POST --data "'.addslashes(json_encode($psst)).'" '.$url ;
		}
		
	}else{
		return $result;
	}
	
	$sstr = implode(' & ',$str);
	$result = shell_exec($sstr);

	//$result = '['.str_replace('}{','},{',$result).']';
	
	return $result;
}
 ?>
<tr>
<td><font face="verdana" size="2"><a href="../submenu.php?mnuinduk=200">Back</a></font></td>
<td><!--<font face="verdana" size="2"><a href="emailterkirim.php">&nbsp;&nbsp;&nbsp;&nbsp;Check Pengiriman Email</a>--></font></td>
</tr>
</table>

