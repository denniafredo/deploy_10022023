<?php
//DEMO MODE
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  include "../../includes/common.php";
  include "../../includes/pertanggungan.php";
  include "../../includes/klien.php";	
  include "../../includes/duit.php";
  include "../../includes/koneksi.php";
  include "../../includes/email.php";
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


	define("HOSIE","MTkyLjE2OC4yLjY=");
	define("USRIE", "cm9vdA==");
	define("PWDIE","YWRtMW5kYXRhYmFzZXNtNFJU"); 
	define("DBNIE","aml3YXNyYXlhX2RvY21hbmFnZXJkYg==");
	
	function makeRequest($nophone, $msg='')
	{
		$url = "http://gateway.ifg-life.id/smsgw/send.batch.php?msisdn={$nophone}&message=".urlencode($msg);
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($ch);

		curl_close($ch);
		$response = json_decode($result, true);
		return $response;
	}

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

			//Tambahan ketika klik REJECT dari kantor pusat maka akan tersimpan ke histori mutasi underwriting - Teguh 08/11/2019        
	        $sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
	                  VALUES ('".substr(".$NoPolis.",1,2)."', '".substr(".$NoPolis.",3,9)."', 'Reject', '-', '-', '-', sysdate, '$userid')";
	        $DB->parse($sqlip);
	        $DB->execute();
	        // End Tambahan - Teguh 08/11/2019
			$x++;
		}
		echo "</b></font><hr><br><br>";
	}

	// Tambahan dari Teguh untuk proposal yang decline maka status proposal menjadi batal
	if(isset($_POST['decline']))
	{
	    $cheklist = $_POST['cheklist'];
	    for($i=0; $i<sizeof($cheklist); $i++)
	    {
	        $NoPolis = $cheklist[$i];
	        $sqldcl = "UPDATE $DBUser.TABEL_200_pertanggungan set kdstatusfile='X'
	                   where prefixpertanggungan='".substr(".$NoPolis.",1,2)."' and nopertanggungan='".substr(".$NoPolis.",3,9)."'";
	        $DB->parse($sqldcl);
	        $DB->execute();
	        
	        //Tambahan untuk menyimpan jenis approval dari masing masing polis (Teguh - 18/10/2019)
	        $kdjenisapproval = $_POST['kdjenisapproval'];
	        $DA = new database($userid, $passwd, $DBName);
	        $sqlist = "INSERT INTO $DBUser.TABEL_214_APPROVAL_PROPOSAL (PREFIXPERTANGGUNGAN,
	                                          NOPERTANGGUNGAN,
	                                          KDJENISAPPROVAL,
	                                          TGLREKAM,
	                                          USERREKAM)
	                  VALUES   ('".substr(".$NoPolis.",1,2)."',
	                            '".substr(".$NoPolis.",3,9)."',
	                            'X',
	                            sysdate,
	                            '$userid')";
	        $DA->parse($sqlist);
	        $DA->execute();

	        //Tambahan ketika klik DECLINE dari kantor pusat maka akan tersimpan ke histori mutasi underwriting - Teguh 29/10/2019        
	        $sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
	                  VALUES ('".substr(".$NoPolis.",1,2)."', '".substr(".$NoPolis.",3,9)."', 'Decline', '-', '-', '-', sysdate, '$userid')";
	        $DB->parse($sqlip);
	        $DB->execute();

	        //End Tambahan (Teguh - 18/10/2019)

	        $x++;
	    }
	    echo "</b></font><hr><br><br>";
	}
	// End Penambahan

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

	//Update Suspend & Keterangan
	//UPDATE KLIK LANJUT OLEH TEGUH
	if($kirim=1){
		$sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = NULL, keterangan = NULL 
	                WHERE nopertanggungan = '".$nopertanggunganew."'";
	    //echo $sql;
		$DB->parse($sql);
		$DB->execute();

	    //Tambahan ketika klik lanjut pending dari kantor cabang maka akan tersimpan ke histori mutasi underwriting - Teguh 08/11/2019 
	    $sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
	              VALUES ('$prefixpertanggungannew', '$nopertanggunganew', 'Lanjut',  '-', '-', '-', sysdate, '$userid')";
	    $DB->parse($sqlip);
	    $DB->execute();
	    // End Tambahan - Teguh 08/11/2019 
	}

	//PROSES SEBELUMNYA 
	//if(isset($_POST['kirim'])){
	//	$sql = "UPDATE $DBUser.tabel_200_pertanggungan SET suspend = NULL, keterangan = NULL 
	//                WHERE nopertanggungan = '".$lanjut."'";
	        //echo $sql;
	//		$DB->parse($sql);
	//        $DB->execute();
	//}

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
        //echo $sqlUpd;
		$DB->parse($sqlUpd);
		$DB->execute(); 

		//Tambahan untuk menyimpan jenis approval dari masing masing polis (Teguh - 08/11/2019)
        $kdjenisapproval = $_POST['kdjenisapproval'];        
        $sqlinst = "INSERT INTO $DBUser.TABEL_214_APPROVAL_PROPOSAL (PREFIXPERTANGGUNGAN,
                        NOPERTANGGUNGAN,
                        KDJENISAPPROVAL,
                        TGLREKAM,
                        USERREKAM)
                    VALUES   ('".substr(".$NoPolis.",1,2)."',
                            '".substr(".$NoPolis.",3,9)."',
                            '$kdjenisapproval',
                            sysdate,
                            '$userid')";
        $DB->parse($sqlinst);
        $DB->execute();
        //End Tambahan (Teguh - 08/11/2019)

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
					/*(select kdmapping from $DBUser.TABEL_001_KANTOR where kdkantor=c.prefixpertanggungan )||c.nopertanggungan h2h*/
				 (SELECT noaccount 
						FROM $DBUser.tabel_100_klien_account 
						WHERE prefixpertanggungan = c.prefixpertanggungan 
                            AND nopertanggungan = c.nopertanggungan
                            AND jenis = 'HH'
                            AND kdbank = 'BMRI'
                        ) h2h
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
		$arsms=$DSMS->nextrow(); //var_dump($arsms);
		
		if($arsms["KDPRODUK"]!="JSSPD1"){ // khusus untuk JS Plan Dollar tidak ada SMS karena Premi BP3 Sudah dibayar ke BO masing2 : Dedi 05/11/2014
		if(substr($arsms["KDPRODUK"],-3)!="BTN"){	
    
		$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", permohonan asuransi Anda DISETUJUI,Lakukan pemb premi melalui cara ifg-life.id/carabayar dg no ".
			 $arsms["H2H"]." Rp. ".$arsms["PREMI"].". Info 1500176";	

		$msg1 = "Calon Pemegang Polis Yth, Permohonan asuransi Anda telah DISETUJUI,"
			." lakukan pembayaran premi kode bayar Virtual Account " . $arsms["VA"]
			." atau Host To Host ".$arsms["H2H"]
			." sebesar Rp".$arsms["PREMI"].". Info 1500176 ";//paling lambat " . $dateX . ".			 
			
		makeRequest($arsms["PHONE"], $msg1);
		//===================SMS AGEN================
		$msgagn="Harap infokan CPP a/n ".$arsms["NAMA"]." utk membayar premi melalui cara berikut ifg-life.id/carabayar dg no ".$arsms["H2H"].", sebesar Rp ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"];
			 
	
				$msgagn1="Harap Infokan CPP a/n ".$arsms["NAMA"]." utk membayar premi melalui cara Virtual Account ".$arsms["VA"]
			." atau Host To Host ".$arsms["H2H"]." sebesar Rp".$arsms["PREMI"]." Info 1500176 "; //paling lambat ".$dateX.".
		makeRequest($arsms["PHONEAGEN"], $msgagn);
		//echo $msg;
		
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONE"]."','".$msg."')";
		//$arsms["PHONE"] = "628170097605";
		$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONE"]."','".$msg1."','TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
		 //echo $mysqlins;
		mysql_query($mysqlins);
		
		//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONEAGEN"]."','".$msgagn."')";
		$mysqlinsagn="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONEAGEN"]."','".$msgagn1."','TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
		 //echo $mysqlins; 
		mysql_query($mysqlinsagn);
					// Create VA BNI : rendy 2021-09-05
					// interval 15 days untuk free lookop BP3
					$ketVA = "PAY".date('dmy')."-BP3-".$arsms['NOPERTANGGUNGAN']."-".$arsms["NAMA"];
					$sql_ins = "	insert into NADM.TABEL_315_PELUNASAN_VA_EC_PROC
						(
							USERREKAM,  TGLBOOK,  BLNBOOK,  THNBOOK
							,TGLREKAM,  TGLEXPIRASI,  STATUS
							,PREFIXPERTANGGUNGAN, NOPERTANGGUNGAN,  PAYMENTSTATUS,  PAYMENTDATE
							,NOHP, NOACCOUNT,  NAMAKLIEN,  KETERANGAN
							,KDBANK, JENIS,  CABANGBANK,  AMOUNT ,  AMOUNTPREMI,AMOUNTRIDER,
							URUTAN ,  TGLBOOKED ,  CID  ,  FLAG  
						) values (
							'"."EC".$userid."','".date('d')."','".date('m')."','".date('Y')."'
							,sysdate,to_char(sysdate + INTERVAL '15' DAY,'YYYY-MM-DD') || ' 23:59:59','".'0'."',
							'".$arsms['PREFIXPERTANGGUNGAN']."','".$arsms['NOPERTANGGUNGAN']."','".'0'."','".''."',
							'".$arsms['PHONE']."','".$arsms['NOACCOUNT']."','".$arsms["NAMA"]."','".$ketVA."',
							'".'BNI'."','".'VA'."','".'BNI PUSAT'."',".$arsms["PREMI"].",0,0
							,0, trunc(sysdate),'".substr($arsms['NOACCOUNT'],3,5)."',0
						) ";

						//echo $sql_ins;
						
						$DL->parse($sql_ins); 
						$DL->execute();
						$DL->commit();
						
					// Create VA BNI : rendy 2021-09-05
		
		
		}
	}
		
		$x++;
	}
	echo "</b></font><hr><br><br>";

}




