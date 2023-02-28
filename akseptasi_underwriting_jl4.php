<?
	include "./includes/database.php"; 
	include "./includes/common.php";
	include "./includes/session.php";
	include "./includes/pertanggungan.php";
	include "./includes/klien.php";	
	include "./includes/duit.php";
	include "./includes/koneksi.php"; 

	$DB = new database($userid, $passwd, $DBName);
	$DC = new database($userid, $passwd, $DBName);
	$DL = new database('nadm', 'ifg#dbs#nadm#2020', $DBName);
	$DSMS = new database($userid, $passwd, $DBName);
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
	
	/*--------------------------------------------------
	Author : Farhan Aldiansyah
	Date   : 27 Feb 2023
	Desc   : Untuk sending sms
	*/
	function makeRequest($nophone, $msg='')
	{
		$url = "http://gateway.ifg-life.id/smsgw/send.batch.php?msisdn={$nophone}&message=".urlencode($msg);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$result = curl_exec($ch);

		curl_close($ch);
		//$response = json_decode($result, true);
		return $result;
	}
	
	/*
	$connSae = mysql_connect(base64_decode(HOSIE), base64_decode(USRIE), base64_decode(PWDIE));
	if (!$connSae) die ("Gagal Melakukan Koneksi ke SAE");
	mysql_select_db(base64_decode(DBNIE),$connSae) or die ("Database Tidak Diketemukan di Server SAE");
	*/
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
			//End Tambahan - (Teguh 08/11/2019)

			$x++;
		}
		echo "</b></font><hr><br><br>";
	}

	// Tambahan untuk proposal yang decline maka status proposal menjadi batal - Teguh (08/11/2019)
	if(isset($_POST['decline']))
  	{
    	$cheklist = $_POST['cheklist'];
    	for($i=0; $i<sizeof($cheklist); $i++)
    	{
      		$NoPolis = $cheklist[$i];
      		$sqldcl = "UPDATE $DBUser.TABEL_200_pertanggungan SET kdstatusfile='X'
             			WHERE prefixpertanggungan='".substr(".$NoPolis.",1,2)."' and nopertanggungan='".substr(".$NoPolis.",3,9)."'";
      		$DB->parse($sqldcl);
      		$DB->execute();
      
			$kdjenisapproval = $_POST['kdjenisapproval'];
			$DA = new database($userid, $passwd, $DBName);
			$sqlist = " INSERT INTO $DBUser.TABEL_214_APPROVAL_PROPOSAL (PREFIXPERTANGGUNGAN,
							NOPERTANGGUNGAN,
							KDJENISAPPROVAL,
							TGLREKAM,
							USERREKAM)
						VALUES ('".substr(".$NoPolis.",1,2)."',
								'".substr(".$NoPolis.",3,9)."',
								'X',
								sysdate,
								'$userid')";
			$DA->parse($sqlist);
			$DA->execute();
      
			$sqlip = "INSERT INTO $DBUser.tabel_216_historis_mutasi_uw (prefixpertanggungan, nopertanggungan, status, kategoripending, sumberpending, keterangan, tglrekam, userrekam)
                    VALUES ('".substr(".$NoPolis.",1,2)."', '".substr(".$NoPolis.",3,9)."', 'Decline', '-', '-', '-', sysdate, '$userid')";
			$DB->parse($sqlip);
			$DB->execute();

			$x++;
    	}
    	echo "</b></font><hr><br><br>";
	}
	// End Penambahan (Teguh - 08/11/2019)

	if(isset($_POST['sendemail'])){
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
			$DB->parse($sqlUpd);
			$DB->execute();
			//echo $sqlUpd;
			
			//Tambahan untuk menyimpan jenis approval dari masing masing polis (Teguh - 18/10/2019)
			$kdjenisapproval = $_POST['kdjenisapproval'];
			$DA = new database($userid, $passwd, $DBName);
			$sqlinst = "INSERT INTO $DBUser.TABEL_214_APPROVAL_PROPOSAL (PREFIXPERTANGGUNGAN,
							NOPERTANGGUNGAN,
							KDJENISAPPROVAL,
							TGLREKAM,
							USERREKAM)
						VALUES ('".substr(".$NoPolis.",1,2)."',
							'".substr(".$NoPolis.",3,9)."',
							'$kdjenisapproval',
							sysdate,
							'$userid')";
			$DA->parse($sqlinst);
			$DA->execute();
			//End Tambahan (Teguh - 08/11/2019)

			//================SMS SENDING================
			$sms="SELECT   A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN NOPOLIS,c.NOSP,to_char(c.tglsp,'yyyy-mm-dd hh24:mi') tglsp,
					 NOACCOUNT,A.PREFIXPERTANGGUNGAN,A.NOPERTANGGUNGAN,
					 (SELECT    MAX (NVL(NILAIRP,PREMITAGIHAN))
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
					 (SELECT   NVL(NO_PONSEL, PHONETETAP02)
						FROM   $DBUser.TABEL_100_KLIEN
					   WHERE   NOKLIEN = NOPEMEGANGPOLIS)
						PHONE,
					 (SELECT   NVL(NO_PONSEL, PHONETETAP01)
						FROM   $DBUser.TABEL_100_KLIEN
					   WHERE   NOKLIEN = NOAGEN)
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
                        ) h2h,
						(SELECT noaccount 
						FROM $DBUser.tabel_100_klien_account 
						WHERE prefixpertanggungan = c.prefixpertanggungan 
                            AND nopertanggungan = c.nopertanggungan
                            AND jenis = 'VA'
                            AND kdbank = 'BNI'
                        ) va
			  FROM   $DBUser.TABEL_214_UNDERWRITING a,
					 $DBUser.TABEL_100_KLIEN_ACCOUNT b,
					 $DBUser.TABEL_200_PERTANGGUNGAN c
			 WHERE       a.prefixpertanggungan = b.prefixpertanggungan
					 AND a.nopertanggungan = b.nopertanggungan
					 AND a.prefixpertanggungan = c.prefixpertanggungan
					 AND a.nopertanggungan = c.nopertanggungan
					 AND a.prefixpertanggungan = '".substr(".$NoPolis.",1,2)."'
					 AND a.nopertanggungan = '".substr(".$NoPolis.",3,9)."'
					 AND b.kdbank = 'BNI'";
			//echo $sms;
			$DSMS->parse($sms);
			$DSMS->execute();
			$arsms=$DSMS->nextrow();
			
			//Berdasarkan Email Pak Ari Faisal A. Pada tanggal 04/11/2014
	    //$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", harap lakukan pembayaran premi via Host To Host Mandiri&BRI ".
			//	 $arsms["H2H"]." sebesar ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"]." Utk info hub 021-500151";			 
			 if($arsms["KDPRODUK"]=="JL4BA"){ //Untuk produk kerjasama dengan AAP (JS-Promapan) Nomor HP diganti dengan nomor PT. AAP.
				//$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", harap lakukan pembayaran premi via Mandiri/BRI/Indomaret ".
				//	 $arsms["H2H"]." sebesar ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"]." Utk info hub 021-1500151";			 
				$msg="Disetujui ".$arsms["TGLSP"]." ".$arsms["NOSP"]." ".$arsms["NAMA"].", ".
					 $arsms["H2H"]." ".$arsms["NOPOLIS"]." ".$arsms["PHONE"]." ".substr($arsms["NOPOLIS"],0,2).".";			 	 
				
				$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('081212524247','".$msg."')";
			}else{
				//$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", permohonan asuransi Anda telah disetujui,segera bayar premi via Mandiri/BRI/Indomaret ".
				// $arsms["H2H"]." Rp. ".$arsms["PREMI"].". Info hub 021-500151";   
				$msg="Yth. Bpk/Ibu ".$arsms["NAMA"].", permohonan asuransi Anda DISETUJUI,Lakukan pemb premi melalui cara ifg-life.id/carabayar dg kode bayar ".
				 $arsms["H2H"]." Rp. ".$arsms["PREMI"].". Info hub 021-1500176";

				$dateX = date('d/m/Y', strtotime("+15 day"));

				$msg1 = "Calon Pemegang Polis Yth, Permohonan asuransi Anda telah DISETUJUI,"
				." lakukan pembayaran premi kode bayar Virtual Account " . $arsms["VA"]
				." atau Host To Host ".$arsms["H2H"]
				." sebesar Rp".$arsms["PREMI"].". Info 1500176 ";//paling lambat " . $dateX . ".
				//echo $msg;	 
				makeRequest($arsms["PHONE"], $msg1);
				//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONE"]."','".$msg."')";
				$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONE"]."','".$msg1."','2.23 | TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
				 //echo $mysqlins;
			}
			mysql_query($mysqlins);
			
			//===================SMS AGEN================
			//$msgagn="Harap infokan CPP a/n ".$arsms["NAMA"]." utk membayar premi via host to host Mandiri&BRI no ".$arsms["H2H"]." Rp ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"];
			
			$msgagn="Harap infokan CPP a/n ".$arsms["NAMA"]." utk membayar premi melalui cara berikut ifg-life.id/carabayar dg H2H ".$arsms["H2H"].", VA BNI ".$arsms["VA"]." sebesar Rp ".$arsms["PREMI"]." paling lambat ".$arsms["EXPDATE"];
			$msgagn1="Harap Infokan CPP a/n ".$arsms["NAMA"]." utk membayar premi melalui cara Virtual Account ".$arsms["VA"]
			." atau Host To Host ".$arsms["H2H"]." sebesar Rp".$arsms["PREMI"]." Info 1500176 "; //paling lambat ".$dateX.".
			makeRequest($arsms["PHONEAGEN"], $msgagn1);
			//$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE) VALUES('".$arsms["PHONEAGEN"]."','".$msgagn."')";
			$mysqlins="insert into smsjiwasraya (PHONE, MESSAGE,JENIS_SMS,KODE_KANTOR,NAMA_DIVISI,NO_POLIS) VALUES('".$arsms["PHONEAGEN"]."','".$msgagn1."','2.23 | TAGIHAN BP3','".$arsms["PREFIXPERTANGGUNGAN"]."','PENJUALAN','".$arsms["NOPOLIS"]."')";
			 //echo $mysqlins;
			
			mysql_query($mysqlins);
			
			//===========================================
			//================SMS SENDING================
			//echo $DB->error;
			//echo $sqlUpd;
			//$conn = ocilogon($userid, $passwd, "JSDB");
	  //$query="DELETE FROM $DBUser.SLIP_DUMMY where kdbatch='$batchs' and kdkantor='$kantor'";
	  //$sql= ociparse($conn, $sqlUpd);
	  //ociexecute($sql);
			//echo $x.". ".$NoPolis."<br>";

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


			$x++;
		}
		echo "</b></font><hr><br><br>";

	}