?>
<link href="./jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<? include "../../includes/hide.php";  ?>
<? if($kantor=="KP"){ ?><font face="Verdana" size="2"><b>DAFTAR APPROVAL PROPOSAL</b><sup>VA</sup><br>
<? }else{ ?><font face="Verdana" size="2"><b>DAFTAR CEK STATUS PROPOSAL</b><sup>VA</sup><br>
<? } ?>Kantor : <? echo $kantor; ?>



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
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TGL KONF.</b></font></td>
<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b><? if($kantor=="KP") echo "CHECK"; else echo "STATUS"; ?></b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>HP PEMPOL</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
  </tr>
	<?
  


//-------------------------------------------------- start medical / non medical--------------------------------
if($kantor=="KP"){
	$filterkantor=" ";
	$filterappr=" and not exists (select 'x' from $DBUser.TABEL_214_UNDERWRITING
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan )  ";
}else{
	$filterkantor="and a.prefixpertanggungan='$kantor' ";
	$filterappr=" ";
}
	if($kantor=="KP"){
		$sql  = "select ".
   				  	"a.prefixpertanggungan,a.suspend,a.nopertanggungan,a.kdstatusemail,a.keterangan,a.nopemegangpolis,to_char(a.tglsendemail,'DD/MM/YYYY HH24:MI') tglemail,".
      				"to_char(tglsendemail,'YYYYMMDD') tglkirimemail, ".
	      	        "a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.lamaasuransi_th,usia_th,".
					"a.premi1,a.kdstatusmedical,a.juamainproduk,".
      				"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI','1','Rp ','3','US$') notasi, ".//, ".
					"(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					"(select NO_PONSEL from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) PONSEL, ".
					"(select count(*) from $DBUser.tabel_214_underwriting where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) statusapproval,".
					"(select count(*) from $DBUser.tabel_214_acceptance_dokumen where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) statusakseptasi,".
					"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt ".
				"from ".
					"$DBUser.tabel_200_pertanggungan a ".
          		"where ".
					"(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                 		"where kdstatusunderwriting='0' ".
                 			"and a.prefixpertanggungan=b.prefixpertanggungan ".
                 			"and a.nopertanggungan=b.nopertanggungan)=0 ".$filterkantor.
                	//"and a.prefixpertanggungan='$kantor' ".
      				//"and a.kdstatusemail ='1' ".
					"and a.nopenagih is not null ".
      				"and a.kdpertanggungan='1' ".
					"and a.kdstatusemail is not null ".
                	"and a.kdstatusfile = '1' ".
					"AND substr(a.kdproduk,1,3) not in ('JL3','JL4') ".
      				/*"and a.kdstatusmedical='XM' */
					$filterappr.
				"ORDER BY tglsendemail,a.prefixpertanggungan, a.nopertanggungan ";
				 
	}else{
		  $sql  = "select ".
	   				"a.prefixpertanggungan,a.suspend,a.nopertanggungan,a.kdstatusemail,a.keterangan,a.nopemegangpolis,to_char(a.tglsendemail,'DD/MM/YYYY HH24:MI') tglemail,".
      	        	"to_char(tglsendemail,'YYYYMMDD') tglkirimemail, ".
      	        	"a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,a.lamaasuransi_th,usia_th,".
					"a.premi1,a.kdstatusmedical,a.juamainproduk,".
      				"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI','1','Rp ','3','US$') notasi, ".//, ".
					"(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					"(select NO_PONSEL from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) PONSEL, ".
					"(select count(*) from $DBUser.tabel_214_underwriting where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) statusapproval,".
					"(select count(*) from $DBUser.tabel_214_acceptance_dokumen where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) statusakseptasi,".					 
					"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt ".
				"from ".
						"$DBUser.tabel_200_pertanggungan a ,$DBUser.tabel_214_acceptance_dokumen c ".
          		"where ".
					      "(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                 "where kdstatusunderwriting='0' ".
                 "and a.prefixpertanggungan=b.prefixpertanggungan ".
                 "and a.nopertanggungan=b.nopertanggungan)=0 ".$filterkantor.
                //"and a.prefixpertanggungan='$kantor' ".
      					//"and a.kdstatusemail ='1' ".
						"AND a.prefixpertanggungan = c.prefixpertanggungan(+) AND a.nopertanggungan = c.nopertanggungan(+) ".
						"AND nvl(c.kdcetakpolis,'0') not in ('1') ".
						"and a.kdstatusemail is not null ".
						"and a.nopenagih is not null ".
      					"and a.kdpertanggungan in  ('2','1') ".
                "and a.kdstatusfile = '1'  and to_char(a.tglrekam,'yyyy')='2019' ".
				"AND substr(a.kdproduk,1,3) not in ('JL3','JL4') ".
      					/*"and a.kdstatusmedical='XM' */
						$filterappr.
				 "ORDER BY tglsendemail,a.prefixpertanggungan, a.nopertanggungan ";	
	}
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
	   case 'M' : $statusmedical = "<font color=red><b>M</b></font>"; break;
	   case 'N' : $statusmedical = "<font color=green><b>N</b></font>"; break;
	}
	$nopertm = $arr["NOPERTANGGUNGAN"];
	 ?>
  <tr>
    <td width="5%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">"./*$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]*/$PERT->nopolbaru."</a></font></td>";?>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?></font></td>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1">
	<?
	
	#----------------------------[ START NO HP ]----------------------------
	if(strlen($arr["PONSEL"])<9 && $kantor=="KP"){
	//if(($arr["PONSEL"])== ''){
			 	$nohp = "<font color=red><a href=\"#\" onclick=\"NewWindow('updateponsel.php?noklien=".$arr["NOPEMEGANGPOLIS"]."','',800,500,1)\">UPDATE NO. HP</a></font>";  
				//echo 'kampret';
			 } else {
			    $nohp = $arr["PONSEL"];
				//echo 'kampret ok';
			 }
	#----------------------------[ END NO HP ]----------------------------
	
	echo $nohp;
	//$arr["PONSEL"];?>
	</font></td>
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
	<td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLEMAIL"];?></font></td>
	
		<?php
		

		if($arr["KDSTATUSEMAIL"]=="1" && $kantor!="KP" && $arr["STATUSAPPROVAL"]!="1")
			$cebox="Tunggu Approval Kantor Pusat!";
		elseif($arr["KDSTATUSEMAIL"]=="1" && $kantor!="KP" && $arr["STATUSAPPROVAL"]=="1" && $arr["STATUSAKSEPTASI"]=="0")
			$cebox = "Approved"; 
		else
			
				if($kantor=="KP"){
					if($arr["STATUSAKSEPTASI"]=="1"){
						$cebox = "Accepted"; 
					}elseif($arr["STATUSAPPROVAL"]=="1"){
						$cebox = "Approved"; 
					}else{
						$cebox = "<input type=\"checkbox\" name=\"cheklist[]\" value=".$arr['PREFIXPERTANGGUNGAN'].$arr['NOPERTANGGUNGAN'].">"; 
					}
				}else{
					if($arr["STATUSAKSEPTASI"]=="1"){
						$cebox = "<font color=green><b>Accepted (Cetak Kantor Pusat)<!--input type=\"button\" value=\"cetakdok\" onClick=\"NewWindow('../polis/cetakdokumen.php?prefix=$arr[PREFIXPERTANGGUNGAN]&noper=$arr[NOPERTANGGUNGAN]','popuppage','620','500','yes')\" style=\"padding:2px;margin:0px;font-size:12px;font-face:verdana;\" /--></b></font>"; 						
					}elseif($arr["STATUSAPPROVAL"]=="1"){
						//$cebox = "<font color=green> <b>Approved</b></font>"; 
						$cebox = "<font color=green><b>Accepted (Cetak Kantor Pusat)<!--input type=\"button\" value=\"cetakdok\" onClick=\"NewWindow('../polis/cetakdokumen.php?prefix=$arr[PREFIXPERTANGGUNGAN]&noper=$arr[NOPERTANGGUNGAN]','popuppage','620','500','yes')\" style=\"padding:2px;margin:0px;font-size:12px;font-face:verdana;\" /--></b></font>"; 
					}else{
						$cebox = "<font color=blue> <b>Tunggu Approval Kantor Pusat!</b></font>";
					}
				}
			


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
		
		if(strlen($arr["PONSEL"])<9){ 
			 	$catatan = "<font color=red>LENGKAPI NO. HP !</font>";  				
			 } else if($arr['SUSPEND']) {
				 $catatan = null;
			 } else {
			    $catatan = $catatan;				
			 }

		/* Tambahan Cutoff Send Email - Teguh 16/03/2020 */
			// $cutoff = date('Ym')."27";
			// if($arr["TGLKIRIMEMAIL"] > $cutoff){
			//  	$catatanx = "Proses akan diapprove bulan depan!";
			// }
		?>
    <td width="4%" bgcolor="#FFFFFF" align="center">
        <font face="Verdana" size="1"><?echo $catatan;?></font>
        <?php if (!$arr['SUSPEND'] && $kantor=="KP")   { ?>
			<input type="button" value="Pending" onclick="NewWindow('akseptasi_pending.php?<?="prefixpertanggungan=$arr[PREFIXPERTANGGUNGAN]&nopertanggungan=$arr[NOPERTANGGUNGAN]";?>','popuppage','620','500','yes')" style="padding:2px;margin:0px;font-size:12px;font-face:verdana;" />
		<?php } else {
			echo "<font face='Verdana' size='1'>$arr[KETERANGAN]</font>";
			if ($arr['SUSPEND'] && $kantor!="KP") { ?>
					<input type="hidden" name="lanjut" value="<?=$arr['NOPERTANGGUNGAN'];?>" />
					<input type="button" name="kirim" value="Lanjut Proposal Pending" style="padding:0px;margin:0px;" onclick="window.location.href='akseptasi_underwriting.php?<?="kirim=1&prefixpertanggungannew=$arr[PREFIXPERTANGGUNGAN]&nopertanggunganew=$arr[NOPERTANGGUNGAN]";?>'"/>
					<!--button type="submit" name="lanjut" value="<?=$arr['NOPERTANGGUNGAN'];?>" style="padding:0px;margin:0px;">
						<font face="Verdana" size="1">Lanjut</font>
					</button-->
				<?php } 
		} ?>
    </td>
  </tr>
	<? 
	$count++;
	} ?>
	<!--------------------------------- end medical / non medical----------------->