/*------------------------------------end Of Iie Sumitra:19Jul2013--------------*/



?>
<link href="./jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="./includes/window.js" ></script>
<? include "./includes/hide.php";  ?>
<font face="Verdana" size="2"><b>DAFTAR APPROVAL PROPOSAL</b><br>
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
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>NO. PROPOSAL</b></font></td>
    <td bgcolor="#C2CAED" colspan="5" align="center">
      <p align="center"><font face="Verdana" size="1"><b>NAMA / HANDPHONE</b></font>
    </td>
    <td bgcolor="#C2CAED" colspan="6" align="center"><p align="center"><font face="Verdana" size="1"><b>FUND</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>JML UANG ASURANSI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MAC ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MULAI ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MASA ASS</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>MED</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CARA BAYAR</b></font></td>
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>PREMI BKL<br>(Rp)</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOP UP BKL<br>(Rp)</b></font></td>
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOTAL PREMI<br>(Rp)</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TOP UP SKG.<br>(Rp)</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA CI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA TERM</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA TPD</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA WPCI</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>UA WPTPD</b></font></td>
    <td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>TGL KONF.</b></font></td>
	<!--<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>DOK.SAE</b></font></td> -->
	<td bgcolor="#C2CAED" rowspan="2" align="center"><font face="Verdana" size="1"><b>CHECK</b></font></td>
   </tr>
  <tr>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>CALON PEMEGANG PLS</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>HP PEMPOL</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>USIA TH</b></font></td>
    
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>FF</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>EF</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>BF</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>MM</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>G75</b></font></td>
    <td bgcolor="#C2CAED" align="center"><font face="Verdana" size="1"><b>G85</b></font></td>
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
	$sql= "SELECT a.nopolbaru, a.suspend, a.keterangan, ".
    			"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,".
    	      	"a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,usia_th,a.nopemegangpolis,".
    			"a.lamaasuransi_th,a.premi1,".
				"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    			"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    			"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    			"where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    			"a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    			"having sum(nilaipembayaran) > 0),0) nilaipembayaran, ".
				"(SELECT COUNT(*) 
              		FROM $DBUser.tabel_300_historis_premi
             		WHERE prefixpertanggungan = a.prefixpertanggungan
                     AND nopertanggungan = a.nopertanggungan
                     AND kdkuitansi IN ('BP3') AND TGLSEATLED IS NOT NULL) bayarbp3,".
				"(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUP') topupbkl, ".
				"(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
				"(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and substr(kdbenefit,1,2)='CI') ci, ".
				"(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TI') ti, ".
				"(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='WPCI51') WPCI, ".
				"(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TPD') TPD, ".
				"(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='WPTPD') WPTPD, ".
				"to_char(tglsendemail,'DD/MM/YYYY HH24:MI') tglemail, ".
				"to_char(tglsendemail,'YYYYMMDD') tglkirimemail, ".
				"(SELECT   porsi
					FROM   $DBUser.TABEL_UL_OPSI_FUND
					WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'FF')
					  FF,
				(SELECT   porsi
					FROM   $DBUser.TABEL_UL_OPSI_FUND
					WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'BF')
					  BF,
				(SELECT   porsi
					FROM   $DBUser.TABEL_UL_OPSI_FUND
					WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'EF')
					  EF,
				(SELECT   porsi
					FROM   $DBUser.TABEL_UL_OPSI_FUND
					WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'MM')
					  MM,
					  NVL (
				(SELECT porsi
					FROM $DBUser.TABEL_UL_OPSI_FUND
					WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IG'),
					0)
					IG,
				   NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IH'),
					0)
					IH,".
					  "(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "decode(nopemegangpolis,notertanggung,usia_th,round(months_between (mulas,(select tgllahir from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis))/12)) usiapp, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt,
					  (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar = a.KDCARABAYAR) cara_bayar ".
				"FROM ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"WHERE ".
    				"a.kdstatusemail='1' ".
					"AND ".
					"substr(a.kdproduk,1,3) in ('JL4','xJL3') ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				"AND a.kdstatusmedical in ('N','M') ".
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
    				"ORDER BY tglsendemail, a.prefixpertanggungan, a.nopertanggungan ";} 
					
		elseif ($kantor=='KN') // koreksi by FENDY 31032016 sebelumnya $kantor diset menjadi KN ($kantor = 'KN') tanda = kurang 1 kali
		
		{
	$sql= "select a.nopolbaru, a.suspend, a.keterangan, ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,usia_th,a.nopemegangpolis,".
    				"a.lamaasuransi_th,a.premi1,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0),0) nilaipembayaran, ".
					 "(SELECT   COUNT(*) 
              FROM   $DBUser.tabel_300_historis_premi
             WHERE       prefixpertanggungan = a.prefixpertanggungan
                     AND nopertanggungan = a.nopertanggungan
                     AND kdkuitansi IN ('BP3') AND TGLSEATLED IS NOT NULL) bayarbp3,".
					  "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPU') topupbkl, ".
					 "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and substr(kdbenefit,1,2)='CI') ci, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TI') ti, ".
					 "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='WPCI51') WPCI, ".
					 "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TPD') TPD, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='WPTPD') WPTPD, to_char(tglsendemail,'DD/MM/YYYY HH24:MI') tglemail,".
					 "(SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'FF')
					  FF,
				   (SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'BF')
					  BF,
					(SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'EF')
					  EF,
					 (SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'MM')
					  MM,
					  NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IG'),
					0)
					IG,
				   NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IH'),
					0)
					IH, ".
					  "(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "decode(nopemegangpolis,notertanggung,usia_th,round(months_between (mulas,(select tgllahir from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis))/12)) usiapp, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt,
					  (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar = a.KDCARABAYAR) cara_bayar  ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
    				"a.kdstatusemail='1' ".
					"AND ".
					"substr(a.kdproduk,1,3) in ('JL4') ".
    				"AND a.nopenagih is not null ".
					"and a.prefixpertanggungan='KN' ".
    				"AND a.premi1 != '0' ".
    				"AND a.kdstatusmedical in ('N','M') ".
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
    				"ORDER BY a.prefixpertanggungan, a.nopertanggungan ";}			
					
					else {
					
		$sql= "select a.nopolbaru, a.suspend, a.keterangan, ".
    				"a.prefixpertanggungan,a.kdstatusmedical,a.juamainproduk,".
    	      "a.nopertanggungan,a.kdproduk,to_char(a.mulas,'DD/MM/YYYY') mulas,usia_th,".
    				"a.lamaasuransi_th,a.premi1,".
						"(select juaminimal from $DBUser.tabel_202_produk where kdproduk=a.kdproduk) juaminimal,".
    				"decode(a.kdvaluta,'0','RpI ','1','Rp ','3','US$ ') notasi, ".
    				"NVL((select sum(nilaipembayaran) from $DBUser.tabel_800_pembayaran g ".
    				 "where  a.prefixpertanggungan = g.prefixpertanggungan and ".
    				 "a.nopertanggungan = g.nopertanggungan and g.kdpembayaran in ('001','002','005') ".
    				 "having sum(nilaipembayaran) > 0),0) nilaipembayaran, ".
					 "(SELECT   COUNT(*) 
              FROM   $DBUser.tabel_300_historis_premi
             WHERE       prefixpertanggungan = a.prefixpertanggungan
                     AND nopertanggungan = a.nopertanggungan
                     AND kdkuitansi IN ('BP3') AND TGLSEATLED IS NOT NULL) bayarbp3,".
					  "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPU') topupbkl, ".
					 "(SELECT PREMI FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='BNFTOPUPSG') topup, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and substr(kdbenefit,1,2)='CI') ci, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TI') ti, ".
					 "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='WPCI51') WPCI, ".
					 "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='TPD') TPD, ".
					  "(SELECT NILAIBENEFIT FROM $DBUser.TABEL_223_TRANSAKSI_PRODUK WHERE prefixpertanggungan=a.prefixpertanggungan and
					 nopertanggungan=a.nopertanggungan and kdbenefit='WPTPD') WPTPD, to_char(tglsendemail,'DD/MM/YYYY HH24:MI') tglemail,".
					 "(SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'FF')
					  FF,
				   (SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'BF')
					  BF,
					(SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'EF')
					  EF,
					 (SELECT   porsi
					  FROM   $DBUser.TABEL_UL_OPSI_FUND
					 WHERE       prefixpertanggungan = a.prefixpertanggungan
							 AND nopertanggungan = a.nopertanggungan
							 AND kdfund = 'MM')
					  MM,
					  NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IG'),
					0)
					IG,
				   NVL (
					(SELECT porsi
					   FROM $DBUser.TABEL_UL_OPSI_FUND
					  WHERE     prefixpertanggungan = a.prefixpertanggungan
							AND nopertanggungan = a.nopertanggungan
							AND kdfund = 'IH'),
					0)
					IH,".
					  "(select nvl(no_ponsel, PHONETETAP02) from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) ponsel, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis) namapp, ".
					 "decode(nopemegangpolis,notertanggung,usia_th,round(months_between (mulas,(select tgllahir from $DBUser.tabel_100_klien where noklien=a.nopemegangpolis))/12)) usiapp, ".
					 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noTERTANGGUNG) namatt,
					  (select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar = a.KDCARABAYAR) cara_bayar  ".
				"from ".
				    "$DBUser.tabel_200_pertanggungan a ".
				"where ".
    				//"a.kdstatusemail='1' ".
					//"AND 
					"substr(a.kdproduk,1,3) not in ('JL4') ".
    				"AND a.nopenagih is not null ".
    				"AND a.premi1 != '0' ".
    				"AND a.prefixpertanggungan = '$kantor' ".
    				"AND a.kdstatusmedical = 'N' ".
    				"AND a.kdpertanggungan = '1' ".
    				"AND a.kdstatusfile = '1' ".
					" and not exists (select 'x' from $DBUser.TABEL_214_UNDERWRITING
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ".
				 "AND NOT EXISTS
                 (SELECT   'x'
                    FROM   $DBUser.TABEL_800_PEMBAYARAN 
                   WHERE   prefixpertanggungan = a.prefixpertanggungan
                           AND nopertanggungan = a.nopertanggungan
                           and kdpembayaran='001')".
    				"ORDER BY tglsendemail, a.prefixpertanggungan, a.nopertanggungan ";}
		// echo $sql;		
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
		  
	//$total = $nilairp + $biayapolis + $materai;
	$total = $nilairp;
	$grandtotal = $total - $suspend;
	
	$juarp = ($PERT->valuta=='0') ? $PERT->jua  : $PERT->jua * $TR->Kurs($PERT->valuta,$tglbp3);
	
	#----------------------------[ END CEK PELUNASAN PREMI ]----------------------------
	
	#----------------------------[ START NO HP ]----------------------------
	if(strlen($arr["PONSEL"])<9){
	//if(($arr["PONSEL"])== ''){
			 	$nohp = "<font color=red><a href=\"#\" onclick=\"NewWindow('../updateponsel.php?noklien=".$arr["NOPEMEGANGPOLIS"]."','',800,500,1)\">UPDATE NO. HP</a></font>";  
				//echo 'kampret';
			 } else {
			    $nohp = $arr["PONSEL"];
				//echo 'kampret ok';
			 }
	#----------------------------[ END NO HP ]----------------------------
	 ?>
  <tr>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('./polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">"./*$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]*/$arr['NOPOLBARU']."</a></font></td>";?>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?><?// echo $arr["PMGPOL"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["USIA_TH"];?> th</font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$nohp;?></font></td>
    <td bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATT"];?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><?=$arr["USIA_TH"];?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["FF"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["EF"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["BF"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MM"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["IG"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["IH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; $grandtotal;?></font></td>
    <td bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["CARA_BAYAR"];?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PREMI1"]-$arr["TOPUPBKL"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TOPUPBKL"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["PREMI1"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TOPUP"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["CI"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TI"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["TPD"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["WPCI"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["WPTPD"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["TGLEMAIL"]; ?></font></td>
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
			 
			 if($arr["TOPUPBKL"]==0||$arr["TOPUPBKL"]==''){
				$catatanx = "<font color=red>TOPUP BERKALA TIDAK BOLEH 0</font>";  
			 }
			 
			 if($arr["CARA_BAYAR"]=='BULANAN'){
				if($arr["PREMI1"] < 350000){
					$catatanx = "<font color=red>TOTAL PREMI TIDAK BOLEH KURANG DARI 500.000</font>";  	
				}									
			 }elseif($arr["CARA_BAYAR"]=='TAHUNAN'){
				if($arr["PREMI1"] < 4200000){
					$catatanx = "<font color=red>TOTAL PREMI TIDAK BOLEH KURANG DARI 4.200.000</font>";  	
				}
			 }
			 
			 //if(($arr["PONSEL"])== ''){
			 if(strlen($arr["PONSEL"])<9){
			 	$catatanx = "<font color=red>LENGKAPI NO. HP !</font>";  				
			 } else if($arr['SUSPEND']) {
				 $catatanx = null;
			 } else {
			    $catatanx = $cebox;				
			 }
			 
			/* Tambahan Cutoff Send Email - Teguh 16/03/2020 */
			// $cutoff = date('Ym')."27";
			// if($arr["TGLKIRIMEMAIL"] > $cutoff){
			//  	$catatanx = "Proses akan diapprove bulan depan!";
			// }


			 //echo $nilairp;
			 // echo $PERT->premi1; 
			 //echo $TR->Kurs($PERT->valuta,$tglbp3);
			 //echo $PERT->valuta;
			 //echo $tglbp3;
			 
			 
			 // jika jua kurang dari jua minimal produk
			 // permintaan sesuai kerjasama
		   
			 if($modul=="ALL"||$modul=='ITC'){
			      $catatan = $cebox;
			 } 
			 else {
						 if($arr["JUAMINIMAL"]!=""){
						 if($juarp>=$arr["JUAMINIMAL"]){
							$catatan = $cebox;
						 } else {
							$catatan = "<font color=red>* JUA < Rp.".number_format($arr["JUAMINIMAL"],0).".-</font>";
						 }
						 }
			 }
			 
			 
		?>
    <td bgcolor="#FFFFFF" align="center">
		<font face="Verdana" size="1"><? echo $catatanx; ?></font>
		<?php 
			if (!$arr['SUSPEND']) { 
		?>
				<input type="button" value="Pending" onclick="NewWindow('../akseptasi_pending.php?<?="prefixpertanggungan=$arr[PREFIXPERTANGGUNGAN]&nopertanggungan=$arr[NOPERTANGGUNGAN]";?>','popuppage','650','650','yes')" style="padding:2px;margin:0px;font-size:12px;font-face:verdana;" />
		<?php 
			} else {
				echo "<font face='Verdana' size='1'>$arr[KETERANGAN]</font>";
		} ?>
	</td>
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
                 "and a.nopertanggungan=b.nopertanggungan)=0 ".
                "and a.prefixpertanggungan='$kantor' ".
      					"and a.kdstatusemail ='1' and a.nopenagih is not null ".
      					"and a.kdpertanggungan='1' ".
                "and a.kdstatusfile = '1' ".
				"AND substr(a.kdproduk,1,3) not in ('JL3','JL4') ".
      					"and a.kdstatusmedical='XM' and not exists (select 'x' from $DBUser.TABEL_214_UNDERWRITING
						where prefixpertanggungan=a.prefixpertanggungan ".
                 "and nopertanggungan=a.nopertanggungan ) ORDER BY a.prefixpertanggungan, a.nopertanggungan ";
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
	}
	$nopertm = $arr["NOPERTANGGUNGAN"];
	 ?>
  <tr>
    <td width="5%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "$i";?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo "<a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',800,500,1)\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></font></td>";?>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMAPP"];?></font></td>
    <td width="11%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["PONSEL"];?></font></td>
    <td width="10%" bgcolor="#FFFFFF"><font face="Verdana" size="1"><?=$arr["NAMATT"];?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo number_format($arr["JUAMAINPRODUK"],0,',','.'); ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["KDPRODUK"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["MULAS"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $arr["LAMAASURANSI_TH"]; ?></font></td>
    <td width="10%" bgcolor="#FFFFFF" align="center"><font face="Verdana" size="1"><? echo $statusmedical; ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["PREMI1"],0,',','.'); ?></font></td>
    <td bgcolor="#FFFFFF" align="right"><font face="Verdana" size="1"><? echo $arr["NOTASI"]." ".number_format($arr["TOPUP"],0,',','.'); ?></font></td>
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
	  	<td class="verdana10blk" style="font-size: 13px" align="right">
	  	<!-- Tambahan untuk memilih jenis APPROVAL terlebih dahulu sebelum mengklik proses APPROVE - (Teguh 08/11/2019)-->
	    <?php 
	        if ($kantor == 'KP') { ?>
	          Pilih Kategori Approval : 
	          <input type="radio" name="kdjenisapproval" value="1" checked="checked"> Standar Non Medical
	          <input type="radio" name="kdjenisapproval" value="2"> Standar Medical
	          <input type="radio" name="kdjenisapproval" value="3"> Substandar Non Medical
	          <input type="radio" name="kdjenisapproval" value="4"> Substandar Medical
	    <?php }
	        else{}
	    ?>
    	<!--End Tambahan - (Teguh 08/11/2019)-->
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
	  <input type="submit" value="Approve" name="sendemail">
      <?
	  if($kantor=='KP') {
	  	echo "<input type=\"submit\" value=\"Reject\" name=\"rijek\">";
	  	echo "<input type=\"submit\" value=\"Decline\" name=\"decline\">";
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
/*if (document.xxx.cek.value=='')
document.xxx.sendemail.disabled=true
else
document.xxx.sendemail.disabled=false
}*/
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
<td><font face="verdana" size="2"><a href="../../submenu.php?mnuinduk=150">Back</a></font></td>
<td><!--<font face="verdana" size="2"><a href="emailterkirim.php">&nbsp;&nbsp;&nbsp;&nbsp;Check Pengiriman Email</a>--></font></td>
</tr>
</table>