</table>

<table border="0" width="100%" cellspacing="1" cellpadding="2">
  	<tr>
	  	<td class="verdana10blk" style="font-size: 13px" align="right">
		<?php if ($kantor == 'KP') { ?>
        <!-- Tambahan untuk memilih jenis APPROVAL terlebih dahulu sebelum mengklik proses APPOVE (Teguh - 08/11/2019)-->
            Pilih Kategori Approval : 
            <input type="radio" name="kdjenisapproval" value="1" checked="checked"> Standar Non Medical
            <input type="radio" name="kdjenisapproval" value="2"> Standar Medical
            <input type="radio" name="kdjenisapproval" value="3"> Substandar Non Medical
            <input type="radio" name="kdjenisapproval" value="4"> Substandar Medical
        <?php }
              else{}
          ?>
      	 <!-- End Tambahan -  (Teguh - 08/11/2019)-->
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
			  echo "<input type=\"hidden\" value=".$arr['NOPERTANGGUNGAN']." name=\"nopertangg\">";
			  echo "<input type=\"submit\" value=\"Reject\" name=\"rijek\"> ";
			  //echo "<input type=\"submit\" value=\"UnApprove\" name=\"unapprove\">";
			  echo "<input type=\"submit\" value=\"Decline\" name=\"decline\">";
		  }
		  ?>
		
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

